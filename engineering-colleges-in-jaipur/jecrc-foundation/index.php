<?php
$category = require dirname(__DIR__) . '/data.php';
require_once dirname(__DIR__, 2) . '/includes/college-pages.php';
$collegeSlug = basename(__DIR__);
$college = null;
foreach ($category['colleges'] as $item) {
    if (($item['slug'] ?? '') === $collegeSlug) { $college = $item; break; }
}
if (!$college) { http_response_code(404); exit('College page not found'); }
forsk_render_college_detail($category, $college);
