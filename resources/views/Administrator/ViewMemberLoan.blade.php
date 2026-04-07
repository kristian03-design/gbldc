<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Loan Record | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
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
    .logo-text {
      font-family: 'DM Serif Display', serif;
      font-size: 18px; color: #fff; line-height: 1.2;
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
      text-decoration: none; color: rgba(255,255,255,.7);
      font-size: 14px; font-weight: 500;
      transition: background .2s, color .2s;
      margin-bottom: 2px;
    }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item svg, .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* Jump nav */
    .jump-item {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 12px; border-radius: 8px;
      text-decoration: none; color: rgba(255,255,255,.45);
      font-size: 13px; transition: background .15s, color .15s;
      margin-bottom: 1px;
    }
    .jump-item:hover { background: rgba(255,255,255,.05); color: rgba(255,255,255,.8); }
    .jump-item.lit { color: var(--emerald); }
    .jump-dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: rgba(255,255,255,.2); flex-shrink: 0;
      transition: background .2s;
    }
    .jump-item.lit .jump-dot { background: var(--emerald); box-shadow: 0 0 6px rgba(34,197,94,.5); }

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
    .main {
      margin-left: var(--sidebar-w);
      flex: 1; display: flex; flex-direction: column; min-height: 100vh;
    }

    /* ── Topbar ── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; gap: 10px;
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

    /* Loan status badge */
    .loan-status-badge {
      display: inline-flex; align-items: center; gap: 6px;
      border-radius: 20px; padding: 5px 13px;
      font-size: 12px; font-weight: 700;
    }
    .loan-status-badge svg, .loan-status-badge i[data-lucide] { width: 12px; height: 12px; }
    .badge-active    { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-pending   { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .badge-completed { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-default   { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; }

    /* ── Page body ── */
    .page-body {
      max-width: 900px; margin: 0 auto;
      padding: 32px 32px 80px; flex: 1; width: 100%;
    }

    /* ── Page header banner ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 28px 32px; color: #fff;
      margin-bottom: 24px; position: relative; overflow: hidden;
      display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
    }
    .page-header::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: ''; position: absolute; bottom: -60px; right: 120px;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(255,255,255,.04);
    }
    .page-header-content { position: relative; z-index: 1; }
    .page-header-eyebrow {
      font-size: 10px; font-weight: 700; letter-spacing: .14em;
      text-transform: uppercase; color: var(--emerald);
      margin-bottom: 8px; display: flex; align-items: center; gap: 8px;
    }
    .page-header-eyebrow::before {
      content: ''; display: inline-block; width: 18px; height: 2px;
      background: var(--emerald); border-radius: 2px;
    }
    .page-header-content h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 24px; margin-bottom: 6px;
    }
    .page-header-content p { font-size: 13px; opacity: .7; margin-bottom: 14px; }
    .loan-num-tag {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 8px; padding: 5px 12px;
      font-size: 12px; font-weight: 600; color: rgba(255,255,255,.85);
      font-family: monospace; letter-spacing: .04em;
    }
    .loan-num-tag svg, .loan-num-tag i[data-lucide] { width: 12px; height: 12px; color: var(--emerald); }

    .page-header-right { position: relative; z-index: 1; flex-shrink: 0; }
    .header-amount-box {
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 12px; padding: 14px 20px; text-align: right; min-width: 160px;
    }
    .header-amount-box .ha-label { font-size: 11px; opacity: .65; margin-bottom: 3px; text-transform: uppercase; letter-spacing: .06em; }
    .header-amount-box .ha-amount { font-family: 'DM Serif Display', serif; font-size: 22px; color: #fff; }
    .header-amount-box .ha-sub { font-size: 11px; opacity: .5; margin-top: 4px; }

    /* ── Summary strip ── */
    .summary-strip {
      display: grid; grid-template-columns: repeat(4, 1fr);
      gap: 12px; margin-bottom: 24px;
    }
    @media (max-width: 700px) { .summary-strip { grid-template-columns: 1fr 1fr; } }

    .sum-card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 12px; padding: 14px 16px;
      display: flex; align-items: center; gap: 12px;
    }
    .sum-icon {
      width: 36px; height: 36px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .sum-icon svg, .sum-icon i[data-lucide] { width: 17px; height: 17px; }
    .sum-icon.green  { background: #dcfce7; color: var(--forest-mid); }
    .sum-icon.blue   { background: #dbeafe; color: #2563eb; }
    .sum-icon.amber  { background: #fef3c7; color: #d97706; }
    .sum-icon.sky    { background: #e0f2fe; color: #0284c7; }
    .sum-icon.violet { background: #ede9fe; color: #7c3aed; }
    .sum-card .s-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: 3px; }
    .sum-card .s-value { font-size: 14px; font-weight: 700; color: var(--ink); }
    .sum-card .s-value.green  { color: var(--forest-mid); }
    .sum-card .s-value.blue   { color: #2563eb; }
    .sum-card .s-value.amber  { color: #d97706; }
    .sum-card .s-value.violet { color: #7c3aed; }

    /* ── Section label ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* ── Card ── */
    .card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; overflow: hidden; margin-bottom: 20px;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .card-head {
      padding: 18px 24px; display: flex; align-items: center; gap: 12px;
      border-bottom: 1px solid var(--border);
    }
    .card-head-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: var(--sage); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .card-head-icon svg, .card-head-icon i[data-lucide] { width: 18px; height: 18px; color: var(--forest-mid); }
    .card-head-title { font-size: 15px; font-weight: 700; color: var(--ink); }
    .card-head-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .card-body { padding: 22px 24px; }

    /* ── Info grid ── */
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .info-grid .span2 { grid-column: 1 / -1; }
    @media (max-width: 640px) { .info-grid { grid-template-columns: 1fr; } .info-grid .span2 { grid-column: 1; } }

    .info-cell {
      background: var(--sand); border: 1px solid #eaf3ea;
      border-radius: 10px; padding: 13px 16px;
      transition: border-color .15s, background .15s;
    }
    .info-cell:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .info-cell .lbl {
      font-size: 10px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .07em; color: var(--muted); margin-bottom: 5px;
    }
    .info-cell .data { font-size: 13px; color: var(--ink); font-weight: 600; line-height: 1.4; }
    .info-cell .data.amount { font-size: 15px; color: var(--forest-mid); font-family: 'DM Serif Display', serif; }
    .info-cell .data.balance { font-size: 15px; color: #dc2626; font-family: 'DM Serif Display', serif; }
    .info-cell .data.muted { color: var(--muted); font-weight: 400; }

    /* ── Tabs ── */
    .tab-bar {
      display: flex; gap: 4px;
      border-bottom: 2px solid var(--border);
      margin-bottom: 20px; flex-wrap: wrap;
    }
    .tab-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 9px 14px; border-radius: 8px 8px 0 0;
      font-size: 13px; font-weight: 600;
      cursor: pointer; border: none; background: none;
      color: var(--muted); font-family: 'DM Sans', sans-serif;
      transition: color .15s, background .15s;
      border-bottom: 2px solid transparent; margin-bottom: -2px;
    }
    .tab-btn:hover { color: var(--forest); background: #f0fdf4; }
    .tab-btn.active { color: var(--forest); border-bottom-color: var(--emerald); background: #f0fdf4; }
    .tab-icon {
      width: 22px; height: 22px; border-radius: 6px;
      background: var(--sage); color: var(--forest-mid);
      display: flex; align-items: center; justify-content: center;
    }
    .tab-icon svg, .tab-icon i[data-lucide] { width: 11px; height: 11px; }
    .tab-btn.active .tab-icon { background: var(--forest); color: #fff; }

    .tab-panel { display: none; }
    .tab-panel.active { display: block; animation: tabIn .24s ease both; }
    @keyframes tabIn {
      from { opacity: 0; transform: translateX(8px); }
      to   { opacity: 1; transform: translateX(0); }
    }

    .tab-footer {
      display: flex; justify-content: space-between; align-items: center;
      padding-top: 16px; border-top: 1px solid var(--border); margin-top: 4px;
    }
    .tab-counter { font-size: 12px; color: var(--muted); font-weight: 600; }
    .tab-counter span { color: var(--forest-mid); font-weight: 700; }
    .tab-nav { display: flex; gap: 8px; }

    .nav-btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 8px 14px; border-radius: 10px;
      font-size: 13px; font-weight: 600; border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif; transition: background .2s, transform .1s;
    }
    .nav-btn:active { transform: scale(.97); }
    .nav-btn svg, .nav-btn i[data-lucide] { width: 14px; height: 14px; }
    .nav-btn.primary { background: var(--forest); color: #fff; }
    .nav-btn.primary:hover { background: var(--forest-mid); }
    .nav-btn.ghost { background: var(--white); color: var(--ink); border: 1.5px solid var(--border); }
    .nav-btn.ghost:hover { border-color: #9ca3af; background: #f9fafb; }

    /* ── Guarantor block ── */
    .g-block {
      border: 1px solid #e5f0e5; border-radius: 12px;
      padding: 18px 20px; margin-bottom: 14px; background: var(--sand);
    }
    .g-block:last-child { margin-bottom: 0; }
    .g-block-head { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
    .g-number {
      width: 24px; height: 24px; border-radius: 50%;
      background: var(--forest); color: #fff;
      font-size: 11px; font-weight: 700;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .g-label { font-size: 14px; font-weight: 700; color: var(--forest); }

    /* ── ID image ── */
    .id-wrap { margin-top: 4px; }
    .id-wrap .id-lbl {
      font-size: 10px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .07em; color: var(--forest-mid); margin-bottom: 8px;
      display: flex; align-items: center; gap: 6px;
    }
    .id-wrap .id-lbl svg, .id-wrap .id-lbl i[data-lucide] { width: 12px; height: 12px; }
    .id-img {
      max-width: 320px; width: 100%; border-radius: 10px;
      border: 2px solid var(--sage); background: var(--white);
      padding: 4px; box-shadow: 0 3px 10px rgba(0,0,0,.08); display: block;
    }

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
  
    /* RESPONSIVE INJECT */
    .mobile-toggle { display: none; }
    .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 99; }
    .sidebar-overlay.show { display: block; }
    @media (max-width: 900px) {
      :root { --sidebar-w: 0px !important; }
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; width: 260px !important; z-index: 100 !important; }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0 !important; width: 100% !important; min-width: 100vw; overflow-x: hidden; }
      .mobile-toggle { display: flex !important; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; border: none; background: #f3f4f6; color: var(--ink); cursor: pointer; position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 60; }
      .topbar { padding-left: 56px !important; padding-right: 14px !important; position: relative !important; }
      .tables-grid, .stats-grid, .loan-grid, .kpi-strip, .form-grid { grid-template-columns: 1fr !important; }
      .page-body { padding: 16px !important; }
      .hide-mobile { display: none !important; }
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

    <div class="nav-section-label">On This Page</div>
    <a href="#sec-terms"   class="jump-item lit" data-sec="sec-terms">
      <span class="jump-dot"></span> Loan Terms
    </a>
    <a href="#sec-details" class="jump-item" data-sec="sec-details">
      <span class="jump-dot"></span> Applicant Details
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
      <a href="{{route('Admin.manage')}}" class="dropdown-item normal">
        <i data-lucide="shield-check" style="width:14px;height:14px;"></i> Manage Users
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
  
<div class="sidebar-overlay" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebar-overlay').classList.remove('show');"></div>
<header class="topbar">
  <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');">
    <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
  </button>
    <a href="{{route('Loan.Records')}}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="breadcrumb">
      <a href="{{route('Loan.Records')}}">Approved Loans</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">{{$Review->loan_number}}</span>
    </div>
    <div class="topbar-spacer"></div>
    @php
      $statusClass = match(strtolower($Review->status ?? '')) {
        'active'    => 'badge-active',
        'completed' => 'badge-completed',
        'pending'   => 'badge-pending',
        default     => 'badge-default',
      };
      $statusIcon = match(strtolower($Review->status ?? '')) {
        'active'    => 'circle-check',
        'completed' => 'check-check',
        'pending'   => 'clock',
        default     => 'minus-circle',
      };
    @endphp
    <div class="loan-status-badge {{ $statusClass }}">
      <i data-lucide="{{ $statusIcon }}"></i>
      {{ ucfirst($Review->status ?? 'Active') }}
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Page header banner -->
    <div class="page-header" id="page-top">
      <div class="page-header-content">
        <div class="page-header-eyebrow">Loan Record</div>
        <h2>{{$Review->last_name}}, {{$Review->first_name}}</h2>
        <p>Approved loan details and complete applicant information.</p>
        <div class="loan-num-tag">
          <i data-lucide="hash"></i> {{$Review->loan_number}}
        </div>
      </div>
      <div class="page-header-right">
        <div class="header-amount-box">
          <div class="ha-label">Loan Amount</div>
          <div class="ha-amount">₱{{number_format($Review->loan_amount, 2)}}</div>
          <div class="ha-sub">{{$Review->loan_term}} &bull; {{$Review->frequency_of_payment}}</div>
        </div>
      </div>
    </div>

    <!-- Summary strip -->
    <div class="summary-strip">
      <div class="sum-card">
        <div class="sum-icon green"><i data-lucide="banknote"></i></div>
        <div>
          <div class="s-label">Loan Amount</div>
          <div class="s-value green">₱{{number_format($Review->loan_amount, 2)}}</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon blue"><i data-lucide="circle-dollar-sign"></i></div>
        <div>
          <div class="s-label">Due Amount</div>
          <div class="s-value blue">₱{{number_format($Review->due_amount, 2)}}</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon amber"><i data-lucide="calendar-days"></i></div>
        <div>
          <div class="s-label">Loan Term</div>
          <div class="s-value amber">{{$Review->loan_term}}</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon sky"><i data-lucide="percent"></i></div>
        <div>
          <div class="s-label">Interest Rate</div>
          <div class="s-value" style="color:var(--sky);">{{ (isset($Review->interest_rate) && $Review->interest_rate !== '' && $Review->interest_rate !== null) ? number_format((float) $Review->interest_rate, 1) . '%' : number_format(5, 1) . '%' }}</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon violet"><i data-lucide="repeat"></i></div>
        <div>
          <div class="s-label">Frequency</div>
          <div class="s-value violet">{{$Review->frequency_of_payment}}</div>
        </div>
      </div>
    </div>

    <!-- ① Loan Terms -->
    <div class="section-label">Loan Terms</div>
    <div class="card" id="sec-terms">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="file-badge"></i></div>
        <div>
          <div class="card-head-title">Loan Terms &amp; Approval</div>
          <div class="card-head-sub">Approved loan conditions and signatory details</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell">
            <div class="lbl">Loan Number</div>
            <div class="data" style="font-family:monospace;letter-spacing:.04em;">{{$Review->loan_number}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Loan Term</div>
            <div class="data">{{$Review->loan_term}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Interest Rate</div>
            <div class="data">{{ (isset($Review->interest_rate) && $Review->interest_rate !== '' && $Review->interest_rate !== null) ? number_format((float) $Review->interest_rate, 1) . '%' : number_format(5, 1) . '%' }}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Loan Amount Granted</div>
            <div class="data amount">₱{{number_format($Review->loan_amount, 2)}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Due Amount</div>
            <div class="data balance">₱{{number_format($Review->due_amount, 2)}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Payment Frequency</div>
            <div class="data">{{$Review->frequency_of_payment}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Payment Start Date</div>
            <div class="data">{{$Review->payment_start_date ?? '—'}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Approved By</div>
            <div class="data">{{$Review->approved_by}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Encoded By</div>
            <div class="data">{{$Review->encoded_by}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ② Applicant Details (tabbed) -->
    <div class="section-label">Applicant Information</div>
    <div class="card" id="sec-details">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="folder-open"></i></div>
        <div>
          <div class="card-head-title">Applicant Details</div>
          <div class="card-head-sub">Browse all applicant information using the tabs below</div>
        </div>
      </div>
      <div class="card-body">

        <div class="tab-bar">
          <button type="button" class="tab-btn active" data-tab="tab-personal" onclick="switchTab(this)">
            <span class="tab-icon"><i data-lucide="user" style="width:11px;height:11px;"></i></span> Personal Info
          </button>
          <button type="button" class="tab-btn" data-tab="tab-address" onclick="switchTab(this)">
            <span class="tab-icon"><i data-lucide="map-pin" style="width:11px;height:11px;"></i></span> Home Address
          </button>
          <button type="button" class="tab-btn" data-tab="tab-guarantors" onclick="switchTab(this)">
            <span class="tab-icon"><i data-lucide="shield-check" style="width:11px;height:11px;"></i></span> Guarantors
          </button>
          <button type="button" class="tab-btn" data-tab="tab-employment" onclick="switchTab(this)">
            <span class="tab-icon"><i data-lucide="briefcase" style="width:11px;height:11px;"></i></span> Employment
          </button>
          <button type="button" class="tab-btn" data-tab="tab-loan" onclick="switchTab(this)">
            <span class="tab-icon"><i data-lucide="coins" style="width:11px;height:11px;"></i></span> Loan Details
          </button>
        </div>

        <!-- Tab: Personal Info -->
        <div class="tab-panel active" id="tab-personal">
          <div class="info-grid">
            <div class="info-cell span2">
              <div class="lbl">Full Name</div>
              <div class="data">{{$Review->last_name}}, {{$Review->first_name}} {{$Review->middle_name}}</div>
            </div>
            <div class="info-cell"><div class="lbl">Birth Date</div><div class="data">{{$Review->birthdate}}</div></div>
            <div class="info-cell"><div class="lbl">Place of Birth</div><div class="data">{{$Review->place_of_birth}}</div></div>
            <div class="info-cell"><div class="lbl">Age</div><div class="data">{{$Review->age}}</div></div>
            <div class="info-cell"><div class="lbl">Gender</div><div class="data">{{$Review->gender}}</div></div>
            <div class="info-cell"><div class="lbl">Religion</div><div class="data">{{$Review->religion}}</div></div>
            <div class="info-cell"><div class="lbl">Nationality</div><div class="data">{{$Review->nationality}}</div></div>
            <div class="info-cell"><div class="lbl">Civil Status</div><div class="data">{{$Review->civil_status}}</div></div>
            <div class="info-cell"><div class="lbl">Email Address</div><div class="data">{{$Review->email}}</div></div>
            <div class="info-cell"><div class="lbl">Contact Number</div><div class="data">{{$Review->contact_number}}</div></div>
          </div>
          <div class="tab-footer">
            <span class="tab-counter">Tab <span>1</span> of 5</span>
            <div class="tab-nav">
              <button type="button" class="nav-btn primary" onclick="nextTab()">Home Address <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
            </div>
          </div>
        </div>

        <!-- Tab: Home Address -->
        <div class="tab-panel" id="tab-address">
          <div class="info-grid">
            <div class="info-cell span2"><div class="lbl">Street Address</div><div class="data">{{$Review->street_address}}</div></div>
            <div class="info-cell"><div class="lbl">Province</div><div class="data">{{$Review->province}}</div></div>
            <div class="info-cell"><div class="lbl">City / Municipality</div><div class="data">{{$Review->city_municipality}}</div></div>
            <div class="info-cell"><div class="lbl">Barangay</div><div class="data">{{$Review->barangay}}</div></div>
            <div class="info-cell"><div class="lbl">Zip Code</div><div class="data">{{$Review->zip_code}}</div></div>
            <div class="info-cell"><div class="lbl">Years of Stay</div><div class="data">{{$Review->year_of_stay}}</div></div>
            <div class="info-cell"><div class="lbl">House Ownership</div><div class="data">{{$Review->house_ownership}}</div></div>
          </div>
          <div class="tab-footer">
            <span class="tab-counter">Tab <span>2</span> of 5</span>
            <div class="tab-nav">
              <button type="button" class="nav-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Personal Info</button>
              <button type="button" class="nav-btn primary" onclick="nextTab()">Guarantors <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
            </div>
          </div>
        </div>

        <!-- Tab: Guarantors -->
        <div class="tab-panel" id="tab-guarantors">
          <div class="g-block">
            <div class="g-block-head">
              <div class="g-number">1</div>
              <div class="g-label">First Guarantor</div>
            </div>
            <div class="info-grid">
              <div class="info-cell"><div class="lbl">Full Name</div><div class="data">{{$Review->g1_fullname}}</div></div>
              <div class="info-cell"><div class="lbl">Relationship</div><div class="data">{{$Review->g1_relationship}}</div></div>
              <div class="info-cell"><div class="lbl">Contact Number</div><div class="data">{{$Review->g1_contact_number}}</div></div>
              <div class="info-cell"><div class="lbl">Address</div><div class="data">{{$Review->g1_address}}</div></div>
              <div class="span2 id-wrap">
                <div class="id-lbl"><i data-lucide="id-card"></i> Valid ID</div>
                <img src="data:{{ $g1MimeType }};base64,{{ $g1Base64 }}" alt="Guarantor 1 ID" class="id-img">
              </div>
            </div>
          </div>
          <div class="g-block">
            <div class="g-block-head">
              <div class="g-number">2</div>
              <div class="g-label">Second Guarantor</div>
            </div>
            <div class="info-grid">
              <div class="info-cell"><div class="lbl">Full Name</div><div class="data">{{$Review->g2_fullname}}</div></div>
              <div class="info-cell"><div class="lbl">Relationship</div><div class="data">{{$Review->g2_relationship}}</div></div>
              <div class="info-cell"><div class="lbl">Contact Number</div><div class="data">{{$Review->g2_contact_number}}</div></div>
              <div class="info-cell"><div class="lbl">Address</div><div class="data">{{$Review->g2_address}}</div></div>
              <div class="span2 id-wrap">
                <div class="id-lbl"><i data-lucide="id-card"></i> Valid ID</div>
                <img src="data:{{ $g2MimeType }};base64,{{ $g2Base64 }}" alt="Guarantor 2 ID" class="id-img">
              </div>
            </div>
          </div>
          <div class="tab-footer">
            <span class="tab-counter">Tab <span>3</span> of 5</span>
            <div class="tab-nav">
              <button type="button" class="nav-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Home Address</button>
              <button type="button" class="nav-btn primary" onclick="nextTab()">Employment <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
            </div>
          </div>
        </div>

        <!-- Tab: Employment -->
        <div class="tab-panel" id="tab-employment">
          <div class="info-grid">
            <div class="info-cell"><div class="lbl">Employment Type</div><div class="data">{{$Review->employment_type}}</div></div>
            <div class="info-cell"><div class="lbl">Employer / Business Name</div><div class="data">{{$Review->employer_business_name}}</div></div>
            <div class="info-cell"><div class="lbl">Position / Nature of Business</div><div class="data">{{$Review->position_nature_of_business}}</div></div>
            <div class="info-cell"><div class="lbl">Business Address</div><div class="data">{{$Review->employer_business_address}}</div></div>
            <div class="info-cell"><div class="lbl">Monthly Income</div><div class="data amount">{{$Review->monthly_income}}</div></div>
            <div class="info-cell"><div class="lbl">Years in Service</div><div class="data">{{$Review->year_in_service_operation}}</div></div>
            <div class="span2 id-wrap">
              <div class="id-lbl"><i data-lucide="file-badge"></i> Proof of Income</div>
              <img src="data:{{ $proofMimeType }};base64,{{ $proofBase64 }}" alt="Proof of Income" class="id-img">
            </div>
          </div>
          <div class="tab-footer">
            <span class="tab-counter">Tab <span>4</span> of 5</span>
            <div class="tab-nav">
              <button type="button" class="nav-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Guarantors</button>
              <button type="button" class="nav-btn primary" onclick="nextTab()">Loan Details <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
            </div>
          </div>
        </div>

        <!-- Tab: Loan Details -->
        <div class="tab-panel" id="tab-loan">
          <div class="info-grid" style="margin-bottom:16px;">
            <div class="info-cell"><div class="lbl">Loan Type</div><div class="data">{{$Review->loan_type}}</div></div>
            <div class="info-cell"><div class="lbl">Amount Requested</div><div class="data amount">₱{{number_format($Review->loan_amount, 2)}}</div></div>
            <div class="info-cell"><div class="lbl">Interest Rate</div><div class="data">{{ (isset($Review->interest_rate) && $Review->interest_rate !== '' && $Review->interest_rate !== null) ? number_format((float) $Review->interest_rate, 1) . '%' : number_format(5, 1) . '%' }}</div></div>
            <div class="info-cell span2"><div class="lbl">Purpose of Loan</div><div class="data">{{$Review->purpose_of_loan}}</div></div>
          </div>
          <div style="border-top:1px solid var(--border);padding-top:16px;margin-bottom:16px;">
            <p style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:10px;">Additional Information</p>
            <div class="info-grid">
              <div class="info-cell"><div class="lbl">HR / Contact Person Name</div><div class="data">{{$Review->hr_person_name}}</div></div>
              <div class="info-cell"><div class="lbl">HR / Contact Person Number</div><div class="data">{{$Review->hr_person_number}}</div></div>
            </div>
          </div>
          <div class="tab-footer">
            <span class="tab-counter">Tab <span>5</span> of 5</span>
            <div class="tab-nav">
              <button type="button" class="nav-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Employment</button>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div><!-- /page-body -->

  <footer class="page-footer">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div>

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

  // ── Tab system ──
  const TAB_ORDER = ['tab-personal','tab-address','tab-guarantors','tab-employment','tab-loan'];

  function switchTab(btn) {
    document.querySelectorAll('.tab-btn').forEach(b   => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(btn.dataset.tab).classList.add('active');
    lucide.createIcons();
  }

  function nextTab() {
    const idx = TAB_ORDER.indexOf(document.querySelector('.tab-panel.active').id);
    if (idx < TAB_ORDER.length - 1) {
      switchTab(document.querySelector(`.tab-btn[data-tab="${TAB_ORDER[idx+1]}"]`));
      document.getElementById('sec-details').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  function prevTab() {
    const idx = TAB_ORDER.indexOf(document.querySelector('.tab-panel.active').id);
    if (idx > 0) {
      switchTab(document.querySelector(`.tab-btn[data-tab="${TAB_ORDER[idx-1]}"]`));
      document.getElementById('sec-details').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  // ── Jump nav scroll highlight ──
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        document.querySelectorAll('.jump-item').forEach(i => i.classList.remove('lit'));
        const match = document.querySelector(`.jump-item[data-sec="${entry.target.id}"]`);
        if (match) match.classList.add('lit');
      }
    });
  }, { threshold: 0.2, rootMargin: '-60px 0px -40% 0px' });
  document.querySelectorAll('#sec-terms, #sec-details').forEach(s => obs.observe(s));
</script>
</body>
</html>