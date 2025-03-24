<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Read all records with conditions
     */
    private function read_all($select_items, $table, $orderby, $delitem = "", $stype = "", $val = "")
    {
        $this->db->select($select_items);
        $this->db->from($table);
        if ($delitem != "") {
            $this->db->where($delitem, 0);
        }
        if ($stype != "") {
            $this->db->where($stype, $val);
        }
        $this->db->order_by($orderby, 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Get home page content
     */
    public function get_home_content()
    {
        $page = $this->db->select('*')
            ->from('page_title')
            ->where('pageid', 1)
            ->get()
            ->row();

        $data['title'] = !empty($page->home) ? $page->home : null;

        // Get current date and future 12 months for offers
        $curdate = date('Y-m-d');
        $month = date("Y-m-d", strtotime(" +12 months"));
        $where = "offer_date Between '" . $curdate . "' AND '" . $month . "'";

        // Get sliders and banners
        $data['slider_info'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '1');
        $data['banner_homemiddle'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '2');
        $data['banner_topweek'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '3');
        $data['banner_destination'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '4');

        // Get room offers
        $data['room_offers'] = $this->db->select("*")
            ->from('tbl_room_offer')
            ->where($where)
            ->order_by('offer_date', 'ASC')
            ->get()
            ->result();

        return $data;
    }

    /**
     * Get about page content
     */
    public function get_about_content()
    {
        $page = $this->db->select('*')
            ->from('page_title')
            ->where('pageid', 1)
            ->get()
            ->row();

        $data['title'] = $page->aboutus;
        $data['team_info'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '5');
        $data['company'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '9');
        $data['about_smallbig'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '6');

        return $data;
    }

    /**
     * Get gallery content
     */
    public function get_gallery_content()
    {
        $page = $this->db->select('*')
            ->from('page_title')
            ->where('pageid', 1)
            ->get()
            ->row();

        $data['title'] = $page->gallery;
        $data['gallery_types'] = $this->db->select("DISTINCT(title)")
            ->from('tbl_slider')
            ->where('Sltypeid', 8)
            ->get()
            ->result();
        $data['galleries'] = $this->read_all('*', 'tbl_slider', 'slid', 'delation_status', 'Sltypeid', '8');

        return $data;
    }

    /**
     * Get page content by ID
     */
    public function get_page_content($page_id)
    {
        $page = $this->db->select('*')
            ->from('page_title')
            ->where('pageid', $page_id)
            ->get()
            ->row();

        if (!$page) {
            return null;
        }

        return [
            'title' => $page->title,
            'content' => $page->description
        ];
    }

    /**
     * Check if email is already subscribed
     */
    public function is_subscribed($email)
    {
        return $this->db->where('email', $email)
            ->get('subscribe_emaillist')
            ->num_rows() > 0;
    }

    /**
     * Save newsletter subscription and send confirmation
     */
    public function save_subscription($email)
    {
        try {
            // Prepare subscription data
            $subscription_data = [
                'email' => $email,
                'dateinsert' => date('Y-m-d H:i:s')
            ];

            // Insert subscription
            $this->db->insert('subscribe_emaillist', $subscription_data);
            if ($this->db->affected_rows() === 0) {
                throw new Exception('Failed to save subscription');
            }
            return $subscription_data;
        } catch (Exception $e) {
            log_message('error', 'Failed to process subscription: ' . $e->getMessage());
            throw $e;
        }
    }
}
