INSERT INTO `language` (`phrase`, `english`) VALUES('assignto', 'Assign To');
INSERT INTO `language` (`phrase`, `english`) VALUES('underprocess', 'Under Process');
INSERT INTO `language` (`phrase`, `english`) VALUES('addnew_checklist', 'New Checklist');
INSERT INTO `language` (`phrase`, `english`) VALUES('task_name', 'Task Name');
INSERT INTO `language` (`phrase`, `english`) VALUES('checklist', 'Cheklist');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'in_use', 'In Use');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'in_laundry', 'In Laundry');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'ready', 'Ready');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'cleaning_report', 'Cleaning Report');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'searched_records', 'Searched Records');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'assign_by', 'Assign By');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'completed', 'Completed');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'searched_report', 'Searched Report');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'manage_item', 'Manage Item');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'litem_name', 'Item Name');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'item_list', 'Item List');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'recieve', 'Recieve');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'operate_by', 'Operate By');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'total_cost', 'Total Cost');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'laundry_payment', 'Laundry Payment');
INSERT INTO `language` (`phrase`, `english`) VALUES( 'all_records', 'All Records');

INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('92','house_keeping', 'house-keeping', 'house_keeping', 0, 0, 1, '2021-11-DDD 00:00:00');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('room_cleaning', 'room-cleaning', 'house_keeping', 92, 0, 1, '2021-11-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('assign_room_cleaning', 'house-keeping', 'house_keeping', 92, 0, 1, '2021-11-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('payment', 'payment', 'house_keeping', 120, 0, 1, '2021-11-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('records', 'records', 'house_keeping', 92, 0, 1, '2021-11-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('checklist', 'checklist', 'house_keeping', 92, 0, 1, '2021-11-10 00:00:00');
INSERT INTO `language` (`phrase`, `english`) VALUES('room_cleaning_details', 'Room Cleaning Details');
INSERT INTO `language` (`phrase`, `english`) VALUES('roomqr_list', 'Room Qr List');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('roomqr_list', 'roomqr_list', 'house_keeping', 92, 0, 1, '2021-11-22 00:00:00');
ALTER TABLE `user` ADD `device_token` TEXT NULL DEFAULT NULL AFTER `email`;
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('reports', 'reports', 'house_keeping', 92, 0, 1, '2021-08-19 00:00:00');
INSERT INTO `language` (`phrase`, `english`) VALUES('records', 'Records');
INSERT INTO `language` (`phrase`, `english`) VALUES('laundry', 'Laundry');
INSERT INTO `sec_menu_item` (`menu_id`,`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('120', 'laundry', 'laundry', 'house_keeping', 92, 0, 1, '2021-08-24 00:00:00');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('laundry_list', 'laundry-list', 'house_keeping', 120, 0, 1, '2021-08-28 00:00:00');
INSERT INTO `language` (`phrase`, `english`) VALUES('laundry_list', 'Laundry List');
INSERT INTO `language` (`phrase`, `english`) VALUES('item_cost', 'Item Cost');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('reuse_list', 'reuse-list', 'house_keeping', 120, 0, 1, '2021-08-26 00:00:00');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES('item_cost', 'item-cost', 'house_keeping', 120, 0, 1, '2021-08-26 00:00:00');
INSERT INTO `tbl_laundry_payment` (`landry_id`, `name`, `total_amount`, `paid_amount`, `due_amount`) VALUES(null, 'Laundry', '0.00', '0.00', '0.00');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES
('4020409', 'Laundry Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, '0.00', '1', '2021-10-02 16:49:56', '', '0000-00-00 00:00:00');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES
(6, 'House Keeper', 'House keepers are worked as room cleaner and laundry iteam carrier for the hotel');
INSERT INTO `tbl_category` (`category_id`, `categoryname`, `status`) VALUES
(501, 'Houekeeping products', '1');