<?php
/**
 * Legacy homepage alias.
 *
 * /default.php previously rendered a second copy of the homepage and remains
 * discoverable in search. Permanently consolidate that legacy URL into the
 * canonical root homepage so crawlers and users have one authoritative URL.
 */
header('Location: /', true, 301);
exit;
