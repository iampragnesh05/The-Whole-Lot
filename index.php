<?php
$page = 'home';
$pageTitle = 'Strategy · Culture · Research · Growth';
$pageDescription = 'The Whole Lot is an independent strategy, research and growth practice exploring how people, culture and context shape businesses and the world around them.';
$pagePath = '/';
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
  <!-- 1. Home Hero (Asymmetric 4-4-4 Grid with Choreographed Load Animation) -->
  <section class="home-hero" aria-label="Introduction hero">
    <div class="container home-hero-grid">
      <!-- Left Column: Typography -->
      <div class="home-hero-text-col">
        <span class="eyebrow hero-load-text1">THE WHOLE LOT</span>
        <h1 class="home-hero-h1">
          <span class="line-bold hero-load-text1">THE STORIES WE LIVE.</span>
          <span class="line-reg hero-load-text2">THE SYSTEMS WE BUILD.</span>
          <span class="line-bold hero-load-text3">THE THINGS HAPPENING UNDERNEATH.</span>
        </h1>
      </div>

      <!-- Center & Right Columns: Photos in Wrap -->
      <div class="home-hero-photos-wrap">
        <picture class="home-hero-photo-col hero-load-img1">
          <source srcset="/assets/img/home/hero-boardwalk-608.webp" type="image/webp">
          <img class="home-hero-img" src="/assets/img/home/hero-boardwalk-608.jpg" width="608" height="760" alt="Person standing thoughtfully on a coastal boardwalk" loading="eager" fetchpriority="high">
        </picture>

        <picture class="home-hero-photo-col hero-load-img2">
          <source srcset="/assets/img/home/hero-sunflowers-656.webp 656w, /assets/img/home/hero-sunflowers-640.webp 640w" type="image/webp">
          <img class="home-hero-img" src="/assets/img/home/hero-sunflowers-656.jpg" width="656" height="820" alt="Person looking out across a field of vibrant sunflowers" loading="eager" fetchpriority="high">
        </picture>
      </div>

      <!-- Paper Band Span Across Photo Columns -->
      <div class="home-hero-band hero-load-band">
        <p class="lead">The Whole Lot is an independent strategy, research and growth practice exploring how people, culture and context shape businesses and the world around them.</p>
        <p>We work with brands, founders, institutions and emerging entrepreneurs to understand the thing underneath the thing — and decide what to do with it.</p>
        <div class="actions">
          <a class="btn dark" href="#ecosystem">Explore The Whole Lot →</a>
          <a class="btn" href="/contact">Work With Us</a>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. Home Intro (Visual 3-Column Composition: Orange Wall | Stacked Text | Stone Alley) -->
  <section class="home-intro" aria-label="Our core perspective">
    <div class="home-intro-visual-row">
      <!-- Left Photo -->
      <div class="home-intro-col-photo">
        <picture>
          <source srcset="/assets/img/home/intro-orange-wall-720.webp 720w, /assets/img/home/intro-orange-wall-640.webp 640w" type="image/webp">
          <img src="/assets/img/home/intro-orange-wall-720.jpg" width="720" height="900" alt="Warm terracotta wall texture with person in doorway" loading="eager">
        </picture>
      </div>

      <!-- Center Typography Column (White Background) -->
      <div class="home-intro-col-center">
        <div class="home-intro-statement-stack">
          <div class="home-intro-stack-black">
            <span>MOST</span>
            <span>BUSINESSES</span>
            <span>STUDY</span>
            <span>MARKETS.</span>
          </div>
          <div class="home-intro-stack-pink">
            <span>WE STUDY</span>
            <span>PEOPLE.</span>
          </div>
        </div>
      </div>

      <!-- Right Photo -->
      <div class="home-intro-col-photo">
        <picture>
          <source srcset="/assets/img/home/intro-stone-alley-720.webp 720w, /assets/img/home/intro-stone-alley-640.webp 640w" type="image/webp">
          <img src="/assets/img/home/intro-stone-alley-720.jpg" width="720" height="900" alt="Historic stone alleyway with person walking" loading="eager">
        </picture>
      </div>
    </div>

    <!-- Paper Band 2-Column Split Copy (Non-duplicated approved narrative) -->
    <div class="home-intro-band">
      <div class="container grid-2" data-reveal>
        <div>
          <p class="statement" style="margin-bottom: 24px; color: var(--ink);">Because markets are made of them.</p>
          <p>People carrying memories, aspirations, anxieties, habits, histories, identities, contradictions and very strong opinions about things nobody expected them to care about.</p>
        </div>
        <div>
          <p>The Whole Lot began as a marketing and communications practice. Then the questions got bigger. Why do people behave the way they do? Why does something work in one city and fall flat in another? What happens before a trend becomes visible? What gets lost when we study human behaviour only through dashboards?</p>
          <p>Today, The Whole Lot sits somewhere between business strategy, cultural research, marketing, communications, entrepreneurship and human behaviour. We observe. We research. We connect things that may not initially appear connected. And then we make something useful from what we find.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. The Whole Lot Ecosystem (4 Editorial Index Rows) -->
  <section class="section" id="ecosystem" aria-label="Practice Ecosystem">
    <div class="container">
      <span class="eyebrow">THE WHOLE LOT ECOSYSTEM</span>
      <h2 class="display small">ONE PRACTICE. <span class="pink">SEVERAL WAYS OF LOOKING.</span></h2>

      <div class="ecosystem-index" data-reveal>
        <!-- Row 1: Consulting & Services -->
        <a class="ecosystem-row" href="/services">
          <div class="ecosystem-name">Services</div>
          <div class="ecosystem-content">
            <h3>Turning understanding into action.</h3>
            <p>Brand strategy, marketing, communications, PR, digital experiences, research and growth consulting.</p>
          </div>
          <div class="ecosystem-arrow">↗</div>
        </a>

        <!-- Row 2: Ground Signal -->
        <a class="ecosystem-row" href="/ground-signal">
          <div class="ecosystem-name">Ground Signal</div>
          <div class="ecosystem-content">
            <h3>Read the ground before you read the signal.</h3>
            <p>An evolving framework for understanding the conditions underneath behaviour.</p>
          </div>
          <div class="ecosystem-arrow">↗</div>
        </a>

        <!-- Row 3: The Founders Lab -->
        <a class="ecosystem-row" href="/founders-lab">
          <div class="ecosystem-name">The Founders Lab</div>
          <div class="ecosystem-content">
            <h3>Before you build the business, investigate the idea.</h3>
            <p>Research, mentorship and practical support for young entrepreneurs.</p>
          </div>
          <div class="ecosystem-arrow">↗</div>
        </a>

        <!-- Row 4: Reflections -->
        <a class="ecosystem-row" href="/reflections">
          <div class="ecosystem-name">Reflections</div>
          <div class="ecosystem-content">
            <h3>Things we notice when we’re paying attention.</h3>
            <p>Not trend reports. Not thought leadership for the sake of LinkedIn. Mostly curiosity with somewhere to go.</p>
          </div>
          <div class="ecosystem-arrow">↗</div>
        </a>
      </div>
    </div>
  </section>

  <!-- 4. What We're Curious About (Dark Ink Section with Animated Hand-Drawn Underline) -->
  <section class="section curious-section" aria-label="Core inquiries and curiosity">
    <div class="container">
      <span class="eyebrow on-dark">WHAT WE’RE CURIOUS ABOUT</span>
      <div class="statement" style="max-width: 980px; margin-bottom: 24px;">
        We live in a world with more information than we’ve ever had. And somehow, 
        <span class="curious-statement-wrap">
          understanding hasn’t necessarily kept up.
          <svg class="curious-svg" viewBox="0 0 300 12" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path class="curious-path" pathLength="1" d="M2 8 C 60 3, 120 10, 180 5 S 270 4, 298 7" stroke="#FF2D7A" stroke-width="3.5" stroke-linecap="round"/>
          </svg>
        </span>
      </div>

      <p class="curious-run">More data. More dashboards. More tracking. More sentiment analysis. More demographic breakdowns. More certainty. Less understanding.</p>

      <!-- Stacked Questions Crossing Viewport Center -->
      <div class="curious-questions" data-reveal>
        <div class="curious-q-item">
          Why do people trust?
          <span class="curious-q-sub">And why do they resist, abandon, repeat, inherit or reinvent?</span>
        </div>
        <div class="curious-q-item">
          What happens before behaviour becomes measurable?
          <span class="curious-q-sub">Before the click, the trend, the purchase, the move, the shift.</span>
        </div>
        <div class="curious-q-item">
          Why do some problems become businesses?
          <span class="curious-q-sub">And why do others remain invisible until somebody notices differently?</span>
        </div>
        <div class="curious-q-item">
          Why does an idea resonate in one culture and fail completely in another?
        </div>
        <div class="curious-q-item">
          What do people actually mean when they say they want something simpler, healthier, more authentic or more meaningful?
        </div>
        <div class="curious-q-item">
          What is the invisible tax of pretending human beings are predictable?
        </div>
        <div class="curious-q-item">
          What happens when a brand listens to what people do instead of what they say in focus groups?
        </div>
      </div>

      <div style="margin-top: 48px; font-family: var(--font-body); font-weight: 700; color: #FFFFFF;" data-reveal>
        Those are the questions we like.
      </div>
    </div>
  </section>

  <!-- 5. How We Work: Observe -> Understand -> Apply -->
  <section class="section" aria-label="Methodology">
    <div class="container">
      <span class="eyebrow">HOW WE WORK</span>
      <h2 class="display small">OBSERVE → UNDERSTAND → <span class="pink">APPLY</span></h2>

      <div class="method-grid" data-reveal>
        <div class="method-line" aria-hidden="true"></div>

        <!-- Step 1 -->
        <div class="method-col">
          <div class="method-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
          </div>
          <h3>01 · OBSERVE</h3>
          <p>Look at what people actually do. Listen to conversations. Study environments. Notice workarounds. Follow contradictions. Ask irritating amounts of why. Not merely what we expect them to do.</p>
        </div>

        <!-- Step 2 -->
        <div class="method-col">
          <div class="method-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
              <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
              <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
          </div>
          <h3>02 · UNDERSTAND</h3>
          <p>Place behaviour inside context: culture, history, economics, identity, technology, place, emotion and aspiration. Sometimes the interesting answer sits between several things.</p>
        </div>

        <!-- Step 3 -->
        <div class="method-col">
          <div class="method-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon>
              <line x1="3" y1="22" x2="21" y2="22"></line>
            </svg>
          </div>
          <h3>03 · APPLY</h3>
          <p>Translate understanding into business strategy, brand foundations, positioning, marketing systems, communication, digital experiences or new ventures. Make something that works in the real world.</p>
        </div>
      </div>

      <!-- Rotating Stamp Accent -->
      <div class="stamp-wrap" data-reveal>
        <div class="stamp-circle" aria-label="Observe Understand Apply stamp">
          <div>OBSERVE<br>• UNDERSTAND •<br>APPLY</div>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. Manifesto Live Banner (Full-Bleed with Paper Card & Yellow Tape) -->
  <section class="full-banner full-banner-manifesto" aria-label="Our Manifesto">
    <picture>
      <source srcset="/assets/img/home/manifesto-bg-1920.webp 1920w, /assets/img/home/manifesto-bg-1280.webp 1280w, /assets/img/home/manifesto-bg-768.webp 768w" type="image/webp">
      <img class="banner-bg-img manifesto-img-mobile" src="/assets/img/home/manifesto-bg-1920.jpg" width="1920" height="1080" alt="Atmospheric background reflecting cultural depth" loading="lazy" decoding="async" data-parallax="20">
    </picture>
    <div class="banner-gradient-bottom"></div>

    <div class="container" style="position: relative; height: 100%;">
      <div class="manifesto-card" data-reveal>
        <div class="manifesto-tape" aria-hidden="true"></div>
        <div class="eyebrow">A LITTLE MANIFESTO</div>
        <div class="manifesto-card-title">We don’t think people are data points with Wi-Fi.</div>
        <p>They are messy, thoughtful, contradictory, rooted, aspiring human beings trying to navigate their lives.</p>
        <p>If you want to build something that lasts, start by taking them seriously.</p>
      </div>
    </div>
  </section>

  <!-- 7. Selected Work & Experience -->
  <section class="section" aria-label="Selected Experience">
    <div class="container">
      <div class="grid-2" style="align-items: end; margin-bottom: 40px;">
        <div>
          <span class="eyebrow">SELECTED WORK</span>
          <h2 class="display small">EVERY PROJECT BEGINS <span class="pink">WITH A QUESTION.</span></h2>
        </div>
        <div>
          <p class="lead" style="margin-bottom: 0;">Some projects begin with: “We need a marketing strategy.” And end somewhere much more interesting.</p>
        </div>
      </div>

      <!-- Single line of industries separated by slashes -->
      <div class="kicker" style="font-size: 0.9375rem; color: var(--ink); margin: 32px 0 48px; line-height: 1.8;" data-reveal>
        Wellness & Nutrigenomics / Industrial & Real Estate / Hospitality & Culture / Fintech & BFSI / Professional Bodies / Social Impact / Education / Founder-led Brands
      </div>

      <div class="actions" data-reveal>
        <a class="btn dark" href="/work">Explore Selected Work →</a>
        <a class="btn" href="/contact">Discuss a Project</a>
      </div>
    </div>
  </section>

  <!-- 8. Closing Call to Action -->
  <section class="section paper" aria-label="Closing statement and contact call to action">
    <div class="container grid-2" style="align-items: center;">
      <div>
        <span class="eyebrow">START A CONVERSATION</span>
        <h2 class="display small">LOOK CLOSER.<br><span class="pink">THERE IS ALWAYS MORE.</span></h2>
        <p class="lead" style="margin-top: 20px;">Some appear in search data. Some appear in a conversation.</p>
        <p class="muted">Tell us what isn’t working, or what you’re trying to build. We’ll start there.</p>
      </div>
      <div style="display: flex; flex-direction: column; gap: 20px;">
        <div class="actions" style="margin-top: 0;">
          <a class="btn pink" href="/contact">Start a Conversation →</a>
          <a class="btn" href="/services">View All Services</a>
        </div>
        <p style="font-family: var(--font-body); font-weight: 700; font-size: 0.8125rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--ink);">
          THE WHOLE LOT — Look closer. There is always more.
        </p>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
