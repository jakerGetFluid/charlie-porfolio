<?php
/**
 * Created by PhpStorm.
 * User: NTK
 * Date: 04-Aug-16
 * Time: 2:54 PM
 */
//Off canvas sidebar config
$rit_offsidebar = rit_offsidebar_config();
$rit_menuconfig = rit_menu_config();
?>
<div class="container">
    <div id="main-navigation" class="col-xs-12 col-sm-6">
        <?php
        wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'primary-2'));
        ?>
    </div>
    <div id="site-branding">
        <a id="menu-mobile-trigger" href="javascript:;"
           class="visible-sm visible-xs mobile-menu-icon canvas-icon <?php echo esc_attr($rit_menuconfig); ?>">
            <span class="wrap-bar">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </span>
            <i class="clever-icon-close"></i>
        </a>
        <?php get_template_part('included/templates/logo'); ?>
    </div>
    <div id="right-header"  class="col-xs-12 col-sm-6">
        <?php
        dynamic_sidebar('right-header');
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