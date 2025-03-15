<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Welcome API Controller
 * 
 * Provides basic API information and serves as a health check endpoint
 */
class Welcome extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('api/api_handler');
    }



    /**
     * Welcome endpoint
     *
     * @api {get} /api/v1/welcome Get Welcome Message
     * @apiName GetWelcome
     * @apiGroup System
     * @apiVersion 1.0.0
     * @apiDescription Returns welcome message and basic API information
     */
    public function index()
    {
        // Check request method
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->api_handler->send_error('Method not allowed', 405);
            return;
        }

        try {
            $api_info = [
                'version' => '1.0.0',
                'documentation' => base_url('api/v1/docs'),
                'endpoints' => [
                    'rooms' => [
                        'url' => base_url('api/v1/rooms'),
                        'methods' => ['GET', 'POST'],
                        'description' => 'Room management endpoints'
                    ],
                    'bookings' => [
                        'url' => base_url('api/v1/bookings'),
                        'methods' => ['GET', 'POST', 'PUT', 'DELETE'],
                        'description' => 'Booking management endpoints'
                    ],
                    'customers' => [
                        'url' => base_url('api/v1/customers'),
                        'methods' => ['GET', 'POST', 'PUT'],
                        'description' => 'Customer management endpoints'
                    ]
                ],
                'system_time' => date('Y-m-d H:i:s'),
                'timezone' => date_default_timezone_get()
            ];

            $this->api_handler->send_response(
                $api_info,
                'Welcome to Hotel Management System API'
            );
        } catch (Exception $e) {
            error_log('Error in welcome endpoint: ' . $e->getMessage());
            $this->api_handler->send_error('Internal server error', 500);
        }
    }
}
