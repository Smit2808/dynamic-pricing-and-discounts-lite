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

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dynamic-pricing-and-discounts-lite-activator.php
 */
function activate_dynamic_pricing_and_discounts_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-pricing-and-discounts-lite-activator.php';
	Dynamic_Pricing_And_Discounts_Lite_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dynamic-pricing-and-discounts-lite-deactivator.php
 */
function deactivate_dynamic_pricing_and_discounts_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-pricing-and-discounts-lite-deactivator.php';
	Dynamic_Pricing_And_Discounts_Lite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dynamic_pricing_and_discounts_lite' );
register_deactivation_hook( __FILE__, 'deactivate_dynamic_pricing_and_discounts_lite' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-pricing-and-discounts-lite.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dynamic_pricing_and_discounts_lite() {

	$plugin = new Dynamic_Pricing_And_Discounts_Lite();
	$plugin->run();

}
run_dynamic_pricing_and_discounts_lite();
