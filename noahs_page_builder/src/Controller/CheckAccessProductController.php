<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;
use Drupal\node\Entity\Node;
use Drupal\commerce_product\Entity\Product;

/**
 * Controller routines for domain finder routes.
 */
class CheckAccessProductController extends ControllerBase {


  public function checkAccess($commerce_product) {
    $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
    $use_in_ctype = $noahs_page_builder_config->get('use_in_products');

    $actualNode = Product::load($commerce_product);

    return AccessResult::allowedIf($actualNode->bundle() === $use_in_ctype[$actualNode->bundle()]);
  }


    
}
