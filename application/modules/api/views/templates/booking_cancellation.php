<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Cancellation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #2c3e50; margin: 0; padding: 20px; background-color: #f4f6f8;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; padding: 25px; background: #1a4568; border-radius: 8px 8px 0 0; margin: -20px -20px 20px;">
            <?php if (!empty($settings['logo'])): ?>
                <img src="<?php echo base_url('assets/uploads/' . $settings['logo']); ?>" 
                     alt="<?php echo $settings['title']; ?>" 
                     style="max-height: 60px; margin-bottom: 15px;">
            <?php endif; ?>
            <h1 style="margin: 0; color: #fff;"><?php echo $settings['title']; ?></h1>
            <h2 style="margin: 10px 0 0 0; color: #c8a97e;">Booking Cancellation</h2>
        </div>

        <div style="background: #fdf1f1; border: 2px solid #dc3545; color: #dc3545; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center;">
            <h2 style="margin: 0 0 10px 0; font-size: 24px;">Booking Cancelled</h2>
            <p style="margin: 0;">Your booking has been cancelled as requested.</p>
        </div>

        <p style="margin-bottom: 20px; color: #2c3e50;">Dear Guest,</p>
        
        <p style="margin-bottom: 20px; color: #2c3e50;">As per your request, we have cancelled your booking with the following details:</p>

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
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px; min-width: 150px; display: inline-block;">Original Check-in:</span>
                <span style="color: #2c3e50;"><?php echo $booking['formatted_checkin']; ?></span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #dde2e8;">
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px; min-width: 150px; display: inline-block;">Original Check-out:</span>
                <span style="color: #2c3e50;"><?php echo $booking['formatted_checkout']; ?></span>
            </div>

            <!-- Cancelled Room Rate Details -->
            <div style="background: #fff; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #dde2e8;">
                <h3 style="margin: 0 0 15px 0; color: #1a4568;">Cancelled Room Rate Details</h3>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #1a4568;">Base Rate per Night:</span>
                    <span style="text-decoration: line-through; color: #2c3e50;"><?php echo $this->setting_model->format_amount($booking['rent_details']['base_rate']); ?></span>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #1a4568;">Number of Nights:</span>
                    <span style="text-decoration: line-through; color: #2c3e50;"><?php echo $booking['rent_details']['nights']; ?></span>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #1a4568;">Base Amount:</span>
                    <span style="text-decoration: line-through; color: #2c3e50;"><?php echo $this->setting_model->format_amount($booking['rent_details']['base_amount']); ?></span>
                </div>

                <!-- Tax Breakdown -->
                <div style="margin: 15px 0; padding-top: 15px; border-top: 1px dashed #dde2e8;">
                    <h4 style="margin: 0 0 10px 0; color: #1a4568;">Cancelled Tax Details:</h4>
                    <?php foreach ($booking['rent_details']['tax_breakdown'] as $tax): ?>
                    <div style="margin-bottom: 5px; font-size: 14px;">
                        <span style="color: #1a4568;"><?php echo $tax['name']; ?> (<?php echo $tax['rate']; ?>%):</span>
                        <span style="float: right; text-decoration: line-through; color: #2c3e50;"><?php echo $this->setting_model->format_amount($tax['amount']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div style="font-size: 20px; margin: 20px 0; padding: 20px; background: #fdf1f1; border-radius: 8px; border: 2px solid #dc3545;">
                <span style="font-weight: bold; color: #1a4568; margin-right: 10px;">Cancelled Total Room Rent:</span>
                <span style="text-decoration: line-through; color: #dc3545;"><?php echo $this->setting_model->format_amount($booking['rent_details']['total_room_rent']); ?></span>
            </div>
        </div>

        <?php if(isset($booking['refund_amount'])): ?>
        <div style="background: #fff3cd; border: 1px solid #c8a97e; color: #856404; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #856404;">Refund Information</h3>
            <p style="margin-bottom: 10px;">
                <span style="font-weight: bold; margin-right: 10px;">Refund Amount:</span>
                <span><?php echo $booking['refund_amount']; ?></span>
            </p>
            <p style="font-size: 14px; margin: 10px 0; color: #2c3e50;">Your refund will be processed within 5-7 business days to your original payment method.</p>
        </div>
        <?php endif; ?>

        <div style="background: #e8f0f8; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #1a4568;">Book Again</h3>
            <p style="margin-bottom: 15px; color: #2c3e50;">We would be delighted to welcome you on another occasion. You can make a new booking:</p>
            <ul style="margin: 15px 0; padding-left: 20px; color: #2c3e50;">
                <li style="margin-bottom: 10px;">By phone: <?php echo $settings['phone']; ?></li>
                <li style="margin-bottom: 10px;">By email: <?php echo $settings['email']; ?></li>
                <li style="margin-bottom: 10px;">Through our website: 
                    <a href="<?php echo base_url(); ?>" style="color: #1a4568; text-decoration: none;">
                        <?php echo $settings['title']; ?>
                    </a>
                </li>
            </ul>
        </div>

        <p style="margin-bottom: 20px; color: #2c3e50;">If you have any questions about your cancellation or would like assistance with a new booking, please don't hesitate to contact us.</p>

        <div style="margin-top: 30px; padding: 20px; border-top: 1px solid #dde2e8; text-align: center; background: #1a4568; color: #fff; border-radius: 0 0 8px 8px; margin: 30px -20px -20px;">
            <p style="margin: 5px 0;"><?php echo $settings['title']; ?></p>
            <p style="margin: 5px 0;"><?php echo $settings['address']; ?></p>
            <p style="margin: 5px 0;">Phone: <?php echo $settings['phone']; ?> | Email: <?php echo $settings['email']; ?></p>
            <?php if($settings['powerbytxt']): ?>
                <p style="margin-top: 15px; font-style: italic; color: #c8a97e;"><?php echo $settings['powerbytxt']; ?></p>
            <?php endif; ?>
            <?php if($settings['footer_text']): ?>
                <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.1);"><?php echo $settings['footer_text']; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>