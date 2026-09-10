<?php
$root_path = dirname(__DIR__);
require_once $root_path . '/config.php';
require_once __DIR__ . '/blog-library.php';

// Direct compatibility route: /blog/blog-details.php?slug=...
if (!isset($blog) || !is_array($blog)) {
    $slug=trim((string)($_GET['slug'] ?? $_GET['post'] ?? ''), "/ \t\n\r\0\x0B");
    if ($slug!=='' && preg_match('/^[a-z0-9][a-z0-9-]*$/i',$slug)) {
        $target=__DIR__.'/'.$slug.'/index.php';
        if (is_file($target)) { header('Location: '.blog_url($slug),true,302); exit; }
    }
    http_response_code(404);
    $page_title='Blog Not Found | Forsk Coding School';
    $page_description='The requested Forsk Coding School blog could not be found.';
    $page_canonical=seo_url('blog/');
    $page_robots='noindex, follow';
    $page_type='website';
    $page_schema=json_encode(['@context'=>'https://schema.org','@type'=>'WebPage','name'=>$page_title,'url'=>$page_canonical],JSON_UNESCAPED_SLASHES);
    $header_variant='header-1';
    ?><!doctype html><html lang="en"><head><?php include $root_path.'/includes/head.php'; ?></head><body><?php include $root_path.'/includes/header.php'; ?><main><div class="space-for-header"></div><section class="tj-page-header"><div class="container"><h1 class="tj-page-title">Blog Not Found</h1><p><a href="<?= htmlspecialchars(blog_url(),ENT_QUOTES,'UTF-8') ?>">Browse the Knowledge Hub</a></p></div></section></main><?php include $root_path.'/includes/footer.php'; ?></body></html><?php
    return;
}

$slug=$blog['slug'];
$page_title=$blog['title'].' | Forsk Coding School';
if (strlen($page_title)>68) $page_title=$blog['title'].' | Forsk';
$page_description=$blog['description'];
$page_keywords=implode(', ',array_unique([$blog['subject'],$blog['cluster'],$blog['category'],'Forsk Coding School Jaipur',$blog['subject'].' course Jaipur']));
$page_canonical=blog_seo_url($slug);
$page_type='article';
$header_variant='header-1';
$image_file=$blog['image'];
$image_disk=__DIR__.'/images/'.$image_file;
$image_exists=is_file($image_disk);
$visible_image=$image_exists ? blog_image_url($image_file) : blog_image_url('blog-image-placeholder.svg');
$page_og_image=$image_exists ? blog_image_seo_url($image_file) : seo_url('blog/images/blog-image-placeholder.svg');

