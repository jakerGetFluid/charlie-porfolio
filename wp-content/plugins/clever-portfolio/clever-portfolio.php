<?php

/**
 * Plugin Name: Clever Portfolio
 * Plugin URI:  http://www.zootemplate.com/
 * Description: An add-on which provides porfolio functionality for River Theme Core.
 * Author:      Zootemplate
 * Version:     1.0.1
 * Author URI:  http://www.zootemplate.com/
 * Text Domain: clever-portfolio
 */
final class Clever_Portfolio
{
    /**
     * Version
     *
     * @var    string
     */
    const VERSION = '1.0.1';

    /**
     * Option name
     *
     * Option name in the options table.
     *
     * @var    string
     */
    const OPTION_NAME = 'clever_portfolio_settings';

    /**
     * Settings
     *
     * @var    array
     */
    private $settings;

    /**
     * Constructor
     */
    function __construct($settings)
    {
        $this->settings = $settings ? (array)$settings : array();
        $this->settings['basedir'] = __DIR__ . '/';
        $this->settings['baseuri'] = plugins_url('/', __FILE__);
    }

    /**
     * Do activation
     */
    function activate()
    {
        add_option(self::OPTION_NAME, array(
            'post_type_slug' => 'portfolio',
            'post_type_archive_slug' => 'portfolios',
            'portfolio_category_slug' => 'portfolio-category',
            'archive_page_title' => esc_html__('Archive Portfolios', 'clever-portfolio'),
            'single_enable_lightbox' => 1,
            'single_embed_layout' => 'standard',
            'single_metro_width' => '1170',
            'single_gallery_layout' => 'list',
            'single_enable_extra_info' => 1,
            'single_enable_share' => 1,
            'single_enable_thumb' => 1,
            'single_extra_info' => array(
                'extra-field-1' => array(
                    'label' => esc_html__('Client Name', 'clever-portfolio'),
                    'type' => 'text'
                ),
                'extra-field-2' => array(
                    'label' => esc_html__('Date Completion', 'clever-portfolio'),
                    'type' => 'datetime'
                )
            ),
            'archive_layout' => 'masonry',
            'archive_layout_mode' => 'fitRows',
            'archive_style' => 'default',
            'archive_thumbnail_size' => 'medium',
            'archive_columns_per_page' => 4,
            'archive_posts_per_page' => 8,
            'archive_order' => 'DESC',
            'archive_order_by' => 'date',
            'archive_portfolio_gutter' => 10,
            'archive_show_description' => 1,
            'archive_show_cats' => 1,
            'archive_show_date' => 1,
            'archive_show_btn' => '',
            'archive_btn_text' =>  esc_html__('View Portfolio', 'clever-portfolio'),
            //Pagination
            'archive_paging_type' => 'standard',
            'archive_loadmore_button_text' => esc_html__('Load More', 'clever-portfolio'),
            'archive_nomore_load_text' => esc_html__('No More Load', 'clever-portfolio'),
            'archive_paging_icon' => 'standard',
            //Custom color
            'archive_custom_style' => 0,
            'archive_enable_shadow' => 1,
            'archive_title_color' => '#FFF',
            'archive_title_hover' => '#FFF',
            'archive_cat_text_color' => '#FFF',
            'archive_cat_color_hover' => '#FFF',
            'archive_date_color' => '#ebebeb',
            'archive_text_color' => '#252525',
            'archive_button_text_color' => '#ffffff',
            'archive_hover_button_text_color' => '#252525',
            'archive_button_background_color' => '#252525',
            'archive_hover_button_background_color' => '#ffffff',
            'archive_background_color' => '#252525',
            'archive_background_mask' => 'rgba( 0, 0, 0, 0.3 )'
        ));
    }

    /**
     * Do deactivation
     */
    function deactivate()
    {
        flush_rewrite_rules(false);
    }

