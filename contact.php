<?php
$page = 'contact';
$pageTitle = 'Contact';
$pageDescription = 'Start a conversation with The Whole Lot about strategy, research, marketing, communications, Ground Signal or The Founders Lab.';
$pagePath = '/contact';

$status = $_GET['status'] ?? '';
$initialType = $_GET['type'] ?? 'Start a Project';
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
  <section class="page-hero" aria-label="Contact Hero">
    <div class="container">
      <span class="eyebrow">GOT A QUESTION?</span>
      <h1 class="display">
        GOOD.<br>
        <span class="pink">WE LIKE THOSE.</span>
      </h1>
      <p class="intro">
        You don’t need to arrive knowing whether you need brand strategy, research, marketing, Ground Signal or a complicated combination of everything. Tell us what’s happening.
      </p>
    </div>
  </section>

  <!-- 2. Contact Triggers & Form -->
  <section class="section" aria-label="Enquiry Form and Pathways">
    <div class="container contact-layout">
      <!-- 4 Interactive Quick Trigger Cards -->
      <div class="contact-triggers" data-reveal>
        <div class="kicker" style="color: var(--pink-ink);">Select an enquiry path:</div>

        <button type="button" class="contact-card-btn <?= $initialType === 'Start a Project' ? 'active' : '' ?>" data-type="Start a Project">
          <h3>Start a Project</h3>
          <p>For brand strategy, marketing systems, PR, communications and digital experiences.</p>
        </button>

        <button type="button" class="contact-card-btn <?= stripos($initialType, 'Ground') !== false ? 'active' : '' ?>" data-type="Ground Signal">
          <h3>Bring Us a Question</h3>
          <p>Have a cultural research question, market-entry challenge or beta collaboration in mind?</p>
        </button>

        <button type="button" class="contact-card-btn <?= stripos($initialType, 'Founders') !== false ? 'active' : '' ?>" data-type="The Founders Lab">
          <h3>Get Involved</h3>
          <p>University leader, student founder, incubator partner or potential mentor?</p>
        </button>

        <button type="button" class="contact-card-btn <?= $initialType === 'Something Else' ? 'active' : '' ?>" data-type="Something Else">
          <h3>Tell Us About It</h3>
          <p>Speaking engagements, workshops, or something we haven’t thought of yet.</p>
        </button>

        <div style="margin-top: 16px; padding: 20px; border: 1px solid var(--line); background-color: var(--archive);">
          <div class="kicker">Direct Contact</div>
          <p style="font-size: 0.9375rem; margin-bottom: 0;">
            Prefer email directly? Write to us at <a href="mailto:hello@thewholelotmedia.com" class="pink-ink" style="font-weight: 700;">hello@thewholelotmedia.com</a>
          </p>
        </div>
      </div>

      <!-- Form Container -->
      <div class="contact-form-wrap" data-reveal>
        <?php if ($status === 'missing'): ?>
          <div class="form-status-alert error" role="alert">
            Please fill in all required fields (Name, Email, and Message) before submitting.
          </div>
        <?php elseif ($status === 'turnstile'): ?>
          <div class="form-status-alert error" role="alert">
            Security check failed. Please verify the captcha and try again.
          </div>
        <?php elseif ($status === 'mail'): ?>
          <div class="form-status-alert error" role="alert">
            There was a temporary problem dispatching your message. Please email hello@thewholelotmedia.com directly.
          </div>
        <?php endif; ?>

        <form id="contact-form" class="form-grid" action="/contact-submit.php" method="post" novalidate>
          <!-- Anti-Spam Honeypot (Hidden from real users) -->
          <div style="display: none !important;" aria-hidden="true">
            <label for="website_hp">Leave this field empty</label>
            <input type="text" id="website_hp" name="website_hp" tabindex="-1" autocomplete="off">
          </div>

          <!-- Name -->
          <div class="form-group">
            <label class="form-label" for="name">Name *</label>
            <input class="form-control" type="text" id="name" name="name" required aria-describedby="error-name" placeholder="Your name">
            <div id="error-name" class="field-error-msg" aria-live="polite"></div>
          </div>

          <!-- Email -->
          <div class="form-group">
            <label class="form-label" for="email">Email *</label>
            <input class="form-control" type="email" id="email" name="email" required aria-describedby="error-email" placeholder="name@domain.com">
            <div id="error-email" class="field-error-msg" aria-live="polite"></div>
          </div>

          <!-- Organisation -->
          <div class="form-group">
            <label class="form-label" for="organisation">Organisation / Company</label>
            <input class="form-control" type="text" id="organisation" name="organisation" placeholder="Company, studio, or institution (optional)">
          </div>

          <!-- Enquiry Type -->
          <div class="form-group">
            <label class="form-label" for="type">What are you here for?</label>
            <select class="form-control" id="type" name="type">
              <option value="Start a Project" <?= stripos($initialType, 'Project') !== false ? 'selected' : '' ?>>Start a Project</option>
              <option value="Ground Signal" <?= stripos($initialType, 'Ground') !== false ? 'selected' : '' ?>>Ground Signal</option>
              <option value="The Founders Lab" <?= stripos($initialType, 'Founders') !== false ? 'selected' : '' ?>>The Founders Lab</option>
              <option value="Speaking / Workshop" <?= stripos($initialType, 'Speaking') !== false ? 'selected' : '' ?>>Speaking / Workshop</option>
              <option value="Something Else" <?= ($initialType === 'Something Else' || $initialType === 'Tell Us About It') ? 'selected' : '' ?>>Something Else</option>
            </select>
          </div>

          <!-- Message -->
          <div class="form-group">
            <label class="form-label" for="message">Tell us what’s happening *</label>
            <textarea class="form-control" id="message" name="message" required aria-describedby="error-message" placeholder="The interesting bit usually starts here. What are you trying to understand or build?"></textarea>
            <div id="error-message" class="field-error-msg" aria-live="polite"></div>
          </div>

          <div style="margin-top: 8px;">
            <button class="btn pink" type="submit" style="width: 100%;">
              Start a Conversation →
            </button>
          </div>

          <p class="muted" style="font-size: 0.75rem; margin-top: 12px; line-height: 1.4;">
            Your message will be sent directly to The Whole Lot. We respect your confidentiality and respond promptly.
          </p>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
