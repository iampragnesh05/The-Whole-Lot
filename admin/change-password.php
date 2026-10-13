<?php
require_once __DIR__ . '/config.php';
require_admin_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!empty($username)) {
        $updated = update_admin_auth($username, !empty($password) ? $password : null);
        if ($updated) {
            $_SESSION['thewholelot_admin_user'] = $username;
            header("Location: index.php?msg=pwd_updated");
            exit;
        } else {
            header("Location: index.php?msg=pwd_readonly_error");
            exit;
        }
    }
}
header("Location: index.php");
exit;
