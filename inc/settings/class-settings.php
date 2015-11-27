<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Settings') ) {

	class FPD_Settings {

		public static $radykal_settings;

		public function __construct() {

			add_action( 'init', array( &$this, 'init') );
			add_action( 'radykal_save_options', array( &$this, 'options_saved') );

		}

		public function init() {

			if ( !class_exists('Radykal_Settings') ) {
				require_once(FPD_PLUGIN_DIR.'/framework/class-admin-settings.php');
			}

			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-general-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-default-element-options-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-labels-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-fonts-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-advanced-color-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-wc-settings.php');

			//create new settings instance
			$tabs = array(
				'general' => __('General', 'radykal'),
				'default_element_options' => __('Default Element Options', 'radykal'),
				'labels' => __('Labels', 'radykal'),
				'fonts' => __('Fonts', 'radykal'),
				'advanced_colors' => __('Advanced Color Config.', 'radykal'),
			);

			if( function_exists('get_woocommerce_currency') ) {
				$tabs['woocommerce'] = __('WooCommerce', 'radykal');
			}

			self::$radykal_settings = new Radykal_Settings( array(
					'page_id' => 'fpd_settings',
					'tabs' => $tabs
				)
			);

			//first add blocks
			self::$radykal_settings->add_blocks(array(
					'general' => array(
						'layout-skin' => __('Layout & Skin', 'radykal'),
						'colors' => __('Colors', 'radykal'),
						'user-interface' => __('User Interface', 'radykal'),
						'misc' => __('Miscellaneous', 'radykal'),
						'troubleshooting' => __('Troubleshooting', 'radykal'),
					),
					'default_element_options' => array(
						'default-image-options' => __('Image Options', 'radykal'),
						'default-custom-image-options' => __('Custom Image Options', 'radykal'),
						'default-custom-text-options' => __('Custom Text Options', 'radykal'),
						'default-common-options' => __('Common Options', 'radykal'),
					),
					'labels' => array(
						'product-designer' => __('Product Designer', 'radykal'),
						'misc-labels' => __('Miscellaneous', 'radykal'),
					),
					'fonts' => array(
						'fonts' => __('Fonts for the typeface dropdown', 'radykal'),
					),
					'advanced_colors' => array(
						'hex-names' => __('Define names for your hexadecimal colors.', 'radykal'),
						'color-prices' => __('Set own prices for your hexadecimal colors.', 'radykal'),
					),
					'woocommerce' => array(
						'wc-product-page' => __('Product Page', 'radykal'),
						'wc-sharing' => __('Design Sharing', 'radykal'),
						'wc-catalog-listing' => __('Catalog Listing', 'radykal'),
					)
				)
			);

			self::$radykal_settings->add_blocks_description(array(
				'default-image-options' => __('The default options for custom uploaded images, facebook/instagram photos and Fancy Designs.', 'radykal'),
				'default-custom-image-options' => __('The default options for uploaded images by the customer.', 'radykal'),
				'default-custom-text-options' => __('The default options for added texts by the customer.', 'radykal'),
			));

			//add general settings
			$general_options = FPD_Settings_General::get_options();
			self::$radykal_settings->add_block_options( 'layout-skin', $general_options['layout-skin']);
			self::$radykal_settings->add_block_options( 'colors', $general_options['colors']);
			self::$radykal_settings->add_block_options( 'user-interface', $general_options['user-interface']);
			self::$radykal_settings->add_block_options( 'misc', $general_options['misc']);
			self::$radykal_settings->add_block_options( 'troubleshooting', $general_options['troubleshooting']);

			//add default element options settings
			$default_element_options = FPD_Settings_Default_Element_Options::get_options();
			self::$radykal_settings->add_block_options( 'default-image-options', $default_element_options['default-image-options']);
			self::$radykal_settings->add_block_options( 'default-custom-image-options', $default_element_options['default-custom-image-options']);
			self::$radykal_settings->add_block_options( 'default-custom-text-options', $default_element_options['default-custom-text-options']);
			self::$radykal_settings->add_block_options( 'default-common-options', $default_element_options['default-common-options']);

			//add labels settings
			$labels_options = FPD_Settings_Labels::get_options();
			self::$radykal_settings->add_block_options( 'product-designer', $labels_options['product-designer']);
			self::$radykal_settings->add_block_options( 'misc-labels', $labels_options['misc-labels']);

			//add fonts settings
			$fonts_options = FPD_Settings_Fonts::get_options();
			self::$radykal_settings->add_block_options( 'fonts', $fonts_options['fonts']);

			//add advanced color settings
			$advanced_color_options = FPD_Settings_Advanced_Colors::get_options();
			self::$radykal_settings->add_block_options( 'hex-names', $advanced_color_options['hex-names']);
			self::$radykal_settings->add_block_options( 'color-prices', $advanced_color_options['color-prices']);

			//add wc settings
			$wc_options = FPD_Settings_WooCommerce::get_options();
			self::$radykal_settings->add_block_options( 'wc-product-page', $wc_options['wc-product-page']);
			self::$radykal_settings->add_block_options( 'wc-sharing', $wc_options['wc-sharing']);
			self::$radykal_settings->add_block_options( 'wc-catalog-listing', $wc_options['wc-catalog-listing']);

		}

		public function options_saved( $tab ) {

			if( $tab == 'fonts') {

				FPD_Settings_Fonts::save_woff_fonts_css();

			}
		}
	}
}

new FPD_Settings();
?>