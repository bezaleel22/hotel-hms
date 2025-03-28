# Accounts Module Documentation

## Table of Contents
- [Overview](#overview)
- [Core Features](#core-features)
- [Database Structure](#database-structure)
- [Integration Points](#integration-points)
- [Usage Guide](#usage-guide)
- [Security](#security)
- [Best Practices](#best-practices)
- [Troubleshooting](#troubleshooting)

## Overview

The Accounts module (`application/modules/accounts`) manages all financial transactions, vouchers, and accounting operations in the HMS system. It follows double-entry bookkeeping principles and provides comprehensive financial management capabilities.

### Key Features
- Chart of Accounts (COA) management
- Multiple voucher types (Debit, Credit, Contra, Journal)
- Financial reporting
- Voucher approval workflow
- Integration with other HMS modules

## Core Features

### 1. Chart of Accounts (COA)

#### Access
```
URL: accounts/chart-of-account
Controller: Accounts::chart_of_account()
Model: Accounts_model::get_coa()
```

#### Features
- Hierarchical account structure
- Account types: Assets, Liabilities, Income, Expenses
- Account status management
- Transaction history tracking

#### Implementation
```php
// Create new account
$coa_data = [
    'HeadCode' => $head_code,
    'HeadName' => $head_name,
    'PHeadName' => $parent_head,
    'HeadLevel' => $level,
    'IsTransaction' => $is_transaction,
    'IsGL' => $is_gl,
    'HeadType' => $head_type
];
```

### 2. Voucher Management

#### 2.1 Debit Voucher
```
URL: accounts/debit-voucher
Controller: Accounts::debit_voucher()
Model: Accounts_model::insert_debitvoucher()
```

Required fields:
- Voucher No (auto-generated)
- Debit Account
- Credit Account(s)
- Amount(s)
- Date
- Narration

#### 2.2 Credit Voucher
```
URL: accounts/credit-voucher
Controller: Accounts::credit_voucher()
Model: Accounts_model::insert_creditvoucher()
```

#### 2.3 Contra Voucher
```
URL: accounts/contra-voucher
Controller: Accounts::contra_voucher()
Model: Accounts_model::insert_contravoucher()
```

#### 2.4 Journal Voucher
```
URL: accounts/journal-voucher
Controller: Accounts::journal_voucher()
Model: Accounts_model::insert_journalvoucher()
```

### 3. Financial Reporting

#### Available Reports
1. Trial Balance
2. General Ledger
3. Profit & Loss
4. Balance Sheet
5. Cash Flow Statement

#### Implementation Example
```php
// Generate Trial Balance
public function trial_balance($from_date, $to_date) {
    $this->permission->method('accounts', 'read')->redirect();
    
    $data['accounts'] = $this->Accounts_model->get_trial_balance_data($from_date, $to_date);
    $data['title'] = display('trial_balance');
    
    return $this->load->view('accounts/trial_balance', $data);
}
```

## Database Structure

### Key Tables

1. `acc_coa` (Chart of Accounts)
```sql
CREATE TABLE IF NOT EXISTS `acc_coa` (
    `HeadCode` int(11) NOT NULL PRIMARY KEY,
    `HeadName` varchar(100) NOT NULL,
    `PHeadName` varchar(100) NOT NULL,
    `HeadLevel` int(11) NOT NULL,
    `IsTransaction` tinyint(1) NOT NULL,
    `IsGL` tinyint(1) NOT NULL,
    `HeadType` char(1) NOT NULL,
    `CreateBy` varchar(50) NOT NULL,
    `CreateDate` datetime NOT NULL,
    `UpdateBy` varchar(50) NOT NULL,
    `UpdateDate` datetime NOT NULL
);
```

2. `acc_transaction`
3. `acc_income_expence`
4. `tbl_openingbalance`

## Integration Points

### 1. Day Closing Module
```php
// Sync with daily operations
public function sync_day_closing($date) {
    $this->db->trans_start();
    // Sync logic here
    $this->db->trans_complete();
}
```

### 2. API Module
```
GET /api/v1/accounts/balance
GET /api/v1/accounts/transactions
POST /api/v1/accounts/voucher
```

### 3. Payment Module Integration
- Payment gateway transactions
- Refund processing
- Settlement reconciliation

## Usage Guide

### 1. Creating New Account

```php
// Controller method
public function create_coa() {
    $this->permission->method('accounts', 'create')->redirect();
    
    $data = [
        'HeadCode' => $this->input->post('txtHeadCode'),
        'HeadName' => $this->input->post('txtHeadName'),
        // ... other fields
    ];
    
    $this->Accounts_model->create_coa($data);
}
```

### 2. Voucher Creation Process

1. Select voucher type
2. Enter transaction details
3. Submit for approval
4. Process approval
5. Post to ledger

### 3. Report Generation

```php
// Generate financial report
public function generate_report($type, $params) {
    $this->load->library('accounts_report');
    return $this->accounts_report->generate($type, $params);
}
```

## Security

### 1. Permission System
```php
// Required permissions
$this->permission->method('accounts', 'create')->redirect();
$this->permission->method('accounts', 'read')->redirect();
$this->permission->method('accounts', 'update')->redirect();
$this->permission->method('accounts', 'delete')->redirect();
```

### 2. Input Validation
```php
// Validation rules
$this->form_validation->set_rules('txtAmount[]', 'Amount', 'required|numeric');
$this->form_validation->set_rules('txtCode[]', 'Account Code', 'required|integer');
```

### 3. Transaction Security
- Double-entry verification
- Balance checking
- Audit trail maintenance

## Best Practices

1. Voucher Management
   - Always use approval workflow
   - Maintain proper documentation
   - Regular reconciliation

2. Account Structure
   - Follow standard accounting principles
   - Maintain logical hierarchy
   - Regular review and cleanup

3. Data Integrity
   - Regular backups
   - Transaction verification
   - Audit trail maintenance

## Troubleshooting

### Common Issues

1. Voucher Posting Failures
   - Check account balances
   - Verify transaction dates
   - Validate approval status

2. Report Generation Issues
   - Verify date ranges
   - Check account status
   - Validate financial year settings

### Error Codes

| Code | Description | Solution |
|------|-------------|----------|
| E001 | Insufficient Balance | Check account balance |
| E002 | Invalid Account | Verify account code |
| E003 | Approval Required | Submit for approval |

### Support

For technical support:
1. Check documentation
2. Review error logs
3. Contact system administrator

---

**Note**: This documentation is maintained by the HMS development team. For updates or contributions, please follow the standard pull request process.

Last Updated: [Current Date]
Version: 1.0.0

## User Guide - Admin Dashboard

### Accessing the Accounts Module

1. Log in to the admin dashboard
2. Navigate to the "Accounts" section in the main menu
3. You'll see the following sub-menu items:
   - Chart of Accounts
   - Create Voucher
   - Voucher List
   - Financial Reports
   - Account Settings

### 1. Managing Chart of Accounts

#### Viewing Chart of Accounts
1. Go to Accounts → Chart of Accounts
2. You'll see a hierarchical tree view of all accounts
3. Use the search box to find specific accounts
4. Click on any account to view its details

#### Creating New Account
1. Click "Add Account" button
2. Fill in the required fields:
   - Account Name
   - Account Type (Asset, Liability, Income, Expense)
   - Parent Account (if applicable)
   - Opening Balance (optional)
3. Click "Save" to create the account

#### Modifying Accounts
1. Find the account in the list
2. Click the "Edit" icon
3. Update the necessary information
4. Click "Save" to apply changes

### 2. Creating Vouchers

#### Debit Voucher
1. Go to Accounts → Create Voucher → Debit Voucher
2. Fill in:
   - Date
   - Debit Account (expense/asset account)
   - Credit Account (usually cash/bank)
   - Amount
   - Description
3. Click "Submit for Approval"

#### Credit Voucher
1. Navigate to Accounts → Create Voucher → Credit Voucher
2. Enter:
   - Date
   - Credit Account (income/liability account)
   - Debit Account (usually cash/bank)
   - Amount
   - Description
3. Submit for approval

#### Journal Voucher
1. Go to Accounts → Create Voucher → Journal Voucher
2. Add multiple debit and credit entries
3. Ensure total debits equal total credits
4. Add description for each entry
5. Submit for approval

### 3. Voucher Approval Process

#### Submitting Vouchers
1. Create any type of voucher
2. Fill in all required information
3. Click "Submit for Approval"
4. The voucher status will show as "Pending"

#### Approving Vouchers
1. Go to Accounts → Voucher List
2. Filter by "Pending Approval"
3. Review voucher details
4. Click "Approve" or "Reject"
5. Add approval notes if necessary

### 4. Generating Reports

#### Trial Balance
1. Go to Accounts → Financial Reports → Trial Balance
2. Select date range
3. Choose report format (PDF/Excel)
4. Click "Generate Report"

#### Income Statement
1. Navigate to Accounts → Financial Reports → Income Statement
2. Select period (Monthly/Quarterly/Yearly)
3. Choose comparison period (optional)
4. Generate report

#### Balance Sheet
1. Access Accounts → Financial Reports → Balance Sheet
2. Select date
3. Choose display format
4. Generate report

### 5. Daily Operations

#### Day Opening
1. Start each day by reviewing opening balances
2. Verify previous day's closing entries
3. Check for pending approvals

#### Day Closing
1. Review all transactions for the day
2. Ensure all vouchers are approved
3. Generate daily summary report
4. Perform cash/bank reconciliation

### 6. Common Tasks

#### Bank Reconciliation
1. Go to Accounts → Bank Reconciliation
2. Select bank account
3. Enter statement date
4. Match transactions
5. Mark reconciled items
6. Save reconciliation

#### Finding Transactions
1. Use the search function in Voucher List
2. Filter by:
   - Date range
   - Voucher type
   - Amount
   - Account
   - Status

### 7. Tips and Best Practices

#### Daily Tasks
- Review pending vouchers
- Approve/reject pending transactions
- Reconcile cash accounts
- Check for unusual transactions

#### Monthly Tasks
- Generate monthly reports
- Perform bank reconciliations
- Review account balances
- Check for unreconciled items

#### Year-End Procedures
- Close temporary accounts
- Generate annual reports
- Prepare closing entries
- Back up financial data

### 8. Troubleshooting Common Issues

#### Voucher Not Saving
- Check all required fields are filled
- Ensure debits equal credits
- Verify account selections are valid

#### Report Generation Fails
- Clear browser cache
- Check date range selection
- Verify account status
- Try different report format

#### Balance Mismatch
1. Review recent transactions
2. Check for unapproved vouchers
3. Verify opening balances
4. Run trial balance report

### 9. Security Recommendations

#### Password Management
- Change password regularly
- Use strong passwords
- Don't share login credentials

#### Transaction Security
- Always log out after use
- Review audit trails regularly
- Report suspicious activities
- Verify large transactions

### 10. Getting Help

If you encounter issues:
1. Check this documentation
2. Contact system administrator
3. Review error messages
4. Check system logs

---

**Note**: This user guide assumes you have appropriate permissions to access all features. Some functions may be restricted based on your user role.

Last Updated: [Current Date]
Version: 1.0.0
