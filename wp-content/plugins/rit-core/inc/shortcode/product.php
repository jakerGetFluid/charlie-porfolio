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
if (!function_exists('rit_shortcode_products')) {
    function rit_shortcode_products($atts, $content)
    {

        if ( class_exists( 'WooCommerce' ) ) {
            $product_categories = get_categories( 
                array(
                    'taxonomy' => 'product_cat',
                )
            );
            $product_cats = array();
            $product_cats_all = '';
            if (count($product_categories) > 0) {
                
                foreach ($product_categories as $value) {
                    $product_cats[$value->name] = $value->slug;
                }
                $product_cats_all = implode(',', $product_cats);
            }


            $product_tags = get_terms( 'product_tag');
            $product_tags_arr = array();
            $product_tags_all = '';
            if (count($product_tags) > 0) {
                
                foreach ($product_tags as $value) {
                    $product_tags_arr[$value->name] = $value->slug;
                }
                $product_tags_all = implode(',', $product_tags_arr);
            }


            $attributes_arr = array();
            $attributes_arr_all = '';
            if(function_exists('wc_get_attribute_taxonomies')){
                $product_attribute_taxonomies = wc_get_attribute_taxonomies();
                if (count($product_attribute_taxonomies) > 0) {
                    
                    foreach ($product_attribute_taxonomies as $value) {
                        $attributes_arr[$value->attribute_label] = $value->attribute_name;
                    }
                    $attributes_arr_all = implode(',', $attributes_arr);
                }
            }

            $atts = shortcode_atts(array(
                'title' => '',
                'post_type' => 'product',
                'pagination' => 'simple',
                'column' => 'columns6',
                'posts_per_page' => 4,
                'products_type' => 'products_carousel',
                'products_img_size' => 'shop_thumbnail',
                'paged' => 1,
                'ignore_sticky_posts' => 1,
                'show' => '',
                'orderby' => 'date',
                'element_custom_class' => '',
                'padding_bottom_module' => '50px',
                'filter_categories' => $product_cats_all,
                'filter_tags' => $product_tags_all,
                'filter_attributes' => $attributes_arr_all,
                'show_filter' => 1,
                'show_featured_filter'=> 1,
                'show_price_filter'=> 1,
                'price_filter_level'=> 5,
                'price_filter_range' => 100,
                'show_loadmore' => 1
            ), $atts);


            $meta_query = WC()->query->get_meta_query();


            $wc_attr = array(
                'post_type' => 'product',
                'posts_per_page' => $atts['posts_per_page'],
                'paged' => $atts['paged'],
                'orderby' => $atts['orderby'],
                'ignore_sticky_posts' => $atts['ignore_sticky_posts'],
            );

            if ($atts['show'] == 'featured') {

                
                $meta_query[] = array(
                    'key' => '_featured',
                    'value' => 'yes'
                );

                $wc_attr['meta_query'] = $meta_query;

            } elseif ($atts['show'] == 'onsale') {

                $product_ids_on_sale = wc_get_product_ids_on_sale();

                $wc_attr['post__in'] = $product_ids_on_sale;

                $wc_attr['meta_query'] = $meta_query;

            } elseif ($atts['show'] == 'best-selling') {

                $wc_attr['meta_key'] = 'total_sales';

                $wc_attr['meta_query'] = $meta_query;

            } elseif ($atts['show'] == 'latest'){

                $wc_attr['orderby'] = 'date';

                $wc_attr['order'] = 'DESC';

            } elseif ($atts['show'] == 'toprate'){

                add_filter('posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses'));

            } elseif ($atts['show'] == 'price'){

                $wc_attr['orderby']  = "meta_value_num {$wpdb->posts}.ID";
                $wc_attr['order']    = 'ASC';
                $wc_attr['meta_key'] = '_price';

            } elseif ($atts['show'] == 'price-desc'){

                $wc_attr['orderby']  = "meta_value_num {$wpdb->posts}.ID";
                $wc_attr['order']    = 'DESC';
                $wc_attr['meta_key'] = '_price';

            }
            if($atts['filter_categories'] != $product_cats_all && $atts['filter_categories'] !=  ''){
                $wc_attr['product_cat'] = $atts['filter_categories'];
            }
            

            $atts['wc_attr'] = $wc_attr;


            return rit_get_template_part('shortcode', 'product', array('atts' => $atts));
        }
        return null;

    }
}
if (!function_exists('products_carousel_script')) {
    function products_carousel_script()
    {
        wp_enqueue_script('owlCarousel', RIT_PLUGIN_URL . '/assets/js/owl.carousel.min.js', false, false, true);
    }
}

