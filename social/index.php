<?php
require_once dirname(__DIR__) . '/config.php';
$platforms = require dirname(__DIR__) . '/includes/social-platforms.php';
$page_title = 'Official Social Media Profiles | Forsk Coding School';
$page_description = 'Find the official Forsk Coding School Instagram, Facebook, YouTube, LinkedIn, X/Twitter and Blogger pages from one verified first-party directory.';
$page_keywords = 'Forsk Coding School social media, Forsk Instagram, Forsk Facebook, Forsk YouTube, Forsk LinkedIn';
$page_canonical = SEO_BASE_URL . '/social/';
$page_og_image = seo_url('assets/images/forsk-coding-school-logo-transparent-black-text-horizontal.webp');
$header_variant = 'header-1';
$sameAs = [];
foreach ($platforms as $item) if (!empty($item['url'])) $sameAs[] = $item['url'];
$page_schema = json_encode([
  '@context'=>'https://schema.org',
  '@type'=>'CollectionPage',
  'name'=>$page_title,
  'description'=>$page_description,
  'url'=>$page_canonical,
  'about'=>['@type'=>'Organization','@id'=>SITE_ORGANIZATION_ID,'name'=>SITE_NAME,'url'=>SEO_BASE_URL.'/','sameAs'=>$sameAs]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
<head>
  <base href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">
  <?php include dirname(__DIR__) . '/includes/head.php'; ?>
  <link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/social-profile.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>
<?php include dirname(__DIR__) . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main id="primary" class="site-main forsk-social-page">
  <div class="space-for-header"></div>
  <section class="forsk-social-hero">
    <div class="container forsk-social-shell">
      <span class="forsk-social-kicker">Official profile directory</span>
      <h1 class="forsk-social-title">Follow Forsk Coding School</h1>
      <p class="forsk-social-lead">Use these first-party pages to open or view Forsk Coding School's verified public social profiles and platform content from one place.</p>
    </div>
  </section>
  <section class="forsk-social-content">
    <div class="container forsk-social-shell">
      <div class="forsk-social-grid">
        <?php foreach ($platforms as $key => $item): ?>
          <a class="forsk-social-platform-card" href="<?= htmlspecialchars($key . '/', ENT_QUOTES, 'UTF-8') ?>">
            <strong><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></strong>
            <span><?= htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8') ?></span>
            <em>Open profile page →</em>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
</div></div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
</body>
</html>
