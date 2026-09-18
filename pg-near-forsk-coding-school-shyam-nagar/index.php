<?php
$root = dirname(__DIR__);
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

$page_title = 'Best PG Near Forsk Coding School Shyam Nagar Jaipur – Boys & Girls PG';
$page_description = 'Looking for a PG near Forsk Coding School Shyam Nagar Jaipur? Compare nearby boys PGs, girls PGs, hostels and co-living options with public contact, location and facility information.';
$page_keywords = 'PG near Forsk Coding School Shyam Nagar, boys PG Shyam Nagar Jaipur, girls PG Shyam Nagar Jaipur, hostel near Forsk Coding School Jaipur, student accommodation Shyam Nagar';
$page_canonical = seo_url('pg-near-forsk-coding-school-shyam-nagar/');
$page_og_image = seo_url('assets/images/logos/forsk-icon.png');
$checkedDate = '18 September 2026';
$branchAddress = $branch['street_address'] . ', ' . $branch['city'] . ', ' . $branch['state'] . ' ' . $branch['postal_code'] . ', India';
$branchMap = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($branchAddress);
$mapEmbed = 'https://www.google.com/maps?q=' . rawurlencode('PG near ' . $branchAddress) . '&output=embed';

function pg_maps_url(string $name, string $address): string {
    return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($name . ', ' . $address);
}

$properties = [
    [
        'name' => 'HelloWorld Sundeck',
        'type' => 'Co-living / student accommodation',
        'address' => 'C-9, 10, Shiv Marg, Saket Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Under ~1 km locality range',
        'contact' => '+91 88800 08888',
        'phone' => '+918880008888',
        'rent' => 'From ₹18,000/month on official site',
        'facilities' => 'Official listing shows washing machine, RO, kitchen, fridge, sofa, carrom, induction, water, internet, biometric access, CCTV and cleaning.',
        'website' => 'https://thehelloworld.com/coliving-in-jaipur/shyam-nagar/helloworld-sundeck',
        'detail' => site_url('pg/shyam-nagar/helloworld-sundeck/'),
    ],
    [
        'name' => 'Sri Sri PG for Ladies',
        'type' => 'Girls / working women',
        'address' => '46 Kailashpuri, Near Shyam Nagar Metro Station, New Sanganer Road, Sodala, Jaipur, Rajasthan 302019',
        'distance' => 'Under ~1 km locality range',
        'contact' => '+91 93146 49799',
        'phone' => '+919314649799',
        'rent' => 'Not independently verified',
        'facilities' => 'Public business listing confirms the property name, address and phone. Confirm room type, food, Wi-Fi, security and current charges directly.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Manoram Boys Hostel',
        'type' => 'Boys hostel',
        'address' => '31, Tirth Nagar Rd, Tirth Nagar, Saket Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Under ~1 km locality range',
        'contact' => 'No public phone captured in source used',
        'phone' => '',
        'rent' => 'Not publicly verified',
        'facilities' => 'Facilities were not reliably published in the source used. Inspect the room and verify inclusions directly.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Shyam Girls PG',
        'type' => 'Girls / student dormitory',
        'address' => '140A, Laxman Path, Laxman Colony, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Approx. ~1–2 km locality range',
        'contact' => 'No public phone captured in source used',
        'phone' => '',
        'rent' => 'Not publicly verified',
        'facilities' => 'Facilities were not reliably published in the source used. Confirm security, meals, electricity and visitor rules directly.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Radhika Girls PG',
        'type' => 'Girls hostel',
        'address' => '28-B, Nanu Marg, Nakshtra Villa Rail Nagar, Devi Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Approx. ~1–2 km locality range',
        'contact' => '+91 77428 11181',
        'phone' => '+917742811181',
        'rent' => 'Not publicly verified',
        'facilities' => 'Public listing confirms address and phone. Ask directly about occupancy, food, Wi-Fi, CCTV, power backup and deposit.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Shree Shyam PG Boys Hostel',
        'type' => 'Boys hostel',
        'address' => 'B-33, New Sanganer Rd, near Metro pillar, Hanuman Path, Devi Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Approx. ~1–2 km locality range',
        'contact' => '+91 89470 50000',
        'phone' => '+918947050000',
        'rent' => 'Not publicly verified',
        'facilities' => 'Public listing confirms address and phone. Verify current room types, food, Wi-Fi, electricity and security directly.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Spring Stay PG – Devi Nagar',
        'type' => 'Boys hostel',
        'address' => '55–55A, Devi Nagar, Nirman Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Approx. ~1–2 km locality range',
        'contact' => '+91 83027 68969',
        'phone' => '+918302768969',
        'rent' => 'Not publicly verified',
        'facilities' => 'Public listing confirms the Devi Nagar branch and phone. Verify room inclusions and house rules directly.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Aarvi Boys PG',
        'type' => 'Boys hostel / PG',
        'address' => '237, New Sanganer Rd, Katewa Nagar, Devi Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Approx. ~1–2 km locality range',
        'contact' => 'No public phone captured in source used',
        'phone' => '',
        'rent' => 'Not publicly verified',
        'facilities' => 'Facilities were not reliably published in the source used. Verify room, food, internet and security before booking.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Bhagasara Hostel',
        'type' => 'Boys hostel',
        'address' => '184, near Jaipur International Public School, Katewa Nagar, Devi Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Approx. ~1–2 km locality range',
        'contact' => '+91 93145 14625',
        'phone' => '+919314514625',
        'rent' => 'Not publicly verified',
        'facilities' => 'Public business listing confirms the address and phone. Confirm current facilities and charges directly before paying.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'UTSAV PG',
        'type' => 'Boys hostel',
        'address' => '219, Krishna Marg, Lane 8, New Sanganer Rd, Katewa Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Approx. ~1–2 km locality range',
        'contact' => '+91 89550 06013',
        'phone' => '+918955006013',
        'rent' => 'Not publicly verified',
        'facilities' => 'Public listing confirms address and phone. Ask about occupancy, food, laundry, Wi-Fi, power backup and deposit.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Shivalay Boys PG',
        'type' => 'Boys hostel',
        'address' => '583, behind Gujar Ki Thadi, Katewa Nagar, Devi Nagar, Shyam Nagar, Jaipur, Rajasthan 302019',
        'distance' => 'Around ~2 km locality range',
        'contact' => '+91 73402 66260',
        'phone' => '+917340266260',
        'rent' => 'Not publicly verified',
        'facilities' => 'Public listing confirms address and phone. Verify room availability, food and security arrangements directly.',
        'website' => '',
        'detail' => '',
    ],
    [
        'name' => 'Sayar PG Homes',
        'type' => 'Boys hostel',
        'address' => 'Plot 620, Gali 5, near Metro Pillar 68, New Sanganer Rd, Devi Nagar, Gurjar Ki Thadi, Jaipur, Rajasthan 302019',
        'distance' => 'Around ~2 km locality range',
        'contact' => '+91 98291 69613',
        'phone' => '+919829169613',
        'rent' => 'Not publicly verified',
        'facilities' => 'Public listing confirms address and phone. Verify current facilities, occupancy and payment terms directly.',
        'website' => '',
        'detail' => '',
    ],
];

