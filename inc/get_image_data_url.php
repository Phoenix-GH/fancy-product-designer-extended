<?php

//Returns the data url of an image

$url = trim($_POST['url']);

if(!function_exists('getimagesize')) {
	echo json_encode(array('error' => 'The php function getimagesize is not installed on your server. Please contact your server provider!'));
	die;
}

$img_formats = array("image/png", "image/jpg", "image/jpeg", "image/svg");
$img_info = getimagesize($url);

if ( !in_array(strtolower($img_info['mime']), $img_formats) ) {
	echo json_encode(array('error' => 'This is not an image file!'));
    die;
}

if(!function_exists('curl_version')) {
	echo json_encode(array('error' => 'cURL is not enabled on your web server, please enable it!'));
	die;
}

$result = false;
if( function_exists('curl_exec') ) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	$result = curl_exec($ch);
	curl_close($ch);
}


if($result == false) {
	$result = file_get_contents($url);
}

$info = getimagesize($url);
$data_url =  'data: '.$info['mime'].';base64,'.base64_encode($result);
echo json_encode(array( 'image_src' => $data_url));

?>