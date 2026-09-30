<?php
$page = 'reflections';
$pageTitle = 'Reflections';
$pageDescription = 'Reflections from The Whole Lot: observations about people, culture, business, memory, behaviour and change.';
$pagePath = '/reflections';
?>
<!doctype html>
<html lang="en">
<head>
<?php include __DIR__ . '/partials/meta.php'; ?>
</head>
<body>
<div class="site-shell">
<?php include __DIR__ . '/partials/header.php'; ?>

<main id="main-content">
  <!-- 1. Hero -->
  <section class="page-hero" aria-label="Reflections Hero">
    <div class="container">
      <span class="eyebrow">REFLECTIONS</span>
      <h1 class="display">
        THINGS WE NOTICE WHEN <br>
        <span class="pink">WE’RE PAYING ATTENTION.</span>
      </h1>
      <p class="intro">
        A growing collection of observations about people, culture, business, memory, behaviour and change. Not answers. Just better questions.
      </p>
    </div>
  </section>

  <!-- 2. What Lives Here -->
  <section class="section" aria-label="About Reflections">
    <div class="container grid-2" data-reveal>
      <div>
        <span class="eyebrow">WHAT LIVES HERE</span>
        <h2 class="display small">
          SOMETIMES SOMETHING SMALL TELLS YOU <span class="pink">SOMETHING MUCH LARGER.</span>
        </h2>
      </div>
      <div>
        <p class="lead" style="font-size: 1.25rem;">
          A billboard. A conversation with a cab driver. A grandmother’s superstition. Something strange in an advertisement. A behaviour we all accept without remembering why. A city changing around its people. A product becoming a cultural symbol.
        </p>
        <p class="muted">
          Reflections is where we follow those threads.
        </p>
      </div>
    </div>
  </section>

  <!-- 3. Category Filter Bar & Empty State with Newsletter Signup -->
  <section class="section paper" aria-label="Reflections Archive">
    <div class="container">
      <span class="eyebrow">CATEGORIES</span>
      
      <!-- Category Filter Bar -->
      <div class="reflections-filter-bar" data-reveal>
        <button class="filter-btn active">All Notes</button>
        <button class="filter-btn">Hidden in Plain Sight</button>
        <button class="filter-btn">Stories That Built Us</button>
        <button class="filter-btn">Marketing, But Human</button>
        <button class="filter-btn">Field Notes</button>
        <button class="filter-btn">The Whole Lot Thinking</button>
        <button class="filter-btn">Making The Whole Lot</button>
      </div>

      <!-- Empty State & Newsletter Signup -->
      <div class="reflections-empty-state" data-reveal>
        <div class="kicker" style="color: var(--pink-ink);">Editorial Dispatch</div>
        <h3>The first reflections are being written.</h3>
        <p class="muted" style="max-width: 540px; margin: 0 auto 24px;">
          We don’t publish because the internet needs more content. It doesn’t. We publish when an observation has somewhere meaningful to go.
        </p>

        <!-- Newsletter Placeholder Form -->
        <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for your interest! The first dispatch will arrive shortly.');">
          <input type="email" class="newsletter-input" placeholder="Enter your email address" required aria-label="Email address for reflections dispatch">
          <button type="submit" class="btn pink">Join the List</button>
        </form>

        <div style="margin-top: 36px;">
          <a href="/reflections/article-template" class="btn light" style="border-color: var(--line); color: var(--ink);">
            Preview Sample Article Layout →
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
