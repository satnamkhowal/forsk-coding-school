<?php
require_once dirname(__DIR__) . '/config.php';
$page_title = trim((string)($page_title ?? 'Forsk Coding School | Coding & IT Courses in Jaipur'));
$page_description = trim((string)($page_description ?? 'Practical coding, IT and career-focused learning from Forsk Coding School in Jaipur.'));
$page_keywords = trim((string)($page_keywords ?? 'Forsk Coding School Jaipur, coding courses Jaipur, IT training Jaipur'));
$page_robots = trim((string)($page_robots ?? 'index, follow, max-image-preview:large'));
$page_type = trim((string)($page_type ?? 'website'));
$page_schema = $page_schema ?? '';

if (IS_LOCAL) $page_robots = 'noindex, nofollow, noarchive';
if (!IS_LOCAL && stripos($page_robots, 'noindex') === false) {
    foreach (['max-snippet:-1','max-image-preview:large','max-video-preview:-1'] as $directive) {
        if (stripos($page_robots, $directive) === false) $page_robots .= ', ' . $directive;
    }
}

if (empty($page_canonical)) {
    $uri=parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
    if (IS_LOCAL) {
        $lp='/' . trim(LOCAL_PROJECT_PATH,'/');
        if ($lp !== '/' && str_starts_with($uri,$lp)) $uri=substr($uri,strlen($lp)) ?: '/';
    }
    $page_canonical=seo_url($uri);
} elseif (!preg_match('#^https?://#i', (string)$page_canonical)) {
    $page_canonical=seo_url((string)$page_canonical);
} else {
    $page_canonical=seo_url((string)$page_canonical);
}

$page_og_image = (string)($page_og_image ?? seo_url('assets/images/logos/forsk-icon.png'));
if (!preg_match('#^https?://#i', $page_og_image)) {
    $page_og_image=seo_url($page_og_image);
} else {
    $og=parse_url($page_og_image);
    $ogHost=strtolower((string)($og['host'] ?? ''));
    $liveHost=strtolower((string)(parse_url(SEO_BASE_URL,PHP_URL_HOST) ?: ''));
    $ogLocal=in_array($ogHost,['localhost','127.0.0.1','::1'],true) || str_ends_with($ogHost,'.localhost') || str_ends_with($ogHost,'.test');
    if ($ogHost===$liveHost || $ogLocal) $page_og_image=seo_url($page_og_image);
}
$canonicalPath = (string)(parse_url($page_canonical, PHP_URL_PATH) ?: '/');
if ($canonicalPath === '/blog' || str_starts_with($canonicalPath, '/blog/')) {
    $llms_describedby = seo_url('blog/llms.txt');
} elseif ($canonicalPath === '/mentors' || str_starts_with($canonicalPath, '/mentors/')) {
    $llms_describedby = seo_url('mentors/llms.txt');
} else {
    $llms_describedby = seo_url('llms.txt');
}
?>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="<?= htmlspecialchars(BASE_URL . '/', ENT_QUOTES, 'UTF-8') ?>">
<meta name="author" content="Forsk Coding School">
<meta name="description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($page_keywords !== ''): ?><meta name="keywords" content="<?= htmlspecialchars($page_keywords, ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
<meta name="robots" content="<?= htmlspecialchars($page_robots, ENT_QUOTES, 'UTF-8') ?>">
<meta name="googlebot" content="<?= htmlspecialchars($page_robots, ENT_QUOTES, 'UTF-8') ?>">
<title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
<link rel="canonical" href="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
<link rel="describedby" href="<?= htmlspecialchars($llms_describedby, ENT_QUOTES, 'UTF-8') ?>">
<link rel="sitemap" type="application/xml" href="<?= htmlspecialchars(seo_url('sitemap.xml'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="alternate" hreflang="en-IN" href="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="<?= htmlspecialchars($page_type, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:site_name" content="Forsk Coding School">
<meta property="og:locale" content="en_IN">
<meta property="og:image" content="<?= htmlspecialchars($page_og_image, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image:alt" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($page_og_image, ENT_QUOTES, 'UTF-8') ?>">
<link rel="shortcut icon" type="image/png" href="<?= htmlspecialchars(asset_url('images/logos/forsk-icon.png'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/bootstrap.min.css'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/edunex-icons.css'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/nice-select.css'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/swiper.min.css'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/venobox.min.css'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/meanmenu.css'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/main.css'), ENT_QUOTES, 'UTF-8') ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/local-fix.css'), ENT_QUOTES, 'UTF-8') ?>">
<?php if ($page_schema): ?><script type="application/ld+json"><?= $page_schema ?></script><?php endif; ?>
