<?php 
namespace Drupal\noahs_page_builder;

class Control_Html{
	public function get_type() {
		return 'html';
	}

	public function content_template($data) {

		$output = '<div class="field field__html">';
		$output .= '<h5>' . $data['item']['title'] . '</h5>';
		$output .= $data['item']['value'];
		$output .= '</div>';
	
		return $output;
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'html',
			'title' => '',
		];
	}
}