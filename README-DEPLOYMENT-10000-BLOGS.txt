FORSK CODING SCHOOL — ORIGINAL PROJECT UPDATED WITH 10,000 NEW BLOGS

Primary deployable package contents:
- Original Forsk website files preserved (Git history excluded from delivery only).
- Latest mentor module merged.
- Mentor images relocated to /mentors/images/ for portability.
- Existing 1,500 blog folders preserved.
- 10,000 new unique blog folders added under /blog/<seo-slug>/index.php.
- Central blog renderer: /blog/blog-details.php.
- All blog featured images now belong in /blog/images/.
- New blog pages automatically use a placeholder until the exact WebP filename is uploaded.
- New blog pages contain 2–4 relevant internal course links plus 3 related-blog links.
- Root sitemap.xml is now a sitemap index referencing sitemap-pages.xml and blog/blogs-sitemap.xml.
- Localhost host/port handling centralized in /config.php; local copies are noindex.

Important files for content/image operations:
/blog/new-10000-blog-links.csv
/blog/new-10000-blog-seo-manifest.csv
/blog/new-10000-blog-image-prompts.csv
/blog/image-manifest.csv
/blog/course-internal-link-map.csv
/blog/README-10000-BLOGS.txt

QA performed:
- 10,000/10,000 new slugs unique.
- 10,000/10,000 new titles unique.
- Zero exact slug overlap with 1,500 existing blog folders.
- Zero exact title overlap detected against parseable existing blog titles.
- All selected course URLs exist in the project.
- Existing malformed PHP schemas repaired (500 pages) plus two apostrophe-related schema parse errors fixed.
- All 1,500 legacy blog PHP files lint clean after repair.
- Generated wrapper sample lint clean; all wrappers use the same deterministic PHP template.
- Central config/head/blog renderer/library/archive and non-blog PHP files lint clean.
- Blog sitemap contains 11,500 URLs and XML parses successfully.
