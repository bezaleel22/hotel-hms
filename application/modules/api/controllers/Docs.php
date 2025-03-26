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
     * Path to documentation guide view
     * @var string
     */
    private $guide_view = 'api/docs/guide';

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
     * Return welcome message
     */
    public function index()
    {
        $welcome = [
            'welcome' => 'Welcome to the Hotel HMS API',
            'base_url' => base_url('api/v1'),
            'docs' => [
                'GET /docs' => 'API documentation',
                'GET /docs/swagger' => 'Swagger UI documentation',
                'GET /docs/spec' => 'OpenAPI specification'
            ]
        ];

        $this->api->send_response($welcome);
    }

    /**
     * Display API documentation pages
     */
    public function api($page = 'introduction')
    {
        $valid_pages = ['introduction', 'authentication', 'rooms', 'bookings', 'content', 'guide'];

        if (!in_array($page, $valid_pages)) {
            show_404();
            return;
        }

        try {
            $content_file = APPPATH . 'modules/api/views/docs/' . $page . '.php';

            if (!file_exists($content_file)) {
                log_message('error', 'Documentation page not found: ' . $page);
                show_404('Documentation page not found');
                return;
            }

            if (!is_readable($content_file)) {
                log_message('error', 'Documentation file not readable: ' . $content_file);
                show_error('Unable to load documentation page. Please try again later.');
                return;
            }

            header('Content-Type: text/html; charset=utf-8');
            $data = [
                'title' => ucfirst($page) . ' - API Documentation',
                'page' => $page,
                'base_url' => base_url('api/v1'),
                'content_view' => 'api/docs/' . $page
            ];

            $this->load->view('api/docs/layout', $data);
        } catch (Exception $e) {
            log_message('error', 'Error loading API documentation: ' . $e->getMessage());
            show_error('An error occurred while loading the documentation.');
        }
    }

    /**
     * Display Swagger UI documentation
     */
    public function swagger()
    {
        if (!file_exists($this->openapi_file)) {
            $this->api->send_error('API documentation not generated.', 404);
            return;
        }

        header('Content-Type: text/html; charset=utf-8');
        $data['spec_url'] = base_url('api/v1/docs/spec');
        $this->load->view('api/docs/swagger', $data);
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
