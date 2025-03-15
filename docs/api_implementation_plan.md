# REST API Implementation Plan - Hotel Management System

> **Note**: For details on the HMVC architecture and module system, see [Architecture Documentation](architecture.md)

## Overview

### REST API Module

The API will be implemented as a new module following the system's HMVC pattern:

1. Module Location: `application/modules/api/`
2. Routing: All API endpoints under `/api/v1/`
3. Response Format: JSON with standardized structure
4. Authentication: JWT-based with existing user system
5. Documentation: OpenAPI 3.0 specification

This modular approach ensures:

- Clean separation of concerns
- Consistent code organization
- Easy maintenance and updates
- Reusable components
- Scalable architecture
- Standardized module structure
- Simple integration process

### Module Structure & Implementation

```
application/
└── modules/
    └── api/                    # REST API module
        ├── controllers/        # API endpoint handlers
        │   ├── Room.php       # Room management endpoints
        │   ├── Booking.php    # Booking operations
        │   ├── Customer.php   # Customer management
        │   └── Docs.php       # API documentation
        ├── models/            # Data access layer
        │   ├── Room_model.php
        │   ├── Booking_model.php
        │   └── Customer_model.php
        ├── libraries/         # Shared components
        │   ├── api_handler.php   # Base controller
        │   ├── JWT_handler.php      # JWT processing
        │   └── Response.php         # Response formatting
        └── config/           # Module configuration
            ├── config.php    # Basic settings
            ├── routes.php    # API routes
            └── auth.php      # Security settings
```

### Module Configuration

```php
// application/modules/api/config/config.php
$HmvcConfig['api'] = [
    'packageName' => 'Api',
    '_title' => 'REST API',
    '_description' => 'API for front-end integration',
    '_version' => '1.0',
    'routePrefix' => 'api/v1'
];

// application/modules/api/config/auth.php
$config['jwt_key'] = getenv('JWT_SECRET_KEY');
$config['jwt_timeout'] = 3600; // 1 hour
$config['rate_limit'] = 100;   // requests per minute

// application/modules/api/config/routes.php
$route['api/v1/rooms']['GET'] = 'room/list';
$route['api/v1/rooms/(:num)']['GET'] = 'room/details/$1';
$route['api/v1/bookings']['POST'] = 'booking/create';
```

### Base Components

```php
// application/modules/api/libraries/api_handler.php
class api_handler extends MX_Controller {
    protected function send_response($data, $code = 200) {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($code)
            ->set_output(json_encode([
                'status' => $code < 300,
                'data' => $data
            ]));
    }

    protected function validate_token() {
        $token = $this->input->get_request_header('Authorization');
        // JWT validation logic
    }
}

// application/modules/api/libraries/Response.php
class Response {
    public static function format($data, $message = '') {
        return [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
    }
}
```

### Security Components

```php
// application/modules/api/libraries/JWT_handler.php
class JWT_handler {
    public function generate_token($user_data) {
        $time = time();
        $payload = [
            'iat' => $time,
            'exp' => $time + $this->config->item('jwt_timeout'),
            'user' => $user_data
        ];
        return JWT::encode($payload, $this->config->item('jwt_key'));
    }
}

// application/modules/api/libraries/Rate_limiter.php
class Rate_limiter {
    public function check_limit($api_key) {
        $requests = $this->get_request_count($api_key);
        $limit = $this->config->item('rate_limit');
        return $requests < $limit;
    }
}
```

### Test Configuration

```php
// application/modules/api/tests/TestCase.php
class ApiTestCase extends CI_TestCase {
    protected function setUp() {
        $this->reset_test_db();
        $this->load_test_helpers();
    }

    protected function generate_test_token() {
        return $this->jwt_handler->generate_token([
            'id' => 1,
            'role' => 'test_user'
        ]);
    }

    protected function create_test_request($method, $endpoint, $data = []) {
        return $this->request($method, "/api/v1/{$endpoint}", [
            'Authorization' => "Bearer " . $this->generate_test_token(),
            'Content-Type' => 'application/json',
            'body' => json_encode($data)
        ]);
    }
}
```

### API Test Helpers

```php
// application/modules/api/tests/helpers/api_test_helper.php
function create_test_booking() {
    return [
        'room_id' => 1,
        'checkin' => '2024-03-01',
        'checkout' => '2024-03-05',
        'customer_id' => 1
    ];
}

function verify_json_response($response) {
    expect($response)->toHaveStatus(200);
    expect($response->getHeader('Content-Type'))
        ->toContain('application/json');
    expect($response->getData())->toHaveKey('status');
}
```

## 1. Front-end Website Analysis

### 1.1 Core Functionalities to Expose via API

1. Room Management
   - Room listing and search
   - Room details and availability checking
   - Room types and facilities
