<?php 

namespace Drupal\drupalentor;
use Drupal\drupalentor\Fonts;
use Drupal\drupalentor\Controls_Base;

class Control_Drupalentor_Font extends Controls_Base{
	
	public function get_type() {
		return 'drupalentor_font';
	}

	public function content_template($data, $name, $value) {


		$id = $data['wid'];
		$text_transform_options = [
			'' => 'Default',
			'uppercase' => 'Uppercase',
			'lowercase' => 'Lowecase',
			'capitalize' => 'Capitalize',
			'none' => 'Normal',
		];
		
		// Array para las opciones de estilo de fuente.
		$font_style_options = [
			'' => 'Default',
			'normal' => 'Normal',
			'italic' => 'Italic',
			'oblique' => 'Oblique',
		];
		
		// Array para las opciones de decoración de texto.
		$text_decoration_options = [
			'' => 'Default',
			'underline' => 'Underline',
			'overline' => 'Overline',
			'line-through' => 'Line Through',
			'none' => 'None',
		];
		?>
		<?php ob_start() ?>
		
	
			<div class="field_group field_item">
				<label for="drupalentor_font">Select font</label>
				<select name="<?php echo $name; ?>[font_family]"  class="form-select" field-settings>
					<?php foreach(Fonts::getFonts() as $font){ ?>
						<option value="<?php echo $font;?>" <?php echo !empty($value['font_family']) && $value['font_family'] === $font ? 'selected' : null; ?>><?php echo $font;?></option>
					<?php } ?>
				</select>
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Font Wiehgt</label>
				<select name="<?php echo $name; ?>[font_weight]" class="form-select" field-settings>
					<?php foreach(Fonts::getFontsWeights() as $font){ ?>
						<option value="<?php echo $font;?>" <?php echo !empty($value['font_weight']) && $value['font_weight'] === $font ? 'selected' : null; ?>><?php echo $font;?></option>
					<?php } ?>
				</select>
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Font Size</label>
				<input type="text" name="<?php echo $name; ?>[font_size]"  value="<?php echo !empty($value['font_size']) ? $value['font_size'] : null; ?>" placeholder="16px" class="form-control" field-settings>
	
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Transform</label>
				<select name="<?php echo $name; ?>[text_transform]" class="form-select" field-settings>
					<?php foreach ($text_transform_options as $k => $label) { ?>
						<option value="<?php echo $k; ?>" <?php echo !empty($value['text_transform']) && $value['text_transform'] === $k ? 'selected' : null; ?>><?php echo $label; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Style</label>
				<select name="<?php echo $name; ?>[font_style]" class="form-select" field-settings>
					<?php foreach ($font_style_options as $k => $label) { ?>
						<option value="<?php echo $k; ?>"
						<?php echo !empty($value['font_style']) && $value['font_style'] === $k ? 'selected' : null; ?>><?php echo $label; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Decoration</label>
				<select name="<?php echo $name; ?>[text_decoration]" class="form-select" field-settings>
					<?php foreach ($text_decoration_options as $k => $label) { ?>
						<option value="<?php echo $k; ?>"
						<?php echo !empty($value['text_decoration']) && $value['text_decoration'] === $k ? 'selected' : null; ?>><?php echo $label; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Line height</label>
				<input type="text" name="<?php echo $name; ?>[line_height]" class="form-control" value="<?php echo !empty($value['line_height']) ? $value['line_height']: null; ?>" field-settings>
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Letter Space</label>
				<input type="text" name="<?php echo $name; ?>[letter_spacing]" class="form-control" value="<?php echo !empty($value['letter_spacing']) ? $value['letter_spacing']: null; ?>" field-settings>
			</div>
			<div class="field_group field_item">
				<label for="drupalentor_font">Word Space</label>
				<input type="text" name="<?php echo $name; ?>[word_spacing]" class="form-control" value="<?php echo !empty($value['word_spacing']) ? $value['word_spacing']: null; ?>" field-settings>
			</div>
			<div class="field_element field__color">
				<label for="drupalentor_font_color">Color</label>
				<input type="text" name="<?php echo $name; ?>[color]" class="form-control-color" value="<?php echo !empty($value['color']) ? $value['color'] : null; ?>" field-settings>
			</div>

		<?php return ob_get_clean();
	}
	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'drupalentor_font',
			'placeholder' => '',
			'title' => '',
		];
	}
}