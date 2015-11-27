<?php
/**
 * Class used for resampling images
 */

class Resampler
{
	/**
	 * Resample an image
	 *
	 * The image is returned as a string ready to be saved, it is not converteed back to a resource
	 * as that would just be unnecessary
	 *
	 * @param  resource  $image Resource storing JPEG image
	 * @param  integer $dpi   	The dpi the image should be resampled at
	 * @return string         	Resampled JPEG image as a string
	 */
	function resample($image, $height, $width, $format = 'jpeg', $dpi = 300)
	{
		if(!$image)
		{
			throw new \Exception('Attempting to resample an empty image');
		}

		if(gettype($image) !== 'resource')
		{
			throw new \Exception('Attempting to resample something which is not a resource');
		}

		//Use truecolour image to avoid any issues with colours changing
		$tmp_img =  imagecreatetruecolor($width, $height);

		//Resample the image to be ready for print
		if(!imagecopyresampled ($tmp_img , $image , 0 , 0 ,0 , 0 , $width , $height , imagesx($image) , imagesy($image)))
		{
			throw new \Exception("Unable to resample image");
		}

		//Massive hack to get the image as a jpeg string but there is no php function which converts
		//a GD image resource to a JPEG string
		ob_start();
			imagejpeg($tmp_img, null, 100);
			$image = ob_get_contents();
		ob_end_clean();

		//change the JPEG header to 300 pixels per inch
		$image = substr_replace($image, pack("Cnn", 0x01, $dpi, $dpi), 13, 5);

		return $image;
	}
}