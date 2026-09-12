<?php
$formError = trim((string)($_GET['form_error'] ?? ''));
$page_title = 'Contact Forsk Coding School Jaipur | Free Course Counselling';
$page_description = 'Contact Forsk Coding School in Jaipur for practical coding and IT course counselling, online or offline learning, internship information and placement assistance.';
$page_canonical = 'https://forskcodingschool.com/contact.php';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'ContactPage',
            'name' => $page_title,
            'description' => $page_description,
            'url' => $page_canonical,
        ],
        [
            '@type' => 'EducationalOrganization',
            '@id' => 'https://forskcodingschool.com/#organization',
            'name' => 'Forsk Coding School',
            'url' => 'https://forskcodingschool.com/',
            'telephone' => '+917231968183',
            'email' => 'info@forskcodingschool.com',
            'areaServed' => ['@type' => 'City', 'name' => 'Jaipur'],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
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
            <div class="row"><div class="col-12">
              <div class="tj-page-header-content">
                <h1 class="tj-page-title">Get Free Course Counselling in Jaipur</h1>
                <div class="tj-page-link">
                  <span><i class="tji-home"></i></span>
                  <span><a href="default.php">Home</a></span>
                  <span><i class="tji-arrow-right-4"></i></span>
                  <span>Contact</span>
                </div>
                <div class="shape"><img src="assets/images/shapes/stars.png" alt="" aria-hidden="true"></div>
              </div>
            </div></div>
          </div>
        </section>

        <section class="tj-contact-section section-gap">
          <div class="container">
            <div class="row rg-30 flex-lg-row flex-column-reverse">
              <div class="col-lg-7">
                <div class="contact-form tj-fade-anim">
                  <div class="form-title-wrap">
                    <h2 class="form-title">Tell us what you want to learn</h2>
                    <p class="desc">Share your learning goal and preferred mode. Our team can help you understand relevant course options, batches and practical learning paths.</p>
                  </div>

                  <?php if ($formError !== ''): ?>
                    <div class="alert alert-danger" role="alert">Please check the form details and try again. If the problem continues, call +91 72319 68183.</div>
                  <?php endif; ?>

                  <form action="mail.php" method="POST" id="contact-form" novalidate>
                    <div class="row">
                      <div class="col-sm-6"><div class="form-input">
                        <label class="cf-label" for="lead-name">Full name</label>
                        <input id="lead-name" type="text" name="name" maxlength="100" autocomplete="name" placeholder="Enter your name" required>
                      </div></div>

                      <div class="col-sm-6"><div class="form-input">
                        <label class="cf-label" for="lead-phone">Mobile number</label>
                        <input id="lead-phone" type="tel" name="phone" maxlength="10" pattern="[6-9][0-9]{9}" inputmode="numeric" autocomplete="tel" placeholder="10-digit mobile number" required>
                      </div></div>

                      <div class="col-sm-6"><div class="form-input">
                        <label class="cf-label" for="lead-email">Email address</label>
                        <input id="lead-email" type="email" name="email" maxlength="190" autocomplete="email" placeholder="Enter your email" required>
                      </div></div>

                      <div class="col-sm-6"><div class="form-input">
                        <label class="cf-label" for="lead-city">City</label>
                        <input id="lead-city" type="text" name="city" maxlength="100" autocomplete="address-level2" value="Jaipur" placeholder="Your city" required>
                      </div></div>

                      <div class="col-sm-6"><div class="form-input">
                        <label class="cf-label" for="lead-qualification">Current qualification</label>
                        <div class="tj-select"><select id="lead-qualification" name="current_qualification" required>
                          <option value="">Select qualification</option>
                          <option>School Student</option><option>BCA</option><option>MCA</option><option>B.Tech</option><option>B.Sc / M.Sc IT</option><option>Graduate / Fresher</option><option>Working Professional</option><option>Other</option>
                        </select></div>
                      </div></div>

                      <div class="col-sm-6"><div class="form-input">
                        <label class="cf-label" for="lead-course">Interested course</label>
                        <div class="tj-select"><select id="lead-course" name="interested_course" required>
                          <option value="">Select course</option>
                          <option>Python Programming</option><option>Java Programming</option><option>C / C++ Programming</option><option>DSA</option><option>Full Stack Development</option><option>MERN Stack</option><option>Java Full Stack</option><option>Python Full Stack</option><option>Data Analytics</option><option>Data Science</option><option>Artificial Intelligence / Machine Learning</option><option>Generative AI</option><option>Power BI</option><option>SQL</option><option>Web Designing</option><option>App Development</option><option>Digital Marketing</option><option>Other / Need Guidance</option>
                        </select></div>
                      </div></div>

                      <div class="col-sm-4"><div class="form-input">
                        <label class="cf-label" for="lead-mode">Preferred mode</label>
                        <div class="tj-select"><select id="lead-mode" name="preferred_mode" required><option value="">Select mode</option><option>Offline</option><option>Online Live</option><option>Need Guidance</option></select></div>
                      </div></div>

                      <div class="col-sm-4"><div class="form-input">
                        <label class="cf-label" for="lead-branch">Preferred branch</label>
                        <div class="tj-select"><select id="lead-branch" name="preferred_branch"><option value="">Select branch</option><option>Shyam Nagar, Jaipur</option><option>Need Guidance</option></select></div>
                      </div></div>

                      <div class="col-sm-4"><div class="form-input">
                        <label class="cf-label" for="lead-batch">Batch preference</label>
                        <div class="tj-select"><select id="lead-batch" name="batch_preference"><option value="">Select batch</option><option>Weekday</option><option>Weekend</option><option>Morning</option><option>Evening</option><option>Flexible</option></select></div>
                      </div></div>

                      <div class="col-12"><div class="form-input message-input">
                        <label class="cf-label" for="lead-message">Message</label>
                        <textarea id="lead-message" name="message" maxlength="2000" placeholder="Tell us your learning goal, current skill level or questions..."></textarea>
                      </div></div>

                      <div class="col-12" style="position:absolute;left:-10000px;width:1px;height:1px;overflow:hidden" aria-hidden="true">
                        <label for="lead-website">Website</label><input id="lead-website" type="text" name="website" tabindex="-1" autocomplete="off">
                      </div>

                      <input type="hidden" name="source_domain" id="source-domain">
                      <input type="hidden" name="source_page" id="source-page">
                      <input type="hidden" name="page_title" id="source-title">
                      <input type="hidden" name="course_name" id="source-course">
                      <input type="hidden" name="student_segment" id="source-segment">
                      <input type="hidden" name="landing_page" id="landing-page">
                      <input type="hidden" name="referrer" id="source-referrer">
                      <input type="hidden" name="utm_source" id="utm-source"><input type="hidden" name="utm_medium" id="utm-medium"><input type="hidden" name="utm_campaign" id="utm-campaign"><input type="hidden" name="utm_term" id="utm-term"><input type="hidden" name="utm_content" id="utm-content">

                      <div class="col-12"><div class="form-input">
                        <label><input type="checkbox" name="consent" value="1" required> I agree that Forsk Coding School may contact me about my course enquiry. I can ask to stop communication at any time.</label>
                      </div></div>

                      <div class="col-12"><div class="form-submit">
                        <button class="tj-btn-primary flip-text-wrap" type="submit"><span class="btn-text">Request Free Counselling</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></button>
                      </div></div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-lg-5">
                <div class="tj-contact-area">
                  <div class="sec-heading">
                    <span class="sec-subtitle tj-fade-anim" data-direction="top"><i class="tji-subtitle"></i> Jaipur support</span>
                    <h2 class="sec-title tj-fade-anim">Talk to Forsk Coding School</h2>
                    <p class="desc tj-fade-anim" data-delay=".3">Learn programming, Full Stack development, Data Analytics, Data Science and AI through live classes, practical assignments and guided projects.</p>
                  </div>
                  <div class="contact-item-wrap">
                    <div class="contact-item style-2 tj-fade-anim"><div class="contact-icon"><i class="tji-phone-call"></i></div><div class="contact-content"><h3 class="contact-title">Call us</h3><p>Course and batch enquiries</p><a class="contact-link" href="tel:+917231968183">+91 72319 68183</a></div></div>
                    <div class="contact-item style-2 tj-fade-anim"><div class="contact-icon"><i class="tji-message"></i></div><div class="contact-content"><h3 class="contact-title">WhatsApp us</h3><p>Ask about courses and learning modes</p><a class="contact-link" href="https://wa.me/917231968183?text=Hi%20Forsk%20Coding%20School%2C%20I%20want%20course%20counselling." target="_blank" rel="noopener">Chat on WhatsApp</a></div></div>
                    <div class="contact-item style-2 tj-fade-anim"><div class="contact-icon"><i class="tji-envelope"></i></div><div class="contact-content"><h3 class="contact-title">Email us</h3><p>Course and collaboration enquiries</p><a class="contact-link" href="mailto:info@forskcodingschool.com">info@forskcodingschool.com</a></div></div>
                    <div class="contact-item style-2 tj-fade-anim"><div class="contact-icon"><i class="tji-location"></i></div><div class="contact-content"><h3 class="contact-title">Jaipur location</h3><p>Shyam Nagar, Jaipur, Rajasthan</p><span class="contact-link">Exact visit details can be confirmed by phone.</span></div></div>
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

  <script>
  (function () {
    var params = new URLSearchParams(window.location.search);
    var set = function (id, value) { var el = document.getElementById(id); if (el) el.value = value || ''; };
    set('source-domain', window.location.hostname);
    set('source-page', window.location.href);
    set('source-title', document.title);
    set('landing-page', window.location.href);
    set('source-referrer', document.referrer);
    ['source','medium','campaign','term','content'].forEach(function (key) { set('utm-' + key, params.get('utm_' + key)); });
    var course = document.getElementById('lead-course');
    var qualification = document.getElementById('lead-qualification');
    if (course) course.addEventListener('change', function () { set('source-course', course.value); });
    if (qualification) qualification.addEventListener('change', function () { set('source-segment', qualification.value); });
  }());
  </script>
</body>
</html>
