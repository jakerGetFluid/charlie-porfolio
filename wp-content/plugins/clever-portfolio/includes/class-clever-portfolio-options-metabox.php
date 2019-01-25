<?php
/**
 * Clever_Portfolio_Options_Metabox
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Options_Metabox
{
    /**
     * Meta key
     *
     * @var    string
     */
    const META_KEY = '_Clever_Portfolio_options_metabox';

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
    function __construct( array $settings )
    {
        $this->settings = $settings;

        $post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;

        $this->fields = array(
            'short_description' => '',
            'format'            => get_post_meta($post_id, 'rit_portfolio_format', true) ? : 'gallery',
            'galleries'         => get_post_meta($post_id, 'rit_detail_image', false) ? : array(),
            'gallery_layout'    => get_post_meta($post_id, 'rit_detail_portfolio_layout', true) ? : 'inherit',
            'oembed_url'        => get_post_meta($post_id, 'rit_portfolio_embed', true) ? : '',
            'embed_layout'      => get_post_meta($post_id, 'rit_detail_portfolio_embed_layout', true) ? : 'inherit',
            'extra-field-1'     => get_post_meta($post_id, 'rit_client_portfolio', true) ? : 'N/A',
            'extra-field-2'     => get_post_meta($post_id, 'rit_date_complete_portfolio', true) ? : '',
            'columns'     => 3
        );

        $this->values = get_post_meta( $post_id, self::META_KEY, true );

        if (!$this->values) update_post_meta($post_id, self::META_KEY, $this->fields);
    }

    /**
     * Add metabox
     */
    function add( $post )
    {
        add_meta_box(
            'clever-portfolio-options-metabox',
            __( 'Porfolio Options', 'clever-portfolio' ),
            array( $this, 'callback' ),
            'portfolio',
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
        wp_enqueue_media();
        wp_enqueue_style( 'clever-portfolio-options-metabox' );
        wp_enqueue_script( 'clever-portfolio-options-metabox' );

        $post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;
        $extra_status = get_post_meta($post_id, 'rit_portfolio_extend_info_status', true);

        ?>
        <!-- Start nav tabs  -->
        <ul class="tabs nav-tab-wrapper wp-clearfix">
            <li class="nav-tab tab-active" data-tab-id="#default-options">
                <?php _e( 'Default Options', 'clever-portfolio' ) ?>
            </li>
            <?php if ( !empty( $this->settings['single_enable_extra_info'] ) || 'enable' === $extra_status ) : ?>
                <li class="nav-tab" data-tab-id="#extra-options">
                    <?php _e( 'Extra Information', 'clever-portfolio' ) ?>
                </li>
            <?php endif ?>
        </ul>
        <!-- End nav tabs  -->

        <!-- Start default options -->
        <table id="default-options" class="meta-table" style="width:100%">
            <tr>
                <td class="text-align-top">
                    <label for="portfolio-format"><?php _e( 'Format', 'clever-portfolio' ) ?></label>
                </td>
                <td>
                    <select id="portfolio-format" name="<?php echo $this->get_field( 'format' ) ?>">
                        <option value="gallery" <?php selected( $this->get_value( 'format' ), 'gallery' ) ?>>
                            <?php esc_html_e( 'Gallery', 'clever-portfolio' ) ?>
                        </option>
                        <option value="embed" <?php selected( $this->get_value( 'format' ), 'embed' ) ?>>
                            <?php esc_html_e( 'Embed (Video/Audio)', 'clever-portfolio' ) ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr class="video-meta-field">
                <td class="text-align-top">
                    <label for="portfolio-oembed-url">
                        <?php esc_html_e( 'Embed (Video/Audio) URL', 'clever-portfolio' ) ?>
                    </label>
                </td>
                <td>
                    <?php $oembed_url = $this->get_value( 'oembed_url' ) ?>
                    <input id="portfolio-oembed-url" type="url" name="<?php echo $this->get_field( 'oembed_url' ) ?>" value="<?php echo $oembed_url ?>">
                    <button id="oembed-preview-btn" class="button button-secondary" type="button" name="button">
                        <?php esc_html_e( 'Preview', 'clever-portfolio' ) ?>
                    </button>
                    <p id="oembed-preview-container"><?php
                        $oembed = wp_oembed_get( $oembed_url, array( 'width'  => '320', 'height' => '320' ) );
                        if ( false === $oembed && $oembed_url ) {
                            esc_html_e( 'Failed to get embed resource.', 'clever-portfolio' );
                        } else {
                            echo $oembed;
                        }
                    ?></p>
                </td>
            </tr>
            <tr class="video-meta-field">
                <td class="text-align-top">
                    <label for="video-layout"><?php esc_html_e( 'Embed (Video/Audio) Layout', 'clever-portfolio' ) ?></label>
                </td>
                <td>
                    <select name="<?php echo $this->get_field( 'embed_layout' ) ?>">
                        <option value="inherit" <?php selected( $this->get_value( 'embed_layout' ), 'inherit' ) ?>>
                            <?php esc_html_e( 'Inherit', 'clever-portfolio' ) ?>
                        </option>
                        <option value="standard" <?php selected( $this->get_value( 'embed_layout' ), 'standard' ) ?>>
                            <?php esc_html_e( 'Standard', 'clever-portfolio' ) ?>
                        </option>
                        <option value="full-width" <?php selected( $this->get_value( 'embed_layout' ), 'full-width' ) ?>>
                            <?php esc_html_e( 'Full width', 'clever-portfolio' ) ?>
                        </option>
                        <option value="full-screen" <?php selected( $this->get_value( 'embed_layout' ), 'full-screen' ) ?>>
                            <?php esc_html_e( 'Full Screen (Background Video)', 'clever-portfolio' ) ?>
                        </option>
                        <option value="right-sidebar" <?php selected( $this->get_value( 'embed_layout' ), 'right-sidebar' ) ?>>
                            <?php esc_html_e( 'Right Sidebar', 'clever-portfolio' ) ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr class="gallery-meta-field">
                <td class="text-align-top">
                    <label for="galleries"><?php esc_html_e( 'Gallery', 'clever-portfolio' ) ?></label>
                </td>
                <td>
                    <p id="media-container">
                        <?php
                            $galleries = $this->get_value( 'galleries');
                            if ( is_array($galleries) && $galleries ) {
                                foreach ( $galleries as &$gallery ) {
                                    echo wp_get_attachment_image( $gallery, 'thumbnail', false, array( 'class' => 'gallery-thumbnail' ) );
                                }
                            }
                        ?>
                    </p>
                    <button id="add-gallery-btn" class="button button-secondary" type="button" name="button">
                        <?php esc_html_e( 'Add Gallery', 'clever-portfolio' ) ?>
                    </button>
                    <button id="reset-gallery-btn" class="button button-secondary" type="button" name="button">
                        <?php esc_html_e( 'Remove Gallery', 'clever-portfolio' ) ?>
                    </button>
                    <input id="galleries-data" type="hidden" name="<?php echo $this->get_field( 'galleries') ?>" value="<?php echo implode( ',', $galleries ) ?>">
                </td>
            </tr>
            <tr class="gallery-meta-field">
                <td class="text-align-top">
                    <label for="gallery-layout"><?php esc_html_e( 'Gallery Layout', 'clever-portfolio' ) ?></label>
                </td>
                <td>
                    <select id="gallery-layout" name="<?php echo $this->get_field( 'gallery_layout' ) ?>">
                        <option value="inherit" <?php selected( $this->get_value( 'gallery_layout' ), 'inherit' ) ?>>
                            <?php esc_html_e( 'Inherit', 'clever-portfolio' ) ?>
                        </option>
                        <option value="list" <?php selected( $this->get_value( 'gallery_layout' ), 'list' ) ?>>
                            <?php esc_html_e( 'List', 'clever-portfolio' ) ?>
                        </option>
                        <option value="slider" <?php selected( $this->get_value( 'gallery_layout' ), 'slider' ) ?>>
                            <?php esc_html_e( 'Slider', 'clever-portfolio' ) ?>
                        </option>
                        <option value="metro" <?php selected( $this->get_value( 'gallery_layout' ), 'metro' ) ?>>
                            <?php esc_html_e( 'Metro', 'clever-portfolio' ) ?>
                        </option>
                        <option value="left-sidebar" <?php selected( $this->get_value( 'gallery_layout' ), 'left-sidebar' ) ?>>
                            <?php esc_html_e( 'Left Sidebar', 'clever-portfolio' ) ?>
                        </option>
                        <option value="right-sidebar" <?php selected( $this->get_value( 'gallery_layout' ), 'right-sidebar' ) ?>>
                            <?php esc_html_e( 'Right Sidebar', 'clever-portfolio' ) ?>
                        </option>
                        <option value="full-screen" <?php selected( $this->get_value( 'gallery_layout' ), 'full-screen' ) ?>>
                            <?php esc_html_e( 'Full Screen Slider', 'clever-portfolio' ) ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr id="metro-columns-width" class="gallery-meta-field">
                <td class="text-align-top">
                    <label><?php esc_html_e( 'Columns', 'clever-portfolio' ) ?></label>
                </td>
                <td>
                    <input type="number" name="<?php echo $this->get_field( 'columns' ) ?>" value="<?php echo $this->get_value( 'columns' ) ?>">
                    <p class="description">
                        <?php esc_html_e( 'Total number of columns in the Metro layout.', 'clever-portfolio' ) ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-align-top">
                    <label for="short-description"><?php _e( 'Description', 'clever-portfolio' ) ?></label>
                </td>
                <td>
                    <textarea name="<?php echo $this->get_field( 'short_description' ) ?>" rows="5" cols="40"><?php echo $this->get_value( 'short_description' ) ?></textarea>
                    <p class="description">
                        <?php esc_html_e( 'A short description which will be displayed on the portfolio page.', 'clever-portfolio' ) ?>
                    </p>
                </td>
            </tr>
        </table>
        <!-- End default options -->

        <!-- Start extra options -->
        <table id="extra-options" class="meta-table" style="display:none;width:100%">
            <?php
            if ( !empty( $this->settings['single_extra_info'] ) ) :
                $fields = (array)$this->settings['single_extra_info'];
                foreach ( $fields as $key => &$field ) :
                    $class_attr = ( 'datetime' === $field['type'] ) ? 'date-picker' : 'meta-field';
                    $field_value = isset( $this->values[$key] ) ? $this->values[$key] : '';
                        ?>
                        <tr class="extra-meta-field">
                            <td class="text-align-top">
                                <label><?php echo $field['label'] ?></label>
                            </td>
                            <td>
                                <?php if ( 'textarea' === $field['type'] ) : ?>
                                    <textarea name="<?php echo $this->get_field( $key ) ?>" rows="8" cols="40"><?php echo $field_value ?></textarea>
                                <?php else : ?>
                                    <input class="<?php echo $class_attr ?>" type="<?php echo $field['type'] ?>" name="<?php echo $this->get_field( $key ) ?>" value="<?php echo $field_value ?>">
                                <?php endif  ?>
                            </td>
                        </tr>
                    <?php
                endforeach;
            endif;
            ?>
        </table>
        <!-- End extra options -->
        <?php
    }

    /**
     * Sanitize metadata
     *
     * @param    array    Raw metadata.
     *
     * @return    array    Sanitized metadata.
     */
    private function sanitize( $meta )
    {
        $meta['galleries']  = isset( $meta['galleries'] ) ? explode( ',', trim( $meta['galleries'], ',' ) ) : '';
        $meta['oembed_url'] = isset( $meta['oembed_url'] ) ? esc_url( $meta['oembed_url'] ) : '';

        return $meta;
    }

    /**
     * Save metadata
     *
     * @param    int    $post_id    Portfolio's ID.
     */
    function save( $post_id )
    {
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return;

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        if ( !current_user_can( 'edit_post', $post_id ) || wp_is_post_revision( $post_id ) ) return;

        $metadata = isset( $_POST[self::META_KEY] ) ? $this->sanitize( $_POST[self::META_KEY] ) : array();

        update_post_meta( $post_id, self::META_KEY, $metadata, $this->values );
    }

    /**
     * Do AJAX oembed preview
     */
    function preview_oembed()
    {
        if ( isset( $_POST['porfolioOembedUrl'] ) && !empty( $_POST['porfolioOembedUrl'] ) ) {
            $oembed = esc_url( $_POST['porfolioOembedUrl'] );
            $oembed = wp_oembed_get( $oembed, array( 'width' => '320', 'height' => '320' ) );
            if ( $oembed ) {
                exit( $oembed );
            }
        }

        exit( __( 'Failed to fetch embed resource.', 'clever-portfolio' ) );
    }

    /**
     * Get field name
     *
     * @param    string    $name    Field name.
     *
     * @return    string    $field    Field ID.
     */
    private function get_field( $name )
    {
        $field = self::META_KEY . '[' . $name . ']';

        return $field;
    }

    /**
     * Get field value
     *
     * @param    string    $name       Field name
     * @param    mixed     $default    Default value
     *
     * @return    mixed    $value
     */
    private function get_value( $name )
    {
        $value = isset( $this->values[$name] ) ? $this->values[$name] : $this->fields[$name];

        return $value;
    }
}
