<?php $header_variant = $header_variant ?? 'header-1'; ?>
<div class="body-overlay"></div>
<!-- Preloader disabled for local stability -->
<div class="preloader" style="display:none!important;"></div>
<div class="back-to-top-wrapper">
  <button id="back-to-top" type="button" class="back-to-top-btn" aria-label="Back to top">
    <span class="back-to-top-icon"><i class="tji-arrow-up-2"></i></span>
  </button>
</div>

<!-- start: Hamburger Menu -->
<div class="hamburger-area">
  <div class="hamburger_bg"></div>
  <div class="hamburger_wrapper">
    <div class="hamburger_inner">
      <div class="hamburger_top d-flex align-items-center justify-content-between">
        <div class="hamburger_logo">
          <a href="./" class="mobile_logo" aria-label="Forsk Coding School home">
            <img src="assets/images/logos/forsk-icon.png" alt="Forsk Coding School">
          </a>
        </div>
        <div class="hamburger_close">
          <button class="hamburger_close_btn" type="button" aria-label="Close menu">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
      </div>
      <div class="hamburger-text d-none d-lg-block">
        <p>Practical coding and data-skills training in Jaipur with project-focused learning, mentor guidance and career preparation.</p>
      </div>
      <div class="hamburger-search-area">
        <h5 class="hamburger-title">Search courses</h5>
        <div class="hamburger_search">
          <form method="get" action="courses.php" role="search">
            <button type="submit" aria-label="Search courses"><i class="tji-search"></i></button>
            <input type="search" autocomplete="off" name="s" value="" placeholder="Search courses..." aria-label="Search courses">
          </form>
        </div>
      </div>
      <div class="hamburger_menu">
        <div class="mobile_menu"></div>
      </div>
      <div class="hamburger-infos">
        <h5 class="hamburger-title">Contact info</h5>
        <div class="contact-info">
          <div class="contact-item">
            <span class="subtitle">Phone:</span>
            <a class="contact-link" href="tel:+917231968183">+91 72319 68183</a>
          </div>
          <div class="contact-item">
            <span class="subtitle">Email:</span>
            <a class="contact-link" href="mailto:info@forskcodingschool.com">info@forskcodingschool.com</a>
          </div>
          <div class="contact-item">
            <span class="subtitle">Location:</span>
            <a class="contact-link" href="branches/">Jaipur, Rajasthan, India</a>
          </div>
        </div>
      </div>
    </div>
    <div class="hamburger-socials">
      <a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php">
        <span class="btn-text">Enquire / Enroll</span>
      </a>
    </div>
  </div>
</div>
<!-- end: Hamburger Menu -->

<?php
$header_logo = $header_variant === 'header-1'
  ? 'assets/images/forsk-coding-school-logo-transparent-black-text-horizontal.webp'
  : 'assets/images/logos/forsk-icon.png';

function forsk_header_navigation(bool $mobileId = false): void {
  $id = $mobileId ? ' id="mobile-menu"' : '';
  echo '<div class="menu-area d-none d-lg-inline-flex align-items-center"><nav' . $id . ' class="mainmenu">';
  include __DIR__ . '/menu.php';
  echo '</nav></div>';
}

