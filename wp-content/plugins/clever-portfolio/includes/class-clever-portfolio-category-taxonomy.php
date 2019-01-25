<?php
/**
 * Clever_Portfolio_Category_Taxonomy
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Category_Taxonomy
{
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
     * Register portfolio_category taxonomy
     */
    function register()
    {
        $rewrite = array(
            'slug'         => $this->settings['portfolio_category_slug'],
            'with_front'   => false,
            'hierarchical' => true,
        );

        $args = array(
            'label'             => __( 'Categories', 'clever-portfolio' ),
            'singular_label'    => __( 'Category', 'clever-portfolio' ),
            'public'            => true,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => $rewrite
        );

        register_taxonomy( 'portfolio_category', 'portfolio', $args );
    }

    /**
     * Filter posts query
     *
     * @see    https://developer.wordpress.org/reference/hooks/pre_get_posts/
     */
    function filter_archive_portfolios(\WP_Query $query)
    {
        if ( $query->is_tax( 'portfolio_category' ) && $query->is_main_query() ) {
            $query->set( 'order', $this->settings['archive_order'] );
            $query->set( 'order_by', $this->settings['archive_order_by'] );
            $query->set( 'posts_per_page', $this->settings['archive_posts_per_page'] );
        }
    }
    /**
     * Filter Portfolio Archive Title
     *
     */
    function filter_portfolio_title($title){
        if(get_post_type()=='portfolio') {
            return empty($this->settings['archive_page_title']) || is_single() ? $title : $this->settings['archive_page_title'];
        }else{
            return $title;
        }
    }

    /**
     * Filter archive template
     *
     * Change including template base on `archive_layout` setting.
     *
     * @param    string    $template    Default including template.
     *
     * @return    string   $template    Filtered template.
     */
    function include_template( $template )
    {
        if ( is_tax( 'portfolio_category' ) || is_post_type_archive( 'portfolio' ) ) {
            $template = clever_get_template_part('clever-portfolio', '','archive');
        }

        return $template;
    }
}
