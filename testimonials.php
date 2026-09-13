<?php
$page_title = 'Student Learning Experience | Forsk Coding School Jaipur';
$page_description = 'Understand the learning experience at Forsk Coding School Jaipur, including practical assignments, projects, mentor support and career-focused guidance.';
$page_keywords = 'Forsk Coding School student experience, coding school Jaipur, IT training Jaipur, practical coding courses Jaipur';
$page_canonical = 'testimonials.php';
$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $page_title,
    'description' => $page_description,
    'url' => 'https://forskcodingschool.com/testimonials.php',
    'about' => [
        '@type' => 'EducationalOrganization',
        'name' => 'Forsk Coding School',
        'url' => 'https://forskcodingschool.com/'
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$header_variant = 'header-1';
?>
<!DOCTYPE html>
<html lang="en">
<head><?php include __DIR__ . '/includes/head.php'; ?></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<div id="smooth-wrapper"><div id="smooth-content">
<main class="site-main">
    <div class="space-for-header"></div>
    <section class="tj-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title">Student Learning Experience</h1>
                <div class="breadcrumb-list"><span><a href="index.php">Home</a></span><span>Student Learning Experience</span></div>
            </div>
        </div>
    </section>

    <section class="section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="tj-course-details-content">
                        <h2>What learners can expect at Forsk Coding School</h2>
                        <p>Forsk Coding School focuses on practical, career-oriented learning in Jaipur. Course delivery combines structured concepts with hands-on assignments, project work, mentor support and guidance designed to help learners apply what they study.</p>

                        <h3>Practical learning, not only theory</h3>
                        <p>Learning is reinforced through exercises and project-based practice so students can move from understanding a concept to implementing it. The exact tools, projects and depth vary by course, so learners should review the relevant course page before enrolling.</p>

                        <h3>Support throughout the learning journey</h3>
                        <p>Students can use mentor guidance to clarify concepts, improve project work and identify areas that need more practice. Career-focused courses may also include preparation guidance such as portfolio, resume or interview readiness where relevant to the program.</p>

                        <h3>Transparent student feedback policy</h3>
                        <p>We do not publish fabricated testimonials, anonymous success claims or guaranteed placement outcomes. Named testimonials and detailed success stories should be published only when the learner identity, permission and context can be verified.</p>

                        <h3>How to evaluate the right course for you</h3>
                        <p>Before enrolling, compare the curriculum, prerequisites, learning mode and expected outcomes of the course you are considering. If you are unsure which path fits your current skills or career goal, use the enquiry form to request course guidance.</p>

                        <div class="d-flex flex-wrap gap-3 mt-4">
                            <a class="tj-btn-primary" href="courses.php"><span class="btn-text">Explore Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                            <a class="tj-btn-primary" href="enquiry.php"><span class="btn-text">Request Course Guidance</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
