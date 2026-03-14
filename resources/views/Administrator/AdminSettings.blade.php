<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Settings | GBLDC Admin</title>
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
      display: flex;
      align-items: center;
      gap: 12px;
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
    .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
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
    .dropdown-item svg { width: 14px; height: 14px; }

    .main {
      margin-left: var(--sidebar-w);
      flex: 1; display: flex;
      flex-direction: column; min-height: 100vh;
    }

    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 50;
    }
    .topbar-left { display: flex; align-items: center; gap: 14px; }
    .back-btn {
      display: flex; align-items: center; gap: 6px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s;
    }
    .back-btn:hover { background: #a7f3d0; }
    .back-btn svg { width: 14px; height: 14px; }
    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700;
      color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    .page-body { padding: 28px 32px; flex: 1; }

    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 24px 28px;
      color: #fff;
      margin-bottom: 18px;
      position: relative;
      overflow: hidden;
    }
    .page-header::before {
      content: '';
      position: absolute; top: -30px; right: -30px;
      width: 160px; height: 160px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; margin-bottom: 4px;
    }
    .page-header p { font-size: 13px; opacity: .75; }

    .grid {
      display: grid;
      grid-template-columns: 1.1fr .9fr;
      gap: 16px;
    }
    .card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
    }
    .card-header {
      padding: 18px 20px 14px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .card-header h3 {
      font-size: 15px;
      font-weight: 800;
      color: var(--ink);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .card-header h3 svg { width: 18px; height: 18px; color: var(--emerald); }

    .card-body { padding: 18px 20px 22px; }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .field { display: flex; flex-direction: column; gap: 6px; }
    .field.full { grid-column: 1 / -1; }
    label { font-size: 12px; font-weight: 700; color: #374151; }
    .input {
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 10px 12px;
      outline: none;
      font-size: 13px;
      transition: border-color .2s, box-shadow .2s;
      font-family: 'DM Sans', sans-serif;
      background: #fff;
      color: var(--ink);
    }
    .input:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.15);
    }

    .btn-row {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 14px;
    }
    .btn {
      border: none;
      border-radius: 10px;
      padding: 10px 16px;
      font-weight: 800;
      cursor: pointer;
      font-size: 13px;
      transition: transform .08s, background .2s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      white-space: nowrap;
    }
    .btn:active { transform: scale(.98); }
    .btn.primary { background: var(--forest); color: #fff; }
    .btn.primary:hover { background: var(--forest-mid); }
    .btn.danger { background: #fee2e2; color: #991b1b; }
    .btn.danger:hover { background: #fecaca; }

    .helper {
      font-size: 12px;
      color: var(--muted);
      margin-top: 10px;
      line-height: 1.4;
    }

    @media (max-width: 980px) {
      .grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .main { margin-left: 0; }
      .page-body { padding: 20px 16px; }
      .topbar { padding: 12px 16px; }
      .form-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
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
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item">
      <i data-lucide="piggy-bank"></i> Shared Capital
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="{{route('Admin.Settings')}}" class="nav-item active">
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
      <a href="{{route('Admin.Settings')}}" class="dropdown-item normal">
        <i data-lucide="settings" style="width:14px;height:14px;"></i> Settings
      </a>
      <a href="{{ route('Admin.Logout') }}" class="dropdown-item danger">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</aside>

<div class="main">
  <header class="topbar">
    <div class="topbar-left">
      <a href="{{route('Admin.dashboard')}}" class="back-btn">
        <i data-lucide="arrow-left"></i> Back
      </a>
      <div class="topbar-title">
        <h1>Settings</h1>
        <p>Update your admin profile and security preferences</p>
      </div>
    </div>
  </header>

  <div class="page-body">
    <div class="page-header">
      <h2>Admin Settings</h2>
      <p>Keep your account information up to date and secure.</p>
    </div>

    <div class="grid">
      <div class="card">
        <div class="card-header">
          <h3><i data-lucide="user-cog"></i> Profile</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('Admin.Settings.Profile') }}">
            @csrf
            <div class="form-grid">
              <div class="field full">
                <label for="full_name">Full Name</label>
                <input id="full_name" name="full_name" class="input" value="{{ old('full_name', auth('admin')->user()->full_name ?? '') }}" required>
              </div>
              <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class="input" value="{{ old('email', auth('admin')->user()->email ?? '') }}" required>
              </div>
              <div class="field">
                <label for="position">Position</label>
                <input id="position" name="position" class="input" value="{{ old('position', auth('admin')->user()->position ?? '') }}" required>
              </div>
            </div>

            <div class="btn-row">
              <button class="btn primary" type="submit">
                <i data-lucide="save"></i> Save Profile
              </button>
            </div>
          </form>
          <div class="helper">
            If you change your email, make sure it stays unique in the admin list.
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3><i data-lucide="lock"></i> Security</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('Admin.Settings.Password') }}">
            @csrf
            <div class="form-grid">
              <div class="field full">
                <label for="current_password">Current Password</label>
                <input id="current_password" name="current_password" type="password" class="input" required>
              </div>
              <div class="field">
                <label for="new_password">New Password</label>
                <input id="new_password" name="new_password" type="password" class="input" required>
              </div>
              <div class="field">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="input" required>
              </div>
            </div>

            <div class="btn-row">
              <button class="btn primary" type="submit">
                <i data-lucide="key"></i> Update Password
              </button>
            </div>
          </form>
          <div class="helper">
            Password must be at least 8 characters. Don’t reuse old passwords.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  lucide.createIcons();

  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  if (userBtn && userMenu) {
    userBtn.addEventListener('click', e => {
      e.stopPropagation();
      userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
    });
    document.addEventListener('click', () => { userMenu.style.display = 'none'; });
  }

  @if(session('success'))
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: {!! json_encode(session('success')) !!},
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
  });
  @endif
  @if(session('error'))
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: {!! json_encode(session('error')) !!},
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
  });
  @endif
  @if($errors->any())
  Swal.fire({
    icon: 'warning',
    title: 'Validation Error',
    text: {!! json_encode($errors->first()) !!},
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true
  });
  @endif
</script>
</body>
</html>

