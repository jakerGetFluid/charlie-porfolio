<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */

get_header();
$rit_sidebar = get_theme_mod('rit_default_sidebar', 'right-sidebar');
if ($rit_sidebar == 'no-sidebar') {
    $rit_class_main = 'col-xs-12';
} elseif ($rit_sidebar == 'right-sidebar') {
    $rit_class_main = 'col-sm-9 col-xs-12';
} elseif ($rit_sidebar == 'left-sidebar') {
    $rit_class_main = 'col-sm-9 col-xs-12';
} else {
    $rit_class_main = 'col-sm-6 col-xs-12';
}
?>

<main id="main-page" class="wrap-main-single">
    <div class="container">
        <?php
        // Start the loop.
        while (have_posts()) : the_post();
            ?>
            <div id="primary" class="content-area row">
                <?php if ($rit_sidebar == 'left-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                    <?php get_sidebar(); ?>
                <?php } ?>
                <div id="detail-post" class="content-single <?php echo esc_attr($rit_class_main); ?>">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <div class="post-image single-image">
                            <?php
                            $rit_image_size = apply_filters('ri_fusion_attachment_size', 'full');
                            echo wp_get_attachment_image(get_the_ID(), $rit_image_size); ?>
                        </div>
                        <div class="header-post">
                            <?php
                            the_title('<h1 class="title-detail">', '</h1>');
                            ?>
                        </div>
                        <div class="img-meta">
                            <?php ri_fusion_entry_meta(); ?>
                            <?php edit_post_link(esc_html(__('Edit', 'ri-fusion')), '<span class="edit-link">', '</span>'); ?>
                        </div>
                        <div class="post-content">
                                <?php if (has_excerpt()) : ?>
                                    <div class="entry-caption">
                                        <?php the_excerpt(); ?>
                                    </div><!-- .entry-caption -->
                                <?php endif; ?>
                            <?php
                            the_content();
                            wp_link_pages(array(
                                'before' => '<div class="page-links"><span class="page-links-title">' . esc_html(__('Pages:', 'ri-fusion')) . '</span>',
                                'after' => '</div>',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                                'pagelink' => '<span class="screen-reader-text">' . esc_html(__('Page', 'ri-fusion')) . ' </span>%',
                                'separator' => '<span class="screen-reader-text">, </span>',
                            ));
                            ?>
                        </div><!-- .entry-content images -->
                        <nav id="image-navigation" class="post-pagination  row">
                            <div class="prev-post col-sm-6 col-xs-12">
                                <h4>
                                    <?php previous_image_link(false, esc_html(__('Previous Image', 'ri-fusion'))); ?>
                                </h4>
                            </div>
                            <div class="next-post col-sm-6 col-xs-12">
                                <h4>
                                    <?php next_image_link(false, esc_html(__('Next Image', 'ri-fusion'))); ?>
                                </h4>
                            </div>
                        </nav><!-- .image-navigation -->
                    </article><!-- #post-## -->

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                </div>
                <?php
                if ($rit_sidebar == 'right-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                    <?php get_sidebar('right'); ?>
                <?php } ?>
            </div>
            <?php
            // End the loop.
        endwhile;
        ?>
    </div>
</main><!-- .site-main -->

<?php get_footer(); ?>
