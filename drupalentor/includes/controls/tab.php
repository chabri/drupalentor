<?php 

namespace Drupal\drupalentor;

class Control_Tab {
	
	public function get_type() {
		return 'tab';
	}

	public function content_template($content, $tab_id, $title) {

		?>
		<?php ob_start() ?>


		  	<div class="drupalentor-tab" id="drupalentor_<?php echo $tab_id; ?>">
			  	<h4><?php print $title; ?></h4>
				<div class="drupalentor-tab_content">
					<?php print $content; ?>
				</div>
			</div>

		<?php return ob_get_clean();
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'tab',
			'placeholder' => '',
			'title' => '',
		];
	}
}