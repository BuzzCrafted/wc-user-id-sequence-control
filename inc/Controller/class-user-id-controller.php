<?php
/**
 * This file is part of the WooCommerce User ID Sequence Control plugin.
 *
 * (c) Walger Marketing
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author     Walger Marketing
 * @package    UIC
 * @subpackage UIC/Controller
 */

namespace DKO\UIC\Controller;

/**
 * Define the assets functionality.
 *
 * Adds functionality to set WooCommerce user base ID.
 *
 * @link https://www.walger-marketing.de
 */
class User_ID_Controller {

	/**
	 * Set the user base ID.
	 *
	 * @return void
	 */
	public function set_user_base_id(): void {
		global $wpdb;

		// Get the user-set starting ID from WooCommerce settings or default to 500000.
		$next_user_id = (int) \WC_Admin_Settings::get_option( 'start_id', 500000 );

		// Define the correct table name.
		$table = $wpdb->prefix . 'users';

		// Sanitize table name (wrapped in backticks for safety).
		$table = "`{$table}`";

		// Get the current AUTO_INCREMENT value (cached for performance).
		$cache_key              = 'current_auto_increment_' . $table;
		$current_auto_increment = wp_cache_get( $cache_key );

		if ( false === $current_auto_increment ) {
			$current_auto_increment = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES 
					WHERE TABLE_NAME = %s AND TABLE_SCHEMA = %s',
					str_replace( '`', '', $table ),
					$wpdb->dbname
				)
			);

			// Cache result for 1 hour.
			wp_cache_set( $cache_key, $current_auto_increment, '', 3600 );
		}

		// Update AUTO_INCREMENT if it's lower than the desired value.
		if ( $current_auto_increment < $next_user_id ) {
			$wpdb->query( 'ALTER TABLE {$table} AUTO_INCREMENT = {$next_user_id}' );
		}
	}
}
