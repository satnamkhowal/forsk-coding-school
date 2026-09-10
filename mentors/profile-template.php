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
$image_disk = $site_root . '/mentors/images/' . $image_filename;
$image_available = is_file($image_disk);
$image_path = $image_available
    ? 'mentors/images/' . $image_filename
    : 'mentors/images/mentor-image-coming-soon.png';
$image_url = 'https://forskcodingschool.com/' . $image_path;
$published = !empty($mentor['verified']); // Internal publishing gate only; never shown as a public badge.
$in_house_verified = !empty($mentor['in_house_verified']);
$experience_verified = !empty($mentor['experience_verified']);
$experience_years = $experience_verified ? ($mentor['experience_years'] ?? null) : null;
$career_journey = ($experience_verified && !empty($mentor['career_journey'])) ? $mentor['career_journey'] : [];
$mentor_journey = $mentor['mentor_journey'] ?? [];
$availability_modes = $mentor['availability_modes'] ?? ['Online','Offline'];
$learning_format = $mentor['learning_format'] ?? 'Live Two-Way Interactive Classes';
$batch_size = $mentor['batch_size'] ?? '10–15 learners';
$remote_support = $mentor['remote_support'] ?? 'Consent-based remote troubleshooting when required';

$page_title = $mentor['meta_title'];
$page_description = $mentor['meta_description'];
$page_keywords = $mentor['primary_keyword'] . ', ' . $domain . ' mentor Jaipur, Forsk Coding School mentor';
$page_canonical = $url;
$page_robots = $published ? 'index, follow, max-image-preview:large' : 'noindex, nofollow, noarchive';
$page_og_image = $image_url;
$header_variant = 'header-1';