    /**
     * Do installation
     */
    function install()
    {
        $this->load_resources();

        $this->register_portfolio_post_type();

        $this->register_portfolio_shortcode_post_type();

        $this->register_portfolio_category_taxonomy();

        $this->register_portfolio_shortcode();

        $this->register_pagination_ajax_actions();

        if (is_admin()) {
            $this->add_settings_page();
            $this->add_import_export_page();
            $this->add_portfolio_options_metabox();
            $this->add_portfolio_shortcode_options_metabox();
        }

        add_action('init', array($this, 'register_assets'));
        add_action('init', array($this, 'deactivate'), PHP_INT_MAX);
    }

    /**
     * Do uninstallation
     */
    static function uninstall()
    {
        delete_option(self::OPTION_NAME);
    }

    /**
     * Register assets
     */
    function register_assets()
    {
        // $css_suffix = SCRIPT_DEBUG ? '.css' : '.min.css';
        $js_suffix = SCRIPT_DEBUG ? '.js' : '.min.js';
        $assets_uri = $this->settings['baseuri'] . 'assets/';

        // Common stylesheets and scripts.
        wp_register_style('clever-font', $assets_uri . 'font-icons/clever-font/style.css', array(), self::VERSION);
        wp_register_style('font-awesome', $assets_uri . 'font-icons/font-awesome/css/font-awesome.min.css', array(), self::VERSION);

        if ( is_admin() ) { // Admin stylesheets and scripts.
            wp_register_style('clever-portfolio-options-metabox', $assets_uri . 'css/backend/clever-portfolio-metabox.min.css', array(), self::VERSION);
            wp_enqueue_style('clever-portfolio-admin', $assets_uri . 'css/backend/clever-portfolio-admin.min.css', array(), self::VERSION);
            wp_register_script('wp-color-picker-alpha', $assets_uri . 'vendors/wp-color-picker-alpha.min.js', array('wp-color-picker'), '1.2.2', true);
            wp_register_script('clever-portfolio-settings-page', $assets_uri . 'js/backend/clever-portfolio-settings-page.js', array('wp-color-picker-alpha'), self::VERSION, true);
            wp_register_script('clever-portfolio-options-metabox', $assets_uri . 'js/backend/clever-portfolio-metabox.js', array('jquery-ui-datepicker'), self::VERSION, true);
        } else { // Frontend stylesheets and scripts.
            wp_register_style('bootstrap-lite', $assets_uri . 'vendors/bootstrap/bootstrap.min.css', array(), self::VERSION);
            wp_register_style('slick', $assets_uri . 'vendors/slick/slick.css', array(), self::VERSION);
            wp_register_style('slick-theme', $assets_uri . 'vendors/slick/slick-theme.css', array(), self::VERSION);
            wp_register_style('clever-portfolio', $assets_uri . 'css/frontend/clever-portfolio.min.css', array(), self::VERSION);
            wp_register_script('isotope', $assets_uri . 'vendors/isotope.pkgd.min.js', array('jquery-core'), '2.2.2', true);
            wp_register_script('infinite-scroll', $assets_uri . 'vendors/jquery.infinitescroll.min.js', array('jquery-core'), '2.1.0', true);
            wp_register_script('slick', $assets_uri . 'vendors/slick/slick.min.js', array('jquery-core'), '1.6.0', true);
            wp_register_script('lazyload', $assets_uri . 'vendors/lazyload-master/jquery.lazyload.min.js', array('jquery-core'), '1.9.7', true);
            wp_register_script('clever-portfolio-js', $assets_uri . 'js/frontend/clever-portfolio' . $js_suffix, array('jquery-core'), self::VERSION, true);
            wp_register_script('clever-portfolio-single-js', $assets_uri . 'js/frontend/clever-portfolio-single' . $js_suffix, array('jquery-core'), self::VERSION, true);
            wp_register_script('clever-portfolio-oembed-js', $assets_uri . 'js/frontend/clever-portfolio-oembed' . $js_suffix, array('jquery-core'), self::VERSION, true);
            wp_register_script('clever-lightbox-js', $assets_uri . 'js/frontend/clever-portfolio-lightbox' . $js_suffix, array('jquery-core'), self::VERSION, true);
        }

        // Localize scripts.
        wp_localize_script('clever-portfolio-options-metabox', 'cleverPortfolioSettings', array(
            'wpMediaTitle' => esc_html__('Select or Upload', 'clever-portfolio'),
            'wpMediaButtonText' => esc_html__('Add to Gallery', 'clever-portfolio'),
        ));
        wp_localize_script('clever-portfolio-settings-page', 'cleverPortfolioSettings', array(
            'extraFieldID' => self::OPTION_NAME . '[single_extra_info]',
            'typeLabel' => esc_html__('Type', 'clever-portfolio'),
            'extraPlaceholder' => esc_html__('Label for this field', 'clever-portfolio'),
            'textTypeLabel' => esc_html__('Text', 'clever-portfolio'),
            'linkTypeLabel' => esc_html__('Link', 'clever-portfolio'),
            'emailTypeLabel' => esc_html__('Email', 'clever-portfolio'),
            'numberTypeLabel' => esc_html__('Number', 'clever-portfolio'),
            'textareaTypeLabel' => esc_html__('Textarea', 'clever-portfolio'),
            'datetimeTypeLabel' => esc_html__('Datetime', 'clever-portfolio'),
            'removeBtnText' => esc_html__('Remove', 'clever-portfolio'),
            'wpMediaTitle' => esc_html__('Select or Upload', 'clever-portfolio'),
            'wpMediaButtonText' => esc_html__('Use this image', 'clever-portfolio'),
            'defaultAjaxLoader' => admin_url('images/spinner-2x.gif'),
        ));
    }

