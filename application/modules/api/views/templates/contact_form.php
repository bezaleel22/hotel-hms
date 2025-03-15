<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
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
            border-bottom: 2px solid #dee2e6;
        }
        .content {
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #495057;
        }
        .message-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #6c757d;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
            <p>A new contact form submission has been received.</p>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="field-label">Name:</div>
                <div>{name}</div>
            </div>
            
            <div class="field">
                <div class="field-label">Email:</div>
                <div>{email}</div>
            </div>
            
            <div class="field">
                <div class="field-label">Phone:</div>
                <div>{phone}</div>
            </div>
            
            <div class="field">
                <div class="field-label">Message:</div>
                <div class="message-box">{message}</div>
            </div>
        </div>
    </div>
</body>
</html>
