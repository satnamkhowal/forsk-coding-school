<?php
/**
 * Legacy template URL.
 * Forsk Coding School does not publish generic subscription pricing at this URL.
 * Consolidate visitors and search signals on the maintained course catalogue,
 * where course-specific admission and fee information can be requested.
 */
require_once __DIR__ . '/config.php';

header('Location: ' . site_url('courses.php'), true, 301);
exit;
