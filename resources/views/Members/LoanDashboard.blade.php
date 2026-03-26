<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Dashboard | GBLDC</title>
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
      --amber:     #f59e0b;
      --sky:       #3b82f6;
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
      z-index: 100;
      transition: transform .3s ease;
    }

    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 22px 20px 18px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-profile {
      margin: 14px 12px;
      padding: 12px;
      background: rgba(255,255,255,.07);
      border-radius: 12px;
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
    .profile-avatar svg { width: 22px; height: 22px; }
    .profile-name { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.3; }
    .profile-email { font-size: 11px; opacity: .5; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; }

    .sidebar-nav { flex: 1; padding: 8px 12px; overflow-y: auto; }

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
    .nav-item.danger { color: rgba(248,113,113,.8); }
    .nav-item.danger:hover { background: rgba(239,68,68,.1); color: #fca5a5; }

    .sidebar-footer {
      padding: 14px 12px;
      border-top: 1px solid rgba(255,255,255,.1);
      font-size: 11px; opacity: .35; text-align: center;
    }

    /* ── Mobile toggle ── */
    .mobile-toggle {
      display: none;
      position: fixed; top: 14px; left: 14px;
      z-index: 200;
      width: 38px; height: 38px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer;
      align-items: center; justify-content: center;
    }
    .mobile-toggle i[data-lucide] { width: 18px; height: 18px; }

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
      position: sticky; top: 0; z-index: 50;
    }
    .topbar h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700; color: var(--forest);
    }
    .breadcrumb {
      display: flex; align-items: center; gap: 5px;
      font-size: 12px; color: var(--muted); margin-top: 3px;
    }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Welcome banner ── */
    .welcome-banner {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 24px 28px; color: #fff;
      margin-bottom: 24px; position: relative; overflow: hidden;
      display: flex; align-items: center; justify-content: space-between;
    }
    .welcome-banner::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .welcome-banner h2 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; margin-bottom: 4px;
    }
    .welcome-banner p { font-size: 13px; opacity: .75; }
    .welcome-actions { display: flex; gap: 10px; position: relative; z-index: 1; }

    .banner-btn {
      display: flex; align-items: center; gap: 7px;
      padding: 10px 16px; border-radius: 10px;
      font-size: 13px; font-weight: 600;
      border: none; cursor: pointer; text-decoration: none;
      transition: background .2s, transform .1s;
    }
    .banner-btn:active { transform: scale(.97); }
    .banner-btn i[data-lucide] { width: 15px; height: 15px; }
    .banner-btn.primary { background: #fff; color: var(--forest); }
    .banner-btn.primary:hover { background: #f0fdf4; }
    .banner-btn.secondary { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.3); }
    .banner-btn.secondary:hover { background: rgba(255,255,255,.25); }

    /* ── Grid layouts ── */
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .grid-3 { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 20px; }

    /* ── Cards ── */
    .card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .card-header {
      padding: 18px 20px 14px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .card-header h2 {
      font-size: 15px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .card-header h2 i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }

    .card-body { padding: 20px; }

    /* ── Loan detail grid ── */
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .detail-item label {
      display: block; font-size: 11px; text-transform: uppercase;
      letter-spacing: .06em; color: var(--muted); font-weight: 600; margin-bottom: 3px;
    }
    .detail-item .value {
      font-size: 15px; font-weight: 700; color: var(--ink);
    }

    /* ── Repayment status cards ── */
    .repay-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px; }
    .repay-card {
      padding: 14px; border-radius: 12px;
      border: 1px solid var(--border);
      background: #f9fafb;
      transition: border-color .2s;
    }
    .repay-card.paid   { background: #f0fdf4; border-color: #86efac; }
    .repay-card.overdue { background: #fef2f2; border-color: #fca5a5; }
    .repay-card .repay-label {
      font-size: 11px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .06em; color: var(--muted); margin-bottom: 4px;
    }
    .repay-card .repay-value { font-size: 13px; font-weight: 600; color: var(--ink); }
    .repay-card .repay-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }

    .repay-actions { display: flex; gap: 10px; }

    .btn {
      display: flex; align-items: center; gap: 7px;
      padding: 10px 16px; border-radius: 10px;
      font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      text-decoration: none;
      font-family: 'DM Sans', sans-serif;
    }
    .btn:active { transform: scale(.97); }
    .btn i[data-lucide] { width: 14px; height: 14px; }
    .btn.green  { background: var(--forest); color: #fff; }
    .btn.green:hover  { background: var(--forest-mid); }
    .btn.outline { background: var(--white); color: var(--forest); border: 1.5px solid var(--forest); }
    .btn.outline:hover { background: var(--sage); }

    /* ── Loan history mini table ── */
    .mini-table { width: 100%; border-collapse: collapse; font-size: 12px; }
    .mini-table thead tr { background: #f9fafb; }
    .mini-table th {
      padding: 8px 12px; text-align: left;
      font-size: 10px; letter-spacing: .06em;
      text-transform: uppercase; color: var(--muted); font-weight: 600;
      border-bottom: 1px solid var(--border);
    }
    .mini-table tbody tr { border-top: 1px solid var(--border); transition: background .15s; }
    .mini-table tbody tr:hover { background: #f9fafb; }
    .mini-table td { padding: 9px 12px; }

    .status-pill {
      display: inline-block; font-size: 10px; font-weight: 700;
      padding: 2px 8px; border-radius: 20px; text-transform: uppercase;
    }
    .status-pill.active   { background: #dbeafe; color: #1e40af; }
    .status-pill.paid     { background: #dcfce7; color: #166534; }
    .status-pill.overdue  { background: #fee2e2; color: #991b1b; }
    .status-pill.pending  { background: #fef3c7; color: #92400e; }

    .view-link {
      display: block; text-align: center;
      font-size: 12px; font-weight: 600; color: var(--forest-mid);
      text-decoration: none; padding: 12px;
      border-top: 1px solid var(--border);
      transition: background .15s;
    }
    .view-link:hover { background: var(--sage); }

    /* ── Payment history table ── */
    .pay-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .pay-table thead tr { background: #f9fafb; }
    .pay-table th {
      padding: 10px 16px; text-align: left;
      font-size: 11px; letter-spacing: .06em;
      text-transform: uppercase; color: var(--muted); font-weight: 600;
      border-bottom: 1px solid var(--border);
    }
    .pay-table tbody tr { border-top: 1px solid var(--border); transition: background .15s; }
    .pay-table tbody tr:hover { background: #f9fafb; }
    .pay-table td { padding: 11px 16px; }
    .pay-table td.muted { color: var(--muted); }
    .ref-mono { font-family: monospace; font-size: 11px; color: var(--muted); }

    /* ── Modals ── */
    .modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.45); z-index: 200;
      align-items: center; justify-content: center; padding: 16px;
    }
    .modal-overlay.open { display: flex; }

    .modal {
      background: var(--white); border-radius: 16px;
      padding: 28px; width: 100%; max-width: 440px;
      animation: popIn .25s ease;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(10px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }
    .modal-icon {
      width: 48px; height: 48px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 16px;
    }
    .modal-icon.green  { background: #dcfce7; color: #16a34a; }
    .modal-icon.red    { background: #fee2e2; color: #dc2626; }
    .modal-icon i[data-lucide] { width: 22px; height: 22px; }

    .modal h3 { font-size: 18px; font-weight: 700; text-align: center; margin-bottom: 6px; }
    .modal p  { font-size: 13px; color: var(--muted); text-align: center; margin-bottom: 22px; }

    .modal-field { margin-bottom: 16px; }
    .modal-field label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; }
    .modal-field input,
    .modal-field select {
      width: 100%; padding: 10px 14px;
      border: 1px solid var(--border); border-radius: 10px;
      font-size: 14px; font-family: 'DM Sans', sans-serif;
      outline: none; transition: border-color .2s;
    }
    .modal-field input:focus,
    .modal-field select:focus { border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.1); }

    .modal-btn-row { display: flex; gap: 10px; }
    .modal-btn {
      flex: 1; padding: 11px; border-radius: 10px;
      font-size: 14px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s; font-family: 'DM Sans', sans-serif;
    }
    .modal-btn.cancel   { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover { background: #e5e7eb; }
    .modal-btn.confirm  { background: var(--forest); color: #fff; }
    .modal-btn.confirm:hover { background: var(--forest-mid); }
    .modal-btn.danger   { background: var(--rose); color: #fff; }
    .modal-btn.danger:hover { background: #dc2626; }

    .modal-divider { border: none; border-top: 1px solid var(--border); margin: 16px 0; }

    .schedule-choices { display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px; }
    .schedule-choice {
      display: flex; align-items: center; gap: 12px;
      padding: 14px 16px; border-radius: 12px;
      border: 1px solid var(--border);
      text-decoration: none; color: var(--ink);
      font-weight: 600; font-size: 14px;
      transition: background .2s, border-color .2s;
    }
    .schedule-choice:hover { border-color: var(--emerald); background: var(--sage); }
    .schedule-choice .choice-icon {
      width: 36px; height: 36px; border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .schedule-choice .choice-icon i[data-lucide] { width: 18px; height: 18px; }
    .schedule-choice .choice-icon.green { background: #dcfce7; color: #16a34a; }
    .schedule-choice .choice-icon.sky   { background: #dbeafe; color: #2563eb; }

    /* ── PayMongo modal specific ── */
    .paymongo-modal {
      background: var(--white);
      border-radius: 20px;
      width: 100%; max-width: 460px;
      overflow: hidden;
      animation: popIn .3s cubic-bezier(.22,.68,0,1.2) both;
      max-height: 90vh;
      overflow-y: auto;
    }

    .paymongo-banner {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      padding: 28px 28px 24px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .paymongo-banner::before {
      content: ''; position: absolute; top: -30px; right: -30px;
      width: 120px; height: 120px; border-radius: 50%;
      background: rgba(255,255,255,.06); pointer-events: none;
    }
    .paymongo-banner::after {
      content: ''; position: absolute; bottom: -35px; left: -15px;
      width: 90px; height: 90px; border-radius: 50%;
      background: rgba(255,255,255,.04); pointer-events: none;
    }

    .paymongo-icon-ring {
      width: 60px; height: 60px; border-radius: 50%;
      background: rgba(255,255,255,.15);
      border: 2px solid rgba(255,255,255,.25);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 14px;
      position: relative; z-index: 1;
    }
    .paymongo-icon-ring i[data-lucide] { width: 26px; height: 26px; color: #fff; }

    .paymongo-banner h3 {
      font-family: 'Playfair Display', serif;
      font-size: 20px; font-weight: 700; color: #fff;
      margin-bottom: 6px; position: relative; z-index: 1;
    }
    .paymongo-banner p {
      font-size: 13px; color: rgba(255,255,255,.75);
      position: relative; z-index: 1; line-height: 1.5;
    }

    .paymongo-body { padding: 24px 28px 28px; }

    .pm-field { margin-bottom: 16px; }
    .pm-field-label {
      display: flex; align-items: center; gap: 5px;
      font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .06em;
      color: var(--muted); margin-bottom: 7px;
    }
    .pm-field-label i[data-lucide] { width: 12px; height: 12px; }
    .pm-field-label .req { color: var(--rose); }

    .pm-select {
      width: 100%; padding: 11px 36px 11px 14px;
      border: 1px solid var(--border); border-radius: 11px;
      font-size: 14px; font-family: 'DM Sans', sans-serif;
      outline: none; transition: border-color .2s, box-shadow .2s;
      background: var(--white); color: var(--ink);
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      cursor: pointer;
    }
    .pm-select:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }

    .pm-amount-pill {
      background: var(--sage);
      border: 1px solid #86efac;
      border-radius: 12px;
      padding: 14px 18px;
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 22px;
    }
    .pm-amount-pill-left {
      display: flex; align-items: center; gap: 9px;
    }
    .pm-amount-icon {
      width: 34px; height: 34px; border-radius: 9px;
      background: rgba(13,74,47,.12);
      display: flex; align-items: center; justify-content: center;
    }
    .pm-amount-icon i[data-lucide] { width: 16px; height: 16px; color: var(--forest); }
    .pm-amount-label {
      font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .06em;
      color: var(--forest-mid);
    }
    .pm-amount-value {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700; color: var(--forest);
    }

    .pm-btn-row { display: flex; gap: 10px; }
    .pm-btn-cancel {
      flex: 1; padding: 12px; border-radius: 11px;
      background: #f3f4f6; color: var(--ink);
      font-size: 14px; font-weight: 600;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: background .2s;
    }
    .pm-btn-cancel:hover { background: #e5e7eb; }
    .pm-btn-proceed {
      flex: 2; padding: 12px; border-radius: 11px;
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 100%);
      color: #fff;
      font-size: 14px; font-weight: 700;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      transition: opacity .2s, transform .15s;
    }
    .pm-btn-proceed:hover { opacity: .9; transform: translateY(-1px); }
    .pm-btn-proceed:active { transform: scale(.97); }
    .pm-btn-proceed svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2;}

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      :root { --sidebar-w: 260px; }
      .sidebar { transform: translateX(-260px); }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0; }
      .mobile-toggle { display: flex; }
      .page-body { padding: 20px 18px; }
      .topbar { padding: 14px 18px; }
      .grid-3 { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
      .grid-2 { grid-template-columns: 1fr; }
      .detail-grid { grid-template-columns: 1fr; }
      .repay-grid { grid-template-columns: 1fr; }
      .welcome-actions { display: none; }
      .pm-btn-row { flex-direction: column; }
    }

    /* ── Toast animations ── */
    @keyframes slideInRight {
      from { transform: translateX(100%); opacity: 0; }
      to   { transform: translateX(0); opacity: 1; }
    }
    @keyframes fadeOut {
      from { opacity: 1; }
      to   { opacity: 0; }
    }
  </style>
</head>
<body>

<!-- Mobile toggle -->
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

  <!-- Profile -->
  <div class="sidebar-profile">
    <div class="profile-avatar {{ strtolower($gender) == 'female' ? 'female' : 'male' }}">
      @if(strtolower($gender) == 'female')
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{$fist_name}} {{$last_name}}</div>
      <div style="margin-top:5px;display:inline-flex;align-items:center;gap:5px;padding:4px 8px;border-radius:6px;background:rgba(255,255,255,.1);font-size:11px;font-weight:600;color:#d1fae5;border:1px solid rgba(255,255,255,.15);letter-spacing:.03em;">
        <i data-lucide="id-card" style="width:12px;height:12px;opacity:.9;"></i> {{$member_id}}
      </div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <a href="{{route('Member.Landing')}}" class="nav-item">
      <i data-lucide="home"></i> Home
    </a>
    <a href="#" class="nav-item active">
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
    <h1>Loan Dashboard</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <i data-lucide="house" style="width:12px;height:12px;"></i>
      <a href="{{route('Member.Landing')}}">Home</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <span class="current">Loan Dashboard</span>
    </nav>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Welcome banner -->
    <div class="welcome-banner">
      <div style="position:relative;z-index:1;">
        <h2>Hello, {{$fist_name}} {{$last_name}}! <i data-lucide="smile" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></i></h2>
        <p>Here's your loan status and payment overview.</p>
      </div>
    </div>

    <!-- Loan Details + Loan History -->
    <div class="grid-3">

      <!-- Loan Details -->
      <div class="card">
        <div class="card-header">
          <h2><i data-lucide="file-text"></i> Loan Details</h2>
        </div>
        <div class="card-body">
          <div class="detail-grid">
            <div class="detail-item">
              <label>Loan Number</label>
              <div class="value">{{$loanInfo->loan_number ?? '—'}}</div>
            </div>
            <div class="detail-item">
              <label>Approved Amount</label>
              <div class="value">₱{{number_format($loanInfo->loan_amount ?? 0, 2)}}</div>
            </div>
            <div class="detail-item">
              <label>Interest Rate</label>
              <div class="value">
                @if(!empty($loanInfo?->loan_number))
                  {{ (isset($loanInfo->interest_rate) && $loanInfo->interest_rate !== '' && $loanInfo->interest_rate !== null) ? number_format((float) $loanInfo->interest_rate, 1) . '%' : 'Not set' }}
                @else
                  —
                @endif
              </div>
            </div>
            <div class="detail-item">
              <label>Repayment Period</label>
              <div class="value">{{$loanInfo->loan_term ?? '—'}}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Loan History mini -->
      <div class="card">
        <div class="card-header">
          <h2><i data-lucide="history"></i> Loan History</h2>
        </div>
        <div style="overflow-x:auto;">
          <table class="mini-table">
            <thead><tr>
              <th>Loan ID</th><th>Amount</th><th>Balance</th><th>Status</th>
            </tr></thead>
            <tbody>
              @foreach ($loans as $loan)
              <tr>
                <td style="font-weight:600;">{{$loan->loan_number}}</td>
                <td>₱{{number_format($loan->loan_amount, 2)}}</td>
                <td>₱{{number_format($loan->loan_balance, 2)}}</td>
                <td>
                  @php $s = strtolower($loan->loan_status); @endphp
                  <span class="status-pill {{ str_contains($s,'active') ? 'active' : (str_contains($s,'paid') ? 'paid' : (str_contains($s,'overdue') ? 'overdue' : 'pending')) }}">
                    {{$loan->loan_status}}
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <a href="{{ route('Member.Loan.History') }}" class="view-link">
          View Full History <i data-lucide="arrow-right" style="width:12px;height:12px;display:inline-block;vertical-align:middle;margin-left:4px;"></i>
        </a>
      </div>
    </div>

    <!-- Repayment Status -->
    <div class="card" style="margin-bottom:20px;">
      <div class="card-header">
        <h2><i data-lucide="rotate-ccw"></i> Repayment Status</h2>
      </div>
      <div class="card-body">
        @php
          $lastLoanPayment = null;
          $lastSharedPayment = null;
          foreach ($PaymentHistory as $payment) {
            if ($payment->transaction_type == 'Loan Payment' && (!$lastLoanPayment || strtotime($payment->transaction_date) > strtotime($lastLoanPayment))) {
              $lastLoanPayment = $payment->transaction_date;
            } elseif ($payment->transaction_type == 'Shared Capital' && (!$lastSharedPayment || strtotime($payment->transaction_date) > strtotime($lastSharedPayment))) {
              $lastSharedPayment = $payment->transaction_date;
            }
          }

          $nextLoanDueDateStr = '—';
          if (isset($nextLoanSchedule) && $nextLoanSchedule) {
              $nextLoanDueDateStr = \Carbon\Carbon::parse($nextLoanSchedule->due_date)->format('M d, Y');
          } elseif ($loanInfo && isset($loanPaymentStartDate) && $loanInfo->frequency_of_payment) {
              $baseLoanDate = $lastLoanPayment ? $lastLoanPayment : $loanPaymentStartDate;
              $loanFreqStr = strtolower($loanInfo->frequency_of_payment);
              if ($baseLoanDate) {
                  $ld = \Carbon\Carbon::parse($baseLoanDate);
                  if (str_contains($loanFreqStr, 'monthly')) { $ld->addMonth(); }
                  elseif (str_contains($loanFreqStr, 'weekly')) { $ld->addWeek(); }
                  elseif (str_contains($loanFreqStr, 'yearly') || str_contains($loanFreqStr, 'annually')) { $ld->addYear(); }
                  $nextLoanDueDateStr = $ld->format('M d, Y');
              }
          }

          $nextSharedDueDateStr = '—';
          $isSharedCapitalFullyPaid = false;
          if ($sharedCapitalInfo && (float)$sharedCapitalInfo->shared_capital_amount <= 0) {
              $isSharedCapitalFullyPaid = true;
          } elseif ($sharedCapitalInfo && isset($sharedCapitalPaymentStartDate) && $sharedCapitalInfo->payment_frequency) {
              $baseSharedDate = $lastSharedPayment ? $lastSharedPayment : $sharedCapitalPaymentStartDate;
              $sharedFreqStr = strtolower($sharedCapitalInfo->payment_frequency);
              if ($baseSharedDate) {
                  $sd = \Carbon\Carbon::parse($baseSharedDate);
                  if (str_contains($sharedFreqStr, 'monthly')) { $sd->addMonth(); }
                  elseif (str_contains($sharedFreqStr, 'weekly')) { $sd->addWeek(); }
                  elseif (str_contains($sharedFreqStr, 'yearly') || str_contains($sharedFreqStr, 'annually')) { $sd->addYear(); }
                  $nextSharedDueDateStr = $sd->format('M d, Y');
              }
          }
        @endphp

        <div class="repay-grid">
          <div class="repay-card" id="loan-payment-div"
            data-frequency="{{$loanInfo->frequency_of_payment ?? ''}}"
            data-last-payment="{{ $lastLoanPayment }}"
            data-start-date="{{ $loanPaymentStartDate }}">
            <div class="repay-label">Loan Payment</div>
            <div class="repay-value">{{$loanInfo->frequency_of_payment ?? 'Not set'}}</div>
            @php
              $termMonths = null;
              if (!empty($loanInfo?->loan_term) && preg_match('/(\d+)/', (string) $loanInfo->loan_term, $m)) {
                $termMonths = (int) $m[1];
              }
              $computedMonthly = null;
              if (isset($nextLoanSchedule) && $nextLoanSchedule) {
                  $computedMonthly = (float) $nextLoanSchedule->monthly_payment - (float) $nextLoanSchedule->amount_paid;
              } elseif (isset($loanInfo?->monthly_payment) && $loanInfo->monthly_payment !== '' && $loanInfo->monthly_payment !== null) {
                $computedMonthly = (float) $loanInfo->monthly_payment;
              } elseif ($termMonths && isset($loanInfo?->due_amount) && is_numeric($loanInfo->due_amount)) {
                $computedMonthly = ((float) $loanInfo->due_amount) / $termMonths;
              }
            @endphp
            <div class="repay-sub">Monthly: ₱{{ $computedMonthly !== null ? number_format($computedMonthly, 2) : '—' }}</div>
            <div class="repay-sub" style="margin-top:4px;">Next Due: <strong>{{ $nextLoanDueDateStr }}</strong></div>
          </div>

          <div class="repay-card" id="shared-capital-div"
            data-frequency="{{$sharedCapitalInfo->payment_frequency ?? ''}}"
            data-last-payment="{{ $lastSharedPayment }}"
            data-start-date="{{ $sharedCapitalPaymentStartDate }}">
            <div class="repay-label">Shared Capital</div>
            @if(isset($isSharedCapitalFullyPaid) && $isSharedCapitalFullyPaid)
              <div class="repay-value" style="color:#16a34a;display:flex;align-items:center;gap:5px;">
                <i data-lucide="check-circle" style="width:14px;height:14px;"></i> Fully Paid
              </div>
              <div class="repay-sub">Due: ₱ 0.00</div>
              <div class="repay-sub" style="margin-top:4px;">Next Due: <strong>—</strong></div>
            @else
              <div class="repay-value">{{$sharedCapitalInfo->payment_frequency ?? 'Not set'}}</div>
              <div class="repay-sub">Due: ₱ {{$sharedCapitalInfo->payment_amount_per_schedule ?? '—'}}</div>
              <div class="repay-sub" style="margin-top:4px;">Next Due: <strong>{{ $nextSharedDueDateStr }}</strong></div>
            @endif
          </div>
        </div>

        <div class="repay-actions">
          <button class="btn green" id="makePaymentBtn2">
            <i data-lucide="credit-card"></i> Make a Payment
          </button>
          <button class="btn outline" onclick="openPaymentScheduleModal()">
            <i data-lucide="calendar"></i> Payment Schedule
          </button>
        </div>
      </div>
    </div>

    <!-- Payment History -->
    <div class="card">
      <div class="card-header">
        <h2><i data-lucide="receipt"></i> Payment History</h2>
      </div>
      <div style="overflow-x:auto;">
        <table class="pay-table">
          <thead><tr>
            <th>Type</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Status</th>
            <th>Date</th>
            <th>Reference #</th>
          </tr></thead>
          <tbody>
            @foreach ($PaymentHistory->take(5) as $payment)
            <tr>
              <td style="font-weight:600;">{{$payment->transaction_type}}</td>
              <td>₱{{number_format($payment->payment_amount, 2)}}</td>
              <td class="muted">{{$payment->payment_method}}</td>
              <td>
                @php $ps = strtolower($payment->payment_status); @endphp
                <span class="status-pill {{ str_contains($ps,'paid')||str_contains($ps,'success') ? 'paid' : (str_contains($ps,'pend') ? 'pending' : 'overdue') }}">
                  {{$payment->payment_status}}
                </span>
              </td>
              <td class="muted">{{ date('M d, Y', strtotime($payment->transaction_date)) }}</td>
              <td><span class="ref-mono">{{$payment->reference_number}}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <a href="{{ route('Full.Payment.History') }}" class="view-link">
        View Full History <i data-lucide="arrow-right" style="width:12px;height:12px;display:inline-block;vertical-align:middle;margin-left:4px;"></i>
      </a>
    </div>

  </div><!-- /page-body -->
</div><!-- /main -->


<!-- ═══════════════════════════════════════
     MODALS
════════════════════════════════════════ -->

<!-- ── PayMongo / Online Payment Modal ── -->
<div class="modal-overlay" id="qrCodeModal">
  <div class="paymongo-modal">

    <!-- Banner -->
    <div class="paymongo-banner">
      <div class="paymongo-icon-ring">
        <i data-lucide="smartphone"></i>
      </div>
      <h3>Secure Online Payment</h3>
      <p>Select the account you wish to settle. You will be redirected<br>to our secure payment gateway to complete your transaction.</p>
    </div>

    <!-- Body -->
    <div class="paymongo-body">
      <form action="{{ route('paymongo_gcash_initiate') }}" method="POST" id="paymongoForm">
        @csrf
        <input type="hidden" name="member_id"       value="{{ $member_id }}">
        <input type="hidden" name="first_name"       value="{{ $fist_name }}">
        <input type="hidden" name="last_name"        value="{{ $last_name }}">
        <input type="hidden" name="transaction_date" value="{{ date('Y-m-d') }}">
        <input type="hidden" name="success_url"      value="{{ route('paymongo_success') }}">
        <input type="hidden" name="failed_url"       value="{{ route('paymongo_failed') }}">

        <!-- Transaction Type -->
        <div class="pm-field">
          <div class="pm-field-label">
            <i data-lucide="tag"></i>
            Transaction Type <span class="req">*</span>
          </div>
          <select
            name="transaction_type"
            id="modal_transaction_type"
            class="pm-select"
            required
            onchange="toggleLoanNumber()"
          >
            <option value="" disabled selected>Select Type</option>
            <option value="Loan Payment">Loan Payment</option>
            <option value="Shared Capital">Shared Capital Payment</option>
          </select>
        </div>

        <!-- Loan Number (conditional) -->
        <div class="pm-field" id="modal_loan_number_field" style="display:none;">
          <div class="pm-field-label">
            <i data-lucide="hash"></i>
            Loan Number <span class="req">*</span>
          </div>
          <select
            name="loan_number"
            id="modal_loan_number"
            class="pm-select"
            onchange="toggleLoanNumber()"
          >
            <option value="">Select an active loan</option>
            @foreach($loans as $l)
              @php
                $amtDue = $l->monthly_payment ?? 0;
                if (isset($nextLoanSchedule) && $nextLoanSchedule && $nextLoanSchedule->loan_number === $l->loan_number) {
                  $amtDue = (float)$nextLoanSchedule->monthly_payment - (float)$nextLoanSchedule->amount_paid;
                } elseif (empty($amtDue)) {
                  if (!empty($l->loan_term) && preg_match('/(\d+)/', (string) $l->loan_term, $m)) {
                    $amtDue = ((float) $l->due_amount) / (int)$m[1];
                  }
                }
              @endphp
              <option value="{{ $l->loan_number }}" data-due="{{ $amtDue }}">
                {{ $l->loan_number }} — Bal: ₱{{ number_format($l->loan_balance, 2) }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Amount pill -->
        <div class="pm-amount-pill">
          <div class="pm-amount-pill-left">
            <div class="pm-amount-icon">
              <i data-lucide="banknote"></i>
            </div>
            <span class="pm-amount-label">Amount to Pay</span>
          </div>
          <span id="computed_amount_display" class="pm-amount-value">₱ 0.00</span>
          <input type="hidden" name="amount" id="modal_payment_amount_hidden" value="0">
        </div>

        <!-- Buttons -->
        <div class="pm-btn-row">
          <button type="button" class="pm-btn-cancel" id="closeQrModal">Cancel</button>
          <button type="submit" class="pm-btn-proceed" id="btnPaymongo">
          <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            Proceed
          </button>
        </div>

      </form>
    </div><!-- /paymongo-body -->
  </div>
</div>

<!-- ── Payment Schedule Modal ── -->
<div class="modal-overlay" id="paymentScheduleModal">
  <div class="modal">
    <div class="modal-icon green"><i data-lucide="calendar"></i></div>
    <h3>Payment Schedule</h3>
    <p>Choose which schedule you'd like to view.</p>
    <div class="schedule-choices">
      <a href="{{ route('Payment.Schedule', ['type' => 'loan']) }}" class="schedule-choice">
        <div class="choice-icon green"><i data-lucide="banknote"></i></div>
        <div>
          <div style="font-weight:700;">Loan Schedule</div>
          <div style="font-size:12px;color:var(--muted);font-weight:400;">View your loan repayment timeline</div>
        </div>
        <i data-lucide="chevron-right" style="width:16px;height:16px;color:var(--muted);margin-left:auto;"></i>
      </a>
      <a href="{{ route('Payment.Schedule', ['type' => 'shared_capital']) }}" class="schedule-choice">
        <div class="choice-icon sky"><i data-lucide="piggy-bank"></i></div>
        <div>
          <div style="font-weight:700;">Shared Capital Schedule</div>
          <div style="font-size:12px;color:var(--muted);font-weight:400;">View your capital contribution timeline</div>
        </div>
        <i data-lucide="chevron-right" style="width:16px;height:16px;color:var(--muted);margin-left:auto;"></i>
      </a>
    </div>
    <button class="modal-btn cancel" onclick="closePaymentScheduleModal()">Cancel</button>
  </div>
</div>

<!-- ── Logout Modal ── -->
<div class="modal-overlay" id="logout-modal">
  <div class="modal">
    <div class="modal-icon red"><i data-lucide="log-out"></i></div>
    <h3>Confirm Logout</h3>
    <p>Are you sure you want to logout? You'll need to sign in again to access your account.</p>
    <div class="modal-btn-row">
      <button class="modal-btn cancel" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{ route('Member.Logout') }}" class="modal-btn danger" style="text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</div>


<!-- ═══ Toast Notifications ═══ -->
<div id="toast-container" style="position:fixed;bottom:20px;right:20px;z-index:9999;display:flex;flex-direction:column;gap:10px;">
  @if(session('success') || session('Record-updated'))
  <div class="toast" style="background:#fff;border-left:4px solid #10b981;padding:16px 20px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.1);display:flex;align-items:flex-start;gap:12px;animation:slideInRight .3s ease forwards;">
    <i data-lucide="check-circle" style="color:#10b981;width:20px;height:20px;flex-shrink:0;margin-top:2px;"></i>
    <div>
      <h4 style="margin:0;font-size:14px;font-weight:700;color:#111827;">Success</h4>
      <p style="margin:4px 0 0;font-size:13px;color:#4b5563;">{{ session('success') ?? session('Record-updated') }}</p>
    </div>
    <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;margin-left:auto;">
      <i data-lucide="x" style="width:16px;height:16px;"></i>
    </button>
  </div>
  @endif

  @if(session('error'))
  <div class="toast" style="background:#fff;border-left:4px solid #ef4444;padding:16px 20px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.1);display:flex;align-items:flex-start;gap:12px;animation:slideInRight .3s ease forwards;">
    <i data-lucide="alert-circle" style="color:#ef4444;width:20px;height:20px;flex-shrink:0;margin-top:2px;"></i>
    <div>
      <h4 style="margin:0;font-size:14px;font-weight:700;color:#111827;">Error</h4>
      <p style="margin:4px 0 0;font-size:13px;color:#4b5563;">{{ session('error') }}</p>
    </div>
    <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;margin-left:auto;">
      <i data-lucide="x" style="width:16px;height:16px;"></i>
    </button>
  </div>
  @endif

  @if(session('loan_eligible'))
  <div class="toast" style="background:#fff;border-left:4px solid #3b82f6;padding:16px 20px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.1);display:flex;align-items:flex-start;gap:12px;animation:slideInRight .3s ease forwards;">
    <i data-lucide="award" style="color:#3b82f6;width:20px;height:20px;flex-shrink:0;margin-top:2px;"></i>
    <div>
      <h4 style="margin:0;font-size:14px;font-weight:700;color:#111827;">Loan Eligibility Unlocked!</h4>
      <p style="margin:4px 0 0;font-size:13px;color:#4b5563;">Congratulations! You have paid 50% of your Shared Capital and are now eligible to apply for GBLDC loans.</p>
    </div>
    <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;margin-left:auto;">
      <i data-lucide="x" style="width:16px;height:16px;"></i>
    </button>
  </div>
  @endif
</div>


<!-- ═══ Scripts ═══ -->
<script>
  lucide.createIcons();

  /* ── Mobile sidebar ── */
  const sidebar      = document.getElementById('sidebar');
  const mobileToggle = document.getElementById('mobileToggle');
  mobileToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  document.addEventListener('click', e => {
    if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
      sidebar.classList.remove('open');
    }
  });

  /* ── Modal helpers ── */
  const openModal  = id => { const el = document.getElementById(id); if (el) el.classList.add('open'); };
  const closeModal = id => { const el = document.getElementById(id); if (el) el.classList.remove('open'); };

  document.querySelectorAll('.modal-overlay').forEach(el => {
    el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
  });

  /* ── PayMongo modal ── */
  document.getElementById('makePaymentBtn2').addEventListener('click', () => {
    openModal('qrCodeModal');
    lucide.createIcons();
  });
  document.getElementById('closeQrModal').addEventListener('click', () => closeModal('qrCodeModal'));

  /* ── Schedule modal ── */
  function openPaymentScheduleModal()  { openModal('paymentScheduleModal'); }
  function closePaymentScheduleModal() { closeModal('paymentScheduleModal'); }

  /* ── Logout modal ── */
  function openLogoutModal()  { openModal('logout-modal'); }
  function closeLogoutModal() { closeModal('logout-modal'); }

  /* ── PayMongo amount toggle ── */
  const sharedDueAmount = {{ isset($sharedCapitalInfo->payment_amount_per_schedule) && is_numeric($sharedCapitalInfo->payment_amount_per_schedule) ? $sharedCapitalInfo->payment_amount_per_schedule : 0 }};

  function toggleLoanNumber() {
    const type       = document.getElementById('modal_transaction_type').value;
    const loanField  = document.getElementById('modal_loan_number_field');
    const loanSelect = document.getElementById('modal_loan_number');
    const display    = document.getElementById('computed_amount_display');
    const hidden     = document.getElementById('modal_payment_amount_hidden');
    let amt = 0;

    if (type === 'Loan Payment') {
      loanField.style.display = 'block';
      loanSelect.setAttribute('required', 'required');
      if (loanSelect.value) {
        const opt = loanSelect.options[loanSelect.selectedIndex];
        if (opt && opt.dataset.due) amt = opt.dataset.due;
      }
    } else {
      loanField.style.display = 'none';
      loanSelect.removeAttribute('required');
      if (type === 'Shared Capital') amt = sharedDueAmount;
    }

    const num = parseFloat(amt);
    if (!isNaN(num)) {
      display.textContent = '₱ ' + num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      hidden.value = num.toFixed(2);
    } else {
      display.textContent = '₱ 0.00';
      hidden.value = 0;
    }
  }

  document.getElementById('paymongoForm').addEventListener('submit', function(e) {
    const val = parseFloat(document.getElementById('modal_payment_amount_hidden').value);
    if (val < 0.01) {
      e.preventDefault();
      alert('Amount to pay must be greater than zero. There seems to be nothing due.');
    }
  });

  /* ── Repayment status color logic ── */
  function checkPaymentDue() {
    const now = new Date();
    const currentMonth = now.getMonth(), currentYear = now.getFullYear();

    function hasRecentPayment(lastPaymentDate, frequency, startDate) {
      if (!lastPaymentDate) return false;
      const lastPayment = new Date(lastPaymentDate);
      const daysDiff = (now - lastPayment) / (1000 * 3600 * 24);
      const freq = frequency.toLowerCase();
      if (freq.includes('daily'))   return daysDiff < 1;
      if (freq.includes('weekly'))  return daysDiff < 7;
      if (freq.includes('monthly')) {
        if (startDate) {
          const sd = new Date(startDate);
          const monthsSinceStart  = (currentYear - sd.getFullYear()) * 12 + (currentMonth - sd.getMonth());
          const paymentMonths     = (lastPayment.getFullYear() - sd.getFullYear()) * 12 + (lastPayment.getMonth() - sd.getMonth());
          return paymentMonths >= monthsSinceStart;
        }
        return lastPayment.getMonth() === currentMonth && lastPayment.getFullYear() === currentYear;
      }
      return false;
    }

    function updateCard(id) {
      const div   = document.getElementById(id);
      const freq  = div.getAttribute('data-frequency');
      const last  = div.getAttribute('data-last-payment');
      const start = div.getAttribute('data-start-date');
      div.classList.remove('paid', 'overdue');
      if (!freq || freq === '' || freq.toLowerCase() === 'not set') return;
      div.classList.add(hasRecentPayment(last, freq, start) ? 'paid' : 'overdue');
    }

    updateCard('loan-payment-div');
    updateCard('shared-capital-div');
  }

  document.addEventListener('DOMContentLoaded', () => {
    checkPaymentDue();
    lucide.createIcons();

    /* Auto-dismiss toasts */
    setTimeout(() => {
      document.querySelectorAll('.toast').forEach(t => {
        t.style.animation = 'fadeOut .5s ease forwards';
        setTimeout(() => t.remove(), 500);
      });
    }, 5000);
  });
</script>

</body>
</html>