$page_schema = '';
if ($published) {
    $person = [
        '@type' => 'Person',
        '@id' => $url . '#mentor',
        'name' => $name,
        'url' => $url,
        'jobTitle' => $role,
        'knowsAbout' => array_values($skills),
    ];
    if ($in_house_verified) {
        $person['worksFor'] = [
            '@type' => 'EducationalOrganization',
            '@id' => 'https://forskcodingschool.com/#organization',
            'name' => 'Forsk Coding School',
            'url' => 'https://forskcodingschool.com/'
        ];
    }
    if ($image_available) {
        $person['image'] = $image_url;
    }

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
            $person,
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
<link rel="stylesheet" href="assets/css/mentor-profile-enhancements.css">
</head>
<body>
<?php include $site_root . '/includes/header.php'; ?>

<div id="smooth-wrapper">
  <div id="smooth-content">
    <main id="primary" class="site-main">
      <div class="space-for-header"></div>

      <section class="tj-page-header tj-page-header-2 mentor-hero-upgrade">
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
              <div class="tj-instructor-img mentor-photo-frame">
                <img src="<?= mentor_h($image_path) ?>"
                     alt="<?= mentor_h($mentor['image_alt']) ?>"
                     title="<?= mentor_h($mentor['image_title']) ?>"
                     data-description="<?= mentor_h($mentor['image_caption']) ?>"
                     width="800" height="800" decoding="async">
              </div>
              <div class="tj-instructor-content">
                <div class="mentor-kicker">Forsk Coding School • Jaipur</div>
                <div class="tj-categories">
                  <a class="tj-cat" href="mentors/?domain=<?= urlencode($domain) ?>"><?= mentor_h($domain) ?></a>
                  <?php if ($in_house_verified): ?><span class="tj-cat mentor-inhouse">In-house Mentor</span><?php endif; ?>
                </div>
                <div class="name-area">
                  <h1 class="name tj-fs-h2"><?= mentor_h($name) ?></h1>
                  <span class="designation"><?= mentor_h($role) ?></span>
                </div>
                <div class="mentor-highlight-pills">
                  <span>Online + Offline</span>
                  <span>Live Two-Way Classes</span>
                  <span><?= mentor_h($batch_size) ?> / Batch</span>
                  <?php if ($experience_years): ?><span><?= mentor_h($experience_years) ?>+ Years Experience</span><?php endif; ?>
                </div>
              </div>
            </div>
            <div class="shape"><img src="assets/images/shapes/stars.png" alt=""></div>
          </div></div></div>
        </div>
      </section>

      <section class="mentor-live-lab-strip">
        <div class="container">
          <div class="mentor-live-lab-grid">
            <div><strong>Live Two-Way</strong><span>Ask questions while the mentor is teaching</span></div>
            <div><strong>10–15 Learners</strong><span>Micro-batches for meaningful interaction</span></div>
            <div><strong>Online + Offline</strong><span>Learn in Jaipur or join live from anywhere</span></div>
            <div><strong>Remote Debug Support</strong><span>Consent-based screen troubleshooting when needed</span></div>
          </div>
        </div>
      </section>

      <section class="tj-details section-gap-bottom fix tj-sticky-container-2">
        <div class="container"><div class="row">
          <div class="col-lg-8">
            <div class="tj-course-details-wrapper tj-tab-sticky-wrapper">
              <div class="tj-course-tab-wrap tj-sticky-item-2"><div class="tj-course-tab">
                <a class="tab-nav tj-scroll-btn" href="#about">About</a>
                <a class="tab-nav tj-scroll-btn" href="#expertise">Expertise</a>
                <a class="tab-nav tj-scroll-btn" href="#journey">Journey</a>
                <a class="tab-nav tj-scroll-btn" href="#live-learning">Live Learning</a>
                <a class="tab-nav tj-scroll-btn" href="#courses">Courses</a>
              </div></div>

              <div id="about" class="tj-instructor-about">
                <h2 class="title">Learn <?= mentor_h($domain) ?> with <?= mentor_h($name) ?></h2>
                <p><?= mentor_h($name) ?> focuses on practical, mentor-led learning in <?= mentor_h($domain) ?> through <?= mentor_h(implode(', ', array_slice($skills,0,5))) ?> and related tools.</p>
                <p>Sessions combine concept clarity, live demonstrations, learner questions, guided practice, debugging and project-oriented implementation. The objective is to make every class interactive rather than one-way video delivery.</p>

                <h2 class="title" id="expertise">Core Expertise</h2>
                <div class="tj-skill-lists">
                  <?php foreach ($skills as $skill): ?><span class="tj-skill-item"><?= mentor_h($skill) ?></span><?php endforeach; ?>
                </div>
              </div>

              <div id="journey" class="tj-instructor-experience">
                <?php if ($career_journey): ?>
                <h2 class="title">Professional Experience Journey</h2>
                <div class="tj-instructor-experience-wrap">
                  <?php foreach ($career_journey as $step): ?>
                  <div class="tj-experience-item"><div class="experience-icon"><i class="tji-briefcase"></i></div><div class="experience-content">
                    <h3 class="experience-title"><?= mentor_h($step['role'] ?? '') ?></h3>
                    <span class="experience-year"><?= mentor_h($step['company'] ?? '') ?><?= !empty($step['period']) ? ' • '.mentor_h($step['period']) : '' ?></span>
                    <?php if (!empty($step['description'])): ?><p class="desc"><?= mentor_h($step['description']) ?></p><?php endif; ?>
                  </div></div>
                  <?php endforeach; ?>
                </div>
                <?php else: ?>
                <h2 class="title">Mentoring & Project Journey</h2>
                <div class="tj-instructor-experience-wrap">
                  <?php foreach ($mentor_journey as $step): ?>
                  <div class="tj-experience-item"><div class="experience-icon"><i class="tji-book"></i></div><div class="experience-content">
                    <h3 class="experience-title"><?= mentor_h($step['title'] ?? '') ?></h3>
                    <p class="desc"><?= mentor_h($step['description'] ?? '') ?></p>
                  </div></div>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
              </div>

              <div id="live-learning" class="mentor-live-learning-section">
                <div class="mentor-section-heading">
                  <span class="mentor-eyebrow">Forsk Live MentorLab</span>
                  <h2>Not a one-way online class. A live two-way mentor room.</h2>
                  <p>Every session is designed so learners can interrupt constructively, ask questions, share code or screens, and get feedback while the topic is being taught.</p>
                </div>
                <div class="mentor-feature-cards">
                  <article><h3>Interactive by Design</h3><p>The mentor teaches live and learners can ask questions in the same session instead of waiting for recorded-video support.</p></article>
                  <article><h3>Micro-Batch Attention</h3><p>Target batch size is <?= mentor_h($batch_size) ?> so the mentor can engage with individual questions and learning gaps.</p></article>
                  <article><h3>Code & Project Review</h3><p>Use screen sharing, live debugging and mentor feedback to understand why something works—not only what to type.</p></article>
                  <article><h3>Remote Troubleshooting</h3><p>When a learner requests technical help, support may use AnyDesk or a similar remote-support tool with explicit permission. The learner stays present and can end the session at any time; passwords, OTPs and unrelated private files should never be requested.</p></article>
                </div>
              </div>

              <div id="courses" class="tj-instructor-courses">
                <h2 class="title">Related Courses at Forsk Coding School</h2>
                <div class="row rg-20">
                  <?php foreach ($course_cards as $course): ?>
                  <div class="col-md-6"><div class="tj-course-item"><div class="tj-course-content">
                    <div class="tj-cat-level-wrap"><div class="tj-categories"><a class="tj-cat" href="<?= mentor_h($course['file']) ?>"><?= mentor_h($domain) ?></a></div><div class="tj-level"><span>Live Mentor Training</span></div></div>
                    <h3 class="title tj-fs-h5"><a href="<?= mentor_h($course['file']) ?>"><?= mentor_h($course['title']) ?></a></h3>
                    <span class="author"><a href="#about"><?= mentor_h($name) ?></a></span>
                    <div class="course-meta"><span><i class="tji-book"></i>Hands-on Learning</span><span><i class="tji-user-duo"></i>Two-Way Q&A</span></div>
                    <a class="tj-btn-primary tj-btn-primary-md flip-text-wrap" href="<?= mentor_h($course['file']) ?>"><span class="btn-text">View course</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                  </div></div></div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4"><div class="tj-sticky-item-2"><div class="tj-course-sidebar">
            <div class="tj-course-widget-price mentor-sidebar-card">
              <div class="price-wrap"><div class="course-price tj-fs-h6"><?= mentor_h($domain) ?> Mentor</div></div>
              <div class="course-end"><?= mentor_h(implode(', ', array_slice($skills,0,4))) ?></div>
              <div class="tj-instructor-info">
                <div class="info-item"><span class="title">Online</span><span class="text">Live Access</span></div>
                <div class="info-item"><span class="title">Offline</span><span class="text">Jaipur</span></div>
                <div class="info-item"><span class="title">10–15</span><span class="text">Batch Size</span></div>
                <div class="info-item"><span class="title">2-Way</span><span class="text">Live Communication</span></div>
              </div>
              <a class="tj-btn-primary tj-btn-primary-md tj-btn-full flip-text-wrap" href="contact.php"><span class="btn-text">Book a Mentor-Led Demo</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
              <a class="tj-btn-primary tj-btn-primary-light tj-btn-primary-md tj-btn-full flip-text-wrap" href="courses.php"><span class="btn-text">Explore Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
              <div class="guarantee-text"><i class="tji-guarantee"></i>Live, interactive, project-focused learning</div>
            </div>
            <div class="tj-course-widget"><h3 class="course-widget-title">Teaching Areas</h3><ul class="tj-course-includes">
              <?php foreach ($skills as $skill): ?><li><i class="tji-check"></i><?= mentor_h($skill) ?></li><?php endforeach; ?>
            </ul></div>
          </div></div></div>
        </div></div>
      </section>

      <section class="tj-details section-gap-bottom"><div class="container"><div class="row"><div class="col-lg-8">
        <h2>Mentor-led <?= mentor_h($domain) ?> Training in Jaipur</h2>
        <p>Forsk Coding School combines live mentor interaction, small-batch learning, practical assignments and project feedback for learners who want more support than a recorded course can provide.</p>
        <p>Choose online or offline learning, ask questions during class, and use structured troubleshooting support when you get stuck during practice.</p>
      </div></div></div></section>
    </main>
    <?php include $site_root . '/includes/footer.php'; ?>
  </div>
</div>
</body>
</html>
