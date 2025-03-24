<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{
    /**
     * API handler instance
     * @var Api_handler
     */
    protected $api;

    /**
     * JWT handler instance
     * @var Jwt_handler
     */
    protected $jwt;

    /**
     * Email handler instance
     * @var Email_handler
     */
    protected $email;

    /**
     * Customer model instance
     * @var Customer_model
     */
    protected $customer;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['api/api_handler', 'api/jwt_handler', 'api/email_handler', 'form_validation']);
        $this->load->model('api/customer_model');
        $this->api = $this->api_handler;
        $this->jwt = $this->jwt_handler;
        $this->email = $this->email_handler;
        $this->customer = $this->customer_model;

        $protected_methods = ['logout', 'change_password', 'reset_password'];
        if (in_array($this->router->fetch_method(), $protected_methods)) {
            $this->api->authenticate(['customer', 'admin']);
        }
    }

    public function signup()
    {
        try {
            $data = $this->api->get_json_input();

            // Set validation rules
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('firstname', 'First Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[customerinfo.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean|is_unique[customerinfo.cust_phone]');
            $this->form_validation->set_rules('useragree', 'Terms of Service', 'required|trim|xss_clean');

            // Validate input
            if ($this->form_validation->run() === FALSE) {
                $this->api->send_error('Validation errors', 400, validation_errors());
                return;
            }
            // Check if email already exists
            if ($this->customer->email_exists($data['email'])) {
                $this->api->send_error('Email already registered', 409);
                return;
            }
            $customer = $this->customer->create_customer($data);
            if (!$customer) {
                throw new Exception('Failed to create customer data');
            }

            // Generate both access and refresh tokens
            $token_data = [
                'customerid' => $customer['customerid'],
                'email' => $customer['email'],
                'roles' => $customer['roles'] ?? ['customer'],
                'permissions' => $this->customer->get_permissions($customer['customerid']),
                'purpose' => 'authentication'
            ];

            $token = $this->jwt->generate_token($token_data);
            $this->cache->save($customer['customerid'], $token, 3600); // Cache for 1 hour

            $this->api->send_response([
                'access_token' => $token,
                'customer' => $customer
            ], 'Account created successfully', 201);
        } catch (Exception $e) {
            error_log('Error creating customer account: ' . $e->getMessage());
            $this->api->send_error('Failed to create account', 500);
        }
    }

    public function login()
    {
        try {
            $data = $this->api->get_json_input();
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            // Validate input
            if ($this->form_validation->run() === FALSE) {
                $this->api->send_error('Validation errors', 400, validation_errors());
                return;
            }

            $customer = $this->customer->validate_login($data['email'], $data['password']);
            if (!$customer) {
                $this->api->send_error('Invalid credentials', 401);
                return;
            }
            // Generate both access and refresh tokens
            $token_data = [
                'customerid' => $customer->customerid,
                'email' => $customer->email,
                'roles' => $customer->roles ?? ['customer'],
                'permissions' => $this->customer->get_permissions($customer->customerid),
                'purpose' => 'authentication'
            ];

            $access_token = $this->jwt->generate_token($token_data);
            $refresh_token = $this->jwt->generate_refresh_token($token_data);

            $this->cache->save($customer->customerid, $access_token, 7200); // Cache for 2 hours

            $this->api->send_response([
                'access_token' => $access_token,
                'refresh_token' => $refresh_token,
                'customer' => $customer
            ], 'Login successful');
        } catch (Exception $e) {
            error_log('Login error: ' . $e->getMessage());
            $this->api->send_error('Failed to process login', 500);
        }
    }

    public function change_password()
    {
        try {
            $data = $this->api->get_json_input();

            if (!isset($data['current_password'], $data['new_password'])) {
                $this->api->send_error('Missing required fields', 400);
                return;
            }

            $id = $this->api->user_data['customerid'];
            if (!$this->customer->verify_password($id, $data['current_password'])) {
                $this->api->send_error('Current password is incorrect', 400);
                return;
            }
            
            $this->customer->update_password($id, $data['new_password']);
            $this->api->send_response(null, 'Password changed successfully');
        } catch (Exception $e) {
            error_log('Password change error: ' . $e->getMessage());
            $this->api->send_error('Failed to change password', 500);
        }
    }

    public function logout()
    {
        try {
            $customer_id = $this->api->user_data['customerid'];
            $this->customer->invalidate_token($customer_id);
            $this->api->send_response(null, 'Logged out successfully');
        } catch (Exception $e) {
            error_log('Logout error: ' . $e->getMessage());
            $this->api->send_error('Failed to process logout', 500);
        }
    }

    public function forgot_password()
    {
        try {
            $data = $this->api->get_json_input();

            if (!isset($data['email'])) {
                $this->api->send_error('Email is required', 400);
                return;
            }

            $customer = $this->customer->get_customer_by_email($data['email']);
            if (!$customer) {
                $this->api->send_error('Account does not exist', 400);;
                return;
            }
            $token = $this->jwt->generate_token([
                'customerid' => $customer['customerid'],
                'email' => $customer['email'],
                'roles' => $customer['roles'] ?? ['customer'],
                'purpose' => 'reset_password',
                'exp' => time() + 1800 // 30 minutes
            ]);

            $this->cache->save($customer['customerid'], $token, 1800); // Cache for 30 minutes

            // Create reset link and send email
            $reset_link = site_url('reset-password/' . $token);
            $this->email->send_password_reset($customer, $reset_link);

            $this->api->send_response(
                ['email'  => $data['email']],
                'If your email exists in our system, you will receive password reset instructions.'
            );
        } catch (Exception $e) {
            error_log('Password reset error: ' . $e->getMessage());
            $this->api->send_error('Failed to process password reset request', 500);
        }
    }

    public function verify_reset_token()
    {
        try {
            $token = $this->input->get('token');
            if (!$token) {
                $this->api->send_error('Token is required', 400);
                return;
            }
            $verified = $this->jwt->verify_token($token);
            if (!$verified || $verified['purpose'] !== 'reset_password') {
                $this->api->send_error('Invalid or expired reset token', 401);
                return;
            }
            $customer = $this->customer->get_customer($verified['customerid']);
            if (!$customer) {
                $this->api->send_error('Customer not found', 404);
                return;
            }

            if ($this->cache->get($customer['customerid']) !== $token) {
                $this->api->send_error('Invalid or expired reset token', 401);
                return;
            }

            $this->api->send_response(null, 'Reset token is valid');
        } catch (Exception $e) {
            error_log('Token verification error: ' . $e->getMessage());
            $this->api->send_error('Failed to verify token', 500);
        }
    }

    public function reset_password()
    {
        try {
            $data = $this->api->get_json_input();
            if (!isset($data['password'])) {
                $this->api->send_error('Missing required fields', 400);
                return;
            }

            $customer = $this->api->user_data;
            if (!$customer) {
                $this->api->send_error('Customer not found', 404);
                return;
            }

            $this->customer->update_password($customer['customerid'], $data['password']);
            $this->email->send_password_changed($customer);
            $this->customer->invalidate_token($customer['customerid']);

            $this->api->send_response(null, 'Password has been reset successfully');
        } catch (Exception $e) {
            error_log('Password reset error: ' . $e->getMessage());
            $this->api->send_error('Failed to reset password', 500);
        }
    }

    public function refresh()
    {
        try {
            $refresh_token = $this->input->get_request_header('Refresh-Token');
            if (!$refresh_token) {
                $this->api->send_error('Refresh token required', 400);
                return;
            }

            $verified = $this->jwt->verify_refresh_token($refresh_token);
            if (!$verified) {
                $this->api->send_error('Invalid refresh token', 401);
                return;
            }

            $customer = $this->customer->get_customer($verified['customerid']);
            if (!$customer) {
                $this->api->send_error('Customer not found', 404);
                return;
            }

            // Generate new access token
            $token_data = [
                'customerid' => $customer['customerid'],
                'email' => $customer['email'],
                'roles' => $customer['roles'] ?? ['customer'],
                'permissions' => $this->customer->get_permissions($customer['customerid']),
                'purpose' => 'authentication'
            ];

            $new_access_token = $this->jwt->generate_token($token_data);

            // Update stored token
            $this->cache->save($customer['customerid'], $new_access_token, 7200); // Cache for 2 hours

            $this->api->send_response([
                'access_token' => $new_access_token
            ], 'Token refreshed successfully');
        } catch (Exception $e) {
            error_log('Token refresh error: ' . $e->getMessage());
            $this->api->send_error('Token refresh failed', 500);
        }
    }
}
