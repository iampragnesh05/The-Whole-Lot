<?php
/**
 * The Whole Lot — Contact Form Submission Handler
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /contact');
  exit;
}

// 1. Honeypot check for spam bots
if (!empty($_POST['website_hp'])) {
  // Silent drop for spam bot
  header('Location: /thank-you');
  exit;
}

// Load config
$config = file_exists(__DIR__ . '/config.php') ? require __DIR__ . '/config.php' : [];

// Helper to clean input strings
function clean_str($val) {
  return trim(str_replace(["\r", "\n", "\t"], ' ', (string)($val ?? '')));
}

$name = clean_str($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$organisation = clean_str($_POST['organisation'] ?? '');
$type = clean_str($_POST['type'] ?? 'General Enquiry');
$message = trim((string)($_POST['message'] ?? ''));

// Validate required fields
if (!$name || !$email || !$message) {
  header('Location: /contact?status=missing');
  exit;
}

// 2. Cloudflare Turnstile Verification (if secret key configured)
$turnstileSecret = $config['turnstile']['secret_key'] ?? '';
if (!empty($turnstileSecret)) {
  $token = $_POST['cf-turnstile-response'] ?? '';
  $ip = $_SERVER['REMOTE_ADDR'] ?? '';

  $postData = http_build_query([
    'secret' => $turnstileSecret,
    'response' => $token,
    'remoteip' => $ip
  ]);

  $opts = [
    'http' => [
      'method' => 'POST',
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'content' => $postData,
      'timeout' => 5
    ]
  ];

  $context = stream_context_create($opts);
  $response = @file_get_contents('https://challenges.cloudflare.com/turnstile/v0/siteverify', false, $context);
  $result = json_decode($response, true);

  if (!$result || empty($result['success'])) {
    header('Location: /contact?status=turnstile');
    exit;
  }
}

// 3. Prepare Email
$toEmail = $config['smtp']['to_email'] ?? 'hello@thewholelotmedia.com';
$fromEmail = $config['smtp']['from_email'] ?? 'hello@thewholelotmedia.com';
$subject = 'The Whole Lot Enquiry — ' . $type;

$emailBody = "New enquiry received from the website:\n\n";
$emailBody .= "Name: " . $name . "\n";
$emailBody .= "Email: " . $email . "\n";
$emailBody .= "Organisation: " . ($organisation ?: 'Not provided') . "\n";
$emailBody .= "Enquiry Type: " . $type . "\n";
$emailBody .= "Date: " . date('Y-m-d H:i:s T') . "\n\n";
$emailBody .= "Message:\n" . $message . "\n";

$headers = [
  'From: The Whole Lot <' . $fromEmail . '>',
  'Reply-To: ' . $email,
  'Content-Type: text/plain; charset=UTF-8',
  'X-Mailer: PHP/' . phpversion()
];

// Send via PHP mail() fallback
$mailSent = @mail($toEmail, $subject, $emailBody, implode("\r\n", $headers));

if ($mailSent) {
  header('Location: /thank-you?status=success');
} else {
  // If local or mail server issue, redirect to thank-you with warning or contact status
  header('Location: /thank-you?status=mail_fallback');
}
exit;
