<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Drupal\noahs_page_builder\Autoloader;
use Drupal\noahs_page_builder\Controls_Manager;
use Drupal\noahs_page_builder\Controls_Base;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\File\FileSystem;
/**
 * Controller routines for domain finder routes.
 */
class NoahsCloneWidgetController extends ControllerBase {


  public function clone($old_id, $new_id) {
    require_once NOAHS_PAGE_BUILDER_PATH . '/includes/controls.php';

    $settings = [];
    $output = '';
    if(noahs_page_builder_load_widget($old_id)){
      $settings = json_decode(noahs_page_builder_load_widget($old_id)->settings, true);
      $tabs_class = new Controls_Manager();
      $settings['wid'] = $new_id;
      $fields = noahs_page_builder_get_widget_fields($settings['type']);
      if(!empty($settings['element']['css'])){

        $output .= '<style type="text/css" data-widget-styles="'.$new_id.'">';
        $output .=  PHP_EOL . $tabs_class->getStyles($fields, $settings['element']['css'], $new_id);
        $output .= '</style>';
        // $output .=  PHP_EOL . $data_controls;
      }
    }
    return new JsonResponse([
      'message' => 'CSS saved!',
      'settings' => json_encode($settings),
      'styles' =>  $output, 
      'wid' =>  $new_id, 
    ]);

  } 



    
}
