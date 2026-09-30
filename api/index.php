<?php
/**
 * Vercel Serverless Entry Point Router
 */

$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestUri = trim($requestUri, '/');

$baseDir = dirname(__DIR__);
chdir($baseDir);

// Route mapping for clean URLs
$routes = [
    ''               => 'index.php',
    'index'          => 'index.php',
    'about'          => 'about.php',
    'services'       => 'services.php',
    'work'           => 'work.php',
    'founders-lab'   => 'founders-lab.php',
    'ground-signal'  => 'ground-signal.php',
    'reflections'    => 'reflections.php',
    'contact'        => 'contact.php',
    'thank-you'      => 'thank-you.php',
    'contact-submit' => 'contact-submit.php',
];

if (isset($routes[$requestUri])) {
    $target = $baseDir . '/' . $routes[$requestUri];
    if (file_exists($target)) {
        require $target;
        exit;
    }
}

// Support direct .php file paths or reflections subpaths
if (file_exists($baseDir . '/' . $requestUri . '.php')) {
    require $baseDir . '/' . $requestUri . '.php';
    exit;
}

if (file_exists($baseDir . '/' . $requestUri) && is_file($baseDir . '/' . $requestUri)) {
    if (pathinfo($requestUri, PATHINFO_EXTENSION) === 'php') {
        require $baseDir . '/' . $requestUri;
        exit;
    }
    // Static file fallback
    $mime = mime_content_type($baseDir . '/' . $requestUri) ?: 'application/octet-stream';
    header("Content-Type: $mime");
    readfile($baseDir . '/' . $requestUri);
    exit;
}

// 404 handler
http_response_code(404);
if (file_exists($baseDir . '/404.php')) {
    require $baseDir . '/404.php';
} else {
    echo '<!doctype html><html><head><title>404 Not Found</title></head><body><h1>404 Not Found</h1></body></html>';
}
