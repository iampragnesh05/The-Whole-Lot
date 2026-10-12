<?php
require_once __DIR__ . '/config.php';
require_admin_login();

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    delete_blog($id);
}
header("Location: index.php?msg=deleted");
exit;
