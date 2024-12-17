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
 * @subpackage UIC/templates
 */

namespace DKO\UIC\TemplateManagement\Controller;

/**
 * Define the interface for template controllers
 *
 * @link https://www.walger-marketing.de
 *
 * @author Walger Marketing
 */
interface Template_Controller {


	/**
	 * Render template file
	 *
	 * @param string $template the template file.
	 * @param array  $params   template parameters.
	 *
	 * @return void
	 */
	public function render( string $template, array $params );
}
