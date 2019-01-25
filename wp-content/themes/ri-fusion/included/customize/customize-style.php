<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function rit_customizer_css()
{ ?>
    <style type="text/css">

        <?php
            $font_family = (get_theme_mod('rit_body_font_select', 'google') == 'google') ? get_theme_mod('rit_body_font_google', 'Oswald') : get_theme_mod('rit_body_font_standard', 'Arial');
            $rit_custom_primary_color = get_theme_mod('rit_accent_color', '#252525');
            $rit_nav_link_hover_color = get_theme_mod('rit_nav_link_hover_color', '#252525');
            $rit_nav_sub_bg_color = get_theme_mod('rit_nav_sub_bg_color', '#363636');
            $rit_body_link_hover_color = get_theme_mod('rit_body_link_hover_color', '#252525');
            $rit_copyright_link_hover_color = get_theme_mod('rit_copyright_link_hover_color', '#252525');
            $font_body = $font_heading = '';

            if(get_theme_mod('rit_body_font_select', 'google') == 'google' || get_theme_mod('rit_heading_font_select', 'google') == 'google' || get_theme_mod('rit_heading_font_select', 'google') == 'google'){
                $google_body_default = array('family' => 'Roboto Mono', 'variants' => array('400','500','700'), 'subsets' => array('latin'));
                $google_heading_default = array('family' => 'Oswald', 'variants' => array('400','300'), 'subsets' => array('latin'));
                $google_body = json_decode(get_theme_mod('rit_body_font_google', json_encode($google_body_default)), true);
                $google_heading = json_decode(get_theme_mod('rit_heading_font_google', json_encode($google_heading_default)), true);
                $font_array = array(
                    'rit_body_font_google' => $google_body,
                    'rit_heading_font_google' => $google_heading,
                );
                wp_enqueue_style('rit-google-font', rit_create_google_font_url($font_array));
            }
            if(get_theme_mod('rit_body_font_select', 'google') == 'standard'){
                $font_body = get_theme_mod('rit_body_font_standard', 'Arial');
            } else {
                if(isset($google_body['family'])){
                    $font_body = $google_body['family'];
                }
            }
            if(get_theme_mod('rit_heading_font_select', 'google') == 'standard'){
                $font_heading = get_theme_mod('rit_heading_font_standard', 'Arial');
            } else {
                if(isset($google_heading['family'])){
                    $font_heading = $google_heading['family'];
                }
            }
        ?>
        body, .body-font.primary-font, .body-font, .rit-name {
            font-family: "<?php echo esc_attr($font_body); ?>", sans-serif;
        }

        #right-header .widget_nav_menu,
        #infscr-loading, .btn-ajax-load, .envira-album-title, #main-navigation, .primary-font, h1, h2, h3, h4, h5, h6, .title, .readmore, .btn, button, .button, input[type="button"], input[type="submit"],
        .logged-in-as a, blockquote, .quote, q, .border-button, .single-envira #envirabox-buttons ul li#envirabox-buttons-title span {
            font-family: "<?php echo esc_attr($font_heading); ?>", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .title-block, .title-single-block, #reply-title, .comment-reply-title {
            font-size: <?php echo esc_attr(get_theme_mod('rit_fontsize_block', '21')) . 'px' ?>;
        }

        .widget-title {
            font-size: <?php echo esc_attr(get_theme_mod('rit_fontsize_title_widget', '24')) . 'px' ?>;
        }

        .site-footer .widget-title {
            font-size: <?php echo esc_attr(get_theme_mod('rit_fontsize_title_widget_footer', '16')) . 'px' ?>;
        }

        .title-detail {
            font-size: <?php echo esc_attr(get_theme_mod('rit_fontsize_single_post_title', '36')). 'px' ?>;
        }

        <?php
        //Page Large width
        $max_width=get_theme_mod('rit_enable_large_width','1170');
        if(is_page() && get_post_meta(get_the_ID(),'rit_enable_large_width',true)!="0"&& get_post_meta(get_the_ID(),'rit_enable_large_width',true)!=""){
            $max_width=get_post_meta(get_the_ID(),'rit_enable_large_width',true);
        }
        if(is_single() && get_post_meta(get_the_ID(),'rit_enable_large_width',true)!="0"&& get_post_meta(get_the_ID(),'rit_enable_large_width',true)!=""){
            $max_width=get_post_meta(get_the_ID(),'rit_enable_large_width',true);
        }
        ?>

        @media (min-width: 1200px) {
            .ri-fusion.clever-p-main .container,
            .container {
                max-width: <?php echo esc_attr($max_width)?>px;
                width: 100%;
            }
        }

        <?php
        if(get_theme_mod('rit_header_position','relative')=='absolute'){
        ?>
        .cover-post-image .title-detail {
            font-size: <?php echo esc_attr(get_theme_mod('rit_fontsize_single_post_title', '36')). 'px' ?>;
        }

        <?php
        }
        ?>

        .title-post {
            font-size: <?php echo esc_attr(get_theme_mod('rit_fontsize_post_title', '18')). 'px' ?>;
        }

        .title-gallery {
            font-size: <?php echo esc_attr(get_theme_mod('rit_fontsize_gallery_title', '21')). 'px' ?>;
        }

        <?php // ---------  Accent Color ------------ // ?>
        .accent, .accent-color, .tags-link-wrap a, .single-section, .logged-in-as a, .tagcloud a, .gallery-list-info li, .comments-navigation .page-numbers li a  {
            color: <?php echo esc_attr($rit_custom_primary_color); ?>;
        }

        .wrapper-status-order li.active span.step, .tags-link-wrap a:hover, .tagcloud a:hover{
            background: <?php echo esc_attr($rit_custom_primary_color); ?>;
        }

        .wrapper-status-order li.active i {
            border-color: <?php echo esc_attr($rit_custom_primary_color); ?>;
            color: <?php echo esc_attr($rit_custom_primary_color); ?>;
        }
        .comments-navigation .page-numbers li span, .comments-navigation .page-numbers li a:hover{
            border-color: <?php echo esc_attr($rit_custom_primary_color); ?>;
            background: <?php echo esc_attr($rit_custom_primary_color); ?>;
        }

        .wrapper-status-order li.active:after {
            border-color: <?php echo esc_attr($rit_custom_primary_color); ?>;
        }

        .btn, button,
        input[type="button"], input[type="submit"] {
            color: <?php echo esc_attr(get_theme_mod('rit_button_flat_color', '#fff')); ?>;
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_flat_bg', '#252525')); ?>;
        }

        .btn:hover, input[type="submit"]:hover, input[type="submit"]:hover, .comment-form #submit:hover, .ajax-func:hover, .btn-ajax-load:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_button_flat_hover', '#252525')); ?>;
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_flat_bg_hover', '#f5f5f5')); ?>;
        }

        .readmore a, .readmore, .border-button {
            color: <?php echo esc_attr(get_theme_mod('rit_button_cross_color', '#252525')); ?>;
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_cross_bg_color', '#fff')); ?>;
            border-color: <?php echo esc_attr(get_theme_mod('rit_button_cross_border', '#252525')); ?>;
        }

        .readmore a:before, .border-button:before {
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_cross_color', '#252525')); ?>;
        }

        .readmore a:hover, .readmore:hover, .border-button {
            color: <?php echo esc_attr(get_theme_mod('rit_button_cross_color_hover', '#252525')); ?>;
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_cross_bg_color_hover', '#fff')); ?>;
            border-color: <?php echo esc_attr(get_theme_mod('rit_button_cross_border_hover', '#252525')); ?>;
        }

        .readmore:hover a:before, .border-button:hover:before {
            background-color: <?php echo esc_attr(get_theme_mod('rit_button_cross_color_hover', '#252525')); ?>;
        }

        .rit-full-layout .info-cat a,
        .entry-action a:hover,
        .tparrows.rit-navigation:hover,
        .rit-news-inner .readmore a:hover,
        .comment-form input[type="text"]:focus,
        .comment-form input[type="email"]:focus,
        .comment-form input[type="url"]:focus,
        .comment-form textarea:focus,
        .woocommerce .woocommerce-message,
        .woocommerce .woocommerce-info,
        .woocommerce form .form-row.woocommerce-validated .select2-container,
        .woocommerce form .form-row.woocommerce-validated input.input-text,
        .woocommerce form .form-row.woocommerce-validated select,
        .rit-icon-box-item .icon {
            border-color: <?php echo esc_attr($rit_custom_primary_color); ?> !important;
        }

        .rit-icon-box-item .icon:before {
            border-color: transparent transparent <?php echo esc_attr($rit_custom_primary_color); ?> transparent;
        }

        .rit-course-boxed .course-percent-progress span:before {
            border-color: <?php echo esc_attr($rit_custom_primary_color); ?> transparent transparent transparent;
        }

        .portfolio-pagination a, .widget a, .default .portfolio-item .list-cat a, .rit-portfolio.style-1 .title a,
        .post-pagination a, .author-content .author-social a, .author-name a {
            color: <?php echo esc_attr($rit_custom_primary_color); ?>;
        }

        .portfolio-pagination a:hover, .author-content .author-social a:hover, .post-pagination a:hover,
        .widget a:hover, .rit-portfolio.style-1 .title a:hover, .comment-form a:hover,
        .post-info, .post-date, .post-pagination span, .single-section a:hover, .author-name a:hover, .author-social a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_sec_color', '#acacac')); ?>
        }

        .widget-area .widget_newsletterwidget {
            border-color: <?php echo esc_attr(get_theme_mod('rit_border_color', '#ebebeb')); ?>
        }

        .pagination a,
        .post-related, .single-section, .rit-about-me .wrap-social-icon, .text-field, .search-field,
        input[type="text"], input[type="email"], input[type="password"], .tags-link-wrap a, .tagcloud a {
            border-color: <?php echo esc_attr(get_theme_mod('rit_border_color', '#ebebeb')); ?>
        }

        .tags-link-wrap a:hover, .tagcloud a:hover {
            border-color: <?php echo esc_attr($rit_custom_primary_color); ?>
        }

        .layout-vertical .rit-icon-box-item .icon,
        .contact-section i,
        .post-related h5:after,
        .comments h5:after,
        .comment-respond h3:after,
        input[type="reset"],
        .tparrows.rit-navigation:hover,
        .rit-navigation .tp-bullet,
        .vc_tta.vc_general .rit-accordion.vc_active .vc_tta-panel-title > a,
        .rit-icon-box-item .icon,
        .style-boxed .rit-icon-box-item .icon,
        .widget-title:after,
        {
            background-color: <?php echo esc_attr($rit_custom_primary_color); ?>
        }

        .share-links .social-icon:hover {
            background-color: <?php echo esc_attr($rit_custom_primary_color); ?>;
            border-color: <?php echo esc_attr($rit_custom_primary_color); ?>
        }

        .bg-accent, .rit-widget-social-icon.text:before {
            background-color: <?php echo esc_attr($rit_custom_primary_color); ?> !important;
        }

        .slider-boxed .feat-overlay .feat-cat {
            border-bottom: 1px solid <?php echo esc_attr($rit_custom_primary_color); ?>;
        }

        a {
            color: <?php echo esc_attr(get_theme_mod('rit_body_link_color', '#DC9814')); ?>;
        }

        a:hover {
            color: <?php echo esc_attr($rit_body_link_hover_color); ?>;
        }

        h1 {
            color: <?php echo esc_attr(get_theme_mod('rit_body_h1_color', '#252525')); ?>;
            font-size: <?php echo esc_attr(get_theme_mod('rit_font_size_h1', '36')) . 'px' ?>;
        }

        h2, h2 a {
            color: <?php echo esc_attr(get_theme_mod('rit_body_h2_color', '#252525')); ?>;
            font-size: <?php echo esc_attr(get_theme_mod('rit_font_size_h2', '30')) . 'px' ?>;
        }

        h3 {
            font-size: <?php echo esc_attr(get_theme_mod('rit_font_size_h3', '24')) . 'px' ?>;
            color: <?php echo esc_attr(get_theme_mod('rit_body_h3_color', '#252525')); ?>;
        }

        h4 {
            color: <?php echo esc_attr(get_theme_mod('rit_body_h4_color', '#252525')); ?>;
            font-size: <?php echo esc_attr(get_theme_mod('rit_font_size_h4', '18')) . 'px' ?>;
        }

        h5 {
            color: <?php echo esc_attr(get_theme_mod('rit_body_h5_color', '#252525')); ?>;
            font-size: <?php echo esc_attr(get_theme_mod('rit_font_size_h5', '16')) . 'px' ?>;
        }

        h6 {
            color: <?php echo esc_attr(get_theme_mod('rit_body_h6_color', '#252525')); ?>;
            font-size: <?php echo esc_attr(get_theme_mod('rit_font_size_h6', '14')) . 'px' ?>;
        }

        <?php // ---------  Body ------------ // ?>
        body, .entry-content p, .entry-content li {
            color: <?php echo esc_attr(get_theme_mod('rit_body_text_color', '#494949')); ?>;
        }

        body {
            font-size: <?php echo esc_attr(get_theme_mod('rit_enable_body_font_size', '14')); ?>px;
            line-height: <?php echo esc_attr(get_theme_mod('rit_enable_bodyline_height', '26')); ?>px;
            background-color: <?php echo esc_attr(get_theme_mod('rit_body_bg_color', '#ffffff')); ?>;
        <?php if(get_theme_mod('rit_body_bg_image', '')){ ?> background-image: url(<?php echo esc_url(get_theme_mod('rit_body_bg_image', '')); ?>);
            background-repeat: <?php echo esc_attr(get_theme_mod('rit_body_bg_repeat', 'repeat')); ?>;
            background-size: <?php echo esc_attr(get_theme_mod('rit_body_bg_size', 'auto')); ?>;
            background-attachment: <?php echo esc_attr(get_theme_mod('rit_body_bg_attachment', 'scroll')); ?>;
        <?php } ?>
        }

        #content {
            background-color: <?php echo esc_attr(get_theme_mod('rit_page_background_color', 'transparent')); ?>;
        <?php if(get_theme_mod('rit_page_bg', '')){ ?> background-image: url(<?php echo esc_url(get_theme_mod('rit_page_bg', '')); ?>);
            background-repeat: <?php echo esc_attr(get_theme_mod('rit_page_bg_repeat', 'repeat')); ?>;
            background-size: <?php echo esc_attr(get_theme_mod('rit_page_bg_size', 'auto')); ?>;
            background-attachment: <?php echo esc_attr(get_theme_mod('rit_page_bg_attachment', 'scroll')); ?>;
        <?php } ?>
        }

        .layout-vertical .rit-icon-box-item .icon {
            border-color: <?php echo esc_attr(get_theme_mod('rit_body_bg_color', '#ffffff')); ?>;;
        }

        .readmore a, blockquote p, .rit-pagination ul li,
        .share-links ul li, .single-section .share-links span, .post-comment, .single-section a {
            color: <?php echo esc_attr(get_theme_mod('rit_primary_color', '#252525')); ?>;
        }

        .wrap-contact-socail .vc_icon_element:after {
            background-color: <?php echo esc_attr(get_theme_mod('rit_primary_color', '#252525')); ?>;
        }

        <?php // ---------  Header ------------ // ?>
        <?php
            $rit_header_height = get_theme_mod('rit_header_height', '120');
            if(get_post_meta(get_the_ID(), 'rit_header_height', true) != ''){
                $rit_header_height = get_post_meta(get_the_ID(), 'rit_header_height', true);
            }
        ?>
        .wrap-header {
            color: <?php echo esc_attr(get_theme_mod('rit_header_text_color', '#353535')); ?>;
        }

        .cover-post-image .header-post {
            margin-top: <?php echo esc_attr($rit_header_height/2); ?>px;
        }

        <?php
        $rit_header_transparent=false;
            $rit_custom_bg_header = ri_fusion_hex2rgba(get_theme_mod('rit_header_background_color', '#fff'),get_theme_mod('rit_header_background_color_opc', '1'));
            $header_color_border = ri_fusion_hex2rgba(get_theme_mod('rit_header_border_color', '#ebebeb'),get_theme_mod('rit_header_border_color_opc', '1'));
            $rit_custom_bg_header_sticky=ri_fusion_hex2rgba(get_theme_mod('rit_header_sticky_background_color', '#fff'),get_theme_mod('rit_header_sticky_background_color_opc', '1'));
            if(is_single()||is_page()){
                if (get_post_meta(get_the_ID(), 'rit_enable_header_absolute', true) == '1') {
                    $rit_header_transparent = true;
                }
                if(get_post_meta(get_the_ID(),'rit_enable_header_color',true)=='1'){
                    $rit_header_transparent=false;
                    $rit_custom_bg_header = ri_fusion_hex2rgba(get_post_meta(get_the_ID(), 'rit_custom_bg_header', true),get_post_meta(get_the_ID(), 'rit_custom_bg_header_opc', true));
                    $rit_custom_bg_header_sticky = ri_fusion_hex2rgba(get_post_meta(get_the_ID(), 'rit_bg_sticky_header', true),get_post_meta(get_the_ID(), 'rit_bg_sticky_header_opc', true));
                    $header_color_border=ri_fusion_hex2rgba(get_post_meta(get_the_ID(), 'rit_header_border_color', true),get_post_meta(get_the_ID(), 'rit_header_border_color_opc', true));
                }
            }
            //Header bg
            if(!$rit_header_transparent){
        ?>
        #header, #header-sticky-wrapper, .header-position-absolute #header, .header-position-absolute #header-sticky-wrapper {
            background-color: <?php echo esc_attr($rit_custom_bg_header); ?>;
        }
        <?php
        if(rit_menu_config()=='stack-center'){?>
        .stack-center-style #header.wrap-header .container:after {
            background-color: <?php echo esc_attr($header_color_border);?>;
        }

        <?php }else{?>
        #header.wrap-header .container:before, .header-position-absolute #header.wrap-header .container:before {
            background-color: <?php echo esc_attr($header_color_border);?>;
        }

        <?php }

        //End Header bg
        ?>

        #header-sticky-wrapper.is-sticky #header, #main-navigation-sticky-wrapper.is-sticky #main-navigation, .header-position-absolute #header-sticky-wrapper.is-sticky #header,
        .header-position-absolute #main-navigation-sticky-wrapper.is-sticky #main-navigation {
            background-color: <?php echo esc_attr($rit_custom_bg_header_sticky)?>;
        }

        <?php }?>
        .wrap-body-content:not(.header-transparent).is-sticky #header {
            opacity: <?php echo esc_attr(get_theme_mod('rit_header_opacity', '0.9')); ?>;
        }

        .wrap-header a {
            color: <?php echo esc_attr(get_theme_mod('rit_header_link_color', '#252525')); ?>;
        }

        .wrap-header a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_header_link_hover_color', '#252525')); ?>;
        }

        <?php if(rit_menu_config()=='stack-center'){?>
        #header.wrap-header .container {
            height: <?php echo esc_attr($rit_header_height) . 'px'; ?>
        }

        <?php }else{?>
        #main-navigation > div > ul > li > a, #right-header .widget_nav_menu > div > ul > li > a {
            line-height: <?php echo esc_attr($rit_header_height) . 'px'; ?>
        }

        #header.wrap-header {
            height: <?php echo esc_attr($rit_header_height) . 'px'; ?>
        }

        <?php }?>
        @media (max-width: 768px) {
            #right-header .widget_nav_menu > div > ul > li > a, #main-navigation .main-menu > #menu-all-pages > li > a, #main-navigation #menu-main-menu > li > a, #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link, #main-navigation .menu > ul > li > a {
                line-height: <?php echo esc_attr(get_theme_mod('rit_header_mobile_height', '80')) . 'px'; ?>
            }

            #header.wrap-header, #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link, #main-navigation .menu > ul > li > a {
                height: <?php echo esc_attr(get_theme_mod('rit_header_mobile_height', '80')) . 'px'; ?>
            }
        }

        <?php
        $header_stikcy_height=get_theme_mod('rit_header_sticky_height', '80');
        if(is_page()||is_single()){
            if(get_post_meta(get_the_ID(),'rit_header_sticky_height',true)!=''){
            $header_stikcy_height=get_post_meta(get_the_ID(),'rit_header_sticky_height',true);
            }
        }
        ?>
        .is-sticky #main-navigation .main-menu > #menu-all-pages > li > a, .is-sticky #main-navigation #menu-main-menu > li > a, .is-sticky #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link, .is-sticky #main-navigation .menu > ul > li > a {
            line-height: <?php echo esc_attr($header_stikcy_height) . 'px'; ?>
        }

        .is-sticky #header.wrap-header, .is-sticky #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link, .is-sticky #main-navigation .menu > ul > li > a {
            height: <?php echo esc_attr($header_stikcy_height) . 'px'; ?>
        }

        <?php // ---------  Main Navigation ------------ // ?>
        #main-navigation, #right-header > .widget_nav_menu > div > ul {
            background-color: <?php echo esc_attr(get_theme_mod('rit_nav_bg_color', 'transparent')); ?>;
            color: <?php echo esc_attr(get_theme_mod('rit_nav_text_color', '#252525')); ?>;
        }
        <?php
            $rit_custom_color_link_header = get_theme_mod('rit_nav_link_color', '#252525');
            if(is_single()||is_page()){
            if(get_post_meta(get_the_ID(),'rit_enable_header_color',true)=='1'){
                $rit_custom_color_link_header=get_post_meta(get_the_ID(),'rit_header_color',true);
                $rit_nav_link_hover_color=get_post_meta(get_the_ID(),'rit_header_color_hover',true);
            }}

        ?>
        #main-navigation li a, #right-header > .widget_nav_menu a,
        .header-position-absolute #main-navigation > div > ul > li:hover > a,
        .header-position-absolute #main-navigation > div > ul > li > a{
            font-size: <?php echo esc_attr(get_theme_mod('rit_enable_menu_font_size', '14')); ?>px;
            <?php  if(!$rit_header_transparent){?>color: <?php echo esc_attr($rit_custom_color_link_header); }?>
        }

        <?php
        if(get_theme_mod('header_image','')!=''){
        ?>
        #header.wrap-header {
            background: url('<?php echo esc_url(get_theme_mod('header_image',''))?>') center center/cover no-repeat;
        }

        <?php } if(!$rit_header_transparent){?>
        #main-navigation > div > ul > li > a:hover, #main-navigation li.current-menu-item a,
        #right-header > .widget_nav_menu li.current-menu-item a,
        .header-position-absolute #main-navigation > div > ul > li > a:hover, .header-position-absolute #main-navigation li.current-menu-item a,
        .header-position-absolute #right-header > .widget_nav_menu li.current-menu-item a {
            color: <?php echo esc_attr($rit_nav_link_hover_color); ?>
        }

        .bar,.header-position-absolute .canvas-icon .bar{
            background: rgba(0, 0, 0, 0) linear-gradient(to right, <?php echo esc_attr($rit_custom_color_link_header); ?> 0%, <?php echo esc_attr($rit_custom_color_link_header); ?> 33.333%, transparent 33.333%, transparent 66.666%, <?php echo esc_attr($rit_custom_color_link_header); ?> 66.666%, <?php echo esc_attr($rit_custom_color_link_header); ?> 100%) repeat scroll 0 0;
        }

        #main-navigation > div > ul > li > a:before, #right-header > .widget_nav_menu > div > ul > li > a:before,
        .header-position-absolute #main-navigation > div > ul > li > a:before, .header-position-absolute #right-header > .widget_nav_menu > div > ul > li > a:before {
            background: <?php echo esc_attr($rit_nav_link_hover_color); ?>
        }
        <?php }?>
        #main-navigation .sub-menu li,
        #main-navigation .children li, #right-header > .widget_nav_menu .sub-menu li {
            background-color: <?php echo esc_attr($rit_nav_sub_bg_color); ?>;
        }

        #main-navigation .sub-menu li:hover,
        #main-navigation .children li:hover, #right-header > .widget_nav_menu .sub-menu li:hover {
            background-color: <?php echo esc_attr(get_theme_mod('rit_nav_sub_bg_color_hover', '#363636')); ?>
        }

        #main-navigation .sub-menu li a,
        #main-navigation .children li a, #right-header > .widget_nav_menu .sub-menu li a {
            color: <?php echo esc_attr(get_theme_mod('rit_nav_sub_link_color', '#d7d7d7')); ?>
        }

        #main-navigation .sub-menu li a:hover,
        #main-navigation .children li a:hover, #right-header > .widget_nav_menu .sub-menu li a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_nav_sub_link_hover_color', '#fff')); ?>
        }

        <?php // ---------  Logo ------------ // ?>
        <?php
        $hasLogo = false;
        if (is_single() || is_page()) {
        if (get_post_meta(get_the_ID(), 'rit_logo_page', true) != '' && get_post_meta(get_the_ID(), 'rit_logo_page', true) != 0):
            $hasLogo = true;
        endif;
        }
        if($hasLogo){
        ?>
        #logo {
            padding-top: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_logo_page_top', true).'px')?>;
            padding-bottom: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_logo_page_bottom', true).'px');;?>;
        <?php if(get_post_meta(get_the_ID(),'rit_logo_page_height')){ ?> height: <?php echo esc_attr(get_post_meta(get_the_ID(),'rit_logo_page_height',true).'px');}?>
        }

        <?php
        }
        else{
        ?>
        #logo {
            padding-top: <?php echo esc_attr(get_theme_mod('rit_logo_top_spacing', 0).'px')?>;
            padding-bottom: <?php echo esc_attr(get_theme_mod('rit_logo_bottom_spacing', 0).'px');;?>;
        }

        <?php
        } ?>
        <?php // ---------  Color - Breadcrumb  ------------ // ?>
        .breadcrumbs {
            background-color: <?php echo esc_attr(get_theme_mod('rit_breadcrumb_bg_color', '#f3f3f3')); ?>;
        }

        .breadcrumbs span, .breadcrumbs {
            color: <?php echo esc_attr(get_theme_mod('rit_breadcrumb_color', '#252525')); ?>;
        }

        .breadcrumbs a {
            color: <?php echo esc_attr(get_theme_mod('rit_breadcrumb_link_color', '#7d7d7d')); ?>;
        }

        .breadcrumbs a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_breadcrumb_link_hover_color', '#00aeef')); ?>;
        }

        .breadcrumbs .separator {
            color: <?php echo esc_attr(get_theme_mod('rit_breadcrumb_separator_color', '#7d7d7d')); ?>;
        }

        <?php if(get_theme_mod('rit_heading_divider', '')) { ?>
        <?php // ---------  Divider ------------ // ?>
        [id*="sidebar-"] .widget-title:after {
            background-image: url(<?php echo esc_url(get_theme_mod('rit_heading_divider', '')); ?>);
        }

        <?php } ?>

        <?php // ---------  Footer ------------ // ?>
        <?php
            $rit_custom_bg_footer = get_theme_mod('rit_footer_center_bg', '#F5F5F5');
            $rit_custom_footer_text = get_theme_mod('rit_footer_center_color', '#252525');
            $rit_custom_footer_link = get_theme_mod('rit_footer_center_link', '#252525');
        ?>
        #footer-page {
            background-color: <?php echo esc_attr($rit_custom_bg_footer); ?>;
            color: <?php echo esc_attr($rit_custom_footer_text); ?>;
        }

        #footer-page a {
            color: <?php echo esc_attr($rit_custom_footer_link); ?>;
        }

        #footer-page a:hover {
            color: <?php echo esc_attr(get_theme_mod('rit_footer_center_link_hover', '#252525')); ?>;
        }

        #footer-page .widget-title, #footer-page h1, #footer-page h2, #footer-page h3, #footer-page h4, #footer-page h5, #footer-page h6 {
            color: <?php echo esc_attr( get_theme_mod('rit_footer_center_heading_color', '#252525')); ?>;
        }

        <?php // ---------  Copy Right ------------ // ?>
        <?php
            $rit_custom_bg_copyright = get_theme_mod('rit_copyright_bg_color', '#F5F5F5');
            $rit_custom_copyright_text = get_theme_mod('rit_copyright_text_color', '#494949');
            $rit_custom_copyright_link = get_theme_mod('rit_copyright_link_color', '#494949');
        ?>
        .site-footer .copyright {
            background-color: <?php echo esc_attr($rit_custom_bg_copyright); ?>;
            color: <?php echo esc_attr($rit_custom_copyright_text); ?>;
        }

        #footer-page .copyright a {
            color: <?php echo esc_attr($rit_custom_copyright_link); ?>;
        }

        #footer-page .copyright a:hover {
            color: <?php echo esc_attr($rit_copyright_link_hover_color); ?>;
        }

        <?php
        if (class_exists('WooCommerce')) {
        ?>
        .product-name {
            color: <?php echo esc_attr( get_theme_mod('rit_color_product_name_cat', '#7d7d7d')); ?>;
        }

        .product-name:hover {
            color: <?php echo esc_attr( get_theme_mod('rit_color_hover_product_name_cat', '#252525')); ?>;
        }

        .woocommerce .star-rating {
            color: <?php echo esc_attr( get_theme_mod('rit_color_star', '#ffca00')); ?>;
        }

        .amount {
            color: <?php echo esc_attr( get_theme_mod('rit_color_price', '#252525')); ?>;
        }

        .price del .amount {
            color: <?php echo esc_attr( get_theme_mod('rit_color_price_old', '#959595')); ?>;
        }

        <?php }
                /*Portfolio custom*/
         if(get_theme_mod('rit_fontsize_portfolio_title','')!=''){?>
        .rit-portfolio .portfolio-info .title a {
            font-size: <?php echo esc_attr( get_theme_mod('rit_fontsize_portfolio_title','')); ?>px;
        }

        <?php }?>
        <?php if(get_theme_mod('rit_color_portfolio_title','')!=''){?>
        .rit-portfolio.portfolio-info .title a {
            color: <?php echo esc_attr( get_theme_mod('rit_color_portfolio_title','')); ?>;
        }

        <?php }?>
        <?php if(get_theme_mod('rit_color_portfolio_title_hover','')!=''){?>
        .rit-portfolio .portfolio-info .title a:hover {
            color: <?php echo esc_attr( get_theme_mod('rit_color_portfolio_title_hover','')); ?>;
        }

        <?php }?>
        <?php if(get_theme_mod('rit_fontsize_portfolio_categories','')!=''){?>
        .rit-portfolio .portfolio-info .list-cat a {
            font-size: <?php echo esc_attr( get_theme_mod('rit_fontsize_portfolio_categories','')); ?>px;
        }

        <?php }?>
        <?php if(get_theme_mod('rit_color_portfolio_categories','')!=''){?>
        .rit-portfolio .portfolio-info .list-cat a {
            color: <?php echo esc_attr( get_theme_mod('rit_color_portfolio_categories','')); ?>;
        }

        <?php }?>
        <?php if(get_theme_mod('rit_color_portfolio_categories_hover','')!=''){?>
        .rit-portfolio .portfolio-info .list-cat a:hover {
            color: <?php echo esc_attr( get_theme_mod('rit_color_portfolio_categories_hover','')); ?>;
        }

        <?php }?>
        <?php if(get_theme_mod('rit_color_portfolio_title_detail','')!=''){?>
        .clever-p-single .title-portfolio, .portfolio-detail .title-portfolio{
            color: <?php echo esc_attr( get_theme_mod('rit_color_portfolio_title_detail','')); ?>;
        }

        <?php }?>
        <?php if(get_theme_mod('rit_fontsize_portfolio_title_detail','')!=''){?>
        .clever-p-single .title-portfolio, .portfolio-detail .title-portfolio {
            font-size: <?php echo esc_attr( get_theme_mod('rit_fontsize_portfolio_title_detail','')); ?>px;
        }

        <?php }?>
        /*End Portfolio custom*/
        .rit-blog-item .title-post a, .recent-post-item-text a, .item-related .title a {
            color: <?php echo esc_attr( get_theme_mod('rit_color_blog_title', '#252525')); ?>;
        }

        .rit-blog-item .title-post a:hover, .recent-post-item-text a:hover, .item-related .title a:hover {
            color: <?php echo esc_attr( get_theme_mod('rit_color_blog_title_hover', '#acacac')); ?>;
        }

        <?php if(get_theme_mod('rit_color_blog_categories', '')!='')
        {?>
        .rit-blog-item .list-cat a, .content-single .list-cat a {
            color: <?php echo esc_attr( get_theme_mod('rit_color_blog_categories', '#acacac')); ?>;
        }

        <?php }  if(get_theme_mod('rit_color_blog_categories_hover', '')!='') {?>
        .rit-blog-item .list-cat a:hover, .content-single .list-cat a:hover {
            color: <?php echo esc_attr( get_theme_mod('rit_color_blog_categories_hover', '#252525')); ?>;
        }

        <?php
         }if(get_theme_mod('rit_color_blog_title_detail', '')!='')
         {?>
        .post .header-post .title-detail {
            color: <?php echo esc_attr( get_theme_mod('rit_color_blog_title_detail', '#252525')); ?>;
        }

        <?php } if(get_theme_mod( 'rit_custom_css' )) : ?>
        <?php echo get_theme_mod( 'rit_custom_css' ); ?>
        <?php endif; ?>

    </style>
    <?php
}

add_action('wp_head', 'rit_customizer_css');