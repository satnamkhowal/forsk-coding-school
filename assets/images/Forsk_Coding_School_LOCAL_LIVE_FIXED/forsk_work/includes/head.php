<?php
/*
 * Forsk Coding School - environment-aware site URL.
 * Local  : http://localhost:81/forsk-coding-school
 * Live   : https://forskcodingschool.com
 *
 * Keep all HTML asset/link paths relative (assets/..., index.php, etc.).
 * The <base> tag below makes them resolve from the site root even when a
 * PHP page lives inside /blog/<slug>/ or another nested directory.
 */
$host = $_SERVER['HTTP_HOST'] ?? '';
$base_url = (preg_match('/^localhost(?::\d+)?$/i', $host))
    ? 'http://localhost:81/forsk-coding-school'
    : 'https://forskcodingschool.com';

$page_title = $page_title ?? 'Forsk Coding School | Best Coding, IT & Digital Marketing Institute in Jaipur';
$page_description = $page_description ?? 'Forsk Coding School in Jaipur offers practical, career-focused training in programming, full stack development, data science, AI, cloud, cybersecurity, software testing, digital marketing, UI/UX and mobile app development.';
$page_keywords = $page_keywords ?? 'Forsk Coding School Jaipur, coding institute Jaipur, IT courses Jaipur, programming courses Jaipur, software training Jaipur';
$page_canonical = $page_canonical ?? '';
$page_schema = $page_schema ?? '';
$page_robots = $page_robots ?? 'index, follow, max-image-preview:large';
$page_og_image = $page_og_image ?? $base_url . '/assets/images/logos/forsk-icon.png';

// Make legacy hard-coded canonical/OG/schema URLs follow the active host.
$page_canonical = $page_canonical ? preg_replace('#https?://forskcodingschool\.com#i', $base_url, $page_canonical) : $page_canonical;
if ($page_canonical && !preg_match('#^https?://#i', $page_canonical)) {
    $page_canonical = rtrim($base_url, '/') . '/' . ltrim($page_canonical, '/');
}
$page_og_image = preg_replace('#https?://forskcodingschool\.com#i', $base_url, $page_og_image);
if ($page_schema) {
    $page_schema = str_replace('https://forskcodingschool.com', $base_url, $page_schema);
    $page_schema = str_replace('http://forskcodingschool.com', $base_url, $page_schema);
}
?>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="<?= htmlspecialchars($base_url . '/', ENT_QUOTES, 'UTF-8') ?>">
<meta name="author" content="Forsk Coding School">
<meta name="description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
<meta name="keywords" content="<?= htmlspecialchars($page_keywords, ENT_QUOTES, 'UTF-8') ?>">
<meta name="robots" content="<?= htmlspecialchars($page_robots, ENT_QUOTES, 'UTF-8') ?>">
<title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
<?php if ($page_canonical): ?>
<link rel="canonical" href="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>
<meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Forsk Coding School">
<meta property="og:locale" content="en_IN">
<meta property="og:image" content="<?= htmlspecialchars($page_og_image, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image:alt" content="Forsk Coding School">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($page_og_image, ENT_QUOTES, 'UTF-8') ?>">
<link rel="shortcut icon" type="image/png" href="assets/images/logos/forsk-icon.png">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/edunex-icons.css">
<link rel="stylesheet" href="assets/css/nice-select.css">
<link rel="stylesheet" href="assets/css/swiper.min.css">
<link rel="stylesheet" href="assets/css/venobox.min.css">
<link rel="stylesheet" href="assets/css/meanmenu.css">
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/local-fix.css">
<?php if ($page_schema): ?>
<script type="application/ld+json"><?= $page_schema ?></script>
<?php endif; ?>
