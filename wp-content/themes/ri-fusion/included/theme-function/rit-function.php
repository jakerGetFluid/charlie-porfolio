<?php
/**
 * Created by PhpStorm.
 * User: chinhbeo
 * Date: 5/14/15
 * Time: 9:29 AM
 */

/* VARIABLE DEFINITIONS ================================================== */
if (!defined('RIT_TEMPLATE_PATH')) {
    define('RIT_TEMPLATE_PATH', get_template_directory());
}
if (!defined('RIT_INCLUDES_PATH')) {
    define('RIT_INCLUDES_PATH', RIT_TEMPLATE_PATH . '/included');
}
if (!defined('RIT_LOCAL_PATH')) {
    define('RIT_LOCAL_PATH', get_template_directory_uri());
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory() . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'ri_fusion_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function ri_fusion_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name' => esc_html__('River Theme core', 'ri-fusion'),
            'slug' => 'rit-core',
            'source' => get_template_directory() . '/lib/plugin/rit-core.zip',
            'required' => true,
        ),
        array(
            'name' => esc_html__('Clever Portfolio', 'ri-fusion'),
            'slug' => 'clever-portfolio',
            'source' => get_template_directory() . '/lib/plugin/clever-portfolio.zip',
            'required' => true,
            'version' => '1.0.1',
        ),

        array(
            'name' => esc_html__('Revolution Slider', 'ri-fusion'),
            'slug' => 'revslider',
            'source' => get_template_directory() . '/lib/plugin/revslider.zip',
            'required' => true,
            'version' => '5.4.1',
        ),

        array(
            'name' => esc_html__('Visual Composer', 'ri-fusion'),
            'slug' => 'js-composer',
            'source' => get_template_directory() . '/lib/plugin/js_composer.zip',
            'required' => true,
            'version' => '5.1.1',
        ),
        array(
            'name' => esc_html__('Responsive WordPress Gallery - Envira Gallery Lite', 'ri-fusion'),
            'slug' => 'envira-gallery-lite',
            'required' => true,
        ),

        array(
            'name' => esc_html__('Meta Box', 'ri-fusion'),
            'slug' => 'meta-box',
            'required' => true,
        ),
        array(
            'name' => esc_html__('Contact Form 7', 'ri-fusion'),
            'slug' => 'contact-form-7',
            'required' => true,
        ),

        array(
            'name' => esc_html__('WP User Avatar', 'ri-fusion'),
            'slug' => 'wp-user-avatar',
            'required' => true,
        )
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     *
     * Some of the strings are wrapped in a sprintf(), so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php',            // Parent menu slug.
        'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => esc_html(__('Install Required Plugins', 'ri-fusion')),
            'menu_title' => esc_html(__('Install Plugins', 'ri-fusion')),
            'installing' => esc_html(__('Installing Plugin: %s', 'ri-fusion')), // %s = plugin name.
            'oops' => esc_html(__('Something went wrong with the plugin API.', 'ri-fusion')),
            'notice_can_install_required' => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe' => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                'ri-fusion'
            ), // %1$s = plugin name(s).
            'install_link' => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'ri-fusion'
            ),
            'update_link' => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'ri-fusion'
            ),
            'activate_link' => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'ri-fusion'
            ),
            'return' => esc_html(__('Return to Required Plugins Installer', 'ri-fusion')),
            'plugin_activated' => esc_html(__('Plugin activated successfully.', 'ri-fusion')),
            'activated_successfully' => esc_html(__('The following plugin was activated successfully:', 'ri-fusion')),
            'plugin_already_active' => esc_html(__('No action taken. Plugin %1$s was already active.', 'ri-fusion')),  // %1$s = plugin name(s).
            'plugin_needs_higher_version' => esc_html(__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'ri-fusion')),  // %1$s = plugin name(s).
            'complete' => esc_html(__('All plugins installed and activated successfully. %1$s', 'ri-fusion')), // %s = dashboard link.
            'contact_admin' => esc_html(__('Please contact the administrator of this site for help.', 'ri-fusion')),

            'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa($plugins, $config);

}

// Function For RIT Theme
// Customize
require get_template_directory() . '/included/customize/customize.php';
require get_template_directory() . '/included/customize/customize-style.php';
//Metabox
require get_template_directory() . '/included/meta-boxes/meta-boxes.php';
// Custom Param Visual
// Include Widgets
require get_template_directory() . '/included/widgets/recent-post.php';
require get_template_directory() . '/included/widgets/about-me.php';
require get_template_directory() . '/included/widgets/download-link.php';
require get_template_directory() . '/included/widgets/img-hover.php';
require get_template_directory() . '/included/widgets/testimonials-widget.php';
require get_template_directory() . '/included/widgets/widget-social-icons.php';

//menu config
function rit_menu_config()
{
    $menuconfig = get_theme_mod('rit_default_menu_style', 'default');
    if (is_page() || is_single()) {
        if (get_post_meta(get_the_ID(), 'rit_default_menu_style', true) != '' && get_post_meta(get_the_ID(), 'rit_default_menu_style', true) != 'use-default') {
            $menuconfig = get_post_meta(get_the_ID(), 'rit_default_menu_style', true);
        }
    }
    return $menuconfig;
}

