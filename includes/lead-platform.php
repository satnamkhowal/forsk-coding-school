<?php
require_once dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/smtp-mailer.php';

/**
 * Lead integrations are intentionally separated by channel:
 * - academic: courses + internships
 * - college: BCA/MCA/B.Tech/BBA admission assistance
 *
 * Runtime credentials are written to storage/private/integrations.php by
 * admin/integrations-setup.php. That file is gitignored and web access is denied.
 */
function forsk_lead_default_settings(): array {
    $channel = static fn(string $table): array => [
        'database' => [
            'enabled' => false,
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => '3306',
            'database' => '',
            'username' => '',
            'password' => '',
            'table' => $table,
        ],
        'smtp' => [
            'enabled' => false,
            'host' => '',
            'port' => '587',
            'encryption' => 'tls',
            'username' => '',
            'password' => '',
            'from_email' => 'info@forskcodingschool.com',
            'from_name' => 'Forsk Coding School',
            'recipient' => 'info@forskcodingschool.com',
        ],
    ];
    return [
        'academic' => $channel('academic_leads'),
        'college' => $channel('college_admission_leads'),
    ];
}

function forsk_lead_settings(): array {
    static $settings = null;
    if (is_array($settings)) return $settings;
    $settings = forsk_lead_default_settings();
    $runtimeFile = dirname(__DIR__) . '/storage/private/integrations.php';
    if (is_file($runtimeFile)) {
        $loaded = require $runtimeFile;
        if (is_array($loaded)) $settings = array_replace_recursive($settings, $loaded);
    }
    return $settings;
}

function forsk_lead_channel_settings(string $channel): array {
    $settings = forsk_lead_settings();
    return $settings[$channel] ?? $settings['academic'];
}

function forsk_lead_safe_table(string $table): string {
    return preg_match('/^[A-Za-z0-9_]+$/', $table) ? $table : 'leads';
}

function forsk_store_lead(string $channel, array $record): bool {
    $channel = $channel === 'college' ? 'college' : 'academic';
    $cfg = forsk_lead_channel_settings($channel);
    $db = $cfg['database'] ?? [];
    $stored = false;

    if (!empty($db['enabled']) && class_exists('PDO')) {
        try {
            $driver = strtolower((string)($db['driver'] ?? 'mysql'));
            if ($driver !== 'mysql') throw new RuntimeException('Only mysql is enabled in the setup UI.');
            $host = (string)($db['host'] ?? 'localhost');
            $port = (string)($db['port'] ?? '3306');
            $name = (string)($db['database'] ?? '');
            $user = (string)($db['username'] ?? '');
            $pass = (string)($db['password'] ?? '');
            if ($name === '' || $user === '') throw new RuntimeException('Database name/username not configured.');
            $pdo = new PDO(
                'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $name . ';charset=utf8mb4',
                $user,
                $pass,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
            $table = forsk_lead_safe_table((string)($db['table'] ?? ($channel . '_leads')));
            $pdo->exec("CREATE TABLE IF NOT EXISTS `$table` (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                submitted_at VARCHAR(40) NOT NULL,
                lead_channel VARCHAR(20) NOT NULL,
                name VARCHAR(120) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                email VARCHAR(190) NOT NULL,
                city VARCHAR(120) NULL,
                qualification VARCHAR(190) NULL,
                interest VARCHAR(190) NULL,
                source_page TEXT NULL,
                payload_json LONGTEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_phone (phone),
                INDEX idx_email (email),
                INDEX idx_interest (interest)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
            $stmt = $pdo->prepare("INSERT INTO `$table`
                (submitted_at, lead_channel, name, phone, email, city, qualification, interest, source_page, payload_json)
                VALUES (:submitted_at,:lead_channel,:name,:phone,:email,:city,:qualification,:interest,:source_page,:payload_json)");
            $stmt->execute([
                ':submitted_at' => (string)($record['submitted_at'] ?? gmdate('c')),
                ':lead_channel' => $channel,
                ':name' => (string)($record['name'] ?? ''),
                ':phone' => (string)($record['phone'] ?? ''),
                ':email' => (string)($record['email'] ?? ''),
                ':city' => (string)($record['city'] ?? ''),
                ':qualification' => (string)($record['qualification'] ?? ''),
                ':interest' => (string)($record['interest'] ?? ''),
                ':source_page' => (string)($record['source_page'] ?? ''),
                ':payload_json' => json_encode($record, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}',
            ]);
            $stored = true;
        } catch (Throwable $e) {
            error_log('Forsk ' . $channel . ' database lead storage failed: ' . $e->getMessage());
        }
    }

    if (!$stored) {
        $dir = dirname(__DIR__) . '/storage/leads';
        if (!is_dir($dir)) @mkdir($dir, 0750, true);
        $file = $dir . '/' . $channel . '-leads-' . gmdate('Y-m') . '.jsonl';
        $json = json_encode($record, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $stored = $json !== false && @file_put_contents($file, $json . PHP_EOL, FILE_APPEND | LOCK_EX) !== false;
    }
    return $stored;
}

function forsk_send_lead_notification(string $channel, array $record): bool {
    $channel = $channel === 'college' ? 'college' : 'academic';
    $cfg = forsk_lead_channel_settings($channel);
    $smtp = $cfg['smtp'] ?? [];
    $recipient = trim((string)($smtp['recipient'] ?? 'info@forskcodingschool.com'));
    $subject = $channel === 'college'
        ? 'New College Admission Enquiry - Forsk Coding School'
        : 'New Academic / Internship Enquiry - Forsk Coding School';

    $lines = [
        'Channel: ' . strtoupper($channel),
        'Name: ' . (string)($record['name'] ?? ''),
        'Phone: ' . (string)($record['phone'] ?? ''),
        'Email: ' . (string)($record['email'] ?? ''),
        'City: ' . (string)($record['city'] ?? ''),
        'Qualification: ' . (string)($record['qualification'] ?? ''),
        'Interest: ' . (string)($record['interest'] ?? ''),
        'Source: ' . (string)($record['source_page'] ?? ''),
        'UTM Source: ' . (string)($record['utm_source'] ?? ''),
        'UTM Campaign: ' . (string)($record['utm_campaign'] ?? ''),
        '',
        'Message:',
        (string)($record['message'] ?? ''),
    ];
    $body = implode("\n", $lines);

    if (!empty($smtp['enabled'])) {
        return forsk_smtp_send($smtp, $recipient, $subject, $body, (string)($record['email'] ?? ''));
    }

    if (function_exists('mail') && $recipient !== '') {
        $reply = filter_var((string)($record['email'] ?? ''), FILTER_VALIDATE_EMAIL) ? (string)$record['email'] : '';
        $headers = ['Content-Type: text/plain; charset=UTF-8', 'From: Forsk Coding School <info@forskcodingschool.com>'];
        if ($reply !== '') $headers[] = 'Reply-To: ' . str_replace(["\r", "\n"], '', $reply);
        return @mail($recipient, $subject, $body, implode("\r\n", $headers));
    }
    return false;
}
