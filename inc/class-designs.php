<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Designs') ) {

	class FPD_Designs {

		public $category_ids;
		public $default_image_options;

		public function __construct( $category_ids, $default_image_options ) {

			$this->category_ids = $category_ids;
			$this->default_image_options = $default_image_options;

		}

		public function output() {
			?>
			<div class="fpd-design">
				<?php

				//get all category terms
				$category_terms = get_terms( 'fpd_design_category', array(
					'hide_empty' => false,
					'include'	=> $this->category_ids
				));

				//general parameters
				$general_parameters_array = $this->default_image_options;
				$final_parameters ;

				//loop through all categories

				if(is_array($category_terms) ) {
					foreach($category_terms as $category_term) {

						//get attachments from fancy design category
						$args = array(
							 'posts_per_page' => -1,
							 'post_type' => 'attachment',
							 'orderby' => 'menu_order',
							 'order' => 'ASC',
							 'fpd_design_category' => $category_term->slug
						);
						$designs = get_posts( $args );

						//category parameters
						$category_parameters_array = array();
						$category_parameters = get_option( 'fpd_category_parameters_'.$category_term->slug );
						if(strpos($category_parameters,'enabled') !== false) {
							//convert string to array
							parse_str($category_parameters, $category_parameters_array);
						}

						if( !empty($designs) ) :
						?>
						<div class="fpd-category" title="<?php echo $category_term->name; ?>">
							<?php

							if(is_array($designs)) {
								foreach( $designs as $design ) {

									//merge general parameters with category parameters
									$final_parameters = array_merge($general_parameters_array, $category_parameters_array);

									//single element parameters
									$single_design_parameters = get_post_meta($design->ID, 'fpd_parameters', true);
									if (strpos($single_design_parameters,'enabled') !== false) {
										$single_design_parameters_array = array();
										parse_str($single_design_parameters, $single_design_parameters_array);
										$final_parameters = array_merge($final_parameters, $single_design_parameters_array);
									}

									//convert array to string
									$design_parameters_str = FPD_Parameters::convert_parameters_to_string($final_parameters);

									//get design thumbnail
									$design_thumbnail = get_post_meta($design->ID, 'fpd_thumbnail', true); //custom thumbnail
									if( empty($design_thumbnail) ) {
										$design_thumbnail = wp_get_attachment_image_src( $design->ID, 'medium' );
										$design_thumbnail = $design_thumbnail[0] ? $design_thumbnail[0] : $design->guid;
									}

									$origin_image = wp_get_attachment_image_src( $design->ID, 'full' );
									$origin_image = $origin_image[0] ? $origin_image[0] : $design->guid;

									if( isset($origin_image) ) {
										echo "<img data-src='$origin_image' title='{$design->post_title}' data-parameters='$design_parameters_str' data-thumbnail='$design_thumbnail' />";
									}

								}
							}

							?>
						</div>
						<?php
						endif;
					}
				}
				?>
			</div>
			<?php
		}

	}

}