<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Reports | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --forest:    #0d4a2f;
      --forest-mid:#1a6b44;
      --emerald:   #22c55e;
      --sage:      #d1fae5;
      --sand:      #f4f6f8;
      --ink:       #0f1c14;
      --muted:     #6b7280;
      --border:    #e5e7eb;
      --white:     #ffffff;
      --primary:   #0d4a2f;
      --secondary: #38bdf8;
      --warning:   #fbbf24;
      --danger:    #ef4444;
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

    /* ─── SIDEBAR (UNCHANGED) ──────────────────────────── */
    .sidebar { width: var(--sidebar-w); background: var(--forest); color: #fff; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 100; }
    .sidebar-logo { display: flex; align-items: center; gap: 12px; padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,.1); }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; line-height: 1.2; color: #fff; }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }
    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
    .nav-section-label { font-size: 10px; letter-spacing: .1em; text-transform: uppercase; opacity: .4; padding: 16px 8px 6px; }
    .nav-item { display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 10px; text-decoration: none; color: rgba(255,255,255,.7); font-size: 14px; font-weight: 500; transition: background .2s, color .2s; margin-bottom: 2px; }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
    .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.1); }
    .user-card { display: flex; align-items: center; gap: 10px; padding: 10px; border-radius: 10px; cursor: pointer; transition: background .2s; }
    .user-card:hover { background: rgba(255,255,255,.08); }
    .avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--forest-mid); border: 2px solid var(--emerald); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0; overflow: hidden; }
    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; color: #fff; }

    /* ─── MAIN LAYOUT ──────────────────────────────────── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ─── TOPBAR ───────────────────────────────────────── */
    .topbar {
      padding: 28px 36px 20px;
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      border-bottom: 1px solid var(--border);
      background: var(--white);
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .topbar-left {}
    .topbar-eyebrow {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--forest-mid);
      margin-bottom: 4px;
    }
    .topbar h1 {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--ink);
      line-height: 1;
    }

    .topbar-right { display: flex; align-items: center; gap: 12px; }

    /* period tabs */
    .period-tabs {
      display: flex;
      background: var(--sand);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 3px;
      gap: 2px;
    }
    .period-tab {
      padding: 6px 14px;
      font-size: 12px;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      color: var(--muted);
      transition: all .2s;
      border: none;
      background: none;
    }
    .period-tab.active {
      background: var(--white);
      color: var(--ink);
      box-shadow: 0 1px 3px rgba(0,0,0,.08);
    }

    /* export button */
    .btn-export {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 16px;
      background: var(--forest);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      position: relative;
      transition: background .2s;
    }
    .btn-export:hover { background: var(--forest-mid); }
    .btn-export svg { width: 15px; height: 15px; }
    .chevron-icon { width: 13px !important; height: 13px !important; opacity: .7; }

    .dropdown-menu {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      background: var(--white);
      border: 1px solid var(--border);
      box-shadow: 0 12px 24px rgba(0,0,0,.1);
      border-radius: 10px;
      width: 230px;
      z-index: 200;
      display: none;
      overflow: hidden;
    }
    .dropdown-menu.show { display: block; }
    .dropdown-item {
      padding: 12px 16px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      font-weight: 500;
      color: var(--ink);
      text-decoration: none;
      transition: background .15s;
      border-bottom: 1px solid var(--border);
    }
    .dropdown-item:last-child { border-bottom: none; }
    .dropdown-item:hover { background: var(--sage); color: var(--forest); }
    .dropdown-item svg { width: 15px; height: 15px; opacity: .6; }

    /* ─── PAGE BODY ────────────────────────────────────── */
    .page-body { padding: 28px 36px 40px; }

    /* ─── KPI STRIP ────────────────────────────────────── */
    .kpi-strip {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 28px;
    }
    .kpi-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 20px 22px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      position: relative;
      overflow: hidden;
      transition: box-shadow .2s, transform .2s;
    }
    .kpi-card:hover { box-shadow: 0 6px 20px rgba(13,74,47,.08); transform: translateY(-2px); }
    .kpi-card::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 3px;
      border-radius: 0 0 12px 12px;
    }
    .kpi-card.c1::after { background: var(--forest); }
    .kpi-card.c2::after { background: var(--secondary); }
    .kpi-card.c3::after { background: var(--warning); }
    .kpi-card.c4::after { background: var(--emerald); }

    .kpi-top { display: flex; justify-content: space-between; align-items: flex-start; }
    .kpi-icon {
      width: 38px; height: 38px;
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
    }
    .kpi-icon svg { width: 18px; height: 18px; }
    .kpi-icon.bg-forest { background: rgba(13,74,47,.1); color: var(--forest); }
    .kpi-icon.bg-sky   { background: rgba(56,189,248,.12); color: #0ea5e9; }
    .kpi-icon.bg-amber { background: rgba(251,191,36,.12); color: #d97706; }
    .kpi-icon.bg-emerald { background: rgba(34,197,94,.12); color: #16a34a; }

    .kpi-delta {
      font-size: 11px;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 20px;
    }
    .kpi-delta.up { background: #dcfce7; color: #15803d; }
    .kpi-delta.down { background: #fee2e2; color: #b91c1c; }

    .kpi-value {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--ink);
      line-height: 1;
    }
    .kpi-label { font-size: 12px; font-weight: 500; color: var(--muted); }

    /* ─── CHART GRID ───────────────────────────────────── */
    .chart-grid {
      display: grid;
      grid-template-columns: 5fr 4fr;
      gap: 20px;
      margin-bottom: 20px;
    }
    .chart-grid-bottom {
      display: grid;
      grid-template-columns: 4fr 5fr;
      gap: 20px;
    }

    .panel {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 14px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: box-shadow .2s;
    }
    .panel:hover { box-shadow: 0 4px 20px rgba(0,0,0,.06); }

    .panel-header {
      padding: 18px 22px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid var(--border);
    }
    .panel-title {
      font-size: 14px;
      font-weight: 700;
      color: var(--ink);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .panel-title-dot {
      width: 8px; height: 8px;
      border-radius: 50%;
      flex-shrink: 0;
    }
    .panel-badge {
      font-size: 11px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 20px;
      background: var(--sage);
      color: var(--forest);
    }

    .panel-body { padding: 20px 22px; flex: 1; display: flex; flex-direction: column; }

    /* chart legend */
    .chart-legend {
      display: flex;
      gap: 18px;
      margin-top: 14px;
    }
    .legend-item {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 11px;
      font-weight: 600;
      color: var(--muted);
    }
    .legend-dot {
      width: 8px; height: 8px;
      border-radius: 50%;
      flex-shrink: 0;
    }
    .legend-line {
      width: 16px; height: 2px;
      border-radius: 1px;
      flex-shrink: 0;
    }

    /* ─── TABLE STYLES ─────────────────────────────────── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { border-bottom: 1px solid var(--border); }
    .data-table th {
      text-align: left;
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: .07em;
      color: var(--muted);
      font-weight: 700;
      padding: 0 0 12px;
    }
    .data-table th:not(:first-child) { text-align: right; }
    .data-table td {
      padding: 13px 0;
      border-bottom: 1px solid #f3f4f6;
      font-size: 13px;
      font-weight: 500;
      color: var(--ink);
      vertical-align: middle;
    }
    .data-table td:not(:first-child) { text-align: right; }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tbody tr:hover td { background: #fafafa; }

    .member-cell { display: flex; align-items: center; gap: 10px; }
    .member-avatar {
      width: 30px; height: 30px;
      border-radius: 50%;
      background: var(--sage);
      color: var(--forest);
      font-size: 11px;
      font-weight: 700;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }

    .status-pill {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
    }
    .status-pill.approved { background: #dcfce7; color: #15803d; }
    .status-pill.pending  { background: #fef9c3; color: #854d0e; }
    .status-pill.active   { background: var(--sage); color: var(--forest); }

    /* ─── SECTION DIVIDERS ─────────────────────────────── */
    .section-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .09em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    @media (max-width: 1200px) {
      .kpi-strip { grid-template-columns: repeat(2, 1fr); }
      .chart-grid, .chart-grid-bottom { grid-template-columns: 1fr; }
    }

    /* ─── QR MODAL ─────────────────────────────────────── */
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
      to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-header {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px;
    }
    .modal-header h3 { font-size: 18px; font-weight: 700; color: var(--ink); }
    .close-btn {
      width: 32px; height: 32px; border-radius: 8px;
      border: none; background: #f3f4f6; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      color: var(--muted); transition: background .2s;
    }
    .close-btn:hover { background: #e5e7eb; }
    .close-btn svg { width: 16px; height: 16px; }
    .file-input-wrapper {
      border: 2px dashed var(--border);
      border-radius: 12px;
      padding: 28px;
      text-align: center;
      cursor: pointer;
      transition: border-color .2s, background .2s;
      margin-bottom: 16px;
      display: block;
    }
    .file-input-wrapper:hover { border-color: var(--emerald); background: var(--sage); }
    .file-input-wrapper input { display: none; }
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
  </style>
</head>
<body>

<!-- ─── SIDEBAR (REFERENCE) ─────────────────────────── -->
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
    <a href="{{route('Add.Transactions')}}" class="nav-item">
      <i data-lucide="arrow-left-right"></i> Transactions
    </a>
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item">
      <i data-lucide="piggy-bank"></i> Shared Capital
    </a>

    <div class="nav-section-label">Reports</div>
    <a href="{{route('Admin.Reports')}}" class="nav-item active">
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
    <div id="user-menu" style="display:none; background:#0a3d27; border-radius:10px; padding:6px; margin-top:6px;">
      <a href="#" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:rgba(255,255,255,.8);text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'"><i data-lucide="user" style="width:14px;height:14px;"></i>Profile</a>
      <a href="{{ route('Admin.Logout') }}" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:#f87171;text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'"><i data-lucide="log-out" style="width:14px;height:14px;"></i>Logout</a>
    </div>
  </div>
</aside>

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
        <i data-lucide="cloud-upload" style="width:32px;height:32px;color:var(--muted);margin-bottom:8px;display:block;margin-left:auto;margin-right:auto;"></i>
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

<!-- ─── MAIN ─────────────────────────────────────────── -->
<div class="main">

  <!-- TOPBAR -->
  <header class="topbar">
    <div class="topbar-left">
      <div class="topbar-eyebrow">Analytics &amp; Insights</div>
      <h1>Cooperative Reports</h1>
    </div>
    <div class="topbar-right">
      <div class="period-tabs">
        <button class="period-tab">3M</button>
        <button class="period-tab active">6M</button>
        <button class="period-tab">YTD</button>
        <button class="period-tab">1Y</button>
      </div>
      <div style="position:relative;">
        <button class="btn-export" id="downloadBtn">
          <i data-lucide="download"></i> Export
          <i data-lucide="chevron-down" class="chevron-icon"></i>
        </button>
        <div class="dropdown-menu" id="downloadDropdown">
          <a href="#" class="dropdown-item"><i data-lucide="users"></i> Members Report (CSV)</a>
          <a href="#" class="dropdown-item"><i data-lucide="file-text"></i> Loans Report (CSV)</a>
          <a href="#" class="dropdown-item"><i data-lucide="piggy-bank"></i> Shared Capital (CSV)</a>
        </div>
      </div>
    </div>
  </header>

  <div class="page-body">

    <!-- KPI STRIP -->
    <div class="section-label">Key Metrics</div>
    <div class="kpi-strip">
      <div class="kpi-card c1">
        <div class="kpi-top">
          <div class="kpi-icon bg-forest"><i data-lucide="users"></i></div>
          <span class="kpi-delta up">↑ 8.2%</span>
        </div>
        <div class="kpi-value">{{ number_format($keyMetrics['totalMembers']) }}</div>
        <div class="kpi-label">Total Members</div>
      </div>
      <div class="kpi-card c2">
        <div class="kpi-top">
          <div class="kpi-icon bg-sky"><i data-lucide="banknote"></i></div>
          <span class="kpi-delta up">↑</span>
        </div>
        <div class="kpi-value">₱{{ number_format($keyMetrics['totalLoanPortfolio']) }}</div>
        <div class="kpi-label">Total Loan Portfolio</div>
      </div>
      <div class="kpi-card c3">
        <div class="kpi-top">
          <div class="kpi-icon bg-amber"><i data-lucide="alert-circle"></i></div>
          <span class="kpi-delta up">↑</span>
        </div>
        <div class="kpi-value">₱{{ number_format($keyMetrics['outstandingBalance']) }}</div>
        <div class="kpi-label">Outstanding Balance</div>
      </div>
      <div class="kpi-card c4">
        <div class="kpi-top">
          <div class="kpi-icon bg-emerald"><i data-lucide="trending-up"></i></div>
          <span class="kpi-delta up">↑</span>
        </div>
        <div class="kpi-value">₱{{ number_format($keyMetrics['sharedCapital']) }}</div>
        <div class="kpi-label">Shared Capital</div>
      </div>
    </div>

    <!-- ROW 1 -->
    <div class="section-label">Financial Overview</div>
    <div class="chart-grid">

      <!-- Financial Performance -->
      <div class="panel">
        <div class="panel-header">
          <div class="panel-title">
            <span class="panel-title-dot" style="background:var(--forest);"></span>
            Financial Performance
          </div>
          <span class="panel-badge">Last 6 Months</span>
        </div>
        <div class="panel-body">
          <div id="performanceChart" style="min-height: 250px; width: 100%;"></div>
          <div class="chart-legend">
            <div class="legend-item"><span class="legend-line" style="background:#0d4a2f;"></span> Collections</div>
            <div class="legend-item"><span class="legend-line" style="background:#84cc16;"></span> Disbursements</div>
          </div>
        </div>
      </div>

      <!-- Loan Repayment Progress -->
      <div class="panel">
        <div class="panel-header">
          <div class="panel-title">
            <span class="panel-title-dot" style="background:#38bdf8;"></span>
            Repayment Progress
          </div>
          <span class="panel-badge">Active Loans</span>
        </div>
        <div class="panel-body">
          <div id="progressChart" style="min-height: 250px; width: 100%;"></div>
          <div class="chart-legend">
            <div class="legend-item"><span class="legend-dot" style="background:#38bdf8;"></span> Paid</div>
            <div class="legend-item"><span class="legend-dot" style="background:#fbbf24;"></span> Remaining</div>
          </div>
        </div>
      </div>

    </div>

    <!-- ROW 2 -->
    <div class="section-label" style="margin-top:20px;">Member Activity</div>
    <div class="chart-grid-bottom">

      <!-- Recent Approved Loans Table -->
      <div class="panel">
        <div class="panel-header">
          <div class="panel-title">
            <span class="panel-title-dot" style="background:#22c55e;"></span>
            Recent Approved Loans
          </div>
          <a href="#" style="font-size:12px;font-weight:600;color:var(--forest);text-decoration:none;display:flex;align-items:center;gap:4px;">
            View all <i data-lucide="arrow-right" style="width:13px;height:13px;"></i>
          </a>
        </div>
        <div class="panel-body" style="padding-top:12px;">
          <table class="data-table">
            <thead>
              <tr>
                <th>Member</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentLoans as $loan)
              @php
                $initials = strtoupper(substr($loan->first_name, 0, 1) . substr($loan->last_name, 0, 1));
                $name = $loan->first_name . ' ' . $loan->last_name;
              @endphp
              <tr>
                <td>
                  <div class="member-cell">
                    <div class="member-avatar">{{ $initials }}</div>
                    <span>{{ $name }}</span>
                  </div>
                </td>
                <td>₱{{ number_format($loan->loan_amount, 2) }}</td>
                <td>
                  @if($loan->loan_status === 'Approved' || $loan->loan_status === 'Finished')
                    <span class="status-pill approved">{{ $loan->loan_status }}</span>
                  @elseif($loan->loan_status === 'Ongoing' || $loan->loan_status === 'Active')
                    <span class="status-pill active">{{ $loan->loan_status }}</span>
                  @else
                    <span class="status-pill pending">{{ $loan->loan_status }}</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" style="text-align: center; color: #6b7280;">No recent loans found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- New Members Bar Chart -->
      <div class="panel">
        <div class="panel-header">
          <div class="panel-title">
            <span class="panel-title-dot" style="background:#0f1c14;"></span>
            New Members Join Rate
          </div>
          <span class="panel-badge">Monthly</span>
        </div>
        <div class="panel-body">
          <div id="dealsChart" style="min-height: 250px; width: 100%;"></div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  lucide.createIcons();

  // Export dropdown toggle
  const downloadBtn = document.getElementById('downloadBtn');
  const downloadDropdown = document.getElementById('downloadDropdown');
  downloadBtn.addEventListener('click', e => { e.stopPropagation(); downloadDropdown.classList.toggle('show'); });
  document.addEventListener('click', () => downloadDropdown.classList.remove('show'));

  // Period tabs
  document.querySelectorAll('.period-tab').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.period-tab').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });



  const LABELS_6M = {!! json_encode($financials['labels']) !!};

  // 1. Financial Performance — Line
  var perfOptions = {
    series: [{
      name: 'Collections',
      data: {!! json_encode($financials['collections']) !!}
    }, {
      name: 'Disbursements',
      data: {!! json_encode($financials['disbursements']) !!}
    }],
    chart: {
      type: 'area',
      height: 250,
      fontFamily: "'DM Sans', sans-serif",
      toolbar: { show: false }
    },
    colors: ['#0d4a2f', '#84cc16'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2.5 },
    xaxis: {
      categories: LABELS_6M,
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: { style: { colors: '#6b7280', fontSize: '11px' } }
    },
    yaxis: {
      labels: {
        formatter: function (val) { return "₱" + (val / 1000) + "K"; },
        style: { colors: '#6b7280', fontSize: '11px' }
      }
    },
    grid: { borderColor: '#f3f4f6', strokeDashArray: 4 },
    legend: { show: false },
    tooltip: { theme: 'dark' }
  };
  var perfChart = new ApexCharts(document.querySelector("#performanceChart"), perfOptions);
  perfChart.render();

  // 2. Repayment Progress — Horizontal Bar
  var progOptions = {
    series: [{
      name: 'Paid %',
      data: {!! json_encode(array_column($loanProgress, 'paid_pct')) !!}
    }, {
      name: 'Remaining %',
      data: {!! json_encode(array_column($loanProgress, 'rem_pct')) !!}
    }],
    chart: {
      type: 'bar',
      height: 250,
      stacked: true,
      fontFamily: "'DM Sans', sans-serif",
      toolbar: { show: false }
    },
    colors: ['#38bdf8', '#fbbf24'],
    plotOptions: { bar: { horizontal: true, borderRadius: 4, barHeight: '50%' } },
    dataLabels: { enabled: false },
    stroke: { width: 0 },
    xaxis: {
      max: 100,
      labels: { formatter: function (val) { return val + "%" } }
    },
    yaxis: {
      categories: {!! json_encode(array_column($loanProgress, 'name')) !!},
      labels: { style: { colors: '#6b7280', fontSize: '11px' } }
    },
    grid: { show: false },
    legend: { show: false },
    tooltip: { theme: 'dark' }
  };
  var progChart = new ApexCharts(document.querySelector("#progressChart"), progOptions);
  progChart.render();

  // 3. New Members — Vertical Bar
  var dealOptions = {
    series: [{
      name: 'New Members',
      data: {!! json_encode($newMembers) !!}
    }],
    chart: {
      type: 'bar',
      height: 250,
      fontFamily: "'DM Sans', sans-serif",
      toolbar: { show: false }
    },
    colors: ['#0d4a2f'],
    plotOptions: { bar: { borderRadius: 6, columnWidth: '40%' } },
    dataLabels: { enabled: false },
    xaxis: {
      categories: {!! json_encode($memberLabels) !!},
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: { style: { colors: '#6b7280', fontSize: '11px' } }
    },
    yaxis: {
      labels: { style: { colors: '#6b7280', fontSize: '11px' } }
    },
    grid: { show: false },
    legend: { show: false },
    tooltip: { theme: 'dark' }
  };
  var dealChart = new ApexCharts(document.querySelector("#dealsChart"), dealOptions);
  dealChart.render();
</script>
</body>
</html>