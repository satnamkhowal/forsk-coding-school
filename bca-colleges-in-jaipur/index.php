<?php
$category = require __DIR__ . '/data.php';
require_once dirname(__DIR__) . '/includes/college-pages.php';
forsk_render_college_listing($category);
