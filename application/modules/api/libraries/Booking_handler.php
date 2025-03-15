<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * BookingService Library
 * 
 * Handles all booking-related business logic including status management,
 * notifications, and related operations.
 * 
 * @package     Application
 * @subpackage  Libraries
 * @category    Booking
 * @author      Your Name
 */
class Booking_handler
{
    /**
     * CI instance
     * @var object
     */
    protected $CI;

    /**
     * System settings
     * @var array
     */
    protected $settings;

    /**
     * Booking status constants
     */
    const STATUS_PENDING = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_CHECKED_IN = 3;
    const STATUS_CHECKED_OUT = 4;

    /**
     * Room status constants
     */
    const ROOM_STATUS_AVAILABLE = 1;
    const ROOM_STATUS_OCCUPIED = 2;
    const ROOM_STATUS_NEEDS_CLEANING = 9;

    /**
     * Initialize the library
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        
        // Load necessary dependencies
        $this->CI->load->database();
        $this->CI->load->model('api/setting_model');
        $this->CI->load->library('email');
        
        // Load settings
        $this->settings = $this->CI->setting_model->get_settings();
    }

    /**
     * Generate a unique booking number
     * 
     * @return string Formatted booking number (e.g., BK2309151234)
     */
    public function generateBookingNumber()
    {
        $prefix = 'BK';
        $date = date('ymd');
        $random = rand(1000, 9999);
        return $prefix . $date . $random;
    }

    /**
     * Check room availability for given dates
     * 
     * @param int $roomId Room identifier
     * @param string $checkin Check-in date (Y-m-d format)
     * @param string $checkout Check-out date (Y-m-d format)
     * @return array Availability status and details
     */
    public function checkRoomAvailability($roomId, $checkin, $checkout)
    {
        // Get room details
        $room = $this->CI->db->get_where('roomdetails', ['roomid' => $roomId])->row();
        
        if (!$room) {
            return [
                'is_available' => false,
                'reason' => 'Room not found',
                'room_id' => $roomId
            ];
        }

        // Check existing bookings
        $this->CI->db->where('roomid', $roomId)
            ->where('bookingstatus !=', self::STATUS_CANCELLED)
            ->group_start()
                ->where("checkindate < '$checkout'")
                ->where("checkoutdate > '$checkin'")
            ->group_end();
        
        $existing_bookings = $this->CI->db->get('booked_info')->num_rows();

        return [
            'is_available' => ($existing_bookings === 0),
            'room_id' => $roomId,
            'room_type' => $room->roomtype,
            'rate' => $room->rate,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'reason' => ($existing_bookings > 0) ? 'Room is already booked for these dates' : null
        ];
    }

    /**
     * Handle booking status change and related operations
     * 
     * @param int $bookingId Booking identifier
     * @param int $newStatus New booking status
     * @param string|null $reason Reason for status change
     * @throws Exception If booking not found or invalid status
     * @return bool Status update result
     */
    public function handleBookingStatusChange($bookingId, $newStatus, $reason = null)
    {
        // Start transaction
        $this->CI->db->trans_start();

        try {
            // Update main booking status
            $updateData = ['bookingstatus' => $newStatus];
            if ($reason) {
                $updateData['special_request'] = $reason;
            }

            $this->CI->db->where('bookedid', $bookingId)
                        ->update('booked_info', $updateData);

            // Handle status-specific operations
            switch ($newStatus) {
                case self::STATUS_CANCELLED:
                    $this->handleCancellation($bookingId, $reason);
                    break;
                case self::STATUS_CONFIRMED:
                    $this->handleConfirmation($bookingId);
                    break;
                case self::STATUS_CHECKED_IN:
                    $this->handleCheckin($bookingId);
                    break;
                case self::STATUS_CHECKED_OUT:
                    $this->handleCheckout($bookingId);
                    break;
            }

            $this->CI->db->trans_complete();
            return $this->CI->db->trans_status();

        } catch (Exception $e) {
            $this->CI->db->trans_rollback();
            throw $e;
        }
    }

