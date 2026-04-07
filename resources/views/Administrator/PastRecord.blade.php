<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Past Record | GBLDC Admin</title>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
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
      --violet:    #8b5cf6;
      --rose:      #ef4444;
      --sidebar-w: 240px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--sand);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
    }

    /* ══════════════════════════════════
       SIDEBAR
    ══════════════════════════════════ */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--forest);
      color: #fff;
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 100;
      transition: transform .3s ease;
    }

    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .sidebar-logo img { width: 40px; height: 40px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2; }
    .logo-sub  { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-nav {
      flex: 1; padding: 16px 12px; overflow-y: auto;
    }
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
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    .sidebar-footer {
      padding: 16px 12px;
      border-top: 1px solid rgba(255,255,255,.1);
    }
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
    .user-info .role { font-size: 11px; opacity: .5; }

    #user-menu-dropdown {
      display: none; background: #0a3d27;
      border-radius: 10px; padding: 6px; margin-top: 6px;
    }
    #user-menu-dropdown a {
      display: flex; align-items: center; gap: 8px;
      padding: 8px 12px; color: rgba(255,255,255,.8);
      text-decoration: none; font-size: 13px; border-radius: 7px;
      transition: background .15s;
    }
    #user-menu-dropdown a:hover { background: rgba(255,255,255,.08); }
    #user-menu-dropdown a.logout { color: #f87171; }
    #user-menu-dropdown i[data-lucide] { width: 14px; height: 14px; }

    /* ══════════════════════════════════
       MAIN
    ══════════════════════════════════ */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Topbar */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 50;
    }
    .topbar-left { display: flex; align-items: center; gap: 14px; }
    .back-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      transition: background .2s; white-space: nowrap;
    }
    .back-btn:hover { background: #a7f3d0; }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }
    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 20px; font-weight: 700; color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    .topbar-right { display: flex; align-items: center; gap: 10px; }

    /* Type badge */
    .type-badge {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 6px 14px; border-radius: 20px;
      font-size: 12px; font-weight: 700;
    }
    .type-badge.loan    { background: #dbeafe; color: #1e40af; }
    .type-badge.capital { background: #dcfce7; color: #166534; }
    .type-badge.default { background: #f3f4f6; color: #374151; }
    .type-badge i[data-lucide] { width: 13px; height: 13px; }

    /* Page body */
    .page-body { padding: 28px 32px; flex: 1; }

    /* Member hero card */
    .member-hero {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 24px 28px;
      color: #fff;
      display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 16px;
      margin-bottom: 24px;
      position: relative; overflow: hidden;
    }
    .member-hero::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05); pointer-events: none;
    }
    .member-hero::after {
      content: ''; position: absolute; bottom: -60px; right: 120px;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(255,255,255,.04); pointer-events: none;
    }
    .hero-left { position: relative; z-index: 1; }
    .hero-eyebrow {
      font-size: 11px; font-weight: 600; letter-spacing: .12em;
      text-transform: uppercase; opacity: .6; margin-bottom: 6px;
      display: flex; align-items: center; gap: 8px;
    }
    .hero-eyebrow::before { content: ''; width: 20px; height: 2px; background: var(--emerald); border-radius: 2px; display: inline-block; }
    .hero-left h2 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700; margin-bottom: 6px;
    }
    .hero-left p { font-size: 13px; opacity: .7; }
    .hero-right { position: relative; z-index: 1; text-align: right; }
    .member-id-badge {
      background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
      border-radius: 10px; padding: 10px 18px;
      display: inline-flex; align-items: center; gap: 8px;
      font-size: 13px; font-weight: 600;
    }
    .member-id-badge i[data-lucide] { width: 14px; height: 14px; color: var(--emerald); }

    /* Section label */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* Table card */
    .table-card {
      background: var(--white);
      border-radius: 14px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .table-card-header {
      padding: 18px 22px 14px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
      flex-wrap: wrap; gap: 10px;
    }
    .table-card-header h3 {
      font-size: 15px; font-weight: 600; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .table-card-header h3 i[data-lucide] { width: 16px; height: 16px; }

    /* DataTable overrides */
    .dataTables_wrapper {
      padding: 16px 22px 20px;
    }
    .dataTables_wrapper .dataTables_filter input {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 7px 12px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      outline: none;
      transition: border-color .2s;
    }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: var(--emerald); }
    .dataTables_wrapper .dataTables_filter label { font-size: 13px; color: var(--muted); }
    .dataTables_wrapper .dataTables_length select {
      border: 1px solid var(--border); border-radius: 8px;
      padding: 5px 8px; font-family: 'DM Sans', sans-serif;
      font-size: 13px; outline: none;
    }
    .dataTables_wrapper .dataTables_length label { font-size: 13px; color: var(--muted); }
    .dataTables_wrapper .dataTables_info { font-size: 12px; color: var(--muted); }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border-radius: 8px !important;
      font-size: 13px !important;
      padding: 5px 10px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background: var(--forest) !important;
      border-color: var(--forest) !important;
      color: #fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: var(--sage) !important;
      border-color: var(--sage) !important;
      color: var(--forest) !important;
    }

    table.dataTable {
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      border-collapse: collapse !important;
      width: 100% !important;
    }
    table.dataTable thead tr { background: #f9fafb; }
    table.dataTable thead th {
      padding: 10px 14px !important;
      font-size: 11px !important; letter-spacing: .06em;
      text-transform: uppercase; color: var(--muted) !important;
      font-weight: 600 !important;
      border-bottom: 1px solid var(--border) !important;
      border-top: none !important;
    }
    table.dataTable.no-footer { border-bottom: none !important; }
    table.dataTable tbody tr {
      border-top: 1px solid var(--border);
      transition: background .15s;
    }
    table.dataTable tbody tr:hover { background: #f9fafb; }
    table.dataTable tbody td {
      padding: 11px 14px !important;
      color: var(--ink); vertical-align: middle;
    }

    /* Pills / badges */
    .pill {
      display: inline-block;
      font-size: 11px; font-weight: 600;
      padding: 3px 9px; border-radius: 20px;
    }
    .pill.active   { background: #dcfce7; color: #166534; }
    .pill.closed   { background: #f3f4f6; color: #374151; }
    .pill.overdue  { background: #fee2e2; color: #dc2626; }
    .pill.paid     { background: #dbeafe; color: #1e40af; }
    .pill.pending  { background: #fef3c7; color: #92400e; }

    .loan-num {
      font-size: 11px; font-weight: 600;
      background: #f3f4f6; color: #374151;
      padding: 3px 8px; border-radius: 6px;
      font-family: monospace; letter-spacing: .03em;
    }

    .amt { color: var(--forest-mid); font-weight: 600; }

    /* Action buttons */
    .action-btn {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 5px 11px; border-radius: 8px;
      font-size: 12px; font-weight: 600;
      text-decoration: none; white-space: nowrap;
      transition: background .15s, transform .1s;
    }
    .action-btn:active { transform: scale(.97); }
    .action-btn.green { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .action-btn.green:hover { background: #bbf7d0; }
    .action-btn.blue  { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
    .action-btn.blue:hover  { background: #bfdbfe; }
    .action-btn i[data-lucide] { width: 12px; height: 12px; }

    .actions-cell { display: flex; gap: 6px; flex-wrap: wrap; }

    /* Muted text */
    .muted { color: var(--muted); }

    /* Empty state */
    .empty-row td {
      text-align: center; padding: 32px !important;
      color: var(--muted); font-size: 13px;
    }

    /* Scrollbar */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* Responsive */
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar, .page-body { padding-left: 18px; padding-right: 18px; }
    }
  
    /* RESPONSIVE INJECT */
    .mobile-toggle { display: none; }
    .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 99; }
    .sidebar-overlay.show { display: block; }
    @media (max-width: 900px) {
      :root { --sidebar-w: 0px !important; }
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; width: 260px !important; z-index: 100 !important; }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0 !important; width: 100% !important; min-width: 100vw; }
      .mobile-toggle { display: flex !important; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; border: none; background: #f3f4f6; color: var(--ink); cursor: pointer; flex-shrink: 0; margin-right: 12px; }
      .topbar { padding: 14px 16px !important; }
      .tables-grid, .stats-grid, .loan-grid, .kpi-strip { grid-template-columns: 1fr !important; }
      .page-body { padding: 16px !important; }
      .topbar-left, .topbar-title { display: flex !important; align-items: center !important; }
      .hide-mobile { display: none !important; }
    }
</style>

</head>
<body>

<!-- ═══════════════════════════════════
     SIDEBAR
═══════════════════════════════════ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Admin Dashboard</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="{{ route('LoanApp.list') }}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Overview
    </a>
    <a href="{{route('Manage.Members')}}" class="nav-item">
      <i data-lucide="user-plus"></i> Member Registration
    </a>
    <a href="{{route('Member.List')}}" class="nav-item">
      <i data-lucide="users"></i> Official Members
    </a>

    <div class="nav-section-label">Finance</div>
    <a href="{{route('LoanApp.list')}}" class="nav-item active">
      <i data-lucide="file-text"></i> Loan Applications
    </a>
    <a href="{{route('Loan.Records')}}" class="nav-item">
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
    <a href="#" class="nav-item">
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
      <a href="#"><i data-lucide="user"></i> Profile</a>
      <a href="{{route('Admin.manage')}}"><i data-lucide="shield-check"></i> Manage Users</a>
      <a href="#"><i data-lucide="settings"></i> Settings</a>
      <a href="{{ route('Admin.Logout') }}" class="logout"><i data-lucide="log-out"></i> Logout</a>
    </div>
  </div>
</aside>

<!-- ═══════════════════════════════════
     MAIN
═══════════════════════════════════ -->
<div class="main">

  <!-- Topbar -->
  <div class="sidebar-overlay" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebar-overlay').classList.remove('show');"></div>
<header class="topbar">
  <div class="topbar-left" style="display:flex; align-items:center;">
    <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');" style="margin-right:12px;">
      <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
      <a href="{{route('LoanApp.list')}}" class="back-btn">
        <i data-lucide="arrow-left"></i> Back to Loan List
      </a>
      <div class="topbar-title">
        <h1>Past Record</h1>
        <p>Viewing historical records for Member #{{$ID}}</p>
      </div>
    </div>
    <div class="topbar-right">
      @if($type === 'loan')
        <span class="type-badge loan"><i data-lucide="banknote"></i> Loan History</span>
      @elseif($type === 'shared_capital')
        <span class="type-badge capital"><i data-lucide="piggy-bank"></i> Shared Capital</span>
      @else
        <span class="type-badge default"><i data-lucide="clock"></i> General Records</span>
      @endif
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Member Hero -->
    <div class="member-hero">
      <div class="hero-left">
        <div class="hero-eyebrow">Record Review</div>
        <h2>
          @if($type === 'loan') Loan Record History
          @elseif($type === 'shared_capital') Shared Capital History
          @else Past Transactions
          @endif
        </h2>
        <p>Complete historical records associated with this member account.</p>
      </div>
      <div class="hero-right">
        <div class="member-id-badge">
          <i data-lucide="id-card"></i>
          Member ID: <strong>{{$ID}}</strong>
        </div>
      </div>
    </div>

    <!-- Records Table -->
    <div class="section-label">
      @if($type === 'loan') Loan Records
      @elseif($type === 'shared_capital') Shared Capital Records
      @else Transaction Records
      @endif
    </div>

    <div class="table-card">
      <div class="table-card-header">
        <h3>
          @if($type === 'loan')
            <i data-lucide="banknote" style="color:var(--sky);"></i>
            Loan History — Member {{$ID}}
          @elseif($type === 'shared_capital')
            <i data-lucide="piggy-bank" style="color:var(--emerald);"></i>
            Shared Capital History — Member {{$ID}}
          @else
            <i data-lucide="clock" style="color:var(--amber);"></i>
            Transaction History — Member {{$ID}}
          @endif
        </h3>
      </div>

      <div style="overflow-x:auto;">

        {{-- ══ LOAN TABLE ══ --}}
        @if($type === 'loan')
        <table id="recordTable" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Name</th>
              <th>Loan Number</th>
              <th>Loan Type</th>
              <th>Loan Amount</th>
              <th>Loan Balance</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ShowRecords as $ShowRecord)
            <tr>
              <td class="muted">{{$ShowRecord->member_id}}</td>
              <td style="font-weight:500;">{{$ShowRecord->last_name}}, {{$ShowRecord->first_name}} {{$ShowRecord->middle_name}}</td>
              <td><span class="loan-num">{{$ShowRecord->loan_number}}</span></td>
              <td>{{$ShowRecord->loan_type}}</td>
              <td><span class="amt">₱{{number_format($ShowRecord->loan_amount, 2)}}</span></td>
              <td><span class="amt">₱{{number_format($ShowRecord->loan_balance, 2)}}</span></td>
              <td>
                @php $s = strtolower($ShowRecord->loan_status ?? ''); @endphp
                @if(str_contains($s, 'active'))
                  <span class="pill active">Active</span>
                @elseif(str_contains($s, 'paid') || str_contains($s, 'closed'))
                  <span class="pill paid">Paid</span>
                @elseif(str_contains($s, 'overdue'))
                  <span class="pill overdue">Overdue</span>
                @else
                  <span class="pill pending">{{$ShowRecord->loan_status}}</span>
                @endif
              </td>
              <td>
                <div class="actions-cell">
                  <a href="{{route('View.Member.Loan', $ShowRecord->loan_number)}}" class="action-btn green">
                    <i data-lucide="eye"></i> View
                  </a>
                  <a href="{{ route('Loan.Payment.History.Detail', $ShowRecord->loan_number) }}" class="action-btn blue">
                    <i data-lucide="receipt"></i> Payments
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{-- ══ SHARED CAPITAL TABLE ══ --}}
        @elseif($type === 'shared_capital')
        <table id="recordTable" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Name</th>
              <th>SC Amount</th>
              <th>SC Balance</th>
              <th>Date of Membership</th>
              <th>Encoded By</th>
              <th>Remarks</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ShowRecords as $ShowRecord)
            <tr>
              <td class="muted">{{$ShowRecord->member_id}}</td>
              <td style="font-weight:500;">{{$ShowRecord->last_name}}, {{$ShowRecord->first_name}} {{$ShowRecord->middle_name}}</td>
              <td><span class="amt">₱{{number_format($ShowRecord->shared_capital_amount, 2)}}</span></td>
              <td><span class="amt">₱{{number_format($ShowRecord->shared_capital_amount_balance, 2)}}</span></td>
              <td class="muted">{{$ShowRecord->date_of_membership}}</td>
              <td class="muted">{{$ShowRecord->encoded_by}}</td>
              <td class="muted">{{$ShowRecord->remarks}}</td>
              <td>
                <a href="{{route('View.SCP.History.Detail', $ShowRecord->member_id)}}" class="action-btn green">
                  <i data-lucide="receipt"></i> Payment History
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{-- ══ DEFAULT / TRANSACTION TABLE ══ --}}
        @else
        <table id="recordTable" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Name</th>
              <th>Reference No.</th>
              <th>Type</th>
              <th>Status</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ShowRecords as $ShowRecord)
            <tr>
              <td class="muted">{{$ShowRecord->member_id}}</td>
              <td style="font-weight:500;">{{$ShowRecord->last_name}}, {{$ShowRecord->first_name}} {{$ShowRecord->middle_name}}</td>
              <td><span class="loan-num">{{$ShowRecord->reference_number}}</span></td>
              <td>{{$ShowRecord->transaction_type}}</td>
              <td>
                @php $ps = strtolower($ShowRecord->payment_status ?? ''); @endphp
                @if(str_contains($ps, 'paid') || str_contains($ps, 'complete'))
                  <span class="pill paid">{{$ShowRecord->payment_status}}</span>
                @elseif(str_contains($ps, 'pending'))
                  <span class="pill pending">{{$ShowRecord->payment_status}}</span>
                @else
                  <span class="pill closed">{{$ShowRecord->payment_status}}</span>
                @endif
              </td>
              <td><span class="amt">₱{{number_format($ShowRecord->payment_amount, 2)}}</span></td>
              <td class="muted">{{ \Carbon\Carbon::parse($ShowRecord->transaction_date)->format('M d, Y') }}</td>
              <td>
                <a href="{{route('Review.Past.Record', $ShowRecord->id)}}" class="action-btn green">
                  <i data-lucide="eye"></i> View
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif

      </div><!-- overflow -->
    </div><!-- table-card -->

  </div><!-- /page-body -->

  <footer style="padding:18px 32px; border-top:1px solid var(--border); background:var(--white); font-size:12px; color:var(--muted); text-align:center;">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div><!-- /main -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  // ── Lucide icons ────────────────────────────────
  lucide.createIcons();

  // ── User menu ───────────────────────────────────
  const userBtn      = document.getElementById('user-menu-button');
  const userDropdown = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userDropdown.style.display = userDropdown.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userDropdown.style.display = 'none'; });

  // ── DataTable ───────────────────────────────────
  $(document).ready(function () {
    $('#recordTable').DataTable({
      responsive: true,
      fixedHeader: true,
      language: {
        search:      '',
        searchPlaceholder: 'Search records…',
        lengthMenu:  'Show _MENU_ entries',
        info:        'Showing _START_–_END_ of _TOTAL_ records',
        infoEmpty:   'No records found',
        zeroRecords: 'No matching records found',
        paginate: { previous: '‹', next: '›' }
      },
      columnDefs: [
        { orderable: false, targets: -1 }   // disable sort on Actions column
      ]
    });
  });
</script>
</body>
</html>