    /**
     * Load admin assets
     *
     * @internal
     *
     * @see    https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
     */
    function load_backend_assets($hook_suffix)
    {

    }

    /**
     * Load admin assets
     *
     * @internal
     *
     * @see    https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
     */
    function load_frontend_assets()
    {
        global $wp_query;

        if ( $wp_query->is_singular( 'portfolio' ) ) {
            $post_meta  = get_post_meta($wp_query->post->ID, Clever_Portfolio_Options_Metabox::META_KEY, true);
            $oembed_url = $post_meta['oembed_url'];
            $parsed_url = parse_url($oembed_url);
            if ( !wp_style_is( 'bootstrap', 'enqueued' ) )
                wp_enqueue_style( 'bootstrap-lite' );
            wp_enqueue_style( 'clever-font' );
            wp_enqueue_style( 'font-awesome' );
            wp_enqueue_style( 'clever-portfolio' );
            wp_enqueue_script( 'clever-portfolio-single-js' );
            if ( 'embed' === $post_meta['format'] ) {
            wp_enqueue_script('clever-portfolio-oembed-js');
                if ($parsed_url['host'] == 'vimeo.com')
                    wp_enqueue_script('vimeoapi', 'https://player.vimeo.com/api/player.js', true);
                if ($parsed_url['host'] == 'youtube.com' || $parsed_url['host'] == 'www.youtube.com')
                    wp_enqueue_script('youtube-api', 'https://www.youtube.com/player_api', true);
            }
            if ( 'gallery' === $post_meta['format'] ) {
                wp_enqueue_style( 'slick');
                wp_enqueue_style( 'slick-theme' );
                wp_enqueue_script( 'imagesloaded' );
                wp_enqueue_script( 'lazyload' );
                wp_enqueue_script( 'slick' );
                if ( !empty($this->settings['single_enable_lightbox']) )
                    wp_enqueue_script( 'clever-lightbox-js' );

            }
            wp_enqueue_script( 'clever-portfolio-layout' );
        }

        if ( $wp_query->is_tax( 'portfolio_category' )|| is_post_type_archive('portfolio')) {
            wp_enqueue_style( 'clever-portfolio' );
            wp_enqueue_script( 'clever-portfolio-js' );
            if( 'masonry' === $this->settings['archive_layout'] || 'metro' === $this->settings['archive_layout'])
                wp_enqueue_script('isotope');
        }
    }

