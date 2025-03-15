<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_settings()
    {
        $query = $this->db->get('setting');
        $settings = $query->row_array();
        
        // Merge with common settings
        $common = $this->db->get('common_setting')->row_array();
        if ($common) {
            $settings = array_merge($settings, $common);
        }
        
        return $settings;
    }

    public function get_languages()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('language');
        return $query->result_array();
    }

    public function get_currency()
    {
        $settings = $this->get_settings();
        return array(
            'code' => $settings['currency'],
            'symbol' => $settings['currency_symbol'],
            'position' => $settings['currency_position'],
            'decimal_places' => (int)$settings['precision']
        );
    }
}
