<?php
/* Template Name: Latest Insights */

wp_head();
get_header();

$output = '';
$output .= '<div class="row top_row">';
$output .= '<div class="col-xs-10 col-md-6 col-xs-offset-1 col-md-offset-3 main_content" id="latest-insights">';

$output .= '<h1>My Most Recent Insight</h1>';
$output .= '<ul class="insights_list">';

// WP_Query arguments
$args = array (
    'post_type'      => array( 'post' ),
    'posts_per_page' => 10
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $output .= '<li class="insights_container">';
        $output .= '<h4><a href="'. get_the_permalink().'">'. get_the_title() .'</a></h4>';

        $featuredImage = get_the_post_thumbnail(null, 'medium', array('class' => 'posts_front_page_image'));
        if(!is_null($featuredImage) AND !empty($featuredImage)) {
            $output .= $featuredImage;
        }
        $output .= '<p>'. get_the_excerpt() .' <a href="'. get_the_permalink() .'">Read the rest of the post...</a></p>';

        $output .= '</li>'; //insights_container
        $output .= '<hr />';
    }
} else {
    $output .= '<p>No posts yet but I\'m working on that</p>';
}


// Restore original Post Data
wp_reset_postdata();

$output .= '</ul>'; //insights_list
$output .= '<div class="loader-container"><i class="fa fa-refresh fa-spin fa-3x" aria-hidden="true"></i></div>';
$output .= '<button type="button" id="load_more_insights" class="btn btn-secondary btn-lg btn-block">Load More Insights</button>';
$output .= '</div>'; //row
$output .= '</div>'; //latest-insights


echo $output;

wp_footer();