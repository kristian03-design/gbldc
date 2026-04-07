<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Schedule | GBLDC</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

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
      --amber:     #f59e0b;
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
    .breadcrumb .sep { color: #d1d5db; display: flex; align-items: center; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Type toggle ── */
    .type-toggle {
      display: inline-flex; background: var(--white);
      border: 1px solid var(--border); border-radius: 10px;
      padding: 4px; margin-bottom: 24px; gap: 4px;
    }
    .type-btn {
      padding: 8px 20px; border-radius: 7px; border: none;
      font-size: 13px; font-weight: 600; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      color: var(--muted); background: transparent;
      transition: background .2s, color .2s;
      display: flex; align-items: center; gap: 7px;
    }
    .type-btn i[data-lucide] { width: 14px; height: 14px; }
    .type-btn.active { background: var(--forest); color: #fff; }

    /* ── Stats row ── */
    .stats-row {
      display: grid; grid-template-columns: repeat(4, 1fr);
      gap: 16px; margin-bottom: 24px;
    }
    .stat-card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 14px; padding: 16px 18px;
      display: flex; align-items: center; gap: 14px;
    }
    .stat-icon {
      width: 40px; height: 40px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .stat-icon i[data-lucide] { width: 18px; height: 18px; }
    .stat-icon.green  { background: var(--sage);     color: var(--forest); }
    .stat-icon.red    { background: #fee2e2;          color: #dc2626; }
    .stat-icon.amber  { background: #fef3c7;          color: #b45309; }
    .stat-icon.blue   { background: #dbeafe;          color: #1d4ed8; }
    .stat-label { font-size: 11px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 2px; }
    .stat-value { font-size: 20px; font-weight: 700; color: var(--ink); line-height: 1; }

    /* ── Calendar card ── */
    .calendar-card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; overflow: hidden;
    }
    .calendar-card-header {
      padding: 16px 22px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
    }
    .calendar-card-header h2 {
      font-size: 15px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .calendar-card-header h2 i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }
    .legend { display: flex; gap: 14px; flex-wrap: wrap; }
    .legend-item { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--muted); }
    .legend-dot { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }
    .legend-dot.paid     { background: #16a34a; }
    .legend-dot.overdue  { background: #dc2626; }
    .legend-dot.upcoming { background: #2563eb; }
    .legend-dot.current  { background: var(--forest); }

    .calendar-wrap { padding: 20px 22px; }

    /* ── FullCalendar overrides ── */
    .fc { font-family: 'DM Sans', sans-serif !important; font-size: 13px; }
    .fc .fc-toolbar-title { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: var(--forest); }
    .fc .fc-button {
      background: var(--forest) !important; border-color: var(--forest) !important;
      font-family: 'DM Sans', sans-serif !important; font-size: 12px !important;
      font-weight: 600 !important; border-radius: 8px !important;
      padding: 6px 12px !important; box-shadow: none !important;
    }
    .fc .fc-button:hover { background: var(--forest-mid) !important; border-color: var(--forest-mid) !important; }
    .fc .fc-button-active { background: var(--forest-mid) !important; border-color: var(--forest-mid) !important; }
    .fc .fc-col-header-cell { background: #f9fafb; padding: 8px 0; }
    .fc .fc-col-header-cell-cushion { font-size: 12px; font-weight: 700; color: var(--muted); text-decoration: none !important; text-transform: uppercase; letter-spacing: .05em; }
    .fc .fc-daygrid-day-number { font-size: 12px; font-weight: 600; color: var(--muted); text-decoration: none !important; padding: 6px 8px; }
    .fc .fc-day-today { background: rgba(13,74,47,.04) !important; }
    .fc .fc-day-today .fc-daygrid-day-number { color: var(--forest); font-weight: 700; }
    .fc .fc-event { border-radius: 6px !important; font-size: 11px !important; font-weight: 600 !important; border: none !important; padding: 2px 6px !important; cursor: pointer; }
    .fc .fc-event:hover { opacity: .85; }
    .fc .fc-daygrid-event-dot { border-color: var(--emerald) !important; }
    .fc th { border-color: var(--border) !important; }
    .fc td { border-color: var(--border) !important; }
    .fc .fc-scrollgrid { border-color: var(--border) !important; border-radius: 10px; overflow: hidden; }
    .fc .fc-scrollgrid-section > td { border: none; }
    .fc-theme-standard .fc-scrollgrid { border: 1px solid var(--border) !important; }
    .fc .fc-toolbar.fc-header-toolbar { margin-bottom: 16px; }

    /* ── Event tooltip ── */
    .event-tooltip {
      position: fixed; z-index: 9999;
      background: var(--ink); color: #fff;
      padding: 8px 12px; border-radius: 8px;
      font-size: 12px; pointer-events: none;
      max-width: 200px; line-height: 1.5;
      box-shadow: 0 4px 12px rgba(0,0,0,.2);
      display: none;
    }

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
      .stats-row { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
      .stats-row { grid-template-columns: 1fr 1fr; }
      .type-toggle { width: 100%; justify-content: stretch; }
      .type-btn { flex: 1; justify-content: center; }
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
    <div class="profile-avatar {{ strtolower($gender) == 'female' ? 'female' : 'male' }}">
      @if(auth('officialmember')->check() && auth('officialmember')->user()->profile_picture)
        <img src="{{ asset('images/profile_pictures/' . auth('officialmember')->user()->profile_picture) }}" alt="Profile" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
      @elseif(isset($gender) && strtolower($gender) == 'female' || (isset($AutoComplete->gender) && strtolower($AutoComplete->gender) == 'female') || (isset($user) && strtolower($user->gender ?? '') == 'female'))
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{ $fist_name }} {{ $last_name }}</div>
      <div style="margin-top: 5px; display: inline-flex; align-items: center; gap: 5px; padding: 4px 8px; border-radius: 6px; background: rgba(255, 255, 255, 0.1); font-size: 11px; font-weight: 600; color: #d1fae5; border: 1px solid rgba(255, 255, 255, 0.15); letter-spacing: 0.03em;">
        <i data-lucide="id-card" style="width: 12px; height: 12px; opacity: 0.9;"></i> {{$member_id}}
      </div>
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
    <a href="{{ route('Member.Check.Shared.Capital') }}" class="nav-item">
      <i data-lucide="piggy-bank"></i> Check Shared Capital
    </a>
    <a href="{{ route('Member.Notifications') }}" class="nav-item">
      <i data-lucide="bell"></i> Notification
    </a>
    <a href="{{ route('Member.ContactUs') }}" class="nav-item">
      <i data-lucide="mail"></i> Contact Us
    </a>
    <a href="{{ route('Member.FAQ') }}" class="nav-item">
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
    <h1>Payment Schedule</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <i data-lucide="house" style="width:12px;height:12px;"></i>
      <a href="{{ route('Member.Landing') }}">Home</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <span class="current">Payment Schedule</span>
    </nav>
  </header>

  <div class="page-body">

    {{-- ── Type Toggle ── --}}
    <div class="type-toggle">
      @if($loanInfo)
      <button class="type-btn {{ $type === 'loan' ? 'active' : '' }}" onclick="switchType('loan')">
        <i data-lucide="banknote"></i> Loan Schedule
      </button>
      @endif
      @if($sharedCapitalInfo)
      <button class="type-btn {{ $type === 'shared_capital' ? 'active' : '' }}" onclick="switchType('shared_capital')">
        <i data-lucide="piggy-bank"></i> Shared Capital
      </button>
      @endif
    </div>

    {{-- ── Stats ── --}}
    @php
      $scheduleData = $type === 'loan' ? ($loanScheduleData ?? null) : ($sharedCapitalScheduleData ?? null);
      $paidCount     = 0;
      $overdueCount  = 0;
      $upcomingCount = 0;
      $totalCount    = 0;

      if ($type === 'loan' && $scheduleData) {
        foreach ($scheduleData as $m) {
          $totalCount++;
          if ($m->status === 'paid')   $paidCount++;
          elseif ($m->status === 'overdue') $overdueCount++;
          else                     $upcomingCount++;
        }
      } elseif ($type !== 'loan' && $scheduleData && isset($scheduleData['months'])) {
        foreach ($scheduleData['months'] as $m) {
          $totalCount++;
          if ($m['paymentMade'])   $paidCount++;
          elseif ($m['isOverdue']) $overdueCount++;
          else                     $upcomingCount++;
        }
      }
    @endphp

    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-icon green"><i data-lucide="circle-check-big"></i></div>
        <div>
          <div class="stat-label">Paid</div>
          <div class="stat-value">{{ $paidCount }}</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon red"><i data-lucide="circle-alert"></i></div>
        <div>
          <div class="stat-label">Overdue</div>
          <div class="stat-value">{{ $overdueCount }}</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon blue"><i data-lucide="clock"></i></div>
        <div>
          <div class="stat-label">Upcoming</div>
          <div class="stat-value">{{ $upcomingCount }}</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon amber"><i data-lucide="calendar"></i></div>
        <div>
          <div class="stat-label">Total Payments</div>
          <div class="stat-value">{{ $totalCount }}</div>
        </div>
      </div>
    </div>

    {{-- ── Calendar ── --}}
    <div class="calendar-card">
      <div class="calendar-card-header">
        <h2><i data-lucide="calendar-days"></i>
          @if($type === 'loan') Loan Payment Calendar
          @else Shared Capital Payment Calendar
          @endif
        </h2>
        <div class="legend">
          <div class="legend-item"><div class="legend-dot paid"></div> Paid</div>
          <div class="legend-item"><div class="legend-dot overdue"></div> Overdue</div>
          <div class="legend-item"><div class="legend-dot upcoming"></div> Upcoming</div>
          <div class="legend-item"><div class="legend-dot current"></div> Today</div>
        </div>
      </div>
      <div class="calendar-wrap">
        <div id="fullcalendar"></div>
      </div>
    </div>

  </div><!-- /page-body -->
</div><!-- /main -->

<!-- Tooltip -->
<div class="event-tooltip" id="tooltip"></div>

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

  // ── Sidebar mobile ──
  const sidebar = document.getElementById('sidebar');
  const mobileToggle = document.getElementById('mobileToggle');
  mobileToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  document.addEventListener('click', e => {
    if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
      sidebar.classList.remove('open');
    }
  });

  // ── Logout modal ──
  const logoutModal = document.getElementById('logout-modal');
  function openLogoutModal()  { logoutModal.classList.add('open'); }
  function closeLogoutModal() { logoutModal.classList.remove('open'); }
  logoutModal.addEventListener('click', e => { if (e.target === logoutModal) closeLogoutModal(); });

  // ── Type switcher ──
  function switchType(type) {
    const url = new URL(window.location.href);
    url.searchParams.set('type', type);
    window.location.href = url.toString();
  }

  // ── Build FullCalendar events from Laravel blade data ──
  const events = [];

  @php
    $activeData = $type === 'loan' ? ($loanScheduleData ?? null) : ($sharedCapitalScheduleData ?? null);
  @endphp

  @if($type === 'loan' && $activeData)
    @foreach($activeData as $schedule)
      @php
        $dateStr = $schedule->due_date->format('Y-m-d');
        $amount = number_format($schedule->monthly_payment + $schedule->penalty, 2);
      @endphp
      @if($schedule->status === 'paid')
        events.push({
          title: '✓ Paid ₱{{$amount}}',
          start: '{{ $dateStr }}',
          backgroundColor: '#16a34a',
          borderColor: '#16a34a',
          extendedProps: { status: 'paid', amount: '{{$amount}}' }
        });
      @elseif($schedule->status === 'overdue')
        events.push({
          title: '⚠ Overdue ₱{{$amount}}',
          start: '{{ $dateStr }}',
          backgroundColor: '#dc2626',
          borderColor: '#dc2626',
          extendedProps: { status: 'overdue', amount: '{{$amount}}' }
        });
      @else
        events.push({
          title: '◷ Due ₱{{$amount}}',
          start: '{{ $dateStr }}',
          backgroundColor: '#2563eb',
          borderColor: '#2563eb',
          extendedProps: { status: 'upcoming', amount: '{{$amount}}' }
        });
      @endif
    @endforeach
  @elseif($type !== 'loan' && $activeData && isset($activeData['months']))
    @foreach($activeData['months'] as $monthData)
      @php
        // Build a date string for the payment due day (default to 1st of month)
        $payDay = isset($monthData['payment_day']) ? $monthData['payment_day'] : 1;
        $dateStr = sprintf('%04d-%02d-%02d', $monthData['year'], $monthData['month'], $payDay);
      @endphp
      @if($monthData['paymentMade'])
        events.push({
          title: '✓ Paid',
          start: '{{ $dateStr }}',
          backgroundColor: '#16a34a',
          borderColor: '#16a34a',
          extendedProps: { status: 'paid', month: '{{ $monthData["name"] }}' }
        });
      @elseif($monthData['isOverdue'])
        events.push({
          title: '⚠ Overdue',
          start: '{{ $dateStr }}',
          backgroundColor: '#dc2626',
          borderColor: '#dc2626',
          extendedProps: { status: 'overdue', month: '{{ $monthData["name"] }}' }
        });
      @else
        events.push({
          title: '◷ Due',
          start: '{{ $dateStr }}',
          backgroundColor: '#2563eb',
          borderColor: '#2563eb',
          extendedProps: { status: 'upcoming', month: '{{ $monthData["name"] }}' }
        });
      @endif
    @endforeach
  @endif

  @if($type !== 'loan' && $activeData && isset($activeData['paymentDays']))
    @foreach($activeData['paymentDays'] as $pd)
      @if($pd['isPaymentDay'])
        @php
          $dateStr = sprintf('%04d-%02d-%02d', $activeData['year'], $activeData['month'], $pd['day']);
        @endphp
        @if($pd['paymentMade'])
          events.push({
            title: '✓ Paid',
            start: '{{ $dateStr }}',
            backgroundColor: '#16a34a',
            borderColor: '#16a34a',
            extendedProps: { status: 'paid' }
          });
        @elseif($pd['isOverdue'])
          events.push({
            title: '⚠ Overdue',
            start: '{{ $dateStr }}',
            backgroundColor: '#dc2626',
            borderColor: '#dc2626',
            extendedProps: { status: 'overdue' }
          });
        @else
          events.push({
            title: '◷ Due',
            start: '{{ $dateStr }}',
            backgroundColor: '#2563eb',
            borderColor: '#2563eb',
            extendedProps: { status: 'upcoming' }
          });
        @endif
      @endif
    @endforeach
  @endif

  // ── Initialize FullCalendar ──
  const calEl = document.getElementById('fullcalendar');
  const tooltip = document.getElementById('tooltip');

  const calendar = new FullCalendar.Calendar(calEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left:   'prev,next today',
      center: 'title',
      right:  'dayGridMonth,dayGridYear'
    },
    buttonText: {
      today:        'Today',
      month:        'Month',
      year:         'Year',
    },
    events: events,
    height: 'auto',
    dayMaxEvents: 3,
    eventDidMount(info) {
      info.el.addEventListener('mouseenter', e => {
        const props = info.event.extendedProps;
        const statusMap = { paid: 'Paid ✓', overdue: 'Overdue ⚠', upcoming: 'Upcoming ◷' };
        tooltip.innerHTML = `
          <strong>${info.event.startStr}</strong><br>
          Status: ${statusMap[props.status] || props.status}
          ${props.month ? '<br>Month: ' + props.month : ''}
        `;
        tooltip.style.display = 'block';
      });
      info.el.addEventListener('mousemove', e => {
        tooltip.style.left = (e.clientX + 12) + 'px';
        tooltip.style.top  = (e.clientY - 10) + 'px';
      });
      info.el.addEventListener('mouseleave', () => {
        tooltip.style.display = 'none';
      });
    },
    dayCellDidMount(info) {
      // Highlight today's cell number
      const today = new Date();
      if (
        info.date.getFullYear() === today.getFullYear() &&
        info.date.getMonth()    === today.getMonth() &&
        info.date.getDate()     === today.getDate()
      ) {
        const num = info.el.querySelector('.fc-daygrid-day-number');
        if (num) {
          num.style.background    = 'var(--forest)';
          num.style.color         = '#fff';
          num.style.borderRadius  = '50%';
          num.style.width         = '26px';
          num.style.height        = '26px';
          num.style.display       = 'flex';
          num.style.alignItems    = 'center';
          num.style.justifyContent= 'center';
        }
      }
    }
  });

  calendar.render();
</script>
</body>
</html>
