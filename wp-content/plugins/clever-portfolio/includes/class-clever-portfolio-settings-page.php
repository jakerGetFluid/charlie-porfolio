<?php

/**
 * Clever_Portfolio_Settings_Page
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Settings_Page
{
    /**
     * Option group
     *
     * @var    string
     */
    const OPTION_GROUP = 'Clever_Portfolio_settings_page_group';

    /**
     * Hook suffix
     *
     * @var    string
     *
     * @see    https://developer.wordpress.org/reference/functions/add_submenu_page/
     */
    public $hook_suffix;

    /**
     * Settings
     *
     * @see    Clever_Portfolio::$settings
     *
     * @var    array
     */
    private $settings;

    /**
     * Constructor
     */
    function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Add the settings page
     */
    function add()
    {
        $this->hook_suffix = add_submenu_page(
            'edit.php?post_type=portfolio',
            __('Settings', 'clever-portfolio'),
            __('Settings', 'clever-portfolio'),
            'manage_options',
            basename(__FILE__),
            array($this, 'callback')
        );
    }

    /**
     * Callback
     */
    function callback()
    {
        // Enqueue assets.
        wp_enqueue_media();
        wp_enqueue_script('clever-portfolio-settings-page');

        // Render.
        ?>
        <div class="wrap clever-portfolio-settings">
        <h1><?php esc_html_e('Portfolio Settings', 'clever-portfolio') ?></h1>
        <div class="ri-wrap-portfolio-settings">
            <!-- Start nav tabs  -->
            <ul class="tabs nav-tab-wrapper wp-clearfix">
                <li class="nav-tab tab-active" data-tab-id="#clever-portfolio-general-settings">
                    <?php esc_html_e('General', 'clever-portfolio') ?>
                </li>
                <li class="nav-tab" data-tab-id="#clever-portfolio-archive-settings">
                    <?php esc_html_e('Archive Portfolios', 'clever-portfolio') ?>
                </li>
                <li class="nav-tab" data-tab-id="#clever-portfolio-single-settings">
                    <?php esc_html_e('Single Portfolio', 'clever-portfolio') ?>
                </li>
            </ul>
            <!-- End nav tabs  -->

            <form class="form-table" method="post" action="options.php">
                <?php settings_fields(self::OPTION_GROUP) ?>

                <!-- Start General Settings Tab  -->
                <div id="clever-portfolio-general-settings" class="settings-tab">
                    <table>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Post Type Slug', 'clever-portfolio') ?></label></td>
                            <td>
                                <input type="text" name="<?php echo $this->get_field('post_type_slug') ?>"
                                       value="<?php echo $this->get_value('post_type_slug') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('The slug in the single portfolio permalink.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Post Type Archive Slug', 'clever-portfolio') ?></label></td>
                            <td>
                                <input type="text" name="<?php echo $this->get_field('post_type_archive_slug') ?>"
                                       value="<?php echo $this->get_value('post_type_archive_slug') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('The slug in the permalink of the portfolio post type archive page.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Category Slug', 'clever-portfolio') ?></label></td>
                            <td>
                                <input type="text" name="<?php echo $this->get_field('portfolio_category_slug') ?>"
                                       value="<?php echo $this->get_value('portfolio_category_slug') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('The slug in the portfolio archive page permalink.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Archive Page Title', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="text" name="<?php echo $this->get_field('archive_page_title') ?>"
                                       value="<?php echo $this->get_value('archive_page_title') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('The title for all portfolio archive pages.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- End General Settings Tab  -->

                <!-- Start Single Portfolio Tab  -->
                <div id="clever-portfolio-single-settings" class="settings-tab" style="display:none">
                    <table>
                        <tr class="video-meta-field">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Single Embed (Video/Audio) Layout', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select name="<?php echo $this->get_field('single_embed_layout') ?>">
                                        <option
                                            value="standard" <?php selected($this->get_value('single_embed_layout'), 'standard') ?>>
                                            <?php esc_html_e('Standard', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="full-width" <?php selected($this->get_value('single_embed_layout'), 'full-width') ?>>
                                            <?php esc_html_e('Full Width', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="full-screen" <?php selected($this->get_value('single_embed_layout'), 'full-screen') ?>>
                                            <?php esc_html_e('Full Screen (Background Video)', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="right-sidebar" <?php selected($this->get_value('single_embed_layout'), 'right-sidebar') ?>>
                                            <?php esc_html_e('Right Sidebar', 'clever-portfolio') ?>
                                        </option>
                                    </select>
                                </label>
                                <p class="ri-field-des"><?php esc_html_e('The layout displayed as default for all single video/audio portfolio.', 'clever-portfolio') ?></p>
                            </td>
                        </tr>
                        <tr class="gallery-meta-field">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Single Gallery Layout', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select id="clever-single-gallery-layout"
                                            name="<?php echo $this->get_field('single_gallery_layout') ?>">
                                        <option
                                            value="list" <?php selected($this->get_value('single_gallery_layout'), 'list') ?>>
                                            <?php esc_html_e('List', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="slider" <?php selected($this->get_value('single_gallery_layout'), 'slider') ?>>
                                            <?php esc_html_e('Slider', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="metro" <?php selected($this->get_value('single_gallery_layout'), 'metro') ?>>
                                            <?php _e('Metro', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="left-sidebar" <?php selected($this->get_value('single_gallery_layout'), 'left-sidebar') ?>>
                                            <?php esc_html_e('Left Sidebar', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="right-sidebar" <?php selected($this->get_value('single_gallery_layout'), 'right-sidebar') ?>>
                                            <?php esc_html_e('Right Sidebar', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="full-screen" <?php selected($this->get_value('single_gallery_layout'), 'full-screen') ?>>
                                            <?php esc_html_e('Full Screen Slider', 'clever-portfolio') ?>
                                        </option>
                                    </select>
                                </label>
                                <p class="ri-field-des"><?php esc_html_e('The layout displayed as default for all single gallery portfolio.', 'clever-portfolio') ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Enable lightbox', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="checkbox" name="<?php echo $this->get_field('single_enable_lightbox') ?>"
                                       value="1"<?php checked($this->get_value('single_enable_lightbox')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('Whether to use light box for each portfolio or not.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Wrap Metro width', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="number" name="<?php echo $this->get_field('single_metro_width') ?>"
                                       value="<?php echo($this->get_value('single_metro_width')) ?>">
                                <p class="ri-field-des"><?php esc_html_e('Width of Metro layout. It\'s help calculate columns for create layout Metro.', 'clever-portfolio') ?></p>
                            </td>
                        </tr>
                        <tr id="clever-single-gallery-thumb">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Enable thumbnail', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input id="clever-portfolio-single-enable-thumb" type="checkbox"
                                       name="<?php echo $this->get_field('single_enable_thumb') ?>"
                                       value="1"<?php checked($this->get_value('single_enable_thumb')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('If check, list thumbnail will show. Work width Layout Gallery Slider.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Extra Information', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input id="clever-portfolio-single-enable-extra-info" type="checkbox"
                                       name="<?php echo $this->get_field('single_enable_extra_info') ?>"
                                       value="1"<?php checked($this->get_value('single_enable_extra_info')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('Whether to use extra information tab on each portfolio or not.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr class="clever-portfolio-extra-info-field">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Enable Share', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input id="clever-portfolio-single-enable-share" type="checkbox"
                                       name="<?php echo $this->get_field('single_enable_share') ?>"
                                       value="1"<?php checked($this->get_value('single_enable_share')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('If check, feature share will availability.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr class="clever-portfolio-extra-info-field">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Available Extra Fields', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <table id="clever-portfolio-available-extra-fields">
                                    <?php
                                    $fields = $this->get_value('single_extra_info');
                                    if ($fields) :
                                        ?><p
                                        class="ri-field-des"><?php esc_html_e('These fields used as extra meta fields on the portfolio options metabox.', 'clever-portfolio') ?></p><?php
                                        foreach ($fields as $key => &$field) :
                                            ?>
                                            <tr>
                                            <td>
                                                <input type="text"
                                                       name="<?php echo $this->get_field('single_extra_info') . '[' . $key . '][label]' ?>"
                                                       value="<?php echo $field['label'] ?>">
                                                <label class="ri-wrap-select">
                                                    <select
                                                        name="<?php echo $this->get_field('single_extra_info') . '[' . $key . '][type]' ?>">
                                                        <option
                                                            value="text" <?php selected($field['type'], 'text') ?>><?php esc_html_e('Text', 'clever-portfolio') ?></option>
                                                        <option
                                                            value="link" <?php selected($field['type'], 'link') ?>><?php esc_html_e('Link', 'clever-portfolio') ?></option>
                                                        <option
                                                            value="email" <?php selected($field['type'], 'email') ?>><?php esc_html_e('Email', 'clever-portfolio') ?></option>
                                                        <option
                                                            value="number" <?php selected($field['type'], 'number') ?>><?php esc_html_e('Number', 'clever-portfolio') ?></option>
                                                        <option
                                                            value="textarea" <?php selected($field['type'], 'textarea') ?>><?php esc_html_e('Textarea', 'clever-portfolio') ?></option>
                                                        <option
                                                            value="datetime" <?php selected($field['type'], 'datetime') ?>><?php esc_html_e('Datetime', 'clever-portfolio') ?></option>
                                                    </select>
                                                </label>
                                                <button
                                                    class="button button-secondary clever-portfolio-remove-extra-field-btn"
                                                    type="button">
                                                    <?php esc_html_e('Remove', 'clever-portfolio') ?>
                                                </button>
                                            </td>
                                            </tr><?php
                                        endforeach;
                                    else :
                                        ?><p  class="ri-field-des"><?php esc_html_e('No extra fields are available to use.', 'clever-portfolio') ?></p><?php
                                    endif;
                                    ?>
                                </table>
                                <button id="clever-portfolio-add-extra-field-btn" class="button primary-button"
                                        type="button">
                                    + <?php esc_html_e('Add field', 'clever-portfolio') ?>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- End Single Portfolio Tab  -->

                <!-- Start Archive Portfolio Tab  -->
                <div id="clever-portfolio-archive-settings" class="settings-tab clever-portfolio-archive-settings"
                     style="display:none">
                    <table class="settings-table">
                        <caption
                            class="margin-none"><?php esc_html_e('Generic Settings', 'clever-portfolio') ?></caption>
                        <tr>
                            <td class="text-align-top"><label><?php esc_html_e('Order', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select name="<?php echo $this->get_field('archive_order') ?>">
                                        <option value="asc" <?php selected($this->get_value('archive_order'), 'asc') ?>>
                                            <?php esc_html_e('Ascending', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="desc" <?php selected($this->get_value('archive_order'), 'desc') ?>>
                                            <?php esc_html_e('Descending', 'clever-portfolio') ?>
                                        </option>
                                    </select>
                                </label>
                                <p class="ri-field-des">
                                    <?php esc_html_e('The order in which portfolios will be displayed.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top"><label><?php _e('Order By', 'clever-portfolio') ?></label></td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select name="<?php echo $this->get_field('archive_order_by') ?>">
                                        <option
                                            value="date" <?php selected($this->get_value('archive_order_by'), 'date') ?>>
                                            <?php esc_html_e('Date', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="title" <?php selected($this->get_value('archive_order_by'), 'title') ?>>
                                            <?php esc_html_e('Title', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="comment" <?php selected($this->get_value('archive_order_by'), 'comment') ?>>
                                            <?php esc_html_e('Comment count', 'clever-portfolio') ?>
                                        </option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Display Layout', 'clever-portfolio') ?></label></td>
                            <td>
                                <img
                                    class="select-img<?php if ($this->get_value('archive_layout') === 'list') echo ' selected-img' ?>"
                                    data-layout="list"
                                    src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/list.png' ?>"
                                    alt="list">
                                <img
                                    class="select-img<?php if ($this->get_value('archive_layout') === 'grid') echo ' selected-img' ?>"
                                    data-layout="grid"
                                    src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/grid.png' ?>"
                                    alt="grid">
                                <img
                                    class="select-img<?php if ($this->get_value('archive_layout') === 'masonry') echo ' selected-img' ?>"
                                    data-layout="masonry"
                                    src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/masonry.png' ?>"
                                    alt="masonry">
                                <img
                                    class="select-img<?php if ($this->get_value('archive_layout') === 'metro') echo ' selected-img' ?>"
                                    data-layout="metro"
                                    src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/metro.png' ?>"
                                    alt="metro">
                                <!--                                <img-->
                                <!--                                    class="select-img-->
                                <?php //if ($this->get_value('archive_layout') === 'carousel') echo ' selected-img'
                                ?><!--"-->
                                <!--                                    data-layout="carousel"-->
                                <!--                                    src="-->
                                <?php //echo $this->settings['baseuri'] . 'assets/images/layouts/carousel.png'
                                ?><!--"-->
                                <!--                                    alt="carousel">-->
                                <input id="archive-portfolio-layout" type="hidden"
                                       name="<?php echo $this->get_field('archive_layout') ?>"
                                       value="<?php echo $this->get_value('archive_layout') ?>">
                            </td>
                        </tr>
                        <tr id="archive-layout-mode"<?php if ('masonry' !== $this->settings['archive_layout']) echo ' style="display:none"' ?>>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Layout Mode', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select name="<?php echo $this->get_field('archive_layout_mode') ?>">
                                        <option
                                            value="horiz" <?php selected($this->get_value('archive_layout_mode'), 'horiz') ?>>
                                            <?php esc_html_e('Horiz', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="masonry" <?php selected($this->get_value('archive_layout_mode'), 'masonry') ?>>
                                            <?php esc_html_e('Masonry', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="packery" <?php selected($this->get_value('archive_layout_mode'), 'packery') ?>>
                                            <?php esc_html_e('Packery', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="vertical" <?php selected($this->get_value('archive_layout_mode'), 'vertical') ?>>
                                            <?php esc_html_e('Vertical', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="fitRows" <?php selected($this->get_value('archive_layout_mode'), 'fitRows') ?>>
                                            <?php esc_html_e('Fit Rows', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="fitColumns" <?php selected($this->get_value('archive_layout_mode'), 'fitColumns') ?>>
                                            <?php esc_html_e('Fit Columns', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="cellsByRow" <?php selected($this->get_value('archive_layout_mode'), 'cellsByRow') ?>>
                                            <?php esc_html_e('Cells By Row ', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="cellsByColumn" <?php selected($this->get_value('archive_layout_mode'), 'cellsByColumn') ?>>
                                            <?php esc_html_e('Cell By Columns', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="masonryHorizontal" <?php selected($this->get_value('archive_layout_mode'), 'masonryHorizontal') ?>>
                                            <?php esc_html_e('Horizontal Masonry', 'clever-portfolio') ?>
                                        </option>
                                    </select>
                                </label>
                                <p class="ri-field-des">
                                    <?php printf(esc_html__('The %s in which portfolios will be displayed.', 'clever-portfolio'), '<a href="http://isotope.metafizzy.co/layout-modes.html">' . __('layout mode', 'clever-portfolio') . '</a>') ?>
                                </p>
                            </td>
                        </tr>
                        <tr id="archive-style">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Style', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select name="<?php echo $this->get_field('archive_style') ?>">
                                        <option
                                            value="default" <?php selected($this->get_value('archive_style'), 'default') ?>>
                                            <?php esc_html_e('Default', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="style-1" <?php selected($this->get_value('archive_style'), 'style-1') ?>>
                                            <?php esc_html_e('Style 1', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="style-2" <?php selected($this->get_value('archive_style'), 'style-2') ?>>
                                            <?php esc_html_e('Style 2', 'clever-portfolio') ?>
                                        </option>
                                    </select>
                                </label>
                                <p class="ri-field-des">
                                    <?php esc_html_e('Style of Portfolio archive', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top"><label><?php esc_html_e('Columns', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="number" name="<?php echo $this->get_field('archive_columns_per_page') ?>"
                                       value="<?php echo $this->get_value('archive_columns_per_page') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('The number of columns displayed on an row.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Thumbnail Size', 'clever-portfolio') ?></label></td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select name="<?php echo $this->get_field('archive_thumbnail_size') ?>">
                                        <?php
                                        global $_wp_additional_image_sizes;

                                        $available_sizes = get_intermediate_image_sizes();

                                        foreach ($available_sizes as &$size) :
                                            if (in_array($size, array('thumbnail', 'medium', 'medium_large', 'large'))) : ?>
                                                <option
                                                    value="<?php echo $size ?>" <?php selected($this->get_value('archive_thumbnail_size'), $size) ?>>
                                                    <?php echo ucwords(str_replace(array('_', '-'), array(' ', ' '), $size)) . ' (' . get_option("{$size}_size_w") . 'x' . get_option("{$size}_size_h") . ')' ?>
                                                </option>
                                            <?php elseif (isset($_wp_additional_image_sizes[$size])) : ?>
                                            <option
                                                value="<?php echo $size ?>" <?php selected($this->get_value('archive_thumbnail_size'), $size) ?>>
                                                <?php echo ucwords(str_replace(array('_', '-'), array(' ', ' '), $size)) . ' (' . $_wp_additional_image_sizes[$size]['width'] . 'x' . $_wp_additional_image_sizes[$size]['height'] . ')' ?>
                                                </option><?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </label>
                                <p class="ri-field-des">
                                    <?php esc_html_e('Thumbnail size of the portfolios displayed on archive page.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Portfolio Padding', 'clever-portfolio') ?>
                                    (px)</label></td>
                            <td>
                                <input type="number" name="<?php echo $this->get_field('archive_portfolio_gutter') ?>"
                                       value="<?php echo $this->get_value('archive_portfolio_gutter') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('The padding of each portfolio item on the archive page.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Show Description', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="checkbox" name="<?php echo $this->get_field('archive_show_description') ?>"
                                       value="1"<?php checked($this->get_value('archive_show_description')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('Whether to show description for each portfolio or not.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Show Categories', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="checkbox" name="<?php echo $this->get_field('archive_show_cats') ?>"
                                       value="1"<?php checked($this->get_value('archive_show_cats')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('Whether to show categories for each portfolio or not.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Show Date', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="checkbox" name="<?php echo $this->get_field('archive_show_date') ?>"
                                       value="1"<?php checked($this->get_value('archive_show_date')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('Whether to show date publish for each portfolio or not.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Show Button Read More', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input id="clever_btn_readmore" type="checkbox" name="<?php echo $this->get_field('archive_show_btn') ?>"
                                       value="1"<?php checked($this->get_value('archive_show_btn')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('Whether to show button read more for each portfolio or not.', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr id="clever_archive_readmore_text">
                            <td class="text-align-top"><label><?php esc_html_e('Button text', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="text" name="<?php echo $this->get_field('archive_btn_text') ?>"
                                       value="<?php echo $this->get_value('archive_btn_text') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('Text of button read more.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <table class="settings-table">
                        <caption><?php esc_html_e('Pagination Settings', 'clever-portfolio') ?></caption>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Portfolios per Page', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="number" name="<?php echo $this->get_field('archive_posts_per_page') ?>"
                                       value="<?php echo $this->get_value('archive_posts_per_page') ?>">
                                <p class="ri-field-des">
                                    <?php esc_html_e('The number of portfolios displayed on an archive page.', 'clever-portfolio') ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Pagination Type', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <label class="ri-wrap-select">
                                    <select id="paging-type"
                                            name="<?php echo $this->get_field('archive_paging_type') ?>">
                                        <option
                                            value="standard" <?php selected($this->get_value('archive_paging_type'), 'standard') ?>>
                                            <?php esc_html_e('Standard', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="infinite" <?php selected($this->get_value('archive_paging_type'), 'infinite') ?>>
                                            <?php esc_html_e('Infinite Scroll', 'clever-portfolio') ?>
                                        </option>
                                        <option
                                            value="loadmore" <?php selected($this->get_value('archive_paging_type'), 'loadmore') ?>>
                                            <?php esc_html_e('Load More Button', 'clever-portfolio') ?>
                                        </option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr id="archive_paging_icon">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Loading Icon', 'clever-portfolio') ?></label></td>
                            <td>
                                <select id="paging_icon"
                                        name="<?php echo $this->get_field('archive_paging_icon') ?>">
                                    <option
                                        value="standard" <?php selected($this->get_value('archive_paging_icon'), 'standard') ?>>
                                        <?php esc_html_e('Standard', 'clever-portfolio') ?>
                                    </option>
                                    <option
                                        value="circus" <?php selected($this->get_value('archive_paging_icon'), 'infinite') ?>>
                                        <?php esc_html_e('Circus', 'clever-portfolio') ?>
                                    </option>
                                </select>
                                <p class="ri-field-des"><?php esc_html_e('Icon visible when loading.', 'clever-portfolio') ?></p>
                            </td>
                        </tr>
                        <tr id="load-more-button-text">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Load More Button Text', 'clever-portfolio') ?></label></td>
                            <td>
                                <input type="text" name="<?php echo $this->get_field('archive_loadmore_button_text') ?>"
                                       value="<?php echo $this->get_value('archive_loadmore_button_text') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('No More Load Text', 'clever-portfolio') ?></label></td>
                            <td>
                                <input type="text" name="<?php echo $this->get_field('archive_nomore_load_text') ?>"
                                       value="<?php echo $this->get_value('archive_nomore_load_text') ?>">
                            </td>
                        </tr>
                    </table>
                    <table class="settings-table">
                        <caption><?php esc_html_e('Custom Settings', 'clever-portfolio') ?></caption>
                        <tr>
                            <td class="text-align-top">
                                <label><?php esc_html_e('Enable Custom Style', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input id="enable-custom-style" type="checkbox"
                                       name="<?php echo $this->get_field('archive_custom_style') ?>"
                                       value="1"<?php checked($this->get_value('archive_custom_style')) ?>>
                                <span
                                    class="ri-field-des"><?php esc_html_e('If not check, it will use default style of plugin or theme(if theme support).', 'clever-portfolio') ?></span>
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Enable Box Shadow', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input type="checkbox" name="<?php echo $this->get_field('archive_enable_shadow') ?>"
                                       value="1"<?php checked($this->get_value('archive_enable_shadow')) ?>>
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Title Color', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_title_color') ?>"
                                       value="<?php echo $this->get_value('archive_title_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Title Color Hover', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_title_hover') ?>"
                                       value="<?php echo $this->get_value('archive_title_hover') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Category Color', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_cat_text_color') ?>"
                                       value="<?php echo $this->get_value('archive_cat_text_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Category Color Hover', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_cat_color_hover') ?>"
                                       value="<?php echo $this->get_value('archive_cat_color_hover') ?>">
                            </td>
                        </tr>

                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Date Color', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_date_color') ?>"
                                       value="<?php echo $this->get_value('archive_date_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Text Color', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_text_color') ?>"
                                       value="<?php echo $this->get_value('archive_text_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Button Text Color', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_button_text_color') ?>"
                                       value="<?php echo $this->get_value('archive_button_text_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Hover Button Text Color', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_hover_button_text_color') ?>"
                                       value="<?php echo $this->get_value('archive_hover_button_text_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Button Background Color', 'clever-portfolio') ?></label></td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_button_background_color') ?>"
                                       value="<?php echo $this->get_value('archive_button_background_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Hover Button Background Color', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_hover_button_background_color') ?>"
                                       value="<?php echo $this->get_value('archive_hover_button_background_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Background color', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input class="color-picker" type="text"
                                       name="<?php echo $this->get_field('archive_background_color') ?>"
                                       value="<?php echo $this->get_value('archive_background_color') ?>">
                            </td>
                        </tr>
                        <tr class="custom-style-setting">
                            <td class="text-align-top">
                                <label><?php esc_html_e('Background mask', 'clever-portfolio') ?></label>
                            </td>
                            <td>
                                <input class="color-picker" data-alpha="true" type="text"
                                       name="<?php echo $this->get_field('archive_background_mask') ?>"
                                       value="<?php echo $this->get_value('archive_background_mask') ?>">
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- End Archive Portfolio Tab  -->
                <?php submit_button() ?>
            </form>
        </div>
        </div><?php
    }

    /**
     * Register settings
     */
    function init()
    {
        register_setting(
            self::OPTION_GROUP,
            Clever_Portfolio::OPTION_NAME,
            array($this, 'sanitize')
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param    array $input An array of raw settings.
     *
     * @return    array    $input   An array of sanitized settings.
     */
    function sanitize($input)
    {
        if (isset($input['single_extra_info']) && $input['single_extra_info']) {
            $fields = (array)$input['single_extra_info'];
            foreach ($fields as $key => &$field) {
                $label = sanitize_text_field($field['label']);
                $fields[$key] = array('label' => $label, 'type' => $field['type']);
            }
            $input['single_extra_info'] = $fields;
        }

        $input['post_type_slug'] = sanitize_title($input['post_type_slug']);
        $input['portfolio_category_slug'] = sanitize_title($input['portfolio_category_slug']);
        $input['archive_posts_per_page'] = absint($input['archive_posts_per_page']);
        $input['archive_loadmore_button_text'] = sanitize_text_field($input['archive_loadmore_button_text']);
        $input['archive_infinite_scroll_buffer'] = absint($input['archive_infinite_scroll_buffer']);

        return $input;
    }

    /**
     * Do notification
     *
     * @see    https://developer.wordpress.org/reference/hooks/admin_notices/
     */
    function notify()
    {
        if (isset($_GET['page']) && $_GET['page'] === basename(__FILE__)) :
            if (isset($_REQUEST['settings-updated']) && 'true' === $_REQUEST['settings-updated']) :
                ?>
                <div class="updated notice is-dismissible">
                <p><strong>
                        <?php esc_html_e('Settings have been saved successfully!', 'clever-portfolio') ?>
                    </strong></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">
                        <?php esc_html_e('Dismiss this notice.') ?>
                    </span>
                </button>
                </div><?php
            endif;
            if (isset($_REQUEST['error']) && 'true' === $_REQUEST['error']) :
                ?>
                <div class="updated error is-dismissible">
                <p><strong>
                        <?php esc_html_e('Failed to save settings. Please try again!', 'clever-portfolio') ?>
                    </strong></p>
                <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">
                            <?php esc_html_e('Dismiss this notice.') ?>
                        </span>
                </button>
                </div><?php
            endif;
        endif;
    }

    /**
     * Get field ID
     *
     * @param    string $name Field name.
     *
     * @return    string   $field    Field's ID.
     */
    private function get_field($name)
    {
        $field = Clever_Portfolio::OPTION_NAME . '[' . $name . ']';

        return $field;
    }

    /**
     * Get field value
     *
     * @param    string $name Field name.
     * @param    mixed $default Default value.
     *
     * @return    mixed    $value    Field's value.
     */
    private function get_value($name, $default = '')
    {
        $value = isset($this->settings[$name]) ? $this->settings[$name] : $default;

        return $value;
    }
}
