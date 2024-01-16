<?php 

namespace Drupal\drupalentor;
use Drupal\drupalentor\Controls_Base;

class Control_Drupalentor_Border {
	
	public function get_type() {
		return 'drupalentor_border';
	}

	public function content_template($data, $name, $value) {
		$options = [
            '' => 'Por defecto',
            'none' => 'Ninguno',
            'solid' => 'Continuo',
            'double' => 'Doble',
            'dotted' => 'Punteado',
            'dashed' => 'Discontinuo',
            'groove' => 'Acanalado'
        ];

		?>
		<?php ob_start() ?>
		
			<div class="field__color mb-3">
				<label class="font-weight-bold"><?php echo t('Border Color'); ?></label>
				<input type="text" name="<?php echo $name; ?>[border_color]" id="drupalentor_border_color" class="form-control-color-alpha" value="<?php echo !empty($value['border_color']) ? $value['border_color'] : null; ?>"  field-settings>
				<div class="small">Use your property as px, em, rem, %, ...</div>
			</div>
			<div class="field__item mb-3">
				<label class="font-weight-bold"><?php echo t('Border Style'); ?></label>
				<select name="<?php echo $name; ?>[border_style]" class="form-select" field-settings>
					<?php foreach ($options as $k => $label) { ?>
						<option value="<?php echo $k; ?>"
						<?php echo !empty($value['border_style']) && $value['border_style'] === $k ? 'selected' : null; ?>><?php echo $label; ?></option>
					<?php } ?>
				</select>			
			</div>
			<ul class="field-element-list-horizontal">
			<li>
					<input type="text" name="<?php echo $name; ?>[border_left_width]" value="<?php echo !empty($value['border_left_width']) ? $value['border_left_width'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_border_left">Left</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[border_top_width]" value="<?php echo !empty($value['border_top_width']) ? $value['border_top_width'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_border_top">Top</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[border_right_width]" value="<?php echo !empty($value['border_right_width']) ? $value['border_right_width'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_border_right">Right</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[border_bottom_width]" value="<?php echo !empty($value['border_bottom_width']) ? $value['border_bottom_width'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_border_bottom">Bottom</label>
				</li>
			</ul>



		<?php return ob_get_clean();
	}


	protected function get_default_settings() {
		return [
			'input_type' => 'drupalentor_border',
			'placeholder' => '',
			'title' => '',
		];
	}
}