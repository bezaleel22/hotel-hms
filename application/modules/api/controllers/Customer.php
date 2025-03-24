<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MX_Controller
{
    /**
     * Api handler instance
     * @var Api_handler
     */
    protected $api;

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
        $this->load->library('api/api_handler');
        $this->load->model('api/customer_model');
        $this->api = $this->api_handler;
        $this->customer = $this->customer_model;
        $this->api->authenticate(['customer', 'admin']);
    }

    /**
     * Get customer details
     */
    public function details()
    {
        try {
            $id = $this->api->user_data['customerid'];
            $customer = $this->customer->get_customer($id);
            if (!$customer) {
                $this->api->send_error('Customer not found', 404);
                return;
            }
            $this->api->send_response(['customer' => $customer]);
        } catch (Exception $e) {
            $this->api->send_error('Failed to retrieve customer details', 500);
        }
    }

    public function update()
    {
        try {
            $id = $this->api->user_data['customerid'];
            $json = $this->api->get_json_input();
            if (!$json) return;
            $customer = $this->customer->update_customer($id, $json);
            $this->api->send_response(
                ['customer' => $customer],
                'Customer information updated successfully'
            );
        } catch (Exception $e) {
            $this->api->send_error($e->getMessage(), 400);
        }
    }

    public function bookings()
    {
        try {
            $id = $this->api->user_data['customerid'];
            $customer = $this->customer->get_customer($id);
            if (!$customer) {
                $this->api->send_error('Customer not found', 404);
                return;
            }
            $this->api->send_response([
                'customer_id' => $id,
                'bookings' => $customer['bookings']
            ]);
        } catch (Exception $e) {
            $this->api->send_error('Failed to retrieve booking history', 500);
        }
    }
}