$faqs = [
    ['q' => 'Which PG is closest to Forsk Coding School Shyam Nagar?', 'a' => 'Several properties are in the same Shyam Nagar and New Sanganer Road locality, including HelloWorld Sundeck, Sri Sri PG for Ladies and Manoram Boys Hostel. Exact walking or driving distance depends on the property entrance and route, so use the map link before booking.'],
    ['q' => 'Are both boys and girls PG options available near Forsk Shyam Nagar?', 'a' => 'Yes. The public listings checked include boys hostels, girls PGs and co-living accommodation in Shyam Nagar, Devi Nagar and the New Sanganer Road corridor.'],
    ['q' => 'Does Forsk Coding School own or recommend these PGs?', 'a' => 'No. The listings are an informational student resource. Forsk Coding School does not own, operate or guarantee these accommodation providers. Students should inspect the property and verify terms directly.'],
    ['q' => 'What should I verify before paying a PG deposit?', 'a' => 'Verify the property identity, room condition, written rent and deposit terms, electricity and food charges, notice or lock-in period, refund policy, Wi-Fi, security, visitor rules, curfew and the actual route to your class.'],
    ['q' => 'Is metro transport available around Shyam Nagar?', 'a' => 'Shyam Nagar Metro and Vivek Vihar Metro serve the New Sanganer Road corridor. Use live transit directions to compare your PG route with the Forsk branch.'],
];

