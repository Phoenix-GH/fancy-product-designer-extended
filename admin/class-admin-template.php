<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('FPD_Admin_Template')) {

	class FPD_Admin_Template {

		public static function create( $title, $views ) {

			global $wpdb, $charset_collate;

			//create templates table if necessary
			if( !fpd_table_exists(FPD_TEMPLATES_TABLE) ) {
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				//create table
				$views_sql = "ID BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				              title TEXT COLLATE utf8_general_ci NOT NULL,
				              views LONGTEXT COLLATE utf8_general_ci NOT NULL,
							  PRIMARY KEY (ID)";

				$sql = "CREATE TABLE ".FPD_TEMPLATES_TABLE." ($views_sql) $charset_collate;";

				dbDelta($sql);
			}

			$inserted = $wpdb->insert(
				FPD_TEMPLATES_TABLE,
				array(
					'title' => $title,
					'views' => $views
				),
				array( '%s', '%s' )
			);

			return $inserted;

		}

		public static function get_views( $id ) {

			global $wpdb;
			$views = $wpdb->get_row("SELECT views FROM ".FPD_TEMPLATES_TABLE." WHERE ID={$id}");
			return $views->views;

		}

		public static function delete( $id ) {

			global $wpdb;

			try {
				$wpdb->query( $wpdb->prepare("DELETE FROM ".FPD_TEMPLATES_TABLE." WHERE ID=%d", $id) );
				return 1;
			}
			catch(Exception $e) {
				return 0;
			}

		}

	}

}