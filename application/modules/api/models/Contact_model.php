<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact_model extends CI_Model
{

    private $settings;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/setting_model');

        // Load system settings
        $this->settings = $this->setting_model->get_settings();
    }

    /**
     * Save contact form message and send notification
     */
    public function save_message($data)
    {
        try {
            // Prepare contact data
            $contact_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'message' => $data['message'],
                'created_at' => $data['created_at'],
                'status' => 'new',
                'reference' => 'MSG' . date('YmdHis')
            ];

            // Insert into database
            $this->db->insert('contact_messages', $contact_data);
            
            if ($this->db->affected_rows() === 0) {
                throw new Exception('Failed to save contact message');
            }

            // Prepare template data for email
            $template_data = [
                'name' => $contact_data['name'],
                'email' => $contact_data['email'],
                'phone' => $contact_data['phone'],
                'message' => $contact_data['message'],
                'reference' => $contact_data['reference'],
                'settings' => $this->settings
            ];

            // Load Email_handler library
            $this->load->library('api/email_handler');

            // Send notification using contact_form template
            $email_sent = $this->email_handler->send(
                null, // To address will be determined from email config
                'Contact Inquiry',
                'contact_form',
                $template_data,
                'contact_form'  // Permission check identifier
            );

            return [
                'reference' => $contact_data['reference'],
                'email_sent' => $email_sent
            ];

        } catch (Exception $e) {
            log_message('error', 'Failed to save contact message: ' . $e->getMessage());
            throw new Exception('Failed to process contact message');
        }
    }

    /**
     * Check if email is already subscribed
     */
    public function is_subscribed($email)
    {
        return $this->db->where('email', $email)
            ->where('status', 'active')
            ->get('subscribe_emaillist')
            ->num_rows() > 0;
    }

    /**
     * Save newsletter subscription and send confirmation
     */
    public function save_subscription($data)
    {
        try {
            // Prepare subscription data
            $subscription_data = [
                'email' => $data['email'],
                'dateinsert' => $data['dateinsert'],
                'status' => 'active',
                'verification_token' => md5(uniqid(rand(), true))
            ];

            // Insert subscription
            $this->db->insert('subscribe_emaillist', $subscription_data);

            if ($this->db->affected_rows() === 0) {
                throw new Exception('Failed to save subscription');
            }

            // Get app settings
            $app_settings = $this->db->select("title")
                ->from("setting")
                ->where("id", 2)
                ->get()
                ->row();

            // Prepare template data
            $template_data = [
                'email' => $subscription_data['email'],
                'app_name' => $app_settings->title,
                'subscription_date' => $subscription_data['dateinsert'],
                'verification_token' => $subscription_data['verification_token'],
                'settings' => $this->settings
            ];

            // Send confirmation email
            $this->load->library('api/email_handler');
            $email_sent = $this->email_handler->send(
                $data['email'],
                'Newsletter Subscription Confirmation',
                'newsletter_subscription',
                $template_data,
                'subscription'
            );

            return [
                'subscription_id' => $this->db->insert_id(),
                'email_sent' => $email_sent
            ];

        } catch (Exception $e) {
            log_message('error', 'Failed to process subscription: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get subscription status
     */
    public function get_subscription_status($email)
    {
        $subscription = $this->db->select('id, email, dateinsert, status')
            ->from('subscribe_emaillist')
            ->where('email', $email)
            ->get()
            ->row_array();

        return $subscription ?: ['status' => 'not_found'];
    }

    /**
     * Update subscription status
     */
    public function update_subscription_status($email, $status)
    {
        return $this->db->where('email', $email)
            ->update('subscribe_emaillist', ['status' => $status]);
    }

    /**
     * Verify subscription token
     */
    public function verify_subscription($token)
    {
        $subscription = $this->db->where('verification_token', $token)
            ->where('status', 'active')
            ->get('subscribe_emaillist')
            ->row_array();

        if ($subscription) {
            $this->db->where('id', $subscription['id'])
                ->update('subscribe_emaillist', [
                    'status' => 'verified',
                    'verification_token' => null
                ]);
            return true;
        }

        return false;
    }
}
