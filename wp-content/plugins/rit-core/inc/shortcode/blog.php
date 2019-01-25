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

if (!function_exists('rit_shortcode_blog')) {
    function rit_shortcode_blog($atts)
    {
        $atts = shortcode_atts(array(
            'title' => '',
            'layout'=> 'grid',
            'columns' => 3,
            'cat' => '',
            'parent'=>1,
            'post_in' => '',
            'number' => 8,
            'blog_img_size'=>'medium',
            'pagination'=>'none',
            'output_type'=>'yes',
            'post_info'=>'yes',
            'excerpt_length'=>40,
            'view_more' => 'yes',
            'animation_type' => '',
            'el_class' => ''
        ), $atts);

        return rit_get_template_part('shortcode', 'blog', array('atts' => $atts));
    }
}
add_shortcode('blog', 'rit_shortcode_blog');

add_action('vc_before_init', 'rit_blog_integrate_vc');

if (!function_exists('rit_blog_integrate_vc')) {
    function rit_blog_integrate_vc()
    {
        vc_map(array(
            'name' => esc_html__('RIT Blog', 'rit-core-language'),
            'base' => 'blog',
            'category' => esc_html__('RIT', 'rit-core-language'),
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
                    "type" => "dropdown",
                    "heading" => esc_html__("Layout", 'rit-core-language'),
                    "param_name" => "layout",
                    'std' => 'grid',
                    "value" => array(
                        esc_html__('Grid', 'rit-core-language' ) => 'grid',
                        esc_html__('List', 'rit-core-language' ) => 'list',
                        esc_html__('Masonry', 'rit-core-language' ) => 'masonry',
                    ),
                    'group'=>esc_html__('Layout','rit-core-language'),
                    'description' => esc_html__('Layout of posts', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Columns", 'rit-core-language'),
                    "param_name" => "columns",
                    'std' => '3',
                    "value" => array(
                        esc_html__('1', 'rit-core-language' ) => 1,
                        esc_html__('2', 'rit-core-language' ) => 2,
                        esc_html__('3', 'rit-core-language' ) => 3,
                        esc_html__('4', 'rit-core-language' ) => 4,
                        esc_html__('6', 'rit-core-language' ) => 6
                    ),
                    'dependency' => Array('element' => 'layout', 'value' => array('grid','masonry')),
                    'group'=>esc_html__('Layout','rit-core-language'),
                    'description' => esc_html__('Display post with the number of column', 'rit-core-language'),
                ),
                array(
                    "type" => "rit_post_categories",
                    "heading" => esc_html__("Category IDs", 'rit-core-language'),
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
                    'description' => esc_html__('Yes, If you want to get post in all children categories', 'rit-core-language'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Post IDs", 'rit-core-language'),
                    "description" => esc_html__("comma separated list of post ids", 'rit-core-language'),
                    "param_name" => "post_in"
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Image size', 'rit-core-language'),
                    'value' => array(
                        esc_html__('Thumbnail', 'rit-core-language' ) => 'thumbnail',
                        esc_html__('450x254 (Crop size)', 'rit-core-language' ) => 'rit-portfolio-thumb',
                        esc_html__('600x340 (Crop size)', 'rit-core-language' ) => 'rit-portfolio-medium',
                        esc_html__('Medium', 'rit-core-language' ) => 'medium',
                        esc_html__('Large', 'rit-core-language' ) => 'large',
                        esc_html__('Full', 'rit-core-language' ) => 'full',
                    ),
                    'group'=>esc_html__('Layout','rit-core-language'),
                    'param_name' => 'blog_img_size',
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Posts Count", 'rit-core-language'),
                    "param_name" => "number",
                    "value" => '8',
                    'description' => esc_html__('Number of post showing', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Pagination", 'rit-core-language'),
                    "param_name" => "pagination",
                    'std' => 'none',
                    "value" => array(
                        esc_html__('Standard', 'rit-core-language' ) => 'standard',
                        esc_html__('Infinite Scroll', 'rit-core-language' ) => 'infinite-scroll',
                        esc_html__('Ajax Load more', 'rit-core-language' ) => 'ajax',
                        esc_html__('None', 'rit-core-language' ) => 'none',
                    ),
                    'group'=>esc_html__('Layout','rit-core-language'),
                    'description' => esc_html__('Select pagination type', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Content display", 'rit-core-language'),
                    "param_name" => "output_type",
                    'std' => 1,
                    'group'=>esc_html__('Layout','rit-core-language'),
                    "value" => array(
                        esc_html__('None', 'rit-core-language' ) => 'no',
                        esc_html__('Excerpt', 'rit-core-language' ) => 'excerpt',
                        esc_html__('Full content', 'rit-core-language' ) => 'content',
                    ),
                    'description' => esc_html__('Select type of content', 'rit-core-language'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Excerpt length", 'rit-core-language'),
                    "param_name" => "excerpt_length",
                    'group'=>esc_html__('Layout','rit-core-language'),
                    'dependency' => Array('element' => 'output_type', 'value' => array('excerpt')),
                    "description" => esc_html__("Total character display of excerpt.", 'rit-core-language'),
                    "value" => '40'
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__("Show Post information", 'rit-core-language'),
                    'param_name' => 'post_info',
                    'group'=>esc_html__('Layout','rit-core-language'),
                    'std' => 'yes',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => 'yes'),
                    'description' => esc_html__('Show category and date post', 'rit-core-language'),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__("Show View More", 'rit-core-language'),
                    'param_name' => 'view_more',
                    'group'=>esc_html__('Layout','rit-core-language'),
                    'std' => 'yes',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => 'yes'),
                    'description' => esc_html__('Yes, If you want to show button "Read more"', 'rit-core-language'),
                ),
                array(
                    "type" => 'rit_animation_type',
                    "heading" => esc_html__("Animation Type", 'rit-core-language'),
                    "param_name" => "animation_type",
                    'group'=>esc_html__('Layout','rit-core-language'),
                    "admin_label" => true,
                    'description' => esc_html__('Select animation type', 'rit-core-language'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'rit-core-language' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language' )
                )
            )
        ));
    }
}
