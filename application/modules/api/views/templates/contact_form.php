<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #2c3e50; margin: 0; padding: 20px; background-color: #f4f6f8;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; padding: 25px; background: #1a4568; border-radius: 8px 8px 0 0; margin: -20px -20px 20px;">
            <h2 style="margin: 0; color: #fff; font-size: 24px;">New Contact Form Submission</h2>
            <p style="margin: 10px 0 0; color: #c8a97e;">A new contact form submission has been received</p>
        </div>
        
        <div style="padding: 0 20px;">
            <div style="background: #f4f6f8; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                <div style="margin-bottom: 20px;">
                    <div style="font-weight: bold; color: #1a4568; text-transform: uppercase; font-size: 14px; margin-bottom: 5px;">Name:</div>
                    <div style="background: #fff; padding: 10px; border-radius: 4px; border: 1px solid #dde2e8; color: #2c3e50;">{name}</div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <div style="font-weight: bold; color: #1a4568; text-transform: uppercase; font-size: 14px; margin-bottom: 5px;">Email:</div>
                    <div style="background: #fff; padding: 10px; border-radius: 4px; border: 1px solid #dde2e8; color: #2c3e50;">{email}</div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <div style="font-weight: bold; color: #1a4568; text-transform: uppercase; font-size: 14px; margin-bottom: 5px;">Phone:</div>
                    <div style="background: #fff; padding: 10px; border-radius: 4px; border: 1px solid #dde2e8; color: #2c3e50;">{phone}</div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <div style="font-weight: bold; color: #1a4568; text-transform: uppercase; font-size: 14px; margin-bottom: 5px;">Message:</div>
                    <div style="background: #fff; padding: 15px; border-radius: 4px; border-left: 4px solid #c8a97e; color: #2c3e50;">{message}</div>
                </div>
            </div>

            <div style="margin-top: 20px; color: #2c3e50; font-size: 14px;">
                <p style="margin-bottom: 10px;">Submission Time: {created_at}</p>
                <p style="margin-bottom: 10px;">IP Address: {ip_address}</p>
            </div>
        </div>
        
        <div style="margin-top: 30px; padding: 20px; border-top: 1px solid #dde2e8; text-align: center; background: #1a4568; color: #fff; border-radius: 0 0 8px 8px; margin: 30px -20px -20px;">
            <p style="margin: 5px 0;">This is an automated message. Please do not reply to this email.</p>
            <p style="margin: 10px 0 0; color: #c8a97e;">Staff Portal - Contact Form Notifications</p>
        </div>
    </div>
</body>
</html>
