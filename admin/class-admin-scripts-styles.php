<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Admin_Scripts_Styles') ) {

	class FPD_Admin_Scripts_Styles {

		public function __construct() {

			add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_styles_scripts' ), 20 );

		}

		public function enqueue_styles_scripts( $hook ) {

			if( function_exists('get_woocommerce_currency') && version_compare(WC_VERSION, '2.3.0', '<') ) {
				wp_register_style( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css', false, '3.5.2' );
				wp_register_script( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js', array( 'jquery' ), '3.5.2' );
			}

			wp_register_style( 'fpd-admin-icon-font', plugins_url('/css/icon-font.css', __FILE__), false, Fancy_Product_Designer::VERSION );
			wp_register_style( 'fpd-admin', plugins_url('/css/admin.css', __FILE__), array(
				'radykal-tooltipster'
			), Fancy_Product_Designer::VERSION );

			wp_register_script( 'fpd-admin', plugins_url('/js/admin.js', __FILE__), array(
				'jquery',
				'radykal-tooltipster'
			), Fancy_Product_Designer::VERSION );

			 wp_localize_script( 'fpd-admin', 'fpd_admin_opts', array(
					'adminAjaxUrl' => admin_url('admin-ajax.php'),
					'ajaxNonce' => FPD_Admin::$ajax_nonce,
					'enterTitlePrompt' => __('Please enter a title', 'radykal'),
					'tryAgain' => __('Something went wrong. Please try again!', 'radykal'),
					'addToLibrary' => __('Add imported image source to media library?', 'radykal'),
					'remove' => __('Are you sure you want to delete it?.', 'radykal'),
				)
			);

			global $post;

			//woocommerce post types
		    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

		        if( 'shop_order' === $post->post_type ) {

		        	FPD_Fonts::output_webfont_links();

					wp_enqueue_style( 'jquery-fpd' );
					wp_enqueue_style( 'fpd-admin-icon-font' );
					wp_enqueue_style( 'fpd-admin' );

					wp_enqueue_script( 'jquery-fpd' );
					wp_enqueue_script( 'fpd-admin' );

		        }
		        else {

			        wp_enqueue_style( 'wp-color-picker' );
		        	wp_enqueue_style( 'radykal-admin' );
					wp_enqueue_style( 'fpd-admin' );

					wp_enqueue_script( 'wp-color-picker' );
					wp_enqueue_script( 'radykal-admin' );
					wp_enqueue_script( 'fpd-admin' );

					if('product' === $post->post_type) {

						wp_enqueue_style( 'select2' );
						wp_enqueue_script( 'select2' );
					}
					else {

						wp_enqueue_style( 'radykal-select2' );
						wp_enqueue_script( 'radykal-select2' );

					}

		        }
		    }

			//manage fancy products
		    if( $hook == 'toplevel_page_fancy_product_designer' ) {

			    wp_enqueue_media();
			    wp_enqueue_style( 'fpd-admin-icon-font' );
			    wp_enqueue_style( 'radykal-admin' );
			    wp_enqueue_style( 'fpd-admin' );

				wp_enqueue_script( 'fpd-admin' );
			    wp_enqueue_script( 'fpd-manage-fancy-products', plugins_url('/js/manage-fancy-products.js', __FILE__), array(
			    	'jquery-ui-core',
					'jquery-ui-mouse',
					'jquery-ui-sortable'
				), Fancy_Product_Designer::VERSION);

			    wp_localize_script( 'fpd-manage-fancy-products', 'fpd_fancy_products_opts', array(
						'adminAjaxUrl' => admin_url('admin-ajax.php'),
						'ajaxNonce' => FPD_Admin::$ajax_nonce,
						'enterTitlePrompt' => __('Please enter a title', 'radykal'),
						'remove' => __('Are you sure you want to delete it?.', 'radykal'),
						'tryAgain' => __('Something went wrong. Please try again!', 'radykal'),
						'selectProduct' => __('Please select a Fancy Product first to assign the category!', 'radykal'),
						'nothingToExport' => __('This product does not contain any views!', 'radykal'),
						'addToLibrary' => __('Add imported image source to media library?', 'radykal'),
						'noJSON' => __('Sorry, but the selected file is not a valid JSON object. Are you sure you have selected the correct file to import?', 'radykal'),
						'chooseThumbnail' => __('Choose a thumbnail', 'radykal'),
					)
				);

			}

			//product builder
		    if( $hook == 'fancy-product-designer_page_fpd_product_builder' ) {

		    	wp_enqueue_media();

				wp_enqueue_style( 'radykal-select2' );
				wp_enqueue_style( 'radykal-tagsmanager' );
				 wp_enqueue_style( 'fpd-admin-icon-font' );
				wp_enqueue_style( 'radykal-admin' );
				wp_enqueue_style( 'fpd-admin' );
		    	wp_enqueue_style( 'fpd-fonts' );

		    	FPD_Fonts::output_webfont_links();

				wp_register_script( 'fpd-product-builder', plugins_url('/js/product-builder.js', __FILE__), array(
					'jquery-ui-core',
					'jquery-ui-mouse',
					'jquery-ui-sortable',
					'jquery-ui-spinner',
					'jquery-ui-widget',
					'radykal-tagsmanager',
					'radykal-select2',
					'radykal-admin',
					'fpd-admin'
				), Fancy_Product_Designer::VERSION );

				wp_localize_script( 'fpd-product-builder', 'fpd_product_builder_opts', array(
						'adminUrl' => admin_url(),
						'originX' => fpd_get_option('fpd_common_parameter_originx'),
						'originY' => fpd_get_option('fpd_common_parameter_originy'),
						'paddingControl' => fpd_get_option('fpd_padding_controls'),
						'defaultFont' => get_option('fpd_default_font') ? get_option('fpd_default_font') : 'Arial',
						'enterTitlePrompt' => __('Enter a title for the element', 'radykal'),
						'chooseElementImageTitle' => __( 'Choose an element image', 'radykal' ),
						'set' => __( 'Set', 'radykal' ),
						'enterYourText' => __( 'Enter your text.', 'radykal' ),
						'removeElement' => __('Remove element?', 'radykal'),
						'notChanged' => __('You have not saved your changes!', 'radykal'),
						'changeImageSource' => __('Change Image Source', 'radykal'),
					)
				);

				wp_enqueue_script( 'fpd-curved-text', plugins_url('/js/fabric.curvedText.js', __FILE__), array('fabric') );
				wp_enqueue_script( 'fpd-webfont', plugins_url('/js/webfont.js', __FILE__) );
				wp_enqueue_script( 'fpd-product-builder' );


		    }

			//manage designs
		    if( $hook == 'fancy-product-designer_page_fpd_manage_designs') {

		    	wp_enqueue_media();

		    	wp_enqueue_style( 'radykal-select2' );
		    	wp_enqueue_style( 'fpd-admin-icon-font' );
				wp_enqueue_style( 'radykal-admin' );
		    	wp_enqueue_style( 'fpd-admin' );

		    	wp_enqueue_script( 'radykal-select2' );
				wp_enqueue_script( 'radykal-admin' );
		    	wp_enqueue_script( 'fpd-admin' );
		    	wp_enqueue_script( 'fpd-manage-fancy-designs', plugins_url('/js/manage-fancy-designs.js', __FILE__), Fancy_Product_Designer::VERSION );
		    	wp_localize_script( 'fpd-manage-fancy-designs', 'fpd_fancy_designs_opts', array(
						'chooseDesign' => __('Choose a Design Image', 'radykal'),
					)
				);

		    }

		    //shortcode orders
		    if( $hook == 'fancy-product-designer_page_fpd_orders' ) {

		        	FPD_Fonts::output_webfont_links();

					wp_enqueue_style( 'jquery-fpd' );
					wp_enqueue_style( 'fpd-admin-icon-font' );
					wp_enqueue_style( 'fpd-admin' );

					wp_enqueue_script( 'jquery-fpd' );
					wp_enqueue_script( 'fpd-admin' );

		        }

			//settings
			if( $hook == 'fancy-product-designer_page_fpd_settings') {

				wp_enqueue_style( 'radykal-select2' );
				wp_enqueue_style( 'radykal-admin' );
				wp_enqueue_style( 'fpd-admin' );
				wp_enqueue_style( 'wp-color-picker' );

				wp_enqueue_script( 'radykal-ace-editor' );
				wp_enqueue_script( 'radykal-select2' );
				wp_enqueue_script( 'radykal-admin' );
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'fpd-admin' );

			}

		}
	}
}

new FPD_Admin_Scripts_Styles();

?>