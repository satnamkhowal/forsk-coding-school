<?php
require_once dirname(__DIR__) . '/includes/lead-platform.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$setupKey = (string)(getenv('FORSK_SETUP_KEY') ?: '');
$providedKey = (string)($_POST['setup_key'] ?? $_GET['setup_key'] ?? '');
$allowed = IS_LOCAL || ($setupKey !== '' && hash_equals($setupKey, $providedKey));
if (!$allowed) {
    http_response_code(403);
    echo '<!doctype html><meta charset="utf-8"><title>Setup locked</title><h1>Setup locked</h1><p>Set the server environment variable <code>FORSK_SETUP_KEY</code>, then open this page with <code>?setup_key=YOUR_KEY</code>. Localhost is allowed automatically.</p>';
    exit;
}

if (empty($_SESSION['forsk_setup_csrf'])) $_SESSION['forsk_setup_csrf'] = bin2hex(random_bytes(24));
$csrf = $_SESSION['forsk_setup_csrf'];
$message = '';
$error = '';
$settings = forsk_lead_settings();

function forsk_setup_text(string $channel, string $section, string $key, array $settings): string {
    return htmlspecialchars((string)($settings[$channel][$section][$key] ?? ''), ENT_QUOTES, 'UTF-8');
}
function forsk_setup_bool(string $channel, string $section, array $settings): bool {
    return !empty($settings[$channel][$section]['enabled']);
}
function forsk_setup_value(string $channel, string $section, string $key, array $old, string $fallback = ''): string {
    $name = $channel . '_' . $section . '_' . $key;
    $value = trim((string)($_POST[$name] ?? ''));
    if ($key === 'password' && $value === '') return (string)($old[$channel][$section][$key] ?? '');
    return $value !== '' ? $value : $fallback;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!hash_equals($csrf, (string)($_POST['csrf'] ?? ''))) {
        $error = 'Security token expired. Reload the page and try again.';
    } else {
        $next = forsk_lead_default_settings();
        foreach (['academic','college'] as $channel) {
            $next[$channel]['database'] = [
                'enabled' => isset($_POST[$channel . '_database_enabled']),
                'driver' => 'mysql',
                'host' => forsk_setup_value($channel, 'database', 'host', $settings, 'localhost'),
                'port' => forsk_setup_value($channel, 'database', 'port', $settings, '3306'),
                'database' => forsk_setup_value($channel, 'database', 'database', $settings),
                'username' => forsk_setup_value($channel, 'database', 'username', $settings),
                'password' => forsk_setup_value($channel, 'database', 'password', $settings),
                'table' => forsk_setup_value($channel, 'database', 'table', $settings, $channel === 'college' ? 'college_admission_leads' : 'academic_leads'),
            ];
            $next[$channel]['smtp'] = [
                'enabled' => isset($_POST[$channel . '_smtp_enabled']),
                'host' => forsk_setup_value($channel, 'smtp', 'host', $settings),
                'port' => forsk_setup_value($channel, 'smtp', 'port', $settings, '587'),
                'encryption' => forsk_setup_value($channel, 'smtp', 'encryption', $settings, 'tls'),
                'username' => forsk_setup_value($channel, 'smtp', 'username', $settings),
                'password' => forsk_setup_value($channel, 'smtp', 'password', $settings),
                'from_email' => forsk_setup_value($channel, 'smtp', 'from_email', $settings, 'info@forskcodingschool.com'),
                'from_name' => forsk_setup_value($channel, 'smtp', 'from_name', $settings, 'Forsk Coding School'),
                'recipient' => forsk_setup_value($channel, 'smtp', 'recipient', $settings, 'info@forskcodingschool.com'),
            ];
        }
        $privateDir = dirname(__DIR__) . '/storage/private';
        if (!is_dir($privateDir) && !mkdir($privateDir, 0750, true) && !is_dir($privateDir)) {
            $error = 'Could not create storage/private. Check PHP write permissions.';
        } else {
            $file = $privateDir . '/integrations.php';
            $php = "<?php\n/**\n * GENERATED RUNTIME CREDENTIALS - DO NOT COMMIT.\n * Edit through /admin/integrations-setup.php or replace values manually.\n * Academic and college systems intentionally remain separate.\n */\nreturn " . var_export($next, true) . ";\n";
            $tmp = $file . '.tmp';
            if (@file_put_contents($tmp, $php, LOCK_EX) === false || !@rename($tmp, $file)) {
                @unlink($tmp);
                $error = 'Could not save integrations.php. Make storage/private writable by PHP.';
            } else {
                @chmod($file, 0640);
                $settings = $next;
                $message = 'Configuration saved. Password fields are intentionally blank on screen after saving; existing saved passwords are preserved when left blank.';
            }
        }
    }
}
function forsk_setup_panel(string $channel, string $title, array $settings): void {
    $dbEnabled = forsk_setup_bool($channel, 'database', $settings);
    $smtpEnabled = forsk_setup_bool($channel, 'smtp', $settings);
    ?>
    <section class="panel">
      <h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
      <p class="hint"><?= $channel === 'college' ? 'Used only for college-admission leads (BCA, MCA, B.Tech, BBA).' : 'Used only for course and internship leads.' ?></p>
      <h3>Database</h3>
      <label class="toggle"><input type="checkbox" name="<?= $channel ?>_database_enabled" <?= $dbEnabled ? 'checked' : '' ?>> Enable external MySQL database</label>
      <div class="grid">
        <label>Host<input name="<?= $channel ?>_database_host" value="<?= forsk_setup_text($channel,'database','host',$settings) ?>" placeholder="localhost"></label>
        <label>Port<input name="<?= $channel ?>_database_port" value="<?= forsk_setup_text($channel,'database','port',$settings) ?>" placeholder="3306"></label>
        <label>Database name<input name="<?= $channel ?>_database_database" value="<?= forsk_setup_text($channel,'database','database',$settings) ?>"></label>
        <label>Username<input name="<?= $channel ?>_database_username" value="<?= forsk_setup_text($channel,'database','username',$settings) ?>"></label>
        <label>Password<input type="password" name="<?= $channel ?>_database_password" value="" placeholder="Leave blank to keep saved password"></label>
        <label>Table<input name="<?= $channel ?>_database_table" value="<?= forsk_setup_text($channel,'database','table',$settings) ?>"></label>
      </div>
      <h3>SMTP</h3>
      <label class="toggle"><input type="checkbox" name="<?= $channel ?>_smtp_enabled" <?= $smtpEnabled ? 'checked' : '' ?>> Enable SMTP notifications</label>
      <div class="grid">
        <label>SMTP host<input name="<?= $channel ?>_smtp_host" value="<?= forsk_setup_text($channel,'smtp','host',$settings) ?>" placeholder="smtp.example.com"></label>
        <label>Port<input name="<?= $channel ?>_smtp_port" value="<?= forsk_setup_text($channel,'smtp','port',$settings) ?>" placeholder="587"></label>
        <label>Encryption<select name="<?= $channel ?>_smtp_encryption"><?php $enc=(string)($settings[$channel]['smtp']['encryption']??'tls'); foreach(['tls'=>'STARTTLS','ssl'=>'SSL','none'=>'None'] as $v=>$l): ?><option value="<?= $v ?>" <?= $enc===$v?'selected':'' ?>><?= $l ?></option><?php endforeach; ?></select></label>
        <label>SMTP username<input name="<?= $channel ?>_smtp_username" value="<?= forsk_setup_text($channel,'smtp','username',$settings) ?>"></label>
        <label>SMTP password<input type="password" name="<?= $channel ?>_smtp_password" value="" placeholder="Leave blank to keep saved password"></label>
        <label>From email<input type="email" name="<?= $channel ?>_smtp_from_email" value="<?= forsk_setup_text($channel,'smtp','from_email',$settings) ?>"></label>
        <label>From name<input name="<?= $channel ?>_smtp_from_name" value="<?= forsk_setup_text($channel,'smtp','from_name',$settings) ?>"></label>
        <label>Lead recipient email<input type="email" name="<?= $channel ?>_smtp_recipient" value="<?= forsk_setup_text($channel,'smtp','recipient',$settings) ?>"></label>
      </div>
    </section>
    <?php
}
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Forsk Integrations Setup</title>
<style>
body{margin:0;background:#f5f7fb;color:#16213e;font:15px/1.5 system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}.wrap{max-width:1180px;margin:40px auto;padding:0 18px}.top{background:#111d3b;color:#fff;padding:24px;border-radius:18px;margin-bottom:20px}.top h1{margin:0 0 6px}.panel{background:#fff;border:1px solid #e4e8f1;border-radius:18px;padding:24px;margin:18px 0;box-shadow:0 8px 24px rgba(20,35,80,.06)}h3{margin-top:26px}.grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}label{display:block;font-weight:650}input,select{display:block;width:100%;box-sizing:border-box;margin-top:6px;padding:11px 12px;border:1px solid #ccd3e0;border-radius:9px;background:#fff}.toggle input{display:inline;width:auto;margin-right:8px}.hint{color:#667085}.notice{padding:12px 14px;border-radius:10px;margin:12px 0}.ok{background:#e9f8ef}.err{background:#fff0f0}.save{border:0;background:#2156c8;color:#fff;padding:13px 22px;border-radius:10px;font-weight:750;cursor:pointer}.security{font-size:13px;color:#667085}@media(max-width:720px){.grid{grid-template-columns:1fr}.wrap{margin-top:18px}}
</style></head><body><div class="wrap">
<div class="top"><h1>Forsk Lead Integrations Setup</h1><p>Academic and College Admission databases + SMTP are isolated. Credentials are stored only on the server in <code>storage/private/integrations.php</code>.</p></div>
<?php if($message): ?><div class="notice ok"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if($error): ?><div class="notice err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post">
<input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
<input type="hidden" name="setup_key" value="<?= htmlspecialchars($providedKey, ENT_QUOTES, 'UTF-8') ?>">
<?php forsk_setup_panel('academic','Academic / Course / Internship System',$settings); ?>
<?php forsk_setup_panel('college','College Admissions System',$settings); ?>
<button class="save" type="submit">Save Both Configurations</button>
</form>
<p class="security"><strong>Security:</strong> In production set <code>FORSK_SETUP_KEY</code> in the hosting environment. Do not place database or SMTP passwords in GitHub. If external DB is disabled, leads are safely separated into local academic/college JSONL fallback files.</p>
</div></body></html>
