<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Room Model
 * 
 * Handles room management and booking
 */
class Room_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get list of rooms with filters
     * 
     * @param array $filters Filter parameters
     * @return array List of rooms
     */
    public function get_rooms($filters = [])
    {
        $this->db->select('rd.*, ri.room_imagename, rf.roomno, rf.status as room_status');
        $this->db->from('roomdetails rd');
        $this->db->join('room_image ri', 'ri.room_id = rd.roomid', 'left');
        $this->db->join('tbl_roomnofloorassign rf', 'rf.roomid = rd.roomid', 'left');

        // Apply filters
        if (!empty($filters['type'])) {
            $this->db->where('rd.roomtype', $filters['type']);
        }
        if (!empty($filters['capacity'])) {
            $this->db->where('rd.capacity >=', $filters['capacity']);
        }
        if (!empty($filters['status'])) {
            $this->db->where('rf.status', $filters['status']);
        }

        return $this->db->get()->result_array();
    }

    /**
     * Get room facilities
     * 
     * @param int $room_id Room ID
     * @return array Room facilities
     */
    public function get_room_facilities($room_id = null)
    {
        $this->db->select('f.*, fd.facilitytitle');
        $this->db->from('roomfaility_ref_accomodation f');
        $this->db->join('roomfacilitydetails fd', 'fd.facilityid = f.facilityid', 'left');

        if ($room_id) {
            $this->db->where('f.room_id', $room_id);
        }

        return $this->db->get()->result_array();
    }

    /**
     * Validate date range
     * 
     * @param string $checkin Check-in date
     * @param string $checkout Check-out date
     * @return bool True if valid, false otherwise
     */
    private function _validate_dates($checkin, $checkout)
    {
        $checkin_date = strtotime($checkin);
        $checkout_date = strtotime($checkout);
        $current_date = strtotime(date('Y-m-d'));

        return $checkin_date && $checkout_date &&
               $checkin_date >= $current_date &&
               $checkout_date > $current_date &&
               $checkout_date > $checkin_date;
    }

    /**
     * Validate booking dates
     *
     * @param string $checkin Check-in date
     * @param string $checkout Check-out date
     * @return array Array with validation status and message
     */
    public function validate_booking_dates($checkin, $checkout)
    {
        $checkin_date = strtotime($checkin);
        $checkout_date = strtotime($checkout);
        $current_date = strtotime(date('Y-m-d'));

        if (!$checkin_date || !$checkout_date) {
            return [
                'is_valid' => false,
                'message' => 'Invalid date format. Use YYYY-MM-DD'
            ];
        }

        if ($checkin_date < $current_date) {
            return [
                'is_valid' => false,
                'message' => 'Check-in date cannot be in the past'
            ];
        }

        if ($checkout_date < $current_date) {
            return [
                'is_valid' => false,
                'message' => 'Check-out date cannot be in the past'
            ];
        }

        if ($checkout_date <= $checkin_date) {
            return [
                'is_valid' => false,
                'message' => 'Check-in date must be before check-out date'
            ];
        }

        return [
            'is_valid' => true,
            'message' => 'Dates are valid'
        ];
    }

    /**
     * Generate unique head code for acc_coa
     * 
     * @return string Head code
     */
    public function headcode()
    {
        $query = $this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102030%'");
        $coa = $query->row();

        $headcode = '';
        if ($coa->HeadCode != NULL) {
            $headcode = $coa->HeadCode + 1;
        } else {
            $headcode = "102030101";
        }
        return $headcode;
    }

    /**
     * Prepare cart item data
     * 
     * @param array $data Item data
     * @param int $grandtotal Grand total
     * @return array Prepared cart item data
     */
    public function prepare_cart_data($data, $grandtotal)
    {
        return [
            'id' => $data['roomid'],
            'name' => $data['roomtype'],
            'qty' => 1,
            'roomrate' => $data['roomrate'],
            'price' => $data['amount'],
            'totalprice' => $grandtotal,
            'checkin' => $data['checkin'],
            'checkout' => $data['checkout'],
            'adults' => $data['adults'],
            'children' => $data['children'],
            'tax' => $data['tax'],
            'scharge' => $data['servicecharge'],
            'discount' => $data['discount'] ?? 0,
            'customerid' => $data['customerid'],
            'fullName' => $data['guest'] ?? $data['f_name'] . ' ' . $data['l_name'],
            'email' => $data['email'],
            'special' => $data['specialinstruction']
        ];
    }

    /**
     * Check room availability
     * 
     * @param array $item Item data
     * @return array Room availability
     */
    public function check_room_availability($item)
    {
        $status = "bookingstatus!=1 AND bookingstatus!=5";
        $croom = "FIND_IN_SET(" . $item['room_id'] . ",roomid)";
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

        if (!empty($exits) || !empty($exit) || !empty($check)) {
            return [
                'is_available' => false,
                'reason' => 'No available rooms of this type'
            ];
        }

        $room = $this->db->get_where('roomdetails', ['roomid' => $item['room_id']])->row_array();
        if (!$room) {
            throw new Exception('Room not found');
        }

        return [
            'is_available' => true,
            'room_id' => $item['room_id'],
            'room_type' => $room['roomtype'],
            'rate' => $room['rate'],
            'checkin' => $item['checkin'],
            'checkout' => $item['checkout']
        ];
    }


    /**
     * Calculate booked rooms
     * 
     * @param array $item Item data
     * @param string $status Booking status
     * @return array Booked rooms
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
     * 
     * @param array $postData Booked info data
     */
    public function insert_booked_info($postData)
    {
        $this->db->insert('booked_info', $postData);
        return $this->db->insert_id();
    }

    /**
     * Insert booked details
     * 
     * @param array $bdetails_data Booked details data
     */
    public function insert_booked_details($bdetails_data)
    {
        $this->db->insert('booked_details', $bdetails_data);
    }

    /**
     * Update promocode status
     * 
     * @param string $promocode Promocode
     */
    public function update_promocode_status($promocode)
    {
        $this->db->set('status', 1);
        $this->db->where('promocode', $promocode);
        $this->db->update('promocode');
    }

    /**
     * Get common settings
     * 
     * @return object Common settings
     */
    public function commoninfo()
    {
        $this->db->select('*');
        $this->db->from('common_setting');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    /**
     * Get tax amount based on room price
     * 
     * @param int $amount Room price
     * @return int Tax amount
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
     * Calculate differences between two arrays
     * 
     * @param string $Arg1 First array
     * @param string $Arg2 Second array
     * @return string Differences between two arrays
     */
    public function differences($Arg1, $Arg2)
    {
        $Arg1 = explode(',', $Arg1);
        $Arg2 = explode(',', $Arg2);

        $Difference_1 = array_diff($Arg1, $Arg2);
        $Difference_2 = array_diff($Arg2, $Arg1);
        $Diff = array_merge($Difference_1, $Difference_2);
        $Difference = implode(',', $Diff);
        return $Difference;
    }

    /**
     * Get room details
     * 
     * @param array $room_ids Room IDs
     * @return array Room details
     */
    public function get_room_details($room_ids)
    {
        if (empty($room_ids)) return [];

        return $this->db->select("roomdetails.*, room_image.room_imagename")
            ->from('roomdetails')
            ->join('room_image', 'room_image.room_id = roomdetails.roomid', 'left')
            ->where_in('roomdetails.roomid', $room_ids)
            ->group_by("roomdetails.roomid")
            ->get()
            ->result();
    }

    /**
     * Get booked rooms
     * 
     * @param string $checkin Check-in date
     * @param string $checkout Check-out date
     * @param int $roomid Room ID (optional)
     * @return array Booked rooms
     */
    public function get_booked_rooms($checkin, $checkout, $roomid = null)
    {
        $status = "bookingstatus != 1 AND bookingstatus != 5";
        $croom = "FIND_IN_SET(" . $roomid . ",roomid)";

        $query = $this->db->select("room_no")
            ->from('booked_info')
            ->where("(checkindate<= '{$checkin}' AND checkoutdate > '{$checkin}') OR 
                 (checkindate < '{$checkout}' AND checkoutdate >= '{$checkout}') OR 
                 (checkindate > '{$checkin}' AND checkoutdate <= '{$checkout}')")
            ->where($status);

        if ($roomid) $query->where($croom);
        $booked = $query->get()->result_array();

        return array_column($booked, 'room_no');
    }

    /**
     * Get available rooms
     * 
     * @param array $room_ids List of room IDs
     * @param array $booked_rooms List of booked room numbers
     * @return array List of available room IDs
     */
    public function get_available_rooms($room_ids, $booked_rooms)
    {
        if (empty($room_ids)) {
            return [];
        }

        // Get all assigned room numbers for given room IDs
        $all_rooms = $this->db->select("roomid, roomno")
            ->from('tbl_roomnofloorassign')
            ->where_in('roomid', $room_ids)
            ->get()
            ->result_array();

        // Group rooms by room ID
        $room_map = [];
        foreach ($all_rooms as $room) {
            $room_map[$room['roomid']][] = $room['roomno'];
        }

        // Filter available rooms
        $available_rooms = [];
        foreach ($room_map as $room_id => $room_numbers) {
            $free_rooms = array_diff($room_numbers, $booked_rooms);
            if (!empty($free_rooms)) {
                $available_rooms[] = $room_id; // Add room ID if at least one free room is available
            }
        }

        return $available_rooms;
    }


    /**
     * Get user info
     * 
     * @return object User info
     */
    public function get_user_info($customerid = null)
    {
        if (!$customerid) {
            $customerid = $this->cache->get('customerid');
        }

        return $this->db->select("*")
            ->from('customerinfo')
            ->where('customerid', $customerid)
            ->get()
            ->row();
    }

    /**
     * Get all room IDs
     * 
     * @return array Room IDs
     */
    public function get_all_room_ids()
    {
        $room_ids = $this->db->select("DISTINCT(roomid)")
            ->from('tbl_roomnofloorassign')
            ->get()
            ->result_array();

        return array_column($room_ids, 'roomid');
    }
    

    /**
     * Check if a promo code has already been used
     * 
     * @param string $promo_code Promo code
     * @return object Promo code details or null if not found
     */
    public function check_promo_code_used($promo_code)
    {
        return $this->db->select("promocode")->from("booked_info")->where("promocode", $promo_code)->get()->row();
    }

    /**
     * Validate and fetch promo code details
     * 
     * @param string $promo_code Promo code
     * @param int $roomid Room ID
     * @return object Promo code details or null if not valid
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
}

