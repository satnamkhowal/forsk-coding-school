<?php
$coursePageTitle = trim((string)($page_title ?? 'Course Enquiry'));
$courseInterest = preg_replace('/\s*\|\s*Forsk Coding School.*$/i', '', $coursePageTitle) ?: $coursePageTitle;
$lead_channel = 'academic';
$lead_interest = $courseInterest;
$lead_options = [];
$lead_heading = 'Enquire About ' . $courseInterest;
$lead_submit_label = 'Request Course Counselling';
?>
<section class="tj-contact-section section-gap section-separator forsk-course-enquiry-section" aria-label="Course enquiry">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <?php include __DIR__ . '/lead-form.php'; ?>
      </div>
    </div>
  </div>
</section>
