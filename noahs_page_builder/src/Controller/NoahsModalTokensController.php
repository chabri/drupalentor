<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;



class NoahsModalTokensController extends ControllerBase {

  function outputTree() {

    $token_manager = \Drupal::token();
    $token_entity_mapping = \Drupal::service('token.entity_mapper');

    // Obtener una lista de tokens disponibles.
    $all_tokens = $token_entity_mapping->getEntityTypeMappings();
    $caca = \Drupal::service('token.tree_builder')->buildAllRenderable(array_keys($all_tokens));


      $build =$caca;

    $build['#cache']['contexts'][] = 'url.query_args:options';
    $build['#title'] = $this->t('Available tokens');

    // If this is an AJAX/modal request, add a wrapping div to the contents so
    // that Drupal.behaviors.tokenTree and Drupal.behaviors.tokenAttach can
    // stil find the elements they need to.
    // @see https://www.drupal.org/project/token/issues/2994671
    // @see https://www.drupal.org/node/2940704
    // @see http://danielnouri.org/notes/2011/03/14/a-jquery-find-that-also-finds-the-root-element/

      $build['#prefix'] = '<div>';
      $build['#suffix'] = '</div>';


    return $build;
  }
}