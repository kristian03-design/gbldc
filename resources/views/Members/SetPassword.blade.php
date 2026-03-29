<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Set New Password | GBLDC</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{ asset('images/logocoop-removebg-preview-2.png') }}">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-deep:   #145a32;
      --green-mid:    #1e8449;
      --green-bright: #27ae60;
      --green-light:  #a9dfbf;
      --green-pale:   #eafaf1;
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

    /* ── LOGO ── */
    .logo-area {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 40px;
    }

    .logo-ring {
      width: 64px; height: 64px;
      border-radius: 50%;
      padding: 3px;
      flex-shrink: 0;
      overflow: hidden;
      background: var(--white);
    }

    .logo-ring img {
      width: 100%; height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

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

    .input-wrap { position: relative; }

    .input-icon {
      position: absolute;
      left: 14px; top: 50%;
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
      font-family: 'Outfit', sans-serif;
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

    .toggle-pwd {
      position: absolute;
      right: 13px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      color: #b2c9bb; cursor: pointer;
      padding: 4px; font-size: 0.85rem;
      transition: color .2s;
    }
    .toggle-pwd:hover { color: var(--green-mid); }

    /* ── PASSWORD CHECKLIST ── */
    .pw-checklist {
      margin-top: 10px;
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
      color: #9ca3af;
      transition: color 0.3s;
    }
    .check-item i { font-size: 0.85rem; width: 14px; text-align: center; }
    .check-item.valid { color: var(--green-bright); }
    .check-item.valid i::before   { content: "\f00c"; }
    .check-item.invalid i::before { content: "\f00d"; }

    /* ── SUBMIT BUTTON ── */
    .btn-submit {
      width: 100%;
      margin-top: 30px;
      padding: 14px;
      background: linear-gradient(135deg, var(--green-mid) 0%, var(--green-deep) 100%);
      color: var(--white);
      border: none;
      border-radius: 10px;
      font-family: 'Outfit', sans-serif;
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
    .btn-submit::after {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,.08) 0%, transparent 60%);
      pointer-events: none;
    }
    .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 8px 28px rgba(30,132,73,.35); }
    .btn-submit:active { transform: translateY(0); }

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

    /* ── NOTICE BADGE ── */
    .notice-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: #fef9ec;
      border: 1px solid #fde68a;
      color: #92400e;
      border-radius: 8px;
      padding: 8px 12px;
      font-size: 0.78rem;
      font-weight: 500;
      margin-bottom: 28px;
    }
    .notice-badge i { color: #f59e0b; font-size: 0.82rem; }

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
    .logo-area   { animation: fadeUp .5s ease both; animation-delay: .05s; }
    .headline    { animation: fadeUp .5s ease both; animation-delay: .18s; }
    .subheadline { animation: fadeUp .5s ease both; animation-delay: .24s; }
    .divider     { animation: fadeUp .4s ease both; animation-delay: .3s; }
    .form-group  { animation: fadeUp .45s ease both; animation-delay: .34s; }
    .btn-submit  { animation: fadeUp .4s ease both; animation-delay: .4s; }

    /* ── RESPONSIVE ── */
    @media (max-width: 480px) {
      .page-wrapper { flex-direction: column; min-height: 100vh; }
      .left-panel {
        width: 100vw; height: auto; min-height: 100vh;
        padding: 40px 20px 80px; justify-content: flex-start; flex: none;
      }
      .left-content { max-width: 100%; width: 100%; }
      .headline { font-size: 1.5rem; }
      .logo-ring { width: 48px; height: 48px; }
      .left-footer { bottom: 16px; position: relative; padding-top: 30px; }
    }
  </style>
</head>
<body>
  <div class="page-wrapper">
    <div class="left-panel">
      <div class="left-content">

        <!-- Logo -->
        <div class="logo-area">
          <div class="logo-ring">
            <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
          </div>
          <div>
            <div class="logo-name">Greater Bulacan Livelihood Development Cooperative</div>
            <div class="logo-sub">Member Portal</div>
          </div>
        </div>

        <!-- Heading -->
        <h1 class="headline">Set your <em>new password</em></h1>
        <p class="subheadline">This is required on your first login. Choose a strong password before accessing your dashboard.</p>

        <!-- Notice -->
        <div class="notice-badge">
          <i class="fa fa-circle-info"></i>
          Required before accessing your member dashboard.
        </div>

        <div class="divider">
          <div class="divider-line"></div>
          <div class="divider-dot"></div>
          <div class="divider-line"></div>
        </div>

        @if ($errors->any())
        <div class="alert-error">
          <i class="fa fa-circle-exclamation mt-1"></i>
          <div>
            <div style="font-weight:600; margin-bottom:4px;">Please fix the following:</div>
            <ul style="margin-left:18px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('Member.Password.Set.Save') }}">
          @csrf

          <div class="form-group">
            <label for="password" class="form-label">New Password</label>
            <div class="input-wrap">
              <i class="fa fa-lock input-icon"></i>
              <input id="password" name="password" type="password"
                     placeholder="••••••••"
                     class="form-input"
                     required autocomplete="new-password">
              <button type="button" class="toggle-pwd" onclick="togglePassword('password','icon1')" aria-label="Toggle password">
                <i id="icon1" class="fa fa-eye"></i>
              </button>
            </div>

            <div class="pw-checklist" id="pwChecklist">
              <div class="check-item invalid" id="req-len">  <i class="fa fa-xmark"></i> Minimum 8 characters</div>
              <div class="check-item invalid" id="req-upper"><i class="fa fa-xmark"></i> At least one uppercase letter</div>
              <div class="check-item invalid" id="req-lower"><i class="fa fa-xmark"></i> At least one lowercase letter</div>
              <div class="check-item invalid" id="req-num">  <i class="fa fa-xmark"></i> At least one number</div>
              <div class="check-item invalid" id="req-sym">  <i class="fa fa-xmark"></i> At least one symbol</div>
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
              <button type="button" class="toggle-pwd" onclick="togglePassword('password_confirmation','icon2')" aria-label="Toggle confirm password">
                <i id="icon2" class="fa fa-eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="btn-submit">
            <i class="fa fa-key"></i>
            <span>Save Password</span>
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

    const pwInput  = document.getElementById('password');
    const pwCheck  = document.getElementById('pwChecklist');
    const reqLen   = document.getElementById('req-len');
    const reqUpper = document.getElementById('req-upper');
    const reqLower = document.getElementById('req-lower');
    const reqNum   = document.getElementById('req-num');
    const reqSym   = document.getElementById('req-sym');

    pwInput.addEventListener('focus', () => pwCheck.classList.add('show-checklist'));
    pwInput.addEventListener('blur',  () => pwCheck.classList.remove('show-checklist'));

    pwInput.addEventListener('input', function () {
      const v = pwInput.value;
      const setRule = (el, pass) => {
        el.classList.toggle('valid',   pass);
        el.classList.toggle('invalid', !pass);
      };
      setRule(reqLen,   v.length >= 8);
      setRule(reqUpper, /[A-Z]/.test(v));
      setRule(reqLower, /[a-z]/.test(v));
      setRule(reqNum,   /[0-9]/.test(v));
      setRule(reqSym,   /[!@#$%^&*(),.?":{}|<>]/.test(v));
    });
  </script>
</body>
</html>
