<?php
require_once dirname(__DIR__) . '/config.php';

$platforms = require __DIR__ . '/social-platforms.php';
$social_key = isset($social_key) ? strtolower(trim((string)$social_key)) : '';

if (!isset($platforms[$social_key])) {
    http_response_code(404);
    $social_key = 'instagram';
}

$platform = $platforms[$social_key];
$page_title = SITE_NAME . ' on ' . $platform['name'] . ' | Official Social Profile';
$page_description = $platform['description'];
$page_keywords = SITE_NAME . ', ' . $platform['name'] . ', ' . $platform['handle'] . ', coding school Jaipur social media';
$page_canonical = SEO_BASE_URL . '/' . $social_key . '/';
$page_og_image = seo_url('assets/images/forsk-coding-school-logo-transparent-black-text-horizontal.webp');
$header_variant = 'header-1';

$sameAs = [];
foreach ($platforms as $social) {
    if (!empty($social['url'])) $sameAs[] = $social['url'];
}

$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'ProfilePage',
            '@id' => $page_canonical . '#profile',
            'url' => $page_canonical,
            'name' => $page_title,
            'description' => $page_description,
            'mainEntity' => ['@id' => SITE_ORGANIZATION_ID],
            'inLanguage' => 'en-IN',
        ],
        [
            '@type' => 'Organization',
            '@id' => SITE_ORGANIZATION_ID,
            'name' => SITE_NAME,
            'url' => SEO_BASE_URL . '/',
            'sameAs' => $sameAs,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

if (!function_exists('forsk_social_fetch_remote')) {
    function forsk_social_fetch_remote(string $url, int $timeout = 5): string {
        $body = '';
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CONNECTTIMEOUT => $timeout,
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; ForskCodingSchool/1.0; +https://forskcodingschool.com/)',
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_HTTPHEADER => ['Accept-Language: en-US,en;q=0.9'],
            ]);
            $result = curl_exec($ch);
            if (is_string($result)) $body = $result;
            curl_close($ch);
        }
        if ($body === '' && ini_get('allow_url_fopen')) {
            $context = stream_context_create(['http' => [
                'timeout' => $timeout,
                'header' => "User-Agent: Mozilla/5.0 (compatible; ForskCodingSchool/1.0)\r\nAccept-Language: en-US,en;q=0.9\r\n",
            ]]);
            $result = @file_get_contents($url, false, $context);
            if (is_string($result)) $body = $result;
        }
        return $body;
    }
}

if (!function_exists('forsk_youtube_ids')) {
    function forsk_youtube_ids(string $url, string $cacheName, int $limit = 8): array {
        $root = dirname(__DIR__);
        $cacheDir = $root . '/storage/cache/social';
        $cacheFile = $cacheDir . '/' . preg_replace('/[^a-z0-9_-]+/i', '-', $cacheName) . '.json';
        $ttl = 1800;

        if (is_file($cacheFile) && (time() - (int)@filemtime($cacheFile) < $ttl)) {
            $cached = json_decode((string)@file_get_contents($cacheFile), true);
            if (is_array($cached) && !empty($cached)) return array_slice($cached, 0, $limit);
        }

        $html = forsk_social_fetch_remote($url, 5);
        $ids = [];
        if ($html !== '') {
            if (preg_match_all('/"videoId":"([A-Za-z0-9_-]{11})"/', $html, $matches)) {
                $ids = array_values(array_unique($matches[1] ?? []));
            }
            if (empty($ids) && preg_match_all('/watch\\?v=([A-Za-z0-9_-]{11})/', $html, $matches)) {
                $ids = array_values(array_unique($matches[1] ?? []));
            }
        }

        $ids = array_slice($ids, 0, $limit);
        if (!empty($ids)) {
            if (!is_dir($cacheDir)) @mkdir($cacheDir, 0775, true);
            if (is_dir($cacheDir) && is_writable($cacheDir)) {
                @file_put_contents($cacheFile, json_encode($ids, JSON_UNESCAPED_SLASHES));
            }
        } elseif (is_file($cacheFile)) {
            $cached = json_decode((string)@file_get_contents($cacheFile), true);
            if (is_array($cached)) $ids = array_slice($cached, 0, $limit);
        }

        return $ids;
    }
}

