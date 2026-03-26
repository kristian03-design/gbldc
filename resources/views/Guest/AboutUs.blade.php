<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GBLDC | About Us</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logocoop-removebg-preview-2.png') }}" sizes="512x512"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e588cb9d47.js" crossorigin="anonymous"></script>

  <style>
    /* ════════════════════ TOKENS & BASE ════════════════════ */
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
      --amber:      #059669;
      --amber-soft: #34d399;
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
      content: ''; position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23g)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 9998;
    }

    .display { font-family: 'Cormorant Garamond', serif; line-height: 1.05; letter-spacing: -0.01em; }
    .label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; color: var(--grove-mid); }

    /* ════════════════════ HEADER ════════════════════ */
    header {
      position: fixed; top: 0; left: 0; right: 0; z-index: 200;
      height: 68px; display: flex; align-items: center; justify-content: space-between;
      padding: 0 2.5rem; background: rgba(245,250,246,0.94);
      backdrop-filter: blur(18px) saturate(1.4);
      border-bottom: 1px solid rgba(22,163,74,0.12);
    }
    .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; flex-shrink: 0; }
    .logo img { width: 46px; height: 46px; overflow: hidden; padding: 4px; flex-shrink: 0; }
    .logo-name { font-family: 'Cormorant Garamond', serif; font-size: 1.25rem; font-weight: 700; color: var(--grove); letter-spacing: 0.04em; }

    .nav-desktop { display: flex; align-items: center; gap: 0; }
    .nav-desktop a, .nav-desktop .dd-trigger {
      font-size: 0.78rem; font-weight: 600; letter-spacing: 0.06em;
      color: var(--ink-soft); text-decoration: none; padding: 0.45rem 0.9rem; border-radius: 6px;
      background: none; border: none; cursor: pointer; font-family: 'Syne', sans-serif;
      display: flex; align-items: center; gap: 4px; transition: color 0.2s, background 0.2s; white-space: nowrap;
    }
    .nav-desktop a:hover, .nav-desktop .dd-trigger:hover { color: var(--grove); background: rgba(22,163,74,0.08); }

    .dd-wrap { position: relative; }
    .dd-panel {
      position: absolute; top: calc(100% + 6px); left: 0; min-width: 190px;
      background: var(--white); border: 1px solid rgba(22,163,74,0.12); border-radius: 12px;
      padding: 0.35rem; box-shadow: var(--shadow-md); opacity: 0; visibility: hidden;
      transform: translateY(6px); transition: all 0.2s ease;
    }
    .dd-wrap:hover .dd-panel { opacity: 1; visibility: visible; transform: none; }
    .dd-panel a {
      display: block; font-size: 0.78rem; font-weight: 500; letter-spacing: 0.04em;
      color: var(--ink-soft); text-decoration: none; padding: 0.55rem 0.85rem; border-radius: 8px;
      transition: background 0.15s, color 0.15s;
    }
    .dd-panel a:hover { background: var(--parchment2); color: var(--grove); }

    .btn-login-header {
      display: inline-flex; align-items: center; gap: 7px; background: var(--grove); color: #fff;
      font-size: 0.76rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
      padding: 0.52rem 1.4rem; border-radius: 99px; text-decoration: none; border: none; cursor: pointer;
      font-family: 'Syne', sans-serif; transition: background 0.2s, transform 0.15s;
      box-shadow: 0 3px 10px rgba(22,163,74,0.25);
    }
    .btn-login-header:hover { background: var(--grove-mid); transform: translateY(-1px); }

    .ham-btn { display: none; width: 40px; height: 40px; border-radius: 8px; border: 1px solid rgba(22,163,74,0.18); background: none; cursor: pointer; align-items: center; justify-content: center; color: var(--ink); }
    .ham-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; }

    .mobile-nav { display: none; flex-direction: column; gap: 2px; position: fixed; inset: 68px 0 0; background: var(--canvas); padding: 1.25rem; overflow-y: auto; z-index: 199; }
    .mobile-nav.open { display: flex; }
    .mobile-nav a, .mobile-nav-group > button {
      display: block; width: 100%; text-align: left; padding: 0.7rem 1rem; border-radius: 10px;
      font-size: 0.9rem; font-weight: 600; letter-spacing: 0.04em; color: var(--ink-soft); text-decoration: none;
      background: none; border: none; cursor: pointer; font-family: 'Syne', sans-serif; transition: background 0.15s, color 0.15s;
    }
    .mobile-nav a:hover, .mobile-nav-group > button:hover { background: var(--parchment2); color: var(--grove); }
    .mobile-sub { display: none; padding-left: 1rem; }
    .mobile-sub.open { display: block; }
    .mobile-sub a { font-size: 0.83rem; }
    .mobile-divider { height: 1px; background: var(--parchment2); margin: 0.5rem 0; }
    .mobile-login { margin-top: 0.5rem; padding: 0.75rem 1rem; background: var(--grove); color: #fff; border-radius: 10px; font-size: 0.88rem; font-weight: 700; text-decoration: none; text-align: center; letter-spacing: 0.06em; font-family: 'Syne', sans-serif; }

    @media (max-width: 1024px) { .nav-desktop { display: none; } .btn-login-header { display: none; } .ham-btn { display: flex; } }

    /* ════════════════════ HERO ════════════════════ */
    .hero { min-height: 70vh; padding-top: 68px; display: grid; grid-template-columns: 55% 45%; position: relative; overflow: hidden; background: var(--grove-mid); }
    .hero-copy { background: var(--grove-mid); padding: 80px 60px 80px 80px; display: flex; flex-direction: column; justify-content: center; position: relative; overflow: hidden; z-index: 1; }
    .hero-copy::before { content: ''; position: absolute; bottom: -140px; left: -100px; width: 500px; height: 500px; border-radius: 50%; border: 1px solid rgba(196,217,188,0.15); pointer-events: none; }
    .hero-copy::after { content: ''; position: absolute; top: -80px; right: -80px; width: 320px; height: 320px; border-radius: 50%; border: 1px solid rgba(52,211,153,0.18); pointer-events: none; }
    .hero-copy .slant { position: absolute; top: 0; right: -1px; bottom: 0; width: 80px; background: var(--canvas); clip-path: polygon(100% 0, 100% 100%, 0 100%); z-index: 2; }
    
    .hero-eyebrow { display: inline-flex; align-items: center; gap: 8px; background: rgba(52,211,153,0.18); border: 1px solid rgba(52,211,153,0.3); color: white; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; padding: 0.38rem 0.9rem; border-radius: 4px; width: fit-content; margin-bottom: 2rem; animation: riseUp 0.7s ease both; }
    .hero-eyebrow .dot { width: 5px; height: 5px; border-radius: 50%; background: white; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1}50%{opacity:0.3} }

    .hero-h1 { font-family: 'Cormorant Garamond', serif; font-size: clamp(3rem, 4.5vw, 4.8rem); font-weight: 700; color: var(--white); line-height: 1.04; margin-bottom: 1.75rem; animation: riseUp 0.75s 0.1s ease both; }
    .hero-h1 em { font-style: italic; color: var(--amber-soft); display: block; }
    .hero-sub { font-size: 0.95rem; font-weight: 400; color: rgba(255,255,255,0.65); line-height: 1.8; max-width: 440px; margin-bottom: 2.5rem; animation: riseUp 0.75s 0.2s ease both; }
    .hero-image { position: relative; overflow: hidden; background: var(--parchment2); }
    .hero-image img { width: 100%; height: 100%; object-fit: cover; display: block; animation: heroZoom 20s infinite alternate ease-in-out; }
    @keyframes heroZoom { from{transform:scale(1)} to{transform:scale(1.06)} }
    @keyframes riseUp { from{opacity:0;transform:translateY(22px)} to{opacity:1;transform:translateY(0)} }
    @media (max-width: 1024px) { .hero { grid-template-columns: 1fr; } .hero-image { display: none; } .hero-copy { padding: 72px 2rem 64px; } .hero-copy .slant { display: none; } }

    /* ════════════════════ SECTIONS ════════════════════ */
    .section { padding: 80px 0; }
    .container { max-width: 1180px; margin: 0 auto; padding: 0 2rem; }
    .sec-head { margin-bottom: 3.5rem; }
    .sec-head .label { margin-bottom: 0.75rem; display: block; }
    .sec-title { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.2rem, 3.5vw, 3.4rem); font-weight: 700; color: var(--ink); line-height: 1.1; letter-spacing: -0.01em; margin-bottom: 1.25rem; }
    .sec-sub { font-size: 0.95rem; font-weight: 400; color: var(--ink-muted); line-height: 1.8; max-width: 600px; }
    .sec-head-center { text-align: center; }
    .sec-head-center .sec-sub { margin-left: auto; margin-right: auto; }

    /* WHO WE ARE */
    .who-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
    .who-img { width: 100%; border-radius: 16px; object-fit: cover; box-shadow: var(--shadow-lg); transition: transform 0.3s; }
    .who-img:hover { transform: translateY(-5px); }
    @media(max-width: 800px) { .who-grid { grid-template-columns: 1fr; gap: 2.5rem; } }

    /* MISSION VISION */
    .mv-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .mv-card { background: var(--white); border: 1px solid rgba(22,163,74,0.1); border-radius: 16px; padding: 3rem 2.5rem; transition: transform 0.3s, box-shadow 0.3s; }
    .mv-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-md); border-color: rgba(22,163,74,0.25); }
    .mv-icon { width: 60px; height: 60px; border-radius: 14px; background: var(--parchment2); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--grove-mid); }
    .mv-icon svg { width: 28px; height: 28px; stroke: currentColor; fill: none; stroke-width: 1.8; }
    .mv-title { font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; font-weight: 700; color: var(--ink); margin-bottom: 1rem; }
    .mv-desc { font-size: 0.92rem; color: var(--ink-muted); line-height: 1.7; }
    @media(max-width: 800px) { .mv-grid { grid-template-columns: 1fr; } }

    /* HOW IT WORKS */
    .steps-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .step-card { background: var(--canvas); border-radius: 16px; padding: 2rem 1.5rem; border: 1px solid rgba(22,163,74,0.06); transition: all 0.3s; text-align: center; }
    .step-card:hover { background: var(--white); border-color: var(--grove-light); box-shadow: var(--shadow-sm); transform: translateY(-4px); }
    .step-num { width: 44px; height: 44px; border-radius: 50%; background: var(--grove); color: #fff; display: flex; align-items: center; justify-content: center; font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; font-weight: 700; margin: 0 auto 1.25rem; }
    .step-title { font-size: 1.05rem; font-weight: 700; color: var(--ink); margin-bottom: 0.75rem; font-family: 'Cormorant Garamond', serif; }
    .step-desc { font-size: 0.85rem; color: var(--ink-muted); line-height: 1.6; }
    @media(max-width: 900px) { .steps-grid { grid-template-columns: repeat(2, 1fr); } }
    @media(max-width: 500px) { .steps-grid { grid-template-columns: 1fr; } }

    /* SERVICES (REUSED FROM LANDING) */
    .services-bg { background: var(--white); }
    .services-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; }
    .s-card { background: var(--canvas); border: 1px solid rgba(22,163,74,0.1); border-radius: 16px; padding: 2.25rem 1.75rem 2rem; position: relative; overflow: hidden; transition: transform 0.35s, box-shadow 0.35s; }
    .s-card::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--grove-mid), var(--amber-soft)); transform: scaleX(0); transform-origin: left; transition: transform 0.35s ease; }
    .s-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); background: var(--white); }
    .s-card:hover::after { transform: scaleX(1); }
    .s-num { font-family: 'Cormorant Garamond', serif; font-size: 4rem; font-weight: 700; color: var(--grove-mid); line-height: 1; position: absolute; top: 1.25rem; right: 1.5rem; transition: color 0.35s; }
    .s-card:hover .s-num { color: rgba(22,163,74,0.06); }
    .s-icon { width: 52px; height: 52px; border-radius: 12px; background: var(--parchment2); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; transition: background 0.35s; }
    .s-card:hover .s-icon { background: var(--grove); }
    .s-icon svg { width: 24px; height: 24px; stroke: var(--grove-mid); fill: none; stroke-width: 1.6; transition: stroke 0.35s; }
    .s-card:hover .s-icon svg { stroke: white; }
    .s-title { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 700; color: var(--ink); margin-bottom: 0.6rem; line-height: 1.2; }
    .s-desc { font-size: 0.875rem; color: var(--ink-muted); line-height: 1.75; margin-bottom: 1.5rem; font-weight: 400; }
    @media (max-width: 900px) { .services-grid { grid-template-columns: 1fr; } }
    .s-link { display: inline-flex; align-items: center; gap: 6px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--grove-mid); text-decoration: none; transition: gap 0.2s, color 0.2s; }
    .s-link:hover { gap: 10px; color: var(--grove); }
    .s-link svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2.5; }


    /* WHY CHOOSE US */
    .features-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    .f-item { display: flex; align-items: flex-start; gap: 1rem; padding: 1.5rem; background: var(--white); border-radius: 12px; border: 1px solid rgba(22,163,74,0.08); transition: box-shadow 0.2s, transform 0.2s; }
    .f-item:hover { box-shadow: var(--shadow-sm); transform: translateY(-2px); border-color: rgba(22,163,74,0.2); }
    .f-icon { width: 36px; height: 36px; border-radius: 8px; background: var(--grove); color: #fff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .f-icon svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; }
    .f-text h4 { font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.25rem; color: var(--ink); }
    .f-text p { font-size: 0.85rem; color: var(--ink-muted); line-height: 1.6; }
    @media(max-width: 640px) { .features-grid { grid-template-columns: 1fr; } }

    /* ════════════════════ CTA STRIP ════════════════════ */
    .cta-strip { background: var(--grove-mid); padding: 80px 0; position: relative; overflow: hidden; }
    .cta-strip::before { content: ''; position: absolute; top: -150px; right: -100px; width: 450px; height: 450px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.08); pointer-events: none; }
    .cta-strip::after { content: ''; position: absolute; bottom: -100px; left: -80px; width: 300px; height: 300px; border-radius: 50%; border: 1px solid rgba(52,211,153,0.18); pointer-events: none; }
    .cta-inner { position: relative; z-index: 1; text-align: center; }
    .cta-inner .label { color: var(--amber-soft); margin-bottom: 1rem; display: block; }
    .cta-h { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.2rem, 4vw, 3.6rem); font-weight: 700; color: #fff; line-height: 1.08; margin-bottom: 1rem; }
    .cta-h em { font-style: italic; color: var(--amber-soft); }
    .cta-sub { font-size: 0.92rem; color: rgba(255,255,255,0.6); max-width: 460px; margin: 0 auto 2.25rem; line-height: 1.75; }
    .cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
    .btn-cta-white { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: var(--grove-mid); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.9rem 2rem; border-radius: 6px; text-decoration: none; font-family: 'Syne', sans-serif; transition: background 0.2s, transform 0.15s, box-shadow 0.2s; }
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
    <div class="hero-eyebrow"><span class="dot"></span> About GBLDC</div>
    <h1 class="hero-h1">
      Empowering Communities,<br>
      <em>Building Better Futures</em>
    </h1>
    <p class="hero-sub">
      Greater Bulacan Livelihood Development Cooperative (GBLDC) is dedicated to your financial stability and genuine community growth.
    </p>
    <div class="slant" aria-hidden="true"></div>
  </div>
  <div class="hero-image">
    <!-- Using a generic meeting image as placeholder for cooperative identity -->
    <img src="{{ asset('images/meeting-3.png') }}" alt="GBLDC Office & Community">
  </div>
