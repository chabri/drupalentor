<?php 

namespace Drupal\noahs_page_builder;

class Control_Noahs_Group_Checkbox {
	
	public function get_type() {
		return 'noahs_group_checkbox';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>
		
	
	
				<?php foreach($data['item']['options'] as $key => $option): ?>
				<div class="form-check form-switch">
					<input type="checkbox" id="option-<?php echo $key; ?>" name="<?php echo $name; ?>[<?php echo str_replace('-', '_', $key); ?>]" value="<?php echo $key; ?>" class="form-check-input" field-settings>
					<label for="option-<?php echo $key; ?>" class="form-check-labe"><?php echo $option; ?></label>
				</div>
				<?php endforeach; ?>
			

		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_group_checkbox',
			'placeholder' => '',
			'title' => '',
		];
	}
}