<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Noahs_Divider extends Controls_Base{
	
	public function get_type() {
		return 'nohas_divider';
	}

	public function content_template($data, $name, $value) {

		$options = [
			'' => 'None',
			'tilt' => 'Tilt',
			'waves' => 'Waves',
			'waves_2' => 'Waves 2',
			'waves_opaque' => 'Waves opaque',
			'triangles' => 'Triangles',
			'triangle' => 'Triangle',
			'triangle_invert' => 'Triangle Invert',
			'curve' => 'Curve',
			'slash' => 'Slash',
		];

		
	
		$optionsDirection = [
			'' => 'Normal',
			'reverse' => 'Reverse',
		];
		?>
		<?php ob_start() ?>
		
		<ul class="nav nav-tabs noahs_page_builder-tabs" id="nav-tab-maks" role="tablist">
			<li class="nav-item">
    			<button class="nav-link active" id="nav-divider-top-tab" data-bs-toggle="tab" data-bs-target="#nav-divider-top" type="button" role="tab" aria-controls="nav-divider-top" aria-selected="true">Top</button>
			</li>
			<li class="nav-item">
    			<button class="nav-link" id="nav-divider-bottom-tab" data-bs-toggle="tab" data-bs-target="#nav-divider-bottom" type="button" role="tab" aria-controls="nav-divider-bottom" aria-selected="false">bottom</button>
			</li>
		</ul>

		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-divider-top" role="tabpanel" aria-labelledby="nav-divider-top-tab">
				<?php $this->generateOptionBlock($name, 'top', $value['top'], $options, $optionsDirection); ?>
			</div>

			<div class="tab-pane fade" id="nav-divider-bottom" role="tabpanel" aria-labelledby="nav-divider-bottom-tab">
				<?php $this->generateOptionBlock($name, 'bottom', $value['bottom'], $options, $optionsDirection); ?>
			</div>
		</div>
		<?php return ob_get_clean();
	}

	private function generateOptionBlock($name, $type, $value, $options, $optionsDirection) {
	
		$currentDirection = !empty($value['direction']) ? $value['direction'] : '';
		$selected_value = !empty($value['type']) ? $value['type'] : '';

		?>
		<div class="mb-3 d-flex gap-3">
			<div class="field col">
				<label class="form-label">Type</label>
				<select
					name="<?php echo $name; ?>[<?php echo $type; ?>][type]"
					class="form-control form-select"
					field-settings="">
					<?php foreach ($options as $key => $label): ?>
						<option value="<?php echo $key; ?>" <?php echo ($key == $selected_value) ? 'selected' : ''; ?>>
							<?php echo $label; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="field__color col">
				<label for="noahs_page_builder_font_color" class="form-label">Color</label>
				<input type="text" name="<?php echo $name; ?>[<?php echo $type; ?>][color]" class="form-control-color" value="<?php echo !empty($value['color']) ? $value['color'] : null; ?>" field-settings>
			</div>
		</div>
	
		<div class="mb-3 d-flex gap-3">
			<div class="col">
				<input type="number" name="<?php echo $name; ?>[<?php echo $type; ?>][width]" min="100" value="<?php echo !empty($value['width']) ? $value['width'] : null; ?>" class="form-control" field-settings>
				<label for="noahs_page_builder_margin_left">Width</label>
			</div>
			<div class="col">
				<input type="number" name="<?php echo $name; ?>[<?php echo $type; ?>][height]" value="<?php echo !empty($value['height']) ? $value['height'] : null; ?>" class="form-control" field-settings>
				<label for="noahs_page_builder_margin_top">Height</label>
			</div>
		</div>
	
		<div class="mb-3 d-flex gap-3">
			<div class="field col">
				<label class="form-label">Direction</label>
				<select
					name="<?php echo $name; ?>[<?php echo $type; ?>][direction]"
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
		<?php
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