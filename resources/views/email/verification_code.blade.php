<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #4F46E5;
            color: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .email-body {
            padding: 40px 30px;
        }

        .email-body p {
            color: #374151;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .verify-button {
            display: inline-block;
            background-color: #4F46E5;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 40px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .verify-button:hover {
            background-color: #4338CA;
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .alternative-link {
            background-color: #F3F4F6;
            padding: 20px;
            border-radius: 6px;
            margin: 30px 0;
        }

        .alternative-link p {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 10px;
        }

        .alternative-link code {
            display: block;
            background-color: #ffffff;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #E5E7EB;
            word-wrap: break-word;
            font-size: 13px;
            color: #1F2937;
            margin-top: 8px;
        }

        .expiry-notice {
            background-color: #FEF3C7;
            border-left: 4px solid #F59E0B;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .expiry-notice p {
            color: #92400E;
            font-size: 14px;
            margin: 0;
        }

        .email-footer {
            background-color: #F9FAFB;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #E5E7EB;
        }

        .email-footer p {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 10px;
        }

        .security-tips {
            text-align: left;
            margin: 30px 0;
        }

        .security-tips h3 {
            font-size: 16px;
            color: #1F2937;
            margin-bottom: 12px;
        }

        .security-tips ul {
            list-style: none;
            padding-left: 0;
        }

        .security-tips li {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .security-tips li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #4F46E5;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Verify Your Email Address</h1>
        </div>

        <div class="email-body">
            <p>Hello,</p>

            <p>Thank you for creating an account with us. To complete your registration and secure your account, please verify your email address by clicking the button below.</p>

            <div class="button-container">
                <a href="{{ $url }}" class="verify-button">Verify Email Address</a>
            </div>

            <div class="expiry-notice">
                <p>⏱️ This verification link will expire in 10 minutes for security reasons.</p>
            </div>

        </div>

        <div class="email-footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>© 2026 SmartTradingEA. All rights reserved.</p>
            <p style="margin-top: 15px;">
                <a href="#" style="color: #4F46E5; text-decoration: none; margin: 0 10px;">Privacy Policy</a> |
                <a href="#" style="color: #4F46E5; text-decoration: none; margin: 0 10px;">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
