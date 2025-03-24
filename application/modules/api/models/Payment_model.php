<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    /**
     * Cart handler instance
     * @var Cart_handler
     */
    protected $cart;

    /**
     * Setting model instance
     * @var Setting_model
     */
    protected $setting;

    /**
     * Paystack instance
     * @var Paystack
     */
    protected $gateway;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/setting_model');
        $this->load->library(['api/cart_handler', 'api/paystack']);

        $this->cart = $this->cart_handler;
        $this->setting = $this->setting_model;
        $this->gateway = $this->paystack;
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
     * Generate invoice number
     */
    public function generate_invoice_number()
    {
        $payinfo = $this->db->select("*")->from('tbl_guestpayments')->order_by('payid', 'desc')->get()->row();
        $invoicenum = !empty($payinfo) ? $payinfo->invoice : "000000";
        $nextno = $invoicenum + 1;
        $bk_length = strlen((int)$nextno);
        $bkstr = '000000';
        $bknumber = substr($bkstr, $bk_length);
        return $bknumber . $nextno;
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

    public function validate_signature($signature, $payload )
    {
        $secret_key = $this->gateway->get_secret_key();
        // return $secret_key;
        return hash_hmac('sha512', $payload, $secret_key) === $signature;
    }

    public function process_payment($payment_data)
    {

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
            $pmethod = $this->db->where('payment_method_id', $payment_data['payment_method'])
                ->where('is_active', 1)
                ->get('payment_method')
                ->row();

            if (!$pmethod) {
                throw new Exception('Invalid or inactive payment method');
            }

            // Generate invoice number
            $invoice = $this->generate_invoice_number();
            $booking_type = $this->determine_booking_type($payment_data['booking_id']);

            // Create payment record
            $payment = [
                'bookedid' => $payment_data['booking_id'],
                'paymenttype' => $pmethod->payment_method,
                'paymentamount' => $payment_data['amount'],
                'paydate' => date('Y-m-d H:i:s'),
                'invoice' => $invoice,
                'book_type' => 0,
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

            // Perform transactions
            $saveid = 1;
            $metadata = $payment_data['metadata'];
            $customer_headcode = 102030101;
            $newdate = date('Y-m-d');
            $paid_amount = $payment_data['amount'];

            // Customer debit for Rent Value
            $narration = 'Customer debit for website advance payment Rent Invoice#' . $invoice;
            transaction($invoice, 'CIV', $newdate, $customer_headcode, $narration, $paid_amount, 0, 0, 1, $saveid, $newdate, 1);

            // Hotel Owner credit for Rent Value
            $narration = 'Hotel Credit for website advance payment Rent Invoice#' . $invoice;
            transaction($invoice, 'CIV', $newdate, 30301, $narration, 0, $paid_amount, 0, 1, $saveid, $newdate, 1);

            // Customer Credit for paid amount
            $narration = 'Customer Credit for website advance payment Rent Invoice#' . $invoice;
            transaction($invoice, 'CIV', $newdate, $customer_headcode, $narration, 0, $paid_amount, 0, 1, $saveid, $newdate, 1);

            // Payment method debit
            $narration = 'Cash in ' . $metadata['payment_method'] . ' Debited For website advance payment Invoice#' . $invoice;
            transaction($invoice, 'CIV', $newdate, 102010303, $narration, $paid_amount, 0, 0, 1, $saveid, $newdate, 1);

            // Get full booking and customer details for invoice
            $booking_details = $this->db->select('*')
                ->from('booked_info')
                ->where('bookedid', $payment_data['booking_id'])
                ->get()
                ->row();

            $customer_details = $this->db->select('*')
                ->from('customerinfo')
                ->where('customerid', $payment_data['customer_id'])
                ->get()
                ->row_array();

            // Generate PDF invoice
            $invoice_path = $this->generate_pdf_invoice($payment, $booking_details, $customer_details);

            return [
                'payment_id' => $payment_id,
                'invoice_number' => $invoice,
                'amount_paid' => $payment_data['amount'],
                'total_paid' => $new_paid_amount,
                'total_price' => $booking->total_price,
                'is_fully_paid' => ($new_paid_amount >= $booking->total_price),
                'payment_details' => $payment['details'],
                'invoice_path' => $invoice_path
            ];
        } catch (Exception $e) {
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

    /**
     * Verify Paystack transaction and process payment
     *
     * @param string $reference Transaction reference
     * @return array Transaction verification and payment processing response
     * @throws Exception
     */
    public function verify_paystack_transaction($reference)
    {
        try {
            $verification = $this->gateway->verify_transaction($reference);

            // Only process successful transactions
            if ($verification['status'] !== 'success') {
                throw new Exception('Payment verification failed: ' . $verification['gateway_response']);
            }

            // Get metadata from verification response
            $metadata = $verification['metadata'];

            // Process the payment
            return [
                'booking_id' => $metadata['booking_number'],
                'amount' => $verification['amount'] / 100, // Convert from kobo back to actual amount
                'currency' => $verification['currency'],
                'payment_method' => $metadata['payment_method'],
                'customer_id' => $metadata['customer_id'],
                'metadata' => [
                    'paystack_reference' => $reference,
                    'authorization' => $verification['authorization'],
                    'transaction_date' => $verification['transaction_date']
                ]
            ];
        } catch (Exception $e) {
            log_message('error', 'Paystack verification error: ' . $e->getMessage());
            throw new Exception('Failed to verify payment: ' . $e->getMessage());
        }
    }

    /**
     * Initialize Paystack payment transaction for a booking
     *
     * @param string $bknumber Booking reference number
     * @param array $data Array containing:
     *      - callback_url: URL to redirect to after payment
     *      - pmethod: Payment method identifier
     * @return array Response containing:
     *      - authorization_url: Paystack checkout URL
     *      - access_code: Payment access code
     *      - reference: Transaction reference
     * @throws Exception If payment initialization fails
     */
    public function initialize_paystack_transaction($bknumber, $data)
    {
        $cart = $this->cart->contents();
        if (empty($cart)) {
            throw new Exception('Cart is empty');
        }

        foreach ($cart as $item) {
            $cart = $item;
        }

        $payment = [
            // 'reference' => $bknumber,
            'email' => $cart['email'],
            'amount' => $cart['totalprice'],
            'currency' => $this->get_currency(),
            'callback_url' => $data['callback_url'],
            'metadata' => [
                'customer_id' => $cart['customerid'],
                'fullname' => $cart['fullName'],
                'room_id' => $cart['roomid'],
                'booking_number' => $bknumber,
                'payment_method' => $data['pmethod']
            ]
        ];

        try {
            $result = $this->gateway->initialize_transaction($payment);
            return [
                'authorization_url' => $result['authorization_url'],
                'access_code' => $result['access_code'],
                'reference' => $result['reference']
            ];
        } catch (Exception $e) {
            log_message('error', 'Paystack initialization error: ' . $e->getMessage());
            throw new Exception('Failed to initialize payment: ' . $e->getMessage());
        }
    }

    /**
     * Generate PDF invoice for a payment
     */
    private function generate_pdf_invoice($payment_data, $booking, $customer)
    {
        // Load PDF generator library
        $this->CI->load->library('pdfgenerator');

        // Prepare data for invoice template
        $template_data = [
            'hotel_logo' => base_url('assets/uploads/' . $this->CI->setting_model->get_setting('logo')),
            'hotel_name' => $this->CI->setting_model->get_setting('title'),
            'hotel_address' => $this->CI->setting_model->get_setting('address'),
            'hotel_email' => $this->CI->setting_model->get_setting('email'),
            'hotel_phone' => $this->CI->setting_model->get_setting('phone'),

            'invoice_number' => $payment_data['invoice'],
            'invoice_date' => date('d M Y', strtotime($payment_data['paydate'])),

            'customer_name' => $customer['firstname'] . ' ' . $customer['lastname'],
            'customer_address' => $customer['address'],
            'customer_email' => $customer['email'],
            'customer_phone' => $customer['cust_phone'],

            'payment_details' => $payment_data['details'],
            'check_in' => date('d M Y', strtotime($booking->check_in)),
            'check_out' => date('d M Y', strtotime($booking->check_out)),
            'currency' => $this->get_currency(),
            'amount' => $payment_data['paymentamount'],
            'total_price' => $booking->total_price,
            'balance' => $booking->total_price - $booking->paid_amount
        ];

        // Load and parse the invoice template
        $html = $this->CI->load->view('api/templates/invoice_template', $template_data, true);

        // Generate PDF
        $filename = 'invoice_' . $payment_data['invoice'];
        return $this->CI->pdfgenerator->generate_pdf($payment_data['bookedid'], $html, $filename);
    }

    private function get_currency()
    {
        return $this->setting->get_currency()['name'];
    }
}
