<?php
require_once __DIR__ . '/config.php';
$courses = require __DIR__ . '/includes/course-catalog-data.php';
$categories = [];
foreach ($courses as $course) {
    $categories[$course['category']] = true;
}
$categories = array_keys($categories);
sort($categories, SORT_NATURAL | SORT_FLAG_CASE);

$page_title = 'Best IT & Coding Courses in Jaipur | Forsk Coding School';
$page_description = "Explore Forsk Coding School's practical IT courses in Jaipur across programming, full stack, data science, AI, cloud, cybersecurity, testing, digital marketing, design and mobile development.";
$page_canonical = 'https://forskcodingschool.com/courses.php';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => $page_canonical . '#webpage',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'isPartOf' => ['@id' => 'https://forskcodingschool.com/#website'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => site_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Courses', 'item' => $page_canonical],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';

function course_image(array $course): string
{
    if (!empty($course['image'])) {
        return $course['image'];
    }

    $base = preg_replace('/\.php$/', '', $course['slug']);
    return 'assets/images/' . $base . '-forsk-coding-school.webp';
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <?php include __DIR__ . '/includes/head.php'; ?>
</head>
<body>
  <?php include __DIR__ . '/includes/header.php'; ?>
  <div id="smooth-wrapper">
    <div id="smooth-content">
      <main id="primary" class="site-main">
        <div class="space-for-header"></div>

        <section class="tj-page-header">
          <div class="container">
            <div class="row align-items-end rg-30">
              <div class="col-lg-8">
                <div class="tj-page-header-content">
                  <div class="tj-page-link">
                    <span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span>
                    <span><i class="tji-arrow-right-4"></i></span>
                    <span>Courses</span>
                  </div>
                  <h1 class="tj-page-title">Job-Oriented IT & Coding Courses in Jaipur</h1>
                  <p>Compare practical learning paths across programming, full stack, data, AI, cloud, cybersecurity, testing, digital marketing, design and mobile development.</p>
                </div>
              </div>
              <div class="col-lg-4">
                <p class="mb-0">Choose a course to review its curriculum, learning focus and admission details. Course-specific schedules and fees can be confirmed with the admissions team.</p>
              </div>
            </div>
          </div>
        </section>

        <section class="tj-course-section section-gap">
          <div class="container">
            <div class="row rg-30 mb-4 align-items-end">
              <div class="col-lg-7">
                <label for="course-search" class="form-label">Search courses</label>
                <div class="search-box">
                  <input id="course-search" type="search" class="form-control" placeholder="Search Python, Java, data analytics, cloud..." autocomplete="off" aria-describedby="course-results-status">
                </div>
              </div>
              <div class="col-lg-5">
                <label for="course-category" class="form-label">Filter by category</label>
                <select id="course-category" class="form-select">
                  <option value="">All categories</option>
                  <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars(strtolower($category), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
              <p id="course-results-status" class="mb-0" aria-live="polite"><strong><?= count($courses) ?></strong> learning options available.</p>
              <button id="course-reset" class="tj-btn-primary tj-btn-primary-sm" type="button">Clear filters</button>
            </div>

            <div id="course-grid" class="row tj-course-wrapper rg-30">
              <?php foreach ($courses as $course):
                  $searchText = strtolower($course['name'] . ' ' . $course['category']);
                  $image = course_image($course);
              ?>
                <div class="col-lg-4 col-md-6 course-col" data-course-card data-category="<?= htmlspecialchars(strtolower($course['category']), ENT_QUOTES, 'UTF-8') ?>" data-search="<?= htmlspecialchars($searchText, ENT_QUOTES, 'UTF-8') ?>">
                  <article class="tj-course-item h-100">
                    <div class="tj-course-img">
                      <a href="<?= htmlspecialchars($course['slug'], ENT_QUOTES, 'UTF-8') ?>">
                        <figure>
                          <img src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                               alt="<?= htmlspecialchars($course['name'] . ' in Jaipur at Forsk Coding School', ENT_QUOTES, 'UTF-8') ?>"
                               loading="lazy" decoding="async">
                          <figcaption class="visually-hidden"><?= htmlspecialchars($course['name'] . ' in Jaipur', ENT_QUOTES, 'UTF-8') ?></figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="tj-course-content">
                      <div class="tj-cat-level-wrap">
                        <div class="tj-categories"><span class="tj-cat"><?= htmlspecialchars($course['category'], ENT_QUOTES, 'UTF-8') ?></span></div>
                        <div class="tj-level"><span>Practical Training</span></div>
                      </div>
                      <h2 class="title tj-fs-h5">
                        <a href="<?= htmlspecialchars($course['slug'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($course['name'] . ' in Jaipur', ENT_QUOTES, 'UTF-8') ?></a>
                      </h2>
                      <p>Explore the course outline, practical learning focus and career-oriented training details.</p>
                      <div class="tj-course-price-wrap">
                        <div class="course-price tj-fs-h6">Course Details</div>
                      </div>
                      <a class="tj-btn-primary tj-btn-primary-md flip-text-wrap" href="<?= htmlspecialchars($course['slug'], ENT_QUOTES, 'UTF-8') ?>">
                        <span class="btn-text">View Course</span>
                        <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                      </a>
                    </div>
                  </article>
                </div>
              <?php endforeach; ?>
            </div>

            <div id="course-empty" class="text-center py-5" hidden>
              <h2 class="tj-fs-h4">No matching course found</h2>
              <p>Try another topic or clear the category filter. You can also contact admissions for help choosing a learning path.</p>
              <a class="tj-btn-primary" href="<?= htmlspecialchars(site_url('enroll-now.php'), ENT_QUOTES, 'UTF-8') ?>">Contact Admissions</a>
            </div>
          </div>
        </section>

        <section class="section-gap-bottom">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-9 text-center">
                <h2>Need help choosing the right course?</h2>
                <p>Share your current skills, study background and career goal with the admissions team for course guidance. Availability, batch timing and fees can vary by program.</p>
                <a class="tj-btn-primary" href="<?= htmlspecialchars(site_url('enroll-now.php'), ENT_QUOTES, 'UTF-8') ?>">Enquire About a Course</a>
              </div>
            </div>
          </div>
        </section>
      </main>

      <?php include __DIR__ . '/includes/footer.php'; ?>
    </div>
  </div>

  <script>
    (() => {
      const search = document.getElementById('course-search');
      const category = document.getElementById('course-category');
      const reset = document.getElementById('course-reset');
      const cards = Array.from(document.querySelectorAll('[data-course-card]'));
      const status = document.getElementById('course-results-status');
      const empty = document.getElementById('course-empty');

      const normalize = value => value.toLowerCase().trim();

      const applyFilters = () => {
        const query = normalize(search.value);
        const selectedCategory = normalize(category.value);
        let visible = 0;

        cards.forEach(card => {
          const matchesQuery = !query || card.dataset.search.includes(query);
          const matchesCategory = !selectedCategory || card.dataset.category === selectedCategory;
          const show = matchesQuery && matchesCategory;
          card.hidden = !show;
          if (show) visible += 1;
        });

        status.innerHTML = `<strong>${visible}</strong> learning option${visible === 1 ? '' : 's'} shown.`;
        empty.hidden = visible !== 0;
      };

      search.addEventListener('input', applyFilters);
      category.addEventListener('change', applyFilters);
      reset.addEventListener('click', () => {
        search.value = '';
        category.value = '';
        applyFilters();
        search.focus();
      });
    })();
  </script>
</body>
</html>
