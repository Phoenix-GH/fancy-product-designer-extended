<div id="fpd-order-panel">
	<div id="fpd-order-designer-wrapper">

		<!-- Product Designer Container -->
		<div id="fpd-order-designer-wrapper">
			<div id="fpd-order-designer" class="fpd-shadow-1"></div>
		</div>

		<!-- Tools -->
		<div id="fpd-export-tools" class="fpd-clearfix">

			<div>

				<!-- Export -->
				<div class="fpd-inner-panel">

					<h2><?php _e( 'Export', 'radykal' ); ?></h2>
					<table class="form-table">
						<tr>
							<th><?php _e('Output File', 'radykal' ); ?></th>
							<td>
								<label>
									<input type="radio" name="fpd_output_file" value="pdf" checked="checked" /><?php _e('PDF', 'radykal' ); ?>
								</label>
								<label>
									<input type="radio" name="fpd_output_file" value="image" /><?php _e('IMAGE', 'radykal' ); ?>
								</label>
							</td>
						</tr>
						<tr>
							<th><?php _e('Image Format', 'radykal' ); ?></th>
							<td>
								<label>
									<input type="radio" name="fpd_image_format" value="png" checked="checked" />PNG
								</label>
								<label>
									<input type="radio" name="fpd_image_format" value="jpeg" />JPEG
								</label>
								<label>
									<input type="radio" name="fpd_image_format" value="svg" />SVG
									<i class="fpd-admin-tooltip fpd-admin-icon-info-outline" title="<?php _e( 'Exporting as SVG format allows to create a multi-layer PDF. Bounding box clippings are ignored!', 'radykal' ); ?>"></i>
								</label>
							</td>
						</tr>
						<tr>
							<th><?php _e('Size', 'radykal' ); ?></th>
							<td>
								<p><a href="http://www.hdri.at/dpirechner/dpirechner_en.htm" target="_blank" style="font-size: 11px;"><?php _e('DPI - Pixel Converter', 'radykal' ); ?></a></p>
								<label class="fpd-block">
									<input type="number" value="210" id="fpd-pdf-width" />
									<br />
									<?php _e('PDF width in mm', 'radykal' ); ?>
								</label>
								<label class="fpd-block">
									<input type="number" value="297" id="fpd-pdf-height" />
									<br />
									<?php _e('PDF height in mm', 'radykal' ); ?>
								</label>
								<label class="fpd-block">
									<input type="number" value="" name="fpd_scale" placeholder="1" />
									<br />
									<?php _e('Scale Factor', 'radykal' ); ?>
								</label>
								<label class="fpd-block">
									<input type="number" value="" id="fpd-pdf-dpi" placeholder="300" />
									<br />
									<?php _e('Image DPI', 'radykal' ); ?>
								</label>
							</td>
						</tr>
						<tr>
							<th><?php _e('View(s)', 'radykal' ); ?></th>
							<td>
								<label>
									<input type="radio" name="fpd_export_views" value="all" checked="checked" /> <?php _e('ALL', 'radykal' ); ?>
								</label>
								<label>
									<input type="radio" name="fpd_export_views" value="current" /> <?php _e('CURRENT SHOWING', 'radykal' ); ?>
								</label>
							</td>
						</tr>
					</table>

					<button id="fpd-generate-file" class="button button-primary"><?php _e( 'Create', 'radykal' ); ?></button>
					<p class="description"><?php _e( 'The created pdfs will be stored in: ', 'radykal' ); ?><br /><?php echo content_url('/fancy_products_orders/pdfs'); ?></p>

					<div class="fpd-ui-blocker"></div>

				</div>

				<!-- Additional Tools -->
				<div class="fpd-inner-panel">

					<h2><?php _e( 'Additional Tools', 'radykal' ); ?></h2>
					<h4><?php _e('Change Stage Dimensions', 'radykal' ); ?></h4>
					<table class="form-table">
						<tr>
							<td>
								<label>
									<input type="number" id="fpd-stage-width" placeholder="<?php echo $stage_width; ?>"/>
									<?php _e('Width in pixels', 'radykal' ); ?>
								</label>
								<label>
									<input type="number" id="fpd-stage-height" placeholder="<?php echo $stage_height; ?>" />
									<?php _e('Height in pixels', 'radykal' ); ?>
								</label>
							</td>
						</tr>
					</table>
					<p class="description">
						<?php _e( 'The stage dimensions are not sent with orders that are made with lower version than 2.0.0 of Fancy Product Designer. Use this tool to change the stage dimensions.', 'radykal' ); ?>
					</p>
					<h4><?php _e('New Fancy Product', 'radykal' ); ?></h4>
					<p class="description"><?php _e( 'Create a new Fancy Product with the current showing views in the Order Viewer.', 'radykal' ); ?></p>
					<a href="#" class="button-primary" id="fpd-create-new-fp"><?php _e( 'Create', 'radykal' ); ?></a>
					<div class="fpd-ui-blocker"></div>

				</div>

			</div><!-- Left Column -->

			<div class="fpd-inner-panel">

				<h2><?php _e( 'Single Elements', 'radykal' ); ?></h2>
				<div id="fpd-editor-box-wrapper"></div>
				<div id="fpd-elements-lists" class="fpd-clearfix">
					<div>
						<h4>
							<?php _e( 'Added By Customer', 'radykal' ); ?>
							<i class="fpd-admin-tooltip fpd-admin-icon-info-outline" title="<?php _e( 'This only works for orders that are made with version 2.0.0 or newer of Fancy Product Designer.', 'radykal' ); ?>"></i>
						</h4>

						<ul id="fpd-custom-elements-list"></ul>
					</div>
					<div>
						<h4><?php _e( 'Saved Images On Server', 'radykal' ); ?></h4>
						<ul id="fpd-order-image-list"></ul>
					</div>
				</div>

				<h4><?php _e( 'Export Options', 'radykal' ); ?></h4>
				<table class="form-table">
					<tr>
						<th><?php _e('Image Format', 'radykal' ); ?></th>
						<td>
							<label>
								<input type="radio" name="fpd_single_image_format" value="png" checked="checked" /> PNG
							</label>
							<label>
								<input type="radio" name="fpd_single_image_format" value="jpeg" /> JPEG
							</label>
							<label>
								<input type="radio" name="fpd_single_image_format" value="svg" /> SVG
								<i class="fpd-admin-tooltip fpd-admin-icon-info-outline" title="<?php _e( 'When creating an SVG image with a text element, make sure that the font you are using is installed on your computer otherwise it will not be shown.', 'radykal' ); ?>"></i>
							</label>

						</td>
					</tr>
					<tr>
						<th><?php _e('Padding around exported element.', 'radykal' ); ?></th>
						<td>
							<input type="number" min="0" value="" name="fpd_single_element_padding" placeholder="0" />
						</td>
					</tr>
					<tr>
						<th><?php _e('DPI.', 'radykal' ); ?></th>
						<td>
							<input type="number" min="0" value="" name="fpd_single_element_dpi" placeholder="72" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>
								<input type="checkbox" id="fpd-restore-oring-size" />
								<?php _e( 'Use origin size, that will set the scaling to 1, when exporting the image.', 'radykal' ); ?>
							</label>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>
								<input type="checkbox" id="fpd-save-on-server" />
								<?php _e( 'Save exported image on server.', 'radykal' ); ?>
								<i class="fpd-admin-tooltip fpd-admin-icon-info-outline" title="<?php _e( 'You can save all elements of the Fancy Product as an image on your server, to be stored in: ', 'radykal' ); echo content_url('/fancy_products_orders/images'); ?>"></i>
							</label>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>
								<input type="checkbox" id="fpd-without-bounding-box" />
								<?php _e( 'Export without bounding box clipping if element has one.', 'radykal' ); ?>
							</label>
						</td>
					</tr>
				</table>

				<button id="fpd-save-element-as-image" class="button button-primary"><?php _e( 'Create', 'radykal' ); ?></button>

				<div class="fpd-ui-blocker"></div>

			</div><!-- Right Column -->

		</div><!-- Tools -->

	</div>

