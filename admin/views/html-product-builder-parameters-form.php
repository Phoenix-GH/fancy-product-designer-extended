<div class="fpd-form-tabs fpd-clearfix">
	<a href="general-options" class="fpd-active"><?php _e('General', 'radykal'); ?></a>
	<a href="modifications-options"><?php _e('Modifications', 'radykal'); ?></a>
	<a href="bb-options"><?php _e('Bounding Box', 'radykal'); ?></a>
	<a href="text-options" class="only-for-text-elements"><?php _e('Text', 'radykal'); ?></a>
	<a href="upload-zone-options" class="only-for-upload-zones"><?php _e('Media Types', 'radykal'); ?></a>
</div>

<form role="form" id="fpd-elements-form" class="">

	<!-- Hidden inputs for parameters set are set to true by default -->
	<input type="hidden" name="editable" value="0" />
	<input type="checkbox" name="locked" value="1" class="fpd-hidden" />
	<input type="checkbox" name="uploadZone" value="1" class="fpd-hidden" />

	<div class="fpd-form-tabs-content">

		<!-- General Options -->
		<table class="form-table fpd-active" id="general-options">
			<tbody>
				<tr>
					<th><?php _e('Position', 'radykal'); ?>:</th>
					<td>
						<label><?php _e('x', 'radykal'); ?>=<input type="text" name="x" size="3" placeholder="0" style="margin-right: 15px;" class="fpd-only-numbers"></label>
						<label><?php _e('y', 'radykal'); ?>=<input type="text" name="y" size="3" placeholder="0" class="fpd-only-numbers"></label>
					</td>
				</tr>
				<tr>
					<th><?php _e('Scale', 'radykal'); ?>:</th>
					<td>
						<input type="text" name="scale" size="3" placeholder="1" class="fpd-only-numbers fpd-allow-dots">
					</td>
				</tr>
				<tr>
					<th><?php _e('Angle', 'radykal'); ?>:</th>
					<td>
						<input type="text" name="angle" size="3" placeholder="0" class="fpd-only-numbers">
					</td>
				</tr>
				<tr>
					<th><?php _e('Price', 'radykal'); ?>:</th>
					<td>
						<input type="text" name="price" size="3" placeholder="0" class="fpd-prevent-whitespace fpd-only-numbers fpd-allow-dots">
						<i class="fpd-admin-icon-info-outline fpd-admin-tooltip" title="<?php _e('Always use a dot as the decimal separator!', 'radykal'); ?>"></i>
					</td>
				</tr>
				<tr>
					<th><?php _e('Replace', 'radykal'); ?>:</th>
					<td>
						<input type="text" name="replace" value="" class="input-sm">
						<i class="fpd-admin-icon-info-outline fpd-admin-tooltip" title="<?php _e('Elements with the same replace name will replace each other.', 'radykal'); ?>"></i>
					</td>
				</tr>
				<tr class="fpd-color-options">
					<th><?php _e('Colors', 'radykal'); ?>:</th>
					<td>
						<?php if($fancy_view->get_data()->view_order && $fancy_view->get_data()->view_order > 0) : ?>
						<label class="checkbox-inline" style="margin-bottom: 15px;">
							<input type="checkbox" name="color_control" value="1"> <?php _e('Enable Color Control', 'radykal'); ?>
							<i class="fpd-admin-icon-info-outline fpd-admin-tooltip" title="<?php _e('To change the color of this element as soon as the color of an element in first view changes, you can enter a title of an element in the first view. This operation works only with PNG images that are NOT in the first view.', 'radykal'); ?>"></i>
						</label>
						<input type="text" name="color_control_title" class="widefat fpd-color-control-fields" placeholder="<?php _e('Enter the title of an image element in the first view!', 'radykal') ; ?>" />
						<?php endif; ?>
						<div id="fpd-color-inputs">
							<input type="text" name="colors" class="tm-input" placeholder="<?php _e('e.g. #000000,#ffffff', 'radykal') ; ?>" size="20" />
							<a href="#" class="button button-secondary" id="fpd-add-color"><?php _e('Add', 'radykal') ; ?></a>
							<i class="fpd-admin-icon-info-outline fpd-admin-tooltip" title="<?php _e('One color value: Colorpicker, Multiple color values: Fixed color palette', 'radykal'); ?>"></i>
						</div>
					</td>
				</tr>
				<tr class="fpd-color-options">
					<th><?php _e('Current Color', 'radykal'); ?>:</th>
					<td>
						<input type="text" name="currentColor" placeholder="<?php _e('e.g. #000000', 'radykal') ; ?>" size="12" />
						<i class="fpd-admin-icon-info-outline fpd-admin-tooltip" title="<?php _e('Enter one hexadecimal color to change the initial color of this element.', 'radykal'); ?>"></i>
					</td>
				</tr>
				<tr>
					<th><?php _e('Opacity', 'radykal'); ?>:</th>
					<td>
						<input type="text" name="opacity" size="3" placeholder="1" class="fpd-only-numbers fpd-allow-dots">
						<i class="fpd-admin-icon-info-outline fpd-admin-tooltip" title="<?php _e('A value between 0-1', 'radykal'); ?>"></i>
					</td>
				</tr>
				<tr>
					<th><?php _e('X-Axis Reference Point', 'radykal'); ?></th>
					<td>
						<span class="fpd-originX">
							<a href="#" class="fpd-originX-left button" data-value="left"><i class="fpd-admin-icon-originX-left"></i></a>
							<a href="#" class="fpd-originX-center button" data-value="center"><i class="fpd-admin-icon-originX-center"></i></a>
							<a href="#" class="fpd-originX-right button" data-value="right"><i class="fpd-admin-icon-originX-right"></i></a>
							<input type="hidden" name="originX" value="center" />
						</span>
					</td>
				</tr>
			</tbody>
		</table>

		<!-- Modifications Options -->
		<table class="form-table" id="modifications-options">
			<tbody>
				<tr>
					<th><label for="opt-removable"><?php _e('Removable', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="removable" id="opt-removable" value="1">
					</td>
				</tr>
				<tr>
					<th><label for="opt-draggable"><?php _e('Draggable', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="draggable" id="opt-draggable" value="1">
					</td>
				</tr>
				<tr>
					<th><label for="opt-rotatable"><?php _e('Rotatable', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="rotatable" id="opt-rotatable" value="1">
					</td>
				</tr>
				<tr>
					<th><label for="opt-resizable"><?php _e('Resizable', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="resizable" id="opt-resizable" value="1">
					</td>
				</tr>
				<tr>
					<th><label for="opt-zChangeable"><?php _e('Unlock Layer Position', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="zChangeable" id="opt-zChangeable" value="1">
					</td>
				</tr>
				<tr>
					<th><label for="opt-topped"><?php _e('Stay On Top', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="topped" id="topped" value="1">
					</td>
				</tr>
				<tr>
					<th><label for="opt-autoSelect"><?php _e('Auto-Select', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="autoSelect" id="opt-autoSelect" value="1">
					</td>
				</tr>
			</tbody>
		</table>

		<!-- Bounding Box Options -->
		<table class="form-table" id="bb-options">
			<tbody>
				<tr>
					<th><label for="opt-bounding_box_control"><?php _e('Use another element as bounding box', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="bounding_box_control" id="opt-bounding_box_control" value="1">
					</td>
				</tr>
				<tr>
					<th><?php _e('Define Bounding Box', 'radykal'); ?></th>
					<td>
						<div id="boundig-box-params">
							<label><?php _e('x', 'radykal'); ?>:</label><input type="text" name="bounding_box_x" size="3" placeholder="0" style="margin-right: 15px;">
							<label><?php _e('y', 'radykal'); ?>:</label><input type="text" name="bounding_box_y" size="3" placeholder="0">
							<label><?php _e('width', 'radykal'); ?>:</label><input type="text" name="bounding_box_width" size="3" placeholder="0" style="margin-right: 15px;">
							<label><?php _e('height', 'radykal'); ?>:</label><input type="text" name="bounding_box_height" size="3" placeholder="0">
						</div>
						<input type="text" name="bounding_box_by_other" class="widefat input-sm" placeholder="<?php _e('Title of an image element in the same view.', 'radykal'); ?>" style="display: none;" />
					</td>
				</tr>
				<tr>
					<th><label for="opt-boundingBoxClipping"><?php _e('Clip element into bounding box', 'radykal'); ?></label></th>
					<td>
						<input type="checkbox" name="boundingBoxClipping" id="opt-boundingBoxClipping" value="1">
					</td>
				</tr>

			</tbody>
		</table>

		<!-- Text Options -->
		<table class="form-table" id="text-options">
			<tbody>
				<tr>
					<th><?php _e('Font', 'radykal'); ?></th>
					<td>
						<select name="font" data-placeholder="<?php _e('Select a font', 'radykal'); ?>" class="fpd-font-changer radykal-select2" style="width: 100%">
							<?php
							foreach(FPD_Fonts::get_enabled_fonts() as $font) {
								echo "<option value='$font' style='font-family: $font;'>$font</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th><?php _e('Styling', 'radykal'); ?></th>
					<td>
						<span class="fpd-text-styling" style="margin-right: 20px;">
							<a href="#" class="fpd-bold button"><i class="fpd-admin-icon-format-bold"></i></a>
							<a href="#" class="fpd-italic button"><i class="fpd-admin-icon-format-italic"></i></a>
							<a href="#" class="fpd-underline button"><i class="fpd-admin-icon-format-underline"></i></a>
							<input type="checkbox" name="fontWeight" value="bold" class="fpd-hidden" />
							<input type="checkbox" name="fontStyle" value="italic" class="fpd-hidden" />
							<input type="checkbox" name="textDecoration" value="underline" class="fpd-hidden" />
						</span>
					</td>
				</tr>
				<tr>
					<th><?php _e('Multiline Alignment', 'radykal'); ?></th>
					<td>
						<span class="fpd-text-align">
							<a href="#" class="fpd-align-left button" data-value="left"><i class="fpd-admin-icon-format-align-left"></i></a>
							<a href="#" class="fpd-align-center button" data-value="center"><i class="fpd-admin-icon-format-align-center"></i></a>
							<a href="#" class="fpd-align-right button" data-value="right"><i class="fpd-admin-icon-format-align-right"></i></a>
							<input type="hidden" name="textAlign" value="left" />
						</span>
					</td>
				</tr>
				<tr>
					<th><?php _e('Maximum Characters', 'radykal'); ?></th>
					<td><input type="text" name="maxLength" size="3" placeholder="0" class="fpd-only-numbers"></td>
				</tr>
				<tr>
					<th><?php _e('Line Height', 'radykal'); ?></th>
					<td><input type="text" name="lineHeight" size="3" placeholder="1" class="fpd-only-numbers fpd-allow-dots"></td>
				</tr>
				<tr>
					<th>
						<label for="opt-editable"><?php _e('Editable', 'radykal'); ?></label>
					</th>
					<td>
						<input type="checkbox" name="editable" id="opt-editable" value="1">
					</td>
				</tr>
				<tr>
					<th>
						<label for="opt-patternable"><?php _e('Patternable', 'radykal'); ?></label>
					</th>
					<td>
						<input type="checkbox" name="patternable" id="opt-patternable" value="1">
					</td>
				</tr>
				<tr>
					<th>
						<label for="opt-curvable"><?php _e('Curvable', 'radykal'); ?></label>
					</th>
					<td>
						<input type="checkbox" name="curvable" id="opt-curvable" value="1">
						<i class="fpd-admin-icon-info-outline fpd-admin-tooltip" title="<?php _e('Allow customer to switch between curvable and normal text.', 'radykal'); ?>"></i>
					</td>
				</tr>
				<tr class="fpd-curved-text-opts">
					<th>
						<?php _e('Curved Text Spacing', 'radykal'); ?>
					</th>
					<td>
						<input type="checkbox" name="curved" value="1" class="fpd-hidden">
						<input type="text" name="curveSpacing" size="3" placeholder="10" class="fpd-only-numbers">
					</td>
				</tr>
				<tr class="fpd-curved-text-opts">
					<th>
						<?php _e('Curved Text Radius', 'radykal'); ?>
					</th>
					<td>
						<input type="text" name="curveRadius" size="3" placeholder="80" class="fpd-only-numbers">
					</td>
				</tr>
				<tr class="fpd-curved-text-opts">
					<th>
						<label for="opt-curveReverse"><?php _e('Curved Text Reverse', 'radykal'); ?></label>
					</th>
					<td>
						<input type="checkbox" name="curveReverse" id="opt-curveReverse" value="1">
					</td>
				</tr>
			</tbody>
		</table>

		<!-- Upload Zone Options -->
		<table class="form-table" id="upload-zone-options">
			<tbody>
				<tr>
					<th><label><?php _e('Image Uploads', 'radykal'); ?></label></th>
					<td class="radio-group">
						<label><input type="radio" name="adds_uploads" value="1"><?php _e('Yes', 'radykal'); ?></label>
						<label><input type="radio" name="adds_uploads" value="0"><?php _e('No', 'radykal'); ?></label>
					</td>
				</tr>
				<tr>
					<th><label><?php _e('Custom Texts', 'radykal'); ?></label></th>
					<td class="radio-group">
						<label><input type="radio" name="adds_texts" value="1"><?php _e('Yes', 'radykal'); ?></label>
						<label><input type="radio" name="adds_texts" value="0"><?php _e('No', 'radykal'); ?></label>
					</td>
				</tr>
				<tr>
					<th><label><?php _e('Designs', 'radykal'); ?></label></th>
					<td class="radio-group">
						<label><input type="radio" name="adds_designs" value="1"><?php _e('Yes', 'radykal'); ?></label>
						<label><input type="radio" name="adds_designs" value="0"><?php _e('No', 'radykal'); ?></label>
					</td>
				</tr>
				<tr>
					<th><label><?php _e('Facebook Photos', 'radykal'); ?></label></th>
					<td class="radio-group">
						<label><input type="radio" name="adds_facebook" value="1"><?php _e('Yes', 'radykal'); ?></label>
						<label><input type="radio" name="adds_facebook" value="0"><?php _e('No', 'radykal'); ?></label>
					</td>
				</tr>
				<tr>
					<th><label><?php _e('Instagram Photos', 'radykal'); ?></label></th>
					<td class="radio-group">
						<label><input type="radio" name="adds_instagram" value="1"><?php _e('Yes', 'radykal'); ?></label>
						<label><input type="radio" name="adds_instagram" value="0"><?php _e('No', 'radykal'); ?></label>
					</td>
				</tr>
			</tbody>
		</table>

	</div>

</form>