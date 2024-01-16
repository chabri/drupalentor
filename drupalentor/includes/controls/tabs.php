<?php 

namespace Drupal\drupalentor;

class Control_Tabs {
	
	public function get_type() {
		return 'tabs';
	}

	public function content_template($content, $tabs) {
		$first = true
		?>
		<?php ob_start() ?>
			<ul class="drupalentor-tabs-list">
				<?php foreach($tabs as $key => $tab): ?>
					<li><a href="#drupalentor_<?php echo $key; ?>" <?php $first ? print 'class="active"' : ''; ?>><?php echo $tab; ?></a></li>
					<?php $first = false; ?>
				<?php endforeach; ?>
			</ul>
		  	<div class="drupalentor-tabs-elements"><?php print $content; ?></div>

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