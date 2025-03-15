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
            <h2 style="margin: 10px 0 0 0; color: #666;">Welcome to Our Hotel</h2>
        </div>

        <p style="margin-bottom: 20px;">Dear <?php echo $customer['firstname'] . ' ' . $customer['lastname']; ?>,</p>
        
        <p style="margin-bottom: 20px;">Thank you for creating an account with <?php echo $settings['title']; ?>. We're excited to have you join us!</p>

        <div style="margin: 20px 0; padding: 20px; background: #f8f9fa; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="margin-bottom: 20px;">Please verify your email address to complete your registration:</p>
            
            <div style="text-align: center;">
                <a href="<?php echo $verification_link; ?>" 
                   style="display: inline-block; padding: 12px 30px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    Verify Email Address
                </a>
            </div>
        </div>

        <div style="margin: 20px 0; padding: 20px; background: #f8f9fa; border-radius: 5px;">
            <p style="margin: 0 0 10px 0;"><strong>Your Account Benefits:</strong></p>
            <ul style="padding-left: 20px; margin: 0; color: #666;">
                <li style="margin-bottom: 10px;">Easy booking management</li>
                <li style="margin-bottom: 10px;">Access to exclusive offers</li>
                <li style="margin-bottom: 10px;">Quick check-in process</li>
                <li>Special member rates</li>
            </ul>
        </div>

        <?php if (!empty($settings['social_links'])): ?>
        <div style="margin: 20px 0; text-align: center;">
            <p style="margin-bottom: 10px; color: #666;">Follow us on social media:</p>
            <?php foreach ($settings['social_links'] as $platform => $link): ?>
                <a href="<?php echo $link; ?>" style="margin: 0 10px; text-decoration: none; color: #666;">
                    <?php echo ucfirst($platform); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

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