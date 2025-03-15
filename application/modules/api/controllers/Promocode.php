<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promocode extends MX_Controller
{

    private $auth_required = true;
    private $user_data = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/promocode_model');
        $this->load->library(['api/api_handler', 'api/jwt_handler']);

        // Validate authentication
        if ($this->auth_required) {
            $token = $this->input->get_request_header('Authorization');
            if (!$token) {
                $this->api_handler->send_error('No authorization token provided', 401);
                return;
            }

            $this->user_data = $this->jwt_handler->verify_token($token);
            if (!$this->user_data) {
                $this->api_handler->send_error('Invalid or expired token', 401);
                return;
            }
        }
    }



    private function get_json_input()
    {
        $json = json_decode($this->input->raw_input_stream, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->api_handler->send_error('Invalid JSON payload', 400);
            return null;
        }
        return $json;
    }

    /**
     * Validate promo code
     * Requires authentication to prevent abuse
     */
    public function validate()
    {
        try {
            $data = $this->get_json_input();
            if (!$data) return;

            // Validate required fields
            $required = ['code', 'room_id'];
            $missing = [];
            foreach ($required as $field) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    $missing[] = $field;
                }
            }

            if (!empty($missing)) {
                $this->api_handler->send_error('Missing required fields: ' . implode(', ', $missing), 400);
                return;
            }

            // Validate room_id format
            if (!is_numeric($data['room_id'])) {
                $this->api_handler->send_error('Invalid room_id format', 400);
                return;
            }

            // Add customer ID to track promo code usage
            $data['customer_id'] = $this->user_data['customerid'];

            $validation = $this->promocode_model->validate_code(
                $data['code'],
                $data['room_id'],
                $data['customer_id']
            );

            if (!$validation['is_valid']) {
                $this->api_handler->send_error($validation['message'], 400);
                return;
            }

            $this->api_handler->send_response(
                [
                    'discount' => $validation['discount'],
                    'discount_type' => $validation['discount_type'],
                    'expires_at' => $validation['expires_at']
                ],
                'Promo code is valid'
            );
        } catch (Exception $e) {
            error_log('Error validating promo code: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to validate promo code', 500);
        }
    }

    /**
     * List valid promo codes for user
     * Requires authentication
     */
    public function list()
    {
        try {
            $codes = $this->promocode_model->get_valid_codes($this->user_data['customerid']);

            $this->api_handler->send_response(
                ['promocodes' => $codes],
                'Promo codes retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error retrieving promo codes: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to retrieve promo codes', 500);
        }
    }

    /**
     * Get promo code usage history for user
     * Requires authentication
     */
    public function history()
    {
        try {
            $history = $this->promocode_model->get_usage_history($this->user_data['customerid']);

            $this->api_handler->send_response(
                ['history' => $history],
                'Promo code history retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error retrieving promo code history: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to retrieve promo code history', 500);
        }
    }
}
