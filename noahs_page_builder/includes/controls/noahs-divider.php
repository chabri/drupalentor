<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Noahs_Divider extends Controls_Base{
	
	public function get_type() {
		return 'nohas_divider';
	}

	public function content_template($data, $name, $value) {

		$selected_value = !empty($value['type']) ? $value['type'] : '';
		$options = [
			'' => 'None',
			'tilt' => 'Tilt',
			'waves' => 'Waves',
			'waves_opaque' => 'Waves opaque',
			'triangles' => 'Triangles',
		];

		$currentPosition = !empty($value['position']) ? $value['position'] : '';
		$optionsPosition = [
			'' => 'Top',
			'bottom' => 'Bottom',
		];
		
		$currentDirection = !empty($value['direction']) ? $value['direction'] : '';
		$optionsDirection = [
			'' => 'Normal',
			'reverse' => 'Reverse',
		];
		?>
		<?php ob_start() ?>
		

			<div class="mb-3 d-flex gap-3">
				<div class="field col">
					<label class="form-label">Type</label>
					<select
						name="<?php echo $name; ?>[type]"
						class="form-control form-select"
						field-settings="">

						<?php foreach ($options as $key => $label){ ?>
							<option value="<?php echo $key; ?>" <?php echo ($key == $selected_value) ? 'selected' : ''; ?>>
								<?php echo $label; ?>
							</option>
						<?php }; ?>

					</select>	
				</div>	
				<div class="field__color col">
					<label for="noahs_page_builder_font_color" class="form-label">Color</label>
					<input type="text" name="<?php echo $name; ?>[color]" class="form-control-color" value="<?php echo !empty($value['color']) ? $value['color'] : null; ?>" field-settings>
				</div>
			</div>

			<div class="mb-3 d-flex gap-3">
				<div class="col">
					<input type="number" name="<?php echo $name; ?>[width]" min="100" value="<?php echo !empty($value['width']) ? $value['width'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_margin_left">Width</label>
				</div>
				<div class="col">
					<input type="number" name="<?php echo $name; ?>[height]" value="<?php echo !empty($value['height']) ? $value['height'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_margin_top">Height</label>
				</div>
			</div>
			<div class="mb-3 d-flex gap-3">
			<div class="field col">
				<label class="form-label">Position</label>
				<select
					name="<?php echo $name; ?>[position]"
					class="form-control form-select"
					field-settings="">

					<?php foreach ($optionsPosition as $key => $label): ?>
						<option value="<?php echo $key; ?>" <?php echo ($key == $currentPosition) ? 'selected' : ''; ?>>
							<?php echo $label; ?>
						</option>
					<?php endforeach; ?>

				</select>
			</div>

			<div class="field col">
				<label class="form-label">Direction</label>
				<select
					name="<?php echo $name; ?>[direction]"
					class="form-control form-select"
					field-settings="">

					<?php foreach ($optionsDirection as $key => $label): ?>
						<option value="<?php echo $key; ?>" <?php echo ($key == $currentDirection) ? 'selected' : ''; ?>>
							<?php echo $label; ?>
						</option>
					<?php endforeach; ?>

				</select>
			</div>

			</div>

		<?php return ob_get_clean();
	}
	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'nohas_divider',
			'placeholder' => '',
			'title' => '',
		];
	}
}