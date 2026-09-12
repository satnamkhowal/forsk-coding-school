<?php
$page_title = 'About Forsk Coding School | Coding & IT Training Institute Jaipur';
$page_description = 'Learn about Forsk Coding School in Jaipur, our practical learning approach, technology programs, course counselling and career-focused skill development.';
$page_keywords = 'Forsk Coding School Jaipur, coding institute Jaipur, IT training institute Jaipur, programming courses Jaipur, practical technology training Jaipur';
$page_canonical = 'https://forskcodingschool.com/about.php';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'AboutPage',
            '@id' => $page_canonical . '#webpage',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'isPartOf' => ['@id' => 'https://forskcodingschool.com/#website'],
            'about' => ['@id' => 'https://forskcodingschool.com/#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://forskcodingschool.com/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'About Forsk Coding School', 'item' => $page_canonical],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
<head>
<?php include __DIR__ . '/includes/head.php'; ?>
<style>
.about-facts{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin-top:28px}.about-fact{padding:24px;border:1px solid rgba(17,24,39,.08);border-radius:18px;background:#fff;height:100%}.about-fact h3{margin-bottom:8px}.about-paths{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.about-path{padding:26px;border-radius:18px;background:#fff;border:1px solid rgba(17,24,39,.08)}.about-path ul{margin:16px 0 0;padding-left:20px}.about-verify{padding:28px;border-radius:18px;background:#f7f8fa}.about-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:24px}@media(max-width:991px){.about-facts,.about-paths{grid-template-columns:1fr}}@media(max-width:575px){.about-actions{display:grid}.about-actions a{width:100%;justify-content:center}}
</style>
</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main id="primary" class="site-main">
  <div class="space-for-header"></div>

  <section class="tj-page-header tj-page-header-2">
    <div class="container"><div class="row"><div class="col-12">
      <div class="tj-page-header-content">
        <div class="tj-page-link">
          <span><i class="tji-home"></i></span><span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span>About us</span>
        </div>
        <div class="sec-heading sec-heading-center">
          <span class="sec-subtitle tj-fade-anim" data-direction="top"><i class="tji-subtitle"></i> Forsk Coding School, Jaipur</span>
          <h1 class="sec-title tj-fade-anim" data-delay=".2">Practical coding and technology learning built around <span>real skill development.</span></h1>
          <p class="desc tj-fade-anim" data-delay=".3">Forsk Coding School helps students, beginners and working professionals build programming, data, AI, web, cloud and other technology skills through structured learning, practice and project-oriented application.</p>
          <div class="about-actions justify-content-center tj-fade-anim" data-delay=".4">
            <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('courses.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Explore Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
            <a class="tj-btn-primary tj-btn-primary-light flip-text-wrap" href="<?= htmlspecialchars(site_url('enroll-now.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Course Counselling</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          </div>
        </div>
      </div>
    </div></div></div>
  </section>

  <section class="section-gap"><div class="container">
    <div class="row align-items-center rg-40">
      <div class="col-lg-7">
        <div class="sec-heading">
          <span class="sec-subtitle"><i class="tji-subtitle"></i> How we teach</span>
          <h2 class="sec-title">Understand the concept, practise it, then build with it.</h2>
          <p class="desc">Our course pages are designed around clear fundamentals, guided exercises, troubleshooting and practical projects. The aim is not to collect tools or memorise theory; learners should be able to explain what they built, why it works and how to improve it.</p>
        </div>
        <div class="about-facts">
          <article class="about-fact"><h3 class="tj-fs-h5">Fundamentals first</h3><p>Start with the concepts needed for the chosen learning path before moving into frameworks, tools and larger projects.</p></article>
          <article class="about-fact"><h3 class="tj-fs-h5">Practice oriented</h3><p>Use exercises, debugging and project work to turn lessons into usable technical skills.</p></article>
          <article class="about-fact"><h3 class="tj-fs-h5">Career context</h3><p>Connect technical learning with portfolios, interviews, project explanation and the skills expected in real workflows.</p></article>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="about-verify">
          <span class="sec-subtitle"><i class="tji-subtitle"></i> Verified Jaipur location</span>
          <h2 class="tj-fs-h3">Shyam Nagar, Jaipur</h2>
          <p>F1, Forsk Coding School, New Sanganer Rd, F Block, Shyam Nagar, Jaipur, Rajasthan 302019.</p>
          <p>For current batches, fees, prerequisites and learning mode, use the admissions enquiry before visiting.</p>
          <div class="about-actions">
            <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('branches/jaipur-shyam-nagar/'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Branch Details</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
            <a class="tj-text-btn flip-text-wrap" href="<?= htmlspecialchars(site_url('contact/'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Contact Us</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          </div>
        </div>
      </div>
    </div>
  </div></section>

  <section class="section-gap-bottom"><div class="container">
    <div class="row justify-content-center"><div class="col-lg-9 text-center">
      <div class="sec-heading sec-heading-center"><span class="sec-subtitle"><i class="tji-subtitle"></i> Learning paths</span><h2 class="sec-title">Choose a path that matches the skill you want to build.</h2><p class="desc">Forsk Coding School covers programming and software development along with specialist technology and professional skill tracks. Availability can vary by course and batch.</p></div>
    </div></div>
    <div class="about-paths">
      <article class="about-path"><h3>Programming & Full Stack</h3><p>Build programming foundations and progress into frontend, backend and full-stack application development.</p><ul><li>Python, Java, C and C++</li><li>JavaScript, React, Node.js and MERN</li><li>Java Full Stack and Python Full Stack</li><li>Web development and databases</li></ul></article>
      <article class="about-path"><h3>Data, AI & Analytics</h3><p>Develop analytical and AI skills through tools, coding, data workflows and practical problem solving.</p><ul><li>Data Analytics and Data Science</li><li>Python, SQL, Excel and Power BI</li><li>Machine Learning and Artificial Intelligence</li><li>Generative AI and related workflows</li></ul></article>
      <article class="about-path"><h3>Cloud, DevOps & Cybersecurity</h3><p>Learn infrastructure, deployment and security concepts through structured technical practice.</p><ul><li>AWS and cloud fundamentals</li><li>Linux, Docker and Kubernetes</li><li>DevOps workflows</li><li>Cybersecurity and networking topics</li></ul></article>
      <article class="about-path"><h3>Other Career Skills</h3><p>Explore additional technology and professional tracks listed in the current course catalogue.</p><ul><li>Software testing</li><li>Mobile app development</li><li>UI/UX and digital marketing</li><li>Spoken English and professional skills</li></ul></article>
    </div>
    <div class="about-actions justify-content-center" style="margin-top:32px">
      <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('courses.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Browse All Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
    </div>
  </div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row justify-content-center"><div class="col-lg-9">
    <div class="about-verify">
      <h2>Information we intentionally verify</h2>
      <p>Course availability, fees, batch timing and prerequisites can change. We therefore direct learners to current course pages and admissions counselling instead of publishing invented numbers or guarantees. Physical branch information is published only after the address and public contact details are confirmed.</p>
      <p>Forsk Coding School does not need exaggerated learner counts, fabricated reviews, fake instructors or unverified placement claims to explain its learning approach. This page is maintained as a factual overview of the institute and its current learning paths.</p>
    </div>
  </div></div></div></section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</div></div>
</body>
</html>
