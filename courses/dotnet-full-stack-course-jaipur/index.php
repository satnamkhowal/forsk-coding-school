<?php
/**
 * Legacy LearnPress ASP.NET/.NET Full Stack URL.
 *
 * The maintained, canonical course page lives at /dotnet-full-stack-course-jaipur.php.
 * Keep this route lightweight so historical links and crawl signals consolidate
 * without recreating the retired LMS/ecommerce surface.
 */
require_once dirname(__DIR__, 2) . '/config.php';

header('Location: ' . site_url('/dotnet-full-stack-course-jaipur.php'), true, 301);
exit;
