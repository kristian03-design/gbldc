<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment | GBLDC Admin</title>
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
      --rose:      #ef4444;
      --amber:     #f59e0b;
      --sky:       #3b82f6;
      --violet:    #8b5cf6;
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

    /* ══ SIDEBAR ══════════════════════════════════ */
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
    .sidebar-logo img { width: 40px; height: 40px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2; }
    .logo-sub  { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }
    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
    .nav-section-label { font-size: 10px; letter-spacing: .1em; text-transform: uppercase; opacity: .4; padding: 16px 8px 6px; }
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

    /* ══ MAIN ════════════════════════════════════ */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; gap: 14px;
      position: sticky; top: 0; z-index: 50;
    }
    .back-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      transition: background .2s; flex-shrink: 0;
    }
    .back-btn:hover { background: #a7f3d0; }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }
    .topbar-title h1 { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: var(--forest); }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    .page-body { padding: 28px 32px 60px; flex: 1; }

    /* ══ ALERTS ══════════════════════════════════ */
    .alert {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 14px 18px; border-radius: 12px;
      font-size: 14px; margin-bottom: 20px; border: 1px solid transparent;
    }
    .alert i[data-lucide] { width: 18px; height: 18px; flex-shrink: 0; margin-top: 1px; }
    .alert-success { background: #f0fdf4; border-color: #bbf7d0; color: #166534; }
    .alert-success i[data-lucide] { color: #16a34a; }
    .alert-error   { background: #fef2f2; border-color: #fecaca; color: #991b1b; }
    .alert-error i[data-lucide] { color: var(--rose); }
    .alert ul { margin: 6px 0 0 18px; font-size: 13px; }
    .alert ul li { margin-bottom: 2px; }

    /* ══ HERO BANNER ═════════════════════════════ */
    .hero-banner {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 24px 28px; color: #fff;
      display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 16px; margin-bottom: 28px;
      position: relative; overflow: hidden;
    }
    .hero-banner::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05); pointer-events: none;
    }
    .hero-content { position: relative; z-index: 1; }
    .hero-eyebrow {
      font-size: 11px; font-weight: 600; letter-spacing: .12em;
      text-transform: uppercase; opacity: .6; margin-bottom: 6px;
      display: flex; align-items: center; gap: 8px;
    }
    .hero-eyebrow::before { content: ''; width: 20px; height: 2px; background: var(--emerald); border-radius: 2px; display: inline-block; }
    .hero-banner h2 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 4px; }
    .hero-banner p { font-size: 13px; opacity: .7; }
    .hero-badge {
      position: relative; z-index: 1;
      background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
      border-radius: 12px; padding: 12px 20px;
      display: flex; align-items: center; gap: 10px;
      font-size: 13px; font-weight: 600; white-space: nowrap;
    }
    .hero-badge i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }

    /* ══ LAYOUT: two-column ═══════════════════════ */
    .content-grid {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 20px;
      align-items: start;
    }
    @media (max-width: 900px) {
      .content-grid { grid-template-columns: 1fr; }
    }

    /* ══ CARDS ════════════════════════════════════ */
    .card {
      background: var(--white); border-radius: 16px;
      border: 1px solid var(--border); overflow: hidden;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
      margin-bottom: 20px;
    }
    .card-header {
      padding: 18px 24px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: 12px;
    }
    .sec-icon {
      width: 36px; height: 36px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .sec-icon.green  { background: #dcfce7; color: #16a34a; }
    .sec-icon.blue   { background: #dbeafe; color: #2563eb; }
    .sec-icon.amber  { background: #fef3c7; color: #d97706; }
    .sec-icon.violet { background: #ede9fe; color: #7c3aed; }
    .sec-icon.sky    { background: #e0f2fe; color: #0284c7; }
    .sec-icon i[data-lucide] { width: 17px; height: 17px; }
    .card-title { font-size: 15px; font-weight: 700; color: var(--ink); }
    .card-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .card-body  { padding: 24px; }

    /* ══ QR SECTION ══════════════════════════════ */
    .qr-wrap {
      text-align: center; padding: 8px 0 4px;
    }
    .qr-wrap img {
      width: 100%; max-width: 220px; border-radius: 12px;
      border: 1px solid var(--border); margin: 0 auto;
    }
    .qr-empty {
      padding: 24px 16px; text-align: center;
      color: var(--muted); font-size: 13px;
    }
    .qr-empty i[data-lucide] {
      display: block; margin: 0 auto 10px;
      width: 40px; height: 40px; opacity: .3;
    }

    /* ══ MEMBER LOOKUP ════════════════════════════ */
    .lookup-wrap {
      position: relative;
    }
    .lookup-wrap input {
      padding-right: 44px;
    }
    .lookup-spinner {
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      width: 16px; height: 16px; display: none;
    }
    .lookup-spinner.spinning {
      display: block;
      border: 2px solid var(--border);
      border-top-color: var(--emerald);
      border-radius: 50%;
      animation: spin .7s linear infinite;
    }
    @keyframes spin { to { transform: translateY(-50%) rotate(360deg); } }

    /* Member info strip */
    .member-strip {
      display: none;
      background: #f0fdf4; border: 1px solid #bbf7d0;
      border-radius: 10px; padding: 12px 14px;
      margin-top: 8px; gap: 10px;
      align-items: center; font-size: 13px;
    }
    .member-strip.show { display: flex; }
    .member-strip i[data-lucide] { width: 16px; height: 16px; color: #16a34a; flex-shrink: 0; }
    .member-strip .mname { font-weight: 600; color: #166534; }
    .member-strip .mid   { font-size: 12px; color: #4d7c0f; margin-top: 2px; }

    /* Not-found strip */
    .member-notfound {
      display: none;
      background: #fef2f2; border: 1px solid #fecaca;
      border-radius: 10px; padding: 12px 14px;
      margin-top: 8px; gap: 10px;
      align-items: center; font-size: 13px; color: #991b1b;
    }
    .member-notfound.show { display: flex; }
    .member-notfound i[data-lucide] { width: 16px; height: 16px; color: var(--rose); flex-shrink: 0; }

    /* ══ FIELDS ══════════════════════════════════ */
    .g2 { display: grid; grid-template-columns: repeat(2,1fr); gap: 16px; margin-bottom: 16px; }
    .g3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; margin-bottom: 16px; }
    .g1 { display: grid; grid-template-columns: 1fr;           gap: 16px; margin-bottom: 16px; }
    @media (max-width: 700px) { .g2, .g3 { grid-template-columns: 1fr; } }

    .field { display: flex; flex-direction: column; gap: 6px; }
    .field label { font-size: 13px; font-weight: 600; color: var(--ink); display: flex; align-items: center; gap: 5px; }
    .req { color: var(--rose); }
    .autofilled-badge {
      font-size: 10px; font-weight: 600; padding: 2px 7px; border-radius: 20px;
      background: #dcfce7; color: #166534; letter-spacing: .04em;
    }
    .field input, .field select, .field textarea {
      width: 100%; padding: 9px 12px;
      border: 1.5px solid var(--border); border-radius: 9px;
      font-family: 'DM Sans', sans-serif; font-size: 14px;
      color: var(--ink); background: var(--white);
      transition: border-color .2s, box-shadow .2s, background .3s; outline: none;
      appearance: auto;
    }
    .field input:focus, .field select:focus, .field textarea:focus {
      border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .field input.autofilled {
      background: #f0fdf4; border-color: #86efac; color: #166534;
    }
    .field input[readonly]:not(.autofilled) { background: #f9fafb; color: var(--muted); cursor: default; }
    .field input::placeholder, .field textarea::placeholder { color: #9ca3af; }
    .field textarea { resize: vertical; min-height: 90px; }

    /* ══ UPLOAD ZONES ════════════════════════════ */
    .upload-zone {
      border: 2px dashed var(--border); border-radius: 12px;
      padding: 20px 16px; text-align: center; cursor: pointer;
      transition: border-color .2s, background .2s;
      position: relative;
    }
    .upload-zone:hover { border-color: #86efac; background: #f0fdf4; }
    .upload-zone.done  { border-color: var(--emerald); background: #f0fdf4; }
    .upload-zone input[type="file"] {
      position: absolute; inset: 0; opacity: 0;
      cursor: pointer; width: 100%; height: 100%;
    }
    .upload-zone i[data-lucide] { display: block; margin: 0 auto 8px; width: 24px; height: 24px; color: var(--muted); }
    .upload-zone.done i[data-lucide] { color: var(--emerald); }
    .uz-title { font-size: 13px; font-weight: 600; color: var(--ink); }
    .uz-sub   { font-size: 11px; color: var(--muted); margin-top: 2px; }
    .uz-name  { font-size: 11px; color: var(--emerald); font-weight: 600; margin-top: 6px; word-break: break-all; }
    .upload-preview {
      margin-top: 10px; width: 64px; height: 64px;
      object-fit: cover; border-radius: 8px;
      border: 2px solid var(--border); display: none;
    }

    /* ══ ACTIONS ═════════════════════════════════ */
    .form-actions { display: flex; justify-content: flex-end; gap: 12px; padding-top: 8px; }
    .btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 10px 22px; border-radius: 10px;
      font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
      cursor: pointer; border: none; text-decoration: none;
      transition: background .2s, transform .1s;
    }
    .btn:active { transform: scale(.98); }
    .btn i[data-lucide] { width: 15px; height: 15px; }
    .btn-ghost   { background: #f3f4f6; color: var(--ink); }
    .btn-ghost:hover { background: #e5e7eb; }
    .btn-primary { background: var(--forest); color: #fff; }
    .btn-primary:hover { background: var(--forest-mid); box-shadow: 0 4px 14px rgba(13,74,47,.28); }

    /* scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    @media (max-width: 700px) {
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

<!-- ═══════════════════════════════════
     SIDEBAR
═══════════════════════════════════ -->
<aside class="sidebar">
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
    <a href="{{route('LoanApp.list')}}" class="nav-item">
      <i data-lucide="file-text"></i> Loan Applications
    </a>
    <a href="{{route('Loan.Records')}}" class="nav-item">
      <i data-lucide="badge-check"></i> Approved Loans
    </a>
    <a href="{{route('Payment.Page')}}" class="nav-item active">
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
  <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');">
    <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
  </button>
    <a href="{{ route('Admin.dashboard') }}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="topbar-title">
      <h1>Payment Entry</h1>
      <p>Record a member transaction</p>
    </div>
  </header>

  <div class="page-body">

    {{-- Alerts --}}
    @if(session('error'))
    <div class="alert alert-error">
      <i data-lucide="triangle-alert"></i>
      <div><strong>Error!</strong> {{ session('error') }}</div>
    </div>
    @endif

    @if(session('Record-updated'))
    <div class="alert alert-success">
      <i data-lucide="circle-check"></i>
      <div>{{ session('Record-updated') }}</div>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-error">
      <i data-lucide="triangle-alert"></i>
      <div>
        <strong>Please correct the following errors:</strong>
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      </div>
    </div>
    @endif

    {{-- Hero --}}
    <div class="hero-banner">
      <div class="hero-content">
        <div class="hero-eyebrow">Finance</div>
        <h2>Transaction Entry Form</h2>
        <p>Enter the Member ID to auto-fill member details, then complete the payment information.</p>
      </div>
      <div class="hero-badge">
        <i data-lucide="credit-card"></i> Payment Processing
      </div>
    </div>

    <div class="content-grid">

      {{-- ── LEFT COLUMN: QR Code ── --}}
      <div>
        <div class="card">
          <div class="card-header">
            <div class="sec-icon green"><i data-lucide="qr-code"></i></div>
            <div>
              <div class="card-title">GCash QR Code</div>
              <div class="card-sub">Scan to pay via GCash</div>
            </div>
          </div>
          <div class="card-body">
            @if($activeQRCode && !empty($activeQRCode->qr_image_path))
              <div class="qr-wrap">
                @php
  $qrSrc = (str_starts_with($activeQRCode->qr_image_path ?? '', 'qr-codes/'))
    ? asset('storage/' . $activeQRCode->qr_image_path)
    : asset('images/' . $activeQRCode->qr_image_path);
@endphp
                <img id="qr-code-img" src="{{ $qrSrc }}" alt="GCash QR Code">
                <p style="font-size:12px;color:var(--muted);margin-top:10px;display:flex;align-items:center;justify-content:center;gap:5px;">
                  <i data-lucide="circle-check" style="width:13px;height:13px;color:#16a34a;"></i>
                  Active QR Code
                </p>
              </div>
            @else
              <div class="qr-empty">
                <i data-lucide="qr-code"></i>
                <p style="font-weight:600;margin-bottom:4px;">No QR Code uploaded</p>
                <p style="font-size:12px;">Upload from Admin Dashboard</p>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- ── RIGHT COLUMN: Form ── --}}
      <div>
        <form action="{{route('Payment.Submit')}}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ① Member Lookup --}}
        <div class="card">
          <div class="card-header">
            <div class="sec-icon green"><i data-lucide="user-search"></i></div>
            <div>
              <div class="card-title">Member Lookup</div>
              <div class="card-sub">Type the Member ID to auto-fill name fields</div>
            </div>
          </div>
          <div class="card-body">

            <div class="g2">
              <div class="field" style="grid-column:1/-1;">
                <label>Member ID <span class="req">*</span></label>
                <div class="lookup-wrap">
                  <input type="text" id="member_id" name="member_id" placeholder="e.g. 92919982" required autocomplete="off">
                  <div class="lookup-spinner" id="lookup-spinner"></div>
                </div>
                {{-- Success strip --}}
                <div class="member-strip" id="member-found-strip">
                  <i data-lucide="circle-check"></i>
                  <div>
                    <div class="mname" id="strip-name"></div>
                    <div class="mid" id="strip-id"></div>
                  </div>
                </div>
                {{-- Not-found strip --}}
                <div class="member-notfound" id="member-notfound-strip">
                  <i data-lucide="user-x"></i>
                  <span>No member found with this ID. You can still fill in manually.</span>
                </div>
              </div>

              <div class="field">
                <label>
                  Last Name <span class="req">*</span>
                  <span class="autofilled-badge" id="badge-last" style="display:none;">Auto-filled</span>
                </label>
                <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
              </div>

              <div class="field">
                <label>
                  First Name <span class="req">*</span>
                  <span class="autofilled-badge" id="badge-first" style="display:none;">Auto-filled</span>
                </label>
                <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
              </div>

              <div class="field">
                <label>
                  Middle Name
                  <span class="autofilled-badge" id="badge-middle" style="display:none;">Auto-filled</span>
                </label>
                <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name">
              </div>

              <div class="field">
                <label>Loan Number<span class="req">*</span>
                  <span class="autofilled-badge" id="badge-first" style="display:none;">Auto-filled</span>
                </label>
                <input type="text" id="loan_no" name="loan_number" placeholder="e.g. LN-202401-000001">
              </div>
            </div>

          </div>
        </div>

        {{-- ② Transaction Details --}}
        <div class="card">
          <div class="card-header">
            <div class="sec-icon blue"><i data-lucide="receipt"></i></div>
            <div>
              <div class="card-title">Transaction Details</div>
              <div class="card-sub">Payment type, method, and status</div>
            </div>
          </div>
          <div class="card-body">

            <div class="g2">
              <div class="field">
                <label>Type of Transaction <span class="req">*</span></label>
                <select name="transaction_type" required>
                  <option value="" disabled selected>Select Type</option>
                  <option value="Shared Capital">Shared Capital Payment</option>
                  <option value="Loan Payment">Loan Payment</option>
                  <option value="Time Deposit">Time Deposit</option>
                  <option value="Savings">Savings</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="field">
                <label>Payment Method <span class="req">*</span></label>
                <select name="payment_method" required>
                  <option value="" disabled selected>Select Method</option>
                  <option value="cash">Cash</option>
                  <option value="Gcash">GCash</option>
                  <option value="credit_card">Credit Card</option>
                  <option value="debit_card">Debit Card</option>
                  <option value="bank_transfer">Bank Transfer</option>
                  <option value="check">Check</option>
                  <option value="online_wallet">Online Wallet</option>
                </select>
              </div>

              <div class="field">
                <label>Payment Status <span class="req">*</span></label>
                <select name="payment_status" required>
                  <option value="" disabled selected>Select Status</option>
                  <option value="On-time">On Time</option>
                  <option value="Late">Late</option>
                  <option value="Early">Early</option>
                </select>
              </div>

              <div class="field">
                <label>Date of Transaction <span class="req">*</span></label>
                <input type="date" name="transaction_date" required>
              </div>
            </div>

          </div>
        </div>

        {{-- ③ Payment Info --}}
        <div class="card">
          <div class="card-header">
            <div class="sec-icon amber"><i data-lucide="banknote"></i></div>
            <div>
              <div class="card-title">Payment Information</div>
              <div class="card-sub">Reference number, amount, and handler details</div>
            </div>
          </div>
          <div class="card-body">

            <div class="g2">
              <div class="field">
                <label>Reference Number <span class="req">*</span></label>
                <input type="text"
                       name="reference_number"
                       id="reference_number"
                       placeholder="0000—0000—00000"
                       required
                       inputmode="numeric"
                       autocomplete="off"
                       maxlength="15"
                       pattern="^[0-9]{4}—[0-9]{4}—[0-9]{5}$"
                       title="Enter a 13-digit GCash reference number in the format 0000—0000—00000">
              </div>

              <div class="field">
                <label>Amount of Payment <span class="req">*</span></label>
                <input type="number" name="payment_amount" step="0.01" min="0" placeholder="0.00" required>
              </div>

              <div class="field">
                <label>Transaction Handler <span class="req">*</span></label>
                <input type="text" name="transaction_handler" placeholder="Handler's Full Name" required>
              </div>

              <div class="field">
                <label>Updated / Saved By <span class="req">*</span></label>
                <input type="text" name="updater_name" placeholder="Encoder's Full Name" required>
              </div>
            </div>

            <div class="g1">
              <div class="field">
                <label>Remarks</label>
                <textarea name="remarks" placeholder="Optional notes about this transaction…"></textarea>
              </div>
            </div>

          </div>
        </div>

        {{-- ④ Attachments --}}
        <div class="card">
          <div class="card-header">
            <div class="sec-icon violet"><i data-lucide="paperclip"></i></div>
            <div>
              <div class="card-title">Attachments</div>
              <div class="card-sub">Upload receipt photos — member copy and coop copy</div>
            </div>
          </div>
          <div class="card-body">

            <div class="g2">
              <div class="field">
                <label>Member Copy <span class="req">*</span></label>
                <div class="upload-zone" id="zone-member">
                  <input type="file" name="member_copy" accept="image/*" required onchange="handleUpload(this,'zone-member','prev-member','lbl-member')">
                  <i data-lucide="image"></i>
                  <div class="uz-title">Click to upload</div>
                  <div class="uz-sub">Receipt — Member Copy</div>
                  <div class="uz-name" id="lbl-member"></div>
                </div>
                <img id="prev-member" class="upload-preview">
              </div>

              <div class="field">
                <label>Coop Copy <span class="req">*</span></label>
                <div class="upload-zone" id="zone-coop">
                  <input type="file" name="admin_copy" accept="image/*" required onchange="handleUpload(this,'zone-coop','prev-coop','lbl-coop')">
                  <i data-lucide="image"></i>
                  <div class="uz-title">Click to upload</div>
                  <div class="uz-sub">Receipt — Coop Copy</div>
                  <div class="uz-name" id="lbl-coop"></div>
                </div>
                <img id="prev-coop" class="upload-preview">
              </div>
            </div>

          </div>
        </div>

        {{-- Submit --}}
        <div class="card">
          <div class="card-body">
            <div class="form-actions">
              <a href="{{ route('Admin.dashboard') }}" class="btn btn-ghost">
                <i data-lucide="x"></i> Cancel
              </a>
              <button type="submit" class="btn btn-primary">
                <i data-lucide="send"></i> Submit Transaction
              </button>
            </div>
          </div>
        </div>

        </form>
      </div><!-- /right col -->

    </div><!-- /content-grid -->
  </div><!-- /page-body -->

  <footer style="padding:18px 32px;border-top:1px solid var(--border);background:var(--white);font-size:12px;color:var(--muted);text-align:center;">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div><!-- /main -->

<script>
  lucide.createIcons();

  // ── User menu ──────────────────────────────────
  const menuBtn  = document.getElementById('user-menu-button');
  const menuDrop = document.getElementById('user-menu-dropdown');
  menuBtn.addEventListener('click', e => {
    e.stopPropagation();
    menuDrop.style.display = menuDrop.style.display === 'block' ? 'none' : 'block';
  });
  document.addEventListener('click', () => { menuDrop.style.display = 'none'; });

  // ── Member ID Auto-fill ────────────────────────
  const memberIdInput   = document.getElementById('member_id');
  const spinner         = document.getElementById('lookup-spinner');
  const foundStrip      = document.getElementById('member-found-strip');
  const notfoundStrip   = document.getElementById('member-notfound-strip');
  const stripName       = document.getElementById('strip-name');
  const stripId         = document.getElementById('strip-id');

  const fieldLast   = document.getElementById('last_name');
  const fieldFirst  = document.getElementById('first_name');
  const fieldMiddle = document.getElementById('middle_name');
  const fieldLoanNo = document.getElementById('loan_no');

  const badgeLast   = document.getElementById('badge-last');
  const badgeFirst  = document.getElementById('badge-first');
  const badgeMiddle = document.getElementById('badge-middle');

  let lookupTimer = null;

  function clearAutofill() {
    [fieldLast, fieldFirst, fieldMiddle].forEach(f => {
      f.classList.remove('autofilled');
      f.removeAttribute('readonly');
    });
    if (fieldLoanNo) {
      fieldLoanNo.value = '';
      fieldLoanNo.classList.remove('autofilled');
      fieldLoanNo.removeAttribute('readonly');
    }
    [badgeLast, badgeFirst, badgeMiddle].forEach(b => b.style.display = 'none');
    foundStrip.classList.remove('show');
    notfoundStrip.classList.remove('show');
  }

  function applyAutofill(member) {
    fieldLast.value   = member.last_name   ?? '';
    fieldFirst.value  = member.first_name  ?? '';
    fieldMiddle.value = member.middle_name ?? '';
    if (fieldLoanNo) {
      const ln = (member.loan_number ?? '').toString().trim();
      fieldLoanNo.value = ln;
      if (ln) {
        fieldLoanNo.classList.add('autofilled');
        fieldLoanNo.setAttribute('readonly', 'readonly');
      } else {
        fieldLoanNo.classList.remove('autofilled');
        fieldLoanNo.removeAttribute('readonly');
      }
    }

    [fieldLast, fieldFirst, fieldMiddle].forEach(f => f.classList.add('autofilled'));
    [badgeLast, badgeFirst, badgeMiddle].forEach(b => b.style.display = 'inline-flex');

    const fullName = [member.last_name, member.first_name, member.middle_name].filter(Boolean).join(', ');
    stripName.textContent = fullName;
    stripId.textContent   = 'Member ID: ' + member.member_id;
    foundStrip.classList.add('show');
    notfoundStrip.classList.remove('show');
    lucide.createIcons();
  }

  memberIdInput.addEventListener('input', function () {
    const id = this.value.trim();
    clearAutofill();
    clearTimeout(lookupTimer);

    if (id.length < 3) return;

    lookupTimer = setTimeout(() => {
      spinner.classList.add('spinning');

      fetch(`{{ route('Member.Lookup') }}?member_id=${encodeURIComponent(id)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
      })
      .then(res => res.json())
      .then(data => {
        spinner.classList.remove('spinning');
        if (data.success && data.member) {
          applyAutofill(data.member);
        } else {
          notfoundStrip.classList.add('show');
          lucide.createIcons();
        }
      })
      .catch(() => {
        spinner.classList.remove('spinning');
      });
    }, 500); // 500ms debounce
  });

  // Allow manual editing of autofilled fields by clicking them
  [fieldLast, fieldFirst, fieldMiddle].forEach(f => {
    f.addEventListener('focus', function () {
      this.classList.remove('autofilled');
    });
  });

  // ── File upload preview ────────────────────────
  function handleUpload(input, zoneId, previewId, labelId) {
    const file = input.files[0];
    if (!file) return;
    const zone    = document.getElementById(zoneId);
    const preview = document.getElementById(previewId);
    const lbl     = document.getElementById(labelId);
    zone.classList.add('done');
    lbl.textContent = '✓ ' + file.name;
    lucide.createIcons();
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
      reader.readAsDataURL(file);
    }
  }

  // ── Reference number digits-only ───────────────
  const refInput = document.getElementById('reference_number');
  if (refInput) {
    refInput.addEventListener('input', function () {
      const digits = this.value.replace(/\D+/g, '').slice(0, 13);
      let formatted = digits;
      const sep = '—';
      if (digits.length > 4)  formatted = digits.slice(0, 4) + sep + digits.slice(4);
      if (digits.length > 8)  formatted = digits.slice(0, 4) + sep + digits.slice(4, 8) + sep + digits.slice(8);
      this.value = formatted;
    });
  }
</script>
</body>
</html>