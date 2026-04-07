<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Transactions | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
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

    /* ── Sidebar ── */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--forest);
      color: #fff;
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 100;
    }

    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }

    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700;
      line-height: 1.2; color: #fff;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

    .nav-section-label {
      font-size: 10px; letter-spacing: .1em;
      text-transform: uppercase; opacity: .4;
      padding: 16px 8px 6px;
    }

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
    .nav-item svg,
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
      background: var(--forest-mid);
      border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 600; color: #fff;
      flex-shrink: 0;
    }

    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; color: #fff; }

    /* ── Main ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1; display: flex;
      flex-direction: column; min-height: 100vh;
    }

    /* ── Topbar ── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 50;
    }

    .topbar-left { display: flex; align-items: center; gap: 14px; }

    .back-btn {
      display: flex; align-items: center; gap: 6px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      white-space: nowrap;
    }
    .back-btn:hover { background: #a7f3d0; transform: translateX(-2px); }
    .back-btn svg,
    .back-btn i[data-lucide] { width: 14px; height: 14px; }

    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700;
      color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Page header ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 24px 28px;
      color: #fff;
      margin-bottom: 24px;
      position: relative;
      overflow: hidden;
      display: flex; align-items: center; justify-content: space-between;
    }
    .page-header::before {
      content: '';
      position: absolute; top: -30px; right: -30px;
      width: 160px; height: 160px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: '';
      position: absolute; bottom: -50px; right: 110px;
      width: 120px; height: 120px; border-radius: 50%;
      background: rgba(255,255,255,.04);
    }
    .page-header-text h2 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; margin-bottom: 4px;
    }
    .page-header-text p { font-size: 13px; opacity: .75; }
    .page-header-icon {
      width: 52px; height: 52px;
      background: rgba(255,255,255,.12);
      border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      position: relative; z-index: 1; flex-shrink: 0;
    }
    .page-header-icon svg,
    .page-header-icon i[data-lucide] { width: 24px; height: 24px; color: #fff; }

    /* ── Section label ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* ── Alert ── */
    .alert-error {
      background: #fee2e2;
      border: 1px solid #fca5a5;
      color: #991b1b;
      border-radius: 10px;
      padding: 12px 16px;
      margin-bottom: 20px;
      font-size: 14px;
      display: flex; align-items: center; gap: 8px;
    }
    .alert-error svg,
    .alert-error i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Transaction cards grid ── */
    .txn-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 28px;
    }

    .txn-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-top: 3px solid transparent;
      border-radius: 14px;
      padding: 20px 16px;
      display: flex; flex-direction: column; align-items: center;
      cursor: pointer;
      transition: box-shadow .2s, transform .2s;
      position: relative;
    }
    .txn-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.08); transform: translateY(-2px); }

    .txn-card.c-teal   { border-top-color: #0d9488; }
    .txn-card.c-sky    { border-top-color: var(--sky); }
    .txn-card.c-green  { border-top-color: var(--emerald); }
    .txn-card.c-violet { border-top-color: var(--violet); }

    .txn-icon {
      width: 44px; height: 44px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 12px; flex-shrink: 0;
    }
    .txn-icon.c-teal   { background: #ccfbf1; color: #0d9488; }
    .txn-icon.c-sky    { background: #dbeafe; color: #2563eb; }
    .txn-icon.c-green  { background: #dcfce7; color: #16a34a; }
    .txn-icon.c-violet { background: #ede9fe; color: #7c3aed; }
    .txn-icon svg,
    .txn-icon i[data-lucide] { width: 20px; height: 20px; }

    .txn-title { font-size: 14px; font-weight: 600; color: var(--ink); text-align: center; }
    .txn-desc  { font-size: 12px; color: var(--muted); margin-top: 3px; text-align: center; }

    /* ── Search box inside card ── */
    .search-box {
      display: none;
      width: 100%;
      margin-top: 14px;
      border-top: 1px solid var(--border);
      padding-top: 12px;
    }
    .search-box.open { display: block; }

    .search-box input {
      width: 100%;
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 7px 12px;
      font-size: 13px;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color .2s;
      color: var(--ink);
      background: var(--white);
      text-align: center;
    }
    .search-box input:focus { border-color: var(--emerald); }
    .search-box input::placeholder { color: #9ca3af; }

    .search-box button {
      margin-top: 8px;
      width: 100%;
      padding: 8px;
      border-radius: 8px;
      border: none;
      font-size: 13px; font-weight: 600;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      transition: background .2s;
    }
    .search-box button.c-teal   { background: #0d9488; color: #fff; }
    .search-box button.c-teal:hover   { background: #0f766e; }
    .search-box button.c-sky    { background: var(--sky); color: #fff; }
    .search-box button.c-sky:hover    { background: #2563eb; }
    .search-box button.c-green  { background: var(--forest); color: #fff; }
    .search-box button.c-green:hover  { background: var(--forest-mid); }
    .search-box button.c-violet { background: var(--violet); color: #fff; }
    .search-box button.c-violet:hover { background: #7c3aed; }

    /* ── Table card ── */
    .table-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }

    .table-card-header {
      padding: 20px 24px 16px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
    }

    .table-card-header h3 {
      font-size: 16px; font-weight: 700;
      color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .table-card-header h3 svg,
    .table-card-header h3 i[data-lucide] { color: var(--emerald); width: 18px; height: 18px; }

    .count-badge {
      font-size: 12px; padding: 3px 10px;
      border-radius: 20px;
      background: var(--sage); color: var(--forest);
      font-weight: 600;
    }

    /* ── DataTable overrides ── */
    .dataTables_wrapper {
      padding: 16px 24px 20px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
    }

    .dataTables_wrapper .dataTables_filter input {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 6px 12px;
      font-size: 13px;
      outline: none;
      transition: border-color .2s;
      font-family: 'DM Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: var(--emerald); }
    .dataTables_wrapper .dataTables_filter label { font-size: 13px; color: var(--muted); }

    .dataTables_wrapper .dataTables_length select {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 5px 8px;
      font-size: 13px;
      outline: none;
      font-family: 'DM Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_length label { font-size: 13px; color: var(--muted); }
    .dataTables_wrapper .dataTables_info { font-size: 12px; color: var(--muted); }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border-radius: 8px !important;
      font-size: 13px !important;
      font-family: 'DM Sans', sans-serif !important;
      padding: 4px 10px !important;
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

    table.dataTable thead th {
      background: #f9fafb !important;
      color: var(--muted) !important;
      font-size: 11px !important;
      letter-spacing: .06em;
      text-transform: uppercase;
      font-weight: 600 !important;
      padding: 10px 16px !important;
      border-bottom: 1px solid var(--border) !important;
    }

    table.dataTable tbody tr { transition: background .15s; }
    table.dataTable tbody tr:hover { background: #f9fafb !important; }
    table.dataTable tbody td {
      padding: 12px 16px !important;
      border-bottom: 1px solid var(--border) !important;
      vertical-align: middle;
      font-size: 13px !important;
      color: var(--ink) !important;
    }
    table.dataTable.no-footer { border: none !important; }

    .member-name { font-weight: 600; color: var(--ink); }
    .td-muted { color: var(--muted) !important; }

    /* ── Dropdown ── */
    #user-menu-dropdown {
      display: none;
      background: #0a3d27;
      border-radius: 10px;
      padding: 6px;
      margin-top: 6px;
    }
    .dropdown-item {
      display: flex; align-items: center; gap: 8px;
      padding: 8px 12px; border-radius: 7px;
      text-decoration: none; font-size: 13px;
      transition: background .15s;
    }
    .dropdown-item:hover { background: rgba(255,255,255,.08); }
    .dropdown-item.normal { color: rgba(255,255,255,.8); }
    .dropdown-item.danger { color: #f87171; }
    .dropdown-item svg,
    .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Responsive ── */
    @media (max-width: 1100px) { .txn-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar { padding: 12px 16px; }
      .page-body { padding: 20px 16px; }
      .txn-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 500px) { .txn-grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
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
    <a href="{{route('Loan.Records')}}" class="nav-item">
      <i data-lucide="badge-check"></i> Approved Loans
    </a>
    <a href="{{route('Payment.Page')}}" class="nav-item">
      <i data-lucide="credit-card"></i> Payment
    </a>
    <a href="{{route('Add.Transactions')}}" class="nav-item active">
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
    <a href="{{ route('Admin.Settings') }}" class="nav-item">
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
      <a href="{{ route('Admin.Logout') }}" class="dropdown-item danger">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-left">
      <a href="{{route('Admin.dashboard')}}" class="back-btn">
        <i data-lucide="arrow-left"></i> Back
      </a>
      <div class="topbar-title">
        <h1>Transactions</h1>
        <p>Select a transaction type to add a new record</p>
      </div>
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Page header -->
    <div class="page-header">
      <div class="page-header-text">
        <h2>Transaction Records</h2>
        <p>Click a card below to add a new shared capital, loan, savings, or time deposit record.</p>
      </div>
      <div class="page-header-icon">
        <i data-lucide="arrow-left-right"></i>
      </div>
    </div>

    <!-- Error alert -->
    @if(session('error'))
    <div class="alert-error">
      <i data-lucide="circle-alert"></i>
      {{ session('error') }}
    </div>
    @endif

    <!-- Transaction type cards -->
    <div class="section-label">Select Transaction Type</div>
    <div class="txn-grid">

      <!-- Shared Capital -->
      <form action="{{route('Find.Member.Post')}}" method="POST" class="txn-card c-teal" id="card-shared">
        @csrf
        <div class="txn-icon c-teal">
          <i data-lucide="hand-coins" style="width:20px;height:20px;"></i>
        </div>
        <div class="txn-title">Shared Capital</div>
        <div class="txn-desc">Manage member shares</div>
        <div class="search-box" id="box-shared">
          <input type="text" name="member_id" placeholder="Enter Member Fullname">
          <button type="submit" class="c-teal">
            <i data-lucide="search" style="width:13px;height:13px;display:inline-block;vertical-align:middle;margin-right:4px;"></i>Search
          </button>
        </div>
      </form>

      <!-- Loan -->
      <form action="{{route('Find.Member.For.Loan')}}" method="POST" class="txn-card c-sky" id="card-loan">
        @csrf
        <div class="txn-icon c-sky">
          <i data-lucide="landmark" style="width:20px;height:20px;"></i>
        </div>
        <div class="txn-title">Loan</div>
        <div class="txn-desc">Create loan record</div>
        <div class="search-box" id="box-loan">
          <input type="text" name="member_id" placeholder="Enter Member ID">
          <button type="submit" class="c-sky">
            <i data-lucide="search" style="width:13px;height:13px;display:inline-block;vertical-align:middle;margin-right:4px;"></i>Search
          </button>
        </div>
      </form>

      <!-- Savings -->
      <form action="" method="GET" class="txn-card c-green" id="card-savings">
        <div class="txn-icon c-green">
          <i data-lucide="piggy-bank" style="width:20px;height:20px;"></i>
        </div>
        <div class="txn-title">Savings</div>
        <div class="txn-desc">Create savings record</div>
        <div class="search-box" id="box-savings">
          <input type="text" name="member_id" placeholder="Enter Member ID">
          <button type="submit" class="c-green">
            <i data-lucide="search" style="width:13px;height:13px;display:inline-block;vertical-align:middle;margin-right:4px;"></i>Search
          </button>
        </div>
      </form>

      <!-- Time Deposit -->
      <form action="" method="GET" class="txn-card c-violet" id="card-deposit">
        <div class="txn-icon c-violet">
          <i data-lucide="chart-line" style="width:20px;height:20px;"></i>
        </div>
        <div class="txn-title">Time Deposit</div>
        <div class="txn-desc">Create time deposits</div>
        <div class="search-box" id="box-deposit">
          <input type="text" name="member_id" placeholder="Enter Member ID">
          <button type="submit" class="c-violet">
            <i data-lucide="search" style="width:13px;height:13px;display:inline-block;vertical-align:middle;margin-right:4px;"></i>Search
          </button>
        </div>
      </form>

    </div><!-- /txn-grid -->

    <!-- Member list table -->
    <div class="section-label">Member List</div>
    <div class="table-card">
      <div class="table-card-header">
        <h3>
          <i data-lucide="users"></i>
          Official Members
        </h3>
        <span class="count-badge">Select a Member</span>
      </div>

      <div style="overflow-x:auto;">
        <table id="membersTable" class="display responsive nowrap no-footer" style="width:100%">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Full Name</th>
              <th>Contact</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Members as $Member)
            <tr>
              <td class="td-muted">{{$Member->member_id}}</td>
              <td>
                <div class="member-name">{{$Member->last_name}}, {{$Member->first_name}} {{$Member->middle_name}}</div>
              </td>
              <td class="td-muted">0{{$Member->contact_number}}</td>
              <td class="td-muted">{{$Member->street_address}}, {{$Member->barangay}}, {{$Member->city}}, {{$Member->province}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div><!-- /page-body -->
</div><!-- /main -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  // Init Lucide icons
  lucide.createIcons();

  // User menu toggle
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // Transaction card toggle — click card body to show/hide search box
  const cardMap = [
    { cardId: 'card-shared',  boxId: 'box-shared'  },
    { cardId: 'card-loan',    boxId: 'box-loan'    },
    { cardId: 'card-savings', boxId: 'box-savings' },
    { cardId: 'card-deposit', boxId: 'box-deposit' },
  ];

  cardMap.forEach(({ cardId, boxId }) => {
    const card = document.getElementById(cardId);
    const box  = document.getElementById(boxId);
    card.addEventListener('click', function (e) {
      if (e.target.tagName === 'INPUT' || e.target.tagName === 'BUTTON') return;
      // Close all others
      cardMap.forEach(({ boxId: otherId }) => {
        if (otherId !== boxId) {
          document.getElementById(otherId).classList.remove('open');
        }
      });
      box.classList.toggle('open');
      lucide.createIcons();
    });
  });

  // DataTable
  $(document).ready(function () {
    $('#membersTable').DataTable({
      responsive: true,
      fixedHeader: true,
      language: {
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ members",
        infoEmpty: "No members found",
        zeroRecords: "No matching members found"
      },
      drawCallback: function () {
        lucide.createIcons();
      }
    });
  });
</script>
</body>
</html>