<?php
/**
 * Forsk Coding School central URL configuration.
 * Change only these values when moving environments.
 */
$FORSK_LOCAL_URL = 'http://localhost:81/forsk-coding-school';
$FORSK_LIVE_URL  = 'https://forskcodingschool.com';

if (!defined('BASE_URL')) {
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $is_local = (stripos($host, 'localhost') === 0 || stripos($host, '127.0.0.1') === 0);
    define('BASE_URL', rtrim($is_local ? $FORSK_LOCAL_URL : $FORSK_LIVE_URL, '/'));
}

if (!function_exists('site_url')) {
    function site_url(string $path = ''): string {
        return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
    }
}
if (!function_exists('asset_url')) {
    function asset_url(string $path = ''): string {
        return site_url('assets/' . ltrim($path, '/'));
    }
}
if (!function_exists('blog_url')) {
    function blog_url(string $slug = ''): string {
        return site_url('blog/' . trim($slug, '/') . '/');
    }
}
