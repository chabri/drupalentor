<?php 

namespace Drupal\noahs_page_builder;

class Control_Noahs_Group_Radio{
	
	public function get_type() {
		return 'noahs_group_radio';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>
		
	
	
		
		<div class="noahs_page_builder_field field__Noahs_group_radiobox">
			<h5><?php echo $data['title']; ?></h5>
			<ul class="field-element-list-horizontal">
				<?php foreach($data['options'] as $key => $option): ?>
					<li>
						<input type="radio" id="option-<?php echo $key; ?>" name="<?php echo $name; ?>" value="" class="form-check-input" field-settings>
						<label for="option-<?php echo $key; ?>"><?php echo $option; ?></label>
					</li>
				<?php endforeach; ?>
			</ul>
			

		</div>
		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_group_radio',
			'placeholder' => '',
			'title' => '',
		];
	}
}