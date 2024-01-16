<?php 

	namespace Drupal\drupalentor;

   class ModalForm{


	// public function content_template();

	public static function render_form($fields, $values = null) {
		$form = [];
		// group by tabs
		$tabs = array();

		foreach ($fields as $key => $value) {
			if (isset($value['type']) && $value['type'] === 'tab') {
				$currentTab = $key;
				$tabs[$currentTab] = $value;
				$tabs[$currentTab]['items'] = [];
				// Agregar el título de la pestaña
				$tabs[$currentTab]['title'] = isset($value['title']) ? $value['title'] : $currentTab;
			} else {
				if (isset($value['tab'])) {
					$tabName = $value['tab'];
					$group = isset($value['group']) ? $value['group'] : null;
		
					// Verificar si hay grupos o no
					if ($group !== null) {
						$tabs[$tabName]['items'][$group]['title'] = isset($value['title']) ? $value['title'] : $group;
						$tabs[$tabName]['items'][$group][$key] = $value;
					} else {
						$tabs[$tabName]['items'][$key] = $value;
					}
				}
			}
		}


		/*
		foreach ($fields as $key => $value) {
			if (isset($value['type']) && $value['type'] === 'tab') {
				$currentTab = $key; // Almacenar la pestaña actual
				$tabsGrouped[$currentTab] = $value;
				$tabsGrouped[$currentTab]['items'] = []; // Crear un array para los items de esta pestaña
			} else {
				if (isset($value['tab'])) {
					$tabName = $value['tab'];
					$tabsGrouped[$tabName]['items'][$key] = $value; // Añadir el item a la pestaña correspondiente
				}
			}
		}
		*/

		$tabs_class = new Controls_Manager();
		
		$data_controls = $tabs_class->render_tabs($tabs, $values);
		
		$form[] = $data_controls['form'];

		return $form;
	}

	public static function render_styles($fields, $settings) {

		$tabs_class = new Controls_Manager();
		$data_controls = $tabs_class->getStyles($fields, $settings['element']['css'] ?? null, '', $settings['wid']);
		return $data_controls;
	}
	public static function render_classes($class) {
		return $class;
	}
   }
