<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('ciqrcode');
    }
    
    // Get all tables with their QR codes
    public function get_all_tables_with_qr() {
        $this->db->select('rest_table.*, emenu_qr_tables.qr_code, emenu_qr_tables.created_at as qr_created, emenu_qr_tables.expires_at');
        $this->db->from('rest_table');
        $this->db->join('emenu_qr_tables', 'rest_table.tableid = emenu_qr_tables.table_id', 'left');
        return $this->db->get()->result();
    }
    
    // Generate new QR code for a table
    public function generate_table_qr($table_id) {
        // Check if table exists
        $table = $this->db->get_where('rest_table', array('tableid' => $table_id))->row();
        if (!$table) {
            return false;
        }
        
        // Generate unique token
        $token = $this->_generate_token();
        
        // Get QR expiry setting
        $settings = $this->db->get('tbl_emenu_config')->result_array();
        $config = array_column($settings, 'setting_value', 'setting_name');
        $expiry_hours = isset($config['qr_expiry_hours']) ? $config['qr_expiry_hours'] : 24;
        
        // Generate QR code
        $qr_data = array(
            'table_id' => $table_id,
            'access_token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => date('Y-m-d H:i:s', strtotime("+{$expiry_hours} hours"))
        );
        
        // Generate QR code image
        $qr_path = $this->_generate_qr_image($table_id, $token);
        if (!$qr_path) {
            return false;
        }
        
        $qr_data['qr_code'] = $qr_path;
        
        // Delete existing QR code for this table
        $this->db->where('table_id', $table_id)->delete('emenu_qr_tables');
        
        // Save new QR code
        return $this->db->insert('emenu_qr_tables', $qr_data);
    }
    
    // Regenerate QR code
    public function regenerate_table_qr($table_id) {
        return $this->generate_table_qr($table_id);
    }
    
    // Validate table access
    public function validate_table_access($table_id, $token) {
        $qr = $this->db->where('table_id', $table_id)
                       ->where('access_token', $token)
                       ->where('expires_at >', date('Y-m-d H:i:s'))
                       ->get('emenu_qr_tables')
                       ->row();
                       
        return (bool)$qr;
    }
    
    // Create or get session
    public function get_or_create_session($table_id) {
        // Check for existing active session
        $existing = $this->db->where('table_id', $table_id)
                            ->where('status', 1)
                            ->where('expires_at >', date('Y-m-d H:i:s'))
                            ->get('emenu_sessions')
                            ->row();
                            
        if ($existing) {
            return array(
                'id' => $existing->id,
                'table_id' => $existing->table_id,
                'session_token' => $existing->session_token,
                'customer_id' => $existing->customer_id
            );
        }
        
        // Create new session
        $session_data = array(
            'table_id' => $table_id,
            'session_token' => $this->_generate_token(),
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => date('Y-m-d H:i:s', strtotime('+2 hours')),
            'status' => 1
        );
        
        $this->db->insert('emenu_sessions', $session_data);
        $session_data['id'] = $this->db->insert_id();
        
        return $session_data;
    }
    
    // Validate session
    public function validate_session($session_data) {
        if (!isset($session_data['id']) || !isset($session_data['session_token'])) {
            return false;
        }
        
        $session = $this->db->where('id', $session_data['id'])
                           ->where('session_token', $session_data['session_token'])
                           ->where('status', 1)
                           ->where('expires_at >', date('Y-m-d H:i:s'))
                           ->get('emenu_sessions')
                           ->row();
                           
        if ($session) {
            // Update last activity
            $this->db->where('id', $session_data['id'])
                    ->update('emenu_sessions', array(
                        'last_activity' => date('Y-m-d H:i:s')
                    ));
            return true;
        }
        
        return false;
    }
    
    // Generate unique token
    private function _generate_token($length = 32) {
        return bin2hex(random_bytes($length));
    }
    
    // Generate QR code image
    private function _generate_qr_image($table_id, $token) {
        // Create QR code directory if it doesn't exist
        $qr_path = 'application/modules/emenu/assets/images/qr/';
        if (!is_dir($qr_path)) {
            mkdir($qr_path, 0755, true);
        }
        
        // QR code parameters
        $params['data'] = site_url("menu/index/{$table_id}/{$token}");
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $qr_path . "table_{$table_id}.png";
        
        // Generate QR code
        if ($this->ciqrcode->generate($params)) {
            return "table_{$table_id}.png";
        }
        
        return false;
    }
}