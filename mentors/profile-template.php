<?php
$site_root = dirname(__DIR__);
$data_file = __DIR__ . '/data/mentors.json';
$mentors = json_decode((string)file_get_contents($data_file), true) ?: [];
$mentor = null;
foreach ($mentors as $candidate) {
    if (($candidate['slug'] ?? '') === ($mentor_slug ?? '')) {
        $mentor = $candidate;
        break;
    }
}
if (!$mentor) {
    http_response_code(404);
    $page_title = 'Mentor Profile Not Found | Forsk Coding School';
    $page_description = 'The requested mentor profile could not be found.';
    $page_canonical = 'https://forskcodingschool.com/mentors/';
    $page_robots = 'noindex, nofollow';
    include $site_root . '/includes/head.php';
    echo '<body><main class="container" style="padding:120px 20px"><h1>Mentor profile not found</h1><p><a href="mentors/">View all mentors</a></p></main></body>';
    exit;
}

function mentor_h($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$name = $mentor['name'];
$domain = $mentor['domain'];
$role = $mentor['role'];
$skills = $mentor['skills'] ?? [];
$url = $mentor['url'];
$image_filename = $mentor['image_filename'];
$image_disk = $site_root . '/assets/images/mentors/' . $image_filename;
$image_available = is_file($image_disk);
$image_path = $image_available
    ? 'assets/images/mentors/' . $image_filename
    : 'assets/images/mentors/mentor-image-coming-soon.png';
$image_url = 'https://forskcodingschool.com/' . $image_path;
$verified = !empty($mentor['verified']);

$page_title = $mentor['meta_title'];
$page_description = $mentor['meta_description'];
$page_keywords = $mentor['primary_keyword'] . ', ' . $domain . ' mentor Jaipur, Forsk Coding School mentor';
$page_canonical = $url;
$page_robots = $verified ? 'index, follow, max-image-preview:large' : 'noindex, nofollow, noarchive';
$page_og_image = $image_url;
$header_variant = 'header-1';

// Structured data is intentionally activated only after the mentor profile has
// been verified. Set verified=true in mentors/data/mentors.json after checking
// identity, consent, role, photo and affiliation.
$page_schema = '';
if ($verified) {
    $graph = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'ProfilePage',
                '@id' => $url . '#profilepage',
                'url' => $url,
                'name' => $page_title,
                'description' => $page_description,
                'mainEntity' => ['@id' => $url . '#mentor'],
                'breadcrumb' => ['@id' => $url . '#breadcrumb']
            ],
            [
                '@type' => 'Person',
                '@id' => $url . '#mentor',
                'name' => $name,
                'url' => $url,
                'jobTitle' => $role,
                'knowsAbout' => array_values($skills),
                'worksFor' => [
                    '@type' => 'EducationalOrganization',
                    '@id' => 'https://forskcodingschool.com/#organization',
                    'name' => 'Forsk Coding School',
                    'url' => 'https://forskcodingschool.com/'
                ]
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $url . '#breadcrumb',
                'itemListElement' => [
                    ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>'https://forskcodingschool.com/'],
                    ['@type'=>'ListItem','position'=>2,'name'=>'Mentors','item'=>'https://forskcodingschool.com/mentors/'],
                    ['@type'=>'ListItem','position'=>3,'name'=>$name,'item'=>$url]
                ]
            ]
        ]
    ];
    if ($image_available) {
        $graph['@graph'][1]['image'] = $image_url;
        $graph['@graph'][0]['primaryImageOfPage'] = ['@id' => $image_url . '#image'];
        $graph['@graph'][] = [
            '@type'=>'ImageObject',
            '@id'=>$image_url . '#image',
            'url'=>$image_url,
            'contentUrl'=>$image_url,
            'caption'=>$mentor['image_caption']
        ];
    }
    $page_schema = json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

$course_cards = $mentor['courses'] ?? [];
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php include $site_root . '/includes/head.php'; ?>
</head>
<body>
<?php include $site_root . '/includes/header.php'; ?>

