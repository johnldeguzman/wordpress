<?php

/*
Plugin Name: PandoraBox Sections
Plugin URI:
Description: Functional sections for theme "PandoraBox"
Author: Iltaen
Version: 1.0.2
Author URI: http://themeforest.net/user/Iltaen
*/

add_theme_support( "post-thumbnails");

include dirname(__FILE__) . '/pandora-skills.php';
include dirname(__FILE__) . '/pandora-team.php';
include dirname(__FILE__) . '/pandora-partners.php';

?>