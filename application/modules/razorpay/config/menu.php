<?php 
$HmvcMenu["razorpay"] = array(
    "icon"           => "<i class='ti-tablet'></i>
", 
    "paymentmethod_list" => array(
            "controller" => "paymentmethod",
            "method"     => "index",
            "url"        => "payment_setting/payment-method-list",
            "permission" => "read"
        
    ),
);