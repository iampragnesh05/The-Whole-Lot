<?php
require_once __DIR__ . '/config.php';
require_admin_login();

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $deleted = delete_blog($id);
    if ($deleted === false) {
        header("Location: index.php?msg=readonly_error");
        exit;
    }
}
header("Location: index.php?msg=deleted");
exit;
