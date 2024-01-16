<?php 

namespace Drupal\drupalentor;
use Drupal\drupalentor\Controls_Base;

class Control_Text extends Controls_Base{
	
	public function get_type() {
		return 'text';
	}

	public function content_template($data, $name, $value) {

		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder'] : $data['item']['title'];
		$selector = !empty($data['item']['update_selector']) ? 'data-update-selector="#widget-id-' .$data['wid'] . ' ' .$data['item']['update_selector'].'"' : null;

		$output = '<div class="field_item form-floating">';
		$output .= '<input type="text" name="' . $name .'" id="' . $data['item_id'] . '" title="' . $data['item']['title'] .'" class="form-control" placeholder="'. $placeholder .'" value="'.$value.'" '.$selector.' field-settings/>';
		$output .= '<label for="' . $data['item_id'] .'">' . $placeholder .'</label>';
		$output .= '</div>';

		return $output;
	}
	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'text',
			'placeholder' => '',
			'title' => '',
		];
	}
}