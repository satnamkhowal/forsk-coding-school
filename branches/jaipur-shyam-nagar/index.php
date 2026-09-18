<?php
$root = dirname(__DIR__, 2);
require_once $root . '/config.php';
$branches = require $root . '/includes/branches-data.php';
$branch = null;
foreach ($branches as $candidate) {
    if (($candidate['slug'] ?? '') === 'jaipur-shyam-nagar' && !empty($candidate['verified'])) {
        $branch = $candidate;
        break;
    }
}
if (!$branch) {
    http_response_code(404);
    exit('Branch not found.');
}

$page_title = 'Forsk Coding School Shyam Nagar Jaipur | Coding & IT Courses';
$page_description = 'Visit Forsk Coding School Shyam Nagar Jaipur for Python, Full Stack, Data Analytics, Data Science, Java, AI and practical IT course counselling. Get verified address, directions, nearby student resources and enquiry options.';
$page_keywords = 'Forsk Coding School Shyam Nagar Jaipur, coding classes Shyam Nagar Jaipur, Python course Shyam Nagar, Data Science course Shyam Nagar Jaipur, Full Stack course Shyam Nagar, Java training Shyam Nagar Jaipur';
$page_canonical = seo_url('branches/jaipur-shyam-nagar/');
$addressText = $branch['street_address'] . ', ' . $branch['city'] . ', ' . $branch['state'] . ' ' . $branch['postal_code'] . ', India';
$mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($addressText);
$mapsEmbed = 'https://www.google.com/maps?q=' . rawurlencode($addressText) . '&output=embed';
$whatsApp = preg_replace('/\D+/', '', $branch['phone']);
$pgGuideUrl = site_url('pg-near-forsk-coding-school-shyam-nagar/');

$courseLinks = [
    ['Python Programming', 'python-programming-course-jaipur.php'],
    ['Java Programming', 'java-programming-course-jaipur.php'],
    ['C Programming', 'c-programming-course-jaipur.php'],
    ['C++ Programming', 'c-plus-plus-course-jaipur.php'],
    ['Full Stack Development', 'full-stack-development-course-jaipur.php'],
    ['Data Analytics', 'data-analytics-course-jaipur.php'],
    ['Data Science', 'data-science-course-jaipur.php'],
    ['SQL', 'sql-course-jaipur.php'],
    ['Power BI', 'power-bi-course-jaipur.php'],
    ['Artificial Intelligence', 'artificial-intelligence-course-jaipur.php'],
    ['Machine Learning', 'machine-learning-course-jaipur.php'],
    ['Generative AI', 'generative-ai-course-jaipur.php'],
];

$faqs = [
    [
        'q' => 'Where is Forsk Coding School in Shyam Nagar, Jaipur?',
        'a' => 'The verified Forsk Coding School location is F1, Forsk Coding School, New Sanganer Rd, F Block, Shyam Nagar, Jaipur, Rajasthan 302019, India.'
    ],
    [
        'q' => 'Which courses can I enquire about at the Shyam Nagar centre?',
        'a' => 'Students can enquire about current learning options including Python, Java, C/C++, Full Stack Development, Data Analytics, Data Science, SQL, Power BI, Artificial Intelligence, Machine Learning, Generative AI and other courses in the Forsk catalogue. Batch availability can vary.'
    ],
    [
        'q' => 'Is the branch close to Jaipur Metro?',
        'a' => 'The branch is on New Sanganer Road in Shyam Nagar. Shyam Nagar and Vivek Vihar metro stations serve this corridor. Check your live route before travelling because travel time depends on the starting point and traffic.'
    ],
    [
        'q' => 'Are there PGs and hostels near Forsk Coding School Shyam Nagar?',
        'a' => 'Yes. Forsk maintains a student-focused guide to nearby boys PGs, girls PGs, hostels and co-living options in and around Shyam Nagar. Accommodation is independently operated, so students should verify rent, facilities and rules directly with each property.'
    ],
    [
        'q' => 'Should I call before visiting the branch?',
        'a' => 'Yes. Call or WhatsApp the admissions team before visiting to confirm current counselling hours, course availability and the most suitable learning mode.'
    ],
];

$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'EducationalOrganization',
            '@id' => $page_canonical . '#branch',
            'name' => $branch['name'],
            'url' => $page_canonical,
            'telephone' => $branch['phone'],
            'email' => $branch['email'],
            'parentOrganization' => ['@id' => SITE_ORGANIZATION_ID],
            'hasMap' => $mapsUrl,
            'areaServed' => ['@type' => 'City', 'name' => 'Jaipur'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $branch['street_address'],
                'addressLocality' => $branch['city'],
                'addressRegion' => $branch['state'],
                'postalCode' => $branch['postal_code'],
                'addressCountry' => $branch['country'],
            ],
        ],
        [
            '@type' => 'WebPage',
            '@id' => $page_canonical . '#webpage',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'about' => ['@id' => $page_canonical . '#branch'],
            'isPartOf' => ['@id' => seo_url('/#website')],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => seo_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Branches', 'item' => seo_url('branches/')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Shyam Nagar Jaipur', 'item' => $page_canonical],
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn(array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
            ], $faqs),
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
<head>
  <?php include $root . '/includes/head.php'; ?>
  <link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/admissions-branches.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>
