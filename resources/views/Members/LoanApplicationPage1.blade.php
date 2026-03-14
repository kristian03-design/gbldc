<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e588cb9d47.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}" sizes="512x512" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <title>Loan Application | GBLDC</title>

    <style>
      *, *::before, *::after { box-sizing: border-box; }
      body { font-family: 'Outfit', sans-serif; background: #f8fafb; color: #1e2939; }


      /* ── Card ── */
      .card {
        background: #fff;
        border: 1px solid #e9eef4;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,.05);
        margin-bottom: 18px;
        overflow: hidden;
      }
      .card-head {
        display: flex; align-items: center; gap: 12px;
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        background: #fafcff;
      }
      .card-head-icon {
        width: 38px; height: 38px; border-radius: 10px;
        background: #dcfce7; color: #16a34a;
        display: flex; align-items: center; justify-content: center;
      }
      .card-head-title { font-size: 16px; font-weight: 700; color: #1e2939; }
      .card-head-sub { font-size: 12px; color: #64748b; margin-top: 1px; }
      .card-body { padding: 22px 24px; }

      /* ── Form elements ── */
      .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
      }
      .form-grid.cols2 { grid-template-columns: repeat(2, 1fr); }
      @media (max-width: 700px) {
        .form-grid, .form-grid.cols2 { grid-template-columns: 1fr; }
      }
      .field { display: flex; flex-direction: column; gap: 5px; }
      .field.span2 { grid-column: span 2; }
      @media (max-width: 700px) { .field.span2 { grid-column: span 1; } }

      label { font-size: 13px; font-weight: 600; color: #374151; }
      .req { color: #ef4444; }
      .opt { color: #94a3b8; font-weight: 400; font-size: 12px; }
      .field-hint { font-size: 11px; color: #94a3b8; }

      .inp, .sel {
        width: 100%;
        padding: 9px 12px;
        border: 1.5px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Outfit', sans-serif;
        color: #1e2939;
        background: #fff;
        transition: border-color .18s, box-shadow .18s;
        outline: none;
      }
      .inp:focus, .sel:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,.12);
      }
      .inp[readonly] { background: #f8fafb; color: #64748b; }

      .inp-wrap { position: relative; display: flex; align-items: center; }
      .inp-wrap .inp { padding-left: 36px; }
      .inp-wrap .inp.suffix-inp { padding-right: 42px; }
      .prefix {
        position: absolute; left: 11px;
        font-size: 14px; color: #64748b; pointer-events: none; z-index: 1;
      }
      .suffix {
        position: absolute; right: 11px;
        font-size: 13px; color: #64748b; pointer-events: none;
      }

      /* Radio pills */
      .radio-group { display: flex; gap: 8px; flex-wrap: wrap; }
      .radio-pill {
        display: flex; align-items: center; gap: 6px;
        padding: 7px 14px;
        border: 1.5px solid #d1d5db; border-radius: 12px;
        cursor: pointer; font-size: 13px; font-weight: 500;
        transition: border-color .15s, background .15s;
      }
      .radio-pill input { display: none; }
      .radio-pill .dot {
        width: 10px; height: 10px; border-radius: 50%;
        border: 1.5px solid #94a3b8; background: #fff;
        transition: background .15s, border-color .15s;
        flex-shrink: 0;
      }
      .radio-pill:has(input:checked) {
        border-color: #16a34a; background: #f0fdf4;
      }
      .radio-pill:has(input:checked) .dot {
        background: #16a34a; border-color: #16a34a;
      }

      /* File upload */
      .file-upload {
        border: 2px dashed #d1d5db; border-radius: 10px;
        padding: 18px 16px; text-align: center;
        cursor: pointer; transition: border-color .2s, background .2s;
      }
      .file-upload:hover { border-color: #16a34a; background: #f0fdf4; }
      .file-upload input { display: none; }
      .fu-icon { color: #94a3b8; margin-bottom: 4px; }
      .fu-label { font-size: 13px; font-weight: 600; color: #374151; }
      .fu-hint { font-size: 11px; color: #94a3b8; }
      .file-upload.has-file { border-color: #16a34a; background: #f0fdf4; }
      .file-upload.has-file .fu-label { color: #15803d; }

      /* Amount pills */
      .amount-grid {
        display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;
      }
      .amt-pill {
        padding: 6px 14px; border-radius: 20px;
        border: 1.5px solid #d1d5db; font-size: 13px; font-weight: 600;
        cursor: pointer; background: #fff; transition: all .15s;
        color: #374151;
      }
      .amt-pill.selected { background: #16a34a; color: #fff; border-color: #16a34a; }

      /* Term pills */
      .term-grid { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px; }
      .term-pill {
        display: flex; flex-direction: column; align-items: center;
        padding: 12px 20px; border: 1.5px solid #d1d5db; border-radius: 12px;
        cursor: pointer; transition: all .15s; background: #fff;
      }
      .term-pill input { display: none; }
      .term-num { font-size: 22px; font-weight: 800; color: #374151; line-height: 1; }
      .term-unit { font-size: 11px; color: #64748b; font-weight: 500; }
      .term-pill:has(input:checked) {
        border-color: #16a34a; background: #f0fdf4;
      }
      .term-pill:has(input:checked) .term-num { color: #16a34a; }

      /* Purpose pills */
      .purpose-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 10px; }
      .purpose-pill {
        padding: 7px 14px; border-radius: 20px;
        border: 1.5px solid #d1d5db; font-size: 13px;
        cursor: pointer; background: #fff; transition: all .15s;
      }
      .purpose-pill.selected { background: #16a34a; color: #fff; border-color: #16a34a; }

      /* Computation panel */
      .comp-panel {
        background: #f8fafb; border: 1.5px solid #e2e8f0;
        border-radius: 12px; padding: 18px 20px; margin-top: 4px;
      }
      .comp-panel-title {
        display: flex; align-items: center; gap: 7px;
        font-size: 14px; font-weight: 700; color: #1e2939; margin-bottom: 10px;
      }
      .comp-rate-row { font-size: 13px; color: #374151; margin-bottom: 4px; }
      .comp-results-grid {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;
        margin: 14px 0 14px;
      }
      @media (max-width: 600px) { .comp-results-grid { grid-template-columns: repeat(2, 1fr); } }
      .comp-result {
        background: #fff; border: 1px solid #e9eef4; border-radius: 9px;
        padding: 10px 12px;
      }
      .comp-result .lbl { font-size: 11px; color: #64748b; font-weight: 500; }
      .comp-result .val { font-size: 15px; font-weight: 700; color: #1e2939; margin-top: 2px; }
      .comp-result .val.warn { color: #dc2626; }
      .comp-result .val.big { font-size: 16px; color: #15803d; }
      .apply-btn {
        display: flex; align-items: center; gap: 6px;
        padding: 9px 18px; background: #16a34a; color: #fff;
        border: none; border-radius: 8px; font-size: 13px; font-weight: 600;
        cursor: pointer; transition: background .15s;
        font-family: 'Outfit', sans-serif;
      }
      .apply-btn:hover { background: #15803d; }

      /* Review section */
      .review-section { margin-bottom: 22px; }
      .review-section-title {
        display: flex; align-items: center; gap: 7px;
        font-size: 14px; font-weight: 700; color: #374151;
        margin-bottom: 10px;
      }
      .review-grid {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;
      }
      @media (max-width: 500px) { .review-grid { grid-template-columns: 1fr; } }
      .rv-item { background: #f8fafb; border: 1px solid #e9eef4; border-radius: 8px; padding: 9px 12px; }
      .rv-label { font-size: 11px; color: #64748b; font-weight: 500; }
      .rv-value { font-size: 14px; font-weight: 600; color: #1e2939; margin-top: 1px; }

      /* Step panels */
      .step-panel { display: none; max-width: 860px; margin: 0 auto; padding: 18px 20px; }
      .step-panel.active { display: block; }

      /* Navigation */
      .step-nav {
        max-width: 860px; margin: 0 auto;
        display: flex; justify-content: space-between; align-items: center;
        padding: 14px 20px 40px;
        gap: 12px;
      }
      .step-nav-left, .step-nav-right { display: flex; align-items: center; gap: 10px; }
      .step-hint { font-size: 12px; color: #94a3b8; display: flex; align-items: center; gap: 5px; }

      .btn {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 20px; border-radius: 9px;
        font-size: 14px; font-weight: 600; cursor: pointer;
        border: none; text-decoration: none; transition: all .15s;
        font-family: 'Outfit', sans-serif;
      }
      .btn-ghost {
        background: transparent; border: 1.5px solid #d1d5db; color: #374151;
      }
      .btn-ghost:hover { background: #f8fafb; border-color: #9ca3af; }
      .btn-primary { background: #16a34a; color: #fff; }
      .btn-primary:hover { background: #15803d; }
      .btn-submit { background: #0f766e; color: #fff; }
      .btn-submit:hover { background: #0d6660; }

      /* Page wrapper */
      .page-wrap { min-height: 100vh; display: flex; flex-direction: column; }
      .page-footer {
        text-align: center; font-size: 12px; color: #94a3b8;
        padding: 18px 20px; border-top: 1px solid #f1f5f9; margin-top: auto;
      }

      /* Mobile menu open state */
      #mobile-menu.mobile-menu-open {
        transform: translateY(0);
        visibility: visible;
      }

      /* Animate-fade-in */
      .animate-fade-in { animation: fadeIn .18s ease; }
      @keyframes fadeIn { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:none; } }
    </style>
  </head>

  <body class="bg-white text-gray-800 scroll-smooth" style="font-family: Outfit;">

    <!-- ══ HEADER ══ -->
    <header class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100">
      <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 lg:py-0">

        <!-- Logo -->
        <a href="{{route('Member.Landing')}}" class="flex items-center gap-2 sm:gap-3 py-1 sm:py-2 flex-shrink-0">
          <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
            class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain">
          <span class="font-semibold text-base sm:text-lg lg:text-xl text-green-700 tracking-tight whitespace-nowrap">GBLDC</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-1 xl:gap-4 text-sm xl:text-base font-medium">
          <a href="{{route('Member.Landing')}}" class="px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200">Home</a>

          <!-- Products & Services Dropdown -->
          <div class="relative group">
            <button class="flex items-center gap-1 px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200 focus:outline-none">
              <span class="whitespace-nowrap">Product &amp; Services</span>
              <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180 duration-200"></i>
            </button>
            <div class="absolute left-0 top-full mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
              <a href="loan-products.html" class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-t-lg transition-colors">Loans</a>
              <a href="deposit.html" class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 transition-colors">Deposits</a>
              <a href="savings-page.html" class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-b-lg transition-colors">Savings</a>
            </div>
          </div>

          <!-- About Dropdown -->
          <div class="relative group">
            <button class="flex items-center gap-1 px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200 focus:outline-none">
              <span>About</span>
              <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180 duration-200"></i>
            </button>
            <div class="absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
              <a href="about-gbldc.html" class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-t-lg transition-colors">About GBLDC</a>
              <a href="#" class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 transition-colors">Mission &amp; Vision</a>
              <a href="board-of-directors.html" class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 transition-colors">Board of Directors</a>
              <a href="committee-officers.html" class="block px-4 py-3 hover:bg-green-50 hover:text-green-700 rounded-b-lg transition-colors">Committee Officers</a>
            </div>
          </div>

          <a href="news&events.html" class="px-2 xl:px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors duration-200 whitespace-nowrap">News &amp; Events</a>
        </nav>

        <!-- Desktop Profile -->
        <div class="hidden lg:flex items-center">
          <div class="ml-4 relative">
            <a href="#" title="User Profile" onclick="toggleProfileDropdown(event)" class="flex items-center gap-2">
              <img src="{{asset('images/profile.png')}}" alt="User Avatar"
                class="w-12 h-12 rounded-full object-cover shadow-sm hover:ring-2 hover:ring-green-400 transition-all duration-200 cursor-pointer">
              <i class="fas fa-chevron-down text-gray-500 text-base"></i>
            </a>
            <div id="profile-dropdown" class="absolute right-0 mt-2 w-72 p-4 bg-white rounded-lg shadow-lg border z-30 hidden animate-fade-in">
              <div class="flex items-center px-4 py-2 text-gray-800 font-semibold mb-2 break-all">
                {{ auth()->user()->name ?? '' }}
              </div>
              <a href="{{route('Loan.Dashboard')}}" class="block px-4 text-gray-800 hover:bg-green-200 rounded-md p-2 transition-colors">Loan Dashboard</a>
              <a href="{{ route('Member.AccountSettings') }}" class="block px-4 py-2 text-gray-800 hover:bg-green-200 rounded-md p-2 transition-colors">Settings</a>
              <a href="help.html" class="block px-4 py-2 text-gray-800 hover:bg-green-200 rounded-md p-2 transition-colors">Help &amp; Support</a>
              <div class="border-t my-1">
                <a href="#" onclick="openLogoutModal(event)" class="block px-4 py-2 hover:bg-green-200 rounded-md p-2 transition-colors">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile menu button -->
        <button id="mobile-menu-btn" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-green-50 transition-colors duration-200" onclick="toggleMobileMenu()">
          <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Mobile Navigation Menu -->
      <div id="mobile-menu" class="lg:hidden absolute top-full left-0 w-full bg-white border-b border-gray-100 shadow-lg transform -translate-y-full invisible transition-all duration-300 z-40">
        <nav class="px-4 sm:px-6 py-4 space-y-1">
          <a href="{{route('Member.Landing')}}" class="block px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium">Home</a>

          <div class="space-y-1">
            <button onclick="toggleDropdownProductsMobile(event)" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium text-left">
              <span>Product &amp; Services</span>
              <i id="products-chevron" class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
            </button>
            <div id="dropdown-menu-products-mobile" class="hidden ml-4 space-y-1">
              <a href="loan-products.html" class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Loans</a>
              <a href="deposit.html" class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Deposits</a>
              <a href="savings-page.html" class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Savings</a>
            </div>
          </div>

          <div class="space-y-1">
            <button onclick="toggleDropdownMobileAbout(event)" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium text-left">
              <span>About</span>
              <i id="about-chevron" class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
            </button>
            <div id="dropdown-menu-about-mobile" class="hidden ml-4 space-y-1">
              <a href="about-gbldc.html" class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">About GBLDC</a>
              <a href="#" class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Mission &amp; Vision</a>
              <a href="board-of-directors.html" class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Board of Directors</a>
              <a href="committee-officers.html" class="block px-4 py-2 rounded-lg hover:bg-green-100 hover:text-green-700 transition-colors text-sm">Committee Officers</a>
            </div>
          </div>

          <a href="news&events.html" class="block px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors font-medium">News &amp; Events</a>

          <div class="border-t pt-4 mt-4">
            <div class="flex items-center px-4 py-2 mb-2">
              <img src="{{asset('images/profile.png')}}" alt="User Avatar" class="w-8 h-8 rounded-full object-cover mr-3">
              <span class="font-medium text-gray-800">{{ auth()->user()->name ?? '' }}</span>
            </div>
            <a href="{{route('Loan.Dashboard')}}" class="block px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors text-sm">Loan Dashboard</a>
            <a href="{{ route('Member.AccountSettings') }}" class="block px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors text-sm">Settings</a>
            <a href="help.html" class="block px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors text-sm">Help &amp; Support</a>
            <a href="#" onclick="openLogoutModal(event)" class="block px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-700 transition-colors text-sm">Logout</a>
          </div>
        </nav>
      </div>
    </header>

    <!-- ══ PAGE WRAPPER ══ -->
    <div class="page-wrap">

      <!-- Page heading -->
      <div class="max-w-7xl mx-auto mt-24 p-4 sm:p-6 md:p-7">
        <h2 class="text-center text-3xl sm:text-4xl font-semibold text-gray-800 block">Loan Application</h2>
        <p class="text-center text-black mt-3">Please fill out the form below to apply for a loan.</p>
      </div>

      <!-- ══ FORM ══ -->
      <form action="{{route('Loan.Submit')}}" method="POST" enctype="multipart/form-data" id="loanForm">
        @csrf
        <input type="hidden" name="member_id" value="{{ optional($AutoComplete)->member_id }}">

        @if(session('success'))
          <div class="max-w-860px mx-auto px-5">
            <div class="bg-green-100 border border-green-400 text-center text-green-700 px-4 py-3 rounded relative mb-4">
              <span class="block sm:inline">{{ session('success') }}</span>
            </div>
          </div>
        @endif
        @if($errors->any())
          <div class="max-w-860px mx-auto px-5">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded relative mb-4">
              <div class="font-bold mb-2">Please correct the following errors:</div>
              <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif
        @if(session('error'))
          <div class="max-w-860px mx-auto px-5">
            <div class="bg-red-100 border border-red-400 text-center text-red-700 px-4 py-3 rounded relative mb-4">
              <span class="block sm:inline">{{ session('error') }}</span>
            </div>
          </div>
        @endif

        <!-- ═══ STEP 1: Personal Info ═══ -->
        <div class="step-panel active" id="step-1">
          <div class="card">
            <div class="card-head">
              <div class="card-head-icon"><i data-lucide="user"></i></div>
              <div>
                <div class="card-head-title">Personal Information</div>
                <div class="card-head-sub">Full name, birth info, and contact details</div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field">
                  <label>Last Name <span class="req">*</span></label>
                  <input class="inp" name="last_name" type="text" placeholder="e.g. Dela Cruz" value="{{ optional($AutoComplete)->last_name }}" required>
                </div>
                <div class="field">
                  <label>First Name <span class="req">*</span></label>
                  <input class="inp" name="first_name" type="text" placeholder="e.g. Juan" value="{{ optional($AutoComplete)->first_name }}" required>
                </div>
                <div class="field">
                  <label>Middle Name <span class="req">*</span></label>
                  <input class="inp" name="middle_name" type="text" placeholder="e.g. Santos" value="{{ optional($AutoComplete)->middle_name }}" required>
                </div>
              </div>
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field">
                  <label>Place of Birth <span class="req">*</span></label>
                  <input class="inp" name="place_of_birth" type="text" placeholder="City / Municipality" value="{{ optional($AutoComplete)->place_of_birth }}" required>
                </div>
                <div class="field">
                  <label>Birth Date <span class="req">*</span></label>
                  <input class="inp" name="birthdate" id="birthDate" type="date" value="{{ optional($AutoComplete)->birthdate }}" required onchange="calculateAge()">
                </div>
                <div class="field">
                  <label>Age <span class="req">*</span></label>
                  <div class="inp-wrap">
                    <input class="inp suffix-inp" name="age" id="ageField" type="number" value="{{ optional($AutoComplete)->age }}" readonly required>
                    <span class="suffix">yrs</span>
                  </div>
                  <div class="field-hint">Auto-computed from birth date</div>
                </div>
              </div>
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field">
                  <label>Gender <span class="req">*</span></label>
                  <div class="radio-group">
                    <label class="radio-pill">
                      <input type="radio" name="gender" value="Male" {{ (old('gender', optional($AutoComplete)->gender ?? '') == 'Male') ? 'checked' : '' }} required>
                      <span class="dot"></span> Male
                    </label>
                    <label class="radio-pill">
                      <input type="radio" name="gender" value="Female" {{ (old('gender', optional($AutoComplete)->gender ?? '') == 'Female') ? 'checked' : '' }}>
                      <span class="dot"></span> Female
                    </label>
                  </div>
                </div>
                <div class="field">
                  <label>Civil Status <span class="req">*</span></label>
                  <select class="sel" name="civil_status" required>
                    <option value="">Select status</option>
                    <option value="SINGLE"    {{ optional($AutoComplete)->civil_status == 'SINGLE'    ? 'selected':'' }}>Single</option>
                    <option value="MARRIED"   {{ optional($AutoComplete)->civil_status == 'MARRIED'   ? 'selected':'' }}>Married</option>
                    <option value="WIDOW"     {{ optional($AutoComplete)->civil_status == 'WIDOW'     ? 'selected':'' }}>Widow / Widower</option>
                    <option value="SEPARATED" {{ optional($AutoComplete)->civil_status == 'SEPARATED' ? 'selected':'' }}>Separated</option>
                  </select>
                </div>
                <div class="field">
                  <label>Religion <span class="req">*</span></label>
                  <select class="sel" name="religion" required>
                    <option value="">Select religion</option>
                    <option value="ROMAN CATHOLIC">Roman Catholic</option>
                    <option value="PROTESTANT">Protestant</option>
                    <option value="CHRISTIAN">Christian</option>
                    <option value="BAPTIST">Baptist</option>
                    <option value="SEVENTH-DAY ADVENTIST">Seventh-Day Adventist</option>
                    <option value="IGLESIA NI CRISTO">Iglesia ni Cristo</option>
                    <option value="ADVENTIST">Adventist</option>
                    <option value="BUDDHISM">Buddhism</option>
                    <option value="JESUS IS LORD MOVEMENT">Jesus is Lord Movement</option>
                    <option value="JEHOVAH'S WITNESSES">Jehovah's Witnesses</option>
                    <option value="METHODIST">Methodist</option>
                    <option value="NON-SECTARIAN">Non-Sectarian</option>
                    <option value="OTHER">Other</option>
                  </select>
                </div>
              </div>
              <div class="form-grid cols2">
                <div class="field">
                  <label>Email Address <span class="req">*</span></label>
                  <input class="inp" name="email" type="email" placeholder="juan@email.com" value="{{ optional($AutoComplete)->email }}" required>
                </div>
                <div class="field">
                  <label>Contact Number <span class="req">*</span></label>
                  <div class="inp-wrap">
                    <span class="prefix">+63</span>
                    <input class="inp" name="contact_number" type="tel" pattern="[0-9]{10}" maxlength="10" placeholder="9XXXXXXXXX" value="{{ optional($AutoComplete)->contact_number }}" required inputmode="numeric" style="padding-left:48px;">
                  </div>
                </div>
                <div class="field">
                  <label>Nationality <span class="req">*</span></label>
                  <input class="inp" name="nationality" type="text" placeholder="e.g. Filipino" value="{{ optional($AutoComplete)->nationality ?? 'Filipino' }}" required>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 2: Home Address ═══ -->
        <div class="step-panel" id="step-2">
          <div class="card">
            <div class="card-head">
              <div class="card-head-icon"><i data-lucide="map-pin"></i></div>
              <div>
                <div class="card-head-title">Home Address</div>
                <div class="card-head-sub">Current residential address of the applicant</div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field">
                  <label>Province <span class="req">*</span></label>
                  <select class="sel" id="province" name="province" required>
                    <option value="{{ optional($AutoComplete)->province }}">{{ optional($AutoComplete)->province ?? 'Select Province' }}</option>
                  </select>
                </div>
                <div class="field">
                  <label>City / Municipality <span class="req">*</span></label>
                  <select class="sel" id="city" name="city_municipality" required>
                    <option value="{{ optional($AutoComplete)->city }}">{{ optional($AutoComplete)->city ?? 'Select City' }}</option>
                  </select>
                </div>
                <div class="field">
                  <label>Barangay <span class="req">*</span></label>
                  <select class="sel" id="barangay" name="barangay" required>
                    <option value="{{ optional($AutoComplete)->barangay }}">{{ optional($AutoComplete)->barangay ?? 'Select Barangay' }}</option>
                  </select>
                </div>
                <div class="field span2">
                  <label>Street Address <span class="req">*</span></label>
                  <input class="inp" name="street_address" type="text" placeholder="House No., Street Name" value="{{ optional($AutoComplete)->street_address }}" required>
                </div>
                <div class="field">
                  <label>Zip Code <span class="req">*</span></label>
                  <input class="inp" id="zipCode" name="zip_code" type="text" placeholder="e.g. 3000" value="{{ optional($AutoComplete)->zip_code }}" required>
                </div>
                <div class="field">
                  <label>Years of Stay <span class="req">*</span></label>
                  <input class="inp" name="year_of_stay" type="text" placeholder="e.g. 5" value="{{ optional($AutoComplete)->year_of_stay }}" required>
                </div>
                <div class="field">
                  <label>House Ownership <span class="req">*</span></label>
                  <select class="sel" name="house_ownership" required>
                    <option value="">Select type</option>
                    <option value="Owned"               {{ optional($AutoComplete)->house_ownership == 'Owned'               ? 'selected':'' }}>Owned</option>
                    <option value="Rented"              {{ optional($AutoComplete)->house_ownership == 'Rented'              ? 'selected':'' }}>Rented</option>
                    <option value="Living with Parents" {{ optional($AutoComplete)->house_ownership == 'Living with Parents' ? 'selected':'' }}>Living with Parents</option>
                    <option value="Other"               {{ optional($AutoComplete)->house_ownership == 'Other'               ? 'selected':'' }}>Other</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 3: Guarantors ═══ -->
        <div class="step-panel" id="step-3">
          <!-- Guarantor 1 -->
          <div class="card">
            <div class="card-head">
              <div class="card-head-icon"><i data-lucide="user-check"></i></div>
              <div>
                <div class="card-head-title">First Guarantor (Co-Maker)</div>
                <div class="card-head-sub">Primary co-maker of this loan application</div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field span2">
                  <label>Full Name <span class="req">*</span></label>
                  <input class="inp" name="g1_fullname" type="text" placeholder="Full name of guarantor" required>
                </div>
                <div class="field">
                  <label>Relationship <span class="req">*</span></label>
                  <select class="sel" name="g1_relationship" required>
                    <option value="" disabled selected>Select relationship</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Parent">Parent</option>
                    <option value="Sibling">Sibling</option>
                    <option value="Child">Child</option>
                    <option value="Relative">Relative</option>
                    <option value="Friend">Friend</option>
                    <option value="Co-worker">Co-worker</option>
                    <option value="Employer">Employer</option>
                    <option value="Neighbor">Neighbor</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
              </div>
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field">
                  <label>Contact Number <span class="req">*</span></label>
                  <input class="inp" name="g1_contact_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11" required>
                </div>
                <div class="field span2">
                  <label>Address <span class="req">*</span></label>
                  <input class="inp" name="g1_address" type="text" placeholder="Complete address" required>
                </div>
              </div>
              <div class="field" style="max-width:320px;">
                <label>Valid ID <span class="req">*</span></label>
                <div class="file-upload" id="fu-g1" onclick="document.getElementById('g1_valid_id').click()">
                  <div class="fu-icon"><i data-lucide="upload-cloud"></i></div>
                  <div class="fu-label" id="fu-g1-label">Click to upload</div>
                  <div class="fu-hint">JPG, PNG accepted</div>
                  <input type="file" id="g1_valid_id" name="g1_valid_id" accept="image/*" required onchange="handleFile('fu-g1','fu-g1-label',this)">
                </div>
              </div>
            </div>
          </div>

          <!-- Guarantor 2 -->
          <div class="card">
            <div class="card-head">
              <div class="card-head-icon"><i data-lucide="user-check"></i></div>
              <div>
                <div class="card-head-title">Second Guarantor (Co-Maker)</div>
                <div class="card-head-sub">Secondary co-maker of this loan application</div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field span2">
                  <label>Full Name <span class="req">*</span></label>
                  <input class="inp" name="g2_fullname" type="text" placeholder="Full name of guarantor" required>
                </div>
                <div class="field">
                  <label>Relationship <span class="req">*</span></label>
                  <select class="sel" name="g2_relationship" required>
                    <option value="" disabled selected>Select relationship</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Parent">Parent</option>
                    <option value="Sibling">Sibling</option>
                    <option value="Child">Child</option>
                    <option value="Relative">Relative</option>
                    <option value="Friend">Friend</option>
                    <option value="Co-worker">Co-worker</option>
                    <option value="Employer">Employer</option>
                    <option value="Neighbor">Neighbor</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
              </div>
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field">
                  <label>Contact Number <span class="req">*</span></label>
                  <input class="inp" name="g2_contact_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11" required>
                </div>
                <div class="field span2">
                  <label>Address <span class="req">*</span></label>
                  <input class="inp" name="g2_address" type="text" placeholder="Complete address" required>
                </div>
              </div>
              <div class="field" style="max-width:320px;">
                <label>Valid ID <span class="req">*</span></label>
                <div class="file-upload" id="fu-g2" onclick="document.getElementById('g2_valid_id').click()">
                  <div class="fu-icon"><i data-lucide="upload-cloud"></i></div>
                  <div class="fu-label" id="fu-g2-label">Click to upload</div>
                  <div class="fu-hint">JPG, PNG, PDF accepted</div>
                  <input type="file" id="g2_valid_id" name="g2_valid_id" accept="image/*,application/pdf" required onchange="handleFile('fu-g2','fu-g2-label',this)">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 4: Employment ═══ -->
        <div class="step-panel" id="step-4">
          <div class="card">
            <div class="card-head">
              <div class="card-head-icon"><i data-lucide="briefcase"></i></div>
              <div>
                <div class="card-head-title">Employment / Business Information</div>
                <div class="card-head-sub">Source of income for loan eligibility assessment</div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field">
                  <label>Employment Type <span class="req">*</span></label>
                  <select class="sel" name="employment_type" required>
                    <option value="">Select type</option>
                    <option value="employed">Employed</option>
                    <option value="self-employed">Self-Employed</option>
                    <option value="business-owner">Business Owner</option>
                  </select>
                </div>
                <div class="field">
                  <label>Employer / Business Name <span class="req">*</span></label>
                  <input class="inp" name="employer_business_name" type="text" placeholder="e.g. ABC Corp." required>
                </div>
                <div class="field">
                  <label>Occupation / Nature of Business <span class="req">*</span></label>
                  <input class="inp" name="position_nature_of_business" type="text" placeholder="e.g. Accountant" required>
                </div>
              </div>
              <div class="form-grid" style="margin-bottom:18px;">
                <div class="field span2">
                  <label>Employer / Business Address <span class="req">*</span></label>
                  <input class="inp" name="employer_business_address" type="text" placeholder="Complete business address" required>
                </div>
                <div class="field">
                  <label>Years in Service <span class="req">*</span></label>
                  <input class="inp" name="year_in_service_operation" type="text" placeholder="e.g. 3 years" required>
                </div>
              </div>
              <div class="form-grid cols2" style="margin-bottom:18px;">
                <div class="field">
                  <label>Gross Monthly Income <span class="req">*</span></label>
                  <div class="inp-wrap">
                    <span class="prefix">₱</span>
                    <input class="inp" name="monthly_income" id="monthly_income" type="number" min="0" step="0.01" placeholder="0.00" required style="padding-left:28px;">
                  </div>
                </div>
                <div class="field">
                  <label>Proof of Income <span class="req">*</span></label>
                  <div class="file-upload" id="fu-income" onclick="document.getElementById('proof_of_income').click()">
                    <div class="fu-icon"><i data-lucide="upload-cloud"></i></div>
                    <div class="fu-label" id="fu-income-label">Click to upload</div>
                    <div class="fu-hint">Payslip, COE, ITR, Business Permit</div>
                    <input type="file" id="proof_of_income" name="proof_of_income" accept="image/*" required onchange="handleFile('fu-income','fu-income-label',this)">
                  </div>
                </div>
              </div>
              <div class="form-grid cols2">
                <div class="field">
                  <label>HR Contact Name <span class="opt">(optional)</span></label>
                  <input class="inp" name="hr_person_name" type="text" placeholder="HR or contact person name">
                </div>
                <div class="field">
                  <label>HR Contact Number <span class="opt">(optional)</span></label>
                  <input class="inp" name="hr_person_number" type="tel" placeholder="09XXXXXXXXX" maxlength="11">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 5: Loan Details ═══ -->
        <div class="step-panel" id="step-5">
          <div class="card">
            <div class="card-head">
              <div class="card-head-icon"><i data-lucide="landmark"></i></div>
              <div>
                <div class="card-head-title">Loan Details</div>
                <div class="card-head-sub">Loan type, amount, term, purpose, and interest computation</div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-grid cols2" style="margin-bottom:22px;">
                <div class="field">
                  <label>Loan Type <span class="req">*</span></label>
                  <select class="sel" name="loan_type" required>
                    <option value="">Select loan type</option>
                    <option value="personal-loan">Personal Loan</option>
                    <option value="business-loan">Business Loan</option>
                    <option value="mortgage-loan">Mortgage / Housing Loan</option>
                    <option value="auto-loan">Auto Loan</option>
                    <option value="educational-loan">Educational Loan</option>
                    <option value="emergency-loan">Emergency Loan</option>
                  </select>
                </div>
              </div>

              <div class="field" style="margin-bottom:20px;">
                <label>Loan Amount <span class="req">*</span> <span class="opt">— quick pick or enter manually</span></label>
                <div class="amount-grid" id="amountPills">
                  <div class="amt-pill" data-amt="5000">₱5,000</div>
                  <div class="amt-pill" data-amt="10000">₱10,000</div>
                  <div class="amt-pill" data-amt="20000">₱20,000</div>
                  <div class="amt-pill" data-amt="30000">₱30,000</div>
                  <div class="amt-pill" data-amt="50000">₱50,000</div>
                  <div class="amt-pill" data-amt="75000">₱75,000</div>
                  <div class="amt-pill" data-amt="100000">₱100,000</div>
                  <div class="amt-pill" data-amt="150000">₱150,000</div>
                </div>
                <div class="inp-wrap">
                  <span class="prefix">₱</span>
                  <input class="inp" name="loan_amount" id="loanAmount" type="number" min="0" step="0.01"
                    placeholder="Enter or pick amount above" required oninput="clearAmtPill(); runComputation();" style="padding-left:28px;">
                </div>
              </div>

              <div class="field" style="margin-bottom:22px;">
                <label>Loan Term <span class="req">*</span> <span class="opt">— select repayment duration</span></label>
                <div class="term-grid">
                  <label class="term-pill">
                    <input type="radio" name="loan_term" value="3" onchange="runComputation()" required>
                    <span class="term-num">3</span>
                    <span class="term-unit">Months</span>
                  </label>
                  <label class="term-pill">
                    <input type="radio" name="loan_term" value="6" onchange="runComputation()">
                    <span class="term-num">6</span>
                    <span class="term-unit">Months</span>
                  </label>
                  <label class="term-pill">
                    <input type="radio" name="loan_term" value="9" onchange="runComputation()">
                    <span class="term-num">9</span>
                    <span class="term-unit">Months</span>
                  </label>
                  <label class="term-pill">
                    <input type="radio" name="loan_term" value="12" onchange="runComputation()">
                    <span class="term-num">12</span>
                    <span class="term-unit">Months</span>
                  </label>
                </div>
              </div>

              <div class="field" style="margin-bottom:22px;">
                <label>Purpose of Loan <span class="req">*</span> <span class="opt">— pick or type custom</span></label>
                <div class="purpose-grid" id="purposePills">
                  <div class="purpose-pill" data-purpose="Home Renovation">🏠 Home Renovation</div>
                  <div class="purpose-pill" data-purpose="Business Capital">💼 Business Capital</div>
                  <div class="purpose-pill" data-purpose="Education">🎓 Education</div>
                  <div class="purpose-pill" data-purpose="Medical / Health">🏥 Medical / Health</div>
                  <div class="purpose-pill" data-purpose="Debt Consolidation">💳 Debt Consolidation</div>
                  <div class="purpose-pill" data-purpose="Vehicle Purchase">🚗 Vehicle Purchase</div>
                  <div class="purpose-pill" data-purpose="Travel">✈️ Travel</div>
                  <div class="purpose-pill" data-purpose="Events / Celebration">🎉 Events</div>
                  <div class="purpose-pill" data-purpose="Emergency">⚡ Emergency</div>
                </div>
                <input class="inp" name="purpose_of_loan" id="purposeInput" type="text" placeholder="Selected above or type custom purpose…" required>
              </div>

              <!-- Interest computation panel -->
              <div class="comp-panel">
                <div class="comp-panel-title">
                  <i data-lucide="calculator"></i> Interest Computation
                </div>
                <div class="comp-rate-row" style="margin-bottom:8px;">
                  <span style="font-size:13px;color:#374151;font-weight:600;">Rate by loan amount (compound, monthly):</span>
                </div>
                <div style="font-size:12px;color:#64748b;margin-bottom:12px;">
                  Up to 50k → 8% p.a. &nbsp;|&nbsp; 50k–150k → 10% &nbsp;|&nbsp; 150k–500k → 12% &nbsp;|&nbsp; 500k–2M → 14% &nbsp;|&nbsp; 2M+ → 16%
                </div>
                <div class="comp-results-grid">
                  <div class="comp-result">
                    <div class="lbl">Principal</div>
                    <div class="val" id="res-principal">₱ —</div>
                  </div>
                  <div class="comp-result">
                    <div class="lbl">Rate (tier)</div>
                    <div class="val" id="res-rate">—% p.a.</div>
                  </div>
                  <div class="comp-result">
                    <div class="lbl">Total Interest (compound)</div>
                    <div class="val warn" id="res-interest">₱ —</div>
                  </div>
                  <div class="comp-result">
                    <div class="lbl">Total Due</div>
                    <div class="val big" id="res-total">₱ —</div>
                  </div>
                  <div class="comp-result">
                    <div class="lbl">Loan Term</div>
                    <div class="val" id="res-term">— months</div>
                  </div>
                  <div class="comp-result">
                    <div class="lbl">Est. Monthly</div>
                    <div class="val big" id="res-monthly">₱ —</div>
                  </div>
                </div>
                <button type="button" class="apply-btn" id="applyBtn" onclick="applyComputation()">
                  <i data-lucide="check"></i> Use This Computation — Auto-fill Due Amount
                </button>
              </div>

              <div class="field" style="margin-top:20px;">
                <label>Total Due Amount <span class="req">*</span> <span class="opt">— auto-filled above or enter manually</span></label>
                <div class="inp-wrap">
                  <span class="prefix">₱</span>
                  <input class="inp" name="due_amount" id="dueAmount" type="number" min="0" step="0.01" placeholder="Total repayable amount" required style="padding-left:28px;">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ═══ STEP 6: Review & Submit ═══ -->
        <div class="step-panel" id="step-6">
          <div class="card">
            <div class="card-head">
              <div class="card-head-icon"><i data-lucide="clipboard-check"></i></div>
              <div>
                <div class="card-head-title">Review &amp; Submit</div>
                <div class="card-head-sub">Confirm all information before submitting the loan application</div>
              </div>
            </div>
            <div class="card-body">
              <div class="review-section">
                <div class="review-section-title"><i data-lucide="user"></i> Personal Information</div>
                <div class="review-grid" id="rv-personal"></div>
              </div>
              <div class="review-section">
                <div class="review-section-title"><i data-lucide="map-pin"></i> Home Address</div>
                <div class="review-grid" id="rv-address"></div>
              </div>
              <div class="review-section">
                <div class="review-section-title"><i data-lucide="briefcase"></i> Employment</div>
                <div class="review-grid" id="rv-employment"></div>
              </div>
              <div class="review-section">
                <div class="review-section-title"><i data-lucide="landmark"></i> Loan Details</div>
                <div class="review-grid" id="rv-loan"></div>
              </div>
              <div style="background:#fff3cd;border:1px solid #fde68a;border-radius:10px;padding:12px 16px;display:flex;align-items:center;gap:8px;font-size:13px;color:#92400e;margin-top:4px;">
                <i data-lucide="triangle-alert" style="width:16px;height:16px;flex-shrink:0;"></i>
                Please review all information carefully. Once submitted, the application will go to the loan review queue.
              </div>
            </div>
          </div>
        </div>

        <!-- ── Navigation ── -->
        <div class="step-nav">
          <div class="step-nav-left">
            <button type="button" class="btn btn-ghost" id="btnPrev" onclick="prevStep()" style="display:none;">
              <i data-lucide="arrow-left"></i> Previous
            </button>
            <span class="step-hint" id="stepHint">
              <i data-lucide="info"></i> Fill all required fields to continue
            </span>
          </div>
          <div class="step-nav-right">
            <a href="{{route('Member.Landing')}}" class="btn btn-ghost" id="btnCancel">
              <i data-lucide="x"></i> Cancel
            </a>
            <button type="button" class="btn btn-primary" id="btnNext" onclick="nextStep()">
              Continue <i data-lucide="arrow-right"></i>
            </button>
            <button type="submit" class="btn btn-submit" id="btnSubmit" style="display:none;">
              <i data-lucide="send"></i> Submit Application
            </button>
          </div>
        </div>

      </form>

      <footer class="page-footer">
        &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
      </footer>
    </div><!-- /page-wrap -->

    <!-- ══ LOGOUT MODAL ══ -->
    <div id="logout-modal" class="fixed inset-0 z-[60] flex items-center justify-center hidden">
      <div id="logout-modal-content" class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4 transform transition-all duration-300 relative z-[61]">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
            <i class="fas fa-sign-out-alt text-red-600 text-xl"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Confirm Logout</h3>
          <p class="text-sm text-gray-500 mb-6">Are you sure you want to logout? You will need to sign in again to access your account.</p>
          <div class="flex flex-col sm:flex-row gap-3 sm:gap-2 justify-center">
            <button onclick="closeLogoutModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors duration-200">
              Cancel
            </button>
            <a href="{{ route('Member.Logout') }}" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 transition-colors duration-200 inline-block text-center">
              Logout
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- ══ SCRIPTS ══ -->
    <script>
      // ── Lucide icons ──
      lucide.createIcons();

      // ── Step wizard state ──
      let currentStep = 1;
      const totalSteps = 6;
      const stepTitles = [
        'Step 1 — Personal Information',
        'Step 2 — Home Address',
        'Step 3 — Guarantors',
        'Step 4 — Employment',
        'Step 5 — Loan Details',
        'Step 6 — Review & Submit'
      ];

      function updateUI() {
        // Panels
        document.querySelectorAll('.step-panel').forEach((p, i) => {
          p.classList.toggle('active', i + 1 === currentStep);
        });
        // Step items
        document.querySelectorAll('.step-item').forEach((item, i) => {
          const s = i + 1;
          item.classList.remove('active', 'done');
          if (s === currentStep) item.classList.add('active');
          else if (s < currentStep) item.classList.add('done');
        });
        // Progress bar
        document.getElementById('progressBar').style.width = ((currentStep / totalSteps) * 100) + '%';
        document.getElementById('progressTitle').textContent = stepTitles[currentStep - 1];
        document.getElementById('curStep').textContent = currentStep;
        // Buttons
        document.getElementById('btnPrev').style.display = currentStep > 1 ? '' : 'none';
        document.getElementById('btnNext').style.display = currentStep < totalSteps ? '' : 'none';
        document.getElementById('btnSubmit').style.display = currentStep === totalSteps ? '' : 'none';
        // Re-init icons after DOM change
        lucide.createIcons();
        // Populate review on step 6
        if (currentStep === totalSteps) populateReview();
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      function nextStep() {
        if (currentStep < totalSteps) {
          currentStep++;
          updateUI();
        }
      }
      function prevStep() {
        if (currentStep > 1) {
          currentStep--;
          updateUI();
        }
      }
      function jumpToStep(s) {
        if (s <= currentStep) { currentStep = s; updateUI(); }
      }

      // ── Age calculation ──
      function calculateAge() {
        const bInput = document.getElementById('birthDate');
        const aInput = document.getElementById('ageField');
        if (!bInput || !bInput.value) { if (aInput) aInput.value = ''; return; }
        const today = new Date();
        const birth = new Date(bInput.value);
        let age = today.getFullYear() - birth.getFullYear();
        const m = today.getMonth() - birth.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
        aInput.value = age >= 0 ? age : '';
      }

      // ── PSGC dropdowns ──
      const PSGC_API = 'https://psgc.gitlab.io/api';
      const provinceSelect = document.getElementById('province');
      const citySelect = document.getElementById('city');
      const barangaySelect = document.getElementById('barangay');

      fetch(`${PSGC_API}/provinces/`)
        .then(r => r.json())
        .then(provinces => {
          provinces.sort((a, b) => a.name.localeCompare(b.name)).forEach(p => {
            provinceSelect.innerHTML += `<option value="${p.code}">${p.name}</option>`;
          });
        }).catch(() => {});

      provinceSelect.addEventListener('change', function () {
        citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        if (!this.value) return;
        fetch(`${PSGC_API}/provinces/${this.value}/cities-municipalities/`)
          .then(r => r.json())
          .then(cities => {
            cities.sort((a, b) => a.name.localeCompare(b.name)).forEach(c => {
              citySelect.innerHTML += `<option value="${c.code}">${c.name}</option>`;
            });
          }).catch(() => {});
      });

      citySelect.addEventListener('change', function () {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        document.getElementById('zipCode').value = '';
        if (!this.value) return;
        fetch(`${PSGC_API}/cities-municipalities/${this.value}/barangays/`)
          .then(r => r.json())
          .then(brgys => {
            brgys.sort((a, b) => a.name.localeCompare(b.name)).forEach(b => {
              barangaySelect.innerHTML += `<option value="${b.code}">${b.name}</option>`;
            });
          }).catch(() => {});
        fetch(`${PSGC_API}/cities-municipalities/${this.value}/`)
          .then(r => r.json())
          .then(city => {
            document.getElementById('zipCode').value = city.postalCode || '';
          }).catch(() => {});
      });

      // ── File upload handler ──
      function handleFile(wrapId, labelId, input) {
        const wrap = document.getElementById(wrapId);
        const label = document.getElementById(labelId);
        if (input.files && input.files[0]) {
          label.textContent = input.files[0].name;
          wrap.classList.add('has-file');
        }
      }

      // ── Amount pills ──
      document.querySelectorAll('.amt-pill').forEach(pill => {
        pill.addEventListener('click', () => {
          document.querySelectorAll('.amt-pill').forEach(p => p.classList.remove('selected'));
          pill.classList.add('selected');
          document.getElementById('loanAmount').value = pill.dataset.amt;
          runComputation();
        });
      });
      function clearAmtPill() {
        document.querySelectorAll('.amt-pill').forEach(p => p.classList.remove('selected'));
      }

      // ── Purpose pills ──
      document.querySelectorAll('.purpose-pill').forEach(pill => {
        pill.addEventListener('click', () => {
          document.querySelectorAll('.purpose-pill').forEach(p => p.classList.remove('selected'));
          pill.classList.add('selected');
          document.getElementById('purposeInput').value = pill.dataset.purpose;
        });
      });

      // ── Interest computation ──
      function getTierRate(amount) {
        if (amount <= 50000)   return 0.08;
        if (amount <= 150000)  return 0.10;
        if (amount <= 500000)  return 0.12;
        if (amount <= 2000000) return 0.14;
        return 0.16;
      }
      const fmt = n => '₱ ' + Number(n).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      let lastComputed = null;

      function runComputation() {
        const principal = parseFloat(document.getElementById('loanAmount').value) || 0;
        const termRadio = document.querySelector('input[name="loan_term"]:checked');
        const term = termRadio ? parseInt(termRadio.value) : 0;
        if (!principal || !term) {
          ['res-principal','res-rate','res-interest','res-total','res-term','res-monthly'].forEach(id => {
            document.getElementById(id).textContent = id === 'res-rate' ? '—% p.a.' : (id === 'res-term' ? '— months' : '₱ —');
          });
          lastComputed = null;
          return;
        }
        const rate = getTierRate(principal);
        const monthlyRate = rate / 12;
        const totalDue = principal * Math.pow(1 + monthlyRate, term);
        const interest = totalDue - principal;
        const monthly = totalDue / term;
        document.getElementById('res-principal').textContent = fmt(principal);
        document.getElementById('res-rate').textContent = (rate * 100).toFixed(0) + '% p.a.';
        document.getElementById('res-interest').textContent = fmt(interest);
        document.getElementById('res-total').textContent = fmt(totalDue);
        document.getElementById('res-term').textContent = term + ' months';
        document.getElementById('res-monthly').textContent = fmt(monthly);
        lastComputed = { totalDue };
      }

      function applyComputation() {
        if (!lastComputed) { alert('Please enter a loan amount and select a term first.'); return; }
        document.getElementById('dueAmount').value = lastComputed.totalDue.toFixed(2);
      }

      // ── Review population ──
      function rv(label, val) {
        return `<div class="rv-item"><div class="rv-label">${label}</div><div class="rv-value">${val || '—'}</div></div>`;
      }
      function getVal(name) {
        const el = document.querySelector(`[name="${name}"]`);
        if (!el) return '';
        if (el.type === 'radio') {
          const checked = document.querySelector(`[name="${name}"]:checked`);
          return checked ? checked.value : '';
        }
        if (el.tagName === 'SELECT') return el.options[el.selectedIndex]?.text || el.value;
        return el.value;
      }

      function populateReview() {
        document.getElementById('rv-personal').innerHTML =
          rv('Last Name', getVal('last_name')) +
          rv('First Name', getVal('first_name')) +
          rv('Middle Name', getVal('middle_name')) +
          rv('Birth Date', getVal('birthdate')) +
          rv('Place of Birth', getVal('place_of_birth')) +
          rv('Age', getVal('age')) +
          rv('Gender', getVal('gender')) +
          rv('Civil Status', getVal('civil_status')) +
          rv('Religion', getVal('religion')) +
          rv('Nationality', getVal('nationality')) +
          rv('Email', getVal('email')) +
          rv('Contact', '+63 ' + getVal('contact_number'));

        document.getElementById('rv-address').innerHTML =
          rv('Province', getVal('province')) +
          rv('City / Municipality', getVal('city_municipality')) +
          rv('Barangay', getVal('barangay')) +
          rv('Street', getVal('street_address')) +
          rv('Zip Code', getVal('zip_code')) +
          rv('Years of Stay', getVal('year_of_stay')) +
          rv('House Ownership', getVal('house_ownership'));

        document.getElementById('rv-employment').innerHTML =
          rv('Employment Type', getVal('employment_type')) +
          rv('Employer / Business', getVal('employer_business_name')) +
          rv('Position / Nature', getVal('position_nature_of_business')) +
          rv('Business Address', getVal('employer_business_address')) +
          rv('Years in Service', getVal('year_in_service_operation')) +
          rv('Monthly Income', getVal('monthly_income') ? '₱ ' + Number(getVal('monthly_income')).toLocaleString('en-PH') : '');

        document.getElementById('rv-loan').innerHTML =
          rv('Loan Type', getVal('loan_type')) +
          rv('Loan Amount', getVal('loan_amount') ? '₱ ' + Number(getVal('loan_amount')).toLocaleString('en-PH') : '') +
          rv('Loan Term', getVal('loan_term') ? getVal('loan_term') + ' months' : '') +
          rv('Purpose', getVal('purpose_of_loan')) +
          rv('Total Due', getVal('due_amount') ? '₱ ' + Number(getVal('due_amount')).toLocaleString('en-PH') : '');

        lucide.createIcons();
      }

      // ── Mobile menu ──
      function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        const isOpen = menu.classList.contains('mobile-menu-open');
        if (isOpen) {
          menu.classList.remove('mobile-menu-open');
          menuIcon.classList.remove('hidden');
          closeIcon.classList.add('hidden');
        } else {
          menu.classList.add('mobile-menu-open');
          menuIcon.classList.add('hidden');
          closeIcon.classList.remove('hidden');
        }
      }

      function toggleDropdownProductsMobile(event) {
        event.preventDefault();
        const dropdown = document.getElementById('dropdown-menu-products-mobile');
        const chevron = document.getElementById('products-chevron');
        dropdown.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
      }

      function toggleDropdownMobileAbout(event) {
        event.preventDefault();
        const dropdown = document.getElementById('dropdown-menu-about-mobile');
        const chevron = document.getElementById('about-chevron');
        dropdown.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
      }

      // ── Profile dropdown ──
      function toggleProfileDropdown(event) {
        event.preventDefault();
        const dropdown = document.getElementById('profile-dropdown');
        dropdown.classList.toggle('hidden');
        document.addEventListener('click', function handler(e) {
          if (!dropdown.contains(e.target) && !event.currentTarget.contains(e.target)) {
            dropdown.classList.add('hidden');
            document.removeEventListener('click', handler);
          }
        });
      }

      // ── Logout modal ──
      function openLogoutModal(event) {
        event.preventDefault();
        const modal = document.getElementById('logout-modal');
        modal.classList.remove('hidden');
        if (!document.getElementById('logout-overlay')) {
          const overlay = document.createElement('div');
          overlay.id = 'logout-overlay';
          overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:59;';
          overlay.onclick = closeLogoutModal;
          document.body.appendChild(overlay);
        }
        document.body.classList.add('overflow-hidden');
      }

      function closeLogoutModal() {
        document.getElementById('logout-modal').classList.add('hidden');
        const overlay = document.getElementById('logout-overlay');
        if (overlay) overlay.remove();
        document.body.classList.remove('overflow-hidden');
      }

      // ── Keyboard close ──
      document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
          closeLogoutModal();
          document.getElementById('profile-dropdown')?.classList.add('hidden');
          const menu = document.getElementById('mobile-menu');
          if (menu.classList.contains('mobile-menu-open')) toggleMobileMenu();
        }
      });

      // ── Resize close mobile menu ──
      window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
          const menu = document.getElementById('mobile-menu');
          if (menu.classList.contains('mobile-menu-open')) toggleMobileMenu();
        }
      });
    </script>
  </body>
</html>