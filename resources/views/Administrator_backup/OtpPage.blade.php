<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>OTP Verification | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://cdn.tailwindcss.com"></script>
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

    .page-wrapper {
      display: flex;
      width: 100vw;
      height: 100vh;
    }

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

    .headline {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(2rem, 3.5vw, 2.6rem);
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
      margin-bottom: 28px;
      max-width: 360px;
    }

    .divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 24px;
    }

    .divider-line { flex: 1; height: 1px; background: #d6eedd; }
    .divider-dot  { width: 6px; height: 6px; border-radius: 50%; background: var(--green-bright); opacity: .5; }

    .email-box {
      background: #f5fbf7;
      border-left: 4px solid var(--green-bright);
      border-radius: 10px;
      padding: 14px 16px;
      margin-bottom: 20px;
      font-size: 0.85rem;
      color: var(--text-soft);
    }

    .email-box-label {
      text-transform: uppercase;
      font-size: 0.7rem;
      letter-spacing: 0.12em;
      color: #7a9c88;
      margin-bottom: 4px;
    }

    .email-box-value {
      font-weight: 600;
      color: var(--text-mid);
    }

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

    .form-input {
      width: 100%;
      padding: 14px 16px;
      border: 1.5px solid #d6eedd;
      border-radius: 10px;
      background: var(--off-white);
      color: var(--text-dark);
      font-size: 1.2rem;
      letter-spacing: 0.4em;
      text-align: center;
      outline: none;
      transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .form-input::placeholder {
      letter-spacing: 0.3em;
      color: #b2c9bb;
    }

    .form-input:focus {
      border-color: var(--green-bright);
      background: var(--white);
      box-shadow: 0 0 0 4px #d5f5e3;
    }

    .helper-text {
      font-size: 0.78rem;
      color: var(--text-soft);
      margin-top: 4px;
    }

    .timer-text {
      font-size: 0.82rem;
      color: var(--text-soft);
      margin: 12px 0 20px;
    }

    .timer-value {
      color: var(--green-mid);
      font-weight: 600;
    }

    .btn-primary {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 13px 24px;
      background: linear-gradient(135deg, var(--green-bright) 0%, var(--green-mid) 100%);
      color: var(--white);
      border: none;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 600;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      cursor: pointer;
      transition: transform .2s, box-shadow .2s, opacity .2s;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(39, 174, 96, 0.3);
    }

    .btn-primary:disabled {
      opacity: .6;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    .btn-secondary {
      margin-top: 14px;
      width: 100%;
      padding: 11px 22px;
      border-radius: 10px;
      border: 1.5px solid #d6eedd;
      background: #f9fdfb;
      color: var(--text-soft);
      font-size: 0.9rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      cursor: pointer;
      transition: background .2s, color .2s, border-color .2s;
    }

    .btn-secondary:hover {
      background: #ecf9f1;
      color: var(--green-mid);
      border-color: var(--green-mid);
    }

    .alert-error {
      background: #fff0f0;
      border: 1px solid #fca5a5;
      color: #b91c1c;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 0.82rem;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .alert-success {
      background: #ecfdf3;
      border: 1px solid #bbf7d0;
      color: #166534;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 0.82rem;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

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

    @media (max-width: 640px) {
      html, body { overflow-y: auto; }
      .page-wrapper { min-height: 100vh; }
      .left-panel {
        padding: 24px 18px;
        height: auto;
        min-height: 100vh;
        justify-content: flex-start;
        padding-top: 36px;
      }
      .left-content {
        max-width: 100%;
        width: 100%;
      }
      .headline { font-size: 1.6rem; }
      .logo-ring { width: 52px; height: 52px; }
      .logo-name { font-size: 1rem; }
    }
  </style>
</head>
<body>
  <div class="page-wrapper">
    <div class="left-panel">
      <div class="left-content">

        <div class="logo-area">
          <div class="logo-ring">
            <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
          </div>
          <div>
            <div class="logo-name">Greater Bulacan Livelihood Development Cooperative</div>
            <div class="logo-sub">Admin Portal · OTP Verification</div>
          </div>
        </div>

        <h1 class="headline">Verify your<br><em>Admin Login</em></h1>
        <p class="subheadline">We’ve sent a 6‑digit verification code to your registered email address. Enter it below to continue.</p>

        <div class="divider">
          <div class="divider-line"></div>
          <div class="divider-dot"></div>
          <div class="divider-line"></div>
        </div>

        <div class="email-box">
          <div class="email-box-label">Verification code sent to</div>
          <div class="email-box-value">{{ $email }}</div>
        </div>

        @if(session('error'))
          <div class="alert-error">
            <i class="fa fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
          </div>
        @endif

        @if(session('success'))
          <div class="alert-success">
            <i class="fa fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        <form action="{{ route('OTP.Confirm') }}" method="POST" id="otpForm" autocomplete="off">
          @csrf

          <div class="form-group">
            <label for="otpInput" class="form-label">Verification Code</label>
            <div class="input-wrap">
              <input
                id="otpInput"
                name="OTP"
                type="text"
                maxlength="6"
                inputmode="numeric"
                pattern="[0-9A-Za-z]{6}"
                placeholder="••••••"
                class="form-input"
                required
              >
            </div>
            <div class="helper-text">Enter the 6‑character code from your email.</div>
          </div>

          <div class="timer-text">
            Code expires in: <span id="timer" class="timer-value">05:00</span>
          </div>

          <button type="submit" id="verifyBtn" class="btn-primary">
            <i class="fa fa-shield-check"></i>
            <span>Verify Code</span>
          </button>
        </form>

        <form action="{{ route('OTP.Resend') }}" method="POST">
          @csrf
          <button type="submit" id="resendBtn" class="btn-secondary">
            <i class="fa fa-redo-alt"></i>
            <span>Resend Code</span>
          </button>
        </form>

      </div>
      <div class="left-footer">©2025 Greater Bulacan Livelihood Development Cooperative</div>
    </div>
  </div>

  <script>
    const timerElement = document.getElementById('timer');
    const otpInput = document.getElementById('otpInput');
    const verifyBtn = document.getElementById('verifyBtn');

    let timeLeft = 300; // 5 minutes

    const countdown = setInterval(() => {
      const minutes = Math.floor(timeLeft / 60);
      const seconds = timeLeft % 60;
      timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

      if (timeLeft <= 60) {
        timerElement.classList.add('text-red-500');
      }

      if (timeLeft <= 0) {
        clearInterval(countdown);
        timerElement.textContent = '00:00';
        timerElement.classList.add('text-red-500');

        otpInput.disabled = true;
        otpInput.placeholder = 'Code expired';

        verifyBtn.disabled = true;
        verifyBtn.innerHTML = '<i class="fa fa-times-circle"></i><span>Code Expired</span>';
      }

      timeLeft--;
    }, 1000);
  </script>
</body>
</html>
