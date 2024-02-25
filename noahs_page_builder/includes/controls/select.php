<?php 
namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;


class Control_Select extends Controls_Base {

	public function get_type() {
		return 'select';
	}

	public function content_template($data, $name, $value) {

		$selector = !empty($data['item']['update_selector_html']) ? 'data-update-selectorhtml="#widget-id-' .$data['wid'] . ' ' .$data['item']['update_selector_html'].'"' : null;

		$output = '<select name="'.$name.'" class="form-control form-select" '.$selector.' field-settings>';


		if(!empty($data['item']['select_group_views'])){
	
			foreach ($data['item']['options'] as $groupName => $groupItems) {

				$output .= '<optgroup label="'.$groupItems[0]['master'].'">';
				foreach ($groupItems as $item) {
					$selected = ( $value == $key) ? 'selected="selected"' : '';
					$output .= "<option value='{$item['block_id']}' {$selected}>{$item['text']}</option>";
				}
				$output .= '</optgroup>';
			}
		}else if(!empty($data['item']['select_group'])){
	
			foreach ($data['item']['options'] as $groupName => $groupItems) {

				$output .= '<optgroup label="'.$groupItems['text'].'">';
				foreach ($groupItems['options'] as $key => $item) {
					$selected = ( $value == $key) ? 'selected="selected"' : '';

					$output .= "<option value='{$key}' {$selected}>{$item}</option>";
				}
				$output .= '</optgroup>';
			}
		}else{
			foreach($data['item']['options'] as $key => $option){
				$selected = ( $value == $key) ? 'selected="selected"' : '';
				$output .= '<option value="'.$key.'" '.$selected.'>'. $option . '</option>';
			}
		}
 	
		$output .= '</select>';

		return $output;
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'select',
			'title' => '',
		];
	}
}

