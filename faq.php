<?php
require_once __DIR__ . '/config.php';

$page_title = 'Forsk Coding School FAQs | Courses, Admissions & Training Jaipur';
$page_description = 'Answers to common questions about Forsk Coding School courses, admissions, learning modes, projects, internships and career preparation in Jaipur.';
$page_canonical = seo_url('faq.php');
$header_variant = 'header-1';

$faq_items = [
    [
        'q' => 'What courses does Forsk Coding School offer in Jaipur?',
        'a' => 'Forsk Coding School offers programming, full-stack development, data analytics, data science, artificial intelligence and machine learning, cloud, cybersecurity, software testing, digital marketing and other technology-focused training. Current course availability can be checked on the Courses page.'
    ],
    [
        'q' => 'Can beginners join Forsk Coding School courses?',
        'a' => 'Yes. Many programs are designed to start from fundamentals and progress toward practical applications. The recommended starting point depends on your current skills and the course you choose.'
    ],
    [
        'q' => 'Are courses available online and offline?',
        'a' => 'Learning mode can vary by course and batch. Contact the admissions team for the current online, offline or hybrid options available for the program you want to join.'
    ],
    [
        'q' => 'Does the training include practical projects?',
        'a' => 'Practical learning is part of the training approach for relevant technical programs. Project scope and tools differ by course, so review the individual course page or speak with the admissions team for the current curriculum.'
    ],
    [
        'q' => 'Does Forsk Coding School provide internship or career preparation support?',
        'a' => 'Selected programs may include internship opportunities, interview preparation, project guidance or career-support activities. Availability and eligibility depend on the specific program and current batch.'
    ],
    [
        'q' => 'How can I check course fees and batch timings?',
        'a' => 'Fees, schedules and batch availability can change. Use the enquiry or contact page to get the latest information for the exact course and learning mode you are interested in.'
    ],
    [
        'q' => 'Where is Forsk Coding School located?',
        'a' => 'Forsk Coding School operates in Jaipur, Rajasthan. For the latest branch address, directions and contact information, use the Contact page or the relevant Jaipur location page.'
    ],
    [
        'q' => 'How do I choose the right course?',
        'a' => 'Choose based on your current level, target role and preferred technology. Beginners can start with programming foundations, while learners targeting specific roles can compare full-stack, data, AI, cloud, cybersecurity, testing and digital-marketing pathways.'
    ]
];

$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(static function ($item) {
        return [
            '@type' => 'Question',
            'name' => $item['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $item['a']
            ]
        ];
    }, $faq_items)
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
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
          <div class="row">
            <div class="col-12">
              <div class="tj-page-header-content">
                <h1 class="tj-page-title">Forsk Coding School FAQs</h1>
                <div class="tj-page-link">
                  <span><i class="tji-home"></i></span>
                  <span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span>
                  <span><i class="tji-arrow-right-4"></i></span>
                  <span>FAQs</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="tj-faq-section-4 section-gap">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9">
              <div class="sec-heading sec-heading-center">
                <span class="sec-subtitle"><i class="tji-subtitle"></i> Student Help</span>
                <h2 class="sec-title">Common questions about courses and admissions</h2>
                <p>Use these answers as a starting point. For fees, batch schedules and current availability, contact the admissions team because those details can change by course and intake.</p>
              </div>

              <div class="tj-faq tj-faq-3" id="forskFaqAccordion">
                <?php foreach ($faq_items as $index => $item):
                    $collapse_id = 'forsk-faq-' . ($index + 1);
                    $is_first = $index === 0;
                ?>
                  <div class="tj-accordion-item">
                    <button class="tj-accordion-title<?= $is_first ? '' : ' collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapse_id ?>" aria-expanded="<?= $is_first ? 'true' : 'false' ?>" aria-controls="<?= $collapse_id ?>">
                      <?= htmlspecialchars($item['q'], ENT_QUOTES, 'UTF-8') ?>
                    </button>
                    <div id="<?= $collapse_id ?>" class="collapse<?= $is_first ? ' show' : '' ?>" data-bs-parent="#forskFaqAccordion">
                      <div class="accordion-body tj-accordion-content">
                        <?= htmlspecialchars($item['a'], ENT_QUOTES, 'UTF-8') ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="text-center mt-5">
                <h2>Still have a question?</h2>
                <p>Check the full course catalogue or contact Forsk Coding School for current admissions information.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                  <a class="tj-primary-btn" href="<?= htmlspecialchars(site_url('courses.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text"><span>Explore Courses</span></span></a>
                  <a class="tj-primary-btn" href="<?= htmlspecialchars(site_url('contact.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text"><span>Contact Admissions</span></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
  </div>
</div>
</body>
</html>
