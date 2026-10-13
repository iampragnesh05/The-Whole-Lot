<?php
/**
 * Admin Configuration and Authentication Handler
 * The Whole Lot CMS
 */

// Buffer output to prevent "headers already sent" errors during redirects
if (ob_get_level() === 0) {
    ob_start();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/blogs-helper.php';

define('ADMIN_AUTH_FILE', __DIR__ . '/admin_auth.json');

// Initialize admin_auth.json with default credentials if it doesn't exist and filesystem is writable
if (!file_exists(ADMIN_AUTH_FILE) && is_writable(__DIR__)) {
    $defaultAuth = [
        'username' => 'admin',
        // Default password: WholeLot2026!
        'password_hash' => password_hash('WholeLot2026!', PASSWORD_DEFAULT),
        'last_login' => null,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    @file_put_contents(ADMIN_AUTH_FILE, json_encode($defaultAuth, JSON_PRETTY_PRINT));
}

/**
 * Get current admin auth record
 */
function get_admin_auth() {
    if (file_exists(ADMIN_AUTH_FILE)) {
        $content = @file_get_contents(ADMIN_AUTH_FILE);
        if ($content !== false) {
            $data = json_decode($content, true);
            if (is_array($data) && !empty($data['username'])) {
                return $data;
            }
        }
    }
    // Fallback default credentials if file cannot be read
    return [
        'username' => 'admin',
        'password_hash' => password_hash('WholeLot2026!', PASSWORD_DEFAULT),
        'last_login' => null,
        'updated_at' => date('Y-m-d H:i:s')
    ];
}

/**
 * Update admin credentials
 */
function update_admin_auth($newUsername, $newPassword = null) {
    $auth = get_admin_auth();
    if (!$auth) return false;
    
    $auth['username'] = trim($newUsername);
    if (!empty($newPassword)) {
        $auth['password_hash'] = password_hash($newPassword, PASSWORD_DEFAULT);
    }
    $auth['updated_at'] = date('Y-m-d H:i:s');
    
    if (is_writable(ADMIN_AUTH_FILE)) {
        return @file_put_contents(ADMIN_AUTH_FILE, json_encode($auth, JSON_PRETTY_PRINT)) !== false;
    }
    return false;
}

/**
 * Check if admin is currently authenticated
 */
function is_admin_logged_in() {
    return !empty($_SESSION['thewholelot_admin_logged_in']) && $_SESSION['thewholelot_admin_logged_in'] === true;
}

/**
 * Require admin login, redirect to login page if not logged in
 */
function require_admin_login() {
    if (!is_admin_logged_in()) {
        header("Location: login.php");
        exit;
    }
}
