#!/usr/bin/env php
<?php

// Configuration
$LOG_FILE = __DIR__ . '/../tests/logs/api_tests.log';
$OUTPUT_FILE = __DIR__ . '/openapi.json';

// Track common schemas
$common_schemas = [
    'responses' => [],
    'requests' => []
];

// Extract common schema from data
function extract_schema_name($data, &$schemas, $prefix)
{
    $hash = md5(json_encode($data));
    if (!isset($schemas[$hash])) {
        $schema_type = isset($data['type']) ? ucfirst($data['type']) : 'Object';
        $name = $prefix . $schema_type;
        $schemas[$hash] = [
            'name' => $name,
            'schema' => $data
        ];
    }
    return $schemas[$hash]['name'];
}

// Parse log file and generate OpenAPI structure
function parse_log_file($log_file, &$common_schemas)
{
    $content = file_get_contents($log_file);
    $entries = explode('-------------------------------------------', $content);
    $paths = [];

    foreach ($entries as $entry) {
        if (preg_match('/\[(.*?)\] (GET|POST|PUT|DELETE) (\/.*?)\n/', $entry, $matches)) {
            $method = strtolower($matches[2]);
            $endpoint = $matches[3];
            // Remove /api/v1 prefix
            $endpoint = preg_replace('/^\/api\/v1/', '', $endpoint);

            // Remove /api/v1 prefix and parse path
            $path = trim(preg_replace('/^\/api\/v1/', '', $endpoint), '/');
            $parts = explode('/', $path);
            
            // Map routes to categories
            $category_map = [
                'content' => 'Content Management',
                'rooms' => 'Room Management',
                'auth' => 'Authentication',
                'customer' => 'Customer Management',
                'bookings' => 'Booking Management',
                'payments' => 'Payment Processing',
                'config' => 'Configuration'
            ];
            
            // Determine category and schema prefix based on route
            if ($parts[0] === 'content') {
                $category = 'Content Management';
                $schema_prefix = ucfirst($parts[1] ?? 'Content');
            } else {
                $category = $category_map[$parts[0]] ?? ucfirst($parts[0]);
                $schema_prefix = str_replace(' ', '', ucwords($parts[0]));
            }

            // Extract query parameters from URL
            $query_params = [];
            if (strpos($endpoint, '?') !== false) {
                list($base_path, $query_string) = explode('?', $endpoint);
                parse_str($query_string, $query_params);
                $endpoint = $base_path;
            }

            // Extract status code
            preg_match('/Status Code: (\d+)/', $entry, $status_matches);
            $status_code = $status_matches[1] ?? '200';

            // Get response for example values
            $response_data = null;
            if (preg_match('/Response: ({.*})/s', $entry, $response_matches)) {
                $response_data = json_decode($response_matches[1], true);
            }

            // Extract request body from curl command
            $request_body = null;
            if (preg_match("/-d '({[^}]+})'/", $entry, $body_matches)) {
                $request_body = json_decode($body_matches[1], true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // Try with double quotes if single quote parsing failed
                    if (preg_match('/-d "({[^}]+})"/', $entry, $body_matches)) {
                        $request_body = json_decode($body_matches[1], true);
                    }
                }
            }

            // Extract response
            if (preg_match('/Response: ({.*})/s', $entry, $response_matches)) {
                $response = json_decode($response_matches[1], true);

                // Generate path item
                $path_item = [
                    'tags' => [$category],
                    'summary' => generate_summary($endpoint, $method),
                ];

                // Add query parameters if present
                if (!empty($query_params)) {
                    $path_item['parameters'] = array_map(function($name, $value) {
                        $short_example = strlen($value) > 50 ? substr($value, 0, 47) . '...' : $value;
                        return [
                            'name' => $name,
                            'in' => 'query',
                            'required' => true,
                            'schema' => [
                                'type' => 'string',
                                'minLength' => 1,
                                'maxLength' => 512,
                                'format' => 'text',
                                'example' => $short_example,
                            ],
                            'description' => 'Query parameter: ' . ucfirst(str_replace('_', ' ', $name))
                        ];
                    }, array_keys($query_params), array_values($query_params));
                }

                // Handle request body
                if ($request_body) {
                    $request_schema_name = $schema_prefix . 'Request';
                    $request_schema = [
                        'type' => 'object',
                        'required' => array_keys($request_body),
                        'description' => "Request data for {$category} endpoint",
                        'properties' => array_combine(
                            array_keys($request_body),
                            array_map(function ($key, $value) {
                                return [
                                    'type' => get_type($value),
                                    'description' => ucfirst(str_replace('_', ' ', $key)),
                                    'example' => $value
                                ];
                            }, array_keys($request_body), array_values($request_body))
                        )
                    ];

                    $common_schemas['requests'][$request_schema_name] = [
                        'name' => $request_schema_name,
                        'schema' => $request_schema
                    ];

                    $path_item['requestBody'] = [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/' . $request_schema_name
                                ],
                                'example' => $request_body
                            ]
                        ]
                    ];
                }

                // Add path parameters from endpoint
                if (preg_match_all('/{([^}]+)}/', $endpoint, $param_matches)) {
                    // Extract path parameter value from URL for example
                    $path_value = null;
                    if (preg_match("/{$param_matches[1][0]}/(\\d+)/", $endpoint, $value_match)) {
                        $path_value = $value_match[1];
                    }

                    $path_params = array_map(function ($param) use ($path_value) {
                        $schema = [];
                        if (preg_match('/(id|number)$/', $param)) {
                            $schema = [
                                'type' => 'string',
                                'pattern' => '^\d+$',
                                'minLength' => 1,
                                'maxLength' => 8,
                                'example' => $path_value ?? '00000001'
                            ];
                        } else {
                            $schema = [
                                'type' => 'string',
                                'minLength' => 1,
                                'maxLength' => 64
                            ];
                        }

                        return [
                            'name' => $param,
                            'in' => 'path',
                            'required' => true,
                            'schema' => $schema,
                            'description' => ucfirst(str_replace(['_', 'id'], [' ', ' ID'], $param))
                        ];
                    }, $param_matches[1]);

                    // Merge with existing parameters if any
                    if (isset($path_item['parameters'])) {
                        $path_item['parameters'] = array_merge($path_item['parameters'], $path_params);
                    } else {
                        $path_item['parameters'] = $path_params;
                    }
                }


                // Create schema names using clean prefix
                $data_schema_name = $schema_prefix . 'Data';
                $response_schema_name = $schema_prefix . 'Response';
                
                // Build data schema with description
                $data_schema = [
                    'type' => 'object',
                    'description' => "Response data for {$category} endpoints",
                    'properties' => array_combine(
                        array_keys($response['data'] ?? []),
                        array_map(function($key, $value) {
                            return [
                                'type' => get_type($value),
                                'description' => ucfirst(str_replace('_', ' ', $key)),
                                'example' => $value
                            ];
                        }, array_keys($response['data'] ?? []), array_values($response['data'] ?? []))
                    )
                ];

                // Store data schema
                $common_schemas['responses'][$data_schema_name] = [
                    'name' => $data_schema_name,
                    'schema' => $data_schema
                ];

                // Create full response schema
                $response_schema = [
                    'allOf' => [
                        ['$ref' => '#/components/schemas/ApiResponse'],
                        [
                            'type' => 'object',
                            'properties' => [
                                'data' => [
                                    '$ref' => '#/components/schemas/' . $data_schema_name
                                ]
                            ]
                        ]
                    ]
                ];

                // Add response schema
                $common_schemas['responses'][$response_schema_name] = [
                    'name' => $response_schema_name,
                    'schema' => $response_schema
                ];

                // Add response reference
                $path_item['responses'] = [
                    $status_code => [
                        'description' => $response['message'] ?? get_status_description($status_code),
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/' . $response_schema_name
                                ],
                                'example' => $response
                            ]
                        ]
                    ]
                ];

                // Store in paths array
                $normalized_endpoint = preg_replace('/{(\w+)}/', '{$1}', $endpoint);
                $paths[$normalized_endpoint][$method] = $path_item;
            }
        }
    }

    return $paths;
}

