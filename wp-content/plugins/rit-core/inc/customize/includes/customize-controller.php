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


if (!class_exists('RIT_Customize')) {
    class RIT_Customize
    {
        public $customizers = array();

        public $panels = array();

        public $activeCallbackFunctions = array();

        public function init()
        {
            add_action('customize_controls_enqueue_scripts', array($this, 'rit_customizer_script'));
            add_action('customize_controls_print_scripts', array($this, 'rit_customizer_controls_print_scripts'));
            add_action('customize_register', array($this, 'rit_register_theme_customizer'));
            add_action('customize_register', array($this, 'remove_default_customize_section'), 20);
            RIT_Customize_Import_Export::getInstance();
        }

        public static function &getInstance()
        {
            static $instance;
            if (!isset($instance)) {
                $instance = new RIT_Customize();
            }
            return $instance;
        }

        public function rit_customizer_script()
        {
            // Register
            wp_enqueue_style('rit-customize-css', RIT_PLUGIN_URL . 'inc/customize/assets/css/customizer.css', array(), RIT_VERSION);
            wp_enqueue_script('rit-customize-js', RIT_PLUGIN_URL . 'inc/customize/assets/js/customizer.js', array('jquery'), RIT_VERSION, true);

            // Localize
            wp_localize_script('rit-customize-js', 'RIT_Customize_Import_Export_l10n', array(
                'emptyImport' => esc_html__('Please choose a file to import.', 'rit-core-language')
            ));

            // Config
            wp_localize_script('rit-customize-js', 'RIT_Customize_Import_Export_Config', array(
                'customizerURL' => admin_url('customize.php'),
                'exportNonce' => wp_create_nonce('rit-exporting')
            ));
        }

        /**
         * @method controls_print_scripts
         */
        public function rit_customizer_controls_print_scripts()
        {
            global $cei_error;

            if ($cei_error) {
                echo '<script> alert("' . esc_js($cei_error) . '"); </script>';
            }
        }

        public function add_customize($customizers) {
            $this->customizers = array_merge($this->customizers, $customizers);
        }

        public function add_panel($panels) {
            $this->panels = array_merge($this->panels, $panels);
        }

        // magic method for active callback function
        public function __call($func, $params){
            if(in_array($func, $this->activeCallbackFunctions)){
                $controlName = str_replace('_active_callback_function', '', $func);
                $customizeControl = $this->getCustomizeControl($controlName);
                if($customizeControl && isset($customizeControl['dependency']) && count($customizeControl['dependency']) > 0){
                    foreach($customizeControl['dependency'] as $dependency => $values){
                        if(is_array($values) &&  count($values) > 0){
                            $result = false;
                            foreach($values as $val){
                                if ($params[0]->manager->get_setting($dependency)->value() == $val){
                                    $result = true;
                                }
                            }
                            return $result;
                        } elseif ( $params[0]->manager->get_setting($dependency)->value() != $values ) {
                            return false;
                        }
                    }
                }
            }
            return true;
        }

        private function getCustomizeControl($name){
            foreach ($this->customizers as $section => $section_params) {
                foreach ($section_params['settings'] as $setting => $params) {
                    if($setting == $name)
                        return $params;
                }
            }
            return false;
        }

        public function rit_register_theme_customizer()
        {
            global $wp_customize;

            foreach ($this->customizers as $section => $section_params) {

                //add section
                $wp_customize->add_section($section, $section_params);
                if (isset($section_params['settings']) && count($section_params['settings']) > 0) {
                    foreach ($section_params['settings'] as $setting => $params) {

                        if(isset($params['dependency']) && count($params['dependency']) > 0){

                            $callbackFunctionName = $setting.'_active_callback_function';

                            $this->activeCallbackFunctions[] =  $callbackFunctionName;

                            $params['active_callback'] = array($this, $callbackFunctionName);

                            unset($params['dependency']);
                        }

                        //add setting
                        $setting_params = array();
                        if (isset($params['params'])) {
                            $setting_params = $params['params'];
                            unset($params['params']);
                        }

                        $settings_callback_default = array(
                                    'default' => null,
                            		'sanitize_callback' => 'wp_kses_post',
                            		'sanitize_js_callback' => null
                        );
                        $setting_params = array_merge( $settings_callback_default,  $setting_params);

                        $wp_customize->add_setting($setting, $setting_params);


                        //Get class control
                        $class = 'WP_Customize_Control';
                        if (isset($params['class']) && !empty($params['class'])) {
                            $class = 'WP_Customize_' . ucfirst($params['class']) . '_Control';
                            unset($params['class']);
                        }

                        //add params section and settings
                        $params['section'] = $section;
                        $params['settings'] = $setting;

                        //add controll
                        $wp_customize->add_control(
                            new $class($wp_customize, $setting, $params)
                        );
                    }
                }
            }

            foreach($this->panels as $key => $panel){
                $wp_customize->add_panel($key, $panel);
            }

            return;
        }

        public function remove_default_customize_section()
        {
            global $wp_customize;
            // Remove Sections
            $wp_customize->remove_section('nav');
            $wp_customize->remove_section('static_front_page');
            $wp_customize->remove_section('colors');
            $wp_customize->remove_section('background_image');
        }
    }

    $rit_customize = RIT_Customize::getInstance();
    $rit_customize->init();
}