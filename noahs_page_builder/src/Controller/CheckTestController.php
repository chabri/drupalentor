<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;
use Drupal\node\Entity\Node;
/**
 * Controller routines for domain finder routes.
 */
class CheckTestController extends ControllerBase {


  public function checkAccess($node) {
    $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
    $use_in_ctype = $noahs_page_builder_config->get('use_in_ctype');

    $actualNode = Node::load($node);

      if (array_key_exists($actualNode->bundle(), $use_in_ctype) && $actualNode->bundle() === $use_in_ctype[$actualNode->bundle()]) {
      return AccessResult::allowedIf(true);
    }else{
      return AccessResult::allowedIf(false);
    }
  }


    
}
