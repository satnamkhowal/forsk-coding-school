# Deployment & Routing Audit

Audit date: 2026-09-13 (Asia/Kolkata)

## Current finding

Production is hybrid. Do not assume the Git repository alone controls every public URL.

- The repository contains a static/PHP `default.php` homepage candidate.
- The repository's current `main` does **not** contain `.htaccess`.
- A live fetch of `/` returned the WordPress/Eduma homepage, including WordPress course links, legacy Eduma footer text and WordPress forms.
- Static `.php` course URLs such as `/data-science-course-jaipur.php` are live and match repository-managed course-page structure.
- WordPress URLs such as `/contact/` and existing blog/course post permalinks remain live and must not be broken by static routing changes.

## Safety rule

Do not recreate or replace root rewrite rules from assumptions. Before any root routing change, obtain the actual production `.htaccess`/server rewrite configuration or a connected WordPress/server management surface and compare it with the repository.

## Ownership model to use until verified otherwise

| URL type | Working ownership assumption | Change policy |
|---|---|---|
| `/` | WordPress/hybrid deployment | Audit first; do not claim repo `default.php` fixes production root. |
| `/contact/` and WordPress post/course permalinks | WordPress | Preserve URLs; edit through authorized WordPress surface when connected. |
| `/*.php` static course/info pages | Git repository | Safe to improve through logical Git commits after dependency check. |
| `/branches/*` newly restored module | Git repository | Keep physical-location claims verified; live-test after deployment. |
| `/enroll-now.php` | Git repository | Live-test form action and shared lead handler after deployment. |

## Production trust issues observed on WordPress-owned output

These should be removed or verified through the WordPress workstream, not duplicated into Git fixes:

- Unsupported aggregate claims such as hundreds of placement partners or hundreds of job-ready skills.
- Template/demo counters, reviews, learner totals or ratings unless backed by evidence.
- Legacy Eduma/template attribution and stale template components.
- Duplicate About content on multiple URLs.
- Physical location pages must be checked against the verified Shyam Nagar address before being treated as branches.

## Next verification

1. Connect an authorized self-hosted WordPress management surface or inspect production server rewrite config.
2. Determine the exact routing priority between physical files, WordPress and any deployment sync.
3. Test `/branches/`, `/branches/jaipur-shyam-nagar/`, `/enroll-now.php` and `/about.php` after the Git deployment completes.
4. Only then change root routing or canonical redirect rules.
