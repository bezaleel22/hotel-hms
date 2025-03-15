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
            <h2 style="margin: 10px 0 0 0; color: #666;">Booking Confirmation</h2>
        </div>

        <p style="margin-bottom: 20px;">Dear Guest,</p>

        <p style="margin-bottom: 20px;">Thank you for choosing <?php echo $settings['title']; ?>. Your booking has been confirmed successfully.</p>

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
                <span style="font-weight: bold; color: #666; margin-right: 10px; min-width: 150px; display: inline-block;">Check-in:</span>
                <span><?php echo $booking['formatted_checkin']; ?> (<?php echo date('H:i', strtotime($settings['checkin_time'])); ?>)</span>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                <span style="font-weight: bold; color: #666; margin-right: 10px; min-width: 150px; display: inline-block;">Check-out:</span>
                <span><?php echo $booking['formatted_checkout']; ?> (<?php echo date('H:i', strtotime($settings['checkout_time'])); ?>)</span>
            </div>

            <!-- Room Rate Details -->
            <div style="background: #fff; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <h3 style="margin: 0 0 15px 0; color: #333;">Room Rate Details</h3>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #666;">Base Rate per Night:</span>
                    <span><?php echo $this->setting_model->format_amount($booking['rent_details']['base_rate']); ?></span>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #666;">Number of Nights:</span>
                    <span><?php echo $booking['rent_details']['nights']; ?></span>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #666;">Base Amount:</span>
                    <span><?php echo $this->setting_model->format_amount($booking['rent_details']['base_amount']); ?></span>
                </div>

                <!-- Tax Breakdown -->
                <div style="margin: 15px 0; padding-top: 15px; border-top: 1px dashed #eee;">
                    <h4 style="margin: 0 0 10px 0; color: #666;">Applicable Taxes:</h4>
                    <?php foreach ($booking['rent_details']['tax_breakdown'] as $tax): ?>
                        <div style="margin-bottom: 5px; font-size: 14px;">
                            <span style="color: #666;"><?php echo $tax['name']; ?> (<?php echo $tax['rate']; ?>%):</span>
                            <span style="float: right;"><?php echo $this->setting_model->format_amount($tax['amount']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div style="font-size: 20px; color: #28a745; margin: 20px 0; padding: 15px; background: #fff; border-radius: 5px; border: 1px solid #28a745;">
                <span style="font-weight: bold; color: #666; margin-right: 10px;">Total Room Rent:</span>
                <span><?php echo $this->setting_model->format_amount($booking['rent_details']['total_room_rent']); ?></span>
            </div>
        </div>

        <p style="margin-bottom: 10px;"><strong>Important Information:</strong></p>
        <ul style="padding-left: 20px; margin-bottom: 20px;">
            <li style="margin-bottom: 10px; color: #666;">Check-in time: <?php echo date('g:i A', strtotime($settings['checkin_time'])); ?></li>
            <li style="margin-bottom: 10px; color: #666;">Check-out time: <?php echo date('g:i A', strtotime($settings['checkout_time'])); ?></li>
            <li style="margin-bottom: 10px; color: #666;">Please present a valid ID and the credit card used for booking during check-in</li>
        </ul>

        <p style="margin-bottom: 20px;">If you need to modify or cancel your reservation, please contact us at least 24 hours before your check-in date.</p>

        <p style="margin-bottom: 30px;">We look forward to welcoming you!</p>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666; font-size: 12px;">
            <p style="margin: 5px 0;"><?php echo $settings['title']; ?></p>
            <p style="margin: 5px 0;"><?php echo $settings['address']; ?></p>
            <p style="margin: 5px 0;">Phone: <?php echo $settings['phone']; ?> | Email: <?php echo $settings['email']; ?></p>
            <?php if ($settings['powerbytxt']): ?>
                <p style="margin-top: 15px; font-style: italic; color: #999;"><?php echo $settings['powerbytxt']; ?></p>
            <?php endif; ?>
            <?php if ($settings['footer_text']): ?>
                <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #eee;"><?php echo $settings['footer_text']; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>