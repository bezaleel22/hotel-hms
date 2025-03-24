<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Newsletter Subscription Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #2c3e50; margin: 0; padding: 20px; background-color: #f4f6f8;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; padding: 25px; background: #1a4568; border-radius: 8px 8px 0 0; margin: -20px -20px 20px;">
            <h2 style="margin: 0; color: #fff; font-size: 24px;">Welcome to <?php echo $app_name; ?></h2>
            <p style="margin: 10px 0 0; color: #c8a97e;">Thank You for Subscribing!</p>
        </div>
        
        <div style="padding: 0 20px;">
            <div style="margin-bottom: 25px;">
                <p style="margin-bottom: 20px; color: #2c3e50; font-size: 16px;">Dear <?php echo !empty($firstname) ? $firstname : 'Subscriber'; ?>,</p>
                <p style="margin-bottom: 20px; color: #2c3e50;">Your subscription to our newsletter has been confirmed! We're excited to have you join our community.</p>
            </div>

            <div style="background: #e8f0f8; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                <h3 style="margin: 0 0 15px 0; color: #1a4568; font-size: 18px;">What You'll Receive</h3>
                <ul style="margin: 0; padding-left: 20px; color: #2c3e50;">
                    <li style="margin-bottom: 10px;">Latest hotel news and updates</li>
                    <li style="margin-bottom: 10px;">Exclusive offers and promotions</li>
                    <li style="margin-bottom: 10px;">Special seasonal deals</li>
                    <li style="margin-bottom: 10px;">Travel tips and inspiration</li>
                </ul>
            </div>

            <div style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #dde2e8; margin-bottom: 25px;">
                <h3 style="margin: 0 0 15px 0; color: #1a4568; font-size: 18px;">Subscription Details</h3>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #1a4568;">Email:</span>
                    <span style="color: #2c3e50;"><?php echo $email; ?></span>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; color: #1a4568;">Date:</span>
                    <span style="color: #2c3e50;"><?php echo $subscription_date; ?></span>
                </div>
            </div>

            <div style="background: #f4f6f8; border: 1px solid #dde2e8; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                <p style="margin: 0 0 15px 0; color: #1a4568; font-weight: bold;">Stay Connected</p>
                <p style="margin: 0; color: #2c3e50;">Your email will be used to send our newsletter and promotional content. You can unsubscribe at any time using the link in our emails.</p>
            </div>

            <div style="font-size: 13px; color: #666; background: #f4f6f8; padding: 15px; border-radius: 4px; margin-top: 25px;">
                <p style="margin: 0 0 10px 0;">Subscription confirmed from IP: <?php echo $ip_address; ?></p>
                <p style="margin: 0 0 10px 0;">Timestamp: <?php echo $timestamp; ?></p>
                <p style="margin: 0;">If you did not subscribe to this newsletter, please contact our support team at <?php echo $support_email; ?></p>
            </div>
        </div>

        <div style="margin-top: 30px; padding: 20px; border-top: 1px solid #dde2e8; text-align: center; background: #1a4568; color: #fff; border-radius: 0 0 8px 8px; margin: 30px -20px -20px;">
            <p style="margin: 5px 0;">© <?php echo date('Y'); ?> <?php echo $app_name; ?></p>
            <p style="margin: 10px 0 0; color: #c8a97e;">All rights reserved</p>
        </div>
    </div>
</body>
</html>