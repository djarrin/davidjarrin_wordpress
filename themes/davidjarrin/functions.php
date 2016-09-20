<?php
/**
 * davidjarrin functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package davidjarrin
 */
/**
 * includes all the base crap that was in this starter theme
 */
include_once 'inc/baseSetUp.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * responsible for any wordpress theme setup
 */
require_once 'inc/theme-setup.php';

//will be responsible for where all of the scripts will be registered and enqueued
require_once 'inc/enqueue-scripts.php';

//will help integrate bootstrap menu into wordpress
require_once 'inc/wp_bootstrap_navwalker.php';

//functions that could be used everywhere
require_once 'inc/helper-functions.php';

//registering all custom post types
require_once 'inc/custom-post-types.php';
