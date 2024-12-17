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
 * @subpackage UIC/subscriber
 */

namespace DKO\UIC\Subscriber;

use DKO\UIC\EventManagement\Subscriber_Interface;
use DKO\UIC\Admin\WC_Settings_Page;
use DKO\UIC\Controller\User_ID_Controller;

/**
 * WC settings page subscriber.
 *
 * @author Walger Marketing
 * @since 1.0.0
 */
class WC_Settings_Page_Subscriber implements Subscriber_Interface {
	/**
	 * The admin page.
	 *
	 * @var WC_Settings_Page
	 */
	protected $page;

	/**
	 * The basename of the plugin.
	 *
	 * @var string
	 */
	protected $plugin_basename;

	/**
	 * Slug used by the admin page.
	 *
	 * @var string
	 */
	protected static $slug = 'wc-user-id-sequence-control';

	/**
	 * Constructor.
	 *
	 * @param WC_Settings_Page $page The admin page.
	 * @param string           $plugin_basename The plugin base name.
	 */
	public function __construct( WC_Settings_Page $page, $plugin_basename ) {
		$this->page            = $page;
		$this->plugin_basename = $plugin_basename;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function get_subscribed_events() {
		return array(
			'woocommerce_settings_tabs_array'          => array( 'configure', 99, 1 ),
			'woocommerce_settings_' . self::$slug      => 'render',
			'woocommerce_settings_save_' . self::$slug => 'save',
		);
	}

	/**
	 * Configure the admin page using the Settings API.
	 */
	public function configure( $settings_tabs ) {
		return $this->page->configure( $settings_tabs );
	}

	/**
	 * Render page
	 *
	 * @return void
	 */
	public function render() {
		\WC_Admin_Settings::output_fields( $this->page->get_available_settings() );
	}

	/**
	 * Save settings
	 *
	 * @return void
	 */
	public function save() {
		\WC_Admin_Settings::save_fields( $this->page->get_available_settings() );
		$user_id_controller = new User_ID_Controller();
		$user_id_controller->set_user_base_id();
	}

	/**
	 * Get slug
	 *
	 * @return string
	 */
	public static function get_slug(): string {
		return self::$slug;
	}
}
