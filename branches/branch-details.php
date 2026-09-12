<?php
$root = dirname(__DIR__);
$branches = require __DIR__ . '/data/branches.php';
$branch_slug = $branch_slug ?? '';
if (!isset($branches[$branch_slug]) || ($branches[$branch_slug]['status'] ?? '') !== 'verified') {
    http_response_code(404);
    $page_title = 'Branch Not Found | Forsk Coding School';
    $page_description = 'The requested Forsk Coding School branch could not be found.';
    $page_canonical = 'https://forskcodingschool.com/branches/';
    $page_schema = '';
    $header_variant = 'header-1';
    ?><!DOCTYPE html><html lang="en"><head><?php include $root . '/includes/head.php'; ?></head><body><?php include $root . '/includes/header.php'; ?><main class="site-main"><div class="space-for-header"></div><section class="section-gap"><div class="container"><h1>Branch not found</h1><p>Please use the verified <a href="/branches/">Forsk Coding School branches directory</a>.</p></div></section></main><?php include $root . '/includes/footer.php'; ?></body></html><?php
    return;
}

$branch = $branches[$branch_slug];
$page_title = 'Forsk Coding School ' . $branch['area'] . ' Jaipur | Coding & IT Courses';
$page_description = 'Visit Forsk Coding School in ' . $branch['area'] . ', ' . $branch['city'] . ' for practical coding, data analytics, AI, Python, full stack and IT training. View location and course links.';
$page_canonical = $branch['canonical'];
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'EducationalOrganization',
            '@id' => $page_canonical . '#branch',
            'name' => $branch['name'],
            'url' => $page_canonical,
            'email' => $branch['email'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'F1, Forsk Coding School, New Sanganer Rd, F Block',
                'addressLocality' => $branch['city'],
                'addressRegion' => $branch['state'],
                'postalCode' => $branch['postal_code'],
                'addressCountry' => 'IN',
            ],
        ],
        [
            '@type' => 'WebPage',
            '@id' => $page_canonical . '#webpage',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'about' => ['@id' => $page_canonical . '#branch'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://forskcodingschool.com/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Branches', 'item' => 'https://forskcodingschool.com/branches/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $branch['area'] . ', ' . $branch['city'], 'item' => $page_canonical],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head><?php include $root . '/includes/head.php'; ?></head>
<body>
<?php include $root . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content"><main id="primary" class="site-main">
<div class="space-for-header"></div>
<section class="tj-page-header tj-page-header-2"><div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
<div class="tj-page-link"><span><a href="/">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span><a href="/branches/">Branches</a></span><span><i class="tji-arrow-right-4"></i></span><span><?= htmlspecialchars($branch['area'], ENT_QUOTES, 'UTF-8') ?></span></div>
<div class="tj-categories"><span class="tj-cat">Verified Jaipur branch</span></div>
<h1 class="tj-page-title">Forsk Coding School in <?= htmlspecialchars($branch['area'] . ', ' . $branch['city'], ENT_QUOTES, 'UTF-8') ?></h1>
<p class="tj-page-desc">Practical, career-focused coding and IT learning in Jaipur with structured training, projects and mentor guidance.</p>
</div></div></div></div></section>
<section class="section-gap"><div class="container"><div class="row rg-30"><div class="col-lg-8">
<h2>Shyam Nagar, Jaipur branch</h2>
<p><strong>Address:</strong> <?= htmlspecialchars($branch['address'], ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?></a></p>
<p>For current batch timings, fees, admission support and the latest contact number, use the official contact page so branch information remains synchronized with the live website.</p>
<p><a class="tj-btn-primary tj-btn-primary-md flip-text-wrap" href="<?= htmlspecialchars($branch['contact_url'], ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Contact Forsk Coding School</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></p>
<h2>Popular learning paths</h2>
<ul class="course-details-list">
<li><a href="/python-programming-course-jaipur.php">Python Programming Course in Jaipur</a></li>
<li><a href="/data-analytics-course-jaipur.php">Data Analytics Course in Jaipur</a></li>
<li><a href="/data-science-course-jaipur.php">Data Science Course in Jaipur</a></li>
<li><a href="/machine-learning-course-jaipur.php">Machine Learning Course in Jaipur</a></li>
<li><a href="/full-stack-development-course-jaipur.php">Full Stack Development Course in Jaipur</a></li>
<li><a href="/courses.php">View all Forsk Coding School courses</a></li>
</ul>
<h2>Learning resources</h2>
<p>Students can also use the <a href="/blog/">Forsk Coding School blog</a> for course-related guides, learning roadmaps, common mistakes and practical career resources.</p>
</div><div class="col-lg-4"><aside class="tj-course-sidebar"><div class="course-sidebar-inner"><h3 class="title">Planning a visit?</h3><p>Confirm the latest batch schedule and admission availability before travelling.</p><a href="/contact/">Contact the team</a></div></aside></div></div></div></section>
</main><?php include $root . '/includes/footer.php'; ?></div></div>
</body></html>
