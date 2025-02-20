<?php 
$HmvcMenu2["day_closing"] = array(
    "icon"           => "<i class='ti-close'></i>
", 
    "counterlist" => array(
            "controller" => "cashregister",
            "method"     => "counterlist",
            "url"        => "day_closing/cashregister/counterlist",
            "permission" => "read"
        
    ),
    "report" => array(
            "controller" => "cashregister",
            "method"     => "cashregisterlist",
            "url"        => "day_closing/cashregister/cashregisterlist",
            "permission" => "read"
        
    ),
);