<?php include $root . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main id="primary" class="site-main">
  <div class="space-for-header"></div>

  <section class="tj-page-header"><div class="container"><div class="row"><div class="col-12">
    <div class="tj-page-header-content">
      <div class="tj-page-link">
        <span><i class="tji-home"></i></span>
        <span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span>
        <span><i class="tji-arrow-right-4"></i></span>
        <span><a href="<?= htmlspecialchars(site_url('branches/'), ENT_QUOTES, 'UTF-8') ?>">Branches</a></span>
        <span><i class="tji-arrow-right-4"></i></span>
        <span>Shyam Nagar</span>
      </div>
      <h1 class="tj-page-title">Forsk Coding School – Shyam Nagar, Jaipur</h1>
      <p class="tj-page-desc">Verified Jaipur location for practical coding and IT course counselling, with direct links to courses, directions and nearby student accommodation.</p>
    </div>
  </div></div></div></section>

  <section class="section-gap"><div class="container">
    <div class="row rg-30 align-items-stretch">
      <div class="col-lg-7">
        <article class="branch-card">
          <span class="sec-subtitle"><i class="tji-subtitle"></i> Verified Jaipur centre</span>
          <h2>Coding classes and practical IT training in Shyam Nagar</h2>
          <p>Forsk Coding School serves students, freshers, beginners and working professionals looking for practical technology learning in Jaipur. The Shyam Nagar centre is the verified physical Forsk location currently maintained in the official branch directory.</p>
          <p>Use this page to plan a visit, compare current learning paths and find student resources around the New Sanganer Road corridor. Course availability and batch schedules can change, so confirm your preferred program before travelling.</p>
          <div class="branch-actions">
            <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('enroll-now.php?branch=jaipur-shyam-nagar'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Enquire About Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
            <a class="tj-text-btn flip-text-wrap" href="https://wa.me/<?= htmlspecialchars($whatsApp, ENT_QUOTES, 'UTF-8') ?>?text=<?= rawurlencode('Hi Forsk Coding School, I want course counselling for the Shyam Nagar Jaipur branch.') ?>" target="_blank" rel="noopener"><span class="btn-text">WhatsApp Admissions</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          </div>
        </article>
      </div>
      <div class="col-lg-5">
        <aside class="branch-card">
          <h2>Branch details</h2>
          <div class="branch-meta">
            <div><strong>Official address</strong><?= htmlspecialchars($addressText, ENT_QUOTES, 'UTF-8') ?></div>
            <div><strong>Admissions phone</strong><a href="tel:<?= htmlspecialchars($branch['phone'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(SITE_PHONE_DISPLAY, ENT_QUOTES, 'UTF-8') ?></a></div>
            <div><strong>Email</strong><a href="mailto:<?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?></a></div>
            <div><strong>Area</strong>Shyam Nagar / New Sanganer Road, Jaipur</div>
          </div>
          <div class="branch-actions">
            <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener"><span class="btn-text">Open Google Maps</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
            <a class="tj-text-btn flip-text-wrap" href="tel:<?= htmlspecialchars($branch['phone'], ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Call Admissions</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          </div>
        </aside>
      </div>
    </div>
  </div></section>

  <section class="section-gap-bottom"><div class="container">
    <div class="row rg-30 align-items-stretch">
      <div class="col-lg-7">
        <div class="branch-card">
          <span class="sec-subtitle"><i class="tji-subtitle"></i> Directions</span>
          <h2>Find Forsk Coding School on New Sanganer Road</h2>
          <p>The branch is in Shyam Nagar on New Sanganer Road. Shyam Nagar Metro and Vivek Vihar Metro are useful public-transport reference points for this corridor. Use live directions for the exact route from your current location.</p>
          <div class="branch-map">
            <iframe src="<?= htmlspecialchars($mapsEmbed, ENT_QUOTES, 'UTF-8') ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map to Forsk Coding School Shyam Nagar Jaipur" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="branch-card">
          <span class="sec-subtitle"><i class="tji-subtitle"></i> Nearby reference points</span>
          <h2>Useful local landmarks</h2>
          <ul class="branch-list">
            <li><strong>New Sanganer Road:</strong> the branch address is directly on this major Shyam Nagar corridor.</li>
            <li><strong>Shyam Nagar Metro:</strong> a useful metro reference point when approaching the area.</li>
            <li><strong>Vivek Vihar Metro:</strong> another nearby station serving the same New Sanganer Road corridor.</li>
            <li><strong>Shyam Nagar / Devi Nagar markets:</strong> the wider area has daily-needs stores, food outlets and local markets useful for students.</li>
          </ul>
          <p class="branch-note">Landmarks are provided for orientation. Always check a live route before travelling.</p>
        </div>
      </div>
    </div>
  </div></section>

  <section class="section-gap-bottom"><div class="container">
    <div class="row justify-content-center"><div class="col-lg-9 text-center">
      <div class="sec-heading sec-heading-center">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Courses</span>
        <h2 class="sec-title">Popular learning paths students ask about in Shyam Nagar</h2>
        <p class="desc">These links lead to the current Forsk course pages. Confirm the current batch and learning mode with admissions.</p>
      </div>
    </div></div>
    <div class="local-course-grid">
      <?php foreach ($courseLinks as [$label, $url]): ?>
        <a class="local-course-link" href="<?= htmlspecialchars(site_url($url), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?><span aria-hidden="true">→</span></a>
      <?php endforeach; ?>
    </div>
    <div class="branch-actions justify-content-center">
      <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('courses.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Explore All Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
    </div>
  </div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row rg-30">
    <div class="col-lg-6">
      <div class="branch-card">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Student support</span>
        <h2>What students can use Forsk for</h2>
        <ul class="branch-list">
          <li>Course counselling based on your current level and career goal.</li>
          <li>Structured lessons, hands-on coding practice and guided projects.</li>
          <li>Mentor-supported learning and practical troubleshooting.</li>
          <li>Classroom or live-online options where available for the selected program.</li>
          <li>Internship, industrial-training and project-learning pathways listed on the website.</li>
        </ul>
        <p class="branch-note">Facilities, batch timings and delivery mode can differ by program. Confirm current details before enrollment.</p>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="branch-card">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Student accommodation</span>
        <h2>PGs and hostels near Forsk Shyam Nagar</h2>
        <p>Students moving to Jaipur can compare nearby boys PGs, girls PGs, hostels and co-living options in the Shyam Nagar area. The guide records only public information and marks details that need direct verification.</p>
        <p>Forsk Coding School does not own or operate the listed accommodation properties and does not guarantee their availability, pricing, facilities or suitability.</p>
        <div class="branch-actions">
          <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars($pgGuideUrl, ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">View PG & Hostel Guide</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
        </div>
      </div>
    </div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row rg-30">
    <div class="col-lg-7">
      <div class="branch-card">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Course counselling</span>
        <h2>Ask about a course before you visit</h2>
        <p>Send a short enquiry and the admissions team can help you confirm the current batch, learning mode and next step.</p>
        <form class="branch-lead-form" action="<?= htmlspecialchars(site_url('mail.php'), ENT_QUOTES, 'UTF-8') ?>" method="POST">
          <input type="hidden" name="source_page" value="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
          <input type="hidden" name="preferred_branch" value="Shyam Nagar, Jaipur">
          <div class="branch-honeypot" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
          <div class="row">
            <div class="col-md-6"><div class="form-input"><label for="branch-name">Full name</label><input id="branch-name" name="name" type="text" required maxlength="100" autocomplete="name"></div></div>
            <div class="col-md-6"><div class="form-input"><label for="branch-phone">Mobile number</label><input id="branch-phone" name="phone" type="tel" required maxlength="15" inputmode="tel" autocomplete="tel"></div></div>
            <div class="col-md-6"><div class="form-input"><label for="branch-email">Email</label><input id="branch-email" name="email" type="email" required maxlength="190" autocomplete="email"></div></div>
            <div class="col-md-6"><div class="form-input"><label for="branch-course">Course interest</label><input id="branch-course" name="interested_course" type="text" placeholder="Python, Full Stack, Data Analytics..." maxlength="160"></div></div>
            <div class="col-12"><div class="form-input"><label for="branch-message">What would you like to know?</label><textarea id="branch-message" name="message" rows="4" placeholder="Tell us your current level or preferred batch."></textarea></div></div>
            <div class="col-12"><label class="branch-consent"><input type="checkbox" name="consent" value="1" required> I agree that Forsk Coding School may contact me about this course enquiry.</label></div>
            <div class="col-12"><button class="tj-btn-primary" type="submit">Submit Course Enquiry</button></div>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="branch-card">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Before visiting</span>
        <h2>A simple student checklist</h2>
        <ul class="branch-list">
          <li>Confirm the exact course and current batch availability.</li>
          <li>Ask whether your program is running classroom, live online or both.</li>
          <li>Use Google Maps for live traffic and metro/walking directions.</li>
          <li>If you are relocating, compare PG terms before paying any deposit.</li>
          <li>Keep the official admissions number saved for visit coordination.</li>
        </ul>
      </div>
    </div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row justify-content-center"><div class="col-lg-9">
    <div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> FAQs</span>
      <h2>Forsk Coding School Shyam Nagar FAQs</h2>
      <?php foreach ($faqs as $faq): ?>
        <div class="branch-faq">
          <h3><?= htmlspecialchars($faq['q'], ENT_QUOTES, 'UTF-8') ?></h3>
          <p><?= htmlspecialchars($faq['a'], ENT_QUOTES, 'UTF-8') ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div></div></div></section>
</main>
<?php include $root . '/includes/footer.php'; ?>
</div></div>
</body>
</html>
