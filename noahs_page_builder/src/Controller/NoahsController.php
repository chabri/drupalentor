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

   

    public function editor() {

      require_once NOAHS_PAGE_BUILDER_PATH . '/includes/controls.php';

      $node = \Drupal::routeMatch()->getParameter('node');

      $nid = $node->id();

      $page_id = $nid;
      $iframe_url = "/preview/{$nid}/noahs_page_builder";

      if($node->getEntityTypeId() === 'commerce_product'){
        $page_id  = 'product_' . $nid;
        $iframe_url = "/product_preview/{$nid}/noahs_page_builder";
      }

      $widgets = noahs_page_builder_get_widgets();
      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
    
      $getPageUrl =  Url::fromRoute('noahs_page_builder.save_page', [],  ['absolute' => TRUE])->toString();
      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['nid'] = $page_id;
      $page['#attached']['drupalSettings']['did'] = $page_id;
      $page['#attached']['drupalSettings']['uid'] = \Drupal::currentUser()->id();
      $page['#attached']['drupalSettings']['langcode'] = $langcode;

      $page['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.preview';



      $page['noahs-admin-form'] = array(
        '#theme' => 'noahs-admin-form',
        '#url' => $node->toUrl()->toString(),
        '#content' => '',
        '#did' => $nid,
        '#widgets' => $widgets,
        '#iframe_url' => $iframe_url,
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


    
    public function clonePage($did, $new_did, $original_langcode, $new_langcode){


  
        $result = '';
        $original = \Drupal::database()->select('noahs_page_builder_page', 'd')
        ->fields('d') // Seleccionar todas las columnas
        ->condition('did', $did)
        ->condition('langcode', $original_langcode)
        ->execute()
        ->fetchAssoc();
        
    
        if($original != NULL){
          if($new_did != NULL){
              $builder = \Drupal::database()->insert("noahs_page_builder_page")
                ->fields(array(
                    'did' => $new_did,
                    'uid' => $original['uid'],
                    'nid' => $new_did,
                    'langcode' => $new_langcode,
                    'settings' => $original['settings'],
                    'page_settings' => $original['page_settings']
                ))
              ->execute();
              $result = 'Página clonada correctamente';
            }
        }

      return $result; 
    }
    
    public function savePage(){

        $uid = \Drupal::request()->request->get('uid');
        $did = \Drupal::request()->request->get('did');
        $nid = \Drupal::request()->request->get('nid');
        $settings = \Drupal::request()->request->get('settings');
        $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $page_settings = \Drupal::request()->request->get('page_settings');

        
        $builder = \Drupal::database()->select('noahs_page_builder_page', 'd')
          ->fields('d', array('did'))
          ->condition('did', $did)
          ->condition('langcode', $langcode)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("noahs_page_builder_page")
            ->fields(array(
                'settings' => $settings,
                'page_settings' => $page_settings,
            ))
            ->condition('did', $did)
            ->condition('langcode', $langcode)
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

      return new JsonResponse($did); 
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
      }

      $miObjeto = array('' => 'Original');

      $image_styles = \Drupal::entityQuery('image_style')->execute();
    
      return  $miObjeto + $image_styles;
    }
    


    // Get rendered widget
    public function renderWidget(Request $request){

      $data = json_decode($request->getContent(), TRUE);
      $obj = new \stdClass();
      $obj->type = $data['widget_id'];
      $obj->wid =  uniqid();
      $obj->did =  $data['nid'];

      $widget = noahs_page_builder_render_element($obj, null);

      $html_sin_tabs = preg_replace('/\t/', '', $widget);

      return new JsonResponse(['html' => $widget]);
    }

    // Get rendered widget
    public function renderDefaultTemplateWidget($type){



      $widget = noahs_page_builder_render_default_template($type);

      $html_sin_tabs = preg_replace('/\t/', '', $widget);

      return new JsonResponse(['html' => $widget]);
    }
    
    public function preview($node){

     

      $nid = $node->id();

      $page_id = $nid;
      if($node->getEntityTypeId() === 'commerce_product'){
        $page_id  = 'product_' . $nid;
      }
      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();

      $widgets = noahs_page_builder_get_widgets();

      $data = noahs_page_builder_load($page_id) ?? NULL;
   
      $page_settings = !empty($data->page_settings) ? json_decode($data->page_settings, true) : [];

      $classes = $this->getClasses($data, 'class');
      $data_attributes = $this->getClasses($data, 'attributes');

      $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
      $pallete_color = [];
  
      $pallete_color[] = !empty($noahs_page_builder_config->get('principal_color')) ? $noahs_page_builder_config->get('principal_color') : '#2389ab';
      $pallete_color[] = !empty($noahs_page_builder_config->get('secondary_color')) ? $noahs_page_builder_config->get('principal_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('heading_color')) ? $noahs_page_builder_config->get('heading_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('text_color')) ? $noahs_page_builder_config->get('text_color') : '#000000';
      $sections = noahs_page_builder_get_sections($data->settings);
    
      $getPageUrl =  Url::fromRoute('noahs_page_builder.save_page', [],  ['absolute' => TRUE])->toString();
      $getImageStyle =  Url::fromRoute('noahs_page_builder.get_image_style', [],  ['absolute' => TRUE])->toString();

      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['getImageStyleURL'] = $getImageStyle;

      $page['#attached']['drupalSettings']['noahs_page_builder']['base_path'] = base_path();
      $page['#attached']['drupalSettings']['noahs_page_builder']['load_widgets'] = noahs_page_builder_get_widgets();
      $page['#attached']['drupalSettings']['noahs_page_builder']['classes'] = $classes;
      

      $module_url =  '/'.\Drupal::service('extension.list.module')->getPath('noahs_page_builder');

      $page['#attached']['drupalSettings']['module_url'] = $module_url;
      $page['#attached']['drupalSettings']['nid'] = $page_id;
      $page['#attached']['drupalSettings']['did'] = $page_id;
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

    public function getClasses($data, $type) {
      require_once NOAHS_PAGE_BUILDER_PATH . '/includes/controls.php';
      $page_settings = !empty($data->settings) ? json_decode($data->settings, true) : [];
      $classes = [];
  
      foreach ($page_settings as $item) {
          $classes = array_merge($classes, $this->extractClasses($item, $type));
      }
  
      return $classes;
  }
  
  private function extractClasses($item, $type) {
      $classes = [];
      $obj_class = new Controls_Manager();
       
      if (!empty($item['settings'])) {
          $widget_settings = $item['settings'];
          $fields = noahs_page_builder_get_widget_fields($item['type']);
          if ($type === 'class' && !empty($widget_settings['element']['class'])) {
              $data_classes = $obj_class->getClasses($fields, $widget_settings['element']['class'], $item['wid']);
              $classes[] = $data_classes;
              // $classes = array_merge($classes, $widget_settings['element']['class']);
          }
          if ($type === 'attributes' && !empty($widget_settings['element']['attribute'])) {
            $data_attributes = $obj_class->getAttributes($fields, $widget_settings['element']['attribute'], $item['wid']);
            if($data_attributes){
                $classes[] = $data_attributes;
            }
        }
        if (!empty($item['columns'])) {
          foreach ($item['columns'] as $element) {
              $classes = array_merge($classes, $this->extractClasses($element, $type));
          }
      }
  
          if (!empty($item['elements'])) {
              foreach ($item['elements'] as $element) {
                  $classes = array_merge($classes, $this->extractClasses($element, $type));
              }
          }
      }
  
      return $classes;
  }

}