$youtubeVideos = [];
$youtubeShorts = [];
if ($social_key === 'youtube') {
    $channelBase = rtrim($platform['url'], '/');
    $youtubeVideos = forsk_youtube_ids($channelBase . '/videos', 'youtube-videos', 8);
    $youtubeShorts = forsk_youtube_ids($channelBase . '/shorts', 'youtube-shorts', 8);
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en-IN">
<head>
  <base href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">
  <?php include __DIR__ . '/head.php'; ?>
  <link rel="stylesheet" href="<?= htmlspecialchars(asset_url('css/social-profile.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main id="primary" class="site-main forsk-social-page">
  <div class="space-for-header"></div>
  <section class="forsk-social-hero">
    <div class="container forsk-social-shell">
      <span class="forsk-social-kicker">Official social profile</span>
      <h1 class="forsk-social-title"><?= htmlspecialchars(SITE_NAME . ' on ' . $platform['name'], ENT_QUOTES, 'UTF-8') ?></h1>
      <p class="forsk-social-lead"><?= htmlspecialchars($platform['description'], ENT_QUOTES, 'UTF-8') ?></p>
      <div class="forsk-social-actions">
        <?php if (!empty($platform['url'])): ?>
          <a class="forsk-social-btn primary" href="<?= htmlspecialchars($platform['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Open <?= htmlspecialchars($platform['name'], ENT_QUOTES, 'UTF-8') ?></a>
        <?php endif; ?>
        <a class="forsk-social-btn secondary" href="social/">All Forsk Social Profiles</a>
      </div>
    </div>
  </section>

  <section>
    <div class="container forsk-social-shell">
      <nav class="forsk-social-nav" aria-label="Forsk Coding School social profiles">
        <?php foreach ($platforms as $key => $item): ?>
          <a href="<?= htmlspecialchars($key . '/', ENT_QUOTES, 'UTF-8') ?>"<?= $key === $social_key ? ' aria-current="page"' : '' ?>><?= htmlspecialchars($item['short_name'], ENT_QUOTES, 'UTF-8') ?></a>
        <?php endforeach; ?>
      </nav>
    </div>
  </section>

  <section class="forsk-social-content">
    <div class="container forsk-social-shell">
      <div class="forsk-social-card">
        <div class="forsk-profile-summary">
          <div class="forsk-profile-mark"><?= htmlspecialchars(strtoupper(substr($platform['name'], 0, 1)), ENT_QUOTES, 'UTF-8') ?></div>
          <div>
            <h3><?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?></h3>
            <p><?= $platform['handle'] !== '' ? htmlspecialchars($platform['handle'], ENT_QUOTES, 'UTF-8') : 'Official handle not linked yet' ?></p>
          </div>
        </div>

        <?php if ($platform['embed'] === 'instagram'): ?>
          <h2>Instagram Profile &amp; Recent Content</h2>
          <p>The public Forsk Coding School Instagram profile is loaded below using Instagram's profile embed surface.</p>
          <div class="forsk-instagram-wrap">
            <iframe src="<?= htmlspecialchars($platform['embed_url'], ENT_QUOTES, 'UTF-8') ?>" title="Forsk Coding School Instagram profile" loading="lazy" allowtransparency="true"></iframe>
          </div>

        <?php elseif ($platform['embed'] === 'facebook'): ?>
          <h2>Facebook Page &amp; Timeline</h2>
          <p>View the public Facebook page timeline, posts and page information directly from Facebook.</p>
          <div class="forsk-facebook-wrap">
            <iframe src="https://www.facebook.com/plugins/page.php?href=<?= rawurlencode($platform['url']) ?>&tabs=timeline&width=500&height=900&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true" title="Forsk Coding School Facebook page" scrolling="no" frameborder="0" allowfullscreen="true" loading="lazy" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
          </div>

        <?php elseif ($platform['embed'] === 'youtube'): ?>
          <h2>YouTube Videos &amp; Shorts</h2>
          <p>This page automatically reads the public Forsk Coding School channel pages and embeds available YouTube videos. If YouTube blocks a server refresh, the official channel buttons remain available.</p>

          <div class="forsk-video-section">
            <h3>Long videos</h3>
            <?php if (!empty($youtubeVideos)): ?>
              <div class="forsk-video-grid">
                <?php foreach ($youtubeVideos as $videoId): ?>
                  <article class="forsk-video-item"><div class="forsk-video-ratio"><iframe src="https://www.youtube-nocookie.com/embed/<?= htmlspecialchars($videoId, ENT_QUOTES, 'UTF-8') ?>" title="Forsk Coding School YouTube video" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div></article>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="forsk-social-empty"><div><h3>Open the latest videos</h3><p>YouTube did not return a server-readable video list right now. Use the official channel to view the complete current video feed.</p><a class="forsk-social-btn primary" href="<?= htmlspecialchars(rtrim($platform['url'], '/') . '/videos', ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">View all videos</a></div></div>
            <?php endif; ?>
          </div>

          <div class="forsk-video-section">
            <h3>Shorts</h3>
            <?php if (!empty($youtubeShorts)): ?>
              <div class="forsk-video-grid">
                <?php foreach ($youtubeShorts as $videoId): ?>
                  <article class="forsk-video-item"><div class="forsk-video-ratio short"><iframe src="https://www.youtube-nocookie.com/embed/<?= htmlspecialchars($videoId, ENT_QUOTES, 'UTF-8') ?>" title="Forsk Coding School YouTube Short" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div></article>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="forsk-social-empty"><div><h3>Open the latest Shorts</h3><p>The official Shorts feed is always available on YouTube even when automated server fetching is restricted.</p><a class="forsk-social-btn primary" href="<?= htmlspecialchars(rtrim($platform['url'], '/') . '/shorts', ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">View all Shorts</a></div></div>
            <?php endif; ?>
          </div>

        <?php elseif ($platform['embed'] === 'linkedin'): ?>
          <h2>LinkedIn Company Profile</h2>
          <p>LinkedIn does not provide a public full-company-timeline iframe comparable to Facebook's Page Plugin. This page keeps a clean first-party profile landing page and links directly to the official Forsk Coding School company feed.</p>
          <div class="forsk-social-empty">
            <div><h3>Forsk Coding School on LinkedIn</h3><p>Open the official company profile to see the complete current post feed, followers, company information and professional updates.</p><a class="forsk-social-btn primary" href="<?= htmlspecialchars($platform['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Open LinkedIn company page</a></div>
          </div>

        <?php elseif ($platform['embed'] === 'blogger'): ?>
          <h2>Forsk Coding School Blogger Feed</h2>
          <p>Read public Blogger posts and updates below. If the external site blocks iframe display in a browser, the direct profile link remains available.</p>
          <div class="forsk-blogger-wrap"><iframe src="<?= htmlspecialchars($platform['url'], ENT_QUOTES, 'UTF-8') ?>" title="Forsk Coding School Blogger posts" loading="lazy"></iframe></div>

        <?php else: ?>
          <h2><?= htmlspecialchars($platform['name'], ENT_QUOTES, 'UTF-8') ?> Profile</h2>
          <div class="forsk-social-empty"><div><h3>Official handle not linked yet</h3><p>We found no verified Forsk Coding School X / Twitter handle in the website's current official social references, so this page intentionally does not guess or point visitors to an unverified account.</p><a class="forsk-social-btn secondary" href="social/">View verified social profiles</a></div></div>
        <?php endif; ?>

        <div class="forsk-social-note">Embedded third-party content is served by the social platform. Visibility can depend on the platform's login, privacy, cookie or embed settings.</div>
      </div>
    </div>
  </section>
</main>
</div></div>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
