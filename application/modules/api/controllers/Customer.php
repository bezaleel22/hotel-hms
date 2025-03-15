<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/customer_model');
        $this->load->library(['api/api_handler', 'api/jwt_handler']);

        // All customer management endpoints require authentication
        $this->api_handler->authenticate(['customer']);
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
     * Get customer details
     */
    public function details($id)
    {
        try {
            // Verify access rights
            if (
                $this->api_handler->user_data['role'] !== 'admin' &&
                $this->api_handler->user_data['customerid'] != $id
            ) {
                $this->api_handler->send_error('Unauthorized access', 403);
                return;
            }

            $customer = $this->customer_model->get_customer($id);

            if (!$customer) {
                $this->api_handler->send_error('Customer not found', 404);
                return;
            }

            $this->api_handler->send_response(['customer' => $customer]);
        } catch (Exception $e) {
            $this->api_handler->send_error('Failed to retrieve customer details', 500);
        }
    }

    public function update($id)
    {
        try {
            // Verify access rights
            if (
                $this->api_handler->user_data['role'] !== 'admin' &&
                $this->api_handler->user_data['customerid'] != $id
            ) {
                $this->api_handler->send_error('Unauthorized access', 403);
                return;
            }

            $json = $this->get_json_input();
            if (!$json) return;

            $customer = $this->customer_model->update_customer($id, $json);

            $this->api_handler->send_response(
                ['customer' => $customer],
                'Customer information updated successfully'
            );
        } catch (Exception $e) {
            $this->api_handler->send_error($e->getMessage(), 400);
        }
    }

    public function bookings($id)
    {
        try {
            // Verify access rights
            if (
                $this->api_handler->user_data['role'] !== 'admin' &&
                $this->api_handler->user_data['customerid'] != $id
            ) {
                $this->api_handler->send_error('Unauthorized access', 403);
                return;
            }

            $customer = $this->customer_model->get_customer($id);

            if (!$customer) {
                $this->api_handler->send_error('Customer not found', 404);
                return;
            }

            $this->api_handler->send_response([
                'customer_id' => $id,
                'bookings' => $customer['bookings']
            ]);
        } catch (Exception $e) {
            $this->api_handler->send_error('Failed to retrieve booking history', 500);
        }
    }

    public function change_password($id)
    {
        try {
            // Verify access rights
            if (
                $this->api_handler->user_data['role'] !== 'admin' &&
                $this->api_handler->user_data['customerid'] != $id
            ) {
                $this->api_handler->send_error('Unauthorized access', 403);
                return;
            }

            $json = $this->api_handler->get_json_input();
            if (!$json) return;

            if (!isset($json['current_password']) || !isset($json['new_password'])) {
                $this->api_handler->send_error('Current and new passwords are required', 400);
                return;
            }

            // Verify current password
            $customer = $this->db->where('customerid', $id)
                ->get('customerinfo')
                ->row_array();

            if (!password_verify($json['current_password'], $customer['pass'])) {
                $this->api_handler->send_error('Current password is incorrect', 400);
                return;
            }

            // Update password
            $this->db->where('customerid', $id)
                ->update('customerinfo', [
                    'pass' => password_hash($json['new_password'], PASSWORD_DEFAULT)
                ]);

            $this->api_handler->send_response(
                null,
                'Password updated successfully'
            );
        } catch (Exception $e) {
            $this->api_handler->send_error('Failed to update password', 500);
        }
    }
}
