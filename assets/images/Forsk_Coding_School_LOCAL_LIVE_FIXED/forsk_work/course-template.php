<?php
function forsk_esc($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
require_once __DIR__ . '/includes/course-data.php';

$slug = basename($_SERVER['SCRIPT_NAME'], '.php');
if (!isset($COURSES[$slug])) { http_response_code(404); header('Location: index.php'); exit; }

$course = $COURSES[$slug];
$page_title = $course['title'] . ' Course in Jaipur | Forsk Coding School';
$page_description = $course['desc'];
$page_keywords = $course['keywords'];
$page_canonical = 'https://forskcodingschool.com/' . $course['url'];
$page_og_image = 'https://forskcodingschool.com/' . $course['thumb'];

$faq_schema = [];
foreach ($course['faq'] as $faq) {
  $faq_schema[] = ['@type'=>'Question','name'=>$faq[0],'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq[1]]];
}
$page_schema = json_encode([
  '@context'=>'https://schema.org',
  '@graph'=>[
    ['@type'=>'Course','@id'=>$page_canonical.'#course','name'=>$course['title'].' Course in Jaipur',
     'description'=>$course['desc'],'url'=>$page_canonical,'image'=>$page_og_image,'inLanguage'=>'en-IN',
     'provider'=>['@type'=>'EducationalOrganization','name'=>'Forsk Coding School','url'=>'https://forskcodingschool.com/']],
    ['@type'=>'BreadcrumbList','itemListElement'=>[
      ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>'https://forskcodingschool.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Courses','item'=>'https://forskcodingschool.com/courses.php'],
      ['@type'=>'ListItem','position'=>3,'name'=>$course['title'],'item'=>$page_canonical]
    ]],
    ['@type'=>'FAQPage','mainEntity'=>$faq_schema]
  ]
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

$header_variant='header-1';
$related=[];
foreach($COURSES as $rslug=>$r){
  if($rslug!==$slug && $r['cat']===$course['cat']) $related[$rslug]=$r;
}
foreach($COURSES as $rslug=>$r){
  if($rslug!==$slug && !isset($related[$rslug])) $related[$rslug]=$r;
  if(count($related)>=6) break;
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
<head><?php include __DIR__.'/includes/head.php'; ?></head>
<body>
<?php include __DIR__.'/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content"><main id="primary" class="site-main">
<div class="space-for-header"></div>

<section class="tj-breadcrumb-area">
 <div class="container"><div class="breadcrumb-content">
  <span class="sec-subtitle"><i class="tji-subtitle"></i><?=forsK_esc($course['cat'])?></span>
  <h1 class="breadcrumb-title"><?=forsK_esc($course['title'])?> Course in Jaipur</h1>
  <div class="breadcrumb-list"><span><a href="index.php">Home</a></span><span><a href="courses.php">Courses</a></span><span><?=forsK_esc($course['title'])?></span></div>
 </div></div>
</section>

<section class="forsk-content-section">
 <div class="container"><div class="row">
  <div class="col-lg-8">
   <article class="tj-course-details-content">
    <img class="forsk-course-thumb mb-4" src="<?=forsK_esc($course['thumb'])?>" alt="<?=forsK_esc($course['title'])?> course in Jaipur" width="1200" height="675">
    <span class="forsk-badge"><?=forsK_esc($course['cat'])?> • Forsk Coding School Jaipur</span>
    <h2><?=forsK_esc($course['title'])?> Training in Jaipur</h2>
    <p><?=forsK_esc($course['desc'])?></p>
    <p>Forsk Coding School combines concept learning with practical application. Instead of stopping at theory, learners work through examples, assignments, debugging and project tasks related to <?=forsK_esc($course['title'])?>. This helps build a portfolio, improve problem-solving ability and understand how the skill is used in professional environments.</p>

    <h3>What You Will Learn</h3>
    <ul><?php foreach($course['topics'] as $topic):?><li><?=forsK_esc($topic)?></li><?php endforeach;?></ul>

    <h3>Course Curriculum</h3>
    <?php foreach($course['syllabus'] as $i=>$module):?>
      <h4><?=forsK_esc($module)?></h4>
      <p>Understand the concepts step by step, practise with guided examples, complete exercises and apply the module to practical project work.</p>
    <?php endforeach;?>

    <h3>Practical Projects &amp; Portfolio</h3>
    <p>Project-based practice is used to turn learning into demonstrable work. Learners can apply <?=forsK_esc($course['title'])?> concepts to practical scenarios, document their work and improve their ability to explain technical decisions during interviews.</p>

    <h3>Career-Focused Training</h3>
    <p>The program supports technical confidence through practice, revision, troubleshooting and interview-oriented questions. Learners can also explore related programs in <?=forsK_esc($course['cat'])?> and connect their learning path with <a href="placements.php">placement and career support</a>, <a href="internship-programs-jaipur.php">internship opportunities</a> and <a href="final-year-projects-jaipur.php">project guidance</a>.</p>

    <h3>Who Should Join?</h3>
    <ul><li>Students building their first strong technology skill.</li><li>Graduates preparing for entry-level IT opportunities.</li><li>Working professionals upgrading an existing skill set.</li><li>Career switchers building practical, portfolio-ready skills.</li></ul>

    <h3>Why Learn at Forsk Coding School?</h3>
    <p>Forsk Coding School is focused on practical technology education in Jaipur. Learners get structured learning paths, guided practice, project exposure, mentor support and career preparation. Explore <a href="courses.php">all courses</a> or learn more <a href="about.php">about Forsk Coding School</a>.</p>

    <h3>Frequently Asked Questions</h3>
    <?php foreach($course['faq'] as $faq):?><h4><?=forsK_esc($faq[0])?></h4><p><?=forsK_esc($faq[1])?></p><?php endforeach;?>

    <div class="btn-area mt-4">
      <a class="tj-btn-primary flip-text-wrap" href="enquiry.php"><span class="btn-text">Enquire About This Course</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
      <a class="tj-btn-primary tj-btn-primary-light flip-text-wrap" href="courses.php"><span class="btn-text">Browse All Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
    </div>
   </article>
  </div>
  <div class="col-lg-4"><aside class="tj-sidebar"><div class="tj-course-sidebar-card">
   <img class="forsk-course-thumb mb-3" src="<?=forsK_esc($course['thumb'])?>" alt="<?=forsK_esc($course['title'])?> training at Forsk Coding School" width="1200" height="675">
   <h3><?=forsK_esc($course['title'])?></h3><p>Practical training • Projects • Mentor guidance • Career preparation</p>
   <a class="tj-btn-primary w-100 justify-content-center" href="enquiry.php"><span class="btn-text">Get Batch &amp; Fee Details</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
  </div></aside></div>
 </div></div>
</section>

<section class="forsk-content-section pt-0">
 <div class="container"><div class="sec-heading text-center mb-5">
  <span class="sec-subtitle"><i class="tji-subtitle"></i>Explore More</span><h2 class="sec-title">Related Courses in Jaipur</h2>
 </div><div class="row">
 <?php foreach(array_slice($related,0,6,true) as $r):?>
  <div class="col-lg-4 col-md-6 mb-4"><div class="forsk-related-card">
   <a href="<?=forsK_esc($r['url'])?>"><img class="forsk-course-thumb" src="<?=forsK_esc($r['thumb'])?>" alt="<?=forsK_esc($r['title'])?> course in Jaipur" loading="lazy" width="1200" height="675"></a>
   <span class="sec-subtitle mt-3 d-inline-block"><i class="tji-subtitle"></i><?=forsK_esc($r['cat'])?></span>
   <h3 class="tj-fs-h5"><a href="<?=forsK_esc($r['url'])?>"><?=forsK_esc($r['title'])?></a></h3>
   <a class="tj-btn-primary tj-btn-primary-sm mt-2" href="<?=forsK_esc($r['url'])?>"><span class="btn-text">View Course</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
  </div></div>
 <?php endforeach;?>
 </div></div>
</section>
</main></div></div>
<?php include __DIR__.'/includes/footer.php'; ?>
</body></html>
