<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Jobs module menu configuration
$HmvcMenu["jobs"] = array(
    "icon" => "<i class='fa fa-tasks'></i>", // Tasks icon for job management
    
    // Parent menu for Jobs
    "jobs" => array(
        "controller" => "jobs",
        "method" => "index",
        "permission" => "read",
        "url" => "jobs/index",
        
        // Submenu items
        "submenu" => array(
            "pending_jobs" => array(
                "controller" => "jobs",
                "method" => "pending",
                "permission" => "read",
                "url" => "jobs/pending"
            ),
            "failed_jobs" => array(
                "controller" => "jobs",
                "method" => "failed",
                "permission" => "read",
                "url" => "jobs/failed"
            ),
            "job_batches" => array(
                "controller" => "jobs",
                "method" => "batches",
                "permission" => "read",
                "url" => "jobs/batches"
            ),
            "job_settings" => array(
                "controller" => "jobs",
                "method" => "settings",
                "permission" => "update",
                "url" => "jobs/settings"
            )
        )
    )
);