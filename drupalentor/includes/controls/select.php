<?php 
namespace Drupal\drupalentor;



class Control_Select {

	public function get_type() {
		return 'select';
	}

	public function content_template($data, $value = NULL, $type, $key) {
		?>
			<div class="field field__select">
				
				<select name="<?php echo $type; ?>[settings][<?php echo $data['id'] ?>]">
					<?php foreach($data['options'] as $key => $option): ?>
						<option <?php if($value == $key){ echo 'selected="selected';} ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'select',
			'title' => '',
		];
	}
}