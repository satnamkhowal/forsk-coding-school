<?php
require_once dirname(__DIR__) . '/config.php';
header('Location: ' . site_url('/twitter/'), true, 301);
exit;
