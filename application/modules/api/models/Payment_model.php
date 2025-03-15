<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all active payment methods
     */
    public function get_payment_methods()
    {
        return $this->db->select('payment_method_id, payment_method')
            ->from('payment_method')
            ->where('is_active', 1)
            ->get()
            ->result();
    }

    /**
     * Process a payment
     */
    private function generate_invoice_number($prefix = 'INV')
    {
        $date = date('Ymd');
        $rand = rand(1000, 9999);
        return $prefix . $date . $rand;
    }

    private function determine_booking_type($booking_id)
    {
        // Check if it's a hall room booking
        $hall_booking = $this->db->where('booking_id', $booking_id)
            ->get('hall_room_booking')
            ->row();
        return $hall_booking ? 1 : 0; // 1 for hall, 0 for room
    }

    private function get_payment_details($booking_type, $amount)
    {
        $types = [
            0 => 'Room booking payment',
            1 => 'Hall room booking payment'
        ];
        return $types[$booking_type] . ' - Amount: ' . number_format($amount, 2);
    }

    public function process_payment($payment_data)
    {
        $this->db->trans_start();

        try {
            // First verify the booking exists and get payment info
            $booking = $this->db->select('total_price, paid_amount, bookingstatus')
                ->from('booked_info')
                ->where('bookedid', $payment_data['booking_id'])
                ->get()
                ->row();

            if (!$booking) {
                throw new Exception('Booking not found');
            }

            // Verify payment method is active
            $payment_method = $this->db->where('payment_method_id', $payment_data['payment_method'])
                ->where('is_active', 1)
                ->get('payment_method')
                ->row();
            
            if (!$payment_method) {
                throw new Exception('Invalid or inactive payment method');
            }

            // Generate invoice number
            $invoice = $this->generate_invoice_number();
            $booking_type = $this->determine_booking_type($payment_data['booking_id']);

            // Create payment record
            $payment = [
                'bookedid' => $payment_data['booking_id'],
                'paymenttype' => $payment_method->payment_method,
                'paymentamount' => $payment_data['amount'],
                'paydate' => date('Y-m-d H:i:s'),
                'invoice' => $invoice,
                'book_type' => $booking_type,
                'details' => $this->get_payment_details($booking_type, $payment_data['amount']),
                'metadata' => json_encode($payment_data['metadata'] ?? null)
            ];

            $this->db->insert('tbl_guestpayments', $payment);
            $payment_id = $this->db->insert_id();

            // Update booking paid amount
            $new_paid_amount = $booking->paid_amount + $payment_data['amount'];
            $this->db->where('bookedid', $payment_data['booking_id'])
                ->update('booked_info', ['paid_amount' => $new_paid_amount]);

            // Update booking status if fully paid
            if ($new_paid_amount >= $booking->total_price) {
                $this->db->where('bookedid', $payment_data['booking_id'])
                    ->update('booked_info', ['bookingstatus' => 1]); // 1 = confirmed
            }

            // Update customer balance
            if (isset($payment_data['customer_id'])) {
                $this->db->set('balance', 'balance+' . $payment_data['amount'], FALSE)
                    ->where('customerid', $payment_data['customer_id'])
                    ->update('customerinfo');
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            return [
                'payment_id' => $payment_id,
                'invoice_number' => $invoice,
                'amount_paid' => $payment_data['amount'],
                'total_paid' => $new_paid_amount,
                'total_price' => $booking->total_price,
                'is_fully_paid' => ($new_paid_amount >= $booking->total_price),
                'payment_details' => $payment['details']
            ];

        } catch (Exception $e) {
            $this->db->trans_rollback();
            throw $e;
        }
    }

    /**
     * Verify payment status for a booking
     */
    public function verify_payment($booking_id)
    {
        // Get booking payment info
        $booking = $this->db->select('bi.bookedid, bi.total_price, bi.paid_amount, bi.bookingstatus')
            ->from('booked_info bi')
            ->where('bi.bookedid', $booking_id)
            ->get()
            ->row();

        if (!$booking) {
            throw new Exception('Booking not found');
        }

        // Get payment history
        // Get payment history
        $payments = $this->db->select('paymenttype, paymentamount, paydate, invoice, details, book_type')
            ->from('tbl_guestpayments')
            ->where('bookedid', $booking_id)
            ->order_by('paydate', 'DESC')
            ->get()
            ->result_array();

        // Format payment history
        $formatted_payments = array_map(function ($payment) {
            return [
                'invoice_number' => $payment['invoice'],
                'payment_method' => $payment['paymenttype'],
                'amount' => $payment['paymentamount'],
                'date' => $payment['paydate'],
                'booking_type' => $payment['book_type'] ? 'Hall Room' : 'Room',
                'details' => $payment['details']
            ];
        }, $payments);

        return [
            'booking_id' => $booking->bookedid,
            'payment_status' => [
                'total_price' => $booking->total_price,
                'amount_paid' => $booking->paid_amount,
                'remaining_amount' => $booking->total_price - $booking->paid_amount,
                'is_fully_paid' => ($booking->paid_amount >= $booking->total_price),
                'booking_status' => $booking->bookingstatus
            ],
            'payment_history' => $formatted_payments
        ];
    }
}
