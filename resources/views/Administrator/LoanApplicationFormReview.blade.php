<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Loan Application Review | GBLDC Admin</title>
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
      --sand:      #fafaf8;
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
    .nav-item svg,
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* Jump nav */
    .nav-section-jump { padding: 6px 0; }
    .jump-item {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 12px; border-radius: 8px;
      text-decoration: none;
      color: rgba(255,255,255,.45);
      font-size: 13px;
      transition: background .15s, color .15s;
      margin-bottom: 1px;
    }
    .jump-item:hover { background: rgba(255,255,255,.05); color: rgba(255,255,255,.8); }
    .jump-item.lit { color: var(--emerald); }
    .jump-dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: rgba(255,255,255,.2); flex-shrink: 0;
      transition: background .2s;
    }
    .jump-item.lit .jump-dot { background: var(--emerald); box-shadow: 0 0 6px rgba(34,197,94,.5); }

    .sidebar-footer {
      padding: 16px 12px;
      border-top: 1px solid rgba(255,255,255,.1);
    }
    .user-card {
      display: flex; align-items: center; gap: 10px;
      padding: 10px; border-radius: 10px;
      cursor: pointer; transition: background .2s;
      position: relative;
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
    .dropdown-item svg,
    .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

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
      display: flex; align-items: center; gap: 10px;
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
    .back-btn svg,
    .back-btn i[data-lucide] { width: 14px; height: 14px; }

    .breadcrumb {
      display: flex; align-items: center; gap: 6px;
      font-size: 13px; color: var(--muted);
    }
    .breadcrumb a { color: var(--forest-mid); text-decoration: none; font-weight: 600; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg,
    .breadcrumb i[data-lucide] { width: 12px; height: 12px; opacity: .4; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    .topbar-spacer { flex: 1; }

    .status-badge {
      display: inline-flex; align-items: center; gap: 6px;
      background: #fef3c7; color: #92400e;
      border: 1px solid #fde68a;
      border-radius: 20px; padding: 5px 13px;
      font-size: 12px; font-weight: 700;
    }
    .status-badge svg,
    .status-badge i[data-lucide] { width: 13px; height: 13px; color: var(--amber); }

    /* ── Page body ── */
    .page-body {
      max-width: 860px;
      margin: 0 auto;
      padding: 32px 32px 80px;
      flex: 1;
    }

    /* ── Page header banner ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 28px 32px;
      color: #fff;
      margin-bottom: 20px;
      position: relative; overflow: hidden;
      display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
    }
    .page-header::before {
      content: '';
      position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: '';
      position: absolute; bottom: -60px; right: 120px;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(255,255,255,.04);
    }
    .page-header-content { position: relative; z-index: 1; }
    .page-header-eyebrow {
      font-size: 10px; font-weight: 700; letter-spacing: .14em;
      text-transform: uppercase; color: var(--emerald);
      margin-bottom: 8px;
      display: flex; align-items: center; gap: 8px;
    }
    .page-header-eyebrow::before {
      content: ''; display: inline-block;
      width: 18px; height: 2px;
      background: var(--emerald); border-radius: 2px;
    }
    .page-header-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 24px; margin-bottom: 6px;
    }
    .page-header-content p { font-size: 13px; opacity: .7; margin-bottom: 14px; }
    .app-id-tag {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.1);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: 8px; padding: 5px 12px;
      font-size: 12px; font-weight: 600; color: rgba(255,255,255,.8);
    }
    .app-id-tag svg,
    .app-id-tag i[data-lucide] { width: 12px; height: 12px; color: var(--emerald); }

    .page-header-right { position: relative; z-index: 1; flex-shrink: 0; }
    .pending-pill {
      display: inline-flex; align-items: center; gap: 6px;
      background: #fef3c7; color: #92400e;
      border: 1px solid #fde68a;
      border-radius: 20px; padding: 6px 14px;
      font-size: 12px; font-weight: 700;
    }
    .pending-pill svg,
    .pending-pill i[data-lucide] { width: 13px; height: 13px; color: var(--amber); }

    /* ── Action row ── */
    .action-row {
      display: flex; align-items: center; gap: 10px;
      margin-bottom: 24px; flex-wrap: wrap;
    }
    .action-btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 9px 16px; border-radius: 10px;
      font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      text-decoration: none;
      transition: background .2s, transform .1s;
      white-space: nowrap;
    }
    .action-btn:active { transform: scale(.97); }
    .action-btn svg,
    .action-btn i[data-lucide] { width: 14px; height: 14px; }

    .action-btn.primary { background: var(--forest); color: #fff; }
    .action-btn.primary:hover { background: var(--forest-mid); }
    .action-btn.ghost {
      background: var(--white); color: var(--ink);
      border: 1.5px solid var(--border);
    }
    .action-btn.ghost:hover { border-color: #9ca3af; background: #f9fafb; }

    /* ── Section label ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* ── Card ── */
    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 20px;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }

    .card-head {
      padding: 18px 24px;
      display: flex; align-items: center; gap: 12px;
      border-bottom: 1px solid var(--border);
    }
    .card-head-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .card-head-icon svg,
    .card-head-icon i[data-lucide] { width: 18px; height: 18px; color: var(--forest-mid); }
    .card-head-title { font-size: 15px; font-weight: 700; color: var(--ink); }
    .card-head-sub   { font-size: 12px; color: var(--muted); margin-top: 1px; }

    .card-body { padding: 22px 24px; }

    /* ── Info grid ── */
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }
    .info-grid .span2 { grid-column: 1 / -1; }

    .info-cell {
      background: var(--sand);
      border: 1px solid #eaf3ea;
      border-radius: 10px;
      padding: 13px 16px;
      transition: border-color .15s, background .15s;
    }
    .info-cell:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .info-cell .lbl {
      font-size: 10px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .07em;
      color: var(--muted); margin-bottom: 5px;
    }
    .info-cell .data {
      font-size: 13px; color: var(--ink);
      font-weight: 600; line-height: 1.4;
    }
    .info-cell .data.highlight { color: var(--forest-mid); font-size: 14px; }

    /* ── Form grid ── */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .form-grid .span2 { grid-column: 1 / -1; }

    .field-wrap { display: flex; flex-direction: column; gap: 5px; }
    .field-wrap .lbl {
      font-size: 12px; font-weight: 600; color: #374151;
    }
    .field-wrap .lbl .req { color: var(--rose); }
    .field-wrap .hint {
      font-size: 11px; color: var(--muted); margin-top: 3px;
      display: flex; align-items: center; gap: 4px;
    }
    .field-wrap .hint svg,
    .field-wrap .hint i[data-lucide] { width: 10px; height: 10px; }
    .field-wrap .hint strong { color: var(--forest); }

    .field {
      width: 100%; padding: 9px 13px;
      border: 1.5px solid var(--border);
      border-radius: 9px; font-size: 13px;
      background: var(--white); color: var(--ink);
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color .15s, box-shadow .15s;
    }
    .field:focus { border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.1); }
    .field.readonly { background: #f9fafb; color: var(--muted); cursor: default; }
    .field.err { border-color: #f87171; box-shadow: 0 0 0 3px rgba(248,113,113,.12); }

    /* ── Approval bar ── */
    .approval-bar {
      background: linear-gradient(90deg, #f0fdf4, var(--white));
      border-top: 1px solid var(--sage);
      padding: 16px 24px;
      display: flex; justify-content: space-between; align-items: center;
      flex-wrap: wrap; gap: 12px;
    }
    .approval-note {
      font-size: 12px; color: var(--muted);
      display: flex; align-items: center; gap: 6px;
    }
    .approval-note svg,
    .approval-note i[data-lucide] { width: 13px; height: 13px; color: var(--amber); }

    .approve-btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 11px 24px; border-radius: 10px;
      background: var(--forest); color: #fff;
      font-size: 14px; font-weight: 700;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: background .2s, transform .1s, box-shadow .2s;
      box-shadow: 0 4px 14px rgba(13,74,47,.3);
    }
    .approve-btn:hover { background: var(--forest-mid); transform: translateY(-1px); box-shadow: 0 8px 20px rgba(13,74,47,.35); }
    .approve-btn:active { transform: scale(.98); }
    .approve-btn svg,
    .approve-btn i[data-lucide] { width: 16px; height: 16px; }

    /* ── Tabs ── */
    .tab-bar {
      display: flex; gap: 4px;
      border-bottom: 2px solid var(--border);
      margin-bottom: 20px; flex-wrap: wrap;
    }
    .tab-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 9px 14px; border-radius: 8px 8px 0 0;
      font-size: 13px; font-weight: 600;
      cursor: pointer; border: none; background: none;
      color: var(--muted);
      font-family: 'DM Sans', sans-serif;
      transition: color .15s, background .15s;
      border-bottom: 2px solid transparent; margin-bottom: -2px;
    }
    .tab-btn:hover { color: var(--forest); background: #f0fdf4; }
    .tab-btn.active { color: var(--forest); border-bottom-color: var(--emerald); background: #f0fdf4; }
    .tab-icon {
      width: 22px; height: 22px; border-radius: 6px;
      background: var(--sage); color: var(--forest-mid);
      display: flex; align-items: center; justify-content: center;
    }
    .tab-icon svg,
    .tab-icon i[data-lucide] { width: 11px; height: 11px; }
    .tab-btn.active .tab-icon { background: var(--forest); color: #fff; }

    .tab-panel { display: none; }
    .tab-panel.active {
      display: block;
      animation: tabIn .24s ease both;
    }
    @keyframes tabIn {
      from { opacity: 0; transform: translateX(8px); }
      to   { opacity: 1; transform: translateX(0); }
    }

    .tab-footer {
      display: flex; justify-content: space-between; align-items: center;
      padding-top: 16px; border-top: 1px solid var(--border); margin-top: 4px;
    }
    .tab-counter { font-size: 12px; color: var(--muted); font-weight: 600; }
    .tab-counter span { color: var(--forest-mid); font-weight: 700; }
    .tab-nav { display: flex; gap: 8px; }

    /* ── Guarantor block ── */
    .g-block {
      border: 1px solid #e5f0e5;
      border-radius: 12px; padding: 18px 20px;
      margin-bottom: 14px; background: var(--sand);
    }
    .g-block:last-child { margin-bottom: 0; }
    .g-block-head {
      display: flex; align-items: center; gap: 10px;
      margin-bottom: 16px;
    }
    .g-number {
      width: 24px; height: 24px; border-radius: 50%;
      background: var(--forest); color: #fff;
      font-size: 11px; font-weight: 700;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .g-label { font-size: 14px; font-weight: 700; color: var(--forest); }

    /* ── ID image ── */
    .id-wrap { margin-top: 4px; }
    .id-wrap .id-lbl {
      font-size: 10px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .07em; color: var(--forest-mid); margin-bottom: 8px;
      display: flex; align-items: center; gap: 6px;
    }
    .id-wrap .id-lbl svg,
    .id-wrap .id-lbl i[data-lucide] { width: 12px; height: 12px; }
    .id-img {
      max-width: 320px; width: 100%;
      border-radius: 10px; border: 2px solid var(--sage);
      background: var(--white); padding: 4px;
      box-shadow: 0 3px 10px rgba(0,0,0,.08);
      display: block;
    }

    /* ── Modal ── */
    .modal-overlay {
      display: none;
      position: fixed; inset: 0;
      background: rgba(0,0,0,.5);
      backdrop-filter: blur(4px);
      z-index: 200;
      align-items: center; justify-content: center;
      padding: 20px;
    }
    .modal-overlay.open { display: flex; }

    .modal {
      background: var(--white);
      border-radius: 16px;
      width: 100%; max-width: 400px;
      box-shadow: 0 24px 64px rgba(0,0,0,.2);
      overflow: hidden;
      animation: popIn .22s ease;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(8px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }

    .modal-top {
      background: var(--forest);
      padding: 20px 24px;
      display: flex; justify-content: space-between; align-items: center;
    }
    .modal-top h3 {
      font-family: 'Playfair Display', serif;
      color: #fff; font-size: 17px; font-weight: 700;
    }
    .modal-close {
      width: 30px; height: 30px; border-radius: 8px;
      background: rgba(255,255,255,.1); border: none;
      color: rgba(255,255,255,.7); cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background .15s;
    }
    .modal-close:hover { background: rgba(255,255,255,.2); color: #fff; }
    .modal-close svg,
    .modal-close i[data-lucide] { width: 14px; height: 14px; }

    .modal-body { padding: 16px; display: flex; flex-direction: column; gap: 10px; }

    .modal-opt {
      display: flex; align-items: center; gap: 14px;
      padding: 16px; border-radius: 12px;
      border: 1.5px solid var(--border);
      cursor: pointer; text-decoration: none;
      background: var(--sand);
      transition: border-color .15s, background .15s, transform .15s;
    }
    .modal-opt:hover { border-color: var(--emerald); background: #f0fdf4; transform: translateX(4px); }
    .modal-opt-icon {
      width: 40px; height: 40px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .modal-opt-icon svg,
    .modal-opt-icon i[data-lucide] { width: 18px; height: 18px; }
    .modal-opt-icon.green { background: #dcfce7; color: var(--forest-mid); }
    .modal-opt-icon.blue  { background: #dbeafe; color: #2563eb; }
    .modal-opt-title { font-size: 14px; font-weight: 700; color: var(--ink); }
    .modal-opt-sub   { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .modal-opt-arrow { margin-left: auto; flex-shrink: 0; }
    .modal-opt-arrow svg,
    .modal-opt-arrow i[data-lucide] { width: 14px; height: 14px; color: #d1d5db; }

    /* ── Computation panel ── */
    .comp-panel {
      grid-column: 1 / -1;
      background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
      border: 1.5px solid #bbf7d0;
      border-radius: 14px;
      padding: 20px;
      margin: 4px 0;
    }
    .comp-panel-head {
      display: flex; align-items: center; gap: 10px;
      margin-bottom: 16px;
    }
    .comp-panel-head-icon {
      width: 32px; height: 32px; border-radius: 8px;
      background: var(--forest); color: #fff;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .comp-panel-head-icon svg,
    .comp-panel-head-icon i[data-lucide] { width: 15px; height: 15px; }
    .comp-panel-head-title { font-size: 13px; font-weight: 700; color: var(--forest); }
    .comp-panel-head-sub   { font-size: 11px; color: var(--muted); }

    .comp-controls {
      display: grid; grid-template-columns: 1fr 1fr 1fr;
      gap: 12px; margin-bottom: 16px;
    }
    @media (max-width: 680px) { .comp-controls { grid-template-columns: 1fr 1fr; } }

    .comp-field-wrap { display: flex; flex-direction: column; gap: 4px; }
    .comp-field-wrap .lbl { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); }
    .comp-field {
      width: 100%; padding: 8px 12px;
      border: 1.5px solid #a7f3d0;
      border-radius: 9px; font-size: 13px;
      background: var(--white); color: var(--ink);
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color .15s, box-shadow .15s;
    }
    .comp-field:focus { border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.1); }

    /* Method toggle */
    .method-toggle {
      display: flex; gap: 4px;
      background: rgba(255,255,255,.7);
      border: 1.5px solid #a7f3d0;
      border-radius: 9px; padding: 4px;
    }
    .method-btn {
      flex: 1; padding: 6px 10px;
      border-radius: 7px; border: none; cursor: pointer;
      font-size: 11px; font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      color: var(--muted); background: transparent;
      transition: background .15s, color .15s;
      white-space: nowrap;
    }
    .method-btn.active { background: var(--forest); color: #fff; }

    /* Result display */
    .comp-result {
      background: var(--white);
      border: 1px solid #d1fae5;
      border-radius: 12px;
      overflow: hidden;
    }
    .comp-result-row {
      display: flex; justify-content: space-between; align-items: center;
      padding: 11px 16px;
      border-bottom: 1px solid #f0fdf4;
      font-size: 13px;
    }
    .comp-result-row:last-child { border-bottom: none; }
    .comp-result-row .r-label { color: var(--muted); font-weight: 500; display: flex; align-items: center; gap: 6px; }
    .comp-result-row .r-label svg,
    .comp-result-row .r-label i[data-lucide] { width: 13px; height: 13px; }
    .comp-result-row .r-value { font-weight: 700; color: var(--ink); }
    .comp-result-row.highlight-row { background: #f0fdf4; }
    .comp-result-row.highlight-row .r-label { color: var(--forest); font-weight: 700; }
    .comp-result-row.highlight-row .r-value { color: var(--forest-mid); font-size: 15px; }
    .comp-result-row.amort-row .r-value { color: var(--sky); }

    .comp-use-btn {
      width: 100%; margin-top: 12px;
      padding: 10px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer;
      font-size: 13px; font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      display: flex; align-items: center; justify-content: center; gap: 7px;
      transition: background .2s, transform .1s;
    }
    .comp-use-btn:hover { background: var(--forest-mid); transform: translateY(-1px); }
    .comp-use-btn:active { transform: scale(.98); }
    .comp-use-btn svg,
    .comp-use-btn i[data-lucide] { width: 15px; height: 15px; }

    .comp-empty {
      text-align: center; padding: 20px;
      color: var(--muted); font-size: 13px;
    }
    .comp-empty svg,
    .comp-empty i[data-lucide] { width: 28px; height: 28px; opacity: .3; display: block; margin: 0 auto 8px; }

    /* ── Footer ── */
    .page-footer {
      text-align: center; padding: 20px 32px;
      color: #9ca3af; font-size: 12px;
      border-top: 1px solid var(--border);
      background: var(--white);
    }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 5px; }

    /* ── Confirmation Modals ── */
    .modal-h { font-size: 18px; font-weight: 700; text-align: center; margin-bottom: 6px; font-family: 'Playfair Display', serif; }
    .modal-p { font-size: 13px; color: var(--muted); text-align: center; margin-bottom: 22px; line-height: 1.5; }
    .modal-btns { display: flex; gap: 10px; justify-content: center; }
    .modal-btn {
      flex: 1; padding: 11px; border-radius: 10px;
      font-size: 14px; font-weight: 600; text-align: center;
      border: none; cursor: pointer; text-decoration: none;
      transition: background .2s, transform .1s; font-family: 'DM Sans', sans-serif;
    }
    .modal-btn:active { transform: scale(0.97); }
    .modal-btn.cancel { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover { background: #e5e7eb; }
    .modal-btn.danger { background: var(--rose); color: #fff; }
    .modal-btn.danger:hover { background: #dc2626; }
    .modal-btn.success { background: var(--emerald); color: #fff; }
    .modal-btn.success:hover { background: #16a34a; }

    /* ── Responsive ── */
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar { padding: 12px 16px; }
      .page-body { padding: 20px 16px 60px; }
      .info-grid, .form-grid { grid-template-columns: 1fr; }
      .info-grid .span2, .form-grid .span2 { grid-column: 1; }
    }
  
    /* RESPONSIVE INJECT */
    .mobile-toggle { display: none; }
    .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 99; }
    .sidebar-overlay.show { display: block; }
    @media (max-width: 900px) {
      :root { --sidebar-w: 0px !important; }
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; width: 260px !important; z-index: 100 !important; }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0 !important; width: 100% !important; min-width: 100vw; overflow-x: hidden; }
      .mobile-toggle { display: flex !important; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; border: none; background: #f3f4f6; color: var(--ink); cursor: pointer; position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 60; }
      .topbar { padding-left: 56px !important; padding-right: 14px !important; position: relative !important; }
      .tables-grid, .stats-grid, .loan-grid, .kpi-strip, .form-grid { grid-template-columns: 1fr !important; }
      .page-body { padding: 16px !important; }
      .hide-mobile { display: none !important; }
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
    <a href="{{route('LoanApp.list')}}" class="nav-item active">
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
    <a href="{{ route('Admin.Settings') }}" class="nav-item">
      <i data-lucide="settings"></i> Settings
    </a>

    <div class="nav-section-label">On This Page</div>
    <div class="nav-section-jump">
      <a href="#sec-terms"   class="jump-item lit" data-sec="sec-terms">
        <span class="jump-dot"></span> Loan Terms
      </a>
      <a href="#sec-details" class="jump-item"     data-sec="sec-details">
        <span class="jump-dot"></span> Applicant Details
      </a>
    </div>
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
      <a href="{{ route('Admin.Logout') }}" class="dropdown-item danger">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  
<div class="sidebar-overlay" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebar-overlay').classList.remove('show');"></div>
<header class="topbar">
  <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');">
    <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
  </button>
    <a href="{{ route('LoanApp.list') }}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="breadcrumb">
      <a href="{{ route('LoanApp.list') }}">Loan Applications</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">Review #{{$Review->id}}</span>
    </div>
    <div class="topbar-spacer"></div>
    <div class="status-badge">
      <i data-lucide="clock"></i> Pending Review
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Page header -->
    <div class="page-header" id="page-top">
      <div class="page-header-content">
        <div class="page-header-eyebrow">Application Review</div>
        <h2>Loan Application</h2>
        <p>Review all details carefully before approving this loan.</p>
        <div class="app-id-tag">
          <i data-lucide="hash"></i> Application ID: {{$Review->id}}
        </div>
      </div>
      <div class="page-header-right">
        <div class="pending-pill">
          <i data-lucide="clock"></i> Pending Review
        </div>
      </div>
    </div>

    <!-- Action row -->
    <div class="action-row">
      <button onclick="openHistoryModal()" class="action-btn primary">
        <i data-lucide="history"></i> Previous Record
      </button>
      <a href="{{ route('LoanApp.list') }}" class="action-btn ghost">
        <i data-lucide="arrow-left"></i> Back to List
      </a>
    </div>

    <!-- ── Validation errors ── -->
    @if ($errors->any())
      <div class="card" style="margin-bottom:20px; border-color:var(--rose); background:#fef2f2;">
        <div class="card-body">
          <div style="display:flex;align-items:flex-start;gap:10px;">
            <div style="width:36px;height:36px;border-radius:10px;background:#fecaca;color:var(--rose);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i data-lucide="alert-circle" style="width:18px;height:18px;"></i>
            </div>
            <div>
              <strong style="font-size:14px;color:var(--ink);">Please fix the following before approving:</strong>
              <ul style="margin:10px 0 0 18px;padding:0;font-size:13px;color:#b91c1c;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
      <script>document.addEventListener('DOMContentLoaded', function(){ lucide.createIcons(); });</script>
    @endif

    <!-- ── FORM ── -->
    <form action="{{ route('Loan.Approval') }}" method="POST" enctype="multipart/form-data" id="approvalForm">
      @csrf
      <input type="hidden" name="id"          value="{{$Review->id}}">
      <input type="hidden" name="last_name"   value="{{$Review->last_name}}">
      <input type="hidden" name="first_name"  value="{{$Review->first_name}}">
      <input type="hidden" name="middle_name" value="{{$Review->middle_name}}">
      <input type="hidden" id="loan_number_hidden">

      <!-- ① Loan Terms -->
      <div class="section-label">Approval Fields</div>
      <div class="card" id="sec-terms">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="file-signature"></i></div>
          <div>
            <div class="card-head-title">Loan Terms &amp; Approval</div>
            <div class="card-head-sub">Fill in the required approval fields below</div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-grid">
            <div class="field-wrap">
              <label class="lbl">Loan Number</label>
              <input type="text" name="loan_number" id="loan_number" class="field readonly" readonly
                value="{{ old('loan_number', '') }}"
                style="font-weight:700; color:var(--forest); letter-spacing:.5px;">
              <span class="hint">
                <i data-lucide="lock"></i> Auto-generated &amp; fixed for this application.
              </span>
            </div>
            <div class="field-wrap">
              <label class="lbl">Loan Term <span class="req">*</span></label>
              <select name="loan_term" id="loan_term" required class="field {{ $errors->has('loan_term') ? 'err' : '' }}" onchange="runComputation()">
                <option value="" disabled>Select loan term</option>
                @php $term = old('loan_term', $Review->loan_term); @endphp
                <option value="3 Months"  {{ $term == '3' || $term == '3 Months'  ? 'selected' : '' }}>3 Months</option>
                <option value="6 Months"  {{ $term == '6' || $term == '6 Months'  ? 'selected' : '' }}>6 Months</option>
                <option value="9 Months"  {{ $term == '9' || $term == '9 Months'  ? 'selected' : '' }}>9 Months</option>
                <option value="12 Months" {{ $term == '12' || $term == '12 Months' ? 'selected' : '' }}>12 Months</option>
              </select>
              <span class="hint">Applicant requested: <strong>{{ $Review->loan_term }}</strong></span>
            </div>
            <div class="field-wrap">
              <label class="lbl">Loan Amount Granted <span class="req">*</span></label>
              <input type="number" name="loan_amount" id="inp_loan_amount" required class="field {{ $errors->has('loan_amount') ? 'err' : '' }}" placeholder="0.00" min="0" step="0.01" value="{{ old('loan_amount', $Review->loan_amount) }}" oninput="runComputation()">
            </div>
            <div class="field-wrap">
              <label class="lbl">Due Amount <span class="req">*</span></label>
              <input type="number" name="due_amount" id="inp_due_amount" required class="field {{ $errors->has('due_amount') ? 'err' : '' }}" placeholder="Auto-computed" min="0" step="0.01" value="{{ old('due_amount') }}">
              <input type="hidden" name="interest_rate" id="inp_interest_rate" value="">
              <span class="hint"><i data-lucide="calculator"></i> Auto-filled by tiered compound interest (by loan amount). Use calculator below.</span>
            </div>

            <!-- ── Interest Computation Panel ── -->
            <div class="comp-panel span2">
              <div class="comp-panel-head">
                <div class="comp-panel-head-icon"><i data-lucide="percent"></i></div>
                <div>
                  <div class="comp-panel-head-title">Interest Computation</div>
                  <div class="comp-panel-head-sub">Adjust rate &amp; method — Due Amount is auto-filled</div>
                </div>
              </div>

              <div class="comp-controls">
                <!-- Interest rate -->
                <div class="comp-field-wrap">
                  <div class="lbl">Interest Rate / Month</div>
                  <select id="comp_rate" class="comp-field" onchange="runComputation()">
                    <option value="0.5">0.50% &mdash; Socialized / Emergency</option>
                    <option value="0.83">0.83% &mdash; Housing / Long-term</option>
                    <option value="1.0" selected>1.00% &mdash; Standard Coop Rate</option>
                    <option value="1.25">1.25% &mdash; Regular Multi-purpose</option>
                    <option value="1.5">1.50% &mdash; Commercial</option>
                    <option value="2.0">2.00% &mdash; Short-term / Petty Cash</option>
                    <option value="custom">Custom rate…</option>
                  </select>
                </div>

                <!-- Custom rate (hidden by default) -->
                <div class="comp-field-wrap" id="comp_custom_wrap" style="display:none;">
                  <div class="lbl">Custom Rate (%/month)</div>
                  <input type="number" id="comp_custom_rate" class="comp-field" placeholder="e.g. 1.75" min="0.01" max="10" step="0.01" oninput="runComputation()">
                </div>

                <!-- Service fee -->
                <div class="comp-field-wrap">
                  <div class="lbl">Service Fee</div>
                  <select id="comp_service_fee" class="comp-field" onchange="runComputation()">
                    <option value="0">None</option>
                    <option value="0.5">0.5% of principal</option>
                    <option value="1">1.0% of principal</option>
                    <option value="2">2.0% of principal</option>
                  </select>
                </div>

                <!-- Computation method -->
                <div class="comp-field-wrap">
                  <div class="lbl">Method</div>
                  <div class="method-toggle">
                    <button type="button" class="method-btn active" id="btn_compound" onclick="setMethod('compound')">Compound (tiered)</button>
                    <button type="button" class="method-btn" id="btn_straight" onclick="setMethod('straight')">Straight-line</button>
                    <button type="button" class="method-btn" id="btn_diminish" onclick="setMethod('diminish')">Diminishing</button>
                  </div>
                  <span class="hint" style="font-size:11px;margin-top:4px;">Compound (tiered): rate by loan amount, monthly compounding — used on approval.</span>
                </div>
              </div>

              <!-- Results -->
              <div class="comp-result" id="comp_result">
                <div class="comp-empty">
                  <i data-lucide="calculator"></i>
                  Enter a loan amount and term to see the breakdown.
                </div>
              </div>

              <button type="button" class="comp-use-btn" id="comp_use_btn" onclick="applyComputation()" style="display:none;">
                <i data-lucide="circle-check-big"></i> Use This Computation — Fill Due Amount
              </button>
            </div>
            <div class="field-wrap">
              <label class="lbl">Payment Frequency <span class="req">*</span></label>
              <select name="frequency_of_payment" required class="field {{ $errors->has('frequency_of_payment') ? 'err' : '' }}">
                <option value="" disabled>Select frequency</option>
                @php $freq = old('frequency_of_payment'); @endphp
                <option value="Daily" {{ $freq == 'Daily' ? 'selected' : '' }}>Daily</option>
                <option value="Weekly" {{ $freq == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="Monthly" {{ $freq == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="Quarterly" {{ $freq == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                <option value="Yearly" {{ $freq == 'Yearly' ? 'selected' : '' }}>Yearly</option>
              </select>
            </div>
            <div class="field-wrap">
              <label class="lbl">Payment Start Date <span class="req">*</span></label>
              <input type="date" name="payment_start_date" required class="field {{ $errors->has('payment_start_date') ? 'err' : '' }}" value="{{ old('payment_start_date') }}">
            </div>
            <div class="field-wrap">
              <label class="lbl">Approved By <span class="req">*</span></label>
              <input type="text" name="approved_by" required class="field {{ $errors->has('approved_by') ? 'err' : '' }}" placeholder="Full name of approver" value="{{ old('approved_by') }}">
            </div>
            <div class="field-wrap">
              <label class="lbl">Encoded By <span class="req">*</span></label>
              <input type="text" name="encoded_by" required class="field {{ $errors->has('encoded_by') ? 'err' : '' }}" placeholder="Full name of encoder" value="{{ old('encoded_by') }}">
            </div>
          </div>
        </div>
        <div class="approval-bar">
          <span class="approval-note">
            <i data-lucide="info"></i>
            Fields marked <strong style="color:var(--rose);">*</strong> are required before approval.
          </span>
          <div style="display:flex; gap:12px; align-items:center;">
            <button type="button" class="approve-btn" style="background:#fee2e2; color:#991b1b; border:1px solid #f87171;" onclick="openRejectModal()">
              <i data-lucide="x-circle"></i> Reject Application
            </button>
            <button type="button" class="approve-btn" style="background:#fff7ed; color:#c2410c; border:1px solid #fdba74;" onclick="openNotifyModal()">
              <i data-lucide="bell"></i> Send Revision Notification
            </button>
            <button type="button" class="approve-btn" onclick="openApproveModal()">
              <i data-lucide="circle-check-big"></i> Approve Loan Application
            </button>
          </div>
        </div>
      </div>

      <!-- ② Applicant Details (tabbed) -->
      <div class="section-label">Applicant Information</div>
      <div class="card" id="sec-details">
        <div class="card-head">
          <div class="card-head-icon"><i data-lucide="folder-open"></i></div>
          <div>
            <div class="card-head-title">Applicant Details</div>
            <div class="card-head-sub">Browse all applicant information using the tabs below</div>
          </div>
        </div>
        <div class="card-body">

          <!-- Tab buttons -->
          <div class="tab-bar">
            <button type="button" class="tab-btn active" data-tab="tab-personal" onclick="switchTab(this)">
              <span class="tab-icon"><i data-lucide="user" style="width:11px;height:11px;"></i></span> Personal Info
            </button>
            <button type="button" class="tab-btn" data-tab="tab-address" onclick="switchTab(this)">
              <span class="tab-icon"><i data-lucide="map-pin" style="width:11px;height:11px;"></i></span> Home Address
            </button>
            <button type="button" class="tab-btn" data-tab="tab-guarantors" onclick="switchTab(this)">
              <span class="tab-icon"><i data-lucide="shield-check" style="width:11px;height:11px;"></i></span> Guarantors
            </button>
            <button type="button" class="tab-btn" data-tab="tab-employment" onclick="switchTab(this)">
              <span class="tab-icon"><i data-lucide="briefcase" style="width:11px;height:11px;"></i></span> Employment
            </button>
            <button type="button" class="tab-btn" data-tab="tab-loan" onclick="switchTab(this)">
              <span class="tab-icon"><i data-lucide="coins" style="width:11px;height:11px;"></i></span> Loan Details
            </button>
          </div>

          <!-- Tab: Personal Info -->
          <div class="tab-panel active" id="tab-personal">
            <div class="info-grid">
              <div class="info-cell span2">
                <div class="lbl">Full Name</div>
                <div class="data">{{$Review->last_name}}, {{$Review->first_name}} {{$Review->middle_name}}</div>
              </div>
              <div class="info-cell"><div class="lbl">Birth Date</div><div class="data">{{$Review->birthdate}}</div></div>
              <div class="info-cell"><div class="lbl">Place of Birth</div><div class="data">{{$Review->place_of_birth}}</div></div>
              <div class="info-cell"><div class="lbl">Age</div><div class="data">{{$Review->age}}</div></div>
              <div class="info-cell"><div class="lbl">Gender</div><div class="data">{{$Review->gender}}</div></div>
              <div class="info-cell"><div class="lbl">Religion</div><div class="data">{{$Review->religion}}</div></div>
              <div class="info-cell"><div class="lbl">Nationality</div><div class="data">{{$Review->nationality}}</div></div>
              <div class="info-cell"><div class="lbl">Civil Status</div><div class="data">{{$Review->civil_status}}</div></div>
              <div class="info-cell"><div class="lbl">Email Address</div><div class="data">{{$Review->email}}</div></div>
              <div class="info-cell"><div class="lbl">Contact Number</div><div class="data">{{$Review->contact_number}}</div></div>
            </div>
            <div class="tab-footer">
              <span class="tab-counter">Tab <span>1</span> of 5</span>
              <div class="tab-nav">
                <button type="button" class="action-btn primary" onclick="nextTab()">Home Address <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
              </div>
            </div>
          </div>

          <!-- Tab: Home Address -->
          <div class="tab-panel" id="tab-address">
            <div class="info-grid">
              <div class="info-cell span2"><div class="lbl">Street Address</div><div class="data">{{$Review->street_address}}</div></div>
              <div class="info-cell"><div class="lbl">Province</div><div class="data">{{$Review->province}}</div></div>
              <div class="info-cell"><div class="lbl">City / Municipality</div><div class="data">{{$Review->city_municipality}}</div></div>
              <div class="info-cell"><div class="lbl">Barangay</div><div class="data">{{$Review->barangay}}</div></div>
              <div class="info-cell"><div class="lbl">Zip Code</div><div class="data">{{$Review->zip_code}}</div></div>
              <div class="info-cell"><div class="lbl">Years of Stay</div><div class="data">{{$Review->year_of_stay}}</div></div>
              <div class="info-cell"><div class="lbl">House Ownership</div><div class="data">{{$Review->house_ownership}}</div></div>
            </div>
            <div class="tab-footer">
              <span class="tab-counter">Tab <span>2</span> of 5</span>
              <div class="tab-nav">
                <button type="button" class="action-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Personal Info</button>
                <button type="button" class="action-btn primary" onclick="nextTab()">Guarantors <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
              </div>
            </div>
          </div>

          <!-- Tab: Guarantors -->
          <div class="tab-panel" id="tab-guarantors">
            <div class="g-block">
              <div class="g-block-head">
                <div class="g-number">1</div>
                <div class="g-label">First Guarantor</div>
              </div>
              <div class="info-grid">
                <div class="info-cell"><div class="lbl">Full Name</div><div class="data">{{$Review->g1_fullname}}</div></div>
                <div class="info-cell"><div class="lbl">Relationship</div><div class="data">{{$Review->g1_relationship}}</div></div>
                <div class="info-cell"><div class="lbl">Contact Number</div><div class="data">{{$Review->g1_contact_number}}</div></div>
                <div class="info-cell"><div class="lbl">Address</div><div class="data">{{$Review->g1_address}}</div></div>
                <div class="span2 id-wrap">
                  <div class="id-lbl"><i data-lucide="id-card"></i> Valid ID</div>
                  <img src="data:{{ $g1MimeType }};base64,{{ $g1Base64 }}" alt="Guarantor 1 ID" class="id-img">
                </div>
              </div>
            </div>
            <div class="g-block">
              <div class="g-block-head">
                <div class="g-number">2</div>
                <div class="g-label">Second Guarantor</div>
              </div>
              <div class="info-grid">
                <div class="info-cell"><div class="lbl">Full Name</div><div class="data">{{$Review->g2_fullname}}</div></div>
                <div class="info-cell"><div class="lbl">Relationship</div><div class="data">{{$Review->g2_relationship}}</div></div>
                <div class="info-cell"><div class="lbl">Contact Number</div><div class="data">{{$Review->g2_contact_number}}</div></div>
                <div class="info-cell"><div class="lbl">Address</div><div class="data">{{$Review->g2_address}}</div></div>
                <div class="span2 id-wrap">
                  <div class="id-lbl"><i data-lucide="id-card"></i> Valid ID</div>
                  <img src="data:{{ $g2MimeType }};base64,{{ $g2Base64 }}" alt="Guarantor 2 ID" class="id-img">
                </div>
              </div>
            </div>
            <div class="tab-footer">
              <span class="tab-counter">Tab <span>3</span> of 5</span>
              <div class="tab-nav">
                <button type="button" class="action-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Home Address</button>
                <button type="button" class="action-btn primary" onclick="nextTab()">Employment <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
              </div>
            </div>
          </div>

          <!-- Tab: Employment -->
          <div class="tab-panel" id="tab-employment">
            <div class="info-grid">
              <div class="info-cell"><div class="lbl">Employment Type</div><div class="data">{{$Review->employment_type}}</div></div>
              <div class="info-cell"><div class="lbl">Employer / Business Name</div><div class="data">{{$Review->employer_business_name}}</div></div>
              <div class="info-cell"><div class="lbl">Position / Nature of Business</div><div class="data">{{$Review->position_nature_of_business}}</div></div>
              <div class="info-cell"><div class="lbl">Business Address</div><div class="data">{{$Review->employer_business_address}}</div></div>
              <div class="info-cell"><div class="lbl">Monthly Income</div><div class="data highlight">{{$Review->monthly_income}}</div></div>
              <div class="info-cell"><div class="lbl">Years in Service</div><div class="data">{{$Review->year_in_service_operation}}</div></div>
              <div class="span2 id-wrap">
                <div class="id-lbl"><i data-lucide="file-badge"></i> Proof of Income</div>
                <img src="data:{{ $proofMimeType }};base64,{{ $proofBase64 }}" alt="Proof of Income" class="id-img">
              </div>
            </div>
            <div class="tab-footer">
              <span class="tab-counter">Tab <span>4</span> of 5</span>
              <div class="tab-nav">
                <button type="button" class="action-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Guarantors</button>
                <button type="button" class="action-btn primary" onclick="nextTab()">Loan Details <i data-lucide="arrow-right" style="width:14px;height:14px;"></i></button>
              </div>
            </div>
          </div>

          <!-- Tab: Loan Details -->
          <div class="tab-panel" id="tab-loan">
            <div class="info-grid" style="margin-bottom:16px;">
              <div class="info-cell"><div class="lbl">Loan Type</div><div class="data">{{$Review->loan_type}}</div></div>
              <div class="info-cell"><div class="lbl">Amount Requested</div><div class="data highlight">₱ {{number_format($Review->loan_amount, 2)}}</div></div>
              <div class="info-cell span2"><div class="lbl">Purpose of Loan</div><div class="data">{{$Review->purpose_of_loan}}</div></div>
            </div>
            <div style="border-top:1px solid var(--border);padding-top:16px;margin-bottom:16px;">
              <p style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:10px;">Additional Information</p>
              <div class="info-grid">
                <div class="info-cell"><div class="lbl">HR / Contact Person Name</div><div class="data">{{$Review->hr_person_name}}</div></div>
                <div class="info-cell"><div class="lbl">HR / Contact Person Number</div><div class="data">{{$Review->hr_person_number}}</div></div>
              </div>
            </div>
            <div class="tab-footer">
              <span class="tab-counter">Tab <span>5</span> of 5</span>
              <div class="tab-nav">
                <button type="button" class="action-btn ghost" onclick="prevTab()"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Employment</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </form>

  </div><!-- /page-body -->

  <footer class="page-footer">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div><!-- /main -->

<!-- ═══ Reject Modal ═══ -->
<div class="modal-overlay" id="rejectModal">
  <div class="modal" style="max-width: 440px; margin: auto; padding: 32px 24px;">
    <div style="text-align:center;margin-bottom:12px;">
      <i data-lucide="alert-circle" style="width:36px;height:36px;color:#ef4444;"></i>
    </div>
    <h3 class="modal-h">Reject Application</h3>
    <p class="modal-p">Are you sure you want to REJECT this loan application? This action cannot be undone and will notify the member immediately.</p>
    <div class="modal-btns">
      <button type="button" class="modal-btn cancel" onclick="closeRejectModal()">Cancel</button>
      <button type="submit" form="approvalForm" formaction="{{ route('Admin.Loan.Reject') }}" formnovalidate class="modal-btn danger">Yes, Reject Loan</button>
    </div>
  </div>
</div>

<!-- ═══ Approve Modal ═══ -->
<div class="modal-overlay" id="approveModal">
  <div class="modal" style="max-width: 440px; margin: auto; padding: 32px 24px;">
    <div style="text-align:center;margin-bottom:12px;">
      <i data-lucide="check-circle-2" style="width:36px;height:36px;color:var(--emerald);"></i>
    </div>
    <h3 class="modal-h">Approve Application</h3>
    <p class="modal-p">You are about to approve this loan. Have the due amount and terms been verified properly?</p>
    <div class="modal-btns">
      <button type="button" class="modal-btn cancel" onclick="closeApproveModal()">Back</button>
      <button type="submit" form="approvalForm" class="modal-btn success">Yes, Approve</button>
    </div>
  </div>
</div>

<!-- ═══ Notify Modal ═══ -->
<div class="modal-overlay" id="notifyModal">
  <div class="modal" style="max-width: 440px; margin: auto; padding: 32px 24px;">
    <div style="text-align:center;margin-bottom:12px;">
      <i data-lucide="bell-ring" style="width:36px;height:36px;color:#f97316;"></i>
    </div>
    <h3 class="modal-h">Notify Member of Revisions</h3>
    <p class="modal-p">This will save your current adjustments (Loan Amount, Term, etc.) to the pending application and send an in-app notification to the member detailing these changes. Proceed?</p>
    <div class="modal-btns">
      <button type="button" class="modal-btn cancel" onclick="closeNotifyModal()">Cancel</button>
      <button type="submit" form="approvalForm" formaction="{{ route('Admin.Loan.NotifyRevision') }}" formnovalidate class="modal-btn success" style="background:#f97316;">Yes, Notify Member</button>
    </div>
  </div>
</div>

<!-- ═══ History Modal ═══ -->
<div class="modal-overlay" id="historyModal">
  <div class="modal">
    <div class="modal-top">
      <h3>View Previous Records</h3>
      <button class="modal-close" onclick="closeHistoryModal()"><i data-lucide="x"></i></button>
    </div>
    <div class="modal-body">
      <button onclick="viewSharedCapitalHistory()" class="modal-opt">
        <div class="modal-opt-icon green"><i data-lucide="coins"></i></div>
        <div>
          <div class="modal-opt-title">Shared Capital History</div>
          <div class="modal-opt-sub">View member's capital contribution records</div>
        </div>
        <div class="modal-opt-arrow"><i data-lucide="chevron-right"></i></div>
      </button>
      <button onclick="viewLoanHistory()" class="modal-opt">
        <div class="modal-opt-icon blue"><i data-lucide="banknote"></i></div>
        <div>
          <div class="modal-opt-title">Loan History</div>
          <div class="modal-opt-sub">View previous loan applications &amp; status</div>
        </div>
        <div class="modal-opt-arrow"><i data-lucide="chevron-right"></i></div>
      </button>
    </div>
  </div>
</div>

<script>
  // Init Lucide icons
  lucide.createIcons();

  // User menu
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // Auto-generate loan number
 (function () {
    const appId  = {{ $Review->id }};
    const year   = new Date().getFullYear();
    const month  = String(new Date().getMonth() + 1).padStart(2, '0');
    const padded = String(appId).padStart(6, '0');
    const lnValue = `LN-${year}${month}-${padded}`;
    document.getElementById('loan_number').value = lnValue;
    document.getElementById('loan_number_hidden').value = lnValue; 
})();

  // ── Tab system ──
  const TAB_ORDER = ['tab-personal','tab-address','tab-guarantors','tab-employment','tab-loan'];

  function switchTab(btn) {
    const target = btn.dataset.tab;
    document.querySelectorAll('.tab-btn').forEach(b   => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(target).classList.add('active');
    lucide.createIcons();
  }

  function nextTab() {
    const active = document.querySelector('.tab-panel.active');
    const idx = TAB_ORDER.indexOf(active.id);
    if (idx < TAB_ORDER.length - 1) {
      switchTab(document.querySelector(`.tab-btn[data-tab="${TAB_ORDER[idx+1]}"]`));
      document.getElementById('sec-details').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  function prevTab() {
    const active = document.querySelector('.tab-panel.active');
    const idx = TAB_ORDER.indexOf(active.id);
    if (idx > 0) {
      switchTab(document.querySelector(`.tab-btn[data-tab="${TAB_ORDER[idx-1]}"]`));
      document.getElementById('sec-details').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  // ── Jump nav highlight on scroll ──
  const sections  = document.querySelectorAll('#sec-terms, #sec-details');
  const jumpItems = document.querySelectorAll('.jump-item');
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        jumpItems.forEach(i => i.classList.remove('lit'));
        const match = document.querySelector(`.jump-item[data-sec="${entry.target.id}"]`);
        if (match) match.classList.add('lit');
      }
    });
  }, { threshold: 0.2, rootMargin: '-60px 0px -40% 0px' });
  sections.forEach(s => obs.observe(s));

  // ── Form validation ──
  document.getElementById('approvalForm').addEventListener('submit', function (e) {
    let valid = true;
    this.querySelectorAll('[required]').forEach(f => {
      if (!f.value.trim()) {
        valid = false;
        f.classList.add('err');
        f.scrollIntoView({ behavior: 'smooth', block: 'center' });
      } else {
        f.classList.remove('err');
      }
    });
    if (!valid) e.preventDefault();
  });

  // ── Interest Computation ──
  let _computedDue = 0;
  let _method = 'compound';
  const INTEREST_TIERS = @json($interestTiers ?? []);

  function setMethod(m) {
    _method = m;
    document.getElementById('btn_compound').classList.toggle('active', m === 'compound');
    document.getElementById('btn_straight').classList.toggle('active', m === 'straight');
    document.getElementById('btn_diminish').classList.toggle('active', m === 'diminish');
    runComputation();
  }

  function getAnnualRateForAmount(amount) {
    for (let i = 0; i < INTEREST_TIERS.length; i++) {
      if (amount <= INTEREST_TIERS[i].max_amount) return parseFloat(INTEREST_TIERS[i].annual_rate);
    }
    return 16;
  }

  document.getElementById('comp_rate').addEventListener('change', function () {
    const isCustom = this.value === 'custom';
    document.getElementById('comp_custom_wrap').style.display = isCustom ? '' : 'none';
    if (!isCustom) runComputation();
  });

  function getMonthsFromTerm(termStr) {
    if (!termStr) return null;
    const m = termStr.match(/(\d+)/);
    return m ? parseInt(m[1]) : null;
  }

  function fmt(n) {
    return '₱ ' + Number(n).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }

  function runComputation() {
    const principal  = parseFloat(document.getElementById('inp_loan_amount').value) || 0;
    const termVal    = document.getElementById('loan_term').value;
    const months     = getMonthsFromTerm(termVal);
    const rateEl     = document.getElementById('comp_rate');
    const feeEl      = document.getElementById('comp_service_fee');
    const resultEl   = document.getElementById('comp_result');
    const useBtn     = document.getElementById('comp_use_btn');

    let rateMonthly;
    if (rateEl.value === 'custom') {
      rateMonthly = parseFloat(document.getElementById('comp_custom_rate').value) / 100 || 0;
    } else {
      rateMonthly = parseFloat(rateEl.value) / 100;
    }

    const feePct = parseFloat(feeEl.value) / 100;

    if (!principal || !months) {
      resultEl.innerHTML = `<div class="comp-empty"><i data-lucide="calculator"></i>Enter loan amount and term to see the breakdown.</div>`;
      lucide.createIcons();
      useBtn.style.display = 'none';
      return;
    }
    if (_method !== 'compound' && !rateMonthly) {
      resultEl.innerHTML = `<div class="comp-empty"><i data-lucide="calculator"></i>Select an interest rate.</div>`;
      lucide.createIcons();
      useBtn.style.display = 'none';
      return;
    }

    const serviceFee = principal * feePct;
    let totalInterest, totalDue, amortization, rows;

    if (_method === 'compound') {
      // Tiered compound: rate by loan amount, A = P(1 + r/12)^months
      const annualRate = getAnnualRateForAmount(principal);
      const r = annualRate / 100;
      totalDue = principal * Math.pow(1 + r / 12, months);
      totalInterest = totalDue - principal;
      totalDue += serviceFee;
      _computedDue = totalDue;
      const amortization = totalDue / months;
      rows = `
        <div class="comp-result-row">
          <span class="r-label"><i data-lucide="banknote"></i> Principal</span>
          <span class="r-value">${fmt(principal)}</span>
        </div>
        <div class="comp-result-row">
          <span class="r-label"><i data-lucide="percent"></i> Rate (tier)</span>
          <span class="r-value" style="color:#0284c7;">${annualRate.toFixed(1)}% p.a.</span>
        </div>
        <div class="comp-result-row">
          <span class="r-label"><i data-lucide="percent"></i> Total Interest (compound)</span>
          <span class="r-value" style="color:#d97706;">${fmt(totalInterest)}</span>
        </div>
        ${serviceFee > 0 ? `<div class="comp-result-row"><span class="r-label"><i data-lucide="receipt"></i> Service Fee</span><span class="r-value" style="color:#9333ea;">${fmt(serviceFee)}</span></div>` : ''}
        <div class="comp-result-row highlight-row">
          <span class="r-label"><i data-lucide="circle-dollar-sign"></i> Total Due Amount</span>
          <span class="r-value">${fmt(totalDue)}</span>
        </div>
        <div class="comp-result-row amort-row">
          <span class="r-label"><i data-lucide="calendar-days"></i> Est. per period</span>
          <span class="r-value">${fmt(amortization)}</span>
        </div>
        <div class="comp-result-row" style="background:#e0f2fe;">
          <span class="r-label" style="font-size:11px;opacity:.7;">Method: Compound (monthly), rate by loan amount tier</span>
          <span class="r-value" style="font-size:11px;color:#0284c7;">Coop tiered</span>
        </div>`;
      const irEl = document.getElementById('inp_interest_rate');
      if (irEl) irEl.value = annualRate.toFixed(2);
    } else if (_method === 'straight') {
      // Straight-line: interest = principal × rate × months (flat)
      totalInterest = principal * rateMonthly * months;
      totalDue      = principal + totalInterest + serviceFee;
      amortization  = totalDue / months;
      rows = `
        <div class="comp-result-row">
          <span class="r-label"><i data-lucide="banknote"></i> Principal</span>
          <span class="r-value">${fmt(principal)}</span>
        </div>
        <div class="comp-result-row">
          <span class="r-label"><i data-lucide="percent"></i> Total Interest (${(rateMonthly*100).toFixed(2)}%/mo × ${months}mo)</span>
          <span class="r-value" style="color:#d97706;">${fmt(totalInterest)}</span>
        </div>
        ${serviceFee > 0 ? `<div class="comp-result-row"><span class="r-label"><i data-lucide="receipt"></i> Service Fee (${(feePct*100)}%)</span><span class="r-value" style="color:#9333ea;">${fmt(serviceFee)}</span></div>` : ''}
        <div class="comp-result-row highlight-row">
          <span class="r-label"><i data-lucide="circle-dollar-sign"></i> Total Due Amount</span>
          <span class="r-value">${fmt(totalDue)}</span>
        </div>
        <div class="comp-result-row amort-row">
          <span class="r-label"><i data-lucide="calendar-days"></i> Monthly Amortization</span>
          <span class="r-value">${fmt(amortization)} / mo</span>
        </div>
        <div class="comp-result-row" style="background:#fffbeb;">
          <span class="r-label" style="font-size:11px;opacity:.7;">Method: Straight-line (flat interest on full principal)</span>
          <span class="r-value" style="font-size:11px;color:#d97706;">${(rateMonthly*100).toFixed(2)}%/mo</span>
        </div>`;
      _computedDue = totalDue;

    } else {
      // Diminishing balance: equal amortization each month, interest on remaining balance
      const monthlyPrincipal = principal / months;
      let runningBalance = principal;
      totalInterest = 0;
      const schedule = [];
      for (let i = 1; i <= months; i++) {
        const monthInterest = runningBalance * rateMonthly;
        totalInterest += monthInterest;
        const payment = monthlyPrincipal + monthInterest;
        schedule.push({ month: i, interest: monthInterest, principal: monthlyPrincipal, payment, balance: runningBalance - monthlyPrincipal });
        runningBalance -= monthlyPrincipal;
      }
      const firstAmort = schedule[0].payment;
      const lastAmort  = schedule[schedule.length - 1].payment;
      totalDue = principal + totalInterest + serviceFee;
      _computedDue = totalDue;

      rows = `
        <div class="comp-result-row">
          <span class="r-label"><i data-lucide="banknote"></i> Principal</span>
          <span class="r-value">${fmt(principal)}</span>
        </div>
        <div class="comp-result-row">
          <span class="r-label"><i data-lucide="percent"></i> Total Interest (diminishing)</span>
          <span class="r-value" style="color:#d97706;">${fmt(totalInterest)}</span>
        </div>
        ${serviceFee > 0 ? `<div class="comp-result-row"><span class="r-label"><i data-lucide="receipt"></i> Service Fee (${(feePct*100)}%)</span><span class="r-value" style="color:#9333ea;">${fmt(serviceFee)}</span></div>` : ''}
        <div class="comp-result-row highlight-row">
          <span class="r-label"><i data-lucide="circle-dollar-sign"></i> Total Due Amount</span>
          <span class="r-value">${fmt(totalDue)}</span>
        </div>
        <div class="comp-result-row amort-row">
          <span class="r-label"><i data-lucide="calendar-days"></i> 1st Amortization</span>
          <span class="r-value">${fmt(firstAmort)} / mo</span>
        </div>
        <div class="comp-result-row amort-row" style="background:#eff6ff;">
          <span class="r-label"><i data-lucide="calendar-check"></i> Last Amortization</span>
          <span class="r-value">${fmt(lastAmort)} / mo</span>
        </div>
        <div class="comp-result-row" style="background:#fffbeb;">
          <span class="r-label" style="font-size:11px;opacity:.7;">Method: Diminishing balance (interest on remaining principal)</span>
          <span class="r-value" style="font-size:11px;color:#d97706;">${(rateMonthly*100).toFixed(2)}%/mo</span>
        </div>`;
    }

    resultEl.innerHTML = rows;
    lucide.createIcons();
    useBtn.style.display = '';

    // Auto-fill due amount field
    document.getElementById('inp_due_amount').value = _computedDue.toFixed(2);
  }

  function applyComputation() {
    if (_computedDue > 0) {
      document.getElementById('inp_due_amount').value = _computedDue.toFixed(2);
      document.getElementById('inp_due_amount').classList.remove('err');
      // Pulse the field
      const f = document.getElementById('inp_due_amount');
      f.style.transition = 'box-shadow .15s, border-color .15s, background .3s';
      f.style.background = '#f0fdf4';
      f.style.borderColor = 'var(--emerald)';
      setTimeout(() => { f.style.background = ''; f.style.borderColor = ''; }, 900);
    }
  }

  // ── History modal ──
  function openHistoryModal()  { document.getElementById('historyModal').classList.add('open'); lucide.createIcons(); }
  function closeHistoryModal() { document.getElementById('historyModal').classList.remove('open'); }
  function viewSharedCapitalHistory() { window.location.href = '{{ route("Check.Last.Record", ["member_id" => $Review->member_id, "type" => "shared_capital"]) }}'; }
  function viewLoanHistory()          { window.location.href = '{{ route("Check.Last.Record", ["member_id" => $Review->member_id, "type" => "loan"]) }}'; }
  document.getElementById('historyModal').addEventListener('click', function(e) { if (e.target === this) closeHistoryModal(); });

  // ── Action Modals (Approve / Reject) ──
  const approveModal = document.getElementById('approveModal');
  const rejectModal  = document.getElementById('rejectModal');
  const notifyModal  = document.getElementById('notifyModal');

  function openApproveModal() {
    // Manually trigger basic empty validations before opening
    let valid = true;
    const form = document.getElementById('approvalForm');
    form.querySelectorAll('[required]').forEach(f => {
      if (!f.value.trim()) {
        valid = false;
        f.classList.add('err');
      } else {
        f.classList.remove('err');
      }
    });

    if (!valid) {
      form.querySelector('.err').scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }
    
    approveModal.classList.add('open');
    lucide.createIcons();
  }
  function closeApproveModal() { approveModal.classList.remove('open'); }

  function openRejectModal() {
    rejectModal.classList.add('open');
    lucide.createIcons();
  }
  function closeRejectModal() { rejectModal.classList.remove('open'); }

  function openNotifyModal() {
    notifyModal.classList.add('open');
    lucide.createIcons();
  }
  function closeNotifyModal() { notifyModal.classList.remove('open'); }

  // Close modals when clicking overlay
  [approveModal, rejectModal, notifyModal].forEach(modal => {
    if (modal) {
      modal.addEventListener('click', function(e) {
        if (e.target === this) {
          this.classList.remove('open');
        }
      });
    }
  });
</script>
</body>
</html>