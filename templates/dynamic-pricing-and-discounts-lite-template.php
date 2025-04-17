<?php
function dynamic_pricing_and_discounts_lite_settings_page() {
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dynamic_pricing_and_discounts_lite_settings'])) {
		// Retrieve existing settings or initialize as an empty array
		$saved_settings = get_option('dynamic_pricing_and_discounts_lite_settings', array());

		// Sanitize and add the new settings
		$new_item = array(
			'rule_name'        => sanitize_text_field($_POST['rule_name']),
			'discount_label'   => sanitize_text_field($_POST['discount_label']),
			'discount_priority'=> sanitize_text_field($_POST['discount_priority']),
			'discount_type'    => sanitize_text_field($_POST['discount_type']),
			'discount_value'   => sanitize_text_field($_POST['discount_value']),
		);

		$saved_settings[] = $new_item; // Add the new item to the array
		update_option('dynamic_pricing_and_discounts_lite_settings', $saved_settings);
	}

	// Retrieve the saved settings
	$saved_settings = get_option('dynamic_pricing_and_discounts_lite_settings', array());
	?>
	<div class="wrap">
		<div id="overlay" style="display: none;"></div>
		<div id="dynamic-fields-container" style="display: none;">
			<div class="close-popup-section">
				<span id="close-icon" class="dashicons dashicons-no"></span>
			</div>
			<form method="post" action="">
				<?php
				settings_fields('dynamic-pricing-and-discounts-lite-settings');
				do_settings_sections('dynamic-pricing-and-discounts-lite-settings');
				?>
				<h3>Add New Discount Rule</h3>

				<div class="field-wrapper rule-name-wrapper">
					<label for="rule_name">Rule Name:</label>
					<input type="text" id="rule_name" name="rule_name" placeholder="Enter Rule Name"/>
				</div>

				<div class="field-wrapper discount-label-wrapper">
					<label for="discount_label">Discount Label:</label>
					<input type="text" id="discount_label" name="discount_label" placeholder="Enter Discount Label" />
				</div>

				<div class="field-wrapper discount-priority-wrapper">
					<label for="discount_priority">Discount Priority:</label>
					<input type="text" id="discount_priority" name="discount_priority" placeholder="Enter Discount Priority" />
				</div>

				<div class="field-wrapper discount-type-wrapper">
					<label for="discount_type">Discount Type:</label>
					<select id="discount_type" name="discount_type">
						<option value="percentage-discount">Percentage Discount</option>
						<option value="product-price-discount">Product Price Discount</option>
						<option value="fixed-price-discount">Fixed Price Discount</option>
						<option value="discount-on-cart-total">Discount Based on Cart Total</option>
						<option value="discount-on-product-quantity">Discount Based on Product Quantity</option>
					</select>
				</div>

				<div class="field-wrapper discount-value-wrapper">
					<label for="discount_value">Discount Value in Percentage/Price:</label>
					<input type="text" id="discount_value" name="discount_value" placeholder="Enter Discount Value" />	
				</div>

				<input type="hidden" name="dynamic_pricing_and_discounts_lite_settings" value="1" />
				<button type="button" id="save-button" class="button button-primary">Save Settings</button>
			</form>
		</div>
		<div class="discount-rule-save-table-header">
			<h2>Discount Rules</h2>
			<button type="button" id="add-new-item-button" class="button button-primary">Add New Item</button>
		</div>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th>Rule Name</th>
					<th>Discount Label</th>
					<th>Priority</th>
					<th>Type</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($saved_settings)) : ?>
					<?php foreach ($saved_settings as $index => $item) : ?>
						<tr class="discount-item-row" data-index="<?php echo $index; ?>">
							<td class="discount-rule-name-cell"><?php echo esc_html($item['rule_name']); ?></td>
							<td class="discount-label-cell"><?php echo esc_html($item['discount_label']); ?></td>
							<td class="discount-priority-cell"><?php echo esc_html($item['discount_priority']); ?></td>
							<td class="discount-type-cell"><?php echo esc_html($item['discount_type']); ?></td>
							<td class="discount-value-cell"><?php echo esc_html($item['discount_value']); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="5">No discount rules found.</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}