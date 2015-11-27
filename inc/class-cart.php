<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('FPD_Cart')) {

	class FPD_Cart {

		public function __construct() {

			//handler when a product is added to the cart
			add_action( 'woocommerce_add_to_cart', array( &$this, 'add_product_to_cart'), 10, 6 );

			//CART
			add_filter( 'woocommerce_add_cart_item', array(&$this, 'add_cart_item'), 10 );
			//add additional [fpd_data]([fpd_product],[fpd_price]) to cart item
			add_filter( 'woocommerce_add_cart_item_data', array(&$this, 'add_cart_item_data'), 10, 2 );
			//get cart item from session
			add_filter( 'woocommerce_get_cart_item_from_session', array(&$this, 'get_cart_item_from_session'), 10, 2 );
			//reset cart item link so the customized product is loaded from the cart
			add_filter( 'woocommerce_cart_item_name', array(&$this, 'reset_cart_item_link'), 10, 3 );
			//change cart item thumbnail
			add_filter( 'woocommerce_cart_item_thumbnail', array(&$this, 'change_cart_item_thumbnail'), 10, 2 );

		}

		public function add_product_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {

			if( is_fancy_product($product_id) ) {

				if( isset($cart_item_data['fpd_data']) ) {

					//check if an old cart item exist
					if( !empty($cart_item_data['fpd_data']['fpd_remove_cart_item']) ) {

						global $woocommerce;
						$woocommerce->cart->set_quantity($cart_item_data['fpd_data']['fpd_remove_cart_item'], 0);

					}
				}
			}

		}

		//hook into the cart
		public function add_cart_item( $cart_item ) {

			global $woocommerce;

			//check if data contains a product
	        if ( isset($cart_item['fpd_data']) && $cart_item['fpd_data'] ) {
		        $fpd_data = $cart_item['fpd_data'];
	            if (isset($fpd_data['fpd_product_price'])) {
					$cart_item['data']->adjust_price($fpd_data['fpd_product_price']);
	            }

	        }

		    return $cart_item;

		}

		//store values from additional form fields
		public function add_cart_item_data( $cart_item_meta, $product_id ) {

			if( is_fancy_product($product_id) && isset($_POST['fpd_product']) ) {

				$cart_item_meta['fpd_data'] = array();
				$cart_item_meta['fpd_data']['fpd_product'] = $_POST['fpd_product'];
				$cart_item_meta['fpd_data']['fpd_product_price'] = $_POST['fpd_product_price'];
				$cart_item_meta['fpd_data']['fpd_product_thumbnail'] = $_POST['fpd_product_thumbnail'];
				$cart_item_meta['fpd_data']['fpd_remove_cart_item'] = $_POST['fpd_remove_cart_item'];

			}

		    return $cart_item_meta;
		}

		public function get_cart_item_from_session( $cart_item, $values ) {

	        //check for fpd data in session
	        if (isset($values['fpd_data'])) {
	            $cart_item['fpd_data'] = $values['fpd_data'];
	        }

			//check if cart item is fancy product
	        if (isset($cart_item['fpd_data'])) {
	        	//add fpd data to cart item
	            $this->add_cart_item($cart_item);
	        }

	        return $cart_item;
	    }

		public function reset_cart_item_link( $link, $cart_item, $cart_item_key ) {

			$url = add_query_arg( array('cart_item_key' => $cart_item_key), $cart_item['data']->get_permalink() );
			return sprintf( '<a href="%s">%s<br /><i style="opacity: 1; font-size: 0.9em;">%s</i></a>', $url, $cart_item['data']->get_title(), fpd_get_option('fpd_cart_reedit_product') );

		}

		public function change_cart_item_thumbnail( $thumbnail, $cart_item=null ) {

			if( !is_null($cart_item) && isset($cart_item['fpd_data']) ) {

				$fpd_data = $cart_item['fpd_data'];

				//check if data contains the fancy product thumbnail
		        if ( isset($fpd_data['fpd_product_thumbnail']) && $fpd_data['fpd_product_thumbnail']) {

		        	$dom = new DOMDocument;
					libxml_use_internal_errors(true);
					$dom->loadHTML( $thumbnail );
					$xpath = new DOMXPath( $dom );
					libxml_clear_errors();
					$doc = $dom->getElementsByTagName("img")->item(0);
					$src = $xpath->query(".//@src");

					foreach ( $src as $s ) {
						$s->nodeValue = $fpd_data['fpd_product_thumbnail'];
					}

					$output = $dom->saveXML( $doc );

					return $output;

		        }

			}

			return $thumbnail;

		}
	}
}

new FPD_Cart();

?>