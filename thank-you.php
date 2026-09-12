<?php
$page_title = 'Thank You | Forsk Coding School Jaipur';
$page_description = 'Thank you for contacting Forsk Coding School. Our team will review your course enquiry.';
$page_canonical = 'https://forskcodingschool.com/thank-you.php';
$page_robots = 'noindex, nofollow, noarchive';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Thank You | Forsk Coding School Jaipur',
    'url' => $page_canonical,
], JSON_UNESCAPED_SLASHES);
$header_variant = 'header-1';
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
            <div class="row">
              <div class="col-12">
                <div class="tj-page-header-content">
                  <h1 class="tj-page-title">Thank you for your enquiry</h1>
                  <div class="tj-page-link">
                    <span><i class="tji-home"></i></span>
                    <span><a href="default.php">Home</a></span>
                    <span><i class="tji-arrow-right-4"></i></span>
                    <span>Thank you</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section-gap">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8 text-center">
                <div class="sec-heading sec-heading-center">
                  <span class="sec-subtitle"><i class="tji-subtitle"></i> Enquiry received</span>
                  <h2 class="sec-title">Our team will review your request.</h2>
                  <p class="desc">For an urgent course enquiry, call <a href="tel:+917231968183">+91 72319 68183</a> or WhatsApp us using the same number.</p>
                  <div class="btn-area mt-4">
                    <a class="tj-btn-primary flip-text-wrap" href="courses.php"><span class="btn-text">Explore Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                    <a class="tj-btn-primary tj-btn-primary-light flip-text-wrap" href="contact.php"><span class="btn-text">Back to Contact</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
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
