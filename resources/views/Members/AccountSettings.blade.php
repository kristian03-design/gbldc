<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings | GBLDC</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
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
      --sidebar-w: 260px;
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
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; bottom: 0;
      z-index: 100; transition: transform .3s ease;
    }
    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 22px 20px 18px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2; }
    .logo-sub  { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-profile {
      margin: 14px 12px; padding: 12px;
      background: rgba(255,255,255,.07); border-radius: 12px;
      display: flex; align-items: center; gap: 10px;
    }
    .profile-avatar {
      width: 40px; height: 40px; border-radius: 50%;
      border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; overflow: hidden;
    }
    .profile-avatar.female { background: #fce7f3; }
    .profile-avatar.male   { background: #dbeafe; }
    .profile-name  { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.3; }
    .profile-email { font-size: 11px; opacity: .5; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; }

    .sidebar-nav { flex: 1; padding: 8px 12px; overflow-y: auto; }
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
    .nav-item.danger { color: rgba(248,113,113,.8); }
    .nav-item.danger:hover { background: rgba(239,68,68,.1); color: #fca5a5; }

    .sidebar-footer { padding: 14px 12px; border-top: 1px solid rgba(255,255,255,.1); font-size: 11px; opacity: .35; text-align: center; }

    /* ── Mobile toggle ── */
    .mobile-toggle {
      display: none; position: fixed; top: 14px; left: 14px; z-index: 200;
      width: 38px; height: 38px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer; align-items: center; justify-content: center;
    }
    .mobile-toggle i[data-lucide] { width: 18px; height: 18px; }

    /* ── Main ── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── Topbar ── */
    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 14px 32px; position: sticky; top: 0; z-index: 50;
    }
    .topbar h1 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--forest); }
    .breadcrumb { display: flex; align-items: center; gap: 5px; font-size: 12px; color: var(--muted); margin-top: 3px; }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; display: flex; align-items: center; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Alerts ── */
    .alert {
      display: flex; align-items: center; gap: 10px;
      border-radius: 10px; padding: 12px 16px;
      margin-bottom: 20px; font-size: 13px;
    }
    .alert-success { background: #f0fdf4; border: 1px solid #86efac; color: #166534; }
    .alert-error   { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; }
    .alert i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Settings card ── */
    .settings-card {
      background: var(--white); border-radius: 16px;
      border: 1px solid var(--border); overflow: hidden;
    }

    /* ── Tab nav ── */
    .tab-nav {
      display: flex; border-bottom: 1px solid var(--border);
      padding: 0 22px; overflow-x: auto; gap: 2px;
      scrollbar-width: none;
    }
    .tab-nav::-webkit-scrollbar { display: none; }
    .tab-btn {
      display: flex; align-items: center; gap: 7px;
      padding: 14px 16px; font-size: 13px; font-weight: 600;
      color: var(--muted); background: transparent; border: none;
      border-bottom: 2px solid transparent; cursor: pointer;
      white-space: nowrap; transition: color .15s, border-color .15s;
      margin-bottom: -1px; font-family: 'DM Sans', sans-serif;
    }
    .tab-btn i[data-lucide] { width: 14px; height: 14px; }
    .tab-btn:hover { color: var(--ink); }
    .tab-btn.active { color: var(--forest); border-bottom-color: var(--emerald); }

    /* ── Tab content ── */
    .tab-panel { display: none; padding: 24px 22px; }
    .tab-panel.active { display: block; }

    /* ── Read-only info grid ── */
    .info-grid { display: grid; gap: 16px; }
    .info-grid.cols-3 { grid-template-columns: repeat(3, 1fr); }
    .info-grid.cols-2 { grid-template-columns: repeat(2, 1fr); }
    .info-grid.cols-1 { grid-template-columns: 1fr; }

    .info-field label {
      display: block; font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .05em;
      color: var(--muted); margin-bottom: 6px;
    }
    .info-value {
      padding: 10px 14px; border: 1px solid var(--border);
      border-radius: 10px; font-size: 13px; color: var(--ink);
      background: #f9fafb; min-height: 40px;
    }

    .info-notice {
      display: flex; align-items: center; gap: 8px;
      margin-top: 18px; padding: 10px 14px;
      background: #fffbeb; border: 1px solid #fde68a;
      border-radius: 10px; font-size: 12px; color: #92400e;
    }
    .info-notice i[data-lucide] { width: 14px; height: 14px; flex-shrink: 0; }

    /* ── Password form ── */
    .pw-form { max-width: 440px; display: flex; flex-direction: column; gap: 16px; }
    .form-group label {
      display: block; font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .05em;
      color: var(--muted); margin-bottom: 6px;
    }
    .form-group label span { color: var(--rose); }
    .input-wrap { position: relative; }
    .form-input {
      width: 100%; padding: 10px 40px 10px 14px;
      border: 1px solid var(--border); border-radius: 10px;
      font-size: 13px; font-family: 'DM Sans', sans-serif;
      color: var(--ink); outline: none;
      transition: border-color .2s, box-shadow .2s;
      background: var(--white);
    }
    .form-input:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .toggle-pw {
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      background: none; border: none; cursor: pointer; color: var(--muted);
      display: flex; align-items: center; padding: 0;
      transition: color .15s;
    }
    .toggle-pw:hover { color: var(--ink); }
    .toggle-pw i[data-lucide] { width: 15px; height: 15px; }

    .submit-btn {
      align-self: flex-end; padding: 11px 24px;
      background: var(--forest); color: #fff;
      border: none; border-radius: 10px;
      font-size: 13px; font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer; display: flex; align-items: center; gap: 8px;
      transition: background .2s, transform .1s;
    }
    .submit-btn:hover { background: var(--forest-mid); }
    .submit-btn:active { transform: scale(.98); }
    .submit-btn i[data-lucide] { width: 14px; height: 14px; }

    /* ── Logout modal ── */
    .modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.45); z-index: 200;
      align-items: center; justify-content: center; padding: 16px;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--white); border-radius: 16px;
      padding: 28px; width: 100%; max-width: 420px;
      animation: popIn .25s ease;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(10px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }
    .modal-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
    .modal-icon.red { background: #fee2e2; color: #dc2626; }
    .modal-icon i[data-lucide] { width: 22px; height: 22px; }
    .modal h3 { font-size: 18px; font-weight: 700; text-align: center; margin-bottom: 6px; }
    .modal p  { font-size: 13px; color: var(--muted); text-align: center; margin-bottom: 22px; }
    .modal-btn-row { display: flex; gap: 10px; }
    .modal-btn { flex: 1; padding: 11px; border-radius: 10px; font-size: 14px; font-weight: 600; border: none; cursor: pointer; transition: background .2s; font-family: 'DM Sans', sans-serif; }
    .modal-btn.cancel { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover { background: #e5e7eb; }
    .modal-btn.danger { background: var(--rose); color: #fff; }
    .modal-btn.danger:hover { background: #dc2626; }

    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    @media (max-width: 1024px) {
      .sidebar { transform: translateX(-260px); }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0; }
      .mobile-toggle { display: flex; }
      .page-body { padding: 20px 18px; }
      .topbar { padding: 14px 18px; }
      .info-grid.cols-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
      .info-grid.cols-3,
      .info-grid.cols-2 { grid-template-columns: 1fr; }
      .tab-btn span { display: none; }
    }
  </style>
</head>
<body>

<button class="mobile-toggle" id="mobileToggle">
  <i data-lucide="menu"></i>
</button>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
      style="width:40px;height:40px;object-fit:cover;border-radius:10px;flex-shrink:0;" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Member Portal</div>
    </div>
  </div>

  <div class="sidebar-profile">
    <div class="profile-avatar {{ ($gender ?? '') == 'Female' ? 'female' : 'male' }}">
      @if(($gender ?? '') == 'Female')
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{ $fist_name ?? '' }} {{ $last_name ?? '' }}</div>
      <div class="profile-email">{{ $email ?? '' }}</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <a href="{{ route('Member.Landing') }}" class="nav-item">
      <i data-lucide="home"></i> Home
    </a>
    <a href="{{ route('Loan.Dashboard') }}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Loan Dashboard
    </a>
    <a href="{{ route('Member.Check.Loan.Status') }}" class="nav-item">
      <i data-lucide="search"></i> Check Loan Status
    </a>
    <a href="{{ route('Member.ContactUs') }}" class="nav-item">
      <i data-lucide="mail"></i> Contact Us
    </a>
    <a href="{{ route('Member.FAQ') }}" class="nav-item">
      <i data-lucide="circle-help"></i> FAQ
    </a>
    <a href="{{ route('Member.AccountSettings') }}" class="nav-item active">
      <i data-lucide="settings"></i> Account Settings
    </a>
    <a href="#" class="nav-item danger" onclick="openLogoutModal(); return false;">
      <i data-lucide="log-out"></i> Logout
    </a>
  </nav>

  <div class="sidebar-footer">GBLDC Member Portal &copy; 2025</div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <header class="topbar">
    <h1>Account Settings</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <i data-lucide="house" style="width:12px;height:12px;"></i>
      <a href="{{ route('Member.Landing') }}">Home</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <span class="current">Account Settings</span>
    </nav>
  </header>

  <div class="page-body">

    @if(session('success'))
    <div class="alert alert-success">
      <i data-lucide="circle-check-big"></i>
      {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
      <i data-lucide="circle-x"></i>
      {{ session('error') }}
    </div>
    @endif

    <div class="settings-card">

      <!-- Tab Navigation -->
      <div class="tab-nav">
        <button class="tab-btn active" onclick="showTab('basic')" id="tab-basic">
          <i data-lucide="user"></i> <span>Basic Information</span>
        </button>
        <button class="tab-btn" onclick="showTab('contact')" id="tab-contact">
          <i data-lucide="phone"></i> <span>Contact Information</span>
        </button>
        <button class="tab-btn" onclick="showTab('address')" id="tab-address">
          <i data-lucide="map-pin"></i> <span>Address</span>
        </button>
        <button class="tab-btn" onclick="showTab('password')" id="tab-password">
          <i data-lucide="lock"></i> <span>Password</span>
        </button>
      </div>

      <!-- Basic Information -->
      <div class="tab-panel active" id="panel-basic">
        <div class="info-grid cols-3">
          <div class="info-field">
            <label>First Name</label>
            <div class="info-value">{{ $user->first_name ?? 'N/A' }}</div>
          </div>
          <div class="info-field">
            <label>Middle Name</label>
            <div class="info-value">{{ $user->middle_name ?? 'N/A' }}</div>
          </div>
          <div class="info-field">
            <label>Last Name</label>
            <div class="info-value">{{ $user->last_name ?? 'N/A' }}</div>
          </div>
        </div>
        <div class="info-notice">
          <i data-lucide="info"></i>
          Contact admin to update your basic information.
        </div>
      </div>

      <!-- Contact Information -->
      <div class="tab-panel" id="panel-contact">
        <div class="info-grid cols-2">
          <div class="info-field">
            <label>Email Address</label>
            <div class="info-value">{{ $user->email ?? 'N/A' }}</div>
          </div>
          <div class="info-field">
            <label>Contact Number</label>
            <div class="info-value">{{ $user->contact_number ?? 'N/A' }}</div>
          </div>
        </div>
        <div class="info-notice">
          <i data-lucide="info"></i>
          Contact admin to update your contact information.
        </div>
      </div>

      <!-- Address -->
      <div class="tab-panel" id="panel-address">
        <div class="info-grid cols-1" style="margin-bottom:16px;">
          <div class="info-field">
            <label>Street Address</label>
            <div class="info-value">{{ $user->street_address ?? 'N/A' }}</div>
          </div>
        </div>
        <div class="info-grid cols-2" style="margin-bottom:16px;">
          <div class="info-field">
            <label>Barangay</label>
            <div class="info-value">{{ $user->barangay ?? 'N/A' }}</div>
          </div>
          <div class="info-field">
            <label>City / Municipality</label>
            <div class="info-value">{{ $user->city ?? 'N/A' }}</div>
          </div>
        </div>
        <div class="info-grid cols-2">
          <div class="info-field">
            <label>Province</label>
            <div class="info-value">{{ $user->province ?? 'N/A' }}</div>
          </div>
          <div class="info-field">
            <label>Zip Code</label>
            <div class="info-value">{{ $user->zip_code ?? 'N/A' }}</div>
          </div>
        </div>
        <div class="info-notice">
          <i data-lucide="info"></i>
          Contact admin to update your address information.
        </div>
      </div>

      <!-- Password -->
      <div class="tab-panel" id="panel-password">
        <form action="{{ route('Member.AccountSettings.UpdatePassword') }}" method="POST" class="pw-form">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Current Password <span>*</span></label>
            <div class="input-wrap">
              <input type="password" id="current_password" name="current_password" required class="form-input">
              <button type="button" class="toggle-pw" onclick="togglePw('current_password', this)">
                <i data-lucide="eye"></i>
              </button>
            </div>
            @error('current_password')
              <p style="font-size:11px;color:var(--rose);margin-top:4px;">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-group">
            <label>New Password <span>*</span></label>
            <div class="input-wrap">
              <input type="password" id="new_password" name="new_password" required minlength="8" class="form-input">
              <button type="button" class="toggle-pw" onclick="togglePw('new_password', this)">
                <i data-lucide="eye"></i>
              </button>
            </div>
            @error('new_password')
              <p style="font-size:11px;color:var(--rose);margin-top:4px;">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-group">
            <label>Confirm New Password <span>*</span></label>
            <div class="input-wrap">
              <input type="password" id="new_password_confirmation" name="new_password_confirmation" required class="form-input">
              <button type="button" class="toggle-pw" onclick="togglePw('new_password_confirmation', this)">
                <i data-lucide="eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="submit-btn">
            <i data-lucide="lock"></i> Update Password
          </button>
        </form>
      </div>

    </div><!-- /settings-card -->
  </div><!-- /page-body -->

</div><!-- /main -->

<!-- Logout Modal -->
<div class="modal-overlay" id="logout-modal">
  <div class="modal">
    <div class="modal-icon red"><i data-lucide="log-out"></i></div>
    <h3>Confirm Logout</h3>
    <p>Are you sure you want to logout? You'll need to sign in again to access your account.</p>
    <div class="modal-btn-row">
      <button class="modal-btn cancel" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{ route('Member.Logout') }}" class="modal-btn danger"
        style="text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</div>

<script>
  lucide.createIcons();

  // Mobile sidebar
  const sidebar = document.getElementById('sidebar');
  const mobileToggle = document.getElementById('mobileToggle');
  mobileToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  document.addEventListener('click', e => {
    if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
      sidebar.classList.remove('open');
    }
  });

  // Logout modal
  const logoutModal = document.getElementById('logout-modal');
  function openLogoutModal()  { logoutModal.classList.add('open'); }
  function closeLogoutModal() { logoutModal.classList.remove('open'); }
  logoutModal.addEventListener('click', e => { if (e.target === logoutModal) closeLogoutModal(); });

  // Tabs
  function showTab(name) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    document.getElementById('panel-' + name).classList.add('active');
    lucide.createIcons();
  }

  // Password toggle
  function togglePw(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.querySelector('i[data-lucide]').setAttribute('data-lucide', isHidden ? 'eye-off' : 'eye');
    lucide.createIcons();
  }

  // Open password tab if there are validation errors
  @if($errors->has('current_password') || $errors->has('new_password'))
    showTab('password');
  @endif
</script>
</body>
</html>