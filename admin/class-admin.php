<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Admin') ) {

	class FPD_Admin {

		public static $ajax_nonce;

		public function __construct() {

			require_once(FPD_PLUGIN_ADMIN_DIR.'/fpd-admin-functions.php');
			require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-template.php' );
			require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-manage-products.php' );
			require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-designs.php' );
			require_once(FPD_PLUGIN_ADMIN_DIR.'/class-admin-ajax.php');
			require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-scripts-styles.php' );
			require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-menus.php' );
			require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-order.php' );

			add_action( 'admin_init', array( &$this, 'init_admin' ) );
			add_action( 'add_meta_boxes', array( &$this, 'add_custom_box' ) );
			add_action( 'save_post', array( &$this,'update_custom_meta_fields' ) );
			add_action( 'admin_notices',  array( &$this, 'display_admin_notices' ) );
			add_filter( 'upload_mimes', array( &$this, 'allow_svg_upload') );

		}

		public function init_admin() {

			self::$ajax_nonce = wp_create_nonce( 'fpd_ajax_nonce' );

			//add capability to administrator
			$role = get_role( 'administrator' );
			$role->add_cap( Fancy_Product_designer::CAPABILITY );

			require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-product.php' );

			if ( get_option('fpd_plugin_activated', false) ) {

				delete_option('fpd_plugin_activated');
				wp_redirect( esc_url_raw( admin_url('admin.php?page=fancy_product_designer&info=activated') ));
				exit;

		    }

		    //delete sharing images
			if( intval(fpd_get_option('fpd_sharing_cache_days')) !== 0 && get_transient('fpd_check_shares_dir') === false ) {

				$cache_days_in_sec = intval(fpd_get_option('fpd_sharing_cache_days')) * DAY_IN_SECONDS;
			    $share_dir = WP_CONTENT_DIR . '/uploads/fpd_shares/';
			    $files_in_share_dir = glob($share_dir.'*');

			    if( is_array($files_in_share_dir) ) {

				     $dirs = array_filter($files_in_share_dir, 'is_dir');

				    foreach($dirs as $dir) {
					    $time = strtotime(basename($dir)); //folder date in seconds
					    $seconds = time() - $time; //past seconds
					    if($seconds > $cache_days_in_sec) {
						    $this->delete_files($dir);
					    }
				    }

			    }

			    set_transient('fpd_check_shares_dir', 'yes', DAY_IN_SECONDS);

			}

		}

		//add meta box in the post and page
		public function add_custom_box() {

			add_meta_box(
				'fpd-meta-box',
				__('Fancy Product Designer', 'radykal'),
				array( &$this, 'output_meta_box'),
				'post',
				'side'
			);

			add_meta_box(
				'fpd-meta-box',
				__('Fancy Product Designer', 'radykal'),
				array( &$this, 'output_meta_box'),
				'page',
				'side'
			);


			$custom_post_types = get_post_types( array(
				'public' => true,
				'_builtin' => false
			));

			foreach($custom_post_types as $custom_post_type) {

				if($custom_post_type !== 'product') {
					add_meta_box(
						'fpd-meta-box',
						__('Fancy Product Designer', 'radykal'),
						array( &$this, 'output_meta_box'),
						$custom_post_type,
						'side'
					);
				}

			}

		}

		public function output_meta_box() {

			global $wpdb, $post;

			$custom_fields = get_post_custom($post->ID);

			require_once(FPD_PLUGIN_ADMIN_DIR.'/views/html-admin-meta-box.php');

		}

		public function update_custom_meta_fields( $post_id )	{

			$post_type = get_post_type( $post_id );

			//disable autosave,so custom fields will not be empty
			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		        return $post_id;

			//prevents custom metas to get deleted when saving via quick edit
		    if ( $post_type === 'product' && isset($_POST['_inline_edit']) && wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
				return $post_id;

			if ($post_type === 'product' &&  isset($_POST['bulk_edit']))
				return $post_id;

			if(isset($_POST["fpd_product_settings"]))
				update_post_meta( $post_id, 'fpd_product_settings', htmlentities($_POST['fpd_product_settings']) );

			if(isset($_POST["fpd_source_type"]))
				update_post_meta( $post_id, 'fpd_source_type', $_POST['fpd_source_type'] );

			update_post_meta( $post_id, '_fancy_product', isset( $_POST['_fancy_product'] ) ? 'yes' : 'no' );
			update_post_meta( $post_id, 'fpd_products', isset($_POST["fpd_products"]) ? $_POST['fpd_products'] : '' );
			update_post_meta( $post_id, 'fpd_product_categories', isset($_POST["fpd_product_categories"]) ? $_POST['fpd_product_categories'] : '' );

		}

		public function display_admin_notices() {

			global $woocommerce;

			if( function_exists('get_woocommerce_currency') && version_compare($woocommerce->version, '2.1', '<') ): ?>
			<div class="error">
		        <p><?php _e( 'Please update WooCommerce to the latest version! Fancy Product Designer only works with version 2.1 or newer.', 'radykal' ); ?></p>
		    </div>
			<?php endif;

			if( !extension_loaded('gd') || !function_exists('gd_info') ): ?>
			<div class="error">
		        <p><?php _e( 'GD library is not installed on your web server. If you do not know how to install GD library, please ask your server provider!', 'radykal' ); ?></p>
		    </div>
			<?php endif;

		}

		public function allow_svg_upload( $svg_mime ) {

			$svg_mime['svg'] = 'image/svg+xml';
			return $svg_mime;

		}

		private function delete_files($target) {

		    if(is_dir($target)){
		        $files = glob( $target . '*', GLOB_MARK );

		        foreach( $files as $file )
		        {
		            $this->delete_files( $file );
		        }

				if( file_exists($target) )
		        	rmdir( $target );
		    } elseif(is_file($target)) {
		        unlink( $target );
		    }

		}
	}
}

new FPD_Admin();

?>