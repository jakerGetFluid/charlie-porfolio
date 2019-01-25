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


if (!function_exists('rit_shortcode_portfolio')) {
    function rit_shortcode_portfolio($atts)
    {
        $atts = shortcode_atts(array(
            'title' => '',
            'space_width' => 10,
            'style' => 'default',
            'layout' => 'masonry',
            'order_by' => 'date',
            'order' => 'DESC',
            'filter_align' => 'left',
            'columns' => '3',
            'img_size' => 'medium',
            'cat' => '',
            'post_in' => '',
            'number' => 8,
            'show_cat' => '',
            'view_more' => '',
            'view_more_text' => esc_html__('View more', 'rit-core-language'),
            'pagination' => 'standard',
            'animation_type' => '',
            'el_class' => ''
        ), $atts);

        return rit_get_template_part('shortcode', 'portfolio', array('atts' => $atts));
    }
}
add_shortcode('portfolio', 'rit_shortcode_portfolio');

add_action('vc_before_init', 'rit_portfolio_integrate_vc');
if (!(function_exists('listportfolio'))) {
    function listportfolio()
    {
        $args = array(
            'post_type' => 'portfolio',
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
if (!function_exists('rit_portfolio_integrate_vc')) {
    function rit_portfolio_integrate_vc()
    {
        vc_map(array(
            'name' => esc_html__('RIT Portfolios', 'rit-core-language'),
            'base' => 'portfolio',
            'category' => esc_html__('RIT', 'rit-core-language'),
            'icon' => 'rit-portfolios',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", 'rit-core-language'),
                    "param_name" => "title",
                    "admin_label" => true,
                    'description' => esc_html__('Enter text used as shortcode title (Note: located above content element)', 'rit-core-language'),
                ),
                array(
                    "type" => "rit_image_radio",
                    "heading" => esc_html__("Layout", 'rit-core-language'),
                    "param_name" => "layout",
                    'description' => esc_html__('Layout display. For build masonry like grid please Select Image Size field below is Thumbnail, Portfolio Thumbnail, Portfolio Medium', 'rit-core-language'),
                    'std' => 'default',
                    "admin_label" => true,
                    "value" => array(
                        RIT_PLUGIN_URL . 'assets/images/portfolio/masonry.png' => 'masonry',
                        RIT_PLUGIN_URL . 'assets/images/portfolio/metro.png' => 'metro',
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Image size", 'rit-core-language'),
                    "param_name" => "img_size",
                    "admin_label" => true,
                    'std' => 'medium',
                    "value" => array(
                        esc_html__('Portfolio Thumbnail (Crop)', 'rit-core-language') => 'rit-portfolio-thumb',
                        esc_html__('Portfolio Medium (Crop)', 'rit-core-language') => 'rit-portfolio-medium',
                        esc_html__('Medium', 'rit-core-language') => 'medium',
                        esc_html__('Large ', 'rit-core-language') => 'large',
                        esc_html__('Original size', 'rit-core-language') => 'full',
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Image size of portfolio, optimizer image size for loading. Select image size Thumbnail, Portfolio Thumbnail, Portfolio Medium if you want display it like grid', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Columns", 'rit-core-language'),
                    "param_name" => "columns",
                    "admin_label" => true,
                    'std' => '3',
                    "value" => array(
                        esc_html__('2', 'rit-core-language') => '2',
                        esc_html__('3', 'rit-core-language') => '3',
                        esc_html__('4', 'rit-core-language') => '4',
                        esc_html__('5', 'rit-core-language') => '5',
                        esc_html__('6', 'rit-core-language') => '6'
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Display portfolio with the number of columns. If you select Metro layout, it will be maximum columns', 'rit-core-language'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Gutter", 'rit-core-language'),
                    "param_name" => "space_width",
                    "std" => 10,
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Space width between each columns ', 'rit-core-language'),
                ),
                array(
                    "type" => "rit_image_radio",
                    "heading" => esc_html__("Hover Effect", 'rit-core-language'),
                    "param_name" => "style",
                    'description' => esc_html__('Display style, hover effect', 'rit-core-language'),
                    'std' => 'default',
                    "value" => array(
                        RIT_PLUGIN_URL . 'assets/images/portfolio/style-1.png' => 'style-1',
                        RIT_PLUGIN_URL . 'assets/images/portfolio/style-2.png' => 'style-2',
                        RIT_PLUGIN_URL . 'assets/images/portfolio/default.png' => 'default',
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Filter Align", 'rit-core-language'),
                    "param_name" => "filter_align",
                    'description' => esc_html__('', 'rit-core-language'),
                    'std' => 'left',
                    "value" => array(
                        esc_html__('Left', 'rit-core-language') => 'left',
                        esc_html__('Center', 'rit-core-language') => 'center',
                        esc_html__('Right', 'rit-core-language') => 'right',
                    ),
                    'group' => esc_html__('Layout', 'rit-core-language')
                ),
                array(
                    "type" => "rit_portfolio_categories",
                    "heading" => esc_html__("Category IDs", 'rit-core-language'),
                    "param_name" => "cat",
                    "admin_label" => true,
                    'description' => esc_html__('Select category which you want to get portfolio in', 'rit-core-language'),
                ),
                array(
                    "type" => "autocomplete",
                    "heading" => esc_html__("Portfolio IDs", 'rit-core-language'),
                    "description" => esc_html__("comma separated list of portfolio ids", 'rit-core-language'),
                    "param_name" => "post_in",
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'min_length' => 0,
                        'no_hide' => true, // In UI after select doesn't hide an select list
                        'groups' => true, // In UI show results grouped by groups
                        'unique_values' => true, // 0In UI show results except selected. NB! You should manually check values in backend
                        'display_inline' => true, // In UI show results inline view
                        'values' => listportfolio(),
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order by", 'rit-core-language'),
                    "param_name" => "order_by",
                    'std' => 'date',
                    "value" => array(
                        esc_html__('Author', 'rit-core-language') => 'author',
                        esc_html__('Comment count', 'rit-core-language') => 'comment_count',
                        esc_html__('Date', 'rit-core-language') => 'date',
                        esc_html__('Date modified', 'rit-core-language') => 'modified',
                        esc_html__('Featured', 'rit-core-language') => 'featured',
                        esc_html__('ID', 'rit-core-language') => 'ID',
                        esc_html__('Parent', 'rit-core-language') => 'parent',
                        esc_html__('Random', 'rit-core-language') => 'rand',
                        esc_html__('Title post', 'rit-core-language') => 'title'
                    ),
                    'description' => esc_html__('Choose type you want order', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order", 'rit-core-language'),
                    "param_name" => "order",
                    'std' => 'DESC',
                    "value" => array(
                        esc_html__('Ascending', 'rit-core-language') => 'ASC',
                        esc_html__('Descending', 'rit-core-language') => "DESC",
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Portfolios number", 'rit-core-language'),
                    "param_name" => "number",
                    "value" => '8',
                    'description' => esc_html__('Number of portfolios showing', 'rit-core-language'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Pagination", 'rit-core-language'),
                    "param_name" => "pagination",
                    'std' => 'standard',
                    "value" => array(
                        esc_html__('Standard', 'rit-core-language') => 'standard',
                        esc_html__('Infinite Scroll', 'rit-core-language') => 'infinite-scroll',
                        esc_html__('Ajax Load more', 'rit-core-language') => 'ajax',
                        esc_html__('None', 'rit-core-language') => 'none',
                    )
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Show Categories", 'rit-core-language'),
                    "param_name" => "show_cat",
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => 'yes'),
                ),
                array(
                    "type" => 'checkbox',
                    "heading" => esc_html__("Enable read more", 'rit-core-language'),
                    "param_name" => "view_more",
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'std' => '',
                    'value' => array(esc_html__('Yes', 'rit-core-language') => 'yes'),
                ),
                array(
                    "type" => 'textfield',
                    "heading" => esc_html__("View more text", 'rit-core-language'),
                    "param_name" => "view_more_text",
                    'dependency' => Array('element' => 'view_more', 'value' => 'yes'),
                    'group' => esc_html__('Layout', 'rit-core-language'),
                    'description' => esc_html__('Default is View more', 'rit-core-language'),
                ),
                array(
                    "type" => 'rit_animation_type',
                    "heading" => esc_html__("Animation Type", 'rit-core-language'),
                    "param_name" => "animation_type",
                    'group' => esc_html__('Layout', 'rit-core-language'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'rit-core-language'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language')
                )
            )
        ));
    }
}
