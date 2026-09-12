# Forsk Coding School — Living Execution Queue

Last updated: 2026-09-13 (Asia/Kolkata)
Operational source of truth: project master execution brief supplied in ChatGPT project.

## P0 — Runtime, trust and conversion

| Status | Workstream | Notes |
|---|---|---|
| DONE | Restore verified branch data dependency | Added `includes/branches-data.php` using confirmed Shyam Nagar public details only. |
| DONE | Restore enrollment processing | Added `process.php` adapter with CSRF, honeypot, required-field, email and Indian mobile validation before shared lead handling. |
| DONE | Restore enrollment/branch CSS | Added `assets/css/admissions-branches.css`. |
| DONE | Restore crawlable branch directory | Added `/branches/` and verified `/branches/jaipur-shyam-nagar/`. |
| DONE | Restore branch discovery files | Added `/branches/llms.txt` and `/branches/branches-sitemap.xml`. |
| VERIFY | Root routing reconciliation | `.htaccess` is absent on current `main`; do not recreate blindly. Verify live entrypoint and recent repo history first. |
| IN PROGRESS | Homepage trust cleanup | Remove legacy/demo claims, fake stats/testimonials/events/pricing and retain only factual, useful conversion content. |
| QUEUED | Lead-flow live verification | Verify form action, success path, persistence fallback and no PHP/runtime errors after deployment. |

## P1 — Search growth

| Status | Workstream | Notes |
|---|---|---|
| QUEUED | Data Science Roadmap CTR upgrade | GSC near-win: high impressions, page-one visibility, very low CTR. Preserve URL; improve snippet/intent match and internal links. |
| QUEUED | DSA in Python opportunity | Improve intent coverage/internal links around existing ranking page. |
| QUEUED | Jaipur local-intent cluster | Prioritize factual Jaipur pages for coding classes, IT training and high-value course queries; avoid fake locations. |
| QUEUED | Index-fragmentation hygiene | Review parameter/date/archive/duplicate paths and canonical/noindex controls without breaking WordPress URLs. |
| QUEUED | Internal-link graph | Connect courses, related guides, branch, enrollment and high-performing informational pages contextually. |

## P1 — Content, news and Web Stories

| Status | Workstream | Notes |
|---|---|---|
| QUEUED | Verified tech-news intake | Source, verify, relevance-score and duplicate-check 2–5 strong items/day only when worthwhile. |
| QUEUED | Web Story pipeline | Build reusable story structure from suitable verified articles with optimized mobile images and canonical linking. |
| QUEUED | Content derivative pipeline | Generate channel-specific Instagram, Facebook, LinkedIn, GBP, YouTube Shorts, TikTok, Pinterest, X, Threads and Bluesky assets where available. |
| QUEUED | Central social publishing | Prefer connected Metricool; otherwise keep publish-ready assets and continue other queues. |

## P2 — Quality and operations

| Status | Workstream | Notes |
|---|---|---|
| QUEUED | Live technical audit | HTTP status, canonical, sitemap, robots, schema, responsive navigation, Core Web Vitals indicators and broken links. |
| QUEUED | Image pipeline | SEO filenames, WebP/AVIF where supported, dimensions, alt/title/description and decoupled asset folders by content type. |
| QUEUED | Deployment safety | Logical commits, no secrets, preserve WordPress routes and keep modules independently replaceable. |

## Rules

- Never invent physical branches, learner counts, placement guarantees, ratings, instructors, testimonials, event attendance or pricing.
- Preserve existing ranking URLs unless a verified redirect plan exists.
- Prefer factual static/lightweight implementation and shared components.
- If a queue item is blocked, mark it `RETRY` with the blocker and continue another independent queue.
- Do not expose credentials or commit secrets.
