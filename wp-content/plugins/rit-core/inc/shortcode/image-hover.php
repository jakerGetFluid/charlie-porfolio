<?php

if (!function_exists('rit_shortcode_image_hover')) {
    function rit_shortcode_image_hover($atts)
    {

        $atts = shortcode_atts(
            array(
                'image' => '',
                'title' => '',
                'sub_title' => '',
                'des'=>'',
                'link' => '#',
                'text_link' => '',
                'style' => 'default',
                'el_class' => ''
            ), $atts);

        return rit_get_template_part('shortcode', 'image-hover', array('atts' => $atts));
    }
}

add_shortcode('rit_image_hover', 'rit_shortcode_image_hover');

add_action('vc_before_init', 'rit_image_hover_integrate_vc');

if (!function_exists('rit_image_hover_integrate_vc')) {
    function rit_image_hover_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Image Hover', 'rit-core-language'),
                'base' => 'rit_image_hover',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Show Image Hover', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Image', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'image',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'title',
                        "admin_label" => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Sub Title', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'sub_title',
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'des',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Style', 'rit-core-language'),
                        'param_name' => 'style',
                        'std' => 'default',
                        "value" => array(
                            esc_html__('Default style', 'rit-core-language' ) => 'default',
                            esc_html__('Style 1', 'rit-core-language' ) => 'style-1',
                            esc_html__('Style 2', 'rit-core-language' ) => 'style-2',
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Link', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'link',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Text Link', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'text_link',
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