<?php

if(!class_exists('FPD_Admin_Menus')) {

	class FPD_Admin_Menus {

		public function __construct() {

			//add menu pages - Fancy Products, Fancy Designs
			add_action( 'admin_menu', array( &$this, 'add_menu_pages' ) );
			add_action( 'radykal_settings_header_end', array( &$this, 'settings_tables_start' ) );
			//add action links to plugins page
			add_filter( 'plugin_action_links_' . plugin_basename( FPD_PLUGIN_DIR ).'/fancy-product-designer.php', array( &$this, 'action_links' ) );

		}

		public function add_menu_pages() {

			//add top level menu
			add_menu_page(
				__('Fancy Product Designer', 'radykal'),
				__('Fancy Product Designer', 'radykal'),
				Fancy_Product_Designer::CAPABILITY,
				'fancy_product_designer',
				array( $this, 'manage_fancy_products' ),
				'dashicons-chart-pie'
			);

			//add manage fancy products menu
			add_submenu_page(
				'fancy_product_designer',
				 __('Manage Fancy Products', 'radykal'),
				 __('Fancy Products', 'radykal'),
				 Fancy_Product_Designer::CAPABILITY,
				 'fancy_product_designer',
				 array( $this, 'manage_fancy_products' )
			);

			//add fancy products sub menu page to products menu
			add_submenu_page(
				'fancy_product_designer',
				 __('Product Builder', 'radykal'),
				 __('Product Builder', 'radykal'),
				 Fancy_Product_Designer::CAPABILITY,
				 'fpd_product_builder',
				 array( $this, 'product_builder_page' )
			);

			//add fancy designs sub menu page to products menu
			add_submenu_page(
				'fancy_product_designer',
				__('Manage Fancy Designs', 'radykal'),
				__('Fancy Designs', 'radykal'),
				Fancy_Product_Designer::CAPABILITY,
				'fpd_manage_designs',
				array( $this, 'designs_page' )
			);

			//add orders sub menu page to products menu
			add_submenu_page(
				'fancy_product_designer',
				__('Orders', 'radykal'),
				__('Orders', 'radykal'),
				Fancy_Product_Designer::CAPABILITY,
				'fpd_orders',
				array( $this, 'orders_page' )
			);

			//add fancy designs sub menu page to products menu
			add_submenu_page(
				'fancy_product_designer',
				__('Settings', 'radykal'),
				__('Settings', 'radykal'),
				Fancy_Product_Designer::CAPABILITY,
				'fpd_settings',
				array( $this, 'settings_page' )
			);

		}

		public function action_links( $links ) {

			return array_merge( array(
				'<a href="' . esc_url( 'http://support.fancyproductdesigner.com/' ) . '" target="_blank">' . __( 'Documentation', 'radykal' ) . '</a>',
			), $links );

		}

		public function manage_fancy_products() {

			if( class_exists('FPD_Admin_Manage_Fancy_Products') ) {

				$page = new FPD_Admin_Manage_Fancy_Products();
				$page->output();

			}

		}

		public function product_builder_page() {

			$page = require( FPD_PLUGIN_ADMIN_DIR.'/class-admin-product-builder.php' );
			$page->output();

		}

		public function designs_page() {

			if( class_exists('FPD_Admin_Fancy_Designs') ) {

				$page = new FPD_Admin_Fancy_Designs();
				$page->output();

			}

		}

		public function orders_page() {

			if( !class_exists('FPD_Admin_Shortcode_Order') ) {
				require_once(FPD_PLUGIN_ADMIN_DIR . '/class-admin-shortcode-order.php' );
			}

			$page = new FPD_Admin_Shortcode_Order();
			$page->output();

		}

		public function settings_page() {

			if( class_exists('FPD_Settings') ) {

				?>
				<div class="wrap" id="fpd-settings">
					<?php FPD_Settings::$radykal_settings->output(); ?>
				</div>
				<?php

			}

		}

		public function settings_tables_start() {

			fpd_admin_display_version_info();

		}
	}
}

new FPD_Admin_Menus();

?>