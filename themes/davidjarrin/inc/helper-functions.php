<?php

/**
 * @param $tax_type
 * @return array of tax categories that have been filled
 */
function get_filled_tax_categories($tax_type)
{
    $args = array(
        'taxonomy' => $tax_type,
        'hide_empty' => true
    );

    $categories = get_terms($args);

    return $categories;
}

/**
 * Will display projects query results by taxonomy, category and number of posts
 * @param $taxonomy
 * @param $category
 * @param $number_of_posts
 * @return WP_Query
 */
function get_projects_tax_posts($taxonomy, $category, $number_of_posts)
{
    // WP_Query arguments
    $args = array (
        'posts_per_page'    => $number_of_posts,
        'post_type'         => 'projects',
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ),
    );

    // The Query
    $query = new WP_Query( $args );

    return $query;

}

function displayPortfolioPosts($post_object, $first_call, $containerNumber)
{
    $output = '';

    if ( $post_object->have_posts() ) {
        $output .= '<div class="project_category_container catNumber_'. $containerNumber .'">';
        $catOutput = get_the_terms( $post_object->post->ID, 'projects_categories' );

        $output .= '<h2 class="projects_category_headline">'. $catOutput[0]->name .'</h2>';
        $output .= '<ul class="projects_category_list catNumber_'. $containerNumber .'">';
        while ( $post_object->have_posts() ) {
            $post_object->the_post();
            if($first_call AND $post_object->current_post == 0) {
                $output .= '<li class="project_container feature_post">';
                $output .= '<h4><a href="'. get_the_permalink().'">'. get_the_title() .'</a></h4>';
                $featuredImage = get_the_post_thumbnail(null, 'medium', array('class' => 'posts_front_page_image'));
                if(!is_null($featuredImage) AND !empty($featuredImage)) {
                    $output .= $featuredImage;
                }
                $output .= '<p>'. get_the_excerpt() .' <a href="'. get_the_permalink() .'">Read the rest of the post...</a></p>';
                $output .= '</li>'; //feature_post
            } else {
                $output .= '<li class="project_container hidden_projects catNumber_'. $containerNumber .'">';
                $output .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';

                $featuredImage = get_the_post_thumbnail(null, 'medium', array('class' => 'posts_front_page_image'));
                if (!is_null($featuredImage) AND !empty($featuredImage)) {
                    $output .= $featuredImage;
                }
                $output .= '<p>' . get_the_excerpt() . ' <a href="' . get_the_permalink() . '">Read the rest of the post...</a></p>';
                $output .= '<hr />';
                $output .= '</li>'; //hidden_projects


            }
        }
        $output .= '</ul>'; //projects_category_list
        $output .= '<div class="loader-container catNumber_'. $containerNumber .'"><i class="fa fa-refresh fa-spin fa-3x" aria-hidden="true"></i></div>';
        $output .= '<div id="load-more-projects" class="catNumber_'. $containerNumber .' '.$catOutput[0]->slug.'">Show Even More Projects?</div>';
        $output .= '<div id="more-projects" class="catNumber_'. $containerNumber .'">See More Projects?</div>';
        $output .= '</div>'; //project_category_container
    }

    return $output;

}
