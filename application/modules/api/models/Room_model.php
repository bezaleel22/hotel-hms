<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Room Model for API
 * 
 * Handles database operations for rooms
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
     * Get detailed room information
     * 
     * @param int $id Room ID
     * @return array|null Room details
     */
    public function get_room_details($room_id)
    {
        $this->db->select('rd.*, ri.room_imagename, rf.roomno, rf.status as room_status');
        $this->db->from('roomdetails rd');
        $this->db->join('room_image ri', 'ri.room_id = rd.roomid', 'left');
        $this->db->join('tbl_roomnofloorassign rf', 'rf.roomid = rd.roomid', 'left');
        $this->db->where('rd.roomid', $room_id);
        
        $result = $this->db->get()->row_array();
        if (!$result) {
            throw new Exception('Room not found');
        }
        
        // Get room facilities
        $result['facilities'] = $this->get_room_facilities($room_id);
        
        return $result;
    }

    /**
     * Check room availability
     * 
     * @param int $room_id Room ID
     * @param string $checkin Check-in date
     * @param string $checkout Check-out date
     * @return array Availability status and details
     */
    public function check_availability($room_id, $checkin, $checkout)
    {
        // Validate dates
        if (!$this->_validate_dates($checkin, $checkout)) {
            throw new Exception('Invalid date range');
        }

        // Check room exists
        $room = $this->db->get_where('roomdetails', ['roomid' => $room_id])->row_array();
        if (!$room) {
            throw new Exception('Room not found');
        }

        // Check room assignment status
        $available_rooms = $this->db->where('roomid', $room_id)
            ->where('status', 1) // 1 = available
            ->get('tbl_roomnofloorassign')
            ->num_rows();

        if ($available_rooms === 0) {
            return [
                'is_available' => false,
                'reason' => 'No available rooms of this type'
            ];
        }

        // Check existing bookings
        $bookings = $this->db->where('roomid', $room_id)
            ->where("(checkindate <= '$checkout' AND checkoutdate >= '$checkin')")
            ->where_in('bookingstatus', [1, 4, 5]) // Active booking statuses
            ->get('booked_info')
            ->num_rows();

        return [
            'is_available' => ($bookings === 0),
            'room_id' => $room_id,
            'room_type' => $room['roomtype'],
            'rate' => $room['rate'],
            'checkin' => $checkin,
            'checkout' => $checkout
        ];
    }

    public function get_room_types()
    {
        return $this->db->select('DISTINCT(roomtype) as type')
            ->from('roomdetails')
            ->get()
            ->result_array();
    }

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

    private function _validate_dates($checkin, $checkout)
    {
        $checkin_date = strtotime($checkin);
        $checkout_date = strtotime($checkout);
        
        return $checkin_date && $checkout_date && $checkout_date > $checkin_date;
    }
}
