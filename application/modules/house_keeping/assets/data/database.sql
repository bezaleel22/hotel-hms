
CREATE TABLE IF NOT EXISTS `tbl_housekeepingrecord` (
  `hkeeper_id` int(11) NOT NULL AUTO_INCREMENT,
  `assignby` varchar(100) NOT NULL DEFAULT '1',
  `employee_id` text NOT NULL,
  `roomno` int(11) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `createDate` datetime NOT NULL,
  `all_checklist` text DEFAULT NULL,
  `all_productlist` varchar(100) DEFAULT NULL,
  `allproductqty` varchar(100) DEFAULT NULL,
  `status` int(3) NOT NULL COMMENT '0=pending,1=completed,2=under process',
  PRIMARY KEY (`hkeeper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tbl_checklist` (
  `checklist_id` int(11) NOT NULL AUTO_INCREMENT,
  `taskname` text DEFAULT NULL,
  `type` int(3) NOT NULL DEFAULT 1 COMMENT '1=housekeepr,2=laundry',
  `status` int(3) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active',
  PRIMARY KEY (`checklist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tbl_laundry` (
  `laundry_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` text DEFAULT NULL,
  `product_id` varchar(100) NOT NULL,
  `type` text DEFAULT NULL,
  `checklist` text DEFAULT NULL,
  `operate_by` text DEFAULT NULL,
  `quantity` varchar(100) DEFAULT '0',
  `item_cost` varchar(100) DEFAULT NULL,
  `total_cost` decimal(10,0) NOT NULL DEFAULT 0,
  `rec_date` datetime DEFAULT NULL,
  `document` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(3) DEFAULT '0' COMMENT '1=paid,0=unpaid',
  PRIMARY KEY (`laundry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tbl_hkitem` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `checklist` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tbl_laundry_payment` (
  `landry_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`landry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

