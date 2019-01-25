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

if (!function_exists('rit_shortcode_recent_post')) {
    function rit_shortcode_recent_post($atts)
    {
        $atts = shortcode_atts(array(
            'title' => '',
            'columns' => 3,
            'cat' => '',
            'parent' => 1,
            'post_in' => '',
            'number' => 8,
            'view_more' => false,
            'el_class' => '',
            'pagination' => 0
        ), $atts);

        return rit_get_template_part('shortcode', 'recent-post', array('atts' => $atts));
    }
}
add_shortcode('rit_recent_post', 'rit_shortcode_recent_post');

add_action('vc_before_init', 'rit_recent_post_integrate_vc');

if (!function_exists('rit_recent_post_integrate_vc')) {
    function rit_recent_post_integrate_vc()
    {
        vc_map(array(
            'name' => esc_html__('RIT Recent Post', 'rit-core-language'),
            'base' => 'rit_recent_post',
            'category' => esc_html__('RIT', 'rit-core-language'),
            'description' => esc_html__('Show recent post.', 'rit-core-language'),
            'icon' => 'rit-blog',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", 'rit-core-language'),
                    "param_name" => "title",
                    "admin_label" => true,
                    'description' => esc_html__('Enter text used as shortcode title (Note: located above content element)', 'rit-core-language'),
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
                    "type" => "dropdown",
                    "heading" => esc_html__("Get posts in children of categories", 'rit-core-language'),
                    "param_name" => "parent",
                    'std' => 1,
                    "value" => array(
                        esc_html__('No', 'rit-core-language' ) => 0,
                        esc_html__('Yes', 'rit-core-language' ) => 1,
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Post IDs", 'rit-core-language'),
                    "description" => esc_html__("comma separated list of post ids", 'rit-core-language'),
                    "param_name" => "post_in"
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Posts number", 'rit-core-language'),
                    "param_name" => "number",
                    "value" => '8',
                    'description' => esc_html__('Number of post showing', 'rit-core-language'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'rit-core-language' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language' )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable pagination", 'rit-core-language'),
                    "param_name" => "pagination",
                    'std' => '7',
                    "value" => array(
                        esc_html__('No', 'rit-core-language' ) => 0,
                        esc_html__('Yes', 'rit-core-language' ) => 1,
                    )
                )
            )
        ));
    }
}
