<?php
require_once __DIR__ . '/config.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: ' . site_url('contact.php'), true, 303);
    exit;
}

function forsk_post(string $key, string $fallback = ''): string {
    $value = $_POST[$key] ?? $fallback;
    return trim(is_string($value) ? $value : '');
}

function forsk_redirect_error(string $code): never {
    header('Location: ' . site_url('contact.php?form_error=' . rawurlencode($code)), true, 303);
    exit;
}

function forsk_safe_line(string $value): string {
    return preg_replace('/[\r\n]+/', ' ', trim($value)) ?? '';
}

if (forsk_post('website') !== '') {
    header('Location: ' . site_url('thank-you.php'), true, 303);
    exit;
}

$name = forsk_post('name', forsk_post('your-name'));
$email = forsk_post('email', forsk_post('your-email'));
$phoneRaw = forsk_post('phone');
$phoneDigits = preg_replace('/\D+/', '', $phoneRaw) ?? '';
if (strlen($phoneDigits) === 12 && str_starts_with($phoneDigits, '91')) {
    $phoneDigits = substr($phoneDigits, 2);
}

$city = forsk_post('city');
$qualification = forsk_post('current_qualification');
$interestedCourse = forsk_post('interested_course', forsk_post('your-subject'));
$preferredMode = forsk_post('preferred_mode');
$preferredBranch = forsk_post('preferred_branch');
$batchPreference = forsk_post('batch_preference');
$message = forsk_post('message');
$consent = forsk_post('consent');

if (mb_strlen($name) < 2 || mb_strlen($name) > 100) forsk_redirect_error('name');
if (!preg_match('/^[6-9][0-9]{9}$/', $phoneDigits)) forsk_redirect_error('phone');
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) forsk_redirect_error('email');
if ($consent !== '1' && $consent !== 'yes' && $consent !== 'on') forsk_redirect_error('consent');

$sourceDomain = forsk_post('source_domain', (string)($_SERVER['HTTP_HOST'] ?? ''));
$sourcePage = forsk_post('source_page', (string)($_SERVER['HTTP_REFERER'] ?? ''));
$pageTitle = forsk_post('page_title');
$courseName = forsk_post('course_name', $interestedCourse);
$studentSegment = forsk_post('student_segment', $qualification);
$landingPage = forsk_post('landing_page', $sourcePage);
$referrer = forsk_post('referrer', (string)($_SERVER['HTTP_REFERER'] ?? ''));

$record = [
    'submitted_at' => gmdate('c'),
    'name' => $name,
    'phone' => $phoneDigits,
    'email' => strtolower($email),
    'city' => $city,
    'current_qualification' => $qualification,
    'interested_course' => $interestedCourse,
    'preferred_mode' => $preferredMode,
    'preferred_branch' => $preferredBranch,
    'batch_preference' => $batchPreference,
    'message' => $message,
    'consent' => true,
    'source_domain' => $sourceDomain,
    'source_page' => $sourcePage,
    'page_title' => $pageTitle,
    'course_name' => $courseName,
    'student_segment' => $studentSegment,
    'landing_page' => $landingPage,
    'referrer' => $referrer,
    'utm_source' => forsk_post('utm_source'),
    'utm_medium' => forsk_post('utm_medium'),
    'utm_campaign' => forsk_post('utm_campaign'),
    'utm_term' => forsk_post('utm_term'),
    'utm_content' => forsk_post('utm_content'),
    'ip_hash' => hash('sha256', (string)($_SERVER['REMOTE_ADDR'] ?? '') . '|' . LIVE_SITE_URL),
    'user_agent' => substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
];

$storageDir = __DIR__ . '/storage/leads';
$dedupeDir = $storageDir . '/dedupe';
if ((!is_dir($dedupeDir) && !mkdir($dedupeDir, 0750, true) && !is_dir($dedupeDir))) {
    error_log('Forsk lead storage directory could not be created.');
    forsk_redirect_error('temporary');
}

