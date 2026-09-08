<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <?php
  $page_title = 'Contact Forsk Coding School | Jaipur Admissions & Enquiry';
  $page_description = 'Contact Forsk Coding School for admissions, course guidance, internships, corporate training and career support in Jaipur.';
  $page_canonical = 'https://forskcodingschool.com/contact-us.php';
  $page_schema = '{"@context":"https://schema.org","@type":"WebPage","name":"Contact Forsk Coding School Jaipur | Enquire About Courses","description":"Contact Forsk Coding School in Jaipur for course admissions, career guidance, corporate training, internships and technology programs.","url":"https://forskcodingschool.com/contact.php"}';
  $header_variant = 'header-1';
  ?>
  <?php include __DIR__ . '/includes/head.php'; ?>
</head>

<body>
  <?php include __DIR__ . '/includes/header.php'; ?>
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
                  <h1 class="tj-page-title">Contact us</h1>
                  <div class="tj-page-link">
                    <span><i class="tji-home"></i></span>
                    <span>
                      <a href="index.php">Home</a>
                    </span>
                    <span><i class="tji-arrow-right-4"></i></span>
                    <span>
                      <span>Contact us</span>
                    </span>
                  </div>
                  <div class="shape"><img src="assets/images/shapes/stars.png" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Page Header Section -->

        <!-- start: Contact Section -->
        <section class="tj-contact-section section-gap-bottom">
          <div class="container">
            <div class="row rg-30 flex-lg-row flex-column-reverse">
              <div class="col-lg-7">
                <div class="contact-form tj-fade-anim">
                  <div class="form-title-wrap">
                    <h3 class="form-title">Send us a message.</h3>
                    <p class="desc">Start learning free — no credit card required.</p>
                  </div>
                  <form action="mail.php" method="POST" id="contact-form">
                    <div class="row">

                      <div class="col-sm-6">
                        <div class="form-input">
                          <label class="cf-label">Full name</label>
                          <input type="text" name="your-name" placeholder="Enter name" required />
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-input">
                          <label class="cf-label">Email address</label>
                          <input type="email" name="your-email" placeholder="Enter email" required />
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-input">
                          <label class="cf-label">Mobile Number</label>
                          <input type="tel" name="phone" placeholder="Enter mobile number" maxlength="10"
                            pattern="[0-9]{10}" inputmode="numeric" required />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-input">
                          <label class="cf-label">Subject</label>
                          <div class="tj-select">
                            <input type="text" name="your-subject" list="course-list"
                              placeholder="Search or select course" autocomplete="off" required />

                            <datalist id="course-list">
                              <option value="Python Programming">
                              <option value="Java Programming">
                              <option value="C Programming">
                              <option value="C++ Programming">
                              <option value="JavaScript">
                              <option value="PHP">
                              <option value="C#">

                              <option value="Full Stack Development">
                              <option value="MERN Stack">
                              <option value="MEAN Stack">
                              <option value="Java Full Stack">
                              <option value="Python Full Stack">
                              <option value="ASP.NET Full Stack">
                              <option value="React.js">
                              <option value="Angular">
                              <option value="Node.js">
                              <option value="Next.js">

                              <option value="Data Science">
                              <option value="Data Analytics">
                              <option value="Business Analytics">
                              <option value="Machine Learning">
                              <option value="Artificial Intelligence">
                              <option value="Generative AI">
                              <option value="Power BI">

                              <option value="AWS">
                              <option value="Microsoft Azure">
                              <option value="Google Cloud">
                              <option value="DevOps">
                              <option value="Docker">
                              <option value="Kubernetes">

                              <option value="Cyber Security">
                              <option value="Ethical Hacking">
                              <option value="CEH">
                              <option value="SOC Analyst">
                              <option value="Penetration Testing">
                              <option value="Network Security">

                              <option value="Manual Testing">
                              <option value="Automation Testing">
                              <option value="Selenium">
                              <option value="API Testing">
                              <option value="Playwright">

                              <option value="Digital Marketing">
                              <option value="SEO">
                              <option value="Google Ads">
                              <option value="Social Media Marketing">
                              <option value="Content Marketing">
                              <option value="Email Marketing">

                              <option value="UI / UX Designing">
                              <option value="Figma">
                              <option value="Graphic Design">

                              <option value="Android">
                              <option value="Kotlin">
                              <option value="Flutter">
                              <option value="React Native">
                              <option value="iOS App Development">

                              <option value="CCNA">
                              <option value="CCNP">
                              <option value="Linux">
                              <option value="Windows Server">

                              <option value="Advanced Excel">
                              <option value="SQL">
                              <option value="Personality Development">
                              <option value="AI Productivity Tools">

                              <option value="Diploma Programs">
                              <option value="Internship Programs">
                              <option value="Industrial Training">
                              <option value="Corporate Training">
                              <option value="Placement Assistance">
                              <option value="Other Enquiry">
                            </datalist>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-input message-input">
                          <label class="cf-label">Message</label>
                          <textarea name="message" placeholder="Tell us how we can help..."></textarea>
                        </div>
                      </div>

                      <div class="form-submit">
                        <button class="tj-btn-primary flip-text-wrap" type="submit">
                          <span class="btn-text">Send message</span>
                          <span class="btn-icon">
                            <i class="tji-arrow-right-2"></i>
                          </span>
                        </button>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="tj-contact-area">
                  <div class="sec-heading">
                    <span class="sec-subtitle tj-fade-anim" data-direction="top"><i class="tji-subtitle"></i> Get in
                      touch</span>
                    <h2 class="sec-title tj-fade-anim">Get in Touch.</h2>
                    <p class="desc tj-fade-anim" data-delay=".3">Pick whichever channel suits you — we're quick on all
                      of them. Master modern digital
                      and tech skills through.</p>
                  </div>
                  <div class="contact-item-wrap">
                    <div class="contact-item style-2 tj-fade-anim" data-delay="0.3">
                      <div class="contact-icon">
                        <i class="tji-envelope"></i>
                      </div>
                      <div class="contact-content">
                        <h3 class="contact-title">Email us</h3>
                        <p>For anything, anytime</p>
                        <a class="contact-link" href="mailto:info@forskcodingschool.com">info@forskcodingschool.com</a>
                      </div>
                    </div>
                    <div class="contact-item style-2 tj-fade-anim" data-delay="0.5">
                      <div class="contact-icon">
                        <i class="tji-phone-call"></i>
                      </div>
                      <div class="contact-content">
                        <h3 class="contact-title">Call us</h3>
                        <p>Mon-Fri, 9am-6pm CT.</p>
                        <a class="contact-link" href="+917231968183">+91 72319 68183</a>
                      </div>
                    </div>
                    <div class="contact-item style-2 tj-fade-anim" data-delay="0.1">
                      <div class="contact-icon">
                        <i class="tji-location"></i>
                      </div>
                      <div class="contact-content">
                        <h3 class="contact-title">Visit us</h3>
                        <p>Jaipur, Rajasthan, India</p>
                        <a class="tj-text-btn flip-text-wrap" target="_blank" href="#">
                          <span class="btn-text">Get directions</span>
                          <span class="btn-icon"><i class="tji-arrow-right-2"></i></span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="map-area">
                  <div class="map">
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d34245.64001997674!2d-73.85739292030802!3d40.653793634481424!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1785402593015!5m2!1sen!2sbd"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Contact Section -->
      </main>

      <?php include __DIR__ . '/includes/footer.php'; ?>
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
                  <span>Category: </span> <a href="contact.php#">Power</a>
                </div>
                <div class="tj-product-details-query-item d-flex align-items-center">
                  <span>Tag:</span> <a href="contact.php#">Portable</a>
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