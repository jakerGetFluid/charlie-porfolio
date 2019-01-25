<?php

/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
$rit_sidebar_right = get_theme_mod('rit_default_right_sidebar', 'sidebar-1');
if(is_single()) {
    if (get_post_meta(get_the_ID(), 'rit_sidebar_options', true) != 'use-default' && get_post_meta(get_the_ID(), 'rit_sidebar_options', true) != '') {
        $rit_sidebar_right = get_post_meta(get_the_ID(), 'rit_right_sidebar', true);
    }
}
?>

<?php if ( is_active_sidebar( $rit_sidebar_right ) ) : ?>
    <aside id="sidebar-right" class="widget-area col-xs-12 col-sm-3" role="complementary">
        <?php dynamic_sidebar( $rit_sidebar_right ); ?>
    </aside><!-- .widget-area -->
<?php endif; ?>
