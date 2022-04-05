<?php 

namespace Drupal\drupalentor;

class Control_Text {
	
	public function get_type() {
		return 'text';
	}

	public function content_template($data, $value = NULL, $type, $key) {

		?>
		<div class="field field__text">
			<input type="text" name="<?php echo $type; ?>[settings][<?php echo $data['id'] ?>]" id="<?php echo $data['id'] ?>" title="<?php echo $data['title'] ?>" placeholder="<?php echo $data['placeholder'] ?? '' ?>" value="<?php echo $value; ?>"/>
		</div>
		<?php
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'text',
			'placeholder' => '',
			'title' => '',
		];
	}
}