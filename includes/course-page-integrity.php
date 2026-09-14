<?php
/**
 * Course page trust/UX integrity layer.
 *
 * Generated course pages historically inherited template-only UI such as
 * unsupported rating counters, hard-coded lesson/hour totals, dead social
 * share links and a wishlist action with no maintained product/account flow.
 * Until those signals are backed by verified first-party data, fail closed and
 * remove them from the server-rendered HTML.
 *
 * This filter activates only when the page publishes Course structured data.
 */

if (!function_exists('forsk_schema_contains_course_type')) {
    function forsk_schema_contains_course_type($node): bool
    {
        if (!is_array($node)) {
            return false;
        }

        if (array_key_exists('@type', $node)) {
            $type = $node['@type'];
            if ($type === 'Course' || (is_array($type) && in_array('Course', $type, true))) {
                return true;
            }
        }

        foreach ($node as $value) {
            if (is_array($value) && forsk_schema_contains_course_type($value)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('forsk_normalize_course_schema')) {
    function forsk_normalize_course_schema(array $node): array
    {
        $type = $node['@type'] ?? null;
        $isCourse = $type === 'Course' || (is_array($type) && in_array('Course', $type, true));

        if ($isCourse) {
            // Reference the single authoritative organization entity emitted by
            // includes/head.php instead of creating a second partial provider
            // entity on every course page.
            $node['provider'] = ['@id' => SITE_ORGANIZATION_ID];

            // Generated course pages may pass repository-relative image paths.
            // Structured-data URLs should be absolute and canonical on production.
            if (isset($node['image']) && is_string($node['image']) && trim($node['image']) !== '') {
                $image = trim($node['image']);
                if (!preg_match('#^https?://#i', $image)) {
                    $node['image'] = seo_url($image);
                }
            }

            if (isset($node['url']) && is_string($node['url']) && trim($node['url']) !== '') {
                $node['url'] = seo_url(trim($node['url']));
            }
        }

        foreach ($node as $key => $value) {
            if (is_array($value)) {
                $node[$key] = forsk_normalize_course_schema($value);
            }
        }

        return $node;
    }
}

if (!function_exists('forsk_course_page_integrity_filter')) {
    function forsk_course_page_integrity_filter(string $html): string
    {
        // Remove template rating widgets unless/until ratings are sourced from
        // verified first-party review data. This also prevents unsupported trust
        // claims from remaining in the rendered HTML seen by crawlers.
        $html = preg_replace(
            '#<div\b[^>]*class=["\'][^"\']*\bsingle-rating\b[^"\']*["\'][^>]*>.*?</div>#is',
            '',
            $html
        ) ?? $html;

        // Generated detail pages repeat the same lesson/hour totals across
        // unrelated courses. Hide those counters until each course has a verified,
        // maintained curriculum total. Preserve factual non-numeric metadata such
        // as delivery style and educational level.
        $html = preg_replace(
            '#<span>\s*<i\b[^>]*class=["\'][^"\']*\btji-(?:book|clock)\b[^"\']*["\'][^>]*></i>\s*\d+\+?\s*(?:Lessons?|Hours?)\s*</span>#i',
            '',
            $html
        ) ?? $html;

        // The generated curriculum subtitle repeats template lesson counts. Keep a
        // truthful qualitative label rather than publishing an unverified number.
        $html = preg_replace(
            '#(<div\b[^>]*class=["\'][^"\']*\bcurriculum-title-meta\b[^"\']*["\'][^>]*>)[^<]*(?:lesson|hour)[^<]*(</div>)#i',
            '$1Practical, project-based learning$2',
            $html
        ) ?? $html;

        // Wishlist was retired and has no maintained user/account workflow.
        // Remove the dead control rather than sending visitors through a redirect.
        $html = preg_replace(
            '#<a\b[^>]*class=["\'][^"\']*\btj-wishlist-btn(?:-2)?\b[^"\']*["\'][^>]*>.*?</a>#is',
            '',
            $html
        ) ?? $html;

        // Generated share menus contain placeholder href="#" social links. Remove
        // only that dead list; retain the valid copy-link control in the popup.
        $html = preg_replace(
            '#<ul\b[^>]*class=["\'][^"\']*\btj-socials\b[^"\']*["\'][^>]*>\s*(?:<li>\s*<a\b[^>]*href=["\']#["\'][^>]*>.*?</a>\s*</li>\s*)+</ul>#is',
            '',
            $html
        ) ?? $html;

        // Generated course templates label a practical-support section as
        // “Reviews”. Keep the useful content but make the navigation truthful.
        $html = preg_replace(
            '~(<a\b[^>]*href=["\']#reviews["\'][^>]*>)\s*Reviews\s*(</a>)~i',
            '$1Practice$2',
            $html
        ) ?? $html;

        return $html;
    }
}

$courseSchema = null;
if (is_string($page_schema ?? null) && trim($page_schema) !== '') {
    $decodedSchema = json_decode($page_schema, true);
    if (is_array($decodedSchema)) {
        $courseSchema = $decodedSchema;
    }
} elseif (is_array($page_schema ?? null)) {
    $courseSchema = $page_schema;
}

if (is_array($courseSchema) && forsk_schema_contains_course_type($courseSchema)) {
    $courseSchema = forsk_normalize_course_schema($courseSchema);
    $page_schema = json_encode(
        $courseSchema,
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
    ob_start('forsk_course_page_integrity_filter');
}
