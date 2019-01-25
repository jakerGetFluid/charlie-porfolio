<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
$rit_sidebar = $rit_class_main = $rit_class_content = $rit_class_sidebar = '';

$rit_sidebar = get_theme_mod('rit_default_sidebar', 'right-sidebar');
$rit_class_content = $rit_sidebar;

if ($rit_sidebar == 'no-sidebar') {
    $rit_class_main = 'col-sm-12';
} elseif ($rit_sidebar == 'right-sidebar') {
    $rit_class_main = 'col-sm-8';
} elseif ($rit_sidebar == 'left-sidebar') {
    $rit_class_main = 'col-sm-9';
} else {
    $rit_class_main = 'col-sm-5';
}
get_header(); ?>

<main id="main-page" class="wrap-main-archive">
    <div class="container">
        <div id="primary" class="content-area row <?php echo esc_attr($rit_class_content); ?>">
            <?php if ($rit_sidebar == 'left-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
            <div id="main" class="site-main <?php echo esc_attr($rit_class_main); ?>">
                <?php if (have_posts()) : ?>
                    <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s', 'ri-fusion'), get_search_query()); ?></h1>
                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post(); ?>
                        <?php
                        /*
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('content', 'list');
                        // End the loop.
                    endwhile;
                    get_template_part('/included/templates/pagination');
                // If no content, include the "No posts found" template.
                else:
                    get_template_part('content', 'none');
                endif;
                ?>
            </div>
            <?php if ($rit_sidebar == 'right-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                <?php get_sidebar('right'); ?>
            <?php } ?>
        </div>
    </div>
</main><!-- .site-main -->

<?php get_footer(); ?>
