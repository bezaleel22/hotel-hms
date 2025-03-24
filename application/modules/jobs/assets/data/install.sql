-- Add language strings for the Jobs module
INSERT INTO `language` (`phrase`, `english`) VALUES
('jobs', 'Jobs'),
('pending_jobs', 'Pending Jobs'),
('failed_jobs', 'Failed Jobs'),
('job_batches', 'Job Batches'),
('job_settings', 'Job Settings'),
('queue', 'Queue'),
('priority', 'Priority'),
('attempts', 'Attempts'),
('status', 'Status'),
('available_at', 'Available At'),
('created_at', 'Created At'),
('reserved_at', 'Reserved At'),
('failed_at', 'Failed At'),
('exception', 'Exception'),
('total_jobs', 'Total Jobs'),
('pending_jobs_count', 'Pending Jobs'),
('failed_jobs_count', 'Failed Jobs'),
('batch_name', 'Batch Name'),
('batch_status', 'Batch Status'),
('finished_at', 'Finished At'),
('retry_job', 'Retry Job'),
('delete_job', 'Delete Job'),
('clear_failed_jobs', 'Clear Failed Jobs'),
('job_details', 'Job Details'),
('job_payload', 'Job Payload'),
('job_handler', 'Job Handler');

-- Add module menu items
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`)
VALUES 
('jobs', 'jobs/index', 'jobs', '0', '0', '1', CURRENT_TIMESTAMP);

-- Get the parent menu ID
SET @parent_menu_id = LAST_INSERT_ID();

-- Add submenu items
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`)
VALUES 
('pending_jobs', 'jobs/pending', 'jobs', @parent_menu_id, '0', '1', CURRENT_TIMESTAMP),
('failed_jobs', 'jobs/failed', 'jobs', @parent_menu_id, '0', '1', CURRENT_TIMESTAMP),
('job_batches', 'jobs/batches', 'jobs', @parent_menu_id, '0', '1', CURRENT_TIMESTAMP),
('job_settings', 'jobs/settings', 'jobs', @parent_menu_id, '0', '1', CURRENT_TIMESTAMP);

-- Add default configuration
INSERT INTO `tbl_jobs_config` (`config_key`, `config_value`) VALUES
('default_queue', 'default'),
('max_attempts', '3'),
('retry_after', '60'),
('queue_worker_sleep', '3'),
('batch_size', '100'),
('log_failed_jobs', '1');