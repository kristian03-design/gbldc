<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Successful | GBLDC Admin</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --forest:     #0d4a2f;
      --forest-mid: #1a6b44;
      --emerald:    #22c55e;
      --sage:       #d1fae5;
      --sand:       #fafaf8;
      --ink:        #0f1c14;
      --muted:      #6b7280;
      --border:     #e5e7eb;
      --white:      #ffffff;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--sand);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      position: relative;
      overflow: hidden;
    }

    /* Background decoration */
    body::before {
      content: '';
      position: fixed;
      top: -120px; left: -120px;
      width: 400px; height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(34,197,94,.12), transparent 70%);
      pointer-events: none;
    }
    body::after {
      content: '';
      position: fixed;
      bottom: -100px; right: -100px;
      width: 360px; height: 360px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(13,74,47,.08), transparent 70%);
      pointer-events: none;
    }

    /* ── Card ── */
    .card {
      background: var(--white);
      border-radius: 24px;
      border: 1px solid var(--border);
      box-shadow: 0 8px 40px rgba(13,74,47,.08), 0 2px 8px rgba(0,0,0,.04);
      width: 100%;
      max-width: 460px;
      overflow: hidden;
      animation: slideUp .5s cubic-bezier(.22,.68,0,1.2) both;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(28px) scale(.97); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ── Card top banner ── */
    .card-banner {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      padding: 36px 32px 28px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .card-banner::before {
      content: '';
      position: absolute; top: -40px; right: -40px;
      width: 160px; height: 160px; border-radius: 50%;
      background: rgba(255,255,255,.06);
    }
    .card-banner::after {
      content: '';
      position: absolute; bottom: -30px; left: -20px;
      width: 100px; height: 100px; border-radius: 50%;
      background: rgba(255,255,255,.04);
    }

    /* ── Success icon ring ── */
    .icon-ring {
      width: 80px; height: 80px;
      border-radius: 50%;
      background: rgba(255,255,255,.15);
      border: 2px solid rgba(255,255,255,.25);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 16px;
      position: relative; z-index: 1;
      animation: popIn .6s .2s cubic-bezier(.22,.68,0,1.4) both;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.5); }
      to   { opacity: 1; transform: scale(1); }
    }
    .icon-ring i[data-lucide] {
      width: 38px; height: 38px;
      color: var(--emerald);
      filter: drop-shadow(0 0 8px rgba(34,197,94,.5));
    }

    .card-banner h1 {
      font-family: 'Playfair Display', serif;
      font-size: 24px; font-weight: 700;
      color: #fff; margin-bottom: 6px;
      position: relative; z-index: 1;
    }
    .card-banner p {
      font-size: 13px; color: rgba(255,255,255,.75);
      position: relative; z-index: 1;
    }

    /* ── Card body ── */
    .card-body { padding: 28px 28px 24px; }

    /* ── Details block ── */
    .details-block {
      background: var(--sand);
      border: 1px solid var(--border);
      border-radius: 14px;
      overflow: hidden;
      margin-bottom: 24px;
    }

    .details-block-header {
      padding: 12px 16px;
      background: var(--sage);
      border-bottom: 1px solid #bbf7d0;
      display: flex; align-items: center; gap: 7px;
      font-size: 12px; font-weight: 700;
      letter-spacing: .06em; text-transform: uppercase;
      color: var(--forest);
    }
    .details-block-header i[data-lucide] { width: 14px; height: 14px; }

    .detail-row {
      display: flex; align-items: center;
      justify-content: space-between;
      padding: 11px 16px;
      border-bottom: 1px solid var(--border);
      font-size: 13px;
    }
    .detail-row:last-child { border-bottom: none; }

    .detail-label {
      display: flex; align-items: center; gap: 7px;
      color: var(--muted); font-weight: 500;
    }
    .detail-label i[data-lucide] { width: 13px; height: 13px; }

    .detail-value { font-weight: 600; color: var(--ink); }

    .detail-value.amount {
      font-size: 15px; font-weight: 700;
      color: var(--forest);
    }

    .type-badge {
      font-size: 11px; font-weight: 700;
      padding: 3px 9px; border-radius: 20px;
      background: #dbeafe; color: #1e40af;
      letter-spacing: .03em;
    }

    /* ── Return button ── */
    .return-btn {
      display: flex; align-items: center; justify-content: center; gap: 8px;
      width: 100%;
      padding: 13px;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 100%);
      color: #fff;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px; font-weight: 700;
      text-decoration: none;
      border: none; cursor: pointer;
      transition: opacity .2s, transform .15s;
      letter-spacing: .02em;
    }
    .return-btn:hover { opacity: .9; transform: translateY(-1px); }
    .return-btn:active { transform: scale(.98); }
    .return-btn i[data-lucide] { width: 16px; height: 16px; }

    /* ── Footer note ── */
    .card-footer {
      text-align: center;
      padding: 0 28px 22px;
      font-size: 11px; color: var(--muted);
    }

    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
  </style>
</head>
<body>

  <div class="card">

    <!-- Banner -->
    <div class="card-banner">
      <div class="icon-ring">
        <i data-lucide="check"></i>
      </div>
      <h1>Payment Successful!</h1>
      <p>Your GCash payment has been processed successfully.</p>
    </div>

    <!-- Body -->
    <div class="card-body">

      @if(isset($payment))
      <div class="details-block">
        <div class="details-block-header">
          <i data-lucide="receipt"></i>
          Payment Details
        </div>

        <div class="detail-row">
          <span class="detail-label">
            <i data-lucide="user-circle"></i> Member ID
          </span>
          <span class="detail-value">{{ $payment['member_id'] }}</span>
        </div>

        <div class="detail-row">
          <span class="detail-label">
            <i data-lucide="tag"></i> Transaction Type
          </span>
          <span class="type-badge">{{ $payment['transaction_type'] }}</span>
        </div>

        <div class="detail-row">
          <span class="detail-label">
            <i data-lucide="banknote"></i> Amount Paid
          </span>
          <span class="detail-value amount">₱{{ number_format($payment['amount'], 2) }}</span>
        </div>

        @if($payment['loan_number'])
        <div class="detail-row">
          <span class="detail-label">
            <i data-lucide="hash"></i> Loan Number
          </span>
          <span class="detail-value">{{ $payment['loan_number'] }}</span>
        </div>
        @endif

      </div>
      @endif

      <a href="{{ route('Loan.Dashboard') }}" class="return-btn">
        <i data-lucide="arrow-left"></i>
        Return to Payment Page
      </a>

    </div><!-- /card-body -->

    <div class="card-footer">
      Keep this confirmation for your records. &nbsp;·&nbsp; GBLDC Admin System
    </div>

  </div>

  <script>lucide.createIcons();</script>
</body>
</html>