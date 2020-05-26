<?php
/**
 * Plugin Name: WAX Restrict Site Health Check
 * Plugin URI: https://www.webaxones.com
 * Description: Block Site Health Check only when WP_DEBUG_DISPLAY is off
 * Author: Webaxones
 * Author URI: https://www.webaxones.com
 * Version: 1.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) :
	die( '-1' );
endif;


/**
 * Remove site health admin menu if WP_DEBUG_DISPLAY is off
 *
 * @return void
 */
function wax_remove_site_health_menu() {
	remove_submenu_page( 'tools.php', 'site-health.php' );
}
if ( ! WP_DEBUG_DISPLAY ) :
	add_action( 'admin_menu', 'wax_remove_site_health_menu' );
endif;


/**
 * Block site health page screen if WP_DEBUG_DISPLAY is off
 *
 * @return void
 */
function wax_block_site_health_access() {

	if ( is_admin() ) {

		$screen = get_current_screen();

		// If screen id is site health.
		if ( 'site-health' === $screen->id ) :
			wp_safe_redirect( admin_url() );
			exit;
		endif;

	}

}
if ( ! WP_DEBUG_DISPLAY ) :
	add_action( 'current_screen', 'wax_block_site_health_access' );
endif;
