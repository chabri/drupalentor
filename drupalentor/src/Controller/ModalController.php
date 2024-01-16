<?php

namespace Drupal\drupalentor\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

use Drupal\Core\Ajax\AjaxResponse; 
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\drupalentor\Autoloader;
use Drupal\drupalentor\Controls_Manager;
use Drupal\drupalentor\ModalForm;
use Drupal\Core\Render\Markup;

/**
 * Controller routines for domain finder routes.
 */
class ModalController extends ControllerBase {

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


  public function modal($nid, $widget, $widget_id) {


    // require DRUPALENTOR_PATH . '/controls/base.php';

    $data = drupalentor_load($nid) ?? NULL;
    $fields = drupalentor_get_el_fields($widget);
    $sections = drupalentor_get_sections($data->html);

    // $settings = drupalentor_load_widget($widget_id)->settings ? json_decode(drupalentor_load_widget($widget_id)->settings, true) : null;
    $settings = \Drupal::request()->request->get('settings');

// dump($sections);
//     $search = $sectionId;
//     $found = array_filter($sections,function($v,$k) use ($search){
//       return $v['uid'] == $search;
//     },ARRAY_FILTER_USE_BOTH); // With latest PHP third parameter is optional.. Available Values:- ARRAY_FILTER_USE_BOTH OR ARRAY_FILTER_USE_KEY  
    
//     dump(array_values($found));
//     dump(array_keys($found)); 

    $jsonData = json_encode($settings);
    $escapedJsonData = htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8');

    $form = ModalForm::render_form($fields, json_decode($settings, true));

    $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $output = '<form class="form-widget" id="drupalentor_edit_widget_form">';
    $output .= '<input type="hidden" name="wid" value="'.$widget_id.'"/>';
    $output .= '<input type="hidden" name="did" value="'.$nid.'"/>';
    $output .= '<input type="hidden" name="uid" value="'.\Drupal::currentUser()->id().'"/>';
    $output .= '<input type="hidden" name="type" value="'.$widget.'"/>';
    $output .= '<input type="hidden" name="langcode" value="'.$langcode.'"/>';
    foreach($form  as $item){
      $output .= $item;
    }
    $output .= '<div class="btn-group-margin sticky-bottom pt-2 pb-2 bg-white">
    <button class="btn btn-danger btn-labeled drupalentor-close-modal"><span class="btn-label"><i class="fa-solid fa-xmark"></i></span>'.t('Close').'</button>
    <button type="submit" class="btn btn-success btn-labeled save-widget"><span class="btn-label"><i class="fa-regular fa-floppy-disk"></i></span>'.t('Save changes').'</button>

    </div>';
    $output .= '</form>';

    $output .= '<style>' . PHP_EOL . ModalForm::render_styles($fields, json_decode($settings, true)) . '</style>';


    return new Response($output); 
  

  }
     public function save(){
        header('Content-type: application/json');
        $data = \Drupal::request()->request->get('data');
        $id = \Drupal::request()->request->get('nid');
        $node = Node::load($id);
        $lang = $node->get('langcode')->value;
        
        $builder = \Drupal::database()->select('{drupalentor}', 'd')
          ->fields('d', array('nid', 'html', 'lang'))
          ->condition('nid', $id)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("drupalentor")
            ->fields(array(
                'html' => $data,
            ))
            ->condition('nid', $id)
            ->execute();
        }else{
            $builder = \Drupal::database()->insert("drupalentor")
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
