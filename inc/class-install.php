<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('FPD_Install')) {

	class FPD_Install {

		const VERSION_NAME = 'fancyproductdesigner_version';

		public function __construct() {

			register_activation_hook( FPD_PLUGIN_ROOT_PHP, array( &$this, 'activate_plugin' ) );
            //Uncomment this line to delete all database tables when deactivating the plugin
            //register_deactivation_hook( FPD_PLUGIN_ROOT_PHP, array( &$this,'deactive_plugin' ) );
            add_action( 'init', array( &$this,'check_version' ), 20 );
            add_action( 'wpmu_new_blog', array( &$this, 'new_blog'), 10, 6);

		}

		public function check_version() {

			if( is_admin() && get_option(self::VERSION_NAME) != Fancy_Product_Designer::VERSION) {

				$this->upgrade();

			}
		}

		//install when a new network site is added
		public function new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

			if ( ! function_exists( 'is_plugin_active_for_network' ) )
				require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

		    global $wpdb;

		    if ( is_plugin_active_for_network('fancy-product-designer/fancy-product-designer.php') ) {
		        $old_blog = $wpdb->blogid;
		        switch_to_blog($blog_id);
		        $this->activate_plugin();
		        switch_to_blog($old_blog);
		    }

		}

		public function activate_plugin( $networkwide ) {

		   if(version_compare(PHP_VERSION, '5.2.0', '<')) {
			  deactivate_plugins(FPD_PLUGIN_ROOT_PHP); // Deactivate plugin
			  wp_die("Sorry, but you can't run this plugin, it requires PHP 5.2 or higher.");
			  return;
			}

			global $wpdb;

			if ( is_multisite() ) {
	    		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
	                $current_blog = $wpdb->blogid;
	    			// Get all blog ids
	    			$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
	    			foreach ($blogids as $blog_id) {
	    				switch_to_blog($blog_id);
	    				$this->install();
	    			}
	    			switch_to_blog($current_blog);
	    			return;
	    		}
	    	}

			$this->install();

		}

		public function deactive_plugin($networkwide) {

			global $wpdb;

		    if (is_multisite()) {
		        if ($networkwide) {
		            $old_blog = $wpdb->blogid;
		            // Get all blog ids
		            $blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
		            foreach ($blogids as $blog_id) {
		                switch_to_blog($blog_id);
		                $this->deinstall();
		            }
		            switch_to_blog($old_blog);
		            return;
		        }
		    }

		    $this->deinstall();

		}

		//all things that need to be installed on activation
		private function install() {

			//if version name option does not exist, its a new installation
			if( get_option(self::VERSION_NAME) === false ) {

				update_option(self::VERSION_NAME, Fancy_Product_Designer::VERSION);
				update_option('fpd_plugin_activated', true);
				update_option('fpd_hide_run_updater', 'yes');

			}

		}

		private function deinstall() {

			global $wpdb;

			$wpdb->query( $wpdb->prepare("DELETE FROM %s WHERE option_name LIKE 'fpd_%'", $wpdb->options ));

			$wpdb->query("SET FOREIGN_KEY_CHECKS=0;");
			if( fpd_table_exists(FPD_CATEGORIES_TABLE) )
				$wpdb->query( "DROP TABLE ".FPD_CATEGORIES_TABLE."");
			if( fpd_table_exists(FPD_PRODUCTS_TABLE) )
				$wpdb->query( "DROP TABLE ".FPD_PRODUCTS_TABLE."");
			if( fpd_table_exists(FPD_CATEGORY_PRODUCTS_REL_TABLE) )
				$wpdb->query( "DROP TABLE ".FPD_CATEGORY_PRODUCTS_REL_TABLE."");
			if( fpd_table_exists(FPD_VIEWS_TABLE) )
				$wpdb->query( "DROP TABLE ".FPD_VIEWS_TABLE."");
			if( fpd_table_exists(FPD_TEMPLATES_TABLE) )
				$wpdb->query( "DROP TABLE ".FPD_TEMPLATES_TABLE."");
			$wpdb->query("SET FOREIGN_KEY_CHECKS=1;");

		}

		public function upgrade() {

			$current_version = get_option(self::VERSION_NAME);

			//upgrade to V1.1.3
			if( version_compare($current_version, '1.1.3', '<') ) {
				self::do_upgrade('1.1.3');
			}

			//upgrade to V2.0.0
			if( version_compare($current_version, '2.0.0', '<') ) {
				update_option('fpd_hide_run_updater', 'no');
			}

			update_option(self::VERSION_NAME, Fancy_Product_Designer::VERSION);

			wp_redirect( esc_url_raw( admin_url('admin.php?page=fancy_product_designer&info=updated') ));
		    exit;

		}

		public static function do_upgrade( $to_version ) {

			global $wpdb;

			if( $to_version === '1.1.3' ) {

				$wpdb->query("ALTER TABLE ".FPD_VIEWS_TABLE." ADD view_order INT COLLATE utf8_general_ci NULL DEFAULT 0;");

			}
			else if( $to_version === '2.0.0' ) {

				$views = $wpdb->get_results("SELECT * FROM ".FPD_VIEWS_TABLE." GROUP BY product_id");

				foreach($views as $view) {

					//check if product exists, otherwise delete it from views table
					if( get_post_status($view->product_id) === false ) {

						$wpdb->query( $wpdb->prepare("DELETE FROM ".FPD_VIEWS_TABLE." WHERE product_id=%d", $view->product_id) );

					}
					else {

						$check_title = get_the_title($view->product_id);
						if( !empty($check_title) ) {

							$product_id = Fancy_Product::create( $check_title ); //create product
							$fancy_product_settings = new FPD_Product_Settings($view->product_id);

							//get stage dimensions and add them in the product options
							$product_options = array();
							if( $fancy_product_settings->get_individual_option('stage_width') ) {
								$product_options['stage_width'] = $fancy_product_settings->get_individual_option('stage_width');
							}
							if( $fancy_product_settings->get_individual_option('stage_height') ) {
								$product_options['stage_height'] = $fancy_product_settings->get_individual_option('stage_height');
							}

							$fancy_product = new Fancy_Product($product_id);
							if( sizeof($product_options) !== 0 ) {
								$fancy_product->update( null, json_encode($product_options) );
							}

							//assign product to wc product
							update_post_meta( $view->product_id, 'fpd_source_type', 'product' );
							$product_array = array( $product_id );
							update_post_meta( $view->product_id, 'fpd_products',  $product_array );

							//update product id of views
							$wpdb->update(
							 	FPD_VIEWS_TABLE,
							 	array( 'product_id' => $product_id ), //what
							 	array('product_id' => $view->product_id), //where
							 	array('%d'), //format what
							 	array('%d') //format where
							);

						}

					}

				}

				//add options to views table
				$wpdb->query("ALTER TABLE ".FPD_VIEWS_TABLE." ADD options TEXT COLLATE utf8_general_ci NULL DEFAULT '';");

			}

		}
	}
}

new FPD_Install();

?>