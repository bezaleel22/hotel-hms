# API Implementation Plan

## Architecture Overview

The API module follows a modular architecture with clear separation of concerns:

### Core Components

1. Controllers

   - Handle HTTP requests and responses
   - Input validation and sanitization
   - Authentication and authorization checks
   - Business logic coordination

2. Models

   - Database operations
   - Business logic implementation
   - Data validation and formatting

3. Libraries
   - api_handler: Standardized response handling
   - jwt_handler: JWT token management
   - email_handler: Centralized email operations

### Authentication Model

#### Protected Controllers (Require Authentication)

1. **Booking Controller**

   - Full authentication required
   - JWT token validation
   - Role-based access control
   - Booking ownership verification
   - Endpoints:
     - POST /api/v1/booking/create
     - GET /api/v1/booking/details/{id}
     - PUT /api/v1/booking/update/{id}
     - DELETE /api/v1/booking/cancel/{id}

2. **Customer Controller**

   - Selective authentication
   - Public endpoints: signup, login, forgot_password
   - Protected endpoints: details, update, bookings, change_password
   - Endpoints:
     - POST /api/v1/customer/signup
     - POST /api/v1/customer/login
     - GET /api/v1/customer/details/{id}
     - PUT /api/v1/customer/update/{id}
     - GET /api/v1/customer/bookings/{id}

3. **Payment Controller**

   - Full authentication required
   - Payment verification
   - Booking ownership validation
   - Endpoints:
     - POST /api/v1/payment/process
     - GET /api/v1/payment/verify/{booking_id}
     - GET /api/v1/payment/methods

4. **Promocode Controller**
   - Full authentication required
   - Usage tracking per customer
   - Rate limiting
   - Endpoints:
     - POST /api/v1/promocode/validate
     - GET /api/v1/promocode/list
     - GET /api/v1/promocode/history

#### Public Controllers

1. **Content Controller**

   - Public access
   - Content delivery
   - Endpoints:
     - GET /api/v1/content/home
     - GET /api/v1/content/about
     - GET /api/v1/content/gallery
     - GET /api/v1/content/page/{id}

2. **Config Controller**

   - Public settings
   - Sensitive data filtering
   - Endpoints:
     - GET /api/v1/config/settings
     - GET /api/v1/config/languages
     - GET /api/v1/config/currency

3. **Room Controller**

   - Public room listings
   - Availability checking
   - Endpoints:
     - GET /api/v1/rooms
     - GET /api/v1/room/details/{id}
     - GET /api/v1/room/availability

4. **Welcome Controller**
   - API documentation
   - Health check
   - Endpoints:
     - GET /api/v1/welcome

### Email System

1. **Email Handler Library**

   - Centralized email management
   - Configuration priority:
     1. Database email_config table
     2. Environment variables
     3. MailHog for development

2. **Email Templates**

   - booking_confirmation.php
   - booking_cancellation.php
   - contact_form.php
   - newsletter_subscription.php
   - password_reset.php
   - password_changed.php

3. **Email Permissions**
   - Configurable via tbl_email_permission table
   - Permission types:
     - booking
     - contact_form
     - password_reset
     - newsletter

### Security Measures

1. **Authentication**

   - JWT-based token system
   - Token expiration and refresh
   - Role-based access control

2. **Input Validation**

   - Request payload validation
   - Parameter sanitization
   - Type checking and formatting

3. **Error Handling**

   - Standardized error responses
   - Detailed logging
   - Development vs production errors

4. **Rate Limiting**
   - API request throttling
   - Promocode usage limits
   - Concurrent booking limits

### Testing

1. **Unit Tests**

   - Controller tests
   - Model tests
   - Library tests

2. **Integration Tests**

   - API endpoint tests
   - Authentication flow tests
   - Email system tests

3. **Test Environment**
   - Separate test database
   - MailHog for email testing
   - Mock payment gateway

### Documentation

1. **API Documentation**

   - Swagger/OpenAPI specification
   - Endpoint descriptions
   - Request/response examples

2. **Internal Documentation**

   - Implementation details
   - Security considerations
   - Configuration guide

3. **Developer Guide**
   - Setup instructions
   - Testing procedures
   - Contribution guidelines

### Deployment

1. **Environment Setup**

   - Production configuration
   - Environment variables
   - SSL/TLS setup

2. **Database Migration**

   - Schema updates
   - Data migration
   - Backup procedures

3. **Monitoring**
   - Error logging
   - Performance metrics
   - Security auditing
