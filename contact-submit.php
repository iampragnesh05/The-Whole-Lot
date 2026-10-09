<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

function clean($v) {
    return trim(str_replace(["\r", "\n"], ' ', $v ?? ''));
}

$name = clean($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$org = clean($_POST['organisation'] ?? '');
$type = clean($_POST['type'] ?? 'Website enquiry');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email || !$message) {
    header('Location: contact.php?status=missing');
    exit;
}

$to = 'hello@thewholelotmedia.com';
$subject = 'The Whole Lot enquiry — ' . $type;
$body = "Name: $name\nEmail: $email\nOrganisation: $org\nType: $type\n\n$message";
$headers = "From: Website <no-reply@thewholelotmedia.com>\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

$ok = @mail($to, $subject, $body, $headers);

header('Location: thank-you.php' . ($ok ? '' : '?status=mail'));
exit;
