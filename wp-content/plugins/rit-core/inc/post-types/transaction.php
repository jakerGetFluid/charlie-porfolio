<?php

if (!class_exists('RIT_Transaction')) {
    class RIT_Transaction {
        public function __construct() {

            register_activation_hook( __FILE__, array($this, 'add_transtion_table') );
            add_action('init', array($this, 'register_transaction'));
            
        }

        public function register_transaction() {
            $labels = array(
                'name' => esc_html__('Transactions', 'rit-core-language'),
                'singular_name' => esc_html__('Transaction', 'rit-core-language'),
                'view_item' => esc_html__('View Transaction', 'rit-core-language'),
                'search_items' => esc_html__('Search Transaction', 'rit-core-language'),
                'not_found' => esc_html__('No transaction items have been added yet', 'rit-core-language'),
                'not_found_in_trash' => esc_html__('Nothing found in Trash', 'rit-core-language'),
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_nav_menus' => true,
                'menu_icon' => 'dashicons-exerpt-view',
                'hierarchical' => false,
                'rewrite' => array(
                    'slug' => 'transaction'
                ),
                'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                    'revisions',
                    'author',
                    'comments'
                ),
                'has_archive' => true,
            );

            register_post_type('transaction', $args);
        }

        public function add_transtion_table(){
            global $wpdb;

            $table_name = $wpdb->prefix . 'rit_donate_transactions';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`txn_id` varchar(64) NOT NULL,
					`post_id` int(11) NOT NULL,
					`transactions_info` text NOT NULL,
					`created_date` date NOT NULL,
					UNIQUE KEY id (id)
				) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

            dbDelta( $sql );
        }


        public function rit_donate_form_columns( ) {
            //Standard columns
            $rit_donate_form_columns = array(
                'cb'            => '<input type="checkbox"/>',
                'title'         => esc_html__( 'Name', 'rit-core-language' ),
                'goal'          => esc_html__( 'Goal', 'rit-core-language' ),
                'currency'        => esc_html__( 'Currency', 'rit-core-language' ),
                'paypal'        => esc_html__( 'Paypal', 'rit-core-language' ),
                'date'          => esc_html__( 'Date', 'rit-core-language' )
            );

            return apply_filters( 'rit_donate_form_columns', $rit_donate_form_columns );
        }

        public function rit_render_donate_form_columns( $column_name, $post_id ) {

            if ( get_post_type( $post_id ) == 'transaction' ) {

                switch ( $column_name ) {
                    case 'goal':
                        echo get_post_meta( $post_id, 'rit_goal', true);
                        break;
                    case 'currency':
                        echo get_post_meta( $post_id, 'rit_c_code', true);
                        break;
                    case 'paypal':
                        echo get_post_meta( $post_id, 'rit_account', true);
                        break;

                }
            }
        }
    }

    new RIT_Transaction();
}