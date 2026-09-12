<?php
/**
 * Enrollment form adapter.
 * Validates the enrollment-specific request, maps it to the shared lead handler,
 * and then delegates persistence + notification to mail.php.
 */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: enroll-now.php', true, 303);
    exit;
}

function forsk_enroll_value(string $key): string {
    $value = $_POST[$key] ?? '';
    return trim(is_string($value) ? $value : '');
}

function forsk_enroll_redirect(string $status): never {
    header('Location: enroll-now.php?status=' . rawurlencode($status), true, 303);
    exit;
}

$sessionToken = (string)($_SESSION['enroll_csrf'] ?? '');
$postedToken = forsk_enroll_value('csrf_token');
if ($sessionToken === '' || $postedToken === '' || !hash_equals($sessionToken, $postedToken)) {
    forsk_enroll_redirect('session');
}

if (forsk_enroll_value('website') !== '') {
    header('Location: thank-you.php', true, 303);
    exit;
}

$name = forsk_enroll_value('full_name');
$email = forsk_enroll_value('email');
$phoneRaw = forsk_enroll_value('phone');
$phoneDigits = preg_replace('/\D+/', '', $phoneRaw) ?? '';
if (strlen($phoneDigits) === 12 && str_starts_with($phoneDigits, '91')) {
    $phoneDigits = substr($phoneDigits, 2);
}
$course = forsk_enroll_value('course_interest');
$learningMode = forsk_enroll_value('learning_mode');
$branch = forsk_enroll_value('preferred_branch');
$qualification = forsk_enroll_value('qualification');
$currentStatus = forsk_enroll_value('current_status');
$consent = forsk_enroll_value('consent');

if ($name === '' || $email === '' || $phoneDigits === '' || $course === '' || $learningMode === '' || $branch === '' || $consent === '') {
    forsk_enroll_redirect('required');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    forsk_enroll_redirect('email');
}
if (!preg_match('/^[6-9][0-9]{9}$/', $phoneDigits)) {
    forsk_enroll_redirect('phone');
}

$_POST['name'] = $name;
$_POST['phone'] = $phoneDigits;
$_POST['interested_course'] = $course;
$_POST['preferred_mode'] = $learningMode;
$_POST['preferred_branch'] = $branch;
$_POST['current_qualification'] = $qualification !== '' ? $qualification : $currentStatus;
$_POST['city'] = 'Jaipur';
$_POST['course_name'] = $course;
$_POST['student_segment'] = $currentStatus !== '' ? $currentStatus : $qualification;
$_POST['consent'] = '1';

// Rotate the one-time enrollment token before handing off to the shared lead handler.
unset($_SESSION['enroll_csrf']);

require __DIR__ . '/mail.php';
