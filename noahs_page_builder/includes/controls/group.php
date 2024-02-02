<?php 

namespace Drupal\noahs_page_builder;

class Control_Group {
	
	public function get_type() {
		return 'group';
	}

	public function content_template($content, $group_id, $title) {

		?>
		<?php ob_start() ?>



		  	<div class="noahs_page_builder-group noahs_page_builder_field" id="noahs_page_builder_<?php echo $group_id; ?>">
			  	<h5 class="d-flex justify-content-between" data-bs-toggle="collapse" href="#<?php echo $group_id; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $group_id; ?>"><?php print $title; ?><i class="fa-solid fa-angle-down"></i></h5>
				<div class="noahs_page_builder-group_content collapse" id="<?php echo $group_id; ?>">
					<?php print $content; ?>
				</div>
			</div>

		<?php return ob_get_clean();
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'group',
			'placeholder' => '',
			'title' => '',
		];
	}
}