    /**
     * Load resources
     */
    private function load_resources()
    {
        $inc = $this->settings['basedir'] . 'includes/';

        require $inc . 'class-clever-portfolio-post-type.php';
        require $inc . 'class-clever-portfolio-shortcode.php';
        require $inc . 'class-clever-portfolio-pagination.php';
        require $inc . 'class-clever-portfolio-settings-page.php';
        require $inc . 'class-clever-portfolio-options-metabox.php';
        require $inc . 'class-clever-portfolio-category-taxonomy.php';
        require $inc . 'class-clever-portfolio-import-export-page.php';
        require $inc . 'class-clever-portfolio-shortcode-post-type.php';
        require $inc . 'class-clever-portfolio-shortcode-options-metabox.php';

        add_action('wp_enqueue_scripts', array($this, 'load_frontend_assets'), -1, 0);
        add_action('admin_enqueue_scripts', array($this, 'load_backend_assets'), 10, 1);
    }

    /**
     * Register portfolio post type
     */
    private function register_portfolio_post_type()
    {
        $post_type = new Clever_Portfolio_Post_Type($this->settings);

        add_action('init', array($post_type, 'register'), 0, 0);

        add_filter('manage_portfolio_posts_columns', array($post_type, 'add_columns'));

        add_filter('template_include', array($post_type, 'include_template'), PHP_INT_MAX);
    }

    /**
     * Register portfolio-shortcode post type
     */
    private function register_portfolio_shortcode_post_type()
    {
        $post_type = new Clever_Portfolio_Shortcode_Post_Type($this->settings);

        add_action('init', array($post_type, 'register'), 0, 0);

        add_filter('manage_portfolio-shortcode_posts_columns', array($post_type, 'add_shortcode_column'));

        add_action('manage_portfolio-shortcode_posts_custom_column', array($post_type, 'the_shortcode_cell_content'), 10, 2);
    }

    /**
     * Register portfolio category
     */
    private function register_portfolio_category_taxonomy()
    {
        $taxonomy = new Clever_Portfolio_Category_Taxonomy($this->settings);
        add_filter('pre_get_document_title', array($taxonomy, 'filter_portfolio_title'));
        add_action('init', array($taxonomy, 'register'), 0, 0);
        add_filter('template_include', array($taxonomy, 'include_template'), PHP_INT_MAX);
        add_action('pre_get_posts', array($taxonomy, 'filter_archive_portfolios'), PHP_INT_MAX);
    }

    /**
     * Register single portfolio metabox
     */
    private function add_portfolio_options_metabox()
    {
        $metabox = new Clever_Portfolio_Options_Metabox($this->settings);

        add_action('save_post_portfolio', array($metabox, 'save'));

        add_action('add_meta_boxes_portfolio', array($metabox, 'add'));

        add_action('wp_ajax_preview_oembed_portfolio', array($metabox, 'preview_oembed'));
    }

    /**
     * Register single portfolio-shortcode metabox
     */
    private function add_portfolio_shortcode_options_metabox()
    {
        $metabox = new Clever_Portfolio_Shortcode_Options_Metabox($this->settings);

        add_action('save_post_portfolio-shortcode', array($metabox, 'save'));

        add_action('add_meta_boxes_portfolio-shortcode', array($metabox, 'add'));
    }

    /**
     * Register portfolio shortcode
     */
    private function register_portfolio_shortcode()
    {
        $shortcode = new Clever_Portfolio_Shortcode($this->settings);

        add_shortcode('clever-portfolio-sc', array($shortcode, 'add'));

        add_action('vc_before_init', array($shortcode, 'integrate_with_vc'), 0, 0);
    }

    /**
     * Register settings page
     */
    private function add_settings_page()
    {
        $page = new Clever_Portfolio_Settings_Page($this->settings);

        add_action('admin_menu', array($page, 'add'));

        add_action('admin_init', array($page, 'init'), 0, 0);

        add_action('admin_notices', array($page, 'notify'), 0, 0);
    }

