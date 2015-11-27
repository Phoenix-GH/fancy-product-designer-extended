<div class="fpd-modal-wrapper hidden" id="fpd-modal-individual-product-settings">
	<div class="fpd-modal-dialog">
		<a href="#" class="fpd-close-modal">&times;</a>
		<h3><?php _e('Individual Settings', 'radykal'); ?></h3>
		<p class="description"><?php _e('Here you can set individual product designer settings for this product.', 'radykal'); ?></p>
		<br />
		<ul class="fpd-tabs">
			<li><a href="#" name="tab1"><?php _e('General', 'radykal'); ?></a></li>
			<li><a href="#" name="tab2"><?php _e('Image Options', 'radykal'); ?></a></li>
			<li><a href="#" name="tab3"><?php _e('Custom Text Options', 'radykal'); ?></a></li>
			<?php if( get_post_type($post) === 'product'): ?>
			<li><a href="#" name="tab4"><?php _e('WooCommerce', 'radykal'); ?></a></li>
			<?php endif; ?>
		</ul>
		<div class="fpd-tabs-content">
			<div id="tab1">
				<table class="form-table radykal-form-settings">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('Product Designer Frame Shadow', 'radykal'); ?></label></th>
							<td>
								<select name="frame_shadow">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<?php
										//get all created categories
										foreach(FPD_Settings_General::get_frame_shadows() as $key => $value) {
											echo '<option value="'.$key.'">'.$value.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Dialog Box Positioning', 'radykal'); ?></label></th>
							<td>
								<select name="dialog_box_positioning">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<?php
										//get all created categories
										foreach(FPD_Settings_General::get_dialog_box_positionings() as $key => $value) {
											echo '<option value="'.$key.'">'.$value.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('View Selection Position', 'radykal'); ?></label></th>
							<td>
								<select name="view_selection_position">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<?php
										//get all created categories
										foreach(FPD_Settings_General::get_view_selection_posititions_options() as $key => $value) {
											echo '<option value="'.$key.'">'.$value.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('View Selection Items Floating', 'radykal'); ?></label></th>
							<td><input type="checkbox" name="view_selection_floated" value="1"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Product Stage Width', 'radykal'); ?></label></th>
							<td><input type="number" min="10" style="width:70px;" name="stage_width" placeholder="<?php echo fpd_get_option('fpd_stage_width'); ?>"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Product Stage Height', 'radykal'); ?></label></th>
							<td><input type="number" min="10" style="width:70px;" name="stage_height" placeholder="<?php echo fpd_get_option('fpd_stage_height'); ?>"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Fancy Design Categories', 'radykal'); ?></label></th>
							<td>
								<select class="radykal-select2" name="design_categories[]" multiple data-placeholder="<?php _e('All Categories', 'radykal'); ?>" style="width: 100%;">
									<?php
										//get all created categories
										$categories = get_terms( 'fpd_design_category', array(
										 	'hide_empty' => false
										));
										foreach($categories as $category) {
											echo '<option value="'.$category->term_id.'">'.$category->name.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Available Fonts', 'radykal'); ?></label></th>
							<td>
								<select class="radykal-select2" name="font_families[]" multiple data-placeholder="<?php _e('All Fonts', 'radykal'); ?>" style="width: 100%;">
									<?php
										//get all created categories
										$fonts = FPD_Fonts::get_enabled_fonts();
										foreach($fonts as $font) {
											echo '<option value="'.$font.'">'.$font.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('"Start Customizing" Button', 'radykal'); ?></label></th>
							<td><input type="text" name="start_customizing_button" value="<?php echo fpd_get_option('fpd_start_customizing_button'); ?>"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Open in lightbox', 'radykal'); ?></label></th>
							<td>
								<select name="open_in_lightbox">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="0"><?php _e( 'No', 'radykal' ); ?></option>
									<option value="1"><?php _e( 'Yes', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Background Type', 'radykal'); ?></label></th>
							<td>
								<label><input type="radio" name="background_type" value="image" checked="checked" /> <?php _e('Image', 'radykal'); ?></label>
								<label><input type="radio" name="background_type" value="color" /> <?php _e('Color', 'radykal'); ?></label>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Background Image', 'radykal'); ?></label></th>
							<td>
								<button class="button button-secondary" id="fpd-set-background-image"><?php _e('Set Image', 'radykal'); ?></button>
								<input type="hidden" value="<?php echo plugins_url('/images/fpd/grid.png', dirname(dirname(__FILE__))); ?>" name="background_image">
								<img src="" alt="Background Image" id="fpd-background-image-preview" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Background Color', 'radykal'); ?></label></th>
							<td><input type="text" name="background_color" value="#ffffff" class="radykal-color-picker" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Replace Initial Elements', 'radykal'); ?></label></th>
							<td>
								<select name="replace_initial_elements">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="0"><?php _e( 'No', 'radykal' ); ?></option>
									<option value="1"><?php _e( 'Yes', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Disable Image Upload', 'radykal'); ?></label></th>
							<td><input type="checkbox" name="hide_custom_image_upload" value="1"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Disable Custom Text', 'radykal'); ?></label></th>
							<td><input type="checkbox" name="hide_custom_text" value="1"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Disable Designs', 'radykal'); ?></label></th>
							<td><input type="checkbox" name="hide_designs_tab" value="1"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Disable Facebook', 'radykal'); ?></label></th>
							<td><input type="checkbox" name="hide_facebook_tab" value="1"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Disable Instagram', 'radykal'); ?></label></th>
							<td><input type="checkbox" name="hide_instagram_tab" value="1"></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Color Prices for Images', 'radykal'); ?></label></th>
							<td>
								<select name="enable_image_color_prices">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="0"><?php _e( 'No', 'radykal' ); ?></option>
									<option value="1"><?php _e( 'Yes', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Color Prices for Texts', 'radykal'); ?></label></th>
							<td>
								<select name="enable_text_color_prices">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="0"><?php _e( 'No', 'radykal' ); ?></option>
									<option value="1"><?php _e( 'Yes', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="tab2">
				<h4><?php _e('Common Image', 'radykal'); ?></h4>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('Price', 'radykal'); ?></label></th>
							<td><input type="number" min="0" step="0.01" name="designs_parameter_price" placeholder="<?php echo fpd_get_option('fpd_designs_parameter_price'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Replace', 'radykal'); ?></label></th>
							<td><input type="text" name="designs_parameter_replace" placeholder="<?php echo get_option('fpd_designs_parameter_replace'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Bounding Box', 'radykal'); ?></label></th>
							<td>
								<select name="designs_parameter_bounding_box_control">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="0" data-class="custom-bb"><?php _e( 'Custom Bounding Box', 'radykal' ); ?></option>
									<option value="1" data-class="target-bb"><?php _e( 'Use another element as bounding box', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box X-Position', 'radykal'); ?></label></th>
							<td><input type="number" name="designs_parameter_bounding_box_x" min="0" step="1" placeholder="<?php echo get_option('fpd_designs_parameter_bounding_box_x'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Y-Position', 'radykal'); ?></label></th>
							<td><input type="number" name="designs_parameter_bounding_box_y" min="0" step="1" placeholder="<?php echo get_option('fpd_designs_parameter_bounding_box_y'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Width', 'radykal'); ?></label></th>
							<td><input type="number" name="designs_parameter_bounding_box_width" min="0" step="1" placeholder="<?php echo get_option('fpd_designs_parameter_bounding_box_width'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Height', 'radykal'); ?></label></th>
							<td><input type="number" name="designs_parameter_bounding_box_height" min="0" step="1" placeholder="<?php echo get_option('fpd_designs_parameter_bounding_box_height'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="target-bb">
							<th scope="row"><label><?php _e('Bounding Box Target', 'radykal'); ?></label></th>
							<td><input type="text" name="designs_parameter_bounding_box_by_other" placeholder="<?php echo get_option('fpd_designs_parameter_bounding_box_by_other'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Hide Filters', 'radykal'); ?></label></th>
							<td><input type="checkbox" name="designs_parameter_filters" value=" "></td>
						</tr>
					</tbody>
				</table>
				<h4><?php _e('Custom Image', 'radykal'); ?></h4>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('Minimum Width', 'radykal'); ?></label></th>
							<td><input type="number" min="1" step="1" name="uploaded_designs_parameter_minW" placeholder="<?php echo fpd_get_option('fpd_uploaded_designs_parameter_minW'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Minimum Height', 'radykal'); ?></label></th>
							<td><input type="number" min="1" step="1" name="uploaded_designs_parameter_minH" placeholder="<?php echo fpd_get_option('fpd_uploaded_designs_parameter_minH'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Maximum Width', 'radykal'); ?></label></th>
							<td><input type="number" min="1" step="1" name="uploaded_designs_parameter_maxW" placeholder="<?php echo fpd_get_option('fpd_uploaded_designs_parameter_maxW'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Maximum Height', 'radykal'); ?></label></th>
							<td><input type="number" min="1" step="1" name="uploaded_designs_parameter_maxH" placeholder="<?php echo fpd_get_option('fpd_uploaded_designs_parameter_maxH'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Resize To Width', 'radykal'); ?></label></th>
							<td><input type="number" min="1" step="1" name="uploaded_designs_parameter_resizeToW" placeholder="<?php echo fpd_get_option('fpd_uploaded_designs_parameter_resizeToW'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Resize To Height', 'radykal'); ?></label></th>
							<td><input type="number" min="1" step="1" name="uploaded_designs_parameter_resizeToH" placeholder="<?php echo fpd_get_option('fpd_uploaded_designs_parameter_resizeToH'); ?>" value=""></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="tab3">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('Bounding Box', 'radykal'); ?></label></th>
							<td>
								<select name="custom_texts_parameter_bounding_box_control">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="0" data-class="custom-bb"><?php _e( 'Custom Bounding Box', 'radykal' ); ?></option>
									<option value="1" data-class="target-bb"><?php _e( 'Use another element as bounding box', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box X-Position', 'radykal'); ?></label></th>
							<td><input type="number" name="custom_texts_parameter_bounding_box_x" min="0" step="1" placeholder="<?php echo get_option('fpd_custom_texts_parameter_bounding_box_x'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Y-Position', 'radykal'); ?></label></th>
							<td><input type="number" name="custom_texts_parameter_bounding_box_y" min="0" step="1" placeholder="<?php echo get_option('fpd_custom_texts_parameter_bounding_box_y'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Width', 'radykal'); ?></label></th>
							<td><input type="number" name="custom_texts_parameter_bounding_box_width" min="0" step="1" placeholder="<?php echo get_option('fpd_custom_texts_parameter_bounding_box_width'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Height', 'radykal'); ?></label></th>
							<td><input type="number" name="custom_texts_parameter_bounding_box_height" min="0" step="1" placeholder="<?php echo get_option('fpd_custom_texts_parameter_bounding_box_height'); ?>" value=""></td>
						</tr>
						<tr valign="top" class="target-bb">
							<th scope="row"><label><?php _e('Bounding Box Target', 'radykal'); ?></label></th>
							<td><input type="text" name="custom_texts_parameter_bounding_box_by_other" placeholder="<?php echo get_option('fpd_custom_texts_parameter_bounding_box_by_other'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Price', 'radykal'); ?></label></th>
							<td><input type="number" min="0" step="0.01" name="custom_texts_parameter_price" placeholder="<?php echo fpd_get_option('fpd_custom_texts_parameter_price'); ?>" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Colors', 'radykal'); ?></label></th>
							<td><input type="text" name="custom_texts_parameter_colors" value="" placeholder="<?php echo fpd_get_option('fpd_custom_texts_parameter_colors'); ?>"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div id="tab4">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('Product Designer Positioning', 'radykal'); ?></label></th>
							<td>
								<select name="placement">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<?php
										//get all created categories
										foreach(FPD_Settings_WooCommerce::get_product_designer_positions() as $key => $value) {
											echo '<option value="'.$key.'">'.$value.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Product Designer Floating', 'radykal'); ?></label></th>
							<td>
								<select name="designer_floating">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="none"><?php _e( 'None', 'radykal' ); ?></option>
									<option value="left"><?php _e( 'Left', 'radykal' ); ?></option>
									<option value="right"><?php _e( 'Right', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Hide Product Image', 'radykal'); ?></label></th>
							<td>
								<select name="hide_product_image">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="yes"><?php _e( 'Yes', 'radykal' ); ?></option>
									<option value="no"><?php _e( 'No', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Fullwidth Summary', 'radykal'); ?></label></th>
							<td>
								<select name="fullwidth_summary">
									<option value=""><?php _e( 'Use Option From Main Settings', 'radykal' ); ?></option>
									<option value="yes"><?php _e( 'Yes', 'radykal' ); ?></option>
									<option value="no"><?php _e( 'No', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		<div class="fpd-modal-btns">
			<button class="button button-primary fpd-save-modal"><?php _e('Set', 'radykal'); ?></button>
		</div>
	</div>
</div>
<script type="text/javascript">

	jQuery(document).ready(function($) {

		var $modalWrapper = $('#fpd-modal-individual-product-settings'),
			mediaUploader = null;


		//SETTINGS

		$('#fpd-change-settings').click(function(evt) {

			evt.preventDefault();

			openModal($modalWrapper.removeClass('hidden'));

			radykalFillForm($modalWrapper, $('[name="fpd_product_settings"]').val());

			$modalWrapper.find('select').change();
			$modalWrapper.find('[name="background_color"], [name="background_type"]:checked').change();
			$modalWrapper.find('#fpd-background-image-preview').attr('src', $modalWrapper.find('[name="background_image"]').val());

		});

		//background type switcher
		$modalWrapper.find('[name="background_type"]').change(function() {

			if(this.value == 'image') {
				$modalWrapper.find('[name="background_image"]').parents('tr:first').show();
				$modalWrapper.find('[name="background_color"]').parents('tr:first').hide();
			}
			else {
				$modalWrapper.find('[name="background_image"]').parents('tr:first').hide();
				$modalWrapper.find('[name="background_color"]').parents('tr:first').show();
			}

		});

		//bounding box switcher
		$('[name="designs_parameter_bounding_box_control"], [name="custom_texts_parameter_bounding_box_control"]').change(function() {

			var $this = $(this),
				$tbody = $this.parents('tbody');

			$tbody.find('.custom-bb, .target-bb').hide().addClass('no-serialization');
			if(this.value != '') {
				$tbody.find('.'+$this.find(":selected").data('class')).show().removeClass('no-serialization');
			}


		});

		$('#fpd-set-background-image').click(function(evt) {

			evt.preventDefault();

			if (mediaUploader) {
	            mediaUploader.open();
	            return;
	        }

	        mediaUploader = wp.media({
	            title: '<?php _e( 'Choose a background image', 'radykal' ); ?>',
	            multiple: false
	        });

	        mediaUploader.on('select', function() {

				backgroundImage = mediaUploader.state().get('selection').toJSON()[0].url;
				$modalWrapper.find('[name="background_image"]').val(backgroundImage);
				$modalWrapper.find('#fpd-background-image-preview').attr('src', backgroundImage);

			});

			mediaUploader.open();

		});

		$modalWrapper.on('click', '.fpd-save-modal', function(evt) {

			evt.preventDefault();

			var $formFields = $modalWrapper.find('input[type="number"],input[type="text"],input[type="hidden"],input[type="radio"]:checked,select,input[type="checkbox"]:checked').filter(':not(.no-serialization)'),
				serializedStr = JSON.stringify(fpdSerializeObject($formFields));

			$('[name="fpd_product_settings"]').val(serializedStr);

			closeModal($modalWrapper);

		});

	});

</script>