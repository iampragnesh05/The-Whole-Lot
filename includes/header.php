<?php
/**
 * Global Header Component for The Whole Lot
 * @var string $pageTitle
 * @var string $pageDescription
 * @var string $canonicalUrl
 * @var string $currentPage
 * @var bool $noindex
 */
$pageTitle = $pageTitle ?? 'The Whole Lot — Strategy · Culture · Research · Growth';
$pageDescription = $pageDescription ?? 'The Whole Lot is an independent strategy, research and growth practice exploring how people, culture and context shape businesses and the world around them.';
$canonicalUrl = $canonicalUrl ?? 'https://thewholelotmedia.com/';
$currentPage = $currentPage ?? 'home';
$noindex = $noindex ?? false;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($pageTitle); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
<?php if ($noindex): ?>
<meta name="robots" content="noindex, nofollow">
<?php else: ?>
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
<meta name="twitter:card" content="summary">
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=DM+Serif+Display:ital@0;1&family=Inter:wght@400;500;600;700&family=Spectral:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="icon" href="favicon.svg" type="image/svg+xml">
</head>
<body>
<div class="site-shell">
<header class="header">
  <div class="container header-inner">
    <!-- Logo Left -->
    <a class="logo" href="index.php" aria-label="The Whole Lot home">
      <span class="logo-mark">
        <span class="logo-line">THE</span>
        <span class="logo-line">WHOLE</span>
        <span class="logo-line">LOT<span class="logo-dot">.</span></span>
      </span>
      <span class="logo-sub">MEDIA</span>
    </a>

    <!-- Desktop Navigation Menu -->
    <nav class="nav" aria-label="Primary navigation">
      <a href="services.php" class="<?php echo ($currentPage === 'services') ? 'active' : ''; ?>" <?php echo ($currentPage === 'services') ? 'aria-current="page"' : ''; ?>>Services</a>
      <a href="ground-signal.php" class="<?php echo ($currentPage === 'ground-signal') ? 'active' : ''; ?>" <?php echo ($currentPage === 'ground-signal') ? 'aria-current="page"' : ''; ?>>Ground Signal</a>
      <a href="founders-lab.php" class="<?php echo ($currentPage === 'founders-lab') ? 'active' : ''; ?>" <?php echo ($currentPage === 'founders-lab') ? 'aria-current="page"' : ''; ?>>The Founders Lab</a>
      <a href="reflections.php" class="<?php echo ($currentPage === 'reflections') ? 'active' : ''; ?>" <?php echo ($currentPage === 'reflections') ? 'aria-current="page"' : ''; ?>>Reflections</a>
      <a href="work.php" class="<?php echo ($currentPage === 'work') ? 'active' : ''; ?>" <?php echo ($currentPage === 'work') ? 'aria-current="page"' : ''; ?>>Work</a>
      <a href="about.php" class="<?php echo ($currentPage === 'about') ? 'active' : ''; ?>" <?php echo ($currentPage === 'about') ? 'aria-current="page"' : ''; ?>>About</a>
    </nav>

    <!-- Header Actions (CTA + Mobile Hamburger Toggle) -->
    <div class="header-actions">
      <a class="header-cta-btn <?php echo ($currentPage === 'contact') ? 'active' : ''; ?>" href="contact.php">Start a Conversation</a>
      <button class="mobile-nav-toggle" id="mobileNavToggle" aria-label="Toggle Navigation Menu" aria-expanded="false">
        <span class="bar bar-1"></span>
        <span class="bar bar-2"></span>
        <span class="bar bar-3"></span>
      </button>
    </div>
  </div>

  <!-- Mobile Drawer Menu -->
  <div class="mobile-nav-drawer" id="mobileNavDrawer">
    <div class="mobile-nav-links">
      <a href="services.php" class="<?php echo ($currentPage === 'services') ? 'active' : ''; ?>">Services</a>
      <a href="ground-signal.php" class="<?php echo ($currentPage === 'ground-signal') ? 'active' : ''; ?>">Ground Signal</a>
      <a href="founders-lab.php" class="<?php echo ($currentPage === 'founders-lab') ? 'active' : ''; ?>">The Founders Lab</a>
      <a href="reflections.php" class="<?php echo ($currentPage === 'reflections') ? 'active' : ''; ?>">Reflections</a>
      <a href="work.php" class="<?php echo ($currentPage === 'work') ? 'active' : ''; ?>">Work</a>
      <a href="about.php" class="<?php echo ($currentPage === 'about') ? 'active' : ''; ?>">About</a>
      <div class="mobile-cta-wrap">
        <a class="btn pink" style="width:100%;text-align:center" href="contact.php">Start a Conversation →</a>
      </div>
    </div>
  </div>
</header>
