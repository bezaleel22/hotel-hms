<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Module configuration
$HmvcConfig['jobs']["_title"] = "Job Queue Manager";
$HmvcConfig['jobs']["_description"] = "Background job processing system for Hotel HMS";
$HmvcConfig['jobs']["_version"] = 1.0;

// Database configuration
$HmvcConfig['jobs']['_database'] = true;
$HmvcConfig['jobs']['_extra_query'] = true;

// Tables used by this module
$HmvcConfig['jobs']["_tables"] = array(
    'tbl_jobs',           // Main jobs table
    'tbl_jobs_failed',    // Failed jobs table
    'tbl_jobs_batches',   // Job batches table
    'tbl_jobs_config'     // Module configuration
);