<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


function fpd_admin_display_version_info() {

		echo '<div class="fpd-header-right"><a href="http://support.fancyproductdesigner.com" target="_blank" class="button-primary">'.__('Support Center', 'radykal').'</a><p class="description">';

		if( false === ( $fpd_version = get_transient( 'fpd_version' ) )) {

			$version_str = fpd_admin_get_file_content("http://assets.radykal.de/fpd/version.json");
			if($version_str !== false) {
				$json = json_decode($version_str, true);
				$current_version = $json['version'];

				set_transient('fpd_version', $current_version, HOUR_IN_SECONDS);
			}

		}
		else {

			$current_version = $fpd_version;
			delete_transient('fpd_version');

		}

		if(Fancy_Product_Designer::VERSION < $current_version) {

			_e('You are not using the <a href="http://support.fancyproductdesigner.com/support/discussions/forums/5000283646" target="_blank">latest version</a> of Fancy Product Designer. Please go to your <a href="http://codecanyon.net/downloads" target="_blank">downloads tab on codecanyon</a> and download it again. Read also the <a href="http://support.fancyproductdesigner.com/support/solutions/articles/5000582931" target="_blank">upgrading documentation</a> how to install a new version.', 'radykal');

		}

		echo '</p></div>';
}


function fpd_admin_get_file_content( $file ) {

	$result = false;
	if( function_exists('curl_exec') ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$result = curl_exec($ch);
		curl_close($ch);
	}

	//if curl does not work, use file_get_contents
	if( $result == false && function_exists('file_get_contents') ) {
		$result = @file_get_contents($file);
	}

	if($result !== false) {
		return $result;
	}
	else {
		return false;
	}

}

function fpd_admin_upload_image_to_wp( $name, $base64_image, $add_to_library = true ) {

	//upload to wordpress
	$upload = wp_upload_bits( $name, null, base64_decode($base64_image) );

	//add to media library
	if( $add_to_library && isset($upload['url']) ) {
		media_sideload_image( $upload['url'], 0 );
	}

	return $upload['error'] === false ? $upload['url'] : false;

}

?>