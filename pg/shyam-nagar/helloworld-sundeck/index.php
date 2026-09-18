<?php
$root = dirname(__DIR__, 3);
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

$page_title = 'HelloWorld Sundeck Near Forsk Coding School Shyam Nagar Jaipur';
$page_description = 'Student-focused guide to HelloWorld Sundeck in Shyam Nagar near Forsk Coding School Jaipur, including current published rent, amenities, address, commute planning and booking checks.';
$page_keywords = 'HelloWorld Sundeck Shyam Nagar, PG near Forsk Coding School Jaipur, co living Shyam Nagar Jaipur, student accommodation Shyam Nagar';
$page_canonical = seo_url('pg/shyam-nagar/helloworld-sundeck/');
$officialUrl = 'https://thehelloworld.com/coliving-in-jaipur/shyam-nagar/helloworld-sundeck';
$propertyAddress = 'C-9, 10, Shiv Marg, Saket Nagar, Shyam Nagar, Jaipur, Rajasthan 302019';
$mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('HelloWorld Sundeck, ' . $propertyAddress);
$branchUrl = site_url('branches/jaipur-shyam-nagar/');
$directoryUrl = site_url('pg-near-forsk-coding-school-shyam-nagar/');
$checkedDate = '18 September 2026';

$faqs = [
    ['q' => 'What rent is currently published for HelloWorld Sundeck?', 'a' => 'The official HelloWorld Sundeck page checked on 18 September 2026 shows rent starting from ₹18,000 per month and a security deposit of one month rent. Final pricing can vary by room type, occupancy and move-in date, so verify the live listing before booking.'],
    ['q' => 'What amenities are listed by HelloWorld Sundeck?', 'a' => 'The official listing shows washing machine, RO, kitchen, fridge, sofa, carrom board, gas induction, water, internet, biometric access, CCTV and cleaning among its amenities.'],
    ['q' => 'Is HelloWorld Sundeck owned by Forsk Coding School?', 'a' => 'No. HelloWorld Sundeck is an independent accommodation provider. Forsk Coding School lists it only as a student resource and does not control pricing, availability or property rules.'],
    ['q' => 'How should I check the commute to Forsk Coding School?', 'a' => 'Use the live Google Maps route between HelloWorld Sundeck on Shiv Marg and the verified Forsk Coding School branch on New Sanganer Road. Both are in the wider Shyam Nagar locality, but exact travel time depends on the route and traffic.'],
];

