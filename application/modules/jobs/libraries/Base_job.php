<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Base Job Class
 * 
 * All job classes should extend this class to ensure consistent job handling
 */
abstract class Base_job {
    /**
     * CI Super Object
     * @var object
     */
    protected $CI;

    /**
     * Job data
     * @var array
     */
    protected $data;

    /**
     * Current attempt count
     * @var int
     */
    protected $attempts = 0;

    /**
     * Maximum number of attempts
     * @var int
     */
    protected $maxAttempts = 3;

    /**
     * Seconds to wait between retries
     * @var int
     */
    protected $backoff = 60;

    /**
     * Queue name
     * @var string
     */
    protected $queue = 'default';

    /**
     * Job timeout in seconds
     * @var int
     */
    protected $timeout = 60;

    /**
     * Whether to delete the job if related models are missing
     * @var bool
     */
    protected $deleteWhenMissingModels = true;

    /**
     * Constructor - Initializes the CI instance
     */
    public function __construct() {
        // Get CI instance using the global CI super object
        global $CI;
        if (!isset($CI)) {
            $CI = &get_instance();
        }
        $this->CI = $CI;

        // Initialize CI core components if needed
        if (!isset($this->CI->load)) {
            $this->CI->load = new CI_Loader();
            $this->CI->load->initialize();
        }
        if (!isset($this->CI->db)) {
            $this->CI->load->database();
        }

        // Default model loading for jobs
        $this->CI->load->model('jobs/jobs_model');
    }

    /**
     * Handle the job execution
     * This method must be implemented by all job classes
     * 
     * @param array $data
     * @return void
     */
    abstract public function handle($data);

    /**
     * Static method to create an instance with CI initialization
     */
    protected static function getInstance() {
        global $CI;
        if (!isset($CI)) {
            $CI = &get_instance();
            $CI->load = new CI_Loader();
            $CI->load->initialize();
            $CI->load->database();
        }
        return new static();
    }

    /**
     * Set the raw data for the job
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     * Set the number of times the job may be attempted
     */
    public function setMaxAttempts($attempts) {
        $this->maxAttempts = $attempts;
        return $this;
    }

    /**
     * Set the number of seconds to wait before retrying
     */
    public function setBackoff($seconds) {
        $this->backoff = $seconds;
        return $this;
    }

    /**
     * Set the queue for the job
     */
    public function onQueue($queue) {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Set the timeout for the job
     */
    public function setTimeout($seconds) {
        $this->timeout = $seconds;
        return $this;
    }

    /**
     * Get job settings
     */
    public function getSettings() {
        return [
            'queue' => $this->queue,
            'attempts' => $this->attempts,
            'maxAttempts' => $this->maxAttempts,
            'backoff' => $this->backoff,
            'timeout' => $this->timeout
        ];
    }

    /**
     * Handle a job failure
     */
    public function failed($exception) {
        log_message('error', 'Job failed: ' . get_class($this) . ' - ' . $exception->getMessage());
    }

    /**
     * Prepare for serialization
     */
    public function __sleep() {
        return ['data', 'attempts', 'maxAttempts', 'backoff', 'queue', 'timeout'];
    }

    /**
     * Prepare after unserialization
     */
    public function __wakeup() {
        $this->__construct();
    }
}
