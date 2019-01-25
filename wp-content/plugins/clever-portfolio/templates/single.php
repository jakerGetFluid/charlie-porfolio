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
 * @since        clever-portfolio 1.0
 */
get_header();
$template = get_option( 'template' );
?>
<main id="main-page" class="wrap-main-single cp-main <?php echo esc_attr($template)?>">
    <?php
    while (have_posts()) : the_post();
        $clever_meta = clever_portfolio_single_meta();
        $clever_settings = clever_portfolio_get_settings();
        $clever_format = $clever_meta['format'];
        $clever_class = 'cp-single';
        if ($clever_format == 'gallery') {
            $clever_layout = (isset($clever_meta['gallery_layout'])) ? $clever_meta['gallery_layout'] : 'inherit';
            if ($clever_layout == 'inherit') {
                $clever_layout = $clever_settings['single_gallery_layout'];
            }
            $clever_class .= ' cp-gallery-format ';
        } else {
            $clever_layout = (isset($clever_meta['embed_layout'])) ? $clever_meta['embed_layout'] : 'inherit';
            if ($clever_layout == 'inherit') {
                $clever_layout = $clever_settings['single_embed_layout'];
            }
            $clever_class .= ' cp-embed-format ';
        }
        $clever_class .= $clever_layout;
        if ($clever_layout == 'right-sidebar' || $clever_layout == 'left-sidebar') {
            $clever_class .= ' has-sidebar ';
        }
        if ($clever_layout != 'full-screen' && $clever_layout != 'full-width') {
            ?>
            <div class="container">
            <?php
        }
        ?>
        <article id="portfolio-<?php the_ID(); ?>" <?php post_class($clever_class) ?>>
            <?php clever_get_template_part('clever-portfolio', 'single/' . $clever_format, $clever_layout . '-layout', true); ?>
        </article><!-- #post-## -->
        <?php
        if ($clever_layout != 'full-screen' && $clever_layout != 'full-width') {
            ?>
            </div>
            <?php
        }
    endwhile;
    ?>
</main>
<?php get_footer(); ?>
