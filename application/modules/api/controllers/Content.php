<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends MX_Controller
{
    /**
     * Api handler instance
     * @var Api_handler
     */
    protected $api;

    /**
     * Content model instance
     * @var Content_model
     */
    protected $content;

    /**
     * Email handler instance
     * @var Email_handler
     */
    protected $email;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('api/api_handler');
        $this->load->model('api/content_model');
        $this->load->library('api/email_handler');
        $this->api = $this->api_handler;
        $this->content = $this->content_model;
        $this->email = $this->email_handler;
    }

    /**
     * Get home page content
     */
    public function home()
    {
        try {
            $data = $this->content->get_home_content();
            $this->api->send_response(
                $data,
                'Home content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting home content: ' . $e->getMessage());
            $this->api->send_error('Failed to retrieve home content', 500);
        }
    }

    /**
     * Get about page content
     */
    public function about()
    {
        try {
            $data = $this->content->get_about_content();
            $this->api->send_response(
                $data,
                'About page content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting about content: ' . $e->getMessage());
            $this->api->send_error('Failed to retrieve about content', 500);
        }
    }

    /**
     * Get gallery content
     */
    public function gallery()
    {
        try {
            $data = $this->content->get_gallery_content();
            $this->api->send_response(
                $data,
                'Gallery content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting gallery content: ' . $e->getMessage());
            $this->api->send_error('Failed to retrieve gallery content', 500);
        }
    }

    /**
     * Get page content by ID
     */
    public function page($id)
    {
        try {
            $data = $this->content->get_page_content($id);

            if (!$data) {
                $this->api->send_error('Page not found', 404);
                return;
            }

            $this->api->send_response(
                $data,
                'Page content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting page content: ' . $e->getMessage());
            $this->api->send_error('Failed to retrieve page content', 500);
        }
    }

    /**
     * Handle privacy policy request
     */
    public function privacy()
    {
        $data['title'] = "Privacy Policy";
        $data['content'] = $this->load->view('privacy', $data, TRUE);
        $this->api->send_response($data, 'Privacy policy retrieved successfully', 200);
    }

    /**
     * Handle terms and conditions request
     */
    public function terms()
    {
        $data['title'] = "Our Terms & Condition";
        $data['content'] = $this->load->view('terms', $data, TRUE);
        $this->api->send_response($data, 'Terms and conditions retrieved successfully', 200);
    }

    /**
     * Submit contact message
     */
    public function contact()
    {
        try {
            $json = $this->api->get_json_input();

            // Validate required fields
            $required_fields = ['name', 'email', 'message'];
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
                $this->api->send_error(implode(' ', $errors), 400);
                return;
            }

            $data = [
                'name' => trim($json['name']),
                'email' => strtolower(trim($json['email'])),
                'phone' => trim($json['phone'] ?? ''),
                'message' => trim($json['message']),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $sent = $this->email->send_contact_notification($data);
            if (!$sent) {
                throw new Exception('Failed to send contact notification email');
            }

            $this->api->send_response(['email_sent' => $sent], 'Contact message submitted successfully');
        } catch (Exception $e) {
            error_log('Contact message submission error: ' . $e->getMessage());
            $this->api->send_error('Failed to process contact message submission', 500);
        }
    }

    /**
     * Subscribe to newsletter
     */
    public function subscribe()
    {
        try {
            $data = $this->api->get_json_input();
            if (empty($data['email'])) {
                $this->api->send_error('The email field is required', 400);
                return;
            }

            $email = strtolower(trim($data['email']));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->api->send_error('Invalid email format', 400);
                return;
            }

            // Check if already subscribed
            if ($this->content->is_subscribed($email)) {
                $this->api->send_error('Email already subscribed', 409);
                return;
            }

            $result = $this->content->save_subscription($email);
            $sent = $this->email->send_subscription_confirmation($result);
            if (!$sent) {
                throw new Exception('Failed to send subscription confirmation email');
            }

            $this->api->send_response(
                ['email_sent' => $sent],
                'Thank you for subscribing! A confirmation email has been sent.'
            );
        } catch (Exception $e) {
            error_log('Subscription error: ' . $e->getMessage());
            $this->api->send_error('Failed to process subscription', 500);
        }
    }
}
