<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check Shared Capital | GBLDC</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root {
      --forest:    #0d4a2f;
      --forest-mid:#1a6b44;
      --emerald:   #22c55e;
      --sage:      #d1fae5;
      --sand:      #fafaf8;
      --ink:       #0f1c14;
      --muted:     #6b7280;
      --border:    #e5e7eb;
      --white:     #ffffff;
      --amber:     #f59e0b;
      --sky:       #3b82f6;
      --rose:      #ef4444;
      --sidebar-w: 260px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--sand);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
    }

    /* ── Sidebar ── */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--forest);
      color: #fff;
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; bottom: 0;
      z-index: 100;
      transition: transform .3s ease;
    }

    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 22px 20px 18px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-profile {
      margin: 14px 12px;
      padding: 12px;
      background: rgba(255,255,255,.07);
      border-radius: 12px;
      display: flex; align-items: center; gap: 10px;
    }
    .profile-avatar {
      width: 40px; height: 40px; border-radius: 50%;
      border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; overflow: hidden;
    }
    .profile-avatar.female { background: #fce7f3; }
    .profile-avatar.male   { background: #dbeafe; }
    .profile-name  { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.3; }
    .profile-email { font-size: 11px; opacity: .5; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; }

    .sidebar-nav { flex: 1; padding: 8px 12px; overflow-y: auto; }

    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 12px; border-radius: 10px;
      text-decoration: none;
      color: rgba(255,255,255,.7);
      font-size: 14px; font-weight: 500;
      transition: background .2s, color .2s;
      margin-bottom: 2px;
    }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }
    .nav-item.danger { color: rgba(248,113,113,.8); }
    .nav-item.danger:hover { background: rgba(239,68,68,.1); color: #fca5a5; }

    .sidebar-footer {
      padding: 14px 12px;
      border-top: 1px solid rgba(255,255,255,.1);
      font-size: 11px; opacity: .35; text-align: center;
    }

    /* ── Mobile toggle ── */
    .mobile-toggle {
      display: none;
      position: fixed; top: 14px; left: 14px; z-index: 200;
      width: 38px; height: 38px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer;
      align-items: center; justify-content: center;
    }
    .mobile-toggle i[data-lucide] { width: 18px; height: 18px; }

    /* ── Main ── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── Topbar ── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      position: sticky; top: 0; z-index: 50;
    }
    .topbar h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700; color: var(--forest);
    }
    .breadcrumb {
      display: flex; align-items: center; gap: 5px;
      font-size: 12px; color: var(--muted); margin-top: 3px;
    }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Cards ── */
    .card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      margin-bottom: 20px;
    }

    .card-header {
      padding: 18px 22px 14px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .card-header h2 {
      font-size: 15px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .card-header h2 i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }

    .card-body { padding: 22px; }

    /* ── Status badge ── */
    .status-badge {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: 12px; font-weight: 700;
      padding: 5px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: .04em;
    }
    .status-badge i[data-lucide] { width: 12px; height: 12px; }
    .status-badge.active   { background: #dcfce7; color: #166534; }
    .status-badge.pending  { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dbeafe; color: #1e40af; }
    .status-badge.default  { background: #f3f4f6; color: var(--muted); }

    /* ── Progress bar ── */
    .progress-wrapper { margin-bottom: 6px; }
    .progress-meta {
      display: flex; justify-content: space-between;
      font-size: 12px; color: var(--muted); margin-bottom: 8px;
    }
    .progress-meta strong { color: var(--ink); }
    .progress-track {
      width: 100%; height: 10px; border-radius: 10px;
      background: #e5e7eb; overflow: hidden;
    }
    .progress-fill {
      height: 100%; border-radius: 10px;
      background: linear-gradient(90deg, var(--forest), var(--emerald));
      transition: width 1s ease-out;
    }
    .progress-labels {
      display: flex; justify-content: space-between;
      font-size: 11px; color: var(--muted); margin-top: 5px;
    }

    /* ── Info rows ── */
    .info-list { display: flex; flex-direction: column; gap: 0; }
    .info-row {
      display: flex; justify-content: space-between; align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid var(--border);
      font-size: 13px;
    }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .info-row .lbl { color: var(--muted); }
    .info-row .val { font-weight: 600; text-align: right; }
    .info-row .val.green { color: #16a34a; }
    .info-row .val.red   { color: #dc2626; }

    .info-row.block-row { flex-direction: column; align-items: flex-start; gap: 4px; }
    .info-row.block-row .val { text-align: left; }

    /* ── Payment history table ── */
    .pay-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .pay-table thead tr { background: #f9fafb; }
    .pay-table th {
      padding: 10px 16px; text-align: left;
      font-size: 11px; letter-spacing: .06em; text-transform: uppercase;
      color: var(--muted); font-weight: 600;
      border-bottom: 1px solid var(--border);
    }
    .pay-table tbody tr { border-top: 1px solid var(--border); transition: background .15s; }
    .pay-table tbody tr:hover { background: #f9fafb; }
    .pay-table td { padding: 11px 16px; }
    .pay-table td.muted { color: var(--muted); }
    .ref-mono { font-family: monospace; font-size: 11px; color: var(--muted); }

    .pill {
      display: inline-block; font-size: 10px; font-weight: 700;
      padding: 3px 9px; border-radius: 20px; text-transform: uppercase;
    }
    .pill.paid      { background: #dcfce7; color: #166534; }
    .pill.pending   { background: #fef3c7; color: #92400e; }
    .pill.default   { background: #f3f4f6; color: var(--muted); }

    /* ── Empty state ── */
    .empty-state {
      text-align: center; padding: 56px 24px;
    }
    .empty-icon {
      width: 64px; height: 64px; border-radius: 50%;
      background: #f3f4f6;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 16px;
    }
    .empty-icon i[data-lucide] { width: 28px; height: 28px; color: #9ca3af; }
    .empty-state h3 { font-size: 18px; font-weight: 700; margin-bottom: 6px; }
    .empty-state p  { font-size: 13px; color: var(--muted); max-width: 360px; margin: 0 auto 24px; }
    .empty-actions  { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }

    /* ── Action buttons ── */
    .btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 11px 20px; border-radius: 10px;
      font-size: 14px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      text-decoration: none; font-family: 'DM Sans', sans-serif;
    }
    .btn:active { transform: scale(.97); }
    .btn i[data-lucide] { width: 15px; height: 15px; }
    .btn.green   { background: var(--forest); color: #fff; }
    .btn.green:hover { background: var(--forest-mid); }
    .btn.outline { background: var(--white); color: var(--forest); border: 1.5px solid var(--forest); }
    .btn.outline:hover { background: var(--sage); }
    .btn.sky     { background: var(--sky); color: #fff; }
    .btn.sky:hover { background: #2563eb; }

    .action-row { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 20px; }

    /* ── Logout modal ── */
    .modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.45); z-index: 200;
      align-items: center; justify-content: center; padding: 16px;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--white); border-radius: 16px;
      padding: 28px; width: 100%; max-width: 420px;
      animation: popIn .25s ease;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(10px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }
    .modal-icon {
      width: 48px; height: 48px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 16px;
    }
    .modal-icon.red { background: #fee2e2; color: #dc2626; }
    .modal-icon i[data-lucide] { width: 22px; height: 22px; }
    .modal h3 { font-size: 18px; font-weight: 700; text-align: center; margin-bottom: 6px; }
    .modal p  { font-size: 13px; color: var(--muted); text-align: center; margin-bottom: 22px; }
    .modal-btn-row { display: flex; gap: 10px; }
    .modal-btn {
      flex: 1; padding: 11px; border-radius: 10px;
      font-size: 14px; font-weight: 600; border: none; cursor: pointer;
      transition: background .2s; font-family: 'DM Sans', sans-serif;
    }
    .modal-btn.cancel { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover { background: #e5e7eb; }
    .modal-btn.danger { background: var(--rose); color: #fff; }
    .modal-btn.danger:hover { background: #dc2626; }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .sidebar { transform: translateX(-260px); }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0; }
      .mobile-toggle { display: flex; }
      .page-body { padding: 20px 18px; }
      .topbar { padding: 14px 18px; }
      .guarantor-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
      .action-row { flex-direction: column; }
      .action-row .btn { justify-content: center; }
    }
  </style>
</head>
<body>

<button class="mobile-toggle" id="mobileToggle">
  <i data-lucide="menu"></i>
</button>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
      style="width:40px;height:40px;object-fit:cover;border-radius:10px;flex-shrink:0;" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Member Portal</div>
    </div>
  </div>

  <div class="sidebar-profile">
    <div class="profile-avatar {{ strtolower($gender ?? 'male') == 'female' ? 'female' : 'male' }}">
      @if(auth('officialmember')->check() && auth('officialmember')->user()->profile_picture)
        <img src="{{ asset('images/profile_pictures/' . auth('officialmember')->user()->profile_picture) }}" alt="Profile" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
      @elseif(isset($gender) && strtolower($gender) == 'female' || (isset($AutoComplete->gender) && strtolower($AutoComplete->gender) == 'female') || (isset($user) && strtolower($user->gender ?? '') == 'female'))
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{$fist_name}} {{$last_name}}</div>
      <div style="margin-top: 5px; display: inline-flex; align-items: center; gap: 5px; padding: 4px 8px; border-radius: 6px; background: rgba(255, 255, 255, 0.1); font-size: 11px; font-weight: 600; color: #d1fae5; border: 1px solid rgba(255, 255, 255, 0.15); letter-spacing: 0.03em;">
        <i data-lucide="id-card" style="width: 12px; height: 12px; opacity: 0.9;"></i> {{$member_id}}
      </div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <a href="{{route('Member.Landing')}}" class="nav-item">
      <i data-lucide="home"></i> Home
    </a>
    <a href="{{route('Loan.Dashboard')}}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Loan Dashboard
    </a>
    <a href="{{ route('Member.Check.Loan.Status') }}" class="nav-item">
      <i data-lucide="search"></i> Check Loan Status
    </a>
    <a href="{{ route('Member.Check.Shared.Capital') }}" class="nav-item active">
      <i data-lucide="piggy-bank"></i> Check Shared Capital
    </a>
    <a href="{{ route('Member.Notifications') }}" class="nav-item">
      <i data-lucide="bell"></i> Notification
    </a>
    <a href="{{ route('Member.ContactUs') }}" class="nav-item">
      <i data-lucide="mail"></i> Contact Us
    </a>
    <a href="{{ route('Member.FAQ') }}" class="nav-item">
      <i data-lucide="circle-help"></i> FAQ
    </a>
    <a href="{{ route('Member.AccountSettings') }}" class="nav-item">
      <i data-lucide="settings"></i> Account Settings
    </a>
    <a href="#" class="nav-item danger" onclick="openLogoutModal(); return false;">
      <i data-lucide="log-out"></i> Logout
    </a>
  </nav>

  <div class="sidebar-footer">GBLDC Member Portal &copy; 2025</div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <header class="topbar">
    <h1>Check Shared Capital</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <i data-lucide="house" style="width:12px;height:12px;"></i>
      <a href="{{route('Member.Landing')}}">Home</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <a href="{{route('Loan.Dashboard')}}">Loan Dashboard</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <span class="current">Check Shared Capital</span>
    </nav>
  </header>

  <div class="page-body">

    @if($currentSharedCapital)

    <!-- Status overview -->
    <div class="card">
      <div class="card-header">
        <h2><i data-lucide="activity"></i> Current Shared Capital Status</h2>
        @php 
            $isFullyPaid = (float)$currentSharedCapital->shared_capital_amount <= 0;
            $s = strtolower($currentSharedCapital->status ?? 'active'); 
        @endphp
        <span class="status-badge {{ $isFullyPaid ? 'active' : (str_contains($s,'pending') ? 'pending' : (str_contains($s,'approved') ? 'approved' : 'default')) }}">
          @if($isFullyPaid)
            <i data-lucide="circle-check-big"></i> Fully Paid
          @elseif(str_contains($s,'pending'))
            <i data-lucide="clock"></i> Pending
          @else
            <i data-lucide="info"></i> {{ $currentSharedCapital->status ?? 'Active' }}
          @endif
        </span>
      </div>
      <div class="card-body">
        <div class="progress-wrapper">
          <div class="progress-meta">
            <span>Payment Progress</span>
            <strong>{{ number_format($sharedCapitalProgress, 1) }}% Paid</strong>
          </div>
          <div class="progress-track">
            <div class="progress-fill" style="width: {{ $sharedCapitalProgress }}%;"></div>
          </div>
          <div class="progress-labels">
            <span>₱{{ number_format($totalPaid, 2) }} paid</span>
            <span>₱{{ number_format($totalSubscription, 2) }} total subscription</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Details grid -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">

      <!-- Shared Capital Information -->
      <div class="card" style="margin-bottom:0;">
        <div class="card-header">
          <h2><i data-lucide="file-text"></i> Subscription Information</h2>
        </div>
        <div class="card-body">
          <div class="info-list">
            <div class="info-row">
              <span class="lbl">Total Subscription</span>
              <span class="val green">₱{{ number_format($totalSubscription, 2) }}</span>
            </div>
            <div class="info-row">
              <span class="lbl">Remaining Balance</span>
              <span class="val red">₱{{ number_format((float)$currentSharedCapital->shared_capital_amount, 2) }}</span>
            </div>
            <div class="info-row">
              <span class="lbl">Number of Payments</span>
              <span class="val">{{ $currentSharedCapital->number_of_payments ?? '—' }} schedule(s)</span>
            </div>
            <div class="info-row">
              <span class="lbl">Payment Frequency</span>
              <span class="val">{{ $currentSharedCapital->payment_frequency ?? '—' }}</span>
            </div>
            <div class="info-row">
              <span class="lbl">Amount Per Schedule</span>
              <span class="val">₱{{ number_format((float)($currentSharedCapital->payment_amount_per_schedule ?? 0), 2) }}</span>
            </div>
            <div class="info-row">
              <span class="lbl">Payment Start Date</span>
              <span class="val">{{ $currentSharedCapital->payment_start_date ? date('M d, Y', strtotime($currentSharedCapital->payment_start_date)) : '—' }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional Details -->
      <div class="card" style="margin-bottom:0;">
        <div class="card-header">
          <h2><i data-lucide="info"></i> Additional Details</h2>
        </div>
        <div class="card-body">
          <div class="info-list">
            <div class="info-row">
              <span class="lbl">Date of Membership</span>
              <span class="val">{{ $currentSharedCapital->date_of_membership ? date('M d, Y', strtotime($currentSharedCapital->date_of_membership)) : 'N/A' }}</span>
            </div>
            <div class="info-row">
              <span class="lbl">Record Creation Date</span>
              <span class="val">{{ $currentSharedCapital->record_creation_date ? date('M d, Y', strtotime($currentSharedCapital->record_creation_date)) : 'N/A' }}</span>
            </div>
            <div class="info-row">
              <span class="lbl">Encoded By</span>
              <span class="val">{{ $currentSharedCapital->encoded_by ?? 'N/A' }}</span>
            </div>
            <div class="info-row block-row">
              <span class="lbl">Remarks</span>
              <span class="val">{{ $currentSharedCapital->remarks ?? 'None' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Payment History -->
    <div class="card">
      <div class="card-header">
        <h2><i data-lucide="receipt"></i> Payment History</h2>
      </div>
      <div style="overflow-x:auto;">
        <table class="pay-table">
          <thead><tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Status</th>
            <th>Reference #</th>
          </tr></thead>
          <tbody>
            @if($sharedCapitalPaymentHistory && $sharedCapitalPaymentHistory->count() > 0)
              @foreach($sharedCapitalPaymentHistory as $payment)
              <tr>
                <td class="muted">{{ date('M d, Y', strtotime($payment->transaction_date)) }}</td>
                <td style="font-weight:700;color:#16a34a;">₱{{ number_format($payment->payment_amount, 2) }}</td>
                <td class="muted">{{ $payment->payment_method }}</td>
                <td>
                  @php $ps = strtolower($payment->payment_status); @endphp
                  <span class="pill {{ str_contains($ps,'complet')||str_contains($ps,'paid') ? 'paid' : (str_contains($ps,'pend') ? 'pending' : 'default') }}">
                    {{ $payment->payment_status }}
                  </span>
                </td>
                <td><span class="ref-mono">{{ $payment->reference_number }}</span></td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="5" style="padding:32px;text-align:center;color:var(--muted);font-size:13px;">
                  No payment records found for shared capital.
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <!-- Action buttons -->
    <div class="action-row">
      <a href="{{ route('Payment.Schedule', ['type' => 'shared_capital']) }}" class="btn green">
        <i data-lucide="calendar"></i> View Payment Schedule
      </a>
      <a href="{{ route('Loan.Dashboard') }}" class="btn outline">
        <i data-lucide="arrow-left"></i> Back to Dashboard
      </a>
    </div>

    @else

    <!-- Empty state -->
    <div class="card">
      <div class="empty-state">
        <div class="empty-icon">
          <i data-lucide="piggy-bank"></i>
        </div>
        <h3>No Shared Capital Record</h3>
        <p>You currently don't have an active shared capital record linked to your account. Please contact the administration if this is a mistake.</p>
        <div class="empty-actions">
          <a href="{{ route('Loan.Dashboard') }}" class="btn outline">
            <i data-lucide="arrow-left"></i> Back to Dashboard
          </a>
        </div>
      </div>
    </div>

    @endif

  </div><!-- /page-body -->
</div><!-- /main -->

<!-- Logout Modal -->
<div class="modal-overlay" id="logout-modal">
  <div class="modal">
    <div class="modal-icon red"><i data-lucide="log-out"></i></div>
    <h3>Confirm Logout</h3>
    <p>Are you sure you want to logout? You'll need to sign in again to access your account.</p>
    <div class="modal-btn-row">
      <button class="modal-btn cancel" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{ route('Landing.Page') }}" class="modal-btn danger"
        style="text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</div>

<script>
  lucide.createIcons();

  // Mobile sidebar
  const sidebar      = document.getElementById('sidebar');
  const mobileToggle = document.getElementById('mobileToggle');
  mobileToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  document.addEventListener('click', e => {
    if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
      sidebar.classList.remove('open');
    }
  });

  // Logout modal
  const logoutModal = document.getElementById('logout-modal');
  function openLogoutModal()  { logoutModal.classList.add('open'); }
  function closeLogoutModal() { logoutModal.classList.remove('open'); }
  logoutModal.addEventListener('click', e => { if (e.target === logoutModal) closeLogoutModal(); });

  // Animate progress bar on load
  document.addEventListener('DOMContentLoaded', () => {
    const fill = document.querySelector('.progress-fill');
    if (fill) {
      const target = fill.style.width;
      fill.style.width = '0%';
      requestAnimationFrame(() => {
        setTimeout(() => { fill.style.width = target; }, 100);
      });
    }
  });
</script>
</body>
</html>
