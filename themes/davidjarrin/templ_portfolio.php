<?php
/* Template Name: Portfolio */

wp_head();
get_header();

$output = '';
$output .= '<div class="row top_row">';
$output .= '<div class="col-xs-10 col-md-6 col-xs-offset-1 col-md-offset-3" id="portfolio">';


$categories = get_filled_tax_categories('projects_categories');

$catCount = 0;
foreach ($categories as $category) {
    $tax_post = get_projects_tax_posts('projects_categories', $category->slug, 5);
    $output .= displayPortfolioPosts($tax_post, true, $catCount);
    $catCount++;
}



$output .= '</div>'; //portfolio
$output .= '</div>'; //top_row

echo $output;

wp_footer();