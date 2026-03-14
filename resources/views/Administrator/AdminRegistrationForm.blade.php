<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Member Registration | GBLDC Admin</title>
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

    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
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
      transition: background .2s;
    }
    .back-btn:hover { background: #a7f3d0; }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }
    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 20px; font-weight: 700; color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    /* Page body */
    .page-body { padding: 28px 32px 60px; flex: 1; }

    /* ── Alert banners ── */
    .alert {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 14px 18px; border-radius: 12px;
      font-size: 14px; margin-bottom: 20px; border: 1px solid transparent;
    }
    .alert i[data-lucide] { width: 18px; height: 18px; flex-shrink: 0; margin-top: 1px; }
    .alert-success { background: #f0fdf4; border-color: #bbf7d0; color: #166534; }
    .alert-success i[data-lucide] { color: #16a34a; }
    .alert-error { background: #fef2f2; border-color: #fecaca; color: #991b1b; }
    .alert-error i[data-lucide] { color: var(--rose); }
    .alert ul { margin: 6px 0 0 18px; font-size: 13px; }
    .alert ul li { margin-bottom: 2px; }

    /* ── Welcome banner ── */
    .hero-banner {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 24px 28px;
      color: #fff; display: flex; align-items: center;
      justify-content: space-between; flex-wrap: wrap; gap: 16px;
      margin-bottom: 28px; position: relative; overflow: hidden;
    }
    .hero-banner::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05); pointer-events: none;
    }
    .hero-banner::after {
      content: ''; position: absolute; bottom: -60px; right: 120px;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(255,255,255,.04); pointer-events: none;
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
    .hero-step-badge {
      position: relative; z-index: 1;
      background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
      border-radius: 12px; padding: 12px 20px;
      display: flex; align-items: center; gap: 10px;
      font-size: 13px; font-weight: 600;
    }
    .hero-step-badge i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }

    /* ── Form card ── */
    .form-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      margin-bottom: 20px;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .form-card-header {
      padding: 18px 24px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: 12px;
    }
    .section-icon {
      width: 36px; height: 36px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; font-size: 16px;
    }
    .section-icon.green  { background: #dcfce7; color: #16a34a; }
    .section-icon.blue   { background: #dbeafe; color: #2563eb; }
    .section-icon.amber  { background: #fef3c7; color: #d97706; }
    .section-icon.violet { background: #ede9fe; color: #7c3aed; }
    .section-icon.rose   { background: #fee2e2; color: #dc2626; }
    .section-icon i[data-lucide] { width: 17px; height: 17px; }
    .form-card-header-text .title {
      font-size: 15px; font-weight: 700; color: var(--ink);
    }
    .form-card-header-text .subtitle { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .form-card-body { padding: 24px; }

    /* ── Field groups ── */
    .field-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px; }
    .field-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 16px; }
    .field-grid-1 { display: grid; grid-template-columns: 1fr; gap: 16px; margin-bottom: 16px; }

    .field { display: flex; flex-direction: column; gap: 6px; }
    .field label {
      font-size: 13px; font-weight: 600; color: var(--ink);
      display: flex; align-items: center; gap: 4px;
    }
    .field label .req { color: var(--rose); }

    .field input,
    .field select,
    .field textarea {
      width: 100%; padding: 9px 12px;
      border: 1.5px solid var(--border); border-radius: 9px;
      font-family: 'DM Sans', sans-serif; font-size: 14px;
      color: var(--ink); background: var(--white);
      transition: border-color .2s, box-shadow .2s;
      outline: none;
    }
    .field input:focus,
    .field select:focus,
    .field textarea:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .field input[readonly] { background: #f9fafb; color: var(--muted); cursor: default; }
    .field input::placeholder { color: #9ca3af; }
    .field select option { color: var(--ink); }

    /* Contact prefix */
    .input-prefix {
      display: flex; align-items: center;
      border: 1.5px solid var(--border); border-radius: 9px;
      overflow: hidden; transition: border-color .2s, box-shadow .2s;
    }
    .input-prefix:focus-within {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .input-prefix .prefix-label {
      padding: 9px 10px 9px 12px;
      font-size: 13px; font-weight: 600; color: var(--muted);
      background: #f9fafb; border-right: 1.5px solid var(--border);
      white-space: nowrap;
    }
    .input-prefix input {
      border: none !important; border-radius: 0 !important;
      box-shadow: none !important; flex: 1;
    }
    .input-prefix input:focus { box-shadow: none !important; }

    /* Radio group */
    .radio-group { display: flex; gap: 16px; flex-wrap: wrap; padding-top: 4px; }
    .radio-option {
      display: flex; align-items: center; gap: 7px;
      font-size: 14px; color: var(--ink); cursor: pointer;
    }
    .radio-option input[type="radio"] {
      width: 16px; height: 16px; accent-color: var(--emerald);
      cursor: pointer;
    }

    /* Divider */
    .form-divider { border: none; border-top: 1px solid var(--border); margin: 4px 0 20px; }

    /* ── File upload ── */
    .upload-zone {
      border: 2px dashed var(--border);
      border-radius: 12px; padding: 22px;
      text-align: center; cursor: pointer;
      transition: border-color .2s, background .2s;
      position: relative;
    }
    .upload-zone:hover, .upload-zone.has-file { border-color: var(--emerald); background: #f0fdf4; }
    .upload-zone input[type="file"] {
      position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .upload-zone i[data-lucide] { display: block; margin: 0 auto 8px; width: 28px; height: 28px; color: var(--muted); }
    .upload-zone.has-file i[data-lucide] { color: var(--emerald); }
    .upload-zone .upload-title { font-size: 13px; font-weight: 600; color: var(--ink); }
    .upload-zone .upload-sub  { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .upload-zone .upload-filename { font-size: 12px; color: var(--emerald); font-weight: 600; margin-top: 6px; }
    .upload-preview {
      margin-top: 10px; width: 80px; height: 80px;
      object-fit: cover; border-radius: 8px;
      border: 2px solid var(--border); display: none;
    }

    /* ── Terms checkbox ── */
    .terms-row {
      display: flex; align-items: flex-start; gap: 10px;
      padding: 16px; border-radius: 10px;
      background: #f9fafb; border: 1px solid var(--border);
      margin-bottom: 4px;
    }
    .terms-row input[type="checkbox"] {
      width: 16px; height: 16px; accent-color: var(--forest);
      margin-top: 2px; flex-shrink: 0; cursor: pointer;
    }
    .terms-row label { font-size: 13px; color: var(--muted); line-height: 1.5; cursor: pointer; }
    .terms-row label a { color: var(--forest-mid); font-weight: 600; text-decoration: underline; }

    /* ── Action buttons ── */
    .form-actions {
      display: flex; justify-content: space-between; align-items: center;
      padding-top: 8px; gap: 12px;
    }
    .btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 11px 24px; border-radius: 10px;
      font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
      cursor: pointer; border: none; text-decoration: none;
      transition: background .2s, transform .1s, box-shadow .2s;
    }
    .btn:active { transform: scale(.98); }
    .btn i[data-lucide] { width: 15px; height: 15px; }
    .btn-secondary { background: #f3f4f6; color: var(--ink); }
    .btn-secondary:hover { background: #e5e7eb; }
    .btn-primary { background: var(--forest); color: #fff; }
    .btn-primary:hover { background: var(--forest-mid); box-shadow: 0 4px 14px rgba(13,74,47,.3); }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Responsive ── */
    @media (max-width: 900px) {
      .field-grid-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 700px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar, .page-body { padding-left: 18px; padding-right: 18px; }
      .field-grid-3, .field-grid-2 { grid-template-columns: 1fr; }
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
    <a href="{{route('Manage.Members')}}" class="nav-item active">
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
    <div class="topbar-left">
      <a href="{{route('Manage.Members')}}" class="back-btn">
        <i data-lucide="arrow-left"></i> Back
      </a>
      <div class="topbar-title">
        <h1>Member Registration</h1>
        <p>Complete all sections to register a new member</p>
      </div>
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Alerts -->
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
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
      <i data-lucide="triangle-alert"></i>
      <div>{{ session('error') }}</div>
    </div>
    @endif

    <!-- Hero Banner -->
    <div class="hero-banner">
      <div class="hero-content">
        <div class="hero-eyebrow">New Registration</div>
        <h2>Member Registration Form</h2>
        <p>Fill in all required fields accurately. Fields marked <strong style="color:#86efac;">*</strong> are required.</p>
      </div>
      <div class="hero-step-badge">
        <i data-lucide="user-plus"></i>
        New Member Enrollment
      </div>
    </div>

    <!-- ═══ FORM ═══ -->
    <form action="{{route('Admin.Submit.Mem.Regis')}}" method="POST" enctype="multipart/form-data" id="regForm">
    @csrf

    <!-- ① Personal Information -->
    <div class="form-card">
      <div class="form-card-header">
        <div class="section-icon green"><i data-lucide="user"></i></div>
        <div class="form-card-header-text">
          <div class="title">Personal Information</div>
          <div class="subtitle">Basic personal details of the member</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="field-grid-3">
          <div class="field">
            <label>Last Name <span class="req">*</span></label>
            <input type="text" name="last_name" placeholder="Last Name" required>
          </div>
          <div class="field">
            <label>First Name <span class="req">*</span></label>
            <input type="text" name="first_name" placeholder="First Name" required>
          </div>
          <div class="field">
            <label>Middle Name <span class="req">*</span></label>
            <input type="text" name="middle_name" placeholder="Middle Name" required>
          </div>
        </div>

        <div class="field-grid-3">
          <div class="field">
            <label>Place of Birth <span class="req">*</span></label>
            <input type="text" name="place_of_birth" placeholder="Place of Birth" required>
          </div>
          <div class="field">
            <label>Birth Date <span class="req">*</span></label>
            <input type="date" name="birthdate" id="birthDate" required onchange="calculateAge()">
          </div>
          <div class="field-grid-2" style="margin-bottom:0; gap:12px;">
            <div class="field">
              <label>Age <span class="req">*</span></label>
              <input type="number" name="age" id="age" readonly required>
            </div>
            <div class="field">
              <label>Gender <span class="req">*</span></label>
              <div class="radio-group">
                <label class="radio-option"><input type="radio" name="gender" value="Male" required> Male</label>
                <label class="radio-option"><input type="radio" name="gender" value="Female"> Female</label>
              </div>
            </div>
          </div>
        </div>

        <div class="field-grid-3">
          <div class="field">
            <label>Religion <span class="req">*</span></label>
            <select name="religion" required>
              <option value="">Select Religion</option>
              <option>ROMAN CATHOLIC</option>
              <option>PROTESTANT</option>
              <option>CHRISTIAN</option>
              <option>BAPTIST</option>
              <option>SEVENTH-DAY ADVENTIST</option>
              <option>IGLESIA NI CRISTO</option>
              <option>ADVENTIST</option>
              <option>BUDDHISM</option>
              <option>JESUS IS LORD MOVEMENT</option>
              <option>JEHOVAH'S WITNESSES</option>
              <option>METHODIST</option>
              <option>NON-SECTARIAN</option>
              <option value="">OTHER</option>
            </select>
          </div>
          <div class="field">
            <label>Nationality <span class="req">*</span></label>
            <input type="text" name="nationality" placeholder="Nationality" required>
          </div>
          <div class="field">
            <label>Civil Status <span class="req">*</span></label>
            <select name="civil_status" required>
              <option value="">Select Status</option>
              <option>SINGLE</option>
              <option>MARRIED</option>
              <option>WIDOW</option>
              <option>SEPARATED</option>
            </select>
          </div>
        </div>

        <div class="field-grid-2">
          <div class="field">
            <label>Email Address <span class="req">*</span></label>
            <input type="email" name="email" placeholder="Email Address" required>
          </div>
          <div class="field">
            <label>Contact Number <span class="req">*</span></label>
            <div class="input-prefix">
              <span class="prefix-label">+63</span>
              <input type="tel" name="contact_number" pattern="[0-9]{10}" maxlength="10" inputmode="numeric" placeholder="9123456789" required>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- ② Home Address -->
    <div class="form-card">
      <div class="form-card-header">
        <div class="section-icon blue"><i data-lucide="map-pin"></i></div>
        <div class="form-card-header-text">
          <div class="title">Home Address</div>
          <div class="subtitle">Current residential address</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="field-grid-1">
          <div class="field">
            <label>Street Address <span class="req">*</span></label>
            <input type="text" name="street_address" placeholder="No. & Street" required>
          </div>
        </div>

        <div class="field-grid-3">
          <div class="field">
            <label>Province <span class="req">*</span></label>
            <select id="psgc_admin_province" name="province" required>
              <option value="" selected>Select Province</option>
            </select>
          </div>
          <div class="field">
            <label>City / Municipality <span class="req">*</span></label>
            <select id="psgc_admin_city" name="city" required disabled>
              <option value="" selected>Select City</option>
            </select>
          </div>
          <div class="field">
            <label>Barangay <span class="req">*</span></label>
            <select id="psgc_admin_barangay" name="barangay" required disabled>
              <option value="" selected>Select Barangay</option>
            </select>
          </div>
        </div>

        <div class="field-grid-3">
          <div class="field">
            <label>Years of Stay <span class="req">*</span></label>
            <input type="text" name="year_of_stay" placeholder="e.g. 5" required>
          </div>
          <div class="field">
            <label>House Ownership <span class="req">*</span></label>
            <select name="house_ownership" required>
              <option value="">Select Ownership</option>
              <option>Owned</option>
              <option>Rented</option>
              <option>Living with Parents</option>
              <option value="">Other</option>
            </select>
          </div>
          <div class="field">
            <label>Zip Code <span class="req">*</span></label>
            <input type="text" name="zip_code" placeholder="Zip Code" required>
          </div>
        </div>

      </div>
    </div>

    <!-- ③ Emergency Contact -->
    <div class="form-card">
      <div class="form-card-header">
        <div class="section-icon rose"><i data-lucide="phone-call"></i></div>
        <div class="form-card-header-text">
          <div class="title">Emergency Contact</div>
          <div class="subtitle">Person to contact in case of emergency</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="field-grid-2">
          <div class="field">
            <label>Full Name <span class="req">*</span></label>
            <input type="text" name="ec_fullname" placeholder="Full Name" required>
          </div>
          <div class="field">
            <label>Gender <span class="req">*</span></label>
            <div class="radio-group">
              <label class="radio-option"><input type="radio" name="ec_gender" value="Male" required> Male</label>
              <label class="radio-option"><input type="radio" name="ec_gender" value="Female"> Female</label>
            </div>
          </div>
        </div>

        <div class="field-grid-2">
          <div class="field">
            <label>Email Address</label>
            <input type="email" name="ec_email" placeholder="Email Address">
          </div>
          <div class="field">
            <label>Contact Number <span class="req">*</span></label>
            <div class="input-prefix">
              <span class="prefix-label">+63</span>
              <input type="tel" name="ec_contact_number" pattern="[0-9]{10}" maxlength="10" inputmode="numeric" placeholder="9123456789" required>
            </div>
          </div>
        </div>

        <div class="field-grid-2">
          <div class="field">
            <label>Address <span class="req">*</span></label>
            <input type="text" name="ec_address" placeholder="Complete Address" required>
          </div>
          <div class="field">
            <label>Relationship <span class="req">*</span></label>
            <select name="ec_relationship" required>
              <option value="">Select Relationship</option>
              <option>Parent</option><option>Spouse</option><option>Sibling</option>
              <option>Child</option><option>Relative</option><option>Friend</option>
              <option>Colleague</option><option>Other</option>
            </select>
          </div>
        </div>

      </div>
    </div>

    <!-- ④ Employment Information -->
    <div class="form-card">
      <div class="form-card-header">
        <div class="section-icon amber"><i data-lucide="briefcase"></i></div>
        <div class="form-card-header-text">
          <div class="title">Employment Information</div>
          <div class="subtitle">Applicant's occupation and financial background</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="field-grid-2">
          <div class="field">
            <label>Employment Status <span class="req">*</span></label>
            <select name="employment_status">
              <option value="">Select</option>
              <option>Employed</option><option>Self Employed</option>
              <option>Unemployed</option><option>Retired</option>
              <option>Student</option><option>Freelancer</option>
              <option>OFW</option><option>Part Time</option>
              <option>Contractual</option><option>Seasonal</option>
              <option>Business Owner</option><option>Homemaker</option>
              <option>Disabled</option><option>Others</option>
            </select>
          </div>
          <div class="field">
            <label>Source of Funds <span class="req">*</span></label>
            <select name="source_of_funds">
              <option value="">Select</option>
              <option>Salary</option><option>Business</option>
              <option>Pension</option><option>Remittance</option>
              <option>Investment</option><option>Allowance</option>
              <option>Rental Income</option><option>Others</option>
            </select>
          </div>
        </div>

        <div class="field-grid-2">
          <div class="field">
            <label>Employer / Business Name <span class="req">*</span></label>
            <input type="text" name="employer_business_name" placeholder="Employer/Business Name">
          </div>
          <div class="field">
            <label>Occupation <span class="req">*</span></label>
            <select name="occupation">
              <option value="">Select Occupation</option>
              <option>Accountant</option><option>Engineer</option><option>Teacher</option>
              <option>Doctor</option><option>Nurse</option><option>Police Officer</option>
              <option>Firefighter</option><option>Driver</option><option>Salesperson</option>
              <option>Cashier</option><option>Manager</option><option>Clerk</option>
              <option>Farmer</option><option>Fisherman</option>
              <option>Construction Worker</option><option>Business Owner</option>
              <option>Self-Employed</option><option>Student</option>
              <option>Retired</option><option>Unemployed</option><option>Others</option>
            </select>
          </div>
        </div>

        <div class="field-grid-1">
          <div class="field">
            <label>Company / Business Address <span class="req">*</span></label>
            <input type="text" name="company_business_address" placeholder="Company/Business Address">
          </div>
        </div>

        <div class="field-grid-2">
          <div class="field">
            <label>Gross Monthly Income <span class="req">*</span></label>
            <select name="gross_monthly_income">
              <option value="">Select</option>
              <option value="below 10000">Below ₱10,000</option>
              <option value="10000 - 20000">₱10,000 – ₱20,000</option>
              <option value="20001 - 30000">₱20,001 – ₱30,000</option>
              <option value="30001 - 50000">₱30,001 – ₱50,000</option>
              <option value="50001 - 100000">₱50,001 – ₱100,000</option>
              <option value="above - 100000">Above ₱100,000</option>
            </select>
          </div>
          <div class="field">
            <label>Nature / Type of Employment / Business <span class="req">*</span></label>
            <select name="nature_type_of_employment_business">
              <option value="">Select</option>
              <option>Government</option><option>Private</option>
              <option>Self-Employed</option><option>OFW</option>
              <option>Freelancer</option><option>Business Owner</option>
              <option>Retired</option><option>Student</option>
              <option>Unemployed</option><option>Non-Profit/NGO</option>
              <option>Contractual</option><option>Part-Time</option>
              <option>Seasonal</option><option>Others</option>
            </select>
          </div>
        </div>

        <div class="field-grid-2">
          <div class="field">
            <label>SSS / GSIS No. <span class="req">*</span></label>
            <input type="text" name="sss_gsis_no" placeholder="SSS/GSIS No.">
          </div>
          <div class="field">
            <label>TIN No. <span class="req">*</span></label>
            <input type="text" name="tin_no" placeholder="TIN No.">
          </div>
        </div>

      </div>
    </div>

    <!-- ⑤ Attachments -->
    <div class="form-card">
      <div class="form-card-header">
        <div class="section-icon violet"><i data-lucide="paperclip"></i></div>
        <div class="form-card-header-text">
          <div class="title">Attachments</div>
          <div class="subtitle">Please ensure all files are clear and legible. Accepted: JPG, PNG, PDF</div>
        </div>
      </div>
      <div class="form-card-body">

        <div class="field-grid-3">
          <!-- 2x2 Picture -->
          <div class="field">
            <label>2×2 Picture <span class="req">*</span></label>
            <div class="upload-zone" id="zone-pic">
              <input type="file" name="two_by_two_picture" id="file-pic" accept="image/*" onchange="handleUpload(this,'zone-pic','preview-pic','name-pic')">
              <i data-lucide="image"></i>
              <div class="upload-title">Click to upload</div>
              <div class="upload-sub">2×2 Picture</div>
              <div class="upload-filename" id="name-pic"></div>
            </div>
            <img id="preview-pic" class="upload-preview" />
          </div>

          <!-- Proof of Billing -->
          <div class="field">
            <label>Proof of Billing <span class="req">*</span></label>
            <div class="upload-zone" id="zone-billing">
              <input type="file" name="proof_of_billing" id="file-billing" accept="image/*" onchange="handleUpload(this,'zone-billing','preview-billing','name-billing')">
              <i data-lucide="file-text"></i>
              <div class="upload-title">Click to upload</div>
              <div class="upload-sub">Proof of Billing</div>
              <div class="upload-filename" id="name-billing"></div>
            </div>
            <img id="preview-billing" class="upload-preview" />
          </div>

          <!-- Valid ID -->
          <div class="field">
            <label>Valid ID <span class="req">*</span></label>
            <div class="upload-zone" id="zone-id">
              <input type="file" name="valid_id" id="file-id" accept="image/*" onchange="handleUpload(this,'zone-id','preview-id','name-id')">
              <i data-lucide="id-card"></i>
              <div class="upload-title">Click to upload</div>
              <div class="upload-sub">Valid ID</div>
              <div class="upload-filename" id="name-id"></div>
            </div>
            <img id="preview-id" class="upload-preview" />
          </div>
        </div>

      </div>
    </div>

    <!-- Terms & Actions -->
    <div class="form-card">
      <div class="form-card-body">
        <div class="terms-row">
          <input type="checkbox" id="terms" required>
          <label for="terms">
            I confirm that all information provided is true and accurate. I agree to the
            <a href="#">Terms &amp; Conditions</a> of the Greater Bulacan Livelihood Development Cooperative.
          </label>
        </div>
        <div class="form-actions" style="margin-top:20px;">
          <a href="{{route('Manage.Members')}}" class="btn btn-secondary">
            <i data-lucide="arrow-left"></i> Back
          </a>
          <button type="submit" class="btn btn-primary">
            <i data-lucide="send"></i> Submit Registration
          </button>
        </div>
      </div>
    </div>

    </form>

  </div><!-- /page-body -->

  <footer style="padding:18px 32px; border-top:1px solid var(--border); background:var(--white); font-size:12px; color:var(--muted); text-align:center;">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div><!-- /main -->

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

  // ── Age calculator ──────────────────────────────
  function calculateAge() {
    const bd = document.getElementById('birthDate').value;
    if (!bd) { document.getElementById('age').value = ''; return; }
    const today = new Date(), birth = new Date(bd);
    let age = today.getFullYear() - birth.getFullYear();
    const m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
    document.getElementById('age').value = age >= 0 ? age : '';
  }

  // ── File upload preview ─────────────────────────
  function handleUpload(input, zoneId, previewId, nameId) {
    const file    = input.files[0];
    const zone    = document.getElementById(zoneId);
    const preview = document.getElementById(previewId);
    const nameEl  = document.getElementById(nameId);
    if (!file) return;
    nameEl.textContent = '✓ ' + file.name;
    zone.classList.add('has-file');
    lucide.createIcons(); // re-render icons after class change
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  }
</script>
<script>
  // PSGC dynamic address dropdowns (Admin membership form)
  (function () {
    const PSGC = 'https://psgc.gitlab.io/api';
    const provinceEl = document.getElementById('psgc_admin_province');
    const cityEl = document.getElementById('psgc_admin_city');
    const barangayEl = document.getElementById('psgc_admin_barangay');
    if (!provinceEl || !cityEl || !barangayEl) return;

    const PREFILL = {
      province: @json(old('province', '')),
      city: @json(old('city', '')),
      barangay: @json(old('barangay', '')),
    };

    const setOptions = (el, placeholder, items) => {
      el.innerHTML = `<option value="">${placeholder}</option>`;
      items.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item.name;        // store NAME in DB
        opt.textContent = item.name;
        opt.dataset.code = item.code; // keep code for chaining
        el.appendChild(opt);
      });
    };

    const findOptionByValue = (el, value) => {
      const v = (value || '').toLowerCase();
      if (!v) return null;
      return Array.from(el.options).find(o => (o.value || '').toLowerCase() === v) || null;
    };

    fetch(`${PSGC}/provinces/`)
      .then(r => r.json())
      .then(data => {
        data.sort((a, b) => a.name.localeCompare(b.name));
        setOptions(provinceEl, 'Select Province', data);
        if (PREFILL.province) {
          const opt = findOptionByValue(provinceEl, PREFILL.province);
          if (opt) provinceEl.value = opt.value;
        }
        provinceEl.dispatchEvent(new Event('change'));
      })
      .catch(() => {});

    provinceEl.addEventListener('change', function () {
      const selected = this.options[this.selectedIndex];
      const provCode = selected?.dataset?.code;

      cityEl.disabled = true;
      barangayEl.disabled = true;
      cityEl.innerHTML = `<option value="">Select City</option>`;
      barangayEl.innerHTML = `<option value="">Select Barangay</option>`;
      if (!provCode) return;

      fetch(`${PSGC}/provinces/${provCode}/cities-municipalities/`)
        .then(r => r.json())
        .then(data => {
          data.sort((a, b) => a.name.localeCompare(b.name));
          setOptions(cityEl, 'Select City', data);
          cityEl.disabled = false;
          if (PREFILL.city) {
            const opt = findOptionByValue(cityEl, PREFILL.city);
            if (opt) cityEl.value = opt.value;
            PREFILL.city = '';
          }
          cityEl.dispatchEvent(new Event('change'));
        })
        .catch(() => {});
    });

    cityEl.addEventListener('change', function () {
      const selected = this.options[this.selectedIndex];
      const cityCode = selected?.dataset?.code;

      barangayEl.disabled = true;
      barangayEl.innerHTML = `<option value="">Select Barangay</option>`;
      if (!cityCode) return;

      fetch(`${PSGC}/cities-municipalities/${cityCode}/barangays/`)
        .then(r => r.json())
        .then(data => {
          data.sort((a, b) => a.name.localeCompare(b.name));
          setOptions(barangayEl, 'Select Barangay', data);
          barangayEl.disabled = false;
          if (PREFILL.barangay) {
            const opt = findOptionByValue(barangayEl, PREFILL.barangay);
            if (opt) barangayEl.value = opt.value;
            PREFILL.barangay = '';
          }
        })
        .catch(() => {});
    });
  })();
</script>
</body>
</html>