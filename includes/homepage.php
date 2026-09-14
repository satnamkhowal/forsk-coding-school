<?php
require_once dirname(__DIR__) . '/config.php';

$page_title = 'Forsk Coding School Jaipur | Coding & IT Training';
$page_description = 'Learn Python, Java, Full Stack, Data Analytics, AI and other practical IT skills in Jaipur with projects, mentor guidance, internships and career-focused training.';
$page_keywords = 'Forsk Coding School Jaipur, coding institute Jaipur, IT training Jaipur, Python course Jaipur, Java course Jaipur, Full Stack course Jaipur, Data Analytics course Jaipur, AI course Jaipur';
$page_canonical = SEO_BASE_URL . '/';
$page_og_image = seo_url('assets/images/hero/h2-hero-img.webp');
$header_variant = 'header-1';

$featuredPrograms = [
    ['Python Programming', 'Programming', 'python-programming-course-jaipur.php', 'assets/images/python-programming-course-jaipur-forsk-coding-school.webp', 'Build programming fundamentals, problem-solving ability and practical Python skills.'],
    ['Full Stack Development', 'Development', 'full-stack-development-course-jaipur.php', 'assets/images/full-stack-development-course-jaipur-forsk-coding-school.webp', 'Learn front-end and back-end development through structured practice and projects.'],
    ['Data Analytics', 'Data', 'data-analytics-course-jaipur.php', 'assets/images/data-analytics-course-jaipur-forsk-coding-school.webp', 'Work with Excel, SQL, Python and Power BI concepts for practical analytics workflows.'],
    ['Artificial Intelligence', 'AI', 'artificial-intelligence-course-jaipur.php', 'assets/images/generative-ai-course-jaipur-forsk-coding-school.webp', 'Understand AI foundations, modern tools and applied learning through guided exercises.'],
    ['Java Programming', 'Programming', 'java-programming-course-jaipur.php', 'assets/images/java-courses-jaipur-forsk-coding-school.webp', 'Strengthen Core Java concepts, OOP, problem solving and application-development fundamentals.'],
    ['Cloud & DevOps', 'Cloud', 'devops-course-jaipur.php', 'assets/images/aws-course-jaipur-forsk-coding-school.webp', 'Explore deployment, automation and modern cloud-development workflows with practical guidance.'],
];

$faqs = [
    ['Which coding courses are available at Forsk Coding School in Jaipur?', 'Forsk Coding School offers learning paths in Python, Java, C/C++, Full Stack Development, Data Analytics, Data Science, Artificial Intelligence, Cloud and DevOps, Cyber Security, Software Testing, Digital Marketing, UI/UX, mobile development and related technologies.'],
    ['Can beginners join the courses?', 'Yes. Many programs can start from fundamentals. The right starting point depends on your current qualification, prior experience and learning goal, so counselling is recommended before selecting a batch.'],
    ['Are online and offline learning options available?', 'Learning mode can vary by program and current batch. You can submit an enquiry to confirm current offline Jaipur and live online options for the course you want.'],
    ['Does Forsk Coding School provide internships or project training?', 'Forsk Coding School has separate internship, industrial training, live-project and final-year-project learning pages. Availability and structure depend on the selected program and current intake.'],
    ['Does the institute guarantee a job or college admission?', 'No. Forsk Coding School can provide training, career guidance, placement assistance and admission-process guidance where applicable, but jobs and college admissions depend on employer or institution requirements, eligibility, performance and availability.'],
];

