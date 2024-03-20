<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Noahs_Url extends Controls_Base{
	
	public function get_type() {
		return 'noahs_url';
	}

	public function content_template($data, $name, $value) {

		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder'] : $data['item']['title'];
		$selector = !empty($data['item']['update_selector']) ? 'data-update-selector="#widget-id-' .$data['wid'] . ' ' .$data['item']['update_selector'].'"' : null;
		$attributes = '';
		$class = [];
		$class[] = 'form-control';

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

		// $value = (empty($value['text']) && !empty($data['item']['default_value'])) ? $data['item']['default_value'] : $value;
		// $value = !empty($value['text']) ? $value['text'] : $value;
	
		$url = '';
		$text = !empty($value['text']) ? $value['text'] : '' ;
		if(!empty($value['node_id'])){
		   $url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$value['node_id']);
		}else if(filter_var($value, FILTER_VALIDATE_URL)){
		   $url = $value['text'];
		}


		$output .= '<input type="hidden" name="' . $name .'[node_id]" value="'. (!empty($value['node_id']) ? $value['node_id'] : '') .'" class="node_id" field-settings/>';
		$output .= '<input type="hidden" name="' . $name .'[url]" value="'. $url .'" field-settings/>';
		$output .= '<input type="text" name="' . $name .'[text]" '.$attributes.' id="' . $data['item_id'] . '" title="' . $data['item']['title'] .'" class="'.$class.'" placeholder="'. $placeholder .'" value="'.$text.'" '.$selector.' field-settings/>';

		$output .= '<label for="' . $data['item_id'] .'">' . $placeholder .'</label>';

		$output .= '</div>';


		return $output;
	}

	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}
	
	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_url',
			'placeholder' => '',
			'title' => '',
		];
	}
}