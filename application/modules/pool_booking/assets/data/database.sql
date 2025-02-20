CREATE TABLE `tbl_pool_booking` (
  `pbookingid` int(11) NOT NULL AUTO_INCREMENT,
  `poolbooking_number` varchar(100) NOT NULL,
  `custid` int(11) NOT NULL,
  `packageid` int(11) NOT NULL,
  `deducedamount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 - paid 2 - not paid 3 - cancle order',
  `paid_amount` double(10,2) DEFAULT NULL,
  `entrydate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pbookingid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `tbl_pool_type` (
  `potyid` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(250) NOT NULL,
  PRIMARY KEY (`potyid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_swimming_pool` (
  `poolid` int(11) NOT NULL AUTO_INCREMENT,
  `poolname` varchar(250) NOT NULL,
  `pooltype` varchar(250) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - inactive 1-active 2-undermaintainence 3 - booked',
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`poolid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `tbl_pool_image` (
  `pool_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `pool_id` int(11) NOT NULL,
  `poolimg_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`pool_img_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `tbl_pool_bookingitem` (
  `poolitemid` int(11) NOT NULL AUTO_INCREMENT,
  `pbokingid` int(11) NOT NULL,
  `packageid` int(11) NOT NULL,
  `perprice` double(10,2) NOT NULL,
  `itemqty` int(11) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `entrydate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`poolitemid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_pool_package` (
  `packageid` int(11) NOT NULL AUTO_INCREMENT,
  `poolid` int(11) NOT NULL,
  `package_name` varchar(250) NOT NULL,
  `datetime_from` varchar(250) NOT NULL,
  `datetime_to` varchar(250) NOT NULL,
  `price` double(10,2) NOT NULL,
  `status` int(11) DEFAULT 0 COMMENT '1-active 0 - inactive',
  `details` text DEFAULT NULL,
  `packageimage` text DEFAULT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;