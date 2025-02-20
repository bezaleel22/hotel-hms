<?php
// module directory name
$HmvcConfig['house_keeping']["_title"]     = "House Keeping";
$HmvcConfig['house_keeping']["_description"] = "House keeping module provides room service, laundry service and it also has house keeping android app for managing room cleanig with QR code ";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['house_keeping']['_database'] = true;
$HmvcConfig['house_keeping']['_version'] = 1.0;
$HmvcConfig['house_keeping']["_tables"] = array( 
	'tbl_housekeepingrecord',
	'tbl_checklist',
	'tbl_laundry',
	'tbl_hkitem',
	'tbl_laundry_payment'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['house_keeping']["_extra_query"] = true;