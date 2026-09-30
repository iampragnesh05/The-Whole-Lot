<?php
$page = 'thank-you';
$pageTitle = 'Thank You';
$pageDescription = 'Thank you for contacting The Whole Lot. We will review your message and reply promptly.';
$pagePath = '/thank-you';
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
  <section class="section" style="padding: clamp(100px, 14vw, 180px) 0;">
    <div class="container-narrow" style="text-align: center;">
      <span class="eyebrow" style="margin-bottom: 16px;">MESSAGE RECEIVED</span>
      <h1 class="display" style="font-size: clamp(2.8rem, 6.5vw, 5.5rem); margin-bottom: 24px;">
        THANK YOU FOR <br>
        <span class="pink">REACHING OUT.</span>
      </h1>
      <p class="lead" style="margin: 0 auto 36px; max-width: 600px;">
        Your enquiry has landed with our team. We review all incoming notes carefully and will get back to you with thoughtful next steps.
      </p>
      <div class="actions" style="justify-content: center;">
        <a class="btn dark" href="/">Return to Home →</a>
        <a class="btn" href="/services">Explore Services</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
