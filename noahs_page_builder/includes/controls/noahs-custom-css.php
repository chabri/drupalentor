<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Noahs_Custom_Css extends Controls_Base{
	
	public function get_type() {
		return 'noahs_custom_css';
	}

	public function content_template($data, $name, $value, $delta = null) {

		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder']  : '';
		$selector = !empty($data['item']['update_selector']) ? 'data-update-selector="'.str_replace('[index]', $delta, $data['item']['update_selector']).'"' : null;
		$output = '<div class="field field__textarea">';
		$output .= '<label for="' . $data['item_id'] .'">' . $data['item']['title'] .'</label>';
		$output .= '<textarea 
					name="' . $name .'" 
					class="noahs_page_builder_codemirror w-100" 
					title="' . $data['item']['title'] .'"
					field-settings
					placeholder="'. $placeholder .'" 
					rows="10" 
					class="" '.$selector.'>'.$value.'</textarea>';
		$output .= '</div>';
		return $output;
	}

	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}

}