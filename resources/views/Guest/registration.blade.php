<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Member Registration | GBLDC</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Outfit', sans-serif; box-sizing: border-box; }
        :root {
            /* Reg Form Tokens */
            --green-primary: #16a34a;
            --green-dark:    #15803d;
            --green-light:   #f0fdf4;
            --green-border:  #bbf7d0;
            --teal-heading:  #134e4a;
            --gray-input:    #f9fafb;
            --border-color:  #d1d5db;

            /* Header Tokens */
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
            --amber:      #059669;
            --amber-soft: #34d399;
            --amber-pale: #d1fae5;
            --white:      #ffffff;
            --shadow-sm:  0 2px 8px rgba(22,163,74,0.08);
            --shadow-md:  0 8px 24px rgba(22,163,74,0.12);
            --shadow-lg:  0 20px 48px rgba(22,163,74,0.14);
        }

        /* ════════════════════ HEADER CSS ════════════════════ */
        header {
          position: fixed; top: 0; left: 0; right: 0; z-index: 200;
          height: 68px;
          display: flex; align-items: center; justify-content: space-between;
          padding: 0 2.5rem;
          background: rgba(245,250,246,0.94);
          backdrop-filter: blur(18px) saturate(1.4);
          border-bottom: 1px solid rgba(22,163,74,0.12);
        }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; flex-shrink: 0; }
        .logo img { width: 46px; height: 46px; overflow: hidden; padding: 4px; flex-shrink: 0; }
        .logo-name { font-family: 'Cormorant Garamond', serif; font-size: 1.25rem; font-weight: 700; color: var(--grove); letter-spacing: 0.04em; }

        .nav-desktop { display: flex; align-items: center; gap: 0; }
        .nav-desktop a, .nav-desktop .dd-trigger {
          font-size: 0.78rem; font-weight: 600; letter-spacing: 0.06em;
          color: var(--ink-soft); text-decoration: none;
          padding: 0.45rem 0.9rem; border-radius: 6px;
          background: none; border: none; cursor: pointer;
          font-family: 'Syne', sans-serif;
          display: flex; align-items: center; gap: 4px;
          transition: color 0.2s, background 0.2s; white-space: nowrap;
        }
        .nav-desktop a:hover, .nav-desktop .dd-trigger:hover { color: var(--grove); background: rgba(22,163,74,0.08); }

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

        .btn-login-header {
          display: inline-flex; align-items: center; gap: 7px;
          background: var(--grove); color: #fff;
          font-size: 0.76rem; font-weight: 700; letter-spacing: 0.08em;
          text-transform: uppercase;
          padding: 0.52rem 1.4rem; border-radius: 99px;
          text-decoration: none; border: none; cursor: pointer;
          font-family: 'Syne', sans-serif;
          transition: background 0.2s, transform 0.15s;
          box-shadow: 0 3px 10px rgba(22,163,74,0.25);
        }
        .btn-login-header:hover { background: var(--grove-mid); transform: translateY(-1px); }

        .ham-btn {
          display: none; width: 40px; height: 40px;
          border-radius: 8px; border: 1px solid rgba(22,163,74,0.18);
          background: none; cursor: pointer; align-items: center; justify-content: center; color: var(--ink);
        }
        .ham-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; }

        .mobile-nav {
          display: none; flex-direction: column; gap: 2px;
          position: fixed; inset: 68px 0 0;
          background: var(--canvas); padding: 1.25rem;
          overflow-y: auto; z-index: 199;
        }
        .mobile-nav.open { display: flex; }
        .mobile-nav a, .mobile-nav-group > button {
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
        .mobile-login {
          margin-top: 0.5rem; padding: 0.75rem 1rem;
          background: var(--grove); color: #fff; border-radius: 10px;
          font-size: 0.88rem; font-weight: 700; text-decoration: none;
          text-align: center; letter-spacing: 0.06em;
          font-family: 'Syne', sans-serif;
        }

        @media (max-width: 1024px) {
          .nav-desktop { display: none; }
          .btn-login-header { display: none; }
          .ham-btn { display: flex; }
        }
        body { background: #eef2f7; min-height: 100vh; }

        /* ── Page wrapper ── */
        .reg-wrapper {
            display: flex;
            max-width: 1060px;
            margin: 100px auto 60px auto;
            padding: 0 16px;
            gap: 24px;
            align-items: flex-start;
        }

        /* ── LEFT SIDEBAR ── */
        .reg-sidebar {
            width: 230px;
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
            background: var(--green-primary);
            padding: 20px 18px 16px 18px;
        }
        .sidebar-top .sidebar-title {
            font-size: 0.7rem;
            font-weight: 700;
            color: rgba(255,255,255,0.7);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 3px;
        }
        .sidebar-top .sidebar-subtitle {
            font-size: 0.98rem;
            font-weight: 700;
            color: #fff;
        }

        .step-nav { padding: 12px 10px; }
        .step-nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 10px;
            border-radius: 10px;
            margin-bottom: 2px;
            cursor: default;
            transition: background 0.2s;
            position: relative;
        }
        .step-nav-item.active { background: var(--green-light); }

        /* Vertical connector */
        .step-nav-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 25px;
            top: 40px;
            width: 2px;
            height: calc(100% - 12px);
            background: #e5e7eb;
            z-index: 0;
        }
        .step-nav-item.done:not(:last-child)::after { background: var(--green-primary); }

        .step-nav-circle {
            width: 32px; height: 32px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            color: #9ca3af;
            transition: all 0.3s;
            z-index: 1;
            position: relative;
        }
        .step-nav-circle svg { width: 14px; height: 14px; }
        .step-nav-item.active .step-nav-circle {
            background: var(--green-primary);
            border-color: var(--green-primary);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(22,163,74,0.15);
        }
        .step-nav-item.done .step-nav-circle {
            background: var(--green-primary);
            border-color: var(--green-primary);
            color: #fff;
        }
        .step-nav-text { flex: 1; min-width: 0; }
        .step-nav-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #9ca3af;
            line-height: 1.3;
        }
        .step-nav-item.active .step-nav-label { color: var(--green-primary); }
        .step-nav-item.done   .step-nav-label { color: #374151; }
        .step-nav-sub {
            font-size: 0.67rem;
            color: #9ca3af;
            margin-top: 1px;
        }
        .step-nav-item.active .step-nav-sub { color: #6b7280; }

        /* ── MAIN ── */
        .reg-main { flex: 1; min-width: 0; }
        .form-page { display: none; }
        .form-page.active { display: block; }
        .form-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e5e7eb;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            padding: 32px 36px;
        }

        /* ── Section heading ── */
        .section-header { display: flex; align-items: center; gap: 12px; margin-bottom: 6px; }
        .section-header h3 { font-size: 1.08rem; font-weight: 700; color: var(--teal-heading); }
        .section-icon {
            width: 38px; height: 38px;
            background: var(--green-light); border: 1.5px solid var(--green-border);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            color: var(--green-primary); flex-shrink: 0;
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

        /* ── Inputs ── */
        .field-label { display: block; font-size: 0.8rem; font-weight: 600; color: #374151; margin-bottom: 5px; }
        .field-label .req { color: #ef4444; margin-left: 2px; }
        .form-input, .form-select {
            width: 100%; background: var(--gray-input);
            border: 1.5px solid var(--border-color); border-radius: 10px;
            padding: 10px 14px; font-size: 0.88rem; color: #1f2937;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none; appearance: none; -webkit-appearance: none;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus, .form-select:focus {
            border-color: var(--green-primary); background: #fff;
            box-shadow: 0 0 0 3px rgba(22,163,74,0.12);
        }
        .form-input.is-valid   { border-color: #22c55e !important; background: #f0fdf4; }
        .form-input.is-invalid, .form-select.is-invalid { border-color: #ef4444 !important; background: #fef2f2; }
        .form-input[readonly]  { background: #f3f4f6; color: #6b7280; cursor: default; }

        .select-wrapper { position: relative; }
        .select-wrapper::after {
            content: '';
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            width: 14px; height: 14px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat; background-size: contain; pointer-events: none;
        }
        .select-wrapper .form-select { padding-right: 36px; cursor: pointer; }

        .phone-wrapper {
            display: flex; border: 1.5px solid var(--border-color);
            border-radius: 10px; overflow: hidden; background: var(--gray-input);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .phone-wrapper:focus-within { border-color: var(--green-primary); background: #fff; box-shadow: 0 0 0 3px rgba(22,163,74,0.12); }
        .phone-prefix { padding: 10px 12px; background: #f3f4f6; border-right: 1.5px solid var(--border-color); color: #374151; font-weight: 600; font-size: 0.85rem; white-space: nowrap; display: flex; align-items: center; gap: 5px; }
        .phone-prefix svg { width: 12px; height: 12px; color: #9ca3af; }
        .phone-input { flex: 1; border: none; background: transparent; padding: 10px 14px; font-size: 0.88rem; color: #1f2937; outline: none; }

        .gender-group { display: flex; gap: 10px; margin-top: 4px; }
        .gender-option {
            flex: 1; display: flex; align-items: center; justify-content: center; gap: 7px;
            border: 1.5px solid var(--border-color); border-radius: 10px;
            padding: 9px 10px; cursor: pointer; font-size: 0.85rem; font-weight: 500;
            color: #374151; background: var(--gray-input);
            transition: border-color 0.2s, background 0.2s, color 0.2s; user-select: none;
        }
        .gender-option:hover { border-color: #86efac; background: #f0fdf4; }
        .gender-option input[type="radio"] { display: none; }
        .gender-option.selected { border-color: var(--green-primary); background: #f0fdf4; color: var(--green-primary); font-weight: 600; }
        .gender-option svg { width: 15px; height: 15px; }

        .field-hint { font-size: 0.74rem; margin-top: 4px; display: none; align-items: center; gap: 4px; }
        .field-hint svg { width: 12px; height: 12px; flex-shrink: 0; }
        .field-hint.show { display: flex; }
        .field-hint.error   { color: #ef4444; }
        .field-hint.success { color: #16a34a; }
        .field-hint.info    { color: #6b7280; }

        .section-divider { border: none; border-top: 1.5px solid #e5e7eb; margin: 28px 0; }

        /* ── Upload ── */
        .upload-zone {
            border: 2px dashed #d1d5db; border-radius: 12px; background: #f9fafb;
            padding: 20px 14px; text-align: center; cursor: pointer;
            transition: border-color 0.2s, background 0.2s; position: relative;
        }
        .upload-zone:hover { border-color: var(--green-primary); background: var(--green-light); }
        .upload-zone.dragover { border-color: var(--green-primary); background: var(--green-light); }
        .upload-zone input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .upload-icon { display: flex; justify-content: center; margin-bottom: 8px; color: #9ca3af; }
        .upload-icon svg { width: 28px; height: 28px; }
        .upload-label { font-size: 0.83rem; font-weight: 600; color: #374151; margin-bottom: 2px; }
        .upload-text  { font-size: 0.75rem; color: #6b7280; }
        .upload-preview { display: none; margin-top: 10px; position: relative; }
        .upload-preview img { width: 100%; max-height: 100px; object-fit: cover; border-radius: 8px; border: 1.5px solid #e5e7eb; }
        .preview-filename { font-size: 0.72rem; color: #374151; margin-top: 4px; text-align: left; word-break: break-all; }
        .upload-remove-btn { position: absolute; top: -8px; right: -8px; background: #ef4444; color: #fff; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
        .upload-remove-btn svg { width: 11px; height: 11px; }
        .upload-error   { display: none; background: #fef2f2; border: 1.5px solid #fca5a5; border-radius: 8px; padding: 7px 10px; margin-top: 6px; font-size: 0.76rem; color: #b91c1c; align-items: center; gap: 6px; }
        .upload-error svg { width: 13px; height: 13px; flex-shrink: 0; }
        .upload-error.show { display: flex; }
        .upload-success { display: none; background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 8px; padding: 6px 10px; margin-top: 6px; font-size: 0.75rem; color: #15803d; align-items: center; gap: 6px; }
        .upload-success svg { width: 13px; height: 13px; flex-shrink: 0; }
        .upload-success.show { display: flex; }
        .upload-progress { display: none; margin-top: 8px; background: #e5e7eb; border-radius: 99px; height: 5px; overflow: hidden; }
        .upload-progress.show { display: block; }
        .upload-progress-bar { height: 100%; background: var(--green-primary); border-radius: 99px; width: 0%; transition: width 0.3s ease; }

        /* ── Buttons ── */
        .btn-next {
            background: var(--green-primary); color: #fff; border: none; border-radius: 10px;
            padding: 10px 28px; font-size: 0.9rem; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 7px;
            box-shadow: 0 4px 14px rgba(22,163,74,0.25);
            transition: background 0.2s, transform 0.15s;
        }
        .btn-next svg { width: 15px; height: 15px; }
        .btn-next:hover { background: var(--green-dark); transform: translateY(-1px); }
        .btn-prev {
            background: #fff; color: #374151; border: 1.5px solid #d1d5db; border-radius: 10px;
            padding: 9px 22px; font-size: 0.9rem; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 7px;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-prev svg { width: 15px; height: 15px; }
        .btn-prev:hover { background: #f9fafb; border-color: #9ca3af; }

        .terms-wrapper { display: flex; align-items: flex-start; gap: 10px; background: var(--green-light); border: 1.5px solid var(--green-border); border-radius: 10px; padding: 14px 16px; }
        .terms-wrapper input[type="checkbox"] { accent-color: var(--green-primary); width: 17px; height: 17px; margin-top: 2px; flex-shrink: 0; }

        .tooltip-wrapper { position: relative; display: inline-flex; align-items: center; margin-left: 4px; }
        .tooltip-icon { color: #9ca3af; cursor: help; display: flex; }
        .tooltip-icon svg { width: 13px; height: 13px; }
        .tooltip-box { position: absolute; left: 50%; bottom: calc(100% + 6px); transform: translateX(-50%); background: #1f2937; color: #fff; font-size: 0.72rem; padding: 6px 10px; border-radius: 7px; pointer-events: none; opacity: 0; transition: opacity 0.2s; z-index: 100; max-width: 220px; white-space: normal; text-align: center; }
        .tooltip-wrapper:hover .tooltip-box { opacity: 1; }

        .amount-prefix-wrap { display: flex; border: 1.5px solid var(--border-color); border-radius: 10px; overflow: hidden; background: var(--gray-input); transition: border-color 0.2s, box-shadow 0.2s; }
        .amount-prefix-wrap:focus-within { border-color: var(--green-primary); background: #fff; box-shadow: 0 0 0 3px rgba(22,163,74,0.12); }
        .amount-prefix { padding: 10px 12px; background: #f3f4f6; border-right: 1.5px solid var(--border-color); color: #374151; font-weight: 700; font-size: 0.88rem; display: flex; align-items: center; }
        .amount-input { flex: 1; border: none; background: transparent; padding: 10px 14px; font-size: 0.88rem; color: #1f2937; outline: none; }

        .info-banner { display: flex; align-items: flex-start; gap: 10px; border-radius: 10px; padding: 12px 14px; font-size: 0.84rem; }
        .info-banner svg { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }
        .info-banner.blue  { background: #eff6ff; border: 1.5px solid #bfdbfe; color: #1e40af; }
        .info-banner.amber { background: #fffbeb; border: 1.5px solid #fde68a; color: #92400e; }
        .info-banner.blue  svg { color: #3b82f6; }
        .info-banner.amber svg { color: #f59e0b; }

        @media (max-width: 768px) {
            .reg-wrapper { flex-direction: column; margin-top: 80px; }
            .reg-sidebar { width: 100%; position: static; }
            .step-nav-item:not(:last-child)::after { display: none; }
            .step-nav { display: flex; flex-wrap: wrap; gap: 4px; padding: 10px; }
            .step-nav-item { flex: 1; min-width: 70px; flex-direction: column; align-items: center; gap: 4px; padding: 8px 4px; }
            .step-nav-text { text-align: center; }
            .step-nav-sub { display: none; }
            .form-card { padding: 24px 18px; }
        }
    </style>
</head>
<body>

@if (session('success'))
<div id="successModal" class="fixed inset-0 z-[9999] hidden" aria-hidden="true">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative min-h-full flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-6 pt-6 pb-4">
                <div class="w-12 h-12 rounded-2xl bg-green-50 border border-green-200 flex items-center justify-center text-green-700 mb-3">
                    <i data-lucide="circle-check" style="width:22px;height:22px;"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Application submitted</h3>
                <p class="text-sm text-gray-600 mt-2 break-words">{{ session('success') }}</p>
            </div>
            <div class="px-6 pb-6 flex justify-end">
                <button type="button" id="successModalOk" class="btn-next" style="padding:10px 22px;">OK</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- ── NAVBAR ── -->
<header>
  <a href="{{ route('Landing.Page') }}" class="logo">
    <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
    <span class="logo-name">GBLDC</span>
  </a>

  <nav class="nav-desktop">
    <a href="{{ route('Landing.Page') }}">Home</a>

    <div class="dd-wrap">
      <button class="dd-trigger">
        Services
        <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="dd-panel">
        <a href="{{ route('Guest.Loans') }}">Loans</a>
        <a href="#">Deposits</a>
        <a href="#">Savings</a>
      </div>
    </div>

    <div class="dd-wrap">
      <button class="dd-trigger">
        About
        <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="dd-panel">
        <a href="{{ route('Guest.AboutUs') }}">About GBLDC</a>
        <a href="#">Board of Directors</a>
        <a href="#">Committee Officers</a>
      </div>
    </div>

    <a href="{{ route('Guest.NewsEvents') }}">News &amp; Events</a>
    <a href="{{ route('Guest.Testimonials') }}">Testimonials</a>
  </nav>

  <div style="display:flex;align-items:center;gap:12px;">
    <a href="{{ route('Member.Login') }}" class="btn-login-header">Login</a>
    <button class="ham-btn" onclick="toggleMobileNav()">
      <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
  </div>
</header>

<div class="mobile-nav" id="mobile-nav">
  <a href="{{ route('Landing.Page') }}">Home</a>
  <div class="mobile-nav-group">
    <button onclick="this.nextElementSibling.classList.toggle('open')">Services</button>
    <div class="mobile-sub">
      <a href="{{ route('Guest.Loans') }}">Loans</a>
      <a href="#">Deposits</a>
      <a href="#">Savings</a>
    </div>
  </div>
  <div class="mobile-nav-group">
    <button onclick="this.nextElementSibling.classList.toggle('open')">About</button>
    <div class="mobile-sub">
      <a href="{{ route('Guest.AboutUs') }}">About GBLDC</a>
      <a href="#">Board of Directors</a>
      <a href="#">Committee Officers</a>
    </div>
  </div>
  <a href="{{ route('Guest.NewsEvents') }}">News &amp; Events</a>
  <a href="{{ route('Guest.Testimonials') }}">Testimonials</a>
  <div class="mobile-divider"></div>
  <a href="{{ route('Member.Login') }}" class="mobile-login">Login to Member Portal</a>
</div>

<!-- ── PAGE WRAPPER ── -->
<div class="reg-wrapper">

    <!-- ── SIDEBAR ── -->
    <aside class="reg-sidebar">
        <div class="sidebar-top">
            <div class="sidebar-title">Member Application</div>
            <div class="sidebar-subtitle">Online Registration</div>
        </div>
        <div class="step-nav">
            <div class="step-nav-item active" id="snav-1">
                <div class="step-nav-circle" id="snav-circle-1"><i data-lucide="user"></i></div>
                <div class="step-nav-text">
                    <div class="step-nav-label" id="snav-label-1">Personal Info</div>
                    <div class="step-nav-sub">Name, age, gender</div>
                </div>
            </div>
            <div class="step-nav-item" id="snav-2">
                <div class="step-nav-circle" id="snav-circle-2"><i data-lucide="map-pin"></i></div>
                <div class="step-nav-text">
                    <div class="step-nav-label" id="snav-label-2">Home Address</div>
                    <div class="step-nav-sub">Province, city, barangay</div>
                </div>
            </div>
            <div class="step-nav-item" id="snav-3">
                <div class="step-nav-circle" id="snav-circle-3"><i data-lucide="phone-call"></i></div>
                <div class="step-nav-text">
                    <div class="step-nav-label" id="snav-label-3">Emergency Contact</div>
                    <div class="step-nav-sub">Person to contact</div>
                </div>
            </div>
            <div class="step-nav-item" id="snav-4">
                <div class="step-nav-circle" id="snav-circle-4"><i data-lucide="briefcase"></i></div>
                <div class="step-nav-text">
                    <div class="step-nav-label" id="snav-label-4">Employment</div>
                    <div class="step-nav-sub">Work & income info</div>
                </div>
            </div>
            <div class="step-nav-item" id="snav-5">
                <div class="step-nav-circle" id="snav-circle-5"><i data-lucide="banknote"></i></div>
                <div class="step-nav-text">
                    <div class="step-nav-label" id="snav-label-5">Shared Capital</div>
                    <div class="step-nav-sub">Shares & payment</div>
                </div>
            </div>
            <div class="step-nav-item" id="snav-6">
                <div class="step-nav-circle" id="snav-circle-6"><i data-lucide="paperclip"></i></div>
                <div class="step-nav-text">
                    <div class="step-nav-label" id="snav-label-6">Documents</div>
                    <div class="step-nav-sub">Upload attachments</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- ── MAIN FORM ── -->
    <div class="reg-main">
        <form id="registrationForm" action="{{ route('registration.Processing') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- STEP 1 -->
            <div class="form-page active" id="page-1">
                <div class="form-card">
                    <div class="page-tag"><i data-lucide="circle-check"></i> Step 1 of 6</div>
                    <div class="section-header">
                        <div class="section-icon"><i data-lucide="user"></i></div>
                        <div>
                            <h3>Personal Information</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Your accurate personal details</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div>
                            <label class="field-label">Last Name <span class="req">*</span></label>
                            <input type="text" name="last_name" class="form-input" placeholder="e.g. Dela Cruz" required>
                        </div>
                        <div>
                            <label class="field-label">First Name <span class="req">*</span></label>
                            <input type="text" name="first_name" class="form-input" placeholder="e.g. Juan" required>
                        </div>
                        <div>
                            <label class="field-label">Middle Name <span class="req">*</span></label>
                            <input type="text" name="middle_name" class="form-input" placeholder="e.g. Santos" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="field-label">Place of Birth <span class="req">*</span></label>
                            <input type="text" name="place_of_birth" class="form-input" placeholder="City/Municipality" required>
                        </div>
                        <div>
                            <label class="field-label">Birth Date <span class="req">*</span></label>
                            <input id="birthDate" type="date" name="birthdate" class="form-input" required onchange="calculateAge()">
                        </div>
                        <div>
                            <label class="field-label">Age <span class="req">*</span></label>
                            <input id="age" type="number" name="age" class="form-input" readonly required placeholder="Auto-filled">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="field-label">Gender <span class="req">*</span></label>
                            <div class="gender-group">
                                <label class="gender-option" id="genderMaleLabel" onclick="selectGender('Male')">
                                    <input type="radio" name="gender" value="Male" required>
                                    <i data-lucide="user"></i> Male
                                </label>
                                <label class="gender-option" id="genderFemaleLabel" onclick="selectGender('Female')">
                                    <input type="radio" name="gender" value="Female">
                                    <i data-lucide="user"></i> Female
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Religion <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="religion" class="form-select" required>
                                    <option value="">Select Religion</option>
                                    <option>ROMAN CATHOLIC</option><option>PROTESTANT</option><option>CHRISTIAN</option>
                                    <option>BAPTIST</option><option>SEVENTH-DAY ADVENTIST</option><option>IGLESIA NI CRISTO</option>
                                    <option>ADVENTIST</option><option>BUDDHISM</option><option>JESUS IS LORD MOVEMENT</option>
                                    <option>JEHOVAH'S WITNESSES</option><option>METHODIST</option><option>NON-SECTARIAN</option>
                                    <option>OTHER</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Civil Status <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="civil_status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option>SINGLE</option><option>MARRIED</option><option>WIDOW</option><option>SEPARATED</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">Nationality <span class="req">*</span></label>
                            <input type="text" name="nationality" class="form-input" placeholder="e.g. Filipino" required>
                        </div>
                        <div>
                            <label class="field-label">Contact Number <span class="req">*</span></label>
                            <div class="phone-wrapper">
                                <span class="phone-prefix"><i data-lucide="phone"></i> +63</span>
                                <input type="tel" name="contact_number" class="phone-input" pattern="[9][0-9]{9}" maxlength="10" placeholder="9XXXXXXXXX" required inputmode="numeric" oninput="validatePhone(this,'phoneError')">
                            </div>
                            <div class="field-hint error" id="phoneError"><i data-lucide="circle-alert"></i> Must be 10 digits starting with 9.</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="field-label">Email Address <span class="req">*</span></label>
                        <input type="email" name="email" id="emailInput" class="form-input" placeholder="juandelacruz@gmail.com" required oninput="validateEmail(this)">
                        <div class="field-hint error" id="emailError"><i data-lucide="circle-alert"></i> Please enter a valid email address.</div>
                    </div>
                    <div class="flex justify-end mt-8">
                        <button type="button" class="btn-next" onclick="goToStep(2)">Next <i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="form-page" id="page-2">
                <div class="form-card">
                    <div class="page-tag"><i data-lucide="circle-check"></i> Step 2 of 6</div>
                    <div class="section-header">
                        <div class="section-icon"><i data-lucide="map-pin"></i></div>
                        <div>
                            <h3>Home Address</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Your current residential address</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div>
                            <label class="field-label">Province <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select id="psgc_province" name="province" class="form-select" required>
                                    <option value="" selected>Select Province</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">City / Municipality <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select id="psgc_city" name="city" class="form-select" required disabled>
                                    <option value="" selected>Select City</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Barangay <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select id="psgc_barangay" name="barangay" class="form-select" required disabled>
                                    <option value="" selected>Select Barangay</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="field-label">Street Address <span class="req">*</span></label>
                            <input type="text" name="street_address" class="form-input" placeholder="House No. & Street Name" required>
                        </div>
                        <div>
                            <label class="field-label">Years of Stay <span class="req">*</span></label>
                            <div class="relative">
                                <input type="number" name="year_of_stay" class="form-input pr-10" placeholder="e.g. 5" min="0" max="100" required oninput="validateYearsOfStay(this)">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 pointer-events-none">yrs</span>
                            </div>
                            <div class="field-hint error" id="yearsError"><i data-lucide="circle-alert"></i> Enter a valid number (0–100).</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div class="md:col-span-2">
                            <label class="field-label">House Ownership <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="house_ownership" class="form-select" required>
                                    <option value="">Select Ownership</option>
                                    <option>Owned</option><option>Rented</option><option>Living with Parents</option><option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">
                                Zip Code <span class="req">*</span>
                                <span class="tooltip-wrapper">
                                    <span class="tooltip-icon"><i data-lucide="info"></i></span>
                                    <span class="tooltip-box">Philippine postal codes are 4 digits, e.g. 3019 for Marilao, Bulacan.</span>
                                </span>
                            </label>
                            <input type="text" name="zip_code" id="zipCode" class="form-input" placeholder="e.g. 3019" maxlength="4" required oninput="validateZipCode(this)" inputmode="numeric">
                            <div class="field-hint error"   id="zipError"><i data-lucide="circle-alert"></i> Must be exactly 4 digits.</div>
                            <div class="field-hint success" id="zipSuccess"><i data-lucide="circle-check"></i> Valid zip code.</div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-prev" onclick="goToStep(1)"><i data-lucide="arrow-left"></i> Back</button>
                        <button type="button" class="btn-next" onclick="goToStep(3)">Next <i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="form-page" id="page-3">
                <div class="form-card">
                    <div class="page-tag"><i data-lucide="circle-check"></i> Step 3 of 6</div>
                    <div class="section-header">
                        <div class="section-icon"><i data-lucide="phone-call"></i></div>
                        <div>
                            <h3>Emergency Contact</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Person to contact in case of emergency</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div>
                            <label class="field-label">Full Name <span class="req">*</span></label>
                            <input type="text" name="ec_fullname" class="form-input" placeholder="Full Name" required>
                        </div>
                        <div>
                            <label class="field-label">Gender <span class="req">*</span></label>
                            <div class="gender-group">
                                <label class="gender-option" id="ecGenderMaleLabel" onclick="selectGender('Male','ec_gender','ecGenderMaleLabel','ecGenderFemaleLabel')">
                                    <input type="radio" name="ec_gender" value="Male" required><i data-lucide="user"></i> Male
                                </label>
                                <label class="gender-option" id="ecGenderFemaleLabel" onclick="selectGender('Female','ec_gender','ecGenderMaleLabel','ecGenderFemaleLabel')">
                                    <input type="radio" name="ec_gender" value="Female"><i data-lucide="user"></i> Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">Email Address <span class="req">*</span></label>
                            <input type="email" name="ec_email" class="form-input" placeholder="you@example.com" required oninput="validateEmailGeneric(this)">
                        </div>
                        <div>
                            <label class="field-label">Contact Number <span class="req">*</span></label>
                            <div class="phone-wrapper">
                                <span class="phone-prefix"><i data-lucide="phone"></i> +63</span>
                                <input type="tel" name="ec_contact_number" class="phone-input" pattern="[9][0-9]{9}" maxlength="10" placeholder="9XXXXXXXXX" required inputmode="numeric" oninput="validatePhone(this,'ecPhoneError')">
                            </div>
                            <div class="field-hint error" id="ecPhoneError"><i data-lucide="circle-alert"></i> Must be 10 digits starting with 9.</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">Home Address <span class="req">*</span></label>
                            <input type="text" name="ec_address" class="form-input" placeholder="Complete Address" required>
                        </div>
                        <div>
                            <label class="field-label">Relationship <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="ec_relationship" class="form-select" required>
                                    <option value="">Select Relationship</option>
                                    <option>Parent</option><option>Spouse</option><option>Sibling</option>
                                    <option>Child</option><option>Relative</option><option>Friend</option>
                                    <option>Colleague</option><option>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-prev" onclick="goToStep(2)"><i data-lucide="arrow-left"></i> Back</button>
                        <button type="button" class="btn-next" onclick="goToStep(4)">Next <i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="form-page" id="page-4">
                <div class="form-card">
                    <div class="page-tag"><i data-lucide="circle-check"></i> Step 4 of 6</div>
                    <div class="section-header">
                        <div class="section-icon"><i data-lucide="briefcase"></i></div>
                        <div>
                            <h3>Employment Information</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Your employment and financial background</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div>
                            <label class="field-label">Employment Status <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="employment_status" class="form-select" required>
                                    <option value="">Select</option>
                                    <option>Employed</option><option>Self Employed</option><option>Unemployed</option>
                                    <option>Retired</option><option>Student</option><option>Freelancer</option>
                                    <option>OFW</option><option>Part Time</option><option>Contractual</option>
                                    <option>Seasonal</option><option>Business Owner</option><option>Homemaker</option>
                                    <option>Disabled</option><option>Others</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Source of Funds <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="source_of_funds" class="form-select" required>
                                    <option value="">Select</option>
                                    <option>Salary</option><option>Business</option><option>Pension</option>
                                    <option>Remittance</option><option>Investment</option><option>Allowance</option>
                                    <option>Rental Income</option><option>Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">Employer / Business Name <span class="req">*</span></label>
                            <input type="text" name="employer_business_name" class="form-input" placeholder="Name of employer or business" required>
                        </div>
                        <div>
                            <label class="field-label">Occupation <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="occupation" class="form-select" required>
                                    <option value="">Select Occupation</option>
                                    <option>Accountant</option><option>Engineer</option><option>Teacher</option>
                                    <option>Doctor</option><option>Nurse</option><option>Police Officer</option>
                                    <option>Firefighter</option><option>Driver</option><option>Salesperson</option>
                                    <option>Cashier</option><option>Manager</option><option>Clerk</option>
                                    <option>Farmer</option><option>Fisherman</option><option>Construction Worker</option>
                                    <option>Business Owner</option><option>Self-Employed</option><option>Student</option>
                                    <option>Retired</option><option>Unemployed</option><option>Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="field-label">Company / Business Address <span class="req">*</span></label>
                        <input type="text" name="company_business_address" class="form-input" placeholder="Complete business address" required>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">Gross Monthly Income <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="gross_monthly_income" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="below 10000">Below ₱10,000</option>
                                    <option value="10000 - 20000">₱10,000 – ₱20,000</option>
                                    <option value="20001 - 30000">₱20,001 – ₱30,000</option>
                                    <option value="30001 - 50000">₱30,001 – ₱50,000</option>
                                    <option value="50001 - 100000">₱50,001 – ₱100,000</option>
                                    <option value="above 100000">Above ₱100,000</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Nature / Type of Employment <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="nature_type_of_employment_business" class="form-select" required>
                                    <option value="">Select</option>
                                    <option>Government</option><option>Private</option><option>Self-Employed</option>
                                    <option>OFW</option><option>Freelancer</option><option>Business Owner</option>
                                    <option>Retired</option><option>Student</option><option>Unemployed</option>
                                    <option>Non-Profit/NGO</option><option>Contractual</option><option>Part-Time</option>
                                    <option>Seasonal</option><option>Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">SSS / GSIS No. <span class="req">*</span>
                                <span class="tooltip-wrapper"><span class="tooltip-icon"><i data-lucide="info"></i></span><span class="tooltip-box">SSS: XX–XXXXXXX–X (10 digits). GSIS: 11 digits.</span></span>
                            </label>
                            <input type="text" name="sss_gsis_no" id="sssInput" class="form-input" placeholder="e.g. 34–1234567–8" maxlength="14" oninput="validateSSS(this)" required>
                            <div class="field-hint error"   id="sssError"><i data-lucide="circle-alert"></i> Invalid SSS/GSIS — check the digits.</div>
                            <div class="field-hint success" id="sssSuccess"><i data-lucide="circle-check"></i> Valid SSS/GSIS number.</div>
                            <div class="field-hint info"    id="sssInfo"><i data-lucide="info"></i> SSS: XX–XXXXXXX–X &nbsp;|&nbsp; GSIS: 11 digits</div>
                        </div>
                        <div>
                            <label class="field-label">TIN No. <span class="req">*</span>
                                <span class="tooltip-wrapper"><span class="tooltip-icon"><i data-lucide="info"></i></span><span class="tooltip-box">Format: XXX-XXX-XXX or XXX-XXX-XXX-XXXX</span></span>
                            </label>
                            <input type="text" name="tin_no" id="tinInput" class="form-input" placeholder="e.g. 123-456-789" maxlength="15" oninput="validateTIN(this)" required>
                            <div class="field-hint error"   id="tinError"><i data-lucide="circle-alert"></i> TIN format: XXX-XXX-XXX or XXX-XXX-XXX-XXXX.</div>
                            <div class="field-hint success" id="tinSuccess"><i data-lucide="circle-check"></i> Valid TIN number.</div>
                            <div class="field-hint info"    id="tinInfo"><i data-lucide="info"></i> Format: XXX-XXX-XXX or XXX-XXX-XXX-XXXX</div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-prev" onclick="goToStep(3)"><i data-lucide="arrow-left"></i> Back</button>
                        <button type="button" class="btn-next" onclick="goToStep(5)">Next <i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- STEP 5 -->
            <div class="form-page" id="page-5">
                <div class="form-card">
                    <div class="page-tag"><i data-lucide="circle-check"></i> Step 5 of 6</div>
                    <div class="section-header">
                        <div class="section-icon"><i data-lucide="banknote"></i></div>
                        <div>
                            <h3>Shared Capital</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Your initial capital contribution to GBLDC</p>
                        </div>
                    </div>
                    <div class="info-banner blue mt-5">
                        <i data-lucide="info"></i>
                        <p>Shared capital is the member's equity contribution to the cooperative. Minimum initial share capital is <strong>₱1,000.00</strong>. Additional shares may be subscribed in multiples of ₱100.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div>
                            <label class="field-label">No. of Shares Subscribed <span class="req">*</span></label>
                            <input type="number" name="shares_subscribed" id="sharesSubscribed" class="form-input" placeholder="e.g. 10" min="1" required oninput="computeCapital()">
                            <div class="field-hint info" style="display:flex;"><i data-lucide="info"></i> Each share = ₱100.00</div>
                        </div>
                        <div>
                            <label class="field-label">Total Subscribed Capital <span class="req">*</span></label>
                            <div class="amount-prefix-wrap">
                                <span class="amount-prefix">₱</span>
                                <input type="text" name="total_subscribed_capital" id="totalSubscribed" class="amount-input" placeholder="0.00" readonly required>
                            </div>
                            <div class="field-hint info" style="display:flex;"><i data-lucide="info"></i> Auto-computed (shares × ₱100)</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">Initial Payment <span class="req">*</span></label>
                            <div class="amount-prefix-wrap">
                                <span class="amount-prefix">₱</span>
                                <input type="number" name="initial_payment" id="initialPayment" class="amount-input" placeholder="e.g. 1000.00" min="1000" step="100" required oninput="validateInitialPayment()">
                            </div>
                            <div class="field-hint error"   id="paymentError"><i data-lucide="circle-alert"></i> Minimum initial payment is ₱1,000.</div>
                            <div class="field-hint success" id="paymentSuccess"><i data-lucide="circle-check"></i> Valid initial payment.</div>
                        </div>
                        <div>
                            <label class="field-label">Mode of Payment <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="mode_of_payment" class="form-select" required>
                                    <option value="">Select Mode</option>
                                    <option value="Cash">Cash</option><option value="Bank Transfer">Bank Transfer</option>
                                    <option value="GCash">GCash</option><option value="Maya">Maya</option><option value="Check">Check</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="field-label">Beneficiary Full Name <span class="req">*</span></label>
                            <input type="text" name="beneficiary_name" class="form-input" placeholder="Full Name of Beneficiary" required>
                        </div>
                        <div>
                            <label class="field-label">Beneficiary Relationship <span class="req">*</span></label>
                            <div class="select-wrapper">
                                <select name="beneficiary_relationship" class="form-select" required>
                                    <option value="">Select Relationship</option>
                                    <option>Spouse</option><option>Child</option><option>Parent</option>
                                    <option>Sibling</option><option>Relative</option><option>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="field-label">Beneficiary Address <span class="req">*</span></label>
                        <input type="text" name="beneficiary_address" class="form-input" placeholder="Complete Address of Beneficiary" required>
                    </div>
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-prev" onclick="goToStep(4)"><i data-lucide="arrow-left"></i> Back</button>
                        <button type="button" class="btn-next" onclick="goToStep(6)">Next <i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- STEP 6 -->
            <div class="form-page" id="page-6">
                <div class="form-card">
                    <div class="page-tag"><i data-lucide="circle-check"></i> Step 6 of 6</div>
                    <div class="section-header">
                        <div class="section-icon"><i data-lucide="paperclip"></i></div>
                        <div>
                            <h3>Attachments</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Upload clear and legible copies of required documents</p>
                        </div>
                    </div>
                    <div class="info-banner amber mt-5">
                        <i data-lucide="triangle-alert"></i>
                        <p><strong>File Requirements:</strong> Accepted: JPG, PNG, PDF. Max <strong>25 MB</strong> per file. Ensure documents are clear and legible.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
                        <div>
                            <label class="field-label">2×2 Picture <span class="req">*</span></label>
                            <div class="upload-zone" id="picZone" ondragover="onDragOver(event,'picZone')" ondragleave="onDragLeave(event,'picZone')" ondrop="onDrop(event,'picFile','picPreviewImg','picError','picSuccess','picProgress','picProgressBar','picZone')">
                                <input type="file" name="two_by_two_picture" id="picFile" accept="image/jpeg,image/png,application/pdf" required onchange="handleFile(this,'picPreviewImg','picError','picSuccess','picProgress','picProgressBar','picZone',25)">
                                <div id="picPrompt">
                                    <div class="upload-icon"><i data-lucide="camera"></i></div>
                                    <div class="upload-label">Upload Photo</div>
                                    <div class="upload-text">Drag & drop or click<br><span class="text-xs">JPG, PNG, PDF · max 25 MB</span></div>
                                </div>
                            </div>
                            <div class="upload-progress" id="picProgress"><div class="upload-progress-bar" id="picProgressBar"></div></div>
                            <div class="upload-error" id="picError"><i data-lucide="circle-x"></i> <span></span></div>
                            <div class="upload-success" id="picSuccess"><i data-lucide="circle-check"></i> <span></span></div>
                            <div class="upload-preview" id="picPreview">
                                <button type="button" class="upload-remove-btn" onclick="removeFile('picFile','picPreviewImg','picError','picSuccess','picProgress','picPreview','picPrompt','picZone')"><i data-lucide="x"></i></button>
                                <img id="picPreviewImg" src="" alt="Preview">
                                <div class="preview-filename" id="picFilename"></div>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Proof of Billing <span class="req">*</span></label>
                            <div class="upload-zone" id="billingZone" ondragover="onDragOver(event,'billingZone')" ondragleave="onDragLeave(event,'billingZone')" ondrop="onDrop(event,'billingFile','billingPreviewImg','billingError','billingSuccess','billingProgress','billingProgressBar','billingZone')">
                                <input type="file" name="proof_of_billing" id="billingFile" accept="image/jpeg,image/png,application/pdf" required onchange="handleFile(this,'billingPreviewImg','billingError','billingSuccess','billingProgress','billingProgressBar','billingZone',25)">
                                <div id="billingPrompt">
                                    <div class="upload-icon"><i data-lucide="file-text"></i></div>
                                    <div class="upload-label">Upload Billing</div>
                                    <div class="upload-text">Drag & drop or click<br><span class="text-xs">JPG, PNG, PDF · max 25 MB</span></div>
                                </div>
                            </div>
                            <div class="upload-progress" id="billingProgress"><div class="upload-progress-bar" id="billingProgressBar"></div></div>
                            <div class="upload-error" id="billingError"><i data-lucide="circle-x"></i> <span></span></div>
                            <div class="upload-success" id="billingSuccess"><i data-lucide="circle-check"></i> <span></span></div>
                            <div class="upload-preview" id="billingPreview">
                                <button type="button" class="upload-remove-btn" onclick="removeFile('billingFile','billingPreviewImg','billingError','billingSuccess','billingProgress','billingPreview','billingPrompt','billingZone')"><i data-lucide="x"></i></button>
                                <img id="billingPreviewImg" src="" alt="Preview">
                                <div class="preview-filename" id="billingFilename"></div>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Valid ID <span class="req">*</span></label>
                            <div class="upload-zone" id="idZone" ondragover="onDragOver(event,'idZone')" ondragleave="onDragLeave(event,'idZone')" ondrop="onDrop(event,'validIdFile','idPreviewImg','idError','idSuccess','idProgress','idProgressBar','idZone')">
                                <input type="file" name="valid_id" id="validIdFile" accept="image/jpeg,image/png,application/pdf" required onchange="handleFile(this,'idPreviewImg','idError','idSuccess','idProgress','idProgressBar','idZone',25)">
                                <div id="idPrompt">
                                    <div class="upload-icon"><i data-lucide="id-card"></i></div>
                                    <div class="upload-label">Upload Valid ID</div>
                                    <div class="upload-text">Drag & drop or click<br><span class="text-xs">JPG, PNG, PDF · max 25 MB</span></div>
                                </div>
                            </div>
                            <div class="upload-progress" id="idProgress"><div class="upload-progress-bar" id="idProgressBar"></div></div>
                            <div class="upload-error" id="idError"><i data-lucide="circle-x"></i> <span></span></div>
                            <div class="upload-success" id="idSuccess"><i data-lucide="circle-check"></i> <span></span></div>
                            <div class="upload-preview" id="idPreview">
                                <button type="button" class="upload-remove-btn" onclick="removeFile('validIdFile','idPreviewImg','idError','idSuccess','idProgress','idPreview','idPrompt','idZone')"><i data-lucide="x"></i></button>
                                <img id="idPreviewImg" src="" alt="Preview">
                                <div class="preview-filename" id="idFilename"></div>
                            </div>
                        </div>
                    </div>
                    <hr class="section-divider">
                    <div class="terms-wrapper">
                        <input type="checkbox" id="terms" required>
                        <label for="terms" class="text-sm text-gray-700 cursor-pointer">
                            I confirm that all information I have provided is accurate and complete. I agree to the
                            <a href="#" class="text-green-700 underline font-medium hover:text-green-800">Terms & Conditions</a> of GBLDC,
                            and I consent to the processing of my personal data as described in the Privacy Policy.
                        </label>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
                        <button type="button" class="btn-prev" onclick="goToStep(5)"><i data-lucide="arrow-left"></i> Back</button>
                        <div class="flex items-center gap-3">
                            <p class="text-xs text-gray-400 flex items-center gap-1"><i data-lucide="lock" style="width:12px;height:12px;display:inline;"></i> Secure & encrypted</p>
                            <button type="submit" class="btn-next"><i data-lucide="send"></i> Submit Application</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
const TOTAL_STEPS = 6;
let currentStep = 1;

document.addEventListener('DOMContentLoaded', function () {
    lucide.createIcons();
    var modal = document.getElementById('successModal');
    if (!modal) return;
    var okBtn = document.getElementById('successModalOk');
    var backdrop = modal.querySelector('.absolute.inset-0');
    var close = function () { modal.classList.add('hidden'); document.documentElement.classList.remove('overflow-hidden'); document.body.classList.remove('overflow-hidden'); };
    okBtn && okBtn.addEventListener('click', close);
    backdrop && backdrop.addEventListener('click', close);
    modal.classList.remove('hidden');
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');
});

function goToStep(n) {
    if (n > currentStep) {
        var page = document.getElementById('page-' + currentStep);
        var fields = page.querySelectorAll('input:not([type="hidden"]), select, textarea');
        for (var i = 0; i < fields.length; i++) {
            var el = fields[i];
            if (el.hasAttribute('required') && !el.disabled && !el.checkValidity()) { el.reportValidity(); el.focus(); return; }
        }
    }
    document.getElementById('page-' + currentStep).classList.remove('active');
    updateStepper(currentStep, n);
    currentStep = n;
    document.getElementById('page-' + n).classList.add('active');
    document.getElementById('registrationForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function updateStepper(from, to) {
    for (let i = 1; i <= TOTAL_STEPS; i++) {
        const item = document.getElementById('snav-' + i);
        item.classList.remove('active', 'done');
        if (i < to)       item.classList.add('done');
        else if (i === to) item.classList.add('active');
    }
}

function calculateAge() {
    const bd = document.getElementById('birthDate').value;
    const el = document.getElementById('age');
    if (!bd) { el.value = ''; return; }
    const today = new Date(), birth = new Date(bd);
    let age = today.getFullYear() - birth.getFullYear();
    const m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
    el.value = age >= 0 ? age : '';
}

function selectGender(val, name = 'gender', maleId = 'genderMaleLabel', femaleId = 'genderFemaleLabel') {
    document.getElementById(maleId).classList.toggle('selected',   val === 'Male');
    document.getElementById(femaleId).classList.toggle('selected', val === 'Female');
    document.querySelectorAll(`input[name="${name}"]`).forEach(r => { r.checked = r.value === val; });
}

function computeCapital() {
    const shares = parseInt(document.getElementById('sharesSubscribed').value) || 0;
    const total  = shares * 100;
    document.getElementById('totalSubscribed').value = total > 0 ? total.toLocaleString('en-PH', { minimumFractionDigits: 2 }) : '';
}

function validateInitialPayment() {
    const val   = parseFloat(document.getElementById('initialPayment').value);
    const errEl = document.getElementById('paymentError');
    const okEl  = document.getElementById('paymentSuccess');
    if (!document.getElementById('initialPayment').value) { errEl.classList.remove('show'); okEl.classList.remove('show'); return; }
    val >= 1000 ? (errEl.classList.remove('show'), okEl.classList.add('show')) : (okEl.classList.remove('show'), errEl.classList.add('show'));
}

function validatePhone(input, errorId) {
    input.value = input.value.replace(/\D/g,'');
    const ok = input.value.length === 10 && input.value.startsWith('9');
    const empty = input.value.length === 0;
    const el = document.getElementById(errorId);
    if (empty) { el.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    ok ? (el.classList.remove('show'), input.classList.add('is-valid'), input.classList.remove('is-invalid'))
       : (el.classList.add('show'), input.classList.add('is-invalid'), input.classList.remove('is-valid'));
}

function validateEmail(input) {
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value);
    const el = document.getElementById('emailError');
    if (!input.value) { el.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    ok ? (el.classList.remove('show'), input.classList.add('is-valid'), input.classList.remove('is-invalid'))
       : (el.classList.add('show'), input.classList.add('is-invalid'), input.classList.remove('is-valid'));
}
function validateEmailGeneric(input) {
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value);
    if (!input.value) { input.classList.remove('is-valid','is-invalid'); return; }
    input.classList.toggle('is-valid', ok); input.classList.toggle('is-invalid', !ok);
}

function validateZipCode(input) {
    input.value = input.value.replace(/\D/g,'');
    const ok = input.value.length === 4;
    const empty = input.value.length === 0;
    const errEl = document.getElementById('zipError');
    const okEl  = document.getElementById('zipSuccess');
    if (empty) { errEl.classList.remove('show'); okEl.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    ok ? (errEl.classList.remove('show'), okEl.classList.add('show'), input.classList.add('is-valid'), input.classList.remove('is-invalid'))
       : (okEl.classList.remove('show'), errEl.classList.add('show'), input.classList.add('is-invalid'), input.classList.remove('is-valid'));
}

function validateYearsOfStay(input) {
    const v = parseInt(input.value);
    const el = document.getElementById('yearsError');
    if (input.value === '') { el.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    (!isNaN(v) && v >= 0 && v <= 100)
        ? (el.classList.remove('show'), input.classList.add('is-valid'), input.classList.remove('is-invalid'))
        : (el.classList.add('show'), input.classList.add('is-invalid'), input.classList.remove('is-valid'));
}

function validateSSS(input) {
    let raw = input.value.replace(/[^\d]/g,'');
    const EM = '\u2013';
    if (raw.length <= 10) {
        let f = raw;
        if (raw.length > 2) f = raw.slice(0,2) + EM + raw.slice(2);
        if (raw.length > 9) f = raw.slice(0,2) + EM + raw.slice(2,9) + EM + raw.slice(9);
        input.value = f;
    } else { input.value = raw.slice(0,11); }
    const digits = input.value.replace(/[^\d]/g,'');
    const empty = digits.length === 0, ok = digits.length === 10 || digits.length === 11;
    const errEl = document.getElementById('sssError'), okEl = document.getElementById('sssSuccess'), infoEl = document.getElementById('sssInfo');
    if (empty) { errEl.classList.remove('show'); okEl.classList.remove('show'); infoEl.classList.add('show'); input.classList.remove('is-valid','is-invalid'); return; }
    infoEl.classList.remove('show');
    ok ? (errEl.classList.remove('show'), okEl.classList.add('show'), input.classList.add('is-valid'), input.classList.remove('is-invalid'))
       : (okEl.classList.remove('show'), errEl.classList.add('show'), input.classList.add('is-invalid'), input.classList.remove('is-valid'));
}

function validateTIN(input) {
    let raw = input.value.replace(/\D/g,'');
    let f = raw;
    if (raw.length > 3) f = raw.slice(0,3)+'-'+raw.slice(3);
    if (raw.length > 6) f = raw.slice(0,3)+'-'+raw.slice(3,6)+'-'+raw.slice(6);
    if (raw.length > 9) f = raw.slice(0,3)+'-'+raw.slice(3,6)+'-'+raw.slice(6,9)+'-'+raw.slice(9,13);
    input.value = f;
    const digits = raw, empty = digits.length === 0, ok = digits.length === 9 || digits.length === 12;
    const errEl = document.getElementById('tinError'), okEl = document.getElementById('tinSuccess'), infoEl = document.getElementById('tinInfo');
    if (empty) { errEl.classList.remove('show'); okEl.classList.remove('show'); infoEl.classList.add('show'); input.classList.remove('is-valid','is-invalid'); return; }
    infoEl.classList.remove('show');
    ok ? (errEl.classList.remove('show'), okEl.classList.add('show'), input.classList.add('is-valid'), input.classList.remove('is-invalid'))
       : (okEl.classList.remove('show'), errEl.classList.add('show'), input.classList.add('is-invalid'), input.classList.remove('is-valid'));
}

document.getElementById('sssInput').addEventListener('focus', () => { if (!document.getElementById('sssInput').value) document.getElementById('sssInfo').classList.add('show'); });
document.getElementById('sssInput').addEventListener('blur',  () => document.getElementById('sssInfo').classList.remove('show'));
document.getElementById('tinInput').addEventListener('focus', () => { if (!document.getElementById('tinInput').value) document.getElementById('tinInfo').classList.add('show'); });
document.getElementById('tinInput').addEventListener('blur',  () => document.getElementById('tinInfo').classList.remove('show'));

const MAX_MB = 25, ACCEPTED = ['image/jpeg','image/png','application/pdf'];
function fmtSize(b) { if (b < 1024) return b + ' B'; if (b < 1048576) return (b/1024).toFixed(1)+' KB'; return (b/1048576).toFixed(2)+' MB'; }

function handleFile(input, previewImgId, errorId, successId, progressId, progressBarId, zoneId, maxMB) {
    const file = input.files[0];
    const errEl = document.getElementById(errorId), okEl = document.getElementById(successId);
    const progEl = document.getElementById(progressId), barEl = document.getElementById(progressBarId);
    const zone = document.getElementById(zoneId);
    const prefix = zoneId.replace('Zone','');
    const previewEl = document.getElementById(prefix+'Preview'), promptEl = document.getElementById(prefix+'Prompt'), filenameEl = document.getElementById(prefix+'Filename');
    errEl.classList.remove('show'); okEl.classList.remove('show'); progEl.classList.remove('show'); barEl.style.width = '0%';
    if (previewEl) previewEl.style.display = 'none';
    zone.style.borderColor = '';
    if (!file) return;
    if (!ACCEPTED.includes(file.type)) { errEl.querySelector('span').textContent = 'Unsupported type. Use JPG, PNG, or PDF.'; errEl.classList.add('show'); input.value = ''; zone.style.borderColor = '#ef4444'; return; }
    if (file.size > maxMB * 1048576) { errEl.querySelector('span').textContent = `File too large: ${fmtSize(file.size)}. Max is ${maxMB} MB.`; errEl.classList.add('show'); input.value = ''; zone.style.borderColor = '#ef4444'; return; }
    progEl.classList.add('show');
    let pct = 0;
    const iv = setInterval(() => {
        pct += Math.random() * 30;
        if (pct >= 100) {
            pct = 100; clearInterval(iv); progEl.classList.remove('show');
            okEl.querySelector('span').textContent = `${file.name} (${fmtSize(file.size)}) ready.`;
            okEl.classList.add('show'); zone.style.borderColor = '#22c55e';
            if (file.type.startsWith('image/')) {
                const r = new FileReader();
                r.onload = e => { document.getElementById(previewImgId).src = e.target.result; if (previewEl) previewEl.style.display = 'block'; if (promptEl) promptEl.style.display = 'none'; if (filenameEl) filenameEl.textContent = file.name; };
                r.readAsDataURL(file);
            } else {
                if (previewEl) { previewEl.style.display = 'block'; previewEl.querySelector('img').style.display = 'none'; }
                if (!previewEl.querySelector('.pdf-label')) { const d = document.createElement('div'); d.className = 'pdf-label text-sm text-gray-600 text-left mt-2'; d.textContent = file.name; previewEl.insertBefore(d, previewEl.querySelector('.preview-filename')); }
                if (promptEl) promptEl.style.display = 'none';
                if (filenameEl) filenameEl.textContent = file.name;
            }
        }
        barEl.style.width = Math.min(pct, 100) + '%';
    }, 70);
}

function removeFile(inputId, previewImgId, errorId, successId, progressId, previewDivId, promptId, zoneId) {
    document.getElementById(inputId).value = '';
    ['show'].forEach(c => { document.getElementById(errorId).classList.remove(c); document.getElementById(successId).classList.remove(c); document.getElementById(progressId).classList.remove(c); });
    document.getElementById(previewDivId).style.display = 'none';
    document.getElementById(promptId).style.display = '';
    document.getElementById(zoneId).style.borderColor = '';
    const img = document.getElementById(previewImgId);
    if (img) { img.src = ''; img.style.display = ''; }
    const pdf = document.getElementById(previewDivId).querySelector('.pdf-label');
    if (pdf) pdf.remove();
}

function onDragOver(e, zoneId) { e.preventDefault(); document.getElementById(zoneId).classList.add('dragover'); }
function onDragLeave(e, zoneId){ document.getElementById(zoneId).classList.remove('dragover'); }
function onDrop(e, inputId, previewImgId, errorId, successId, progressId, progressBarId, zoneId) {
    e.preventDefault(); document.getElementById(zoneId).classList.remove('dragover');
    const file = e.dataTransfer.files[0]; if (!file) return;
    const input = document.getElementById(inputId);
    const dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
    handleFile(input, previewImgId, errorId, successId, progressId, progressBarId, zoneId, MAX_MB);
}

function toggleMobileNav() {
    const nav = document.getElementById('mobile-nav');
    nav.classList.toggle('open');
}
</script>

<script>
(function () {
    const PSGC = 'https://psgc.gitlab.io/api';
    const provinceEl = document.getElementById('psgc_province');
    const cityEl     = document.getElementById('psgc_city');
    const barangayEl = document.getElementById('psgc_barangay');
    const zipEl      = document.getElementById('zipCode');
    if (!provinceEl || !cityEl || !barangayEl) return;

    const PREFILL = {
        province: @json(old('province', '')),
        city:     @json(old('city', '')),
        barangay: @json(old('barangay', '')),
    };

    const lookupZipForCity = (cityName, cityCode) => {
        if (!zipEl) return;
        zipEl.value = ''; zipEl.classList.remove('is-valid','is-invalid');
        const errEl = document.getElementById('zipError'), okEl = document.getElementById('zipSuccess');
        if (errEl) errEl.classList.remove('show'); if (okEl) okEl.classList.remove('show');
        if (!cityName && !cityCode) return;
        fetch(`/zip-lookup?city_name=${encodeURIComponent(cityName||'')}&city_code=${encodeURIComponent(cityCode||'')}`)
            .then(r => r.json()).then(res => { if (res && typeof res.zip === 'string' && res.zip.trim()) { zipEl.value = res.zip.trim(); if (typeof validateZipCode === 'function') validateZipCode(zipEl); } }).catch(() => {});
    };

    const setOptions = (el, placeholder, items) => {
        el.innerHTML = `<option value="">${placeholder}</option>`;
        items.forEach(item => { const opt = document.createElement('option'); opt.value = item.name; opt.textContent = item.name; opt.dataset.code = item.code; el.appendChild(opt); });
    };
    const findOptionByValue = (el, value) => { const v = (value||'').toLowerCase(); if (!v) return null; return Array.from(el.options).find(o => (o.value||'').toLowerCase() === v) || null; };

    fetch(`${PSGC}/provinces/`).then(r => r.json()).then(data => {
        data.sort((a,b) => a.name.localeCompare(b.name));
        setOptions(provinceEl, 'Select Province', data);
        if (PREFILL.province) { const opt = findOptionByValue(provinceEl, PREFILL.province); if (opt) provinceEl.value = opt.value; }
        provinceEl.dispatchEvent(new Event('change'));
    }).catch(() => {});

    provinceEl.addEventListener('change', function () {
        const provCode = this.options[this.selectedIndex]?.dataset?.code;
        cityEl.disabled = true; barangayEl.disabled = true;
        cityEl.innerHTML = `<option value="">Select City</option>`;
        barangayEl.innerHTML = `<option value="">Select Barangay</option>`;
        if (!provCode) return;
        fetch(`${PSGC}/provinces/${provCode}/cities-municipalities/`).then(r => r.json()).then(data => {
            data.sort((a,b) => a.name.localeCompare(b.name));
            setOptions(cityEl, 'Select City', data); cityEl.disabled = false;
            if (PREFILL.city) { const opt = findOptionByValue(cityEl, PREFILL.city); if (opt) cityEl.value = opt.value; PREFILL.city = ''; }
            cityEl.dispatchEvent(new Event('change'));
        }).catch(() => {});
    });

    cityEl.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const cityCode = selected?.dataset?.code, cityName = selected?.value || '';
        barangayEl.disabled = true; barangayEl.innerHTML = `<option value="">Select Barangay</option>`;
        lookupZipForCity(cityName, cityCode || '');
        if (!cityCode) return;
        fetch(`${PSGC}/cities-municipalities/${cityCode}/barangays/`).then(r => r.json()).then(data => {
            data.sort((a,b) => a.name.localeCompare(b.name));
            setOptions(barangayEl, 'Select Barangay', data); barangayEl.disabled = false;
            if (PREFILL.barangay) { const opt = findOptionByValue(barangayEl, PREFILL.barangay); if (opt) barangayEl.value = opt.value; PREFILL.barangay = ''; }
        }).catch(() => {});
    });
})();
</script>
</body>
</html>