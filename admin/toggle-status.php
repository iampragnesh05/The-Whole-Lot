<?php
require_once __DIR__ . '/config.php';
require_admin_login();

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $blog = get_blog_by_id($id);
    if ($blog) {
        $blog['status'] = (($blog['status'] ?? 'published') === 'published') ? 'draft' : 'published';
        save_blog($blog);
    }
}
header("Location: index.php?msg=toggled");
exit;
