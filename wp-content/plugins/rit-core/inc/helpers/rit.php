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

/**
 * Function rit_get_template_dir_url
 * All file in wp-content/plugins/rit-core/assets can be override in wp-content/themes/theme_name/rit-core/assets
 *
 */
if (!function_exists('rit_get_template_dir_url')) {
    function rit_get_template_dir_url($asset_file)
    {
        if (file_exists(get_template_directory() . '/' . RIT_DIRECTORY_NAME . '/' . $asset_file)) {
            return get_template_directory_uri() . '/' . RIT_DIRECTORY_NAME . '/' . $asset_file;
        } elseif (file_exists(RIT_PLUGIN_PATH . $asset_file)) {
            return RIT_PLUGIN_URL . $asset_file;
        } else {
            return false;
        }
    }
}


/**
 * Function rit_get_template_part
 * Like wordpress function get_template_part with override templates file.
 * All file in wp-content/plugins/rit-core/html can be override in wp-content/themes/theme_name/rit-core/
 *
 */
if (!function_exists('rit_get_template_part')) {
    function rit_get_template_part($slug = null, $name = null, $params = array())
    {
        global $wp_query;
        $template_slug = RIT_DIRECTORY_NAME . '/' . $slug;
        do_action("get_template_part_{$template_slug}", $template_slug, $name);

        $templates = array();
        $pluginTemplates = array();
        if (isset($name)) {
            $templates[] = "{$template_slug}-{$name}.php";
            $pluginTemplates[] = "{$slug}-{$name}.php";
        }

        $templates[] = "{$template_slug}.php";
        $pluginTemplates[] = "{$slug}.php";

        $_template_file = locate_template($templates, false, false);

        if (is_array($wp_query->query_vars)) {
            extract($wp_query->query_vars, EXTR_SKIP);
        }
        extract($params, EXTR_SKIP);

        ob_start();
        if (file_exists($_template_file)) {
            include($_template_file);
        } elseif ((file_exists(RIT_PLUGIN_PATH . '/html/' . $pluginTemplates[0]))) {
            include(RIT_PLUGIN_PATH . '/html/' . $pluginTemplates[0]);
        }
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}

if (!function_exists('rit_get_the_previous_post_date')) {
    function rit_get_the_previous_post_date($post_id)
    {
        global $prev_post_year, $prev_post_month;
        $prev_post = get_previous_post($post_id);
        if ($prev_post) {
            $prev_post_timestamp = get_the_time('U', $prev_post->ID);
            $prev_post_year = date('o', $prev_post_timestamp);
            $prev_post_month = date('n', $prev_post_timestamp);
        }
        return;
    }
}

// List Google Font
if (!function_exists('rit_googlefont')) {
    function rit_googlefont()
    {
        $listGoogleFont = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAVT6Xd4qTswxLkmYTb6e_gH7iDpbxTx5M');
        if ($listGoogleFont) {
            $gfont = json_decode($listGoogleFont);
            $fontarray = $gfont->items;
            $options = array();
            foreach ($fontarray as $font) {
                $options[$font->family] = $font->family;
            }
            return $options;
        }
        return false;
    }
}


if (!function_exists('rit_pagination')) {
    function rit_pagination($range = 2, $current_query = '', $pages = '', $prev_icon = '<i class="fa fa-angle-left"></i>', $next_icon = '<i class="fa fa-angle-right"></i>')
    {
        $showitems = ($range * 2) + 1;

        if ($current_query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } else {
            $paged = $current_query->query_vars['paged'];
        }

        if ($pages == '') {
            if ($current_query == '') {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if (!$pages) {
                    $pages = 1;
                }
            } else {
                $pages = $current_query->max_num_pages;
            }
        }

        if (1 != $pages) { ?>
            <div class="pagination clearfix">
                <?php if ($paged > 1) { ?>
                    <a class="pagination-prev"
                       href="<?php echo esc_url(get_pagenum_link($paged - 1)) ?>"><?php echo $prev_icon ?></a>
                <?php }

                for ($i = 1; $i <= $pages; $i++) {
                    if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                        if ($paged == $i) { ?>
                            <span class="current"><?php echo esc_html($i) ?></span>
                        <?php } else { ?>
                            <a href="<?php echo esc_url(get_pagenum_link($i)) ?>"
                               class="inactive"><?php echo esc_html($i) ?></a>
                            <?php
                        }
                    }
                }
                if ($paged < $pages) { ?>
                    <a class="pagination-next"
                       href="<?php echo esc_url(get_pagenum_link($paged + 1)) ?>"><?php echo $next_icon ?></a>
                <?php } ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('rit_get_query_var')) {
    function rit_get_query_var($var, $default = null)
    {
        if ((is_front_page() || is_home()) && $var == 'paged') {
            $var = 'page';
        }
        return get_query_var($var, $default);
    }
}


if( !function_exists( 'rit_infinity_scroll' ) ) {
    function rit_infinity_scroll($the_query, $wrap, $item, $isotope=false){
        wp_enqueue_script('rit-imagesloaded-js');
        wp_enqueue_script('rit-infinitescroll-js');
        ?>
        <div class="nav-load-more hidden">
             <?php echo rit_pagination(3, $the_query); ?>
        </div>
        <script>
            (function($) {
                "use strict";
                jQuery(document).ready(function(){

                    var infiniteScroll = {
                        loading: {
                            finishedMsg: '<?php esc_html_e('No more pages to load.','rit-core-language')?>',
                            msgText: "<span class='loading'></span>",
                            img: null
                        },
                        navSelector: '.pagination', // selector for the paged navigation
                        nextSelector: '.pagination .pagination-next', // selector for the NEXT link (to page 2)
                        itemSelector: '<?php echo esc_js($item)?>', // selector for all items you'll retrieve
                        contentSelector: '<?php echo esc_js($wrap)?>'
                    };
                    var $target=$('<?php echo esc_js($wrap)?>').find('<?php echo esc_js($item)?>').parent();

                    jQuery( infiniteScroll.contentSelector ).infinitescroll(
                        infiniteScroll, function(data) {
                            var $newElems = $(data).css({opacity: 0});
                            $target.append($newElems);
                            $newElems.imagesLoaded(function () {
                                $newElems.animate({opacity: 1});
                                <?php if($isotope){?>
                                $('<?php echo esc_js($wrap)?>').find($target).isotope('reloadItems');
                                $('<?php echo esc_js($wrap)?>').find($target).isotope();
                                <?php } ?>

                            });
                        }
                    );
                });

            })(jQuery);
        </script>
        <?php
    }
}


if (!function_exists('rit_current_url')) {
    function rit_current_url()
    {
        $s = $_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host = (false && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host . $s['REQUEST_URI'];
    }
}
/* Begin Ajax load more button*/
add_action('wp_ajax_nopriv_rit_ajax_load_more_func', 'rit_ajax_load_more_func');
add_action('wp_ajax_rit_ajax_load_more_func', 'rit_ajax_load_more_func');
if (!function_exists('rit_ajax_load_more_func')) {
    function rit_ajax_load_more_func()
    {
        $func = $_POST['func'];
        $atts = json_decode(stripslashes($_POST['atts']), true);
        echo rit_get_template_part($func, '', array('atts' => $atts));
    }
}
if (!function_exists('rit_ajax_load_more')) {
    function rit_ajax_load_more($file, $atts, $query = '', $wrap, $target, $isotope = false)
    {
        wp_enqueue_script('rit-imagesloaded-js');
        $paged = $pages = '';
        if ($query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } else {
            $paged = $query->query_vars['paged'];
        }
        if ($query == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        } else {
            $pages = $query->max_num_pages;
        }
        $loadmore = __('Load More', 'rit-core-language');
        if ($paged >= $pages) {
            $loadmore = __('No More Load', 'rit-core-language');
        } else {
            $atts['paged'] = $paged + 1;
        }
        ?>
        <div class="rit-ajax-load-more">
            <a href="#" class="ajax-func <?php echo esc_attr($paged >= $pages ? 'no-load' : ''); ?>"><span
                    class="btn-ajax-load"><?php echo esc_html($loadmore) ?></span></a>
            <script type="text/javascript">
                (function ($) {
                    "use strict";
                    $(document).ready(function () {
                        $('.ajax-func').on('click', function (e) {
                            e.preventDefault();
                            if ($(this).not('.no-load')[0]) {
                                $(this).addClass('loading');
                                var $this = $(this);
                                var $wrap=$this.parents('<?php echo esc_js($wrap)?>').find('<?php echo esc_js($target)?>');
                                // prepend items to grid
                                $.ajax({
                                    url: "<?php echo admin_url('admin-ajax.php')?>",
                                    data: {
                                        action: 'rit_ajax_load_more_func',
                                        func: '<?php echo esc_js($file);?>',
                                        atts: '<?php echo json_encode($atts);?>'
                                    },
                                    type: 'POST',
                                    success: function (response) {
                                        $this.removeClass('loading');
                                        var content = $(response).find('<?php echo esc_js($target)?>').html();
                                        var ajax_page = $(response).find('<?php echo esc_js('.rit-ajax-load-more')?>').html();
                                        var $newElems = $(content).css({opacity: 0});
                                        console.log($newElems.find('img.lazy-img')[0]);
                                        if($newElems.find('img.lazy-img')[0]){
                                            $newElems.find('img.lazy-img').each(function () {
                                                $(this).attr('src',$(this).data('original'));
                                            })
                                        }
                                        $wrap.append($newElems);
                                        $newElems.imagesLoaded(function () {
                                            $newElems.animate({opacity: 1});
                                            <?php if($isotope){?>
                                            $wrap.isotope('reloadItems');
                                            $wrap.isotope();
                                            <?php } ?>
                                        });
                                        $this.parent().html(ajax_page);
                                    }
                                })
                            }
                        });
                    })
                })(jQuery);
            </script>
        </div>
        <?php
    }
}
/* End Ajax load more button*/
// Sub String excerpt
if (!function_exists('rit_excerpt')) {
    function rit_excerpt($limit)
    {
        $content = explode(' ', get_the_excerpt(), $limit);
        if (count($content) >= $limit) {
            array_pop($content);
            $content = implode(" ", $content) . '...';
        } else {
            $content = implode(" ", $content) . '';
        }
        $content = preg_replace('/\[.+\]/', '', $content);
        $content = apply_filters('the_excerpt', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
}
function new_excerpt_more($more)
{
    return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');


if (!function_exists('rit_donate_button')) {
    function rit_donate_button($post = null)
    {
        return rit_get_template_part('cause/button', 'donate', array('params' => array('item' => $post)));
    }
}


if (!function_exists('rit_money_format')) {
    function rit_money_format($number, $currency_format = '', $currency_symbol = '', $decimal = 1)
    {
        if ($currency_format == '')
            $currency_format = get_theme_mod('rit_cause_currency_format', 'NUMBER$');

        if ($currency_symbol == '')
            $currency_symbol = get_theme_mod('rit_cause_currency_symbol', '$');

        $currency_format = str_replace('$', $currency_symbol, $currency_format);


        return str_replace('NUMBER', number_format_i18n($number, $decimal), $currency_format);
    }
}


add_action('wp_ajax_save_paypal_form', 'rit_save_paypal_form');
add_action('wp_ajax_nopriv_save_paypal_form', 'rit_save_paypal_form');

if (!function_exists('rit_save_paypal_form')) {
    function rit_save_paypal_form()
    {
        $ret = array();

        if (!check_ajax_referer('rit-paypal-create-nonce', 'security', false)) {
            $ret['status'] = 'failed';
            $ret['message'] = esc_html__('Invalid Nonce', 'rit-core-language');
        } else {
            $record = get_option('rit_paypal', array());
            $item_id = sizeof($record);

            $record[$item_id]['name'] = $_POST['rit-name'];
            $record[$item_id]['last-name'] = $_POST['rit-last-name'];
            $record[$item_id]['email'] = $_POST['rit-email'];
            $record[$item_id]['phone'] = $_POST['rit-phone'];
            $record[$item_id]['address'] = $_POST['rit-address'];
            $record[$item_id]['addition'] = $_POST['rit-additional-note'];
            $record[$item_id]['post-id'] = $_POST['item_number'];

            $ret['status'] = 'success';
            $ret['message'] = esc_html__('Redirecting to paypal', 'rit-core-language');
            $ret['item_number'] = $item_id;

            update_option('rit_paypal', $record);
        }
        die(json_encode($ret));
    }
}


//payment paypal callback code
if (isset($_GET['paypal']) && $_GET['paypal'] == 'ipn') {


    $item_number = $_REQUEST['item_number'];

    if ($_REQUEST['payment_status'] == 'Completed') {

        $temp_currency = trim(get_post_meta($item_number, 'rit_current_funding', true));

        $temp_currency = floatval($temp_currency) ? floatval($temp_currency) : 0;

        $temp_currency = floatval($temp_currency + floatval($_REQUEST['mc_gross']));


        update_post_meta($item_number, 'rit_current_funding', $temp_currency);

    }

    $record = get_option('rit_paypal', array());

    $record[$item_number]['status'] = $_REQUEST['payment_status'];
    $record[$item_number]['txn_id'] = $_REQUEST['txn_id'];
    $record[$item_number]['amount'] = $_REQUEST['mc_gross'] . ' ' . $_REQUEST['mc_currency'];

    update_option('rit_paypal', $record);
}

if (!function_exists('merge_google_font')) {
    function merge_google_font($font_array)
    {
        $fonts = array();

        foreach ($font_array as $font) {

            if (!isset($fonts[$font['family']])) {

                $fonts[$font['family']] = $font;

            } else {
                $fonts[$font['family']]['variants'] = array_merge($fonts[$font['family']]['variants'], $font['variants']);
                $fonts[$font['family']]['subsets'] = array_merge($fonts[$font['family']]['subsets'], $font['subsets']);

            }
        }
        return $fonts;
    }
}


if (!function_exists('create_google_font_url')) {
    function create_google_font_url($font_array)
    {

        if (count($font_array) > 0) {

            $font_array = merge_google_font($font_array);

            $base_url = '';
            $font_familys = array();
            $subsets = array();

            foreach ($font_array as $font) {
                if (isset($font['family'])) {
                    $font_familys[] = str_replace(' ', '+', $font['family']) . ':' . implode(',', array_unique($font['variants']));
                    $subsets = array_merge($subsets, array_unique($font['subsets']));
                }
            }
            if (count($font_familys) > 0) {
                $base_url .= implode('|', $font_familys);
            }
            if (count($subsets) > 0) {
                $base_url .= '&subset=' . implode(',', $subsets);
            }
            if ($base_url != '') {
                return '//fonts.googleapis.com/css?family=' . $base_url;
            }
        }
        return null;
    }
}

if (!function_exists('rit_get_category_list')) {
    function rit_get_category_list($taxonomies)
    {

        $categories = get_terms($taxonomies);
        $result = array();
        if (count($categories) > 0) {
            foreach ($categories as $categorie) {
                $result[$categorie->name] = $categorie->slug;
            }
        }
        return $result;
    }
}
// Author Link Social
if (!function_exists('rit_fusion_social_author')) {
    function rit_fusion_social_author($contactmethods)
    {
        $contactmethods['twitter'] = esc_html__('Twitter Username', 'rit-core-language');
        $contactmethods['facebook'] = esc_html__('Facebook Username', 'rit-core-language');
        $contactmethods['google'] = esc_html__('Google Plus Username', 'rit-core-language');
        $contactmethods['tumblr'] = esc_html__('Tumblr Username', 'rit-core-language');
        $contactmethods['instagram'] = esc_html__('Instagram Username', 'rit-core-language');
        $contactmethods['pinterest'] = esc_html__('Pinterest Username', 'rit-core-language');

        return $contactmethods;
    }
}

add_filter('user_contactmethods', 'rit_fusion_social_author', 10, 1);