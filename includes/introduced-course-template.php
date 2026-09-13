<?php
if (!isset($introduced_course) || !is_array($introduced_course)) {
    http_response_code(500);
    exit('Course configuration is missing.');
}
require_once dirname(__DIR__) . '/config.php';

$name = (string)($introduced_course['name'] ?? 'Course');
$slug = basename((string)($_SERVER['SCRIPT_NAME'] ?? 'course.php'));
$fee = $introduced_course['fee'] ?? null;
$feeLabel = is_numeric($fee) ? '₹' . number_format((float)$fee, 0, '.', ',') : 'Fees on Request';
$description = (string)($introduced_course['description'] ?? ('Learn ' . $name . ' with practical training at Forsk Coding School Jaipur.'));
$includes = array_values(array_filter((array)($introduced_course['includes'] ?? [])));
$outcomes = array_values(array_filter((array)($introduced_course['outcomes'] ?? [])));
$audience = array_values(array_filter((array)($introduced_course['audience'] ?? [])));

$page_title = $name . ' Course in Jaipur | Forsk Coding School';
$page_description = $description;
$page_keywords = (string)($introduced_course['keywords'] ?? ($name . ' course Jaipur, ' . $name . ' training Jaipur, Forsk Coding School'));
$page_canonical = SEO_BASE_URL . '/' . $slug;
$header_variant = 'header-1';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Course',
            'name' => $name . ' Course in Jaipur',
            'description' => $description,
            'url' => $page_canonical,
            'provider' => [
                '@type' => 'EducationalOrganization',
                'name' => 'Forsk Coding School',
                'url' => SEO_BASE_URL . '/',
            ],
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'INR',
                'price' => is_numeric($fee) ? (string)$fee : '0',
                'availability' => 'https://schema.org/InStock',
                'url' => $page_canonical,
                'description' => is_numeric($fee) ? ('Current listed course fee: ' . $feeLabel) : 'Contact Forsk Coding School for the current fee.',
            ],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => SEO_BASE_URL . '/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Courses', 'item' => SEO_BASE_URL . '/courses.php'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $name, 'item' => $page_canonical],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

function introduced_course_h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
<head>
  <?php include __DIR__ . '/head.php'; ?>
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main id="primary" class="site-main">
  <div class="space-for-header"></div>
  <section class="tj-page-header tj-page-header-2">
    <div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
      <div class="tj-page-link"><span><i class="tji-home"></i></span><span><a href="./">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span><a href="courses.php">Courses</a></span><span><i class="tji-arrow-right-4"></i></span><span><?= introduced_course_h($name) ?></span></div>
      <h1 class="name tj-fs-h2"><?= introduced_course_h($name) ?> Course in Jaipur</h1>
      <p><?= introduced_course_h($description) ?></p>
    </div></div></div></div>
  </section>

  <section class="tj-details section-gap">
    <div class="container"><div class="row rg-30">
      <div class="col-lg-8">
        <div class="tj-course-item" style="height:auto">
          <div class="tj-course-content">
            <div class="tj-cat-level-wrap"><div class="tj-categories"><span class="tj-cat"><?= introduced_course_h($introduced_course['category'] ?? 'Technology') ?></span></div><div class="tj-level"><span>Practical Learning</span></div></div>
            <h2 class="title tj-fs-h4">What you will learn</h2>
            <p><?= introduced_course_h($description) ?></p>
            <?php if ($includes): ?>
            <h3 class="tj-fs-h5">Course coverage</h3>
            <ul>
              <?php foreach ($includes as $item): ?><li><?= introduced_course_h($item) ?></li><?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php if ($outcomes): ?>
            <h3 class="tj-fs-h5">Learning outcomes</h3>
            <ul>
              <?php foreach ($outcomes as $item): ?><li><?= introduced_course_h($item) ?></li><?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php if ($audience): ?>
            <h3 class="tj-fs-h5">Who can join</h3>
            <ul>
              <?php foreach ($audience as $item): ?><li><?= introduced_course_h($item) ?></li><?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <aside class="tj-course-item" style="height:auto;position:sticky;top:110px">
          <div class="tj-course-content">
            <span class="tj-cat">Current listed fee</span>
            <div class="course-price tj-fs-h3" style="margin:12px 0 18px"><?= introduced_course_h($feeLabel) ?></div>
            <p>Confirm the current batch schedule, learning mode and applicable fee before enrolment.</p>
            <a class="tj-btn-primary tj-btn-primary-md flip-text-wrap" href="contact.php?course=<?= rawurlencode($name) ?>"><span class="btn-text">Request Course Counselling</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
            <p style="margin-top:14px"><a href="mentors/">Explore existing mentor profiles →</a></p>
          </div>
        </aside>
      </div>
    </div></div>
  </section>
</main>
<?php include __DIR__ . '/footer.php'; ?>
</div></div>
</body>
</html>
