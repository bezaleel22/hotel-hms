# Reports Module Documentation

## Overview
The Reports Module in the Hotel Management System provides comprehensive reporting capabilities for bookings, purchases, stock management, and guest registration. This documentation explains how to access and use various reporting features.

## Accessing Reports
Navigate to the Reports section from the dashboard using the sidebar menu. The reports icon is represented by a bar chart (`<i class='ti-bar-chart'></i>`).

## Available Reports

### 1. Booking Reports
**Path:** `reports/booking-report`

Features:
- Filter bookings by:
  * Customer
  * Booking status
  * Payment status
  * Date range (check-in/check-out)
- View detailed information including:
  * Room types and numbers
  * Guest information
  * Payment details
  * Stay duration
  * Additional charges

#### How to Generate a Booking Report:
1. Go to Reports → Booking Report
2. Use the filter form to set your criteria:
   - Select specific customer (optional)
   - Choose booking status
   - Select payment status
   - Set date range
3. Click "Filter" to generate the report
4. Use the print button to get a physical copy

### 2. Guest Registration Card
**Path:** `reports/customer-reciept/{booking_id}`

This report is particularly useful for security agencies and contains:
- Guest personal information:
  * Full name
  * Date of Birth
  * National ID/Passport number
  * Nationality
  * Contact details
- Stay details:
  * Check-in/out dates and times
  * Room number and rate
  * Purpose of visit (Tourist/Business/Official)
- Verification:
  * Guest signature
  * Front desk signature

#### How to Generate a Guest Registration Card:
1. Go to Reports → Booking Report
2. Find the specific booking
3. Click on "View Details"
4. Select "Guest Registration Card"
5. Print the card using the print button

### 3. Purchase Reports
**Path:** `reports/purchase-report`

Features:
- Track all purchase transactions
- Filter by date range
- View supplier information
- Monitor purchase costs
- Track inventory additions

#### How to Generate a Purchase Report:
1. Go to Reports → Purchase Report
2. Set the date range
3. Click "Filter" to generate the report
4. Use print functionality if needed

### 4. Stock Reports
**Path:** `reports/stock-report`

Features:
- Current inventory levels
- Product details
- Unit measurements
- Total quantities
- Cost information

#### How to Generate a Stock Report:
1. Go to Reports → Stock Report
2. View current stock levels
3. Print report if needed

## Printing Reports
All reports include a print button (typically represented by a printer icon). Click this button to:
- Generate a printer-friendly version
- Send directly to your default printer
- Save as PDF (through browser print dialog)

## Report Permissions
Access to reports requires appropriate permissions:
- Basic viewing: 'read' permission
- Detailed reports may require additional permissions
- Contact your system administrator if you need access

## Tips for Effective Report Use
1. Use date filters judiciously to manage report size
2. Export important reports to PDF for record-keeping
3. Use the guest registration card for official documentation
4. Regular stock reports help maintain optimal inventory
5. Keep printed copies of important guest records

## Technical Support
For technical issues or questions about reports:
1. Check this documentation first
2. Contact your system administrator
3. Submit a support ticket if needed

## Report Security
- All reports contain sensitive information
- Keep printed reports secure
- Log out when leaving the system
- Don't share report access credentials