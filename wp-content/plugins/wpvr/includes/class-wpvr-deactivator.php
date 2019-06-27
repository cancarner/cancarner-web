<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Fired during plugin deactivation
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Wpvr
 * @subpackage Wpvr/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wpvr
 * @subpackage Wpvr/includes
 * @author     Rextheme <sakib@coderex.co>
 */
class Wpvr_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		if(is_plugin_active( 'wpvr-pro/wpvr-pro.php' )){
			deactivate_plugins( 'wpvr-pro/wpvr-pro.php' );
			wp_die( __( 'WPVR Pro will auto deactivate for deactivating WPVR. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins and deactivate WPVR again please.</a>' ) );
		}
	}

}
