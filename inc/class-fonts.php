<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Fonts') ) {

	class FPD_Fonts {

		//returns an array with all active fonts
		public static function get_enabled_fonts() {

			$all_fonts = array();

			$common_fonts = get_option( 'fpd_common_fonts' );
			if( !empty($common_fonts) ) {
				$all_fonts = explode(",", $common_fonts);
			}

			//google webfonts
			$google_webfonts = get_option( 'fpd_google_webfonts' );

			if( !empty($google_webfonts) && is_array($google_webfonts) ) {
				foreach($google_webfonts as $google_webfont) {
					$google_webfont = strpos($google_webfont, ':') === false ? $google_webfont : substr($google_webfont, 0, strpos($google_webfont, ':'));
					$google_webfont = str_replace('+', ' ', $google_webfont);

					if(!in_array($google_webfont, $all_fonts))
						$all_fonts[] = $google_webfont;
				}
			}

			//directory fonts
			$directory_fonts = get_option( 'fpd_fonts_directory' );
			if( !empty($directory_fonts) && is_array($directory_fonts) ) {
				foreach($directory_fonts as $directory_font) {
					$all_fonts[] = str_replace('_', ' ', preg_replace("/\\.[^.\\s]{3,4}$/", "", $directory_font) );
				}
			}

			asort($all_fonts);

			return $all_fonts;

		}

		public static function output_webfont_links() {

			$google_webfonts = get_option( 'fpd_google_webfonts' );
			$max_fonts_per_href = 10;
			$href_wf = array();
			if( !empty($google_webfonts) ) {

				for($i=0; $i < sizeof($google_webfonts); $i++) {

					array_push($href_wf, $google_webfonts[$i]);

					if( ($i % $max_fonts_per_href) == $max_fonts_per_href-1 || $i == sizeof($google_webfonts)-1 ) {
						echo '<link href="//fonts.googleapis.com/css?family='.implode ("|", $href_wf).'" rel="stylesheet" type="text/css">';
						$href_wf = array();
					}
				}

			}

		}

	}

}

?>