</section>

<!-- ═══════════ WHO WE ARE ═══════════ -->
<section class="section">
  <div class="container who-grid">
    <div>
      <span class="label">Our Identity</span>
      <h2 class="sec-title display">Who We Are</h2>
      <p class="sec-sub" style="margin-bottom: 1.5rem; max-width: 100%;">
        <strong>Greater Bulacan Livelihood Development Cooperative (GBLDC)</strong> is a community-driven cooperative based in the province of Bulacan, Philippines. Founded on the principles of trust, integrity, and shared prosperity, our organization provides a strong foundation for local economic growth.
      </p>
      <p class="sec-sub" style="max-width: 100%;">
        We focus heavily on financial empowerment by providing accessible, reliable, and equitable financial services—spanning tailored loan products, safe savings options, and an engaging membership program. By helping our members sustainably improve their livelihood and financial stability, we build a brighter tomorrow for every family we serve.
      </p>
    </div>
    <div>
      <img src="{{ asset('images/meeting-1.png') }}" alt="Community gathered" class="who-img">
    </div>
  </div>
</section>

<!-- ═══════════ MISSION & VISION ═══════════ -->
<section class="section" style="background: var(--canvas);">
  <div class="container">
    <div class="sec-head sec-head-center">
      <span class="label">Our Purpose</span>
      <h2 class="sec-title display">Mission and Vision</h2>
      <p class="sec-sub">Guiding principles that steer our cooperative toward continued success and impact.</p>
    </div>
    <div class="mv-grid">
      <div class="mv-card">
        <div class="mv-icon">
          <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3 class="mv-title">Our Mission</h3>
        <p class="mv-desc">To help every member achieve authentic financial growth and stability. We consistently deliver reliable, competitive, and personalized cooperative solutions that uplift families, support entrepreneurship, and improve overall livelihoods.</p>
      </div>
      <div class="mv-card">
        <div class="mv-icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <h3 class="mv-title">Our Vision</h3>
        <p class="mv-desc">To become a trusted, premier cooperative in Bulacan and beyond—recognized widely for transforming lives, pioneering sustainable economic programs, and building powerfully united communities.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ OUR SERVICES ═══════════ -->
