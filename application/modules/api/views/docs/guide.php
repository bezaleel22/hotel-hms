<h1>Integration Guide</h1>

<section class="section">
    <p>This guide provides a comprehensive overview of the Hotel HMS API endpoints and their proper usage sequence.</p>

    <div class="endpoint">
        <h2>Authentication</h2>
        <div class="note">
            <p><strong>Important:</strong> After successful room booking, you'll receive an authentication token. Include this token in the header of all subsequent requests:</p>
            <div class="code-block">Authorization: Bearer {your_token}</div>
        </div>
    </div>

    <h2>Complete Booking Process Flow</h2>

    <div class="endpoint">
        <h3>Guest Account Handling</h3>
        <div class="description">
            <p>The booking system utilizes a guest account system for handling bookings:</p>
            <ul>
                <li>When a user initiates a booking through <code>/api/v1/rooms/book</code>, a guest account is automatically created using the provided user data (firstname, lastname, email, phone)</li>
                <li>A guest session token is issued, which must be used for authentication in subsequent requests</li>
                <li>This token grants limited permissions specifically for completing the current booking process</li>
                <li>The guest account and session remain valid throughout the booking flow: applying promocodes, checkout, and payment verification</li>
            </ul>
        </div>
    </div>

    <div class="endpoint">
        <h3>Step 1: List All Rooms (Optional)</h3>
        <span class="method get">GET</span> /api/v1/rooms/list
        <div class="description">
            Gets a list of all rooms in the hotel with their details, types, and basic information.
            Use this to browse the complete room catalog regardless of availability.
        </div>
    </div>

    <div class="endpoint">
        <h3>Step 2: Check Room Availability</h3>
        <span class="method get">GET</span> /api/v1/rooms/availability
        <div class="description">
            Searches for available rooms based on your dates and occupancy requirements. Returns only rooms that are available
            for the specified period and can accommodate your group size.
        </div>
        <h4>Query Parameters:</h4>
        <div class="code-block">
            {
            "checkin": "YYYY-MM-DD",
            "checkout": "YYYY-MM-DD",
            "adults": "number",
            "children": "number"
            }</div>
        <p>Returns a list of available rooms with their details and <code>roomid</code>.</p>
    </div>

    <div class="endpoint">
        <h3>Step 3: Get Room Details</h3>
        <span class="method get">GET</span> /api/v1/rooms/details/{roomid}
        <div class="description">
            Retrieves detailed information about a specific room including complete amenities, policies,
            high-resolution images, and real-time availability. This step is mandatory before proceeding with booking
            to ensure you have all necessary room information.
        </div>
        <h4>Query Parameters:</h4>
        <div class="code-block">
            {
            "checkin": "YYYY-MM-DD",
            "checkout": "YYYY-MM-DD"
            }</div>
    </div>

    <div class="endpoint">
        <h3>Step 4: Book Room</h3>
        <span class="method post">POST</span> /api/v1/rooms/book
        <div class="description">
            Initiates the room booking process by creating a preliminary booking record. User data (firstname, lastname, email, phone)
            must be sent alongside the booking details. The response will include an authentication token that must be used for all
            subsequent requests. This must be done before applying any promo codes or proceeding with payment.
        </div>
        <h4>Request Body:</h4>
        <div class="code-block">
            {
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
            }</div>
    </div>

    <div class="endpoint">
        <h3>Step 5: Apply Promo Code (Optional)</h3>
        <span class="method post">POST</span> /api/v1/rooms/verify-promocode
        <div class="description">
            Validates and applies a promotion code to the booking. If valid, the code will be stored
            with the booking and the discount will be applied during checkout.
        </div>
        <h4>Headers Required:</h4>
        <div class="code-block">Authorization: Bearer {token}</div>
        <h4>Request Body:</h4>
        <div class="code-block">
            {
            "roomid": "your_selected_room_id",
            "promocode": "DISCOUNT123"
            }</div>
    </div>

    <div class="endpoint">
        <h3>Step 6: Checkout Booking</h3>
        <span class="method post">POST</span> /api/v1/bookings/checkout
        <div class="description">
            Creates the official booking record and initiates the payment process. This endpoint finalizes booking
            details including room rate, taxes, applicable discounts, and generates a unique booking number.
        </div>
        <h4>Headers Required:</h4>
        <div class="code-block">Authorization: Bearer {token}</div>
        <h4>Request Body:</h4>
        <div class="code-block">
            {
            "callback_url": "https://your-domain.com/payment-callback",
            "pmethod": "7",
            "roomid": "1",
            "checkin": "2025-04-01",
            "checkout": "2025-04-03",
            "fullName": "John Doe"
            }</div>
        <p><strong>Response:</strong> Contains <code>booking_number</code> and payment URL. Redirect user to the payment URL to complete payment.</p>
    </div>

    <div class="endpoint">
        <h3>Step 7: Payment Verification</h3>
        <span class="method get">GET</span> /api/v1/bookings/verify-payment/{booking_number}
        <div class="description">
            Confirms the payment status and completes the booking process. This endpoint should be called after
            the payment provider redirects to your callback URL.
        </div>
        <div class="note">
            <p>You should implement the callback URL endpoint in your application to handle the payment
                provider's redirect and then call this verification endpoint to complete the booking process.</p>
        </div>
        <h4>Headers Required:</h4>
        <div class="code-block">Authorization: Bearer {token}</div>
    </div>

    <h2>Important Notes</h2>
    <div class="endpoint">
        <ul>
            <li>The /rooms/list endpoint shows all rooms regardless of availability</li>
            <li>Use /rooms/availability to find rooms available for specific dates</li>
            <li>Room details must be retrieved before proceeding with booking</li>
            <li>When booking a room, user data is required to create a guest account</li>
            <li>The guest account session token is provided in the booking response</li>
            <li>All subsequent requests (promocode, checkout, payment verification) require this token in the Authorization header</li>
            <li>Store the <code>roomid</code>, <code>booking_number</code>, and guest session <code>token</code> throughout the booking process</li>
            <li>Follow the sequence: list/search rooms → book room → apply promocode (optional) → checkout → verify payment</li>
            <li>The booking is not confirmed until payment verification is completed</li>
        </ul>
    </div>
</section>