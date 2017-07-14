<?php
function register_js()
{
    //loading bootstrap.min.js
    wp_register_script('bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),'',true);
    //portfolio page js
    wp_register_script('portfolio-js', get_template_directory_uri() . '/partials/js/portfolio.js', array('jquery'),'',true);
    wp_register_script('insights-js', get_template_directory_uri() . '/partials/js/insights.js', array('jquery'),'1.0.1',true);

    if(is_page('portfolio')) {
        wp_enqueue_script('portfolio-js');
        wp_localize_script( 'portfolio-js', 'projectloaderaddress', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));
    }

    if(is_page('latest-insights')) {
        wp_enqueue_script('insights-js');
        wp_localize_script( 'insights-js', 'insightsloaderaddress', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));
    }

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

    //loading font awesome everywhere
    wp_register_style('font-awesome-css', get_template_directory_uri() . '/assets/fonts/font-awesome-4.6.3/css/font-awesome.min.css');
    wp_enqueue_style('font-awesome-css');
}
add_action('wp_enqueue_scripts', 'register_css');