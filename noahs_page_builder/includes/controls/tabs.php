<?php 

namespace Drupal\noahs_page_builder;

class Control_Tabs {
	
	public function get_type() {
		return 'tabs';
	}

	public function content_template($content, $tabs, $delta = null) {
		$first = true
		?>
		<?php ob_start() ?>
			

			<ul class="nav noahs_page_builder-tabs" id="nav-tab_<?php echo $delta; ?>" role="tablist">
				<?php foreach($tabs as $key => $tab): ?>
					<li class="nav-item">
						<a class="nav-link <?php echo ($first) ? 'active' : ''; ?>" id="nav-<?php echo $key . $delta; ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $key. $delta; ?>" type="button" role="tab" aria-controls="nav-<?php echo $key. $delta; ?>" aria-selected="true"><?php echo $tab; ?></a>
					</li>
					<?php $first = false; ?>
				<?php endforeach; ?>
				</ul>

			
			<div class="tab-content" id="nav-tabContent-<?php echo $key . $delta; ?>">
				<?php print $content; ?>
			</div>

		<?php return ob_get_clean();
	}
	
	protected function get_default_settings() {
		return [
			'input_type' => 'tabs',
			'placeholder' => '',
			'title' => '',
		];
	}
}