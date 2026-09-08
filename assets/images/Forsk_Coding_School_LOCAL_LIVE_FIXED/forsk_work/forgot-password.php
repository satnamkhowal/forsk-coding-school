<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php
$page_title='Forsk Coding School - Forsk Coding School';
$page_description='Education LMS and Online course template';
$page_canonical='';
$page_schema='{"@context": "https://schema.org", "@type": "WebPage", "name": "Forsk Coding School - Forsk Coding School", "description": "Education LMS and Online course template", "url": "https://forskcodingschool.com/forgot-password.php"}';
$page_robots='noindex, nofollow'; $header_variant='header-1';
?>
<?php include __DIR__.'/includes/head.php'; ?>
</head>
<body>
<?php include __DIR__.'/includes/header.php'; ?>
<div id="smooth-wrapper">
    <div id="smooth-content">
      <main id="primary" class="site-main">

        <div class="space-for-header"></div>
        <!-- start: Page Header Section -->
        <section class="tj-page-header">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="tj-page-header-content">
                  <h1 class="tj-page-title">Forgot password</h1>
                  <div class="tj-page-link">
                    <span><i class="tji-home"></i></span>
                    <span>
                      <a href="index.php">Home</a>
                    </span>
                    <span><i class="tji-arrow-right-4"></i></span>
                    <span>
                      <span>Forgot password</span>
                    </span>
                  </div>
                  <div class="shape"><img src="assets/images/shapes/stars.png" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Page Header Section -->

        <!-- start: Login Section -->
        <section class="tj-login-section section-gap-bottom fix">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="tj-login-form-wrapper tj-fade-anim">
                  <div class="login-form-header">
                    <div class="icon"><i class="tji-lock"></i></div>
                    <h2 class="form-title">Forgot password</h2>
                    <p class="desc">No worries — enter your email and we'll send you a reset link.</p>
                  </div>

                  <form class="tj-login-form" action="forgot-password.php#" method="post">
                    <div class="form-input">
                      <label class="cf-label" for="login-email">Email</label>
                      <div class="input-icon-wrap">
                        <span class="input-icon"><i class="tji-envelope"></i></span>
                        <input type="email" id="login-email" name="email" placeholder="you@example.com" required>
                      </div>
                    </div>
                    <div class="form-submit">
                      <button class="tj-btn-primary flip-text-wrap" type="submit">
                        <span class="btn-text">Send reset link</span>
                        <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                      </button>
                    </div>
                    <div class="back-btn-wrap">
                      <a class="tj-back-btn" href="login.php">
                        <span class="btn-icon"><i class="tji-arrow-left-4"></i></span>
                        <span class="btn-text">Back to login</span>
                      </a>
                    </div>
                  </form>

                  <div class="verification-info">
                    <i class="tji-info"></i>
                    <p class="desc">The link expires in 30 minutes. Check your spam folder if it doesn't arrive within a
                      couple of minutes.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Login Section -->

      </main>

      <?php include __DIR__.'/includes/footer.php'; ?>
<!-- start: Product details modal Area -->
      <div id="tj-product-modal-1" style="display: none;">
        <div class="single-product woosq-product container">
          <div class="product row ">
            <div class="col-12 col-md-6 thumbnails">
              <div class="images tj-quick-details-slider swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="thumbnail"><img src="assets/images/product/product-1.webp"
                        class="attachment-woosq size-woosq" alt=""></div>
                  </div>
                  <div class="swiper-slide">
                    <div class="thumbnail"><img src="assets/images/product/product-2.webp"
                        class="attachment-woosq size-woosq" alt=""></div>
                  </div>
                  <div class="swiper-slide">
                    <div class="thumbnail"><img src="assets/images/product/product-3.webp"
                        class="attachment-woosq size-woosq" alt=""></div>
                  </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
            <div class="col-12 col-md-6 summary entry-summary">

              <div class="summary-content ps-container ps-theme-wpc">
                <div class="product-stock">
                  <span class="stock in-stock">10 in stock</span>
                </div>
                <h3 class="tj-product-details-title">Personal holding earbud</h3>
                <p class="price">
                  <del><span class="price-amount amount"><span>$</span>240.00</span></del>
                  <span class="price-amount amount"><span>$</span>200.00</span>
                </p>
                <div class="product-details__short-description">
                  <p>Experience true wireless freedom with our latest earbuds, designed to deliver
                    crystal-clear sound and deep bass in compact, lightweight package.</p>
                </div>
                <div class="tj-product-details-action-wrapper">
                  <form class="cart">
                    <div class="tj-product-details-action-item-wrapper d-flex align-items-center">
                      <div class="tj-product-details-quantity">
                        <div class="tj-product-quantity">
                          <div class="quantity">

                            <span class="qty_button minus tj-cart-minus">
                              -
                            </span>
                            <input type="text" id="quantity_6862037ea99bb"
                              class="input-text tj-cart-input qty tj-cart-input text" name="quantity" value="1">
                            <span class="qty_button plus tj-cart-plus ">
                              +
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="tj-product-details-add-to-cart">
                        <button type="submit" name="add-to-cart" value="5403"
                          class="single_add_to_cart_button tj-cart-btn ">
                          <span class="btn-icon"><i class="fal fa-shopping-cart"></i><i
                              class="fal fa-shopping-cart"></i></span>
                          <span class="btn-text"><span>Add to cart</span></span>
                        </button>
                      </div>
                      <div class="tj-product-details-wishlist">
                        <button class="woosw-btn ">Add to wishlist</button>
                      </div>
                    </div>

                  </form>
                </div>
                <div class="tj-product-details-query-item d-flex align-items-center">
                  <span>SKU:</span>
                  <p>SV-18</p>
                </div>
                <div class="tj-product-details-query-item d-flex align-items-center">
                  <span>Category: </span> <a href="forgot-password.php#">Power</a>
                </div>
                <div class="tj-product-details-query-item d-flex align-items-center">
                  <span>Tag:</span> <a href="forgot-password.php#">Portable</a>
                </div>
                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                  <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;">
                  <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- end: Product details modal Area -->
</div>
</div>
</body>
</html>
