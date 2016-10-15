<?php
// Creates Projects Custom Post Type
function projects_init() {
    $args = array(
        'label' => 'Projects',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'projects'),
        'query_var' => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-hammer',
        'taxonomies'  => array( 'projects_categories' ),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',
            )
    );
    register_post_type( 'projects', $args );
}
add_action( 'init', 'projects_init' );

//custom taxonomy just for the project CPT
function projects_taxonomy() {
    register_taxonomy(
        'projects_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'projects',        //post type name
        array(
            'hierarchical' => true,
            'label' => 'Projects Categories',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'projects', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before
            )
        )
    );
}
add_action( 'init', 'projects_taxonomy');