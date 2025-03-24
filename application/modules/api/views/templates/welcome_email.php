<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Our Hotel</title>
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
            <h2 style="margin: 10px 0 0 0; color: #c8a97e;">Welcome to Our Hotel</h2>
        </div>

        <div style="padding: 0 20px;">
            <p style="margin-bottom: 20px; color: #2c3e50; font-size: 16px;">Dear <?php echo $customer['firstname'] . ' ' . $customer['lastname']; ?>,</p>
            
            <p style="margin-bottom: 25px; color: #2c3e50;">Thank you for creating an account with <?php echo $settings['title']; ?>. We're excited to have you join our community of distinguished guests!</p>

            <div style="background: #e8f0f8; padding: 20px; border-radius: 8px; margin-bottom: 25px; text-align: center;">
                <p style="margin: 0 0 15px 0; color: #1a4568; font-weight: bold;">Please verify your email address to complete your registration:</p>
                
                <a href="<?php echo $verification_link; ?>" 
                   style="display: inline-block; background: #c8a97e; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                    Verify Email Address
                </a>
            </div>

            <div style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #dde2e8; margin-bottom: 25px;">
                <h3 style="margin: 0 0 15px 0; color: #1a4568;">Your Exclusive Member Benefits</h3>
                <div style="display: grid; gap: 15px;">
                    <div style="padding: 15px; background: #f4f6f8; border-radius: 4px;">
                        <strong style="color: #1a4568;">Easy Booking Management</strong>
                        <p style="margin: 5px 0 0 0; color: #2c3e50;">View and manage your reservations anytime</p>
                    </div>
                    <div style="padding: 15px; background: #f4f6f8; border-radius: 4px;">
                        <strong style="color: #1a4568;">Exclusive Offers</strong>
                        <p style="margin: 5px 0 0 0; color: #2c3e50;">Access to member-only rates and promotions</p>
                    </div>
                    <div style="padding: 15px; background: #f4f6f8; border-radius: 4px;">
                        <strong style="color: #1a4568;">Quick Check-in</strong>
                        <p style="margin: 5px 0 0 0; color: #2c3e50;">Expedited check-in process for members</p>
                    </div>
                    <div style="padding: 15px; background: #f4f6f8; border-radius: 4px;">
                        <strong style="color: #1a4568;">Special Rates</strong>
                        <p style="margin: 5px 0 0 0; color: #2c3e50;">Enjoy preferred pricing on your stays</p>
                    </div>
                </div>
            </div>

            <?php if (!empty($settings['social_links'])): ?>
            <div style="text-align: center; margin: 25px 0; padding: 20px; background: #f4f6f8; border-radius: 8px;">
                <p style="margin: 0 0 15px 0; color: #1a4568; font-weight: bold;">Stay Connected</p>
                <div style="display: flex; justify-content: center; gap: 20px;">
                    <?php foreach ($settings['social_links'] as $platform => $link): ?>
                        <a href="<?php echo $link; ?>" 
                           style="color: #1a4568; text-decoration: none; padding: 8px 15px; background: #fff; border-radius: 4px; border: 1px solid #dde2e8;">
                            <?php echo ucfirst($platform); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

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