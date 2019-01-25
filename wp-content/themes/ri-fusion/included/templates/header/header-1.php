<?php
//Header class
$rit_class_header = '';

$rit_header_position = get_theme_mod('rit_enable_header_absolute', false) ? 'absolute' : 'relative';
$rit_enable_header_fullwidth = get_theme_mod('rit_enable_header_fullwidth', '') == '1' ? 'header-fullwidth' : '';
if (is_page() || is_single()) {
    if (get_post_meta(get_the_ID(), 'rit_enable_header_absolute', true) == '1') {
        $rit_header_position = 'absolute';
    }
    if (get_post_meta(get_the_ID(), 'rit_enable_header_fullwidth', true) == '1') {
        $rit_enable_header_fullwidth = 'header-fullwidth';
    }
}
$rit_offsidebar = rit_offsidebar_config();
$rit_menuconfig = rit_menu_config();
$rit_class_header .= 'header-position-' . esc_attr($rit_header_position) . ' ' . $rit_enable_header_fullwidth;
?>
<div class="wrap-mobile-nav <?php echo esc_attr($rit_menuconfig != 'lightbox' ? 'off-block ' : ' ');
echo esc_attr($rit_menuconfig) ?>">
    <a id="close-nav" href="javascript:;" class="close-canvas"><i class="clever-icon-close"></i> </a>
    <div class="wrap-content-mobile-nav">
        <?php
        if ($rit_menuconfig != 'lightbox') {
            $rit_logo_url = get_theme_mod('rit_logo', '');
            if ($rit_logo_url != '') {
                ?>
                <p id="mobile-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo esc_url($rit_logo_url); ?>" alt="<?php bloginfo('name'); ?>"/>
                    </a>
                </p>
            <?php }
            get_template_part('/included/templates/search');
        }
        ?>
        <nav id="mobile-nav" class="primary-font">
            <?php wp_nav_menu(array('container_class' => 'canvas-menu', 'theme_location' => 'canvas')); ?>
        </nav>
    </div>
    <?php if ($rit_menuconfig != 'lightbox') { ?>
        <div class="wrap-footer-off-block">
            <?php
            get_template_part('/included/templates/copy', 'right');
            ?>
        </div>
    <?php } ?>
</div>
<?php
if ($rit_offsidebar != '0' && $rit_offsidebar != 'no') {
    ?>
    <aside id="off-sidebar" class="widget-area off-block">
        <span id="close-sidebar" class="close-canvas"><i class="clever-icon-close"></i> </span>
        <?php dynamic_sidebar('sidebar-static'); ?>
        <div class="wrap-footer-off-block">
            <?php
            get_template_part('/included/templates/social');
            get_template_part('/included/templates/sidebar-copy', 'right');
            ?>
        </div>
    </aside>
<?php }
//Sticky menu check
$rit_sticky = '';
if ($rit_menuconfig != 'stack-center') {
    if (get_theme_mod('rit_enable_sticky_header', '1')) {
        $rit_sticky = ' sticker ';
    }
    if (is_page() || is_single()) {

        if (get_post_meta(get_the_ID(), 'rit_enable_sticky_header', true) == '1') {
            $rit_sticky = ' sticker ';
        }
    }
}
?>
<div class="wrap-body-content <?php echo esc_attr($rit_class_header . ' ' . $rit_menuconfig . '-style'); ?>">
    <header id="header" class="wrap-header <?php echo esc_attr($rit_sticky); ?>">
        <?php if ($rit_menuconfig == 'center') {
            get_template_part('/included/templates/header/menu-styles/center', 'style');
        } elseif ($rit_menuconfig == 'stack-center') {
            get_template_part('/included/templates/header/menu-styles/stack-center', 'style');
        } elseif ($rit_menuconfig == 'logo-center') {
            get_template_part('/included/templates/header/menu-styles/logo-center', 'style');
        } else {
            ?>
            <div class="container">
                <div id="site-branding" class="col-sm-3 col-xs-12">
                    <a id="menu-mobile-trigger" href="javascript:;"
                       class="visible-sm visible-xs mobile-menu-icon canvas-icon <?php echo esc_attr($rit_menuconfig); ?>">
            <span class="wrap-bar">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </span>
                        <i class="clever-icon-close"></i>
                    </a>
                    <?php get_template_part('included/templates/logo'); ?>
                </div>
                <div id="main-navigation" class="col-sm-9">
                    <?php
                    if ($rit_menuconfig == 'default') {
                        wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'primary'));
                    }
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
            <?php
        }
        ?>
    </header>
