<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('FPD_Frontend_Product')) {

	class FPD_Frontend_Product {

		private $form_views = null;
		private $disable_export_btns = 0;

		public function __construct() {

			require_once(FPD_PLUGIN_DIR.'/inc/class-parameters.php');

			//CATALOG
			$catalog_button_pos = fpd_get_option('fpd_catalog_button_position');
			if(  $catalog_button_pos == 'fpd-replace-add-to-cart' ) {
				add_filter( 'woocommerce_loop_add_to_cart_link', array(&$this, 'add_to_cart_cat_text'), 10, 2 );
			}
			else {
				add_action( 'woocommerce_after_shop_loop_item', array(&$this, 'add_catalog_customize_button'), 20 );
			}

			//SINGLE FANCY PRODUCT
			add_filter( 'body_class', array( &$this, 'add_fancy_product_class') );

			add_action( 'wp_head', array( &$this, 'remove_share_image_filter' ), 1000 );

			//before product container
			add_action( 'woocommerce_before_single_product', array( &$this, 'before_product_container'), 1 );

			//add customize button
			if( fpd_get_option('fpd_start_customizing_button_position') == 'under-short-desc' ) {
				add_action( 'woocommerce_single_product_summary', array( &$this, 'add_customize_button'), 25 );
			}
			else {
				add_action( 'woocommerce_after_add_to_cart_button', array( &$this, 'add_customize_button'), 0 );
			}

			//add additional form fields to cart form
			add_action( 'woocommerce_before_add_to_cart_button', array( &$this, 'add_product_designer_form') );
			//php uploader - image upload
			add_action( 'wp_ajax_fpduploadimage', array( &$this, 'upload_image' ) );
			if( fpd_get_option('fpd_upload_designs_php_logged_in') == 0 ) {
				add_action( 'wp_ajax_nopriv_fpduploadimage', array( &$this, 'upload_image' ) );
			}

			//add share button
			if( fpd_get_option('fpd_sharing') ) {
				add_filter( 'wp_get_attachment_url', array( &$this, 'set_product_image') );
				add_filter( 'post_type_link', array( &$this, 'reset_share_permalink'), 10, 2 );
				add_action( 'woocommerce_share' , array( &$this, 'add_share' ) );
				add_action( 'wp_ajax_fpd_createshareurl', array( &$this, 'create_share_url' ) );
				add_action( 'wp_ajax_nopriv_fpd_createshareurl', array( &$this, 'create_share_url' ) );
			}

			//order via shortcode
			add_shortcode( 'fpd', array( &$this, 'fpd_shortcode_handler') );
			add_shortcode( 'fpd_form', array( &$this, 'fpd_form_shortcode_handler') );
			add_action( 'wp_ajax_fpd_newshortcodeorder', array( &$this, 'create_shortcode_order' ) );
			add_action( 'wp_ajax_nopriv_fpd_newshortcodeorder', array( &$this, 'create_shortcode_order' ) );

			//upload image from social network
			add_action( 'wp_ajax_fpd_uploadsocialphoto', array( &$this, 'upload_social_photo' ) );
			add_action( 'wp_ajax_nopriv_fpd_uploadsocialphoto', array( &$this, 'upload_social_photo' ) );

		}

		//remove filter that resets the product image url before body starts
		public function remove_share_image_filter() {

			remove_filter( 'wp_get_attachment_url', array( &$this, 'set_product_image') );

		}

		//custom text for the add-to-cart button in catalog
		public function add_to_cart_cat_text( $handler, $product ) {

			if( is_fancy_product( $product->id ) ) {
				return sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button product_type_%s">%s</a>',
					esc_url( get_permalink($product->id) ),
					esc_attr( $product->id ),
					esc_attr( $product->get_sku() ),
					esc_attr( $product->product_type ),
					esc_html( fpd_get_option( 'fpd_label_add_to_cart_text' ) )
				);
			}

			return $handler;

		}

		//add customize button add the end of catalog item
		public function add_catalog_customize_button() {

			global $product;

			if( is_fancy_product( $product->id ) ) {

				printf( '<a href="%s" rel="nofollow" class="button" style="width: 100%%; margin: 10px 0;">%s</a>',
					esc_url( get_permalink($product->id) ),
					esc_html( fpd_get_option( 'fpd_label_add_to_cart_text' ) )
				);

			}

		}

		//add fancy-product class in body
		public function add_fancy_product_class( $classes ) {

			global $post;

			if( is_fancy_product( $post->ID ) ) {

				$product_settings = new FPD_Product_Settings( $post->ID );

				$classes[] = 'fancy-product';

				if( $product_settings->customize_button_enabled || (isset($_GET['cart_item_key']) && $product_settings->get_option('open_in_lightbox')) ) {
					$classes[] = 'fpd-customize-button-visible';
				}
				else {
					$classes[] = 'fpd-customize-button-hidden';
				}

				//check if tablets are supported
				if( fpd_get_option( 'fpd_disable_on_tablets' ) )
					$classes[] = 'fpd-hidden-tablets';


				//check if smartphones are supported
				if( fpd_get_option( 'fpd_disable_on_smartphones' ) )
					$classes[] = 'fpd-hidden-mobile';

				if( $product_settings->get_option( 'fullwidth_summary' ) )
					$classes[] = 'fpd-fullwidth-summary';

			}

			return $classes;

		}

		public function before_product_container() {

			global $post;

			if( is_fancy_product( $post->ID ) ) {

				//add product designer
				$product_settings = new FPD_Product_Settings( $post->ID );
				$position = $product_settings->get_option('placement');

				if( $position  == 'fpd-replace-image') {
					add_action( 'woocommerce_before_single_product_summary', array( &$this, 'add_product_designer'), 15 );
				}
				else if( $position  == 'fpd-under-title') {
					add_action( 'woocommerce_single_product_summary', array( &$this, 'add_product_designer'), 6 );
				}
				else if( $position  == 'fpd-after-summary') {
					add_action( 'woocommerce_after_single_product_summary', array( &$this, 'add_product_designer'), 1 );
				}
				else {
					add_action( 'fpd_product_designer', array( &$this, 'add_product_designer') );
				}

				//remove product image, there you gonna see the product designer
				if( $product_settings->get_option('hide_product_image') || ($position == 'fpd-replace-image' && (!$product_settings->customize_button_enabled)) ) {
					remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
				}

			}
		}

		//the actual product designer will be added
		public function add_product_designer() {

			global $post;

			$product_settings = new FPD_Product_Settings( $post->ID );

			$open_in_lightbox = $product_settings->get_option('open_in_lightbox') && trim($product_settings->get_option('start_customizing_button')) != '';

			if( is_fancy_product( $product_settings->master_id  ) && (!$product_settings->customize_button_enabled || $open_in_lightbox) ) {

				FPD_Scripts_Styles::$add_script = true;
				$selector = 'fancy-product-designer-'.$product_settings->master_id.'';

				//get availabe fonts
				$available_fonts = $product_settings->get_option('font_families[]') === false ? FPD_Fonts::get_enabled_fonts() : $product_settings->get_option('font_families[]');
				if( !is_array($available_fonts) )
					$available_fonts = str_split($available_fonts, strlen($available_fonts));

				//woocommerce
				if( get_post_type( $post ) === 'product' ) {
					$this->output_wc_start();
				}

				//get assigned categories
				$fancy_content_ids = fpd_has_content( $product_settings->master_id );
				if( !is_array($fancy_content_ids) || sizeof($fancy_content_ids) === 0 ) { return; }

				//define the designer margins
				$designer_margins = $product_settings->get_option('designer_margin');
				$margin_styles = '';
				if( !empty($designer_margins) ) {
					@parse_str($designer_margins, $designer_margins);
					foreach($designer_margins as $margin_key => $margin_val) {
						$margin_styles .= 'margin-'.$margin_key.':'.$margin_val.'px;';
					}

				}

				//add class if lightbox is enabled
				$modal_box_css = $open_in_lightbox ? ' fpd-lightbox-enabled' : '';
				$source_type = get_post_meta( $product_settings->master_id, 'fpd_source_type', true );

				?>
				<div id="<?php echo $selector; ?>" class="fpd-container <?php echo $product_settings->get_option('frame_shadow'); echo $modal_box_css; ?>" style="float: <?php echo $product_settings->get_option('designer_floating'); ?>; <?php echo $margin_styles; ?>">
					<?php

					foreach($fancy_content_ids as $fancy_content_id) {

						if( empty($source_type) || $source_type == 'category' ) {

							$fancy_category = new Fancy_Category($fancy_content_id);
							echo '<div class="fpd-category" title="'.esc_attr($fancy_category->get_data()->title).'">';

								$fancy_products_data = $fancy_category->get_products();
								foreach($fancy_products_data as $fancy_product_data) {

									echo $this->get_product_html($fancy_product_data->ID);

								}

							echo '</div>'; //category

						}
						else {

							echo $this->get_product_html($fancy_content_id);

						}

					}

					//output designs
					if( !intval($product_settings->get_option('hide_designs_tab')) ) {

						require_once( FPD_PLUGIN_DIR.'/inc/class-designs.php' );

						$fpd_designs = new FPD_Designs(
							$product_settings->get_option('design_categories[]') ? $product_settings->get_option('design_categories[]') : array()
							,$product_settings->get_image_parameters()
						);
						$fpd_designs->output();

					}

					?>

				</div>
				<p class="fpd-not-supported-device-info">
					<strong><?php echo fpd_get_option('fpd_label_not_supported_device_info'); ?></strong>
				</p>

				<script type="text/javascript">

					var fancyProductDesigner,
						$selector,
						$productWrapper,
						$cartForm,
						productCreated = false,
						fpdPrice = 0,
						isReady = false,
						$modalWrapper = null;

					<?php echo fpd_get_option('fpd_jquery_no_conflict') === 'on' ? 'jQuery.noConflict();' : ''; ?>
					jQuery(document).ready(function() {

						//return;

						$selector = jQuery('#<?php echo $selector; ?>');
						$productWrapper = jQuery('.post-<?php echo $post->ID; ?>');
						$cartForm = jQuery('[name="fpd_product"]:first').parents('form:first');

						var buttonClass = "<?php echo esc_attr( fpd_get_option('fpd_start_customizing_css_class') ) == '' ? 'fpd-modal-button' : trim(fpd_get_option('fpd_start_customizing_css_class')); ?>",
							productDesignerWidth = <?php echo $product_settings->get_option('stage_width'); ?>,
							customizeBtn = jQuery('#fpd-start-customizing-button');

						if(jQuery('.fpd-lightbox-enabled').size() > 0) {

							$modalWrapper = jQuery('body').append('<div class="fpd-product-lightbox fpd-modal-overlay"><div class="fpd-modal-wrapper"><div class="fpd-modal-buttons"><a href="#" id="fpd-modal-done" class="'+buttonClass+'"><?php echo fpd_get_option('fpd_label_lightbox_submit_button'); ?></a><a href="#" id="fpd-modal-cancel" class="'+buttonClass+'"><?php echo fpd_get_option('fpd_label_lightbox_cancel_button'); ?></a></div></div></div>').find('.fpd-modal-wrapper');

							$selector.clone().prependTo($modalWrapper);
							$selector.remove();
							$selector = jQuery('#<?php echo $selector; ?>');

							jQuery(window).resize(function() {
								$modalWrapper.css('margin-left', -($modalWrapper.outerWidth() / 2)+'px');
							});

							customizeBtn.click(function(evt) {

								if(!isReady) { return false; }

								jQuery('html,body').addClass('fpd-modal-open');
								$modalWrapper.parent('.fpd-modal-overlay').fadeIn(300, function() {
									jQuery('.fpd-context-dialog').removeClass('fpd-modal-hidden');
								});
								jQuery(window).resize();

								evt.preventDefault();

							});

							$modalWrapper.on('click', '#fpd-modal-done', function(evt) {

								jQuery('#fpd-modal-cancel').click();

								if(<?php echo intval(fpd_get_option('fpd_lightbox_add_to_cart')); ?>) {
									$cartForm.find(':submit').click();
								}

								evt.preventDefault();

							})
							.on('click', '#fpd-modal-cancel', function(evt) {

								fancyProductDesigner.closeDialog();
								jQuery('html,body').removeClass('fpd-modal-open');
								$modalWrapper.parent('.fpd-modal-overlay').fadeOut(200);
								evt.preventDefault();

							});

						}

						if(jQuery('.fpd-share-design').size() > 0) {

							jQuery('#fpd-share-button').click(function(evt) {

								evt.preventDefault();

								var scale = $selector.width() > 800 ? Number(800 / $selector.width()).toFixed(2) : 1;
								var data = {
									action: 'fpd_createshareurl',
									image: fancyProductDesigner.getProductDataURL('png', 'transparent', scale),
									product: JSON.stringify(fancyProductDesigner.getProduct()),
								};

								jQuery(".fpd-share-widget, .fpd-share-url").addClass('fpd-hidden');
								jQuery('.fpd-share-process').removeClass('fpd-hidden');

								jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {

									if(response.share_id !== undefined) {

										var pattern = new RegExp('(share_id=).*?(&|$)'),
											shareUrl = window.location.href;

										if(shareUrl.search(pattern) >= 0){
											shareUrl = shareUrl.replace(pattern,'$1' + response.share_id + '$2');
										}
										else{
											shareUrl = shareUrl + (shareUrl.indexOf('?')>0 ? '&' : '?') + 'share_id=' + response.share_id;
										}
										<?php $shares = fpd_get_option('fpd_sharing_social_networks'); ?>
										jQuery(".fpd-share-widget").empty().jsSocials({
											url: shareUrl,
											shares: <?php echo is_array($shares) ? json_encode($shares) : '['.$shares.']'; ?>,
										    showLabel: false,
										    text: "<?php echo fpd_get_option('fpd_label_sharing_default_text'); ?>"
										}).removeClass('fpd-hidden');
									}

									jQuery('.fpd-share-process').addClass('fpd-hidden');
									jQuery('.fpd-share-url').attr('href', shareUrl).text(shareUrl).removeClass('fpd-hidden');

								}, 'json');



							});

						}

						var customImagesParams = jQuery.extend(<?php echo $product_settings->get_image_parameters_string(); ?>, <?php echo $product_settings->get_custom_image_parameters_string(); ?> );

						var socialPhotoAjaxSettingsOpt = {
							url: "<?php echo plugins_url('/inc/get_image_data_url.php', FPD_PLUGIN_ROOT_PHP); ?>"
						};
						if("<?php echo fpd_get_option('fpd_type_of_uploader'); ?>" == 'php') {
							socialPhotoAjaxSettingsOpt = {
								url: "<?php echo admin_url('admin-ajax.php'); ?>",
								data: {
									action: 'fpd_uploadsocialphoto'
								}
							};
						}


						//call fancy product designer plugin
						fancyProductDesigner = $selector.fancyProductDesigner({
							width: productDesignerWidth,
							stageHeight: <?php echo $product_settings->get_option('stage_height'); ?>,
							imageDownloadable: <?php echo $this->disable_export_btns ? 0 : fpd_get_option('fpd_download_product_image'); ?>,
							saveAsPdf: <?php echo $this->disable_export_btns ? 0 : fpd_get_option('fpd_pdf_button'); ?>,
							printable: <?php echo $this->disable_export_btns ? 0 : fpd_get_option('fpd_print'); ?>,
							allowProductSaving: <?php echo fpd_get_option('fpd_allow_product_saving'); ?>,
							fonts: [<?php echo '"'.implode('", "', $available_fonts).'"'; ?>],
							templatesDirectory: "<?php echo plugins_url('/templates/', FPD_PLUGIN_ROOT_PHP ); ?>",
							phpDirectory: "<?php echo plugins_url('/inc/', FPD_PLUGIN_ROOT_PHP); ?>",
							facebookAppId: "<?php echo fpd_get_option('fpd_facebook_app_id'); ?>",
							instagramClientId: "<?php echo fpd_get_option('fpd_instagram_client_id'); ?>",
							instagramRedirectUri: "<?php echo fpd_get_option('fpd_instagram_redirect_uri'); ?>",
							patterns: [<?php echo implode(',', $this->get_pattern_urls()); ?>],
							viewSelectionPosition: "<?php echo $product_settings->get_option('view_selection_position'); ?>",
							viewSelectionFloated: <?php echo $product_settings->get_option('view_selection_floated'); ?>,
							zoomStep: <?php echo fpd_get_option('fpd_zoom_step'); ?>,
							maxZoom: <?php echo fpd_get_option('fpd_max_zoom'); ?>,
							tooltips: <?php echo intval(fpd_get_option('fpd_tooltips')); ?>,
							hexNames: <?php echo FPD_Settings_Advanced_Colors::get_hex_names_object_string(); ?>,
							selectedColor:  "<?php echo fpd_get_option('fpd_selected_color'); ?>",
							boundingBoxColor:  "<?php echo fpd_get_option('fpd_bounding_box_color'); ?>",
							outOfBoundaryColor:  "<?php echo fpd_get_option('fpd_out_of_boundary_color'); ?>",
							paddingControl:  <?php echo fpd_get_option('fpd_padding_controls'); ?>,
							replaceInitialElements: <?php echo $product_settings->get_option('replace_initial_elements'); ?>,
							lazyLoad: <?php echo fpd_get_option('fpd_lazy_load'); ?>,
							dialogBoxPositioning: "<?php echo $product_settings->get_option('dialog_box_positioning'); ?>",
							socialPhotoAjaxSettings: socialPhotoAjaxSettingsOpt,
							elementParameters: {
								originX: "<?php echo fpd_get_option('fpd_common_parameter_originX'); ?>",
								originY: "<?php echo fpd_get_option('fpd_common_parameter_originY'); ?>"
							},
							imageParameters: {
								colorPrices: <?php echo $product_settings->get_option('enable_image_color_prices') ? FPD_Settings_Advanced_Colors::get_color_prices() : '{}'; ?>
							},
							textParameters: {
								font: "<?php echo fpd_get_option('fpd_font'); ?>",
								colorPrices: <?php echo $product_settings->get_option('enable_text_color_prices') ? FPD_Settings_Advanced_Colors::get_color_prices() : '{}'; ?>
							},
							customImageParameters: customImagesParams,
							customTextParameters: <?php echo $product_settings->get_custom_text_parameters_string(); ?>,
							labels: <?php echo FPD_Settings_Labels::get_labels_object_string( array(
								'fpd_label_uploadedDesignSizeAlert' => array(
									'minW' => $product_settings->get_option('uploaded_designs_parameter_minW'),
									'minH' => $product_settings->get_option('uploaded_designs_parameter_minH'),
									'maxW' => $product_settings->get_option('uploaded_designs_parameter_maxW'),
									'maxH' => $product_settings->get_option('uploaded_designs_parameter_maxH'),
								)
							)); ?>,
							customAdds: {
								uploads: <?php echo $product_settings->get_option('hide_custom_image_upload') ? 0 : intval(fpd_get_option('fpd_upload_designs')) ?>,
								texts: <?php echo $product_settings->get_option('hide_custom_text') ? 0 : intval(fpd_get_option('fpd_custom_texts')) ?>,
								facebook: <?php echo $product_settings->get_option('hide_facebook_tab') ? 0 : 1 ?>,
								instagram: <?php echo $product_settings->get_option('hide_instagram_tab') ? 0 : 1 ?>
							}
						}).data('fancy-product-designer');

						//when load from cart or order, use loadProduct
						$selector.on('ready', function() {

							if(jQuery('.fpd-lightbox-enabled').size() > 0) {
								jQuery('.fpd-context-dialog').addClass('fpd-modal-hidden');
							}

							if(<?php echo $this->form_views === null ? 0 : 1; ?>) {
								var views = <?php echo $this->form_views === null ? 0 : $this->form_views; ?>;
								fancyProductDesigner.loadProduct(views);
							}

							//replace filereader uploader with php uploader
							if("<?php echo fpd_get_option('fpd_type_of_uploader'); ?>" == 'php') {

								var $imageInput = jQuery('body').find('.fpd-input-image');

								jQuery('body').find('.fpd-upload-form').off('change').change(function() {

									<?php
										$login_required = fpd_get_option('fpd_upload_designs_php_logged_in') !== 0 && !is_user_logged_in() ? 1 : 0;
									?>

									if ( <?php echo $login_required; ?> ) {
										fancyProductDesigner.showModal("<?php _e('You need to be logged in to upload images!', 'radykal'); ?>");
										$imageInput.val('');
										return;
									}

									jQuery('body').find('.fpd-upload-form').ajaxSubmit({
										url: "<?php echo admin_url('admin-ajax.php'); ?>",
										dataType: 'json',
										data: {
											action: 'fpduploadimage',
											product_id: <?php echo $post->ID; ?>
										},
										type: 'post',
										beforeSubmit: function(arr, $form, options) {

											$phpUploaderInfo.addClass('fpd-show-up')
											.children('p:first').text('<?php _e('Uploading', 'radykal'); ?>'+': '+arr[0].value.name);
											$progressBar.children('.fpd-progress-bar-move').css('width', 0);

										},
										success: function(responseText, statusText) {

											if(responseText.code == 200) {
												//successfully uploaded
												fancyProductDesigner.addCustomImage(responseText.url, responseText.filename);
											}
											else {
												//failed
												fancyProductDesigner.showModal(responseText.message);
											}

											$imageInput.val('');
											$phpUploaderInfo.removeClass('fpd-show-up');

										},
										error: function() {

											$imageInput.val('');
											$phpUploaderInfo.removeClass('fpd-show-up');
											fancyProductDesigner.showModal("<?php _e('Server error: Image could not be uploaded, please try again!', 'radykal'); ?>");

										},
										uploadProgress: function(evt, pos, total, percentComplete) {
											$progressBar.children('.fpd-progress-bar-move').css('width', percentComplete+'%');
										}
									});

								})

								jQuery('body').append('<div class="fpd-php-uploader-info fpd-snackbar fpd-shadow-1"><p></p><div class="fpd-upload-progess-bar"><div class="fpd-progress-bar-bg"></div><div class="fpd-progress-bar-move"></div></div></div>');

								$phpUploaderInfo = jQuery('body').children('.fpd-php-uploader-info');
								$progressBar = $phpUploaderInfo.children('.fpd-upload-progess-bar');

							}

							//hide loading icon in customize btn
							customizeBtn.removeClass('fpd-disabled')
							.text(customizeBtn.attr('title')).removeAttr('title');

							isReady = true;

						});

					});

				</script>

				<?php

				//woocommerce
				if( get_post_type( $post ) === 'product' ) {
					$this->output_wc_js();
				}
				else {
					$this->output_shortcode_js();
				}

			}

		}

		public function reset_share_permalink( $url, $post ) {

			if( isset($post->ID) && is_fancy_product( $post->ID ) && isset($_GET['share_id']) ) {
				$url = add_query_arg( 'share_id', $_GET['share_id'], $url );
			}

			return $url;

		}

		public function set_product_image($url) {

			global $post;

			if( isset($post->ID) && is_fancy_product( $post->ID ) && isset($_GET['share_id']) ) {

				$transient_key = 'fpd_share_'.$_GET['share_id'];
				$transient_val = get_transient($transient_key);
				return $transient_val === false ? $url : $transient_val['image_url'];

			}

			return $url;
		}

		public function add_share() {

			global $post;

			$product_settings = new FPD_Product_Settings( $post->ID );
			$open_in_lightbox = $product_settings->get_option('open_in_lightbox') && trim($product_settings->get_option('start_customizing_button')) != '';

			if( is_fancy_product( $post->ID ) && (!$product_settings->customize_button_enabled || $open_in_lightbox) ) {

				echo $this->get_share_html();

			}

		}

		public function create_share_url() {

			if( !isset($_POST['image']) || !isset($_POST['product']) )
				die;

			if (!preg_match('/data:([^;]*);base64,(.*)/', $_POST['image'], $matches)) {
		    	echo json_encode(array(
					'error' => __('Image string is not a valid Data URL.', 'radykal')
				));
				die;
			}

			$share_dir = WP_CONTENT_DIR . '/uploads/fpd_shares/';

			if( !file_exists($share_dir) )
				wp_mkdir_p($share_dir);

			$today = date('Y-m-d');
			$timestamp = strtotime('now');

			if( !file_exists($share_dir.'/'.$today) )
				wp_mkdir_p($share_dir.'/'.$today);

			// Decode the data
			$image_content = base64_decode($matches[2]);
			$image_name = $timestamp.".png";
			//create png from decoded base 64 string and save the image in the parent folder
			$result = @file_put_contents($share_dir.'/'.$today.'/'.$image_name, $image_content);

			if($result === false) {
				echo json_encode(array(
					'error' => __('Image could not be created. Please try again!', 'radykal')
				));
				die;
			}

			//set transient to store product
			$cache_days = intval(fpd_get_option('fpd_sharing_cache_days')) * DAY_IN_SECONDS;

			$transient_val = array(
				'image_url' => content_url('/uploads/fpd_shares/'.$today.'/'.$image_name),
				'product' => $_POST['product']
			);
			$transient_result = set_transient('fpd_share_'.$timestamp, $transient_val, $cache_days);

			if( $transient_result ) {

				echo json_encode(array(
					'share_id' => $timestamp,
					'image_url' => content_url('/uploads/fpd_shares/'.$today.'/'.$image_name)
				));

			}

			die;
		}

		public function fpd_shortcode_handler( $atts ) {

			extract( shortcode_atts( array(
			), $atts, 'fpd' ) );

			ob_start();

			echo $this->add_customize_button();
			echo $this->add_product_designer();

			$output = ob_get_contents();
			ob_end_clean();

			return $output;

		}

		public function fpd_form_shortcode_handler( $atts ) {

			extract( shortcode_atts( array(
				'button' => 'Send',
				'name_placeholder' => 'Enter your name here',
				'email_placeholder' => 'Enter your email here',
				'currency' => '$',
			), $atts, 'fpd_form' ) );

			ob_start();

			?>
			<form name="fpd_shortcode_form">
				<?php if( !empty($currency) ) : ?>
				<p class="fpd-shortcode-price-wrapper"><span class="fpd-shortcode-price"></span><span class="fpd-shortcode-currency"><?php echo $currency ?></span></p>
				<?php endif; ?>
				<input type="text" name="fpd_shortcode_form_name" placeholder="<?php echo $name_placeholder ?>" class="fpd-shortcode-form-text-input" />
				<input type="email" name="fpd_shortcode_form_email" placeholder="<?php echo $email_placeholder ?>" class="fpd-shortcode-form-text-input" />
				<input type="hidden" name="fpd_product" />
				<input type="submit" value="<?php echo $button; ?>" class="fpd-disabled <?php echo fpd_get_option('fpd_start_customizing_css_class'); ?>" />
			</form>
			<?php

			$output = ob_get_contents();
			ob_end_clean();

			return $output;

		}

		//adds a customize button to the summary
		public function add_customize_button( ) {

			global $post;
			$product_settings = new FPD_Product_Settings($post->ID);
			$open_in_lightbox = $product_settings->get_option('open_in_lightbox') && trim($product_settings->get_option('start_customizing_button')) != '';

			$fancy_content_ids = fpd_has_content( $post->ID );
			if( !is_array($fancy_content_ids) || sizeof($fancy_content_ids) === 0 ) { return; }

			if( (is_fancy_product($post->ID) && ($product_settings->customize_button_enabled || $open_in_lightbox )) ) {

				$button_class = trim(fpd_get_option('fpd_start_customizing_css_class')) == '' ? 'fpd-start-customizing-button' : fpd_get_option('fpd_start_customizing_css_class');
				$button_class .= $open_in_lightbox ? ' fpd-disabled' : '';
				$button_class .= fpd_get_option('fpd_start_customizing_button_position') === 'under-short-desc' ? ' fpd-block' : ' fpd-inline';
				$label = $open_in_lightbox ? '' : $product_settings->get_option('start_customizing_button');

				?>
				<a href="<?php echo esc_url( add_query_arg( 'start_customizing', 'yes' ) ); ?>" id="fpd-start-customizing-button" class="<?php echo $button_class; ?>" title="<?php echo $product_settings->get_option('start_customizing_button'); ?>"><?php echo $label; ?></a>
				<?php

			}

		}

		//the additional form fields
		public function add_product_designer_form() {

			global $post;
			$product_settings = new FPD_Product_Settings($post->ID);
			$open_in_lightbox = $product_settings->get_option('open_in_lightbox') && trim($product_settings->get_option('start_customizing_button')) != '';

			if( is_fancy_product($post->ID) && (!$product_settings->customize_button_enabled || $open_in_lightbox) ) {
				?>
				<input type="hidden" value="" name="fpd_product" />
				<input type="hidden" value="" name="fpd_product_price" />
				<input type="hidden" value="" name="fpd_product_thumbnail" />
				<input type="hidden" value="<?php echo isset($_GET['cart_item_key']) ? $_GET['cart_item_key'] : ''; ?>" name="fpd_remove_cart_item" />
				<?php
			}

		}

		private function get_pattern_urls() {

			$urls = array();

			$path = WP_CONTENT_DIR . '/uploads/fpd_patterns/';

			if( file_exists($path) ) {
			  	$folder = opendir($path);

				$pic_types = array("jpg", "jpeg", "png");

				while ($file = readdir ($folder)) {

				  if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types)) {
					  $urls[] = '"'.content_url('/uploads/fpd_patterns/'.$file, FPD_PLUGIN_ROOT_PHP ).'"';
				  }
				}

				closedir($folder);
			}

			return $urls;

		}

		private function get_product_html( $product_id ) {

			$fancy_product = new Fancy_Product($product_id);
			$views_data = $fancy_product->get_views();
			$output = '';

			if( !empty($views_data) ) {

				$first_view = $views_data[0];
				$product_options = fpd_convert_obj_string_to_array($fancy_product->get_options());

				$view_options = fpd_convert_obj_string_to_array($first_view->options);
				$view_options = array_merge((array) $product_options, (array) $view_options);
				$view_options = Fancy_View::options_to_string($view_options);

				ob_start();
				echo "<div class='fpd-product' title='".esc_attr($first_view->title)."' title='".esc_attr($first_view->title)."' data-thumbnail='".esc_attr($first_view->thumbnail)."' data-options='".$view_options."'>";
					echo $this->get_element_anchors_from_view($first_view->elements);

					//sub views
					if( sizeof($views_data) > 1 ) {

						for($i = 1; $i <  sizeof($views_data); $i++) {
							$sub_view = $views_data[$i];

							$view_options = fpd_convert_obj_string_to_array($sub_view->options);
							$view_options = array_merge((array) $product_options, (array) $view_options);
							$view_options = Fancy_View::options_to_string($view_options);

							?>
							<div class="fpd-product" title="<?php echo esc_attr($sub_view->title); ?>" data-thumbnail="<?php echo esc_attr($sub_view->thumbnail); ?>" data-options='<?php echo $view_options; ?>'>
								<?php
								echo $this->get_element_anchors_from_view($sub_view->elements);
								?>
							</div>
							<?php
						}

					}

				echo '</div>'; //product
				$output = ob_get_contents();
				ob_end_clean();
			}

			return $output;

		}

		private function get_element_anchors_from_view($elements) {

			//unserialize when necessary
			if( @unserialize($elements) !== false ) {
				$elements = unserialize($elements);
			}

			$view_html = '';
			if(is_array($elements)) {
				foreach($elements as $element) {
					$element = (array) $element;
					$view_html .= $this->get_element_anchor($element['type'], $element['title'], $element['source'], (array) $element['parameters']);
				}
			}

			return $view_html;

		}

		//return a single element markup
		private function get_element_anchor($type, $title, $source, $parameters) {

			$parameters_string = FPD_Parameters::convert_parameters_to_string($parameters, $type);

			if($type == 'image') {

				return "<img data-src='$source' title='$title' data-parameters='$parameters_string' />";
			}
			else {
				$source = stripslashes($source);
				return "<span title='$title' data-parameters='$parameters_string'>$source</span>";
			}

		}

		//upload photo from social network
		public function upload_social_photo() {

			if( !isset($_POST['url']) )
				die;

			$url = trim($_POST['url']);
			$ext = strtok( pathinfo($url, PATHINFO_EXTENSION), '?');
			$filename = strtotime('now').'.'.$ext;
			$file_path = $this->get_upload_path( $filename );

			$img_formats = array("png", "jpg", "jpeg", "svg");
			if ( !in_array($ext, $img_formats) ) {
				echo json_encode(array('error' => 'This is not an image file!'));
			    die;
			}

			$result = false;
			if( function_exists('curl_exec') ) {
				$ch = curl_init();
				$fp = fopen($file_path, 'wb');
				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$result = curl_exec($ch);
				curl_close($ch);
				fclose($fp);
			}

			if($result == false) {
				$result = file_get_contents($url);
				file_put_contents($file_path, $result);
			}

			$img_url = content_url() . '/uploads/fancy_products_uploads/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $filename;

			echo json_encode( array(
				'image_src' => $img_url,
				'filename' => $filename
			));

			die;

		}

		//ajax image upload handler
		public function upload_image() {

			if( !class_exists('Fancy_Product') ) {
				require_once(FPD_PLUGIN_DIR.'/inc/class-fancy-product.php');
			}

			$product_settings = new FPD_Product_Settings(intval($_POST['product_id']));

			$mb_size =  intval(fpd_get_option('fpd_max_image_size'));
			$maximum_filesize = $mb_size * 1024 * 1000;

			foreach($_FILES as $fieldName => $file) {

				$filename = $file['name'];

				//check if its an image
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!getimagesize($file['tmp_name']) && $ext !== 'svg') {
					echo json_encode(array('code' => 500, 'message' => __('This file is not an image!', 'radykal'), 'filename' => $file['name']));
					die;
				}

				//check for php errors
				if($file['error'] !== UPLOAD_ERR_OK) {
					echo json_encode(array('code' => 500, 'message' => file_upload_error_message($file['error']), 'filename' => $filename));
					die;
				}

				//check for maximum upload size
				if($file['size'] > $maximum_filesize) {
					echo json_encode(array('code' => 500, 'message' => sprintf(__('Uploaded image is too big! Maximum image size is %d MB!', 'radykal'), $mb_size), 'filename' => $filename));
					die;
				}

				//check the minimum DPI
				$dpi = $this->get_image_dpi($file['tmp_name']);
				$min_dpi = fpd_get_option('fpd_minimum_dpi');
				if(isset($dpi[0]) && $dpi[0] !== 0 && $dpi[0] < $min_dpi) {

					echo json_encode( array(
						'code' => 500,
						'message' => sprintf(__('The DPI of the uploaded image is too small! Minimum allowed DPI is %d.', 'radykal'), $min_dpi),
						'filename' => $filename
					) );

					die;

				}

				//check dimensions
				$image_dimensions = getimagesize($file['tmp_name']);
				$filename = sanitize_file_name( $filename );
				$file_path = $this->get_upload_path( $filename );
				$filename = basename($file_path);

				if( @move_uploaded_file($file['tmp_name'], $file_path) ) {

					$img_url = content_url() . '/uploads/fancy_products_uploads/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $filename;

					echo json_encode( array(
						'code' => 200,
						'url' => $img_url,
						'filename' => preg_replace( "/\\.[^.\\s]{3,4}$/", "", $filename ),
						'dim' => $image_dimensions
					) );

				}
				else {

					echo json_encode( array(
						'error' => 2,
						'message' => 'PHP Issue - move_uploaed_file failed',
						'filename' => $filename
					) );

				}

			}

			die;

		}

		//returns the upload path
		private function get_upload_path( $filename ) {

			$upload_path = WP_CONTENT_DIR . '/uploads/fancy_products_uploads/';

			if(!file_exists($upload_path))
				wp_mkdir_p($upload_path);

			$upload_path = $upload_path . '/'. date('Y') . '/';
			if(!file_exists($upload_path))
				wp_mkdir_p($upload_path);

			$upload_path = $upload_path . '/'. date('m') . '/';
			if(!file_exists($upload_path))
				wp_mkdir_p($upload_path);

			$upload_path = $upload_path . '/'. date('d') . '/';
			if(!file_exists($upload_path))
				wp_mkdir_p($upload_path);

			$file_url = $upload_path.$filename;

			$file_counter = 1;
			$real_filename = $filename;

			while(file_exists($file_url)) {
				$real_filename = $file_counter.'-'.$filename;
				$file_url = $upload_path.$real_filename;
				$file_counter++;
			}

			return $file_url;

		}

		private function get_image_dpi( $filename ) {

		    $image = fopen($filename,'r');
		    $string = fread($image, 20);
		    fclose($image);

		    $data = bin2hex(substr($string,14,4));
		    $x = substr($data,0,4);
		    $y = substr($data,0,4);

		    return array(hexdec($x),hexdec($y));

		}

		private function output_wc_start() {

			global $product, $woocommerce;

			$this->disable_export_btns = $product->is_downloadable() ? true : false;

			//added to cart, recall added product
			if( isset($_POST['fpd_product']) ) {

				$views = $_POST['fpd_product'];
				$this->form_views = stripslashes($views);

			}
			else if( isset($_GET['cart_item_key']) ) {

				//load from cart item
				$cart = $woocommerce->cart->get_cart();
				$cart_item = $cart[$_GET['cart_item_key']];
				if($cart_item) {
					if( isset($cart_item['fpd_data']) ) {
						$views = $cart_item['fpd_data']['fpd_product'];
						$this->form_views = stripslashes($views);
					}
				}
				else {
					//cart item could not be found
					echo '<p><strong>';
					_e('Sorry, but the cart item could not be found!', 'radykal');
					echo '</strong></p>';
					return;
				}

			}
			else if( isset($_GET['order']) && isset($_GET['item_id']) ) {

				//load ordered product in designer
				$order = new WC_Order( $_GET['order'] );
				$item_meta = $order->get_item_meta( $_GET['item_id'], 'fpd_data' );
				$this->form_views = $item_meta[0]["fpd_product"];

				if( $product->is_downloadable() && $order->is_download_permitted() ) {
					$this->disable_export_btns = false;
					?>
					<br />
					<a href="#" id="fpd-extern-download-pdf"><?php echo fpd_get_option('fpd_label_downLoadPDF'); ?></a>
					<?php
				}

			}
			else if( isset($_GET['share_id']) ) {

				$transient_key = 'fpd_share_'.$_GET['share_id'];
				$transient_val = get_transient($transient_key);
				if($transient_val !== false)
					$this->form_views = stripslashes($transient_val['product']);
			}

		}

		private function output_wc_js() {

			global $product;

			?>
			<script type="text/javascript">

				//WOOCOMMERCE JS

				var wcPrice = <?php echo $product->get_price() ? $product->get_price() : 0; ?>,
					currencySymbol = '<?php echo get_woocommerce_currency_symbol(); ?>',
					decimalSeparator = "<?php echo get_option('woocommerce_price_decimal_sep'); ?>",
					thousandSeparator = "<?php echo get_option('woocommerce_price_thousand_sep'); ?>",
					numberOfDecimals = <?php echo get_option('woocommerce_price_num_decimals'); ?>,
					currencyPos = "<?php echo get_option('woocommerce_currency_pos'); ?>",
					firstViewImg = null;

				jQuery(document).ready(function() {

					//reset image when variation has changed
					$productWrapper.on('found_variation', '.variations_form', function() {

						if(firstViewImg !== null) {
							setTimeout(_setProductImage, 5);
						}

					});

					jQuery('#fpd-extern-download-pdf').click(function(evt) {

						evt.preventDefault();
						if(productCreated) {
							$selector.find('.fpd-save-pdf').mouseup();
						}
						else {
							fancyProductDesigner.showModal("<?php _e('The product is not created yet, try again when the product has been fully loaded into the designer', 'fpd_label'); ?>");
						}


					});

					//calculate initial price
					$selector.on('productCreate', function() {

						productCreated = true;
						fpdPrice = fancyProductDesigner.getPrice();
						_setTotalPrice();
						if(<?php echo $this->form_views === null ? 0 : 1; ?>) {
							_setProductImage();
						}

					});

					//check when variation has been selected
					jQuery(document).on('found_variation', '.variations_form', function(evt, variation) {

						if(variation.price_html) {

							//- get last price, if a sale price is found, use it
							//- set thousand and decimal separator
							//- parse it as number
							wcPrice = jQuery(variation.price_html).find('span:last').text().replace(currencySymbol,'').replace(thousandSeparator, '').replace(decimalSeparator, '.').replace(/[^\d.]/g,'');
							_setTotalPrice();
						}

					});

					//listen when price changes
					$selector.on('priceChange', function(evt, sp, tp) {

						fpdPrice = tp;
						_setTotalPrice();

					});

					//fill custom form with values and then submit
					$cartForm.on('click', ':submit', function(evt) {

						evt.preventDefault();

						if(!productCreated) { return false; }

						var product = fancyProductDesigner.getProduct();
						if(product != false) {

							$cartForm.find('input[name="fpd_product"]').val(JSON.stringify(product));
							$cartForm.find('input[name="fpd_product_thumbnail"]').val(fancyProductDesigner.getViewsDataURL('png', 'transparent', 0.3)[0]);
							_setTotalPrice();
							$cartForm.submit();
							$('.single_add_to_cart_button').addClass('fpd-disabled');
						}

					});

					//set product image
					if($modalWrapper !== null) {
						$modalWrapper.on('click', '#fpd-modal-done', function(evt) {

							if($selector.parents('.woocommerce').size() > 0) {
								_setProductImage();
							}

							evt.preventDefault();

						});
					}

					//set total price depending from wc and fpd price
					function _setTotalPrice() {

						var totalPrice = parseFloat(wcPrice) + parseFloat(fpdPrice),
							htmlPrice;

						totalPrice = totalPrice.toFixed(numberOfDecimals);
						htmlPrice = totalPrice.toString().replace('.', decimalSeparator);
						if(thousandSeparator.length > 0) {
							htmlPrice = _addThousandSep(htmlPrice);
						}

						if(currencyPos == 'right') {
							htmlPrice = htmlPrice + currencySymbol;
						}
						else if(currencyPos == 'right_space') {
							htmlPrice = htmlPrice + ' ' + currencySymbol;
						}
						else if(currencyPos == 'left_space') {
							htmlPrice = currencySymbol + ' ' + htmlPrice;
						}
						else {
							htmlPrice = currencySymbol + htmlPrice;
						}

						//check if variations are used
						if($productWrapper.find('.variations_form').size() > 0) {
							//check if amount contains 2 prices or sale prices. If yes different prices are used
							if($productWrapper.find('.price:first > .amount').size() == 2 || $productWrapper.find('.price:first ins > .amount').size() == 2) {
								//different prices
								$productWrapper.find('.single_variation .price .amount:last').html(htmlPrice);
							}
							else {
								//same price
								$productWrapper.find('.price:first .amount:last').html(htmlPrice);
							}

						}
						//no variations are used
						else {
							$productWrapper.find('.price:first .amount:last').html(htmlPrice);
						}

						$cartForm.find('input[name="fpd_product_price"]').val(fpdPrice);

					};

					function _addThousandSep(n){

					    var rx=  /(\d+)(\d{3})/;
					    return String(n).replace(/^\d+/, function(w){
					        while(rx.test(w)){
					            w= w.replace(rx, '$1'+thousandSeparator+'$2');
					        }
					        return w;
					    });

					};

				});

				function _setProductImage() {

					if(jQuery('.fpd-lightbox-enabled').size() > 0 && <?php echo fpd_get_option('fpd_lightbox_update_product_image'); ?>) {
						firstViewImg = fancyProductDesigner.getViewsDataURL('png', 'transparent')[0];
						$productWrapper.find('div.images img:eq(0)').attr('src', firstViewImg).parent('a').attr('href', firstViewImg);
					}

				};

			</script>
			<?php
		}

		private function output_shortcode_js() {

			?>
			<script type="text/javascript">

				jQuery(document).ready(function() {

					//calculate initial price
					$selector.on('productCreate', function() {

						productCreated = true;
						$cartForm.find(':submit').removeClass('fpd-disabled');
						fpdPrice = fancyProductDesigner.getPrice();
						_setTotalPrice();


					});

					//listen when price changes
					$selector.on('priceChange', function(evt, sp, tp) {

						fpdPrice = tp;
						_setTotalPrice();

					});

					jQuery('[name="fpd_shortcode_form"]').on('click', ':submit', function(evt) {

						evt.preventDefault();

						if(!productCreated) { return false; }

						var product = fancyProductDesigner.getProduct(),
							$submitBtn = $(this),
							data = {
								action: 'fpd_newshortcodeorder'
							};

						if(product != false) {

							var $nameInput = $cartForm.find('[name="fpd_shortcode_form_name"]').removeClass('fpd-error'),
								$emailInput = $cartForm.find('[name="fpd_shortcode_form_email"]').removeClass('fpd-error'),
								emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


							if( $nameInput.val() === '' ) {
								$nameInput.focus().addClass('fpd-error');
								return false;
							}
							else {
								data.name = $nameInput.val();
							}

							if( !emailRegex.test($emailInput.val()) ) {
								$emailInput.focus().addClass('fpd-error');
								return false;
							}
							else {
								data.email = $emailInput.val();
							}

							data.product = JSON.stringify(product);
							$submitBtn.addClass('fpd-disabled');
							$selector.find('.fpd-full-loader').show();

							jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {

								fancyProductDesigner.showMessage(response.id ? response.message : response.error);
								$submitBtn.removeClass('fpd-disabled');
								$selector.find('.fpd-full-loader').hide();

							}, 'json');

							$nameInput.val('');
							$emailInput.val('');

						}

					});

					//set total price depending from wc and fpd price
					function _setTotalPrice() {

						$cartForm.find('.fpd-shortcode-price').text(parseFloat(fpdPrice).toFixed(2))
						.parent().addClass('fpd-show-up');

					};

				});

			</script>
			<?php

		}

		public function create_shortcode_order() {

			if( !isset($_POST['product']) )
				die;

			if( !class_exists('FPD_Shortcode_Order') ) {
				require_once(FPD_PLUGIN_DIR.'/inc/class-shortcode-order.php');
			}

			$insert_id = FPD_Shortcode_Order::create( $_POST['name'], $_POST['email'], $_POST['product']);

			if( $insert_id ) {
				echo json_encode(array(
					'id' => $insert_id,
					'message' => fpd_get_option( 'fpd_label_order_success_sent' ),
				));
			}
			else {

				echo json_encode(array(
					'error' => fpd_get_option( 'fpd_label_order_fail_sent' ),
				));

			}

			die;

		}

		private function get_share_html() {

			ob_start();
			?>
			<div class="fpd-share-design fpd-clearfix">
				<a href="#" id="fpd-share-button" class="<?php echo fpd_get_option('fpd_start_customizing_css_class'); ?>" ><i class="fa fa-share-alt"></i><?php echo fpd_get_option('fpd_label_sharing_button'); ?></a>
				<div>
					<p class="fpd-share-process fpd-hidden"><?php echo fpd_get_option('fpd_label_sharing_processing'); ?></p>
					<div class="fpd-share-widget"></div>
					<a href="" target="_blank" class="fpd-share-url fpd-hidden"></a>
				</div>
			</div>
			<?php

			$output = ob_get_contents();
			ob_end_clean();

			return $output;

		}

		private function file_upload_error_message($error_code) {

		    switch ($error_code) {
		        case UPLOAD_ERR_INI_SIZE:
		            return __('The uploaded file exceeds the upload_max_filesize directive in php.ini', 'radykal');
		        case UPLOAD_ERR_FORM_SIZE:
		            return __('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form', 'radykal');
		        case UPLOAD_ERR_PARTIAL:
		            return __('The uploaded file was only partially uploaded', 'radykal');
		        case UPLOAD_ERR_NO_FILE:
		            return __('No file was uploaded', 'radykal');
		        case UPLOAD_ERR_NO_TMP_DIR:
		            return __('Missing a temporary folder', 'radykal');
		        case UPLOAD_ERR_CANT_WRITE:
		            return __('Failed to write file to disk', 'radykal');
		        case UPLOAD_ERR_EXTENSION:
		            return __('File upload stopped by extension', 'radykal');
		        default:
		            return __('Unknown upload error', 'radykal');
		    }

		}
	}
}

new FPD_Frontend_Product();

?>