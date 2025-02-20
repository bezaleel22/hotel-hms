# E-Menu Module Development Plan

## 1. Overview

The e-menu module will provide a modern web-based menu interface for hotel guests, integrating with the existing order management system. The module will be developed following HMS addon guidelines and will support QR code-based authentication.

## 2. Database Schema

### New Tables

```sql
CREATE TABLE IF NOT EXISTS `tbl_emenu_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `emenu_qr_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`table_id`) REFERENCES `rest_table` (`tableid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `emenu_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`table_id`) REFERENCES `rest_table` (`tableid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

## 3. Module Structure

```
application/modules/emenu/
├── assets/
│   ├── css/
│   │   ├── style.css
│   │   └── menu.css
│   ├── js/
│   │   ├── script.js
│   │   └── menu.js
│   ├── images/
│   │   └── thumbnail.jpg
│   └── data/
│       ├── database.sql
│       ├── install.sql
│       └── uninstall.sql
├── config/
│   ├── config.php
│   └── menu.php
├── controllers/
│   ├── Emenu.php
│   └── Api.php
├── models/
│   ├── Emenu_model.php
│   └── Qr_model.php
└── views/
    ├── admin/
    │   ├── dashboard.php
    │   ├── qr_management.php
    │   └── settings.php
    └── menu/
        ├── index.php
        ├── category.php
        ├── items.php
        └── cart.php
```

## 4. Key Features

### Frontend (Customer-facing)

1. Modern, responsive menu interface
   - Category-based navigation
   - Search functionality
   - Item filtering and sorting
   - Beautiful food imagery display

2. Smart Cart Management
   - Real-time cart updates using HTMX
   - Modifier/addon selection
   - Special instructions
   - Order review

3. Order Management
   - Real-time order status tracking
   - Order history
   - Reorder functionality
   - Split bill support

### Backend (Admin)

1. QR Code Management
   - Generate/regenerate QR codes for tables
   - Bulk QR code operations
   - QR code access control

2. Menu Management
   - Category organization
   - Item availability control
   - Special/seasonal menu items
   - Dynamic pricing

3. Analytics Dashboard
   - Order statistics
   - Popular items
   - Peak hours analysis
   - Revenue reports

## 5. API Endpoints

### Customer APIs

```
GET /api/emenu/menu
GET /api/emenu/categories
GET /api/emenu/items/:category_id
GET /api/emenu/item/:id
POST /api/emenu/cart/add
POST /api/emenu/order/create
GET /api/emenu/order/:id/status
```

### Admin APIs

```
POST /api/emenu/qr/generate
PUT /api/emenu/qr/regenerate/:id
GET /api/emenu/tables/status
GET /api/emenu/analytics/orders
GET /api/emenu/analytics/items
```

## 6. Integration Points

1. Order Management
   - Integrate with existing order_menu table
   - Use current order workflow
   - Maintain kitchen notification system

2. Table Management
   - Link with rest_table system
   - Maintain table status sync
   - Handle table merging scenarios

3. Payment Processing
   - Integrate with existing payment methods
   - Support split payments
   - Handle bill settlements

## 7. Security

1. QR Code Authentication
   - Time-based token generation
   - Secure session management
   - Rate limiting

2. API Security
   - JWT authentication
   - Request validation
   - CORS policy

3. Data Protection
   - Input sanitization
   - XSS prevention
   - SQL injection protection

## 8. Performance Optimization

1. Frontend
   - Progressive image loading
   - Cart state management
   - Code splitting

2. Backend
   - Query optimization
   - Response caching
   - Asset minification

## 9. Testing Plan

1. Unit Testing
   - API endpoints
   - Model methods
   - Utility functions

2. Integration Testing
   - Order flow
   - Payment processing
   - QR authentication

3. UI/UX Testing
   - Responsive design
   - Cross-browser compatibility
   - Load testing

## 10. Deployment Steps

1. Database Updates
   - Run database.sql
   - Execute install.sql
   - Configure initial settings

2. Module Installation
   - Upload module files
   - Register module in HMS
   - Set permissions

3. Configuration
   - Set API endpoints
   - Configure QR settings
   - Set up payment integration

## 11. Documentation

1. User Guide
   - Customer usage instructions
   - QR code scanning process
   - Order placement guide

2. Admin Guide
   - QR management
   - Menu configuration
   - Analytics interpretation

3. API Documentation
   - Endpoint descriptions
   - Request/response formats
   - Authentication details