    /**
     * Handle booking cancellation process
     * 
     * @param int $bookingId Booking identifier
     * @param string|null $reason Cancellation reason
     * @throws Exception If process fails
     */
    protected function handleCancellation($bookingId, $reason = null)
    {
        $booking = $this->getBookingDetails($bookingId);
        if (!$booking) {
            throw new Exception('Booking not found');
        }

        // Send cancellation email
        if (!empty($booking['email'])) {
            $this->sendCancellationEmail($bookingId, $booking['email']);
        }

        // Release room inventory
        $this->CI->db->where('room_id', $booking['roomid'])
                     ->where('date_from', $booking['checkindate'])
                     ->where('date_to', $booking['checkoutdate'])
                     ->delete('room_inventory');

        // Log cancellation
        $this->logStatusChange($bookingId, self::STATUS_CANCELLED, $reason);
    }

    /**
     * Handle booking confirmation process
     * 
     * @param int $bookingId Booking identifier
     * @throws Exception If process fails
     */
    protected function handleConfirmation($bookingId)
    {
        $booking = $this->getBookingDetails($bookingId);
        if (!$booking) {
            throw new Exception('Booking not found');
        }

        // Send confirmation email
        if (!empty($booking['email'])) {
            $this->sendConfirmationEmail($bookingId, $booking['email']);
        }

        // Log confirmation
        $this->logStatusChange($bookingId, self::STATUS_CONFIRMED);
    }

    /**
     * Handle check-in process
     * 
     * @param int $bookingId Booking identifier
     * @throws Exception If process fails
     */
    protected function handleCheckin($bookingId)
    {
        $booking = $this->getBookingDetails($bookingId);
        if (!$booking) {
            throw new Exception('Booking not found');
        }

        // Update room status
        $this->CI->db->where('roomid', $booking['roomid'])
                     ->update('roomdetails', ['status' => self::ROOM_STATUS_OCCUPIED]);

        // Create room inventory record
        $this->CI->db->insert('room_inventory', [
            'room_id' => $booking['roomid'],
            'booking_id' => $bookingId,
            'status' => self::ROOM_STATUS_OCCUPIED,
            'check_in_date' => date('Y-m-d H:i:s')
        ]);

        // Log check-in
        $this->logStatusChange($bookingId, self::STATUS_CHECKED_IN);
    }

    /**
     * Handle check-out process
     * 
     * @param int $bookingId Booking identifier
     * @throws Exception If process fails
     */
    protected function handleCheckout($bookingId)
    {
        $booking = $this->getBookingDetails($bookingId);
        if (!$booking) {
            throw new Exception('Booking not found');
        }

        // Update room status
        $this->CI->db->where('roomid', $booking['roomid'])
                     ->update('roomdetails', ['status' => self::ROOM_STATUS_NEEDS_CLEANING]);

        // Update room inventory
        $this->CI->db->where('booking_id', $bookingId)
                     ->update('room_inventory', [
                         'status' => self::ROOM_STATUS_NEEDS_CLEANING,
                         'check_out_date' => date('Y-m-d H:i:s')
                     ]);

        // Log check-out
        $this->logStatusChange($bookingId, self::STATUS_CHECKED_OUT);
    }

    /**
     * Send confirmation email to customer
     * 
     * @param int $bookingId Booking identifier
     * @param string $email Customer email address
     * @return bool Email sending status
     */
    protected function sendConfirmationEmail($bookingId, $email)
    {
        $booking = $this->getBookingDetails($bookingId);
        if (!$booking) {
            throw new Exception('Booking not found');
        }

        $this->CI->email->clear();
        $this->CI->email->from($this->settings['system_email'], $this->settings['hotel_name']);
        $this->CI->email->to($email);
        $this->CI->email->subject('Booking Confirmation - ' . $booking['booking_number']);

        $emailData = [
            'booking' => $booking,
            'hotel_name' => $this->settings['hotel_name'],
            'hotel_address' => $this->settings['hotel_address'],
            'hotel_phone' => $this->settings['hotel_phone']
        ];

        $message = $this->CI->load->view('email/booking_confirmation', $emailData, TRUE);
        $this->CI->email->message($message);

        return $this->CI->email->send();
    }

