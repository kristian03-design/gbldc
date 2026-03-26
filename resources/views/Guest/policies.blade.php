<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GBLDC | Legal Policies</title>
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
      position: relative;
      background: var(--grove-mid);
      padding: 120px 2rem 60px;
      text-align: center;
      overflow: hidden;
    }
    .hero::before {
      content: ''; position: absolute; bottom: -140px; left: -100px;
      width: 500px; height: 500px; border-radius: 50%;
      border: 1px solid rgba(196,217,188,0.15); pointer-events: none;
    }
    .hero::after {
      content: ''; position: absolute; top: -80px; right: -80px;
      width: 320px; height: 320px; border-radius: 50%;
      border: 1px solid rgba(52,211,153,0.18); pointer-events: none;
    }
    .hero-h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.5rem, 4vw, 4rem); font-weight: 700;
      color: var(--white); line-height: 1.1; margin-bottom: 1rem;
      position: relative; z-index: 1;
    }
    .hero-sub {
      font-size: 1rem; color: rgba(255,255,255,0.7);
      max-width: 600px; margin: 0 auto; line-height: 1.6;
      position: relative; z-index: 1;
    }

    /* ════════════════════ CONTENT LAYOUT ════════════════════ */
    .policies-wrapper {
      max-width: 1100px; margin: 0 auto; padding: 4rem 2rem;
      display: grid; grid-template-columns: 280px 1fr; gap: 3rem;
    }
    @media(max-width: 800px) {
      .policies-wrapper { grid-template-columns: 1fr; gap: 2rem; }
    }

    /* Sidebar Navigation */
    .side-nav {
      background: var(--white);
      border: 1px solid rgba(22,163,74,0.12);
      border-radius: 12px; padding: 1.5rem;
      position: sticky; top: 100px;
      box-shadow: var(--shadow-sm);
    }
    .side-nav ul { list-style: none; }
    .side-nav li { margin-bottom: 0.5rem; }
    .side-nav a {
      display: block; padding: 0.75rem 1rem;
      font-size: 0.9rem; font-weight: 600; color: var(--ink-soft);
      text-decoration: none; border-radius: 8px;
      transition: background 0.2s, color 0.2s;
    }
    .side-nav a:hover,
    .side-nav a.active {
      background: var(--parchment2); color: var(--grove);
    }

    /* Policy Content Area */
    .policy-content {
      background: var(--white);
      border: 1px solid rgba(22,163,74,0.12);
      border-radius: 16px; padding: 3rem;
      box-shadow: var(--shadow-sm);
    }
    @media(max-width: 600px) {
      .policy-content { padding: 2rem 1.5rem; }
    }

    .policy-section { display: none; animation: fadeIn 0.4s ease; }
    .policy-section.active { display: block; }
    @keyframes fadeIn { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
    
    .policy-content h2 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.2rem; font-weight: 700; color: var(--ink);
      margin-bottom: 1.5rem; border-bottom: 2px solid var(--parchment2);
      padding-bottom: 0.75rem;
    }
    .policy-content h3 {
      font-size: 1.2rem; font-weight: 700; color: var(--ink);
      margin: 2rem 0 0.75rem;
    }
    .policy-content p {
      font-size: 0.95rem; color: var(--ink-muted);
      line-height: 1.75; margin-bottom: 1rem;
    }
    .policy-content ul {
      margin: 0 0 1rem 1.5rem; color: var(--ink-muted); font-size: 0.95rem; line-height: 1.75;
    }
    .policy-content li { margin-bottom: 0.5rem; }

    /* ════════════════════ FOOTER ════════════════════ */
    footer { background: #0d1f10; padding: 64px 0 28px; border-top: 4px solid var(--grove); }
    .container { max-width: 1180px; margin: 0 auto; padding: 0 2rem; }
    .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; }
    .f-brand .logo-name { color: #fff; font-size: 1.25rem; }
    .f-tagline { font-size: 0.83rem; color: rgba(255,255,255,0.4); line-height: 1.75; margin: 1rem 0 1.5rem; }
    .f-socials { display: flex; gap: 8px; }
    .f-social svg { width: 14px; height: 14px; stroke: currentColor; fill: none; }
    .f-social { width: 34px; height: 34px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.4); text-decoration: none; transition: all 0.2s; }
    .f-social:hover { background: var(--grove); border-color: var(--grove); color: #fff; }
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
      <button class="dd-trigger">Services <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg></button>
      <div class="dd-panel">
        <a href="{{ route('Guest.Loans') }}">Loans</a>
        <a href="{{ route('Under.Construction') }}">Deposits</a>
        <a href="{{ route('Under.Construction') }}">Savings</a>
      </div>
    </div>
    <div class="dd-wrap">
      <button class="dd-trigger">About <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg></button>
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
  <h1 class="hero-h1">Legal Policies</h1>
  <p class="hero-sub">Commitments we make to protect your information and set expectations for using our services.</p>
</section>

<!-- ═══════════ CONTENT ═══════════ -->
<div class="policies-wrapper">
  <div class="side-nav">
    <ul id="policyTabs">
      <li><a href="#privacy" class="active" onclick="switchPolicy('privacy')">Privacy Policy</a></li>
      <li><a href="#terms" onclick="switchPolicy('terms')">Terms of Service</a></li>
      <li><a href="#cookies" onclick="switchPolicy('cookies')">Cookie Policy</a></li>
    </ul>
  </div>

  <div class="policy-content">
    
    <!-- PRIVACY POLICY -->
    <div id="section-privacy" class="policy-section active">
      <h2>Privacy Policy</h2>
      <p><em>Last Updated: March 2024</em></p>
      
      <h3>1. Introduction</h3>
      <p>Greater Bulacan Livelihood Development Cooperative (GBLDC) respects your privacy and is committed to protecting your personal data. This privacy policy will inform you as to how we look after your personal data when you visit our website, use our cooperative portal, and tell you about your privacy rights and how the law protects you.</p>

      <h3>2. The Data We Collect About You</h3>
      <p>We may collect, use, store and transfer different kinds of personal data about you which we have grouped together as follows:</p>
      <ul>
        <li><strong>Identity Data</strong> includes first name, maiden name, last name, username or similar identifier, marital status, title, date of birth and gender.</li>
        <li><strong>Contact Data</strong> includes home address, email address and telephone numbers.</li>
        <li><strong>Financial Data</strong> includes bank account and cooperative shared capital numbers, loan details, salary, and repayment capacities.</li>
        <li><strong>Transaction Data</strong> includes details about payments to and from you and other details of products and services you have purchased from us.</li>
        <li><strong>Profile Data</strong> includes your username and password, loans applied, interests, preferences, and feedback.</li>
      </ul>

      <h3>3. How We Use Your Personal Data</h3>
      <p>We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:</p>
      <ul>
        <li>Where we need to perform the cooperative agreement we are about to enter into or have entered into with you.</li>
        <li>Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.</li>
        <li>Where we need to comply with a legal or regulatory obligation, such as those imposed by the Cooperative Development Authority (CDA).</li>
      </ul>

      <h3>4. Data Security</h3>
      <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorized way, altered or disclosed. Limited access is strictly enforced among our administrative staff.</p>

      <h3>5. Your Legal Rights</h3>
      <p>Under certain circumstances, you have rights under data protection laws in relation to your personal data, including the right to request access to your data, correction of your data, or erasure of your data.</p>
    </div>

    <!-- TERMS OF SERVICE -->
    <div id="section-terms" class="policy-section">
      <h2>Terms of Service</h2>
      <p><em>Last Updated: March 2024</em></p>

      <h3>1. Acceptance of Terms</h3>
      <p>By accessing and using this portal, you accept and agree to be bound by the terms and provision of this agreement. In addition, when using these particular cooperative services, you shall be subject to any posted guidelines or rules applicable to such services.</p>

      <h3>2. Membership Requirements</h3>
      <p>To use our member portal, you must be a registered member of GBLDC in good standing. Membership is subject to approval by the Board of Directors and entails full adherence to our cooperative's bylaws and policies. You must attend the required Pre-Membership Education Seminar (PMES).</p>

      <h3>3. User Accounts</h3>
      <p>You are responsible for maintaining the confidentiality of your account credentials (username and password) and for restricting access to your computer or device. You agree to accept responsibility for all activities that occur under your account.</p>

      <h3>4. Cooperative Services</h3>
      <ul>
        <li><strong>Loans:</strong> All loan applications are subject to evaluation and approval by the Credit Committee based on your capacity to pay, credit history, and shared capital balance.</li>
        <li><strong>Shared Capital:</strong> Mandatory contributions to shared capital must be remitted as agreed upon mutually in your membership form. Defaulting on contributions may affect your borrowing capacity.</li>
      </ul>

      <h3>5. Limitation of Liability</h3>
      <p>GBLDC and its directors, officers, employees, and affiliates will not be liable for any direct, indirect, incidental, special, consequential or exemplary damages resulting from your use of the portal or inability to access the services due to maintenance or unforeseeable network issues.</p>
    </div>

    <!-- COOKIE POLICY -->
    <div id="section-cookies" class="policy-section">
      <h2>Cookie Policy</h2>
      <p><em>Last Updated: March 2024</em></p>

      <h3>1. What Are Cookies?</h3>
      <p>Cookies are small text files that are placed on your computer or mobile device by websites that you visit. They are widely used in order to make websites work, or work more efficiently, as well as to provide information to the owners of the site.</p>

      <h3>2. How We Use Cookies</h3>
      <p>We use cookies on our portal to improve functionality, enhance the user experience, and ensure security. Specifically:</p>
      <ul>
        <li><strong>Strictly Necessary Cookies:</strong> These are required for the operation of our cooperative portal. They include, for example, cookies that enable you to securely log into the Member Dashboard.</li>
        <li><strong>Analytical/Performance Cookies:</strong> These allow us to recognize and count the number of visitors and to see how visitors move around our portal when they are using it.</li>
        <li><strong>Functionality Cookies:</strong> These are used to recognize you when you return to our portal, enabling us to personalize content for you (e.g., remembering your session).</li>
      </ul>

      <h3>3. Managing Cookies</h3>
      <p>Most web browsers allow some control of most cookies through the browser settings. To find out more about cookies, including how to see what cookies have been set and how to manage and delete them, visit <a href="http://www.aboutcookies.org" target="_blank">www.aboutcookies.org</a>. Please note that disabling cookies may affect the functionality of the GBLDC portal.</p>
    </div>

  </div>
</div>

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

  function switchPolicy(sectionId) {
    // Hide all sections
    document.querySelectorAll('.policy-section').forEach(el => el.classList.remove('active'));
    // Remove active class from all tabs
    document.querySelectorAll('#policyTabs a').forEach(el => el.classList.remove('active'));
    
    // Show selected section
    document.getElementById('section-' + sectionId).classList.add('active');
    
    // Set active class to clicked tab
    document.querySelector(`#policyTabs a[href="#${sectionId}"]`).classList.add('active');

    // Scroll slightly to the top of the content area
    window.scrollTo({
      top: document.querySelector('.policies-wrapper').offsetTop - 100,
      behavior: 'smooth'
    });
  }

  // Check URL hash on load to switch to correct tab
  document.addEventListener("DOMContentLoaded", function() {
    let hash = window.location.hash.substring(1);
    if(hash && ['privacy', 'terms', 'cookies'].includes(hash)) {
      switchPolicy(hash);
    }
  });

  // Re-check when hash changes (useful if user clicks footer links while already on the page)
  window.addEventListener("hashchange", function() {
    let hash = window.location.hash.substring(1);
    if(hash && ['privacy', 'terms', 'cookies'].includes(hash)) {
      switchPolicy(hash);
    }
  });
</script>

</body>
</html>
