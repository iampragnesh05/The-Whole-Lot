<?php
$siteTitle = 'The Whole Lot — Strategy · Culture · Research · Growth';
$metaTitle = !empty($pageTitle) ? $pageTitle . ' — The Whole Lot' : $siteTitle;
$metaDescription = $pageDescription ?? 'The Whole Lot is an independent strategy, research and growth practice exploring how people, culture and context shape businesses and the world around them.';
$canonicalUrl = 'https://thewholelotmedia.com' . ($pagePath ?? '/');
$ogImage = 'https://thewholelotmedia.com/assets/img/og/og-image.jpg';
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($metaTitle) ?></title>
<meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">

<!-- OpenGraph / Social Meta -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="The Whole Lot">
<meta property="og:title" content="<?= htmlspecialchars($metaTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($metaDescription) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
<meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($metaTitle) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($metaDescription) ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

<!-- Font Preloads (Self-hosted woff2) -->
<link rel="preload" href="/assets/fonts/BebasNeue-Regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/assets/fonts/InterTight-Light.woff2" as="font" type="font/woff2" crossorigin>

<!-- Stylesheet & Favicon -->
<link rel="stylesheet" href="/assets/css/styles.css">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">

<!-- Organization Schema JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "The Whole Lot",
  "url": "https://thewholelotmedia.com/",
  "logo": "https://thewholelotmedia.com/favicon.svg",
  "description": "An independent strategy, research and growth practice exploring how people, culture and context shape businesses and the world around them.",
  "email": "hello@thewholelotmedia.com",
  "founder": {
    "@type": "Person",
    "name": "Avani Jain"
  }
}
</script>

<?php if (isset($page) && $page === 'about'): ?>
<!-- Person Schema for Founder Avani Jain -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Avani Jain",
  "jobTitle": "Founder & Lead Consultant",
  "worksFor": {
    "@type": "Organization",
    "name": "The Whole Lot"
  },
  "url": "https://thewholelotmedia.com/about",
  "description": "Avani Jain has spent more than a decade working across brand strategy, marketing, communications, research, culture and business growth."
}
</script>
<?php endif; ?>
