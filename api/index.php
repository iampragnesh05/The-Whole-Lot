<?php
/**
 * Single Entry-point Serverless Router for Vercel
 * Compiles the entire PHP application into 1 single Serverless Function,
 * keeping the deployment well under Vercel's Hobby plan 12-function limit.
 */

if (ob_get_level() === 0) {
    ob_start();
}

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$rootDir = dirname(__DIR__);

// Normalize URI
$uri = '/' . ltrim($uri, '/');

// 1. Clean Blog URLs: /blog/{slug}
if (preg_match('#^/blog/([^/]+)/?$#', $uri, $matches)) {
    $_GET['slug'] = $matches[1];
    require $rootDir . '/blog-post.php';
    exit;
}

// 2. Admin redirect
if ($uri === '/admin') {
    header("Location: /admin/");
    exit;
}

// 3. Clean Page URLs
$staticMap = [
    '/' => '/index.php',
    '/about' => '/about.php',
    '/services' => '/services.php',
    '/ground-signal' => '/ground-signal.php',
    '/founders-lab' => '/founders-lab.php',
    '/blogs' => '/blogs.php',
    '/reflections' => '/blogs.php',
    '/work' => '/work.php',
    '/contact' => '/contact.php',
    '/contact-submit' => '/contact-submit.php',
    '/thank-you' => '/thank-you.php',
    '/admin/' => '/admin/index.php'
];

if (isset($staticMap[$uri])) {
    $target = $rootDir . $staticMap[$uri];
    if (file_exists($target)) {
        require $target;
        exit;
    }
}

// 3. Direct PHP Script Requests (e.g. /admin/login.php, /about.php, /index.php)
$targetFile = $rootDir . $uri;
if (is_file($targetFile) && str_ends_with($targetFile, '.php')) {
    require $targetFile;
    exit;
}

// 4. Fallback 404
http_response_code(404);
if (file_exists($rootDir . '/404.php')) {
    require $rootDir . '/404.php';
} else {
    echo "404 Not Found";
}
exit;
