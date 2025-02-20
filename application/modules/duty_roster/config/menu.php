<?php

$HmvcMenu["duty_roster"] = array(
    //set icon
    "icon"           => "<i class='ti-calendar' ></i>
", 
//group level name<i class="fas fa-calendar-alt"></i>

    'attendance_dashboard'    => array(
        "controller" => "Shift_management",
        "method"     => "attendance_dashboard",
        "url"        => "duty_roster/attendance-dashboard",
        "permission" => "read"
    ), 
    'shift_assign'    => array(
        "controller" => "Shift_management",
        "method"     => "shift_assign_list",
        "url"        => "duty_roster/shift-assign",
        "permission" => "read"
    ), 
    'shift_list'  => array( 
        "controller" => "Shift_management",
        "method"     => "index",
        "url"        => "duty_roster/shift-list",
        "permission" => "read"
    ), 
    'roster_list'  => array( 
        "controller" => "Shift_management",
        "method"     => "roster_list",
        "url"        => "duty_roster/create-roster",
        "permission" => "read"
    ), 
    
);
   

 