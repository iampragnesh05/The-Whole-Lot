<?php
require_once __DIR__ . '/config.php';
require_admin_login();

$blogs = get_all_blogs(false);

$totalCount = count($blogs);
$publishedCount = 0;
$draftCount = 0;
foreach ($blogs as $b) {
    if (($b['status'] ?? 'published') === 'published') {
        $publishedCount++;
    } else {
        $draftCount++;
    }
}
$categories = get_blog_categories();

$msg = $_GET['msg'] ?? '';
$notices = [
    'created' => 'Blog article published successfully!',
    'updated' => 'Blog article updated successfully!',
    'deleted' => 'Blog article removed successfully.',
    'toggled' => 'Article status updated.',
    'pwd_updated' => 'Admin password updated successfully.',
    'readonly_error' => 'Action failed: Server filesystem is read-only (e.g. Vercel Serverless). Changes cannot be saved directly on this host.',
    'pwd_readonly_error' => 'Password update failed: Server filesystem is read-only (e.g. Vercel Serverless).'
];
$noticeText = $notices[$msg] ?? '';
$isReadOnly = (file_exists(BLOGS_DATA_FILE) && !is_writable(BLOGS_DATA_FILE)) || (file_exists(ADMIN_AUTH_FILE) && !is_writable(ADMIN_AUTH_FILE));
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Manager Dashboard — The Whole Lot CMS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="icon" href="../favicon.svg" type="image/svg+xml">
  <style>
    :root {
      --archive: #f8f6f2;
      --paper: #f2eee6;
      --ink: #111111;
      --muted: #5f5b56;
      --line: #dcd6cc;
      --pink-spec: #F06A98;
      --green: #2b8a3e;
      --amber: #d97706;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--archive);
      color: var(--ink);
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    
    /* Top Bar */
    .admin-header {
      background: #ffffff;
      border-bottom: 1px solid var(--line);
      padding: 16px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .brand-section {
      display: flex;
      align-items: baseline;
      gap: 12px;
    }
    .brand-logo {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.6rem;
      letter-spacing: 0.08em;
      text-decoration: none;
      color: var(--ink);
    }
    .brand-logo span { color: var(--pink-spec); }
    .badge-cms {
      background: var(--paper);
      border: 1px solid var(--line);
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      padding: 3px 8px;
      border-radius: 4px;
      color: var(--muted);
      text-transform: uppercase;
    }
    .admin-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .btn-view-site {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--ink);
      text-decoration: none;
      padding: 8px 14px;
      border: 1px solid var(--line);
      background: #ffffff;
      border-radius: 6px;
      transition: background 0.2s;
    }
    .btn-view-site:hover { background: var(--paper); }
    .btn-logout {
      font-size: 0.85rem;
      color: #c92a2a;
      text-decoration: none;
      padding: 8px 12px;
    }
    .btn-logout:hover { text-decoration: underline; }

    /* Main Container */
    .admin-main {
      max-width: 1280px;
      width: 100%;
      margin: 0 auto;
      padding: clamp(20px, 3vw, 40px) 24px;
      flex-grow: 1;
    }

    /* Notification */
    .alert-banner {
      background: #ebfbee;
      border-left: 4px solid var(--green);
      color: #2b8a3e;
      padding: 12px 18px;
      margin-bottom: 24px;
      font-size: 0.92rem;
      font-weight: 500;
      border-radius: 0 4px 4px 0;
    }

    /* Page Heading & Actions */
    .dashboard-hero {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      margin-bottom: 28px;
    }
    .dashboard-title {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: clamp(1.8rem, 3vw, 2.4rem);
      line-height: 1.15;
    }
    .dashboard-subtitle {
      font-size: 0.95rem;
      color: var(--muted);
      margin-top: 4px;
    }
    .btn-primary {
      background: var(--ink);
      color: #ffffff;
      text-decoration: none;
      padding: 12px 22px;
      font-weight: 700;
      font-size: 0.9rem;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: background 0.2s, transform 0.1s;
    }
    .btn-primary:hover {
      background: var(--pink-spec);
      transform: translateY(-1px);
    }

    /* Stats Grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      margin-bottom: 32px;
    }
    .stat-card {
      background: #ffffff;
      border: 1px solid var(--line);
      padding: 20px 22px;
      border-radius: 8px;
    }
    .stat-label {
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 6px;
    }
    .stat-value {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 2.4rem;
      line-height: 1;
      color: var(--ink);
    }
    .stat-value.pub { color: var(--green); }
    .stat-value.dft { color: var(--amber); }

    /* Filter & Search Bar */
    .table-controls {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 16px;
    }
    .search-input {
      padding: 9px 14px;
      border: 1px solid var(--line);
      border-radius: 6px;
      background: #ffffff;
      font-size: 0.9rem;
      width: 280px;
    }
    .search-input:focus {
      outline: none;
      border-color: var(--ink);
    }

    /* Table */
    .table-card {
      background: #ffffff;
      border: 1px solid var(--line);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.02);
    }
    .data-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 0.92rem;
    }
    .data-table th {
      background: var(--paper);
      padding: 14px 18px;
      font-weight: 700;
      font-size: 0.8rem;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: var(--muted);
      border-bottom: 1px solid var(--line);
    }
    .data-table td {
      padding: 16px 18px;
      border-bottom: 1px solid var(--line);
      vertical-align: middle;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background: rgba(0,0,0,0.015); }

    .col-thumb { width: 70px; }
    .thumb-img {
      width: 60px;
      height: 40px;
      object-fit: cover;
      border-radius: 4px;
      border: 1px solid var(--line);
      background: var(--paper);
      display: block;
    }

    .post-title-link {
      font-weight: 700;
      color: var(--ink);
      text-decoration: none;
      font-size: 0.98rem;
      line-height: 1.35;
      display: block;
      margin-bottom: 4px;
    }
    .post-title-link:hover { color: var(--pink-spec); }
    .post-slug-text {
      font-size: 0.78rem;
      color: var(--muted);
      font-family: monospace;
    }

    .cat-badge {
      display: inline-block;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      padding: 4px 8px;
      border-radius: 4px;
      background: var(--paper);
      border: 1px solid var(--line);
      color: var(--ink);
    }

    .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.78rem;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 999px;
      text-decoration: none;
      cursor: pointer;
    }
    .status-pill.published {
      background: #e6fcf5;
      color: #0ca678;
      border: 1px solid #c3fae8;
    }
    .status-pill.draft {
      background: #fff9db;
      color: #f59f00;
      border: 1px solid #ffec99;
    }
    .status-pill:hover { opacity: 0.85; }

    .actions-cell {
      display: flex;
      gap: 8px;
      align-items: center;
    }
    .btn-action {
      padding: 6px 10px;
      border: 1px solid var(--line);
      border-radius: 4px;
      background: #ffffff;
      font-size: 0.82rem;
      font-weight: 600;
      text-decoration: none;
      color: var(--ink);
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: all 0.15s;
    }
    .btn-action:hover {
      background: var(--ink);
      color: #ffffff;
      border-color: var(--ink);
    }
    .btn-action.delete {
      color: #c92a2a;
      border-color: #ffc9c9;
    }
    .btn-action.delete:hover {
      background: #c92a2a;
      color: #ffffff;
      border-color: #c92a2a;
    }

    /* Modal for Change Password */
    .modal-overlay {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.4);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 100;
      padding: 20px;
    }
    .modal-box {
      background: #ffffff;
      border: 1px solid var(--line);
      border-radius: 8px;
      width: 100%;
      max-width: 420px;
      padding: 28px;
      box-shadow: 0 16px 40px rgba(0,0,0,0.15);
    }
    .modal-box h3 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.4rem;
      margin-bottom: 16px;
    }
    .form-row { margin-bottom: 16px; }
    .form-row label {
      display: block;
      font-size: 0.8rem;
      font-weight: 700;
      margin-bottom: 6px;
    }
    .form-row input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--line);
      border-radius: 4px;
      font-size: 0.95rem;
    }
    .modal-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="admin-header">
    <div class="brand-section">
      <a href="index.php" class="brand-logo">THE WHOLE LOT<span>.</span></a>
      <span class="badge-cms">Blog Manager CMS</span>
    </div>
    <div class="admin-actions">
      <a href="../blogs.php" target="_blank" class="btn-view-site">View Live Blogs ↗</a>
      <button onclick="document.getElementById('pwdModal').style.display='flex';" class="btn-view-site" style="cursor:pointer">Account &amp; Password</button>
      <a href="logout.php" class="btn-logout">Sign Out</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="admin-main">
    <?php if ($isReadOnly): ?>
      <div style="background: #fffbeb; border: 1px solid #fcd34d; border-left: 5px solid #f59e0b; padding: 14px 18px; border-radius: 6px; margin-bottom: 24px; color: #92400e; font-size: 0.92rem; line-height: 1.55;">
        <strong style="color: #78350f;">⚠️ Serverless / Read-Only Environment Active (e.g. Vercel)</strong><br>
        This website is currently deployed on a serverless hosting provider with a read-only filesystem. Article reading and preview work as normal. However, direct browser changes (saving edits, new posts, image uploads) cannot be written directly to the serverless disk.
        <div style="margin-top: 8px;">
          • <strong>Full CMS editing:</strong> Host this site on a standard PHP web host like <strong>Hostinger</strong>, <strong>cPanel</strong>, or a <strong>VPS</strong> (see instructions in <code>README.txt</code>).<br>
          • <strong>Local edits:</strong> You can download your current database below, edit locally, and push to Git.
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($noticeText)): ?>
      <div class="alert-banner"><?php echo htmlspecialchars($noticeText); ?></div>
    <?php endif; ?>

    <div class="dashboard-hero">
      <div>
        <h1 class="dashboard-title">Blog Articles</h1>
        <p class="dashboard-subtitle">Manage, publish, and edit essays that pull directly into your website.</p>
      </div>
      <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <a href="export-blogs.php" class="btn-action" style="padding: 12px 18px; font-weight: 700; border-radius: 6px; font-size: 0.88rem; text-decoration: none;">⬇ Export blogs.json</a>
        <a href="create.php" class="btn-primary">+ Add New Blog Post</a>
      </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-label">Total Articles</div>
        <div class="stat-value"><?php echo $totalCount; ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Published Articles</div>
        <div class="stat-value pub"><?php echo $publishedCount; ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Drafts</div>
        <div class="stat-value dft"><?php echo $draftCount; ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Categories</div>
        <div class="stat-value"><?php echo count($categories); ?></div>
      </div>
    </div>

    <!-- Controls -->
    <div class="table-controls">
      <input type="text" id="filterInput" class="search-input" placeholder="Search articles by title or keyword..." onkeyup="filterBlogs()" />
      <span style="font-size:0.85rem; color:var(--muted);">Showing <?php echo $totalCount; ?> articles</span>
    </div>

    <!-- Table -->
    <div class="table-card">
      <table class="data-table" id="blogsTable">
        <thead>
          <tr>
            <th class="col-thumb">Banner</th>
            <th>Title &amp; URL Slug</th>
            <th>Category</th>
            <th>Date &amp; Read Time</th>
            <th>Status</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($blogs as $b): ?>
            <tr>
              <td class="col-thumb">
                <img src="../<?php echo htmlspecialchars($b['banner']); ?>" class="thumb-img" alt="" onerror="this.src='../favicon.svg'" />
              </td>
              <td>
                <a href="edit.php?id=<?php echo $b['id']; ?>" class="post-title-link">
                  <?php echo htmlspecialchars($b['title']); ?>
                </a>
                <span class="post-slug-text">/blog/<?php echo htmlspecialchars($b['slug']); ?></span>
              </td>
              <td>
                <span class="cat-badge"><?php echo htmlspecialchars($b['category']); ?></span>
              </td>
              <td>
                <div style="font-weight: 500;"><?php echo htmlspecialchars($b['date']); ?></div>
                <div style="font-size: 0.78rem; color: var(--muted);"><?php echo htmlspecialchars($b['read_time'] ?? '5 min read'); ?></div>
              </td>
              <td>
                <a href="toggle-status.php?id=<?php echo $b['id']; ?>" class="status-pill <?php echo htmlspecialchars($b['status'] ?? 'published'); ?>" title="Click to toggle status">
                  <span class="dot">●</span> <?php echo ucfirst($b['status'] ?? 'published'); ?>
                </a>
              </td>
              <td style="text-align: right;">
                <div class="actions-cell" style="justify-content: flex-end;">
                  <a href="../blog-post.php?slug=<?php echo urlencode($b['slug']); ?>" target="_blank" class="btn-action" title="View live page">View ↗</a>
                  <a href="edit.php?id=<?php echo $b['id']; ?>" class="btn-action">Edit</a>
                  <a href="delete.php?id=<?php echo $b['id']; ?>" class="btn-action delete" onclick="return confirm('Are you sure you want to delete this blog post? This cannot be undone.');">Delete</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Password Modal -->
  <div class="modal-overlay" id="pwdModal">
    <div class="modal-box">
      <h3>Change Admin Credentials</h3>
      <form method="POST" action="change-password.php">
        <div class="form-row">
          <label>Username</label>
          <input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['thewholelot_admin_user'] ?? 'admin'); ?>" required />
        </div>
        <div class="form-row">
          <label>New Password</label>
          <input type="password" name="password" placeholder="Leave blank to keep current password" />
        </div>
        <div class="modal-buttons">
          <button type="button" class="btn-view-site" onclick="document.getElementById('pwdModal').style.display='none';">Cancel</button>
          <button type="submit" class="btn-primary">Update Credentials</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function filterBlogs() {
      const q = document.getElementById('filterInput').value.toLowerCase();
      const rows = document.querySelectorAll('#blogsTable tbody tr');
      rows.forEach(r => {
        const text = r.innerText.toLowerCase();
        r.style.display = text.includes(q) ? '' : 'none';
      });
    }
  </script>
</body>
</html>
