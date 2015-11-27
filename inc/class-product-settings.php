<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('FPD_Product_Settings')) {

	class FPD_Product_Settings {

		public $id;
		public $master_id;
		public $individual_settings = array();
		public $customize_button_enabled = false;

		public function __construct( $id ) {

			$this->id = $id;

			//get master id if wpml is enabled
			global $sitepress;

			$this->master_id = $id;
			if($sitepress && method_exists($sitepress, 'get_original_element_id')) {
				$this->master_id = $sitepress->get_original_element_id($id, 'post_product');
			}

			//get individual product options
			$product_settings_array = array();
			$product_settings = get_post_meta( $this->master_id, 'fpd_product_settings', true );
			if( !empty($product_settings) ) {

				$product_settings_array = json_decode(html_entity_decode($product_settings), true);
				//remove elements with empty value
				if( is_array($product_settings_array) ) {
					$product_settings_array = array_filter($product_settings_array, array( &$this, 'remove_empty_values'));
				}

			}

			$this->individual_settings = $product_settings_array;

			//check if customize button is enabled
			$this->customize_button_enabled = trim($this->get_option('start_customizing_button')) != '' && !isset($_GET['start_customizing']) && !isset($_GET['cart_item_key']);

		}

		/**
		 * 	Returns an option from the individual settings. If no option is not found in the individual settings, it will return the option from the main settings.
		 */
		public function get_option( $name ) {

			if( isset($this->individual_settings[$name]) ) {
				$value = fpd_convert_string_value_to_int($this->individual_settings[$name]);
			}
			else {
				$value = fpd_get_option( 'fpd_'.$name );
			}

			return $value;

		}

		/**
		 * 	Returns an option from the individual settings.
		*/
		public function get_individual_option( $name ) {

			return isset($this->individual_settings[$name]) ?  $this->individual_settings[$name] : false;

		}

		/**
		 * 	Returns the assigned Fancy Categories of a woocoomerce product.
		*/
		public function get_content_ids() {

			$source_type = get_post_meta( $this->master_id, 'fpd_source_type', true );

			return empty($source_type) || $source_type == 'category' ? get_post_meta( $this->master_id, 'fpd_product_categories', true ) : get_post_meta( $this->master_id, 'fpd_products', true );

		}

		public function get_image_parameters() {

			$strip_from_option_key = 'fpd_designs_parameter_';

			$images_parameters = array();
			$image_options = FPD_Settings_Default_Element_Options::get_options();
			$image_options = $image_options['default-image-options'];
			foreach( $image_options as $option ) {


				if( isset($option['default']) && strpos($option['id'], $strip_from_option_key) !== false ) {

					$parameter = str_replace($strip_from_option_key, '', $option['id']);
					$pure_key = str_replace('fpd_', '', $option['id']);
					$images_parameters[$parameter] = $this->get_option($pure_key);

				}

			}

			$images_parameters['removable'] = 1;

			return $images_parameters;

		}

		public function get_image_parameters_string() {

			return FPD_Parameters::convert_parameters_to_string($this->get_image_parameters());

		}

		public function get_custom_text_parameters_string() {

			$strip_from_option_key = 'fpd_custom_texts_parameter_';

			$custom_texts_parameters = array();
			$custom_text_options = FPD_Settings_Default_Element_Options::get_options();

			$custom_text_options = $custom_text_options['default-custom-text-options'];
			foreach( $custom_text_options as $option ) {

				if( isset($option['default']) && strpos($option['id'], $strip_from_option_key) !== false ) {


					$parameter = str_replace($strip_from_option_key, '', $option['id']);
					$pure_key = str_replace('fpd_', '', $option['id']);
					$custom_texts_parameters[$parameter] = $this->get_option($pure_key);

				}

			}

			$custom_texts_parameters['removable'] = 1;

			return FPD_Parameters::convert_parameters_to_string($custom_texts_parameters, 'text');

		}

		public function get_custom_image_parameters_string() {

			$strip_from_option_key = 'fpd_uploaded_designs_parameter_';

			$custom_images_parameters = array();
			$custom_image_options = FPD_Settings_Default_Element_Options::get_options();
			$custom_image_options = $custom_image_options['default-custom-image-options'];
			foreach( $custom_image_options as $option ) {

				if( isset($option['default']) && strpos($option['id'], $strip_from_option_key) !== false ) {

					$parameter = str_replace($strip_from_option_key, '', $option['id']);
					$pure_key = str_replace('fpd_', '', $option['id']);
					$custom_images_parameters[$parameter] = $this->get_option($pure_key);

				}

			}

			return FPD_Parameters::convert_parameters_to_string($custom_images_parameters);

		}

		private function remove_empty_values($var){

			return ($var !== NULL && $var !== FALSE && $var !== '');

		}

	}

}

?>