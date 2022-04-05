<?php 
	namespace Drupal\drupalentor;

   class RenderForm{


	// public function content_template();

	public static function render_form($caca, $values, $type, $key) {
		

		// ob_start();
		foreach($caca as $pedo){

			$sorete = new Controls_Manager();
			$sorete->render_controls($pedo, $values, $type, $key);
		
		}
	// return ob_get_clean();
	}

   }