<section class="section services-bg">
  <div class="container">
    <div class="sec-head sec-head-center">
      <span class="label">Financial Excellence</span>
      <h2 class="sec-title display">Our Core Services</h2>
      <p class="sec-sub">Tailored to provide our members with the capital and tools they need to secure a prosperous future.</p>
    </div>
    <div class="services-grid">
      <div class="s-card">
        <span class="s-num">01</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h3 class="s-title">Membership Program</h3>
        <p class="s-desc">Join our growing cooperative. As a member, you share in our success and receive extensive benefits, voting rights, and priority access to all our services.</p>
        <a href="{{ route('Registration.form1') }}" class="s-link">Learn More <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>
      <div class="s-card">
        <span class="s-num">02</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3" stroke-linecap="round"/></svg>
        </div>
        <h3 class="s-title">Loan Services</h3>
        <p class="s-desc">Access diverse and competitive loan options tailored for personal emergencies, productive business ventures, or housing and vehicle acquisitions.</p>
        <a href="{{ route('Guest.Loans') }}" class="s-link">Learn More <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>
      <div class="s-card">
        <span class="s-num">03</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div>
        <h3 class="s-title">Savings & Investment</h3>
        <p class="s-desc">Secure your hard-earned funds with confidence. We offer reliable savings and time deposit accounts with higher interest rates than traditional banks.</p>
        <a href="{{ route('Under.Construction') }}" class="s-link">Learn More <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ HOW IT WORKS ═══════════ -->
