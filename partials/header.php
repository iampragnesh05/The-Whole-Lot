<?php
// Ensure $page is defined
$page = $page ?? '';
$isInitiativeActive = in_array($page, ['ground-signal', 'founders-lab', 'reflections']);
?>
<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="header" role="banner">
  <div class="container header-inner">
    <!-- Logo -->
    <a class="logo" href="/" aria-label="The Whole Lot home">
      <span class="logo-mark">
        <span class="logo-line">THE</span>
        <span class="logo-line">WHOLE</span>
        <span class="logo-line">LOT<span class="logo-dot">.</span></span>
      </span>
      <span class="logo-sub">MEDIA</span>
    </a>

    <!-- Desktop Navigation (>=1024px) -->
    <nav class="nav-desktop" aria-label="Primary navigation">
      <a href="/services" class="<?= $page === 'services' ? 'active' : '' ?>" <?= $page === 'services' ? 'aria-current="page"' : '' ?>>SERVICES</a>

      <div class="nav-dropdown-wrapper">
        <button class="nav-dropdown-toggle <?= $isInitiativeActive ? 'active' : '' ?>" aria-expanded="false" aria-haspopup="true" aria-controls="initiatives-menu">
          INITIATIVES
          <svg class="dropdown-chevron" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <div class="nav-dropdown-menu" id="initiatives-menu" role="menu">
          <a href="/ground-signal" class="nav-dropdown-item" role="menuitem">
            <div class="nav-dropdown-title">Ground Signal</div>
            <div class="nav-dropdown-desc">Read the ground before you read the signal.</div>
          </a>
          <a href="/founders-lab" class="nav-dropdown-item" role="menuitem">
            <div class="nav-dropdown-title">The Founders Lab</div>
            <div class="nav-dropdown-desc">Before you build the business, investigate the idea.</div>
          </a>
          <a href="/reflections" class="nav-dropdown-item" role="menuitem">
            <div class="nav-dropdown-title">Reflections</div>
            <div class="nav-dropdown-desc">Things we notice when we’re paying attention.</div>
          </a>
        </div>
      </div>

      <a href="/work" class="<?= $page === 'work' ? 'active' : '' ?>" <?= $page === 'work' ? 'aria-current="page"' : '' ?>>WORK</a>
      <a href="/about" class="<?= $page === 'about' ? 'active' : '' ?>" <?= $page === 'about' ? 'aria-current="page"' : '' ?>>ABOUT</a>
    </nav>

    <!-- Desktop CTA -->
    <div class="nav-desktop-right">
      <a class="nav-cta" href="/contact">START A CONVERSATION</a>
    </div>

    <!-- Mobile Menu Button (<1024px) -->
    <button class="menu-toggle" aria-expanded="false" aria-controls="mobile-overlay" aria-label="Open navigation menu">
      MENU
    </button>
  </div>
</header>

<!-- Mobile Full-Screen Ink Overlay -->
<div class="mobile-overlay" id="mobile-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Navigation Menu">
  <div class="mobile-overlay-header">
    <a class="logo" href="/" aria-label="The Whole Lot home" style="color: #FFFFFF;">
      <span class="logo-mark">
        <span class="logo-line">THE</span>
        <span class="logo-line">WHOLE</span>
        <span class="logo-line">LOT<span class="logo-dot">.</span></span>
      </span>
      <span class="logo-sub">MEDIA</span>
    </a>
    <button class="mobile-overlay-close" aria-label="Close navigation menu">
      Close ✕
    </button>
  </div>

  <nav class="mobile-nav-links" aria-label="Mobile navigation">
    <a href="/services" class="mobile-nav-item <?= $page === 'services' ? 'pink' : '' ?>">Services</a>
    
    <div class="mobile-nav-item">
      <span>Initiatives</span>
      <div class="mobile-subnav">
        <a href="/ground-signal" class="<?= $page === 'ground-signal' ? 'pink' : '' ?>">Ground Signal</a>
        <a href="/founders-lab" class="<?= $page === 'founders-lab' ? 'pink' : '' ?>">The Founders Lab</a>
        <a href="/reflections" class="<?= $page === 'reflections' ? 'pink' : '' ?>">Reflections</a>
      </div>
    </div>

    <a href="/work" class="mobile-nav-item <?= $page === 'work' ? 'pink' : '' ?>">Work</a>
    <a href="/about" class="mobile-nav-item <?= $page === 'about' ? 'pink' : '' ?>">About</a>
    <a href="/contact" class="mobile-nav-item <?= $page === 'contact' ? 'pink' : '' ?>">Contact</a>
  </nav>

  <div class="mobile-overlay-footer">
    <a href="/contact" class="btn pink" style="width: 100%;">Start a conversation →</a>
    <div class="mobile-email">
      <a href="mailto:hello@thewholelotmedia.com">hello@thewholelotmedia.com</a>
    </div>
  </div>
</div>
