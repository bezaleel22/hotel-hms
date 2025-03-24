<?php
require_once dirname(__FILE__) . '/TestUtils.php';

class BookingTest
{
    private $utils;
    private $testData;
    private $authToken;
    private $testCount = 0;
    private $bknumber;

    public function __construct()
    {
        $this->utils = new TestUtils();
        $this->testData = $this->utils->loadTestData('booking_test_data.json');
        $this->authToken = $this->utils->getAuthToken();

        // Check for auth token before proceeding
        if (!$this->authToken) {
            die("Error: Authentication token not found. Please ensure you are logged in before running tests.\n");
        }
    }

    public function runTests($delete_log = false)
    {
        TestUtils::resetTestCounts();
        echo "\nRunning Booking Tests...\n";
        if ($delete_log) {
            $this->utils->deleteLogs();
        }

        $this->utils->loggingEnabled = false;
        $this->testCreateBooking();
        $this->testGetBookingDetails();
        $this->testPaymentVerification();
        $this->testBookingHistory();
        $this->testCancelBooking();
        $this->utils->loggingEnabled = true;

        $counts = TestUtils::getTestCounts();
        echo "\nBooking Tests Summary:";
        echo "\nTotal Tests: " . $counts['total'];
        echo "\nPassed: " . $counts['passed'];
        echo "\nFailed: " . $counts['failed'] . "\n";
    }

    private function getAuthHeaders()
    {
        return ['Authorization: Bearer ' . $this->authToken];
    }

    private function testCreateBooking()
    {
        echo "\nTesting Create Booking Endpoint:\n";
        $headers = $this->getAuthHeaders();

        $this->testCount++;
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/bookings/create',
            $this->testData['booking'],
            $headers
        );
        $this->utils->assertResponse("Create Booking", $result, 200);
        if (isset($result['response']['data']['booking_number'])) {
            $this->bknumber = $result['response']['data']['booking_number'];
        }
    }

    private function testGetBookingDetails()
    {
        echo "\nTesting Get Booking Details Endpoint:\n";
        $headers = $this->getAuthHeaders();

        $this->testCount++;
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/bookings/details/' . $this->bknumber,
            null,
            $headers
        );
        $this->utils->assertResponse("Get Booking Details", $result, 200);
    }

    private function testCancelBooking()
    {
        echo "\nTesting Cancel Booking Endpoint:\n";
        $headers = $this->getAuthHeaders();

        $this->testCount++;
        $result = $this->utils->makeRequest(
            'DELETE',
            '/api/v1/bookings/cancel/' . $this->bknumber,
            null,
            $headers
        );
        $this->utils->assertResponse("Cancel Booking", $result, 200);
    }

    private function testBookingHistory()
    {
        echo "\nTesting Booking History Endpoint:\n";
        $headers = $this->getAuthHeaders();

        $this->testCount++;
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/bookings/history',
            null,
            $headers
        );
        $this->utils->assertResponse("Get Booking History", $result, 200);
    }

    private function testPaymentVerification()
    {
        echo "\nTesting Payment Verification Endpoint:";
        echo "\nPlease complete the payment on your payment gateway/provider and press ENTER to continue...";
        fgets(STDIN);
        echo "\nVerifying payment...\n";

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

    public function getTestCount()
    {
        return $this->testCount;
    }
}

// Run tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $bookingTest = new BookingTest();
    $bookingTest->runTests();
}
