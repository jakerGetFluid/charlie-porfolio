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


if (!function_exists('rit_shortcode_portfolio_carousel')) {
    function rit_shortcode_portfolio_carousel($atts)
    {
        $atts = shortcode_atts(array(
            //Data Collect
            'cat' => '',
            'post_in' => '',
            'order_by' => 'date',
            'order' => 'DESC',
            'number' => 8,
            'el_class' => '',
            //End Data Collect
            //Layout simple config
            'layer' => 'normal',
            'show_thumb' => '',
            'max_thumb' => '3',
            'hover_style' => 'basic',
            'columns' => '3',
            'img_size' => 'medium',
            'show_cat' => '',
            'view_more' => '',
            'view_more_text' => esc_html__('View more', 'rit-core-language'),
            //Advance Setting
            'show_arrow' => '',
            'show_pag' => '',
            'table_col' => '2',
            'mobile_col' => '1',
            'auto_play' => '1',
            'auto_play_speed' => '3000',
//            //Style
//            'title_size'=>'44',
//            'title_color'=>'#fff',
//            'title_anm'=>'none',
//            'cat_size'=>'14',
//            'cat_color'=>'#fff',
//            'cat_anm'=>'none',
//            'view_size'=>'14',
//            'view_color'=>'#fff',
//            'view_anm'=>'none',
        ), $atts);

        return rit_get_template_part('shortcode-portfolio', 'carousel', array('atts' => $atts));
    }
}
add_shortcode('portfolio-carousel', 'rit_shortcode_portfolio_carousel');

