<?php

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

/** Pull in the config information */
require_once(ABSPATH . 'wp-info.php');
require_once(ABSPATH . 'wp-overrides.php');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

remove_filter('template_redirect', 'redirect_canonical');

