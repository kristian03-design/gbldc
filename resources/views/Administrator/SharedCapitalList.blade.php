<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shared Capital List | GBLDC Admin</title>
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
      --rose:      #ef4444;
      --amber:     #f59e0b;
      --sky:       #3b82f6;
      --violet:    #8b5cf6;
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

    /* ══ SIDEBAR ══════════════════════════════════ */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--forest);
      color: #fff;
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; bottom: 0;
      z-index: 100;
    }
    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .sidebar-logo img { width: 40px; height: 40px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2; }
    .logo-sub  { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }
    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
    .nav-section-label { font-size: 10px; letter-spacing: .1em; text-transform: uppercase; opacity: .4; padding: 16px 8px 6px; }
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
    .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.1); }
    .user-card {
      display: flex; align-items: center; gap: 10px;
      padding: 10px; border-radius: 10px;
      cursor: pointer; transition: background .2s;
    }
    .user-card:hover { background: rgba(255,255,255,.08); }
    .avatar {
      width: 36px; height: 36px; border-radius: 50%;
      background: var(--forest-mid); border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0;
    }
    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; }
    #user-menu-dropdown {
      display: none; background: #0a3d27;
      border-radius: 10px; padding: 6px; margin-top: 6px;
    }
    #user-menu-dropdown a {
      display: flex; align-items: center; gap: 8px;
      padding: 8px 12px; color: rgba(255,255,255,.8);
      text-decoration: none; font-size: 13px; border-radius: 7px;
      transition: background .15s;
    }
    #user-menu-dropdown a:hover { background: rgba(255,255,255,.08); }
    #user-menu-dropdown a.logout { color: #f87171; }
    #user-menu-dropdown i[data-lucide] { width: 14px; height: 14px; }

    /* ══ MAIN ════════════════════════════════════ */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 14px 32px;
      display: flex; align-items: center; gap: 14px;
      position: sticky; top: 0; z-index: 50;
    }
    .back-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 8px 14px; border-radius: 10px;
      background: var(--sage); color: var(--forest);
      text-decoration: none; font-size: 13px; font-weight: 600;
      transition: background .2s; flex-shrink: 0;
    }
    .back-btn:hover { background: #a7f3d0; }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }
    .topbar-title h1 { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: var(--forest); }
    .topbar-title p { font-size: 13px; color: var(--muted); margin-top: 1px; }

    .page-body { padding: 28px 32px 60px; flex: 1; }

    /* ══ HERO BANNER ═════════════════════════════ */
    .hero-banner {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 24px 28px; color: #fff;
      display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 16px; margin-bottom: 28px;
      position: relative; overflow: hidden;
    }
    .hero-banner::before {
      content: ''; position: absolute; top: -40px; right: -40px;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,.05); pointer-events: none;
    }
    .hero-content { position: relative; z-index: 1; }
    .hero-eyebrow {
      font-size: 11px; font-weight: 600; letter-spacing: .12em;
      text-transform: uppercase; opacity: .6; margin-bottom: 6px;
      display: flex; align-items: center; gap: 8px;
    }
    .hero-eyebrow::before { content: ''; width: 20px; height: 2px; background: var(--emerald); border-radius: 2px; display: inline-block; }
    .hero-banner h2 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 4px; }
    .hero-banner p { font-size: 13px; opacity: .7; }
    .hero-badge {
      position: relative; z-index: 1;
      background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
      border-radius: 12px; padding: 12px 20px;
      display: flex; align-items: center; gap: 10px;
      font-size: 13px; font-weight: 600; white-space: nowrap;
    }
    .hero-badge i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }

    /* ══ TABLE CARD ══════════════════════════════ */
    .table-card {
      background: var(--white); border-radius: 16px;
      border: 1px solid var(--border);
      box-shadow: 0 1px 4px rgba(0,0,0,.04);
      overflow: hidden;
    }
    .table-card-header {
      padding: 18px 24px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 10px;
    }
    .table-card-header h3 {
      font-size: 15px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .table-card-header h3 i[data-lucide] { width: 16px; height: 16px; color: var(--emerald); }

    /* ══ DataTable overrides ═════════════════════ */
    .dataTables_wrapper { padding: 16px 24px 20px; }
    .dataTables_wrapper .dataTables_filter input {
      border: 1px solid var(--border); border-radius: 8px;
      padding: 7px 12px; font-family: 'DM Sans', sans-serif;
      font-size: 13px; outline: none; transition: border-color .2s;
    }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: var(--emerald); }
    .dataTables_wrapper .dataTables_filter label { font-size: 13px; color: var(--muted); }
    .dataTables_wrapper .dataTables_length select {
      border: 1px solid var(--border); border-radius: 8px;
      padding: 5px 8px; font-family: 'DM Sans', sans-serif; font-size: 13px; outline: none;
    }
    .dataTables_wrapper .dataTables_length label { font-size: 13px; color: var(--muted); }
    .dataTables_wrapper .dataTables_info { font-size: 12px; color: var(--muted); }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border-radius: 8px !important; font-size: 13px !important; padding: 5px 10px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background: var(--forest) !important; border-color: var(--forest) !important; color: #fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: var(--sage) !important; border-color: var(--sage) !important; color: var(--forest) !important;
    }
    table.dataTable { font-family: 'DM Sans', sans-serif; font-size: 13px; border-collapse: collapse !important; width: 100% !important; }
    table.dataTable thead tr { background: #f9fafb; }
    table.dataTable thead th {
      padding: 10px 14px !important; font-size: 11px !important;
      letter-spacing: .06em; text-transform: uppercase;
      color: var(--muted) !important; font-weight: 600 !important;
      border-bottom: 1px solid var(--border) !important; border-top: none !important;
    }
    table.dataTable.no-footer { border-bottom: none !important; }
    table.dataTable tbody tr { border-top: 1px solid var(--border); transition: background .15s; }
    table.dataTable tbody tr:hover { background: #f9fafb; }
    table.dataTable tbody td { padding: 11px 14px !important; color: var(--ink); vertical-align: middle; }

    /* ══ PILLS ════════════════════════════════════ */
    .pill {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: 11px; font-weight: 600;
      padding: 3px 10px; border-radius: 20px;
    }
    .pill i[data-lucide] { width: 11px; height: 11px; }
    .pill.paid    { background: #dcfce7; color: #166534; }
    .pill.ongoing { background: #dbeafe; color: #1e40af; }

    /* ══ ACTION BUTTONS ══════════════════════════ */
    .actions-cell { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .action-btn {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 5px 10px; border-radius: 7px;
      font-size: 12px; font-weight: 600;
      text-decoration: none; border: none; cursor: pointer;
      transition: background .15s, transform .1s; white-space: nowrap;
      font-family: 'DM Sans', sans-serif;
    }
    .action-btn:active { transform: scale(.97); }
    .action-btn i[data-lucide] { width: 12px; height: 12px; }
    .action-btn.green  { background: #dcfce7; color: #166534; }
    .action-btn.green:hover  { background: #bbf7d0; }
    .action-btn.blue   { background: #dbeafe; color: #1e40af; }
    .action-btn.blue:hover   { background: #bfdbfe; }
    .action-btn.purple { background: #ede9fe; color: #6d28d9; }
    .action-btn.purple:hover { background: #ddd6fe; }

    /* ══ AMOUNT ═══════════════════════════════════ */
    .amt { font-weight: 600; font-variant-numeric: tabular-nums; }

    /* ══ MUTED TEXT ══════════════════════════════ */
    .muted { color: var(--muted); }

    /* scrollbar */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ══ CONFIRM MODAL ═══════════════════════════ */
    .modal-overlay {
      display: none; position: fixed; inset: 0; z-index: 500;
      background: rgba(0,0,0,.45); backdrop-filter: blur(3px);
      align-items: center; justify-content: center;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--white); border-radius: 18px;
      padding: 32px 28px 24px; width: 100%; max-width: 420px;
      box-shadow: 0 20px 60px rgba(0,0,0,.18);
      animation: modalIn .2s ease;
      position: relative;
    }
    @keyframes modalIn {
      from { transform: scale(.93) translateY(10px); opacity: 0; }
      to   { transform: scale(1)   translateY(0);    opacity: 1; }
    }
    .modal-icon {
      width: 52px; height: 52px; border-radius: 14px;
      background: #ede9fe; color: #7c3aed;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 18px;
    }
    .modal-icon i[data-lucide] { width: 26px; height: 26px; }
    .modal h3 {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700; color: var(--ink);
      margin-bottom: 8px;
    }
    .modal p { font-size: 14px; color: var(--muted); line-height: 1.6; margin-bottom: 6px; }
    .modal-member {
      background: #f9fafb; border: 1px solid var(--border);
      border-radius: 10px; padding: 10px 14px;
      font-size: 14px; font-weight: 600; color: var(--ink);
      margin: 12px 0 20px; display: flex; align-items: center; gap: 8px;
    }
    .modal-member i[data-lucide] { width: 15px; height: 15px; color: var(--emerald); flex-shrink: 0; }
    .modal-actions { display: flex; gap: 10px; justify-content: flex-end; }
    .modal-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 9px 20px; border-radius: 10px;
      font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
      cursor: pointer; border: none; transition: background .15s, transform .1s;
    }
    .modal-btn:active { transform: scale(.97); }
    .modal-btn i[data-lucide] { width: 14px; height: 14px; }
    .modal-btn.cancel  { background: #f3f4f6; color: var(--ink); }
    .modal-btn.cancel:hover  { background: #e5e7eb; }
    .modal-btn.confirm { background: var(--forest); color: #fff; }
    .modal-btn.confirm:hover { background: var(--forest-mid); }

    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .topbar, .page-body { padding-left: 18px; padding-right: 18px; }
    }
  </style>
</head>
<body>

<!-- ═══════════════════════════════════
     SIDEBAR
═══════════════════════════════════ -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC" />
    <div>
      <div class="logo-text">GBLDC</div>
      <div class="logo-sub">Admin Dashboard</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="{{ route('LoanApp.list') }}" class="nav-item">
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
    <a href="{{route('Shared.Capital.List.View')}}" class="nav-item active">
      <i data-lucide="piggy-bank"></i> Shared Capital
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="#" class="nav-item">
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
      <a href="#"><i data-lucide="user"></i> Profile</a>
      <a href="{{route('Admin.manage')}}"><i data-lucide="shield-check"></i> Manage Users</a>
      <a href="#"><i data-lucide="settings"></i> Settings</a>
      <a href="{{ route('Admin.Logout') }}" class="logout"><i data-lucide="log-out"></i> Logout</a>
    </div>
  </div>
</aside>

<!-- ═══════════════════════════════════
     MAIN
═══════════════════════════════════ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <a href="{{ route('Admin.dashboard') }}" class="back-btn">
      <i data-lucide="arrow-left"></i> Back
    </a>
    <div class="topbar-title">
      <h1>Shared Capital</h1>
      <p>View and manage all member shared capital records</p>
    </div>
  </header>

  <div class="page-body">

    <!-- Hero -->
    <div class="hero-banner">
      <div class="hero-content">
        <div class="hero-eyebrow">Finance</div>
        <h2>Shared Capital List</h2>
        <p>View all shared capital contributions and payment status of members.</p>
      </div>
      <div class="hero-badge">
        <i data-lucide="piggy-bank"></i> Shared Capital Management
      </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
      <div class="table-card-header">
        <h3>
          <i data-lucide="piggy-bank"></i>
          All Shared Capital Records
        </h3>
      </div>

      <div style="overflow-x:auto;">
        <table id="scTable" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Name</th>
              <th>Shared Capital</th>
              <th>SC Balance</th>
              <th>Date Applied</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($AllSharedCapital as $SharedCapital)
            <tr>
              <td class="muted">{{ $SharedCapital->member_id }}</td>
              <td style="font-weight:500;">
                {{ $SharedCapital->last_name }}, {{ $SharedCapital->first_name }} {{ $SharedCapital->middle_name }}
              </td>
              <td><span class="amt">₱{{ number_format($SharedCapital->shared_capital_amount, 2) }}</span></td>
              <td><span class="amt">₱{{ number_format($SharedCapital->shared_capital_amount_balance, 2) }}</span></td>
              <td class="muted">{{ \Carbon\Carbon::parse($SharedCapital->created_at)->format('M d, Y') }}</td>
              <td>
                @if($SharedCapital->status == 'fully paid')
                  <span class="pill paid">
                    <i data-lucide="circle-check"></i> Fully Paid
                  </span>
                @else
                  <span class="pill ongoing">
                    <i data-lucide="clock"></i> Ongoing
                  </span>
                @endif
              </td>
              <td>
                <div class="actions-cell">
                  <a href="{{ route('View.Shared.Capital.Details', $SharedCapital->member_id) }}" class="action-btn green">
                    <i data-lucide="eye"></i> Details
                  </a>
                  <a href="{{ route('View.SCP.History', $SharedCapital->member_id) }}" class="action-btn blue">
                    <i data-lucide="clock"></i> History
                  </a>
                  @if($SharedCapital->status != 'fully paid')
                  <form action="{{ route('Mark.Shared.Capital.Fully.Paid', $SharedCapital->member_id) }}" method="POST" style="display:inline;" id="paid-form-{{ $SharedCapital->member_id }}">
                    @csrf
                    <button type="button" class="action-btn purple"
                      onclick="openConfirmModal('{{ $SharedCapital->member_id }}', '{{ addslashes($SharedCapital->last_name) }}, {{ addslashes($SharedCapital->first_name) }}')">
                      <i data-lucide="badge-check"></i> Fully Paid
                    </button>
                  </form>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div><!-- /page-body -->

  <footer style="padding:18px 32px;border-top:1px solid var(--border);background:var(--white);font-size:12px;color:var(--muted);text-align:center;">
    &copy; {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative &mdash; All rights reserved.
  </footer>
</div><!-- /main -->

<!-- ═══════════════════════════════════
     FULLY PAID CONFIRM MODAL
═══════════════════════════════════ -->
<div class="modal-overlay" id="confirmModal">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal-icon">
      <i data-lucide="badge-check"></i>
    </div>
    <h3 id="modal-title">Mark as Fully Paid?</h3>
    <p>You are about to mark the following member's shared capital as <strong>Fully Paid</strong>. This action cannot be undone.</p>
    <div class="modal-member">
      <i data-lucide="user"></i>
      <span id="modal-member-name"></span>
    </div>
    <div class="modal-actions">
      <button class="modal-btn cancel" onclick="closeConfirmModal()">
        <i data-lucide="x"></i> Cancel
      </button>
      <button class="modal-btn confirm" id="modal-confirm-btn">
        <i data-lucide="badge-check"></i> Yes, Mark as Paid
      </button>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  lucide.createIcons();

  // ── User menu ──────────────────────────────────
  const menuBtn  = document.getElementById('user-menu-button');
  const menuDrop = document.getElementById('user-menu-dropdown');
  menuBtn.addEventListener('click', e => {
    e.stopPropagation();
    menuDrop.style.display = menuDrop.style.display === 'block' ? 'none' : 'block';
  });
  document.addEventListener('click', () => { menuDrop.style.display = 'none'; });

  // ── DataTable ──────────────────────────────────
  $(document).ready(function () {
    $('#scTable').DataTable({
      responsive: true,
      fixedHeader: true,
      language: {
        search: '',
        searchPlaceholder: 'Search records…',
        lengthMenu: 'Show _MENU_ entries',
        info: 'Showing _START_–_END_ of _TOTAL_ records',
        infoEmpty: 'No records found',
        zeroRecords: 'No matching records found',
        paginate: { previous: '‹', next: '›' }
      },
      columnDefs: [
        { orderable: false, targets: -1 }
      ]
    });
  });
  // ── Fully Paid Modal ───────────────────────────
  const modal      = document.getElementById('confirmModal');
  const modalName  = document.getElementById('modal-member-name');
  const confirmBtn = document.getElementById('modal-confirm-btn');

  function openConfirmModal(memberId, memberName) {
    modalName.textContent = memberName;
    confirmBtn.onclick = () => {
      document.getElementById('paid-form-' + memberId).submit();
    };
    modal.classList.add('open');
    lucide.createIcons();
  }

  function closeConfirmModal() {
    modal.classList.remove('open');
  }

  // Close on backdrop click
  modal.addEventListener('click', e => {
    if (e.target === modal) closeConfirmModal();
  });

  // Close on Escape key
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeConfirmModal();
  });

</script>
</body>
</html>