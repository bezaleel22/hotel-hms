-- E-Menu Module Installation Data

-- Initialize module configuration
INSERT INTO `tbl_emenu_config` (`setting_name`, `setting_value`) VALUES
('theme_primary_color', '#C6A15B'),
('theme_secondary_color', '#362514'),
('enable_dark_mode', '1'),
('session_timeout', '3600'),
('qr_expiry_hours', '24'),
('enable_table_selection', '1'),
('enable_split_bill', '1'),
('enable_reorder', '1'),
('menu_items_per_page', '12');

-- Add language strings
INSERT INTO `language` (`phrase`, `english`) VALUES
('menu_dashboard', 'E-Menu Dashboard'),
('qr_management', 'QR Code Management'),
('menu_settings', 'Menu Settings'),
('general_settings', 'General Settings'),
('appearance', 'Appearance Settings'),
('menu_display', 'Menu Display'),
('analytics', 'Analytics'),
('generate_qr', 'Generate QR Code'),
('regenerate_qr', 'Regenerate QR Code'),
('table_qr_codes', 'Table QR Codes'),
('scan_to_order', 'Scan to Order'),
('active_sessions', 'Active Sessions'),
('menu_categories', 'Menu Categories'),
('menu_items', 'Menu Items'),
('cart', 'Your Cart'),
('add_to_cart', 'Add to Cart'),
('place_order', 'Place Order'),
('special_instructions', 'Special Instructions'),
('select_addons', 'Select Add-ons'),
('order_placed', 'Order Placed Successfully'),
('order_status', 'Order Status'),
('split_bill', 'Split Bill'),
('pay_bill', 'Pay Bill'),
('call_waiter', 'Call Waiter'),
('table_number', 'Table Number'),
('session_expired', 'Session Expired'),
('invalid_qr', 'Invalid QR Code'),
('order_history', 'Order History'),
('reorder', 'Reorder'),
('menu_search', 'Search Menu'),
('filter_menu', 'Filter Menu'),
('sort_by', 'Sort By'),
('price_low_high', 'Price: Low to High'),
('price_high_low', 'Price: High to Low'),
('popularity', 'Popularity'),
('categories', 'Categories'),
('no_items_found', 'No Items Found'),
('loading_menu', 'Loading Menu');

-- Add menu items
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) 
VALUES
('menu_dashboard', 'emenu/dashboard', 'emenu', '0', '0', '1', CURRENT_TIMESTAMP);

SET @parent_id = LAST_INSERT_ID();

INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`)
VALUES 
('qr_management', 'emenu/qr-management', 'emenu', @parent_id, '0', '1', CURRENT_TIMESTAMP),
('menu_settings', 'emenu/settings', 'emenu', @parent_id, '0', '1', CURRENT_TIMESTAMP),
('analytics', 'emenu/analytics', 'emenu', @parent_id, '0', '1', CURRENT_TIMESTAMP);

-- Grant necessary permissions for the module
INSERT INTO `sec_role_permission` (`role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`)
SELECT '1', `sec_menu_item`.`menu_id`, '1', '1', '1', '1', '1', CURRENT_TIMESTAMP
FROM `sec_menu_item` 
WHERE `sec_menu_item`.`module` = 'emenu';