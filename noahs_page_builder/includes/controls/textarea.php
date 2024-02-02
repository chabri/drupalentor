<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Textarea extends Controls_Base{
	
	public function get_type() {
		return 'textarea';
	}

	public function content_template($data, $name, $value, $delta = null) {

		$value = isset($value) ? $value : $data['item']['default_value'];
		$placeholder = !empty($data['item']['placeholder']) ? $data['item']['placeholder']  : '';
		$selector = !empty($data['item']['update_selector']) ? 'data-update-selector="'.str_replace('[index]', $delta, $data['item']['update_selector']).'"' : null;
		$output = '<div class="field field__textarea">';
		$output .= '<label for="' . $data['item_id'] .'">' . $data['item']['title'] .'</label>';
		$output .= '<textarea 
					name="' . $name .'" 
					id="noahs_page_builder_textarea_' . $data['item_id'] . '" 
					title="' . $data['item']['title'] .'"
					noahs_page_builder-editor
					field-settings
					placeholder="'. $placeholder .'" 
					rows="10" 
					cols="50"
					class="noahs_page_builder_textarea" '.$selector.'>
					'.$value.'
					</textarea>';
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