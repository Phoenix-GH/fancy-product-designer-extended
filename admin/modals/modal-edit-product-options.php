<div class="fpd-modal-wrapper" id="fpd-modal-edit-product-options">
	<div class="fpd-modal-dialog">
		<a href="#" class="fpd-close-modal">&times;</a>
		<h3><?php _e('Fancy Product Options', 'radykal'); ?></h3>
		<div class="fpd-modal-content">
			<table class="form-table">
				<tbody>

					<?php

					radykal_output_option_item( array(
							'id' => 'stage_width',
							'title' => 'Product Designer Width',
							'type' => 'number',
							'default' => fpd_get_option( 'fpd_stage_width' )
						)
					);

					radykal_output_option_item( array(
							'id' => 'stage_height',
							'title' => 'Product Designer Stage Height',
							'type' => 'number',
							'default' => fpd_get_option( 'fpd_stage_height' )
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