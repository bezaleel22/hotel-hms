<?php

// module name
$HmvcMenu["transport_facility"] = array(
    //set icon
    "icon"           => "<i class='ti-car'></i>
", 
//group level name 

    "flight_details_list" => array(
        //menu name
            "controller" => "transport_setting",
            "method"     => "index",
            "url"        => "transport_facility/flight-list",
            "permission" => "read"
        
    ),
    "vehicle_details_list" => array(
        //menu name
            "controller" => "transport_setting",
            "method"     => "index",
            "url"        => "transport_facility/vehicle-list",
            "permission" => "read"
        
    ),
    "vehicle_booking_list" => array(
        //menu name
            "controller" => "transport_setting",
            "method"     => "index",
            "url"        => "transport_facility/vehicle-booking-list",
            "permission" => "read"
        
    )
    
    
);
   

 