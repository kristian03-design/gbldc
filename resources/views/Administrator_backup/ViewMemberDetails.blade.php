<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Member Details | GBLDC Admin</title>
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
    .logo-text { font-family: 'DM Serif Display', serif; font-size: 18px; color: #fff; line-height: 1.2; }
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
    .nav-item:hover  { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item svg, .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* Jump nav */
    .jump-item {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 12px; border-radius: 8px;
      text-decoration: none; color: rgba(255,255,255,.45);
      font-size: 13px; transition: background .15s, color .15s; margin-bottom: 1px;
    }
    .jump-item:hover { background: rgba(255,255,255,.05); color: rgba(255,255,255,.8); }
    .jump-item.lit   { color: var(--emerald); }
    .jump-dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: rgba(255,255,255,.2); flex-shrink: 0; transition: background .2s;
    }
    .jump-item.lit .jump-dot { background: var(--emerald); box-shadow: 0 0 6px rgba(34,197,94,.5); }

    .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.1); }
    .user-card {
      display: flex; align-items: center; gap: 10px;
      padding: 10px; border-radius: 10px; cursor: pointer; transition: background .2s;
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
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── Topbar ── */
    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 14px 32px; display: flex; align-items: center; gap: 10px;
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
      font-size: 13px; color: var(--muted); flex-wrap: wrap;
    }
    .breadcrumb a { color: var(--forest-mid); text-decoration: none; font-weight: 600; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg, .breadcrumb i[data-lucide] { width: 12px; height: 12px; opacity: .4; flex-shrink: 0; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }
    .topbar-spacer { flex: 1; }

    /* ── Page body ── */
    .page-body { padding: 32px 32px 80px; flex: 1; width: 100%; max-width: 960px; margin: 0 auto; }

    /* ── Page header banner ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 28px 32px; color: #fff;
      margin-bottom: 24px; position: relative; overflow: hidden;
      display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
    }
    .page-header::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: ''; position: absolute; bottom: -60px; right: 120px;
      width: 140px; height: 140px; border-radius: 50%; background: rgba(255,255,255,.04);
    }
    .page-header-content { position: relative; z-index: 1; }
    .page-header-eyebrow {
      font-size: 10px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
      color: var(--emerald); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;
    }
    .page-header-eyebrow::before {
      content: ''; display: inline-block; width: 18px; height: 2px;
      background: var(--emerald); border-radius: 2px;
    }
    .page-header-content h2 { font-family: 'DM Serif Display', serif; font-size: 26px; margin-bottom: 6px; }
    .page-header-content p  { font-size: 13px; opacity: .7; margin-bottom: 14px; }
    .member-id-tag {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 8px; padding: 5px 12px;
      font-size: 12px; font-weight: 600; color: rgba(255,255,255,.85);
    }
    .member-id-tag svg, .member-id-tag i[data-lucide] { width: 12px; height: 12px; color: var(--emerald); }

    .page-header-right { position: relative; z-index: 1; flex-shrink: 0; }
    .header-meta-box {
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
      border-radius: 12px; padding: 14px 18px; text-align: right; min-width: 180px;
    }
    .hm-row { margin-bottom: 8px; }
    .hm-row:last-child { margin-bottom: 0; }
    .hm-label { font-size: 10px; opacity: .6; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 2px; }
    .hm-value { font-size: 13px; font-weight: 600; color: #fff; }

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
      width: 36px; height: 36px; border-radius: 10px; background: var(--sage);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .card-head-icon svg, .card-head-icon i[data-lucide] { width: 18px; height: 18px; color: var(--forest-mid); }
    .card-head-title { font-size: 15px; font-weight: 700; color: var(--ink); }
    .card-head-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .card-body { padding: 22px 24px; }

    /* ── Info grid ── */
    .info-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }
    .info-grid.cols2 { grid-template-columns: 1fr 1fr; }
    .info-grid .span2 { grid-column: span 2; }
    .info-grid .span3 { grid-column: 1 / -1; }
    @media (max-width: 680px) {
      .info-grid, .info-grid.cols2 { grid-template-columns: 1fr; }
      .info-grid .span2, .info-grid .span3 { grid-column: 1; }
    }

    .info-cell {
      background: var(--sand); border: 1px solid #eaf3ea;
      border-radius: 10px; padding: 12px 15px;
      transition: border-color .15s, background .15s;
    }
    .info-cell:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .info-cell .lbl {
      font-size: 10px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .07em; color: var(--muted); margin-bottom: 4px;
    }
    .info-cell .data { font-size: 13px; color: var(--ink); font-weight: 600; line-height: 1.4; }
    .info-cell .data.mono  { font-family: monospace; letter-spacing: .04em; font-size: 12px; }
    .info-cell .data.muted { color: var(--muted); font-weight: 400; }
    .info-cell .data.green { color: var(--forest-mid); }

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
      <div class="logo-sub">Admin Portal</div>
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
    <a href="{{route('Member.List')}}" class="nav-item active">
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
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="{{route('Admin.Settings')}}" class="nav-item">
      <i data-lucide="settings"></i> Settings
    </a>

    <div class="nav-section-label">On This Page</div>
    <a href="#sec-basic"      class="jump-item lit" data-sec="sec-basic">    <span class="jump-dot"></span> Basic Info</a>
    <a href="#sec-contact"    class="jump-item"     data-sec="sec-contact">  <span class="jump-dot"></span> Contact</a>
    <a href="#sec-address"    class="jump-item"     data-sec="sec-address">  <span class="jump-dot"></span> Address</a>
    <a href="#sec-emergency"  class="jump-item"     data-sec="sec-emergency"><span class="jump-dot"></span> Emergency</a>
    <a href="#sec-employment" class="jump-item"     data-sec="sec-employment"><span class="jump-dot"></span> Employment</a>
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
      <a href="{{route('Admin.Settings')}}" class="dropdown-item normal">
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
    <a href="{{ route('Member.List') }}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="breadcrumb">
      <a href="{{ route('Member.List') }}">Official Members</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">{{$Member->last_name}}, {{$Member->first_name}}</span>
    </div>
    <div class="topbar-spacer"></div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Page header banner -->
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-header-eyebrow">Member Profile</div>
        <h2>{{$Member->last_name}}, {{$Member->first_name}} {{$Member->middle_name}}</h2>
        <p>Complete member information and registration details.</p>
        <div class="member-id-tag">
          <i data-lucide="hash"></i> Member ID: {{$Member->member_id ?? $Member->id}}
        </div>
      </div>
      <div class="page-header-right">
        <div class="header-meta-box">
          <div class="hm-row">
            <div class="hm-label">Accepted On</div>
            <div class="hm-value">{{ \Carbon\Carbon::parse($Member->created_at)->format('M d, Y') }}</div>
          </div>
          <div class="hm-row">
            <div class="hm-label">Approved By</div>
            <div class="hm-value">{{$Member->ApprovedBy}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ① Basic Information -->
    <div class="section-label">Personal Details</div>
    <div class="card" id="sec-basic">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="user"></i></div>
        <div>
          <div class="card-head-title">Basic Information</div>
          <div class="card-head-sub">Identity and demographic details</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell span3">
            <div class="lbl">Full Name</div>
            <div class="data">{{$Member->last_name}}, {{$Member->first_name}} {{$Member->middle_name}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Birthdate</div>
            <div class="data">{{$Member->birthdate}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Place of Birth</div>
            <div class="data">{{$Member->place_of_birth}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Age</div>
            <div class="data">{{$Member->age}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Gender</div>
            <div class="data">{{$Member->gender}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Civil Status</div>
            <div class="data">{{$Member->civil_status}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Religion</div>
            <div class="data">{{$Member->religion}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Nationality</div>
            <div class="data">{{$Member->nationality}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ② Contact -->
    <div class="card" id="sec-contact">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="phone"></i></div>
        <div>
          <div class="card-head-title">Contact Information</div>
          <div class="card-head-sub">Email and phone number on file</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid cols2">
          <div class="info-cell">
            <div class="lbl">Email Address</div>
            <div class="data">{{$Member->email}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Phone Number</div>
            <div class="data">0{{$Member->contact_number}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ③ Address -->
    <div class="section-label">Location</div>
    <div class="card" id="sec-address">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="map-pin"></i></div>
        <div>
          <div class="card-head-title">Address</div>
          <div class="card-head-sub">Registered home address</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell span3">
            <div class="lbl">Street Address</div>
            <div class="data">{{$Member->street_address}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Barangay</div>
            <div class="data">{{$Member->barangay}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">City / Municipality</div>
            <div class="data">{{$Member->city}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Province</div>
            <div class="data">{{$Member->province}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Zip Code</div>
            <div class="data">{{$Member->zip_code}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Years of Stay</div>
            <div class="data">{{$Member->year_of_stay}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">House Ownership</div>
            <div class="data">{{$Member->house_ownership}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ④ Emergency Contact -->
    <div class="section-label">Emergency &amp; Employment</div>
    <div class="card" id="sec-emergency">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="heart-handshake"></i></div>
        <div>
          <div class="card-head-title">Emergency Contact</div>
          <div class="card-head-sub">Person to contact in case of emergency</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell span2">
            <div class="lbl">Full Name</div>
            <div class="data">{{$Member->ec_fullname}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Relationship</div>
            <div class="data">{{$Member->ec_relationship}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Gender</div>
            <div class="data">{{$Member->ec_gender}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Contact Number</div>
            <div class="data">{{$Member->ec_contact_number}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Email</div>
            <div class="data">{{$Member->ec_email}}</div>
          </div>
          <div class="info-cell span2">
            <div class="lbl">Address</div>
            <div class="data">{{$Member->address}}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ⑤ Employment -->
    <div class="card" id="sec-employment">
      <div class="card-head">
        <div class="card-head-icon"><i data-lucide="briefcase"></i></div>
        <div>
          <div class="card-head-title">Employment Information</div>
          <div class="card-head-sub">Occupation, income, and government IDs</div>
        </div>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-cell">
            <div class="lbl">Employment Status</div>
            <div class="data">{{$Member->employment_status}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Occupation</div>
            <div class="data">{{$Member->occupation}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Source of Funds</div>
            <div class="data">{{$Member->source_of_funds}}</div>
          </div>
          <div class="info-cell span2">
            <div class="lbl">Employer / Business Name</div>
            <div class="data">{{$Member->employer_business_name}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">Gross Monthly Income</div>
            <div class="data green">{{$Member->gross_monthly_income}}</div>
          </div>
          <div class="info-cell span3">
            <div class="lbl">Company / Business Address</div>
            <div class="data">{{$Member->company_business_address}}</div>
          </div>
          <div class="info-cell span3">
            <div class="lbl">Nature / Type of Employment or Business</div>
            <div class="data">{{$Member->nature_type_of_employment_business}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">SSS / GSIS No.</div>
            <div class="data mono">{{$Member->sss_gsis_no}}</div>
          </div>
          <div class="info-cell">
            <div class="lbl">TIN No.</div>
            <div class="data mono">{{$Member->tin_no}}</div>
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

  // Jump nav scroll highlight
  const jumpItems = document.querySelectorAll('.jump-item');
  const sections  = document.querySelectorAll('#sec-basic, #sec-contact, #sec-address, #sec-emergency, #sec-employment');
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        jumpItems.forEach(i => i.classList.remove('lit'));
        const match = document.querySelector(`.jump-item[data-sec="${entry.target.id}"]`);
        if (match) match.classList.add('lit');
      }
    });
  }, { threshold: 0.25, rootMargin: '-60px 0px -45% 0px' });
  sections.forEach(s => obs.observe(s));
</script>
</body>
</html>