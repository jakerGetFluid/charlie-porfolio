<?php

if (!function_exists('rit_shortcode_follow_me')) {
    function rit_shortcode_follow_me($atts)
    {

        $atts = shortcode_atts(
            array(
                'title' => '',
                'follow-me' => '',
                'style' => 'circle',
                'el_class' => '',
            ), $atts);
        return rit_get_template_part('shortcode', 'follow-me', array('atts' => $atts));
    }
}

add_shortcode('rit_follow_me', 'rit_shortcode_follow_me');

add_action('vc_before_init', 'rit_follow_me_integrate_vc');

if (!function_exists('rit_follow_me_integrate_vc')) {
    function rit_follow_me_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Follow Me', 'rit-core-language'),
                'base' => 'rit_follow_me',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Social Follow Me Block', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'title',
                        "admin_label" => true,
                    ),
                    array(
                        "type" => "param_group",
                        "heading" => esc_html__("Follow Me block", 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'follow-me',
                        'description' => esc_html__('Icons and links block, click to starting add', 'rit-core-language'),
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'iconpicker',
                                'value' => '',
                                'heading' => esc_html__('Socail icon', 'rit-core-language'),
                                'param_name' => 'socail-icon',
                                'edit_field_class'=>'vc_col-xs-6',
                            ),
                            array(
                                'type' => 'vc_link',
                                'value' => '',
                                'heading' => esc_html__('Link', 'rit-core-language'),
                                'param_name' => 'socail-link',
                                'edit_field_class'=>'vc_col-xs-6',
                            ),
                        )
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Style', 'rit-core-language'),
                        'param_name' => 'style',
                        'std' => 'circle',
                        'edit_field_class'=>'vc_col-xs-6',
                        "value" => array(
                            esc_html__('Circle', 'rit-core-language' ) => 'circle',
                            esc_html__('Square', 'rit-core-language' ) => 'square'
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Extra class name', 'rit-core-language' ),
                        'param_name' => 'el_class',
                        'edit_field_class'=>'vc_col-xs-6',
                        'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language' )
                    )
                )
            )
        );
    }
}