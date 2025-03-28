# Hotel HMS - Accounts Module User Guide
## Administrative Dashboard Manual

## Table of Contents
1. [Introduction](#introduction)
2. [Accounting Fundamentals](#accounting-fundamentals)
3. [Chart of Accounts](#chart-of-accounts)
4. [Voucher Management](#voucher-management)
5. [Financial Reports](#financial-reports)
6. [Daily Operations](#daily-operations)
7. [Period End Procedures](#period-end-procedures)
8. [System Configuration](#system-configuration)

## Introduction

### Purpose
The Accounts Module is the financial backbone of the Hotel HMS system, providing comprehensive tools for:
- Financial transaction management
- Account balancing
- Financial reporting
- Audit trail maintenance
- Revenue and expense tracking

### Key Features
- Double-entry bookkeeping system
- Real-time financial updates
- Integrated with booking and payment systems
- Automated voucher generation
- Multi-currency support
- Comprehensive reporting suite

## Accounting Fundamentals

### Double-Entry System
Every transaction in the system follows the double-entry principle:
- Each transaction affects at least two accounts
- Total debits must equal total credits
- Maintains accounting equation: Assets = Liabilities + Equity

### Account Types
1. **Assets**
   - What the hotel owns
   - Examples: Cash, Bank Accounts, Property, Equipment
   - Increases with debit, decreases with credit

2. **Liabilities**
   - What the hotel owes
   - Examples: Accounts Payable, Loans, Guest Deposits
   - Increases with credit, decreases with debit

3. **Income**
   - Revenue earned
   - Examples: Room Revenue, F&B Sales, Service Charges
   - Increases with credit, decreases with debit

4. **Expenses**
   - Costs incurred
   - Examples: Utilities, Salaries, Maintenance
   - Increases with debit, decreases with credit

5. **Equity**
   - Owner's stake in the business
   - Examples: Capital, Retained Earnings
   - Increases with credit, decreases with debit

## Chart of Accounts

### Accessing the Chart of Accounts
1. Navigate to: Accounts → Chart of Accounts
2. The interface displays a hierarchical tree structure
3. Use the search function to find specific accounts
4. Click on any account to view details

### Account Structure
Each account contains:
- Account Code (unique identifier)
- Account Name
- Account Type
- Parent Account (if applicable)
- Description
- Status (Active/Inactive)
- Balance Type (Debit/Credit)
- Opening Balance

### Creating New Accounts
1. Click "Add New Account"
2. Required Information:
   - Account Code (system suggests next available)
   - Account Name
   - Account Type
   - Parent Account (if subsidiary)
   - Opening Balance (if applicable)
3. Optional Fields:
   - Description
   - Notes
   - Tags
4. Click "Save" to create

### Account Hierarchy
Example structure:
```
1000 ASSETS
  1100 Current Assets
    1110 Cash in Hand
    1120 Bank Accounts
  1200 Fixed Assets
    1210 Buildings
    1220 Furniture
```

### Best Practices
- Use consistent naming conventions
- Maintain logical grouping
- Regular review and cleanup
- Document account purposes
- Monitor inactive accounts

## Voucher Management

### Types of Vouchers

#### 1. Debit Voucher
- Purpose: Record expenses or asset purchases
- When to use: Making payments, recording expenses
- Required fields:
  * Date
  * Debit Account (Expense/Asset)
  * Credit Account (Bank/Cash)
  * Amount
  * Description
  * Supporting documents

#### 2. Credit Voucher
- Purpose: Record income or receipts
- When to use: Receiving payments, recording revenue
- Required fields:
  * Date
  * Credit Account (Income/Liability)
  * Debit Account (Bank/Cash)
  * Amount
  * Reference
  * Description

#### 3. Journal Voucher
- Purpose: Record non-cash transactions
- When to use: Adjustments, corrections, accruals
- Features:
  * Multiple debit and credit entries
  * Balanced entries required
  * Detailed narration
  * Supporting documentation

#### 4. Contra Voucher
- Purpose: Record internal fund transfers
- When to use: Moving money between accounts
- Key aspects:
  * Both accounts typically asset accounts
  * Usually bank or cash accounts
  * Transfer reference required

### Voucher Creation Process

#### Step 1: Select Voucher Type
1. Navigate to: Accounts → Create Voucher
2. Choose appropriate voucher type
3. System generates voucher number

#### Step 2: Enter Details
1. Select transaction date
2. Choose relevant accounts
3. Enter amount(s)
4. Add description/narration
5. Attach supporting documents

#### Step 3: Verification
1. Check account selections
2. Verify amounts
3. Ensure supporting documents attached
4. Review narration

#### Step 4: Submission
1. Submit for approval
2. System validates entries
3. Notification sent to approver

### Voucher Approval Workflow

#### Pending Approval
1. Approver receives notification
2. Reviews voucher details
3. Checks supporting documents
4. Verifies account selections

#### Approval Actions
1. Approve: Posts to ledger
2. Reject: Returns to creator
3. Hold: Requests additional information

### Voucher Search and Modification

#### Search Options
- Date range
- Voucher type
- Amount range
- Account involved
- Status
- Created by
- Approved by

#### Modification Rules
- Unapproved vouchers: Fully editable
- Approved vouchers: Require reversal
- Rejected vouchers: Can be edited and resubmitted

## Financial Reports

### Standard Reports

#### 1. Trial Balance
- Purpose: Verify accounting equation
- Features:
  * Account balances
  * Debit/Credit totals
  * Period selection
  * Comparison options

#### 2. Balance Sheet
- Purpose: Financial position
- Sections:
  * Assets
  * Liabilities
  * Equity
- Features:
  * Point-in-time snapshot
  * Comparative periods
  * Notes section

#### 3. Income Statement
- Purpose: Operational performance
- Sections:
  * Revenue
  * Expenses
  * Net Income
- Features:
  * Period selection
  * Department filtering
  * Variance analysis

#### 4. Cash Flow Statement
- Purpose: Cash movement tracking
- Sections:
  * Operating activities
  * Investing activities
  * Financing activities
- Features:
  * Direct/Indirect method
  * Bank reconciliation
  * Forecast integration

### Report Generation

#### Steps to Generate
1. Select report type
2. Choose period
3. Set parameters
4. Select format
5. Generate report

#### Export Options
- PDF
- Excel
- CSV
- Print-ready format

#### Scheduling Reports
1. Set frequency
2. Define recipients
3. Choose format
4. Set delivery method

## Daily Operations

### Morning Procedures
1. Review previous day's transactions
2. Check pending approvals
3. Verify bank balances
4. Process recurring entries

### Transaction Processing
1. Record daily transactions
2. Process payments
3. Handle refunds
4. Manage deposits

### Evening Procedures
1. Review day's entries
2. Approve pending transactions
3. Generate daily reports
4. Backup financial data

### Reconciliation
1. Bank reconciliation
2. Cash count
3. Credit card settlement
4. Payment gateway reconciliation

## Period End Procedures

### Month End
1. Review pending transactions
2. Process accruals
3. Reconcile accounts
4. Generate monthly reports

### Year End
1. Close temporary accounts
2. Process adjusting entries
3. Generate annual reports
4. Archive fiscal year

## System Configuration

### General Settings
- Fiscal year definition
- Currency settings
- Decimal precision
- Date format

### Security Settings
- User access levels
- Approval workflows
- Audit trail settings
- Backup configuration

### Integration Settings
- Payment gateway
- Banking interfaces
- POS systems
- Property management system

## Best Practices

### Daily Tasks
- Regular backups
- Transaction review
- Balance verification
- Pending approval check

### Monthly Tasks
- Account reconciliation
- Report generation
- Performance review
- System maintenance

### Security Measures
- Regular password changes
- Access review
- Audit trail monitoring
- Backup verification

---

**Note**: This guide should be used in conjunction with your organization's specific accounting policies and procedures. Always consult with your financial team or system administrator for organization-specific requirements.

Last Updated: [Current Date]
Version: 1.0.0