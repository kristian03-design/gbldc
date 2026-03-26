<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Web Content | GBLDC Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{asset('images/logocoop-removebg-preview-2.png')}}">
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
      transition: transform .3s ease;
    }

    .sidebar-logo {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px; font-weight: 700; line-height: 1.2; color: #fff;
    }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

    .nav-section-label {
      font-size: 10px; letter-spacing: .1em; text-transform: uppercase;
      opacity: .4; padding: 16px 8px 6px;
    }

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
      background: var(--forest-mid); border: 2px solid var(--emerald);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0;
    }
    .user-info .name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-info .role { font-size: 11px; opacity: .5; }

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
    .topbar-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; font-weight: 700; color: var(--forest);
    }
    .breadcrumb {
      display: flex; align-items: center; gap: 5px;
      font-size: 12px; color: var(--muted); margin-top: 3px;
    }
    .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
    .breadcrumb a:hover { color: var(--forest); }
    .breadcrumb .sep { color: #d1d5db; }
    .breadcrumb .current { color: var(--ink); font-weight: 600; }

    /* ── Page body ── */
    .page-body { padding: 28px 32px; flex: 1; }

    /* ── Page header banner ── */
    .page-header {
      background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #2d8a50 100%);
      border-radius: 16px; padding: 24px 28px; color: #fff;
      margin-bottom: 24px; position: relative; overflow: hidden;
    }
    .page-header::before {
      content: ''; position: absolute; top: -30px; right: -30px;
      width: 160px; height: 160px; border-radius: 50%;
      background: rgba(255,255,255,.05);
    }
    .page-header::after {
      content: ''; position: absolute; bottom: -40px; right: 80px;
      width: 100px; height: 100px; border-radius: 50%;
      background: rgba(255,255,255,.04);
    }
    .page-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 22px; margin-bottom: 4px;
    }
    .page-header p { font-size: 13px; opacity: .75; }

    /* ── Section label ── */
    .section-label {
      font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); font-weight: 600; margin-bottom: 14px;
    }

    /* ── Form card ── */
    .card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      margin-bottom: 24px;
    }

    .card-header {
      padding: 18px 24px 14px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: 8px;
    }
    .card-header h3 {
      font-size: 15px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .card-header h3 i[data-lucide] { color: var(--emerald); width: 17px; height: 17px; }

    .card-body { padding: 24px; }

    /* ── Form fields ── */
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }

    .form-group { margin-bottom: 0; }

    .form-label {
      display: flex; align-items: center; gap: 5px;
      font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .06em;
      color: var(--muted); margin-bottom: 7px;
    }
    .form-label i[data-lucide] { width: 12px; height: 12px; }

    .form-control {
      width: 100%; padding: 11px 14px;
      border: 1px solid var(--border); border-radius: 10px;
      font-family: 'DM Sans', sans-serif; font-size: 14px;
      color: var(--ink); background: var(--white);
      outline: none; transition: border-color .2s, box-shadow .2s;
      appearance: none;
    }
    .form-control:focus {
      border-color: var(--emerald);
      box-shadow: 0 0 0 3px rgba(34,197,94,.1);
    }
    select.form-control {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      padding-right: 36px;
      cursor: pointer;
    }
    textarea.form-control { resize: vertical; min-height: 100px; }

    .form-divider {
      height: 1px; background: var(--border); margin: 20px 0;
    }

    /* ── File upload zone ── */
    .file-zone {
      border: 2px dashed var(--border);
      border-radius: 10px; padding: 12px 16px;
      display: flex; align-items: center; gap: 12px;
      cursor: pointer;
      transition: border-color .2s, background .2s;
    }
    .file-zone:hover { border-color: var(--emerald); background: var(--sage); }
    .file-zone input { display: none; }
    .file-zone i[data-lucide] { width: 20px; height: 20px; color: var(--muted); flex-shrink: 0; }
    .file-zone p { font-size: 13px; color: var(--muted); margin: 0; line-height: 1.4; }
    .file-zone strong { color: var(--ink); }

    /* ── Buttons ── */
    .btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 11px 18px; border-radius: 10px;
      font-size: 14px; font-weight: 600;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: background .2s, transform .1s;
      text-decoration: none;
    }
    .btn:active { transform: scale(.97); }
    .btn i[data-lucide] { width: 14px; height: 14px; }
    .btn-primary { background: var(--forest); color: #fff; }
    .btn-primary:hover { background: var(--forest-mid); }
    .btn-danger {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 6px 11px; border-radius: 8px;
      font-size: 12px; font-weight: 600;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      background: #fee2e2; color: #dc2626;
      transition: background .2s;
    }
    .btn-danger:hover { background: #fca5a5; }
    .btn-danger i[data-lucide] { width: 12px; height: 12px; }

    /* ── Alert ── */
    .alert-success {
      display: flex; align-items: center; gap: 10px;
      background: #dcfce7; color: #166534;
      padding: 13px 16px; border-radius: 10px;
      margin-bottom: 20px; font-size: 14px; font-weight: 500;
      border: 1px solid #86efac;
    }
    .alert-success i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Table card ── */
    .table-card {
      background: var(--white);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
      margin-bottom: 20px;
    }

    .table-card-header {
      padding: 16px 20px 14px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--border);
    }
    .table-card-header h3 {
      font-size: 15px; font-weight: 700; color: var(--ink);
      display: flex; align-items: center; gap: 8px;
    }
    .table-card-header h3 i[data-lucide] { width: 16px; height: 16px; }

    .count-badge {
      font-size: 11px; padding: 3px 9px; border-radius: 20px;
      background: var(--sage); color: var(--forest); font-weight: 600;
    }

    /* ── DataTable overrides ── */
    .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .data-table thead tr { background: #f9fafb; }
    .data-table th {
      padding: 10px 16px; text-align: left;
      font-size: 11px; letter-spacing: .06em;
      text-transform: uppercase; color: var(--muted); font-weight: 600;
      border-bottom: 1px solid var(--border);
    }
    .data-table tbody tr { border-top: 1px solid var(--border); transition: background .15s; }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table td { padding: 12px 16px; vertical-align: middle; }

    img.thumb {
      width: 52px; height: 52px; object-fit: cover;
      border-radius: 8px; border: 1px solid var(--border);
    }

    .no-image {
      width: 52px; height: 52px; background: #f3f4f6;
      border-radius: 8px; border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      color: var(--muted); font-size: 10px; font-weight: 600;
      text-align: center; line-height: 1.3;
    }

    .audience-badge {
      font-size: 11px; padding: 3px 9px; border-radius: 20px;
      font-weight: 700; letter-spacing: .04em;
    }
    .audience-badge.both   { background: #ede9fe; color: #6d28d9; }
    .audience-badge.guest  { background: #fef3c7; color: #92400e; }
    .audience-badge.member { background: #dbeafe; color: #1e40af; }

    .type-badge {
      font-size: 11px; padding: 3px 9px; border-radius: 20px;
      font-weight: 600;
    }
    .type-badge.news        { background: #dbeafe; color: #1e40af; }
    .type-badge.testimonial { background: #fdf4ff; color: #7e22ce; }
    .type-badge.service     { background: #dcfce7; color: #166534; }
    .type-badge.gallery     { background: #fef3c7; color: #92400e; }
    .type-badge.hero        { background: #fee2e2; color: #991b1b; }
    .type-badge.cta         { background: #f3f4f6; color: #374151; }

    .content-preview {
      color: var(--muted); font-size: 13px;
      max-width: 260px;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .grid-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 800px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-240px); }
      .main { margin-left: 0; }
      .page-body { padding: 20px 16px; }
      .topbar { padding: 12px 16px; }
      .grid-2, .grid-3 { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<!-- ═══ Sidebar ═══ -->
<aside class="sidebar" id="sidebar">
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
    <a href="{{route('Admin.WebContent')}}" class="nav-item active">
      <i data-lucide="layout-template"></i> Web Content
    </a>
    <a href="{{route('Admin.manage')}}" class="nav-item">
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
    <div id="user-menu" style="display:none;background:#0a3d27;border-radius:10px;padding:6px;margin-top:6px;">
      <a href="#" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:rgba(255,255,255,.8);text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;"
        onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'">
        <i data-lucide="user" style="width:14px;height:14px;"></i> Profile
      </a>
      <a href="{{ route('Admin.Logout') }}" style="display:flex;align-items:center;gap:8px;padding:8px 12px;color:#f87171;text-decoration:none;font-size:13px;border-radius:7px;transition:background .15s;"
        onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'">
        <i data-lucide="log-out" style="width:14px;height:14px;"></i> Logout
      </a>
    </div>
  </div>
</aside>

<!-- ═══ Main ═══ -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-title">
      <h1>Web Content</h1>
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <i data-lucide="house" style="width:12px;height:12px;"></i>
        <a href="{{route('Admin.dashboard')}}">Dashboard</a>
        <span class="sep"><i data-lucide="chevron-right" style="width:12px;height:12px;"></i></span>
        <span class="current">Manage Web Content</span>
      </nav>
    </div>
  </header>

  <!-- Page body -->
  <div class="page-body">

    <!-- Banner -->
    <div class="page-header">
      <h2>Manage Landing Page Content</h2>
      <p>Add, update, and remove content blocks displayed on the guest and member landing pages.</p>
    </div>

    <!-- Success alert -->
    @if(session('success'))
      <div class="alert-success">
        <i data-lucide="circle-check"></i>
        {{ session('success') }}
      </div>
    @endif

    <!-- ── Add New Content Block ── -->
    <div class="section-label">Add New Content Block</div>
    <div class="card">
      <div class="card-header">
        <h3><i data-lucide="plus-circle"></i> New Content Block</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('Admin.WebContent.Store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Row 1: Audience · Section Type · Title -->
          <div class="grid-3" style="margin-bottom:16px;">
            <div class="form-group">
              <label class="form-label">
                <i data-lucide="users"></i> Display On (Audience)
              </label>
              <select name="target_audience" class="form-control" required>
                <option value="both">Both (Guest & Member)</option>
                <option value="guest">Guest Landing Only</option>
                <option value="member">Member Landing Only</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">
                <i data-lucide="layers"></i> Section Type
              </label>
              <select name="section_type" class="form-control" required>
                <option value="news">News & Events</option>
                <option value="testimonial">Member Voices (Testimonial)</option>
                <option value="service">Services Overview</option>
                <option value="gallery">Gallery Image</option>
                <option value="hero">Hero Section Text</option>
                <option value="cta">Call-to-Action Text</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">
                <i data-lucide="type"></i> Title / Author Name
              </label>
              <input type="text" name="title" class="form-control" placeholder="E.g. Annual General Assembly">
            </div>
          </div>

          <div class="form-divider"></div>

          <!-- Row 2: Content · Image · Sort Order -->
          <div class="grid-2" style="margin-bottom:20px;">
            <div class="form-group">
              <label class="form-label">
                <i data-lucide="align-left"></i> Subtitle / Description / Testimonial Text
              </label>
              <textarea name="content" class="form-control" placeholder="Write the main text content here..."></textarea>
            </div>
            <div style="display:flex;flex-direction:column;gap:14px;">
              <div class="form-group">
                <label class="form-label">
                  <i data-lucide="image"></i> Image Upload
                  <span style="font-size:10px;color:var(--muted);font-weight:400;margin-left:4px;">(Required for Gallery & News)</span>
                </label>
                <label class="file-zone" for="content_image">
                  <input type="file" name="image" id="content_image" accept="image/*">
                  <i data-lucide="cloud-upload"></i>
                  <div>
                    <p id="file-label"><strong>Click to upload</strong> or drag & drop</p>
                    <p style="font-size:11px;margin-top:2px;">PNG, JPG, GIF — max 5MB</p>
                  </div>
                </label>
              </div>
              <div class="form-group">
                <label class="form-label">
                  <i data-lucide="arrow-up-down"></i> Sort Order
                  <span style="font-size:10px;color:var(--muted);font-weight:400;margin-left:4px;">(Lower = appears first)</span>
                </label>
                <input type="number" name="sort_order" class="form-control" value="0" min="0">
              </div>
            </div>
          </div>

          <!-- Submit -->
          <div style="display:flex;justify-content:flex-end;">
            <button type="submit" class="btn btn-primary">
              <i data-lucide="save"></i> Save Content Block
            </button>
          </div>

        </form>
      </div>
    </div>

    <!-- ── Grouped Content Tables ── -->
    <div class="section-label">Published Content</div>

    @php
      $contentSections = [
        'news'        => ['label' => 'News & Events',              'icon' => 'newspaper',    'color' => 'var(--sky)'],
        'testimonial' => ['label' => 'Member Voices (Testimonials)','icon' => 'message-square','color' => 'var(--violet)'],
        'service'     => ['label' => 'Services',                   'icon' => 'briefcase',    'color' => 'var(--emerald)'],
        'gallery'     => ['label' => 'Gallery',                    'icon' => 'image',        'color' => 'var(--amber)'],
      ];
    @endphp

    @foreach($contentSections as $type => $meta)
    <div class="table-card">
      <div class="table-card-header">
        <h3>
          <i data-lucide="{{ $meta['icon'] }}" style="color:{{ $meta['color'] }};"></i>
          {{ $meta['label'] }}
        </h3>
        @if(isset($groupedContents[$type]))
          <span class="count-badge">{{ count($groupedContents[$type]) }} {{ count($groupedContents[$type]) === 1 ? 'item' : 'items' }}</span>
        @else
          <span class="count-badge">0 items</span>
        @endif
      </div>

      <div style="overflow-x:auto;">
        <table class="data-table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>Content Preview</th>
              <th>Audience</th>
              <th>Order</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($groupedContents[$type]) && count($groupedContents[$type]))
              @foreach($groupedContents[$type] as $item)
              <tr>
                <td>
                  @if($item->image_path)
                    <img src="{{ asset($item->image_path) }}" class="thumb" alt="{{ $item->title }}">
                  @else
                    <div class="no-image">No<br>Image</div>
                  @endif
                </td>
                <td style="font-weight:600;max-width:160px;">{{ $item->title ?? '—' }}</td>
                <td>
                  <span class="content-preview">{{ Str::limit($item->content, 60) }}</span>
                </td>
                <td>
                  @php $aud = strtolower($item->target_audience); @endphp
                  <span class="audience-badge {{ $aud }}">{{ strtoupper($aud) }}</span>
                </td>
                <td style="color:var(--muted);font-size:13px;">{{ $item->sort_order ?? 0 }}</td>
                <td>
                  <form action="{{ route('Admin.WebContent.Destroy', $item->id) }}" method="POST"
                    onsubmit="return confirm('Delete this content block?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                      <i data-lucide="trash-2"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" style="text-align:center;color:var(--muted);padding:28px;font-size:13px;">
                  No {{ strtolower($meta['label']) }} content added yet.
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    @endforeach

  </div><!-- /page-body -->
</div><!-- /main -->

<script>
  lucide.createIcons();

  // User menu toggle
  const userBtn  = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu');
  userBtn.addEventListener('click', e => {
    e.stopPropagation();
    userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
  });
  document.addEventListener('click', () => { userMenu.style.display = 'none'; });

  // File input label update
  document.getElementById('content_image').addEventListener('change', function () {
    const label = document.getElementById('file-label');
    if (this.files[0]) {
      label.innerHTML = `<strong>${this.files[0].name}</strong>`;
    } else {
      label.innerHTML = '<strong>Click to upload</strong> or drag & drop';
    }
  });
</script>
</body>
</html>