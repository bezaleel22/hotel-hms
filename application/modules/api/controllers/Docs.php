<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Docs extends MX_Controller
{
    /**
     * Path to OpenAPI JSON file
     * @var string
     */
    private $openapi_file = APPPATH . 'modules/api/docs/openapi.json';
    
    /**
     * Api handler instance
     * @var Api_handler
     */
    protected $api;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['api/api_handler']);
        $this->api = $this->api_handler;
    }

    /**
     * Serve Swagger UI interface
     */
    public function index()
    {
        if (!file_exists($this->openapi_file)) {
            $this->api->send_error('API documentation not generated.', 404);
            return;
        }

        header('Content-Type: text/html; charset=utf-8');
        $data['spec_url'] = base_url('api/v1/spec');
        $this->load->view('api/swagger', $data);
    }

    /**
     * Return raw OpenAPI JSON specification
     */
    public function spec()
    {
        if (!file_exists($this->openapi_file)) {
            $this->api->send_error('API documentation not generated.', 404);
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(file_get_contents($this->openapi_file));
    }



}
