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
class NoahsModalController extends ControllerBase {

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


  public function modal($nid, $widget, $widget_id) {


    $data = noahs_page_builder_load($nid) ?? NULL;
    $fields = noahs_page_builder_get_widget_fields($widget);
    $sections = noahs_page_builder_get_sections($data->html);
  

    if(noahs_page_builder_load_widget($widget_id)){
 
      $settings = json_decode(noahs_page_builder_load_widget($widget_id)->settings, true);

    }else{
      $settings = null;
    }

    $jsonData = json_encode($settings);
    $escapedJsonData = htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8');

    $form = ModalForm::render_form($fields, $settings);

    $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $output = '<div class="noahs_page_builder-modal">';
    $output .= '<div class="noahs_page_builder-modal_container">';
    $output .= '<div class="noahs_page_builder-modal-topbar"><a href="#" class="move-modal">
    <svg width="51px" height="51px" viewBox="0 0 51 51" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Group" transform="translate(0.500000, 0.500000)">
                <rect id="Rectangle-Copy" fill="#E4E4E4" x="0.5" y="0.5" width="25" height="49"></rect>
                <path d="M50,0 L50,50 L0,50 L0,0 L50,0 Z M49,1 L1,1 L1,49 L49,49 L49,25.5 L35.408,25.5 L41.7451306,29.0642122 L42.1809184,29.3093429 L41.6906571,30.1809184 L41.2548694,29.9357878 L33.2548694,25.4357878 L32.4801356,25 L33.2548694,24.5642122 L41.2548694,20.0642122 L41.6906571,19.8190816 L42.1809184,20.6906571 L41.7451306,20.9357878 L35.408,24.5 L49,24.5 L49,1 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
            </g>
        </g>
    </svg></a></div>';
    $output .= '<form class="form-widget" id="noahs_page_builder_edit_widget_form">';
    $output .= '<input type="hidden" name="wid" value="'.$widget_id.'"/>';
    $output .= '<input type="hidden" name="did" value="'.$nid.'"/>';
    $output .= '<input type="hidden" name="uid" value="'.\Drupal::currentUser()->id().'"/>';
    $output .= '<input type="hidden" name="type" value="'.$widget.'"/>';
    $output .= '<input type="hidden" name="langcode" value="'.$langcode.'"/>';
    foreach($form  as $item){
      $output .= $item;
    }
    $output .= '<div class="btn-group-margin sticky-bottom pt-2 pb-2 bg-white">
    <button class="btn btn-danger btn-labeled noahs_page_builder-close-modal"><span class="btn-label"><i class="fa-solid fa-xmark"></i></span>'.t('Close').'</button>
    <button type="submit" class="btn btn-success btn-labeled save-widget"><span class="btn-label"><i class="fa-regular fa-floppy-disk"></i></span>'.t('Save changes').'</button>

    </div>';
    $output .= '</form>';
    $output .= '</div>';
    $output .= '</div>';

    // $output .= '<style>' . PHP_EOL . ModalForm::render_styles($fields, $settings)) . '</style>';


    return new Response($output); 
  

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
