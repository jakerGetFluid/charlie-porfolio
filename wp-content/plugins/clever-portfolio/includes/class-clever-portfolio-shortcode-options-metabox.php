<?php

/**
 * Clever_Portfolio_Shortcode_Options_Metabox
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Shortcode_Options_Metabox
{
    /**
     * Meta key
     *
     * @var    string
     */
    const META_KEY = '_Clever_Portfolio_shortcode_options_metabox';

    /**
     * Settings
     *
     * @see    Clever_Portfolio::$settings
     *
     * @var    array
     */
    private $settings;

    /**
     * Meta fields
     *
     * @var    array
     */
    private $fields;

    /**
     * Meta values
     *
     * @var    array
     */
    private $values;

    /**
     * Constructor
     */
    function __construct(array $settings)
    {
        $this->settings = $settings;

        $this->fields = array(
            'cat' => array(),
            'post_in' => array(),
            'number' => 8,
            'order_by' => 'date',
            'order' => 'DESC',
            'show_filter' => '1',
            'filter_align' => 'left',
            'space_width' => 10,
            'style' => 'default',
            'layout' => 'grid',
            'layout_mode' => 'fitRows',
            'columns' => 3,
            'columns_tablet' => 1,
            'columns_mobile' => 1,
            'rows' => 1,
            'carousel_size' => 'auto',
            'carousel_height' => '768',
            'show_cpag' => '0',
            'show_cnav' => '0',
            'autoplay' => '0',
            'img_size' => 'medium',
            'show_cat' => '0',
            'view_more' => '0',
            'view_more_text' => esc_html__('View more', 'clever-portfolio'),
            'pagination' => 'standard',
        );

        $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;

        $this->values = get_post_meta($post_id, self::META_KEY, true);
    }

    /**
     * Add metabox
     */
    function add($post)
    {
        add_meta_box(
            'clever-portfolio-options-metabox',
            __('Shortcode Options', 'clever-portfolio'),
            array($this, 'callback'),
            'portfolio-shortcode',
            'normal',
            'high'
        );
    }

    /**
     * Callback
     */
    function callback()
    {
        // Enqueue assets
        wp_enqueue_style('clever-portfolio-options-metabox');
        wp_enqueue_script('clever-portfolio-options-metabox');

        ?>
        <!-- Start nav tabs  -->
        <ul class="tabs nav-tab-wrapper wp-clearfix">
            <li class="nav-tab tab-active" data-tab-id="#general-options">
                <?php _e('General', 'clever-portfolio') ?>
            </li>
            <li class="nav-tab" data-tab-id="#layout-options">
                <?php _e('Layout', 'clever-portfolio') ?>
            </li>
        </ul>
        <!-- End nav tabs  -->

        <!-- Start general options -->
        <table id="general-options" class="meta-table" style="width:100%">
            <tr>
                <td class="text-align-top">
                    <label><?php _e('Categories', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <select name="<?php echo $this->get_field('cat') ?>[]" multiple>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'portfolio_category',
                            'hide_empty' => true
                        ));
                        $categories = array_values($categories);
                        $categories_tree = array();

                        clever_categories_tree(0, $categories, 0, $categories_tree);
                        $selected_categories = $this->get_value('cat');
                        foreach ($categories_tree as $category) {
                            echo '<option value="' . $category['slug'] . '"' . $this->multi_selected($category['slug'], $selected_categories) . '>' . $category['name'] . '</option>';
                        }
                        ?>
                    </select>
                    <p class="description">
                        <?php _e('You can choose multiple categories.', 'clever-portfolio') ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-align-top">
                    <label><?php _e('Portfolios', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <select name="<?php echo $this->get_field('post_in') ?>[]" multiple>
                        <?php
                        $query = new \WP_Query(array(
                            'post_type' => 'portfolio',
                            'posts_per_page' => -1,
                            'suppress_filters' => true,
                            'no_found_rows' => true
                        ));
                        $selected_portfolios = $this->get_value('post_in');
                        if ($query->posts) {
                            foreach ($query->posts as &$portfolio) {
                                echo '<option value="' . $portfolio->ID . '"' . $this->multi_selected($portfolio->ID, $selected_portfolios) . '>' . $portfolio->post_title . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <p class="description">
                        <?php _e('You can choose multiple portfolios as well.', 'clever-portfolio') ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-align-top">
                    <label for="video-layout"><?php _e('Order', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <select name="<?php echo $this->get_field('order') ?>">
                        <option value="ASC" <?php selected($this->get_value('order'), 'ASC') ?>>
                            <?php _e('Ascending', 'clever-portfolio') ?>
                        </option>
                        <option value="DESC" <?php selected($this->get_value('order'), 'DESC') ?>>
                            <?php _e('Descending', 'clever-portfolio') ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="text-align-top">
                    <label for="video-layout"><?php _e('Order by', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <select name="<?php echo $this->get_field('order_by') ?>">
                        <option value="id" <?php selected($this->get_value('order_by'), 'id') ?>>
                            <?php _e('ID', 'clever-portfolio') ?>
                        </option>
                        <option value="date" <?php selected($this->get_value('order_by'), 'date') ?>>
                            <?php _e('Date', 'clever-portfolio') ?>
                        </option>
                        <option value="title" <?php selected($this->get_value('order_by'), 'title') ?>>
                            <?php _e('Title', 'clever-portfolio') ?>
                        </option>
                        <option value="featured" <?php selected($this->get_value('order_by'), 'featured') ?>>
                            <?php _e('Featured', 'clever-portfolio') ?>
                        </option>
                        <option value="comment_count" <?php selected($this->get_value('order_by'), 'comment_count') ?>>
                            <?php _e('Comment count', 'clever-portfolio') ?>
                        </option>
                        <option value="random" <?php selected($this->get_value('order_by'), 'random') ?>>
                            <?php _e('Random', 'clever-portfolio') ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="text-align-top">
                    <label><?php _e('Number of Portfolios', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('number') ?>"
                           value="<?php echo $this->get_value('number') ?>">
                </td>
            </tr>
            <tr>
                <td class="text-align-top">
                    <label for="video-layout"><?php _e('Paging Type', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <select name="<?php echo $this->get_field('pagination') ?>">
                        <option value="standard" <?php selected($this->get_value('pagination'), 'standard') ?>>
                            <?php _e('Standard', 'clever-portfolio') ?>
                        </option>
                        <option value="infinite" <?php selected($this->get_value('pagination'), 'infinite') ?>>
                            <?php _e('Infinite Scroll', 'clever-portfolio') ?>
                        </option>
                        <option value="loadmore" <?php selected($this->get_value('pagination'), 'loadmore') ?>>
                            <?php _e('Load More Button', 'clever-portfolio') ?>
                        </option>
                        <option value="none" <?php selected($this->get_value('pagination'), 'none') ?>>
                            <?php _e('None', 'clever-portfolio') ?>
                        </option>
                    </select>
                </td>
            </tr>
        </table>
        <!-- End general options -->

        <!-- Start extra options -->
        <table id="layout-options" class="meta-table" style="display:none;width:100%">
            <tr ID="shortcode-layout">
                <td class="text-align-top"><label><?php _e('Layout', 'clever-portfolio') ?></label></td>
                <td class="clever-img-selector">
                    <?php $layout = $this->get_value('layout') ?>
                    <img class="select-img<?php if ($layout === 'grid') echo ' selected-img' ?>" data-layout="grid"
                         src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/grid.png' ?>"
                         alt="masonry">
                    <img class="select-img<?php if ($layout === 'masonry') echo ' selected-img' ?>"
                         data-layout="masonry"
                         src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/masonry.png' ?>"
                         alt="masonry">
                    <img class="select-img<?php if ($layout === 'metro') echo ' selected-img' ?>" data-layout="metro"
                         src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/metro.png' ?>" alt="metro">
                    <input id="single-portfolio-layout" type="hidden" name="<?php echo $this->get_field('layout') ?>"
                           value="<?php echo $layout ?>">
                    <img class="select-img<?php if ($layout === 'carousel') echo ' selected-img' ?>"
                         data-layout="carousel"
                         src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/carousel.png' ?>"
                         alt="carousel">
                </td>
            </tr>
            <tr class="carousel-layout-required">
                <td class="text-align-top"><label><?php _e('Carousel Size', 'clever-portfolio') ?></label></td>
                <td class="clever-img-selector">
                    <?php
                    $carousel_size = $this->get_value('carousel_size') != '' ? $this->get_value('carousel_size') : 'auto'; ?>
                    <select name="<?php echo $this->get_field('carousel_size') ?>">
                        <option value="full-screen" <?php selected($carousel_size, 'full-screen') ?>>
                            <?php _e('Full Screen', 'clever-portfolio') ?>
                        </option>
                        <option value="auto" <?php selected($carousel_size, 'auto') ?>>
                            <?php _e('Auto (Follow image height)', 'clever-portfolio') ?>
                        </option>
                        <option value="custom" <?php selected($carousel_size, 'custom') ?>>
                            <?php _e('Custom', 'clever-portfolio') ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr class="carousel-layout-required carousel-auto">
                <td class="text-align-top"><label><?php _e('Carousel Height', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('carousel_height') ?>"
                           value="<?php echo $this->get_value('carousel_height') ?>">
                </td>
            </tr>
            <tr id="layout-mode"<?php if ('masonry' !== $layout) echo ' style="display:none"' ?>>
                <td class="text-align-top">
                    <label><?php _e('Layout Mode', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <?php $layout_mode = $this->get_value('layout_mode') ?>
                    <select name="<?php echo $this->get_field('layout_mode') ?>">
                        <option value="horiz" <?php selected($layout_mode, 'horiz') ?>>
                            <?php _e('Horiz', 'clever-portfolio') ?>
                        </option>
                        <option value="masonry" <?php selected($layout_mode, 'masonry') ?>>
                            <?php _e('Masonry', 'clever-portfolio') ?>
                        </option>
                        <option value="packery" <?php selected($layout_mode, 'packery') ?>>
                            <?php _e('Packery', 'clever-portfolio') ?>
                        </option>
                        <option value="vertical" <?php selected($layout_mode, 'vertical') ?>>
                            <?php _e('Vertical', 'clever-portfolio') ?>
                        </option>
                        <option value="fitRows" <?php selected($layout_mode, 'fitRows') ?>>
                            <?php _e('Fit Rows', 'clever-portfolio') ?>
                        </option>
                        <option value="fitColumns" <?php selected($layout_mode, 'fitColumns') ?>>
                            <?php _e('Fit Columns', 'clever-portfolio') ?>
                        </option>
                        <option value="cellsByRow" <?php selected($layout_mode, 'cellsByRow') ?>>
                            <?php _e('Cells By Row ', 'clever-portfolio') ?>
                        </option>
                        <option value="cellsByColumn" <?php selected($layout_mode, 'cellsByColumn') ?>>
                            <?php _e('Cell By Columns', 'clever-portfolio') ?>
                        </option>
                        <option value="masonryHorizontal" <?php selected($layout_mode, 'masonryHorizontal') ?>>
                            <?php _e('Horizontal Masonry', 'clever-portfolio') ?>
                        </option>
                    </select>
                    <p class="description">
                        <?php printf(__('The %s in which portfolios will be displayed.', 'clever-portfolio'), '<a href="http://isotope.metafizzy.co/layout-modes.html">' . __('layout mode', 'clever-portfolio') . '</a>') ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-align-top"><label><?php _e('Image Size', 'clever-portfolio') ?></label></td>
                <td>
                    <select name="<?php echo $this->get_field('img_size') ?>">
                        <?php
                        global $_wp_additional_image_sizes;

                        $available_sizes = get_intermediate_image_sizes();

                        foreach ($available_sizes as &$size) :
                            if (in_array($size, array('thumbnail', 'medium', 'medium_large', 'large'))) : ?>
                                <option
                                        value="<?php echo $size ?>" <?php selected($this->get_value('img_size'), $size) ?>>
                                    <?php echo ucwords(str_replace(array('_', '-'), array(' ', ' '), $size)) . ' (' . get_option("{$size}_size_w") . 'x' . get_option("{$size}_size_h") . ')' ?>
                                </option>
                            <?php elseif (isset($_wp_additional_image_sizes[$size])) : ?>
                            <option value="<?php echo $size ?>" <?php selected($this->get_value('img_size'), $size) ?>>
                                <?php echo ucwords(str_replace(array('_', '-'), array(' ', ' '), $size)) . ' (' . $_wp_additional_image_sizes[$size]['width'] . 'x' . $_wp_additional_image_sizes[$size]['height'] . ')' ?>
                                </option><?php
                            endif;
                        endforeach;
                        ?>
                        <option value="full" <?php selected($this->get_value('img_size'), 'full') ?>>
                            <?php echo esc_html__('Original size'); ?>
                        </option>
                    </select>
                    <p class="description">
                        <?php _e('Thumbnail size of the portfolios displayed on archive page.', 'clever-portfolio') ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-align-top"><label><?php _e('Columns', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('columns') ?>"
                           value="<?php echo $this->get_value('columns') ?>">
                </td>
            </tr>
            <tr class="carousel-layout-required">
                <td class="text-align-top"><label><?php _e('Columns tablet', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('columns_tablet') ?>"
                           value="<?php echo $this->get_value('columns_tablet') ?>">
                    <p class="description">
                        <?php esc_html_e('Number columns carousel on tablet layout from screen size  481px to 768px.', 'clever-portfolio') ?>
                    </p>
                </td>
            </tr>
            <tr class="carousel-layout-required">
                <td class="text-align-top"><label><?php _e('Columns mobile', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('columns_mobile') ?>"
                           value="<?php echo $this->get_value('columns_mobile') ?>">
                    <p class="description">
                        <?php esc_html_e('Number columns carousel on mobile layout from screen size under 480px.', 'clever-portfolio') ?>
                    </p>
                </td>
            </tr>
            <tr class="carousel-layout-required">
                <td class="text-align-top"><label><?php _e('Rows', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('rows') ?>"
                           value="<?php echo $this->get_value('rows') ?>">
                </td>
            </tr>
            <tr class="carousel-layout-required">
                <td class="text-align-top"><label><?php _e('Show Carousel Pagination', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <input id="show_cpag" type="checkbox" name="<?php echo $this->get_field('show_cpag') ?>"
                           value="1"<?php checked($this->get_value('show_cpag')) ?>>
                </td>
            </tr>
            <tr class="carousel-layout-required">
                <td class="text-align-top"><label><?php _e('Show Carousel Navigation', 'clever-portfolio') ?></label>
                </td>
                <td>
                    <input id="show_cnav" type="checkbox" name="<?php echo $this->get_field('show_cnav') ?>"
                           value="1"<?php checked($this->get_value('show_cnav')) ?>>
                </td>
            </tr>
            <tr class="carousel-layout-required">
                <td class="text-align-top"><label><?php _e('Auto play time', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('autoplay') ?>"
                           value="<?php echo $this->get_value('autoplay') ?>">
                    <p><?php
                        esc_html_e('Time for next carousel item(ms). Leave it blank, or 0 if want disable auto play', 'clever-portfolio');
                        ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-align-top">
                    <label><?php _e('Gutter', 'clever-portfolio') ?> (px)</label>
                </td>
                <td>
                    <input type="number" name="<?php echo $this->get_field('space_width') ?>"
                           value="<?php echo $this->get_value('space_width') ?>">
                </td>
            </tr>
            <tr>
                <td class="text-align-top"><label><?php _e('Hover Effect', 'clever-portfolio') ?></label></td>
                <td class="clever-img-selector">
                    <?php $style = $this->get_value('style');?>
                    <img class="select-style-img<?php if ($style === 'default') echo ' selected-img' ?>"
                         data-style="default"
                         src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/default.png' ?>"
                         alt="style-3" width="130" height="70">
                    <img class="select-style-img<?php if ($style === 'style-1') echo ' selected-img' ?>"
                         data-style="style-1"
                         src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/style-1.png' ?>"
                         alt="style-1" width="130" height="70">
                    <img class="select-style-img<?php if ($style === 'style-2') echo ' selected-img' ?>"
                         data-style="style-2"
                         src="<?php echo $this->settings['baseuri'] . 'assets/images/layouts/style-2.png' ?>"
                         alt="style-2" width="130" height="70">
                    <input id="single-portfolio-style" type="hidden" name="<?php echo $this->get_field('style') ?>"
                           value="<?php echo $style ?>">
                </td>
            </tr>
            <tr>
                <td class="text-align-top"><label><?php _e('Show Filter', 'clever-portfolio') ?></label></td>
                <td>
                    <input id="show_filter" type="checkbox" name="<?php echo $this->get_field('show_filter') ?>"
                           value="1"<?php checked($this->get_value('show_filter')) ?>>
                </td>
            </tr>
            <tr>
                <td class="text-align-top"><label><?php _e('Filter Align', 'clever-portfolio') ?></label></td>
                <td>
                    <?php $filter_align = $this->get_value('filter_align') ?>
                    <select name="<?php echo $this->get_field('filter_align') ?>">
                        <option value="left" <?php selected($filter_align, 'left') ?>>
                            <?php _e('Left', 'clever-portfolio') ?>
                        </option>
                        <option value="right" <?php selected($filter_align, 'right') ?>>
                            <?php _e('Right', 'clever-portfolio') ?>
                        </option>
                        <option value="center" <?php selected($filter_align, 'center') ?>>
                            <?php _e('Center', 'clever-portfolio') ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="text-align-top"><label><?php _e('Show Categories', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="checkbox" name="<?php echo $this->get_field('show_cat') ?>"
                           value="1"<?php checked($this->get_value('show_cat')) ?>>
                </td>
            </tr>
            <tr>
                <td class="text-align-top"><label><?php _e('Show Read More Button', 'clever-portfolio') ?></label></td>
                <td>
                    <input id="show-read-more-button" type="checkbox" name="<?php echo $this->get_field('view_more') ?>"
                           value="1"<?php checked($this->get_value('view_more')) ?>>
                </td>
            </tr>
            <tr id="read-more-button-text-field">
                <td class="text-align-top"><label><?php _e('Read More Button Text', 'clever-portfolio') ?></label></td>
                <td>
                    <input type="text" name="<?php echo $this->get_field('view_more_text') ?>"
                           value="<?php echo $this->get_value('view_more_text') ?>">
                </td>
            </tr>
        </table>
        <!-- End extra options -->
        <?php
    }
    /**
     * Sanitize metadata
     */
    private function sanitize($meta)
    {
        return $meta;
    }

    /**
     * Save metadata
     *
     * @param    int $post_id ID of current portfolio-shortcode.
     */
    function save($post_id)
    {
        if (defined('DOING_AJAX') && DOING_AJAX) return;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if (!current_user_can('edit_post', $post_id) || wp_is_post_revision($post_id)) return;

        $metadata = isset($_POST[self::META_KEY]) ? $this->sanitize($_POST[self::META_KEY]) : array();

        update_post_meta($post_id, self::META_KEY, $metadata, $this->values);
    }

    /**
     * Multi selected
     *
     * @param    string $name
     * @param    array $values
     *
     * @return    string    $attr    Selected attribute.
     */
    private function multi_selected($name, $values)
    {
        $values = (array)$values;

        $attr = in_array($name, $values) ? ' selected' : '';

        return $attr;
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
        $field = self::META_KEY . '[' . $name . ']';

        return $field;
    }

    /**
     * Get field value
     *
     * @param    string $name Field name.
     *
     * @return    mixed    $value    Field's value.
     */
    private function get_value($name)
    {
        $value = isset($this->values[$name]) ? $this->values[$name] : $this->fields[$name];

        return $value;
    }
}
