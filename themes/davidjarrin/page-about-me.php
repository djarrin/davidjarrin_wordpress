<?php

wp_head();
get_header();

$output .= '<div class="row">';
$output .= '<div class="col-xs-10 col-md-6 col-xs-offset-1 col-md-offset-3" id="about-me">';

$page = get_page_by_title( 'about me' );
$content = apply_filters('the_content', $page->post_content);
$output .= $content;

$output .= '</div>'; //about-me
$output .= '</div>'; //row

echo $output;

wp_footer();