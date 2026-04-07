<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard | GBLDC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
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
      transition: transform .3s ease;
    }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }

    .logo-mark {
      width: 40px; height: 40px;
      background: var(--emerald);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px;
      font-weight: 700;
      line-height: 1.2;
      color: #fff;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-nav {
      flex: 1;
      padding: 16px 12px;
      overflow-y: auto;
    }

    .nav-section-label {
      font-size: 10px;
      letter-spacing: .1em;
      text-transform: uppercase;
      opacity: .4;
      padding: 16px 8px 6px;
    }

    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 12px;
      border-radius: 10px;
      text-decoration: none;
      color: rgba(255,255,255,.7);
      font-size: 14px;
      font-weight: 500;
      transition: background .2s, color .2s;
      margin-bottom: 2px;
    }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i { width: 18px; text-align: center; font-size: 14px; }

    .sidebar-footer {
      padding: 16px 12px;
      border-top: 1px solid rgba(255,255,255,.1);
    }

    .user-card {
      display: flex; align-items: center; gap: 10px;
      padding: 10px;
      border-radius: 10px;
      cursor: pointer;
      transition: background .2s;
    }
    .user-card:hover { background: rgba(255,255,255,.08); }

    .avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: var(--forest-mid);
      border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 600; color: #fff;
      flex-shrink: 0;
    }

    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; }

    /* ── Main content ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ── Topbar ── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 50;
    }

    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700;
      color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    .topbar-actions { display: flex; align-items: center; gap: 12px; }

    .icon-btn {
      width: 38px; height: 38px;
      border-radius: 10px;
      border: 1px solid var(--border);
      background: var(--white);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; color: var(--muted);
      transition: background .2s, color .2s;
      position: relative;
    }
    .icon-btn:hover { background: var(--sage); color: var(--forest); }

    .notif-badge {
      position: absolute; top: 6px; right: 6px;
      width: 8px; height: 8px;
      border-radius: 50%;
      background: var(--rose);
      border: 2px solid var(--white);
    }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Welcome banner ── */
    .welcome-banner {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 28px 32px;
      color: #fff;
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 28px;
      overflow: hidden;
      position: relative;
    }
    .welcome-banner::before {
      content: '';
      position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px;
      border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .welcome-banner::after {
      content: '';
      position: absolute; bottom: -60px; right: 120px;
      width: 140px; height: 140px;
      border-radius: 50%;
      background: rgba(255,255,255,.04);
    }

    .welcome-text h2 {
      font-family: 'Playfair Display', serif;
      font-size: 26px; margin-bottom: 6px;
    }
    .welcome-text p { font-size: 14px; opacity: .75; }

    .welcome-date {
      text-align: right; opacity: .7; font-size: 13px;
      position: relative; z-index: 1;
    }
    .welcome-date .day {
      font-size: 40px; font-weight: 700; line-height: 1;
      font-family: 'Playfair Display', serif;
    }

    /* ── Stats grid ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 28px;
    }

    .stat-card {
      background: var(--white);
      border-radius: 14px;
      padding: 20px;
      border: 1px solid var(--border);
      transition: box-shadow .2s, transform .2s;
    }
    .stat-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.08); transform: translateY(-2px); }

    .stat-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }

    .stat-icon {
      width: 40px; height: 40px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 16px;
    }
    .stat-icon.green  { background: #dcfce7; color: #16a34a; }
    .stat-icon.amber  { background: #fef3c7; color: #d97706; }
    .stat-icon.sky    { background: #dbeafe; color: #2563eb; }
    .stat-icon.violet { background: #ede9fe; color: #7c3aed; }

    .stat-badge {
      font-size: 11px; padding: 3px 8px;
      border-radius: 20px; font-weight: 600;
    }
    .stat-badge.up   { background: #dcfce7; color: #16a34a; }
    .stat-badge.down { background: #fee2e2; color: #dc2626; }

    .stat-value {
      font-size: 28px; font-weight: 700;
      color: var(--ink); line-height: 1;
      margin-bottom: 4px;
    }
    .stat-label { font-size: 13px; color: var(--muted); }

    /* ── Loan report cards ── */
    .loan-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 14px;
      margin-bottom: 28px;
    }

    .loan-card {
      background: var(--white);
      border-radius: 14px;
      padding: 18px 16px;
      border: 1px solid var(--border);
      border-top: 3px solid transparent;
      transition: box-shadow .2s;
    }
    .loan-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.07); }
    .loan-card.c-green  { border-top-color: #22c55e; }
    .loan-card.c-sky    { border-top-color: #3b82f6; }
    .loan-card.c-amber  { border-top-color: #f59e0b; }
    .loan-card.c-violet { border-top-color: #8b5cf6; }
    .loan-card.c-rose   { border-top-color: #ef4444; }

    .loan-card-icon { font-size: 20px; margin-bottom: 10px; }
    .loan-card-icon.c-green  { color: #22c55e; }
    .loan-card-icon.c-sky    { color: #3b82f6; }
    .loan-card-icon.c-amber  { color: #f59e0b; }
    .loan-card-icon.c-violet { color: #8b5cf6; }
    .loan-card-icon.c-rose   { color: #ef4444; }

    .loan-card-value { font-size: 22px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
    .loan-card-label { font-size: 12px; color: var(--muted); }

    /* ── Tables ── */
    .tables-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .table-card {
      background: var(--white);
      border-radius: 14px;
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .table-card-header {
      padding: 18px 20px 14px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
    }

    .table-card-header h3 {
      font-size: 15px; font-weight: 600; color: var(--ink);
    }

    .see-all {
      font-size: 12px; color: var(--forest-mid);
      text-decoration: none; font-weight: 600;
      display: flex; align-items: center; gap: 4px;
      padding: 5px 10px; border-radius: 8px;
      background: var(--sage);
      transition: background .2s;
    }
    .see-all:hover { background: #a7f3d0; }

    .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .data-table thead tr { background: #f9fafb; }
    .data-table th {
      padding: 10px 16px; text-align: left;
      font-size: 11px; letter-spacing: .06em;
      text-transform: uppercase; color: var(--muted); font-weight: 600;
    }
    .data-table tbody tr {
      border-top: 1px solid var(--border);
      transition: background .15s;
    }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table td { padding: 11px 16px; color: var(--ink); }
    .data-table td.muted { color: var(--muted); }

    .member-name { font-weight: 500; }

    .pill {
      display: inline-block;
      font-size: 11px; font-weight: 600;
      padding: 3px 9px; border-radius: 20px;
    }
    .pill.pending  { background: #fef3c7; color: #92400e; }
    .pill.approved { background: #dcfce7; color: #166534; }
    .pill.active   { background: #dbeafe; color: #1e40af; }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── QR Modal ── */
    .modal-overlay {
      display: none;
      position: fixed; inset: 0;
      background: rgba(0,0,0,.5);
      z-index: 200;
      align-items: center; justify-content: center;
    }
    .modal-overlay.open { display: flex; }

    .modal {
      background: var(--white);
      border-radius: 16px;
      padding: 28px;
      max-width: 420px; width: 90%;
      animation: popIn .25s ease;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(10px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }

    .modal-header {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px;
    }
    .modal-header h3 { font-size: 18px; font-weight: 700; }

    .close-btn {
      width: 32px; height: 32px; border-radius: 8px;
      border: none; background: #f3f4f6; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      color: var(--muted); transition: background .2s;
    }
    .close-btn:hover { background: #e5e7eb; }

    .file-input-wrapper {
      border: 2px dashed var(--border);
      border-radius: 12px;
      padding: 28px;
      text-align: center;
      cursor: pointer;
      transition: border-color .2s, background .2s;
      margin-bottom: 16px;
    }
    .file-input-wrapper:hover { border-color: var(--emerald); background: var(--sage); }
    .file-input-wrapper input { display: none; }
    .file-input-wrapper i { font-size: 28px; color: var(--muted); margin-bottom: 8px; }
    .file-input-wrapper p { font-size: 14px; color: var(--muted); }

    .btn-row { display: flex; gap: 10px; }

    .btn {
      flex: 1; padding: 12px;
      border-radius: 10px; border: none;
      font-size: 14px; font-weight: 600;
      cursor: pointer; transition: background .2s, transform .1s;
    }
    .btn:active { transform: scale(.98); }
    .btn.secondary { background: #f3f4f6; color: var(--ink); }
    .btn.secondary:hover { background: #e5e7eb; }
    .btn.primary { background: var(--forest); color: #fff; }
    .btn.primary:hover { background: var(--forest-mid); }

    /* ── Lucide icon sizing ── */
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }
    .stat-icon i[data-lucide] { width: 18px; height: 18px; }
    .loan-card-icon i[data-lucide] { width: 22px; height: 22px; }
    .icon-btn i[data-lucide] { width: 16px; height: 16px; }
    .close-btn i[data-lucide] { width: 16px; height: 16px; }
    .file-input-wrapper i[data-lucide] { display: block; margin: 0 auto 8px; }

    /* ── Responsive ── */
    @media (max-width: 1100px) {
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .loan-grid  { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .sidebar.open { transform: translateX(0); --sidebar-w: 240px; }
      .main { margin-left: 0; }
      .stats-grid { grid-template-columns: 1fr 1fr; }
      .loan-grid  { grid-template-columns: 1fr 1fr; }
      .tables-grid { grid-template-columns: 1fr; }
      .topbar { padding: 14px 18px; }
      .page-body { padding: 20px 18px; }
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

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo" style="width:40px;height:40px;object-fit:cover;border-radius:10px;flex-shrink:0;" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Admin Dashboard</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="#" class="nav-item active">
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
    <a href="{{route('Admin.WebContent')}}" class="nav-item">
      <i data-lucide="layout-template"></i> Web Content
    </a>
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="#" class="nav-item" id="qr-btn">
      <i data-lucide="qr-code"></i> Upload QR Code
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
    <!-- Dropdown -->
    <div id="user-menu" style="display:none; background:#0a3d27; border-radius:10px; padding:6px; margin-top:6px;">
      <a href="#" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:rgba(255,255,255,.8);text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'"><i data-lucide="user" style="width:14px;height:14px;"></i>Profile</a>
      <a href="{{ route('Admin.Logout') }}" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:#f87171;text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'"><i data-lucide="log-out" style="width:14px;height:14px;"></i>Logout</a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  <div class="sidebar-overlay" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebar-overlay').classList.remove('show');"></div>
<header class="topbar">
  <div class="topbar-title" style="display:flex; align-items:center;">
    <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');" style="margin-right:12px;">
      <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
      <h1>Dashboard Overview</h1>
    </div>

  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Welcome banner -->
    <div class="welcome-banner">
      <div class="welcome-text">
        <h2>Welcome back, Admin <i data-lucide="smile"></i></h2>
        <p>Monitor and manage members, loans, and cooperative data at a glance.</p>
      </div>
      <div class="welcome-date">
        <div class="day" id="banner-day"></div>
        <div id="banner-month"></div>
      </div>
    </div>

    <!-- Quick stats -->
    <div class="section-label">Quick Stats</div>
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-header">
          <div class="stat-icon green"><i data-lucide="users"></i></div>
          <span class="stat-badge up">↑ Active</span>
        </div>
        <div class="stat-value" data-target="{{$officialMembersTotal}}">0</div>
        <div class="stat-label">Total Members</div>
      </div>
      <div class="stat-card">
        <div class="stat-header">
          <div class="stat-icon amber"><i data-lucide="file-text"></i></div>
          <span class="stat-badge down">Pending</span>
        </div>
        <div class="stat-value" data-target="{{$loanapplicationsTotal}}">0</div>
        <div class="stat-label">Pending Loan Applications</div>
      </div>
      <div class="stat-card">
        <div class="stat-header">
          <div class="stat-icon sky"><i data-lucide="piggy-bank"></i></div>
          <span class="stat-badge up">This Month</span>
        </div>
        <div class="stat-value" data-target="{{$total}}">0</div>
        <div class="stat-label">Shared Capital</div>
      </div>
      <div class="stat-card">
        <div class="stat-header">
          <div class="stat-icon violet"><i data-lucide="handshake"></i></div>
          <span class="stat-badge up">Approved</span>
        </div>
        <div class="stat-value" data-target="{{$ApprovedLoansTotal}}">0</div>
        <div class="stat-label">Approved Loans (This Month)</div>
      </div>
    </div>

    <!-- Loan reports -->
    <div class="section-label">Loan Reports</div>
    <div class="loan-grid">
      <div class="loan-card c-green">
        <div class="loan-card-icon c-green"><i data-lucide="circle-check-big"></i></div>
        <div class="loan-card-value" data-target="{{$totalActiveLoans}}">0</div>
        <div class="loan-card-label">Total Active Loans</div>
      </div>
      <div class="loan-card c-sky">
        <div class="loan-card-icon c-sky"><i data-lucide="banknote"></i></div>
        <div class="loan-card-value" data-target="{{$totalLoanAmountDisbursed}}">0</div>
        <div class="loan-card-label">Total Disbursed</div>
      </div>
      <div class="loan-card c-amber">
        <div class="loan-card-icon c-amber"><i data-lucide="wallet"></i></div>
        <div class="loan-card-value" data-target="{{$outstandingBalance}}">0</div>
        <div class="loan-card-label">Outstanding Balance</div>
      </div>
      <div class="loan-card c-violet">
        <div class="loan-card-icon c-violet"><i data-lucide="rotate-ccw"></i></div>
        <div class="loan-card-value" data-target="{{$repaidAmount}}">0</div>
        <div class="loan-card-label">Repaid Amount</div>
      </div>
      <div class="loan-card c-rose">
        <div class="loan-card-icon c-rose"><i data-lucide="triangle-alert"></i></div>
        <div class="loan-card-value" data-target="{{$overdueAmount}}">0</div>
        <div class="loan-card-label">Overdue Amount</div>
      </div>
    </div>

    <!-- Tables -->
    <div class="section-label">Recent Activity</div>
    <div class="tables-grid">

      <!-- Registrations -->
      <div class="table-card">
        <div class="table-card-header">
          <h3><i data-lucide="user-plus" style="color:var(--emerald);margin-right:8px;width:16px;height:16px;display:inline-block;vertical-align:middle;"></i>Recent Registrations</h3>
          <a href="{{route('Manage.Members')}}" class="see-all">See all <i data-lucide="arrow-right" style="width:12px;height:12px;"></i></a>
        </div>
        <div style="overflow-x:auto;">
          <table class="data-table">
            <thead><tr>
              <th>Name</th><th>Email</th><th>Contact</th>
            </tr></thead>
            <tbody>
            @foreach($registrations as $registration)
              <tr>
                <td class="member-name">{{$registration->last_name}}, {{$registration->first_name}} {{$registration->middle_name}}</td>
                <td class="muted">{{$registration->email}}</td>
                <td class="muted">0{{$registration->contact_number}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Loan Applications -->
      <div class="table-card">
        <div class="table-card-header">
          <h3><i data-lucide="file-text" style="color:var(--amber);margin-right:8px;width:16px;height:16px;display:inline-block;vertical-align:middle;"></i>Loan Applications</h3>
          <a href="{{route('LoanApp.list')}}" class="see-all">See all <i data-lucide="arrow-right" style="width:12px;height:12px;"></i></a>
        </div>
        <div style="overflow-x:auto;">
          <table class="data-table">
            <thead><tr>
              <th>Name</th><th>Amount</th><th>Contact</th>
            </tr></thead>
            <tbody>
            @foreach($loanapplications as $loanapplication)
              <tr>
                <td class="member-name">{{$loanapplication->last_name}}, {{$loanapplication->first_name}} {{$loanapplication->middle_name}}</td>
                <td>₱{{number_format($loanapplication->loan_amount, 2)}}</td>
                <td class="muted">{{$loanapplication->contact_number}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Approved Loans -->
      <div class="table-card">
        <div class="table-card-header">
          <h3><i data-lucide="circle-check-big" style="color:#22c55e;margin-right:8px;width:16px;height:16px;display:inline-block;vertical-align:middle;"></i>Approved Loans</h3>
          <a href="{{route('Loan.Records')}}" class="see-all">See all <i data-lucide="arrow-right" style="width:12px;height:12px;"></i></a>
        </div>
        <div style="overflow-x:auto;">
          <table class="data-table">
            <thead><tr>
              <th>Loan #</th><th>Name</th><th>Amount</th><th>Contact</th>
            </tr></thead>
            <tbody>
            @foreach($ApprovedLoans as $ApprovedLoan)
              <tr>
                <td><span class="pill approved">{{$ApprovedLoan->loan_number}}</span></td>
                <td class="member-name">{{$ApprovedLoan->last_name}}, {{$ApprovedLoan->first_name}} {{$ApprovedLoan->middle_name}}</td>
                <td>₱{{number_format($ApprovedLoan->loan_amount, 2)}}</td>
                <td class="muted">0{{$ApprovedLoan->contact_number}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Official Members -->
      <div class="table-card">
        <div class="table-card-header">
          <h3><i data-lucide="id-card" style="color:var(--sky);margin-right:8px;width:16px;height:16px;display:inline-block;vertical-align:middle;"></i>Official Members</h3>
          <a href="{{route('Member.List')}}" class="see-all">See all <i data-lucide="arrow-right" style="width:12px;height:12px;"></i></a>
        </div>
        <div style="overflow-x:auto;">
          <table class="data-table">
            <thead><tr>
              <th>Name</th><th>Email</th><th>Contact</th><th>Joined</th>
            </tr></thead>
            <tbody>
            @foreach($officialMembers as $officialMember)
              <tr>
                <td class="member-name">{{$officialMember->last_name}}, {{$officialMember->first_name}} {{$officialMember->middle_name}}</td>
                <td class="muted">{{$officialMember->email}}</td>
                <td class="muted">0{{$officialMember->contact_number}}</td>
                <td class="muted">{{date('M d, Y', strtotime($officialMember->created_at))}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- /tables-grid -->
  </div><!-- /page-body -->
</div><!-- /main -->

<!-- QR Modal -->
<div class="modal-overlay" id="qrUploadModal">
  <div class="modal">
    <div class="modal-header">
      <h3><i data-lucide="qr-code" style="color:var(--forest);margin-right:8px;width:18px;height:18px;display:inline-block;vertical-align:middle;"></i>Upload QR Code</h3>
      <button class="close-btn" id="close-modal"><i data-lucide="x"></i></button>
    </div>
    <form action="{{ route('admin.upload.qr') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <label class="file-input-wrapper" for="qr_image">
        <input type="file" name="qr_image" id="qr_image" accept="image/*" required>
        <i data-lucide="cloud-upload" style="width:32px;height:32px;color:var(--muted);margin-bottom:8px;"></i>
        <p><strong>Click to choose</strong> or drag & drop</p>
        <p style="font-size:12px;margin-top:4px;">PNG, JPG, GIF up to 5MB</p>
      </label>
      <div class="btn-row">
        <button type="button" class="btn secondary" id="cancel-modal">Cancel</button>
        <button type="submit" class="btn primary">Upload QR Code</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Date display
  const now = new Date();
  document.getElementById('current-date').textContent =
    now.toLocaleDateString('en-PH', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
  document.getElementById('banner-day').textContent   = now.getDate();
  document.getElementById('banner-month').textContent =
    now.toLocaleDateString('en-PH', { month: 'long', year: 'numeric' });

  // Counter animation
  document.querySelectorAll('[data-target]').forEach(el => {
    const raw = el.getAttribute('data-target');
    if (el.getAttribute('data-format') === 'text') {
      el.textContent = raw || '—';
      return;
    }
    const target = +raw;
    if (!target) return;
    const dur = 1200, step = 20, steps = dur / step;
    const inc = target / steps;
    let cur = 0;
    const tick = () => {
      cur += inc;
      if (cur < target) {
        el.textContent = Math.ceil(cur).toLocaleString();
        setTimeout(tick, step);
      } else {
        el.textContent = target.toLocaleString();
      }
    };
    tick();
  });

  // User menu
  const userBtn = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // QR modal
  const modal      = document.getElementById('qrUploadModal');
  const openModal  = () => modal.classList.add('open');
  const closeModal = () => modal.classList.remove('open');

  document.getElementById('qr-btn').addEventListener('click', e => { e.preventDefault(); openModal(); });
  document.getElementById('close-modal').addEventListener('click', closeModal);
  document.getElementById('cancel-modal').addEventListener('click', closeModal);
  modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });

  // File input label update
  document.getElementById('qr_image').addEventListener('change', function() {
    const p = this.closest('.file-input-wrapper').querySelector('p');
    if (this.files[0]) p.innerHTML = `<strong>${this.files[0].name}</strong>`;
  });

  // Init Lucide icons
  lucide.createIcons();
</script>
</body>
</html>