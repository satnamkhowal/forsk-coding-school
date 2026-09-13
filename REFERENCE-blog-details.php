<?php
/**
 * Legacy reference blog-detail template.
 *
 * This file previously exposed generic LMS demo metadata, placeholder author
 * details and template content. Keep the historical URL only as a permanent
 * compatibility redirect so accidental visits consolidate into the maintained
 * knowledge hub instead of creating a thin/duplicate public page.
 */
require_once __DIR__ . '/config.php';

$target = blog_url();
header('Location: ' . $target, true, 301);
exit;
