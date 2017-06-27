<?php
/**
 * Template Name: Single Page Template
 */

wp_head();
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();

?>
    <div class="row top_row">
        <div class="col-xs-10 col-md-6 col-xs-offset-1 col-md-offset-3 main_content" id="single_post">

                <h1><?php the_title() ?></h1>
                <?php
                the_content();
            ?>

        </div> <!--single_post-->
    </div> <!--row-->

<?php
endwhile;
endif;
wp_footer();

