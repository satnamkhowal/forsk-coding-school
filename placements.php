<?php
require_once __DIR__ . '/config.php';

$page_title = 'Placement Assistance & Career Support | Forsk Coding School Jaipur';
$page_description = 'Understand placement assistance, resume preparation, interview practice, project guidance and job-readiness support available to eligible Forsk Coding School learners in Jaipur.';
$page_keywords = 'placement assistance Jaipur, career support Jaipur, interview preparation Jaipur, Forsk Coding School placements';
$page_canonical = site_url('placements.php');
$header_variant = 'header-1';

$page_schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $page_title,
    'description' => $page_description,
    'url' => $page_canonical,
    'about' => [
        '@type' => 'EducationalOrganization',
        'name' => 'Forsk Coding School',
        'url' => site_url('')
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
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
                <h1 class="breadcrumb-title">Placement Assistance & Career Support</h1>
                <div class="breadcrumb-list"><span><a href="index.php">Home</a></span><span>Career Support</span></div>
            </div>
        </div>
    </section>

    <section class="section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="tj-course-details-content">
                        <h2>Career preparation built around practical skills</h2>
                        <p>Forsk Coding School combines technical training with career-readiness support so learners can present their skills more clearly when they begin applying for internships or entry-level roles. Support is designed to complement the learner's course, project work and current skill level.</p>
                        <p>Career support is assistance, not a job guarantee. Hiring decisions are made independently by employers, and outcomes depend on factors such as skills, portfolio quality, interview performance, eligibility, market conditions and available openings.</p>

                        <h2>What placement assistance can include</h2>
                        <ul>
                            <li><strong>Resume review:</strong> guidance on presenting technical skills, education, projects and internship experience clearly.</li>
                            <li><strong>Project and portfolio guidance:</strong> help selecting and explaining practical work that demonstrates relevant skills.</li>
                            <li><strong>Interview preparation:</strong> practice with technical questions, project discussions and common HR-style interview questions.</li>
                            <li><strong>Job-readiness planning:</strong> identifying skill gaps and prioritising topics to revise before applications and interviews.</li>
                            <li><strong>Application guidance:</strong> practical suggestions for searching suitable internships and entry-level opportunities.</li>
                        </ul>

                        <h2>How the process works</h2>
                        <ol>
                            <li>Complete the core learning and practical work expected in your selected course.</li>
                            <li>Organise your projects, GitHub or portfolio links where relevant.</li>
                            <li>Review your resume and improve how your skills and projects are described.</li>
                            <li>Prepare for technical and behavioural interviews with focused practice.</li>
                            <li>Apply to relevant opportunities and continue improving based on interview feedback and market requirements.</li>
                        </ol>

                        <h2>Who should use career support?</h2>
                        <p>Career support is most useful for students, graduates, career switchers and working professionals who have completed enough practical coursework to discuss their skills confidently. The exact preparation path may differ by domain—for example, a data analytics learner may need a project portfolio and dashboard examples, while a full-stack learner may need deployable web projects and source-code repositories.</p>

                        <h2>Choose training aligned with your target role</h2>
                        <p>Strong placement preparation starts with the right learning path. Explore current programs in software development, data analytics, data science, AI/ML, cloud, cybersecurity, digital marketing and other technology domains before deciding what role you want to target.</p>

                        <div class="mt-4 d-flex flex-wrap gap-3">
                            <a class="tj-btn-primary" href="courses.php"><span class="btn-text">Explore Courses</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                            <a class="tj-btn-primary" href="contact.php"><span class="btn-text">Talk to a Counsellor</span><span class="btn-icon"><i class="tji-arrow-right-2"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="forsk-internal-links" class="section-space">
        <div class="container">
            <div class="sec-heading text-center mb-4"><span class="sec-subtitle"><i class="tji-subtitle"></i>Explore Forsk</span><h2>Continue Your Career Preparation</h2></div>
            <div class="row justify-content-center">
                <div class="col-md-4 col-6 mb-3"><a href="courses.php" class="tj-btn-primary tj-btn-primary-sm w-100 justify-content-center"><span class="btn-text">Courses</span></a></div>
                <div class="col-md-4 col-6 mb-3"><a href="final-year-projects-jaipur.php" class="tj-btn-primary tj-btn-primary-sm w-100 justify-content-center"><span class="btn-text">Final Year Projects</span></a></div>
                <div class="col-md-4 col-6 mb-3"><a href="internship-programs-jaipur.php" class="tj-btn-primary tj-btn-primary-sm w-100 justify-content-center"><span class="btn-text">Internships</span></a></div>
                <div class="col-md-4 col-6 mb-3"><a href="career-guides.php" class="tj-btn-primary tj-btn-primary-sm w-100 justify-content-center"><span class="btn-text">Career Guides</span></a></div>
                <div class="col-md-4 col-6 mb-3"><a href="contact.php" class="tj-btn-primary tj-btn-primary-sm w-100 justify-content-center"><span class="btn-text">Contact</span></a></div>
            </div>
        </div>
    </section>
</main>
</div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
