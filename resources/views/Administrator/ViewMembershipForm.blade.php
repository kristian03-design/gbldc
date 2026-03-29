<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Member Details | GBLDC Admin</title>
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
      --rose:      #ef4444;
      --sidebar-w: 240px;
      --topbar-h:  57px;
      --banner-h:  100px;
      --tabnav-h:  49px;
      --bar-h:     72px;
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

    /* ─── Main shell ─── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; height: 100vh; overflow: hidden; }

    /* ─── Topbar ─── */
    .topbar {
      height: var(--topbar-h); flex-shrink: 0;
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 0 32px; display: flex; align-items: center; gap: 10px; z-index: 50;
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

    /* ─── Profile Banner ─── */
    .profile-banner {
      flex-shrink: 0;
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      padding: 18px 32px; color: #fff;
      display: flex; align-items: center; justify-content: space-between; gap: 16px;
      position: relative; overflow: hidden;
    }
    .profile-banner::before { content: ''; position: absolute; top: -40px; right: -40px; width: 180px; height: 180px; border-radius: 50%; background: rgba(255,255,255,.05); }
    .profile-banner::after  { content: ''; position: absolute; bottom: -50px; right: 100px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,.04); }
    .pbl { display: flex; align-items: center; gap: 14px; position: relative; z-index: 1; }
    .pbl-avatar { width: 48px; height: 48px; border-radius: 12px; background: rgba(255,255,255,.15); border: 2px solid rgba(255,255,255,.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .pbl-avatar i[data-lucide] { width: 22px; height: 22px; color: #fff; }
    .pbl-name { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; line-height: 1.2; }
    .pbl-sub  { font-size: 11px; opacity: .65; margin-top: 2px; }
    .pbl-tag  { display: inline-flex; align-items: center; gap: 5px; margin-top: 6px; border-radius: 6px; padding: 3px 9px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; background: rgba(245,158,11,.2); border: 1px solid rgba(245,158,11,.35); color: #fbbf24; }
    .pbl-tag i[data-lucide] { width: 10px; height: 10px; }
    .pbr { position: relative; z-index: 1; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15); border-radius: 12px; padding: 11px 16px; text-align: right; min-width: 150px; flex-shrink: 0; }
    .pbr-row { margin-bottom: 6px; }
    .pbr-row:last-child { margin-bottom: 0; }
    .pbr-lbl { font-size: 9px; opacity: .6; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 1px; }
    .pbr-val { font-size: 12px; font-weight: 600; }

    /* ─── Tab Nav ─── */
    .tab-nav {
      flex-shrink: 0; height: var(--tabnav-h);
      background: var(--white); border-bottom: 2px solid var(--border);
      padding: 0 32px; display: flex; gap: 0; overflow-x: auto;
    }
    .tab-nav::-webkit-scrollbar { display: none; }
    .tab-btn {
      display: flex; align-items: center; gap: 7px;
      padding: 0 18px; font-size: 13px; font-weight: 600;
      color: var(--muted); background: none; border: none;
      border-bottom: 2px solid transparent; margin-bottom: -2px;
      cursor: pointer; white-space: nowrap;
      transition: color .2s, border-color .2s;
    }
    .tab-btn:hover { color: var(--forest); }
    .tab-btn.active { color: var(--forest); border-bottom-color: var(--emerald); }
    .tab-btn i[data-lucide] { width: 14px; height: 14px; }
    .tab-count { background: #f3f4f6; color: var(--muted); font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 20px; }
    .tab-btn.active .tab-count { background: var(--sage); color: var(--forest); }

    /* ─── Tab scroll area ─── */
    .tab-panels {
      flex: 1; overflow-y: auto;
      padding: 24px 32px calc(var(--bar-h) + 16px);
    }
    .tab-panel { display: none; animation: fadeTab .2s ease; }
    .tab-panel.active { display: block; }
    @keyframes fadeTab { from { opacity:0; transform:translateY(5px); } to { opacity:1; transform:translateY(0); } }

    /* ─── Card ─── */
    .card { background: var(--white); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 16px; box-shadow: 0 1px 4px rgba(0,0,0,.04); }
    .card-head { padding: 15px 22px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--border); }
    .card-head-icon { width: 34px; height: 34px; border-radius: 9px; background: var(--sage); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .card-head-icon i[data-lucide] { width: 16px; height: 16px; color: var(--forest-mid); }
    .card-head-title { font-size: 14px; font-weight: 700; color: var(--ink); }
    .card-head-sub   { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .card-body { padding: 18px 22px; }

    /* ─── Info grid ─── */
    .info-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; }
    .info-grid.cols2 { grid-template-columns: 1fr 1fr; }
    .info-grid .span2 { grid-column: span 2; }
    .info-grid .span3 { grid-column: 1 / -1; }
    .info-cell { background: var(--sand); border: 1px solid #eaf3ea; border-radius: 10px; padding: 11px 14px; transition: border-color .15s, background .15s; }
    .info-cell:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .info-cell .lbl { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin-bottom: 3px; }
    .info-cell .data { font-size: 13px; color: var(--ink); font-weight: 600; line-height: 1.4; }
    .info-cell .data.mono  { font-family: monospace; letter-spacing: .04em; font-size: 12px; }
    .info-cell .data.green { color: var(--forest-mid); }

    /* ─── Attachments ─── */
    .attachments-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; }
    .attachment-item  { display: flex; flex-direction: column; gap: 8px; }
    .attachment-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); }
    .attachment-frame { border: 1px solid var(--border); border-radius: 12px; overflow: hidden; background: #f9fafb; aspect-ratio: 4/3; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: border-color .2s, box-shadow .2s; position: relative; }
    .attachment-frame:hover { border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.12); }
    .attachment-frame img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .attachment-zoom { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,.35); opacity: 0; transition: opacity .2s; border-radius: 11px; }
    .attachment-zoom i[data-lucide] { width: 24px; height: 24px; color: #fff; }
    .attachment-frame:hover .attachment-zoom { opacity: 1; }

    /* ─── Decision Bar ─── */
    .decision-bar {
      position: fixed; bottom: 0;
      left: var(--sidebar-w); right: 0; height: var(--bar-h);
      background: var(--white); border-top: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 32px; z-index: 60;
      box-shadow: 0 -4px 24px rgba(0,0,0,.07);
    }
    .dbl { display: flex; align-items: center; gap: 10px; }
    .dbl-icon { width: 36px; height: 36px; border-radius: 10px; background: #fef3c7; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .dbl-icon i[data-lucide] { width: 17px; height: 17px; color: #d97706; }
    .dbl-title { font-size: 14px; font-weight: 700; color: var(--ink); }
    .dbl-sub   { font-size: 11px; color: var(--muted); }
    .dbr { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .approve-form { display: flex; align-items: center; gap: 8px; }
    .member-id-input { padding: 9px 13px; border: 1px solid var(--border); border-radius: 10px; font-size: 13px; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color .2s, box-shadow .2s; width: 185px; }
    .member-id-input:focus { border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.1); }
    .member-id-input::placeholder { color: #9ca3af; }
    .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 10px; font-size: 13px; font-weight: 700; border: none; cursor: pointer; transition: background .2s, transform .1s; font-family: 'DM Sans', sans-serif; white-space: nowrap; }
    .btn:active { transform: scale(.97); }
    .btn i[data-lucide] { width: 14px; height: 14px; }
    .btn.approve { background: var(--forest); color: #fff; }
    .btn.approve:hover { background: var(--forest-mid); }
    .btn.reject  { background: #fee2e2; color: #991b1b; }
    .btn.reject:hover  { background: #fecaca; }
    .btn-sep { width: 1px; height: 30px; background: var(--border); flex-shrink: 0; }

    /* ─── Lightbox ─── */
    .lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.82); z-index: 300; align-items: center; justify-content: center; padding: 20px; }
    .lightbox.open { display: flex; }
    .lightbox img { max-width: 90vw; max-height: 90vh; border-radius: 12px; object-fit: contain; }
    .lb-close { position: absolute; top: 20px; right: 20px; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,.15); border: none; cursor: pointer; color: #fff; display: flex; align-items: center; justify-content: center; transition: background .2s; }
    .lb-close:hover { background: rgba(255,255,255,.25); }
    .lb-close i[data-lucide] { width: 18px; height: 18px; }

    /* ─── Toast ─── */
    .toast-container { position: fixed; bottom: calc(var(--bar-h) + 16px); right: 28px; z-index: 500; display: flex; flex-direction: column; gap: 10px; pointer-events: none; }
    .toast { display: flex; align-items: flex-start; gap: 12px; padding: 14px 18px; border-radius: 14px; min-width: 300px; max-width: 380px; box-shadow: 0 8px 32px rgba(0,0,0,.14); pointer-events: all; animation: toastIn .35s cubic-bezier(.34,1.56,.64,1) forwards; position: relative; overflow: hidden; }
    .toast.hiding { animation: toastOut .3s ease forwards; }
    @keyframes toastIn  { from { opacity:0; transform:translateX(60px) scale(.95); } to { opacity:1; transform:translateX(0) scale(1); } }
    @keyframes toastOut { from { opacity:1; transform:translateX(0) scale(1); } to { opacity:0; transform:translateX(60px) scale(.95); } }
    .toast.success { background:#f0fdf4; border:1px solid #86efac; }
    .toast.error   { background:#fef2f2; border:1px solid #fca5a5; }
    .toast.warning { background:#fffbeb; border:1px solid #fcd34d; }
    .toast-icon { width:34px; height:34px; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .toast.success .toast-icon { background:#dcfce7; }
    .toast.success .toast-icon i[data-lucide] { width:17px; height:17px; color:#16a34a; }
    .toast.error   .toast-icon { background:#fee2e2; }
    .toast.error   .toast-icon i[data-lucide] { width:17px; height:17px; color:#dc2626; }
    .toast.warning .toast-icon { background:#fef3c7; }
    .toast.warning .toast-icon i[data-lucide] { width:17px; height:17px; color:#d97706; }
    .toast-body { flex:1; }
    .toast-title { font-size:13px; font-weight:700; margin-bottom:2px; }
    .toast.success .toast-title { color:#14532d; }
    .toast.error   .toast-title { color:#7f1d1d; }
    .toast.warning .toast-title { color:#78350f; }
    .toast-msg { font-size:12px; line-height:1.5; }
    .toast.success .toast-msg { color:#166534; }
    .toast.error   .toast-msg { color:#991b1b; }
    .toast.warning .toast-msg { color:#92400e; }
    .toast-close { background:none; border:none; cursor:pointer; padding:2px; border-radius:5px; flex-shrink:0; opacity:.5; transition:opacity .15s; display:flex; align-items:center; }
    .toast-close:hover { opacity:1; }
    .toast-close i[data-lucide] { width:13px; height:13px; }
    .toast.success .toast-close { color:#166534; }
    .toast.error   .toast-close { color:#991b1b; }
    .toast-progress { position:absolute; bottom:0; left:0; height:3px; border-radius:0 0 14px 14px; animation:toastProgress linear forwards; }
    .toast.success .toast-progress { background:#22c55e; }
    .toast.error   .toast-progress { background:#ef4444; }
    .toast.warning .toast-progress { background:#f59e0b; }
    @keyframes toastProgress { from { width:100%; } to { width:0%; } }

    ::-webkit-scrollbar { width:5px; height:5px; }
    ::-webkit-scrollbar-track { background:transparent; }
    ::-webkit-scrollbar-thumb { background:#d1d5db; border-radius:5px; }

    @media (max-width: 860px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar, .tab-panels { padding-left: 16px; padding-right: 16px; }
      .profile-banner { padding: 16px; flex-direction: column; align-items: flex-start; }
      .tab-nav { padding: 0 16px; }
      .decision-bar { left: 0; padding: 0 16px; }
      .attachments-grid { grid-template-columns: 1fr 1fr; }
      .info-grid { grid-template-columns: 1fr 1fr; }
      .info-grid .span3 { grid-column: 1/-1; }
      .info-grid .span2 { grid-column: span 1; }
    }
    @media (max-width: 480px) {
      .attachments-grid { grid-template-columns: 1fr; }
      .info-grid, .info-grid.cols2 { grid-template-columns: 1fr; }
      .info-grid .span2, .info-grid .span3 { grid-column: 1; }
      .decision-bar { flex-direction: column; height: auto; padding: 12px 16px; gap: 8px; }
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
    <a href="{{route('Manage.Members')}}"   class="nav-item active"><i data-lucide="user-plus"></i> Member Registration</a>
    <a href="{{route('Member.List')}}"      class="nav-item"><i data-lucide="users"></i> Official Members</a>
    <div class="nav-section-label">Finance</div>
    <a href="{{route('LoanApp.list')}}"             class="nav-item"><i data-lucide="file-text"></i> Loan Applications</a>
    <a href="{{route('Loan.Records')}}"             class="nav-item"><i data-lucide="badge-check"></i> Approved Loans</a>
    <a href="{{route('Payment.Page')}}"             class="nav-item"><i data-lucide="credit-card"></i> Payment</a>
    <a href="{{route('Add.Transactions')}}"         class="nav-item"><i data-lucide="arrow-left-right"></i> Transactions</a>
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item"><i data-lucide="piggy-bank"></i> Shared Capital</a>
    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}"   class="nav-item"><i data-lucide="shield-check"></i> Manage Users</a>
    <a href="{{route('Admin.Settings')}}" class="nav-item"><i data-lucide="settings"></i> Settings</a>
  </nav>
  <div class="sidebar-footer">
    <div class="user-card" id="user-menu-button">
      <div class="avatar">A</div>
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
    <a href="{{ route('Manage.Members') }}" class="back-btn"><i data-lucide="arrow-left"></i> Back</a>
    <div class="breadcrumb">
      <a href="{{ route('Admin.dashboard') }}">Dashboard</a>
      <i data-lucide="chevron-right"></i>
      <a href="{{ route('Manage.Members') }}">Member Registration</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">{{$Review->last_name}}, {{$Review->first_name}}</span>
    </div>
  </header>

  <!-- Profile Banner -->
  <div class="profile-banner">
    <div class="pbl">
      <div class="pbl-avatar"><i data-lucide="user"></i></div>
      <div>
        <div class="pbl-name">{{$Review->last_name}}, {{$Review->first_name}} {{$Review->middle_name}}</div>
        <div class="pbl-sub">Membership Application — Pending Admin Review</div>
        <span class="pbl-tag"><i data-lucide="clock"></i> Pending Review</span>
      </div>
    </div>
    <div class="pbr">
      <div class="pbr-row">
        <div class="pbr-lbl">Applied On</div>
        <div class="pbr-val">
          <span id="liveAppliedDate" data-initial="{{ \Carbon\Carbon::parse($Review->created_at)->format('M d, Y') }}">
            {{ \Carbon\Carbon::parse($Review->created_at)->format('M d, Y') }}
          </span>
        </div>
      </div>
      <div class="pbr-row">
        <div class="pbr-lbl">Time</div>
        <div class="pbr-val">
          <span id="liveAppliedTime" data-initial="{{ \Carbon\Carbon::parse($Review->created_at)->format('h:i A') }}">
            {{ \Carbon\Carbon::parse($Review->created_at)->format('h:i A') }}
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Nav -->
  <div class="tab-nav" role="tablist">
    <button class="tab-btn active" data-tab="personal"   role="tab"><i data-lucide="user"></i> Personal</button>
    <button class="tab-btn"        data-tab="contact"    role="tab"><i data-lucide="map-pin"></i> Contact & Address</button>
    <button class="tab-btn"        data-tab="emergency"  role="tab"><i data-lucide="heart-handshake"></i> Emergency</button>
    <button class="tab-btn"        data-tab="employment" role="tab"><i data-lucide="briefcase"></i> Employment</button>
    <button class="tab-btn"        data-tab="documents"  role="tab"><i data-lucide="paperclip"></i> Documents <span class="tab-count">3</span></button>
  </div>

  <!-- Tab Panels -->
  <div class="tab-panels">

    <!-- ① Personal -->
    <div class="tab-panel active" id="tab-personal">
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="user"></i></div>
          <div><div class="card-head-title">Basic Information</div><div class="card-head-sub">Identity and demographic details</div></div>
        </div>
        <div class="card-body">
          <div class="info-grid">
            <div class="info-cell span3"><div class="lbl">Full Name</div><div class="data">{{$Review->last_name}}, {{$Review->first_name}} {{$Review->middle_name}}</div></div>
            <div class="info-cell"><div class="lbl">Birthdate</div><div class="data">{{$Review->birthdate}}</div></div>
            <div class="info-cell"><div class="lbl">Place of Birth</div><div class="data">{{$Review->place_of_birth}}</div></div>
            <div class="info-cell"><div class="lbl">Age</div><div class="data">{{$Review->age}}</div></div>
            <div class="info-cell"><div class="lbl">Gender</div><div class="data">{{$Review->gender}}</div></div>
            <div class="info-cell"><div class="lbl">Civil Status</div><div class="data">{{$Review->civil_status}}</div></div>
            <div class="info-cell"><div class="lbl">Religion</div><div class="data">{{$Review->religion}}</div></div>
            <div class="info-cell"><div class="lbl">Nationality</div><div class="data">{{$Review->nationality}}</div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ② Contact & Address -->
    <div class="tab-panel" id="tab-contact">
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="phone"></i></div>
          <div><div class="card-head-title">Contact Information</div><div class="card-head-sub">Email and phone number on file</div></div>
        </div>
        <div class="card-body">
          <div class="info-grid cols2">
            <div class="info-cell"><div class="lbl">Email Address</div><div class="data">{{$Review->email}}</div></div>
            <div class="info-cell"><div class="lbl">Phone Number</div><div class="data">0{{$Review->contact_number}}</div></div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="map-pin"></i></div>
          <div><div class="card-head-title">Home Address</div><div class="card-head-sub">Registered residential address</div></div>
        </div>
        <div class="card-body">
          <div class="info-grid">
            <div class="info-cell span3"><div class="lbl">Street Address</div><div class="data">{{$Review->street_address}}</div></div>
            <div class="info-cell"><div class="lbl">Barangay</div><div class="data">{{$Review->barangay}}</div></div>
            <div class="info-cell"><div class="lbl">City / Municipality</div><div class="data">{{$Review->city}}</div></div>
            <div class="info-cell"><div class="lbl">Province</div><div class="data">{{$Review->province}}</div></div>
            <div class="info-cell"><div class="lbl">Zip Code</div><div class="data">{{$Review->zip_code}}</div></div>
            <div class="info-cell"><div class="lbl">Years of Stay</div><div class="data">{{$Review->year_of_stay}}</div></div>
            <div class="info-cell"><div class="lbl">House Ownership</div><div class="data">{{$Review->house_ownership}}</div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ③ Emergency Contact -->
    <div class="tab-panel" id="tab-emergency">
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="heart-handshake"></i></div>
          <div><div class="card-head-title">Emergency Contact</div><div class="card-head-sub">Person to contact in case of emergency</div></div>
        </div>
        <div class="card-body">
          <div class="info-grid">
            <div class="info-cell span2"><div class="lbl">Full Name</div><div class="data">{{$Review->ec_fullname}}</div></div>
            <div class="info-cell"><div class="lbl">Relationship</div><div class="data">{{$Review->ec_relationship}}</div></div>
            <div class="info-cell"><div class="lbl">Gender</div><div class="data">{{$Review->ec_gender}}</div></div>
            <div class="info-cell"><div class="lbl">Contact Number</div><div class="data">{{$Review->ec_contact_number}}</div></div>
            <div class="info-cell"><div class="lbl">Email</div><div class="data">{{$Review->ec_email}}</div></div>
            <div class="info-cell span3"><div class="lbl">Address</div><div class="data">{{$Review->address}}</div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ④ Employment -->
    <div class="tab-panel" id="tab-employment">
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="briefcase"></i></div>
          <div><div class="card-head-title">Employment Information</div><div class="card-head-sub">Occupation, income, and government IDs</div></div>
        </div>
        <div class="card-body">
          <div class="info-grid">
            <div class="info-cell"><div class="lbl">Employment Status</div><div class="data">{{$Review->employment_status}}</div></div>
            <div class="info-cell"><div class="lbl">Occupation</div><div class="data">{{$Review->occupation}}</div></div>
            <div class="info-cell"><div class="lbl">Source of Funds</div><div class="data">{{$Review->source_of_funds}}</div></div>
            <div class="info-cell span2"><div class="lbl">Employer / Business Name</div><div class="data">{{$Review->employer_business_name}}</div></div>
            <div class="info-cell"><div class="lbl">Gross Monthly Income</div><div class="data green">{{$Review->gross_monthly_income}}</div></div>
            <div class="info-cell span3"><div class="lbl">Company / Business Address</div><div class="data">{{$Review->company_business_address}}</div></div>
            <div class="info-cell span3"><div class="lbl">Nature / Type of Employment or Business</div><div class="data">{{$Review->nature_type_of_employment_business}}</div></div>
            <div class="info-cell"><div class="lbl">SSS / GSIS No.</div><div class="data mono">{{$Review->sss_gsis_no}}</div></div>
            <div class="info-cell"><div class="lbl">TIN No.</div><div class="data mono">{{$Review->tin_no}}</div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ⑤ Documents -->
    <div class="tab-panel" id="tab-documents">
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="paperclip"></i></div>
          <div><div class="card-head-title">Supporting Documents</div><div class="card-head-sub">Click any document to view full size</div></div>
        </div>
        <div class="card-body">
          <div class="attachments-grid">
            <div class="attachment-item">
              <div class="attachment-label">Proof of Billing</div>
              <div class="attachment-frame" onclick="openLightbox('data:{{ $Proof_of_Billings_MimeType }};base64,{{ $Proof_of_Billings_Base64 }}')">
                <img src="data:{{ $Proof_of_Billings_MimeType }};base64,{{ $Proof_of_Billings_Base64 }}" alt="Proof of Billing">
                <div class="attachment-zoom"><i data-lucide="zoom-in"></i></div>
              </div>
            </div>
            <div class="attachment-item">
              <div class="attachment-label">2×2 Picture</div>
              <div class="attachment-frame" onclick="openLightbox('data:{{ $two_by_two_picture_MimeType }};base64,{{ $two_by_two_picture_Base64 }}')">
                <img src="data:{{ $two_by_two_picture_MimeType }};base64,{{ $two_by_two_picture_Base64 }}" alt="2×2 Picture">
                <div class="attachment-zoom"><i data-lucide="zoom-in"></i></div>
              </div>
            </div>
            <div class="attachment-item">
              <div class="attachment-label">Valid ID</div>
              <div class="attachment-frame" onclick="openLightbox('data:{{ $valid_id_MimeType }};base64,{{ $valid_id_Base64 }}')">
                <img src="data:{{ $valid_id_MimeType }};base64,{{ $valid_id_Base64 }}" alt="Valid ID">
                <div class="attachment-zoom"><i data-lucide="zoom-in"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /tab-panels -->
</div><!-- /main -->

<!-- ═══ Decision Bar ═══ -->
<div class="decision-bar">
  <div class="dbl">
    <div class="dbl-icon"><i data-lucide="gavel"></i></div>
    <div><div class="dbl-title">Admin Decision</div><div class="dbl-sub">A Member ID will be auto-assigned on approval. Reject to decline.</div></div>
  </div>
  <div class="dbr">
    <form action="{{route('Approve.member')}}" method="POST" class="approve-form">
      @csrf
      <input type="hidden" name="id" value="{{$Review->id}}">
      <span style="font-size:12px;color:#6b7280;font-style:italic;"><i data-lucide="tag" style="width:12px;height:12px;display:inline;"></i> Auto ID: GBLDC-####</span>
      <button type="submit" class="btn approve"><i data-lucide="circle-check-big"></i> Approve</button>
    </form>
    <div class="btn-sep"></div>
    <form action="{{route('Reject.member')}}" method="POST">
      @csrf
      <input type="hidden" name="id" value="{{$Review->id}}">
      <button type="submit" class="btn reject"><i data-lucide="x-circle"></i> Reject</button>
    </form>
  </div>
</div>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
  <button class="lb-close" id="lb-close"><i data-lucide="x"></i></button>
  <img id="lightbox-img" src="" alt="Document Preview">
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

{{-- Flash messages --}}
@if(session('success'))  <script>window.__toasts=window.__toasts||[];window.__toasts.push({type:'success',title:'Success',msg:'{{ session('success') }}'});</script> @endif
@if(session('approved')) <script>window.__toasts=window.__toasts||[];window.__toasts.push({type:'success',title:'Member Approved',msg:'{{ session('approved') }}'});</script> @endif
@if(session('rejected')) <script>window.__toasts=window.__toasts||[];window.__toasts.push({type:'error',title:'Application Rejected',msg:'{{ session('rejected') }}'});</script> @endif
@if(session('error'))    <script>window.__toasts=window.__toasts||[];window.__toasts.push({type:'error',title:'Error',msg:'{{ session('error') }}'});</script> @endif
@if(session('warning'))  <script>window.__toasts=window.__toasts||[];window.__toasts.push({type:'warning',title:'Warning',msg:'{{ session('warning') }}'});</script> @endif

<script>
  lucide.createIcons();

  // User menu
  const userBtn = document.getElementById('user-menu-button');
  const userDrop = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => { e.stopPropagation(); userDrop.style.display = userDrop.style.display === 'block' ? 'none' : 'block'; });
  document.addEventListener('click', () => { userDrop.style.display = 'none'; });

  // Tabs
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
    });
  });

  // Lightbox
  function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.add('open');
  }
  function closeLightbox() { document.getElementById('lightbox').classList.remove('open'); }
  document.getElementById('lb-close').addEventListener('click', closeLightbox);
  document.getElementById('lightbox').addEventListener('click', e => { if (e.target === document.getElementById('lightbox')) closeLightbox(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

  // Toast
  const T_ICONS = { success:'circle-check-big', error:'x-circle', warning:'alert-triangle' };
  function showToast(type, title, msg, dur=4500) {
    const c = document.getElementById('toastContainer');
    const t = document.createElement('div');
    t.className = `toast ${type}`;
    t.innerHTML = `<div class="toast-icon"><i data-lucide="${T_ICONS[type]}"></i></div><div class="toast-body"><div class="toast-title">${title}</div><div class="toast-msg">${msg}</div></div><button class="toast-close"><i data-lucide="x"></i></button><div class="toast-progress" style="animation-duration:${dur}ms;"></div>`;
    c.appendChild(t); lucide.createIcons({ nodes:[t] });
    const dismiss = () => { t.classList.add('hiding'); t.addEventListener('animationend', ()=>t.remove(), {once:true}); };
    t.querySelector('.toast-close').addEventListener('click', dismiss);
    setTimeout(dismiss, dur);
  }
  window.showToast = showToast;
  document.addEventListener('DOMContentLoaded', () => { (window.__toasts||[]).forEach(({type,title,msg})=>showToast(type,title,msg)); });

  // Live clock for "Applied On" + "Time" (Asia/Manila)
  (function () {
    const dateEl = document.getElementById('liveAppliedDate');
    const timeEl = document.getElementById('liveAppliedTime');
    if (!dateEl || !timeEl) return;

    const fmtDate = new Intl.DateTimeFormat('en-US', { timeZone: 'Asia/Manila', month: 'short', day: '2-digit', year: 'numeric' });
    const fmtTime = new Intl.DateTimeFormat('en-US', { timeZone: 'Asia/Manila', hour: '2-digit', minute: '2-digit', hour12: true });

    const tick = () => {
      const now = new Date();
      dateEl.textContent = fmtDate.format(now);
      timeEl.textContent = fmtTime.format(now);
    };

    tick();

    // #region agent log
    fetch('http://127.0.0.1:7579/ingest/8c61df52-cd0e-4f20-a319-4e8e75f954da',{method:'POST',headers:{'Content-Type':'application/json','X-Debug-Session-Id':'4b0db3'},body:JSON.stringify({sessionId:'4b0db3',runId:'live-clock',hypothesisId:'H-LIVE-CLOCK',location:'ViewMembershipForm.blade.php:liveClock',message:'Live Applied On/Time initialized',data:{initialDate:(dateEl.dataset.initial||''),initialTime:(timeEl.dataset.initial||''),firstDate:dateEl.textContent,firstTime:timeEl.textContent,tz:'Asia/Manila'},timestamp:Date.now()})}).catch(()=>{});
    // #endregion

    setInterval(tick, 1000);
  })();
</script>
</body>
</html>