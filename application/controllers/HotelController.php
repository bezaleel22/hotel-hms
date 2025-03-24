<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HotelController extends MX_Controller
{
    private $request_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('api/api_handler');
        $this->load->library('form_validation');
        $this->load->model('api/Hotel_model'); // Load the Hotel_model
        $this->load->library('cart'); // Load the cart library
        $this->load->library('session'); // Load session library

        // Get JSON input
        $this->request_data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE && !empty(file_get_contents('php://input'))) {
            $this->api_handler->send_error('Invalid JSON format', 400);
            return;
        }
    }

    /**
     * Handle room booking via REST API
     */
    public function bookedroom_post()
    {
        $data = $this->request_data;

        // Set validation rules
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('f_name', 'First Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('l_name', 'Last Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean|trim|is_natural');
        $this->form_validation->set_rules('guest', 'Guest Full Name', 'xss_clean|trim');
        $this->form_validation->set_rules('specialinstruction', 'Special Instructions', 'xss_clean|trim');

        if ($this->form_validation->run() === false) {
            $this->api_handler->send_error('Validation errors', 400, validation_errors());
            return;
        }

        // Validation passed, process the booking
        $this->cart->destroy();

        // Collect input data
        $f_name = $this->request_data['f_name'];
        $l_name = $this->request_data['l_name'];
        $email = $this->request_data['email'];
        $phone = $this->request_data['phone'];
        $address = $this->request_data['address'];
        $discount = $this->request_data['discount'];
        $amount = $this->request_data['amount'] - $discount;

        // Calculate taxes and service charges
        $taxamount = $this->Hotel_model->calculate_tax($amount);
        $servicetharge = $this->Hotel_model->commoninfo()->servicecharge;
        $serviceamnt = ($amount * $servicetharge) / 100;

        // Grand total calculation
        $grandtyotal = ($amount + $taxamount + $serviceamnt) - $this->session->userdata("code_discount");

        // Check if user is logged in
        if (!$this->session->userdata('UserID')) {
            // Insert new customer

            $customerid = $this->Hotel_model->insert_customer($f_name, $l_name, $phone, $address, $email);
            error_log("Customer ID: " . $customerid); // Log the customer ID

            // Insert COA entry
            $lastCustomer = $this->db->select("*")->from('customerinfo')->where('customerid', $customerid)->get()->row();
            $this->Hotel_model->insert_coa_entry($customerid, $f_name, $l_name, $lastCustomer->customernumber);

            // Set session data
            $sessiondata = ['UserID' => $customerid, 'UserEmail' => $email];
            $this->session->set_userdata($sessiondata);
        } else {
            $customerid = $this->session->userdata('UserID');
        }

        // Prepare cart data
        $cart_data = $this->Hotel_model->prepare_cart_data($data, $grandtyotal);
        $this->cart->insert($cart_data);

        // Unset session data
        $this->session->unset_userdata(['checkin', 'checkout', 'children', 'adults', 'roomid']);
        $cart = $this->cart->contents();
        $userinfo = $this->db->select("*")->from('customerinfo')->where('customerid', $this->session->userdata('UserID'))->get()->row();
        $data['userinfo'] = $userinfo;
        $paymentmethod = $this->db->select("*")->from('payment_method')->where('is_active', 1)->get()->result();

        // Return success response
        $this->api_handler->send_response([
            'status' => true,
            'cart' => $cart,
            'userinfo' => $userinfo,
            'paymentmethod' => $paymentmethod,
            'redirect_url' => base_url('checkout')
        ], 'Room booked successfully', 200);
        return;
    }

    /**
     * Handle user login via REST API
     */
    public function loginsubmit_post()
    {
        // Set validation rules
        $this->form_validation->set_data($this->request_data);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // Validate input
        if ($this->form_validation->run() === FALSE) {
            $this->api_handler->send_error('Validation errors', 400, validation_errors());
            return;
        }

        // Collect input data
        $email = $this->request_data['email'];
        $password = md5($this->request_data['password']);

        // Check if user exists
        $user = $this->db->select("*")
            ->from('customerinfo')
            ->where('email', $email)
            ->where('pass', $password)
            ->get()
            ->row();

        if (!empty($user)) {
            // Set session data
            $sessionData = [
                'UserID' => $user->customerid,
                'UserName' => $user->firstname . ' ' . $user->lastname,
                'UserEmail' => $user->email
            ];
            $this->session->set_userdata($sessionData);

            // Return success response
            $this->api_handler->send_response([
                'status' => true,
                'redirect_url' => base_url() // Redirect to home page
            ], 'Login successful', 200);
        } else {
            // Invalid credentials
            $this->api_handler->send_error('Invalid email or password', 401);
        }
    }

    /**
     * Handle user signup via REST API
     */
    public function signup_post()
    {
        $data = $this->request_data;

        // Set validation rules
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('f_name', 'First Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('l_name', 'Last Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[customerinfo.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean|is_unique[customerinfo.cust_phone]');
        $this->form_validation->set_rules('useragree', 'Terms of Service', 'required|trim|xss_clean');

        // Validate input
        if ($this->form_validation->run() === FALSE) {
            $this->api_handler->send_error('Validation errors', 400, validation_errors());
            return;
        }

        // Collect input data
        $f_name = $this->request_data['f_name'];
        $l_name = $this->request_data['l_name'];
        $email = $this->request_data['email'];
        $password = $this->request_data['password'];
        $phone = $this->request_data['phone'];

        // Insert customer using model utility method
        $customerid = $this->Hotel_model->insert_customer($f_name, $l_name, $phone, $email, $password);

        // Insert COA entry using model utility method
        $lastCustomer = $this->db->select("*")->from('customerinfo')->where('customerid', $customerid)->get()->row();
        $this->Hotel_model->insert_coa_entry($customerid, $f_name, $l_name, $lastCustomer->customernumber);

        // Set session data
        $sessiondata = [
            'UserID' => $customerid,
            'UserName' => $f_name . ' ' . $l_name,
            'UserEmail' => $email
        ];
        $this->session->set_userdata($sessiondata);


        // Unset captcha from session
        $this->session->unset_userdata('captcha');

        // Return success response
        $this->api_handler->send_response([
            'status' => true,
            'redirect_url' => base_url() // Redirect to home page
        ], 'Signup successful', 200);
        return;
    }

    /**
     * Handle payment confirmation via REST API
     */
    public function paymentconfirm_post()
    {
        // Collect input data
        $finyear = $this->request_data['finyear'];
        $payment_method = $this->request_data['pmethod'];
        error_log("finyear: " . $finyear); // Log the payment method
        // Validate financial year
        if ((int)$finyear <= 0) {
            $this->api_handler->send_error('Invalid financial year', 400);
            return;
        }

        // Check payment gateway status
        $check_gateway = $this->db->select('*')->from('payment_method')->where('payment_method_id', $payment_method)->get()->row();
        if ($check_gateway->is_active == 0) {
            $this->api_handler->send_error('Payment gateway is inactive', 400);
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
        $cart = $this->cart->contents();
        foreach ($cart as $item) {
            $availability = $this->Hotel_model->check_room_availability($item);
            if (!empty($availability['exits']) || !empty($availability['exit']) || !empty($availability['check'])) {
                $this->api_handler->send_error('Room not available', 400);
                return;
            }

            $booked_rooms = $this->Hotel_model->calculate_booked_rooms($item, "bookingstatus!=1 AND bookingstatus!=5");
            $totalroomfound = $this->db->select("count(roomid) as totalroom")->from('tbl_roomnofloorassign')->where('roomid', $item['id'])->get()->row();
            if ($totalroomfound->totalroom <= max($booked_rooms['totalroom1'], $booked_rooms['totalroom2'], $booked_rooms['totalroom3'])) {
                $this->api_handler->send_error('Not enough rooms available', 400);
                return;
            }
        }

        // Prepare booking data
        $postData = [];
        foreach ($cart as $item) {
            $postData[] = [
                'booking_number' => $bookingnumber,
                'date_time' => date('Y-m-d H:i:s'),
                'roomid' => $item['id'],
                'nuofpeople' => $item['adult'],
                'children' => $item['children'],
                'total_room' => $this->session->userdata('t_room'),
                'roomrate' => $item['roomrate'],
                'total_price' => $item['totalprice'],
                'offer_discount' => $item['discount'],
                'promocode' => $this->session->userdata('promocode'),
                'full_guest_name' => $item['fullName'],
                'special_request' => $item['special'],
                'checkindate' => $item['checkin'],
                'checkoutdate' => $item['checkout'],
                'cutomerid' => $this->session->userdata('UserID'),
                'bookingstatus' => 0
            ];
        }

        // Insert booking data
        foreach ($postData as $data) {
            $bookedid = $this->Hotel_model->insert_booked_info($data);
            $bdetails_data = [
                'bookedid' => $bookedid,
                'booking_type' => '',
                'booking_source' => '',
                'booking_source_no' => '',
                'extracheckin' => $data['checkindate'],
                'extracheckout' => $data['checkoutdate'],
                'arival_from' => '',
                'purpose' => '',
                'extra_facility_days' => '',
                'extrabed' => '',
                'extraperson' => '',
                'extrachild' => '',
                'complementary' => "no",
                'complementaryprice' => '',
                'discountreason' => '',
                'discountamount' => '',
                'commissionpersent' => '',
                'commissionamount' => '',
                'payment_method' => '',
                'advance_amount' => '',
                'advance_remarks' => '',
                'remarks' => '',
                'booked_from' => 1
            ];
            $this->Hotel_model->insert_booked_details($bdetails_data);
        }

        // Update promocode status
        if ($this->session->userdata('promocode')) {
            $this->Hotel_model->update_promocode_status($this->session->userdata('promocode'));
        }

        // Clear cart
        $this->cart->destroy();

        // Return success response
        $this->api_handler->send_response([
            'status' => true,
            'booking_number' => $bookingnumber,
            'redirect_url' => base_url("api/vi/successful/{$bookingnumber}/{$payment_method}")
        ], 'Payment confirmed successfully', 200);
        return;
    }

    /**
     * Handle payment insertion via REST API
     */
    public function insert_payment_post()
    {
        // Collect input data
        $orderinfo = json_decode($this->input->post('orderinfo', TRUE));
        $pmethod = $this->input->post('pmethod', TRUE);

        if (empty($orderinfo) || empty($pmethod)) {
            $this->api_handler->send_error('Invalid input data', 400);
            return;
        }

        // Extract order details
        $paid_amount = $orderinfo->total_price;
        $bookedid = $orderinfo->bookedid;

        // Get payment method name
        $methodName = $this->Hotel_model->read('payment_method', 'payment_method', array('payment_method_id' => $pmethod));
        if (empty($methodName)) {
            $this->api_handler->send_error('Invalid payment method', 400);
            return;
        }

        // Update paid amount in booked_info table
        $this->Hotel_model->update_paid_amount($bookedid, $paid_amount);

        // Update payment method and advance amount in booked_details table
        $this->Hotel_model->update_payment_method($bookedid, $methodName->payment_method, $paid_amount);

        // Update customer balance
        $this->Hotel_model->update_customer_balance($orderinfo->cutomerid, $paid_amount);

        // Generate invoice number
        $invoice = $this->Hotel_model->generate_invoice_number();

        // Insert payment data
        $paydata = [
            'bookedid' => $bookedid,
            'invoice' => $invoice,
            'paydate' => date('Y-m-d'),
            'paymenttype' => $methodName->payment_method,
            'paymentamount' => $paid_amount,
            'book_type' => 0,
        ];
        $this->Hotel_model->insert_payment_data($paydata);

        // Perform transactions
        $saveid = $this->session->userdata('id');
        $customer_headcode = 102030101;
        $newdate = date('Y-m-d');

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
        if ($methodName->payment_method == "SSLCommerz") {
            $narration = 'Cash in SSLCOMMERZ Debited For website advance payment Invoice#' . $invoice;
            transaction($invoice, 'CIV', $newdate, 102010302, $narration, $paid_amount, 0, 0, 1, $saveid, $newdate, 1);
        } else if ($methodName->payment_method == "Paypal") {
            $narration = 'Cash in Paypal Debited For website advance payment Invoice#' . $invoice;
            transaction($invoice, 'CIV', $newdate, 102010301, $narration, $paid_amount, 0, 0, 1, $saveid, $newdate, 1);
        } else if ($methodName->payment_method == "Cash Payment") {
            $narration = 'Cash in Hand Debited For website advance payment Invoice#' . $invoice;
            transaction($invoice, 'CIV', $newdate, 1020101, $narration, $paid_amount, 0, 0, 1, $saveid, $newdate, 1);
        } else {
            $path = 'application/modules/';
            $map = directory_map($path);
            if (is_array($map) && sizeof($map) > 0) {
                foreach ($map as $key => $value) {
                    $env = str_replace("\\", '/', $path . $key . 'assets/data/env');
                    $transaction = str_replace("\\", '/', $path . $key . 'controllers/transaction.php');
                    if (file_exists($env) && file_exists($transaction)) {
                        @include($transaction);
                        if ($methodName->payment_method == $paymentMethod) {
                            $narration = 'Cash in ' . $paymentMethod . ' Debited For website advance payment Invoice#' . $invoice;
                            transaction($invoice, 'CIV', $newdate, $headCode, $narration, $paid_amount, 0, 0, 1, $saveid, $newdate, 1);
                        }
                    }
                }
            }
        }

        // Return success response
        $this->api_handler->send_response([
            'status' => true,
            'invoice' => $invoice,
        ], 'Payment inserted successfully', 200);
        return;
    }

    /**
     * Handle payment gateway via REST API
     */
    public function paymentgateway_post()
    {
        // Collect input data
        $orderid = $this->input->post('orderid', TRUE);
        $paymentid = $this->input->post('paymentid', TRUE);

        if (empty($orderid) || empty($paymentid)) {
            $this->api_handler->send_error('Invalid input data', 400);
            return;
        }

        // Fetch order, payment, and customer information
        $orderInfo = $this->Hotel_model->get_order_info($orderid);
        $paymentInfo = $this->Hotel_model->get_payment_setup($paymentid);
        $customerInfo = $this->Hotel_model->get_customer_info($orderInfo->cutomerid);
        $commonSettings = $this->Hotel_model->get_common_settings();

        if (empty($orderInfo) || empty($paymentInfo) || empty($customerInfo)) {
            $this->api_handler->send_error('Invalid order or payment details', 400);
            return;
        }

        // Process based on payment method
        if ($paymentid == 5) { // SSLCommerz
            $postData = [
                'store_id' => SSLCZ_STORE_ID,
                'store_passwd' => SSLCZ_STORE_PASSWD,
                'total_amount' => $orderInfo->total_price,
                'currency' => $paymentInfo->currency,
                'tran_id' => $orderid,
                'success_url' => base_url("hotel/successful/{$orderid}/{$paymentid}"),
                'fail_url' => base_url("hotel/fail/{$orderid}"),
                'cancel_url' => base_url("hotel/cancilorder/{$orderid}"),
                'cus_name' => $customerInfo->firstname . ' ' . $customerInfo->lastname,
                'cus_email' => $customerInfo->email,
                'cus_add1' => $customerInfo->address,
                'cus_phone' => $customerInfo->cust_phone,
            ];

            // Store transaction data in session
            $sessionData = [
                'tran_id' => $postData['tran_id'],
                'amount' => $postData['total_amount'],
                'currency' => $postData['currency']
            ];
            $this->session->set_userdata('tarndata', $sessionData);

            // Redirect to SSLCommerz
            if ($this->sslcommerz->RequestToSSLC($postData, false)) {
                $this->api_handler->send_error('Failed to redirect to SSLCommerz', 500);
            } else {
                $this->api_handler->send_response([
                    'status' => true,
                    'redirect_url' => base_url("hotel/successful/{$orderid}/{$paymentid}")
                ], 'Redirecting to SSLCommerz for payment', 200);
            }
        } elseif ($paymentid == 3) { // PayPal
            $returnURL = base_url("hotel/successful/{$orderid}/{$paymentid}");
            $cancelURL = base_url("hotel/cancilorder/{$orderid}");
            $notifuserdatayURL = base_url('hotel/ipn');

            // Set PayPal form fields
            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);

            // Item information
            $this->paypal_lib->add_field('item_number', $orderid);
            $this->paypal_lib->add_field('item_name', "Room Information");
            $this->paypal_lib->add_field('amount', $orderInfo->total_price);
            $this->paypal_lib->add_field('quantity', 1);

            // Additional information
            $this->paypal_lib->add_field('custom', 'paynow');
            $this->paypal_lib->image(base_url($commonSettings->logo));

            // Generate PayPal auto form
            $this->api_handler->send_response([
                'status' => true,
                'paypal_form' => $this->paypal_lib->paypal_auto_form()
            ], 'Redirecting to PayPal for payment', 200);
        } else {
            // Handle other payment gateways
            $path = 'application/modules/';
            $map = directory_map($path);
            if (is_array($map) && sizeof($map) > 0) {
                foreach ($map as $key => $value) {
                    $env = str_replace("\\", '/', $path . $key . 'assets/data/env');
                    $gateway = str_replace("\\", '/', $path . $key . 'controllers/payment.php');
                    if (file_exists($env) && file_exists($gateway)) {
                        @include($gateway);
                        $this->api_handler->send_response([
                            'status' => true,
                            'gateway' => $key
                        ], 'Redirecting to custom payment gateway', 200);
                    }
                }
            }
        }

        // Default response if no payment gateway matches
        $this->api_handler->send_error('Payment gateway not found', 404);
        return;
    }

    /**
     * Handle sending email via REST API
     */
    public function sendemail_post()
    {
        // Validate input
        if ($this->form_validation->run() === FALSE) {
            $this->api_handler->send_error('Validation errors', 400, validation_errors());
            return;
        }

        // Collect input data
        $fullname = $this->input->post('firstname', TRUE);
        $email = $this->input->post('email', TRUE);
        $text = $this->input->post('comments', TRUE);
        $phone = $this->input->post('phone', TRUE);

        // Prepare email content
        $subject = "Contact Inquiry";
        $body = 'Contact Info';
        $emailText = '<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi ' . $fullname . ',</p>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Phone:' . $phone . '</p>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">' . $text . '</p>';

        // Send email using model method
        if ($this->Hotel_model->send_email($email, $subject, $body, $emailText)) {
            $this->session->unset_userdata('captcha');

            // Return success response
            $this->api_handler->send_response([
                'status' => true,
            ], 'Email sent successfully', 200);
            return;
        } else {
            // Return failure response
            $this->api_handler->send_error('Failed to send email', 500);
        }
    }

    /**
     * Handle booking report via REST API
     */
    public function report_get()
    {
        // Get user ID from session
        $userId = $this->session->userdata('UserID');
        if (empty($userId)) {
            $this->api_handler->send_error('User not logged in', 401);
            return;
        }

        // Fetch customer information
        $customerInfo = $this->Hotel_model->get_customer_info($userId);
        if (empty($customerInfo)) {
            $this->api_handler->send_error('Customer information not found', 404);
            return;
        }

        // Generate customer head name
        $customerHeadName = $customerInfo->customernumber . '-' . $customerInfo->firstname . ' ' . $customerInfo->lastname;

        // Fetch COA head code
        $coaHead = $this->Hotel_model->get_coa_head_code($customerHeadName);
        $customerHeadCode = !empty($coaHead->HeadCode) ? $coaHead->HeadCode : null;

        // Pagination configuration
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $limit = 30; // Records per page
        $offset = ($page - 1) * $limit;

        // Fetch bookings and total count
        $bookings = $this->Hotel_model->user_report($limit, $offset, $userId);
        $totalBookings = $this->Hotel_model->count_user_bookings($userId);

        // Prepare response data
        $responseData = [
            'status' => true,
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
        $this->api_handler->send_response($responseData, 'Booking report fetched successfully', 200);
        return;
    }

    /**
     * Handle promo code validation via REST API
     */
    public function promocode_post()
    {
        // Collect input data
        $promo_code = $this->input->post('promocode', TRUE);
        $roomid = $this->input->post('roomid', TRUE);
        $currency_possition = $this->input->post('currency_possition', TRUE);
        $currency_icon = $this->input->post('currency_icon', TRUE);
        $pricetext = $this->input->post('pricetext', TRUE);
        $total_discount = $this->input->post('total_discount', TRUE);
        $total_amount = $this->input->post('total_amount', TRUE);

        if (empty($promo_code) || empty($roomid)) {
            $this->api_handler->send_error('Invalid input data', 400);
            return;
        }

        // Check if the promo code has already been used
        $promo_code_used = $this->Hotel_model->check_promo_code_used($promo_code);
        if (!empty($promo_code_used)) {
            $this->session->unset_userdata(['promocode', 'total_discount', 'total_amount', 'code_discount']);
            $this->api_handler->send_error('Promo code has already been used', 400);
            return;
        }

        // Validate the promo code
        $promo_code_details = $this->Hotel_model->validate_promo_code($promo_code, $roomid);
        if (empty($promo_code_details)) {
            $this->session->unset_userdata(['promocode', 'total_discount', 'total_amount', 'code_discount']);
            $this->api_handler->send_error('Promo code is not available or invalid', 400);
            return;
        }

        // Calculate updated totals
        $discount = $promo_code_details->discount;
        $total_discount = (!empty($total_discount) ? $total_discount : 0) + $discount;
        $total_amount = $total_amount - $discount;

        // Set session data
        $sessionData = [
            'promocode' => $promo_code,
            'code_discount' => $discount,
            'total_discount' => $total_discount,
            'total_amount' => $total_amount
        ];
        $this->session->set_userdata($sessionData);

        // Prepare response data
        $responseData = [
            'status' => true,
            'data' => [
                'currency_possition' => $currency_possition,
                'currency_icon' => $currency_icon,
                'pricetext' => $pricetext,
                'total_discount' => $total_discount,
                'total_amount' => $total_amount
            ]
        ];

        // Return success response
        $this->api_handler->send_response($responseData, 'Promo code applied successfully', 200);
        return;
    }

    /**
     * Handle profile update via REST API
     */
    public function update_profile_post()
    {
        // Collect input data
        $customerId = $this->input->post('customerid', TRUE);
        $firstName = $this->input->post('firstname', TRUE);
        $lastName = $this->input->post('lastname', TRUE);
        $email = $this->input->post('email', TRUE);
        $phone = $this->input->post('phone', TRUE);
        $nationalityType = $this->input->post('nationaliti', TRUE);

        // Set validation rules
        $this->form_validation->set_rules('firstname', 'First Name', 'required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|xss_clean');

        // Additional validation for foreigners
        if ($nationalityType === 'foreigner') {
            $this->form_validation->set_rules('national_id', 'National ID', 'required|xss_clean|is_natural');
            $this->form_validation->set_rules('nationalitycon', 'Nationality', 'required|xss_clean');
            $this->form_validation->set_rules('passport_no', 'Passport Number', 'required|xss_clean');
            $this->form_validation->set_rules('visa_reg_no', 'Visa Registration Number', 'required|xss_clean');
            $this->form_validation->set_rules('purpose', 'Purpose of Visit', 'required|xss_clean');
        }

        // Validate input
        if ($this->form_validation->run() === FALSE) {
            $this->api_handler->send_error('Validation errors', 400, validation_errors());
            return;
        }

        // Check if phone number is unique for another customer
        $existingPhone = $this->Hotel_model->check_unique_phone($phone, $customerId);
        if (!empty($existingPhone)) {
            $this->api_handler->send_error('Phone number already exists for another customer', 400);
            return;
        }

        // Prepare update data
        $postData = [
            'customerid' => $customerId,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'cust_phone' => $phone,
            'email' => $email,
            'dob' => $this->input->post('dob', TRUE),
            'profession' => $this->input->post('profession', TRUE),
            'isnationality' => $nationalityType,
            'pid' => $this->input->post('national_id', TRUE),
            'nationality' => $this->input->post('nationalitycon', TRUE),
            'passport' => $this->input->post('passport_no', TRUE),
            'visano' => $this->input->post('visa_reg_no', TRUE),
            'purpose' => $this->input->post('purpose', TRUE),
            'address' => $this->input->post('address', TRUE),
            'signupdate' => date('Y-m-d')
        ];

        // Update customer profile
        if ($this->Hotel_model->update_customer_profile($postData)) {
            $this->api_handler->send_response([
                'status' => true,
            ], 'User profile updated successfully', 200);
        } else {
            $this->api_handler->send_error('Failed to update user profile. Please try again.', 500);
        }
    }

    /**
     * Handle privacy policy request
     */
    public function privacy_get()
    {
        $response = [
            'status' => true,
            'content' => 'This is the privacy policy content. Replace with actual content.'
        ];

        $this->api_handler->send_response($response, 'Privacy policy retrieved successfully', 200);
    }

    /**
     * Handle terms and conditions request
     */
    public function terms_get()
    {
        $response = [
            'status' => true,
            'content' => 'This is the terms and conditions content. Replace with actual content.'
        ];

        $this->api_handler->send_response($response, 'Terms and conditions retrieved successfully', 200);
    }

    /**
     * Handle forgot password request
     */
    public function forgot_password_post()
    {
        $email = $this->input->post('email', TRUE);

        if (empty($email)) {
            $this->api_handler->send_error('Email is required', 400);
            return;
        }

        // Check if email exists
        $checkemail = $this->Hotel_model->check_email_exists($email);
        if (!$checkemail) {
            $this->api_handler->send_error('Email not found', 404);
            return;
        }

        // Generate random key
        $random_key = "RK" . date('y') . strtoupper($this->randstrGen(2, 4));

        // Update password reset token
        $this->Hotel_model->update_password_reset_token($email, $random_key);

        // Send OTP via email
        $subject = "Password Reset Token";
        $htmlContent = "Your OTP code is " . $random_key;
        $appName = $this->db->select("title")->from("setting")->where("id", 2)->get()->row();
        $this->Hotel_model->send_email(strtolower($email), $subject, $appName->title, $htmlContent);

        $this->api_handler->send_response([
            'status' => true,
            'email' => $email
        ], 'OTP code sent to email', 200);
        return;
    }

    /**
     * Handle OTP verification
     */
    public function check_code_post()
    {
        $code = $this->input->post('code', TRUE);
        $email = $this->input->post('email', TRUE);

        if (empty($code) || empty($email)) {
            $this->api_handler->send_error('Code and email are required', 400);
            return;
        }

        // Verify OTP
        $checkcode = $this->Hotel_model->verify_password_reset_token($email, $code);
        if (!$checkcode) {
            $this->api_handler->send_error('OTP code does not match', 400);
            return;
        }

        $this->api_handler->send_response([
            'status' => true,
        ], 'Please enter a new password', 200);
    }

    /**
     * Handle password reset
     */
    public function new_password_post()
    {
        $password = $this->input->post('password', TRUE);
        $email = $this->input->post('email', TRUE);

        if (empty($password) || empty($email)) {
            $this->api_handler->send_error('Password and email are required', 400);
            return;
        }

        // Reset password
        if ($this->Hotel_model->reset_password($email, $password)) {
            $this->api_handler->send_response([
                'status' => true,
            ], 'Password changed successfully', 200);
        } else {
            $this->api_handler->send_error('Failed to reset password. Please try again.', 500);
        }
    }

    /**
     * Generate random string
     */
    private function randstrGen($mode = null, $len = null)
    {
        $result = "";
        if ($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif ($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif ($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif ($mode == 4):
            $chars = "0123456789";
        endif;
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }
}
