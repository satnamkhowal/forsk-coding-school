<?php
/**
 * Forsk Coding School — centralized runtime + SEO URL configuration.
 * Local host/port are detected automatically; edit LOCAL_PROJECT_PATH only
 * if the local project folder changes.
 */
if (defined('FORSK_CONFIG_LOADED')) return;
define('FORSK_CONFIG_LOADED', true);

define('SITE_NAME', 'Forsk Coding School');
define('LIVE_SITE_URL', 'https://forskcodingschool.com');
define('LOCAL_PROJECT_PATH', '/forsk-coding-school');
define('SITE_LANGUAGE', 'en-IN');

// Canonical first-party identity. Keep NAP details here so templates and
// structured data cannot drift between course, contact and branch surfaces.
define('SITE_PHONE_E164', '+917231968183');
define('SITE_PHONE_DISPLAY', '+91 72319 68183');
define('SITE_EMAIL', 'info@forskcodingschool.com');
define('SITE_LOCALITY', 'Jaipur');
define('SITE_REGION', 'Rajasthan');
define('SITE_COUNTRY', 'IN');
define('SITE_PRIMARY_AREA', 'Shyam Nagar');
define('SITE_STREET_ADDRESS', 'F1, Forsk Coding School, New Sanganer Rd, F Block, Shyam Nagar');
define('SITE_POSTAL_CODE', '302019');
define('SITE_ORGANIZATION_ID', rtrim(LIVE_SITE_URL, '/') . '/#organization');

/**
 * Read a runtime environment value robustly across Apache/FPM/hosting panels.
 * Falls back to storage/private/.env, which is protected from direct web access.
 */
if (!function_exists('forsk_env_value')) {
    function forsk_env_value(string $key, string $default = ''): string {
        $value = getenv($key);
        if ($value !== false && trim((string)$value) !== '') return trim((string)$value);

        foreach ([$_SERVER ?? [], $_ENV ?? []] as $source) {
            if (isset($source[$key]) && trim((string)$source[$key]) !== '') {
                $value = trim((string)$source[$key]);
                @putenv($key . '=' . $value);
                return $value;
            }
        }

        $envFile = __DIR__ . '/storage/private/.env';
        if (is_readable($envFile)) {
            $lines = @file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (is_array($lines)) {
                foreach ($lines as $line) {
                    $line = trim((string)$line);
                    if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) continue;
                    [$name, $raw] = array_map('trim', explode('=', $line, 2));
                    if ($name !== $key) continue;
                    if (strlen($raw) >= 2) {
                        $first = $raw[0];
                        $last = $raw[strlen($raw) - 1];
                        if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                            $raw = substr($raw, 1, -1);
                        }
                    }
                    $value = trim($raw);
                    if ($value !== '') {
                        $_ENV[$key] = $value;
                        $_SERVER[$key] = $value;
                        @putenv($key . '=' . $value);
                        return $value;
                    }
                }
            }
        }

        return $default;
    }
}

// Prime the installer key once so legacy setup code using getenv() also works.
$runtimeSetupKey = forsk_env_value('FORSK_SETUP_KEY');
if ($runtimeSetupKey !== '') @putenv('FORSK_SETUP_KEY=' . $runtimeSetupKey);

$hostHeader = strtolower((string)($_SERVER['HTTP_HOST'] ?? 'localhost'));
$hostOnly = preg_replace('/:\d+$/', '', trim($hostHeader, '[]'));
$isLocal = in_array($hostOnly, ['localhost','127.0.0.1','::1'], true)
    || str_ends_with($hostOnly, '.localhost') || str_ends_with($hostOnly, '.test');
define('IS_LOCAL', $isLocal);

$isHttps = (!empty($_SERVER['HTTPS']) && strtolower((string)$_SERVER['HTTPS']) !== 'off')
    || (string)($_SERVER['SERVER_PORT'] ?? '') === '443'
    || strtolower((string)($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https';

if (IS_LOCAL) {
    $scheme = $isHttps ? 'https' : 'http';
    $requestHost = (string)($_SERVER['HTTP_HOST'] ?? 'localhost');
    $localPath = '/' . trim(LOCAL_PROJECT_PATH, '/');
    if ($localPath === '/') $localPath = '';
    define('BASE_URL', rtrim($scheme . '://' . $requestHost . $localPath, '/'));
} else {
    define('BASE_URL', rtrim(LIVE_SITE_URL, '/'));
}
define('SEO_BASE_URL', rtrim(LIVE_SITE_URL, '/'));
$base_url = BASE_URL;

if (!function_exists('site_url')) {
    function site_url(string $path=''): string {
        if ($path === '' || $path === '/') return BASE_URL . '/';
        if (preg_match('#^https?://#i', $path)) return $path;
        return BASE_URL . '/' . ltrim($path, '/');
    }
}
if (!function_exists('seo_url')) {
    function seo_url(string $path=''): string {
        if ($path === '' || $path === '/') return SEO_BASE_URL . '/';
        if (preg_match('#^https?://#i', $path)) {
            $p=parse_url($path);
            $srcHost=strtolower((string)($p['host'] ?? ''));
            $path=(string)($p['path'] ?? '/');
            $isSrcLocal=in_array($srcHost,['localhost','127.0.0.1','::1'],true) || str_ends_with($srcHost,'.localhost') || str_ends_with($srcHost,'.test');
            if ($isSrcLocal) {
                $lp='/' . trim(LOCAL_PROJECT_PATH,'/');
                if ($lp !== '/' && ($path === $lp || str_starts_with($path,$lp.'/'))) {
                    $path=substr($path,strlen($lp)) ?: '/';
                }
            }
        }
        return SEO_BASE_URL . '/' . ltrim($path, '/');
    }
}
if (!function_exists('asset_url')) {
    function asset_url(string $path=''): string { return site_url('assets/' . ltrim($path,'/')); }
}
if (!function_exists('blog_url')) {
    function blog_url(string $slug=''): string {
        $slug=trim($slug,'/');
        return $slug==='' ? site_url('blog/') : site_url('blog/'.$slug.'/');
    }
}
if (!function_exists('blog_seo_url')) {
    function blog_seo_url(string $slug=''): string {
        $slug=trim($slug,'/');
        return $slug==='' ? seo_url('blog/') : seo_url('blog/'.$slug.'/');
    }
}
if (!function_exists('blog_image_url')) {
    function blog_image_url(string $filename=''): string { return site_url('blog/images/' . ltrim($filename,'/')); }
}
if (!function_exists('blog_image_seo_url')) {
    function blog_image_seo_url(string $filename=''): string { return seo_url('blog/images/' . ltrim($filename,'/')); }
}
if (!function_exists('mentor_image_url')) {
    function mentor_image_url(string $filename=''): string { return site_url('mentors/images/' . ltrim($filename,'/')); }
}
?>