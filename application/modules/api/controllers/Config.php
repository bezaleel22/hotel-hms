<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/setting_model');
        $this->load->library('api/api_handler');
    }



    /**
     * Get website settings
     * GET api/v1/config/settings
     */
    public function settings()
    {
        try {
            $settings = $this->setting_model->get_settings();

            // Remove sensitive information
            unset($settings['smtp_pass']);
            unset($settings['api_key']);
            unset($settings['jwt_key']);
            unset($settings['oauth_keys']);

            // Filter public settings
            $public_settings = array(
                'title' => $settings['title'],
                'address' => $settings['address'],
                'email' => $settings['email'],
                'phone' => $settings['phone'],
                'favicon' => $settings['favicon'],
                'logo' => $settings['logo'],
                'footer_text' => $settings['footer_text'],
                'timezone' => $settings['timezone'],
                'site_align' => $settings['site_align'],
                'date_format' => $settings['date_format']
            );

            $this->api_handler->send_response(
                $public_settings,
                'Settings retrieved successfully',
                200
            );
        } catch (Exception $e) {
            $this->api_handler->send_error($e->getMessage());
        }
    }

    /**
     * Get available languages
     * GET api/v1/config/languages
     */
    public function languages()
    {
        try {
            $languages = $this->setting_model->get_languages();
            
            $this->api_handler->send_response(
                $languages,
                'Languages retrieved successfully',
                200
            );
        } catch (Exception $e) {
            $this->api_handler->send_error($e->getMessage());
        }
    }

    /**
     * Get currency settings
     * GET api/v1/config/currency
     */
    public function currency()
    {
        try {
            $currency = $this->setting_model->get_currency();
            
            $this->api_handler->send_response(
                $currency,
                'Currency settings retrieved successfully',
                200
            );
        } catch (Exception $e) {
            $this->api_handler->send_error($e->getMessage());
        }
    }
}
