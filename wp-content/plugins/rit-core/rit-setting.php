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
if(!class_exists('RITSettingsPage')) {
    class RITSettingsPage {
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
            add_menu_page (
                'RIT Settings',
                'RIT Settings',
                'manage_options',
                'rit-setting-admin',
                array($this, 'create_admin_page')
            );
        }

        /**
         * Options page callback
         */
        public function create_admin_page()
        {
            // Set class property
            $this->options = get_option('rit_option_name');
            ?>
            <div class="wrap">
                <h2>My Settings</h2>
                <form method="post" action="options.php">
                    <?php
                    // This prints out all hidden setting fields
                    settings_fields('rit_option_group');
                    do_settings_sections('rit-setting-admin');
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
                'setting_section_id', // ID
                'RIT Settings', // Title
                array($this, 'print_section_info'), // Callback
                'rit-setting-admin' // Page
            );

            add_settings_field(
                'banner', // ID
                'Enable Banner Post type', // Title
                array($this, 'banner_callback'), // Callback
                'rit-setting-admin', // Page
                'setting_section_id' // Section
            );

            add_settings_field(
                'cause', // ID
                'Enable Cause Post type', // Title
                array($this, 'cause_callback'), // Callback
                'rit-setting-admin', // Page
                'setting_section_id' // Section
            );
            add_settings_field(
                'member', // ID
                'Enable Member Post type', // Title
                array($this, 'member_callback'), // Callback
                'rit-setting-admin', // Page
                'setting_section_id' // Section
            );
            add_settings_field(
                'portfolio', // ID
                'Enable Portfolio Post type', // Title
                array($this, 'portfolio_callback'), // Callback
                'rit-setting-admin', // Page
                'setting_section_id' // Section
            );
            add_settings_field(
                'testimonial', // ID
                'Enable Testimonial Post type', // Title
                array($this, 'testimonial_callback'), // Callback
                'rit-setting-admin', // Page
                'setting_section_id' // Section
            );
            add_settings_field(
                'transaction', // ID
                'Enable Transaction Post type', // Title
                array($this, 'transaction_callback'), // Callback
                'rit-setting-admin', // Page
                'setting_section_id' // Section
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
            if (isset($input['banner'])){
                $new_input['banner'] = sanitize_text_field( $input['banner'] );
            }
            if (isset($input['cause'])){
                $new_input['cause'] = sanitize_text_field( $input['cause'] );
            }
            if (isset($input['member'])){
                $new_input['member'] = sanitize_text_field( $input['member'] );
            }
            if (isset($input['portfolio'])){
                $new_input['portfolio'] = sanitize_text_field( $input['portfolio'] );
            }
            if (isset($input['testimonial'])){
                $new_input['testimonial'] = sanitize_text_field( $input['testimonial'] );
            }
            if (isset($input['transaction'])){
                $new_input['transaction'] = sanitize_text_field( $input['transaction'] );
            }

            return $new_input;
        }

        /**
         * Print the Section text
         */
        public function print_section_info()
        {
            print 'Enter settings for Rit Core plugin:';
        }

        /**
         * Get the settings option array and print one of its values
         */
        public function banner_callback()
        {
            printf(
                '<input type="checkbox" id="banner" name="rit_option_name[banner]" value="1" %s />',
                (isset($this->options['banner']) && $this->options['banner'] == '1')  ? 'checked' : ''
            );
        }

        public function cause_callback()
        {
            printf(
                '<input type="checkbox" id="cause" name="rit_option_name[cause]" value="1" %s />',
                (isset($this->options['cause']) && $this->options['cause'] == '1')  ? 'checked' : ''
            );
        }

        public function member_callback()
        {
            printf(
                '<input type="checkbox" id="member" name="rit_option_name[member]" value="1" %s />',
                (isset($this->options['member']) && $this->options['member'] == '1')  ? 'checked' : ''
            );
        }

        public function portfolio_callback()
        {
            printf(
                '<input type="checkbox" id="portfolio" name="rit_option_name[portfolio]" value="1" %s />',
                (isset($this->options['portfolio']) && $this->options['portfolio'] == '1')  ? 'checked' : ''
            );
        }

        public function testimonial_callback()
        {
            printf(
                '<input type="checkbox" id="testimonial" name="rit_option_name[testimonial]" value="1" %s />',
                (isset($this->options['testimonial']) && $this->options['testimonial'] == '1')  ? 'checked' : ''
            );
        }

        public function transaction_callback()
        {
            printf(
                '<input type="checkbox" id="transaction" name="rit_option_name[transaction]" value="1" %s />',
                (isset($this->options['transaction']) && $this->options['transaction'] == '1')  ? 'checked' : ''
            );
        }



    }

    if (is_admin()){
        new RITSettingsPage();
    }
}