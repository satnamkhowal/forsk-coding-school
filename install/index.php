<?php
require_once dirname(__DIR__) . '/config.php';

header('X-Robots-Tag: noindex, nofollow, noarchive', true);
header('X-Content-Type-Options: nosniff', true);
header('Referrer-Policy: no-referrer', true);
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0', true);

$setupKey = function_exists('forsk_env_value') ? forsk_env_value('FORSK_SETUP_KEY') : trim((string)(getenv('FORSK_SETUP_KEY') ?: ''));
$setupKeyConfigured = $setupKey !== '';
$isLocal = defined('IS_LOCAL') && IS_LOCAL;
$error = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $providedKey = trim((string)($_POST['setup_key'] ?? ''));

    if ($isLocal) {
        header('Location: ' . site_url('admin/integrations-setup.php'));
        exit;
    }

    if (!$setupKeyConfigured) {
        $error = 'PHP cannot see FORSK_SETUP_KEY yet. Add it as a hosting environment variable or create storage/private/.env with FORSK_SETUP_KEY=your-secret-key, then reload this page.';
    } elseif ($providedKey === '') {
        $error = 'Enter your installer security key.';
    } elseif (!hash_equals($setupKey, $providedKey)) {
        $error = 'Installer security key does not match the server configuration.';
    } else {
        header('Location: ' . site_url('admin/integrations-setup.php?setup_key=' . rawurlencode($providedKey)));
        exit;
    }
}

$requirements = [
    ['PHP 8+', version_compare(PHP_VERSION, '8.0.0', '>=')],
    ['PDO extension', extension_loaded('pdo')],
    ['PDO MySQL extension', extension_loaded('pdo_mysql')],
    ['OpenSSL extension', extension_loaded('openssl')],
    ['Sessions available', function_exists('session_start')],
    ['Private storage exists', is_dir(dirname(__DIR__) . '/storage/private')],
    ['Private storage writable', is_writable(dirname(__DIR__) . '/storage/private')],
];

$allReady = true;
foreach ($requirements as $requirement) {
    if (!$requirement[1]) {
        $allReady = false;
        break;
    }
}
?>
<!doctype html>
<html lang="en-IN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow,noarchive">
<title>Install Forsk Coding School Integrations</title>
<style>
*{box-sizing:border-box}body{margin:0;background:#f4f7fb;color:#172033;font:15px/1.55 system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}.wrap{max-width:900px;margin:48px auto;padding:0 18px}.hero{background:#101b3f;color:#fff;border-radius:22px;padding:30px}.hero h1{margin:0 0 8px;font-size:30px}.hero p{margin:0;color:#dbe4ff}.card{background:#fff;border:1px solid #e2e8f0;border-radius:18px;padding:24px;margin-top:18px;box-shadow:0 10px 30px rgba(27,39,94,.06)}.checks{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}.check{border:1px solid #e5e7eb;border-radius:12px;padding:12px 14px}.ok{color:#087a45}.bad{color:#b42318}.notice{padding:12px 14px;border-radius:10px;background:#fff1f0;color:#9f1c16;margin:14px 0}.success{padding:12px 14px;border-radius:10px;background:#ecfdf3;color:#087a45;margin:14px 0}label{display:block;font-weight:700;margin:14px 0 6px}input{width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:10px;font:inherit}.btn{display:inline-block;margin-top:14px;border:0;border-radius:10px;background:#2457d6;color:#fff;font-weight:750;padding:13px 20px;cursor:pointer}.muted{color:#667085}.code{font-family:ui-monospace,SFMono-Regular,Menlo,monospace;background:#f5f7fa;padding:2px 6px;border-radius:6px}.steps{margin:0;padding-left:20px}.steps li{margin:8px 0}@media(max-width:700px){.wrap{margin-top:20px}.checks{grid-template-columns:1fr}.hero h1{font-size:25px}}
</style>
</head>
<body>
<main class="wrap">
<section class="hero">
<h1>Forsk Coding School Installer</h1>
<p>Configure lead databases and SMTP from the browser without putting passwords in GitHub.</p>
</section>

<section class="card">
<h2>1. Server readiness</h2>
<div class="checks">
<?php foreach ($requirements as [$label,$status]): ?>
<div class="check <?= $status ? 'ok' : 'bad' ?>"><?= $status ? '✓' : '✕' ?> <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></div>
<?php endforeach; ?>
</div>
<?php if (!$allReady): ?><p class="notice">One or more server checks failed. You can still continue to inspect the setup page, but database/SMTP operation may fail until the marked requirement is fixed.</p><?php endif; ?>
</section>

<section class="card">
<h2>2. Open secure setup</h2>
<?php if ($error): ?><div class="notice"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
<?php if ($isLocal): ?>
<p class="muted">Localhost was detected. No setup key is required locally.</p>
<form method="post"><button class="btn" type="submit">Continue to Database &amp; SMTP Setup</button></form>
<?php else: ?>
<?php if ($setupKeyConfigured): ?>
<div class="success">✓ FORSK_SETUP_KEY is visible to PHP. Enter the same key below.</div>
<?php else: ?>
<p class="notice">FORSK_SETUP_KEY is not currently visible to PHP. The button remains active so the installer can show the exact configuration error after submit.</p>
<p class="muted">Shared hosting fallback: create <span class="code">storage/private/.env</span> containing <span class="code">FORSK_SETUP_KEY=your-secret-key</span>. That directory is blocked from direct web access.</p>
<?php endif; ?>
<form method="post" autocomplete="off">
<label for="setup_key">Installer security key</label>
<input id="setup_key" name="setup_key" type="password" required autocomplete="new-password" placeholder="Enter FORSK_SETUP_KEY">
<button class="btn" type="submit">Continue to Database &amp; SMTP Setup</button>
</form>
<?php endif; ?>
</section>

<section class="card">
<h2>What happens next</h2>
<ol class="steps">
<li>Enter Academic/Course database details and SMTP credentials.</li>
<li>Enter College Admissions database and SMTP details separately if required.</li>
<li>Save configuration. Credentials are stored in <span class="code">storage/private/integrations.php</span>, which is excluded from Git.</li>
<li>Lead tables are created automatically on first valid lead submission when the MySQL user has permission.</li>
</ol>
<p class="muted">Production installer access remains protected by the server-side setup key. This page and the setup utility are not intended for search indexing.</p>
</section>
</main>
</body>
</html>
