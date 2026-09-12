<?php $header_variant = $header_variant ?? 'header-1'; ?>
<div class="body-overlay"></div>
<!-- Preloader disabled for local stability -->
<div class="preloader" style="display:none!important;"></div>
<div class="back-to-top-wrapper">
  <button id="back-to-top" type="button" class="back-to-top-btn">
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
            <a href="index.php" class="mobile_logo">
              <img src="assets/images/logos/forsk-icon.png" alt="Logo">
            </a>
          </div>
          <div class="hamburger_close">
            <button class="hamburger_close_btn">
              <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
                <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </button>
          </div>
        </div>
        <div class="hamburger-text d-none d-lg-block">
          <p>Developing personalize our customer journeys to increase satisfaction &amp; loyalty of our expansion
            recognized
            by industry leaders.</p>
        </div>
        <div class="hamburger-search-area">
          <h5 class="hamburger-title">Search now</h5>
          <div class="hamburger_search">
            <form method="get" action="index.php">
              <button type="submit"><i class="tji-search"></i></button>
              <input type="search" autocomplete="off" name="s" value="" placeholder="Search here...">
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
              <a class="contact-link" href="tel:+1(009)544-7818">+91 72319 68183</a>
            </div>
            <div class="contact-item">
              <span class="subtitle">Email:</span>
              <a class="contact-link" href="mailto:info@forskcodingschool.com">info@forskcodingschool.com</a>
            </div>
            <div class="contact-item">
              <span class="subtitle">Location:</span>
              <span class="contact-link">Jaipur, Rajasthan, India</span>
            </div>
          </div>
        </div>
      </div>
      <div class="hamburger-socials">
        <h5 class="hamburger-title">Follow us</h5>
        <div class="social-links">
          <ul class="tj-socials">
            <li>
              <a href="#" target="_blank"><i class="tji-facebook"></i></a>
            </li>
            <li>
              <a href="#" target="_blank"><i class="tji-instagram"></i></a>
            </li>
            <li>
              <a href="#" target="_blank"><i class="tji-x-twitter"></i></a>
            </li>
            <li>
              <a href="#" target="_blank"><i class="tji-linkedin"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Hamburger Menu -->
<?php if ($header_variant === 'header-2'): ?>
<!-- start: Header Area -->
  <header class="header-area header-2 header-absolute">
    <div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/logos/forsk-icon.png" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav id="mobile-menu" class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
              <div class="header-right-item d-inline-flex">
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                  <a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>
              </div>

              <!-- menu bar -->
              <button class="menu_btn mobile_menu_bar d-lg-none">
                <span class="bars">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Header Area -->

  <!-- start: Sticky Header Area -->
  <header class="header-area header-2 header-duplicate header-sticky">
    <div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/logos/forsk-icon.png" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
              <div class="header-right-item d-inline-flex">
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                  <a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>
              </div>

              <!-- menu bar -->
              <button class="menu_btn mobile_menu_bar d-lg-none">
                <span class="bars">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Sticky Header Area -->
<?php elseif ($header_variant === 'header-3'): ?>
<!-- start: Header Area -->
  <header class="header-area header-3 header-absolute">
    <div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/logos/forsk-icon.png" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav id="mobile-menu" class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
              <div class="header-right-item d-inline-flex align-items-center">
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                </div>
                <div class="header-button d-lg-flex d-none">
                  <a class="tj-btn-primary style-2 style-2-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>

                <!-- menu bar -->
                <button class="menu_btn mobile_menu_bar d-lg-none">
                  <span class="bars">
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Header Area -->

  <!-- start: Sticky Header Area -->
  <header class="header-area header-3 header-duplicate header-sticky">
    <div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/logos/forsk-icon.png" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
              <div class="header-right-item d-inline-flex align-items-center">
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                </div>
                <div class="header-button d-lg-flex d-none">
                  <a class="tj-btn-primary style-2 style-2-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>

                <!-- menu bar -->
                <button class="menu_btn mobile_menu_bar d-lg-none">
                  <span class="bars">
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Sticky Header Area -->
<?php elseif ($header_variant === 'header-4'): ?>
<!-- start: Header Area -->
  <header class="header-area header-4 header-absolute">
<div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/logos/forsk-icon.png" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav id="mobile-menu" class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
              <div class="header-right-item d-inline-flex align-items-center">
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                </div>
                <div class="header-button d-lg-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>

                <!-- menu bar -->
                <button class="menu_btn mobile_menu_bar d-lg-none">
                  <span class="bars">
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Header Area -->

  <!-- start: Sticky Header Area -->
  <header class="header-area header-4 header-duplicate header-sticky">
    <div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/logos/forsk-icon.png" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
              <div class="header-right-item d-inline-flex align-items-center">
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                </div>
                <div class="header-button d-lg-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>

                <!-- menu bar -->
                <button class="menu_btn mobile_menu_bar d-lg-none">
                  <span class="bars">
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Sticky Header Area -->
<?php else: ?>
<!-- start: Header Area -->
  <header class="header-area header-1 header-fixed">
<div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/forsk-coding-school-logo-transparent-black-text-horizontal.webp" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav id="mobile-menu" class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
               <!--
              <div class="header-right-item d-inline-flex">
                <div class="header-search-box d-lg-block d-none">
                  <form method="get" action="index.php">
                    <button type="submit"><i class="tji-search"></i></button>
                    <input type="search" autocomplete="off" name="s" placeholder="Search for here...">
                  </form>
                </div>
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                  <a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>
              </div>
-->
              <!-- menu bar -->
              <button class="menu_btn mobile_menu_bar d-lg-none">
                <span class="bars">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Header Area -->

  <!-- start: Sticky Header Area -->
  <header class="header-area header-1 header-duplicate header-sticky">
    <div class="header-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-wrapper">
              <!-- site logo -->
              <div class="site_logo">
                <a class="logo" href="./"><img src="assets/images/logos/forsk-icon.png" alt="Logo"></a>
              </div>

              <!-- navigation -->
              <div class="menu-area d-none d-lg-inline-flex align-items-center">
                <nav class="mainmenu">
<?php include __DIR__ . "/menu.php"; ?>
</nav>
              </div>

              <!-- header right info -->
              <div class="header-right-item d-inline-flex">
                <div class="header-search-box d-lg-block d-none">
                  <form method="get" action="index.php">
                    <button type="submit"><i class="tji-search"></i></button>
                    <input type="search" autocomplete="off" name="s" placeholder="Search for here...">
                  </form>
                </div>
                <div class="header-cart">
                  <a class="cart-btn" href="cart.php">
                    <i class="tji-cart-bag"></i>
                    <span class="cart-count">02</span>
                  </a>
                </div>
                <div class="header-user d-lg-none">
                  <a class="user-btn" href="login.php">
                    <i class="tji-user"></i>
                  </a>
                </div>
                <div class="header-button d-xl-flex d-none">
                  <a class="tj-btn-primary tj-btn-primary-border tj-btn-primary-border-sm flip-text-wrap"
                    href="branches/">
                    <span class="btn-text">Branches</span>
                  </a>
                  <a class="tj-btn-primary tj-btn-primary-sm flip-text-wrap" href="enroll-now.php">
                    <span class="btn-text">Enroll Now</span>
                  </a>
                </div>
              </div>

              <!-- menu bar -->
              <button class="menu_btn mobile_menu_bar d-lg-none">
                <span class="bars">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end: Sticky Header Area -->
<?php endif; ?>
