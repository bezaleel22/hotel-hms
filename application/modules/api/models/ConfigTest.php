<?php
require_once dirname(__FILE__) . '/TestUtils.php';

class ConfigTest
{
    private $utils;
    private $testData;

    public function __construct()
    {
        $this->utils = new TestUtils();
        $this->testData = $this->utils->loadTestData('config_test_data.json');
    }

    public function runTests($delete_log = false)
    {
        echo "\nRunning Configuration Tests...\n";
        if ($delete_log) {
            $this->utils->deleteLogs();
        }

        $this->testSettings();
        $this->testLanguages();
        $this->testCurrency();
    }

    private function testSettings()
    {
        echo "\nTesting Settings Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/config/settings'
        );
        
        $this->utils->assertResponse("Settings Configuration", $result, 200);

        // Verify all expected keys exist in the settings
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            foreach ($this->testData['settings']['expected_keys'] as $key) {
                if (!isset($result['response']['data'][$key])) {
                    echo "\033[0;31mFAILED: Missing setting key '{$key}'\033[0m\n";
                }
            }
        }
    }

    private function testLanguages()
    {
        echo "\nTesting Languages Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/config/languages'
        );
        
        $this->utils->assertResponse("Languages Configuration", $result, 200);

        // Verify response structure and fields
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            if (!is_array($result['response']['data'])) {
                echo "\033[0;31mFAILED: Languages data should be an array\033[0m\n";
                return;
            }

            if (empty($result['response']['data'])) {
                echo "\033[0;31mFAILED: No languages returned\033[0m\n";
                return;
            }

            // Check fields in first language entry
            $firstLanguage = $result['response']['data'][0];
            foreach ($this->testData['languages']['expected_fields'] as $field) {
                if (!isset($firstLanguage[$field])) {
                    echo "\033[0;31mFAILED: Missing language field '{$field}'\033[0m\n";
                }
            }

            // Verify at least one default language exists
            $hasDefault = false;
            foreach ($result['response']['data'] as $language) {
                if (isset($language['is_default']) && $language['is_default']) {
                    $hasDefault = true;
                    break;
                }
            }
            if (!$hasDefault) {
                echo "\033[0;31mFAILED: No default language set\033[0m\n";
            }
        }
    }

    private function testCurrency()
    {
        echo "\nTesting Currency Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/config/currency'
        );
        
        $this->utils->assertResponse("Currency Configuration", $result, 200);

        // Verify response structure and fields
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            if (!is_array($result['response']['data'])) {
                echo "\033[0;31mFAILED: Currency data should be an array\033[0m\n";
                return;
            }

            if (empty($result['response']['data'])) {
                echo "\033[0;31mFAILED: No currencies returned\033[0m\n";
                return;
            }

            // Check fields in first currency entry
            $firstCurrency = $result['response']['data'][0];
            foreach ($this->testData['currency']['expected_fields'] as $field) {
                if (!isset($firstCurrency[$field])) {
                    echo "\033[0;31mFAILED: Missing currency field '{$field}'\033[0m\n";
                }
            }

            // Verify at least one default currency exists
            $hasDefault = false;
            foreach ($result['response']['data'] as $currency) {
                if (isset($currency['is_default']) && $currency['is_default']) {
                    $hasDefault = true;
                    break;
                }
            }
            if (!$hasDefault) {
                echo "\033[0;31mFAILED: No default currency set\033[0m\n";
            }
        }
    }
}

// Run tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $configTest = new ConfigTest();
    $configTest->runTests(true);
}