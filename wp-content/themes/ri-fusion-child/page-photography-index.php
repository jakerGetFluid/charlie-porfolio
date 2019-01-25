<?php
/**
 * Template Name: Photography Index Page
 * The template for displaying all photography categories
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */

get_header();
?>
<main id="main-page" class="wrap-main-page photo-cat">
    <div class="container">
        <div id="primary" class="content-area no-sidebar">
            <div id="main" class="site-main page-content">
                <?php
                if (get_post_meta(get_the_ID(), 'rit_disable_title', true) != '1') {
                    ?>
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php
                }
                // Start the loop.
                while (have_posts()) : the_post();
                  // Include the page content template.
                  get_template_part('content-photography', 'index');
                  // End the loop.
                endwhile;
                ?>
            </div><!-- .site-main -->
        </div><!-- .content-area -->
    </div>
</main>
<?php
if( has_shortcode(  get_the_content(), 'envira-album') ) {
    wp_enqueue_script( 'isotope');
}

get_footer();
?>