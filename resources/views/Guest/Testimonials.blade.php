<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GBLDC | Member Testimonials</title>
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
    .nav-desktop a:hover, .nav-desktop .dd-trigger:hover, .nav-desktop a.active-link { color: var(--grove); background: rgba(22,163,74,0.08); }

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
    
    .mobile-login {
      margin-top: 0.5rem; padding: 0.75rem 1rem;
      background: var(--grove); color: #fff; border-radius: 10px;
      font-size: 0.88rem; font-weight: 700; text-decoration: none;
      text-align: center; letter-spacing: 0.06em;
      font-family: 'Syne', sans-serif;
    }

    @media (max-width: 1024px) { .nav-desktop { display: none; } .btn-login-header { display: none; } .ham-btn { display: flex; } }

    /* ════════════════════ HERO ════════════════════ */
    .hero { min-height: 55vh; padding-top: 68px; display: grid; grid-template-columns: 55% 45%; position: relative; overflow: hidden; background: var(--grove-mid); }
    .hero-copy { background: var(--grove-mid); padding: 60px 60px 60px 80px; display: flex; flex-direction: column; justify-content: center; position: relative; overflow: hidden; z-index: 1; }
    .hero-copy::before { content: ''; position: absolute; bottom: -140px; left: -100px; width: 500px; height: 500px; border-radius: 50%; border: 1px solid rgba(196,217,188,0.15); pointer-events: none; }
    .hero-copy::after { content: ''; position: absolute; top: -80px; right: -80px; width: 320px; height: 320px; border-radius: 50%; border: 1px solid rgba(52,211,153,0.18); pointer-events: none; }
    .hero-copy .slant { position: absolute; top: 0; right: -1px; bottom: 0; width: 80px; background: var(--canvas); clip-path: polygon(100% 0, 100% 100%, 0 100%); z-index: 2; }
    
    .hero-eyebrow { display: inline-flex; align-items: center; gap: 8px; background: rgba(52,211,153,0.18); border: 1px solid rgba(52,211,153,0.3); color: white; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; padding: 0.38rem 0.9rem; border-radius: 4px; width: fit-content; margin-bottom: 1.5rem; animation: riseUp 0.7s ease both; }
    .hero-eyebrow .dot { width: 5px; height: 5px; border-radius: 50%; background: white; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1}50%{opacity:0.3} }

    .hero-h1 { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.8rem, 4vw, 4.2rem); font-weight: 700; color: var(--white); line-height: 1.04; margin-bottom: 1.25rem; animation: riseUp 0.75s 0.1s ease both; }
    .hero-h1 em { font-style: italic; color: var(--amber-soft); display: block; }
    .hero-sub { font-size: 0.95rem; font-weight: 400; color: rgba(255,255,255,0.75); line-height: 1.8; max-width: 440px; animation: riseUp 0.75s 0.2s ease both; }
    .hero-image { position: relative; overflow: hidden; background: var(--parchment2); }
    .hero-image img { width: 100%; height: 100%; object-fit: cover; display: block; animation: heroZoom 20s infinite alternate ease-in-out; }
    @keyframes heroZoom { from{transform:scale(1)} to{transform:scale(1.06)} }
    @keyframes riseUp { from{opacity:0;transform:translateY(22px)} to{opacity:1;transform:translateY(0)} }
    @media (max-width: 1024px) { .hero { grid-template-columns: 1fr; min-height: 40vh; } .hero-image { display: none; } .hero-copy { padding: 50px 2rem; } .hero-copy .slant { display: none; } }

    /* ════════════════════ LAYOUT ════════════════════ */
    .section { padding: 60px 0; }
    .container { max-width: 1180px; margin: 0 auto; padding: 0 2rem; }

    /* FILTER BAR */
    .filter-wrapper { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 3rem; background: var(--white); border: 1px solid rgba(22,163,74,0.1); padding: 1rem 1.5rem; border-radius: 16px; box-shadow: var(--shadow-sm); z-index: 10; position: relative; }
    .filter-pills { display: flex; gap: 8px; flex-wrap: wrap; }
    .filter-btn { padding: 0.5rem 1.2rem; border-radius: 99px; background: var(--parchment2); border: 1px solid transparent; color: var(--ink-soft); font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: 'Syne', sans-serif; }
    .filter-btn:hover { background: var(--moss); color: var(--grove-mid); }
    .filter-btn.active { background: var(--grove); border-color: var(--grove); color: #fff; }
    
    .search-box { position: relative; display: flex; align-items: center; min-width: 250px; }
    .search-box svg { position: absolute; left: 14px; width: 16px; height: 16px; stroke: var(--ink-muted); fill: none; pointer-events: none; }
    .search-input { width: 100%; padding: 0.6rem 1rem 0.6rem 2.4rem; border-radius: 99px; border: 1px solid rgba(22,163,74,0.2); background: var(--canvas); color: var(--ink); font-family: 'Syne', sans-serif; font-size: 0.85rem; outline: none; transition: border-color 0.2s, background 0.2s; }
    .search-input:focus { border-color: var(--grove-mid); background: var(--white); }

    /* TESTIMONIAL GRID */
    .testi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 1rem; }
    .t-card { background: var(--white); border: 1px solid rgba(22,163,74,0.1); border-radius: 16px; padding: 2.5rem 2rem; transition: transform 0.3s, box-shadow 0.3s; position: relative; display: flex; flex-direction: column; }
    .t-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); border-color: rgba(52,211,153,0.4); }
    .t-quote-mark { font-family: 'Cormorant Garamond', serif; font-size: 5rem; font-weight: 700; color: rgba(52,211,153,0.12); line-height: 1; position: absolute; top: 1rem; right: 1.5rem; user-select: none; }
    .t-text { font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; font-style: italic; font-weight: 400; color: var(--ink-muted); line-height: 1.75; margin-bottom: 2rem; flex-grow:1; display:flex; flex-direction:column; justify-content:center; }
    .t-stars { display: flex; gap: 3px; margin-bottom: 1.25rem; }
    .t-stars svg { width: 15px; height: 15px; fill: var(--amber-soft); stroke: none; }
    .t-author { display: flex; align-items: center; gap: 12px; margin-top: auto; border-top: 1px solid rgba(22,163,74,0.1); padding-top: 1.5rem; }
    .t-av { width: 44px; height: 44px; border-radius: 50%; background: var(--grove); display: flex; align-items: center; justify-content: center; font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; font-weight: 700; color: var(--white); flex-shrink: 0; box-shadow: var(--shadow-sm); }
    .t-name { font-size: 0.95rem; font-weight: 700; color: var(--ink); line-height: 1.2; }
    .t-role { font-size: 0.75rem; color: var(--grove-mid); margin-top: 3px; letter-spacing: 0.04em; }
    @media(max-width: 1024px) { .testi-grid { grid-template-columns: repeat(2, 1fr); } }
    @media(max-width: 640px) { .testi-grid { grid-template-columns: 1fr; } }

    /* ════════════════════ CTA STRIP ════════════════════ */
    .cta-strip { background: var(--grove-mid); padding: 80px 0; position: relative; overflow: hidden; margin-top: 40px; }
    .cta-strip::before { content: ''; position: absolute; top: -150px; right: -100px; width: 450px; height: 450px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.08); pointer-events: none; }
    .cta-strip::after { content: ''; position: absolute; bottom: -100px; left: -80px; width: 300px; height: 300px; border-radius: 50%; border: 1px solid rgba(52,211,153,0.18); pointer-events: none; }
    .cta-inner { position: relative; z-index: 1; text-align: center; }
    .cta-inner .label { color: var(--amber-soft); margin-bottom: 1rem; display: block; }
    .cta-h { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.2rem, 4vw, 3.6rem); font-weight: 700; color: #fff; line-height: 1.08; margin-bottom: 1rem; }
    .cta-h em { font-style: italic; color: var(--amber-soft); }
    .cta-sub { font-size: 0.92rem; color: rgba(255,255,255,0.6); max-width: 460px; margin: 0 auto 2.25rem; line-height: 1.75; }
    .cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
    .btn-cta-white { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: var(--grove-mid); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.9rem 2rem; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-family: 'Syne', sans-serif; transition: background 0.2s, transform 0.15s, box-shadow 0.2s; }
    .btn-cta-white:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,0,0.15); }
    .btn-cta-white svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    /* ════════════════════ FOOTER ════════════════════ */
    footer { background: #0d1f10; padding: 64px 0 28px; border-top: 4px solid var(--grove); }
    .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; }
    .f-brand .logo-name { color: #fff; font-size: 1.25rem; margin-top: 15px; margin-left: 12px; }
    .f-brand .logo { margin-bottom: 0.5rem; }
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
        <a href="{{ route('Guest.BOD') }}">Board of Directors</a>
        <a href="#">Committee Officers</a>
      </div>
    </div>

    <a href="{{ route('Guest.NewsEvents') }}">News & Events</a>
    <a href="{{ route('Guest.Testimonials') }}" class="active-link">Testimonials</a>
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
      <a href="{{ route('Guest.BOD') }}">Board of Directors</a>
      <a href="#">Committee Officers</a>
    </div>
  </div>
  <a href="{{ route('Guest.NewsEvents') }}">News & Events</a>
  <a href="{{ route('Guest.Testimonials') }}">Testimonials</a>
  <div class="mobile-divider"></div>
  <a href="{{ route('Member.Login') }}" class="mobile-login">Login to Member Portal</a>
</div>

<!-- ═══════════ HERO ═══════════ -->
<section class="hero">
  <div class="hero-copy">
    <div class="hero-eyebrow"><span class="dot"></span> Member Voices</div>
    <h1 class="hero-h1">
      Member <em>Testimonials</em>
    </h1>
    <p class="hero-sub">
      Read authentic stories and experiences from the GBLDC community. See how our cooperative helps members grow and thrive.
    </p>
    <div class="slant" aria-hidden="true"></div>
  </div>
  <div class="hero-image">
    <img src="{{ asset('images/about-bg.jpg') }}" alt="GBLDC News Header">
  </div>
</section>

<!-- ═══════════ TESTIMONIAL GRID ═══════════ -->
<section class="section">
  <div class="container">
    @if(isset($testimonials) && count($testimonials) > 0)
      <div class="testi-grid">
        @foreach($testimonials as $testimonial)
        <div class="t-card">
          <span class="t-quote-mark">"</span>
          <div class="t-stars">
            <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          </div>
          <p class="t-text">"{{ $testimonial->content }}"</p>
          <div class="t-author">
            <div class="t-av">{{ substr($testimonial->title, 0, 1) }}</div>
            <div>
              <div class="t-name">{{ $testimonial->title }}</div>
              <div class="t-role">{{ $testimonial->subtitle ?? 'Member' }}</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div style="padding: 100px 0; text-align:center; color: var(--ink-muted);">
        <p>No testimonials published yet.</p>
      </div>
    @endif
  </div>
</section>

<!-- ═══════════ CTA STRIP ═══════════ -->
<section class="cta-strip">
  <div class="container">
    <div class="cta-inner">
      <span class="label">Take the Next Step</span>
      <h2 class="cta-h">Ready to secure your<br><em>financial future?</em></h2>
      <p class="cta-sub">Join the cooperative today and unlock exclusive benefits such as high-interest savings, low-rate loans, and collaborative opportunities customized for you.</p>
      <div class="cta-btns">
        <a href="{{ route('Registration.form1') }}" class="btn-cta-white">
          Become a Member
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
          <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo" style="width:40px;height:40px;padding:5px;">
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
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Deposit Services</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Savings Services</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>About</h5>
        <ul>
          <li><a href="{{ route('Guest.AboutUs') }}">About GBLDC</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Senior Management</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Officers &amp; Committees</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">About Membership</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="https://ifernglobal.com.ph/" target="_blank">iFern Global</a></li>
          <li><a href="{{ route('Member.Login') }}">Member Login</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <div class="f-bottom">
      <span class="f-copy">© {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative. All rights reserved.</span>
      <div class="f-legal">
        <a href="{{ route('Guest.Policies') ?? '#' }}#privacy">Privacy Policy</a>
        <a href="{{ route('Guest.Policies') ?? '#' }}#terms">Terms of Service</a>
        <a href="{{ route('Guest.Policies') ?? '#' }}#cookies">Cookie Policy</a>
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
