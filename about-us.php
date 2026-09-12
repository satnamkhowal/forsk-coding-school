<?php
// Consolidate the legacy duplicate About URL into the maintained canonical page.
header('Location: /about.php', true, 301);
exit;
