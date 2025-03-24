<?php

// Base URL of the API
$BASE_URL = "http://localhost/api/v1"; // Replace with your API base URL

// Function to send a request and validate the response
function testEndpoint($method, $url, $data = [], $expectedStatus = 200, $description = "")
{
    echo "Testing: $description\n";
    echo "URL: $url\n";

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($method === "POST") {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
    }

    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Decode the response
    $responseData = json_decode($response, true);

    // Validate the response
    if ($httpCode === $expectedStatus) {
        echo "✅ Success ($httpCode)\n";
        if (!empty($responseData)) {
            echo "Response: " . json_encode($responseData, JSON_PRETTY_PRINT) . "\n";
        }
        return $responseData;
    } else {
        echo "❌ Failed ($httpCode)\n";
        echo "Response: " . json_encode($responseData, JSON_PRETTY_PRINT) . "\n";
        exit(1); // Exit with an error code
    }
}

try {
    // Step 1: User Authentication (Optional)
    echo "\n--- Step 1: User Authentication ---\n";
    $loginData = testEndpoint(
        "POST",
        "$BASE_URL/auth/login",
        ["email" => "test@example.com", "password" => "password123"],
        200,
        "Login"
    );
    $token = $loginData['token'] ?? null; // Extract token if available

    // Step 2: Search for Rooms
    echo "\n--- Step 2: Search for Rooms ---\n";
    $rooms = testEndpoint(
        "GET",
        "$BASE_URL/rooms/availability?checkin=2024-01-01&checkout=2024-01-05&adults=2&children=1&room_type=Single",
        [],
        200,
        "Search for Available Rooms"
    );

    // Step 3: Add Room to Cart
    echo "\n--- Step 3: Add Room to Cart ---\n";
    $roomToAdd = $rooms['rooms'][0] ?? null;
    if (!$roomToAdd) {
        throw new Exception("No rooms available to add to cart.");
    }
    $cartResponse = testEndpoint(
        "POST",
        "$BASE_URL/cart/add",
        [
            "room_id" => $roomToAdd['room_id'],
            "checkin_date" => "2024-01-01",
            "checkout_date" => "2024-01-05",
            "adults" => 2,
            "children" => 1,
            "quantity" => 1
        ],
        200,
        "Add Room to Cart"
    );

    // Step 4: View Cart
    echo "\n--- Step 4: View Cart ---\n";
    $cartView = testEndpoint(
        "GET",
        "$BASE_URL/cart/view",
        [],
        200,
        "View Cart"
    );

    // Step 5: Apply Promo Code (Optional)
    echo "\n--- Step 5: Apply Promo Code ---\n";
    $promoResponse = testEndpoint(
        "POST",
        "$BASE_URL/cart/apply-promo",
        ["promo_code" => "DISCOUNT10"],
        200,
        "Apply Promo Code"
    );

    // Step 6: Confirm Booking
    echo "\n--- Step 6: Confirm Booking ---\n";
    $bookingResponse = testEndpoint(
        "POST",
        "$BASE_URL/booking/confirm",
        [
            "customer_id" => 123,
            "payment_method" => "PayPal",
            "total_amount" => $cartView['total_amount']
        ],
        200,
        "Confirm Booking"
    );
    $bookingNumber = $bookingResponse['booking_number'] ?? null;

    // Step 7: Process Payment
    echo "\n--- Step 7: Process Payment ---\n";
    if (!$bookingNumber) {
        throw new Exception("Booking number not found for payment processing.");
    }
    $paymentResponse = testEndpoint(
        "POST",
        "$BASE_URL/payment/process",
        [
            "booking_number" => $bookingNumber,
            "payment_method" => "PayPal",
            "amount" => $cartView['total_amount']
        ],
        200,
        "Process Payment"
    );

    // Step 8: View Booking Details
    echo "\n--- Step 8: View Booking Details ---\n";
    if (!$bookingNumber) {
        throw new Exception("Booking number not found for viewing details.");
    }
    $bookingDetails = testEndpoint(
        "GET",
        "$BASE_URL/booking/$bookingNumber",
        [],
        200,
        "View Booking Details"
    );

    echo "\n🎉 All tests passed successfully!\n";
} catch (Exception $e) {
    echo "\n❌ Test Failed: " . $e->getMessage() . "\n";
    exit(1);
}
