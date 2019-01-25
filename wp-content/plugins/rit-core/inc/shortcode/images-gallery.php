<?php

if (!function_exists('rit_shortcode_images_gallery')) {
    function rit_shortcode_images_gallery($atts)
    {
        $atts = shortcode_atts(
            array(
                'title' => '',
                'layout' => 'grid',
                'columns' => '3',
                'rows' => '3',
                'images' => '',
                'links' => '',
                'target'=>'',
                'el_class' => ''
            ), $atts);
        return rit_get_template_part('shortcode', 'images-gallery', array('atts' => $atts));
    }
}

add_shortcode('rit_images_gallery', 'rit_shortcode_images_gallery');

add_action('vc_before_init', 'rit_images_gallery_integrate_vc');

if (!function_exists('rit_images_gallery_integrate_vc')) {
    function rit_images_gallery_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Image Gallery', 'rit-core-language'),
                'base' => 'rit_images_gallery',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Show Image Gallery', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'rit-core-language'),
                        'value' => '',
                        "admin_label" => true,
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Layout', 'rit-core-language'),
                        'value' => array(
                            esc_html__('Grid', 'rit-core-language') => 'grid',
                            esc_html__('Carousel', 'rit-core-language') => 'carousel',
                        ),
                        'std' => 'grid',
                        "admin_label" => true,
                        'param_name' => 'layout',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Columns', 'rit-core-language'),
                        'value' => array(
                            esc_html__('1', 'rit-core-language') => '1',
                            esc_html__('2', 'rit-core-language') => '2',
                            esc_html__('3', 'rit-core-language') => '3',
                            esc_html__('4', 'rit-core-language') => '4',
                            esc_html__('5', 'rit-core-language') => '5',
                            esc_html__('6', 'rit-core-language') => '6',
                        ),
                        'description'=> esc_html__('Number columns of layout', 'rit-core-language'),
                        'std' => '3',
                        "admin_label" => true,
                        'param_name' => 'columns',
                        'edit_field_class'=>'vc_col-xs-6 vc_column-with-padding '
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Rows', 'rit-core-language'),
                        'value' => array(
                            esc_html__('1', 'rit-core-language') => '1',
                            esc_html__('2', 'rit-core-language') => '2',
                            esc_html__('3', 'rit-core-language') => '3',
                            esc_html__('4', 'rit-core-language') => '4',
                            esc_html__('5', 'rit-core-language') => '5',
                            esc_html__('6', 'rit-core-language') => '6',
                        ),
                        'description'=> esc_html__('Number rows of grid', 'rit-core-language'),
                        'std' => '3',
                        "admin_label" => true,
                        'edit_field_class'=>'vc_col-xs-6 vc_column-with-padding ',
                        'param_name' => 'rows',
                    ),
                    array(
                        'type' => 'attach_images',
                        'heading' => esc_html__('Images', 'rit-core-language'),
                        'value' => '',
                        'param_name' => 'images',
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Links', 'rit-core-language'),
                        'value' => '',
                        'description'=> esc_html__('Enter links for each slide (Note: divide links with ",").', 'rit-core-language'),
                        'param_name' => 'links',
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__("Open in new tab.", 'rit-core-language'),
                        'param_name' => 'target',
                        'std' => 'no',
                        'value' => array(esc_html__('Yes', 'rit-core-language') => 'yes')
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