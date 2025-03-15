<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/booking_model');
        $this->load->library(['api/api_handler', 'api/jwt_handler']);

        $protected_methods = ['create', 'update', 'cancel', 'process_payment', 'history', 'stats'];
        if (in_array($this->router->fetch_method(), $protected_methods)) {
            $this->api_handler->authenticate(['customer', 'admin']);
        }
    }

    public function create()
    {
        try {
            $data = $this->api_handler->get_json_input();
            if (!$data) throw new Exception('Invalid JSON payload');

            $result = $this->Booking_model->create_booking($data);
            $this->api_handler->sendResponse($result);
        } catch (Exception $e) {
            $this->api_handler->sendError($e->getMessage());
        }
    }

    public function details($id)
    {
        try {
            $booking = $this->Booking_model->get_booking($id);
            if (!$booking) {
                $this->api_handler->sendError('Booking not found', 404);
                return;
            }
            $this->api_handler->sendResponse($booking);
        } catch (Exception $e) {
            $this->api_handler->sendError($e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = $this->api_handler->get_json_input();
            if (!$data) throw new Exception('Invalid JSON payload');

            $result = $this->Booking_model->update_booking($id, $data);
            $this->api_handler->sendResponse($result);
        } catch (Exception $e) {
            $this->api_handler->sendError($e->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            $data = $this->api_handler->get_json_input();
            if (!$data) throw new Exception('Invalid JSON payload');

            $result = $this->Booking_model->cancel_booking($id, $data['reason'] ?? null);
            $this->api_handler->sendResponse($result);
        } catch (Exception $e) {
            $this->api_handler->sendError($e->getMessage());
        }
    }

    public function process_payment()
    {
        try {
            $data = $this->api_handler->get_json_input();
            if (!$data) throw new Exception('Invalid JSON payload');

            $result = $this->Booking_model->process_payment($data);
            $this->api_handler->sendResponse($result);
        } catch (Exception $e) {
            $this->api_handler->sendError($e->getMessage());
        }
    }

    public function history()
    {
        try {
            $customerId = $this->api_handler->user_data['customerid'];
            $history = $this->Booking_model->get_booking_history($customerId);
            $this->api_handler->sendResponse($history);
        } catch (Exception $e) {
            $this->api_handler->sendError($e->getMessage());
        }
    }

    public function stats()
    {
        try {
            if ($this->api_handler->user_data['role'] !== 'admin') {
                $this->api_handler->sendError('Unauthorized', 403);
                return;
            }
            $stats = $this->Booking_model->get_booking_stats();
            $this->api_handler->sendResponse($stats);
        } catch (Exception $e) {
            $this->api_handler->sendError($e->getMessage());
        }
    }
}
