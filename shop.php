<?php
require_once __DIR__ . '/config.php';

header('Location: ' . site_url('courses.php'), true, 301);
exit;
