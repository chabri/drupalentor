<?php 

namespace Drupal\noahs_page_builder;


class Control_Noahs_Shadows {
	
	public function get_type() {
		return 'noahs_shadows';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>
		
			<ul class="field-element-list-horizontal mb-3">
			<li>
					<input type="text" name="<?php echo $name; ?>[shadow_x]" value="<?php echo !empty($value['shadow_x']) ? $value['shadow_x'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_shadow_x">Horizontal</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[shadow_y]" value="<?php echo !empty($value['shadow_y']) ? $value['shadow_y'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_shadow_y">Vertical</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[blur]" value="<?php echo !empty($value['blur']) ? $value['blur'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_shadow_blur">Blur</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[spread]" value="<?php echo !empty($value['spread']) ? $value['spread'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_shadow_spread">Spread</label>
				</li>
			</ul>
			<div class="field__color mb-3">
				<label for="noahs_page_builder_shadow_color" class="form-label">Color</label>
				<input type="text" name="<?php echo $name; ?>[color]" class="form-control-color-alpha" value="<?php echo !empty($value['color']) ? $value['color'] : null; ?>" field-settings>
			</div>
		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_shadows',
			'placeholder' => '',
			'title' => '',
		];
	}
}