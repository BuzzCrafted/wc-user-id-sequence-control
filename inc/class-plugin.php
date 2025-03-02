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

use DKO\UIC\Admin\WC_Settings_Page;
use DKO\UIC\AssetManagement\Asset_Path;
use DKO\UIC\EventManagement\Event_Manager;
use DKO\UIC\EventManagement\Subscriber_Interface;
use DKO\UIC\Service\Plugin_Details;
use DKO\UIC\Shortcode\Shortcode_Interface;
use DKO\UIC\Subscriber\Admin_Assets_Subscriber;
use DKO\UIC\Subscriber\Assets_Subscriber;
use DKO\UIC\Subscriber\Details_Subscriber;
use DKO\UIC\Subscriber\Updater_Subscriber;
use DKO\UIC\Subscriber\WC_Settings_Page_Subscriber;
use DKO\UIC\Updater\Git_Updater;

/**
 * The core plugin class.
 * Defines internationalization, admin-specific hooks, and public-facing site hooks.
 *
 * @link https://www.walger-marketing.de
 *
 * @author Walger Marketing
 */
class Plugin {


	/**
	 * The plugin version
	 *
	 * @var string
	 */
	const VERSION = '1.0.1';

	/**
	 * The plugin name
	 *
	 * @var string
	 */
	const NAME = 'wc-user-id-sequence-control';

	/**
	 * The plugin event manager.
	 *
	 * @var Event_Manager
	 */
	private $event_manager;

	/**
	 * Flag to track if the plugin is loaded.
	 *
	 * @var bool
	 */
	private $loaded;

	/**
	 * Absolute path to the directory where WordPress installed the plugin.
	 *
	 * @var string
	 */
	private $plugin_path;

	/**
	 * URL to the directory where WordPress installed the plugin.
	 *
	 * @var string
	 */
	private $plugin_url;

	/**
	 * Constructor.
	 *
	 * @param string $file Path to the plugin dir.
	 */
	public function __construct( string $file ) {
		$this->event_manager = new Event_Manager();
		$this->loaded        = false;
		$this->plugin_path   = plugin_dir_path( $file );
		$this->plugin_url    = plugin_dir_url( $file );
	}

	/**
	 * Checks if the plugin is loaded.
	 *
	 * @return bool
	 */
	public function is_loaded() {
		return $this->loaded;
	}

	/**
	 * Load the plugin into WordPress
	 *
	 * @return void
	 */
	public function load() {
		if ( $this->is_loaded() ) {
			return;
		}

		foreach ( $this->get_subscribers() as $subscriber ) {
			$this->event_manager->add_subscriber( $subscriber );
		}

		foreach ( $this->get_shortcodes() as $shortcode ) {
			$this->register_shortcode( $shortcode );
		}

		$this->loaded = true;
	}

	/**
	 * Get the plugin shortcodes.
	 *
	 * @return Shortcode_Interface[]
	 */
	private function get_shortcodes() {
		return array();
	}
	/**
	 * Get the plugin event subscribers.
	 *
	 * @return Subscriber_Interface[]
	 */
	private function get_subscribers() {
		return array(
			new Assets_Subscriber(
				new Asset_Path( 'bundle-style', 'assets', $this->plugin_path, $this->plugin_url ),
				new Asset_Path( 'bundle', 'assets', $this->plugin_path, $this->plugin_url ),
				self::NAME,
				self::VERSION,
				trailingslashit( $this->plugin_path ) . 'language'
			),
			new Admin_Assets_Subscriber(
				new Asset_Path( 'admin-style', 'assets', $this->plugin_path, $this->plugin_url ),
				new Asset_Path( 'admin', 'assets', $this->plugin_path, $this->plugin_url ),
				self::NAME,
				self::VERSION,
				trailingslashit( $this->plugin_path ) . 'language'
			),
			new WC_Settings_Page_Subscriber(
				new WC_Settings_Page( WC_Settings_Page_Subscriber::get_slug() ),
				$this->plugin_path
			),
			new Updater_Subscriber(
				new Git_Updater(
					self::NAME,
					self::VERSION,
					\WC_Admin_Settings::get_option( 'uid_control_is_cache_allowed', false )
				)
			),
			new Details_Subscriber( new Plugin_Details() ),
		);
	}

	/**
	 * Register the given shortcode with the WordPress shortcode API.
	 *
	 * @param Shortcode_Interface $shortcode Shortcode.
	 */
	private function register_shortcode( Shortcode_Interface $shortcode ) {
		add_shortcode( $shortcode::get_name(), array( $shortcode, 'handle' ) );
	}
}
