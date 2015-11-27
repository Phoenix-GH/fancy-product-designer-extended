<div class="fpd-modal-wrapper" id="fpd-modal-edit-options">
	<div class="fpd-modal-dialog">
		<a href="#" class="fpd-close-modal">&times;</a>
		<h2><?php _e('Options', 'radykal'); ?></h2>
		<p class="description"><?php _e('Here you can set custom options for all designs in a single category or for every design element separately.', 'radykal'); ?></p>
		<div class="fpd-modal-content">

			<!-- Only for single designs to set a custom thumbnail -->
			<div id="fpd-set-design-thumbnail-wrapper">
				<table class="form-table radykal-settings-form">
					<tbody>
						<tr valign="top">
							<th scope="row">
								<?php _e('Design Thumbnail', 'radykal'); ?>
							</th>
							<td class="fpd-clearfix">
								<a href="#" id="fpd-set-design-thumbnail" class="add-new-h2"><?php _e('Set Design Thumbnail', 'radykal'); ?></a>
								<img src="" id="fpd-design-thumbnail" />
								<a href="#" id="fpd-remove-design-thumbnail" class="fpd-icon-btn"><i class="fpd-admin-icon-close"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
				<br />
			</div>

			<form>
				<p>
					<label>
						<input type="checkbox" value="1" name="enabled" /> <strong><?php _e('Enable Options', 'radykal'); ?></strong>
					</label>
				</p>
				<table class="form-table radykal-settings-form">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('X-Position', 'radykal'); ?></label></th>
							<td><input type="number" step="1" min="0" value="0" style="width:50px;" name="x" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Y-Position', 'radykal'); ?></label></th>
							<td><input type="number" step="1" min="0" value="0" style="width:50px;" name="y" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Z-Position', 'radykal'); ?></label></th>
							<td><input type="number" step="1" min="-1" value="-1" style="width:50px;" name="z" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Scale', 'radykal'); ?></label></th>
							<td><input type="number" style="width:50px;" name="scale" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Color(s)', 'radykal'); ?></label></th>
							<td><input type="text" value="" style="width:300px;" name="colors" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Price', 'radykal'); ?></label></th>
							<td><input type="number" step="1" min="0" value="0" style="width:50px;" name="price" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Auto-Center', 'radykal'); ?></label></th>
							<td>
								<input type="hidden" value="0" name="autoCenter" />
								<input type="checkbox" value="1" name="autoCenter" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Draggable', 'radykal'); ?></label></th>
							<td>
								<input type="hidden" value="0" name="draggable" />
								<input type="checkbox" value="1" name="draggable" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Rotatable', 'radykal'); ?></label></th>
							<td>
								<input type="hidden" value="0" name="rotatable" />
								<input type="checkbox" value="1" name="rotatable" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Resizable', 'radykal'); ?></label></th>
							<td>
								<input type="hidden" value="0" name="resizable" />
								<input type="checkbox" value="1" name="resizable" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Replace', 'radykal'); ?></label></th>
							<td>
								<input type="text" value="" name="replace" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Auto-Select', 'radykal'); ?></label></th>
							<td>
								<input type="hidden" value="0" name="autoSelect" />
								<input type="checkbox" value="1" name="autoSelect" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Stay On Top', 'radykal'); ?></label></th>
							<td>
								<input type="hidden" value="0" name="topped" />
								<input type="checkbox" value="1" name="topped" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Bounding Box', 'radykal'); ?></label></th>
							<td>
								<select name="bounding_box_control">
									<option value="0" data-class="custom-bb"><?php _e( 'Custom Bounding Box', 'radykal' ); ?></option>
									<option value="1" data-class="target-bb"><?php _e( 'Use another element as bounding box', 'radykal' ); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box X-Position', 'radykal'); ?></label></th>
							<td><input type="number" name="bounding_box_x" min="0" step="1" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Y-Position', 'radykal'); ?></label></th>
							<td><input type="number" name="bounding_box_y" min="0" step="1" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Width', 'radykal'); ?></label></th>
							<td><input type="number" name="bounding_box_width" min="0" step="1" value=""></td>
						</tr>
						<tr valign="top" class="custom-bb">
							<th scope="row"><label><?php _e('Bounding Box Height', 'radykal'); ?></label></th>
							<td><input type="number" name="bounding_box_height" min="0" step="1" value=""></td>
						</tr>
						<tr valign="top" class="target-bb">
							<th scope="row"><label><?php _e('Bounding Box Target', 'radykal'); ?></label></th>
							<td><input type="text" name="bounding_box_by_other" value=""></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label><?php _e('Bounding Box Clipping', 'radykal'); ?></label></th>
							<td>
								<input type="hidden" value="0" name="boundingBoxClipping" />
								<input type="checkbox" value="1" name="boundingBoxClipping" />
							</td>
						</tr>

					</tbody>
				</table>
			</form>
			<div>
			<button class="button button-primary fpd-save-modal"><?php _e('Set', 'radykal'); ?></button>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	//scripts to use it for fpd and mspc
	jQuery(document).ready(function($) {

		var mediaUploader = null,
			$modalWrapper = $('#fpd-modal-edit-options');

		//enable/disable form
		$('#fpd-modal-edit-options').on('change', 'input[name="enabled"]', function() {

			var $this = $(this),
				$allInputs = $this.parents('.fpd-modal-content:first').find('table').find('input,select');

			if($this.is(':checked')) {
				$this.val(1);
				$allInputs.attr('disabled', false);
			}
			else {
				$this.val(0);
				$allInputs.attr('disabled', true);
			}

		});

		//set the thumbnail for a design in the modal parameters form
		$modalWrapper.on('click', '#fpd-set-design-thumbnail', function(evt) {

			if (mediaUploader) {
	            mediaUploader.open();
	            return;
	        }

	        mediaUploader = wp.media({
	            title: 'Choose Thumbnail',
	            multiple: true
	        });

			mediaUploader.on('select', function() {

				var imgUrl = mediaUploader.state().get('selection').toJSON()[0].url
				$('#fpd-design-thumbnail').attr('src', imgUrl).show();

	        });

	        mediaUploader.open();

	        evt.preventDefault();

		});

		$modalWrapper.on('click', '#fpd-remove-design-thumbnail', function(evt) {

			evt.preventDefault();
			$('#fpd-design-thumbnail').attr('src', '').hide();

		});

	});

</script>