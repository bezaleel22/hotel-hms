<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emenu_model extends CI_Model {
    
    private $config_table = 'tbl_emenu_config';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Settings Management
    public function get_settings() {
        $settings = $this->db->get($this->config_table)->result();
        $config = array();
        foreach ($settings as $setting) {
            $config[$setting->setting_name] = $setting->setting_value;
        }
        return $config;
    }
    
    public function update_settings($data) {
        foreach ($data as $key => $value) {
            $this->db->where('setting_name', $key);
            $exists = $this->db->get($this->config_table)->row();
            
            if ($exists) {
                $this->db->where('setting_name', $key);
                $this->db->update($this->config_table, array('setting_value' => $value));
            } else {
                $this->db->insert($this->config_table, array(
                    'setting_name' => $key,
                    'setting_value' => $value
                ));
            }
        }
        return true;
    }
    
    // Statistics and Analytics
    public function count_active_sessions() {
        return $this->db->where('status', 1)
                        ->where('expires_at >', date('Y-m-d H:i:s'))
                        ->count_all_results('emenu_sessions');
    }
    
    public function count_today_orders() {
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $this->db->join('order_menu', 'order_menu.order_id = customer_order.order_id');
        $this->db->where('order_menu.emenu_session_id IS NOT NULL');
        return $this->db->count_all_results('customer_order');
    }
    
    public function get_popular_items($limit = 10) {
        $this->db->select('item_foods.*, COUNT(order_menu.menu_id) as order_count');
        $this->db->from('item_foods');
        $this->db->join('order_menu', 'order_menu.menu_id = item_foods.ProductsID');
        $this->db->join('customer_order', 'customer_order.order_id = order_menu.order_id');
        $this->db->where('DATE(customer_order.order_date) >=', date('Y-m-d', strtotime('-30 days')));
        $this->db->where('order_menu.emenu_session_id IS NOT NULL');
        $this->db->group_by('item_foods.ProductsID');
        $this->db->order_by('order_count', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    public function get_order_statistics($days = 30) {
        $this->db->select('DATE(order_date) as date, COUNT(*) as order_count');
        $this->db->from('customer_order');
        $this->db->join('order_menu', 'order_menu.order_id = customer_order.order_id');
        $this->db->where('DATE(order_date) >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->where('order_menu.emenu_session_id IS NOT NULL');
        $this->db->group_by('DATE(order_date)');
        $this->db->order_by('DATE(order_date)', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_revenue_statistics($days = 30) {
        $this->db->select('DATE(bill.bill_date) as date, SUM(bill.bill_amount) as revenue');
        $this->db->from('bill');
        $this->db->join('customer_order', 'customer_order.order_id = bill.order_id');
        $this->db->join('order_menu', 'order_menu.order_id = customer_order.order_id');
        $this->db->where('DATE(bill.bill_date) >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->where('order_menu.emenu_session_id IS NOT NULL');
        $this->db->group_by('DATE(bill.bill_date)');
        $this->db->order_by('DATE(bill.bill_date)', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_peak_hours() {
        $this->db->select('HOUR(order_time) as hour, COUNT(*) as order_count');
        $this->db->from('customer_order');
        $this->db->join('order_menu', 'order_menu.order_id = customer_order.order_id');
        $this->db->where('DATE(order_date)', date('Y-m-d'));
        $this->db->where('order_menu.emenu_session_id IS NOT NULL');
        $this->db->group_by('HOUR(order_time)');
        $this->db->order_by('HOUR(order_time)', 'ASC');
        return $this->db->get()->result();
    }
    
    // Menu Management
    public function get_featured_items($limit = 8) {
        return $this->db->select('item_foods.*, variant.variantid, variant.variantName, variant.price')
                        ->from('item_foods')
                        ->join('variant', 'item_foods.ProductsID = variant.menuid', 'left')
                        ->where('item_foods.special', 1)
                        ->where('item_foods.ProductsIsActive', 1)
                        ->limit($limit)
                        ->get()
                        ->result();
    }
    
    // Cart Management
    public function add_to_cart($item_id, $variant_id, $quantity, $addons, $notes) {
        // Validate stock and availability
        $item = $this->db->get_where('item_foods', array('ProductsID' => $item_id))->row();
        if (!$item || !$item->ProductsIsActive) {
            return array('status' => 'error', 'message' => display('item_not_available'));
        }
        
        // Get session data
        $session_data = $this->session->userdata('emenu_session');
        if (!$session_data) {
            return array('status' => 'error', 'message' => display('session_expired'));
        }
        
        // Add to cart table or session
        $cart_data = array(
            'session_id' => $session_data['id'],
            'item_id' => $item_id,
            'variant_id' => $variant_id,
            'quantity' => $quantity,
            'addons' => $addons ? json_encode($addons) : null,
            'notes' => $notes
        );
        
        // Store in session for now, can be moved to database if needed
        $cart = $this->session->userdata('cart') ?: array();
        $cart[] = $cart_data;
        $this->session->set_userdata('cart', $cart);
        
        return array('status' => 'success', 'message' => display('item_added_to_cart'));
    }
    
    public function get_cart_items() {
        $cart = $this->session->userdata('cart');
        if (!$cart) {
            return array();
        }
        
        $items = array();
        foreach ($cart as $item) {
            $food_item = $this->db->select('item_foods.*, variant.variantName, variant.price')
                                ->from('item_foods')
                                ->join('variant', 'variant.variantid = ' . $item['variant_id'])
                                ->where('item_foods.ProductsID', $item['item_id'])
                                ->get()
                                ->row();
                                
            if ($food_item) {
                $food_item->quantity = $item['quantity'];
                $food_item->notes = $item['notes'];
                $food_item->addons = $item['addons'] ? json_decode($item['addons']) : array();
                $items[] = $food_item;
            }
        }
        
        return $items;
    }
    
    // Order Processing
    public function place_order($session_data) {
        $cart_items = $this->get_cart_items();
        if (empty($cart_items)) {
            return array('status' => 'error', 'message' => display('cart_empty'));
        }
        
        $this->db->trans_start();
        
        try {
            // Create customer order
            $order_data = array(
                'customer_id' => $session_data['customer_id'],
                'cutomertype' => 1, // Regular customer
                'table_no' => $session_data['table_id'],
                'order_date' => date('Y-m-d'),
                'order_time' => date('H:i:s'),
                'totalamount' => 0, // Will be updated after adding items
                'order_status' => 1 // Pending
            );
            
            $this->db->insert('customer_order', $order_data);
            $order_id = $this->db->insert_id();
            
            $total_amount = 0;
            
            // Add order items
            foreach ($cart_items as $item) {
                $order_menu_data = array(
                    'order_id' => $order_id,
                    'menu_id' => $item->ProductsID,
                    'menuqty' => $item->quantity,
                    'price' => $item->price,
                    'varientid' => $item->variantid,
                    'add_on_id' => $item->addons ? implode(',', $item->addons) : '',
                    'notes' => $item->notes,
                    'emenu_session_id' => $session_data['id']
                );
                
                $this->db->insert('order_menu', $order_menu_data);
                $total_amount += ($item->price * $item->quantity);
            }
            
            // Update total amount
            $this->db->where('order_id', $order_id)
                    ->update('customer_order', array('totalamount' => $total_amount));
            
            // Clear cart
            $this->session->unset_userdata('cart');
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                return array('status' => 'error', 'message' => display('order_failed'));
            }
            
            return array('status' => 'success', 'order_id' => $order_id);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return array('status' => 'error', 'message' => $e->getMessage());
        }
    }
}