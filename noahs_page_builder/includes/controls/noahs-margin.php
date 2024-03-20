<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Noahs_Margin extends Controls_Base{
	
	public function get_type() {
		return 'noahs_margin';
	}

	public function content_template($data, $name, $value) {

		?>
		<?php ob_start() ?>
		
			<div class="fs-6 fst-italic">Use your property as px, em, rem, %, ...</div>
			<ul class="field-element-list-horizontal">
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_left]" data-style-css="margin-left" value="<?php echo !empty($value['margin_left']) ? $value['margin_left'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_margin_left">Left</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_top]" data-style-css="margin-top" value="<?php echo !empty($value['margin_top']) ? $value['margin_top'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_margin_top">Top</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_right]" data-style-css="margin-right" value="<?php echo !empty($value['margin_right']) ? $value['margin_right'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_margin_right">Right</label>
				</li>
				<li>
					<input type="text" name="<?php echo $name; ?>[margin_bottom]"data-style-css="margin-bottom"  value="<?php echo !empty($value['margin_bottom']) ? $value['margin_bottom'] : null; ?>" class="form-control" field-settings>
					<label for="noahs_page_builder_margin_bottom">Bottom</label>
				</li>
			</ul>

		<?php return ob_get_clean();
	}
	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_margin',
			'placeholder' => '',
			'title' => '',
		];
	}
}