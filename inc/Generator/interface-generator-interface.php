<?php
/**
 * This file is part of the Woocommerce User ID Sequence Control plugin.
 *
 * (c) Walger Marketing
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author     Walger Marketing
 * @package    UIC
 * @subpackage UIC/core
 */

namespace DKO\UIC\EventManagement;

/**
 * A generator interface to render content.
 *
 * @author Walger Marketing
 */
interface Generator_Interface {
	/**
	 * Generate content
	 *
	 * @param array $args The parameters to use for content generation.
	 * @return string
	 */
	public function generate( array $args ): string;
}
