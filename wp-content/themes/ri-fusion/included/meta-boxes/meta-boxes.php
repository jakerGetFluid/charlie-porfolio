<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.3
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */
add_filter('rwmb_meta_boxes', 'ri_fusion_add_meta_box_options');
function ri_fusion_add_meta_box_options()
{
    $prefix = "rit_";
    $meta_boxes = array();
    /* Portfolio Meta Box */
//    $meta_boxes[] = array(
//        'id' => 'portfolio_meta_box',
//        'title' => esc_html__('Portfolio Options', 'ri-fusion'),
//        'pages' => array('portfolio'),
//        'context' => 'advanced',
//        'fields' => array(
//            array(
//                'name' => esc_html__('Portfolio Format', 'ri-fusion'),
//                'desc' => esc_html__('', 'ri-fusion'),
//                'id' => $prefix . "portfolio_format",
//                'type' => 'select',
//                'options' => array(
//                    'gallery' => esc_html('Gallery', 'ri-fusion'),
//                    'embed' => esc_html('Video/Audio', 'ri-fusion'),
//                ),
//                'std' => 'gallery',
//            ),
//            array(
//                'name' => esc_html__('Gallery', 'ri-fusion'),
//                'desc' => esc_html__('The image that will be used in the detail page.', 'ri-fusion'),
//                'id' => "rit_detail_image",
//                'type' => 'image_advanced',
//                'class' => 'rit_mt_dependency',
//                'attributes' => array(
//                    'data-dependency-key'=>  $prefix . "portfolio_format",
//                    'data-dependency-val'  => 'gallery',
//                ),
//            ),
//            array(
//                'name' => esc_html__('Layout', 'ri-fusion'),
//                'desc' => esc_html__('Layout display, if set Inherit, it will use layout follow customize', 'ri-fusion'),
//                'id' => "rit_detail_portfolio_layout",
//                'type' => 'select',
//                'options' => array(
//                    'use-default' => esc_html__('Inherit', 'ri-fusion'),
//                    'list' => esc_html__('List', 'ri-fusion'),
//                    'metro' => esc_html__('Metro', 'ri-fusion'),
//                    'slider' => esc_html__('Slider', 'ri-fusion'),
//                    'full-screen' => esc_html__('Full screen slider', 'ri-fusion'),
//                    'right-sidebar' => esc_html__('Right sidebar', 'ri-fusion'),
//                    'left-sidebar' => esc_html__('Left sidebar', 'ri-fusion'),
//                ),
//                'std' => 'use-default',
//                'class' => 'rit_mt_dependency',
//                'attributes' => array(
//                    'data-dependency-key'=>  $prefix . "portfolio_format",
//                    'data-dependency-val'  => 'gallery',
//                ),
//            ),
//            array(
//                'name' => esc_html__('Video/Audio', 'ri-fusion'),
//                'desc' => esc_html__('Video/Audio URL.', 'ri-fusion'),
//                'id' => "rit_portfolio_embed",
//                'type' => 'oembed',
//                'class' => 'rit_mt_dependency',
//                'attributes' => array(
//                    'data-dependency-key'=>  $prefix . "portfolio_format",
//                    'data-dependency-val'  => 'embed',
//                ),
//            ),
//            array(
//                'name' => esc_html__('Video/Audio Layout', 'ri-fusion'),
//                'desc' => esc_html__('Video/Audio Layout display, if set Inherit, it will use Video/Audio layout follow customize', 'ri-fusion'),
//                'id' => "rit_detail_portfolio_embed_layout",
//                'type' => 'select',
//                'options' => array(
//                    'use-default' => esc_html__('Inherit', 'ri-fusion'),
//                    'list' => esc_html__('List', 'ri-fusion'),
//                    'full-width' => esc_html__('Media full width', 'ri-fusion'),
//                    'full-screen' => esc_html__('Media full screen (Video background)', 'ri-fusion'),
//                    'right-sidebar' => esc_html__('Right sidebar', 'ri-fusion'),
//                    'left-sidebar' => esc_html__('Left sidebar', 'ri-fusion'),
//                ),
//                'std' => 'use-default',
//                'class' => 'rit_mt_dependency',
//                'attributes' => array(
//                    'data-dependency-key'=>  $prefix . "portfolio_format",
//                    'data-dependency-val'  => 'embed',
//                ),
//            ),
//            array(
//                'name' => esc_html__('Columns', 'ri-fusion'),
//                'desc' => esc_html__('Use for Metro layout.', 'ri-fusion'),
//                'id' => "rit_col_item",
//                'std'=>'3',
//                'type' => 'number',
//                'attributes' => array(
//                    'min' => 0,
//                )
//            ),
//        )
//    );
//    $meta_boxes[] = array(
//        'id' => 'portfolio_extend_info',
//        'title' => esc_html__('Portfolio Detail Information', 'ri-fusion'),
//        'pages' => array('portfolio'),
//        'context' => 'advanced',
//        'fields' => array(
//            array(
//                'name' => esc_html__('Portfolio detail information status', 'ri-fusion'),
//                'desc' => esc_html__('Enable/Disable portfolio detail information.', 'ri-fusion'),
//                'id' => "rit_portfolio_extend_info_status",
//                'type' => 'select',
//                'options' => array(
//                    'disable' => 'Disable',
//                    'enable' => 'Enable'
//                ),
//                'std' => 'enable',
//            ),
//            array(
//                'name' => esc_html__('Date complete', 'ri-fusion'),
//                'desc' => esc_html__('Date complete project.', 'ri-fusion'),
//                'id' => "rit_date_complete_portfolio",
//                'type' => 'date'
//            ),
//            array(
//                'name' => esc_html__('Client', 'ri-fusion'),
//                'desc' => esc_html__('The name of client.', 'ri-fusion'),
//                'id' => "rit_client_portfolio",
//                'type' => 'text'
//            ),
//        )
//    );
    $meta_boxes[] = array(
        'id' => $prefix . 'gallery_extend_info',
        'title' => esc_html__('Gallery Extend Information', 'ri-fusion'),
        'pages' => array('envira'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Gallery Layout', 'ri-fusion'),
                'desc' => esc_html__('Layout of gallery. If select Carousel, must sure deselect enable isotope first.', 'ri-fusion'),
                'id' => $prefix . "gallery_layout",
                'type' => 'select',
                'options' => array(
                    'default' => esc_html('Default', 'ri-fusion'),
                    'grid' => esc_html('Grid', 'ri-fusion'),
                    'carousel' => esc_html('Carousel', 'ri-fusion'),
                ),
                'std' => 'default',
            ),
            array(
                'name' => esc_html__('Hide Gallery Info', 'ri-fusion'),
                'id' => $prefix . "gallery_hide_info",
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Gallery Descriptions', 'ri-fusion'),
                'desc' => esc_html__('Description of gallery.', 'ri-fusion'),
                'id' => $prefix . "gallery_description",
                'type' => 'textarea'
            ),
            array(
                'name' => esc_html__('Location', 'ri-fusion'),
                'id' => $prefix . "gallery_location",
                'type' => 'text'
            ),
            array(
                'name' => esc_html__('Photographer', 'ri-fusion'),
                'desc' => esc_html__('The name of Photographer.', 'ri-fusion'),
                'id' => $prefix . "gallery_photographer",
                'type' => 'text'
            ),
            array(
                'name' => esc_html__('Camera', 'ri-fusion'),
                'desc' => esc_html__('The name of Camera.', 'ri-fusion'),
                'id' => $prefix . "gallery_camera",
                'type' => 'text'
            ),
            array(
                'name' => esc_html__('Model', 'ri-fusion'),
                'desc' => esc_html__('The name of model.', 'ri-fusion'),
                'id' => $prefix . "gallery_model",
                'type' => 'text'
            ),
        )
    );
    $meta_boxes[] = array(
        'id' => 'post_layout_meta_box',
        'title' => esc_html__('Post Layout Options', 'ri-fusion'),
        'pages' => array('post'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Post layout', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_post_layout",
                'type' => 'select',
                'options' => array(
                    'use-default' => esc_html__('Use-default', 'ri-fusion'),
                    'normal' => esc_html__('Normal style', 'ri-fusion'),
                    'style-1' => esc_html__('Style 1', 'ri-fusion'),
                    'style-2' => esc_html__('Style 2', 'ri-fusion')
                ),
                'std' => 'use-default',
            ),));
    //All page
    $meta_boxes[] = array(
        'id' => 'title_meta_box',
        'title' => esc_html__('Layout Options', 'ri-fusion'),
        'pages' => array('post', 'page', 'portfolio', 'envira'),
        'context' => 'advanced',
        'fields' => array(
            array(
                'name' => esc_html__('Logo page', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_logo_stt",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Logo for page', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_logo_page",
                'type' => 'image_advanced',
                'max_file_uploads' => 1
            ),
            array(
                'name' => esc_html__('Header height', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_header_height",
                'type' => 'number',
                'attributes' => array(
                    'min' => 0,
                )
            ),
            array(
                'name' => esc_html__('Header sticky height', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_header_sticky_height",
                'type' => 'number',
                'attributes' => array(
                    'min' => 0,
                )
            ),
            array(
                'name' => esc_html__('Logo padding top', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_logo_page_top",
                'type' => 'number',
                'attributes' => array(
                    'min' => 0,
                )
            ),
            array(
                'name' => esc_html__('Logo padding bottom', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_logo_page_bottom",
                'type' => 'number',
                'attributes' => array(
                    'min' => 0,
                ),
            ),
            array(
                'name' => esc_html__('Title Options', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_heading_title",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Disable Title', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_disable_title",
                'std' => '0',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Body Layout', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_body_heading",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Page Max Width', 'ri-fusion'),
                'desc' => esc_html__('Accept only number. If not set, it will follow customize config.', 'ri-fusion'),
                'id' => "rit_enable_large_width",
                'type' => 'number'
            ),
            array(
                'name' => esc_html__('Header Options', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_heading_header",
                'type' => 'heading'
            ),
            array(
                'name' => esc_html__('Enable header sticky.', 'ri-fusion'),
                'id' => "rit_enable_sticky_header",
                'type' => 'checkbox',
            ),
            array(
                'name' => esc_html__('Header Layout', 'ri-fusion'),
                'id' => "rit_default_menu_style",
                'type' => 'select',
                'options' => array(
                    'use-default' => esc_html__('Inherit', 'ri-fusion'),
                    'default' => esc_html__('Header Menu Right', 'ri-fusion'),
                    'hamburger' => esc_html__('Header Hamburger Menu', 'ri-fusion'),
                    'lightbox' => esc_html__('Header Light Box Menu', 'ri-fusion'),
                    'center' => esc_html__('Header Center Menu', 'ri-fusion'),
                    'stack-center' => esc_html__('Header Stack Center Menu', 'ri-fusion'),
                    'logo-center' => esc_html__('Header Logo Center Menu', 'ri-fusion'),
                ),
                'std' => 'use-default',
                'desc' => esc_html__('Choose Options Header Layout. If set Inherit, it follow option of customize', 'ri-fusion')
            ),
            array(
                'name' => esc_html__('Enable Header Transparency', 'ri-fusion'),
                'id' => "rit_enable_header_absolute",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, header will be use transparent style.', 'ri-fusion')
            ),
            array(
                'name' => esc_html__('100% Header Width', 'ri-fusion'),
                'id' => "rit_enable_header_fullwidth",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('Check this box to set the header to 100% of the browser width. Uncheck to follow the site width.', 'ri-fusion')
            ),
            array(
                'name' => esc_html__('Enable Off Canvas Sidebar', 'ri-fusion'),
                'id' => "rit_enable_offcanvas_sidebar",
                'type' => 'select',
                'options' => array(
                    'use-default' => esc_html__('Inherit', 'ri-fusion'),
                    'yes' => esc_html__('Yes', 'ri-fusion'),
                    'no' => esc_html__('No', 'ri-fusion'),
                ),
                'std' => 'use-default',
                'desc' => esc_html__('Choose Options of  Off Canvas Sidebar. If set Inherit, it follow option of customize', 'ri-fusion')
            ),
            array(
                'name' => esc_html__('Header Color & Background', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_heading_header_color",
                'type' => 'heading',
            ),
            array(
                'name' => esc_html__('Active Custom color & background header', 'ri-fusion'),
                'id' => "rit_enable_header_color",
                'type' => 'checkbox',
                'std' => '0',
                'desc' => esc_html__('If check, all value custom color & background will be accept', 'ri-fusion')
            ),
            array(
                'name' => esc_html__('Header Color', 'ri-fusion'),
                'desc' => esc_html__('Color of text in header', 'ri-fusion'),
                'id' => "rit_header_color",
                'type' => 'color',
                'std' => '#252525',
            ),
            array(
                'name' => esc_html__('Header Color Hover', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_header_color_hover",
                'type' => 'color',
                'std' => '#252525',
            ),
            array(
                'name' => esc_html__('Header Background', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_custom_bg_header",
                'type' => 'color',
                'std' => '#fff',
            ),
            array(
                'name' => esc_html__('Header Background Opacity', 'ri-fusion'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-fusion'),
                'id' => "rit_custom_bg_header_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Header sticky Background', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_bg_sticky_header",
                'type' => 'color',
                'std' => '#fff',
            ),
            array(
                'name' => esc_html__('Header Sticky Background Opacity', 'ri-fusion'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-fusion'),
                'id' => "rit_bg_sticky_header_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Header Border Color', 'ri-fusion'),
                'id' => "rit_header_border_color",
                'type' => 'color',
                'std' => '#f5f5f5',
            ),
            array(
                'name' => esc_html__('Header Border Color', 'ri-fusion'),
                'desc' => esc_html__('Controls the opacity for the header. Opacity only works with ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-fusion'),
                'id' => "rit_header_border_color_opc",
                'type' => 'slider',
                'std' => '1',
                'js_options' => array(
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ),
            ),
            array(
                'name' => esc_html__('Footer Options', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_heading_footer",
                'type' => 'heading',
                'class'=>'clear',
            ),
            array(
                'name' => esc_html__('Disable footer', 'ri-fusion'),
                'desc' => esc_html__('', 'ri-fusion'),
                'id' => "rit_disable_footer",
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_html__('Footer sticky', 'ri-fusion'),
                'id' => "rit_footer_sticky",
                'type' => 'checkbox',
                'desc' => esc_html__('Footer always display in bottom.', 'ri-fusion')
            ),
            array(
                'name' => esc_html__('Footer style', 'ri-fusion'),
                'id' => "rit_footer_style",
                'type' => 'select',
                'options' => array(
                    'use-default' => esc_html__('Inherit', 'ri-fusion'),
                    'default' => esc_html__('Style 1', 'ri-fusion'),
                    'one-line' => esc_html__('Style 2', 'ri-fusion')
                ),
                'std' => 'use-default',
                'desc' => esc_html__('Choose Footer style.', 'ri-fusion')
            ),
        )
    );
    $meta_boxes[] = array(
        'id' => 'rit_heading_sidebar',
        'title' => esc_html__('Sidebar Options', 'ri-fusion'),
        'pages' => array('post'),
        'context' => 'side',
        'fields' => array(
            array(
                'name' => esc_html__('Sidebar Options', 'ri-fusion'),
                'id' => "rit_sidebar_options",
                'type' => 'select',
                'options' => array(
                    'use-default' => 'Inherit',
                    'no-sidebar' => 'No Sidebar',
                    'left-sidebar' => 'Left Sidebar',
                    'right-sidebar' => 'Right Sidebar',
                    'both-sidebar' => 'Both Sidebar'
                ),
                'std' => 'use-default',
                'desc' => esc_html__('Choose Options Sidebar.', 'ri-fusion')
            ),
            array(
                'name' => esc_html__('Left Sidebar', 'ri-fusion'),
                'id' => "rit_left_sidebar",
                'type' => 'sidebars',
            ),
            array(
                'name' => esc_html__('Right Sidebar', 'ri-fusion'),
                'id' => "rit_right_sidebar",
                'type' => 'sidebars',
            ),
        ));
    return $meta_boxes;
}


get_template_part(ABSPATH . 'wp-admin/includes/plugin.php');


if (is_plugin_active('meta-box/meta-box.php')) {
    get_template_part('included/meta-boxes/field/sidebars');
}

