<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Log extends CI_Log
{
    protected $_custom_log_path;

    public function __construct()
    {
        parent::__construct();
        $this->_custom_log_path = APPPATH . 'logs/custom/log-' . date('Y-m-d') . '.php';

        // Ensure custom log directory exists
        if (!is_dir(dirname($this->_custom_log_path))) {
            mkdir(dirname($this->_custom_log_path), 0755, TRUE);
        }

        // Create custom log file with PHP header if it doesn't exist
        if (!file_exists($this->_custom_log_path)) {
            file_put_contents($this->_custom_log_path, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n");
        }
    }

    public function write_log($level, $msg)
    {
        if (strpos($msg, 'DEBUG_LOG: ') === 0) {
            // Write to custom log file
            $level = strtoupper($level);
            $date = new DateTime();
            $time = $date->format('Y-m-d H:i:s.u');

            // Remove the DEBUG_LOG: prefix
            $clean_msg = str_replace('DEBUG_LOG: ', '', $msg);
            $message = $time . ' --> ' . $level . ' - ' . $clean_msg . "\n";

            // Append to custom log file
            if ($fp = @fopen($this->_custom_log_path, 'ab')) {
                flock($fp, LOCK_EX);
                fwrite($fp, $message);
                flock($fp, LOCK_UN);
                fclose($fp);
            }

            // Don't write DEBUG_LOG messages to main log
            return TRUE;
        }

        // For non-DEBUG_LOG messages, use parent logger
        return parent::write_log($level, $msg);
    }
}
