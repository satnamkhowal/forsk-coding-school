<?php
/**
 * Forsk Coding School homepage entry point.
 *
 * Apache/Hostinger currently uses default.php as the DirectoryIndex for `/`.
 * Only redirect when a visitor explicitly requests /default.php. When this file
 * is loaded internally for the root homepage, render the homepage normally.
 */
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

if ($requestPath === '/default.php') {
    header('Location: /', true, 301);
    exit;
}

require __DIR__ . '/includes/homepage.php';
