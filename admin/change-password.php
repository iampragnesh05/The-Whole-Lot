<?php
require_once __DIR__ . '/config.php';
require_admin_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!empty($username)) {
        update_admin_auth($username, !empty($password) ? $password : null);
        $_SESSION['thewholelot_admin_user'] = $username;
    }
}
header("Location: index.php?msg=pwd_updated");
exit;
