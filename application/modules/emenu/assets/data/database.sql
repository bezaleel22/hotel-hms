-- E-Menu Module Database Schema

-- Configuration table
CREATE TABLE IF NOT EXISTS `tbl_emenu_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_name` (`setting_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- QR code table for table-specific QR codes
CREATE TABLE IF NOT EXISTS `emenu_qr_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `table_id` (`table_id`),
  CONSTRAINT `fk_qr_table` FOREIGN KEY (`table_id`) REFERENCES `rest_table` (`tableid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Session management for active menu sessions
CREATE TABLE IF NOT EXISTS `emenu_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `table_id` (`table_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `fk_session_table` FOREIGN KEY (`table_id`) REFERENCES `rest_table` (`tableid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_session_customer` FOREIGN KEY (`customer_id`) REFERENCES `customerinfo` (`customerid`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- E-Menu specific order tracking additions
ALTER TABLE `order_menu` 
ADD COLUMN `emenu_session_id` int(11) DEFAULT NULL,
ADD KEY `fk_emenu_session` (`emenu_session_id`),
ADD CONSTRAINT `fk_emenu_session` FOREIGN KEY (`emenu_session_id`) REFERENCES `emenu_sessions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;