<section class="section" style="background: var(--canvas);">
  <div class="container">
    <div class="sec-head">
      <span class="label">Simple Process</span>
      <h2 class="sec-title display">How It Works</h2>
      <p class="sec-sub">We've designed a straightforward and transparent process for you to easily join and start leveraging our cooperative benefits immediately.</p>
    </div>
    <div class="steps-grid">
      <div class="step-card">
        <div class="step-num">1</div>
        <h4 class="step-title">Apply for Membership</h4>
        <p class="step-desc">Fill out our quick registration form online or visit our office to express your interest in joining the GBLDC community.</p>
      </div>
      <div class="step-card">
        <div class="step-num">2</div>
        <h4 class="step-title">Pay Shared Capital</h4>
        <p class="step-desc">Deposit your initial shared capital contribution (e.g., 50 shares = ₱5,000) to officially stake your claim in the cooperative.</p>
      </div>
      <div class="step-card">
        <div class="step-num">3</div>
        <h4 class="step-title">Admin Approval</h4>
        <p class="step-desc">Our administrative team will rapidly review your application and background to ensure you meet all membership standards.</p>
      </div>
      <div class="step-card">
        <div class="step-num">4</div>
        <h4 class="step-title">Access Services</h4>
        <p class="step-desc">Once fully approved, log in via your member dashboard to access exclusive loan services and track your monthly contributions.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ WHY CHOOSE US ═══════════ -->
