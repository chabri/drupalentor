<?php
/**
 * @file
 * Contains \Drupal\noahs_page_builder\Controller\noahs_page_builderController.
 */

namespace Drupal\noahs_page_builder\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Drupal\noahs_page_builder\Autoloader;
use Drupal\noahs_page_builder\Controls_Manager;
use Drupal\noahs_page_builder\WidgetBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Database\Database;


class NoahsController extends ControllerBase{

  private function register_autoloader() {
    require_once NOAHS_PAGE_BUILDER_PATH . '/includes/autoloader.php';
    Autoloader::run();
  }

  public function __construct() {
    $this->register_autoloader();
  }

   

    public function editor(Request $request) {

      require_once NOAHS_PAGE_BUILDER_PATH . '/includes/controls.php';
      
      $node = \Drupal::routeMatch()->getParameter('node');
      $nid = $node->id();
      $widgets = noahs_page_builder_get_widgets();

      $data = noahs_page_builder_load($nid) ?? NULL;
      $page_settings = !empty($data->page_settings) ? json_decode($data->page_settings, true) : [];

      $sections = noahs_page_builder_get_sections($data->html);
    
      $getSaveUrl =  Url::fromRoute('noahs_page_builder.save_widget', [],  ['absolute' => TRUE])->toString();
      $getPageUrl =  Url::fromRoute('noahs_page_builder.save_page', [],  ['absolute' => TRUE])->toString();
      $getImageStyle =  Url::fromRoute('noahs_page_builder.get_image_style', [],  ['absolute' => TRUE])->toString();
      // $getWidget =  Url::fromRoute('noahs_page_builder.widget', [],  ['absolute' => TRUE])->toString();
      $page['#attached']['drupalSettings']['saveWidget'] = $getSaveUrl;
      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['getImageStyleURL'] = $getImageStyle;
      $page['#attached']['drupalSettings']['html_noahs_page_builder'] = $data->html;
      // $page['#attached']['drupalSettings']['widget'] = $getWidget;
      // $page['#attached']['drupalSettings']['noahs_page_builder']['element_fields'] = $el_fields;
      $page['#attached']['drupalSettings']['noahs_page_builder']['base_path'] = base_path();
      $page['#attached']['drupalSettings']['noahs_page_builder']['load_widgets'] = noahs_page_builder_get_widgets();
      $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
      $pallete_color = [];
  
      $pallete_color[] = !empty($noahs_page_builder_config->get('principal_color')) ? $noahs_page_builder_config->get('principal_color') : '#2389ab';
      $pallete_color[] = !empty($noahs_page_builder_config->get('secondary_color')) ? $noahs_page_builder_config->get('principal_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('heading_color')) ? $noahs_page_builder_config->get('heading_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('text_color')) ? $noahs_page_builder_config->get('text_color') : '#000000';
  
      $page['#attached']['drupalSettings']['noahs_page_builder']['pallete_color'] = $pallete_color;

      $module_url =  '/'.\Drupal::service('extension.list.module')->getPath('noahs_page_builder');

      $page['#attached']['drupalSettings']['module_url'] = $module_url;
      $page['#attached']['drupalSettings']['nid'] = $nid;
      $page['#attached']['drupalSettings']['did'] = $nid;
      $page['#attached']['drupalSettings']['uid'] = \Drupal::currentUser()->id();
      $page['#attached']['drupalSettings']['langcode'] = \Drupal::languageManager()->getCurrentLanguage()->getId();

      $page['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.preview';

      $alias = \Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);

      $page['noahs-admin-form'] = array(
        '#theme' => 'noahs-admin-form',
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

      $builder = \Drupal::database()->select('noahs_page_builder_widget', 'd')
      ->fields('d', array('wid'))
      ->condition('wid', $id)
      ->execute()
      ->fetchAssoc();
    
      if($builder != NULL){
        \Drupal::database()->delete('noahs_page_builder_widget')
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
        $builder = \Drupal::database()->select('noahs_page_builder_widget', 'd')
          ->fields('d', array('wid'))
          ->condition('wid', $wid)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("noahs_page_builder_widget")
            ->fields(array(
                'settings' => $settings,
            ))
            ->condition('wid', $wid)
            ->execute();
            $result = 'Widget Actualizado correctamente';
        }else{
            $builder = \Drupal::database()->insert("noahs_page_builder_widget")
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
        $fields = noahs_page_builder_get_widget_fields($type);
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
        $page_settings = \Drupal::request()->request->get('page_settings');

        
        $builder = \Drupal::database()->select('noahs_page_builder_page', 'd')
          ->fields('d', array('did'))
          ->condition('did', $did)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("noahs_page_builder_page")
            ->fields(array(
                'settings' => $settings,
                'page_settings' => $page_settings,
            ))
            ->condition('did', $did)
            ->execute();
            $result = 'Página Actualizada correctamente';
        }else{
            $builder = \Drupal::database()->insert("noahs_page_builder_page")
              ->fields(array(
                  'did' => $did,
                  'uid' => $uid,
                  'nid' => $nid,
                  'langcode' => $langcode,
                  'settings' => $settings,
                  'page_settings' => $page_settings
              ))
            ->execute();
            $result = 'Página añadida correctamente';
        }

      return new JsonResponse($result); 
    }

    
    static function getImageStyle(){



      // Define el nombre del nuevo estilo de imagen.
      $styles_names = [
        'Noahs 800x600' => [
          'type' => 'image_scale',
          'width' => '800',
          'height' => '600',
        ],
        'Noahs 1024x768' => [
          'type' => 'image_scale',
          'width' => '1024',
          'height' => '768',
        ],
        'Noahs 1920x1080' => [
          'type' => 'image_scale',
          'width' => '1920',
          'height' => '1080',
        ],
      ];
      foreach($styles_names as $k => $style){

        if (!ImageStyle::load($k)) {
          $new_style = ImageStyle::create(array('name' => $k, 'label' => $k));

          // Create effect
          $configuration = array(
            'uuid' => NULL,
            'id' => $style['type'],
            'weight' => 0,
            'data' => array(
              'width' => $style['width'],
              'height' => $style['height'],
            ),
          );
          $effect = \Drupal::service('plugin.manager.image.effect')->createInstance($configuration['id'], $configuration);
          
          // Add it to the image style and save.
          $new_style->addImageEffect($effect->getConfiguration());
          $new_style->save();
        }

        // if (!ImageStyle::load($k)) {
        //   // Crea un nuevo objeto de estilo de imagen.
        //   $style = ImageStyle::create([
        //     'name' => $k,
        //     'label' => $k,
        //     'id' => $style['type'],
        //     'data' => [
        //       'width' => $style['width'],
        //       'height' => $style['height'],
        //     ],
        //   ]);
        
        //   // Guarda el nuevo estilo de imagen.
        //   $style->save();
        // }
      }

      



      $image_styles = \Drupal::entityQuery('image_style')->execute();

      return $image_styles;
    }
    


    // Get rendered widget
    public function renderWidget($widget_id, $did, $langcode){
      $obj = new \stdClass();
      $obj->type = $widget_id;
      $obj->did = $did;
      $obj->langcode = $langcode;

      $widget = noahs_page_builder_render_element($obj, null);

      $html_sin_tabs = preg_replace('/\t/', '', $widget);

      return new JsonResponse(['html' => $widget]);
    }
    
    public function preview($node){

     
      $page_settings = !empty($data->page_settings) ? json_decode($data->page_settings, true) : [];
      $nid = $node->id();
      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $nodeUrl = Url::fromRoute('entity.node.canonical', ['node' => $nid])->toString();
      $widgets = noahs_page_builder_get_widgets();

      $data = noahs_page_builder_load($nid) ?? NULL;
      $classes = $this->getClasses($data, 'class');
      $data_attributes = $this->getClasses($data, 'attributes');

      $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
      $pallete_color = [];
  
      $pallete_color[] = !empty($noahs_page_builder_config->get('principal_color')) ? $noahs_page_builder_config->get('principal_color') : '#2389ab';
      $pallete_color[] = !empty($noahs_page_builder_config->get('secondary_color')) ? $noahs_page_builder_config->get('principal_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('heading_color')) ? $noahs_page_builder_config->get('heading_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('text_color')) ? $noahs_page_builder_config->get('text_color') : '#000000';
      $sections = noahs_page_builder_get_sections($data->html);
    
      $getSaveUrl =  Url::fromRoute('noahs_page_builder.save_widget', [],  ['absolute' => TRUE])->toString();
      $getPageUrl =  Url::fromRoute('noahs_page_builder.save_page', [],  ['absolute' => TRUE])->toString();
      $getImageStyle =  Url::fromRoute('noahs_page_builder.get_image_style', [],  ['absolute' => TRUE])->toString();

      $page['#attached']['drupalSettings']['saveWidget'] = $getSaveUrl;
      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['getImageStyleURL'] = $getImageStyle;

      $page['#attached']['drupalSettings']['noahs_page_builder']['base_path'] = base_path();
      $page['#attached']['drupalSettings']['noahs_page_builder']['load_widgets'] = noahs_page_builder_get_widgets();
      $page['#attached']['drupalSettings']['noahs_page_builder']['classes'] = $classes;
      

      $module_url =  '/'.\Drupal::service('extension.list.module')->getPath('noahs_page_builder');

      $page['#attached']['drupalSettings']['module_url'] = $module_url;
      $page['#attached']['drupalSettings']['nid'] = $nid;
      $page['#attached']['drupalSettings']['did'] = $nid;
      $page['#attached']['drupalSettings']['uid'] = \Drupal::currentUser()->id();
      $page['#attached']['drupalSettings']['langcode'] = $langcode;

      ob_start();
      $page['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.admin';
      //include drupal_get_path('module', 'noahs_page_builder') . '/includes/ModalForm.php';

      include \Drupal::service('extension.list.module')->getPath('noahs_page_builder') . '/templates/backend/noahs-admin-preview.php';

      $content = ob_get_clean();

      $page['noahs-admin-preview'] = array(
        '#theme' => 'noahs-admin-preview',
        '#content' => $content,
        '#page_settings' => $page_settings,

        // '#field' => $el_fields
      );
      return $page;
   
    }

    public function getClasses($data, $type){
      require_once NOAHS_PAGE_BUILDER_PATH . '/includes/controls.php';
      $page_settings = !empty($data->html) ? json_decode($data->html, true) : [];

      $ids = [];
      $classes = [];

      foreach ($this->getAllIds($page_settings, $ids) as $id) {
      
          $fields = noahs_page_builder_get_widget_fields($id['type']);

          $widget_settings_data = noahs_page_builder_load_widget($id['id']);
      
          if (!empty($widget_settings_data->settings)) {
              $widget_settings = json_decode($widget_settings_data->settings, true);

              $tabs_class = new Controls_Manager();
              if ($type === 'class' && !empty($widget_settings['element']['class'])) {
        
                  $data_controls = $tabs_class->getClasses($fields, $widget_settings['element']['class'], $id['id']);
                  if($data_controls){
                      $classes[] = $data_controls;
                  }
              }
             
              if ($type === 'attributes' && !empty($widget_settings['element']['attribute'])) {
           
                  $data_controls = $tabs_class->getAttributes($fields, $widget_settings['element']['attribute'], $id['id']);
           
                  
                  if($data_controls){

                      $classes[] = $data_controls;
                  }
              }
          }
      }
      return $classes;
    }

}
