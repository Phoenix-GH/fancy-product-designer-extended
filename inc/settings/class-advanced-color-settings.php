<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Settings_Advanced_Colors') ) {

	class FPD_Settings_Advanced_Colors {

		public static function get_options() {

			return apply_filters('fpd_advanced_color_settings', array(

				'hex-names' => array(

					array(
						'title' => __( 'Hexadecimal Color Names', 'radykal' ),
						'description' 		=> __( 'You can set custom names for your hexadecimal colors, that will be used in the tooltips, when using a predefined color palette.', 'radykal' ),
						'id' 		=> 'fpd_hex_names',
						'css' 		=> 'width:500px;',
						'default'	=> '',
						'type' 		=> 'values-group',
						'options'   => array(
							'hex_key' => 'Hexadecimal Color',
							'name' => 'Name'
						),
						'prefixes' => array(
							'hex_key' => '#',
							'name' => ''
						),
						'regexs' => array(
							'hex_key' => '^[0-9a-f]{6}$',
							'name' => '^[^, ]+$'
						)
					),

				), //hex-names

				'color-prices' => array(

					array(
						'title' 	=> __( 'Enable for Texts', 'radykal' ),
						'description' 		=> __( 'Use the color prices for all text elements.', 'radykal' ),
						'id' 		=> 'fpd_enable_text_color_prices',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' 	=> __( 'Enable for Images', 'radykal' ),
						'description' 		=> __( 'Use the color prices for all image elements.', 'radykal' ),
						'id' 		=> 'fpd_enable_image_color_prices',
						'default'	=> 'no',
						'type' 		=> 'checkbox'
					),

					array(
						'title' => __( 'Color Prices', 'radykal' ),
						'description' 		=> __( 'You can set different prices based on the selected color. This works only for color palette, so if you define a range of allowed colors for an element.', 'radykal' ),
						'id' 		=> 'fpd_color_prices',
						'css' 		=> 'width:500px;',
						'default'	=> '',
						'type' 		=> 'values-group',
						'options'   => array(
							'hex_key' => 'Hexadecimal Color',
							'price' => 'Price'
						),
						'prefixes' => array(
							'hex_key' => '#',
							'price' => ''
						),
						'regexs' => array(
							'hex_key' => '^[0-9a-f]{6}$',
							'price' => '^\d+(\.\d{1,2})?$'
						)
					),

				), //color-prices

			));
		}

		public static function get_hex_names_object_string() {

			$hex_names = '{}';
			if( fpd_not_empty(fpd_get_option( 'fpd_hex_names' )) ) {
				$hex_names = '{"'.str_replace('#', '', fpd_get_option( 'fpd_hex_names' ) ) ;
				$hex_names = str_replace(':', '":"', $hex_names);
				$hex_names = str_replace(',', '","', $hex_names);
				$hex_names .= '"}';
			}

			return $hex_names;

		}

		public static function get_color_prices() {

			$color_prices = '{}';
			if( fpd_not_empty(fpd_get_option( 'fpd_color_prices' )) ) {
				$color_prices = '{"'.str_replace('#', '', fpd_get_option( 'fpd_color_prices' ) ) ;
				$color_prices = str_replace(':', '":', $color_prices);
				$color_prices = str_replace(',', ',"', $color_prices);
				$color_prices .= '}';
			}

			return $color_prices;

		}

	}
}

?>