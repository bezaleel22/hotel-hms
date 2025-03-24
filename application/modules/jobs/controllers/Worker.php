<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Worker extends MX_Controller {
    
    private $sleep_time = 3;
    private $max_jobs = 100;
    private $max_runtime = 3600; // 1 hour
    private $start_time;
    private $processed_jobs = 0;

    public function __construct() {
        parent::__construct();
        
        // Only allow CLI access
        if (!is_cli()) {
            show_error('This script can only be accessed via CLI');
            exit;
        }

        $this->load->model('jobs_model');
        $this->load->library(['job_handler']);
        
        // Load configuration
        $configs = $this->jobs_model->get_configs();
        foreach ($configs as $config) {
            if ($config->config_key === 'queue_worker_sleep') {
                $this->sleep_time = (int)$config->config_value;
            }
            if ($config->config_key === 'batch_size') {
                $this->max_jobs = (int)$config->config_value;
            }
        }
    }

    /**
     * Process jobs from the queue
     * Usage: php index.php jobs worker start [queue_name]
     */
    public function start($queue = 'default') {
        $this->start_time = time();
        
        echo "Starting job worker for queue: {$queue}\n";
        echo "Press Ctrl+C to stop\n\n";

        while (true) {
            try {
                // Process next job
                $processed = $this->job_handler->process_next($queue);
                
                if ($processed) {
                    $this->processed_jobs++;
                    echo date('Y-m-d H:i:s') . " - Processed job from queue: {$queue}\n";
                } else {
                    // No jobs to process, sleep for a while
                    sleep($this->sleep_time);
                }

                // Check if we should stop
                if ($this->should_stop()) {
                    break;
                }

            } catch (Exception $e) {
                echo date('Y-m-d H:i:s') . " - Error: " . $e->getMessage() . "\n";
                
                // Sleep before retrying
                sleep($this->sleep_time);
            }
        }

        $runtime = time() - $this->start_time;
        echo "\nWorker stopped after {$runtime} seconds\n";
        echo "Processed {$this->processed_jobs} jobs\n";
    }

    /**
     * Process a single batch of jobs and exit
     * Useful for cron jobs
     * Usage: php index.php jobs worker work [queue_name]
     */
    public function work($queue = 'default') {
        echo date('Y-m-d H:i:s') . " - Starting batch job processing for queue: {$queue}\n";
        
        $processed = 0;
        $start = time();

        // Process up to max_jobs
        while ($processed < $this->max_jobs) {
            try {
                $result = $this->job_handler->process_next($queue);
                
                if ($result) {
                    $processed++;
                    echo date('Y-m-d H:i:s') . " - Processed job from queue: {$queue}\n";
                } else {
                    // No more jobs to process
                    break;
                }
            } catch (Exception $e) {
                echo date('Y-m-d H:i:s') . " - Error: " . $e->getMessage() . "\n";
                break;
            }
        }

        $runtime = time() - $start;
        echo "\nCompleted processing {$processed} jobs in {$runtime} seconds\n";
    }

    /**
     * Check if the worker should stop
     */
    private function should_stop() {
        // Stop if we've processed maximum number of jobs
        if ($this->processed_jobs >= $this->max_jobs) {
            echo "Reached maximum number of jobs ({$this->max_jobs})\n";
            return true;
        }

        // Stop if we've been running too long
        $runtime = time() - $this->start_time;
        if ($runtime >= $this->max_runtime) {
            echo "Reached maximum runtime ({$this->max_runtime} seconds)\n";
            return true;
        }

        return false;
    }

    /**
     * Display worker status
     * Usage: php index.php jobs worker status
     */
    public function status() {
        $stats = $this->job_handler->get_stats();
        
        echo "\nJob Queue Status:\n";
        echo "----------------\n";
        echo "Pending Jobs: {$stats['pending']}\n";
        echo "Processing Jobs: {$stats['processing']}\n";
        echo "Completed Jobs: {$stats['completed']}\n";
        echo "Failed Jobs: {$stats['failed']}\n";
        echo "----------------\n";
    }

    /**
     * Display help information
     * Usage: php index.php jobs worker help
     */
    public function help() {
        echo "\nJob Worker Commands:\n";
        echo "----------------\n";
        echo "start [queue]   - Start processing jobs (continuous)\n";
        echo "work [queue]    - Process a single batch of jobs\n";
        echo "status         - Display queue statistics\n";
        echo "help           - Display this help message\n\n";
        echo "Examples:\n";
        echo "php index.php jobs worker start default\n";
        echo "php index.php jobs worker work emails\n";
        echo "----------------\n";
    }

    /**
     * Default method - show help
     */
    public function index() {
        $this->help();
    }
}