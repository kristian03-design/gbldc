<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GBLDC | Landing Page</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}" sizes="512x512"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e588cb9d47.js" crossorigin="anonymous"></script>

  <style>
    /* ════════════════════════════════════════
       TOKENS
    ════════════════════════════════════════ */
    :root {
      --ink:        #1a2e1e; /* deep forest green-black */
      --ink-soft:   #2d4a32; /* dark green */
      --ink-muted:  #4a6b4f; /* medium green-gray */
      --parchment:  #ffffff;
      --parchment2: #f0f7f1; /* very light green tint */
      --canvas:     #f5faf6; /* green-tinted canvas */
      --grove:      #16a34a; /* green-600 */
      --grove-mid:  #15803d; /* green-700 */
      --grove-light:#22c55e; /* green-500 */
      --moss:       #dcfce7; /* green-100 */
      --amber:      #059669; /* emerald-600 */
      --amber-soft: #34d399; /* emerald-400 */
      --amber-pale: #d1fae5; /* emerald-100 */
      --white:      #ffffff;
      --shadow-sm:  0 2px 8px rgba(22, 163, 74, 0.08);
      --shadow-md:  0 8px 24px rgba(22, 163, 74, 0.12);
      --shadow-lg:  0 20px 48px rgba(22, 163, 74, 0.14);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
      font-family: 'Syne', sans-serif;
      background: var(--canvas);
      color: var(--ink);
      overflow-x: hidden;
    }

    /* grain overlay */
    body::after {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23g)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 9998;
    }

    /* ════════════════════════════════════════
       TYPOGRAPHY HELPERS
    ════════════════════════════════════════ */
    .display {
      font-family: 'Cormorant Garamond', serif;
      line-height: 1.05;
      letter-spacing: -0.01em;
    }
    .label {
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--grove-mid);
    }

    /* ════════════════════════════════════════
       HEADER
    ════════════════════════════════════════ */
    header {
      position: fixed; top: 0; left: 0; right: 0; z-index: 200;
      height: 68px;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 2.5rem;
      background: rgba(245, 250, 246, 0.94);
      backdrop-filter: blur(18px) saturate(1.4);
      border-bottom: 1px solid rgba(22, 163, 74, 0.12);
    }

    .logo {
      display: flex; align-items: center; gap: 10px;
      text-decoration: none; flex-shrink: 0;
    }
    /* FIX: logo badge properly constrains the image */
    .logo img {
      width: 46px; height: 46px;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Cormorant Garamond', serif;
      font-weight: 700; font-size: 14px;
      color: var(--amber-soft);
      letter-spacing: 0.02em;
      overflow: hidden;
      padding: 4px;
      flex-shrink: 0;
    }
    .logo-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.25rem; font-weight: 700;
      color: var(--grove); letter-spacing: 0.04em;
    }

    /* desktop nav */
    .nav-desktop {
      display: flex; align-items: center; gap: 0;
    }
    .nav-desktop a,
    .nav-desktop .dd-trigger {
      font-size: 0.78rem; font-weight: 600;
      letter-spacing: 0.06em;
      color: var(--ink-soft);
      text-decoration: none;
      padding: 0.45rem 0.9rem;
      border-radius: 6px;
      background: none; border: none;
      cursor: pointer;
      font-family: 'Syne', sans-serif;
      display: flex; align-items: center; gap: 4px;
      transition: color 0.2s, background 0.2s;
      white-space: nowrap;
    }
    .nav-desktop a:hover,
    .nav-desktop .dd-trigger:hover {
      color: var(--grove); background: rgba(22, 163, 74, 0.08);
    }

    .dd-wrap { position: relative; }
    .dd-panel {
      position: absolute; top: calc(100% + 6px); left: 0;
      min-width: 190px;
      background: var(--white);
      border: 1px solid rgba(22, 163, 74, 0.12);
      border-radius: 12px;
      padding: 0.35rem;
      box-shadow: var(--shadow-md);
      opacity: 0; visibility: hidden;
      transform: translateY(6px);
      transition: all 0.2s ease;
    }
    .dd-wrap:hover .dd-panel {
      opacity: 1; visibility: visible; transform: none;
    }
    .dd-panel a {
      display: block;
      font-size: 0.78rem; font-weight: 500;
      letter-spacing: 0.04em;
      color: var(--ink-soft);
      text-decoration: none;
      padding: 0.55rem 0.85rem;
      border-radius: 8px;
      transition: background 0.15s, color 0.15s;
    }
    .dd-panel a:hover { background: var(--parchment2); color: var(--grove); }

    /* profile button */
    .profile-wrap { position: relative; }
    .profile-btn {
      display: flex; align-items: center; gap: 7px;
      cursor: pointer; background: none; border: none; padding: 0;
    }
    .profile-img {
      width: 45px; height: 45px;
      border-radius: 50%; object-fit: cover;
      border: 2px solid var(--moss);
    }
    .profile-chevron {
      font-size: 0.65rem; color: var(--ink-muted);
      transition: transform 0.2s;
    }
    .profile-wrap:hover .profile-chevron { transform: rotate(180deg); }

    .profile-panel {
      position: absolute; right: 0; top: calc(100% + 8px);
      width: 220px;
      background: var(--white);
      border: 1px solid rgba(22, 163, 74, 0.12);
      border-radius: 14px;
      padding: 0.5rem;
      box-shadow: var(--shadow-lg);
      opacity: 0; visibility: hidden;
      transform: translateY(6px);
      transition: all 0.2s;
    }
    .profile-wrap:hover .profile-panel {
      opacity: 1; visibility: visible; transform: none;
    }
    .profile-panel a {
      display: block; padding: 0.6rem 0.85rem;
      font-size: 0.78rem; font-weight: 500; letter-spacing: 0.04em;
      color: var(--ink-soft); text-decoration: none;
      border-radius: 8px;
      transition: background 0.15s, color 0.15s;
    }
    .profile-panel a:hover { background: var(--parchment2); color: var(--grove); }
    .profile-panel .divider { height: 1px; background: var(--parchment2); margin: 0.4rem 0; }
    .profile-panel .danger { color: #c0392b !important; }
    .profile-panel .danger:hover { background: #fff0ee !important; color: #c0392b !important; }

    /* mobile hamburger */
    .ham-btn {
      display: none; width: 40px; height: 40px;
      border-radius: 8px; border: 1px solid rgba(22, 163, 74, 0.18);
      background: none; cursor: pointer;
      align-items: center; justify-content: center;
      color: var(--ink);
    }
    .ham-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; }

    /* mobile nav */
    .mobile-nav {
      display: none; flex-direction: column; gap: 2px;
      position: fixed; inset: 68px 0 0;
      background: var(--canvas);
      padding: 1.25rem;
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
      font-family: 'Syne', sans-serif;
      transition: background 0.15s, color 0.15s;
    }
    .mobile-nav a:hover, .mobile-nav-group > button:hover {
      background: var(--parchment2); color: var(--grove);
    }
    .mobile-sub { display: none; padding-left: 1rem; }
    .mobile-sub.open { display: block; }
    .mobile-sub a { font-size: 0.83rem; }
    .mobile-divider { height: 1px; background: var(--parchment2); margin: 0.5rem 0; }

    @media (max-width: 1024px) {
      .nav-desktop { display: none; }
      .profile-wrap { display: none; }
      .ham-btn { display: flex; }
    }

    /* ════════════════════════════════════════
       HERO — editorial split with angled divider
    ════════════════════════════════════════ */
    .hero {
      min-height: 100vh;
      padding-top: 68px;
      display: grid;
      grid-template-columns: 55% 45%;
      position: relative;
      overflow: hidden;
    }

    .hero-copy {
      background: var(--grove-mid);
      padding: 80px 60px 80px 80px;
      display: flex; flex-direction: column; justify-content: center;
      position: relative; overflow: hidden; z-index: 1;
    }

    /* decorative circle rings */
    .hero-copy::before {
      content: '';
      position: absolute; bottom: -140px; left: -100px;
      width: 500px; height: 500px;
      border-radius: 50%;
      border: 1px solid rgba(196,217,188,0.15);
      pointer-events: none;
    }
    .hero-copy::after {
      content: '';
      position: absolute; top: -80px; right: -80px;
      width: 320px; height: 320px;
      border-radius: 50%;
      border: 1px solid rgba(52, 211, 153, 0.18);
      pointer-events: none;
    }

    /* angled overlap on right edge */
    .hero-copy .slant {
      position: absolute; top: 0; right: -1px; bottom: 0;
      width: 80px;
      background: var(--canvas);
      clip-path: polygon(100% 0, 100% 100%, 0 100%);
      z-index: 2;
    }

    .hero-eyebrow {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(52, 211, 153, 0.18);
      border: 1px solid rgba(52, 211, 153, 0.3);
      color: white;
      font-size: 0.68rem; font-weight: 700; letter-spacing: 0.16em;
      text-transform: uppercase;
      padding: 0.38rem 0.9rem;
      border-radius: 4px;
      width: fit-content;
      margin-bottom: 2rem;
      animation: riseUp 0.7s ease both;
    }
    .hero-eyebrow .dot {
      width: 5px; height: 5px;
      border-radius: 50%; background: white;
      animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: 0.3; } }

    .hero-h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(3rem, 5vw, 5.2rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.04;
      margin-bottom: 1.75rem;
      animation: riseUp 0.75s 0.1s ease both;
    }
    .hero-h1 em {
      font-style: italic;
      color: var(--amber-soft);
      display: block;
    }

    .hero-sub {
      font-size: 0.95rem; font-weight: 400;
      color: rgba(255,255,255,0.65);
      line-height: 1.8;
      max-width: 400px;
      margin-bottom: 2.5rem;
      animation: riseUp 0.75s 0.2s ease both;
    }

    .hero-btns {
      display: flex; gap: 12px; flex-wrap: wrap;
      animation: riseUp 0.75s 0.3s ease both;
    }

    .btn-cta {
      display: inline-flex; align-items: center; gap: 8px;
      background: whitesmoke;
      color: var(--green-deep);
      font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 0.85rem 1.75rem;
      border-radius: 6px;
      text-decoration: none;
      border: none; cursor: pointer;
      font-family: 'Syne', sans-serif;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .btn-cta:hover {
      background: var(--green-mid);
      color: var(--white);
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(52, 211, 153, 0.32);
    }
    .btn-cta svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    .btn-outline {
      display: inline-flex; align-items: center; gap: 8px;
      background: transparent;
      color: rgba(255,255,255,0.75);
      font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 0.85rem 1.5rem;
      border-radius: 6px;
      text-decoration: none;
      border: 1px solid rgba(255,255,255,0.22);
      cursor: pointer;
      font-family: 'Syne', sans-serif;
      transition: all 0.2s;
    }
    .btn-outline:hover {
      background: rgba(255,255,255,0.08);
      border-color: rgba(255,255,255,0.45);
      color: #fff;
    }
    .btn-outline svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

    .hero-stats {
      display: flex; gap: 2.5rem;
      margin-top: 3rem; padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,0.1);
      animation: riseUp 0.75s 0.4s ease both;
    }
    .stat-val {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.2rem; font-weight: 700;
      color: var(--amber-soft); display: block; line-height: 1;
    }
    .stat-lbl {
      font-size: 0.68rem; font-weight: 600; letter-spacing: 0.12em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.45);
      margin-top: 4px; display: block;
    }

    .hero-image {
      position: relative; overflow: hidden;
      background: var(--parchment2);
    }
    .hero-image img {
      width: 100%; height: 100%;
      object-fit: cover; display: block;
      animation: heroZoom 20s infinite alternate ease-in-out;
    }
    @keyframes heroZoom { from { transform: scale(1); } to { transform: scale(1.06); } }

    /* floating badge on hero image */
    .hero-badge {
      position: absolute; bottom: 2.5rem; left: 2rem;
      background: var(--white);
      border-radius: 14px;
      padding: 1rem 1.25rem;
      box-shadow: var(--shadow-lg);
      display: flex; align-items: center; gap: 12px;
      max-width: 220px;
    }
    .hero-badge-icon {
      width: 42px; height: 42px; flex-shrink: 0;
      border-radius: 10px; background: var(--parchment2);
      display: flex; align-items: center; justify-content: center;
      color: var(--grove);
      font-size: 1.1rem;
    }
    .hero-badge-text strong {
      display: block; font-size: 0.85rem; font-weight: 700;
      color: var(--ink); letter-spacing: -0.01em;
    }
    .hero-badge-text span {
      font-size: 0.72rem; color: var(--ink-muted);
      font-weight: 400; letter-spacing: 0.04em;
    }

    @keyframes riseUp {
      from { opacity: 0; transform: translateY(22px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 1024px) {
      .hero { grid-template-columns: 1fr; }
      .hero-image { display: none; }
      .hero-copy { padding: 72px 2rem 64px; }
      .hero-copy .slant { display: none; }
    }
    @media (max-width: 640px) {
      .hero-stats { flex-wrap: wrap; gap: 1.5rem; }
      .hero-btns { flex-direction: column; }
    }

    /* ════════════════════════════════════════
       SECTION SCAFFOLDING
    ════════════════════════════════════════ */
    .section { padding: 100px 0; }
    .container { max-width: 1180px; margin: 0 auto; padding: 0 2rem; }

    .sec-head { margin-bottom: 3.5rem; }
    .sec-head .label { margin-bottom: 0.75rem; display: block; }
    .sec-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.2rem, 3.5vw, 3.4rem);
      font-weight: 700; color: var(--ink);
      line-height: 1.1; letter-spacing: -0.01em;
    }
    .sec-sub {
      margin-top: 0.75rem;
      font-size: 0.9rem; font-weight: 400;
      color: var(--ink-muted); line-height: 1.8; max-width: 500px;
    }

    /* row layout for section header + action */
    .sec-head-row {
      display: flex; align-items: flex-end;
      justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;
    }

    /* ════════════════════════════════════════
       SERVICES — staggered card grid
    ════════════════════════════════════════ */
    .services-bg { background: var(--parchment); }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.25rem;
    }

    .s-card {
      background: var(--white);
      border: 1px solid rgba(22, 163, 74, 0.1);
      border-radius: 16px;
      padding: 2.25rem 1.75rem 2rem;
      position: relative; overflow: hidden;
      transition: transform 0.35s cubic-bezier(.2,0,.2,1), box-shadow 0.35s;
    }
    .s-card:nth-child(2) { margin-top: 1.75rem; }
    .s-card:nth-child(3) { margin-top: 3.5rem; }

    .s-card::after {
      content: '';
      position: absolute; bottom: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--grove-mid), var(--amber-soft));
      transform: scaleX(0); transform-origin: left;
      transition: transform 0.35s ease;
    }
    .s-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-lg); }
    .s-card:hover::after { transform: scaleX(1); }

    .s-num {
      font-family: 'Cormorant Garamond', serif;
      font-size: 4rem; font-weight: 700;
      color: var(--grove-mid);
      line-height: 1; position: absolute;
      top: 1.25rem; right: 1.5rem;
      transition: color 0.35s;
    }
    .s-card:hover { color: rgba(22, 163, 74, 0.06); }

    .s-icon {
      width: 52px; height: 52px;
      border-radius: 12px;
      background: var(--parchment2);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 1.5rem;
      transition: background 0.35s;
    }
    .s-card:hover .s-icon { background: var(--grove); }
    .s-icon svg {
      width: 24px; height: 24px;
      stroke: var(--grove-mid); fill: none; stroke-width: 1.6;
      transition: stroke 0.35s;
    }
    .s-card:hover .s-icon svg { stroke: white; }

    .s-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5rem; font-weight: 700; color: var(--ink);
      margin-bottom: 0.6rem; line-height: 1.2;
    }
    .s-desc {
      font-size: 0.875rem; color: var(--ink-muted); line-height: 1.75;
      margin-bottom: 1.5rem; font-weight: 400;
    }
    .s-link {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--grove-mid);
      text-decoration: none;
      transition: gap 0.2s, color 0.2s;
    }
    .s-link:hover { gap: 10px; color: var(--grove); }
    .s-link svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    @media (max-width: 768px) {
      .services-grid { grid-template-columns: 1fr; }
      .s-card:nth-child(2), .s-card:nth-child(3) { margin-top: 0; }
    }

    /* ════════════════════════════════════════
       GALLERY CAROUSEL — masonry-feel strip
    ════════════════════════════════════════ */
    .gallery-bg { background: var(--canvas); }

    .gallery-strip {
      display: flex; gap: 1rem;
      overflow: hidden;
      cursor: grab;
      user-select: none;
    }
    .gallery-strip.dragging { cursor: grabbing; }

    .g-slide {
      flex-shrink: 0;
      border-radius: 14px; overflow: hidden;
      position: relative;
    }
    .g-slide:nth-child(odd)  { width: 340px; height: 280px; }
    .g-slide:nth-child(even) { width: 280px; height: 240px; align-self: flex-end; }

    .g-slide img {
      width: 100%; height: 100%;
      object-fit: cover; display: block;
      transition: transform 0.5s ease;
    }
    .g-slide:hover img { transform: scale(1.04); }

    .gallery-controls {
      display: flex; align-items: center; justify-content: flex-end;
      gap: 8px; margin-top: 1.5rem;
    }
    .g-btn {
      width: 42px; height: 42px; border-radius: 50%;
      border: 1px solid rgba(22, 163, 74, 0.2);
      background: var(--canvas);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; color: var(--ink-soft);
      transition: all 0.2s;
    }
    .g-btn:hover { background: var(--grove); color: var(--white); border-color: var(--grove); }
    .g-btn svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    /* ════════════════════════════════════════
       NEWS — editorial card layout
    ════════════════════════════════════════ */
    .news-bg { background: var(--parchment); }

    .news-grid {
      display: grid;
      grid-template-columns: 1.35fr 1fr 1fr;
      gap: 1.25rem;
      align-items: start;
    }

    .n-card {
      background: var(--white);
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid rgba(22, 163, 74, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .n-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); }

    /* featured card is larger */
    .n-card.featured .n-img { height: 280px; }
    .n-card.featured .n-body { padding: 2rem; }
    .n-card.featured .n-title {
      font-size: 1.45rem;
    }

    .n-img { width: 100%; height: 190px; object-fit: cover; display: block; }

    .n-body { padding: 1.4rem 1.5rem 1.5rem; }
    .n-date {
      font-size: 0.68rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: var(--grove-mid);
      display: block; margin-bottom: 0.5rem;
    }
    .n-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.2rem; font-weight: 700; color: var(--ink);
      line-height: 1.3; margin-bottom: 0.6rem;
    }
    .n-excerpt {
      font-size: 0.83rem; color: var(--ink-muted);
      line-height: 1.7; margin-bottom: 1.25rem;
    }
    .n-link {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--grove-mid); text-decoration: none;
      transition: gap 0.2s, color 0.2s;
    }
    .n-link:hover { gap: 9px; color: var(--grove); }
    .n-link svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    /* view all btn */
    .btn-dark {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--ink);
      color: var(--white);
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase;
      padding: 0.8rem 1.5rem;
      border-radius: 6px;
      text-decoration: none; border: none; cursor: pointer;
      font-family: 'Syne', sans-serif;
      transition: background 0.2s, transform 0.15s;
    }
    .btn-dark:hover { background: var(--grove); transform: translateY(-1px); }
    .btn-dark svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2.5; }

    @media (max-width: 900px) {
      .news-grid { grid-template-columns: 1fr; }
      .n-card.featured .n-img { height: 220px; }
    }

    /* ════════════════════════════════════════
       TESTIMONIALS — dark richness
    ════════════════════════════════════════ */
    .testi-bg {
      background: var(--ink);
      position: relative; overflow: hidden;
    }
    .testi-bg::before {
      content: '';
      position: absolute; top: -200px; right: -200px;
      width: 600px; height: 600px; border-radius: 50%;
      border: 1px solid rgba(196,217,188,0.07);
      pointer-events: none;
    }
    .testi-bg::after {
      content: '';
      position: absolute; bottom: -150px; left: -100px;
      width: 400px; height: 400px; border-radius: 50%;
      border: 1px solid rgba(52, 211, 153, 0.1);
      pointer-events: none;
    }

    .testi-bg .label { color: var(--amber-soft); }
    .testi-bg .sec-title { color: var(--white); }
    .testi-bg .sec-sub { color: rgba(255,255,255,0.45); }

    .testi-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.25rem;
      margin-top: 3rem;
    }

    .t-card {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.07);
      border-radius: 16px; padding: 2rem;
      transition: background 0.3s, border-color 0.3s, transform 0.3s;
      position: relative;
    }
    .t-card:hover {
      background: rgba(255,255,255,0.07);
      border-color: rgba(52, 211, 153, 0.25);
      transform: translateY(-5px);
    }

    .t-quote-mark {
      font-family: 'Cormorant Garamond', serif;
      font-size: 5rem; font-weight: 700;
      color: rgba(52, 211, 153, 0.18);
      line-height: 1; position: absolute;
      top: 1rem; right: 1.5rem;
    }

    .t-stars { display: flex; gap: 3px; margin-bottom: 1rem; }
    .t-stars svg { width: 13px; height: 13px; fill: var(--amber-soft); stroke: none; }

    .t-text {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.05rem; font-style: italic; font-weight: 400;
      color: rgba(255,255,255,0.7); line-height: 1.75;
      margin-bottom: 1.5rem;
    }

    .t-author { display: flex; align-items: center; gap: 10px; }
    .t-av {
      width: 38px; height: 38px; border-radius: 50%;
      background: var(--grove);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.1rem; font-weight: 700; color: var(--amber-soft);
      flex-shrink: 0;
    }
    .t-name { font-size: 0.85rem; font-weight: 700; color: var(--white); }
    .t-role { font-size: 0.72rem; color: rgba(255,255,255,0.35); margin-top: 2px; letter-spacing: 0.04em; }

    /* trust bar */
    .trust-bar {
      display: flex; align-items: center; justify-content: center;
      gap: 1.5rem; margin-top: 3rem; padding-top: 2.5rem;
      border-top: 1px solid rgba(255,255,255,0.07);
      flex-wrap: wrap;
    }
    .trust-item { display: flex; align-items: center; gap: 8px; }
    .trust-item .t-stars { margin-bottom: 0; }
    .trust-sep { width: 1px; height: 24px; background: rgba(255,255,255,0.12); }
    .trust-text { font-size: 0.8rem; font-weight: 600; color: rgba(255,255,255,0.5); letter-spacing: 0.04em; }

    @media (max-width: 900px) { .testi-grid { grid-template-columns: 1fr; } }

    /* ════════════════════════════════════════
       CHATBOT
    ════════════════════════════════════════ */
    .chat-fab {
      position: fixed; bottom: 2rem; right: 2rem;
      width: 54px; height: 54px; border-radius: 50%;
      background: var(--grove);
      border: none; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 8px 28px rgba(22, 163, 74, 0.4);
      z-index: 300; transition: background 0.2s, transform 0.2s;
    }
    .chat-fab:hover { background: var(--grove-mid); transform: scale(1.06); }
    .chat-fab svg { width: 22px; height: 22px; stroke: #fff; fill: none; stroke-width: 2; }

    .chat-widget {
      position: fixed; bottom: 5.25rem; right: 2rem;
      width: 350px; max-width: calc(100vw - 2rem);
      background: var(--white);
      border: 1px solid rgba(22, 163, 74, 0.12);
      border-radius: 18px;
      box-shadow: var(--shadow-lg);
      display: none; flex-direction: column;
      overflow: hidden; z-index: 299;
    }
    .chat-widget.open { display: flex; animation: chatPop 0.28s ease; }
    @keyframes chatPop {
      from { opacity: 0; transform: scale(0.9) translateY(10px); }
      to   { opacity: 1; transform: none; }
    }

    .cw-head {
      background: var(--grove);
      padding: 0.9rem 1.1rem;
      display: flex; align-items: center; gap: 10px;
    }
    .cw-av {
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--grove-mid);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Cormorant Garamond', serif;
      font-size: 1rem; font-weight: 700; color: var(--amber-soft);
      flex-shrink: 0;
    }
    .cw-name { font-size: 0.85rem; font-weight: 700; color: #fff; }
    .cw-status { font-size: 0.67rem; color: var(--moss); display: flex; align-items: center; gap: 4px; }
    .cw-status::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--moss); display: inline-block; }
    .cw-info { flex: 1; }
    .cw-close { background: none; border: none; cursor: pointer; color: rgba(255,255,255,0.6); line-height: 1; padding: 2px; }
    .cw-close:hover { color: #fff; }
    .cw-close svg { width: 16px; height: 16px; stroke: currentColor; fill: none; }

    .cw-msgs {
      flex: 1; padding: 1rem; height: 270px;
      overflow-y: auto; display: flex; flex-direction: column; gap: 0.65rem;
      background: var(--canvas);
    }
    .cw-msgs::-webkit-scrollbar { width: 4px; }
    .cw-msgs::-webkit-scrollbar-thumb { background: var(--moss); border-radius: 4px; }

    .msg-b, .msg-u {
      max-width: 82%; padding: 0.6rem 0.85rem;
      border-radius: 10px; font-size: 0.845rem; line-height: 1.55;
    }
    .msg-b { background: var(--white); border: 1px solid var(--parchment2); color: var(--ink); align-self: flex-start; border-bottom-left-radius: 3px; }
    .msg-u { background: var(--grove); color: #fff; align-self: flex-end; border-bottom-right-radius: 3px; }

    .cw-form {
      padding: 0.65rem;
      border-top: 1px solid var(--parchment2);
      background: var(--white);
      display: flex; gap: 7px;
    }
    .cw-input {
      flex: 1; border: 1.5px solid var(--parchment2);
      border-radius: 8px; padding: 0.5rem 0.8rem;
      font-family: 'Syne', sans-serif; font-size: 0.83rem;
      outline: none; background: var(--canvas); color: var(--ink);
      transition: border-color 0.2s;
    }
    .cw-input:focus { border-color: var(--grove-light); background: #fff; }
    .cw-send {
      width: 36px; height: 36px; border-radius: 8px;
      background: var(--grove); border: none; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.2s;
    }
    .cw-send:hover { background: var(--grove-mid); }
    .cw-send svg { width: 15px; height: 15px; stroke: #fff; fill: none; stroke-width: 2; }

    /* ════════════════════════════════════════
       LOGOUT MODAL
    ════════════════════════════════════════ */
    .modal-bg {
      position: fixed; inset: 0;
      background: rgba(26, 46, 30, 0.55);
      backdrop-filter: blur(4px);
      z-index: 500;
      display: none; align-items: center; justify-content: center;
    }
    .modal-bg.open { display: flex; }

    .modal-box {
      background: var(--white);
      border-radius: 18px; padding: 2.25rem;
      width: 380px; max-width: 90vw;
      box-shadow: var(--shadow-lg);
      text-align: center;
      animation: chatPop 0.28s ease;
    }
    .modal-icon {
      width: 52px; height: 52px; border-radius: 14px;
      background: #fff0ee; margin: 0 auto 1.25rem;
      display: flex; align-items: center; justify-content: center;
    }
    .modal-icon svg { width: 24px; height: 24px; stroke: #c0392b; fill: none; stroke-width: 2; }
    .modal-h {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5rem; font-weight: 700; color: var(--ink);
      margin-bottom: 0.5rem;
    }
    .modal-p { font-size: 0.875rem; color: var(--ink-muted); line-height: 1.65; margin-bottom: 1.75rem; }
    .modal-btns { display: flex; gap: 10px; justify-content: center; }
    .btn-ghost {
      padding: 0.65rem 1.4rem; border-radius: 8px;
      border: 1.5px solid rgba(22, 163, 74, 0.2);
      background: transparent; color: var(--ink-soft);
      font-family: 'Syne', sans-serif; font-size: 0.83rem; font-weight: 600;
      cursor: pointer; transition: background 0.2s;
    }
    .btn-ghost:hover { background: var(--parchment2); }
    .btn-danger {
      padding: 0.65rem 1.4rem; border-radius: 8px;
      border: none; background: #c0392b; color: #fff;
      font-family: 'Syne', sans-serif; font-size: 0.83rem; font-weight: 700;
      cursor: pointer; text-decoration: none; display: inline-block;
      transition: background 0.2s;
    }
    .btn-danger:hover { background: #a93226; }

    /* ════════════════════════════════════════
       FOOTER
    ════════════════════════════════════════ */
    footer {
      background: #0d1f10;
      padding: 64px 0 28px;
      border-top: 4px solid var(--grove);
    }
    .footer-grid {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1fr;
      gap: 3rem; margin-bottom: 3rem;
    }
    /* FIX: footer logo badge */
    .f-brand .logo-badge {
      width: 40px; height: 40px;
      padding: 5px;
    }
    .f-brand .logo-name { color: #fff; font-size: 1.25rem; margin-top: 15px; margin-left: 12px;}
    .f-tagline {
      font-size: 0.83rem; color: rgba(255,255,255,0.4);
      line-height: 1.75; margin: 1rem 0 1.5rem;
    }
    .f-socials { display: flex; gap: 8px; }
    .f-social {
      width: 34px; height: 34px; border-radius: 8px;
      border: 1px solid rgba(255,255,255,0.1);
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,0.4); text-decoration: none;
      transition: all 0.2s;
    }
    .f-social:hover { background: var(--grove); border-color: var(--grove); color: #fff; }
    .f-social svg { width: 14px; height: 14px; stroke: currentColor; fill: none; }

    .f-col h5 {
      font-size: 0.68rem; font-weight: 700; letter-spacing: 0.16em;
      text-transform: uppercase; color: whitesmoke; margin-bottom: 1.25rem;
    }
    .f-col ul { list-style: none; }
    .f-col ul li { margin-bottom: 0.55rem; }
    .f-col ul li a {
      font-size: 0.83rem; color: rgba(255,255,255,0.4);
      text-decoration: none; transition: color 0.2s;
    }
    .f-col ul li a:hover { color: var(--moss); }

    .f-app { display: flex; flex-direction: column; gap: 10px; }
    .f-app a { display: inline-block; }
    .f-app img { height: 36px; border-radius: 6px; }

    .f-bottom {
      border-top: 1px solid rgba(255,255,255,0.06);
      padding-top: 1.5rem;
      display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 1rem;
    }
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
        <a href="{{ route('Under.Construction') }}">Mission & Vision</a>
        <a href="{{ route('Under.Construction') }}">Board of Directors</a>
        <a href="{{ route('Under.Construction') }}">Committee Officers</a>
      </div>
    </div>

    <a href="{{ route('Member.NewsEvents') }}">News & Events</a>
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
      <a href="{{ route('Under.Construction') }}">Deposits</a>
      <a href="{{ route('Under.Construction') }}">Savings</a>
    </div>
  </div>
  <div class="mobile-nav-group">
    <button onclick="this.nextElementSibling.classList.toggle('open')">About</button>
    <div class="mobile-sub">
      <a href="{{ route('Member.AboutUs') }}">About GBLDC</a>
      <a href="{{ route('Under.Construction') }}">Mission & Vision</a>
      <a href="{{ route('Under.Construction') }}">Board of Directors</a>
      <a href="{{ route('Under.Construction') }}">Committee Officers</a>
    </div>
  </div>
  <a href="{{ route('Member.NewsEvents') }}">News & Events</a>
  <div class="mobile-divider"></div>
  <a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a>
  <a href="{{ route('Member.Notifications') }}">Notifications</a>
  <a href="{{ route('Member.AccountSettings') }}">Settings</a>
  <a href="{{ route('Member.ContactUs') }}">Help & Support</a>
  <a href="#" style="color:#c0392b;" onclick="openLogoutModal()">Logout</a>
</div>

<!-- ═══════════ HERO ═══════════ -->
<section class="hero">
  <div class="hero-copy">
    <div class="hero-eyebrow"><span class="dot"></span> Trusted Cooperative Since 2014</div>
    <h1 class="hero-h1">
      Your Financial<br>
      <em>Growth,</em>
      Our Priority
    </h1>
    <p class="hero-sub">
      Building stronger communities through cooperative financial services. Join thousands of members who trust us for their financial future.
    </p>
    <div class="hero-btns">
      <form action="{{ route('Redirecting.LoanApp') }}" method="GET" style="display:inline;">
        @csrf
        <input type="text" name="account" value="{{ $user_account ?? '' }}" hidden>
        <button type="submit" class="btn-cta">
          Apply for a Loan
          <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </form>
      <a href="#" class="btn-outline">
        Learn More
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
      </a>
    </div>
    <div class="hero-stats">
      <div><span class="stat-val">100</span><span class="stat-lbl">Active Members</span></div>
      <div><span class="stat-val">20+</span><span class="stat-lbl">Years of Service</span></div>
      <div><span class="stat-val">1</span><span class="stat-lbl">Branch Locations</span></div>
    </div>
    <div class="slant" aria-hidden="true"></div>
  </div>
  <div class="hero-image">
    <img src="{{ asset('images/meeting-2.png') }}" alt="GBLDC Community">
    <div class="hero-badge">
      <div class="hero-badge-icon"><i class="fas fa-shield-halved"></i></div>
      <div class="hero-badge-text">
        <strong>CDA Registered</strong>
        <span>Regulated & Secure</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ SERVICES ═══════════ -->
<section class="section services-bg">
  <div class="container">
    <div class="sec-head">
      <span class="label">What We Offer</span>
      <h2 class="sec-title display">Our Services</h2>
      <p class="sec-sub">Comprehensive financial solutions designed to meet your needs and help you achieve your goals.</p>
    </div>
    <div class="services-grid">
      <!-- Loans -->
      <div class="s-card">
        <span class="s-num">01</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M12 8v4l3 3" stroke-linecap="round"/></svg>
        </div>
        <h3 class="s-title">Flexible Loans</h3>
        <p class="s-desc">Access competitive loan rates for personal, business, or educational needs with flexible repayment terms tailored just for you.</p>
        <a href="{{ route('Member.Loans') }}" class="s-link">
          Learn More
          <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      <!-- Deposits -->
      <div class="s-card">
        <span class="s-num">02</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h3 class="s-title">Secure Deposits</h3>
        <p class="s-desc">Grow your money safely with our competitive interest rates and secure deposit options that provide lasting peace of mind.</p>
        <a href="{{ route('Under.Construction') }}" class="s-link">
          Learn More
          <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      <!-- Savings -->
      <div class="s-card">
        <span class="s-num">03</span>
        <div class="s-icon">
          <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div>
        <h3 class="s-title">Growth Savings</h3>
        <p class="s-desc">Secure your future and grow your wealth with our reliable savings options designed to help every member succeed.</p>
        <a href="{{ route('Under.Construction') }}" class="s-link">
          Learn More
          <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════ GALLERY ═══════════ -->
<section class="section gallery-bg">
  <div class="container">
    <div class="sec-head-row sec-head">
      <div>
        <span class="label">Community Spirit</span>
        <h2 class="sec-title display">Member Meetings<br>& Events</h2>
      </div>
      <p class="sec-sub" style="max-width:300px; margin-top:0;">Moments from our vibrant community of members and leaders.</p>
    </div>
  </div>

  <div style="padding: 0 2rem; overflow: hidden;">
    <div class="gallery-strip" id="gallery-strip">
      <div class="g-slide"><img src="{{ asset('images/meeting-1.png') }}" alt="Meeting 1"></div>
      <div class="g-slide"><img src="{{ asset('images/meeting-2.png') }}" alt="Meeting 2"></div>
      <div class="g-slide"><img src="{{ asset('images/meeting-3.png') }}" alt="Meeting 3"></div>
      <div class="g-slide"><img src="{{ asset('images/board-group-photo.jpg') }}" alt="Board Group"></div>
      <div class="g-slide"><img src="{{ asset('images/event4.jpg') }}" alt="Event 4"></div>
      <div class="g-slide"><img src="{{ asset('images/event2.jpg') }}" alt="Event 5"></div>
      <div class="g-slide"><img src="{{ asset('images/event3.jpg') }}" alt="Event 6"></div>
    </div>
  </div>

  <div class="container">
    <div class="gallery-controls">
      <button class="g-btn" id="g-prev">
        <svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <button class="g-btn" id="g-next">
        <svg viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>
  </div>
</section>

<!-- ═══════════ NEWS ═══════════ -->
<section class="section news-bg">
  <div class="container">
    <div class="sec-head-row sec-head">
      <div>
        <span class="label">Stay Informed</span>
        <h2 class="sec-title display">Latest News<br>& Updates</h2>
      </div>
      <a href="{{ route('Member.NewsEvents') }}" class="btn-dark">
        View All News
        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    <div class="news-grid">
      <article class="n-card featured">
        <img src="{{ asset('images/event1.jpg') }}" alt="Event 1" class="n-img">
        <div class="n-body">
          <span class="n-date">March 22, 2024</span>
          <h3 class="n-title">22nd Annual General Assembly of Greater Bulacan LDC</h3>
          <p class="n-excerpt">Held at Cafe De Apati, Makinabang, Baliuag, Bulacan. An engaging discussion on cooperative development and future initiatives for all members.</p>
          <a href="#" class="n-link">Read Full Story <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </article>
      <!-- Article 2 -->
      <article class="n-card">
        <img src="{{ asset('images/event2.jpg') }}" alt="Event 2" class="n-img">
        <div class="n-body">
          <span class="n-date">August 15, 2025</span>
          <h3 class="n-title">Coop Parade & Launching of Go Koop</h3>
          <p class="n-excerpt">Empowering cooperatives in celebration of Cooperative Month 2023.</p>
          <a href="#" class="n-link">Read Full Story <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </article>
      <!-- Article 3 -->
      <article class="n-card">
        <img src="{{ asset('images/event3.jpg') }}" alt="Event 3" class="n-img">
        <div class="n-body">
          <span class="n-date">April 12–13, 2025</span>
          <h3 class="n-title">Family Outing and Team Building</h3>
          <p class="n-excerpt">A day of fun bonding activities to strengthen our cooperative spirit and teamwork.</p>
          <a href="#" class="n-link">Read Full Story <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ═══════════ TESTIMONIALS ═══════════ -->
<section class="section testi-bg">
  <div class="container">
    <div class="sec-head-row sec-head">
      <div>
        <span class="label">Member Voices</span>
        <h2 class="sec-title display" style="color:var(--white);">What Our Members Say</h2>
        <p class="sec-sub" style="color:rgba(255,255,255,0.45);">Real stories from the people we've had the privilege of serving.</p>
      </div>
      <a href="{{ route('Member.Testimonials') }}" class="btn-dark" style="background:var(--white);color:var(--ink);">
        View All Testimonials
        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    <div class="testi-grid">
      @if(isset($webContents['testimonial']) && $webContents['testimonial']->count() > 0)
        @foreach($webContents['testimonial']->take(3) as $testimonial)
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
            <div><div class="t-name">{{ $testimonial->title }}</div><div class="t-role">{{ $testimonial->subtitle ?? 'Member' }}</div></div>
          </div>
        </div>
        @endforeach
      @else
      <div class="t-card">
        <span class="t-quote-mark">"</span>
        <div class="t-stars">
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <p class="t-text">"Kung sa trabaho, halos malaki na din ang nawala sa akin. Pinagpapasalamat ko po sa GBLDC anuman pong naiabot na tulong para makaraos din."</p>
        <div class="t-author">
          <div class="t-av">J</div>
          <div><div class="t-name">Joselito D.C. Gutierrez</div><div class="t-role">Member, Poblacion Branch</div></div>
        </div>
      </div>

      <div class="t-card">
        <span class="t-quote-mark">"</span>
        <div class="t-stars">
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <p class="t-text">"Napakaganda ng serbisyo ng GBLDC. Nakatulong talaga sa pagpapalaki ng aming negosyo. Ang mga staff ay napakabait at handang tumulong. Salamat!"</p>
        <div class="t-author">
          <div class="t-av">M</div>
          <div><div class="t-name">Maria C. Santos</div><div class="t-role">Business Owner, Baliuag Branch</div></div>
        </div>
      </div>

      <div class="t-card">
        <span class="t-quote-mark">"</span>
        <div class="t-stars">
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <p class="t-text">"Matagal na akong miyembro ng GBLDC at nakita ko kung paano lumago ang kooperatiba. Ang savings programs ay nakatulong sa amin na ma-secure ang future ng pamilya."</p>
        <div class="t-author">
          <div class="t-av">R</div>
          <div><div class="t-name">Roberto M. Cruz</div><div class="t-role">Senior Member, Main Branch</div></div>
        </div>
      </div>
      @endif
    </div>

    <div class="trust-bar">
      <div class="trust-item">
        <div class="t-stars">
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:var(--amber-soft);stroke:none;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:var(--amber-soft);stroke:none;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:var(--amber-soft);stroke:none;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:var(--amber-soft);stroke:none;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:var(--amber-soft);stroke:none;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
      </div>
      <div class="trust-sep"></div>
      <span class="trust-text">Trusted by 100+ active members</span>
      <div class="trust-sep"></div>
      <span class="trust-text">CDA Registered Cooperative</span>
    </div>
  </div>
</section>

<!-- ═══════════ CHATBOT ═══════════ -->
<button class="chat-fab" onclick="toggleChat()" aria-label="Chat with GBLDC">
  <svg id="chat-icon" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
</button>

<div class="chat-widget" id="chat-widget">
  <div class="cw-head">
    <div class="cw-av">GB</div>
    <div class="cw-info">
      <div class="cw-name">GBLDC Assistant</div>
      <div class="cw-status">Online</div>
    </div>
    <button class="cw-close" onclick="toggleChat()">
      <svg viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>
  </div>
  <div class="cw-msgs" id="cw-msgs">
    <div class="msg-b">Welcome to GBLDC! 👋 How can I assist you today with your cooperative needs?</div>
  </div>
  <div class="cw-form">
    <input class="cw-input" id="cw-input" type="text" placeholder="Type your message…" onkeydown="if(event.key==='Enter')sendMsg()">
    <button class="cw-send" onclick="sendMsg()">
      <svg viewBox="0 0 24 24"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
  </div>
</div>

<!-- ═══════════ LOGOUT MODAL ═══════════ -->
<div class="modal-bg" id="logout-modal">
  <div class="modal-box">
    <div class="modal-icon">
      <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <h3 class="modal-h">Confirm Logout</h3>
    <p class="modal-p">Are you sure you want to end your session? You'll need to sign in again to access your member dashboard.</p>
    <div class="modal-btns">
      <button class="btn-ghost" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{ route('Landing.Page') }}" class="btn-danger">Yes, Log Out</a>
    </div>
  </div>
</div>

<!-- ═══════════ FOOTER ═══════════ -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="f-brand">
        <a href="#" class="logo" style="margin-bottom:0.5rem;">
          <div class="logo-badge"><img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"></div>
          <span class="logo-name" style="color:#fff;">GBLDC</span>
        </a>
        <p class="f-tagline">Greater Bulacan Livelihood Development Cooperative — empowering communities through cooperative financial services since 2025.</p>
        <div class="f-socials">
          <a href="#" class="f-social"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="#" class="f-social"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
        </div>
      </div>
      <div class="f-col">
        <h5>Services</h5>
        <ul>
          <li><a href="{{ route('Member.Loans') }}">Loan Services</a></li>
          <li><a href="{{ route('Under.Construction') }}">Deposit Services</a></li>
          <li><a href="{{ route('Under.Construction') }}">Savings Services</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>About</h5>
        <ul>
          <li><a href="{{ route('Member.AboutUs') }}">About GBLDC</a></li>
          <li><a href="{{ route('Under.Construction') }}">Senior Management</a></li>
          <li><a href="{{ route('Under.Construction') }}">Officers & Committees</a></li>
          <li><a href="{{ route('Under.Construction') }}">About Membership</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="https://ifernglobal.com.ph/" target="_blank">iFern Global</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Apply Now</a></li>
          <li><a href="#">Feedback</a></li>
        </ul>
      </div>
    </div>
    <div class="f-bottom">
      <span class="f-copy">© {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative. All rights reserved.</span>
      <div class="f-legal">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>

<script>
  // ─── MOBILE NAV ───
  function toggleMobileNav() {
    document.getElementById('mobile-nav').classList.toggle('open');
  }

  // ─── GALLERY DRAG SCROLL ───
  const strip = document.getElementById('gallery-strip');
  let isDragging = false, startX = 0, scrollLeft = 0;

  strip.addEventListener('mousedown', e => {
    isDragging = true; startX = e.pageX - strip.offsetLeft;
    scrollLeft = strip.scrollLeft; strip.classList.add('dragging');
  });
  strip.addEventListener('mouseleave', () => { isDragging = false; strip.classList.remove('dragging'); });
  strip.addEventListener('mouseup', () => { isDragging = false; strip.classList.remove('dragging'); });
  strip.addEventListener('mousemove', e => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - strip.offsetLeft;
    strip.scrollLeft = scrollLeft - (x - startX) * 1.2;
  });

  // touch support
  strip.addEventListener('touchstart', e => { startX = e.touches[0].pageX; scrollLeft = strip.scrollLeft; }, { passive: true });
  strip.addEventListener('touchmove', e => {
    const x = e.touches[0].pageX;
    strip.scrollLeft = scrollLeft - (x - startX);
  }, { passive: true });

  document.getElementById('g-prev').addEventListener('click', () => {
    strip.scrollBy({ left: -340, behavior: 'smooth' });
  });
  document.getElementById('g-next').addEventListener('click', () => {
    strip.scrollBy({ left: 340, behavior: 'smooth' });
  });

  // allow strip to scroll horizontally
  strip.style.overflowX = 'auto';
  strip.style.scrollbarWidth = 'none';
  strip.style.msOverflowStyle = 'none';
  strip.style.flexWrap = 'nowrap';
  strip.style.paddingBottom = '4px';

  // hide scrollbar
  const styleEl = document.createElement('style');
  styleEl.textContent = '#gallery-strip::-webkit-scrollbar { display: none; }';
  document.head.appendChild(styleEl);

  // ─── CHATBOT ───
  function toggleChat() {
    document.getElementById('chat-widget').classList.toggle('open');
  }
  function sendMsg() {
    const inp = document.getElementById('cw-input');
    const msgs = document.getElementById('cw-msgs');
    const txt = inp.value.trim(); if (!txt) return;
    const u = document.createElement('div');
    u.className = 'msg-u'; u.textContent = txt;
    msgs.appendChild(u); inp.value = ''; msgs.scrollTop = msgs.scrollHeight;
    setTimeout(() => {
      const b = document.createElement('div');
      b.className = 'msg-b';
      b.textContent = 'Thank you! A GBLDC representative will get back to you shortly.';
      msgs.appendChild(b); msgs.scrollTop = msgs.scrollHeight;
    }, 750);
  }

  // ─── LOGOUT MODAL ───
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
<!-- ═══════════ COOKIE CONSENT ═══════════ -->
<div class="cookie-banner" id="cookieBanner">
  <div class="cb-content">
    <div class="cb-icon">
      <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div class="cb-text">
      <h4>We Value Your Privacy</h4>
      <p>GBLDC uses cookies to ensure you get the best experience on our cooperative portal. By continuing to use our site, you agree to our <a href="{{ route('Under.Construction') }}">Cookie Policy</a>.</p>
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

@php
  $unreadEligibility = false;
  if(isset($user_account) && isset($user_account->member_id)) {
      $unreadEligibility = \App\Models\Notification::where('member_id', $user_account->member_id)
          ->where('type', 'loan_eligibility')
          ->where('is_read', false)
          ->exists();
  }
@endphp
<!-- Toast Notifications -->
<div id="toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px;">
  @if(session('success') || session('Record-updated'))
    <div class="toast success" style="background: white; border-left: 4px solid #10b981; padding: 16px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: flex-start; gap: 12px; animation: slideInRight 0.3s ease forwards;">
      <i data-lucide="check-circle" style="color: #10b981; width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
      <div>
        <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #111827;">Success</h4>
        <p style="margin: 4px 0 0; font-size: 13px; color: #4b5563;">{{ session('success') ?? session('Record-updated') }}</p>
      </div>
      <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0; margin-left: auto;"><i data-lucide="x" style="width: 16px; height: 16px;"></i></button>
    </div>
  @endif

  @if(session('error'))
    <div class="toast error" style="background: white; border-left: 4px solid #ef4444; padding: 16px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: flex-start; gap: 12px; animation: slideInRight 0.3s ease forwards;">
      <i data-lucide="alert-circle" style="color: #ef4444; width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
      <div>
        <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #111827;">Error</h4>
        <p style="margin: 4px 0 0; font-size: 13px; color: #4b5563;">{{ session('error') }}</p>
      </div>
      <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0; margin-left: auto;"><i data-lucide="x" style="width: 16px; height: 16px;"></i></button>
    </div>
  @endif

  @if(session('loan_eligible') || $unreadEligibility)
    <div class="toast info" style="background: white; border-left: 4px solid #3b82f6; padding: 16px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: flex-start; gap: 12px; animation: slideInRight 0.3s ease forwards;">
      <i data-lucide="award" style="color: #3b82f6; width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
      <div>
        <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #111827;">Loan Eligibility Unlocked!</h4>
        <p style="margin: 4px 0 0; font-size: 13px; color: #4b5563;">Congratulations! You have paid 50% of your Shared Capital and are now eligible to apply for GBLDC loans.</p>
        <a href="{{ route('Member.Notifications') }}" style="display:inline-block; margin-top:6px; font-size:12px; color:#3b82f6; text-decoration:underline;">View Details</a>
      </div>
      <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0; margin-left: auto;"><i data-lucide="x" style="width: 16px; height: 16px;"></i></button>
    </div>
  @endif
</div>

<style>
@keyframes slideInRight {
  from { transform: translateX(100%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}
@keyframes fadeOut {
  from { opacity: 1; }
  to { opacity: 0; }
}
</style>
<script>
  setTimeout(() => {
    document.querySelectorAll('.toast').forEach(t => {
      t.style.animation = 'fadeOut 0.5s ease forwards';
      setTimeout(() => t.remove(), 500);
    });
  }, 5000);
  
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
</script>
</body>
</html>