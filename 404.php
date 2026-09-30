<?php
$page = '404';
$pageTitle = 'Page Not Found';
$pageDescription = 'The page you are looking for does not exist or has moved.';
$pagePath = '/404';
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
      <span class="eyebrow" style="margin-bottom: 16px;">404 · ERROR</span>
      <h1 class="display" style="font-size: clamp(3rem, 7vw, 6rem); margin-bottom: 24px;">
        LOOKED CLOSER.<br>
        <span class="pink">FOUND NOTHING HERE.</span>
      </h1>
      <p class="lead" style="margin: 0 auto 36px; max-width: 580px;">
        The link you followed may have moved or no longer exists. Let’s guide you back to familiar ground.
      </p>
      <div class="actions" style="justify-content: center;">
        <a class="btn dark" href="/">Return to Home →</a>
        <a class="btn" href="/services">View Services</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
