<?php

if (!function_exists('rit_shortcode_demo_box')) {
    function rit_shortcode_demo_box($atts)
    {

        $atts = shortcode_atts(
            array(
                'type'=>'text',
                'icon'=>'',
                'image' => '',
                'title' => '',
                'description' => '',
                'custom_text'=>'',
                'mask_color'=>'rgba(0,0,0,0.5)',
                'link' => '#',
                'animation_type'=>'none',
                'new_label'=>'',
                'hot_label'=>'',
                'coming_label'=>'',
                'text_link' => '',
                'el_class' => ''
            ), $atts);
        return rit_get_template_part('shortcode', 'demo-box', array('atts' => $atts));
    }
}

add_shortcode('rit_demo_box', 'rit_shortcode_demo_box');

add_action('vc_before_init', 'rit_shortcode_demo_box_integrate_vc');

if (!function_exists('rit_shortcode_demo_box_integrate_vc')) {
    function rit_shortcode_demo_box_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Demo Box', 'rit-core-language'),
                'base' => 'rit_demo_box',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Box demo. Display feature of themes, with images or icons', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Type', 'rit-core-language'),
                        'value' => array(
                            esc_html__('Text', 'rit-core-language') => 'text',
                            esc_html__('Image', 'rit-core-language') => 'image',
                        ),
                        'std' => 'text',
                        'param_name' => 'type',
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Image', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'image',
                        'description' => esc_html__('Image demo of box', 'rit-core-language'),
                        'dependency' => Array('element' => 'type', 'value' => array('image')),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Icon Class', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'icon',
                        'description' => esc_html__('Class of icon font icon (Awesome font, or CleverSoft font) you want use', 'rit-core-language'),
                        'dependency' => Array('element' => 'type', 'value' => array('text')),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'rit-core-language'),
                        'value' => '',
                        "admin_label" => true,
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'description',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Mask color', 'rit-core-language'),
                        'value' => 'rgba(0,0,0,0.5)',
                        'param_name' => 'mask_color',
                        'description' => esc_html__('Mask color background for image.', 'rit-core-language'),
                        'dependency' => Array('element' => 'type', 'value' => array('image')),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__('New label', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'new_label',
                        'dependency' => Array('element' => 'type', 'value' => array('image')),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__('Hot label', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'hot_label',
                        'dependency' => Array('element' => 'type', 'value' => array('image')),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__('Coming soon label', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'coming_label',
                        'dependency' => Array('element' => 'type', 'value' => array('image')),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Text Link', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'text_link',
                        'dependency' => Array('element' => 'type', 'value' => array('image')),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Link', 'rit-core-language'),
                        'value' => '#',
                        'param_name' => 'link',
                        'dependency' => Array('element' => 'type', 'value' => array('image')),
                    ),
                    array(
                        'type' => 'rit_animation_type',
                        'heading' => esc_html__('Animation Style', 'rit-core-language'),
                        'value' => 'none',
                        'param_name' => 'animation_type',
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