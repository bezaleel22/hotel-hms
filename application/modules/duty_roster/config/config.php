<?php
// module directory name
$HmvcConfig['duty_roster']["_title"]       = "Duty Roster";
$HmvcConfig['duty_roster']["_description"] = "Manage your hotel employee's shift time which are assigned in different position and different time and get employee list which are assigned in current roster";
$HmvcConfig['duty_roster']["_version"]   = 1.0;

// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['duty_roster']['_database'] = true;
$HmvcConfig['duty_roster']["_tables"] = array( 
	'tbl_empwork_shift','tbl_emproster_assign','tbl_duty_roster'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['duty_roster']["_extra_query"] = true;