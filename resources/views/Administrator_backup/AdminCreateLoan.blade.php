@<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Loan Application | GBLDC Admin</title>
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
      --rose:      #ef4444;
      --amber:     #f59e0b;
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
    .breadcrumb svg, .breadcrumb i[data-lucide] { width: 12px; height: 12px; opacity: .4; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }
    .topbar-spacer { flex: 1; }

    /* ── Page body ── */
    .page-body {
      flex: 1; padding: 32px;
      max-width: 860px; margin: 0 auto; width: 100%;
    }

    /* ── Step progress bar ── */
    .progress-wrap {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; padding: 20px 28px;
      margin-bottom: 24px;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .progress-header {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 16px;
    }
    .progress-title {
      font-family: 'DM Serif Display', serif; font-size: 18px; color: var(--forest);
    }
    .progress-counter {
      font-size: 12px; font-weight: 700; color: var(--muted);
    }
    .progress-counter span { color: var(--forest-mid); }

    .steps-row {
      display: flex; align-items: center; gap: 0;
    }
    .step-item {
      display: flex; flex-direction: column; align-items: center;
      flex: 1; position: relative; cursor: pointer;
    }
    .step-item:not(:last-child)::after {
      content: ''; position: absolute;
      top: 18px; left: calc(50% + 18px);
      width: calc(100% - 36px); height: 2px;
      background: var(--border); border-radius: 2px;
      transition: background .3s;
      z-index: 0;
    }
    .step-item.done:not(:last-child)::after,
    .step-item.active:not(:last-child)::after {
      background: var(--emerald);
    }

    .step-circle {
      width: 36px; height: 36px; border-radius: 50%;
      border: 2px solid var(--border); background: var(--white);
      display: flex; align-items: center; justify-content: center;
      font-size: 13px; font-weight: 700; color: var(--muted);
      position: relative; z-index: 1;
      transition: all .25s;
    }
    .step-item.done  .step-circle { background: var(--emerald); border-color: var(--emerald); color: #fff; }
    .step-item.active .step-circle { background: var(--forest); border-color: var(--forest); color: #fff; box-shadow: 0 0 0 4px rgba(13,74,47,.12); }

    .step-label {
      font-size: 11px; font-weight: 600; color: var(--muted);
      margin-top: 7px; text-align: center; white-space: nowrap;
      transition: color .2s;
    }
    .step-item.active .step-label { color: var(--forest); }
    .step-item.done   .step-label { color: var(--forest-mid); }

    .progress-bar-track {
      height: 4px; background: #e9f7ef; border-radius: 4px;
      margin-top: 14px; overflow: hidden;
    }
    .progress-bar-fill {
      height: 100%; background: linear-gradient(90deg, var(--forest), var(--emerald));
      border-radius: 4px; transition: width .4s ease;
    }

    /* ── Member banner ── */
    .member-banner {
      background: var(--white); border: 1.5px solid #bbf7d0;
      border-radius: 14px; padding: 14px 20px;
      margin-bottom: 20px;
      display: flex; align-items: center; gap: 14px;
    }
    .member-banner-icon {
      width: 40px; height: 40px; border-radius: 11px;
      background: var(--sage); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .member-banner-icon svg, .member-banner-icon i[data-lucide] { width: 20px; height: 20px; color: var(--forest-mid); }
    .member-banner-name { font-size: 14px; font-weight: 700; color: var(--forest); }
    .member-banner-meta { font-size: 12px; color: var(--muted); margin-top: 2px; display: flex; gap: 14px; flex-wrap: wrap; }
    .member-banner-meta span { display: flex; align-items: center; gap: 4px; }
    .member-banner-meta svg, .member-banner-meta i[data-lucide] { width: 11px; height: 11px; }

    /* ── Alerts ── */
    .alert {
      border-radius: 10px; padding: 12px 16px; margin-bottom: 18px;
      font-size: 13px; display: flex; align-items: center; gap: 8px;
    }
    .alert.success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
    .alert.error   { background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; }
    .alert svg, .alert i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Toast (shared style from ViewMembershipForm) ── */
    .toast-container { position: fixed; bottom: 24px; right: 28px; z-index: 500; display: flex; flex-direction: column; gap: 10px; pointer-events: none; }
    .toast { display: flex; align-items: flex-start; gap: 12px; padding: 14px 18px; border-radius: 14px; min-width: 280px; max-width: 360px; box-shadow: 0 8px 32px rgba(0,0,0,.14); pointer-events: all; animation: toastIn .35s cubic-bezier(.34,1.56,.64,1) forwards; position: relative; overflow: hidden; }
    .toast.hiding { animation: toastOut .3s ease forwards; }
    @keyframes toastIn  { from { opacity:0; transform:translateX(60px) scale(.95); } to { opacity:1; transform:translateX(0) scale(1); } }
    @keyframes toastOut { from { opacity:1; transform:translateX(0) scale(1); } to { opacity:0; transform:translateX(60px) scale(.95); } }
    .toast.success { background:#f0fdf4; border:1px solid #86efac; }
    .toast.error   { background:#fef2e2; border:1px solid #fca5a5; }
    .toast-icon { width:34px; height:34px; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .toast.success .toast-icon { background:#dcfce7; }
    .toast.success .toast-icon i[data-lucide] { width:17px; height:17px; color:#16a34a; }
    .toast.error   .toast-icon { background:#fee2e2; }
    .toast.error   .toast-icon i[data-lucide] { width:17px; height:17px; color:#dc2626; }
    .toast-body { flex:1; }
    .toast-title { font-size:13px; font-weight:700; margin-bottom:2px; }
    .toast.success .toast-title { color:#14532d; }
    .toast.error   .toast-title { color:#7f1d1d; }
    .toast-msg { font-size:12px; line-height:1.5; }
    .toast.success .toast-msg { color:#166534; }
    .toast.error   .toast-msg { color:#991b1b; }
    .toast-close { background:none; border:none; cursor:pointer; padding:2px; border-radius:5px; flex-shrink:0; opacity:.5; transition:opacity .15s; display:flex; align-items:center; }
    .toast-close:hover { opacity:1; }
    .toast-close i[data-lucide] { width:13px; height:13px; }
    .toast.success .toast-close { color:#166534; }
    .toast.error   .toast-close { color:#991b1b; }
    .toast-progress { position:absolute; bottom:0; left:0; height:3px; border-radius:0 0 14px 14px; animation:toastProgress linear forwards; }
    .toast.success .toast-progress { background:#22c55e; }
    .toast.error   .toast-progress { background:#ef4444; }
    @keyframes toastProgress { from { width:100%; } to { width:0%; } }

    /* ── Step panel ── */
    .step-panel { display: none; animation: stepIn .25s ease both; }
    .step-panel.active { display: block; }
    @keyframes stepIn {
      from { opacity: 0; transform: translateX(16px); }
      to   { opacity: 1; transform: translateX(0); }
    }
    .step-panel.going-back { animation: stepBack .25s ease both; }
    @keyframes stepBack {
      from { opacity: 0; transform: translateX(-16px); }
      to   { opacity: 1; transform: translateX(0); }
    }

    /* ── Card ── */
    .card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; overflow: hidden; margin-bottom: 16px;
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

    /* ── Form grid ── */
    .form-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; }
    .form-grid.cols2 { grid-template-columns: 1fr 1fr; }
    .form-grid .span2 { grid-column: span 2; }
    .form-grid .span3 { grid-column: 1 / -1; }
    @media (max-width: 680px) {
      .form-grid, .form-grid.cols2 { grid-template-columns: 1fr; }
      .form-grid .span2, .form-grid .span3 { grid-column: 1; }
    }

    /* ── Field ── */
    .field { display: flex; flex-direction: column; gap: 6px; }
    .field label {
      font-size: 12px; font-weight: 700; color: var(--ink);
      text-transform: uppercase; letter-spacing: .05em;
      display: flex; align-items: center; gap: 5px;
    }
    .field label .req { color: var(--rose); font-size: 13px; font-weight: 700; }
    .field label .opt {
      font-size: 10px; font-weight: 500; text-transform: none;
      letter-spacing: 0; color: var(--muted);
    }
    .field-hint { font-size: 11px; color: var(--muted); line-height: 1.4; }

    .inp, .sel {
      border: 1.5px solid var(--border); border-radius: 10px;
      padding: 10px 14px; font-size: 14px;
      font-family: 'DM Sans', sans-serif; color: var(--ink);
      background: var(--white); outline: none; width: 100%;
      transition: border-color .2s, box-shadow .2s;
    }
    .inp:focus, .sel:focus {
      border-color: var(--forest-mid);
      box-shadow: 0 0 0 3px rgba(26,107,68,.08);
    }
    .inp.err, .sel.err { border-color: var(--rose); box-shadow: 0 0 0 3px rgba(239,68,68,.08); }
    .inp::placeholder { color: #b0bac4; }
    .inp[readonly] { background: #f3f4f6; color: var(--muted); cursor: not-allowed; }

    .inp-wrap { position: relative; display: flex; align-items: center; }
    .inp-wrap .prefix { position: absolute; left: 12px; font-size: 14px; font-weight: 600; color: var(--muted); pointer-events: none; z-index: 1; }
    .inp-wrap .inp    { padding-left: 28px; }
    .inp-wrap .suffix { position: absolute; right: 12px; font-size: 12px; color: var(--muted); pointer-events: none; }

    /* Radio pills */
    .radio-group { display: flex; gap: 10px; flex-wrap: wrap; }
    .radio-pill {
      display: flex; align-items: center; gap: 7px;
      padding: 9px 16px; border-radius: 10px;
      border: 1.5px solid var(--border); cursor: pointer;
      font-size: 13px; font-weight: 500; user-select: none;
      transition: border-color .2s, background .2s;
    }
    .radio-pill input[type=radio] { display: none; }
    .radio-pill:has(input:checked) { border-color: var(--forest-mid); background: #f0fdf4; color: var(--forest); }
    .radio-pill .dot {
      width: 14px; height: 14px; border-radius: 50%;
      border: 2px solid var(--border); background: var(--white);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
      transition: all .2s;
    }
    .radio-pill:has(input:checked) .dot { border-color: var(--forest-mid); background: var(--forest-mid); }
    .radio-pill:has(input:checked) .dot::after {
      content: ''; display: block; width: 5px; height: 5px; border-radius: 50%; background: #fff;
    }

    /* Loan term pills */
    .term-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
    .term-pill {
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      padding: 14px 8px; border-radius: 12px; border: 1.5px solid var(--border);
      cursor: pointer; text-align: center; user-select: none;
      transition: all .2s;
    }
    .term-pill input[type=radio] { display: none; }
    .term-pill .term-num  { font-family: 'DM Serif Display', serif; font-size: 24px; color: var(--forest); line-height: 1; }
    .term-pill .term-unit { font-size: 11px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; margin-top: 4px; }
    .term-pill:hover { border-color: var(--forest-mid); transform: translateY(-2px); }
    .term-pill:has(input:checked) { border-color: var(--forest-mid); background: #f0fdf4; }
    .term-pill:has(input:checked) .term-num  { color: var(--forest-mid); }
    .term-pill:has(input:checked) .term-unit { color: var(--forest-mid); }

    /* Amount pills */
    .amount-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-bottom: 12px; }
    .amt-pill {
      padding: 10px 6px; border-radius: 10px; border: 1.5px solid var(--border);
      text-align: center; font-size: 12px; font-weight: 700; cursor: pointer;
      color: var(--forest); transition: all .15s; user-select: none;
    }
    .amt-pill:hover  { border-color: var(--forest-mid); background: #f0fdf4; transform: translateY(-1px); }
    .amt-pill.active { border-color: var(--forest-mid); background: #f0fdf4; }

    /* Purpose pills */
    .purpose-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 12px; }
    .purpose-pill {
      padding: 10px; border-radius: 10px; border: 1.5px solid var(--border);
      text-align: center; font-size: 12px; font-weight: 600; cursor: pointer;
      color: var(--ink); transition: all .15s; user-select: none; line-height: 1.3;
    }
    .purpose-pill:hover  { border-color: var(--forest-mid); background: #f0fdf4; }
    .purpose-pill.active { border-color: var(--forest-mid); background: #f0fdf4; color: var(--forest); }

    /* File upload */
    .file-upload {
      border: 2px dashed var(--border); border-radius: 10px;
      padding: 20px 14px; text-align: center; cursor: pointer;
      transition: all .2s; background: var(--sand);
    }
    .file-upload:hover { border-color: var(--forest-mid); background: #f0fdf4; }
    .file-upload input { display: none; }
    .file-upload .fu-icon { color: var(--muted); margin-bottom: 6px; }
    .file-upload .fu-icon svg, .file-upload .fu-icon i[data-lucide] { width: 24px; height: 24px; }
    .file-upload .fu-label { font-size: 13px; font-weight: 600; color: var(--forest-mid); }
    .file-upload .fu-hint  { font-size: 11px; color: var(--muted); margin-top: 2px; }
    .file-upload.has-file  { border-color: var(--emerald); background: #f0fdf4; }

    /* ── Computation panel ── */
    .comp-panel {
      background: linear-gradient(135deg, #f0fdf4, #fafffe);
      border: 1.5px solid #bbf7d0; border-radius: 14px; padding: 20px; margin-top: 4px;
    }
    .comp-panel-title {
      font-size: 13px; font-weight: 700; color: var(--forest);
      margin-bottom: 14px; display: flex; align-items: center; gap: 7px;
    }
    .comp-panel-title svg, .comp-panel-title i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }
    .comp-rate-row { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px; align-items: center; }
    .comp-rate-label { font-size: 12px; font-weight: 600; color: var(--muted); flex-shrink: 0; }
    .rate-btn {
      padding: 5px 12px; border-radius: 8px; border: 1.5px solid var(--border);
      background: var(--white); font-size: 12px; font-weight: 600; cursor: pointer;
      color: var(--ink); transition: all .15s; white-space: nowrap;
      font-family: 'DM Sans', sans-serif;
    }
    .rate-btn:hover  { border-color: var(--forest-mid); color: var(--forest); }
    .rate-btn.active { border-color: var(--forest-mid); background: #f0fdf4; color: var(--forest); }
    .comp-results-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-bottom: 14px; }
    .comp-result {
      background: var(--white); border: 1px solid #d1fae5; border-radius: 10px; padding: 12px 14px;
    }
    .comp-result .lbl { font-size: 10px; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin-bottom: 4px; }
    .comp-result .val { font-size: 14px; font-weight: 700; color: var(--ink); }
    .comp-result .val.big  { font-family: 'DM Serif Display', serif; font-size: 18px; color: var(--forest-mid); }
    .comp-result .val.warn { color: #d97706; }
    .apply-btn {
      width: 100%; padding: 11px; border-radius: 10px;
      background: var(--forest); color: #fff; border: none;
      font-size: 13px; font-weight: 700; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      display: flex; align-items: center; justify-content: center; gap: 7px;
      transition: all .2s;
    }
    .apply-btn:hover { background: var(--forest-mid); transform: translateY(-1px); }
    .apply-btn.flashed { animation: flash .4s ease; }
    @keyframes flash { 0%,100% { background: var(--forest); } 50% { background: var(--emerald); } }
    .apply-btn svg, .apply-btn i[data-lucide] { width: 14px; height: 14px; }

    /* ── Review summary ── */
    .review-section { margin-bottom: 20px; }
    .review-section-title {
      font-size: 11px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .08em; color: var(--forest-mid);
      margin-bottom: 10px; display: flex; align-items: center; gap: 6px;
    }
    .review-section-title svg, .review-section-title i[data-lucide] { width: 13px; height: 13px; }
    .review-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
    .review-cell {
      background: var(--sand); border: 1px solid #eaf3ea;
      border-radius: 10px; padding: 11px 14px;
    }
    .review-cell .lbl { font-size: 10px; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin-bottom: 3px; }
    .review-cell .val { font-size: 13px; font-weight: 600; color: var(--ink); }
    .review-cell .val.green { color: var(--forest-mid); }
    .review-cell .val.mono  { font-family: monospace; font-size: 12px; }

    /* ── Navigation buttons ── */
    .step-nav {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; padding: 16px 24px;
      display: flex; align-items: center; justify-content: space-between;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .step-nav-left  { display: flex; align-items: center; gap: 10px; }
    .step-nav-right { display: flex; align-items: center; gap: 10px; }

    .btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 10px 20px; border-radius: 10px;
      font-size: 13px; font-weight: 600; cursor: pointer;
      border: none; font-family: 'DM Sans', sans-serif;
      text-decoration: none; transition: all .2s; white-space: nowrap;
    }
    .btn:active { transform: scale(.97); }
    .btn svg, .btn i[data-lucide] { width: 14px; height: 14px; }
    .btn-primary { background: var(--forest); color: #fff; }
    .btn-primary:hover { background: var(--forest-mid); transform: translateY(-1px); }
    .btn-ghost   { background: var(--white); color: var(--ink); border: 1.5px solid var(--border); }
    .btn-ghost:hover   { border-color: #9ca3af; background: #f9fafb; }
    .btn-submit  { background: var(--forest); color: #fff; padding: 12px 28px; font-size: 14px; font-weight: 700; box-shadow: 0 4px 14px rgba(13,74,47,.3); }
    .btn-submit:hover  { background: var(--forest-mid); box-shadow: 0 8px 20px rgba(13,74,47,.35); transform: translateY(-1px); }

    .step-hint {
      font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 5px;
    }
    .step-hint svg, .step-hint i[data-lucide] { width: 13px; height: 13px; color: var(--amber); }

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
      .amount-grid  { grid-template-columns: repeat(2,1fr); }
      .purpose-grid { grid-template-columns: repeat(2,1fr); }
      .comp-results-grid { grid-template-columns: 1fr 1fr; }
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
    <a href="{{route('Admin.dashboard')}}" class="nav-item"><i data-lucide="layout-dashboard"></i> Overview</a>
    <a href="{{route('Manage.Members')}}"  class="nav-item"><i data-lucide="user-plus"></i> Member Registration</a>
    <a href="{{route('Member.List')}}"     class="nav-item"><i data-lucide="users"></i> Official Members</a>
    <div class="nav-section-label">Finance</div>
    <a href="{{route('LoanApp.list')}}"            class="nav-item"><i data-lucide="file-text"></i> Loan Applications</a>
    <a href="{{route('Loan.Records')}}"            class="nav-item"><i data-lucide="badge-check"></i> Approved Loans</a>
    <a href="{{route('Payment.Page')}}"            class="nav-item"><i data-lucide="credit-card"></i> Payment</a>
    <a href="{{route('Add.Transactions')}}"        class="nav-item active"><i data-lucide="arrow-left-right"></i> Transactions</a>
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item"><i data-lucide="piggy-bank"></i> Shared Capital</a>
    <div class="nav-section-label">Reports</div>
    <a href="{{route('Admin.Reports')}}" class="nav-item">
      <i data-lucide="bar-chart-2"></i> Cooperative Reports
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}"  class="nav-item"><i data-lucide="shield-check"></i> Manage Users</a>
    <a href="{{route('Admin.Settings')}}" class="nav-item"><i data-lucide="settings"></i> Settings</a>
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
      <a href="#" class="dropdown-item normal"><i data-lucide="user" style="width:14px;height:14px;"></i> Profile</a>
      <a href="{{route('Admin.Settings')}}" class="dropdown-item normal"><i data-lucide="settings" style="width:14px;height:14px;"></i> Settings</a>
      <a href="{{route('Admin.Logout')}}" class="dropdown-item danger"><i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout</a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
  <div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <a href="{{route('Add.Transactions')}}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="breadcrumb">
      <a href="{{route('Add.Transactions')}}">Transactions</a>
      <i data-lucide="chevron-right"></i>
      <span class="current">Loan Application</span>
    </div>
    <div class="topbar-spacer"></div>
  </header>

  <!-- Page body -->
    <div class="page-body">

    @if(session('success'))
    <div class="alert success"><i data-lucide="circle-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert error"><i data-lucide="circle-alert"></i> {{ session('error') }}</div>
    @endif

    <!-- Member banner -->
    @if(isset($AutoComplete))
    <div class="member-banner">
      <div class="member-banner-icon"><i data-lucide="user-check"></i></div>
      <div>
        <div class="member-banner-name">{{$AutoComplete->last_name}}, {{$AutoComplete->first_name}} {{$AutoComplete->middle_name}}</div>
        <div class="member-banner-meta">
          <span><i data-lucide="hash"></i> {{$AutoComplete->member_id}}</span>
          <span><i data-lucide="phone"></i> 0{{$AutoComplete->contact_number}}</span>
          <span><i data-lucide="map-pin"></i> {{$AutoComplete->street_address}}, {{$AutoComplete->barangay}}</span>
    </div>
  </div>

  <!-- Toast Container -->
  <div class="toast-container" id="toastContainer"></div>
    </div>
    @endif

    <!-- Progress bar -->
    <div class="progress-wrap">
      <div class="progress-header">
        <div class="progress-title" id="progressTitle">Step 1 — Personal Information</div>
        <div class="progress-counter">Step <span id="curStep">1</span> of <span>6</span></div>
      </div>
      <div class="steps-row">
        <div class="step-item active" data-step="1" onclick="jumpToStep(1)">
          <div class="step-circle"><i data-lucide="user" style="width:14px;height:14px;"></i></div>
          <div class="step-label">Personal</div>
        </div>
        <div class="step-item" data-step="2" onclick="jumpToStep(2)">
          <div class="step-circle"><i data-lucide="map-pin" style="width:14px;height:14px;"></i></div>
          <div class="step-label">Address</div>
        </div>
        <div class="step-item" data-step="3" onclick="jumpToStep(3)">
          <div class="step-circle"><i data-lucide="shield-check" style="width:14px;height:14px;"></i></div>
          <div class="step-label">Guarantors</div>
        </div>
        <div class="step-item" data-step="4" onclick="jumpToStep(4)">
          <div class="step-circle"><i data-lucide="briefcase" style="width:14px;height:14px;"></i></div>
          <div class="step-label">Employment</div>
        </div>
        <div class="step-item" data-step="5" onclick="jumpToStep(5)">
          <div class="step-circle"><i data-lucide="landmark" style="width:14px;height:14px;"></i></div>
          <div class="step-label">Loan Details</div>
        </div>
        <div class="step-item" data-step="6" onclick="jumpToStep(6)">
          <div class="step-circle"><i data-lucide="check" style="width:14px;height:14px;"></i></div>
          <div class="step-label">Review</div>
        </div>
      </div>
      <div class="progress-bar-track">
        <div class="progress-bar-fill" id="progressBar" style="width:16.66%"></div>
      </div>
    </div>

    <!-- ══ FORM ══ -->
    <form action="{{route('Admin.Loan.Submit')}}" method="POST" enctype="multipart/form-data" id="loanForm">
      @csrf
      <input type="hidden" name="member_id" value="{{ optional($AutoComplete)->member_id }}">

      <!-- ═══ STEP 1: Personal Info ═══ -->
      <div class="step-panel active" id="step-1">
        <div class="card">
          <div class="card-head">
            <div class="card-head-icon"><i data-lucide="user"></i></div>
            <div>
              <div class="card-head-title">Personal Information</div>
              <div class="card-head-sub">Full name, birth info, and contact details</div>
            </div>
          </div>
          <div class="card-body">
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field">
                <label>Last Name <span class="req">*</span></label>
                <input class="inp" name="last_name" type="text" placeholder="e.g. Dela Cruz" value="{{ optional($AutoComplete)->last_name }}" required>
              </div>
              <div class="field">
                <label>First Name <span class="req">*</span></label>
                <input class="inp" name="first_name" type="text" placeholder="e.g. Juan" value="{{ optional($AutoComplete)->first_name }}" required>
              </div>
              <div class="field">
                <label>Middle Name <span class="req">*</span></label>
                <input class="inp" name="middle_name" type="text" placeholder="e.g. Santos" value="{{ optional($AutoComplete)->middle_name }}" required>
              </div>
            </div>
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field">
                <label>Place of Birth <span class="req">*</span></label>
                <input class="inp" name="place_of_birth" type="text" placeholder="City / Municipality" value="{{ optional($AutoComplete)->place_of_birth }}" required>
              </div>
              <div class="field">
                <label>Birth Date <span class="req">*</span></label>
                <input class="inp" name="birthdate" id="birthDate" type="date" value="{{ optional($AutoComplete)->birthdate }}" required onchange="calculateAge()">
              </div>
              <div class="field">
                <label>Age <span class="req">*</span></label>
                <div class="inp-wrap">
                  <input class="inp" name="age" id="age" type="number" value="{{ optional($AutoComplete)->age }}" readonly required>
                  <span class="suffix">yrs</span>
                </div>
                <div class="field-hint">Auto-computed from birth date</div>
              </div>
            </div>
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field">
                <label>Gender <span class="req">*</span></label>
                <div class="radio-group">
                  <label class="radio-pill">
                    <input type="radio" name="gender" value="Male" {{ (old('gender', optional($AutoComplete)->gender ?? '') == 'Male') ? 'checked' : '' }} required>
                    <span class="dot"></span> Male
                  </label>
                  <label class="radio-pill">
                    <input type="radio" name="gender" value="Female" {{ (old('gender', optional($AutoComplete)->gender ?? '') == 'Female') ? 'checked' : '' }}>
                    <span class="dot"></span> Female
                  </label>
                </div>
              </div>
              <div class="field">
                <label>Civil Status <span class="req">*</span></label>
                <select class="sel" name="civil_status" required>
                  <option value="">Select status</option>
                  <option value="SINGLE"    {{ optional($AutoComplete)->civil_status == 'SINGLE'    ? 'selected':'' }}>Single</option>
                  <option value="MARRIED"   {{ optional($AutoComplete)->civil_status == 'MARRIED'   ? 'selected':'' }}>Married</option>
                  <option value="WIDOW"     {{ optional($AutoComplete)->civil_status == 'WIDOW'     ? 'selected':'' }}>Widow / Widower</option>
                  <option value="SEPARATED" {{ optional($AutoComplete)->civil_status == 'SEPARATED' ? 'selected':'' }}>Separated</option>
                </select>
              </div>
              <div class="field">
                <label>Religion <span class="req">*</span></label>
                <select class="sel" name="religion" required>
                  <option value="">Select religion</option>
                  <option value="ROMAN CATHOLIC">Roman Catholic</option>
                  <option value="PROTESTANT">Protestant</option>
                  <option value="CHRISTIAN">Christian</option>
                  <option value="BAPTIST">Baptist</option>
                  <option value="SEVENTH-DAY ADVENTIST">Seventh-Day Adventist</option>
                  <option value="IGLESIA NI CRISTO">Iglesia ni Cristo</option>
                  <option value="ADVENTIST">Adventist</option>
                  <option value="BUDDHISM">Buddhism</option>
                  <option value="JESUS IS LORD MOVEMENT">Jesus is Lord Movement</option>
                  <option value="JEHOVAH'S WITNESSES">Jehovah's Witnesses</option>
                  <option value="METHODIST">Methodist</option>
                  <option value="NON-SECTARIAN">Non-Sectarian</option>
                  <option value="OTHER">Other</option>
                </select>
              </div>
            </div>
            <div class="form-grid cols2">
              <div class="field">
                <label>Email Address <span class="req">*</span></label>
                <input class="inp" name="email" type="email" placeholder="juan@email.com" value="{{ optional($AutoComplete)->email }}" required>
              </div>
              <div class="field">
                <label>Contact Number <span class="req">*</span></label>
                <div class="inp-wrap">
                  <span class="prefix">+63</span>
                  <input class="inp" name="contact_number" type="tel" pattern="[0-9]{10}" maxlength="10" placeholder="9XXXXXXXXX" value="{{ optional($AutoComplete)->contact_number }}" required inputmode="numeric">
                </div>
              </div>
              <div class="field">
                <label>Nationality <span class="req">*</span></label>
                <input class="inp" name="nationality" type="text" placeholder="e.g. Filipino" value="{{ optional($AutoComplete)->nationality ?? 'Filipino' }}" required>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ═══ STEP 2: Home Address ═══ -->
      <div class="step-panel" id="step-2">
        <div class="card">
          <div class="card-head">
            <div class="card-head-icon"><i data-lucide="map-pin"></i></div>
            <div>
              <div class="card-head-title">Home Address</div>
              <div class="card-head-sub">Current residential address of the applicant</div>
            </div>
          </div>
          <div class="card-body">
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field">
                <label>Province <span class="req">*</span></label>
                <select class="sel" id="province" name="province" required>
                  <option value="{{ optional($AutoComplete)->province }}">{{ optional($AutoComplete)->province ?? 'Select Province' }}</option>
                </select>
              </div>
              <div class="field">
                <label>City / Municipality <span class="req">*</span></label>
                <select class="sel" id="city" name="city_municipality" required>
                  <option value="{{ optional($AutoComplete)->city }}">{{ optional($AutoComplete)->city ?? 'Select City' }}</option>
                </select>
              </div>
              <div class="field">
                <label>Barangay <span class="req">*</span></label>
                <select class="sel" id="barangay" name="barangay" required>
                  <option value="{{ optional($AutoComplete)->barangay }}">{{ optional($AutoComplete)->barangay ?? 'Select Barangay' }}</option>
                </select>
              </div>
              <div class="field">
                <label>Street Address <span class="req">*</span></label>
                <input class="inp" name="street_address" type="text" placeholder="House No., Street Name" value="{{ optional($AutoComplete)->street_address }}" required>
              </div>
            </div>
            <div class="form-grid">
              <div class="field">
                <label>Zip Code <span class="req">*</span></label>
                <input class="inp" id="zipCode" name="zip_code" type="text" placeholder="e.g. 3000" value="{{ optional($AutoComplete)->zip_code }}" required>
              </div>
              <div class="field">
                <label>Years of Stay (in years) <span class="req">*</span></label>
                <input class="inp" name="year_of_stay" type="text" placeholder="e.g. 5" value="{{ optional($AutoComplete)->year_of_stay }}" required>
              </div>
              <div class="field">
                <label>House Ownership <span class="req">*</span></label>
                <select class="sel" name="house_ownership" required>
                  <option value="">Select type</option>
                  <option value="Owned"               {{ optional($AutoComplete)->house_ownership == 'Owned'               ? 'selected':'' }}>Owned</option>
                  <option value="Rented"              {{ optional($AutoComplete)->house_ownership == 'Rented'              ? 'selected':'' }}>Rented</option>
                  <option value="Living with Parents" {{ optional($AutoComplete)->house_ownership == 'Living with Parents' ? 'selected':'' }}>Living with Parents</option>
                  <option value="Other"               {{ optional($AutoComplete)->house_ownership == 'Other'               ? 'selected':'' }}>Other</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ═══ STEP 3: Guarantors ═══ -->
      <div class="step-panel" id="step-3">
        <!-- Guarantor 1 -->
        <div class="card">
          <div class="card-head">
            <div class="card-head-icon"><i data-lucide="user-check"></i></div>
            <div>
              <div class="card-head-title">First Guarantor (Co-Maker)</div>
              <div class="card-head-sub">Primary co-maker of this loan application</div>
            </div>
          </div>
          <div class="card-body">
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field span2">
                <label>Full Name <span class="req">*</span></label>
                <input class="inp" name="g1_fullname" type="text" placeholder="Full name of guarantor" required>
              </div>
              <div class="field">
                <label>Relationship <span class="req">*</span></label>
                <select class="sel" name="g1_relationship" required>
                  <option value="" disabled selected>Select relationship</option>
                  <option value="Spouse">Spouse</option>
                  <option value="Parent">Parent</option>
                  <option value="Sibling">Sibling</option>
                  <option value="Child">Child</option>
                  <option value="Relative">Relative</option>
                  <option value="Friend">Friend</option>
                  <option value="Co-worker">Co-worker</option>
                  <option value="Employer">Employer</option>
                  <option value="Neighbor">Neighbor</option>
                  <option value="Others">Others</option>
                </select>
              </div>
            </div>
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field">
                <label>Contact Number <span class="req">*</span></label>
                <input class="inp" name="g1_contact_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11" required>
              </div>
              <div class="field span2">
                <label>Address <span class="req">*</span></label>
                <input class="inp" name="g1_address" type="text" placeholder="Complete address" required>
              </div>
            </div>
            <div class="field" style="max-width:320px;">
              <label>Valid ID <span class="req">*</span></label>
              <div class="file-upload" id="fu-g1" onclick="document.getElementById('g1_valid_id').click()">
                <div class="fu-icon"><i data-lucide="upload-cloud"></i></div>
                <div class="fu-label" id="fu-g1-label">Click to upload</div>
                <div class="fu-hint">JPG, PNG accepted</div>
                <input type="file" id="g1_valid_id" name="g1_valid_id" accept="image/*" required onchange="handleFile('fu-g1','fu-g1-label',this)">
              </div>
            </div>
          </div>
        </div>
        <!-- Guarantor 2 -->
        <div class="card">
          <div class="card-head">
            <div class="card-head-icon"><i data-lucide="user-check"></i></div>
            <div>
              <div class="card-head-title">Second Guarantor (Co-Maker)</div>
              <div class="card-head-sub">Secondary co-maker of this loan application</div>
            </div>
          </div>
          <div class="card-body">
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field span2">
                <label>Full Name <span class="req">*</span></label>
                <input class="inp" name="g2_fullname" type="text" placeholder="Full name of guarantor" required>
              </div>
              <div class="field">
                <label>Relationship <span class="req">*</span></label>
                <select class="sel" name="g2_relationship" required>
                  <option value="" disabled selected>Select relationship</option>
                  <option value="Spouse">Spouse</option>
                  <option value="Parent">Parent</option>
                  <option value="Sibling">Sibling</option>
                  <option value="Child">Child</option>
                  <option value="Relative">Relative</option>
                  <option value="Friend">Friend</option>
                  <option value="Co-worker">Co-worker</option>
                  <option value="Employer">Employer</option>
                  <option value="Neighbor">Neighbor</option>
                  <option value="Others">Others</option>
                </select>
              </div>
            </div>
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field">
                <label>Contact Number <span class="req">*</span></label>
                <input class="inp" name="g2_contact_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11" required>
              </div>
              <div class="field span2">
                <label>Address <span class="req">*</span></label>
                <input class="inp" name="g2_address" type="text" placeholder="Complete address" required>
              </div>
            </div>
            <div class="field" style="max-width:320px;">
              <label>Valid ID <span class="req">*</span></label>
              <div class="file-upload" id="fu-g2" onclick="document.getElementById('g2_valid_id').click()">
                <div class="fu-icon"><i data-lucide="upload-cloud"></i></div>
                <div class="fu-label" id="fu-g2-label">Click to upload</div>
                <div class="fu-hint">JPG, PNG, PDF accepted</div>
                <input type="file" id="g2_valid_id" name="g2_valid_id" accept="image/*,application/pdf" required onchange="handleFile('fu-g2','fu-g2-label',this)">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ═══ STEP 4: Employment ═══ -->
      <div class="step-panel" id="step-4">
        <div class="card">
          <div class="card-head">
            <div class="card-head-icon"><i data-lucide="briefcase"></i></div>
            <div>
              <div class="card-head-title">Employment / Business Information</div>
              <div class="card-head-sub">Source of income for loan eligibility assessment</div>
            </div>
          </div>
          <div class="card-body">
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field">
                <label>Employment Type <span class="req">*</span></label>
                <select class="sel" name="employment_type" required>
                  <option value="">Select type</option>
                  <option value="employed">Employed</option>
                  <option value="self-employed">Self-Employed</option>
                  <option value="business-owner">Business Owner</option>
                </select>
              </div>
              <div class="field">
                <label>Employer / Business Name <span class="req">*</span></label>
                <input class="inp" name="employer_business_name" type="text" placeholder="e.g. ABC Corp." required>
              </div>
              <div class="field">
                <label>Occupation / Nature of Business <span class="req">*</span></label>
                <input class="inp" name="position_nature_of_business" type="text" placeholder="e.g. Accountant" required>
              </div>
            </div>
            <div class="form-grid" style="margin-bottom:18px;">
              <div class="field span2">
                <label>Employer / Business Address <span class="req">*</span></label>
                <input class="inp" name="employer_business_address" type="text" placeholder="Complete business address" required>
              </div>
              <div class="field">
                <label>Years in Service <span class="req">*</span></label>
                <input class="inp" name="year_in_service_operation" type="text" placeholder="e.g. 3 years" required>
              </div>
            </div>
            <div class="form-grid cols2" style="margin-bottom:18px;">
              <div class="field">
                <label>Gross Monthly Income <span class="req">*</span></label>
                <div class="inp-wrap">
                  <span class="prefix">₱</span>
                  <input class="inp" name="monthly_income" id="monthly_income" type="number" min="0" step="0.01" placeholder="0.00" required>
                </div>
              </div>
              <div class="field">
                <label>Proof of Income <span class="req">*</span></label>
                <div class="file-upload" id="fu-income" onclick="document.getElementById('proof_of_income').click()">
                  <div class="fu-icon"><i data-lucide="upload-cloud"></i></div>
                  <div class="fu-label" id="fu-income-label">Click to upload</div>
                  <div class="fu-hint">Payslip, COE, ITR, Business Permit</div>
                  <input type="file" id="proof_of_income" name="proof_of_income" accept="image/*" required onchange="handleFile('fu-income','fu-income-label',this)">
                </div>
              </div>
            </div>
            <div class="form-grid cols2">
              <div class="field">
                <label>HR Contact Name <span class="opt">(optional)</span></label>
                <input class="inp" name="hr_person_name" type="text" placeholder="HR or contact person name">
              </div>
              <div class="field">
                <label>HR Contact Number <span class="opt">(optional)</span></label>
                <input class="inp" name="hr_person_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ═══ STEP 5: Loan Details ═══ -->
      <div class="step-panel" id="step-5">
        <div class="card">
          <div class="card-head">
            <div class="card-head-icon"><i data-lucide="landmark"></i></div>
            <div>
              <div class="card-head-title">Loan Details</div>
              <div class="card-head-sub">Loan type, amount, term, purpose, and interest computation</div>
            </div>
          </div>
          <div class="card-body">
            <!-- Loan type -->
            <div class="form-grid cols2" style="margin-bottom:22px;">
              <div class="field">
                <label>Loan Type <span class="req">*</span></label>
                <select class="sel" name="loan_type" required>
                  <option value="">Select loan type</option>
                  <option value="personal-loan">Personal Loan</option>
                  <option value="business-loan">Business Loan</option>
                  <option value="mortgage-loan">Mortgage / Housing Loan</option>
                  <option value="auto-loan">Auto Loan</option>
                  <option value="educational-loan">Educational Loan</option>
                  <option value="emergency-loan">Emergency Loan</option>
                </select>
              </div>
            </div>

            <!-- Loan amount -->
            <div class="field" style="margin-bottom:20px;">
              <label>Loan Amount <span class="req">*</span> <span class="opt">— quick pick or enter manually</span></label>
              <div class="amount-grid" id="amountPills">
                <div class="amt-pill" data-amt="5000">₱5,000</div>
                <div class="amt-pill" data-amt="10000">₱10,000</div>
                <div class="amt-pill" data-amt="20000">₱20,000</div>
                <div class="amt-pill" data-amt="30000">₱30,000</div>
                <div class="amt-pill" data-amt="50000">₱50,000</div>
                <div class="amt-pill" data-amt="75000">₱75,000</div>
                <div class="amt-pill" data-amt="100000">₱100,000</div>
                <div class="amt-pill" data-amt="150000">₱150,000</div>
              </div>
              <div class="inp-wrap">
                <span class="prefix">₱</span>
                <input class="inp" name="loan_amount" id="loanAmount" type="number" min="0" step="0.01"
                  placeholder="Enter or pick amount above" required oninput="clearAmtPill(); runComputation();">
              </div>
            </div>

            <!-- Loan term -->
            <div class="field" style="margin-bottom:22px;">
              <label>Loan Term <span class="req">*</span> <span class="opt">— select repayment duration</span></label>
              <div class="term-grid">
                <label class="term-pill">
                  <input type="radio" name="loan_term" value="3" onchange="runComputation()" required>
                  <span class="term-num">3</span>
                  <span class="term-unit">Months</span>
                </label>
                <label class="term-pill">
                  <input type="radio" name="loan_term" value="6" onchange="runComputation()">
                  <span class="term-num">6</span>
                  <span class="term-unit">Months</span>
                </label>
                <label class="term-pill">
                  <input type="radio" name="loan_term" value="9" onchange="runComputation()">
                  <span class="term-num">9</span>
                  <span class="term-unit">Months</span>
                </label>
                <label class="term-pill">
                  <input type="radio" name="loan_term" value="12" onchange="runComputation()">
                  <span class="term-num">12</span>
                  <span class="term-unit">Months</span>
                </label>
              </div>
            </div>

            <!-- Purpose -->
            <div class="field" style="margin-bottom:22px;">
              <label>Purpose of Loan <span class="req">*</span> <span class="opt">— pick or type custom</span></label>
              <div class="purpose-grid" id="purposePills">
                <div class="purpose-pill" data-purpose="Home Renovation">🏠 Home Renovation</div>
                <div class="purpose-pill" data-purpose="Business Capital">💼 Business Capital</div>
                <div class="purpose-pill" data-purpose="Education">🎓 Education</div>
                <div class="purpose-pill" data-purpose="Medical / Health">🏥 Medical / Health</div>
                <div class="purpose-pill" data-purpose="Debt Consolidation">💳 Debt Consolidation</div>
                <div class="purpose-pill" data-purpose="Vehicle Purchase">🚗 Vehicle Purchase</div>
                <div class="purpose-pill" data-purpose="Travel">✈️ Travel</div>
                <div class="purpose-pill" data-purpose="Events / Celebration">🎉 Events</div>
                <div class="purpose-pill" data-purpose="Emergency">⚡ Emergency</div>
              </div>
              <input class="inp" name="purpose_of_loan" id="purposeInput" type="text" placeholder="Selected above or type custom purpose…" required>
            </div>

            <!-- Interest computation (tiered compound - Philippines coop style) -->
            <div class="comp-panel">
              <div class="comp-panel-title">
                <i data-lucide="calculator"></i> Interest Computation
              </div>
              <div class="comp-rate-row" style="margin-bottom:8px;">
                <span class="comp-rate-label">Rate by loan amount (compound, monthly):</span>
              </div>
              <div class="comp-rate-row" style="font-size:12px;color:var(--muted);">
                Up to 50k → 8% p.a. &nbsp;|&nbsp; 50k–150k → 10% &nbsp;|&nbsp; 150k–500k → 12% &nbsp;|&nbsp; 500k–2M → 14% &nbsp;|&nbsp; 2M+ → 16%
              </div>
              <div class="comp-results-grid">
                <div class="comp-result">
                  <div class="lbl">Principal</div>
                  <div class="val" id="res-principal">₱ —</div>
                </div>
                <div class="comp-result">
                  <div class="lbl">Rate (tier)</div>
                  <div class="val" id="res-rate">—% p.a.</div>
                </div>
                <div class="comp-result">
                  <div class="lbl">Total Interest (compound)</div>
                  <div class="val warn" id="res-interest">₱ —</div>
                </div>
                <div class="comp-result">
                  <div class="lbl">Total Due</div>
                  <div class="val big" id="res-total">₱ —</div>
                </div>
                <div class="comp-result">
                  <div class="lbl">Loan Term</div>
                  <div class="val" id="res-term">— months</div>
                </div>
                <div class="comp-result">
                  <div class="lbl">Est. Monthly</div>
                  <div class="val big" id="res-monthly">₱ —</div>
                </div>
              </div>
              <button type="button" class="apply-btn" id="applyBtn" onclick="applyComputation()">
                <i data-lucide="check"></i> Use This Computation — Auto-fill Due Amount
              </button>
            </div>

            <!-- Due amount -->
            <div class="field" style="margin-top:20px;">
              <label>Total Due Amount <span class="req">*</span> <span class="opt">— auto-filled above or enter manually</span></label>
              <div class="inp-wrap">
                <span class="prefix">₱</span>
                <input class="inp" name="due_amount" id="dueAmount" type="number" min="0" step="0.01" placeholder="Total repayable amount" required>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ═══ STEP 6: Review & Submit ═══ -->
      <div class="step-panel" id="step-6">
        <div class="card">
          <div class="card-head">
            <div class="card-head-icon"><i data-lucide="clipboard-check"></i></div>
            <div>
              <div class="card-head-title">Review &amp; Submit</div>
              <div class="card-head-sub">Confirm all information before submitting the loan application</div>
            </div>
          </div>
          <div class="card-body">

            <!-- Personal -->
            <div class="review-section">
              <div class="review-section-title"><i data-lucide="user"></i> Personal Information</div>
              <div class="review-grid" id="rv-personal"></div>
            </div>
            <!-- Address -->
            <div class="review-section">
              <div class="review-section-title"><i data-lucide="map-pin"></i> Home Address</div>
              <div class="review-grid" id="rv-address"></div>
            </div>
            <!-- Employment -->
            <div class="review-section">
              <div class="review-section-title"><i data-lucide="briefcase"></i> Employment</div>
              <div class="review-grid" id="rv-employment"></div>
            </div>
            <!-- Loan -->
            <div class="review-section">
              <div class="review-section-title"><i data-lucide="landmark"></i> Loan Details</div>
              <div class="review-grid" id="rv-loan"></div>
            </div>

            <div style="background:#fff3cd;border:1px solid #fde68a;border-radius:10px;padding:12px 16px;display:flex;align-items:center;gap:8px;font-size:13px;color:#92400e;margin-top:4px;">
              <i data-lucide="triangle-alert" style="width:16px;height:16px;flex-shrink:0;"></i>
              Please review all information carefully. Once submitted, the application will go to the loan review queue.
            </div>
          </div>
        </div>
      </div>

      <!-- ── Navigation ── -->
      <div class="step-nav">
        <div class="step-nav-left">
          <button type="button" class="btn btn-ghost" id="btnPrev" onclick="prevStep()" style="display:none;">
            <i data-lucide="arrow-left"></i> Previous
          </button>
          <span class="step-hint" id="stepHint">
            <i data-lucide="info"></i> Fill all required fields to continue
          </span>
        </div>
        <div class="step-nav-right">
          <a href="{{route('Add.Transactions')}}" class="btn btn-ghost" id="btnCancel">
            <i data-lucide="x"></i> Cancel
          </a>
          <button type="button" class="btn btn-primary" id="btnNext" onclick="nextStep()">
            Continue <i data-lucide="arrow-right"></i>
          </button>
          <button type="submit" class="btn btn-submit" id="btnSubmit" style="display:none;">
            <i data-lucide="send"></i> Submit Application
          </button>
        </div>
      </div>

    </form>
  </div><!-- /page-body -->

  <footer class="page-footer">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div>

<script>
  lucide.createIcons();

  // ── User menu ──
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // ── Step config ──
  const STEPS = [
    { id: 1, label: 'Personal Information' },
    { id: 2, label: 'Home Address' },
    { id: 3, label: 'Guarantors' },
    { id: 4, label: 'Employment' },
    { id: 5, label: 'Loan Details' },
    { id: 6, label: 'Review & Submit' },
  ];
  let currentStep = 1;
  const TOTAL = STEPS.length;

  function updateProgress() {
    const pct = (currentStep / TOTAL) * 100;
    document.getElementById('progressBar').style.width = pct + '%';
    document.getElementById('curStep').textContent = currentStep;
    document.getElementById('progressTitle').textContent = `Step ${currentStep} — ${STEPS[currentStep-1].label}`;

    document.querySelectorAll('.step-item').forEach(el => {
      const n = parseInt(el.dataset.step);
      el.classList.remove('active','done');
      if (n === currentStep) el.classList.add('active');
      else if (n < currentStep) el.classList.add('done');
    });

    // Update connector lines (done steps)
    document.querySelectorAll('.step-item').forEach(el => {
      const n = parseInt(el.dataset.step);
      if (n < currentStep) el.classList.add('done');
    });

    // Nav buttons
    document.getElementById('btnPrev').style.display   = currentStep > 1      ? '' : 'none';
    document.getElementById('btnNext').style.display   = currentStep < TOTAL   ? '' : 'none';
    document.getElementById('btnSubmit').style.display = currentStep === TOTAL ? '' : 'none';
    document.getElementById('stepHint').style.display  = currentStep < TOTAL   ? '' : 'none';

    lucide.createIcons();
  }

  function showStep(n, goingBack) {
    document.querySelectorAll('.step-panel').forEach(p => {
      p.classList.remove('active','going-back');
    });
    const panel = document.getElementById('step-' + n);
    if (goingBack) panel.classList.add('going-back');
    panel.classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function validateCurrentStep() {
    const panel = document.getElementById('step-' + currentStep);
    let ok = true;
    panel.querySelectorAll('[required]').forEach(f => {
      const v = f.value.trim();
      if (!v) {
        ok = false;
        f.classList.add('err');
        f.addEventListener('input', () => f.classList.remove('err'), { once: true });
        f.addEventListener('change', () => f.classList.remove('err'), { once: true });
      } else {
        f.classList.remove('err');
      }
    });
    // Radio groups
    panel.querySelectorAll('input[type=radio][required]').forEach(r => {
      const group = panel.querySelector(`input[name="${r.name}"]:checked`);
      if (!group) {
        ok = false;
        r.closest('.radio-group')?.style.setProperty('outline', '2px solid var(--rose)');
      }
    });
    if (!ok) {
      const first = panel.querySelector('.err, .inp.err');
      if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    return ok;
  }

  function nextStep() {
    if (!validateCurrentStep()) return;
    if (currentStep === TOTAL - 1) buildReview();
    if (currentStep < TOTAL) {
      currentStep++;
      showStep(currentStep, false);
      updateProgress();
    }
  }

  function prevStep() {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep, true);
      updateProgress();
    }
  }

  function jumpToStep(n) {
    if (n > currentStep) return; // only go back via dots
    if (n < currentStep) {
      currentStep = n;
      showStep(currentStep, true);
      updateProgress();
    }
  }

  updateProgress();

  // ── Age calculator ──
  function calculateAge() {
    const birth = document.getElementById('birthDate').value;
    const ageEl = document.getElementById('age');
    if (!birth) { ageEl.value = ''; return; }
    const today = new Date(), bd = new Date(birth);
    let age = today.getFullYear() - bd.getFullYear();
    const m = today.getMonth() - bd.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < bd.getDate())) age--;
    ageEl.value = age >= 0 ? age : '';
  }

  // ── File upload ──
  function handleFile(wrapperId, labelId, input) {
    const wrap  = document.getElementById(wrapperId);
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
      label.textContent = input.files[0].name;
      wrap.classList.add('has-file');
    }
    lucide.createIcons();
  }

  // ── Amount pills ──
  document.querySelectorAll('#amountPills .amt-pill').forEach(pill => {
    pill.addEventListener('click', () => {
      document.querySelectorAll('#amountPills .amt-pill').forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      document.getElementById('loanAmount').value = pill.dataset.amt;
      runComputation();
    });
  });
  function clearAmtPill() {
    document.querySelectorAll('#amountPills .amt-pill').forEach(p => p.classList.remove('active'));
  }

  // ── Purpose pills ──
  document.querySelectorAll('#purposePills .purpose-pill').forEach(pill => {
    pill.addEventListener('click', () => {
      document.querySelectorAll('#purposePills .purpose-pill').forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      document.getElementById('purposeInput').value = pill.dataset.purpose;
    });
  });

  // ── Interest computation (tiered compound) ──
  const INTEREST_TIERS = @json($interestTiers ?? []);
  function getAnnualRateForAmount(amount) {
    for (let i = 0; i < INTEREST_TIERS.length; i++) {
      if (amount <= INTEREST_TIERS[i].max_amount) return parseFloat(INTEREST_TIERS[i].annual_rate);
    }
    return 16;
  }
  function fmt(n) {
    return '₱ ' + Number(n).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }
  function runComputation() {
    const principal = parseFloat(document.getElementById('loanAmount').value) || 0;
    const termEl    = document.querySelector('input[name="loan_term"]:checked');
    const term      = termEl ? parseInt(termEl.value) : 0;
    document.getElementById('res-principal').textContent = principal > 0 ? fmt(principal) : '₱ —';
    document.getElementById('res-term').textContent      = term > 0 ? term + ' months' : '— months';
    if (principal <= 0 || term <= 0) {
      document.getElementById('res-rate').textContent = '—% p.a.';
      document.getElementById('res-interest').textContent = '₱ —';
      document.getElementById('res-total').textContent    = '₱ —';
      document.getElementById('res-monthly').textContent  = '₱ —';
      return;
    }
    const annualRate = getAnnualRateForAmount(principal);
    const r = (annualRate / 100) / 12;
    // Diminishing Interest (Equal Principal) Formula
    const totalInterest = principal * r * (term + 1) / 2;
    const totalDue = principal + totalInterest;
    const monthly = totalDue / term;
    document.getElementById('res-rate').textContent = annualRate.toFixed(1) + '% p.a.';
    document.getElementById('res-interest').textContent = fmt(totalInterest);
    document.getElementById('res-total').textContent    = fmt(totalDue);
    document.getElementById('res-monthly').textContent  = fmt(monthly);
    document.getElementById('dueAmount').value = totalDue.toFixed(2);
  }
  function applyComputation() {
    const raw = document.getElementById('res-total').textContent;
    if (raw === '₱ —') return;
    document.getElementById('dueAmount').value = raw.replace('₱ ','').replace(/,/g,'');
    const btn = document.getElementById('applyBtn');
    btn.classList.add('flashed');
    setTimeout(() => btn.classList.remove('flashed'), 400);
    lucide.createIcons();
  }

  // ── Toast helpers (reused pattern) ──
  const T_ICONS = { success:'circle-check-big', error:'x-circle' };
  function showToast(type, title, msg, dur=4500) {
    const c = document.getElementById('toastContainer');
    if (!c) return;
    const t = document.createElement('div');
    t.className = `toast ${type}`;
    t.innerHTML =
      `<div class="toast-icon"><i data-lucide="${T_ICONS[type] || 'info'}"></i></div>` +
      `<div class="toast-body"><div class="toast-title">${title}</div><div class="toast-msg">${msg}</div></div>` +
      `<button class="toast-close"><i data-lucide="x"></i></button>` +
      `<div class="toast-progress" style="animation-duration:${dur}ms;"></div>`;
    c.appendChild(t);
    lucide.createIcons({ nodes:[t] });
    const dismiss = () => { t.classList.add('hiding'); t.addEventListener('animationend', () => t.remove(), { once:true }); };
    t.querySelector('.toast-close').addEventListener('click', dismiss);
    setTimeout(dismiss, dur);
  }

  @if(session('success'))
    document.addEventListener('DOMContentLoaded', () => {
      showToast('success', 'Loan Created', '{{ session('success') }}');
    });
  @endif
  @if(session('error'))
    document.addEventListener('DOMContentLoaded', () => {
      showToast('error', 'Error', '{{ session('error') }}');
    });
  @endif

  // ── Build review summary ──
  function rv(label, val, cls='') {
    return `<div class="review-cell"><div class="lbl">${label}</div><div class="val ${cls}">${val || '<span style="color:#ccc">—</span>'}</div></div>`;
  }
  function getVal(name) {
    const el = document.querySelector(`[name="${name}"]`);
    if (!el) return '';
    if (el.type === 'radio') {
      const checked = document.querySelector(`[name="${name}"]:checked`);
      return checked ? checked.value : '';
    }
    return el.value || '';
  }
  function buildReview() {
    document.getElementById('rv-personal').innerHTML =
      rv('Full Name', `${getVal('last_name')}, ${getVal('first_name')} ${getVal('middle_name')}`) +
      rv('Birth Date', getVal('birthdate')) +
      rv('Age', getVal('age') + ' yrs') +
      rv('Gender', getVal('gender')) +
      rv('Civil Status', getVal('civil_status')) +
      rv('Religion', getVal('religion')) +
      rv('Email', getVal('email')) +
      rv('Contact', '+63 ' + getVal('contact_number'));

    document.getElementById('rv-address').innerHTML =
      rv('Street', getVal('street_address')) +
      rv('Barangay', document.querySelector('#barangay option:checked')?.text || '') +
      rv('City', document.querySelector('#city option:checked')?.text || '') +
      rv('Province', document.querySelector('#province option:checked')?.text || '') +
      rv('Zip Code', getVal('zip_code')) +
      rv('Ownership', getVal('house_ownership'));

    document.getElementById('rv-employment').innerHTML =
      rv('Employment Type', getVal('employment_type')) +
      rv('Employer / Business', getVal('employer_business_name')) +
      rv('Occupation', getVal('position_nature_of_business')) +
      rv('Monthly Income', '₱ ' + (parseFloat(getVal('monthly_income'))||0).toLocaleString('en-PH', {minimumFractionDigits:2}), 'green');

    const amtFormatted = (parseFloat(getVal('loan_amount'))||0).toLocaleString('en-PH',{minimumFractionDigits:2});
    const dueFormatted = (parseFloat(getVal('due_amount'))||0).toLocaleString('en-PH',{minimumFractionDigits:2});
    document.getElementById('rv-loan').innerHTML =
      rv('Loan Type', getVal('loan_type')) +
      rv('Loan Amount', '₱ ' + amtFormatted, 'green') +
      rv('Loan Term', getVal('loan_term') + ' months') +
      rv('Purpose', getVal('purpose_of_loan')) +
      rv('Due Amount', '₱ ' + dueFormatted, 'green');

    lucide.createIcons();
  }

  // ── PSGC ──
  const PSGC = 'https://psgc.gitlab.io/api';
  const provinceEl = document.getElementById('province');
  const cityEl     = document.getElementById('city');
  const barangayEl = document.getElementById('barangay');
  fetch(`${PSGC}/provinces/`)
    .then(r => r.json())
    .then(data => {
      data.sort((a,b) => a.name.localeCompare(b.name));
      data.forEach(p => { provinceEl.innerHTML += `<option value="${p.code}">${p.name}</option>`; });
    });
  provinceEl.addEventListener('change', function() {
    cityEl.innerHTML = '<option value="">Select City</option>';
    barangayEl.innerHTML = '<option value="">Select Barangay</option>';
    if (!this.value) return;
    fetch(`${PSGC}/provinces/${this.value}/cities-municipalities/`)
      .then(r => r.json())
      .then(data => {
        data.sort((a,b) => a.name.localeCompare(b.name));
        data.forEach(c => { cityEl.innerHTML += `<option value="${c.code}">${c.name}</option>`; });
      });
  });
  cityEl.addEventListener('change', function() {
    barangayEl.innerHTML = '<option value="">Select Barangay</option>';
    document.getElementById('zipCode').value = '';
    if (!this.value) return;
    fetch(`${PSGC}/cities-municipalities/${this.value}/barangays/`)
      .then(r => r.json())
      .then(data => {
        data.sort((a,b) => a.name.localeCompare(b.name));
        data.forEach(b => { barangayEl.innerHTML += `<option value="${b.code}">${b.name}</option>`; });
      });
    fetch(`${PSGC}/cities-municipalities/${this.value}/`)
      .then(r => r.json())
      .then(city => { document.getElementById('zipCode').value = city.postalCode || ''; });
  });
</script>
</body>
</html>