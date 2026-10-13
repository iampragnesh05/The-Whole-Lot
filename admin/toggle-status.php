<?php
require_once __DIR__ . '/config.php';
require_admin_login();

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $blog = get_blog_by_id($id);
    if ($blog) {
        $blog['status'] = (($blog['status'] ?? 'published') === 'published') ? 'draft' : 'published';
        $saved = save_blog($blog);
        if ($saved === false) {
            header("Location: index.php?msg=readonly_error");
            exit;
        }
    }
}
header("Location: index.php?msg=toggled");
exit;
