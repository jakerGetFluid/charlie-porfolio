<?php
/**
 * Clever_Portfolio_Shortcode_Post_Type
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Shortcode_Post_Type
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
    }

    /**
     * Register portfolio post type
     */
    function register()
    {
        $labels = array(
            'name'          => __( 'Shortcodes', 'clever-portfolio' ),
            'singular_name' => __( 'Shortcode', 'clever-portfolio' ),
            'add_new'       => __( 'Add New', 'clever-portfolio' ),
            'add_new_item'  => __( 'Add New Shortcode', 'clever-portfolio' ),
            'edit_item'     => __( 'Edit Shortcode', 'clever-portfolio' ),
            'new_item'      => __( 'New Shortcode', 'clever-portfolio' ),
            'view_item'     => __( 'View Shortcode', 'clever-portfolio' )
        );

        $args = array(
            'labels'       => $labels,
            'public'       => false,
            'show_ui'      => true,
            'show_in_menu' => 'edit.php?post_type=portfolio',
            'hierarchical' => false,
            'supports'     => array( 'title', 'revisions' )
        );

        $this->post_type = register_post_type( 'portfolio-shortcode', $args );
    }

    /**
     * Add shortcode column on posts list table
     *
     * @param    array    $columns    Default columns.
     *
     * @return    array    $columns    New columns.
     */
    function add_shortcode_column( $columns )
    {
        $date = $columns['date'];

        unset( $columns['date'] );

        $columns['shortcode'] = __( 'Shortcode', 'clever-portfolio' );

        $columns['date'] = $date;

        return $columns;
    }

    /**
     * Get shortcode column content
     *
     * @param    string    $col        Column slug.
     * @param    int       $post_id    Current post's ID.
     */
    function the_shortcode_cell_content( $col, $post_id )
    {
        echo '[clever-portfolio-sc id="' . $post_id . '"]';
    }
}
