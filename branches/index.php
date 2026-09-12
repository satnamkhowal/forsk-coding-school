<?php
$root = dirname(__DIR__);
$branches = require $root . '/includes/branches-data.php';
$branches = array_values(array_filter($branches, static fn(array $branch): bool => !empty($branch['verified'])));

$page_title = 'Forsk Coding School Branch in Jaipur | Shyam Nagar Location';
$page_description = 'Find the verified Forsk Coding School branch in Shyam Nagar, Jaipur, with address, contact details, course counselling and enrollment links.';
$page_keywords = 'Forsk Coding School Jaipur branch, coding institute Shyam Nagar Jaipur, IT training institute Jaipur, coding classes Jaipur';
$page_canonical = 'https://forskcodingschool.com/branches/';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
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
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Branches', 'item' => $page_canonical],
            ],
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
      <h1 class="tj-page-title">Forsk Coding School Branch in Jaipur</h1>
      <div class="tj-page-link"><span><i class="tji-home"></i></span><span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span>Branches</span></div>
      <div class="shape"><img src="<?= htmlspecialchars(asset_url('images/shapes/stars.png'), ENT_QUOTES, 'UTF-8') ?>" alt="" aria-hidden="true"></div>
    </div>
  </div></div></div></section>

  <section class="section-gap"><div class="container">
    <div class="row justify-content-center"><div class="col-lg-9 text-center">
      <div class="sec-heading sec-heading-center">
        <span class="sec-subtitle"><i class="tji-subtitle"></i> Verified location</span>
        <h2 class="sec-title">Visit Forsk Coding School in Shyam Nagar, Jaipur</h2>
        <p class="desc">Use this directory for confirmed public branch information. New physical locations are added only after their address and contact details are verified.</p>
      </div>
    </div></div>

    <div class="row rg-30">
      <?php foreach ($branches as $branch): ?>
      <div class="col-lg-6">
        <article class="branch-card">
          <span class="sec-subtitle"><i class="tji-subtitle"></i> Jaipur</span>
          <h2><?= htmlspecialchars($branch['short_name'], ENT_QUOTES, 'UTF-8') ?></h2>
          <p>Practical coding and IT course counselling for students, freshers, beginners and working professionals.</p>
          <div class="branch-meta">
            <div><strong>Address</strong><?= htmlspecialchars($branch['street_address'] . ', ' . $branch['city'] . ', ' . $branch['state'] . ' ' . $branch['postal_code'], ENT_QUOTES, 'UTF-8') ?></div>
            <div><strong>Phone</strong><a href="tel:<?= htmlspecialchars($branch['phone'], ENT_QUOTES, 'UTF-8') ?>">+91 72319 68183</a></div>
            <div><strong>Email</strong><a href="mailto:<?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?></a></div>
          </div>
          <div class="branch-actions">
            <a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('branches/' . $branch['slug'] . '/'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">View Branch Details</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
            <a class="tj-text-btn flip-text-wrap" href="<?= htmlspecialchars(site_url('enroll-now.php?branch=' . rawurlencode($branch['slug'])), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Enroll / Enquire</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
          </div>
        </article>
      </div>
      <?php endforeach; ?>
    </div>
  </div></section>
</main>
<?php include $root . '/includes/footer.php'; ?>
</div></div>
</body>
</html>
