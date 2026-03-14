<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Shared Capital Details | GBLDC Admin</title>
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
    .nav-item svg, .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

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
    .dropdown-item svg, .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

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

    .topbar-title h1 {
      font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }
    .topbar-spacer { flex: 1; }

    /* ── Page body ── */
    .page-body {
      padding: 32px 32px 80px;
      max-width: 960px;
      margin: 0 auto;
      flex: 1; width: 100%;
    }

    /* ── Page header banner ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 28px 32px;
      color: #fff;
      margin-bottom: 24px;
      position: relative; overflow: hidden;
      display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
    }
    .page-header::before {
      content: '';
      position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: '';
      position: absolute; bottom: -60px; right: 120px;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(255,255,255,.04);
    }
    .page-header-content { position: relative; z-index: 1; }
    .page-header-eyebrow {
      font-size: 10px; font-weight: 700; letter-spacing: .14em;
      text-transform: uppercase; color: var(--emerald);
      margin-bottom: 8px;
      display: flex; align-items: center; gap: 8px;
    }
    .page-header-eyebrow::before {
      content: ''; display: inline-block;
      width: 18px; height: 2px;
      background: var(--emerald); border-radius: 2px;
    }
    .page-header-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 24px; margin-bottom: 6px;
    }
    .page-header-content p { font-size: 13px; opacity: .7; margin-bottom: 14px; }
    .member-id-tag {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.1);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: 8px; padding: 5px 12px;
      font-size: 12px; font-weight: 600; color: rgba(255,255,255,.85);
    }
    .member-id-tag svg, .member-id-tag i[data-lucide] { width: 12px; height: 12px; color: var(--emerald); }

    .page-header-right { position: relative; z-index: 1; flex-shrink: 0; }

    /* Balance display in header */
    .header-balance-box {
      background: rgba(255,255,255,.1);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: 12px; padding: 14px 20px;
      text-align: right;
    }
    .header-balance-box .hb-label { font-size: 11px; opacity: .65; margin-bottom: 4px; text-transform: uppercase; letter-spacing: .06em; }
    .header-balance-box .hb-amount { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #fff; }
    .header-balance-box .hb-sub { font-size: 11px; opacity: .55; margin-top: 3px; }

    /* ── Section label ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* ── Card ── */
    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 20px;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .card-head {
      padding: 18px 24px;
      display: flex; align-items: center; gap: 12px;
      border-bottom: 1px solid var(--border);
    }
    .card-head-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .card-head-icon svg, .card-head-icon i[data-lucide] { width: 18px; height: 18px; color: var(--forest-mid); }
    .card-head-title { font-size: 15px; font-weight: 700; color: var(--ink); }
    .card-head-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .card-body { padding: 22px 24px; }

    /* ── Info grid ── */
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }
    .info-grid.cols3 { grid-template-columns: 1fr 1fr 1fr; }
    .info-grid .span2 { grid-column: 1 / -1; }
    @media (max-width: 680px) {
      .info-grid, .info-grid.cols3 { grid-template-columns: 1fr; }
      .info-grid .span2 { grid-column: 1; }
    }

    .info-cell {
      background: var(--sand);
      border: 1px solid #eaf3ea;
      border-radius: 10px;
      padding: 13px 16px;
      transition: border-color .15s, background .15s;
    }
    .info-cell:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .info-cell .lbl {
      font-size: 10px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .07em;
      color: var(--muted); margin-bottom: 5px;
    }
    .info-cell .data {
      font-size: 13px; color: var(--ink);
      font-weight: 600; line-height: 1.4;
    }
    .info-cell .data.amount {
      font-size: 16px; color: var(--forest-mid);
      font-family: 'Playfair Display', serif;
    }
    .info-cell .data.balance {
      font-size: 16px; color: #2563eb;
      font-family: 'Playfair Display', serif;
    }
    .info-cell .data.muted { color: var(--muted); }

    /* Capital summary strip */
    .capital-strip {
      display: grid; grid-template-columns: 1fr 1fr 1fr;
      gap: 14px; margin-bottom: 20px;
    }
    @media (max-width: 680px) { .capital-strip { grid-template-columns: 1fr; } }

    .capital-card {
      border-radius: 14px; padding: 18px 20px;
      display: flex; align-items: center; gap: 14px;
    }
    .capital-card.green  { background: #f0fdf4; border: 1.5px solid #bbf7d0; }
    .capital-card.blue   { background: #eff6ff; border: 1.5px solid #bfdbfe; }
    .capital-card.amber  { background: #fffbeb; border: 1.5px solid #fde68a; }

    .capital-icon {
      width: 42px; height: 42px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .capital-icon svg, .capital-icon i[data-lucide] { width: 20px; height: 20px; }
    .capital-card.green .capital-icon  { background: #dcfce7; color: var(--forest-mid); }
    .capital-card.blue  .capital-icon  { background: #dbeafe; color: #2563eb; }
    .capital-card.amber .capital-icon  { background: #fef3c7; color: #d97706; }

    .capital-card .c-label { font-size: 11px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px; }
    .capital-card .c-value { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; }
    .capital-card.green .c-value { color: var(--forest-mid); }
    .capital-card.blue  .c-value { color: #2563eb; }
    .capital-card.amber .c-value { color: #d97706; }
    .capital-card .c-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }

    /* ── Footer ── */
    .page-footer {
      text-align: center; padding: 20px 32px;
      color: #9ca3af; font-size: 12px;
      border-top: 1px solid var(--border);
      background: var(--white);
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
    <a href="{{route('Loan.Records')}}" class="nav-item">
      <i data-lucide="badge-check"></i> Approved Loans
    </a>
    <a href="{{route('Payment.Page')}}" class="nav-item">
      <i data-lucide="credit-card"></i> Payment
    </a>
    <a href="{{route('Add.Transactions')}}" class="nav-item">
      <i data-lucide="arrow-left-right"></i> Transactions
    </a>
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item active">
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
      <a href="{{ route('Admin.manage') }}" class="dropdown-item normal">
        <i data-lucide="shield-check" style="width:14px;height:14px;"></i> Manage Users
      </a>
      <a href="{{ route('Admin.Settings') }}" class="dropdown-item normal">
        <i data-lucide="settings" style="width:14px;height:14px;"></i> Settings
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
    <a href="{{route('Shared.Capital.List.View')}}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="topbar-title">
      <h1>Shared Capital Details</h1>
    <p>Member's shared capital contributions and details.</p>
    <div class="topbar-spacer"></div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Page header banner -->
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-header-eyebrow">Shared Capital</div>
        <h2>{{$sharedCapital->last_name}}, {{$sharedCapital->first_name}}</h2>
        <p>Member's shared capital contributions and details.</p>
        <div class="member-id-tag">
          <i data-lucide="hash"></i> Member ID: {{$sharedCapital->member_id}}
        </div>
      </div>
      <div class="page-header-right">
        <div class="header-balance-box">
          <div class="hb-label">Capital Balance</div>
          <div class="hb-amount">₱{{number_format($sharedCapital->shared_capital_amount_balance, 2)}}</div>
          <div class="hb-sub">of ₱{{number_format($sharedCapital->shared_capital_amount, 2)}} total</div>
        </div>
      </div>
    </div>

    <!-- Capital summary strip -->
    <div class="capital-strip">
      <div class="capital-card green">
        <div class="capital-icon"><i data-lucide="hand-coins"></i></div>
        <div>
          <div class="c-label">Total Capital</div>
          <div class="c-value">₱{{number_format($sharedCapital->shared_capital_amount, 2)}}</div>
          <div class="c-sub">Total contributed</div>
        </div>
      </div>
      <div class="capital-card blue">
        <div class="capital-icon"><i data-lucide="wallet"></i></div>
        <div>
          <div class="c-label">Current Balance</div>
          <div class="c-value">₱{{number_format($sharedCapital->shared_capital_amount_balance, 2)}}</div>
          <div class="c-sub">Remaining balance</div>
        </div>
      </div>
      <div class="capital-card amber">
        <div class="capital-icon"><i data-lucide="calendar"></i></div>
        <div>
          <div class="c-label">Member Since</div>
          <div class="c-value" style="font-size:15px;">{{$sharedCapital->date_of_membership}}</div>
          <div class="c-sub">Date of membership</div>
        </div>
      </div>
    </div>

    <!-- Personal Details -->
    <div class="section-label">Personal Information</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="user"></i></div>
        <div>
          <div class="card-head-title">Member Details</div>
          <div class="card-head-sub">Basic personal and contact information</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell">
            <div class="lbl">Member ID</div>
            <div class="data">{{$sharedCapital->member_id}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Full Name</div>
            <div class="data">{{$sharedCapital->last_name}}, {{$sharedCapital->first_name}} {{$sharedCapital->middle_name}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Phone</div>
            <div class="data">{{$sharedCapital->phone}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Email</div>
            <div class="data">{{$sharedCapital->email}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Address -->
    <div class="section-label">Address</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="map-pin"></i></div>
        <div>
          <div class="card-head-title">Home Address</div>
          <div class="card-head-sub">Registered address on file</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell span2">
            <div class="lbl">Street Address</div>
            <div class="data">{{$sharedCapital->street_address}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Barangay</div>
            <div class="data">{{$sharedCapital->barangay}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">City / Municipality</div>
            <div class="data">{{$sharedCapital->city}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Province</div>
            <div class="data">{{$sharedCapital->province}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Capital Info -->
    <div class="section-label">Capital &amp; Record Details</div>
    <div class="card">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="piggy-bank"></i></div>
        <div>
          <div class="card-head-title">Shared Capital Information</div>
          <div class="card-head-sub">Contribution amounts and administrative details</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid cols3" style="margin-bottom:16px;">
          <div class="info-cell">
            <div class="lbl">Shared Capital Amount</div>
            <div class="data amount">₱{{number_format($sharedCapital->shared_capital_amount, 2)}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Shared Capital Balance</div>
            <div class="data balance">₱{{number_format($sharedCapital->shared_capital_amount_balance, 2)}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Date of Membership</div>
            <div class="data">{{$sharedCapital->date_of_membership}}</div>
          </div>
        </div>
        <div class="info-grid">
          <div class="info-cell">
            <div class="lbl">Encoded By</div>
            <div class="data">{{$sharedCapital->encoded_by}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Remarks</div>
            <div class="data muted">{{$sharedCapital->remarks ?: '—'}}</div>
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