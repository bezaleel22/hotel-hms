<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/content_model');
        $this->load->library('api/api_handler');
    }



    /**
     * Get home page content
     */
    public function home()
    {
        try {
            $data = $this->content_model->get_home_content();
            $this->api_handler->send_response(
                $data,
                'Home content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting home content: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to retrieve home content', 500);
        }
    }

    /**
     * Get about page content
     */
    public function about()
    {
        try {
            $data = $this->content_model->get_about_content();
            $this->api_handler->send_response(
                $data,
                'About page content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting about content: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to retrieve about content', 500);
        }
    }

    /**
     * Get gallery content
     */
    public function gallery()
    {
        try {
            $data = $this->content_model->get_gallery_content();
            $this->api_handler->send_response(
                $data,
                'Gallery content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting gallery content: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to retrieve gallery content', 500);
        }
    }

    /**
     * Get page content by ID
     */
    public function page($id)
    {
        try {
            $data = $this->content_model->get_page_content($id);

            if (!$data) {
                $this->api_handler->send_error('Page not found', 404);
                return;
            }

            $this->api_handler->send_response(
                $data,
                'Page content retrieved successfully'
            );
        } catch (Exception $e) {
            error_log('Error getting page content: ' . $e->getMessage());
            $this->api_handler->send_error('Failed to retrieve page content', 500);
        }
    }
}
