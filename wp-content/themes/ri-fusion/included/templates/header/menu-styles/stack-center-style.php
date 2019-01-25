<?php
/**
 * Menu stack center style.
 * Template of ri fusion
 * Ver: 1.0
 */
$rit_offsidebar = rit_offsidebar_config();
$rit_menuconfig = rit_menu_config();
$rit_sticky='';
if (get_theme_mod('rit_enable_sticky_header', '1')) {
    $rit_sticky = ' sticker ';
}
if (is_page() || is_single()) {

    if (get_post_meta(get_the_ID(), 'rit_enable_sticky_header', true) == '1') {
        $rit_sticky = ' sticker ';
    }
}
?>
<div class="container">
    <div id="site-branding" class="col-sm-12">
        <a id="menu-mobile-trigger" href="javascript:;"
           class="visible-sm visible-xs mobile-menu-icon canvas-icon <?php echo esc_attr($rit_menuconfig); ?>">
            <span class="wrap-bar">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </span>
            <i class="clever-icon-close"></i>
        </a>
        <?php get_template_part('included/templates/logo'); ?>
    </div>
    <div id="main-navigation" class="col-xs-12 <?php echo esc_attr($rit_sticky)?>">
        <?php
        wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'primary'));
        ?>
        <?php
        if ($rit_offsidebar != '0' && $rit_offsidebar != 'no') {
            ?>
            <div id="sidebar-trigger" class="canvas-icon">
                <div class="wrap-bar">
                    <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                </div>
                <i class="clever-icon-close"></i>
            </div>
        <?php } ?>
    </div>
</div>