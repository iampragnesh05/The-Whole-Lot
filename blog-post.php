<?php
/**
 * Single Blog Post Template - The Whole Lot
 */
require_once __DIR__ . '/includes/blogs-helper.php';

$slug = $_GET['slug'] ?? '';
$id = $_GET['id'] ?? null;

$blog = null;
if (!empty($slug)) {
    $blog = get_blog_by_slug($slug);
} elseif (!empty($id)) {
    $blog = get_blog_by_id($id);
}

// Fallback: If no slug/id given or not found, redirect to blogs.php
if (!$blog) {
    header("Location: blogs.php");
    exit;
}

$pageTitle = ($blog['seo']['meta_title'] ?? $blog['title']) . ' — The Whole Lot';
$pageDescription = $blog['seo']['meta_description'] ?? $blog['subtitle'];
$canonicalUrl = 'https://thewholelotmedia.com/blog/' . htmlspecialchars($blog['slug']);
$currentPage = 'blogs';
$ogType = 'article';
$ogImage = 'https://thewholelotmedia.com/' . $blog['banner'];
$metaKeywords = trim(($blog['seo']['primary_keyword'] ?? '') . ', ' . ($blog['seo']['secondary_keywords'] ?? ''), ', ');

// Structured Schema Markup
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $blog['title'],
    'description' => $blog['subtitle'],
    'image' => [$ogImage],
    'datePublished' => $blog['created_at'] ?? '2026-10-12',
    'dateModified' => $blog['updated_at'] ?? '2026-10-12',
    'author' => [
        '@type' => 'Person',
        'name' => $blog['author'] ?? 'Avani Jain',
        'jobTitle' => $blog['author_title'] ?? 'Founder, The Whole Lot'
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'The Whole Lot',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => 'https://thewholelotmedia.com/favicon.svg'
        ]
    ],
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $canonicalUrl
    ]
];
$extraHead = '<script type="application/ld+json">' . json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';

require_once __DIR__ . '/includes/header.php';

// Fetch other blogs for "Related Reading"
$allBlogs = get_all_blogs(true);
$relatedBlogs = [];
if (!empty($blog['seo']['related_reading'])) {
    foreach ($blog['seo']['related_reading'] as $relTitle) {
        foreach ($allBlogs as $b) {
            if ($b['id'] !== $blog['id'] && (stripos($b['title'], $relTitle) !== false || stripos($relTitle, $b['title']) !== false)) {
                $relatedBlogs[] = $b;
                break;
            }
        }
    }
}
// If less than 2 related blogs found, pick others from the same or different category
if (count($relatedBlogs) < 2) {
    foreach ($allBlogs as $b) {
        if ($b['id'] !== $blog['id'] && !in_array($b, $relatedBlogs)) {
            $relatedBlogs[] = $b;
            if (count($relatedBlogs) >= 3) break;
        }
    }
}
?>

