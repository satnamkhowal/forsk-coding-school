<?php
$root = dirname(__DIR__);
require_once $root . '/config.php';
$branches = require $root . '/includes/branches-data.php';
$branch = null;
foreach ($branches as $candidate) {
    if (($candidate['slug'] ?? '') === 'jaipur-shyam-nagar' && !empty($candidate['verified'])) { $branch = $candidate; break; }
}
if (!$branch) { http_response_code(404); exit('Branch not found.'); }

$page_title = 'How to Reach Forsk Coding School Shyam Nagar Jaipur | Metro & Directions';
$page_description = 'Plan your visit to Forsk Coding School Shyam Nagar Jaipur with the verified address, Google Maps route, New Sanganer Road directions, nearby metro references and student travel tips.';
$page_keywords = 'how to reach Forsk Coding School Shyam Nagar, Forsk Coding School directions Jaipur, Shyam Nagar metro coding institute, New Sanganer Road coding classes';
$page_canonical = seo_url('how-to-reach-forsk-coding-school-shyam-nagar/');
$address = $branch['street_address'] . ', ' . $branch['city'] . ', ' . $branch['state'] . ' ' . $branch['postal_code'] . ', India';
$maps = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($address);
$embed = 'https://www.google.com/maps?q=' . rawurlencode($address) . '&output=embed';
$shyamMetro = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('Shyam Nagar Metro Station, New Sanganer Road, Jaipur');
$vivekMetro = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('Vivek Vihar Metro Station, New Sanganer Road, Jaipur');

$faqs = [
 ['q'=>'What is the exact address of Forsk Coding School Shyam Nagar?','a'=>'F1, Forsk Coding School, New Sanganer Rd, F Block, Shyam Nagar, Jaipur, Rajasthan 302019, India.'],
 ['q'=>'Which metro stations are useful for reaching the Shyam Nagar branch?','a'=>'Shyam Nagar Metro and Vivek Vihar Metro are useful reference stations on the New Sanganer Road corridor. Use live transit directions from your starting point because the most convenient station and route can vary.'],
 ['q'=>'Should I call before travelling to the branch?','a'=>'Yes. Call or WhatsApp the admissions team on +91 72319 68183 to confirm current counselling hours and course availability before visiting.'],
 ['q'=>'Can I find PG accommodation near the branch?','a'=>'Yes. Forsk maintains a separate student accommodation guide covering public boys PG, girls PG, hostel and co-living information around Shyam Nagar.'],
];

$page_schema = json_encode([
 '@context'=>'https://schema.org',
 '@graph'=>[
   ['@type'=>'WebPage','@id'=>$page_canonical.'#webpage','url'=>$page_canonical,'name'=>$page_title,'description'=>$page_description,'isPartOf'=>['@id'=>seo_url('/#website')],'about'=>['@id'=>seo_url('branches/jaipur-shyam-nagar/#branch')]],
   ['@type'=>'BreadcrumbList','itemListElement'=>[
      ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>seo_url('/')],
      ['@type'=>'ListItem','position'=>2,'name'=>'Shyam Nagar Branch','item'=>seo_url('branches/jaipur-shyam-nagar/')],
      ['@type'=>'ListItem','position'=>3,'name'=>'How to Reach','item'=>$page_canonical],
   ]],
   ['@type'=>'FAQPage','mainEntity'=>array_map(static fn(array $faq): array => ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq['a']]], $faqs)],
 ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
$header_variant='header-1';
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

<section class="tj-page-header"><div class="container"><div class="row"><div class="col-12"><div class="tj-page-header-content">
<div class="tj-page-link"><span><i class="tji-home"></i></span><span><a href="<?= htmlspecialchars(site_url('/'), ENT_QUOTES, 'UTF-8') ?>">Home</a></span><span><i class="tji-arrow-right-4"></i></span><span><a href="<?= htmlspecialchars(site_url('branches/jaipur-shyam-nagar/'), ENT_QUOTES, 'UTF-8') ?>">Shyam Nagar Branch</a></span><span><i class="tji-arrow-right-4"></i></span><span>How to Reach</span></div>
<h1 class="tj-page-title">How to Reach Forsk Coding School Shyam Nagar, Jaipur</h1>
<p class="tj-page-desc">Use the verified branch address and live route tools instead of relying on older location references found elsewhere on the web.</p>
</div></div></div></div></section>

