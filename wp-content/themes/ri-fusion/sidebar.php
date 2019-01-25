<?php

/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
$rit_sidebar_left = get_theme_mod('rit_default_left_sidebar', 'sidebar-1');
if(is_single()) {
    if (get_post_meta(get_the_ID(), 'rit_sidebar_options', true) != 'use-default' && get_post_meta(get_the_ID(), 'rit_sidebar_options', true) != '') {
        $rit_sidebar_left = get_post_meta(get_the_ID(), 'rit_left_sidebar', true);
    }
}?>

<?php if ( is_active_sidebar( $rit_sidebar_left ) ) : ?>
    <aside id="sidebar-left" class="widget-area col-xs-12 col-sm-3" role="complementary">
        <?php dynamic_sidebar( $rit_sidebar_left ); ?>
    </aside><!-- .widget-area -->
<?php endif; ?>
