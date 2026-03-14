<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Loan Payment History | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

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
      padding: 10px; border-radius: 10px;
      cursor: pointer; transition: background .2s;
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
      font-size: 13px; color: var(--muted);
    }
    .breadcrumb a { color: var(--forest-mid); text-decoration: none; font-weight: 600; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg, .breadcrumb i[data-lucide] { width: 12px; height: 12px; opacity: .4; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }
    .topbar-spacer { flex: 1; }

    /* ── Page body ── */
    .page-body { padding: 32px 32px 80px; flex: 1; width: 100%; }

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
      content: ''; position: absolute; bottom: -60px; right: 120px;
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
    .loan-tag {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 8px; padding: 5px 12px;
      font-size: 12px; font-weight: 600; color: rgba(255,255,255,.85);
      font-family: monospace; letter-spacing: .04em;
    }
    .loan-tag svg, .loan-tag i[data-lucide] { width: 12px; height: 12px; color: var(--emerald); }

    .page-header-right { position: relative; z-index: 1; flex-shrink: 0; }

    /* Header stat boxes */
    .header-stats {
      display: flex; flex-direction: column; gap: 8px; align-items: flex-end;
    }
    .header-stat-box {
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 12px; padding: 12px 18px; text-align: right; min-width: 160px;
    }
    .header-stat-box .hs-label { font-size: 10px; opacity: .65; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 2px; }
    .header-stat-box .hs-value { font-family: 'DM Serif Display', serif; font-size: 20px; color: #fff; }

    /* ── Summary strip ── */
    .summary-strip { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; margin-bottom: 24px; }
    @media (max-width: 760px) { .summary-strip { grid-template-columns: 1fr 1fr; } }

    .sum-card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 12px; padding: 15px 16px;
      display: flex; align-items: center; gap: 12px;
    }
    .sum-icon {
      width: 38px; height: 38px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .sum-icon svg, .sum-icon i[data-lucide] { width: 18px; height: 18px; }
    .sum-icon.green  { background: #dcfce7; color: var(--forest-mid); }
    .sum-icon.amber  { background: #fef3c7; color: #d97706; }
    .sum-icon.sky    { background: #e0f2fe; color: #0284c7; }
    .sum-icon.rose   { background: #fee2e2; color: #dc2626; }
    .s-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: 3px; }
    .s-value { font-size: 14px; font-weight: 700; color: var(--ink); }
    .s-value.green { color: var(--forest-mid); }
    .s-value.amber { color: #d97706; }
    .s-value.sky   { color: #0284c7; }
    .s-value.rose  { color: #dc2626; }

    /* ── Section label ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* ── Table card ── */
    .table-card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; overflow: hidden;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .table-card-head {
      padding: 18px 24px; display: flex; align-items: center; gap: 12px;
      border-bottom: 1px solid var(--border);
    }
    .table-card-icon {
      width: 36px; height: 36px; border-radius: 10px; background: var(--sage);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .table-card-icon svg, .table-card-icon i[data-lucide] { width: 18px; height: 18px; color: var(--forest-mid); }
    .table-card-title { font-size: 15px; font-weight: 700; color: var(--ink); }
    .table-card-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .table-card-body  { padding: 20px 24px; }

    /* ── DataTable overrides ── */
    table.dataTable { border-collapse: collapse !important; width: 100% !important; font-family: 'DM Sans', sans-serif; }
    table.dataTable thead th {
      background: var(--sand) !important; color: var(--muted) !important;
      font-size: 10px !important; font-weight: 700 !important;
      text-transform: uppercase !important; letter-spacing: .07em !important;
      padding: 12px 14px !important; border-bottom: 2px solid var(--border) !important;
      border-top: none !important; white-space: nowrap;
    }
    table.dataTable tbody td {
      padding: 12px 14px !important; font-size: 13px !important;
      color: var(--ink) !important; border-bottom: 1px solid #f3f4f6 !important;
      vertical-align: middle !important;
    }
    table.dataTable tbody tr:hover td { background: #f9fffe !important; }
    table.dataTable tbody tr:last-child td { border-bottom: none !important; }

    .dataTables_wrapper .dataTables_filter input {
      border: 1.5px solid var(--border) !important; border-radius: 9px !important;
      padding: 7px 12px !important; font-size: 13px !important;
      font-family: 'DM Sans', sans-serif !important; outline: none !important;
      transition: border-color .15s !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
      border-color: var(--emerald) !important; box-shadow: 0 0 0 3px rgba(34,197,94,.1) !important;
    }
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label { font-size: 13px !important; color: var(--muted) !important; font-family: 'DM Sans', sans-serif !important; }
    .dataTables_wrapper .dataTables_length select {
      border: 1.5px solid var(--border) !important; border-radius: 8px !important;
      padding: 5px 8px !important; font-size: 13px !important; font-family: 'DM Sans', sans-serif !important;
    }
    .dataTables_wrapper .dataTables_info { font-size: 12px !important; color: var(--muted) !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border-radius: 8px !important; font-size: 13px !important;
      font-family: 'DM Sans', sans-serif !important;
      border: none !important; padding: 5px 10px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background: var(--forest) !important; color: #fff !important; border: none !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: var(--sage) !important; color: var(--forest) !important; border: none !important;
    }

    /* ── Status pills ── */
    .pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 20px;
      font-size: 11px; font-weight: 700; white-space: nowrap;
    }
    .pill svg, .pill i[data-lucide] { width: 10px; height: 10px; }
    .pill.paid    { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .pill.late    { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .pill.early   { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
    .pill.default { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; }

    /* ── Type pill ── */
    .type-pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 6px;
      font-size: 11px; font-weight: 700; white-space: nowrap;
      background: #ede9fe; color: #6d28d9;
    }
    .type-pill svg, .type-pill i[data-lucide] { width: 10px; height: 10px; }

    /* ── Method pill ── */
    .method-pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 6px;
      font-size: 11px; font-weight: 600; white-space: nowrap;
      background: #f0fdf4; color: var(--forest-mid);
      border: 1px solid #bbf7d0;
    }
    .method-pill svg, .method-pill i[data-lucide] { width: 10px; height: 10px; }

    /* ── Amount cell ── */
    .amount-cell { font-weight: 700; color: var(--forest-mid); font-size: 13px !important; }

    /* ── Action button ── */
    .action-btn {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 6px 11px; border-radius: 8px;
      font-size: 12px; font-weight: 600; text-decoration: none;
      border: none; cursor: pointer; white-space: nowrap;
      font-family: 'DM Sans', sans-serif; transition: background .15s, transform .1s;
    }
    .action-btn:active { transform: scale(.96); }
    .action-btn svg, .action-btn i[data-lucide] { width: 13px; height: 13px; }
    .action-btn.view { background: #dbeafe; color: #1d4ed8; }
    .action-btn.view:hover { background: #bfdbfe; }

    /* ── Footer ── */
    .page-footer {
      text-align: center; padding: 20px 32px;
      color: #9ca3af; font-size: 12px;
      border-top: 1px solid var(--border); background: var(--white);
    }

    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 5px; }

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
      <div class="logo-sub">Admin Dashboard</div>
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
      <div class="avatar">A</div>
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
    <a href="{{route('Loan.Records')}}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="breadcrumb">
      <a href="{{route('Loan.Records')}}">Approved Loans</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">Payment History</span>
    </div>
    <div class="topbar-spacer"></div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Page header banner -->
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-header-eyebrow">Loan Payment History</div>
        <h2>Payment Transactions</h2>
        <p>All recorded payments for this loan account.</p>
        @if(isset($payments) && $payments->isNotEmpty())
          <div class="loan-tag">
            <i data-lucide="hash"></i> {{ $payments->first()->loan_number ?? 'Loan Account' }}
          </div>
        @endif
      </div>
      <div class="page-header-right">
        <div class="header-stats">
          <div class="header-stat-box">
            <div class="hs-label">Total Payments</div>
            <div class="hs-value" id="hdr-total">—</div>
          </div>
          <div class="header-stat-box">
            <div class="hs-label">Total Paid</div>
            <div class="hs-value" id="hdr-paid">—</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Summary strip -->
    <div class="summary-strip">
      <div class="sum-card">
        <div class="sum-icon green"><i data-lucide="circle-check-big"></i></div>
        <div>
          <div class="s-label">Paid On Time</div>
          <div class="s-value green" id="stat-paid">0</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon sky"><i data-lucide="zap"></i></div>
        <div>
          <div class="s-label">Early Payments</div>
          <div class="s-value sky" id="stat-early">0</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon amber"><i data-lucide="clock"></i></div>
        <div>
          <div class="s-label">Late Payments</div>
          <div class="s-value amber" id="stat-late">0</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon rose"><i data-lucide="banknote"></i></div>
        <div>
          <div class="s-label">Total Amount</div>
          <div class="s-value rose" id="stat-total-amt">₱0.00</div>
        </div>
      </div>
    </div>

    <!-- Table card -->
    <div class="section-label">Transaction Log</div>
    <div class="table-card">
      <div class="table-card-head">
        <div class="table-card-icon"><i data-lucide="receipt"></i></div>
        <div>
          <div class="table-card-title">Payment History</div>
          <div class="table-card-sub">All payment transactions — sorted newest first</div>
        </div>
      </div>
      <div class="table-card-body">
        <table id="paymentTable" class="display responsive nowrap w-full">
          <thead>
            <tr>
              <th>Date</th>
              <th>Reference No.</th>
              <th>Type</th>
              <th>Method</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($payments as $payment)
            <tr
              data-amount="{{ $payment->payment_amount }}"
              data-status="{{ strtolower($payment->payment_status) }}"
            >
              <td>{{ \Carbon\Carbon::parse($payment->transaction_date)->format('M d, Y') }}</td>
              <td style="font-family:monospace;font-size:12px;letter-spacing:.03em;">{{ $payment->reference_number }}</td>
              <td>
                <span class="type-pill">
                  <i data-lucide="tag" style="width:10px;height:10px;"></i>
                  {{ $payment->transaction_type }}
                </span>
              </td>
              <td>
                <span class="method-pill">
                  <i data-lucide="wallet" style="width:10px;height:10px;"></i>
                  {{ $payment->payment_method }}
                </span>
              </td>
              <td class="amount-cell">₱{{ number_format($payment->payment_amount, 2) }}</td>
              <td>
                @php
                  $s = strtolower($payment->payment_status);
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
                  <i data-lucide="{{ $pillIcon }}" style="width:10px;height:10px;"></i>
                  {{ $payment->payment_status }}
                </span>
              </td>
              <td>
                <a href="{{ route('view_details', $payment->id) }}" class="action-btn view">
                  <i data-lucide="eye" style="width:13px;height:13px;"></i> View
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td style="text-align:center;padding:32px;color:var(--muted);" colspan="1">
                <i data-lucide="inbox" style="width:28px;height:28px;display:block;margin:0 auto 8px;opacity:.3;"></i>
                No payment history found.
              </td>
              <td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div><!-- /page-body -->

  <footer class="page-footer">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  lucide.createIcons();

  // User menu
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // ── DataTable ──
  $(document).ready(function () {
    $('#paymentTable').DataTable({
      responsive: true,
      order: [[0, 'desc']],
      columnDefs: [
        { targets: 4, className: 'amount-cell' },
        { targets: 6, orderable: false, responsivePriority: 1 }
      ],
      language: {
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ payments",
        infoEmpty: "No payments found",
        zeroRecords: "No matching payments found"
      },
      drawCallback: function () { lucide.createIcons(); }
    });

    // ── Compute summary stats ──
    let paidCount = 0, earlyCount = 0, lateCount = 0;
    let totalAmt = 0, totalRows = 0;

    $('#paymentTable tbody tr').each(function () {
      const amt    = parseFloat($(this).data('amount')) || 0;
      const status = ($(this).data('status') || '').toLowerCase();
      if (!$(this).find('td[colspan]').length) {
        totalRows++;
        totalAmt += amt;
        if (status === 'paid')  paidCount++;
        if (status === 'early') earlyCount++;
        if (status === 'late')  lateCount++;
      }
    });

    const fmt = n => '₱' + n.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    document.getElementById('hdr-total').textContent     = totalRows;
    document.getElementById('hdr-paid').textContent      = fmt(totalAmt);
    document.getElementById('stat-paid').textContent     = paidCount;
    document.getElementById('stat-early').textContent    = earlyCount;
    document.getElementById('stat-late').textContent     = lateCount;
    document.getElementById('stat-total-amt').textContent = fmt(totalAmt);
  });
</script>
</body>
</html>