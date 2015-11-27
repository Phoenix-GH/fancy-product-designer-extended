<?php

//main bar
$layers_btn = isset($_POST['layersButton']) ? $_POST['layersButton'] : 'Manage Layers';
$adds_btn = isset($_POST['addsButton']) ? $_POST['addsButton'] : 'Add Something';
$products_btn = isset($_POST['productsButton']) ? $_POST['productsButton'] : 'Change Products';
$more_btn = isset($_POST['moreButton']) ? $_POST['moreButton'] : 'Actions';
$download_image = isset($_POST['downloadImage']) ? $_POST['downloadImage'] : 'Download Image';
$print = isset($_POST['print']) ? $_POST['print'] : 'Print';
$pdf = isset($_POST['downLoadPDF']) ? $_POST['downLoadPDF'] : 'Download PDF';
$save_product = isset($_POST['saveProduct']) ? $_POST['saveProduct'] : 'Save';
$load_saved_products = isset($_POST['loadProduct']) ? $_POST['loadProduct'] : 'Load';

//sub bar
$undo_btn = isset($_POST['undoButton']) ? $_POST['undoButton'] : 'Undo';
$redo_btn = isset($_POST['redoButton']) ? $_POST['redoButton'] : 'Redo';
$reset_product_btn = isset($_POST['resetProductButton']) ? $_POST['resetProductButton'] : 'Reset Button';
$zoom_btn = isset($_POST['zoomButton']) ? $_POST['zoomButton'] : 'Zoom';
$pan_btn = isset($_POST['panButton']) ? $_POST['panButton'] : 'Pan';

//adds
$add_image_btn = isset($_POST['addImageButton']) ? $_POST['addImageButton'] : 'Add your own Image';
$add_text_btn = isset($_POST['addTextButton']) ? $_POST['addTextButton'] : 'Add your own text';
$enter_text = isset($_POST['enterText']) ? $_POST['enterText'] : 'Enter your text';
$add_fb_btn = isset($_POST['addFBButton']) ? $_POST['addFBButton'] : 'Add photo from facebook';
$add_insta_btn = isset($_POST['addInstaButton']) ? $_POST['addInstaButton'] : 'Add photo from instagram';
$add_design_btn = isset($_POST['addDesignButton']) ? $_POST['addDesignButton'] : 'Choose from Designs';

//Fill Options
$fill_options = isset($_POST['fillOptions']) ? $_POST['fillOptions'] : 'Fill Options';
$color = isset($_POST['color']) ? $_POST['color'] : 'Color';
$patterns = isset($_POST['patterns']) ? $_POST['patterns'] : 'Patterns';
$opacity = isset($_POST['opacity']) ? $_POST['opacity'] : 'Opacity';
//Filter Options
$filter = isset($_POST['filter']) ? $_POST['filter'] : 'Filter';
//Text Options
$text_options = isset($_POST['textOptions']) ? $_POST['textOptions'] : 'Text Options';
$change_text = isset($_POST['changeText']) ? $_POST['changeText'] : 'Change Text';
$typeface = isset($_POST['typeface']) ? $_POST['typeface'] : 'Typeface';
$line_height = isset($_POST['lineHeight']) ? $_POST['lineHeight'] : 'Line Height';
$text_align = isset($_POST['textAlign']) ? $_POST['textAlign'] : 'Alignment';
$text_align_left = isset($_POST['textAlignLeft']) ? $_POST['textAlignLeft'] : 'Align Left';
$text_align_center = isset($_POST['textAlignCenter']) ? $_POST['textAlignCenter'] : 'Align Center';
$text_align_right = isset($_POST['textAlignRight']) ? $_POST['textAlignRight'] : 'Align Right';
$text_styling = isset($_POST['textStyling']) ? $_POST['textStyling'] : 'Styling';
$bold = isset($_POST['bold']) ? $_POST['bold'] : 'Bold';
$italic = isset($_POST['italic']) ? $_POST['italic'] : 'Italic';
$underline = isset($_POST['underline']) ? $_POST['underline'] : 'Underline';
//Curved Text Options
$curved_text = isset($_POST['curvedText']) ? $_POST['curvedText'] : 'Curved Text';
$curved_text_spacing = isset($_POST['curvedTextSpacing']) ? $_POST['curvedTextSpacing'] : 'Spacing';
$curved_text_radius = isset($_POST['curvedTextRadius']) ? $_POST['curvedTextRadius'] : 'Radius';
$curved_text_reverse = isset($_POST['curvedTextReverse']) ? $_POST['curvedTextReverse'] : 'Reverse';
//Transform Options
$transform = isset($_POST['transform']) ? $_POST['transform'] : 'Transform';
$angle = isset($_POST['angle']) ? $_POST['angle'] : 'Angle';
$scale = isset($_POST['scale']) ? $_POST['scale'] : 'Scale';
//Helper Buttons
$move_up = isset($_POST['moveUp']) ? $_POST['moveUp'] : 'Move Up';
$move_down = isset($_POST['moveDown']) ? $_POST['moveDown'] : 'Move Down';
$center_h = isset($_POST['centerH']) ? $_POST['centerH'] : 'Center Horizontal';
$center_v = isset($_POST['centerV']) ? $_POST['centerV'] : 'Center Vertical';
$flip_horizontal = isset($_POST['flipHorizontal']) ? $_POST['flipHorizontal'] : 'Flip Horizontal';
$flip_vertical = isset($_POST['flipVertical']) ? $_POST['flipVertical'] : 'Flip Vertical';
$reset_element = isset($_POST['resetElement']) ? $_POST['resetElement'] : 'Reset To His Origin';

