<?php
/**
 * This file is part of the Woocommerce User ID Sequence Control plugin.
 *
 * (c) Walger Marketing
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Walger Marketing
 * @package UIC
 */

namespace DKO\UIC;

/**
 * Fired during plugin deactivation
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link https://www.walger-marketing.de
 *
 * @author Walger Marketing
 **/
class Deactivator {


	/**
	 * Deactivate plugin.
	 *
	 * Hook actions needed during plugin deactivation.
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
