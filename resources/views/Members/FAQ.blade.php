<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ | GBLDC</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --forest:    #0d4a2f;
      --forest-mid:#1a6b44;
      --emerald:   #22c55e;
      --sage:      #d1fae5;
      --sand:      #fafaf8;
      --ink:       #0f1c14;
      --muted:     #6b7280;
      --border:    #e5e7eb;
      --white:     #ffffff;
      --rose:      #ef4444;
      --sidebar-w: 260px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--sand);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
    }

    /* ── Sidebar ── */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--forest);
      color: #fff;
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; bottom: 0;
      z-index: 100; transition: transform .3s ease;
    }
    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 22px 20px 18px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2; }
    .logo-sub  { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-profile {
      margin: 14px 12px; padding: 12px;
      background: rgba(255,255,255,.07); border-radius: 12px;
      display: flex; align-items: center; gap: 10px;
    }
    .profile-avatar {
      width: 40px; height: 40px; border-radius: 50%;
      border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; overflow: hidden;
    }
    .profile-avatar.female { background: #fce7f3; }
    .profile-avatar.male   { background: #dbeafe; }
    .profile-name  { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.3; }
    .profile-email { font-size: 11px; opacity: .5; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; }

    .sidebar-nav { flex: 1; padding: 8px 12px; overflow-y: auto; }
    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 12px; border-radius: 10px;
      text-decoration: none; color: rgba(255,255,255,.7);
      font-size: 14px; font-weight: 500;
      transition: background .2s, color .2s; margin-bottom: 2px;
    }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }
    .nav-item.danger { color: rgba(248,113,113,.8); }
    .nav-item.danger:hover { background: rgba(239,68,68,.1); color: #fca5a5; }

    .sidebar-footer { padding: 14px 12px; border-top: 1px solid rgba(255,255,255,.1); font-size: 11px; opacity: .35; text-align: center; }

    /* ── Mobile toggle ── */
    .mobile-toggle {
      display: none; position: fixed; top: 14px; left: 14px; z-index: 200;
      width: 38px; height: 38px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer; align-items: center; justify-content: center;
    }
    .mobile-toggle i[data-lucide] { width: 18px; height: 18px; }

    /* ── Main ── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── Topbar ── */
    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 14px 32px; position: sticky; top: 0; z-index: 50;
    }
    .topbar h1 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--forest); }
    .breadcrumb { display: flex; align-items: center; gap: 5px; font-size: 12px; color: var(--muted); margin-top: 3px; }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Search box ── */
    .search-wrap {
      position: relative; margin-bottom: 24px; display: block;
    }
    .search-wrap svg {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      width: 16px; height: 16px; color: var(--muted); pointer-events: none;
      z-index: 1;
    }
    .search-input {
      width: 100%; padding: 11px 14px 11px 42px;
      border: 1px solid var(--border); border-radius: 10px;
      font-size: 13px; font-family: 'DM Sans', sans-serif;
      color: var(--ink); outline: none;
      background: var(--white);
      transition: border-color .2s, box-shadow .2s;
      display: block;
    }
    .search-input:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .search-input::placeholder { color: #9ca3af; }

    /* ── FAQ Category Card ── */
    .faq-card {
      background: var(--white); border-radius: 16px;
      border: 1px solid var(--border); overflow: hidden;
      margin-bottom: 20px;
    }
    .faq-card-header {
      padding: 14px 20px;
      background: var(--forest);
      display: flex; align-items: center; gap: 10px;
    }
    .faq-card-header h2 {
      font-size: 14px; font-weight: 700; color: #fff;
      display: flex; align-items: center; gap: 8px;
    }
    .faq-card-header h2 i[data-lucide] { width: 15px; height: 15px; opacity: .85; }
    .faq-card-body { padding: 16px 20px; display: flex; flex-direction: column; gap: 10px; }

    /* ── FAQ Item ── */
    .faq-item { border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
    .faq-question {
      width: 100%; display: flex; align-items: center; justify-content: space-between;
      padding: 13px 16px; background: transparent; border: none;
      cursor: pointer; text-align: left; gap: 12px;
      transition: background .15s;
    }
    .faq-question:hover { background: #f9fafb; }
    .faq-question-text {
      font-size: 13px; font-weight: 600; color: var(--ink); line-height: 1.4;
    }
    .faq-chevron {
      width: 16px; height: 16px; color: var(--muted);
      flex-shrink: 0;
      transition: transform .25s ease;
    }
    .faq-item.open .faq-chevron { transform: rotate(180deg); }
    .faq-item.open .faq-question { background: #f0fdf4; }
    .faq-item.open .faq-question-text { color: var(--forest); }

    .faq-answer {
      max-height: 0; overflow: hidden;
      transition: max-height .3s ease, padding .3s ease;
      background: #fafafa;
    }
    .faq-item.open .faq-answer {
      max-height: 400px;
      padding: 12px 16px 14px;
    }
    .faq-answer p {
      font-size: 13px; color: var(--muted); line-height: 1.7;
    }

    /* ── No results ── */
    .no-results {
      display: none; text-align: center; padding: 48px 20px; color: var(--muted);
    }
    .no-results i[data-lucide] { width: 40px; height: 40px; margin: 0 auto 12px; display: block; opacity: .3; }
    .no-results p { font-size: 14px; }

    /* ── CTA Banner ── */
    .cta-banner {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; padding: 28px 32px;
      display: flex; align-items: center; justify-content: space-between; gap: 20px;
      flex-wrap: wrap; margin-top: 8px;
    }
    .cta-banner-left { display: flex; align-items: center; gap: 16px; }
    .cta-icon {
      width: 48px; height: 48px; border-radius: 12px;
      background: var(--sage); color: var(--forest);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .cta-icon i[data-lucide] { width: 22px; height: 22px; }
    .cta-banner h3 { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
    .cta-banner p  { font-size: 12px; color: var(--muted); }
    .cta-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 11px 22px; border-radius: 10px;
      background: var(--forest); color: #fff;
      font-size: 13px; font-weight: 700; font-family: 'DM Sans', sans-serif;
      text-decoration: none; border: none; cursor: pointer;
      transition: background .2s, transform .1s; white-space: nowrap;
    }
    .cta-btn:hover { background: var(--forest-mid); }
    .cta-btn:active { transform: scale(.98); }
    .cta-btn i[data-lucide] { width: 14px; height: 14px; }

    /* ── Logout modal ── */
    .modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.45); z-index: 200;
      align-items: center; justify-content: center; padding: 16px;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--white); border-radius: 16px;
      padding: 28px; width: 100%; max-width: 420px;
      animation: popIn .25s ease;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(10px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }
    .modal-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
    .modal-icon.red { background: #fee2e2; color: #dc2626; }
    .modal-icon i[data-lucide] { width: 22px; height: 22px; }
    .modal h3 { font-size: 18px; font-weight: 700; text-align: center; margin-bottom: 6px; }
    .modal p  { font-size: 13px; color: var(--muted); text-align: center; margin-bottom: 22px; }
    .modal-btn-row { display: flex; gap: 10px; }
    .modal-btn { flex: 1; padding: 11px; border-radius: 10px; font-size: 14px; font-weight: 600; border: none; cursor: pointer; transition: background .2s; font-family: 'DM Sans', sans-serif; }
    .modal-btn.cancel { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover { background: #e5e7eb; }
    .modal-btn.danger { background: var(--rose); color: #fff; }
    .modal-btn.danger:hover { background: #dc2626; }

    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    @media (max-width: 1024px) {
      .sidebar { transform: translateX(-260px); }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0; }
      .mobile-toggle { display: flex; }
      .page-body { padding: 20px 18px; }
      .topbar { padding: 14px 18px; }
    }
    @media (max-width: 600px) {
      .cta-banner { flex-direction: column; align-items: flex-start; }
      .cta-btn { width: 100%; justify-content: center; }
    }
  </style>
</head>
<body>

<button class="mobile-toggle" id="mobileToggle">
  <i data-lucide="menu"></i>
</button>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
      style="width:40px;height:40px;object-fit:cover;border-radius:10px;flex-shrink:0;" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Member Portal</div>
    </div>
  </div>

  <div class="sidebar-profile">
    <div class="profile-avatar {{ $gender == 'Female' ? 'female' : 'male' }}">
      @if($gender == 'Female')
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{ $fist_name }} {{ $last_name }}</div>
      <div class="profile-email">{{ $email }}</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <a href="{{ route('Member.Landing') }}" class="nav-item">
      <i data-lucide="home"></i> Home
    </a>
    <a href="{{ route('Loan.Dashboard') }}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Loan Dashboard
    </a>
    <a href="{{ route('Member.Check.Loan.Status') }}" class="nav-item">
      <i data-lucide="search"></i> Check Loan Status
    </a>
    <a href="{{ route('Member.ContactUs') }}" class="nav-item">
      <i data-lucide="mail"></i> Contact Us
    </a>
    <a href="{{ route('Member.FAQ') }}" class="nav-item active">
      <i data-lucide="circle-help"></i> FAQ
    </a>
    <a href="{{ route('Member.AccountSettings') }}" class="nav-item">
      <i data-lucide="settings"></i> Account Settings
    </a>
    <a href="#" class="nav-item danger" onclick="openLogoutModal(); return false;">
      <i data-lucide="log-out"></i> Logout
    </a>
  </nav>

  <div class="sidebar-footer">GBLDC Member Portal &copy; 2025</div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <header class="topbar">
    <h1>Frequently Asked Questions</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <i data-lucide="house" style="width:12px;height:12px;"></i>
      <a href="{{ route('Member.Landing') }}">Home</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <span class="current">FAQ</span>
    </nav>
  </header>

  <div class="page-body">

    <!-- Search -->
    <div class="search-wrap">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
      </svg>
      <input type="text" id="faq-search" class="search-input" placeholder="Search questions or keywords…">
    </div>

    <!-- FAQ Categories -->
    <div id="faq-list">

      <!-- Account & Membership -->
      <div class="faq-card" data-category>
        <div class="faq-card-header">
          <h2><i data-lucide="user-circle"></i> Account &amp; Membership</h2>
        </div>
        <div class="faq-card-body">
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">How do I become a member of GBLDC?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>To become a member of Greater Bulacan Livelihood Development Cooperative, you need to visit our office and submit the required documents. You will need to complete the membership form, provide valid ID cards, and pay the initial share capital. Once approved, you will receive your member ID and can start enjoying our services.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">How can I update my personal information?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>You can update your personal information by logging into your member account and navigating to Account Settings. From there, you can edit your contact details, address, and other personal information. For name changes or major updates, please visit our office with supporting documents.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">What are the benefits of being a member?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>As a member of GBLDC, you enjoy various benefits including access to loan products with competitive interest rates, dividend shares from cooperative earnings, participation in annual meetings and elections, access to cooperative services (deposits, savings), and special promotions exclusively for members.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Loans -->
      <div class="faq-card" data-category>
        <div class="faq-card-header">
          <h2><i data-lucide="banknote"></i> Loans</h2>
        </div>
        <div class="faq-card-body">
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">What are the requirements for applying for a loan?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>To apply for a loan, you must be an active member of GBLDC with at least 6 months of membership. You need to provide valid identification, proof of income, and collateral (for larger loans). Specific requirements may vary depending on the loan type. Please contact our office for detailed requirements.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">How long does it take to process a loan application?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>Loan processing typically takes 3–5 business days for smaller loans and 7–14 business days for larger loans with collateral. The processing time may vary depending on the completeness of your documents and the verification process. We strive to process all applications as quickly as possible.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">What is the interest rate for loans?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>GBLDC offers competitive interest rates starting at 5% per annum for member loans. The exact rate depends on the loan amount, term, and type of collateral provided. As a cooperative, we strive to keep our rates affordable for our members.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">Can I pay my loan early?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>Yes, you can pay your loan early without any prepayment penalties. Early settlement is encouraged as it helps reduce your overall interest costs. Please contact our office to request a payoff amount and settlement procedure.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Payments -->
      <div class="faq-card" data-category>
        <div class="faq-card-header">
          <h2><i data-lucide="credit-card"></i> Payments</h2>
        </div>
        <div class="faq-card-body">
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">What payment methods are available?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>GBLDC offers multiple payment options including GCash, bank transfer, over-the-counter payments at our office, and automatic payroll deduction (for employed members). You can choose the method that is most convenient for you.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">What happens if I miss a payment?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>If you miss a payment, please contact our office as soon as possible to discuss payment arrangements. Late payments may incur additional fees and affect your credit standing with the cooperative. We encourage members to maintain timely payments to avoid complications.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Savings -->
      <div class="faq-card" data-category>
        <div class="faq-card-header">
          <h2><i data-lucide="piggy-bank"></i> Savings</h2>
        </div>
        <div class="faq-card-body">
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">What is a share capital?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>Share capital is the amount you invest in the cooperative to become a member. This represents your ownership in the cooperative and earns you dividends. The minimum share capital requirement varies, and you can make additional contributions over time.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
              <span class="faq-question-text">How are dividends calculated?</span>
              <i data-lucide="chevron-down" class="faq-chevron"></i>
            </button>
            <div class="faq-answer">
              <p>Dividends are calculated based on your share capital and the cooperative's surplus. The annual Board of Directors declares the dividend rate each year, which is then distributed to members proportionally according to their share capital holdings.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- No results -->
      <div class="no-results" id="no-results">
        <i data-lucide="search-x"></i>
        <p>No questions matched your search. Try different keywords.</p>
      </div>

    </div><!-- /faq-list -->

    <!-- CTA Banner -->
    <div class="cta-banner">
      <div class="cta-banner-left">
        <div class="cta-icon"><i data-lucide="message-circle-question"></i></div>
        <div>
          <h3>Still have questions?</h3>
          <p>Can't find what you're looking for? Our support team is ready to help.</p>
        </div>
      </div>
      <a href="{{ route('Member.ContactUs') }}" class="cta-btn">
        <i data-lucide="send"></i> Contact Us
      </a>
    </div>

  </div><!-- /page-body -->

</div><!-- /main -->

<!-- Logout Modal -->
<div class="modal-overlay" id="logout-modal">
  <div class="modal">
    <div class="modal-icon red"><i data-lucide="log-out"></i></div>
    <h3>Confirm Logout</h3>
    <p>Are you sure you want to logout? You'll need to sign in again to access your account.</p>
    <div class="modal-btn-row">
      <button class="modal-btn cancel" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{ route('Member.Logout') }}" class="modal-btn danger"
        style="text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</div>

<script>
  lucide.createIcons();

  // Mobile sidebar
  const sidebar = document.getElementById('sidebar');
  const mobileToggle = document.getElementById('mobileToggle');
  mobileToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  document.addEventListener('click', e => {
    if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
      sidebar.classList.remove('open');
    }
  });

  // Logout modal
  const logoutModal = document.getElementById('logout-modal');
  function openLogoutModal()  { logoutModal.classList.add('open'); }
  function closeLogoutModal() { logoutModal.classList.remove('open'); }
  logoutModal.addEventListener('click', e => { if (e.target === logoutModal) closeLogoutModal(); });

  // Accordion
  function toggleFAQ(btn) {
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');

    // Close all open items
    document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));

    // Open clicked if it was closed
    if (!isOpen) item.classList.add('open');

    lucide.createIcons();
  }

  // Search
  document.getElementById('faq-search').addEventListener('input', function () {
    const term = this.value.toLowerCase().trim();
    let totalVisible = 0;

    document.querySelectorAll('[data-category]').forEach(card => {
      let cardVisible = 0;
      card.querySelectorAll('.faq-item').forEach(item => {
        const q = item.querySelector('.faq-question-text').textContent.toLowerCase();
        const a = item.querySelector('.faq-answer p').textContent.toLowerCase();
        const match = !term || q.includes(term) || a.includes(term);
        item.style.display = match ? '' : 'none';
        if (match) cardVisible++;
      });
      card.style.display = cardVisible > 0 ? '' : 'none';
      totalVisible += cardVisible;
    });

    document.getElementById('no-results').style.display = totalVisible === 0 ? 'block' : 'none';
  });
</script>
</body>
</html>