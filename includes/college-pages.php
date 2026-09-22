<?php
require_once dirname(__DIR__) . '/config.php';

function forsk_college_h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
function forsk_college_phone_href(string $phone): string {
    return preg_replace('/[^0-9+]/', '', $phone) ?: '';
}
function forsk_college_monogram(string $name): string {
    $parts = preg_split('/\s+/', trim($name)) ?: [];
    $letters = '';
    foreach ($parts as $part) {
        if ($part !== '' && preg_match('/[A-Za-z0-9]/', $part, $m)) $letters .= strtoupper($m[0]);
        if (strlen($letters) >= 3) break;
    }
    return $letters !== '' ? $letters : 'C';
}
function forsk_college_logo_html(array $college): string {
    $path = trim((string)($college['logo_path'] ?? ''));
    $root = dirname(__DIR__);
    if ($path !== '' && is_file($root . '/' . ltrim($path, '/'))) {
        return '<img class="college-logo-img" src="' . forsk_college_h($path) . '" alt="' . forsk_college_h((string)$college['short']) . ' official logo" loading="lazy" width="96" height="96">';
    }
    return '<div class="college-logo-fallback" aria-label="' . forsk_college_h((string)$college['short']) . '">' . forsk_college_h(forsk_college_monogram((string)$college['short'])) . '</div>';
}
function forsk_college_disclaimer(): string {
    return '<p class="college-disclaimer"><strong>Independent guidance notice:</strong> Forsk Coding School provides education and admission-guidance information. College/university names, trademarks and logos belong to their respective owners. Unless a specific partnership is stated on an individual page, this page should not be read as an affiliation or endorsement. Always verify eligibility, fees, dates, approvals and seat availability on the institution’s official website before applying.</p>';
}
function forsk_college_page_open(array $category, ?array $college = null): void {
    global $page_title, $page_description, $page_keywords, $page_canonical, $page_schema, $page_og_image, $header_variant;
    $isDetail = is_array($college);
    $categorySlug = (string)$category['slug'];
    $program = (string)$category['program'];
    if ($isDetail) {
        $name = (string)$college['name'];
        $page_title = $name . ' ' . $program . ' Admission in Jaipur | Forsk Coding School';
        $page_description = 'View verified official contact details for ' . $name . ' in Jaipur and request independent ' . $program . ' admission guidance from Forsk Coding School.';
        $page_keywords = $name . ' Jaipur, ' . $program . ' admission Jaipur, ' . $category['title'] . ', Forsk Coding School';
        $page_canonical = seo_url($categorySlug . '/' . $college['slug'] . '/');
        $collegeSchema = [
            '@type' => 'CollegeOrUniversity',
            'name' => $name,
            'url' => (string)$college['website'],
            'telephone' => (string)$college['phone'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => (string)$college['address'],
                'addressLocality' => 'Jaipur',
                'addressRegion' => 'Rajasthan',
                'addressCountry' => 'IN'
            ],
            'sameAs' => [(string)$college['official_page']]
        ];
        $breadcrumbs = [
            '@type'=>'BreadcrumbList',
            'itemListElement'=>[
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>seo_url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>(string)$category['title'],'item'=>seo_url($categorySlug . '/')],
                ['@type'=>'ListItem','position'=>3,'name'=>$name,'item'=>$page_canonical]
            ]
        ];
        $page_schema = json_encode(['@context'=>'https://schema.org','@graph'=>[$collegeSchema,$breadcrumbs]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    } else {
        $page_title = $category['title'] . ' | Compare & Request Admission Guidance';
        $page_description = (string)$category['description'];
        $page_keywords = $category['title'] . ', ' . $program . ' admission Jaipur, colleges in Jaipur, Forsk Coding School';
        $page_canonical = seo_url($categorySlug . '/');
        $items = [];
        foreach ($category['colleges'] as $i => $item) {
            $items[] = ['@type'=>'ListItem','position'=>$i+1,'name'=>(string)$item['name'],'url'=>seo_url($categorySlug . '/' . $item['slug'] . '/')];
        }
        $page_schema = json_encode([
            '@context'=>'https://schema.org',
            '@graph'=>[
                ['@type'=>'CollectionPage','name'=>(string)$category['title'],'description'=>$page_description,'url'=>$page_canonical],
                ['@type'=>'ItemList','name'=>'Selected ' . $category['title'],'itemListElement'=>$items],
                ['@type'=>'BreadcrumbList','itemListElement'=>[
                    ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>seo_url('/')],
                    ['@type'=>'ListItem','position'=>2,'name'=>(string)$category['title'],'item'=>$page_canonical]
                ]]
            ]
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }
    $page_og_image = 'assets/images/logos/forsk-icon.png';
    $header_variant = 'header-1';
    ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php include dirname(__DIR__) . '/includes/head.php'; ?>
<link rel="stylesheet" href="includes/college-pages.css">
</head>
<body>
<?php include dirname(__DIR__) . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main id="primary" class="site-main college-pages">
<?php
}
function forsk_college_page_close(): void {
    ?>
</main>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
</div></div>
<script src="includes/college-pages.js" defer></script>
</body>
</html>
<?php
}
function forsk_render_college_listing(array $category): void {
    forsk_college_page_open($category);
    $slug = (string)$category['slug'];
    ?>
    <section class="college-hero">
      <div class="container">
        <nav class="college-breadcrumb" aria-label="Breadcrumb"><a href="/">Home</a><span>/</span><span><?= forsk_college_h((string)$category['title']) ?></span></nav>
        <div class="college-hero-grid">
          <div>
            <span class="college-kicker">Jaipur College Guide • Verified official links</span>
            <h1><?= forsk_college_h((string)$category['title']) ?></h1>
            <p><?= forsk_college_h((string)$category['description']) ?></p>
            <div class="college-hero-actions">
              <a class="college-btn college-btn-primary" href="#college-list">Explore colleges</a>
              <a class="college-btn college-btn-secondary" href="#enquiry">Request admission guidance</a>
            </div>
          </div>
          <div class="college-hero-panel">
            <strong><?= count($category['colleges']) ?> verified starter listings</strong>
            <span>Static college data today, database-ready lead capture from day one.</span>
            <ul><li>Official website links</li><li>Verified contact numbers</li><li>Individual ad-ready landing URLs</li><li>UTM-aware lead tracking</li></ul>
          </div>
        </div>
      </div>
    </section>

    <section class="college-section" id="college-list">
      <div class="container">
        <div class="college-section-head">
          <div><span class="college-kicker">Compare selected institutions</span><h2>Find a <?= forsk_college_h((string)$category['singular']) ?> in Jaipur</h2></div>
          <label class="college-search"><span class="visually-hidden">Search colleges</span><input type="search" placeholder="Search college name…" data-college-filter></label>
        </div>
        <div class="college-grid" data-college-grid>
        <?php foreach ($category['colleges'] as $college): ?>
          <article class="college-card" data-college-card data-search="<?= forsk_college_h(strtolower($college['name'] . ' ' . $college['short'])) ?>">
            <div class="college-card-top"><?= forsk_college_logo_html($college) ?><span class="college-verified">Official details checked <?= forsk_college_h((string)$college['verified_on']) ?></span></div>
            <h3><a href="<?= forsk_college_h($slug . '/' . $college['slug'] . '/') ?>"><?= forsk_college_h((string)$college['short']) ?></a></h3>
            <p><?= forsk_college_h((string)$college['address']) ?></p>
            <div class="college-contact-row"><a href="tel:<?= forsk_college_h(forsk_college_phone_href((string)$college['phone'])) ?>"><?= forsk_college_h((string)$college['phone']) ?></a><a href="<?= forsk_college_h((string)$college['website']) ?>" target="_blank" rel="noopener external">Official website ↗</a></div>
            <div class="college-card-actions"><a class="college-btn college-btn-primary" href="<?= forsk_college_h($slug . '/' . $college['slug'] . '/') ?>">View admission page</a></div>
          </article>
        <?php endforeach; ?>
        </div>
        <p class="college-empty" data-college-empty hidden>No matching college in this starter list. You can still submit the guidance form below.</p>
      </div>
    </section>

    <section class="college-section college-section-soft">
      <div class="container college-content-grid">
        <div>
          <span class="college-kicker">How to shortlist</span>
          <h2>Check the official facts before you apply</h2>
          <div class="college-checklist">
            <div><strong>1. Program fit</strong><p>Confirm the exact course, specialisation, eligibility and current intake on the college’s official website.</p></div>
            <div><strong>2. Approval & recognition</strong><p>Verify current approvals/accreditation from the institution and relevant regulator instead of relying on old marketing claims.</p></div>
            <div><strong>3. Total cost</strong><p>Check tuition, development, hostel, exam and one-time fees for the current admission session.</p></div>
            <div><strong>4. Admission route</strong><p>Understand entrance tests, counselling, direct-admission rules, documents and deadlines before paying any amount.</p></div>
          </div>
          <?= forsk_college_disclaimer() ?>
        </div>
        <div class="college-lead-shell">
          <?php
          $lead_channel = 'college';
          $lead_interest = (string)$category['program'] . ' admission guidance in Jaipur';
          $lead_heading = 'Get ' . (string)$category['program'] . ' Admission Guidance';
          $lead_submit_label = 'Request Guidance Call';
          $lead_return_path = $slug . '/';
          $lead_college_category = $slug;
          $lead_college_slug = '';
          $lead_college_name = '';
          $lead_program = (string)$category['program'];
          include dirname(__DIR__) . '/includes/lead-form.php';
          ?>
        </div>
      </div>
    </section>
    <section class="college-section">
      <div class="container">
        <div class="college-source-card">
          <h2>More Jaipur admission research resources</h2>
          <p>For a broader Jaipur-focused college directory, course categories and admission research, explore <a href="https://collegeinjaipur.com/" target="_blank" rel="noopener">College in Jaipur</a>. Students who also want wider admission guidance and course comparison can review <a href="https://kyakru.com/" target="_blank" rel="noopener">KyaKru</a>.</p>
        </div>
      </div>
    </section>
    <?php
    forsk_college_page_close();
}
function forsk_render_college_detail(array $category, array $college): void {
    forsk_college_page_open($category, $college);
    $categorySlug = (string)$category['slug'];
    $detailPath = $categorySlug . '/' . $college['slug'] . '/';
    ?>
    <section class="college-detail-hero">
      <div class="container">
        <nav class="college-breadcrumb" aria-label="Breadcrumb"><a href="/">Home</a><span>/</span><a href="<?= forsk_college_h($categorySlug . '/') ?>"><?= forsk_college_h((string)$category['title']) ?></a><span>/</span><span><?= forsk_college_h((string)$college['short']) ?></span></nav>
        <div class="college-detail-grid">
          <div class="college-detail-main">
            <div class="college-brand-row"><?= forsk_college_logo_html($college) ?><div><span class="college-kicker"><?= forsk_college_h((string)$category['program']) ?> • Jaipur</span><h1><?= forsk_college_h((string)$college['name']) ?></h1></div></div>
            <p class="college-lead">Use this page to reach the institution’s official resources and request independent admission guidance from Forsk Coding School. Final admission decisions, fees and eligibility remain with the institution.</p>
            <div class="college-fact-grid">
              <div><span>Location</span><strong><?= forsk_college_h((string)$college['address']) ?></strong></div>
              <div><span>Official contact</span><strong><a href="tel:<?= forsk_college_h(forsk_college_phone_href((string)$college['phone'])) ?>"><?= forsk_college_h((string)$college['phone']) ?></a></strong></div>
              <div><span>Details checked</span><strong><?= forsk_college_h((string)$college['verified_on']) ?></strong></div>
            </div>
            <div class="college-hero-actions">
              <a class="college-btn college-btn-primary" href="<?= forsk_college_h((string)$college['official_page']) ?>" target="_blank" rel="noopener external">Open official admission page ↗</a>
              <a class="college-btn college-btn-secondary" href="tel:<?= forsk_college_h(forsk_college_phone_href((string)$college['phone'])) ?>">Call official number</a>
              <?php if (!empty($college['brochure'])): ?><a class="college-btn college-btn-secondary" href="<?= forsk_college_h((string)$college['brochure']) ?>" target="_blank" rel="noopener external">Open official brochure PDF ↗</a><?php endif; ?>
            </div>
          </div>
          <aside class="college-lead-shell college-lead-sticky">
            <?php
            $lead_channel = 'college';
            $lead_interest = (string)$category['program'] . ' admission guidance - ' . (string)$college['short'];
            $lead_heading = 'Ask About ' . (string)$college['short'];
            $lead_submit_label = 'Request Admission Call';
            $lead_return_path = $detailPath;
            $lead_college_category = $categorySlug;
            $lead_college_slug = (string)$college['slug'];
            $lead_college_name = (string)$college['name'];
            $lead_program = (string)$category['program'];
            include dirname(__DIR__) . '/includes/lead-form.php';
            ?>
          </aside>
        </div>
      </div>
    </section>

    <section class="college-section">
      <div class="container college-content-grid college-content-grid-wide">
        <article>
          <span class="college-kicker">Admission research checklist</span>
          <h2>What to verify for <?= forsk_college_h((string)$college['short']) ?></h2>
          <p>Before submitting fees or documents, confirm the latest <?= forsk_college_h((string)$category['program']) ?> admission information directly with <?= forsk_college_h((string)$college['short']) ?>. This page intentionally avoids copying volatile fee, ranking or placement numbers that can become outdated.</p>
          <div class="college-checklist">
            <div><strong>Eligibility & entrance route</strong><p>Check the current qualifying-exam requirements, counselling or entrance-test route and category rules.</p></div>
            <div><strong>Course & specialisation</strong><p>Verify that your preferred branch or specialisation is offered in the current session and note its duration.</p></div>
            <div><strong>Fees & refund rules</strong><p>Read the current official fee structure, hostel/transport charges, scholarship terms and refund/cancellation policy.</p></div>
            <div><strong>Documents & dates</strong><p>Confirm application deadlines, document verification, reporting dates and original-document requirements.</p></div>
          </div>
          <div class="college-source-card">
            <h3>Official information sources</h3>
            <p><a href="<?= forsk_college_h((string)$college['website']) ?>" target="_blank" rel="noopener external"><?= forsk_college_h((string)$college['website']) ?> ↗</a></p>
            <p><a href="<?= forsk_college_h((string)$college['source']) ?>" target="_blank" rel="noopener external">Contact/program source used for this page ↗</a></p>
            <?php if (!empty($college['brochure'])): ?><p><a href="<?= forsk_college_h((string)$college['brochure']) ?>" target="_blank" rel="noopener external">Official brochure/prospectus ↗</a></p><?php endif; ?>
          </div>
          <?= forsk_college_disclaimer() ?>
        </article>
        <aside class="college-side-links">
          <h3>Other <?= forsk_college_h((string)$category['title']) ?></h3>
          <?php foreach ($category['colleges'] as $item): if ($item['slug'] === $college['slug']) continue; ?>
            <a href="<?= forsk_college_h($categorySlug . '/' . $item['slug'] . '/') ?>"><span><?= forsk_college_h((string)$item['short']) ?></span><span>→</span></a>
          <?php endforeach; ?>
          <a class="college-all-link" href="<?= forsk_college_h($categorySlug . '/') ?>">View all selected colleges</a>
        </aside>
      </div>
    </section>
    <?php
    forsk_college_page_close();
}
