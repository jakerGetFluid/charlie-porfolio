<?php

if (!function_exists('rit_shortcode_envira_gallery')) {
    function rit_shortcode_envira_gallery($atts)
    {
        $atts = shortcode_atts(
            array(
                'shortcode'=>'',
                'el_class' => '',
            ), $atts);
        return rit_get_template_part('shortcode', 'envira-gallery', array('atts' => $atts));
    }
}

add_shortcode('rit_envira_gallery', 'rit_shortcode_envira_gallery');

add_action('vc_before_init', 'rit_shortcode_envira_gallery_integrate_vc');
if (!(function_exists('listgalleries'))) {
    function listgalleries()
    {
        $args = array(
            'post_type' => 'envira',
            'posts_per_page' =>-1
        );
        $the_query = new WP_Query($args);
        $results = array();
        if ($the_query->have_posts()):
            while ($the_query->have_posts()): $the_query->the_post();
                $data = array();
                $data['value'] = get_the_ID();
                $data['label'] = get_the_title();
                $results[] = $data;
            endwhile;
        endif;
        wp_reset_postdata();
        return $results;
    }
}
if (!function_exists('rit_shortcode_envira_gallery_integrate_vc')) {
    function rit_shortcode_envira_gallery_integrate_vc()
    {
        vc_map(
            array(
                'name' => esc_html__('RIT Envira Gallery Shortcode', 'rit-core-language'),
                'base' => 'rit_envira_gallery',
                'icon' => 'icon-rit',
                'category' => esc_html__('RIT', 'rit-core-language'),
                'description' => esc_html__('Help build layout for Envira Gallery.', 'rit-core-language'),
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Shortcode', 'rit-core-language' ),
                        'param_name' => 'shortcode',
                        'value'=>listgalleries(),
                        'description' => esc_html__( 'Shortcode of Envira Gallery.', 'rit-core-language' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Extra class name', 'rit-core-language' ),
                        'param_name' => 'el_class',
                        'value' => '',
                        'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language' )
                    )
                )
            )
        );
    }
}