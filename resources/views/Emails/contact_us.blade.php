<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Member Contact Message | GBLDC</title>
</head>
<body style="margin:0;padding:32px 16px;background-color:#f5faf6;font-family:'DM Sans',system-ui,sans-serif;-webkit-font-smoothing:antialiased;color:#1a2e1e;">

  <div style="max-width:640px;margin:0 auto;">

    <!-- Eyebrow -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:16px;">
      <tr>
        <td style="font-size:11px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#16a34a;">GBLDC COOPERATIVE</td>
        <td align="right" style="font-size:11px;color:#4a6b4f;">Automated Notification</td>
      </tr>
    </table>

    <!-- Card -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 4px 24px rgba(26,46,30,0.09),0 1px 4px rgba(26,46,30,0.06);">

      <!-- Header -->
      <tr>
        <td style="background-color:#1a2e1e;padding:32px 40px 28px;">
          <div style="display:inline-block;font-size:10px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#34d399;background:rgba(52,211,153,0.12);border:1px solid rgba(52,211,153,0.25);border-radius:5px;padding:4px 11px;margin-bottom:18px;">Member Portal</div>
          <div style="font-family:Georgia,serif;font-size:26px;font-weight:600;color:#ffffff;margin-bottom:5px;line-height:1.2;">New Contact Message</div>
          <div style="font-size:13px;color:rgba(255,255,255,0.48);">A member has submitted a message through the portal.</div>
        </td>
      </tr>

      <!-- Sender strip -->
      <tr>
        <td style="background-color:#f0f7f1;padding:18px 40px;border-bottom:1px solid #d4ecd8;">
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td width="44" valign="middle">
                <div style="width:44px;height:44px;background-color:#1a2e1e;border-radius:50%;text-align:center;line-height:44px;">
                  <span style="font-family:Georgia,serif;font-size:18px;color:#34d399;font-weight:600;">M</span>
                </div>
              </td>
              <td style="padding-left:14px;" valign="middle">
                <div style="font-size:15px;font-weight:600;color:#1a2e1e;margin-bottom:2px;">{{ $memberName }}</div>
                <div style="font-size:12px;color:#4a6b4f;">{{ $memberEmail }}</div>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- Subject -->
      <tr>
        <td style="padding:22px 40px 0;">
          <div style="font-size:10px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#4a6b4f;margin-bottom:4px;">Subject</div>
          <div style="font-family:Georgia,serif;font-size:17px;color:#1a2e1e;line-height:1.3;">{{ $subjectLine }}</div>
        </td>
      </tr>

      <!-- Divider -->
      <tr>
        <td style="padding:18px 40px 0;">
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td style="border-top:1px solid #d4ecd8;font-size:0;">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- Message body -->
      <tr>
        <td style="padding:20px 40px 36px;">
          <div style="font-size:10px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#4a6b4f;margin-bottom:10px;">Message</div>
          <div style="font-size:14px;color:#2d4a32;line-height:1.75;white-space:pre-wrap;background-color:#f0f7f1;border-left:3px solid #16a34a;padding:18px 20px;border-radius:0 8px 8px 0;">{{ $body }}</div>
        </td>
      </tr>

      <!-- Card Footer -->
      <tr>
        <td style="background-color:#f0f7f1;border-top:1px solid #d4ecd8;padding:16px 40px;">
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td style="font-size:11px;color:#4a6b4f;">Reply directly to this email to respond to the member.</td>
              <td align="right">
                <a href="mailto:{{ $memberEmail }}" style="display:inline-block;font-size:12px;font-weight:600;color:#1a2e1e;text-decoration:none;border:1.5px solid #1a2e1e;border-radius:6px;padding:7px 16px;letter-spacing:0.02em;">Reply ↗</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>

    </table>

    <!-- Bottom caption -->
    <p style="text-align:center;margin-top:20px;font-size:11px;color:#4a6b4f;letter-spacing:0.03em;">
      This is an automated message from your Member Portal system.
    </p>

  </div>
</body>
</html>