function generate_summary($endpoint, $method)
{
    $parts = explode('/', trim($endpoint, '/'));
    $resource = end($parts);
    return ucfirst($method) . ' ' . str_replace('-', ' ', $resource);
}

function generate_schema($data, $common_schemas = null, $is_request = false)
{
    if (!$data) return null;

    if (is_array($data)) {
        if (array_keys($data) === range(0, count($data) - 1)) {
            // Array
            $items = generate_schema(reset($data), $common_schemas, $is_request);
            $schema = [
                'type' => 'array',
                'items' => $items
            ];
        } else {
            // Object
            $properties = [];
            foreach ($data as $key => $value) {
                $properties[$key] = generate_schema($value, $common_schemas, $is_request);
            }
            $schema = [
                'type' => 'object',
                'properties' => $properties
            ];

            // Extract common schema if $common_schemas is provided
            if ($common_schemas && count($properties) > 0) {
                $type = $is_request ? 'requests' : 'responses';
                $prefix = $is_request ? 'Request' : 'Response';
                $ref_name = extract_schema_name($schema, $common_schemas[$type], $prefix);
                return ['$ref' => '#/components/schemas/' . $ref_name];
            }
        }
        return $schema;
    }

    // Primitive types
    return [
        'type' => get_type($data),
        'example' => $data
    ];
}

