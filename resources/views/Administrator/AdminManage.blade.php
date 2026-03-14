<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Users | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
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
      --amber:     #f59e0b;
      --sky:       #3b82f6;
      --violet:    #8b5cf6;
      --rose:      #ef4444;
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
    .nav-item svg,
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
      transition: background .2s, transform .1s;
      white-space: nowrap;
    }
    .back-btn:hover { background: #a7f3d0; transform: translateX(-2px); }
    .back-btn svg,
    .back-btn i[data-lucide] { width: 14px; height: 14px; }

    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700;
      color: var(--forest);
    }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    .add-btn {
      display: flex; align-items: center; gap: 8px;
      padding: 10px 18px; border-radius: 10px;
      background: var(--forest); color: #fff;
      text-decoration: none; font-size: 14px; font-weight: 600;
      transition: background .2s, transform .1s;
      border: none; cursor: pointer;
    }
    .add-btn:hover { background: var(--forest-mid); }
    .add-btn:active { transform: scale(.98); }
    .add-btn svg,
    .add-btn i[data-lucide] { width: 16px; height: 16px; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Page header ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px;
      padding: 24px 28px;
      color: #fff;
      margin-bottom: 24px;
      position: relative;
      overflow: hidden;
      display: flex; align-items: center; justify-content: space-between;
    }
    .page-header::before {
      content: '';
      position: absolute; top: -30px; right: -30px;
      width: 160px; height: 160px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: '';
      position: absolute; bottom: -50px; right: 110px;
      width: 120px; height: 120px; border-radius: 50%;
      background: rgba(255,255,255,.04);
    }
    .page-header-text h2 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; margin-bottom: 4px;
    }
    .page-header-text p { font-size: 13px; opacity: .75; }
    .page-header-icon {
      width: 52px; height: 52px;
      background: rgba(255,255,255,.12);
      border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      position: relative; z-index: 1; flex-shrink: 0;
    }
    .page-header-icon svg,
    .page-header-icon i[data-lucide] { width: 24px; height: 24px; color: #fff; }

    /* ── Section label ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* ── Table card ── */
    .table-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
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
    .table-card-header h3 svg,
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
    .dataTables_wrapper .dataTables_filter label { font-size: 13px; color: var(--muted); }

    .dataTables_wrapper .dataTables_length select {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 5px 8px;
      font-size: 13px;
      outline: none;
      font-family: 'DM Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_length label { font-size: 13px; color: var(--muted); }
    .dataTables_wrapper .dataTables_info { font-size: 12px; color: var(--muted); }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border-radius: 8px !important;
      font-size: 13px !important;
      font-family: 'DM Sans', sans-serif !important;
      padding: 4px 10px !important;
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
      padding: 12px 16px !important;
      border-bottom: 1px solid var(--border) !important;
      vertical-align: middle;
      font-size: 13px !important;
      color: var(--ink) !important;
    }
    table.dataTable.no-footer { border: none !important; }

    /* ── Cell styles ── */
    .user-name { font-weight: 600; color: var(--ink); }
    .td-muted  { color: var(--muted) !important; }

    /* ── Role pill ── */
    .pill {
      display: inline-flex; align-items: center; gap: 4px;
      font-size: 11px; font-weight: 600;
      padding: 4px 10px; border-radius: 20px;
    }
    .pill svg,
    .pill i[data-lucide] { width: 10px; height: 10px; }
    .pill.admin  { background: #ede9fe; color: #6d28d9; }
    .pill.staff  { background: #dbeafe; color: #1e40af; }
    .pill.member { background: var(--sage); color: var(--forest); }
    .pill.default { background: #f3f4f6; color: var(--muted); }

    /* ── Action buttons ── */
    .action-group { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }

    .action-btn {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 6px 12px; border-radius: 8px;
      font-size: 12px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      text-decoration: none;
      white-space: nowrap;
      font-family: 'DM Sans', sans-serif;
    }
    .action-btn:active { transform: scale(.96); }
    .action-btn svg,
    .action-btn i[data-lucide] { width: 13px; height: 13px; }

    .action-btn.edit   { background: #dbeafe; color: #1e40af; }
    .action-btn.edit:hover   { background: #bfdbfe; }

    .action-btn.remove { background: #fee2e2; color: #991b1b; }
    .action-btn.remove:hover { background: #fecaca; }

    /* ── Dropdown ── */
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
    .dropdown-item svg,
    .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

    /* ── Custom Modals ── */
    .modal-overlay {
      display: none;
      position: fixed; inset: 0;
      background: rgba(0,0,0,.45);
      z-index: 200;
      align-items: center; justify-content: center;
    }
    .modal-overlay.open { display: flex; }

    .modal {
      background: var(--white);
      border-radius: 16px;
      padding: 28px;
      width: 100%; max-width: 420px;
      box-shadow: 0 20px 60px rgba(0,0,0,.15);
      animation: popIn .22s ease;
      position: relative;
    }
    @keyframes popIn {
      from { opacity: 0; transform: scale(.95) translateY(8px); }
      to   { opacity: 1; transform: scale(1)  translateY(0); }
    }

    .modal-header {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px;
    }
    .modal-header h3 {
      font-size: 17px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .modal-header h3 svg,
    .modal-header h3 i[data-lucide] { width: 18px; height: 18px; color: var(--forest); }

    .modal-close {
      width: 32px; height: 32px; border-radius: 8px;
      border: none; background: #f3f4f6; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      color: var(--muted); transition: background .2s;
      flex-shrink: 0;
    }
    .modal-close:hover { background: #e5e7eb; }
    .modal-close svg,
    .modal-close i[data-lucide] { width: 14px; height: 14px; }

    .modal-body { display: flex; flex-direction: column; gap: 12px; }

    .form-group { display: flex; flex-direction: column; gap: 5px; }
    .form-group label { font-size: 12px; font-weight: 600; color: var(--muted); letter-spacing: .04em; text-transform: uppercase; }
    .form-group input,
    .form-group select {
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 9px 12px;
      font-size: 13px;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color .2s;
      color: var(--ink);
      background: var(--white);
    }
    .form-group input:focus,
    .form-group select:focus { border-color: var(--emerald); }

    .modal-footer {
      display: flex; gap: 10px;
      margin-top: 20px;
    }
    .modal-footer button {
      flex: 1; padding: 10px;
      border-radius: 10px; border: none;
      font-size: 13px; font-weight: 600;
      cursor: pointer; font-family: 'DM Sans', sans-serif;
      transition: background .2s, transform .1s;
      display: flex; align-items: center; justify-content: center; gap: 6px;
    }
    .modal-footer button:active { transform: scale(.98); }
    .modal-footer button svg,
    .modal-footer button i[data-lucide] { width: 14px; height: 14px; }

    .btn-cancel  { background: #f3f4f6; color: var(--ink); }
    .btn-cancel:hover  { background: #e5e7eb; }
    .btn-confirm { background: var(--forest); color: #fff; }
    .btn-confirm:hover { background: var(--forest-mid); }
    .btn-danger  { background: var(--rose); color: #fff; }
    .btn-danger:hover  { background: #dc2626; }

    /* ── Confirm dialog ── */
    .confirm-icon {
      width: 52px; height: 52px; border-radius: 14px;
      background: #fee2e2;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 16px;
    }
    .confirm-icon svg,
    .confirm-icon i[data-lucide] { width: 24px; height: 24px; color: var(--rose); }
    .confirm-text { text-align: center; }
    .confirm-text h4 { font-size: 16px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
    .confirm-text p  { font-size: 13px; color: var(--muted); }

    /* ── Toast notification ── */
    .toast {
      position: fixed; bottom: 28px; right: 28px;
      background: var(--white);
      border: 1px solid var(--border);
      border-left: 4px solid var(--emerald);
      border-radius: 12px;
      padding: 14px 18px;
      display: flex; align-items: center; gap: 10px;
      box-shadow: 0 8px 24px rgba(0,0,0,.1);
      z-index: 300;
      font-size: 13px; font-weight: 500;
      color: var(--ink);
      transform: translateY(80px); opacity: 0;
      transition: transform .3s ease, opacity .3s ease;
      max-width: 320px;
    }
    .toast.show { transform: translateY(0); opacity: 1; }
    .toast.error { border-left-color: var(--rose); }
    .toast svg,
    .toast i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; color: var(--emerald); }
    .toast.error svg,
    .toast.error i[data-lucide] { color: var(--rose); }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Responsive ── */
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar { padding: 12px 16px; }
      .page-body { padding: 20px 16px; }
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
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="{{route('Admin.dashboard')}}" class="nav-item">
      <i data-lucide="layout-dashboard"></i> Overview
    </a>
    <a href="{{route('Manage.Members')}}" class="nav-item">
      <i data-lucide="user-plus"></i> Member Registration
    </a>
    <a href="{{route('Member.List')}}" class="nav-item">
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

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}" class="nav-item active">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="{{ route('Admin.Settings') }}" class="nav-item">
      <i data-lucide="settings"></i> Settings
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-card" id="user-menu-button">
      <div class="avatar">A</div>
      <div class="user-info">
        <div class="name">Admin</div>
        <div class="role">Super Administrator</div>
      </div>
      <i data-lucide="more-vertical" style="margin-left:auto;opacity:.4;width:14px;height:14px;"></i>
    </div>
    <div id="user-menu-dropdown">
      <a href="#" class="dropdown-item normal">
        <i data-lucide="user" style="width:14px;height:14px;"></i> Profile
      </a>
      <a href="{{ route('Admin.Logout') }}" class="dropdown-item danger">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
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
        <h1>Manage Users</h1>
        <p>View, edit, or remove users from the system</p>
      </div>
    </div>
    <a href="{{route('Admin.form')}}" class="add-btn">
      <i data-lucide="user-plus"></i> Add User
    </a>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Page header -->
    <div class="page-header">
      <div class="page-header-text">
        <h2>System User Management</h2>
        <p>Control access and roles for all staff and admin accounts.</p>
      </div>
      <div class="page-header-icon">
        <i data-lucide="shield-check"></i>
      </div>
    </div>

    <!-- Table -->
    <div class="section-label">User List</div>
    <div class="table-card">
      <div class="table-card-header">
        <h3>
          <i data-lucide="users"></i>
          All Users
        </h3>
        <span class="count-badge">System Accounts</span>
      </div>

      <div style="overflow-x:auto;">
        <table id="usersTable" class="display responsive nowrap no-footer" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($staffs as $staff)
            <tr>
              <td>
                <div class="user-name">{{ $staff->full_name }}</div>
              </td>
              <td class="td-muted">{{ $staff->email }}</td>
              <td>
                @php $pos = strtolower($staff->position); @endphp
                @if($pos === 'admin')
                  <span class="pill admin">
                    <i data-lucide="shield-check" style="width:10px;height:10px;"></i> {{ $staff->position }}
                  </span>
                @elseif($pos === 'staff')
                  <span class="pill staff">
                    <i data-lucide="user-cog" style="width:10px;height:10px;"></i> {{ $staff->position }}
                  </span>
                @elseif($pos === 'member')
                  <span class="pill member">
                    <i data-lucide="user" style="width:10px;height:10px;"></i> {{ $staff->position }}
                  </span>
                @else
                  <span class="pill default">
                    <i data-lucide="minus" style="width:10px;height:10px;"></i> {{ $staff->position }}
                  </span>
                @endif
              </td>
              <td>
                <div class="action-group">
                  <button class="action-btn edit edit-btn"
                    data-name="{{ $staff->full_name }}"
                    data-email="{{ $staff->email }}"
                    data-role="{{ $staff->position }}">
                    <i data-lucide="pencil" style="width:13px;height:13px;"></i> Edit
                  </button>
                  <button class="action-btn remove remove-btn">
                    <i data-lucide="trash-2" style="width:13px;height:13px;"></i> Remove
                  </button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div><!-- /page-body -->
</div><!-- /main -->

<!-- ═══ Edit Modal ═══ -->
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <div class="modal-header">
      <h3><i data-lucide="pencil"></i> Edit User</h3>
      <button class="modal-close" id="editModalClose"><i data-lucide="x"></i></button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" id="edit-name" placeholder="Full name" />
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" id="edit-email" placeholder="Email address" />
      </div>
      <div class="form-group">
        <label>Role</label>
        <select id="edit-role">
          <option value="Admin">Admin</option>
          <option value="Staff">Staff</option>
          <option value="Member">Member</option>
        </select>
      </div>
      <p id="edit-error" style="font-size:12px;color:var(--rose);display:none;">All fields are required.</p>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" id="editModalCancel"><i data-lucide="x"></i> Cancel</button>
      <button class="btn-confirm" id="editModalSave"><i data-lucide="check"></i> Save Changes</button>
    </div>
  </div>
</div>

<!-- ═══ Remove Confirm Modal ═══ -->
<div class="modal-overlay" id="removeModal">
  <div class="modal">
    <div class="confirm-icon"><i data-lucide="trash-2"></i></div>
    <div class="confirm-text">
      <h4>Remove User?</h4>
      <p>This action cannot be undone. The user will be permanently removed from the system.</p>
    </div>
    <div class="modal-footer" style="margin-top:24px;">
      <button class="btn-cancel" id="removeModalCancel"><i data-lucide="x"></i> Cancel</button>
      <button class="btn-danger"  id="removeModalConfirm"><i data-lucide="trash-2"></i> Yes, Remove</button>
    </div>
  </div>
</div>

<!-- ═══ Toast ═══ -->
<div class="toast" id="toast">
  <i data-lucide="circle-check"></i>
  <span id="toast-msg">Done!</span>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  lucide.createIcons();

  // ── User menu toggle ──
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // ── Toast helper ──
  function showToast(msg, isError = false) {
    const toast = document.getElementById('toast');
    const msgEl = document.getElementById('toast-msg');
    msgEl.textContent = msg;
    toast.classList.toggle('error', isError);
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2800);
  }

  // ── Modal helpers ──
  function openModal(id)  { document.getElementById(id).classList.add('open');    lucide.createIcons(); }
  function closeModal(id) { document.getElementById(id).classList.remove('open'); }

  // Close on backdrop click
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', e => {
      if (e.target === overlay) overlay.classList.remove('open');
    });
  });

  // ── Edit modal state ──
  let activeEditRow = null;

  document.getElementById('editModalClose').addEventListener('click',  () => closeModal('editModal'));
  document.getElementById('editModalCancel').addEventListener('click', () => closeModal('editModal'));

  document.getElementById('editModalSave').addEventListener('click', () => {
    const name  = document.getElementById('edit-name').value.trim();
    const email = document.getElementById('edit-email').value.trim();
    const role  = document.getElementById('edit-role').value;
    const errEl = document.getElementById('edit-error');

    if (!name || !email) { errEl.style.display = 'block'; return; }
    errEl.style.display = 'none';

    if (activeEditRow) {
      activeEditRow.cells[0].innerHTML = `<div class="user-name">${name}</div>`;
      activeEditRow.cells[1].innerHTML = email;
      activeEditRow.cells[1].className = 'td-muted';

      const roleMap  = { Admin: 'pill admin', Staff: 'pill staff', Member: 'pill member' };
      const iconMap  = { Admin: 'shield-check', Staff: 'user-cog', Member: 'user' };
      const pillCls  = roleMap[role]  || 'pill default';
      const iconName = iconMap[role] || 'minus';
      activeEditRow.cells[2].innerHTML = `<span class="${pillCls}"><i data-lucide="${iconName}" style="width:10px;height:10px;"></i> ${role}</span>`;
      lucide.createIcons();
    }

    closeModal('editModal');
    showToast('User updated successfully.');
  });

  // ── Remove modal state ──
  let activeRemoveRow = null;

  document.getElementById('removeModalCancel').addEventListener('click',  () => closeModal('removeModal'));
  document.getElementById('removeModalConfirm').addEventListener('click', () => {
    if (activeRemoveRow) activeRemoveRow.remove();
    closeModal('removeModal');
    showToast('User removed successfully.');
  });

  // ── Bind table buttons ──
  function bindButtons() {
    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.onclick = function () {
        activeEditRow = this.closest('tr');
        document.getElementById('edit-name').value  = this.dataset.name;
        document.getElementById('edit-email').value = this.dataset.email;
        document.getElementById('edit-role').value  = this.dataset.role;
        document.getElementById('edit-error').style.display = 'none';
        openModal('editModal');
      };
    });

    document.querySelectorAll('.remove-btn').forEach(btn => {
      btn.onclick = function () {
        activeRemoveRow = this.closest('tr');
        openModal('removeModal');
      };
    });
  }

  // ── DataTable ──
  $(document).ready(function () {
    $('#usersTable').DataTable({
      responsive: true,
      fixedHeader: true,
      language: {
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ users",
        infoEmpty: "No users found",
        zeroRecords: "No matching users found"
      },
      columnDefs: [{ orderable: false, targets: 3 }],
      drawCallback: function () {
        lucide.createIcons();
        bindButtons();
      }
    });
  });

  bindButtons();
</script>
</body>
</html>