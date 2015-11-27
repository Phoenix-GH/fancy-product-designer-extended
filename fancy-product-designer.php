<?php
/*
Plugin Name: Fancy Product Designer
Plugin URI: http://fancyproductdesigner.com/
Description: HTML5 Product Designer for Wordpress and WooCommerce. Create and sell customizable products.
Version: 2.2.4
Author: Rafael Dery | radykal.de
Author URI: http://fancyproductdesigner.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $wpdb;

if (!defined('FPD_PLUGIN_DIR'))
    define( 'FPD_PLUGIN_DIR', dirname(__FILE__) );

if (!defined('FPD_PLUGIN_ROOT_PHP'))
    define( 'FPD_PLUGIN_ROOT_PHP', dirname(__FILE__).'/'.basename(__FILE__)  );

if (!defined('FPD_PLUGIN_ADMIN_DIR'))
    define( 'FPD_PLUGIN_ADMIN_DIR', dirname(__FILE__) . '/admin' );

if (!defined('FPD_ORDER_DIR'))
    define( 'FPD_ORDER_DIR', WP_CONTENT_DIR . '/fancy_products_orders/' );

if (!defined('FPD_CATEGORIES_TABLE'))
    define( 'FPD_CATEGORIES_TABLE', $wpdb->prefix . 'fpd_categories' );

if (!defined('FPD_PRODUCTS_TABLE'))
    define( 'FPD_PRODUCTS_TABLE', $wpdb->prefix . 'fpd_products' );

if (!defined('FPD_CATEGORY_PRODUCTS_REL_TABLE'))
    define( 'FPD_CATEGORY_PRODUCTS_REL_TABLE', $wpdb->prefix . 'fpd_category_products_rel' );

if (!defined('FPD_VIEWS_TABLE'))
    define( 'FPD_VIEWS_TABLE', $wpdb->prefix . 'fpd_views' );

if (!defined('FPD_TEMPLATES_TABLE'))
    define( 'FPD_TEMPLATES_TABLE', $wpdb->prefix . 'fpd_templates' );

if (!defined('FPD_ORDERS_TABLE'))
    define( 'FPD_ORDERS_TABLE', $wpdb->prefix . 'fpd_orders' );


if( !class_exists('Fancy_Product_Designer') ) {

	class Fancy_Product_Designer {

		const VERSION = '2.2.4';
		const FPD_VERSION = '3.0.8';
		const CAPABILITY = "edit_fancy_product_desiger";
		const DEMO = false;

		public function __construct() {

			require_once(FPD_PLUGIN_DIR.'/framework/radykal-framework.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/fpd-functions.php');
			require_once(FPD_PLUGIN_ADMIN_DIR.'/class-admin.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-product-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-fancy-category.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-fancy-product.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-fancy-view.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-fonts.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-install.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-scripts-styles.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-cart.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-order.php');
			require_once(FPD_PLUGIN_DIR.'/inc/class-shortcode-order.php');

			add_action( 'plugins_loaded', array( &$this,'plugins_loaded' ) );
			add_action( 'init', array( &$this, 'init') );

		}

		public function plugins_loaded() {

			load_plugin_textdomain( 'radykal', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );

			if( !is_admin() ) {
				require_once(FPD_PLUGIN_DIR.'/inc/class-debug.php');
			}

		}

		public function init() {

			require_once(FPD_PLUGIN_DIR.'/inc/class-frontend-product.php');

			$tax_design_cat_labels = array(
			  'name' => _x( 'Fancy Design Categories', 'taxonomy general name', 'radykal' ),
			  'singular_name' => _x( 'Fancy Design Category', 'taxonomy singular name', 'radykal' ),
			  'search_items' =>  __( 'Search Design Categories', 'radykal' ),
			  'all_items' => __( 'All Design Categories', 'radykal' ),
			  'parent_item' => __( 'Parent Design Category', 'radykal' ),
			  'parent_item_colon' => __( 'Parent Design Category:', 'radykal' ),
			  'edit_item' => __( 'Edit Design Category', 'radykal' ),
			  'update_item' => __( 'Update Design Category', 'radykal' ),
			  'add_new_item' => __( 'Add New Design Category', 'radykal' ),
			  'new_item_name' => __( 'New Design Category Name', 'radykal' ),
			  'menu_name' => __( 'Fancy Design Categories', 'radykal' ),
			);

			register_taxonomy( 'fpd_design_category', 'attachment', array(
				'public' => true,
				'labels' => $tax_design_cat_labels,
				'hierarchical' => false,
				'sort' => true,
				'show_tagcloud' => false,
				'capabilities' => array(self::CAPABILITY)
			));

		}

	}
}

new Fancy_Product_Designer();

?>