<?php
$page = 'about';
$pageTitle = 'About';
$pageDescription = 'About The Whole Lot, an independent strategy, research and growth practice founded by Avani Jain.';
$pagePath = '/about';
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
  <section class="page-hero" aria-label="About The Whole Lot">
    <div class="container">
      <span class="eyebrow">THE WHOLE LOT</span>
      <h1 class="display">
        THE NAME WAS <span class="pink">NOT ACCIDENTAL.</span>
      </h1>
      <p class="intro">
        We’ve never been particularly interested in looking at one piece of a problem and pretending it explains the whole thing.
      </p>
    </div>
  </section>

  <!-- 2. Why We Exist (With Animated Concept Chain) -->
  <section class="section" aria-label="Why we exist">
    <div class="container grid-2" data-reveal>
      <div>
        <span class="eyebrow">WHY WE EXIST</span>
        <h2 class="display small">
          MARKETING KEPT LEADING US <span class="pink">SOMEWHERE ELSE.</span>
        </h2>
      </div>

      <div>
        <!-- Concept Chain Lighting Up Step-by-Step -->
        <div class="about-chain">
          <span class="about-chain-node">Customer decision</span>
          <span class="about-chain-arrow">→</span>
          <span class="about-chain-node">Culture</span>
          <span class="about-chain-arrow">→</span>
          <span class="about-chain-node">History</span>
          <span class="about-chain-arrow">→</span>
          <span class="about-chain-node">Migration</span>
          <span class="about-chain-arrow">→</span>
          <span class="about-chain-node">Identity</span>
          <span class="about-chain-arrow">→</span>
          <span class="about-chain-node">Aspiration</span>
          <span class="about-chain-arrow">→</span>
          <span class="about-chain-node is-final">Why somebody chose one product over another</span>
        </div>

        <p>This kept happening. Eventually it became difficult to pretend these were separate subjects.</p>
        <p>Sometimes that’s a marketing strategy. Sometimes that’s a brand foundation. Sometimes that’s a research study or an idea validation workshop. All respectable outcomes.</p>
        <p class="lead" style="font-size: 1.25rem;">
          The Whole Lot exists to understand the larger systems surrounding human decisions and turn that understanding into something useful.
        </p>
      </div>
    </div>
  </section>

  <!-- 3. Our Philosophy (5 Principles) -->
  <section class="section paper" aria-label="Our core philosophy">
    <div class="container">
      <span class="eyebrow">OUR PHILOSOPHY</span>
      <h2 class="display small">FIVE CORE <span class="pink">BELIEFS.</span></h2>

      <div class="philosophy-grid" data-reveal>
        <div class="philosophy-card">
          <div class="philosophy-card-num">01</div>
          <h3>Meaning before messaging.</h3>
          <p class="muted">Before asking what to say, understand what something actually means to the person hearing it.</p>
        </div>

        <div class="philosophy-card">
          <div class="philosophy-card-num">02</div>
          <h3>People before platforms.</h3>
          <p class="muted">Platforms change constantly. Human needs, identities, fears, aspirations and contradictions are rather more persistent.</p>
        </div>

        <div class="philosophy-card">
          <div class="philosophy-card-num">03</div>
          <h3>Culture shapes behaviour.</h3>
          <p class="muted">People do not arrive at a purchase, belief or decision without cultural, social and historical context.</p>
        </div>

        <div class="philosophy-card">
          <div class="philosophy-card-num">04</div>
          <h3>Curiosity over certainty.</h3>
          <p class="muted">We would rather ask a better question than manufacture a confident, superficial answer.</p>
        </div>
      </div>

      <!-- 5th Principle Full Width -->
      <div style="margin-top: 32px; border-top: 2px solid var(--ink); padding-top: 24px;" data-reveal>
        <div class="grid-2">
          <div>
            <div class="philosophy-card-num" style="font-size: 3rem;">05</div>
            <h3 style="font-family: var(--font-body); font-weight: 700; font-size: 1.35rem;">The whole is more than its parts.</h3>
          </div>
          <div>
            <p class="lead" style="font-size: 1.15rem; margin-bottom: 8px;">
              A problem examined in isolation usually yields an isolated, fragile solution.
            </p>
            <p class="muted" style="font-size: 0.9375rem;">
              Certainty photographs beautifully in presentations. Reality tends to be less cooperative.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Meet the Founder (Avani Jain) -->
  <section class="section" aria-label="Founder Bio">
    <div class="container founder-layout">
      <!-- Sticky 4:5 Portrait Placeholder -->
      <aside class="founder-portrait-sticky" data-reveal>
        <div class="founder-portrait-box">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <span style="color: var(--ink);">Avani Jain</span>
          <span class="muted" style="font-size: 0.75rem; margin-top: 4px;">Founder & Lead Consultant</span>
        </div>
      </aside>

      <!-- Founder Narrative Content -->
      <div data-reveal>
        <span class="eyebrow">MEET THE FOUNDER</span>
        <h2 class="display small">AVANI JAIN</h2>
        <div class="kicker" style="color: var(--pink-ink); margin-bottom: 24px;">Founder & Lead Consultant</div>

        <p class="lead" style="font-size: 1.25rem;">
          Avani has spent more than a decade working across brand strategy, marketing, communications, research, culture and business growth.
        </p>

        <p>
          Her career has moved through advertising, D2C, finance, professional bodies, social-impact organisations, real estate, wellness, cultural institutions, oral history and entrepreneurship. This would make for a slightly confusing dropdown menu on LinkedIn. It has been considerably more useful in real life.
        </p>

        <p>
          Moving across different industries created a recurring habit: looking for the thing underneath the thing. That curiosity eventually became The Whole Lot and later informed the development of Ground Signal, an evolving framework for understanding the conditions shaping human behaviour.
        </p>

        <p>
          Her work combines business strategy with interests in oral history, culture, behavioural sciences and systems thinking. She also teaches and facilitates workshops on entrepreneurship, idea validation and brand building.
        </p>

        <!-- Question List -->
        <div style="margin: 28px 0; padding: 20px; border-left: 2px solid var(--pink); background: var(--paper);">
          <div class="kicker" style="color: var(--ink);">Recurring inquiries:</div>
          <div style="display: flex; flex-direction: column; gap: 6px; font-weight: 700; font-size: 1rem;">
            <div>• Why do people trust?</div>
            <div>• Why do they resist?</div>
            <div>• What gets lost in translation?</div>
            <div>• What happens before a trend becomes visible?</div>
          </div>
        </div>

        <p class="muted">
          Mostly, she asks a lot of questions. Occasionally they are useful.
        </p>

        <p style="font-size: 0.9375rem; color: var(--muted); font-style: italic; margin-top: 16px;">
          And probably a few things we haven’t thought of yet. That is, admittedly, rather consistent with the name.
        </p>

        <div class="actions" style="margin-top: 32px;">
          <a class="btn dark" href="/contact">Connect / Work With Avani →</a>
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
