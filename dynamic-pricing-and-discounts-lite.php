<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://profiles.wordpress.org/smit08/
 * @since             1.0.0
 * @package           Dynamic_Pricing_And_Discounts_Lite
 *
 * @wordpress-plugin
 * Plugin Name:       Dynamic Pricing & Discounts Lite
 * Plugin URI:        https://https://github.com/Smit2808/dynamic-pricing-and-discounts-lite
 * Description:       This plugin allows WooCommerce store owners to create dynamic pricing rules and discounts without the need for coding. It will provide an easy-to-use interface for configuring different types of discounts, including bulk discounts, and category-based promotions.
 * Version:           1.0.0
 * Author:            Smit Rathod
 * Author URI:        https://https://profiles.wordpress.org/smit08//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dynamic-pricing-and-discounts-lite
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DYNAMIC_PRICING_AND_DISCOUNTS_LITE_VERSION', '1.0.0' );

if ( ! defined( 'DYNAMIC_PRICING_AND_DISCOUNTS_LITE_PATH' ) ) {
	define( 'DYNAMIC_PRICING_AND_DISCOUNTS_LITE_PATH', plugin_dir_path( __FILE__ ) );
}

// Check if WooCommerce is active
add_action( 'plugins_loaded', function() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		add_action( 'admin_notices', function() {
			echo '<div class="error"><p>' . esc_html__( 'Dynamic Pricing & Discounts Lite requires WooCommerce to be installed and active.', 'dynamic-pricing-and-discounts-lite' ) . '</p></div>';
		} );
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
} );

require_once DYNAMIC_PRICING_AND_DISCOUNTS_LITE_PATH . 'includes/dynamic-pricing-and-discounts-lite-action-functions.php';
