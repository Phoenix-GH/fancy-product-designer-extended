<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('FPD_Scripts_Styles')) {

	class FPD_Scripts_Styles {

		public static $add_script = false;

		public function __construct() {

			add_action( 'init', array( &$this, 'register') );
			add_action( 'wp_enqueue_scripts',array( &$this,'enqueue_styles' ) );
			add_action( 'wp_footer', array(&$this, 'footer_handler') );

		}

		public function register() {

			$local_test = false;
			$fpd_css_url = $local_test ? 'http://radykal.dev/fpd3/css/jquery.fancyProductDesigner.css' : plugins_url('/css/jquery.fancyProductDesigner.min.css', FPD_PLUGIN_ROOT_PHP);
			$fpd_js_url = $local_test ? 'http://radykal.dev/fpd3/js/jquery.fancyProductDesigner.js' : plugins_url('/js/jquery.fancyProductDesigner.min.js', FPD_PLUGIN_ROOT_PHP);
			$fpd_js_url = get_option('fpd_debug_mode') == 'yes' ?  plugins_url('/js/jquery.fancyProductDesigner.js', FPD_PLUGIN_ROOT_PHP) : $fpd_js_url;

			//register css files
			wp_register_style( 'fpd-icon-font', plugins_url('/css/icon-font.css', FPD_PLUGIN_ROOT_PHP), false, Fancy_Product_Designer::FPD_VERSION );

			$fonts_dir = WP_CONTENT_DIR.'/uploads/fpd_fonts';
			$fonts_css = $fonts_dir.'/jquery.fancyProductDesigner-fonts.css';
			if( !file_exists($fonts_css) ) {
				if( !file_exists($fonts_dir) )
					wp_mkdir_p($fonts_dir);

				$handle = @fopen($fonts_css, 'w') or print('Cannot open file:  '.$fonts_css);
				fclose($handle);
			}

			wp_register_style( 'fpd-fonts', content_url('/uploads/fpd_fonts/jquery.fancyProductDesigner-fonts.css', FPD_PLUGIN_ROOT_PHP), false, Fancy_Product_Designer::FPD_VERSION );
			wp_register_style( 'fpd-plugins', plugins_url('/css/plugins.min.css', FPD_PLUGIN_ROOT_PHP), false, Fancy_Product_Designer::FPD_VERSION );
			wp_register_style( 'fpd-jquery-ui', plugins_url('/css/jquery-ui.css', FPD_PLUGIN_ROOT_PHP), false, Fancy_Product_Designer::FPD_VERSION );
			wp_register_style( 'jquery-fpd', $fpd_css_url, array(
				'fpd-fonts',
				'fpd-jquery-ui'
			), Fancy_Product_Designer::FPD_VERSION );

			wp_enqueue_style( 'font-awesome-4', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, '4.3.0' );
			wp_register_style( 'fpd-jssocials-theme', plugins_url('/assets/jssocials/jssocials-theme-flat.css', FPD_PLUGIN_ROOT_PHP), false, '0.2.0' );
			wp_register_style( 'fpd-jssocials', plugins_url('/assets/jssocials/jssocials.css', FPD_PLUGIN_ROOT_PHP), array('font-awesome-4', 'fpd-jssocials-theme'), '0.2.0' );

			wp_register_script( 'fpd-jssocials', plugins_url('/assets/jssocials/jssocials.min.js', FPD_PLUGIN_ROOT_PHP), false, '0.2.0' );

			//register js files
			wp_register_script( 'fpd-plugins', plugins_url('/js/plugins.js', FPD_PLUGIN_ROOT_PHP), false, Fancy_Product_Designer::FPD_VERSION );

			wp_register_script( 'fabric', plugins_url('/js/fabric.js', FPD_PLUGIN_ROOT_PHP), false, Fancy_Product_Designer::FPD_VERSION );
			wp_register_script( 'fpd-jquery-form', plugins_url('/js/jquery.form.min.js', FPD_PLUGIN_ROOT_PHP) );

			$fpd_dep = array(
				'jquery',
				'jquery-ui-draggable',
				'jquery-ui-resizable',
				'jquery-ui-sortable',
				'jquery-ui-slider',
				'fabric',
			);

			if( get_option('fpd_debug_mode') == 'yes' || $local_test )
				array_push($fpd_dep, 'fpd-plugins');

			wp_register_script( 'jquery-fpd', $fpd_js_url, $fpd_dep, Fancy_Product_Designer::FPD_VERSION );

		}

		//includes scripts and styles in the frontend
		public function enqueue_styles() {

			global $post;

			if( fpd_get_option('fpd_sharing') )
				wp_enqueue_style( 'fpd-jssocials' );

			wp_enqueue_style( 'jquery-fpd' );
			wp_enqueue_style( 'fpd-single-product', plugins_url('/css/fancy-product.css', FPD_PLUGIN_ROOT_PHP), false, Fancy_Product_Designer::VERSION );

			//only enqueue css and js files when necessary
			$product_settings = new FPD_Product_Settings( $post->ID );
			if( is_fancy_product($post->ID) ) {

					?>
					<style type="text/css">

						/* Styling */

						.fancy-product .fpd-primary-bg-color {
							background-color: <?php echo fpd_get_option('fpd_designer_primary_color'); ?>;
						}

						.fancy-product .fpd-primary-text-color,
						.fancy-product .fpd-primary-text-color:hover {
							color:  <?php echo fpd_get_option('fpd_designer_primary_text_color'); ?>;
						}

						.fancy-product .fpd-secondary-bg-color {
							background-color: <?php echo fpd_get_option('fpd_designer_secondary_color'); ?> !important;
						}

						.fancy-product .fpd-secondary-text-color,
						.fancy-product .fpd-secondary-text-color:hover {
							color:  <?php echo fpd_get_option('fpd_designer_secondary_text_color'); ?> !important;
						}

						.fancy-product .fpd-tabs > .fpd-btn.fpd-checked {
							border-color: <?php echo fpd_get_option('fpd_designer_secondary_color'); ?>;
						}

						.fancy-product .fpd-checked i {
							color: <?php echo fpd_get_option('fpd_designer_secondary_color'); ?> !important;
						}

						<?php if( $product_settings->get_option('background_type') ): ?>
						.fpd-product-stage {
							background: <?php echo $product_settings->get_option('background_type') == 'color' ? $product_settings->get_option('background_color') : 'url('.$product_settings->get_option('background_image').')'; ?> !important;
						}
						<?php endif; ?>


						<?php echo stripslashes( get_option( 'fpd_custom_css' ) ); ?>

					</style>
					<?php

				FPD_Fonts::output_webfont_links();

			}

		}

		public function footer_handler() {

			if( self::$add_script ) {

				if( fpd_get_option('fpd_type_of_uploader') == 'php' )
					wp_enqueue_script( 'fpd-jquery-form' );

				wp_enqueue_script( 'jquery-fpd' );
				if( fpd_get_option('fpd_sharing') )
					wp_enqueue_script( 'fpd-jssocials' );

			}

		}

	}

}

new FPD_Scripts_Styles();

?>