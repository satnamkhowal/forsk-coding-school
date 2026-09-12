<?php
$root = dirname(__DIR__, 2);
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
$page_description = 'Visit Forsk Coding School in Shyam Nagar, Jaipur for coding, Full Stack, Data Analytics, Data Science, AI and practical IT course counselling.';
$page_keywords = 'Forsk Coding School Shyam Nagar Jaipur, coding classes Shyam Nagar, IT courses Jaipur, Full Stack course Jaipur, Data Analytics course Jaipur';
$page_canonical = 'https://forskcodingschool.com/branches/jaipur-shyam-nagar/';
$addressText = $branch['street_address'] . ', ' . $branch['city'] . ', ' . $branch['state'] . ' ' . $branch['postal_code'];
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'EducationalOrganization',
            '@id' => $page_canonical . '#organization',
            'name' => $branch['name'],
            'url' => $page_canonical,
            'telephone' => $branch['phone'],
            'email' => $branch['email'],
            'parentOrganization' => ['@id' => 'https://forskcodingschool.com/#organization'],
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
            'about' => ['@id' => $page_canonical . '#organization'],
            'isPartOf' => ['@id' => 'https://forskcodingschool.com/#website'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://forskcodingschool.com/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Branches', 'item' => 'https://forskcodingschool.com/branches/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Shyam Nagar Jaipur', 'item' => $page_canonical],
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Where is Forsk Coding School located in Jaipur?',
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'The verified Forsk Coding School location is in Shyam Nagar on New Sanganer Road, Jaipur, Rajasthan 302019.'],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Can I enquire about coding and IT courses at this branch?',
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. You can contact the Jaipur team for course counselling about programming, Full Stack, data, AI, cloud, cyber security and related learning paths.'],
                ],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
$mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($addressText);
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
      <h1 class="tj-page-title">Forsk Coding School – Shyam Nagar, Jaipur</h1>
      <div class="tj-page-link"><span><i class="tji-home"></i></span><span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span><a href="<?= htmlspecialchars(site_url('branches/'), ENT_QUOTES, 'UTF-8') ?>">Branches</a></span><span><i class="tji-arrow-right-4"></i></span><span>Shyam Nagar</span></div>
    </div>
  </div></div></div></section>

  <section class="section-gap"><div class="container"><div class="row rg-30">
    <div class="col-lg-7">
      <div class="branch-card">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Jaipur learning centre</span>
        <h2>Practical coding and IT learning in Shyam Nagar</h2>
        <p>Speak with the Forsk Coding School team about programming, Full Stack development, Data Analytics, Data Science, Artificial Intelligence, cloud, DevOps, cyber security and other career-focused technology learning paths.</p>
        <p>Course availability, batch timing and learning mode can change, so contact the admissions team before visiting.</p>
        <div class="branch-actions">
          <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('enroll-now.php?branch=jaipur-shyam-nagar'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Enquire About Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          <a class="tj-text-btn flip-text-wrap" href="tel:<?= htmlspecialchars($branch['phone'], ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Call +91 72319 68183</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <aside class="branch-card">
        <h2>Branch details</h2>
        <div class="branch-meta">
          <div><strong>Address</strong><?= htmlspecialchars($addressText, ENT_QUOTES, 'UTF-8') ?></div>
          <div><strong>Phone</strong><a href="tel:<?= htmlspecialchars($branch['phone'], ENT_QUOTES, 'UTF-8') ?>">+91 72319 68183</a></div>
          <div><strong>Email</strong><a href="mailto:<?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?></a></div>
        </div>
        <div class="branch-actions">
          <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener"><span class="btn-text">Open in Google Maps</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          <a class="tj-text-btn flip-text-wrap" href="https://wa.me/917231968183?text=Hi%20Forsk%20Coding%20School%2C%20I%20want%20course%20counselling%20for%20the%20Shyam%20Nagar%20Jaipur%20branch." target="_blank" rel="noopener"><span class="btn-text">WhatsApp</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
        </div>
      </aside>
    </div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row justify-content-center"><div class="col-lg-9">
    <div class="branch-card">
      <h2>Frequently asked questions</h2>
      <h3>Where is the Jaipur branch?</h3>
      <p><?= htmlspecialchars($addressText, ENT_QUOTES, 'UTF-8') ?>.</p>
      <h3>Which courses can I ask about?</h3>
      <p>You can enquire about Python, Java, Full Stack, JavaScript, React, MERN, Data Analytics, Data Science, AI, GenAI, cloud, DevOps, cyber security and other listed Forsk Coding School programs.</p>
      <h3>Should I call before visiting?</h3>
      <p>Yes. Call or WhatsApp the admissions team to confirm current counselling hours, batch availability and the most suitable learning mode.</p>
    </div>
  </div></div></div></section>
</main>
<?php include $root . '/includes/footer.php'; ?>
</div></div>
</body>
</html>
