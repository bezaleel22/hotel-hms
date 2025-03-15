<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Room Status Service
 * 
 * Handles room status management without modifying database structure
 * Maps between existing status codes and logical states
 */
class Room_status_service {
    /** @var CI_Controller */
    private $CI;
    
    /** @var CI_DB_query_builder */
    private $db;
    
    // Logical states
    const STATE_AVAILABLE = 'available';
    const STATE_BOOKED = 'booked';
    const STATE_CHECKED_IN = 'checked_in';
    const STATE_DIRTY = 'dirty';
    const STATE_CLEANING = 'cleaning';
    
    public function __construct() {
        $this->CI =& get_instance();
        
        // Initialize database
        require_once BASEPATH.'database/DB.php';
        $this->db =& DB();
    }
    
    /**
     * Get current logical state from database values
     * 
     * @param int $roomId Room ID
     * @return string Logical state
     */
    public function getCurrentState($roomId) {
        // Get room booking status
        $booking_status = $this->db->select('bookingstatus')
            ->from('booked_info')
            ->where('roomid', $roomId)
            ->get()->row();
            
        $booking_status = $booking_status ? $booking_status->bookingstatus : 1; // Default to available
            
        // Get housekeeping status if exists
        $cleaning = $this->db->select('status')
            ->from('tbl_housekeepingrecord')
            ->where('roomno', $roomId)
            ->where('status !=', 1) // Not completed
            ->order_by('hkeeper_id', 'DESC')
            ->limit(1)
            ->get()->row();
            
        // Determine logical state based on combination of statuses
        if ($cleaning && $cleaning->status == 2) {
            return self::STATE_CLEANING;
        }
        
        if ($booking_status == 4 && (!$cleaning || $cleaning->status == 0)) {
            return self::STATE_DIRTY;
        }
        
        // Map other states
        switch($booking_status) {
            case 1: return self::STATE_AVAILABLE;
            case 2: return self::STATE_BOOKED;
            case 4: return self::STATE_CHECKED_IN;
            default: return self::STATE_AVAILABLE;
        }
    }
    
    /**
     * Handle state transitions without changing existing status codes
     * 
     * @param int $roomId Room ID
     * @param string $newState Desired state
     * @return bool Success status
     */
    public function transition($roomId, $newState) {
        // Validate transition is allowed
        if (!$this->canTransition($roomId, $newState)) {
            return false;
        }
        
        switch($newState) {
            case self::STATE_DIRTY:
                // Keep booking status as 4 but create pending housekeeping record
                return $this->db->insert('tbl_housekeepingrecord', [
                    'roomno' => $roomId,
                    'status' => 0, // Pending
                    'createDate' => date('Y-m-d H:i:s')
                ]);
                
            case self::STATE_CLEANING:
                // Update housekeeping record to in-progress
                return $this->db->where('roomno', $roomId)
                    ->where('status', 0)
                    ->update('tbl_housekeepingrecord', [
                        'status' => 2, // Under Process
                        'date_start' => date('Y-m-d H:i:s')
                    ]);
                
            case self::STATE_AVAILABLE:
                // Complete housekeeping and update room status
                $this->db->trans_start();
                
                $this->db->where('roomno', $roomId)
                    ->where('status', 2)
                    ->update('tbl_housekeepingrecord', [
                        'status' => 1, // Completed
                        'date_end' => date('Y-m-d H:i:s')
                    ]);
                    
                $this->db->where('roomid', $roomId)
                    ->update('booked_info', ['bookingstatus' => 1]);
                    
                $this->db->trans_complete();
                return $this->db->trans_status();
                
            case self::STATE_BOOKED:
                return $this->db->where('roomid', $roomId)
                    ->update('booked_info', ['bookingstatus' => 2]);
                    
            case self::STATE_CHECKED_IN:
                return $this->db->where('roomid', $roomId)
                    ->update('booked_info', ['bookingstatus' => 4]);
                    
            default:
                return false;
        }
    }
    
    /**
     * Check if transition to new state is allowed
     * 
     * @param int $roomId Room ID
     * @param string $newState Desired state
     * @return bool Whether transition is allowed
     */
    private function canTransition($roomId, $newState) {
        $currentState = $this->getCurrentState($roomId);
        
        // Define valid transitions
        $valid_transitions = [
            self::STATE_AVAILABLE => [self::STATE_BOOKED],
            self::STATE_BOOKED => [self::STATE_CHECKED_IN],
            self::STATE_CHECKED_IN => [self::STATE_DIRTY],
            self::STATE_DIRTY => [self::STATE_CLEANING],
            self::STATE_CLEANING => [self::STATE_AVAILABLE]
        ];
        
        return isset($valid_transitions[$currentState]) && 
               in_array($newState, $valid_transitions[$currentState]);
    }
    
    /**
     * Get human readable status for display
     * 
     * @param int $roomId Room ID
     * @return string Status label
     */
    public function getStatusLabel($roomId) {
        $state = $this->getCurrentState($roomId);
        
        $labels = [
            self::STATE_AVAILABLE => 'Available',
            self::STATE_BOOKED => 'Booked',
            self::STATE_CHECKED_IN => 'Checked In',
            self::STATE_DIRTY => 'Needs Cleaning',
            self::STATE_CLEANING => 'Cleaning In Progress'
        ];
        
        return isset($labels[$state]) ? $labels[$state] : 'Unknown';
    }
}