<?php
/**
 * Course page trust/UX integrity layer.
 *
 * Generated course pages historically inherited template-only UI such as
 * unsupported rating counters and a wishlist action with no maintained
 * product/account workflow. Until those signals are backed by verified data,
 * fail closed and remove them from the server-rendered HTML.
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

        // Wishlist was retired and has no maintained user/account workflow.
        // Remove the dead control rather than sending visitors through a redirect.
        $html = preg_replace(
            '#<a\b[^>]*class=["\'][^"\']*\btj-wishlist-btn(?:-2)?\b[^"\']*["\'][^>]*>.*?</a>#is',
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
    ob_start('forsk_course_page_integrity_filter');
}
