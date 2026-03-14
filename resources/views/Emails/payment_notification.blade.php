<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Notification | GBLDC</title>
  <style>
    /* ── Reset ── */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f0;
      color: #0f1c14;
      padding: 32px 16px;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    /* ── Wrapper ── */
    .wrapper {
      max-width: 580px;
      margin: 0 auto;
    }

    /* ── Pre-header logo bar ── */
    .pre-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .pre-header-inner {
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }
    .pre-logo-text {
      font-size: 20px;
      font-weight: 700;
      color: #0d4a2f;
      letter-spacing: .04em;
    }
    .pre-logo-sub {
      font-size: 10px;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: .1em;
    }

    /* ── Card ── */
    .card {
      background: #ffffff;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(13,74,47,.10), 0 1px 4px rgba(0,0,0,.05);
    }

    /* ── Header ── */
    .card-header {
      background: #0d4a2f;
      padding: 36px 40px 32px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .card-header::before {
      content: '';
      position: absolute; inset: 0;
      background: radial-gradient(ellipse at 70% 50%, rgba(34,197,94,.18) 0%, transparent 70%);
      pointer-events: none;
    }
    .header-icon {
      width: 56px; height: 56px;
      background: rgba(34,197,94,.18);
      border: 2px solid rgba(34,197,94,.4);
      border-radius: 16px;
      display: inline-flex; align-items: center; justify-content: center;
      margin-bottom: 14px;
    }
    .header-icon svg { width: 26px; height: 26px; }
    .card-header h1 {
      font-size: 22px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 4px;
      letter-spacing: -.01em;
    }
    .card-header p {
      font-size: 13px;
      color: rgba(255,255,255,.55);
    }

    /* ── Body ── */
    .card-body {
      padding: 32px 40px;
    }
    .greeting {
      font-size: 15px;
      color: #0f1c14;
      margin-bottom: 6px;
    }
    .greeting strong { color: #0d4a2f; }
    .intro {
      font-size: 13px;
      color: #6b7280;
      margin-bottom: 24px;
    }

    /* ── Amount hero ── */
    .amount-hero {
      background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
      border: 1px solid #bbf7d0;
      border-radius: 14px;
      padding: 22px 24px;
      text-align: center;
      margin-bottom: 20px;
    }
    .amount-label {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: #16a34a;
      margin-bottom: 6px;
    }
    .amount-value {
      font-size: 36px;
      font-weight: 700;
      color: #0d4a2f;
      letter-spacing: -.02em;
      line-height: 1;
    }
    .amount-type {
      font-size: 12px;
      color: #6b7280;
      margin-top: 6px;
    }
    .amount-type span {
      display: inline-block;
      background: #d1fae5;
      color: #065f46;
      padding: 2px 10px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 11px;
    }

    /* ── Details table ── */
    .details-table {
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 20px;
    }
    .detail-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 18px;
      border-bottom: 1px solid #f3f4f6;
      gap: 12px;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-row:nth-child(odd) { background: #fafafa; }
    .d-label {
      font-size: 12px;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: .04em;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      gap: 7px;
    }
    .d-label svg { width: 13px; height: 13px; opacity: .6; flex-shrink: 0; }
    .d-value {
      font-size: 13px;
      font-weight: 700;
      color: #0f1c14;
      text-align: right;
      word-break: break-all;
    }
    .d-value.mono {
      font-family: 'Courier New', monospace;
      font-size: 12px;
      color: #374151;
    }

    /* ── Balance notice ── */
    .balance-box {
      background: #fffbeb;
      border: 1px solid #fde68a;
      border-radius: 12px;
      padding: 16px 18px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .balance-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: #fef3c7;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .balance-icon svg { width: 16px; height: 16px; color: #b45309; }
    .balance-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #92400e; margin-bottom: 2px; }
    .balance-value { font-size: 18px; font-weight: 700; color: #0d4a2f; }

    /* ── Divider ── */
    .divider { border: none; border-top: 1px solid #f3f4f6; margin: 24px 0; }

    /* ── Closing copy ── */
    .closing { font-size: 13px; color: #6b7280; margin-bottom: 20px; }
    .closing strong { color: #0d4a2f; }

    /* ── CTA button ── */
    .cta-wrap { text-align: center; margin-bottom: 8px; }
    .cta-btn {
      display: inline-block;
      background: #0d4a2f;
      color: #ffffff !important;
      text-decoration: none;
      padding: 13px 36px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: .01em;
    }

    /* ── Footer ── */
    .card-footer {
      background: #f9fafb;
      border-top: 1px solid #f3f4f6;
      padding: 20px 40px;
      text-align: center;
    }
    .footer-brand {
      font-size: 13px;
      font-weight: 700;
      color: #0d4a2f;
      margin-bottom: 4px;
    }
    .footer-text {
      font-size: 11px;
      color: #9ca3af;
      line-height: 1.7;
    }

    /* ── Bottom tag ── */
    .bottom-tag {
      text-align: center;
      margin-top: 20px;
      font-size: 11px;
      color: #9ca3af;
    }
  </style>
</head>
<body>
<div class="wrapper">

  {{-- Pre-header brand --}}
  <div class="pre-header">
    <div class="pre-header-inner">
      <div>
        <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
      </div>
    </div>
  </div>

  <div class="card">

    {{-- Header --}}
    <div class="card-header">
      <div class="header-icon">
       <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
      </div>
      <h1>Payment Received</h1>
      <p>Your transaction has been successfully recorded.</p>
    </div>

    {{-- Body --}}
    <div class="card-body">

      <p class="greeting">Dear <strong>{{ $memberName }}</strong>,</p>
      <p class="intro">We are pleased to confirm that a payment has been successfully recorded in your GBLDC account.</p>

      {{-- Amount hero --}}
      <div class="amount-hero">
        <div class="amount-label">Amount Paid </div>
        <div class="amount-value">₱ {{ number_format($amount, 2) }}</div>
        <div class="amount-type"><span>{{ $transactionType }}</span></div>
      </div>

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

      {{-- Details --}}
      <div class="details-table">
        <div class="detail-row">
          <span class="d-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
            Reference No.: 
          </span>
          <span class="d-value mono"> {{ $refFormatted }}</span>
        </div>
        <div class="detail-row">
          <span class="d-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Transaction Date: 
          </span>
          <span class="d-value"> {{ $txDateFormatted }}</span>
        </div>
        <div class="detail-row">
          <span class="d-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/></svg>
            Transaction Type: 
          </span>
          <span class="d-value"> {{ $transactionType }}</span>
        </div>
      </div>

      {{-- Balance --}}
      @if($newBalance !== null)
      <div class="balance-box">
        <div class="balance-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="#b45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          </svg>
        </div>
        <div>
          <div class="balance-label">Updated {{ $balanceType }} Balance: </div>
          <div class="balance-value">₱ {{ number_format($newBalance, 2) }}</div>
        </div>
      </div>
      @endif

      <hr class="divider">

      <p class="closing">
        Thank you for your continued trust in <strong>GBLDC Cooperative</strong>. If you have any questions or concerns regarding this transaction, please don't hesitate to reach out to our support team.
      </p>

      <div class="cta-wrap">
        <a href="{{ route('Member.Login') }}" class="cta-btn">View Your Account</a>
      </div>

    </div>{{-- /card-body --}}

    {{-- Footer --}}
    <div class="card-footer">
      <div class="footer-brand">Greater Bulacan Livelihood Development Cooperative</div>
      <div class="footer-text">
        © {{ date('Y') }} GBLDC Cooperative. All rights reserved.<br>
        This is an automated email notification. Please do not reply to this message.
      </div>
    </div>

  </div>{{-- /card --}}

  <div class="bottom-tag">
    You're receiving this email because you are a registered member of GBLDC.
  </div>

</div>
</body>
</html>