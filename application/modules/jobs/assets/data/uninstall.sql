-- Remove all language phrases
DELETE FROM `language` WHERE phrase IN (
    'jobs',
    'pending_jobs',
    'failed_jobs',
    'job_batches',
    'job_settings',
    'queue',
    'priority',
    'attempts',
    'status',
    'available_at',
    'created_at',
    'reserved_at',
    'failed_at',
    'exception',
    'total_jobs',
    'pending_jobs_count',
    'failed_jobs_count',
    'batch_name',
    'batch_status',
    'finished_at',
    'retry_job',
    'delete_job',
    'clear_failed_jobs',
    'job_details',
    'job_payload',
    'job_handler'
);

-- Remove all menu items for the jobs module
DELETE FROM `sec_menu_item` WHERE module = 'jobs';

-- Drop module tables
DROP TABLE IF EXISTS `tbl_jobs`;
DROP TABLE IF EXISTS `tbl_jobs_failed`;
DROP TABLE IF EXISTS `tbl_jobs_batches`;
DROP TABLE IF EXISTS `tbl_jobs_config`;