<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Member List | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
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
      --sky:       #3b82f6;
      --sidebar-w: 240px;
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
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 100;
    }

    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }

    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700;
      line-height: 1.2; color: #fff;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

    .nav-section-label {
      font-size: 10px; letter-spacing: .1em;
      text-transform: uppercase; opacity: .4;
      padding: 16px 8px 6px;
    }

    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 12px; border-radius: 10px;
      text-decoration: none;
      color: rgba(255,255,255,.7);
      font-size: 14px; font-weight: 500;
      transition: background .2s, color .2s;
      margin-bottom: 2px;
    }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    .sidebar-footer {
      padding: 16px 12px;
      border-top: 1px solid rgba(255,255,255,.1);
    }

    .user-card {
      display: flex; align-items: center; gap: 10px;
      padding: 10px; border-radius: 10px;
      cursor: pointer; transition: background .2s;
    }
    .user-card:hover { background: rgba(255,255,255,.08); }

    .avatar {
      width: 36px; height: 36px; border-radius: 50%;
      background: var(--forest-mid);
      border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 600; color: #fff;
      flex-shrink: 0;
    }

    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; color: #fff; }

    /* ── Main ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1; display: flex;
      flex-direction: column; min-height: 100vh;
    }

    /* ── Topbar ── */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 50;
    }

    .topbar-left { display: flex; align-items: center; gap: 14px; }

    .back-btn {
      display: flex; align-items: center; gap: 6px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s;
    }
    .back-btn:hover { background: #a7f3d0; }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }

    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700;
      color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Page header banner ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 24px 28px;
      color: #fff;
      margin-bottom: 24px;
      position: relative;
      overflow: hidden;
    }
    .page-header::before {
      content: '';
      position: absolute; top: -30px; right: -30px;
      width: 160px; height: 160px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; margin-bottom: 4px;
    }
    .page-header p { font-size: 13px; opacity: .75; }

    /* ── Table card ── */
    .table-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .table-card-header {
      padding: 20px 24px 16px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
    }

    .table-card-header h3 {
      font-size: 16px; font-weight: 700;
      color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .table-card-header h3 i[data-lucide] { color: var(--emerald); width: 18px; height: 18px; }

    .count-badge {
      font-size: 12px; padding: 3px 10px;
      border-radius: 20px;
      background: var(--sage); color: var(--forest);
      font-weight: 600;
    }

    /* ── DataTable overrides ── */
    .dataTables_wrapper {
      padding: 16px 24px 20px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
    }

    .dataTables_wrapper .dataTables_filter input {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 6px 12px;
      font-size: 13px;
      outline: none;
      transition: border-color .2s;
      font-family: 'DM Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: var(--emerald); }

    .dataTables_wrapper .dataTables_length select {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 5px 8px;
      font-size: 13px;
      outline: none;
      font-family: 'DM Sans', sans-serif;
    }

    table.dataTable thead th {
      background: #f9fafb !important;
      color: var(--muted) !important;
      font-size: 11px !important;
      letter-spacing: .06em;
      text-transform: uppercase;
      font-weight: 600 !important;
      padding: 10px 16px !important;
      border-bottom: 1px solid var(--border) !important;
    }

    table.dataTable tbody tr { transition: background .15s; }
    table.dataTable tbody tr:hover { background: #f9fafb !important; }
    table.dataTable tbody td {
      padding: 13px 16px !important;
      border-bottom: 1px solid var(--border) !important;
      vertical-align: middle;
    }
    table.dataTable.no-footer { border: none !important; }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border-radius: 8px !important;
      padding: 4px 10px !important;
      font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background: var(--forest) !important;
      border-color: var(--forest) !important;
      color: #fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: var(--sage) !important;
      border-color: var(--sage) !important;
      color: var(--forest) !important;
    }
    .dataTables_info { color: var(--muted); font-size: 12px; }

    /* ── Cell styles ── */
    .member-id {
      font-family: 'DM Sans', monospace;
      font-size: 12px; font-weight: 700;
      color: var(--forest);
      background: var(--sage);
      padding: 3px 8px; border-radius: 6px;
      display: inline-block;
    }

    .member-name { font-weight: 600; color: var(--ink); }

    /* ── Action button ── */
    .action-btn {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 6px 12px; border-radius: 8px;
      font-size: 12px; font-weight: 600;
      text-decoration: none;
      transition: background .2s, transform .1s;
      white-space: nowrap;
    }
    .action-btn:active { transform: scale(.96); }
    .action-btn i[data-lucide] { width: 13px; height: 13px; }
    .action-btn.view { background: #dbeafe; color: #1e40af; }
    .action-btn.view:hover { background: #bfdbfe; }

    /* ── Date cell ── */
    .date-cell { color: var(--muted); font-size: 12px; }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Sidebar user dropdown ── */
    #user-menu-dropdown {
      display: none;
      background: #0a3d27;
      border-radius: 10px;
      padding: 6px;
      margin-top: 6px;
    }
    .dropdown-item {
      display: flex; align-items: center; gap: 8px;
      padding: 8px 12px; border-radius: 7px;
      text-decoration: none; font-size: 13px;
      transition: background .15s;
    }
    .dropdown-item:hover { background: rgba(255,255,255,.08); }
    .dropdown-item.normal { color: rgba(255,255,255,.8); }
    .dropdown-item.danger { color: #f87171; }
    .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .main { margin-left: 0; }
      .page-body { padding: 20px 16px; }
      .topbar { padding: 12px 16px; }
    }
  </style>
</head>
<body>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC Logo"
      style="width:40px;height:40px;object-fit:cover;border-radius:10px;flex-shrink:0;" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Admin Dashboard</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="{{route('Admin.dashboard')}}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Overview
    </a>
    <a href="{{route('Manage.Members')}}" class="nav-item">
      <i data-lucide="user-plus"></i> Member Registration
    </a>
    <a href="{{route('Member.List')}}" class="nav-item active">
      <i data-lucide="users"></i> Official Members
    </a>

    <div class="nav-section-label">Finance</div>
    <a href="{{route('LoanApp.list')}}" class="nav-item">
      <i data-lucide="file-text"></i> Loan Applications
    </a>
    <a href="{{route('Loan.Records')}}" class="nav-item">
      <i data-lucide="badge-check"></i> Approved Loans
    </a>
    <a href="{{route('Payment.Page')}}" class="nav-item">
      <i data-lucide="credit-card"></i> Payment
    </a>
    <a href="{{route('Add.Transactions')}}" class="nav-item">
      <i data-lucide="arrow-left-right"></i> Transactions
    </a>
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item">
      <i data-lucide="piggy-bank"></i> Shared Capital
    </a>

    <div class="nav-section-label">Reports</div>
    <a href="{{route('Admin.Reports')}}" class="nav-item">
      <i data-lucide="bar-chart-2"></i> Cooperative Reports
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="{{ route('Admin.Settings') }}" class="nav-item">
      <i data-lucide="settings"></i> Settings
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-card" id="user-menu-button">
            <div class="avatar">
        @if(auth('admin')->check() && auth('admin')->user()->profile_picture)
          <img src="{{ asset('images/profile_pictures/' . auth('admin')->user()->profile_picture) }}" alt="Profile" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
        @else
          A
        @endif
      </div>
      <div class="user-info">
        <div class="name">Admin</div>
        <div class="role">Super Administrator</div>
      </div>
      <i data-lucide="more-vertical" style="margin-left:auto;opacity:.4;width:14px;height:14px;"></i>
    </div>
    <div id="user-menu-dropdown">
      <a href="#" class="dropdown-item normal">
        <i data-lucide="user"></i> Profile
      </a>
      <a href="{{ route('Admin.Logout') }}" class="dropdown-item danger">
        <i data-lucide="log-out"></i> Logout
      </a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-left">
      <a href="{{route('Admin.dashboard')}}" class="back-btn">
        <i data-lucide="arrow-left"></i> Back
      </a>
      <div class="topbar-title">
        <h1>Official Members</h1>
        <p>View and manage all approved cooperative members</p>
      </div>
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Banner -->
    <div class="page-header">
      <h2>Member List</h2>
      <p>A complete record of all official GBLDC cooperative members.</p>
    </div>

    <!-- Table card -->
    <div class="table-card">
      <div class="table-card-header">
        <h3>
          <i data-lucide="id-card"></i>
          Official Members
        </h3>
        <span class="count-badge">All Members</span>
      </div>

      <div style="overflow-x:auto;">
        <table id="loanTable" class="display responsive nowrap no-footer" style="width:100%">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Full Name</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Date Joined</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($AllMembers as $AllMember)
            <tr>
              <td><span class="member-id">{{$AllMember->member_id}}</span></td>
              <td><span class="member-name">{{$AllMember->last_name}}, {{$AllMember->first_name}} {{$AllMember->middle_name}}</span></td>
              <td style="color:var(--muted);">0{{$AllMember->contact_number}}</td>
              <td style="color:var(--muted);">{{$AllMember->email}}</td>
              <td class="date-cell">{{date('M d, Y', strtotime($AllMember->created_at))}}</td>
              <td>
                <a href="{{route('View.Member.Details', $AllMember->member_id)}}" class="action-btn view">
                  <i data-lucide="eye"></i> View Details
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div><!-- /page-body -->
</div><!-- /main -->

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
  lucide.createIcons();

  // User menu
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  $(document).ready(function () {
    $('#loanTable').DataTable({
      responsive: true,
      fixedHeader: true,
      language: {
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ members",
        infoEmpty: "No members found",
        zeroRecords: "No matching members found"
      },
      columnDefs: [
        { targets: 4, type: 'date' }
      ],
      order: [[4, 'desc']],
      drawCallback: function() { lucide.createIcons(); }
    });
  });
</script>
</body>
</html>