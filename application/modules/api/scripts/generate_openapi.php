#!/usr/bin/env php
<?php

// Configuration
$LOG_FILE = __DIR__ . '/../tests/logs/api_tests.log';
$OUTPUT_FILE = __DIR__ . '/../assets/openapi.json';

// Parse log file and generate OpenAPI structure
function parse_log_file($log_file) {
    $content = file_get_contents($log_file);
    $entries = explode('-------------------------------------------', $content);
    $paths = [];
    
    foreach ($entries as $entry) {
        if (preg_match('/\[(.*?)\] (GET|POST|PUT|DELETE) (\/.*?)\n/', $entry, $matches)) {
            $method = strtolower($matches[2]);
            $endpoint = $matches[3];
            
            // Extract category from endpoint
            $parts = explode('/', trim($endpoint, '/'));
            $category = ucfirst($parts[0]);
            
            // Extract status code
            preg_match('/Status Code: (\d+)/', $entry, $status_matches);
            $status_code = $status_matches[1] ?? '200';
            
            // Extract request body
            $request_body = null;
            if (preg_match('/Request Body: ({.*})/s', $entry, $req_matches)) {
                $request_body = json_decode($req_matches[1], true);
            }
            
            // Extract response
            if (preg_match('/Response: ({.*})/s', $entry, $response_matches)) {
                $response = json_decode($response_matches[1], true);
                
                // Generate path item
                $path_item = [
                    'tags' => [$category],
                    'summary' => generate_summary($endpoint, $method),
                ];
                
                // Add parameters from endpoint
                if (preg_match_all('/{([^}]+)}/', $endpoint, $param_matches)) {
                    $path_item['parameters'] = array_map(function($param) {
                        return [
                            'name' => $param,
                            'in' => 'path',
                            'required' => true,
                            'schema' => ['type' => 'string']
                        ];
                    }, $param_matches[1]);
                }
                
                // Add request body if present
                if ($request_body) {
                    $path_item['requestBody'] = [
                        'required' => true,
                        'content' => [
                            'application/json' => [
                                'schema' => generate_schema($request_body),
                                'example' => $request_body
                            ]
                        ]
                    ];
                }
                
                // Add response
                $path_item['responses'] = [
                    $status_code => [
                        'description' => get_status_description($status_code),
                        'content' => [
                            'application/json' => [
                                'schema' => generate_schema($response),
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

function generate_summary($endpoint, $method) {
    $parts = explode('/', trim($endpoint, '/'));
    $resource = end($parts);
    return ucfirst($method) . ' ' . str_replace('-', ' ', $resource);
}

function generate_schema($data) {
    if (!$data) return null;
    
    if (is_array($data)) {
        if (array_keys($data) === range(0, count($data) - 1)) {
            // Array
            return [
                'type' => 'array',
                'items' => generate_schema(reset($data))
            ];
        } else {
            // Object
            $properties = [];
            foreach ($data as $key => $value) {
                $properties[$key] = generate_schema($value);
            }
            return [
                'type' => 'object',
                'properties' => $properties
            ];
        }
    }
    
    // Primitive types
    return [
        'type' => get_type($data),
        'example' => $data
    ];
}

function get_type($value) {
    $type = gettype($value);
    switch ($type) {
        case 'integer': return 'integer';
        case 'double': return 'number';
        case 'string': return 'string';
        case 'boolean': return 'boolean';
        default: return 'string';
    }
}

function get_status_description($code) {
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
$paths = parse_log_file($LOG_FILE);

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
        'securitySchemes' => [
            'Bearer' => [
                'type' => 'http',
                'scheme' => 'bearer',
                'bearerFormat' => 'JWT'
            ]
        ]
    ]
];

// Save as JSON
file_put_contents($OUTPUT_FILE, json_encode($spec, JSON_PRETTY_PRINT));

echo "OpenAPI specification generated successfully at: $OUTPUT_FILE\n";