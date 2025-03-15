#!/bin/bash

# Colors for console output
RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Test counter variables
TOTAL_TESTS=0
PASSED_TESTS=0
FAILED_TESTS=0

# Helper function to count test results
count_test_result() {
    local success=$1
    ((TOTAL_TESTS++))
    if [ "$success" = true ]; then
        ((PASSED_TESTS++))
    else
        ((FAILED_TESTS++))
    fi
}

# Configuration
BASE_URL="http://localhost/api/v1"
TEST_EMAIL="test@example.com"
TEST_PASSWORD="test123"
LOG_DIR="application/modules/api/tests/logs"
LOG_FILE="${LOG_DIR}/api_tests.log"

# Ensure log directory exists
mkdir -p "$LOG_DIR"

# Initialize log file
init_log() {
    rm -f "$LOG_FILE"
    echo -e "API Test Run: $(date '+%Y-%m-%d %H:%M:%S')\nEnvironment: ${BASE_URL}\n" > "$LOG_FILE"
}

# Enhanced logging function
log_test() {
    local method="$1"
    local endpoint="$2"
    local status="$3"
    local response="$4"
    local duration="$5"
    local category="${6:-undefined}"

    echo -e "\n[$(date '+%Y-%m-%d %H:%M:%S')] ${method} ${endpoint}" >> "$LOG_FILE"
    echo -e "Category: ${category}" >> "$LOG_FILE"
    echo -e "Duration: ${duration}ms" >> "$LOG_FILE"
    echo -e "Status: ${status}" >> "$LOG_FILE"
    echo -e "Response: ${response}\n" >> "$LOG_FILE"
    echo -e "-------------------------------------------" >> "$LOG_FILE"
}

# Enhanced test endpoint function
test_endpoint() {
    local method="$1"
    local endpoint="$2"
    local data="$3"
    local auth_type="$4"
    local description="$5"
    local category="${6:-general}"
    
    local curl_cmd="curl -s -X ${method} \"${BASE_URL}${endpoint}\""
    
    # Add headers
    local headers="-H \"Accept: application/json\" -H \"Content-Type: application/json\""
    if [ "$auth_type" = "auth" ] && [ -n "$ACCESS_TOKEN" ]; then
        headers="$headers -H \"Authorization: Bearer ${ACCESS_TOKEN}\""
    fi
    curl_cmd="$curl_cmd $headers"
    
    # Add data if present
    if [ -n "$data" ]; then
        curl_cmd="$curl_cmd --data '${data}'"
    fi
    
    # Execute and capture response
    local response=$(eval "$curl_cmd")

    # Log the command for debugging
    echo "Debug: Executing command: $curl_cmd" >> "$LOG_FILE"
 
    # Validate JSON response
    if ! echo "$response" | jq -e . >/dev/null 2>&1; then
        echo -e "${RED}✗ ${description} (Invalid JSON response)${NC}"
        echo "$response" >> "$LOG_FILE"
        exit 1
    fi
    
    # Check response status
    local status=$(echo "$response" | jq -r '.status // false')
    local code=$(echo "$response" | jq -r '.code // 500')
    
    if [ "$status" = "true" ] || [ "$code" -lt 400 ]; then
        echo -e "${GREEN}✓ ${description}${NC}"
        log_test "$method" "$endpoint" "SUCCESS" "$response" "0" "$category"
        count_test_result true
    else
        local error_msg=$(echo "$response" | jq -r '.message // "Unknown error"')
        echo -e "${RED}✗ ${description} (${error_msg})${NC}"
        log_test "$method" "$endpoint" "FAILED" "$response" "0" "$category"
        count_test_result false
    fi

    echo "$response"
}

