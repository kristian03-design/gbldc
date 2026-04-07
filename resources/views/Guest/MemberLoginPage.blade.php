<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Member Login | GBLDC Member</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-deep:   #145a32;
      --green-mid:    #1e8449;
      --green-bright: #27ae60;
      --green-light:  #a9dfbf;
      --green-pale:   #eafaf1;
      --gold:         #f0b429;
      --gold-light:   #fef3c7;
      --text-dark:    #0d1f17;
      --text-mid:     #2c5f42;
      --text-soft:    #5d7a68;
      --white:        #ffffff;
      --off-white:    #f8fdf9;
    }

    html, body {
      height: 100%;
      width: 100%;
      overflow: hidden;
    }

    body {
      font-family: 'Outfit', sans-serif;
      background: var(--off-white);
      display: flex;
    }

    /* ── LAYOUT ── */
    .page-wrapper {
      display: flex;
      width: 100vw;
      height: 100vh;
    }

    /* ── LEFT PANEL ── */
    .left-panel {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 0 6vw;
      background: var(--white);
      position: relative;
      overflow: hidden;
      z-index: 2;
    }

    /* subtle background */
    .left-panel::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 55% 45% at 100% 0%, #d5f5e3 0%, transparent 65%),
        radial-gradient(ellipse 45% 45% at 0% 100%, #eafaf1 0%, transparent 60%),
        radial-gradient(ellipse 30% 30% at 50% 50%, #f0fbf4 0%, transparent 70%);
      pointer-events: none;
      z-index: 0;
    }

    .left-content {
      position: relative;
      z-index: 1;
      max-width: 480px;
      width: 100%;
    }

    /* ── LOGO AREA ── */
    .logo-area {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 40px;
    }

    .logo-ring {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      padding: 3px;
      flex-shrink: 0;
      overflow: hidden;
      background: var(--white);
    }

    .logo-ring img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .logo-text-block {}
    .logo-name {
      font-family: 'DM Serif Display', serif;
      font-size: 1.2rem;
      color: var(--green-deep);
      line-height: 1.2;
      letter-spacing: 0.01em;
    }
    .logo-sub {
      font-size: 0.7rem;
      color: var(--text-soft);
      font-weight: 400;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      margin-top: 2px;
    }

    /* ── HEADING ── */
    .greeting {
      font-size: 0.78rem;
      font-weight: 500;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--green-bright);
      margin-bottom: 8px;
    }

    .headline {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(2rem, 3.5vw, 2.8rem);
      color: var(--text-dark);
      line-height: 1.12;
      margin-bottom: 10px;
    }

    .headline em {
      font-style: italic;
      color: var(--green-mid);
    }

    .subheadline {
      font-size: 0.88rem;
      color: var(--text-soft);
      line-height: 1.6;
      margin-bottom: 36px;
      max-width: 340px;
    }

    /* ── DIVIDER ── */
    .divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 28px;
    }
    .divider-line { flex: 1; height: 1px; background: #d6eedd; }
    .divider-dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: var(--green-bright); opacity: .5;
    }

    /* ── FORM ── */
    .form-group { margin-bottom: 18px; }

    .form-label {
      display: block;
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--text-mid);
      letter-spacing: 0.05em;
      text-transform: uppercase;
      margin-bottom: 7px;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--green-light);
      font-size: 0.85rem;
      pointer-events: none;
      transition: color .2s;
    }

    .form-input {
      width: 100%;
      padding: 13px 42px 13px 40px;
      border: 1.5px solid #d6eedd;
      border-radius: 10px;
      background: var(--off-white);
      color: var(--text-dark);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.92rem;
      outline: none;
      transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .form-input::placeholder { color: #b2c9bb; }

    .form-input:focus {
      border-color: var(--green-bright);
      background: var(--white);
      box-shadow: 0 0 0 4px #d5f5e3;
    }

    .form-input:focus ~ .input-icon { color: var(--green-bright); }

    .toggle-pwd {
      position: absolute;
      right: 13px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #b2c9bb;
      cursor: pointer;
      padding: 4px;
      font-size: 0.85rem;
      transition: color .2s;
    }
    .toggle-pwd:hover { color: var(--green-mid); }

    /* ── REMEMBER / FORGOT ── */
    .form-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 26px;
    }

    .remember-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.82rem;
      color: var(--text-soft);
      cursor: pointer;
      user-select: none;
    }

    .remember-checkbox {
      width: 15px; height: 15px;
      accent-color: var(--green-bright);
      cursor: pointer;
    }

    .forgot-link {
      font-size: 0.82rem;
      color: var(--green-mid);
      text-decoration: none;
      font-weight: 500;
      transition: color .2s;
    }
    .forgot-link:hover { color: var(--green-deep); text-decoration: underline; }

    /* ── SUBMIT BUTTON ── */
    .btn-login {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, var(--green-mid) 0%, var(--green-deep) 100%);
      color: var(--white);
      border: none;
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 600;
      letter-spacing: 0.04em;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      position: relative;
      overflow: hidden;
      transition: transform .15s, box-shadow .2s;
      box-shadow: 0 4px 18px rgba(30,132,73,.25);
    }

    .btn-login::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,.08) 0%, transparent 60%);
      pointer-events: none;
    }

    .btn-login:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 28px rgba(30,132,73,.35);
    }

    .btn-login:active { transform: translateY(0); }

    .btn-login .btn-arrow {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 24px; height: 24px;
      border-radius: 50%;
      background: rgba(255,255,255,.18);
      font-size: 0.75rem;
      transition: transform .2s;
    }
    .btn-login:hover .btn-arrow { transform: translateX(3px); }

    /* ── SECURITY BADGES ── */
    .trust-badges {
      display: flex;
      gap: 18px;
      margin-top: 28px;
      padding-top: 22px;
      border-top: 1px solid #e8f5ee;
    }

    .badge {
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: 0.73rem;
      color: var(--text-soft);
    }

    .badge-icon {
      width: 26px; height: 26px;
      border-radius: 6px;
      background: var(--green-pale);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--green-mid);
      font-size: 0.7rem;
      flex-shrink: 0;
    }

    /* ── ERROR / FEEDBACK ── */
    .alert-error {
      background: #fff0f0;
      border: 1px solid #fca5a5;
      color: #b91c1c;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 0.82rem;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* ── FOOTER ── */
    .left-footer {
      position: absolute;
      bottom: 22px;
      left: 0; right: 0;
      text-align: center;
      font-size: 0.7rem;
      color: #b2c9bb;
      font-style: italic;
      letter-spacing: 0.02em;
    }

    /* ── BACK BUTTON ── */
    .back-btn {
      position: absolute;
      top: 24px;
      left: 28px;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--text-mid);
      text-decoration: none;
      padding: 8px 14px;
      border-radius: 8px;
      border: 1.5px solid #d6eedd;
      background: var(--white);
      transition: background 0.2s, color 0.2s, border-color 0.2s, box-shadow 0.2s;
      z-index: 10;
      letter-spacing: 0.03em;
    }
    .back-btn:hover {
      background: var(--green-pale);
      color: var(--green-mid);
      border-color: var(--green-light);
      box-shadow: 0 2px 10px rgba(39,174,96,0.12);
    }
    .back-btn i { font-size: 0.72rem; }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .logo-area      { animation: fadeUp .5s ease both; animation-delay: .05s; }
    .greeting       { animation: fadeUp .5s ease both; animation-delay: .12s; }
    .headline       { animation: fadeUp .5s ease both; animation-delay: .18s; }
    .subheadline    { animation: fadeUp .5s ease both; animation-delay: .24s; }
    .divider        { animation: fadeUp .4s ease both; animation-delay: .3s; }
    .form-group:nth-child(1) { animation: fadeUp .45s ease both; animation-delay: .34s; }
    .form-group:nth-child(2) { animation: fadeUp .45s ease both; animation-delay: .40s; }
    .form-meta      { animation: fadeUp .4s ease both; animation-delay: .46s; }
    .btn-login      { animation: fadeUp .4s ease both; animation-delay: .52s; }
    .trust-badges   { animation: fadeUp .4s ease both; animation-delay: .58s; }

    /* ── RESPONSIVE ── */
    /* Large desktop ≥ 1200px */
    @media (min-width: 1200px) {
      .left-content { max-width: 500px; }
      .headline { font-size: clamp(2.2rem, 4vw, 3rem); }
      .logo-ring { width: 72px; height: 72px; }
      .logo-name { font-size: 1.35rem; }
      .left-panel { padding: 0 8vw; }
    }

    /* Laptop 769–1199px */
    @media (min-width: 769px) and (max-width: 1199px) {
      .left-content { max-width: 460px; }
      .headline { font-size: clamp(1.8rem, 3vw, 2.4rem); }
      .logo-ring { width: 64px; height: 64px; }
      .left-panel { padding: 0 7vw; }
      .form-input { padding: 12px 40px 12px 38px; font-size: 0.9rem; }
    }

    /* Tablet 481–768px */
    @media (min-width: 481px) and (max-width: 768px) {
      .left-content { max-width: 420px; }
      .headline { font-size: clamp(1.6rem, 2.5vw, 2rem); }
      .logo-ring { width: 56px; height: 56px; }
      .logo-name { font-size: 1rem; }
      .left-panel { padding: 0 5vw; }
      .form-label { font-size: 0.75rem; }
      .form-input { padding: 11px 38px 11px 36px; font-size: 0.88rem; }
      .subheadline { font-size: 0.84rem; margin-bottom: 28px; }
      .logo-area { margin-bottom: 32px; gap: 10px; }
    }

    /* Large phone 376–480px */
    @media (min-width: 376px) and (max-width: 480px) {
      .page-wrapper { min-height: 100vh; }
      .left-panel {
        padding: 20px 16px;
        height: auto;
        min-height: 100vh;
        justify-content: flex-start;
        padding-top: 40px;
      }
      .left-content { 
        max-width: 100%;
        width: 100%; 
      }
      .headline { font-size: 1.5rem; }
      .logo-ring { width: 48px; height: 48px; }
      .logo-name { font-size: 0.9rem; }
      .form-input { 
        padding: 12px 36px 12px 34px; 
        font-size: 0.88rem;
        border-radius: 8px;
      }
      .subheadline { font-size: 0.8rem; margin-bottom: 24px; }
      .logo-area { margin-bottom: 28px; gap: 10px; }
      .left-footer { bottom: 16px; }
    }

    /* Small phone ≤ 375px */
    @media (max-width: 375px) {
      * { margin: 0; padding: 0; box-sizing: border-box; }
      html, body { 
        height: 100%;
        width: 100%;
        overflow-x: hidden;
      }
      .page-wrapper { 
        width: 100vw;
        min-height: 100vh;
        flex-direction: column;
      }
      .left-panel {
        width: 100vw;
        height: auto;
        min-height: 100vh;
        padding: 16px 14px;
        justify-content: flex-start;
        padding-top: 30px;
        flex: none;
      }
      .left-content {
        max-width: 100%;
        width: 100%;
      }
      .headline { 
        font-size: 1.35rem; 
        margin-bottom: 8px;
      }
      .logo-ring { 
        width: 44px; 
        height: 44px; 
      }
      .logo-name { 
        font-size: 0.8rem; 
      }
      .logo-sub { 
        font-size: 0.65rem; 
      }
      .subheadline { 
        font-size: 0.75rem; 
        margin-bottom: 20px; 
        max-width: 100%;
      }
      .logo-area { 
        margin-bottom: 24px; 
        gap: 8px; 
      }
      .form-input {
        padding: 12px 34px 12px 32px;
        font-size: 16px; /* Prevent iOS auto-zoom */
        border: 1.5px solid #d6eedd;
        border-radius: 8px;
      }
      .form-input:focus { box-shadow: 0 0 0 3px #d5f5e3; }
      .form-label { 
        font-size: 0.72rem;
        margin-bottom: 5px;
      }
      .form-group { margin-bottom: 14px; }
      .form-meta { margin-bottom: 20px; }
      .divider { margin-bottom: 20px; }
      .divider-line { height: 1px; }
      .badge {
        font-size: 0.65rem;
        gap: 5px;
      }
      .badge-icon {
        width: 22px;
        height: 22px;
        font-size: 0.6rem;
      }
      .badge-label { display: none; } /* Hide text labels */
      .trust-badges { 
        flex-wrap: wrap; 
        gap: 8px; 
        justify-content: center;
      }
      .btn-login { 
        padding: 11px 16px; 
        font-size: 0.9rem;
      }
      .greeting { font-size: 0.7rem; margin-bottom: 6px; }
      .left-footer { 
        font-size: 0.65rem; 
        bottom: 12px;
        margin-top: 24px;
        position: relative;
        padding-top: 16px;
        border-top: 1px solid #e8f5ee;
      }
      .input-icon { font-size: 0.75rem; }
      .toggle-pwd { font-size: 0.75rem; }
    }
  </style>
</head>
<body>
  <div class="page-wrapper">

    <!-- LEFT PANEL -->
    <div class="left-panel">
      <a href="{{ route('Landing.Page') }}" class="back-btn">
        <i class="fa fa-arrow-left"></i> Back to Home
      </a>
      <div class="left-content">

        <!-- Logo -->
        <div class="logo-area">
          <div class="logo-ring">
          <img src={{ asset('images/logocoop-removebg-preview-2.png') }} alt=""> {{ asset('images/logocoop-removebg-preview-2.png') }} 
            <img src="https://placehold.co/64x64/27ae60/ffffff?text=G" alt="GBLDC Logo">
          </div>
          <div class="logo-text-block">
            <div class="logo-name">Greater Bulacan Livelihood Development Cooperative</div>
            <div class="logo-sub">Member Portal</div>
          </div>
        </div>

        <!-- Heading -->
        <h1 class="headline">Sign in to your<br><em>Member Account</em></h1>
        <p class="subheadline">Access your cooperative services, loan applications, and financial records securely.</p>

        <div class="divider">
          <div class="divider-line"></div>
          <div class="divider-dot"></div>
          <div class="divider-line"></div>
        </div>

        <!-- FORM -->
        <form action="{{ route('Member.LoginBtn') }}" method="POST" id="MemberLoginForm" autocomplete="on">
          @csrf

          <div class="form-group">
            <label for="MemberEmail" class="form-label">Email Address</label>
            <div class="input-wrap">
              <i class="fa fa-envelope input-icon"></i>
              <input id="MemberEmail" name="username" type="email"
                value="{{ old('username') }}"
                placeholder="example@mail.com"
                class="form-input"
                required autocomplete="username">
            </div>
          </div>

          <div class="form-group">
            <label for="MemberPassword" class="form-label">Password</label>
            <div class="input-wrap">
              <i class="fa fa-lock input-icon"></i>
              <input id="MemberPassword" name="password" type="password"
                placeholder="••••••••"
                class="form-input"
                required autocomplete="current-password">
              <button type="button" class="toggle-pwd" onclick="togglePassword()" aria-label="Toggle password">
                <i id="togglePwdIcon" class="fa fa-eye"></i>
              </button>
            </div>
          </div>

          <div class="form-meta">
            <label class="remember-label">
              <input type="checkbox" class="remember-checkbox"> Remember me
            </label>
            <a href="{{ route('Member.ForgotPassword') }}" class="forgot-link">Forgot password?</a>
          </div>

          <!-- Error Message -->
          @if(session('error'))
            <div class="alert-error">
              <i class="fa fa-circle-exclamation"></i>
              <span>{{ session('error') }}</span>
            </div>
          @endif

          <button type="submit" class="btn-login" id="loginBtn">
            <span>Log in to Portal</span>
            <span class="btn-arrow"><i class="fa fa-arrow-right"></i></span>
          </button>

        </form>

      </div>
      <div class="left-footer">©2025 Greater Bulacan Livelihood Development Cooperative</div>
    </div>



  </div>

  <script>
    function togglePassword() {
      const inp  = document.getElementById('MemberPassword');
      const icon = document.getElementById('togglePwdIcon');
      if (inp.type === 'password') {
        inp.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        inp.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>
</body>
</html>
