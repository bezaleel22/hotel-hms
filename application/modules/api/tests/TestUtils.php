<?php

class TestUtils
{
    private $logFile;
    private $baseUrl;
    private $tokenFile;
    private static $passedTests = 0;
    private static $failedTests = 0;
    private $projectRoot;
    public $loggingEnabled = true;

    public function __construct($logFile = null)
    {
        $this->projectRoot = getenv('PHP_INCLUDE_PATH') ?: dirname(dirname(dirname(dirname(dirname(__FILE__)))));
        $this->logFile = $logFile ?? $this->projectRoot . '/application/modules/api/tests/logs/api_tests.log';
        $this->tokenFile = $this->projectRoot . '/application/modules/api/tests/logs/auth_token.txt';
        $this->baseUrl = 'http://localhost'; // Simple base URL, endpoints already include /api/v1

        // Create logs directory if it doesn't exist
        $logsDir = dirname($this->logFile);
        if (!is_dir($logsDir)) {
            mkdir($logsDir, 0777, true);
        }
    }

    public function loadTestData($filename)
    {
        $path = $this->projectRoot . '/application/modules/api/assets/test-data/' . $filename;
        if (!file_exists($path)) {
            throw new Exception("Test data file not found: {$filename}");
        }
        return json_decode(file_get_contents($path), true);
    }

    public function makeRequest($method, $endpoint, $data = null, $headers = [])
    {
        $startTime = microtime(true);
        $url = $this->baseUrl . $endpoint;
        $curl = curl_init();

        $defaultHeaders = [
            'Accept: application/json',
            'Content-Type: application/json'
        ];
        $headers = array_merge($defaultHeaders, $headers);

        $curlOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_FOLLOWLOCATION => true
        ];

        if ($data && in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $curlOptions[CURLOPT_POSTFIELDS] = is_array($data) ? json_encode($data) : $data;
        }

        curl_setopt_array($curl, $curlOptions);

        // Build curl command for logging
        $curlCommand = $this->buildCurlCommand($method, $url, $headers, $data);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        curl_close($curl);

        $result = [
            'status_code' => $httpCode,
            'response' => $response ? json_decode($response, true) : null,
            'error' => $error,
            'duration' => $duration,
            'url' => $url
        ];

        if ($this->loggingEnabled) {
            $this->logRequest($method, $endpoint, $curlCommand, $result);
        }

        return $result;
    }

    private function buildCurlCommand($method, $url, $headers, $data)
    {
        $command = "curl -X {$method} '{$url}'";

        foreach ($headers as $header) {
            $command .= " -H '{$header}'";
        }

        if ($data) {
            $jsonData = is_array($data) ? json_encode($data) : $data;
            $command .= " -d '{$jsonData}'";
        }

        return $command;
    }

    public function logRequest($method, $endpoint, $curlCommand, $result)
    {
        $timestamp = date('Y-m-d H:i:s');
        $status = ($result['status_code'] >= 200 && $result['status_code'] < 300) ? 'SUCCESS' : 'FAILED';

        $logEntry = "\n-------------------------------------------\n";
        $logEntry .= "[DEBUG]: {$curlCommand}\n\n";
        $logEntry .= "[{$timestamp}] {$method} {$endpoint}\n";
        $logEntry .= "Full URL: {$result['url']}\n";
        $logEntry .= "Duration: {$result['duration']}ms\n";
        $logEntry .= "Status: {$status}\n";
        $logEntry .= "HTTP Status Code: {$result['status_code']}\n";

        if ($result['error']) {
            $logEntry .= "Error: {$result['error']}\n";
        }

        $logEntry .= "Response: " . json_encode($result['response']) . "\n";

        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

    public function deleteLogs()
    {
        if (file_exists($this->logFile)) {
            unlink($this->logFile);
        }
    }

    public function assertResponse($testName, $result, $expectedStatus)
    {
        $actualStatus = $result['status_code'];
        $success = $actualStatus === $expectedStatus;

        if ($success) {
            self::$passedTests++;
        } else {
            self::$failedTests++;
        }

        echo sprintf(
            "%s: %s (Expected: %d, Got: %d)\n",
            $testName,
            $success ? "\033[0;32mPASSED\033[0m" : "\033[0;31mFAILED\033[0m",
            $expectedStatus,
            $actualStatus
        );

        if (!$success) {
            echo "URL: {$result['url']}\n";
            if ($result['error']) {
                echo "Error: {$result['error']}\n";
            }
            if ($result['response']) {
                echo "Response: " . json_encode($result['response']) . "\n";
            }
        }

        return $success;
    }

    public static function getTestCounts()
    {
        return [
            'passed' => self::$passedTests,
            'failed' => self::$failedTests,
            'total' => self::$passedTests + self::$failedTests
        ];
    }

    public static function resetTestCounts()
    {
        self::$passedTests = 0;
        self::$failedTests = 0;
    }

    public function getProjectRoot()
    {
        return $this->projectRoot;
    }

    public function setAuthToken($token)
    {
        file_put_contents($this->tokenFile, $token);
    }

    public function getAuthToken()
    {
        return file_exists($this->tokenFile) ? trim(file_get_contents($this->tokenFile)) : null;
    }

    public function getLatestEmailFromMailhog($recipientEmail)
    {
        $mailhogUrl = 'http://localhost:8025/api/v2/search';
        $params = http_build_query(['kind' => 'containing', 'query' => $recipientEmail]);
        
        $curl = curl_init($mailhogUrl . '?' . $params);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false
        ]);

        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($statusCode !== 200 || !$response) {
            throw new Exception("Failed to fetch email from Mailhog: Status $statusCode");
        }

        $data = json_decode($response, true);
        if (empty($data['items'])) {
            throw new Exception("No emails found for $recipientEmail");
        }

        // Get the most recent email
        $latestEmail = $data['items'][0];
        
        // Find the HTML part with quoted-printable encoding
        $htmlPart = null;
        if (isset($latestEmail['Content']['MIME']['Parts'])) {
            foreach ($latestEmail['Content']['MIME']['Parts'] as $part) {
                if (isset($part['Headers']['Content-Type']) &&
                    strpos($part['Headers']['Content-Type'][0], 'text/html') !== false) {
                    $htmlPart = $part;
                    break;
                }
            }
        }

        // Get and decode the HTML content
        $html = $htmlPart ? $htmlPart['Body'] : $latestEmail['Content']['Body'];
        $html = quoted_printable_decode($html);
        
        return [
            'subject' => $latestEmail['Content']['Headers']['Subject'][0] ?? '',
            'body' => $latestEmail['Content']['Body'],
            'html' => $html
        ];
    }

    public function extractResetTokenFromEmail($emailContent)
    {
        if (preg_match('/localhost\/reset-password\/([\w\-_\.]+(?:=)?(?:[\w\-_\.]+)?)/i', $emailContent, $matches)) {
            $token = $matches[1];
            return $token;
        }
        throw new Exception("Reset token not found in email content");
    }
}
