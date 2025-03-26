<h1>Hotel HMS API Documentation</h1>

<section class="section">
    <h2>Overview</h2>
    <p>The Hotel HMS API provides a comprehensive interface for managing hotel room bookings, user accounts, and payment processing. This documentation covers all available endpoints, authentication methods, and best practices for integration.</p>

    <div class="endpoint">
        <h3>Base URL</h3>
        <p class="url"><?= $base_url ?>api/v1</p>
        
        <h3>Authentication</h3>
        <p>Most endpoints require authentication using a Bearer token. After successful authentication, include the token in the Authorization header:</p>
        <div class="code-block">
Authorization: Bearer {your_access_token}</div>
    </div>

    <div class="endpoint">
        <h3>Response Format</h3>
        <p>All API responses follow this standard JSON format:</p>
        <div class="code-block">
{
    "status": boolean,    // true for success, false for failure
    "code": integer,      // HTTP status code
    "message": string,    // Human-readable message
    "data": object|null,  // Response data (if any)
    "timestamp": string   // Server timestamp
}</div>
    </div>

    <div class="endpoint">
        <h3>HTTP Status Codes</h3>
        <table>
            <tr>
                <th>Code</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>200</td>
                <td>Success - The request was successful</td>
            </tr>
            <tr>
                <td>201</td>
                <td>Created - Resource created successfully</td>
            </tr>
            <tr>
                <td>400</td>
                <td>Bad Request - Invalid parameters or request format</td>
            </tr>
            <tr>
                <td>401</td>
                <td>Unauthorized - Authentication required or failed</td>
            </tr>
            <tr>
                <td>404</td>
                <td>Not Found - Resource not found</td>
            </tr>
            <tr>
                <td>409</td>
                <td>Conflict - Resource already exists or state conflict</td>
            </tr>
            <tr>
                <td>500</td>
                <td>Server Error - Internal server error</td>
            </tr>
        </table>
    </div>

    <div class="endpoint">
        <h3>API Flow</h3>
        <p>The typical flow for booking a room involves these steps:</p>
        <ol>
            <li>Search available rooms using the rooms/list endpoint</li>
            <li>Get detailed room information using rooms/details/{roomid}</li>
            <li>Book the room using rooms/book</li>
            <li>Apply promo code (optional) using rooms/verify-promocode</li>
            <li>Create booking with payment using bookings/create</li>
            <li>Verify payment using bookings/verify-payment/{booking_number}</li>
        </ol>
    </div>

    <div class="endpoint">
        <h3>Rate Limiting</h3>
        <p>API requests are limited to protect our servers from excessive use. Current limits are:</p>
        <ul>
            <li>Authentication endpoints: 5 requests per minute</li>
            <li>Search endpoints: 60 requests per minute</li>
            <li>Booking endpoints: 30 requests per minute</li>
        </ul>
    </div>

    <div class="endpoint">
        <h3>Dates and Times</h3>
        <ul>
            <li>All dates should be in YYYY-MM-DD format</li>
            <li>All times are in UTC unless otherwise specified</li>
            <li>Timestamps are returned in the format: YYYY-MM-DD HH:mm:ss</li>
        </ul>
    </div>

    <div class="endpoint">
        <h3>Testing</h3>
        <p>For testing purposes, you can use the following credentials:</p>
        <div class="code-block">
Email: johndoe@example.com
Password: password123
Phone: 1234567891</div>
    </div>
</section>