<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('FPD_Order')) {

	class FPD_Order {

		public function __construct() {

			add_action( 'woocommerce_add_order_item_meta', array( &$this, 'add_order_item_meta'), 10, 2 );
			//add download info for downloadable product
			add_action( 'woocommerce_order_item_meta_end', array(&$this, 'add_download_info') , 10, 3 );

			//edit order item link, so it loads the customized product
			add_filter( 'woocommerce_order_item_name', array(&$this, 'add_edit_link_to_order_item') , 10, 2 );

		}

		//add order meta from the cart
		public function add_order_item_meta( $item_id, $values ) {

			if( isset( $values['fpd_data']) ) {
				woocommerce_add_order_item_meta( $item_id, 'fpd_data', $values['fpd_data'] );
			}

		}

		//change url of the order link so the ordered product comes up in designer
		public function add_edit_link_to_order_item( $link, $item ) {

			if( isset($item['fpd_data']) ) {

				$view_order_endpoint = get_option( 'woocommerce_myaccount_view_order_endpoint' );
				$order_received_endpoint = get_option( 'woocommerce_checkout_order_received_endpoint' );

				//check if on view order page, +2.1
				if(isset($_GET[$view_order_endpoint])) {
					$order_id = $_GET[$view_order_endpoint];

				}
				//checkout page, +2.1
				else if(isset($_GET[$order_received_endpoint])) {
					$order_id = $_GET[$order_received_endpoint];
				}
				//endpoints are used
				else {
					$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
					$template_name = strpos($url,'/order-received/') === false ? '/'.$view_order_endpoint.'/' : '/'.$order_received_endpoint.'/';

					if (strpos($url,$template_name) !== false) {
						$start = strpos($url,$template_name);
						$first_part = substr($url, $start+strlen($template_name));
						$order_id = substr($first_part, 0, strpos($first_part, '/'));
					}
				}


				if( isset($order_id) ) {
					$order = new WC_Order($order_id);
					foreach($order->get_items() as $key => $value) {
						if($value === $item) {
							$link = '<a href="' . add_query_arg( array('order' => $order_id, 'item_id' => $key), get_permalink( $item['product_id'] ) ) .'">' . $item['name'] . '</a>';
						}
					}
				}

			}

			return $link;

		}

		//change url of the order link so the ordered product comes up in designer
		public function add_download_info( $item_id, $item, $order ) {

			$product = $order->get_product_from_item( $item );

			if( is_fancy_product($product->id) &&  $product->is_downloadable() && $order->is_download_permitted() ) {

				$url = add_query_arg( array('order' => $order->id, 'item_id' => $item_id), get_permalink( $item['product_id'] ) );

				echo '<a href="'.esc_url ($url ).'" class="fpd-order-item-download" style="font-size: 0.85em;">'.fpd_get_option('fpd_label_download_on_product_page').'</a>' ;
			}


		}

	}
}

new FPD_Order();

?>