<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Room Status Helper
 * 
 * Helper functions for room status management
 */

if (!function_exists('get_room_status')) {
    /**
     * Get current room status
     * 
     * @param int $roomId Room ID
     * @return string Status label
     */
    function get_room_status($roomId) {
        /** @var CI_Controller|object $CI */
        $CI =& get_instance();
        
        // Load room status service if not loaded
        if (!property_exists($CI, 'room_status_service')) {
            $CI->load->library('room_status_service');
        }
        
        return $CI->room_status_service->getStatusLabel($roomId);
    }
}

if (!function_exists('change_room_status')) {
    /**
     * Change room status
     * 
     * @param int $roomId Room ID
     * @param string $newState New state (available|booked|checked_in|dirty|cleaning)
     * @return bool Success status
     */
    function change_room_status($roomId, $newState) {
        /** @var CI_Controller|object $CI */
        $CI =& get_instance();
        
        // Load room status service if not loaded
        if (!property_exists($CI, 'room_status_service')) {
            $CI->load->library('room_status_service');
        }
        
        return $CI->room_status_service->transition($roomId, $newState);
    }
}

if (!function_exists('get_room_state')) {
    /**
     * Get room logical state
     * 
     * @param int $roomId Room ID
     * @return string State constant
     */
    function get_room_state($roomId) {
        /** @var CI_Controller|object $CI */
        $CI =& get_instance();
        
        // Load room status service if not loaded
        if (!property_exists($CI, 'room_status_service')) {
            $CI->load->library('room_status_service');
        }
        
        return $CI->room_status_service->getCurrentState($roomId);
    }
}