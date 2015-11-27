<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists('Radykal_Framework') ) {

	class Radykal_Framework {

		public function __construct() {

			require_once( dirname(__FILE__) .'/functions.php' );

			add_action( 'admin_init', array( &$this, 'register_admin_styles_scripts' ) );

		}

		public function register_admin_styles_scripts() {

			//register css files
			wp_register_style( 'radykal-admin', plugins_url('/css/admin.css', __FILE__) );
			wp_register_style( 'radykal-select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css', false, '3.5.2' );
			wp_register_style( 'radykal-tagsmanager', plugins_url('/css/tagmanager.css', __FILE__) );
			wp_register_style( 'radykal-tooltipster', plugins_url('/css/tooltipster.css', __FILE__) );

			//register js files
			wp_register_script( 'radykal-ace-editor', '//cdnjs.cloudflare.com/ajax/libs/ace/1.1.8/ace.js' );
			wp_register_script( 'radykal-select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js', array( 'jquery' ), '3.5.2' );
			wp_register_script( 'radykal-tagsmanager', plugins_url('/js/tagmanager.js', __FILE__) );
			wp_register_script( 'radykal-tooltipster', plugins_url('/js/jquery.tooltipster.min.js', __FILE__) );
			wp_register_script( 'radykal-admin', plugins_url('/js/admin.js', __FILE__) );


		}

	}

	new Radykal_Framework();

}

?>