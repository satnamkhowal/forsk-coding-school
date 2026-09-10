FORSK CODING SCHOOL — SITEMAP PACKAGE WITH IMAGE SITEMAP
========================================================

UPLOAD THE CONTENTS OF THIS ZIP TO THE MATCHING LOCATIONS UNDER public_html.
Do not upload the outer folder itself if your hosting file manager already opens public_html.

PLACEMENT
---------
/public_html/sitemap.xml
/public_html/sitemap-pages.xml
/public_html/images-sitemap.xml
/public_html/blog/blogs-sitemap.xml
/public_html/mentors/mentors-sitemap.xml

PUBLIC URLS
-----------
https://forskcodingschool.com/sitemap.xml
https://forskcodingschool.com/sitemap-pages.xml
https://forskcodingschool.com/images-sitemap.xml
https://forskcodingschool.com/blog/blogs-sitemap.xml
https://forskcodingschool.com/mentors/mentors-sitemap.xml

MASTER SITEMAP
--------------
Submit only this in Google Search Console:
https://forskcodingschool.com/sitemap.xml

The master sitemap.xml is a sitemap INDEX and references:
1. Main pages sitemap
2. Blog sitemap
3. Mentor sitemap
4. Image sitemap

IMAGE SITEMAP STATUS
--------------------
Current image entries: 31
These are the mentor images that are currently marked READY and physically exist in the project build.

The image sitemap intentionally does NOT list pending/nonexistent blog or mentor images.
Adding image URLs before the files exist would create crawl errors/404s and is not recommended.

When new mentor images are uploaded to:
/public_html/mentors/images/
add their profile URL + image URL to images-sitemap.xml.

When real blog images are uploaded to:
/public_html/blog/images/
add the corresponding blog landing-page URL + image URL to images-sitemap.xml.

ROBOTS.TXT
----------
Keep this line in /public_html/robots.txt:
Sitemap: https://forskcodingschool.com/sitemap.xml

IMPORTANT
---------
Do not submit every child sitemap separately unless you specifically want separate reporting.
Submitting the master sitemap.xml is sufficient because it references all child sitemaps.
