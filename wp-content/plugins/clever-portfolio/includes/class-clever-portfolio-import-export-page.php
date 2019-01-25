<?php
/**
 * Clever_Portfolio_Import_Export_Page
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Import_Export_Page
{
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
    function __construct( array $settings )
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
            __( 'Import/Export', 'clever-portfolio' ),
            __( 'Import/Export', 'clever-portfolio' ),
            'manage_options',
            basename( __FILE__ ),
            array( $this, 'callback' )
       );
    }

    /**
     * Callback
     */
    function callback()
    {
        ?><div class="wrap clever-portfolio-import-export-data">
            <h2><?php _e( 'Import/Export Portfolio Settings', 'clever-portfolio' ) ?></h2>
            <table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><strong><?php _e( 'Import Settings', 'clever-portfolio' ) ?></strong></th>
						<td>
							<p><?php _e( 'Choose an import file from your computer and click "Upload and Import" button.', 'clever-portfolio' ) ?></p>
							<form enctype="multipart/form-data" method="post" action="<?php echo menu_page_url( basename( __FILE__ ), 0 ) ?>">
                                <?php wp_nonce_field( 'clever-portfolio-import-data', 'ri-import-nonce' ) ?>
								<input type="hidden" name="clever-portfolio-import" value="1">
								<label for="clever-portfolio-inport-data" class="screen-reader-text">
                                    <?php _e( 'Upload File', 'clever-portfolio' ) ?>:
                                </label>
								<p><input type="file" id="clever-portfolio-inport-data" name="clever-portfolio-import-data"></p>
								<?php submit_button( esc_attr__( 'Upload and Import', 'clever-portfolio' ), 'primary', 'upload' ) ?>
							</form>

						</td>
					</tr>

					<tr>
						<th scope="row"><strong><?php _e( 'Export Settings', 'clever-portfolio' ) ?></strong></th>
						<td>
							<p><?php _e( 'Once you have saved the export file, you can use the import function to import the settings.', 'clever-portfolio' ) ?></p>
							<form method="post" action="<?php echo menu_page_url( basename( __FILE__ ), 0 ) ?>">
                                <?php wp_nonce_field( 'clever-portfolio-export-data', 'ri-export-nonce' ) ?>
								<?php submit_button( esc_attr__( 'Download Export File', 'clever-portfolio' ), 'primary', 'clever-portfolio-export-btn' );
								?>
							</form>
						</td>
					</tr>
				</tbody>
			</table>
        </div><?php
    }

    /**
     * Import
     */
    function import()
    {
        if ( !$this->validate_current_page() )
			return;

        if ( !isset( $_POST['ri-import-nonce'] ) || !wp_verify_nonce( $_POST['ri-import-nonce'], 'clever-portfolio-import-data' ) || empty( $_FILES['clever-portfolio-import-data']['tmp_name'] ) )
            return;

		$upload   = file_get_contents( $_FILES['clever-portfolio-import-data']['tmp_name'] );
		$settings = json_decode( $upload, true );
        $imported = update_option( Clever_Portfolio::OPTION_NAME, $settings );
        $page_url = html_entity_decode( menu_page_url( basename( __FILE__ ), 0 ) );

		if ( !$settings || $_FILES['clever-portfolio-import-data']['error'] || !$imported ) {
            wp_redirect( $page_url . '&imported=false' );
		}

		wp_redirect( $page_url. '&imported=true' );

		exit;
    }

    /**
     * Export
     */
    function export()
    {
        if ( !$this->validate_current_page() )
            return;

        if ( !isset( $_POST['ri-export-nonce'] ) || !wp_verify_nonce( $_POST['ri-export-nonce'], 'clever-portfolio-export-data' ) )
            return;

        $settings = get_option( Clever_Portfolio::OPTION_NAME );

		if ( !$settings ) return;

	    $settings = json_encode( (array)$settings );

	    header( 'Content-Description: File Transfer' );
	    header( 'Cache-Control: public, must-revalidate' );
	    header( 'Pragma: hack' );
	    header( 'Content-Type: application/json' );
	    header( 'Content-Disposition: attachment; filename="clever-portfolio-settings-' . date( 'Ymd-His' ) . '.json"' );
	    header( 'Content-Length: ' . mb_strlen( $settings ) );

	    exit($settings);
	}

    /**
     * Do notification
     *
     * @see    https://developer.wordpress.org/reference/hooks/admin_notices/
     */
    function notify()
    {
        if ( !$this->validate_current_page() )
			return;

        if ( isset( $_REQUEST['imported'] ) && 'true' === $_REQUEST['imported'] ) :
            ?><div class="updated notice is-dismissible">
                <p><strong>
                    <?php _e( 'Settings have been imported successfully!', 'clever-portfolio' ) ?>
                </strong></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">
                        <?php _e( 'Dismiss this notice.' ) ?>
                    </span>
                </button>
            </div><?php
        endif;
        if ( isset( $_REQUEST['imported'] ) && 'false' === $_REQUEST['imported'] ) :
            ?><div class="updated error is-dismissible">
                <p><strong>
                    <?php _e( 'Failed to import settings. Please try again!', 'clever-portfolio' ) ?>
                </strong></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">
                        <?php _e( 'Dismiss this notice.' ) ?>
                    </span>
                </button>
            </div><?php
        endif;
    }

    /**
     * Validate current page
     */
    private function validate_current_page()
    {
    	global $page_hook;

    	if ( isset( $page_hook ) && $page_hook === $this->hook_suffix )
    		return true;

    	if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] === basename( __FILE__ ) )
    		return true;

    	return false;
    }
}
