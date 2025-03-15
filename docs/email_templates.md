# Email Templates Documentation

## Overview
The system uses HTML email templates with inline styles for maximum compatibility across email clients. Templates follow a consistent naming convention and use system settings for branding and customization.

## Directory Structure
```
application/modules/api/views/templates/
└── booking_*.php   # All booking-related email templates
```

## Template Naming Convention
- Use lowercase with underscores
- Format: `{module}_{action}.php`
- Examples:
  - `booking_confirmation.php`
  - `booking_cancellation.php`

## Current Templates
1. Booking Confirmation (`booking_confirmation.php`)
   - Sent when a new booking is created
   - Includes booking details, room info, and payment details
   - Uses hotel branding from system settings

2. Booking Cancellation (`booking_cancellation.php`)
   - Sent when a booking is cancelled
   - Includes original booking details and refund information
   - Shows rebooking options and contact information

## Template Features
- Responsive design with inline styles
- No external CSS dependencies for maximum compatibility
- Dynamic branding from system settings
- Proper formatting for dates, times, and amounts
- VAT and service charge calculations
- Support for multiple languages through settings

## Available Variables

### Booking Information
```php
$booking = [
    'booking_number'      => 'BK202503001234',
    'roomtype'           => 'Executive Suite',
    'formatted_checkin'  => 'Monday, April 1, 2024',
    'formatted_checkout' => 'Friday, April 5, 2024',
    'formatted_total'    => '$500.00',
    'payment_method'     => 'Card',
    'advance_amount'     => '100.00',
    'refund_amount'      => '100.00'  // Only in cancellation
];
```

### System Settings
```php
$settings = [
    'title'            => 'Hotel Name',
    'logo'             => 'path/to/logo.png',
    'address'          => 'Hotel Address',
    'phone'            => '+1234567890',
    'email'            => 'contact@hotel.com',
    'vat'              => '7.5',
    'vattinno'         => 'VAT123456',
    'servicecharge'    => '10',
    'service_chargeType' => '1',  // 0=fixed, 1=percentage
    'checkin_time'     => '14:00',
    'checkout_time'    => '12:00',
    'powerbytxt'       => 'Powered by text',
    'footer_text'      => 'Custom footer'
];
```

## Implementation Example
```php
// In Booking_model.php
private function send_confirmation_email($booking_id, $email) {
    $booking = $this->get_booking($booking_id);
    $email_settings = $this->setting_model->get_email_settings();
    
    // Format data
    $booking['formatted_total'] = $this->setting_model->format_amount($booking['total_price']);
    $booking['formatted_checkin'] = $this->setting_model->format_date($booking['checkindate']);
    
    // Load and send template
    $message = $this->load->view('api/views/templates/booking_confirmation', [
        'booking' => $booking,
        'settings' => $email_settings
    ], TRUE);
    
    return $this->email->message($message)->send();
}
```

## Adding New Templates
1. Create template file in templates directory
2. Follow naming convention: `{module}_{action}.php`
3. Use inline styles only (no external CSS)
4. Use system settings for branding
5. Format dates and amounts using setting_model helpers
6. Include both plain text and HTML versions
7. Test with various email clients
8. Update this documentation