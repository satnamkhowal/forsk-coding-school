<?php
$landing_title = trim((string)($landing_title ?? 'Forsk Coding School Program'));
$landing_description = trim((string)($landing_description ?? 'Practical guidance from Forsk Coding School in Jaipur.'));
$landing_eyebrow = trim((string)($landing_eyebrow ?? 'Forsk Coding School Jaipur'));
$landing_image = trim((string)($landing_image ?? 'assets/images/full-stack-development-course-jaipur-forsk-coding-school.webp'));
$landing_image_alt = trim((string)($landing_image_alt ?? $landing_title));
$landing_highlights = is_array($landing_highlights ?? null) ? $landing_highlights : [];
$landing_sections = is_array($landing_sections ?? null) ? $landing_sections : [];
$page_title = trim((string)($page_title ?? $landing_title . ' | Forsk Coding School'));
$page_description = trim((string)($page_description ?? $landing_description));
$page_canonical = trim((string)($page_canonical ?? seo_url(basename((string)($_SERVER['SCRIPT_NAME'] ?? '')))));
$page_og_image = $landing_image;
$header_variant = 'header-1';
$page_schema = json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [
    ['@type'=>'WebPage','name'=>$page_title,'description'=>$page_description,'url'=>$page_canonical],
    ['@type'=>'EducationalOrganization','@id'=>'https://forskcodingschool.com/#organization','name'=>'Forsk Coding School','url'=>'https://forskcodingschool.com/','telephone'=>'+917231968183'],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head><?php include dirname(__DIR__) . '/includes/head.php'; ?></head>
<body>
<?php include dirname(__DIR__) . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main id="primary" class="site-main">
  <div class="space-for-header"></div>
  <section class="tj-page-header tj-page-header-2">
    <div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
      <div class="tj-page-link"><span><i class="tji-home"></i></span><span><a href="index.php">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span><?= htmlspecialchars($landing_eyebrow, ENT_QUOTES, 'UTF-8') ?></span></div>
      <span class="forsk-badge"><?= htmlspecialchars($landing_eyebrow, ENT_QUOTES, 'UTF-8') ?></span>
      <h1 class="tj-page-title"><?= htmlspecialchars($landing_title, ENT_QUOTES, 'UTF-8') ?></h1>
      <p class="tj-page-desc"><?= htmlspecialchars($landing_description, ENT_QUOTES, 'UTF-8') ?></p>
      <div class="btn-area mt-4"><a class="tj-btn-primary flip-text-wrap" href="#enquiry"><span class="btn-text">Enquire Now</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></div>
      <div class="shape"><img src="assets/images/shapes/stars.png" alt="" aria-hidden="true"></div>
    </div></div></div></div>
  </section>

  <section class="forsk-content-section">
    <div class="container"><div class="row rg-30 align-items-center">
      <div class="col-lg-6"><img class="forsk-course-thumb" src="<?= htmlspecialchars($landing_image, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($landing_image_alt, ENT_QUOTES, 'UTF-8') ?>"></div>
      <div class="col-lg-6">
        <div class="sec-heading"><span class="sec-subtitle"><i class="tji-subtitle"></i> Practical guidance</span><h2 class="sec-title">A clear path from enquiry to the next step</h2></div>
        <div class="row">
          <?php foreach ($landing_highlights as $highlight): ?><div class="col-sm-6 mb-3"><div class="forsk-related-card"><i class="tji-check"></i> <?= htmlspecialchars((string)$highlight, ENT_QUOTES, 'UTF-8') ?></div></div><?php endforeach; ?>
        </div>
      </div>
    </div></div>
  </section>

  <?php foreach ($landing_sections as $heading => $content): ?>
  <section class="forsk-content-section section-separator"><div class="container"><div class="row justify-content-center"><div class="col-lg-10">
    <div class="sec-heading"><h2 class="sec-title"><?= htmlspecialchars((string)$heading, ENT_QUOTES, 'UTF-8') ?></h2></div>
    <?php if (is_array($content)): ?><ul class="course-details-list"><?php foreach ($content as $item): ?><li><?= htmlspecialchars((string)$item, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ul>
    <?php else: ?><p><?= htmlspecialchars((string)$content, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
  </div></div></div></section>
  <?php endforeach; ?>

  <section class="tj-contact-section section-gap"><div class="container"><div class="row justify-content-center"><div class="col-lg-9">
    <?php include dirname(__DIR__) . '/includes/lead-form.php'; ?>
  </div></div></div></section>
</main>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
</div></div>
</body></html>
