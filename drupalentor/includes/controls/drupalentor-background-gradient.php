<?php 

namespace Drupal\drupalentor;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class Control_Drupalentor_Background_Gradient{
	
	public function get_type() {
		return 'drupalentor_background_gradient';
	}

	public function content_template($data, $name, $value) {

		// $option = $data['value']['option'];
		$id = $data['wid'];

		$gradients_options = [
			'' => 'Select',
			'horizontal' => 'horizontal →',
			'vertical' => 'vertical ↓',
			'diagonal' => 'diagonal ↘',
			'diagonal-bottom' => 'diagonal ↗',
			'radial' => 'radial ○'
		];
		$value =  !empty($value['gradient']) ? $value['gradient'] : '';

		?>
		<?php ob_start() ?>
		
			<div class="field_group field_item mb-3">
				<label for="background_option_type">Background Gradient</label>
				<select class="orientation form-control" name="<?php echo $name; ?>[gradient][type]" id="background_option_gradient_type" field-settings>
					<?php foreach ($gradients_options as $k => $label) { ?>
						<option value="<?php echo $k; ?>" <?php echo !empty($value['type']) && $value['type'] === $k ? 'selected' : null; ?>><?php echo $label; ?></option>
					<?php } ?>
				</select>
			</div>

			<?php 


			
			?>

			<div class="field_group field_item field__color mb-3">
				<label for="background_option_gradient">Color primario</label>
				<input type="text" name="<?php echo $name; ?>[gradient][start][color]" id="background_option_gradient_start" class="form-control-color-alpha" value="<?php echo ($value['start']['color'] ?? ''); ?>" field-settings>
			</div>

			<div class="field_group field_item mb-3">
				<label for="background_option_start">Start location</label>
				<input type="number" name="<?php echo $name; ?>[gradient][start][location]" id="background_option_gradient_start_location" value="<?php echo $value['start']['location'] ?? ''; ?>" class="form-control" field-settings>
			</div>

			<div class="field_group field_item field__color mb-3">
				<label for="background_option_gradient">Color secundario</label>
				<input type="text" name="<?php echo $name; ?>[gradient][end][color]" id="background_option_gradient_end" class="form-control-color-alpha" value="<?php echo $value['end']['color'] ?? ''; ?>" field-settings>
			</div>

			<div class="field_group field_item mb-3">
				<label for="background_option_end">End location</label>
				<input type="number" name="<?php echo $name; ?>[gradient][end][location]" id="background_option_gradient_end_location" class="form-control" value="<?php echo $value['end']['location'] ?? ''; ?>" field-settings>
			</div>

		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'drupalentor_background_gradient',
			'placeholder' => '',
			'title' => '',
		];
	}
}