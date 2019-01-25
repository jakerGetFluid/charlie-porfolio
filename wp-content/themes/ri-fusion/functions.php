<?php
/**
 * ri-fusion functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since ri-fusion 1.0
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (!isset($content_width)) {
    $content_width = 660;
}
if (!function_exists('rit_fusion_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since ri-fusion 1.0
     */
    function rit_fusion_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on ri_fusion, use a find and replace
         * to change 'ri-fusion' to the name of your theme in all the template files
         */
        load_theme_textdomain('ri-fusion', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
        add_theme_support( "custom-header");
        add_theme_support( "custom-background");
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(85, 60, true);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'canvas' => esc_html__('Off Canvas Menu (Mobile Menu)', 'ri-fusion'),
            'primary' => esc_html__('Primary Menu', 'ri-fusion'),
            'primary-2' => esc_html__('Primary Menu for Header Logo Center', 'ri-fusion'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ));
    }
endif; // ri_fusion_setup
add_action('after_setup_theme', 'rit_fusion_setup');

/**
 * Register widget area.
 *
 * @since ri-fusion 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
if (!function_exists('rit_fusion_get_link_url')) :
    /**
     * Return the post URL.
     *
     * Falls back to the post permalink if no URL is found in the post.
     *
     * @since ri-fusion 1.0
     *
     * @see get_url_in_content()
     *
     * @return string The Link format URL.
     */
    function rit_fusion_get_link_url()
    {
        $has_url = get_url_in_content(get_the_content());
        return $has_url ? $has_url : apply_filters('the_permalink', esc_url(get_permalink()));
    }
endif;

if (!function_exists('rit_fusion_entry_meta')) :
    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * @since ri_fusion 1.0
     */
    function rit_fusion_entry_meta()
    {
        if (is_sticky() && is_home() && !is_paged()) {
            printf('<span class="sticky-post">%s</span>', esc_html__('Featured', 'ri-fusion'));
        }
        $format = get_post_format();
        if (current_theme_supports('post-formats', $format)) {
            printf('<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
                sprintf('<span class="screen-reader-text">%s </span>', esc_attr_x('Format', 'Used before post format.', 'ri-fusion')),
                esc_url(get_post_format_link($format)),
                get_post_format_string($format)
            );
        }
        if (in_array(get_post_type(), array('post', 'attachment'))) {
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf($time_string,
                esc_attr(get_the_date('c')),
                get_the_date(),
                esc_attr(get_the_modified_date('c')),
                get_the_modified_date()
            );

            printf('<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="' . esc_html__('bookmark', 'ri-fusion') . '">%3$s</a></span>',
                esc_attr_x('Posted on', 'Used before publish date.', 'ri-fusion'),
                esc_url(get_permalink()),
                $time_string
            );
        }

        if ('post' == get_post_type()) {
            if (is_singular() || is_multi_author()) {
                printf('<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
                    esc_attr_x('Author', 'Used before post author name.', 'ri-fusion'),
                    esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                    get_the_author()
                );
            }

            $categories_list = get_the_category_list(esc_attr_x(', ', 'Used between list items, there is a space after the comma.', 'ri-fusion'));
            if ($categories_list && ri_fusion_categorized_blog()) {
                printf('<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                    esc_attr_x('Categories', 'Used before category names.', 'ri-fusion'),
                    $categories_list
                );
            }

            $tags_list = get_the_tag_list('', esc_attr_x(', ', 'Used between list items, there is a space after the comma.', 'ri-fusion'));
            if ($tags_list) {
                printf('<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                    esc_attr_x('Tags', 'Used before tag names.', 'ri-fusion'),
                    $tags_list
                );
            }
        }

        if (is_attachment() && wp_attachment_is_image()) {
            // Retrieve attachment metadata.
            $metadata = wp_get_attachment_metadata();

            printf('<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
                esc_attr_x('Full size', 'Used before full size attachment link.', 'ri-fusion'),
                esc_url(wp_get_attachment_url()),
                $metadata['width'],
                $metadata['height']
            );
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link(sprintf(wp_kses(__('Leave a comment<span class="screen-reader-text"> on %s</span>', 'ri-fusion'), array('span' => array('class' => array()))), get_the_title()));
            echo '</span>';
        }
    }
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since ri_fusion 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function rit_fusion_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('ri_fusion_categories'))) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('ri_fusion_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so ri_fusion_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so ri_fusion_categorized_blog should return false.
        return false;
    }
}

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since ri-fusion 1.0
 */
function rit_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'rit_javascript_detection', 0);

/**
 * Enqueue scripts and styles.
 *
 * @since ri-fusion 1.0
 */ 