$articleSchema=[
 '@type'=>'BlogPosting','@id'=>$page_canonical.'#article','headline'=>$blog['title'],'description'=>$page_description,
 'url'=>$page_canonical,'mainEntityOfPage'=>['@type'=>'WebPage','@id'=>$page_canonical],
 'author'=>['@type'=>'Organization','name'=>'Forsk Coding School','url'=>SEO_BASE_URL.'/'],
 'publisher'=>['@type'=>'EducationalOrganization','name'=>'Forsk Coding School','url'=>SEO_BASE_URL.'/'],
 'about'=>[$blog['subject'],$blog['cluster']], 'keywords'=>$page_keywords, 'dateModified'=>$blog['date_modified'] ?? '2026-09-10'
];
if (!empty($blog['date_published'])) $articleSchema['datePublished']=$blog['date_published'];
if ($image_exists) $articleSchema['image']=blog_image_seo_url($image_file);
$breadcrumb=['@type'=>'BreadcrumbList','@id'=>$page_canonical.'#breadcrumb','itemListElement'=>[
 ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>SEO_BASE_URL.'/'],
 ['@type'=>'ListItem','position'=>2,'name'=>'Blog','item'=>seo_url('blog/')],
 ['@type'=>'ListItem','position'=>3,'name'=>$blog['title'],'item'=>$page_canonical]
]];
$page_schema=json_encode(['@context'=>'https://schema.org','@graph'=>[$articleSchema,$breadcrumb]],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
$built=forsk_blog_article_sections($blog); $intro=array_shift($built);
?>
<!DOCTYPE html><html class="no-js" lang="en"><head><?php include $root_path.'/includes/head.php'; ?></head>
<body><?php include $root_path.'/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content"><main id="primary" class="site-main">
<div class="space-for-header"></div>
<section class="tj-page-header"><div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
<h1 class="tj-page-title"><?= htmlspecialchars($blog['title'],ENT_QUOTES,'UTF-8') ?></h1>
<div class="tj-page-link"><span><i class="tji-home"></i></span><span><a href="<?= htmlspecialchars(site_url('/'),ENT_QUOTES,'UTF-8') ?>">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span><a href="<?= htmlspecialchars(blog_url(),ENT_QUOTES,'UTF-8') ?>">Blog</a></span><span><i class="tji-arrow-right-4"></i></span><span><?= htmlspecialchars($blog['category'],ENT_QUOTES,'UTF-8') ?></span></div>
<div class="shape"><img src="<?= htmlspecialchars(asset_url('images/shapes/stars.png'),ENT_QUOTES,'UTF-8') ?>" alt=""></div>
</div></div></div></div></section>
<section class="tj-blog-section section-gap-bottom"><div class="container"><div class="row rg-60">
<div class="col-lg-8"><article class="tj_wpost_wrapper"><div class="tj_wpost_singular">
<div class="tj_wpost_thumb tj-fade-anim"><img src="<?= htmlspecialchars($visible_image,ENT_QUOTES,'UTF-8') ?>" alt="<?= htmlspecialchars($blog['title'].' - Forsk Coding School',ENT_QUOTES,'UTF-8') ?>" title="<?= htmlspecialchars($blog['title'],ENT_QUOTES,'UTF-8') ?>" loading="eager" width="1200" height="675"></div>
<div class="blog-category-two tj-fade-anim"><div class="category-item"><div class="cate-icons"><i class="tji-calendar-2"></i></div><div class="cate-text"><span class="designation">Updated</span><h6 class="text"><?= htmlspecialchars($blog['date_modified'] ?? '10 September, 2026',ENT_QUOTES,'UTF-8') ?></h6></div></div><div class="category-item"><div class="cate-icons"><i class="tji-comment"></i></div><div class="cate-text"><span class="designation">Category</span><h6 class="text"><?= htmlspecialchars($blog['category'],ENT_QUOTES,'UTF-8') ?></h6></div></div></div>
<div class="tj_wpost_entry_content"><p><?= htmlspecialchars($intro,ENT_QUOTES,'UTF-8') ?></p>
<?php foreach($built as $section): ?><h2><?= htmlspecialchars($section['heading'],ENT_QUOTES,'UTF-8') ?></h2><?php foreach($section['paragraphs'] as $p): ?><p><?= htmlspecialchars($p,ENT_QUOTES,'UTF-8') ?></p><?php endforeach; ?><?php if(!empty($section['bullets'])): ?><ul class="tj_list tj-fade-anim"><?php foreach($section['bullets'] as $li): ?><li><i class="tji-check"></i><?= htmlspecialchars($li,ENT_QUOTES,'UTF-8') ?></li><?php endforeach; ?></ul><?php endif; ?><?php endforeach; ?>

<h2>Relevant Forsk Coding School courses in Jaipur</h2><p>The following internal course links are selected for this topic rather than added randomly. Use them to continue from reading into structured practice.</p>
<div class="row rg-20"><?php foreach($blog['courses'] as $c): ?><div class="col-md-6"><div class="tj-course-item"><div class="tj-course-content"><div class="tj-categories"><a class="tj-cat" href="<?= htmlspecialchars(site_url($c['url']),ENT_QUOTES,'UTF-8') ?>"><?= htmlspecialchars($c['label'],ENT_QUOTES,'UTF-8') ?></a></div><h3 class="title tj-fs-h5"><a href="<?= htmlspecialchars(site_url($c['url']),ENT_QUOTES,'UTF-8') ?>"><?= htmlspecialchars($c['anchor'],ENT_QUOTES,'UTF-8') ?></a></h3><p><?= htmlspecialchars($c['reason'],ENT_QUOTES,'UTF-8') ?></p><a class="tj-text-btn flip-text-wrap" href="<?= htmlspecialchars(site_url($c['url']),ENT_QUOTES,'UTF-8') ?>"><span class="btn-text">Explore course</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></div></div></div><?php endforeach; ?></div>

<h2>Related learning guides</h2><ul class="tj_list tj-fade-anim"><?php foreach($blog['related'] as $r): ?><li><i class="tji-arrow-right-2"></i><a href="<?= htmlspecialchars(blog_url($r['slug']),ENT_QUOTES,'UTF-8') ?>"><?= htmlspecialchars($r['title'],ENT_QUOTES,'UTF-8') ?></a></li><?php endforeach; ?></ul>

<div class="tj-blockquote tj-fade-anim"><p>Build the skill, test it on a real task, explain your decisions and improve the result. That learning loop is more valuable than collecting disconnected tutorials.</p><div class="tj-blog-author"><div class="author-info"><div class="name">By <span>Forsk Coding School</span></div><span class="designation">Jaipur Technology Learning Team</span></div></div></div>
<h2>Next step</h2><p>If you want structured guidance for <?= htmlspecialchars($blog['subject'],ENT_QUOTES,'UTF-8') ?>, compare the linked courses, review their syllabus and choose a path that matches your current level and project goal. Forsk Coding School supports practical online and offline learning in Jaipur with mentor interaction and project-focused practice.</p>
</div></div></article></div>
<div class="col-lg-4"><aside class="tj-course-sidebar"><div class="tj-course-widget"><h3 class="course-widget-title">This guide covers</h3><ul class="tj-course-includes"><li><i class="tji-check"></i><?= htmlspecialchars($blog['subject'],ENT_QUOTES,'UTF-8') ?></li><li><i class="tji-check"></i><?= htmlspecialchars($blog['goal_label'],ENT_QUOTES,'UTF-8') ?></li><li><i class="tji-check"></i><?= htmlspecialchars($blog['audience'],ENT_QUOTES,'UTF-8') ?></li><li><i class="tji-check"></i>Practical project workflow</li><li><i class="tji-check"></i>Relevant Jaipur course links</li></ul></div><div class="tj-course-widget"><h3 class="course-widget-title">Explore more</h3><p><a class="tj-btn-primary tj-btn-full" href="<?= htmlspecialchars(site_url('courses.php'),ENT_QUOTES,'UTF-8') ?>">All Courses</a></p><p><a class="tj-btn-primary tj-btn-primary-light tj-btn-full" href="<?= htmlspecialchars(blog_url(),ENT_QUOTES,'UTF-8') ?>">Knowledge Hub</a></p></div></aside></div>
</div></div></section></main><?php include $root_path.'/includes/footer.php'; ?></div></div></body></html>
