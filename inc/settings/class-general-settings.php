<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Settings_General') ) {

	class FPD_Settings_General {

		public static function get_options() {

			return apply_filters('fpd_general_settings', array(

				'layout-skin' => array(

					array(
						'title' => __( 'Product Designer Width', 'radykal' ),
						'id' 		=> 'fpd_stage_width',
						'css' 		=> 'width:70px;',
						'default'	=> '1000',
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 1
						)
					),

					array(
						'title' => __( 'Product Designer Stage Height', 'radykal' ),
						'id' 		=> 'fpd_stage_height',
						'css' 		=> 'width:70px;',
						'default'	=> '600',
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 1
						)
					),

					array(
						'title' => __( 'Product Designer Frame Shadow', 'radykal' ),
						'id' 		=> 'fpd_frame_shadow',
						'css' 		=> 'width:300px;',
						'default'	=> 'fpd-shadow-1',
						'type' 		=> 'select',
						'class'		=> 'radykal-select2',
						'options'   => self::get_frame_shadows()
					),

					array(
						'title' => __( 'Dialog Box Positioning', 'radykal' ),
						'id' 		=> 'fpd_dialog_box_positioning',
						'css' 		=> 'width:300px;',
						'default'	=> 'dynamic',
						'type' 		=> 'select',
						'class'		=> 'radykal-select2',
						'options'   => self::get_dialog_box_positionings()
					),

					array(
						'title' 	=> __( 'View Selection Positioning', 'radykal' ),
						'id' 		=> 'fpd_view_selection_position',
						'css' 		=> 'width:300px;',
						'default'	=> 'tr',
						'type' 		=> 'select',
						'class'		=> 'radykal-select2',
						'options'   => self::get_view_selection_posititions_options()
					),

					array(
						'title' 	=> __( 'View Selection Items Floating', 'radykal' ),
						'description'	 	=> __( 'Enable floating for the items in the view selection, so these are aligned in one line.', 'radykal' ),
						'id' 		=> 'fpd_view_selection_floated',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' 	=> __( 'Product Designer Margin', 'radykal' ),
						'id' 		=> 'fpd_designer_margin',
						'type' 		=> 'multivalues',
						'default' 	=> '',
						'options'   => array(
							'Top'	 => 0,
							'Right'	 => 0,
							'Bottom' => 0,
							'Left'   => 0
						),
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 1
						)
					),

					array(
						'title' 	=> __( 'Hide On Smartphones', 'radykal' ),
						'description'	 	=> sprintf(__( 'Hide product designer on smartphones and display an <a href="%s">information</a> instead.', 'radykal'), esc_url(admin_url('admin.php?page=fpd_settings&tab=labels#fpd_label_not_supported_device_info')) ),
						'id' 		=> 'fpd_disable_on_smartphones',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' 	=> __( 'Hide On Tablets', 'radykal' ),
						'description'	 	=> sprintf(__( 'Hide product designer on tablets and display an <a href="%s">information</a> instead.', 'radykal' ), esc_url(admin_url('admin.php?page=fpd_settings&tab=labels#fpd_label_not_supported_device_info')) ),
						'id' 		=> 'fpd_disable_on_tablets',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( 'Custom CSS', 'radykal' ),
						'description' 		=> __( 'Add custom CSS to pages with the product designer enabled:', 'radykal' ),
						'id' 		=> 'fpd_custom_css',
						'type' 		=> 'ace-editor',
						'css' 	=> 'height: 200px;',
						'default'	=> ''
					),

					array(
						'title' => __( 'Button CSS class', 'radykal' ),
						'description' 		=> __( 'The CSS button class.', 'radykal' ),
						'id' 		=> 'fpd_start_customizing_css_class',
						'css' 		=> 'width:500px;',
						'default'	=> 'fpd-blue-btn',
						'type' 		=> 'text'
					),

				), //layout-skin

				'colors' => array(

					array(
						'title' => __( 'Designer Primary Color', 'radykal' ),
						'id' 		=> 'fpd_designer_primary_color',
						'default'	=> '#2C3E50',
						'type' 		=> 'colorpicker'
					),

					array(
						'title' => __( 'Designer Secondary Color', 'radykal' ),
						'id' 		=> 'fpd_designer_secondary_color',
						'default'	=> '#27AE60',
						'type' 		=> 'colorpicker'
					),

					array(
						'title' => __( 'Designer Text Primary Color', 'radykal' ),
						'id' 		=> 'fpd_designer_primary_text_color',
						'default'	=> '#ffffff',
						'type' 		=> 'colorpicker'
					),

					array(
						'title' => __( 'Designer Text Secondary Color', 'radykal' ),
						'id' 		=> 'fpd_designer_secondary_text_color',
						'default'	=> '#ffffff',
						'type' 		=> 'colorpicker'
					),

					array(
						'title' => __( 'Element Selected Color', 'radykal' ),
						'id' 		=> 'fpd_selected_color',
						'default'	=> '#3f51b5',
						'type' 		=> 'colorpicker'
					),

					array(
						'title' => __( 'Bounding Box Color', 'radykal' ),
						'id' 		=> 'fpd_bounding_box_color',
						'default'	=> '#2196f3',
						'type' 		=> 'colorpicker'
					),

					array(
						'title' => __( 'Out of Bounding Box Color', 'radykal' ),
						'id' 		=> 'fpd_out_of_boundary_color',
						'default'	=> '#f44336',
						'type' 		=> 'colorpicker'
					),

				), //colors

				'user-interface' => array(

					array(
						'title' 	=> __( 'Custom Image Upload', 'radykal' ),
						'description'	 	=> __( 'Let customers upload their own images to products?', 'radykal' ),
						'id' 		=> 'fpd_upload_designs',
						'default'	=> 'yes',
						'type' 		=> 'radio',
						'options'   => array(
							'yes'	 => __( 'Yes', 'radykal' ),
							'no'	 => __( 'No', 'radykal' )
						)
					),

					array(
						'title' 	=> __( 'Custom Text', 'radykal' ),
						'description'	 	=> __( 'Let customers add their own text elements to products?', 'radykal' ),
						'id' 		=> 'fpd_custom_texts',
						'default'	=> 'yes',
						'type' 		=> 'radio',
						'options'   => array(
							'yes'	 => __( 'Yes', 'radykal' ),
							'no'	 => __( 'No', 'radykal' )
						)
					),

					array(
						'title' => __( 'Download Product Image', 'radykal' ),
						'description' 		=> __( 'Let customers download a product image?', 'radykal' ),
						'id' 		=> 'fpd_download_product_image',
						'default'	=> 'yes',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( 'Save as PDF', 'radykal' ),
						'description' 		=> __( 'Let customers save the product as PDF?', 'radykal' ),
						'id' 		=> 'fpd_pdf_button',
						'default'	=> 'yes',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( 'Print', 'radykal' ),
						'description' 		=> __( 'Let customers print the product?', 'radykal' ),
						'id' 		=> 'fpd_print',
						'default'	=> 'yes',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( 'Allow Product Saving', 'radykal' ),
						'description' 		=> __( 'Let customers save their customized products?', 'radykal' ),
						'id' 		=> 'fpd_allow_product_saving',
						'default'	=> 'yes',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( 'Tooltips', 'radykal' ),
						'description' 		=> __( 'Use tooltips in the product designer.', 'radykal' ),
						'id' 		=> 'fpd_tooltips',
						'default'	=> 'yes',
						'type' 		=> 'checkbox'
					),

				), //user-interface

				'misc' => array(

					array(
						'title' => __( 'Image Uploader', 'radykal' ),
						'id' 		=> 'fpd_type_of_uploader',
						'default'	=> 'filereader',
						'type' 		=> 'radio',
						'description'	=>  __( 'Filereader is a Javascript-based uploader, the image will not be uploaded to your server. The PHP uploader will upload the image to your server and saves it into wp-content/uploads/fancy_products_uploads/ directory.', 'radykal' ),
						'options'	=> array(
							'filereader' => __( 'Filereader Uploader', 'radykal' ),
							'php' => __( 'PHP Uploader', 'radykal' )
						),
						'relations' => array(
							'filereader' => array(
								'fpd_max_image_size' => false,
								'fpd_upload_designs_php_logged_in' => false,
								'fpd_min_dpi' => false
							),
							'php' => array(
								'fpd_max_image_size' => true,
								'fpd_upload_designs_php_logged_in' => true,
								'fpd_min_dpi' => true
							)
						)
					),

					array(
						'title' 	=> __( 'Maximum Image Size (MB)', 'radykal' ),
						'description' 		=> __( 'The maximum image size in Megabytes, when using the PHP uploader.', 'radykal' ),
						'id' 		=> 'fpd_max_image_size',
						'css' 		=> 'width:70px;',
						'default'	=> '1',
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 1
						)
					),

					array(
						'title' 	=> __( 'Minimum Allowed DPI', 'radykal' ),
						'description' 		=> __( 'The minimum allowed DPI, when using the PHP uploader.', 'radykal' ),
						'id' 		=> 'fpd_minimum_dpi',
						'css' 		=> 'width:70px;',
						'default'	=> '72',
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 1
						)
					),

					array(
						'title' 	=> __( 'Only logged-in users can upload images?', 'radykal' ),
						'description'	 	=> __( 'Because the PHP uploader uploads the image to your web server, you can allow the image upload for logged-in users only.', 'radykal' ),
						'id' 		=> 'fpd_upload_designs_php_logged_in',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( 'Facebook App-ID', 'radykal' ),
						'description' 		=> __( 'To allow users to add photos from facebook, you have to enter a Facebook App-Id.', 'radykal' ),
						'id' 		=> 'fpd_facebook_app_id',
						'css' 		=> 'width:500px;',
						'default'	=> '',
						'type' 		=> 'text'
					),

					array(
						'title' => __( 'Instagram Client ID', 'radykal' ),
						'description' 		=> __( 'To allow users to add photos from instagram, you have to enter a Instagram Client ID.', 'radykal' ),
						'id' 		=> 'fpd_instagram_client_id',
						'css' 		=> 'width:500px;',
						'default'	=> '',
						'type' 		=> 'text'
					),

					array(
						'title' => __( 'Instagram Redirect URI', 'radykal' ),
						'description' 		=> __( 'This is the URI you need to paste in as OAuth Redirect URI when creating a Instagram Client ID. Do not change it!', 'radykal' ),
						'id' 		=> 'fpd_instagram_redirect_uri',
						'css' 		=> 'width:500px;',
						'default'	=> plugins_url( '/inc/instagram_auth.php', dirname(__FILE__) ),
						'type' 		=> 'text'
					),

					array(
						'title' => __( 'Zoom Factor', 'radykal' ),
						'description' 		=> __( 'The step for zooming in and out.', 'radykal' ),
						'id' 		=> 'fpd_zoom_step',
						'default'	=> '0.2',
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 0.1
						)
					),

					array(
						'title' => __( 'Maximum Zoom', 'radykal' ),
						'description' 		=> __( 'The maximum zoom when zooming in. Set it to "1" to disable the zoom feature.', 'radykal' ),
						'id' 		=> 'fpd_max_zoom',
						'css' 		=> 'width:60px;',
						'default'	=> '3',
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 1,
							'step' 	=> 0.1
						)
					),

					array(
						'title' => __( 'Padding Controls', 'radykal' ),
						'description' 		=> __( 'The padding of the controls when an element is selected in the product stage.', 'radykal' ),
						'id' 		=> 'fpd_padding_controls',
						'css' 		=> 'width:60px;',
						'default'	=> '10',
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 1
						)
					),

					array(
						'title' 	=> __( 'Replace Initial Elements', 'radykal' ),
						'description'	 	=> __( 'When a product designer contains multiple Fancy Products and the customer adds custom elements to it and chooses another Fancy Product, only the initial elements will be replaced.', 'radykal' ),
						'id' 		=> 'fpd_replace_initial_elements',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' 	=> __( 'Lazy Load', 'radykal' ),
						'description'	 	=> __( 'Enable lazy loading for the images in the products and designs containers.', 'radykal' ),
						'id' 		=> 'fpd_lazy_load',
						'default'	=> 'yes',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( '"Start Customizing" Button', 'radykal' ),
						'description' 		=> __( 'Enable a "Start Customizing" Button, that will show the standard product first. The product designer will come up first, if the customer clicks on this button. Just enter a text for the button to enable this feature.', 'radykal' ),
						'id' 		=> 'fpd_start_customizing_button',
						'css' 		=> 'width:500px;',
						'default'	=> '',
						'type' 		=> 'text'
					),

					array(
						'title' 	=> __( 'Open in lightbox', 'radykal' ),
						'description'	 	=> __( 'When using the "Start Customizing" button, open product designer in a lightbox.', 'radykal' ),
						'id' 		=> 'fpd_open_in_lightbox',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' 	=> __( 'Lightbox: Add to cart', 'radykal' ),
						'description'	 	=> __( 'When clicking the submit button in the lightbox, add designed product directly into cart.', 'radykal' ),
						'id' 		=> 'fpd_lightbox_add_to_cart',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' 	=> __( 'Use Label Settings', 'radykal' ),
						'description'	 	=> __( 'Use the labels from the "Labels" settings page. If you want to translate the labels with a multilingual plugin like WPML, deactivate this option.', 'radykal' ),
						'id' 		=> 'fpd_use_label_settings',
						'default'	=> 'yes',
						'type' 		=> 'checkbox'
					),

				),

				'troubleshooting' => array(

					array(
						'title' 	=> __( 'Debug Mode', 'radykal' ),
						'description' 		=> __( 'Enables Theme-Check modal and loads the unminified Javascript files.', 'radykal' ),
						'id' 		=> 'fpd_debug_mode',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' 	=> __( 'jQuery No Conflict Mode', 'radykal' ),
						'description' 		=> __( 'Turns on the jQuery no conflict mode. Turn it on if you are facing some Javascript issues.', 'radykal' ),
						'id' 		=> 'fpd_jquery_no_conflict',
						'default'	=> 'off',
						'type' 		=> 'radio',
						'options'   => array(
							'on'	 => __( 'On', 'radykal' ),
							'off'	 => __( 'Off', 'radykal' ),
						)
					),

				),

			));
		}


		/**
		 * Get the available frame shadows.
		 *
		 */
		public static function get_frame_shadows() {

			return array(
				'fpd-shadow-1'	 => __( 'Shadow 1', 'radykal' ),
				'fpd-shadow-2'	 => __( 'Shadow 2', 'radykal' ),
				'fpd-shadow-3'	 => __( 'Shadow 3', 'radykal' ),
				'fpd-shadow-4'	 => __( 'Shadow 4', 'radykal' ),
				'fpd-shadow-5'	 => __( 'Shadow 5', 'radykal' ),
				'fpd-shadow-6'	 => __( 'Shadow 6', 'radykal' ),
				'fpd-shadow-7'	 => __( 'Shadow 7', 'radykal' ),
				'fpd-shadow-8'	 => __( 'Shadow 8', 'radykal' ),
				'fpd-no-shadow'	 => __( 'No Shadow ', 'radykal' ),
			);

		}

		/**
		 * Get the available dialog box positionings.
		 *
		 */
		public static function get_dialog_box_positionings() {

			return array(
				'dynamic'	 => __( 'Dynamic', 'radykal' ),
				'left'	 => __( 'Fixed Left', 'radykal' ),
				'right'	 => __( 'Fixed Right', 'radykal' ),
			);

		}

		/**
		 * Get the view selection positions options
		 *
		 */
		public static function get_view_selection_posititions_options() {

			return array(
				'tr'	 => __( 'Top-Right in Product Stage', 'radykal' ),
				'tl' => __( 'Top-Left in Product Stage', 'radykal' ),
				'br'	 => __( 'Bottom-Right in Product Stage', 'radykal' ),
				'bl' => __( 'Bottom-Left in Product Stage', 'radykal' ),
				'outside' => __( 'Under the Product Stage', 'radykal' )
			);

		}

	}
}

?>