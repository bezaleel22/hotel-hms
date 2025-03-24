<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_handler
{
    /**
     * CI instance
     * @var object
     */
    protected $CI;

    /**
     * User data
     * @var array
     */
    public $user_data = null;

    /**
     * Rate limiting
     * @var int
     */
    protected $rate_limit;

    /**
     * Rate window
     * @var int
     */
    protected $rate_window;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CI = &get_instance(); // Get CI instance
        $this->CI->load->config('api/config');
        $this->CI->load->library(['api/jwt_handler', 'api/Api_Response']); // Load libraries
        $this->CI->load->driver('cache', array('adapter' => 'file', 'key_prefix' => 'api_'));


        // Set JSON response type
        header('Content-Type: application/json; charset=utf-8');

        // Disable CSRF for API endpoints
        if (isset($_SERVER["REQUEST_URI"]) && stripos($_SERVER["REQUEST_URI"], '/api/v1') !== FALSE) {
            $this->CI->config->set_item('csrf_protection', FALSE);
        }

        // Load rate limiting config
        $this->rate_limit = $this->CI->config->item('rate_limit')['limit'] ?? 60;
        $this->rate_window = $this->CI->config->item('rate_limit')['window'] ?? 60;
    }

    /**
     * Send standardized JSON response using API_Response library
     */
    public function send_response($data = null, $message = '', $status_code = 200)
    {
        $response = API_Response::success($data, $message, $status_code);
        header('Content-Type: application/json');
        http_response_code($status_code);
        echo json_encode($response);
        exit;
    }

    /**
     * Send error response using API_Response library
     */
    public function send_error($message, $status_code = 500, $data = null)
    {
        $response = API_Response::error($message, $status_code, $data);
        header('Content-Type: application/json');
        http_response_code($status_code);
        echo json_encode($response);
        exit;
    }

    /**
     * Validate a token
     */
    private function validate_token($customer_id, $provided_token)
    {
        $stored_token = $this->CI->cache->get($customer_id);
        if (!$stored_token) {
            return false; // Token not found in cache
        }

        if ($stored_token != $provided_token) {
            return false; // Token is invalid
        }
        return true;
    }

    /**
     * Authenticate request using JWT
     */
    public function authenticate($required_roles = null)
    {        // Check rate limiting
        if (!$this->check_rate_limit()) {
            $this->send_error('Rate limit exceeded', 429);
            return false;
        }

        $token = $this->get_token_from_header();
        if (!$token) {
            throw new Exception('No authorization token provided', 401);
        }

        // Verify token with roles
        $verified = $this->CI->jwt_handler->verify_token($token, null, $required_roles);
        if (!$verified) {
            $this->send_error('Invalid or expired token', 401);
            return false;
        }
        if (!$this->validate_token($verified['customerid'], $token)) {
            error_log("[DEBUG] Token validation failed");
            $this->send_error('Invalid token', 401);
            return false;
        }

        // Store user data
        $this->user_data = $verified;
        error_log("[DEBUG] Authenticated user: " . json_encode($verified));
        return true;
    }

    /**
     * Validate required parameters
     */
    protected function validate_params($required, $method = 'post')
    {
        foreach ($required as $field) {
            if (!$this->CI->input->$method($field)) {
                $this->send_error("Missing required parameter: {$field}", 400);
                return false;
            }
        }
        return true;
    }

    /**
     * Get authenticated user data
     */
    public function get_user_data()
    {
        return $this->user_data;
    }

    /**
     * Get token from header
     */
    protected function get_token_from_header()
    {
        $input = $this->CI->input->get_request_header('Authorization');
        $input = trim($input);
        if (!empty($input)) {
            if (preg_match('/^Bearer\s+(\S+)$/', $input, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * Check rate limiting
     */
    private function check_rate_limit()
    {
        $ip = $this->CI->input->ip_address();
        $key = "rate_limit:" . $ip;

        // Get current count from cache
        $count = $this->CI->cache->get($key) ?? 0;
        if ($count >= $this->rate_limit) {
            return false;
        }

        // Increment count
        $this->CI->cache->save($key, $count + 1, $this->rate_window);

        return true;
    }

    /**
     * Role-based authorization check
     */
    public function authorize($required_permissions)
    {
        if (!$this->user_data || !isset($this->user_data['permissions'])) {
            return false;
        }

        $user_permissions = $this->user_data['permissions'];

        if (!is_array($required_permissions)) {
            $required_permissions = [$required_permissions];
        }

        foreach ($required_permissions as $permission) {
            if (!in_array($permission, $user_permissions)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get and validate JSON input data
     * @return array|null Returns parsed JSON data or null if invalid
     */
    public function get_json_input()
    {
        $json = json_decode($this->CI->input->raw_input_stream, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }
        return $json;
    }
}
