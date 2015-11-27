<div class="fpd-modal-wrapper" id="fpd-modal-edit-view-options">
	<div class="fpd-modal-dialog">
		<a href="#" class="fpd-close-modal">&times;</a>
		<h2><?php _e('Fancy View Options', 'radykal'); ?></h2>
		<p class="description">
			<?php _e('Here you can adjust some options for a single view. This allows, among other things to use different prices in different views.', 'radykal');
			?>
		</p>
		<div class="fpd-modal-content">
			<table class="form-table radykal-settings-form">
				<tbody>

					<?php

					radykal_output_option_item( array(
							'id' => 'designs_parameter_price',
							'title' => 'Custom Image Price',
							'type' => 'number',
							'default' => fpd_get_option( 'fpd_designs_parameter_price' ),
							'description' => __('This price will be used for custom added images.', 'radykal')
						)
					);

					radykal_output_option_item( array(
							'id' => 'custom_texts_parameter_price',
							'title' => 'Custom Text Price',
							'type' => 'number',
							'default' => fpd_get_option( 'fpd_custom_texts_parameter_price' ),
							'description' => __('This price will be used for custom added images.', 'radykal')
						)
					);

					radykal_output_option_item( array(
							'type' => 'section_title',
							'title' => 'What kind of media types can the customer add in this view?',
						)
					);

					radykal_output_option_item( array(
							'id' => 'disable_image_upload',
							'title' => 'Disable Image Upload',
							'type' => 'checkbox',
							'default' => 'no'
						)
					);

					radykal_output_option_item( array(
							'id' => 'disable_custom_text',
							'title' => 'Disable Custom Text',
							'type' => 'checkbox',
							'default' => 'no'
						)
					);

					radykal_output_option_item( array(
							'id' => 'disable_facebook',
							'title' => 'Disable Facebook',
							'type' => 'checkbox',
							'default' => 'no'
						)
					);

					radykal_output_option_item( array(
							'id' => 'disable_instagram',
							'title' => 'Disable Instagram',
							'type' => 'checkbox',
							'default' => 'no'
						)
					);

					radykal_output_option_item( array(
							'id' => 'disable_designs',
							'title' => 'Disable Designs',
							'type' => 'checkbox',
							'default' => 'no'
						)
					);

					?>

				</tbody>
			</table>
		</div>
		<div class="fpd-modal-btns">
			<button class="button button-primary fpd-save-modal"><?php _e('Set', 'radykal'); ?></button>
		</div>
	</div>
</div>