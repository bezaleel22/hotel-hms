<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jwt_handler
{

    /**
     * CodeIgniter instance
     * @var object
     */
    private $CI;

    /**
     * Secret key
     * @var string
     */
    private $secret_key;
    private $token_timeout;
    private $refresh_token_timeout;
    private $debug_mode = false;

    /**
     * Constructor
     */

    public function __construct()
    {
        $this->CI = &get_instance();

        if (!isset($this->CI->load)) {
            $this->CI->load = load_class('Loader', 'core');
            $this->CI->load->initialize();
            $this->CI->load->library('database');
            $this->CI->db = $this->CI->database->db;
            $this->CI->load->model('api/customer_model');
        }

        // Load config
        $this->secret_key = getenv('JWT_SECRET_KEY') ?: 'your-secret-key';
        $this->token_timeout = 24 * 60 * 60; // 24 hours
        $this->refresh_token_timeout = 7 * 24 * 60 * 60; // 7 days
    }

    /**
     * Generate JWT token
     */
    public function generate_token($data, $purpose = null)
    {
        $time = time();

        $token = array(
            'iat' => $time,
            'exp' => $time + $this->token_timeout,
            'type' => 'access'
        );

        // Add roles and permissions if they exist
        if (isset($data['roles'])) {
            $token['roles'] = $data['roles'];
        }

        if (isset($data['permissions'])) {
            $token['permissions'] = $data['permissions'];
        }

        // Add purpose if specified
        if ($purpose) {
            $token['purpose'] = $purpose;
        }

        // Add user data
        foreach ($data as $key => $value) {
            if (!in_array($key, ['iat', 'exp', 'type', 'roles', 'permissions'])) {
                $token[$key] = $value;
            }
        }

        return $this->jwt_encode($token);
    }

    // Add refresh token generation
    public function generate_refresh_token($data)
    {
        $time = time();

        $token = array(
            'iat' => $time,
            'exp' => $time + $this->refresh_token_timeout,
            'type' => 'refresh',
            'customerid' => $data['customerid']
        );

        return $this->jwt_encode($token);
    }

    /**
     * Verify JWT token
     */
    public function verify_token($token = null, $required_purpose = null, $required_roles = null)
    {
        try {
            $decoded = $this->jwt_decode($token);

            // Check if token has expired
            if (isset($decoded['exp']) && $decoded['exp'] < time()) {
                if ($this->debug_mode) {
                    error_log("[DEBUG] Token has expired");
                }
                return false;
            }

            // Check purpose if required
            if ($required_purpose && (!isset($decoded['purpose']) || $decoded['purpose'] !== $required_purpose)) {
                if ($this->debug_mode) {
                    error_log("[DEBUG] Invalid token purpose");
                }
                return false;
            }

            // Check roles if required
            if ($required_roles) {
                if (!isset($decoded['roles']) || !$this->has_required_roles($decoded['roles'], $required_roles)) {
                    if ($this->debug_mode) {
                        error_log("[DEBUG] Insufficient roles");
                    }
                    return false;
                }
            }

            return $decoded;
        } catch (Exception $e) {
            if ($this->debug_mode) {
                error_log("[ERROR] Token verification failed: " . $e->getMessage());
            }
            return false;
        }
    }

    // Add role checking method
    private function has_required_roles($user_roles, $required_roles)
    {
        if (!is_array($required_roles)) {
            $required_roles = [$required_roles];
        }

        return count(array_intersect($user_roles, $required_roles)) > 0;
    }

    // Add method to verify refresh token
    public function verify_refresh_token($token)
    {
        try {
            $decoded = $this->jwt_decode($token);

            if ($decoded['type'] !== 'refresh') {
                return false;
            }

            if (isset($decoded['exp']) && $decoded['exp'] < time()) {
                return false;
            }

            return $decoded;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get Authorization header
     */
    private function get_authorization_header()
    {
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(
                array_map('ucwords', array_keys($requestHeaders)),
                array_values($requestHeaders)
            );
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        error_log("[DEBUG] JWT_handler: Authorization header: " . $headers);
        return $headers;
    }

    /**
     * Get bearer token
     */
    private function get_bearer_token($headers)
    {
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * JWT encode
     */
    private function jwt_encode($payload)
    {
        // Create token header
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Encode Header
        $base64UrlHeader = $this->base64url_encode($header);

        // Encode Payload
        $base64UrlPayload = $this->base64url_encode(json_encode($payload));

        // Create Signature
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->secret_key, true);
        $base64UrlSignature = $this->base64url_encode($signature);

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    /**
     * JWT decode
     */
    private function jwt_decode($jwt)
    {
        // Split the token
        $tokenParts = explode('.', $jwt);
        if (count($tokenParts) != 3) {
            throw new Exception('Invalid token format');
        }

        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = $tokenParts;

        // Check signature
        $signature = $this->base64url_decode($base64UrlSignature);
        $expectedSignature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->secret_key, true);

        if ($signature !== $expectedSignature) {
            throw new Exception('Invalid signature');
        }

        // Decode payload
        $payload = json_decode($this->base64url_decode($base64UrlPayload), true);

        return $payload;
    }

    /**
     * Base64URL encode
     */
    private function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Base64URL decode
     */
    private function base64url_decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/') . str_repeat('=', 3 - (3 + strlen($data)) % 4));
    }
}
