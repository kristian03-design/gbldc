<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add User | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

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
      display: flex; align-items: center; gap: 14px;
      position: sticky; top: 0; z-index: 50;
    }

    .back-btn {
      display: flex; align-items: center; gap: 6px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s;
    }
    .back-btn:hover { background: #a7f3d0; }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }

    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700;
      color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    /* ── Breadcrumb ── */
    .breadcrumb {
      display: flex; align-items: center; gap: 5px;
      font-size: 12px; color: var(--muted);
      margin-top: 3px;
    }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body {
      padding: 32px;
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* ── Success alert ── */
    .alert-success {
      width: 100%; max-width: 560px;
      background: #dcfce7; border: 1px solid #86efac;
      color: #166534;
      padding: 12px 16px; border-radius: 10px;
      font-size: 14px; font-weight: 500;
      display: flex; align-items: center; gap: 8px;
      margin-bottom: 20px;
    }
    .alert-success i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Form card ── */
    .form-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      width: 100%; max-width: 560px;
      overflow: hidden;
    }

    .form-card-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      padding: 24px 28px;
      color: #fff;
      position: relative;
      overflow: hidden;
    }
    .form-card-header::before {
      content: '';
      position: absolute; top: -30px; right: -30px;
      width: 130px; height: 130px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }

    .form-card-header-inner {
      display: flex; align-items: center; gap: 14px;
      position: relative; z-index: 1;
    }

    .header-icon {
      width: 44px; height: 44px; border-radius: 12px;
      background: rgba(255,255,255,.15);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .header-icon i[data-lucide] { width: 22px; height: 22px; color: #fff; }

    .form-card-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 20px; margin-bottom: 2px;
    }
    .form-card-header p { font-size: 13px; opacity: .75; }

    .form-body { padding: 28px; }

    /* ── Form fields ── */
    .field { margin-bottom: 20px; }

    .field label {
      display: flex; align-items: center; gap: 6px;
      font-size: 13px; font-weight: 600;
      color: var(--ink); margin-bottom: 7px;
    }
    .field label i[data-lucide] { width: 14px; height: 14px; color: var(--muted); }

    .field input,
    .field select {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid var(--border);
      border-radius: 10px;
      font-size: 14px;
      font-family: 'DM Sans', sans-serif;
      color: var(--ink);
      background: var(--white);
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }
    .field input:focus,
    .field select:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .field input::placeholder { color: #9ca3af; }

    /* Password wrapper */
    .pw-wrap { position: relative; }
    .pw-wrap input { padding-right: 42px; }
    .pw-toggle {
      position: absolute; right: 12px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none; cursor: pointer;
      color: var(--muted); padding: 0;
      display: flex; align-items: center;
      transition: color .2s;
    }
    .pw-toggle:hover { color: var(--forest); }
    .pw-toggle i[data-lucide] { width: 16px; height: 16px; }

    /* ── Divider ── */
    .divider {
      border: none; border-top: 1px solid var(--border);
      margin: 4px 0 24px;
    }

    /* ── Buttons ── */
    .btn-row {
      display: flex; gap: 10px; justify-content: flex-end;
    }

    .btn {
      display: flex; align-items: center; gap: 7px;
      padding: 11px 20px; border-radius: 10px;
      font-size: 14px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      text-decoration: none;
      font-family: 'DM Sans', sans-serif;
    }
    .btn:active { transform: scale(.97); }
    .btn i[data-lucide] { width: 15px; height: 15px; }

    .btn.cancel { background: #f3f4f6; color: var(--ink); }
    .btn.cancel:hover { background: #e5e7eb; }

    .btn.submit { background: var(--forest); color: #fff; }
    .btn.submit:hover { background: var(--forest-mid); }

    /* ── Sidebar user dropdown ── */
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
    .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .main { margin-left: 0; }
      .page-body { padding: 20px 16px; }
      .topbar { padding: 12px 16px; }
    }
  </style>
</head>
<body>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
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
    <a href="{{route('Admin.manage')}}" class="nav-item active">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="admin-settings.html" class="nav-item">
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
      <a href="#" class="dropdown-item normal">
        <i data-lucide="user"></i> Profile
      </a>
      <a href="{{ route('Admin.Logout') }}" class="dropdown-item danger">
        <i data-lucide="log-out"></i> Logout
      </a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-title">
      <h1>Add New User</h1>
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <i data-lucide="house" style="width:12px;height:12px;"></i>
        <a href="{{route('Admin.dashboard')}}">Dashboard</a>
        <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
        <a href="{{route('Admin.manage')}}">Manage Users</a>
        <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
        <span class="current">Add New User</span>
      </nav>
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    @if (session('success'))
      <div class="alert-success">
        <i data-lucide="circle-check-big"></i>
        {{ session('success') }}
      </div>
    @endif

    <!-- Form card -->
    <div class="form-card">

      <div class="form-card-header">
        <div class="form-card-header-inner">
          <div class="header-icon">
            <i data-lucide="user-plus"></i>
          </div>
          <div>
            <h2>New Staff Account</h2>
            <p>Fill in the details below to create a user</p>
          </div>
        </div>
      </div>

      <div class="form-body">
        <form action="{{route('Create.staff')}}" method="POST" id="addUserForm">
          @csrf

          <div class="field">
            <label for="userName">
              <i data-lucide="user"></i> Full Name
            </label>
            <input type="text" name="full_name" id="userName"
              placeholder="Enter full name" required />
          </div>

          <div class="field">
            <label for="userEmail">
              <i data-lucide="mail"></i> Email Address
            </label>
            <input type="email" name="email" id="userEmail"
              placeholder="Enter email address" required />
          </div>

          <div class="field">
            <label for="userPassword">
              <i data-lucide="lock"></i> Password
            </label>
            <div class="pw-wrap">
              <input type="password" name="password" id="userPassword"
                placeholder="Enter password" required />
              <button type="button" class="pw-toggle" id="pw-toggle-btn" aria-label="Toggle password visibility">
                <i data-lucide="eye" id="pw-icon"></i>
              </button>
            </div>
          </div>

          <div class="field">
            <label for="userRole">
              <i data-lucide="shield"></i> Role
            </label>
            <select id="userRole" name="position" required>
              <option value="">Select a role</option>
              <option value="Staff">Staff</option>
            </select>
          </div>

          <hr class="divider" />

          <div class="btn-row">
            <a href="{{route('Admin.manage')}}" class="btn cancel">
              <i data-lucide="x"></i> Cancel
            </a>
            <button type="submit" class="btn submit">
              <i data-lucide="user-plus"></i> Add User
            </button>
          </div>

        </form>
      </div>
    </div>

  </div><!-- /page-body -->
</div><!-- /main -->

<script>
  lucide.createIcons();

  // User menu toggle
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // Password visibility toggle
  const pwInput  = document.getElementById('userPassword');
  const pwToggle = document.getElementById('pw-toggle-btn');
  const pwIcon   = document.getElementById('pw-icon');
  let visible = false;

  pwToggle.addEventListener('click', () => {
    visible = !visible;
    pwInput.type = visible ? 'text' : 'password';
    pwIcon.setAttribute('data-lucide', visible ? 'eye-off' : 'eye');
    lucide.createIcons();
  });
</script>
</body>
</html>