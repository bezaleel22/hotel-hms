<?php
require_once dirname(__FILE__) . '/TestUtils.php';

class PaymentTest
{
    private $utils;
    private $testData;

    public function __construct()
    {
        $this->utils = new TestUtils();
        $this->testData = $this->utils->loadTestData('payment_test_data.json');
    }

    public function runTests($delete_log = false)
    {
        echo "\nRunning Payment Tests...\n";
        if ($delete_log) {
            $this->utils->deleteLogs();
        }

        $this->testPaymentVerification();
        $this->testInvalidPaymentVerification();
    }

    private function testPaymentVerification()
    {
        echo "\nTesting Payment Verification Endpoint:\n";

        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/payments/verify/' . $this->testData['verify']['booking_id'],
            $this->testData['verify']['payment_data'],
            ['Content-Type: application/json']
        );

        $this->utils->assertResponse("Payment Verification", $result, 200);

        // Verify payment status in response
        if ($result['status_code'] === 200) {
            if (!isset($result['response']['success']) || !$result['response']['success']) {
                echo "\033[0;31mFAILED: Payment verification response doesn't indicate success\033[0m\n";
            }

            // Check if payment status is updated
            if (
                !isset($result['response']['data']['payment_status']) ||
                $result['response']['data']['payment_status'] !== 'completed'
            ) {
                echo "\033[0;31mFAILED: Payment status not updated correctly\033[0m\n";
            }
        }
    }

    private function testInvalidPaymentVerification()
    {
        echo "\nTesting Invalid Payment Verification Endpoint:\n";

        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/payments/verify/' . $this->testData['verify']['invalid_booking_id'],
            $this->testData['verify']['payment_data'],
            ['Content-Type: application/json']
        );

        // Expecting 404 Not Found for invalid booking ID
        $this->utils->assertResponse("Invalid Payment Verification", $result, 404);

        // Verify error message
        if ($result['status_code'] === 404) {
            if (
                !isset($result['response']['error']) ||
                !strpos(strtolower($result['response']['error']), 'booking not found')
            ) {
                echo "\033[0;31mFAILED: Expected 'booking not found' error message\033[0m\n";
            }
        }
    }
}

// Run tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $paymentTest = new PaymentTest();
    $paymentTest->runTests(true);
}
