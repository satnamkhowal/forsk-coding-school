<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (empty($_SESSION['enroll_csrf'])) {
    $_SESSION['enroll_csrf'] = bin2hex(random_bytes(32));
}
$branches = require __DIR__ . '/includes/branches-data.php';
$branches = array_values(array_filter($branches, static fn($b) => !empty($b['verified'])));
$requestedBranch = trim((string)($_GET['branch'] ?? ''));
$statusCode = trim((string)($_GET['status'] ?? ''));
$statusMessages = [
    'required' => 'Please complete all required fields.',
    'email' => 'Please enter a valid email address.',
    'phone' => 'Please enter a valid mobile number.',
    'session' => 'Your form session expired. Please submit the form again.',
    'retry' => 'Please wait a few seconds before submitting again.',
    'setup' => 'The enrollment form is being configured. Please call +91 72319 68183 for immediate assistance.',
    'server' => 'We could not save the form right now. Please call +91 72319 68183 or try again shortly.',
];
$page_title = 'Enroll Now at Forsk Coding School Jaipur | Course Admission Form';
$page_description = 'Enroll for coding, data, AI, full stack, cloud, cyber security and digital skills courses at Forsk Coding School Jaipur. Choose classroom or live online learning.';
$page_keywords = 'Forsk Coding School enrollment, enroll coding course Jaipur, course admission Jaipur, live online coding classes, offline coding classes Jaipur';
$page_canonical = 'https://forskcodingschool.com/enroll-now.php';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $page_canonical . '#webpage',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'isPartOf' => ['@id' => 'https://forskcodingschool.com/#website'],
            'about' => ['@id' => 'https://forskcodingschool.com/#organization'],
        ],
        [
            '@type' => 'EducationalOrganization',
            '@id' => 'https://forskcodingschool.com/#organization',
            'name' => 'Forsk Coding School',
            'url' => 'https://forskcodingschool.com/',
            'telephone' => '+91-72319-68183',
            'email' => 'info@forskcodingschool.com',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'F1, Forsk Coding School, New Sanganer Rd, F Block, Shyam Nagar',
                'addressLocality' => 'Jaipur',
                'addressRegion' => 'Rajasthan',
                'postalCode' => '302019',
                'addressCountry' => 'IN',
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <?php include __DIR__ . '/includes/head.php'; ?>
  <link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/admissions-branches.css'), ENT_QUOTES, 'UTF-8') ?>">
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
              <h1 class="tj-page-title">Enroll Now</h1>
              <div class="tj-page-link">
                <span><i class="tji-home"></i></span>
                <span><a href="index.php">Home</a></span>
                <span><i class="tji-arrow-right-4"></i></span>
                <span>Enroll Now</span>
              </div>
              <div class="shape"><img src="assets/images/shapes/stars.png" alt=""></div>
            </div>
          </div></div>
        </div>
      </section>

      <section class="tj-contact-section section-gap-bottom">
        <div class="container">
          <div class="row rg-30 flex-lg-row flex-column-reverse">
            <div class="col-lg-7">
              <div class="contact-form tj-fade-anim">
                <div class="form-title-wrap">
                  <h2 class="form-title">Start your course admission enquiry</h2>
                  <p class="desc">Tell us what you want to learn. The admissions team can guide you on the course, learning mode and suitable batch options.</p>
                </div>

                <?php if ($statusCode !== '' && isset($statusMessages[$statusCode])): ?>
                  <div class="alert alert-warning" role="alert"><?= htmlspecialchars($statusMessages[$statusCode], ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <form action="process.php" method="POST" id="enroll-form" autocomplete="on">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['enroll_csrf'], ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="form_type" value="enrollment">
                  <input type="hidden" name="source_page" value="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="utm_source" value="<?= htmlspecialchars((string)($_GET['utm_source'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="utm_medium" value="<?= htmlspecialchars((string)($_GET['utm_medium'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="utm_campaign" value="<?= htmlspecialchars((string)($_GET['utm_campaign'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="utm_term" value="<?= htmlspecialchars((string)($_GET['utm_term'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="utm_content" value="<?= htmlspecialchars((string)($_GET['utm_content'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

                  <div style="position:absolute;left:-9999px" aria-hidden="true">
                    <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-input">
                        <label class="cf-label" for="full_name">Full name <span class="required-mark">*</span></label>
                        <input id="full_name" type="text" name="full_name" placeholder="Enter your name" maxlength="120" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-input">
                        <label class="cf-label" for="email">Email address <span class="required-mark">*</span></label>
                        <input id="email" type="email" name="email" placeholder="Enter your email" maxlength="190" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-input">
                        <label class="cf-label" for="phone">Mobile number <span class="required-mark">*</span></label>
                        <input id="phone" type="tel" name="phone" placeholder="10-digit mobile number" maxlength="15" inputmode="tel" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-input">
                        <label class="cf-label" for="current_status">Current status</label>
                        <div class="tj-select">
                          <select id="current_status" name="current_status">
                            <option value="">Select status</option>
                            <option>School Student</option>
                            <option>College Student</option>
                            <option>Graduate / Fresher</option>
                            <option>Working Professional</option>
                            <option>Career Switcher</option>
                            <option>Business Owner / Entrepreneur</option>
                            <option>Other</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-input">
                        <label class="cf-label" for="course_interest">Course interested in <span class="required-mark">*</span></label>
                        <div class="tj-select">
                          <select id="course_interest" name="course_interest" required>
                            <option value="">Select course</option>
                            <optgroup label="Programming & Full Stack">
                              <option>Python Programming</option>
                              <option>Java Programming</option>
                              <option>C / C++ Programming</option>
                              <option>Full Stack Development</option>
                              <option>MERN Stack Development</option>
                              <option>Java Full Stack Development</option>
                              <option>Python Full Stack Development</option>
                              <option>React / Front-End Development</option>
                            </optgroup>
                            <optgroup label="Data, AI & Analytics">
                              <option>Data Analytics</option>
                              <option>Data Science</option>
                              <option>Machine Learning</option>
                              <option>Artificial Intelligence</option>
                              <option>Generative AI</option>
                              <option>Power BI</option>
                              <option>Advanced Excel</option>
                              <option>SQL</option>
                            </optgroup>
                            <optgroup label="Cloud, Cyber Security & DevOps">
                              <option>Cloud Computing</option>
                              <option>AWS</option>
                              <option>Microsoft Azure</option>
                              <option>DevOps</option>
                              <option>Cyber Security</option>
                              <option>Ethical Hacking</option>
                            </optgroup>
                            <optgroup label="Testing, Design & Marketing">
                              <option>Software Testing</option>
                              <option>UI/UX Design</option>
                              <option>Digital Marketing</option>
                            </optgroup>
                            <option>Diploma Program</option>
                            <option>Internship / Industrial Training</option>
                            <option>Not sure — need counselling</option>
                            <option>Other</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-input">
                        <label class="cf-label" for="learning_mode">Learning mode <span class="required-mark">*</span></label>
                        <div class="tj-select">
                          <select id="learning_mode" name="learning_mode" required>
                            <option value="">Select learning mode</option>
                            <option>Classroom / Offline</option>
                            <option>Live Online — Two-Way Interactive</option>
                            <option>Open to Both</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-input">
                        <label class="cf-label" for="preferred_branch">Preferred branch <span class="required-mark">*</span></label>
                        <div class="tj-select">
                          <select id="preferred_branch" name="preferred_branch" required>
                            <option value="">Select branch</option>
                            <?php foreach ($branches as $branch): ?>
                              <option value="<?= htmlspecialchars($branch['short_name'], ENT_QUOTES, 'UTF-8') ?>" <?= $requestedBranch === $branch['slug'] ? 'selected' : '' ?>><?= htmlspecialchars($branch['short_name'], ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                            <option>Live Online</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-input">
                        <label class="cf-label" for="qualification">Qualification</label>
                        <input id="qualification" type="text" name="qualification" placeholder="e.g. B.Tech, BCA, 12th" maxlength="160">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-input">
                        <label class="cf-label" for="preferred_contact_time">Preferred callback time</label>
                        <div class="tj-select">
                          <select id="preferred_contact_time" name="preferred_contact_time">
                            <option value="">Any suitable time</option>
                            <option>Morning</option>
                            <option>Afternoon</option>
                            <option>Evening</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-input message-input">
                        <label class="cf-label" for="message">Anything you want us to know?</label>
                        <textarea id="message" name="message" maxlength="2000" placeholder="Your goal, preferred timing, current skill level or question..."></textarea>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check-row">
                        <input id="consent" type="checkbox" name="consent" value="1" required>
                        <label for="consent" class="form-note">I agree that Forsk Coding School may contact me about this admission enquiry by phone, email or messaging. <span class="required-mark">*</span></label>
                      </div>
                    </div>

                    <div class="form-submit">
                      <button class="tj-btn-primary flip-text-wrap" type="submit">
                        <span class="btn-text">Submit Enrollment Enquiry</span>
                        <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="tj-contact-area">
                <div class="sec-heading">
                  <span class="sec-subtitle tj-fade-anim" data-direction="top"><i class="tji-subtitle"></i> Admissions</span>
                  <h2 class="sec-title tj-fade-anim">Learn with direct mentor interaction.</h2>
                  <p class="desc tj-fade-anim" data-delay=".3">Choose classroom learning in Jaipur or live online classes designed for two-way interaction rather than one-way recorded delivery.</p>
                </div>

                <div class="enroll-benefits">
                  <div class="enroll-benefit"><strong>Online + Offline</strong><span>Choose classroom or live online learning.</span></div>
                  <div class="enroll-benefit"><strong>Two-Way Live Classes</strong><span>Ask questions and interact with the mentor during class.</span></div>
                  <div class="enroll-benefit"><strong>Focused Micro-Batches</strong><span>Planned around 10–15 learners for better interaction.</span></div>
                  <div class="enroll-benefit"><strong>Technical Support</strong><span>With permission, screen sharing/remote tools may be used to troubleshoot technical setup issues.</span></div>
                </div>

                <div class="contact-item-wrap">
                  <div class="contact-item style-2 tj-fade-anim" data-delay="0.3">
                    <div class="contact-icon"><i class="tji-phone-call"></i></div>
                    <div class="contact-content"><h3 class="contact-title">Call admissions</h3><p>Talk to the team directly.</p><a class="contact-link" href="tel:+917231968183">+91 72319 68183</a></div>
                  </div>
                  <div class="contact-item style-2 tj-fade-anim" data-delay="0.5">
                    <div class="contact-icon"><i class="tji-location"></i></div>
                    <div class="contact-content"><h3 class="contact-title">Visit the Jaipur branch</h3><p>Shyam Nagar, Jaipur, Rajasthan</p><a class="tj-text-btn flip-text-wrap" href="branches/"><span class="btn-text">View branch & map</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></div>
                  </div>
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
