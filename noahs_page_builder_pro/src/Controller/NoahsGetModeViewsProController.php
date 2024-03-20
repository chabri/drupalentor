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
use Drupal\commerce_product\Entity\ProductType;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\commerce_product\Entity\ProductInterface;


class NoahsGetModeViewsProController extends ControllerBase{

   

     
  public function getMode(Request $request){

    $data = json_decode($request->getContent(), TRUE);

    $viewModes = \Drupal::service('entity_display.repository')
    ->getViewModeOptionsByBundle($data['entity_id'], $data['product_bundle']);
   
    unset($viewModes['default']);
    $viewModes[''] = t('Default');


  return new JsonResponse($viewModes); 
}



}

