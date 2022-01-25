<?php 
namespace Drupal\drupalentor;
class Control_Upload
{
	public function get_type() {
		return 'upload';
	}


	
	public function content_template($data) {
		?>
			<div class="field field__upload">
			<input type="file" name="<?php echo $data['id'] ?>" id="<?php echo $data['id']; ?>" title="<?php echo $data['title']; ?>" accept="image/png, image/jpeg">
			</div>
		<?php
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'upload',
			'placeholder' => '',
			'title' => '',
		];
	}
}