<?php
$page = 'founders-lab';
$pageTitle = 'The Founders Lab — Idea Validation & Research';
$pageDescription = 'The Founders Lab helps students and emerging entrepreneurs investigate business ideas before spending months, money and energy building them.';
$pagePath = '/founders-lab';
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
  <section class="page-hero" aria-label="The Founders Lab Hero">
    <div class="container">
      <span class="eyebrow">THE FOUNDERS LAB</span>
      <h1 class="display">
        INVESTIGATE THE IDEA <br>
        <span class="pink">BEFORE IT GETS EXPENSIVE.</span>
      </h1>
      <p class="intro">
        A developing entrepreneurship and research initiative helping young founders investigate an idea before spending months, money and emotional stability building it.
      </p>
    </div>
  </section>

  <!-- 2. The Problem with Staggered Words & Strike Animation -->
  <section class="section" aria-label="The startup bias problem">
    <div class="container grid-2" data-reveal>
      <div>
        <span class="eyebrow">THE PROBLEM</span>
        <h2 class="display small" style="margin-bottom: 20px;">
          THE CONVENTIONAL PATHWAY:
        </h2>

        <!-- Problem Strip (Start. Build. Launch. Pitch. Raise. Scale.) -->
        <div class="founders-problem-strip">
          <span class="founders-problem-word">START.</span>
          <span class="founders-problem-word">BUILD.</span>
          <span class="founders-problem-word">LAUNCH.</span>
          <span class="founders-problem-word">PITCH.</span>
          <span class="founders-problem-word">RAISE.</span>
          <span class="founders-problem-word">SCALE.</span>

          <!-- Animated Hand-drawn Pink Strike-Through -->
          <div class="founders-strike-wrap">
            <svg viewBox="0 0 500 12" fill="none" style="width: 100%; height: 100%;" preserveAspectRatio="none">
              <path class="strike-path" pathLength="1" d="M2 6 C 120 2, 320 10, 498 5" stroke="#FF2D7A" stroke-width="4" stroke-linecap="round"/>
            </svg>
          </div>
        </div>
      </div>

      <div>
        <p class="lead" style="font-size: 1.25rem;">
          Very few young entrepreneurs are taught how to look carefully at the problem before falling in love with the solution.
        </p>
        <p>
          And once you’ve named the company, bought the domain and shown the logo to your mother, objectivity becomes considerably harder.
        </p>
        <p class="muted">
          The Founders Lab exists for the stage before all of that becomes expensive.
        </p>
      </div>
    </div>
  </section>

  <!-- 3. What the Lab Does (6 Flow Cards + 3 Outcome Lines) -->
  <section class="section paper" aria-label="Interrogation Framework">
    <div class="container">
      <span class="eyebrow">WHAT THE LAB DOES</span>
      <h2 class="display small">
        BRING A BUSINESS IDEA. <span class="pink">THEN WE INTERROGATE IT.</span>
      </h2>
      <p class="lead" style="margin-top: 12px;">Nicely. Mostly.</p>

      <div class="lab-flow-grid" data-reveal>
        <div class="lab-flow-card">
          <strong>01 · PROBLEM</strong>
          <p>What is the problem underneath the idea? Is it real, painful and persistent?</p>
        </div>

        <div class="lab-flow-card">
          <strong>02 · PEOPLE</strong>
          <p>Who actually experiences it? Not a demographic, but a living person with habits.</p>
        </div>

        <div class="lab-flow-card">
          <strong>03 · BEHAVIOUR</strong>
          <p>What are people doing now? What workarounds and compromises already exist?</p>
        </div>

        <div class="lab-flow-card">
          <strong>04 · CONTEXT</strong>
          <p>What cultural, economic and market conditions matter in their specific environment?</p>
        </div>

        <div class="lab-flow-card">
          <strong>05 · ASSUMPTIONS</strong>
          <p>What are we treating as true without evidence? Where is the blind spot?</p>
        </div>

        <div class="lab-flow-card">
          <strong>06 · EVIDENCE</strong>
          <p>What deserves testing first with the lowest possible expenditure of resource?</p>
        </div>
      </div>

      <!-- The 3 Outcome Lines -->
      <div style="margin-top: 48px; border-top: 1px solid var(--line); padding-top: 32px;" data-reveal>
        <p class="statement" style="font-size: clamp(1.35rem, 2.2vw, 1.85rem);">
          Sometimes: <span style="font-weight: 700;">Build it.</span><br>
          Sometimes: <span style="font-weight: 700;">Change it.</span><br>
          Occasionally: <span class="pink" style="font-weight: 700;">Thank goodness we checked.</span>
        </p>
      </div>
    </div>
  </section>

  <!-- 4. The Research Observatory -->
  <section class="section dark" aria-label="Research Observatory">
    <div class="container">
      <span class="eyebrow on-dark">THE RESEARCH OBSERVATORY</span>
      <h2 class="display small">
        WHAT ARE YOUNG FOUNDERS SEEING <span class="pink">BEFORE THE REST OF US?</span>
      </h2>

      <div class="grid-2" style="margin-top: 36px;" data-reveal>
        <div>
          <p class="lead" style="color: #FFFFFF;">
            The objective isn’t always: Build the startup.
          </p>
          <p style="color: #D4CEC4;">
            Hundreds of young people investigating problems they believe are worth solving create a remarkable picture of what a generation is noticing.
          </p>
          <p style="color: #D4CEC4;">
            With appropriate consent and rigorous protection of participant IP, anonymised and aggregated findings contribute to a long-term research archive on emerging entrepreneurship.
          </p>
        </div>
        <div>
          <p class="statement" style="font-size: 1.35rem; color: #FFFFFF; margin-bottom: 20px;">
            The research belongs in service of the founders first.
          </p>
          <p class="muted" style="color: #9E9A94;">
            Their ideas remain theirs. Trust is more useful than an interesting database.
          </p>
          <p style="color: var(--pink); font-size: 0.875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-top: 24px;">
            Currently being developed following early workshop work with student and emerging founders.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. For Universities & For Mentors -->
  <section class="section" aria-label="Collaboration Opportunities">
    <div class="container grid-2" data-reveal>
      <!-- Universities Card -->
      <div style="border-top: 2px solid var(--ink); padding-top: 28px;">
        <span class="eyebrow">FOR UNIVERSITIES & INSTITUTIONS</span>
        <h3 style="font-family: var(--font-display); font-size: 2.2rem; margin: 8px 0 16px;">
          BRING THE LAB TO <span class="pink">YOUR INSTITUTION.</span>
        </h3>
        <p class="muted">
          Cohort programmes, entrepreneurship cells, incubation workshops, validation sprints, and research collaborations tailored for students.
        </p>
        <div class="actions" style="margin-top: 28px;">
          <a class="btn dark" href="/contact?type=The%20Founders%20Lab">Bring The Founders Lab to Your Campus →</a>
        </div>
      </div>

      <!-- Mentors Card -->
      <div style="border-top: 2px solid var(--ink); padding-top: 28px;">
        <span class="eyebrow">FOR ENTREPRENEURS & MENTORS</span>
        <h3 style="font-family: var(--font-display); font-size: 2.2rem; margin: 8px 0 16px;">
          BUILT SOMETHING? FAILED AT SOMETHING? <span class="pink">EXCELLENT.</span>
        </h3>
        <p class="muted">
          We want students to hear from people who have actually encountered customers, cash-flow problems, bad hires, confusing markets and plans that looked significantly better in PowerPoint.
        </p>
        <div class="actions" style="margin-top: 28px;">
          <a class="btn" href="/contact?type=The%20Founders%20Lab">Get Involved as a Mentor →</a>
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
