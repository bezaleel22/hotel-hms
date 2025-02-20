<?php
// module directory name
$HmvcConfig['pool_booking']["_title"]       = "Pool Booking";
$HmvcConfig['pool_booking']["_description"] = "Manage your hotel swimming pool by Pool Booking System for in house and outside cusatomer and also for old customer.";
$HmvcConfig['pool_booking']["_version"]   = 1.0;

// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['pool_booking']['_database'] = true;
$HmvcConfig['pool_booking']["_tables"] = array( 
	'tbl_pool_booking','tbl_pool_type','tbl_swimming_pool','tbl_pool_image','tbl_pool_bookingitem','tbl_pool_package'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['pool_booking']["_extra_query"] = true;