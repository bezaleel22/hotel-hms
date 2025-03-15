<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Enhanced Email Handler Library
 * 
 * Handles email sending with template support, focusing on using database configuration
 * with fallback to environment variables and MailHog for development.
 */
class Email_handler
{
    /**
     * CodeIgniter instance
     * @var object
     */
    private $CI;

    /**
     * Email configuration
     * @var array
     */
    private $smtp_config;
    private $initialized = false;
    private $log_path;

    /**
     * Constructor
     */
    public function __construct()
    {
        log_message('info', 'Email Handler Class Initialized');

        // Get CI instance and load dependencies
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->library('email');
        $this->CI->load->library('parser');

        // Set log path
        $this->log_path = APPPATH . 'logs/email/';
        if (!file_exists($this->log_path)) {
            mkdir($this->log_path, 0755, true);
        }
    }

    /**
     * Initialize SMTP configuration.
     * Prioritizes database config, falls back to environment variables.
     * Uses MailHog in development when no database config exists.
     */
    private function _init_smtp()
    {
        if ($this->initialized) {
            return;
        }

        // Retrieve SMTP configuration
        $this->smtp_config = $this->_get_smtp_config();

        // Validate required configuration only in non-development environments
        if (getenv('ENVIRONMENT') !== 'development') {
            if (empty($this->smtp_config['smtp_host'])) {
                throw new Exception('SMTP host not configured');
            }
            if (empty($this->smtp_config['smtp_port'])) {
                throw new Exception('SMTP port not configured');
            }
            if (
                $this->smtp_config['protocol'] === 'smtp' &&
                (empty($this->smtp_config['smtp_user']) || empty($this->smtp_config['smtp_pass']))
            ) {
                throw new Exception('SMTP credentials required in production for SMTP protocol');
            }
        }

        try {
            $this->CI->email->initialize($this->smtp_config);
            $this->initialized = true;
        } catch (Exception $e) {
            $this->log_error("Failed to initialize SMTP: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate SMTP configuration based on environment and available data.
     */
    private function _get_smtp_config()
    {
        $default_config = [
            'protocol' => 'smtp',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        // Check if we're in development mode
        if (getenv('ENVIRONMENT') === 'development') {
            // Use MailHog for development
            return array_merge($default_config, [
                'smtp_host' => 'mailhog',
                'smtp_port' => 1025,
            ]);
        }

        // Try to load configuration from the database for production
        if ($db_config = $this->CI->db->get_where('email_config', ['email_config_id' => 1])->row()) {
            return array_merge($default_config, [
                'smtp_host' => $db_config->smtp_host,
                'smtp_port' => $db_config->smtp_port,
                'smtp_user' => $db_config->sender,
                'smtp_pass' => $db_config->smtp_password,
                'smtp_crypto' => $db_config->smtp_secure ?: 'tls',
            ]);
        }

        // Fallback to environment variables for production
        return array_merge($default_config, [
            'smtp_host' => getenv('SMTP_HOST'),
            'smtp_port' => getenv('SMTP_PORT'),
            'smtp_user' => getenv('SMTP_USER'),
            'smtp_pass' => getenv('SMTP_PASS'),
            'smtp_crypto' => getenv('SMTP_SECURE') ?: 'tls',
        ]);
    }

    /**
     * Send password reset email
     */
    public function send_password_reset($customer, $reset_link)
    {
        // Prepare template data with security info
        $template_data = [
            'firstname' => $customer['firstname'],
            'reset_link' => $reset_link,
            'ip_address' => $this->CI->input->ip_address(),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        return $this->send(
            $customer['email'],
            'Password Reset Request',
            'password_reset',
            $template_data,
            'password_reset'
        );
    }

    /**
     * Send contact form notification
     */
    public function send_contact_notification($data)
    {
        // Get settings for contact email
        $this->CI->load->model('api/setting_model');
        $contact_email = $this->CI->setting_model->get_setting('email');
        error_log('Contact email: ' . $contact_email);
        
        return $this->send(
            $contact_email,  // TO the configured email
            'New Contact Form Submission',
            'contact_form',
            $data,
            'contact_form'
        );
    }

    /**
     * Send password changed notification
     */
    public function send_subscription_confirmation($data)
    {
        // Get settings for support email
        $this->CI->load->model('api/setting_model');
        $support_email = $this->CI->setting_model->get_setting('email');

        // Prepare template data with security info
        $template_data = [
            'firstname' => $data['firstname'],
            'ip_address' => $this->CI->input->ip_address(),
            'timestamp' => date('Y-m-d H:i:s'),
            'support_email' => $support_email
        ];

        return $this->send(
            $data['email'],
            'Newsletter Subscription Confirmation',
            'newsletter_subscription',
            $template_data,
            'newsletter_subscription'
        );
    }

    /**
     * Send password changed notification
     */
    public function send_password_changed($customer)
    {
        // Get settings for support email
        $this->CI->load->model('api/setting_model');
        $support_email = $this->CI->setting_model->get_setting('email');

        // Prepare template data with security info
        $template_data = [
            'firstname' => $customer['firstname'],
            'ip_address' => $this->CI->input->ip_address(),
            'timestamp' => date('Y-m-d H:i:s'),
            'support_email' => $support_email
        ];

        return $this->send(
            $customer['email'],
            'Password Changed Successfully',
            'password_changed',
            $template_data,
            'password_changed'
        );
    }

    /**
     * Send email with template support
     */
    public function send($to, $subject, $template, $data = [], $check_permission = null)
    {
        try {
            // Initialize SMTP if needed
            $this->_init_smtp();

            // Validate email
            if (!$this->validate_email($to)) {
                $this->log_error("Invalid recipient email: {$to}");
                return false;
            }

            // Check permission if specified
            if ($check_permission) {
                $permission = $this->CI->db->where('permission', $check_permission)
                    ->get('tbl_email_permission')
                    ->row();

                if ($permission && $permission->status == 0) {
                    $this->log_error("Email sending disabled for: {$check_permission}");
                    return false;
                }
            }

            // Process email
            $subject = $this->sanitize_text($subject);
            $data = $this->sanitize_data($data);
            $body = $this->load_template($template, $data);

            if (!$body) {
                $this->log_error("Failed to load template: {$template}");
                return false;
            }

            // Configure email
            $this->CI->email->clear();

            // Get sender from database config
            $db_config = $this->CI->db->get_where('email_config', ['email_config_id' => 1])->row();
            $from_email = $db_config ? $db_config->sender : getenv('SMTP_FROM');
            $from_name = $db_config ? ($db_config->title ?: 'Hotel HMS') : (getenv('SMTP_NAME') ?: 'Hotel HMS');

            // For contact form submissions, use the sender's email
            if ($check_permission === 'contact_form') {
                $this->CI->email->from($data['email'], $data['name']);
                $this->CI->email->to($from_email);
            } else {
                $this->CI->email->from($from_email, $from_name);
                $this->CI->email->to($to);
            }

            $this->CI->email->subject($subject);
            $this->CI->email->message($body);

            // Send with retries
            $max_retries = 3;
            $retry_delay = 5;
            $success = false;
            $attempt = 1;

            while ($attempt <= $max_retries && !$success) {
                try {
                    $success = $this->CI->email->send();

                    if ($success) {
                        $this->log_success($to, $subject, $template);
                        return true;
                    }

                    $error = $this->CI->email->print_debugger(['headers', 'subject']);
                    $this->log_error("Send attempt {$attempt} failed: {$error}");
                } catch (Exception $e) {
                    $this->log_error("Error on attempt {$attempt}: " . $e->getMessage());
                }

                if ($attempt < $max_retries) {
                    sleep($retry_delay);
                }
                $attempt++;
            }

            return false;
        } catch (Exception $e) {
            $this->log_error("Unexpected error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Load and render email template
     */
    private function load_template($template, $data)
    {
        $template_file = APPPATH . 'modules/api/views/templates/' . $template . '.php';

        if (!file_exists($template_file)) {
            return false;
        }

        return $this->CI->parser->parse('api/templates/' . $template, $data, true);
    }

    /**
     * Validate email address
     */
    private function validate_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Sanitize text input
     */
    private function sanitize_text($text)
    {
        return htmlspecialchars(strip_tags(trim($text)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize data array recursively
     */
    private function sanitize_data($data)
    {
        if (!is_array($data)) {
            return $this->sanitize_text($data);
        }
        return array_map([$this, 'sanitize_data'], $data);
    }

    /**
     * Log successful email send
     */
    private function log_success($to, $subject, $template)
    {
        $log = sprintf(
            "[%s] SUCCESS | To: %s | Subject: %s | Template: %s\n",
            date('Y-m-d H:i:s'),
            $to,
            $subject,
            $template
        );

        file_put_contents(
            $this->log_path . 'email.log',
            $log,
            FILE_APPEND
        );
    }

    /**
     * Log error
     */
    private function log_error($message)
    {
        $log = sprintf(
            "[%s] ERROR | %s\n",
            date('Y-m-d H:i:s'),
            $message
        );

        file_put_contents(
            $this->log_path . 'email_error.log',
            $log,
            FILE_APPEND
        );
    }
}
