<?php 
namespace Drupal\noahs_page_builder;

class Control_Hidden{
	public function get_type() {
		return 'hidden';
	}

	public function content_template($data, $name, $value) {

		$output = '<input type="hidden" name="'.$name.'" value="' . $value . '"field-settings/>';

	
		return $output;
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'hidden',
			'title' => '',
		];
	}
}