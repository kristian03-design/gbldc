<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GBLDC | Board of Directors</title>
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
    .logo img {
      width: 46px; height: 46px; display: flex; align-items: center; justify-content: center;
      font-family: 'Cormorant Garamond', serif; font-weight: 700; font-size: 14px;
      color: var(--amber-soft); letter-spacing: 0.02em; overflow: hidden; padding: 4px; flex-shrink: 0;
    }
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

    /* profile button */
    .profile-wrap { position: relative; }
    .profile-btn { display: flex; align-items: center; gap: 7px; cursor: pointer; background: none; border: none; padding: 0; }
    .profile-img { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid var(--moss); }
    .profile-chevron { font-size: 0.65rem; color: var(--ink-muted); transition: transform 0.2s; }
    .profile-wrap:hover .profile-chevron { transform: rotate(180deg); }

    .profile-panel {
      position: absolute; right: 0; top: calc(100% + 8px); width: 220px;
      background: var(--white); border: 1px solid rgba(22,163,74,0.12); border-radius: 14px;
      padding: 0.5rem; box-shadow: var(--shadow-lg); opacity: 0; visibility: hidden;
      transform: translateY(6px); transition: all 0.2s;
    }
    .profile-wrap:hover .profile-panel { opacity: 1; visibility: visible; transform: none; }
    .profile-panel a {
      display: block; padding: 0.6rem 0.85rem; font-size: 0.78rem; font-weight: 500; letter-spacing: 0.04em;
      color: var(--ink-soft); text-decoration: none; border-radius: 8px; transition: background 0.15s, color 0.15s;
    }
    .profile-panel a:hover { background: var(--parchment2); color: var(--grove); }
    .profile-panel .divider { height: 1px; background: var(--parchment2); margin: 0.4rem 0; }
    .profile-panel .danger { color: #c0392b !important; }
    .profile-panel .danger:hover { background: #fff0ee !important; color: #c0392b !important; }

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

    @media (max-width: 1024px) { .nav-desktop { display: none; } .profile-wrap { display: none; } .ham-btn { display: flex; } }

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

    /* BOARD GRID */
    .board-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem; }
    .board-card { background: var(--white); border-radius: 16px; overflow: hidden; border: 1px solid rgba(22,163,74,0.08); transition: transform 0.3s, box-shadow 0.3s; }
    .board-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .bc-img-wrap { width: 100%; aspect-ratio: 4/3; overflow: hidden; background: var(--parchment2); position: relative; }
    .bc-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .board-card:hover .bc-img-wrap img { transform: scale(1.05); }
    .bc-info { padding: 2rem; text-align: center; }
    .bc-name { font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 700; color: var(--ink); margin-bottom: 0.25rem; }
    .bc-title { display: block; font-family: 'Syne', sans-serif; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: var(--grove-mid); margin-bottom: 1rem; }
    .bc-desc { font-size: 0.9rem; color: var(--ink-muted); line-height: 1.6; }
    @media(max-width: 900px) { .board-grid { grid-template-columns: repeat(2, 1fr); gap: 2rem; } }
    @media(max-width: 600px) { .board-grid { grid-template-columns: 1fr; } }

    /* ════════════════════ LOGOUT MODAL ════════════════════ */
    .modal-bg { position: fixed; inset: 0; background: rgba(26,46,30,0.55); backdrop-filter: blur(4px); z-index: 500; display: none; align-items: center; justify-content: center; }
    .modal-bg.open { display: flex; }
    .modal-box { background: var(--white); border-radius: 18px; padding: 2.25rem; width: 380px; max-width: 90vw; box-shadow: var(--shadow-lg); text-align: center; animation: chatPop 0.28s ease; }
    .modal-icon { width: 52px; height: 52px; border-radius: 14px; background: #fff0ee; margin: 0 auto 1.25rem; display: flex; align-items: center; justify-content: center; }
    .modal-icon svg { width: 24px; height: 24px; stroke: #c0392b; fill: none; stroke-width: 2; }
    .modal-h { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 700; color: var(--ink); margin-bottom: 0.5rem; }
    .modal-p { font-size: 0.875rem; color: var(--ink-muted); line-height: 1.65; margin-bottom: 1.75rem; }
    .modal-btns { display: flex; gap: 10px; justify-content: center; }
    .btn-ghost { padding: 0.65rem 1.4rem; border-radius: 8px; border: 1.5px solid rgba(22,163,74,0.2); background: transparent; color: var(--ink-soft); font-family: 'Syne', sans-serif; font-size: 0.83rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }
    .btn-ghost:hover { background: var(--parchment2); }
    .btn-danger { padding: 0.65rem 1.4rem; border-radius: 8px; border: none; background: #c0392b; color: #fff; font-family: 'Syne', sans-serif; font-size: 0.83rem; font-weight: 700; cursor: pointer; text-decoration: none; display: inline-block; transition: background 0.2s; }
    .btn-danger:hover { background: #a93226; }

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
  <a href="{{ route('Member.Landing') }}" class="logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo">
    <span class="logo-name">GBLDC</span>
  </a>

  <nav class="nav-desktop">
    <a href="{{ route('Member.Landing') }}">Home</a>

    <div class="dd-wrap">
      <button class="dd-trigger">
        Products & Services
        <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="dd-panel">
        <a href="{{ route('Member.Loans') }}">Loans</a>
        <a href="{{ route('Under.Construction') ?? '#' }}">Deposits</a>
        <a href="{{ route('Under.Construction') ?? '#' }}">Savings</a>
      </div>
    </div>

    <div class="dd-wrap">
      <button class="dd-trigger">
        About
        <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="dd-panel">
        <a href="{{ route('Member.AboutUs') }}">About GBLDC</a>
        <a href="{{ route('Member.AboutUs') }}">Mission & Vision</a>
        <a href="{{ route('Member.BOD') }}">Board of Directors</a>
        <a href="{{ route('Under.Construction') ?? '#' }}">Committee Officers</a>
      </div>
    </div>

    <a href="{{ route('Member.NewsEvents') }}">News & Events</a>
    <a href="{{ route('Member.Testimonials') }}">Testimonials</a>
  </nav>

  <div style="display:flex;align-items:center;gap:12px;">
    <div class="profile-wrap nav-desktop" style="display:flex;">
      <button class="profile-btn" style="cursor:pointer;">
         <img src="{{ asset('images/profile.png') }}" alt="Profile" class="profile-img">
         <i class="fas fa-chevron-down profile-chevron"></i>
      </button>
      <div class="profile-panel">
        <a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a>
        <a href="{{ route('Member.Notifications') }}">Notifications</a>
        <a href="{{ route('Member.AccountSettings') }}">Settings</a>
        <a href="{{ route('Member.ContactUs') }}">Help & Support</a>
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
    <button onclick="this.nextElementSibling.classList.toggle('open')">Products & Services</button>
    <div class="mobile-sub">
      <a href="{{ route('Member.Loans') }}">Loans</a>
      <a href="{{ route('Under.Construction') ?? '#' }}">Deposits</a>
      <a href="{{ route('Under.Construction') ?? '#' }}">Savings</a>
    </div>
  </div>
  <div class="mobile-nav-group">
    <button onclick="this.nextElementSibling.classList.toggle('open')">About</button>
    <div class="mobile-sub">
      <a href="{{ route('Member.AboutUs') }}">About GBLDC</a>
      <a href="{{ route('Member.AboutUs') }}">Mission & Vision</a>
      <a href="{{ route('Member.BOD') }}">Board of Directors</a>
      <a href="{{ route('Under.Construction') ?? '#' }}">Committee Officers</a>
    </div>
  </div>
  <a href="{{ route('Under.Construction') ?? '#' }}">News & Events</a>
  <a href="{{ route('Member.Testimonials') }}">Testimonials</a>
  <div class="mobile-divider"></div>
  <a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a>
  <a href="{{ route('Member.Notifications') }}">Notifications</a>
  <a href="{{ route('Member.AccountSettings') }}">Settings</a>
  <a href="{{ route('Member.ContactUs') }}">Help & Support</a>
  <a href="#" style="color:#c0392b;" onclick="openLogoutModal()">Logout</a>
</div>

<!-- ═══════════ LOGOUT MODAL ═══════════ -->
<div class="modal-bg" id="logout-modal">
  <div class="modal-box">
    <div class="modal-icon"><svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg></div>
    <h3 class="modal-h">Sign Out</h3>
    <p class="modal-p">Are you sure you want to log out of your member account? You will need to sign in again to access the portal.</p>
    <div class="modal-btns">
      <button class="btn-ghost" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{ route('Landing.Page') }}" class="btn-danger">Yes, Sign Out</a>
    </div>
  </div>
</div>

<!-- ═══════════ HERO ═══════════ -->
<section class="hero">
  <div class="hero-copy">
    <div class="hero-eyebrow"><span class="dot"></span> Our Leadership</div>
    <h1 class="hero-h1">
      Board of<br>
      <em>Directors</em>
    </h1>
    <p class="hero-sub">
      Meet the dedicated leaders guiding GBLDC with integrity, foresight, and a steadfast commitment to our cooperative's mission.
    </p>
    <div class="slant" aria-hidden="true"></div>
  </div>
  <div class="hero-image">
    <img src="{{ asset('images/board-group-photo.jpg') }}" onerror="this.src=`{{ asset('images/meeting-2.png') }}`" alt="Board of Directors Group">
  </div>
</section>

<!-- ═══════════ DIRECTORS GRID ═══════════ -->
<section class="section" style="background: var(--canvas); padding-bottom: 120px;">
  <div class="container">
    <div class="sec-head sec-head-center">
      <span class="label">Guiding Principles</span>
      <h2 class="sec-title display">Meet the Board</h2>
      <p class="sec-sub">Our Board of Directors ensures that every decision made aligns with the best interests of our members and the greater Bulacan community.</p>
    </div>
    
    <div class="board-grid">
      @foreach([
        ['name'=>'Juan Dela Cruz', 'title'=>'Chairperson', 'desc'=>'A visionary leader driving strategic community initiatives and cooperative expansion.'],
        ['name'=>'Maria Clara', 'title'=>'Vice Chairperson', 'desc'=>'A steadfast champion of sustainable livelihood and ethical micro-finance.'],
        ['name'=>'Jose Rizal', 'title'=>'Board Member', 'desc'=>'Expert in policy-making, risk management, and agricultural development.'],
        ['name'=>'Andres Bonifacio', 'title'=>'Board Member', 'desc'=>'Focused on membership expansion and localized branch outreach programs.'],
        ['name'=>'Apolinario Mabini', 'title'=>'Board Member', 'desc'=>'Advises on structural legalities, compliance governance, and cooperative law.'],
        ['name'=>'Emilio Aguinaldo', 'title'=>'Board Member', 'desc'=>'Specializes in treasury oversight and establishing robust financial audits.']
      ] as $member)
      <div class="board-card">
        <div class="bc-img-wrap">
          <img src="{{ asset('images/default-male-profile.svg') }}" onerror="this.src=`{{ asset('images/profile.png') }}`" alt="{{ $member['name'] }}">
        </div>
        <div class="bc-info">
          <h4 class="bc-name">{{ $member['name'] }}</h4>
          <span class="bc-title">{{ $member['title'] }}</span>
          <p class="bc-desc">{{ $member['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ═══════════ FOOTER ═══════════ -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="f-brand">
        <a href="{{ route('Member.Landing') }}" class="logo" style="margin-bottom:0.5rem;">
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
          <li><a href="{{ route('Member.Loans') }}">Loan Services</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Deposit Services</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Savings Services</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>About</h5>
        <ul>
          <li><a href="{{ route('Member.AboutUs') }}">About GBLDC</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Senior Management</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">Officers &amp; Committees</a></li>
          <li><a href="{{ route('Under.Construction') ?? '#' }}">About Membership</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="https://ifernglobal.com.ph/" target="_blank">iFern Global</a></li>
          <li><a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a></li>
          <li><a href="{{ route('Member.ContactUs') }}">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <div class="f-bottom">
      <span class="f-copy">© {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative. All rights reserved.</span>
      <div class="f-legal">
        <a href="{{ route('Member.Policies') }}#privacy">Privacy Policy</a>
        <a href="{{ route('Member.Policies') }}#terms">Terms of Service</a>
        <a href="{{ route('Member.Policies') }}#cookies">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>

<script>
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
</script>
</body>
</html>
