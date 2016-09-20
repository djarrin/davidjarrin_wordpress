<?php
function register_js()
{
    //loading bootstrap.min.js
    wp_register_script('bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery','',true);
    wp_enqueue_script('bootstrap.min.js');
}
add_action('wp_enqueue_scripts', 'register_js');

function register_css()
{
    //loading bootstrap css
    wp_register_style('bootstrap.min.css', get_template_directory_uri() . '/assets/styles/bootstrap.min.css');
    wp_enqueue_style('bootstrap.min.css');

    //loading sites main css file
    wp_register_style('main-css', get_template_directory_uri() . '/assets/styles/davidjarrin.css');
    wp_enqueue_style('main-css');
}
add_action('wp_enqueue_scripts', 'register_css');