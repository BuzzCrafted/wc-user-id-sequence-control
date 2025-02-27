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
 * @subpackage UIC/Admin
 */

namespace DKO\UIC\Admin;

use DKO\UIC\Entity\Setting;

/**
 * The plugin's WC settings page.
 *
 * @link https://www.walger-marketing.de
 *
 * @author Walger Marketing
 * @since 1.0.0
 */
class WC_Settings_Page {
	/**
	 * Available settings
	 *
	 * @var array
	 */
	protected $settings;

	/**
	 * Slug used by the admin page.
	 *
	 * @var string
	 */
	protected $slug;

	/**
	 * Constructor.
	 *
	 * @param string $slug Page slug.
	 */
	public function __construct( string $slug ) {
		$this->slug     = $slug;
		$this->settings = array(
			new Setting( 'start_id', __( 'Start ID', 'wc-user-id-sequence-control' ), 50000 ),
			new Setting( 'is_cache_allowed', __( 'Cache', 'wc-user-id-sequence-control' ), false, 'checkbox' ),
		);
	}

	/**
	 * Add custom tab
	 *
	 * @param  array $settings_tabs The Woocommerce settings tabs.
	 *
	 * @return array
	 */
	public function configure( array $settings_tabs ): array {
		$settings_tabs[ $this->get_slug() ] = __( 'Customer IDs', 'wc-user-id-sequence-control' );
		return $settings_tabs;
	}

	/**
	 * Get available settings
	 *
	 * @return array
	 */
	public function get_available_settings(): array {
		$wc_settings = array(
			array(
				'title' => __( 'Woocommerce User ID Sequence Control', 'wc-user-id-sequence-control' ),
				'desc'  => __( 'Manage your settings for the Woocommerce User ID Sequence Control plugin.', 'wc-user-id-sequence-control' ),
				'type'  => 'title',
				'id'    => 'woocommerce_id_sequence_control_settings',
			),
		);
		foreach ( $this->settings as $setting ) {
			$wc_settings[] =
			array(
				'name'    => $setting->get_name(),
				'title'   => $setting->get_description(),
				'id'      => $setting->get_name(),
				'default' => $setting->get_default(),
				'type'    => $setting->get_widget(),
			);
		}
		$wc_settings[] = array(
			'type' => 'sectionend',
			'id'   => $this->get_slug() . '_settings',
		);
		return $wc_settings;
	}

	/**
	 * Get slug
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return $this->slug;
	}
}
