<?php
/**
 * @file
 * Contains \Drupal\drupalentor\Controller\DrupalentorController.
 */

namespace Drupal\drupalentor\Controller;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\node\Entity\Node;
use Drupal\image\Entity\ImageStyle;

class DrupalentorController extends ControllerBase{


    public function editor(Request $request) {
        
        $node = \Drupal::routeMatch()->getParameter('node');
        $id = $node->id();
        $nodeUrl = Url::fromRoute('entity.node.canonical', ['node' => $id])->toString();


        $html = drupalentor_load($id) ?? NULL;
        $getSaveUrl =  Url::fromRoute('drupalentor.save', [],  ['absolute' => TRUE])->toString();
        $getImageStyle =  Url::fromRoute('drupalentor.get_image_style', [],  ['absolute' => TRUE])->toString();
        $page['#attached']['drupalSettings']['saveConfigURL'] = $getSaveUrl;
        $page['#attached']['drupalSettings']['getImageStyleURL'] = $getImageStyle;
        $page['#attached']['drupalSettings']['html_drupalentor'] = $html->html;
        $page['#attached']['drupalSettings']['drupalentor']['base_path'] = base_path();
        $page['#attached']['drupalSettings']['drupalentor']['load_blocks'] = drupalentor_load_blocks();
        $page['#attached']['drupalSettings']['drupalentor']['load_views'] = drupalentor_load_views();
        
        $module_url = '/'.drupal_get_path('module', 'drupalentor');

        $page['#attached']['drupalSettings']['module_url'] = $module_url;
        $page['#attached']['drupalSettings']['nid'] = $id;

        ob_start();
        $page['#attached']['library'][] = 'drupalentor/jquery-custom.assets.admin';
        $page['#attached']['library'][] = 'drupalentor/drupalentor.assets.admin';
        include drupal_get_path('module', 'drupalentor') . '/templates/backend/drupalentor-admin-form.php';

        $content = ob_get_clean();
        $page['drupalentor-admin-form'] = array(
          '#theme' => 'drupalentor-admin-form',
          '#content' => $content
        );
        return $page;
    }
    
    public function save(){
        header('Content-type: application/json');
        $data = \Drupal::request()->request->get('data');
        $id = \Drupal::request()->request->get('nid');
        $node = Node::load($id);
        $lang = $node->get('langcode')->value;
        
        $builder = \Drupal::database()->select('{drupalentor}', 'd')
          ->fields('d', array('id', 'html', 'lang'))
          ->condition('id', $id)
          ->execute()
          ->fetchAssoc();
        
        if($builder != NULL){
            $schema = \Drupal::database()->update("drupalentor")
            ->fields(array(
                'html' => $data,
            ))
            ->condition('id', $id)
            ->execute();
        }else{
            $builder = \Drupal::database()->insert("drupalentor")
              ->fields(array(
                  'html' => $data,
                  'id' => $id,
                  'lang' => $lang,
              ))
            ->execute();
        }

        $result = array(
          'data' => 'update  - saved',
          'html' => $data,
          'lang' => $node->get('langcode')->value,
          'id' => $id,
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
