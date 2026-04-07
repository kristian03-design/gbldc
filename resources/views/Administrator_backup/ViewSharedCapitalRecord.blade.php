<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment Receipt | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
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
      --rose:      #ef4444;
      --sidebar-w: 240px;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'DM Sans', sans-serif; background: var(--sand); color: var(--ink); min-height: 100vh; display: flex; }

    /* ─── Sidebar ─── */
    .sidebar {
      width: var(--sidebar-w); background: var(--forest); color: #fff;
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; bottom: 0; z-index: 100;
    }
    .sidebar-logo { display: flex; align-items: center; gap: 12px; padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,.1); }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; color: #fff; line-height: 1.2; }
    .logo-sub  { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }
    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
    .nav-section-label { font-size: 10px; letter-spacing: .1em; text-transform: uppercase; opacity: .4; padding: 16px 8px 6px; }
    .nav-item {
      display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 10px;
      text-decoration: none; color: rgba(255,255,255,.7); font-size: 14px; font-weight: 500;
      transition: background .2s, color .2s; margin-bottom: 2px;
    }
    .nav-item:hover  { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }
    .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.1); }
    .user-card { display: flex; align-items: center; gap: 10px; padding: 10px; border-radius: 10px; cursor: pointer; transition: background .2s; }
    .user-card:hover { background: rgba(255,255,255,.08); }
    .avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--forest-mid); border: 2px solid var(--emerald); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0; }
    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; }
    #user-menu-dropdown { display: none; background: #0a3d27; border-radius: 10px; padding: 6px; margin-top: 6px; }
    .dropdown-item { display: flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 7px; text-decoration: none; font-size: 13px; transition: background .15s; }
    .dropdown-item:hover { background: rgba(255,255,255,.08); }
    .dropdown-item.normal { color: rgba(255,255,255,.8); }
    .dropdown-item.danger { color: #f87171; }
    .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

    /* ─── Main ─── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ─── Topbar ─── */
    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 14px 32px; display: flex; align-items: center; gap: 10px;
      position: sticky; top: 0; z-index: 50;
    }
    .back-btn {
      display: flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest); text-decoration: none; font-size: 13px; font-weight: 600;
      border: none; cursor: pointer; transition: background .2s, transform .1s; white-space: nowrap; flex-shrink: 0;
    }
    .back-btn:hover { background: #a7f3d0; transform: translateX(-2px); }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }
    .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--muted); flex-wrap: wrap; }
    .breadcrumb a { color: var(--forest-mid); text-decoration: none; font-weight: 600; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb i[data-lucide] { width: 12px; height: 12px; opacity: .4; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ─── Page body ─── */
    .page-body { padding: 32px 32px 64px; flex: 1; width: 100%; max-width: 960px; margin: 0 auto; }

    /* ─── Page header banner ─── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 26px 30px; color: #fff;
      margin-bottom: 28px; position: relative; overflow: hidden;
      display: flex; align-items: flex-start; justify-content: space-between; gap: 20px;
    }
    .page-header::before { content:''; position:absolute; top:-40px; right:-40px; width:200px; height:200px; border-radius:50%; background:rgba(255,255,255,.05); }
    .page-header::after  { content:''; position:absolute; bottom:-60px; right:120px; width:140px; height:140px; border-radius:50%; background:rgba(255,255,255,.04); }
    .ph-left { position: relative; z-index: 1; display: flex; align-items: center; gap: 16px; }
    .ph-icon { width: 54px; height: 54px; border-radius: 14px; background: rgba(255,255,255,.15); border: 2px solid rgba(255,255,255,.25); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .ph-icon i[data-lucide] { width: 26px; height: 26px; color: #fff; }
    .ph-eyebrow { font-size: 10px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: var(--emerald); margin-bottom: 7px; display: flex; align-items: center; gap: 7px; }
    .ph-eyebrow::before { content:''; display:inline-block; width:16px; height:2px; background:var(--emerald); border-radius:2px; }
    .ph-name { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 5px; }
    .ph-sub  { font-size: 12px; opacity: .65; margin-bottom: 10px; }
    .ph-ref  {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
      border-radius: 8px; padding: 5px 11px;
      font-family: 'Courier New', monospace; font-size: 12px; font-weight: 700; letter-spacing: .04em;
    }
    .ph-ref i[data-lucide] { width: 12px; height: 12px; opacity: .7; flex-shrink: 0; }
    .ph-ref-dash { color: rgba(255,255,255,.5); margin: 0 1px; font-weight: 400; }

    .ph-right { position: relative; z-index: 1; flex-shrink: 0; display: flex; flex-direction: column; gap: 8px; align-items: flex-end; }
    .ph-stat {
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 12px; padding: 12px 18px; text-align: right; min-width: 160px;
    }
    .ph-stat-lbl { font-size: 9px; opacity: .6; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 3px; }
    .ph-stat-val { font-size: 13px; font-weight: 700; }
    .ph-stat-val.amount { font-size: 20px; color: #6ee7b7; }

    /* ─── Alert ─── */
    .alert { display: flex; align-items: flex-start; gap: 10px; padding: 13px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 500; }
    .alert.error   { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; }
    .alert.success { background: #f0fdf4; border: 1px solid #86efac; color: #14532d; }
    .alert i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }

    /* ─── Section label ─── */
    .section-label { font-size: 11px; letter-spacing: .1em; text-transform: uppercase; color: var(--muted); font-weight: 600; margin-bottom: 12px; }

    /* ─── Card ─── */
    .card { background: var(--white); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 18px; box-shadow: 0 1px 4px rgba(0,0,0,.04); }
    .card-head { padding: 15px 22px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--border); }
    .card-head-icon { width: 34px; height: 34px; border-radius: 9px; background: var(--sage); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .card-head-icon i[data-lucide] { width: 16px; height: 16px; color: var(--forest-mid); }
    .card-head-icon.amber { background: #fef3c7; }
    .card-head-icon.amber i[data-lucide] { color: #d97706; }
    .card-head-icon.sky { background: #eff6ff; }
    .card-head-icon.sky i[data-lucide] { color: #2563eb; }
    .card-head-title { font-size: 14px; font-weight: 700; color: var(--ink); }
    .card-head-sub   { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .card-body { padding: 18px 22px; }

    /* ─── Info grid ─── */
    .info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
    .info-grid.cols2 { grid-template-columns: 1fr 1fr; }
    .info-grid .span2 { grid-column: span 2; }
    .info-grid .span3 { grid-column: 1 / -1; }
    .info-cell { background: var(--sand); border: 1px solid #eaf3ea; border-radius: 10px; padding: 11px 14px; transition: border-color .15s, background .15s; }
    .info-cell:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .info-cell.highlight { background: linear-gradient(135deg, #f0fdf4, #dcfce7); border-color: #86efac; }
    .info-cell.highlight:hover { border-color: #4ade80; }
    .info-cell .lbl { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin-bottom: 3px; }
    .info-cell .data { font-size: 13px; color: var(--ink); font-weight: 600; line-height: 1.4; }
    .info-cell .data.mono  { font-family: 'Courier New', monospace; letter-spacing: .05em; font-size: 12px; }
    .info-cell .data.green { color: var(--forest-mid); }
    .info-cell .data.big   { font-size: 22px; font-weight: 700; color: var(--forest); }

    /* em-dash reference segments */
    .ref-seg  { }
    .ref-dash { color: var(--muted); margin: 0 2px; font-weight: 400; }

    /* ─── Status pill ─── */
    .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
    .pill.paid    { background: #dcfce7; color: #15803d; }
    .pill.late    { background: #fee2e2; color: #b91c1c; }
    .pill.pending { background: #fef3c7; color: #92400e; }
    .pill i[data-lucide] { width: 11px; height: 11px; }

    /* ─── Remarks ─── */
    .remarks-box { background: var(--sand); border: 1px solid #eaf3ea; border-radius: 10px; padding: 14px 16px; font-size: 13px; color: var(--ink); line-height: 1.75; min-height: 60px; }

    /* ─── Receipt images ─── */
    .receipt-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .receipt-item { display: flex; flex-direction: column; gap: 8px; }
    .receipt-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); }
    .receipt-frame {
      border: 1px solid var(--border); border-radius: 14px; overflow: hidden;
      background: #f9fafb; min-height: 180px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: border-color .2s, box-shadow .2s; position: relative;
    }
    .receipt-frame:hover { border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.12); }
    .receipt-frame img { width: 100%; display: block; }
    .receipt-zoom { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,.32); opacity: 0; transition: opacity .2s; border-radius: 13px; }
    .receipt-zoom i[data-lucide] { width: 26px; height: 26px; color: #fff; }
    .receipt-frame:hover .receipt-zoom { opacity: 1; }
    .receipt-caption { font-size: 11px; color: var(--muted); text-align: center; }

    /* ─── Divider ─── */
    .section-divider { height: 1px; background: var(--border); margin: 8px 0 24px; }

    /* ─── Lightbox ─── */
    .lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.82); z-index: 300; align-items: center; justify-content: center; padding: 20px; }
    .lightbox.open { display: flex; }
    .lightbox img { max-width: 90vw; max-height: 90vh; border-radius: 12px; object-fit: contain; }
    .lb-close { position: absolute; top: 20px; right: 20px; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,.15); border: none; cursor: pointer; color: #fff; display: flex; align-items: center; justify-content: center; transition: background .2s; }
    .lb-close:hover { background: rgba(255,255,255,.25); }
    .lb-close i[data-lucide] { width: 18px; height: 18px; }

    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 5px; }

    @media (max-width: 860px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar, .page-body { padding-left: 16px; padding-right: 16px; }
      .page-header { flex-direction: column; align-items: flex-start; }
      .ph-right { align-items: flex-start; flex-direction: row; flex-wrap: wrap; }
      .info-grid { grid-template-columns: 1fr 1fr; }
      .info-grid .span3 { grid-column: 1/-1; }
      .info-grid .span2 { grid-column: span 1; }
      .receipt-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
      .info-grid, .info-grid.cols2 { grid-template-columns: 1fr; }
      .info-grid .span2, .info-grid .span3 { grid-column: 1; }
    }
  </style>
</head>
<body>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC" style="width:40px;height:40px;object-fit:cover;border-radius:10px;flex-shrink:0;" />
    <div><div class="logo-text">GBLDC</div><div class="logo-sub">Admin Portal</div></div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="{{route('Admin.dashboard')}}"  class="nav-item"><i data-lucide="layout-dashboard"></i> Overview</a>
    <a href="{{route('Manage.Members')}}"   class="nav-item"><i data-lucide="user-plus"></i> Member Registration</a>
    <a href="{{route('Member.List')}}"      class="nav-item"><i data-lucide="users"></i> Official Members</a>
    <div class="nav-section-label">Finance</div>
    <a href="{{route('LoanApp.list')}}"             class="nav-item"><i data-lucide="file-text"></i> Loan Applications</a>
    <a href="{{route('Loan.Records')}}"             class="nav-item"><i data-lucide="badge-check"></i> Approved Loans</a>
    <a href="{{route('Payment.Page')}}"             class="nav-item active"><i data-lucide="credit-card"></i> Payment</a>
    <a href="{{route('Add.Transactions')}}"         class="nav-item"><i data-lucide="arrow-left-right"></i> Transactions</a>
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item"><i data-lucide="piggy-bank"></i> Shared Capital</a>
    <div class="nav-section-label">Reports</div>
    <a href="{{route('Admin.Reports')}}" class="nav-item">
      <i data-lucide="bar-chart-2"></i> Cooperative Reports
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}"   class="nav-item"><i data-lucide="shield-check"></i> Manage Users</a>
    <a href="{{route('Admin.Settings')}}" class="nav-item"><i data-lucide="settings"></i> Settings</a>
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
      <div class="user-info"><div class="name">Admin</div><div class="role">Super Administrator</div></div>
      <i data-lucide="more-vertical" style="margin-left:auto;opacity:.4;width:14px;height:14px;"></i>
    </div>
    <div id="user-menu-dropdown">
      <a href="#" class="dropdown-item normal"><i data-lucide="user"></i> Profile</a>
      <a href="{{route('Admin.Settings')}}" class="dropdown-item normal"><i data-lucide="settings"></i> Settings</a>
      <a href="{{ route('Admin.Logout') }}" class="dropdown-item danger"><i data-lucide="log-out"></i> Logout</a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <a href="{{ route('View.SCP.History', $Record->member_id) }}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="breadcrumb">
      <a href="{{ route('Admin.dashboard') }}">Dashboard</a>
      <i data-lucide="chevron-right"></i>
      <a href="{{ route('Payment.Page') }}">Payment</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">Transaction Receipt</span>
    </div>
  </header>

  <!-- Page Body -->
  <div class="page-body">

    @if(session('error'))
    <div class="alert error"><i data-lucide="alert-circle"></i> {{ session('error') }}</div>
    @endif
    @if(session('Record-updated'))
    <div class="alert success"><i data-lucide="circle-check-big"></i> {{ session('Record-updated') }}</div>
    @endif

    <!-- ── Banner ── -->
    <div class="page-header">
      <div class="ph-left">
        <div class="ph-icon"><i data-lucide="receipt"></i></div>
        <div>
          <div class="ph-eyebrow">Transaction Record</div>
          <div class="ph-name">{{$Record->last_name}}, {{$Record->first_name}} {{$Record->middle_name}}</div>
          <div class="ph-sub">Member ID: {{$Record->member_id}} &nbsp;&bull;&nbsp; Loan No: {{$Record->loan_number}}</div>
          <div class="ph-ref" id="ph-ref-display">
            <i data-lucide="hash"></i>
            <span id="ph-ref-text"></span>
          </div>
        </div>
      </div>
      <div class="ph-right">
        <div class="ph-stat">
          <div class="ph-stat-lbl">Amount Paid</div>
          <div class="ph-stat-val amount">₱{{ number_format($Record->payment_amount, 2) }}</div>
        </div>
        <div class="ph-stat">
          <div class="ph-stat-lbl">Transaction Date</div>
          <div class="ph-stat-val">{{ \Carbon\Carbon::parse($Record->transaction_date)->format('M d, Y') }}</div>
        </div>
      </div>
    </div>

    <!-- ── ① Member & Loan ── -->
    <div class="section-label">Member & Loan Information</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="user"></i></div>
        <div><div class="card-head-title">Borrower Details</div><div class="card-head-sub">Member identity and loan reference</div></div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell">
            <div class="lbl">Member ID</div>
            <div class="data mono green">{{$Record->member_id}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Loan Number</div>
            <div class="data mono">{{$Record->loan_number}}</div>
          </div>
          <div class="info-cell" style="visibility:hidden;"></div>
          <div class="info-cell">
            <div class="lbl">Last Name</div>
            <div class="data">{{$Record->last_name}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">First Name</div>
            <div class="data">{{$Record->first_name}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Middle Name</div>
            <div class="data">{{$Record->middle_name}}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="section-divider"></div>

    <!-- ── ② Payment Details ── -->
    <div class="section-label">Payment Details</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon amber"><i data-lucide="credit-card"></i></div>
        <div><div class="card-head-title">Transaction Information</div><div class="card-head-sub">Amount, method, status, and reference</div></div>
      </div>
      <div class="card-body">
        <div class="info-grid" style="margin-bottom: 10px;">
          <div class="info-cell highlight span3">
            <div class="lbl">Amount of Payment</div>
            <div class="data big">₱{{ number_format($Record->payment_amount, 2) }}</div>
          </div>
        </div>
        <div class="info-grid">
          <div class="info-cell">
            <div class="lbl">Transaction Type</div>
            <div class="data">{{$Record->transaction_type}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Payment Method</div>
            <div class="data">{{$Record->payment_method}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Payment Status</div>
            <div class="data" id="status-cell"></div>
          </div>
          <div class="info-cell">
            <div class="lbl">Date of Transaction</div>
            <div class="data">{{ \Carbon\Carbon::parse($Record->transaction_date)->format('F d, Y') }}</div>
          </div>
          <div class="info-cell span2">
            <div class="lbl">Reference Number</div>
            <div class="data mono" id="ref-cell"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="section-divider"></div>

    <!-- ── ③ Handlers ── -->
    <div class="section-label">Recorded By</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon sky"><i data-lucide="shield-check"></i></div>
        <div><div class="card-head-title">Transaction Handlers</div><div class="card-head-sub">Personnel who processed and saved this record</div></div>
      </div>
      <div class="card-body">
        <div class="info-grid cols2">
          <div class="info-cell">
            <div class="lbl">Transaction Handler</div>
            <div class="data">{{$Record->transaction_handler}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Updated / Saved By</div>
            <div class="data">{{$Record->updater_name}}</div>
          </div>
        </div>
      </div>
    </div>

    @if($Record->remarks)
    <div class="section-divider"></div>

    <!-- ── ④ Remarks ── -->
    <div class="section-label">Remarks</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="message-square"></i></div>
        <div><div class="card-head-title">Additional Notes</div><div class="card-head-sub">Notes recorded with this transaction</div></div>
      </div>
      <div class="card-body">
        <div class="remarks-box">{{$Record->remarks}}</div>
      </div>
    </div>
    @endif

    <div class="section-divider"></div>

    <!-- ── ⑤ Receipt Copies ── -->
    <div class="section-label">Receipt Copies</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="image"></i></div>
        <div><div class="card-head-title">Physical Receipt Documents</div><div class="card-head-sub">Click any receipt to view full size</div></div>
      </div>
      <div class="card-body">
        <div class="receipt-grid">
          <div class="receipt-item">
            <div class="receipt-label">Member Receipt Copy</div>
            <div class="receipt-frame" onclick="openLightbox('data:{{ $MemberMimeType }};base64,{{ $MemberBase64 }}')">
              <img src="data:{{ $MemberMimeType }};base64,{{ $MemberBase64 }}" alt="Member Receipt">
              <div class="receipt-zoom"><i data-lucide="zoom-in"></i></div>
            </div>
            <div class="receipt-caption">Given to member upon payment</div>
          </div>
          <div class="receipt-item">
            <div class="receipt-label">Cooperative Receipt Copy</div>
            <div class="receipt-frame" onclick="openLightbox('data:{{ $AdminMimeType }};base64,{{ $AdminBase64 }}')">
              <img src="data:{{ $AdminMimeType }};base64,{{ $AdminBase64 }}" alt="Coop Receipt">
              <div class="receipt-zoom"><i data-lucide="zoom-in"></i></div>
            </div>
            <div class="receipt-caption">Retained by the cooperative</div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /page-body -->
</div><!-- /main -->

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
  <button class="lb-close" id="lb-close"><i data-lucide="x"></i></button>
  <img id="lightbox-img" src="" alt="Receipt Preview">
</div>

<script>
  lucide.createIcons();

  // ── User menu ──
  const userBtn  = document.getElementById('user-menu-button');
  const userDrop = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => { e.stopPropagation(); userDrop.style.display = userDrop.style.display === 'block' ? 'none' : 'block'; });
  document.addEventListener('click', () => { userDrop.style.display = 'none'; });

  // ── Em-dash reference formatter ──
  // Splits reference number into chunks of 4 separated by " — "
  // e.g. "TXN20240001234" → "TXN2 — 0240 — 0001 — 234"
  function formatRef(raw, chunkSize = 4) {
    if (!raw) return '—';
    const clean = String(raw).replace(/[-\s]/g, '');
    const chunks = [];
    for (let i = 0; i < clean.length; i += chunkSize) chunks.push(clean.slice(i, i + chunkSize));
    return chunks.join(' — ');
  }

  const RAW_REF = @json($Record->reference_number);
  const formatted = formatRef(RAW_REF);

  // Banner
  document.getElementById('ph-ref-text').textContent = formatted;

  // Info cell (plain text in monospace cell)
  document.getElementById('ref-cell').textContent = formatted;

  // ── Status pill ──
  function statusPill(status) {
    const s = (status || '').toLowerCase();
    if (s.includes('late'))
      return `<span class="pill late"><i data-lucide="alert-circle"></i> ${status}</span>`;
    if (s.includes('paid') || s.includes('on time'))
      return `<span class="pill paid"><i data-lucide="circle-check-big"></i> ${status}</span>`;
    return `<span class="pill pending">${status}</span>`;
  }

  const statusCell = document.getElementById('status-cell');
  statusCell.innerHTML = statusPill(@json($Record->payment_status));
  lucide.createIcons({ nodes: [statusCell] });

  // ── Lightbox ──
  function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.add('open');
  }
  function closeLightbox() { document.getElementById('lightbox').classList.remove('open'); }
  document.getElementById('lb-close').addEventListener('click', closeLightbox);
  document.getElementById('lightbox').addEventListener('click', e => { if (e.target === document.getElementById('lightbox')) closeLightbox(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
</body>
</html>