add_shortcode('rit_products', 'rit_shortcode_products');

add_action('vc_before_init', 'rit_product_integrate_vc');

if (!function_exists('rit_product_integrate_vc')) {
    function rit_product_integrate_vc()
    {
        if ( class_exists( 'WooCommerce' ) ) {
            $product_categories = get_categories( 
                array(
                    'taxonomy' => 'product_cat',
                )
            );
            $product_cats = array();
            $product_cats_all = '';
            if (count($product_categories) > 0) {
                
                foreach ($product_categories as $value) {
                    $product_cats[$value->name] = $value->slug;
                }
                $product_cats_all = implode(',', $product_cats);
            }


            $product_tags = get_terms( 'product_tag');
            $product_tags_arr = array();
            $product_tags_all = '';
            if (count($product_tags) > 0) {
                
                foreach ($product_tags as $value) {
                    $product_tags_arr[$value->name] = $value->slug;
                }
                $product_tags_all = implode(',', $product_tags_arr);
            }


            $attributes_arr = array();
            $attributes_arr_all = '';
            if(function_exists('wc_get_attribute_taxonomies')){
                $product_attribute_taxonomies = wc_get_attribute_taxonomies();
                if (count($product_attribute_taxonomies) > 0) {
                    
                    foreach ($product_attribute_taxonomies as $value) {
                        $attributes_arr[$value->attribute_label] = $value->attribute_name;
                    }
                    $attributes_arr_all = implode(',', $attributes_arr);
                }
            }


            vc_map(
                array(
                    'name' => esc_html__('RIT Products', 'rit-core-language'),
                    'base' => 'rit_products',
                    'icon' => 'icon-rit',
                    'category' => esc_html__('RIT', 'rit-core-language'),
                    'description' => esc_html__('Show multiple products by ID or SKU.', 'rit-core-language'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Title', 'rit-core-language'),
                            'value' => '',
                            'param_name' => 'title',
                            'description' => esc_html__('Enter text used as shortcode title (Note: located above content element)', 'rit-core-language'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Layout type', 'rit-core-language'),
                            'value' => array(
                                esc_html__('Carousel', 'rit-core-language') => 'products_carousel',
                                esc_html__('Grid', 'rit-core-language') => 'products_grid',
                                esc_html__('List', 'rit-core-language') => 'products_list'
                            ),
                            'param_name' => 'products_type',
                            'description' => esc_html__('Select layout type for display product', 'rit-core-language'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Image size', 'rit-core-language'),
                            'value' => array(
                                esc_html__('Thumbnail', 'rit-core-language') => 'shop_thumbnail',
                                esc_html__('Catalog Images', 'rit-core-language') => 'shop_catalog',
                                esc_html__('Single Product Image', 'rit-core-language') => 'shop_single'
                            ),
                            'param_name' => 'products_img_size',
                            'description' => esc_html__('Select image size follow size in woocommerce product image size', 'rit-core-language'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Column number', 'rit-core-language'),
                            'value' => array(
                                esc_html__('1 Columns', 'rit-core-language') => 'columns1',
                                esc_html__('2 Columns', 'rit-core-language') => 'columns2',
                                esc_html__('3 Columns', 'rit-core-language') => 'columns3',
                                esc_html__('4 Columns', 'rit-core-language') => 'columns4',
                                esc_html__('5 Columns', 'rit-core-language') => 'columns5',
                                esc_html__('6 Columns', 'rit-core-language') => 'columns6'
                            ),
                            'std' => 'columns3',
                            'param_name' => 'column',
                            'description' => esc_html__('Display product with the number of column', 'rit-core-language'),
                        ),
                        array(
                            "type" => "rit_multi_select",
                            "heading" => esc_html__("Select Product Categories", 'rit-core-language'),
                            "param_name" => "categories_in",
                            "std" => $product_cats_all,
                            "value" => $product_cats,
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('"Asset type', 'rit-core-language'),
                            'value' => array(
                                esc_html__('All', 'rit-core-language') => '',
                                esc_html__('Featured product', 'rit-core-language') => 'featured',
                                esc_html__('Onsale product', 'rit-core-language') => 'onsale',
                                esc_html__('Best Selling', 'rit-core-language') => 'best-selling',
                                esc_html__('Latest product', 'rit-core-language') => 'latest',
                                esc_html__('Top rate product', 'rit-core-language') => 'toprate ',
                                esc_html__('Sort by price: low to high', 'rit-core-language') => 'price',
                                esc_html__('Sort by price: high to low', 'rit-core-language') => 'price-desc',
                            ),
                            'std' => '',
                            'param_name' => 'show',
                            'description' => esc_html__('Select asset type of products', 'rit-core-language'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Order by', 'rit-core-language'),
                            'value' => array(
                                esc_html__('Date', 'rit-core-language') => 'date',
                                esc_html__('Menu order', 'rit-core-language') => 'menu_order',
                                esc_html__('Title', 'rit-core-language') => 'title',
                            ),
                            'std' => 'date',
                            'param_name' => 'orderby',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Number of product', 'rit-core-language'),
                            'value' => 6,
                            'param_name' => 'posts_per_page',
                            'description' => esc_html__('Number of product showing', 'rit-core-language'),
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Ignore sticky posts", 'rit-core-language'),
                            "param_name" => "ignore_sticky_posts",
                            'std' => 1,
                            "value" => array(
                                esc_html__('No', 'rit-core-language' ) => 0,
                                esc_html__('Yes', 'rit-core-language' ) => 1,
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Custom Class', 'rit-core-language'),
                            'value' => '',
                            'param_name' => 'element_custom_class',
                            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'rit-core-language'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Bottom padding for the module', 'rit-core-language'),
                            'value' => '50px',
                            'param_name' => 'padding_bottom_module',
                            'description' => esc_html__('The space in bottom. Default is 50px', 'rit-core-language'),
                        ),
                        
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Show Load More button", 'rit-core-language'),
                            "param_name" => "show_loadmore",
                            'std' => 1,
                            "value" => array(
                                esc_html__('No', 'rit-core-language' ) => 0,
                                esc_html__('Yes', 'rit-core-language' ) => 1,
                            ),
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Show Filter", 'rit-core-language'),
                            "param_name" => "show_filter",
                            'std' => 1,
                            "value" => array(
                                esc_html__('No', 'rit-core-language' ) => 0,
                                esc_html__('Yes', 'rit-core-language' ) => 1,
                            ),
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Show Featured, Onsale, Best Selling, Latest product filter", 'rit-core-language'),
                            "param_name" => "show_featured_filter",
                            'std' => '1',
                            "dependency" => Array('element' => 'show_filter', 'value' => array('1')),
                            "value" => array(
                                esc_html__('No', 'rit-core-language' ) => 0,
                                esc_html__('Yes', 'rit-core-language' ) => 1,
                            ),
                        ),
                        array(
                            "type" => "rit_product_categories",
                            "heading" => esc_html__("Categories showing in the filter", 'rit-core-language'),
                            "param_name" => "filter_categories",
                            "dependency" => Array('element' => 'show_filter', 'value' => array('1')),
                            "std" => $product_cats_all,
                            "value" => $product_cats,
                        ),
                        array(
                            "type" => "rit_multi_select",
                            "heading" => esc_html__("Tags showing in the filter", 'rit-core-language'),
                            "param_name" => "filter_tags",
                            "dependency" => Array('element' => 'show_filter', 'value' => array('1')),
                            "std" => $product_tags_all,
                            "value" => $product_tags_arr,
                        ),
                        array(
                            "type" => "rit_multi_select",
                            "heading" => esc_html__("Product attributes showing in the filter", 'rit-core-language'),
                            "param_name" => "filter_attributes",
                            "dependency" => Array('element' => 'show_filter', 'value' => array('1')),
                            "std" => $attributes_arr_all,
                            "value" => $attributes_arr,
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Show Price Filter", 'rit-core-language'),
                            "param_name" => "show_price_filter",
                            "std" => 1,
                            "dependency" => Array('element' => 'show_filter', 'value' => array('1')),
                            "value" => array(
                                esc_html__('No', 'rit-core-language' ) => 0,
                                esc_html__('Yes', 'rit-core-language' ) => 1,
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Number of price levels', 'rit-core-language'),
                            'value' => '5',
                            'std' => '5',
                            'param_name' => 'price_filter_level',
                            "dependency" => Array('element' => 'show_price_filter', 'value' => array('1')),
                            'description' => esc_html__('Number of price levels showing in the filter', 'rit-core-language'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Filter range', 'rit-core-language'),
                            'std' => '100',
                            'value' => '100',
                            'param_name' => 'price_filter_range',
                            "dependency" => Array('element' => 'show_price_filter', 'value' => array('1')),
                            'description' => esc_html__('Range of price filter. Example range equal 100 => price filter are "0$ to 100$", "100$ to 200$"', 'rit-core-language'),
                        ),
                    )
                )
            );
        }
    }
}