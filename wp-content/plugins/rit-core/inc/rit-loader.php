<?php

if (!class_exists('RIT_LOADER')) {
    class RIT_LOADER
    {
        public function __construct()
        {

            add_action('admin_init', array($this, 'rit_admin_script'));
            add_action('wp_enqueue_scripts', array($this, 'rit_front_end_script'));
            $this->get_setting();
            $this->load_textdomain();
            $this->load_post_type();
            $this->load_shortcode();
            $this->load_custom_shortcodes();
        }

        function rit_admin_script()
        {
            global $wp_scripts;
            // tell WordPress to load jQuery UI tabs
            wp_enqueue_script('jquery-ui-tabs');
            // get registered script object for jquery-ui
            $ui = $wp_scripts->query('jquery-ui-core');
            // tell WordPress to load the Smoothness theme from Google CDN
            $protocol = is_ssl() ? 'https' : 'http';
            $url = "$protocol://ajax.googleapis.com/ajax/libs/jqueryui/{$ui->ver}/themes/smoothness/jquery-ui.min.css";
            wp_enqueue_style('jquery-ui-smoothness', $url, false, null);
            wp_enqueue_script('rit-isotope-js', RIT_PLUGIN_URL . 'assets/js/isotope.pkgd.min.js', array(), RIT_VERSION, true);
            wp_enqueue_style('rit-admin-css', RIT_PLUGIN_URL . 'assets/css/rit-core-admin.css', array(), RIT_VERSION);
            wp_enqueue_script('rit-admin-js', RIT_PLUGIN_URL . 'assets/js/rit-core-admin.js', array('common', 'jquery', 'media-upload'), RIT_VERSION, true);
        }

        function rit_front_end_script()
        {
            wp_register_style('animations', rit_get_template_dir_url('assets/css/rit-animations.css'), array(), RIT_VERSION);
            wp_register_style('rit-core-front-css', rit_get_template_dir_url('assets/css/rit-core-front.css'), array(), RIT_VERSION);
            wp_register_style('rit-demo-box', rit_get_template_dir_url('assets/css/rit-demo-block.css'), array(), RIT_VERSION);
            //Cause js
            wp_register_script('rit-core-front-js', rit_get_template_dir_url('assets/js/rit-core-front.js'), array(), RIT_VERSION, true);
            wp_register_style('rit-blog-css', rit_get_template_dir_url('assets/css/blog-style.css'), array(), RIT_VERSION);
            wp_register_style('rit-masonry-css', rit_get_template_dir_url('assets/css/rit-masonry.css'), array(), RIT_VERSION);
            wp_register_style('rit-news-css', rit_get_template_dir_url('assets/css/rit-news.css'), array(), RIT_VERSION);
            wp_register_script('rit-masonry-js', rit_get_template_dir_url('assets/js/masonry.pkgd.min.js'), array(), RIT_VERSION, true);
            wp_register_script('rit-imagesloaded-js', rit_get_template_dir_url('assets/js/imagesloaded.pkgd.min.js'), array(), RIT_VERSION, true);
            wp_register_script('rit-infinitescroll-js', rit_get_template_dir_url('assets/js/jquery.infinitescroll.min.js'), array(), RIT_VERSION, true);
            wp_register_script('typed', rit_get_template_dir_url('assets/js/typed.js'), array(), '1.0.0', true);
        }

        /**
         * Load plugin translation.
         */
        public function load_textdomain()
        {
            load_plugin_textdomain('rit-core-language', false, RIT_PLUGIN_PATH . 'languages/');
        }

        public function get_setting()
        {
            global $rit_options;
            $rit_options = get_option('rit_option_name');
        }

        public function load_shortcode()
        {
            //Shortcode
            $files = array();
            if (is_dir(RIT_PLUGIN_SHORTCODE_PATH)) {
                $shortcodes = glob(RIT_PLUGIN_SHORTCODE_PATH . '*.php');
                $files = array_merge($files, $shortcodes);
            }
//             if(is_dir(RIT_PLUGIN_WIDGET_PATH)) {
//                  $widgets = glob(RIT_PLUGIN_WIDGET_PATH . '*.php');
//                  $files = array_merge($files, $widgets);
//              }


            foreach ($files as $file) {
                $overwrite_file = str_replace(RIT_PLUGIN_PATH, RIT_THEME_PATH, $file);

                if (file_exists($overwrite_file)) {
                    require_once $overwrite_file;
                } else {
                    require_once $file;
                }
            }
        }

        public function load_post_type()
        {
            $rit_posttypes = RIT_PLUGIN_INC_PATH . '/rit-post-types.php';
            $overwrite_file = str_replace(RIT_PLUGIN_PATH, RIT_THEME_PATH, $rit_posttypes);
            if (file_exists($overwrite_file)) {
                require_once $overwrite_file;
            } else {
                require_once $rit_posttypes;
            }
        }

        public function load_custom_shortcodes()
        {
            $rit_original = RIT_PLUGIN_INC_PATH . 'rit-custom-shortcodes.php';
            $overwrite_file = str_replace(RIT_PLUGIN_PATH, RIT_THEME_PATH, $rit_original);
            if (file_exists($overwrite_file)) {
                require_once $overwrite_file;
            } else {
                require_once $rit_original;
            }
        }
    }

    new RIT_LOADER();
}