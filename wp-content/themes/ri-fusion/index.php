<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */

get_header();

$rit_sidebar = $rit_class_main = $rit_class_content = $rit_class_sidebar = '';

$rit_sidebar = get_theme_mod('rit_default_sidebar', 'no-sidebar');
$rit_class_content = $rit_sidebar;

if ($rit_sidebar == 'no-sidebar') {
    $rit_class_main = 'col-sm-12';
} elseif ($rit_sidebar == 'right-sidebar'||$rit_sidebar == 'left-sidebar') {
    $rit_class_main = 'col-sm-9';
} else {
    $rit_class_main = 'col-sm-6';
}
$rit_breadcrumbs = '0';
if (is_single() || is_page()) {
    $rit_breadcrumbs = get_post_meta(get_the_ID(), 'rit_disable_breadcrumbs', true);
}
if (function_exists('bcn_display') && $rit_breadcrumbs != 1) { ?>
    <div class="breadcrumbs">
        <div class="container">
            <?php bcn_display(); ?>
        </div>
    </div>
<?php } ?>
<main id="main-page" class="wrap-main-page index-page">
    <div class="container">
        <div id="primary" class="content-area row <?php echo esc_attr($rit_class_content); ?>">
            <?php if ($rit_sidebar == 'left-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
            <div id="main" class="site-main <?php echo esc_attr($rit_class_main); ?>">
                <?php if (have_posts()) : ?>
            <?php if (!is_home() && !is_front_page()) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>
            <?php if (get_theme_mod('rit_default_layout', 'grid') == 'grid') { ?>
                <div class="rit-blog-grid-layout <?php echo esc_attr('layout-'.get_theme_mod('rit_default_post_col', 3).'-col')?> row">
                    <?php
                    } ?>
                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post();
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('content', get_theme_mod('rit_default_layout', 'grid'));

                        // End the loop.
                    endwhile;
                    // If no content, include the "No posts found" template.
                    else :
                        get_template_part('content', 'none');
                    endif;
                     if (get_theme_mod('rit_default_layout', 'grid') == 'grid') {
                        echo '</div>';
                    }
                    //Pagination
                    // Previous/next page navigation.
                    get_template_part('/included/templates/pagination');
                    ?>

                </div><!-- .site-main -->
                <?php if ($rit_sidebar == 'right-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                    <?php get_sidebar('right'); ?>
                <?php } ?>
            </div><!-- .content-area -->
        </div>
</main>
<?php
wp_enqueue_script('lazyload-master');
get_footer(); ?>
