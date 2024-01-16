<?php 
	namespace Drupal\drupalentor;

   class RenderForm{


	// public function content_template();

	public static function render_form($fields, $values = null, $type = null, $key = null) {

		// ob_start();
		foreach($fields as $field){

			$form_field = new Controls_Manager();
			$form_field->render_controls($field, $values, $type, $key);
		
		}
	// return ob_get_clean();
	}

   }
