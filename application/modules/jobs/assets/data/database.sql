-- Jobs table - Stores queued jobs
CREATE TABLE IF NOT EXISTS `tbl_jobs` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `queue` varchar(255) NOT NULL DEFAULT 'default',
    `payload` longtext NOT NULL,
    `handler` varchar(255) NOT NULL,
    `attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
    `status` enum('pending','processing','completed','failed') NOT NULL DEFAULT 'pending',
    `priority` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
    `reserved_at` timestamp NULL DEFAULT NULL,
    `available_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_status_index` (`queue`, `status`),
    KEY `jobs_priority_available_at_index` (`priority`, `available_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Failed jobs table - Stores failed job information
CREATE TABLE IF NOT EXISTS `tbl_jobs_failed` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `job_id` bigint(20) UNSIGNED NULL,
    `connection` text NOT NULL,
    `queue` varchar(255) NOT NULL,
    `payload` longtext NOT NULL,
    `exception` longtext NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `failed_jobs_job_id_index` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Job batches table - Groups related jobs together
CREATE TABLE IF NOT EXISTS `tbl_jobs_batches` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `total_jobs` int(11) NOT NULL,
    `pending_jobs` int(11) NOT NULL,
    `failed_jobs` int(11) NOT NULL DEFAULT '0',
    `status` enum('pending','processing','completed','failed') NOT NULL DEFAULT 'pending',
    `options` text NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `finished_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `job_batches_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Module configuration table
CREATE TABLE IF NOT EXISTS `tbl_jobs_config` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `config_key` varchar(255) NOT NULL,
    `config_value` text NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `config_key_unique` (`config_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;