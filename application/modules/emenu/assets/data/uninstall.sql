-- E-Menu Module Uninstallation Cleanup

-- Remove language strings
DELETE FROM `language` 
WHERE `phrase` IN (
    'menu_dashboard',
    'qr_management',
    'menu_settings',
    'general_settings',
    'appearance',
    'menu_display',
    'analytics',
    'generate_qr',
    'regenerate_qr',
    'table_qr_codes',
    'scan_to_order',
    'active_sessions',
    'menu_categories',
    'menu_items',
    'cart',
    'add_to_cart',
    'place_order',
    'special_instructions',
    'select_addons',
    'order_placed',
    'order_status',
    'split_bill',
    'pay_bill',
    'call_waiter',
    'table_number',
    'session_expired',
    'invalid_qr',
    'order_history',
    'reorder',
    'menu_search',
    'filter_menu',
    'sort_by',
    'price_low_high',
    'price_high_low',
    'popularity',
    'categories',
    'no_items_found',
    'loading_menu'
);

-- Remove menu items and permissions
DELETE FROM `sec_role_permission` 
WHERE `menu_id` IN (
    SELECT `menu_id` 
    FROM `sec_menu_item` 
    WHERE `module` = 'emenu'
);

DELETE FROM `sec_menu_item` 
WHERE `module` = 'emenu';

-- Remove e-menu specific column from order_menu
ALTER TABLE `order_menu` 
DROP FOREIGN KEY `fk_emenu_session`,
DROP COLUMN `emenu_session_id`;

-- Drop module tables in correct order to respect foreign keys
DROP TABLE IF EXISTS `emenu_sessions`;
DROP TABLE IF EXISTS `emenu_qr_tables`;
DROP TABLE IF EXISTS `tbl_emenu_config`;