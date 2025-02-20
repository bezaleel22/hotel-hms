<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emenu extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('emenu_model');
        $this->load->model('qr_model');
        
        // Check if logged in
        if (!$this->session->userdata('isLogIn')) {
            redirect('login');
        }
    }
    
    // Dashboard view
    public function index() {
        $data['title'] = display('menu_dashboard');
        $data['module'] = "emenu";
        $data['page'] = "admin/dashboard";
        
        // Get dashboard statistics
        $data['active_sessions'] = $this->emenu_model->count_active_sessions();
        $data['total_orders'] = $this->emenu_model->count_today_orders();
        $data['popular_items'] = $this->emenu_model->get_popular_items();
        
        echo Modules::run('template/layout', $data);
    }
    
    // QR code management
    public function qr_management() {
        $data['title'] = display('qr_management');
        $data['module'] = "emenu";
        $data['page'] = "admin/qr_management";
        
        // Get all tables with their QR codes
        $data['tables'] = $this->qr_model->get_all_tables_with_qr();
        
        echo Modules::run('template/layout', $data);
    }
    
    // Generate QR code for table
    public function generate_qr($table_id) {
        $result = $this->qr_model->generate_table_qr($table_id);
        
        if ($result) {
            $this->session->set_flashdata('message', display('qr_generated_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        
        redirect('emenu/qr-management');
    }
    
    // Regenerate QR code
    public function regenerate_qr($table_id) {
        $result = $this->qr_model->regenerate_table_qr($table_id);
        
        if ($result) {
            $this->session->set_flashdata('message', display('qr_regenerated_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        
        redirect('emenu/qr-management');
    }
    
    // Module settings
    public function settings() {
        $data['title'] = display('general_settings');
        $data['module'] = "emenu";
        $data['page'] = "admin/settings";
        
        if ($this->input->post('submit')) {
            $postData = array(
                'theme_primary_color' => $this->input->post('theme_primary_color', true),
                'theme_secondary_color' => $this->input->post('theme_secondary_color', true),
                'enable_dark_mode' => $this->input->post('enable_dark_mode', true),
                'session_timeout' => $this->input->post('session_timeout', true),
                'qr_expiry_hours' => $this->input->post('qr_expiry_hours', true),
                'enable_table_selection' => $this->input->post('enable_table_selection', true),
                'enable_split_bill' => $this->input->post('enable_split_bill', true),
                'enable_reorder' => $this->input->post('enable_reorder', true),
                'menu_items_per_page' => $this->input->post('menu_items_per_page', true)
            );
            
            if ($this->emenu_model->update_settings($postData)) {
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect('emenu/settings');
        }
        
        // Get current settings
        $data['settings'] = $this->emenu_model->get_settings();
        
        echo Modules::run('template/layout', $data);
    }
    
    // Menu appearance settings
    public function appearance() {
        $data['title'] = display('appearance');
        $data['module'] = "emenu";
        $data['page'] = "admin/appearance";
        
        echo Modules::run('template/layout', $data);
    }
    
    // Menu display settings
    public function menu_display() {
        $data['title'] = display('menu_display');
        $data['module'] = "emenu";
        $data['page'] = "admin/menu_display";
        
        echo Modules::run('template/layout', $data);
    }
    
    // Analytics dashboard
    public function analytics() {
        $data['title'] = display('analytics');
        $data['module'] = "emenu";
        $data['page'] = "admin/analytics";
        
        // Get analytics data
        $data['order_stats'] = $this->emenu_model->get_order_statistics();
        $data['revenue_stats'] = $this->emenu_model->get_revenue_statistics();
        $data['peak_hours'] = $this->emenu_model->get_peak_hours();
        
        echo Modules::run('template/layout', $data);
    }
}