$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $page_canonical . '#webpage',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'isPartOf' => ['@id' => seo_url('/#website')],
            'about' => ['@type' => 'Place', 'name' => 'HelloWorld Sundeck', 'address' => $propertyAddress],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => seo_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Shyam Nagar Branch', 'item' => seo_url('branches/jaipur-shyam-nagar/')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'PG & Hostel Guide', 'item' => seo_url('pg-near-forsk-coding-school-shyam-nagar/')],
                ['@type' => 'ListItem', 'position' => 4, 'name' => 'HelloWorld Sundeck', 'item' => $page_canonical],
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
        <span><i class="tji-home"></i></span><span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span>
        <span><i class="tji-arrow-right-4"></i></span><span><a href="<?= htmlspecialchars($directoryUrl, ENT_QUOTES, 'UTF-8') ?>">PG Guide</a></span>
        <span><i class="tji-arrow-right-4"></i></span><span>HelloWorld Sundeck</span>
      </div>
      <h1 class="tj-page-title">HelloWorld Sundeck near Forsk Coding School Shyam Nagar</h1>
      <p class="tj-page-desc">A student-focused summary of the current public property information, plus practical checks for commuting to the Forsk Shyam Nagar branch.</p>
    </div>
  </div></div></div></section>

  <section class="section-gap"><div class="container"><div class="row rg-30">
    <div class="col-lg-7"><article class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Accommodation detail</span>
      <h2>What is publicly listed for HelloWorld Sundeck?</h2>
      <p>HelloWorld Sundeck is a co-living/student accommodation property at <strong><?= htmlspecialchars($propertyAddress, ENT_QUOTES, 'UTF-8') ?></strong>. It is in the wider Shyam Nagar locality, the same area as the verified Forsk Coding School Jaipur branch.</p>
      <p>The official HelloWorld property page checked on <strong><?= htmlspecialchars($checkedDate, ENT_QUOTES, 'UTF-8') ?></strong> publishes a starting rent of <strong>₹18,000 per month</strong> and a <strong>security deposit of one month rent</strong>. The operator notes that final monthly outflow can vary with room type, occupancy, floor and move-in date.</p>
      <p>This page does not reproduce third-party price claims because accommodation rates can become stale quickly. Use the official property page for the latest availability and final quote.</p>
      <div class="branch-actions">
        <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars($officialUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer"><span class="btn-text">Check Official Property Page</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
        <a class="tj-text-btn flip-text-wrap" href="<?= htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener"><span class="btn-text">Open in Google Maps</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
      </div>
    </article></div>
    <div class="col-lg-5"><aside class="branch-card">
      <h2>Quick facts</h2>
      <div class="branch-meta">
        <div><strong>Property</strong>HelloWorld Sundeck</div>
        <div><strong>Area</strong>Shiv Marg / Shyam Nagar, Jaipur</div>
        <div><strong>Type</strong>Co-living / student accommodation</div>
        <div><strong>Published starting rent</strong>₹18,000/month on official site</div>
        <div><strong>Published deposit</strong>1 month rent</div>
        <div><strong>Public contact</strong><a href="tel:+918880008888">+91 88800 08888</a></div>
        <div><strong>Last checked</strong><?= htmlspecialchars($checkedDate, ENT_QUOTES, 'UTF-8') ?></div>
      </div>
    </aside></div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row rg-30">
    <div class="col-lg-6"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Amenities</span>
      <h2>Amenities shown on the official listing</h2>
      <p>The official property page lists the following amenities. Availability or access conditions can change, so confirm what is included in your exact room plan:</p>
      <ul class="branch-list">
        <li>Washing machine and cleaning</li>
        <li>RO drinking water and water supply</li>
        <li>Kitchen, fridge and gas induction</li>
        <li>Internet / Wi-Fi</li>
        <li>Biometric access and CCTV</li>
        <li>Sofa and common-use recreation such as carrom</li>
      </ul>
      <p class="branch-note">Meals are not assumed here because the official page says inclusion can vary by property or room plan.</p>
    </div></div>
    <div class="col-lg-6"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Commute planning</span>
      <h2>Travelling to Forsk Coding School</h2>
      <p>Forsk Coding School’s verified branch is at <strong><?= htmlspecialchars($branch['street_address'] . ', Jaipur, Rajasthan ' . $branch['postal_code'], ENT_QUOTES, 'UTF-8') ?></strong>. HelloWorld Sundeck and Forsk are both in the broader Shyam Nagar area.</p>
      <p>Rather than publishing a fixed commute time that can become misleading, use live directions for your expected class time. Check both walking and two-wheeler/public-transport routes, especially if your batch ends in the evening.</p>
      <div class="branch-actions">
        <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars($branchUrl, ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Forsk Shyam Nagar Branch</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
      </div>
    </div></div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row rg-30">
    <div class="col-lg-7"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Before booking</span>
      <h2>Questions students should ask during a visit</h2>
      <ul class="branch-list">
        <li>Which room category is available on your intended move-in date?</li>
        <li>What is the final monthly amount for that room, including electricity or other usage charges?</li>
        <li>What deposit, token and notice period apply to your booking?</li>
        <li>What are the refund rules if you cancel or move out early?</li>
        <li>Are meals included in your specific plan, and what are the timings?</li>
        <li>What are the guest, curfew and access rules?</li>
        <li>Can you test the Wi-Fi and mobile signal in the actual room?</li>
        <li>What cleaning frequency and common-area maintenance are included?</li>
      </ul>
    </div></div>
    <div class="col-lg-5"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Student resources</span>
      <h2>Continue planning your Jaipur stay</h2>
      <div class="student-link-list">
        <a href="<?= htmlspecialchars($directoryUrl, ENT_QUOTES, 'UTF-8') ?>">Compare more PGs near Forsk Shyam Nagar</a>
        <a href="<?= htmlspecialchars($branchUrl, ENT_QUOTES, 'UTF-8') ?>">Forsk Coding School Shyam Nagar branch</a>
        <a href="<?= htmlspecialchars(site_url('courses.php'), ENT_QUOTES, 'UTF-8') ?>">Explore Forsk courses</a>
        <a href="<?= htmlspecialchars(site_url('enroll-now.php?branch=jaipur-shyam-nagar'), ENT_QUOTES, 'UTF-8') ?>">Ask admissions about a current batch</a>
      </div>
      <p class="branch-note">Forsk Coding School is not affiliated with or responsible for the accommodation operator unless a specific partnership is explicitly disclosed.</p>
    </div></div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row justify-content-center"><div class="col-lg-9">
    <div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> FAQs</span>
      <h2>HelloWorld Sundeck student FAQs</h2>
      <?php foreach ($faqs as $faq): ?>
        <div class="branch-faq"><h3><?= htmlspecialchars($faq['q'], ENT_QUOTES, 'UTF-8') ?></h3><p><?= htmlspecialchars($faq['a'], ENT_QUOTES, 'UTF-8') ?></p></div>
      <?php endforeach; ?>
    </div>
  </div></div></div></section>
</main>
<?php include $root . '/includes/footer.php'; ?>
</div></div>
</body>
</html>
