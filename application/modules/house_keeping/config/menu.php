<?php

// module name
$HmvcMenu["house_keeping"] = array(
    //set icon
    "icon"           => "<i class='ti-brush'></i>
", 
//group level name
    "assign_room_cleaning" => array(
        //menu name
            "controller" => "house_keeping",
            "method"     => "assign_room_cleaning",
            "url"        => "house_keeping/assign-room-cleaning",
            "permission" => "read"
        
    ),
    "room_cleaning" => array(
        //menu name
            "controller" => "house_keeping",
            "method"     => "room_cleaning",
            "url"        => "house_keeping/room-cleaning",
            "permission" => "read"
        
    ),
);
   

 