add_action('vc_before_init', 'rit_portfolio_carousel_integrate_vc');
if (!(function_exists('listportfolio'))) {
    function listportfolio()
    {
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1
        );
        $the_query = new WP_Query($args);
        $results = array();
        if ($the_query->have_posts()):
            while ($the_query->have_posts()): $the_query->the_post();
                $data = array();
                $data['value'] = get_the_ID();
                $data['label'] = get_the_title();
                $results[] = $data;
            endwhile;
        endif;
        wp_reset_postdata();
        return $results;
    }
}
if (!function_exists('rit_portfolio_carousel_integrate_vc')) {
    function rit_portfolio_carousel_integrate_vc()
    {
        vc_map(array(
            'name' => esc_html__('RIT Portfolio Carousel', 'rit-core-language'),
            'base' => 'portfolio-carousel',
            'category' => esc_html__('RIT', 'rit-core-language'),
            'icon' => 'rit-portfolios',
            "params" => array(
                //Data Collect
                array(
                    "type" => "rit_portfolio_categories",
                    "heading" => esc_html__("Category IDs", 'rit-core-language'),
                    "param_name" => "cat",
                    "admin_label" => true,
                    'description' => esc_html__('Select category which you want to get portfolio in', 'rit-core-language'),
                ),
                array(
                    "type" => "autocomplete",
                    "heading" => esc_html__("Portfolio IDs", 'rit-core-language'),
                    "description" => esc_html__("comma separated list of portfolio ids", 'rit-core-language'),
                    "param_name" => "post_in",
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'min_length' => 0,
                        'no_hide' => true, // In UI after select doesn't hide an select list
                        'groups' => true, // In UI show results grouped by groups
                        'unique_values' => true, // 0In UI show results except selected. NB! You should manually check values in backend
                        'display_inline' => true, // In UI show results inline view
                        'values' => listportfolio(),
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order by", 'rit-core-language'),
                    "param_name" => "order_by",
                    'std' => 'date',
                    "value" => array(
                        esc_html__('Author', 'rit-core-language') => 'author',
                        esc_html__('Comment count', 'rit-core-language') => 'comment_count',
                        esc_html__('Date', 'rit-core-language') => 'date',
                        esc_html__('Date modified', 'rit-core-language') => 'modified',
                        esc_html__('Featured', 'rit-core-language') => 'featured',
                        esc_html__('ID', 'rit-core-language') => 'ID',
                        esc_html__('Parent', 'rit-core-language') => 'parent',
                        esc_html__('Random', 'rit-core-language') => 'rand',
                        esc_html__('Title post', 'rit-core-language') => 'title'
                    ),
                    'description' => esc_html__('Choose type you want order', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order", 'rit-core-language'),
                    "param_name" => "order",
                    'std' => 'DESC',
                    "value" => array(
                        esc_html__('Ascending', 'rit-core-language') => 'ASC',
                        esc_html__('Descending', 'rit-core-language') => "DESC",
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Portfolios number", 'rit-core-language'),
                    "param_name" => "number",
                    "value" => '8',
                    'description' => esc_html__('Number of portfolios showing', 'rit-core-language'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'rit-core-language'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language')
                ),
                //Layout simple config
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Layer display", 'rit-core-language'),
                    "param_name" => "layer",
                    "admin_label" => true,
                    'std' => 'normal',
                    "value" => array(
                        esc_html__('Full Screen', 'rit-core-language') => 'full-screen',
                        esc_html__('On Screen ', 'rit-core-language') => 'on-screen',
                        esc_html__('Normal', 'rit-core-language') => 'normal',
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Layer portfolio display. With options full screen and on screen portfolio thumbnail will be set is background.', 'rit-core-language'),
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Show Thumbnail", 'rit-core-language'),
                    "param_name" => "show_thumb",
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__("Max Thumbnails", 'rit-core-language'),
                    "param_name" => "max_thumb",
                    'description' => esc_html__('Max thumbnails per screen', 'rit-core-language'),
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'dependency' => array('element' => 'show_thumb', 'value' => '1'),
                    'std' => '3'
                ),
                array(
                    "type" => "rit_image_radio",
                    "heading" => esc_html__("Hover Effect", 'rit-core-language'),
                    "param_name" => "hover_style",
                    'description' => esc_html__('Display style, hover effect', 'rit-core-language'),
                    'std' => 'basic',
                    "value" => array(
                        RIT_PLUGIN_URL . 'assets/images/portfolio/style-1.png' => 'style-1',
                        RIT_PLUGIN_URL . 'assets/images/portfolio/style-2.png' => 'style-2',
                        RIT_PLUGIN_URL . 'assets/images/portfolio/default.png' => 'basic',
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language')
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Columns", 'rit-core-language'),
                    "param_name" => "columns",
                    "admin_label" => true,
                    'std' => '3',
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Maximum portfolio display per screen.', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Image size", 'rit-core-language'),
                    "param_name" => "img_size",
                    "admin_label" => true,
                    'std' => 'medium',
                    "value" => array(
                        esc_html__('Medium', 'rit-core-language') => 'medium',
                        esc_html__('Large ', 'rit-core-language') => 'large',
                        esc_html__('Original size', 'rit-core-language') => 'full',
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Image size of portfolio, optimizer image size for loading. Select image size Thumbnail, Portfolio Thumbnail, Portfolio Medium if you want display it like grid', 'rit-core-language'),
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Show Categories", 'rit-core-language'),
                    "param_name" => "show_cat",
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Enable read more", 'rit-core-language'),
                    "param_name" => "view_more",
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__("View more text", 'rit-core-language'),
                    "param_name" => "view_more_text",
                    'dependency' => Array('element' => 'view_more', 'value' => '1'),
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Default is View more', 'rit-core-language'),
                ),
                //Advance settings
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Enable Arrows", 'rit-core-language'),
                    "param_name" => "show_arrow",
                    'group' => esc_html__('Advance', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Enable navigation", 'rit-core-language'),
                    "param_name" => "show_pag",
                    'group' => esc_html__('Advance', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__("Table columns", 'rit-core-language'),
                    "param_name" => "table_col",
                    'std' => '2',
                    'group' => esc_html__('Advance', 'rit-core-language'),
                    'description' => esc_html__('Number columns when responsive to table devices', 'rit-core-language'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__("Mobile columns", 'rit-core-language'),
                    "param_name" => "mobile_col",
                    'std' => '1',
                    'group' => esc_html__('Advance', 'rit-core-language'),
                    'description' => esc_html__('Number columns when responsive to mobile devices', 'rit-core-language'),
                ),

                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Enable Auto Play", 'rit-core-language'),
                    "param_name" => "auto_play",
                    'group' => esc_html__('Advance', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => '1'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__("Auto play speed", 'rit-core-language'),
                    "param_name" => "auto_play_speed",
                    'dependency' => Array('element' => 'auto_play', 'value' => '1'),
                    'group' => esc_html__('Advance', 'rit-core-language'),
                    'std' => '3000',
                ),
            )
        ));
    }
}
