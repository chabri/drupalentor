<?php 

namespace Drupal\drupalentor;

class Control_Color {
	
	public function get_type() {
		return 'color';
	}

	public function content_template($data, $value = NULL, $type) {

		?>
		<div class="field field__text">
			<input type="text" name="<?php echo $type; ?>.settings.<?php echo $data['id'] ?>" id="<?php echo $data['id'] ?>" value="" title="<?php echo $data['title'] ?>" placeholder="<?php echo $data['placeholder'] ?? '' ?>" value="<?php echo $value; ?>"/>
		</div>
		<?php
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'color',
			'placeholder' => '',
			'title' => '',
		];
	}
}