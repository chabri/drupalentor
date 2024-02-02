<?php 

namespace Drupal\noahs_page_builder;

class Control_Tab {
	
	public function get_type() {
		return 'tab';
	}

	public function content_template($content, $tab_id, $title, $delta = null, $first = null) {

		if(is_array($content)){
		return;
		}
	
		?>
		<?php ob_start() ?>

			<div class="tab-pane fade <?php echo ($delta === 0 || $first) ? 'active show' : ''; ?>" id="nav-<?php echo  $tab_id . $delta; ?>" role="tabpanel" aria-labelledby="nav-<?php echo  $tab_id . $delta; ?>-tab">
				<div class="noahs_page_builder-tab_content">
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