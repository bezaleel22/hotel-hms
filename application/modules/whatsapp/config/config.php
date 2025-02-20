<?php

// module directory name
$HmvcConfig['whatsapp']["_title"]       = "WhatsApp";
$HmvcConfig['whatsapp']["_description"] = "WhatsApp Chat & Booking";
$HmvcConfig['whatsapp']["_version"]     = 1.0;



// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['whatsapp']['_database'] = true;
$HmvcConfig['whatsapp']["_tables"] = array(
	'whatsapp_settings'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['whatsapp']["_extra_query"] = true;


