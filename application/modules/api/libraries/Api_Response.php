<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Response {
    /**
     * Format API response with consistent structure
     * 
     * @param mixed $data Response data
     * @param string $message Response message
     * @param int $status_code HTTP status code
     * @param bool $success Success status
     * @return array Formatted response array
     */
    public static function format($data = null, $message = '', $status_code = 200, $success = true) {
        $response = [
            'status' => $success,
            'message' => $message,
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s'),
            'code' => $status_code
        ];
        return $response;
    }

    /**
     * Format error response
     * 
     * @param string $message Error message
     * @param int $status_code HTTP status code
     * @param mixed $data Additional error data
     * @return array Formatted error response
     */
    public static function error($message, $status_code = 400, $data = null) {
        return self::format($data, $message, $status_code, false);
    }
}