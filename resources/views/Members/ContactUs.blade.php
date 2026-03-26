<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | GBLDC</title>
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
    .breadcrumb .sep { color: #d1d5db; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Layout grid ── */
    .contact-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 24px; }

    /* ── Cards ── */
    .card {
      background: var(--white); border-radius: 16px;
      border: 1px solid var(--border); overflow: hidden;
    }
    .card-header {
      padding: 18px 22px 14px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: 8px;
    }
    .card-header h2 { font-size: 15px; font-weight: 700; color: var(--ink); display: flex; align-items: center; gap: 8px; }
    .card-header h2 i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }
    .card-body { padding: 22px; }

    /* ── Contact info items ── */
    .contact-items { display: flex; flex-direction: column; gap: 20px; }
    .contact-item { display: flex; align-items: flex-start; gap: 14px; }
    .contact-icon {
      width: 40px; height: 40px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .contact-icon i[data-lucide] { width: 17px; height: 17px; }
    .contact-item h3 { font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
    .contact-item p  { font-size: 12px; color: var(--muted); line-height: 1.6; }

    .divider { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

    /* ── Social links ── */
    .social-label { font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 12px; }
    .social-row { display: flex; gap: 10px; }
    .social-btn {
      width: 36px; height: 36px; border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      text-decoration: none; color: #fff; font-size: 14px;
      transition: opacity .2s, transform .1s;
    }
    .social-btn:hover { opacity: .85; transform: translateY(-1px); }
    .social-btn.fb  { background: #1877f2; }
    .social-btn.tw  { background: #0ea5e9; }
    .social-btn.ig  { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
    .social-btn.vi  { background: #665cac; }

    /* ── Success alert ── */
    .alert-success {
      display: flex; align-items: center; gap: 10px;
      background: #f0fdf4; border: 1px solid #86efac;
      border-radius: 10px; padding: 12px 16px;
      margin-bottom: 20px; font-size: 13px; color: #166534;
    }
    .alert-success i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Form ── */
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px; }
    .form-group { margin-bottom: 16px; }
    .form-group label {
      display: block; font-size: 12px; font-weight: 600;
      text-transform: uppercase; letter-spacing: .05em;
      color: var(--muted); margin-bottom: 6px;
    }
    .form-group label span { color: var(--rose); }

    .form-input, .form-select, .form-textarea {
      width: 100%; padding: 10px 14px;
      border: 1px solid var(--border); border-radius: 10px;
      font-size: 13px; font-family: 'DM Sans', sans-serif;
      color: var(--ink); outline: none;
      transition: border-color .2s, box-shadow .2s;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .form-input.readonly, .form-input[readonly] {
      background: #f9fafb; color: var(--muted); cursor: default;
    }
    .form-textarea { resize: vertical; min-height: 130px; }

    .form-error { font-size: 11px; color: var(--rose); margin-top: 4px; }

    .submit-btn {
      width: 100%; padding: 12px;
      background: var(--forest); color: #fff;
      border: none; border-radius: 10px;
      font-size: 14px; font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
      transition: background .2s, transform .1s;
    }
    .submit-btn:hover { background: var(--forest-mid); }
    .submit-btn:active { transform: scale(.98); }
    .submit-btn i[data-lucide] { width: 15px; height: 15px; }

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
      .contact-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
      .form-row { grid-template-columns: 1fr; }
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
    <div class="profile-avatar {{ $gender == 'Female' ? 'female' : 'male' }}">
      @if($gender == 'Female')
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{$fist_name}} {{$last_name}}</div>
      <div style="margin-top: 5px; display: inline-flex; align-items: center; gap: 5px; padding: 4px 8px; border-radius: 6px; background: rgba(255, 255, 255, 0.1); font-size: 11px; font-weight: 600; color: #d1fae5; border: 1px solid rgba(255, 255, 255, 0.15); letter-spacing: 0.03em;">
        <i data-lucide="id-card" style="width: 12px; height: 12px; opacity: 0.9;"></i> {{$member_id}}
      </div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <a href="{{route('Member.Landing')}}" class="nav-item">
      <i data-lucide="home"></i> Home
    </a>
    <a href="{{route('Loan.Dashboard')}}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Loan Dashboard
    </a>
    <a href="{{ route('Member.Check.Loan.Status') }}" class="nav-item">
      <i data-lucide="search"></i> Check Loan Status
    </a>
    <a href="{{ route('Member.Check.Shared.Capital') }}" class="nav-item">
      <i data-lucide="piggy-bank"></i> Check Shared Capital
    </a>
    <a href="{{ route('Member.Notifications') }}" class="nav-item">
      <i data-lucide="bell"></i> Notification
    </a>
    <a href="{{ route('Member.ContactUs') }}" class="nav-item active">
      <i data-lucide="mail"></i> Contact Us
    </a>
    <a href="{{ route('Member.FAQ') }}" class="nav-item">
      <i data-lucide="circle-help"></i> FAQ
    </a>
    <a href="{{ route('Member.AccountSettings') }}" class="nav-item">
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
    <h1>Contact Us</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <i data-lucide="house" style="width:12px;height:12px;"></i>
      <a href="{{route('Member.Landing')}}">Home</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <span class="current">Contact Us</span>
    </nav>
  </header>

  <div class="page-body">

    @if(session('success'))
    <div class="alert-success">
      <i data-lucide="circle-check-big"></i>
      {{ session('success') }}
    </div>
    @endif

    <div class="contact-grid">

      <!-- Contact Information -->
      <div class="card">
        <div class="card-header">
          <h2><i data-lucide="phone"></i> Get in Touch</h2>
        </div>
        <div class="card-body">
          <div class="contact-items">
            <div class="contact-item">
              <div class="contact-icon"><i data-lucide="map-pin"></i></div>
              <div>
                <h3>Office Address</h3>
                <p>Greater Bulacan Livelihood Development Cooperative<br>Makinabang Baliuag, Bulacan, Philippines</p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon"><i data-lucide="phone"></i></div>
              <div>
                <h3>Phone</h3>
                <p>+63 (44) 123-4567<br>+63 912 345 6789</p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon"><i data-lucide="mail"></i></div>
              <div>
                <h3>Email</h3>
                <p>gbldccoop@gmail.com<br></p>
              </div>
            </div>
            <div class="contact-item">
              <div class="contact-icon"><i data-lucide="clock"></i></div>
              <div>
                <h3>Business Hours</h3>
                <p>Monday – Friday: 8:00 AM – 5:00 PM<br>Saturday: 8:00 AM – 12:00 PM<br>Sunday: Closed</p>
              </div>
            </div>
          </div>

          <hr class="divider">

          <div class="social-label">Follow Us</div>
          <div class="social-row">
            <a href="#" class="social-btn fb" title="Facebook">
              <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" class="social-btn tw" title="Twitter / X">
              <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
            </a>
            <a href="#" class="social-btn ig" title="Instagram">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="#" class="social-btn vi" title="Viber">
              <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M11.4 2C6.3 2 2 5.5 2 9.8c0 2.6 1.5 5 4 6.4v3.3l3.1-1.7c.7.2 1.5.2 2.3.2 5.1 0 9.4-3.5 9.4-7.8S16.5 2 11.4 2zm.9 10.5-2.3-2.5-4.4 2.5 4.8-5.1 2.3 2.5 4.4-2.5-4.8 5.1z"/></svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="card">
        <div class="card-header">
          <h2><i data-lucide="send"></i> Send Us a Message</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('Member.ContactUs.Submit') }}" method="POST">
            @csrf

            <div class="form-row">
              <div class="form-group" style="margin-bottom:0;">
                <label>Your Name</label>
                <input type="text" class="form-input readonly"
                  value="{{ $fist_name }} {{ $middle_name }} {{ $last_name }}" readonly>
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label>Email Address</label>
                <input type="email" class="form-input readonly" value="{{ $email }}" readonly>
              </div>
            </div>

            <div class="form-group">
              <label>Subject <span>*</span></label>
              <select name="subject" class="form-select" required>
                <option value="">Select a subject</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Loan Assistance">Loan Assistance</option>
                <option value="Account Issue">Account Issue</option>
                <option value="Suggestion">Suggestion</option>
                <option value="Complaint">Complaint</option>
                <option value="Other">Other</option>
              </select>
              @error('subject')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>Message <span>*</span></label>
              <textarea name="message" class="form-textarea" required
                placeholder="How can we help you?"></textarea>
              @error('message')
                <div class="form-error">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="submit-btn">
              <i data-lucide="send"></i> Send Message
            </button>
          </form>
        </div>
      </div>

    </div><!-- /contact-grid -->
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
</script>
</body>
</html>