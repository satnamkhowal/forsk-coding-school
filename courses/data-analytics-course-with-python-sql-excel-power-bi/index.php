<?php
/**
 * Legacy course URL consolidation.
 *
 * This historical LearnPress route targets the same Data Analytics intent as the
 * maintained Forsk Coding School Data Analytics course page. Keep this endpoint
 * content-free so old links and crawl signals consolidate on the canonical page.
 */
require_once dirname(__DIR__, 2) . '/config.php';

header('Location: ' . site_url('data-analytics-course-jaipur.php'), true, 301);
exit;
