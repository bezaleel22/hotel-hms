<?php
// module directory name
$HmvcConfig['transport_facility']["_title"]       = "Transport Facility";
$HmvcConfig['transport_facility']["_description"] = "Pick up and drop off Customer From airport To hotel or hotel to airport based on customer openion.";
$HmvcConfig['transport_facility']["_version"]   = 1.0;

// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['transport_facility']['_database'] = true;
$HmvcConfig['transport_facility']["_tables"] = array( 
	'tbl_vehicle_booking','tbl_vehicle_details','tbl_flight_details'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['transport_facility']["_extra_query"] = true;