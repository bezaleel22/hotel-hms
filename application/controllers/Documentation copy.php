<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documentation extends MX_Controller
{
    private $test_examples = [];

    public function __construct()
    {
        parent::__construct();
        $this->load_test_examples();
    }

    /**
     * Load and parse test examples from log files
     */
    private function load_test_examples()
    {
        // Parse test log file
        $log_file = APPPATH . 'modules/api/tests/logs/api_tests.log';
        if (file_exists($log_file)) {
            $content = file_get_contents($log_file);
            $entries = explode('-------------------------------------------', $content);

            foreach ($entries as $entry) {
                if (preg_match('/\[(.*?)\] (GET|POST|PUT|DELETE) (\/.*?)\n/', $entry, $matches)) {
                    $timestamp = $matches[1];
                    $method = $matches[2];
                    $endpoint = $matches[3];

                    // Extract response
                    if (preg_match('/Response: ({.*})/s', $entry, $response_matches)) {
                        $response = json_decode($response_matches[1], true);

                        // Extract curl command if present
                        $curl_command = '';
                        if (preg_match('/Debug: Executing command: (curl.*?)\n/s', $entry, $curl_matches)) {
                            $curl_command = $curl_matches[1];
                        }

                        $this->test_examples[$method][$endpoint] = [
                            'curl' => $curl_command,
                            'response' => $response
                        ];
                    }
                }
            }
        }
    }

    /**
     * Generate OpenAPI paths with examples
     */
    private function get_paths()
    {
        return [
            '/' => [
                'get' => [
                    'tags' => ['General'],
                    'summary' => 'API information',
                    'responses' => [
                        '200' => [
                            'description' => 'API version and endpoints information',
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'version' => ['type' => 'string'],
                                            'documentation' => ['type' => 'string'],
                                            'endpoints' => ['type' => 'object']
                                        ]
                                    ],
                                    'example' => $this->test_examples['GET']['/']['response'] ?? null
                                ]
                            ]
                        ]
                    ],
                    'x-curl-example' => $this->test_examples['GET']['/']['curl'] ?? null
                ]
            ],

            // Content routes
            '/content/home' => [
                'get' => [
                    'tags' => ['Content'],
                    'summary' => 'Get home page content',
                    'responses' => [
                        '200' => [
                            'description' => 'Home page content including sliders and settings',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/ContentResponse'],
                                    'example' => $this->test_examples['GET']['/content/home']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/content/about' => [
                'get' => [
                    'tags' => ['Content'],
                    'summary' => 'Get about page content',
                    'responses' => [
                        '200' => [
                            'description' => 'About page content',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/ContentResponse'],
                                    'example' => $this->test_examples['GET']['/content/about']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/content/gallery' => [
                'get' => [
                    'tags' => ['Content'],
                    'summary' => 'Get gallery images',
                    'responses' => [
                        '200' => [
                            'description' => 'Gallery images',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/GalleryResponse'],
                                    'example' => $this->test_examples['GET']['/content/gallery']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/content/pages/{slug}' => [
                'get' => [
                    'tags' => ['Content'],
                    'summary' => 'Get specific page content',
                    'parameters' => [
                        [
                            'name' => 'slug',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'string']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Page content',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/PageResponse'],
                                    'example' => $this->test_examples['GET']['/content/pages/about-us']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],

            // Room routes
            '/rooms' => [
                'get' => [
                    'tags' => ['Rooms'],
                    'summary' => 'List all rooms',
                    'parameters' => [
                        [
                            'name' => 'checkin',
                            'in' => 'query',
                            'schema' => ['type' => 'string', 'format' => 'date']
                        ],
                        [
                            'name' => 'checkout',
                            'in' => 'query',
                            'schema' => ['type' => 'string', 'format' => 'date']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'List of rooms',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/RoomList'],
                                    'example' => $this->test_examples['GET']['/rooms']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/rooms/{id}' => [
                'get' => [
                    'tags' => ['Rooms'],
                    'summary' => 'Get room details',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Room details',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/Room'],
                                    'example' => $this->test_examples['GET']['/rooms/1']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/rooms/availability' => [
                'get' => [
                    'tags' => ['Rooms'],
                    'summary' => 'Check room availability',
                    'parameters' => [
                        [
                            'name' => 'checkin',
                            'in' => 'query',
                            'required' => true,
                            'schema' => ['type' => 'string', 'format' => 'date']
                        ],
                        [
                            'name' => 'checkout',
                            'in' => 'query',
                            'required' => true,
                            'schema' => ['type' => 'string', 'format' => 'date']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Available rooms',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/AvailabilityResponse'],
                                    'example' => $this->test_examples['GET']['/rooms/availability']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],

            // Booking routes
            '/bookings' => [
                'post' => [
                    'tags' => ['Bookings'],
                    'summary' => 'Create new booking',
                    'security' => [['Bearer' => []]],
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/BookingRequest'],
                                'example' => [
                                    "room_id" => 1,
                                    "checkin" => date('Y-m-d', strtotime('+1 day')),
                                    "checkout" => date('Y-m-d', strtotime('+3 days')),
                                    "adults" => 2,
                                    "children" => 0,
                                    "special_requests" => "None"
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '201' => [
                            'description' => 'Booking created',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/BookingResponse'],
                                    'example' => $this->test_examples['POST']['/bookings']['response'] ?? null
                                ]
                            ]
                        ]
                    ],
                    'x-codeSamples' => [
                        [
                            'lang' => 'curl',
                            'source' => $this->test_examples['POST']['/bookings']['curl'] ?? null
                        ]
                    ]
                ]
            ],
            '/bookings/{id}' => [
                'get' => [
                    'tags' => ['Bookings'],
                    'summary' => 'Get booking details',
                    'security' => [['Bearer' => []]],
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Booking details',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/BookingResponse'],
                                    'example' => $this->test_examples['GET']['/bookings/1']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ],
                'put' => [
                    'tags' => ['Bookings'],
                    'summary' => 'Update booking',
                    'security' => [['Bearer' => []]],
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/BookingRequest']
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Booking updated',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/BookingResponse'],
                                    'example' => $this->test_examples['PUT']['/bookings/1']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ],
                'delete' => [
                    'tags' => ['Bookings'],
                    'summary' => 'Cancel booking',
                    'security' => [['Bearer' => []]],
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Booking cancelled',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => $this->test_examples['DELETE']['/bookings/1']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],

            // Contact routes
            '/contact' => [
                'post' => [
                    'tags' => ['Contact'],
                    'summary' => 'Submit contact form',
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/ContactRequest'],
                                'example' => [
                                    "name" => "Test User",
                                    "email" => "test@example.com",
                                    "phone" => "1234567890",
                                    "message" => "Test message"
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Contact form submitted',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => $this->test_examples['POST']['/contact']['response'] ?? null
                                ]
                            ]
                        ]
                    ],
                    'x-codeSamples' => [
                        [
                            'lang' => 'curl',
                            'source' => $this->test_examples['POST']['/contact']['curl'] ?? null
                        ]
                    ]
                ]
            ],
            '/subscribe' => [
                'post' => [
                    'tags' => ['Contact'],
                    'summary' => 'Subscribe to newsletter',
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/SubscribeRequest'],
                                'example' => [
                                    "email" => "test_" . time() . "@example.com"
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Subscription successful',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => $this->test_examples['POST']['/subscribe']['response'] ?? null
                                ]
                            ]
                        ]
                    ],
                    'x-codeSamples' => [
                        [
                            'lang' => 'curl',
                            'source' => $this->test_examples['POST']['/subscribe']['curl'] ?? null
                        ]
                    ]
                ]
            ],

            // Payment routes
            '/payments/methods' => [
                'get' => [
                    'tags' => ['Payments'],
                    'summary' => 'Get available payment methods',
                    'security' => [['Bearer' => []]],
                    'responses' => [
                        '200' => [
                            'description' => 'List of payment methods',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/PaymentMethodsResponse'],
                                    'example' => $this->test_examples['GET']['/payments/methods']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/payments/process' => [
                'post' => [
                    'tags' => ['Payments'],
                    'summary' => 'Process payment',
                    'security' => [['Bearer' => []]],
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/PaymentRequest']
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Payment processed',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/PaymentResponse'],
                                    'example' => $this->test_examples['POST']['/payments/process']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/payments/verify/{booking_id}' => [
                'post' => [
                    'tags' => ['Payments'],
                    'summary' => 'Verify payment status',
                    'security' => [['Bearer' => []]],
                    'parameters' => [
                        [
                            'name' => 'booking_id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Payment verification result',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/PaymentVerificationResponse'],
                                    'example' => $this->test_examples['POST']['/payments/verify/1']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],

            // Configuration routes
            '/config/settings' => [
                'get' => [
                    'tags' => ['Configuration'],
                    'summary' => 'Get website settings',
                    'responses' => [
                        '200' => [
                            'description' => 'Website settings',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SettingsResponse'],
                                    'example' => $this->test_examples['GET']['/config/settings']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/config/languages' => [
                'get' => [
                    'tags' => ['Configuration'],
                    'summary' => 'Get available languages',
                    'responses' => [
                        '200' => [
                            'description' => 'List of languages',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/LanguagesResponse'],
                                    'example' => $this->test_examples['GET']['/config/languages']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/config/currency' => [
                'get' => [
                    'tags' => ['Configuration'],
                    'summary' => 'Get currency settings',
                    'responses' => [
                        '200' => [
                            'description' => 'Currency settings',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/CurrencyResponse'],
                                    'example' => $this->test_examples['GET']['/config/currency']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],

            // Authentication routes
            '/auth/signup' => [
                'post' => [
                    'tags' => ['Authentication'],
                    'summary' => 'Register a new customer',
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/SignupRequest'],
                                'example' => [
                                    "email" => "test@example.com",
                                    "password" => "test123",
                                    "firstname" => "Test",
                                    "lastname" => "User",
                                    "phone" => "1234567890"
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '201' => [
                            'description' => 'Customer registered successfully',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => $this->test_examples['POST']['/auth/signup']['response'] ?? null
                                ]
                            ]
                        ]
                    ],
                    'x-codeSamples' => [
                        [
                            'lang' => 'curl',
                            'source' => $this->test_examples['POST']['/auth/signup']['curl'] ?? null
                        ]
                    ]
                ]
            ],
            '/auth/login' => [
                'post' => [
                    'tags' => ['Authentication'],
                    'summary' => 'Customer login',
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/LoginRequest'],
                                'example' => [
                                    "email" => "test@example.com",
                                    "password" => "test123"
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Login successful',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/LoginResponse'],
                                    'example' => $this->test_examples['POST']['/auth/login']['response'] ?? null
                                ]
                            ]
                        ]
                    ],
                    'x-codeSamples' => [
                        [
                            'lang' => 'curl',
                            'source' => $this->test_examples['POST']['/auth/login']['curl'] ?? null
                        ]
                    ]
                ]
            ],
            '/auth/logout' => [
                'post' => [
                    'tags' => ['Authentication'],
                    'summary' => 'Customer logout',
                    'security' => [['Bearer' => []]],
                    'responses' => [
                        '200' => [
                            'description' => 'Logout successful',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => $this->test_examples['POST']['/auth/logout']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/auth/forgot-password' => [
                'post' => [
                    'tags' => ['Authentication'],
                    'summary' => 'Request password reset link',
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/ForgotPasswordRequest'],
                                'example' => [
                                    'email' => 'user@example.com'
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Reset instructions sent if email exists',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => [
                                        'status' => true,
                                        'message' => 'If your email exists in our system, you will receive password reset instructions.',
                                        'data' => null
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/auth/reset-password' => [
                'post' => [
                    'tags' => ['Authentication'],
                    'summary' => 'Reset password using token',
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/ResetPasswordRequest'],
                                'example' => [
                                    'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...',
                                    'new_password' => 'newpassword123'
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Password reset successful',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => [
                                        'status' => true,
                                        'message' => 'Password reset successful',
                                        'data' => null
                                    ]
                                ]
                            ]
                        ],
                        '400' => [
                            'description' => 'Invalid token or password',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/ErrorResponse'],
                                    'example' => [
                                        'status' => false,
                                        'message' => 'Invalid or expired reset token',
                                        'errors' => null
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/customer/{id}' => [
                'get' => [
                    'tags' => ['Customers'],
                    'summary' => 'Get customer details',
                    'security' => [['Bearer' => []]],
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Customer details',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/Customer'],
                                    'example' => $this->test_examples['GET']['/customer/1']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ],
                'put' => [
                    'tags' => ['Customers'],
                    'summary' => 'Update customer details',
                    'security' => [['Bearer' => []]],
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/CustomerUpdate']
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Customer updated successfully',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => $this->test_examples['PUT']['/customer/1']['response'] ?? null
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            '/customer/{id}/change-password' => [
                'post' => [
                    'tags' => ['Customers'],
                    'summary' => 'Change customer password',
                    'security' => [['Bearer' => []]],
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'integer']
                        ]
                    ],
                    'requestBody' => [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => ['$ref' => '#/components/schemas/PasswordChangeRequest'],
                                'example' => $this->test_examples['POST']['/customer/1/change-password']['request'] ?? [
                                    'current_password' => 'current123',
                                    'new_password' => 'new123'
                                ]
                            ]
                        ]
                    ],
                    'responses' => [
                        '200' => [
                            'description' => 'Password changed successfully',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/SuccessResponse'],
                                    'example' => $this->test_examples['POST']['/customer/1/change-password']['response'] ?? [
                                        'status' => true,
                                        'message' => 'Password changed successfully',
                                        'data' => null
                                    ]
                                ]
                            ]
                        ],
                        '401' => [
                            'description' => 'Current password is incorrect',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/ErrorResponse']
                                ]
                            ]
                        ],
                        '403' => [
                            'description' => 'Unauthorized access',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/ErrorResponse']
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }

    /**
     * Get API schemas with examples
     */
    private function get_schemas()
    {
        return [
            'SuccessResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => ['type' => 'boolean', 'example' => true],
                    'message' => ['type' => 'string', 'example' => 'Operation successful'],
                    'data' => ['type' => 'object']
                ]
            ],
            'ErrorResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => ['type' => 'boolean', 'example' => false],
                    'message' => ['type' => 'string', 'example' => 'Error message'],
                    'errors' => ['type' => 'object']
                ]
            ],
            'SignupRequest' => [
                'type' => 'object',
                'properties' => [
                    'email' => ['type' => 'string', 'format' => 'email'],
                    'password' => ['type' => 'string', 'format' => 'password'],
                    'firstname' => ['type' => 'string'],
                    'lastname' => ['type' => 'string'],
                    'phone' => ['type' => 'string']
                ],
                'required' => ['email', 'password', 'firstname', 'lastname']
            ],
            'LoginRequest' => [
                'type' => 'object',
                'properties' => [
                    'email' => ['type' => 'string', 'format' => 'email'],
                    'password' => ['type' => 'string', 'format' => 'password']
                ],
                'required' => ['email', 'password']
            ],
            'LoginResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => ['type' => 'boolean'],
                    'message' => ['type' => 'string'],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'token' => ['type' => 'string'],
                            'user' => [
                                'type' => 'object',
                                'properties' => [
                                    'id' => ['type' => 'integer'],
                                    'email' => ['type' => 'string'],
                                    'firstname' => ['type' => 'string'],
                                    'lastname' => ['type' => 'string']
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'ForgotPasswordRequest' => [
                'type' => 'object',
                'properties' => [
                    'email' => [
                        'type' => 'string',
                        'format' => 'email',
                        'example' => 'user@example.com',
                        'description' => 'Email address of the registered customer'
                    ]
                ],
                'required' => ['email']
            ],
            'ResetPasswordRequest' => [
                'type' => 'object',
                'properties' => [
                    'token' => [
                        'type' => 'string',
                        'description' => 'JWT token received via email',
                        'example' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...'
                    ],
                    'new_password' => [
                        'type' => 'string',
                        'format' => 'password',
                        'description' => 'New password to set',
                        'minLength' => 6,
                        'example' => 'newpassword123'
                    ]
                ],
                'required' => ['token', 'new_password']
            ],
            'BookingRequest' => [
                'type' => 'object',
                'properties' => [
                    'room_id' => ['type' => 'integer'],
                    'checkin' => ['type' => 'string', 'format' => 'date'],
                    'checkout' => ['type' => 'string', 'format' => 'date'],
                    'adults' => ['type' => 'integer', 'minimum' => 1],
                    'children' => ['type' => 'integer', 'minimum' => 0],
                    'special_requests' => ['type' => 'string']
                ],
                'required' => ['room_id', 'checkin', 'checkout', 'adults']
            ],
            'BookingResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => ['type' => 'boolean'],
                    'message' => ['type' => 'string'],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'booking_id' => ['type' => 'integer'],
                            'room_id' => ['type' => 'integer'],
                            'checkin' => ['type' => 'string', 'format' => 'date'],
                            'checkout' => ['type' => 'string', 'format' => 'date'],
                            'total_amount' => ['type' => 'number']
                        ]
                    ]
                ]
            ],
            'ContactRequest' => [
                'type' => 'object',
                'properties' => [
                    'name' => ['type' => 'string'],
                    'email' => ['type' => 'string', 'format' => 'email'],
                    'phone' => ['type' => 'string'],
                    'message' => ['type' => 'string']
                ],
                'required' => ['name', 'email', 'message']
            ],
            'SubscribeRequest' => [
                'type' => 'object',
                'properties' => [
                    'email' => ['type' => 'string', 'format' => 'email']
                ],
                'required' => ['email']
            ],
            'Customer' => [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'integer',
                        'example' => 1
                    ],
                    'firstname' => [
                        'type' => 'string',
                        'example' => 'John'
                    ],
                    'lastname' => [
                        'type' => 'string',
                        'example' => 'Doe'
                    ],
                    'email' => [
                        'type' => 'string',
                        'format' => 'email',
                        'example' => 'john.doe@example.com'
                    ],
                    'phone' => [
                        'type' => 'string',
                        'example' => '+1234567890'
                    ],
                    'address' => [
                        'type' => 'string',
                        'example' => '123 Main St'
                    ],
                    'city' => [
                        'type' => 'string',
                        'example' => 'New York'
                    ],
                    'state' => [
                        'type' => 'string',
                        'example' => 'NY'
                    ],
                    'country' => [
                        'type' => 'string',
                        'example' => 'USA'
                    ],
                    'zipcode' => [
                        'type' => 'string',
                        'example' => '10001'
                    ],
                    'created_at' => [
                        'type' => 'string',
                        'format' => 'date-time',
                        'example' => '2023-01-01T00:00:00Z'
                    ],
                    'updated_at' => [
                        'type' => 'string',
                        'format' => 'date-time',
                        'example' => '2023-01-01T00:00:00Z'
                    ]
                ]
            ],
            'CustomerResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Customer details retrieved successfully'
                    ],
                    'data' => [
                        '$ref' => '#/components/schemas/Customer'
                    ]
                ]
            ],
            'CustomerUpdate' => [
                'type' => 'object',
                'properties' => [
                    'firstname' => [
                        'type' => 'string',
                        'example' => 'John'
                    ],
                    'lastname' => [
                        'type' => 'string',
                        'example' => 'Doe'
                    ],
                    'phone' => [
                        'type' => 'string',
                        'example' => '+1234567890'
                    ],
                    'address' => [
                        'type' => 'string',
                        'example' => '123 Main St'
                    ]
                ],
                'description' => 'Fields that can be updated for a customer'
            ],
            'PasswordChangeRequest' => [
                'type' => 'object',
                'properties' => [
                    'current_password' => [
                        'type' => 'string',
                        'format' => 'password',
                        'example' => 'current123',
                        'description' => 'Current password of the customer'
                    ],
                    'new_password' => [
                        'type' => 'string',
                        'format' => 'password',
                        'example' => 'new123',
                        'description' => 'New password to set',
                        'minLength' => 6
                    ]
                ],
                'required' => ['current_password', 'new_password'],
                'description' => 'Request body for changing customer password'
            ],
            'Room' => [
                'type' => 'object',
                'properties' => [
                    'roomid' => [
                        'type' => 'integer',
                        'example' => 1
                    ],
                    'roomtype' => [
                        'type' => 'string',
                        'example' => 'Deluxe'
                    ],
                    'rate' => [
                        'type' => 'number',
                        'format' => 'float',
                        'example' => 150.00
                    ],
                    'description' => [
                        'type' => 'string',
                        'example' => 'Spacious room with ocean view'
                    ],
                    'room_imagename' => [
                        'type' => 'string',
                        'example' => 'deluxe-room-1.jpg'
                    ],
                    'roomno' => [
                        'type' => 'string',
                        'example' => '301'
                    ],
                    'room_status' => [
                        'type' => 'string',
                        'enum' => ['available', 'booked', 'maintenance'],
                        'example' => 'available'
                    ],
                    'capacity' => [
                        'type' => 'object',
                        'properties' => [
                            'adults' => [
                                'type' => 'integer',
                                'example' => 2
                            ],
                            'children' => [
                                'type' => 'integer',
                                'example' => 1
                            ]
                        ]
                    ],
                    'amenities' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ],
                        'example' => ['WiFi', 'Air Conditioning', 'Mini Bar']
                    ]
                ]
            ],
            'RoomList' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Rooms retrieved successfully'
                    ],
                    'data' => [
                        'type' => 'array',
                        'items' => [
                            '$ref' => '#/components/schemas/Room'
                        ]
                    ],
                    'pagination' => [
                        'type' => 'object',
                        'properties' => [
                            'current_page' => [
                                'type' => 'integer',
                                'example' => 1
                            ],
                            'total_pages' => [
                                'type' => 'integer',
                                'example' => 5
                            ],
                            'per_page' => [
                                'type' => 'integer',
                                'example' => 10
                            ],
                            'total_records' => [
                                'type' => 'integer',
                                'example' => 48
                            ]
                        ]
                    ]
                ]
            ],
            'AvailabilityResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Availability checked successfully'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'is_available' => [
                                'type' => 'boolean',
                                'example' => true
                            ],
                            'room_id' => [
                                'type' => 'integer',
                                'example' => 1
                            ],
                            'room_type' => [
                                'type' => 'string',
                                'example' => 'Deluxe'
                            ],
                            'reason' => [
                                'type' => 'string',
                                'example' => 'No available rooms of this type',
                                'description' => 'Reason for unavailability, if applicable'
                            ],
                            'dates' => [
                                'type' => 'object',
                                'properties' => [
                                    'checkin' => [
                                        'type' => 'string',
                                        'format' => 'date',
                                        'example' => '2024-03-01'
                                    ],
                                    'checkout' => [
                                        'type' => 'string',
                                        'format' => 'date',
                                        'example' => '2024-03-05'
                                    ]
                                ]
                            ]
                        ],
                        'required' => ['is_available', 'room_id', 'room_type']
                    ]
                ]
            ],
            'ContentResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Content retrieved successfully'
                    ],
                    'data' => [
                        'oneOf' => [
                            [
                                // Home page content
                                'type' => 'object',
                                'properties' => [
                                    'title' => [
                                        'type' => 'string',
                                        'example' => 'Welcome to Our Hotel'
                                    ],
                                    'slider_info' => [
                                        'type' => 'array',
                                        'items' => [
                                            '$ref' => '#/components/schemas/SliderItem'
                                        ]
                                    ],
                                    'banner_homemiddle' => [
                                        'type' => 'array',
                                        'items' => [
                                            '$ref' => '#/components/schemas/SliderItem'
                                        ]
                                    ],
                                    'banner_topweek' => [
                                        'type' => 'array',
                                        'items' => [
                                            '$ref' => '#/components/schemas/SliderItem'
                                        ]
                                    ],
                                    'banner_destination' => [
                                        'type' => 'array',
                                        'items' => [
                                            '$ref' => '#/components/schemas/SliderItem'
                                        ]
                                    ],
                                    'room_offers' => [
                                        'type' => 'array',
                                        'items' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'offer_id' => [
                                                    'type' => 'integer',
                                                    'example' => 1
                                                ],
                                                'offer_date' => [
                                                    'type' => 'string',
                                                    'format' => 'date',
                                                    'example' => '2024-03-01'
                                                ],
                                                'description' => [
                                                    'type' => 'string',
                                                    'example' => 'Special weekend offer'
                                                ],
                                                'discount' => [
                                                    'type' => 'number',
                                                    'format' => 'float',
                                                    'example' => 15.00
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                // About page content
                                'type' => 'object',
                                'properties' => [
                                    'page_id' => [
                                        'type' => 'integer',
                                        'example' => 1
                                    ],
                                    'title' => [
                                        'type' => 'string',
                                        'example' => 'About Us'
                                    ],
                                    'description' => [
                                        'type' => 'string',
                                        'example' => 'Welcome to our luxury hotel...'
                                    ],
                                    'image' => [
                                        'type' => 'string',
                                        'example' => 'about-banner.jpg'
                                    ],
                                    'meta_title' => [
                                        'type' => 'string',
                                        'example' => 'About Our Hotel | Luxury Stay'
                                    ],
                                    'meta_description' => [
                                        'type' => 'string',
                                        'example' => 'Learn about our hotel\'s history and commitment to excellence'
                                    ],
                                    'position' => [
                                        'type' => 'integer',
                                        'example' => 1
                                    ],
                                    'status' => [
                                        'type' => 'integer',
                                        'example' => 1,
                                        'description' => '1 for active, 0 for inactive'
                                    ]
                                ]
                            ],
                            [
                                // Generic page content
                                'type' => 'object',
                                'properties' => [
                                    'page_id' => [
                                        'type' => 'integer',
                                        'example' => 1
                                    ],
                                    'title' => [
                                        'type' => 'string',
                                        'example' => 'Page Title'
                                    ],
                                    'content' => [
                                        'type' => 'string',
                                        'example' => 'Page content goes here...'
                                    ],
                                    'meta_data' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'title' => [
                                                'type' => 'string',
                                                'example' => 'Meta Title'
                                            ],
                                            'description' => [
                                                'type' => 'string',
                                                'example' => 'Meta description for SEO'
                                            ],
                                            'keywords' => [
                                                'type' => 'string',
                                                'example' => 'hotel, luxury, accommodation'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'SliderItem' => [
                'type' => 'object',
                'properties' => [
                    'slid' => [
                        'type' => 'integer',
                        'example' => 1
                    ],
                    'title' => [
                        'type' => 'string',
                        'example' => 'Banner Title'
                    ],
                    'subtitle' => [
                        'type' => 'string',
                        'example' => 'Banner Subtitle'
                    ],
                    'image' => [
                        'type' => 'string',
                        'example' => 'banner1.jpg'
                    ],
                    'Sltypeid' => [
                        'type' => 'string',
                        'example' => '2'
                    ]
                ]
            ],
            'GalleryResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Gallery content retrieved successfully'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'categories' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'string'
                                ],
                                'example' => ['Rooms', 'Restaurant', 'Facilities']
                            ],
                            'images' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'title' => [
                                            'type' => 'string',
                                            'example' => 'Deluxe Room'
                                        ],
                                        'category' => [
                                            'type' => 'string',
                                            'example' => 'Rooms'
                                        ],
                                        'image' => [
                                            'type' => 'string',
                                            'example' => 'deluxe1.jpg'
                                        ],
                                        'description' => [
                                            'type' => 'string',
                                            'example' => 'Spacious deluxe room with modern amenities'
                                        ]
                                    ],
                                    'required' => ['title', 'category', 'image']
                                ]
                            ]
                        ],
                        'required' => ['categories', 'images']
                    ]
                ],
                'required' => ['status', 'data']
            ],
            'PageResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Page content retrieved successfully'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'page_id' => [
                                'type' => 'integer',
                                'example' => 1
                            ],
                            'slug' => [
                                'type' => 'string',
                                'example' => 'about-us'
                            ],
                            'title' => [
                                'type' => 'string',
                                'example' => 'About Us'
                            ],
                            'content' => [
                                'type' => 'string',
                                'example' => '<p>Welcome to our luxury hotel...</p>'
                            ],
                            'image' => [
                                'type' => 'string',
                                'example' => 'page-banner.jpg'
                            ],
                            'meta_title' => [
                                'type' => 'string',
                                'example' => 'About Our Hotel | Luxury Stay'
                            ],
                            'meta_description' => [
                                'type' => 'string',
                                'example' => 'Learn about our hotel\'s history and commitment to excellence'
                            ],
                            'meta_keywords' => [
                                'type' => 'string',
                                'example' => 'hotel, luxury, accommodation'
                            ],
                            'position' => [
                                'type' => 'integer',
                                'example' => 1
                            ],
                            'status' => [
                                'type' => 'integer',
                                'example' => 1,
                                'description' => '1 for active, 0 for inactive'
                            ],
                            'created_at' => [
                                'type' => 'string',
                                'format' => 'date-time',
                                'example' => '2024-03-01T12:00:00Z'
                            ],
                            'updated_at' => [
                                'type' => 'string',
                                'format' => 'date-time',
                                'example' => '2024-03-01T12:00:00Z'
                            ]
                        ],
                        'required' => ['page_id', 'slug', 'title', 'content', 'status']
                    ]
                ],
                'required' => ['status', 'message', 'data']
            ],
            'PaymentMethodsResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Payment methods retrieved successfully'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'methods' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'payment_method_id' => [
                                            'type' => 'integer',
                                            'example' => 1
                                        ],
                                        'payment_method' => [
                                            'type' => 'string',
                                            'example' => 'Stripe'
                                        ],
                                        'title' => [
                                            'type' => 'string',
                                            'example' => 'Credit Card (Stripe)'
                                        ],
                                        'subtitle' => [
                                            'type' => 'string',
                                            'example' => 'Pay securely with your credit card'
                                        ],
                                        'image' => [
                                            'type' => 'string',
                                            'example' => 'stripe-logo.png'
                                        ],
                                        'is_active' => [
                                            'type' => 'integer',
                                            'example' => 1,
                                            'description' => '1 for active, 0 for inactive'
                                        ],
                                        'currency_supported' => [
                                            'type' => 'array',
                                            'items' => [
                                                'type' => 'string'
                                            ],
                                            'example' => ['USD', 'EUR', 'GBP']
                                        ]
                                    ],
                                    'required' => ['payment_method_id', 'payment_method', 'title', 'is_active']
                                ]
                            ]
                        ],
                        'required' => ['methods']
                    ]
                ],
                'required' => ['status', 'data']
            ],
            'PaymentRequest' => [
                'type' => 'object',
                'properties' => [
                    'booking_id' => [
                        'type' => 'integer',
                        'example' => 123,
                        'description' => 'ID of the booking to be paid for'
                    ],
                    'payment_method' => [
                        'type' => 'string',
                        'example' => 'credit_card',
                        'description' => 'Payment method identifier'
                    ],
                    'amount' => [
                        'type' => 'number',
                        'format' => 'float',
                        'example' => 299.99,
                        'description' => 'Payment amount'
                    ],
                    'currency' => [
                        'type' => 'string',
                        'example' => 'USD',
                        'description' => 'Payment currency code',
                        'default' => 'USD'
                    ],
                    'metadata' => [
                        'type' => 'object',
                        'description' => 'Additional payment metadata',
                        'example' => [
                            'customer_note' => 'Special request',
                            'promo_code' => 'SUMMER2024'
                        ]
                    ]
                ],
                'required' => ['booking_id', 'payment_method', 'amount']
            ],
            'PaymentResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Payment processed successfully'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'payment' => [
                                'type' => 'object',
                                'properties' => [
                                    'transaction_id' => [
                                        'type' => 'string',
                                        'example' => 'TRX123456'
                                    ],
                                    'booking_id' => [
                                        'type' => 'integer',
                                        'example' => 123
                                    ],
                                    'amount_paid' => [
                                        'type' => 'number',
                                        'format' => 'float',
                                        'example' => 299.99
                                    ],
                                    'currency' => [
                                        'type' => 'string',
                                        'example' => 'USD'
                                    ],
                                    'payment_status' => [
                                        'type' => 'string',
                                        'example' => 'completed',
                                        'enum' => ['pending', 'completed', 'failed', 'refunded']
                                    ],
                                    'payment_method' => [
                                        'type' => 'string',
                                        'example' => 'credit_card'
                                    ],
                                    'receipt_url' => [
                                        'type' => 'string',
                                        'example' => 'https://example.com/receipts/TRX123456'
                                    ],
                                    'created_at' => [
                                        'type' => 'string',
                                        'format' => 'date-time',
                                        'example' => '2024-03-01T12:00:00Z'
                                    ]
                                ],
                                'required' => ['transaction_id', 'booking_id', 'amount_paid', 'payment_status', 'payment_method']
                            ]
                        ],
                        'required' => ['payment']
                    ]
                ],
                'required' => ['status', 'message', 'data']
            ],
            'PaymentVerificationResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Payment verification completed'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'verification' => [
                                'type' => 'object',
                                'properties' => [
                                    'booking_id' => [
                                        'type' => 'integer',
                                        'example' => 123
                                    ],
                                    'transaction_id' => [
                                        'type' => 'string',
                                        'example' => 'TRX123456'
                                    ],
                                    'payment_status' => [
                                        'type' => 'string',
                                        'example' => 'completed',
                                        'enum' => ['pending', 'completed', 'failed', 'refunded']
                                    ],
                                    'amount' => [
                                        'type' => 'number',
                                        'format' => 'float',
                                        'example' => 299.99
                                    ],
                                    'currency' => [
                                        'type' => 'string',
                                        'example' => 'USD'
                                    ],
                                    'payment_method' => [
                                        'type' => 'string',
                                        'example' => 'credit_card'
                                    ],
                                    'verified_at' => [
                                        'type' => 'string',
                                        'format' => 'date-time',
                                        'example' => '2024-03-01T12:00:00Z'
                                    ]
                                ],
                                'required' => ['booking_id', 'transaction_id', 'payment_status']
                            ]
                        ],
                        'required' => ['verification']
                    ]
                ],
                'required' => ['status', 'message', 'data']
            ],
            'SettingsResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Settings retrieved successfully'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'title' => [
                                'type' => 'string',
                                'example' => 'Cardiff Resort'
                            ],
                            'email' => [
                                'type' => 'string',
                                'example' => 'noreply@cardiffresort.com'
                            ],
                            'address' => [
                                'type' => 'string',
                                'example' => '123 Cardiff Street'
                            ],
                            'phone' => [
                                'type' => 'string',
                                'example' => '+1234567890'
                            ],
                            'logo' => [
                                'type' => 'string',
                                'example' => 'default-logo.png'
                            ],
                            'footer_text' => [
                                'type' => 'string',
                                'example' => '© 2024 Cardiff Resort'
                            ],
                            'powerbytxt' => [
                                'type' => 'string',
                                'example' => 'Powered by HMS'
                            ],
                            'checkintime' => [
                                'type' => 'string',
                                'example' => '14:00:00'
                            ],
                            'checkouttime' => [
                                'type' => 'string',
                                'example' => '12:00:00'
                            ],
                            'dateformat' => [
                                'type' => 'string',
                                'example' => 'Y-m-d'
                            ],
                            'timezone' => [
                                'type' => 'string',
                                'example' => 'UTC'
                            ],
                            'site_align' => [
                                'type' => 'string',
                                'example' => 'LTR'
                            ]
                        ],
                        'required' => [
                            'title',
                            'email',
                            'address',
                            'phone',
                            'timezone'
                        ]
                    ]
                ],
                'required' => ['status', 'message', 'data']
            ],
            'LanguagesResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Languages retrieved successfully'
                    ],
                    'data' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'code' => [
                                    'type' => 'string',
                                    'example' => 'en',
                                    'description' => 'Language code'
                                ],
                                'name' => [
                                    'type' => 'string',
                                    'example' => 'English',
                                    'description' => 'Language name'
                                ],
                                'is_default' => [
                                    'type' => 'boolean',
                                    'example' => true,
                                    'description' => 'Whether this is the default language'
                                ]
                            ],
                            'required' => ['code', 'name']
                        ],
                        'example' => [
                            [
                                'code' => 'en',
                                'name' => 'English',
                                'is_default' => true
                            ],
                            [
                                'code' => 'es',
                                'name' => 'Spanish',
                                'is_default' => false
                            ]
                        ]
                    ]
                ],
                'required' => ['status', 'message', 'data']
            ],
            'CurrencyResponse' => [
                'type' => 'object',
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'example' => true
                    ],
                    'message' => [
                        'type' => 'string',
                        'example' => 'Currency settings retrieved successfully'
                    ],
                    'data' => [
                        'type' => 'object',
                        'properties' => [
                            'name' => [
                                'type' => 'string',
                                'example' => 'US Dollar',
                                'description' => 'Currency name'
                            ],
                            'symbol' => [
                                'type' => 'string',
                                'example' => '$',
                                'description' => 'Currency symbol'
                            ],
                            'position' => [
                                'type' => 'string',
                                'enum' => ['left', 'right'],
                                'example' => 'left',
                                'description' => 'Symbol position relative to amount'
                            ],
                            'rate' => [
                                'type' => 'number',
                                'format' => 'float',
                                'example' => 1.00,
                                'description' => 'Exchange rate relative to base currency'
                            ],
                            'is_default' => [
                                'type' => 'boolean',
                                'example' => true,
                                'description' => 'Whether this is the default system currency'
                            ]
                        ],
                        'required' => [
                            'name',
                            'symbol',
                            'position',
                            'rate',
                            'is_default'
                        ]
                    ]
                ],
                'required' => ['status', 'message', 'data']
            ],
        ];
    }

    /**
     * Generate OpenAPI specification
     */
    private function generate_openapi_spec()
    {
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
            'security' => [
                ['Bearer' => []]
            ],
            'tags' => [
                ['name' => 'Authentication', 'description' => 'Authentication endpoints'],
                ['name' => 'Customers', 'description' => 'Customer management'],
                ['name' => 'Rooms', 'description' => 'Room management'],
                ['name' => 'Bookings', 'description' => 'Booking operations']
            ],
            'paths' => $this->get_paths(),
            'components' => [
                'securitySchemes' => [
                    'Bearer' => [
                        'type' => 'http',
                        'scheme' => 'bearer',
                        'bearerFormat' => 'JWT'
                    ]
                ],
                'schemas' => $this->get_schemas()
            ]
        ];
    }

    /**
     * Return OpenAPI specification
     */
    public function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->generate_openapi_spec(), JSON_PRETTY_PRINT);
    }

    /**
     * Show Swagger UI
     */
    public function ui()
    {
        $data['spec_url'] = base_url('api/v1/docs');
        $this->load->view('api/documentation/swagger', $data);
    }
}
