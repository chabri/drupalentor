<?php 

namespace Drupal\noahs_page_builder;



class Control_Noahs_Width{
	
	public function get_type() {
		return 'noahs_width';
	}



	public function content_template($data, $name, $value) {

		$id = $data['wid'];

		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder']  : '';

		?>
		<?php ob_start() ?>
	
			<div class="field_item form-floating">
				<input type="text" name="<?php echo $name; ?>" class="form-control" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" data-element-settings="<?php echo $data['item_id']; ?>" field-settings>
				<label><?php echo $placeholder; ?></label>
			</div>

		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_width',
			'placeholder' => '',
			'title' => '',
		];
	}
}