<?php
$page = 'services';
$pageTitle = 'Services';
$pageDescription = 'Brand and business strategy, integrated marketing, communications, digital experiences, research and founder support from The Whole Lot.';
$pagePath = '/services';
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
  <!-- 1. Full-Bleed Live Hero Banner -->
  <section class="full-banner full-banner-services" aria-label="Services Hero Banner">
    <picture>
      <source srcset="/assets/img/services/services-hero-bg-1920.webp 1920w, /assets/img/services/services-hero-bg-1280.webp 1280w, /assets/img/services/services-hero-bg-768.webp 768w" type="image/webp">
      <img class="banner-bg-img banner-services-img" src="/assets/img/services/services-hero-bg-1920.jpg" width="1920" height="1080" alt="Architectural space reflecting structure and purpose" loading="eager" fetchpriority="high">
    </picture>
    <div class="banner-gradient-bottom"></div>

    <div class="container" style="position: relative; height: 100%;">
      <div class="services-hero-panel" data-reveal>
        <span class="eyebrow on-dark">SERVICES</span>
        <h1 class="display" style="font-size: clamp(2.6rem, 5.5vw, 5.2rem);">
          UNDERSTANDING IS USEFUL.<br>
          <span class="pink">EVENTUALLY, YOU HAVE TO DO SOMETHING WITH IT.</span>
        </h1>
      </div>
    </div>
  </section>

  <!-- Intro Text Below Hero -->
  <section class="section tight" aria-label="Services overview">
    <div class="container">
      <p class="lead" style="max-width: 900px; font-size: clamp(1.25rem, 2.2vw, 1.65rem);">
        The Whole Lot works with founders, organisations and teams on business, brand, marketing, communications and research problems. Sometimes we’re brought in for one question. Sometimes we end up helping build the whole thing.
      </p>
    </div>
  </section>

  <!-- 2. How We Think About Services (With SVG Strike-Through) -->
  <section class="section paper" aria-label="Our philosophy on services">
    <div class="container grid-2" data-reveal>
      <div>
        <span class="eyebrow">HOW WE THINK ABOUT SERVICES</span>
        <h2 class="display small">
          WE DON’T BEGIN WITH: <br>
          <span class="strike-through pink">
            WHICH CHANNEL SHOULD WE USE?
            <svg class="strike-svg" viewBox="0 0 400 12" fill="none" preserveAspectRatio="none">
              <path class="strike-path" pathLength="1" d="M2 6 C 100 2, 250 10, 398 5" stroke="#111111" stroke-width="3" stroke-linecap="round"/>
            </svg>
          </span>
        </h2>
      </div>
      <div>
        <p class="statement" style="font-size: clamp(1.35rem, 2.2vw, 1.8rem); margin-bottom: 20px;">
          We usually begin with: What are we actually trying to change?
        </p>
        <div style="display: flex; flex-direction: column; gap: 10px; margin: 24px 0; font-size: 1.0625rem;">
          <div style="padding: 8px 0; border-bottom: 1px solid var(--line);">• Who are we trying to understand?</div>
          <div style="padding: 8px 0; border-bottom: 1px solid var(--line);">• What is happening around them?</div>
          <div style="padding: 8px 0; border-bottom: 1px solid var(--line);">• What assumptions are we making?</div>
          <div style="padding: 8px 0; border-bottom: 1px solid var(--line);">• Why should they care?</div>
          <div style="padding: 8px 0; border-bottom: 1px solid var(--line);">• What already exists?</div>
          <div style="padding: 8px 0; border-bottom: 1px solid var(--line);">• What is getting in the way?</div>
        </div>
        <p class="muted">Only then do websites, campaigns, PR, SEO, content and channels become useful.</p>
      </div>
    </div>
  </section>

  <!-- Mobile Sticky Horizontal Pill Bar -->
  <nav class="services-pill-bar" aria-label="Services navigation mobile">
    <a href="#strategy">01 · Strategy</a>
    <a href="#marketing">02 · Marketing</a>
    <a href="#communications">03 · Comms & PR</a>
    <a href="#digital">04 · Digital</a>
    <a href="#research">05 · Research</a>
    <a href="#founders">06 · Founder Support</a>
  </nav>

  <!-- 3. The Six Core Services with Desktop Sticky Index -->
  <section class="section" aria-label="Practice areas detail">
    <div class="container services-layout">
      <!-- Desktop Sticky Left Index -->
      <aside class="services-nav-sticky" aria-label="Services navigation desktop">
        <div class="kicker">Practices</div>
        <a href="#strategy">01 · Brand & Strategy</a>
        <a href="#marketing">02 · Marketing & Growth</a>
        <a href="#communications">03 · Communications & PR</a>
        <a href="#digital">04 · Brand & Digital</a>
        <a href="#research">05 · Cultural Research</a>
        <a href="#founders">06 · Founder Support</a>
      </aside>

      <!-- Services Content List -->
      <div class="services-content-wrap">
        <!-- 01 Brand & Business Strategy -->
        <article class="service-item-block" id="strategy" data-reveal>
          <div class="service-item-header">
            <span class="service-item-num">01</span>
            <h2>BRAND & BUSINESS STRATEGY</h2>
          </div>
          <div class="service-item-content">
            <div>
              <p class="statement" style="font-size: 1.35rem; margin-bottom: 16px;">Figure out what you’re building and why somebody should care.</p>
              <p>For companies creating something new, repositioning something old or trying to understand why growth has become harder than expected.</p>
              <div class="actions" style="margin-top: 24px;">
                <a class="btn dark" href="/contact?type=Start%20a%20Project">Talk to Us About Strategy →</a>
              </div>
            </div>
            <div>
              <div class="kicker" style="color: var(--pink-ink);">Good for:</div>
              <div class="service-scope-list">
                <div class="service-scope-item">Brand positioning</div>
                <div class="service-scope-item">Brand architecture</div>
                <div class="service-scope-item">Audience research</div>
                <div class="service-scope-item">Market analysis</div>
                <div class="service-scope-item">Business proposition</div>
                <div class="service-scope-item">Messaging systems</div>
                <div class="service-scope-item">Naming</div>
                <div class="service-scope-item">Go-to-market</div>
                <div class="service-scope-item">Market entry</div>
                <div class="service-scope-item">Customer journeys</div>
                <div class="service-scope-item">Growth strategy</div>
              </div>
            </div>
          </div>
        </article>

        <!-- 02 Marketing & Growth -->
        <article class="service-item-block" id="marketing" data-reveal>
          <div class="service-item-header">
            <span class="service-item-num">02</span>
            <h2>MARKETING & GROWTH</h2>
          </div>
          <div class="service-item-content">
            <div>
              <p class="statement" style="font-size: 1.35rem; margin-bottom: 16px;">Marketing works better when it starts before the campaign.</p>
              <p>We build integrated marketing systems based on audience behaviour, business priorities and the context in which a brand operates.</p>
              <p class="muted" style="font-size: 0.9375rem; margin-top: 16px;">We don’t need to personally press every button in your ad account to understand whether the machine makes sense. Where specialist execution is needed, we work with your existing teams or coordinate the right collaborators.</p>
            </div>
            <div>
              <div class="kicker" style="color: var(--pink-ink);">Capabilities:</div>
              <div class="service-scope-list">
                <div class="service-scope-item">Integrated marketing strategy</div>
                <div class="service-scope-item">Campaign strategy</div>
                <div class="service-scope-item">Audience segmentation</div>
                <div class="service-scope-item">Performance strategy</div>
                <div class="service-scope-item">Ad hooks & direction</div>
                <div class="service-scope-item">SEO & Discovery</div>
                <div class="service-scope-item">AEO / Emerging search</div>
                <div class="service-scope-item">Content ecosystems</div>
                <div class="service-scope-item">Email journeys</div>
                <div class="service-scope-item">Influencer strategy</div>
                <div class="service-scope-item">Partnerships</div>
                <div class="service-scope-item">Measurement frameworks</div>
              </div>
            </div>
          </div>
        </article>

        <!-- 03 Communications & PR -->
        <article class="service-item-block" id="communications" data-reveal>
          <div class="service-item-header">
            <span class="service-item-num">03</span>
            <h2>COMMUNICATIONS & PR</h2>
          </div>
          <div class="service-item-content">
            <div>
              <p class="statement" style="font-size: 1.35rem; margin-bottom: 16px;">Having something worth saying helps.</p>
              <p>We help organisations determine what their story actually is before asking the world to pay attention to it.</p>
            </div>
            <div>
              <div class="kicker" style="color: var(--pink-ink);">Capabilities:</div>
              <div class="service-scope-list">
                <div class="service-scope-item">Communications strategy</div>
                <div class="service-scope-item">PR strategy</div>
                <div class="service-scope-item">Media narratives</div>
                <div class="service-scope-item">Founder positioning</div>
                <div class="service-scope-item">Thought leadership</div>
                <div class="service-scope-item">Corporate storytelling</div>
                <div class="service-scope-item">Impact stories</div>
                <div class="service-scope-item">Case studies</div>
                <div class="service-scope-item">Employer branding</div>
                <div class="service-scope-item">Stakeholder messaging</div>
              </div>
            </div>
          </div>
        </article>

        <!-- 04 Brand & Digital Experiences -->
        <article class="service-item-block" id="digital" data-reveal>
          <div class="service-item-header">
            <span class="service-item-num">04</span>
            <h2>BRAND & DIGITAL EXPERIENCES</h2>
          </div>
          <div class="service-item-content">
            <div>
              <p class="statement" style="font-size: 1.35rem; margin-bottom: 16px;">Eventually, the strategy has to become something people can see.</p>
              <p>We work with creative and technical collaborators to translate strategy into coherent brand and digital experiences.</p>
            </div>
            <div>
              <div class="kicker" style="color: var(--pink-ink);">Capabilities:</div>
              <div class="service-scope-list">
                <div class="service-scope-item">Visual identity direction</div>
                <div class="service-scope-item">Website strategy</div>
                <div class="service-scope-item">Website content</div>
                <div class="service-scope-item">Design & dev oversight</div>
                <div class="service-scope-item">UI/UX direction</div>
                <div class="service-scope-item">Landing pages</div>
                <div class="service-scope-item">E-commerce experiences</div>
                <div class="service-scope-item">Creative direction</div>
                <div class="service-scope-item">Photography & film direction</div>
                <div class="service-scope-item">Brand guidelines</div>
              </div>
            </div>
          </div>
        </article>

        <!-- 05 Research & Cultural Intelligence -->
        <article class="service-item-block" id="research" data-reveal>
          <div class="service-item-header">
            <span class="service-item-num">05</span>
            <h2>RESEARCH & CULTURAL INTELLIGENCE</h2>
          </div>
          <div class="service-item-content">
            <div>
              <p class="statement" style="font-size: 1.35rem; margin-bottom: 16px;">Sometimes the problem isn’t communication. You simply don’t understand the situation well enough yet.</p>
              <p>Ground Signal is our evolving framework for examining historical signal, lived experience and emerging public signals together.</p>
              <div class="actions" style="margin-top: 24px;">
                <a class="btn dark" href="/ground-signal">Explore Ground Signal →</a>
              </div>
            </div>
            <div>
              <div class="kicker" style="color: var(--pink-ink);">Areas of inquiry:</div>
              <div class="service-scope-list">
                <div class="service-scope-item">Audience behaviour</div>
                <div class="service-scope-item">Cultural context</div>
                <div class="service-scope-item">Category shifts</div>
                <div class="service-scope-item">Emerging conversations</div>
                <div class="service-scope-item">Market-entry conditions</div>
                <div class="service-scope-item">Founder/customer interviews</div>
                <div class="service-scope-item">Perceptual research</div>
                <div class="service-scope-item">Community behaviour</div>
                <div class="service-scope-item">Historical context</div>
                <div class="service-scope-item">Public signals</div>
              </div>
            </div>
          </div>
        </article>

        <!-- 06 Founder & Early-Stage Support -->
        <article class="service-item-block" id="founders" data-reveal>
          <div class="service-item-header">
            <span class="service-item-num">06</span>
            <h2>FOUNDER & EARLY-STAGE SUPPORT</h2>
          </div>
          <div class="service-item-content">
            <div>
              <p class="statement" style="font-size: 1.35rem; margin-bottom: 16px;">You don’t always need a 60-page strategy. Sometimes you need somebody intelligent in the room asking better questions.</p>
              <p class="muted" style="margin-top: 16px;">For student and emerging entrepreneurs, see <a href="/founders-lab" class="pink" style="font-weight: 700; text-decoration: underline;">The Founders Lab</a>.</p>
            </div>
            <div>
              <div class="kicker" style="color: var(--pink-ink);">Support areas:</div>
              <div class="service-scope-list">
                <div class="service-scope-item">Idea validation</div>
                <div class="service-scope-item">Problem definition</div>
                <div class="service-scope-item">Audience understanding</div>
                <div class="service-scope-item">Business positioning</div>
                <div class="service-scope-item">Founder narratives</div>
                <div class="service-scope-item">Go-to-market thinking</div>
                <div class="service-scope-item">Early research</div>
                <div class="service-scope-item">Brand foundations</div>
                <div class="service-scope-item">Marketing priorities</div>
                <div class="service-scope-item">Growth roadmaps</div>
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- 4. How Engagements Work -->
  <section class="section paper" aria-label="Engagement models">
    <div class="container">
      <span class="eyebrow">HOW ENGAGEMENTS WORK</span>
      <h2 class="display small">NOT EVERY PROBLEM NEEDS AN <span class="pink">ENORMOUS RETAINER.</span></h2>

      <div class="grid-4" style="margin-top: 40px;" data-reveal>
        <div class="card">
          <div class="kicker">01</div>
          <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin: 8px 0 12px;">Strategy Sprints</h3>
          <p class="muted">For one defined question or pivotal decision requiring fast, deep immersion.</p>
        </div>
        <div class="card">
          <div class="kicker">02</div>
          <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin: 8px 0 12px;">Project Work</h3>
          <p class="muted">For comprehensive brand, research, communication or launch initiatives.</p>
        </div>
        <div class="card">
          <div class="kicker">03</div>
          <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin: 8px 0 12px;">Fractional Advisory</h3>
          <p class="muted">Senior strategic thinking and leadership without building an internal team yet.</p>
        </div>
        <div class="card">
          <div class="kicker">04</div>
          <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin: 8px 0 12px;">Integrated Systems</h3>
          <p class="muted">Multiple disciplines coordinated around a larger transformational objective.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. Closing Callout (Dark) -->
  <section class="section dark" aria-label="Consultation callout">
    <div class="container" data-reveal>
      <p class="statement" style="max-width: 900px;">
        You don’t need to know which service you need. <span class="pink">That’s partly why we’re here.</span>
      </p>
      <p class="lead" style="margin: 20px 0 32px;">
        Tell us what isn’t working. Or what you’re trying to build. We’ll start there.
      </p>
      <div class="actions">
        <a class="btn light" href="/contact">Start a Conversation →</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
