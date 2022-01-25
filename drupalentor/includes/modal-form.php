<?php 
	namespace Drupal\drupalentor;

   class ModalForm{


	// public function content_template();

	public static function render_form($caca, $values) {
		
	
		ob_start();
	foreach($caca as $pedo){

		$sorete = new Controls_Manager();
		$sorete->render_controls($pedo, $values);



	
	}
	return ob_get_clean();
	}

   }
