<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promocode_model extends CI_Model
{
    private $table = 'promocode';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Validate promo code
     * 
     * @param string $code The promo code to validate
     * @param int $room_id Room ID to check against
     * @param int $customer_id Customer ID for usage tracking
     * @return array Validation result with discount info if valid
     */
    public function validate_code($code, $room_id, $customer_id)
    {
        try {
            // Get promo code details
            $this->db->select('p.*, r.title as room_name');
            $this->db->from($this->table . ' p');
            $this->db->join('roomdetails r', 'r.roomid = p.roomid', 'left');
            $this->db->where('p.promocode', $code);
            $this->db->where('p.status', 1); // Active codes only
            $query = $this->db->get();

            if ($query->num_rows() === 0) {
                return [
                    'is_valid' => false,
                    'message' => 'Invalid promo code'
                ];
            }

            $promo = $query->row();
            $now = date('Y-m-d');

            // Check if code has expired
            if ($promo->enddate && $now > $promo->enddate) {
                return [
                    'is_valid' => false,
                    'message' => 'Promo code has expired'
                ];
            }

            // Check if code is not yet active
            if ($promo->startdate && $now < $promo->startdate) {
                return [
                    'is_valid' => false,
                    'message' => 'Promo code is not yet active'
                ];
            }

            // Check if code is valid for this room
            if ($promo->roomid && $promo->roomid != $room_id) {
                return [
                    'is_valid' => false,
                    'message' => 'Promo code is not valid for this room'
                ];
            }

            // Check usage limit per customer if set
            if ($promo->usage_limit) {
                $usage_count = $this->get_customer_usage_count($code, $customer_id);
                if ($usage_count >= $promo->usage_limit) {
                    return [
                        'is_valid' => false,
                        'message' => 'Usage limit reached for this promo code'
                    ];
                }
            }

            // Log validation attempt
            $this->log_validation_attempt($code, $customer_id, $room_id, true);

            // Code is valid, return discount information
            return [
                'is_valid' => true,
                'discount' => floatval($promo->discount),
                'discount_type' => $this->determine_discount_type($promo->discount),
                'expires_at' => $promo->enddate,
                'room_name' => $promo->room_name
            ];

        } catch (Exception $e) {
            log_message('error', 'Error validating promo code: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get valid promo codes for customer
     * 
     * @param int $customer_id Customer ID
     * @return array List of valid promo codes
     */
    public function get_valid_codes($customer_id)
    {
        $now = date('Y-m-d');
        
        $this->db->select('p.*, r.title as room_name');
        $this->db->from($this->table . ' p');
        $this->db->join('roomdetails r', 'r.roomid = p.roomid', 'left');
        $this->db->where('p.status', 1);
        $this->db->where('p.startdate <=', $now);
        $this->db->where('(p.enddate > "' . $now . '" OR p.enddate IS NULL)');
        
        $query = $this->db->get();
        
        $codes = [];
        foreach ($query->result() as $promo) {
            $usage_count = $this->get_customer_usage_count($promo->promocode, $customer_id);
            
            if (!$promo->usage_limit || $usage_count < $promo->usage_limit) {
                $codes[] = [
                    'code' => $promo->promocode,
                    'discount' => floatval($promo->discount),
                    'discount_type' => $this->determine_discount_type($promo->discount),
                    'room_name' => $promo->room_name,
                    'expires_at' => $promo->enddate,
                    'remaining_uses' => $promo->usage_limit ? ($promo->usage_limit - $usage_count) : null
                ];
            }
        }
        
        return $codes;
    }

    /**
     * Get usage history for customer
     * 
     * @param int $customer_id Customer ID
     * @return array Usage history
     */
    public function get_usage_history($customer_id)
    {
        $this->db->select('pc.*, r.title as room_name, b.booking_date');
        $this->db->from('promocode_usage pc');
        $this->db->join('booked_info b', 'b.booking_id = pc.booking_id', 'left');
        $this->db->join('roomdetails r', 'r.roomid = pc.room_id', 'left');
        $this->db->where('pc.customer_id', $customer_id);
        $this->db->order_by('pc.used_at', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Determine if discount is percentage or fixed amount
     * 
     * @param string|float $discount The discount value
     * @return string 'percentage' or 'fixed'
     */
    private function determine_discount_type($discount)
    {
        return floatval($discount) > 100 ? 'fixed' : 'percentage';
    }

    /**
     * Get usage count for customer
     * 
     * @param string $code Promo code
     * @param int $customer_id Customer ID
     * @return int Usage count
     */
    private function get_customer_usage_count($code, $customer_id)
    {
        return $this->db->where('promocode', $code)
            ->where('customer_id', $customer_id)
            ->count_all_results('promocode_usage');
    }

    /**
     * Log validation attempt
     * 
     * @param string $code Promo code
     * @param int $customer_id Customer ID
     * @param int $room_id Room ID
     * @param bool $success Whether validation was successful
     */
    private function log_validation_attempt($code, $customer_id, $room_id, $success)
    {
        $this->db->insert('promocode_validation_log', [
            'promocode' => $code,
            'customer_id' => $customer_id,
            'room_id' => $room_id,
            'success' => $success,
            'validated_at' => date('Y-m-d H:i:s'),
            'ip_address' => $this->input->ip_address()
        ]);
    }
}
