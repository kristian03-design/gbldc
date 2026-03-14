<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Reset Password | GBLDC Member</title>
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
    
    .form-input.readonly-input {
      background-color: #f3f4f6; color: #6b7280; border-color: #e5e7eb; cursor: not-allowed;
    }

    .form-input::placeholder { color: #b2c9bb; }

    .form-input:not(.readonly-input):focus {
      border-color: var(--green-bright);
      background: var(--white);
      box-shadow: 0 0 0 4px #d5f5e3;
    }

    .form-input:not(.readonly-input):focus ~ .input-icon { color: var(--green-bright); }

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

    /* ── SUBMIT BUTTON ── */
    .btn-login {
      width: 100%;
      margin-top: 30px;
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

    /* ── ERROR ── */
    .alert-error {
      background: #fff0f0;
      border: 1px solid #fca5a5;
      color: #b91c1c;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 0.82rem;
      margin-bottom: 16px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }

    /* ── PASSWORD CHECKLIST ── */
    .pw-checklist {
      margin-top: 10px;
      margin-bottom: 6px;
      padding: 0 4px;
      display: flex;
      flex-direction: column;
      gap: 6px;
      opacity: 0;
      max-height: 0;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
    }
    .pw-checklist.show-checklist {
      opacity: 1;
      max-height: 200px;
    }
    .check-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.8rem;
      color: #9ca3af; /* Default gray/invalid */
      transition: color 0.3s;
    }
    .check-item i {
      font-size: 0.85rem;
      width: 14px;
      text-align: center;
    }
    .check-item.valid {
      color: var(--green-bright);
    }
    .check-item.valid i::before {
      content: "\f00c"; /* fa-check */
    }
    .check-item.invalid i::before {
      content: "\f00d"; /* fa-xmark */
    }

    /* ── BACK LINK ── */
    .back-link {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 0.85rem; font-weight: 500; color: var(--text-soft);
      text-decoration: none; margin-bottom: 22px;
      padding: 6px 10px; border-radius: 8px; margin-left: -10px;
      transition: background .15s, color .15s;
    }
    .back-link:hover { background: var(--green-pale); color: var(--green-deep); }
    .back-link i { font-size: 0.8rem; }

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

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .logo-area      { animation: fadeUp .5s ease both; animation-delay: .05s; }
    .headline       { animation: fadeUp .5s ease both; animation-delay: .18s; }
    .subheadline    { animation: fadeUp .5s ease both; animation-delay: .24s; }
    .divider        { animation: fadeUp .4s ease both; animation-delay: .3s; }
    .form-group     { animation: fadeUp .45s ease both; animation-delay: .34s; }
    .btn-login      { animation: fadeUp .4s ease both; animation-delay: .4s; }

    /* ── RESPONSIVE ── */
    @media (min-width: 1200px) {
      .left-content { max-width: 500px; }
      .headline { font-size: clamp(2.2rem, 4vw, 3rem); }
      .logo-ring { width: 72px; height: 72px; }
      .left-panel { padding: 0 8vw; }
    }
    @media (min-width: 769px) and (max-width: 1199px) {
      .left-content { max-width: 460px; }
      .headline { font-size: clamp(1.8rem, 3vw, 2.4rem); }
      .logo-ring { width: 64px; height: 64px; }
      .left-panel { padding: 0 7vw; }
    }
    @media (min-width: 481px) and (max-width: 768px) {
      .left-content { max-width: 420px; }
      .headline { font-size: clamp(1.6rem, 2.5vw, 2rem); }
      .logo-ring { width: 56px; height: 56px; }
      .left-panel { padding: 0 5vw; }
    }
    @media (max-width: 480px) {
      .page-wrapper { min-height: 100vh; flex-direction: column; }
      .left-panel {
        width: 100vw; height: auto; min-height: 100vh;
        padding: 40px 20px 80px; justify-content: flex-start; flex: none;
      }
      .left-content { max-width: 100%; width: 100%; }
      .headline { font-size: 1.5rem; }
      .logo-ring { width: 48px; height: 48px; }
      .left-footer { bottom: 16px; position: relative; padding-top: 30px;}
    }
  </style>
</head>
<body>
  <div class="page-wrapper">

    <!-- LEFT PANEL -->
    <div class="left-panel">
      <div class="left-content">

        <!-- Logo -->
        <div class="logo-area">
          <div class="logo-ring">
            <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
          </div>
          <div class="logo-text-block">
            <div class="logo-name">Greater Bulacan Livelihood Development Cooperative</div>
            <div class="logo-sub">Member Portal</div>
          </div>
        </div>

        <a href="{{ route('Member.Login') }}" class="back-link">
          <i class="fa fa-arrow-left"></i> Back to login
        </a>

        <!-- Heading -->
        <h1 class="headline">Reset your <em>password</em></h1>
        <p class="subheadline">Please enter a new password for your account below. Make sure it's secure.</p>

        <div class="divider">
          <div class="divider-line"></div>
          <div class="divider-dot"></div>
          <div class="divider-line"></div>
        </div>

        @if($errors->any())
        <div class="alert-error">
          <i class="fa fa-circle-exclamation mt-1"></i>
          <div>
            <div style="font-weight: 600; margin-bottom: 4px;">Please fix the following issues:</div>
            <ul style="margin-left: 20px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('Member.ResetPassword.Save') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

           <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <div class="input-wrap">
              <i class="fa fa-envelope input-icon"></i>
              <input id="email" name="email" type="email"
                value="{{ old('email', $email) }}"
                readonly
                class="form-input readonly-input"
                required autocomplete="email">
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="form-label">New Password</label>
            <div class="input-wrap">
              <i class="fa fa-lock input-icon"></i>
              <input id="password" name="password" type="password"
                placeholder="••••••••"
                class="form-input"
                required autocomplete="new-password">
              <button type="button" class="toggle-pwd" onclick="togglePassword('password', 'togglePwdIcon1')" aria-label="Toggle password">
                <i id="togglePwdIcon1" class="fa fa-eye"></i>
              </button>
            </div>
            
            <div class="pw-checklist" id="pwChecklist">
              <div class="check-item invalid" id="req-lower">
                <i class="fa fa-xmark"></i> At least one lowercase letter
              </div>
              <div class="check-item invalid" id="req-len">
                <i class="fa fa-xmark"></i> Minimum 8 characters
              </div>
              <div class="check-item invalid" id="req-upper">
                <i class="fa fa-xmark"></i> At least one uppercase letter
              </div>
              <div class="check-item invalid" id="req-num">
                <i class="fa fa-xmark"></i> At least one number
              </div>
              <div class="check-item invalid" id="req-sym">
                <i class="fa fa-xmark"></i> At least one symbol
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-wrap">
              <i class="fa fa-check input-icon"></i>
              <input id="password_confirmation" name="password_confirmation" type="password"
                placeholder="••••••••"
                class="form-input"
                required autocomplete="new-password">
              <button type="button" class="toggle-pwd" onclick="togglePassword('password_confirmation', 'togglePwdIcon2')" aria-label="Toggle password">
                <i id="togglePwdIcon2" class="fa fa-eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="btn-login" id="loginBtn">
            <span>Reset Password</span>
          </button>

        </form>

      </div>
      <div class="left-footer">©2025 Greater Bulacan Livelihood Development Cooperative</div>
    </div>

  </div>

  <script>
    function togglePassword(inputId, iconId) {
      const inp  = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      if (inp.type === 'password') {
        inp.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        inp.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }

    // Password Validation Logic
    const pwInput = document.getElementById('password');
    const reqLower = document.getElementById('req-lower');
    const reqLen   = document.getElementById('req-len');
    const reqUpper = document.getElementById('req-upper');
    const reqNum   = document.getElementById('req-num');
    const reqSym   = document.getElementById('req-sym');
    const pwCheck  = document.getElementById('pwChecklist');
    
    // Focus & Blur to Show/Hide Checklist
    pwInput.addEventListener('focus', () => {
      pwCheck.classList.add('show-checklist');
    });

    pwInput.addEventListener('blur', () => {
      // Always hide the checklist on blur to keep the mobile view clean
      pwCheck.classList.remove('show-checklist');
    });

    pwInput.addEventListener('input', function() {
      const val = pwInput.value;

      // Lowercase check
      if (/[a-z]/.test(val)) {
        reqLower.classList.replace('invalid', 'valid');
      } else {
        reqLower.classList.replace('valid', 'invalid');
      }

      // Length check
      if (val.length >= 8) {
        reqLen.classList.replace('invalid', 'valid');
      } else {
        reqLen.classList.replace('valid', 'invalid');
      }

      // Uppercase check
      if (/[A-Z]/.test(val)) {
        reqUpper.classList.replace('invalid', 'valid');
      } else {
        reqUpper.classList.replace('valid', 'invalid');
      }

      // Number check
      if (/[0-9]/.test(val)) {
        reqNum.classList.replace('invalid', 'valid');
      } else {
        reqNum.classList.replace('valid', 'invalid');
      }

      // Symbol check
      if (/[!@#$%^&*(),.?":{}|<>]/.test(val)) {
        reqSym.classList.replace('invalid', 'valid');
      } else {
        reqSym.classList.replace('valid', 'invalid');
      }

    });

  </script>
</body>
</html>
