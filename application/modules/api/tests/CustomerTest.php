<?php
require_once dirname(__FILE__) . '/TestUtils.php';

class CustomerTest
{
    private $utils;
    private $testData;
    private $authToken;

    public function __construct()
    {
        $this->utils = new TestUtils();
        $this->testData = $this->utils->loadTestData('customer_test_data.json');
        $this->authToken = $this->utils->getAuthToken();
    }

    public function runTests($delete_log = false)
    {
        echo "\nRunning Customer Management Tests...\n";
        if ($delete_log) {
            $this->utils->deleteLogs();
        }

        if (!$this->authToken) {
            die("Error: Authentication token not found. Please ensure you are logged in before running tests.\n");
        }

        // $this->testGetDetails();
        $this->testUpdate();
        // $this->testGetBookings();
    }

    private function testGetDetails()
    {
        echo "\nTesting Get Customer Details Endpoint:\n";

        // Test getting own customer details
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/customer',
            null,
            ['Authorization: Bearer ' . $this->authToken]
        );
        $this->utils->assertResponse("Get Customer Details", $result, 200);
    }

    private function testUpdate()
    {
        echo "\nTesting Update Customer Endpoint:\n";

        // Test updating customer data
        $result = $this->utils->makeRequest(
            'PUT',
            '/api/v1/customer',
            $this->testData['update'],
            ['Authorization: Bearer ' . $this->authToken]
        );
        $this->utils->assertResponse("Update Customer", $result, 200);
    }

    private function testGetBookings()
    {
        echo "\nTesting Get Customer Bookings Endpoint:\n";

        // Test getting own bookings
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/customer/bookings',
            null,
            ['Authorization: Bearer ' . $this->authToken]
        );
        $this->utils->assertResponse("Get Customer Bookings", $result, 200);
    }
}

// Run tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $customerTest = new CustomerTest();
    $customerTest->runTests();
}
