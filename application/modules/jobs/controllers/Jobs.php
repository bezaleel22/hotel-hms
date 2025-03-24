<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('jobs_model');
        $this->load->library(['job_handler']);
        
        // Load common HMS libraries
        $this->load->library(['template', 'pagination']);

        // Only allow admin access
        if (!$this->session->userdata('isAdmin')) {
            redirect('login');
        }
    }

    /**
     * Jobs dashboard
     */
    public function index() {
        $data['title'] = display('job_queue_manager');
        $data['stats'] = $this->job_handler->get_stats();
        
        // Get recent jobs
        $data['recent_jobs'] = $this->jobs_model->get_jobs(null, 10);
        $data['recent_failed'] = $this->jobs_model->get_failed_jobs(10);
        
        $data['module'] = "jobs";
        $data['page'] = "dashboard";
        
        echo Modules::run('template/layout', $data);
    }

    /**
     * View pending jobs
     */
    public function pending() {
        $page = $this->input->get('page', TRUE) ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $data['title'] = display('pending_jobs');
        $data['jobs'] = $this->jobs_model->get_jobs('pending', $limit, $offset);
        
        // Configure pagination
        $total = $this->jobs_model->count_jobs('pending');
        $config['base_url'] = base_url('jobs/pending');
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        
        $data['pagination'] = $this->pagination->create_links();
        $data['module'] = "jobs";
        $data['page'] = "pending_jobs";
        
        echo Modules::run('template/layout', $data);
    }

    /**
     * View failed jobs
     */
    public function failed() {
        $page = $this->input->get('page', TRUE) ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $data['title'] = display('failed_jobs');
        $data['jobs'] = $this->jobs_model->get_failed_jobs($limit, $offset);
        
        // Configure pagination
        $total = $this->jobs_model->count_failed_jobs();
        $config['base_url'] = base_url('jobs/failed');
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        
        $data['pagination'] = $this->pagination->create_links();
        $data['module'] = "jobs";
        $data['page'] = "failed_jobs";
        
        echo Modules::run('template/layout', $data);
    }

    /**
     * View job batches
     */
    public function batches() {
        $page = $this->input->get('page', TRUE) ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $data['title'] = display('job_batches');
        $data['batches'] = $this->jobs_model->get_batches($limit, $offset);
        
        // Configure pagination
        $total = $this->db->count_all('tbl_jobs_batches');
        $config['base_url'] = base_url('jobs/batches');
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        
        $data['pagination'] = $this->pagination->create_links();
        $data['module'] = "jobs";
        $data['page'] = "batches";
        
        echo Modules::run('template/layout', $data);
    }

    /**
     * Module settings
     */
    public function settings() {
        $data['title'] = display('job_settings');
        $data['configs'] = $this->jobs_model->get_configs();
        
        if ($this->input->post()) {
            $this->db->trans_start();
            
            foreach ($this->input->post() as $key => $value) {
                $this->db->where('config_key', $key)
                    ->update('tbl_jobs_config', ['config_value' => $value]);
            }
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status()) {
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect('jobs/settings');
        }
        
        $data['module'] = "jobs";
        $data['page'] = "settings";
        
        echo Modules::run('template/layout', $data);
    }

    /**
     * Retry a failed job
     */
    public function retry($id = null) {
        $json = [];
        
        if ($id) {
            if ($this->job_handler->retry_failed($id)) {
                $json['success'] = true;
                $json['message'] = display('job_queued_for_retry');
            } else {
                $json['success'] = false;
                $json['message'] = display('failed_to_retry_job');
            }
        } else {
            $json['success'] = false;
            $json['message'] = display('please_try_again');
        }
        
        echo json_encode($json);
    }

    /**
     * Clear all failed jobs
     */
    public function clear_failed() {
        $json = [];
        
        if ($this->job_handler->clear_failed()) {
            $json['success'] = true;
            $json['message'] = display('failed_jobs_cleared');
        } else {
            $json['success'] = false;
            $json['message'] = display('failed_to_clear_jobs');
        }
        
        echo json_encode($json);
    }
}