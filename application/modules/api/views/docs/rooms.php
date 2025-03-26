<h1>Room Management</h1>

<section class="section">
    <p>Endpoints for managing room availability, details, and booking.</p>

    <div class="endpoint" id="list">
        <h3><span class="method get">GET</span> /api/v1/rooms/list</h3>
        <p>List available rooms based on search criteria.</p>

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
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/rooms/list') ?>?checkin=2024-03-25&checkout=2024-03-27&adults=2&children=1' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/rooms/list') ?>?checkin=2024-03-25&checkout=2024-03-27&adults=2&children=1', {
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

        <h4>Response Fields</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>roominfo</td>
                <td>array</td>
                <td>Array containing room details</td>
            </tr>
            <tr>
                <td>freeroom</td>
                <td>array</td>
                <td>Array of available room IDs for the selected dates</td>
            </tr>
        </table>
    </div>

    <div class="endpoint">
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