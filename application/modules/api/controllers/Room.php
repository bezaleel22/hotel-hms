<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends MX_Controller
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
     * JWT handler instance
     * @var Jwt_handler
     */
    protected $jwt;

    /**
     * Room model instance
     * @var Room_model
     */
    protected $room;

    /**
     * Cart handler instance
     * @var Cart_handler
     */
    protected $cart;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['api/api_handler', 'api/jwt_handler', 'cart_handler']);
        $this->load->model('api/room_model');
        $this->load->model('api/customer_model');

        $this->api = $this->api_handler;
        $this->jwt = $this->jwt_handler;
        $this->customer = $this->customer_model;
        $this->room = $this->room_model;
        $this->cart = $this->cart_handler;

        $protected_methods = ['promocode'];
        if (in_array($this->router->fetch_method(), $protected_methods)) {
            $this->api->authenticate(['customer', 'admin']);
        }
    }

    public function list()
    {
        try {

            // Get all assigned rooms
            $room_ids = $this->room->get_all_room_ids();
            if (empty($room_ids)) {
                return $this->api->send_response([], "No rooms found", 200);
            }

            $all_rooms = $this->room->get_room_details($room_ids);

            $this->api->send_response($all_rooms);
        } catch (Exception $e) {
            error_log('Error : ' . $e->getMessage());
            $this->api->send_error('Failed to check availability', 500);
        }
    }

    public function availability()
    {
        // Get input parameters
        $checkin = $this->input->get_post('checkin', TRUE);
        $checkout = $this->input->get_post('checkout', TRUE);

        try {
            // Validate required parameters
            if (!$checkin || !$checkout) {
                return $this->api->send_error("Missing required parameters", 400);
            }

            // Validate dates
            $date_validation = $this->room->validate_booking_dates($checkin, $checkout);
            if (!$date_validation['is_valid']) {
                return $this->api->send_error($date_validation['message'], 400);
            }

            // Get all assigned rooms
            $room_ids = $this->room->get_all_room_ids();
            if (empty($room_ids)) {
                return $this->api->send_response([], "No rooms found", 200);
            }

            // Get booked rooms
            $booked_rooms = $this->room->get_booked_rooms($checkin, $checkout);

            // Get available rooms
            $available_rooms = $this->room->get_available_rooms($room_ids, $booked_rooms);

            // Get room details
            $room_info = $this->room->get_room_details($available_rooms);

            // Return API response
            $this->api->send_response([
                'roominfo' => $room_info
            ], "Room list fetched successfully", 200);
        } catch (\Throwable $th) {
            $this->api->send_error($th->getMessage());
        }
    }

    public function details($roomid)
    {
        // Get input parameters
        $checkin = $this->input->get_post('checkin', TRUE);
        $checkout = $this->input->get_post('checkout', TRUE);

        if (!$roomid || !$checkin || !$checkout) {
            return $this->api->send_error("Missing required parameters", 400);
        }

        // Validate dates
        $date_validation = $this->room->validate_booking_dates($checkin, $checkout);
        if (!$date_validation['is_valid']) {
            return $this->api->send_error($date_validation['message'], 400);
        }

        // Get room details
        $roomdetails = $this->room->get_room_details($roomid);
        if (!$roomdetails) {
            return $this->api->send_error("Room not found", 404);
        }

        // Get booked rooms
        $booked_rooms = $this->room->get_booked_rooms($checkin, $checkout, $roomid);

        // Get available rooms
        $available_rooms = $this->room->get_available_rooms([$roomid], $booked_rooms);

        // Return API response
        return $this->api->send_response([
            'roominfo' => $roomdetails,
            'freeroom' => $available_rooms
        ], "Room details fetched successfully", 200);
    }


    public function book()
    {
        // Collect input data
        $data = $this->api->get_json_input();

        // Set validation rules
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('firstname', 'First Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean|trim|is_natural');
        $this->form_validation->set_rules('roomid', 'Room ID', 'required|xss_clean|trim');
        $this->form_validation->set_rules('roomtype', 'Room Type', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amount', 'Amount', 'required|xss_clean|trim');
        $this->form_validation->set_rules('roomrate', 'Room Rate', 'required|xss_clean|trim');
        $this->form_validation->set_rules('adults', 'Adults', 'required|xss_clean|trim');
        $this->form_validation->set_rules('children', 'Children', 'required|xss_clean|trim');
        $this->form_validation->set_rules('guest', 'Guest Full Name', 'xss_clean|trim');
        $this->form_validation->set_rules('specialinstruction', 'Special Instructions', 'xss_clean|trim');

        if ($this->form_validation->run() === false) {
            $this->api->send_error('Validation errors', 400, validation_errors());
            return;
        }

        try {
            // Calculate taxes and service charges
            $amount = $data['amount'] - $data['discount'];
            $service_charge = $this->room->commoninfo()->servicecharge;
            $data['servicecharge'] = ($amount * $service_charge) / 100;
            $data['tax'] = $this->room->calculate_tax($amount);
            $grand_total = ($amount + $data['tax'] + $data['servicecharge']);

            // Check if email already exists and create customer if not
            $user = $this->customer->email_exists($data['email'])
                ? $this->customer->get_customer_by_email($data['email'])
                : $this->customer->create_customer($data);

            $data['customerid'] = $user['customerid'];
            $this->cart->destroy();
            $cart_data = $this->room->prepare_cart_data($data, $grand_total);

            // Store cart data in cache
            $saved = $this->cart->insert($cart_data); // Cache for 2 hours
            if (!$saved) {
                throw new Exception('Failed to save cart data');
            }
            $cart_data = $this->cart->contents();

            // Get active payment methods
            $paymentmethod = $this->db->select("*")
                ->from('payment_method')
                ->where('is_active', 1)
                ->where_not_in('payment_method_id', [1, 4, 6])
                ->get()->result();

            // Generate token
            $token = $this->jwt->generate_token([
                'customerid' => $user['customerid'],
                'email' => $data['email'],
                'roles' => $user['roles'] ?? ['customer'],
                'permissions' => $this->customer->get_permissions($user['customerid']),
                'purpose' => 'guest_session'
            ]);

            // Store session-like data in cache
            $this->cache->save($user['customerid'], $token, 7200); // Cache for 2 hours

            // Return success response
            $this->api->send_response([
                'cart' => $cart_data,
                'user' => $user,
                'paymentmethod' => $paymentmethod,
                'token' => $token
            ], 'Room booked successfully', 200);
        } catch (Exception $e) {
            $this->api->send_error($e->getMessage());
        }
    }

    /**
     * Handle promo code validation via REST API
     */
    public function promocode()
    {
        $data = $this->api->get_json_input();
        $id = $this->api->user_data['customerid'];
        $cacheKey = "promo_$id";
        $this->cache->delete($cacheKey);

        // Set validation rules
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('roomid', 'Room ID', 'required|xss_clean|trim');
        $this->form_validation->set_rules('promocode', 'Promo Code', 'required|xss_clean|trim');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required|xss_clean|trim');

        if ($this->form_validation->run() === false) {
            $this->api->send_error('Validation errors', 400, validation_errors());
            return;
        }
        error_log('CacheKey: ' . $cacheKey);
        // Check if the promo code has already been used
        $promo_code_used = $this->room->check_promo_code_used($data['promocode']);
        if (!empty($promo_code_used)) {
            $this->cache->delete($cacheKey);
            $this->api->send_error('Promo code has already been used', 400);
            return;
        }

        // Validate the promo code
        $promo_code_details = $this->room->validate_promo_code($data['promocode'], $data['roomid']);
        if (empty($promo_code_details)) {
            $this->cache->delete($cacheKey);
            $this->api->send_error('Promo code is not available or invalid', 400);
            return;
        }

        // Calculate updated totals
        $discount = $promo_code_details->discount;
        $total_amount = $total_amount = max(0, $data['total_amount'] - $discount);

        $cacheData = [
            'promocode' => $data['promocode'],
            'total_discount' => $discount,
            'total_amount' => $total_amount
        ];
        $this->cache->save($cacheKey, $cacheData, 7200);

        // Return success response
        $this->api->send_response([
            'currency_possition' => $data['currency_possition'],
            'currency_icon' => $data['currency_icon'],
            'pricetext' => $data['pricetext'],
            'total_discount' => $discount,
            'total_amount' => $total_amount
        ], 'Promo code applied successfully');
        return;
    }
}
