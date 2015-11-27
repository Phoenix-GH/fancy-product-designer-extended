<?php

function radykal_output_option_item( $options ) {

	if( !class_exists('Radykal_Settings') ) {
		require_once( dirname(__FILE__) .'/class-admin-settings.php' );
	}

	Radykal_Settings::output_item( $options );
}

?>