$dedupeKey = hash('sha256', $phoneDigits . '|' . strtolower($email) . '|' . $interestedCourse . '|' . $sourcePage);
$marker = $dedupeDir . '/' . $dedupeKey . '.lock';
if (is_file($marker) && (time() - (int)filemtime($marker)) < 120) {
    header('Location: ' . site_url('thank-you.php?duplicate=1'), true, 303);
    exit;
}

$persisted = false;
if (class_exists('PDO') && in_array('sqlite', PDO::getAvailableDrivers(), true)) {
    try {
        $pdo = new PDO('sqlite:' . $storageDir . '/leads.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('CREATE TABLE IF NOT EXISTS leads (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            submitted_at TEXT NOT NULL,
            name TEXT NOT NULL,
            phone TEXT NOT NULL,
            email TEXT NOT NULL,
            city TEXT,
            current_qualification TEXT,
            interested_course TEXT,
            preferred_mode TEXT,
            preferred_branch TEXT,
            batch_preference TEXT,
            message TEXT,
            consent INTEGER NOT NULL DEFAULT 1,
            source_domain TEXT,
            source_page TEXT,
            page_title TEXT,
            course_name TEXT,
            student_segment TEXT,
            landing_page TEXT,
            referrer TEXT,
            utm_source TEXT,
            utm_medium TEXT,
            utm_campaign TEXT,
            utm_term TEXT,
            utm_content TEXT,
            ip_hash TEXT,
            user_agent TEXT
        )');
        $columns = array_keys($record);
        $sql = 'INSERT INTO leads (' . implode(',', $columns) . ') VALUES (:' . implode(',:', $columns) . ')';
        $stmt = $pdo->prepare($sql);
        $dbRecord = $record;
        $dbRecord['consent'] = 1;
        $stmt->execute($dbRecord);
        $persisted = true;
    } catch (Throwable $e) {
        error_log('Forsk SQLite lead persistence failed: ' . $e->getMessage());
    }
}

if (!$persisted) {
    $leadFile = $storageDir . '/leads-' . gmdate('Y-m') . '.jsonl';
    $json = json_encode($record, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json !== false && file_put_contents($leadFile, $json . PHP_EOL, FILE_APPEND | LOCK_EX) !== false) {
        $persisted = true;
    }
}

if (!$persisted) {
    error_log('Forsk lead could not be persisted.');
    forsk_redirect_error('temporary');
}
@touch($marker);

$recipient = getenv('FORSK_LEAD_EMAIL') ?: 'info@forskcodingschool.com';
$subject = 'New Forsk Coding School course enquiry';
$bodyLines = [
    'Name: ' . forsk_safe_line($name),
    'Phone: ' . forsk_safe_line($phoneDigits),
    'Email: ' . forsk_safe_line($email),
    'City: ' . forsk_safe_line($city),
    'Qualification: ' . forsk_safe_line($qualification),
    'Interested course: ' . forsk_safe_line($interestedCourse),
    'Preferred mode: ' . forsk_safe_line($preferredMode),
    'Preferred branch: ' . forsk_safe_line($preferredBranch),
    'Batch preference: ' . forsk_safe_line($batchPreference),
    'Source page: ' . forsk_safe_line($sourcePage),
    'UTM source: ' . forsk_safe_line($record['utm_source']),
    'UTM campaign: ' . forsk_safe_line($record['utm_campaign']),
    '',
    'Message:',
    $message,
];
$headers = [
    'Content-Type: text/plain; charset=UTF-8',
    'From: Forsk Coding School <info@forskcodingschool.com>',
    'Reply-To: ' . forsk_safe_line($email),
];
if (function_exists('mail')) {
    $sent = @mail($recipient, $subject, implode("\n", $bodyLines), implode("\r\n", $headers));
    if (!$sent) error_log('Forsk lead email notification failed; lead remains persisted.');
}

header('Location: ' . site_url('thank-you.php'), true, 303);
exit;
