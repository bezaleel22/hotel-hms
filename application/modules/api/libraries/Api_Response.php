<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_Response
{
    /**
     * Format API response with consistent structure
     * 
     * @param mixed $data Response data
     * @param string $message Response message
     * @param int $status_code HTTP status code
     * @param bool $success Success status
     * @return array Formatted response array
     */
    public static function format($data = null, $error = null, $message = '', $status_code = 200, $success = true)
    {
        $response = [
            'status' => $success,
            'code' => $status_code,
            'message' => $message,
            'data' => $data,
            'error' => $error,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        return $response;
    }

    /**
     * Format data response
     * 
     * @param string $message Error message
     * @param int $status_code HTTP status code
     * @param mixed $data Additional error data
     * @return array Formatted error response
     */
    public static function error($message, $status_code = 400, $error = null)
    {
        $response = self::format(null, $error, $message, $status_code, false);
        unset($response['data']);
        return $response;
    }

    /**
     * Format success response
     * 
     * @param string $message Error message
     * @param int $status_code HTTP status code
     * @param mixed $data Additional error data
     * @return array Formatted error response
     */
    public static function success($data, $message = null, $status_code = 400)
    {
        $response =  self::format($data, null, $message, $status_code, true);
        unset($response['error']);
        return $response;
    }
}
