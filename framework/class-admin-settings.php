<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists('Radykal_Settings') ) {

	class Radykal_Settings {

		public $page_id = '';
		public $tabs = array();
		public $sections = array();
		public $settings = array();
		public $options = array();
		public $blocks = array();
		public $block_titles = array();
		public $block_descriptions = array();
		public $current_tab = '';

		public function __construct( $parameters ) {

			if( isset($parameters['page_id']) ) {
				$this->page_id = sanitize_key( $parameters['page_id'] );
			}

			/*
			* Structure: array(id=>title)
			*/
			if( isset($parameters['tabs']) ) {
				$this->tabs = $parameters['tabs'];
			}

			/*
			* Structure: array(id_of_tab=>title)
			*/
			if( isset($parameters['sections']) ) {
				$this->sections = $parameters['sections'];
			}

			$this->current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : key($this->tabs);

			foreach($this->tabs as $key => $value) {
				//first level: tabs
				$this->settings[$key] = array();
			}

			add_action( 'admin_init', array( &$this, 'init_admin' ) );

		}

		public function init_admin() {

			if ( isset($_POST['radykal_save_options_'.$this->page_id]) ) {

				check_admin_referer( $this->page_id.'_nonce' );
				$this->save_options();

			}
			else if( isset($_POST['radykal_reset_options_'.$this->page_id]) ) {

				check_admin_referer( $this->page_id.'_nonce' );
				$this->reset_options();

			}
		}

		/**
		 * Add blocks to a tab.
		 * Returns all available blocks.
		 */
		public function add_blocks( $blocks ) {

			$this->blocks = $blocks;

			foreach($this->blocks as $tab_block_key => $tab_block_value) {
				//second level: assign blocks to tabs
				$this->settings[$tab_block_key] = $tab_block_value;
				//store block titles
				foreach($this->blocks[$tab_block_key] as $block_key => $block_val) {
					$this->block_titles[$block_key] = $block_val;
				}
			}

			return $this->blocks;

		}

		/**
		 * Add description to blocks.
		 * Returns all available blocks.
		 */
		public function add_blocks_description( $descriptions = array() ) {

			$this->block_descriptions = $descriptions;
		}

		/**
		 * Add options to a block.
		 * Returns all available settings.
		 */
		public function add_block_options( $block_key, $options ) {

			foreach($this->settings as $tab_key => $tab_value) {

				if( isset($this->settings[$tab_key][$block_key]) ) {
					//add option to block
					$this->settings[$tab_key][$block_key] = $options;
				}
			}

			//create an array with keys=option.id
			$options_with_keys = array();
			foreach($options as $option) {
				$options_with_keys[$option['id']] = $option;
			}

			$this->options = array_merge($this->options, $options_with_keys);

			return $this->settings;

		}

		/**
		 * Outputs the full content of a tab.
		 *
		 */
		public function output() {

			$this->output_header();

			$current_tab_blocks = $this->settings[$this->current_tab];

			foreach( $current_tab_blocks as $key => $value ) {

				echo '<h3>'.$this->block_titles[$key].'</h3>';
				if( isset($this->block_descriptions[$key]) )
					echo '<p class="description radykal-block-description">'.$this->block_descriptions[$key].'</p>';
				echo '<table class="form-table" id="'.$key.'">';

				$block_options = $current_tab_blocks[$key];
				if( is_array($block_options) ) {

					foreach( $block_options as $block_option ) {

						self::output_item( $block_option);
					}

				}

				echo '</table>';

			}

			$this->output_footer();

		}

		/**
		 * Outputs the header for the options
		 *
		 */
		public function output_header() {

			do_action( 'radykal_settings_header_start', $this->page_id );

			echo '<form method="post" id="radykal-options-form-'.$this->page_id.'" name="radykal_options_form_'.$this->page_id.'" class="radykal-settings-form">';

			wp_nonce_field( $this->page_id.'_nonce' );

			//no tabs
			if( sizeof($this->tabs) == 1 ) {
				$keys = array_keys($this->tabs);
				echo '<h2>'.$this->tabs[$keys[0]];
			}
			//tabs navigation
			else {

				echo '<h2 class="nav-tab-wrapper">';
				foreach($this->tabs as $key => $value) {
					$class = ( $key == $this->current_tab ) ? ' nav-tab-active' : '';
					echo '<a href="?page='.$this->page_id.'&tab='. sanitize_key( $key ).'" class="nav-tab '.esc_attr( $class ).'" id="radykal-nav-tab--'.sanitize_key( $key ).'">'.$value.'</a>';
				}

			}

			echo '</h2><br class="clear"/>';

			if( isset($_POST['radykal_save_options_'.$this->page_id]) || isset($_POST['radykal_reset_options_'.$this->page_id]) ) {

				$text = isset($_POST['radykal_save_options_'.$this->page_id]) ? __('Settings saved.', 'radykal') : __('Settings reseted.', 'radykal');
				echo '<div class="updated"><p><strong>'.$text.'</strong></p></div>';
			}

			do_action( 'radykal_settings_header_end', $this->page_id );

		}

		/**
		 * Outputs the header for the options
		 *
		 */
		public function output_footer() {

			do_action( 'radykal_settings_footer_start', $this->page_id );

			?>
				<br class="clear" />
				<p>
					<button type="submit" class="button-primary" name="radykal_save_options_<?php echo $this->page_id; ?>"><?php _e('Save Options', 'radykal'); ?></button>
					<button type="submit" class="button-secondary" name="radykal_reset_options_<?php echo $this->page_id; ?>" ><?php _e('Reset', 'radykal'); ?></button>
				</p>
			</form>
			<?php

			do_action( 'radykal_settings_footer_end', $this->page_id );

		}

		/**
		 * Returns the options by a tab.
		 *
		 */
		public function get_options_by_tab( $tab_id ) {

			if( isset($this->settings[$tab_id]) ) {

				$options_in_tab = array();
				$blocks = $this->settings[$tab_id];

				foreach( $blocks as $block ) {

					if( is_array($block) ) {
						foreach($block as $option) {
							$options_in_tab[$option['id']] = $option['default'];
						}
					}

				}

				return $options_in_tab;

			}
			else {
				return false;
			}

		}

		/**
		 * Get an option value. If no value is found in database, return default value
		 *
		 */
		public function get_option( $key ) {

			if( get_option($key) === false ) {
				return $this->get_default_option( $key );

			}
			else {

				$value = get_option( $key );
				//if option is type of number, it needs to return a value, otherwise its failed
				if( !$this->not_empty($value) && $this->get_option_type($key) == 'number') {
					return $this->get_default_option( $key );
				}
				//if is array, convert it into string
				else if( is_array($value) ||  $this->get_option_type($key) == 'multiselect') {
					return empty($value) || $value == 'no' || !is_array($value) ? "" : '"' . implode('","', $value) . '"';
				}

				return $this->boolean_string_to_int( $value );

			}

		}

		/**
		 * Get the default value of an option
		 *
		 */
		public function get_default_option( $key ) {

			if( isset( $this->options[$key] ) ) {
				return $this->boolean_string_to_int($this->options[$key]['default']);
			}
			return false;

		}

		/**
		 * Get the type of an option
		 *
		 */
		public function get_option_type( $key ) {

			if( isset( $this->options[$key] ) ) {
				 return $this->boolean_string_to_int($this->options[$key]['type']);
			}
			return false;

		}

		/**
		 * Outputs an option item for a options table
		 *
		 */
		public static function output_item( $parameters ) {

			$id = isset($parameters['id']) ? $parameters['id'] : '';
			$title = isset($parameters['title']) ? $parameters['title'] : '';
			$type = isset($parameters['type']) ? $parameters['type'] : '';
			$description = isset($parameters['description']) ? $parameters['description'] : false;
			$default = isset($parameters['default']) ? $parameters['default'] : '';
			$css = isset($parameters['css']) ? $parameters['css'] : '';
			$class = isset($parameters['class']) ? $parameters['class'] : '';
			$value = get_option($id) !== false ? get_option($id) : '';
			$options = isset($parameters['options']) ? $parameters['options'] : array();
			$custom_attributes = isset($parameters['custom_attributes']) ? $parameters['custom_attributes'] : array();
			$relations = isset($parameters['relations']) ? $parameters['relations'] : array();

			$input_html = '';
			$input_class = '';
			$new_line_desc = '<br />';
			$current_value = empty($value) && $value != '0' ? $default : $value;

			$custom_attributes_html = '';
			foreach( $custom_attributes as $ca_key => $ca_value ) {
				$custom_attributes_html .= $ca_key.'="'.esc_attr( $ca_value ).'"';
			}

			//text,number, checkbox
			if( $type == 'text' || $type == 'number' || $type == 'checkbox' || $type == 'colorpicker' ) {

				$additional_attrs = '';
				$placeholder = '';
				$relation_attr = '';
				$current_value = stripslashes($current_value);

				if($type == 'checkbox') {
					$additional_attrs .= $current_value === 'yes' ? 'checked="checked"' : '';
					$current_value = 'yes';
					$new_line_desc = '';
					if( !empty($relations) )
						$relation_attr = 'data-relation="'.http_build_query($relations).'"';
				}
				else {
					$placeholder = 'placeholder="'.esc_attr( $default ).'"';
				}

				if( $type == 'colorpicker' ) {
					$type = 'text';
					$input_class = 'radykal-color-picker';
				}

				$input_html = '<input type="'.esc_attr( $type ).'" id="'.esc_attr( $id ).'" name="'.esc_attr( $id ).'" '.$placeholder.' value="'.esc_attr($current_value).'" '.$additional_attrs.' style="'.$css.'" '.$custom_attributes_html.' class="'.esc_attr( $input_class ).'" '.$relation_attr.' />'.$new_line_desc;

			}
			//textarea
			else if($type == 'textarea') {

				$input_html = '<textarea id="'.esc_attr( $id ).'" name="'.esc_attr( $id ).'" class="'.esc_attr( $class ).'" style="'.esc_attr( $css ).'">'.esc_textarea( $current_value ).'</textarea>'.$new_line_desc;

			}
			//select
			else if($type == 'select' || $type == 'multiselect') {

				$multiple = $type == 'multiselect' ? 'multiple' : '';
				$brackets = $type == 'multiselect' ? '[]' : '';

				$input_html = '<select id="'.esc_attr( $id ).'" name="'.esc_attr( $id.$brackets ).'" style="'.esc_attr( $css ).'" class="'.esc_attr( $class ).'" '.$multiple.'>';
				foreach($options as $option_key => $option_val) {

					//multiselect
					if( is_array($current_value) ) {
						$selected = selected(in_array($option_key, $current_value), true, false);
					}
					//simple select
					else {
						$selected = selected($current_value, $option_key, false);
					}

					$input_html .= '<option value="'.esc_attr( $option_key ).'" '.$selected.'>'.$option_val.'</option>';
				}
				$input_html .= '</select>'.$new_line_desc;

			}
			//radio
			else if( $type == 'radio' ) {

				$input_html .= '<div style="margin-bottom: 10px;">';
				foreach($options as $option_key => $option_val) {

					$relation_attr = '';
					if( isset($relations[$option_key]) )
						$relation_attr = is_array($relations[$option_key]) ? 'data-relation="'.http_build_query($relations[$option_key]).'"' : '';

					$input_html .= '<p><label><input type="radio" '.$relation_attr.' name="'.esc_attr( $id ).'" value="'.esc_attr( $option_key ).'" '.checked($current_value, $option_key, false).' />'.$option_val.'</label></p>';
				}
				$input_html .= '</div>';

			}

			//ace editor
			else if( $type == 'ace-editor' ) {

				$input_html = '<div id="'.esc_attr( $id ).'" style="'.esc_attr( $css ).'" class="radykal-ace-editor '.esc_attr( $class ).'">'.stripslashes($current_value).'</div><textarea class="radykal-hidden" name="'.esc_attr( $id ).'">'.stripslashes($current_value).'</textarea>';

			}
			else if( $type == 'values-group' ) {

				$prefixes = isset($parameters['prefixes']) ? $parameters['prefixes'] : array();
				$regexs = isset($parameters['regexs']) ? $parameters['regexs'] : array();

				$head_th = '';
				$head_td = '';
				$prefixes_html = '';
				$add_btn = '';
				$regex_html = '';
				foreach( $options as $key => $value ) {

					$head_th .= '<th>'.$value.'</th>';

					if( isset($prefixes[$key]) )
						$prefixes_html = '<span class="radykal-values-group-prefix">'.$prefixes[$key].'</span>';

					if( isset($regexs[$key]) )
						$regex_html = 'data-regex="'.esc_attr( $regexs[$key] ).'"';

					$head_td .= '<td>'.$prefixes_html.'<input type="text" id="radykal-values-group-input--'.esc_attr( $key ).'" '.$regex_html.' /></td>';
				}

				$head_th .= '<th></th>';
				$head_td .= '<td><a href="#" class="radykal-values-group-add button-secondary" id="radykal-values-group-add--'.$id.'">'.__('Add', 'radykal').'</a></td>';

				$input_html = '<div id="'.esc_attr( $id ).'" style="'.esc_attr( $css ).'" class="radykal-values-group '.esc_attr( $class ).'"><table><thead><tr>'.$head_th.'</tr><tr>'.$head_td.'</tr></thead><tbody></tbody></table></div><input class="radykal-option-value radykal-hidden" name="'.esc_attr( $id ).'" value="'.esc_attr( $current_value ).'" />';

			}
			//multivalues
			else if( $type == 'multivalues' ) {

				$input_html = '<div id="'.esc_attr( $id ).'" style="'.esc_attr( $css ).'" class="radykal-multi-values '.esc_attr( $class ).'"><input type="hidden" name="'.esc_attr( $id ).'" value="'.esc_attr( $current_value ).'" />';

				foreach( $options as $key => $value ) {

					$input_id = sanitize_key($key);
					$value = $value;
					$input_html .= '<label for="'.$input_id.'">'.esc_attr( $key ).': <input type="number" name="'.$input_id.'" value="'.esc_attr( $value ).'" placeholder="'.esc_attr( $value ).'" '.$custom_attributes_html.' /></label>';

				}

				$input_html .= '</div>';

			}

			$description_html = '';
			if( $description !== false ) {
				$description_html = '<label for="'.$id.'"><span class="description">'.wp_kses_post( $description ).'</span></label>';
			}

			?>
			<tr>
				<th scope="row" <?php echo $type === 'section_title' ? 'colspan="2" class="radykal-section-title"' : ''; ?>>
					<?php echo $title; ?>
				</th>
				<?php if( $type !== 'section_title' ): ?>
				<td class="radykal-option-type--<?php echo $type; ?>">
					<?php if( $type == 'ace-editor' ) echo $description_html;  ?>
					<?php echo $input_html; ?>
					<?php if( $type != 'ace-editor' ) echo $description_html;  ?>
				</td>
				<?php endif; ?>
			</tr>
			<?php

		}

		private function save_options() {

			//get options by tab
			$options_in_tab = $this->get_options_by_tab($this->current_tab);


			foreach( $options_in_tab as $key => $value ) {

				$post_val = '';

				//if not exists, it must be a checkbox
				if( !isset($_POST[$key]) && $this->get_option_type($key) == 'checkbox' ) {
					$post_val = 'no';
				}
				else if($this->get_option_type($key) == 'text') {
					$post_val = $_POST[$key];
				}
				else if($this->get_option_type($key) == 'multiselect') {
					if( isset($_POST[$key]) )
						$post_val = $_POST[$key];
				}
				else {
					$post_val = $_POST[$key];
				}

				update_option($key, $post_val);

			}

			do_action( 'radykal_save_options', $this->current_tab );

		}

		private function reset_options() {

			//get options by tab
			$options_in_tab = $this->get_options_by_tab($this->current_tab);

			foreach( $options_in_tab as $key => $value ) {

				update_option($key, $value);

			}

			do_action( 'radykal_reset_options', $this->current_tab );

		}

		private function boolean_string_to_int($value) {

			if($value === 'yes') { return 1; }
			else if($value === 'no') { return 0; }
			else { return $value; }

		}

		private function not_empty($value) {

			return $value == '0' || !empty($value);

		}
	}
}

?>