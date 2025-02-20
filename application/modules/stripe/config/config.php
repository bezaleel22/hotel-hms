<?php

// module directory name
$HmvcConfig['stripe']["_title"]       = "Stripe";
$HmvcConfig['stripe']["_description"] = "Stripe payment gateway";
$HmvcConfig['stripe']["_version"]   = 1.0;


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['stripe']['_database'] = true;
$HmvcConfig['stripe']["_tables"] = array(
	'tbl_stripe'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['stripe']["_extra_query"] = true;