    /**
     * Register import/export page
     */
    private function add_import_export_page()
    {
        $page = new Clever_Portfolio_Import_Export_Page($this->settings);

        add_action('admin_menu', array($page, 'add'));

        add_action('admin_init', array($page, 'export'), 0, 0);

        add_action('admin_init', array($page, 'import'), 0, 0);

        add_action('admin_notices', array($page, 'notify'), 0, 0);
    }

    /**
     * Register pagination AJAX actions
     */
    private function register_pagination_ajax_actions()
    {
        $pagination = Clever_Portfolio_Pagination::getInstance();

        add_action('wp_ajax_clever_ajax_load_more', array($pagination, 'clever_ajax_load_more'));

        add_action('wp_ajax_nopriv_clever_ajax_load_more', array($pagination, 'clever_ajax_load_more'));
    }
}

/**
 * Output users' defined styles
 */
if(!function_exists('clever_generate_custom_styles')) {
    function clever_generate_custom_styles($style = '')
    {
        if ($style != '') :
            ?>
            <style>
            <?php echo esc_attr($style);?>
            </style><?php
        endif;
    }
}
add_action('wp_head', 'clever_generate_custom_styles');
/**
 * Add admin body class
 */
if (!function_exists('clever_portfolio_add_body_classes')) {
    function clever_portfolio_add_body_classes($classes)
    {
        $screen = get_current_screen();
        if ('portfolio' == $screen->post_type || 'portfolio-shortcode' == $screen->post_type) {
            $classes = 'clever-portfolio';
        }
        return $classes;
    }
}
add_filter('admin_body_class', 'clever_portfolio_add_body_classes', 10, 1);
/**
 * Enable api for youtube
 */
if (!function_exists('clever_oembed_dataparse')) {
    function clever_oembed_dataparse($return, $data, $url)
    {
        if (false === strpos($return, 'youtube.com'))
            return $return;
        $id = explode('watch?v=', $url);
        $add_id = str_replace('allowfullscreen>', 'allowfullscreen id="yt-' . $id[1] . '">', $return);
        $add_id = str_replace('?feature=oembed', '?enablejsapi=1', $add_id);
        return $add_id;
    }
}
add_filter('oembed_dataparse', 'clever_oembed_dataparse', 10, 3);
/**
 * Create categories tree
 */
if(!function_exists('clever_categories_tree')){
    function clever_categories_tree( $parent_id, $array, $level, &$dropdown ) {

        for ( $i = 0; $i < count( $array ); $i ++ ) {
            if ( $array[ $i ]->parent == $parent_id ) {
                $name = str_repeat( '&nbsp;&#8211&nbsp;', $level ) . $array[ $i ]->name;
                $value = $array[ $i ]->slug;
                $dropdown[] = array(
                    'name' => $name,
                    'slug' => $value,
                );
                clever_categories_tree( $array[ $i ]->term_id, $array, $level + 1, $dropdown );
            }
        }
    }
}
/**
 * RI get template part
 *
 * Like WordPress's `locate_template()`, this function will load|return templates in a specific folder of a theme before falling back to default templates of a plugin.
 *
 * @param    string $plugin_slug Slug of the plugin.
 * @param    string $tpl_slug Template slug.
 * @param    string $tpl_name Template name.
 * @param    bool $load Whether to load or return the located template.
 *
 * @return    string    $located    Located template.
 */
