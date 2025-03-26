<h1>Booking Management</h1>

<section class="section">
    <p>Endpoints for managing room bookings, payments, and booking history.</p>

    <div class="endpoint" id="create">
        <h3><span class="method post">POST</span> /api/v1/bookings/create</h3>
        <p>Create a new booking and initiate the payment process.</p>

        <h4>Headers</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>Authorization <span class="required">*</span></td>
                <td>Bearer {token}</td>
                <td>JWT access token</td>
            </tr>
        </table>

        <h4>Request Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>callback_url <span class="required">*</span></td>
                <td>string</td>
                <td>URL where payment provider will redirect after payment</td>
            </tr>
            <tr>
                <td>pmethod <span class="required">*</span></td>
                <td>string</td>
                <td>Payment method ID</td>
            </tr>
            <tr>
                <td>roomid <span class="required">*</span></td>
                <td>string</td>
                <td>Room identifier</td>
            </tr>
            <tr>
                <td>checkin <span class="required">*</span></td>
                <td>string</td>
                <td>Check-in date (YYYY-MM-DD)</td>
            </tr>
            <tr>
                <td>checkout <span class="required">*</span></td>
                <td>string</td>
                <td>Check-out date (YYYY-MM-DD)</td>
            </tr>
            <tr>
                <td>fullName <span class="required">*</span></td>
                <td>string</td>
                <td>Guest's full name</td>
            </tr>
            <tr>
                <td>adult <span class="required">*</span></td>
                <td>integer</td>
                <td>Number of adults</td>
            </tr>
            <tr>
                <td>children <span class="optional">optional</span></td>
                <td>integer</td>
                <td>Number of children</td>
            </tr>
            <tr>
                <td>special <span class="optional">optional</span></td>
                <td>string</td>
                <td>Special requests or instructions</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/bookings/create') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {token}' \
-d '{
    "callback_url": "https://example.com/callback",
    "pmethod": "7",
    "roomid": "1",
    "adult": 2,
    "children": 1,
    "checkin": "2025-04-01",
    "checkout": "2025-04-03",
    "fullName": "John Doe",
    "special": "No smoking room"
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/bookings/create') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer {token}'
    },
    body: JSON.stringify({
        callback_url: 'https://example.com/callback',
        pmethod: '7',
        roomid: '1',
        adult: 2,
        children: 1,
        checkin: '2025-04-01',
        checkout: '2025-04-03',
        fullName: 'John Doe',
        special: 'No smoking room'
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Booking created successfully",
    "data": {
        "callback_url": "https://example.com/callback",
        "booking_number": "00000002",
        "payment": {
            "authorization_url": "https://checkout.paystack.com/xmbufamq7ylierj",
            "access_code": "xmbufamq7ylierj",
            "reference": "qdrsvdln52"
        }
    }
}</div>

        <div class="note">
            <p><strong>Note:</strong> After creating the booking:</p>
            <ol>
                <li>Redirect the user to the payment.authorization_url to complete payment</li>
                <li>The payment provider will redirect to your callback_url after payment</li>
                <li>Call verify-payment endpoint to confirm payment status</li>
            </ol>
        </div>
    </div>

    <div class="endpoint" id="verify-payment">
        <h3><span class="method get">GET</span> /api/v1/bookings/verify-payment/{booking_number}</h3>
        <p>Verify payment status after payment provider redirects to callback URL.</p>

        <h4>Headers</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>Authorization <span class="required">*</span></td>
                <td>Bearer {token}</td>
                <td>JWT access token</td>
            </tr>
        </table>

        <h4>Path Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>booking_number <span class="required">*</span></td>
                <td>string</td>
                <td>Booking reference number</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/bookings/verify-payment/00000002') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {token}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/bookings/verify-payment/00000002') ?>', {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer {token}'
    }
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Payment verification completed",
    "data": {
        "payment_status": {
            "total_price": "215.00",
            "amount_paid": "21500.00",
            "remaining_amount": -21285,
            "is_fully_paid": true,
            "booking_status": "2",
            "completed": true
        },
        "payment_history": [
            {
                "invoice_number": "00000002",
                "payment_method": "7",
                "amount": "21500.00",
                "date": "2025-03-24 22:11:05",
                "booking_type": "Room",
                "details": "Room booking payment - Amount: 21,500.00"
            }
        ]
    }
}</div>
    </div>

    <div class="endpoint" id="history">
        <h3><span class="method get">GET</span> /api/v1/bookings/history</h3>
        <p>Retrieve booking history for the authenticated user.</p>

        <h4>Headers</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>Authorization <span class="required">*</span></td>
                <td>Bearer {token}</td>
                <td>JWT access token</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/bookings/history') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {token}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/bookings/history') ?>', {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer {token}'
    }
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Booking history fetched successfully",
    "data": {
        "pagination": {
            "current_page": 1,
            "per_page": 30,
            "total_pages": 1,
            "total_records": "1"
        },
        "bookings": [
            {
                "booking_number": "00000002",
                "date_time": "2025-03-24 23:10:53",
                "roomtype": "Executive",
                "total_price": "215.00",
                "paid_amount": "21500.00",
                "bookingstatus": "2"
            }
        ]
    }
}</div>
    </div>
</section>