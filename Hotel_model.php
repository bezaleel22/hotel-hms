<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Welcome_model
 *
 * @author linktech
 */
class Hotel_model extends CI_Model
{
    public function allmenu_dropdown()
    {

        $this->db->select('*');
        $this->db->from('top_menu');
        $this->db->where('parentid', 0);
        $this->db->where('isactive', 1);
        $parent = $this->db->get();
        $menulist = $parent->result();
        $i = 0;
        foreach ($menulist as $sub_menu) {
            $menulist[$i]->sub = $this->sub_menu($sub_menu->menuid);

            $i++;
        }
        return $menulist;
    }

    public function sub_menu($id)
    {

        $this->db->select('*');
        $this->db->from('top_menu');
        $this->db->where('parentid', $id);

        $child = $this->db->get();
        $menulist = $child->result();
        $i = 0;
        foreach ($menulist as $sub_menu) {
            $menulist[$i]->sub = $this->sub_menu($sub_menu->menuid);
            $i++;
        }
        return $menulist;
    }
    public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update_info($table, $data, $field_name, $field_value)
    {
        $this->db->where($field_name, $field_value);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    public function update_date($table, $data, $field_name, $field_value)
    {
        $this->db->where($field_name, $field_value);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    public function read($select_items, $table, $where_array)
    {

        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        return $this->db->get()->row();
    }
    public function read2($select_items, $table, $orderby, $where_array)
    {

        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        $this->db->order_by($orderby, 'DESC');
        return $this->db->get()->row();
    }
    public function read_all($select_items, $table, $orderby, $delitem = "", $stype = "", $val = "")
    {
        $this->db->select($select_items);
        $this->db->from($table);
        if ($delitem != "") {
            $this->db->where($delitem, 0);
        }
        if ($stype != "") {
            $this->db->where($stype, $val);
        }
        $this->db->order_by($orderby, 'ASC');
        return $this->db->get()->result();
    }
    public function headcode()
    {
        $query = $this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102030%'");
        return $query->row();
    }
    public function user_report($limit = null, $start = null, $id = null)
    {
        $this->db->select('booked_info.*,roomdetails.roomtype');
        $this->db->from('booked_info');
        $this->db->join('roomdetails', 'roomdetails.roomid=booked_info.roomid', 'left');
        $this->db->where('booked_info.cutomerid=', $id);
        $this->db->order_by('booked_info.bookedid', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function details($id)
    {

        $this->db->select('booked_info.*,roomdetails.roomtype,roomdetails.rate');
        $this->db->from('booked_info');
        $this->db->join('roomdetails', 'roomdetails.roomid=booked_info.roomid', 'left');
        $this->db->where('booked_info.bookedid', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    public function customerinfo($cid)
    {
        $this->db->select('*');
        $this->db->from('customerinfo');
        $this->db->where('customerid', $cid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    public function paymentinfo($bookno)
    {
        $this->db->select('tbl_guestpayments.*,payment_method.payment_method,booked_info.paid_amount');
        $this->db->from('tbl_guestpayments');
        $this->db->join('payment_method', 'payment_method.payment_method_id=tbl_guestpayments.paymenttype', 'left');
        $this->db->join('booked_info', 'booked_info.bookedid=tbl_guestpayments.bookedid', 'left');
        $this->db->where('tbl_guestpayments.bookedid', $bookno);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    public function commoninfo()
    {
        $this->db->select('*');
        $this->db->from('common_setting');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    public function storeinfo()
    {
        $this->db->select('*');
        $this->db->from('setting');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    public function findById($id = null)
    {
        return $this->db->select("*")->from('customerinfo')
            ->where('customerid', $id)
            ->get()
            ->row();
    }
    public function update($data = array())
    {
        return $this->db->where('customerid', $data["customerid"])
            ->update("customerinfo", $data);
    }
    public function send_email($email, $subject, $body, $emailtext, $check = null)
    {
        if ($check == "booking") {
            $status = $this->db->select("status")->from("tbl_email_permission")->where('permission', $check)->get()->row();
            if ($status->status == 0) {
                return false;
            }
        }
        $send_email = $this->read('*', 'email_config', array('email_config_id' => 1));
        $config = array(
            'protocol'  => $send_email->protocol,
            'smtp_host' => $send_email->smtp_host,
            'smtp_port' => $send_email->smtp_port,
            'smtp_user' => $send_email->sender,
            'smtp_pass' => $send_email->smtp_password,
            'mailtype'  => $send_email->mailtype,
            'charset'   => 'utf-8'
        );


        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        if ($body == "Contact Info") {
            $this->email->from($email, $body);
            $this->email->to($send_email->sender);
        } else {
            $this->email->from($send_email->sender, $body);
            $this->email->to($email);
        }
        $this->email->subject($subject);
        $this->email->message($emailtext);
        $this->email->send();
    }

    /**
     * Get tax amount based on room price
     */
    public function calculate_tax($amount)
    {
        $taxSettings = $this->db->select("rate")->from("tbl_taxmgt")->where("isactive", 1)->get()->result();
        $taxamount = 0;
        foreach ($taxSettings as $st) {
            $taxamount += ($st->rate * $amount) / 100;
        }
        return $taxamount;
    }

    /**
     * Insert a new customer into the database
     */
    public function insert_customer($f_name, $l_name, $phone, $address, $email)
    {
        $lastCustomer = $this->db->select("*")->from('customerinfo')->order_by('customerid', 'desc')->get()->row();
        $sl = !empty($lastCustomer) ? $lastCustomer->customerid : "0001";
        $nextno = $sl + 1;
        $si_length = strlen((int)$nextno);
        $str = '0000';
        $cutstr = substr($str, $si_length);
        $sino = $cutstr . $nextno;

        $postData = [
            'firstname' => $f_name,
            'customernumber' => $sino,
            'lastname' => $l_name,
            'cust_phone' => $phone,
            'address' => $address,
            'email' => $email,
            'signupdate' => date('Y-m-d')
        ];

        $this->db->insert('customerinfo', $postData);
        return $this->db->insert_id();
    }

    /**
     * Insert COA entry for customer receivable
     */
    public function insert_coa_entry($customerid, $f_name, $l_name, $customernumber)
    {
        $coa = $this->headcode();
        $headcode = $coa->HeadCode ? $coa->HeadCode + 1 : "102030101";
        $c_name = $f_name . " " . $l_name;
        $c_acc = $customernumber . '-' . $c_name;
        $createdate = date('Y-m-d H:i:s');
        $postData1 = [
            'HeadCode' => $headcode,
            'HeadName' => $c_acc,
            'PHeadName' => 'Customer Receivable',
            'HeadLevel' => '4',
            'IsActive' => '1',
            'IsTransaction' => '1',
            'IsGL' => '0',
            'HeadType' => 'A',
            'IsBudget' => '0',
            'IsDepreciation' => '0',
            'DepreciationRate' => '0',
            'CreateBy' => $customerid,
            'CreateDate' => $createdate
        ];
        $this->db->insert('acc_coa', $postData1);
    }

    /**
     * Prepare cart item data
     */
    public function prepare_cart_data($data, $grandtotal)
    {
        $discount = $data['discount'] ?? 0;
        return [
            'id' => $data['roomid'],
            'name' => $data['roomtype'],
            'qty' => 1,
            'roomrate' => $data['roomrate'],
            'price' => $data['amount'],
            'totalprice' => $grandtotal,
            'checkin' => $data['checkin'],
            'checkout' => $data['checkout'],
            'adult' => $data['adult'],
            'children' => $data['children'],
            'tax' => $data['tax'],
            'scharge' => $data['servicecharge'],
            'discount' => $discount,
            'customerid' => $data['customerid'],
            'fullName' => $data['guest'],
            'special' => $data['specialinstruction']
        ];
    }

    /**
     * Check room availability
     */
    public function check_room_availability($item)
    {
        $status = "bookingstatus!=1 AND bookingstatus!=5";
        $croom = "FIND_IN_SET(" . $item['id'] . ",roomid)";
        $exits = $this->db->select("*")->from('booked_info')
            ->where('checkindate<=', $item['checkin'])
            ->where('checkoutdate>', $item['checkin'])
            ->where($status)
            ->where("$croom !=", 0)
            ->get()->result();

        $exit = $this->db->select("*")->from('booked_info')
            ->where('checkindate<', $item['checkout'])
            ->where('checkoutdate>=', $item['checkout'])
            ->where($status)
            ->where("$croom !=", 0)
            ->get()->result();

        $check = $this->db->select("*")->from('booked_info')
            ->where('checkindate>=', $item['checkin'])
            ->where('checkoutdate<=', $item['checkout'])
            ->where($status)
            ->where("$croom !=", 0)
            ->get()->result();

        return [
            'exits' => $exits,
            'exit' => $exit,
            'check' => $check
        ];
    }

    /**
     * Calculate booked rooms
     */
    public function calculate_booked_rooms($item, $status)
    {
        $croom = "FIND_IN_SET(" . $item['id'] . ",roomid)";
        $totalroom1 = $this->db->select("SUM(total_room) as allroom")->from('booked_info')
            ->where('checkindate<=', $item['checkin'])
            ->where('checkoutdate>', $item['checkin'])
            ->where($status)
            ->where("$croom !=", 0)
            ->get()->row();

        $totalroom2 = $this->db->select("SUM(total_room) as allroom")->from('booked_info')
            ->where('checkindate<', $item['checkout'])
            ->where('checkoutdate>=', $item['checkout'])
            ->where($status)
            ->where("$croom !=", 0)
            ->get()->row();

        $totalroom3 = $this->db->select("SUM(total_room) as allroom")->from('booked_info')
            ->where('checkindate>=', $item['checkin'])
            ->where('checkoutdate<=', $item['checkout'])
            ->where($status)
            ->where("$croom !=", 0)
            ->group_by('checkindate')->get()->result();

        $allbokedroom3 = (!empty($totalroom3) ? max(array_column($totalroom3, 'allroom')) : 0);

        return [
            'totalroom1' => $totalroom1->allroom,
            'totalroom2' => $totalroom2->allroom,
            'totalroom3' => $allbokedroom3
        ];
    }

    /**
     * Insert booked info
     */
    public function insert_booked_info($postData)
    {
        $this->db->insert('booked_info', $postData);
        return $this->db->insert_id();
    }

    /**
     * Insert booked details
     */
    public function insert_booked_details($bdetails_data)
    {
        $this->db->insert('booked_details', $bdetails_data);
    }

    /**
     * Update promocode status
     */
    public function update_promocode_status($promocode)
    {
        $this->db->set('status', 1);
        $this->db->where('promocode', $promocode);
        $this->db->update('promocode');
    }


    /**
     * Update paid amount in booked_info table
     */
    public function update_paid_amount($bookedid, $paid_amount)
    {
        $this->db->set('paid_amount', 'paid_amount+' . $paid_amount, FALSE);
        $this->db->where('bookedid', $bookedid);
        return $this->db->update('booked_info');
    }

    /**
     * Update payment method and advance amount in booked_details table
     */
    public function update_payment_method($bookedid, $methodName, $paid_amount)
    {
        return $this->db->where("bookedid", $bookedid)
            ->update("booked_details", [
                'payment_method' => $methodName,
                'advance_amount' => $paid_amount
            ]);
    }

    /**
     * Update customer balance
     */
    public function update_customer_balance($customerid, $paid_amount)
    {
        $custbalance = $this->db->select("balance")->from("customerinfo")->where("customerid", $customerid)->get()->row();
        $balance = $custbalance->balance + $paid_amount;
        return $this->db->where("customerid", $customerid)
            ->update("customerinfo", ['balance' => $balance]);
    }

    /**
     * Insert payment into tbl_guestpayments
     */
    public function insert_payment_data($paydata)
    {
        $this->db->insert('tbl_guestpayments', $paydata);
        return $this->db->insert_id();
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

    /**
     * Fetch order information by booking number
     */
    public function get_order_info($booking_number)
    {
        return $this->db->select('*')->from('booked_info')->where('booking_number', $booking_number)->get()->row();
    }

    /**
     * Fetch payment setup information by payment ID
     */
    public function get_payment_setup($paymentid)
    {
        return $this->db->select('*')->from('paymentsetup')->where('paymentid', $paymentid)->get()->row();
    }

    /**
     * Fetch customer information by customer ID
     */
    public function get_customer_info($customerid)
    {
        return $this->db->select('*')->from('customerinfo')->where('customerid', $customerid)->get()->row();
    }

    /**
     * Fetch common settings
     */
    public function get_common_settings()
    {
        return $this->db->select('*')->from('common_setting')->where('id', 1)->get()->row();
    }

    /**
     * Fetch slider data for team info
     */
    public function get_team_info()
    {
        return $this->db->select('*')->from('tbl_slider')
            ->where('Sltypeid', '5')
            ->where('delation_status', '1')
            ->order_by('slid', 'asc')
            ->get()->result();
    }

    /**
     * Fetch slider data for about section
     */
    public function get_about_smallbig()
    {
        return $this->db->select('*')->from('tbl_slider')
            ->where('Sltypeid', '6')
            ->where('delation_status', '1')
            ->order_by('slid', 'asc')
            ->get()->result();
    }

    /**
     * Fetch COA head code by head name
     */
    public function get_coa_head_code($headName)
    {
        return $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $headName)->get()->row();
    }

    /**
     * Count total bookings for a user
     */
    public function count_user_bookings($userid)
    {
        return $this->db->select('COUNT(*) as total')->from('booked_info')
            ->where('cutomerid', $userid)
            ->get()->row()->total;
    }

    /**
     * Check if a promo code has already been used
     */
    public function check_promo_code_used($promo_code)
    {
        return $this->db->select("promocode")->from("booked_info")->where("promocode", $promo_code)->get()->row();
    }

    /**
     * Validate and fetch promo code details
     */
    public function validate_promo_code($promo_code, $roomid)
    {
        $today = date('Y-m-d');
        return $this->db->select("discount")->from("promocode")
            ->where("promocode", $promo_code)
            ->where("status", 0)
            ->where("roomid", $roomid)
            ->where('startdate<=', $today)
            ->where('enddate>', $today)
            ->get()->row();
    }

    /**
     * Check if email exists in customerinfo table
     */
    public function check_email_exists($email)
    {
        return $this->db->select('email')->from('customerinfo')->where('email', $email)->get()->row();
    }

    /**
     * Update password reset token for a user
     */
    public function update_password_reset_token($email, $token)
    {
        $data = ['password_reset_token' => $token];
        $this->db->where('email', $email);
        return $this->db->update('customerinfo', $data);
    }

    /**
     * Verify password reset token
     */
    public function verify_password_reset_token($email, $token)
    {
        return $this->db->select('password_reset_token')
            ->from('customerinfo')
            ->where('email', $email)
            ->where('password_reset_token', $token)
            ->get()
            ->row();
    }

    /**
     * Reset user password
     */
    public function reset_password($email, $password)
    {
        $data = [
            'pass' => md5($password),
            'password_reset_token' => ''
        ];
        $this->db->where('email', $email);
        return $this->db->update('customerinfo', $data);
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

    /**
     * Update customer profile
     */
    public function update_customer_profile($postData)
    {
        $this->db->where('customerid', $postData['customerid']);
        return $this->db->update('customerinfo', $postData);
    }

    /**
     * Check if phone number is unique for a different customer
     */
    public function check_unique_phone($phone, $customerId)
    {
        return $this->db->select("cust_phone")
            ->from("customerinfo")
            ->where("customerid !=", $customerId)
            ->where("cust_phone", $phone)
            ->get()
            ->row();
    }
}
