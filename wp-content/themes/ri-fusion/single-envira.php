<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
get_header();

$rit_layout = get_post_meta(get_the_ID(), 'rit_gallery_layout', true);
if ($rit_layout == 'default' || $rit_layout == '') {
    $rit_layout = get_theme_mod('rit_gallery_layout', 'grid');
}
$rit_largewidth = '';
if (get_post_meta(get_the_ID(), 'rit_enable_large_width', true) == '1') {
    $rit_largewidth = 'largewidth';
} elseif (get_theme_mod('rit_enable_large_width', '1') == '1') {
    $rit_largewidth = 'largewidth';
}

?>
    <main id="main-page" class="wrap-main-single <?php echo esc_attr('gallery-' . $rit_layout . '-layout') ?>">
        <div class="container <?php echo esc_attr($rit_largewidth) ?>">
            <div id="detail-gallery" class="content-single">
                <?php
                while (have_posts()) : the_post();
                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                        get_template_part('included/templates/gallery/' . $rit_layout);
                    // If comments are open or we have at least one comment, load up the comment template.
                endwhile;
                ?>
            </div><!-- .site-main -->
        </div><!-- .content-area -->
    </main>
<?php get_footer(); ?>