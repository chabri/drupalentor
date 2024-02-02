<?php 
namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;


class Control_Checkbox extends Controls_Base {

	public function get_type() {
		return 'checkbox';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>
		<div class="form-check form-switch">
			<input type="checkbox" id="option-<?php echo $data['item_id']; ?>" name="element[<?php echo $data['item_id']; ?>]" value="" class="form-check-input"  field-settings>
			<label for="option-<?php echo $data['item_id']; ?>" class="form-check-label"><?php echo $data['item']['title']; ?></label>
		</div>
		<?php return ob_get_clean();
	}
	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'checkbox',
			'title' => '',
		];
	}
}