//offsidebar config
function rit_offsidebar_config()
{
    $offsidebar = get_theme_mod('rit_enable_offcanvas_sidebar', '1');
    if (is_page() || is_single()) {
        if (get_post_meta(get_the_ID(), 'rit_enable_offcanvas_sidebar', true) != '' && get_post_meta(get_the_ID(), 'rit_enable_offcanvas_sidebar', true) != 'use-default') {
            $offsidebar = get_post_meta(get_the_ID(), 'rit_enable_offcanvas_sidebar', true);
        }
    }
    return $offsidebar;
}

// Substring
if (!function_exists('rit_substring')) {
    function rit_substring($string, $number, $sub = '')
    {
        if (strlen($string) <= $number) {
            return $string;
        } else {
            $new_string = substr($string, 0, $number);
            return $new_string . $sub;
        }
    }
}

// List Sidebar
if (!function_exists('rit_sidebar')) {
    function rit_sidebar()
    {
        global $wp_registered_sidebars;

        $sidebar_options = array();

        foreach ($wp_registered_sidebars as $sidebar) {
            $sidebar_options[$sidebar['id']] = $sidebar['name'];
        }

        return $sidebar_options;
    }
}

// Merge google font
if (!function_exists('rit_merge_google_font')) {
    function rit_merge_google_font($font_array)
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

// Get link google font
if (!function_exists('rit_create_google_font_url')) {
    function rit_create_google_font_url($font_array)
    {

        if (count($font_array) > 0) {

            $font_array = rit_merge_google_font($font_array);

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
// Random ID
if (!function_exists('rit_random_ID')) {
    function rit_random_ID()
    {
        return uniqid();
    }
}
// Conver Color
if (!function_exists('ri_fusion_hex2rgba')) {
    /* Convert hexdec color string to rgb(a) string */

    function ri_fusion_hex2rgba($hex, $opacity = 1)
    {

        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgba; // returns an array with the rgb values
    }
}


// -------------------- Register Sidebar --------------------- //
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => esc_html__('Widget Area', 'ri-fusion'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'ri-fusion'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar 2', 'ri-fusion'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add widgets here to appear in your sidebar 2.', 'ri-fusion'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Static Sidebar', 'ri-fusion'),
        'id' => 'sidebar-static',
        'description' => esc_html__('Add widgets here to appear in Off canvas sidebar.', 'ri-fusion'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Right Header', 'ri-fusion'),
        'id' => 'right-header',
        'description' => esc_html__('Add widgets here to appear in Right header of Header Logo Center.', 'ri-fusion'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer', 'ri-fusion'),
        'id' => 'footer',
        'description' => esc_html(__('Add widgets here to appear in your sidebar footer.', 'ri-fusion')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'ri-fusion'),
        'id' => 'footer-2',
        'description' => esc_html(__('Add widgets here to appear in your sidebar footer. Use for footer one line style', 'ri-fusion')),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
/* COMMENTS
	================================================== */
if (!function_exists('rit_fusion_custom_comments')) {
    function rit_fusion_custom_comments($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
        ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
        <div class="comment-wrap clearfix">
            <div class="comment-avatar">
                <?php if (function_exists('get_avatar')) {
                    echo wp_kses(get_avatar($comment, '50'), array('img' => array('class' => array(), 'width' => array(), 'height' => array(), 'alt' => array(), 'src' => array())));
                } ?>
            </div>
            <div class="comment-content">
                <div class="comment-meta">
                    <?php
                    printf('<h6 class="author-name">%1$s</h6>',
                        get_comment_author_link()
                    );
                    echo '<span class="date-post">' . esc_html(get_comment_date('M, j, Y', get_comment_ID())) . '</span>';
                    ?>
                </div>
                <?php if ($comment->comment_approved == '0') wp_kses(__("\t\t\t\t\t<span class='unapproved'>" . esc_html__('Your comment is awaiting moderation.', 'ri-fusion') . "</span>\n", 'ri-fusion'), array('span' => array('class' => array()))); ?>
                <div class="comment-body">
                    <?php comment_text() ?>
                </div>
                <div class="comment-meta-actions">
                    <?php
                    edit_comment_link(esc_html(__('Edit', 'ri-fusion')), '<span class="edit-link">', '</span>');
                    ?>
                    <?php if ($args['type'] == 'all' || get_comment_type() == 'comment') :
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => esc_html(__('Reply', 'ri-fusion')),
                            'login_text' => esc_html(__('Log in to reply.', 'ri-fusion')),
                            'depth' => $depth,
                            'before' => '<span class="comment-reply">',
                            'after' => '</span>'
                        )));
                    endif; ?>
                </div>
            </div>
        </div>
    <?php }
} // end rit_fusion_custom_comments
// Add Edit Style
function rit_add_editor_styles()
{
    add_editor_style('css/editor-style.css');
}

add_action('admin_init', 'rit_add_editor_styles');
/**
 * Load media files needed for Uploader
 */
function rit_load_wp_media_files()
{
    wp_enqueue_media();
}

add_action('admin_enqueue_scripts', 'rit_load_wp_media_files');