<?php

// module name
$HmvcMenu["pool_booking"] = array(
    //set icon
    "icon"           => "<i class='typcn typcn-waves'></i>
", 
//group level name 

    "pool_booking_list" => array(
        //menu name
            "controller" => "pool_setting",
            "method"     => "index",
            "url"        => "pool_booking/booking-list",
            "permission" => "read"
        
    ),
    "pool_package" => array(
        //menu name
            "controller" => "pool_setting",
            "method"     => "pool_package",
            "url"        => "pool_booking/pool-package",
            "permission" => "read"
        
    ),
    "pool_type" => array(
        //menu name
            "controller" => "pool_setting",
            "method"     => "pool_type",
            "url"        => "pool_booking/pool-type",
            "permission" => "read"
        
    ),
    "swimming_pool" => array(
        //menu name
            "controller" => "pool_setting",
            "method"     => "swimming_pool",
            "url"        => "pool_booking/swimming-pool",
            "permission" => "read"
        
    ),
    "pool_img" => array(
        //menu name
            "controller" => "pool_setting",
            "method"     => "pool_img",
            "url"        => "pool_booking/pool-image",
            "permission" => "read"
        
    ),
    
);
   

 