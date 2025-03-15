<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/customer_model');
        $this->load->library(['api/api_handler', 'api/jwt_handler', 'api/email_handler']);

        $protected_methods = ['logout'];
        if (in_array($this->router->fetch_method(), $protected_methods)) {
            $this->api_handler->authenticate();
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

    public function signup()
    {
        try {
            $data = $this->get_json_input();

            if (!isset($data['email'], $data['password'], $data['firstname'], $data['lastname'])) {
                $this->api_handler->send_error('Missing required fields', 400);
                return;
            }

            // Validate email format
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->api_handler->send_error('Invalid email format', 400);
                return;
            }

            // Check if email already exists
            if ($this->customer_model->email_exists($data['email'])) {
                $this->api_handler->send_error('Email already registered', 409);
                return;
            }

            // Create customer with current timestamp
            $data['signupdate'] = date('Y-m-d H:i:s');
            $customer_id = $this->customer_model->create_customer($data);
            $customer = $this->customer_model->get_customer($customer_id);

            if (!$customer) {
                throw new Exception('Failed to retrieve customer data');
            }

            // Generate token
            $token = $this->jwt_handler->generate_token([
                'customerid' => $customer['customerid'],
                'email' => $customer['email'],
                'purpose' => 'customer_signup'
            ]);

            $this->customer_model->store_token($customer['customerid'], $token);

            $this->api_handler->send_response([
                'token' => $token,
                'customer' => $customer
            ], 'Account created successfully', 201);
        } catch (Exception $e) {
            error_log('Error creating customer account: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to create account', 500);
        }
    }

    public function login()
    {
        try {
            $data = $this->get_json_input();
            
            if (!isset($data['email']) || !isset($data['password'])) {
                $this->api_handler->send_error('Email and password required', 400);
                return;
            }

            $customer = $this->customer_model->validate_login($data['email'], $data['password']);
            if (!$customer) {
                $this->api_handler->send_error('Invalid credentials', 401);
                return;
            }

            // Generate both access and refresh tokens
            $token_data = [
                'customerid' => $customer['customerid'],
                'email' => $customer['email'],
                'roles' => $customer['roles'] ?? ['customer'],
                'permissions' => $this->customer_model->get_permissions($customer['customerid']),
                'purpose' => 'customer_login'
            ];

            $access_token = $this->jwt_handler->generate_token($token_data);
            $refresh_token = $this->jwt_handler->generate_refresh_token($token_data);

            // Store refresh token
            $this->customer_model->store_token($customer['customerid'], $refresh_token);
            
            $this->api_handler->send_response([
                'access_token' => $access_token,
                'refresh_token' => $refresh_token,
                'customer' => $customer
            ], 'Login successful');
        } catch (Exception $e) {
            error_log('Login error: ' . $e->getMessage());
            $this->api_handler->send_error('Login failed', 500);
        }
    }

    public function logout()
    {
        try {
            if (!$this->api_handler->user_data) {
                $this->api_handler->send_error('Unauthorized access', 401);
                return;
            }

            $this->customer_model->invalidate_token($this->api_handler->user_data['customerid']);
            $this->api_handler->send_response(null, 'Logged out successfully');
        } catch (Exception $e) {
            error_log('Logout error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to process logout', 500);
        }
    }

    public function forgot_password()
    {
        try {
            $data = $this->get_json_input();

            if (!isset($data['email'])) {
                $this->api_handler->send_error('Email is required', 400);
                return;
            }

            $customer = $this->customer_model->get_customer_by_email($data['email']);
            if (!$customer) {
                $this->api_handler->send_response(
                    null,
                    'If your email exists in our system, you will receive password reset instructions.'
                );
                return;
            }

            $token = $this->jwt_handler->generate_token([
                'customerid' => $customer['customerid'],
                'email' => $customer['email'],
                'purpose' => 'password_reset',
                'exp' => time() + 3600 // 1 hour
            ]);

            $this->customer_model->store_token($customer['customerid'], $token);

            // Create reset link and send email
            $reset_link = site_url('reset-password/' . $token);
            $this->email_handler->send_password_reset($customer, $reset_link);

            $this->api_handler->send_response(
                null,
                'If your email exists in our system, you will receive password reset instructions.'
            );
        } catch (Exception $e) {
            error_log('Password reset error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to process password reset request', 500);
        }
    }

    public function reset_password()
    {
        try {
            $data = $this->get_json_input();
            
            if (!isset($data['token'], $data['new_password'])) {
                $this->api_handler->send_error('Missing required fields', 400);
                return;
            }

            $verified = $this->jwt_handler->verify_token($data['token']);
            if (!$verified || $verified['purpose'] !== 'password_reset') {
                $this->api_handler->send_error('Invalid or expired reset token', 401);
                return;
            }

            $customer = $this->customer_model->get_customer($verified['customerid']);
            if (!$customer) {
                $this->api_handler->send_error('Customer not found', 404);
                return;
            }

            $this->customer_model->update_password($customer['customerid'], $data['new_password']);
            $this->email_handler->send_password_changed($customer);
            $this->customer_model->invalidate_token($customer['customerid']);

            $this->api_handler->send_response(null, 'Password has been reset successfully');
        } catch (Exception $e) {
            error_log('Password reset error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to reset password', 500);
        }
    }

    public function refresh()
    {
        try {
            $refresh_token = $this->input->get_request_header('Refresh-Token');
            if (!$refresh_token) {
                $this->api_handler->send_error('Refresh token required', 400);
                return;
            }

            $verified = $this->jwt_handler->verify_refresh_token($refresh_token);
            if (!$verified) {
                $this->api_handler->send_error('Invalid refresh token', 401);
                return;
            }

            $customer = $this->customer_model->get_customer($verified['customerid']);
            if (!$customer) {
                $this->api_handler->send_error('Customer not found', 404);
                return;
            }

            // Generate new access token
            $token_data = [
                'customerid' => $customer['customerid'],
                'email' => $customer['email'],
                'roles' => $customer['roles'] ?? ['customer'],
                'permissions' => $this->customer_model->get_permissions($customer['customerid']),
                'purpose' => 'customer_login'
            ];

            $new_access_token = $this->jwt_handler->generate_token($token_data);
            
            // Update stored token
            $this->customer_model->update_access_token($customer['customerid'], $new_access_token);

            $this->api_handler->send_response([
                'access_token' => $new_access_token
            ], 'Token refreshed successfully');
        } catch (Exception $e) {
            error_log('Token refresh error: ' . $e->getMessage());
            $this->api_handler->send_error('Token refresh failed', 500);
        }
    }
}
