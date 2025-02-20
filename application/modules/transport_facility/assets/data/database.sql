CREATE TABLE IF NOT EXISTS `tbl_vehicle_booking` (
  `vbkid` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `transportation_type` varchar(50) NOT NULL,
  `transportation_time` datetime NOT NULL,
  `driver_id` varchar(50) NOT NULL,
  PRIMARY KEY (`vbkid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_vehicle_details` (
  `vdsid` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_number` varchar(100) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `fuel_type` varchar(50) DEFAULT NULL,
  `seat_capacity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vdsid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_flight_details` (
  `flyid` int(11) NOT NULL AUTO_INCREMENT,
  `flight_num` varchar(100) NOT NULL,
  `airlience_name` varchar(100) DEFAULT NULL,
  `departure` datetime NOT NULL,
  `arrival` datetime NOT NULL,
  `fly_from` varchar(100) DEFAULT NULL,
  `fly_to` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`flyid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;