<main class="blog-detail-page">
  <!-- Article Header / Hero -->
  <article class="blog-article-wrapper">
    <header class="blog-header-section">
      <div class="container container-reading reveal">
        <!-- Breadcrumb -->
        <nav class="blog-breadcrumb" aria-label="Breadcrumb">
          <a href="index.php">Home</a>
          <span class="sep">/</span>
          <a href="blogs.php">Blogs</a>
          <span class="sep">/</span>
          <span class="current"><?php echo htmlspecialchars($blog['category']); ?></span>
        </nav>

        <div class="blog-category-badge"><?php echo htmlspecialchars($blog['category']); ?></div>
        
        <h1 class="blog-article-title"><?php echo htmlspecialchars($blog['title']); ?></h1>
        
        <?php if (!empty($blog['subtitle'])): ?>
          <p class="blog-article-lead"><?php echo htmlspecialchars($blog['subtitle']); ?></p>
        <?php endif; ?>

        <!-- Author / Meta Bar -->
        <div class="blog-meta-bar">
          <div class="blog-author-info">
            <div class="blog-author-avatar">AJ</div>
            <div class="blog-author-text">
              <span class="blog-author-name"><?php echo htmlspecialchars($blog['author']); ?></span>
              <span class="blog-author-title"><?php echo htmlspecialchars($blog['author_title']); ?></span>
            </div>
          </div>
          <div class="blog-meta-details">
            <span class="blog-date"><time datetime="<?php echo htmlspecialchars($blog['created_at']); ?>"><?php echo htmlspecialchars($blog['date']); ?></time></span>
            <span class="dot-sep">•</span>
            <span class="blog-read-time"><?php echo htmlspecialchars($blog['read_time']); ?></span>
          </div>
        </div>
      </div>
    </header>

    <!-- Featured Banner Image -->
    <?php if (!empty($blog['banner']) && file_exists(__DIR__ . '/' . $blog['banner'])): ?>
      <div class="container container-banner reveal">
        <div class="blog-featured-banner">
          <img src="<?php echo htmlspecialchars($blog['banner']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" loading="eager" />
        </div>
      </div>
    <?php endif; ?>

    <!-- Article Content -->
    <section class="blog-content-section">
      <div class="container container-reading">
        
        <!-- Key Takeaways Highlight Box -->
        <?php if (!empty($blog['key_takeaways']) && is_array($blog['key_takeaways'])): ?>
          <aside class="blog-takeaways-card reveal" aria-label="Key Takeaways">
            <div class="takeaways-header">
              <span class="takeaways-badge">KEY TAKEAWAYS</span>
            </div>
            <ul class="takeaways-list">
              <?php foreach ($blog['key_takeaways'] as $item): ?>
                <li><?php echo htmlspecialchars($item); ?></li>
              <?php endforeach; ?>
            </ul>
          </aside>
        <?php endif; ?>

        <!-- Main Body HTML Content -->
        <div class="blog-body-content reveal">
          <?php echo $blog['content']; ?>
        </div>

        <!-- Author Bio Footer Box -->
        <div class="blog-author-card reveal">
          <div class="author-avatar-large">AJ</div>
          <div class="author-bio-content">
            <div class="author-bio-eyebrow">WRITTEN BY</div>
            <h4 class="author-bio-name"><?php echo htmlspecialchars($blog['author']); ?></h4>
            <div class="author-bio-role"><?php echo htmlspecialchars($blog['author_title']); ?></div>
            <p class="author-bio-p">Avani Jain explores how people, culture, and context shape businesses and the world around them. Founder of The Whole Lot, an independent strategy and research practice based in Bengaluru.</p>
          </div>
        </div>

        <!-- Share / Action Bar -->
        <div class="blog-share-row reveal">
          <div class="share-label">Share this essay:</div>
          <div class="share-buttons">
            <a class="share-btn" href="https://twitter.com/intent/tweet?url=<?php echo urlencode($canonicalUrl); ?>&text=<?php echo urlencode($blog['title']); ?>" target="_blank" rel="noopener noreferrer">Twitter / X</a>
            <a class="share-btn" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($canonicalUrl); ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a>
            <button class="share-btn copy-btn" onclick="navigator.clipboard.writeText(window.location.href); this.innerText='Link Copied!'; setTimeout(() => this.innerText='Copy Link', 2000);">Copy Link</button>
          </div>
        </div>

      </div>
    </section>
  </article>

  <!-- Related Reading Section -->
  <?php if (!empty($relatedBlogs)): ?>
    <section class="section paper blog-related-section">
      <div class="container reveal">
        <div class="eyebrow">CONTINUE EXPLORING</div>
        <h2 class="display small" style="margin-top: 10px; margin-bottom: 40px;">RELATED <span class="pink">ESSAYS &amp; NOTES.</span></h2>
        
        <div class="blog-cards-grid grid-3 stagger-parent">
          <?php foreach ($relatedBlogs as $rel): ?>
            <article class="blog-card">
              <a href="blog-post.php?slug=<?php echo htmlspecialchars($rel['slug']); ?>" class="blog-card-media">
                <img src="<?php echo htmlspecialchars($rel['banner']); ?>" alt="<?php echo htmlspecialchars($rel['title']); ?>" loading="lazy" />
                <span class="blog-card-badge"><?php echo htmlspecialchars($rel['category']); ?></span>
              </a>
              <div class="blog-card-body">
                <div class="blog-card-meta">
                  <span><?php echo htmlspecialchars($rel['date']); ?></span>
                  <span>•</span>
                  <span><?php echo htmlspecialchars($rel['read_time']); ?></span>
                </div>
                <h3 class="blog-card-title">
                  <a href="blog-post.php?slug=<?php echo htmlspecialchars($rel['slug']); ?>">
                    <?php echo htmlspecialchars($rel['title']); ?>
                  </a>
                </h3>
                <p class="blog-card-excerpt">
                  <?php echo htmlspecialchars(mb_substr($rel['subtitle'], 0, 110)) . '...'; ?>
                </p>
                <div class="blog-card-footer">
                  <a href="blog-post.php?slug=<?php echo htmlspecialchars($rel['slug']); ?>" class="blog-read-more">
                    Read Essay <span>→</span>
                  </a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Conversation Callout Section -->
  <section class="section dark">
    <div class="container reveal" style="text-align: center; max-width: 800px;">
      <div class="eyebrow" style="color: var(--pink-spec);">THE WHOLE LOT THINKING</div>
      <h2 class="display small" style="color: #fff; margin: 16px 0 20px;">NOT ANSWERS. <span class="pink">JUST BETTER QUESTIONS.</span></h2>
      <p class="lead" style="color: var(--text-muted); margin-bottom: 34px;">Looking at context, culture, and behaviour before trying to solve business problems. If you want to explore what this means for your brand or venture, let's talk.</p>
      <div class="actions" style="justify-content: center; display: flex; gap: 14px; flex-wrap: wrap;">
        <a class="btn pink" href="contact.php">Start a Conversation →</a>
        <a class="btn light" href="blogs.php">View All Blogs</a>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