2. Booking Management

   - Create booking
   - Check booking status
   - Cancel/modify booking
   - Payment processing

3. Customer Management
   - Registration
   - Authentication
   - Profile management
   - Booking history

### 1.2 Database Schema & Relationships

1. Website Configuration & Content

```sql
common_setting: Base configuration
setting: Site settings, currency, etc
currency: Currency settings
page_title: Page metadata and static pages

tbl_slider:
  - slid (PK)
  - title
  - subtitle
  - image
  - Sltypeid (content type: home/about/gallery)
  - delation_status

subscribe_emaillist:
  - id (PK)
  - email
  - dateinsert

contact_messages:
  - id (PK)
  - name
  - email
  - phone
  - message
  - created_at
```

2. Room Management

```sql
roomdetails:
  - roomid (PK)
  - roomtype
  - rate
  - description

room_image:
  - room_id (FK)
  - room_imagename

tbl_roomnofloorassign:
  - roomid (FK)
  - roomno
  - status
```

3. Booking System

```sql
booked_info:
  - bookedid (PK)
  - booking_number
  - roomid (FK)
  - cutomerid (FK)
  - checkindate
  - checkoutdate
  - total_price
  - paid_amount
  - bookingstatus

booked_details:
  - bookedid (FK)
  - payment_method
  - advance_amount

tbl_guestpayments:
  - payid (PK)
  - bookedid (FK)
  - paymenttype
  - paymentamount
```

4. Customer Management

```sql
customerinfo:
  - customerid (PK)
  - firstname
  - lastname
  - email
  - pass
  - cust_phone
  - address
  - balance

acc_coa:
  - HeadCode
  - HeadName
  - customerid (FK)
```

5. Payment System

```sql
payment_method:
  - payment_method_id (PK)
  - payment_method
  - is_active

paymentsetup:
  - paymentid
  - marchantid
  - currency
```

6. Promotions

```sql
promocode:
  - promocode
  - discount
  - status
  - roomid (FK)
  - startdate
  - enddate
```

## 2. Module Structure

Following reports module pattern, create api module in `application/modules/api`:

```
api/
├── config/
│   ├── config.php         # Module configuration
│   ├── menu.php          # Menu integration
│   └── routes.php        # API routes
├── controllers/
│   ├── Room.php         # Room endpoints
│   ├── Booking.php      # Booking endpoints
│   └── Customer.php     # Customer endpoints
├── models/
│   ├── Room_model.php
│   ├── Booking_model.php
│   └── Customer_model.php
└── libraries/
    └── Api_response.php  # Response formatting
```

### 2.1 Module Configuration

```php
// config.php
$HmvcConfig['api']["_title"]     = "REST API";
$HmvcConfig['api']["_description"] = "REST API for Hotel Management System";

$HmvcConfig['api']['_database'] = false;
```

### 2.2 Menu Configuration

```php
// menu.php
$HmvcMenu["api"] = array(
    "icon" => "<i class='fa fa-exchange'></i>",
    "api_documentation" => array(
        "controller" => "documentation",
        "method"     => "index",
        "url"        => "api/docs",
        "permission" => "read"
    )
);
```

## 3. API Endpoints

### 3.1 Room Management

```
GET /api/v1/rooms
Parameters:
- checkin: Check-in date
- checkout: Check-out date
- adults: Number of adults
- children: Number of children
- type: Room type

GET /api/v1/rooms/{id}
- Get detailed room information

GET /api/v1/rooms/availability
Parameters:
- room_id: Room ID
- checkin: Check-in date
- checkout: Check-out date
```

### 3.2 Booking Management

```
POST /api/v1/bookings
Request Body:
{
    "room_id": "1",
    "checkin": "2024-03-01",
    "checkout": "2024-03-05",
    "adults": 2,
    "children": 1,
    "customer_id": "123",
    "special_requests": "..."
}

GET /api/v1/bookings/{id}
- Get booking details

PUT /api/v1/bookings/{id}
- Update booking status

DELETE /api/v1/bookings/{id}
- Cancel booking
```

### 3.3 Customer Management

```
POST /api/v1/customers/register
POST /api/v1/customers/login
GET /api/v1/customers/profile
PUT /api/v1/customers/profile
GET /api/v1/customers/bookings
POST /api/v1/customers/forgot-password
POST /api/v1/customers/reset-password
```

### 3.4 Content & Communication

```
# Static Content
GET /api/v1/content/home
- Get homepage content
- Tables: tbl_slider, setting

GET /api/v1/content/about
- Get about page content
- Tables: tbl_slider

GET /api/v1/content/gallery
- Get image gallery
- Parameters: type (optional)
- Tables: tbl_slider

GET /api/v1/content/pages/{slug}
- Get static pages (privacy, terms, etc)
- Table: page_title

# Contact & Communication
POST /api/v1/contact
Request:
{
    "name": "string",
    "email": "string",
    "phone": "string",
    "message": "string"
}

POST /api/v1/subscribe
Request:
{
    "email": "string"
}
- Subscribe to newsletter
- Table: subscribe_emaillist
```

