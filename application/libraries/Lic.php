<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lic {
    private $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    // Basic license validation method
    public function validate() {
        return true; // Basic implementation
    }
}