<?php
$pageTitle = 'Thank you — The Whole Lot';
$pageDescription = 'Thank you for reaching out to The Whole Lot.';
$noindex = true;
$currentPage = 'contact';
require_once __DIR__ . '/includes/header.php';
?>

<main>
<section class="section dark" style="min-height:80vh;display:grid;place-items:center">
  <div class="container reveal" style="text-align:left">
    <div class="eyebrow">MESSAGE RECEIVED</div>
    <h1 class="display">GOOD QUESTION.</h1>
    <p class="lead" style="margin-top:24px;color:var(--cream-light)">Thanks for getting in touch. We’ll read your note properly and come back to you soon.</p>
    <div class="actions" style="margin-top:36px">
      <a class="btn light" href="index.php">Back to Home →</a>
    </div>
  </div>
</section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
