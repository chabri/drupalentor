<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

use Drupal\Core\Ajax\AjaxResponse; 
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\noahs_page_builder\Autoloader;
use Drupal\noahs_page_builder\Controls_Manager;
use Drupal\noahs_page_builder\ModalForm;
use Drupal\Core\Render\Markup;

/**
 * Controller routines for domain finder routes.
 */
class NoahsEditWidgetController extends ControllerBase {

  /**
   * {@inheritdoc}
   */

  private function register_autoloader() {
    require_once NOAHS_PAGE_BUILDER_PATH . '/includes/autoloader.php';
    Autoloader::run();
  }

  public function __construct() {
    $this->register_autoloader();
  }


  public function edit($nid, $widget, $widget_id) {


    // require noahs_page_builder_PATH . '/controls/base.php';


    $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
    $pallete_color = [];

    $pallete_color[] = !empty($noahs_page_builder_config->get('principal_color')) ? $noahs_page_builder_config->get('principal_color') : '#2389ab';
    $pallete_color[] = !empty($noahs_page_builder_config->get('secondary_color')) ? $noahs_page_builder_config->get('principal_color') : '#4a4a4a';
    $pallete_color[] = !empty($noahs_page_builder_config->get('heading_color')) ? $noahs_page_builder_config->get('heading_color') : '#4a4a4a';
    $pallete_color[] = !empty($noahs_page_builder_config->get('text_color')) ? $noahs_page_builder_config->get('text_color') : '#000000';

    $page['#attached']['drupalSettings']['noahs_page_builder']['pallete_color'] = $pallete_color;
    $fields = noahs_page_builder_get_widget_fields($widget);

    if(noahs_page_builder_load_widget($widget_id)){
 
      $settings = json_decode(noahs_page_builder_load_widget($widget_id)->settings, true);

    }else{
      $settings = null;
    }
    $page['#attached']['drupalSettings']['noahs_page_builder']['field_settings'] = $settings;

    $jsonData = json_encode($settings);
    $escapedJsonData = htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8');

    $form = ModalForm::render_form($fields, $settings);

    $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $output = '<form class="form-widget" id="noahs_page_builder_edit_widget_form">';
    $output .= '<input type="hidden" name="wid" value="'.$widget_id.'"/>';
    $output .= '<input type="hidden" name="did" value="'.$nid.'"/>';
    $output .= '<input type="hidden" name="uid" value="'.\Drupal::currentUser()->id().'"/>';
    $output .= '<input type="hidden" name="type" value="'.$widget.'"/>';
    $output .= '<input type="hidden" name="langcode" value="'.$langcode.'"/>';
    $output .= '<div class="form-data-settings" data-settings="' . $escapedJsonData . '"></div>';

    foreach($form  as $item){

      $output .= $item;
    }
    $output .= '<div class="btn-group-margin">
    <button type="submit" class="btn btn-success btn-labeled save-widget"><span class="btn-label"><i class="fa-regular fa-floppy-disk"></i></span>Save</button>
    <button class="btn btn-danger btn-labeled noahs_page_builder-close-modal"><span class="btn-label"><i class="fa-solid fa-xmark"></i></span>Close</button>
    </div>';
    $output .= '</form>';

    $output .= '<style>' . PHP_EOL . ModalForm::render_styles($fields, $settings) . '</style>';

    $page['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.admin';

    $page['noahs_page_builder-admin-edit-widget'] = array(
      '#theme' => 'noahs-admin-edit-widget',
      '#content' => $output,
      // '#field' => $el_fields
    );

    return $page;
  

  }
    public function save(){
        header('Content-type: application/json');
        $data = \Drupal::request()->request->get('data');
        $id = \Drupal::request()->request->get('nid');
        $node = Node::load($id);
        $lang = $node->get('langcode')->value;
        
        $builder = \Drupal::database()->select('{noahs_page_builder}', 'd')
          ->fields('d', array('nid', 'html', 'lang'))
          ->condition('nid', $id)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("noahs_page_builder")
            ->fields(array(
                'html' => $data,
            ))
            ->condition('nid', $id)
            ->execute();
        }else{
            $builder = \Drupal::database()->insert("noahs_page_builder")
              ->fields(array(
                  'html' => $data,
                  'nid' => $id,
                  'lang' => $lang,
              ))
            ->execute();
        }

        $result = array(
          'data' => 'update  - saved',
          'html' => $data,
          'lang' => $node->get('langcode')->value,
          'nid' => $id,
        );
 
        print json_encode($result);
        exit(0);
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
}
