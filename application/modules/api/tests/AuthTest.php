<?php

require_once dirname(__FILE__) . '/TestUtils.php';

class AuthTest
{
    private $utils;
    private $testData;
    private $authToken;
    private $resetToken;
    private $newPassword = 'newTestPassword123!';

    public function __construct()
    {
        $this->utils = new TestUtils();
        $this->testData = $this->utils->loadTestData('auth_test_data.json');
        $this->authToken = $this->utils->getAuthToken();
    }

    public function runTests($delete_log = false)
    {
        echo "\nRunning Authentication Tests...\n";
        if ($delete_log) {
            $this->utils->deleteLogs();
        }

        $this->testSignup();
        $this->testLogin();
        $this->testChangePassword();
        $this->testLogout();
        $this->testForgotPassword();
        $this->testVerifyResetToken();
        $this->testResetPassword();
        // Test login with new password
        $this->utils->loggingEnabled = false;
        $this->testData['login']['password'] = $this->newPassword;
        $this->testLogin();
        $this->utils->loggingEnabled = true;
    }

    private function testSignup()
    {
        echo "\nTesting Signup Endpoints:\n";

        // Test signup
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/auth/signup',
            $this->testData['signup']
        );
        $this->utils->assertResponse("Signup", $result, 201);
        if ($result['status_code'] === 201 && isset($result['response']['data']['access_token'])) {
            $this->authToken = $result['response']['data']['access_token'];
            $this->utils->setAuthToken($this->authToken);
        }
    }

    private function testLogin()
    {
        echo "\nTesting Login Endpoints:\n";

        // Test login
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/auth/login',
            $this->testData['login']
        );
        $this->utils->assertResponse("Login", $result, 200);
        if ($result['status_code'] === 200 && isset($result['response']['data']['access_token'])) {
            $this->authToken = $result['response']['data']['access_token'];
            $this->utils->setAuthToken($this->authToken);
        }
    }

    private function testChangePassword()
    {
        echo "\nTesting Change Password Endpoints:\n";
        // Test change password
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/auth/change-password',
            $this->testData['change_password'],
            ['Authorization: Bearer ' . $this->authToken]
        );
        $this->utils->assertResponse("Change Password", $result, 200);
    }

    private function testLogout()
    {
        echo "\nTesting Logout Endpoints:\n";

        // Test logout
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/auth/logout',
            null,
            ['Authorization: Bearer ' . $this->authToken]
        );
        $this->utils->assertResponse("Logout", $result, 200);
    }

    private function testForgotPassword()
    {
        echo "\nTesting Forgot Password Endpoints:\n";

        $testEmail = $this->testData['forgot_password']['email'];

        // Test email
        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/auth/forgot-password',
            $this->testData['forgot_password']
        );
        $this->utils->assertResponse("Forgot Password", $result, 200);

        // Get reset token from email
        try {
            sleep(5); // Wait for email to arrive and be processed
            $email = $this->utils->getLatestEmailFromMailhog($testEmail);
            $this->resetToken = $this->utils->extractResetTokenFromEmail($email['html']);
            echo "Retrieved reset token from email\n";
        } catch (Exception $e) {
            echo "Failed to get reset token: " . $e->getMessage() . "\n";
            return;
        }
    }

    private function testVerifyResetToken()
    {
        echo "\nTesting Reset Token Verification Endpoints:\n";

        if (!$this->resetToken) {
            echo "Skipping token verification - no reset token available\n";
            return;
        }

        // Test reset token
        $result = $this->utils->makeRequest(
            'GET',
            '/api/v1/auth/verify-reset-token?token=' . $this->resetToken,
            null
        );
        $this->utils->assertResponse("Verify Reset Token", $result, 200);
    }

    private function testResetPassword()
    {
        echo "\nTesting Password Reset Endpoints:\n";

        if (!$this->resetToken) {
            echo "Skipping password reset - no reset token available\n";
            return;
        }

        // Test password reset
        $resetData = [
            'password' => $this->newPassword
        ];

        $result = $this->utils->makeRequest(
            'POST',
            '/api/v1/auth/reset-password',
            $resetData,
            ['Authorization: Bearer ' . $this->resetToken]
        );
        $this->utils->assertResponse("Reset Password", $result, 200);
    }
}

// Run tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $authTest = new AuthTest();
    $authTest->runTests();
}
