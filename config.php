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

$hostHeader = strtolower((string)($_SERVER['HTTP_HOST'] ?? 'localhost'));
$hostOnly = preg_replace('/:\\d+$/', '', trim($hostHeader, '[]'));
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