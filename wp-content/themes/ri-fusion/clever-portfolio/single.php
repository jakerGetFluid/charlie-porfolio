<?php
/**
 * The template for displaying all single portfolio.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since clever-portfolio 1.0
 */
get_header();
wp_enqueue_style('font-awesome');
wp_enqueue_style('clever-font');
if (!wp_style_is('bootstrap', 'enqueued')) {
    wp_enqueue_style('bootstrap-lite');
}
wp_enqueue_style('clever-portfolio');
wp_enqueue_script('clever-portfolio-single-js');
$template = get_option('template');
?>
<main id="main-page" class="wrap-main-single cp-main <?php echo esc_attr($template) ?>">
    <?php
    while (have_posts()) : the_post();
        $clever_meta = clever_portfolio_single_meta();
        $clever_settings = clever_portfolio_get_settings();
        $clever_format = $clever_meta['format'];
        $rit_class = 'cp-single';
        if ($clever_format == 'gallery' ) {
            $rit_layout = (isset($clever_meta['gallery_layout'])) ? $clever_meta['gallery_layout'] : 'inherit';
            if ($rit_layout == 'inherit' || $rit_layout == 'use-default') {
                $rit_layout = $clever_settings['single_gallery_layout'];
            }
            $rit_class .= ' cp-gallery-format ';
        } else {
            $rit_layout = (isset($clever_meta['embed_layout'])) ? $clever_meta['embed_layout'] : 'inherit';
            if ($rit_layout == 'inherit' || $rit_layout == 'use-default') {
                $rit_layout = $clever_settings['single_embed_layout'];
            }
            $rit_class .= ' cp-embed-format ';
        }
        $rit_class .= $rit_layout;
        if ($rit_layout == 'right-sidebar' || $rit_layout == 'left-sidebar') {
            $rit_class .= ' has-sidebar ';
        }
        if ($rit_layout != 'full-screen' && $rit_layout != 'full-width') {
            ?>
            <div class="container">
            <?php
        }
        ?>
        <div class="content-single">
            <article id="portfolio-<?php the_ID(); ?>" <?php post_class($rit_class) ?>>
                <?php clever_get_template_part('clever-portfolio', 'single/' . $clever_format, $rit_layout . '-layout', true); ?>
            </article><!-- #post-## -->
        </div>
        <?php
        if ($rit_layout != 'full-screen' && $rit_layout != 'full-width') {
            ?>
            </div>
            <?php
        }
    endwhile;
    ?>
</main>
<?php get_footer(); ?>
