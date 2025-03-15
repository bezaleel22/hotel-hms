<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    private $booking;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Booking_handler');
        $this->booking = $this->booking_handler;
    }

    public function create_booking($data)
    {
        $this->db->trans_start();
        
        try {
            // Check availability
            $availability = $this->booking->checkRoomAvailability(
                $data['room_id'],
                $data['checkin'],
                $data['checkout']
            );

            if (!$availability['is_available']) {
                throw new Exception($availability['reason']);
            }

            // Calculate amount including extras
            $amount = $this->booking->calculateBookingAmount(
                $data['room_id'],
                $data['checkin'],
                $data['checkout'],
                $data['extras'] ?? []
            );

            // Prepare booking data
            $bookingData = [
                'room_id' => $data['room_id'],
                'customer_id' => $data['customer_id'],
                'checkin' => $data['checkin'],
                'checkout' => $data['checkout'],
                'adults' => $data['adults'],
                'children' => $data['children'] ?? 0,
                'special_requests' => $data['special_requests'] ?? null,
                'status' => Booking_handler::STATUS_PENDING,
                'total_amount' => $amount['grand_total'],
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('bookings', $bookingData);
            $bookingId = $this->db->insert_id();

            // Store extras if any
            if (!empty($data['extras'])) {
                $this->saveBookingExtras($bookingId, $data['extras']);
            }

            $this->db->trans_complete();

            return [
                'booking_id' => $bookingId,
                'amount' => $amount
            ];

        } catch (Exception $e) {
            $this->db->trans_rollback();
            throw $e;
        }
    }

    public function update_booking_status($bookingId, $status, $reason = null)
    {
        return $this->booking->handleBookingStatusChange($bookingId, $status, $reason);
    }

    public function get_booking_details($booking_id)
    {
        $this->db->select('bi.*, bd.*, r.roomtype, r.rate, c.firstname, c.lastname, c.email');
        $this->db->from('booked_info bi');
        $this->db->join('booked_details bd', 'bi.bookedid = bd.bookedid');
        $this->db->join('roomdetails r', 'bi.roomid = r.roomid');
        $this->db->join('customerinfo c', 'bi.cutomerid = c.customerid');
        $this->db->where('bi.bookedid', $booking_id);
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_booking($id)
    {
        $this->db->select('bi.*, bd.payment_method, bd.advance_amount, rd.roomtype, rd.rate');
        $this->db->from('booked_info bi');
        $this->db->join('booked_details bd', 'bd.bookedid = bi.bookedid', 'left');
        $this->db->join('roomdetails rd', 'rd.roomid = bi.roomid', 'left');
        $this->db->where('bi.bookedid', $id);

        $query = $this->db->get();
        if ($query->num_rows() === 0) {
            return null;
        }

        $booking = $query->row_array();
        
        // Calculate booking amount using BookingService
        $booking['rent_details'] = $this->booking->calculateBookingAmount(
            $booking['roomid'],
            $booking['checkindate'],
            $booking['checkoutdate']
        );

        return $booking;
    }

    public function update_booking($booking_id, $data)
    {
        $this->db->trans_start();
        
        try {
            $update_data = [];
            
            if (isset($data['adults'])) {
                $update_data['nuofpeople'] = $data['adults'];
            }
            if (isset($data['children'])) {
                $update_data['children'] = $data['children'];
            }
            if (isset($data['special_requests'])) {
                $update_data['special_request'] = $data['special_requests'];
            }

            if (!empty($update_data)) {
                $this->db->where('bookedid', $booking_id);
                $this->db->update('booked_info', $update_data);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Failed to update booking');
            }

            return true;

        } catch (Exception $e) {
            $this->db->trans_rollback();
            error_log('[ERROR] Failed to update booking: ' . $e->getMessage());
            return false;
        }
    }

    public function cancel_booking($booking_id)
    {
        try {
            $this->db->where('bookedid', $booking_id);
            $this->db->update('booked_info', ['bookingstatus' => 2]); // 2 = Cancelled
            return true;
        } catch (Exception $e) {
            error_log('[ERROR] Failed to cancel booking: ' . $e->getMessage());
            return false;
        }
    }

    public function get_booking_history($customerId)
    {
        $this->db->select('b.*, r.room_type, r.room_number');
        $this->db->from('bookings b');
        $this->db->join('rooms r', 'r.id = b.room_id');
        $this->db->where('b.customer_id', $customerId);
        $this->db->order_by('b.created_at', 'DESC');
        
        return $this->db->get()->result_array();
    }

    public function get_booking_stats()
    {
        // Implement booking statistics logic
        $stats = [
            'total_bookings' => $this->db->count_all('bookings'),
            'pending_bookings' => $this->db->where('status', Booking_handler::STATUS_PENDING)->count_all_results('bookings'),
            'confirmed_bookings' => $this->db->where('status', Booking_handler::STATUS_CONFIRMED)->count_all_results('bookings'),
            'cancelled_bookings' => $this->db->where('status', Booking_handler::STATUS_CANCELLED)->count_all_results('bookings')
        ];

        return $stats;
    }

    private function saveBookingExtras($bookingId, $extras)
    {
        foreach ($extras as $extra => $quantity) {
            $this->db->insert('booking_extras', [
                'booking_id' => $bookingId,
                'extra_type' => $extra,
                'quantity' => $quantity
            ]);
        }
    }
}
