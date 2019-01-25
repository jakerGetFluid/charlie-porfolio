<?php
// Customize
if (class_exists('RIT_Customize')) {
    function rit_customize()
    {
        $rit_customize = RIT_Customize::getInstance();

        $customizers = array(
            'rit_new_section_general' => array(
                'title' => esc_html__('General Options', 'ri-fusion'),
                'description' => '',
                'priority' => 21,
                'settings' => array(
                    'rit_custom_css' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Custom CSS', 'ri-fusion'),
                        'priority' => 6
                    ),
                    'rit_custom_js' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Custom JS', 'ri-fusion'),
                        'priority' => 7
                    ),
                    'rit_enable_large_width' => array(
                        'type' => 'number',
                        'label' => esc_html__('Page Max Width', 'ri-fusion'),
                        'priority' => 2,
                        'description' => esc_html__('Max width layout of page. If not set, it will apply default value is 1170', 'ri-fusion'),
                        'params' => array(
                            'default' => '1170',
                        ),
                    ),
                )
            ),
            'rit_new_section_export_import' => array(
                'title' => esc_html(__('Export/Import', 'ri-fusion')),
                'priority' => 100,
                'settings' => array(
                    'rit-setting' => array(
                        'class' => 'cei',
                        'priority' => 2
                    )
                ),
            ),
            'rit_new_section_sidebar_meta' => array(
                'title' => esc_html(__('Sidebar Options', 'ri-fusion')),
                'description' => '',
                'priority' => 24,
                'settings' => array(
                    'rit_default_sidebar' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Default Sidebar Config', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'no-sidebar' => esc_html(__('No Sidebar', 'ri-fusion')),
                            'left-sidebar' => esc_html(__('Left Sidebar', 'ri-fusion')),
                            'right-sidebar' => esc_html(__('Right Sidebar', 'ri-fusion')),
                            'both-sidebar' => esc_html(__('Both Sidebar', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'right-sidebar',
                        ),
                    ),
                    'rit_default_left_sidebar' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Default Left Sidebar', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => rit_sidebar(),
                        'params' => array(
                            'default' => 'sidebar-1',
                        ),
                    ),
                    'rit_default_right_sidebar' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Default Right Sidebar', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => rit_sidebar(),
                        'params' => array(
                            'default' => 'sidebar-1',
                        ),
                    )
                )
            ),
            'rit_header_logo' => array(
                'title' => esc_html__('Header Logo Options', 'ri-fusion'),
                'description' => '',
                'priority' => 1,
                'panel' => 'header_options_panel',
                'settings' => array(
                    'rit_logo' => array(
                        'class' => 'image',
                        'label' => esc_html__('Logo', 'ri-fusion'),
                        'description' => wp_kses(__('Upload Logo Image. <strong>NOTE: Please resize logo before upload. Recommend: height of logo should 40px</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 1
                    ),
                    'rit_logo_top_spacing' => array(
                        'type' => 'number',
                        'label' => esc_html__('Logo Top spacing', 'ri-fusion'),
                        'description' => esc_html__('Fill Logo Top spacing. Note: without (px)', 'ri-fusion'),
                        'priority' => 5,
                        'params' => array(
                            'default' => '32',
                        ),
                    ),
                    'rit_logo_bottom_spacing' => array(
                        'type' => 'number',
                        'label' => esc_html__('Logo Bottom spacing', 'ri-fusion'),
                        'description' => esc_html__('Fill Logo Bottom spacing. Note: without (px)', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '0',
                        ),
                    ),

                )
            ),
            'rit_header' => array(
                'title' => esc_html__('Header Style', 'ri-fusion'),
                'description' => '',
                'priority' => 2,
                'panel' => 'header_options_panel',
                'settings' => array(
                    'rit_default_menu_style' => array(
                        'type' => 'select',
                        'label' => esc_html__('Header Layout', 'ri-fusion'),
                        'description' => '',
                        'priority' => 1,
                        'choices' => array(
                            'default' => esc_html__('Header Menu Right', 'ri-fusion'),
                            'hamburger' => esc_html__('Header Hamburger Menu', 'ri-fusion'),
                            'lightbox' => esc_html__('Header Light Box Menu', 'ri-fusion'),
                            'center' => esc_html__('Header Center Menu', 'ri-fusion'),
                            'stack-center' => esc_html__('Header Stack Center Menu', 'ri-fusion'),
                            'logo-center' => esc_html__('Header Logo Center Menu', 'ri-fusion'),
                        ),
                        'params' => array(
                            'default' => 'default',
                        ),
                    ),
                    'rit_enable_header_absolute' => array(
                        'class' => 'toggle',
                        'label' => esc_html__('Enable Header Transparency', 'ri-fusion'),
                        'description' => esc_html__('Header will be override slider and content.', 'ri-fusion'),
                        'priority' => 1
                    ),
                    'rit_enable_offcanvas_sidebar' => array(
                        'type' => 'radio',
                        'label' => esc_html__('Enable Off canvas sidebar', 'ri-fusion'),
                        'priority' => 1,
                        'choices' => array(
                            '1' => esc_html__('Yes', 'ri-fusion'),
                            '0' => esc_html__('No', 'ri-fusion')
                        ),
                        'params' => array(
                            'default' => '1',
                        ),
                    ),
                    'rit_heading_header_size' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Header Size Options', 'ri-fusion'),
                        'priority' => 2,
                    ),
                    'rit_enable_header_fullwidth' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('100% Header Width', 'ri-fusion'),
                        'description' => esc_html__('Check this box to set the header to 100% of the browser width. Uncheck to follow the site width.', 'ri-fusion'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '0',
                        ),
                    ),
                    'rit_header_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Header Height', 'ri-fusion'),
                        'description' => wp_kses(__('The height of <strong>"Header"</strong>. <strong>Note: without (px)</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 9,
                        'params' => array(
                            'default' => '120',
                        ),
                    ),
                    'rit_header_sticky_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Header Sticky Height', 'ri-fusion'),
                        'description' => esc_html__('The height of Header when sticky', 'ri-fusion'),
                        'priority' => 9,
                        'params' => array(
                            'default' => '80',
                        ),
                    ),
                    'rit_header_mobile_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Header Mobile Height', 'ri-fusion'),
                        'description' => esc_html__('The height of Header in mobile', 'ri-fusion'),
                        'priority' => 9,
                        'params' => array(
                            'default' => '80',
                        ),
                    ),
                    'rit_enable_sticky_header' => array(
                        'type' => 'radio',
                        'label' => esc_html__('Enable Sticky Header', 'ri-fusion'),
                        'priority' => 10,
                        'choices' => array(
                            '1' => esc_html__('Yes', 'ri-fusion'),
                            '0' => esc_html__('No', 'ri-fusion')
                        ),
                        'params' => array(
                            'default' => '1',
                        ),
                    ),
                    'rit_show_tagline' => array(
                        'type' => 'radio',
                        'label' => esc_html__('Show Tagline', 'ri-fusion'),
                        'priority' => 11,
                        'choices' => array(
                            '1' => esc_html__('Yes', 'ri-fusion'),
                            '0' => esc_html__('No', 'ri-fusion')
                        ),
                        'params' => array(
                            'default' => '1',
                        ),
                    ),
                )),
            'rit_new_section_footer' => array(
                'title' => esc_html__('Footer Options', 'ri-fusion'),
                'description' => '',
                'priority' => 23,
                'settings' => array(
                    'rit_disable_footer' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Disable Footer', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0,
                        'params' => array(
                            'default' => '0',
                        ),
                    ),
                    'rit_footer_sticky' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Footer sticky', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0,
                        'params' => array(
                            'default' => '0',
                        ),
                    ),
                    'rit_footer_style' => array(
                        'type' => 'select',
                        'label' => esc_html__('Footer Style', 'ri-fusion'),
                        'priority' => 1,
                        'choices' => array(
                            'default' => esc_html__('Style 1', 'ri-fusion'),
                            'one-line' => esc_html__('Style 2', 'ri-fusion')
                        ),
                        'params' => array(
                            'default' => 'center',
                        ),
                    ),
                    'rit_enable_copyright' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Enable Copyright', 'ri-fusion'),
                        'description' => '',
                        'priority' => 2,
                        'params' => array(
                            'default' => '1',
                        ),
                    ),
                    'rit_copyright_text' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Footer Copyright Text', 'ri-fusion'),
                        'description' => '',
                        'priority' => 3
                    ),
                    'rit_short_copyright_text' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Footer Short Copyright Text', 'ri-fusion'),
                        'description' => esc_html__('Use for Footer one line, off canvas sidebar and hamburger menu', 'ri-fusion'),
                        'priority' => 4
                    )
                )
            ),
            'rit_blog_options' => array(
                'title' => esc_html__('Blog Options', 'ri-fusion'),
                'description' => '',
                'priority' => 25,
                'settings' => array(
                    'rit_heading_default_layout' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Category page layout', 'ri-fusion'),
                        'priority' => 0,
                    ),
                    'rit_default_layout' => array(
                        'type' => 'select',
                        'label' => esc_html__('Default Post Layout', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'grid' => esc_html__('Grid', 'ri-fusion'),
                            'masonry' => esc_html__('Masonry', 'ri-fusion'),
                            'list' => esc_html__('List', 'ri-fusion')
                        ),
                        'params' => array(
                            'default' => 'grid',
                        ),
                    ),
                    'rit_default_col' => array(
                        'type' => 'select',
                        'label' => esc_html__('Columns', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            '2' => esc_html__('2 Columns', 'ri-fusion'),
                            '3' => esc_html__('3 Columns', 'ri-fusion'),
                            '4' => esc_html__('4 Columns', 'ri-fusion'),
                            '5' => esc_html__('5 Columns', 'ri-fusion'),
                            '6' => esc_html__('6 Columns', 'ri-fusion'),
                        ),
                        'params' => array(
                            'default' => '3',
                        ),
                        'dependency' => array('rit_default_layout' => 'grid', 'rit_default_layout' => 'masonry')
                    ),
                    'rit_default_img_size' => array(
                        'type' => 'select',
                        'label' => esc_html__('Image size', 'ri-fusion'),
                        'description' => esc_html__('Select image size display in categories page, archive page, for display better and loading faster', 'ri-fusion'),
                        'priority' => 0,
                        'choices' => array(
                            'thumbnail' => esc_html__('Thumbnail', 'ri-fusion'),
                            'medium' => esc_html__('Medium', 'ri-fusion'),
                            'large' => esc_html__('Large', 'ri-fusion'),
                            'full' => esc_html__('Original', 'ri-fusion'),
                            'custom' => esc_html__('Custom size', 'ri-fusion'),
                        ),
                        'params' => array(
                            'default' => 'medium',
                        ),
                    ),
                    'rit_default_img_custom_size_width' => array(
                        'type' => 'number',
                        'label' => esc_html__('Image Width', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0,
                        'params' => array(
                            'default' => '370',
                        ),
                        'dependency' => array('rit_default_img_size' => 'custom')
                    ),
                    'rit_default_img_custom_size_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Image Height', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0,
                        'params' => array(
                            'default' => '210',
                        ),
                        'dependency' => array('rit_default_img_size' => 'custom')
                    ),
                    'rit_hide_readmore' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Read more', 'ri-fusion'),
                        'description' => esc_html__('Check this box to hide read more button.', 'ri-fusion'),
                        'priority' => 0,
                    ),
                    'rit_heading_default_detail_blog' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Detail post options', 'ri-fusion'),
                        'priority' => 0,
                    ),
                    'rit_author_info' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Author info', 'ri-fusion'),
                        'description' => esc_html__('Check this box to hide the author info box on the detail page.', 'ri-fusion'),
                        'priority' => 1,
                    ),
                    'rit_social_sharing' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Social Sharing', 'ri-fusion'),
                        'description' => esc_html__('Check this box to hide social sharing icons on the detail page.', 'ri-fusion'),
                        'priority' => 1,
                    ),
                    'rit_related_articles' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide related articles', 'ri-fusion'),
                        'description' => esc_html__('Check this box to hide related articles on the detail page.', 'ri-fusion'),
                        'priority' => 1,
                    ),
                )),
            'rit_new_section_font_family' => array(
                'title' => esc_html(__('Font Family Options', 'ri-fusion')),
                'panel' => 'rit_font_panel',
                'description' => '',
                'priority' => 1,
                'settings' => array(
                    'rit_body_font_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Body Font', 'ri-fusion')),
                        'priority' => 0
                    ),
                    'rit_body_font_select' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Body Font', 'ri-fusion')),
                        'description' => '',
                        'priority' => 1,
                        'choices' => array(
                            'standard' => esc_html(__('Standard', 'ri-fusion')),
                            'google' => esc_html(__('Google', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'google',
                        ),
                    ),
                    'rit_body_font_standard' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Body Standard Font', 'ri-fusion')),
                        'description' => '',
                        'priority' => 2,
                        'choices' => array(
                            'Arial' => esc_html(__('Arial', 'ri-fusion')),
                            'Courier New' => esc_html(__('Courier New', 'ri-fusion')),
                            'Georgia' => esc_html(__('Georgia', 'ri-fusion')),
                            'Helvetica' => esc_html(__('Helvetica', 'ri-fusion')),
                            'Lucida Sans' => esc_html(__('Lucida Sans', 'ri-fusion')),
                            'Lucida Sans Unicode' => esc_html(__('Lucida Sans Unicode', 'ri-fusion')),
                            'Myriad Pro' => esc_html(__('Myriad Pro', 'ri-fusion')),
                            'Palatino Linotype' => esc_html(__('Palatino Linotype', 'ri-fusion')),
                            'Tahoma' => esc_html(__('Tahoma', 'ri-fusion')),
                            'Times New Roman' => esc_html(__('Times New Roman', 'ri-fusion')),
                            'Trebuchet MS' => esc_html(__('Trebuchet MS', 'ri-fusion')),
                            'Verdana' => esc_html(__('Verdana', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'Arial',
                        ),
                        'dependency' => array('rit_body_font_select' => 'standard')
                    ),
                    'rit_body_font_google' => array(
                        'class' => 'googlefont',
                        'label' => esc_html(__('Body Google Font', 'ri-fusion')),
                        'description' => '',
                        'priority' => 3,
                        'params' => array(
                            'default' => json_encode(array('family' => 'Roboto Mono', 'variants' => array('300', '400', '500', '700'), 'subsets' => array('latin'))),
                        ),
                        'dependency' => array('rit_body_font_select' => 'google')
                    ),
                    'rit_heading_font_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Main Font', 'ri-fusion')),
                        'description' => 'Font for tag heading (h1 - h6), special tag, button...',
                        'priority' => 8
                    ),
                    'rit_heading_font_select' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Main Font', 'ri-fusion')),
                        'description' => '',
                        'priority' => 9,
                        'choices' => array(
                            'standard' => esc_html(__('Standard', 'ri-fusion')),
                            'google' => esc_html(__('Google', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'google',
                        ),
                    ),
                    'rit_heading_font_standard' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Main Standard Font', 'ri-fusion')),
                        'description' => '',
                        'priority' => 10,
                        'choices' => array(
                            'Arial' => esc_html(__('Arial', 'ri-fusion')),
                            'Courier New' => esc_html(__('Courier New', 'ri-fusion')),
                            'Georgia' => esc_html(__('Georgia', 'ri-fusion')),
                            'Helvetica' => esc_html(__('Helvetica', 'ri-fusion')),
                            'Lucida Sans' => esc_html(__('Lucida Sans', 'ri-fusion')),
                            'Lucida Sans Unicode' => esc_html(__('Lucida Sans Unicode', 'ri-fusion')),
                            'Myriad Pro' => esc_html(__('Myriad Pro', 'ri-fusion')),
                            'Palatino Linotype' => esc_html(__('Palatino Linotype', 'ri-fusion')),
                            'Tahoma' => esc_html(__('Tahoma', 'ri-fusion')),
                            'Times New Roman' => esc_html(__('Times New Roman', 'ri-fusion')),
                            'Trebuchet MS' => esc_html(__('Trebuchet MS', 'ri-fusion')),
                            'Verdana' => esc_html(__('Verdana', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'Arial',
                        ),
                        'dependency' => array('rit_heading_font_select' => 'standard')
                    ),
                    'rit_heading_font_google' => array(
                        'class' => 'googlefont',
                        'label' => esc_html(__('Main Google Font', 'ri-fusion')),
                        'description' => '',
                        'priority' => 11,
                        'params' => array(
                            'default' => json_encode(array('family' => 'Oswald', 'variants' => array('300', '400', '500', '700'), 'subsets' => array('latin'))),
                        ),
                        'dependency' => array('rit_heading_font_select' => 'google')
                    )
                )
            ),
            'rit_new_section_font_size' => array(
                'title' => esc_html__('Font Size Options', 'ri-fusion'),
                'panel' => 'rit_font_panel',
                'description' => '',
                'priority' => 4,
                'settings' => array(
                    'rit_fontsize_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Font Size', 'ri-fusion')),
                        'priority' => 0
                    ),
                    'rit_enable_body_font_size' => array(
                        'type' => 'number',
                        'label' => esc_html__('Body Font Size', 'ri-fusion'),
                        'description' => wp_kses(__('Font size of body. <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 1,
                        'params' => array(
                            'default' => '14',
                        )
                    ),
                    'rit_enable_bodyline_height' => array(
                        'type' => 'number',
                        'label' => esc_html__('Body Font Line Height', 'ri-fusion'),
                        'description' => wp_kses(__('Line Height font of body. <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 2,
                        'params' => array(
                            'default' => '18',
                        )
                    ),
                    'rit_enable_menu_font_size' => array(
                        'type' => 'number',
                        'label' => esc_html__('Menu Font Size', 'ri-fusion'),
                        'description' => wp_kses(__('Font size of font of body. <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 3,
                        'params' => array(
                            'default' => '14',
                        )
                    ),
                    'rit_fontsize_portfolio_heading' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Portfolio Font Size', 'ri-fusion')),
                        'priority' => 0
                    ),
                    'rit_fontsize_portfolio_title' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of title Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                    'rit_fontsize_portfolio_categories' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of category Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                    'rit_fontsize_portfolio_title_detail' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of Title Detail Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for detail portfolio page', 'ri-fusion'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                    'rit_fontsize_block' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Block Title', 'ri-fusion'),
                        'description' => esc_html__('Font size of title block, display in home page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '21',
                        )
                    ),
                    'rit_fontsize_title_widget' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Title Widget', 'ri-fusion'),
                        'description' => esc_html__('Font size of title widget.', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '24',
                        )
                    ),
                    'rit_fontsize_title_widget_footer' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size Title Widget Footer', 'ri-fusion'),
                        'description' => esc_html__('Font size of title widget in footer.', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '16',
                        )
                    ),
                    'rit_fontsize_post' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Font Size Post Type', 'ri-fusion')),
                        'priority' => 4
                    ),
                    'rit_fontsize_post_title' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of title post', 'ri-fusion'),
                        'description' => esc_html__('Font size of title post in category, archive, page and recent post', 'ri-fusion'),
                        'priority' => 5,
                        'params' => array(
                            'default' => '18',
                        )
                    ),
                    'rit_fontsize_gallery_title' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of title Gallery', 'ri-fusion'),
                        'priority' => 5,
                        'params' => array(
                            'default' => '21',
                        )
                    ),
                    'rit_fontsize_single_post_title' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font size of title single post.', 'ri-fusion'),
                        'description' => esc_html__('Font size title single post', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '36',
                        )
                    ),
                    'rit_font_heading_size' => array(
                        'class' => 'heading',
                        'label' => esc_html(__('Font Size Heading', 'ri-fusion')),
                        'priority' => 7
                    ),
                    'rit_font_size_h1' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h1', 'ri-fusion'),
                        'description' => wp_kses(__('Fontsize of tag "h1". <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 8,
                        'params' => array(
                            'default' => '36',
                        )
                    ),
                    'rit_font_size_h2' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h2', 'ri-fusion'),
                        'description' => wp_kses(__('Fontsize of tag "h2". <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 9,
                        'params' => array(
                            'default' => '30',
                        )
                    ),
                    'rit_font_size_h3' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h3', 'ri-fusion'),
                        'description' => wp_kses(__('Fontsize of tag "h3". <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 10,
                        'params' => array(
                            'default' => '24',
                        )
                    ),
                    'rit_font_size_h4' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h4', 'ri-fusion'),
                        'description' => wp_kses(__('Fontsize of tag "h4". <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 11,
                        'params' => array(
                            'default' => '22',
                        )
                    ),
                    'rit_font_size_h5' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h5', 'ri-fusion'),
                        'description' => wp_kses(__('Fontsize of tag "h5". <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 12,
                        'params' => array(
                            'default' => '20',
                        )
                    ),
                    'rit_font_size_h6' => array(
                        'type' => 'number',
                        'label' => esc_html__('Font Size h6', 'ri-fusion'),
                        'description' => wp_kses(__('Fontsize of tag "h6". <strong>Note: Excluding "px" after value</strong>', 'ri-fusion'), array('strong' => array())),
                        'priority' => 13,
                        'params' => array(
                            'default' => '18',
                        )
                    ),
                )
            ),
            'rit_new_section_social' => array(
                'title' => esc_html__('Social Profiles', 'rit-core-language'),
                'description' => '',
                'priority' => 25,
                'settings' => array(
                    'rit_social_twitter' => array(
                        'type' => 'text',
                        'label' => esc_html__('Twitter', 'rit-core-language'),
                        'description' => esc_html__('Your Twitter username (no @).', 'rit-core-language'),
                        'priority' => 0,
                        'params' => array(
                            'default' => 'username',
                        ),
                    ),
                    'rit_social_facebook' => array(
                        'type' => 'text',
                        'label' => esc_html__('Facebook', 'rit-core-language'),
                        'description' => esc_html__('Your facebook page/profile url', 'rit-core-language'),
                        'priority' => 1,
                        'params' => array(
                            'default' => 'page/profile-url',
                        ),
                    ),
                    'rit_social_dribbble' => array(
                        'type' => 'text',
                        'label' => esc_html__('Dribbble', 'rit-core-language'),
                        'description' => esc_html__('Your Dribbble username', 'rit-core-language'),
                        'priority' => 2,
                        'params' => array(
                            'default' => 'username',
                        ),
                    ),
                    'rit_social_vimeo' => array(
                        'type' => 'text',
                        'label' => esc_html__('Vimeo', 'rit-core-language'),
                        'description' => esc_html__('Your Vimeo username', 'rit-core-language'),
                        'priority' => 3,
                        'params' => array(
                            'default' => 'username',
                        ),
                    ),
                    'rit_social_tumblr' => array(
                        'type' => 'text',
                        'label' => esc_html__('Tumblr', 'rit-core-language'),
                        'description' => esc_html__('Your Tumblr username', 'rit-core-language'),
                        'priority' => 4,
                        'params' => array(
                            'default' => 'username',
                        ),
                    ),
                    'rit_social_skype' => array(
                        'type' => 'text',
                        'label' => esc_html__('Skype', 'rit-core-language'),
                        'description' => esc_html__('Your Skype username', 'rit-core-language'),
                        'priority' => 5,
                        'params' => array(
                            'default' => 'username',
                        ),
                    ),
                    'rit_social_linkedin' => array(
                        'type' => 'text',
                        'label' => esc_html__('LinkedIn', 'rit-core-language'),
                        'description' => esc_html__('Your LinkedIn page/profile url', 'rit-core-language'),
                        'priority' => 6,
                        'params' => array(
                            'default' => 'page/profile-url',
                        ),
                    ),
                    'rit_social_googleplus' => array(
                        'type' => 'text',
                        'label' => esc_html__('Google+', 'rit-core-language'),
                        'description' => esc_html__('Your Google+ page/profile URL', 'rit-core-language'),
                        'priority' => 7,
                        'params' => array(
                            'default' => 'page/profile-url',
                        ),
                    ),
                    'rit_social_flickr' => array(
                        'type' => 'text',
                        'label' => esc_html__('Flickr', 'rit-core-language'),
                        'description' => esc_html__('Your Flickr page url', 'rit-core-language'),
                        'priority' => 8,
                        'params' => array(
                            'default' => 'page-url',
                        ),
                    ),
                    'rit_social_youTube' => array(
                        'type' => 'text',
                        'label' => esc_html__('YouTube', 'rit-core-language'),
                        'description' => esc_html__('Your YouTube URL', 'rit-core-language'),
                        'priority' => 9,
                        'params' => array(
                            'default' => 'youtube-url',
                        ),
                    ),
                    'rit_social_pinterest' => array(
                        'type' => 'text',
                        'label' => esc_html__('Pinterest', 'rit-core-language'),
                        'description' => esc_html__('Your Pinterest username', 'rit-core-language'),
                        'priority' => 10,
                        'params' => array(
                            'default' => 'username',
                        ),
                    ),
                    'rit_social_foursquare' => array(
                        'type' => 'text',
                        'label' => esc_html__('Foursquare', 'rit-core-language'),
                        'description' => esc_html__('Your Foursqaure URL', 'rit-core-language'),
                        'priority' => 11,
                        'params' => array(
                            'default' => 'url',
                        ),
                    ),
                    'rit_social_instagram' => array(
                        'type' => 'text',
                        'label' => esc_html__('Instagram', 'rit-core-language'),
                        'description' => esc_html__('Your Instagram username', 'rit-core-language'),
                        'priority' => 12,
                        'params' => array(
                            'default' => 'username',
                        ),
                    ),
                    'rit_social_github' => array(
                        'type' => 'text',
                        'label' => esc_html__('GitHub', 'rit-core-language'),
                        'description' => esc_html__('Your GitHub URL', 'rit-core-language'),
                        'priority' => 13,
                        'params' => array(
                            'default' => 'url',
                        ),
                    ),
                    'rit_social_xing' => array(
                        'type' => 'text',
                        'label' => esc_html__('Xing', 'rit-core-language'),
                        'description' => esc_html__('Your Xing URL', 'rit-core-language'),
                        'priority' => 14,
                        'params' => array(
                            'default' => 'url',
                        ),
                    ),
                )
            ),
            'rit_new_section_color_general' => array(
                'title' => esc_html__('General Color', 'ri-fusion'),
                'description' => '',
                'priority' => 3,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_primary_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Primary Color', 'ri-fusion'),
                        'description' => esc_html__('Color use some special location.', 'ri-fusion'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_sec_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Second Color', 'ri-fusion'),
                        'description' => esc_html__('Color use some special location.', 'ri-fusion'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#acacac',
                        ),
                    ),
                    'rit_accent_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Accent Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_border_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Border Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#ebebeb',
                        ),
                    )
                )),
            'rit_button_color_general' => array(
                'title' => esc_html__('Button Color Options', 'ri-fusion'),
                'description' => '',
                'priority' => 4,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_button_flat' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Button Flat Options', 'ri-fusion'),
                        'priority' => 1
                    ),
                    'rit_button_flat_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Button', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_flat_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Button Hover', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_button_flat_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Button', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_flat_bg_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Button Hover', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#f5f5f5',
                        ),
                    ),
                    'rit_button_cross' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Button Cross Options', 'ri-fusion'),
                        'priority' => 1
                    ),
                    'rit_button_cross_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Button Cross', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_cross_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color Button Cross Hover', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_cross_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Button Cross', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_button_cross_bg_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Button Cross Hover', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_button_cross_border' => array(
                        'class' => 'color',
                        'label' => esc_html__('Border Button Cross', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_button_cross_border_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Border Button Cross Hover', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                )),
            'rit_new_section_color_header' => array(
                'title' => esc_html__('Header', 'ri-fusion'),
                'description' => '',
                'priority' => 5,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_header_opacity' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Opacity', 'ri-fusion'),
                        'priority' => 6,
                        'description' => esc_html__('Controls the background color and opacity for the header. Opacity only works with header top position (sticky) and ranges between 0 (transparent) and 1 (opaque). Ex: 0.4', 'ri-fusion'),
                        'params' => array(
                            'default' => '1',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                    'rit_header_background_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '',
                        ),
                    ),
                    'rit_header_background_color_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Background Opacity', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '1',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                    'rit_header_sticky_background_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Sticky Color', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                    'rit_header_sticky_background_color_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Background Sticky Opacity', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '1',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                    ),
                    'rit_header_border_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Border Color', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '#ebebeb',
                        ),
                        'dependency' => array('rit_header_background_color' => '')
                    ),
                    'rit_header_border_color_opc' => array(
                        'class' => 'slider',
                        'label' => esc_html__('Border Opacity', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '1',
                        ),
                        'choices' => array(
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.1
                        ),
                        'dependency' => array('rit_header_background_color' => '')
                    ),
                    'rit_header_text_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text color', 'ri-fusion'),
                        'priority' => 8,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_header_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link color', 'ri-fusion'),
                        'priority' => 9,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_header_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Hover color', 'ri-fusion'),
                        'priority' => 10,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                )
            ),
            'rit_new_section_color_body' => array(
                'title' => esc_html__('Body', 'ri-fusion'),
                'description' => '',
                'priority' => 6,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_body_bg_image' => array(
                        'class' => 'image',
                        'label' => esc_html__('Body Background Image', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0
                    ),
                    'rit_body_bg_repeat' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Repeat', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'no-repeat' => esc_html(__('no-repeat', 'ri-fusion')),
                            'repeat' => esc_html(__('repeat', 'ri-fusion')),
                            'repeat-x' => esc_html(__('repeat-x', 'ri-fusion')),
                            'repeat-y' => esc_html(__('repeat-y', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'repeat',
                        ),
                    ),
                    'rit_body_bg_size' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Size', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'contain' => esc_html(__('contain', 'ri-fusion')),
                            'auto' => esc_html(__('auto', 'ri-fusion')),
                            'cover' => esc_html(__('cover', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'auto',
                        ),
                    ),
                    'rit_body_bg_attachment' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Attachment', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'local' => esc_html(__('local', 'ri-fusion')),
                            'fixed' => esc_html(__('fixed', 'ri-fusion')),
                            'scroll' => esc_html(__('scroll', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'scroll',
                        ),
                    ),
                    'rit_body_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Body Background Color', 'ri-fusion'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#ffffff',
                        ),
                    ),
                    'rit_body_text_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#7d7d7d',
                        ),
                    ),
                    'rit_body_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#DC9814',
                        ),
                    ),
                    'rit_body_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Link Hover Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h1_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H1 Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h2_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H2 Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h3_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H3 Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h4_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H4 Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h5_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H5 Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_body_h6_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('H6 Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    )
                )
            ),
            'rit_new_section_body_bg' => array(
                'title' => esc_html__('Body background', 'ri-fusion'),
                'description' => '',
                'priority' => 12,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_page_bg' => array(
                        'class' => 'image',
                        'label' => esc_html__('Background Image', 'ri-fusion'),
                        'priority' => 0
                    ),
                    'rit_page_bg_repeat' => array(
                        'type' => 'select',
                        'label' => esc_html__('Background Repeat', 'ri-fusion'),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'no-repeat' => esc_html__('no-repeat', 'ri-fusion'),
                            'repeat' => esc_html__('repeat', 'ri-fusion'),
                            'repeat-x' => esc_html__('repeat-x', 'ri-fusion'),
                            'repeat-y' => esc_html__('repeat-y', 'ri-fusion')
                        ),
                        'params' => array(
                            'default' => 'repeat',
                        ),
                    ),
                    'rit_page_bg_size' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Size', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'contain' => esc_html(__('contain', 'ri-fusion')),
                            'auto' => esc_html(__('auto', 'ri-fusion')),
                            'cover' => esc_html(__('cover', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'auto',
                        ),
                    ),
                    'rit_page_bg_attachment' => array(
                        'type' => 'select',
                        'label' => esc_html(__('Background Attachment', 'ri-fusion')),
                        'description' => '',
                        'priority' => 0,
                        'choices' => array(
                            'local' => esc_html(__('local', 'ri-fusion')),
                            'fixed' => esc_html(__('fixed', 'ri-fusion')),
                            'scroll' => esc_html(__('scroll', 'ri-fusion'))
                        ),
                        'params' => array(
                            'default' => 'scroll',
                        ),
                    ),
                    'rit_page_background_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Background Color', 'ri-fusion'),
                        'priority' => 0,
                        'params' => array(
                            'default' => '#ffffff',
                        )
                    )
                )
            ),
            'rit_wrap_color_blog' => array(
                'title' => esc_html__('Blog', 'ri-fusion'),
                'description' => '',
                'priority' => 7,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_color_blog_title' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of title blog', 'ri-fusion'),
                        'description' => esc_html__('Apply for blog page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_blog_title_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of title blog', 'ri-fusion'),
                        'description' => esc_html__('Apply for blog page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#acacac',
                        )
                    ),
                    'rit_color_blog_categories' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of category blog', 'ri-fusion'),
                        'description' => esc_html__('Apply for blog page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#acacac',
                        )
                    ),
                    'rit_color_blog_categories_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color hover of category blog', 'ri-fusion'),
                        'description' => esc_html__('Apply for blog page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                    'rit_color_blog_title_detail' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of Title Detail blog', 'ri-fusion'),
                        'description' => esc_html__('Apply for detail blog page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#252525',
                        )
                    ),
                )),
            'rit_wrap_color_portfolio' => array(
                'title' => esc_html__('Portfolio', 'ri-fusion'),
                'description' => '',
                'priority' => 7,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_color_portfolio_title' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of title Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                    'rit_color_portfolio_title_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of title Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                    'rit_color_portfolio_categories' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of category Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                    'rit_color_portfolio_categories_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of category Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                    'rit_color_portfolio_title_detail' => array(
                        'class' => 'color',
                        'label' => esc_html__('Color of Title Detail Portfolio', 'ri-fusion'),
                        'description' => esc_html__('Apply for detail portfolio page', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '',
                        )
                    ),
                )),
            'rit_new_section_color_navigation' => array(
                'title' => esc_html__('Navigation', 'ri-fusion'),
                'description' => esc_html__('Not apply if you use Mega menu or use Menu transparent style. If you use Mega menu, please change it in Mega menu plugin options.', 'ri-fusion'),
                'priority' => 9,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_nav_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Background Color', 'ri-fusion'),
                        'priority' => 0,
                        'params' => array(
                            'default' => 'transparent',
                        ),
                    ),
                    'rit_nav_text_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Text Color', 'ri-fusion'),
                        'priority' => 1,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_nav_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Link Color', 'ri-fusion'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '#252525',
                        ),
                    ),
                    'rit_nav_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Link Hover Color', 'ri-fusion'),
                        'priority' => 3,
                        'params' => array(
                            'default' => '#ebebeb',
                        ),
                    ),
                    'rit_nav_sub_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Background Color', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#363636',
                        ),
                    ),
                    'rit_nav_sub_bg_color_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Background Color Hover', 'ri-fusion'),
                        'priority' => 4,
                        'params' => array(
                            'default' => '#363636',
                        ),
                    ),
                    'rit_nav_sub_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Link Color', 'ri-fusion'),
                        'priority' => 5,
                        'params' => array(
                            'default' => '#d7d7d7',
                        ),
                    ),
                    'rit_nav_sub_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Nav Drop Down Link Hover Color', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '#fff',
                        ),
                    ),
                )
            ),
            'rit_new_section_color_footer' => array(
                'title' => esc_html__('Footer', 'ri-fusion'),
                'description' => '',
                'priority' => 11,
                'panel' => 'color_panel',
                'settings' => array(
                    'rit_heading_footer_center' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Footer Center Color', 'ri-fusion'),
                        'priority' => 5,
                    ),
                    'rit_footer_center_bg' => array(
                        'class' => 'color',
                        'label' => esc_html__('Footer Center Background Color', 'ri-fusion'),
                        'priority' => 6,
                        'params' => array(
                            'default' => '#202020',
                        ),
                    ),
                    'rit_footer_center_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Footer Center Text Color', 'ri-fusion'),
                        'priority' => 7,
                        'params' => array(
                            'default' => '#ffffff',
                        ),
                    ),
                    'rit_footer_center_heading_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Footer Center Heading Color', 'ri-fusion'),
                        'priority' => 7,
                        'params' => array(
                            'default' => '#f9f9f9',
                        ),
                    ),
                    'rit_footer_center_link' => array(
                        'class' => 'color',
                        'label' => esc_html__('Footer Center Link Color', 'ri-fusion'),
                        'priority' => 8,
                        'params' => array(
                            'default' => '#666666',
                        ),
                    ),
                    'rit_footer_center_link_hover' => array(
                        'class' => 'color',
                        'label' => esc_html__('Footer Center Link Hover Color', 'ri-fusion'),
                        'priority' => 9,
                        'params' => array(
                            'default' => '#32ae8b',
                        ),
                    ),
                    'rit_heading_copyright' => array(
                        'class' => 'heading',
                        'label' => esc_html__('Copyright Color', 'ri-fusion'),
                        'priority' => 10,
                    ),
                    'rit_copyright_bg_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Copyright Background Color', 'ri-fusion'),
                        'priority' => 11,
                        'params' => array(
                            'default' => '#202020',
                        ),
                    ),
                    'rit_copyright_text_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Copyright Text Color', 'ri-fusion'),
                        'priority' => 12,
                        'params' => array(
                            'default' => '#5c5c5c',
                        ),
                    ),
                    'rit_copyright_link_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Copyright Link Color', 'ri-fusion'),
                        'priority' => 13,
                        'params' => array(
                            'default' => '#5c5c5c',
                        ),
                    ),
                    'rit_copyright_link_hover_color' => array(
                        'class' => 'color',
                        'label' => esc_html__('Copyright Link Hover Color', 'ri-fusion'),
                        'priority' => 14,
                        'params' => array(
                            'default' => '#32ae8b',
                        ),
                    )
                )
            ),
