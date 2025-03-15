<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Welcome to Hotel Management System';
        $this->load->view('welcome_view', $data);
    }
}