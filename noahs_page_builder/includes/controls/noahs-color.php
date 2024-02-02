<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Noahs_Color extends Controls_Base{
	
	public function get_type() {
		return 'noahs_color';
	}

	public function content_template($data, $name, $value) {

		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder']  : '';
		$output = '<div class="noahs_page_builder_field field__color">';
		$output .= '<input type="text" name="'.$name.'" id="' . $data['item_id'] . '" title="' . $data['item']['title'] .'" placeholder="'. $placeholder .'" value="' . $value . '" class="form-control-color"  field-settings/>';
		$output .= '</div>';

		return $output;
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_color',
			'placeholder' => '',
			'title' => '',
		];
	}
}