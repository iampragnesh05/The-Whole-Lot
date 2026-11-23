<?php
/**
 * Local Development Router for PHP Built-in Server
 * Usage: php -S localhost:8000 router.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// 1. Serve existing static files directly
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false; // Let PHP built-in server handle the file
}

// 2. Serve homepage
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/index.php';
    exit;
}

// 3. Clean URL rewrite (e.g. /about -> /about.php)
$trimmedUri = trim($uri, '/');
if (file_exists(__DIR__ . '/' . $trimmedUri . '.php')) {
    require __DIR__ . '/' . $trimmedUri . '.php';
    exit;
}

// 4. Directory index fallback (e.g. /reflections/ -> /reflections/index.php)
if (is_dir($file) && file_exists($file . '/index.php')) {
    require $file . '/index.php';
    exit;
}

// 5. Fallback 404
http_response_code(404);
if (file_exists(__DIR__ . '/404.php')) {
    require __DIR__ . '/404.php';
} else {
    echo '404 Not Found';
}
exit;
