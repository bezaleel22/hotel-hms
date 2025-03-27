<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MX_Controller
{
    /**
     * Api handler instance
     * @var Api_handler
     */
    protected $api;

    /**
     * Booking model instance
     * @var Booking_model
     */
    protected $booking;

    /**
     * Cart handler instance
     * @var Cart_handler
     */
    protected $cart;

    /**
     * Customer model instance
     * @var Customer_model
     */
    protected $customer;

    /**
     * Payment model instance
     * @var Payment_model
     */
    protected $payment;

    /**
     * Email handler instance
     * @var Email_handler
     */
    protected $email;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['api/api_handler', 'cart_handler', 'form_validation', 'api/email_handler']);
        $this->load->model('api/booking_model');
        $this->load->model('api/customer_model');
        $this->load->model('api/payment_model');
        $this->booking = $this->booking_model;
        $this->customer = $this->customer_model;
        $this->payment = $this->payment_model;
        $this->api = $this->api_handler;
        $this->cart = $this->cart_handler;
        $this->email = $this->email_handler;

        $protected_methods = ['create', 'details', 'cancel', 'history', 'verify_payment'];
        if (in_array($this->router->fetch_method(), $protected_methods)) {
            $this->api->authenticate(['customer', 'admin']);
        }
    }

    /**
     * Create a new booking
     *
     * @api {post} /api/v1/bookings/checkout Checkout Booking
     */
    public function create()
    {
        try {
            $data = $this->api->get_json_input();
            $id = $this->api->user_data['customerid'];
            $cacheKey = "promo_$id";
            $this->cache->delete($cacheKey);

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('finyear', 'Financial Year', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pmethod', 'Payment Method', 'required|xss_clean|trim');
            $this->form_validation->set_rules('totalprice', 'Total Price', 'required|xss_clean|trim');
            $this->form_validation->set_rules('callback_url', 'Callback URL', 'required|xss_clean|trim');

            if ($this->form_validation->run() == false) {
                $this->api->send_error(validation_errors(), 400);
                return;
            }

            // Check payment gateway status
            $check_gateway = $this->db->select('*')->from('payment_method')->where('payment_method_id', $data['pmethod'])->get()->row();
            if (!$check_gateway || $check_gateway->is_active == 0) {
                $this->api->send_error('Payment gateway is inactive or not found', 400);
                return;
            }

            // Generate booking number
            $bookinginfo = $this->db->select("*")->from('booked_info')->order_by('bookedid', 'desc')->get()->row();
            $bookno = !empty($bookinginfo) ? $bookinginfo->bookedid : "00000000";
            $nextno = $bookno + 1;
            $bk_length = strlen((int)$nextno);
            $bkstr = '00000000';
            $bknumber = substr($bkstr, $bk_length);
            $bookingnumber = $bknumber . $nextno;

            // Process cart items
            $cart = $this->cart->contents(true);
            if (!$cart) {
                $this->api->send_error('Cart is empty', 400);
                return;
            }

            $this->booking->process_cart_item($cart);
            $postData = $this->booking->prepare_booking_data($bookingnumber, $cart);

            $this->db->trans_begin();
            foreach ($postData as $d) {
                $bookedid = $this->booking->insert_booked_info($d);
                $this->booking->insert_booked_details($bookedid, $d);
            }

            // Check if data is cached
            $cachedData = $this->cache->get($cacheKey);
            if ($cachedData) {
                $this->booking->update_promocode_status($cachedData['promocode']);
            }

            $payment = $this->payment->initialize_paystack_transaction($bookingnumber, $data);
            if (!$payment) {
                $this->api->send_error('Failed to initialise payment', 500);
                return;
            }

            // Clear cart
            $this->cart->destroy();
            $this->db->trans_commit();
            error_log('Payment URL: ' . $payment['authorization_url']);
            $this->api->send_response([
                'callback_url' => $data['callback_url'],
                'booking_number' => $bookingnumber,
                'payment' => $payment
            ], 'Booking created successfully', 200);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $this->api->send_error($e->getMessage());
        }
    }

    /**
     * Get booking details
     *  
     * @api {get} /api/v1/bookings/:id Get Booking Details
     */
    public function details($bknumber)
    {
        // Get user ID from session
        $userId = $this->api->user_data['customerid'];

        // Fetch booking details
        $bookingInfo = $this->db->select("*")
            ->from('booked_info')
            ->where('booking_number', $bknumber)
            ->where("cutomerid", $userId)
            ->get()
            ->row();

        if (!$bookingInfo) {
            $this->api->send_error('Unauthorized access to booking', 403);
            return;
        }

        // Fetch related details using model functions
        $details = $this->booking->get_booking($bookingInfo->bookedid);
        $customerInfo = $this->booking->customerinfo($userId);
        $paymentInfo = $this->booking->paymentinfo($bookingInfo->bookedid);
        $commonInfo = $this->booking->commoninfo();
        $storeInfo = $this->booking->storeinfo();

        // Prepare response data
        $responseData = [
            'bookinfo' => $details,
            'customerinfo' => $customerInfo,
            'paymentinfo' => $paymentInfo,
            'commoninfo' => $commonInfo,
            'storeinfo' => $storeInfo
        ];

        $this->api->send_response($responseData, 'Booking details fetched successfully', 200);
    }

    /**
     * Cancel a booking
     *
     * @api {delete} /api/v1/bookings/:id Cancel Booking
     */
    public function cancel($id)
    {
        try {
            $result = $this->booking_model->cancel_booking($id);
            $this->api->send_response($result);
        } catch (Exception $e) {
            $this->api->send_error($e->getMessage());
        }
    }

    /**
     * Get booking history
     * 
     * @api {get} /api/v1/bookings/history Get Booking History
     */
    public function history()
    {
        // Get user ID from session
        $userId = $this->api->user_data['customerid'];
        if (empty($userId)) {
            $this->api->send_error('User not logged in', 401);
            return;
        }

        // Generate customer head name
        $user = $this->api->user_data;
        $customerHeadName = $user['customernumber'] . '-' . $user['firstname'] . ' ' . $user['lastname'];

        // Fetch COA head code
        $coaHead = $this->booking->get_coa_head_code($customerHeadName);
        $customerHeadCode = !empty($coaHead->HeadCode) ? $coaHead->HeadCode : null;

        // Pagination configuration
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $limit = 30; // Records per page
        $offset = ($page - 1) * $limit;

        // Fetch bookings and total count
        $bookings = $this->booking->user_report($limit, $offset, $userId);
        $totalBookings = $this->booking->count_user_bookings($userId);

        // Prepare response data
        $responseData = [
            'customer_info' => [
                'customer_head_name' => $customerHeadName,
                'customer_head_code' => $customerHeadCode
            ],
            'pagination' => [
                'current_page' => $page,
                'per_page' => $limit,
                'total_pages' => ceil($totalBookings / $limit),
                'total_records' => $totalBookings
            ],
            'bookings' => $bookings
        ];

        // Return success response
        $this->api->send_response($responseData, 'Booking history fetched successfully', 200);
        return;
    }

    /**
     * Process Paystack webhook for booking payment verification
     */
    public function payment_webhook()
    {
        try {
            // Verify Paystack webhook signature
            $signature = $this->input->get_request_header('x-paystack-signature');
            $payload = file_get_contents('php://input');

            // if (!$payload || !$signature || !$this->payment->validate_signature($signature, $payload)) {
            //     $error_msg = !$payload || !$signature ? 'Missing payload or signature' : 'Invalid signature';
            //     error_log("PAYSTACK_ERROR: {$error_msg}\nPAYSTACK_SERVER: " . json_encode($_SERVER) . "\nPAYSTACK_PAYLOAD: " . $payload);
            //     throw new Exception($error_msg);
            // }

            $json = json_decode($payload, true);
            if (!$json || $json['event'] !== 'charge.success') {
                return;
            }

            // Process verified transaction
            $reference = $json['data']['reference'];
            $payment_data = $json['data'];
            $metadata = $payment_data['metadata'];
            $bknumber = $metadata['booking_number'];

            // Verify booking exists
            $booked_info = $this->booking->read('*', 'booked_info', array('booking_number' => $bknumber));
            if (!$booked_info) {
                throw new Exception('Booking not found');
            }

            // Check if booking is already processed
            if ($booked_info->bookingstatus == 1) {
                error_log("PAYSTACK_SUCCESS: Booking already processed for {$bknumber}");
                $this->api->send_response(null);
            }

            $payment = $this->payment->process_payment($payment_data);

            // Prepare booking data for email
            $customer = $this->customer->get_customer($booked_info->cutomerid);

            $booking_data = array_merge((array)$booked_info, [
                'payment' => [
                    'reference' => $reference,
                    'transaction_date' => $payment_data['paid_at'],
                    'currency' => $payment_data['currency'],
                    'invoice_path' => $payment['invoice_path']
                ],
                'firstname' => $metadata['firstname'],
                'formatted_checkin' => date('d M Y', strtotime($booked_info->checkindate)),
                'formatted_checkout' => date('d M Y', strtotime($booked_info->checkoutdate)),
                'email' => $customer['email']
            ]);

            // Send confirmation email
            $sent = $this->email->send_booking_confirmation($booking_data);
            error_log("PAYSTACK_SUCCESS: Booking processed for {$bknumber}");
            $this->api->send_response(null);
        } catch (Exception $e) {
            $this->api->send_error('Failed to process payment: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Verify payment status
     */
    public function verify_payment($bknumber)
    {
        try {
            error_log("PAYSTACK_VERIFY: Verifying payment for {$bknumber}");
            // Check if payment exists
            $verification = $this->payment->verify_payment($bknumber);
            if (!$verification) {
                $this->api->send_error('No payment found for this booking', 404);
                return;
            }

            $this->api->send_response(
                $verification,
                'Payment verification completed'
            );
        } catch (Exception $e) {
            $this->api->send_error('Failed to verify payment: ' . $e->getMessage(), 500);
        }
    }
}