function rit_theme_scripts()
{
    // RIT add require
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css');
    if ( is_rtl() ) {
        wp_enqueue_style('bootstrap-rtl',get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-rtl.min.css');
    }
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('font-clever', get_template_directory_uri() . '/assets/cleversoft/style.css');
    wp_register_style('slick', get_template_directory_uri() . '/assets/slick/slick.css', array(), false, 'all');
    wp_register_style('slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css', array(), false, 'all');
    if (is_child_theme()) {
        wp_enqueue_style('ri_fusion_parent_style', get_template_directory_uri() . '/style.css', array(), false, 'all');
    }
    // Load our main stylesheet.
    wp_enqueue_style('ri_fusion_style', get_stylesheet_uri());

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style('ri_fusion_ie', get_template_directory_uri() . '/css/ie.css', array('ri_fusion_style'), '20141010');
    wp_style_add_data('ri_fusion_ie', 'conditional', 'lt IE 9');

    // Load the Internet Explorer 7 specific stylesheet.
    wp_enqueue_style('ri_fusion_ie7', get_template_directory_uri() . '/css/ie7.css', array('ri_fusion_style'), '20141010');
    wp_style_add_data('ri_fusion_ie7', 'conditional', 'lt IE 8');
    // Responsive
    wp_enqueue_script('ri_fusion-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_localize_script('ri_fusion-script', 'screenReaderText', array(
        'expand' => '<span class="screen-reader-text">' . esc_html(__('expand child menu', 'ri-fusion')) . '</span>',
        'collapse' => '<span class="screen-reader-text">' . esc_html(__('collapse child menu', 'ri-fusion')) . '</span>',
    ));

    // RIT JS ICLUDED
    wp_register_script('slick', get_template_directory_uri() . '/assets/slick/slick.min.js', array(), '1.6.0', true);
    wp_enqueue_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), '1.0.2', true);
    wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '2.2.2', true);
    wp_register_script('lazyload-master', get_template_directory_uri() . '/assets/lazyload-master/jquery.lazyload.min.js', array(), '1.9.7', true);
    wp_register_script('parallax', get_template_directory_uri() . '/assets/parallax/parallax.min.js', array(), '1.4.2', true);
    wp_register_script('ri-fusion-portfolio-js', get_template_directory_uri() . '/js/single/ri-fusion-portfolio.js', array(), '1.0.0', true);
    wp_register_script('ri-fusion-portfolio-carousel-js', get_template_directory_uri() . '/js/single/ri-fusion-portfolio-carousel.js', array(), '1.0.0', true);
    wp_register_script('countup', get_template_directory_uri() . '/js/countup.min.js', array(), '1.7', true);
    wp_register_script('ri-fusion-countup', get_template_directory_uri() . '/js/ri-fusion-countup.js', array(), '1.0', true);
    wp_register_script('ri-fusion-layout', get_template_directory_uri() . '/js/single/ri-fusion-layout.js', array(), '1.0', true);
    wp_register_script('ri-fusion-lightbox-gallery', get_template_directory_uri() . '/js/single/ri-fusion-lightbox-gallery.js', array(), '1.0', true);
    wp_register_script('ri-fusion-oembed', get_template_directory_uri() . '/js/single/ri-fusion-oembed.js', array(), '1.0', true);
    wp_enqueue_script('ri_fusion_js_theme', get_template_directory_uri() . '/js/rit.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'rit_theme_scripts');

function rit_theme_wp_admin_style()
{
    wp_enqueue_style('ri_fusion_admin_css', get_template_directory_uri() . '/css/ri-fusion-admin.css', array(), false, 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('ri_fusion_admin_js', get_template_directory_uri() . '/js/ri-fusion-admin.js', array(), '1.0.0', true);
}

add_action('admin_enqueue_scripts', 'rit_theme_wp_admin_style');

// Function For RIT Theme
require get_template_directory() . '/included/theme-function/rit-function.php';
// Remove Script Version
function rit_remove_script_version($src)
{
    if (strpos($src, $_SERVER['SERVER_NAME']) != false) {
        $parts = explode('?', $src);
        return $parts[0];
    } else {
        return $src;
    }
}
add_filter('script_loader_src', 'rit_remove_script_version', 15, 1);
add_filter('style_loader_src', 'rit_remove_script_version', 15, 1);
//Custom image size
add_image_size('rit-portfolio-thumb', 450, 254, array('center', 'center'));
add_image_size('rit-portfolio-medium', 600, 340, array('center', 'center'));
add_filter('image_size_names_choose', 'rit_custom_img_sizes');
if(!function_exists('rit_custom_img_sizes')){
    function rit_custom_img_sizes($imgsizes)
    {
        return array_merge($imgsizes, array(
            'rit-portfolio-thumb' => esc_html__('Custom Thumb', 'ri-fusion'),
            'rit-portfolio-medium' => esc_html__('Custom Medium', 'ri-fusion')
        ));
    }
}

