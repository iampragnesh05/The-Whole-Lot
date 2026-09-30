<?php
/**
 * The Whole Lot — Environment & Email Configuration
 * Store sensitive credentials outside public access or configure here.
 */

return [
  // SMTP Configuration (Leave empty to use PHP native mail() fallback)
  'smtp' => [
    'enabled' => false,
    'host' => 'smtp.hostinger.com',
    'port' => 465,
    'encryption' => 'ssl', // 'tls' or 'ssl'
    'username' => 'hello@thewholelotmedia.com',
    'password' => '', // Hostinger email password
    'from_email' => 'hello@thewholelotmedia.com',
    'from_name' => 'The Whole Lot Website',
    'to_email' => 'hello@thewholelotmedia.com',
  ],

  // Cloudflare Turnstile Configuration (Leave empty to disable Turnstile check)
  'turnstile' => [
    'site_key' => '', // e.g. '0x4AAAAAA...'
    'secret_key' => '', // e.g. '0x4AAAAAA...'
  ]
];
