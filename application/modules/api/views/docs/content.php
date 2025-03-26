<h1>Content Management</h1>

<section class="section">
    <p>Endpoints for retrieving content such as home page data, about page, gallery, privacy policy, and terms.</p>

    <div class="endpoint" id="home">
        <h3><span class="method get">GET</span> /api/v1/content/home</h3>
        <p>Retrieve home page content including sliders, banners, and offers.</p>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/content/home') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/content/home') ?>', {
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
    "message": "Home content retrieved successfully",
    "data": {
        "title": "Welcome to our Hotels",
        "slider_info": [...],
        "banner_homemiddle": [...],
        "banner_topweek": [...],
        "banner_destination": [...],
        "room_offers": []
    }
}</div>
    </div>

    <div class="endpoint" id="about">
        <h3><span class="method get">GET</span> /api/v1/content/about</h3>
        <p>Retrieve about page content including team information and company details.</p>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/content/about') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/content/about') ?>', {
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
    "message": "About page content retrieved successfully",
    "data": {
        "title": "About Our Hotels",
        "team_info": [...],
        "company": [...],
        "about_smallbig": [...]
    }
}</div>
    </div>

    <div class="endpoint" id="gallery">
        <h3><span class="method get">GET</span> /api/v1/content/gallery</h3>
        <p>Retrieve gallery content including room types and images.</p>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/content/gallery') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/content/gallery') ?>', {
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
    "message": "Gallery content retrieved successfully",
    "data": {
        "title": "Our Gallerys",
        "gallery_types": [...],
        "galleries": [...]
    }
}</div>
    </div>

    <div class="endpoint" id="privacy">
        <h3><span class="method get">GET</span> /api/v1/content/privacy</h3>
        <p>Retrieve privacy policy content.</p>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/content/privacy') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/content/privacy') ?>', {
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
    "message": "Privacy policy retrieved successfully",
    "data": {
        "title": "Privacy Policy",
        "content": "..."
    }
}</div>
    </div>

    <div class="endpoint" id="terms">
        <h3><span class="method get">GET</span> /api/v1/content/terms</h3>
        <p>Retrieve terms and conditions content.</p>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X GET '<?= base_url('api/v1/content/terms') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/content/terms') ?>', {
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
    "message": "Terms and conditions retrieved successfully",
    "data": {
        "title": "Our Terms & Condition",
        "content": "..."
    }
}</div>
    </div>

    <div class="endpoint" id="contact">
        <h3><span class="method post">POST</span> /api/v1/content/contact</h3>
        <p>Submit a contact form message.</p>

        <h4>Request Parameters</h4>
        <table>
            <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>name <span class="required">*</span></td>
                <td>string</td>
                <td>Full name of the sender</td>
            </tr>
            <tr>
                <td>email <span class="required">*</span></td>
                <td>string</td>
                <td>Email address</td>
            </tr>
            <tr>
                <td>phone <span class="required">*</span></td>
                <td>string</td>
                <td>Contact phone number</td>
            </tr>
            <tr>
                <td>subject <span class="required">*</span></td>
                <td>string</td>
                <td>Message subject</td>
            </tr>
            <tr>
                <td>message <span class="required">*</span></td>
                <td>string</td>
                <td>Message content</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/content/contact') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{
    "name": "John Smith",
    "email": "john.smith@example.com",
    "phone": "1234567890",
    "subject": "Room Inquiry",
    "message": "I would like to know more about your deluxe rooms."
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/content/contact') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        name: 'John Smith',
        email: 'john.smith@example.com',
        phone: '1234567890',
        subject: 'Room Inquiry',
        message: 'I would like to know more about your deluxe rooms.'
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Contact message submitted successfully",
    "data": {
        "email_sent": true
    }
}</div>
    </div>

    <div class="endpoint" id="subscribe">
        <h3><span class="method post">POST</span> /api/v1/content/subscribe</h3>
        <p>Subscribe to newsletter.</p>

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
                <td>Email address to subscribe</td>
            </tr>
            <tr>
                <td>name <span class="required">*</span></td>
                <td>string</td>
                <td>Subscriber's name</td>
            </tr>
        </table>

        <div class="code-tabs">
            <div class="code-tab active">cURL</div>
            <div class="code-tab">JavaScript</div>
        </div>
        <div class="code-block">
            <div class="code-content curl-code">curl -X POST '<?= base_url('api/v1/content/subscribe') ?>' \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{
    "email": "subscriber@example.com",
    "name": "Jane Doe"
}'</div>
            <div class="code-content javascript-code">fetch('<?= base_url('api/v1/content/subscribe') ?>', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        email: 'subscriber@example.com',
        name: 'Jane Doe'
    })
})</div>
        </div>

        <h4>Response</h4>
        <div class="code-block">
{
    "status": true,
    "code": 200,
    "message": "Thank you for subscribing! A confirmation email has been sent.",
    "data": {
        "email_sent": true
    }
}</div>
    </div>
</section>