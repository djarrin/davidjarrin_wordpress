<?php

/**
 * Will load more projects when the "Show Even More Projects" button is clicked
 */
function projectsLoader()
{
    if(!empty($_POST['category']) AND !is_null($_POST['category'])) {
        $category = $_POST['category'];
    } else {
        $category = null;
    }

    if(!empty($_POST['offset']) AND !is_null($_POST['offset']) ) {
        $offset = $_POST['offset'];
    } else {
        $offset = null;
    }

    if(!empty($_POST['categoryNumber']) AND !is_null($_POST['categoryNumber']) ) {
        $containerNumber = $_POST['categoryNumber'];
    } else {
        $containerNumber = null;
    }

    // WP_Query arguments
    $args = array (
        'posts_per_page'    => 5,
        'post_type'         => 'projects',
        'offset'            => $offset,
        'tax_query' => array(
            array(
                'taxonomy' => 'projects_categories',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ),
    );

    // The Query
    $query = new WP_Query( $args );

    while ( $query->have_posts() ) {
        $query->the_post();

        $output = '<li class="project_container hidden_projects '. $containerNumber .'">';
        $output .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';

        $featuredImage = get_the_post_thumbnail(null, 'medium', array('class' => 'posts_front_page_image'));
        if (!is_null($featuredImage) AND !empty($featuredImage)) {
            $output .= $featuredImage;
        }
        $output .= '<p>' . get_the_excerpt() . ' <a href="' . get_the_permalink() . '">Read the rest of the post...</a></p>';
        $output .= '</li>'; //hidden_projects
    }

    if(!empty($output) AND !is_null($output)) {
        echo $output;
    } else {
        echo null;
    }

    wp_die();

}
add_action("wp_ajax_projectsLoader", "projectsLoader");
add_action("wp_ajax_nopriv_projectsLoader", "projectsLoader");

/**
 * Responsible for loading more insights on latest insights page
 */
function insightsLoader()
{

    if(!empty($_POST['offset']) AND !is_null($_POST['offset'])) {
        $offset = intval($_POST['offset']);
    } else {
        $offset = null;
    }

    $args = array (
        'post_type'         => array( 'post' ),
        'posts_per_page'    => 5,
        'offset'            => $offset
    );

    $query = new WP_Query( $args );

    $output = '';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $output .= '<li class="insights_container loaded">';
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
        $output .= '<div class="no-posts">Sorry, no more insights</div>';
    }

    echo $output;

    wp_die();
}
add_action("wp_ajax_insightsLoader", "insightsLoader");
add_action("wp_ajax_nopriv_insightsLoader", "insightsLoader");