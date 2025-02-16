<?php
$HmvcConfig['ordermanage']["_title"]     = "Restaurent Module";
$HmvcConfig['ordermanage']["_description"] = "This is a POS system. Using this module you can manage a restaurent and order food for In house customer, outside customer and old customer.";
$HmvcConfig['ordermanage']["_version"]   = 1.0;

$HmvcConfig['ordermanage']['_database'] = true;
$HmvcConfig['ordermanage']["_tables"] = array( 
	'item_category','tbl_kitchen','accesslog','item_foods','foodvariable','tax_settings','tbl_menutype','add_ons','menu_add_on','tbl_groupitems','customer_type','tbl_thirdparty_customer','tbl_bank','tbl_card_terminal','rest_table','tbl_posetting','bill','bill_card_payment','check_addones','customer_order','membership','multipay_bill','order_menu','sub_order','table_details','tbl_assign_kitchen','tbl_kitchen_order','tbl_cancelitem','tbl_orderprepare','tbl_quickordersetting','tbl_soundsetting','tbl_updateitems','tbl_tablefloor','tbl_itemaccepted','tbl_shippingaddress','variant','table_setting'
);

$HmvcConfig['ordermanage']["_extra_query"] = true;