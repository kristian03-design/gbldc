<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications | GBLDC</title>
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
      --amber:     #f59e0b;
      --sky:       #3b82f6;
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

    /* ── Sidebar (unchanged) ── */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--forest);
      color: #fff;
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; bottom: 0;
      z-index: 100;
      transition: transform .3s ease;
    }
    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 22px 20px 18px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }
    .sidebar-profile {
      margin: 14px 12px;
      padding: 12px;
      background: rgba(255,255,255,.07);
      border-radius: 12px;
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
    .profile-avatar svg { width: 22px; height: 22px; }
    .profile-name { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.3; }
    .sidebar-nav { flex: 1; padding: 8px 12px; overflow-y: auto; }
    .nav-item {
      display: flex; align-items: center; justify-content: space-between;
      padding: 10px 12px; border-radius: 10px;
      text-decoration: none;
      color: rgba(255,255,255,.7);
      font-size: 14px; font-weight: 500;
      transition: background .2s, color .2s;
      margin-bottom: 2px;
    }
    .nav-group { display: flex; align-items: center; gap: 12px; }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }
    .nav-item.danger { color: rgba(248,113,113,.8); }
    .nav-item.danger:hover { background: rgba(239,68,68,.1); color: #fca5a5; }
    .badge-unread { background: var(--rose); color: white; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 10px; }
    .sidebar-footer {
      padding: 14px 12px;
      border-top: 1px solid rgba(255,255,255,.1);
      font-size: 11px; opacity: .35; text-align: center;
    }

    /* ── Mobile toggle ── */
    .mobile-toggle {
      display: none;
      position: fixed; top: 14px; left: 14px;
      z-index: 200;
      width: 38px; height: 38px; border-radius: 10px;
      background: var(--forest); color: #fff;
      border: none; cursor: pointer;
      align-items: center; justify-content: center;
    }
    .mobile-toggle i[data-lucide] { width: 18px; height: 18px; }

    /* ── Main ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1; display: flex;
      flex-direction: column; min-height: 100vh;
    }

    /* ── Topbar — REDESIGNED ── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 0 36px;
      position: sticky; top: 0; z-index: 50;
      display: flex; justify-content: space-between; align-items: stretch;
      min-height: 72px;
    }
    .topbar-left {
      display: flex; align-items: center; gap: 16px;
    }
    .topbar-icon-wrap {
      width: 46px; height: 46px; border-radius: 14px;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .topbar-icon-wrap i { width: 22px; height: 22px; color: var(--forest); }
    .topbar-title {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700; color: var(--forest); line-height: 1.2;
    }
    .topbar-sub {
      font-size: 12px; color: var(--muted); margin-top: 2px; display: flex; align-items: center; gap: 5px;
    }
    .topbar-sub a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .topbar-sub a:hover { color: var(--forest); }
    .topbar-sub .sep { color: #d1d5db; }
    .topbar-sub .current { color: var(--ink); font-weight: 600; }

    .topbar-right {
      display: flex; align-items: center; gap: 12px;
    }
    .topbar-pill {
      display: inline-flex; align-items: center; gap: 7px;
      background: var(--sage); color: var(--forest);
      font-size: 12px; font-weight: 700;
      padding: 7px 14px; border-radius: 30px;
      letter-spacing: .02em;
    }
    .topbar-pill i { width: 14px; height: 14px; }
    .topbar-divider { height: 60%; width: 1px; background: var(--border); }

    /* ── Page body ── */
    .page-body {
      padding: 32px 36px; flex: 1;
      max-width: 920px; margin: 0 auto; width: 100%;
    }

    /* ── Section header ── */
    .section-header {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px;
    }
    .section-label {
      font-size: 11px; font-weight: 700; letter-spacing: .12em;
      text-transform: uppercase; color: var(--muted);
      display: flex; align-items: center; gap: 8px;
    }
    .section-label::before {
      content: ''; display: block; width: 3px; height: 14px;
      background: var(--emerald); border-radius: 2px;
    }
    .btn-mark-all {
      font-size: 12px; font-weight: 600; color: var(--forest);
      background: none; border: 1.5px solid var(--emerald);
      padding: 6px 14px; border-radius: 8px; cursor: pointer;
      transition: background .2s, color .2s;
      display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-mark-all i { width: 13px; height: 13px; }
    .btn-mark-all:hover { background: var(--emerald); color: #fff; }

    /* ── Empty State ── */
    .empty-state {
      text-align: center; padding: 80px 20px;
      background: var(--white); border-radius: 20px;
      border: 1.5px dashed var(--border);
    }
    .empty-icon-wrap {
      width: 80px; height: 80px; border-radius: 24px;
      background: var(--sage); margin: 0 auto 20px;
      display: flex; align-items: center; justify-content: center;
    }
    .empty-icon-wrap i { width: 36px; height: 36px; color: var(--forest); }
    .empty-state h3 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
    .empty-state p { font-size: 14px; color: var(--muted); max-width: 340px; margin: 0 auto; line-height: 1.6; }

    /* ── Notification Cards ── */
    .notif-list { display: flex; flex-direction: column; gap: 10px; }

    .notif-item {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      padding: 20px 24px;
      display: grid;
      grid-template-columns: 52px 1fr auto;
      gap: 16px;
      align-items: start;
      transition: transform .2s, box-shadow .2s;
      position: relative;
      animation: slideUp .35s ease both;
    }
    .notif-item:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,74,47,.07); }

    /* Unread: left accent bar */
    .notif-item.unread {
      border-color: transparent;
      background: linear-gradient(white, white) padding-box,
                  linear-gradient(135deg, #22c55e22, #0d4a2f11) border-box;
      border: 1px solid transparent;
      box-shadow: inset 3px 0 0 var(--emerald), 0 2px 12px rgba(13,74,47,.06);
    }

    /* Staggered animation */
    .notif-item:nth-child(1) { animation-delay: .05s; }
    .notif-item:nth-child(2) { animation-delay: .10s; }
    .notif-item:nth-child(3) { animation-delay: .15s; }
    .notif-item:nth-child(4) { animation-delay: .20s; }
    .notif-item:nth-child(5) { animation-delay: .25s; }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Icon */
    .notif-icon {
      width: 48px; height: 48px; border-radius: 14px; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
    }
    .notif-icon.loan { background: var(--sage); color: var(--forest-mid); }
    .notif-icon.system { background: #e0f2fe; color: #0284c7; }
    .notif-icon.alert { background: #fee2e2; color: #dc2626; }
    .notif-icon i { width: 22px; height: 22px; }

    /* Content */
    .notif-content { min-width: 0; }
    .notif-title {
      font-size: 15px; font-weight: 700; color: var(--ink);
      margin-bottom: 4px; line-height: 1.3;
    }
    .notif-message {
      font-size: 13.5px; color: var(--muted); line-height: 1.65;
    }
    .notif-actions { margin-top: 14px; display: flex; gap: 8px; flex-wrap: wrap; }

    /* Right meta column */
    .notif-meta {
      display: flex; flex-direction: column; align-items: flex-end; gap: 8px;
      flex-shrink: 0; padding-top: 2px;
    }
    .notif-time {
      font-size: 11.5px; color: var(--muted); font-weight: 500;
      white-space: nowrap;
    }
    .notif-dot {
      width: 8px; height: 8px; border-radius: 50%;
      background: var(--emerald);
    }

    /* Buttons */
    .btn-sm {
      font-size: 12px; font-weight: 600; padding: 7px 13px; border-radius: 8px;
      border: none; cursor: pointer; transition: background .2s, transform .1s;
      display: inline-flex; align-items: center; gap: 6px; text-decoration: none;
    }
    .btn-sm:active { transform: scale(.97); }
    .btn-sm i { width: 13px; height: 13px; }
    .btn-mark { background: #f3f4f6; color: var(--ink); }
    .btn-mark:hover { background: #e5e7eb; }
    .btn-action {
      background: var(--forest); color: white;
      box-shadow: 0 2px 8px rgba(13,74,47,.25);
    }
    .btn-action:hover { background: var(--forest-mid); }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .sidebar { transform: translateX(-260px); }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0; }
      .mobile-toggle { display: flex; }
      .page-body { padding: 20px 18px; }
      .topbar { padding: 0 18px; margin-left: 40px; }
    }
    @media (max-width: 640px) {
      .notif-item { grid-template-columns: 44px 1fr; }
      .notif-meta { flex-direction: row; align-items: center; grid-column: 1 / -1; justify-content: space-between; padding-top: 0; border-top: 1px solid var(--border); padding-top: 10px; margin-top: 4px; }
      .topbar-right { display: none; }
    }

    /* ── Modals ── */
    .modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.45); z-index: 200;
      align-items: center; justify-content: center; padding: 16px;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--white); border-radius: 20px;
      padding: 32px; width: 100%; max-width: 440px;
      animation: popIn .25s ease;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(10px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }
    .modal-h { font-size: 18px; font-weight: 700; text-align: center; margin-bottom: 6px; font-family: 'Playfair Display', serif; }
    .modal-p { font-size: 13px; color: var(--muted); text-align: center; margin-bottom: 24px; }
    .modal-btns { display: flex; gap: 10px; justify-content: center; }
    .modal-btn {
      flex: 1; padding: 12px; border-radius: 10px;
      font-size: 14px; font-weight: 600; text-align: center;
      border: none; cursor: pointer; text-decoration: none;
      transition: background .2s; font-family: 'DM Sans', sans-serif;
    }
    .modal-btn.cancel   { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover { background: #e5e7eb; }
    .modal-btn.danger   { background: var(--rose); color: #fff; }
    .modal-btn.danger:hover { background: #dc2626; }
  </style>
</head>
<body>

<!-- Mobile toggle -->
<button class="mobile-toggle" id="mobileToggle">
  <i data-lucide="menu"></i>
</button>

<!-- ═══ Sidebar (UNCHANGED) ═══ -->
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
    <div class="profile-avatar {{ strtolower($AutoComplete->gender ?? '') == 'female' ? 'female' : 'male' }}">
      @if(strtolower($AutoComplete->gender ?? '') == 'female')
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#ec4899;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @else
        <svg fill="currentColor" viewBox="0 0 24 24" style="color:#3b82f6;width:22px;height:22px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
      @endif
    </div>
    <div>
      <div class="profile-name">{{$AutoComplete->first_name ?? ''}} {{$AutoComplete->last_name ?? ''}}</div>
      <div style="margin-top: 5px; display: inline-flex; align-items: center; gap: 5px; padding: 4px 8px; border-radius: 6px; background: rgba(255, 255, 255, 0.1); font-size: 11px; font-weight: 600; color: #d1fae5; border: 1px solid rgba(255, 255, 255, 0.15); letter-spacing: 0.03em;">
        <i data-lucide="id-card" style="width: 12px; height: 12px; opacity: 0.9;"></i> {{$AutoComplete->member_id ?? ''}}
      </div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <a href="{{route('Member.Landing')}}" class="nav-item">
      <div class="nav-group"><i data-lucide="home"></i> Home</div>
    </a>
    <a href="{{route('Loan.Dashboard')}}" class="nav-item">
      <div class="nav-group"><i data-lucide="layout-dashboard"></i> Loan Dashboard</div>
    </a>
    <a href="{{ route('Member.Check.Loan.Status') }}" class="nav-item">
      <div class="nav-group"><i data-lucide="search"></i> Check Loan Status</div>
    </a>
    <a href="{{ route('Member.Check.Shared.Capital') }}" class="nav-item">
      <div class="nav-group"><i data-lucide="piggy-bank"></i> Check Shared Capital</div>
    </a>
    <a href="{{ route('Member.Notifications') }}" class="nav-item active">
      <div class="nav-group"><i data-lucide="bell"></i> Notification</div>
      <span class="badge-unread" id="notif-badge" style="display: none;">0</span>
    </a>
    <a href="{{ route('Member.ContactUs') }}" class="nav-item">
      <div class="nav-group"><i data-lucide="mail"></i> Contact Us</div>
    </a>
    <a href="#" class="nav-item">
      <div class="nav-group"><i data-lucide="circle-help"></i> FAQ</div>
    </a>
    <a href="{{ route('Member.AccountSettings') }}" class="nav-item">
      <div class="nav-group"><i data-lucide="settings"></i> Account Settings</div>
    </a>
    <a href="#" class="nav-item danger" onclick="openLogoutModal(); return false;">
      <div class="nav-group"><i data-lucide="log-out"></i> Logout</div>
    </a>
  </nav>

  <div class="sidebar-footer">GBLDC Member Portal &copy; 2025</div>
</aside>

<!-- ═══ Main Content ═══ -->
<main class="main" id="main">

  <!-- Topbar — REDESIGNED -->
  <div class="topbar">
    <div class="topbar-left">
      <div class="topbar-icon-wrap">
        <i data-lucide="bell"></i>
      </div>
      <div>
        <div class="topbar-title">Inbox & Alerts</div>
        <div class="topbar-sub">
          <a href="{{route('Member.Landing')}}">Member Portal</a>
          <span class="sep">/</span>
          <span class="current">Notifications</span>
        </div>
      </div>
    </div>
    <div class="topbar-right">
      <div class="topbar-pill" id="topbar-unread-pill" style="display:none;">
        <i data-lucide="circle-dot"></i>
        <span id="topbar-unread-label">0 unread</span>
      </div>
    </div>
  </div>

  <!-- Content Body -->
  <div class="page-body">

    @if(count($notifications) == 0)
      <!-- Empty State -->
      <div class="empty-state">
        <div class="empty-icon-wrap">
          <i data-lucide="inbox"></i>
        </div>
        <h3>You're all caught up!</h3>
        <p>You don't have any notifications at the moment. We'll alert you here when important updates happen.</p>
      </div>

    @else
      <!-- Section header -->
      <div class="section-header">
        <div class="section-label">All Notifications</div>
      </div>

      <!-- Notifications List -->
      <div class="notif-list">
        @foreach($notifications as $notif)
        <div class="notif-item {{ $notif->is_read ? '' : 'unread' }}" id="notif-{{ $notif->id }}">

          <!-- Icon -->
          <div class="notif-icon {{ $notif->type === 'loan_eligibility' ? 'loan' : 'system' }}">
            <i data-lucide="{{ $notif->type === 'loan_eligibility' ? 'award' : 'bell' }}"></i>
          </div>

          <!-- Content -->
          <div class="notif-content">
            <div class="notif-title">{{ $notif->title }}</div>
            <div class="notif-message">{{ $notif->message }}</div>

            <div class="notif-actions">
              @if($notif->type === 'loan_eligibility')
                <form action="{{ route('Redirecting.LoanApp') }}" method="GET" style="display:inline;">
                  @csrf
                  <input type="hidden" name="account" value="{{ $AutoComplete->member_id }}">
                  <button type="submit" class="btn-sm btn-action">
                    <i data-lucide="mouse-pointer-click"></i> Apply Now
                  </button>
                </form>
              @endif
              @if(!$notif->is_read)
                <button class="btn-sm btn-mark" onclick="markAsRead({{ $notif->id }})">
                  <i data-lucide="check-check"></i> Mark as Read
                </button>
              @endif
            </div>
          </div>

          <!-- Meta: time + unread dot -->
          <div class="notif-meta">
            <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
            @if(!$notif->is_read)
              <div class="notif-dot" id="dot-{{ $notif->id }}"></div>
            @endif
          </div>

        </div>
        @endforeach
      </div>
    @endif

  </div>
</main>

<!-- Logout Modal -->
<div class="modal-overlay" id="logoutModal">
  <div class="modal">
    <div style="text-align:center;margin-bottom:14px;">
      <div style="width:60px;height:60px;border-radius:18px;background:#fee2e2;display:flex;align-items:center;justify-content:center;margin:0 auto;">
        <i data-lucide="log-out" style="width:28px;height:28px;color:#ef4444;"></i>
      </div>
    </div>
    <h3 class="modal-h">Confirm Logout</h3>
    <p class="modal-p">Are you sure you want to log out of your GBLDC member portal account?</p>
    <div class="modal-btns">
      <button class="modal-btn cancel" onclick="closeLogoutModal()">Cancel</button>
      <a href="{{route('Member.Logout')}}" class="modal-btn danger">Log Out</a>
    </div>
  </div>
</div>

<script>
  lucide.createIcons();

  // Mobile toggle
  const mobileToggle = document.getElementById('mobileToggle');
  const sidebar = document.getElementById('sidebar');
  if (mobileToggle && sidebar) {
    mobileToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  }

  // Logout modal
  function openLogoutModal() { document.getElementById('logoutModal').classList.add('open'); }
  function closeLogoutModal() { document.getElementById('logoutModal').classList.remove('open'); }
  document.getElementById('logoutModal').addEventListener('click', function(e) {
    if (e.target === this) closeLogoutModal();
  });

  // Fetch & display unread count
  function fetchUnreadCount() {
    fetch('{{ route("Member.Notifications.Count") }}')
      .then(res => res.json())
      .then(data => {
        const badge = document.getElementById('notif-badge');
        const pill  = document.getElementById('topbar-unread-pill');
        const label = document.getElementById('topbar-unread-label');
        if (data.count > 0) {
          badge.textContent = data.count;
          badge.style.display = 'inline-block';
          pill.style.display  = 'inline-flex';
          label.textContent   = `${data.count} unread`;
        } else {
          badge.style.display = 'none';
          pill.style.display  = 'none';
        }
      });
  }

  // Mark as read
  function markAsRead(id) {
    fetch(`/Member-Notifications/${id}/read`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
      }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const item = document.getElementById(`notif-${id}`);
        item.classList.remove('unread');

        const markBtn = item.querySelector('.btn-mark');
        if (markBtn) markBtn.style.display = 'none';

        const dot = document.getElementById(`dot-${id}`);
        if (dot) dot.remove();

        fetchUnreadCount();
      }
    })
    .catch(err => {
      console.error(err);
      Swal.fire('Error', 'Could not mark notification as read.', 'error');
    });
  }

  document.addEventListener('DOMContentLoaded', fetchUnreadCount);
</script>

</body>
</html>
