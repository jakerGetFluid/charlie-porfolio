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

function rit_shortcode_banner_slider($atts)
{

    $atts = shortcode_atts(
        array(
            'posts_per_page' => "-1",
            'number' => 5,
            'order' => 'DESC',
            'orderby' => 'date',
            'target' => '_blank',
            'speed' => 1000,
            'auto' => 'true',
            'arrow' => 'true',
            'size' => 'medium',
            'el_class'=> '',

        ), $atts);

    return rit_get_template_part('shortcode', 'banner-slider', array('atts' => $atts));
}

add_shortcode('rit_banner_slider', 'rit_shortcode_banner_slider');

add_action('vc_before_init', 'rit_banner_slider_integrate_vc');

if (!function_exists('rit_banner_slider_integrate_vc')) {
    function rit_banner_slider_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Banner Slider', 'rit-core-language'),
                'base' => 'rit_banner_slider',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Show banner carousel', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Number of banner', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'posts_per_page',
                        'description' => esc_html__('Number of banner in slide', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Number item show', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'number',
                        'description' => esc_html__('Number of image showing', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Order by', 'rit-core-language' ),
                        'param_name' => 'orderby',
                        'value' => array(
                            '',
                            esc_html__( 'Date', 'rit-core-language' ) => 'date',
                            esc_html__( 'ID', 'rit-core-language' ) => 'ID',
                            esc_html__( 'Author', 'rit-core-language' ) => 'author',
                            esc_html__( 'Title', 'rit-core-language' ) => 'title',
                            esc_html__( 'Modified', 'rit-core-language' ) => 'modified',
                            esc_html__( 'Random', 'rit-core-language' ) => 'rand',
                            esc_html__( 'Comment count', 'rit-core-language' ) => 'comment_count',
                            esc_html__( 'Menu order', 'rit-core-language' ) => 'menu_order'
                        ),
                        'description' => sprintf( esc_html__( 'Select how to sort retrieved posts. More at %s.', 'rit-core-language' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Order', 'rit-core-language' ),
                        'param_name' => 'order',
                        'value' => array(
                            esc_html__( 'Descending', 'rit-core-language' ) => 'DESC',
                            esc_html__( 'Ascending', 'rit-core-language' ) => 'ASC'
                        ),
                        'description' => sprintf( esc_html__( 'Select ascending or descending order. More at %s.', 'rit-core-language' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Link Target', 'rit-core-language' ),
                        'param_name' => 'target',
                        'value' => array(
                            esc_html__( 'Same window', 'rit-core-language' ) => '_self',
                            esc_html__( 'New window', 'rit-core-language' ) => "_blank"
                        ),
                        'dependency' => array(
                            'element' => 'img_link',
                            'not_empty' => true
                        ),
                        'description' => esc_html__('Number of product will showing', 'rit-core-language'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Slide Speed', 'rit-core-language'),
                        'value' => '1000',
                        'param_name' => 'speed',
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Auto slide', 'rit-core-language' ),
                        'param_name' => 'auto',
                        'description' => esc_html__( 'If checked, image will auto run carousel.', 'rit-core-language' ),
                        'value' => array( esc_html__( 'Yes', 'rit-core-language' ) => 'true' )
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Show Arrow', 'rit-core-language' ),
                        'param_name' => 'arrow',
                        'value' => array( esc_html__( 'Yes', 'rit-core-language' ) => 'true' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Banner size', 'rit-core-language' ),
                        'param_name' => 'size',
                        'value' => 'medium',
                        'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'rit-core-language' )
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