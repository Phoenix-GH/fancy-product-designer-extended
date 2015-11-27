<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Settings_Labels') ) {

	class FPD_Settings_Labels {

		public static function get_options() {

			return apply_filters('fpd_labels_settings', array(

				'product-designer' => array(

					array(
						'title' => __( 'Manage Layers', 'radykal' ),
						'id' 		=> 'fpd_label_layersButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Manage Layers', 'fpd_label')
					),

					array(
						'title' => __( 'Add', 'radykal' ),
						'id' 		=> 'fpd_label_addsButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Add', 'fpd_label')
					),

					array(
						'title' => __( 'Change Products', 'radykal' ),
						'id' 		=> 'fpd_label_productsButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Change Products', 'fpd_label')
					),

					array(
						'title' => __( 'More', 'radykal' ),
						'id' 		=> 'fpd_label_moreButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Actions', 'fpd_label')
					),

					array(
						'title' => __( 'Download PDF', 'radykal' ),
						'id' 		=> 'fpd_label_downLoadPDF',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Download PDF', 'fpd_label')
					),

					array(
						'title' => __( 'Download Image', 'radykal' ),
						'id' 		=> 'fpd_label_downloadImage',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Download Image', 'fpd_label')
					),

					array(
						'title' => __( 'Print', 'radykal' ),
						'id' 		=> 'fpd_label_print',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Print', 'fpd_label')
					),

					array(
						'title' => __( 'Save', 'radykal' ),
						'id' 		=> 'fpd_label_saveProduct',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Save', 'fpd_label')
					),

					array(
						'title' => __( 'Load', 'radykal' ),
						'id' 		=> 'fpd_label_loadProduct',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Load', 'fpd_label')
					),

					array(
						'title' => __( 'Undo', 'radykal' ),
						'id' 		=> 'fpd_label_undoButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Undo', 'fpd_label')
					),

					array(
						'title' => __( 'Redo', 'radykal' ),
						'id' 		=> 'fpd_label_redoButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Redo', 'fpd_label')
					),

					array(
						'title' => __( 'Reset Product', 'radykal' ),
						'id' 		=> 'fpd_label_resetProductButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Reset Product', 'fpd_label')
					),

					array(
						'title' => __( 'Zoom', 'radykal' ),
						'id' 		=> 'fpd_label_zoomButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Zoom', 'fpd_label')
					),

					array(
						'title' => __( 'Pan', 'radykal' ),
						'id' 		=> 'fpd_label_panButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Pan', 'fpd_label')
					),

					array(
						'title' => __( 'Add your own Image', 'radykal' ),
						'id' 		=> 'fpd_label_addImageButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __(' Add your own Image', 'fpd_label')
					),

					array(
						'title' => __( 'Add your own text', 'radykal' ),
						'id' 		=> 'fpd_label_addTextButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Add your own text', 'fpd_label')
					),

					array(
						'title' => __( 'Enter your text', 'radykal' ),
						'id' 		=> 'fpd_label_enterText',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Enter your text', 'fpd_label')
					),

					array(
						'title' => __( 'Add photo from Facebook', 'radykal' ),
						'id' 		=> 'fpd_label_addFBButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Add photo from facebook', 'fpd_label')
					),

					array(
						'title' => __( 'Add photo from Instagram', 'radykal' ),
						'id' 		=> 'fpd_label_addInstaButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Add photo from instagram', 'fpd_label')
					),

					array(
						'title' => __( 'Choose from Designs', 'radykal' ),
						'id' 		=> 'fpd_label_addDesignButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Choose from Designs', 'fpd_label')
					),

					array(
						'title' => __( 'Edit Element', 'radykal' ),
						'id' 		=> 'fpd_label_editElement',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Edit Element', 'fpd_label')
					),

					array(
						'title' => __( 'Fill Options', 'radykal' ),
						'id' 		=> 'fpd_label_fillOptions',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Fill Options', 'fpd_label')
					),

					array(
						'title' => __( 'Color', 'radykal' ),
						'id' 		=> 'fpd_label_color',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Color', 'fpd_label')
					),

					array(
						'title' => __( 'Patterns', 'radykal' ),
						'id' 		=> 'fpd_label_patterns',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Patterns', 'fpd_label')
					),

					array(
						'title' => __( 'Opacity', 'radykal' ),
						'id' 		=> 'fpd_label_opacity',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Opacity', 'fpd_label')
					),

					array(
						'title' => __( 'Filter', 'radykal' ),
						'id' 		=> 'fpd_label_filter',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Filter', 'fpd_label')
					),

					array(
						'title' => __( 'Text Options', 'radykal' ),
						'id' 		=> 'fpd_label_textOptions',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Text Options', 'fpd_label')
					),

					array(
						'title' => __( 'Change Text', 'radykal' ),
						'id' 		=> 'fpd_label_changeText',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Change Text', 'fpd_label')
					),

					array(
						'title' => __( 'Typeface', 'radykal' ),
						'id' 		=> 'fpd_label_typeface',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Typeface', 'fpd_label')
					),

					array(
						'title' => __( 'Line Height', 'radykal' ),
						'id' 		=> 'fpd_label_lineHeight',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Line Height', 'fpd_label')
					),

					array(
						'title' => __( 'Alignment', 'radykal' ),
						'id' 		=> 'fpd_label_textAlign',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Alignment', 'fpd_label')
					),

					array(
						'title' => __( 'Align Left', 'radykal' ),
						'id' 		=> 'fpd_label_textAlignLeft',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Align Left', 'fpd_label')
					),

					array(
						'title' => __( 'Align Center', 'radykal' ),
						'id' 		=> 'fpd_label_textAlignCenter',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Align Center', 'fpd_label')
					),

					array(
						'title' => __( 'Align Right', 'radykal' ),
						'id' 		=> 'fpd_label_textAlignRight',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Align Right', 'fpd_label')
					),

					array(
						'title' => __( 'Styling', 'radykal' ),
						'id' 		=> 'fpd_label_textStyling',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Styling', 'fpd_label')
					),

					array(
						'title' => __( 'Bold', 'radykal' ),
						'id' 		=> 'fpd_label_bold',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Bold', 'fpd_label')
					),

					array(
						'title' => __( 'Italic', 'radykal' ),
						'id' 		=> 'fpd_label_italic',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Italic', 'fpd_label')
					),

					array(
						'title' => __( 'Underline', 'radykal' ),
						'id' 		=> 'fpd_label_underline',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Underline', 'fpd_label')
					),

					array(
						'title' => __( 'Curved Text', 'radykal' ),
						'id' 		=> 'fpd_label_curvedText',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Curved Text', 'fpd_label')
					),

					array(
						'title' => __( 'Spacing', 'radykal' ),
						'id' 		=> 'fpd_label_curvedTextSpacing',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Spacing', 'fpd_label')
					),

					array(
						'title' => __( 'Radius', 'radykal' ),
						'id' 		=> 'fpd_label_curvedTextRadius',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Radius', 'fpd_label')
					),

					array(
						'title' => __( 'Reverse', 'radykal' ),
						'id' 		=> 'fpd_label_curvedTextReverse',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Reverse', 'fpd_label')
					),

					array(
						'title' => __( 'Transform', 'radykal' ),
						'id' 		=> 'fpd_label_transform',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Transform', 'fpd_label')
					),

					array(
						'title' => __( 'Angle', 'radykal' ),
						'id' 		=> 'fpd_label_angle',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Angle', 'fpd_label')
					),

					array(
						'title' => __( 'Scale', 'radykal' ),
						'id' 		=> 'fpd_label_scale',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Scale', 'fpd_label')
					),

					array(
						'title' => __( 'Move Up', 'radykal' ),
						'id' 		=> 'fpd_label_moveUp',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Move Up', 'fpd_label')
					),

					array(
						'title' => __( 'Move Down', 'radykal' ),
						'id' 		=> 'fpd_label_moveDown',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Move Down', 'fpd_label')
					),

					array(
						'title' => __( 'Center Horizontal', 'radykal' ),
						'id' 		=> 'fpd_label_centerH',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Center Horizontal', 'fpd_label')
					),

					array(
						'title' => __( 'Center Vertical', 'radykal' ),
						'id' 		=> 'fpd_label_centerV',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Center Vertical', 'fpd_label')
					),

					array(
						'title' => __( 'Flip Horizontal', 'radykal' ),
						'id' 		=> 'fpd_label_flipHorizontal',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Flip Horizontal', 'fpd_label')
					),

					array(
						'title' => __( 'Flip Vertical', 'radykal' ),
						'id' 		=> 'fpd_label_flipVertical',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Flip Vertical', 'fpd_label')
					),

					array(
						'title' => __( 'Reset Element', 'radykal' ),
						'id' 		=> 'fpd_label_resetElement',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Reset Element', 'fpd_label')
					),

					array(
						'title' => __( 'Facebook: Select an album', 'radykal' ),
						'id' 		=> 'fpd_label_fbSelectAlbum',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Select an album', 'fpd_label')
					),

					array(
						'title' => __( 'Instagram: My Feed', 'radykal' ),
						'id' 		=> 'fpd_label_instaFeedButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('My Feed', 'fpd_label')
					),

					array(
						'title' => __( 'Instagram: My Recent Images', 'radykal' ),
						'id' 		=> 'fpd_label_instaRecentImagesButton',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('My Recent Images', 'fpd_label')
					),

					array(
						'title' => __( 'Product Saved!', 'radykal' ),
						'id' 		=> 'fpd_label_productSaved',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Product Saved!', 'fpd_label')
					),

					array(
						'title' => __( 'Lock', 'radykal' ),
						'id' 		=> 'fpd_label_lock',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Lock', 'fpd_label')
					),

					array(
						'title' => __( 'Unlock', 'radykal' ),
						'id' 		=> 'fpd_label_unlock',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Unlock', 'fpd_label')
					),

					array(
						'title' => __( 'Remove', 'radykal' ),
						'id' 		=> 'fpd_label_remove',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Remove', 'fpd_label')
					),

					array(
						'title' => __( 'Move this element inside the containment area!', 'radykal' ),
						'id' 		=> 'fpd_label_outOfContainmentAlert',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Move it in his containment!', 'fpd_label')
					),

					array(
						'title' => __( 'Initializing product designer', 'radykal' ),
						'id' 		=> 'fpd_label_initText',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Initializing product designer', 'fpd_label')
					),

					array(
						'title' => __( 'Uploaded Images Category Title', 'radykal' ),
						'id' 		=> 'fpd_label_myUploadedImgCat',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Your uploaded images', 'fpd_label')
					),

					array(
						'title' => __( 'Incorrect Image Size Alert', 'radykal' ),
						'description' 		=> __( 'This message will be displayed in the alert box, if the uploaded image does not has the required image dimensions.<br /><strong>Following placeholders can be used within the message</strong>:<ul><li>%minW: Minimum allowed image width.</li><li>%minH: Minimum allowed image height.</li><li>%maxW: Maximum allowed image width.</li><li>%maxH: Maximum allowed image height.</li></ul>', 'radykal' ),
						'id' 		=> 'fpd_label_uploadedDesignSizeAlert',
						'type' 		=> 'textarea',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Sorry! The image you have uploaded does not meet the size requirements.
<br />Minimum Width: %minW pixels
<br />Minimum Height: %minH pixels
<br />Maximum Width: %maxW pixels
<br />Maximum Height: %maxH pixels', 'fpd_label')
					),

					array(
						'title' => __( 'Modal Alert: Submit', 'radykal' ),
						'id' 		=> 'fpd_label_modalSubmit',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('OK, got it!', 'fpd_label')
					),

				),

				'misc-labels' => array(

					array(
						'title' => __( 'WooCommerce Catalog: Add To Cart Button', 'radykal' ),
						'id' 		=> 'fpd_label_add_to_cart_text',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Customize', 'fpd_label')
					),

					array(
						'title' => __( 'WooCommerce Order Email: View Customized Product', 'radykal' ),
						'id' 		=> 'fpd_label_wc_order_email_view',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('View Customized Product', 'fpd_label')
					),

					array(
						'title' => __( 'Lightbox Submit Button', 'radykal' ),
						'id' 		=> 'fpd_label_lightbox_submit_button',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Done', 'fpd_label')
					),

					array(
						'title' => __( 'Lightbox Cancel Button', 'radykal' ),
						'id' 		=> 'fpd_label_lightbox_cancel_button',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Cancel', 'fpd_label')
					),

					array(
						'title' => __( 'Shortcode Order: Successfully Sent', 'radykal' ),
						'id' 		=> 'fpd_label_order_success_sent',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('The order has been successfully sent to the site owner!', 'fpd_label')
					),

					array(
						'title' => __( 'Shortcode Order: Sent Fail', 'radykal' ),
						'id' 		=> 'fpd_label_order_fail_sent',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('The order could not be sent. Please try again or contact the site owner!', 'fpd_label')
					),

					array(
						'title' => __( 'Not Supported Device Information', 'radykal' ),
						'description' 		=> __( 'The placeholder text to be displayed when Fancy Product Designer has been disabled for smart phones and tablets.', 'radykal' ),
						'id' 		=> 'fpd_label_not_supported_device_info',
						'type' 		=> 'textarea',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Sorry! But the product designer has not been optimised for your device. Please use a device with a larger screen!', 'fpd_label')
					),

					array(
						'title' => __( 'Design Sharing: Share Design Button', 'radykal' ),
						'id' 		=> 'fpd_label_sharing_button',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Share Design', 'fpd_label')
					),

					array(
						'title' => __( 'Design Sharing: Processing', 'radykal' ),
						'id' 		=> 'fpd_label_sharing_processing',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('An unique URL to share will be created for you...', 'fpd_label')
					),

					array(
						'title' => __( 'Design Sharing: Default Text', 'radykal' ),
						'id' 		=> 'fpd_label_sharing_default_text',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Check out my design!', 'fpd_label')
					),

					array(
						'title' => __( 'Cart: Re-edit product', 'radykal' ),
						'id' 		=> 'fpd_cart_reedit_product',
						'type' 		=> 'text',
						'css' 		=> 'width: 100%;',
						'default'	=> __('Click here to re-edit', 'fpd_label')
					),

				),

			));
		}

		public static function get_labels_object_string( $additional_labels = array() ) {

			$productDesignerLabels = self::get_options();
			$productDesignerLabels = $productDesignerLabels['product-designer'];

			$obj_string = '{';
			foreach($productDesignerLabels as $key => $value) {
				$id = $value['id'];
				$option_value = fpd_get_option($id);
				$option_value = empty($option_value) || !fpd_get_option('fpd_use_label_settings') ? $value['default'] : $option_value;

				if( isset($additional_labels[$id]) && $id === 'fpd_label_uploadedDesignSizeAlert' ) {

					$image_dimensions = $additional_labels[$id];
					$option_value = str_replace('%minW', $image_dimensions['minW'], $option_value);
					$option_value = str_replace('%minH', $image_dimensions['minH'], $option_value);
					$option_value = str_replace('%maxW', $image_dimensions['maxW'], $option_value);
					$option_value = str_replace('%maxH', $image_dimensions['maxH'], $option_value);

				}

				$obj_string .= str_replace('fpd_label_', '', $value['id']) . ':"' .htmlspecialchars_decode( esc_js( $option_value ) ).'",';
			}
			$obj_string = rtrim($obj_string, ",");
			$obj_string .= '}';

			return $obj_string;

		}
	}

}