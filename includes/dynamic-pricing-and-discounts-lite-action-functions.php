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

function dynamic_pricing_and_discounts_lite_settings_page() {
	?>
	<div class="wrap">
		<h2>Dynamic Pricing and Discounts Lite Settings</h2>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'dynamic-pricing-and-discounts-lite-settings' );
			do_settings_sections( 'dynamic-pricing-and-discounts-lite-settings' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}
