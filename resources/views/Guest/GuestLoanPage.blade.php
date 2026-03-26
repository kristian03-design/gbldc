<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GBLDC | Our Loan Products</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logocoop-removebg-preview-2.png') }}" sizes="512x512"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e588cb9d47.js" crossorigin="anonymous"></script>

  <style>
    /* ════════════════════ TOKENS ════════════════════ */
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
      --amber:      #059669; /* Slightly darker green-amber tone from landing page */
      --amber-soft: #34d399; /* Bright minty green from landing page */
      --amber-pale: #d1fae5;
      --white:      #ffffff;
      --shadow-sm:  0 2px 8px rgba(22,163,74,0.08);
      --shadow-md:  0 8px 24px rgba(22,163,74,0.12);
      --shadow-lg:  0 20px 48px rgba(22,163,74,0.14);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
      font-family: 'Syne', sans-serif;
      background: var(--canvas);
      color: var(--ink);
      overflow-x: hidden;
    }

    body::after {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23g)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 9998;
    }

    .display { font-family: 'Cormorant Garamond', serif; line-height: 1.05; letter-spacing: -0.01em; }
    .label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; color: var(--grove-mid); }

    /* ════════════════════ HEADER ════════════════════ */
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

    /* ════════════════════ HERO ════════════════════ */
    .hero {
      min-height: 80vh; padding-top: 68px;
      display: grid; grid-template-columns: 55% 45%;
      position: relative; overflow: hidden;
    }
    .hero-copy {
      background: var(--grove-mid);
      padding: 80px 60px 80px 80px;
      display: flex; flex-direction: column; justify-content: center;
      position: relative; overflow: hidden; z-index: 1;
    }
    .hero-copy::before {
      content: ''; position: absolute; bottom: -140px; left: -100px;
      width: 500px; height: 500px; border-radius: 50%;
      border: 1px solid rgba(196,217,188,0.15); pointer-events: none;
    }
    .hero-copy::after {
      content: ''; position: absolute; top: -80px; right: -80px;
      width: 320px; height: 320px; border-radius: 50%;
      border: 1px solid rgba(52,211,153,0.18); pointer-events: none;
    }
    .hero-copy .slant {
      position: absolute; top: 0; right: -1px; bottom: 0; width: 80px;
      background: var(--canvas);
      clip-path: polygon(100% 0, 100% 100%, 0 100%); z-index: 2;
    }
    .hero-eyebrow {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(52,211,153,0.18); border: 1px solid rgba(52,211,153,0.3);
      color: white; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.16em;
      text-transform: uppercase; padding: 0.38rem 0.9rem; border-radius: 4px;
      width: fit-content; margin-bottom: 2rem;
      animation: riseUp 0.7s ease both;
    }
    .hero-eyebrow .dot { width: 5px; height: 5px; border-radius: 50%; background: white; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1}50%{opacity:0.3} }

    .hero-h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(3rem, 5vw, 4.8rem); font-weight: 700;
      color: var(--white); line-height: 1.04; margin-bottom: 1.75rem;
      animation: riseUp 0.75s 0.1s ease both;
    }
    .hero-h1 em { font-style: italic; color: var(--amber-soft); display: block; }

    .hero-sub {
      font-size: 0.95rem; font-weight: 400; color: rgba(255,255,255,0.65);
      line-height: 1.8; max-width: 400px; margin-bottom: 2.5rem;
      animation: riseUp 0.75s 0.2s ease both;
    }
    .hero-btns { display: flex; gap: 12px; flex-wrap: wrap; animation: riseUp 0.75s 0.3s ease both; }

    .btn-cta {
      display: inline-flex; align-items: center; gap: 8px;
      background: whitesmoke; color: var(--grove-mid);
      font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; padding: 0.85rem 1.75rem; border-radius: 6px;
      text-decoration: none; border: none; cursor: pointer; font-family: 'Syne', sans-serif;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .btn-cta:hover { background: var(--grove-mid); color: var(--white); transform: translateY(-2px); box-shadow: 0 10px 28px rgba(52,211,153,0.32); }
    .btn-cta svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    .btn-outline {
      display: inline-flex; align-items: center; gap: 8px;
      background: transparent; color: rgba(255,255,255,0.75);
      font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; padding: 0.85rem 1.5rem; border-radius: 6px;
      text-decoration: none; border: 1px solid rgba(255,255,255,0.22); cursor: pointer;
      font-family: 'Syne', sans-serif; transition: all 0.2s;
    }
    .btn-outline:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.45); color: #fff; }
    .btn-outline svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

    .hero-image { position: relative; overflow: hidden; background: var(--parchment2); }
    .hero-image img { width: 100%; height: 100%; object-fit: cover; display: block; animation: heroZoom 20s infinite alternate ease-in-out; }
    @keyframes heroZoom { from{transform:scale(1)} to{transform:scale(1.06)} }

    @keyframes riseUp { from{opacity:0;transform:translateY(22px)} to{opacity:1;transform:translateY(0)} }

    @media (max-width: 1024px) {
      .hero { grid-template-columns: 1fr; }
      .hero-image { display: none; }
      .hero-copy { padding: 72px 2rem 64px; }
      .hero-copy .slant { display: none; }
    }
    @media (max-width: 640px) {
      .hero-btns { flex-direction: column; }
    }

    /* ════════════════════ SECTIONS ════════════════════ */
    .section { padding: 100px 0; }
    .container { max-width: 1180px; margin: 0 auto; padding: 0 2rem; }
    .sec-head { margin-bottom: 3.5rem; text-align: center; }
    .sec-head.left { text-align: left; }
    .sec-head .label { margin-bottom: 0.75rem; display: block; }
    .sec-title { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.2rem, 3.5vw, 3.4rem); font-weight: 700; color: var(--ink); line-height: 1.1; letter-spacing: -0.01em; }
    .sec-sub { margin-top: 0.75rem; font-size: 0.9rem; font-weight: 400; color: var(--ink-muted); line-height: 1.8; max-width: 500px; margin-left: auto; margin-right: auto; }
    .sec-head.left .sec-sub { margin-left: 0; margin-right: 0; max-width: 600px; }

    /* ════════════════════ SERVICES (LOAN TYPES) ════════════════════ */
    .services-bg { background: var(--parchment); }
    .services-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; }
    .s-card {
      background: var(--white); border: 1px solid rgba(22,163,74,0.1);
      border-radius: 16px; padding: 2.25rem 1.75rem 2rem;
      position: relative; overflow: hidden;
      transition: transform 0.35s cubic-bezier(.2,0,.2,1), box-shadow 0.35s;
      display: flex; flex-direction: column;
    }
    .s-card:nth-child(2), .s-card:nth-child(5) { margin-top: 1.75rem; }
    .s-card:nth-child(3), .s-card:nth-child(6) { margin-top: 3.5rem; }
    .s-card::after {
      content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(90deg, var(--grove-mid), var(--amber-soft));
      transform: scaleX(0); transform-origin: left; transition: transform 0.35s ease;
    }
    .s-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
    .s-card:hover::after { transform: scaleX(1); }
    .s-num { font-family: 'Cormorant Garamond', serif; font-size: 4rem; font-weight: 700; color: var(--grove-mid); line-height: 1; position: absolute; top: 1.25rem; right: 1.5rem; transition: color 0.35s; }
    .s-num:hover { color: var(--grove); }
    .s-card:hover .s-num { color: rgba(22,163,74,0.06); }
    .s-icon { width: 52px; height: 52px; border-radius: 12px; background: var(--parchment2); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; transition: background 0.35s; }
    .s-card:hover .s-icon { background: var(--grove); }
    .s-icon svg { width: 24px; height: 24px; stroke: var(--grove-mid); fill: none; stroke-width: 1.6; transition: stroke 0.35s; }
    .s-card:hover .s-icon svg { stroke: white; }
    .s-title { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 700; color: var(--ink); margin-bottom: 0.6rem; line-height: 1.2; }
    .s-desc { font-size: 0.875rem; color: var(--ink-muted); line-height: 1.75; margin-bottom: 1.5rem; font-weight: 400; flex: 1; }
    
    @media (max-width: 900px) { 
      .services-grid { grid-template-columns: repeat(2,1fr); } 
      .s-card:nth-child(n) { margin-top: 0; }
    }
    @media (max-width: 600px) { 
      .services-grid { grid-template-columns: 1fr; } 
    }

    /* ════════════════════ RATES SECTION ════════════════════ */
    .rates-bg { background: var(--canvas); }
    .rates-wrapper {
      background: var(--white);
      border: 1px solid rgba(22,163,74,0.12);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--shadow-md);
    }
    .rates-header {
      background: var(--ink);
      color: var(--white);
      padding: 1.5rem 2rem;
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .rates-header svg { width: 28px; height: 28px; stroke: var(--amber-soft); fill: none; }
    .rates-header h3 { font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; font-weight: 700; line-height: 1; }
    
    .rates-list { list-style: none; }
    .rate-item {
      display: flex; justify-content: space-between; align-items: center;
      padding: 1.5rem 2rem;
      border-bottom: 1px solid var(--parchment2);
      transition: background 0.2s;
    }
    .rate-item:last-child { border-bottom: none; }
    .rate-item:hover { background: var(--parchment2); }
    .rate-amount { font-size: 1.1rem; font-weight: 700; color: var(--ink); }
    .rate-value {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.8rem; font-weight: 700; color: var(--grove-mid);
      display: flex; align-items: baseline; gap: 4px;
    }
    .rate-value span { font-family: 'Syne', sans-serif; font-size: 0.8rem; font-weight: 600; color: var(--ink-muted); text-transform: uppercase; letter-spacing: 0.05em; }

    @media (max-width: 640px) {
      .rate-item { flex-direction: column; align-items: flex-start; gap: 0.5rem; }
    }


    /* ════════════════════ CTA STRIP ════════════════════ */
    .cta-strip {
      background: var(--grove-mid); padding: 80px 0; position: relative; overflow: hidden;
    }
    .cta-strip::before {
      content: ''; position: absolute; top: -150px; right: -100px;
      width: 450px; height: 450px; border-radius: 50%;
      border: 1px solid rgba(255,255,255,0.08); pointer-events: none;
    }
    .cta-strip::after {
      content: ''; position: absolute; bottom: -100px; left: -80px;
      width: 300px; height: 300px; border-radius: 50%;
      border: 1px solid rgba(52,211,153,0.18); pointer-events: none;
    }
    .cta-inner { position: relative; z-index: 1; text-align: center; }
    .cta-inner .label { color: var(--amber-soft); margin-bottom: 1rem; display: block; }
    .cta-h { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.2rem, 4vw, 3.6rem); font-weight: 700; color: #fff; line-height: 1.08; margin-bottom: 1rem; }
    .cta-h em { font-style: italic; color: var(--amber-soft); }
    .cta-sub { font-size: 0.92rem; color: rgba(255,255,255,0.6); max-width: 460px; margin: 0 auto 2.25rem; line-height: 1.75; }
    .cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
    .btn-cta-white {
      display: inline-flex; align-items: center; gap: 8px;
      background: #fff; color: var(--grove-mid);
      font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; padding: 0.9rem 2rem; border-radius: 6px;
      text-decoration: none; font-family: 'Syne', sans-serif;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .btn-cta-white:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,0,0.15); }
    .btn-cta-white svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    /* ════════════════════ FOOTER ════════════════════ */
    footer { background: #0d1f10; padding: 64px 0 28px; border-top: 4px solid var(--grove); }
    .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; }
    .f-brand .logo-name { color: #fff; font-size: 1.25rem; }
    .f-tagline { font-size: 0.83rem; color: rgba(255,255,255,0.4); line-height: 1.75; margin: 1rem 0 1.5rem; }
    .f-socials { display: flex; gap: 8px; }
    .f-social { width: 34px; height: 34px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.4); text-decoration: none; transition: all 0.2s; }
    .f-social:hover { background: var(--grove); border-color: var(--grove); color: #fff; }
    .f-social svg { width: 14px; height: 14px; stroke: currentColor; fill: none; }
    .f-col h5 { font-size: 0.68rem; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; color: whitesmoke; margin-bottom: 1.25rem; }
    .f-col ul { list-style: none; }
    .f-col ul li { margin-bottom: 0.55rem; }
    .f-col ul li a { font-size: 0.83rem; color: rgba(255,255,255,0.4); text-decoration: none; transition: color 0.2s; }
    .f-col ul li a:hover { color: var(--moss); }
    .f-bottom { border-top: 1px solid rgba(255,255,255,0.06); padding-top: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
    .f-copy { font-size: 0.85rem; color: rgba(255,255,255,0.25); }
    .f-legal { display: flex; gap: 1.5rem; }
    .f-legal a { font-size: 0.85rem; color: rgba(255,255,255,0.25); text-decoration: none; transition: color 0.2s; }
    .f-legal a:hover { color: rgba(255,255,255,0.55); }
    @media (max-width: 1024px) { .footer-grid { grid-template-columns: 1fr 1fr; gap: 2rem; } }
    @media (max-width: 640px) { .footer-grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<!-- ═══════════ HEADER ═══════════ -->
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
        <a href="{{ route('Guest.AboutUs') }}">About GBLDC</a>
        <a href="{{ route('Under.Construction') }}">Board of Directors</a>
        <a href="{{ route('Under.Construction') }}">Committee Officers</a>
      </div>
    </div>

    <a href="{{ route('Guest.NewsEvents') }}">News &amp; Events</a>
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
      <a href="{{ route('Under.Construction') }}">Deposits</a>
      <a href="{{ route('Under.Construction') }}">Savings</a>
    </div>
  </div>
  <div class="mobile-nav-group">
    <button onclick="this.nextElementSibling.classList.toggle('open')">About</button>
    <div class="mobile-sub">
      <a href="{{ route('Guest.AboutUs') }}">About GBLDC</a>
      <a href="{{ route('Under.Construction') }}">Board of Directors</a>
      <a href="{{ route('Under.Construction') }}">Committee Officers</a>
    </div>
  </div>
  <a href="{{ route('Guest.NewsEvents') }}">News &amp; Events</a>
  <div class="mobile-divider"></div>
  <a href="{{ route('Member.Login') }}" class="mobile-login">Login to Member Portal</a>
</div>

<!-- ═══════════ HERO ═══════════ -->
<section class="hero">
  <div class="hero-copy">
    <div class="hero-eyebrow"><span class="dot"></span> Flexible Financial Solutions</div>
    <h1 class="hero-h1">
      Empower Your<br>
      <em>Dreams</em>
      with GBLDC Loans
    </h1>
    <p class="hero-sub">
      Whether you are starting a business, renovating your home, or facing an emergency, our cooperative provides accessible and affordable loan products tailored just for you.
    </p>
    <div class="hero-btns">
      <a href="{{ route('Registration.form1') }}" class="btn-cta">
        Become a Member
        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
      <a href="#products" class="btn-outline">
        View Products
        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" transform="rotate(90 12 12)"/></svg>
      </a>
    </div>
    <div class="slant" aria-hidden="true"></div>
  </div>
  <div class="hero-image">
    <img src="{{ asset('images/meeting-3.png') }}" alt="GBLDC Community Meeting">
  </div>
</section>

<!-- ═══════════ LOAN PRODUCTS ═══════════ -->
<section id="products" class="section services-bg">
  <div class="container">
    <div class="sec-head">
      <span class="label">Comprehensive Options</span>
      <h2 class="sec-title display">Our Loan Products</h2>
      <p class="sec-sub">We offer a highly diverse range of financial products to help support our members through every stage of their life and entrepreneurial journey.</p>
    </div>
    
    <div class="services-grid">
      <!-- 1 -->
      <div class="s-card">
        <span class="s-num">01</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h3 class="s-title">Personal Loan</h3>
        <p class="s-desc">Flexible funds designed for personal use, whether it's for purchasing appliances, travel, or other individual needs.</p>
      </div>
      <!-- 2 -->
      <div class="s-card">
        <span class="s-num">02</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
        </div>
        <h3 class="s-title">Business Loan</h3>
        <p class="s-desc">Capital specifically dedicated to help you start a new venture or expand your current enterprise and operations.</p>
      </div>
      <!-- 3 -->
      <div class="s-card">
        <span class="s-num">03</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <h3 class="s-title">Mortgage / Housing</h3>
        <p class="s-desc">Get the structured financial support you need to make your dream home a reality.</p>
      </div>
      <!-- 4 -->
      <div class="s-card">
        <span class="s-num">04</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M14 16H9m10 0h3v-3.15a1 1 0 0 0-.84-.99L16 11l-2.7-3.6a2 2 0 0 0-1.6-.8H6.5a2 2 0 0 0-2 2v2.5M3 16h2m-2 0v-2.5m10-4.5H6.5"/><circle cx="7" cy="16.5" r="2.5"/><circle cx="16.5" cy="16.5" r="2.5"/></svg>
        </div>
        <h3 class="s-title">Auto Loan</h3>
        <p class="s-desc">Fast-track the purchase of your personal or business vehicle with our competitive auto financing.</p>
      </div>
      <!-- 5 -->
      <div class="s-card">
        <span class="s-num">05</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        </div>
        <h3 class="s-title">Educational Loan</h3>
        <p class="s-desc">Invest heavily in the future by securing tuition and allowance support for you or your dependents.</p>
      </div>
      <!-- 6 -->
      <div class="s-card">
        <span class="s-num">06</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <h3 class="s-title">Emergency Loan</h3>
        <p class="s-desc">Quick cash disbursement designed to help you cover unexpected medical or urgent financial situations.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ RATES AND TIERS ═══════════ -->
<section class="section rates-bg">
  <div class="container">
    <div class="sec-head left">
      <span class="label">Fair & Transparent</span>
      <h2 class="sec-title display">Competitive Interest Rates</h2>
      <p class="sec-sub">At GBLDC, we believe in equitable financial growth. Our interest rates are compounded monthly and are tiered progressively based on the principal amount of your loan.</p>
    </div>

    <div class="rates-wrapper">
      <div class="rates-header">
        <svg viewBox="0 0 24 24"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        <h3>Annual Interest Rates</h3>
      </div>
      <ul class="rates-list">
        <li class="rate-item">
          <div class="rate-amount">Loans up to ₱ 50,000</div>
          <div class="rate-value">8% <span>p.a.</span></div>
        </li>
        <li class="rate-item">
          <div class="rate-amount">₱ 50,001 to ₱ 150,000</div>
          <div class="rate-value">10% <span>p.a.</span></div>
        </li>
        <li class="rate-item">
          <div class="rate-amount">₱ 150,001 to ₱ 500,000</div>
          <div class="rate-value">12% <span>p.a.</span></div>
        </li>
        <li class="rate-item">
          <div class="rate-amount">₱ 500,001 to ₱ 2,000,000</div>
          <div class="rate-value">14% <span>p.a.</span></div>
        </li>
        <li class="rate-item">
          <div class="rate-amount">Above ₱ 2,000,000</div>
          <div class="rate-value">16% <span>p.a.</span></div>
        </li>
      </ul>
    </div>
  </div>
</section>

<!-- ═══════════ CTA STRIP ═══════════ -->
<section class="cta-strip">
  <div class="container">
    <div class="cta-inner">
      <span class="label">Take the Next Step</span>
      <h2 class="cta-h">Ready to finance your<br><em>future goals?</em></h2>
      <p class="cta-sub">Become a member of GBLDC today to gain full access to our cooperative loan services and take control of your financial journey.</p>
      <div class="cta-btns">
        <a href="{{ route('Registration.form1') }}" class="btn-cta-white">
          Apply for Membership
          <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ FOOTER ═══════════ -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="f-brand">
        <a href="{{ route('Landing.Page') }}" class="logo" style="margin-bottom:0.5rem;">
          <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo" style="width:40px;height:40px;padding:5px;">
          <span class="logo-name">GBLDC</span>
        </a>
        <p class="f-tagline">Greater Bulacan Livelihood Development Cooperative — empowering communities through cooperative financial services.</p>
        <div class="f-socials">
          <a href="https://www.facebook.com/profile.php?id=100067957008092" class="f-social"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="#" class="f-social"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
        </div>
      </div>
      <div class="f-col">
        <h5>Services</h5>
        <ul>
          <li><a href="{{ route('Guest.Loans') }}">Loan Services</a></li>
          <li><a href="{{ route('Under.Construction') }}">Deposit Services</a></li>
          <li><a href="{{ route('Under.Construction') }}">Savings Services</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>About</h5>
        <ul>
          <li><a href="{{ route('Guest.AboutUs') }}">About GBLDC</a></li>
          <li><a href="{{ route('Under.Construction') }}">Senior Management</a></li>
          <li><a href="{{ route('Under.Construction') }}">Officers &amp; Committees</a></li>
          <li><a href="{{ route('Under.Construction') }}">About Membership</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="https://ifernglobal.com.ph/" target="_blank">iFern Global</a></li>
          <li><a href="{{ route('Member.Login') }}">Member Portal Login</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="{{ route('Registration.form1') }}">Apply Now</a></li>
        </ul>
      </div>
    </div>
    <div class="f-bottom">
      <span class="f-copy">© {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative. All rights reserved.</span>
      <div class="f-legal">
        <a href="{{ route('Guest.Policies') }}#privacy">Privacy Policy</a>
        <a href="{{ route('Guest.Policies') }}#terms">Terms of Service</a>
        <a href="{{ route('Guest.Policies') }}#cookies">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>

<script>
  function toggleMobileNav() {
    document.getElementById('mobile-nav').classList.toggle('open');
  }
</script>
<!-- ═══════════ COOKIE CONSENT ═══════════ -->
<div class="cookie-banner" id="cookieBanner">
  <div class="cb-content">
    <div class="cb-icon">
      <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div class="cb-text">
      <h4>We Value Your Privacy</h4>
      <p>GBLDC uses cookies to ensure you get the best experience on our cooperative portal. By continuing to use our site, you agree to our <a href="{{ route('Guest.Policies') }}#cookies">Cookie Policy</a>.</p>
    </div>
  </div>
  <div class="cb-actions">
    <button class="cb-btn cb-accept" onclick="acceptCookies()">Accept All</button>
    <button class="cb-btn cb-decline" onclick="declineCookies()">Decline</button>
  </div>
</div>

<style>
/* ════════════════════ COOKIE CONSENT BANNER ════════════════════ */
.cookie-banner {
  position: fixed; bottom: 1.5rem; left: 1.5rem; z-index: 9999;
  max-width: 440px; background: var(--white, #ffffff);
  border: 1px solid rgba(22, 163, 74, 0.15); border-radius: 16px;
  box-shadow: 0 12px 36px rgba(0, 0, 0, 0.12);
  padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem;
  transform: translateY(150%); opacity: 0; visibility: hidden;
  transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), opacity 0.6s ease, visibility 0.6s;
}
.cookie-banner.show { transform: translateY(0); opacity: 1; visibility: visible; }
.cb-content { display: flex; gap: 1rem; align-items: flex-start; }
.cb-icon {
  width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
  background: var(--moss, #dcfce7); color: var(--grove-mid, #15803d);
  display: flex; align-items: center; justify-content: center;
}
.cb-icon svg { width: 22px; height: 22px; stroke: currentColor; fill: none; stroke-width: 2; }
.cb-text h4 { font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--ink, #1a2e1e); margin-bottom: 0.35rem; }
.cb-text p { font-size: 0.82rem; color: var(--ink-muted, #4a6b4f); line-height: 1.6; }
.cb-text a { color: var(--grove, #16a34a); font-weight: 600; text-decoration: underline; text-underline-offset: 3px; }
.cb-actions { display: flex; gap: 0.75rem; justify-content: flex-end; }
.cb-btn {
  padding: 0.65rem 1.25rem; border-radius: 8px; font-family: 'Syne', sans-serif;
  font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
}
.cb-accept { background: var(--grove, #16a34a); color: #fff; border: none; }
.cb-accept:hover { background: var(--grove-mid, #15803d); transform: translateY(-1px); }
.cb-decline { background: transparent; color: var(--ink-soft, #2d4a32); border: 1px solid rgba(22, 163, 74, 0.25); }
.cb-decline:hover { background: var(--parchment2, #f0f7f1); }
@media (max-width: 600px) {
  .cookie-banner { bottom: 1rem; left: 1rem; right: 1rem; max-width: none; }
  .cb-actions { flex-direction: column; }
  .cb-btn { width: 100%; }
}
</style>

<script>
/* ════════════════════ COOKIE CONSENT LOGIC ════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  const cb = document.getElementById('cookieBanner');
  if (!localStorage.getItem('gbldc_cookie_consent')) {
    setTimeout(() => { cb.classList.add('show'); }, 1500);
  }
});
function acceptCookies() {
  localStorage.setItem('gbldc_cookie_consent', 'accepted');
  document.getElementById('cookieBanner').classList.remove('show');
}
function declineCookies() {
  localStorage.setItem('gbldc_cookie_consent', 'declined');
  document.getElementById('cookieBanner').classList.remove('show');
}
</script>
</body>
</html>
