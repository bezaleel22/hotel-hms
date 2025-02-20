<?php
// module directory name
$HmvcConfig['hall_room']["_title"]     = "Hall room";
$HmvcConfig['hall_room']["_description"] = "Hall room reservation";
$HmvcConfig['hall_room']["_version"]   = 1.0;

// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['hall_room']['_database'] = true;
$HmvcConfig['hall_room']["_tables"] = array( 
	'tbl_hallroom_booking',
	'tbl_hallroom_postbill',
	'tbl_hallroom_info',
	'tbl_hallroom_seatplan'
);

$HmvcConfig['hall_room']["_extra_query"] = true;