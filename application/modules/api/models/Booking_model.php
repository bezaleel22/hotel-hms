<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read($select_items, $table, $where_array)
    {
        $this->cart->destroy();
        try {
            $this->db->select($select_items);
            $this->db->from($table);
            foreach ($where_array as $field => $value) {
                $this->db->where($field, $value);
            }
            return $this->db->get()->row();
        } catch (\Throwable $th) {
            throw $th;
        }
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

    public function prepare_booking_data($bookingnumber, $cart)
    {
        $postData = [];
        foreach ($cart as $item) {
            $postData[] = [
                'booking_number' => $bookingnumber,
                'date_time' => date('Y-m-d H:i:s'),
                'roomid' => $item['id'],
                'nuofpeople' => $item['adult'],
                'children' => $item['children'],
                'total_room' => 1,
                'roomrate' => $item['roomrate'],
                'total_price' => $item['totalprice'],
                'offer_discount' => $item['discount'],
                'promocode' => null,
                'full_guest_name' => $item['fullName'],
                'special_request' => $item['special'],
                'checkindate' => $item['checkin'],
                'checkoutdate' => $item['checkout'],
                'cutomerid' => $item['customerid'],
                'bookingstatus' => 0
            ];
        }
        return $postData;
    }

    /**
     * Insert booked info
     *
     * @params array $postData Booked info data
     * @return int
     */
    public function insert_booked_info($postData)
    {
        try {
            $this->db->insert('booked_info', $postData);
            return $this->db->insert_id();
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Insert booked details
     *
     * @param array $bookedid Booked id
     * @param array $data Data
     */
    public function insert_booked_details($bookedid, $data)
    {
        try {
            $bdetails_data = [
                'bookedid' => $bookedid,
                'booking_type' => '',
                'booking_source' => '',
                'booking_source_no' => '',
                'extracheckin' => $data['checkin'],
                'extracheckout' => $data['checkout'],
                'arival_from' => '',
                'purpose' => '',
                'extra_facility_days' => '',
                'extrabed' => '',
                'extraperson' => '',
                'extrachild' => '',
                'complementary' => "Choose Complementary",
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
            $this->db->insert('booked_details', $bdetails_data);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Process cart items 
     * 
     * @param array $cart Cart items
     */
    public function process_cart_item($cart)
    {
        foreach ($cart as $item) {
            $availability = $this->check_room_availability($item);
            if (!empty($availability['exits']) || !empty($availability['exit']) || !empty($availability['check'])) {
                $this->api_handler->send_error('Room not available', 400);
                return;
            }

            $booked_rooms = $this->calculate_booked_rooms($item, "bookingstatus!=1 AND bookingstatus!=5");
            $totalroomfound = $this->db->select("count(roomid) as totalroom")->from('tbl_roomnofloorassign')->where('roomid', $item['id'])->get()->row();
            if ($totalroomfound->totalroom <= max($booked_rooms['totalroom1'], $booked_rooms['totalroom2'], $booked_rooms['totalroom3'])) {
                $this->api_handler->send_error('Not enough rooms available', 400);
                return;
            }
        }
    }

    public function get_booking($id)
    {
        try {
            $this->db->select('booked_info.*,roomdetails.roomtype,roomdetails.rate');
            $this->db->from('booked_info');
            $this->db->join('roomdetails', 'roomdetails.roomid=booked_info.roomid', 'left');
            $this->db->where('booked_info.bookedid', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            return false;
        } catch (\Throwable $th) {
            error_log('Error fetching booking details: ' . $th->getMessage());
            throw $th;
        }
    }

    public function customerinfo($cid)
    {
        try {
            $this->db->select('*');
            $this->db->from('customerinfo');
            $this->db->where('customerid', $cid);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            return false;
        } catch (\Throwable $th) {
            error_log('Error fetching customer info: ' . $th->getMessage());
            throw $th;
        }
    }

    public function paymentinfo($bookno)
    {
        try {
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
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function commoninfo()
    {
        try {
            $this->db->select('*');
            $this->db->from('common_setting');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function storeinfo()
    {
        try {
            $this->db->select('*');
            $this->db->from('setting');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Fetch COA head code by head name
     */
    public function get_coa_head_code($headName)
    {
        try {
            return $this->db->select('HeadCode')->from('acc_coa')->where('HeadName', $headName)->get()->row();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Count total bookings for a user
     */
    public function count_user_bookings($userid)
    {
        try {
            return $this->db->select('COUNT(*) as total')->from('booked_info')
                ->where('cutomerid', $userid)
                ->get()->row()->total;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function user_report($limit = null, $start = null, $id = null)
    {
        try {
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
        } catch (\Throwable $th) {
            throw $th;
        }
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
}
