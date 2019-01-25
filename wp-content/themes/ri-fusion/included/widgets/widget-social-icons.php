<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.2
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */

if (!class_exists('RITSocialWidget')) {
    class RITSocialWidget extends WP_Widget
    {
        public $socials = array(
            'ion-social-facebook' => array(
                'title' => 'Facebook',
                'name' => 'facebook_username',
                'link' => 'http://www.facebook.com/*',
                'icon'=>'fa-facebook',
            ),
            'ion-social-googleplus' => array(
                'title' => 'Googleplus',
                'name' => 'googleplus_username',
                'link' => 'https://plus.google.com/u/0/*',
                'icon'=>'fa-google-plus',
            ),
            'ion-social-twitter' => array(
                'title' => 'Twitter',
                'name' => 'Twitter_username',
                'link' => 'http://twitter.com/*',
                'icon'=>'fa-twitter',
            ),
            'ion-social-instagram' => array(
                'title' => 'Instagram',
                'name' => 'instagram_username',
                'link' => 'http://instagram.com/*',
                'icon'=>'fa-instagram',
            ),
            'ion-social-pinterest' => array(
                'title' => 'Pinterest',
                'name' => 'pinterest_username',
                'link' => 'http://pinterest.com/*',
                'icon'=>'fa-pinterest',
            ),
            'ion-social-skype' => array(
                'title' => 'Skype',
                'name' => 'skype_username',
                'link' => 'skype:*',
                'icon'=>'fa-skype',
            ),
            'ion-social-vimeo' => array(
                'title' => 'Vimeo',
                'name' => 'vimeo_username',
                'link' => 'http://vimeo.com/*',
                'icon'=>'fa-vimeo-square',
            ),
            'ion-social-youtube' => array(
                'title' => 'Youtube',
                'name' => 'youtube_username',
                'link' => 'http://www.youtube.com/user/*',
                'icon'=>'fa-youtube',
            ),
            'ion-social-dribbble' => array(
                'title' => 'Dribbble',
                'name' => 'dribbble_username',
                'link' => 'http://dribbble.com/*',
                'icon'=>'fa-dribbble',
            ),
            'ion-social-linkedin' => array(
                'title' => 'Linkedin',
                'name' => 'linkedin_username',
                'link' => '*',
                'icon'=>'fa-linkedin',
            ),
            'ion-social-rss' => array(
                'title' => 'Rss',
                'name' => 'rss_username',
                'link' => 'http://*/feed',
                'icon'=>'fa-rss',
            )
        );

        function __construct()
        {
            $widget_ops = array('classname' => 'RITSocialWidget', 'description' => esc_html__('Displays your social profile.', 'ri-fusion'));

            parent::__construct(false, esc_html__('RIT Social', 'ri-fusion'), $widget_ops);
        }

        function widget($args, $instance)
        {
            extract($args);
            $title = apply_filters('widget_title', $instance['title']);
            echo htmlspecialchars_decode(esc_html($before_widget));
            if ($title) {
                echo htmlspecialchars_decode(esc_html($before_title . $title . $after_title));
            }
            echo '<div class="rit-widget-social-icon primary-font '.esc_attr($instance['mode']).' clearfix">';
            foreach ($this->socials as $key => $social) {
                if (!empty($instance[$social['name']])) {
                    echo '<a href="' . str_replace('*', esc_attr($instance[$social['name']]), $social['link']) . '" target="_blank" title="' . esc_attr($social['title']) . '" class="' . esc_attr($key.' social-icon') . '">';
                    if($instance['mode']=='icon' || $instance['mode']=='both'){
                        echo '<i class="fa ' . esc_attr( $social['icon']) . '"></i>';
                    }
                    if($instance['mode']=='text'|| $instance['mode']=='both'){
                        echo esc_html($social['title']);
                    }
                    echo '</a>';
                }
            }
            echo '</div>';
            echo htmlspecialchars_decode(esc_html($after_widget));
        }

        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance = $new_instance;
            /* Strip tags (if needed) and update the widget settings. */
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['mode'] = $new_instance['mode'];
            return $instance;
        }

        function form($instance)
        {
            $instance['mode']='text';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title', 'ri-fusion'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" type="text"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php echo isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('mode')); ?>"><?php echo esc_html__('Display', 'ri-fusion'); ?></label>
                <select id="<?php echo esc_attr($this->get_field_id('mode')); ?>" name="<?php echo esc_attr($this->get_field_name('mode')); ?>" style="width:100%;">
                    <option value='text' <?php if ('text' == $instance['mode'] ||  $instance['mode']=='') echo 'selected="selected"'; ?>><?php echo esc_html__('Only Text', 'ri-fusion'); ?></option>
                    <option value='icon' <?php if ('icon' == $instance['mode']) echo 'selected="selected"'; ?>><?php echo esc_html__('Only Icon', 'ri-fusion'); ?></option>
                    <option value='both' <?php if ('both' == $instance['mode']) echo 'selected="selected"'; ?>><?php echo esc_html__('Both Text and Icon', 'ri-fusion'); ?></option>
                </select>
            </p> <?php
            foreach ($this->socials as $key => $social) {
                ?>
                <p>
                <label for="<?php echo esc_attr($this->get_field_id($social['name'])); ?>"><?php echo esc_html($social['title']); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($social['name'])); ?>" type="text"
                       name="<?php echo esc_attr($this->get_field_name($social['name'])); ?>"
                       value="<?php echo isset($instance[$social['name']]) ? esc_attr($instance[$social['name']]) : ''; ?>"/>
                </p><?php
            }
        }
    }
}

add_action('widgets_init', 'rit_social_load_widgets');

function rit_social_load_widgets()
{
    register_widget('RITSocialWidget');
}