    /**
     * Send cancellation email to customer
     * 
     * @param int $bookingId Booking identifier
     * @param string $email Customer email address
     * @return bool Email sending status
     */
    protected function sendCancellationEmail($bookingId, $email)
    {
        $booking = $this->getBookingDetails($bookingId);
        if (!$booking) {
            throw new Exception('Booking not found');
        }

        $this->CI->email->clear();
        $this->CI->email->from($this->settings['system_email'], $this->settings['hotel_name']);
        $this->CI->email->to($email);
        $this->CI->email->subject('Booking Cancellation - ' . $booking['booking_number']);

        $emailData = [
            'booking' => $booking,
            'hotel_name' => $this->settings['hotel_name'],
            'hotel_address' => $this->settings['hotel_address'],
            'hotel_phone' => $this->settings['hotel_phone']
        ];

        $message = $this->CI->load->view('email/booking_cancellation', $emailData, TRUE);
        $this->CI->email->message($message);

        return $this->CI->email->send();
    }

    /**
     * Calculate booking amount including taxes and fees
     * 
     * @param int $roomId Room identifier
     * @param string $checkin Check-in date
     * @param string $checkout Check-out date
     * @param float|null $discountAmount Discount amount if applicable
     * @return array Booking amount details
     */
    public function calculateBookingAmount($roomId, $checkin, $checkout, $discountAmount = null)
    {
        // Get room details
        $room = $this->CI->db->get_where('roomdetails', ['roomid' => $roomId])->row();
        if (!$room) {
            throw new Exception('Room not found');
        }

        // Calculate number of nights
        $checkinDate = new DateTime($checkin);
        $checkoutDate = new DateTime($checkout);
        $nights = $checkoutDate->diff($checkinDate)->days;

        // Calculate base amount
        $baseAmount = $room->rate * $nights;

        // Calculate tax
        $taxRate = $this->settings['tax_rate'] ?? 0;
        $taxAmount = ($baseAmount * $taxRate) / 100;

        // Calculate service fee
        $serviceFee = $this->settings['service_fee'] ?? 0;

        // Apply discount if provided
        $discountAmount = $discountAmount ?? 0;

        // Calculate total
        $totalAmount = $baseAmount + $taxAmount + $serviceFee - $discountAmount;

        return [
            'base_amount' => $baseAmount,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'service_fee' => $serviceFee,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'nights' => $nights,
            'rate_per_night' => $room->rate
        ];
    }

    /**
     * Validate booking dates
     * 
     * @param string $checkin Check-in date
     * @param string $checkout Check-out date
     * @return array Validation result with status and message
     */
    public function validateBookingDates($checkin, $checkout)
    {
        $today = new DateTime();
        $checkinDate = new DateTime($checkin);
        $checkoutDate = new DateTime($checkout);

        // Check if dates are valid
        if ($checkinDate >= $checkoutDate) {
            return [
                'valid' => false,
                'message' => 'Check-out date must be after check-in date'
            ];
        }

        // Check if check-in date is not in the past
        if ($checkinDate < $today) {
            return [
                'valid' => false,
                'message' => 'Check-in date cannot be in the past'
            ];
        }

        // Check maximum stay duration (if configured)
        $maxStayDays = $this->settings['max_stay_days'] ?? 30;
        $stayDuration = $checkoutDate->diff($checkinDate)->days;
        if ($stayDuration > $maxStayDays) {
            return [
                'valid' => false,
                'message' => "Maximum stay duration is {$maxStayDays} days"
            ];
        }

        return [
            'valid' => true,
            'message' => 'Dates are valid'
        ];
    }

    /**
     * Get detailed booking information
     * 
     * @param int $bookingId Booking identifier
     * @return array|null Booking details with customer information
     */
    protected function getBookingDetails($bookingId)
    {
        return $this->CI->db->select('bi.*, bd.*, c.email, c.firstname, c.lastname')
                           ->from('booked_info bi')
                           ->join('booked_details bd', 'bi.bookedid = bd.bookedid')
                           ->join('customerinfo c', 'bi.cutomerid = c.customerid')
                           ->where('bi.bookedid', $bookingId)
                           ->get()
                           ->row_array();
    }

    /**
     * Log booking status change
     * 
     * @param int $bookingId Booking identifier
     * @param int $status New status
     * @param string|null $reason Status change reason
     */
    protected function logStatusChange($bookingId, $status, $reason = null)
    {
        $this->CI->db->insert('booking_status_log', [
            'booking_id' => $bookingId,
            'status' => $status,
            'reason' => $reason,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}