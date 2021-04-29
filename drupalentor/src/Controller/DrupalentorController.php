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

class DrupalentorController extends ControllerBase{
    
    
//      protected function getFormObject(RouteMatchInterface $route_match, $form_arg) {
//    $browser = $this->loadBrowser();
//    if ($original_path = $this->request->get('original_path')) {
//      $browser->addAdditionalWidgetParameters(['path_parts' => explode('/', $original_path)]);
//    }
//
//    return $browser->getFormObject();
//  }
    
    
    public function editor(Request $request) {
        $id = \Drupal::routeMatch()->getParameter('node');
        $node = Node::load($id);
//        dump($request);
        $page['#attached']['library'][] = 'drupalentor/jquery-custom.assets.admin';
        $page['#attached']['library'][] = 'drupalentor/drupalentor.assets.admin';
        
        $humanstxt_path =  Url::fromRoute('drupalentor.save', [],  ['absolute' => TRUE])->toString();
        $page['#attached']['drupalSettings']['saveConfigURL'] = $humanstxt_path;
        
        $module_url = '/'.drupal_get_path('module', 'drupalentor');

        $page['#attached']['drupalSettings']['module_url'] = $module_url;

         ob_start();
            
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
        $data = $_REQUEST['data'];
        $nid = $_REQUEST['nid'];

        db_update("gavias_content_builder")
              ->fields(array(
                  'params' => $data,
              ))
              ->condition('id', $nid)
              ->execute();

        \Drupal::service('plugin.manager.block')->clearCachedDefinitions();     
        foreach (Cache::getBins() as $service_id => $cache_backend) {
          if($service_id == 'render' || $service_id == 'page'){
            $cache_backend->deleteAll();
          }
        }

        $result = array(
          'data' => 'update saved'
        );

        print json_encode($result);
        exit(0);
      }
}
