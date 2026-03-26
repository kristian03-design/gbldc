<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your OTP Code | GBLDC</title>
</head>
<body style="margin:0;padding:36px 16px;background-color:#f5faf6;font-family:'DM Sans',system-ui,sans-serif;-webkit-font-smoothing:antialiased;color:#1a2e1e;">

  <div style="max-width:560px;margin:0 auto;">

    <!-- Eyebrow -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:16px;">
      <tr>
        <td style="font-size:11px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#16a34a;">GBLDC COOPERATIVE</td>
        <td align="right" style="font-size:11px;color:#4a6b4f;">Verification Code</td>
      </tr>
    </table>

    <!-- Card -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 6px 32px rgba(26,46,30,0.10),0 1px 4px rgba(26,46,30,0.05);">

      <!-- Header -->
      <tr>
        <td style="background-color:#1a2e1e;padding:38px 40px 34px;">
          <div style="display:inline-block;font-size:10px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#34d399;background:rgba(52,211,153,0.12);border:1px solid rgba(52,211,153,0.25);border-radius:5px;padding:4px 11px;margin-bottom:18px;">One-Time Code</div>
          <div style="font-family:Georgia,serif;font-size:26px;font-weight:600;color:#ffffff;margin-bottom:5px;line-height:1.25;">Verification Code</div>
          <div style="font-size:13px;color:rgba(255,255,255,0.48);">Greater Bulacan Livelihood Development Cooperative</div>
        </td>
      </tr>

      <!-- Body -->
      <tr>
        <td style="padding:32px 40px;">

          <p style="font-size:15px;color:#1a2e1e;margin:0 0 8px;">Dear <strong style="color:#2d4a32;">{{ ucfirst($userType ?? 'Member') }}</strong>,</p>
          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0 0 28px;">
            We received a request requiring identity verification. Use the one-time code below to complete your action. Do not share this code with anyone.
          </p>

          <!-- OTP Hero -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:18px;">
            <tr>
              <td style="background-color:#1a2e1e;border-radius:16px;padding:32px 24px;text-align:center;">
                <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.14em;color:#34d399;margin-bottom:16px;">Your OTP Code</div>
                <div style="font-family:'Courier New',Courier,monospace;font-size:44px;font-weight:700;color:#ffffff;letter-spacing:0.2em;line-height:1;">{{ $otp }}</div>
                <!-- Decorative dots -->
                <div style="margin-top:18px;">
                  <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:rgba(52,211,153,0.35);margin:0 3px;"></span>
                  <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:rgba(52,211,153,0.35);margin:0 3px;"></span>
                  <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:rgba(52,211,153,0.35);margin:0 3px;"></span>
                  <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:rgba(52,211,153,0.35);margin:0 3px;"></span>
                  <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:rgba(52,211,153,0.35);margin:0 3px;"></span>
                </div>
              </td>
            </tr>
          </table>

          <!-- Expiry Notice -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
            <tr>
              <td style="background-color:#f0f7f1;border:1px solid #b6e8c0;border-radius:12px;padding:14px 18px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="34" valign="middle">
                      <div style="width:34px;height:34px;border-radius:8px;background-color:#dcfce7;text-align:center;line-height:34px;font-size:16px;">⏱</div>
                    </td>
                    <td style="padding-left:12px;font-size:13px;color:#4a6b4f;line-height:1.6;">
                      This code expires in <strong style="color:#2d4a32;">5 minutes</strong>. Enter it promptly to complete your verification.
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <!-- Divider -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:20px 0;">
            <tr>
              <td style="border-top:1px solid #d4ecd8;font-size:0;">&nbsp;</td>
            </tr>
          </table>

          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0;">
            If you did not request this code, you can safely ignore this email. Your account remains secure and no changes have been made.
          </p>

        </td>
      </tr>

      <!-- Card Footer -->
      <tr>
        <td style="background-color:#f0f7f1;border-top:1px solid #d4ecd8;padding:18px 40px;">
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td style="font-size:12px;font-weight:600;color:#2d4a32;">GBLDC Cooperative</td>
              <td align="right" style="font-size:11px;color:#4a6b4f;">© {{ date('Y') }} · Do not reply</td>
            </tr>
          </table>
        </td>
      </tr>

    </table>
    <!-- /Card -->

    <!-- Bottom tag -->
    <p style="text-align:center;margin-top:18px;font-size:11px;color:#4a6b4f;line-height:1.7;">
      This is an automated security message from GBLDC.<br>
      Please do not reply to this email.
    </p>

  </div>
</body>
</html>