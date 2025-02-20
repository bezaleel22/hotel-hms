CREATE TABLE `tbl_hallroom_booking` (
  `hbid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `booked_id` varchar(100) DEFAULT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `event_type` varchar(100) DEFAULT NULL,
  `hall_type` varchar(100) DEFAULT NULL,
  `hall_no` varchar(100) DEFAULT NULL,
  `total_room` int(11) DEFAULT 1,
  `rent` varchar(100) DEFAULT NULL,
  `totalamount` decimal(10,2) DEFAULT 0.00,
  `paid_amount` decimal(10,2) DEFAULT 0.00,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `people` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=booked, 2=completed, 3=cancelled',
  `payment_status` int(11) NOT NULL DEFAULT 0 COMMENT '1=paid, 2=partialy paid, 0=unpaid, 3=refunded',
  `seatplan` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `advance_remarks` text DEFAULT NULL,
  PRIMARY KEY (`hbid`),
  KEY `customerid` (`customerid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE latin1_general_ci;

CREATE TABLE `tbl_hallroom_postbill` (
  `hpbid` int(11) NOT NULL AUTO_INCREMENT,
  `hrbooking` int(11) NOT NULL,
  `taxname` varchar(100) DEFAULT NULL,
  `taxrate` varchar(100) DEFAULT NULL,
  `scharge` varchar(100) DEFAULT NULL,
  `refund_charge` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`hpbid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE latin1_general_ci;

CREATE TABLE `tbl_hallroom_info` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `hall_type` varchar(100) DEFAULT NULL,
  `person_limit` int(11) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT 0.00,
  `size` varchar(100) DEFAULT NULL,
  `mesurement` varchar(100) DEFAULT NULL,
  `seatplan` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE latin1_general_ci;

CREATE TABLE `tbl_hallroom_seatplan` (
  `hsid` int(11) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`hsid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE latin1_general_ci;

