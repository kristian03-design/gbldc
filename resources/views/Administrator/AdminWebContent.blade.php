<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Web Content | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <style>
    :root {
      --forest:    #0d4a2f;
      --forest-mid:#1a6b44;
      --emerald:   #22c55e;
      --sage:      #d1fae5;
      --sand:      #f4f6f3;
      --ink:       #0f1c14;
      --muted:     #6b7280;
      --border:    #e5e7eb;
      --white:     #ffffff;
      --amber:     #f59e0b;
      --sky:       #3b82f6;
      --violet:    #8b5cf6;
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

    /* ════════════════════════════════
       SIDEBAR — UNCHANGED
    ════════════════════════════════ */
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
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700; line-height: 1.2; color: #fff;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }
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

    /* ════════════════════════════════
       MAIN LAYOUT
    ════════════════════════════════ */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1; display: flex;
      flex-direction: column; min-height: 100vh;
    }

    /* ── Topbar — REDESIGNED ── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 0 36px;
      position: sticky; top: 0; z-index: 50;
      display: flex; align-items: stretch; justify-content: space-between;
      min-height: 70px;
    }
    .topbar-left { display: flex; align-items: center; gap: 16px; }
    .topbar-icon {
      width: 44px; height: 44px; border-radius: 13px;
      background: var(--sage); display: flex; align-items: center; justify-content: center;
    }
    .topbar-icon i { width: 20px; height: 20px; color: var(--forest); }
    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 21px; font-weight: 700; color: var(--forest); line-height: 1.2;
    }
    .breadcrumb {
      display: flex; align-items: center; gap: 5px;
      font-size: 12px; color: var(--muted); margin-top: 3px;
    }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }
    .topbar-right { display: flex; align-items: center; gap: 10px; }
    .topbar-stat {
      display: flex; align-items: center; gap: 7px;
      padding: 7px 14px; border-radius: 30px;
      background: var(--sage); color: var(--forest);
      font-size: 12px; font-weight: 700;
    }
    .topbar-stat i { width: 13px; height: 13px; }

    /* ── Page body ── */
    .page-body { padding: 28px 36px; flex: 1; }

    /* ── Hero banner — REDESIGNED ── */
    .page-hero {
      background: var(--forest);
      border-radius: 20px;
      padding: 32px 36px;
      margin-bottom: 28px;
      display: flex; align-items: center; justify-content: space-between;
      gap: 24px; position: relative; overflow: hidden;
    }
    .page-hero::before {
      content: '';
      position: absolute; inset: 0;
      background: radial-gradient(ellipse at 80% 50%, rgba(34,197,94,.18) 0%, transparent 65%),
                  radial-gradient(ellipse at 20% 80%, rgba(255,255,255,.04) 0%, transparent 50%);
    }
    .page-hero-grid {
      position: absolute; inset: 0; overflow: hidden; pointer-events: none;
      background-image: linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
      background-size: 40px 40px;
      mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
    }
    .hero-text { position: relative; z-index: 1; }
    .hero-eyebrow {
      font-size: 10px; letter-spacing: .14em; text-transform: uppercase;
      color: var(--emerald); font-weight: 700; margin-bottom: 8px;
      display: flex; align-items: center; gap: 7px;
    }
    .hero-eyebrow::before {
      content: ''; display: block; width: 20px; height: 2px;
      background: var(--emerald); border-radius: 2px;
    }
    .page-hero h2 {
      font-family: 'Playfair Display', serif;
      font-size: 26px; color: #fff; margin-bottom: 8px; line-height: 1.25;
    }
    .page-hero p { font-size: 14px; color: rgba(255,255,255,.6); line-height: 1.6; max-width: 460px; }
    .hero-stats {
      position: relative; z-index: 1;
      display: flex; gap: 12px; flex-shrink: 0;
    }
    .hero-stat-box {
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.1);
      border-radius: 14px; padding: 16px 20px; text-align: center; min-width: 90px;
      backdrop-filter: blur(4px);
    }
    .hero-stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 28px; font-weight: 700; color: #fff; line-height: 1;
    }
    .hero-stat-label { font-size: 10px; color: rgba(255,255,255,.5); margin-top: 4px; letter-spacing: .06em; text-transform: uppercase; }

    /* ── Alert ── */
    .alert-success {
      display: flex; align-items: center; gap: 10px;
      background: #dcfce7; color: #166534;
      padding: 13px 18px; border-radius: 12px;
      margin-bottom: 24px; font-size: 14px; font-weight: 500;
      border: 1px solid #86efac;
      animation: slideDown .3s ease;
    }
    .alert-success i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }

    /* ── Two-column layout ── */
    .two-col { display: grid; grid-template-columns: 1fr 380px; gap: 24px; align-items: start; margin-bottom: 32px; }

    /* ── Form card — REDESIGNED ── */
    .form-card {
      background: var(--white); border-radius: 20px;
      border: 1px solid var(--border);
      overflow: hidden;
    }
    .form-card-header {
      padding: 20px 26px 16px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: 12px;
    }
    .form-card-header-icon {
      width: 38px; height: 38px; border-radius: 11px;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .form-card-header-icon i { width: 18px; height: 18px; color: var(--forest); }
    .form-card-header h3 { font-size: 15px; font-weight: 700; color: var(--ink); }
    .form-card-header p { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .form-card-body { padding: 24px 26px; }

    /* ── Side info card ── */
    .info-card {
      background: var(--white); border-radius: 20px;
      border: 1px solid var(--border);
      overflow: hidden; position: sticky; top: 86px;
    }
    .info-card-header {
      padding: 18px 22px 14px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: 10px;
    }
    .info-card-header h3 { font-size: 14px; font-weight: 700; color: var(--ink); }
    .info-card-body { padding: 18px 22px; }
    .info-tip {
      display: flex; gap: 10px; align-items: flex-start;
      padding: 11px 0; border-bottom: 1px solid var(--border);
    }
    .info-tip:last-child { border-bottom: none; padding-bottom: 0; }
    .info-tip-icon {
      width: 32px; height: 32px; border-radius: 9px; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
    }
    .info-tip-icon i { width: 15px; height: 15px; }
    .info-tip-text { font-size: 12.5px; color: var(--muted); line-height: 1.5; }
    .info-tip-title { font-size: 12px; font-weight: 700; color: var(--ink); margin-bottom: 2px; }

    /* ── Form fields ── */
    .field-row { display: grid; gap: 14px; margin-bottom: 14px; }
    .field-row.cols-2 { grid-template-columns: 1fr 1fr; }
    .field-row.cols-3 { grid-template-columns: 1fr 1fr 1fr; }

    .form-group { display: flex; flex-direction: column; }

    .form-label {
      display: flex; align-items: center; gap: 5px;
      font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .07em;
      color: var(--muted); margin-bottom: 7px;
    }
    .form-label i[data-lucide] { width: 12px; height: 12px; }
    .form-label .opt { font-weight: 400; opacity: .6; letter-spacing: 0; text-transform: none; font-size: 10px; }

    .form-control {
      width: 100%; padding: 10px 14px;
      border: 1.5px solid var(--border); border-radius: 10px;
      font-family: 'DM Sans', sans-serif; font-size: 14px;
      color: var(--ink); background: var(--white);
      outline: none; transition: border-color .2s, box-shadow .2s;
      appearance: none;
    }
    .form-control:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    select.form-control {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat; background-position: right 14px center;
      padding-right: 36px; cursor: pointer;
    }
    textarea.form-control { resize: vertical; min-height: 96px; line-height: 1.55; }

    .form-divider { height: 1px; background: var(--border); margin: 18px 0; }

    /* ── File upload zone ── */
    .file-zone {
      border: 2px dashed var(--border); border-radius: 12px;
      padding: 16px 18px; display: flex; align-items: center; gap: 13px;
      cursor: pointer; transition: border-color .2s, background .2s;
      background: #fafaf8;
    }
    .file-zone:hover { border-color: var(--emerald); background: var(--sage); }
    .file-zone input { display: none; }
    .file-zone-icon {
      width: 40px; height: 40px; border-radius: 10px;
      background: var(--border); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
      transition: background .2s;
    }
    .file-zone:hover .file-zone-icon { background: rgba(34,197,94,.2); }
    .file-zone-icon i { width: 18px; height: 18px; color: var(--muted); }
    .file-zone:hover .file-zone-icon i { color: var(--forest); }
    .file-zone p { font-size: 13px; color: var(--muted); margin: 0; line-height: 1.4; }
    .file-zone strong { color: var(--ink); }

    /* ── Custom dropdown ── */
    .custom-dd { position: relative; }
    .custom-dd-trigger {
      width: 100%; padding: 10px 14px;
      border: 1.5px solid var(--border); border-radius: 10px;
      font-family: 'DM Sans', sans-serif; font-size: 14px;
      color: var(--ink); background: var(--white);
      display: flex; align-items: center; gap: 8px;
      cursor: pointer; transition: border-color .2s, box-shadow .2s;
      user-select: none;
    }
    .custom-dd-trigger:focus-within,
    .custom-dd.open .custom-dd-trigger {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .custom-dd-trigger .dd-label { flex: 1; text-align: left; }
    .custom-dd-trigger .dd-chevron { width: 14px; height: 14px; color: var(--muted); transition: transform .2s; }
    .custom-dd.open .dd-chevron { transform: rotate(180deg); }
    .custom-dd-trigger i[data-lucide]:first-child { width: 15px; height: 15px; color: var(--muted); flex-shrink: 0; }
    .custom-dd-panel {
      display: none; position: absolute; top: calc(100% + 5px); left: 0; right: 0;
      background: var(--white); border: 1px solid var(--border);
      border-radius: 12px; padding: 5px;
      box-shadow: 0 8px 24px rgba(0,0,0,.1); z-index: 90;
    }
    .custom-dd.open .custom-dd-panel { display: block; }
    .custom-dd-item {
      display: flex; align-items: center; gap: 9px;
      padding: 9px 12px; border-radius: 8px;
      cursor: pointer; font-size: 14px; color: var(--ink);
      transition: background .15s;
    }
    .custom-dd-item:hover { background: var(--sage); }
    .custom-dd-item.selected { background: var(--sage); font-weight: 600; color: var(--forest); }
    .custom-dd-item i[data-lucide] { width: 15px; height: 15px; flex-shrink: 0; }
    .custom-dd-placeholder { color: var(--muted); }

    /* ── Submit row ── */
    .submit-row {
      display: flex; align-items: center; justify-content: flex-end; gap: 10px;
      padding-top: 18px; border-top: 1px solid var(--border); margin-top: 18px;
    }
    .btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 10px 20px; border-radius: 10px;
      font-size: 14px; font-weight: 600;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: background .2s, transform .1s;
      text-decoration: none;
    }
    .btn:active { transform: scale(.97); }
    .btn i[data-lucide] { width: 14px; height: 14px; }
    .btn-primary {
      background: var(--forest); color: #fff;
      box-shadow: 0 2px 10px rgba(13,74,47,.25);
    }
    .btn-primary:hover { background: var(--forest-mid); }
    .btn-ghost { background: #f3f4f6; color: var(--ink); }
    .btn-ghost:hover { background: var(--border); }

    /* ── Section divider ── */
    .section-header {
      display: flex; align-items: center; gap: 14px; margin-bottom: 18px;
    }
    .section-header-line { flex: 1; height: 1px; background: var(--border); }
    .section-header-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 700; white-space: nowrap;
      display: flex; align-items: center; gap: 6px;
    }
    .section-header-label i { width: 13px; height: 13px; }

    /* ── Content Tables ── */
    .content-grid { display: flex; flex-direction: column; gap: 16px; }

    .table-card {
      background: var(--white); border-radius: 20px;
      border: 1px solid var(--border); overflow: hidden;
      transition: box-shadow .2s;
    }
    .table-card:hover { box-shadow: 0 4px 16px rgba(13,74,47,.06); }

    .table-card-header {
      padding: 16px 22px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
    }
    .table-card-header-left { display: flex; align-items: center; gap: 11px; }
    .table-type-icon {
      width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
    }
    .table-type-icon i { width: 17px; height: 17px; }
    .table-card-header h3 { font-size: 14px; font-weight: 700; color: var(--ink); }
    .count-badge {
      font-size: 11px; padding: 3px 10px; border-radius: 20px;
      background: var(--sage); color: var(--forest); font-weight: 700;
    }
    .table-collapse-btn {
      background: none; border: none; cursor: pointer;
      width: 30px; height: 30px; border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      color: var(--muted); transition: background .15s, transform .25s;
    }
    .table-collapse-btn:hover { background: var(--sand); }
    .table-collapse-btn.collapsed { transform: rotate(-90deg); }
    .table-collapse-btn i { width: 16px; height: 16px; }

    .table-wrap { overflow-x: auto; }
    .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .data-table thead tr { background: #f9fafb; }
    .data-table th {
      padding: 10px 18px; text-align: left;
      font-size: 10.5px; letter-spacing: .07em;
      text-transform: uppercase; color: var(--muted); font-weight: 700;
      border-bottom: 1px solid var(--border);
    }
    .data-table tbody tr { border-top: 1px solid #f3f4f6; transition: background .12s; }
    .data-table tbody tr:hover { background: #fafaf8; }
    .data-table td { padding: 13px 18px; vertical-align: middle; }

    img.thumb {
      width: 50px; height: 50px; object-fit: cover;
      border-radius: 10px; border: 1px solid var(--border);
    }
    .no-image {
      width: 50px; height: 50px; background: #f3f4f6;
      border-radius: 10px; border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      color: var(--muted); font-size: 9px; font-weight: 700;
      text-align: center; line-height: 1.3;
    }

    .audience-badge {
      font-size: 10.5px; padding: 3px 9px; border-radius: 20px;
      font-weight: 700; letter-spacing: .04em;
    }
    .audience-badge.both   { background: #ede9fe; color: #6d28d9; }
    .audience-badge.guest  { background: #fef3c7; color: #92400e; }
    .audience-badge.member { background: #dbeafe; color: #1e40af; }

    .content-preview {
      color: var(--muted); font-size: 12.5px;
      max-width: 240px;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .btn-danger {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 6px 12px; border-radius: 8px;
      font-size: 12px; font-weight: 600;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      background: #fee2e2; color: #dc2626;
      transition: background .2s;
    }
    .btn-danger:hover { background: #fca5a5; }
    .btn-danger i[data-lucide] { width: 12px; height: 12px; }

    .empty-row td {
      text-align: center; color: var(--muted);
      padding: 32px; font-size: 13px;
    }
    .empty-row-inner {
      display: flex; flex-direction: column; align-items: center; gap: 6px;
    }
    .empty-row-inner i { width: 24px; height: 24px; color: #d1d5db; }

    /* Collapsed table body */
    .table-body-wrap { transition: max-height .3s ease, opacity .3s ease; overflow: hidden; }
    .table-body-wrap.collapsed { max-height: 0 !important; opacity: 0; }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Animations ── */
    @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
    .anim { animation: fadeUp .4s ease both; }
    .anim-1 { animation-delay: .05s; }
    .anim-2 { animation-delay: .10s; }
    .anim-3 { animation-delay: .15s; }
    .anim-4 { animation-delay: .20s; }
    .anim-5 { animation-delay: .25s; }

    /* ── Responsive ── */
    @media (max-width: 1200px) { .two-col { grid-template-columns: 1fr; } .info-card { position: static; } }
    @media (max-width: 1024px) { .field-row.cols-3 { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .page-body { padding: 20px 16px; }
      .topbar { padding: 0 16px; }
      .field-row.cols-2, .field-row.cols-3 { grid-template-columns: 1fr; }
      .hero-stats { display: none; }
    }
  
    /* RESPONSIVE INJECT */
    .mobile-toggle { display: none; }
    .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 99; }
    .sidebar-overlay.show { display: block; }
    @media (max-width: 900px) {
      :root { --sidebar-w: 0px !important; }
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; width: 260px !important; z-index: 100 !important; }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0 !important; width: 100% !important; min-width: 100vw; }
      .mobile-toggle { display: flex !important; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; border: none; background: #f3f4f6; color: var(--ink); cursor: pointer; flex-shrink: 0; margin-right: 12px; }
      .topbar { padding: 14px 16px !important; }
      .tables-grid, .stats-grid, .loan-grid, .kpi-strip { grid-template-columns: 1fr !important; }
      .page-body { padding: 16px !important; }
      .topbar-left, .topbar-title { display: flex !important; align-items: center !important; }
      .hide-mobile { display: none !important; }
    }
</style>

</head>
<body>

<!-- ═══════════ SIDEBAR (UNCHANGED) ═══════════ -->
<aside class="sidebar" id="sidebar">
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

    <div class="nav-section-label">Reports</div>
    <a href="{{route('Admin.Reports')}}" class="nav-item">
      <i data-lucide="bar-chart-2"></i> Cooperative Reports
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.WebContent')}}" class="nav-item active">
      <i data-lucide="layout-template"></i> Web Content
    </a>
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="{{ route('Admin.Settings') }}" class="nav-item">
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
    <div id="user-menu" style="display:none;background:#0a3d27;border-radius:10px;padding:6px;margin-top:6px;">
      <a href="#" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:rgba(255,255,255,.8);text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;"
        onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'">
        <i data-lucide="user" style="width:14px;height:14px;"></i> Profile
      </a>
      <a href="{{ route('Admin.Logout') }}" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:#f87171;text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;"
        onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</aside>

<!-- ═══════════ MAIN ═══════════ -->
<div class="main">

  <!-- Topbar -->
  <div class="sidebar-overlay" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebar-overlay').classList.remove('show');"></div>
<header class="topbar">
  <div class="topbar-left" style="display:flex; align-items:center;">
    <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');" style="margin-right:12px;">
      <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
      <div class="topbar-icon"><i data-lucide="layout-template"></i></div>
      <div class="topbar-title">
        <h1>Web Content</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <i data-lucide="house" style="width:12px;height:12px;"></i>
          <a href="{{route('Admin.dashboard')}}">Dashboard</a>
          <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
          <span class="current">Manage Web Content</span>
        </nav>
      </div>
    </div>
    <div class="topbar-right">
      <div class="topbar-stat">
        <i data-lucide="layers"></i>
        <span id="total-count-display">— blocks</span>
      </div>
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Hero Banner -->
    <div class="page-hero anim anim-1">
      <div class="page-hero-grid"></div>
      <div class="hero-text">
        <div class="hero-eyebrow">Content Management</div>
        <h2>Manage Landing Page Content</h2>
        <p>Add, update, and remove content blocks displayed on guest and member landing pages. Changes take effect immediately on publish.</p>
      </div>
      <div class="hero-stats">
        <div class="hero-stat-box">
          <div class="hero-stat-num" id="hero-total">—</div>
          <div class="hero-stat-label">Total Blocks</div>
        </div>
        <div class="hero-stat-box">
          <div class="hero-stat-num" id="hero-types">5</div>
          <div class="hero-stat-label">Sections</div>
        </div>
      </div>
    </div>

    <!-- Success alert -->
    @if(session('success'))
      <div class="alert-success">
        <i data-lucide="circle-check"></i>
        {{ session('success') }}
      </div>
    @endif

    <!-- ── Two-col: Form + Tips ── -->
    <div class="two-col anim anim-2">

      <!-- Form card -->
      <div class="form-card">
        <div class="form-card-header">
          <div class="form-card-header-icon"><i data-lucide="plus-circle"></i></div>
          <div>
            <h3>Add New Content Block</h3>
            <p>Fill in the fields below to publish a new section.</p>
          </div>
        </div>
        <div class="form-card-body">
          <form action="{{ route('Admin.WebContent.Store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Row 1: Audience · Type · Title -->
            <div class="field-row cols-3" style="margin-bottom:14px;">
              <div class="form-group">
                <label class="form-label"><i data-lucide="users"></i> Audience</label>
                <select name="target_audience" class="form-control" required>
                  <option value="both">Both (Guest & Member)</option>
                  <option value="guest">Guest Only</option>
                  <option value="member">Member Only</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label"><i data-lucide="layers"></i> Section Type</label>
                <select name="section_type" id="section_type" class="form-control" required onchange="toggleCategory(this.value)">
                  <option value="banner">Site Banner</option>
                  <option value="news">News & Events</option>
                  <option value="testimonial">Testimonial</option>
                  <option value="service">Services</option>
                  <option value="gallery">Gallery Image</option>
                  <option value="hero">Hero Section</option>
                  <option value="cta">Call-to-Action</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label"><i data-lucide="type"></i> Title / Author</label>
                <input type="text" name="title" class="form-control" placeholder="E.g. Annual Assembly">
              </div>
            </div>

            <!-- Category row -->
            <div id="category-row" style="margin-bottom:14px;">
              <div class="form-group">
                <label class="form-label">
                  <i data-lucide="tag"></i>
                  <span id="category-label-text">Category</span>
                </label>
                <input type="hidden" name="category" id="category-value" value="">
                <div class="custom-dd" id="category-dd">
                  <div class="custom-dd-trigger" id="category-dd-trigger" tabindex="0">
                    <i data-lucide="tag" id="cat-icon"></i>
                    <span class="dd-label custom-dd-placeholder" id="cat-label">— Select Category —</span>
                    <i data-lucide="chevron-down" class="dd-chevron"></i>
                  </div>
                  <div class="custom-dd-panel" id="category-dd-panel">
                    <div class="custom-dd-item" data-value="announcement" data-icon="megaphone" data-label="Announcement">
                      <i data-lucide="megaphone"></i> Announcement
                    </div>
                    <div class="custom-dd-item" data-value="events" data-icon="calendar-days" data-label="Events">
                      <i data-lucide="calendar-days"></i> Events
                    </div>
                    <div class="custom-dd-item" data-value="updates" data-icon="bell" data-label="Updates">
                      <i data-lucide="bell"></i> Updates
                    </div>
                    <div class="custom-dd-item" data-value="promotions" data-icon="badge-percent" data-label="Promotions">
                      <i data-lucide="badge-percent"></i> Promotions
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-divider"></div>

            <!-- Row 2: Content & Image -->
            <div class="field-row cols-2">
              <div class="form-group">
                <label class="form-label"><i data-lucide="align-left"></i> Description / Content</label>
                <textarea name="content" class="form-control" placeholder="Write the main text content here..."></textarea>
              </div>
              <div style="display:flex;flex-direction:column;gap:14px;">
                <div class="form-group">
                  <label class="form-label">
                    <i data-lucide="image"></i> Image Upload
                    <span class="opt">(Gallery & News)</span>
                  </label>
                  <label class="file-zone" for="content_image">
                    <input type="file" name="image" id="content_image" accept="image/*">
                    <div class="file-zone-icon"><i data-lucide="cloud-upload"></i></div>
                    <div>
                      <p id="file-label"><strong>Click to upload</strong> or drag & drop</p>
                      <p style="font-size:11px;margin-top:2px;color:var(--muted);">PNG, JPG — max 5MB</p>
                    </div>
                  </label>
                </div>
                <div class="form-group">
                  <label class="form-label">
                    <i data-lucide="arrow-up-down"></i> Sort Order
                    <span class="opt">(lower = first)</span>
                  </label>
                  <input type="number" name="sort_order" class="form-control" value="0" min="0">
                </div>
              </div>
            </div>

            <!-- Submit -->
            <div class="submit-row">
              <button type="reset" class="btn btn-ghost"><i data-lucide="rotate-ccw"></i> Reset</button>
              <button type="submit" class="btn btn-primary"><i data-lucide="save"></i> Save Block</button>
            </div>

          </form>
        </div>
      </div>

      <!-- Tips sidebar -->
      <div class="info-card">
        <div class="info-card-header">
          <i data-lucide="lightbulb" style="width:16px;height:16px;color:var(--amber);"></i>
          <h3>Content Guide</h3>
        </div>
        <div class="info-card-body">
          <div class="info-tip">
            <div class="info-tip-icon" style="background:#fef3c7;"><i data-lucide="flag" style="color:#92400e;"></i></div>
            <div>
              <div class="info-tip-title">Banner</div>
              <div class="info-tip-text">Displayed as a sliding announcement strip. Use short, impactful text.</div>
            </div>
          </div>
          <div class="info-tip">
            <div class="info-tip-icon" style="background:#dbeafe;"><i data-lucide="newspaper" style="color:#1e40af;"></i></div>
            <div>
              <div class="info-tip-title">News & Events</div>
              <div class="info-tip-text">Requires an image. Choose a category for better filtering on the frontend.</div>
            </div>
          </div>
          <div class="info-tip">
            <div class="info-tip-icon" style="background:#fdf4ff;"><i data-lucide="message-square" style="color:#7e22ce;"></i></div>
            <div>
              <div class="info-tip-title">Testimonials</div>
              <div class="info-tip-text">Use "Title" for the member's name. Paste their quote in the content field.</div>
            </div>
          </div>
          <div class="info-tip">
            <div class="info-tip-icon" style="background:#dcfce7;"><i data-lucide="briefcase" style="color:#166534;"></i></div>
            <div>
              <div class="info-tip-title">Services</div>
              <div class="info-tip-text">Each service card is an individual block. Use sort order to arrange them.</div>
            </div>
          </div>
          <div class="info-tip">
            <div class="info-tip-icon" style="background:#fef9c3;"><i data-lucide="image" style="color:#854d0e;"></i></div>
            <div>
              <div class="info-tip-title">Gallery</div>
              <div class="info-tip-text">Image is required. Title is used as an alt/caption on hover.</div>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /two-col -->

    <!-- ── Published Content ── -->
    <div class="section-header anim anim-3">
      <div class="section-header-label"><i data-lucide="database"></i> Published Content</div>
      <div class="section-header-line"></div>
    </div>

    @php
      $contentSections = [
        'banner'      => ['label' => 'Site Banner',        'icon' => 'flag',          'bg' => '#fef3c7', 'ic' => '#92400e'],
        'news'        => ['label' => 'News & Events',       'icon' => 'newspaper',     'bg' => '#dbeafe', 'ic' => '#1e40af'],
        'testimonial' => ['label' => 'Testimonials',        'icon' => 'message-square','bg' => '#fdf4ff', 'ic' => '#7e22ce'],
        'service'     => ['label' => 'Services',            'icon' => 'briefcase',     'bg' => '#dcfce7', 'ic' => '#166534'],
        'gallery'     => ['label' => 'Gallery',             'icon' => 'image',         'bg' => '#fef3c7', 'ic' => '#854d0e'],
      ];
    @endphp

    <div class="content-grid">
    @foreach($contentSections as $type => $meta)
    <div class="table-card anim anim-{{ $loop->index + 3 }}" data-section="{{ $type }}">
      <div class="table-card-header">
        <div class="table-card-header-left">
          <div class="table-type-icon" @style(['background' => $meta['bg']])>
            <i data-lucide="{{ $meta['icon'] }}" @style(['color' => $meta['ic']])></i>
          </div>
          <h3>{{ $meta['label'] }}</h3>
          @if(isset($groupedContents[$type]))
            <span class="count-badge">{{ count($groupedContents[$type]) }}</span>
          @else
            <span class="count-badge">0</span>
          @endif
        </div>
        <button class="table-collapse-btn" onclick="toggleTable(this)" title="Collapse/expand">
          <i data-lucide="chevron-down"></i>
        </button>
      </div>

      <div class="table-body-wrap" style="max-height:600px;">
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Content Preview</th>
                <th>Audience</th>
                <th>Order</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($groupedContents[$type]) && count($groupedContents[$type]))
                @foreach($groupedContents[$type] as $item)
                <tr>
                  <td>
                    @if($item->image_path)
                      <img src="{{ asset($item->image_path) }}" class="thumb" alt="{{ $item->title }}">
                    @else
                      <div class="no-image">No<br>Image</div>
                    @endif
                  </td>
                  <td style="font-weight:600;max-width:150px;">{{ $item->title ?? '—' }}</td>
                  <td>
                    @if(in_array($type, ['news', 'banner']) && $item->category)
                      @php
                        $catLabels = [
                          'announcement' => ['label'=>'Announcement','bg'=>'#fef3c7','color'=>'#92400e'],
                          'events'       => ['label'=>'Events',       'bg'=>'#dbeafe','color'=>'#1e40af'],
                          'updates'      => ['label'=>'Updates',      'bg'=>'#dcfce7','color'=>'#166534'],
                          'promotions'   => ['label'=>'Promotions',   'bg'=>'#fdf4ff','color'=>'#7e22ce'],
                        ];
                        $cat = $catLabels[$item->category] ?? ['label'=>ucfirst($item->category),'bg'=>'#f3f4f6','color'=>'#374151'];
                      @endphp
                      <span style="font-size:11px;padding:3px 9px;border-radius:20px;font-weight:700;" @style(['background' => $cat['bg'], 'color' => $cat['color']])>
                        {{ $cat['label'] }}
                      </span>
                    @else
                      <span style="color:#d1d5db;font-size:13px;">—</span>
                    @endif
                  </td>
                  <td><span class="content-preview">{{ Str::limit($item->content, 55) }}</span></td>
                  <td>
                    @php $aud = strtolower($item->target_audience); @endphp
                    <span class="audience-badge {{ $aud }}">{{ strtoupper($aud) }}</span>
                  </td>
                  <td style="color:var(--muted);font-size:13px;text-align:center;">{{ $item->sort_order ?? 0 }}</td>
                  <td>
                    <form action="{{ route('Admin.WebContent.Destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Delete this content block?');" style="display:inline;">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-danger">
                        <i data-lucide="trash-2"></i> Delete
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              @else
                <tr class="empty-row">
                  <td colspan="7">
                    <div class="empty-row-inner">
                      <i data-lucide="{{ $meta['icon'] }}"></i>
                      <span>No {{ strtolower($meta['label']) }} added yet.</span>
                    </div>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

    </div>
    @endforeach
    </div><!-- /content-grid -->

  </div><!-- /page-body -->
</div><!-- /main -->

<script>
  lucide.createIcons();

  // User menu
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // Category row toggle
  function toggleCategory(val) {
    const show = val === 'news' || val === 'banner';
    document.getElementById('category-row').style.display = show ? 'block' : 'none';
    if (show) {
      document.getElementById('category-label-text').innerText = val === 'banner' ? 'Banner Type' : 'News Category';
    }
  }
  toggleCategory(document.getElementById('section_type').value);

  // Custom dropdown
  (function () {
    const dd      = document.getElementById('category-dd');
    const trigger = document.getElementById('category-dd-trigger');
    const panel   = document.getElementById('category-dd-panel');
    const hidden  = document.getElementById('category-value');
    const catLabel = document.getElementById('cat-label');
    const catIcon  = document.getElementById('cat-icon');

    trigger.addEventListener('click', e => { e.stopPropagation(); dd.classList.toggle('open'); });
    trigger.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); dd.classList.toggle('open'); }
      if (e.key === 'Escape') dd.classList.remove('open');
    });
    panel.querySelectorAll('.custom-dd-item').forEach(item => {
      item.addEventListener('click', () => {
        hidden.value = item.dataset.value;
        catLabel.textContent = item.dataset.label;
        catLabel.classList.remove('custom-dd-placeholder');
        catIcon.setAttribute('data-lucide', item.dataset.icon);
        lucide.createIcons({ nodes: [catIcon] });
        panel.querySelectorAll('.custom-dd-item').forEach(i => i.classList.remove('selected'));
        item.classList.add('selected');
        dd.classList.remove('open');
      });
    });
    document.addEventListener('click', () => dd.classList.remove('open'));
  })();

  // File input label
  document.getElementById('content_image').addEventListener('change', function () {
    const label = document.getElementById('file-label');
    label.innerHTML = this.files[0]
      ? `<strong>${this.files[0].name}</strong>`
      : '<strong>Click to upload</strong> or drag & drop';
  });

  // Collapsible table sections
  function toggleTable(btn) {
    const wrap = btn.closest('.table-card').querySelector('.table-body-wrap');
    const collapsed = wrap.classList.toggle('collapsed');
    btn.classList.toggle('collapsed', collapsed);
  }

  // Count total published items and update hero
  (function() {
    let total = 0;
    document.querySelectorAll('.count-badge').forEach(b => {
      total += parseInt(b.textContent) || 0;
    });
    const heroEl = document.getElementById('hero-total');
    const topEl  = document.getElementById('total-count-display');
    if (heroEl) heroEl.textContent = total;
    if (topEl)  topEl.textContent  = `${total} blocks`;
  })();
</script>
</body>
</html>