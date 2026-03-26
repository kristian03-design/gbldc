<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Status Notification | GBLDC</title>
</head>
<body style="margin:0;padding:36px 16px;background-color:#f5faf6;font-family:'DM Sans',system-ui,sans-serif;-webkit-font-smoothing:antialiased;color:#1a2e1e;">

  <div style="max-width:600px;margin:0 auto;">

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
          <div style="display:inline-block;font-size:10px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#34d399;background:rgba(52,211,153,0.12);border:1px solid rgba(52,211,153,0.25);border-radius:5px;padding:4px 11px;margin-bottom:18px;">Loan Application</div>
          <div style="font-family:Georgia,serif;font-size:26px;font-weight:600;color:#ffffff;margin-bottom:5px;line-height:1.25;">Application Update</div>
          <div style="font-size:13px;color:rgba(255,255,255,0.48);">Review the details of your loan status below.</div>
        </td>
      </tr>

      <!-- Body -->
      <tr>
        <td style="padding:32px 40px;">

          <p style="font-size:15px;color:#1a2e1e;margin:0 0 8px;">Dear <strong style="color:#2d4a32;">{{ $memberName }}</strong>,</p>
          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0 0 24px;">{{ $statusMessage }}</p>

          <!-- Status Badge -->
          <div style="margin-bottom:24px;">
            @if($status === 'approved')
            <span style="display:inline-block;background-color:#dcfce7;color:#15803d;border:1.5px solid #86efac;border-radius:8px;padding:8px 18px;font-size:12px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;">✓ &nbsp;Approved</span>
            @elseif($status === 'rejected')
            <span style="display:inline-block;background-color:#fee2e2;color:#b91c1c;border:1.5px solid #fca5a5;border-radius:8px;padding:8px 18px;font-size:12px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;">✗ &nbsp;Rejected</span>
            @endif
          </div>

          <!-- Section label -->
          <div style="font-size:10px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#4a6b4f;margin-bottom:10px;">Loan Details</div>

          <!-- Details table -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #d4ecd8;border-radius:12px;overflow:hidden;margin-bottom:18px;">
            <tr>
              <td style="padding:13px 18px;border-bottom:1px solid #e8f4ea;background-color:#f0f7f1;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:13px;font-weight:500;color:#4a6b4f;">Loan Number</td>
                    <td align="right" style="font-size:13px;font-weight:600;color:#1a2e1e;">{{ $loanNumber }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:13px 18px;border-bottom:1px solid #e8f4ea;background-color:#ffffff;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:13px;font-weight:500;color:#4a6b4f;">Loan Amount</td>
                    <td align="right" style="font-family:Georgia,serif;font-size:22px;font-weight:600;color:#16a34a;">₱{{ number_format($loanAmount, 2) }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            @if($status === 'approved' && $dueAmount !== null)
            <tr>
              <td style="padding:13px 18px;background-color:#f0f7f1;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-size:13px;font-weight:500;color:#4a6b4f;">Due Amount</td>
                    <td align="right" style="font-size:15px;font-weight:600;color:#2d4a32;">₱{{ number_format($dueAmount, 2) }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            @endif
          </table>

          <!-- Payment Schedule -->
          @if($status === 'approved' && $paymentStartDate !== null)
          <div style="font-size:10px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#4a6b4f;margin:20px 0 10px;">Payment Schedule</div>
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:8px;">
            <tr>
              <td style="background-color:#1a2e1e;border-radius:12px;padding:20px 18px;">
                <div style="font-size:10px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#34d399;margin-bottom:14px;">📅 &nbsp;Repayment Plan</div>
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="padding:9px 0;border-bottom:1px solid rgba(255,255,255,0.07);">
                      <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                          <td style="font-size:12px;color:rgba(255,255,255,0.45);">Payment Start Date</td>
                          <td align="right" style="font-size:13px;font-weight:600;color:#ffffff;">{{ $paymentStartDate }}</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  @if($frequencyOfPayment !== null)
                  <tr>
                    <td style="padding:9px 0;">
                      <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                          <td style="font-size:12px;color:rgba(255,255,255,0.45);">Frequency</td>
                          <td align="right" style="font-size:13px;font-weight:600;color:#ffffff;">{{ $frequencyOfPayment }}</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  @endif
                </table>
              </td>
            </tr>
          </table>
          @endif

          <!-- Divider -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:24px 0 20px;">
            <tr>
              <td style="border-top:1px solid #d4ecd8;font-size:0;">&nbsp;</td>
            </tr>
          </table>

          <p style="font-size:13px;color:#4a6b4f;line-height:1.75;margin:0 0 24px;">
            Thank you for choosing <strong style="color:#2d4a32;">GBLDC Cooperative</strong> for your financial needs. If you have any questions or concerns regarding your loan, please don't hesitate to reach out to us.
          </p>

          <!-- CTA -->
          <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">
                <a href="{{ route('Member.Login') }}" style="display:inline-block;background-color:#16a34a;color:#ffffff;text-decoration:none;padding:13px 36px;border-radius:9px;font-size:13px;font-weight:600;letter-spacing:0.03em;">View Your Account →</a>
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
      © {{ date('Y') }} GBLDC Cooperative. All rights reserved.
    </p>

  </div>
</body>
</html>