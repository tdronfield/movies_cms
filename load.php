<?php
define('ABSPATH', __DIR__);

# Display Errors, DEBUG ONLY. Turn off in production env.
    ini_set('display_errors', 1);

    require_once ABSPATH.'/config/database.php';
    require_once ABSPATH.'/admin/scripts/read.php';