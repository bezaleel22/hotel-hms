<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* Hotel theme colors */
        :root {
            --primary: #1a4568;      /* Deep navy blue */
            --secondary: #c8a97e;     /* Golden brown */
            --background: #f4f6f8;    /* Light gray blue */
            --text: #2c3e50;         /* Dark blue gray */
            --accent: #e8f0f8;       /* Light blue */
            --success: #2d8761;      /* Forest green */
            --border: #dde2e8;       /* Light gray */
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #2c3e50; margin: 0; padding: 20px; background-color: #f4f6f8;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; padding: 25px; background: #1a4568; border-radius: 8px 8px 0 0; margin: -20px -20px 20px;">
            <?php if (!empty($settings['logo'])): ?>
                <img src="<?php echo base_url('assets/uploads/' . $settings['logo']); ?>"
                    alt="<?php echo $settings['title']; ?>"
                    style="max-height: 60px; margin-bottom: 15px;">
            <?php endif; ?>
            <h1 style="margin: 0; color: #fff; font-size: 24px;"><?php echo $settings['title']; ?></h1>
            <h2 style="margin: 10px 0 0 0; color: #c8a97e; font-size: 20px;">Payment & Booking Confirmation</h2>
        </div>

        <p style="margin-bottom: 20px; color: #2c3e50;">Dear <?php echo $booking['firstname']; ?>,</p>

        <p style="margin-bottom: 20px; color: #2c3e50;">Thank you for choosing <?php echo $settings['title']; ?>. We are pleased to confirm that your payment has been received and your booking has been confirmed successfully.</p>

        <div style="margin: 20px 0; padding: 20px; background: #f4f6f8; border-radius: 8px; border: 1px solid #dde2e8;">
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #dde2e8;">
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px; min-width: 150px; display: inline-block;">Booking Reference:</span>
                <span style="color: #2c3e50;"><?php echo $booking['booking_number']; ?></span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #dde2e8;">
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px; min-width: 150px; display: inline-block;">Room Type:</span>
                <span style="color: #2c3e50;"><?php echo $booking['roomtype']; ?></span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #dde2e8;">
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px; min-width: 150px; display: inline-block;">Check-in:</span>
                <span style="color: #2c3e50;"><?php echo $booking['formatted_checkin']; ?> (<?php echo date('H:i', strtotime($settings['checkin_time'])); ?>)</span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #dde2e8;">
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px; min-width: 150px; display: inline-block;">Check-out:</span>
                <span style="color: #2c3e50;"><?php echo $booking['formatted_checkout']; ?> (<?php echo date('H:i', strtotime($settings['checkout_time'])); ?>)</span>
            </div>

            <!-- Payment & Room Details -->
            <div style="background: #fff; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #dde2e8;">
                <h3 style="margin: 0 0 15px 0; color: #1a4568;">Booking Details</h3>
                
                <!-- Room Details -->
                <div style="margin-bottom: 20px;">
                    <h4 style="margin: 0 0 10px 0; color: #1a4568;">Room Information</h4>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Room Number:</span>
                        <span style="color: #2c3e50;"><?php echo $booking['room_no']; ?></span>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Room Type:</span>
                        <span style="color: #2c3e50;"><?php echo $booking['roomtype']; ?></span>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Number of Nights:</span>
                        <span style="color: #2c3e50;"><?php echo ceil((strtotime($booking['check_out']) - strtotime($booking['check_in'])) / (60 * 60 * 24)); ?></span>
                    </div>
                </div>

                <!-- Payment Details -->
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px dashed #dde2e8;">
                    <h4 style="margin: 0 0 10px 0; color: #2d8761;">Payment Confirmation</h4>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Payment Status:</span>
                        <span style="color: #2d8761;">Confirmed</span>
                    </div>
                    <?php if (!empty($booking['payment']['invoice_path'])): ?>
                    <div style="margin-bottom: 10px;">
                        <p style="color: #2c3e50;">Your invoice has been attached to this email for your records.</p>
                    </div>
                    <?php endif; ?>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Transaction Reference:</span>
                        <span style="color: #2c3e50;"><?php echo $booking['payment']['reference']; ?></span>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Payment Date:</span>
                        <span style="color: #2c3e50;"><?php echo date('d M Y H:i', strtotime($booking['payment']['transaction_date'])); ?></span>
                    </div>
                </div>

                <!-- Total Amount -->
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px dashed #dde2e8;">
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Amount Paid:</span>
                        <span style="color: #2c3e50;"><?php echo $settings['currency_symbol']; ?><?php echo number_format($booking['total_price'], $settings['precision'], '.', ','); ?></span>
                    </div>
                    <?php if (!empty($booking['payment']['currency'])): ?>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold; color: #1a4568;">Currency:</span>
                        <span style="color: #2c3e50;"><?php echo strtoupper($booking['payment']['currency']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div style="font-size: 20px; margin: 20px 0; padding: 20px; background: #fff; border-radius: 8px; border: 2px solid #c8a97e;">
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px;">Total Room Rent:</span>
                <span style="color: #2d8761;"><?php echo $settings['currency_symbol']; ?><?php echo number_format($booking['rent_details']['total_room_rent'], $settings['precision'], '.', ','); ?></span>
            </div>
        </div>

        <div style="background: #e8f0f8; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p style="margin-bottom: 10px; color: #1a4568; font-weight: bold;">Important Information:</p>
            <ul style="padding-left: 20px; margin-bottom: 20px;">
                <li style="margin-bottom: 10px; color: #2c3e50;">Check-in time: <?php echo date('g:i A', strtotime($settings['checkin_time'])); ?></li>
                <li style="margin-bottom: 10px; color: #2c3e50;">Check-out time: <?php echo date('g:i A', strtotime($settings['checkout_time'])); ?></li>
                <li style="margin-bottom: 10px; color: #2c3e50;">Please present a valid ID and the credit card used for booking during check-in</li>
            </ul>
        </div>

        <p style="margin-bottom: 20px; color: #2c3e50;">If you need to modify or cancel your reservation, please contact us at least 24 hours before your check-in date.</p>

        <p style="margin-bottom: 30px; color: #2c3e50;">We look forward to welcoming you!</p>

        <div style="margin-top: 30px; padding: 20px; border-top: 1px solid #dde2e8; text-align: center; background: #1a4568; color: #fff; border-radius: 0 0 8px 8px; margin: 0 -20px -20px;">
            <p style="margin: 5px 0;"><?php echo $settings['title']; ?></p>
            <p style="margin: 5px 0;"><?php echo $settings['address']; ?></p>
            <p style="margin: 5px 0;">Phone: <?php echo $settings['phone']; ?> | Email: <?php echo $settings['email']; ?></p>
            <?php if ($settings['powerbytxt']): ?>
                <p style="margin-top: 15px; font-style: italic; color: #c8a97e;"><?php echo $settings['powerbytxt']; ?></p>
            <?php endif; ?>
            <?php if ($settings['footer_text']): ?>
                <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.1);"><?php echo $settings['footer_text']; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>