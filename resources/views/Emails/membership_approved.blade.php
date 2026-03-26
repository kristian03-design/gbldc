<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to GBLDC Cooperative</title>
</head>
<body style="margin:0;padding:36px 16px;background-color:#f5faf6;font-family:'DM Sans',system-ui,sans-serif;-webkit-font-smoothing:antialiased;color:#1a2e1e;">

  <div style="max-width:580px;margin:0 auto;">

    <!-- Eyebrow -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:16px;">
      <tr>
        <td style="font-size:11px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#16a34a;">GBLDC COOPERATIVE</td>
        <td align="right" style="font-size:11px;color:#4a6b4f;">Membership Approved</td>
      </tr>
    </table>

    <!-- Card -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 6px 32px rgba(26,46,30,0.10),0 1px 4px rgba(26,46,30,0.05);">

      <!-- Header -->
      <tr>
        <td style="background-color:#1a2e1e;padding:38px 40px 34px;">
          <div style="display:inline-block;font-size:10px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#34d399;background:rgba(52,211,153,0.12);border:1px solid rgba(52,211,153,0.25);border-radius:5px;padding:4px 11px;margin-bottom:18px;">Membership Confirmed</div>
          <div style="font-family:Georgia,serif;font-size:26px;font-weight:600;color:#ffffff;margin-bottom:5px;line-height:1.25;">Welcome to GBLDC</div>
          <div style="font-size:13px;color:rgba(255,255,255,0.48);">Your application has been approved. You're officially a member.</div>
        </td>
      </tr>

      <!-- Body -->
      <tr>
        <td style="padding:32px 40px;">

          <p style="font-size:15px;color:#1a2e1e;margin:0 0 8px;">Dear <strong style="color:#2d4a32;">{{ $memberName }}</strong>,</p>
          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0 0 24px;">
            Welcome to the <strong style="color:#2d4a32;">Greater Bulacan Livelihood Development Cooperative (GBLDC)</strong>! We are delighted to have you as a member. Your portal login credentials are ready — please keep them safe and confidential.
          </p>

          <!-- Section label -->
          <div style="font-size:10px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#4a6b4f;margin-bottom:10px;">Membership &amp; Login Details</div>

          <!-- Credentials box -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f0f7f1;border:1px solid #b6e8c0;border-radius:14px;overflow:hidden;margin-bottom:20px;">
            <tr>
              <td style="padding:13px 18px;border-bottom:1px solid #daeede;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:12px;font-weight:500;color:#4a6b4f;">Membership Number</td>
                    <td align="right" style="font-size:13px;font-weight:600;color:#1a2e1e;font-family:'Courier New',monospace;background-color:#dcfce7;color:#15803d;padding:2px 8px;border-radius:5px;letter-spacing:0.04em;">{{ $memberNumber }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:13px 18px;border-bottom:1px solid #daeede;background-color:#ffffff;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:12px;font-weight:500;color:#4a6b4f;">Registered Email</td>
                    <td align="right" style="font-size:13px;font-weight:600;color:#1a2e1e;">{{ $email }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:13px 18px;border-bottom:1px solid #daeede;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:12px;font-weight:500;color:#4a6b4f;">Portal Username</td>
                    <td align="right" style="font-size:13px;font-weight:600;color:#1a2e1e;">{{ $username }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:13px 18px;background-color:#ffffff;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:12px;font-weight:500;color:#4a6b4f;">Temporary Password</td>
                    <td align="right"><span style="font-size:13px;font-weight:600;font-family:'Courier New',monospace;background-color:#dcfce7;color:#15803d;padding:2px 8px;border-radius:5px;letter-spacing:0.04em;">{{ $password }}</span></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <!-- Security notice -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:24px;">
            <tr>
              <td style="background-color:#1a2e1e;border-radius:12px;padding:18px 20px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="36" valign="top">
                      <div style="width:36px;height:36px;border-radius:9px;background:rgba(52,211,153,0.12);border:1px solid rgba(52,211,153,0.2);text-align:center;line-height:36px;font-size:16px;margin-top:1px;">🛡</div>
                    </td>
                    <td style="padding-left:14px;">
                      <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:#34d399;margin-bottom:5px;">Security Reminder</div>
                      <div style="font-size:12px;color:rgba(255,255,255,0.6);line-height:1.7;">
                        For your protection, please log in immediately and change your password from the account settings page. Never share your credentials with anyone.
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <!-- CTA -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:24px;">
            <tr>
              <td align="center">
                <a href="{{ route('Member.Login') }}" style="display:inline-block;background-color:#16a34a;color:#ffffff;text-decoration:none;padding:13px 36px;border-radius:9px;font-size:13px;font-weight:600;letter-spacing:0.03em;">Go to Member Portal →</a>
              </td>
            </tr>
          </table>

          <!-- Divider -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 20px;">
            <tr>
              <td style="border-top:1px solid #d4ecd8;font-size:0;">&nbsp;</td>
            </tr>
          </table>

          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0 0 14px;">
            If you did not request this membership or believe this email was sent in error, please contact our office immediately.
          </p>
          <p style="font-size:13px;color:#1a2e1e;margin:0;">
            Warm regards,<br>
            <strong style="color:#2d4a32;">GBLDC Membership Team</strong>
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

    <!-- Bottom tag -->
    <p style="text-align:center;margin-top:18px;font-size:11px;color:#4a6b4f;line-height:1.7;">
      © {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative. All rights reserved.
    </p>

  </div>
</body>
</html>