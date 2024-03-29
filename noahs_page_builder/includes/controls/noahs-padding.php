<?php 

namespace Drupal\noahs_page_builder;


class Control_Noahs_Padding {
	
	public function get_type() {
		return 'noahs_padding';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>
		
			<div class="fs-6 fst-italic">Use your property as px, em, rem, %, ...</div>
			<ul class="field-element-list-horizontal">
			<li>
					<input type="text" name="<?php echo $name; ?>[padding_left]" data-style-css="padding-left" value="<?php echo !empty($value['padding_left']) ? $value['padding_left'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_padding_left">Left</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[padding_top]" data-style-css="padding-left" value="<?php echo !empty($value['padding_top']) ? $value['padding_top'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_padding_top">Top</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[padding_right]" data-style-css="padding-left" value="<?php echo !empty($value['padding_right']) ? $value['padding_right'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_padding_right">Right</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[padding_bottom]" data-style-css="padding-left" value="<?php echo !empty($value['padding_bottom']) ? $value['padding_bottom'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_padding_bottom">Bottom</label>
				</li>
			</ul>

		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_padding',
			'placeholder' => '',
			'title' => '',
		];
	}
}