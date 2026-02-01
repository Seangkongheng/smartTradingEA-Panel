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
            /* plain light gray background */
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            border-radius: 20px;
            overflow: hidden;
            background-color: #ffffff;
            /* plain white card */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Solid dark header */
        .email-header {
            text-align: center;
            padding: 40px 30px;
            background-color: #1F2937;
            /* solid dark color */
            color: white;
        }

        .email-header img {
            width: 90px;
            margin: 0 auto;
            display: block;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .email-header h1 {
            font-size: 28px;
            font-weight: 800;
            margin-top: 20px;
            color: #ffffff;
        }

        .email-header p {
            font-size: 16px;
            margin-top: 5px;
            color: #A8E900;
            /* neon accent */
        }

        .email-body {
            padding: 30px;
            color: #374151;
            /* dark text for readability */
            font-size: 16px;
        }

        .email-body p {
            margin-bottom: 20px;
        }

        .verify-button {
            display: inline-block;
            text-decoration: none;
            padding: 14px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            background: #1F2937;
            color: white;
            text-align: center;
            transition: all 0.3s;
        }
        . .verify-button a{
            color: white;
        }

        .verify-button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(186, 253, 0, 0.6);
        }

        .expiry-notice {
            background: #FEF3C7;
            border-left: 4px solid #F59E0B;
            padding: 15px;
            margin: 20px 0;
            border-radius: 6px;
            color: #92400E;
            font-size: 14px;
        }

        .email-footer {
            background: #ffffff;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #E5E7EB;
            color: #6B7280;
            font-size: 14px;
        }

        .email-footer a {
            color: #4F46E5;
            text-decoration: none;
            margin: 0 8px;
            transition: all 0.2s;
        }

        .email-footer a:hover {
            color: #BAFD00;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <!-- Header -->
        <div class="email-header">
            <img src="https://vsadmin.smarttradingea.com/images/SuperTradingEA_logo.png" alt="Logo">
            <h1>Verify Your Email</h1>
            <p>SmartTrading By V.S Client Portal</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Hello,</p>
            <p>
                Thank you for creating an account with us. To complete your registration and secure your account, please
                verify your email address by clicking the button below.
            </p>

            <div style="text-align:center; margin-top:20px;">
                <a href="{{ $url }}" class="verify-button">Verify Email Address</a>
            </div>

            <div class="expiry-notice">
                ⏱️ This verification link will expire in 10 minutes for security reasons.
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>© {{ now()->year }} SmartTradingEA. All rights reserved.</p>
            <p>
                <a target="_blank" href="https://smarttradingea.com/terms-conditions">Terms & Conditions</a> |
                <a target="_blank" href="https://smarttradingea.com/disclaimer">Disclaimer</a>
            </p>
        </div>

    </div>
</body>

</html>
