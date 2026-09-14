<?php
// Legacy URL compatibility: the maintained Knowledge Hub lives at /blog/.
header('Location: /blog/', true, 301);
exit;
