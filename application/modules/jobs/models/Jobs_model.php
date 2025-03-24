<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all configuration values
     */
    public function get_configs() {
        return $this->db->get('tbl_jobs_config')->result();
    }

    /**
     * Create a new job
     */
    public function create_job($data) {
        $this->db->insert('tbl_jobs', $data);
        return $this->db->insert_id();
    }

    /**
     * Create a new job batch
     */
    public function create_batch($data) {
        $this->db->insert('tbl_jobs_batches', $data);
        return $this->db->insert_id();
    }

    /**
     * Get next available job
     */
    public function get_next_job($queue) {
        return $this->db
            ->where('queue', $queue)
            ->where('status', 'pending')
            ->where('available_at <=', date('Y-m-d H:i:s'))
            ->order_by('priority DESC, created_at ASC')
            ->limit(1)
            ->get('tbl_jobs')
            ->row();
    }

    /**
     * Mark job as processing
     */
    public function mark_job_processing($job_id) {
        return $this->db
            ->where('id', $job_id)
            ->update('tbl_jobs', [
                'status' => 'processing',
                'reserved_at' => date('Y-m-d H:i:s')
            ]);
    }

    /**
     * Mark job as completed
     */
    public function mark_job_completed($job_id) {
        return $this->db
            ->where('id', $job_id)
            ->update('tbl_jobs', [
                'status' => 'completed'
            ]);
    }

    /**
     * Move job to failed jobs table
     */
    public function move_to_failed($job, $exception) {
        // Insert into failed jobs
        $this->db->insert('tbl_jobs_failed', [
            'job_id' => $job->id,
            'connection' => 'database',
            'queue' => $job->queue,
            'payload' => $job->payload,
            'exception' => $exception->getMessage() . "\n" . $exception->getTraceAsString()
        ]);

        // Update original job status
        $this->db
            ->where('id', $job->id)
            ->update('tbl_jobs', [
                'status' => 'failed'
            ]);

        // Update batch if part of one
        if (!empty($job->batch_id)) {
            $this->db->where('id', $job->batch_id)
                ->set('failed_jobs', 'failed_jobs + 1', FALSE)
                ->update('tbl_jobs_batches');
        }
    }

    /**
     * Retry a failed job
     */
    public function retry_job($job_id, $attempts, $retry_after) {
        return $this->db
            ->where('id', $job_id)
            ->update('tbl_jobs', [
                'status' => 'pending',
                'attempts' => $attempts,
                'available_at' => date('Y-m-d H:i:s', strtotime("+{$retry_after} seconds"))
            ]);
    }

    /**
     * Retry a failed job by moving it back to jobs table
     */
    public function retry_failed_job($failed_job_id) {
        $failed = $this->db->where('id', $failed_job_id)
            ->get('tbl_jobs_failed')
            ->row();

        if (!$failed) {
            return false;
        }

        // Create new job from failed one
        $job_id = $this->create_job([
            'queue' => $failed->queue,
            'payload' => $failed->payload,
            'handler' => json_decode($failed->payload, true)['handler'] ?? '',
            'attempts' => 0,
            'status' => 'pending',
            'available_at' => date('Y-m-d H:i:s')
        ]);

        if ($job_id) {
            // Remove from failed jobs
            $this->db->where('id', $failed_job_id)
                ->delete('tbl_jobs_failed');
            return true;
        }

        return false;
    }

    /**
     * Clear all failed jobs
     */
    public function clear_failed_jobs() {
        return $this->db->truncate('tbl_jobs_failed');
    }

    /**
     * Count jobs by status
     */
    public function count_jobs($status) {
        return $this->db
            ->where('status', $status)
            ->count_all_results('tbl_jobs');
    }

    /**
     * Count failed jobs
     */
    public function count_failed_jobs() {
        return $this->db->count_all_results('tbl_jobs_failed');
    }

    /**
     * Get jobs with pagination
     */
    public function get_jobs($status = null, $limit = 10, $offset = 0) {
        if ($status) {
            $this->db->where('status', $status);
        }
        return $this->db
            ->order_by('created_at', 'DESC')
            ->limit($limit, $offset)
            ->get('tbl_jobs')
            ->result();
    }

    /**
     * Get failed jobs with pagination
     */
    public function get_failed_jobs($limit = 10, $offset = 0) {
        return $this->db
            ->order_by('failed_at', 'DESC')
            ->limit($limit, $offset)
            ->get('tbl_jobs_failed')
            ->result();
    }

    /**
     * Get job batches with pagination
     */
    public function get_batches($limit = 10, $offset = 0) {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->limit($limit, $offset)
            ->get('tbl_jobs_batches')
            ->result();
    }
}