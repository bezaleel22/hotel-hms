<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// E-Menu Module Menu Configuration
$HmvcMenu["emenu"] = array(
    "icon" => "<i class='fa fa-qrcode'></i>",
    
    // Main Dashboard
    "dashboard" => array(
        "controller" => "emenu",
        "method" => "index",
        "url" => "emenu/dashboard",
        "permission" => "read"
    ),
    
    // QR Code Management
    "qr_management" => array(
        "controller" => "emenu",
        "method" => "qr_management",
        "url" => "emenu/qr-management",
        "permission" => "read"
    ),

    // Menu Settings group
    "menu_settings" => array(
        "controller" => "emenu",
        "method" => "settings",
        "permission" => "read",
        "sub_menu" => array(
            "general_settings" => array(
                "controller" => "emenu",
                "method" => "settings",
                "url" => "emenu/settings",
                "permission" => "read"
            ),
            "appearance" => array(
                "controller" => "emenu",
                "method" => "appearance",
                "url" => "emenu/appearance",
                "permission" => "read"
            ),
            "menu_display" => array(
                "controller" => "emenu",
                "method" => "menu_display",
                "url" => "emenu/menu-display",
                "permission" => "read"
            )
        )
    ),

    // Analytics
    "analytics" => array(
        "controller" => "emenu",
        "method" => "analytics",
        "url" => "emenu/analytics",
        "permission" => "read"
    )
);