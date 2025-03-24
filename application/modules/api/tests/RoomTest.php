<?php
require_once dirname(__FILE__) . '/TestUtils.php';

class RoomTest
{
    private $utils;
    private $testData;
    private $roomId;
    private $token;

    public function __construct()
    {
        $this->utils = new TestUtils();
        $this->testData = $this->utils->loadTestData('room_test_data.json');
    }

    public function runTests($delete_log = false)
    {
        echo "\nRunning Room Tests...\n";
        if ($delete_log) {
            $this->utils->deleteLogs();
        }

        // Run room list first to get a valid room_id
        $this->utils->loggingEnabled = false;
        $this->testRoomList();

        // Other tests that need room_id
        if ($this->roomId) {
            $this->testAvailability();
            $this->testRoomDetails();
            $this->testBookRoom();
            // $this->testPromoCode();
        } else {
            echo "\nNo rooms available for testing.\n";
        }
        $this->utils->loggingEnabled = true;
        $this->utils->setAuthToken($this->token);
    }

    private function testRoomList()
    {
        echo "\nTesting Room List Endpoint:\n";

        // Test room list request
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/rooms/list?' . http_build_query([
                'checkin' => $this->testData['list']['checkin'],
                'checkout' => $this->testData['list']['checkout'],
                'adults' => $this->testData['list']['adults'],
                'children' => $this->testData['list']['children']
            ])
        );
        $this->utils->assertResponse("Room List", $result, 200);

        // Get room_id from response
        if (
            $result['status_code'] === 200 &&
            isset($result['response']['data']) &&
            !empty($result['response']['data']['roominfo'])
        ) {
            $this->roomId = $result['response']['data']['roominfo'][0]['roomid'];
            echo "Using room_id: " . $this->roomId . "\n";
        }
    }

    private function testAvailability()
    {
        echo "\nTesting Room Availability Endpoint:\n";

        // Test availability check with dynamic room_id
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/rooms/availability?' . http_build_query([
                'room_id' => $this->roomId,
                'checkin' => $this->testData['availability']['checkin'],
                'checkout' => $this->testData['availability']['checkout']
            ])
        );
        $this->utils->assertResponse("Availability Check", $result, 200);
    }

    private function testRoomDetails()
    {
        echo "\nTesting Room Details Endpoint:\n";

        // Test room details request with dynamic room_id
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/rooms/details/' . $this->roomId . '?' . http_build_query([
                'checkin' => $this->testData['details']['checkin'],
                'checkout' => $this->testData['details']['checkout']
            ])
        );
        $this->utils->assertResponse("Room Details", $result, 200);
    }

    private function testBookRoom()
    {
        echo "\nTesting Room Booking Endpoint:\n";

        // Update booking data with dynamic room_id
        $bookingData = $this->testData['booking'];
        $bookingData['roomid'] = $this->roomId;

        // Test room booking
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/rooms/book',
            $bookingData,
            ['Content-Type: application/json']
        );

        $this->utils->assertResponse("Room Booking", $result, 200);

        // Get token from response
        if (
            $result['status_code'] === 200 &&
            isset($result['response']['data']) &&
            !empty($result['response']['data']['token'])
        ) {
            $this->token = $result['response']['data']['token'];
            echo "Using token: " . $this->token . "\n";
        }
    }

    private function testPromoCode()
    {
        echo "\nTesting Promo Code Endpoint:\n";

        // Update promo code data with dynamic room_id
        $promoData = $this->testData['promocode'];
        $promoData['roomid'] = $this->roomId;

        // Test promo code
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/rooms/verify-promocode',
            $promoData,
            ['Content-Type: application/json']
        );
        $this->utils->assertResponse("Promo Code", $result, 200);
    }
}

// Run tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $roomTest = new RoomTest();
    $roomTest->runTests();
}
