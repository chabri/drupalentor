<?php
/**
 * @file
 * Contains \Drupal\drupalentor\Controller\DrupalentorController.
 */

namespace Drupal\drupalentor\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Drupal\drupalentor\Autoloader;
use Drupal\drupalentor\Controls_Manager;
use Drupal\drupalentor\WidgetBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Database\Database;


class DrupalentorController extends ControllerBase{

  private function register_autoloader() {
    require_once DRUPALENTOR_PATH . '/includes/autoloader.php';
    Autoloader::run();
  }

  public function __construct() {
    $this->register_autoloader();
  }

   

    public function editor(Request $request) {

      require_once DRUPALENTOR_PATH . '/includes/controls.php';
      
      $node = \Drupal::routeMatch()->getParameter('node');
      $nid = $node->id();
      $widgets = drupalentor_get_widgets();

      $data = drupalentor_load($nid) ?? NULL;

      $classes = $this->getClasses($data);

      $sections = drupalentor_get_sections($data->html);
    
      $getSaveUrl =  Url::fromRoute('drupalentor.save_widget', [],  ['absolute' => TRUE])->toString();
      $getPageUrl =  Url::fromRoute('drupalentor.save_page', [],  ['absolute' => TRUE])->toString();
      $getImageStyle =  Url::fromRoute('drupalentor.get_image_style', [],  ['absolute' => TRUE])->toString();
      // $getWidget =  Url::fromRoute('drupalentor.widget', [],  ['absolute' => TRUE])->toString();
      $page['#attached']['drupalSettings']['saveWidget'] = $getSaveUrl;
      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['getImageStyleURL'] = $getImageStyle;
      $page['#attached']['drupalSettings']['html_drupalentor'] = $data->html;
      // $page['#attached']['drupalSettings']['widget'] = $getWidget;
      // $page['#attached']['drupalSettings']['drupalentor']['element_fields'] = $el_fields;
      $page['#attached']['drupalSettings']['drupalentor']['base_path'] = base_path();
      $page['#attached']['drupalSettings']['drupalentor']['load_widgets'] = drupalentor_get_widgets();
      $page['#attached']['drupalSettings']['drupalentor']['classes'] = $classes;
      $drupalentor_config = \Drupal::config('drupalentor.settings');
      $pallete_color = [];
  
      $pallete_color[] = !empty($drupalentor_config->get('principal_color')) ? $drupalentor_config->get('principal_color') : '#2389ab';
      $pallete_color[] = !empty($drupalentor_config->get('secondary_color')) ? $drupalentor_config->get('principal_color') : '#4a4a4a';
      $pallete_color[] = !empty($drupalentor_config->get('heading_color')) ? $drupalentor_config->get('heading_color') : '#4a4a4a';
      $pallete_color[] = !empty($drupalentor_config->get('text_color')) ? $drupalentor_config->get('text_color') : '#000000';
  
      $page['#attached']['drupalSettings']['drupalentor']['pallete_color'] = $pallete_color;

      $module_url =  '/'.\Drupal::service('extension.list.module')->getPath('drupalentor');

      $page['#attached']['drupalSettings']['module_url'] = $module_url;
      $page['#attached']['drupalSettings']['nid'] = $nid;
      $page['#attached']['drupalSettings']['did'] = $nid;
      $page['#attached']['drupalSettings']['uid'] = \Drupal::currentUser()->id();
      $page['#attached']['drupalSettings']['langcode'] = \Drupal::languageManager()->getCurrentLanguage()->getId();

      $page['#attached']['library'][] = 'drupalentor/drupalentor.assets.preview';

      $alias = \Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);

      $page['drupalentor-admin-form'] = array(
        '#theme' => 'drupalentor-admin-form',
        '#url' => $alias,
        '#content' => '',
        '#widgets' => $widgets,
        // '#field' => $el_fields
      );
      return $page;
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