$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => $page_canonical . '#webpage',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'isPartOf' => ['@id' => seo_url('/#website')],
            'about' => ['@id' => seo_url('branches/jaipur-shyam-nagar/#branch')],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => seo_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Shyam Nagar Branch', 'item' => seo_url('branches/jaipur-shyam-nagar/')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'PG & Hostel Guide', 'item' => $page_canonical],
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
        <span><a href="<?= htmlspecialchars(site_url('branches/jaipur-shyam-nagar/'), ENT_QUOTES, 'UTF-8') ?>">Shyam Nagar Branch</a></span>
        <span><i class="tji-arrow-right-4"></i></span>
        <span>PG & Hostel Guide</span>
      </div>
      <h1 class="tj-page-title">Best PG Near Forsk Coding School Shyam Nagar Jaipur</h1>
      <p class="tj-page-desc">A factual student guide to nearby boys PGs, girls PGs, hostels and co-living options around Shyam Nagar and New Sanganer Road.</p>
    </div>
  </div></div></div></section>

  <section class="section-gap"><div class="container"><div class="row rg-30">
    <div class="col-lg-8">
      <article class="branch-card">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Student accommodation guide</span>
        <h2>Finding accommodation near Forsk Coding School</h2>
        <p>The verified Forsk Coding School Jaipur branch is at <strong><?= htmlspecialchars($branchAddress, ENT_QUOTES, 'UTF-8') ?></strong>. If you are relocating for Python, Full Stack, Data Analytics, Data Science, Java, AI or another course, living around Shyam Nagar, Devi Nagar, Saket Nagar or the New Sanganer Road corridor can simplify your daily route.</p>
        <p>This page is not a paid ranking and does not claim that one PG is “best” for every student. It collects public business information to help you create a shortlist. Prices, vacancies, meals, deposits and house rules can change quickly, so confirm them directly before paying.</p>
        <p><strong>Distance note:</strong> the ranges below are locality-level approximations from public map/business research, not guaranteed walking-route measurements. Open the route in Maps for your exact commute.</p>
        <div class="branch-actions">
          <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('branches/jaipur-shyam-nagar/'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">View Forsk Shyam Nagar Branch</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          <a class="tj-text-btn flip-text-wrap" href="<?= htmlspecialchars($branchMap, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener"><span class="btn-text">Open Branch in Maps</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
        </div>
      </article>
    </div>
    <div class="col-lg-4">
      <aside class="branch-card">
        <h2>Last checked</h2>
        <p><strong><?= htmlspecialchars($checkedDate, ENT_QUOTES, 'UTF-8') ?></strong></p>
        <p>Public details can change after this date. Always confirm current rent, vacancy, facilities, curfew, deposit and refund terms with the property.</p>
        <div class="branch-map branch-map-small">
          <iframe src="<?= htmlspecialchars($mapEmbed, ENT_QUOTES, 'UTF-8') ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="PG and hostel map around Forsk Coding School Shyam Nagar Jaipur" allowfullscreen></iframe>
        </div>
      </aside>
    </div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container">
    <div class="sec-heading"><span class="sec-subtitle"><i class="tji-subtitle"></i> Comparison</span><h2 class="sec-title">Nearby PG and hostel options</h2><p class="desc">Use the public contact or map link to verify each property directly.</p></div>
    <div class="pg-table-wrap">
      <table class="pg-table">
        <thead><tr><th>Property</th><th>Type</th><th>Approx. range</th><th>Public details</th><th>Rent</th><th>Contact / verify</th></tr></thead>
        <tbody>
        <?php foreach ($properties as $property):
          $maps = pg_maps_url($property['name'], $property['address']);
        ?>
          <tr>
            <td><strong><?= htmlspecialchars($property['name'], ENT_QUOTES, 'UTF-8') ?></strong><span><?= htmlspecialchars($property['address'], ENT_QUOTES, 'UTF-8') ?></span></td>
            <td><?= htmlspecialchars($property['type'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($property['distance'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($property['facilities'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($property['rent'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>
              <?php if ($property['phone'] !== ''): ?><a href="tel:<?= htmlspecialchars($property['phone'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($property['contact'], ENT_QUOTES, 'UTF-8') ?></a><br><?php else: ?><span><?= htmlspecialchars($property['contact'], ENT_QUOTES, 'UTF-8') ?></span><br><?php endif; ?>
              <a href="<?= htmlspecialchars($maps, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Google Maps</a>
              <?php if ($property['website'] !== ''): ?><br><a href="<?= htmlspecialchars($property['website'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Official website</a><?php endif; ?>
              <?php if ($property['detail'] !== ''): ?><br><a href="<?= htmlspecialchars($property['detail'], ENT_QUOTES, 'UTF-8') ?>">Forsk detail guide</a><?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p class="branch-note">No property is ranked or endorsed by Forsk Coding School. “Not publicly verified” means the detail was not reliable enough in the source set used for this update.</p>
  </div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row rg-30">
    <div class="col-lg-6"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Transport</span>
      <h2>Getting to Forsk from nearby PG areas</h2>
      <p>The branch sits on New Sanganer Road in Shyam Nagar. Shyam Nagar Metro and Vivek Vihar Metro are useful transport references for students living in Shyam Nagar, Devi Nagar, Katewa Nagar and nearby Sodala.</p>
      <p>For daily travel, compare the route during the same hours as your expected class. A property that looks close by straight-line distance can take longer if the entrance is on another street or if traffic is heavy.</p>
      <ul class="branch-list">
        <li>Check the walking route from the PG to the nearest metro station.</li>
        <li>Check the route from the PG directly to the Forsk branch.</li>
        <li>Compare late-evening transport availability if your batch finishes later.</li>
        <li>Confirm parking rules if you plan to use a two-wheeler.</li>
      </ul>
    </div></div>
    <div class="col-lg-6"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Daily needs</span>
      <h2>Food, groceries and student convenience</h2>
      <p>Shyam Nagar and the New Sanganer Road corridor have supermarkets, local vegetable markets, restaurants, cafés and everyday services. This can matter as much as room rent when you are choosing a place for several months.</p>
      <p>Before booking, walk around the property and check the nearest grocery store, affordable meal options, pharmacy, ATM, laundry option and public transport. If meals are included in the PG rent, ask for the actual meal schedule and whether Sunday or holiday meals differ.</p>
    </div></div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row rg-30">
    <div class="col-lg-7"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Before you pay</span>
      <h2>Student safety and booking checklist</h2>
      <p>Accommodation terms are private agreements between the student and the property. A few checks can prevent common misunderstandings:</p>
      <ul class="branch-list">
        <li>Visit the exact room you are booking or request a live video walkthrough.</li>
        <li>Confirm monthly rent, security deposit, brokerage, electricity, food, laundry and maintenance charges in writing.</li>
        <li>Ask about lock-in, notice period, deposit refund timeline and deductions.</li>
        <li>Check entry controls, CCTV/common-area security, visitor rules and curfew.</li>
        <li>Test mobile signal, Wi-Fi expectations, water supply and power backup.</li>
        <li>Do not transfer a large deposit until you have verified the property identity and payment recipient.</li>
        <li>Keep receipts, rent agreement and written messages about promised facilities.</li>
      </ul>
    </div></div>
    <div class="col-lg-5"><div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> Course links</span>
      <h2>Popular Forsk courses</h2>
      <div class="student-link-list">
        <a href="<?= htmlspecialchars(site_url('python-programming-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Python training at Forsk</a>
        <a href="<?= htmlspecialchars(site_url('full-stack-development-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Full Stack Development</a>
        <a href="<?= htmlspecialchars(site_url('data-analytics-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Data Analytics course in Jaipur</a>
        <a href="<?= htmlspecialchars(site_url('data-science-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Data Science</a>
        <a href="<?= htmlspecialchars(site_url('java-programming-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Java Programming</a>
        <a href="<?= htmlspecialchars(site_url('power-bi-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Power BI</a>
        <a href="<?= htmlspecialchars(site_url('artificial-intelligence-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Artificial Intelligence</a>
        <a href="<?= htmlspecialchars(site_url('generative-ai-course-jaipur.php'), ENT_QUOTES, 'UTF-8') ?>">Generative AI</a>
      </div>
      <div class="branch-actions"><a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('courses.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Explore Courses at Forsk</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></div>
    </div></div>
  </div></div></section>

  <section class="section-gap-bottom"><div class="container"><div class="row justify-content-center"><div class="col-lg-9">
    <div class="branch-card">
      <span class="sec-subtitle"><i class="tji-subtitle"></i> FAQs</span>
      <h2>PG near Forsk Coding School Shyam Nagar FAQs</h2>
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
