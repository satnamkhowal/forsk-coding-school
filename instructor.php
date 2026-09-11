<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php
$page_title='Forsk Coding School - Forsk Coding School';
$page_description='Education LMS and Online course template';
$page_canonical='';
$page_schema='{"@context": "https://schema.org", "@type": "WebPage", "name": "Forsk Coding School - Forsk Coding School", "description": "Education LMS and Online course template", "url": "https://forskcodingschool.com/instructor.php"}';
$header_variant='header-1';
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
                  <h1 class="tj-page-title">Expert Instructor</h1>
                  <div class="tj-page-link">
                    <span><i class="tji-home"></i></span>
                    <span>
                      <a href="index.php">Home</a>
                    </span>
                    <span><i class="tji-arrow-right-4"></i></span>
                    <span>
                      <span>Instructor</span>
                    </span>
                  </div>
                  <div class="shape"><img src="assets/images/shapes/stars.png" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Page Header Section -->

        <!-- start: Course Section -->
        <section class="tj-course-section section-gap-bottom fix">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="tj-course-filter-wrap">
                  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="tj-show-results">
                      <span class="course-show">Showing <strong>1-6</strong> of <strong>300</strong> instructor</span>
                    </div>
                    <div class="tj-course-view-wrap">
                      <div class="tj-course-ordering">
                        <div class="select-label">Sort by</div>
                        <div class="tj-select">
                          <select>
                            <option>Top rated</option>
                            <option>Newest</option>
                            <option>Highest Rated</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row flex-lg-row flex-column-reverse">
              <div class="col-xl-3 col-lg-4">
                <div class="tj-filter-sidebar">
                  <div class="filter-sidebar-top">
                    <div class="filter-title">
                      <span><i class="tji-filter"></i></span>Filter
                    </div>
                    <div class="filter-reset">
                      <button class="tj-reset"><i class="tji-reset"></i>Reset filters</button>
                    </div>
                  </div>
                  <div class="tj-filter-widget tj-filter-widget-search">
                    <div class="search-box">
                      <form action="instructor.php#">
                        <input type="search" name="search" placeholder="Search filter...">
                        <button type="submit" value="search"><i class="tji-search"></i></button>
                      </form>
                    </div>
                  </div>
                  <div class="tj-filter-widget tj-filter-widget-categories">
                    <h3 class="filter-widget-title">Expertise</h3>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="category" checked>
                        <span>Design</span>
                      </label>
                      <span class="count">62</span>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="category">
                        <span>Development</span>
                      </label>
                      <span class="count">48</span>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="category">
                        <span>AI & Machine learning</span>
                      </label>
                      <span class="count">34</span>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="category">
                        <span>Marketing</span>
                      </label>
                      <span class="count">29</span>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="category">
                        <span>Business</span>
                      </label>
                      <span class="count">25</span>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="category">
                        <span>Data science</span>
                      </label>
                      <span class="count">21</span>
                    </div>
                  </div>
                  <div class="tj-filter-widget tj-filter-widget-price">
                    <h3 class="filter-widget-title">Rate per hour</h3>
                    <div class="price-label">
                      <span class="from">$<span id="price-from">0</span></span> &mdash;
                      <span class="to">$<span id="price-to">135</span></span>
                    </div>
                    <form>
                      <div class="price-slider-wrapper">
                        <div class="price-slider" id="slider-range"></div>
                        <div class="price-slider-amount">
                          <span>Free</span>
                          <span>$135+</span>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tj-filter-widget tj-filter-widget-rating">
                    <h3 class="filter-widget-title">Rating</h3>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="rating" checked>
                        <div class="tj-rating-wrapper rating" content="5" role="img" aria-label="Rated 5 out of 5">
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked" style="--r-rating-icon-marked-width: 100%;">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <span class="label">4.5 & up</span>
                        </div>
                      </label>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="rating">
                        <div class="tj-rating-wrapper rating" content="4" role="img" aria-label="Rated 4 out of 5">
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked" style="--r-rating-icon-marked-width: 0%;">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <span class="label">4.0 & up</span>
                        </div>
                      </label>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="rating">
                        <div class="tj-rating-wrapper rating" content="3.5" role="img" aria-label="Rated 3.5 out of 5">
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked" style="--r-rating-icon-marked-width: 50%;">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked" style="--r-rating-icon-marked-width: 0%;">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <span class="label">3.5 & up</span>
                        </div>
                      </label>
                    </div>
                    <div class="filter-check-item">
                      <label>
                        <input type="checkbox" name="rating">
                        <div class="tj-rating-wrapper rating" content="3" role="img" aria-label="Rated 3 out of 5">
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked" style="--r-rating-icon-marked-width: 0%;">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <div class="r-icon">
                            <div class="r-icon-wrapper r-icon-marked" style="--r-rating-icon-marked-width: 0%;">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                            <div class="r-icon-wrapper r-icon-unmarked">
                              <i aria-hidden="true" class="tji-star"></i>
                            </div>
                          </div>
                          <span class="label">3.0 & up</span>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="tj-filter-btn-area">
                    <button class="tj-btn-primary tj-btn-full flip-text-wrap">
                      <span class="btn-text">Apply</span>
                    </button>
                    <button class="tj-btn-primary tj-btn-primary-border flip-text-wrap">
                      <span class="btn-text">Reset</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-xl-9 col-lg-8">
                <div class="course-active-filters-wrap">
                  <div class="course-active-filters">
                    <span>Active:</span>
                    <span class="filter-active">Design<span class="close"><i class="tji-close"></i></span></span>
                    <span class="filter-active">Development<span class="close"><i class="tji-close"></i></span></span>
                    <span class="filter-active">4.5 & up<span class="close"><i class="tji-close"></i></span></span>
                    <span class="filter-active">Discounted<span class="close"><i class="tji-close"></i></span></span>
                  </div>
                </div>
                <div class="row rg-30">
                  <div class="col-xl-4 col-sm-6">
                    <div class="tj-instructor-item tj-instructor-item-2">
                      <div class="tj-instructor-img">
                        <a href="instructor-details.php">
                          
                        
                        <img src="assets/images/instructor/instructor-4.webp"

                        
                            alt="Instructor"></a>
                        <div class="single-rating">
                          <i class="tji-star"></i>
                          <span class="label">4.9</span>
                        </div>
                      </div>
                      <div class="tj-instructor-content">
                        <div class="name-area">
                          <h3 class="name tj-fs-h5"><a href="instructor-details.php">Devoin Lanee</a></h3>
                          <span class="designation">Chief design director</span>
                        </div>
                        <div class="tj-instructor-info">
                          <div class="course-meta">
                            <span><i class="tji-book"></i>200 sessions</span>
                          </div>
                          <div class="course-price tj-fs-h5">$20/h</div>
                        </div>
                        <div class="btn-area">
                          <a class="tj-btn-primary-2 tj-btn-primary-3 tj-btn-full" href="instructor-details.php">
                            <span class="btn-inner">
                              <span class="btn-text"><span>Book session</span></span>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-sm-6">
                    <div class="tj-instructor-item tj-instructor-item-2">
                      <div class="tj-instructor-img">
                        <a href="instructor-details.php"><img src="assets/images/instructor/instructor-5.webp"
                            alt="Instructor"></a>
                        <div class="single-rating">
                          <i class="tji-star"></i>
                          <span class="label">4.9</span>
                        </div>
                      </div>
                      <div class="tj-instructor-content">
                        <div class="name-area">
                          <h3 class="name tj-fs-h5"><a href="instructor-details.php">Dianne Russell</a></h3>
                          <span class="designation">Chief design director</span>
                        </div>
                        <div class="tj-instructor-info">
                          <div class="course-meta">
                            <span><i class="tji-book"></i>210 sessions</span>
                          </div>
                          <div class="course-price tj-fs-h5">$18/h</div>
                        </div>
                        <div class="btn-area">
                          <a class="tj-btn-primary-2 tj-btn-primary-3 tj-btn-full" href="instructor-details.php">
                            <span class="btn-inner">
                              <span class="btn-text"><span>Book session</span></span>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-sm-6">
                    <div class="tj-instructor-item tj-instructor-item-2">
                      <div class="tj-instructor-img">
                        <a href="instructor-details.php"><img src="assets/images/instructor/instructor-7.webp"
                            alt="Instructor"></a>
                        <div class="single-rating">
                          <i class="tji-star"></i>
                          <span class="label">4.9</span>
                        </div>
                      </div>
                      <div class="tj-instructor-content">
                        <div class="name-area">
                          <h3 class="name tj-fs-h5"><a href="instructor-details.php">Darrell Steward</a></h3>
                          <span class="designation">Chief design director</span>
                        </div>
                        <div class="tj-instructor-info">
                          <div class="course-meta">
                            <span><i class="tji-book"></i>170 sessions</span>
                          </div>
                          <div class="course-price tj-fs-h5">$15/h</div>
                        </div>
                        <div class="btn-area">
                          <a class="tj-btn-primary-2 tj-btn-primary-3 tj-btn-full" href="instructor-details.php">
                            <span class="btn-inner">
                              <span class="btn-text"><span>Book session</span></span>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-sm-6">
                    <div class="tj-instructor-item tj-instructor-item-2">
                      <div class="tj-instructor-img">
                        <a href="instructor-details.php"><img src="assets/images/instructor/instructor-6.webp"
                            alt="Instructor"></a>
                        <div class="single-rating">
                          <i class="tji-star"></i>
                          <span class="label">4.9</span>
                        </div>
                      </div>
                      <div class="tj-instructor-content">
                        <div class="name-area">
                          <h3 class="name tj-fs-h5"><a href="instructor-details.php">Marvin McKinney</a></h3>
                          <span class="designation">Chief design director</span>
                        </div>
                        <div class="tj-instructor-info">
                          <div class="course-meta">
                            <span><i class="tji-book"></i>180 sessions</span>
                          </div>
                          <div class="course-price tj-fs-h5">$25/h</div>
                        </div>
                        <div class="btn-area">
                          <a class="tj-btn-primary-2 tj-btn-primary-3 tj-btn-full" href="instructor-details.php">
                            <span class="btn-inner">
                              <span class="btn-text"><span>Book session</span></span>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-sm-6">
                    <div class="tj-instructor-item tj-instructor-item-2">
                      <div class="tj-instructor-img">
                        <a href="instructor-details.php"><img src="assets/images/instructor/instructor-9.webp"
                            alt="Instructor"></a>
                        <div class="single-rating">
                          <i class="tji-star"></i>
                          <span class="label">4.9</span>
                        </div>
                      </div>
                      <div class="tj-instructor-content">
                        <div class="name-area">
                          <h3 class="name tj-fs-h5"><a href="instructor-details.php">Edward Collins</a></h3>
                          <span class="designation">Chief design director</span>
                        </div>
                        <div class="tj-instructor-info">
                          <div class="course-meta">
                            <span><i class="tji-book"></i>180 sessions</span>
                          </div>
                          <div class="course-price tj-fs-h5">$25/h</div>
                        </div>
                        <div class="btn-area">
                          <a class="tj-btn-primary-2 tj-btn-primary-3 tj-btn-full" href="instructor-details.php">
                            <span class="btn-inner">
                              <span class="btn-text"><span>Book session</span></span>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-sm-6">
                    <div class="tj-instructor-item tj-instructor-item-2">
                      <div class="tj-instructor-img">
                        <a href="instructor-details.php"><img src="assets/images/instructor/instructor-10.webp"
                            alt="Instructor"></a>
                        <div class="single-rating">
                          <i class="tji-star"></i>
                          <span class="label">4.9</span>
                        </div>
                      </div>
                      <div class="tj-instructor-content">
                        <div class="name-area">
                          <h3 class="name tj-fs-h5"><a href="instructor-details.php">Carrol John</a></h3>
                          <span class="designation">Chief design director</span>
                        </div>
                        <div class="tj-instructor-info">
                          <div class="course-meta">
                            <span><i class="tji-book"></i>170 sessions</span>
                          </div>
                          <div class="course-price tj-fs-h5">$15/h</div>
                        </div>
                        <div class="btn-area">
                          <a class="tj-btn-primary-2 tj-btn-primary-3 tj-btn-full" href="instructor-details.php">
                            <span class="btn-inner">
                              <span class="btn-text"><span>Book session</span></span>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div
                      class="course-pagination-area d-flex flex-wrap align-items-center justify-content-between tj-fade-anim gap-3">
                      <div class="tj-show-results">
                        <span class="course-show">Showing <strong>1-6</strong> of <strong>300</strong> instructor</span>
                      </div>
                      <div class="tj-pagination">
                        <span aria-current="page" class="page-numbers current">1</span>
                        <a class="page-numbers" href="instructor.php#">2</a>
                        <a class="page-numbers" href="instructor.php#">3</a>
                        <a class="next page-numbers" href="instructor.php#"><i class="tji-arrow-right-3"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end: Course Section -->
      </main>

      <?php include __DIR__.'/includes/footer.php'; ?>
</div>
</div>
</body>
</html>
