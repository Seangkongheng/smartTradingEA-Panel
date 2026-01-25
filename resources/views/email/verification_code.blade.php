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

        .email-body {
            padding: 40px 30px;
        }

        .email-body p {
            color: #374151;
            margin-bottom: 20px;
            font-size: 16px;
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

        .email-footer a {
            color: #4F46E5;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <!-- Header with gradient background -->
        <div class="email-header" style="
            text-align: center;
            padding: 40px 30px;
            background: linear-gradient(to right, #FFD700, #BAFD00, #9EFF00);
        ">
            <!-- Logo -->
            <img src="http://127.0.0.1:8000/images/SuperTradingEA_logo.png" alt="Logo" width="150"
                 style="display:block; margin:auto;">

            <!-- Title with gradient text -->
            <h1 style="
                font-size:24px;
                font-weight:600;
                margin-top:20px;
                background: linear-gradient(to right, #FFFFFF, #FFFFFF);
                -webkit-background-clip: text;
                -webkit-text-fill-color: white;
            ">
                Verify Your Email Address
            </h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Hello,</p>

            <p>Thank you for creating an account with us. To complete your registration and secure your account, please
                verify your email address by clicking the button below.</p>

            <!-- Gradient Button -->
            <div style="text-align:center; margin-top:20px;">
                <a href="{{ $url }}" style="
                    display: inline-block;
                    text-decoration: none;
                    padding: 14px 40px;
                    border-radius: 6px;
                    font-weight: 600;
                    font-size: 16px;
                    background: linear-gradient(to right, #FFD700, #BAFD00, #9EFF00);
                    color: black;
                    text-align: center;
                ">
                    Verify Email Address
                </a>
            </div>

            <!-- Expiry Notice -->
            <div class="expiry-notice">
                <p>⏱️ This verification link will expire in 10 minutes for security reasons.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>© 2026 SmartTradingEA. All rights reserved.</p>
            <p>
                <a href="#">Privacy Policy</a> |
                <a href="#">Contact Support</a>
            </p>
        </div>
    </div>
</body>

</html>
