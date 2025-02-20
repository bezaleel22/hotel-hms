INSERT INTO `language` (`id`, `phrase`, `english`) VALUES 
(NULL, 'create_roster', 'Create Roster'),
(NULL, 'duty_roster', 'Duty Roster'),
(NULL, 'shift_name', 'Shift Name'),
(NULL, 'roster_start_date', 'Roster Start Date'),
(NULL, 'roster_end_date', 'Roster End Date'),
(NULL, 'roster_days', 'Roster days'),
(NULL, 'shift_update', 'Update Shift'),
(NULL, 'roster_list', 'Roster List'),
(NULL, 'shift_assign_add', 'Roster Assign'),
(NULL, 'select_roster', 'Select Roster'),
(NULL, 'shift_assign_update', 'Shift Assign Update'),
(NULL, 'assign_employee', 'Assign Employee'),
(NULL, 'shift_start', 'Shift Start'),
(NULL, 'shift_end', 'Shift End'),
(NULL, 'shift_time', 'Shift Hour'),
(NULL, 'shift_add', 'Add Shift'),
(NULL, 'shift_list', 'Shift List'),
(NULL, 'shift_hour', 'Shift Hour'),
(NULL, 'shift_start_date', 'Shift Start Date'),
(NULL, 'assigned_roster_list', 'Assigned Roster List'),
(NULL, 'roster_edit', 'Update Roster'),
(NULL, 'shift_end_date', 'Shift End Date'),
(NULL, 'assigned_emp', 'Assigned Employee');
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
VALUES ('shift_mgt', 'Shift_management', 'duty_roster', '0', '0', '1', '2021-07-04 00:00:00');

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'shift_list', 'shift_list', 'duty_roster', sec_menu_item.menu_id, '0', '1', '2021-07-04 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'shift_mgt';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'shift_assign', 'shift_assign_list', 'duty_roster', sec_menu_item.menu_id, '0', '1', '2021-07-04 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'shift_mgt';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'roster_list', 'roster_list', 'duty_roster', sec_menu_item.menu_id, '0', '1', '2021-07-04 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'shift_mgt';

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
SELECT 'attendance_dashboard', 'attendance_dashboard', 'duty_roster', sec_menu_item.menu_id, '0', '1', '2021-07-04 00:00:00' 
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'shift_mgt';
