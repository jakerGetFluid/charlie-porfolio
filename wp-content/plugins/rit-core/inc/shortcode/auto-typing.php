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

if (!function_exists('rit_shortcode_auto_typing')) {
    function rit_shortcode_auto_typing($atts)
    {
        $atts = shortcode_atts(array(
            'fixed-text'=>'',
            'text' => '',
            'font-size' => '',
            'text-transform' => '',
            'typeSpeed'=>100,
            'delay_time'=>0,
            'fixed_text_color'=>'#000',
            'text_color'=>'#000',
            'show_cursor'=>'yes',
            'el_class' => ''
        ), $atts);
        return rit_get_template_part('shortcode', 'auto-typing', array('atts' => $atts));
    }
}
add_shortcode('auto_typing', 'rit_shortcode_auto_typing');

add_action('vc_before_init', 'rit_auto_typing_integrate_vc');

if (!function_exists('rit_auto_typing_integrate_vc')) {
    function rit_auto_typing_integrate_vc()
    {
        vc_map(array(
            'name' => esc_html__('RIT Auto Typing', 'rit-core-language'),
            'base' => 'auto_typing',
            'category' => esc_html__('RIT', 'rit-core-language'),
            'icon' => 'rit-auto-typing',
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Fixed text', 'rit-core-language' ),
                    'param_name' => 'fixed-text',
                    'description' => esc_html__( 'This text is fixed, not has effect.', 'rit-core-language' )
                ),
                array(
                    "type" => "param_group",
                    "heading" => esc_html__("Text", 'rit-core-language'),
                    'value' => '',
                    'param_name' => 'text',
                    // Note params is mapped inside param-group:
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => esc_html__('Text Item', 'rit-core-language'),
                            'param_name' => 'text-item',
                        ),
                    )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Font size', 'rit-core-language' ),
                    'param_name' => 'font-size',
                    'edit_field_class'=>'vc_col-xs-6',
                    'description' => esc_html__( 'Apply only number.', 'rit-core-language' )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Text transform', 'rit-core-language' ),
                    'param_name' => 'text-transform',
                    "value" => array(
                        esc_html__('None', 'rit-core-language' ) => 'none',
                        esc_html__('Uppercase', 'rit-core-language' ) => 'Uppercase',
                        esc_html__('Lowercase', 'rit-core-language' ) => 'Lowercase',
                        esc_html__('Inherit', 'rit-core-language' ) => 'Inherit',
                        esc_html__('Full width', 'rit-core-language' ) => 'full-width',
                        esc_html__('Capitalize', 'rit-core-language' ) => 'capitalize',
                    ),
                    'edit_field_class'=>'vc_col-xs-6',
                    'description' => esc_html__( 'Text transform style.', 'rit-core-language' )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Type Speed', 'rit-core-language' ),
                    'param_name' => 'typeSpeed',
                    'std'=>'100',
                    'edit_field_class'=>'vc_col-xs-6',
                    'description' => esc_html__( 'Apply only number.', 'rit-core-language' )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Delay time', 'rit-core-language' ),
                    'param_name' => 'delay_time',
                    'std'=>'0',
                    'edit_field_class'=>'vc_col-xs-6',
                    'description' => esc_html__( 'Apply only number.', 'rit-core-language' )
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Fixed text color', 'rit-core-language' ),
                    'param_name' => 'fixed_text_color',
                    'std'=>'#000',
                    'edit_field_class'=>'vc_col-xs-6',
                    'description' => esc_html__( 'Color of fixed text.', 'rit-core-language' )
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Text color', 'rit-core-language' ),
                    'param_name' => 'text_color',
                    'std'=>'#000',
                    'edit_field_class'=>'vc_col-xs-6',
                    'description' => esc_html__( 'Color of text.', 'rit-core-language' )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__( 'Show Cursor', 'rit-core-language' ),
                    'param_name' => 'show_cursor',
                    'std'=>'yes',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => 'yes'),
                    'edit_field_class'=>'vc_col-xs-6'
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
