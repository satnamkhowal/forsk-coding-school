<?php
$site_root = dirname(__DIR__);
$mentors = json_decode((string)file_get_contents(__DIR__ . '/data/mentors.json'), true) ?: [];
$page_title = 'Technology Mentors in Jaipur | Forsk Coding School';
$page_description = 'Explore mentor-led technology learning at Forsk Coding School Jaipur across Data Analytics, Data Science, AI, Full Stack, Cloud, Cyber Security, DevOps, Testing, UI/UX and more.';
$page_canonical = 'https://forskcodingschool.com/mentors/';
$page_keywords = 'technology mentors Jaipur, coding trainers Jaipur, IT trainers Jaipur, Forsk Coding School mentors';
$page_robots = 'noindex, follow';
$header_variant = 'header-1';
$filter = trim((string)($_GET['domain'] ?? ''));
$q = trim((string)($_GET['q'] ?? ''));
$domains = array_values(array_unique(array_map(fn($m)=>$m['domain'],$mentors)));
sort($domains);
function mh($v){ return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8'); }
?>
<!DOCTYPE html><html class="no-js" lang="en"><head><?php include $site_root.'/includes/head.php'; ?><link rel="stylesheet" href="assets/css/mentor-profile-enhancements.css"></head><body>
<?php include $site_root.'/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content"><main id="primary" class="site-main"><div class="space-for-header"></div>
<section class="tj-page-header tj-page-header-2"><div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
<div class="tj-page-link"><span><i class="tji-home"></i></span><span><a href="./">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span>Mentors</span></div>
<h1 class="name tj-fs-h2">Technology Mentors & Trainers in Jaipur</h1><p>Explore mentor-led learning across programming, data, AI, cloud, cybersecurity, testing, design and digital technologies.</p>
</div></div></div></div></section>

<section class="mentor-live-lab-strip"><div class="container"><div class="mentor-live-lab-grid">
<div><strong>Live Two-Way Classes</strong><span>Ask questions during the session and interact directly with the mentor.</span></div>
<div><strong>10–15 Learner Micro-Batches</strong><span>Smaller groups designed for more meaningful mentor attention.</span></div>
<div><strong>Online + Offline</strong><span>Join live online or learn at Forsk Coding School in Jaipur.</span></div>
<div><strong>Practical Support</strong><span>Screen sharing, code review and consent-based remote troubleshooting when needed.</span></div>
</div></div></section>

<section class="tj-details section-gap-bottom"><div class="container">
<form method="get" action="mentors/" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:30px">
<input type="search" name="q" value="<?= mh($q) ?>" placeholder="Search mentor or skill" style="min-width:260px;padding:12px">
<select name="domain" style="min-width:260px;padding:12px"><option value="">All domains</option><?php foreach($domains as $d): ?><option value="<?= mh($d) ?>" <?= $filter===$d?'selected':'' ?>><?= mh($d) ?></option><?php endforeach; ?></select>
<button class="tj-btn-primary" type="submit">Filter</button></form>
<div class="row rg-20">
<?php $shown=0; foreach($mentors as $m):
  if($filter!=='' && $m['domain']!==$filter) continue;
  if($q!=='' && stripos($m['name'].' '.$m['domain'].' '.implode(' ',$m['skills']),$q)===false) continue;
  $shown++; $disk=$site_root.'/mentors/images/'.$m['image_filename']; $img=is_file($disk)?'mentors/images/'.$m['image_filename']:'mentors/images/mentor-image-coming-soon.png'; ?>
<div class="col-lg-4 col-md-6"><div class="tj-instructor-item tj-instructor-item-2">
<div class="tj-instructor-img"><a href="mentors/<?= mh($m['slug']) ?>/"><img src="<?= mh($img) ?>" alt="<?= mh($m['image_alt']) ?>" loading="lazy" width="800" height="800"></a></div>
<div class="tj-instructor-content"><div class="tj-instructor-content-inner"><h2 class="name tj-fs-h5"><a href="mentors/<?= mh($m['slug']) ?>/"><?= mh($m['name']) ?></a></h2><span class="designation"><?= mh($m['role']) ?></span></div><div class="mentor-highlight-pills"><span>Online + Offline</span><span>Live Two-Way</span><span>10–15 / Batch</span></div><a class="tj-btn-primary-2 tj-btn-primary-3 tj-btn-full" href="mentors/<?= mh($m['slug']) ?>/">View Profile</a></div>
</div></div>
<?php endforeach; ?>
</div><?php if(!$shown): ?><p>No mentor profiles matched your filter.</p><?php endif; ?>
</div></section></main><?php include $site_root.'/includes/footer.php'; ?></div></div></body></html>
