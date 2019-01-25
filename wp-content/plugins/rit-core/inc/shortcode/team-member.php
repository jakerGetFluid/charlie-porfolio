<?php

if (!function_exists('rit_shortcode_team_member')) {
    function rit_shortcode_team_member($atts)
    {

        $atts = shortcode_atts(
            array(
                'avatar' => '',
                'member_name' => '',
                'member_position' => '',
                'member_link'=>'',
                'el_class' => '',
            ), $atts);
        return rit_get_template_part('shortcode', 'team-member', array('atts' => $atts));
    }
}

add_shortcode('rit_team_member', 'rit_shortcode_team_member');

add_action('vc_before_init', 'rit_team_member_integrate_vc');

if (!function_exists('rit_team_member_integrate_vc')) {
    function rit_team_member_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Team Member', 'rit-core-language'),
                'base' => 'rit_team_member',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Team member block', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Avatar', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'avatar',
                        "admin_label" => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Member Name', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'member_name',
                        "admin_label" => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Member Position', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'member_position',
                        "admin_label" => true,
                    ),
                    array(
                        "type" => "param_group",
                        "heading" => esc_html__("Link member", 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'member_link',
                        'description' => esc_html__('Link member, social link, etc...', 'rit-core-language'),
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => esc_html__('Text display', 'rit-core-language'),
                                'param_name' => 'text',
                                'edit_field_class'=>'vc_col-xs-6',
                            ),
                            array(
                                'type' => 'vc_link',
                                'value' => '',
                                'heading' => esc_html__('Link', 'rit-core-language'),
                                'param_name' => 'link',
                                'edit_field_class'=>'vc_col-xs-6',
                            ),
                        )
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