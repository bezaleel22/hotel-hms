<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
        }
        .content {
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
            font-size: 0.9em;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Password Reset Request</h2>
        </div>
        
        <div class="content">
            <p>Hello {firstname},</p>
            
            <p>We received a request to reset your password. Click the button below to set a new password:</p>
            
            <a href="{reset_link}" class="button">Reset Password</a>
            
            <p>This link will expire in 1 hour for security reasons.</p>
            
            <p>If you didn't request this password reset, please ignore this email or contact us if you have concerns.</p>
        </div>
        
        <div class="footer">
            <p>For security, this request was received from IP address: {ip_address}</p>
            <p>Time: {timestamp}</p>
        </div>
    </div>
</body>
</html>