FORSK CODING SCHOOL — 10,000 BLOG EXPANSION
Generated: 10 Sep 2026

WHAT WAS ADDED
- 10,000 NEW unique blog URL folders under /blog/<seo-slug>/index.php
- Preserved 1,500 existing blog folders
- Central renderer: /blog/blog-details.php
- Shared content helper: /blog/blog-library.php
- Scalable paginated/searchable archive: /blog/index.php
- Blog image folder: /blog/images/
- Mentor image folder migrated to: /mentors/images/
- 10,000-link CSV: /blog/new-10000-blog-links.csv
- Image manifest: /blog/image-manifest.csv
- Course-link audit: /blog/course-internal-link-map.csv
- Blog sitemap: /blog/blogs-sitemap.xml
- Root sitemap converted to sitemap index.

BLOG IMAGE WORKFLOW
Every new blog expects exactly one SEO-named featured image in:
    /blog/images/<seo-image-filename>.webp
The filename is listed in image-manifest.csv. Until the image exists, blog pages automatically show blog-image-placeholder.svg. Once the WebP is uploaded with the exact name, the page and BlogPosting schema automatically use it.

MENTOR IMAGE WORKFLOW
Mentor images are now kept inside the mentor module:
    /mentors/images/
This makes /blog and /mentors independently portable for future deployment.

INTERNAL LINKING
Every new blog includes 2–4 topic-matched course links selected from real course PHP files in the project. It also includes three related-blog links in the same topic family. Random or non-existent course URLs were not intentionally added.

IMPORTANT SEO DEPLOYMENT NOTE
10,000 URLs can technically be indexed, but publishing all of them at once is usually not the best content-quality strategy. Stage publication after editorial review, add the real featured images, and inspect Search Console performance. Keep articles that genuinely answer distinct search intents; merge or noindex weak/overlapping pages rather than forcing indexation.

LOCALHOST
Host and port are detected centrally from /config.php. Change LOCAL_PROJECT_PATH only if the local project directory changes. Local/test copies automatically receive noindex directives through includes/head.php.

ADDITIONAL MANIFESTS
- /blog/new-10000-blog-seo-manifest.csv -> title, URL, meta description, category, audience, intent, image filename, course links and related blogs.
- /blog/new-10000-blog-image-prompts.csv -> 10,000 ready featured-image prompts using the exact SEO filenames.
