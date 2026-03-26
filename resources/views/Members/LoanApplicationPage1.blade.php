<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e588cb9d47.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/png" href="{{ asset('images/logocoop-removebg-preview-2.png') }}">
  <title>Loan Application | GBLDC</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Outfit', sans-serif; background: #eef2f7; color: #1e2939; }

    /* ── CSS Tokens (from landing page) ── */
    :root {
      --ink:        #1a2e1e;
      --ink-soft:   #2d4a32;
      --ink-muted:  #4a6b4f;
      --parchment:  #ffffff;
      --parchment2: #f0f7f1;
      --canvas:     #f5faf6;
      --grove:      #16a34a;
      --grove-mid:  #15803d;
      --grove-light:#22c55e;
      --moss:       #dcfce7;
      --amber-soft: #34d399;
      --white:      #ffffff;
      --shadow-sm:  0 2px 8px rgba(22,163,74,0.08);
      --shadow-md:  0 8px 24px rgba(22,163,74,0.12);
      --shadow-lg:  0 20px 48px rgba(22,163,74,0.14);
    }

    /* ── Header (landing page style) ── */
    header {
      position: fixed; top: 0; left: 0; right: 0; z-index: 200;
      height: 68px;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 2.5rem;
      background: rgba(245,250,246,0.94);
      backdrop-filter: blur(18px) saturate(1.4);
      border-bottom: 1px solid rgba(22,163,74,0.12);
    }
    .logo {
      display: flex; align-items: center; gap: 10px;
      text-decoration: none; flex-shrink: 0;
    }
    .logo img {
      width: 46px; height: 46px;
      overflow: hidden; padding: 4px; flex-shrink: 0;
    }
    .logo-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.25rem; font-weight: 700;
      color: var(--grove); letter-spacing: 0.04em;
    }
    .nav-desktop {
      display: flex; align-items: center; gap: 0;
    }
    .nav-desktop a,
    .nav-desktop .dd-trigger {
      font-size: 0.78rem; font-weight: 600; letter-spacing: 0.06em;
      color: var(--ink-soft); text-decoration: none;
      padding: 0.45rem 0.9rem; border-radius: 6px;
      background: none; border: none; cursor: pointer;
      font-family: 'Syne', sans-serif;
      display: flex; align-items: center; gap: 4px;
      transition: color 0.2s, background 0.2s; white-space: nowrap;
    }
    .nav-desktop a:hover, .nav-desktop .dd-trigger:hover {
      color: var(--grove); background: rgba(22,163,74,0.08);
    }
    .dd-wrap { position: relative; }
    .dd-panel {
      position: absolute; top: calc(100% + 6px); left: 0;
      min-width: 190px; background: var(--white);
      border: 1px solid rgba(22,163,74,0.12); border-radius: 12px;
      padding: 0.35rem; box-shadow: var(--shadow-md);
      opacity: 0; visibility: hidden; transform: translateY(6px);
      transition: all 0.2s ease;
    }
    .dd-wrap:hover .dd-panel { opacity: 1; visibility: visible; transform: none; }
    .dd-panel a {
      display: block; font-size: 0.78rem; font-weight: 500; letter-spacing: 0.04em;
      color: var(--ink-soft); text-decoration: none;
      padding: 0.55rem 0.85rem; border-radius: 8px;
      transition: background 0.15s, color 0.15s;
    }
    .dd-panel a:hover { background: var(--parchment2); color: var(--grove); }

    .profile-wrap { position: relative; }
    .profile-btn { display: flex; align-items: center; gap: 7px; cursor: pointer; background: none; border: none; padding: 0; }
    .profile-img { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid var(--moss); }
    .profile-chevron { font-size: 0.65rem; color: var(--ink-muted); transition: transform 0.2s; }
    .profile-wrap:hover .profile-chevron { transform: rotate(180deg); }
    .profile-panel {
      position: absolute; right: 0; top: calc(100% + 8px); width: 220px;
      background: var(--white); border: 1px solid rgba(22,163,74,0.12);
      border-radius: 14px; padding: 0.5rem; box-shadow: var(--shadow-lg);
      opacity: 0; visibility: hidden; transform: translateY(6px); transition: all 0.2s;
    }
    .profile-wrap:hover .profile-panel { opacity: 1; visibility: visible; transform: none; }
    .profile-panel a {
      display: block; padding: 0.6rem 0.85rem;
      font-size: 0.78rem; font-weight: 500; letter-spacing: 0.04em;
      color: var(--ink-soft); text-decoration: none; border-radius: 8px;
      transition: background 0.15s, color 0.15s;
    }
    .profile-panel a:hover { background: var(--parchment2); color: var(--grove); }
    .profile-panel .divider { height: 1px; background: var(--parchment2); margin: 0.4rem 0; }
    .profile-panel .danger { color: #c0392b !important; }
    .profile-panel .danger:hover { background: #fff0ee !important; color: #c0392b !important; }

    .ham-btn {
      display: none; width: 40px; height: 40px;
      border-radius: 8px; border: 1px solid rgba(22,163,74,0.18);
      background: none; cursor: pointer; align-items: center; justify-content: center;
      color: var(--ink);
    }
    .ham-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; }

    .mobile-nav {
      display: none; flex-direction: column; gap: 2px;
      position: fixed; inset: 68px 0 0;
      background: var(--canvas); padding: 1.25rem;
      overflow-y: auto; z-index: 199;
    }
    .mobile-nav.open { display: flex; }
    .mobile-nav a,
    .mobile-nav-group > button {
      display: block; width: 100%; text-align: left;
      padding: 0.7rem 1rem; border-radius: 10px;
      font-size: 0.9rem; font-weight: 600; letter-spacing: 0.04em;
      color: var(--ink-soft); text-decoration: none;
      background: none; border: none; cursor: pointer;
      font-family: 'Syne', sans-serif; transition: background 0.15s, color 0.15s;
    }
    .mobile-nav a:hover, .mobile-nav-group > button:hover { background: var(--parchment2); color: var(--grove); }
    .mobile-sub { display: none; padding-left: 1rem; }
    .mobile-sub.open { display: block; }
    .mobile-sub a { font-size: 0.83rem; }
    .mobile-divider { height: 1px; background: var(--parchment2); margin: 0.5rem 0; }

    @media (max-width: 1024px) {
      .nav-desktop { display: none; }
      .profile-wrap { display: none; }
      .ham-btn { display: flex; }
    }

    /* ── Layout ── */
    .reg-wrapper {
      display: flex;
      max-width: 1120px;
      margin: 100px auto 60px auto;
      padding: 0 16px;
      gap: 24px;
      align-items: flex-start;
    }

    /* ── Sidebar ── */
    .reg-sidebar {
      width: 240px;
      flex-shrink: 0;
      background: #fff;
      border-radius: 16px;
      border: 1.5px solid #e5e7eb;
      box-shadow: 0 2px 12px rgba(0,0,0,0.05);
      overflow: hidden;
      position: sticky;
      top: 100px;
    }
    .sidebar-top {
      background: #16a34a;
      padding: 20px 18px 16px 18px;
    }
    .sidebar-top .sidebar-label {
      font-size: 0.68rem; font-weight: 700; color: rgba(255,255,255,0.7);
      text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 3px;
    }
    .sidebar-top .sidebar-title {
      font-size: 1rem; font-weight: 700; color: #fff;
    }

    .step-nav-list { padding: 12px 10px; }
    .step-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 9px 10px; border-radius: 10px; margin-bottom: 2px;
      cursor: pointer; transition: background 0.2s; position: relative;
    }
    .step-nav-item.active { background: #f0fdf4; }
    .step-nav-item.clickable:hover { background: #f8fafc; }

    .step-nav-item:not(:last-child)::after {
      content: ''; position: absolute; left: 25px; top: 40px;
      width: 2px; height: calc(100% - 12px);
      background: #e5e7eb; z-index: 0;
    }
    .step-nav-item.done:not(:last-child)::after { background: #16a34a; }

    .step-nav-circle {
      width: 32px; height: 32px; border-radius: 50%;
      border: 2px solid #d1d5db; background: #fff;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; color: #9ca3af;
      transition: all 0.3s; z-index: 1; position: relative;
    }
    .step-nav-circle svg { width: 14px; height: 14px; }
    .step-nav-item.active .step-nav-circle {
      background: #16a34a; border-color: #16a34a; color: #fff;
      box-shadow: 0 0 0 4px rgba(22,163,74,0.15);
    }
    .step-nav-item.done .step-nav-circle {
      background: #16a34a; border-color: #16a34a; color: #fff;
    }
    .step-nav-label { font-size: 0.78rem; font-weight: 600; color: #9ca3af; line-height: 1.3; }
    .step-nav-sub   { font-size: 0.67rem; color: #9ca3af; margin-top: 1px; }
    .step-nav-item.active .step-nav-label { color: #16a34a; }
    .step-nav-item.active .step-nav-sub   { color: #6b7280; }
    .step-nav-item.done   .step-nav-label { color: #374151; }

    /* ── Main ── */
    .reg-main { flex: 1; min-width: 0; }
    .step-panel { display: none; }
    .step-panel.active { display: block; }

    /* ── Generic layout helpers (Tailwind-like) ── */
    .flex { display: flex; }
    .justify-end { justify-content: flex-end; }
    .justify-between { justify-content: space-between; }

    /* ── Card ── */
    .form-card {
      background: #fff; border-radius: 16px;
      border: 1.5px solid #e5e7eb;
      box-shadow: 0 2px 12px rgba(0,0,0,0.05);
      padding: 32px 36px; margin-bottom: 20px;
    }

    /* ── Section heading ── */
    .section-header { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
    .section-header h3 { font-size: 1.08rem; font-weight: 700; color: #134e4a; }
    .section-icon {
      width: 38px; height: 38px;
      background: #f0fdf4; border: 1.5px solid #bbf7d0;
      border-radius: 10px; display: flex; align-items: center; justify-content: center;
      color: #16a34a; flex-shrink: 0;
    }
    .section-icon svg { width: 17px; height: 17px; }

    .page-tag {
      display: inline-flex; align-items: center; gap: 5px;
      background: #f0fdf4; border: 1px solid #bbf7d0;
      border-radius: 99px; padding: 3px 12px;
      font-size: 0.72rem; font-weight: 600; color: #15803d;
      margin-bottom: 20px;
    }
    .page-tag svg { width: 12px; height: 12px; }

    /* ── Form elements ── */
    .form-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; margin-bottom: 18px; }
    .form-grid.cols2 { grid-template-columns: repeat(2,1fr); }
    .form-grid.cols1 { grid-template-columns: 1fr; }
    .field.span2 { grid-column: span 2; }
    .field.span3 { grid-column: span 3; }
    @media(max-width:700px){
      .form-grid,.form-grid.cols2{ grid-template-columns:1fr; }
      .field.span2,.field.span3{ grid-column:span 1; }
    }
    .field { display: flex; flex-direction: column; gap: 6px; }

    .field-label { font-size: 0.8rem; font-weight: 600; color: #374151; }
    .field-label .req { color: #ef4444; margin-left: 2px; }
    .field-label .opt { color: #94a3b8; font-weight: 400; font-size: 0.72rem; }
    .field-hint { font-size: 0.72rem; color: #94a3b8; display: flex; align-items: center; gap: 4px; }
    .field-hint svg { width: 11px; height: 11px; }

    .form-input, .form-select {
      width: 100%; background: #f9fafb;
      border: 1.5px solid #d1d5db; border-radius: 10px;
      padding: 11px 14px; font-size: 0.9rem; color: #1f2937;
      font-family: 'Outfit', sans-serif;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
      outline: none; appearance: none; -webkit-appearance: none;
    }
    .form-input::placeholder { color: #9ca3af; }
    .form-input:focus, .form-select:focus {
      border-color: #16a34a; background: #fff;
      box-shadow: 0 0 0 3px rgba(22,163,74,0.12);
    }
    .form-input[readonly] { background: #f3f4f6; color: #6b7280; cursor: default; }

    .select-wrapper { position: relative; }
    .select-wrapper::after {
      content: '';
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      width: 14px; height: 14px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat; background-size: contain; pointer-events: none;
    }
    .select-wrapper .form-select { padding-right: 36px; cursor: pointer; }

    /* prefix/suffix */
    .inp-wrap { position: relative; display: flex; align-items: center; }
    .inp-wrap .form-input { padding-left: 36px; }
    .inp-prefix {
      position: absolute; left: 12px;
      font-size: 0.88rem; color: #6b7280; pointer-events: none; font-weight: 600;
    }
    .inp-suffix {
      position: absolute; right: 12px;
      font-size: 0.78rem; color: #94a3b8; pointer-events: none;
    }
    .phone-wrapper {
      display: flex; border: 1.5px solid #d1d5db;
      border-radius: 10px; overflow: hidden; background: #f9fafb;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .phone-wrapper:focus-within { border-color: #16a34a; background: #fff; box-shadow: 0 0 0 3px rgba(22,163,74,0.12); }
    .phone-prefix { padding: 11px 12px; background: #f3f4f6; border-right: 1.5px solid #d1d5db; color: #374151; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; gap: 5px; white-space: nowrap; }
    .phone-prefix svg { width: 12px; height: 12px; color: #9ca3af; }
    .phone-input { flex: 1; border: none; background: transparent; padding: 11px 14px; font-size: 0.9rem; color: #1f2937; outline: none; font-family: 'Outfit', sans-serif; }

    /* ── Radio pills ── */
    .radio-group { display: flex; gap: 10px; flex-wrap: wrap; }
    .radio-pill {
      display: flex; align-items: center; gap: 7px;
      padding: 9px 16px; border: 1.5px solid #d1d5db; border-radius: 10px;
      cursor: pointer; font-size: 0.88rem; font-weight: 500;
      color: #374151; background: #f9fafb;
      transition: border-color 0.2s, background 0.2s, color 0.2s; user-select: none;
    }
    .radio-pill input { display: none; }
    .radio-pill:hover { border-color: #86efac; background: #f0fdf4; }
    .radio-pill.selected { border-color: #16a34a; background: #f0fdf4; color: #16a34a; font-weight: 600; }
    .radio-pill svg { width: 15px; height: 15px; }

    /* ── Amount / Purpose pills ── */
    .pill-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; }
    .amt-pill, .purpose-pill {
      padding: 7px 16px; border-radius: 20px;
      border: 1.5px solid #d1d5db; font-size: 0.84rem; font-weight: 500;
      cursor: pointer; background: #fff; transition: all 0.15s; color: #374151;
    }
    .amt-pill:hover, .purpose-pill:hover { border-color: #86efac; background: #f0fdf4; }
    .amt-pill.selected, .purpose-pill.selected { background: #16a34a; color: #fff; border-color: #16a34a; }

    /* ── Term pills ── */
    .term-grid { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 12px; }
    .term-pill {
      display: flex; flex-direction: column; align-items: center;
      padding: 14px 24px; border: 1.5px solid #d1d5db; border-radius: 12px;
      cursor: pointer; transition: all 0.15s; background: #fff; user-select: none;
    }
    .term-pill input { display: none; }
    .term-num { font-size: 1.5rem; font-weight: 800; color: #374151; line-height: 1; }
    .term-unit { font-size: 0.72rem; color: #64748b; font-weight: 500; margin-top: 2px; }
    .term-pill:hover { border-color: #86efac; background: #f0fdf4; }
    .term-pill.selected { border-color: #16a34a; background: #f0fdf4; }
    .term-pill.selected .term-num { color: #16a34a; }

    /* ── File upload ── */
    .upload-zone {
      border: 2px dashed #d1d5db; border-radius: 12px; background: #f9fafb;
      padding: 22px 16px; text-align: center; cursor: pointer;
      transition: border-color 0.2s, background 0.2s; position: relative;
    }
    .upload-zone:hover { border-color: #16a34a; background: #f0fdf4; }
    .upload-zone input { display: none; }
    .upload-zone .upl-icon { display: flex; justify-content: center; margin-bottom: 8px; color: #9ca3af; }
    .upload-zone .upl-icon svg { width: 28px; height: 28px; }
    .upload-zone .upl-label { font-size: 0.84rem; font-weight: 600; color: #374151; margin-bottom: 2px; }
    .upload-zone .upl-hint  { font-size: 0.75rem; color: #9ca3af; }
    .upload-zone.has-file { border-color: #16a34a; background: #f0fdf4; }
    .upload-zone.has-file .upl-label { color: #15803d; }

    /* ── Computation panel ── */
    .comp-panel {
      background: #f8fafb; border: 1.5px solid #e2e8f0;
      border-radius: 12px; padding: 20px 22px; margin-top: 8px;
    }
    .comp-panel-title {
      display: flex; align-items: center; gap: 8px;
      font-size: 0.92rem; font-weight: 700; color: #1e2939; margin-bottom: 12px;
    }
    .comp-panel-title svg { width: 16px; height: 16px; color: #16a34a; }
    .comp-results-grid {
      display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; margin: 14px 0;
    }
    @media(max-width:600px){ .comp-results-grid{ grid-template-columns: repeat(2,1fr); } }
    .comp-result {
      background: #fff; border: 1px solid #e9eef4; border-radius: 10px; padding: 12px 14px;
    }
    .comp-result .lbl { font-size: 0.72rem; color: #64748b; font-weight: 500; }
    .comp-result .val { font-size: 0.95rem; font-weight: 700; color: #1e2939; margin-top: 3px; }
    .comp-result .val.warn { color: #dc2626; }
    .comp-result .val.big  { font-size: 1rem; color: #15803d; }
    .apply-btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 10px 20px; background: #16a34a; color: #fff;
      border: none; border-radius: 10px; font-size: 0.85rem; font-weight: 600;
      cursor: pointer; transition: background 0.15s; font-family: 'Outfit', sans-serif;
    }
    .apply-btn:hover { background: #15803d; }
    .apply-btn svg { width: 14px; height: 14px; }

    /* ── Review ── */
    .review-section { margin-bottom: 24px; }
    .review-section-title {
      display: flex; align-items: center; gap: 7px;
      font-size: 0.88rem; font-weight: 700; color: #374151; margin-bottom: 10px;
    }
    .review-section-title svg { width: 15px; height: 15px; color: #16a34a; }
    .review-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 8px; }
    @media(max-width:500px){ .review-grid{ grid-template-columns:1fr; } }
    .rv-item { background: #f8fafb; border: 1px solid #e9eef4; border-radius: 10px; padding: 10px 14px; }
    .rv-label { font-size: 0.7rem; color: #64748b; font-weight: 500; }
    .rv-value { font-size: 0.88rem; font-weight: 600; color: #1e2939; margin-top: 2px; }

    /* ── Info/warning banners ── */
    .info-banner {
      display: flex; align-items: flex-start; gap: 10px;
      border-radius: 10px; padding: 12px 14px; font-size: 0.84rem; margin-bottom: 18px;
    }
    .info-banner svg { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }
    .info-banner.blue  { background: #eff6ff; border: 1.5px solid #bfdbfe; color: #1e40af; }
    .info-banner.amber { background: #fffbeb; border: 1.5px solid #fde68a; color: #92400e; }
    .info-banner.blue  svg { color: #3b82f6; }
    .info-banner.amber svg { color: #f59e0b; }

    /* ── Divider ── */
    .section-divider { border: none; border-top: 1.5px solid #e5e7eb; margin: 24px 0; }

    /* ── Nav buttons ── */
    .btn-next {
      background: #16a34a; color: #fff; border: none; border-radius: 10px;
      padding: 11px 28px; font-size: 0.9rem; font-weight: 600; cursor: pointer;
      display: inline-flex; align-items: center; gap: 7px;
      margin-left: auto;
      box-shadow: 0 4px 14px rgba(22,163,74,0.25);
      transition: background 0.2s, transform 0.15s; font-family: 'Outfit', sans-serif;
    }
    .btn-next svg { width: 15px; height: 15px; }
    .btn-next:hover { background: #15803d; transform: translateY(-1px); }
    .btn-prev {
      background: #fff; color: #374151; border: 1.5px solid #d1d5db; border-radius: 10px;
      padding: 10px 22px; font-size: 0.9rem; font-weight: 600; cursor: pointer;
      display: inline-flex; align-items: center; gap: 7px;
      transition: background 0.2s, border-color 0.2s; font-family: 'Outfit', sans-serif;
    }
    .btn-prev svg { width: 15px; height: 15px; }
    .btn-prev:hover { background: #f9fafb; border-color: #9ca3af; }
    .btn-submit {
      background: #0f766e; color: #fff; border: none; border-radius: 10px;
      padding: 11px 28px; font-size: 0.9rem; font-weight: 600; cursor: pointer;
      display: inline-flex; align-items: center; gap: 7px;
      box-shadow: 0 4px 14px rgba(15,118,110,0.25);
      transition: background 0.2s, transform 0.15s; font-family: 'Outfit', sans-serif;
    }
    .btn-submit svg { width: 15px; height: 15px; }
    .btn-submit:hover { background: #0d6660; transform: translateY(-1px); }
    .btn-cancel {
      background: #fff; color: #374151; border: 1.5px solid #d1d5db; border-radius: 10px;
      padding: 10px 22px; font-size: 0.9rem; font-weight: 600; cursor: pointer;
      display: inline-flex; align-items: center; gap: 7px; text-decoration: none;
      transition: background 0.2s; font-family: 'Outfit', sans-serif;
    }
    .btn-cancel:hover { background: #fef2f2; border-color: #fca5a5; color: #dc2626; }

    /* ── Terms checkbox ── */
    .terms-wrapper { display: flex; align-items: flex-start; gap: 10px; background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 10px; padding: 14px 16px; }
    .terms-wrapper input[type="checkbox"] { accent-color: #16a34a; width: 17px; height: 17px; margin-top: 2px; flex-shrink: 0; }

    /* ── Tooltip ── */
    .tooltip-wrapper { position: relative; display: inline-flex; align-items: center; margin-left: 4px; }
    .tooltip-icon { color: #9ca3af; cursor: help; display: flex; }
    .tooltip-icon svg { width: 13px; height: 13px; }
    .tooltip-box { position: absolute; left: 50%; bottom: calc(100% + 6px); transform: translateX(-50%); background: #1f2937; color: #fff; font-size: 0.72rem; padding: 6px 10px; border-radius: 7px; pointer-events: none; opacity: 0; transition: opacity 0.2s; z-index: 100; max-width: 220px; white-space: normal; text-align: center; }
    .tooltip-wrapper:hover .tooltip-box { opacity: 1; }

    /* ── Responsive ── */
    @media(max-width:900px){
      .reg-wrapper { flex-direction: column; margin-top: 80px; }
      .reg-sidebar { width: 100%; position: static; }
      .step-nav-item:not(:last-child)::after { display: none; }
      .step-nav-list { display: flex; flex-wrap: wrap; gap: 4px; padding: 10px; }
      .step-nav-item { flex: 1; min-width: 80px; flex-direction: column; align-items: center; gap: 4px; padding: 8px 4px; }
      .step-nav-sub { display: none; }
      .form-card { padding: 24px 18px; }
    }
    @media(max-width:640px) {
      header { padding: 0 1rem; }
    }

    /* ── Logout Modal (landing page style) ── */
    .modal-bg {
      position: fixed; inset: 0;
      background: rgba(26,46,30,0.55);
      backdrop-filter: blur(4px);
      z-index: 500;
      display: none; align-items: center; justify-content: center;
    }
    .modal-bg.open { display: flex; }
    .modal-box {
      background: var(--white); border-radius: 18px; padding: 2.25rem;
      width: 380px; max-width: 90vw;
      box-shadow: var(--shadow-lg); text-align: center;
      animation: modalPop 0.28s ease;
    }
    @keyframes modalPop {
      from { opacity: 0; transform: scale(0.9) translateY(10px); }
      to   { opacity: 1; transform: none; }
    }
    .modal-icon {
      width: 52px; height: 52px; border-radius: 14px;
      background: #fff0ee; margin: 0 auto 1.25rem;
      display: flex; align-items: center; justify-content: center;
    }
    .modal-h {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5rem; font-weight: 700; color: var(--ink); margin-bottom: 0.5rem;
    }
    .modal-p { font-size: 0.875rem; color: var(--ink-muted); line-height: 1.65; margin-bottom: 1.75rem; }
    .modal-btns { display: flex; gap: 10px; justify-content: center; }
    .modal-btn-ghost {
      padding: 0.65rem 1.4rem; border-radius: 8px;
      border: 1.5px solid rgba(22,163,74,0.2);
      background: transparent; color: var(--ink-soft);
      font-family: 'Syne', sans-serif; font-size: 0.83rem; font-weight: 600;
      cursor: pointer; transition: background 0.2s;
    }
    .modal-btn-ghost:hover { background: var(--parchment2); }
    .modal-btn-danger {
      padding: 0.65rem 1.4rem; border-radius: 8px;
      border: none; background: #c0392b; color: #fff;
      font-family: 'Syne', sans-serif; font-size: 0.83rem; font-weight: 700;
      cursor: pointer; text-decoration: none; display: inline-block;
      transition: background 0.2s;
    }
    .modal-btn-danger:hover { background: #a93226; }
  </style>
</head>
<body>

  <!-- ═══════════ HEADER (landing page style) ═══════════ -->
  <header>
    <a href="{{ route('Member.Landing') }}" class="logo">
      <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
      <span class="logo-name">GBLDC</span>
    </a>

    <nav class="nav-desktop">
      <a href="{{ route('Member.Landing') }}">Home</a>

      <div class="dd-wrap">
        <button class="dd-trigger">
          Products &amp; Services
          <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="dd-panel">
          <a href="{{ route('Under.Construction') }}">Loans</a>
          <a href="{{ route('Under.Construction') }}">Deposits</a>
          <a href="{{ route('Under.Construction') }}">Savings</a>
        </div>
      </div>

      <div class="dd-wrap">
        <button class="dd-trigger">
          About
          <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="dd-panel">
          <a href="{{ route('Member.AboutUs') }}">About GBLDC</a>
          <a href="{{ route('Under.Construction') }}">Mission &amp; Vision</a>
          <a href="{{ route('Under.Construction') }}">Board of Directors</a>
          <a href="{{ route('Under.Construction') }}">Committee Officers</a>
        </div>
      </div>

      <a href="{{ route('Under.Construction') }}">News &amp; Events</a>
    </nav>

    <div style="display:flex;align-items:center;gap:12px;">
      <div class="profile-wrap nav-desktop" style="display:flex;">
        <button class="profile-btn">
          <img src="{{ asset('images/profile.png') }}" alt="Profile" class="profile-img">
          <i class="fas fa-chevron-down profile-chevron"></i>
        </button>
        <div class="profile-panel">
          <a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a>
          <a href="{{ route('Member.Notifications') }}">Notifications</a>
          <a href="{{ route('Member.AccountSettings') }}">Settings</a>
          <a href="{{ route('Member.ContactUs') }}">Help &amp; Support</a>
          <div class="divider"></div>
          <a href="#" class="danger" onclick="openLogoutModal()">Logout</a>
        </div>
      </div>
      <button class="ham-btn" onclick="toggleMobileNav()">
        <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>
  </header>

  <div class="mobile-nav" id="mobile-nav">
    <a href="{{ route('Member.Landing') }}">Home</a>
    <div class="mobile-nav-group">
      <button onclick="this.nextElementSibling.classList.toggle('open')">Products &amp; Services</button>
      <div class="mobile-sub">
        <a href="{{ route('Under.Construction') }}">Loans</a>
        <a href="{{ route('Under.Construction') }}">Deposits</a>
        <a href="{{ route('Under.Construction') }}">Savings</a>
      </div>
    </div>
    <div class="mobile-nav-group">
      <button onclick="this.nextElementSibling.classList.toggle('open')">About</button>
      <div class="mobile-sub">
        <a href="{{ route('Member.AboutUs') }}">About GBLDC</a>
        <a href="{{ route('Under.Construction') }}">Mission &amp; Vision</a>
        <a href="{{ route('Under.Construction') }}">Board of Directors</a>
        <a href="{{ route('Under.Construction') }}">Committee Officers</a>
      </div>
    </div>
    <a href="{{ route('Under.Construction') }}">News &amp; Events</a>
    <div class="mobile-divider"></div>
    <a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a>
    <a href="{{ route('Member.Notifications') }}">Notifications</a>
    <a href="{{ route('Member.AccountSettings') }}">Settings</a>
    <a href="{{ route('Member.ContactUs') }}">Help &amp; Support</a>
    <a href="#" style="color:#c0392b;" onclick="openLogoutModal()">Logout</a>
  </div>

  <!-- ══ PAGE WRAPPER ══ -->
  <div class="reg-wrapper">

    <!-- ── SIDEBAR ── -->
    <aside class="reg-sidebar">
      <div class="sidebar-top">
        <div class="sidebar-label">Member Portal</div>
        <div class="sidebar-title">Loan Application</div>
      </div>
      <div class="step-nav-list">
        <div class="step-nav-item active clickable" id="snav-1" onclick="jumpToStep(1)">
          <div class="step-nav-circle" id="snav-circle-1"><i data-lucide="user"></i></div>
          <div>
            <div class="step-nav-label" id="snav-label-1">Personal Info</div>
            <div class="step-nav-sub">Name, age, contact</div>
          </div>
        </div>
        <div class="step-nav-item clickable" id="snav-2" onclick="jumpToStep(2)">
          <div class="step-nav-circle" id="snav-circle-2"><i data-lucide="map-pin"></i></div>
          <div>
            <div class="step-nav-label" id="snav-label-2">Home Address</div>
            <div class="step-nav-sub">Province, city, barangay</div>
          </div>
        </div>
        <div class="step-nav-item clickable" id="snav-3" onclick="jumpToStep(3)">
          <div class="step-nav-circle" id="snav-circle-3"><i data-lucide="users"></i></div>
          <div>
            <div class="step-nav-label" id="snav-label-3">Guarantors</div>
            <div class="step-nav-sub">Co-makers info</div>
          </div>
        </div>
        <div class="step-nav-item clickable" id="snav-4" onclick="jumpToStep(4)">
          <div class="step-nav-circle" id="snav-circle-4"><i data-lucide="briefcase"></i></div>
          <div>
            <div class="step-nav-label" id="snav-label-4">Employment</div>
            <div class="step-nav-sub">Work & income info</div>
          </div>
        </div>
        <div class="step-nav-item clickable" id="snav-5" onclick="jumpToStep(5)">
          <div class="step-nav-circle" id="snav-circle-5"><i data-lucide="landmark"></i></div>
          <div>
            <div class="step-nav-label" id="snav-label-5">Loan Details</div>
            <div class="step-nav-sub">Amount, term, purpose</div>
          </div>
        </div>
        <div class="step-nav-item clickable" id="snav-6" onclick="jumpToStep(6)">
          <div class="step-nav-circle" id="snav-circle-6"><i data-lucide="clipboard-check"></i></div>
          <div>
            <div class="step-nav-label" id="snav-label-6">Review & Submit</div>
            <div class="step-nav-sub">Confirm & send</div>
          </div>
        </div>
      </div>
    </aside>

    <!-- ── MAIN ── -->
    <div class="reg-main">
      <form action="{{ route('Loan.Submit') }}" method="POST" enctype="multipart/form-data" id="loanForm">
        @csrf
        <input type="hidden" name="member_id" value="{{ optional($AutoComplete)->member_id }}">

        @if(session('success'))
        <div class="info-banner blue mb-4">
          <i data-lucide="circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
        @endif
        @if($errors->any())
        <div style="background:#fef2f2;border:1.5px solid #fca5a5;border-radius:12px;padding:14px 18px;margin-bottom:16px;font-size:0.84rem;color:#b91c1c;">
          <div style="font-weight:700;margin-bottom:6px;display:flex;align-items:center;gap:6px;"><i data-lucide="circle-alert" style="width:14px;height:14px;"></i> Please fix the following errors:</div>
          <ul style="margin-left:18px;list-style:disc;">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
          </ul>
        </div>
        @endif

        <!-- ═══ STEP 1: Personal Info ═══ -->
        <div class="step-panel active" id="step-1">
          <div class="form-card">
            <div class="page-tag"><i data-lucide="circle-check"></i> Step 1 of 6</div>
            <div class="section-header">
              <div class="section-icon"><i data-lucide="user"></i></div>
              <div>
                <h3>Personal Information</h3>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">Full name, birth info, and contact details</p>
              </div>
            </div>

            <div class="form-grid">
              <div class="field">
                <label class="field-label">Last Name <span class="req">*</span></label>
                <input class="form-input" name="last_name" type="text" placeholder="e.g. Dela Cruz" value="{{ optional($AutoComplete)->last_name }}" required>
              </div>
              <div class="field">
                <label class="field-label">First Name <span class="req">*</span></label>
                <input class="form-input" name="first_name" type="text" placeholder="e.g. Juan" value="{{ optional($AutoComplete)->first_name }}" required>
              </div>
              <div class="field">
                <label class="field-label">Middle Name <span class="req">*</span></label>
                <input class="form-input" name="middle_name" type="text" placeholder="e.g. Santos" value="{{ optional($AutoComplete)->middle_name }}" required>
              </div>
            </div>

            <div class="form-grid">
              <div class="field">
                <label class="field-label">Place of Birth <span class="req">*</span></label>
                <input class="form-input" name="place_of_birth" type="text" placeholder="City / Municipality" value="{{ optional($AutoComplete)->place_of_birth }}" required>
              </div>
              <div class="field">
                <label class="field-label">Birth Date <span class="req">*</span></label>
                <input class="form-input" name="birthdate" id="birthDate" type="date" value="{{ optional($AutoComplete)->birthdate }}" required onchange="calculateAge()">
              </div>
              <div class="field">
                <label class="field-label">Age <span class="req">*</span></label>
                <div class="inp-wrap">
                  <input class="form-input" name="age" id="ageField" type="number" value="{{ optional($AutoComplete)->age }}" readonly required style="padding-right:42px;">
                  <span class="inp-suffix">yrs</span>
                </div>
                <div class="field-hint"><i data-lucide="info"></i> Auto-computed from birth date</div>
              </div>
            </div>

            <div class="form-grid">
              <div class="field">
                <label class="field-label">Gender <span class="req">*</span></label>
                <div class="radio-group">
                  <label class="radio-pill" id="gMaleLabel" onclick="selectRadioPill('gender','Male','gMaleLabel','gFemaleLabel')">
                    <input type="radio" name="gender" value="Male" {{ optional($AutoComplete)->gender == 'Male' ? 'checked' : '' }} required>
                    <i data-lucide="user"></i> Male
                  </label>
                  <label class="radio-pill" id="gFemaleLabel" onclick="selectRadioPill('gender','Female','gMaleLabel','gFemaleLabel')">
                    <input type="radio" name="gender" value="Female" {{ optional($AutoComplete)->gender == 'Female' ? 'checked' : '' }}>
                    <i data-lucide="user"></i> Female
                  </label>
                </div>
              </div>
              <div class="field">
                <label class="field-label">Civil Status <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" name="civil_status" required>
                    <option value="">Select status</option>
                    <option value="SINGLE"    {{ optional($AutoComplete)->civil_status=='SINGLE'    ?'selected':'' }}>Single</option>
                    <option value="MARRIED"   {{ optional($AutoComplete)->civil_status=='MARRIED'   ?'selected':'' }}>Married</option>
                    <option value="WIDOW"     {{ optional($AutoComplete)->civil_status=='WIDOW'     ?'selected':'' }}>Widow / Widower</option>
                    <option value="SEPARATED" {{ optional($AutoComplete)->civil_status=='SEPARATED' ?'selected':'' }}>Separated</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label class="field-label">Religion <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" name="religion" required>
                    <option value="">Select religion</option>
                    <option>ROMAN CATHOLIC</option><option>PROTESTANT</option><option>CHRISTIAN</option>
                    <option>BAPTIST</option><option>SEVENTH-DAY ADVENTIST</option><option>IGLESIA NI CRISTO</option>
                    <option>ADVENTIST</option><option>BUDDHISM</option><option>JESUS IS LORD MOVEMENT</option>
                    <option>JEHOVAH'S WITNESSES</option><option>METHODIST</option><option>NON-SECTARIAN</option>
                    <option>OTHER</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-grid cols2">
              <div class="field">
                <label class="field-label">Email Address <span class="req">*</span></label>
                <input class="form-input" name="email" type="email" placeholder="juan@email.com" value="{{ optional($AutoComplete)->email }}" required>
              </div>
              <div class="field">
                <label class="field-label">Contact Number <span class="req">*</span></label>
                <div class="phone-wrapper">
                  <span class="phone-prefix"><i data-lucide="phone"></i> +63</span>
                  <input class="phone-input" name="contact_number" type="tel" pattern="[0-9]{10}" maxlength="10" placeholder="9XXXXXXXXX" value="{{ optional($AutoComplete)->contact_number }}" required inputmode="numeric">
                </div>
              </div>
              <div class="field">
                <label class="field-label">Nationality <span class="req">*</span></label>
                <input class="form-input" name="nationality" type="text" placeholder="e.g. Filipino" value="{{ optional($AutoComplete)->nationality ?? 'Filipino' }}" required>
              </div>
            </div>

            <div class="flex justify-end mt-8">
              <button type="button" class="btn-next" onclick="nextStep()">Next <i data-lucide="arrow-right"></i></button>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 2: Home Address ═══ -->
        <div class="step-panel" id="step-2">
          <div class="form-card">
            <div class="page-tag"><i data-lucide="circle-check"></i> Step 2 of 6</div>
            <div class="section-header">
              <div class="section-icon"><i data-lucide="map-pin"></i></div>
              <div>
                <h3>Home Address</h3>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">Current residential address of the applicant</p>
              </div>
            </div>

            <div class="form-grid">
              <div class="field">
                <label class="field-label">Province <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" id="province" name="province" required>
                    <option value="{{ optional($AutoComplete)->province }}">{{ optional($AutoComplete)->province ?? 'Select Province' }}</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label class="field-label">City / Municipality <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" id="city" name="city_municipality" required>
                    <option value="{{ optional($AutoComplete)->city }}">{{ optional($AutoComplete)->city ?? 'Select City' }}</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label class="field-label">Barangay <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" id="barangay" name="barangay" required>
                    <option value="{{ optional($AutoComplete)->barangay }}">{{ optional($AutoComplete)->barangay ?? 'Select Barangay' }}</option>
                  </select>
                </div>
              </div>
              <div class="field span2">
                <label class="field-label">Street Address <span class="req">*</span></label>
                <input class="form-input" name="street_address" type="text" placeholder="House No., Street Name" value="{{ optional($AutoComplete)->street_address }}" required>
              </div>
              <div class="field">
                <label class="field-label">Zip Code <span class="req">*</span>
                  <span class="tooltip-wrapper"><span class="tooltip-icon"><i data-lucide="info"></i></span><span class="tooltip-box">4-digit Philippine postal code</span></span>
                </label>
                <input class="form-input" id="zipCode" name="zip_code" type="text" placeholder="e.g. 3000" value="{{ optional($AutoComplete)->zip_code }}" required>
              </div>
            </div>

            <div class="form-grid cols2">
              <div class="field">
                <label class="field-label">Years of Stay <span class="req">*</span></label>
                <div class="inp-wrap">
                  <input class="form-input" name="year_of_stay" type="text" placeholder="e.g. 5" value="{{ optional($AutoComplete)->year_of_stay }}" required style="padding-right:40px;">
                  <span class="inp-suffix">yrs</span>
                </div>
              </div>
              <div class="field">
                <label class="field-label">House Ownership <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" name="house_ownership" required>
                    <option value="">Select type</option>
                    <option value="Owned"               {{ optional($AutoComplete)->house_ownership=='Owned'               ?'selected':'' }}>Owned</option>
                    <option value="Rented"              {{ optional($AutoComplete)->house_ownership=='Rented'              ?'selected':'' }}>Rented</option>
                    <option value="Living with Parents" {{ optional($AutoComplete)->house_ownership=='Living with Parents' ?'selected':'' }}>Living with Parents</option>
                    <option value="Other"               {{ optional($AutoComplete)->house_ownership=='Other'               ?'selected':'' }}>Other</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="flex justify-between mt-8">
              <button type="button" class="btn-prev" onclick="prevStep()"><i data-lucide="arrow-left"></i> Back</button>
              <button type="button" class="btn-next" onclick="nextStep()">Next <i data-lucide="arrow-right"></i></button>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 3: Guarantors ═══ -->
        <div class="step-panel" id="step-3">
          <!-- Guarantor 1 -->
          <div class="form-card">
            <div class="page-tag"><i data-lucide="circle-check"></i> Step 3 of 6</div>
            <div class="section-header">
              <div class="section-icon"><i data-lucide="user-check"></i></div>
              <div>
                <h3>First Guarantor (Co-Maker)</h3>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">Primary co-maker of this loan application</p>
              </div>
            </div>
            <div class="form-grid">
              <div class="field span2">
                <label class="field-label">Full Name <span class="req">*</span></label>
                <input class="form-input" name="g1_fullname" type="text" placeholder="Full name of guarantor" required>
              </div>
              <div class="field">
                <label class="field-label">Relationship <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" name="g1_relationship" required>
                    <option value="" disabled selected>Select relationship</option>
                    <option>Spouse</option><option>Parent</option><option>Sibling</option><option>Child</option>
                    <option>Relative</option><option>Friend</option><option>Co-worker</option>
                    <option>Employer</option><option>Neighbor</option><option>Others</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label class="field-label">Contact Number <span class="req">*</span></label>
                <input class="form-input" name="g1_contact_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11" required>
              </div>
              <div class="field span2">
                <label class="field-label">Address <span class="req">*</span></label>
                <input class="form-input" name="g1_address" type="text" placeholder="Complete address" required>
              </div>
            </div>
            <div class="field" style="max-width:340px;">
              <label class="field-label">Valid ID <span class="req">*</span></label>
              <div class="upload-zone" id="fu-g1" onclick="document.getElementById('g1_valid_id').click()">
                <div class="upl-icon"><i data-lucide="upload-cloud"></i></div>
                <div class="upl-label" id="fu-g1-label">Click to upload</div>
                <div class="upl-hint">JPG, PNG accepted</div>
                <input type="file" id="g1_valid_id" name="g1_valid_id" accept="image/*" required onchange="handleFile('fu-g1','fu-g1-label',this)">
              </div>
            </div>
          </div>

          <!-- Guarantor 2 -->
          <div class="form-card">
            <div class="section-header">
              <div class="section-icon"><i data-lucide="user-check"></i></div>
              <div>
                <h3>Second Guarantor (Co-Maker)</h3>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">Secondary co-maker of this loan application</p>
              </div>
            </div>
            <div class="form-grid">
              <div class="field span2">
                <label class="field-label">Full Name <span class="req">*</span></label>
                <input class="form-input" name="g2_fullname" type="text" placeholder="Full name of guarantor" required>
              </div>
              <div class="field">
                <label class="field-label">Relationship <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" name="g2_relationship" required>
                    <option value="" disabled selected>Select relationship</option>
                    <option>Spouse</option><option>Parent</option><option>Sibling</option><option>Child</option>
                    <option>Relative</option><option>Friend</option><option>Co-worker</option>
                    <option>Employer</option><option>Neighbor</option><option>Others</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label class="field-label">Contact Number <span class="req">*</span></label>
                <input class="form-input" name="g2_contact_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11" required>
              </div>
              <div class="field span2">
                <label class="field-label">Address <span class="req">*</span></label>
                <input class="form-input" name="g2_address" type="text" placeholder="Complete address" required>
              </div>
            </div>
            <div class="field" style="max-width:340px;">
              <label class="field-label">Valid ID <span class="req">*</span></label>
              <div class="upload-zone" id="fu-g2" onclick="document.getElementById('g2_valid_id').click()">
                <div class="upl-icon"><i data-lucide="upload-cloud"></i></div>
                <div class="upl-label" id="fu-g2-label">Click to upload</div>
                <div class="upl-hint">JPG, PNG, PDF accepted</div>
                <input type="file" id="g2_valid_id" name="g2_valid_id" accept="image/*,application/pdf" required onchange="handleFile('fu-g2','fu-g2-label',this)">
              </div>
            </div>
            <div class="flex justify-between mt-8">
              <button type="button" class="btn-prev" onclick="prevStep()"><i data-lucide="arrow-left"></i> Back</button>
              <button type="button" class="btn-next" onclick="nextStep()">Next <i data-lucide="arrow-right"></i></button>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 4: Employment ═══ -->
        <div class="step-panel" id="step-4">
          <div class="form-card">
            <div class="page-tag"><i data-lucide="circle-check"></i> Step 4 of 6</div>
            <div class="section-header">
              <div class="section-icon"><i data-lucide="briefcase"></i></div>
              <div>
                <h3>Employment / Business Information</h3>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">Source of income for loan eligibility assessment</p>
              </div>
            </div>

            <div class="form-grid">
              <div class="field">
                <label class="field-label">Employment Type <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" name="employment_type" required>
                    <option value="">Select type</option>
                    <option value="employed">Employed</option>
                    <option value="self-employed">Self-Employed</option>
                    <option value="business-owner">Business Owner</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label class="field-label">Employer / Business Name <span class="req">*</span></label>
                <input class="form-input" name="employer_business_name" type="text" placeholder="e.g. ABC Corp." required>
              </div>
              <div class="field">
                <label class="field-label">Occupation / Nature of Business <span class="req">*</span></label>
                <input class="form-input" name="position_nature_of_business" type="text" placeholder="e.g. Accountant" required>
              </div>
            </div>

            <div class="form-grid">
              <div class="field span2">
                <label class="field-label">Employer / Business Address <span class="req">*</span></label>
                <input class="form-input" name="employer_business_address" type="text" placeholder="Complete business address" required>
              </div>
              <div class="field">
                <label class="field-label">Years in Service <span class="req">*</span></label>
                <input class="form-input" name="year_in_service_operation" type="text" placeholder="e.g. 3 years" required>
              </div>
            </div>

            <div class="form-grid cols2">
              <div class="field">
                <label class="field-label">Gross Monthly Income <span class="req">*</span></label>
                <div class="inp-wrap">
                  <span class="inp-prefix">₱</span>
                  <input class="form-input" name="monthly_income" id="monthly_income" type="number" min="0" step="0.01" placeholder="0.00" required>
                </div>
              </div>
              <div class="field">
                <label class="field-label">Proof of Income <span class="req">*</span></label>
                <div class="upload-zone" id="fu-income" onclick="document.getElementById('proof_of_income').click()">
                  <div class="upl-icon"><i data-lucide="upload-cloud"></i></div>
                  <div class="upl-label" id="fu-income-label">Click to upload</div>
                  <div class="upl-hint">Payslip, COE, ITR, Business Permit</div>
                  <input type="file" id="proof_of_income" name="proof_of_income" accept="image/*" required onchange="handleFile('fu-income','fu-income-label',this)">
                </div>
              </div>
            </div>

            <hr class="section-divider">

            <div class="form-grid cols2">
              <div class="field">
                <label class="field-label">HR Contact Name <span style="color:#94a3b8;font-weight:400;font-size:0.72rem;">(optional)</span></label>
                <input class="form-input" name="hr_person_name" type="text" placeholder="HR or contact person name">
              </div>
              <div class="field">
                <label class="field-label">HR Contact Number <span style="color:#94a3b8;font-weight:400;font-size:0.72rem;">(optional)</span></label>
                <input class="form-input" name="hr_person_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11">
              </div>
            </div>

            <div class="flex justify-between mt-8">
              <button type="button" class="btn-prev" onclick="prevStep()"><i data-lucide="arrow-left"></i> Back</button>
              <button type="button" class="btn-next" onclick="nextStep()">Next <i data-lucide="arrow-right"></i></button>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 5: Loan Details ═══ -->
        <div class="step-panel" id="step-5">
          <div class="form-card">
            <div class="page-tag"><i data-lucide="circle-check"></i> Step 5 of 6</div>
            <div class="section-header">
              <div class="section-icon"><i data-lucide="landmark"></i></div>
              <div>
                <h3>Loan Details</h3>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">Loan type, amount, term, purpose, and interest computation</p>
              </div>
            </div>

            <div class="form-grid cols2" style="margin-bottom:22px;">
              <div class="field">
                <label class="field-label">Loan Type <span class="req">*</span></label>
                <div class="select-wrapper">
                  <select class="form-select" name="loan_type" required>
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
            </div>

            <div class="field" style="margin-bottom:22px;">
              <label class="field-label">Loan Amount <span class="req">*</span> <span style="color:#94a3b8;font-weight:400;font-size:0.72rem;">— quick pick or enter manually</span></label>
              <div class="pill-grid" id="amountPills">
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
                <span class="inp-prefix">₱</span>
                <input class="form-input" name="loan_amount" id="loanAmount" type="number" min="0" step="0.01"
                       placeholder="Enter or pick amount above" required oninput="clearAmtPill(); runComputation();">
              </div>
            </div>

            <div class="field" style="margin-bottom:22px;">
              <label class="field-label">Loan Term <span class="req">*</span> <span style="color:#94a3b8;font-weight:400;font-size:0.72rem;">— select repayment duration</span></label>
              <div class="term-grid">
                <label class="term-pill" id="term-3"><input type="radio" name="loan_term" value="3" onchange="selectTermPill(this); runComputation();" required><span class="term-num">3</span><span class="term-unit">Months</span></label>
                <label class="term-pill" id="term-6"><input type="radio" name="loan_term" value="6" onchange="selectTermPill(this); runComputation();"><span class="term-num">6</span><span class="term-unit">Months</span></label>
                <label class="term-pill" id="term-9"><input type="radio" name="loan_term" value="9" onchange="selectTermPill(this); runComputation();"><span class="term-num">9</span><span class="term-unit">Months</span></label>
                <label class="term-pill" id="term-12"><input type="radio" name="loan_term" value="12" onchange="selectTermPill(this); runComputation();"><span class="term-num">12</span><span class="term-unit">Months</span></label>
              </div>
            </div>

            <div class="field" style="margin-bottom:22px;">
              <label class="field-label">Purpose of Loan <span class="req">*</span> <span style="color:#94a3b8;font-weight:400;font-size:0.72rem;">— pick or type custom</span></label>
              <div class="pill-grid" id="purposePills">
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
              <input class="form-input" name="purpose_of_loan" id="purposeInput" type="text" placeholder="Selected above or type custom purpose…" required>
            </div>

            <!-- Computation panel -->
            <div class="comp-panel">
              <div class="comp-panel-title">
                <i data-lucide="calculator"></i> Interest Computation
              </div>
              <div style="font-size:0.8rem;color:#374151;font-weight:600;margin-bottom:6px;">Rate by loan amount (compound, monthly):</div>
              <div style="font-size:0.75rem;color:#64748b;margin-bottom:14px;">Up to 50k → 8% p.a. &nbsp;|&nbsp; 50k–150k → 10% &nbsp;|&nbsp; 150k–500k → 12% &nbsp;|&nbsp; 500k–2M → 14% &nbsp;|&nbsp; 2M+ → 16%</div>
              <div class="comp-results-grid">
                <div class="comp-result"><div class="lbl">Principal</div><div class="val" id="res-principal">₱ —</div></div>
                <div class="comp-result"><div class="lbl">Rate (tier)</div><div class="val" id="res-rate">—% p.a.</div></div>
                <div class="comp-result"><div class="lbl">Total Interest</div><div class="val warn" id="res-interest">₱ —</div></div>
                <div class="comp-result"><div class="lbl">Total Due</div><div class="val big" id="res-total">₱ —</div></div>
                <div class="comp-result"><div class="lbl">Loan Term</div><div class="val" id="res-term">— months</div></div>
                <div class="comp-result"><div class="lbl">Est. Monthly</div><div class="val big" id="res-monthly">₱ —</div></div>
              </div>
              <button type="button" class="apply-btn" onclick="applyComputation()">
                <i data-lucide="check"></i> Use This Computation — Auto-fill Due Amount
              </button>
            </div>

            <div class="field" style="margin-top:20px; max-width:400px;">
              <label class="field-label">Total Due Amount <span class="req">*</span> <span style="color:#94a3b8;font-weight:400;font-size:0.72rem;">— auto-filled above or enter manually</span></label>
              <div class="inp-wrap">
                <span class="inp-prefix">₱</span>
                <input class="form-input" name="due_amount" id="dueAmount" type="number" min="0" step="0.01" placeholder="Total repayable amount" required>
              </div>
            </div>

            <div class="flex justify-between mt-8">
              <button type="button" class="btn-prev" onclick="prevStep()"><i data-lucide="arrow-left"></i> Back</button>
              <button type="button" class="btn-next" onclick="nextStep()">Next <i data-lucide="arrow-right"></i></button>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 6: Review & Submit ═══ -->
        <div class="step-panel" id="step-6">
          <div class="form-card">
            <div class="page-tag"><i data-lucide="circle-check"></i> Step 6 of 6</div>
            <div class="section-header">
              <div class="section-icon"><i data-lucide="clipboard-check"></i></div>
              <div>
                <h3>Review &amp; Submit</h3>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:2px;">Confirm all information before submitting the loan application</p>
              </div>
            </div>

            <div class="review-section">
              <div class="review-section-title"><i data-lucide="user"></i> Personal Information</div>
              <div class="review-grid" id="rv-personal"></div>
            </div>
            <div class="review-section">
              <div class="review-section-title"><i data-lucide="map-pin"></i> Home Address</div>
              <div class="review-grid" id="rv-address"></div>
            </div>
            <div class="review-section">
              <div class="review-section-title"><i data-lucide="briefcase"></i> Employment</div>
              <div class="review-grid" id="rv-employment"></div>
            </div>
            <div class="review-section">
              <div class="review-section-title"><i data-lucide="landmark"></i> Loan Details</div>
              <div class="review-grid" id="rv-loan"></div>
            </div>

            <div class="info-banner amber">
              <i data-lucide="triangle-alert"></i>
              <p>Please review all information carefully. Once submitted, the application will go to the loan review queue.</p>
            </div>

            <hr class="section-divider">

            <div class="terms-wrapper">
              <input type="checkbox" id="terms" required>
              <label for="terms" style="font-size:0.88rem;color:#374151;cursor:pointer;">
                I confirm that all information I have provided is accurate and complete. I agree to the
                <a href="#" style="color:#16a34a;text-decoration:underline;font-weight:500;">Terms &amp; Conditions</a> of GBLDC
                and consent to the processing of my personal data.
              </label>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
              <button type="button" class="btn-prev" onclick="prevStep()"><i data-lucide="arrow-left"></i> Back</button>
              <div style="display:flex;align-items:center;gap:12px;">
                <a href="{{ route('Member.Landing') }}" class="btn-cancel"><i data-lucide="x"></i> Cancel</a>
                <p style="font-size:0.72rem;color:#94a3b8;display:flex;align-items:center;gap:4px;"><i data-lucide="lock" style="width:11px;height:11px;display:inline;"></i> Secure &amp; encrypted</p>
                <button type="submit" class="btn-submit"><i data-lucide="send"></i> Submit Application</button>
              </div>
            </div>
          </div>
        </div>

      </form>

      <div style="text-align:center;font-size:0.72rem;color:#94a3b8;padding:20px 0 40px;">
        &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
      </div>
    </div><!-- /reg-main -->

  </div><!-- /reg-wrapper -->

  <!-- ── Logout Modal (landing page style) ── -->
  <div class="modal-bg" id="logout-modal">
    <div class="modal-box">
      <div class="modal-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="#c0392b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:24px;height:24px;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
      </div>
      <h3 class="modal-h">Confirm Logout</h3>
      <p class="modal-p">Are you sure you want to end your session? You'll need to sign in again to access your member dashboard.</p>
      <div class="modal-btns">
        <button class="modal-btn-ghost" onclick="closeLogoutModal()">Cancel</button>
        <a href="{{ route('Member.Logout') }}" class="modal-btn-danger">Yes, Log Out</a>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();

    // ── Step wizard ──
    let currentStep = 1;
    const totalSteps = 6;

    function updateStepper(to) {
      document.querySelectorAll('.step-panel').forEach((p,i) => p.classList.toggle('active', i+1 === to));
      for (let i = 1; i <= totalSteps; i++) {
        const item = document.getElementById('snav-' + i);
        item.classList.remove('active','done');
        if (i < to) item.classList.add('done');
        else if (i === to) item.classList.add('active');
      }
      lucide.createIcons();
      if (to === totalSteps) populateReview();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep(stepIndex) {
      const panel = document.getElementById('step-' + stepIndex);
      if (!panel) return true;
      const elements = panel.querySelectorAll('input, select, textarea');
      for (let i = 0; i < elements.length; i++) {
        if (!elements[i].checkValidity()) {
          elements[i].reportValidity();
          return false;
        }
      }
      return true;
    }

    function nextStep() {
      if (!validateStep(currentStep)) return;
      if (currentStep < totalSteps) { currentStep++; updateStepper(currentStep); }
    }
    function prevStep() { if (currentStep > 1) { currentStep--; updateStepper(currentStep); } }
    function jumpToStep(s) { if (s <= currentStep) { currentStep = s; updateStepper(currentStep); } }

    // ── Age ──
    function calculateAge() {
      const b = document.getElementById('birthDate').value;
      const a = document.getElementById('ageField');
      if (!b) { a.value = ''; return; }
      const today = new Date(), birth = new Date(b);
      let age = today.getFullYear() - birth.getFullYear();
      const m = today.getMonth() - birth.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
      a.value = age >= 0 ? age : '';
    }

    // ── Radio pill selection ──
    function selectRadioPill(name, val, maleId, femaleId) {
      document.getElementById(maleId).classList.toggle('selected', val === 'Male');
      document.getElementById(femaleId).classList.toggle('selected', val === 'Female');
      document.querySelectorAll(`input[name="${name}"]`).forEach(r => { r.checked = r.value === val; });
    }
    // Init gender pills from pre-filled value
    document.addEventListener('DOMContentLoaded', () => {
      const checked = document.querySelector('input[name="gender"]:checked');
      if (checked) {
        if (checked.value === 'Male') document.getElementById('gMaleLabel').classList.add('selected');
        else document.getElementById('gFemaleLabel').classList.add('selected');
      }
    });

    // ── Term pill selection ──
    function selectTermPill(input) {
      document.querySelectorAll('.term-pill').forEach(p => p.classList.remove('selected'));
      input.closest('.term-pill').classList.add('selected');
    }

    // ── PSGC dropdowns ──
    const PSGC_API = 'https://psgc.gitlab.io/api';
    const provinceSelect  = document.getElementById('province');
    const citySelect      = document.getElementById('city');
    const barangaySelect  = document.getElementById('barangay');

    fetch(`${PSGC_API}/provinces/`)
      .then(r => r.json())
      .then(provinces => {
        provinces.sort((a,b) => a.name.localeCompare(b.name)).forEach(p => {
          provinceSelect.innerHTML += `<option value="${p.code}">${p.name}</option>`;
        });
      }).catch(() => {});

    provinceSelect.addEventListener('change', function () {
      citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
      barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
      if (!this.value) return;
      fetch(`${PSGC_API}/provinces/${this.value}/cities-municipalities/`)
        .then(r => r.json()).then(cities => {
          cities.sort((a,b) => a.name.localeCompare(b.name)).forEach(c => {
            citySelect.innerHTML += `<option value="${c.code}">${c.name}</option>`;
          });
        }).catch(() => {});
    });

    citySelect.addEventListener('change', function () {
      barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
      document.getElementById('zipCode').value = '';
      if (!this.value) return;
      fetch(`${PSGC_API}/cities-municipalities/${this.value}/barangays/`)
        .then(r => r.json()).then(brgys => {
          brgys.sort((a,b) => a.name.localeCompare(b.name)).forEach(b => {
            barangaySelect.innerHTML += `<option value="${b.code}">${b.name}</option>`;
          });
        }).catch(() => {});
      fetch(`${PSGC_API}/cities-municipalities/${this.value}/`)
        .then(r => r.json()).then(city => {
          document.getElementById('zipCode').value = city.postalCode || '';
        }).catch(() => {});
    });

    // ── File upload ──
    function handleFile(wrapId, labelId, input) {
      if (input.files && input.files[0]) {
        document.getElementById(labelId).textContent = input.files[0].name;
        document.getElementById(wrapId).classList.add('has-file');
        lucide.createIcons();
      }
    }

    // ── Amount pills ──
    document.querySelectorAll('.amt-pill').forEach(pill => {
      pill.addEventListener('click', () => {
        document.querySelectorAll('.amt-pill').forEach(p => p.classList.remove('selected'));
        pill.classList.add('selected');
        document.getElementById('loanAmount').value = pill.dataset.amt;
        runComputation();
      });
    });
    function clearAmtPill() {
      document.querySelectorAll('.amt-pill').forEach(p => p.classList.remove('selected'));
    }

    // ── Purpose pills ──
    document.querySelectorAll('.purpose-pill').forEach(pill => {
      pill.addEventListener('click', () => {
        document.querySelectorAll('.purpose-pill').forEach(p => p.classList.remove('selected'));
        pill.classList.add('selected');
        document.getElementById('purposeInput').value = pill.dataset.purpose;
      });
    });

    // ── Interest computation ──
    function getTierRate(a) {
      if (a <= 50000)   return 0.08;
      if (a <= 150000)  return 0.10;
      if (a <= 500000)  return 0.12;
      if (a <= 2000000) return 0.14;
      return 0.16;
    }
    const fmt = n => '₱ ' + Number(n).toLocaleString('en-PH', { minimumFractionDigits:2, maximumFractionDigits:2 });
    let lastComputed = null;

    function runComputation() {
      const principal = parseFloat(document.getElementById('loanAmount').value) || 0;
      const termRadio = document.querySelector('input[name="loan_term"]:checked');
      const term = termRadio ? parseInt(termRadio.value) : 0;
      const blank = (id, txt) => document.getElementById(id).textContent = txt;
      if (!principal || !term) {
        blank('res-principal','₱ —'); blank('res-rate','—% p.a.'); blank('res-interest','₱ —');
        blank('res-total','₱ —'); blank('res-term','— months'); blank('res-monthly','₱ —');
        lastComputed = null; return;
      }
      const rate = getTierRate(principal);
      const r = rate / 12;
      // Diminishing Interest (Equal Principal) Formula
      const interest = principal * r * (term + 1) / 2;
      const totalDue = principal + interest;
      document.getElementById('res-principal').textContent = fmt(principal);
      document.getElementById('res-rate').textContent = (rate*100).toFixed(0) + '% p.a.';
      document.getElementById('res-interest').textContent = fmt(interest);
      document.getElementById('res-total').textContent = fmt(totalDue);
      document.getElementById('res-term').textContent = term + ' months';
      document.getElementById('res-monthly').textContent = fmt(totalDue / term);
      lastComputed = { totalDue };
      
      // Auto-update the input field seamlessly so it never goes out of sync
      document.getElementById('dueAmount').value = totalDue.toFixed(2);
    }

    function applyComputation() {
      if (!lastComputed) { alert('Please enter a loan amount and select a term first.'); return; }
      document.getElementById('dueAmount').value = lastComputed.totalDue.toFixed(2);
    }

    // ── Review ──
    function rv(label, val) {
      return `<div class="rv-item"><div class="rv-label">${label}</div><div class="rv-value">${val || '—'}</div></div>`;
    }
    function getVal(name) {
      const el = document.querySelector(`[name="${name}"]`);
      if (!el) return '';
      if (el.type === 'radio') { const c = document.querySelector(`[name="${name}"]:checked`); return c ? c.value : ''; }
      if (el.tagName === 'SELECT') return el.options[el.selectedIndex]?.text || el.value;
      return el.value;
    }
    function populateReview() {
      document.getElementById('rv-personal').innerHTML =
        rv('Last Name', getVal('last_name')) + rv('First Name', getVal('first_name')) +
        rv('Middle Name', getVal('middle_name')) + rv('Birth Date', getVal('birthdate')) +
        rv('Place of Birth', getVal('place_of_birth')) + rv('Age', getVal('age')) +
        rv('Gender', getVal('gender')) + rv('Civil Status', getVal('civil_status')) +
        rv('Religion', getVal('religion')) + rv('Nationality', getVal('nationality')) +
        rv('Email', getVal('email')) + rv('Contact', '+63 ' + getVal('contact_number'));

      document.getElementById('rv-address').innerHTML =
        rv('Province', getVal('province')) + rv('City / Municipality', getVal('city_municipality')) +
        rv('Barangay', getVal('barangay')) + rv('Street', getVal('street_address')) +
        rv('Zip Code', getVal('zip_code')) + rv('Years of Stay', getVal('year_of_stay')) +
        rv('House Ownership', getVal('house_ownership'));

      document.getElementById('rv-employment').innerHTML =
        rv('Employment Type', getVal('employment_type')) + rv('Employer / Business', getVal('employer_business_name')) +
        rv('Position / Nature', getVal('position_nature_of_business')) + rv('Business Address', getVal('employer_business_address')) +
        rv('Years in Service', getVal('year_in_service_operation')) +
        rv('Monthly Income', getVal('monthly_income') ? '₱ ' + Number(getVal('monthly_income')).toLocaleString('en-PH') : '');

      document.getElementById('rv-loan').innerHTML =
        rv('Loan Type', getVal('loan_type')) +
        rv('Loan Amount', getVal('loan_amount') ? '₱ ' + Number(getVal('loan_amount')).toLocaleString('en-PH') : '') +
        rv('Loan Term', getVal('loan_term') ? getVal('loan_term') + ' months' : '') +
        rv('Purpose', getVal('purpose_of_loan')) +
        rv('Total Due', getVal('due_amount') ? '₱ ' + Number(getVal('due_amount')).toLocaleString('en-PH') : '');

      lucide.createIcons();
    }

    // ── Nav ──
    function toggleMobileNav() {
      document.getElementById('mobile-nav').classList.toggle('open');
    }
    function openLogoutModal() {
      document.getElementById('logout-modal').classList.add('open');
    }
    function closeLogoutModal() {
      document.getElementById('logout-modal').classList.remove('open');
    }
    document.getElementById('logout-modal').addEventListener('click', function(e) {
      if (e.target === this) closeLogoutModal();
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeLogoutModal();
    });
  </script>
</body>
</html>