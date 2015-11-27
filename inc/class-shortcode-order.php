<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('FPD_Shortcode_Order')) {

	class FPD_Shortcode_Order {

		public static function create( $customer_name, $customer_mail, $views ) {

			if( empty($views) ) {
				return false;
			}

			global $wpdb, $charset_collate;

			//create views table if necessary
			if( !fpd_table_exists(FPD_ORDERS_TABLE) ) {

				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

				//create products table
				$sql_string = "ID BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				              customer_name VARCHAR(300) COLLATE utf8_general_ci NOT NULL,
				              customer_mail VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
				              views LONGTEXT COLLATE utf8_general_ci NOT NULL,
							  PRIMARY KEY (ID)";

				$sql = "CREATE TABLE ".FPD_ORDERS_TABLE." ($sql_string) $charset_collate;";
				dbDelta($sql);

			}

			$inserted = $wpdb->insert(
				FPD_ORDERS_TABLE,
				array(
					'customer_name' => $customer_name,
					'customer_mail' => $customer_mail,
					'views' => $views
				),
				array( '%s', '%s', '%s' )
			);

			if( $inserted ) {

				$admin_mail = get_option('admin_email');
				$subject = sprintf( __('New Order received from %s', 'radykal'), $customer_name );

				$message  = sprintf( __('New Order received from %s.', 'radykal'), $customer_name)."\n\n";
				$message .= sprintf( __('Order Details for #%d', 'radykal'), $inserted)."\n";
				$message .= "====================================\n";
				$message .= sprintf( __('Customer Name: %s', 'radykal'), $customer_name )."\n";
				$message .= sprintf( __('Customer Email: %s', 'radykal'), $customer_mail)."\n";
				$message .= "====================================\n\n";
				$message .= sprintf( __('View Order: %s', 'radykal'), esc_url_raw( admin_url('admin.php?page=fpd_orders') ) )."\n";

				wp_mail( $admin_mail, $subject, $message );
				return $inserted;

			}
			else {
				return false;
			}

		}

		public static function get_orders( $limit=5, $offset=0 ) {

			if( fpd_table_exists(FPD_ORDERS_TABLE) ) {

				global $wpdb;

				return $wpdb->get_results("SELECT * FROM ".FPD_ORDERS_TABLE." ORDER BY ID DESC LIMIT $limit OFFSET $offset");

			}

			return false;

		}

		public static function delete( $id ) {

			global $wpdb;

			try {
				$wpdb->query( $wpdb->prepare("DELETE FROM ".FPD_ORDERS_TABLE." WHERE ID=%d", $id) );
				return 1;
			}
			catch(Exception $e) {
				return 0;
			}

		}

	}

}