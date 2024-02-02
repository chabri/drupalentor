<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;

class Control_Date extends Controls_Base{
	
	public function get_type() {
		return 'date';
	}

	public function content_template($data, $name, $value) {


		$output = '<div class="field_item">';
		$output .= '<label for="' . $data['item_id'] .'">' . $data['item']['title'] .'</label>';
		$output .= '<input type="date" name="' . $name .'" id="' . $data['item_id'] . '" title="' . $data['item']['title'] .'" class="form-control" value="'.$value.'" field-settings/>';
		$output .= '</div>';

		return $output;
	}
	public function render_control($data){
		return $this->base($data, $this->content_template($data));
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'date',
			'placeholder' => '',
			'title' => '',
		];
	}
}