<?php

if (!function_exists('rit_shortcode_album_masonry')) {
    function rit_shortcode_album_masonry($atts)
    {
        $atts = shortcode_atts(
            array(
                'shortcode'=>'',
                'columns'=>'3',
                'style'=>'default',
                'max_width'=>'1170',
                'el_class' => '',
                'css'=>''
            ), $atts);
        return rit_get_template_part('shortcode', 'album-masonry', array('atts' => $atts));
    }
}

add_shortcode('rit_album_masonry', 'rit_shortcode_album_masonry');

add_action('vc_before_init', 'rit_shortcode_album_masonry_integrate_vc');

if (!function_exists('rit_shortcode_album_masonry_integrate_vc')) {
    function rit_shortcode_album_masonry_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Album Masonry', 'rit-core-language'),
                'base' => 'rit_album_masonry',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Build for Envira Album. Make Layout for Album.', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'textarea_raw_html',
                        'heading' => esc_html__( 'Shortcode', 'rit-core-language' ),
                        'param_name' => 'shortcode',
                        'edit_field_class'=>'txt-input',
                        'description' => esc_html__( 'Shortcode of Envira Album.', 'rit-core-language' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Columns', 'rit-core-language' ),
                        'param_name' => 'columns',
                        'srd' => '3',
                        'admin_label'=>true,
                        'description' => esc_html__( 'Max Columns display in masonry.', 'rit-core-language' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Max Width', 'rit-core-language' ),
                        'param_name' => 'max_width',
                        'srd' => '1170',
                        'admin_label'=>true,
                        'description' => esc_html__( 'Max width of layout. If not set, it will auto set 1170px. Put only number', 'rit-core-language' )
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Style', 'rit-core-language'),
                        'srd' => 'default',
                        'param_name' => 'style',
                        'value' => array(
                            esc_html__('Default', 'rit-core-language') => 'default',
                            esc_html__('Style 1', 'rit-core-language') => 'style-1',
                        ),
                        'description' => esc_html__( 'Style of layout.', 'rit-core-language' )
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Extra class name', 'rit-core-language' ),
                        'param_name' => 'el_class',
                        'value' => '',
                        'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'rit-core-language' ),
                    )
                )
            )
        );
    }
}