</div>
<script type="text/javascript">

	var fancyProductDesigner,
		$orderImageList,
		loadingProduct = false,
		currentItemId = '',
		orderId = <?php echo isset($thepostid) ? $thepostid : 0; ?>,
		isReady = false,
		stageWidth = <?php echo $stage_width; ?>,
		stageHeight = <?php echo $stage_height; ?>;

	jQuery(document).ready(function() {

		var $fancyProductDesigner = jQuery('#fpd-order-designer'),
			$customElementsList = jQuery('#fpd-custom-elements-list'),
			customElements = null;

		$orderImageList = jQuery('#fpd-order-image-list');

		jQuery(document).ajaxError( function(e, xhr, settings, exception) {
		 	//console.log(e, xhr, settings, exception);
		});

		fancyProductDesigner = $fancyProductDesigner.fancyProductDesigner({
			width: stageWidth,
			stageHeight: stageHeight,
			editorMode: '#fpd-editor-box-wrapper',
			fonts: [<?php echo '"'.implode('", "', FPD_Fonts::get_enabled_fonts()).'"'; ?>],
			templatesDirectory: "<?php echo plugins_url('/templates/', dirname(dirname(__FILE__))); ?>",
			tooltips: true
		}).data('fancy-product-designer');

		//api buttons first available when
		$fancyProductDesigner.on('ready', function() {
			isReady = true;
		})
		.on('productCreate', function() {

			$customElementsList.empty();

			customElements = fancyProductDesigner.getCustomElements();
			for(var i=0; i < customElements.length; ++i) {
				var customElement = customElements[i].element;
				$customElementsList.append('<li><a href="#">'+customElement.title+'</a></li>');
			}

			loadingProduct = false;

		});

		jQuery('.fancy-product').on('click', '.fpd-show-order-item', function(evt) {

			evt.preventDefault();

			if(	isReady && !loadingProduct ) {

				var $this = jQuery(this);
				$this.data('defaultText', $this.text()).text("<?php _e( 'Loading data...', 'radykal' ); ?>");

				currentItemId = $this.data('order_item_id');

				jQuery.ajax({
				url: fpd_admin_opts.adminAjaxUrl,
				data: {
					action: 'fpd_loadorder',
					_ajax_nonce: fpd_admin_opts.ajaxNonce,
					order_id: $this.data('order_id'),
					item_id: currentItemId
				},
				type: 'post',
				dataType: 'json',
				complete: function(data) {

					if(data == undefined || data.responseJSON) {

						$('html, body').animate({
					        scrollTop: $("#fpd-order").offset().top
					    }, 300);

						fpdLoadOrder(JSON.parse(data.responseJSON.order_data));

					}
					else {

						fpdMessage("<?php _e( 'Order data could not be loaded. Please try again!', 'radykal' ); ?>", 'error');

					}

					$this.text($this.data('defaultText'));

				}
			});


			}

		});

		//change stage dimensions
		jQuery('#fpd-stage-width, #fpd-stage-height').on('change keyup', function(evt) {

			evt.preventDefault();

			if(	_checkAPI() ) {

				var $this = jQuery(this);

				if($this.attr('id') === 'fpd-stage-width') {
					stageWidth = parseInt($this.val() ? $this.val() : $this.attr('placeholder'));
				}
				else {
					stageHeight = parseInt($this.val() ? $this.val() : $this.attr('placeholder'));
				}

				fancyProductDesigner.setStageDimensions(stageWidth, stageHeight);
				jQuery('input[name="fpd_scale"]').keyup();

			}

		});

		jQuery('#fpd-create-new-fp').click(function(evt) {

			evt.preventDefault();

			if(	_checkAPI() ) {

				var $panel = jQuery(this).parents('.fpd-inner-panel:first');
					addToLibrary = confirm(fpd_admin_opts.addToLibrary);

				fpdBlockPanel($panel);

				fpdAddProduct(function(data) {

					if(data) {

						fpdAddViews(
							data.id,
							fancyProductDesigner.getProduct(),
							addToLibrary,
							//view added
							function(data) {
							},
							//complete
							function() {
								fpdUnblockPanel($panel);
							}
						);

					}
					else {
						fpdUnblockPanel($panel);
					}

				});

			}

		});

		//EXPORT
		jQuery('[name="fpd_output_file"]').change(function() {

			if(jQuery('[name="fpd_output_file"]:checked').val() == 'pdf') {
				jQuery('#fpd-pdf-width').parents('label:first').show();
				jQuery('#fpd-pdf-height').parents('label:first').show();
				jQuery('#fpd-pdf-dpi').parents('label:first').show();
			}
			else {
				jQuery('#fpd-pdf-width').parents('label:first').hide();
				jQuery('#fpd-pdf-height').parents('label:first').hide();
				jQuery('#fpd-pdf-dpi').parents('label:first').hide();
			}

		}).change();

		jQuery('[name="fpd_image_format"]').change(function() {

			if(jQuery('[name="fpd_image_format"]:checked').val() == 'svg') {
				jQuery('#fpd-pdf-width').parents('tr:first').hide();
			}
			else {
				jQuery('#fpd-pdf-width').parents('tr:first').show();
			}

		}).change();

		jQuery('input[name="fpd_scale"]').keyup(function() {

			var scale = !isNaN(this.value) && this.value.length > 0 ? this.value : 1,
				mmInPx = 3.779528;

			jQuery('#fpd-pdf-width').val(Math.round((stageWidth * scale) / mmInPx));
			jQuery('#fpd-pdf-height').val(Math.round((stageHeight * scale) / mmInPx));

		}).keyup();

		jQuery('#fpd-generate-file').click(function(evt) {

			evt.preventDefault();

			if(_checkAPI()) {

				if(jQuery('[name="fpd_output_file"]:checked').val() == 'image') {
					createImage();
				}
				else {
					fpdBlockPanel(jQuery(this).parents('.fpd-inner-panel:first'));
					createPdf();
				}

			}

		});



		//SINGLE ELEMENT IMAGES
		$customElementsList.on('click', 'li', function(evt) {

			evt.preventDefault();

			var index = $customElementsList.children('li').index(this),
				stage = fancyProductDesigner.getStage();

			fancyProductDesigner.selectView(customElements[index].element.viewIndex);
			stage.setActiveObject(customElements[index].element);

		});

		jQuery('[name="fpd_single_image_format"]').change(function() {

			if(this.value == 'jpeg') {
				jQuery('[name="fpd_single_element_dpi"]').parents('tr:first').show();
			}
			else {
				jQuery('[name="fpd_single_element_dpi"]').parents('tr:first').hide();
			}

		}).change();


		jQuery('#fpd-save-element-as-image').click(function(evt) {

			evt.preventDefault();

			if(_checkAPI()) {

				var stage = fancyProductDesigner.getStage(),
					format = jQuery('input[name="fpd_single_image_format"]:checked').val(),
					backgroundColor = format == 'jpeg' ? '#ffffff' : 'transparent',
					currentViewIndex = fancyProductDesigner.getViewIndex(),
					objects = stage.getObjects(),
					tempClippingRect = null;

				if(stage.getActiveObject()) {

					var $this = jQuery(this),
						element = stage.getActiveObject(),
						tempScale = element.scaleX,
						tempWidth = stage.getWidth(),
						tempHeight = stage.getHeight(),
						dataObj;

					if(format == 'svg') {

						if(element.toSVG().search('<image') != -1) {
							fpdMessage("<?php _e( 'You cannot create an SVG file from a bitmap, you can only do this by using a text element or another SVG image file', 'radykal' ); ?>", 'info');
							return false;
						}

					}

					fancyProductDesigner.deselectElement();

					//check if origin size should be rendered
					if(jQuery('#fpd-restore-oring-size').is(':checked')) {

						/*if(element.scaleX < 1 && element.clippingRect !== undefined) {

							tempClippingRect = element.clippingRect;
							var clippingScale = 1 + (1-element.scaleX);
							fancyProductDesigner.setClippingRect(element, {
								left: tempClippingRect.left + ((tempClippingRect.width - (tempClippingRect.width * clippingScale)) * 0.5),
								top: tempClippingRect.top + ((tempClippingRect.height - (tempClippingRect.height * clippingScale)) * 0.5),
								width: tempClippingRect.width * clippingScale,
								height: tempClippingRect.height * clippingScale
							});

						}*/

						element.setScaleX(1);
						element.setScaleY(1);
					}

					stage.setBackgroundColor(backgroundColor, function() {

						var paddingTemp = element.padding;
						element.padding = jQuery('input[name="fpd_single_element_padding"]').val().length == 0 ? 0 : Number(jQuery('input[name="fpd_single_element_padding"]').val());

						var clipToTemp = element.getClipTo();
						if(clipToTemp != null) {

							if(jQuery('#fpd-without-bounding-box').is(':checked')) {
								element.setClipTo(null);
								stage.renderAll();
							}
							else {
								for(var i=0; i < objects.length; ++i) {

									var object = objects[i];
									if(object.viewIndex == currentViewIndex) {
										object.visible = false;
									}

								}

								element.visible = true;
							}

						}

						element.setCoords();

						var source;

						if(format == 'svg') {
							source = element.toSVG();
						}
						else {
							source = clipToTemp != null && !jQuery('#fpd-without-bounding-box').is(':checked') ? stage.toDataURL({format: format}) : element.toDataURL({format: format});
						}

						if(jQuery('#fpd-save-on-server').is(':checked')) {

							fpdBlockPanel($this.parents('.fpd-inner-panel:first'));

							if(format == 'svg') {

								dataObj = {
									action: 'fpd_imagefromsvg',
									_ajax_nonce: fpd_admin_opts.ajaxNonce,
									order_id: orderId,
									item_id: currentItemId,
									svg: source,
									width: stage.getWidth(),
									height: stage.getHeight(),
									title: element.title
								};

							}
							else {

								dataObj = {
									action: 'fpd_imagefromdataurl',
										_ajax_nonce: fpd_admin_opts.ajaxNonce,
										order_id: orderId,
										item_id: currentItemId,
										data_url: source,
										title: element.title,
										format: format,
										dpi: jQuery('[name="fpd_single_element_dpi"]').val().length == 0 ? 72 : jQuery('[name="fpd_single_element_dpi"]').val()
								};
							}

							jQuery.ajax({
								url: fpd_admin_opts.adminAjaxUrl,
								data: dataObj,
								type: 'post',
								dataType: 'json',
								complete: function(data) {

									var json = data.responseJSON;
									if(data.status != 200 || json.code == 500) {
										fpdMessage("<?php _e( 'Image creation failed. Please try again!', 'radykal' ); ?>", 'error');
									}
									else if( json.code == 201 ) {
										$orderImageList.append('<li><a href="'+json.url+'" title="'+json.url+'" target="_blank">'+json.title+'.'+format+'</a></li>');
									}
									else {
										//prevent caching
										$orderImageList.find('a[title="'+json.url+'"]').attr('href', json.url+'?t='+new Date().getTime());
									}

									fpdUnblockPanel($this.parents('.fpd-inner-panel:first'));

								}
							});

						}
						else { //dont save it on server

							var popup = window.open('','_blank');
							if(!_popupBlockerEnabled(popup)) {

								popup.document.title = element.title;

								if(format == 'svg') {
									source = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="'+stage.getWidth()+'" height="'+stage.getHeight()+'" xml:space="preserve">'+element.toSVG()+'</svg>';
									jQuery(popup.document.body).append(source);
								}
								else {
									jQuery(popup.document.body).append('<img src="'+source+'" title="Product" />');

								}

							}

						}

						for(var i=0; i < objects.length; ++i) {

							var object = objects[i];
							if(object.viewIndex == currentViewIndex) {
								object.visible = true;
							}

						}

						element.set({scaleX: tempScale, scaleY: tempScale, padding: paddingTemp})
						.setClipTo(clipToTemp)
						.setCoords();

						if(tempClippingRect !== null) {
							//fancyProductDesigner.setClippingRect(element, tempClippingRect);
						}

						stage.setBackgroundColor('transparent')
						.setDimensions({width: tempWidth, height: tempHeight})
						.renderAll();

					});

				}
				else {
					fpdMessage("<?php _e('No element selected!', 'radykal'); ?>", 'info');
				}
			}

		});

		function createImage() {

			var format = jQuery('input[name="fpd_image_format"]:checked').val(),
				data;

			if(format == 'svg') {
				data = fancyProductDesigner.getViewsSVG();
			}
			else {
				var backgroundColor = format == 'jpeg' ? '#ffffff' : 'transparent',
					multiplier = jQuery('input[name="fpd_scale"]').val().length == 0 ? 1 : Number(jQuery('input[name="fpd_scale"]').val());

				data = fancyProductDesigner.getViewsDataURL(format, backgroundColor, multiplier);
			}

			if(jQuery('[name="fpd_export_views"]:checked').val() == 'current') {
				var requestedIndex = data[fancyProductDesigner.getViewIndex()];
				data = [];
				data.push(requestedIndex);
			}

			var popup = window.open('','_blank');
			if(!_popupBlockerEnabled(popup)) {
				popup.document.title = orderId;
				for(var i=0; i < data.length; ++i) {
					if(format == 'svg') {
						jQuery(popup.document.body).append(data[i]);
					}
					else {
						jQuery(popup.document.body).append('<img src="'+data[i]+'" title="View'+i+'" />');
					}

				}

			}

		};

		function createPdf() {

			var $panel = jQuery('#fpd-generate-file').parents('.fpd-inner-panel:first');

			if(jQuery('#fpd-pdf-width').val() == '') {
				fpdMessage("<?php _e( 'No width has been entered. Please set one!', 'radykal' ); ?>", 'error');
				return false;
			}
			else if(jQuery('#fpd-pdf-height').val() == '') {
				fpdMessage("<?php _e( 'No height has been entered. Please set one!', 'radykal' ); ?>", 'error');
				return false;
			}

			fpdBlockPanel($panel);

			var format = jQuery('input[name="fpd_image_format"]:checked').val(),
				backgroundColor = format == 'jpeg' ? '#ffffff' : 'transparent',
				data;

			if(format == 'svg') {
				data = fancyProductDesigner.getViewsSVG();
			}
			else {
				var multiplier = jQuery('input[name="fpd_scale"]').val().length == 0 ? 1 : Number(jQuery('input[name="fpd_scale"]').val());
				data = fancyProductDesigner.getViewsDataURL(format, backgroundColor, multiplier);
			}

			if(jQuery('[name="fpd_export_views"]:checked').val() == 'current') {
				var requestedIndex = data[fancyProductDesigner.getViewIndex()];
				data = [];
				data.push(requestedIndex);
			}

			var data_str = JSON.stringify(data);

			jQuery.ajax({
				url: fpd_admin_opts.adminAjaxUrl,
				data: {
					action: 'fpd_pdffromdataurl',
					_ajax_nonce: fpd_admin_opts.ajaxNonce,
					order_id: orderId,
					item_id: currentItemId,
					data_strings: data_str,
					width: jQuery('#fpd-pdf-width').val(),
					height: jQuery('#fpd-pdf-height').val(),
					image_format: jQuery('input[name="fpd_image_format"]:checked').val(),
					orientation: stageWidth > stageHeight ? 'L' : 'P',
					dpi: jQuery('#fpd-pdf-dpi').val().length == 0 ? 300 : jQuery('#fpd-pdf-dpi').val()
				},
				type: 'post',
				dataType: 'json',
				complete: function(data) {
					if(data == undefined || data.status != 200) {

						var message = '';
						if(data.responseJSON && data.responseJSON.message) {
							message += data.responseJSON.message;
						}
						message += '.\n';
						message += '<?php _e( 'PDF creation failed - There is too much data being sent. To fix this please increase the WordPress memory limit in your php.ini file. You could export a single view or use the JPEG image format! ', 'radykal' ); ?>';
						fpdMessage(message, 'error');

					}
					else {
						var json = data.responseJSON;
						if(json !== undefined) {
							window.open(json.url, '_blank');
						}
						else {
							fpdMessage("<?php _e('JSON could not be parsed. Go to wp-content/fancy_products_orders/pdfs and check if a PDF has been generated.'); ?>", 'error');
						}
					}

					fpdUnblockPanel($panel);

				}
			});

		};

		function _checkAPI() {

			if(fancyProductDesigner.getStage().getObjects().length > 0 && isReady) {
				return true;
			}
			else {
				fpdMessage("<?php _e( 'No Fancy Product is selected. Please open one from the Order Items!', 'radykal' ); ?>", 'error');
				return false;
			}

		};

		function _popupBlockerEnabled(popup) {

			if (popup == null || typeof(popup)=='undefined') {
				fpdMessage("<?php _e( 'Your Pop-Up Blocker is enabled so the image will be opened in a new window. Please choose to allow this website in your pop-up blocker!', 'radykal' ); ?>", 'info');
				return true;
			}
			else {
				return false;
			}

		}

	});


	function fpdLoadOrder(order) {

		if(typeof order !== 'object') { return false; }

		loadingProduct = true;
		$orderImageList.empty();
		fancyProductDesigner.clear();

		stageWidth = (order[0].options === undefined || order[0].options.width === undefined) ? stageWidth : order[0].options.width;
		stageHeight = (order[0].options === undefined || order[0].options.stageHeight === undefined) ? stageHeight : order[0].options.stageHeight;

		jQuery('#fpd-stage-width').attr('placeholder', stageWidth);
		jQuery('#fpd-stage-height').attr('placeholder', stageHeight);
		jQuery('input[name="fpd_scale"]').keyup();

		fancyProductDesigner.loadProduct(order);

		jQuery.ajax({

			url: fpd_admin_opts.adminAjaxUrl,
			data: {
				action: 'fpd_loadorderitemimages',
				_ajax_nonce: fpd_admin_opts.ajaxNonce,
				order_id: orderId,
				item_id: currentItemId
			},
			type: 'post',
			dataType: 'json',
			success: function(data) {

				if(data == undefined || data.code == 500) {

					fpdMessage("<?php _e( 'Could not load order item image. Please try again!', 'radykal' ); ?>", 'info');

				}
				//append order item images to list
				else if( data.code == 200 ) {

					for (var i=0; i < data.images.length; ++i) {
						var title = data.images[i].substr(data.images[i].lastIndexOf('/')+1);
						$orderImageList.append('<li><a href="'+data.images[i]+'" title="'+data.images[i]+'" target="_blank" >'+title+'</a></li>');
					}

				}

			}

		});

	};

</script>