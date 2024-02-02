<?php 
namespace Drupal\noahs_page_builder;

class Control_Info{
	public function get_type() {
		return 'info';
	}

	public function content_template($data) {

		$output = '<div class="field field__info">';
		$output .= '<p>'.$data['item']['title'].'</p>';
		$output .= '</div>';
	
		return $output;
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'info',
			'title' => '',
		];
	}
}