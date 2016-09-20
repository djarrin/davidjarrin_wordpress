<?php
add_action( 'after_setup_theme', 'theme_nav_setup' );
function theme_nav_setup() {
    register_nav_menu( 'primary', __( 'Primary navigation', 'Primary nav for the whole site (will be above all content)' ) );
}