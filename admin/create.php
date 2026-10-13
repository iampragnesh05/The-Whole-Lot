<?php
require_once __DIR__ . '/config.php';
require_admin_login();

$error = '';
$categories = [
    'HIDDEN IN PLAIN SIGHT',
    'STORIES THAT BUILT US',
    'MARKETING, BUT HUMAN',
    'FIELD NOTES',
    'THE WHOLE LOT THINKING',
    'MAKING THE WHOLE LOT',
    'RIGHT NOW'
];

// Scan available banner images
$bannerImages = [];
$bannerDir = __DIR__ . '/../assets/images/blogs';
if (is_dir($bannerDir)) {
    foreach (scandir($bannerDir) as $f) {
        if (!in_array($f, ['.', '..']) && preg_match('/\.(png|jpe?g|webp)$/i', $f)) {
            $bannerImages[] = 'assets/images/blogs/' . $f;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $category = trim($_POST['category'] ?? '');
    if ($category === 'custom') {
        $category = trim($_POST['custom_category'] ?? 'General');
    }
    $subtitle = trim($_POST['subtitle'] ?? '');
    $author = trim($_POST['author'] ?? 'Avani Jain');
    $author_title = trim($_POST['author_title'] ?? 'Founder, The Whole Lot');
    $date = trim($_POST['date'] ?? date('F Y'));
    $read_time = trim($_POST['read_time'] ?? '5 min read');
    $content = trim($_POST['content'] ?? '');
    $status = $_POST['status'] ?? 'published';
    
    // Key Takeaways
    $takeaways_raw = trim($_POST['key_takeaways'] ?? '');
    $takeaways = [];
    if (!empty($takeaways_raw)) {
        foreach (explode("\n", $takeaways_raw) as $line) {
            $line = trim($line, " \t\n\r\0\x0B-•*");
            if (!empty($line)) {
                $takeaways[] = $line;
            }
        }
    }
    
    // Handle Banner Image Upload or Selection
    $bannerPath = $_POST['existing_banner'] ?? ($bannerImages[0] ?? 'assets/images/blogs/banner_01_busy_status_symbol.png');
    if (!empty($_FILES['banner_upload']['name'])) {
        $file = $_FILES['banner_upload'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $filename = 'banner_' . time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($file['name'], PATHINFO_FILENAME)) . '.' . $ext;
            $target = $bannerDir . '/' . $filename;
            if (is_writable($bannerDir) && @move_uploaded_file($file['tmp_name'], $target)) {
                $bannerPath = 'assets/images/blogs/' . $filename;
            }
        }
    }
    
    // Related reading
    $related_raw = trim($_POST['related_reading'] ?? '');
    $related_list = array_filter(array_map('trim', explode(';', $related_raw)));
    
    if (empty($title)) {
        $error = 'Please provide an article title.';
    } else {
        $newBlog = [
            'title' => $title,
            'slug' => !empty($slug) ? slugify($slug) : slugify($title),
            'subtitle' => $subtitle,
            'category' => $category,
            'category_slug' => slugify($category),
            'author' => $author,
            'author_title' => $author_title,
            'date' => $date,
            'read_time' => $read_time,
            'banner' => $bannerPath,
            'key_takeaways' => $takeaways,
            'content' => $content,
            'seo' => [
                'meta_title' => trim($_POST['meta_title'] ?? $title),
                'meta_description' => trim($_POST['meta_description'] ?? mb_substr($subtitle, 0, 150)),
                'primary_keyword' => trim($_POST['primary_keyword'] ?? ''),
                'secondary_keywords' => trim($_POST['secondary_keywords'] ?? ''),
                'related_reading' => array_values($related_list),
                'schema_type' => trim($_POST['schema_type'] ?? 'BlogPosting')
            ],
            'status' => $status
        ];
        
        $saved = save_blog($newBlog);
        if ($saved === false) {
            $error = 'Failed to save blog post: The server filesystem is read-only (e.g. Vercel Serverless). Persistent edits require standard PHP hosting (Hostinger/cPanel) or updating data/blogs.json locally.';
        } else {
            header("Location: index.php?msg=created");
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create New Blog Post — The Whole Lot CMS</title>
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
    .brand-section { display: flex; align-items: baseline; gap: 12px; }
    .brand-logo { font-family: 'Bebas Neue', sans-serif; font-size: 1.6rem; letter-spacing: 0.08em; text-decoration: none; color: var(--ink); }
    .brand-logo span { color: var(--pink-spec); }
    
    .editor-container {
      max-width: 1080px;
      width: 100%;
      margin: 0 auto;
      padding: 30px 20px 80px;
    }
    .editor-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }
    .editor-title {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: 2rem;
    }
    .card {
      background: #ffffff;
      border: 1px solid var(--line);
      border-radius: 8px;
      padding: 28px;
      margin-bottom: 24px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.02);
    }
    .card-title {
      font-size: 1.05rem;
      font-weight: 700;
      margin-bottom: 18px;
      padding-bottom: 12px;
      border-bottom: 1px solid var(--line);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .form-grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 18px;
    }
    .form-group {
      margin-bottom: 18px;
    }
    label {
      display: block;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      margin-bottom: 6px;
      color: var(--ink);
    }
    .help-text {
      font-size: 0.78rem;
      color: var(--muted);
      margin-top: 4px;
    }
    input[type="text"], textarea, select {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid var(--line);
      border-radius: 6px;
      font-size: 0.95rem;
      background: #ffffff;
      color: var(--ink);
      font-family: inherit;
    }
    input:focus, textarea:focus, select:focus {
      outline: none;
      border-color: var(--ink);
    }
    textarea {
      resize: vertical;
      line-height: 1.5;
    }

    /* Content Toolbar */
    .editor-toolbar {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      background: var(--paper);
      padding: 8px 12px;
      border: 1px solid var(--line);
      border-bottom: none;
      border-radius: 6px 6px 0 0;
    }
    .tool-btn {
      background: #ffffff;
      border: 1px solid var(--line);
      padding: 4px 10px;
      font-size: 0.8rem;
      font-weight: 600;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.15s;
    }
    .tool-btn:hover { background: var(--archive); border-color: var(--ink); }
    .content-textarea {
      border-radius: 0 0 6px 6px;
      min-height: 400px;
      font-family: monospace;
      font-size: 0.9rem;
    }

    .btn-save {
      background: var(--ink);
      color: #ffffff;
      padding: 14px 28px;
      border: none;
      border-radius: 6px;
      font-weight: 700;
      font-size: 0.95rem;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-save:hover { background: var(--pink-spec); }
    .btn-cancel {
      text-decoration: none;
      color: var(--muted);
      padding: 14px 20px;
      font-size: 0.9rem;
    }
    .btn-cancel:hover { color: var(--ink); }
    .action-bar {
      display: flex;
      align-items: center;
      gap: 14px;
    }
  </style>
</head>
<body>
  <header class="admin-header">
    <div class="brand-section">
      <a href="index.php" class="brand-logo">THE WHOLE LOT<span>.</span></a>
    </div>
    <div>
      <a href="index.php" style="color:var(--muted); text-decoration:none; font-size:0.9rem;">← Cancel &amp; Return to Dashboard</a>
    </div>
  </header>

  <div class="editor-container">
    <div class="editor-header">
      <h1 class="editor-title">Write New Blog Article</h1>
    </div>

    <?php if (!empty($error)): ?>
      <div style="background:#fff0f3; color:#c92a2a; padding:12px 18px; border-radius:6px; margin-bottom:20px;">
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="create.php" enctype="multipart/form-data">
      <!-- Core Info -->
      <div class="card">
        <div class="card-title">1. Essential Details</div>
        
        <div class="form-group">
          <label for="title">Article Title *</label>
          <input type="text" id="title" name="title" required placeholder="e.g. Why Is Being Busy a Status Symbol?" onkeyup="autoSlug()" />
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label for="slug">URL Slug *</label>
            <input type="text" id="slug" name="slug" required placeholder="why-is-being-busy-a-status-symbol" />
            <div class="help-text">Live URL will be: <code>/blog/&lt;slug&gt;</code></div>
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" onchange="toggleCustomCategory()">
              <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
              <?php endforeach; ?>
              <option value="custom">+ Enter Custom Category...</option>
            </select>
            <input type="text" id="custom_category" name="custom_category" placeholder="Custom category name" style="display:none; margin-top:8px;" />
          </div>
        </div>

        <div class="form-group">
          <label for="subtitle">Subtitle / Lead Excerpt</label>
          <textarea id="subtitle" name="subtitle" rows="3" placeholder="A 2-3 sentence overview of what this essay explores. Appears as the lead paragraph and meta description."></textarea>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label for="author">Author Name</label>
            <input type="text" id="author" name="author" value="Avani Jain" />
          </div>
          <div class="form-group">
            <label for="author_title">Author Title</label>
            <input type="text" id="author_title" name="author_title" value="Founder, The Whole Lot" />
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label for="date">Display Date</label>
            <input type="text" id="date" name="date" value="<?php echo date('F Y'); ?>" placeholder="e.g. October 2026" />
          </div>
          <div class="form-group">
            <label for="read_time">Estimated Read Time</label>
            <input type="text" id="read_time" name="read_time" value="5 min read" placeholder="e.g. 6 min read" />
          </div>
        </div>
      </div>

      <!-- Banner Image -->
      <div class="card">
        <div class="card-title">2. Banner Image</div>
        <div class="form-grid-2">
          <div class="form-group">
            <label for="existing_banner">Select Existing Banner</label>
            <select id="existing_banner" name="existing_banner" onchange="updateBannerPreview(this.value)">
              <?php foreach ($bannerImages as $img): ?>
                <option value="<?php echo htmlspecialchars($img); ?>"><?php echo basename($img); ?></option>
              <?php endforeach; ?>
            </select>
            <div class="help-text">Pick from banner images in the library.</div>
          </div>
          <div class="form-group">
            <label for="banner_upload">Or Upload New Image</label>
            <input type="file" id="banner_upload" name="banner_upload" accept="image/*" />
            <div class="help-text">Recommended size: 1600x900 (16:9 ratio). PNG, JPG, WebP.</div>
          </div>
        </div>
        <div style="margin-top:10px;">
          <div style="font-size:0.78rem; font-weight:700; margin-bottom:6px; color:var(--muted);">Preview:</div>
          <img id="bannerPreview" src="../<?php echo htmlspecialchars($bannerImages[0] ?? ''); ?>" style="max-height:160px; border-radius:6px; border:1px solid var(--line); display:block;" alt="" />
        </div>
      </div>

      <!-- Key Takeaways -->
      <div class="card">
        <div class="card-title">3. Key Takeaways Box</div>
        <div class="form-group">
          <label for="key_takeaways">Key Takeaways (one per line)</label>
          <textarea id="key_takeaways" name="key_takeaways" rows="4" placeholder="Enter bullet points for the key takeaways box. Put each point on a new line."></textarea>
          <div class="help-text">These will be styled into a high-visibility highlight box at the top of the article.</div>
        </div>
      </div>

      <!-- Body Content -->
      <div class="card">
        <div class="card-title">4. Article Body Content</div>
        <div class="editor-toolbar">
          <button type="button" class="tool-btn" onclick="insertTag('&lt;h2 class=&quot;blog-heading-2&quot;&gt;', '&lt;/h2&gt;')">+ H2 Heading</button>
          <button type="button" class="tool-btn" onclick="insertTag('&lt;h3 class=&quot;blog-heading-3&quot;&gt;', '&lt;/h3&gt;')">+ H3 Subheading</button>
          <button type="button" class="tool-btn" onclick="insertTag('&lt;p class=&quot;blog-paragraph&quot;&gt;', '&lt;/p&gt;')">+ Paragraph</button>
          <button type="button" class="tool-btn" onclick="insertTag('&lt;strong&gt;', '&lt;/strong&gt;')">Bold</button>
          <button type="button" class="tool-btn" onclick="insertTag('&lt;em&gt;', '&lt;/em&gt;')">Italic</button>
          <button type="button" class="tool-btn" onclick="insertList()">+ Bullet List</button>
          <button type="button" class="tool-btn" onclick="insertTable()">+ Table</button>
          <button type="button" class="tool-btn" onclick="insertTag('&lt;p class=&quot;blog-source-note&quot;&gt;&lt;em&gt;', '&lt;/em&gt;&lt;/p&gt;')">+ Source Note</button>
        </div>
        <textarea id="content" name="content" class="content-textarea" placeholder="Write or paste your article content here in clean HTML..."></textarea>
      </div>

      <!-- SEO Pack -->
      <div class="card">
        <div class="card-title">5. SEO, AEO &amp; GEO Pack</div>
        <div class="form-grid-2">
          <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" placeholder="Meta title for Google and search engines" />
          </div>
          <div class="form-group">
            <label for="primary_keyword">Primary Keyword</label>
            <input type="text" id="primary_keyword" name="primary_keyword" placeholder="e.g. why is being busy a status symbol" />
          </div>
        </div>
        <div class="form-group">
          <label for="meta_description">Meta Description</label>
          <textarea id="meta_description" name="meta_description" rows="2" placeholder="Under 160 characters summary for search engines"></textarea>
        </div>
        <div class="form-group">
          <label for="secondary_keywords">Secondary Keywords (semicolon separated)</label>
          <input type="text" id="secondary_keywords" name="secondary_keywords" placeholder="e.g. hustle culture; busyness as status; work culture India" />
        </div>
        <div class="form-grid-2">
          <div class="form-group">
            <label for="related_reading">Related Reading (article titles separated by semicolon)</label>
            <input type="text" id="related_reading" name="related_reading" placeholder="e.g. Why Do Superstitions Survive?; Is SEO Dead in 2026?" />
          </div>
          <div class="form-group">
            <label for="schema_type">Schema Markup Type</label>
            <select id="schema_type" name="schema_type">
              <option value="BlogPosting">BlogPosting (Standard)</option>
              <option value="Article">Article</option>
              <option value="FAQPage">Article + FAQPage</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Publishing Status & Submit -->
      <div class="card" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
          <label for="status" style="margin-bottom:0; display:inline-block; margin-right:12px;">Status:</label>
          <select id="status" name="status" style="width:auto; display:inline-block;">
            <option value="published">Published (Live on website)</option>
            <option value="draft">Draft (Private, not listed)</option>
          </select>
        </div>
        <div class="action-bar">
          <a href="index.php" class="btn-cancel">Discard</a>
          <button type="submit" class="btn-save">Publish Blog Post →</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    function autoSlug() {
      const title = document.getElementById('title').value;
      const slugInput = document.getElementById('slug');
      if (!slugInput.dataset.manual) {
        slugInput.value = title.toLowerCase()
          .replace(/[^\w\s-]/g, '')
          .replace(/[\s_-]+/g, '-')
          .replace(/^-+|-+$/g, '');
      }
    }
    document.getElementById('slug').addEventListener('input', function() {
      this.dataset.manual = 'true';
    });

    function toggleCustomCategory() {
      const sel = document.getElementById('category').value;
      const custom = document.getElementById('custom_category');
      custom.style.display = sel === 'custom' ? 'block' : 'none';
      if (sel === 'custom') custom.focus();
    }

    function updateBannerPreview(val) {
      document.getElementById('bannerPreview').src = '../' + val;
    }

    function insertTag(openTag, closeTag) {
      const area = document.getElementById('content');
      const start = area.selectionStart;
      const end = area.selectionEnd;
      const selected = area.value.substring(start, end);
      const replacement = openTag + (selected || 'Sample text') + closeTag;
      area.value = area.value.substring(0, start) + replacement + area.value.substring(end);
      area.focus();
    }

    function insertList() {
      const listHtml = '<ul class="blog-bullet-list">\n  <li>Point one</li>\n  <li>Point two</li>\n  <li>Point three</li>\n</ul>\n';
      insertRaw(listHtml);
    }

    function insertTable() {
      const tableHtml = '<div class="blog-table-wrap">\n<table class="blog-table">\n  <thead>\n    <tr>\n      <th>Column 1</th>\n      <th>Column 2</th>\n      <th>Column 3</th>\n    </tr>\n  </thead>\n  <tbody>\n    <tr>\n      <td>Value A</td>\n      <td>Value B</td>\n      <td>Value C</td>\n    </tr>\n  </tbody>\n</table>\n</div>\n';
      insertRaw(tableHtml);
    }

    function insertRaw(raw) {
      const area = document.getElementById('content');
      const start = area.selectionStart;
      area.value = area.value.substring(0, start) + raw + area.value.substring(start);
      area.focus();
    }
  </script>
</body>
</html>
