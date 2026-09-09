<?php
/**
 * Forsk Coding School - Blog Details Dynamic Entry
 *
 * Place at: /blog/blog-details.php
 *
 * Usage:
 *   /blog/blog-details.php?slug=your-blog-slug
 *
 * Existing original root /blog-details.php is NOT replaced.
 */
$root_path = dirname(__DIR__);
require_once $root_path . '/config.php';

$slug = trim((string)($_GET['slug'] ?? $_GET['post'] ?? ''), "/ \t\n\r\0\x0B");

if ($slug !== '' && preg_match('/^[a-z0-9][a-z0-9-]*$/i', $slug)) {
    $target = __DIR__ . '/' . $slug . '/index.php';

    if (is_file($target)) {
        header('Location: ' . blog_url($slug), true, 302);
        exit;
    }
}

http_response_code(404);

$page_title = 'Blog Not Found | Forsk Coding School';
$page_description = 'The requested Forsk Coding School blog could not be found.';
$page_keywords = 'Forsk Coding School blog';
$page_canonical = site_url('/blog/blog-details.php');
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $page_title,
    'description' => $page_description,
    'url' => $page_canonical
], JSON_UNESCAPED_SLASHES);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php include $root_path . '/includes/head.php'; ?>
</head>
<body>
<?php include $root_path . '/includes/header.php'; ?>
<div id="smooth-wrapper">
  <div id="smooth-content">
    <main id="primary" class="site-main">
      <div class="space-for-header"></div>
      <section class="tj-page-header">
        <div class="container">
          <div class="tj-page-header-content">
            <h1 class="tj-page-title">Blog Not Found</h1>
            <div class="tj-page-link">
              <span><i class="tji-home"></i></span>
              <span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span>
              <span><i class="tji-arrow-right-4"></i></span>
              <span><a href="<?= htmlspecialchars(site_url('/blog/'), ENT_QUOTES, 'UTF-8') ?>">Blog</a></span>
            </div>
          </div>
        </div>
      </section>
      <section class="tj-blog-section section-gap-bottom">
        <div class="container">
          <div class="tj_wpost_entry_content">
            <p>The requested blog does not exist.</p>
            <p><a class="tj-btn-primary" href="<?= htmlspecialchars(site_url('/blog/'), ENT_QUOTES, 'UTF-8') ?>">Browse all blogs</a></p>
          </div>
        </div>
      </section>
    </main>
    <?php include $root_path . '/includes/footer.php'; ?>
  </div>
</div>
</body>
</html>
