<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.3.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */

if (!function_exists('rit_shortcode_news')) {
    function rit_shortcode_news($atts, $content)
    {
        $atts = shortcode_atts(array(
            'title' => '',
            'layout_type' => '',
            'cat' => '',
            'posts_per_page' => '4',
            'columns' => 2,
            'orderby' => 'date',
            'order' => 'DESC',
            'post__in' => '',
            'post__not_in' => '',
            'view_more' => false,
            'animation_type' => '',
            'animation_duration' => '',
            'animation_delay' => '',
            'el_class' => ''
        ), $atts);

        $layout_type = ($atts['layout_type'] != '') ? $atts['layout_type'] : 'vertical';

        return rit_get_template_part('shortcode', 'news-'.$layout_type, array('atts' => $atts));
    }
}

add_shortcode('rit_news', 'rit_shortcode_news');

add_action('vc_before_init', 'rit_news_integrate_vc');

if (!function_exists('rit_news_integrate_vc')) {
    function rit_news_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT News', 'rit-core-language'),
                'base' => 'rit_news',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Get post and display for news', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'rit-core-language'),
                        'value' => 6,
                        'param_name' => 'title',
                        'description' => esc_html__('Enter text used as shortcode title (Note: located above content element)', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'rit_image_radio',
                        'heading' => esc_html__('Layout type', 'rit-core-language'),
                        'value' => array(
                            esc_html__(RIT_PLUGIN_URL.'assets/images/headline.png', 'rit-core-language') => 'headline',
                            esc_html__(RIT_PLUGIN_URL.'assets/images/horizontal.png', 'rit-core-language') => 'horizontal',
                            esc_html__(RIT_PLUGIN_URL.'assets/images/vertical.png', 'rit-core-language') => 'vertical',
                            esc_html__(RIT_PLUGIN_URL.'assets/images/normal.png', 'rit-core-language') => 'normal',
                        ),
                        'width' => '100px',
                        'height' => '70px',
                        'param_name' => 'layout_type',
                        'description' => esc_html__('Select layout type for display post', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Column', 'rit-core-language'),
                        "value" => array(
                            esc_html__('1', 'rit-core-language' ) => 1,
                            esc_html__('2', 'rit-core-language' ) => 2,
                            esc_html__('3', 'rit-core-language' ) => 3,
                            esc_html__('4', 'rit-core-language' ) => 4
                        ),
                        'std' => '2',
                        'param_name' => 'columns',
                        'description' => esc_html__('Display post with the number of column', 'rit-core-language'),
                    ),
                    array(
                        "type" => "rit_post_categories",
                        "heading" => esc_html__("Category IDs", 'rit-core-language'),
                        "description" => esc_html__("Select category", 'rit-core-language'),
                        "param_name" => "cat",
                        "admin_label" => true,
                        'description' => esc_html__('Select category which you want to get post in', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Number of post', 'rit-core-language'),
                        'value' => 6,
                        'param_name' => 'posts_per_page',
                        'description' => esc_html__('Number of post showing', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Order by', 'rit-core-language'),
                        'value' => array(
                            esc_html__('Date', 'rit-core-language') => 'date',
                            esc_html__('Random', 'rit-core-language') => 'ran',
                            esc_html__('Title', 'rit-core-language') => 'title',
                            esc_html__('Modified date', 'rit-core-language') => 'modified',
                        ),
                        'std' => 'date',
                        'param_name' => 'orderby',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Order', 'rit-core-language'),
                        'value' => array(
                            esc_html__('DESC', 'rit-core-language') => 'DESC',
                            esc_html__('ASC', 'rit-core-language') => 'ASC',
                        ),
                        'std' => 'date',
                        'param_name' => 'order',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Exclude Post IDs", 'rit-core-language'),
                        "description" => esc_html__("comma separated list of post ids", 'rit-core-language'),
                        "param_name" => "post__not_in"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Include Post IDs", 'rit-core-language'),
                        "description" => esc_html__("comma separated list of post ids", 'rit-core-language'),
                        "param_name" => "post__in"
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__("Show View More", 'rit-core-language'),
                        'param_name' => 'view_more',
                        'std' => 'no',
                        'value' => array(esc_html__('Yes', 'rit-core-language') => 'yes')
                    ),
                    array(
                        "type" => 'rit_animation_type',
                        "heading" => esc_html__("Animation Type", 'rit-core-language'),
                        "param_name" => "animation_type",
                        "admin_label" => true
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Animation Duration", 'rit-core-language'),
                        "param_name" => "animation_duration",
                        "description" => esc_html__("numerical value (unit: milliseconds)", 'rit-core-language'),
                        "value" => '1000'
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Animation Delay", 'rit-core-language'),
                        "param_name" => "animation_delay",
                        "description" => esc_html__("numerical value (unit: milliseconds)", 'rit-core-language'),
                        "value" => '0'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Extra class name', 'rit-core-language' ),
                        'param_name' => 'el_class',
                        'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language' )
                    )
                )
            )
        );
    }
}