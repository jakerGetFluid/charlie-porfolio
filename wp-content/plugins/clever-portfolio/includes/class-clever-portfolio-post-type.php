<?php
/**
 * Clever_Portfolio_Post_Type
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Post_Type
{
    /**
     * Post type
     *
     * @var    object
     *
     * @see    https://developer.wordpress.org/reference/functions/register_post_type/
     */
    public $post_type;

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
    function __construct( array $settings )
    {
        $this->settings = $settings;
        add_action( 'in_admin_header', array( $this, 'admin_header' ), 100 );

    }
    /**
     * Outputs the Clever Portfolio  Header.
     *
     * @since 1.0.0
     */
    public function admin_header() {
        $screen = get_current_screen();
        if ( 'portfolio' !== $screen->post_type && 'portfolio-shortcode'!== $screen->post_type) {
            return;
        }
        echo ent2ncr('<div class="clever-portfolio-heading"><h2><i class="dashicons-before dashicons-format-gallery"></i> '.esc_html__('Clever Portfolios','clever-portfolio').'</h2></div>');

    }
    /**
     * Register portfolio post type
     */
    function register()
    {
        $labels = array(
            'name'               => __( 'Clever Portfolios', 'clever-portfolio' ),
            'singular_name'      => __( 'Clever Portfolio', 'clever-portfolio' ),
            'add_new'            => __( 'Add New', 'clever-portfolio' ),
            'add_new_item'       => __( 'Add New Portfolio Item', 'clever-portfolio' ),
            'edit_item'          => __( 'Edit Portfolio Item', 'clever-portfolio' ),
            'new_item'           => __( 'New Portfolio Item', 'clever-portfolio' ),
            'view_item'          => __( 'View Portfolio Item', 'clever-portfolio' ),
            'search_items'       => __( 'Search Portfolio', 'clever-portfolio' ),
            'not_found'          => __( 'No portfolio items have been added yet', 'clever-portfolio' ),
            'not_found_in_trash' => __( 'Nothing found in Trash', 'clever-portfolio' )
        );

        $rewrite = array(
            'slug' => $this->settings['post_type_slug']
        );

        $archive_slug = !empty($this->settings['post_type_archive_slug']) ? $this->settings['post_type_archive_slug'] : 'portfolios';

        $args = array(
            'labels'            => $labels,
            'public'            => true,
            'show_ui'           => true,
            'show_in_menu'      => true,
            'show_in_nav_menus' => true,
            'menu_icon'         => 'dashicons-format-gallery',
            'hierarchical'      => false,
            'rewrite'           => $rewrite,
            'supports'          => array( 'title', 'editor', 'thumbnail', 'revisions' ),
            'has_archive'       => $archive_slug,
            'show_in_rest'      => true
        );

        $this->post_type = register_post_type( 'portfolio', $args );
    }

    /**
     * Add extra columns on posts list table
     *
     * @param    array    $columns    Default columns.
     *
     * @return    array    $columns    New columns.
     */
    function add_columns( $columns )
    {
        $columns = array_merge( $columns, array(
            'author' => __( 'Author', 'clever-portfolio' )
        ) );

        return $columns;
    }

    /**
     * Filter single template
     *
     * Change including template base on `archive_layout` setting.
     *
     * @var    string    $template    Default including template.
     *
     * @return    string   $template    Filtered template.
     */
    function include_template( $template )
    {
        global $wp_query;

        if ( $wp_query->is_singular( 'portfolio' ) ) {
            $post_id   = get_the_ID();
            $post_meta = get_post_meta( $post_id, Clever_Portfolio_Options_Metabox::META_KEY, true );
            if (!$post_meta) {
                $post_meta = array(
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
                update_post_meta($post_id, Clever_Portfolio_Options_Metabox::META_KEY, $post_meta);
            }
            $template = clever_get_template_part('clever-portfolio', '','single');
        }

        return $template;
    }
}
