<?php 

namespace Drupal\drupalentor;
use Drupal\drupalentor\Controls_Base;

class Control_Drupalentor_Margin extends Controls_Base{
	
	public function get_type() {
		return 'drupalentor_margin';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>
		
			<div class="field_description">Use your property as px, em, rem, %, ...</div>
			<ul class="field-element-list-horizontal">
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_left]" value="<?php echo !empty($value['margin_left']) ? $value['margin_left'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_margin_left">Left</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_top]" value="<?php echo !empty($value['margin_top']) ? $value['margin_top'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_margin_top">Top</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_right]" value="<?php echo !empty($value['margin_right']) ? $value['margin_right'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_margin_right">Right</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_bottom]" value="<?php echo !empty($value['margin_bottom']) ? $value['margin_bottom'] : null; ?>" class="form-control" field-settings>
					<label for="drupalentor_margin_bottom">Bottom</label>
				</li>
			</ul>

		<?php return ob_get_clean();
	}
	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'drupalentor_margin',
			'placeholder' => '',
			'title' => '',
		];
	}
}