# Main test execution
main() {
    init_log
    
    # Test root endpoint
    echo -e "\n${BLUE}Testing Root Endpoint...${NC}"
    echo -e "--------------------------------"
    test_endpoint "GET" "" "" "" "API Information" "root" | head -n 1

    # Test content endpoints
    echo -e "\n${BLUE}Testing Content Endpoints...${NC}"
    echo -e "--------------------------------"
    test_endpoint "GET" "/content/home" "" "" "Home Content" "content" | head -n 1
    test_endpoint "GET" "/content/about" "" "" "About Content" "content" | head -n 1
    test_endpoint "GET" "/content/gallery" "" "" "Gallery Content" "content" | head -n 1
    test_endpoint "GET" "/content/pages/terms" "" "" "Page Content" "content" | head -n 1

    # Test room endpoints
    echo -e "\n${BLUE}Testing Room Endpoints...${NC}"
    echo -e "--------------------------------"
    
    # Room list with filters
    test_endpoint "GET" "/rooms?type=Deluxe&capacity=2&status=1" "" "" "Room List" "rooms" | head -n 1
    
    # Room details - using correct path parameter
    test_endpoint "GET" "/rooms/1" "" "" "Room Details" "rooms" | head -n 1
    
    # Calculate dates for room availability and booking tests
    # Use dates further in the future (e.g., 30 days ahead) to avoid conflicts with existing bookings
    CHECKIN_DATE=$(date -d "+30 days" +%Y-%m-%d)
    CHECKOUT_DATE=$(date -d "+33 days" +%Y-%m-%d)  # 3-day stay

    # Test room availability with the new dates
    test_endpoint "GET" "/rooms/availability?room_id=1&checkin=${CHECKIN_DATE}&checkout=${CHECKOUT_DATE}" "" "" "Room Availability" "rooms" | head -n 1
    
    # Room types
    test_endpoint "GET" "/rooms/types" "" "" "Room Types" "rooms" | head -n 1
    
    # Room facilities - can be filtered by room_id
    test_endpoint "GET" "/rooms/facilities?room_id=1" "" "" "Room Facilities" "rooms" | head -n 1

    # Test authentication endpoints
    echo -e "\n${BLUE}Testing Authentication...${NC}"
    echo -e "--------------------------------"
    
    # Test signup with all required fields from Auth.php signup method
    test_endpoint "POST" "/auth/signup" "{\"email\": \"${TEST_EMAIL}\", \"password\": \"${TEST_PASSWORD}\", \"firstname\": \"Test\", \"lastname\": \"User\"}" "" "User Signup" "auth" | head -n 1
    
    # Test login with correct fields
    RESPONSE=$(test_endpoint "POST" "/auth/login" "{\"email\": \"${TEST_EMAIL}\", \"password\": \"${TEST_PASSWORD}\"}" "" "User Login" "auth")
    echo "$RESPONSE" | head -n 1
    RESPONSE=$(echo "$RESPONSE" | tail -n +2)

    # Extract tokens from login response for authenticated requests
    ACCESS_TOKEN=$(echo "$RESPONSE" | jq -r '.data.access_token')
    REFRESH_TOKEN=$(echo "$RESPONSE" | jq -r '.data.refresh_token')
    CUSTOMER_ID=$(echo "$RESPONSE" | jq -r '.data.customer.customerid')

    # Test customer endpoints
    echo -e "\n${BLUE}Testing Customer Endpoints...${NC}"
    echo -e "--------------------------------"
    test_endpoint "GET" "/customer/${CUSTOMER_ID}" "" "auth" "Get Customer Details" "customers" | head -n 1
    test_endpoint "PUT" "/customer/${CUSTOMER_ID}" "{\"phone\":\"1234567890\"}" "auth" "Update Customer" "customers" | head -n 1
    test_endpoint "GET" "/customer/${CUSTOMER_ID}/bookings" "" "auth" "Customer Bookings" "customers" | head -n 1
    # test_endpoint "POST" "/customer/${CUSTOMER_ID}/change-password" "{\"current_password\":\"${ORIGINAL_PASSWORD}\",\"new_password\":\"${NEW_PASSWORD}\"}" "auth" "Change Password" "customers" | head -n 1

    # Test booking endpoints
    echo -e "\n${BLUE}Testing Booking Endpoints...${NC}"
    echo -e "--------------------------------"
    BOOKING_DATA="{\"room_id\":1,\"checkin\":\"${CHECKIN_DATE}\",\"checkout\":\"${CHECKOUT_DATE}\",\"adults\":2,\"children\":0,\"special_requests\":\"None\"}"
    RESPONSE=$(test_endpoint "POST" "/bookings" "$BOOKING_DATA" "auth" "Create Booking" "bookings")
    echo "$RESPONSE" | head -n 1

    BOOKING_ID=$(echo "$RESPONSE" | tail -n +2 | jq -r '.data.booking_id')
    test_endpoint "GET" "/bookings/${BOOKING_ID}" "" "auth" "Get Booking Details" "bookings" | head -n 1
    UPDATE_DATA="{\"adults\":3,\"children\":1,\"special_requests\":\"Updated\"}"
    test_endpoint "PUT" "/bookings/${BOOKING_ID}" "$UPDATE_DATA" "auth" "Update Booking" "bookings" | head -n 1
    test_endpoint "DELETE" "/bookings/${BOOKING_ID}" "" "auth" "Cancel Booking" "bookings" | head -n 1

    # Test contact endpoints
    echo -e "\n${BLUE}Testing Contact Endpoints...${NC}"
    echo -e "--------------------------------"
    UNIQUE_TEST_EMAIL="${TEST_EMAIL}_$(date +%s)@example.com"
    test_endpoint "POST" "/contact" "{\"name\":\"Test User\",\"email\":\"${TEST_EMAIL}\",\"phone\":\"1234567890\",\"message\":\"Test message\"}" "" "Submit Contact Form" "contact" | head -n 1
    RESPONSE=$(test_endpoint "POST" "/subscribe" "{\"email\":\"${UNIQUE_TEST_EMAIL}\"}" "" "Newsletter Subscribe" "contact")
    echo "$RESPONSE" | head -n 1
    VERIFICATION_TOKEN=$(echo "$RESPONSE" | tail -n +2 | jq -r '.data.token')
    test_endpoint "GET" "/subscribe/verify/${VERIFICATION_TOKEN}" "" "" "Verify Subscription" "contact" | head -n 1

    # Test payment endpoints
    echo -e "\n${BLUE}Testing Payment Endpoints...${NC}"
    echo -e "--------------------------------"
    test_endpoint "GET" "/payments/methods" "" "auth" "Get Payment Methods" "payments" | head -n 1
    test_endpoint "POST" "/payments/process" "{\"booking_id\":${BOOKING_ID},\"payment_method\":\"${PAYMENT_METHOD}\",\"amount\":100}" "auth" "Process Payment" "payments" | head -n 1
    test_endpoint "POST" "/payments/verify/${BOOKING_ID}" "" "auth" "Verify Payment" "payments" | head -n 1

    # Test configuration endpoints
    echo -e "\n${BLUE}Testing Configuration Endpoints...${NC}"
    echo -e "--------------------------------"
    test_endpoint "GET" "/config/settings" "" "" "Get Settings" "config" | head -n 1
    test_endpoint "GET" "/config/languages" "" "" "Get Languages" "config" | head -n 1
    test_endpoint "GET" "/config/currency" "" "" "Get Currency" "config" | head -n 1

    # Test promocode endpoints
    echo -e "\n${BLUE}Testing Promocode Endpoints...${NC}"
    echo -e "--------------------------------"
    test_endpoint "POST" "/promocodes/validate" "{\"code\":\"TEST2024\"}" "auth" "Validate Promocode" "promocodes" | head -n 1
    test_endpoint "GET" "/promocodes" "" "auth" "List Promocodes" "promocodes" | head -n 1
    test_endpoint "GET" "/promocodes/history" "" "auth" "Promocode History" "promocodes" | head -n 1

    # Test logout
    test_endpoint "POST" "/auth/logout" "" "auth" "User Logout" "auth" | head -n 1

    # Test password management endpoints
    echo -e "\n${BLUE}Testing Password Management...${NC}"
    echo -e "--------------------------------"

    # Store original password to revert back
    ORIGINAL_PASSWORD="${TEST_PASSWORD}"
    NEW_PASSWORD="newpass123"

    # Test change password
    test_endpoint "POST" "/customers/${CUSTOMER_ID}/change-password" \
        "{\"current_password\":\"${ORIGINAL_PASSWORD}\",\"new_password\":\"${NEW_PASSWORD}\"}" \
        "auth" "Change Password" "password" | head -n 1

    # Test logout with current token
    test_endpoint "POST" "/auth/logout" "" "auth" "Logout Before New Password Test" "auth" | head -n 1

    # Test forgot password (updated route)
    test_endpoint "POST" "/auth/forgot-password" "{\"email\":\"${TEST_EMAIL}\"}" "" "Forgot Password" "password" | head -n 1

    # Note: Since the actual reset token is sent via email, we'll skip the actual token verification
    # and reset password tests in automated testing. These should be tested manually.
    echo -e "${YELLOW}ℹ Skipping reset token verification - token sent to email${NC}"
    echo -e "${YELLOW}ℹ Skipping password reset - requires valid token from email${NC}"


    # Test login with new password
    echo -e "\n${BLUE}Testing Login with New Password...${NC}"
    local login_data="{\"email\":\"${TEST_EMAIL}\",\"password\":\"${NEW_PASSWORD}\"}"
    local login_response=$(curl -s -X POST "${BASE_URL}/auth/login" \
        -H "Content-Type: application/json" \
        -H "Accept: application/json" \
        -d "$login_data")

    if echo "$login_response" | jq -e '.status == true' >/dev/null 2>&1; then
        echo -e "${GREEN}✓ Login with New Password${NC}"
        log_test "POST" "/auth/login" "SUCCESS" "$login_response" "0" "auth"
        count_test_result true
    else
        echo -e "${RED}✗ Login with New Password Failed${NC}"
        log_test "POST" "/auth/login" "FAILED" "$login_response" "0" "auth"
        count_test_result false
    fi

    # Update token for subsequent requests
    TOKEN=$(echo "$login_response" | jq -r '.data.token')

    # Change password back to original
    test_endpoint "POST" "/customers/${CUSTOMER_ID}/change-password" \
        "{\"current_password\":\"${NEW_PASSWORD}\",\"new_password\":\"${ORIGINAL_PASSWORD}\"}" \
        "auth" "Revert Password" "password" | head -n 1

    # Logout again
    test_endpoint "POST" "/auth/logout" "" "auth" "Logout After Password Revert" "auth" | head -n 1

    # Final login with original password to restore initial state
    login_data="{\"email\":\"${TEST_EMAIL}\",\"password\":\"${ORIGINAL_PASSWORD}\"}"
    login_response=$(curl -s -X POST "${BASE_URL}/auth/login" \
        -H "Content-Type: application/json" \
        -H "Accept: application/json" \
        -d "$login_data")

    if echo "$login_response" | jq -e '.status == true' >/dev/null 2>&1; then
        echo -e "${GREEN}✓ Login with Original Password${NC}"
        log_test "POST" "/auth/login" "SUCCESS" "$login_response" "0" "auth"
        count_test_result true
    else
        echo -e "${RED}✗ Login with Original Password Failed${NC}"
        log_test "POST" "/auth/login" "FAILED" "$login_response" "0" "auth"
        count_test_result false
    fi

    # Reset TEST_PASSWORD to original value
    TEST_PASSWORD="${ORIGINAL_PASSWORD}"

    # Print summary
    echo -e "\n${BLUE}Test Run Summary${NC}"
    echo -e "--------------------------------"
    echo -e "Total Tests  : ${TOTAL_TESTS}"
    echo -e "Passed Tests : ${GREEN}${PASSED_TESTS}${NC}"
    echo -e "Failed Tests : ${RED}${FAILED_TESTS}${NC}"
    echo -e "Success Rate : ${GREEN}$(( (PASSED_TESTS * 100) / TOTAL_TESTS ))%${NC}"
    echo -e "--------------------------------"
    echo -e "Results saved to: ${LOG_FILE}"
    echo -e "--------------------------------\n"
}

# Execute main function
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main
fi