<div id="smooth-wrapper">
  <div id="smooth-content">
    <main id="primary" class="site-main">
      <div class="space-for-header"></div>

      <section class="tj-page-header tj-page-header-2">
        <div class="container">
          <div class="row"><div class="col-12"><div class="tj-page-header-content">
            <div class="tj-page-link">
              <span><i class="tji-home"></i></span>
              <span><a href="./">Home</a></span>
              <span><i class="tji-arrow-right-4"></i></span>
              <span><a href="mentors/">Mentors</a></span>
              <span><i class="tji-arrow-right-4"></i></span>
              <span><?= mentor_h($name) ?></span>
            </div>

            <div class="tj-page-header-instructor">
              <div class="tj-instructor-img">
                <img src="<?= mentor_h($image_path) ?>"
                     alt="<?= mentor_h($mentor['image_alt']) ?>"
                     title="<?= mentor_h($mentor['image_title']) ?>"
                     data-description="<?= mentor_h($mentor['image_caption']) ?>"
                     width="800" height="800" decoding="async">
              </div>
              <div class="tj-instructor-content">
                <div class="tj-categories">
                  <a class="tj-cat" href="mentors/?domain=<?= urlencode($domain) ?>"><?= mentor_h($domain) ?></a>
                </div>
                <div class="name-area">
                  <h1 class="name tj-fs-h2"><?= mentor_h($name) ?></h1>
                  <span class="designation"><?= mentor_h($role) ?></span>
                </div>
                <div class="course-meta">
                  <span><i class="tji-book"></i><?= count($skills) ?> Core Skills</span>
                  <span><i class="tji-user-duo"></i>Forsk Coding School</span>
                  <span><i class="tji-map"></i>Jaipur</span>
                  <?php if (!$verified): ?><span><i class="tji-info"></i>Profile verification pending</span><?php endif; ?>
                </div>
              </div>
            </div>
            <div class="shape"><img src="assets/images/shapes/stars.png" alt=""></div>
          </div></div></div>
        </div>
      </section>

      <section class="tj-details section-gap-bottom fix tj-sticky-container-2">
        <div class="container"><div class="row">
          <div class="col-lg-8">
            <div class="tj-course-details-wrapper tj-tab-sticky-wrapper">
              <div class="tj-course-tab-wrap tj-sticky-item-2"><div class="tj-course-tab">
                <a class="tab-nav tj-scroll-btn" href="#about">About</a>
                <a class="tab-nav tj-scroll-btn" href="#expertise">Expertise</a>
                <a class="tab-nav tj-scroll-btn" href="#approach">Teaching Approach</a>
                <a class="tab-nav tj-scroll-btn" href="#courses">Courses</a>
              </div></div>

              <div id="about" class="tj-instructor-about">
                <h2 class="title">About <?= mentor_h($name) ?></h2>
                <p><?= mentor_h($name) ?> is a <?= mentor_h($role) ?> profile prepared for Forsk Coding School in Jaipur, focused on practical learning in <?= mentor_h($domain) ?>.</p>
                <p>The planned teaching areas include <?= mentor_h(implode(', ', array_slice($skills,0,5))) ?>. Sessions are designed around concept clarity, demonstrations, guided practice and project-oriented learning.</p>
                <p>This profile is part of the Forsk mentor content system. Identity, credentials, current affiliation and the final profile photograph should be verified before the page is enabled for search indexing.</p>

                <h2 class="title" id="expertise">Core Expertise</h2>
                <div class="tj-skill-lists">
                  <?php foreach ($skills as $skill): ?><span class="tj-skill-item"><?= mentor_h($skill) ?></span><?php endforeach; ?>
                </div>
              </div>

              <div id="approach" class="tj-instructor-experience">
                <h2 class="title">Teaching & Project Approach</h2>
                <div class="tj-instructor-experience-wrap">
                  <div class="tj-experience-item"><div class="experience-icon"><i class="tji-book"></i></div><div class="experience-content"><h3 class="experience-title">Concept-First Learning</h3><p class="desc">Build clear foundations in <?= mentor_h($skills[0] ?? $domain) ?> and related tools before moving into advanced workflows.</p></div></div>
                  <div class="tj-experience-item"><div class="experience-icon"><i class="tji-briefcase"></i></div><div class="experience-content"><h3 class="experience-title">Hands-on Practice</h3><p class="desc">Use guided exercises, practical examples and structured tasks to connect concepts with real implementation.</p></div></div>
                  <div class="tj-experience-item"><div class="experience-icon"><i class="tji-user-duo"></i></div><div class="experience-content"><h3 class="experience-title">Project-Oriented Mentoring</h3><p class="desc">Focus on portfolio-ready learning, debugging, problem solving and practical project discussions relevant to <?= mentor_h($domain) ?>.</p></div></div>
                </div>
              </div>

              <div id="courses" class="tj-instructor-courses">
                <h2 class="title">Related Courses at Forsk Coding School</h2>
                <div class="row rg-20">
                  <?php foreach ($course_cards as $course): ?>
                  <div class="col-md-6"><div class="tj-course-item"><div class="tj-course-content">
                    <div class="tj-cat-level-wrap"><div class="tj-categories"><a class="tj-cat" href="<?= mentor_h($course['file']) ?>"><?= mentor_h($domain) ?></a></div><div class="tj-level"><span>Practical Training</span></div></div>
                    <h3 class="title tj-fs-h5"><a href="<?= mentor_h($course['file']) ?>"><?= mentor_h($course['title']) ?></a></h3>
                    <span class="author"><a href="#about"><?= mentor_h($name) ?> Mentor Profile</a></span>
                    <div class="course-meta"><span><i class="tji-book"></i>Hands-on Learning</span><span><i class="tji-user-duo"></i>Career Focused</span></div>
                    <a class="tj-btn-primary tj-btn-primary-md flip-text-wrap" href="<?= mentor_h($course['file']) ?>"><span class="btn-text">View course</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                  </div></div></div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4"><div class="tj-sticky-item-2"><div class="tj-course-sidebar">
            <div class="tj-course-widget-price">
              <div class="price-wrap"><div class="course-price tj-fs-h6"><?= mentor_h($domain) ?> Mentor</div></div>
              <div class="course-end"><?= mentor_h(implode(', ', array_slice($skills,0,4))) ?></div>
              <div class="tj-instructor-info">
                <div class="info-item"><span class="title"><?= count($skills) ?>+</span><span class="text">Focus Skills</span></div>
                <div class="info-item"><span class="title"><?= count($course_cards) ?></span><span class="text">Related Courses</span></div>
                <div class="info-item"><span class="title">Jaipur</span><span class="text">Learning Location</span></div>
                <div class="info-item"><span class="title"><?= $image_available ? 'Ready' : 'Pending' ?></span><span class="text">Profile Image</span></div>
              </div>
              <a class="tj-btn-primary tj-btn-primary-md tj-btn-full flip-text-wrap" href="contact.php"><span class="btn-text">Enquire About Training</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
              <a class="tj-btn-primary tj-btn-primary-light tj-btn-primary-md tj-btn-full flip-text-wrap" href="courses.php"><span class="btn-text">Explore Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
              <div class="guarantee-text"><i class="tji-guarantee"></i>Practical, career-focused learning</div>
            </div>
            <div class="tj-course-widget"><h3 class="course-widget-title">Teaching Areas</h3><ul class="tj-course-includes">
              <?php foreach ($skills as $skill): ?><li><i class="tji-check"></i><?= mentor_h($skill) ?></li><?php endforeach; ?>
            </ul></div>
          </div></div></div>
        </div></div>
      </section>

      <section class="tj-details section-gap-bottom"><div class="container"><div class="row"><div class="col-lg-8">
        <h2>Learn <?= mentor_h($domain) ?> in Jaipur with <?= mentor_h($name) ?></h2>
        <p>This mentor profile is structured around <?= mentor_h($mentor['primary_keyword']) ?> and related practical skills, while keeping the content useful for learners rather than repeating keywords unnaturally.</p>
        <p>Explore relevant Forsk Coding School courses, compare learning paths and use the mentor directory to discover profiles by technology domain.</p>
      </div></div></div></section>
    </main>
    <?php include $site_root . '/includes/footer.php'; ?>
  </div>
</div>
</body>
</html>
