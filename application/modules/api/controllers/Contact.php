<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/contact_model');
        $this->load->library('api/api_handler');
    }

    /**
     * Submit contact form
     */
    public function submit()
    {
        try {
            $json = $this->get_json_input();
            if (!$json) return;

            // Validate required fields
            $required_fields = ['name', 'email', 'phone', 'message'];
            $errors = [];

            foreach ($required_fields as $field) {
                if (empty($json[$field])) {
                    $errors[] = "The {$field} field is required.";
                }
            }

            // Additional email validation
            if (!empty($json['email']) && !filter_var($json['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (!empty($errors)) {
                $this->api_handler->send_error(implode(' ', $errors), 400);
                return;
            }

            $data = [
                'name' => trim($json['name']),
                'email' => strtolower(trim($json['email'])),
                'phone' => trim($json['phone']),
                'message' => trim($json['message']),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $result = $this->contact_model->save_message($data);

            $this->api_handler->send_response(
                [
                    'reference' => $result['reference'],
                    'email_sent' => $result['email_sent']
                ],
                'Message sent successfully'
            );

        } catch (Exception $e) {
            error_log('Contact submission error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to process contact submission', 500);
        }
    }

    /**
     * Subscribe to newsletter
     */
    public function subscribe()
    {
        try {
            $json = $this->get_json_input();
            if (!$json) return;

            if (empty($json['email'])) {
                $this->api_handler->send_error('The email field is required', 400);
                return;
            }

            $email = strtolower(trim($json['email']));

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->api_handler->send_error('Invalid email format', 400);
                return;
            }

            // Check if already subscribed
            if ($this->contact_model->is_subscribed($email)) {
                $this->api_handler->send_error('Email already subscribed', 409);
                return;
            }

            $data = [
                'email' => $email,
                'dateinsert' => date('Y-m-d H:i:s')
            ];

            $result = $this->contact_model->save_subscription($data);

            $this->api_handler->send_response(
                [
                    'subscription_id' => $result['subscription_id'],
                    'email_sent' => $result['email_sent']
                ],
                'Subscription successful'
            );

        } catch (Exception $e) {
            error_log('Subscription error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to process subscription', 500);
        }
    }

    /**
     * Verify subscription
     */
    public function verify($token)
    {
        try {
            if (empty($token)) {
                $this->api_handler->send_error('Invalid verification token', 400);
                return;
            }

            $verified = $this->contact_model->verify_subscription($token);

            if ($verified) {
                $this->api_handler->send_response(
                    null,
                    'Subscription verified successfully'
                );
            } else {
                $this->api_handler->send_error('Invalid or expired verification token', 400);
            }

        } catch (Exception $e) {
            error_log('Verification error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to verify subscription', 500);
        }
    }

    /**
     * Get JSON input
     */
    private function get_json_input()
    {
        $json = json_decode(file_get_contents('php://input'), true);
        if (!$json) {
            $this->api_handler->send_error('Invalid JSON payload', 400);
            return null;
        }
        return $json;
    }
}
