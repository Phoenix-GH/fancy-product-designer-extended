<?php

if( !class_exists('FPD_Admin_Product') ) {

	class FPD_Admin_Product {

		public function __construct() {

			add_filter( 'product_type_options', array( &$this, 'add_product_type_option' ) );
			add_filter( 'woocommerce_product_data_tabs', array( &$this, 'add_product_data_tab' ) );
			add_action( 'woocommerce_product_data_panels', array( &$this, 'add_product_data_panel' ) );
			add_action( 'woocommerce_duplicate_product', array( &$this, 'duplicate_fancy_product' ), 10, 2 );
			add_action( 'admin_footer-post.php', array( &$this, 'add_modal' ) );
			add_action( 'admin_footer-post-new.php', array( &$this, 'add_modal' ) );

		}

		//add checkbox to enable fancy product for a product
		public function add_product_type_option( $types ) {

			$types['fancy_product'] = array(
				'id' => '_fancy_product',
				'wrapper_class' => 'show_if_fancy_product',
				'label' => __( 'Fancy Product Designer', 'radykal' ),
				'description' => __( 'Enable Fancy Product Designer for this product?', 'radykal' )
			);

			return $types;

		}

		//the tab in the data panel
		public function add_product_data_tab( $tabs ) {

			$tabs['fancy_product'] = array(
				'label'  => __( 'FPD Integration', 'radykal' ),
				'target' => 'fancy_product_data',
				'class'  => array( 'hide_if_fancy_product' ),
			);

			return $tabs;

		}

		//custom panel in the product post to add/edit/remove views
		public function add_product_data_panel() {

			global $wpdb, $post;

			$custom_fields = get_post_custom($post->ID);

			require_once(FPD_PLUGIN_ADMIN_DIR.'/views/html-admin-meta-box.php');

		}

		//duplicate fancy products, all views will be available in the duplicated product
		public function duplicate_fancy_product( $new_id, $post ) {

			if( is_fancy_product($post->ID) ) {

				$custom_fields = get_post_custom($post->ID);
				update_post_meta( $new_id, 'fpd_product_categories', unserialize($custom_fields['fpd_product_categories'][0]) );
				update_post_meta( $new_id, 'fpd_products', unserialize($custom_fields['fpd_products'][0]) );
				update_post_meta( $new_id, 'fpd_source_type', unserialize($custom_fields['fpd_source_type'][0]) );

			}

		}

		public function add_modal() {

			global $post;

			require_once(FPD_PLUGIN_ADMIN_DIR.'/modals/modal-individual-product-settings.php');

		}
	}
}

new FPD_Admin_Product();

?>