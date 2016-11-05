<?php

wp_head();
get_header();
$output = '';

$output .= '<div class="row top_row front_page">';
$output .= '<div class="col-lg-12" id="header_photo">';
$output .= '<img src="'. get_template_directory_uri() .'/assets/imgs/dmjarrin_1200x500_wtype.jpg" alt="front page photo"/>';
$output .= '</div>'; //header_photo
$output .= '</div>'; //row

$output .= '<div class="row front_page_content">';
$output .= '<div class="col-xs-10 col-md-6 col-xs-offset-1 col-md-offset-3 main_content" id="home">';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$output .= '<h1>Welcome to DavidJarrin.com!</h1>';

// check to make sure the snippets plugin is active
if ( is_plugin_active( 'wp-snippets/wp-snippets.php' ) ) {
    $output .= do_shortcode('[snippet slug="front-page-intro-message" /]');;
}

//get the most recent post
$args = array(
  'numberposts' => 1
);
$most_recent_posts = query_posts($args);

$output .= '<h2>My Most Recent Insight</h2>';
$output .= '<div class="fp_post_container">';
$output .= '<h4 class="front_page_post_title"><a href="'. get_the_permalink().'">'. get_the_title() .'</a></h4>';

$featuredImage = get_the_post_thumbnail(null, 'medium', array('class' => 'posts_front_page_image'));
if(!is_null($featuredImage) AND !empty($featuredImage)) {
    $output .= '<a href="'. get_the_permalink() .'">' . $featuredImage .'</a>';
}
$output .= '<p>'. get_the_excerpt() .' <a href="'. get_the_permalink() .'">Read the rest of the post...</a></p>';

$output .= '<p class="more_content">Would you like to see more of the trials and tribulations of my work day? Check out the <a href="/latest-insights" target="_blank">Latest Insights Page</a></p>';
$output .= '</div>'; //fp_post_container

wp_reset_query();

$output .= '<hr />';

$output .= '<h2>My Most Recent Projects</h2>';

// WP_Query arguments
$projects_args = array (
    'post_type'              => array( 'projects' ),
    'posts_per_page'         => 1,
);

// The Query
$projects_query = new WP_Query( $projects_args );

// The Loop
if ( $projects_query->have_posts() ) {
    $output .= '<div class="fp_post_container">';
    while ( $projects_query->have_posts() ) {
        $projects_query->the_post();
        $output .= '<h4 class="front_page_post_title"><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></h4>';

        $featuredProjectsImage = get_the_post_thumbnail(null, 'large', array('class' => 'projects_front_page_image'));
        if(!is_null($featuredProjectsImage) AND !empty($featuredProjectsImage)) {
            $output .= '<a href="'. get_the_permalink() .'">' . $featuredProjectsImage . '</a>';
        }

        $output .= '<p>'. get_the_excerpt() .' <a href="'. get_the_permalink() .'">Read the rest of the post...</a></p>';
    }
}


$output .= '<p class="more_content">Would you like to see more about my most recent projects? <a href="/portfolio" target="_blank">Latest Projects Page</a></p>';
$output .= '</div>'; //fp_post_container

wp_reset_query();

$output .= '</div>'; // content body single column
$output .= '</div>'; // content body row

echo $output;

wp_footer();

