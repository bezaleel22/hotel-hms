<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'modules/jobs/libraries/Base_job.php';

/**
 * Email Job Class
 *
 * Handles sending emails asynchronously through the job queue.
 * This job type processes email sending in the background to improve
 * application performance and handle retries on failure.
 */
class Email_job extends Base_job {
    /**
     * Queue name for email jobs
     * @var string
     */
    protected $queue = 'emails';

    /**
     * Maximum retry attempts for failed emails
     * @var int
     */
    protected $maxAttempts = 3;

    /**
     * Delay between retry attempts (5 minutes)
     * @var int
     */
    protected $backoff = 300;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        
        // Initialize email handler
        if (!isset($this->CI->email_handler)) {
            $this->CI->load->library('api/email_handler');
        }
    }

    /**
     * Handle the job execution
     * 
     * @param array $data Job data containing:
     *      - to: Recipient email
     *      - subject: Email subject
     *      - template: Email template name
     *      - data: Template data
     *      - attachments: Array of attachments
     * @throws Exception When email sending fails
     * @return void
     */
    public function handle($data) {
        // Validate required fields
        if (!isset($data['to']) || !isset($data['subject']) || !isset($data['template'])) {
            throw new Exception('Missing required email data');
        }

        try {
            // Send the email
            $sent = $this->CI->email_handler->send(
                $data['to'],
                $data['subject'],
                $data['template'],
                $data['data'] ?? [],
                null,
                $data['attachments'] ?? []
            );

            if (!$sent) {
                throw new Exception('Failed to send email');
            }
        } catch (Exception $e) {
            log_message('error', sprintf(
                'Email sending failed to: %s, subject: %s - %s',
                $data['to'],
                $data['subject'],
                $e->getMessage()
            ));
            throw $e;
        }
    }

    /**
     * Handle job failure
     */
    public function failed($exception) {
        parent::failed($exception);
        
        // Log to email error log
        log_message('error', sprintf(
            'Email job failed to: %s, template: %s - %s',
            $this->data['to'] ?? 'unknown',
            $this->data['template'] ?? 'unknown',
            $exception->getMessage()
        ));
    }

    /**
     * Static method to dispatch an email job
     * 
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $template Email template name
     * @param array $data Template data
     * @param array $attachments Email attachments
     * @return mixed Job ID if successful, false on failure
     */
    public static function dispatch($to, $subject, $template, $data = [], $attachments = []) {
        try {
            // Get instance with initialized CI
            $instance = self::getInstance();

            // Verify job handler is loaded
            if (!isset($instance->CI->job_handler)) {
                $instance->CI->load->library('jobs/job_handler');
            }

            // Prepare and dispatch the job
            return $instance->CI->job_handler->dispatch([
                'handler' => 'Email_job',
                'method' => 'handle',
                'data' => [
                    'to' => $to,
                    'subject' => $subject,
                    'template' => $template,
                    'data' => $data,
                    'attachments' => $attachments
                ]
            ], 'emails');

        } catch (Exception $e) {
            log_message('error', sprintf(
                'Failed to dispatch email job to: %s - %s',
                $to,
                $e->getMessage()
            ));
            return false;
        }
    }
}