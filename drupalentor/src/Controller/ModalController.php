<?php

namespace Drupal\drupalentor\Controller;

use Drupal\Core\Controller\ControllerBase;
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

  public function searchForId($id, $array) {
    // dump($id);
    foreach ($array as $key => $val) {
      // dump($val);
        if ($val['id'] === $id) {
            return $val;
        }
    }
    return null;
 }
  public function modal() {





    $nid = \Drupal::routeMatch()->getParameter('nid');
    $widget = \Drupal::routeMatch()->getParameter('widget');
    $sectionId = \Drupal::routeMatch()->getParameter('section');
    // require DRUPALENTOR_PATH . '/controls/base.php';

    $data = drupalentor_load($nid) ?? NULL;
    $fields = drupalentor_get_el_fields($widget);
    $sections = drupalentor_get_sections($data->html);
    $values = $this->searchForId($sectionId,  $sections);

    $search = $sectionId;
    $found = array_filter($sections,function($v,$k) use ($search){
      return $v['uid'] == $search;
    },ARRAY_FILTER_USE_BOTH); // With latest PHP third parameter is optional.. Available Values:- ARRAY_FILTER_USE_BOTH OR ARRAY_FILTER_USE_KEY  
    
    dump(array_values($found));
    dump(array_keys($found)); 





    $output = '<form class="form-widget">';
    $output .= '<h1>Edit</h1>';
    $output .= '<input type="hidden" name="id" value="'.$sectionId.'"/>';
    $output .= ModalForm::render_form($fields, $values);
    $output .= '<div class="action"><button class="caca" type="submit">Save</button></div>';
    $output .= '</form>';
    $build = array(
      '#type' => 'container',
      '#markup' => Markup::create($output),
      '#attached' => array(
        'library' => array(
            'drupalentor/drupalentor.assets.admin',
        ),
    ),
    );

    $getSaveUrl =  Url::fromRoute('drupalentor.save', [],  ['absolute' => TRUE])->toString();
    $getImageStyle =  Url::fromRoute('drupalentor.get_image_style', [],  ['absolute' => TRUE])->toString();
    $build['#attached']['drupalSettings']['nid'] = $nid;
    $build['#attached']['drupalSettings']['wid'] = $sectionId;
    $build['#attached']['drupalSettings']['html_drupalentor'] =  json_decode($data->html, true);
    $build['#attached']['drupalSettings']['saveConfigURL'] = $getSaveUrl;
// dump($build);
    return $build; 
    

    $response = new AjaxResponse();
    $title = $this->t('Title of Modal');
    $content['#markup'] = Markup::create($html);
    $response->addCommand(new OpenModalDialogCommand($title, $content));
    // return $response;

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
