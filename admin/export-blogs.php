<?php
require_once __DIR__ . '/config.php';
require_admin_login();

$blogs = get_all_blogs(false);

header('Content-Type: application/json; charset=utf-8');
header('Content-Disposition: attachment; filename="blogs.json"');
echo json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit;
