<?php
if (!class_exists('RitPortfolioSettings')) {
    class RitPortfolioSettings
    {
        /**
         * Holds the values to be used in the fields callbacks
         */
        private $options;

        /**
         * Start up
         */
        public function __construct()
        {
            add_action('admin_menu', array($this, 'add_plugin_page'));
            add_action('admin_init', array($this, 'page_init'));
        }

        /**
         * Add options page
         */
        public function add_plugin_page()
        {
// This page will be under "Settings"
            add_submenu_page('edit.php?post_type=portfolio',
                esc_html__('Portfolio Settings', 'rit-core-language'), esc_html__('Settings', 'rit-core-language'),
                'manage_options', basename(__FILE__),
                array($this, 'portfolio_settings'));
        }

        /**
         * Options page callback
         */
        public function portfolio_settings()
        {
// Set class property
            $this->options = get_option('rit_option_name');
            ?>
            <div class="wrap">
                <h2><?php esc_html_e('Portfolio Settings', 'rit-core-language') ?></h2>
                <form method="post" action="options.php">
                    <?php
                    // This prints out all hidden setting fields
                    settings_fields('rit_option_group');
                    do_settings_sections('rit-portfolio-settings');
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        /**
         * Register and add settings
         */
        public function page_init()
        {
            register_setting(
                'rit_option_group', // Option group
                'rit_option_name', // Option name
                array($this, 'sanitize') // Sanitize
            );
            add_settings_section(
                'rit_portfolio_settings_section', // ID
                esc_html__('Portfolio Settings', 'rit-core-language'), // Title
                array($this, 'print_section_info'), // Callback
                'rit-portfolio-settings' // Page
            );
            add_settings_field(
                'portfolio-slug', // ID
                esc_html__('Portfolio Slug', 'rit-core-language'), // Title
                array($this, 'portfolio_callback'), // Callback
                'rit-portfolio-settings', // Page
                'rit_portfolio_settings_section' // Section
            );
            add_settings_field(
                'portfolio-categories-slug', // ID
                esc_html__('Portfolio Categories Slug', 'rit-core-language'), // Title
                array($this, 'portfolio_categories_callback'), // Callback
                'rit-portfolio-settings', // Page
                'rit_portfolio_settings_section' // Section
            );
        }

        /**
         * Sanitize each setting field as needed
         *
         * @param array $input Contains all settings fields as array keys
         */
        public function sanitize($input)
        {
            $new_input = array();
            if (isset($input['portfolio-slug'])) {
                $new_input['portfolio-slug'] = sanitize_title($input['portfolio-slug']);
            }
            if (isset($input['portfolio-categories-slug'])) {
                $new_input['portfolio-categories-slug'] = sanitize_title($input['portfolio-categories-slug']);
            }
            return $new_input;
        }

        /**
         * Print the Section text
         */
        public function print_section_info()
        {
            print __('Enter slug of portfolio you want change:', 'rit-core-language');
        }

        /**
         * Get the settings option array and print one of its values
         */
        public function portfolio_callback()
        {
            printf(
                '<input type="text" id="portfolio-slug" name="rit_option_name[portfolio-slug]" value="%s"/>',
                (isset($this->options['portfolio-slug']) && $this->options['portfolio-slug'] != '') ? $this->options['portfolio-slug'] : 'portfolio'
            );
        }

        public function portfolio_categories_callback()
        {
            printf(
                '<input type="text" id="portfolio-categories-slug" name="rit_option_name[portfolio-categories-slug]" value="%s"/>',
                (isset($this->options['portfolio-categories-slug']) && $this->options['portfolio-categories-slug'] != '') ? $this->options['portfolio-categories-slug'] : 'portfolio_category'
            );
        }
    }

    if (is_admin()) {
        new RitPortfolioSettings();
    }
}