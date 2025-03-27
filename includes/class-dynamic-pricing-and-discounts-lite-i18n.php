<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://profiles.wordpress.org/smit08/
 * @since      1.0.0
 *
 * @package    Dynamic_Pricing_And_Discounts_Lite
 * @subpackage Dynamic_Pricing_And_Discounts_Lite/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dynamic_Pricing_And_Discounts_Lite
 * @subpackage Dynamic_Pricing_And_Discounts_Lite/includes
 * @author     Smit Rathod <smitrathod2808@gmail.com>
 */
class Dynamic_Pricing_And_Discounts_Lite_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dynamic-pricing-and-discounts-lite',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
