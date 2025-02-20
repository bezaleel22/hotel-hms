CREATE TABLE `tbl_empwork_shift` (
  `shiftid` int(11) NOT NULL AUTO_INCREMENT,
  `shift_name` varchar(255) NOT NULL,
  `shift_start` text NOT NULL,
  `shift_end` text NOT NULL,
  `shift_duration` text NOT NULL,
  PRIMARY KEY (`shiftid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE  `tbl_emproster_assign` (
  `sftasnid` int(11) NOT NULL AUTO_INCREMENT,
  `roster_id` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `emp_startroster_date` text NOT NULL,
  `emp_endroster_date` text NOT NULL,
  `emp_startroster_time` text NOT NULL,
  `emp_endroster_time` text NOT NULL,
  `is_complete` int(11) NOT NULL DEFAULT 0 COMMENT '1 = attend, 2 = leave, 3=absent',
  `is_edited` int(11) DEFAULT 0 COMMENT '1 = Edited 0 = not edited',
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`sftasnid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_duty_roster` (
  `roster_id` int(11) NOT NULL AUTO_INCREMENT,
  `rostentry_id` text NOT NULL,
  `shift_id` int(11) NOT NULL,
  `roster_start` varchar(100) NOT NULL,
  `roster_end` varchar(100) NOT NULL,
  `roster_dsys` int(11) NOT NULL,
  PRIMARY KEY (`roster_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
