<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f0f4f8; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f0f4f8; padding: 40px 0;">
        <tr>
            <td align="center">

                <!-- Email Card -->
                <table role="presentation" width="560" cellspacing="0" cellpadding="0" style="max-width: 560px; width: 100%; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%); padding: 40px 48px 36px; text-align: center;">
                            <!-- Shield Icon (using standard emoji for cross-client support) -->
                            <div style="display: inline-block; background: rgba(255,255,255,0.15); border-radius: 50%; width: 64px; height: 64px; line-height: 64px; text-align: center; margin-bottom: 16px; font-size: 28px;">
                                🔐
                            </div>
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 700; letter-spacing: -0.3px;">Reset Your Password</h1>
                            <p style="margin: 8px 0 0; color: rgba(255,255,255,0.75); font-size: 14px;">Greater Bulacan Livelihood Development Cooperative</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px 48px;">

                            <p style="margin: 0 0 16px; color: #374151; font-size: 16px; font-weight: 600;">
                                Hello, {{ $email }}
                            </p>
                            <p style="margin: 0 0 28px; color: #6b7280; font-size: 15px; line-height: 1.6;">
                                You are receiving this email because we received a password reset request for your member account.
                            </p>

                            <!-- Call to Action Button -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="padding: 12px 0 32px;">
                                        <a href="{{ $url }}" style="display: inline-block; background-color: #1a73e8; color: #ffffff; text-decoration: none; padding: 14px 32px; border-radius: 8px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 6px rgba(26, 115, 232, 0.25);">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 16px; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                This password reset link will expire in {{ config('auth.passwords.officialmembers.expire', 60) }} minutes.
                            </p>
                            <p style="margin: 0 0 32px; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                If you did not request a password reset, no further action is required. Your account remains secure.
                            </p>

                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 48px;">
                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 0;">
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 24px 48px; text-align: center;">
                            <p style="margin: 0; color: #9ca3af; font-size: 12px; line-height: 1.6;">
                                © <?php echo date('Y'); ?> Greater Bulacan Livelihood Development Cooperative<br>
                                This is an automated message — please do not reply.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- End Email Card -->

            </td>
        </tr>
    </table>

</body>
</html>
