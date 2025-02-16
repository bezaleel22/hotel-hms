<?php

// module name
$HmvcMenu["ordermanage"] = array(
    //set icon
    "icon"           => "<i class='fab fa-first-order' aria-hidden='true'></i>
    ", 


    "pos_invoice"    => array( 
        "controller" => "order",
        "method"     => "pos_invoice",
        "url"        =>"ordermanage/pos-invoice",
        "permission" => "read"
    ),
    "order_list"     => array( 
        "controller" => "order",
        "method"     => "orderlist",
        "url"        =>"ordermanage/order-list",
        "permission" => "read"
    ),
    "pending_order"  => array( 
        "controller" => "order",
        "method"     => "pendingorder",
        "url"        =>"ordermanage/pending-order",
        "permission" => "read"
    ),
    "complete_order" => array( 
        "controller" => "order",
        "method"     => "completelist",
        "url"        =>"ordermanage/complete-list",
        "permission" => "read"
    ),
    "cancel_order"   => array( 
        "controller" => "order",
        "method"     => "cancellist",
        "url"        =>"ordermanage/cancel-list",
        "permission" => "read"
    ),
   
    "counter_dashboard" => array(
        "controller" => "order",
        "method"     => "counterboard",
        "url"        =>"ordermanage/counter-board",
        "permission" => "read"
        ), 
    
    "pos_setting"    => array(
        "controller" => "order",
        "method"     => "possetting",
        "url"        =>"ordermanage/pos-setting",
        "permission" => "read"
    ),
    "sound_setting"  => array(
        "controller" => "order",
        "method"     => "soundsetting",
        "url"        =>"ordermanage/sound-setting",
        "permission" => "read"

    ),
    "table_manage"       => array(
        "table_list"     => array(
            "controller" => "restauranttable",
            "method"     => "index",
            "url"        =>"ordermanage/table-list",
            "permission" => "read"
        ), 
        
        "table_setting"  => array(
            "controller" => "restauranttable",
            "method"     => "tablesetting",
            "url"        =>"ordermanage/table-setting",
            "permission" => "read"
            )
    ), 
    "customer_type" => array(
       
        "customertype_list" => array(
            "controller"    => "customertype",
            "method"        => "index",
            "url"           =>"ordermanage/customer-type",
            "permission"    => "read"
        ), 
        
        "list_of_card_terminal" => array(
            "controller" => "card_terminal",
            "method"     => "index",
            "url"        =>"ordermanage/card-terminal",
            "permission" => "read"
        ), 
    ),

    //group level name
    "manage_category" => array(
        //menu name
    "add_category" => array(
        //menu name
            "controller" => "item_category",
            "method"     => "create",
            "url"        =>"ordermanage/category-create",
            "permission" => "create"
        
    ), 
    "category_list" => array(
        //menu name
            "controller" => "item_category",
            "method"     => "index",
            "url"        =>"ordermanage/category-list",
            "permission" => "read"
        
    ), 
        
    ),  
    //group level name
    "manage_food" => array(
    "add_food" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "create",
            "url"        =>"ordermanage/food-create",
            "permission" => "create"
    ), 
    "food_list" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "index",
            "url"        =>"ordermanage/food-list",
            "permission" => "read"
        
    ),
    "add_group_item" => array(
        //menu name
        "controller" => "item_food",
        "method"     => "addgroupfood",
        "url"        =>"ordermanage/food-groop-create",
        "permission" => "read"
    ),
    "food_varient" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "foodvarientlist",
            "url"        =>"ordermanage/food-varient-list",
            "permission" => "read"
        
    ), 
    "food_availablity" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "availablelist",
            "url"        =>"ordermanage/food-available-list",
            "permission" => "read"
        
    ),
    "menu_type" => array(
        //menu name
        "controller" => "item_food",
        "method"     => "todaymenutype",
        "url"        =>"ordermanage/today-menu-type",
        "permission" => "read"
    ) 
    ),
    //group level name
    "manage_addons" => array(
    "add_adons" => array(
        //menu name
            "controller" => "menu_addons",
            "method"     => "create",
            "url"        =>"ordermanage/menu-addons-create",
            "permission" => "create"
    ), 
    "addons_list" => array(
        //menu name
            "controller" => "menu_addons",
            "method"     => "index",
            "url"        =>"ordermanage/menu-addons-list",
            "permission" => "read"
        
    ),
    "assign_adons_list" => array(
        //menu name
            "controller" => "menu_addons",
            "method"     => "assignaddons",
            "url"        =>"ordermanage/assign-menu-addons",
            "permission" => "read"
        
    ),    
    ),
    
);