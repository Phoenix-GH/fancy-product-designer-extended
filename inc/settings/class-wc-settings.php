<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Settings_WooCommerce') ) {

	class FPD_Settings_WooCommerce {

		public static function get_options() {

			return apply_filters('fpd_woocommerce_settings', array(

				'wc-product-page' => array(

					array(
						'title' 	=> __( 'Product Designer Positioning', 'radykal' ),
						'description' 		=> __( 'The position of the product designer in the product page.', 'radykal' ),
						'id' 		=> 'fpd_placement',
						'css' 		=> 'min-width:350px;',
						'default'	=> 'fpd-replace-image',
						'type' 		=> 'radio',
						'options'   => self::get_product_designer_positions()
					),

					array(
						'title' 	=> __( 'Product Designer Floating', 'radykal' ),
						'description' 		=> __( 'Set a float position for the product designer container. Useful if you would like to position the summary beside the product designer.', 'radykal' ),
						'id' 		=> 'fpd_designer_floating',
						'default'	=> 'none',
						'type' 		=> 'radio',
						'options'   => array(
							'none'	 => __( 'None', 'radykal' ),
							'left'	 => __( 'Left', 'radykal' ),
							'right'	 => __( 'Right', 'radykal' ),
						)
					),

					array(
						'title' => __( 'Hide Product Image', 'radykal' ),
						'description' 		=> __( 'Hide product image in the product page.', 'radykal' ),
						'id' 		=> 'fpd_hide_product_image',
						'default'	=> 'no',
						'type' 		=> 'radio',
						'options'   => array(
							'yes'	 => __( 'Yes', 'radykal' ),
							'no'	 => __( 'No', 'radykal' ),
						)
					),

					array(
						'title' => __( 'Fullwidth Summary', 'radykal' ),
						'description' 		=> __( 'Forces the summary (includes i.e. product title, price, add-to-cart button) to be fullwidth.', 'radykal' ),
						'id' 		=> 'fpd_fullwidth_summary',
						'default'	=> 'no',
						'type' 		=> 'radio',
						'options'   => array(
							'yes'	 => __( 'Yes', 'radykal' ),
							'no'	 => __( 'No', 'radykal' ),
						)
					),

					array(
						'title' 	=> __( 'Lightbox: Update Product Image', 'radykal' ),
						'description'	 	=> __( 'When "Done" button is clicked, update the WooCommerce product image.', 'radykal' ),
						'id' 		=> 'fpd_lightbox_update_product_image',
						'default'	=> 'yes',
						'type' 		=> 'checkbox',
					),

					array(
						'title' 	=> __( '"Start Customizing" Button Positioning', 'radykal' ),
						'description' 		=> __( 'When the "Start Customizing" button is enabled, set the positiong in the product page of it.', 'radykal' ),
						'id' 		=> 'fpd_start_customizing_button_position',
						'default'	=> 'under-short-desc',
						'type' 		=> 'radio',
						'options'   => array(
							'under-short-desc'	 => __( 'Under Short Description', 'radykal' ),
							'after-add-to-cart-button'	 => __( 'After Add-to-Cart Button', 'radykal' ),
						)
					),

				), //product page

				'wc-sharing' => array(

					array(
						'title' => __( 'Enable Design Sharing', 'radykal' ),
						'description' 		=> __( 'Allow users to share their design on social networks.', 'radykal' ),
						'id' 		=> 'fpd_sharing',
						'default'	=> 'no',
						'type' 		=> 'radio',
						'options'   => array(
							'yes'	 => __( 'Yes', 'radykal' ),
							'no'	 => __( 'No', 'radykal' ),
						)
					),

					array(
						'title' => __( 'Cache Days', 'radykal' ),
						'description' 		=> __( 'Whenever an user shares a design, an image and database entry will be created. To delete this data after a certain period of time, you can set the days of caching. A value of 0 will store the data forever.', 'radykal' ),
						'id' 		=> 'fpd_sharing_cache_days',
						'default'	=> 5,
						'type' 		=> 'number',
						'custom_attributes' => array(
							'min' 	=> 0,
							'step' 	=> 1
						)
					),

					array(
						'title' => __( 'Social Networks', 'radykal' ),
						'id' 		=> 'fpd_sharing_social_networks',
						'css' 		=> 'width:300px;',
						'default'	=> array('facebook', 'twitter', 'googleplus', 'email'),
						'type' 		=> 'multiselect',
						'class'		=> 'radykal-select2',
						'options'   => array(
							"facebook" => 'Facebook',
							"twitter" => 'Twitter',
							"googleplus" => 'Google Plus',
							"linkedin" => 'Linkedin',
							"pinterest" => 'Pinterest',
							"email" => 'Email',
						)
					),

				),

				'wc-catalog-listing' => array(

					array(
						'title' 	=> __( 'Customize Button Positioning', 'radykal' ),
						'description' 		=> __( 'The position of the button in the catalog listing.', 'radykal' ),
						'id' 		=> 'fpd_catalog_button_position',
						'css' 		=> 'min-width:350px;',
						'default'	=> 'fpd-replace-add-to-cart',
						'type' 		=> 'radio',
						'options'   => array(
							"fpd-replace-add-to-cart" => 'Replace Add-to-Cart button',
							"fpd-item-end" => 'End of catalog item',
						)
					),

				)

			));
		}

		/**
		 * Get the available positions.
		 *
		 */
		public static function get_product_designer_positions() {

			return  array(
				'fpd-replace-image'	 => __( 'Replace Product Image', 'radykal' ),
				'fpd-under-title'	 => __( 'Under Product Title', 'radykal' ),
				'fpd-after-summary'	 => __( 'After Summary', 'radykal' ),
				'fpd-custom-hook' => __( 'Custom Hook', 'radykal' ),
			);

		}

	}
}

?>