<section class="section-gap"><div class="container"><div class="row rg-30">
<div class="col-lg-7"><article class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> Verified address</span>
<h2>Forsk Coding School on New Sanganer Road</h2>
<p>The current verified Forsk Coding School Jaipur branch is at <strong><?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?></strong>. This page is intentionally tied to the maintained branch record so students do not have to rely on older Pratap Nagar, Mansarovar, mall or Sitapura references that may still appear in historical listings.</p>
<p>Before travelling, open the live Google Maps route and confirm your class or counselling time with admissions. Travel time can change substantially by traffic, time of day and your starting point.</p>
<div class="branch-actions">
<a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars($maps, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener"><span class="btn-text">Open Live Directions</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
<a class="tj-text-btn flip-text-wrap" href="tel:<?= htmlspecialchars($branch['phone'], ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Call <?= htmlspecialchars(SITE_PHONE_DISPLAY, ENT_QUOTES, 'UTF-8') ?></span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
</div>
</article></div>
<div class="col-lg-5"><aside class="branch-card">
<h2>Quick visit details</h2>
<div class="branch-meta">
<div><strong>Branch</strong>Shyam Nagar, Jaipur</div>
<div><strong>Road</strong>New Sanganer Road</div>
<div><strong>PIN</strong>302019</div>
<div><strong>Phone</strong><a href="tel:<?= htmlspecialchars($branch['phone'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(SITE_PHONE_DISPLAY, ENT_QUOTES, 'UTF-8') ?></a></div>
<div><strong>Email</strong><a href="mailto:<?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($branch['email'], ENT_QUOTES, 'UTF-8') ?></a></div>
</div>
</aside></div>
</div></div></section>

<section class="section-gap-bottom"><div class="container"><div class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> Map</span>
<h2>Branch location map</h2>
<div class="branch-map"><iframe src="<?= htmlspecialchars($embed, ENT_QUOTES, 'UTF-8') ?>" title="Forsk Coding School Shyam Nagar Jaipur map" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>
</div></div></section>

<section class="section-gap-bottom"><div class="container"><div class="row rg-30">
<div class="col-lg-6"><div class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> Metro</span>
<h2>Using Jaipur Metro</h2>
<p><strong>Shyam Nagar Metro</strong> and <strong>Vivek Vihar Metro</strong> are useful public-transport reference points on the New Sanganer Road corridor. The better station depends on your origin and the route you choose after exiting the metro.</p>
<p>Rather than publishing a fixed walking time, which can be misleading as entrances and road crossings matter, compare both stations in live Maps before leaving.</p>
<div class="student-link-list">
<a href="<?= htmlspecialchars($shyamMetro, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Open Shyam Nagar Metro in Maps</a>
<a href="<?= htmlspecialchars($vivekMetro, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Open Vivek Vihar Metro in Maps</a>
</div>
</div></div>
<div class="col-lg-6"><div class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> Two-wheeler / cab / auto</span>
<h2>Planning a road trip to the branch</h2>
<p>For road travel, set the destination to the full F1 New Sanganer Road address rather than entering only “Forsk Coding School Jaipur.” This reduces the chance of being routed to a historical location or similarly named listing.</p>
<ul class="branch-list">
<li>Check live traffic immediately before leaving.</li>
<li>Keep the official admissions number available if you need last-mile guidance.</li>
<li>If using a cab or auto, share the full address and Maps pin.</li>
<li>Ask the branch about current parking convenience if you are bringing your own vehicle.</li>
</ul>
</div></div>
</div></div></section>

<section class="section-gap-bottom"><div class="container"><div class="row justify-content-center"><div class="col-lg-9"><div class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> Local Jaipur travel resource</span>
<h2>Need a cab or Jaipur travel plan around your visit?</h2>
<p>Students and families combining a branch visit with Jaipur sightseeing, station or airport transfers, or an outstation trip can explore <a href="https://swiggywala.com/" target="_blank" rel="noopener">Swiggy Wala Tours &amp; Travels in Jaipur</a>. Confirm current route, vehicle and pricing details directly with the travel provider before booking.</p>
</div></div></div></div></section>

<section class="section-gap-bottom"><div class="container"><div class="row rg-30">
<div class="col-lg-6"><div class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> Students relocating to Jaipur</span>
<h2>Combine your course visit with accommodation checks</h2>
<p>If you are moving to Jaipur for classroom learning, use the same visit to inspect nearby PG or hostel options. Compare the route from the property to Forsk at the time your likely batch will run, not only during quiet daytime traffic.</p>
<div class="branch-actions"><a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('pg-near-forsk-coding-school-shyam-nagar/'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">PG & Hostel Guide</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></div>
</div></div>
<div class="col-lg-6"><div class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> Course visit</span>
<h2>Know what you want to ask</h2>
<p>Bring your current qualification, target role and preferred learning mode to the counselling conversation. This helps the team narrow down Python, Java, Full Stack, Data Analytics, Data Science, AI or other pathways without turning the visit into a generic sales conversation.</p>
<div class="branch-actions"><a class="tj-btn-primary flip-text-wrap" href="<?= htmlspecialchars(site_url('courses.php'), ENT_QUOTES, 'UTF-8') ?>"><span class="btn-text">Browse Courses First</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a></div>
</div></div>
</div></div></section>

<section class="section-gap-bottom"><div class="container"><div class="row justify-content-center"><div class="col-lg-9"><div class="branch-card">
<span class="sec-subtitle"><i class="tji-subtitle"></i> FAQs</span><h2>Directions FAQs</h2>
<?php foreach($faqs as $faq): ?><div class="branch-faq"><h3><?= htmlspecialchars($faq['q'], ENT_QUOTES, 'UTF-8') ?></h3><p><?= htmlspecialchars($faq['a'], ENT_QUOTES, 'UTF-8') ?></p></div><?php endforeach; ?>
</div></div></div></div></section>

</main>
<?php include $root . '/includes/footer.php'; ?>
</div></div>
</body>
</html>