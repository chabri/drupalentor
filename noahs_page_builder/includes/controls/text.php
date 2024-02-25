<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Text extends Controls_Base{
	
	public function get_type() {
		return 'text';
	}

	public function content_template($data, $name, $value) {

		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder'] : $data['item']['title'];
		$selector = !empty($data['item']['update_selector']) ? 'data-update-selector="#widget-id-' .$data['wid'] . ' ' .$data['item']['update_selector'].'"' : null;
		$attributes = '';
		if(!empty($data['item']['attributes'])){
		$attributes =  implode(' ', array_map(
			function ($key, $value) {
				return sprintf('%s="%s"', $key, htmlspecialchars($value));
			},
			array_keys($data['item']['attributes']),
			$data['item']['attributes']
		));
		}

		$value = (empty($value) && !empty($data['item']['default_value'])) ? $data['item']['default_value'] : $value;
		
		$output = '<div class="field_item form-floating">';
		$output .= '<input type="text" name="' . $name .'" '.$attributes.' id="' . $data['item_id'] . '" title="' . $data['item']['title'] .'" class="form-control" placeholder="'. $placeholder .'" value="'.$value.'" '.$selector.' field-settings/>';
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