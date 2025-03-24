<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['module_name'] = 'api';
$config['module_title'] = 'REST API';
$config['module_description'] = 'REST API for hotel management system';

// Module-specific autoload
$autoload['libraries'] = array('jwt_handler');

// JWT Configuration
$config['jwt_key'] = getenv('JWT_SECRET_KEY') ?: 'your-secret-key-here';
$config['jwt_timeout'] = 60 * 60 * 24; // 24 hours

// API Response settings
$config['api_response_format'] = array(
    'status' => false,
    'message' => '',
    'data' => null
);

// Rate limiting
$config['rate_limit'] = array(
    'window' => 61, // 1 minute
    'limit' => 61   // requests per window
);

// Allowed CORS domains
$config['allowed_origins'] = array(
    'http://localhost',
    'http://localhost:3000',
);

// API Versioning
$config['current_version'] = 'v1';
$config['supported_versions'] = array('v1');

// Paystack Configuration
$config['paystack_secret_key'] = getenv('PAYSTACK_SECRET_KEY') ?: 'your-paystack-secret-key-here';
