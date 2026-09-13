<?php
require_once __DIR__ . '/includes/lead-platform.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: ' . site_url('contact.php'), true, 303);
    exit;
}
function forsk_lead_post(string $key): string {
    $v = $_POST[$key] ?? '';
    return trim(is_string($v) ? $v : '');
}
function forsk_lead_return(string $code = ''): never {
    $path = ltrim(forsk_lead_post('return_path'), '/');
    $valid = $path !== ''
        && !str_contains($path, '..')
        && !str_contains($path, '//')
        && preg_match('#^[A-Za-z0-9][A-Za-z0-9/_\.-]*$#', $path);
    if (!$valid) $path = 'contact.php';
    $suffix = $code === '' ? '' : '?form_error=' . rawurlencode($code);
    header('Location: ' . site_url($path . $suffix . '#enquiry'), true, 303);
    exit;
}
if (forsk_lead_post('website') !== '') {
    header('Location: ' . site_url('thank-you.php'), true, 303);
    exit;
}

$channel = forsk_lead_post('lead_channel') === 'college' ? 'college' : 'academic';
$name = forsk_lead_post('name');
$email = strtolower(forsk_lead_post('email'));
$phone = preg_replace('/\D+/', '', forsk_lead_post('phone')) ?? '';
if (strlen($phone) === 12 && str_starts_with($phone, '91')) $phone = substr($phone, 2);
$city = forsk_lead_post('city');
$qualification = forsk_lead_post('qualification');
$interest = forsk_lead_post('interest');
$message = forsk_lead_post('message');
$consent = forsk_lead_post('consent');

if (mb_strlen($name) < 2 || mb_strlen($name) > 100) forsk_lead_return('name');
if (!preg_match('/^[6-9][0-9]{9}$/', $phone)) forsk_lead_return('phone');
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) forsk_lead_return('email');
if ($interest === '' || mb_strlen($interest) > 190) forsk_lead_return('interest');
if ($consent !== '1') forsk_lead_return('consent');

$collegeCategory = substr(forsk_lead_post('college_category'), 0, 120);
$collegeSlug = substr(forsk_lead_post('college_slug'), 0, 120);
$collegeName = substr(forsk_lead_post('college_name'), 0, 190);
$collegeProgram = substr(forsk_lead_post('college_program'), 0, 120);

$record = [
    'submitted_at' => gmdate('c'),
    'lead_channel' => $channel,
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'city' => $city,
    'qualification' => $qualification,
    'interest' => $interest,
    'message' => $message,
    'college_category' => $channel === 'college' ? $collegeCategory : '',
    'college_slug' => $channel === 'college' ? $collegeSlug : '',
    'college_name' => $channel === 'college' ? $collegeName : '',
    'college_program' => $channel === 'college' ? $collegeProgram : '',
    'source_page' => forsk_lead_post('source_page'),
    'page_title' => forsk_lead_post('page_title'),
    'referrer' => forsk_lead_post('referrer'),
    'utm_source' => forsk_lead_post('utm_source'),
    'utm_medium' => forsk_lead_post('utm_medium'),
    'utm_campaign' => forsk_lead_post('utm_campaign'),
    'utm_term' => forsk_lead_post('utm_term'),
    'utm_content' => forsk_lead_post('utm_content'),
    'ip_hash' => hash('sha256', (string)($_SERVER['REMOTE_ADDR'] ?? '') . '|' . LIVE_SITE_URL),
    'user_agent' => substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
];

$dedupeDir = __DIR__ . '/storage/leads/dedupe';
if (!is_dir($dedupeDir)) @mkdir($dedupeDir, 0750, true);
$dedupeKey = hash('sha256', $channel . '|' . $phone . '|' . $email . '|' . $interest . '|' . ($record['source_page'] ?? ''));
$marker = $dedupeDir . '/' . $dedupeKey . '.lock';
if (is_file($marker) && (time() - (int)filemtime($marker)) < 120) {
    header('Location: ' . site_url('thank-you.php?duplicate=1'), true, 303);
    exit;
}

if (!forsk_store_lead($channel, $record)) {
    error_log('Forsk lead could not be stored.');
    forsk_lead_return('temporary');
}
@touch($marker);
if (!forsk_send_lead_notification($channel, $record)) {
    error_log('Forsk lead notification failed; the lead is still stored.');
}
header('Location: ' . site_url('thank-you.php?lead=' . rawurlencode($channel)), true, 303);
exit;
