<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment_model');
        $this->load->model('booking_model');
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
     * List available payment methods
     * This endpoint can be public as it only shows available methods
     */
    public function methods()
    {
        try {
            $methods = $this->payment_model->get_payment_methods();

            if (!$methods) {
                $this->api_handler->send_error('No payment methods found', 404);
                return;
            }

            $this->api_handler->send_response(
                ['methods' => $methods],
                'Payment methods retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting payment methods: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to retrieve payment methods', 500);
        }
    }

    /**
     * Process payment for booking
     */
    public function process()
    {
        try {
            // Validate JSON input
            $json = $this->api_handler->get_json_input();
            if (!$json) return;

            // Validate required fields
            $required = ['booking_id', 'payment_method', 'amount'];
            $missing = [];

            foreach ($required as $field) {
                if (!isset($json[$field]) || empty($json[$field])) {
                    $missing[] = $field;
                }
            }

            if (!empty($missing)) {
                $this->api_handler->send_error('Missing required fields: ' . implode(', ', $missing), 400);
                return;
            }

            // Validate amount format
            if (!is_numeric($json['amount']) || $json['amount'] <= 0) {
                $this->api_handler->send_error('Invalid amount value', 400);
                return;
            }

            // Verify booking ownership if not admin
            if ($this->api_handler->user_data['role'] !== 'admin') {
                $booking = $this->booking_model->get_booking($json['booking_id']);

                if (!$booking || $booking['cutomerid'] !== $this->api_handler->user_data['customerid']) {
                    $this->api_handler->send_error('Unauthorized access to booking', 403);
                    return;
                }
            }

            // Process payment based on method
            $payment_data = [
                'booking_id' => $json['booking_id'],
                'payment_method' => $json['payment_method'],
                'amount' => floatval($json['amount']),
                'currency' => $json['currency'] ?? 'USD',
                'metadata' => $json['metadata'] ?? null,
                'customer_id' => $this->api_handler->user_data['customerid']
            ];

            // Process payment through gateway if needed
            if (in_array($json['payment_method'], ['stripe', 'paypal', 'paystack'])) {
                $gateway_response = $this->process_gateway_payment($json['payment_method'], $payment_data);
                if (!$gateway_response['success']) {
                    $this->api_handler->send_error($gateway_response['message'], 400);
                    return;
                }
                $payment_data['metadata']['gateway_response'] = $gateway_response['data'];
            }

            $result = $this->payment_model->process_payment($payment_data);

            $this->api_handler->send_response(
                ['payment' => $result],
                'Payment processed successfully'
            );

        } catch (Exception $e) {
            error_log('Payment processing error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to process payment', 500);
        }
    }

    /**
     * Verify payment status
     */
    public function verify($booking_id)
    {
        try {
            if (!$booking_id || !is_numeric($booking_id)) {
                $this->api_handler->send_error('Valid booking ID is required', 400);
                return;
            }

            // Verify booking ownership if not admin
            if ($this->api_handler->user_data['role'] !== 'admin') {
                $this->load->model('api/booking_model');
                $booking = $this->booking_model->get_booking($booking_id);

                if (!$booking || $booking['cutomerid'] !== $this->api_handler->user_data['customerid']) {
                    $this->api_handler->send_error('Unauthorized access to booking', 403);
                    return;
                }
            }

            // Check if payment exists
            $verification = $this->payment_model->verify_payment($booking_id);

            if (!$verification) {
                $this->api_handler->send_error('No payment found for this booking', 404);
                return;
            }

            $this->api_handler->send_response(
                ['verification' => $verification],
                'Payment verification completed'
            );
        } catch (Exception $e) {
            error_log('Payment verification error: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to verify payment', 500);
        }
    }

    private function process_gateway_payment($method, $payment_data)
    {
        $gateway_module = APPPATH . 'modules/' . $method . '/controllers/payment.php';
        
        if (!file_exists($gateway_module)) {
            return ['success' => false, 'message' => 'Payment method not available'];
        }

        require_once($gateway_module);
        $gateway = new $method();
        return $gateway->process($payment_data);
    }
}
