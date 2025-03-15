<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documentation extends MX_Controller
{
    private $spec = null;

    public function __construct()
    {
        parent::__construct();
        $this->load_spec();
    }

    /**
     * Load OpenAPI specification from JSON file
     */
    private function load_spec()
    {
        $spec_file = APPPATH . 'modules/api/assets/openapi.json';
        if (file_exists($spec_file)) {
            $this->spec = json_decode(file_get_contents($spec_file), true);
        }
    }

    /**
     * Return OpenAPI specification
     */
    public function index()
    {
        if (!$this->spec) {
            show_404();
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->spec, JSON_PRETTY_PRINT);
    }

    /**
     * Show Swagger UI
     */
    public function ui()
    {
        $data['spec_url'] = base_url('api/v1/docs');
        $this->load->view('api/documentation/swagger', $data);
    }
}
