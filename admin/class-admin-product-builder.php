<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Admin_Product_Builder') ) {

	class FPD_Admin_Product_Builder {

		public function output() {

			?>
			<div class="wrap" id="fpd-product-builder">

				<h2 class="fpd-clearfix">
					<?php _e('Fancy Product Builder', 'radykal'); ?>
					<?php fpd_admin_display_version_info(); ?>
				</h2>
				<?php

				global $wpdb, $woocommerce;

				$request_view_id = isset($_GET['view_id']) ? $_GET['view_id'] : NULL;

				//get all fancy products
				$fancy_products = array();
				if( fpd_table_exists(FPD_PRODUCTS_TABLE) ) {
					$fancy_products = $wpdb->get_results("SELECT * FROM ".FPD_PRODUCTS_TABLE." ORDER BY title ASC");
				}

				if(sizeof($fancy_products) == 0) {
					echo '<div class="updated"><p><strong>'.__('There are no fancy products!', 'radykal').'</strong></p></div></div>';
					exit;
				}

				//save elements of view
				if(isset($_POST['save_elements'])) {

					check_admin_referer( 'fpd_save_elements' );

					$request_view_id = $_POST['view_id'];

					$elements = array();
					for($i=0; $i < sizeof($_POST['element_types']); $i++) {

						$element = array();

						$element['type'] = $_POST['element_types'][$i];
						$element['title'] = $_POST['element_titles'][$i];
						$element['source'] = $_POST['element_sources'][$i];

						$parameters = array();
						parse_str($_POST['element_parameters'][$i], $parameters);

						if(is_array($parameters)) {
							foreach($parameters as $key => $value) {
								if($value == '') {
									$parameters[$key] = NULL;
								}
								else {
									$parameters[$key] = preg_replace('/\s+/', '', $value);
								}
							}
						}

						$element['parameters'] = $parameters;

						array_push($elements, $element);

					}

					$fancy_view = new Fancy_View($request_view_id);
					$fancy_view->update( array('elements' => serialize($elements)) );

					$requested_view_elements = $elements;

					echo '<div class="updated"><p><strong>'.__('Elements saved.', 'radykal').'</strong></p></div>';

				}

				?>
				<br class="clear" />
				<p class="description"><?php _e( 'Select the view of your Fancy Product:', 'radykal' ); ?></p>
				<select id="fpd-view-switcher" class="radykal-select2" style="width: 38%;">
					<?php


					if(is_array($fancy_products)) {
						foreach($fancy_products as $fancy_product) {

							$fancy_product_id = $fancy_product->ID;
							echo '<optgroup label="'.$fancy_product->title.'" id="'.$fancy_product_id.'">';
							$fancy_product = new Fancy_Product($fancy_product_id);
							$views = $fancy_product->get_views();

							if(is_array($views)) {

								for($i=0; $i < sizeof($views); ++$i) {

									$view = $views[$i];

									//get first view
									if($request_view_id == NULL) {
										$request_view_id = $view->ID;
									}
									//get requested view
									if($request_view_id == $view->ID && !isset($requested_view_elements) ) {
										$requested_view_elements = unserialize($view->elements);
									}
									echo '<option value="'.$view->ID.'" '.selected( $request_view_id ,  $view->ID, false).'>'.$view->title.'</option>';
								}

							}
							echo '</optgroup>';

						}
					}

					?>
				</select>
				<?php

				//create instance of selected fancy view
				$fancy_view = new Fancy_View( $request_view_id );
				$product_id = $fancy_view->get_product_id();

				//get stage dimensions
				$fancy_product = new Fancy_Product($product_id);
				$stage_width = $fancy_product->get_option('stage_width');
				$stage_height = $fancy_product->get_option('stage_height');

				?>
				<a href="#" id="fpd-save-layers" class="button-primary fpd-right"><?php _e( 'Save Layers', 'radykal' ); ?></a>
				<div id="fpd-layers-container" class="fpd-clearfix">

					<!-- Manage elements -->
					<div id="fpd-manage-elements" class="fpd-panel">
						<form method="post" id="fpd-submit">
							<input type="submit" class="fpd-hidden" name="save_elements" />
							<?php wp_nonce_field( 'fpd_save_elements' ); ?>
							<h3 class="fpd-clearfix">
								<span><?php _e( 'Layers', 'radykal' ); ?></span>

							</h3>
							<div id="fpd-add-element">
								<a href="#" class="add-new-h2" id="fpd-add-image-element"><?php _e( 'Add Image', 'radykal' ); ?></a>
								<a href="#" class="add-new-h2" id="fpd-add-text-element"><?php _e( 'Add Text', 'radykal' ); ?></a>
								<a href="#" class="add-new-h2" id="fpd-add-curved-text-element"><?php _e( 'Add Curved Text', 'radykal' ); ?></a>
								<a href="#" class="add-new-h2" id="fpd-add-upload-zone"><?php _e( 'Add Upload Zone', 'radykal' ); ?></a>
							</div>

							<input type="hidden" value="<?php echo $request_view_id; ?>" name="view_id" />
							<p class="description"><?php _e( 'Change the layer order by dragging elements up or down.', 'radykal' ); ?></p>
							<ul id="fpd-elements-list">
								<?php

								$index = 0;
								if(is_array($requested_view_elements)) {

									foreach($requested_view_elements as $view_element) {

										echo self::get_element_list_item(
											$index,
											$view_element['title'],
											$view_element['type'],
											stripslashes($view_element['source']),
											http_build_query($view_element['parameters'])
										);
										$index++;

									}

								}

								?>
							</ul>

						</form>

					</div>

					<!-- Edit Parameters -->
					<div id="fpd-edit-parameters" class="fpd-panel">

						<h3><?php _e( 'Layer Options', 'radykal' ); ?>: <span id="fpd-edit-parameters-for"></span></h3>
						<?php require_once(FPD_PLUGIN_ADMIN_DIR.'/views/html-product-builder-parameters-form.php'); ?>

					</div>

				</div><!-- Manage Layers Box -->


				<!-- Product Stage -->
				<div id="fpd-product-stage" class="fpd-panel">
					<h3 class="fpd-clearfix"><?php _e('Product Stage', 'radykal'); ?>
						<span class="description"><?php echo $stage_width; ?>px * <?php echo $stage_height; ?>px</span>
					</h3>
					<div id="fpd-element-toolbar">
						<a href="#" class="button button-secondary fpd-center-horizontal"><?php _e( 'Center Horizontal', 'radykal' ); ?></a>
						<a href="#" class="button button-secondary fpd-center-vertical"><?php _e( 'Center Vertical', 'radykal' ); ?></a>
						<a href="#" class="button button-secondary fpd-dupliacte-layer"><?php _e( 'Duplicate Layer', 'radykal' ); ?></a>
					</div>
					<div id="fpd-fabric-stage-wrapper">
						<canvas id="fpd-fabric-stage" width="<?php echo $stage_width; ?>" height="<?php echo $stage_height; ?>"></canvas>
					</div>
				</div>
			</div>
			<?php

		}

		public static function get_element_list_item( $index, $title, $type, $source, $parameters ) {

			$change_image_icon = $type == 'image' ? '<a href="#" class="fpd-change-image fpd-admin-tooltip" title="'.__( 'Change Image Source', 'radykal' ).'"><i class="fpd-admin-icon-repeat"></i></a>' : '';
			$element_identifier = $type == 'image' ? '<img src="'.$source.'" />' : '<i class="fpd-admin-icon-text-format"></i>';
			$lock_icon = 'fpd-admin-icon-lock-open';
			if(strpos($parameters,'locked=1') !== false) {
				$lock_icon = 'fpd-admin-icon-lock';
			}

			return '<li id="'.$index.'" class="fpd-clearfix"><div><span class="fpd-element-identifier">'.$element_identifier.'</span><input type="text" name="element_titles[]" value="'.($type == 'image' ? $title : $source).'" /></div><div>'. $change_image_icon.'<a href="#" class="fpd-lock-element"><i class="'.$lock_icon.'"></i></a><a href="#" class="fpd-trash-element"><i class="fpd-admin-icon-close"></i></a></div><textarea name="element_sources[]">'.$source.'</textarea><input type="hidden" name="element_types[]" value="'.$type.'"/><input type="hidden" name="element_parameters[]" value="'.$parameters.'"/></li>';

		}
	}
}

return new FPD_Admin_Product_Builder();

?>