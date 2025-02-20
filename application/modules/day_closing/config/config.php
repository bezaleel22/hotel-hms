<?php

// module directory name
$HmvcConfig['day_closing']["_title"]       = "Day Closing";
$HmvcConfig['day_closing']["_description"] = "Close specific users cash based on their counter";
$HmvcConfig['day_closing']["_version"]   = 1.0;


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['day_closing']['_database'] = true;
$HmvcConfig['day_closing']["_tables"] = array(
	'tbl_cashregister','tbl_cashcounter'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['day_closing']["_extra_query"] = true;


