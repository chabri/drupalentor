<?php
/**
 * @file
 * Contains \Drupal\noahs_page_builder\Controller\noahs_page_builderController.
 */

namespace Drupal\noahs_page_builder_pro;

use Drupal\noahs_page_builder\Controls_Base;

require_once NOAHS_PAGE_BUILDER_PATH . '/includes/controls.php';
class noahs_page_builderProController extends Controls_Base{

  // private function register_autoloader() {
   

  //   Autoloader::run();
  // }

  // public function __construct() {
  //   $this->register_autoloader();
  // }

   
  public function defaultFields($extraField = null){
    // Obtener los campos originales de la función padre
    $form = parent::defaultFields($extraField);

    // Añadir nuevos elementos al formulario
    $additionalElement = [
        'type'     => 'noahs_page_builder_additional',
        'title'    => t('Additional Element'),
        'tab'      => 'section_extras',
        'style_type' => 'style',
        'style_selector' => 'widget', 
        'style_css' => 'additional', 
        'responsive' => true,
        'style_hover' => true,
    ];

    // Agregar el nuevo elemento al formulario
    $form['section_extras']['items']['additional_element'] = $additionalElement;

    // Devolver el formulario actualizado
    return $form;

    }

}
