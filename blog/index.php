<?php
/**
 * Forsk Coding School dynamic blog index.
 * Existing individual blog folders are discovered automatically.
 */
$root_path = dirname(__DIR__);
require_once $root_path . '/config.php';

$page_title = 'Forsk Coding School Blogs | Coding, IT & Career Guides';
$page_description = 'Explore coding, programming, software development, testing, data science, AI, digital marketing, career and technology guides from Forsk Coding School.';
$page_keywords = 'Forsk Coding School blogs, coding blogs Jaipur, programming tutorials, IT career guides';
$page_canonical = site_url('/blog/');
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => $page_title,
    'description' => $page_description,
    'url' => $page_canonical
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php include $root_path . '/includes/head.php'; ?>
</head>
<body>
<?php include $root_path . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content"><main id="primary" class="site-main">
<div class="space-for-header"></div>

<section class="tj-page-header">
<div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
<h1 class="tj-page-title">Forsk Coding School Blogs</h1>
<div class="tj-page-link">
<span><i class="tji-home"></i></span>
<span><a href="<?= site_url('/') ?>">Home</a></span>
<span><i class="tji-arrow-right-4"></i></span>
<span>Blog</span>
</div>
<div class="shape"><img src="<?= asset_url('images/shapes/stars.png') ?>" alt=""></div>
</div></div></div></div>
</section>

<section class="tj-blog-section section-gap-bottom fix">
<div class="container"><div class="row"><div class="col-12">
<div class="sec-heading sec-heading-center">
<span class="sec-subtitle tj-fade-anim" data-direction="top"><i class="tji-subtitle"></i>Knowledge Hub</span>
<h2 class="sec-title tj-fade-anim">Explore Latest Blog and Insights.</h2>
</div>
</div></div>

<div class="row tj-course-filter tj_filter_item_wrapper tj-fade-anim">
<?php
$entries=[];
foreach (glob(__DIR__ . '/*', GLOB_ONLYDIR) ?: [] as $dir) {
    $slug=basename($dir);
    $file=$dir.'/index.php';
    if (!is_file($file)) continue;
    $txt=file_get_contents($file);
    $title='';
    $desc='';
    if (preg_match('/\$page_title\s*=\s*[\'"]([^\'"]+)[\'"]\s*;/', $txt, $m)) $title=trim($m[1]);
    if (!$title) $title=ucwords(str_replace(['-','_'],' ',$slug));
    if (preg_match('/\$page_description\s*=\s*[\'"]([^\'"]*)[\'"]\s*;/', $txt, $m)) $desc=trim($m[1]);
    $desc=preg_replace('/\s+/',' ',$desc);
    if (strlen($desc)>155) $desc=substr($desc,0,152).'...';
    $entries[]=['slug'=>$slug,'title'=>$title,'description'=>$desc];
}
usort($entries, fn($a,$b)=>strcasecmp($a['title'],$b['title']));
foreach ($entries as $entry):
    $url=blog_url($entry['slug']);
    $img=asset_url('images/blog/'.$entry['slug'].'.webp');
?>
<div class="col-lg-4 col-md-6 tj_filter_item">
<article class="blog-item">
<div class="blog-thumb">
<a href="<?= htmlspecialchars($url,ENT_QUOTES,'UTF-8') ?>">
<img src="<?= htmlspecialchars($img,ENT_QUOTES,'UTF-8') ?>" alt="<?= htmlspecialchars($entry['title'],ENT_QUOTES,'UTF-8') ?>" loading="lazy">
</a>
</div>
<div class="blog-content">
<div class="blog-meta">
<div class="tj-categories"><a class="blog-category" href="<?= htmlspecialchars($url,ENT_QUOTES,'UTF-8') ?>">Forsk Coding School</a></div>
<div class="blog-meta-item date"><i class="tji-calendar"></i><span>2026</span></div>
</div>
<h4 class="blog-title tj-fs-h5"><a href="<?= htmlspecialchars($url,ENT_QUOTES,'UTF-8') ?>"><?= htmlspecialchars($entry['title'],ENT_QUOTES,'UTF-8') ?></a></h4>
<p class="blog-desc"><?= htmlspecialchars($entry['description'] ?: 'Practical coding, IT and career guidance from Forsk Coding School.',ENT_QUOTES,'UTF-8') ?></p>
<div class="blog-btn"><a class="tj-text-btn flip-text-wrap" href="<?= htmlspecialchars($url,ENT_QUOTES,'UTF-8') ?>"><span class="btn-text">Read more</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></div>
</div>
</article>
</div>
<?php endforeach; ?>
</div>
</div>
</section>
</main>
<?php include $root_path . '/includes/footer.php'; ?>
</div></div>
</body></html>
