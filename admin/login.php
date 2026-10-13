<?php
// Buffer output early to guarantee headers can be sent
if (ob_get_level() === 0) {
    ob_start();
}

require_once __DIR__ . '/config.php';

// If already logged in, redirect to dashboard
if (is_admin_logged_in()) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $auth = get_admin_auth();
    if ($auth && $username === $auth['username'] && password_verify($password, $auth['password_hash'])) {
        $_SESSION['thewholelot_admin_logged_in'] = true;
        $_SESSION['thewholelot_admin_user'] = $username;
        
        // Only attempt to write last_login timestamp if the file system is writable
        if (is_writable(ADMIN_AUTH_FILE)) {
            $auth['last_login'] = date('Y-m-d H:i:s');
            @file_put_contents(ADMIN_AUTH_FILE, json_encode($auth, JSON_PRETTY_PRINT));
        }
        
        header("Location: index.php");
        exit;
    } else {
        $error = 'Invalid username or password. Please check your credentials.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login — The Whole Lot CMS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="icon" href="../favicon.svg" type="image/svg+xml">
  <style>
    :root {
      --archive: #f8f6f2;
      --paper: #f2eee6;
      --ink: #111111;
      --muted: #5f5b56;
      --line: #c9c2b7;
      --pink-spec: #F06A98;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--archive);
      color: var(--ink);
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .login-container {
      width: 100%;
      max-width: 440px;
      background: #ffffff;
      border: 1px solid var(--line);
      box-shadow: 0 12px 36px rgba(0,0,0,0.06);
      padding: clamp(28px, 5vw, 44px);
    }
    .brand-mark {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 2rem;
      letter-spacing: 0.08em;
      line-height: 1;
      margin-bottom: 4px;
    }
    .brand-mark span { color: var(--pink-spec); }
    .brand-sub {
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      color: var(--muted);
      text-transform: uppercase;
      margin-bottom: 28px;
    }
    h1 {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: 1.7rem;
      line-height: 1.2;
      margin-bottom: 8px;
    }
    p.login-intro {
      font-size: 0.92rem;
      color: var(--muted);
      margin-bottom: 26px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      margin-bottom: 8px;
      text-transform: uppercase;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid var(--line);
      background: var(--archive);
      font-size: 0.98rem;
      color: var(--ink);
      font-family: inherit;
      transition: border-color 0.2s, background 0.2s;
    }
    input[type="text"]:focus, input[type="password"]:focus {
      outline: none;
      border-color: var(--ink);
      background: #ffffff;
    }
    .btn-login {
      width: 100%;
      background: var(--ink);
      color: #ffffff;
      border: none;
      padding: 14px 20px;
      font-size: 0.95rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      cursor: pointer;
      transition: background 0.2s;
      margin-top: 10px;
    }
    .btn-login:hover {
      background: var(--pink-spec);
    }
    .error-msg {
      background: #fff0f3;
      border-left: 3px solid #e03131;
      color: #c92a2a;
      padding: 12px 14px;
      font-size: 0.88rem;
      margin-bottom: 20px;
    }
    .login-footer-hint {
      margin-top: 26px;
      padding-top: 20px;
      border-top: 1px solid var(--line);
      font-size: 0.82rem;
      color: var(--muted);
      line-height: 1.5;
    }
    .login-footer-hint strong {
      color: var(--ink);
    }
    .back-link {
      display: inline-block;
      margin-top: 14px;
      font-size: 0.82rem;
      color: var(--muted);
      text-decoration: underline;
    }
    .back-link:hover { color: var(--ink); }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="brand-mark">THE WHOLE LOT<span>.</span></div>
    <div class="brand-sub">Editorial &amp; Blog CMS</div>
    
    <h1>Sign In</h1>
    <p class="login-intro">Access the blog manager to publish and edit articles.</p>

    <?php if (!empty($error)): ?>
      <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autofocus placeholder="admin" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="••••••••••••">
      </div>
      <button type="submit" class="btn-login">Sign In to Dashboard →</button>
    </form>

    <div class="login-footer-hint">
      <strong>Default Credentials:</strong><br>
      Username: <code>admin</code><br>
      Password: <code>WholeLot2026!</code>
    </div>

    <div>
      <a class="back-link" href="../blogs.php">← Back to Website</a>
    </div>
  </div>
</body>
</html>