function forsk_header_actions(string $variant, bool $showSearch = false): void {
  $wrapperClass = in_array($variant, ['header-3', 'header-4'], true)
    ? 'header-right-item d-inline-flex align-items-center'
    : 'header-right-item d-inline-flex';

  echo '<div class="' . $wrapperClass . '">';
  if ($showSearch) {
    echo '<div class="header-search-box d-lg-block d-none">'
      . '<form method="get" action="courses.php" role="search">'
      . '<button type="submit" aria-label="Search courses"><i class="tji-search"></i></button>'
      . '<input type="search" autocomplete="off" name="s" placeholder="Search courses..." aria-label="Search courses">'
      . '</form></div>';
  }

  if ($variant === 'header-2') {
    echo '<div class="header-button d-xl-flex d-none">'
      . '<a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap" href="branches/"><span class="btn-text">Branches</span></a>'
      . '<a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php"><span class="btn-text">Enroll Now</span></a>'
      . '</div>';
  } elseif ($variant === 'header-3') {
    echo '<div class="header-button d-xl-flex d-none">'
      . '<a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap" href="branches/"><span class="btn-text">Branches</span></a>'
      . '</div>'
      . '<div class="header-button d-lg-flex d-none">'
      . '<a class="tj-btn-primary style-2 style-2-sm flip-text-wrap" href="enroll-now.php"><span class="btn-icon"><i class="tji-arrow-right-2"></i></span><span class="btn-text">Enroll Now</span></a>'
      . '</div>';
  } elseif ($variant === 'header-4') {
    echo '<div class="header-button d-xl-flex d-none">'
      . '<a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap" href="branches/"><span class="btn-text">Branches</span></a>'
      . '</div>'
      . '<div class="header-button d-lg-flex d-none">'
      . '<a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php"><span class="btn-text">Enroll Now</span></a>'
      . '</div>';
  } else {
    echo '<div class="header-button d-xl-flex d-none">'
      . '<a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap" href="branches/"><span class="btn-text">Branches</span></a>'
      . '<a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php"><span class="btn-text">Enroll Now</span></a>'
      . '</div>';
  }
  echo '</div>';
}

function forsk_mobile_menu_button(): void {
  echo '<button class="menu_btn mobile_menu_bar d-lg-none" type="button" aria-label="Open menu">'
    . '<span class="bars"><span></span><span></span><span></span></span>'
    . '</button>';
}
?>

<?php if ($header_variant === 'header-2'): ?>
<header class="header-area header-2 header-absolute">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="<?= htmlspecialchars($header_logo, ENT_QUOTES, 'UTF-8') ?>" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(true); ?>
    <?php forsk_header_actions('header-2'); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>
<header class="header-area header-2 header-duplicate header-sticky">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="<?= htmlspecialchars($header_logo, ENT_QUOTES, 'UTF-8') ?>" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(); ?>
    <?php forsk_header_actions('header-2'); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>

<?php elseif ($header_variant === 'header-3'): ?>
<header class="header-area header-3 header-absolute">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="<?= htmlspecialchars($header_logo, ENT_QUOTES, 'UTF-8') ?>" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(true); ?>
    <?php forsk_header_actions('header-3'); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>
<header class="header-area header-3 header-duplicate header-sticky">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="<?= htmlspecialchars($header_logo, ENT_QUOTES, 'UTF-8') ?>" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(); ?>
    <?php forsk_header_actions('header-3'); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>

<?php elseif ($header_variant === 'header-4'): ?>
<header class="header-area header-4 header-absolute">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="<?= htmlspecialchars($header_logo, ENT_QUOTES, 'UTF-8') ?>" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(true); ?>
    <?php forsk_header_actions('header-4'); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>
<header class="header-area header-4 header-duplicate header-sticky">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="<?= htmlspecialchars($header_logo, ENT_QUOTES, 'UTF-8') ?>" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(); ?>
    <?php forsk_header_actions('header-4'); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>

<?php else: ?>
<header class="header-area header-1 header-fixed">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="<?= htmlspecialchars($header_logo, ENT_QUOTES, 'UTF-8') ?>" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(true); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>
<header class="header-area header-1 header-duplicate header-sticky">
  <div class="header-bottom"><div class="container-fluid"><div class="row"><div class="col-12"><div class="header-wrapper">
    <div class="site_logo"><a class="logo" href="./" aria-label="Forsk Coding School home"><img src="assets/images/logos/forsk-icon.png" alt="Forsk Coding School"></a></div>
    <?php forsk_header_navigation(); ?>
    <?php forsk_header_actions('header-1', true); ?>
    <?php forsk_mobile_menu_button(); ?>
  </div></div></div></div></div>
</header>
<?php endif; ?>

<?php require_once __DIR__ . '/floating-contact.php'; ?>