### 3.5 Payment & Configuration

```
# Payment Processing
POST /api/v1/payments/process
- Process payment through selected gateway
- Tables: tbl_guestpayments, payment_method
- Supports multiple payment gateways (PayPal, Stripe, etc)

GET /api/v1/payments/methods
- List available payment methods
- Table: payment_method

POST /api/v1/payments/verify/{booking_id}
- Verify payment status
- Update booking payment status

# Promo Codes
POST /api/v1/promocodes/validate
- Validate promo code
- Check code availability and expiry
- Calculate discount amount
- Tables: promocode

# Configuration
GET /api/v1/config/settings
- Get website settings
- Tables: setting, common_setting

GET /api/v1/config/languages
- Get available languages
- Table: setting

GET /api/v1/config/currency
- Get currency settings
- Table: currency
```

### 3.5 API Documentation

```
GET /api/v1/docs
- Returns OpenAPI 3.0 specification
- Includes detailed endpoint documentation
- Shows request/response examples

GET /api/v1/docs/ui
- Serves Swagger UI interface
- Interactive API documentation
- Allows testing endpoints
```

Example OpenAPI Documentation Controller:

```php
class Documentation extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
    }

    // GET /api/v1/docs
    public function index_get() {
        $spec = $this->generate_openapi_spec();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($spec));
    }

    // GET /api/v1/docs/ui
    public function ui_get() {
        $data['spec_url'] = base_url('api/v1/docs');
        $this->load->view('api/documentation', $data);
    }

    private function generate_openapi_spec() {
        return [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'Hotel Management System API',
                'version' => '1.0.0',
                'description' => 'REST API for hotel room booking and management'
            ],
            'servers' => [
                ['url' => base_url('api/v1')]
            ],
            'paths' => [
                '/rooms' => [
                    'get' => [
                        'summary' => 'List all rooms',
                        'parameters' => [
                            [
                                'name' => 'checkin',
                                'in' => 'query',
                                'required' => true,
                                'schema' => ['type' => 'string', 'format' => 'date']
                            ],
                            // Additional parameters...
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Successful response',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/RoomList']
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
                // Additional endpoints...
            ],
            'components' => [
                'schemas' => [
                    'Room' => [
                        'type' => 'object',
                        'properties' => [
                            'roomid' => ['type' => 'integer'],
                            'roomtype' => ['type' => 'string'],
                            'rate' => ['type' => 'number']
                        ]
                    ],
                    // Additional schemas...
                ]
            ]
        ];
    }
}
```

## 4. Implementation Details

### 4.1 Room Controller

```php
class Room extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('room_model');
    }

    // GET /api/v1/rooms
    public function index_get() {
        $filters = $this->input->get();
        $rooms = $this->room_model->get_rooms($filters);
        $this->api_handler->send_response($rooms);
    }

    // GET /api/v1/rooms/{id}
    public function details_get($id) {
        $room = $this->room_model->get_room_details($id);
        $this->api_handler->send_response($room);
    }

    // GET /api/v1/rooms/availability
    public function availability_get() {
        $room_id = $this->input->get('room_id');
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');

        $availability = $this->room_model->check_availability(
            $room_id,
            $checkin,
            $checkout
        );

        $this->api_handler->send_response($availability);
    }
}
```

### 4.2 Room Model

```php
class Room_model extends CI_Model {
    public function get_rooms($filters = array()) {
        $this->db->select('roomdetails.*, room_image.room_imagename');
        $this->db->from('roomdetails');
        $this->db->join('room_image', 'room_image.room_id=roomdetails.roomid', 'left');

        if (!empty($filters['checkin']) && !empty($filters['checkout'])) {
            // Apply availability filtering
        }

        return $this->db->get()->result();
    }

    public function check_availability($room_id, $checkin, $checkout) {
        // Implement existing availability logic from Hotel.php
        $status = "bookingstatus!=1 AND bookingstatus!=5";
        $exits = $this->db->select("*")
            ->from('booked_info')
            ->where('checkindate<=', $checkin)
            ->where('checkoutdate>', $checkin)
            ->where($status)
            ->get()
            ->result();

        // Additional availability checks
        return $availability_result;
    }
}
```

## 5. Security Implementation

### 5.1 Authentication

