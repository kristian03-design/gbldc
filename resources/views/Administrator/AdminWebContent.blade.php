<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard | Manage Web Content</title>
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

    /* Sidebar styles omitted for brevity, keeping only essential ones inline */
    .sidebar { width: var(--sidebar-w); background: var(--forest); color: #fff; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 100; }
    .sidebar-logo { display: flex; align-items: center; gap: 12px; padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,.1); }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; line-height: 1.2; color: #fff; }
    .logo-sub { font-size: 10px; opacity: .5; letter-spacing: .08em; text-transform: uppercase; }
    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
    .nav-section-label { font-size: 10px; letter-spacing: .1em; text-transform: uppercase; opacity: .4; padding: 16px 8px 6px; }
    .nav-item { display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 10px; text-decoration: none; color: rgba(255,255,255,.7); font-size: 14px; font-weight: 500; transition: background .2s, color .2s; margin-bottom: 2px; }
    .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
    .nav-item.active { background: rgba(34,197,94,.2); color: var(--emerald); }
    .nav-item i[data-lucide] { width: 16px; height: 16px; flex-shrink: 0; }
    
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
    .topbar { background: var(--white); border-bottom: 1px solid var(--border); padding: 14px 32px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
    .topbar-title h1 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--forest); }
    .page-body { padding: 28px 32px; flex: 1; }

    /* Forms & Cards */
    .card { background: var(--white); border-radius: 14px; padding: 24px; border: 1px solid var(--border); margin-bottom: 24px; }
    .card-title { font-size: 16px; font-weight: 700; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .form-group { margin-bottom: 16px; }
    .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-control { width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid var(--border); font-family: inherit; font-size: 14px; }
    .form-control:focus { outline: none; border-color: var(--emerald); box-shadow: 0 0 0 3px rgba(34,197,94,.1); }
    textarea.form-control { resize: vertical; min-height: 80px; }
    .btn { padding: 10px 18px; border-radius: 8px; border: none; font-size: 14px; font-weight: 600; cursor: pointer; transition: all .2s; }
    .btn-primary { background: var(--forest); color: #fff; }
    .btn-primary:hover { background: var(--forest-mid); }
    .btn-danger { background: #fee2e2; color: #dc2626; }
    .btn-danger:hover { background: #fca5a5; }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }

    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    th { text-align: left; padding: 12px; border-bottom: 2px solid var(--border); color: var(--muted); font-weight: 600; font-size: 12px; text-transform: uppercase; }
    td { padding: 12px; border-bottom: 1px solid var(--border); vertical-align: middle; }
    img.thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; }
    .badge { font-size: 11px; padding: 4px 8px; border-radius: 20px; font-weight: 600; background: var(--sage); color: var(--forest-mid); }

    .alert-success { background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
  </style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{asset('images/logocoop-removebg-preview-2.png')}}" alt="GBLDC" style="width:40px;height:40px;object-fit:cover;border-radius:10px;" />
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
    
    <div class="nav-section-label">System</div>
    <a href="{{route('Admin.WebContent')}}" class="nav-item active">
      <i data-lucide="layout-template"></i> Web Content
    </a>
    <a href="{{route('Admin.manage')}}" class="nav-item">
      <i data-lucide="shield-check"></i> Manage Users
    </a>
    <a href="{{route('Admin.Settings')}}" class="nav-item">
      <i data-lucide="settings"></i> Settings
    </a>
    <a href="{{route('Admin.Logout')}}" class="nav-item">
      <i data-lucide="log-out"></i> Logout
    </a>
  </nav>
</aside>

<div class="main">
  <header class="topbar">
    <div class="topbar-title">
      <h1>Manage Landing Page Content</h1>
    </div>
  </header>

  <div class="page-body">
    
    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
      <div class="card-title"><i data-lucide="plus-circle" style="color:var(--emerald);"></i> Add New Content Block</div>
      
      <form action="{{ route('Admin.WebContent.Store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid-3">
          <div class="form-group">
            <label class="form-label">Display On (Audience)</label>
            <select name="target_audience" class="form-control" required>
              <option value="both">Both (Guest & Member)</option>
              <option value="guest">Guest Landing Only</option>
              <option value="member">Member Landing Only</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Section Type</label>
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
            <label class="form-label">Title / Author Name (for testimonials)</label>
            <input type="text" name="title" class="form-control" placeholder="E.g. Annual General Assembly">
          </div>
        </div>

        <div class="grid-2">
          <div class="form-group">
            <label class="form-label">Subtitle / Description / Testimonial Text</label>
            <textarea name="content" class="form-control" placeholder="Write the main text here..."></textarea>
          </div>
          <div>
            <div class="form-group">
              <label class="form-label">Image Upload (Required for Gallery & News)</label>
              <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="form-group">
              <label class="form-label">Sort Order (Lower appears first)</label>
              <input type="number" name="sort_order" class="form-control" value="0">
            </div>
          </div>
        </div>

        <div class="form-group" style="text-align: right;">
          <button type="submit" class="btn btn-primary"><i data-lucide="save" style="width:14px; display:inline-block; vertical-align:middle;"></i> Save Content</button>
        </div>
      </form>
    </div>

    <!-- Grouped Content Lists -->
    @foreach(['news' => 'News & Events', 'testimonial' => 'Member Voices (Testimonials)', 'service' => 'Services', 'gallery' => 'Gallery'] as $type => $label)
    <div class="card">
      <div class="card-title">{{ $label }} Content</div>
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Content Preview</th>
            <th>Audience</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if(isset($groupedContents[$type]))
            @foreach($groupedContents[$type] as $item)
            <tr>
              <td>
                @if($item->image_path)
                  <img src="{{ asset($item->image_path) }}" class="thumb">
                @else
                  <div style="width:60px;height:60px;background:#eee;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#999;font-size:10px;">No Img</div>
                @endif
              </td>
              <td style="font-weight:600;">{{ $item->title ?? 'N/A' }}</td>
              <td style="color:var(--muted); font-size:13px; max-width:300px;">
                {{ Str::limit($item->content, 60) }}
              </td>
              <td><span class="badge">{{ strtoupper($item->target_audience) }}</span></td>
              <td>
                <form action="{{ route('Admin.WebContent.Destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this content block?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size:12px;">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          @else
            <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:20px;">No {{ strtolower($label) }} currently added.</td></tr>
          @endif
        </tbody>
      </table>
    </div>
    @endforeach

  </div>
</div>

<script>
  lucide.createIcons();
</script>
</body>
</html>
