<?php
/**
 * Blogs Listing Page - The Whole Lot
 */
require_once __DIR__ . '/includes/blogs-helper.php';

$pageTitle = 'Blogs & Field Notes — The Whole Lot';
$pageDescription = 'Observations, research, and essays about human behaviour, culture, business, and change from The Whole Lot in Bengaluru.';
$canonicalUrl = 'https://thewholelotmedia.com/blogs.php';
$currentPage = 'blogs';

$allBlogs = get_all_blogs(true);
$categories = get_blog_categories();

// Check if category filter requested via GET
$selectedCategory = $_GET['category'] ?? 'all';

$featuredBlog = !empty($allBlogs) ? $allBlogs[0] : null;
$gridBlogs = count($allBlogs) > 1 ? array_slice($allBlogs, 1) : $allBlogs;

require_once __DIR__ . '/includes/header.php';
?>

<main class="blogs-listing-page">
  <!-- Page Hero -->
  <section class="page-hero">
    <div class="container reveal">
      <div class="eyebrow">BLOGS &amp; FIELD NOTES</div>
      <h1 class="display">THINGS WE NOTICE WHEN <span class="pink">WE’RE PAYING ATTENTION.</span></h1>
      <p class="intro">A growing collection of observations about people, culture, business, memory, behaviour and change. Not answers. Just better questions.</p>
    </div>
  </section>

  <!-- Category Filter Bar -->
  <section class="blogs-filter-section">
    <div class="container reveal">
      <div class="blogs-filter-scroll">
        <button class="filter-tab active" data-filter="all">All Essays (<?php echo count($allBlogs); ?>)</button>
        <?php foreach ($categories as $catName => $count): ?>
          <button class="filter-tab" data-filter="<?php echo htmlspecialchars(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $catName))); ?>">
            <?php echo htmlspecialchars($catName); ?> <span class="tab-count"><?php echo $count; ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Featured Post Hero -->
  <?php if ($featuredBlog): ?>
    <section class="section blogs-featured-section" id="featuredSection">
      <div class="container reveal">
        <div class="featured-blog-card" data-category="<?php echo htmlspecialchars(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $featuredBlog['category']))); ?>">
          <a href="blog-post.php?slug=<?php echo htmlspecialchars($featuredBlog['slug']); ?>" class="featured-media">
            <img src="<?php echo htmlspecialchars($featuredBlog['banner']); ?>" alt="<?php echo htmlspecialchars($featuredBlog['title']); ?>" loading="eager" />
            <span class="featured-badge"><?php echo htmlspecialchars($featuredBlog['category']); ?></span>
          </a>
          <div class="featured-content">
            <div class="featured-meta">
              <span>FEATURED ESSAY</span>
              <span class="dot-sep">•</span>
              <span><?php echo htmlspecialchars($featuredBlog['date']); ?></span>
              <span class="dot-sep">•</span>
              <span><?php echo htmlspecialchars($featuredBlog['read_time']); ?></span>
            </div>
            <h2 class="featured-title">
              <a href="blog-post.php?slug=<?php echo htmlspecialchars($featuredBlog['slug']); ?>">
                <?php echo htmlspecialchars($featuredBlog['title']); ?>
              </a>
            </h2>
            <p class="featured-lead">
              <?php echo htmlspecialchars($featuredBlog['subtitle']); ?>
            </p>
            <div class="featured-footer">
              <a class="btn pink" href="blog-post.php?slug=<?php echo htmlspecialchars($featuredBlog['slug']); ?>">
                Read Full Essay →
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Articles Grid -->
  <section class="section paper blogs-grid-section">
    <div class="container">
      <div class="blogs-grid-header reveal">
        <div class="eyebrow">ALL ESSAYS</div>
        <h2 class="display small" style="margin: 8px 0 0;">LATEST <span class="pink">WRITING.</span></h2>
      </div>

      <div class="blog-cards-grid grid-3 stagger-parent" id="blogsGrid" style="margin-top: 40px;">
        <?php foreach ($allBlogs as $b): ?>
          <article class="blog-card blog-item" data-category="<?php echo htmlspecialchars(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $b['category']))); ?>">
            <a href="blog-post.php?slug=<?php echo htmlspecialchars($b['slug']); ?>" class="blog-card-media">
              <img src="<?php echo htmlspecialchars($b['banner']); ?>" alt="<?php echo htmlspecialchars($b['title']); ?>" loading="lazy" />
              <span class="blog-card-badge"><?php echo htmlspecialchars($b['category']); ?></span>
            </a>
            <div class="blog-card-body">
              <div class="blog-card-meta">
                <span><?php echo htmlspecialchars($b['date']); ?></span>
                <span class="dot-sep">•</span>
                <span><?php echo htmlspecialchars($b['read_time']); ?></span>
              </div>
              <h3 class="blog-card-title">
                <a href="blog-post.php?slug=<?php echo htmlspecialchars($b['slug']); ?>">
                  <?php echo htmlspecialchars($b['title']); ?>
                </a>
              </h3>
              <p class="blog-card-excerpt">
                <?php echo htmlspecialchars(mb_substr($b['subtitle'], 0, 130)) . '...'; ?>
              </p>
              <div class="blog-card-footer">
                <a href="blog-post.php?slug=<?php echo htmlspecialchars($b['slug']); ?>" class="blog-read-more">
                  Read Essay <span>→</span>
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <!-- No items found state -->
      <div id="noBlogsFound" style="display:none; text-align: center; padding: 60px 20px;">
        <h3 style="font-family: 'DM Serif Display', Georgia, serif; font-size: 1.8rem; margin-bottom: 12px;">No essays found in this category.</h3>
        <p style="color: var(--muted); margin-bottom: 24px;">Try selecting another category or view all essays.</p>
        <button class="btn light" onclick="document.querySelector('.filter-tab[data-filter=\'all\']').click();">View All Essays</button>
      </div>
    </div>
  </section>

  <!-- Newsletter / Subscribe Callout Section -->
  <section class="section dark">
    <div class="container reveal" style="text-align: center; max-width: 820px;">
      <p class="pullquote">We don’t publish because the internet needs more content. <span class="underline">It doesn’t.</span></p>
      <p class="lead" style="color: var(--text-muted); margin-top: 24px;">We publish because noticing something and writing it down changes the way you look the next time.</p>
      <div class="actions" style="margin-top: 36px; justify-content: center; display: flex; gap: 14px; flex-wrap: wrap;">
        <a class="btn light" href="mailto:hello@thewholelotmedia.com?subject=Blogs%20subscription">Start Reading / Join the List →</a>
        <a class="btn" style="border: 1px solid rgba(255,255,255,0.25); color: #fff;" href="contact.php">Start a Conversation</a>
      </div>
    </div>
  </section>
</main>

<script>
// Category Filtering Script
document.addEventListener('DOMContentLoaded', function() {
  const tabs = document.querySelectorAll('.filter-tab');
  const items = document.querySelectorAll('.blog-item');
  const featured = document.querySelector('.featured-blog-card');
  const noFound = document.getElementById('noBlogsFound');

  tabs.forEach(tab => {
    tab.addEventListener('click', function() {
      tabs.forEach(t => t.classList.remove('active'));
      this.classList.add('active');

      const filter = this.getAttribute('data-filter');
      let visibleCount = 0;

      items.forEach(item => {
        const itemCat = item.getAttribute('data-category');
        if (filter === 'all' || itemCat === filter) {
          item.style.display = 'flex';
          visibleCount++;
        } else {
          item.style.display = 'none';
        }
      });

      if (featured) {
        const featCat = featured.getAttribute('data-category');
        if (filter === 'all' || featCat === filter) {
          featured.parentElement.parentElement.style.display = 'block';
        } else {
          featured.parentElement.parentElement.style.display = 'none';
        }
      }

      if (noFound) {
        noFound.style.display = visibleCount === 0 ? 'block' : 'none';
      }
    });
  });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