//facebook
$fb_select_album = isset($_POST['fbSelectAlbum']) ? $_POST['fbSelectAlbum'] : 'Select an album';

//instagram
$insta_feed_button = isset($_POST['instaFeedButton']) ? $_POST['instaFeedButton'] : 'My Feed';
$insta_recent_images_button = isset($_POST['instaRecentImagesButton']) ? $_POST['instaRecentImagesButton'] : 'My Recent Images';


?>

<!-- MAIN BAR -->
<section class="fpd-main-bar fpd-clearfix fpd-primary-bg-color">

	<!-- Left -->
	<div class="fpd-left">
		<div class="fpd-btn fpd-primary-text-color" data-context="layers">
			<i class="fpd-icon-layers"></i><span><?php echo $layers_btn; ?></span>
		</div>
		<div class="fpd-btn fpd-primary-text-color" data-context="adds">
			<i class="fpd-icon-add"></i><span><?php echo $adds_btn; ?></span>
		</div>
		<div class="fpd-btn fpd-primary-text-color" data-context="products">
			<i class="fpd-icon-product"></i><span><?php echo $products_btn; ?></span>
		</div>
	</div>

	<!-- Right -->
	<div class="fpd-right">
		<div class="fpd-more fpd-btn fpd-dropdown" >
			<i class="fpd-icon-more fpd-tooltip fpd-primary-text-color" title="<?php echo $more_btn; ?>"></i>
			<div class="fpd-dropdown-menu fpd-shadow-1  fpd-scale-tr">
				<span class="fpd-download-image fpd-btn"><?php echo $download_image; ?></span>
				<span class="fpd-save-pdf fpd-btn"><?php echo $pdf; ?></span>
				<span class="fpd-print fpd-btn"><?php echo $print; ?></span>
				<span class="fpd-save-product fpd-btn"><?php echo $save_product; ?></span>
				<span class="fpd-load-saved-products fpd-btn"><?php echo $load_saved_products; ?></span>
			</div>
			<a href="" download="" target="_blank" class="fpd-download-anchor" style="display: none;"></a> <!-- Hidden anchor -->
		</div>

	</div>
</section>

<!-- SUB-BAR -->
<section class="fpd-sub-bar fpd-clearfix">

	<!-- Left -->
	<div class="fpd-left">
		<div class="fpd-undo fpd-btn fpd-disabled fpd-tooltip" title="<?php echo $undo_btn; ?>">
			<i class="fpd-icon-undo"></i>
		</div>
		<div class="fpd-redo fpd-btn fpd-disabled fpd-tooltip" title="<?php echo $redo_btn; ?>">
			<i class="fpd-icon-redo"></i>
		</div>
		<div class="fpd-reset-product fpd-btn fpd-tooltip" title="<?php echo $reset_product_btn; ?>">
			<i class="fpd-icon-reset"></i>
		</div>
	</div>

	<!-- Right -->
	<div class="fpd-right">
		<div class="fpd-zoom fpd-option-group">
			<div class="fpd-btn fpd-tooltip" title="<?php echo $zoom_btn; ?>">
				<i class="fpd-icon-zoom-in"></i>
			</div>
			<div class="fpd-option-content">
				<div data-value="1" data-min="1" data-max="3" data-step="0.02" class="fpd-set-zoom fpd-slider"></div>
				<div class="fpd-stage-pan fpd-btn fpd-tooltip" title="<?php echo $pan_btn; ?>">
					<i class="fpd-icon-drag"></i>
				</div>
			</div>
		</div>
	</div>

</section>

