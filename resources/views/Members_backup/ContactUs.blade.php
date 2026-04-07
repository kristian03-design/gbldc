<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | GBLDC</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <!-- ✅ Matches FAQ: Playfair Display + DM Sans only (Syne removed) -->
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

      --accent:    #059669;
      --accent-lt: #ecfdf5;
      --glass:     rgba(255,255,255,0.72);
      --glass-border: rgba(255,255,255,0.55);
      --shadow-sm: 0 1px 3px rgba(15,28,20,0.06), 0 1px 2px rgba(15,28,20,0.04);
      --shadow-md: 0 4px 16px rgba(15,28,20,0.08), 0 2px 6px rgba(15,28,20,0.05);
      --shadow-lg: 0 20px 48px rgba(15,28,20,0.12), 0 8px 20px rgba(15,28,20,0.07);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #f0f7f3;
      color: var(--ink);
      min-height: 100vh;
      display: flex;
    }

    /* ═══════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════ */
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
    /* ✅ Matches FAQ: Playfair Display for logo text */
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

    .mobile-toggle {
      display: none; position: fixed; top: 14px; left: 14px; z-index: 200;
      width: 38px; height: 38px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer; align-items: center; justify-content: center;
    }
    .mobile-toggle i[data-lucide] { width: 18px; height: 18px; }

    /* ═══════════════════════════════════════
       MAIN LAYOUT
    ═══════════════════════════════════════ */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ═══════════════════════════════════════
       TOPBAR — ✅ Playfair Display (matches FAQ)
    ═══════════════════════════════════════ */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky; top: 0; z-index: 50;
      box-shadow: 0 1px 0 #e5e7eb, 0 2px 8px rgba(15,28,20,0.04);
    }
    .topbar-left {}
    /* ✅ Matches FAQ topbar: Playfair Display, font-size 22px, weight 700 */
    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--forest);
      line-height: 1.2;
    }
    .breadcrumb {
      display: flex; align-items: center; gap: 5px;
      font-size: 12px; color: var(--muted); margin-top: 3px;
    }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; line-height: 1; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    .topbar-badge {
      display: flex;
      align-items: center;
      gap: 7px;
      background: var(--accent-lt);
      border: 1px solid #a7f3d0;
      border-radius: 50px;
      padding: 7px 14px;
      font-size: 12px;
      font-weight: 600;
      color: var(--accent);
    }
    .topbar-badge i[data-lucide] { width: 13px; height: 13px; }
    .topbar-badge .dot {
      width: 7px; height: 7px; border-radius: 50%;
      background: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,0.2);
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0%, 100% { box-shadow: 0 0 0 3px rgba(34,197,94,0.2); }
      50%       { box-shadow: 0 0 0 5px rgba(34,197,94,0.1); }
    }

    /* ═══════════════════════════════════════
       PAGE BODY
    ═══════════════════════════════════════ */
    .page-body {
      padding: 28px 32px 48px;
      flex: 1;
      background: #f0f7f3;
      background-image:
        radial-gradient(circle at 10% 20%, rgba(34,197,94,0.05) 0%, transparent 50%),
        radial-gradient(circle at 90% 80%, rgba(13,74,47,0.04) 0%, transparent 50%);
    }

    /* ═══════════════════════════════════════
       SUCCESS ALERT
    ═══════════════════════════════════════ */
    .alert-success {
      display: flex; align-items: center; gap: 12px;
      background: #f0fdf4;
      border: 1px solid #86efac;
      border-left: 4px solid var(--emerald);
      border-radius: 12px;
      padding: 14px 18px;
      margin-bottom: 28px;
      font-size: 13.5px;
      font-weight: 500;
      color: #166534;
      animation: slideDown 0.4s ease;
    }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-8px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .alert-success i[data-lucide] { width: 18px; height: 18px; flex-shrink: 0; color: var(--emerald); }

    /* ═══════════════════════════════════════
       HERO STRIP — ✅ Playfair Display for title
    ═══════════════════════════════════════ */
    .hero-strip {
      background: linear-gradient(135deg, var(--forest) 0%, #0f6035 60%, #1a8048 100%);
      border-radius: 16px;
      padding: 28px 32px;
      margin-bottom: 28px;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
    }
    .hero-strip::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 80% 50%, rgba(34,197,94,0.15) 0%, transparent 60%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2322c55e' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='8'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-strip::after {
      content: '';
      position: absolute;
      right: -40px; top: -40px;
      width: 200px; height: 200px;
      border-radius: 50%;
      border: 40px solid rgba(34,197,94,0.08);
    }
    .hero-text { position: relative; z-index: 1; }
    .hero-overline {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--emerald);
      margin-bottom: 8px;
    }
    /* ✅ Matches FAQ page-header h2: Playfair Display, 22px, weight 700 */
    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      font-weight: 700;
      color: #fff;
      line-height: 1.25;
      margin-bottom: 10px;
    }
    .hero-desc {
      font-size: 13px;
      color: rgba(255,255,255,0.72);
      max-width: 380px;
      line-height: 1.6;
    }
    .hero-graphic {
      position: relative; z-index: 1;
      flex-shrink: 0;
      display: flex;
      gap: 12px;
    }
    .hero-stat {
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: 14px;
      padding: 16px 20px;
      text-align: center;
      backdrop-filter: blur(10px);
      min-width: 90px;
    }
    /* ✅ Matches FAQ stat block: Playfair Display, bold */
    .hero-stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      font-weight: 700;
      color: #fff;
      line-height: 1;
      margin-bottom: 4px;
    }
    .hero-stat-label {
      font-size: 10.5px;
      color: rgba(255,255,255,0.5);
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    /* ═══════════════════════════════════════
       GRID
    ═══════════════════════════════════════ */
    .contact-grid {
      display: grid;
      grid-template-columns: 360px 1fr;
      gap: 24px;
      align-items: start;
    }

    /* ═══════════════════════════════════════
       INFO PANEL
    ═══════════════════════════════════════ */
    .info-panel {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .info-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      transition: box-shadow 0.2s, transform 0.2s;
    }
    .info-card:hover {
      box-shadow: var(--shadow-md);
      transform: translateY(-1px);
    }

    .info-card-header {
      padding: 16px 20px 12px;
      border-bottom: 1px solid #f3f4f6;
      display: flex;
      align-items: center;
      gap: 10px;
      background: #f9fafb;
    }
    .info-card-icon {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center;
    }
    .info-card-icon i[data-lucide] { width: 15px; height: 15px; color: #ffffff; }
    .info-card-title {
      font-size: 13px;
      font-weight: 700;
      color: var(--ink);
    }

    .info-card-body { padding: 16px 20px 20px; }

    .contact-item {
      display: flex; align-items: flex-start; gap: 13px;
      padding: 12px 0;
      border-bottom: 1px solid #f9fafb;
    }
    .contact-item:last-child { border-bottom: none; padding-bottom: 0; }
    .ci-icon {
      width: 36px; height: 36px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--forest), var(--forest-mid));
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(13,74,47,0.2);
      color: #ffffff;
    }
    .ci-icon i[data-lucide], .ci-icon svg { width: 15px; height: 15px; color: #ffffff; }
    .ci-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; color: var(--muted); margin-bottom: 3px; }
    .ci-value { font-size: 13px; color: var(--ink); line-height: 1.55; font-weight: 500; }

    .hours-grid {
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 6px 16px;
    }
    .hours-day { font-size: 12.5px; color: var(--muted); }
    .hours-time { font-size: 12.5px; color: var(--ink); font-weight: 600; text-align: right; }
    .hours-closed { color: var(--rose); }

    .social-row { display: flex; gap: 8px; }
    .social-btn {
      width: 38px; height: 38px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      text-decoration: none; color: #fff;
      transition: opacity .2s, transform .15s, box-shadow .2s;
      box-shadow: 0 2px 6px rgba(0,0,0,0.12);
    }
    .social-btn:hover { opacity: .9; transform: translateY(-2px); box-shadow: 0 5px 14px rgba(0,0,0,0.18); }
    .social-btn.fb { background: #1877f2; }
    .social-btn.tw { background: #0ea5e9; }
    .social-btn.ig { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
    .social-btn.vi { background: #665cac; }

    /* ═══════════════════════════════════════
       FORM PANEL — ✅ Playfair Display for main heading
    ═══════════════════════════════════════ */
    .form-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: var(--shadow-md);
    }

    .form-card-header {
      background: linear-gradient(135deg, #f8fffe 0%, #f0fdf4 100%);
      padding: 20px 28px 18px;
      border-bottom: 1px solid #e6f7ee;
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
    }
    /* ✅ Matches FAQ page-header h2: Playfair Display, serif */
    .fch-title {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--forest);
      margin-bottom: 4px;
    }
    .fch-desc { font-size: 12.5px; color: var(--muted); }
    .fch-icon {
      width: 44px; height: 44px;
      background: linear-gradient(135deg, var(--forest), var(--forest-mid));
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(13,74,47,0.25);
      color: #ffffff;
    }
    .fch-icon i[data-lucide], .fch-icon svg { width: 20px; height: 20px; color: #ffffff; }

    .form-card-body { padding: 28px; }

    /* sender preview row */
    .sender-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      margin-bottom: 22px;
      padding: 16px;
      background: #f8fffe;
      border: 1px solid #d1fae5;
      border-radius: 12px;
    }
    .sender-field {}
    .sender-field-label {
      font-size: 10.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: var(--muted);
      margin-bottom: 5px;
      display: flex; align-items: center; gap: 5px;
    }
    .sender-field-label i[data-lucide] { width: 11px; height: 11px; color: var(--emerald); }
    .sender-field-value {
      font-size: 13px;
      font-weight: 600;
      color: var(--ink);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .form-group { margin-bottom: 18px; }
    .form-group label {
      display: block;
      font-size: 12px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 7px;
    }
    .form-group label .req { color: var(--rose); margin-left: 2px; }

    .form-input, .form-select, .form-textarea {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid #e5e7eb;
      border-radius: 11px;
      font-size: 13.5px;
      font-family: 'DM Sans', sans-serif;
      color: var(--ink);
      outline: none;
      background: #fafafa;
      transition: border-color .2s, box-shadow .2s, background .2s;
      appearance: none;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus {
      border-color: var(--forest);
      background: var(--white);
      box-shadow: 0 0 0 3px rgba(13,74,47,0.08);
    }
    .form-input.readonly, .form-input[readonly] {
      background: #f3f4f6;
      color: var(--muted);
      cursor: default;
      border-color: #e5e7eb;
    }
    .form-textarea {
      resize: vertical;
      min-height: 150px;
      line-height: 1.6;
    }
    .form-error { font-size: 11.5px; color: var(--rose); margin-top: 5px; display: flex; align-items: center; gap: 4px; }

    /* select wrapper */
    .select-wrap { position: relative; }
    .select-wrap::after {
      content: '';
      position: absolute;
      right: 14px; top: 50%;
      transform: translateY(-50%);
      width: 0; height: 0;
      border-left: 4px solid transparent;
      border-right: 4px solid transparent;
      border-top: 5px solid var(--muted);
      pointer-events: none;
    }
    .form-select { padding-right: 36px; cursor: pointer; }

    /* char counter */
    .textarea-footer {
      display: flex; justify-content: space-between; align-items: center;
      margin-top: 6px;
    }
    .char-count { font-size: 11px; color: #9ca3af; }

    /* subject chips */
    .subject-chips { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 18px; }
    .chip {
      padding: 6px 13px;
      border-radius: 50px;
      border: 1.5px solid #e5e7eb;
      background: #fafafa;
      font-size: 12px;
      font-weight: 600;
      color: var(--muted);
      cursor: pointer;
      transition: all .2s;
      user-select: none;
    }
    .chip:hover { border-color: var(--forest); color: var(--forest); background: #f0fdf4; }
    .chip.selected { background: var(--forest); border-color: var(--forest); color: #fff; }

    .hidden-select { display: none; }

    /* submit */
    .submit-row { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #f3f4f6; }
    .submit-note { font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 6px; }
    .submit-note i[data-lucide] { width: 13px; height: 13px; color: var(--emerald); }

    .submit-btn {
      padding: 12px 28px;
      background: linear-gradient(135deg, var(--forest), var(--forest-mid));
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      display: flex; align-items: center; gap: 8px;
      transition: transform .15s, box-shadow .2s;
      box-shadow: 0 4px 14px rgba(13,74,47,0.3);
      white-space: nowrap;
    }
    .submit-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(13,74,47,0.38); }
    .submit-btn:active { transform: scale(.98); }
    .submit-btn i[data-lucide] { width: 15px; height: 15px; }

    /* ═══════════════════════════════════════
       LOGOUT MODAL
    ═══════════════════════════════════════ */
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

    /* ═══════════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════════ */
    @media (max-width: 1024px) {
      .sidebar { transform: translateX(-260px); }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0; }
      .mobile-toggle { display: flex; }
      .page-body { padding: 20px 18px 40px; }
      .topbar { padding: 14px 18px; }
      .topbar-badge { display: none; }
      .contact-grid { grid-template-columns: 1fr; }
      .hero-strip { padding: 24px 24px; }
      .hero-graphic { display: none; }
      .form-card-body { padding: 20px; }
      .sender-row { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
      .hero-title { font-size: 20px; }
      .submit-row { flex-direction: column-reverse; align-items: stretch; }
      .submit-btn { justify-content: center; }
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
      @if(auth('officialmember')->check() && auth('officialmember')->user()->profile_picture)
        <img src="{{ asset('images/profile_pictures/' . auth('officialmember')->user()->profile_picture) }}" alt="Profile" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
      @elseif(isset($gender) && strtolower($gender) == 'female' || (isset($AutoComplete->gender) && strtolower($AutoComplete->gender) == 'female') || (isset($user) && strtolower($user->gender ?? '') == 'female'))
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

  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-left">
      <div class="topbar-title">
        <h1>Contact Us</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <i data-lucide="house" style="width:12px;height:12px;"></i>
          <a href="{{route('Member.Landing')}}">Home</a>
          <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
          <span class="current">Contact Us</span>
        </nav>
      </div>
    </div>
    <div class="topbar-badge">
      <span class="dot"></span>
      Support available Mon–Sat
    </div>
  </header>

  <!-- Page Body -->
  <div class="page-body">

    @if(session('success'))
    <div class="alert-success">
      <i data-lucide="circle-check-big"></i>
      {{ session('success') }}
    </div>
    @endif

    <!-- Hero Strip -->
    <div class="hero-strip">
      <div class="hero-text">
        <div class="hero-overline">Member Support</div>
        <div class="hero-title">We're here to help you.</div>
        <div class="hero-desc">Reach out to our team for any questions about your account, loans, or cooperative services. We respond within 24 hours.</div>
      </div>
      <div class="hero-graphic">
        <div class="hero-stat">
          <div class="hero-stat-num">&lt;24h</div>
          <div class="hero-stat-label">Response</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-num">5★</div>
          <div class="hero-stat-label">Support</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-num">6</div>
          <div class="hero-stat-label">Days/wk</div>
        </div>
      </div>
    </div>

    <!-- Main Grid -->
    <div class="contact-grid">

      <!-- Info Panel -->
      <div class="info-panel">

        <!-- Contact Details -->
        <div class="info-card">
          <div class="info-card-header">
            <div class="info-card-icon"><i data-lucide="info"></i></div>
            <div class="info-card-title">Contact Information</div>
          </div>
          <div class="info-card-body">
            <div class="contact-item">
              <div class="ci-icon"><i data-lucide="map-pin"></i></div>
              <div>
                <div class="ci-label">Office Address</div>
                <div class="ci-value">Greater Bulacan Livelihood Development Cooperative<br>Makinabang, Baliuag, Bulacan, Philippines</div>
              </div>
            </div>
            <div class="contact-item">
              <div class="ci-icon"><i data-lucide="phone"></i></div>
              <div>
                <div class="ci-label">Phone</div>
                <div class="ci-value">+63 (44) 123-4567<br>+63 912 345 6789</div>
              </div>
            </div>
            <div class="contact-item">
              <div class="ci-icon"><i data-lucide="mail"></i></div>
              <div>
                <div class="ci-label">Email</div>
                <div class="ci-value">gbldccoop@gmail.com</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Business Hours -->
        <div class="info-card">
          <div class="info-card-header">
            <div class="info-card-icon"><i data-lucide="clock"></i></div>
            <div class="info-card-title">Business Hours</div>
          </div>
          <div class="info-card-body">
            <div class="hours-grid">
              <div class="hours-day">Monday – Friday</div>
              <div class="hours-time">8:00 AM – 5:00 PM</div>
              <div class="hours-day">Saturday</div>
              <div class="hours-time">8:00 AM – 12:00 PM</div>
              <div class="hours-day">Sunday</div>
              <div class="hours-time hours-closed">Closed</div>
            </div>
          </div>
        </div>

        <!-- Social -->
        <div class="info-card">
          <div class="info-card-header">
            <div class="info-card-icon"><i data-lucide="share-2"></i></div>
            <div class="info-card-title">Follow Us</div>
          </div>
          <div class="info-card-body">
            <div class="social-row">
              <a href="#" class="social-btn fb" title="Facebook">
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
              </a>
            </div>
          </div>
        </div>

      </div><!-- /info-panel -->

      <!-- Form Card -->
      <div class="form-card">
        <div class="form-card-header">
          <div>
            <div class="fch-title">Send Us a Message</div>
            <div class="fch-desc">Fill out the form and our team will get back to you shortly.</div>
          </div>
          <div class="fch-icon"><i data-lucide="send"></i></div>
        </div>

        <div class="form-card-body">
          <form action="{{ route('Member.ContactUs.Submit') }}" method="POST">
            @csrf

            <!-- Sender Preview -->
            <div class="sender-row">
              <div class="sender-field">
                <div class="sender-field-label">
                  <i data-lucide="user"></i> Sending as
                </div>
                <div class="sender-field-value">{{ $fist_name }} {{ $middle_name }} {{ $last_name }}</div>
              </div>
              <div class="sender-field">
                <div class="sender-field-label">
                  <i data-lucide="at-sign"></i> Reply to
                </div>
                <div class="sender-field-value">{{ $email }}</div>
              </div>
            </div>

            <!-- Subject -->
            <div class="form-group">
              <label>Subject <span class="req">*</span></label>
              <div class="subject-chips" id="subjectChips">
                <div class="chip" data-value="General Inquiry">General Inquiry</div>
                <div class="chip" data-value="Loan Assistance">Loan Assistance</div>
                <div class="chip" data-value="Account Issue">Account Issue</div>
                <div class="chip" data-value="Suggestion">Suggestion</div>
                <div class="chip" data-value="Complaint">Complaint</div>
                <div class="chip" data-value="Other">Other</div>
              </div>
              <select name="subject" id="subjectSelect" class="hidden-select" required>
                <option value="">Select a subject</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Loan Assistance">Loan Assistance</option>
                <option value="Account Issue">Account Issue</option>
                <option value="Suggestion">Suggestion</option>
                <option value="Complaint">Complaint</option>
                <option value="Other">Other</option>
              </select>
              @error('subject')
                <div class="form-error"><i data-lucide="alert-circle" style="width:12px;height:12px;"></i>{{ $message }}</div>
              @enderror
            </div>

            <!-- Message -->
            <div class="form-group">
              <label>Message <span class="req">*</span></label>
              <textarea
                name="message"
                id="messageArea"
                class="form-textarea"
                required
                maxlength="1000"
                placeholder="Describe your concern in detail. Include any relevant account information or reference numbers to help us assist you faster."></textarea>
              <div class="textarea-footer">
                @error('message')
                  <div class="form-error" style="margin-top:0;"><i data-lucide="alert-circle" style="width:12px;height:12px;"></i>{{ $message }}</div>
                @else
                  <span></span>
                @enderror
                <span class="char-count" id="charCount">0 / 1000</span>
              </div>
            </div>

            <!-- Submit -->
            <div class="submit-row">
              <div class="submit-note">
                <i data-lucide="shield-check"></i>
                Your message is private and secure
              </div>
              <button type="submit" class="submit-btn">
                <i data-lucide="send"></i>
                Send Message
              </button>
            </div>

          </form>
        </div>
      </div><!-- /form-card -->

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

  // Subject chips
  const chips = document.querySelectorAll('.chip');
  const subjectSelect = document.getElementById('subjectSelect');
  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      chips.forEach(c => c.classList.remove('selected'));
      chip.classList.add('selected');
      subjectSelect.value = chip.dataset.value;
    });
  });

  // Char counter
  const messageArea = document.getElementById('messageArea');
  const charCount   = document.getElementById('charCount');
  messageArea.addEventListener('input', () => {
    const len = messageArea.value.length;
    charCount.textContent = `${len} / 1000`;
    charCount.style.color = len > 900 ? '#ef4444' : len > 700 ? '#f59e0b' : '#9ca3af';
  });
</script>
</body>
</html>
