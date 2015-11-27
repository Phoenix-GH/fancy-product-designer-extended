<div class="fpd-modal-wrapper" id="fpd-modal-load-template">
	<div class="fpd-modal-dialog">
		<a href="#" class="fpd-close-modal">&times;</a>
		<h3><?php _e('Load a template', 'radykal'); ?></h3>
		<div class="fpd-modal-content">
			<?php

				$no_templates_info = '<p>'.__('No templates created. You can create a template via the action bar in a product list item.', 'radykal').'</p>';

				if( fpd_table_exists(FPD_TEMPLATES_TABLE) ) {
					$templates = $wpdb->get_results("SELECT * FROM ".FPD_TEMPLATES_TABLE." ORDER BY title ASC");

					if(sizeof($templates) == 0)
						echo $no_templates_info;

					echo '<ul>';
					foreach($templates as $template) {
						// double quotes required
						echo FPD_Admin_Manage_Fancy_Products::get_template_link_html($template->ID, $template->title);
					}
					echo '</ul>';

				}
				else {
					echo $no_templates_info;
				}


			?>
			</ul>
		</div>
	</div>
</div>