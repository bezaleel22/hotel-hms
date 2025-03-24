<?php
require_once dirname(__FILE__) . '/TestUtils.php';

class ContentTest
{
    private $utils;
    private $testData;

    public function __construct()
    {
        $this->utils = new TestUtils();
        $this->testData = $this->utils->loadTestData('content_test_data.json');
    }

    public function runTests($delete_log = false)
    {
        echo "\nRunning Content Tests...\n";
        if ($delete_log) {
            $this->utils->deleteLogs();
        }

        $this->testHomeContent();
        $this->testAboutContent();
        $this->testGalleryContent();
        $this->testPageContent();
        $this->testPrivacyContent();
        $this->testTermsContent();
        $this->testContact();
        $this->testSubscribe();
    }

    private function testHomeContent()
    {
        echo "\nTesting Home Content Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/content/home'
        );

        $this->utils->assertResponse("Home Content", $result, 200);

        // Verify all expected fields exist in the response
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            foreach ($this->testData['home']['expected_fields'] as $field) {
                if (!array_key_exists($field, $result['response']['data'])) {
                    echo "\033[0;31mFAILED: Missing field '{$field}' in home content\033[0m\n";
                }
            }

            // Additional checks for arrays
            if (isset($result['response']['data']['slider_info']) && !is_array($result['response']['data']['slider_info'])) {
                echo "\033[0;31mFAILED: 'slider_info' should be an array\033[0m\n";
            }
            if (isset($result['response']['data']['room_offers']) && !is_array($result['response']['data']['room_offers'])) {
                echo "\033[0;31mFAILED: 'room_offers' should be an array\033[0m\n";
            }
        }
    }

    private function testAboutContent()
    {
        echo "\nTesting About Content Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/content/about'
        );

        $this->utils->assertResponse("About Content", $result, 200);

        // Verify all expected fields exist in the response
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            foreach ($this->testData['about']['expected_fields'] as $field) {
                if (!array_key_exists($field, $result['response']['data'])) {
                    echo "\033[0;31mFAILED: Missing field '{$field}' in about content\033[0m\n";
                }
            }

            // Additional checks for arrays
            if (isset($result['response']['data']['team_info']) && !is_array($result['response']['data']['team_info'])) {
                echo "\033[0;31mFAILED: 'team_info' should be an array\033[0m\n";
            }
            if (isset($result['response']['data']['company']) && !is_array($result['response']['data']['company'])) {
                echo "\033[0;31mFAILED: 'company' should be an array\033[0m\n";
            }
        }
    }

    private function testGalleryContent()
    {
        echo "\nTesting Gallery Content Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/content/gallery'
        );

        $this->utils->assertResponse("Gallery Content", $result, 200);

        // Verify all expected fields exist in the response
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            foreach ($this->testData['gallery']['expected_fields'] as $field) {
                if (!array_key_exists($field, $result['response']['data'])) {
                    echo "\033[0;31mFAILED: Missing field '{$field}' in gallery content\033[0m\n";
                }
            }

            // Additional checks for arrays
            if (isset($result['response']['data']['gallery_types']) && !is_array($result['response']['data']['gallery_types'])) {
                echo "\033[0;31mFAILED: 'gallery_types' should be an array\033[0m\n";
            }
            if (isset($result['response']['data']['galleries']) && !is_array($result['response']['data']['galleries'])) {
                echo "\033[0;31mFAILED: 'galleries' should be an array\033[0m\n";
            }
        }
    }

    private function testPageContent()
    {
        echo "\nTesting Page Content Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/content/pages/' . $this->testData['page']['id']
        );

        $this->utils->assertResponse("Page Content", $result, 200);

        // Verify all expected fields exist in the response
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            foreach ($this->testData['page']['expected_fields'] as $field) {
                if (!array_key_exists($field, $result['response']['data'])) {
                    echo "\033[0;31mFAILED: Missing field '{$field}' in page content\033[0m\n";
                }
            }
        }
    }

    private function testPrivacyContent()
    {
        echo "\nTesting Privacy Content Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/content/privacy'
        );

        $this->utils->assertResponse("Privacy Content", $result, 200);

        // Verify all expected fields exist in the response
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            foreach ($this->testData['privacy']['expected_fields'] as $field) {
                if (!array_key_exists($field, $result['response']['data'])) {
                    echo "\033[0;31mFAILED: Missing field '{$field}' in privacy content\033[0m\n";
                }
            }
        }
    }

    private function testTermsContent()
    {
        echo "\nTesting Terms Content Endpoint:\n";

        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/content/terms'
        );

        $this->utils->assertResponse("Terms Content", $result, 200);

        // Verify all expected fields exist in the response
        if ($result['status_code'] === 200 && isset($result['response']['data'])) {
            foreach ($this->testData['terms']['expected_fields'] as $field) {
                if (!array_key_exists($field, $result['response']['data'])) {
                    echo "\033[0;31mFAILED: Missing field '{$field}' in terms content\033[0m\n";
                }
            }
        }
    }
    private function testContact()
    {
        echo "\nTesting Contact Submit Endpoint:\n";

        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/content/contact',
            $this->testData['contact'],
            ['Content-Type: application/json']
        );

        $this->utils->assertResponse("Contact Form Submit", $result, 200);

        // Verify email was sent
        try {
            $email = $this->utils->getLatestEmailFromMailhog($this->testData['contact']['email']);
            echo "Email sent successfully to: " . $this->testData['contact']['email'] . "\n";
        } catch (Exception $e) {
            echo "\033[0;31mFAILED: " . $e->getMessage() . "\033[0m\n";
        }
    }

    private function testSubscribe()
    {
        echo "\nTesting Newsletter Subscribe Endpoint:\n";

        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/content/subscribe',
            $this->testData['subscribe'],
            ['Content-Type: application/json']
        );

        $this->utils->assertResponse("Newsletter Subscribe", $result, 200);

        // Verify verification email was sent
        try {
            $email = $this->utils->getLatestEmailFromMailhog($this->testData['subscribe']['email']);
            echo "Verification email sent successfully to: " . $this->testData['subscribe']['email'] . "\n";
        } catch (Exception $e) {
            echo "\033[0;31mFAILED: " . $e->getMessage() . "\033[0m\n";
        }
    }
}

// Run tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $contentTest = new ContentTest();
    $contentTest->runTests();
}
