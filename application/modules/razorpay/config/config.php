<?php

// module directory name
$HmvcConfig['razorpay']["_title"]       = "Razorpay";
$HmvcConfig['razorpay']["_description"] = "Razorpay payment gateway";
$HmvcConfig['razorpay']["_version"]   = 1.0;


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['razorpay']['_database'] = true;
$HmvcConfig['razorpay']["_tables"] = array(
	'tbl_razorpay'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['razorpay']["_extra_query"] = true;