if (!function_exists('clever_get_template_part')) {
    function clever_get_template_part($plugin_slug, $tpl_slug, $tpl_name = '', $load = false)
    {
        $located = '';
        $templates = array();
        $tpl_name = basename($tpl_name, '.php');

        if ($tpl_name) {
            $templates[] = $plugin_slug . '/' . $tpl_slug . '-' . $tpl_name . '.php';
            $templates[] = $plugin_slug . '/' . $tpl_slug . '/' . $tpl_name . '.php';
            $templates[] = 'templates/' . $tpl_slug . '-' . $tpl_name . '.php';
            $templates[] = 'templates/' . $tpl_slug . '/' . $tpl_name . '.php';
        }

        $templates[] = $plugin_slug . '/' . $tpl_slug . '.php';
        $templates[] = 'templates/' . $tpl_slug . '.php';

        foreach ($templates as $template) {
            if (file_exists(STYLESHEETPATH . '/' . $template)) {
                $located = STYLESHEETPATH . '/' . $template;
                break;
            } elseif (file_exists(TEMPLATEPATH . '/' . $template)) {
                $located = TEMPLATEPATH . '/' . $template;
                break;
            } elseif (file_exists(WP_PLUGIN_DIR . '/' . $plugin_slug . '/' . $template)) {
                $located = WP_PLUGIN_DIR . '/' . $plugin_slug . '/' . $template;
                break;
            }
        }

        if ($located) {
            if ($load)
                require $located;
            else
                return $located;
        } else {

            $msg = sprintf(esc_html__('Failed to load template with slug "%s" and name "%s" of the "%s" plugin.', 'clever-portfolio'), $tpl_slug, $tpl_name, $plugin_slug);
            echo $msg;
            return;
        }
    }
}

/**
 * clever_portfolio_get_settings
 */
if (!function_exists('clever_portfolio_get_settings')) {
    function clever_portfolio_get_settings()
    {
        return get_option(Clever_Portfolio::OPTION_NAME);
    }
}
/**
 * clever_portfolio_single_meta
 */
if (!function_exists('clever_portfolio_single_meta')) {
    function clever_portfolio_single_meta()
    {
        return get_post_meta(get_the_ID(), Clever_Portfolio_Options_Metabox::META_KEY, true);
    }
}/**
 * clever_portfolio_get_shortcode_meta
 */
if (!function_exists('clever_portfolio_get_shortcode_meta')) {
    function clever_portfolio_get_shortcode_meta($id)
    {
        return get_post_meta($id, Clever_Portfolio_Shortcode_Options_Metabox::META_KEY, true);
    }
}
/**
 * Clever portfolio Standard Pagination
 */
if (!function_exists('clever_stardard_pagination')) {
    function clever_stardard_pagination($query, $max_link, $previous_icon, $next_icon)
    {
        $pagination = Clever_Portfolio_Pagination::getInstance();
        return $pagination->the_default($query, $max_link, $previous_icon, $next_icon);
    }
}
/**
 * Clever portfolio Infinity Scroll Pagination
 */
if (!function_exists('clever_infinity_scroll_pagination')) {
    function clever_infinity_scroll_pagination($query, $wrap, $item, $isotope = false)
    {
        $pagination = Clever_Portfolio_Pagination::getInstance();
        return $pagination->the_infinite($query, $wrap, $item, $isotope);
    }
}
/**
 * Clever portfolio Ajax load more Pagination
 * @param    string $tpl Base template without `.php` suffix.
 * @param    array $atts An array of AJAX attributes.
 * @param    string $type Type of the current portfolio page (archive or shortcode).
 * @param    string $wrap Selector of portfolios' container.
 * @param    string $target Selector of target element used for appending new portfolios.
 */
if (!function_exists('clever_ajax_load_pagination')) {
    function clever_ajax_load_pagination($tpl, array $atts, \WP_Query $query, $type, $wrap, $target, $isotope = false)
    {
        $pagination = Clever_Portfolio_Pagination::getInstance();
        return $pagination->the_load_more($tpl, $atts, $query, $type, $wrap, $target, $isotope);
    }
}
/**
 * Initialize Clever_Portfolio
 */
$Clever_Portfolio = new Clever_Portfolio(get_option(Clever_Portfolio::OPTION_NAME));

/**
 * Do installation
 */
add_action('plugins_loaded', array($Clever_Portfolio, 'install'));

/**
 * Register activation hook
 */
register_activation_hook(__FILE__, array($Clever_Portfolio, 'activate'));

/**
 * Register deactivation hook
 */
register_deactivation_hook(__FILE__, array($Clever_Portfolio, 'deactivate'));

/**
 * Register uninstallation hook
 */
register_uninstall_hook(__FILE__, 'Clever_Portfolio::uninstall');

/**
 * Remove Clever_Portfolio from global space
 */
unset($Clever_Portfolio);