<section class="section">
  <div class="container">
    <div class="sec-head sec-head-center">
      <span class="label">Discover the Difference</span>
      <h2 class="sec-title display">Why Choose Us</h2>
      <p class="sec-sub">GBLDC continually strives to embody cooperative values in every interaction.</p>
    </div>
    <div class="features-grid">
      <div class="f-item">
        <div class="f-icon"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg></div>
        <div class="f-text">
          <h4>Trusted Cooperative</h4>
          <p>We are a fully CDA Registered entity with decades of combined management experience, trusted by over a hundred active members.</p>
        </div>
      </div>
      <div class="f-item">
        <div class="f-icon"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
        <div class="f-text">
          <h4>Community-Driven</h4>
          <p>Every policy we implement and service we deploy is shaped with our members' financial health and the broader Bulacan community in mind.</p>
        </div>
      </div>
      <div class="f-item">
        <div class="f-icon"><svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
        <div class="f-text">
          <h4>Easy &amp; Transparent</h4>
          <p>No hidden fees or complicated jargon. We guarantee total transparency in our tiered interest rates and straightforward application procedures.</p>
        </div>
      </div>
      <div class="f-item">
        <div class="f-icon"><svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
        <div class="f-text">
          <h4>Secure &amp; Reliable System</h4>
          <p>Our online portals are protected by strong encryption. We carefully safeguard your Identity Data and all financial transactions.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ CTA STRIP ═══════════ -->
<section class="cta-strip">
  <div class="container">
    <div class="cta-inner">
      <span class="label">Take the Next Step</span>
      <h2 class="cta-h">Ready to finance your<br><em>future goals?</em></h2>
      <p class="cta-sub">Become a member of GBLDC today and gain access to our full range of cooperative financial services built for your community.</p>
      <div class="cta-btns">
        <a href="{{ route('Registration.form1') }}" class="btn-cta-white">
          Apply For Membership
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
          <a href="https://www.facebook.com/profile.php?id=100067957008092" class="f-social" target="_blank"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
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
</body>
</html>