$schemaPrograms = [];
foreach ($featuredPrograms as $i => $program) {
    $schemaPrograms[] = [
        '@type' => 'ListItem',
        'position' => $i + 1,
        'name' => $program[0],
        'url' => seo_url($program[2]),
    ];
}
$schemaFaqs = [];
foreach ($faqs as $faq) {
    $schemaFaqs[] = [
        '@type' => 'Question',
        'name' => $faq[0],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
    ];
}
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebSite',
            '@id' => SEO_BASE_URL . '/#website',
            'url' => SEO_BASE_URL . '/',
            'name' => SITE_NAME,
            'publisher' => ['@id' => SITE_ORGANIZATION_ID],
            'inLanguage' => 'en-IN',
        ],
        [
            '@type' => 'WebPage',
            '@id' => SEO_BASE_URL . '/#webpage',
            'url' => SEO_BASE_URL . '/',
            'name' => $page_title,
            'description' => $page_description,
            'isPartOf' => ['@id' => SEO_BASE_URL . '/#website'],
            'about' => ['@id' => SITE_ORGANIZATION_ID],
            'inLanguage' => 'en-IN',
        ],
        [
            '@type' => 'ItemList',
            'name' => 'Featured Coding and IT Courses in Jaipur',
            'itemListElement' => $schemaPrograms,
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => $schemaFaqs,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
<head>
  <?php include __DIR__ . '/head.php'; ?>
  <link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/homepage.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>
  <div id="smooth-wrapper">
    <div id="smooth-content">
      <main id="primary" class="site-main forsk-home">
        <div class="space-for-header"></div>

        <section class="forsk-hero" aria-labelledby="home-title">
          <div class="container">
            <div class="row align-items-center gy-4">
              <div class="col-lg-7">
                <div class="forsk-hero-copy">
                  <span class="forsk-eyebrow"><i class="tji-subtitle"></i> Practical technology training in Jaipur</span>
                  <h1 id="home-title">Coding &amp; IT Training in Jaipur for Practical, Job-Ready Skills</h1>
                  <p class="lead">Learn through structured lessons, coding practice, guided projects and mentor support. Explore programming, Full Stack, Data Analytics, AI, cloud, cybersecurity and other career-focused learning paths at Forsk Coding School.</p>
                  <div class="forsk-actions">
                    <a class="tj-btn-primary flip-text-wrap" href="courses.php"><span class="btn-text">Explore Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                    <a class="tj-btn-primary tj-btn-primary-light flip-text-wrap" href="#enquiry"><span class="btn-text">Get Free Counselling</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                  </div>
                  <ul class="forsk-trust-pills" aria-label="Learning options">
                    <li><i class="tji-check"></i> Practical projects</li>
                    <li><i class="tji-check"></i> Mentor guidance</li>
                    <li><i class="tji-check"></i> Internship pathways</li>
                    <li><i class="tji-check"></i> Online &amp; Jaipur options</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="forsk-hero-media">
                  <img src="<?= htmlspecialchars(asset_url('images/hero/h2-hero-img.webp'), ENT_QUOTES, 'UTF-8') ?>" fetchpriority="high" alt="Student learning coding and technology skills at Forsk Coding School Jaipur">
                  <div class="forsk-hero-note"><strong>Not sure where to start?</strong><span>Tell us your goal and current qualification. We will help you shortlist a suitable learning path.</span></div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section aria-label="Explore Forsk programs">
          <div class="container">
            <div class="forsk-quick-grid">
              <article class="forsk-quick-card"><small>Learn</small><h2>Courses</h2><p>Programming, Full Stack, Data, AI, Cloud, Cyber Security and more.</p><a href="courses.php">Browse all courses →</a></article>
              <article class="forsk-quick-card"><small>Build experience</small><h2>Internships</h2><p>Explore internship, industrial training, live-project and final-year project options.</p><a href="internship-programs-jaipur.php">Explore internships →</a></article>
              <article class="forsk-quick-card"><small>Long-form learning</small><h2>Diploma Programs</h2><p>Structured diploma learning paths across selected technology and digital domains.</p><a href="diploma-programs-jaipur.php">View diploma programs →</a></article>
              <article class="forsk-quick-card"><small>Guidance</small><h2>College Admissions</h2><p>Admission-process guidance for BCA, MCA, B.Tech and BBA applicants.</p><a href="college-admissions-jaipur.php">Explore admissions →</a></article>
            </div>
          </div>
        </section>

        <section class="forsk-section" aria-labelledby="popular-programs-title">
          <div class="container">
            <span class="forsk-eyebrow"><i class="tji-subtitle"></i> Popular learning paths</span>
            <h2 class="forsk-section-title" id="popular-programs-title">Choose a Skill Path That Matches Your Goal</h2>
            <p class="forsk-section-copy">Start with fundamentals or move into a focused specialization. Each course page explains the learning direction, practical focus and enquiry options without forcing you into a one-size-fits-all path.</p>
            <div class="forsk-program-grid">
              <?php foreach ($featuredPrograms as $program): ?>
                <article class="forsk-program-card">
                  <a class="media" href="<?= htmlspecialchars($program[2], ENT_QUOTES, 'UTF-8') ?>" aria-label="View <?= htmlspecialchars($program[0], ENT_QUOTES, 'UTF-8') ?> course">
                    <img src="<?= htmlspecialchars(asset_url(str_replace('assets/', '', $program[3])), ENT_QUOTES, 'UTF-8') ?>" loading="lazy" alt="<?= htmlspecialchars($program[0], ENT_QUOTES, 'UTF-8') ?> course in Jaipur at Forsk Coding School">
                  </a>
                  <div class="forsk-program-body">
                    <span class="kicker"><?= htmlspecialchars($program[1], ENT_QUOTES, 'UTF-8') ?></span>
                    <h3><?= htmlspecialchars($program[0], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($program[4], ENT_QUOTES, 'UTF-8') ?></p>
                    <a href="<?= htmlspecialchars($program[2], ENT_QUOTES, 'UTF-8') ?>">View course details →</a>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
            <div class="forsk-actions mt-4">
              <a class="tj-btn-primary flip-text-wrap" href="courses.php"><span class="btn-text">Browse All Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
            </div>
          </div>
        </section>

        <section class="forsk-section forsk-section-soft" aria-labelledby="why-forsk-title">
          <div class="container">
            <span class="forsk-eyebrow"><i class="tji-subtitle"></i> Learning approach</span>
            <h2 class="forsk-section-title" id="why-forsk-title">Why Students Choose Forsk Coding School</h2>
            <p class="forsk-section-copy">The focus is practical learning: understand the concept, practise it, apply it in guided work and learn how the skill connects with real technology workflows.</p>
            <div class="forsk-feature-grid">
              <article class="forsk-feature"><span class="num">01</span><h3>Clear Fundamentals</h3><p>Build the base before moving into frameworks, tools and advanced implementation.</p></article>
              <article class="forsk-feature"><span class="num">02</span><h3>Hands-on Practice</h3><p>Use exercises, assignments and project-oriented work to turn concepts into usable skills.</p></article>
              <article class="forsk-feature"><span class="num">03</span><h3>Mentor Support</h3><p>Get guidance around learning sequence, projects, troubleshooting and skill improvement.</p></article>
              <article class="forsk-feature"><span class="num">04</span><h3>Career Preparation</h3><p>Connect learning with portfolios, interviews, practical confidence and placement assistance.</p></article>
            </div>
          </div>
        </section>

        <section class="forsk-section" aria-labelledby="beyond-courses-title">
          <div class="container">
            <span class="forsk-eyebrow"><i class="tji-subtitle"></i> Beyond regular courses</span>
            <h2 class="forsk-section-title" id="beyond-courses-title">Internship Training &amp; College Admission Guidance</h2>
            <div class="row g-4 mt-2">
              <div class="col-lg-6">
                <article class="forsk-split-card is-accent">
                  <h2>Internship &amp; Project Training</h2>
                  <p>For students who need practical exposure, structured project work or academic project guidance alongside their technical learning.</p>
                  <ul class="forsk-link-list">
                    <li><a href="summer-internship-jaipur.php">Summer Internship</a></li>
                    <li><a href="winter-internship-jaipur.php">Winter Internship</a></li>
                    <li><a href="industrial-training-jaipur.php">Industrial Training</a></li>
                    <li><a href="live-project-training-jaipur.php">Live Project Training</a></li>
                    <li><a href="final-year-projects-jaipur.php">Final Year Projects</a></li>
                  </ul>
                  <a class="tj-btn-primary tj-btn-primary-light flip-text-wrap" href="internship-programs-jaipur.php"><span class="btn-text">Explore Internship Programs</span></a>
                </article>
              </div>
              <div class="col-lg-6">
                <article class="forsk-split-card">
                  <h2>College Admissions</h2>
                  <p>Get admission-process guidance for selected undergraduate and postgraduate programs. Final admission always remains subject to college or university eligibility, rules and seat availability.</p>
                  <ul class="forsk-link-list">
                    <li><a href="bca-admission-jaipur.php">BCA Admission</a></li>
                    <li><a href="mca-admission-jaipur.php">MCA Admission</a></li>
                    <li><a href="btech-admission-jaipur.php">B.Tech Admission</a></li>
                    <li><a href="bba-admission-jaipur.php">BBA Admission</a></li>
                  </ul>
                  <a class="tj-btn-primary flip-text-wrap" href="college-admissions-jaipur.php"><span class="btn-text">Explore College Admissions</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                </article>
              </div>
            </div>
          </div>
        </section>

        <section class="forsk-section forsk-section-soft" aria-labelledby="counselling-title">
          <div class="container">
            <div class="row g-4 align-items-start">
              <div class="col-lg-5">
                <span class="forsk-eyebrow"><i class="tji-subtitle"></i> Free course counselling</span>
                <h2 class="forsk-section-title" id="counselling-title">Tell Us What You Want to Learn</h2>
                <p class="forsk-section-copy">Share your goal, qualification and preferred program. Our academic team can help you understand suitable learning paths and current batch options.</p>
                <ul class="forsk-contact-points">
                  <li><strong>Call</strong><a href="tel:<?= htmlspecialchars(SITE_PHONE_E164, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(SITE_PHONE_DISPLAY, ENT_QUOTES, 'UTF-8') ?></a></li>
                  <li><strong>WhatsApp</strong><a href="https://wa.me/<?= htmlspecialchars(preg_replace('/\D+/', '', SITE_PHONE_E164), ENT_QUOTES, 'UTF-8') ?>?text=<?= rawurlencode('Hi ' . SITE_NAME . ', I want course counselling.') ?>" target="_blank" rel="noopener">Chat with <?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?></a></li>
                  <li><strong>Email</strong><a href="mailto:<?= htmlspecialchars(SITE_EMAIL, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(SITE_EMAIL, ENT_QUOTES, 'UTF-8') ?></a></li>
                  <li><strong>Location</strong><span><?= htmlspecialchars(SITE_PRIMARY_AREA . ', ' . SITE_LOCALITY . ', ' . SITE_REGION, ENT_QUOTES, 'UTF-8') ?></span></li>
                </ul>
              </div>
              <div class="col-lg-7">
                <div class="forsk-enquiry-shell">
                  <?php
                  $lead_channel = 'academic';
                  $lead_interest = '';
                  $lead_heading = 'Request Free Course Counselling';
                  $lead_submit_label = 'Request Counselling Call';
                  $lead_options = ['Python Programming','Java Programming','Full Stack Development','MERN Stack','Data Analytics','Data Science','Artificial Intelligence / Machine Learning','Generative AI','Power BI','Cloud / DevOps','Cyber Security','Software Testing','Digital Marketing','UI / UX Design','Mobile App Development','Other / Need Guidance'];
                  include __DIR__ . '/lead-form.php';
                  ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="forsk-section" aria-labelledby="faq-title">
          <div class="container">
            <div class="text-center">
              <span class="forsk-eyebrow"><i class="tji-subtitle"></i> Common questions</span>
              <h2 class="forsk-section-title mx-auto" id="faq-title">Forsk Coding School FAQs</h2>
            </div>
            <div class="forsk-faq">
              <?php foreach ($faqs as $faq): ?>
                <details>
                  <summary><?= htmlspecialchars($faq[0], ENT_QUOTES, 'UTF-8') ?></summary>
                  <p><?= htmlspecialchars($faq[1], ENT_QUOTES, 'UTF-8') ?></p>
                </details>
              <?php endforeach; ?>
            </div>
          </div>
        </section>

        <section class="forsk-section forsk-section-soft" aria-labelledby="explore-title">
          <div class="container">
            <span class="forsk-eyebrow"><i class="tji-subtitle"></i> Explore more</span>
            <h2 class="forsk-section-title" id="explore-title">Popular Technology Training in Jaipur</h2>
            <p class="forsk-section-copy">Use these focused pages to compare learning paths instead of scrolling through an overloaded homepage.</p>
            <nav class="forsk-seo-links" aria-label="Popular course links">
              <a href="python-programming-course-jaipur.php">Python Course Jaipur</a>
              <a href="java-programming-course-jaipur.php">Java Course Jaipur</a>
              <a href="full-stack-development-course-jaipur.php">Full Stack Course Jaipur</a>
              <a href="mern-stack-course-jaipur.php">MERN Stack Jaipur</a>
              <a href="data-analytics-course-jaipur.php">Data Analytics Jaipur</a>
              <a href="data-science-course-jaipur.php">Data Science Jaipur</a>
              <a href="artificial-intelligence-course-jaipur.php">AI Course Jaipur</a>
              <a href="generative-ai-course-jaipur.php">Generative AI Jaipur</a>
              <a href="power-bi-course-jaipur.php">Power BI Jaipur</a>
              <a href="aws-course-jaipur.php">AWS Course Jaipur</a>
              <a href="devops-course-jaipur.php">DevOps Course Jaipur</a>
              <a href="cyber-security-course-jaipur.php">Cyber Security Jaipur</a>
              <a href="software-testing-course-jaipur.php">Software Testing Jaipur</a>
              <a href="digital-marketing-course-jaipur.php">Digital Marketing Jaipur</a>
            </nav>
          </div>
        </section>
      </main>

      <?php include __DIR__ . '/footer.php'; ?>
    </div>
  </div>
</body>
</html>
