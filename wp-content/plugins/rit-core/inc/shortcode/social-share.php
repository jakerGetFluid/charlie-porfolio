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

if (!function_exists('rit_social_share_shortcode')) {
    function rit_social_share_shortcode($atts)
    {
        $atts = shortcode_atts(array(
                	'social_list' => '',
	                'counter_format' => 'comma',
	                'cache_time' => 600
	            ), $atts);

        return rit_get_template_part('shortcode', 'social-share', array('atts' => $atts));
    }
}
add_shortcode('rit-social-share', 'rit_social_share_shortcode');

add_action('vc_before_init', 'rit_social_share_integrate_vc');

if (!function_exists('rit_social_share_integrate_vc')) {
    function rit_social_share_integrate_vc()
    {
        vc_map(
        	array(
	            'name' => esc_html__('RIT Social Share', 'rit-core-language'),
	            'base' => 'rit-social-share',
	            'category' => esc_html__('RIT', 'rit-core-language'),
	            'icon' => 'rit-social-share',
	            "params" => array(
	                array(
	                    "type" => "rit_multi_select",
	                    "heading" => esc_html__("Social List", 'rit-core-language'),
	                    "param_name" => "social_list",
	                    'value' => array(
	                        esc_html__('Facebook', 'rit-core-language') => 'facebook',
	                        esc_html__('Twitter', 'rit-core-language') => 'twitter',
	                        esc_html__('Google +', 'rit-core-language') => 'googlePlus',
	                        esc_html__('Pinterest', 'rit-core-language') => 'pinterest',
	                        esc_html__('LinkedIn', 'rit-core-language') => 'linkedIn'
	                    ),
	                    'description' => esc_html__('Select list social button will be display', 'rit-core-language'),
	                ),
	                array(
	                    "type" => "rit_multi_select",
	                    "heading" => esc_html__("Counter Format", 'rit-core-language'),
	                    "param_name" => "counter_format",
	                    'value' => array(
	                        esc_html__('Comma', 'rit-core-language') => 'comma',
	                        esc_html__('Short', 'rit-core-language') => 'short',
	                    ),
	                    'description' => esc_html__('Counter Format will be display is 100,000 or 100k', 'rit-core-language'),
	                ),
	            ),
            )
        );
    }
}