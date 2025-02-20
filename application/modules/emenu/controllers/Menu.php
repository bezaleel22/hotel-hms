<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('emenu_model');
        $this->load->model('qr_model');
        $this->load->model('ordermanage/order_model');
        $this->load->model('ordermanage/category_model');
    }
    
    // Main menu view
    public function index($table_id = null, $token = null) {
        // Validate QR code access
        if (!$this->qr_model->validate_table_access($table_id, $token)) {
            $data['title'] = display('invalid_qr');
            $data['module'] = "emenu";
            $data['page'] = "menu/error";
            $data['message'] = display('invalid_or_expired_qr');
            echo Modules::run('template/menu_layout', $data);
            return;
        }
        
        // Create or get session
        $session_data = $this->qr_model->get_or_create_session($table_id);
        if (!$session_data) {
            $data['title'] = display('error');
            $data['module'] = "emenu";
            $data['page'] = "menu/error";
            $data['message'] = display('session_creation_failed');
            echo Modules::run('template/menu_layout', $data);
            return;
        }
        
        // Set session data
        $this->session->set_userdata('emenu_session', $session_data);
        
        $data['title'] = display('menu');
        $data['module'] = "emenu";
        $data['page'] = "menu/index";
        
        // Get categories and featured items
        $data['categories'] = $this->category_model->cat_view();
        $data['featured_items'] = $this->emenu_model->get_featured_items();
        $data['settings'] = $this->emenu_model->get_settings();
        
        echo Modules::run('template/menu_layout', $data);
    }
    
    // Category view
    public function category($category_id) {
        // Check session
        if (!$this->_check_session()) {
            redirect('menu/session-expired');
        }
        
        $data['title'] = display('menu_items');
        $data['module'] = "emenu";
        $data['page'] = "menu/category";
        
        // Get items by category
        $data['category'] = $this->category_model->findById($category_id);
        $data['items'] = $this->order_model->findById($category_id);
        $data['settings'] = $this->emenu_model->get_settings();
        
        echo Modules::run('template/menu_layout', $data);
    }
    
    // Item details
    public function item($item_id) {
        // Check session
        if (!$this->_check_session()) {
            redirect('menu/session-expired');
        }
        
        $data['title'] = display('item_details');
        $data['module'] = "emenu";
        $data['page'] = "menu/item";
        
        // Get item details and addons
        $data['item'] = $this->order_model->getiteminfo($item_id);
        $data['variants'] = $this->order_model->findByvmenuId($item_id);
        $data['addons'] = $this->order_model->findaddons($item_id);
        
        echo Modules::run('template/menu_layout', $data);
    }
    
    // Add to cart (AJAX)
    public function add_to_cart() {
        // Check session
        if (!$this->_check_session()) {
            echo json_encode(['status' => 'error', 'message' => display('session_expired')]);
            return;
        }
        
        $item_id = $this->input->post('item_id');
        $variant_id = $this->input->post('variant_id');
        $quantity = $this->input->post('quantity');
        $addons = $this->input->post('addons');
        $notes = $this->input->post('notes');
        
        $result = $this->emenu_model->add_to_cart($item_id, $variant_id, $quantity, $addons, $notes);
        
        echo json_encode($result);
    }
    
    // View cart
    public function cart() {
        // Check session
        if (!$this->_check_session()) {
            redirect('menu/session-expired');
        }
        
        $data['title'] = display('cart');
        $data['module'] = "emenu";
        $data['page'] = "menu/cart";
        
        $data['cart_items'] = $this->emenu_model->get_cart_items();
        $data['settings'] = $this->emenu_model->get_settings();
        
        echo Modules::run('template/menu_layout', $data);
    }
    
    // Place order
    public function place_order() {
        // Check session
        if (!$this->_check_session()) {
            redirect('menu/session-expired');
        }
        
        $session_data = $this->session->userdata('emenu_session');
        $result = $this->emenu_model->place_order($session_data);
        
        if ($result['status'] === 'success') {
            redirect('menu/order-success/' . $result['order_id']);
        } else {
            $this->session->set_flashdata('error', $result['message']);
            redirect('menu/cart');
        }
    }
    
    // Order success
    public function order_success($order_id) {
        $data['title'] = display('order_placed');
        $data['module'] = "emenu";
        $data['page'] = "menu/order_success";
        
        $data['order'] = $this->order_model->uniqe_order_id($order_id);
        
        echo Modules::run('template/menu_layout', $data);
    }
    
    // Session expired page
    public function session_expired() {
        $data['title'] = display('session_expired');
        $data['module'] = "emenu";
        $data['page'] = "menu/session_expired";
        
        echo Modules::run('template/menu_layout', $data);
    }
    
    // Private method to check session
    private function _check_session() {
        $session_data = $this->session->userdata('emenu_session');
        if (!$session_data) {
            return false;
        }
        
        return $this->qr_model->validate_session($session_data);
    }
}