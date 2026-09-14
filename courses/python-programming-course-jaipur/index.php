<?php
/**
 * Legacy course URL consolidation.
 *
 * Keep this route available only to transfer old links and crawl signals to the
 * maintained canonical Python Programming course page. Do not add content here.
 */
require_once dirname(__DIR__, 2) . '/config.php';

header('Location: ' . site_url('python-programming-course-jaipur.php'), true, 301);
exit;
