# Forsk Coding School — Phase 1 SEO & Technical Audit

**Audit date:** 21 September 2026  
**Scope:** repository baseline, indexation configuration, primary navigation, course templates, sitemap and robots controls.  
**Important:** This audit does not delete URLs, alter redirects, or change course content. Search Console, GA4 and live-host access are still required for ranking, coverage and Core Web Vitals evidence.

## Safe baseline

- Repository/default branch: `main`
- Canonical public domain: `https://forskcodingschool.com`
- Canonical Jaipur identity in `config.php`: Shyam Nagar, Jaipur.
- Public crawl policy exists in `robots.txt`; private/transactional paths are disallowed.
- Master `sitemap.xml` references page, blog, image, branch, news, local-resource and college sitemaps.
- Existing generated-content controls intentionally retain 10,000 generated blog URLs while holding 9,500 as `noindex, follow`. Preserve this policy unless each page is materially enriched and reviewed.

## Findings

| Priority | Issue | Affected URL / file | SEO impact | Exact recommended fix | Developer action |
|---|---|---|---|---|---|
| P0 | Course-topic drift in a priority money page | `python-programming-course-jaipur.php` | The Python page's curriculum includes data cleaning, SQL, analytics, ML concepts and dashboards. This weakens topical relevance for “Python Programming Course in Jaipur” and can reduce trust. | Replace generic/cross-topic modules with verified Python fundamentals, OOP, files, error handling, packages, APIs, testing and course-specific projects. Keep Data Science topics on their own course pages. | Yes + content approval |
| P0 | Unverified public claims need evidence review | `python-programming-course-jaipur.php` | The visible “4.9 (3K+)” rating, 40 lessons, 40+ hours, blended mode and mentor representation need documentary support. Unsupported claims can harm trust and conversion. | Verify every claim against business records. Remove or qualify any unsupported metric; use only genuine, displayed reviews. Add a real mentor name/photo only after approval. | Content owner + developer |
| P0 | Legacy redirect behaviour cannot be verified from the repository | Live hosting / legacy WordPress and location URLs | Old indexed location routes may lose equity or be intercepted by a WordPress catch-all if 301/canonical behaviour is wrong. | Export a legacy URL map from Search Console and hosting; test each old course/location URL for one-hop 301 to its approved equivalent, otherwise keep the page live with a self-canonical. Do not delete pages before this test. | Hosting developer |
| P1 | Full desktop navigation is emitted twice by the sticky-header implementation | `includes/header.php`, `includes/menu.php` | The full course menu appears in both initial and sticky header markup. It is not safe to remove blindly because it powers sticky navigation, but it creates excessive repeated links/text in the DOM. | Verify keyboard, screen-reader and mobile behaviour; then replace the duplicate static navigation with a safe client-side clone or a single navigation pattern. Re-test menus before deployment. | Yes |
| P1 | Course templates require factual, course-specific QA before scale expansion | Priority course files | Several reusable template areas are generic. Scaling generic curricula across 100+ course URLs risks thin or semantically mismatched pages. | Create one approved content brief per priority course: outcome, exact syllabus, tools, projects, duration, prerequisites, genuine proof and internal-link targets. Publish only after course-owner verification. | Content + developer |
| P1 | Structured-data implementation needs live validation | `includes/head.php` and priority course pages | EducationalOrganization, Course, canonical and breadcrumb patterns exist, but live rendered JSON-LD and URL parity still need validation. | Run Rich Results Test and Schema Validator for home, courses hub, Python, Java, Full Stack and Data Science pages. Correct warnings only where the displayed page supports the data. | Yes |
| P1 | Primary category/pillar hierarchy needs keyword ownership document | `sitemap-pages.xml`, `includes/menu.php` | Pillar and specialist URLs coexist (for example Java, Core Java, Advanced Java, Spring, Java Full Stack). Without a target map they can cannibalise each other. | Approve a keyword-to-URL map: one pillar owns each broad course phrase; specialist pages own specific technology/course-intent phrases and link upward to the pillar. | SEO + content |
| P2 | Search Console and field performance data unavailable in this audit | Search Console / GA4 | Current positions, impressions, indexing errors, mobile issues and Core Web Vitals cannot be truthfully reported from source files. | Connect/read Search Console and GA4; export last 90 days for queries, pages, coverage and mobile usability. Use field CWV data rather than assumptions. | Access required |
| P2 | Image accessibility needs a representative crawl | Course images and template assets | Course-card images have descriptive alts, but all course/page images have not yet been crawled. | Run a crawl that flags missing/duplicate alt text, oversized images and missing dimensions. Keep decorative images empty-alt; give informative instructor/project images descriptive alt text. | Yes |

## URL safety rules

1. Treat the current sitemap and live URLs as the starting inventory.
2. Do not remove or rename a course, branch, blog or WordPress URL until its traffic, backlinks, canonical and redirect destination are checked.
3. Use one canonical URL per search intent.
4. Use a permanent one-hop redirect only where an obsolete URL has a clear equivalent.
5. Preserve all enquiry forms, hidden tracking, validation, email/database handling and thank-you flow.

## Phase 2 target ownership — first approval batch

| Primary keyword | Approved target URL | Supporting URLs |
|---|---|---|
| Python Course in Jaipur | `/python-programming-course-jaipur.php` | Python full stack, Data Science, ML, interview guides |
| Java Course in Jaipur | `/java-programming-course-jaipur.php` | Core Java, Advanced Java, Spring, Hibernate, Java Full Stack |
| Full Stack Development Course in Jaipur | `/full-stack-development-course-jaipur.php` | MERN, MEAN, Java Full Stack, Python Full Stack, .NET |
| Data Science Course in Jaipur | `/data-science-course-jaipur.php` | Data Analytics, ML, AI, Generative AI, Power BI |
| Cyber Security Course in Jaipur | `/cyber-security-course-jaipur.php` | Ethical Hacking, CEH, SOC, Penetration Testing |
| Cloud Computing Course in Jaipur | `/cloud-computing-course-jaipur.php` | AWS, Azure, Google Cloud, DevOps, Docker, Kubernetes |
| Software Testing Course in Jaipur | `/software-testing-course-jaipur.php` | Manual, Automation, Selenium, API Testing, Playwright |
| Digital Marketing Course in Jaipur | `/digital-marketing-course-jaipur.php` | SEO, Google Ads, Social Media, Content and Email Marketing |

## Next safe work

1. Obtain Search Console/GA4 read access and hosting redirect export.
2. Build the detailed 20-course keyword/page map with titles, H1s, intent, internal links and supporting content.
3. Repair the Python course page first after the factual syllabus and claims are approved.
4. Validate live canonical/schema/redirect behaviour before any URL consolidation.
