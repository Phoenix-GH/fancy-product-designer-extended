<?php

if(!class_exists('FPD_Admin_Ajax')) {

	class FPD_Admin_Ajax {

		public function __construct() {

			//manage fancy products
			add_action( 'wp_ajax_fpd_newproduct', array( &$this, 'new_product' ) );
			add_action( 'wp_ajax_fpd_editproduct', array( &$this, 'edit_product' ) );
			add_action( 'wp_ajax_fpd_export', array( &$this, 'export_product' ) );
			add_action( 'wp_ajax_fpd_saveastemplate', array( &$this, 'save_as_template' ) );
			add_action( 'wp_ajax_fpd_removetemplate', array( &$this, 'remove_template' ) );
			add_action( 'wp_ajax_fpd_loadtemplate', array( &$this, 'create_views_from_template' ) );
			add_action( 'wp_ajax_fpd_removeproduct', array( &$this, 'remove_product' ) );
			add_action( 'wp_ajax_fpd_newcategory', array( &$this, 'new_category' ) );
			add_action( 'wp_ajax_fpd_assigncategory', array( &$this, 'assign_category' ) );
			add_action( 'wp_ajax_fpd_removecategory', array( &$this, 'remove_category' ) );
			add_action( 'wp_ajax_fpd_newview', array( &$this, 'new_view' ) );
			add_action( 'wp_ajax_fpd_editview', array( &$this, 'edit_view' ) );
			add_action( 'wp_ajax_fpd_duplicateview', array( &$this, 'duplicate_view' ) );
			add_action( 'wp_ajax_fpd_removeview', array( &$this, 'remove_view' ) );
			add_action( 'wp_ajax_fpd_saveviews', array( &$this, 'save_views' ) );
			add_action( 'wp_ajax_fpd_loaddemo', array( &$this, 'load_demo' ) );

			//order
			add_action( 'wp_ajax_fpd_loadorder', array( &$this, 'load_order' ) );
			add_action( 'wp_ajax_fpd_imagefromdataurl', array( &$this, 'create_image_from_dataurl' ) );
			add_action( 'wp_ajax_fpd_imagefromsvg', array( &$this, 'create_image_from_svg' ) );
			add_action( 'wp_ajax_fpd_pdffromdataurl', array( &$this, 'create_pdf_from_dataurl' ) );
			add_action( 'wp_ajax_fpd_loadorderitemimages', array( &$this, 'load_order_item_images' ) );

			//shortcode order
			add_action( 'wp_ajax_fpd_removeshortcodeorder', array( &$this, 'remove_shortcode_order' ) );

		}

		//load the order data for the order viewer
		public function load_order() {

			if ( !isset($_POST['order_id']) || !isset($_POST['item_id']) )
			    die;

			header('Content-Type: application/json');

			$wc_order = wc_get_order( $_POST['order_id'] );
			$fpd_data = $wc_order->get_item_meta($_POST['item_id'], 'fpd_data', true);

			if( $fpd_data && isset($fpd_data['fpd_product']) ) {

				$views = fpd_update_image_source($fpd_data['fpd_product']);

				echo json_encode(
					array(
						'order_data' => $views
					)
				);

			}

			die;

		}

		//add a new product
		public function new_product() {

			if ( !isset($_POST['title']) )
			    die;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			if ( class_exists( 'Fancy_Product' ) ) {

				$id = Fancy_Product::create( $_POST['title'] );

				header('Content-Type: application/json');
				echo json_encode(
					array(
						'id' => $id,
						'message' => $id ? __('Product successfully created!', 'radykal') : __('Product could not be created. Please try again!', 'radykal'),
						'html' => FPD_Admin_Manage_Fancy_Products::get_product_item_html( $id, $_POST['title'], '', '' )
					)
				);

			}

			die;

		}

		//edit title and thumbnail of a view
		public function edit_product() {

			if ( !isset($_POST['id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$columns = array();
			if ( class_exists( 'Fancy_Product' ) ) {

				$fancy_product = new Fancy_Product( $_POST['id'] );
				$columns = $fancy_product->update(
					isset($_POST['title']) ? $_POST['title'] : false,
					isset($_POST['options']) ? $_POST['options'] : false
				);

			}

			header('Content-Type: application/json');

			if( !empty($columns) ) {
				echo json_encode(array(
					'columns' => $columns,
					'message' => __('Product Updated!', 'radykal'),
					'id' => $_POST['id']
				));
			}
			else {
				echo json_encode(0);
			}

			die;

		}

		//remove a fancy product
		public function remove_product() {

			if ( !isset($_POST['id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			header('Content-Type: application/json');

			$fancy_product = new Fancy_Product( $_POST['id'] );
			$result = $fancy_product->delete();
			echo json_encode($result);

			die;

		}

		public function assign_category() {

			if ( !isset($_POST['productID']) || !isset($_POST['categoryID']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			global $wpdb;
			$checked = intval($_POST['checked']);

			header('Content-Type: application/json');

			if( $checked ) {

				$fancy_category = new Fancy_Category($_POST['categoryID']);
				$inserted = $fancy_category->add_product($_POST['productID']); //assign product to category

				echo json_encode($inserted);

			}
			else {

				$test = $wpdb->query( $wpdb->prepare("DELETE FROM ".FPD_CATEGORY_PRODUCTS_REL_TABLE." WHERE category_id=%d AND product_id=%d", $_POST['categoryID'], $_POST['productID']) );
				echo json_encode($test);
			}

			die;

		}

		//add a new category
		public function new_category() {

			if ( !isset($_POST['title']) )
			    die;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			if ( class_exists( 'Fancy_Category' ) ) {

				$id = Fancy_Category::create( $_POST['title'] );

				header('Content-Type: application/json');
				echo json_encode(
					array(
						'id' => $id,
						'message' => $id ? __('Category successfully created!', 'radykal') : __('Category could not be created. Please try again!', 'radykal'),
						'html' => FPD_Admin_Manage_Fancy_Products::get_category_item_html( $id, $_POST['title'] )
					)
				);

			}

			die;

		}

		//remove a view from a fancy product
		public function remove_category() {

			if ( !isset($_POST['id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			header('Content-Type: application/json');

			$fancy_category = new Fancy_Category( $_POST['id'] );
			$result = $fancy_category->delete();
			echo json_encode($result);

			die;

		}

		//add a new view to a fancy product
		public function new_view() {

			if ( !isset($_POST['title']) || !isset($_POST['product_id']) )
			    die;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$title = trim($_POST['title']);
			$thumbnail = trim($_POST['thumbnail']);
			$product_id = trim($_POST['product_id']);
			$elements = isset($_POST['elements']) ? trim($_POST['elements']) : false;
			$add_to_library = isset($_POST['add_images_to_library']) ? (bool) intval($_POST['add_images_to_library']) : false;

			global $wpdb, $charset_collate;

			//create views table if necessary
			if( !fpd_table_exists(FPD_VIEWS_TABLE) ) {
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				//create table
				$views_sql = "ID BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
							  product_id BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
				              title TEXT COLLATE utf8_general_ci NOT NULL,
				              thumbnail TEXT COLLATE utf8_general_ci NOT NULL,
				              elements LONGTEXT COLLATE utf8_general_ci NULL,
				              view_order INT COLLATE utf8_general_ci NULL,
				              options TEXT COLLATE utf8_general_ci NULL,
							  PRIMARY KEY (ID)";

				$sql = "CREATE TABLE ".FPD_VIEWS_TABLE." ($views_sql) $charset_collate;";

				dbDelta($sql);
			}

			//check if thumbnail is base64 encoded, if yes, create and upload image to wordpress media library
			if(base64_encode(base64_decode($thumbnail, true)) === $thumbnail) {
				$thumbnail = fpd_admin_upload_image_to_wp($_POST['thumbnail_name'], $thumbnail, $add_to_library);
			}

			//check if elements are posted
		    if($elements !== false) {

			    $elements = json_decode(stripslashes($elements), true);

			    //loop through all elements
			    for($i=0;  $i < sizeof($elements); $i++) {

					$element = $elements[$i];

				    if( $element['type'] == 'image' ) {

						//get parts of source string
				    	$image_parts = explode(',', $element['source']);
				    	$type = @$image_parts[0]; //type of image
				    	$base64_image = @$image_parts[1]; //the base 64 encoded image string

						//check if string is base64 encoded
				    	if( !is_null($base64_image) && base64_encode(base64_decode($base64_image, true)) === $base64_image ) {

							if( isset($type) ) {
								if( strpos($type, 'png') !== false ) {
							    	$type = 'png';
						    	}
						    	else {
							    	$type = 'jpeg';
						    	}
							}

							$elements[$i]['source'] = fpd_admin_upload_image_to_wp($element['title'].'.'.$type, $base64_image, $add_to_library);
				    	}

				    }

			    }

				//serialize for database
			    $elements = serialize($elements);

		    }

		    //add view to fancy product
		    $fp = new Fancy_Product($product_id);
			$view_id = $fp->add_view($title, $elements, $thumbnail);

			//send answer
			header('Content-Type: application/json');

			if($view_id) {
				echo json_encode(array('html' => FPD_Admin_Manage_Fancy_Products::get_view_item_html($view_id, $thumbnail, $title, '')));
			}
			else {
				echo json_encode(0);
			}

			die;

		}

		//edit title and thumbnail of a view
		public function edit_view() {

			if ( !isset($_POST['id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$columns = array();

			if( isset($_POST['title']) ) {
				$columns['title'] = $_POST['title'];
			}

			if( isset($_POST['thumbnail']) ) {
				$columns['thumbnail'] = $_POST['thumbnail'];
			}

			if( isset($_POST['options']) ) {

				global $wpdb;

				$options_col_exist = $wpdb->query( "SHOW COLUMNS FROM ".FPD_VIEWS_TABLE." LIKE 'options'" );
				if($options_col_exist == 0) {
					$wpdb->query("ALTER TABLE ".FPD_VIEWS_TABLE." ADD options TEXT COLLATE utf8_general_ci NULL;");
				}

				$columns['options'] = $_POST['options'];
			}

			if ( class_exists( 'Fancy_View' ) ) {

				$fancy_view = new Fancy_View( $_POST['id'] );
				$success = $fancy_view->update($columns);

			}

			header('Content-Type: application/json');

			if( !empty($success) ) {
				echo json_encode(array(
					'columns' => $columns,
					'message' => __('View Updated!', 'radykal'),
					'id' => $_POST['id']
				));
			}
			else {
				echo json_encode(0);
			}

			die;

		}

		//duplicate view
		public function duplicate_view() {

			if ( !isset($_POST['id']) || !isset($_POST['title']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$id = trim($_POST['id']);
			$new_title = trim($_POST['title']);

			$fancy_view = new Fancy_View( $id );
			$new_view_data = $fancy_view->duplicate( $new_title );

			header('Content-Type: application/json');
			if( $new_view_data !== false ) {
				echo json_encode(
					array( 'html' => FPD_Admin_Manage_Fancy_Products::get_view_item_html( $new_view_data->ID, $new_view_data->thumbnail, $new_title, $new_view_data->options ) )
				);
			}
			else {
				echo json_encode(0);
			}

			die;

		}

		//remove a view from a fancy product
		public function remove_view() {

			if ( !isset($_POST['id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$id = trim($_POST['id']);

			header('Content-Type: application/json');

			$fancy_view = new Fancy_View($id);
			$result = $fancy_view->delete();
			echo json_encode($result);

			die;

		}

		public function save_views() {

			if ( !isset($_POST['ids']) )
			    exit;

		    check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

		    $ids = $_POST['ids'];

		    global $wpdb;

		    for($i = 0; $i < sizeof($ids); $i++) {

				$updated_rows = $wpdb->update(
				 	FPD_VIEWS_TABLE,
					 	array('view_order' => $i), //what
					 	array('ID' => intval($ids[$i])), //where
					 	array('%d'), //format what
					 	array('%d') //format where
				);

		    }

			header('Content-Type: application/json');

			if( $updated_rows !== false ) {
				echo json_encode(array(
					'message' => __('Product Updated!', 'radykal'),
				));
			}
			else {
				echo json_encode(0);
			}

			die;

		}

		public function load_demo() {

			if ( !isset($_POST['url']) )
			    exit;

		    check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			header('Content-Type: application/json');

			$json = fpd_admin_get_file_content($_POST['url']);

			if( $json !== false ) {

				echo json_encode(array(
					'url' => $_POST['url'],
					'json' => $json
				));

			}
			else {
				echo json_encode(0);
			}

			die;

		}

		//add a new view to a fancy product
		public function save_as_template() {

			if ( !isset($_POST['title']) || !isset($_POST['product_id']) )
			    die;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$fancy_product = new Fancy_Product( $_POST['product_id'] );
			$views = $fancy_product->get_views();
			foreach($views as $view) {
				unset($view->ID);
				unset($view->product_id);
				unset($view->view_order);
				unset($view->options);
				$view->elements = @unserialize($view->elements);
			}

			$views = json_encode($views);

		    //create new template
			$template_id = FPD_Admin_Template::create( $_POST['title'], $views );

			//send answer
			header('Content-Type: application/json');

			if( $template_id ) {
				echo json_encode(array(
					'id' => $template_id,
					'views' => $views,
					'html' => FPD_Admin_Manage_Fancy_Products::get_template_link_html(
						$template_id,
						$_POST['title'],
						$views
					),
					'message' => __('Template successfully created.', 'radykal')
				));
			}
			else {
				echo json_encode(array( 'error' => 1, 'message' => __('Template could not be stored. Please try again!', 'radykal') ));
			}

			die;

		}

		//remove template
		public function remove_template() {

			if ( !isset($_POST['id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$id = trim($_POST['id']);

			header('Content-Type: application/json');

			$result = FPD_Admin_Template::delete( $id );
			echo json_encode($result);

			die;

		}

		//load template
		public function create_views_from_template() {

			if ( !isset($_POST['id']) || !isset($_POST['product_id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$id = trim($_POST['id']);
			$product_id = trim($_POST['product_id']);

			header('Content-Type: application/json');

			try {

				$views = json_decode(FPD_Admin_Template::get_views( $id ), true);
				$fancy_product = new Fancy_Product($product_id);
				$html = '';

				foreach($views as $view) {

					$view_id = $fancy_product->add_view(
						$view['title'],
						serialize($view['elements']),
						$view['thumbnail']
					);

					$html .= FPD_Admin_Manage_Fancy_Products::get_view_item_html($view_id, $view['thumbnail'], $view['title'], '');

				}

				echo json_encode( array(
					'html'	  => $html,
					'message' => __('Product successfully created!', 'radykal')
				));

			}
			catch(Exception $e) {

				echo json_encode( array(
					'error' => 1,
					'message' => __('Fancy Product could not be stored. Please try again!', 'radykal')
				));

			}

			die;

		}

		public function export_product() {

			if ( !isset($_GET['id']) )
			    exit;

		    check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

		    $id = $_GET['id'];

		    $fp = new Fancy_Product($id);
		    $views = $fp->get_views();

		    header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=fancy_product_'.$id.'.json');

			$output = '{';
			foreach($views as $view) {

				$output .= '"'.$view->ID.'": {';
				$output .= '"title": "'.$view->title.'",';
				$elements = unserialize($view->elements);

				for($i=0; $i < sizeof($elements); $i++) {

					$source = $elements[$i]['source'];

					if($elements[$i]['type'] == 'image' && base64_encode(base64_decode($source, true)) !== $source) {

						$image_content = base64_encode(fpd_admin_get_file_content($source));
						if($image_content !== false) {
							$image_type = explode(".", basename($source), 2);
							$image_type = $image_type[1];
							$elements[$i]['source'] = $image_type.','.$image_content;
						}

					}

				}

				$output .= '"elements": '.stripslashes(json_encode($elements)).',';
				$output .= '"thumbnail_name": "'.basename($view->thumbnail).'",';
				$thumbnail_content = base64_encode(fpd_admin_get_file_content(stripslashes($view->thumbnail)));
				$output .= '"thumbnail": "'.($thumbnail_content === false ? stripslashes($view->thumbnail) : $thumbnail_content).'"},';

			}

			$output = rtrim($output, ",");

			$output .= '}';

			echo $output;

			die;
		}

		//creates an image from a data url
		public function create_image_from_dataurl() {

			if (
				!isset($_POST['order_id']) ||
				!isset($_POST['item_id']) ||
				!isset($_POST['data_url']) ||
				!isset($_POST['title']) ||
				!isset($_POST['format'])
			)
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$order_id = trim($_POST['order_id']);
			$item_id = trim($_POST['item_id']);
			$data_url = trim($_POST['data_url']);
			$title = sanitize_title( trim($_POST['title']) );
			$format = trim($_POST['format']);
			$dpi = isset($_POST['dpi']) ? intval($_POST['dpi']) : 300;

			//create fancy product orders directory
			if( !file_exists(FPD_ORDER_DIR) )
				wp_mkdir_p(FPD_ORDER_DIR);

			//create uploads dir
			$images_dir = FPD_ORDER_DIR.'images/';
			if( !file_exists($images_dir) )
				wp_mkdir_p($images_dir);

			//shortcode order
			if(empty($item_id)) {

				$shortcode_dir = FPD_ORDER_DIR.'images/_shortcode/';
				if( !file_exists($shortcode_dir) )
					wp_mkdir_p($shortcode_dir);

				$item_dir = $shortcode_dir.$order_id.'/';
				if( !file_exists($item_dir) )
					wp_mkdir_p($item_dir);

			}
			//wc order
			else {

				//create order dir
				$order_dir = $images_dir . $order_id . '/';
				if( !file_exists($order_dir) )
					wp_mkdir_p($order_dir);

				//create item dir
				$item_dir = $order_dir . $item_id . '/';
				if( !file_exists($item_dir) )
					wp_mkdir_p($item_dir);

			}

			$image_path = $item_dir.$title.'.'.$format;

			$image_exist = file_exists($image_path);

			//get the base-64 from data
			$base64_str = substr($data_url, strpos($data_url, ",")+1);
			//decode base64 string
			$decoded = base64_decode($base64_str);
			$result = file_put_contents($image_path, $decoded);

			if( $format == 'jpeg' ) {

				require_once(FPD_PLUGIN_ADMIN_DIR.'/inc/resampler.php');

				$source = imagecreatefromjpeg($image_path);
				list($width, $height) = getimagesize($image_path);
				$resampler = new Resampler;
				$im = $resampler->resample($source, $height, $width, $format, $dpi);
				file_put_contents($image_path, $im);

			}

			header('Content-Type: application/json');

			if( $result ) {
				$image_url = content_url( substr($image_path, strrpos($image_path, '/fancy_products_orders/')) );
				echo json_encode( array('code' => $image_exist ? 302 : 201, 'url' => $image_url, 'title' => $title) );
			}
			else {
				echo json_encode( array('code' => 500) );
			}

			die;

		}

		public function create_image_from_svg() {

			if ( !isset($_POST['order_id']) || !isset($_POST['item_id']) || !isset($_POST['svg']) || !isset($_POST['title']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			require_once(FPD_PLUGIN_ADMIN_DIR.'/inc/svglib/svglib.php');

			$order_id = trim($_POST['order_id']);
			$item_id = trim($_POST['item_id']);
			$svg = stripslashes(trim($_POST['svg']));
			$width = trim($_POST['width']);
			$height = trim($_POST['height']);
			$title = sanitize_title( trim($_POST['title']) );

			//create fancy product orders directory
			if( !file_exists(FPD_ORDER_DIR) )
				wp_mkdir_p(FPD_ORDER_DIR);

			//create uploads dir
			$images_dir = FPD_ORDER_DIR.'images/';
			if( !file_exists($images_dir) )
				wp_mkdir_p($images_dir);

			//shortcode order
			if(empty($item_id)) {

				$shortcode_dir = FPD_ORDER_DIR.'images/_shortcode/';
				if( !file_exists($shortcode_dir) )
					wp_mkdir_p($shortcode_dir);

				$item_dir = $shortcode_dir.$order_id.'/';
				if( !file_exists($item_dir) )
					wp_mkdir_p($item_dir);

			}
			//wc order
			else {

				//create order dir
				$order_dir = $images_dir . $order_id . '/';
				if( !file_exists($order_dir) )
					wp_mkdir_p($order_dir);

				//create item dir
				$item_dir = $order_dir . $item_id . '/';
				if( !file_exists($item_dir) )
					wp_mkdir_p($item_dir);

			}

			$image_path = $item_dir.$title.'.svg';

			$image_exist = file_exists($image_path);

			header('Content-Type: application/json');

			try {
				$svg = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="'.$width.'" height="'.$height.'" xml:space="preserve">'.$svg.'</svg>';

				$svg_doc = new SVGDocument($svg);
				$svg_doc->asXML($image_path);

				$image_url = content_url( substr($image_path, strrpos($image_path, '/fancy_products_orders/')) );
				echo json_encode( array('code' => $image_exist ? 302 : 201, 'url' => $image_url, 'title' => $title) );
			}
			catch(Exception $e) {
				echo json_encode( array('code' => 500) );
			}

			die;

		}

		//creates a pdf from a data url
		public function create_pdf_from_dataurl() {

			if ( !isset($_POST['order_id']) || !isset($_POST['data_strings']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			if( !class_exists('TCPDF') ) {
				require_once(FPD_PLUGIN_ADMIN_DIR.'/inc/tcpdf/tcpdf.php');
			}

			//register_shutdown_function( array( &$this, 'get_server_errors' ) );

			$order_id = trim($_POST['order_id']);
			$item_id = trim($_POST['item_id']);
			//if memory limit is too small, a fatal php error will thrown here
			$data_strings = json_decode(stripslashes($_POST['data_strings']));

			$width = trim($_POST['width']);
			$height = trim($_POST['height']);
			$image_format = trim($_POST['image_format']);
			$orientation = trim($_POST['orientation']);
			$dpi = isset($_POST['dpi']) ? intval($_POST['dpi']) : 300;

			//create fancy product orders directory
			if( !file_exists(FPD_ORDER_DIR) )
				wp_mkdir_p(FPD_ORDER_DIR);

			//create pdf dir
			$pdf_dir = FPD_ORDER_DIR.'pdfs/';
			$pdf_path = $pdf_dir.$order_id.'_'.$item_id.'.pdf';
			if( !file_exists($pdf_dir) )
				wp_mkdir_p($pdf_dir);

			//shortcode order
			if(empty($item_id)) {
				$pdf_dir = FPD_ORDER_DIR.'pdfs/_shortcode/';
				$pdf_path = $pdf_dir.$order_id.'.pdf';
				if( !file_exists($pdf_dir) )
					wp_mkdir_p($pdf_dir);
			}

			$pdf = new TCPDF($orientation, 'mm', array($width, $height), true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator( get_site_url() );
			$pdf->SetTitle($order_id);

			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			foreach($data_strings as $data_str) {
				$pdf->AddPage();
				if( $image_format == 'svg' ) {
					if( !class_exists('SVGDocument') )
						require_once(FPD_PLUGIN_ADMIN_DIR.'/inc/svglib/svglib.php');

					//$svg_doc = new SVGDocument($svg_data);
					//$svg_doc->asXML($svg_path);
					$pdf->ImageSVG('@'.$data_str);
				}
				else {
					$data_str = base64_decode(substr($data_str, strpos($data_str, ",") + 1));
					$pdf->Image('@'.$data_str,'', '', 0, 0, '', '', '', false, $dpi);
				}

			}
			$pdf->Output($pdf_path, 'F');

			$pdf_url = content_url( substr($pdf_path, strrpos($pdf_path, '/fancy_products_orders')) );

			header('Content-Type: application/json');
			echo json_encode( array('code' => 201, 'url' => $pdf_url) );

			die;

		}

		//load all images to an order based on order id and item id
		public function load_order_item_images() {

			if ( !isset($_POST['order_id']) || !isset($_POST['item_id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$order_id = trim($_POST['order_id']);
			$item_id = trim($_POST['item_id']);

			$pic_types = array("jpg", "jpeg", "png", "svg");

			header('Content-Type: application/json');

			//load shortcode order images
			if( empty($item_id) ) {
				$item_dir = FPD_ORDER_DIR . 'images/_shortcode/' . $order_id;
			}
			//load wc order images
			else {
				$item_dir = FPD_ORDER_DIR . 'images/' . $order_id . '/' . $item_id;
			}


			if( file_exists($item_dir) ) {

				$folder = opendir($item_dir);

				$images = array();
				$item_dir_url = substr($item_dir, strrpos($item_dir, '/fancy_products_orders/'));
				while ($file = readdir($folder) ) {
					if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types)) {
						$images[] = content_url( $item_dir_url ) . '/' . $file;
					}
				}
				closedir($folder);


				echo json_encode( array( 'code' => 200, 'images' =>  $images) );

			}
			else {
				echo json_encode( array( 'code' => 201) );
			}

			die;

		}

		//remove template
		public function remove_shortcode_order() {

			if ( !isset($_POST['id']) )
			    exit;

			check_ajax_referer( 'fpd_ajax_nonce', '_ajax_nonce' );

			$id = trim($_POST['id']);

			header('Content-Type: application/json');

			$result = FPD_Shortcode_Order::delete( $id );
			echo json_encode($result);

			die;

		}

		public function get_server_errors() {

			$e = error_get_last();
			if( $e & (E_ERROR | E_COMPILE_ERROR | E_CORE_ERROR) ) {
				header('Content-Type: application/json');
				echo json_encode($e);
			}

			die;

		}

		private function check_serialize_data_length($match) {
			return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
		}

	}
}

new FPD_Admin_Ajax();

?>