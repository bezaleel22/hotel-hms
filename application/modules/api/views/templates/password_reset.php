<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset Request</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #2c3e50; margin: 0; padding: 20px; background-color: #f4f6f8;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; padding: 25px; background: #1a4568; border-radius: 8px 8px 0 0; margin: -20px -20px 20px;">
            <h2 style="margin: 0; color: #fff; font-size: 24px;">Password Reset Request</h2>
            <p style="margin: 10px 0 0; color: #c8a97e;">Security Notification</p>
        </div>
        
        <div style="padding: 0 20px;">
            <p style="margin-bottom: 20px; color: #2c3e50; font-size: 16px;">Hello {firstname},</p>
            
            <div style="background: #e8f0f8; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                <p style="margin: 0 0 15px 0; color: #2c3e50;">We received a request to reset your password. For your security, please click the button below to set a new password:</p>
                
                <div style="text-align: center; margin: 25px 0;">
                    <a href="{reset_link}" 
                       style="display: inline-block; background: #c8a97e; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                        Reset Password
                    </a>
                </div>
                
                <p style="margin: 0; color: #1a4568; font-weight: bold;">Important Security Notice:</p>
                <ul style="margin: 10px 0 0; padding-left: 20px; color: #2c3e50;">
                    <li style="margin-bottom: 5px;">This link will expire in 1 hour</li>
                    <li style="margin-bottom: 5px;">Only use this link if you requested the password reset</li>
                    <li style="margin-bottom: 0;">Never share this link with anyone</li>
                </ul>
            </div>

            <div style="background: #fdf1f1; border: 1px solid #dc3545; color: #dc3545; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                <p style="margin: 0; font-size: 14px;">If you didn't request this password reset, please contact our security team immediately.</p>
            </div>
            
            <div style="font-size: 13px; color: #666; background: #f4f6f8; padding: 15px; border-radius: 4px; margin-top: 25px;">
                <p style="margin: 0 0 5px 0;">Request Details:</p>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>IP Address: {ip_address}</li>
                    <li>Time: {timestamp}</li>
                </ul>
            </div>
        </div>
        
        <div style="margin-top: 30px; padding: 20px; border-top: 1px solid #dde2e8; text-align: center; background: #1a4568; color: #fff; border-radius: 0 0 8px 8px; margin: 30px -20px -20px;">
            <p style="margin: 5px 0;">If you need assistance, please contact our support team</p>
            <p style="margin: 10px 0 0; color: #c8a97e;">Security is our top priority</p>
        </div>
    </div>
</body>
</html>