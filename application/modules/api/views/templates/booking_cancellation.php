<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; background: #fff;">
        <div style="text-align: center; padding: 20px 0; background: #f8f9fa; border-radius: 5px; margin-bottom: 20px;">
            <?php if (!empty($settings['logo'])): ?>
                <img src="<?php echo base_url('assets/uploads/' . $settings['logo']); ?>" 
                     alt="<?php echo $settings['title']; ?>" 
                     style="max-height: 60px; margin-bottom: 15px;">
            <?php endif; ?>
            <h1 style="margin: 0; color: #333;"><?php echo $settings['title']; ?></h1>
            <h2 style="margin: 10px 0 0 0; color: #666;">Booking Cancellation</h2>
        </div>

        <div style="background: #dc3545; color: white; padding: 20px; border-radius: 5px; margin: 20px 0; text-align: center;">
            <h2 style="margin: 0 0 10px 0; font-size: 24px;">Booking Cancelled</h2>
            <p style="margin: 0;">Your booking has been cancelled as requested.</p>
        </div>

        <p style="margin-bottom: 20px;">Dear Guest,</p>
        
        <p style="margin-bottom: 20px;">As per your request, we have cancelled your booking with the following details:</p>

        <div style="margin: 20px 0; padding: 20px; background: #f8f9fa; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                <span style="font-weight: bold; color: #666; margin-right: 10px; min-width: 150px; display: inline-block;">Booking Reference:</span>
                <span><?php echo $booking['booking_number']; ?></span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                <span style="font-weight: bold; color: #666; margin-right: 10px; min-width: 150px; display: inline-block;">Room Type:</span>
                <span><?php echo $booking['roomtype']; ?></span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                <span style="font-weight: bold; color: #666; margin-right: 10px; min-width: 150px; display: inline-block;">Original Check-in:</span>
                <span><?php echo $booking['formatted_checkin']; ?></span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                <span style="font-weight: bold; color: #666; margin-right: 10px; min-width: 150px; display: inline-block;">Original Check-out:</span>
                <span><?php echo $booking['formatted_checkout']; ?></span>
            </div>

            <!-- Cancelled Room Rate Details -->
            <div style="background: #fff; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <h3 style="margin: 0 0 15px 0; color: #333;">Cancelled Room Rate Details</h3>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #666;">Base Rate per Night:</span>
                    <span style="text-decoration: line-through;"><?php echo $this->setting_model->format_amount($booking['rent_details']['base_rate']); ?></span>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #666;">Number of Nights:</span>
                    <span style="text-decoration: line-through;"><?php echo $booking['rent_details']['nights']; ?></span>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #666;">Base Amount:</span>
                    <span style="text-decoration: line-through;"><?php echo $this->setting_model->format_amount($booking['rent_details']['base_amount']); ?></span>
                </div>

                <!-- Tax Breakdown -->
                <div style="margin: 15px 0; padding-top: 15px; border-top: 1px dashed #eee;">
                    <h4 style="margin: 0 0 10px 0; color: #666;">Cancelled Tax Details:</h4>
                    <?php foreach ($booking['rent_details']['tax_breakdown'] as $tax): ?>
                    <div style="margin-bottom: 5px; font-size: 14px;">
                        <span style="color: #666;"><?php echo $tax['name']; ?> (<?php echo $tax['rate']; ?>%):</span>
                        <span style="float: right; text-decoration: line-through;"><?php echo $this->setting_model->format_amount($tax['amount']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div style="font-size: 20px; color: #dc3545; margin: 20px 0; padding: 15px; background: #fff; border-radius: 5px; border: 1px solid #dc3545;">
                <span style="font-weight: bold; color: #666; margin-right: 10px;">Cancelled Total Room Rent:</span>
                <span style="text-decoration: line-through;"><?php echo $this->setting_model->format_amount($booking['rent_details']['total_room_rent']); ?></span>
            </div>
        </div>

        <?php if(isset($booking['refund_amount'])): ?>
        <div style="background: #fff3cd; border: 1px solid #ffeeba; color: #856404; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #856404;">Refund Information</h3>
            <p style="margin-bottom: 10px;">
                <span style="font-weight: bold; margin-right: 10px;">Refund Amount:</span>
                <span><?php echo $booking['refund_amount']; ?></span>
            </p>
            <p style="font-size: 14px; margin: 10px 0; color: #666;">Your refund will be processed within 5-7 business days to your original payment method.</p>
        </div>
        <?php endif; ?>

        <div style="background: #e9ecef; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #495057;">Book Again</h3>
            <p style="margin-bottom: 15px;">We would be delighted to welcome you on another occasion. You can make a new booking:</p>
            <ul style="margin: 15px 0; padding-left: 20px;">
                <li style="margin-bottom: 10px;">By phone: <?php echo $settings['phone']; ?></li>
                <li style="margin-bottom: 10px;">By email: <?php echo $settings['email']; ?></li>
                <li style="margin-bottom: 10px;">Through our website: 
                    <a href="<?php echo base_url(); ?>" style="color: #007bff; text-decoration: none;">
                        <?php echo $settings['title']; ?>
                    </a>
                </li>
            </ul>
        </div>

        <p style="margin-bottom: 20px;">If you have any questions about your cancellation or would like assistance with a new booking, please don't hesitate to contact us.</p>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666; font-size: 12px;">
            <p style="margin: 5px 0;"><?php echo $settings['title']; ?></p>
            <p style="margin: 5px 0;"><?php echo $settings['address']; ?></p>
            <p style="margin: 5px 0;">Phone: <?php echo $settings['phone']; ?> | Email: <?php echo $settings['email']; ?></p>
            <?php if($settings['powerbytxt']): ?>
                <p style="margin-top: 15px; font-style: italic; color: #999;"><?php echo $settings['powerbytxt']; ?></p>
            <?php endif; ?>
            <?php if($settings['footer_text']): ?>
                <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #eee;"><?php echo $settings['footer_text']; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>