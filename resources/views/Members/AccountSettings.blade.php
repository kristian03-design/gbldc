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

      /* New design tokens */
      --glass:     rgba(255,255,255,0.72);
      --glass-border: rgba(255,255,255,0.9);
      --surface:   #f3f7f4;
      --surface-2: #eaf2ec;
      --accent-glow: rgba(34,197,94,0.15);
      --text-dim:  #9ca3af;
      --radius-xl: 20px;
      --radius-lg: 14px;
      --radius-md: 10px;
      --shadow-sm: 0 1px 3px rgba(13,74,47,.06), 0 1px 2px rgba(13,74,47,.04);
      --shadow-md: 0 4px 16px rgba(13,74,47,.08), 0 2px 6px rgba(13,74,47,.05);
      --shadow-lg: 0 12px 40px rgba(13,74,47,.12), 0 4px 12px rgba(13,74,47,.06);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--surface);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
    }

    /* ────── SIDEBAR (UNCHANGED) ────── */
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

    /* ────── MOBILE TOGGLE ────── */
    .mobile-toggle {
      display: none; position: fixed; top: 14px; left: 14px; z-index: 200;
      width: 38px; height: 38px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer; align-items: center; justify-content: center;
    }
    .mobile-toggle i[data-lucide] { width: 18px; height: 18px; }

    /* ────── MAIN LAYOUT ────── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background: var(--surface);
    }

    /* ────── TOPBAR (REDESIGNED) ────── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 0 36px;
      height: 68px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 50;
      box-shadow: var(--shadow-sm);
    }
    .topbar-left {}
    .topbar h1 {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 800;
      color: var(--forest);
      letter-spacing: -0.02em;
    }
    .breadcrumb {
      display: flex; align-items: center; gap: 5px;
      font-size: 11.5px; color: var(--text-dim); margin-top: 2px;
    }
    .breadcrumb a { color: var(--text-dim); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; display: flex; align-items: center; }
    .breadcrumb .current { color: var(--forest-mid); font-weight: 600; }
    .topbar-badge {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 6px 12px; border-radius: 100px;
      background: var(--sage); color: var(--forest);
      font-size: 12px; font-weight: 600;
    }
    .topbar-badge i[data-lucide] { width: 12px; height: 12px; }

    /* ────── PAGE BODY ────── */
    .page-body {
      padding: 32px 36px;
      flex: 1;
      animation: fadeUp .4s ease both;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ────── ALERTS ────── */
    .alert {
      display: flex; align-items: center; gap: 10px;
      border-radius: var(--radius-lg); padding: 13px 18px;
      margin-bottom: 24px; font-size: 13px;
      animation: slideDown .3s ease;
    }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-8px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .alert-success { background: #f0fdf4; border: 1px solid #86efac; color: #166534; }
    .alert-error   { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; }
    .alert i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ────── SETTINGS LAYOUT (TWO-COLUMN) ────── */
    .settings-layout {
      display: grid;
      grid-template-columns: 220px 1fr;
      gap: 24px;
      align-items: start;
    }

    /* ────── VERTICAL TAB SIDEBAR ────── */
    .tab-sidebar {
      background: var(--white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--border);
      padding: 10px;
      box-shadow: var(--shadow-sm);
      position: sticky;
      top: 92px;
    }
    .tab-sidebar-label {
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: var(--text-dim);
      padding: 8px 10px 6px;
    }
    .tab-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      padding: 11px 14px;
      border-radius: var(--radius-md);
      border: none;
      background: transparent;
      color: var(--muted);
      font-size: 13px;
      font-weight: 500;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      text-align: left;
      transition: background .18s, color .18s;
      margin-bottom: 2px;
      position: relative;
    }
    .tab-btn i[data-lucide] { width: 15px; height: 15px; flex-shrink: 0; }
    .tab-btn:hover { background: var(--surface-2); color: var(--ink); }
    .tab-btn.active {
      background: var(--sage);
      color: var(--forest);
      font-weight: 700;
    }
    .tab-btn.active::before {
      content: '';
      position: absolute;
      left: 0; top: 25%; bottom: 25%;
      width: 3px;
      background: var(--emerald);
      border-radius: 0 3px 3px 0;
    }

    /* ────── CONTENT PANEL ────── */
    .settings-content {
      background: var(--white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--border);
      box-shadow: var(--shadow-sm);
      overflow: hidden;
    }

    .tab-panel { display: none; }
    .tab-panel.active { display: block; animation: panelIn .25s ease; }
    @keyframes panelIn {
      from { opacity: 0; transform: translateX(8px); }
      to   { opacity: 1; transform: translateX(0); }
    }

    /* ────── PANEL HEADER ────── */
    .panel-header {
      padding: 24px 28px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .panel-header-icon {
      width: 42px; height: 42px;
      border-radius: 12px;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center;
      color: var(--forest);
      flex-shrink: 0;
    }
    .panel-header-icon i[data-lucide] { width: 18px; height: 18px; }
    .panel-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 17px;
      font-weight: 800;
      color: var(--ink);
      letter-spacing: -0.01em;
    }
    .panel-header p {
      font-size: 12px;
      color: var(--text-dim);
      margin-top: 2px;
    }

    /* ────── PANEL BODY ────── */
    .panel-body { padding: 28px; }

    /* ────── AVATAR UPLOAD SECTION ────── */
    .avatar-upload-section {
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 20px;
      background: var(--surface);
      border-radius: var(--radius-lg);
      border: 1px dashed var(--border);
      margin-bottom: 28px;
      transition: border-color .2s, background .2s;
    }
    .avatar-upload-section:hover {
      border-color: var(--emerald);
      background: #f0fdf4;
    }
    .big-avatar {
      width: 72px; height: 72px; border-radius: 50%;
      border: 3px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; overflow: hidden;
      box-shadow: 0 0 0 4px var(--accent-glow);
    }
    .big-avatar.female { background: #fce7f3; }
    .big-avatar.male   { background: #dbeafe; }
    .upload-label {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .05em;
      color: var(--muted);
      margin-bottom: 8px;
      display: block;
    }
    .file-input-row {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    input[type="file"] {
      font-size: 12px;
      font-family: 'DM Sans', sans-serif;
      color: var(--ink);
    }

    /* ────── INFO GRID ────── */
    .info-grid { display: grid; gap: 18px; }
    .info-grid.cols-3 { grid-template-columns: repeat(3, 1fr); }
    .info-grid.cols-2 { grid-template-columns: repeat(2, 1fr); }
    .info-grid.cols-1 { grid-template-columns: 1fr; }

    .info-field label {
      display: block;
      font-size: 10.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .07em;
      color: var(--text-dim);
      margin-bottom: 7px;
    }
    .info-value {
      padding: 11px 16px;
      border: 1.5px solid var(--border);
      border-radius: var(--radius-md);
      font-size: 13.5px;
      color: var(--ink);
      background: var(--surface);
      min-height: 42px;
      font-weight: 500;
    }

    /* ────── NOTICE ────── */
    .info-notice {
      display: flex; align-items: center; gap: 10px;
      margin-top: 22px; padding: 12px 16px;
      background: #fffbeb; border: 1px solid #fde68a;
      border-radius: var(--radius-md); font-size: 12px; color: #92400e;
    }
    .info-notice i[data-lucide] { width: 14px; height: 14px; flex-shrink: 0; }

    /* ────── PASSWORD FORM ────── */
    .pw-form { max-width: 460px; display: flex; flex-direction: column; gap: 20px; }

    .form-group {}
    .form-group label {
      display: flex; align-items: center; gap: 5px;
      font-size: 10.5px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .07em;
      color: var(--text-dim); margin-bottom: 7px;
    }
    .form-group label span { color: var(--rose); }

    .input-wrap { position: relative; }
    .form-input {
      width: 100%;
      padding: 11px 42px 11px 16px;
      border: 1.5px solid var(--border);
      border-radius: var(--radius-md);
      font-size: 13.5px;
      font-family: 'DM Sans', sans-serif;
      color: var(--ink);
      outline: none;
      transition: border-color .2s, box-shadow .2s, background .2s;
      background: var(--surface);
    }
    .form-input:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 4px var(--accent-glow);
      background: var(--white);
    }
    .toggle-pw {
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      background: none; border: none; cursor: pointer; color: var(--text-dim);
      display: flex; align-items: center; padding: 2px;
      transition: color .15s;
    }
    .toggle-pw:hover { color: var(--forest); }
    .toggle-pw i[data-lucide] { width: 15px; height: 15px; }

    .form-error { font-size: 11px; color: var(--rose); margin-top: 5px; display: flex; align-items: center; gap: 4px; }
    .form-error i[data-lucide] { width: 11px; height: 11px; }

    /* ────── STRENGTH BAR ────── */
    .strength-bar-wrap { margin-top: 8px; display: flex; gap: 4px; }
    .strength-seg {
      height: 3px;
      border-radius: 2px;
      flex: 1;
      background: var(--border);
      transition: background .3s;
    }
    .strength-seg.filled-weak   { background: #ef4444; }
    .strength-seg.filled-medium { background: #f59e0b; }
    .strength-seg.filled-strong { background: var(--emerald); }
    .strength-label { font-size: 10.5px; margin-top: 4px; color: var(--text-dim); }

    /* ────── SUBMIT BTN ────── */
    .submit-btn {
      align-self: flex-start;
      padding: 12px 28px;
      background: var(--forest);
      color: #fff;
      border: none;
      border-radius: var(--radius-md);
      font-size: 13px;
      font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: background .2s, transform .12s, box-shadow .2s;
      box-shadow: 0 2px 8px rgba(13,74,47,.2);
    }
    .submit-btn:hover {
      background: var(--forest-mid);
      box-shadow: 0 4px 16px rgba(13,74,47,.3);
      transform: translateY(-1px);
    }
    .submit-btn:active { transform: scale(.98) translateY(0); }
    .submit-btn i[data-lucide] { width: 14px; height: 14px; }

    .upload-btn {
      padding: 8px 18px;
      background: var(--forest);
      color: #fff;
      border: none;
      border-radius: var(--radius-md);
      font-size: 12px;
      font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      display: inline-flex; align-items: center; gap: 6px;
      transition: background .2s, transform .12s;
    }
    .upload-btn:hover { background: var(--forest-mid); transform: translateY(-1px); }
    .upload-btn i[data-lucide] { width: 13px; height: 13px; }

    /* ────── DIVIDER ────── */
    .section-divider {
      height: 1px;
      background: var(--border);
      margin: 24px 0;
    }

    /* ────── CONTACT LAYOUT ────── */
    .contact-card {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 16px;
      background: var(--surface);
      border-radius: var(--radius-lg);
      border: 1.5px solid var(--border);
    }
    .contact-card-icon {
      width: 40px; height: 40px;
      border-radius: 10px;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center;
      color: var(--forest); flex-shrink: 0;
    }
    .contact-card-icon i[data-lucide] { width: 16px; height: 16px; }
    .contact-card-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text-dim); }
    .contact-card-value { font-size: 14px; font-weight: 600; color: var(--ink); margin-top: 2px; }

    /* ────── LOGOUT MODAL ────── */
    .modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.45); z-index: 200;
      align-items: center; justify-content: center; padding: 16px;
      backdrop-filter: blur(4px);
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--white); border-radius: var(--radius-xl);
      padding: 32px; width: 100%; max-width: 400px;
      animation: popIn .25s ease;
      box-shadow: var(--shadow-lg);
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(10px); }
      to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-icon { width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
    .modal-icon.red { background: #fee2e2; color: #dc2626; }
    .modal-icon i[data-lucide] { width: 22px; height: 22px; }
    .modal h3 { font-family: 'Playfair Display', serif; font-size: 19px; font-weight: 800; text-align: center; margin-bottom: 8px; }
    .modal p  { font-size: 13px; color: var(--muted); text-align: center; margin-bottom: 24px; line-height: 1.6; }
    .modal-btn-row { display: flex; gap: 10px; }
    .modal-btn { flex: 1; padding: 12px; border-radius: 10px; font-size: 14px; font-weight: 600; border: none; cursor: pointer; transition: background .2s; font-family: 'DM Sans', sans-serif; }
    .modal-btn.cancel { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover { background: #e5e7eb; }
    .modal-btn.danger { background: var(--rose); color: #fff; }
    .modal-btn.danger:hover { background: #dc2626; }

    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    @media (max-width: 1024px) {
      .sidebar { transform: translateX(-260px); }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0; }
      .mobile-toggle { display: flex; }
      .page-body { padding: 20px 18px; }
      .topbar { padding: 0 20px; }
      .settings-layout { grid-template-columns: 1fr; }
      .tab-sidebar { position: static; display: flex; flex-wrap: wrap; gap: 4px; padding: 8px; }
      .tab-sidebar-label { display: none; }
      .tab-btn { flex: 1; min-width: 130px; justify-content: center; }
      .tab-btn.active::before { display: none; }
      .info-grid.cols-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
      .info-grid.cols-3,
      .info-grid.cols-2 { grid-template-columns: 1fr; }
      .panel-body { padding: 20px 16px; }
      .panel-header { padding: 18px 20px; }
    }
  </style>
</head>
<body>

<button class="mobile-toggle" id="mobileToggle">
  <i data-lucide="menu"></i>
</button>

<!-- ═══════════════════════════════ SIDEBAR (UNCHANGED) ═══════════════════════════════ -->
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
      @if(auth('officialmember')->check() && auth('officialmember')->user()->profile_picture)
        <img src="{{ asset('images/profile_pictures/' . auth('officialmember')->user()->profile_picture) }}" alt="Profile" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
      @elseif(($gender ?? '') == 'Female')
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{ $fist_name ?? '' }} {{ $last_name ?? '' }}</div>
      <div style="margin-top: 5px; display: inline-flex; align-items: center; gap: 5px; padding: 4px 8px; border-radius: 6px; background: rgba(255, 255, 255, 0.1); font-size: 11px; font-weight: 600; color: #d1fae5; border: 1px solid rgba(255, 255, 255, 0.15); letter-spacing: 0.03em;">
        <i data-lucide="id-card" style="width: 12px; height: 12px; opacity: 0.9;"></i> {{$member_id ?? ''}}
      </div>
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
    <a href="{{ route('Member.Check.Shared.Capital') }}" class="nav-item">
      <i data-lucide="piggy-bank"></i> Check Shared Capital
    </a>
    <a href="{{ route('Member.Notifications') }}" class="nav-item">
      <i data-lucide="bell"></i> Notification
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

<!-- ═══════════════════════════════ MAIN ═══════════════════════════════ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-left">
      <h1>Account Settings</h1>
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <i data-lucide="house" style="width:11px;height:11px;"></i>
        <a href="{{ route('Member.Landing') }}">Home</a>
        <span class="sep"><i data-lucide="chevron-right" style="width:11px;height:11px;"></i></span>
        <span class="current">Account Settings</span>
      </nav>
    </div>
    <div class="topbar-badge">
      <i data-lucide="shield-check"></i>
      Member Account
    </div>
  </header>

  <!-- Page Body -->
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

    <!-- Two-column layout: vertical tab nav + content -->
    <div class="settings-layout">

      <!-- Vertical Tab Sidebar -->
      <div class="tab-sidebar">
        <div class="tab-sidebar-label">Settings</div>
        <button class="tab-btn active" onclick="showTab('basic')" id="tab-basic">
          <i data-lucide="user"></i> Basic Info
        </button>
        <button class="tab-btn" onclick="showTab('contact')" id="tab-contact">
          <i data-lucide="phone"></i> Contact
        </button>
        <button class="tab-btn" onclick="showTab('address')" id="tab-address">
          <i data-lucide="map-pin"></i> Address
        </button>
        <button class="tab-btn" onclick="showTab('password')" id="tab-password">
          <i data-lucide="lock"></i> Password
        </button>
      </div>

      <!-- Content Panel -->
      <div class="settings-content">

        <!-- ── Basic Information ── -->
        <div class="tab-panel active" id="panel-basic">
          <div class="panel-header">
            <div class="panel-header-icon"><i data-lucide="user"></i></div>
            <div>
              <h2>Basic Information</h2>
              <p>Your registered personal details</p>
            </div>
          </div>
          <div class="panel-body">

            <!-- Profile Picture Upload -->
            <form method="POST" action="{{ route('Member.AccountSettings.UpdateProfilePicture') }}" enctype="multipart/form-data">
              @csrf
              <div class="avatar-upload-section">
                <div class="big-avatar {{ ($gender ?? '') == 'Female' ? 'female' : 'male' }}">
                  @if(auth('officialmember')->check() && auth('officialmember')->user()->profile_picture)
                    <img src="{{ asset('images/profile_pictures/' . auth('officialmember')->user()->profile_picture) }}" alt="Profile" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                  @elseif(($gender ?? '') == 'Female')
                    <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:32px;height:32px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                  @else
                    <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:32px;height:32px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                  @endif
                </div>
                <div style="flex:1;">
                  <span class="upload-label">Profile Photo</span>
                  <div class="file-input-row">
                    <input type="file" name="profile_picture" accept="image/*" required>
                    <button type="submit" class="upload-btn">
                      <i data-lucide="upload"></i> Upload
                    </button>
                  </div>
                  <p style="font-size:11px; color:var(--text-dim); margin-top:6px;">JPG, PNG or GIF · Max 2MB</p>
                </div>
              </div>
            </form>

            <div class="section-divider"></div>

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
              To update your basic information, please contact the admin.
            </div>
          </div>
        </div>

        <!-- ── Contact Information ── -->
        <div class="tab-panel" id="panel-contact">
          <div class="panel-header">
            <div class="panel-header-icon"><i data-lucide="phone"></i></div>
            <div>
              <h2>Contact Information</h2>
              <p>Your registered email and phone number</p>
            </div>
          </div>
          <div class="panel-body">
            <div style="display:flex; flex-direction:column; gap:12px;">
              <div class="contact-card">
                <div class="contact-card-icon"><i data-lucide="mail"></i></div>
                <div>
                  <div class="contact-card-label">Email Address</div>
                  <div class="contact-card-value">{{ $user->email ?? 'N/A' }}</div>
                </div>
              </div>
              <div class="contact-card">
                <div class="contact-card-icon"><i data-lucide="smartphone"></i></div>
                <div>
                  <div class="contact-card-label">Contact Number</div>
                  <div class="contact-card-value">{{ $user->contact_number ?? 'N/A' }}</div>
                </div>
              </div>
            </div>
            <div class="info-notice">
              <i data-lucide="info"></i>
              To update your contact information, please contact the admin.
            </div>
          </div>
        </div>

        <!-- ── Address ── -->
        <div class="tab-panel" id="panel-address">
          <div class="panel-header">
            <div class="panel-header-icon"><i data-lucide="map-pin"></i></div>
            <div>
              <h2>Address</h2>
              <p>Your registered residential address</p>
            </div>
          </div>
          <div class="panel-body">
            <div class="info-grid cols-1" style="margin-bottom:18px;">
              <div class="info-field">
                <label>Street Address</label>
                <div class="info-value">{{ $user->street_address ?? 'N/A' }}</div>
              </div>
            </div>
            <div class="info-grid cols-2" style="margin-bottom:18px;">
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
              To update your address, please contact the admin.
            </div>
          </div>
        </div>

        <!-- ── Password ── -->
        <div class="tab-panel" id="panel-password">
          <div class="panel-header">
            <div class="panel-header-icon"><i data-lucide="lock"></i></div>
            <div>
              <h2>Change Password</h2>
              <p>Update your account password</p>
            </div>
          </div>
          <div class="panel-body">
            <form action="{{ route('Member.AccountSettings.UpdatePassword') }}" method="POST" class="pw-form">
              @csrf
              @method('PUT')

              <div class="form-group">
                <label>Current Password <span>*</span></label>
                <div class="input-wrap">
                  <input type="password" id="current_password" name="current_password" required class="form-input" placeholder="Enter current password">
                  <button type="button" class="toggle-pw" onclick="togglePw('current_password', this)">
                    <i data-lucide="eye"></i>
                  </button>
                </div>
                @error('current_password')
                  <div class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>New Password <span>*</span></label>
                <div class="input-wrap">
                  <input type="password" id="new_password" name="new_password" required minlength="8" class="form-input" placeholder="Min. 8 characters" oninput="checkStrength(this.value)">
                  <button type="button" class="toggle-pw" onclick="togglePw('new_password', this)">
                    <i data-lucide="eye"></i>
                  </button>
                </div>
                <div class="strength-bar-wrap" id="strength-bar">
                  <div class="strength-seg" id="s1"></div>
                  <div class="strength-seg" id="s2"></div>
                  <div class="strength-seg" id="s3"></div>
                  <div class="strength-seg" id="s4"></div>
                </div>
                <div class="strength-label" id="strength-label"></div>
                @error('new_password')
                  <div class="form-error"><i data-lucide="alert-circle"></i> {{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Confirm New Password <span>*</span></label>
                <div class="input-wrap">
                  <input type="password" id="new_password_confirmation" name="new_password_confirmation" required class="form-input" placeholder="Re-enter new password">
                  <button type="button" class="toggle-pw" onclick="togglePw('new_password_confirmation', this)">
                    <i data-lucide="eye"></i>
                  </button>
                </div>
              </div>

              <button type="submit" class="submit-btn">
                <i data-lucide="lock-keyhole"></i> Update Password
              </button>
            </form>
          </div>
        </div>

      </div><!-- /settings-content -->
    </div><!-- /settings-layout -->

  </div><!-- /page-body -->
</div><!-- /main -->

<!-- Logout Modal -->
<div class="modal-overlay" id="logout-modal">
  <div class="modal">
    <div class="modal-icon red"><i data-lucide="log-out"></i></div>
    <h3>Confirm Logout</h3>
    <p>Are you sure you want to log out? You'll need to sign in again to access your account.</p>
    <div class="modal-btn-row">
      <button class="modal-btn cancel" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{ route('Landing.Page') }}" class="modal-btn danger"
        style="text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</div>

<div id="password-errors" data-has-errors="{{ $errors->has('current_password') || $errors->has('new_password') ? '1' : '' }}" style="display:none;"></div>
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

  // Vertical tabs
  function showTab(name) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    document.getElementById('panel-' + name).classList.add('active');
    lucide.createIcons();
  }

  // Password visibility toggle
  function togglePw(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.querySelector('i[data-lucide]').setAttribute('data-lucide', isHidden ? 'eye-off' : 'eye');
    lucide.createIcons();
  }

  // Password strength meter
  function checkStrength(val) {
    const segs = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];
    const label = document.getElementById('strength-label');
    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const classes = ['filled-weak','filled-medium','filled-strong'];
    const labels  = ['','Weak','Fair','Good','Strong'];
    const colors  = ['','#ef4444','#f59e0b','#22c55e','#16a34a'];
    const cls = score <= 1 ? 'filled-weak' : score === 2 ? 'filled-medium' : 'filled-strong';

    segs.forEach((s, i) => {
      s.className = 'strength-seg';
      if (i < score) s.classList.add(cls);
    });
    label.textContent = val.length ? labels[score] : '';
    label.style.color = colors[score];
  }

  // Auto-open password tab on validation errors
  if (document.getElementById('password-errors')?.dataset.hasErrors === '1') {
    showTab('password');
  }
</script>
</body>
</html>