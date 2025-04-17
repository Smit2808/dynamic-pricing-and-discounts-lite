<?php

/**
 * This file is for action functions of the plugin.
 *
 * @link       https://https://profiles.wordpress.org/smit08/
 * @since      1.0.0
 */

add_action( 'admin_menu', 'dynamic_pricing_and_discounts_lite_create_menu' );

function dynamic_pricing_and_discounts_lite_create_menu() {
	// Add a submenu under WooCommerce menu
	add_submenu_page(
		'woocommerce',
		'Dynamic Pricing and Discounts Lite Settings',
		'Discounts Settings',
		'manage_options',
		'dynamic-pricing-and-discounts-lite-plugin-settings',
		'dynamic_pricing_and_discounts_lite_settings_page'
	);
}

// Hook to enqueue styles in the admin area.
add_action( 'admin_enqueue_scripts', 'dynamic_pricing_and_discounts_lite_enqueue_script' );

/**
 * Enqueue admin styles.
 */
function dynamic_pricing_and_discounts_lite_enqueue_script() {
	wp_enqueue_style( 'dynamic-pricing-and-discounts-lite-style', DYNAMIC_PRICING_AND_DISCOUNTS_LITE_URL . 'dynamic-pricing-and-discounts-lite/assets/styles.css', array(), '1.0.0' );
	wp_enqueue_script( 'dynamic-pricing-and-discounts-lite-script', DYNAMIC_PRICING_AND_DISCOUNTS_LITE_URL . 'dynamic-pricing-and-discounts-lite/assets/scripts.js', array( 'jquery' ), '1.0.0', true );

	wp_localize_script(
		'dynamic-pricing-and-discounts-lite-script',
		'siteConfig',
		array(
			'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
		)
	);
}

add_action('wp_ajax_save_discount_item_details', 'dynamic_pricing_and_discounts_lite_save_discount_item_details_callback');
add_action('wp_ajax_nopriv_save_discount_item_details', 'dynamic_pricing_and_discounts_lite_save_discount_item_details_callback');

function dynamic_pricing_and_discounts_lite_save_discount_item_details_callback() {
	// Retrieve the existing discount rules
	$discount_rules = get_option('dynamic_pricing_and_discounts_lite_settings', []);

	$index = isset($_POST['index']) && $_POST['index'] != "null" ? intval($_POST['index']) : -1;

	// Ensure required fields are passed
	$rule_name = isset($_POST['rule_name']) ? sanitize_text_field($_POST['rule_name']) : '';
	$discount_type = isset($_POST['discount_type']) ? sanitize_text_field($_POST['discount_type']) : '';
	$discount_value = isset($_POST['discount_value']) ? floatval($_POST['discount_value']) : 0;
	$discount_label = isset($_POST['discount_label']) ? sanitize_text_field($_POST['discount_label']) : '';
	$discount_priority = isset($_POST['discount_priority']) ? sanitize_text_field($_POST['discount_priority']) : '';

	if ($index >= 0 && isset($discount_rules[$index])) {
		// Update the specific rule at the given index
		$discount_rules[$index] = array(
			'rule_name'      => $rule_name,
			'discount_label' => $discount_label,
			'discount_priority' => $discount_priority,
			'discount_type'  => $discount_type,
			'discount_value' => $discount_value,
		);

		// Save the updated rules back to the database
		update_option('dynamic_pricing_and_discounts_lite_settings', $discount_rules);

		wp_send_json_success(['message' => 'Discount rule updated successfully.']);
	} else {
		// Add a new rule if index is null or invalid
		$discount_rules[] = array(
			'rule_name'      => $rule_name,
			'discount_label' => $discount_label,
			'discount_priority' => $discount_priority,
			'discount_type'  => $discount_type,
			'discount_value' => $discount_value,
		);

		// Save the updated rules back to the database
		update_option('dynamic_pricing_and_discounts_lite_settings', $discount_rules);

		wp_send_json_success(['message' => 'New discount rule added successfully.']);
	}

	wp_die(); // always call this at the end of AJAX handlers
}
