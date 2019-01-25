<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */

get_header();

$rit_sidebar = $rit_class_main = $rit_class_content = $rit_class_sidebar = $rit_layout = '';

if (get_post_type() != 'portfolio') {
    if (get_post_meta(get_the_ID(), 'rit_post_layout', true) != 'use-default' && get_post_meta(get_the_ID(), 'rit_post_layout', true) != '') {
        $rit_layout = get_post_meta(get_the_ID(), 'rit_post_layout', true);
    } else {
        $rit_layout = get_theme_mod('rit_post_layout', 'normal');
    }
    if ($rit_layout == 'normal') {
        $rit_sidebar = get_theme_mod('rit_default_sidebar', 'right-sidebar');
    } else {
        $rit_sidebar = 'no-sidebar';
    }
}
$rit_class_content = $rit_sidebar;

if ($rit_layout == 'normal' || $rit_layout == '') {
    if ($rit_sidebar == 'no-sidebar') {
        $rit_class_main = 'col-xs-12';
    } elseif ($rit_sidebar == 'right-sidebar') {
        $rit_class_main = 'col-sm-9 col-xs-12';
    } elseif ($rit_sidebar == 'left-sidebar') {
        $rit_class_main = 'col-sm-9 col-xs-12';
    } else {
        $rit_class_main = 'col-sm-6 col-xs-12';
    }
}
?>
    <main id="main-page" class="wrap-main-single">
        <?php
            if ($rit_layout == 'normal' || $rit_layout == '') {
                $rit_class_content.=' row '
                ?>
                <div class="container">
            <?php } ?>
            <div id="primary" class="content-area <?php echo esc_attr($rit_class_content. ' ' . $rit_layout); ?>">
                <?php if ($rit_sidebar == 'left-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                    <?php get_sidebar(); ?>
                <?php } ?>
                <div id="detail-post" class="content-single <?php echo esc_attr($rit_class_main); ?>">
                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post();

                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        if($rit_layout != 'normal' && $rit_layout != ''):
                            get_template_part('content-single', '2');
                        else:
                            get_template_part('content', 'single');
                        endif;

                        // End the loop.
                    endwhile;
                    ?>

                </div><!-- .site-main -->
                <?php if ($rit_sidebar == 'right-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
                    <?php get_sidebar('right'); ?>
                <?php } ?>
            </div>
            <?php if ($rit_layout == 'normal' || $rit_layout == '') {
                ?>
                </div>
            <?php }
        ?>
    </main>
<?php get_footer(); ?>