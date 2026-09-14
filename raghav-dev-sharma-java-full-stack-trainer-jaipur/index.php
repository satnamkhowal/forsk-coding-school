<?php
/**
 * Retire an unverified legacy mentor profile.
 *
 * The historical WordPress/LMS route published personal identity, employment,
 * experience and learner/project claims that are not verified in the current
 * authoritative site data. Keep the URL only to consolidate any historical
 * links/crawl signals into the maintained mentor hub; do not recreate the
 * profile or Person schema without first-party verification and editorial
 * approval.
 */
require_once dirname(__DIR__) . '/config.php';

header('Location: ' . site_url('mentors/'), true, 301);
exit;
