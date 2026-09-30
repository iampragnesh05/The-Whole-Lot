<?php
$page = 'work';
$pageTitle = 'Work';
$pageDescription = 'Selected work from The Whole Lot across brand strategy, growth, communications, research, digital experiences and cultural work.';
$pagePath = '/work';
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
  <section class="page-hero" aria-label="Work overview hero">
    <div class="container">
      <span class="eyebrow">THE WORK</span>
      <h1 class="display">
        EVERY PROJECT BEGINS <span class="pink">WITH A QUESTION.</span>
      </h1>
      <p class="intro">
        Sometimes the client already knows the question. Sometimes finding it is half the work.
      </p>
    </div>
  </section>

  <!-- 2. Selected Work Grid (4:3 Images with Hover Zoom) -->
  <section class="section" aria-label="Selected Case Studies">
    <div class="container">
      <span class="eyebrow">SELECTED ENGAGEMENTS</span>
      <h2 class="display small">
        UNDERSTAND FIRST. <span class="pink">THEN BUILD.</span>
      </h2>

      <div class="work-grid" data-reveal>
        <!-- Tile 1: Wellness & Nutrigenomics -->
        <article class="work-tile">
          <div class="work-tile-img-box">
            <picture>
              <source srcset="/assets/img/home/hero-sunflowers-656.webp" type="image/webp">
              <img src="/assets/img/home/hero-sunflowers-656.jpg" width="656" height="492" alt="Nutrigenomics case study visual" loading="lazy" decoding="async">
            </picture>
          </div>
          <div class="work-tile-body">
            <div class="kicker" style="color: var(--pink-ink);">Wellness & Nutrigenomics</div>
            <h3>FROM SCIENCE TO USEFUL HUMAN LANGUAGE.</h3>
            <p class="muted">Strategy, positioning, content, SEO, conversion architecture and founder communication for complex health diagnostics.</p>
          </div>
        </article>

        <!-- Tile 2: Industrial & Real Estate -->
        <article class="work-tile">
          <div class="work-tile-img-box">
            <picture>
              <source srcset="/assets/img/home/intro-stone-alley-720.webp" type="image/webp">
              <img src="/assets/img/home/intro-stone-alley-720.jpg" width="720" height="540" alt="Industrial and real estate case study visual" loading="lazy" decoding="async">
            </picture>
          </div>
          <div class="work-tile-body">
            <div class="kicker" style="color: var(--pink-ink);">Industrial & Real Estate</div>
            <h3>TURNING INFRASTRUCTURE INTO A PROPOSITION PEOPLE UNDERSTAND.</h3>
            <p class="muted">Brand strategy, launch narrative, sales collateral and place-based positioning for large-scale development.</p>
          </div>
        </article>

        <!-- Tile 3: Hospitality & Culture -->
        <article class="work-tile">
          <div class="work-tile-img-box">
            <picture>
              <source srcset="/assets/img/home/intro-orange-wall-720.webp" type="image/webp">
              <img src="/assets/img/home/intro-orange-wall-720.jpg" width="720" height="540" alt="Hospitality case study visual" loading="lazy" decoding="async">
            </picture>
          </div>
          <div class="work-tile-body">
            <div class="kicker" style="color: var(--pink-ink);">Hospitality & Culture</div>
            <h3>BUILDING A BRAND THAT BEHAVES LIKE ITS PHILOSOPHY.</h3>
            <p class="muted">Brand system, experience architecture, tone of voice, editorial design and long-term content strategy.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- 3. Our Case Study Format (6 Distinct Analytical Steps) -->
  <section class="section paper" aria-label="Case Study Methodology">
    <div class="container">
      <span class="eyebrow">OUR CASE STUDY FORMAT</span>
      <h2 class="display small">
        NOT JUST <span class="pink">PRETTY PROJECT TILES.</span>
      </h2>
      <p class="lead" style="margin-top: 12px;">
        Most agencies present themselves as if every decision was obviously brilliant from the beginning. We prefer honesty.
      </p>

      <div class="case-template-grid" data-reveal>
        <div class="case-step-item">
          <span class="case-step-tag">01 · QUESTION</span>
          <p style="font-weight: 700; font-size: 0.9375rem; margin-bottom: 4px;">What were we trying to understand?</p>
          <p class="muted" style="font-size: 0.8125rem;">The initial inquiry or friction.</p>
        </div>

        <div class="case-step-item">
          <span class="case-step-tag">02 · CONTEXT</span>
          <p style="font-weight: 700; font-size: 0.9375rem; margin-bottom: 4px;">What was happening?</p>
          <p class="muted" style="font-size: 0.8125rem;">The cultural, market and human environment.</p>
        </div>

        <div class="case-step-item">
          <span class="case-step-tag">03 · NOTICED</span>
          <p style="font-weight: 700; font-size: 0.9375rem; margin-bottom: 4px;">What did we notice?</p>
          <p class="muted" style="font-size: 0.8125rem;">The unexpected thing underneath the thing.</p>
        </div>

        <div class="case-step-item">
          <span class="case-step-tag">04 · ACTION</span>
          <p style="font-weight: 700; font-size: 0.9375rem; margin-bottom: 4px;">What did we do?</p>
          <p class="muted" style="font-size: 0.8125rem;">Strategy translated into tangible execution.</p>
        </div>

        <div class="case-step-item">
          <span class="case-step-tag">05 · CHANGED</span>
          <p style="font-weight: 700; font-size: 0.9375rem; margin-bottom: 4px;">What changed?</p>
          <p class="muted" style="font-size: 0.8125rem;">The measurable business or human outcome.</p>
        </div>

        <div class="case-step-item">
          <span class="case-step-tag">06 · LEARNED</span>
          <p style="font-weight: 700; font-size: 0.9375rem; margin-bottom: 4px;">What did we learn?</p>
          <p class="muted" style="font-size: 0.8125rem;">The enduring principle for next time.</p>
        </div>
      </div>

      <div class="actions" style="margin-top: 48px;" data-reveal>
        <a class="btn dark" href="/contact?type=Start%20a%20Project">Discuss a Project →</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
