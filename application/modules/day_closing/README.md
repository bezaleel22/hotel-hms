# Day Closing Module

## Overview
The Day Closing module manages cash register operations in the Hotel Management System. It helps track daily transactions, manage cash counters, and generate financial reports.

## Features
- Cash register opening/closing
- Multiple counter management
- Transaction tracking
- Financial reporting with export options
- Secure session handling

## Installation
1. The module is part of the core HMS system
2. Ensure the module is activated in the Admin > Modules section
3. Required database tables will be created automatically

## Usage Guide

### 1. Setting Up Counters
- Navigate to Day Closing > Counter List
- Click "Add Counter" to create new cash counters
- Enter counter number/name
- Save the counter

### 2. Starting Day Operations
- When a user logs in, they'll see the option to start a cash register
- Fill in:
  * Select Counter Number
  * Enter Opening Balance
  * Add Opening Notes (optional)
- Click "Add Opening Balance" to start the session

### 3. During Operations
- System automatically tracks:
  * Cash received
  * Expenses
  * Running balance
- All transactions are linked to the active register session

### 4. Closing Day Operations
- Click the "Day Close" button (red) in the top header
- Review the day's summary:
  * Opening balance
  * Total transactions
  * Revenue breakdowns
  * Final closing balance
- Add closing notes if needed
- Click "Add Closing Balance" to complete

### 5. Reports
- Access Day Closing > Report
- Filter reports by:
  * Date range
  * Counter number
  * Cashier
- Export options:
  * CSV
  * Excel
  * PDF
- Reports include:
  * Transaction details
  * Opening/Closing balances
  * Counter and cashier information

## Security Features
- Session-based authentication
- User-specific register tracking
- Transaction approval system
- Audit trail of all operations

## Access Control
- Module access can be controlled through user permissions
- Available permissions:
  * View counters
  * Manage counters
  * View reports
  * Operate registers

## Database Tables
- tbl_cashregister: Stores register sessions
- tbl_cashcounter: Manages counter locations
- acc_transaction: Tracks financial transactions

## API Endpoints
- POST /day_closing/cashregister/checkcashregister
- POST /day_closing/cashregister/addcashregister
- GET /day_closing/cashregister/cashregisterclose
- POST /day_closing/cashregister/closecashregister

## Troubleshooting
1. Day Close button not visible
   - Check if module is activated
   - Verify user has active register session

2. Cannot close register
   - Ensure all transactions are completed
   - Check for active session
   - Verify correct counter selection

3. Reports not showing
   - Check date range
   - Verify user permissions
   - Ensure transactions exist for selected period

## Support
For technical support:
1. Check system logs for errors
2. Verify database connectivity
3. Contact system administrator

## Best Practices
1. Always close register at day end
2. Verify balances before closing
3. Keep detailed notes for discrepancies
4. Regularly export and backup reports