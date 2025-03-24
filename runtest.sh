#!/bin/bash

# Ensure the script exits on any error
set -e

# Path to the PHP test script
TEST_SCRIPT="api_test.php"

# Check if the PHP test script exists
if [[ ! -f "$TEST_SCRIPT" ]]; then
  echo "Error: $TEST_SCRIPT not found!"
  exit 1
fi

# Run the PHP test script
echo "Running API tests..."
php "$TEST_SCRIPT"

# Check the exit status of the PHP script
if [[ $? -eq 0 ]]; then
  echo "All tests completed successfully."
else
  echo "Some tests failed. Please check the output for details."
  exit 1
fi