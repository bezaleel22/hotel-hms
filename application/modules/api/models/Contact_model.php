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
     * Save contact message and send notification
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
            $this->db->insert('contact_messages', $contact_data);

            if ($this->db->affected_rows() === 0) {
                throw new Exception('Failed to save contact message');
            }

            // Prepare template data for email
            return [
                'name' => $contact_data['name'],
                'email' => $contact_data['email'],
                'phone' => $contact_data['phone'],
                'message' => $contact_data['message'],
                'reference' => $contact_data['reference'],
                'settings' => $this->settings
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
            ->get('subscribe_emaillist')
            ->num_rows() > 0;
    }

    /**
     * Save newsletter subscription and send confirmation
     */
    public function save_subscription($email)
    {
        try {
            // Prepare subscription data
            $subscription_data = [
                'email' => $email,
                'dateinsert' => date('Y-m-d H:i:s')
            ];

            // Insert subscription
            $this->db->insert('subscribe_emaillist', $subscription_data);
            if ($this->db->affected_rows() === 0) {
                throw new Exception('Failed to save subscription');
            }
            return $subscription_data;

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

}
