<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// E-Menu Module Configuration
$HmvcConfig['emenu']["_title"] = "E-Menu System";
$HmvcConfig['emenu']["_description"] = "Modern web-based menu system with QR code integration";
$HmvcConfig['emenu']["_version"] = 1.0;

// Database configuration
$HmvcConfig['emenu']['_database'] = true;
$HmvcConfig['emenu']["_extra_query"] = true;
$HmvcConfig['emenu']["_tables"] = array(
    'tbl_emenu_config',
    'emenu_qr_tables',
    'emenu_sessions'
);