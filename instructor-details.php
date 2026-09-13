<?php
/**
 * Legacy instructor-detail compatibility redirect.
 *
 * The retired template page contained unverified instructor identities,
 * employment history, learner counts, ratings and ecommerce-style course
 * claims. Keep the URL crawlable only long enough for search engines and old
 * links to consolidate into the maintained mentor directory.
 */
require_once __DIR__ . '/config.php';

$target = site_url('mentors/');
header('Location: ' . $target, true, 301);
exit;
