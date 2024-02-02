<?php 
namespace Drupal\noahs_page_builder;
class Control_Upload
{
	public function get_type() {
		return 'upload';
	}


	
	public function content_template($data, $value = NULL) {


		$config = \Drupal::config('noahs_page_builder.settings');
		$btn_text = $value ? 'Edit' : 'Add Image';
		$updaload_type = '<input type="text" name="'.$data['id'].'" id="'.$data['id'].'" title="'.$data['title'].'" value="'.$value.'">';
		$updaload_type .= '<button data-element-id="'.$data['id'].'" class="media-upload'.$data['id'].'" title="'.$data['title'].'">'.$btn_text.'</button>';
		
		$output = '<div class="field field__upload">';
		$output .= '<label for="' . $data['id'] .'">' . $data['title'] .'</label>';
		$output .= $updaload_type;
		$output .= '</div>';
		return $output;
	}
	protected function get_default_settings() {
		return [
			'input_type' => 'upload',
			'placeholder' => '',
			'title' => '',
		];
	}
}