<?php
require_once __DIR__ . '/config.php';

$target = site_url('/about.php');
header('Location: ' . $target, true, 301);
exit;
