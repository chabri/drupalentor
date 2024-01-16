<?php

namespace Drupal\drupalentor\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Drupal\drupalentor\Autoloader;
use Drupal\drupalentor\Controls_Manager;
use Drupal\drupalentor\Controls_Base;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\File\FileSystem;
/**
 * Controller routines for domain finder routes.
 */
class SaveStylesController extends ControllerBase {

  /**
   * {@inheritdoc}
   */

  private function register_autoloader() {
    require_once DRUPALENTOR_PATH . '/includes/autoloader.php';
    Autoloader::run();
  }

  public function __construct() {
    $this->register_autoloader();
  }


  public function save($nid) {
    require_once DRUPALENTOR_PATH . '/includes/controls.php';
    // require_once DRUPALENTOR_PATH . '/includes/control-base.php';

    $page_settings_data = drupalentor_load($nid);
    $page_settings = json_decode($page_settings_data->html, true);
    $extraFieldsClass = new Controls_Base;

    $ids = [];
    $output = '';
    foreach($this->getAllIds($page_settings, $ids) as $id){
  
      $fields = drupalentor_get_el_fields($id['type']);
  
      $extraFields = $extraFieldsClass->defaultFields();
      $mergeField = array_merge($fields, $extraFields);
      $widget_settings_data = drupalentor_load_widget($id['id']);
     
      
      if($widget_settings_data){
        $widget_settings = json_decode($widget_settings_data->settings, true);

        $tabs_class = new Controls_Manager();

        if(!empty($widget_settings['element']['css'])){

          $data_controls = $tabs_class->getStyles($mergeField, $widget_settings['element']['css'], $id['id']);
      
          $output .=  PHP_EOL . $data_controls;
        }
      }
    } 



    $directory = 'public://drupalentor';
    $file_system = \Drupal::service('file_system');
    $file_system->prepareDirectory($directory, FileSystemInterface:: CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS | FileSystemInterface::EXISTS_REPLACE);

      
    $filename = 'drupalentor_' . $page_settings_data->did . '.css'; // Nombre original del archivo
    $directory_url = $directory . '/' . $filename;
    $uploaded_file = \Drupal::service('file_system')->saveData($output, $directory . '/' . $filename, FileSystemInterface::EXISTS_REPLACE);

    return new JsonResponse(['message' => 'CSS saved!','styles' => $output ]);
  
  }

   private function getAllIds($array, &$ids) {

    foreach ($array as $key => $value) {
      if ($key === 'id') {
          $entry = ['id' => $value];
          if (isset($array['type'])) {
              $entry['type'] = $array['type'];
          }
          $ids[] = $entry;
      } elseif (is_array($value)) {
          $this->getAllIds($value, $ids);
      }
  }
    return $ids;
}
}
