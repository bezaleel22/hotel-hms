<?php

// Set include path to project root
$projectRoot = getenv('PHP_INCLUDE_PATH') ?: dirname(dirname(dirname(dirname(dirname(__FILE__)))));
$testsDir = $projectRoot . '/application/modules/api/tests';

class TestRunner {
    private $startTime;
    private $testClasses;

    public function __construct() {
        $this->startTime = microtime(true);
        $this->testClasses = $this->loadTestClasses();
    }

    private function loadTestClasses() {
        global $testsDir;
        $classes = [];
        
        // Scan for all test files
        $files = glob($testsDir . '/*Test.php');
        foreach ($files as $file) {
            if ($file === __FILE__) continue; // Skip RunTests.php itself
            
            // Get class name from filename
            $className = basename($file, '.php');
            if ($className === 'RunTests') continue;
            
            require_once $file;
            if (class_exists($className)) {
                $classes[$className] = new $className();
            }
        }
        
        return $classes;
    }

    public function runAllTests() {
        echo "\n===========================================";
        echo "\nStarting API Tests";
        echo "\n===========================================\n";

        // Reset test counters
        TestUtils::resetTestCounts();

        foreach ($this->testClasses as $name => $testClass) {
            echo "\n---------------------------------------";
            echo "\nExecuting {$name}";
            echo "\n---------------------------------------\n";
            $testClass->runTests();
            $this->printClassSummary();
        }

        $this->printFinalSummary();
    }

    private function printClassSummary() {
        $counts = TestUtils::getTestCounts();
        echo "\nClass Summary:";
        echo "\n- Passed: \033[0;32m" . $counts['passed'] . "\033[0m";
        echo "\n- Failed: \033[0;31m" . $counts['failed'] . "\033[0m";
        echo "\n- Total:  " . $counts['total'] . "\n";
    }

    private function printFinalSummary() {
        $duration = round(microtime(true) - $this->startTime, 2);
        $counts = TestUtils::getTestCounts();
        
        echo "\n===========================================";
        echo "\nTest Execution Summary";
        echo "\n===========================================";
        echo "\nTotal Tests:    " . $counts['total'];
        echo "\nPassed Tests:   \033[0;32m" . $counts['passed'] . "\033[0m";
        echo "\nFailed Tests:   \033[0;31m" . $counts['failed'] . "\033[0m";
        echo "\nPass Rate:      " . ($counts['total'] > 0 ? round(($counts['passed'] / $counts['total']) * 100, 2) : 0) . "%";
        echo "\nExecution Time: {$duration} seconds";
        echo "\n";
        echo "\nDetailed logs available in: /application/modules/api/tests/logs/api_tests.log";
        echo "\n===========================================\n\n";

        // Return non-zero exit code if any tests failed
        if ($counts['failed'] > 0) {
            exit(1);
        }
    }
}

// Run all tests if this file is executed directly
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    $runner = new TestRunner();
    $runner->runAllTests();
}