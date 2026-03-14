<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shared Capital Form | GBLDC Admin</title>
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

    /* ══ ALERT ════════════════════════════════════ */
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

    /* ══ FORM CARDS ══════════════════════════════ */
    .form-card {
      background: var(--white); border-radius: 16px;
      border: 1px solid var(--border); overflow: hidden;
      margin-bottom: 20px; box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .form-card-header {
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
    .sec-icon.rose   { background: #fee2e2; color: #dc2626; }
    .sec-icon i[data-lucide] { width: 17px; height: 17px; }
    .card-title { font-size: 15px; font-weight: 700; color: var(--ink); }
    .card-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }

    /* read-only notice badge */
    .readonly-badge {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 20px;
      background: #f3f4f6; color: var(--muted); margin-left: auto;
    }
    .readonly-badge i[data-lucide] { width: 11px; height: 11px; }

    .form-card-body { padding: 24px; }

    /* ══ GRIDS ════════════════════════════════════ */
    .g3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; margin-bottom: 16px; }
    .g2 { display: grid; grid-template-columns: repeat(2,1fr); gap: 16px; margin-bottom: 16px; }
    .g1 { display: grid; grid-template-columns: 1fr;           gap: 16px; margin-bottom: 16px; }
    @media (max-width: 900px) { .g3 { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 640px) { .g3, .g2 { grid-template-columns: 1fr; } }

    /* ══ FIELDS ══════════════════════════════════ */
    .field { display: flex; flex-direction: column; gap: 6px; }
    .field label { font-size: 13px; font-weight: 600; color: var(--ink); }
    .req { color: var(--rose); }
    .field input, .field select, .field textarea {
      width: 100%; padding: 9px 12px;
      border: 1.5px solid var(--border); border-radius: 9px;
      font-family: 'DM Sans', sans-serif; font-size: 14px;
      color: var(--ink); background: var(--white);
      transition: border-color .2s, box-shadow .2s; outline: none;
      appearance: auto;
    }
    .field input:focus, .field select:focus, .field textarea:focus {
      border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    /* Read-only fields */
    .field input[readonly], .field textarea[readonly] {
      background: #f9fafb; color: var(--muted);
      cursor: default; border-color: #f0f0f0;
    }
    .field input[readonly]:focus, .field textarea[readonly]:focus {
      border-color: #e5e7eb; box-shadow: none;
    }
    .field input::placeholder, .field textarea::placeholder { color: #9ca3af; }
    .field textarea { resize: vertical; min-height: 88px; }
    .field-error { font-size: 12px; color: var(--rose); margin-top: 2px; display: flex; align-items: center; gap: 4px; }
    .field-error i[data-lucide] { width: 12px; height: 12px; }

    /* ══ PAYMENT SCHEDULE CALCULATOR ═════════════ */
    .schedule-calc {
      background: linear-gradient(135deg, #f0fdf4 0%, #f0f9ff 100%);
      border: 1.5px solid #bbf7d0;
      border-radius: 14px; padding: 20px 22px; margin-top: 4px;
    }
    .schedule-calc-title {
      font-size: 13px; font-weight: 700; color: var(--forest);
      display: flex; align-items: center; gap: 8px; margin-bottom: 16px;
    }
    .schedule-calc-title i[data-lucide] { width: 15px; height: 15px; color: var(--emerald); }

    .calc-grid {
      display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
    }
    @media (max-width: 700px) { .calc-grid { grid-template-columns: 1fr; } }

    .calc-item {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 10px; padding: 12px 14px;
    }
    .calc-item .ci-label {
      font-size: 11px; font-weight: 600; color: var(--muted);
      text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px;
    }
    .calc-item .ci-value {
      font-size: 18px; font-weight: 700; color: var(--ink);
      font-variant-numeric: tabular-nums;
    }
    .calc-item .ci-value.highlight { color: var(--forest); }
    .calc-item .ci-sub {
      font-size: 11px; color: var(--muted); margin-top: 2px;
    }

    .calc-note {
      font-size: 12px; color: var(--muted); margin-top: 14px;
      display: flex; align-items: flex-start; gap: 6px; line-height: 1.5;
    }
    .calc-note i[data-lucide] { width: 13px; height: 13px; color: var(--amber); flex-shrink: 0; margin-top: 1px; }

    /* ══ ACTIONS ═════════════════════════════════ */
    .form-actions { display: flex; justify-content: space-between; align-items: center; gap: 12px; }
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
    <a href="#" class="nav-item">
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
  <header class="topbar">
    <a href="{{route('Add.Transactions')}}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="topbar-title">
      <h1>Shared Capital Form</h1>
      <p>Register shared capital contribution for this member</p>
    </div>
  </header>

  <div class="page-body">

    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert alert-success">
      <i data-lucide="circle-check"></i>
      <div><strong>Success!</strong> {{ session('success') }}</div>
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
        <h2>Shared Capital Registration</h2>
        <p>Personal and contact details are pre-filled from the member's record and cannot be edited here.</p>
      </div>
      <div class="hero-badge">
        <i data-lucide="piggy-bank"></i> Shared Capital Entry
      </div>
    </div>

    <form action="{{route('Save.Shared.Capital')}}" method="POST">
    @csrf

    {{-- ① Personal Information (read-only) --}}
    <div class="form-card">
      <div class="form-card-header">
        <div class="sec-icon green"><i data-lucide="user"></i></div>
        <div>
          <div class="card-title">Personal Information</div>
          <div class="card-sub">Pulled from member registration — read only</div>
        </div>
        <span class="readonly-badge"><i data-lucide="lock"></i> Read Only</span>
      </div>
      <div class="form-card-body">

        <div class="g3">
          <div class="field">
            <label>Last Name</label>
            <input type="text" name="last_name" value="{{ $details->last_name }}" readonly tabindex="-1">
          </div>
          <div class="field">
            <label>First Name</label>
            <input type="text" name="first_name" value="{{ $details->first_name }}" readonly tabindex="-1">
          </div>
          <div class="field">
            <label>Middle Name</label>
            <input type="text" name="middle_name" value="{{ $details->middle_name }}" readonly tabindex="-1">
          </div>
        </div>

      </div>
    </div>

    {{-- ② Address (read-only) --}}
    <div class="form-card">
      <div class="form-card-header">
        <div class="sec-icon blue"><i data-lucide="map-pin"></i></div>
        <div>
          <div class="card-title">Address</div>
          <div class="card-sub">Residential address from member record — read only</div>
        </div>
        <span class="readonly-badge"><i data-lucide="lock"></i> Read Only</span>
      </div>
      <div class="form-card-body">

        <div class="g2">
          <div class="field">
            <label>Street Address</label>
            <input type="text" name="street_address" value="{{ $details->street_address }}" readonly tabindex="-1">
          </div>
          <div class="field">
            <label>Barangay</label>
            <input type="text" name="barangay" value="{{ $details->barangay }}" readonly tabindex="-1">
          </div>
          <div class="field">
            <label>City</label>
            <input type="text" name="city" value="{{ $details->city }}" readonly tabindex="-1">
          </div>
          <div class="field">
            <label>Province</label>
            <input type="text" name="province" value="{{ $details->province }}" readonly tabindex="-1">
          </div>
        </div>

      </div>
    </div>

    {{-- ③ Contact Information (read-only) --}}
    <div class="form-card">
      <div class="form-card-header">
        <div class="sec-icon rose"><i data-lucide="phone"></i></div>
        <div>
          <div class="card-title">Contact Information</div>
          <div class="card-sub">Contact details from member record — read only</div>
        </div>
        <span class="readonly-badge"><i data-lucide="lock"></i> Read Only</span>
      </div>
      <div class="form-card-body">

        <div class="g2">
          <div class="field">
            <label>Phone Number</label>
            <input type="text" name="phone" value="{{ $details->contact_number }}" readonly tabindex="-1">
          </div>
          <div class="field">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ $details->email }}" readonly tabindex="-1">
          </div>
        </div>

      </div>
    </div>

    {{-- ④ Membership Details --}}
    <div class="form-card">
      <div class="form-card-header">
        <div class="sec-icon amber"><i data-lucide="piggy-bank"></i></div>
        <div>
          <div class="card-title">Membership Details</div>
          <div class="card-sub">Shared capital amount and membership date</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="g2">
          <div class="field">
            <label>Amount of Shared Capital <span class="req">*</span></label>
            <input type="number" name="shared_capital_amount" id="sc_amount" step="0.01" min="0" required placeholder="0.00"
              value="{{ old('shared_capital_amount') }}" oninput="autoComputeInterestRate()">
            @error('shared_capital_amount')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>
          <div class="field">
            <label>Date of Membership <span class="req">*</span></label>
            <input type="date" name="date_of_membership" required value="{{ old('date_of_membership') }}">
            @error('date_of_membership')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>
        </div>

      </div>
    </div>

    {{-- ⑤ Administrative Information --}}
    <div class="form-card">
      <div class="form-card-header">
        <div class="sec-icon violet"><i data-lucide="shield-check"></i></div>
        <div>
          <div class="card-title">Administrative Information</div>
          <div class="card-sub">Member ID, encoder, remarks, and record date</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="g2">
          <div class="field">
            <label>Member ID <span class="req">*</span></label>
            <input type="text" name="member_id" required value="{{ $details->member_id }}" readonly tabindex="-1"
              style="background:#f9fafb;color:var(--muted);border-color:#f0f0f0;">
            @error('member_id')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>
          <div class="field">
            <label>Encoded By / Staff Name <span class="req">*</span></label>
            <input type="text" name="encoded_by" required placeholder="Staff full name"
              value="{{ old('encoded_by') }}">
            @error('encoded_by')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="g1">
          <div class="field">
            <label>Remarks</label>
            <textarea name="remarks" placeholder="Optional notes…">{{ old('remarks') }}</textarea>
            @error('remarks')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="g1">
          <div class="field">
            <label>Record Creation Date</label>
            <input type="date" name="record_creation_date"
              value="{{ old('record_creation_date', date('Y-m-d')) }}">
            @error('record_creation_date')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>
        </div>

      </div>
    </div>

    {{-- ⑥ Payment Schedule --}}
    <div class="form-card">
      <div class="form-card-header">
        <div class="sec-icon sky"><i data-lucide="calendar-clock"></i></div>
        <div>
          <div class="card-title">Payment Schedule</div>
          <div class="card-sub">Define how and when the shared capital will be paid</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="g2">

          <div class="field">
            <label>Payment Frequency <span class="req">*</span></label>
            <select name="payment_frequency" id="pay_frequency" required onchange="recalcSchedule()">
              <option value="">Select Frequency</option>
              <option value="daily"   {{ old('payment_frequency') == 'daily'   ? 'selected' : '' }}>Daily</option>
              <option value="weekly"  {{ old('payment_frequency') == 'weekly'  ? 'selected' : '' }}>Weekly</option>
              <option value="monthly" {{ old('payment_frequency') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
            @error('payment_frequency')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="field">
            <label>Payment Start Date <span class="req">*</span></label>
            <input type="date" name="payment_start_date" id="pay_start" required
              value="{{ old('payment_start_date') }}" onchange="recalcSchedule()">
            @error('payment_start_date')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="field">
            <label>
              Amount per Payment <span class="req">*</span>
              <span style="font-size:11px;color:var(--muted);font-weight:400;margin-left:4px;">— fixed amount paid each schedule</span>
            </label>
            <input type="number" name="payment_amount_per_schedule" id="pay_per" step="0.01" min="0" required
              placeholder="e.g. 500.00" value="{{ old('payment_amount_per_schedule') }}"
              oninput="autoComputeInterestRate(); recalcSchedule();">
            @error('payment_amount_per_schedule')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="field">
            <label>
              Number of Payments <span class="req">*</span>
              <span style="font-size:11px;color:var(--muted);font-weight:400;margin-left:4px;">— total installments to complete</span>
            </label>
            <select name="number_of_payments" id="pay_count" required onchange="autoComputeInterestRate(); recalcSchedule();">
              <option value="">Select Duration</option>
              <option value="3"  {{ old('number_of_payments') == '3'  ? 'selected' : '' }}>3 Months (Quarterly)</option>
              <option value="6"  {{ old('number_of_payments') == '6'  ? 'selected' : '' }}>6 Months (Semi-Annual)</option>
              <option value="9"  {{ old('number_of_payments') == '9'  ? 'selected' : '' }}>9 Months</option>
              <option value="12" {{ old('number_of_payments') == '12' ? 'selected' : '' }}>12 Months (Annual)</option>
            </select>
            @error('number_of_payments')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="field">
            <label>
              Interest Rate (%) <span class="req">*</span>
              <span style="font-size:11px;color:var(--muted);font-weight:400;margin-left:4px;">— applied to the total shared capital</span>
            </label>
            <div style="position:relative;">
              <input type="number" name="interest_rate" id="pay_interest" step="0.01" min="0" max="100" required
                placeholder="e.g. 5.00" value="{{ old('interest_rate') }}"
                oninput="recalcSchedule()"
                style="padding-right:40px;">
              <span style="position:absolute;right:12px;top:50%;transform:translateY(-50%);font-size:14px;color:var(--muted);font-weight:600;pointer-events:none;">%</span>
            </div>
            @error('interest_rate')
              <div class="field-error"><i data-lucide="circle-alert"></i> {{ $message }}</div>
            @enderror
          </div>

        </div>

        {{-- Live Summary Calculator --}}
        <div class="schedule-calc" id="scheduleCalc" style="display:none;">
          <div class="schedule-calc-title">
            <i data-lucide="calculator"></i> Payment Schedule Summary
          </div>
          <div class="calc-grid" style="grid-template-columns:repeat(4,1fr);">
            <div class="calc-item">
              <div class="ci-label">Principal Amount</div>
              <div class="ci-value highlight" id="calc-total">—</div>
              <div class="ci-sub">amount × payments</div>
            </div>
            <div class="calc-item" style="border-top:3px solid var(--amber);">
              <div class="ci-label">Interest Rate</div>
              <div class="ci-value" id="calc-interest-rate" style="color:var(--amber);">—</div>
              <div class="ci-sub">per annum</div>
            </div>
            <div class="calc-item" style="border-top:3px solid var(--violet);">
              <div class="ci-label">Interest Amount</div>
              <div class="ci-value" id="calc-interest-amt" style="color:var(--violet);">—</div>
              <div class="ci-sub" id="calc-interest-sub">based on rate & term</div>
            </div>
            <div class="calc-item">
              <div class="ci-label">Estimated End Date</div>
              <div class="ci-value" id="calc-end" style="font-size:14px;margin-top:2px;">—</div>
              <div class="ci-sub" id="calc-end-sub">based on frequency</div>
            </div>
          </div>
          <div class="calc-note">
            <i data-lucide="info"></i>
            <span id="calc-note-text">The member will pay <strong id="calc-per">₱0</strong> every <strong id="calc-freq">—</strong> for <strong id="calc-n">0</strong> payments. Total interest of <strong id="calc-interest-note">₱0</strong> applies, completing on <strong id="calc-end2">—</strong>.</span>
          </div>
        </div>

      </div>
    </div>

    {{-- Submit --}}
    <div class="form-card">
      <div class="form-card-body">
        <div class="form-actions">
          <a href="{{route('Add.Transactions')}}" class="btn btn-ghost">
            <i data-lucide="arrow-left"></i> Back
          </a>
          <button type="submit" class="btn btn-primary">
            <i data-lucide="save"></i> Submit Registration
          </button>
        </div>
      </div>
    </div>

    </form>

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

  // ── Auto-compute interest rate from amount (shared capital or payment schedule) ──
  function autoComputeInterestRate() {
    const scAmount = parseFloat(document.getElementById('sc_amount').value) || 0;
    const payPer = parseFloat(document.getElementById('pay_per').value) || 0;
    const payCount = parseInt(document.getElementById('pay_count').value) || 0;
    const totalFromSchedule = payPer * payCount;
    // Use shared capital amount if set, else total from payment schedule
    const amount = scAmount > 0 ? scAmount : totalFromSchedule;

    const interestInput = document.getElementById('pay_interest');
    if (!interestInput) return;
    // Tiered rates (per annum) based on amount — common coop structure
    let rate = 1; // default 1%
    if (amount > 0) {
      if (amount < 5000)       rate = 0.5;
      else if (amount < 20000) rate = 1;
      else if (amount < 50000) rate = 1.25;
      else                     rate = 1.5;
    }
    interestInput.value = rate.toFixed(2);
    recalcSchedule();
  }

  // ── Payment Schedule Calculator ────────────────
  function recalcSchedule() {
    const perVal      = parseFloat(document.getElementById('pay_per').value)      || 0;
    const countVal    = parseInt(document.getElementById('pay_count').value)       || 0;
    const freq        = document.getElementById('pay_frequency').value;
    const startVal    = document.getElementById('pay_start').value;
    const interestVal = parseFloat(document.getElementById('pay_interest').value)  || 0;
    const box         = document.getElementById('scheduleCalc');

    if (!perVal || !countVal || !freq || !startVal) {
      box.style.display = 'none';
      return;
    }

    box.style.display = 'block';

    // Principal
    const principal = perVal * countVal;
    document.getElementById('calc-total').textContent = '₱' + principal.toLocaleString('en-PH', { minimumFractionDigits: 2 });

    // Interest
    // Simple interest: I = P × R × T (T in years based on term)
    const termYears  = countVal / 12;
    const interestAmt = principal * (interestVal / 100) * termYears;
    document.getElementById('calc-interest-rate').textContent  = interestVal.toFixed(2) + '%';
    document.getElementById('calc-interest-amt').textContent   = '₱' + interestAmt.toLocaleString('en-PH', { minimumFractionDigits: 2 });
    document.getElementById('calc-interest-note').textContent  = '₱' + interestAmt.toLocaleString('en-PH', { minimumFractionDigits: 2 });
    document.getElementById('calc-interest-sub').textContent   = interestVal > 0 ? 'simple interest on principal' : 'no interest applied';

    // Estimated end date
    const start = new Date(startVal);
    let end = new Date(startVal);
    const freqLabels = { daily: 'day', weekly: 'week', monthly: 'month' };

    if (freq === 'daily')        end.setDate(start.getDate() + (countVal - 1));
    else if (freq === 'weekly')  end.setDate(start.getDate() + (countVal - 1) * 7);
    else if (freq === 'monthly') end.setMonth(start.getMonth() + (countVal - 1));

    const endFormatted = end.toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' });
    document.getElementById('calc-end').textContent  = endFormatted;
    document.getElementById('calc-end2').textContent = endFormatted;

    // Inline note
    const freqUnit = freqLabels[freq] || '—';
    document.getElementById('calc-per').textContent   = '₱' + perVal.toLocaleString('en-PH', { minimumFractionDigits: 2 });
    document.getElementById('calc-freq').textContent  = freqUnit;
    document.getElementById('calc-n').textContent     = countVal;

    lucide.createIcons();
  }

  // Trigger on page load if old() values are present
  autoComputeInterestRate();
  recalcSchedule();
</script>
</body>
</html>