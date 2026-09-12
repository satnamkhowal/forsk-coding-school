<?php
/**
 * Legacy instructor directory.
 *
 * The old template page contained demo instructor counts, ratings and hourly
 * pricing that are not part of Forsk Coding School's verified public content.
 * Keep this URL only as a permanent compatibility redirect so old links and
 * bookmarks consolidate into the maintained mentors directory.
 */
require_once __DIR__ . '/config.php';

$target = site_url('mentors/');
header('Location: ' . $target, true, 301);
exit;
