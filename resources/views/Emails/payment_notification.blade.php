<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Notification | GBLDC</title>
</head>
<body style="margin:0;padding:36px 16px;background-color:#f5faf6;font-family:'DM Sans',system-ui,sans-serif;-webkit-font-smoothing:antialiased;color:#1a2e1e;">

  <div style="max-width:580px;margin:0 auto;">

    <!-- Eyebrow -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:16px;">
      <tr>
        <td style="font-size:11px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#16a34a;">GBLDC COOPERATIVE</td>
        <td align="right" style="font-size:11px;color:#4a6b4f;">Automated Notification</td>
      </tr>
    </table>

    <!-- Card -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 6px 32px rgba(26,46,30,0.10),0 1px 4px rgba(26,46,30,0.05);">

      <!-- Header -->
      <tr>
        <td style="background-color:#1a2e1e;padding:38px 40px 34px;">
          <div style="display:inline-block;font-size:10px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#34d399;background:rgba(52,211,153,0.12);border:1px solid rgba(52,211,153,0.25);border-radius:5px;padding:4px 11px;margin-bottom:18px;">Transaction Confirmed</div>
          <div style="font-family:Georgia,serif;font-size:26px;font-weight:600;color:#ffffff;margin-bottom:5px;line-height:1.25;">Payment Received</div>
          <div style="font-size:13px;color:rgba(255,255,255,0.48);">Your transaction has been successfully recorded.</div>
        </td>
      </tr>

      <!-- Body -->
      <tr>
        <td style="padding:32px 40px;">

          <p style="font-size:15px;color:#1a2e1e;margin:0 0 6px;">Dear <strong style="color:#2d4a32;">{{ $memberName }}</strong>,</p>
          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0 0 26px;">
            We are pleased to confirm that a payment has been successfully recorded in your GBLDC account. Please keep this notice for your records.
          </p>

          <!-- Amount Hero -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
            <tr>
              <td style="background-color:#f0f7f1;border:1px solid #b6e8c0;border-radius:14px;padding:24px;text-align:center;">
                <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.12em;color:#16a34a;margin-bottom:8px;">Amount Paid</div>
                <div style="font-family:Georgia,serif;font-size:40px;font-weight:600;color:#1a2e1e;letter-spacing:-0.02em;line-height:1;">₱ {{ number_format($amount, 2) }}</div>
                <div style="margin-top:10px;">
                  <span style="display:inline-block;background-color:#dcfce7;color:#15803d;padding:3px 12px;border-radius:20px;font-weight:600;font-size:11px;letter-spacing:0.04em;">{{ $transactionType }}</span>
                </div>
              </td>
            </tr>
          </table>

          @php
            $refDigits = preg_replace('/\D+/', '', (string) $referenceNumber);
            $refFormatted = $referenceNumber;
            if (strlen($refDigits) === 13) {
                $refFormatted = substr($refDigits, 0, 4) . '—' . substr($refDigits, 4, 4) . '—' . substr($refDigits, 8);
            }
            try {
              $txDateFormatted = \Carbon\Carbon::parse($transactionDate)->format('Y-m-d');
            } catch (\Throwable $e) {
              $txDateFormatted = $transactionDate;
            }
          @endphp

          <!-- Section label -->
          <div style="font-size:10px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#4a6b4f;margin-bottom:10px;">Transaction Details</div>

          <!-- Details table -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #d4ecd8;border-radius:12px;overflow:hidden;margin-bottom:18px;">
            <tr>
              <td style="padding:12px 18px;border-bottom:1px solid #e8f4ea;background-color:#f0f7f1;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:12px;font-weight:500;color:#4a6b4f;">Reference No.</td>
                    <td align="right" style="font-size:12px;font-weight:600;color:#2d4a32;font-family:'Courier New',monospace;">{{ $refFormatted }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:12px 18px;border-bottom:1px solid #e8f4ea;background-color:#ffffff;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:12px;font-weight:500;color:#4a6b4f;">Transaction Date</td>
                    <td align="right" style="font-size:13px;font-weight:600;color:#1a2e1e;">{{ $txDateFormatted }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:12px 18px;background-color:#f0f7f1;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:12px;font-weight:500;color:#4a6b4f;">Transaction Type</td>
                    <td align="right" style="font-size:13px;font-weight:600;color:#1a2e1e;">{{ $transactionType }}</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <!-- Balance Box -->
          @if($newBalance !== null)
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:24px;">
            <tr>
              <td style="background-color:#1a2e1e;border-radius:12px;padding:18px 20px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="40" valign="middle">
                      <div style="width:40px;height:40px;border-radius:10px;background:rgba(52,211,153,0.12);border:1px solid rgba(52,211,153,0.2);text-align:center;line-height:40px;font-size:18px;">💰</div>
                    </td>
                    <td style="padding-left:16px;">
                      <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:#34d399;margin-bottom:3px;">Updated {{ $balanceType }} Balance</div>
                      <div style="font-family:Georgia,serif;font-size:22px;font-weight:600;color:#ffffff;">₱ {{ number_format($newBalance, 2) }}</div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          @endif

          <!-- Divider -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 20px;">
            <tr>
              <td style="border-top:1px solid #d4ecd8;font-size:0;">&nbsp;</td>
            </tr>
          </table>

          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0 0 24px;">
            Thank you for your continued trust in <strong style="color:#2d4a32;">GBLDC Cooperative</strong>. If you have any questions or concerns regarding this transaction, please don't hesitate to reach out to our support team.
          </p>

          <!-- CTA -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">
                <a href="{{ route('Member.Login') }}" style="display:inline-block;background-color:#1a2e1e;color:#ffffff;text-decoration:none;padding:13px 36px;border-radius:9px;font-size:13px;font-weight:600;letter-spacing:0.03em;">View Your Account →</a>
              </td>
            </tr>
          </table>

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
      You're receiving this because you are a registered member of GBLDC.<br>
      Please keep this email for your records.
    </p>

  </div>
</body>
</html>