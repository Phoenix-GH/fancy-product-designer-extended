<div class="fpd-modal-wrapper" id="fpd-modal-load-demo">
	<div class="fpd-modal-dialog">
		<a href="#" class="fpd-close-modal">&times;</a>
		<h3><?php _e('Load an example demo', 'radykal'); ?></h3>
		<div class="fpd-modal-content">
			<ul>
			<?php

				//load demos in a list
				$demo_url = 'http://assets.fancyproductdesigner.com/fpd-demos.json';
				$json = fpd_admin_get_file_content($demo_url);
				$json = json_decode($json);

				foreach($json as $key => $value) {
					echo '<li><a href="'.$value.'" class="button-primary">'.__('Load', 'radykal').'</a>'.$key.'</li>';
				}

			?>
			</ul>
		</div>
	</div>
</div>