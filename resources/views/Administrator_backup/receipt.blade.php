<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment Receipt | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">

  @php
    if(!isset($Record) && isset($payment)) {
        $Record = $payment;
    }
  @endphp

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
      --sidebar-w: 240px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

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
    }
    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text { font-family: 'DM Serif Display', serif; font-size: 18px; color: #fff; line-height: 1.2; }
    .logo-sub  { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
    .nav-section-label {
      font-size: 10px; letter-spacing: .1em; text-transform: uppercase;
      opacity: .4; padding: 16px 8px 6px;
    }
    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 12px; border-radius: 10px;
      text-decoration: none; color: rgba(255,255,255,.7);
      font-size: 14px; font-weight: 500;
      transition: background .2s, color .2s; margin-bottom: 2px;
    }
    .nav-item:hover  { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item svg, .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.1); }
    .user-card {
      display: flex; align-items: center; gap: 10px;
      padding: 10px; border-radius: 10px; cursor: pointer; transition: background .2s;
    }
    .user-card:hover { background: rgba(255,255,255,.08); }
    .avatar {
      width: 36px; height: 36px; border-radius: 50%;
      background: var(--forest-mid); border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0;
    }
    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; color: #fff; }

    #user-menu-dropdown {
      display: none; background: #0a3d27;
      border-radius: 10px; padding: 6px; margin-top: 6px;
    }
    .dropdown-item {
      display: flex; align-items: center; gap: 8px;
      padding: 8px 12px; border-radius: 7px;
      text-decoration: none; font-size: 13px; transition: background .15s;
    }
    .dropdown-item:hover { background: rgba(255,255,255,.08); }
    .dropdown-item.normal { color: rgba(255,255,255,.8); }
    .dropdown-item.danger { color: #f87171; }
    .dropdown-item svg, .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

    /* ── Main ── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── Topbar ── */
    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 14px 32px; display: flex; align-items: center; gap: 10px;
      position: sticky; top: 0; z-index: 50;
    }
    .back-btn {
      display: flex; align-items: center; gap: 6px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      white-space: nowrap; flex-shrink: 0;
    }
    .back-btn:hover { background: #a7f3d0; transform: translateX(-2px); }
    .back-btn svg, .back-btn i[data-lucide] { width: 14px; height: 14px; }

    .breadcrumb {
      display: flex; align-items: center; gap: 6px;
      font-size: 13px; color: var(--muted); flex-wrap: wrap;
    }
    .breadcrumb a { color: var(--forest-mid); text-decoration: none; font-weight: 600; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg, .breadcrumb i[data-lucide] { width: 12px; height: 12px; opacity: .4; flex-shrink: 0; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }
    .topbar-spacer { flex: 1; }

    /* Print button in topbar */
    .print-btn {
      display: flex; align-items: center; gap: 6px;
      padding: 8px 16px; border-radius: 10px;
      background: var(--forest); color: #fff;
      font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      white-space: nowrap;
    }
    .print-btn:hover { background: var(--forest-mid); transform: translateY(-1px); }
    .print-btn svg, .print-btn i[data-lucide] { width: 14px; height: 14px; }

    /* ── Page body ── */
    .page-body { padding: 32px 32px 80px; flex: 1; width: 100%; display: flex; justify-content: center; }

    /* ── Receipt wrapper ── */
    .receipt-wrap { width: 100%; max-width: 720px; }

    /* ── Page header banner ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 28px 32px; color: #fff;
      margin-bottom: 24px; position: relative; overflow: hidden;
      display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
    }
    .page-header::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: ''; position: absolute; bottom: -60px; right: 100px;
      width: 140px; height: 140px; border-radius: 50%; background: rgba(255,255,255,.04);
    }
    .page-header-content { position: relative; z-index: 1; }
    .page-header-eyebrow {
      font-size: 10px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
      color: var(--emerald); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;
    }
    .page-header-eyebrow::before {
      content: ''; display: inline-block; width: 18px; height: 2px;
      background: var(--emerald); border-radius: 2px;
    }
    .page-header-content h2 { font-family: 'DM Serif Display', serif; font-size: 24px; margin-bottom: 6px; }
    .page-header-content p  { font-size: 13px; opacity: .7; margin-bottom: 14px; }
    .receipt-num-tag {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 8px; padding: 5px 12px;
      font-size: 12px; font-weight: 600; color: rgba(255,255,255,.85);
    }
    .receipt-num-tag svg, .receipt-num-tag i[data-lucide] { width: 12px; height: 12px; color: var(--emerald); }

    .page-header-right { position: relative; z-index: 1; flex-shrink: 0; text-align: right; }
    .header-amount-box {
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 12px; padding: 14px 20px; text-align: right;
    }
    .ha-label { font-size: 11px; opacity: .65; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px; }
    .ha-amount { font-family: 'DM Serif Display', serif; font-size: 26px; color: #fff; }
    .ha-date   { font-size: 11px; opacity: .5; margin-top: 4px; }

    /* ── Card ── */
    .card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; overflow: hidden; margin-bottom: 16px;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .card-head {
      padding: 16px 24px; display: flex; align-items: center; gap: 12px;
      border-bottom: 1px solid var(--border);
    }
    .card-head-icon {
      width: 34px; height: 34px; border-radius: 9px; background: var(--sage);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .card-head-icon svg, .card-head-icon i[data-lucide] { width: 17px; height: 17px; color: var(--forest-mid); }
    .card-head-title { font-size: 14px; font-weight: 700; color: var(--ink); }
    .card-head-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .card-body { padding: 20px 24px; }

    /* ── Info grid ── */
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .info-grid .span2 { grid-column: 1 / -1; }
    @media (max-width: 600px) { .info-grid { grid-template-columns: 1fr; } .info-grid .span2 { grid-column: 1; } }

    .info-cell {
      background: var(--sand); border: 1px solid #eaf3ea;
      border-radius: 10px; padding: 12px 15px;
      transition: border-color .15s, background .15s;
    }
    .info-cell:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .info-cell .lbl {
      font-size: 10px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .07em; color: var(--muted); margin-bottom: 4px;
    }
    .info-cell .data { font-size: 13px; color: var(--ink); font-weight: 600; line-height: 1.4; }
    .info-cell .data.mono { font-family: monospace; letter-spacing: .04em; font-size: 12px; }

    /* ── Total amount row ── */
    .total-row {
      background: linear-gradient(90deg, #f0fdf4, var(--white));
      border: 1.5px solid #bbf7d0;
      border-radius: 12px; padding: 18px 22px;
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 16px;
    }
    .total-row .t-label { font-size: 15px; font-weight: 700; color: var(--forest); display: flex; align-items: center; gap: 8px; }
    .total-row .t-label svg, .total-row .t-label i[data-lucide] { width: 18px; height: 18px; }
    .total-row .t-amount { font-family: 'DM Serif Display', serif; font-size: 28px; color: var(--forest-mid); }

    /* ── Status pill ── */
    .pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 12px; border-radius: 20px;
      font-size: 12px; font-weight: 700; white-space: nowrap;
    }
    .pill svg, .pill i[data-lucide] { width: 11px; height: 11px; }
    .pill.paid    { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .pill.late    { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .pill.early   { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
    .pill.default { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; }

    /* ── Type / method chips ── */
    .type-pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 6px;
      font-size: 11px; font-weight: 700; white-space: nowrap;
      background: #ede9fe; color: #6d28d9;
    }
    .method-pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 6px;
      font-size: 11px; font-weight: 600; white-space: nowrap;
      background: #f0fdf4; color: var(--forest-mid); border: 1px solid #bbf7d0;
    }
    .type-pill svg, .type-pill i[data-lucide],
    .method-pill svg, .method-pill i[data-lucide] { width: 10px; height: 10px; }

    /* ── Receipt image blocks ── */
    .receipt-img-wrap { margin-bottom: 4px; }
    .receipt-img-label {
      font-size: 10px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .07em; color: var(--forest-mid);
      margin-bottom: 10px; display: flex; align-items: center; gap: 6px;
    }
    .receipt-img-label svg, .receipt-img-label i[data-lucide] { width: 12px; height: 12px; }
    .receipt-img {
      width: 100%; max-width: 420px; height: auto; display: block;
      border-radius: 12px; border: 2px solid var(--sage);
      background: var(--white); padding: 5px;
      box-shadow: 0 3px 10px rgba(0,0,0,.08);
    }

    /* ── Remarks block ── */
    .remarks-block {
      background: var(--sand); border: 1px solid #eaf3ea;
      border-radius: 10px; padding: 12px 15px; font-size: 13px;
      color: var(--ink); line-height: 1.5;
    }

    /* ── Divider ── */
    .divider { border: none; border-top: 1px solid var(--border); margin: 4px 0; }

    /* ── Action row ── */
    .action-row {
      display: flex; align-items: center; justify-content: center; gap: 12px;
      margin-top: 8px; flex-wrap: wrap;
    }
    .action-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 10px 20px; border-radius: 10px;
      font-size: 13px; font-weight: 600; text-decoration: none;
      border: none; cursor: pointer; white-space: nowrap;
      font-family: 'DM Sans', sans-serif; transition: background .2s, transform .1s;
    }
    .action-btn:active { transform: scale(.97); }
    .action-btn svg, .action-btn i[data-lucide] { width: 15px; height: 15px; }
    .action-btn.print { background: var(--forest); color: #fff; }
    .action-btn.print:hover { background: var(--forest-mid); transform: translateY(-1px); }
    .action-btn.back  { background: var(--white); color: var(--ink); border: 1.5px solid var(--border); }
    .action-btn.back:hover  { border-color: #9ca3af; background: #f9fafb; }

    /* ── Footer ── */
    .page-footer {
      text-align: center; padding: 20px 32px;
      color: #9ca3af; font-size: 12px;
      border-top: 1px solid var(--border); background: var(--white);
    }

    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 5px; }

    /* ── Print styles ── */
    @media print {
      .sidebar, .topbar, .action-row, .page-footer { display: none !important; }
      body { background: #fff; display: block; }
      .main { margin-left: 0 !important; }
      .page-body { padding: 0 !important; justify-content: flex-start; }
      .receipt-wrap { max-width: 100%; }
      .page-header { border-radius: 0; margin-bottom: 16px; print-color-adjust: exact; -webkit-print-color-adjust: exact; }
      .card { box-shadow: none; border: 1px solid #e5e7eb; break-inside: avoid; }
      .info-cell:hover { border-color: #eaf3ea !important; background: var(--sand) !important; }
      .total-row { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
    }

    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar, .page-body { padding-left: 16px; padding-right: 16px; }
    }
  </style>
</head>
<body>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC"
      style="width:40px;height:40px;object-fit:cover;border-radius:10px;flex-shrink:0;" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Admin Portal</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="{{route('Admin.dashboard')}}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Overview
    </a>
    <a href="{{route('Manage.Members')}}" class="nav-item">
      <i data-lucide="user-plus"></i> Member Registration
    </a>
    <a href="{{route('Member.List')}}" class="nav-item">
      <i data-lucide="users"></i> Official Members
    </a>

    <div class="nav-section-label">Finance</div>
    <a href="{{route('LoanApp.list')}}" class="nav-item">
      <i data-lucide="file-text"></i> Loan Applications
    </a>
    <a href="{{route('Loan.Records')}}" class="nav-item active">
      <i data-lucide="badge-check"></i> Approved Loans
    </a>
    <a href="{{route('Payment.Page')}}" class="nav-item">
      <i data-lucide="credit-card"></i> Payment
    </a>
    <a href="{{route('Add.Transactions')}}" class="nav-item">
      <i data-lucide="arrow-left-right"></i> Transactions
    </a>
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item">
      <i data-lucide="piggy-bank"></i> Shared Capital
    </a>

    <div class="nav-section-label">Reports</div>
    <a href="{{route('Admin.Reports')}}" class="nav-item">
      <i data-lucide="bar-chart-2"></i> Cooperative Reports
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="{{route('Admin.Settings')}}" class="nav-item">
      <i data-lucide="settings"></i> Settings
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-card" id="user-menu-button">
            <div class="avatar">
        @if(auth('admin')->check() && auth('admin')->user()->profile_picture)
          <img src="{{ asset('images/profile_pictures/' . auth('admin')->user()->profile_picture) }}" alt="Profile" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
        @else
          A
        @endif
      </div>
      <div class="user-info">
        <div class="name">Admin</div>
        <div class="role">Super Administrator</div>
      </div>
      <i data-lucide="more-vertical" style="margin-left:auto;opacity:.4;width:14px;height:14px;"></i>
    </div>
    <div id="user-menu-dropdown">
      <a href="#" class="dropdown-item normal">
        <i data-lucide="user" style="width:14px;height:14px;"></i> Profile
      </a>
      <a href="{{route('Admin.Settings')}}" class="dropdown-item normal">
        <i data-lucide="settings" style="width:14px;height:14px;"></i> Settings
      </a>
      <a href="{{route('Admin.Logout')}}" class="dropdown-item danger">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="breadcrumb">
      <a href="{{route('Loan.Records')}}">Approved Loans</a>
      <i data-lucide="chevron-right"></i>
      <a href="{{ url()->previous() }}">Payment History</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">Receipt #{{ $Record->id }}</span>
    </div>
    <div class="topbar-spacer"></div>
    <button onclick="window.print()" class="print-btn">
      <i data-lucide="printer"></i> Print Receipt
    </button>
  </header>

  <!-- Page body -->
  <div class="page-body">
    <div class="receipt-wrap">

      <!-- Page header banner -->
      <div class="page-header">
        <div class="page-header-content">
          <div class="page-header-eyebrow">Official Receipt</div>
          <h2>Payment Receipt</h2>
          <p>{{ $Record->last_name }}, {{ $Record->first_name }} {{ $Record->middle_name }}</p>
          <div class="receipt-num-tag">
            <i data-lucide="hash"></i> Receipt #{{ $Record->id }}
          </div>
        </div>
        <div class="page-header-right">
          <div class="header-amount-box">
            <div class="ha-label">Amount Paid</div>
            <div class="ha-amount">₱{{ number_format($Record->payment_amount, 2) }}</div>
            <div class="ha-date">{{ \Carbon\Carbon::parse($Record->transaction_date)->format('M d, Y') }}</div>
          </div>
        </div>
      </div>

      <!-- Total amount highlight -->
      <div class="total-row">
        <span class="t-label">
          <i data-lucide="circle-check-big"></i>
          Total Amount Paid
        </span>
        <span class="t-amount">₱ {{ number_format($Record->payment_amount, 2) }}</span>
      </div>

      <!-- Member + Payment Info -->
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="user"></i></div>
          <div>
            <div class="card-head-title">Member &amp; Payment Details</div>
            <div class="card-head-sub">Transaction information for this receipt</div>
          </div>
        </div>
        <div class="card-body">
          <div class="info-grid">
            <div class="info-cell">
              <div class="lbl">Member ID: </div>
              <div class="data">{{ $Record->member_id }}</div>
            </div>
            <div class="info-cell">
              <div class="lbl">Full Name</div>
              <div class="data">{{ $Record->last_name }}, {{ $Record->first_name }} {{ $Record->middle_name }}</div>
            </div>
            <div class="info-cell span2">
              <div class="lbl">Loan Number: </div>
              <div class="data mono">
                @if(!empty($Record->loan_number))
                  {{ $Record->loan_number }}
                @else
                  —
                @endif
              </div>
            </div>
            @php
              $refDigits = preg_replace('/\D+/', '', (string) $Record->reference_number);
              $refFormatted = $Record->reference_number;
              if (strlen($refDigits) === 13) {
                  $refFormatted = substr($refDigits, 0, 4) . '—' . substr($refDigits, 4, 4) . '—' . substr($refDigits, 8);
              }
            @endphp
            <div class="info-cell">
              <div class="lbl">Reference Number</div>
              <div class="data mono">{{ $refFormatted }}</div>
            </div>
            <div class="info-cell">
              <div class="lbl">Transaction Date</div>
              <div class="data">{{ \Carbon\Carbon::parse($Record->transaction_date)->format('F d, Y \a\t h:i A') }}</div>
            </div>
            <div class="info-cell">
              <div class="lbl">Transaction Type</div>
              <div class="data">
                <span class="type-pill">
                  <i data-lucide="tag" style="width:10px;height:10px;"></i>
                  {{ $Record->transaction_type }}
                </span>
              </div>
            </div>
            <div class="info-cell">
              <div class="lbl">Payment Method</div>
              <div class="data">
                <span class="method-pill">
                  <i data-lucide="wallet" style="width:10px;height:10px;"></i>
                  {{ $Record->payment_method }}
                </span>
              </div>
            </div>
            <div class="info-cell">
              <div class="lbl">Payment Status</div>
              <div class="data">
                @php
                  $s = strtolower($Record->payment_status);
                  $pillClass = match($s) {
                    'paid'  => 'paid',
                    'late'  => 'late',
                    'early' => 'early',
                    default => 'default',
                  };
                  $pillIcon = match($s) {
                    'paid'  => 'circle-check',
                    'late'  => 'clock',
                    'early' => 'zap',
                    default => 'minus',
                  };
                @endphp
                <span class="pill {{ $pillClass }}">
                  <i data-lucide="{{ $pillIcon }}" style="width:11px;height:11px;"></i>
                  {{ $Record->payment_status }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      @if($Record->remarks)
      <!-- Remarks -->
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="message-square"></i></div>
          <div>
            <div class="card-head-title">Remarks</div>
          </div>
        </div>
        <div class="card-body">
          <div class="remarks-block">{{ $Record->remarks }}</div>
        </div>
      </div>
      @endif

      @if(isset($AdminMimeType) && isset($MemberMimeType))
      <!-- Receipt images -->
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="image"></i></div>
          <div>
            <div class="card-head-title">Receipt Copies</div>
            <div class="card-head-sub">Coop copy and member copy attached below</div>
          </div>
        </div>
        <div class="card-body">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div class="receipt-img-wrap">
              <div class="receipt-img-label">
                <i data-lucide="building-2"></i> Coop Copy
              </div>
              <img src="data:{{ $AdminMimeType }};base64,{{ $AdminBase64 }}" alt="Coop Copy" class="receipt-img">
            </div>
            <div class="receipt-img-wrap">
              <div class="receipt-img-label">
                <i data-lucide="user"></i> Member Copy
              </div>
              <img src="data:{{ $MemberMimeType }};base64,{{ $MemberBase64 }}" alt="Member Copy" class="receipt-img">
            </div>
          </div>
        </div>
      </div>
      @endif

      <!-- Handler info -->
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="user-check"></i></div>
          <div>
            <div class="card-head-title">Processed By</div>
            <div class="card-head-sub">Administrative record of this transaction</div>
          </div>
        </div>
        <div class="card-body">
          <div class="info-grid">
            <div class="info-cell">
              <div class="lbl">Transaction Handler</div>
              <div class="data">{{ $Record->transaction_handler }}</div>
            </div>
            <div class="info-cell">
              <div class="lbl">Updated By</div>
              <div class="data">{{ $Record->updater_name }}</div>
            </div>
          </div>
        </div>
      </div>


    </div><!-- /receipt-wrap -->
  </div><!-- /page-body -->

  <footer class="page-footer">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div>

<script>
  lucide.createIcons();

  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });
</script>
</body>
</html>