<?php

// module name
$HmvcMenu2["hall_room"] = array(
    //set icon
    "icon"           => "<i class='ti-blackboard'></i>
", 
 //group level name
     "hallroom_booking" => array(
        //menu name
            "controller" => "Hallroom",
            "method"     => "index",
            "url"        => "hall_room/hallroom-booking",
            "permission" => "read"
        
    ),
     "hallroom_status" => array(
        //menu name
            "controller" => "Hallroom",
            "method"     => "hallroom_status",
            "url"        => "hall_room/hallroom-status",
            "permission" => "read"
        
    ),
     "hallroom_type" => array(
        //menu name
            "controller" => "Hallroom",
            "method"     => "hallroom_type",
            "url"        => "hall_room/hallroom-type",
            "permission" => "read"
        
    ),
     "hallroom_assign" => array(
        //menu name
            "controller" => "Hallroom",
            "method"     => "hallroom_assign",
            "url"        => "hall_room/hallroom-assign",
            "permission" => "read"
        
    ),
     "hallroom_facility" => array(
        //menu name
            "controller" => "Hallroom",
            "method"     => "hallroom_facility",
            "url"        => "hall_room/hallroom-facility",
            "permission" => "read"
        
    ),
     "seatplan" => array(
        //menu name
            "controller" => "Hallroom",
            "method"     => "seatplan",
            "url"        => "hall_room/seatplan",
            "permission" => "read"
        
    ),
     "report" => array(
        //menu name
            "controller" => "Hallroom",
            "method"     => "report",
            "url"        => "hall_room/report",
            "permission" => "read"
        
    ),
);
   

 