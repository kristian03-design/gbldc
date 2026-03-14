<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Loan Records | GBLDC Admin</title>
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
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; bottom: 0;
      z-index: 100;
    }
    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; line-height: 1.2; color: #fff; }
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
      padding: 10px; border-radius: 10px; cursor: pointer; transition: background .2s;
    }
    .user-card:hover { background: rgba(255,255,255,.08); }
    .avatar {
      width: 36px; height: 36px; border-radius: 50%;
      background: var(--forest-mid); border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0;
    }
    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; color: #fff; }
    #user-menu-dropdown {
      display: none; background: #0a3d27;
      border-radius: 10px; padding: 6px; margin-top: 6px;
    }
    .dropdown-item {
      display: flex; align-items: center; gap: 8px;
      padding: 8px 12px; border-radius: 7px;
      text-decoration: none; font-size: 13px; transition: background .15s;
    }
    .dropdown-item:hover { background: rgba(255,255,255,.08); }
    .dropdown-item.normal { color: rgba(255,255,255,.8); }
    .dropdown-item.danger { color: #f87171; }
    .dropdown-item i[data-lucide] { width: 14px; height: 14px; }

    /* ── Main ── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── Topbar ── */
    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
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
      border: none; cursor: pointer; transition: background .2s, transform .1s; white-space: nowrap;
    }
    .back-btn:hover { background: #a7f3d0; transform: translateX(-2px); }
    .back-btn i[data-lucide] { width: 14px; height: 14px; }
    .topbar-title h1 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--forest); }
    .topbar-title p  { font-size: 13px; color: var(--muted); margin-top: 1px; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Page header card ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 24px 28px; color: #fff;
      margin-bottom: 24px; position: relative; overflow: hidden;
      display: flex; align-items: center; justify-content: space-between;
    }
    .page-header::before { content: ''; position: absolute; top: -30px; right: -30px; width: 160px; height: 160px; border-radius: 50%; background: rgba(255,255,255,.05); }
    .page-header::after  { content: ''; position: absolute; bottom: -50px; right: 110px; width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,.04); }
    .page-header-text h2 { font-family: 'Playfair Display', serif; font-size: 22px; margin-bottom: 4px; }
    .page-header-text p  { font-size: 13px; opacity: .75; }
    .page-header-icon {
      width: 52px; height: 52px; background: rgba(255,255,255,.12);
      border-radius: 14px; display: flex; align-items: center; justify-content: center;
      position: relative; z-index: 1; flex-shrink: 0;
    }
    .page-header-icon i[data-lucide] { width: 24px; height: 24px; color: #fff; }

    /* ── Alert ── */
    .alert-success {
      background: #dcfce7; border: 1px solid #86efac; color: #166534;
      border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
      font-size: 14px; display: flex; align-items: center; gap: 8px;
    }
    .alert-success i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Table card ── */
    .table-card { background: var(--white); border-radius: 16px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.04); }
    .table-card-header {
      padding: 20px 24px 16px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
    }
    .table-card-header h3 { font-size: 16px; font-weight: 700; color: var(--ink); display: flex; align-items: center; gap: 8px; }
    .table-card-header h3 i[data-lucide] { color: var(--emerald); width: 18px; height: 18px; }
    .count-badge { font-size: 12px; padding: 3px 10px; border-radius: 20px; background: var(--sage); color: var(--forest); font-weight: 600; }

    /* ── DataTable overrides ── */
    .dataTables_wrapper { padding: 16px 24px 20px; font-family: 'DM Sans', sans-serif; font-size: 13px; }
    .dataTables_wrapper .dataTables_filter input {
      border: 1px solid var(--border); border-radius: 8px;
      padding: 6px 12px; font-size: 13px; outline: none;
      transition: border-color .2s; font-family: 'DM Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: var(--emerald); }
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label { font-size: 13px; color: var(--muted); }
    .dataTables_wrapper .dataTables_length select {
      border: 1px solid var(--border); border-radius: 8px;
      padding: 5px 8px; font-size: 13px; outline: none; font-family: 'DM Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_info { font-size: 12px; color: var(--muted); }
    .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: 8px !important; font-size: 13px !important; padding: 4px 10px !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: var(--forest) !important; border-color: var(--forest) !important; color: #fff !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: var(--sage) !important; border-color: var(--sage) !important; color: var(--forest) !important; }
    table.dataTable thead th { background: #f9fafb !important; color: var(--muted) !important; font-size: 11px !important; letter-spacing: .06em; text-transform: uppercase; font-weight: 600 !important; padding: 10px 16px !important; border-bottom: 1px solid var(--border) !important; }
    table.dataTable tbody tr { transition: background .15s; }
    table.dataTable tbody tr:hover { background: #f9fafb !important; }
    table.dataTable tbody td { padding: 12px 16px !important; border-bottom: 1px solid var(--border) !important; vertical-align: middle; font-size: 13px !important; color: var(--ink) !important; }
    table.dataTable.no-footer { border: none !important; }

    /* ── Cell styles ── */
    .member-name  { font-weight: 600; color: var(--ink); }
    .td-muted     { color: var(--muted) !important; }
    .amount-cell  { font-weight: 600; color: var(--forest-mid) !important; }
    .balance-cell { font-weight: 600; color: var(--rose) !important; }

    /* ── Status pills ── */
    .pill { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
    .pill i[data-lucide] { width: 10px; height: 10px; }
    .pill.active    { background: #dcfce7; color: #166534; }
    .pill.pending   { background: #fef3c7; color: #92400e; }
    .pill.completed { background: #dbeafe; color: #1e40af; }
    .pill.default   { background: #f3f4f6; color: var(--muted); }

    /* ── Action buttons ── */
    .action-group { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .action-btn {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 6px 12px; border-radius: 8px;
      font-size: 12px; font-weight: 600;
      border: none; cursor: pointer;
      transition: background .2s, transform .1s;
      text-decoration: none; white-space: nowrap;
      font-family: 'DM Sans', sans-serif;
    }
    .action-btn:active { transform: scale(.96); }
    .action-btn i[data-lucide] { width: 13px; height: 13px; }
    .action-btn.view    { background: var(--sage); color: var(--forest); }
    .action-btn.view:hover    { background: #a7f3d0; }
    .action-btn.history { background: #dbeafe; color: #1e40af; }
    .action-btn.history:hover { background: #bfdbfe; }
    .action-btn.finish  { background: #fee2e2; color: #991b1b; }
    .action-btn.finish:hover  { background: #fecaca; }

    /* ══ CONFIRM MODAL ═════════════════════════════ */
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
      animation: modalIn .2s ease; position: relative;
    }
    @keyframes modalIn {
      from { transform: scale(.93) translateY(10px); opacity: 0; }
      to   { transform: scale(1)   translateY(0);    opacity: 1; }
    }
    .modal-icon {
      width: 52px; height: 52px; border-radius: 14px;
      background: #fee2e2; color: #991b1b;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 18px;
    }
    .modal-icon i[data-lucide] { width: 26px; height: 26px; }
    .modal h3 { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
    .modal p  { font-size: 14px; color: var(--muted); line-height: 1.6; margin-bottom: 6px; }
    .modal-detail {
      background: #f9fafb; border: 1px solid var(--border);
      border-radius: 10px; padding: 10px 14px;
      margin: 12px 0 20px;
    }
    .modal-detail-row { display: flex; align-items: center; gap: 8px; font-size: 13px; margin-bottom: 5px; }
    .modal-detail-row:last-child { margin-bottom: 0; }
    .modal-detail-row i[data-lucide] { width: 14px; height: 14px; color: var(--emerald); flex-shrink: 0; }
    .modal-detail-row span { color: var(--muted); }
    .modal-detail-row strong { color: var(--ink); margin-left: 4px; }
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
    .modal-btn.confirm { background: var(--rose); color: #fff; }
    .modal-btn.confirm:hover { background: #dc2626; }

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
    <a href="{{route('Loan.Records')}}" class="nav-item active">
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

  <header class="topbar">
    <div class="topbar-left">
      <a href="{{route('Admin.dashboard')}}" class="back-btn">
        <i data-lucide="arrow-left"></i> Back
      </a>
      <div class="topbar-title">
        <h1>Loan Records</h1>
        <p>View and manage all member loan records</p>
      </div>
    </div>
  </header>

  <div class="page-body">

    <div class="page-header">
      <div class="page-header-text">
        <h2>Approved Loan Records</h2>
        <p>Monitor loan statuses, balances, and payment histories.</p>
      </div>
      <div class="page-header-icon">
        <i data-lucide="badge-check"></i>
      </div>
    </div>

    @if(session('success'))
    <div class="alert-success">
      <i data-lucide="circle-check"></i>
      {{ session('success') }}
    </div>
    @endif

    <div class="table-card">
      <div class="table-card-header">
        <h3><i data-lucide="list"></i> Loan List</h3>
        <span class="count-badge">All Records</span>
      </div>

      <div style="overflow-x:auto;">
        <table id="loanTable" class="display responsive nowrap no-footer" style="width:100%">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Name</th>
              <th>Contact</th>
              <th>Loan #</th>
              <th>Loan Amount</th>
              <th>Interest Rate</th>
              <th>Loan Balance</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($loans as $loan)
            <tr>
              <td class="td-muted">{{ $loan->member_id }}</td>
              <td><div class="member-name">{{ $loan->last_name }}, {{ $loan->first_name }} {{ $loan->middle_name }}</div></td>
              <td class="td-muted">{{ $loan->contact_number }}</td>
              <td class="td-muted">{{ $loan->loan_number }}</td>
              <td class="amount-cell">₱{{ number_format($loan->loan_amount, 2) }}</td>
              <td class="td-muted">{{ (isset($loan->interest_rate) && $loan->interest_rate !== '' && $loan->interest_rate !== null) ? number_format((float) $loan->interest_rate, 1) . '%' : number_format(5, 1) . '%' }}</td>
              <td class="balance-cell">₱{{ number_format($loan->loan_balance, 2) }}</td>
              <td>
                @if($loan->loan_status == 'Active')
                  <span class="pill active"><i data-lucide="circle-check-big"></i> Active</span>
                @elseif($loan->loan_status == 'Pending')
                  <span class="pill pending"><i data-lucide="clock"></i> Pending</span>
                @elseif($loan->loan_status == 'Completed' || $loan->loan_status == 'Fully Paid')
                  <span class="pill completed"><i data-lucide="badge-check"></i> {{ $loan->loan_status }}</span>
                @else
                  <span class="pill default"><i data-lucide="minus"></i> {{ $loan->loan_status }}</span>
                @endif
              </td>
              <td>
                <div class="action-group">
                  <a href="{{ route('View.Member.Loan', $loan->loan_number) }}" class="action-btn view">
                    <i data-lucide="eye"></i> View
                  </a>
                  <a href="{{ route('Loan.Payment.History', $loan->loan_number) }}" class="action-btn history">
                    <i data-lucide="history"></i> History
                  </a>
                  @if($loan->loan_status != 'Completed' && $loan->loan_status != 'Fully Paid')
                  <form action="{{ route('Mark.Loan.Finished', $loan->loan_number) }}" method="POST"
                    style="display:inline;" id="finish-form-{{ $loan->loan_number }}">
                    @csrf
                    <button type="button" class="action-btn finish"
                      onclick="openFinishModal(
                        '{{ $loan->loan_number }}',
                        '{{ addslashes($loan->last_name) }}, {{ addslashes($loan->first_name) }}',
                        '₱{{ number_format($loan->loan_balance, 2) }}'
                      )">
                      <i data-lucide="check"></i> Fully Paid
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
     FINISH LOAN CONFIRM MODAL
═══════════════════════════════════ -->
<div class="modal-overlay" id="finishModal">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal-icon">
      <i data-lucide="check-circle"></i>
    </div>
    <h3 id="modal-title">Mark Loan as Fully Paid?</h3>
    <p>You are about to mark this loan as <strong>Fully Paid</strong>. This action cannot be undone.</p>
    <div class="modal-detail">
      <div class="modal-detail-row">
        <i data-lucide="user"></i>
        <span>Member:</span>
        <strong id="modal-member-name">—</strong>
      </div>
      <div class="modal-detail-row">
        <i data-lucide="hash"></i>
        <span>Loan #:</span>
        <strong id="modal-loan-number">—</strong>
      </div>
      <div class="modal-detail-row">
        <i data-lucide="wallet"></i>
        <span>Remaining Balance:</span>
        <strong id="modal-loan-balance" style="color:var(--rose);">—</strong>
      </div>
    </div>
    <div class="modal-actions">
      <button class="modal-btn cancel" onclick="closeFinishModal()">
        <i data-lucide="x"></i> Cancel
      </button>
      <button class="modal-btn confirm" id="modal-confirm-btn">
        <i data-lucide="check"></i> Yes, Mark as Fully Paid
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
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu-dropdown');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // ── DataTable ──────────────────────────────────
  $(document).ready(function () {
    $('#loanTable').DataTable({
      responsive: true,
      fixedHeader: true,
      pageLength: 10,
      language: {
        search: '',
        searchPlaceholder: 'Search loans…',
        lengthMenu: 'Show _MENU_ entries',
        info: 'Showing _START_–_END_ of _TOTAL_ loans',
        infoEmpty: 'No loans found',
        zeroRecords: 'No matching loans found',
        paginate: { previous: '‹', next: '›' }
      },
      columnDefs: [{ orderable: false, targets: 7 }],
      drawCallback: function () { lucide.createIcons(); }
    });
  });

  // ── Finish Loan Modal ──────────────────────────
  const modal      = document.getElementById('finishModal');
  const confirmBtn = document.getElementById('modal-confirm-btn');

  function openFinishModal(loanNumber, memberName, balance) {
    document.getElementById('modal-member-name').textContent  = memberName;
    document.getElementById('modal-loan-number').textContent  = loanNumber;
    document.getElementById('modal-loan-balance').textContent = balance;
    confirmBtn.onclick = () => {
      document.getElementById('finish-form-' + loanNumber).submit();
    };
    modal.classList.add('open');
    lucide.createIcons();
  }

  function closeFinishModal() {
    modal.classList.remove('open');
  }

  modal.addEventListener('click', e => { if (e.target === modal) closeFinishModal(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeFinishModal(); });
</script>
</body>
</html>