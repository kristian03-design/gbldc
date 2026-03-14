<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Member Registration | GBLDC</title>
    <style>
        * { font-family: 'Outfit', sans-serif; }
        :root {
            --green-primary: #16a34a;
            --green-dark: #15803d;
            --green-light: #f0fdf4;
            --green-border: #bbf7d0;
            --teal-heading: #134e4a;
            --gray-input: #f9fafb;
            --border-color: #d1d5db;
        }
        body { background: #f1f5f9; }

        /* ── Step progress bar ── */
        .step-bar { display: flex; align-items: center; justify-content: center; gap: 0; }
        .step-item { display: flex; flex-direction: column; align-items: center; position: relative; z-index: 1; }
        .step-circle {
            width: 38px; height: 38px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; font-weight: 700;
            border: 2px solid var(--border-color);
            background: #fff; color: #9ca3af;
            transition: all 0.3s;
        }
        .step-circle.active { background: var(--green-primary); border-color: var(--green-primary); color: #fff; box-shadow: 0 0 0 4px rgba(22,163,74,0.15); }
        .step-circle.done   { background: var(--green-primary); border-color: var(--green-primary); color: #fff; }
        .step-label { font-size: 0.7rem; font-weight: 600; color: #9ca3af; margin-top: 5px; white-space: nowrap; }
        .step-label.active { color: var(--green-primary); }
        .step-label.done   { color: var(--green-primary); }
        .step-connector {
            width: 60px; height: 2px;
            background: #e5e7eb;
            margin-bottom: 18px;
            transition: background 0.3s;
        }
        .step-connector.done { background: var(--green-primary); }
        @media (max-width: 640px) {
            .step-connector { width: 28px; }
            .step-label { display: none; }
        }

        /* ── Form pages ── */
        .form-page { display: none; }
        .form-page.active { display: block; }

        /* ── Section heading ── */
        .section-header { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
        .section-header h3 { font-size: 1.15rem; font-weight: 600; color: var(--teal-heading); }
        .section-icon {
            width: 36px; height: 36px;
            background: var(--green-light); border: 1.5px solid var(--green-border);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            color: var(--green-primary); font-size: 0.95rem; flex-shrink: 0;
        }

        /* ── Inputs ── */
        .field-label { display: block; font-size: 0.8rem; font-weight: 600; color: #374151; margin-bottom: 5px; letter-spacing: 0.01em; }
        .field-label .req { color: #ef4444; margin-left: 2px; }
        .form-input, .form-select {
            width: 100%; background: var(--gray-input);
            border: 1.5px solid var(--border-color); border-radius: 10px;
            padding: 10px 14px; font-size: 0.9rem; color: #1f2937;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none; appearance: none; -webkit-appearance: none;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus, .form-select:focus {
            border-color: var(--green-primary); background: #fff;
            box-shadow: 0 0 0 3px rgba(74,222,128,0.18);
        }
        .form-input.is-valid   { border-color: #22c55e !important; background: #f0fdf4; }
        .form-input.is-invalid, .form-select.is-invalid { border-color: #ef4444 !important; background: #fef2f2; }
        .form-input[readonly]  { background: #f3f4f6; color: #6b7280; cursor: default; }

        /* ── Select arrow ── */
        .select-wrapper { position: relative; }
        .select-wrapper::after {
            content: '\f107'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            color: #6b7280; pointer-events: none; font-size: 0.82rem;
        }
        .select-wrapper .form-select { padding-right: 36px; cursor: pointer; }

        /* ── Phone ── */
        .phone-wrapper {
            display: flex; border: 1.5px solid var(--border-color);
            border-radius: 10px; overflow: hidden; background: var(--gray-input);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .phone-wrapper:focus-within { border-color: var(--green-primary); background: #fff; box-shadow: 0 0 0 3px rgba(74,222,128,0.18); }
        .phone-prefix { padding: 10px 12px; background: #f3f4f6; border-right: 1.5px solid var(--border-color); color: #374151; font-weight: 600; font-size: 0.88rem; white-space: nowrap; display: flex; align-items: center; }
        .phone-input { flex: 1; border: none; background: transparent; padding: 10px 14px; font-size: 0.9rem; color: #1f2937; outline: none; }

        /* ── Gender bordered radio ── */
        .gender-group { display: flex; gap: 10px; margin-top: 4px; }
        .gender-option {
            flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;
            border: 1.5px solid var(--border-color); border-radius: 10px;
            padding: 9px 12px; cursor: pointer; font-size: 0.88rem; font-weight: 500;
            color: #374151; background: var(--gray-input);
            transition: border-color 0.2s, background 0.2s, color 0.2s;
            user-select: none;
        }
        .gender-option:hover { border-color: #86efac; background: #f0fdf4; }
        .gender-option input[type="radio"] { display: none; }
        .gender-option.selected { border-color: var(--green-primary); background: #f0fdf4; color: var(--green-primary); font-weight: 600; }
        .gender-option .gender-icon { font-size: 1rem; }

        /* ── Hints ── */
        .field-hint { font-size: 0.74rem; margin-top: 4px; display: none; align-items: center; gap: 4px; }
        .field-hint.show { display: flex; }
        .field-hint.error   { color: #ef4444; }
        .field-hint.success { color: #16a34a; }
        .field-hint.info    { color: #6b7280; }

        /* ── Divider ── */
        .section-divider { border: none; border-top: 1.5px solid #e5e7eb; margin: 28px 0; }

        /* ── Upload zone ── */
        .upload-zone {
            border: 2px dashed #d1d5db; border-radius: 12px; background: #f9fafb;
            padding: 20px 16px; text-align: center; cursor: pointer;
            transition: border-color 0.2s, background 0.2s; position: relative;
        }
        .upload-zone:hover { border-color: var(--green-primary); background: var(--green-light); }
        .upload-zone.dragover { border-color: var(--green-primary); background: var(--green-light); }
        .upload-zone input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .upload-zone .upload-icon { font-size: 1.7rem; color: #9ca3af; margin-bottom: 6px; }
        .upload-zone .upload-label { font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 2px; }
        .upload-zone .upload-text  { font-size: 0.78rem; color: #6b7280; }
        .upload-preview { display: none; margin-top: 10px; position: relative; }
        .upload-preview img { width: 100%; max-height: 110px; object-fit: cover; border-radius: 8px; border: 1.5px solid #e5e7eb; }
        .upload-preview .preview-filename { font-size: 0.75rem; color: #374151; margin-top: 4px; text-align: left; word-break: break-all; }
        .upload-remove-btn { position: absolute; top: -8px; right: -8px; background: #ef4444; color: #fff; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 0.68rem; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
        .upload-error   { display: none; background: #fef2f2; border: 1.5px solid #fca5a5; border-radius: 8px; padding: 8px 12px; margin-top: 8px; font-size: 0.78rem; color: #b91c1c; align-items: center; gap: 6px; }
        .upload-error.show { display: flex; }
        .upload-success { display: none; background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 8px; padding: 6px 12px; margin-top: 6px; font-size: 0.76rem; color: #15803d; align-items: center; gap: 6px; }
        .upload-success.show { display: flex; }
        .upload-progress { display: none; margin-top: 8px; background: #e5e7eb; border-radius: 99px; height: 5px; overflow: hidden; }
        .upload-progress.show { display: block; }
        .upload-progress-bar { height: 100%; background: var(--green-primary); border-radius: 99px; width: 0%; transition: width 0.3s ease; }

        /* ── Nav buttons ── */
        .btn-next {
            background: var(--green-primary); color: #fff; border: none; border-radius: 12px;
            padding: 11px 32px; font-size: 0.95rem; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 14px rgba(22,163,74,0.28);
            transition: background 0.2s, transform 0.15s;
        }
        .btn-next:hover { background: var(--green-dark); transform: translateY(-1px); }
        .btn-prev {
            background: #fff; color: #374151; border: 1.5px solid #d1d5db; border-radius: 12px;
            padding: 10px 28px; font-size: 0.95rem; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-prev:hover { background: #f9fafb; border-color: #9ca3af; }

        /* ── Terms ── */
        .terms-wrapper { display: flex; align-items: flex-start; gap: 10px; background: var(--green-light); border: 1.5px solid var(--green-border); border-radius: 10px; padding: 14px 16px; }
        .terms-wrapper input[type="checkbox"] { accent-color: var(--green-primary); width: 17px; height: 17px; margin-top: 1px; flex-shrink: 0; }

        /* ── Tooltip ── */
        .tooltip-wrapper { position: relative; display: inline-flex; align-items: center; margin-left: 4px; }
        .tooltip-icon { color: #9ca3af; font-size: 0.78rem; cursor: help; }
        .tooltip-box { position: absolute; left: 50%; bottom: calc(100% + 6px); transform: translateX(-50%); background: #1f2937; color: #fff; font-size: 0.72rem; padding: 6px 10px; border-radius: 7px; pointer-events: none; opacity: 0; transition: opacity 0.2s; z-index: 100; max-width: 220px; white-space: normal; text-align: center; }
        .tooltip-wrapper:hover .tooltip-box { opacity: 1; }

        /* ── Shared Capital amount input ── */
        .amount-prefix-wrap { display: flex; border: 1.5px solid var(--border-color); border-radius: 10px; overflow: hidden; background: var(--gray-input); transition: border-color 0.2s, box-shadow 0.2s; }
        .amount-prefix-wrap:focus-within { border-color: var(--green-primary); background: #fff; box-shadow: 0 0 0 3px rgba(74,222,128,0.18); }
        .amount-prefix { padding: 10px 12px; background: #f3f4f6; border-right: 1.5px solid var(--border-color); color: #374151; font-weight: 600; font-size: 0.88rem; display: flex; align-items: center; }
        .amount-input { flex: 1; border: none; background: transparent; padding: 10px 14px; font-size: 0.9rem; color: #1f2937; outline: none; }

        /* ── Page indicator ── */
        .page-tag { display: inline-flex; align-items: center; gap-6px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 99px; padding: 3px 12px; font-size: 0.72rem; font-weight: 600; color: #15803d; margin-bottom: 18px; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">

@if (session('success'))
    <!-- Success Modal (server-confirmed) -->
    <div id="successModal" class="fixed inset-0 z-[9999] hidden" aria-hidden="true">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative min-h-full flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="px-6 pt-6 pb-4">
                    <div class="w-12 h-12 rounded-2xl bg-green-50 border border-green-200 flex items-center justify-center text-green-700 mb-3">
                        <i class="fas fa-circle-check text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Application submitted</h3>
                    <p class="text-sm text-gray-600 mt-2 break-words">{{ session('success') }}</p>
                </div>
                <div class="px-6 pb-6 flex justify-end gap-2">
                    <button type="button" id="successModalOk"
                            class="btn-next"
                            style="padding: 10px 22px; border-radius: 12px;">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- ── NAVBAR ── -->
<header class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 lg:py-0">
        <a href="{{ route('Landing.Page') }}" class="flex items-center gap-2 sm:gap-3 py-1 sm:py-2 flex-shrink-0">
            <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo" class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain">
            <span class="font-semibold text-base sm:text-lg lg:text-xl text-green-700 tracking-tight whitespace-nowrap">GBLDC</span>
        </a>
        <nav class="hidden lg:flex items-center gap-1 xl:gap-4 text-sm xl:text-base font-medium">
            <a href="{{ route('Landing.Page') }}" class="px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors">Home</a>
            <div class="relative group">
                <button class="flex items-center gap-1 px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors focus:outline-none">
                    <span>Services</span><i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180 duration-200"></i>
                </button>
                <div class="absolute left-0 top-full mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
                    <a href="#" class="block px-4 py-3 text-sm hover:bg-green-50 hover:text-green-700 rounded-t-lg">Loans</a>
                    <a href="#" class="block px-4 py-3 text-sm hover:bg-green-50 hover:text-green-700">Deposits</a>
                    <a href="#" class="block px-4 py-3 text-sm hover:bg-green-50 hover:text-green-700 rounded-b-lg">Savings</a>
                </div>
            </div>
            <div class="relative group">
                <button class="flex items-center gap-1 px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors focus:outline-none">
                    <span>About</span><i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180 duration-200"></i>
                </button>
                <div class="absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
                    <a href="#" class="block px-4 py-3 text-sm hover:bg-green-50 hover:text-green-700 rounded-t-lg">About GBLDC</a>
                    <a href="#" class="block px-4 py-3 text-sm hover:bg-green-50 hover:text-green-700">Board of Directors</a>
                    <a href="#" class="block px-4 py-3 text-sm hover:bg-green-50 hover:text-green-700 rounded-b-lg">Committee Officers</a>
                </div>
            </div>
            <a href="#" class="px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-700 transition-colors whitespace-nowrap">News & Events</a>
        </nav>
        <a href="{{ route('Member.Login') }}" class="hidden lg:inline-block bg-green-600 text-white px-10 py-2 rounded-full text-sm font-semibold shadow hover:bg-green-700 transition">Login</a>
        <button class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full hover:bg-green-50" onclick="toggleMobileMenu()">
            <i class="fas fa-bars text-gray-600"></i>
        </button>
    </div>
    <!-- Mobile nav -->
    <div id="mobile-menu" class="lg:hidden absolute top-full left-0 w-full bg-white border-b border-gray-100 shadow-lg -translate-y-full invisible transition-all duration-300 z-40">
        <nav class="px-4 py-4 space-y-1">
            <a href="{{ route('Landing.Page') }}" class="block px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 font-medium">Home</a>
            <a href="#" class="block px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-700 font-medium">News & Events</a>
        </nav>
    </div>
</header>

<!-- ── HERO ── -->
<div class="max-w-3xl mx-auto mt-24 px-4 text-center pt-6">
    <div class="inline-flex items-center gap-2 bg-green-50 border border-green-200 rounded-full px-4 py-1.5 text-sm text-green-700 font-medium mb-3">
        <i class="fas fa-user-plus text-xs"></i> New Member Application
    </div>
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Online Registration</h2>
    <p class="text-gray-500 mt-1.5 text-sm">Fill out all steps below to apply for GBLDC membership</p>
</div>

<!-- ── STEP PROGRESS ── -->
<div class="max-w-3xl mx-auto px-4 mt-6">
    <div class="step-bar">

        <div class="step-item">
            <div class="step-circle active" id="circle-1"><i class="fas fa-user text-xs"></i></div>
            <div class="step-label active" id="label-1">Personal</div>
        </div>
        <div class="step-connector" id="conn-1"></div>

        <div class="step-item">
            <div class="step-circle" id="circle-2"><i class="fas fa-location-dot text-xs"></i></div>
            <div class="step-label" id="label-2">Address</div>
        </div>
        <div class="step-connector" id="conn-2"></div>

        <div class="step-item">
            <div class="step-circle" id="circle-3"><i class="fas fa-phone-volume text-xs"></i></div>
            <div class="step-label" id="label-3">Emergency</div>
        </div>
        <div class="step-connector" id="conn-3"></div>

        <div class="step-item">
            <div class="step-circle" id="circle-4"><i class="fas fa-briefcase text-xs"></i></div>
            <div class="step-label" id="label-4">Employment</div>
        </div>
        <div class="step-connector" id="conn-4"></div>

        <div class="step-item">
            <div class="step-circle" id="circle-5"><i class="fas fa-coins text-xs"></i></div>
            <div class="step-label" id="label-5">Capital</div>
        </div>
        <div class="step-connector" id="conn-5"></div>

        <div class="step-item">
            <div class="step-circle" id="circle-6"><i class="fas fa-paperclip text-xs"></i></div>
            <div class="step-label" id="label-6">Documents</div>
        </div>

    </div>
</div>

<!-- ── FORM CARD ── -->
<form id="registrationForm" action="{{ route('registration.Processing') }}" method="POST" enctype="multipart/form-data"
      class="max-w-3xl mx-auto mt-5 mb-14 px-4">
    @csrf

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-6 md:px-10 py-8">

        <!-- ════════════════════════════════
             STEP 1 — PERSONAL INFORMATION
        ════════════════════════════════ -->
        <div class="form-page active" id="page-1">
            <div class="page-tag mb-4"><i class="fas fa-circle-check text-green-500 mr-1.5"></i> Step 1 of 6</div>

            <div class="section-header">
                <div class="section-icon"><i class="fas fa-user"></i></div>
                <div>
                    <h3>Personal Information</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Your accurate personal details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div>
                    <label class="field-label">Last Name <span class="req">*</span></label>
                    <input type="text" name="last_name" class="form-input" placeholder="e.g. Dela Cruz" required>
                </div>
                <div>
                    <label class="field-label">First Name <span class="req">*</span></label>
                    <input type="text" name="first_name" class="form-input" placeholder="e.g. Juan" required>
                </div>
                <div>
                    <label class="field-label">Middle Name <span class="req">*</span></label>
                    <input type="text" name="middle_name" class="form-input" placeholder="e.g. Santos" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="field-label">Place of Birth <span class="req">*</span></label>
                    <input type="text" name="place_of_birth" class="form-input" placeholder="City/Municipality" required>
                </div>
                <div>
                    <label class="field-label">Birth Date <span class="req">*</span></label>
                    <input id="birthDate" type="date" name="birthdate" class="form-input" required onchange="calculateAge()">
                </div>
                <div>
                    <label class="field-label">Age <span class="req">*</span></label>
                    <input id="age" type="number" name="age" class="form-input" readonly required placeholder="Auto-filled">
                </div>
            </div>

            <!-- Gender (bordered) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="field-label">Gender <span class="req">*</span></label>
                    <div class="gender-group">
                        <label class="gender-option" id="genderMaleLabel" onclick="selectGender('Male')">
                            <input type="radio" name="gender" value="Male" required>
                            <span class="gender-icon">♂</span> Male
                        </label>
                        <label class="gender-option" id="genderFemaleLabel" onclick="selectGender('Female')">
                            <input type="radio" name="gender" value="Female">
                            <span class="gender-icon">♀</span> Female
                        </label>
                    </div>
                </div>
                <div>
                    <label class="field-label">Religion <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="religion" class="form-select" required>
                            <option value="">Select Religion</option>
                            <option>ROMAN CATHOLIC</option><option>PROTESTANT</option><option>CHRISTIAN</option>
                            <option>BAPTIST</option><option>SEVENTH-DAY ADVENTIST</option><option>IGLESIA NI CRISTO</option>
                            <option>ADVENTIST</option><option>BUDDHISM</option><option>JESUS IS LORD MOVEMENT</option>
                            <option>JEHOVAH'S WITNESSES</option><option>METHODIST</option><option>NON-SECTARIAN</option>
                            <option>OTHER</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="field-label">Civil Status <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="civil_status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option>SINGLE</option><option>MARRIED</option><option>WIDOW</option><option>SEPARATED</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">Nationality <span class="req">*</span></label>
                    <input type="text" name="nationality" class="form-input" placeholder="e.g. Filipino" required>
                </div>
                <div>
                    <label class="field-label">Contact Number <span class="req">*</span></label>
                    <div class="phone-wrapper">
                        <span class="phone-prefix"><i class="fas fa-phone text-xs mr-1 text-gray-400"></i> +63</span>
                        <input type="tel" name="contact_number" class="phone-input" pattern="[9][0-9]{9}" maxlength="10"
                               placeholder="9XXXXXXXXX" required inputmode="numeric" oninput="validatePhone(this,'phoneError')">
                    </div>
                    <div class="field-hint error" id="phoneError"><i class="fas fa-circle-exclamation"></i> Must be 10 digits starting with 9.</div>
                </div>
            </div>

            <div class="mt-4">
                <label class="field-label">Email Address <span class="req">*</span></label>
                <div class="relative">
                    <i class=" absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                    <input type="email" name="email" id="emailInput" class="border border-gray-300 p-3 rounded-xl w-76 focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="juandelacruz@gmail.com" required oninput="validateEmail(this)">
                </div>
                <div class="field-hint error" id="emailError"><i class="fas fa-circle-exclamation"></i> Please enter a valid email address.</div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="button" class="btn-next" onclick="goToStep(2)">
                    Next <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </div>
        </div>

        <!-- ════════════════════════════════
             STEP 2 — HOME ADDRESS
        ════════════════════════════════ -->
        <div class="form-page" id="page-2">
            <div class="page-tag mb-4"><i class="fas fa-circle-check text-green-500 mr-1.5"></i> Step 2 of 6</div>

            <div class="section-header">
                <div class="section-icon"><i class="fas fa-location-dot"></i></div>
                <div>
                    <h3>Home Address</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Your current residential address</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
    <div>
        <label class="field-label">Province <span class="req">*</span></label>
        <div class="select-wrapper">
            <select id="psgc_province" name="province" class="form-select" required>
                <option value="" selected>Select Province</option>
            </select>
        </div>
    </div>
    <div>
        <label class="field-label">City / Municipality <span class="req">*</span></label>
        <div class="select-wrapper">
            <select id="psgc_city" name="city" class="form-select" required disabled>
                <option value="" selected>Select City</option>
            </select>
        </div>
    </div>
    <div>
        <label class="field-label">Barangay <span class="req">*</span></label>
        <div class="select-wrapper">
            <select id="psgc_barangay" name="barangay" class="form-select" required disabled>
                <option value="" selected>Select Barangay</option>
            </select>
        </div>
    </div>

    <!-- Street Address spans 2 columns -->
    <div class="md:col-span-2">
        <label class="field-label">Street Address <span class="req">*</span></label>
        <input type="text" name="street_address" class="form-input" placeholder="House No. & Street Name" required>
    </div>

    <!-- Years of Stay in the 3rd column -->
    <div>
        <label class="field-label">Years of Stay <span class="req">*</span></label>
        <div class="relative">
            <input type="number" name="year_of_stay" class="form-input pr-10" placeholder="e.g. 5" min="0" max="100" required oninput="validateYearsOfStay(this)">
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 pointer-events-none">yrs</span>
        </div>
        <div class="field-hint error" id="yearsError"><i class="fas fa-circle-exclamation"></i> Enter a valid number (0–100).</div>
    </div>
</div>

<!-- Second row: House Ownership + Zip Code -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
    <div class="md:col-span-2">
        <label class="field-label">House Ownership <span class="req">*</span></label>
        <div class="select-wrapper">
            <select name="house_ownership" class="form-select" required>
                <option value="">Select Ownership</option>
                <option>Owned</option>
                <option>Rented</option>
                <option>Living with Parents</option>
                <option>Other</option>
            </select>
        </div>
    </div>
    <div>
        <label class="field-label">
            Zip Code <span class="req">*</span>
            <span class="tooltip-wrapper">
                <i class="fas fa-circle-info tooltip-icon"></i>
                <span class="tooltip-box">Philippine postal codes are 4 digits, e.g. 3019 for Marilao, Bulacan.</span>
            </span>
        </label>
        <input type="text" name="zip_code" id="zipCode" class="form-input" placeholder="e.g. 3019" maxlength="4" required oninput="validateZipCode(this)" inputmode="numeric">
        <div class="field-hint error"   id="zipError"><i class="fas fa-circle-exclamation"></i> Must be exactly 4 digits.</div>
        <div class="field-hint success" id="zipSuccess"><i class="fas fa-check-circle"></i> Valid zip code.</div>
    </div>
</div>

            <div class="flex justify-between mt-8">
                <button type="button" class="btn-prev" onclick="goToStep(1)"><i class="fas fa-arrow-left text-sm"></i> Back</button>
                <button type="button" class="btn-next" onclick="goToStep(3)">Next <i class="fas fa-arrow-right text-sm"></i></button>
            </div>
        </div>

        <!-- ════════════════════════════════
             STEP 3 — EMERGENCY CONTACT
        ════════════════════════════════ -->
        <div class="form-page" id="page-3">
            <div class="page-tag mb-4"><i class="fas fa-circle-check text-green-500 mr-1.5"></i> Step 3 of 6</div>

            <div class="section-header">
                <div class="section-icon"><i class="fas fa-phone-volume"></i></div>
                <div>
                    <h3>Emergency Contact</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Person to contact in case of emergency</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div>
                    <label class="field-label">Full Name <span class="req">*</span></label>
                    <input type="text" name="ec_fullname" class="form-input" placeholder="Full Name" required>
                </div>
                <div>
                    <label class="field-label">Gender <span class="req">*</span></label>
                    <div class="gender-group">
                        <label class="gender-option" id="ecGenderMaleLabel" onclick="selectGender('Male','ec_gender','ecGenderMaleLabel','ecGenderFemaleLabel')">
                            <input type="radio" name="ec_gender" value="Male" required>
                            <span class="gender-icon">♂</span> Male
                        </label>
                        <label class="gender-option" id="ecGenderFemaleLabel" onclick="selectGender('Female','ec_gender','ecGenderMaleLabel','ecGenderFemaleLabel')">
                            <input type="radio" name="ec_gender" value="Female">
                            <span class="gender-icon">♀</span> Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">Email Address <span class="req">*</span></label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                        <input type="email" name="ec_email" class="form-input pl-8" placeholder="you@example.com" required oninput="validateEmailGeneric(this)">
                    </div>
                </div>
                <div>
                    <label class="field-label">Contact Number <span class="req">*</span></label>
                    <div class="phone-wrapper">
                        <span class="phone-prefix"><i class="fas fa-phone text-xs mr-1 text-gray-400"></i> +63</span>
                        <input type="tel" name="ec_contact_number" class="phone-input" pattern="[9][0-9]{9}" maxlength="10"
                               placeholder="9XXXXXXXXX" required inputmode="numeric" oninput="validatePhone(this,'ecPhoneError')">
                    </div>
                    <div class="field-hint error" id="ecPhoneError"><i class="fas fa-circle-exclamation"></i> Must be 10 digits starting with 9.</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">Home Address <span class="req">*</span></label>
                    <input type="text" name="ec_address" class="form-input" placeholder="Complete Address" required>
                </div>
                <div>
                    <label class="field-label">Relationship <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="ec_relationship" class="form-select" required>
                            <option value="">Select Relationship</option>
                            <option>Parent</option><option>Spouse</option><option>Sibling</option>
                            <option>Child</option><option>Relative</option><option>Friend</option>
                            <option>Colleague</option><option>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" class="btn-prev" onclick="goToStep(2)"><i class="fas fa-arrow-left text-sm"></i> Back</button>
                <button type="button" class="btn-next" onclick="goToStep(4)">Next <i class="fas fa-arrow-right text-sm"></i></button>
            </div>
        </div>

        <!-- ════════════════════════════════
             STEP 4 — EMPLOYMENT INFORMATION
        ════════════════════════════════ -->
        <div class="form-page" id="page-4">
            <div class="page-tag mb-4"><i class="fas fa-circle-check text-green-500 mr-1.5"></i> Step 4 of 6</div>

            <div class="section-header">
                <div class="section-icon"><i class="fas fa-briefcase"></i></div>
                <div>
                    <h3>Employment Information</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Your employment and financial background</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div>
                    <label class="field-label">Employment Status <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="employment_status" class="form-select" required>
                            <option value="">Select</option>
                            <option>Employed</option><option>Self Employed</option><option>Unemployed</option>
                            <option>Retired</option><option>Student</option><option>Freelancer</option>
                            <option>OFW</option><option>Part Time</option><option>Contractual</option>
                            <option>Seasonal</option><option>Business Owner</option><option>Homemaker</option>
                            <option>Disabled</option><option>Others</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="field-label">Source of Funds <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="source_of_funds" class="form-select" required>
                            <option value="">Select</option>
                            <option>Salary</option><option>Business</option><option>Pension</option>
                            <option>Remittance</option><option>Investment</option><option>Allowance</option>
                            <option>Rental Income</option><option>Others</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">Employer / Business Name <span class="req">*</span></label>
                    <input type="text" name="employer_business_name" class="form-input" placeholder="Name of employer or business" required>
                </div>
                <div>
                    <label class="field-label">Occupation <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="occupation" class="form-select" required>
                            <option value="">Select Occupation</option>
                            <option>Accountant</option><option>Engineer</option><option>Teacher</option>
                            <option>Doctor</option><option>Nurse</option><option>Police Officer</option>
                            <option>Firefighter</option><option>Driver</option><option>Salesperson</option>
                            <option>Cashier</option><option>Manager</option><option>Clerk</option>
                            <option>Farmer</option><option>Fisherman</option><option>Construction Worker</option>
                            <option>Business Owner</option><option>Self-Employed</option><option>Student</option>
                            <option>Retired</option><option>Unemployed</option><option>Others</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="field-label">Company / Business Address <span class="req">*</span></label>
                <input type="text" name="company_business_address" class="form-input" placeholder="Complete business address" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">Gross Monthly Income <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="gross_monthly_income" class="form-select" required>
                            <option value="">Select</option>
                            <option value="below 10000">Below ₱10,000</option>
                            <option value="10000 - 20000">₱10,000 – ₱20,000</option>
                            <option value="20001 - 30000">₱20,001 – ₱30,000</option>
                            <option value="30001 - 50000">₱30,001 – ₱50,000</option>
                            <option value="50001 - 100000">₱50,001 – ₱100,000</option>
                            <option value="above 100000">Above ₱100,000</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="field-label">Nature / Type of Employment <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="nature_type_of_employment_business" class="form-select" required>
                            <option value="">Select</option>
                            <option>Government</option><option>Private</option><option>Self-Employed</option>
                            <option>OFW</option><option>Freelancer</option><option>Business Owner</option>
                            <option>Retired</option><option>Student</option><option>Unemployed</option>
                            <option>Non-Profit/NGO</option><option>Contractual</option><option>Part-Time</option>
                            <option>Seasonal</option><option>Others</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SSS / TIN with em-dash format -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">
                        SSS / GSIS No. <span class="req">*</span>
                        <span class="tooltip-wrapper">
                            <i class="fas fa-circle-info tooltip-icon"></i>
                            <span class="tooltip-box">SSS: XX–XXXXXXX–X (10 digits). GSIS: 11 digits.</span>
                        </span>
                    </label>
                    <input type="text" name="sss_gsis_no" id="sssInput" class="form-input"
                           placeholder="e.g. 34–1234567–8" maxlength="14" oninput="validateSSS(this)" required>
                    <div class="field-hint error"   id="sssError"><i class="fas fa-circle-exclamation"></i> Invalid SSS/GSIS — check the digits.</div>
                    <div class="field-hint success" id="sssSuccess"><i class="fas fa-check-circle"></i> Valid SSS/GSIS number.</div>
                    <div class="field-hint info"    id="sssInfo"><i class="fas fa-circle-info"></i> SSS: XX–XXXXXXX–X &nbsp;|&nbsp; GSIS: 11 digits</div>
                </div>
                <div>
                    <label class="field-label">
                        TIN No. <span class="req">*</span>
                        <span class="tooltip-wrapper">
                            <i class="fas fa-circle-info tooltip-icon"></i>
                            <span class="tooltip-box">Format: XXX-XXX-XXX or XXX-XXX-XXX-XXXX</span>
                        </span>
                    </label>
                    <input type="text" name="tin_no" id="tinInput" class="form-input"
                           placeholder="e.g. 123-456-789" maxlength="15" oninput="validateTIN(this)" required>
                    <div class="field-hint error"   id="tinError"><i class="fas fa-circle-exclamation"></i> TIN format: XXX-XXX-XXX or XXX-XXX-XXX-XXXX.</div>
                    <div class="field-hint success" id="tinSuccess"><i class="fas fa-check-circle"></i> Valid TIN number.</div>
                    <div class="field-hint info"    id="tinInfo"><i class="fas fa-circle-info"></i> Format: XXX-XXX-XXX or XXX-XXX-XXX-XXXX</div>
                </div>
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" class="btn-prev" onclick="goToStep(3)"><i class="fas fa-arrow-left text-sm"></i> Back</button>
                <button type="button" class="btn-next" onclick="goToStep(5)">Next <i class="fas fa-arrow-right text-sm"></i></button>
            </div>
        </div>

        <!-- ════════════════════════════════
             STEP 5 — SHARED CAPITAL
        ════════════════════════════════ -->
        <div class="form-page" id="page-5">
            <div class="page-tag mb-4"><i class="fas fa-circle-check text-green-500 mr-1.5"></i> Step 5 of 6</div>

            <div class="section-header">
                <div class="section-icon"><i class="fas fa-coins"></i></div>
                <div>
                    <h3>Shared Capital</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Your initial capital contribution to GBLDC</p>
                </div>
            </div>

            <!-- Info notice -->
            <div class="flex items-start gap-3 bg-blue-50 border border-blue-200 rounded-xl px-4 py-3 mt-5 text-sm text-blue-800">
                <i class="fas fa-circle-info mt-0.5 flex-shrink-0 text-blue-500"></i>
                <p>Shared capital is the member's equity contribution to the cooperative. Minimum initial share capital is <strong>₱1,000.00</strong>. Additional shares may be subscribed in multiples of ₱100.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div>
                    <label class="field-label">No. of Shares Subscribed <span class="req">*</span></label>
                    <input type="number" name="shares_subscribed" id="sharesSubscribed" class="form-input"
                           placeholder="e.g. 10" min="1" required oninput="computeCapital()">
                    <div class="field-hint info" style="display:flex;"><i class="fas fa-circle-info"></i> Each share = ₱100.00</div>
                </div>
                <div>
                    <label class="field-label">Total Subscribed Capital <span class="req">*</span></label>
                    <div class="amount-prefix-wrap">
                        <span class="amount-prefix">₱</span>
                        <input type="text" name="total_subscribed_capital" id="totalSubscribed" class="amount-input"
                               placeholder="0.00" readonly required>
                    </div>
                    <div class="field-hint info" style="display:flex;"><i class="fas fa-circle-info"></i> Auto-computed (shares × ₱100)</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">Initial Payment <span class="req">*</span></label>
                    <div class="amount-prefix-wrap">
                        <span class="amount-prefix">₱</span>
                        <input type="number" name="initial_payment" id="initialPayment" class="amount-input"
                               placeholder="e.g. 1000.00" min="1000" step="100" required oninput="validateInitialPayment()">
                    </div>
                    <div class="field-hint error"   id="paymentError"><i class="fas fa-circle-exclamation"></i> Minimum initial payment is ₱1,000.</div>
                    <div class="field-hint success" id="paymentSuccess"><i class="fas fa-check-circle"></i> Valid initial payment.</div>
                </div>
                <div>
                    <label class="field-label">Mode of Payment <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="mode_of_payment" class="form-select" required>
                            <option value="">Select Mode</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="GCash">GCash</option>
                            <option value="Maya">Maya</option>
                            <option value="Check">Check</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="field-label">Beneficiary Full Name <span class="req">*</span></label>
                    <input type="text" name="beneficiary_name" class="form-input" placeholder="Full Name of Beneficiary" required>
                </div>
                <div>
                    <label class="field-label">Beneficiary Relationship <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select name="beneficiary_relationship" class="form-select" required>
                            <option value="">Select Relationship</option>
                            <option>Spouse</option><option>Child</option><option>Parent</option>
                            <option>Sibling</option><option>Relative</option><option>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="field-label">Beneficiary Address <span class="req">*</span></label>
                <input type="text" name="beneficiary_address" class="form-input" placeholder="Complete Address of Beneficiary" required>
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" class="btn-prev" onclick="goToStep(4)"><i class="fas fa-arrow-left text-sm"></i> Back</button>
                <button type="button" class="btn-next" onclick="goToStep(6)">Next <i class="fas fa-arrow-right text-sm"></i></button>
            </div>
        </div>

        <!-- ════════════════════════════════
             STEP 6 — ATTACHMENTS & SUBMIT
        ════════════════════════════════ -->
        <div class="form-page" id="page-6">
            <div class="page-tag mb-4"><i class="fas fa-circle-check text-green-500 mr-1.5"></i> Step 6 of 6</div>

            <div class="section-header">
                <div class="section-icon"><i class="fas fa-paperclip"></i></div>
                <div>
                    <h3>Attachments</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Upload clear and legible copies of required documents</p>
                </div>
            </div>

            <div class="flex items-start gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 mt-5 text-sm text-amber-800">
                <i class="fas fa-triangle-exclamation mt-0.5 flex-shrink-0 text-amber-500"></i>
                <p><strong>File Requirements:</strong> Accepted: JPG, PNG, PDF. Max <strong>25 MB</strong> per file. Ensure documents are clear and legible.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
                <!-- 2x2 Picture -->
                <div>
                    <label class="field-label">2×2 Picture <span class="req">*</span></label>
                    <div class="upload-zone" id="picZone"
                         ondragover="onDragOver(event,'picZone')" ondragleave="onDragLeave(event,'picZone')"
                         ondrop="onDrop(event,'picFile','picPreviewImg','picError','picSuccess','picProgress','picProgressBar','picZone')">
                        <input type="file" name="two_by_two_picture" id="picFile" accept="image/jpeg,image/png,application/pdf" required
                               onchange="handleFile(this,'picPreviewImg','picError','picSuccess','picProgress','picProgressBar','picZone',25)">
                        <div id="picPrompt">
                            <div class="upload-icon"><i class="fas fa-camera"></i></div>
                            <div class="upload-label">Upload Photo</div>
                            <div class="upload-text">Drag & drop or click<br><span class="text-xs">JPG, PNG, PDF · max 25 MB</span></div>
                        </div>
                    </div>
                    <div class="upload-progress" id="picProgress"><div class="upload-progress-bar" id="picProgressBar"></div></div>
                    <div class="upload-error" id="picError"><i class="fas fa-circle-xmark"></i> <span></span></div>
                    <div class="upload-success" id="picSuccess"><i class="fas fa-circle-check"></i> <span></span></div>
                    <div class="upload-preview" id="picPreview">
                        <button type="button" class="upload-remove-btn" onclick="removeFile('picFile','picPreviewImg','picError','picSuccess','picProgress','picPreview','picPrompt','picZone')"><i class="fas fa-times"></i></button>
                        <img id="picPreviewImg" src="" alt="Preview">
                        <div class="preview-filename" id="picFilename"></div>
                    </div>
                </div>

                <!-- Proof of Billing -->
                <div>
                    <label class="field-label">Proof of Billing <span class="req">*</span></label>
                    <div class="upload-zone" id="billingZone"
                         ondragover="onDragOver(event,'billingZone')" ondragleave="onDragLeave(event,'billingZone')"
                         ondrop="onDrop(event,'billingFile','billingPreviewImg','billingError','billingSuccess','billingProgress','billingProgressBar','billingZone')">
                        <input type="file" name="proof_of_billing" id="billingFile" accept="image/jpeg,image/png,application/pdf" required
                               onchange="handleFile(this,'billingPreviewImg','billingError','billingSuccess','billingProgress','billingProgressBar','billingZone',25)">
                        <div id="billingPrompt">
                            <div class="upload-icon"><i class="fas fa-file-invoice"></i></div>
                            <div class="upload-label">Upload Billing</div>
                            <div class="upload-text">Drag & drop or click<br><span class="text-xs">JPG, PNG, PDF · max 25 MB</span></div>
                        </div>
                    </div>
                    <div class="upload-progress" id="billingProgress"><div class="upload-progress-bar" id="billingProgressBar"></div></div>
                    <div class="upload-error" id="billingError"><i class="fas fa-circle-xmark"></i> <span></span></div>
                    <div class="upload-success" id="billingSuccess"><i class="fas fa-circle-check"></i> <span></span></div>
                    <div class="upload-preview" id="billingPreview">
                        <button type="button" class="upload-remove-btn" onclick="removeFile('billingFile','billingPreviewImg','billingError','billingSuccess','billingProgress','billingPreview','billingPrompt','billingZone')"><i class="fas fa-times"></i></button>
                        <img id="billingPreviewImg" src="" alt="Preview">
                        <div class="preview-filename" id="billingFilename"></div>
                    </div>
                </div>

                <!-- Valid ID -->
                <div>
                    <label class="field-label">Valid ID <span class="req">*</span></label>
                    <div class="upload-zone" id="idZone"
                         ondragover="onDragOver(event,'idZone')" ondragleave="onDragLeave(event,'idZone')"
                         ondrop="onDrop(event,'validIdFile','idPreviewImg','idError','idSuccess','idProgress','idProgressBar','idZone')">
                        <input type="file" name="valid_id" id="validIdFile" accept="image/jpeg,image/png,application/pdf" required
                               onchange="handleFile(this,'idPreviewImg','idError','idSuccess','idProgress','idProgressBar','idZone',25)">
                        <div id="idPrompt">
                            <div class="upload-icon"><i class="fas fa-id-card"></i></div>
                            <div class="upload-label">Upload Valid ID</div>
                            <div class="upload-text">Drag & drop or click<br><span class="text-xs">JPG, PNG, PDF · max 25 MB</span></div>
                        </div>
                    </div>
                    <div class="upload-progress" id="idProgress"><div class="upload-progress-bar" id="idProgressBar"></div></div>
                    <div class="upload-error" id="idError"><i class="fas fa-circle-xmark"></i> <span></span></div>
                    <div class="upload-success" id="idSuccess"><i class="fas fa-circle-check"></i> <span></span></div>
                    <div class="upload-preview" id="idPreview">
                        <button type="button" class="upload-remove-btn" onclick="removeFile('validIdFile','idPreviewImg','idError','idSuccess','idProgress','idPreview','idPrompt','idZone')"><i class="fas fa-times"></i></button>
                        <img id="idPreviewImg" src="" alt="Preview">
                        <div class="preview-filename" id="idFilename"></div>
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Terms -->
            <div class="terms-wrapper">
                <input type="checkbox" id="terms" required>
                <label for="terms" class="text-sm text-gray-700 cursor-pointer">
                    I confirm that all information I have provided is accurate and complete. I agree to the
                    <a href="#" class="text-green-700 underline font-medium hover:text-green-800">Terms & Conditions</a> of GBLDC,
                    and I consent to the processing of my personal data as described in the Privacy Policy.
                </label>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
                <button type="button" class="btn-prev" onclick="goToStep(5)"><i class="fas fa-arrow-left text-sm"></i> Back</button>
                <div class="flex items-center gap-3">
                    <p class="text-xs text-gray-400"><i class="fas fa-lock mr-1"></i> Secure & encrypted</p>
                    <button type="submit" class="btn-next">
                        <i class="fas fa-paper-plane text-sm"></i> Submit Application
                    </button>
                </div>
            </div>
        </div>

    </div><!-- /card -->
</form>

<script>
// ── Step navigation ────────────────────────────────────────────────
const TOTAL_STEPS = 6;
let currentStep = 1;

// ── Success modal (shown only after backend confirms save) ─────────
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('successModal');
    if (!modal) return;

    var okBtn = document.getElementById('successModalOk');
    var backdrop = modal.querySelector('.absolute.inset-0');

    var close = function () {
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
    };

    okBtn && okBtn.addEventListener('click', close);
    backdrop && backdrop.addEventListener('click', close);

    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');
});

function goToStep(n) {
    // When moving forward, validate current step's required fields first
    if (n > currentStep) {
        var page = document.getElementById('page-' + currentStep);
        var fields = page.querySelectorAll('input:not([type="hidden"]), select, textarea');
        for (var i = 0; i < fields.length; i++) {
            var el = fields[i];
            if (el.hasAttribute('required') && !el.disabled) {
                if (!el.checkValidity()) {
                    el.reportValidity();
                    el.focus();
                    return;
                }
            }
        }
    }
    // Hide current
    document.getElementById('page-' + currentStep).classList.remove('active');
    // Update stepper
    updateStepper(currentStep, n);
    currentStep = n;
    // Show new
    document.getElementById('page-' + n).classList.add('active');
    // Scroll to top of card
    document.getElementById('registrationForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function updateStepper(from, to) {
    for (let i = 1; i <= TOTAL_STEPS; i++) {
        const circle = document.getElementById('circle-' + i);
        const label  = document.getElementById('label-' + i);
        if (i < to) {
            circle.classList.remove('active'); circle.classList.add('done');
            label.classList.remove('active');  label.classList.add('done');
        } else if (i === to) {
            circle.classList.remove('done'); circle.classList.add('active');
            label.classList.remove('done');  label.classList.add('active');
        } else {
            circle.classList.remove('active','done');
            label.classList.remove('active','done');
        }
        if (i < TOTAL_STEPS) {
            const conn = document.getElementById('conn-' + i);
            conn.classList.toggle('done', i < to);
        }
    }
}

// ── Age ────────────────────────────────────────────────────────────
function calculateAge() {
    const bd = document.getElementById('birthDate').value;
    const el = document.getElementById('age');
    if (!bd) { el.value = ''; return; }
    const today = new Date(), birth = new Date(bd);
    let age = today.getFullYear() - birth.getFullYear();
    const m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
    el.value = age >= 0 ? age : '';
}

// ── Gender bordered selection ──────────────────────────────────────
function selectGender(val, name = 'gender', maleId = 'genderMaleLabel', femaleId = 'genderFemaleLabel') {
    const maleLabel   = document.getElementById(maleId);
    const femaleLabel = document.getElementById(femaleId);
    maleLabel.classList.toggle('selected',   val === 'Male');
    femaleLabel.classList.toggle('selected', val === 'Female');
    // Check the hidden radio
    const radios = document.querySelectorAll(`input[name="${name}"]`);
    radios.forEach(r => { r.checked = r.value === val; });
}

// ── Shared Capital compute ─────────────────────────────────────────
function computeCapital() {
    const shares = parseInt(document.getElementById('sharesSubscribed').value) || 0;
    const total  = shares * 100;
    document.getElementById('totalSubscribed').value = total > 0 ? total.toLocaleString('en-PH', { minimumFractionDigits: 2 }) : '';
}

function validateInitialPayment() {
    const val   = parseFloat(document.getElementById('initialPayment').value);
    const errEl = document.getElementById('paymentError');
    const okEl  = document.getElementById('paymentSuccess');
    if (!document.getElementById('initialPayment').value) {
        errEl.classList.remove('show'); okEl.classList.remove('show'); return;
    }
    if (val >= 1000) {
        errEl.classList.remove('show'); okEl.classList.add('show');
    } else {
        okEl.classList.remove('show'); errEl.classList.add('show');
    }
}

// ── Phone ──────────────────────────────────────────────────────────
function validatePhone(input, errorId) {
    input.value = input.value.replace(/\D/g,'');
    const ok = input.value.length === 10 && input.value.startsWith('9');
    const empty = input.value.length === 0;
    const el = document.getElementById(errorId);
    if (empty) { el.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    if (ok) { el.classList.remove('show'); input.classList.add('is-valid'); input.classList.remove('is-invalid'); }
    else    { el.classList.add('show');    input.classList.add('is-invalid'); input.classList.remove('is-valid'); }
}

// ── Email ──────────────────────────────────────────────────────────
function validateEmail(input) {
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value);
    const el = document.getElementById('emailError');
    if (!input.value) { el.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    if (ok) { el.classList.remove('show'); input.classList.add('is-valid'); input.classList.remove('is-invalid'); }
    else    { el.classList.add('show');    input.classList.add('is-invalid'); input.classList.remove('is-valid'); }
}
function validateEmailGeneric(input) {
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value);
    if (!input.value) { input.classList.remove('is-valid','is-invalid'); return; }
    input.classList.toggle('is-valid',   ok);
    input.classList.toggle('is-invalid', !ok);
}

// ── Zip code ──────────────────────────────────────────────────────
function validateZipCode(input) {
    input.value = input.value.replace(/\D/g,'');
    const ok = input.value.length === 4;
    const empty = input.value.length === 0;
    const errEl = document.getElementById('zipError');
    const okEl  = document.getElementById('zipSuccess');
    if (empty) { errEl.classList.remove('show'); okEl.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    if (ok) { errEl.classList.remove('show'); okEl.classList.add('show'); input.classList.add('is-valid'); input.classList.remove('is-invalid'); }
    else    { okEl.classList.remove('show');  errEl.classList.add('show'); input.classList.add('is-invalid'); input.classList.remove('is-valid'); }
}

// ── Years ─────────────────────────────────────────────────────────
function validateYearsOfStay(input) {
    const v = parseInt(input.value);
    const el = document.getElementById('yearsError');
    if (input.value === '') { el.classList.remove('show'); input.classList.remove('is-valid','is-invalid'); return; }
    if (!isNaN(v) && v >= 0 && v <= 100) { el.classList.remove('show'); input.classList.add('is-valid'); input.classList.remove('is-invalid'); }
    else { el.classList.add('show'); input.classList.add('is-invalid'); input.classList.remove('is-valid'); }
}

// ── SSS/GSIS — em dash (–) format ─────────────────────────────────
function validateSSS(input) {
    let raw = input.value.replace(/[^\d]/g,'');
    const EM = '\u2013'; // –
    if (raw.length <= 10) {
        let f = raw;
        if (raw.length > 2) f = raw.slice(0,2) + EM + raw.slice(2);
        if (raw.length > 9) f = raw.slice(0,2) + EM + raw.slice(2,9) + EM + raw.slice(9);
        input.value = f;
    } else {
        input.value = raw.slice(0,11);
    }
    const digits = input.value.replace(/[^\d]/g,'');
    const empty  = digits.length === 0;
    const ok     = digits.length === 10 || digits.length === 11;
    const errEl  = document.getElementById('sssError');
    const okEl   = document.getElementById('sssSuccess');
    const infoEl = document.getElementById('sssInfo');
    if (empty) { errEl.classList.remove('show'); okEl.classList.remove('show'); infoEl.classList.add('show'); input.classList.remove('is-valid','is-invalid'); return; }
    infoEl.classList.remove('show');
    if (ok) { errEl.classList.remove('show'); okEl.classList.add('show'); input.classList.add('is-valid'); input.classList.remove('is-invalid'); }
    else    { okEl.classList.remove('show');  errEl.classList.add('show'); input.classList.add('is-invalid'); input.classList.remove('is-valid'); }
}

// ── TIN ────────────────────────────────────────────────────────────
function validateTIN(input) {
    let raw = input.value.replace(/\D/g,'');
    let f = raw;
    if (raw.length > 3) f = raw.slice(0,3) + '-' + raw.slice(3);
    if (raw.length > 6) f = raw.slice(0,3) + '-' + raw.slice(3,6) + '-' + raw.slice(6);
    if (raw.length > 9) f = raw.slice(0,3) + '-' + raw.slice(3,6) + '-' + raw.slice(6,9) + '-' + raw.slice(9,13);
    input.value = f;
    const digits = raw;
    const empty  = digits.length === 0;
    const ok     = digits.length === 9 || digits.length === 12;
    const errEl  = document.getElementById('tinError');
    const okEl   = document.getElementById('tinSuccess');
    const infoEl = document.getElementById('tinInfo');
    if (empty) { errEl.classList.remove('show'); okEl.classList.remove('show'); infoEl.classList.add('show'); input.classList.remove('is-valid','is-invalid'); return; }
    infoEl.classList.remove('show');
    if (ok) { errEl.classList.remove('show'); okEl.classList.add('show'); input.classList.add('is-valid'); input.classList.remove('is-invalid'); }
    else    { okEl.classList.remove('show');  errEl.classList.add('show'); input.classList.add('is-invalid'); input.classList.remove('is-valid'); }
}

// Focus hints for SSS/TIN
document.getElementById('sssInput').addEventListener('focus', () => { if (!document.getElementById('sssInput').value) document.getElementById('sssInfo').classList.add('show'); });
document.getElementById('sssInput').addEventListener('blur',  () => document.getElementById('sssInfo').classList.remove('show'));
document.getElementById('tinInput').addEventListener('focus', () => { if (!document.getElementById('tinInput').value) document.getElementById('tinInfo').classList.add('show'); });
document.getElementById('tinInput').addEventListener('blur',  () => document.getElementById('tinInfo').classList.remove('show'));

// ── File upload ────────────────────────────────────────────────────
const MAX_MB   = 25;
const ACCEPTED = ['image/jpeg','image/png','application/pdf'];

function fmtSize(b) {
    if (b < 1024) return b + ' B';
    if (b < 1048576) return (b/1024).toFixed(1) + ' KB';
    return (b/1048576).toFixed(2) + ' MB';
}

function handleFile(input, previewImgId, errorId, successId, progressId, progressBarId, zoneId, maxMB) {
    const file = input.files[0];
    const errEl  = document.getElementById(errorId);
    const okEl   = document.getElementById(successId);
    const progEl = document.getElementById(progressId);
    const barEl  = document.getElementById(progressBarId);
    const zone   = document.getElementById(zoneId);
    const prefix = zoneId.replace('Zone','');
    const previewEl  = document.getElementById(prefix + 'Preview');
    const promptEl   = document.getElementById(prefix + 'Prompt');
    const filenameEl = document.getElementById(prefix + 'Filename');

    errEl.classList.remove('show'); okEl.classList.remove('show');
    progEl.classList.remove('show'); barEl.style.width = '0%';
    if (previewEl) previewEl.style.display = 'none';
    zone.style.borderColor = '';
    if (!file) return;

    if (!ACCEPTED.includes(file.type)) {
        errEl.querySelector('span').textContent = `Unsupported type. Use JPG, PNG, or PDF.`;
        errEl.classList.add('show'); input.value = ''; zone.style.borderColor = '#ef4444'; return;
    }
    if (file.size > maxMB * 1048576) {
        errEl.querySelector('span').textContent = `File too large: ${fmtSize(file.size)}. Max is ${maxMB} MB.`;
        errEl.classList.add('show'); input.value = ''; zone.style.borderColor = '#ef4444'; return;
    }

    progEl.classList.add('show');
    let pct = 0;
    const iv = setInterval(() => {
        pct += Math.random() * 30;
        if (pct >= 100) {
            pct = 100; clearInterval(iv);
            progEl.classList.remove('show');
            okEl.querySelector('span').textContent = `${file.name} (${fmtSize(file.size)}) ready.`;
            okEl.classList.add('show'); zone.style.borderColor = '#22c55e';
            if (file.type.startsWith('image/')) {
                const r = new FileReader();
                r.onload = e => {
                    document.getElementById(previewImgId).src = e.target.result;
                    if (previewEl) previewEl.style.display = 'block';
                    if (promptEl)  promptEl.style.display  = 'none';
                    if (filenameEl) filenameEl.textContent = file.name;
                };
                r.readAsDataURL(file);
            } else {
                document.getElementById(previewImgId).src = '';
                if (previewEl) { previewEl.style.display = 'block'; previewEl.querySelector('img').style.display = 'none'; }
                if (!previewEl.querySelector('.pdf-label')) {
                    const d = document.createElement('div');
                    d.className = 'pdf-label text-sm text-gray-600 text-left mt-2';
                    d.innerHTML = '<i class="fas fa-file-pdf text-red-500 mr-2"></i>' + file.name;
                    previewEl.insertBefore(d, previewEl.querySelector('.preview-filename'));
                }
                if (promptEl) promptEl.style.display = 'none';
                if (filenameEl) filenameEl.textContent = file.name;
            }
        }
        barEl.style.width = Math.min(pct, 100) + '%';
    }, 70);
}

function removeFile(inputId, previewImgId, errorId, successId, progressId, previewDivId, promptId, zoneId) {
    document.getElementById(inputId).value = '';
    document.getElementById(errorId).classList.remove('show');
    document.getElementById(successId).classList.remove('show');
    document.getElementById(progressId).classList.remove('show');
    document.getElementById(previewDivId).style.display = 'none';
    document.getElementById(promptId).style.display = '';
    document.getElementById(zoneId).style.borderColor = '';
    const img = document.getElementById(previewImgId);
    if (img) { img.src = ''; img.style.display = ''; }
    const pdf = document.getElementById(previewDivId).querySelector('.pdf-label');
    if (pdf) pdf.remove();
}

function onDragOver(e, zoneId) { e.preventDefault(); document.getElementById(zoneId).classList.add('dragover'); }
function onDragLeave(e, zoneId){ document.getElementById(zoneId).classList.remove('dragover'); }
function onDrop(e, inputId, previewImgId, errorId, successId, progressId, progressBarId, zoneId) {
    e.preventDefault();
    document.getElementById(zoneId).classList.remove('dragover');
    const file = e.dataTransfer.files[0]; if (!file) return;
    const input = document.getElementById(inputId);
    const dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
    handleFile(input, previewImgId, errorId, successId, progressId, progressBarId, zoneId, MAX_MB);
}

// ── Mobile menu ────────────────────────────────────────────────────
function toggleMobileMenu() {
    const m = document.getElementById('mobile-menu');
    m.classList.toggle('-translate-y-full');
    m.classList.toggle('invisible');
}
</script>
</body>

<script>
  // PSGC dynamic address dropdowns (Province → City/Municipality → Barangay)
  (function () {
    const PSGC = 'https://psgc.gitlab.io/api';
    const provinceEl = document.getElementById('psgc_province');
    const cityEl = document.getElementById('psgc_city');
    const barangayEl = document.getElementById('psgc_barangay');
    const zipEl = document.getElementById('zipCode');
    if (!provinceEl || !cityEl || !barangayEl) return;

    const PREFILL = {
      province: @json(old('province', '')),
      city: @json(old('city', '')),
      barangay: @json(old('barangay', '')),
    };

    const lookupZipForCity = (cityName, cityCode) => {
      if (!zipEl) return;

      // clear current zip when city changes (avoid stale value)
      zipEl.value = '';
      zipEl.classList.remove('is-valid', 'is-invalid');
      const errEl = document.getElementById('zipError');
      const okEl = document.getElementById('zipSuccess');
      if (errEl) errEl.classList.remove('show');
      if (okEl) okEl.classList.remove('show');

      if (!cityName && !cityCode) return;

      fetch(`/zip-lookup?city_name=${encodeURIComponent(cityName || '')}&city_code=${encodeURIComponent(cityCode || '')}`)
        .then(r => r.json())
        .then(res => {
          if (res && typeof res.zip === 'string' && res.zip.trim() !== '') {
            zipEl.value = res.zip.trim();
            // trigger your existing zip validation UI
            if (typeof validateZipCode === 'function') validateZipCode(zipEl);
          }
        })
        .catch(() => {});
    };

    const setOptions = (el, placeholder, items) => {
      el.innerHTML = `<option value="">${placeholder}</option>`;
      items.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item.name;        // store NAME (matches current DB expectations)
        opt.textContent = item.name;
        opt.dataset.code = item.code; // keep code for chaining
        el.appendChild(opt);
      });
    };

    const findOptionByValue = (el, value) => {
      const v = (value || '').toLowerCase();
      if (!v) return null;
      return Array.from(el.options).find(o => (o.value || '').toLowerCase() === v) || null;
    };

    fetch(`${PSGC}/provinces/`)
      .then(r => r.json())
      .then(data => {
        data.sort((a, b) => a.name.localeCompare(b.name));
        setOptions(provinceEl, 'Select Province', data);
        if (PREFILL.province) {
          const opt = findOptionByValue(provinceEl, PREFILL.province);
          if (opt) provinceEl.value = opt.value;
        }
        provinceEl.dispatchEvent(new Event('change'));
      })
      .catch(() => {});

    provinceEl.addEventListener('change', function () {
      const selected = this.options[this.selectedIndex];
      const provCode = selected?.dataset?.code;

      cityEl.disabled = true;
      barangayEl.disabled = true;
      cityEl.innerHTML = `<option value="">Select City</option>`;
      barangayEl.innerHTML = `<option value="">Select Barangay</option>`;
      if (!provCode) return;

      fetch(`${PSGC}/provinces/${provCode}/cities-municipalities/`)
        .then(r => r.json())
        .then(data => {
          data.sort((a, b) => a.name.localeCompare(b.name));
          setOptions(cityEl, 'Select City', data);
          cityEl.disabled = false;
          if (PREFILL.city) {
            const opt = findOptionByValue(cityEl, PREFILL.city);
            if (opt) cityEl.value = opt.value;
            PREFILL.city = '';
          }
          cityEl.dispatchEvent(new Event('change'));
        })
        .catch(() => {});
    });

    cityEl.addEventListener('change', function () {
      const selected = this.options[this.selectedIndex];
      const cityCode = selected?.dataset?.code;
      const cityName = selected?.value || '';

      barangayEl.disabled = true;
      barangayEl.innerHTML = `<option value="">Select Barangay</option>`;
      lookupZipForCity(cityName, cityCode || '');
      if (!cityCode) return;

      fetch(`${PSGC}/cities-municipalities/${cityCode}/barangays/`)
        .then(r => r.json())
        .then(data => {
          data.sort((a, b) => a.name.localeCompare(b.name));
          setOptions(barangayEl, 'Select Barangay', data);
          barangayEl.disabled = false;
          if (PREFILL.barangay) {
            const opt = findOptionByValue(barangayEl, PREFILL.barangay);
            if (opt) barangayEl.value = opt.value;
            PREFILL.barangay = '';
          }
        })
        .catch(() => {});
    });
  })();
</script>
</html>