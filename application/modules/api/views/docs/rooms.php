<h1>Room Management</h1>

<section class="section">
    <p>Endpoints for managing room availability, details, and booking.</p>

    <div class="endpoint" id="list">
        <h3><span class="method get">GET</span> /api/v1/rooms/list</h3>
        <p>List all rooms in the hotel with their details.</p>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/rooms/list') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/rooms/list') ?>', {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Room list fetched successfully",
    "data": {
        "roominfo": [{
            "roomid": "1",
            "roomtype": "Executive",
            "roomsize": "1",
            "capacity": "2",
            "rate": "79100.00",
            "bedcharge": "0",
            "personcharge": "0"
        }]
    }
}</div>

        <h4>Response Fields</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>roomid</td>
                <td>string</td>
                <td>Unique identifier for the room</td>
            </tr>
            <tr>
                <td>roomtype</td>
                <td>string</td>
                <td>Type/category of the room</td>
            </tr>
            <tr>
                <td>capacity</td>
                <td>string</td>
                <td>Maximum number of guests</td>
            </tr>
            <tr>
                <td>rate</td>
                <td>string</td>
                <td>Room rate per night</td>
            </tr>
        </table>
    </div>

    <div class="endpoint" id="availability">
        <h3><span class="method get">GET</span> /api/v1/rooms/availability</h3>
        <p>Get available rooms based on search criteria like dates and occupancy.</p>

        <h4>Query Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
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
                <td>adults <span class="required">*</span></td>
                <td>integer</td>
                <td>Number of adults</td>
            </tr>
            <tr>
                <td>children <span class="optional">optional</span></td>
                <td>integer</td>
                <td>Number of children</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/rooms/availability') ?>?checkin=2024-03-25&checkout=2024-03-27&adults=2&children=1' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/rooms/availability') ?>?checkin=2024-03-25&checkout=2024-03-27&adults=2&children=1', {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Available rooms fetched successfully",
    "data": {
        "roominfo": [{
            "roomid": "1",
            "roomtype": "Executive",
            "roomsize": "1",
            "capacity": "2",
            "rate": "79100.00",
            "bedcharge": "0",
            "personcharge": "0",
            "available": true
        }]
    }
}</div>
    </div>

    <div class="endpoint" id="details">
        <h3><span class="method get">GET</span> /api/v1/rooms/details/{roomid}</h3>
        <p>Get detailed information about a specific room. This endpoint must be called before proceeding with booking.</p>

        <h4>Path Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>roomid <span class="required">*</span></td>
                <td>string</td>
                <td>Room identifier</td>
            </tr>
        </table>

        <h4>Query Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
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
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/rooms/details/1') ?>?checkin=2024-03-25&checkout=2024-03-27' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/rooms/details/1') ?>?checkin=2024-03-25&checkout=2024-03-27', {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Room details fetched successfully",
    "data": {
        "roominfo": [{
            "roomid": "1",
            "roomtype": "Executive",
            "roomsize": "1",
            "roomsizemesurement": "14",
            "bedsno": "1",
            "bedstype": "14",
            "number_of_star": "5",
            "roomdescription": "Good",
            "reservecondition": "Great",
            "capacity": "2",
            "rate": "79100.00",
            "bedcharge": "0",
            "personcharge": "0"
        }],
        "freeroom": [1]
    }
}</div>
    </div>

    <div class="endpoint" id="book">
        <h3><span class="method post">POST</span> /api/v1/rooms/book</h3>
        <p>Book a room by creating a preliminary booking record. User data (firstname, lastname, email, phone) must be sent alongside the booking details. The response will include an authentication token that must be used for all subsequent requests. This must be done before applying promo codes or proceeding with payment.</p>

        <h4>Request Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>firstname <span class="required">*</span></td>
                <td>string</td>
                <td>Guest's first name</td>
            </tr>
            <tr>
                <td>lastname <span class="required">*</span></td>
                <td>string</td>
                <td>Guest's last name</td>
            </tr>
            <tr>
                <td>email <span class="required">*</span></td>
                <td>string</td>
                <td>Guest's email address</td>
            </tr>
            <tr>
                <td>phone <span class="required">*</span></td>
                <td>string</td>
                <td>Guest's phone number</td>
            </tr>
            <tr>
                <td>roomid <span class="required">*</span></td>
                <td>string</td>
                <td>Room identifier</td>
            </tr>
            <tr>
                <td>roomtype <span class="required">*</span></td>
                <td>string</td>
                <td>Type of room being booked</td>
            </tr>
            <tr>
                <td>amount <span class="required">*</span></td>
                <td>number</td>
                <td>Total booking amount</td>
            </tr>
            <tr>
                <td>roomrate <span class="required">*</span></td>
                <td>number</td>
                <td>Room rate per night</td>
            </tr>
            <tr>
                <td>discount</td>
                <td>number</td>
                <td>Discount amount (if any)</td>
            </tr>
            <tr>
                <td>adults <span class="required">*</span></td>
                <td>number</td>
                <td>Number of adults</td>
            </tr>
            <tr>
                <td>children</td>
                <td>number</td>
                <td>Number of children</td>
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
                <td>guest <span class="required">*</span></td>
                <td>string</td>
                <td>Full name of the guest</td>
            </tr>
            <tr>
                <td>specialinstruction</td>
                <td>string</td>
                <td>Special requests or notes for the booking</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/rooms/book') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{
    "firstname": "Jane",
    "lastname": "Doe",
    "email": "jane.doe@example.com",
    "phone": "1234567890",
    "roomid": "1",
    "roomtype": "Deluxe",
    "amount": 200,
    "roomrate": 100,
    "discount": 0,
    "adults": 2,
    "children": 1,
    "checkin": "2024-03-25",
    "checkout": "2024-03-27",
    "guest": "Jane Doe",
    "specialinstruction": "Early check-in requested"
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/rooms/book') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        firstname: "Jane",
        lastname: "Doe",
        email: "jane.doe@example.com",
        phone: "1234567890",
        roomid: "1",
        roomtype: "Deluxe",
        amount: 200,
        roomrate: 100,
        discount: 0,
        adults: 2,
        children: 1,
        checkin: "2024-03-25",
        checkout: "2024-03-27",
        guest: "Jane Doe",
        specialinstruction: "Early check-in requested"
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Room booked successfully",
    "data": {
        "cart": {
            "18c0db6ca3add1d672d2d25e934e43c3": {
                "id": "1",
                "name": "Deluxe",
                "qty": 1,
                "roomrate": 100,
                "price": 200,
                "totalprice": 215,
                "checkin": "2024-03-25",
                "checkout": "2024-03-27",
                "adults": 2,
                "children": 1,
                "tax": 15,
                "scharge": 0,
                "discount": 0,
                "customerid": "59",
                "fullName": "Jane Doe",
                "email": "jane.doe@example.com",
                "special": "Early check-in requested",
                "subtotal": 200,
                "rowid": "18c0db6ca3add1d672d2d25e934e43c3"
            }
        },
        "user": {
            "customerid": "59",
            "firstname": "Jane",
            "lastname": "Doe",
            "email": "jane.doe@example.com",
            "cust_phone": "1234567890",
            "address": null,
            "balance": "0.00",
            "customernumber": "0059",
            "bookings": []
        },
        "paymentmethod": [
            {
                "payment_method_id": "3",
                "payment_method": "Paypal",
                "is_active": "1"
            },
            {
                "payment_method_id": "5",
                "payment_method": "SSLCommerz",
                "is_active": "1"
            },
            {
                "payment_method_id": "7",
                "payment_method": "Paystack",
                "is_active": "1"
            },
            {
                "payment_method_id": "8",
                "payment_method": "Stripe",
                "is_active": "1"
            },
            {
                "payment_method_id": "9",
                "payment_method": "Razorpay",
                "is_active": "1"
            }
        ],
        "token": "eyJ0eXAiOiJKV1QiLCJhbGci..."
    }
}</div>
    </div>

    <div class="endpoint" id="verify-promocode">
        <h3><span class="method post">POST</span> /api/v1/rooms/verify-promocode</h3>
        <p>Validate and apply a promotion code to the booking.</p>

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
                <td>promocode <span class="required">*</span></td>
                <td>string</td>
                <td>Promotion code to verify</td>
            </tr>
            <tr>
                <td>roomid <span class="required">*</span></td>
                <td>string</td>
                <td>Room identifier</td>
            </tr>
            <tr>
                <td>total_amount <span class="required">*</span></td>
                <td>number</td>
                <td>Total booking amount before discount</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/rooms/verify-promocode') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {token}' \
-d '{
    "promocode": "SUMMER2024",
    "roomid": "1",
    "total_amount": 200
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/rooms/verify-promocode') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer {token}'
    },
    body: JSON.stringify({
        promocode: 'SUMMER2024',
        roomid: '1',
        total_amount: 200
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Promo code applied successfully",
    "data": {
        "total_discount": 2500,
        "total_amount": -2300
    }
}</div>
    </div>
</section>