<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <title>Under Construction | GBLDC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;0,700;1,400&family=Syne:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --ink:        #1f2937; /* gray-800 */
      --ink-muted:  #4b5563; /* gray-600 */
      --parchment:  #ffffff; /* white */
      --canvas:     #f9fafb; /* gray-50 */
      --grove:      #16a34a; /* green-600 */
      --grove-mid:  #15803d; /* green-700 */
      --amber:      #059669; /* emerald-600 */
      --amber-soft: #34d399; /* emerald-400 */
      --amber-pale: #d1fae5; /* emerald-100 */
      --moss:       #dcfce7; /* green-100 */
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Syne', sans-serif;
      background: var(--canvas);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    /* grain */
    body::after {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23g)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 99;
    }

    /* large decorative number behind card */
    .bg-num {
      position: fixed;
      font-family: 'Cormorant Garamond', serif;
      font-size: 36vw;
      font-weight: 700;
      color: rgba(22, 163, 74, 0.04);
      line-height: 1;
      user-select: none;
      pointer-events: none;
      z-index: 0;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      white-space: nowrap;
    }

    /* decorative circles */
    .ring {
      position: fixed;
      border-radius: 50%;
      pointer-events: none; z-index: 0;
    }
    .ring-1 {
      width: 600px; height: 600px;
      border: 1px solid rgba(22, 163, 74, 0.07);
      top: -200px; right: -200px;
    }
    .ring-2 {
      width: 400px; height: 400px;
      border: 1px solid rgba(5, 150, 105, 0.08);
      bottom: -150px; left: -100px;
    }

    /* card */
    .card {
      position: relative; z-index: 1;
      padding: 3.5rem 3rem;
      width: 100%; max-width: 900px; /* Make the card wider for "full page" feel */
      min-height: 600px; /* Taller card */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin: 1.5rem;
      text-align: center;
      animation: riseUp 0.65s cubic-bezier(.2,0,.2,1) both;
    }

    @keyframes riseUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* top accent bar */
    .card::before {
      content: '';
      position: absolute; top: 0; left: 2rem; right: 2rem;
      height: 4px;
      background: linear-gradient(90deg, var(--grove), var(--amber));
      border-radius: 0 0 4px 4px;
    }

    /* logo row */
    .logo-row {
      display: flex; align-items: center; justify-content: center;
      gap: 12px; margin-bottom: 2.5rem;
    }
    .logo-row img {
      width: 74px; height: 74px;
      display: flex; align-items: center; justify-content: center;
    }
    .logo-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.3rem; font-weight: 700;
      color: var(--grove); letter-spacing: 0.04em;
    }

    /* icon wrapper */
    .icon-wrap {
      width: 90px; height: 90px;
      border-radius: 20px;
      background: var(--canvas); /* Match background */
      border: 1px solid rgba(22, 163, 74, 0.15); /* Greenish border */
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 2rem;
      position: relative;
    }

    /* animated cog */
    .cog-outer {
      width: 45px; height: 45px;
      animation: spin 8s linear infinite;
    }
    .cog-inner {
      position: absolute;
      width: 20px; height: 20px;
      animation: spin-rev 5s linear infinite;
      bottom: 18px; right: 16px;
    }
    @keyframes spin     { from { transform: rotate(0deg); }   to { transform: rotate(360deg); } }
    @keyframes spin-rev { from { transform: rotate(0deg); }   to { transform: rotate(-360deg); } }

    .cog-outer svg, .cog-inner svg {
      width: 100%; height: 100%;
    }

    /* label */
    .eyebrow {
      font-size: 0.75rem; font-weight: 700;
      letter-spacing: 0.2em; text-transform: uppercase;
      color: var(--amber); /* Changed from amber to green derivative */
      display: inline-flex; align-items: center; gap: 8px;
      margin-bottom: 1rem;
    }
    .eyebrow::before, .eyebrow::after {
      content: '';
      display: inline-block;
      width: 30px; height: 1px;
      background: var(--amber-soft);
    }

    h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 3rem; font-weight: 700;
      color: var(--ink); line-height: 1.1;
      letter-spacing: -0.01em;
      margin-bottom: 1.25rem;
    }
    h1 em { font-style: italic; color: var(--grove); }

    p {
      font-size: 1rem; font-weight: 400;
      color: var(--ink-muted); line-height: 1.8;
      max-width: 480px; margin: 0 auto 2.5rem;
    }

    /* progress bar */
    .progress-wrap {
      background: var(--canvas); /* Match canvas instead of parchment */
      border-radius: 999px; height: 6px;
      overflow: hidden; margin-bottom: 2rem;
      width: 100%; max-width: 360px;
      margin-left: auto; margin-right: auto;
    }
    .progress-bar {
      height: 100%;
      background: linear-gradient(90deg, var(--grove), var(--amber));
      border-radius: 999px;
      width: 0%;
      animation: loadUp 2.5s 0.5s cubic-bezier(.4,0,.2,1) forwards;
    }
    @keyframes loadUp { to { width: 68%; } }

    .progress-label {
      font-size: 0.75rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase; color: var(--ink-muted);
      margin-bottom: 0.75rem; display: flex;
      justify-content: space-between;
      width: 100%; max-width: 360px;
      margin-left: auto; margin-right: auto;
    }
    .progress-label span:last-child { color: var(--grove); font-weight: 800;}

    /* back button */
    .btn-back {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--grove);
      color: #fff;
      font-size: 0.8rem; font-weight: 700; letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 0.9rem 2rem;
      border-radius: 8px;
      text-decoration: none;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .btn-back:hover {
      background: var(--grove-mid);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(22, 163, 74, 0.28);
    }
    .btn-back svg {
      width: 16px; height: 16px;
      stroke: currentColor; fill: none; stroke-width: 2.5;
    }

    /* divider */
    .divider {
      height: 1px; background: rgba(31, 41, 55, 0.08);
      margin: 2.5rem 0;
      width: 100%;
    }

    .footer-note {
      font-size: 0.8rem; color: var(--ink-muted);
      letter-spacing: 0.04em;
    }
    .footer-note a {
      color: var(--grove-mid); text-decoration: none; font-weight: 600;
    }
    .footer-note a:hover { text-decoration: underline; }
  </style>
</head>
<body>

  <div class="bg-num" aria-hidden="true">⚙</div>
  <div class="ring ring-1" aria-hidden="true"></div>
  <div class="ring ring-2" aria-hidden="true"></div>

  <div class="card">

    <!-- Animated icon -->
    <div class="icon-wrap">
      <div class="cog-outer">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5">
          <path stroke="var(--grove)" stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
          <circle cx="12" cy="12" r="3" stroke="var(--grove)"/>
        </svg>
      </div>
      <div class="cog-inner">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <path stroke="var(--amber)" stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
          <circle cx="12" cy="12" r="3" stroke="var(--amber)"/>
        </svg>
      </div>
    </div>

    <!-- Text -->
    <div class="eyebrow">Under Construction</div>
    <h1>We're Building<br><em>Something New</em></h1>
    <p>This page is currently being crafted. Our team is working hard to bring you new features and an improved experience. Please check back soon.</p>

    <!-- Progress -->
    <div class="progress-label">
      <span>Build Progress</span>
      <span>68%</span>
    </div>
    <div class="progress-wrap">
      <div class="progress-bar"></div>
    </div>

    <!-- CTA -->
    <a href="{{ route('Landing.Page') }}" class="btn-back">
      <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Back to Landing Page
    </a>

    <div class="divider"></div>

    <p class="footer-note">
      Need help? <a href="#">Contact our support team</a>
    </p>
  </div>

</body>
</html>
