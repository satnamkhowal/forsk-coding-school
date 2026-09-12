<?php
$root_path=dirname(__DIR__);
require_once $root_path.'/config.php';
require_once __DIR__.'/seo-quality.php';
$data=forsk_blog_quality_data();
$subject=(string)($hub_subject ?? '');
$hub=$data['hubs'][$subject] ?? null;
if(!$hub){http_response_code(404);$page_title='Topic Not Found | Forsk Coding School';$page_description='The requested learning topic could not be found.';$page_robots='noindex, follow';$page_canonical=seo_url('blog/');}
else{$page_title=$hub['title'].' | Forsk';$page_description=$hub['description'];$page_canonical=blog_seo_url($hub['slug']);$page_robots='index, follow';}
$page_type='website';$header_variant='header-1';
if($hub){$page_schema=json_encode(['@context'=>'https://schema.org','@graph'=>[
 ['@type'=>'CollectionPage','@id'=>$page_canonical.'#webpage','name'=>$hub['title'],'description'=>$hub['description'],'url'=>$page_canonical,'isPartOf'=>['@type'=>'WebSite','@id'=>SEO_BASE_URL.'/#website']],
 ['@type'=>'BreadcrumbList','itemListElement'=>[
  ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>SEO_BASE_URL.'/'],
  ['@type'=>'ListItem','position'=>2,'name'=>'Blog','item'=>seo_url('blog/')],
  ['@type'=>'ListItem','position'=>3,'name'=>$hub['title'],'item'=>$page_canonical]
 ]]
]],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);}
$guides=$data['by_subject'][$subject] ?? [];
if(!function_exists('forsk_course_label_from_url')){function forsk_course_label_from_url(string $url): string { $x=preg_replace('/-course-jaipur\.php$/','',$url); $x=preg_replace('/-jaipur\.php$/','',$x); $x=ucwords(str_replace('-',' ',$x)); $x=str_ireplace(['Power Bi','Ui Ux','Seo','Aws','Api','Sql','Php'],['Power BI','UI UX','SEO','AWS','API','SQL','PHP'],$x); return $x; }}
?>
<!doctype html><html lang="en"><head><?php include $root_path.'/includes/head.php'; ?></head><body><?php include $root_path.'/includes/header.php'; ?><div id="smooth-wrapper"><div id="smooth-content"><main id="primary" class="site-main"><div class="space-for-header"></div>
<section class="tj-page-header"><div class="container"><div class="tj-page-header-content"><h1 class="tj-page-title"><?= htmlspecialchars($hub['title']??'Topic',ENT_QUOTES,'UTF-8') ?></h1><div class="tj-page-link"><span><a href="<?= htmlspecialchars(site_url('/'),ENT_QUOTES,'UTF-8') ?>">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span><a href="<?= htmlspecialchars(blog_url(),ENT_QUOTES,'UTF-8') ?>">Blog</a></span><span><i class="tji-arrow-right-4"></i></span><span><?= htmlspecialchars($subject,ENT_QUOTES,'UTF-8') ?></span></div></div></div></section>
<section class="tj-blog-section section-gap-bottom"><div class="container"><div class="row rg-40"><div class="col-lg-8">
<p class="lead"><?= htmlspecialchars($hub['description']??'',ENT_QUOTES,'UTF-8') ?></p>
<h2>Choose the guide that matches your goal</h2><p>This topic hub groups the strongest search-intent guides for <?= htmlspecialchars($subject,ENT_QUOTES,'UTF-8') ?>. Pages are selected by learner need rather than publishing every possible keyword variation.</p>
<div class="row rg-20"><?php foreach($guides as $g): ?><div class="col-md-6"><article class="blog-item"><div class="blog-content"><div class="blog-meta"><span><?= htmlspecialchars($g['audience'],ENT_QUOTES,'UTF-8') ?></span></div><h3 class="blog-title tj-fs-h5"><a href="<?= htmlspecialchars(blog_url($g['slug']),ENT_QUOTES,'UTF-8') ?>"><?= htmlspecialchars($g['title'],ENT_QUOTES,'UTF-8') ?></a></h3><a class="tj-text-btn" href="<?= htmlspecialchars(blog_url($g['slug']),ENT_QUOTES,'UTF-8') ?>">Read guide <i class="tji-arrow-right-2"></i></a></div></article></div><?php endforeach; ?></div>
<h2 style="margin-top:35px">Relevant Forsk courses for this topic</h2><p>These internal links connect the topic hub to the most relevant structured learning paths in Jaipur.</p><ul class="tj_list tj-fade-anim"><?php foreach(($hub['course_urls'] ?? []) as $cu): ?><li><i class="tji-arrow-right-2"></i><a href="<?= htmlspecialchars(site_url($cu),ENT_QUOTES,'UTF-8') ?>"><?= htmlspecialchars(forsk_course_label_from_url($cu).' Course in Jaipur',ENT_QUOTES,'UTF-8') ?></a></li><?php endforeach; ?></ul>
<h2 style="margin-top:35px">How to use this learning hub</h2><p>Start with a roadmap if the topic is new, use project guides to build evidence, switch to interview guides when you can explain your work, and use workflow or mistake guides to improve reliability. The goal is practical capability, not collecting more pages.</p>
</div><div class="col-lg-4"><aside class="tj-course-sidebar"><div class="tj-course-widget"><h3 class="course-widget-title">Topic summary</h3><ul class="tj-course-includes"><li><i class="tji-check"></i><?= htmlspecialchars($subject,ENT_QUOTES,'UTF-8') ?></li><li><i class="tji-check"></i><?= (int)($hub['count']??0) ?> curated guides</li><li><i class="tji-check"></i><?= htmlspecialchars($hub['category']??'Technology',ENT_QUOTES,'UTF-8') ?></li><li><i class="tji-check"></i>Roadmaps, projects & interviews</li></ul></div><div class="tj-course-widget"><h3 class="course-widget-title">Continue learning</h3><p><a class="tj-btn-primary tj-btn-full" href="<?= htmlspecialchars(site_url('courses.php'),ENT_QUOTES,'UTF-8') ?>">Explore Courses</a></p><p><a class="tj-btn-primary tj-btn-primary-light tj-btn-full" href="<?= htmlspecialchars(site_url('live-mentorlab.php'),ENT_QUOTES,'UTF-8') ?>">Live MentorLab</a></p></div></aside></div></div></div></section>
</main><?php include $root_path.'/includes/footer.php'; ?></div></div></body></html>
