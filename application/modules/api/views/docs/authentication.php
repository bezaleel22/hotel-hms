<h1>Authentication</h1>

<section class="section">
    <p>The Hotel HMS API uses JWT (JSON Web Tokens) for authentication. Most endpoints require a valid access token in the Authorization header.</p>

    <div class="endpoint" id="signup">
        <h3><span class="method post">POST</span> /api/v1/auth/signup</h3>
        <p>Create a new customer account.</p>

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
                <td>Customer's first name</td>
            </tr>
            <tr>
                <td>lastname <span class="required">*</span></td>
                <td>string</td>
                <td>Customer's last name</td>
            </tr>
            <tr>
                <td>email <span class="required">*</span></td>
                <td>string</td>
                <td>Valid email address</td>
            </tr>
            <tr>
                <td>password <span class="required">*</span></td>
                <td>string</td>
                <td>Password (min 8 characters)</td>
            </tr>
            <tr>
                <td>phone <span class="required">*</span></td>
                <td>string</td>
                <td>Phone number</td>
            </tr>
            <tr>
                <td>useragree <span class="required">*</span></td>
                <td>string</td>
                <td>Terms acceptance (1 for accept)</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/auth/signup') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{
    "firstname": "John",
    "lastname": "Doe",
    "email": "johndoe@example.com",
    "password": "password123",
    "phone": "1234567891",
    "useragree": "1"
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/auth/signup') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        firstname: 'John',
        lastname: 'Doe',
        email: 'johndoe@example.com',
        password: 'password123',
        phone: '1234567891',
        useragree: '1'
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 201,
    "message": "Account created successfully",
    "data": {
        "access_token": "eyJ0eXAiOiJKV1...",
        "customer": {
            "customerid": "57",
            "firstname": "John",
            "lastname": "Doe",
            "email": "johndoe@example.com",
            "cust_phone": "1234567891"
        }
    }
}</div>
    </div>

    <div class="endpoint" id="login">
        <h3><span class="method post">POST</span> /api/v1/auth/login</h3>
        <p>Authenticate a customer and get access token.</p>

        <h4>Request Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>email <span class="required">*</span></td>
                <td>string</td>
                <td>Registered email address</td>
            </tr>
            <tr>
                <td>password <span class="required">*</span></td>
                <td>string</td>
                <td>Account password</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/auth/login') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{
    "email": "johndoe@example.com",
    "password": "password123"
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/auth/login') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        email: 'johndoe@example.com',
        password: 'password123'
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Login successful",
    "data": {
        "access_token": "eyJ0eXAiOiJKV1...",
        "refresh_token": "eyJ0eXAiOiJKV1...",
        "customer": {
            "customerid": "57",
            "customernumber": "0006",
            "firstname": "John",
            "lastname": "Doe",
            "email": "johndoe@example.com"
        }
    }
}</div>
    </div>

    <div class="endpoint" id="forgot-password">
        <h3><span class="method post">POST</span> /api/v1/auth/forgot-password</h3>
        <p>Request a password reset link.</p>

        <h4>Request Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>email <span class="required">*</span></td>
                <td>string</td>
                <td>Registered email address</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/auth/forgot-password') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{
    "email": "johndoe@example.com"
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/auth/forgot-password') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        email: 'johndoe@example.com'
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "If your email exists in our system, you will receive password reset instructions.",
    "data": {
        "email": "johndoe@example.com"
    }
}</div>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/v1/auth/verify-reset-token</h3>
        <p>Verify a password reset token.</p>

        <h4>Query Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>token <span class="required">*</span></td>
                <td>string</td>
                <td>Password reset token received via email</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/auth/verify-reset-token') ?>?token=eyJ0eXAiOiJKV1...' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/auth/verify-reset-token') ?>?token=eyJ0eXAiOiJKV1...', {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})</div>
        </div>
    </div>
</section>