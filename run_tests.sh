#!/bin/bash

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Project directory
PROJECT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
TEST_SCRIPTS_DIR="$PROJECT_DIR/application/modules/api/tests"
TEST_LOGS_DIR="$PROJECT_DIR/application/modules/api/tests/logs"

# Initialize counters
TOTAL_TESTS=0
PASSED_TESTS=0
FAILED_TESTS=0

# Function to display usage information
show_help() {
    echo -e "${BLUE}Usage:${NC} ./run_tests.sh [OPTIONS]"
    echo
    echo "Options:"
    echo "  -h, --help        Show this help message"
    echo "  -a, --all         Run all tests (default)"
    echo "  -u, --auth        Run only authentication tests"
    echo "  -c, --customer    Run only customer management tests"
    echo "  -b, --booking     Run only booking and payment tests"
    echo "  --clean-logs      Clean test logs before running"
    echo
    echo "Example:"
    echo "  ./run_tests.sh --all"
    echo "  ./run_tests.sh --auth --clean-logs"
}

# Function to verify directory structure
verify_structure() {
    if [ ! -d "$TEST_SCRIPTS_DIR" ]; then
        echo -e "${RED}Error: Test scripts directory not found at: $TEST_SCRIPTS_DIR${NC}"
        exit 1
    fi

    # Verify test files exist
    local test_files=($TEST_SCRIPTS_DIR/*Test.php)
    if [ ${#test_files[@]} -eq 0 ]; then
        echo -e "${RED}Error: No test files found in: $TEST_SCRIPTS_DIR${NC}"
        exit 1
    fi
}

# Function to clean logs
clean_logs() {
    echo -e "${BLUE}Cleaning test logs...${NC}"
    mkdir -p "$TEST_LOGS_DIR"
    rm -f "$TEST_LOGS_DIR/api_tests.log"
    touch "$TEST_LOGS_DIR/api_tests.log"
}

# Function to parse test results
parse_test_results() {
    local output="$1"
    
    if [[ $output =~ "Total Tests: "([0-9]+) ]]; then
        TOTAL_TESTS=$((TOTAL_TESTS + ${BASH_REMATCH[1]}))
    fi
    if [[ $output =~ "Passed: "([0-9]+) ]]; then
        PASSED_TESTS=$((PASSED_TESTS + ${BASH_REMATCH[1]}))
    fi
    if [[ $output =~ "Failed: "([0-9]+) ]]; then
        FAILED_TESTS=$((FAILED_TESTS + ${BASH_REMATCH[1]}))
    fi
}

# Function to run specific test file
run_test() {
    local test_file=$1
    local test_name=$2
    
    echo -e "\n${BLUE}Running $test_name...${NC}"
    
    # Run the test and capture output
    output=$(PHP_INCLUDE_PATH="$PROJECT_DIR" php "$TEST_SCRIPTS_DIR/$test_file")
    local exit_code=$?
    
    # Display the output
    echo "$output"
    
    # Parse test results
    parse_test_results "$output"
    
    return $exit_code
}

# Function to print final summary
print_final_summary() {
    echo -e "\n${BLUE}===========================================";
    echo -e "FINAL TEST EXECUTION SUMMARY";
    echo -e "==========================================="
    echo -e "Total Tests Run:    ${NC}$TOTAL_TESTS"
    echo -e "${GREEN}Total Tests Passed: $PASSED_TESTS${NC}"
    echo -e "${RED}Total Tests Failed: $FAILED_TESTS${NC}"
    
    if [ $TOTAL_TESTS -gt 0 ]; then
        PASS_RATE=$(echo "scale=2; ($PASSED_TESTS * 100) / $TOTAL_TESTS" | bc)
        if [ $(echo "$PASS_RATE >= 90" | bc) -eq 1 ]; then
            echo -e "${GREEN}Pass Rate: $PASS_RATE%${NC}"
        elif [ $(echo "$PASS_RATE >= 75" | bc) -eq 1 ]; then
            echo -e "${YELLOW}Pass Rate: $PASS_RATE%${NC}"
        else
            echo -e "${RED}Pass Rate: $PASS_RATE%${NC}"
        fi
    fi
    
    echo -e "${BLUE}============================================${NC}"
}

# Parse command line arguments
ALL=true
AUTH=false
CUSTOMER=false
BOOKING=false
CLEAN=false

while [[ $# -gt 0 ]]; do
    case $1 in
        -h|--help)
            show_help
            exit 0
            ;;
        -a|--all)
            ALL=true
            ;;
        -u|--auth)
            ALL=false
            AUTH=true
            ;;
        -c|--customer)
            ALL=false
            CUSTOMER=true
            ;;
        -b|--booking)
            ALL=false
            BOOKING=true
            ;;
        --clean-logs)
            CLEAN=true
            ;;
        *)
            echo -e "${RED}Error: Unknown option $1${NC}"
            show_help
            exit 1
            ;;
    esac
    shift
done

# Verify directory structure and files
verify_structure

# Clean logs if requested
if [ "$CLEAN" = true ]; then
    clean_logs
fi

# Ensure test logs directory exists
mkdir -p "$TEST_LOGS_DIR"

# Track overall exit code
OVERALL_EXIT_CODE=0

echo -e "${BLUE}Running tests from: $PROJECT_DIR${NC}"
echo -e "${BLUE}Test scripts located in: $TEST_SCRIPTS_DIR${NC}"
echo -e "${BLUE}Logs will be written to: $TEST_LOGS_DIR${NC}\n"

# Run tests based on options
if [ "$ALL" = true ]; then
    # Get all test files except RunTests.php
    for test_file in "$TEST_SCRIPTS_DIR"/*Test.php; do
        if [ "$(basename "$test_file")" != "RunTests.php" ]; then
            test_name=$(basename "$test_file" .php)
            run_test "$(basename "$test_file")" "$test_name"
            [ $? -ne 0 ] && OVERALL_EXIT_CODE=1
        fi
    done
else
    if [ "$AUTH" = true ]; then
        run_test "AuthTest.php" "Authentication Tests"
        [ $? -ne 0 ] && OVERALL_EXIT_CODE=1
    fi
    if [ "$CUSTOMER" = true ]; then
        run_test "CustomerTest.php" "Customer Management Tests"
        [ $? -ne 0 ] && OVERALL_EXIT_CODE=1
    fi
    if [ "$BOOKING" = true ]; then
        run_test "PaymentTest.php" "Payment Tests"
        [ $? -ne 0 ] && OVERALL_EXIT_CODE=1
    fi
fi

# Print final summary
print_final_summary

# Print log file location
echo -e "\n${BLUE}Test logs are available at:${NC} $TEST_LOGS_DIR/api_tests.log"

# Exit with appropriate code
exit $OVERALL_EXIT_CODE