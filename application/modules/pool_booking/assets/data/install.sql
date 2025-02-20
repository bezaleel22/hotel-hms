INSERT INTO `language` (`id`, `phrase`, `english`) VALUES 
(NULL, 'pool_booking', 'Pool Booking'),
(NULL, 'add_pool_booking', 'Pool Booking Add'),
(NULL, 'p_booking_list', 'Pool Booking List'),
(NULL, 'package_name', 'Package Name'),
(NULL, 'doc_type', 'Doc Type'),
(NULL, 'doc_num', 'Doc Number'),
(NULL, 'update_pool_booking', 'Pool Booking Update'),
(NULL, 'pool_booking_list', 'Booking'),
(NULL, 'pool_name', 'Pool Name'),
(NULL, 'date_to', 'Date To'),
(NULL, 'pool_details', 'Pool Details'),
(NULL, 'type_name', 'Type Name'),
(NULL, 'pool_type_add', 'Add Pool Type'),
(NULL, 'swimming_pool_add', 'Add Swimming Pool'),
(NULL, 'add_to_invoice', 'Add To Invoice'),
(NULL, 'nid', 'NID'),
(NULL, 'passport', 'Passport'),
(NULL, 'un_maintenence', 'Under Maintenence'),
(NULL, 'booked', 'Booked');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
VALUES ('pool_booking', 'pool_booking', 'pool_booking', '0', '0', '1', '2021-06-06 00:00:00');

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'pool_type', 'pool_type', 'pool_booking', sec_menu_item.menu_id, '0', '1', '2021-06-06 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'pool_booking';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'swimming_pool', 'swimming_pool', 'pool_booking', sec_menu_item.menu_id, '0', '1', '2021-06-06 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'pool_booking';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'pool_booking_list', 'pool_booking_list', 'pool_booking', sec_menu_item.menu_id, '0', '1', '2021-06-06 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'pool_booking';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'pool_package', 'pool_package', 'pool_booking', sec_menu_item.menu_id, '0', '1', '2021-06-06 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'pool_booking';

INSERT INTO acc_coa (HeadCode, HeadName, PHeadName, HeadLevel, IsActive, IsTransaction, IsGL, HeadType, IsBudget, IsDepreciation, DepreciationRate, CreateBy, CreateDate, UpdateBy, UpdateDate) 
VALUES('30302', 'Swimming Pool Booking', 'Service', 2, 1, 1, 0, 'I', 0, 0, '0.00', '1', '2021-10-02 16:52:52', '', '0000-00-00 00:00:00');