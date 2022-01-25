<?php 
namespace Drupal\drupalentor;

class Control_Info{
	public function get_type() {
		return 'info';
	}

	public function content_template($data) {
		?>
			<div class="field field__info">
			<p><?php echo $data['title']; ?></p>	
			</div>
		<?php
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'info',
			'title' => '',
		];
	}
}