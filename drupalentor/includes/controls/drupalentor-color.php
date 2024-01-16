<?php 

namespace Drupal\drupalentor;
use Drupal\drupalentor\Controls_Base;

class Control_Drupalentor_Color extends Controls_Base{
	
	public function get_type() {
		return 'drupalentor_color';
	}

	public function content_template($data, $name, $value) {

		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder']  : '';
		$output = '<div class="drupalentor_field field__color">';
		$output .= '<label for="' . $data['item_id'] .'">' . $data['item']['title'] .'</label>';
		$output .= '<input type="text" name="'.$name.'" id="' . $data['item_id'] . '" title="' . $data['item']['title'] .'" placeholder="'. $placeholder .'" value="' . $value . '" class="form-control-color"  field-settings/>';
		$output .= '</div>';

		return $output;
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'drupalentor_color',
			'placeholder' => '',
			'title' => '',
		];
	}
}