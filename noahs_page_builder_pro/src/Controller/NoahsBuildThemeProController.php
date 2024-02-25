<?php
/**
 * @file
 * Contains \Drupal\noahs_page_builder_pro\Controller\noahs_page_builderController.
 */

namespace Drupal\noahs_page_builder_pro\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\node\Entity\NodeType;
use \Drupal\Component\Render\FormattableMarkup;
use Drupal\noahs_page_builder\Controller\NoahsController;
use Drupal\Core\Url;


class NoahsBuildThemeProController extends ControllerBase{

   

    public function build($type) {
    

      require_once NOAHS_PAGE_BUILDER_PATH . '/includes/controls.php';

      $widgets = noahs_page_builder_get_widgets();

      $data = $this->loadNoahsTheme($type) ?? NULL;

      $page_settings = !empty($data->page_settings) ? json_decode($data->page_settings, true) : [];

      $getPageUrl =  Url::fromRoute('noahs_page_builder_pro.save_theme', [],  ['absolute' => TRUE])->toString();

      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['theme_builder'] = true;
      $page['#attached']['drupalSettings']['theme_builder_type'] = $type;
      $page['#attached']['drupalSettings']['nid'] = $type;
      $page['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.preview';


      $page['noahs-admin-form'] = array(
        '#theme' => 'noahs-pro-theme-form',
        '#type' => $type,
        '#widgets' => $widgets,
        '#page_settings' => $page_settings['page'],
        // '#field' => $el_fields
      );
      return $page;

    }

    public function iframe($type){

     

      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $widgets = noahs_page_builder_get_widgets();

      $data = $this->loadNoahsTheme($type) ?? NULL;
      $page_settings = !empty($data->page_settings) ? json_decode($data->page_settings, true) : [];

      $noashController = new NoahsController();
      $classes = $noashController->getClasses($data, 'class');
      $data_attributes = $noashController->getClasses($data, 'attributes');

      $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
      $pallete_color = [];
  
      $pallete_color[] = !empty($noahs_page_builder_config->get('principal_color')) ? $noahs_page_builder_config->get('principal_color') : '#2389ab';
      $pallete_color[] = !empty($noahs_page_builder_config->get('secondary_color')) ? $noahs_page_builder_config->get('principal_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('heading_color')) ? $noahs_page_builder_config->get('heading_color') : '#4a4a4a';
      $pallete_color[] = !empty($noahs_page_builder_config->get('text_color')) ? $noahs_page_builder_config->get('text_color') : '#000000';

      $sections = noahs_page_builder_get_sections($data->settings);

      $getPageUrl =  Url::fromRoute('noahs_page_builder.save_page', [],  ['absolute' => TRUE])->toString();

      $page['#attached']['drupalSettings']['savePage'] = $getPageUrl;
      $page['#attached']['drupalSettings']['page_settings'] = $page_settings;


      $page['#attached']['drupalSettings']['noahs_page_builder']['classes'] = $classes;
      

      $module_url =  '/'.\Drupal::service('extension.list.module')->getPath('noahs_page_builder');
      $page['#attached']['drupalSettings']['uid'] = \Drupal::currentUser()->id();
      $page['#attached']['drupalSettings']['langcode'] = $langcode;
      ob_start();
      $page['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.admin';
      //include drupal_get_path('module', 'noahs_page_builder') . '/includes/ModalForm.php';

      include \Drupal::service('extension.list.module')->getPath('noahs_page_builder') . '/templates/backend/noahs-admin-preview.php';

      $content = ob_get_clean();

      $page['noahs-pro-theme-iframe'] = array(
        '#theme' => 'noahs-pro-theme-iframe',
        '#content' => $content,
        '#page_settings' => $page_settings,

        // '#field' => $el_fields
      );
      return $page;
   
    }

   public function loadNoahsTheme($type) {
      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $result = \Drupal::database()->select('{noahs_page_builder_pro_themes}', 'd')
      ->fields('d')
      ->condition('type', $type, '=')
      ->execute()
      ->fetchObject();
      $page = new \stdClass();
      if($result){   
          $page->type = $result->type;  
          $page->settings = $result->settings;
          $page->page_settings = $result->page_settings;
          $page->langcode = $result->langcode;
      }else{
          $page = null;
          // $page->settings = array();
      }
  
    return $page;
  }


    public function saveTheme(){

      $type = \Drupal::request()->request->get('type');
      $settings = \Drupal::request()->request->get('settings');
      $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $page_settings = \Drupal::request()->request->get('page_settings');

      
      $builder = \Drupal::database()->select('noahs_page_builder_pro_themes', 'd')
        ->fields('d', array('type'))
        ->condition('type', $type)
        ->condition('langcode', $langcode)
        ->execute()
        ->fetchAssoc();
      
      if($builder != NULL){
          $schema = \Drupal::database()->update("noahs_page_builder_pro_themes")
          ->fields(array(
              'settings' => $settings,
              'page_settings' => $page_settings,
          ))
          ->condition('type', $type)
          ->execute();
          $result = 'Plantilla Actualizada correctamente';
      }else{
          $builder = \Drupal::database()->insert("noahs_page_builder_pro_themes")
            ->fields(array(
                'type' => $type,
                'langcode' => $langcode,
                'settings' => $settings,
                'page_settings' => $page_settings
            ))
          ->execute();
          $result = 'Plantilla añadida correctamente';
      }

    return new JsonResponse($result); 
  }
}