  public function removeWidget($id) {

    // Verificar si se recibieron IDs válidos
      if (empty($id)) {
          return new JsonResponse('No se han proporcionado IDs válidos para eliminar');
      }
    // Recorrer los IDs y ejecutar la eliminación

      $builder = \Drupal::database()->select('drupalentor_widget', 'd')
      ->fields('d', array('wid'))
      ->condition('wid', $id)
      ->execute()
      ->fetchAssoc();
    
      if($builder != NULL){
        \Drupal::database()->delete('drupalentor_widget')
        ->condition('wid', $id)
        ->execute();
        return new JsonResponse('Widget eliminado correctamente');
      }

  }

  
    public function saveWidget(){

        $wid = \Drupal::request()->request->get('wid');
        $uid = \Drupal::request()->request->get('uid');
        $did = \Drupal::request()->request->get('did');
        $type = \Drupal::request()->request->get('type');
        $settings = \Drupal::request()->request->get('settings');
        $langcode = \Drupal::request()->request->get('langcode');

        $classes = [];
        $builder = \Drupal::database()->select('drupalentor_widget', 'd')
          ->fields('d', array('wid'))
          ->condition('wid', $wid)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("drupalentor_widget")
            ->fields(array(
                'settings' => $settings,
            ))
            ->condition('wid', $wid)
            ->execute();
            $result = 'Widget Actualizado correctamente';
        }else{
            $builder = \Drupal::database()->insert("drupalentor_widget")
              ->fields(array(
                  'wid' => $wid,
                  'did' => $did,
                  'uid' => $uid,
                  'type' => $type,
                  'langcode' => $langcode,
                  'settings' => $settings
              ))
            ->execute();
            $result = 'Widget añadido correctamente';
        }
        $fields = drupalentor_get_el_fields($type);
        $tabs_class = new Controls_Manager();
        $settings = json_decode($settings, true);
        if (!empty($settings['element']['class'])) {

          $data_controls = $tabs_class->getClasses($fields, $settings['element']['class'], $wid);
          if($data_controls){
              $classes[] = $data_controls;
          }
        }

