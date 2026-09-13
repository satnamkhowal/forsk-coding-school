<?php
/**
 * Lightweight SMTP sender used by the lead system.
 * No third-party dependency is required. Supports plain, STARTTLS and implicit SSL.
 */
if (!function_exists('forsk_smtp_send')) {
    function forsk_smtp_send(array $smtp, string $to, string $subject, string $body, string $replyTo = ''): bool {
        $host = trim((string)($smtp['host'] ?? ''));
        $port = (int)($smtp['port'] ?? 587);
        $encryption = strtolower(trim((string)($smtp['encryption'] ?? 'tls')));
        $username = trim((string)($smtp['username'] ?? ''));
        $password = (string)($smtp['password'] ?? '');
        $fromEmail = trim((string)($smtp['from_email'] ?? $username));
        $fromName = trim((string)($smtp['from_name'] ?? 'Forsk Coding School'));

        if ($host === '' || $to === '' || $fromEmail === '') return false;
        $target = ($encryption === 'ssl' ? 'ssl://' : '') . $host . ':' . $port;
        $socket = @stream_socket_client($target, $errno, $errstr, 15, STREAM_CLIENT_CONNECT);
        if (!$socket) {
            error_log('Forsk SMTP connection failed: ' . $errstr);
            return false;
        }
        stream_set_timeout($socket, 15);

        $read = static function ($socket): string {
            $response = '';
            while (($line = fgets($socket, 515)) !== false) {
                $response .= $line;
                if (strlen($line) < 4 || $line[3] === ' ') break;
            }
            return $response;
        };
        $expect = static function (string $response, array $codes): bool {
            return in_array((int)substr($response, 0, 3), $codes, true);
        };
        $command = static function ($socket, callable $read, callable $expect, string $cmd, array $codes): bool {
            fwrite($socket, $cmd . "\r\n");
            return $expect($read($socket), $codes);
        };

        if (!$expect($read($socket), [220])) { fclose($socket); return false; }
        $hostName = (string)($_SERVER['SERVER_NAME'] ?? 'forskcodingschool.com');
        if (!$command($socket, $read, $expect, 'EHLO ' . $hostName, [250])) {
            fclose($socket); return false;
        }

        if ($encryption === 'tls') {
            if (!$command($socket, $read, $expect, 'STARTTLS', [220])) { fclose($socket); return false; }
            if (!@stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                fclose($socket); return false;
            }
            if (!$command($socket, $read, $expect, 'EHLO ' . $hostName, [250])) { fclose($socket); return false; }
        }

        if ($username !== '') {
            if (!$command($socket, $read, $expect, 'AUTH LOGIN', [334])) { fclose($socket); return false; }
            if (!$command($socket, $read, $expect, base64_encode($username), [334])) { fclose($socket); return false; }
            if (!$command($socket, $read, $expect, base64_encode($password), [235])) { fclose($socket); return false; }
        }

        if (!$command($socket, $read, $expect, 'MAIL FROM:<' . $fromEmail . '>', [250])) { fclose($socket); return false; }
        if (!$command($socket, $read, $expect, 'RCPT TO:<' . $to . '>', [250, 251])) { fclose($socket); return false; }
        if (!$command($socket, $read, $expect, 'DATA', [354])) { fclose($socket); return false; }

        $safeFromName = str_replace(["\r", "\n", '"'], '', $fromName);
        $safeSubject = str_replace(["\r", "\n"], ' ', $subject);
        $safeReply = str_replace(["\r", "\n"], '', $replyTo);
        $headers = [
            'Date: ' . date(DATE_RFC2822),
            'From: "' . $safeFromName . '" <' . $fromEmail . '>',
            'To: <' . $to . '>',
            'Subject: ' . $safeSubject,
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'Content-Transfer-Encoding: 8bit',
        ];
        if ($safeReply !== '' && filter_var($safeReply, FILTER_VALIDATE_EMAIL)) {
            $headers[] = 'Reply-To: ' . $safeReply;
        }
        $payload = implode("\r\n", $headers) . "\r\n\r\n" . str_replace("\n.", "\n..", $body) . "\r\n.";
        fwrite($socket, $payload . "\r\n");
        $ok = $expect($read($socket), [250]);
        $command($socket, $read, $expect, 'QUIT', [221, 250]);
        fclose($socket);
        return $ok;
    }
}
