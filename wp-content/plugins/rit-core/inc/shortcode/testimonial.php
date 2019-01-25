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

if (!function_exists('rit_shortcode_testimonial')) {
    function rit_shortcode_testimonial($atts)
    {
        $atts = shortcode_atts(array(
            'title' => '',
            'text_size' => '',
            'item_count'	=> '-1',
            'order'	=> '',
            'category'		=> '',
            'pagination'	=> 'no',
            'page_link'	=> '',
            'el_class' => '',
        ), $atts);

        $layout_type = ($atts['testimonial_layout'] != '') ? $atts['testimonial_layout'] : 'large';

        return rit_get_template_part('shortcode', 'testimonial-' . $layout_type, array('atts' => $atts));
    }
}
add_shortcode('testimonial', 'rit_shortcode_testimonial');

add_action('vc_before_init', 'rit_testimonial_integrate_vc');

if (!function_exists('rit_testimonial_integrate_vc')) {
    function rit_testimonial_integrate_vc()
    {
        vc_map( array(
            "name"		=> esc_html__("Testimonials", 'rit-core-language'),
            "base"		=> "testimonial",
            "class"		=> "",
            "icon"      => "spb-icon-testimonial",
            "wrapper_class" => "clearfix",
            "controls"	=> "full",
            "params"	=> array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", 'rit-core-language'),
                    "param_name" => "title",
                    "value" => "",
                    "description" => esc_html__("Heading text. Leave it empty if not needed.", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Text size", 'rit-core-language'),
                    "param_name" => "text_size",
                    "value" => array(
                        esc_html__('Normal', 'rit-core-language') => "normal",
                        esc_html__('Large', 'rit-core-language') => "large"
                    ),
                    "description" => esc_html__("Choose the size of the text.", 'rit-core-language')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Number of items", 'rit-core-language'),
                    "param_name" => "item_count",
                    "value" => "6",
                    "description" => esc_html__("The number of testimonials to show per page. Leave blank to show ALL testimonials.", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Testimonials Order", 'rit-core-language'),
                    "param_name" => "order",
                    "value" => array(
                        esc_html__('Random', 'rit-core-language') => "rand",
                        esc_html__('Latest', 'rit-core-language') => "date"
                    ),
                    "description" => esc_html__("Choose the order of the testimonials.", 'rit-core-language')
                ),
                array(
                    "type" => "rit_testimonial_categories",
                    "heading" => esc_html__("Testimonials category", 'rit-core-language'),
                    "param_name" => "category",
                    "description" => esc_html__("Choose the category for the testimonials.", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Pagination", 'rit-core-language'),
                    "param_name" => "pagination",
                    "value" => array(esc_html__('No', 'rit-core-language') => "no", esc_html__('Yes', 'rit-core-language') => "yes"),
                    "description" => esc_html__("Show testimonial pagination (1/1 width element only).", 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Testimonials page link", 'rit-core-language'),
                    "param_name" => "page_link",
                    "value" => array(esc_html__('No', 'rit-core-language') => "no", esc_html__('Yes', 'rit-core-language') => "yes"),
                    "description" => esc_html__("Include a link to the testimonials page (which you must choose in the theme options).", 'rit-core-language')
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'rit-core-language'),
                    "param_name" => "el_class",
                    "value" => "",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'rit-core-language')
                )
            )
        ) );
    }
}
