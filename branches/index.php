<?php
$root = dirname(__DIR__);
$branches = require __DIR__ . '/data/branches.php';
$page_title = 'Forsk Coding School Branches | Jaipur Coding & IT Training';
$page_description = 'Find verified Forsk Coding School physical branches. View the Shyam Nagar, Jaipur branch, location information and official course links.';
$page_canonical = 'https://forskcodingschool.com/branches/';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => 'Forsk Coding School Branches',
    'url' => $page_canonical,
    'description' => $page_description,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php include $root . '/includes/head.php'; ?>
</head>
<body>
<?php include $root . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content"><main id="primary" class="site-main">
<div class="space-for-header"></div>
<section class="tj-page-header tj-page-header-2"><div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
<div class="tj-page-link"><span><a href="/">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span>Branches</span></div>
<h1 class="tj-page-title">Forsk Coding School Branches</h1>
<p class="tj-page-desc">Browse verified physical Forsk Coding School locations. Only confirmed operating branches are listed here.</p>
</div></div></div></div></section>
<section class="section-gap"><div class="container"><div class="row rg-30">
<?php foreach ($branches as $slug => $branch): ?>
<div class="col-lg-6"><article class="tj-course-item"><div class="tj-course-content">
<div class="tj-categories"><span class="tj-cat">Verified physical branch</span></div>
<h2 class="title tj-fs-h4"><a href="/branches/<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8') ?>/"><?= htmlspecialchars($branch['area'] . ', ' . $branch['city'], ENT_QUOTES, 'UTF-8') ?></a></h2>
<p><?= htmlspecialchars($branch['address'], ENT_QUOTES, 'UTF-8') ?></p>
<a class="tj-btn-primary tj-btn-primary-md flip-text-wrap" href="/branches/<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8') ?>/"><span class="btn-text">View branch</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
</div></article></div>
<?php endforeach; ?>
</div></div></section>
<section class="section-gap-bottom"><div class="container"><div class="row"><div class="col-lg-8"><h2>Explore courses in Jaipur</h2><p>Branch visitors can continue directly to practical learning programs in programming, data, AI and full stack development.</p><p><a href="/courses.php">Browse all courses</a> &nbsp; <a href="/python-programming-course-jaipur.php">Python</a> &nbsp; <a href="/data-analytics-course-jaipur.php">Data Analytics</a> &nbsp; <a href="/full-stack-development-course-jaipur.php">Full Stack Development</a></p></div></div></div></section>
</main><?php include $root . '/includes/footer.php'; ?></div></div>
</body></html>