function get_type($value)
{
    $type = gettype($value);
    switch ($type) {
        case 'integer':
            return 'integer';
        case 'double':
            return 'number';
        case 'string':
            return 'string';
        case 'boolean':
            return 'boolean';
        default:
            return 'string';
    }
}

function get_status_description($code)
{
    $descriptions = [
        '200' => 'Successful operation',
        '201' => 'Created successfully',
        '400' => 'Bad request',
        '401' => 'Unauthorized',
        '404' => 'Not found',
        '500' => 'Server error'
    ];
    return $descriptions[$code] ?? 'Operation response';
}

// Generate OpenAPI specification
$paths = parse_log_file($LOG_FILE, $common_schemas);

$spec = [
    'openapi' => '3.0.0',
    'info' => [
        'title' => 'Hotel Management System API',
        'version' => '1.0.0',
        'description' => 'REST API for hotel room booking and management'
    ],
    'servers' => [
        ['url' => '/api/v1']
    ],
    'paths' => $paths,
    'components' => [
        'schemas' => [
            'ApiResponse' => [
                'type' => 'object',
                'required' => ['status', 'code', 'message'],
                'properties' => [
                    'status' => [
                        'type' => 'boolean',
                        'description' => 'Operation success status'
                    ],
                    'code' => [
                        'type' => 'integer',
                        'description' => 'HTTP status code'
                    ],
                    'message' => [
                        'type' => 'string',
                        'description' => 'Response message'
                    ],
                    'data' => [
                        'type' => 'object',
                        'description' => 'Response payload'
                    ],
                    'timestamp' => [
                        'type' => 'string',
                        'format' => 'date-time',
                        'description' => 'Response timestamp'
                    ]
                ]
            ]
        ],
        'securitySchemes' => [
            'Bearer' => [
                'type' => 'http',
                'scheme' => 'bearer',
                'bearerFormat' => 'JWT'
            ]
        ]
    ]
];

// Add request schemas
foreach ($common_schemas['requests'] as $schema) {
    $spec['components']['schemas'][$schema['name']] = $schema['schema'];
}

// Add response schemas
foreach ($common_schemas['responses'] as $schema) {
    $spec['components']['schemas'][$schema['name']] = $schema['schema'];
}

// Save as JSON
file_put_contents($OUTPUT_FILE, json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "OpenAPI specification generated successfully at: $OUTPUT_FILE\n";
