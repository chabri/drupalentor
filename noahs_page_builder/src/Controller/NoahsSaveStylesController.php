<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


use Drupal\noahs_page_builder\Controls_Manager;
use Drupal\noahs_page_builder\Controls_Base;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\File\FileSystem;
use Drupal\noahs_page_builder_pro\Controller\NoahsBuildThemeProController;

/**
 * Controller routines for domain finder routes.
 */
class NoahsSaveStylesController extends ControllerBase {

  /**
   * {@inheritdoc}
   */



public function save($nid) {
    require_once NOAHS_PAGE_BUILDER_PATH.'/includes/controls.php';
    // require_once NOAHS_PAGE_BUILDER_PATH . '/includes/control-base.php';
    $moduleHandler = \Drupal::service('module_handler');
    if(!is_numeric($nid)){
 
      if ($moduleHandler->moduleExists('noahs_page_builder_pro')) {
          $proClass = new NoahsBuildThemeProController();
          $page_settings_data = $proClass->loadNoahsTheme($nid) ?? NULL;
      }

    }else{
      $page_settings_data = noahs_page_builder_load($nid);
    }
 
    if(empty($page_settings_data->settings)){
      return;
    }
    $page_settings = json_decode($page_settings_data->settings, true);
    $extraFieldsClass = new Controls_Base;

    $ids = [];
    $output = '';


    $elements =  $this->obtenerElementosRecursivos($page_settings);
    $theme_settings = json_decode($page_settings_data->page_settings, true);
    $output .= $this->obtenerThemeCSS($theme_settings['page']);

    foreach($elements as $item) {

        $fields = noahs_page_builder_get_widget_fields($item['type']);

        $extraFields = $extraFieldsClass->defaultFields();
        $mergeField = array_merge($fields, $extraFields);


            $tabs_class = new Controls_Manager();
          if(!empty($item['element'])){
            $css = $this->obtenerCSS($item['element']);

            if (!empty($item['element']['css']) || !empty($css)) {
              $arrayUnificado = array_merge_recursive($item['element']['css'], $css);

                $data_controls = $tabs_class -> getStyles(
                    $mergeField,
                    $arrayUnificado,
                    $item['wid']
                );

                $output .= PHP_EOL.$data_controls;
            }
          }

      }
      


    $directory = 'public://noahs_page_builder';
    $file_system = \Drupal::service('file_system');
    $file_system->prepareDirectory($directory, FileSystemInterface:: CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS | FileSystemInterface::EXISTS_REPLACE);

    $filename = 'noahs_page_builder_' . $nid . '_' . $page_settings_data->langcode . '.css'; // Nombre original del archivo
    $directory_url = $directory . '/' . $filename;
    $uploaded_file = \Drupal::service('file_system')->saveData($output, $directory . '/' . $filename, FileSystemInterface::EXISTS_REPLACE);

    return new JsonResponse(['message' => 'CSS saved!','styles' => $output ]);
  
  }


  private function obtenerElementosRecursivos($array) {
    $elementos = [];
    
      foreach ($array as $key => $value) {
          if (is_array($value) && isset($value['settings'])) {
              $elementos[] = $value['settings'];
          }

          if (is_array($value)) {
              $elementos = array_merge($elementos, $this->obtenerElementosRecursivos($value));
          }
      }

    return $elementos;
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


  // temporal???
  public function generateStyles($nid) {
    require_once NOAHS_PAGE_BUILDER_PATH.'/includes/controls.php';
    $output = '';

    $page_settings_data = noahs_page_builder_load($nid);

    $page_settings = json_decode($page_settings_data->settings, true);
    $elements =  $this->obtenerElementosRecursivos($page_settings);
    $extraFieldsClass = new Controls_Base;

    foreach($elements as $item) {

        $fields = noahs_page_builder_get_widget_fields($item['type']);

        $extraFields = $extraFieldsClass->defaultFields();
        $mergeField = array_merge($fields, $extraFields);


            $tabs_class = new Controls_Manager();
          if(!empty($item['element'])){
            $css = $this->obtenerCSS($item['element']);

            if (!empty($item['element']['css']) || !empty($css)) {
              $arrayUnificado = array_merge_recursive($item['element']['css'], $css);

                $data_controls = $tabs_class -> getStyles(
                    $mergeField,
                    $arrayUnificado,
                    $item['wid']
                );

                $output .= PHP_EOL.$data_controls;
            }
          }

      }

    return $output;
  }
  // temporal???
  public function generateWidgetStyles(array $item) {
    require_once NOAHS_PAGE_BUILDER_PATH.'/includes/controls.php';

        $output = '';
        $fields = noahs_page_builder_get_widget_fields($item['type']);
        $extraFieldsClass = new Controls_Base;
        $extraFields = $extraFieldsClass->defaultFields();
        $mergeField = array_merge($fields, $extraFields);


            $tabs_class = new Controls_Manager();
          if(!empty($item['element'])){
            $css = $this->obtenerCSS($item['element']);

            if (!empty($item['element']['css']) || !empty($css)) {
              $arrayUnificado = array_merge_recursive($item['element']['css'], $css);

                $data_controls = $tabs_class -> getStyles(
                    $mergeField,
                    $arrayUnificado,
                    $item['wid']
                );

                $output .= PHP_EOL.$data_controls;
            }
          }


    return $output;
  }
  // temporal???



  public function update(Request $request) {
    require_once NOAHS_PAGE_BUILDER_PATH.'/includes/controls.php';

        $data = json_decode($request->getContent(), TRUE);
        $item  =  $data['formData'];

        $fields = noahs_page_builder_get_widget_fields($item['type']);
        $extraFieldsClass = new Controls_Base;
        $extraFields = $extraFieldsClass->defaultFields();
        $mergeField = array_merge($fields, $extraFields);


            $tabs_class = new Controls_Manager();
          if(!empty($item['element'])){
            $css = $this->obtenerCSS($item['element']);

            if (!empty($item['element']['css']) || !empty($css)) {
              $arrayUnificado = array_merge_recursive($item['element']['css'], $css);

                $data_controls = $tabs_class -> getStyles(
                    $mergeField,
                    $arrayUnificado,
                    $item['wid']
                );

                $output .= PHP_EOL.$data_controls;
            }
          }

          return new JsonResponse([
            'styles' =>  $output,
          ]);
  }

  public function obtenerCSS($element) {
    $cssArray = [];

    foreach($element as $clave => $subelement) {
        if ($clave !== "css" && $clave !== "class") {
            if (is_array($subelement)) {
                foreach($subelement as $k => $style) {
          
                    if (isset($style['css'])) {
                        $cssArray[] = $style['css'];
                    }
                }
            }
        }
    }
    $unifiedArray = call_user_func_array('array_merge_recursive', $cssArray);

    return $unifiedArray;
  }

  public function obtenerThemeCSS($element) {


    $css = '';
      if(!empty($element['site_logo_width'])){
        $css .= '.noahs-pro-theme--header.sticky img.site__logo{max-width:' . $element['site_logo_width'] . ' !important;}';
      }
      if(!empty($element['background_color_scroll'])){
        $css .= '.noahs-pro-theme--header.sticky {background-color:' . $element['background_color_scroll'] . ' !important;}';
      }
      if(!empty($element['background_color'])){
        $css .= 'body{background-color:' . $element['background_color'] . ' !important;}';
      }
      if(!empty($element['header_background_color'])){
        $css .= 'header{background-color:' . $element['header_background_color'] . ' !important;}';
      }

   


    return $css;
  }
}
