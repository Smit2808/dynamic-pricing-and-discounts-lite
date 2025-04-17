<?php
/**
 * this file has functions for applying discount on products and cart.
 *
 * Makes the AI API calls.
 *
 * @package Dynamic_Pricing_And_Discounts_Lite
 * @link    https://profiles.wordpress.org/smit08/
 * @since   1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Hook to apply discount on cart
add_action('woocommerce_product_get_price', 'apply_50_percent_discount_for_low_value_products', 10, 2);

function apply_50_percent_discount_for_low_value_products($price, $product) {
	// Check if product price is less than 200
	if ($price < 200) {
		$discount = $price * 0.50; // 50% discount
		$price = $price - $discount;
	}
	return $price;
}
