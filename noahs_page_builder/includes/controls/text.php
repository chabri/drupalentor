<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Text extends Controls_Base{
	
	public function get_type() {
		return 'text';
	}

	public function content_template($data, $name, $value, $delta) {

		$attributes = '';
		$class = [];
		$class[] = 'form-control';
		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder'] : $data['item']['title'];
		$selector = !empty($data['item']['update_selector']) ? 'data-update-selector="#widget-id-' .$data['wid'] . ' ' .$data['item']['update_selector'].'"' : null;
		
		if(isset($data['delta'])){
			if (strpos($selector, '[index]') !== false) {
				$selector = str_replace('[index]', $data['delta'], $selector);
			} 
		}


		$output = '<div class="field_item form-floating">';

		if(!empty($data['item']['autocomplete'])){
			$class[] = 'select2-control';
			$class[] = $data['item']['autocomplete'];
		}
		
		if(!empty($data['item']['attributes'])){
			$attributes =  implode(' ', array_map(
				function ($key, $value) {
					return sprintf('%s="%s"', $key, htmlspecialchars($value));
				},
				array_keys($data['item']['attributes']),
				$data['item']['attributes']
			));

		}


		$class = implode(" ", $class);

		$value = (empty($value['text']) && !empty($data['item']['default_value'])) ? $data['item']['default_value'] : $value;
		$value = !empty($value['text']) ? $value['text'] : $value;
		$output .= '<input type="hidden" name="' . $name .'[node_id]" value="'. (!empty($value['node_id']) ? $value['node_id'] : '') .'" field-settings/>';
		$output .= '<input type="text" name="' . $name .'[text]" '.$attributes.' id="' . $data['item_id'] . '" title="' . $data['item']['title'] .'" class="'.$class.'" placeholder="'. $placeholder .'" value="'.$value.'" '.$selector.' field-settings/>';

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