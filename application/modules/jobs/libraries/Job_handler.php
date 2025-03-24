<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Job Handler Library
 * 
 * Handles job queuing, dispatching, and processing with Laravel-style syntax.
 * Provides a Laravel-style job queue system for CodeIgniter 3.
 */
class Job_handler {
    /**
     * CI instance
     * @var object
     */
    protected $CI;

    /**
     * Job configuration
     * @var array
     */
    protected $config;

    /**
     * Default configurations
     * @var array
     */
    private $defaults = [
        'default_queue' => 'default',
        'max_attempts' => 3,
        'retry_after' => 60,
        'queue_worker_sleep' => 3,
        'batch_size' => 100,
        'log_failed_jobs' => 1
    ];

    /**
     * Constructor - initializes the job handler with CI instance and configurations
     * 
     * @throws Exception If unable to initialize required dependencies
     */
    public function __construct() {
        try {
            // Get CI instance from global scope
            global $CI;
            if (!isset($CI)) {
                if (!function_exists('get_instance')) {
                    throw new Exception('CodeIgniter super object not available');
                }
                $CI = &get_instance();
            }
            $this->CI = $CI;

            // Initialize required CI components
            $this->initialize_ci_components();

            // Initialize configuration
            $this->load_config();

        } catch (Exception $e) {
            log_message('error', 'Job_handler initialization failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Initialize CI components needed by the job handler
     */
    private function initialize_ci_components() {
        // Initialize loader if not available
        if (!isset($this->CI->load)) {
            if (!class_exists('CI_Loader')) {
                throw new Exception('CI_Loader class not found');
            }
            $this->CI->load = new CI_Loader();
            $this->CI->load->initialize();
        }

        // Ensure database is loaded
        if (!isset($this->CI->db)) {
            $this->CI->load->database();
        }

        // Load required models
        if (!isset($this->CI->jobs_model)) {
            $this->CI->load->model('jobs/jobs_model');
            if (!isset($this->CI->jobs_model)) {
                throw new Exception('Failed to load jobs_model');
            }
        }
    }

    /**
     * Load and initialize job configurations
     * 
     * @return void
     */
    protected function load_config() {
        try {
            // Initialize with defaults
            $this->config = $this->defaults;

            // Load saved configurations from database
            $configs = $this->CI->jobs_model->get_configs();
            
            if ($configs) {
                foreach ($configs as $config) {
                    $this->config[$config->config_key] = $config->config_value;
                }
            }

            // Convert numeric strings to integers
            $integer_fields = ['max_attempts', 'retry_after', 'queue_worker_sleep', 'batch_size', 'log_failed_jobs'];
            foreach ($integer_fields as $field) {
                if (isset($this->config[$field])) {
                    $this->config[$field] = (int) $this->config[$field];
                }
            }

        } catch (Exception $e) {
            log_message('error', 'Failed to load job configurations: ' . $e->getMessage());
            // Keep using default configurations
            $this->config = $this->defaults;
        }
    }

    /**
     * Dispatch a new job to the queue
     * 
     * @param array $data Job data including handler class and method
     * @param string $queue Queue name (default: default)
     * @param int $delay Delay in seconds
     * @param int $priority Job priority (higher number = higher priority)
     * @return int|bool Job ID if successful, false on failure
     */
    public function dispatch($data, $queue = 'default', $delay = 0, $priority = 0) {
        try {
            // Validate required data
            if (empty($data['handler']) || empty($data['method'])) {
                throw new Exception('Missing required handler or method');
            }

            // Verify handler class exists
            if (!class_exists($data['handler'])) {
                throw new Exception('Handler class not found: ' . $data['handler']);
            }

            // Create job record
            $job = [
                'queue' => $queue,
                'payload' => json_encode([
                    'handler' => $data['handler'],
                    'method' => $data['method'],
                    'data' => $data['data'] ?? []
                ]),
                'handler' => $data['handler'],
                'priority' => (int) $priority,
                'available_at' => date('Y-m-d H:i:s', strtotime("+{$delay} seconds")),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $job_id = $this->CI->jobs_model->create_job($job);
            if (!$job_id) {
                throw new Exception('Failed to create job record');
            }

            return $job_id;

        } catch (Exception $e) {
            log_message('error', 'Job dispatch failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Process the next job in the queue
     * 
     * @param string $queue Queue name
     * @return bool True if job was processed, false if no jobs or error
     */
    public function process_next($queue = 'default') {
        try {
            // Get next available job
            $job = $this->CI->jobs_model->get_next_job($queue);
            if (!$job) {
                return false;
            }

            // Mark job as processing
            $this->CI->jobs_model->mark_job_processing($job->id);

            // Get job details
            $payload = json_decode($job->payload, true);
            $handler = $payload['handler'];
            $method = $payload['method'];
            $data = $payload['data'] ?? [];

            // Create handler instance
            if (!class_exists($handler)) {
                throw new Exception("Handler class {$handler} not found");
            }

            $instance = new $handler();
            if (!method_exists($instance, $method)) {
                throw new Exception("Method {$method} not found in handler {$handler}");
            }

            // Execute the job
            $instance->$method($data);

            // Mark job as completed
            $this->CI->jobs_model->mark_job_completed($job->id);
            return true;

        } catch (Exception $e) {
            if (isset($job)) {
                $this->handle_failed_job($job, $e);
            }
            return false;
        }
    }

    /**
     * Handle a failed job
     */
    protected function handle_failed_job($job, $exception) {
        try {
            $attempts = $job->attempts + 1;
            $max_attempts = $this->config['max_attempts'];

            if ($attempts >= $max_attempts) {
                // Move to failed jobs table
                $this->CI->jobs_model->move_to_failed($job, $exception);
            } else {
                // Increment attempts and make available again
                $retry_after = $this->config['retry_after'];
                $this->CI->jobs_model->retry_job($job->id, $attempts, $retry_after);
            }

            if ($this->config['log_failed_jobs']) {
                log_message('error', sprintf(
                    "Job %d (%s) failed (attempt %d/%d): %s",
                    $job->id,
                    $job->handler,
                    $attempts,
                    $max_attempts,
                    $exception->getMessage()
                ));
            }
        } catch (Exception $e) {
            log_message('error', 'Error handling failed job: ' . $e->getMessage());
        }
    }

    /**
     * Get job statistics
     * 
     * @return array Statistics including counts of jobs in different states
     */
    public function get_stats() {
        try {
            return [
                'pending' => $this->CI->jobs_model->count_jobs('pending'),
                'processing' => $this->CI->jobs_model->count_jobs('processing'),
                'completed' => $this->CI->jobs_model->count_jobs('completed'),
                'failed' => $this->CI->jobs_model->count_failed_jobs(),
                'config' => $this->config
            ];
        } catch (Exception $e) {
            log_message('error', 'Error getting job stats: ' . $e->getMessage());
            return [
                'error' => 'Failed to get job statistics',
                'pending' => 0,
                'processing' => 0,
                'completed' => 0,
                'failed' => 0
            ];
        }
    }
}