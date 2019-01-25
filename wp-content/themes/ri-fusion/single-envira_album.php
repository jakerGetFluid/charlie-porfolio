<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */

get_header();
?>
<main id="main-page" class="wrap-main-single">
    <div class="container">
        <div id="detail-post" class="content-single">
            <?php
            // Start the loop.
            while (have_posts()) : the_post();

                /*
                 * Include the post format-specific template for the content. If you want to
                 * use this in a child theme, then include a file called called content-___.php
                 * (where ___ is the post format) and that will be used instead.
                 */
                the_content();
                // If comments are open or we have at least one comment, load up the comment template.
            endwhile;
            ?>

        </div><!-- .site-main -->
    </div><!-- .content-area -->
</main>
<?php get_footer(); ?>