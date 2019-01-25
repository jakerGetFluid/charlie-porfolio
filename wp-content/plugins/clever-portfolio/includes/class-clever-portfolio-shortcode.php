<?php
/**
 * Clever_Portfolio_Shortcode
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Shortcode
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
     * Add shortcode
     *
     * @param    array    $atts    Users' defined attributes in shortcode.
     *
     * @return    string    $html    Rendered shortcode content.
     */
    function add( $atts, $content = null )
    {
        $args = shortcode_atts( array('title'=>'', 'id' => 0 ), $atts, 'clever-portfolio-sc' );
        $html = $this->render( $args );

        return $html;
    }

    /**
     * Integrate to Visual Composer
     */
    function integrate_with_vc()
    {
        vc_map( array(
            'name'        => esc_html__( 'Portfolio Shortcode', 'clever-portfolio' ),
            'base'        => 'clever-portfolio-sc',
            'category'    => esc_html__( 'Clever Shortcodes', 'clever-portfolio' ),
            'icon'        => 'rit-portfolio-shortcodes',
            'admin_label' => true,
            'params'      => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'clever-portfolio' ),
                    'param_name' => 'title',
                    'description' => esc_html__('', 'clever-portfolio'),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Select a Portfolio Shortcode', 'clever-portfolio' ),
                    'description' => __( 'Choose a shortcode which you want to insert into this page.', 'clever-portfolio' ),
                    'param_name'  => 'id',
                    'std'         => 0,
                    'value'       => $this->get_portfolio_shortcodes()
                )
            )
        ) );
    }

    /**
     * List portfolio shortcodes
     *
     * @return    array    $results    An array of available portfolios.
     */
    private function get_portfolio_shortcodes()
    {
        $results = array();

        $query = new \WP_Query( array(
            'post_type'      => 'portfolio-shortcode',
            'posts_per_page' => -1
        ) );

        if ( $query->posts ) {
            foreach ( $query->posts as &$post ) {
                $results[$post->post_title] = $post->ID;
            }
        }

        return $results;
    }

    /**
     * Render shortcode content
     *
     * @param    $args    Shortcode arguments.
     *
     * @return    string    $html    Rendered shortcode content.
     */
    private function render( array $args )
    {
        if ( empty( $args['id'] ) ) return;
        $template = clever_get_template_part('clever-portfolio', '', 'shortcode');

        ob_start();

        include $template;

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }
}