```php
class Auth extends MX_Controller {
    public function validate_token() {
        $token = $this->input->get_request_header('Authorization');
        if (!$token) {
            $this->api_handler->send_error('Unauthorized', 401);
        }

        // Validate JWT token
        try {
            $decoded = JWT::decode($token, $this->config->item('jwt_key'));
            return $decoded;
        } catch (Exception $e) {
            $this->api_handler->send_error('Invalid token', 401);
        }
    }
}
```

### 5.2 Request Validation

```php
// Room search validation
$this->form_validation->set_rules('checkin', 'Check-in date', 'required|valid_date');
$this->form_validation->set_rules('checkout', 'Check-out date', 'required|valid_date');

// Booking creation validation
$this->form_validation->set_rules('room_id', 'Room ID', 'required|numeric');
$this->form_validation->set_rules('checkin', 'Check-in date', 'required|valid_date');
```

## 6. Test-Driven Development Strategy

### 6.1 TDD Approach

```php
// For each endpoint, follow this TDD cycle:
1. Write failing test
2. Implement minimum code to pass
3. Refactor while keeping tests green

// Example TDD cycle for room availability:
class RoomAvailabilityTest extends TestCase {
    public function test_should_return_404_for_nonexistent_room() {
        $response = $this->get('/api/v1/rooms/999/availability');
        $this->assertEquals(404, $response->status);
    }

    public function test_should_validate_date_parameters() {
        $response = $this->get('/api/v1/rooms/1/availability', [
            'checkin' => 'invalid-date'
        ]);
        $this->assertEquals(400, $response->status);
    }

    public function test_should_check_room_availability() {
        // Arrange
        $this->createTestRoom();
        $this->createTestBooking();

        // Act
        $response = $this->get('/api/v1/rooms/1/availability', [
            'checkin' => '2024-03-01',
            'checkout' => '2024-03-05'
        ]);

        // Assert
        $this->assertEquals(200, $response->status);
        $this->assertArrayHasKey('is_available', $response->data);
    }
}
```

### 6.2 Test Coverage Requirements

1. Unit Tests (100% coverage)

- Database models
- Business logic
- Validation rules
- Helper functions

2. Integration Tests

- Complete booking flow
- Payment processing
- Email notifications
- Multi-language support

3. API Tests

- Endpoint responses
- Authentication
- Rate limiting
- Error handling

4. Frontend Integration

- API client usage
- Error handling
- Loading states

### 6.3 Example API Responses

#### Room Responses

```json
{
  "status": true,
  "data": [
    {
      "roomid": 1,
      "roomtype": "Deluxe",
      "rate": 150.0,
      "description": "Luxury room with sea view",
      "images": [
        {
          "room_imagename": "deluxe_1.jpg"
        }
      ],
      "availability": true
    }
  ],
  "meta": {
    "total": 10,
    "page": 1
  }
}
```

#### Booking Responses

```json
{
  "status": true,
  "data": {
    "booking_number": "BK20240301001",
    "total_amount": 600.0,
    "discount": 60.0,
    "net_amount": 540.0,
    "payment_url": "https://...",
    "room_details": {
      "room_no": "101",
      "checkin": "2024-03-01",
      "checkout": "2024-03-05"
    }
  }
}
```

#### Payment Responses

```json
{
  "status": true,
  "data": {
    "transaction_id": "TRX123456",
    "amount_paid": 540.0,
    "payment_status": "completed",
    "payment_method": "stripe",
    "receipt_url": "https://..."
  }
}
```

#### Content Responses

```json
// GET /api/v1/content/home
{
    "status": true,
    "data": {
        "sliders": [{
            "title": "Welcome to Our Hotel",
            "subtitle": "Luxury Stays at Affordable Prices",
            "image": "slider1.jpg"
        }],
        "featured_rooms": [...],
        "special_offers": [...],
        "about_section": {
            "title": "About Us",
            "content": "..."
        }
    }
}

// GET /api/v1/content/gallery
{
    "status": true,
    "data": {
        "categories": ["Rooms", "Restaurant", "Facilities"],
        "images": [{
            "title": "Deluxe Room",
            "category": "Rooms",
            "image": "deluxe1.jpg",
            "description": "..."
        }]
    }
}

// POST /api/v1/contact Response
{
    "status": true,
    "message": "Message sent successfully",
    "data": {
        "reference": "MSG123456",
        "email_sent": true
    }
}

// POST /api/v1/subscribe Response
{
    "status": true,
    "message": "Successfully subscribed to newsletter",
    "data": {
        "email": "user@example.com",
        "subscription_date": "2024-03-01"
    }
}
```

#### Configuration Responses

```json
{
  "status": true,
  "data": {
    "title": "Hotel Name",
    "address": "Hotel Address",
    "email": "contact@hotel.com",
    "phone": "+1234567890",
    "currency": "USD",
    "timezone": "UTC+1",
    "booking_settings": {
      "min_advance_days": 1,
      "max_advance_days": 90
    }
  }
}
```
