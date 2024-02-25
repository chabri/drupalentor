<?php 

namespace Drupal\noahs_page_builder;


class Control_Noahs_Radius {
	
	public function get_type() {
		return 'noahs_radius';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>

			<ul class="field-element-list-horizontal mb-3">
			<li>
					<input type="text" name="<?php echo $name; ?>[border_top_left_radius]" value="<?php echo !empty($value['border_top_left_radius']) ? $value['border_top_left_radius'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_border-top-left-radius">Top</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[border_top_right_radius]" value="<?php echo !empty($value['border_top_right_radius']) ? $value['border_top_right_radius'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_border_top_right_radius">Right</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[border_bottom_right_radius]" value="<?php echo !empty($value['border_bottom_right_radius']) ? $value['border_bottom_right_radius'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_shadow_border_bottom_right_radius">Bottom</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[border_bottom_left_radius]" value="<?php echo !empty($value['border_bottom_left_radius']) ? $value['border_bottom_left_radius'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_shadow_border_bottom_left_radius">Left</label>
				</li>
			</ul>

		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_radius',
			'placeholder' => '',
			'title' => '',
		];
	}
}