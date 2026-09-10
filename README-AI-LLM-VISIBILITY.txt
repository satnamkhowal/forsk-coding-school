FORSK CODING SCHOOL - AI DISCOVERY / LLM VISIBILITY PATCH
Updated: 10 September 2026

FILES / CHANGES
===============
ROOT
- /llms.txt                Curated site-level LLM guide (llms.txt v2 style)
- /robots.txt              AI/search crawlers allowed on public pages; private utility pages blocked
- /sitemap.xml             Master sitemap index
- /sitemap-pages.xml       Main pages sitemap (includes /live-mentorlab.php)
- /images-sitemap.xml      Image sitemap
- /live-mentorlab.php      Human-visible source page explaining the learning model
- /a2e6aef22b29005c161acb4bafed90cf.txt               IndexNow ownership key

BLOG
- /blog/llms.txt           Section-specific LLM guide
- /blog/blogs-sitemap.xml  Blog sitemap

MENTORS
- /mentors/llms.txt                Section-specific LLM guide
- /mentors/mentors-sitemap.xml     Mentor sitemap

CODE
- /includes/head.php       rel=describedby + sitemap discovery + rich snippet permissions
- /includes/footer.php     Human links to MentorLab and mentors
- /tools/indexnow-submit.php  CLI IndexNow bulk submission utility

IMPORTANT
=========
1. llms.txt is not a Google ranking factor. Google states that llms.txt is not required for Google Search/AI features and does not positively or negatively affect Google visibility/rankings.
2. The primary AI-search work remains normal SEO: crawlable 200 pages, internal links, useful visible text, canonical/index rules, quality images, structured data matching visible content, and strong entity consistency.
3. OAI-SearchBot is allowed for ChatGPT search discovery. Claude-SearchBot / Claude-User and PerplexityBot are also explicitly allowed. Googlebot/Bingbot/Applebot remain crawlable.
4. Training controls (GPTBot, ClaudeBot, Google-Extended, Applebot-Extended) are currently allowed on public pages because your stated goal is maximum AI discoverability. If you later want to opt out of training while preserving AI search visibility, these can be blocked separately.
5. Cloudflare/WAF/bot protection can still block legitimate crawlers even when robots.txt allows them. Check logs for 403/429 responses.

INDEXNOW
========
After deploying the package, first confirm this URL loads as plain text:
https://forskcodingschool.com/a2e6aef22b29005c161acb4bafed90cf.txt

Dry run from server shell:
php tools/indexnow-submit.php --dry-run

Submit sitemap URLs to IndexNow-enabled search engines:
php tools/indexnow-submit.php

The script reads sitemap.xml and child URL sitemaps, deduplicates URLs, and submits in batches of up to 10,000.

SEARCH CONSOLE / BING
=====================
- Submit only https://forskcodingschool.com/sitemap.xml in Google Search Console.
- Submit the same master sitemap in Bing Webmaster Tools.
- Use URL Inspection for major pages and verify that production pages do not output noindex.

NO PER-FOLDER REQUIREMENT
=========================
A root /llms.txt can cover the whole site. llms.txt v2 also supports more-specific files at subpaths. Because /blog/ and /mentors/ are large, distinct content areas, this patch includes /blog/llms.txt and /mentors/llms.txt. Individual 11,500 blog folders and 500 mentor folders do NOT need their own llms.txt files.

OPTIONAL PRIVACY VARIANT
========================
- /robots-AI-SEARCH-ONLY-optional.txt is included as an alternative.
- Use it instead of robots.txt if you want AI/search discovery (ChatGPT Search, Claude Search, Perplexity, Apple/Bing) while opting out of the listed model-training tokens.
- The active robots.txt in this package is configured for maximum public AI discoverability.
