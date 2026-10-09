<?php
http_response_code(404);
$pageTitle = 'Page not found — The Whole Lot';
$pageDescription = 'The page you were looking for is not here.';
$noindex = true;
$currentPage = '404';
require_once __DIR__ . '/includes/header.php';
?>

<main>
<section class="section dark" style="min-height:80vh;display:grid;place-items:center">
  <div class="container reveal" style="text-align:left">
    <div class="eyebrow">404</div>
    <h1 class="display">THIS SIGNAL WENT MISSING.</h1>
    <p class="lead" style="margin-top:24px;color:var(--cream-light)">The page you were looking for is not here. The rest of The Whole Lot is still very much around.</p>
    <div class="actions" style="margin-top:36px">
      <a class="btn light" href="index.php">Back to Home →</a>
    </div>
  </div>
</section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
