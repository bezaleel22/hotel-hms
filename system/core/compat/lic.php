<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Development license configuration
define('ENVIRONMENT', 'development');
define('LICENSE_KEY', 'localhost-127.0.0.1');
define('PRODUCT_KEY', '31264738');

class Lic {
    // Constructor
    public function __construct() {
        // Development environment - no verification needed
        log_message('info', 'License Class Initialized');
    }
}