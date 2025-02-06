#
# TABLE STRUCTURE FOR: acc_account
#

DROP TABLE IF EXISTS `acc_account`;

CREATE TABLE `acc_account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_name` varchar(255) NOT NULL,
  `sector_type` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date DEFAULT '1970-01-02',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: acc_account_name
#

DROP TABLE IF EXISTS `acc_account_name`;

CREATE TABLE `acc_account_name` (
  `account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) NOT NULL,
  `account_type` int(11) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES (1, 'Employee Salary', 0);
INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES (3, 'Example', 1);
INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES (4, 'Loan Expense', 0);
INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES (5, 'Loan Income', 1);


#
# TABLE STRUCTURE FOR: acc_bank
#

DROP TABLE IF EXISTS `acc_bank`;

CREATE TABLE `acc_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(200) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `opening_credit` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `acc_bank` (`bank_id`, `bank_name`, `branch_name`, `account_number`, `opening_credit`, `status`, `date`) VALUES (1, 'DBBL', 'GUlshan', '110.101.3243', 934875987, 1, '2018-06-14');
INSERT INTO `acc_bank` (`bank_id`, `bank_name`, `branch_name`, `account_number`, `opening_credit`, `status`, `date`) VALUES (2, 'CITY bANK', 'Motijheel', '120324234', 3452324, 1, '2018-06-14');
INSERT INTO `acc_bank` (`bank_id`, `bank_name`, `branch_name`, `account_number`, `opening_credit`, `status`, `date`) VALUES (3, 'Family Bank', 'sonalux', '23456', 0, 1, '2018-08-16');


#
# TABLE STRUCTURE FOR: acc_coa
#

DROP TABLE IF EXISTS `acc_coa`;

CREATE TABLE `acc_coa` (
  `HeadCode` varchar(50) NOT NULL,
  `HeadName` varchar(100) NOT NULL,
  `PHeadName` varchar(50) NOT NULL,
  `HeadLevel` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsTransaction` tinyint(1) NOT NULL,
  `IsGL` tinyint(1) NOT NULL,
  `HeadType` char(1) NOT NULL,
  `IsBudget` tinyint(1) NOT NULL,
  `IsDepreciation` tinyint(1) NOT NULL,
  `DepreciationRate` decimal(18,2) NOT NULL,
  `CreateBy` varchar(50) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateDate` datetime NOT NULL,
  PRIMARY KEY (`HeadName`),
  KEY `HeadCode` (`HeadCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021403', 'AC', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:33:55', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('50202', 'Account Payable', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, '0.00', 'admin', '2015-10-15 19:50:43', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10203', 'Account Receivable', 'Current Asset', 2, 1, 0, 0, 'A', 0, 0, '0.00', '', '0000-00-00 00:00:00', 'admin', '2013-09-18 15:29:35');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020201', 'Advance', 'Advance, Deposit And Pre-payments', 3, 1, 0, 1, 'A', 0, 0, '0.00', 'Zoherul', '2015-05-31 13:29:12', 'admin', '2015-12-31 16:46:32');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102020103', 'Advance House Rent', 'Advance', 4, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-10-02 16:55:38', 'admin', '2016-10-02 16:57:32');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10202', 'Advance, Deposit And Pre-payments', 'Current Asset', 2, 1, 0, 1, 'A', 0, 0, '0.00', '1', '2021-10-02 18:18:36', 'admin', '2015-12-31 16:46:24');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020602', 'Advertisement and Publicity', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:51:44', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010206', 'AIBL', 'Cash At Bank', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-10-06 09:16:58', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010410', 'Air Cooler', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-05-23 12:13:55', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020603', 'AIT Against Advertisement', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:52:09', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1', 'Assets', 'COA', 0, 1, 0, 0, 'A', 0, 0, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010204', 'Attendance Machine', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:49:31', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40216', 'Audit Fee', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, '0.00', 'admin', '2017-07-18 12:54:30', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010202', 'Bank AlFalah', 'Cash At Bank', 4, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:32:37', 'admin', '2015-10-15 15:32:52');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021002', 'Bank Charge', 'Financial Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:21:03', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30203', 'Bank Interest', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, '0.00', 'Obaidul', '2015-01-03 14:49:54', 'admin', '2016-09-25 11:04:19');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010104', 'Book Shelf', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:46:11', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010407', 'Books and Journal', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:45:37', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020604', 'Business Development Expenses', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:52:29', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020606', 'Campaign Expenses', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:52:57', 'admin', '2016-09-19 14:52:48');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020502', 'Campus Rent', 'House Rent', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:46:53', 'admin', '2017-04-27 17:02:39');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40212', 'Car Running Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:28:43', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010304', 'Card Payment', 'Online Payment', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-09-27 11:56:27', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10201', 'Cash & Cash Equivalent', 'Current Asset', 2, 1, 0, 1, 'A', 0, 0, '0.00', '1', '2021-10-02 18:20:00', 'admin', '2015-10-15 15:57:55');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020102', 'Cash At Bank', 'Cash & Cash Equivalent', 3, 1, 0, 1, 'A', 0, 0, '0.00', '1', '2021-10-02 18:19:42', 'admin', '2015-10-15 15:32:42');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020101', 'Cash In Hand', 'Cash & Cash Equivalent', 3, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-10-02 16:18:59', 'admin', '2016-05-23 12:05:43');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30101', 'Cash Sale', 'Store Income', 1, 1, 1, 1, 'I', 0, 0, '0.00', '2', '2018-07-08 07:51:26', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010207', 'CCTV', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:51:24', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102020102', 'CEO Current A/C', 'Advance', 4, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-09-25 11:54:54', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010101', 'Class Room Chair', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:45:29', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021407', 'Close Circuit Cemera', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:35:35', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020601', 'Commision on Admission', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:51:21', 'admin', '2016-09-19 14:42:54');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010206', 'Computer', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:51:09', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021410', 'Computer (R)', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'Zoherul', '2016-03-24 12:38:52', 'Zoherul', '2016-03-24 12:41:40');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010102', 'Computer Table', 'Furniture & Fixturers', 3, 1, 0, 0, 'A', 0, 0, '0.00', '1', '2021-10-24 15:49:49', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('301020401', 'Continuing Registration fee - UoL (Income)', 'Registration Fee (UOL) Income', 4, 1, 1, 0, 'I', 0, 0, '0.00', 'admin', '2015-10-15 17:40:40', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020904', 'Contratuall Staff Salary', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:12:34', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('403', 'Cost of Sale', 'Expense', 0, 1, 1, 0, 'E', 0, 0, '0.00', '2', '2018-07-08 10:37:16', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30102', 'Credit Sale', 'Store Income', 1, 1, 1, 1, 'I', 0, 0, '0.00', '2', '2018-07-08 07:51:34', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020709', 'Cultural Expense', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'nasmud', '2017-04-29 12:45:10', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102', 'Current Asset', 'Assets', 1, 1, 0, 0, 'A', 0, 0, '0.00', '1', '2021-11-09 15:53:24', 'admin', '2018-07-07 11:23:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('502', 'Current Liabilities', 'Liabilities', 1, 1, 0, 0, 'L', 0, 0, '0.00', 'anwarul', '2014-08-30 13:18:20', 'admin', '2015-10-15 19:49:21');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020301', 'Customer Receivable', 'Account Receivable', 3, 1, 0, 1, 'A', 0, 0, '0.00', '2', '2019-01-08 09:15:08', 'admin', '2018-07-07 12:31:42');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40100002', 'cw-Chichawatni', 'Store Expenses', 2, 1, 1, 0, 'E', 0, 0, '0.00', '2', '2018-08-02 16:30:41', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010205', 'DBBL', 'Cash At Bank', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-01-14 07:16:29', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020202', 'Deposit', 'Advance, Deposit And Pre-payments', 3, 1, 0, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:40:42', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020605', 'Design & Printing Expense', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:55:00', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010201', 'Dhaka Bank', 'Cash At Bank', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-01-14 07:02:53', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020404', 'Dish Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:58:21', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40215', 'Dividend', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, '0.00', 'admin', '2016-09-25 14:07:55', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020403', 'Drinking Water Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:58:10', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010211', 'DSLR Camera', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:53:17', 'admin', '2016-01-02 16:23:25');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020908', 'Earned Leave', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:13:38', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020607', 'Education Fair Expenses', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:53:42', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010602', 'Electric Equipment', 'Electrical Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:44:51', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010203', 'Electric Kettle', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:49:07', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10106', 'Electrical Equipment', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:43:44', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020407', 'Electricity Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:59:31', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40201', 'Entertainment', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, '0.00', 'admin', '2013-07-08 16:21:26', 'anwarul', '2013-07-17 14:21:47');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('2', 'Equity', 'COA', 0, 1, 0, 0, 'L', 0, 0, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4', 'Expense', 'COA', 0, 1, 0, 0, 'E', 0, 0, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020903', 'Faculty,Staff Salary & Allowances', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:12:21', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021404', 'Fax Machine', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:34:15', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020905', 'Festival & Incentive Bonus', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:12:48', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010103', 'File Cabinet', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:46:02', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40210', 'Financial Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'anwarul', '2013-08-20 12:24:31', 'admin', '2015-10-15 19:20:36');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010403', 'Fire Extingushier', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:39:32', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021408', 'Furniture', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:35:47', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10101', 'Furniture & Fixturers', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, '0.00', 'anwarul', '2013-08-20 16:18:15', 'anwarul', '2013-08-21 13:35:40');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020406', 'Gas Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:59:20', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('20201', 'General Reserve', 'Reserve & Surplus', 2, 1, 1, 0, 'L', 0, 0, '0.00', 'admin', '2016-09-25 14:07:12', 'admin', '2016-10-02 17:48:49');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10105', 'Generator', 'Non Current Assets', 2, 1, 1, 1, 'A', 0, 0, '0.00', 'Zoherul', '2016-02-27 16:02:35', 'admin', '2016-05-23 12:05:18');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021414', 'Generator Repair', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'Zoherul', '2016-06-16 10:21:05', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40213', 'Generator Running Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:29:29', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10103', 'Groceries and Cutleries', 'Non Current Assets', 2, 1, 1, 1, 'A', 0, 0, '0.00', '2', '2018-07-12 10:02:55', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010408', 'Gym Equipment', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:46:03', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020907', 'Honorarium', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:13:26', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30301', 'Hotel Room Booking', 'Service', 2, 1, 1, 0, 'I', 0, 0, '0.00', '1', '2021-10-02 16:52:00', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40205', 'House Rent', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'anwarul', '2013-08-24 10:26:56', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40100001', 'HP-Hasilpur', 'Academic Expenses', 2, 1, 1, 0, 'E', 0, 0, '0.00', '2', '2018-07-29 03:44:23', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020702', 'HR Recruitment Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2016-09-25 12:55:49', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020703', 'Incentive on Admission', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2016-09-25 12:56:09', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('3', 'Income', 'COA', 0, 1, 0, 0, 'I', 0, 0, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30204', 'Income from Photocopy & Printing', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, '0.00', 'Zoherul', '2015-07-14 10:29:54', 'admin', '2016-09-25 11:04:28');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('5020302', 'Income Tax Payable', 'Liabilities for Expenses', 3, 1, 0, 1, 'L', 0, 0, '0.00', 'admin', '2016-09-19 11:18:17', 'admin', '2016-09-28 13:18:35');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102020302', 'Insurance Premium', 'Prepayment', 4, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-09-19 13:10:57', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021001', 'Interest on Loan', 'Financial Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:20:53', 'admin', '2016-09-19 14:53:34');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020401', 'Internet Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:56:55', 'admin', '2015-10-15 18:57:32');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10107', 'Inventory', 'Non Current Assets', 1, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-10-02 16:45:42', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010210', 'LCD TV', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:52:27', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30103', 'Lease Sale', 'Store Income', 1, 1, 1, 1, 'I', 0, 0, '0.00', '2', '2018-07-08 07:51:52', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('5', 'Liabilities', 'COA', 0, 1, 0, 0, 'L', 0, 0, '0.00', 'admin', '2013-07-04 12:32:07', 'admin', '2015-10-15 19:46:54');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('50203', 'Liabilities for Expenses', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, '0.00', '1', '2021-10-02 17:02:33', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020707', 'Library Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2017-01-10 15:34:54', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021409', 'Lift', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:36:12', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('50101', 'Long Term Borrowing', 'Non Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, '0.00', 'admin', '2013-07-04 12:32:26', 'admin', '2015-10-15 19:47:40');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020608', 'Marketing & Promotion Exp.', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:53:59', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020901', 'Medical Allowance', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:11:33', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010411', 'Metal Ditector', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'Zoherul', '2016-08-22 10:55:22', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021413', 'Micro Oven', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'Zoherul', '2016-05-12 14:53:51', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30202', 'Miscellaneous (Income)', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, '0.00', 'anwarul', '2014-02-06 15:26:31', 'admin', '2016-09-25 11:04:35');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020909', 'Miscellaneous Benifit', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:13:53', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020701', 'Miscellaneous Exp', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2016-09-25 12:54:39', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40207', 'Miscellaneous Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'anwarul', '2014-04-26 16:49:56', 'admin', '2016-09-25 12:54:19');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010401', 'Mobile Phone', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-01-29 10:43:30', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102020101', 'Mr Ashiqur Rahman', 'Advance', 4, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-12-31 16:47:23', 'admin', '2016-09-25 11:55:13');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010212', 'Network Accessories', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-01-02 16:23:32', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020408', 'News Paper Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2016-01-02 15:55:57', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('101', 'Non Current Assets', 'Assets', 1, 1, 0, 1, 'A', 0, 0, '0.00', '1', '2021-10-03 18:21:23', 'admin', '2015-10-15 15:29:11');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('501', 'Non Current Liabilities', 'Liabilities', 1, 1, 0, 0, 'L', 0, 0, '0.00', 'anwarul', '2014-08-30 13:18:20', 'admin', '2015-10-15 19:49:21');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010404', 'Office Decoration', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:40:02', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10102', 'Office Equipment', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, '0.00', 'anwarul', '2013-12-06 18:08:00', 'admin', '2015-10-15 15:48:21');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021401', 'Office Repair & Maintenance', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:33:15', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30201', 'Office Stationary (Income)', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, '0.00', 'anwarul', '2013-07-17 15:21:06', 'admin', '2016-09-25 11:04:50');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020103', 'Online Payment', 'Cash & Cash Equivalent', 3, 1, 0, 1, 'A', 0, 0, '0.00', '1', '2021-10-02 18:20:18', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('402', 'Other Expenses', 'Expense', 1, 1, 0, 1, 'E', 0, 0, '0.00', '1', '2021-10-27 17:56:45', 'admin', '2015-10-15 18:37:42');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('302', 'Other Income', 'Income', 1, 1, 0, 0, 'I', 0, 0, '0.00', '2', '2018-07-07 13:40:57', 'admin', '2016-09-25 11:04:09');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40211', 'Others (Non Academic Expenses)', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'Obaidul', '2014-12-03 16:05:42', 'admin', '2015-10-15 19:22:09');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30205', 'Others (Non-Academic Income)', 'Other Income', 2, 1, 0, 1, 'I', 0, 0, '0.00', 'admin', '2015-10-15 17:23:49', 'admin', '2015-10-15 17:57:52');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('10104', 'Others Assets', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, '0.00', 'admin', '2016-01-29 10:43:16', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020910', 'Outstanding Salary', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'Zoherul', '2016-04-24 11:56:50', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021405', 'Oven', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:34:31', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021412', 'PABX-Repair', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'Zoherul', '2016-04-24 14:40:18', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020902', 'Part-time Staff Salary', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:12:06', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010301', 'Paypal', 'Online Payment', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-01-13 10:02:51', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010202', 'Photocopy & Fax Machine', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:47:27', 'admin', '2016-05-23 12:14:40');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021411', 'Photocopy Machine Repair', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'Zoherul', '2016-04-24 12:40:02', 'admin', '2017-04-27 17:03:17');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('3020503', 'Practical Fee', 'Others (Non-Academic Income)', 3, 1, 1, 1, 'I', 0, 0, '0.00', 'admin', '2017-07-22 18:00:37', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020203', 'Prepayment', 'Advance, Deposit And Pre-payments', 3, 1, 0, 1, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:40:51', 'admin', '2015-12-31 16:49:58');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010201', 'Printer', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:47:15', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40202', 'Printing and Stationary', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, '0.00', 'admin', '2013-07-08 16:21:45', 'admin', '2016-09-19 14:39:32');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('3020502', 'Professional Training Course(Oracal-1)', 'Others (Non-Academic Income)', 3, 1, 1, 0, 'I', 0, 0, '0.00', 'nasim', '2017-06-22 13:28:05', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30207', 'Professional Training Course(Oracal)', 'Other Income', 2, 1, 0, 1, 'I', 0, 0, '0.00', 'nasim', '2017-06-22 13:24:16', 'nasim', '2017-06-22 13:25:56');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010208', 'Projector', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:51:44', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40206', 'Promonational Expence', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'anwarul', '2013-07-11 13:48:57', 'anwarul', '2013-07-17 14:23:03');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40214', 'Repair and Maintenance', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:32:46', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('202', 'Reserve & Surplus', 'Equity', 1, 1, 0, 1, 'L', 0, 0, '0.00', 'admin', '2016-09-25 14:06:34', 'admin', '2016-10-02 17:48:57');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('20102', 'Retained Earnings', 'Share Holders Equity', 2, 1, 1, 1, 'L', 0, 0, '0.00', 'admin', '2016-05-23 11:20:40', 'admin', '2016-09-25 14:05:06');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020708', 'River Cruse', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2017-04-24 15:35:25', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102020105', 'Salary', 'Advance', 4, 1, 0, 1, 'A', 0, 0, '0.00', '1', '2021-10-02 16:20:05', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40209', 'Salary & Allowances', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'anwarul', '2013-12-12 11:22:58', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('404', 'Sale Discount', 'Expense', 1, 1, 1, 0, 'E', 0, 0, '0.00', '2', '2018-07-19 10:15:11', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010406', 'Security Equipment', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:41:30', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('303', 'Service', 'Income', 1, 1, 0, 1, 'I', 0, 0, '0.00', '1', '2021-09-27 11:37:54', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30304', 'Service Charge', 'Service', 2, 1, 1, 0, 'I', 0, 0, '0.00', '1', '2021-10-05 09:42:19', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('20101', 'Share Capital', 'Share Holders Equity', 2, 1, 0, 1, 'L', 0, 0, '0.00', 'anwarul', '2013-12-08 19:37:32', 'admin', '2015-10-15 19:45:35');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('201', 'Share Holders Equity', 'Equity', 1, 1, 0, 0, 'L', 0, 0, '0.00', '', '0000-00-00 00:00:00', 'admin', '2015-10-15 19:43:51');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('50201', 'Short Term Borrowing', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, '0.00', 'admin', '2015-10-15 19:50:30', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40208', 'Software Development Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'anwarul', '2013-11-21 14:13:01', 'admin', '2015-10-15 19:02:51');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020906', 'Special Allowances', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:13:13', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('50102', 'Sponsors Loan', 'Non Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, '0.00', 'admin', '2015-10-15 19:48:02', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020706', 'Sports Expense', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'nasmud', '2016-11-09 13:16:53', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010302', 'SSLCOMMERZ', 'Online Payment', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-01-13 10:04:24', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010203', 'Standard Bank', 'Cash At Bank', 4, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:33:33', 'admin', '2015-10-15 15:33:48');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010204', 'State Bank', 'Cash At Bank', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-01-14 07:22:24', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('401', 'Store Expenses', 'Expense', 1, 1, 0, 0, 'E', 0, 0, '0.00', '2', '2018-07-07 13:38:59', 'admin', '2015-10-15 17:58:46');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('301', 'Store Income', 'Income', 1, 1, 0, 0, 'I', 0, 0, '0.00', '2', '2018-07-07 13:40:37', 'admin', '2015-09-17 17:00:02');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('3020501', 'Students Info. Correction Fee', 'Others (Non-Academic Income)', 3, 1, 1, 0, 'I', 0, 0, '0.00', 'admin', '2015-10-15 17:24:45', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010601', 'Sub Station', 'Electrical Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:44:11', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('5020205', 'Suppliers', 'Account Payable', 3, 1, 0, 1, 'L', 0, 0, '0.00', '2', '2018-12-15 06:50:12', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('5020303', 'TAX Payable', 'Liabilities for Expenses', 3, 1, 1, 0, 'L', 0, 0, '0.00', '1', '2021-10-02 17:03:25', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1020204', 'TAX Receivable', 'Advance, Deposit And Pre-payments', 3, 0, 1, 0, 'A', 0, 0, '0.00', '1', '2021-10-04 12:29:26', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020704', 'TB Care Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2016-10-08 13:03:04', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('30206', 'TB Care Income', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, '0.00', 'admin', '2016-10-08 13:00:56', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020501', 'TDS on House Rent', 'House Rent', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:44:07', 'admin', '2016-09-19 14:40:16');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('502030201', 'TDS Payable House Rent', 'Income Tax Payable', 4, 1, 1, 0, 'L', 0, 0, '0.00', 'admin', '2016-09-19 11:19:42', 'admin', '2016-09-28 13:19:37');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('502030203', 'TDS Payable on Advertisement Bill', 'Income Tax Payable', 4, 1, 1, 0, 'L', 0, 0, '0.00', 'admin', '2016-09-28 13:20:51', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('502030202', 'TDS Payable on Salary', 'Income Tax Payable', 4, 1, 1, 0, 'L', 0, 0, '0.00', 'admin', '2016-09-28 13:20:17', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021402', 'Tea Kettle', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:33:45', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020402', 'Telephone Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:57:59', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010209', 'Telephone Set & PABX', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:51:57', 'admin', '2016-10-02 17:10:40');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40203', 'Travelling & Conveyance', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, '0.00', 'admin', '2013-07-08 16:22:06', 'admin', '2015-10-15 18:45:13');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4021406', 'TV', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 19:35:07', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010205', 'UPS', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:50:38', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('40204', 'Utility Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, '0.00', 'anwarul', '2013-07-11 16:20:24', 'admin', '2016-01-02 15:55:22');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020503', 'VAT on House Rent Exp', 'House Rent', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:49:22', 'admin', '2016-09-25 14:00:52');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('5020301', 'VAT Payable', 'Liabilities for Expenses', 3, 0, 1, 0, 'L', 0, 0, '0.00', '1', '2021-10-28 09:56:55', 'admin', '2016-09-28 13:23:53');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010409', 'Vehicle A/C', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'Zoherul', '2016-05-12 12:13:21', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010405', 'Voltage Stablizer', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-03-27 10:40:59', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010105', 'Waiting Sofa - Steel', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2015-10-15 15:46:29', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102030101', 'Walk in Customer', 'Customer Receivable', 4, 1, 1, 0, 'A', 0, 0, '0.00', '1', '2021-10-02 16:44:50', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020405', 'WASA Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2015-10-15 18:58:51', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('1010402', 'Water Purifier', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, '0.00', 'admin', '2016-01-29 11:14:11', '', '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('4020705', 'Website Development Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', 'admin', '2016-10-15 12:42:47', '', '0000-00-00 00:00:00');


#
# TABLE STRUCTURE FOR: acc_customer_income
#

DROP TABLE IF EXISTS `acc_customer_income`;

CREATE TABLE `acc_customer_income` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_Id` varchar(50) NOT NULL,
  `VNo` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_glsummarybalance
#

DROP TABLE IF EXISTS `acc_glsummarybalance`;

CREATE TABLE `acc_glsummarybalance` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COAID` varchar(50) DEFAULT NULL,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `FYear` int(11) DEFAULT NULL,
  `CreateBy` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_income_expence
#

DROP TABLE IF EXISTS `acc_income_expence`;

CREATE TABLE `acc_income_expence` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VNo` varchar(50) NOT NULL,
  `Vtype` varchar(50) DEFAULT NULL,
  `Date` date NOT NULL,
  `Paymode` varchar(50) NOT NULL,
  `Perpose` varchar(50) DEFAULT NULL,
  `Narration` text DEFAULT NULL,
  `StoreID` int(11) NOT NULL,
  `COAID` varchar(50) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `IsApprove` tinyint(4) NOT NULL,
  `CreateBy` varchar(50) NOT NULL,
  `CreateDate` datetime NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  KEY `VNo` (`VNo`,`IsApprove`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_temp
#

DROP TABLE IF EXISTS `acc_temp`;

CREATE TABLE `acc_temp` (
  `COAID` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Debit` decimal(18,2) NOT NULL,
  `Credit` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_transaction
#

DROP TABLE IF EXISTS `acc_transaction`;

CREATE TABLE `acc_transaction` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Vtype` varchar(50) DEFAULT NULL,
  `VDate` date DEFAULT NULL,
  `COAID` varchar(50) NOT NULL,
  `Narration` text DEFAULT NULL,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `StoreID` int(11) NOT NULL,
  `IsPosted` char(10) DEFAULT NULL,
  `CreateBy` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsAppove` char(10) DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`),
  KEY `COAID` (`COAID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: award
#

DROP TABLE IF EXISTS `award`;

CREATE TABLE `award` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `award_name` varchar(50) NOT NULL,
  `aw_description` varchar(200) NOT NULL,
  `awr_gift_item` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `awarded_by` varchar(30) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: bedstype
#

DROP TABLE IF EXISTS `bedstype`;

CREATE TABLE `bedstype` (
  `Bedstypeid` int(11) NOT NULL AUTO_INCREMENT,
  `bedstypetitle` varchar(255) NOT NULL,
  PRIMARY KEY (`Bedstypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `bedstype` (`Bedstypeid`, `bedstypetitle`) VALUES (12, 'Electric bed');
INSERT INTO `bedstype` (`Bedstypeid`, `bedstypetitle`) VALUES (13, 'Standard Double');
INSERT INTO `bedstype` (`Bedstypeid`, `bedstypetitle`) VALUES (14, 'Queen Bed');
INSERT INTO `bedstype` (`Bedstypeid`, `bedstypetitle`) VALUES (15, 'Olympic Queen');
INSERT INTO `bedstype` (`Bedstypeid`, `bedstypetitle`) VALUES (16, 'King Bed');


#
# TABLE STRUCTURE FOR: booked_details
#

DROP TABLE IF EXISTS `booked_details`;

CREATE TABLE `booked_details` (
  `book_detailsid` int(11) NOT NULL AUTO_INCREMENT,
  `bookedid` int(11) NOT NULL,
  `booking_type` varchar(100) DEFAULT NULL,
  `booking_source` varchar(100) DEFAULT NULL,
  `booking_source_no` varchar(100) DEFAULT NULL,
  `extracheckin` text DEFAULT NULL,
  `extracheckout` text DEFAULT NULL,
  `arival_from` varchar(100) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `extra_facility_days` text DEFAULT NULL,
  `extrabed` text DEFAULT NULL,
  `extraperson` text DEFAULT NULL,
  `extrachild` text DEFAULT NULL,
  `complementary` text DEFAULT NULL,
  `complementaryprice` text DEFAULT NULL,
  `discountreason` text DEFAULT NULL,
  `discountamount` decimal(10,2) DEFAULT NULL,
  `commissionpersent` int(11) DEFAULT NULL,
  `commissionamount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `advance_amount` decimal(10,2) DEFAULT NULL,
  `advance_remarks` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `booked_from` int(11) DEFAULT 0 COMMENT '0=admin,1=user',
  PRIMARY KEY (`book_detailsid`),
  KEY `bookedid` (`bookedid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: booked_info
#

DROP TABLE IF EXISTS `booked_info`;

CREATE TABLE `booked_info` (
  `bookedid` int(11) NOT NULL AUTO_INCREMENT,
  `booking_number` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `roomid` text NOT NULL,
  `nuofpeople` varchar(100) DEFAULT '0',
  `children` text DEFAULT NULL,
  `total_room` int(11) NOT NULL DEFAULT 0,
  `room_no` varchar(45) NOT NULL,
  `roomrate` text DEFAULT NULL,
  `promocode` text DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `offer_discount` varchar(100) NOT NULL DEFAULT '0.00',
  `full_guest_name` text DEFAULT NULL,
  `special_request` text DEFAULT NULL,
  `coments` text DEFAULT NULL,
  `checkindate` datetime NOT NULL,
  `checkoutdate` datetime NOT NULL,
  `cutomerid` int(11) NOT NULL,
  `bookingstatus` varchar(255) NOT NULL COMMENT '0=pending,1=cancel,2=success,3=finish,4=checkin,5=checkout',
  `isSeen` int(11) DEFAULT 0,
  PRIMARY KEY (`bookedid`),
  KEY `cutomerid` (`cutomerid`,`bookingstatus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: bookingtype
#

DROP TABLE IF EXISTS `bookingtype`;

CREATE TABLE `bookingtype` (
  `booktypeid` int(11) NOT NULL AUTO_INCREMENT,
  `booktypetitle` varchar(255) NOT NULL,
  PRIMARY KEY (`booktypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: candidate_basic_info
#

DROP TABLE IF EXISTS `candidate_basic_info`;

CREATE TABLE `candidate_basic_info` (
  `can_id` varchar(20) NOT NULL,
  `first_name` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alter_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `present_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `parmanent_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `picture` text DEFAULT NULL,
  `ssn` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  PRIMARY KEY (`can_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: candidate_education_info
#

DROP TABLE IF EXISTS `candidate_education_info`;

CREATE TABLE `candidate_education_info` (
  `can_edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) NOT NULL,
  `degree_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `university_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cgp` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `comments` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sequencee` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`can_edu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: candidate_interview
#

DROP TABLE IF EXISTS `candidate_interview`;

CREATE TABLE `candidate_interview` (
  `can_int_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `job_adv_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `interview_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `interviewer_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `interview_marks` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `written_total_marks` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mcq_total_marks` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_marks` varchar(30) NOT NULL,
  `recommandation` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `selection` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `details` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`can_int_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: candidate_selection
#

DROP TABLE IF EXISTS `candidate_selection`;

CREATE TABLE `candidate_selection` (
  `can_sel_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pos_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `selection_terms` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`can_sel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: candidate_shortlist
#

DROP TABLE IF EXISTS `candidate_shortlist`;

CREATE TABLE `candidate_shortlist` (
  `can_short_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `job_adv_id` int(11) NOT NULL,
  `date_of_shortlist` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `interview_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`can_short_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: candidate_workexperience
#

DROP TABLE IF EXISTS `candidate_workexperience`;

CREATE TABLE `candidate_workexperience` (
  `can_workexp_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `company_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `duties` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supervisor` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sequencee` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`can_workexp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: common_setting
#

DROP TABLE IF EXISTS `common_setting`;

CREATE TABLE `common_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `login_logo` varchar(50) DEFAULT NULL,
  `footer_logo` varchar(50) DEFAULT NULL,
  `invoice_logo` varchar(50) DEFAULT NULL,
  `powerbytxt` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `common_setting` (`id`, `address`, `email`, `phone`, `logo`, `login_logo`, `footer_logo`, `invoice_logo`, `powerbytxt`) VALUES (1, NULL, '', '', '', '', '', '', 'Powered by bdtask');


#
# TABLE STRUCTURE FOR: currency
#

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `currencyid` int(11) NOT NULL AUTO_INCREMENT,
  `currencyname` varchar(50) NOT NULL,
  `curr_icon` varchar(50) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 1 COMMENT '1=left.2=right',
  `curr_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`currencyid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `currency` (`currencyid`, `currencyname`, `curr_icon`, `position`, `curr_rate`) VALUES (1, 'BDT', '৳', 2, '83.00');
INSERT INTO `currency` (`currencyid`, `currencyname`, `curr_icon`, `position`, `curr_rate`) VALUES (2, 'USD', '$', 1, '1.00');
INSERT INTO `currency` (`currencyid`, `currencyname`, `curr_icon`, `position`, `curr_rate`) VALUES (3, 'Indian Rupee', 'INR', 1, '1.25');


#
# TABLE STRUCTURE FOR: custom_table
#

DROP TABLE IF EXISTS `custom_table`;

CREATE TABLE `custom_table` (
  `custom_id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_field` varchar(100) NOT NULL,
  `custom_data_type` int(11) NOT NULL,
  `custom_data` text NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  PRIMARY KEY (`custom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (9, 'Teacher Name', 2, 'Abdul Halim', 'EF6MQRAX');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (12, 'Primary School', 1, 'Test Primary School', 'E4ZNFBIC');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (13, 'High School Name', 2, 'Taker Hat High school', 'E4ZNFBIC');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (14, 'Versity Name', 3, 'Nu', 'E4ZNFBIC');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (15, 'Company Name', 1, 'Bdtask', 'ER6RJAY8');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (16, 'House Name', 3, 'Shikder Bari', 'ER6RJAY8');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (17, 'Person name', 2, 'Tuhin', 'ER6RJAY8');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (21, 'customfield1', 1, 'custom value1', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (22, 'dsfsdf', 1, 'sdfdsf', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (23, 'dsfsd', 1, 'fdsfsdf', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (24, '', 1, '', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (25, '', 1, '', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (34, 'isahadf', 1, '23424', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (35, 'dfsdf', 1, 'dfgdfg', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (36, 'hhh', 1, 'sdfsdf', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (37, 'fdfgdfg', 1, 'dfg', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (38, 'dfgdfg', 1, '', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (39, 'First isahaq', 1, 'sdfsdf', 'E4K0I0DA');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (40, 'sdfsadf', 1, 'sdfsdf', 'EYOBEEFQ');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (41, 'fsdfsadf', 1, '234234324', 'EHBEEFQQ');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (43, 'My Mother', 1, 'Ma', 'E4Y9T7CJ');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (44, 'rrrr', 2, '07-08-2018', 'E78PIKVA');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (57, 'Chinese Cuisine', 1, 'coffee roastery located on a busy corner site in Farringdon\'s Exmouth Market. With glazed frontage on two sides ', 'EU3APTYY');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (58, 'French Suicine', 1, 'coffee roastery located on a busy corner site in Farringdon\'s Exmouth Market. With glazed frontage on two sides ', 'EXL9WSCL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (59, 'Chinese Cuisine', 1, 'coffee roastery located on a busy corner site in Farringdon\'s Exmouth Market. With glazed frontage on two sides ', 'E3Y1WJMB');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES (60, 'Kitchen Lead', 1, 'coffee roastery located on a busy corner site in Farringdon\'s Exmouth Market. With glazed frontage on two sides ', 'EBK2UPRA');


#
# TABLE STRUCTURE FOR: customerinfo
#

DROP TABLE IF EXISTS `customerinfo`;

CREATE TABLE `customerinfo` (
  `customerid` int(11) NOT NULL AUTO_INCREMENT,
  `customernumber` varchar(100) DEFAULT NULL,
  `membership_type` int(11) DEFAULT NULL COMMENT '1=bronze,2=silver,3=gold,4=platinum,5=vip',
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `fathername` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `isnationality` varchar(100) DEFAULT NULL,
  `pid` text DEFAULT NULL,
  `pitype` text DEFAULT NULL,
  `imgfront` varchar(100) DEFAULT NULL,
  `imgback` varchar(100) DEFAULT NULL,
  `imgguest` varchar(100) DEFAULT NULL,
  `contacttype` text DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `passport` varchar(120) DEFAULT NULL,
  `visano` varchar(80) DEFAULT NULL,
  `purpose` varchar(80) DEFAULT NULL,
  `profileimage` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `anniversary` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `cust_phone` text DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `active` int(255) DEFAULT NULL,
  `password_reset_token` text DEFAULT NULL,
  `signupdate` date DEFAULT NULL,
  PRIMARY KEY (`customerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: dbt_blocklist
#

DROP TABLE IF EXISTS `dbt_blocklist`;

CREATE TABLE `dbt_blocklist` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_mail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: dbt_security
#

DROP TABLE IF EXISTS `dbt_security`;

CREATE TABLE `dbt_security` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(20) NOT NULL,
  `data` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: department
#

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: duty_type
#

DROP TABLE IF EXISTS `duty_type`;

CREATE TABLE `duty_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `duty_type` (`id`, `type_name`) VALUES (1, 'Full Time');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES (2, 'Part Time');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES (3, 'Contructual');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES (4, 'Other');


#
# TABLE STRUCTURE FOR: email_config
#

DROP TABLE IF EXISTS `email_config`;

CREATE TABLE `email_config` (
  `email_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(200) DEFAULT NULL,
  `secure_image` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(200) DEFAULT NULL,
  `smtp_password` varchar(200) DEFAULT NULL,
  `protocol` text NOT NULL,
  `mailpath` text NOT NULL,
  `mailtype` text NOT NULL,
  `sender` text NOT NULL,
  `api_key` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`email_config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `email_config` (`email_config_id`, `smtp_host`, `secure_image`, `smtp_port`, `smtp_password`, `protocol`, `mailpath`, `mailtype`, `sender`, `api_key`, `status`) VALUES (1, 'ssl://smtp.googlemail.com', 'assets/img/2021-01-31/l1.png', '465 ', 'bdtask123', 'ssmtp', '/usr/sbin/sendmail', 'html', 'demo@gmail.com ', '22c4c92a-e5a8-4293-b64c-befc9248521e', 1);


#
# TABLE STRUCTURE FOR: emp_attendance
#

DROP TABLE IF EXISTS `emp_attendance`;

CREATE TABLE `emp_attendance` (
  `att_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sign_in` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sign_out` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `staytime` time DEFAULT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: employee_benifit
#

DROP TABLE IF EXISTS `employee_benifit`;

CREATE TABLE `employee_benifit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bnf_cl_code` varchar(100) NOT NULL,
  `bnf_cl_code_des` varchar(250) NOT NULL,
  `bnff_acural_date` date NOT NULL,
  `bnf_status` tinyint(4) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: employee_history
#

DROP TABLE IF EXISTS `employee_history`;

CREATE TABLE `employee_history` (
  `emp_his_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) NOT NULL,
  `pos_id` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `alter_phone` varchar(30) NOT NULL,
  `present_address` varchar(100) DEFAULT NULL,
  `parmanent_address` varchar(100) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `degree_name` varchar(30) DEFAULT NULL,
  `university_name` varchar(50) DEFAULT NULL,
  `cgp` varchar(30) DEFAULT NULL,
  `passing_year` varchar(30) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `working_period` varchar(30) DEFAULT NULL,
  `duties` varchar(30) DEFAULT NULL,
  `supervisor` varchar(30) DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `is_admin` int(2) NOT NULL DEFAULT 0,
  `dept_id` int(11) DEFAULT NULL,
  `division_id` int(11) NOT NULL,
  `maiden_name` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  `citizenship` int(11) NOT NULL,
  `duty_type` int(11) NOT NULL,
  `hire_date` date NOT NULL,
  `original_hire_date` date NOT NULL,
  `termination_date` date NOT NULL,
  `termination_reason` text NOT NULL,
  `voluntary_termination` int(11) NOT NULL,
  `rehire_date` date NOT NULL,
  `rate_type` int(11) NOT NULL,
  `rate` float NOT NULL,
  `pay_frequency` int(11) NOT NULL,
  `pay_frequency_txt` varchar(50) NOT NULL,
  `hourly_rate2` float NOT NULL,
  `hourly_rate3` float NOT NULL,
  `home_department` varchar(100) NOT NULL,
  `department_text` varchar(100) NOT NULL,
  `class_code` varchar(50) NOT NULL,
  `class_code_desc` varchar(100) NOT NULL,
  `class_acc_date` date NOT NULL,
  `class_status` tinyint(4) NOT NULL,
  `is_super_visor` int(11) DEFAULT NULL,
  `super_visor_id` varchar(30) NOT NULL,
  `supervisor_report` text NOT NULL,
  `dob` date NOT NULL,
  `gender` int(11) NOT NULL,
  `country` varchar(120) DEFAULT NULL,
  `marital_status` int(11) NOT NULL,
  `ethnic_group` varchar(100) NOT NULL,
  `eeo_class_gp` varchar(100) NOT NULL,
  `ssn` varchar(50) NOT NULL,
  `work_in_state` int(11) NOT NULL,
  `live_in_state` int(11) NOT NULL,
  `home_email` varchar(50) NOT NULL,
  `business_email` varchar(50) NOT NULL,
  `home_phone` varchar(30) NOT NULL,
  `business_phone` varchar(30) NOT NULL,
  `cell_phone` varchar(30) NOT NULL,
  `emerg_contct` varchar(30) NOT NULL,
  `emrg_h_phone` varchar(30) NOT NULL,
  `emrg_w_phone` varchar(30) NOT NULL,
  `emgr_contct_relation` varchar(50) NOT NULL,
  `alt_em_contct` varchar(30) NOT NULL,
  `alt_emg_h_phone` varchar(30) NOT NULL,
  `alt_emg_w_phone` varchar(30) NOT NULL,
  PRIMARY KEY (`emp_his_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: employee_performance
#

DROP TABLE IF EXISTS `employee_performance`;

CREATE TABLE `employee_performance` (
  `emp_per_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `note` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `note_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `number_of_star` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`emp_per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: employee_sal_pay_type
#

DROP TABLE IF EXISTS `employee_sal_pay_type`;

CREATE TABLE `employee_sal_pay_type` (
  `emp_sal_pay_type_id` int(11) unsigned NOT NULL,
  `payment_period` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: employee_salary_payment
#

DROP TABLE IF EXISTS `employee_salary_payment`;

CREATE TABLE `employee_salary_payment` (
  `emp_sal_pay_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_salary` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_working_minutes` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment_due` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment_date` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `paid_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`emp_sal_pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: employee_salary_setup
#

DROP TABLE IF EXISTS `employee_salary_setup`;

CREATE TABLE `employee_salary_setup` (
  `e_s_s_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sal_type` varchar(30) NOT NULL,
  `salary_type_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `amount` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gross_salary` float NOT NULL,
  PRIMARY KEY (`e_s_s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: gender
#

DROP TABLE IF EXISTS `gender`;

CREATE TABLE `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `gender` (`id`, `gender_name`) VALUES (1, 'Male');
INSERT INTO `gender` (`id`, `gender_name`) VALUES (2, 'Female');
INSERT INTO `gender` (`id`, `gender_name`) VALUES (3, 'Other');


#
# TABLE STRUCTURE FOR: grand_loan
#

DROP TABLE IF EXISTS `grand_loan`;

CREATE TABLE `grand_loan` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `permission_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `loan_details` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `amount` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `interest_rate` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `installment` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `installment_period` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `repayment_amount` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_of_approve` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `repayment_start_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `loan_status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: job_advertisement
#

DROP TABLE IF EXISTS `job_advertisement`;

CREATE TABLE `job_advertisement` (
  `job_adv_id` int(10) unsigned NOT NULL,
  `pos_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `adv_circular_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `circular_dadeline` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `adv_file` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `adv_details` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` varchar(100) NOT NULL,
  `english` varchar(255) NOT NULL,
  `malay` text DEFAULT NULL,
  `french` text DEFAULT NULL,
  `german` text DEFAULT NULL,
  `spanish` text DEFAULT NULL,
  `turkish` text DEFAULT NULL,
  `hindi` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1849 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1, 'email', 'Email', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (2, 'password', 'Password', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (3, 'login', 'Log In', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (4, 'logout', 'Logout', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (5, 'setting', 'Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (6, 'profile', 'My Profile', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (7, 'dashboard', 'Dashboard', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (8, 'role_permission', 'Role Permission', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (9, 'permission_setup', 'Permission Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (10, 'add_role', 'Assign Role To User', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (11, 'role_list', 'Role List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (12, 'user_access_role', 'User Access Role List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (13, 'add_module_permission', 'Add Module Permission', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (14, 'module_permission_list', 'Module Permission List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (15, 'language', 'Language', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (16, 'application_setting', 'Application Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (17, 'message', 'Message', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (18, 'new', 'New', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (19, 'inbox', 'inbox', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (20, 'sent', 'Sent', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (21, 'user', 'User', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (22, 'add_user', 'Add User', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (23, 'user_list', 'User List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (24, 'reset', 'Reset', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (25, 'save', 'Save', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (26, 'status', 'Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (27, 'lastname', 'Last Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (28, 'firstname', 'First Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (29, 'about', 'About', NULL, NULL, NULL, 'Sobre', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (30, 'save_successfully', 'Save Successfully', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (31, 'please_try_again', 'Please Try Again Later!!!', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (32, 'update_successfully', 'Successfully Updated', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (33, 'admin', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (34, 'are_you_sure', 'Are you sure ?', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (35, 'sl_no', 'SL', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (36, 'image', 'Image', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (37, 'username', 'Username', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (38, 'last_login', 'Last Login', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (39, 'last_logout', 'Last Logout', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (40, 'ip_address', 'Ip Address', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (41, 'action', 'Action', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (42, 'menu_item_list', ' Menu Item List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (43, 'ins_menu_for_application', 'Ins Menu For Application', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (44, 'menu_title', ' Menu Title', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (45, 'page_url', 'Page Url', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (46, 'module', ' Module', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (47, 'parent_menu', 'Parent Menu', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (48, 'role_name', 'Role Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (49, 'description', 'Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (50, 'role', 'Role', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (51, 'add', 'Address', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (52, 'update', 'Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (53, 'application_title', 'Application Title', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (54, 'address', 'Address', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (55, 'phone', 'Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (56, 'favicon', 'Favicon', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (57, 'logo', 'Logo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (59, 'site_align', 'Application Alignment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (60, 'footer_text', 'Footer Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (61, 'left_to_right', 'Left To Right', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (62, 'right_to_left', 'Right To Left', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (63, 'room_facilities', 'Room Facilities', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (64, 'faciliti_list', 'Facility List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (65, 'faciliti_details_list', 'Facility Details List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (66, 'roomsize_list', 'Room Size List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (67, 'add_facility_type', 'Add Facility Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (68, 'add_facility_details', 'Add Facility Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (69, 'facility_name', 'Facility Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (70, 'facility_details_name', 'Facility Details Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (71, 'roomsize_name', 'Room Size Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (72, 'ad', 'Add', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (73, 'add_new', 'Add New', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (74, 'delete_successfully', 'Delete successfully completed', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (75, 'room_size', 'Room Size', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (76, 'room_setting', 'Room Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (77, 'bed_list', 'Bed List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (78, 'starclass_list', 'Star Class List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (79, 'room_list', 'Room List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (80, 'addnew_bed', 'Add New Bed', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (81, 'bed_name', 'Bed Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (82, 'add_class', 'Add Class', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (83, 'class_name', 'Class Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (84, 'bookingtype_list', 'Booking Type List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (85, 'booking_type', 'Booking Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (86, 'rateplan_list', 'Rate Plan List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (87, 'rateplan_name', 'Rate Plan Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (88, 'capacity', 'Capacity', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (89, 'defaultrate', 'Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (90, 'special_rate', 'Special Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (91, 'discount', 'Discount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (92, 'bookingtype', 'Booking Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (93, 'breakfast', 'Breakfast', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (94, 'roomtype', 'Room Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (95, 'roomsize', 'Room Size', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (96, 'size_unit', 'Size Unit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (97, 'bedsno', 'Bed No.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (98, 'bedstype', 'Bed Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (99, 'roomdescription', 'Room Drescription', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (100, 'room_name', 'Room Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (101, 'room_image', 'Room Images', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (102, 'room_booking', 'Room Booking', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (103, 'booking_list', 'Booking List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (104, 'room_reservation', 'Room Reservation', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (105, 'accounts', 'Account', NULL, NULL, NULL, 'Contas', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (106, 'c_o_a', 'Chart of Account', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (107, 'debit_voucher', 'Debit Voucher', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (108, 'credit_voucher', 'Credit Voucher', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (109, 'contra_voucher', 'Contra Voucher', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (110, 'journal_voucher', 'Journal Voucher', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (111, 'voucher_approval', 'Voucher Approval', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (112, 'account_report', 'Account Report', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (113, 'voucher_report', 'Voucher Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (114, 'cash_book', 'Cash Book', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (115, 'bank_book', 'Bank Book', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (116, 'general_ledger', 'General Ledger', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (117, 'trial_balance', 'Trial Balance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (118, 'profit_loss', 'Profit Loss', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (119, 'cash_flow', 'Cash Flow', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (120, 'coa_print', 'Coa Print', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (121, 'in_quantity', 'In Qnty', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (122, 'out_quantity', 'Out Qnty', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (123, 'stock', 'Stock', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (124, 'find', 'Find', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (125, 'from_date', 'From Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (126, 'to_date', 'To Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (127, 'approved', 'Approved', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (128, 'voucher_no', 'Voucher No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (129, 'remark', 'Remark', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (130, 'code', 'Code', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (131, 'debit', 'Debit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (132, 'credit', 'Credit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (133, 'from', 'From', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (134, 'opening_cash_and_equivalent', 'Opening Cash && Equivalent', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (135, 'amount_in_Dollar', 'Amount In Dollar', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (136, 'pre_balance', 'Pre Balance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (137, 'current_balance', 'Current Balance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (138, 'with_details', 'With Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (139, 'credit_account_head', 'Credit Account Head', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (140, 'gl_head', 'GL Head', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (141, 'transaction_head', 'Transaction Head', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (142, 'confirm', 'Confirm', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (143, 's_rate', 'Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (144, 'save', 'Save', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (145, 'add_more', 'Add More', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (146, 'total', 'Total', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (147, 'create', 'Create', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (148, 'read', 'Read', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (149, 'update', 'Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (150, 'delete', 'Delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (151, 'date', 'Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (152, 'notice_by', 'Notice By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (153, 'notice_attachment', 'Attachment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (154, 'account_name', 'Account Name', NULL, NULL, NULL, 'Nome da Conta', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (155, 'account_type', 'Account Type', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (156, 'account_id', 'Account Name', NULL, NULL, NULL, 'Id da Conta', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (157, 'amount', 'Total Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (158, 'debit_account_head', 'Debit Account Head', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (159, 'booking_number', 'Booking Number', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (160, 'check_in', 'Check In', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (161, 'check_out', 'Check Out', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (162, 'booking_date', 'Booking Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (163, 'booking_status', 'Booking Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (164, 'adults', 'Adults', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (165, 'kids', 'Kids', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (166, 'guest', 'Guest Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (167, 'no_of_people', 'No of People', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (168, 'grant', 'Grant', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (169, 'hrm', 'Human Resource', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (170, 'departmentfrm', 'Add Department', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (180, 'benefits', 'Benefits', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (181, 'class', 'Class', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (182, 'biographical_info', 'Biographical Info', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (183, 'additional_address', 'Additional Address', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (184, 'custom', 'Custom', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (185, 'employee_reports', 'Employee Reports', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (186, 'demographic_report', 'Demographic Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (187, 'posting_report', 'Positional Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (188, 'custom_report', 'Custom Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (189, 'benifit_report', 'Benifit Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (190, 'demographic_info', 'Demographical Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (191, 'positional_info', 'Positional Info', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (192, 'assets_info', 'Assets Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (193, 'custom_field', 'Custom Field', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (194, 'custom_value', 'Custom Data', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (195, 'adhoc_report', 'Adhoc Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (196, 'asset_assignment', 'Asset Assignment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (197, 'assign_asset', 'Assign Assets', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (198, 'assign_list', 'Assign List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (199, 'update_assign', 'Update Assign', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (200, 'citizenship', 'Citizenship', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (201, 'class_sta', 'Class status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (202, 'class_acc_date', 'Class Accrual date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (203, 'class_descript', 'Class Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (204, 'class_code', 'Class Code', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (205, 'return_asset', 'Return Assets', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (206, 'dept_id', 'Department ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (207, 'parent_id', 'Parent ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (208, 'equipment_id', 'Equipment ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (209, 'issue_date', 'Issue Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (210, 'damarage_desc', 'Damarage Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (211, 'return_date', 'Return Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (212, 'is_assign', 'Is Assign', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (213, 'emp_his_id', 'Employee History ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (214, 'damarage_descript', 'Damage Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (215, 'award', 'Award', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (216, 'new_award', 'New Award', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (217, 'award_name', 'Award Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (218, 'aw_description', 'Award Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (219, 'awr_gift_item', 'Gift Item', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (220, 'awarded_by', 'Award By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (221, 'employee_name', 'Employee Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (222, 'employee_list', 'Atn List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (223, 'department', 'Department', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (224, 'department_name', 'Department Name ', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (225, 'clockout', 'ClockOut', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (226, 'se_account_id', 'Select Account Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (227, 'division', 'Division', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (228, 'add_division', 'Add Division', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (229, 'update_division', 'Update Division', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (230, 'division_name', 'Division Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (231, 'division_list', 'Manage Division ', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (232, 'designation_list', 'Position List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (233, 'manage_designation', 'Manage Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (234, 'add_designation', 'Add Positionn', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (235, 'select_division', 'Select Division', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (236, 'select_designation', 'Select Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (237, 'asset', 'Asset', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (238, 'asset_type', 'Asset Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (239, 'add_type', 'Add Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (240, 'type_list', 'Type List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (242, 'select_type', 'Select Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (243, 'equipment_name', 'Equipment Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (244, 'model', 'Model', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (245, 'serial_no', 'Serial No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (246, 'equipment', 'Equipment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (247, 'add_equipment', 'Add Equipment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (248, 'equipment_list', 'Equipment List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (249, 'type', 'Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (250, 'equipment_maping', 'Equipment Mapping', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (251, 'add_maping', 'Add Mapping', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (252, 'maping_list', 'Mapping List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (253, 'update_equipment', 'Update Equipment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (254, 'select_employee', 'Select Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (255, 'select_equipment', 'Select Equipment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (256, 'basic_info', 'Basic Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (257, 'middle_name', 'Middle Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (258, 'state', 'State', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (259, 'city', 'City', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (260, 'zip_code', 'Zip Code', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (261, 'maiden_name', 'Maiden Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (262, 'add_employee', 'Add Employee', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (263, 'manage_employee', 'Manage Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (264, 'employee_update_form', 'Employee Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (265, 'what_you_search', 'Search Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (266, 'search', 'Search', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (267, 'duty_type', 'Duty Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (268, 'hire_date', 'Hire Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (269, 'original_h_date', 'Original Hire Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (270, 'voluntary_termination', 'Voluntary Termination', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (271, 'termination_reason', 'Termination Reason', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (272, 'termination_date', 'Termination Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (273, 're_hire_date', 'Re Hire Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (274, 'rate_type', 'Rate Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (275, 'pay_frequency', 'Pay Frequency', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (276, 'pay_frequency_txt', 'Pay Frequency Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (277, 'hourly_rate2', 'Hourly rate2', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (278, 'hourly_rate3', 'Hourly Rate3', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (279, 'home_department', 'Home Department', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (280, 'department_text', 'Department Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (281, 'benifit_class_code', 'Benifite Class code', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (282, 'benifit_desc', 'Benifit Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (283, 'benifit_acc_date', 'Benifit Accrual Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (284, 'benifit_sta', 'Benifite Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (285, 'super_visor_name', 'Supervisor Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (286, 'is_super_visor', 'Is Supervisor', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (287, 'supervisor_report', 'Supervisor Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (288, 'dob', 'Date of Birth', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (289, 'gender', 'Gender', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (290, 'marital_stats', 'Marital Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (291, 'ethnic_group', 'Ethnic Group', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (292, 'eeo_class_gp', 'EEO Class', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (293, 'ssn', 'SSN', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (294, 'work_in_state', 'Work in State', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (295, 'live_in_state', 'Live in State', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (296, 'home_email', 'Home Email', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (297, 'business_email', 'Business Email', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (298, 'home_phone', 'Home Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (299, 'business_phone', 'Business Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (300, 'cell_phone', 'Cell Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (301, 'emerg_contct', 'Emergency Contact', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (302, 'emerg_home_phone', 'Emergency Home Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (304, 'emrg_w_phone', 'Emergency Work Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (305, 'emer_con_rela', 'Emergency Contact Relation', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (306, 'alt_em_contct', 'Alter Emergency Contact', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (307, 'alt_emg_h_phone', 'Alt Emergency Home Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (308, 'alt_emg_w_phone', 'Alt Emergency  Work Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (309, 'reports', 'Reports', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (310, 'view_atn', 'Attendance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (311, 'mang', 'Employemanagement', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (312, 'designation', 'Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (313, 'practice', 'Practice', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (314, 'branch_name', 'Branch Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (315, 'chairman_name', 'Chairman', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (316, 'b_photo', 'Photo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (317, 'b_address', 'Address', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (318, 'position', 'Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (319, 'advertisement', 'Advertisement', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (320, 'position_name', 'Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (321, 'position_details', 'Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (322, 'circularprocess', 'Recruitment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (323, 'pos_id', 'Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (324, 'adv_circular_date', 'Publish Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (325, 'circular_dadeline', 'Dadeline', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (326, 'adv_file', 'Documents', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (327, 'adv_details', 'Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (328, 'attendance', 'Attendance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (329, 'employee', 'Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (330, 'emp_id', 'Employee Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (331, 'sign_in', 'Sign In', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (332, 'sign_out', 'Sign Out', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (333, 'staytime', 'Stay Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (334, 'abc', '1', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (335, 'first_name', 'First Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (336, 'last_name', 'Last Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (337, 'alter_phone', 'Alternative Phone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (338, 'present_address', 'Present Address', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (339, 'parmanent_address', 'Permanent Address', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (340, 'candidateinfo', 'Candidate Info', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (341, 'add_advertisement', 'Add Advertisement', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (342, 'advertisement_list', 'Manage Advertisement ', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (343, 'candidate_basic_info', 'Candidate Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (344, 'can_basicinfo_list', 'Manage Candidate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (345, 'add_canbasic_info', 'New Candidate', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (346, 'candidate_education_info', 'Candidate Educational Info', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (347, 'can_educationinfo_list', 'Candidate Edu Info list', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (348, 'add_edu_info', 'Add Educational Info', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (349, 'can_id', 'Candidate Id', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (350, 'degree_name', 'Obtained Degree', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (351, 'university_name', 'University', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (352, 'cgp', 'CGPA', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (353, 'comments', 'Comments', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (354, 'signature', 'Signature', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (355, 'candidate_workexperience', 'Candidate Work Experience', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (356, 'can_workexperience_list', 'Work Experience list', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (357, 'add_can_experience', 'Add Work Experience', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (358, 'company_name', 'Company Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (359, 'working_period', 'Working Period', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (360, 'duties', 'Duties', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (361, 'supervisor', 'Supervisor', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (362, 'candidate_workexpe', 'Candidate Work Experience', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (363, 'candidate_shortlist', 'Candidate Shortlist', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (364, 'shortlist_view', 'Manage Shortlist', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (365, 'add_shortlist', 'Add Shortlist', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (366, 'date_of_shortlist', 'Shortlist Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (367, 'interview_date', 'Interview Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (368, 'submit', 'Submit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (369, 'candidate_id', 'Your ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (370, 'job_adv_id', 'Job Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (371, 'sequence', 'Sequence', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (372, 'candidate_interview', 'Interview', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (373, 'interview_list', 'Interview list', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (374, 'add_interview', 'Add Interview', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (375, 'interviewer_id', 'Interviewer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (376, 'interview_marks', 'Viva Marks', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (377, 'written_total_marks', 'Written Total Marks', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (378, 'mcq_total_marks', 'MCQ Total Marks', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (379, 'recommandation', 'Recommandation', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (380, 'selection', 'Selection', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (381, 'details', 'Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (382, 'candidate_selection', 'Candidate Selection', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (383, 'selection_list', 'Selection List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (384, 'add_selection', 'Add Selection', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (385, 'employee_id', 'Employee Id', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (386, 'position_id', '1', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (387, 'selection_terms', 'Selection Terms', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (388, 'total_marks', 'Total Marks', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (389, 'photo', 'Picture', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (390, 'your_id', 'Your ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (391, 'change_image', 'Change Photo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (392, 'picture', 'Photograph', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (393, 'ad', 'Add', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (394, 'write_y_p_info', 'Write Your Persoanal Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (395, 'emp_position', 'Employee Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (396, 'add_pos', 'Add Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (397, 'list_pos', 'List of Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (398, 'emp_salary_stup', 'Employee Salary SetUp', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (399, 'add_salary_stup', 'Add Salary Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (400, 'list_salarystup', 'List of Salary Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (401, 'employee', 'Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (402, 'emp_sal_name', 'Salary Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (403, 'emp_sal_type', 'Salary Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (404, 'emp_performance', 'Employee Performance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (405, 'add_performance', 'Add Performance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (406, 'list_performance', 'List of Performance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (407, 'note', 'Note', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (408, 'note_by', 'Note By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (409, 'number_of_star', 'Number of Star', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (410, 'updated_by', 'Updated By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (411, 'emp_sal_payment', 'Manage Employee Salary', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (412, 'add_payment', 'Add Payment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (413, 'list_payment', 'List of payment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (414, 'total_salary', 'Total Salary', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (415, 'total_working_minutes', 'Working Hour', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (416, 'payment_due', 'Payment Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (417, 'payment_date', 'Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (418, 'paid_by', 'Paid By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (419, 'view_employee_payment', 'Employee Payment List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (420, 'sal_payment_type', 'Salary Payment Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (421, 'add_payment_type', 'Add Payment Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (422, 'list_payment_type', 'List of Payment Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (423, 'payment_period', 'Payment Period', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (424, 'payment_type', 'Payment Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (425, 'time', 'Punch Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (426, 'shift', 'Shift', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (427, 'location', 'Location', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (428, 'logtype', 'Log Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (429, 'branch', 'Location', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (430, 'student', 'Students', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (432, 'save_successfull', 'Your Data Save Successfully', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (433, 'successfully_updated', 'Your Data Successfully Updated', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (434, 'atn_form', 'Attendance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (435, 'atn_report', 'Attendance Reports', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (436, 'end_date', 'To', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (437, 'start_date', 'From', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (438, 'done', 'Done', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (439, 'employee_id_se', 'Write Employee Id or name here ', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (440, 'attendance_repor', 'Attendance Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (441, 'e_time', 'End Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (442, 's_time', 'Start Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (443, 'atn_datewiserer', 'Date Wise Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (444, 'atn_report_id', 'Date And Id base Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (445, 'atn_report_time', 'Date And Time report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (446, 'payroll', 'Payroll', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (447, 'loan', 'Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (448, 'loan_grand', 'Grant Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (449, 'add_loan', 'Add Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (450, 'loan_list', 'List of Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (451, 'loan_details', 'Loan Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (452, 'amount', 'Total Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (453, 'interest_rate', 'Interest Percentage', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (454, 'installment_period', 'Installment Period', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (455, 'repayment_amount', 'Repayment Total', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (456, 'date_of_approve', 'Approve Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (457, 'repayment_start_date', 'Repayment From', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (458, 'permission_by', 'Permitted By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (459, 'grand', 'Grand', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (460, 'installment', 'Installment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (461, 'loan_status', 'Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (462, 'installment_period_m', 'Installment Period in Month', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (463, 'successfully_inserted', 'Your loan Successfully Granted', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (464, 'loan_installment', 'Loan Installment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (465, 'add_installment', 'Add Installment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (466, 'installment_list', 'List of Installment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (467, 'loan_id', 'Loan No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (468, 'installment_amount', 'Installment Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (469, 'payment', 'Payment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (470, 'received_by', 'Receiver', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (471, 'installment_no', 'Install No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (472, 'notes', 'Notes', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (473, 'paid', 'Paid', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (474, 'loan_report', 'Loan Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (475, 'e_r_id', 'Enter Your Employee ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (476, 'leave', 'Leave', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (477, 'add_leave', 'Add Leave', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (478, 'list_leave', 'List of Leave', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (479, 'dayname', 'Weekly Leave Day', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (480, 'holiday', 'Holiday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (481, 'list_holiday', 'List of Holidays', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (482, 'no_of_days', 'Number of Days', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (483, 'holiday_name', 'Holiday Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (484, 'set', 'SET', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (485, 'tax', 'Tax', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (486, 'tax_setup', 'Tax Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (487, 'add_tax_setup', 'Add Tax Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (488, 'list_tax_setup', 'List of Tax setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (489, 'tax_collection', 'Tax collection', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (490, 'start_amount', 'Start Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (491, 'end_amount', 'End Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (492, 'rate', 'Tax Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (493, 'date_start', 'Date Start', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (494, 'amount_tax', 'Tax Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (495, 'collection_by', 'Collection By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (496, 'date_end', 'Date End', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (497, 'income_net_period', 'Income  Net period', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (498, 'default_amount', 'Default Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (499, 'add_sal_type', 'Add Salary Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (500, 'list_sal_type', 'Salary Type List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (501, 'salary_type_setup', 'Salary Type Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (502, 'salary_setup', 'Salary SetUp', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (503, 'add_sal_setup', 'Add Salary Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (504, 'list_sal_setup', 'Salary Setup List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (505, 'salary_type_id', 'Salary Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (506, 'salary_generate', 'Salary Generate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (507, 'add_sal_generate', 'Generate Now', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (508, 'list_sal_generate', 'Generated Salary List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (509, 'gdate', 'Generate Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (510, 'start_dates', 'Start Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (511, 'generate', 'Generate ', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (512, 'successfully_saved_saletup', ' Set up Successfull', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (513, 's_date', 'Start Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (514, 'e_date', 'End Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (515, 'salary_payable', 'Payable Salary', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (516, 'tax_manager', 'Tax', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (517, 'generate_by', 'Generate By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (518, 'successfully_paid', 'Successfully Paid', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (519, 'direct_empl', ' Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (520, 'add_emp_info', 'Add New Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (521, 'new_empl_pos', 'Add New Employee Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (522, 'manage', 'Manage Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (523, 'ad_advertisement', 'ADD POSITION', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (524, 'moduless', 'Modules', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (525, 'next', 'Next', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (526, 'finish', 'Finish', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (527, 'request', 'Request', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (528, 'successfully_saved', 'Your Data Successfully Saved', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (529, 'sal_type', 'Salary Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (530, 'sal_name', 'Salary Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (531, 'leave_application', 'Leave Application', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (532, 'apply_strt_date', 'Application Start Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (533, 'apply_end_date', 'Application End date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (534, 'leave_aprv_strt_date', 'Approve Start Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (535, 'leave_aprv_end_date', 'Approved End Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (536, 'num_aprv_day', 'Aproved Day', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (537, 'reason', 'Reason', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (538, 'approve_date', 'Approved Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (539, 'leave_type', 'Leave Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (540, 'apply_hard_copy', 'Application Hard Copy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (541, 'approved_by', 'Approved By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (542, 'notice', 'Notice Board', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (543, 'noticeboard', 'Notice Board', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (544, 'notice_descriptiion', 'Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (545, 'notice_date', 'Notice Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (546, 'notice_type', 'Notice Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (547, 'notice_by', 'Notice By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (548, 'notice_attachment', 'Attachment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (549, 'attendance_list', 'Attendance List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (550, 'checkin', 'Check In', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (551, 'checkout', 'Check Out', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (552, 'stay', 'Stay', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (553, 'sl', 'SL', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (554, 'name', 'Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (556, 'id', 'ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (557, 'single_checkin', 'Single Check In', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (558, 'bulk_checkin', 'Bulk Check In', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (559, 'manage_attendance', 'Manage Attendance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (560, 'update_attendance', 'Attendnece Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (561, 'add_attendance', 'Add Attendance', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (562, 'report_view', 'Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (563, 'attendance_report', 'Attendance Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (564, 'manage_award', 'Manage Award', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (565, 'add_new_award', 'Add New Award', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (566, 'educational_information', 'Educational Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (567, 'past_experience', 'Past Experience', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (568, 'basic_information', 'Basic Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (569, 'manage_shortlist', 'Manage Short List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (570, 'manage_selection', 'Manage Selection', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (571, 'manage_interview', 'Manage Interview', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (572, 'add_new_dept', 'Add New Department', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (573, 'manage_dept', 'Manage Department', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (574, 'weekly_holiday', 'Weekly Holiday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (575, 'manage_holiday', 'Manage Holiday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (576, 'add_more_holiday', 'Add More Holiday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (577, 'add_leave_type', 'Add Leave Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (578, 'others_leave_application', 'Add Leave', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (579, 'add_leave_type', 'Add Leave Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (580, 'others_leave', 'Apply Leave', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (581, 'manage_application', 'Manage Application', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (582, 'manage_granted_loan', 'Manage Granted Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (583, 'grant_loan', 'Grant Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (584, 'add_salary_setup', 'Add Salary Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (585, 'manage_salary_setup', 'Manage Salary Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (586, 'add_salary_type', 'Add Salary Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (587, 'manage_salary_type', 'Manage Salary Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (588, 'manage_tax_setup', 'Manage Tax Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (589, 'setup_tax', 'Setup Tax', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (590, 'salary_type', 'Salary Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (591, 'manage_salary_generate', 'Manage Salary Generate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (592, 'generate_now', 'Generate Now', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (593, 'benefit_type', 'Benifit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (594, 'customer', 'Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (595, 'customer_list', 'Customer List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (596, 'floorplan_list', 'Floor Plan List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (597, 'floor_name', 'Floor Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (598, 'num_of_room', 'No of Room', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (599, 'room_no', 'Room No.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (600, 'add_floor', 'Add Floor', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (601, 'assign_floor', 'Assign Floor', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (602, 'floor_list', 'Floor List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (603, 'start_roomno', 'Start Room No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (604, 'assign_room', 'Assign Room', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (605, 'assign_facilities', 'Assign Room Facilities', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (606, 'assign_rate', 'Assign Room Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (607, 'first_room_assign', 'Room is not select. Please Select Room First', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (608, 'nationality', 'Nationality', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (609, 'native', 'Native', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (610, 'foreigner', 'Foreigner', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (611, 'profession', 'Profession', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (612, 'national_id', 'National ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (613, 'passport_no', 'Passport No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (614, 'visa_reg_no', 'Visa/Reg. No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (615, 'purpose', 'Purpose', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (616, 'tourist', 'Tourist', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (617, 'business', 'Business', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (618, 'official', 'Official', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (619, 'customer_edit', 'Update Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (620, 'book_now', 'Book Now', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (621, 'payment_list', 'Payment List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (622, 'payment_form', 'Payment Form', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (623, 'invoice_no', 'Invoice No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (624, 'invoice', 'Invoice', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (625, 'pay_date', 'Pay Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (626, 'payment_method', 'Payment Method', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (627, 'payment_setting', 'Payment Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (628, 'paymentmethod_list', 'Payment Method List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (629, 'paymentmethod_setup', 'Payment Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (630, 'payment_add', 'Add Payment Method', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (631, 'payment_name', 'Payment Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (632, 'marchantid', 'Marchant ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (633, 'supplier_add', 'Add Supplier', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (634, 'supplier_edit', 'Update Supplier', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (635, 'purchase_item', 'Purchase Item', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (636, 'purchase', 'Purchase Manage', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (637, 'purchase_list', 'Purchase List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (638, 'purchase_add', 'Add Purchase', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (639, 'purchase_edit', 'Update Purchase', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (640, 'quantity', 'Quantity', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (641, 'supplier_information', 'Supplier Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (642, 'supplier_manage', 'Supplier Manage', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (643, 'supplier_name', 'Supplier Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (644, 'supplier_list', 'Supplier List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (645, 'purchase_return', 'Purchase Return', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (646, 'purchase_qty', 'Purchase Qty', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (647, 'return_qty', 'Return Qty', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (648, 'return_invoice', 'Return Invoice', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (649, 'units', 'Unit and Products', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (650, 'manage_unitmeasurement', 'Unit Measurement', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (651, 'unit_list', 'Unit Measurement List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (652, 'unit_add', 'Add Unit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (653, 'unit_update', 'Unit Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (654, 'unit_name', 'Unit Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (655, 'manage_ingradient', 'Manage Product', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (656, 'ingradient_list', 'Products List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (657, 'add_ingredient', 'Add Product', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (658, 'ingredient_name', 'Product Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (659, 'unit_short_name', 'Short Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (660, 'update_ingredient', 'Update Product', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (661, 'mobile', 'Mobile', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (662, 'return', 'Return', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (663, 'booking_report', 'Booking Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (664, 'guest_info', 'Guest Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (665, 'purchase_report', 'Purchase Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (666, 'web_setting', 'Web Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (667, 'banner_setting', 'Banner Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (668, 'menu_setting', 'Menu Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (669, 'widget_setting', 'Widget Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (670, 'add_banner', 'Add Banner', NULL, NULL, NULL, '', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (671, 'bannertype', 'Add Banner Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (672, 'banner_list', 'Banner List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (673, 'title', 'Title', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (674, 'subtitle', 'Sub Title', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (675, 'banner_type', 'Banner Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (676, 'link_url', 'Link URL', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (677, 'banner_edit', 'Banner Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (678, 'menu_name', 'Menu Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (679, 'menu_url', 'Menu Slug', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (680, 'sub_menu', 'Sub Menu', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (681, 'add_menu', 'Add Menu', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (682, 'parent_menu', 'Parent Menu', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (683, 'widget_name', 'Widget Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (684, 'widget_title', 'Widget Title', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (685, 'widget_desc', 'Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (686, 'add_widget', 'Add New', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (687, 'common_setting', 'Common Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (688, 'bannersize', 'Banner Size', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (689, 'width', 'Width', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (690, 'height', 'Height', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (691, 'email_setting', 'Email Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (692, 'assign_roomoffer', 'Assign Room Offer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (693, 'offer_year_month', 'Select Month/Year', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (694, 'current_rate', 'Orginal Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (695, 'offer_rate', 'Offer Discount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (696, 'roominfo', 'Room information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (697, 'reserve_condition', 'Reserve Condition', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (698, 'subscribelist', 'Subscribe List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (699, 'offer_title', 'Offer Title', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (700, 'offer_text', 'Offer Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (701, 'customer_add', 'Add Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (702, 'report', 'Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (703, 'set_default', 'Default', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (704, 'template_name', 'Template Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (705, 'sms_template', 'SMS Template', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (706, 'sms_template_warning', 'Please Use \"{Id}\" Format Without Quotation To Set Dynamic Value Inside Template', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (707, 'order_successfully', 'Your booking has been completed thank you.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (708, 'order_fail', 'Booking Failed', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (709, 'invalid_splash', 'Splash image not uploaded.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (710, 'splash', 'Splash image', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (711, 'product_list', 'Product List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (712, 'amount', 'Total Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (713, 'return_qty', 'Return Qty', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (714, 'price', 'Price', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (715, 'stock_report', 'Stock Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (716, 'purchase_list', 'Purchase List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (717, 'paymentmethod', 'Payment Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (718, 'candidate_name', 'Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (719, 'apply_day', 'Apply Day', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (720, 'number_of_leave_days', 'Number of Leave Days', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (721, 'manage_installment', 'Manage Installment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (722, 'filter', 'Search', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (723, 'salary_benefits_type', 'Benefit Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (724, 'basic', 'Basic', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (725, 'gross_salary', 'Gross Salary ', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (726, 'currency_list', 'Currency List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (727, 'currency_name', 'Currency Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (728, 'currency_add', 'Add Currency', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (729, 'currency_edit', 'Update Currency', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (730, 'currency_icon', 'Currency Icon', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (731, 'currency_rate', 'Conversation Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (732, 'currency', 'Currency Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (733, 'education', 'Education', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (734, 'institute_name', 'Institute Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (735, 'result', 'Result', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (736, 'grand_total', 'Grand Total', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (737, 'common_setting', 'Common Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (738, 'sms_configuration', 'Sms Configuration', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (739, 'sms_template', 'Sms Template', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (740, 'template_list', 'Template List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (741, 'sunscribe_list', 'Subscribe List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (742, 'role_listassign', 'Assign Role List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (743, 'total_amount', 'Total Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (744, 'total_loan', 'Total Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (745, 'unit_measurement_list', 'Unit Measurement List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (747, 'welcome_back', 'Welcome Back', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (748, 'security_setting', 'Security Setting', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (749, 'security_modules', 'Security Module', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (750, 'try_duration', 'Duration', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (751, 'wrong_try', 'Wrong Try', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (752, 'ip_block', 'Ip block', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (753, 'site_key', 'Site key', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (754, 'secret_key', 'Secret key', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (755, 'balance', 'Balance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (756, 'account_code', 'Account Code', NULL, NULL, NULL, 'Código da Conta', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (757, 'loan_no', 'Loan No.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (758, 'bank_book', 'Bank Book', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (759, 'trial_balance', 'Trial Balance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (760, 'manage_award', 'Manage Award', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (761, 'award_list', 'Award List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (762, 'already_exists', 'Already Exists This Name.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (763, 'can_name', 'Candidate Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (764, 'turkish', '', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (765, 'store_name', 'Store Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (766, 'update_role_assign', 'Update Role Assign', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (767, 'facility_details', 'Facility Details Name Already Exists', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (768, 'pay_exact_amount', 'Please pay the exact amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (769, 'search_report', 'Search Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (770, 'payment_status', 'Payment Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (771, 'previous', 'Previous', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (772, 'check_availability', 'Check Availability', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (773, 'need_help', 'Need Help:', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (774, 'join_us', 'Join Us', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (775, 'children', 'Children', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (776, 'captcha_registration_link', 'Captcha Registration Link', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (777, 'cookie_secure', 'Cookie Secure', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (778, 'captcha', 'Captcha', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (779, 'csrf_token', 'CSRF Token', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (780, 'xss_filter', 'XSS filter', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (781, 'cookie_http', 'Cookie http', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (782, 'can_create', 'Can Create', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (783, 'can_read', 'Can read', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (784, 'can_edit', 'Can Edit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (785, 'can_delete', 'Can Delete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (786, 'amount_vs_booking', 'Total Booking Amount vs Total Number of Booking', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (787, 'equalizer', 'Equalizer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (788, 'today_booking', 'Today Booking', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (789, 'attach_money', 'Attach Money', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (790, 'group_add', 'Group Add', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (791, 'total_customer', 'Total Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (792, 'total_booking', 'Total Booking', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (793, 'poll', 'Poll', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (794, 'today_booking_list', 'Today Booking List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (795, 'next_day_booking', 'Next Day Booking', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (796, 'add_new_customer', 'Add New Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (797, 'latest_version', 'Latest version', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (798, 'current_version', 'Current version', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (799, 'no_update_available', 'No Update available', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (800, 'active', 'Active', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (801, 'inactive', 'InActive', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (802, 'select_option', 'Select Option', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (803, 'left', 'Left', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (804, 'right', 'Right', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (805, 'is_live_or_test', 'Is Live or Test', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (806, 'live', 'Live', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (807, 'test_mode', 'Test Mode', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (808, 'paid_amount', 'Paid Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (809, 'due_amount', 'Due Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (810, 'preview', 'Preview', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (811, 'booking_confirm_message', 'We will send your booking confirmation to this email address.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (812, 'create_an_account', 'Create an account?', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (813, 'create_account_password', 'Create account password', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (814, 'language_list', 'Language List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (815, 'phrase_name', 'Phrase Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (816, 'label', 'Label', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (817, 'unpaid', 'Unpaid', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (818, 'select_payment_type', 'Select payment Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (819, 'add_phrase', 'Add Phrase', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (820, 'phrase', 'Phrase', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (821, 'upload', 'Upload', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (822, 'notifications', 'Notifications', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (823, 'you_have', 'You have', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (824, 'unseen_notification', ' unseen notification', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (825, 'view_all_notification', 'View All Notifications', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (826, 'full_time', 'Full Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (827, 'part_time', 'Part Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (828, 'contructual', 'Contructual', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (829, 'other', 'Other', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (830, 'yes', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (831, 'no', 'No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (832, 'hourly', 'Hourly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (833, 'salary', 'Salary', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (834, 'select_frequency', 'Select Frequency', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (835, 'weekly', 'Weekly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (836, 'biweekly', 'Biweekly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (837, 'annual', 'Annual', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (838, 'male', 'Male', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (839, 'female', 'Female', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (840, 'single', 'Single', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (841, 'married', 'Married', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (842, 'divorced', 'Divorced', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (843, 'widowed', 'Widowed', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (844, 'citizen', 'Citizen', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (845, 'non_citizen', 'Non-ctizen', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (846, 'text', 'Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (847, 'text_area', 'Text Area', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (848, 'all_report', 'All Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (849, 'no_result_found', 'No Result Found!!!!!', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (850, 'select_breakfast', 'Select Breakfast', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (851, 'selected', 'Selected', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (852, 'select_bed_no', 'Select Bed No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (853, 'nights_booking_from', 'Nights Booking From', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (854, 'number_of_rooms', 'Number Of Rooms', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (855, 'number_of_person', 'Number Of Person', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (856, 'select_room_no', 'Select Room No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (857, 'nights', 'Nights', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (858, 'available_room', 'Available Room', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (859, 'max_people', 'Max People', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (860, 'price_per_night', 'Price Per Night', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (861, 'offer_discount', 'Offer Discount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (862, 'sub_total', 'Sub Total', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (863, 'service_charge', 'Service Charge', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (864, 'no_room_found', 'No Room Found from this date!!!!', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (865, 'hotel_information', 'Hotel Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (866, 'offer_date', 'Offer Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (867, 'taxes_and_service_charge', 'Taxes and Service Charge', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (868, 'total_price', 'Total Price', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (869, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (870, 'complete', 'Complete', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (871, 'select_staus', 'Select Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (872, 'cancel', 'Cancel', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (873, 'room_facility_details_list', 'Room Facilities Details List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (874, 'room_facilities_list', 'Room Facilities List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (875, 'room', 'Room', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (876, 'guest_signature', 'Guest Signature', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (877, 'font_desk_office_signature', 'Font Desk Office Signature', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (879, 'checkin_date', 'Check In Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (880, 'checkout_date', 'Check Out Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (881, 'checkin_time', 'Check InTime', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (882, 'checkout_time', 'Check Out Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (883, 'visaregno', '', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (884, 'for_foreign_guest', 'For Foreign Guest', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (885, 'name_of_the_guest', 'Name Of the Guest', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (886, 'guest_registration_card', 'Guest Registration Card', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (887, 'unit_price', 'Unit Price', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (888, 'purchase_date', 'Purchase Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (889, 'expiry_date', 'Expiry Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (890, 'item_information', 'Item Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (891, 'stockqnt', 'Stock/Qnt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (892, 'there_are_currently_no_addresses', 'There are currently No Addresses', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (893, 'checked_out', 'Checked Out', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (894, 'remember_password', 'Remember password', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (895, 'your_email', 'Your email', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (896, 'sign_in_using_your_email_address', 'Sign in Using Your Email Address', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (897, 'foreign', 'Foreign', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (898, 'noon', 'Noon', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (899, 'print_date', 'Print Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (900, 'production_date', 'Production Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (901, 'production_quantity', 'Production Quaantity', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (902, 'position_list_detail', 'Position List Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (903, 'add_return', 'Ad Return', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (904, 'live_mode', 'Live mode', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (905, 'application_list', 'Application List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (906, 'application_form', 'Application', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (907, 'leave_application_form', 'Leave Application', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (908, 'report_by_id', 'Report By Id', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (909, 'send', 'Send', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (910, 'award_form', 'Award', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (911, 'manage_performance', 'Manage Performance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (912, 'employee_payment', 'Employee Payment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (913, 'setup_date', 'Setup Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (914, 'select_date_format', 'Select Date Format', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (915, 'date_format', 'Date Format', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (916, 'ddmmyyyy', 'dd/mm/yyyy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (917, 'yyyymmdd', 'yyyy/mm/dd', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (918, 'mmddyyyy', 'mm/dd/yyyy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (919, 'ddmyyyy', 'dd M,yyyy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (920, 'dmy', 'dd-mm-yyyy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (921, 'ymd', 'yyyy-mm-dd', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (922, 'mdy', 'mm/dd/yyyy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (923, 'update_candidate', 'Update Candidate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (924, 'working_experience', 'Working Experience', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (925, 'candidate_view', 'Candidate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (926, 'department_form', 'Department', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (927, 'all_division', 'Division List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (928, 'add_employee_performance', 'Add Employee Performance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (929, 'update_employee_performance', 'Update Employee Performance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (930, 'deduct', 'Deduct', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (931, 'addition', 'Addition', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (932, 'manage_tax', 'Tax Manager', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (933, 'update_salary_setup', 'Update Salary setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (934, 'deduction', 'Deduction', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (935, 'salary_setup_view', 'Salary Setup', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (936, 'granted', 'Granted', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (937, 'deny', 'Deny', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (938, 'update_grant_loan', 'Update Grant Loan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (939, 'holiday_view', 'Holiday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (940, 'inventory', 'Inventory', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (941, 'loan_installment_list', 'Loan Installment List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (942, 'interview_form', 'INTERVIEW', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (943, 'deselected', 'Deselected', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (944, 'selection_type', 'Selection type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (945, 'total_leave_days', 'Total Leave Days', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (946, 'add_leave_type_form', 'Add Leave Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (947, 'update_leave_type', 'Update Leave Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (948, 'loan_view_list', 'Loan List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (949, 'benifit_class_code_description', 'Benifit Class Code Description', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (950, 'benefit_accrual_date', 'Benefit Accrual Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (951, 'create_candidate_selection', 'CREATE CANDIDATE SELECTION', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (952, 'select', 'Select', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (953, 'update_application', 'Update Application', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (954, 'installment_update', 'Installment Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (955, 'update_position', 'Update Position', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (956, 'short_list', 'Short List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (957, 'select_weekly_leave_day', 'Select Weekly Leave Day', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (958, 'friday', 'Friday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (959, 'saturday', 'Saturday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (960, 'sunday', 'Sunday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (961, 'weekly_leave', 'Weekly Leave', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (962, 'add_weekly_leave', 'Add Weekly Leave', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (963, 'check', 'check', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (964, 'checked', 'Checked', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (965, 'monthly', 'Monthly', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (966, 'cash_in_hand', 'Cash in hand', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (967, 'department_list', 'Department List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (968, 'today', 'today', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (969, 'attach_money_icon', 'attach_money', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (970, 'account_circle_icon', 'account_circle', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (971, 'date_range_icon', 'date_range', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (972, 'userid', 'User Id', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (973, 'contact_send', 'Message Sent Successfully', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (974, 'check_details', 'Check Your Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (975, 'payment_details', 'Payments Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (976, 'message_us', 'MESSAGE US', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (977, 'start_chat', 'Start a chat!', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (978, 'send_message', 'Send message', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (979, 'awsome_choice', 'Awesome choice! You are getting a great deal with your rate.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (980, 'until', 'Until', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (981, 'enter_details', 'Enter Your Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (982, 'your_stay_includes', 'Your Stay Includes:', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (983, 'booking_conditions', 'Booking Conditions', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (984, 'full_guest_name', 'Full Guest Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (985, 'special_request', 'Special Requests', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (986, 'next_final_details', 'Next: Final details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (987, 'write_request', 'Please write requests in English or the propertys language', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (988, 'is_not_available', 'is not available for', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (989, 'is_not_available_on_this_date', 'is not available on this date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (990, 'people', 'People', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (991, 'gallery', 'Gallery', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (992, 'show_all', 'Show All', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (993, 'subscribe', 'Subscribe', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (994, 'instagram', 'Instagram', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (995, 'twitter', 'Twitter', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (996, 'dribbble', 'Dribbble', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (997, 'facebook', 'Facebook', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (998, 'privacy', 'Privacy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (999, 'terms_conditions', 'Terms & Conditions', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1000, 'signup_account', 'Sign up for your account!', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1001, 'enter_your_valid_email', 'Enter your valid email', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1002, 'by_signing_up_you_agree', 'By signing up, you agree to the', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1003, 'terms_of_service', 'terms of service', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1004, 'sign_up', 'Sign Up', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1005, 'terms_of_use', 'terms of use', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1006, 'by_signing_up_youagree_to_our', 'By signing up, you agree to our', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1007, 'signin_to_your_account', 'Sign into your account!', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1008, 'nice_to_see_you', 'Nice to see you! Please log in with your account.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1009, 'review', 'Review', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1010, 'night', 'Night', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1011, 'free_cancellation', 'Free cancellation', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1012, 'included_services', 'Included services', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1013, 'monthly_booking_status', 'Monthly Booking Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1014, 'refresh', 'Refresh', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1015, 'total_booking_history', 'Total Booking History', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1016, 'total_reservation', 'Total Reservation', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1017, 'child_limit', 'Child Limit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1018, 'book_by', 'Book By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1019, 'learn_more', 'We Provide', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1020, 'please_wait', 'Please wait...', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1021, 'gateway', 'Gateway', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1022, 'subtotal', 'Sub - Total Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1023, 'invoice_return_list', 'Invoice Return List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1024, 'no_product_found', 'No Product Found', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1025, 'language_name', 'Language Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1026, 'customer_information', 'Customer Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1027, 'room_rate', 'Room Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1028, 'booking_information', 'Booking Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1029, 'login_logo', 'Login Logo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1030, 'link1', 'Link1', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1031, 'link2', 'Link2', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1032, 'link3', 'Link3', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1033, 'header_logo', 'Header Logo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1034, 'footer_logo', 'Footer Logo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1035, 'invalid_credentials', 'Invalid Credentials', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1036, 'home', 'Home', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1037, 'please_logout', 'Please Logout First', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1038, 'invoice_logo', 'Invoice Logo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1039, 'cash_book_report_on', 'Cash Book Report On', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1040, 'cash_book_voucher', 'Cash Book Voucher', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1041, 'bank_book_voucher', 'Bank Book Voucher', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1042, 'bank_book_report_of', 'Bank Book Report Of', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1043, 'general_ledger_of', 'General Ledger Of', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1044, 'transaction_date', 'Transaction date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1045, 'voucher_type', 'Voucher Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1046, 'particulars', 'Particulars', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1047, 'head_of_account', 'Head of Account', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1048, 'no_report', 'No Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1049, 'trial_balance_with_opening_as_on', 'Trial Balance With Opening as On', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1050, 'prepared_by', 'Prepared By', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1051, 'account_official', 'Account Official', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1052, 'general_ledger_report', 'General Ledger Report', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1053, 'edit_profile', 'Edit Profile', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1054, 'phone_message', 'Note : Add prefix without + sign Example: (88)01840997***', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1055, 'assign_role', 'Assign Role', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1056, 'incorrect_email_or_password', 'Incorrect Email or Password', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1057, 'remarks', 'Remarks', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1058, 'website', 'Website', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1059, 'sorry_your_account_is_deactivated', 'Sorry Your account is Deactivated', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1060, 'settings', 'Settings', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1061, 'checkin_list', 'Check In List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1062, 'checkout_list', 'Check Out List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1063, 'direct_checkin', 'Direct Checkin', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1064, 'booking_detail', 'Booking Detail', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1065, 'room_detail', 'Room Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1066, 'occupant_info', 'Customer Info', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1067, 'rent_info', 'Rent Info', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1068, 'view_checkin', 'View Check In', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1069, 'payment_details', 'Payment Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1070, 'time_format', 'Time Format', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1071, 'booking_source', 'Booking Soruce', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1072, 'booking_source_no', 'Source No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1073, 'arrival_from', 'Arival From', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1074, 'purpose_of_visit', 'Purpose of Visit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1075, 'b_ty_details', 'Booking Type Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1076, 'b_ty_details_edit', 'Booking Type Details Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1077, 'booking_sourse', 'Booking Source', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1078, 'b_ty_d_list', 'Booking Type Details List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1079, 'please_select_one', 'Please Select One', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1080, 'house_keeping', 'House Keeping', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1081, 'room_cleaning', 'Room Cleaning', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1082, 'assign_room_cleaning', 'Assign Room Cleaning', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1083, 'house_keeper', 'House Keeper', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1089, 'b_ty_details', 'Booking Type Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1090, 'b_ty_details_edit', 'Booking Type Details Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1091, 'booking_sourse', 'Booking Source', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1092, 'b_ty_d_list', 'Booking Type Details List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1093, 'please_select_one', 'Please Select One', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1094, 'wakeup_call_list', 'Wake Up Call List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1095, 'wakeup_time', 'Wake Up Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1096, 'wacall_add', 'Add Wake Up Call', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1097, 'cust_name', 'Customer Name\r\n', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1098, 'wacall_edit', 'Wake Up Call Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1099, 'categorylist', 'Category List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1100, 'category_name', 'Category Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1101, 'add_category', 'Add Category', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1103, 'available', 'Available', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1104, 'used', 'Used', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1106, 'pool_type', 'Pool Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1107, 'pool_type_list', 'Pool Type List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1110, 'swimming_pool', 'Swimming Pool', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1111, 'swimming_pool_list', 'Swimming Pool List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1114, 'pool_img', 'Pool Image', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1115, 'pool_img_list', 'Pool Image List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1116, 'pool_package', 'Pool Package', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1117, 'pool_package_list', 'Pool Package List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1118, 'date_from', 'Date From', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1121, 'pool_package_add', 'Add Pool Package', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1126, 'select_customer', 'In House Guest', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1128, 'shift_mgt', 'Shift Management', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1129, 'shift_assign', 'Roster Assign', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1140, 'shift_assign_list', 'Roster Assign List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1142, 'select_shift', 'Select Shift', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1143, 'select_emp', 'Select Employee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1157, 'attendance_dashboard', 'Attendance Dashboard', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1158, 'complementary', 'Complementary', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1169, 'attendance_dashboard', 'Attendance Dashboard', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1170, 'itemmanage', 'Food Management', NULL, NULL, NULL, 'GestiÃƒÆ’Ã‚Â³n de ArtÃƒÆ’Ã‚Â­culos', 'MenÃƒÆ’Ã‚Â¼ YÃƒÆ’Ã‚Â¶netimi', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1205, 'guest_list', 'Guest List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1207, 'tax_management', 'Tax Management', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1208, 'tax_list', 'Tax List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1209, 'reuse_list', 'Laundry Product List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1210, 'destroyed_list', 'Destroyed List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1233, 'dashboard', 'Dashboard', NULL, NULL, NULL, 'Tablero', 'GÃƒÆ’Ã‚Â¶sterge Paneli', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1295, 'qr-order', 'QR Order', NULL, NULL, NULL, 'Orden QR', 'QR Kod SipariÃƒâ€¦Ã…Â¸leri', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1366, 'due_marge', 'Due Merge', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1377, 'card_terminal_name', 'Card Terminal Name', NULL, NULL, NULL, 'Nombre del Terminal de la Tarjeta', 'Kart Terminal AdÃƒâ€žÃ‚Â±', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1381, 'card_terminal_name', 'Card Terminal Name', NULL, NULL, NULL, 'Nombre del Terminal de la Tarjeta', 'Kart Terminal AdÃƒâ€žÃ‚Â±', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1386, 'select_dept', 'Select Department', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1387, 'choose_file', 'Choose File', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1388, 'balance_sheet', 'Balance Sheet', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1389, 'financial_year', 'Financial Year', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1390, 'financial_year_end', 'Financial Year Ending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1391, 'opening_balance', 'Opening Balance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1392, 'download', 'Download', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1393, 'purchase_key', 'Purchase Key', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1394, 'add_module', 'Add  Module', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1395, 'overwrite', 'Overwrite', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1396, 'buy_now', 'Buy Now', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1397, 'install', 'Install', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1398, 'uninstall', 'Uninstall', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1399, 'room_status', 'Room Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1400, 'room_status', 'Room Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1401, 'room_status', 'Room Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1438, 'promocode', 'Promocode', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1439, 'promocode_list', 'Promocode List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1440, 'addnew_promocode', 'New Promocode', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1442, 'per_price', 'Per Price', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1448, 'view', 'View', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1451, 'attend', 'Attend', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1452, 'absent', 'Absent', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1453, 'roster_empatn', 'Employee Attendance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1454, 'today_crnt_shift', 'Today Current Shift', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1455, 'change_shift_dashboard', 'change shift', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1456, 'sv_changes', 'Save changes', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1457, 'assigned_empl_list', 'Assigned Employee List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1458, 'extra_bpc', 'Extra Bed/Person/Child', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1459, 'additional_charges', 'Additional Charges', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1460, 'special_discount', 'Special Discount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1461, 'restaurant', 'Restaurant', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1462, 'card_number', 'Card Number', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1463, 'cancel_charge', 'Cancel Charge', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1464, 'cancels_reservation', 'Cancel Reservation', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1465, 'total_extra_price', 'Total Extra Price', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1466, 'total_complementary_price', 'Total Complementary Price', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1467, 'reservation_details', 'Reservation Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1468, 'booking_reference', 'Booking Reference', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1469, 'booking_reference_no', 'Booking Reference No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1470, 'room_info', 'Room Info', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1471, 'new_customer', 'New Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1472, 'old_customer', 'Old Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1473, 'mobile_no', 'Mobile No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1474, 'rent', 'Rent', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1475, 'discount_reason', 'Discount Reason', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1476, 'discount_max', 'Discount (Max-100%)', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1477, 'commission', 'Commission (%)', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1478, 'commission_amt', 'Commission Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1479, 'advance_details', 'Advance Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1480, 'payment_mode', 'Payment Mode', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1481, 'account_number', 'Account Number', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1482, 'advance_remarks', 'Advance Remarks', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1483, 'advance_amount', 'Advance Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1484, 'occupant_details', 'Customer Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1485, 'guest_details', 'Guest Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1486, 'country_code', 'Country Code', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1487, 'father_name', 'Father Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1488, 'occupation', 'Occupation', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1489, 'dob', 'DOB', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1490, 'anniversary', 'Anniversary', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1491, 'vip', 'VIP', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1492, 'contact_details', 'Contact Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1493, 'contact_type', 'Contact Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1494, 'country', 'Country', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1495, 'zipcode', 'Zipcode', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1496, 'photo_id_details', 'Identity Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1497, 'photo_id_type', 'Identity Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1498, 'photo_id', 'ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1499, 'photo_id_upload', 'Identity Upload', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1500, 'guest_image', 'Guest Image', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1501, 'front_side', 'Front Side', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1502, 'drag_and_drop', 'Drag and Drop', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1503, 'supports_image', 'Supports JPG, JPEG, PNG, SVG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1504, 'back_side', 'Back Side', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1505, 'occupant_image', 'Customer Image', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1506, 'bed', 'Bed', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1507, 'child', 'Child', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1508, 'amnt', 'Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1509, 'check_in_details', 'Check In Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1510, 'go', 'Go', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1511, 'customer_details', 'Customer Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1512, 'booking_no', 'Booking No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1513, 'email_id', 'Email ID', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1514, 'set_default_customer', 'Set Default Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1515, 'room_rent_details', 'Room Rent Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1516, 'nod', 'NoD', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1517, 'rent_day', 'Rent/ Day', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1518, 'dis_day', 'Dis./ Day', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1519, 'amt_aft_dis', 'Amt. Aft Dis.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1520, 'tot_rent', 'Tot. Rent', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1521, 'tot_amt', 'Tot. Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1522, 'billing_details', 'Billing Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1523, 'room_rent_amt', 'Room Rent Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1524, 'or', 'or', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1525, 'discount_amt', 'Discount Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1526, 'service_charge_amt', 'Service Charge Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1527, 'total_room_rent_amt', 'Total Room Rent Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1528, 'total_room_rent_amt_with_tax', 'Total Room Rent Amt. With Tax', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1529, 'complementary_amt', 'Complementary Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1530, 'extra_bpc_amt', 'Ex. Bed /Per. /Ch. Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1531, 'advance_amt', 'Advance Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1532, 'payable_rent_amt', 'Payable Rent Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1533, 'additional_charge_comments', 'Additional Charge Comments', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1534, 'net_payable_amt', 'Net Payable Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1535, 'credit_amt', 'Credit Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1536, 'special_discount_amt', 'Special Discount Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1537, 'payable_amt', 'Payable Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1538, 'room_posted_bill', 'Room Posted Bill', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1539, 'bill_type', 'Bill Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1540, 'bill_settlement', 'Bill Settlement', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1541, 'cash', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1542, 'card', 'Card', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1543, 'cheque', 'Cheque', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1544, 'online', 'Online', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1545, 'balance_details', 'Balance Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1546, 'remain_amt', 'Remain Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1547, 'collected_amt', 'Collected Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1548, 'change_amt', 'Change Amt', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1549, 'invoiced_from', 'INVOICED FROM', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1550, 'invoiced_to', 'INVOICED TO', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1551, 'details_of_the_guest', 'Details of the Guest', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1552, 'guests_name', 'Guests Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1553, 'aft_dis', 'Aft. Dis', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1554, 'sub_total', 'Subtotal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1555, 'grand_total_inctax', 'Grand Total (Incl.Tax)', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1556, 'authorized_signature', 'Authorized Signature', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1557, 'net_profit', 'Net Profit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1558, 'net_loss', 'Net Loss', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1559, 'liability', 'Liability', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1560, 'cash_at_bank', 'Cash At Bank', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1561, 'refund_charge', 'Refund Charge', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1562, 'home_section_4', 'Home Section 4', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1563, 'image_size', 'Image Size', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1564, 'brand_logo', 'Brand Logo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1565, 'contact_information', 'Contact Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1566, 'terms_and_privacy', 'Terms and Privacy', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1567, 'social_link', 'Social Link', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1568, 'pages_title', 'Pages Title', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1569, 'about_us', 'About Us', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1570, 'contact_us', 'Contact Us', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1571, 'team_members', 'Team Members', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1572, 'counter', 'Counter', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1573, 'team_gallery', 'Team Gallery', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1574, 'slider', 'Slider', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1575, 'home_section_1', 'Home Section 1', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1576, 'home_section_2', 'Home Section 2', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1577, 'home_section_3', 'Home Section 3', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1578, 'room_feature', 'Room Feature', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1579, 'footer', 'Footer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1580, 'map_key', 'Map Key', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1581, 'latitude', 'Latitude', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1582, 'longitude', 'Longitude', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1583, 'price_text', 'Price Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1584, 'powered_by_text', 'Powered By Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1585, 'phrase_update', 'Phrase Update', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1586, 'phrase_list', 'Phrase List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1587, 'image_text', 'Image Text', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1588, 'instragram', 'Instragram', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1589, 'edit_user', 'Edit User', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1590, 'number', 'Number', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1591, 'increment', 'Increment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1592, 'visitors_count', 'Visitors Count', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1593, 'invoice_information', 'Invoice Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1594, 'add_production', 'Add Production', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1595, 'returned_list', 'Returned List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1596, 'promocode_discount', 'Promocode Discount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1597, 'extra', 'Extra', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1598, 'refund_days', 'Refund days', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1599, 'refund_amount', 'Refund Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1600, 'commission_rate', 'Commission Rate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1601, 'total_balance', 'Total Balance', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1602, 'expired', 'Expired', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1603, 'extra_capability', 'Extra Capability', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1604, 'bed_charge', 'Bed Charge', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1605, 'person_charge', 'Person Charge', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1606, 'extra_capacity', 'Extra Capacity', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1607, 'reg_no', 'Reg No', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1608, 'is_active', 'Is Active', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1609, 'tax_name', 'Tax Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1610, 'product_queue', 'Product Queue', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1611, 'laundry_item', 'Laundry Item', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1612, 'destroyed_product_list', 'Destroyed Product List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1613, 'destroyed', 'Destroyed', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1614, 'supplier_payment', 'Supplier Payment', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1615, 'balance_sheet_statement', 'Balance Sheet Statement', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1616, 'cash_flow_statement', 'Cash Flow Statement', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1617, 'statement_of_comprehensive_income', 'Statement of Comprehensive Income', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1618, 'as_on', 'As On', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1619, 'apply_code', 'Apply Code', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1798, 'timezone', 'Time Zone', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1799, 'select_cust_type', 'Select Customer Type', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1800, 'new_cust', 'New Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1801, 'old_cust', 'Old Customer', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1802, 'phone_must_unique', 'Phone Number Must Be Unique', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1803, 'from_time', 'From Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1804, 'to_time', 'To Time', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1805, 'category', 'Category', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1806, 'offer_end_date', 'Offer End Date', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1807, 'varient', 'Varient', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1808, 'remove', 'Remove', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1809, 'payment_info', 'Payment Information', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1810, 'card_holder_name', 'Card Holder Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1811, 'monday', 'Monday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1812, 'tuesday', 'Tuesday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1813, 'wednesday', 'Wednesday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1814, 'thursday', 'Thursday', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1815, 'view_order', 'View Order', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1816, 'payable_amnt', 'Payable amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1817, 'change_amnt', 'Change Amount', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1818, 'avg_qty', 'Ava. Qnty', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1819, 'unitres', 'Unit', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1820, 'dis_pcs', 'Dis/ Pcs', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1821, 'select_num_order', 'Select number of order', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1822, 'table_icon', 'Table Icon', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1823, 'show', 'Show', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1824, 'print', 'Print', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1825, 'close', 'Close', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1826, 'customer_name', 'Customer Name', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1827, 'forgot_password', 'Forgot Password', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1828, 'receover_password', 'Recover Password', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1829, 'enter_code', 'Enter Code', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1830, 'new_pass', 'New Password', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1831, 'y_mail', 'Your Email', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1832, 'lic_pur_key', 'License/Purchase key', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1833, 'autoupdate', 'Autoupdate', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1834, 'list', 'List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1835, 'user_profile', 'User Profile', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1836, 'booking_details', 'Booking Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1837, 'update_profile', 'Update Profile', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1838, 'profile_details', 'Profile Details', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1839, 'do_not_have_an_account', 'Do not have an account', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1840, 'person', 'Person', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1841, 'booked', 'Booked', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1842, 'parking_status', 'Parking Status', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1843, 'rating', 'Rating', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1844, 'problem_list', 'Problem List', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1845, 'solved', 'Solved', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1846, 'is_use_website', 'Is Use website', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1847, 'visible_home', 'Is Home Page', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `malay`, `french`, `german`, `spanish`, `turkish`, `hindi`) VALUES (1848, 'factory_rest', 'Factory rest', NULL, NULL, NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: leave_apply
#

DROP TABLE IF EXISTS `leave_apply`;

CREATE TABLE `leave_apply` (
  `leave_appl_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `leave_type_id` int(2) NOT NULL,
  `apply_strt_date` varchar(20) NOT NULL,
  `apply_end_date` varchar(20) NOT NULL,
  `apply_day` int(11) NOT NULL,
  `leave_aprv_strt_date` varchar(20) NOT NULL,
  `leave_aprv_end_date` varchar(20) NOT NULL,
  `num_aprv_day` varchar(15) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `apply_hard_copy` text DEFAULT NULL,
  `apply_date` varchar(20) NOT NULL,
  `approve_date` varchar(20) NOT NULL,
  `approved_by` varchar(30) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  PRIMARY KEY (`leave_appl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: leave_type
#

DROP TABLE IF EXISTS `leave_type`;

CREATE TABLE `leave_type` (
  `leave_type_id` int(2) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(50) NOT NULL,
  `leave_days` int(2) NOT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `leave_type` (`leave_type_id`, `leave_type`, `leave_days`) VALUES (3, 'Paid Leave', 10);
INSERT INTO `leave_type` (`leave_type_id`, `leave_type`, `leave_days`) VALUES (4, 'Paternity Leave', 45);
INSERT INTO `leave_type` (`leave_type_id`, `leave_type`, `leave_days`) VALUES (5, 'Medical Leave', 7);
INSERT INTO `leave_type` (`leave_type_id`, `leave_type`, `leave_days`) VALUES (6, 'Unpaid Leave', 5);


#
# TABLE STRUCTURE FOR: loan_installment
#

DROP TABLE IF EXISTS `loan_installment`;

CREATE TABLE `loan_installment` (
  `loan_inst_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `loan_id` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `installment_amount` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `received_by` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `installment_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `notes` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`loan_inst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: marital_info
#

DROP TABLE IF EXISTS `marital_info`;

CREATE TABLE `marital_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marital_sta` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: message
#

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: module
#

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: module_permission
#

DROP TABLE IF EXISTS `module_permission`;

CREATE TABLE `module_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_module_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_module_id` (`fk_module_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: notice_board
#

DROP TABLE IF EXISTS `notice_board`;

CREATE TABLE `notice_board` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_descriptiion` text NOT NULL,
  `notice_date` date NOT NULL,
  `notice_type` varchar(50) NOT NULL,
  `notice_by` varchar(50) NOT NULL,
  `notice_attachment` text DEFAULT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: page_title
#

DROP TABLE IF EXISTS `page_title`;

CREATE TABLE `page_title` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `home` text NOT NULL,
  `aboutus` text NOT NULL,
  `contactus` text NOT NULL,
  `gallery` text NOT NULL,
  `roomlist` text NOT NULL,
  `roomdetails` text NOT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `page_title` (`pageid`, `home`, `aboutus`, `contactus`, `gallery`, `roomlist`, `roomdetails`) VALUES (1, 'Welcome to our Hotels', 'About Our Hotels', 'Contact Us', 'Our Gallerys', 'All roomss', 'All roomss');


#
# TABLE STRUCTURE FOR: pay_frequency
#

DROP TABLE IF EXISTS `pay_frequency`;

CREATE TABLE `pay_frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frequency_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: payment_currency
#

DROP TABLE IF EXISTS `payment_currency`;

CREATE TABLE `payment_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(100) NOT NULL,
  `currency_details` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: payment_method
#

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `payment_method_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES (1, 'Card Payment', 0);
INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES (3, 'Paypal', 1);
INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES (4, 'Cash Payment', 0);
INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES (5, 'SSLCommerz', 1);
INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES (6, 'Bank Payment', 0);


#
# TABLE STRUCTURE FOR: paymentsetup
#

DROP TABLE IF EXISTS `paymentsetup`;

CREATE TABLE `paymentsetup` (
  `setupid` int(11) NOT NULL AUTO_INCREMENT,
  `paymentid` int(11) NOT NULL,
  `marchantid` varchar(255) DEFAULT NULL,
  `password` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `Islive` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`setupid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `paymentsetup` (`setupid`, `paymentid`, `marchantid`, `password`, `email`, `currency`, `Islive`, `status`) VALUES (1, 5, 'style5c246d140fefc', 'style5c246d140fefc@ssl', 'shemul.rabbani@gmail.com', 'BDT', 0, 1);
INSERT INTO `paymentsetup` (`setupid`, `paymentid`, `marchantid`, `password`, `email`, `currency`, `Islive`, `status`) VALUES (2, 3, '', '', 'tareq7500personal2@gmail.com', 'USD', 0, 1);


#
# TABLE STRUCTURE FOR: payroll_holiday
#

DROP TABLE IF EXISTS `payroll_holiday`;

CREATE TABLE `payroll_holiday` (
  `payrl_holi_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `start_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `end_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_of_days` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`payrl_holi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `payroll_holiday` (`payrl_holi_id`, `holiday_name`, `start_date`, `end_date`, `no_of_days`, `created_by`, `updated_by`) VALUES (4, 'Dussehra', '2021-09-15', '', '1', '', '');
INSERT INTO `payroll_holiday` (`payrl_holi_id`, `holiday_name`, `start_date`, `end_date`, `no_of_days`, `created_by`, `updated_by`) VALUES (5, 'Vijayadashami', '2021-10-15', '2021-10-15', '1', '', '');


#
# TABLE STRUCTURE FOR: payroll_tax_setup
#

DROP TABLE IF EXISTS `payroll_tax_setup`;

CREATE TABLE `payroll_tax_setup` (
  `tax_setup_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_amount` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `end_amount` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rate` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`tax_setup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: position
#

DROP TABLE IF EXISTS `position`;

CREATE TABLE `position` (
  `pos_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `position_details` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES (1, 'Chef', 'Responsible for the pastry shop in a foodservice establishment. Ensures that the products produced in the pastry shop meet the quality standards in conjunction with the executive chef.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES (2, 'HRM', 'Recruits and hires qualified employees, creates in-house job-training programs, and assists employees with their career needs.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES (3, 'Kitchen manager', 'Supervises and coordinates activities concerning all back-of-the-house operations and personnel, including food preparation, kitchen and storeroom areas.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES (7, 'Accounts', 'Play a key role in every restaurant. ');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES (13, 'Hotel Manager', 'Manage Hotel');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES (14, 'Shift Manager', 'Manage Working Shift');


#
# TABLE STRUCTURE FOR: products
#

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 1,
  `uom_id` int(11) NOT NULL,
  `stock` int(100) DEFAULT 0,
  `used` int(100) DEFAULT 0,
  `destroyed` int(11) NOT NULL DEFAULT 0,
  `reuseable` int(3) NOT NULL DEFAULT 0 COMMENT '0=No,1=Yes',
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`,`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: promocode
#

DROP TABLE IF EXISTS `promocode`;

CREATE TABLE `promocode` (
  `promocodeid` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `promocode` text NOT NULL,
  `discount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`promocodeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: purchase_details
#

DROP TABLE IF EXISTS `purchase_details`;

CREATE TABLE `purchase_details` (
  `detailsid` int(11) NOT NULL AUTO_INCREMENT,
  `purchaseid` int(11) NOT NULL,
  `proid` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unitname` varchar(80) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `totalprice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `purchaseby` int(11) NOT NULL,
  `purchasedate` date NOT NULL,
  `purchaseexpiredate` date DEFAULT NULL,
  PRIMARY KEY (`detailsid`),
  KEY `purchaseid` (`purchaseid`,`proid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: purchase_return
#

DROP TABLE IF EXISTS `purchase_return`;

CREATE TABLE `purchase_return` (
  `preturn_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `po_no` varchar(120) NOT NULL,
  `return_date` date NOT NULL,
  `totalamount` float NOT NULL,
  `totaldiscount` float NOT NULL,
  `return_reason` varchar(250) NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  `updateby` int(11) NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`preturn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: purchase_return_details
#

DROP TABLE IF EXISTS `purchase_return_details`;

CREATE TABLE `purchase_return_details` (
  `preturn_id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_rate` float NOT NULL,
  `store_id` int(11) NOT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: purchaseitem
#

DROP TABLE IF EXISTS `purchaseitem`;

CREATE TABLE `purchaseitem` (
  `purID` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceid` varchar(50) DEFAULT NULL,
  `suplierID` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `details` text DEFAULT NULL,
  `purchasedate` date NOT NULL,
  `purchaseexpiredate` date NOT NULL,
  `savedby` int(11) NOT NULL,
  `status` varchar(3) DEFAULT '0' COMMENT '0=unpaid,1=paid',
  PRIMARY KEY (`purID`),
  KEY `invoiceid` (`invoiceid`,`suplierID`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: rate_type
#

DROP TABLE IF EXISTS `rate_type`;

CREATE TABLE `rate_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: room_image
#

DROP TABLE IF EXISTS `room_image`;

CREATE TABLE `room_image` (
  `room_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `room_imagename` varchar(255) NOT NULL,
  PRIMARY KEY (`room_img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: roomdetails
#

DROP TABLE IF EXISTS `roomdetails`;

CREATE TABLE `roomdetails` (
  `roomid` int(11) NOT NULL AUTO_INCREMENT,
  `roomtype` varchar(255) NOT NULL,
  `roomsize` int(11) NOT NULL,
  `roomsizemesurement` varchar(255) NOT NULL,
  `roomactive` int(11) NOT NULL,
  `bedsno` int(11) NOT NULL,
  `bedstype` int(255) NOT NULL,
  `number_of_star` int(10) DEFAULT 4,
  `roomdescription` varchar(255) NOT NULL,
  `reservecondition` text DEFAULT NULL,
  `roomstatus` int(11) NOT NULL DEFAULT 0,
  `capacity` int(11) NOT NULL,
  `exbedcapability` int(11) NOT NULL DEFAULT 1,
  `child_limit` int(11) DEFAULT 0,
  `rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bedcharge` decimal(10,0) NOT NULL,
  `personcharge` decimal(10,0) NOT NULL,
  PRIMARY KEY (`roomid`),
  KEY `roomtype` (`roomtype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: roomfacilitydetails
#

DROP TABLE IF EXISTS `roomfacilitydetails`;

CREATE TABLE `roomfacilitydetails` (
  `facilityid` int(11) NOT NULL AUTO_INCREMENT,
  `facilitytypeid` int(11) NOT NULL,
  `facilitytitle` varchar(255) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`facilityid`),
  KEY `facilitytypeid` (`facilitytypeid`),
  KEY `facilitytypeid_2` (`facilitytypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: roomfacilitytype
#

DROP TABLE IF EXISTS `roomfacilitytype`;

CREATE TABLE `roomfacilitytype` (
  `facilitytypeid` int(11) NOT NULL AUTO_INCREMENT,
  `facilitytypetitle` varchar(255) NOT NULL,
  PRIMARY KEY (`facilitytypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: roomfaility_ref_accomodation
#

DROP TABLE IF EXISTS `roomfaility_ref_accomodation`;

CREATE TABLE `roomfaility_ref_accomodation` (
  `accomodationid` int(11) NOT NULL AUTO_INCREMENT,
  `facilititypeid` int(11) NOT NULL,
  `facilityid` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`accomodationid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: roomsizemesurement
#

DROP TABLE IF EXISTS `roomsizemesurement`;

CREATE TABLE `roomsizemesurement` (
  `mesurementid` int(11) NOT NULL AUTO_INCREMENT,
  `roommesurementitle` varchar(255) NOT NULL,
  PRIMARY KEY (`mesurementid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (10, 'Double');
INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (11, 'Triple');
INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (12, 'Quad');
INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (13, 'Queen');
INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (14, 'King');
INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (15, 'Twin');
INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (16, 'Double-Double');
INSERT INTO `roomsizemesurement` (`mesurementid`, `roommesurementitle`) VALUES (17, 'Executive Suite');


#
# TABLE STRUCTURE FOR: salary_setup_header
#

DROP TABLE IF EXISTS `salary_setup_header`;

CREATE TABLE `salary_setup_header` (
  `s_s_h_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `salary_payable` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `absent_deduct` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tax_manager` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`s_s_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: salary_sheet_generate
#

DROP TABLE IF EXISTS `salary_sheet_generate`;

CREATE TABLE `salary_sheet_generate` (
  `ssg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gdate` varchar(20) DEFAULT NULL,
  `start_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `end_date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `generate_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: salary_type
#

DROP TABLE IF EXISTS `salary_type`;

CREATE TABLE `salary_type` (
  `salary_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sal_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `emp_sal_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `default_amount` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`salary_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: sampledata
#

DROP TABLE IF EXISTS `sampledata`;

CREATE TABLE `sampledata` (
  `brand` varchar(30) NOT NULL,
  `dealer_name` varchar(30) NOT NULL,
  `authorized` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `website_addr` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: schdule_purchse_info
#

DROP TABLE IF EXISTS `schdule_purchse_info`;

CREATE TABLE `schdule_purchse_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_key` varchar(100) DEFAULT NULL,
  `domain` varchar(200) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `port` varchar(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# TABLE STRUCTURE FOR: sec_menu_item
#

DROP TABLE IF EXISTS `sec_menu_item`;

CREATE TABLE `sec_menu_item` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(200) DEFAULT NULL,
  `page_url` varchar(250) DEFAULT NULL,
  `module` varchar(200) DEFAULT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `is_report` tinyint(1) DEFAULT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (1, 'c_o_a', 'treeview', 'accounts', 0, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (2, 'debit_voucher', 'debit_voucher', 'accounts', 0, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (3, 'credit_voucher', 'credit_voucher', 'accounts', 0, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (4, 'contra_voucher', 'contra_voucher', 'accounts', 0, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (5, 'journal_voucher', 'journal_voucher', 'accounts', 0, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (6, 'voucher_approval', 'voucher_approval', 'accounts', 0, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (7, 'account_report', '', 'accounts', 0, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (8, 'voucher_report', 'coa', 'accounts', 7, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (9, 'cash_book', 'cash_book', 'accounts', 7, 0, 1, '2019-06-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (10, 'bank_book', 'bank_book', 'accounts', 7, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (11, 'general_ledger', 'general_ledger', 'accounts', 7, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (12, 'trial_balance', 'trial_balance', 'accounts', 7, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (13, 'profit_loss', 'profit_loss_report', 'accounts', 7, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (14, 'cash_flow', 'cash_flow_report', 'accounts', 7, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (15, 'coa_print', 'coa_print', 'accounts', 7, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (16, 'hrm', '', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (17, 'attendance', 'Home', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (18, 'atn_form', 'atnview', 'hrm', 17, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (19, 'atn_report', 'attendance_list', 'hrm', 17, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (20, 'award', 'Award_controller', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (21, 'new_award', 'create_award', 'hrm', 20, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (22, 'circularprocess', 'Candidate', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (23, 'add_canbasic_info', 'caninfo_create', 'hrm', 22, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (24, 'can_basicinfo_list', 'canInfoview', 'hrm', 22, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (25, 'candidate_basic_info', 'Candidate_select', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (26, 'candidate_shortlist', 'shortlist_form', 'hrm', 25, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (27, 'candidate_interview', 'interview_form', 'hrm', 25, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (28, 'candidate_selection', 'selection_form', 'hrm', 25, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (29, 'department', 'Department_controller', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (30, 'departmentfrm', 'create_dept', 'hrm', 29, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (31, 'division', 'Division_controller', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (32, 'add_division', 'division_form', 'hrm', 31, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (33, 'division_list', '', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (34, 'position', 'position_form', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (35, 'employee', '', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (36, 'add_employee', 'employ_form', 'hrm', 35, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (37, 'manage_employee', 'employee_view', 'hrm', 35, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (38, 'emp_performance', 'emp_performance_form', 'hrm', 35, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (39, 'emp_sal_payment', 'paymentview', 'hrm', 35, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (40, 'leave', 'leave', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (41, 'weekly_holiday', 'weeklyform', 'hrm', 40, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (42, 'holiday', 'holiday_form', 'hrm', 40, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (43, 'others_leave_application', 'others_leave', 'hrm', 40, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (44, 'add_leave_type', 'leave_type_form', 'hrm', 40, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (45, 'leave_application', 'others_leave', 'hrm', 40, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (46, 'loan', 'loan', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (47, 'loan_grand', 'create_grandloan', 'hrm', 46, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (48, 'loan_installment', 'create_installment', 'hrm', 46, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (49, 'manage_installment', 'installmentView', 'hrm', 46, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (50, 'manage_granted_loan', 'loan_view', 'hrm', 46, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (51, 'loan_report', 'loan_report', 'hrm', 46, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (52, 'payroll', 'payroll', 'hrm', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (53, 'salary_type_setup', 'create_salary_setup', 'hrm', 52, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (54, 'manage_salary_setup', 'emp_salary_setup_view', 'hrm', 52, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (55, 'salary_setup', 'create_s_setup', 'hrm', 52, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (56, 'manage_salary_type', 'salary_setup_view', 'hrm', 52, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (57, 'salary_generate', 'create_salary_generate', 'hrm', 52, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (58, 'manage_salary_generate', 'salary_generate_view', 'hrm', 52, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (59, 'purchase_item', 'index', 'purchase', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (60, 'purchase_add', 'create', 'purchase', 59, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (61, 'purchase_return', 'return_form', 'purchase', 59, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (62, 'return_invoice', 'return_invoice', 'purchase', 59, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (63, 'report', 'report', 'reports', NULL, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (64, 'purchase_report', 'index', 'reports', 63, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (65, 'paymentmethod', '', 'payment_setting', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (66, 'paymentmethod_list', 'index', 'payment_setting', 65, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (67, 'payment_add', 'create', 'payment_setting', 66, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (68, 'customer', 'customer_info', 'customer', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (69, 'customer_add', 'create', 'customer', 68, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (70, 'booking_report', 'index', 'reports', 63, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (71, 'paymentmethod_setup', 'paymentsetup', 'payment_setting', 65, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (72, 'room_facilities', 'index', 'room_facilities', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (73, 'faciliti_details_list', 'room_facilitidetails', 'room_facilities', 72, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (74, 'roomsize_list', 'room_size', 'room_facilities', 72, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (75, 'room_reservation', 'room_reservation', 'room_reservation', 0, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (76, 'bed_list', 'index', 'room_setting', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (77, 'starclass_list', 'starclass', 'room_setting', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (78, 'bookingtype_list', 'booking_type', 'room_setting', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (79, 'floorplan_list', 'floorplan', 'room_setting', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (80, 'room_list', 'room_details', 'room_setting', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (81, 'room_image', 'room_images', 'room_setting', 0, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (82, 'stock_report', 'stockreport', 'reports', 63, 0, 1, '2019-07-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (83, 'customer_list', 'index', 'customer', 68, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (84, 'units', NULL, 'units', 0, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (85, 'unit_list', 'index', 'units', 84, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (86, 'ingradient_list', 'index', 'units', 84, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (87, 'supplier_list', 'index', 'units', 84, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (88, 'booking_list', 'index', 'room_reservation', 75, 0, 1, '2019-06-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (89, 'faciliti_list', NULL, 'room_facilities', 72, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (91, 'booking_source', 'b_ty_details', 'room_setting', 0, 0, 1, '2021-06-06 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (96, 'wakeup_call_list', 'wakeup_call_list', 'customer', 68, 0, 1, '2021-06-06 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (97, 'categorylist', 'categorylist', 'units', 84, 0, 0, '2021-06-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (110, 'complementary', 'complementary', 'room_setting', 0, 0, 1, '2021-07-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (113, 'guest_list', 'guestlist', 'customer', 68, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (116, 'tax_management', 'tax-management', 'tax_management', 0, 0, 1, '2021-08-21 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (117, 'tax_list', 'tax-list', 'tax_management', 116, 0, 1, '2021-08-21 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (119, 'destroyed_list', 'Destroyed-list', 'units', 84, 0, 1, '2021-08-23 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (155, 'balance_sheet', 'balance-sheet', 'accounts', 7, 0, 1, '2021-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (156, 'financial_year', 'financial-year', 'accounts', 7, 0, 1, '2021-10-11 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (157, 'financial_year_end', 'financial-year-end', 'accounts', 7, 0, 1, '2021-10-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (158, 'opening_balance', 'opening-balance', 'accounts', 7, 0, 1, '2021-10-13 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (160, 'room_status', 'room-status', 'room_reservation', 75, 0, 1, '2021-10-25 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (165, 'promocode', 'promocode', 'room_setting', 0, 0, 1, '2021-11-07 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (202, 'checkin', 'checkin', 'room_reservation', 75, 0, 1, '2021-10-25 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES (203, 'checkout', 'checkout', 'room_reservation', 75, 0, 1, '2021-10-25 00:00:00');


#
# TABLE STRUCTURE FOR: sec_role_permission
#

DROP TABLE IF EXISTS `sec_role_permission`;

CREATE TABLE `sec_role_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_access` tinyint(1) NOT NULL,
  `can_create` tinyint(1) NOT NULL,
  `can_edit` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2789 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('411', 12, 1, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('412', 12, 2, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('413', 12, 3, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('414', 12, 4, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('415', 12, 5, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('416', 12, 6, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('417', 12, 7, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('418', 12, 8, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('419', 12, 9, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('420', 12, 10, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('421', 12, 11, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('422', 12, 12, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('423', 12, 13, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('424', 12, 14, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('425', 12, 15, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('426', 12, 68, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('427', 12, 69, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('428', 12, 16, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('429', 12, 17, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('430', 12, 18, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('431', 12, 19, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('432', 12, 20, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('433', 12, 21, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('434', 12, 22, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('435', 12, 23, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('436', 12, 24, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('437', 12, 25, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('438', 12, 26, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('439', 12, 27, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('440', 12, 28, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('441', 12, 29, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('442', 12, 30, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('443', 12, 31, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('444', 12, 32, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('445', 12, 33, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('446', 12, 34, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('447', 12, 35, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('448', 12, 36, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('449', 12, 37, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('450', 12, 38, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('451', 12, 39, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('452', 12, 40, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('453', 12, 41, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('454', 12, 42, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('455', 12, 43, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('456', 12, 44, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('457', 12, 45, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('458', 12, 46, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('459', 12, 47, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('460', 12, 48, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('461', 12, 49, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('462', 12, 50, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('463', 12, 51, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('464', 12, 52, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('465', 12, 53, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('466', 12, 54, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('467', 12, 55, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('468', 12, 56, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('469', 12, 57, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('470', 12, 58, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('471', 12, 65, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('472', 12, 66, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('473', 12, 67, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('474', 12, 71, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('475', 12, 59, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('476', 12, 60, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('477', 12, 61, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('478', 12, 62, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('479', 12, 63, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('480', 12, 64, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('481', 12, 70, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('482', 12, 82, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('483', 12, 72, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('484', 12, 73, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('485', 12, 74, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('486', 12, 75, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('487', 12, 76, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('488', 12, 77, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('489', 12, 78, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('490', 12, 79, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('491', 12, 80, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('492', 12, 81, 0, 0, 0, 0, 1, '2020-11-29 01:12:42');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('493', 7, 1, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('494', 7, 2, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('495', 7, 3, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('496', 7, 4, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('497', 7, 5, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('498', 7, 6, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('499', 7, 7, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('500', 7, 8, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('501', 7, 9, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('502', 7, 10, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('503', 7, 11, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('504', 7, 12, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('505', 7, 13, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('506', 7, 14, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('507', 7, 15, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('508', 7, 68, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('509', 7, 69, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('510', 7, 16, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('511', 7, 17, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('512', 7, 18, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('513', 7, 19, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('514', 7, 20, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('515', 7, 21, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('516', 7, 22, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('517', 7, 23, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('518', 7, 24, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('519', 7, 25, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('520', 7, 26, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('521', 7, 27, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('522', 7, 28, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('523', 7, 29, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('524', 7, 30, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('525', 7, 31, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('526', 7, 32, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('527', 7, 33, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('528', 7, 34, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('529', 7, 35, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('530', 7, 36, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('531', 7, 37, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('532', 7, 38, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('533', 7, 39, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('534', 7, 40, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('535', 7, 41, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('536', 7, 42, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('537', 7, 43, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('538', 7, 44, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('539', 7, 45, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('540', 7, 46, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('541', 7, 47, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('542', 7, 48, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('543', 7, 49, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('544', 7, 50, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('545', 7, 51, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('546', 7, 52, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('547', 7, 53, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('548', 7, 54, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('549', 7, 55, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('550', 7, 56, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('551', 7, 57, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('552', 7, 58, 0, 0, 0, 0, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('553', 7, 65, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('554', 7, 66, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('555', 7, 67, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('556', 7, 71, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('557', 7, 59, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('558', 7, 60, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('559', 7, 61, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('560', 7, 62, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('561', 7, 63, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('562', 7, 64, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('563', 7, 70, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('564', 7, 82, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('565', 7, 72, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('566', 7, 73, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('567', 7, 74, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('568', 7, 75, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('569', 7, 76, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('570', 7, 77, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('571', 7, 78, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('572', 7, 79, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('573', 7, 80, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('574', 7, 81, 1, 1, 1, 1, 1, '2020-12-21 07:01:16');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2458', 15, 1, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2459', 15, 2, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2460', 15, 3, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2461', 15, 4, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2462', 15, 5, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2463', 15, 6, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2464', 15, 7, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2465', 15, 8, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2466', 15, 9, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2467', 15, 10, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2468', 15, 11, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2469', 15, 12, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2470', 15, 13, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2471', 15, 14, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2472', 15, 15, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2473', 15, 68, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2474', 15, 69, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2475', 15, 83, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2476', 15, 16, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2477', 15, 17, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2478', 15, 18, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2479', 15, 19, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2480', 15, 20, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2481', 15, 21, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2482', 15, 22, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2483', 15, 23, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2484', 15, 24, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2485', 15, 25, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2486', 15, 26, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2487', 15, 27, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2488', 15, 28, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2489', 15, 29, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2490', 15, 30, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2491', 15, 31, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2492', 15, 32, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2493', 15, 33, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2494', 15, 34, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2495', 15, 35, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2496', 15, 36, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2497', 15, 37, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2498', 15, 38, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2499', 15, 39, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2500', 15, 40, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2501', 15, 41, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2502', 15, 42, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2503', 15, 43, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2504', 15, 44, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2505', 15, 45, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2506', 15, 46, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2507', 15, 47, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2508', 15, 48, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2509', 15, 49, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2510', 15, 50, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2511', 15, 51, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2512', 15, 52, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2513', 15, 53, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2514', 15, 54, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2515', 15, 55, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2516', 15, 56, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2517', 15, 57, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2518', 15, 58, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2519', 15, 65, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2520', 15, 66, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2521', 15, 67, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2522', 15, 71, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2523', 15, 59, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2524', 15, 60, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2525', 15, 61, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2526', 15, 62, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2527', 15, 63, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2528', 15, 64, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2529', 15, 70, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2530', 15, 82, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2531', 15, 72, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2532', 15, 73, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2533', 15, 74, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2534', 15, 89, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2535', 15, 75, 1, 1, 1, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2536', 15, 88, 1, 1, 1, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2537', 15, 76, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2538', 15, 77, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2539', 15, 78, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2540', 15, 79, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2541', 15, 80, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2542', 15, 81, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2543', 15, 84, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2544', 15, 85, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2545', 15, 86, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2546', 15, 87, 0, 0, 0, 0, 1, '2021-02-08 05:06:37');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2547', 14, 1, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2548', 14, 2, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2549', 14, 3, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2550', 14, 4, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2551', 14, 5, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2552', 14, 6, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2553', 14, 7, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2554', 14, 8, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2555', 14, 9, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2556', 14, 10, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2557', 14, 11, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2558', 14, 12, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2559', 14, 13, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2560', 14, 14, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2561', 14, 15, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2562', 14, 68, 1, 1, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2563', 14, 69, 1, 1, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2564', 14, 83, 1, 1, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2565', 14, 16, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2566', 14, 17, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2567', 14, 18, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2568', 14, 19, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2569', 14, 20, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2570', 14, 21, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2571', 14, 22, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2572', 14, 23, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2573', 14, 24, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2574', 14, 25, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2575', 14, 26, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2576', 14, 27, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2577', 14, 28, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2578', 14, 29, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2579', 14, 30, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2580', 14, 31, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2581', 14, 32, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2582', 14, 33, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2583', 14, 34, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2584', 14, 35, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2585', 14, 36, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2586', 14, 37, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2587', 14, 38, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2588', 14, 39, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2589', 14, 40, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2590', 14, 41, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2591', 14, 42, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2592', 14, 43, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2593', 14, 44, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2594', 14, 45, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2595', 14, 46, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2596', 14, 47, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2597', 14, 48, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2598', 14, 49, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2599', 14, 50, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2600', 14, 51, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2601', 14, 52, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2602', 14, 53, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2603', 14, 54, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2604', 14, 55, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2605', 14, 56, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2606', 14, 57, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2607', 14, 58, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2608', 14, 65, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2609', 14, 66, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2610', 14, 67, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2611', 14, 71, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2612', 14, 59, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2613', 14, 60, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2614', 14, 61, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2615', 14, 62, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2616', 14, 63, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2617', 14, 64, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2618', 14, 70, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2619', 14, 82, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2620', 14, 72, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2621', 14, 73, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2622', 14, 74, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2623', 14, 89, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2624', 14, 75, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2625', 14, 88, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2626', 14, 76, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2627', 14, 77, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2628', 14, 78, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2629', 14, 79, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2630', 14, 80, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2631', 14, 81, 0, 0, 0, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2632', 14, 84, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2633', 14, 85, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2634', 14, 86, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2635', 14, 87, 1, 1, 1, 0, 1, '2021-02-08 05:13:35');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2636', 16, 1, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2637', 16, 2, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2638', 16, 3, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2639', 16, 4, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2640', 16, 5, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2641', 16, 6, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2642', 16, 7, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2643', 16, 8, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2644', 16, 9, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2645', 16, 10, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2646', 16, 11, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2647', 16, 12, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2648', 16, 13, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2649', 16, 14, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2650', 16, 15, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2651', 16, 68, 1, 1, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2652', 16, 69, 1, 1, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2653', 16, 83, 1, 1, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2654', 16, 96, 1, 1, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2655', 16, 113, 1, 1, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2656', 16, 119, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2657', 16, 108, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2658', 16, 109, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2659', 16, 111, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2660', 16, 112, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2661', 16, 92, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2662', 16, 93, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2663', 16, 94, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2664', 16, 95, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2665', 16, 114, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2666', 16, 115, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2667', 16, 118, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2668', 16, 120, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2669', 16, 121, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2670', 16, 122, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2671', 16, 16, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2672', 16, 17, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2673', 16, 18, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2674', 16, 19, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2675', 16, 20, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2676', 16, 21, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2677', 16, 22, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2678', 16, 23, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2679', 16, 24, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2680', 16, 25, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2681', 16, 26, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2682', 16, 27, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2683', 16, 28, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2684', 16, 29, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2685', 16, 30, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2686', 16, 31, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2687', 16, 32, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2688', 16, 33, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2689', 16, 34, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2690', 16, 35, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2691', 16, 36, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2692', 16, 37, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2693', 16, 38, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2694', 16, 39, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2695', 16, 40, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2696', 16, 41, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2697', 16, 42, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2698', 16, 43, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2699', 16, 44, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2700', 16, 45, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2701', 16, 46, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2702', 16, 47, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2703', 16, 48, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2704', 16, 49, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2705', 16, 50, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2706', 16, 51, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2707', 16, 52, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2708', 16, 53, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2709', 16, 54, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2710', 16, 55, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2711', 16, 56, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2712', 16, 57, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2713', 16, 58, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2714', 16, 105, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2715', 16, 106, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2716', 16, 107, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2717', 16, 140, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2718', 16, 141, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2719', 16, 142, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2720', 16, 143, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2721', 16, 144, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2722', 16, 145, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2723', 16, 146, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2724', 16, 147, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2725', 16, 148, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2726', 16, 149, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2727', 16, 150, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2728', 16, 151, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2729', 16, 152, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2730', 16, 153, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2731', 16, 154, 1, 1, 1, 1, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2732', 16, 123, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2733', 16, 124, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2734', 16, 125, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2735', 16, 126, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2736', 16, 127, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2737', 16, 128, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2738', 16, 129, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2739', 16, 130, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2740', 16, 131, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2741', 16, 132, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2742', 16, 133, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2743', 16, 134, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2744', 16, 135, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2745', 16, 136, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2746', 16, 137, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2747', 16, 138, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2748', 16, 139, 1, 0, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2749', 16, 65, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2750', 16, 66, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2751', 16, 67, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2752', 16, 71, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2753', 16, 98, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2754', 16, 99, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2755', 16, 100, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2756', 16, 101, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2757', 16, 102, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2758', 16, 104, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2759', 16, 59, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2760', 16, 60, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2761', 16, 61, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2762', 16, 62, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2763', 16, 63, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2764', 16, 64, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2765', 16, 70, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2766', 16, 82, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2767', 16, 72, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2768', 16, 73, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2769', 16, 74, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2770', 16, 89, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2771', 16, 75, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2772', 16, 88, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2773', 16, 76, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2774', 16, 77, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2775', 16, 78, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2776', 16, 79, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2777', 16, 80, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2778', 16, 81, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2779', 16, 91, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2780', 16, 103, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2781', 16, 110, 0, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2782', 16, 117, 1, 1, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2783', 16, 116, 1, 1, 1, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2784', 16, 84, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2785', 16, 85, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2786', 16, 86, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2787', 16, 87, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('2788', 16, 97, 1, 0, 0, 0, 1, '2021-09-13 02:19:50');


#
# TABLE STRUCTURE FOR: sec_role_tbl
#

DROP TABLE IF EXISTS `sec_role_tbl`;

CREATE TABLE `sec_role_tbl` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` text NOT NULL,
  `role_description` text NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `role_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES (7, 'Manager ', 'Manager Role list.', 1, '2019-11-17 11:46:11', 1);
INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES (12, 'Cashier', 'Cashier', 1, '2020-11-29 01:12:42', 1);
INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES (14, 'Moderator', 'New Role Permission', 1, '2021-01-10 06:31:46', 1);
INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES (15, 'Booking', 'Hotel booking', 1, '2021-01-10 09:23:15', 1);
INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES (16, 'Manager In-Charge', 'Should get access to all operation', 1, '2021-09-13 02:19:50', 1);


#
# TABLE STRUCTURE FOR: sec_user_access_tbl
#

DROP TABLE IF EXISTS `sec_user_access_tbl`;

CREATE TABLE `sec_user_access_tbl` (
  `role_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_role_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (7, 7, 4);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (9, 1, 177);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (10, 1, 3);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (11, 8, 3);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (12, 1, 3);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (13, 1, 3);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (14, 1, 3);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (19, 7, 180);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (24, 14, 193);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (28, 15, 194);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (30, 14, 2);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (32, 15, 197);
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES (33, 16, 19);


#
# TABLE STRUCTURE FOR: setting
#

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `storename` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `splash_logo` varchar(255) NOT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `vat` int(11) NOT NULL DEFAULT 0,
  `isvatnumshow` int(11) DEFAULT 0,
  `vattinno` varchar(30) DEFAULT NULL,
  `servicecharge` int(11) NOT NULL DEFAULT 0,
  `discount_type` int(11) NOT NULL DEFAULT 0 COMMENT '0=amount,1=percent',
  `service_chargeType` int(11) NOT NULL DEFAULT 0 COMMENT '0=amount,1=percent',
  `discountrate` decimal(19,3) NOT NULL DEFAULT 0.000,
  `country` varchar(100) DEFAULT NULL,
  `map_key` varchar(255) DEFAULT NULL,
  `latitude` double(10,4) DEFAULT NULL,
  `longitude` double(10,4) DEFAULT NULL,
  `currency` int(11) DEFAULT 0,
  `language` varchar(100) DEFAULT NULL,
  `timezone` varchar(150) NOT NULL,
  `checkintime` time NOT NULL,
  `checkouttime` time NOT NULL,
  `dateformat` text NOT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `pricetxt` text DEFAULT NULL,
  `powerbytxt` text DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `top_offer_visible_status` int(1) DEFAULT 0,
  `use_web_status` int(1) DEFAULT 0,
  `blog_offer_visible_status` int(1) DEFAULT 0,
  `home_about_visible_status` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `setting` (`id`, `title`, `storename`, `address`, `email`, `phone`, `logo`, `splash_logo`, `favicon`, `vat`, `isvatnumshow`, `vattinno`, `servicecharge`, `discount_type`, `service_chargeType`, `discountrate`, `country`, `map_key`, `latitude`, `longitude`, `currency`, `language`, `timezone`, `checkintime`, `checkouttime`, `dateformat`, `site_align`, `pricetxt`, `powerbytxt`, `footer_text`, `top_offer_visible_status`, `use_web_status`, `blog_offer_visible_status`, `home_about_visible_status`) VALUES (2, 'Xain Hotel', 'Resort & Spa', 'United States, America', 'atrgworld@gmail.com', '00923244796787', '', '', '', 2, 1, NULL, 7, 1, 1, '0.000', '', 'AIzaSyB-EEPxbay_aFpp3jcFXpjyPQcVQUJ2pp0', '23.8311', '90.4243', 2, 'english', 'Asia/Dhaka', '12:00:00', '10:00:00', '', 'LTR', 'The crossed-out prices you see are based on prices currently being quoted by the property for a 30-day window around your check-in date. To ', 'Powered By: BDTASK ', '2021Â©Copyright', 0, 1, 0, 0);


#
# TABLE STRUCTURE FOR: sms_configuration
#

DROP TABLE IF EXISTS `sms_configuration`;

CREATE TABLE `sms_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `gateway` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sms_from` varchar(200) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `sms_configuration` (`id`, `link`, `gateway`, `user_name`, `password`, `sms_from`, `userid`, `status`) VALUES (3, 'https://www.budgetsms.net/', 'budgetsms', 'user1', '1e753da74', 'budgetsms', '21547', 0);


#
# TABLE STRUCTURE FOR: sms_template
#

DROP TABLE IF EXISTS `sms_template`;

CREATE TABLE `sms_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `default_status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `sms_template` (`id`, `template_name`, `message`, `type`, `status`, `default_status`, `created_at`, `updated_at`) VALUES (1, 'one', 'your Order {id} is cancel for some reason.', 'Cancel', 0, 0, '2021-10-24 16:57:48', '0000-00-00 00:00:00');
INSERT INTO `sms_template` (`id`, `template_name`, `message`, `type`, `status`, `default_status`, `created_at`, `updated_at`) VALUES (2, 'two', 'your order {id} is completed', 'CompleteOrder', 0, 1, '2019-01-02 19:58:19', '0000-00-00 00:00:00');
INSERT INTO `sms_template` (`id`, `template_name`, `message`, `type`, `status`, `default_status`, `created_at`, `updated_at`) VALUES (3, 'three', 'your order {id} is processing', 'Processing', 0, 1, '2020-03-08 01:48:29', '0000-00-00 00:00:00');
INSERT INTO `sms_template` (`id`, `template_name`, `message`, `type`, `status`, `default_status`, `created_at`, `updated_at`) VALUES (8, 'four', 'Your Order Has been Placed Successfully.', 'Neworder', 1, 1, '2020-03-08 01:48:33', '0000-00-00 00:00:00');


#
# TABLE STRUCTURE FOR: starclass
#

DROP TABLE IF EXISTS `starclass`;

CREATE TABLE `starclass` (
  `starcalssid` int(11) NOT NULL AUTO_INCREMENT,
  `starclassname` varchar(50) NOT NULL,
  PRIMARY KEY (`starcalssid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: subscribe_emaillist
#

DROP TABLE IF EXISTS `subscribe_emaillist`;

CREATE TABLE `subscribe_emaillist` (
  `emailid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `dateinsert` datetime NOT NULL,
  PRIMARY KEY (`emailid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: supplier
#

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `supid` int(11) NOT NULL AUTO_INCREMENT,
  `suplier_code` varchar(255) NOT NULL,
  `supName` varchar(100) NOT NULL,
  `supEmail` varchar(100) NOT NULL,
  `supMobile` varchar(50) NOT NULL,
  `supAddress` text NOT NULL,
  `total_amount` decimal(15,2) DEFAULT 0.00,
  `paid_amount` decimal(15,2) DEFAULT 0.00,
  `due_amount` decimal(15,2) DEFAULT 0.00,
  PRIMARY KEY (`supid`),
  KEY `suplier_code` (`suplier_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: synchronizer_setting
#

DROP TABLE IF EXISTS `synchronizer_setting`;

CREATE TABLE `synchronizer_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_booking_type_info
#

DROP TABLE IF EXISTS `tbl_booking_type_info`;

CREATE TABLE `tbl_booking_type_info` (
  `btypeinfoid` int(11) NOT NULL AUTO_INCREMENT,
  `booking_type` varchar(200) NOT NULL,
  `booking_sourse` varchar(200) NOT NULL,
  `commissionrate` decimal(10,0) NOT NULL DEFAULT 2,
  `balance` float NOT NULL DEFAULT 0,
  `paid_amount` decimal(10,0) NOT NULL DEFAULT 0,
  `due_amount` decimal(10,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`btypeinfoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# TABLE STRUCTURE FOR: tbl_category
#

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` text DEFAULT NULL,
  `status` int(3) DEFAULT NULL COMMENT '0=inactive,1=active',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_category` (`category_id`, `categoryname`, `status`) VALUES (1, 'Beauty Items', 1);
INSERT INTO `tbl_category` (`category_id`, `categoryname`, `status`) VALUES (3, 'Glass Items', 1);
INSERT INTO `tbl_category` (`category_id`, `categoryname`, `status`) VALUES (4, 'Tasty Items', 1);


#
# TABLE STRUCTURE FOR: tbl_complementary
#

DROP TABLE IF EXISTS `tbl_complementary`;

CREATE TABLE `tbl_complementary` (
  `complementary_id` int(11) NOT NULL AUTO_INCREMENT,
  `roomtype` text DEFAULT NULL,
  `complementaryname` text DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `status` int(3) NOT NULL COMMENT '0=inactive,1=active',
  PRIMARY KEY (`complementary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_country
#

DROP TABLE IF EXISTS `tbl_country`;

CREATE TABLE `tbl_country` (
  `countryid` int(11) NOT NULL AUTO_INCREMENT,
  `countryname` varchar(70) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`countryid`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (1, 'Afghanistan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (2, 'Aland Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (3, 'Albania', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (4, 'Algeria', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (5, 'American Samoa', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (6, 'Andorra', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (7, 'Angola', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (8, 'Anguilla', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (9, 'Antarctica', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (10, 'Antigua and Barbuda', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (11, 'Argentina', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (12, 'Armenia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (13, 'Aruba', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (14, 'Australia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (15, 'Austria', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (16, 'Azerbaijan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (17, 'Bahamas', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (18, 'Bahrain', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (19, 'Bangladesh', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (20, 'Barbados', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (21, 'Belarus', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (22, 'Belgium', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (23, 'Belize', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (24, 'Benin', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (25, 'Bermuda', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (26, 'Bhutan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (27, 'Bolivia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (28, 'Bonaire, Sint Eustatius and Saba', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (29, 'Bosnia and Herzegovina', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (30, 'Botswana', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (31, 'Bouvet Island', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (32, 'Brazil', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (33, 'British Indian Ocean Territory', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (34, 'Brunei Darussalam', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (35, 'Bulgaria', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (36, 'Burkina Faso', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (37, 'Burundi', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (38, 'Cambodia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (39, 'Cameroon', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (40, 'Canada', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (41, 'Cape Verde', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (42, 'Cayman Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (43, 'Central African Republic', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (44, 'Chad', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (45, 'Chile', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (46, 'China', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (47, 'Christmas Island', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (48, 'Cocos (Keeling) Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (49, 'Colombia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (50, 'Comoros', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (51, 'Congo', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (52, 'Congo, Democratic Republic of the Congo', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (53, 'Cook Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (54, 'Costa Rica', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (55, 'Cote D\'Ivoire', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (56, 'Croatia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (57, 'Cuba', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (58, 'Curacao', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (59, 'Cyprus', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (60, 'Czech Republic', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (61, 'Denmark', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (62, 'Djibouti', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (63, 'Dominica', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (64, 'Dominican Republic', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (65, 'Ecuador', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (66, 'Egypt', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (67, 'El Salvador', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (68, 'Equatorial Guinea', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (69, 'Eritrea', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (70, 'Estonia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (71, 'Ethiopia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (72, 'Falkland Islands (Malvinas)', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (73, 'Faroe Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (74, 'Fiji', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (75, 'Finland', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (76, 'France', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (77, 'French Guiana', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (78, 'French Polynesia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (79, 'French Southern Territories', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (80, 'Gabon', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (81, 'Gambia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (82, 'Georgia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (83, 'Germany', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (84, 'Ghana', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (85, 'Gibraltar', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (86, 'Greece', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (87, 'Greenland', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (88, 'Grenada', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (89, 'Guadeloupe', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (90, 'Guam', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (91, 'Guatemala', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (92, 'Guernsey', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (93, 'Guinea', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (94, 'Guinea-Bissau', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (95, 'Guyana', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (96, 'Haiti', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (97, 'Heard Island and Mcdonald Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (98, 'Holy See (Vatican City State)', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (99, 'Honduras', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (100, 'Hong Kong', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (101, 'Hungary', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (102, 'Iceland', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (103, 'India', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (104, 'Indonesia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (105, 'Iran, Islamic Republic of', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (106, 'Iraq', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (107, 'Ireland', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (108, 'Isle of Man', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (109, 'Israel', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (110, 'Italy', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (111, 'Jamaica', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (112, 'Japan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (113, 'Jersey', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (114, 'Jordan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (115, 'Kazakhstan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (116, 'Kenya', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (117, 'Kiribati', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (118, 'Korea, Democratic People\'s Republic of', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (119, 'Korea, Republic of', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (120, 'Kosovo', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (121, 'Kuwait', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (122, 'Kyrgyzstan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (123, 'Lao People\'s Democratic Republic', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (124, 'Latvia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (125, 'Lebanon', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (126, 'Lesotho', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (127, 'Liberia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (128, 'Libyan Arab Jamahiriya', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (129, 'Liechtenstein', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (130, 'Lithuania', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (131, 'Luxembourg', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (132, 'Macao', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (133, 'Macedonia, the Former Yugoslav Republic of', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (134, 'Madagascar', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (135, 'Malawi', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (136, 'Malaysia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (137, 'Maldives', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (138, 'Mali', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (139, 'Malta', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (140, 'Marshall Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (141, 'Martinique', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (142, 'Mauritania', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (143, 'Mauritius', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (144, 'Mayotte', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (145, 'Mexico', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (146, 'Micronesia, Federated States of', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (147, 'Moldova, Republic of', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (148, 'Monaco', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (149, 'Mongolia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (150, 'Montenegro', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (151, 'Montserrat', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (152, 'Morocco', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (153, 'Mozambique', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (154, 'Myanmar', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (155, 'Namibia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (156, 'Nauru', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (157, 'Nepal', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (158, 'Netherlands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (159, 'Netherlands Antilles', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (160, 'New Caledonia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (161, 'New Zealand', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (162, 'Nicaragua', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (163, 'Niger', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (164, 'Nigeria', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (165, 'Niue', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (166, 'Norfolk Island', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (167, 'Northern Mariana Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (168, 'Norway', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (169, 'Oman', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (170, 'Pakistan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (171, 'Palau', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (172, 'Palestinian Territory, Occupied', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (173, 'Panama', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (174, 'Papua New Guinea', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (175, 'Paraguay', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (176, 'Peru', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (177, 'Philippines', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (178, 'Pitcairn', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (179, 'Poland', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (180, 'Portugal', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (181, 'Puerto Rico', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (182, 'Qatar', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (183, 'Reunion', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (184, 'Romania', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (185, 'Russian Federation', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (186, 'Rwanda', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (187, 'Saint Barthelemy', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (188, 'Saint Helena', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (189, 'Saint Kitts and Nevis', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (190, 'Saint Lucia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (191, 'Saint Martin', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (192, 'Saint Pierre and Miquelon', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (193, 'Saint Vincent and the Grenadines', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (194, 'Samoa', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (195, 'San Marino', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (196, 'Sao Tome and Principe', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (197, 'Saudi Arabia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (198, 'Senegal', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (199, 'Serbia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (200, 'Serbia and Montenegro', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (201, 'Seychelles', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (202, 'Sierra Leone', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (203, 'Singapore', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (204, 'Sint Maarten', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (205, 'Slovakia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (206, 'Slovenia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (207, 'Solomon Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (208, 'Somalia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (209, 'South Africa', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (210, 'South Georgia and the South Sandwich Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (211, 'South Sudan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (212, 'Spain', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (213, 'Sri Lanka', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (214, 'Sudan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (215, 'Suriname', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (216, 'Svalbard and Jan Mayen', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (217, 'Swaziland', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (218, 'Sweden', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (219, 'Switzerland', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (220, 'Syrian Arab Republic', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (221, 'Taiwan, Province of China', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (222, 'Tajikistan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (223, 'Tanzania, United Republic of', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (224, 'Thailand', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (225, 'Timor-Leste', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (226, 'Togo', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (227, 'Tokelau', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (228, 'Tonga', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (229, 'Trinidad and Tobago', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (230, 'Tunisia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (231, 'Turkey', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (232, 'Turkmenistan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (233, 'Turks and Caicos Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (234, 'Tuvalu', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (235, 'Uganda', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (236, 'Ukraine', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (237, 'United Arab Emirates', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (238, 'United Kingdom', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (239, 'United States', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (240, 'United States Minor Outlying Islands', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (241, 'Uruguay', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (242, 'Uzbekistan', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (243, 'Vanuatu', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (244, 'Venezuela', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (245, 'Viet Nam', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (246, 'Virgin Islands, British', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (247, 'Virgin Islands, U.s.', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (248, 'Wallis and Futuna', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (249, 'Western Sahara', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (250, 'Yemen', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (251, 'Zambia', 1);
INSERT INTO `tbl_country` (`countryid`, `countryname`, `status`) VALUES (252, 'Zimbabwe', 1);


#
# TABLE STRUCTURE FOR: tbl_destroyedproduct
#

DROP TABLE IF EXISTS `tbl_destroyedproduct`;

CREATE TABLE `tbl_destroyedproduct` (
  `destroy_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `rec_date` datetime DEFAULT NULL,
  `comment` text DEFAULT NULL,
  PRIMARY KEY (`destroy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_email_permission
#

DROP TABLE IF EXISTS `tbl_email_permission`;

CREATE TABLE `tbl_email_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` text DEFAULT NULL,
  `status` int(3) DEFAULT 0 COMMENT '0=no,1=yes',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_email_permission` (`permission_id`, `permission`, `status`) VALUES (1, 'booking', 0);
INSERT INTO `tbl_email_permission` (`permission_id`, `permission`, `status`) VALUES (2, 'checkin', 0);
INSERT INTO `tbl_email_permission` (`permission_id`, `permission`, `status`) VALUES (3, 'checkout', 0);


#
# TABLE STRUCTURE FOR: tbl_financialyear
#

DROP TABLE IF EXISTS `tbl_financialyear`;

CREATE TABLE `tbl_financialyear` (
  `fiyear_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `is_active` varchar(3) DEFAULT NULL COMMENT '1=ended,0=inactive,2=active',
  `create_by` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`fiyear_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_floor
#

DROP TABLE IF EXISTS `tbl_floor`;

CREATE TABLE `tbl_floor` (
  `floorid` int(11) NOT NULL AUTO_INCREMENT,
  `floorname` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`floorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_floorplan
#

DROP TABLE IF EXISTS `tbl_floorplan`;

CREATE TABLE `tbl_floorplan` (
  `floorplanid` int(11) NOT NULL AUTO_INCREMENT,
  `floorName` int(11) NOT NULL,
  `noofroom` int(11) NOT NULL,
  `startno` varchar(255) NOT NULL,
  `roomno` varchar(50) NOT NULL,
  PRIMARY KEY (`floorplanid`),
  KEY `floorName` (`floorName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_guestpayments
#

DROP TABLE IF EXISTS `tbl_guestpayments`;

CREATE TABLE `tbl_guestpayments` (
  `payid` int(11) NOT NULL AUTO_INCREMENT,
  `bookedid` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `paydate` datetime NOT NULL,
  `paymenttype` varchar(100) NOT NULL,
  `paymentamount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `details` varchar(100) DEFAULT NULL,
  `book_type` int(3) DEFAULT 0 COMMENT '0=room, 1=hall room',
  PRIMARY KEY (`payid`),
  KEY `bookedid` (`bookedid`,`invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_module_purchasekey
#

DROP TABLE IF EXISTS `tbl_module_purchasekey`;

CREATE TABLE `tbl_module_purchasekey` (
  `mpid` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(25) DEFAULT NULL,
  `purchasekey` varchar(55) DEFAULT NULL,
  `downloaddate` datetime NOT NULL DEFAULT '1970-01-01 01:01:01',
  `updatedate` datetime NOT NULL DEFAULT '1970-01-01 01:01:01',
  PRIMARY KEY (`mpid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_note
#

DROP TABLE IF EXISTS `tbl_note`;

CREATE TABLE `tbl_note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note` text DEFAULT NULL,
  `roomno` text DEFAULT NULL,
  `bookedid` text DEFAULT NULL,
  `status` int(3) DEFAULT 0 COMMENT '0=pending,1=solved',
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_openingbalance
#

DROP TABLE IF EXISTS `tbl_openingbalance`;

CREATE TABLE `tbl_openingbalance` (
  `opbalance_id` int(11) NOT NULL AUTO_INCREMENT,
  `fiyear_id` int(11) NOT NULL,
  `headcode` text DEFAULT NULL,
  `opening_balance` decimal(10,2) DEFAULT NULL,
  `current_balance` decimal(10,2) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  PRIMARY KEY (`opbalance_id`),
  KEY `fiyear_id` (`fiyear_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_otherguest
#

DROP TABLE IF EXISTS `tbl_otherguest`;

CREATE TABLE `tbl_otherguest` (
  `otherguest_id` int(11) NOT NULL AUTO_INCREMENT,
  `bookedid` text DEFAULT NULL,
  `customerid` int(11) DEFAULT NULL,
  `guestname` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `photo_id_type` text DEFAULT NULL,
  `photo_id` text DEFAULT NULL,
  `front_image` varchar(100) DEFAULT NULL,
  `back_image` varchar(100) DEFAULT NULL,
  `occupant_image` varchar(100) DEFAULT NULL,
  `type` int(3) DEFAULT 0 COMMENT '0=room, 1=hall room',
  PRIMARY KEY (`otherguest_id`),
  KEY `customerid` (`customerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_postedbills
#

DROP TABLE IF EXISTS `tbl_postedbills`;

CREATE TABLE `tbl_postedbills` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `bookedid` int(11) NOT NULL,
  `taskname` text DEFAULT NULL,
  `rate` text DEFAULT NULL,
  `scharge` varchar(100) DEFAULT NULL,
  `complementary` decimal(10,2) DEFAULT 0.00,
  `credit` decimal(8,2) DEFAULT NULL,
  `additional_charges` decimal(10,2) DEFAULT 0.00,
  `extrabpc` decimal(10,2) DEFAULT 0.00,
  `ex_discount` decimal(10,2) DEFAULT 0.00,
  `swimming_pool` decimal(10,2) DEFAULT 0.00,
  `restaurant` decimal(10,2) NOT NULL DEFAULT 0.00,
  `hallroom` decimal(10,2) NOT NULL DEFAULT 0.00,
  `car_parking` decimal(10,2) NOT NULL DEFAULT 0.00,
  `special_discount` decimal(10,2) DEFAULT 0.00,
  `checkoutdate` datetime DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `amount` decimal(11,0) DEFAULT NULL,
  `charge` decimal(10,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_reuseableproduct
#

DROP TABLE IF EXISTS `tbl_reuseableproduct`;

CREATE TABLE `tbl_reuseableproduct` (
  `reuse_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `in_use` int(11) DEFAULT 0,
  `in_laundry` int(11) DEFAULT 0,
  `ready` int(11) DEFAULT 0,
  PRIMARY KEY (`reuse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_room_offer
#

DROP TABLE IF EXISTS `tbl_room_offer`;

CREATE TABLE `tbl_room_offer` (
  `offerid` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) NOT NULL,
  `offer` int(11) NOT NULL,
  `offertitle` varchar(255) DEFAULT NULL,
  `offertext` text DEFAULT NULL,
  `offer_date` date NOT NULL,
  PRIMARY KEY (`offerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_roomnofloorassign
#

DROP TABLE IF EXISTS `tbl_roomnofloorassign`;

CREATE TABLE `tbl_roomnofloorassign` (
  `roomassignid` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) NOT NULL,
  `floorid` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `status` int(3) DEFAULT 1 COMMENT '1=ready,2=booked,3=assigned to clean,4=booked and assigned to clean, 5=under maintenance,6=dirty,7=blocked,8=do not reserve',
  PRIMARY KEY (`roomassignid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_slider
#

DROP TABLE IF EXISTS `tbl_slider`;

CREATE TABLE `tbl_slider` (
  `slid` int(11) NOT NULL AUTO_INCREMENT,
  `Sltypeid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link1` text DEFAULT NULL,
  `link2` text DEFAULT NULL,
  `link3` text DEFAULT NULL,
  `slink` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `delation_status` int(11) NOT NULL DEFAULT 0,
  `width` int(11) NOT NULL DEFAULT 0,
  `height` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`slid`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (2, 1, 'Enjoy Your Stay in CoxsToday', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '', NULL, NULL, NULL, '#', 1, 0, 1920, 1000);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (3, 1, 'Enjoy Your Vacation', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '', NULL, NULL, NULL, '#', 1, 0, 1920, 1000);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (4, 2, 'home About', 'test', '', NULL, NULL, NULL, '#', 1, 0, 445, 408);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (6, 3, 'Enjoy the eye catching and wonderful sunset comfortably from your room window.', '', '', NULL, NULL, NULL, '#', 1, 0, 375, 211);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (7, 3, 'Lorem Ipsum  since the 1500  Usd offer', '', '', NULL, NULL, NULL, '#', 1, 0, 375, 211);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (8, 3, 'Credit card that\'s right for you. 200 usd', '', '', NULL, NULL, NULL, '#', 1, 0, 375, 211);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (9, 3, 'In some form, by injected humor', '', '', NULL, NULL, NULL, '#', 1, 0, 375, 211);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (10, 3, 'Many desktop publishing 50 USD', '', '', NULL, NULL, NULL, '#', 1, 0, 375, 211);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (11, 3, 'The point of using 400 USD', '', '', NULL, NULL, NULL, '#', 1, 0, 660, 372);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (12, 4, 'It uses a dictionary of over 200 Latin words', 'Scenic Travel', '', NULL, NULL, NULL, '#', 1, 0, 280, 498);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (13, 4, 'Many desktop publishing packages and web page', 'Southern Travel', '', NULL, NULL, NULL, '#', 1, 0, 280, 498);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (14, 4, 'Contrary to popular belief, Lorem Ipsum is', 'Scenic Travel', '', NULL, NULL, NULL, '#', 1, 0, 280, 498);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (15, 4, 'Various versions have evolved over the years', 'Scenic Travel', '', NULL, NULL, NULL, '#', 1, 0, 280, 498);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (16, 5, 'Lauren Cox', 'Creative Director a', '', 'https://www.facebook.com', 'https://www.facebook.com', 'https://www.facebook.com', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 1, 0, 400, 490);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (17, 5, 'Jessie Barnett', 'UI/UX Designer', '', 'https://www.facebook.com', 'https://www.facebook.com', 'https://www.facebook.com', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from', 1, 0, 400, 490);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (18, 5, 'Terry Fletcher', 'Web Developer', '', 'https://www.facebook.com', 'https://www.facebook.com', 'https://www.facebook.com', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from', 1, 0, 400, 490);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (19, 5, 'Terry Fletcher', 'Web Developer', '', 'https://www.facebook.com', 'https://www.facebook.com', 'https://www.facebook.com', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from', 1, 0, 400, 490);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (20, 6, 'About tio', '', '', NULL, NULL, NULL, '#', 1, 0, 640, 790);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (21, 6, 'about', '', '', NULL, NULL, NULL, '#', 1, 0, 470, 424);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (22, 6, 'about', '', '', NULL, NULL, NULL, '#', 1, 0, 470, 318);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (23, 6, 'about', '', '', NULL, NULL, NULL, '#', 1, 0, 314, 284);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (24, 6, 'about', '', '', NULL, NULL, NULL, '#', 1, 0, 454, 284);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (25, 6, 'about', '', '', NULL, NULL, NULL, '#', 1, 0, 810, 460);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (26, 8, 'Twin Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (27, 8, 'Single Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (29, 8, 'Twin Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (30, 8, 'Deluxe Double Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (32, 8, 'Single Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (33, 8, 'Twin Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (34, 8, 'Single Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (35, 8, 'Twin Room', '', '', NULL, NULL, NULL, '#', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (38, 4, 'Find the credit card that\'s right for you.', 'Scenic Travel', '', NULL, NULL, NULL, '#', 1, 0, 280, 498);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (39, 1, 'Hotel', 'Baraar ', '', NULL, NULL, NULL, '', 1, 0, 1920, 1000);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (41, 9, 'Alphabet logo', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (42, 9, 'Amazon', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (43, 9, 'Fitbit', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (44, 9, 'Google', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (45, 9, 'Paypal', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (46, 9, 'Samsung', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (47, 9, 'Shopify', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (48, 9, 'Slack', '', '', NULL, NULL, NULL, '#', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (49, 9, 'Stripe', '', '', NULL, NULL, NULL, '', 1, 0, 104, 35);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (50, 10, 'It\'s almost yours', 'We just need a few more details to confirm your booking at The Radisson Hotel.', '', NULL, NULL, NULL, '#', 1, 0, 50, 50);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (51, 10, 'No surprises', 'Pay the price you see – no booking fees!', '', NULL, NULL, NULL, '#', 1, 0, 50, 50);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (52, 10, 'Your booking is secure', 'Your details are protected by a secure connection.', '', NULL, NULL, NULL, '#', 1, 0, 50, 50);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (53, 11, 'Bed', '', '', NULL, NULL, NULL, '#', 1, 0, 22, 22);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (54, 11, 'Free WiFi', '', '', NULL, NULL, NULL, '#', 1, 0, 22, 25);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (55, 11, 'Balcony, City / Landmark / Garden view', '', '', NULL, NULL, NULL, '#', 1, 0, 22, 25);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (56, 11, 'Flat-screen TV', '', '', NULL, NULL, NULL, '#', 1, 0, 22, 25);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (57, 11, 'Facilities for guests with disabilities', '', '', NULL, NULL, NULL, '#', 1, 0, 22, 25);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (58, 12, 'Save up to 10%', '', '', NULL, NULL, NULL, '#', 1, 0, 40, 40);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (59, 12, 'Best Rate Guarantee', '', '', NULL, NULL, NULL, '#', 1, 0, 40, 40);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (60, 12, 'Free Wi-Fi', '', '', NULL, NULL, NULL, '#', 1, 0, 40, 40);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (61, 12, 'Enjoy Free Nights', '', '', NULL, NULL, NULL, '#', 1, 0, 40, 40);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (62, 3, 'Printer simply dummy 500 USD', '', '', NULL, NULL, NULL, '#', 1, 0, 375, 211);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (63, 3, 'Lorem Ipsum is simply dummy 100 usd', '', '', NULL, NULL, NULL, '#', 1, 0, 375, 211);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (65, 8, 'Twin Room', '', '', NULL, NULL, NULL, '', 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (68, 13, '50000', 'Monthly Active Users ', '', '1000', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (69, 13, '130', 'Team Members', '', '10', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (70, 13, '1235', 'User Projects Published', '', '10', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (71, 13, '4590', 'Server Uptime', '', '10', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (72, 14, 'Address', 'Plot-7, Road-02, Hotel Motel Zone, San Francisco Road, United States of America', '', NULL, NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (73, 14, 'Phone & WhatsApp Number', '0892 555 983445', '', NULL, NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (74, 14, 'Email', 'info@demo.com', '', NULL, NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (75, 14, 'mobile', '01840998765', '', NULL, NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (81, 15, 'Instragram', NULL, '', 'https://www.instagram.com/', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (82, 15, 'Twitter', NULL, '', 'https://twitter.com/', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (83, 15, 'Dribble', NULL, '', 'https://dribbble.com/', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (84, 15, 'Facebook', NULL, '', 'https://www.facebook.com/', NULL, NULL, NULL, 1, 0, 0, 0);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (85, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 0, 500, 1000);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (86, 8, 'Double Deluxe Romm', NULL, '', NULL, NULL, NULL, NULL, 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (87, 8, 'Double Deluxe Romm', NULL, '', NULL, NULL, NULL, NULL, 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (88, 8, 'Double Deluxe Romm', NULL, '', NULL, NULL, NULL, NULL, 1, 0, 700, 700);
INSERT INTO `tbl_slider` (`slid`, `Sltypeid`, `title`, `subtitle`, `image`, `link1`, `link2`, `link3`, `slink`, `status`, `delation_status`, `width`, `height`) VALUES (90, 8, 'VIP Suite', NULL, '', NULL, NULL, NULL, NULL, 1, 0, 800, 1000);


#
# TABLE STRUCTURE FOR: tbl_slider_type
#

DROP TABLE IF EXISTS `tbl_slider_type`;

CREATE TABLE `tbl_slider_type` (
  `stype_id` int(11) NOT NULL AUTO_INCREMENT,
  `STypeName` varchar(255) DEFAULT NULL,
  `delation_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`stype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (1, 'Home Slider', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (2, 'Home Middle', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (3, 'Top Offers', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (4, 'Explore Destination', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (5, 'About Team', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (6, 'About Top', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (7, 'About Brand', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (8, 'gallery', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (9, 'Company', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (10, 'Booking Conditions', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (11, 'Facility', 0);
INSERT INTO `tbl_slider_type` (`stype_id`, `STypeName`, `delation_status`) VALUES (12, 'Home below slider', 0);


#
# TABLE STRUCTURE FOR: tbl_state
#

DROP TABLE IF EXISTS `tbl_state`;

CREATE TABLE `tbl_state` (
  `stateid` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `statename` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`stateid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_tax
#

DROP TABLE IF EXISTS `tbl_tax`;

CREATE TABLE `tbl_tax` (
  `taxsettings` int(11) NOT NULL AUTO_INCREMENT,
  `tax` int(11) NOT NULL DEFAULT 0 COMMENT '1=show,0=hide',
  PRIMARY KEY (`taxsettings`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_tax` (`taxsettings`, `tax`) VALUES (1, 0);


#
# TABLE STRUCTURE FOR: tbl_taxmgt
#

DROP TABLE IF EXISTS `tbl_taxmgt`;

CREATE TABLE `tbl_taxmgt` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `taxname` text DEFAULT NULL,
  `rate` decimal(8,2) DEFAULT 2.00,
  `reg_no` text DEFAULT NULL,
  `isactive` int(3) DEFAULT 1,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: tbl_version_checker
#

DROP TABLE IF EXISTS `tbl_version_checker`;

CREATE TABLE `tbl_version_checker` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(10) DEFAULT NULL,
  `disable` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_version_checker` (`vid`, `version`, `disable`) VALUES (1, '0', 0);


#
# TABLE STRUCTURE FOR: tbl_wakeup_call
#

DROP TABLE IF EXISTS `tbl_wakeup_call`;

CREATE TABLE `tbl_wakeup_call` (
  `wapupid` int(11) NOT NULL AUTO_INCREMENT,
  `custid` int(11) NOT NULL,
  `wakeupcall_time` varchar(100) NOT NULL,
  `insert_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`wapupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# TABLE STRUCTURE FOR: tbl_widget
#

DROP TABLE IF EXISTS `tbl_widget`;

CREATE TABLE `tbl_widget` (
  `widgetid` int(11) NOT NULL AUTO_INCREMENT,
  `widget_name` varchar(100) NOT NULL,
  `widget_title` varchar(150) DEFAULT NULL,
  `widget_desc` text DEFAULT NULL,
  PRIMARY KEY (`widgetid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (1, 'BEYOND IMAGINABLE ', 'Enjoy Your Vacation With Us', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (2, 'Booking Conditions', 'Booking Conditions', '<h6 class=\"font-weight-bold\">Cancellation Policy</h6>\r\n<p>You\'ll be charged the total price if you cancel your booking.</p>\r\n<h6 class=\"font-weight-bold\">Prepayment policy</h6>\r\n<p>No prepayment is needed.</p>\r\n<h6 class=\"font-weight-bold\">Meal plan</h6>\r\n<p class=\"mb-0\">Continental breakfast costs BDT 502 per person per night.</p>\r\n<p class=\"mb-0\">Lunch costs BDT 1,180 per person per night.</p>\r\n<p>Dinner costs BDT 1,180 per person per night.</p>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (3, '', 'Comfort are Perfectly Combined Here', 'This charming private 19th-century mansion, which originally belonged to the family, has been completely renovated with care &amp; passion while respecting the spirit of place.\n\nDivo Hotel surrounded herself by a team of French artisans to create a sophisticated place in a refined.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (4, 'Top Offer', 'This Week\'s Top Offers', 'A resort is a self-contained destination that can provide for all of your travel needs in one location.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (5, 'Destination', 'Explore Destinations & Experiences', 'Our guests always travel the world in style. Mention @Kempinski on Instagram for a chance to be featured!');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (6, '', 'Sign or Join', 'This charming private 19th century mansion, which originally ');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (7, '', 'Save up to 10%', 'Members get access to an exclusive discounts on Radissonblu.com. Not a member yet? Hurry Up!');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (8, '', 'Best Rate Guarantee', 'If you find a lower online rate, we will match it and give you an additional 25% off on your stay.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (9, '', 'Free Wi-Fi', 'If you find a lower online rate, we will match it and give you an additional 25% off on your stay.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (10, '', 'Enjoy Free Nights', 'If you find a lower online rate, we will match it and give you an additional 25% off on your stay.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (11, 'ourteam', 'Our Team', 'Meet the people who make awesome stuffs\n');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (12, 'small team', 'Small team. Big hearts.', 'Our focus is always on finding the best people to work with. Our bar is high, And you look ready to take on the challenge.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (13, 'about Middle', 'Trusted by thousands of companies', 'Our guests always travel the world in style. Mention @Kempinski on Instagram for a chance to be featured!');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (14, 'call number', 'CALL ANYTIME', '0741236589');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (15, 'contact Email', 'EMAIL US', '<div class=\"wrapper\"><footer class=\"dark\">\r\n<div class=\"subfooter\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<div class=\"social-media\">reservation@xainhotel.com   </div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</footer></div>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (16, 'address', 'Address', '<p>Plot-7, Road-02, Hotel Motel Zone, Francisco Road, United States</p>\r\n<p>info@hotelthecoxtoday.com</p>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (17, 'phone', 'Phone & WhatsApp Number', '0892 555 98 449');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (18, 'Email', 'Email', '<p>info@hotelthecoxtoday.com</p>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (19, 'let us', 'Let us hear from you directly!', 'Our guests always travel the world in style. Mention @Kempinski  on Instagram for a chance to be featured!');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (20, 'Privacy', 'Privacy At a glance ', 'What is Lorem Ipsum Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\nContacting us: If you have any questions about this Privacy Policy, the practices of this site, or your dealings with this site, please contact us');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (21, 'Terms', 'Terms & Conditions', 'Terms of Use\nOur Site may use \"cookies\" to enhance User experience. User\'s web browser places cookies on their hard drive for record-keeping purposes and sometimes to track information about them. User may choose to set their web browser to refuse cookies, or to alert you when cookies are being sent. If they do so, note that some parts of the Site may not function properly\n');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (22, 'footer', 'footer left', '<p>Plot-7, Road-02, Hotel Motel Zone, Francisco Road, United States</p>\r\n<p>info@hotelthecoxtoday.com</p>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (23, 'Footer first', 'Pages', '<ul class=\"footer-link list-unstyled menu mb-0\">\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"hotel\">Home</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"about\">About</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"contact\">Contact Us</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"gallery\">Gallery</a></li>\r\n</ul>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (24, 'footer second', 'Social Links', '<ul class=\"list-unstyled social-icon\">\r\n<li><a href=\"https://instragram.com/\" target=\"_blank\" rel=\"noopener noreferrer\"> <i class=\"fab fa-instagram icon-wrap\"></i> <span>Instagram </span> </a></li>\r\n<li><a href=\"https://twitter.com/\" target=\"_blank\" rel=\"noopener noreferrer\"> <i class=\"fab fa-twitter icon-wrap\"></i> <span>Twitter</span> </a></li>\r\n<li><a href=\"https://dribble.com/\" target=\"_blank\" rel=\"noopener noreferrer\"> <i class=\"fab fa-dribbble icon-wrap\"></i> <span>Dribbble</span> </a></li>\r\n<li><a href=\"https://facebook.com/\" target=\"_blank\" rel=\"noopener noreferrer\"> <i class=\"fab fa-facebook-f icon-wrap\"></i> <span>Facebook</span> </a></li>\r\n</ul>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (25, 'footer 3rd', 'About spacial', '<ul class=\"footer-link list-unstyled menu mb-0\">\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"#\">Home Pages</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"#\">Theme Features</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"#\">Services</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"#\">StoreFront</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"#\">Portfolio</a></li>\r\n</ul>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (26, 'widget four', 'Company Policy', '<ul class=\"footer-link list-unstyled menu mb-0\">\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"privacy\">Privacy</a></li>\r\n<li class=\"mb-2\"><a class=\"link d-block font-weight-500\" href=\"terms\">Terms & Conditions</a></li>\r\n</ul>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (27, 'Overview', '', '<div class=\"col-6 mb-3 col-lg-3 mb-lg-0\"><span class=\"numscroller display-4 text-primary d-block\" data-min=\"1\" data-max=\"52147\" data-delay=\"5\" data-increment=\"100\">52147</span> <span class=\"h6\">Monthly Active Users</span></div>\r\n<div class=\"col-6 mb-3 col-lg-3 mb-lg-0\"><span class=\"numscroller display-4 text-primary d-block\" data-min=\"1\" data-max=\"130\" data-delay=\"5\" data-increment=\"10\">130</span> <span class=\"h6\">Team Members</span></div>\r\n<div class=\"col-6 mb-3 col-lg-3 mb-lg-0\"><span class=\"numscroller display-4 text-primary d-block\" data-min=\"1\" data-max=\"1235\" data-delay=\"5\" data-increment=\"10\">1235</span> <span class=\"h6\">User Projects Published</span></div>\r\n<div class=\"col-6 mb-3 col-lg-3 mb-lg-0\"><span class=\"numscroller display-4 text-primary d-block\" data-min=\"1\" data-max=\"4591\" data-delay=\"5\" data-increment=\"10\">4591</span> <span class=\"h6\">Server Uptime</span></div>');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (28, 'Social Icons', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores.', '');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (29, 'Get updates & exclusive offers', 'Sign up to our newsletter to be the first to hear about', 'new openings, offers and more.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (30, '', 'Free cancellation', NULL);
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (31, '', NULL, 'www.facebook.com');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (32, '', NULL, 'www.facebook.com');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (33, '', NULL, 'www.facebook.com');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (34, '', NULL, 'www.facebook.com');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (35, '', 'Cancellation Policy', 'You\'ll be charged the total price if you cancel your booking.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (36, '', 'Prepayment policy', 'No prepayment is needed.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (37, '', 'Meal plan', 'Continental breakfast costs BDT 502 per person per night.Lunch costs BDT 1,180 per person per night.Dinner costs BDT 1,180 per person per night.');
INSERT INTO `tbl_widget` (`widgetid`, `widget_name`, `widget_title`, `widget_desc`) VALUES (38, 'Terms for website', 'Conditions', 'Please use. for new line in invoice. terms and condition.');


#
# TABLE STRUCTURE FOR: timezone
#

DROP TABLE IF EXISTS `timezone`;

CREATE TABLE `timezone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `convention` varchar(100) DEFAULT NULL,
  `zone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (1, 'AD', 'Europe/Andorra');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (2, 'AE', 'Asia/Dubai');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (3, 'AF', 'Asia/Kabul');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (4, 'AG', 'America/Antigua');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (5, 'AI', 'America/Anguilla');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (6, 'AL', 'Europe/Tirane');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (7, 'AM', 'Asia/Yerevan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (8, 'AO', 'Africa/Luanda');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (9, 'AQ', 'Antarctica/McMurdo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (10, 'AQ', 'Antarctica/Casey');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (11, 'AQ', 'Antarctica/Davis');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (12, 'AQ', 'Antarctica/DumontDUrville');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (13, 'AQ', 'Antarctica/Mawson');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (14, 'AQ', 'Antarctica/Palmer');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (15, 'AQ', 'Antarctica/Rothera');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (16, 'AQ', 'Antarctica/Syowa');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (17, 'AQ', 'Antarctica/Troll');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (18, 'AQ', 'Antarctica/Vostok');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (19, 'AR', 'America/Argentina/Buenos_Aires');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (20, 'AR', 'America/Argentina/Cordoba');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (21, 'AR', 'America/Argentina/Salta');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (22, 'AR', 'America/Argentina/Jujuy');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (23, 'AR', 'America/Argentina/Tucuman');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (24, 'AR', 'America/Argentina/Catamarca');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (25, 'AR', 'America/Argentina/La_Rioja');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (26, 'AR', 'America/Argentina/San_Juan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (27, 'AR', 'America/Argentina/Mendoza');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (28, 'AR', 'America/Argentina/San_Luis');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (29, 'AR', 'America/Argentina/Rio_Gallegos');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (30, 'AR', 'America/Argentina/Ushuaia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (31, 'AS', 'Pacific/Pago_Pago');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (32, 'AT', 'Europe/Vienna');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (33, 'AU', 'Australia/Lord_Howe');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (34, 'AU', 'Antarctica/Macquarie');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (35, 'AU', 'Australia/Hobart');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (36, 'AU', 'Australia/Melbourne');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (37, 'AU', 'Australia/Sydney');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (38, 'AU', 'Australia/Broken_Hill');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (39, 'AU', 'Australia/Brisbane');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (40, 'AU', 'Australia/Lindeman');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (41, 'AU', 'Australia/Adelaide');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (42, 'AU', 'Australia/Darwin');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (43, 'AU', 'Australia/Perth');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (44, 'AU', 'Australia/Eucla');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (45, 'AW', 'America/Aruba');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (46, 'AX', 'Europe/Mariehamn');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (47, 'AZ', 'Asia/Baku');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (48, 'BA', 'Europe/Sarajevo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (49, 'BB', 'America/Barbados');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (50, 'BD', 'Asia/Dhaka');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (51, 'BE', 'Europe/Brussels');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (52, 'BF', 'Africa/Ouagadougou');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (53, 'BG', 'Europe/Sofia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (54, 'BH', 'Asia/Bahrain');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (55, 'BI', 'Africa/Bujumbura');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (56, 'BJ', 'Africa/Porto-Novo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (57, 'BL', 'America/St_Barthelemy');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (58, 'BM', 'Atlantic/Bermuda');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (59, 'BN', 'Asia/Brunei');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (60, 'BO', 'America/La_Paz');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (61, 'BQ', 'America/Kralendijk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (62, 'BR', 'America/Noronha');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (63, 'BR', 'America/Belem');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (64, 'BR', 'America/Fortaleza');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (65, 'BR', 'America/Recife');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (66, 'BR', 'America/Araguaina');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (67, 'BR', 'America/Maceio');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (68, 'BR', 'America/Bahia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (69, 'BR', 'America/Sao_Paulo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (70, 'BR', 'America/Campo_Grande');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (71, 'BR', 'America/Cuiaba');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (72, 'BR', 'America/Santarem');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (73, 'BR', 'America/Porto_Velho');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (74, 'BR', 'America/Boa_Vista');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (75, 'BR', 'America/Manaus');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (76, 'BR', 'America/Eirunepe');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (77, 'BR', 'America/Rio_Branco');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (78, 'BS', 'America/Nassau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (79, 'BT', 'Asia/Thimphu');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (80, 'BW', 'Africa/Gaborone');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (81, 'BY', 'Europe/Minsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (82, 'BZ', 'America/Belize');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (83, 'CA', 'America/St_Johns');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (84, 'CA', 'America/Halifax');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (85, 'CA', 'America/Glace_Bay');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (86, 'CA', 'America/Moncton');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (87, 'CA', 'America/Goose_Bay');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (88, 'CA', 'America/Blanc-Sablon');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (89, 'CA', 'America/Toronto');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (90, 'CA', 'America/Nipigon');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (91, 'CA', 'America/Thunder_Bay');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (92, 'CA', 'America/Iqaluit');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (93, 'CA', 'America/Pangnirtung');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (94, 'CA', 'America/Atikokan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (95, 'CA', 'America/Winnipeg');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (96, 'CA', 'America/Rainy_River');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (97, 'CA', 'America/Resolute');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (98, 'CA', 'America/Rankin_Inlet');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (99, 'CA', 'America/Regina');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (100, 'CA', 'America/Swift_Current');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (101, 'CA', 'America/Edmonton');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (102, 'CA', 'America/Cambridge_Bay');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (103, 'CA', 'America/Yellowknife');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (104, 'CA', 'America/Inuvik');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (105, 'CA', 'America/Creston');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (106, 'CA', 'America/Dawson_Creek');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (107, 'CA', 'America/Fort_Nelson');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (108, 'CA', 'America/Whitehorse');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (109, 'CA', 'America/Dawson');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (110, 'CA', 'America/Vancouver');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (111, 'CC', 'Indian/Cocos');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (112, 'CD', 'Africa/Kinshasa');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (113, 'CD', 'Africa/Lubumbashi');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (114, 'CF', 'Africa/Bangui');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (115, 'CG', 'Africa/Brazzaville');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (116, 'CH', 'Europe/Zurich');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (117, 'CI', 'Africa/Abidjan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (118, 'CK', 'Pacific/Rarotonga');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (119, 'CL', 'America/Santiago');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (120, 'CL', 'America/Punta_Arenas');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (121, 'CL', 'Pacific/Easter');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (122, 'CM', 'Africa/Douala');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (123, 'CN', 'Asia/Shanghai');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (124, 'CN', 'Asia/Urumqi');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (125, 'CO', 'America/Bogota');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (126, 'CR', 'America/Costa_Rica');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (127, 'CU', 'America/Havana');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (128, 'CV', 'Atlantic/Cape_Verde');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (129, 'CW', 'America/Curacao');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (130, 'CX', 'Indian/Christmas');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (131, 'CY', 'Asia/Nicosia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (132, 'CY', 'Asia/Famagusta');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (133, 'CZ', 'Europe/Prague');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (134, 'DE', 'Europe/Berlin');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (135, 'DE', 'Europe/Busingen');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (136, 'DJ', 'Africa/Djibouti');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (137, 'DK', 'Europe/Copenhagen');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (138, 'DM', 'America/Dominica');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (139, 'DO', 'America/Santo_Domingo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (140, 'DZ', 'Africa/Algiers');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (141, 'EC', 'America/Guayaquil');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (142, 'EC', 'Pacific/Galapagos');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (143, 'EE', 'Europe/Tallinn');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (144, 'EG', 'Africa/Cairo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (145, 'EH', 'Africa/El_Aaiun');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (146, 'ER', 'Africa/Asmara');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (147, 'ES', 'Europe/Madrid');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (148, 'ES', 'Africa/Ceuta');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (149, 'ES', 'Atlantic/Canary');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (150, 'ET', 'Africa/Addis_Ababa');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (151, 'FI', 'Europe/Helsinki');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (152, 'FJ', 'Pacific/Fiji');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (153, 'FK', 'Atlantic/Stanley');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (154, 'FM', 'Pacific/Chuuk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (155, 'FM', 'Pacific/Pohnpei');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (156, 'FM', 'Pacific/Kosrae');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (157, 'FO', 'Atlantic/Faroe');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (158, 'FR', 'Europe/Paris');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (159, 'GA', 'Africa/Libreville');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (160, 'GB', 'Europe/London');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (161, 'GD', 'America/Grenada');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (162, 'GE', 'Asia/Tbilisi');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (163, 'GF', 'America/Cayenne');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (164, 'GG', 'Europe/Guernsey');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (165, 'GH', 'Africa/Accra');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (166, 'GI', 'Europe/Gibraltar');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (167, 'GL', 'America/Nuuk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (168, 'GL', 'America/Danmarkshavn');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (169, 'GL', 'America/Scoresbysund');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (170, 'GL', 'America/Thule');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (171, 'GM', 'Africa/Banjul');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (172, 'GN', 'Africa/Conakry');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (173, 'GP', 'America/Guadeloupe');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (174, 'GQ', 'Africa/Malabo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (175, 'GR', 'Europe/Athens');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (176, 'GS', 'Atlantic/South_Georgia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (177, 'GT', 'America/Guatemala');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (178, 'GU', 'Pacific/Guam');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (179, 'GW', 'Africa/Bissau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (180, 'GY', 'America/Guyana');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (181, 'HK', 'Asia/Hong_Kong');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (182, 'HN', 'America/Tegucigalpa');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (183, 'HR', 'Europe/Zagreb');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (184, 'HT', 'America/Port-au-Prince');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (185, 'HU', 'Europe/Budapest');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (186, 'ID', 'Asia/Jakarta');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (187, 'ID', 'Asia/Pontianak');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (188, 'ID', 'Asia/Makassar');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (189, 'ID', 'Asia/Jayapura');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (190, 'IE', 'Europe/Dublin');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (191, 'IL', 'Asia/Jerusalem');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (192, 'IM', 'Europe/Isle_of_Man');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (193, 'IN', 'Asia/Kolkata');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (194, 'IO', 'Indian/Chagos');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (195, 'IQ', 'Asia/Baghdad');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (196, 'IR', 'Asia/Tehran');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (197, 'IS', 'Atlantic/Reykjavik');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (198, 'IT', 'Europe/Rome');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (199, 'JE', 'Europe/Jersey');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (200, 'JM', 'America/Jamaica');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (201, 'JO', 'Asia/Amman');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (202, 'JP', 'Asia/Tokyo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (203, 'KE', 'Africa/Nairobi');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (204, 'KG', 'Asia/Bishkek');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (205, 'KH', 'Asia/Phnom_Penh');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (206, 'KI', 'Pacific/Tarawa');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (207, 'KI', 'Pacific/Kanton');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (208, 'KI', 'Pacific/Kiritimati');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (209, 'KM', 'Indian/Comoro');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (210, 'KN', 'America/St_Kitts');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (211, 'KP', 'Asia/Pyongyang');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (212, 'KR', 'Asia/Seoul');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (213, 'KW', 'Asia/Kuwait');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (214, 'KY', 'America/Cayman');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (215, 'KZ', 'Asia/Almaty');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (216, 'KZ', 'Asia/Qyzylorda');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (217, 'KZ', 'Asia/Qostanay');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (218, 'KZ', 'Asia/Aqtobe');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (219, 'KZ', 'Asia/Aqtau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (220, 'KZ', 'Asia/Atyrau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (221, 'KZ', 'Asia/Oral');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (222, 'LA', 'Asia/Vientiane');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (223, 'LB', 'Asia/Beirut');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (224, 'LC', 'America/St_Lucia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (225, 'LI', 'Europe/Vaduz');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (226, 'LK', 'Asia/Colombo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (227, 'LR', 'Africa/Monrovia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (228, 'LS', 'Africa/Maseru');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (229, 'LT', 'Europe/Vilnius');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (230, 'LU', 'Europe/Luxembourg');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (231, 'LV', 'Europe/Riga');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (232, 'LY', 'Africa/Tripoli');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (233, 'MA', 'Africa/Casablanca');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (234, 'MC', 'Europe/Monaco');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (235, 'MD', 'Europe/Chisinau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (236, 'ME', 'Europe/Podgorica');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (237, 'MF', 'America/Marigot');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (238, 'MG', 'Indian/Antananarivo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (239, 'MH', 'Pacific/Majuro');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (240, 'MH', 'Pacific/Kwajalein');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (241, 'MK', 'Europe/Skopje');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (242, 'ML', 'Africa/Bamako');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (243, 'MM', 'Asia/Yangon');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (244, 'MN', 'Asia/Ulaanbaatar');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (245, 'MN', 'Asia/Hovd');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (246, 'MN', 'Asia/Choibalsan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (247, 'MO', 'Asia/Macau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (248, 'MP', 'Pacific/Saipan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (249, 'MQ', 'America/Martinique');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (250, 'MR', 'Africa/Nouakchott');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (251, 'MS', 'America/Montserrat');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (252, 'MT', 'Europe/Malta');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (253, 'MU', 'Indian/Mauritius');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (254, 'MV', 'Indian/Maldives');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (255, 'MW', 'Africa/Blantyre');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (256, 'MX', 'America/Mexico_City');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (257, 'MX', 'America/Cancun');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (258, 'MX', 'America/Merida');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (259, 'MX', 'America/Monterrey');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (260, 'MX', 'America/Matamoros');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (261, 'MX', 'America/Mazatlan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (262, 'MX', 'America/Chihuahua');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (263, 'MX', 'America/Ojinaga');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (264, 'MX', 'America/Hermosillo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (265, 'MX', 'America/Tijuana');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (266, 'MX', 'America/Bahia_Banderas');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (267, 'MY', 'Asia/Kuala_Lumpur');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (268, 'MY', 'Asia/Kuching');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (269, 'MZ', 'Africa/Maputo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (270, 'NA', 'Africa/Windhoek');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (271, 'NC', 'Pacific/Noumea');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (272, 'NE', 'Africa/Niamey');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (273, 'NF', 'Pacific/Norfolk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (274, 'NG', 'Africa/Lagos');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (275, 'NI', 'America/Managua');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (276, 'NL', 'Europe/Amsterdam');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (277, 'NO', 'Europe/Oslo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (278, 'NP', 'Asia/Kathmandu');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (279, 'NR', 'Pacific/Nauru');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (280, 'NU', 'Pacific/Niue');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (281, 'NZ', 'Pacific/Auckland');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (282, 'NZ', 'Pacific/Chatham');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (283, 'OM', 'Asia/Muscat');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (284, 'PA', 'America/Panama');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (285, 'PE', 'America/Lima');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (286, 'PF', 'Pacific/Tahiti');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (287, 'PF', 'Pacific/Marquesas');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (288, 'PF', 'Pacific/Gambier');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (289, 'PG', 'Pacific/Port_Moresby');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (290, 'PG', 'Pacific/Bougainville');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (291, 'PH', 'Asia/Manila');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (292, 'PK', 'Asia/Karachi');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (293, 'PL', 'Europe/Warsaw');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (294, 'PM', 'America/Miquelon');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (295, 'PN', 'Pacific/Pitcairn');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (296, 'PR', 'America/Puerto_Rico');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (297, 'PS', 'Asia/Gaza');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (298, 'PS', 'Asia/Hebron');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (299, 'PT', 'Europe/Lisbon');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (300, 'PT', 'Atlantic/Madeira');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (301, 'PT', 'Atlantic/Azores');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (302, 'PW', 'Pacific/Palau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (303, 'PY', 'America/Asuncion');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (304, 'QA', 'Asia/Qatar');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (305, 'RE', 'Indian/Reunion');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (306, 'RO', 'Europe/Bucharest');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (307, 'RS', 'Europe/Belgrade');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (308, 'RU', 'Europe/Kaliningrad');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (309, 'RU', 'Europe/Moscow');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (310, 'UA', 'Europe/Simferopol');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (311, 'RU', 'Europe/Kirov');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (312, 'RU', 'Europe/Volgograd');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (313, 'RU', 'Europe/Astrakhan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (314, 'RU', 'Europe/Saratov');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (315, 'RU', 'Europe/Ulyanovsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (316, 'RU', 'Europe/Samara');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (317, 'RU', 'Asia/Yekaterinburg');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (318, 'RU', 'Asia/Omsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (319, 'RU', 'Asia/Novosibirsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (320, 'RU', 'Asia/Barnaul');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (321, 'RU', 'Asia/Tomsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (322, 'RU', 'Asia/Novokuznetsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (323, 'RU', 'Asia/Krasnoyarsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (324, 'RU', 'Asia/Irkutsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (325, 'RU', 'Asia/Chita');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (326, 'RU', 'Asia/Yakutsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (327, 'RU', 'Asia/Khandyga');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (328, 'RU', 'Asia/Vladivostok');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (329, 'RU', 'Asia/Ust-Nera');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (330, 'RU', 'Asia/Magadan');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (331, 'RU', 'Asia/Sakhalin');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (332, 'RU', 'Asia/Srednekolymsk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (333, 'RU', 'Asia/Kamchatka');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (334, 'RU', 'Asia/Anadyr');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (335, 'RW', 'Africa/Kigali');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (336, 'SA', 'Asia/Riyadh');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (337, 'SB', 'Pacific/Guadalcanal');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (338, 'SC', 'Indian/Mahe');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (339, 'SD', 'Africa/Khartoum');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (340, 'SE', 'Europe/Stockholm');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (341, 'SG', 'Asia/Singapore');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (342, 'SH', 'Atlantic/St_Helena');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (343, 'SI', 'Europe/Ljubljana');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (344, 'SJ', 'Arctic/Longyearbyen');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (345, 'SK', 'Europe/Bratislava');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (346, 'SL', 'Africa/Freetown');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (347, 'SM', 'Europe/San_Marino');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (348, 'SN', 'Africa/Dakar');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (349, 'SO', 'Africa/Mogadishu');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (350, 'SR', 'America/Paramaribo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (351, 'SS', 'Africa/Juba');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (352, 'ST', 'Africa/Sao_Tome');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (353, 'SV', 'America/El_Salvador');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (354, 'SX', 'America/Lower_Princes');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (355, 'SY', 'Asia/Damascus');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (356, 'SZ', 'Africa/Mbabane');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (357, 'TC', 'America/Grand_Turk');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (358, 'TD', 'Africa/Ndjamena');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (359, 'TF', 'Indian/Kerguelen');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (360, 'TG', 'Africa/Lome');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (361, 'TH', 'Asia/Bangkok');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (362, 'TJ', 'Asia/Dushanbe');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (363, 'TK', 'Pacific/Fakaofo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (364, 'TL', 'Asia/Dili');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (365, 'TM', 'Asia/Ashgabat');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (366, 'TN', 'Africa/Tunis');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (367, 'TO', 'Pacific/Tongatapu');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (368, 'TR', 'Europe/Istanbul');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (369, 'TT', 'America/Port_of_Spain');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (370, 'TV', 'Pacific/Funafuti');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (371, 'TW', 'Asia/Taipei');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (372, 'TZ', 'Africa/Dar_es_Salaam');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (373, 'UA', 'Europe/Kiev');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (374, 'UA', 'Europe/Uzhgorod');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (375, 'UA', 'Europe/Zaporozhye');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (376, 'UG', 'Africa/Kampala');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (377, 'UM', 'Pacific/Midway');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (378, 'UM', 'Pacific/Wake');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (379, 'US', 'America/New_York');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (380, 'US', 'America/Detroit');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (381, 'US', 'America/Kentucky/Louisville');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (382, 'US', 'America/Kentucky/Monticello');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (383, 'US', 'America/Indiana/Indianapolis');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (384, 'US', 'America/Indiana/Vincennes');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (385, 'US', 'America/Indiana/Winamac');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (386, 'US', 'America/Indiana/Marengo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (387, 'US', 'America/Indiana/Petersburg');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (388, 'US', 'America/Indiana/Vevay');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (389, 'US', 'America/Chicago');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (390, 'US', 'America/Indiana/Tell_City');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (391, 'US', 'America/Indiana/Knox');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (392, 'US', 'America/Menominee');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (393, 'US', 'America/North_Dakota/Center');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (394, 'US', 'America/North_Dakota/New_Salem');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (395, 'US', 'America/North_Dakota/Beulah');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (396, 'US', 'America/Denver');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (397, 'US', 'America/Boise');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (398, 'US', 'America/Phoenix');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (399, 'US', 'America/Los_Angeles');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (400, 'US', 'America/Anchorage');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (401, 'US', 'America/Juneau');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (402, 'US', 'America/Sitka');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (403, 'US', 'America/Metlakatla');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (404, 'US', 'America/Yakutat');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (405, 'US', 'America/Nome');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (406, 'US', 'America/Adak');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (407, 'US', 'Pacific/Honolulu');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (408, 'UY', 'America/Montevideo');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (409, 'UZ', 'Asia/Samarkand');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (410, 'UZ', 'Asia/Tashkent');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (411, 'VA', 'Europe/Vatican');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (412, 'VC', 'America/St_Vincent');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (413, 'VE', 'America/Caracas');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (414, 'VG', 'America/Tortola');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (415, 'VI', 'America/St_Thomas');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (416, 'VN', 'Asia/Ho_Chi_Minh');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (417, 'VU', 'Pacific/Efate');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (418, 'WF', 'Pacific/Wallis');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (419, 'WS', 'Pacific/Apia');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (420, 'YE', 'Asia/Aden');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (421, 'YT', 'Indian/Mayotte');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (422, 'ZA', 'Africa/Johannesburg');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (423, 'ZM', 'Africa/Lusaka');
INSERT INTO `timezone` (`id`, `convention`, `zone`) VALUES (424, 'ZW', 'Africa/Harare');


#
# TABLE STRUCTURE FOR: top_menu
#

DROP TABLE IF EXISTS `top_menu`;

CREATE TABLE `top_menu` (
  `menuid` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` text NOT NULL,
  `menu_slug` varchar(70) NOT NULL,
  `parentid` int(11) NOT NULL,
  `entrydate` date NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`menuid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `top_menu` (`menuid`, `menu_name`, `menu_slug`, `parentid`, `entrydate`, `isactive`) VALUES (1, 'Home', 'hotel', 0, '2021-09-13', 1);
INSERT INTO `top_menu` (`menuid`, `menu_name`, `menu_slug`, `parentid`, `entrydate`, `isactive`) VALUES (2, 'About Us', 'about', 0, '2021-03-06', 1);
INSERT INTO `top_menu` (`menuid`, `menu_name`, `menu_slug`, `parentid`, `entrydate`, `isactive`) VALUES (3, 'Contact Us', 'contact', 0, '2021-01-07', 1);
INSERT INTO `top_menu` (`menuid`, `menu_name`, `menu_slug`, `parentid`, `entrydate`, `isactive`) VALUES (4, 'Gallery', 'gallery', 0, '2021-01-07', 1);
INSERT INTO `top_menu` (`menuid`, `menu_name`, `menu_slug`, `parentid`, `entrydate`, `isactive`) VALUES (5, 'My Profile', 'my-profile', 0, '2021-11-04', 1);


#
# TABLE STRUCTURE FOR: unit_of_measurement
#

DROP TABLE IF EXISTS `unit_of_measurement`;

CREATE TABLE `unit_of_measurement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_name` varchar(200) NOT NULL,
  `uom_short_code` varchar(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (1, 'Kilogram', 'kg.', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (2, 'Liter', 'ltr.', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (3, 'Gram', 'grm.', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (4, 'tonne', 'tn.', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (5, 'milligram', 'mg.', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (6, 'carat', 'carat', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (7, 'Per Pieces', 'pcs', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (8, 'Per Cup', 'cup', 1);
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES (9, 'Pound', 'pnd.', 1);


#
# TABLE STRUCTURE FOR: user
#

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `device_token` text DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `password_reset_token` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `ip_address` varchar(14) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `usertype` int(11) NOT NULL DEFAULT 1 COMMENT '1=user,2=employee',
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `user` (`id`, `firstname`, `lastname`, `about`, `email`, `device_token`, `password`, `password_reset_token`, `image`, `last_login`, `last_logout`, `ip_address`, `status`, `usertype`, `is_admin`) VALUES (1, NULL, NULL, NULL, 'admin@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '2024-11-16 15:13:03', NULL, '::1', 1, 1, 1);


#
# TABLE STRUCTURE FOR: weekly_holiday
#

DROP TABLE IF EXISTS `weekly_holiday`;

CREATE TABLE `weekly_holiday` (
  `wk_id` int(11) NOT NULL AUTO_INCREMENT,
  `dayname` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`wk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `weekly_holiday` (`wk_id`, `dayname`) VALUES (22, 'Friday');


