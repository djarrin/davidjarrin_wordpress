<?php
wp_head();
get_header();
?>
    <div class="row top_row">
        <div class="col-xs-10 col-md-6 col-xs-offset-1 col-md-offset-3" id="contact_me">
            <?php

            if ( have_posts() ) : while ( have_posts() ) : the_post();
                ?>
                <h1><?php the_title() ?></h1>
                <?php
                the_content();
            endwhile;
            endif;

            ?>

        </div> <!--single_post-->
    </div> <!--row-->

<?php

wp_footer();