      return new JsonResponse(['result' => $result, 'classes' =>  $classes]); 
    }

    
    public function savePage(){

        $uid = \Drupal::request()->request->get('uid');
        $did = \Drupal::request()->request->get('did');
        $nid = \Drupal::request()->request->get('nid');
        $settings = \Drupal::request()->request->get('settings');
        $langcode = \Drupal::request()->request->get('langcode');

        
        $builder = \Drupal::database()->select('drupalentor_page', 'd')
          ->fields('d', array('did'))
          ->condition('did', $did)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("drupalentor_page")
            ->fields(array(
                'settings' => $settings,
            ))
            ->condition('did', $did)
            ->execute();
            $result = 'Página Actualizada correctamente';
        }else{
            $builder = \Drupal::database()->insert("drupalentor_page")
              ->fields(array(
                  'did' => $did,
                  'uid' => $uid,
                  'nid' => $nid,
                  'langcode' => $langcode,
                  'settings' => $settings
              ))
            ->execute();
            $result = 'Página añadida correctamente';
        }

      return new JsonResponse($result); 
    }

    
    public function getImageStyle(){
        header('Content-type: application/json');
        $img = \Drupal::request()->request->get('img');
        $image_Style = \Drupal::request()->request->get('image_style');
        $styleMedia = ImageStyle::load($image_Style);
        $image_path = $styleMedia->buildUrl(str_replace('/sites/default/files/', 'public://', $img));
         $style = \Drupal::entityTypeManager()->getStorage('image_style')->load($image_Style);
         $url = $style->buildUrl(str_replace('/sites/default/files/', 'public://', $img));
        
        $result = array(
          'data' => 'update  - generated',
          'image_path' => $image_path,
        );
 
        print json_encode($result);
        exit(0);
    }
    
    public function renderWidget($widget_id, $did, $langcode){


      $section = [
        'type' => $widget_id,
        'did' => $did,
        'langcode' => $langcode,
      ];
   
      $widget = drupalentor_render_element($section, null);

      $html_sin_tabs = preg_replace('/\t/', '', $widget);

      return new JsonResponse(['html' => $widget]);
    }
    
    public function preview($node){

     

      $nid = $node->id();
      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $nodeUrl = Url::fromRoute('entity.node.canonical', ['node' => $nid])->toString();
      $widgets = drupalentor_get_widgets();

      $data = drupalentor_load($nid) ?? NULL;
      
      $classes = $this->getClasses($data);

      $drupalentor_config = \Drupal::config('drupalentor.settings');
      $pallete_color = [];
  
      $pallete_color[] = !empty($drupalentor_config->get('principal_color')) ? $drupalentor_config->get('principal_color') : '#2389ab';
      $pallete_color[] = !empty($drupalentor_config->get('secondary_color')) ? $drupalentor_config->get('principal_color') : '#4a4a4a';
      $pallete_color[] = !empty($drupalentor_config->get('heading_color')) ? $drupalentor_config->get('heading_color') : '#4a4a4a';
      $pallete_color[] = !empty($drupalentor_config->get('text_color')) ? $drupalentor_config->get('text_color') : '#000000';
      $sections = drupalentor_get_sections($data->html);
    
      $getSaveUrl =  Url::fromRoute('drupalentor.save_widget', [],  ['absolute' => TRUE])->toString();
      $getPageUrl =  Url::fromRoute('drupalentor.save_page', [],  ['absolute' => TRUE])->toString();
      $getImageStyle =  Url::fromRoute('drupalentor.get_image_style', [],  ['absolute' => TRUE])->toString();

      $page['#attached']['drupalSettings']['saveWidget'] = $getSaveUrl;
      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['getImageStyleURL'] = $getImageStyle;

      $page['#attached']['drupalSettings']['drupalentor']['base_path'] = base_path();
      $page['#attached']['drupalSettings']['drupalentor']['load_widgets'] = drupalentor_get_widgets();
      $page['#attached']['drupalSettings']['drupalentor']['classes'] = $classes;
      

      $module_url =  '/'.\Drupal::service('extension.list.module')->getPath('drupalentor');

      $page['#attached']['drupalSettings']['module_url'] = $module_url;
      $page['#attached']['drupalSettings']['nid'] = $nid;
      $page['#attached']['drupalSettings']['did'] = $nid;
      $page['#attached']['drupalSettings']['uid'] = \Drupal::currentUser()->id();
      $page['#attached']['drupalSettings']['langcode'] = $langcode;

      ob_start();
      $page['#attached']['library'][] = 'drupalentor/drupalentor.assets.admin';
      //include drupal_get_path('module', 'drupalentor') . '/includes/ModalForm.php';

      include \Drupal::service('extension.list.module')->getPath('drupalentor') . '/templates/backend/drupalentor-admin-preview.php';

      $content = ob_get_clean();
      $page['drupalentor-admin-preview'] = array(
        '#theme' => 'drupalentor-admin-preview',
        '#content' => $content,
        // '#field' => $el_fields
      );
      return $page;
   
    }

    public function getClasses($data){
      require_once DRUPALENTOR_PATH . '/includes/controls.php';
      $page_settings = !empty($data->html) ? json_decode($data->html, true) : [];

      $ids = [];
      $classes = [];

      foreach ($this->getAllIds($page_settings, $ids) as $id) {
      
          $fields = drupalentor_get_el_fields($id['type']);
          $widget_settings_data = drupalentor_load_widget($id['id']);
      
          if (!empty($widget_settings_data->settings)) {
              $widget_settings = json_decode($widget_settings_data->settings, true);
      
              $tabs_class = new Controls_Manager();
              if (!empty($widget_settings['element']['class'])) {
      
                $data_controls = $tabs_class->getClasses($fields, $widget_settings['element']['class'], $id['id']);
                if($data_controls){
                    $classes[] = $data_controls;
                }
              }
          }
      }
      return $classes;
    }

}