//            'rit_heading_category_portfolio_page' => array(
//                'title' => esc_html__('Portfolio Archive Option', 'ri-fusion'),
//                'panel' => 'rit_portfolio_panel',
//                'priority' => 1,
//                'settings' => array(
//                    'rit_portfolio_layout_info' => array(
//                        'class' => 'info',
//                        'label' => esc_html__('Tip', 'ri-fusion'),
//                        'description' => esc_html__('If you want make layout like grid, select Layout is Masonry, Image size is Portfolio Medium or Portfolio Thumbnail', 'ri-fusion'),
//                        'priority' => 1,
//                    ),
//                    'rit_portfolio_layout' => array(
//                        'type' => 'select',
//                        'label' => esc_html__('Portfolio Layout', 'ri-fusion'),
//                        'priority' => 1,
//                        'choices' => array(
//                            'masonry' => esc_html__('Masonry', 'ri-fusion'),
//                            'metro' => esc_html__('Metro', 'ri-fusion')
//                        ),
//                        'params' => array(
//                            'default' => 'masonry',
//                        ),
//                    ),
//                    'rit_detail_portfolio_page_img_size' => array(
//                        'type' => 'select',
//                        'label' => esc_html__('Portfolio page Image size', 'ri-fusion'),
//                        'description' => esc_html__('Select images size for load site faster and display better', 'ri-fusion'),
//                        'priority' => 1,
//                        'choices' => array(
//                            'rit-portfolio-thumb' => esc_html__('Portfolio Thumbnail', 'ri-fusion'),
//                            'rit-portfolio-medium' => esc_html__('Portfolio Medium', 'ri-fusion'),
//                            'medium' => esc_html__('Medium', 'ri-fusion'),
//                            'large' => esc_html__('Large', 'ri-fusion'),
//                            'full' => esc_html__('Original Size', 'ri-fusion'),
//                        ),
//                        'params' => array(
//                            'default' => 'rit-portfolio-medium',
//                        ),
//                    ),
//                    'rit_detail_portfolio_page_style' => array(
//                        'type' => 'select',
//                        'label' => esc_html__('Hover Effect', 'ri-fusion'),
//                        'description' => '',
//                        'priority' => 1,
//                        'choices' => array(
//                            'default' => esc_html__('default', 'ri-fusion'),
//                            'style-1' => esc_html__('Style 1', 'ri-fusion'),
//                            'style-2' => esc_html__('Style 2', 'ri-fusion')
//                        ),
//                        'params' => array(
//                            'default' => 'default',
//                        ),
//                    ),
//                    'rit_portfolio_page_columns' => array(
//                        'type' => 'select',
//                        'label' => esc_html__('Portfolio page Columns', 'ri-fusion'),
//                        'description' => esc_html__('If you use Metro Layout, this value will apply is maximum columns.', 'ri-fusion'),
//                        'priority' => 1,
//                        'choices' => array(
//                            '2' => esc_html__('2', 'ri-fusion'),
//                            '3' => esc_html__('3', 'ri-fusion'),
//                            '4' => esc_html__('4', 'ri-fusion'),
//                            '6' => esc_html__('6', 'ri-fusion')
//                        ),
//                        'params' => array(
//                            'default' => '3',
//                        ),
//                    ),
//                    'rit_portfolio_whitespace' => array(
//                        'type' => 'number',
//                        'label' => esc_html__('Gutter', 'ri-fusion'),
//                        'description' => esc_html__('White space width each column', 'ri-fusion'),
//                        'priority' => 1,
//                        'params' => array(
//                            'default' => '10',
//                        )
//                    ),
//                )),
//            'rit_heading_font_portfolio' => array(
//                'title' => esc_html__('Font size portfolio options', 'ri-fusion'),
//                'panel' => 'rit_portfolio_panel',
//                'priority' => 2,
//                'settings' => array(
//                    'rit_fontsize_portfolio_title' => array(
//                        'type' => 'number',
//                        'label' => esc_html__('Font size of title Portfolio', 'ri-fusion'),
//                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
//                        'priority' => 3,
//                        'params' => array(
//                            'default' => '',
//                        )
//                    ),
//                    'rit_fontsize_portfolio_categories' => array(
//                        'type' => 'number',
//                        'label' => esc_html__('Font size of category Portfolio', 'ri-fusion'),
//                        'description' => esc_html__('Apply for Portfolio page, except detail page', 'ri-fusion'),
//                        'priority' => 3,
//                        'params' => array(
//                            'default' => '',
//                        )
//                    ),
//                    'rit_fontsize_portfolio_title_detail' => array(
//                        'type' => 'number',
//                        'label' => esc_html__('Font size of Title Detail Portfolio', 'ri-fusion'),
//                        'description' => esc_html__('Apply for detail portfolio page', 'ri-fusion'),
//                        'priority' => 3,
//                        'params' => array(
//                            'default' => '',
//                        )
//                    )
//                )
//            ),
//            'rit_heading_detail_portfolio' => array(
//                'title' => esc_html__('Portfolio Detail', 'ri-fusion'),
//                'priority' => 1,
//                'panel' => 'rit_portfolio_panel',
//                'settings' => array(
//                    'rit_detail_portfolio_layout' => array(
//                        'type' => 'select',
//                        'label' => esc_html__('Detail portfolio layout', 'ri-fusion'),
//                        'description' => esc_html__('Default layout of detail portfolio.', 'ri-fusion'),
//                        'priority' => 2,
//                        'choices' => array(
//                            'list' => esc_html__('List', 'ri-fusion'),
//                            'metro' => esc_html__('Metro', 'ri-fusion'),
//                            'slider' => esc_html__('Slider', 'ri-fusion'),
//                            'full-screen' => esc_html__('Full Screen Slider', 'ri-fusion'),
//                            'right-sidebar' => esc_html__('Right Sidebar', 'ri-fusion'),
//                            'left-sidebar' => esc_html__('Left Sidebar', 'ri-fusion'),
//                        ),
//                        'params' => array(
//                            'default' => 'list',
//                        ),
//                    ),
//                    'rit_detail_portfolio_embed_layout' => array(
//                        'type' => 'select',
//                        'label' => esc_html__('Embed format detail layout', 'ri-fusion'),
//                        'description' => esc_html__('Default layout of Embed portfolio format.', 'ri-fusion'),
//                        'priority' => 2,
//                        'choices' => array(
//                            'list' => esc_html__('List', 'ri-fusion'),
//                            'full-width' => esc_html__('Media full width', 'ri-fusion'),
//                            'full-screen' => esc_html__('Media full screen (Video background)', 'ri-fusion'),
//                            'right-sidebar' => esc_html__('Right sidebar', 'ri-fusion'),
//                            'left-sidebar' => esc_html__('Left sidebar', 'ri-fusion'),
//                        ),
//                        'params' => array(
//                            'default' => 'list',
//                        ),
//                    ),
//                    'rit_detail_portfolio_hide_nav' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Show portfolio navigation', 'ri-fusion'),
//                        'description' => esc_html__('Show next, previous, and go home navigation of portfolio item.', 'ri-fusion'),
//                        'priority' => 2,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                    ),
//                    'rit_detail_portfolio_hide_info' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Show portfolio info', 'ri-fusion'),
//                        'description' => esc_html__('Show all information of portfolio', 'ri-fusion'),
//                        'priority' => 2,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                    ),
//                    'rit-portfolio-heading-info' => array(
//                        'class' => 'heading',
//                        'label' => esc_html__('LABEL', 'ri-fusion'),
//                        'priority' => 3,
//                    ),
//                    'rit_portfolio_heading_info_tip' => array(
//                        'class' => 'info',
//                        'label' => esc_html__('Tip', 'ri-fusion'),
//                        'description' => esc_html__('Title of block, you can change, or keep original text', 'ri-fusion'),
//                        'priority' => 3
//                    ),
//                    'rit_portfolio_heading_date' => array(
//                        'type' => 'text',
//                        'label' => esc_html__('Date Title', 'ri-fusion'),
//                        'priority' => 3,
//                        'params' => array(
//                            'default' => esc_html__('Date:', 'ri-fusion'),
//                        ),
//                        'dependency' => array('rit_detail_portfolio_hide_info' => true)
//                    ),
//                    'rit_portfolio_heading_client' => array(
//                        'type' => 'text',
//                        'label' => esc_html__('Client Title', 'ri-fusion'),
//                        'priority' => 3,
//                        'params' => array(
//                            'default' => esc_html__('Client:', 'ri-fusion'),
//                        ),
//                        'dependency' => array('rit_detail_portfolio_hide_info' => true)
//                    ),
//                    'rit_portfolio_heading_cat' => array(
//                        'type' => 'text',
//                        'label' => esc_html__('Categories Title', 'ri-fusion'),
//                        'priority' => 3,
//                        'params' => array(
//                            'default' => esc_html__('Categories:', 'ri-fusion'),
//                        ),
//                        'dependency' => array('rit_detail_portfolio_hide_info' => true)
//                    ),
//                    'rit_portfolio_heading_share' => array(
//                        'type' => 'text',
//                        'label' => esc_html__('Share This Project Title', 'ri-fusion'),
//                        'priority' => 3,
//                        'params' => array(
//                            'default' => esc_html__('Share', 'ri-fusion'),
//                        ),
//                    ),
//                    'rit-portfolio-heading-share' => array(
//                        'class' => 'heading',
//                        'label' => esc_html__('Portfolio Share Options', 'ri-fusion'),
//                        'priority' => 4,
//                    ),
//                    'rit_portfolio_share' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Enable share', 'ri-fusion'),
//                        'priority' => 4,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                    ),
//                    'rit_portfolio_facebook_share' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Facebook share', 'ri-fusion'),
//                        'priority' => 4,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                        'dependency' => array('rit_portfolio_share' => true)
//                    ),
//                    'rit_portfolio_twitter_share' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Twitter share', 'ri-fusion'),
//                        'priority' => 4,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                        'dependency' => array('rit_portfolio_share' => true)
//                    ),
//                    'rit_portfolio_gg_share' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Google plus share', 'ri-fusion'),
//                        'priority' => 4,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                        'dependency' => array('rit_portfolio_share' => true)
//                    ),
//                    'rit_portfolio_pinterest_share' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Pinterest share', 'ri-fusion'),
//                        'priority' => 4,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                        'dependency' => array('rit_portfolio_share' => true)
//                    ),
//                    'rit_portfolio_mail_share' => array(
//                        'class' => 'toggle',
//                        'label' => esc_html__('Mail share', 'ri-fusion'),
//                        'priority' => 4,
//                        'params' => array(
//                            'default' => true,
//                        ),
//                        'dependency' => array('rit_portfolio_share' => true)
//                    ),
//                )
//            ),
            'rit_gallery_custom' => array(
                'title' => esc_html__('Gallery Options', 'ri-fusion'),
                'priority' => 27,
                'settings' => array(
                    'rit_gallery_layout' => array(
                        'type' => 'select',
                        'label' => esc_html__('Gallery layout', 'ri-fusion'),
                        'description' => '',
                        'priority' => 1,
                        'choices' => array(
                            'grid' => esc_html('Grid', 'ri-fusion'),
                            'carousel' => esc_html('Carousel', 'ri-fusion'),
                        ),
                        'params' => array(
                            'default' => 'grid',
                        ),
                    ),
                    'rit_gallery_hide_info' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Hide Gallery Info', 'ri-fusion'),
                        'description' => esc_html__('Apply for all page Envira Gallery', 'ri-fusion'),
                        'priority' => 2,
                        'params' => array(
                            'default' => '0',
                        ),
                    ),
                )
            ),
        );
        $panel = array(
//            'rit_portfolio_panel' => array(
//                'title' => esc_html__('Portfolio Options', 'ri-fusion'),
//                'description' => '',
//                'priority' => 26,
//            ),
            'color_panel' => array(
                'title' => esc_html__('Custom Color', 'ri-fusion'),
                'description' => '',
                'priority' => 29,
            ),
            'header_options_panel' => array(
                'title' => esc_html__('Header Options', 'ri-fusion'),
                'description' => '',
                'priority' => 22,
            ),
            'rit_font_panel' => array(
                'title' => esc_html__('Fonts Options', 'ri-fusion'),
                'description' => '',
                'priority' => 28,
            ),
        );
        $rit_customize->add_customize($customizers);
        $rit_customize->add_panel($panel);
        $rit_customize->rit_register_theme_customizer();
    }

    add_action('customize_register', 'rit_customize', 11);
}