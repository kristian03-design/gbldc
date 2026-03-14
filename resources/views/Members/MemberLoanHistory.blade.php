<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan History | GBLDC</title>
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
    .breadcrumb .sep { color: #d1d5db; display: flex; align-items: center; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

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
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .stat-icon i[data-lucide] { width: 18px; height: 18px; }
    .stat-icon.green  { background: var(--sage);  color: var(--forest); }
    .stat-icon.blue   { background: #dbeafe;       color: #1d4ed8; }
    .stat-icon.red    { background: #fee2e2;        color: #dc2626; }
    .stat-icon.amber  { background: #fef3c7;        color: #b45309; }
    .stat-label { font-size: 11px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 2px; }
    .stat-value { font-size: 20px; font-weight: 700; color: var(--ink); line-height: 1; }

    /* ── Table card ── */
    .table-card {
      background: var(--white); border-radius: 16px;
      border: 1px solid var(--border); overflow: hidden;
    }
    .table-card-header {
      padding: 16px 22px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;
    }
    .table-card-header h2 {
      font-size: 15px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .table-card-header h2 i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }

    /* ── Search input ── */
    .search-wrap { position: relative; }
    .search-wrap svg {
      position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
      width: 14px; height: 14px; color: var(--muted); pointer-events: none;
    }
    .search-input {
      padding: 8px 12px 8px 32px; border: 1px solid var(--border);
      border-radius: 8px; font-size: 13px; font-family: 'DM Sans', sans-serif;
      color: var(--ink); outline: none; background: var(--white); width: 220px;
      transition: border-color .2s, box-shadow .2s;
    }
    .search-input:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    .search-input::placeholder { color: #9ca3af; }

    /* ── Table ── */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; min-width: 620px; }
    thead tr { background: #f9fafb; border-bottom: 1px solid var(--border); }
    thead th {
      padding: 11px 16px; text-align: left;
      font-size: 11px; font-weight: 700; color: var(--muted);
      text-transform: uppercase; letter-spacing: .05em; white-space: nowrap;
    }
    tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #f9fafb; }
    tbody td { padding: 13px 16px; font-size: 13px; color: var(--ink); }
    .loan-number { font-weight: 700; color: var(--forest); font-size: 12px; letter-spacing: .02em; }
    .amount { font-weight: 600; }
    .term-badge {
      display: inline-flex; align-items: center; gap: 4px;
      background: #f3f4f6; color: var(--muted);
      padding: 3px 8px; border-radius: 6px; font-size: 11px; font-weight: 600;
    }

    /* ── Status badges ── */
    .badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 10px; border-radius: 20px;
      font-size: 11px; font-weight: 700; white-space: nowrap;
    }
    .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .badge-active   { background: #f0fdf4; color: #16a34a; }
    .badge-active::before   { background: #16a34a; }
    .badge-paid     { background: #eff6ff; color: #1d4ed8; }
    .badge-paid::before     { background: #2563eb; }
    .badge-defaulted{ background: #fef2f2; color: #dc2626; }
    .badge-defaulted::before{ background: #dc2626; }
    .badge-pending  { background: #fefce8; color: #a16207; }
    .badge-pending::before  { background: #ca8a04; }
    .badge-other    { background: #f3f4f6; color: var(--muted); }
    .badge-other::before    { background: #9ca3af; }

    /* ── Empty state ── */
    .empty-state {
      padding: 56px 20px; text-align: center; color: var(--muted);
    }
    .empty-state i[data-lucide] { width: 40px; height: 40px; margin: 0 auto 12px; display: block; opacity: .3; }
    .empty-state p { font-size: 14px; }

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
    @media (max-width: 500px) {
      .stats-row { grid-template-columns: 1fr 1fr; }
      .search-input { width: 100%; }
      .table-card-header { flex-direction: column; align-items: flex-start; }
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
    <div class="profile-avatar {{ strtolower($gender ?? '') == 'female' ? 'female' : 'male' }}">
      @if(strtolower($gender ?? '') == 'female')
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
    <h1>Loan History</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <i data-lucide="house" style="width:12px;height:12px;"></i>
      <a href="{{ route('Member.Landing') }}">Home</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <a href="{{ route('Loan.Dashboard') }}">Loan Dashboard</a>
      <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
      <span class="current">Loan History</span>
    </nav>
  </header>

  <div class="page-body">

    {{-- ── Stats ── --}}
    @php
      $totalLoans    = $loans->count();
      $activeLoans   = $loans->where('loan_status', 'active')->count();
      $paidLoans     = $loans->where('loan_status', 'paid')->count();
      $defaultedLoans= $loans->where('loan_status', 'defaulted')->count();
    @endphp

    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-icon amber"><i data-lucide="banknote"></i></div>
        <div>
          <div class="stat-label">Total Loans</div>
          <div class="stat-value">{{ $totalLoans }}</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon green"><i data-lucide="activity"></i></div>
        <div>
          <div class="stat-label">Active</div>
          <div class="stat-value">{{ $activeLoans }}</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon blue"><i data-lucide="circle-check-big"></i></div>
        <div>
          <div class="stat-label">Paid</div>
          <div class="stat-value">{{ $paidLoans }}</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon red"><i data-lucide="circle-x"></i></div>
        <div>
          <div class="stat-label">Defaulted</div>
          <div class="stat-value">{{ $defaultedLoans }}</div>
        </div>
      </div>
    </div>

    {{-- ── Table ── --}}
    <div class="table-card">
      <div class="table-card-header">
        <h2><i data-lucide="scroll-text"></i> Your Loan Records</h2>
        <div class="search-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
          </svg>
          <input type="text" id="table-search" class="search-input" placeholder="Search loans…">
        </div>
      </div>

      <div class="table-wrap">
        <table id="loan-table">
          <thead>
            <tr>
              <th>Loan Number</th>
              <th>Loan Amount</th>
              <th>Interest Rate</th>
              <th>Loan Balance</th>
              <th>Loan Term</th>
              <th>Status</th>
              <th>Date Applied</th>
            </tr>
          </thead>
          <tbody>
            @forelse($loans as $loan)
            <tr>
              <td><span class="loan-number">#{{ $loan->loan_number }}</span></td>
              <td><span class="amount">₱{{ number_format($loan->loan_amount, 2) }}</span></td>
              <td>{{ (isset($loan->interest_rate) && $loan->interest_rate !== '' && $loan->interest_rate !== null) ? number_format((float) $loan->interest_rate, 1) . '%' : number_format(5, 1) . '%' }}</td>
              <td>₱{{ number_format($loan->loan_balance, 2) }}</td>
              <td><span class="term-badge">{{ $loan->loan_term }} mos</span></td>
              <td>
                @php $s = strtolower($loan->loan_status); @endphp
                @if($s === 'active')
                  <span class="badge badge-active">Active</span>
                @elseif($s === 'paid')
                  <span class="badge badge-paid">Paid</span>
                @elseif($s === 'defaulted')
                  <span class="badge badge-defaulted">Defaulted</span>
                @elseif($s === 'pending')
                  <span class="badge badge-pending">Pending</span>
                @else
                  <span class="badge badge-other">{{ ucfirst($loan->loan_status) }}</span>
                @endif
              </td>
              <td>{{ $loan->created_at ? $loan->created_at->format('M d, Y') : 'N/A' }}</td>
            </tr>
            @empty
            @endforelse
          </tbody>
        </table>

        @if($loans->isEmpty())
        <div class="empty-state">
          <i data-lucide="file-x"></i>
          <p>No loan records found.</p>
        </div>
        @endif

        <div class="empty-state" id="no-results" style="display:none;">
          <i data-lucide="search-x"></i>
          <p>No loans matched your search.</p>
        </div>
      </div>
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

  // Table search
  document.getElementById('table-search').addEventListener('input', function () {
    const term = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll('#loan-table tbody tr');
    let visible = 0;
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const match = !term || text.includes(term);
      row.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    document.getElementById('no-results').style.display = visible === 0 && term ? 'block' : 'none';
  });
</script>
</body>
</html>