<!-- MAIN CONTAINER -->
<section class="fpd-main-container">

	<!-- Product Stage -->
	<div class="fpd-product-stage">
		<canvas></canvas>
		<div class="fpd-element-tooltip"></div>
	</div>

	<!-- Context Dialog -->
	<div class="fpd-context-dialog fpd-shadow-2 fpd-columns-3" data-columns="3">
		<nav class="fpd-dialog-head fpd-clearfix fpd-primary-bg-color fpd-primary-text-color">
			<div class="fpd-left fpd-dialog-drag-handle">
				<div><i class="fpd-icon-drag"></i><span class="fpd-dialog-title"></span></div>
			</div>
			<div class="fpd-right">
				<div class="fpd-content-back fpd-btn">
					<i class="fpd-icon-back"></i>
				</div>
				<div class="fpd-close-dialog fpd-btn">
					<i class="fpd-icon-close"></i>
				</div>
			</div>
		</nav>
		<div class="fpd-dialog-content">

			<!-- Manage Layers -->
			<div class="fpd-content-layers">
				<div class="fpd-list"></div>
			</div>

			<!-- Edit Element -->
			<div class="fpd-content-edit">
				<div class="fpd-list">

					<!-- Fill Options -->
					<div class="fpd-fill-options fpd-head-options fpd-list-row">
						<div class="fpd-cell-full">
							<label><?php echo $fill_options; ?></label>
						</div>
					</div>
					<div class="fpd-fill-options fpd-sub-option fpd-list-row fpd-color-option">
						<div class="fpd-cell-0">
							<label><?php echo $color; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div class="fpd-color-picker">
								<input type="text" value="">
							</div>
						</div>
					</div>
					<div class="fpd-fill-options fpd-sub-option fpd-list-row fpd-patterns-option">
						<div class="fpd-cell-0">
							<label><?php echo $patterns; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div class="fpd-patterns">
								<div class="fpd-grid fpd-grid-contain"></div>
							</div>
						</div>
					</div>
					<div class="fpd-fill-options fpd-sub-option fpd-list-row fpd-opacity-option">
						<div class="fpd-cell-0">
							<label><?php echo $opacity; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div data-value="0.5" data-min="0" data-max="1" data-step="0.01" class="fpd-opacity-slider fpd-slider"></div>
							</div>
						</div>
					</div>

					<!-- Filter Options -->
					<div class="fpd-filter-options fpd-head-options fpd-list-row">
						<div class="fpd-cell-0">
							<label><?php echo $filter; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div class="fpd-grid fpd-grid-cover">
								<div class="fpd-filter-no fpd-item" data-filter="no"><picture></picture></div>
								<div class="fpd-filter-grayscale fpd-item" data-filter="grayscale"><picture></picture></div>
								<div class="fpd-filter-sepia fpd-item" data-filter="sepia"><picture></picture></div>
								<div class="fpd-filter-sepia2 fpd-item" data-filter="sepia2"><picture></picture></div>
							</div>
						</div>
					</div>

					<!-- Text Options -->
					<div class="fpd-text-options fpd-head-options fpd-list-row">
						<div class="fpd-cell-full">
							<label><?php echo $text_options; ?></label>
						</div>
					</div>
					<div class="fpd-text-options fpd-sub-option fpd-list-row fpd-text-option">
						<div class="fpd-cell-0">
							<label><?php echo $change_text; ?></label>
						</div>
						<div class="fpd-cell-1">
							<textarea class="fpd-change-text fpd-border-color"></textarea>
						</div>
					</div>
					<div class="fpd-text-options fpd-sub-option fpd-list-row fpd-typeface-option">
						<div class="fpd-cell-0">
							<label><?php echo $typeface; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<select class="fpd-fonts-dropdown"></select>
							</div>
						</div>
					</div>
					<div class="fpd-text-options fpd-sub-option fpd-list-row fpd-lineHeight-option">
						<div class="fpd-cell-0">
							<label><?php echo $line_height; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div data-value="1" data-min="0.1" data-max="10" data-step="0.1" class="fpd-line-height-slider fpd-slider"></div>
							</div>
						</div>
					</div>
					<div class="fpd-text-options fpd-sub-option fpd-list-row fpd-textAlignment-option">
						<div class="fpd-cell-0">
							<label><?php echo $text_align; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div class="fpd-set-alignment">
								<span title="<?php echo $text_align_left; ?>" class="fpd-text-align-left fpd-btn fpd-tooltip"><i class=" fpd-icon-format-align-left"></i></span>
								<span title="<?php echo $text_align_center; ?>" class="fpd-text-align-center fpd-btn fpd-tooltip"><i class=" fpd-icon-format-align-center"></i></span>
								<span title="<?php echo $text_align_right; ?>" class="fpd-text-align-right fpd-btn fpd-tooltip"><i class=" fpd-icon-format-align-right"></i></span>
							</div>

						</div>
					</div>
					<div class="fpd-text-options fpd-sub-option fpd-list-row fpd-textStyle-option">
						<div class="fpd-cell-0">
							<label><?php echo $text_styling; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div class="fpd-set-style">
								<span title="<?php echo $bold; ?>" class="fpd-text-style-bold fpd-btn fpd-tooltip"><i class=" fpd-icon-format-bold"></i></span>
								<span title="<?php echo $italic; ?>" class="fpd-text-style-italic fpd-btn fpd-tooltip"><i class=" fpd-icon-format-italic"></i></span>
								<span title="<?php echo $underline; ?>" class="fpd-text-style-underline fpd-btn fpd-tooltip"><i class=" fpd-icon-format-underline"></i></span>
							</div>
						</div>
					</div>

					<!-- Curved Text Options -->
					<div class="fpd-text-options fpd-curved-text-options fpd-sub-option fpd-list-row">
						<div class="fpd-cell-0">
							<label><?php echo $curved_text; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div class="fpd-curved-text-switcher fpd-switch-container">
									<div class="fpd-switch-bar"></div>
									<div class="fpd-switch-toggle"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="fpd-text-options fpd-curved-text-options fpd-sub-option fpd-sub-2 fpd-list-row">
						<div class="fpd-cell-0">
							<label><?php echo $curved_text_radius; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div data-value="100" data-min="0" data-max="200" data-step="1" class="fpd-curved-text-radius-slider fpd-slider"></div>
							</div>
						</div>
					</div>
					<div class="fpd-text-options fpd-curved-text-options fpd-sub-option fpd-sub-2 fpd-list-row">
						<div class="fpd-cell-0">
							<label><?php echo $curved_text_spacing; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div data-value="50" data-min="0" data-max="100" data-step="1" class="fpd-curved-text-spacing-slider fpd-slider"></div>
							</div>
						</div>
					</div>
					<div class="fpd-text-options fpd-curved-text-options fpd-sub-option fpd-sub-2 fpd-list-row">
						<div class="fpd-cell-0">
							<label><?php echo $curved_text_reverse; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div class="fpd-curved-text-reverse-switcher fpd-switch-container">
									<div class="fpd-switch-bar"></div>
									<div class="fpd-switch-toggle"></div>
								</div>
							</div>
						</div>
					</div>

					<!-- Transform Options -->
					<div class="fpd-transform-options fpd-head-options fpd-list-row">
						<div class="fpd-cell-full">
							<label><?php echo $transform; ?></label>
						</div>
					</div>
					<div class="fpd-transform-options fpd-list-row fpd-sub-option fpd-angle-option">
						<div class="fpd-cell-0">
							<label><?php echo $angle; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div data-value="0" data-min="0" data-max="359" data-step="1" class="fpd-angle-slider fpd-slider"></div>
							</div>
						</div>
					</div>
					<div class="fpd-transform-options fpd-list-row fpd-sub-option fpd-scale-option">
						<div class="fpd-cell-0">
							<label><?php echo $scale; ?></label>
						</div>
						<div class="fpd-cell-1">
							<div>
								<div data-value="1" data-min="0" data-max="20" data-step="0.1" class="fpd-scale-slider fpd-slider"></div>
							</div>
						</div>
					</div>

					<!-- Helper Buttons -->
					<div class="fpd-helper-btns fpd-list-row">
						<div class="fpd-cell-full">
							<div>
								<span class="fpd-moveLayer-options">
									<span title="<?php echo $move_up; ?>" class="fpd-move-up fpd-btn fpd-tooltip">
										<i class="fpd-icon-move-up"></i>
									</span>
									<span title="<?php echo $move_down; ?>" class="fpd-move-down fpd-btn fpd-tooltip">
										<i class="fpd-icon-move-down"></i>
									</span>
								</span>
								<span class="fpd-alignment-options">
									<span title="<?php echo $center_h; ?>" class="fpd-center-horizontal fpd-btn fpd-tooltip">
										<i class="fpd-icon-align-horizontal"></i>
									</span>
									<span title="<?php echo $center_v; ?>" class="fpd-center-vertical fpd-btn fpd-tooltip">
										<i class="fpd-icon-align-vertical"></i>
									</span>
								</span>
								<span class="fpd-flip-options">
									<span title="<?php echo $flip_horizontal; ?>" class="fpd-flip-horizontal fpd-btn fpd-tooltip">
										<i class="fpd-icon-flip-horizontal"></i>
									</span>
									<span title="<?php echo $flip_vertical; ?>" class="fpd-flip-vertical fpd-btn fpd-tooltip">
										<i class="fpd-icon-flip-vertical "></i>
									</span>
								</span>
								<span title="<?php echo $reset_element; ?>" class="fpd-reset-element fpd-btn fpd-tooltip">
									<i class="fpd-icon-reset"></i>
								</span>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- Add Something -->
			<div class="fpd-content-adds">

				<!-- Choose add option -->
				<div class="fpd-choose-add">
					<div class="fpd-add-image fpd-btn-raised fpd-secondary-bg-color fpd-secondary-text-color">
						<i class="fpd-icon-file-upload"></i><span><?php echo $add_image_btn; ?></span>
					</div>
					<div class="fpd-add-text fpd-btn-raised fpd-secondary-bg-color fpd-secondary-text-color">
						<i class="fpd-icon-text-format"></i><span><?php echo $add_text_btn; ?></span>
						<div class="fpd-input-text fpd-clearfix fpd-trans">
							<input type="text" placeholder="<?php echo $enter_text; ?>" />
							<span class="fpd-btn"><i class="fpd-icon-done"></i></span>
						</div>
					</div>
					<div class="fpd-add-facebook-photo fpd-btn-raised fpd-secondary-bg-color fpd-secondary-text-color">
						<i class="fpd-icon-facebook"></i><span><?php echo $add_fb_btn; ?></span>
					</div>
					<div class="fpd-add-instagram-photo fpd-btn-raised fpd-secondary-bg-color fpd-secondary-text-color">
						<i class="fpd-icon-instagram"></i><span><?php echo $add_insta_btn; ?></span>
					</div>
					<div class="fpd-add-design fpd-btn-raised fpd-secondary-bg-color fpd-secondary-text-color">
						<i class="fpd-icon-design-library"></i><span><?php echo $add_design_btn; ?></span>
					</div>
					<form class="fpd-upload-form" style="display: block;">
						<input type="file" class="fpd-input-image" name="uploaded_file" style="position:absolute;left:-9999999px;visibility:hidden;"  />
					</form>

					<!-- Facebook Wrapper -->
					<div class="fpd-add-facebook-photo-wrapper fpd-content-sub" data-subContext="facebook">
						<div class="fpd-content-head fpd-clearfix">
							<fb:login-button data-max-rows="1" data-show-faces="false" data-scope="user_photos" autologoutlink="true"></fb:login-button>
							<select class="fpd-fb-user-albums" data-placeholder="<?php echo $fb_select_album; ?>">
							</select>
						</div>
						<div class="fpd-content-main">
							<div class="fpd-grid fpd-grid-cover fpd-photo-grid fpd-dynamic-columns"></div>
						</div>
					</div>

					<!-- Instagram Wrapper -->
					<div class="fpd-add-instagram-photo-wrapper fpd-content-sub" data-subContext="instagram">
						<div class="fpd-tabs fpd-primary-bg-color fpd-primary-text-color">
							<span class="fpd-insta-feed fpd-btn"><?php echo $insta_feed_button; ?></span>
							<span class="fpd-insta-recent-images fpd-btn"><?php echo $insta_recent_images_button; ?></span>
						</div>
						<div class="fpd-content-main">
							<div class="fpd-grid fpd-grid-cover fpd-photo-grid fpd-dynamic-columns"></div>

						</div>
						<span class="fpd-insta-load-next fpd-btn fpd-disabled">
								<i class="fpd-icon-more-horizontal"></i>
							</span>

					</div>

					<!-- Designs Wrapper -->
					<div class="fpd-add-design-wrapper fpd-content-sub" data-subContext="designs">
						<div class="fpd-content-head"></div>
						<div class="fpd-content-main">
							<div class="fpd-grid fpd-grid-contain fpd-padding fpd-dynamic-columns"></div>
						</div>
					</div>

				</div>

			</div>

			<!-- Products -->
			<div class="fpd-content-products">
				<div class="fpd-content-head"></div>
				<div class="fpd-content-main">
					<div class="fpd-grid fpd-grid-contain fpd-padding fpd-dynamic-columns"></div>
				</div>
			</div>

			<!-- Saved Products -->
			<div class="fpd-content-saved-products">
				<div class="fpd-grid fpd-grid-contain fpd-padding fpd-dynamic-columns"></div>
			</div>

			<!-- Loader -->
			<div class="fpd-context-loader">
				<div class="fpd-loading"></div>
			</div>
		</div>

	</div>

</section>

<!-- Full Loader -->
<div class="fpd-full-loader">
	<div class="fpd-loading"></div>
</div>