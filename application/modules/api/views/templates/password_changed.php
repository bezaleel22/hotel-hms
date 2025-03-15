<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Changed Notification</title>
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
            border-bottom: 2px solid #28a745;
        }
        .content {
            margin-bottom: 20px;
        }
        .alert {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #ffeeba;
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
            <h2>Password Changed Successfully</h2>
        </div>
        
        <div class="content">
            <p>Hello {firstname},</p>
            
            <p>Your password has been successfully changed.</p>
            
            <div class="alert">
                <p>If you did not make this change, please contact us immediately.</p>
            </div>
            
            <p>For security, you may want to:</p>
            <ul>
                <li>Log out of all devices</li>
                <li>Update passwords on any other sites where you used the same password</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>This change was made from IP address: {ip_address}</p>
            <p>Time: {timestamp}</p>
            <p>If you did not make this change, please contact us at {support_email}</p>
        </div>
    </div>
</body>
</html>