<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\Element\EntityAutocomplete;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Xss;

class NoahsUrlAutocompleteController extends ControllerBase {

  public function autocomplete(Request $request) 
    {
      $uid = \Drupal::currentUser()->id();
      $results = [];
      $input = $request->query->get('q');
      if (!$input) {
        return new JsonResponse($results);
      }
      $input = Xss::filter($input);
      $query = \Drupal::entityQuery('node')
        ->condition('title', $input, 'CONTAINS')
        ->groupBy('nid')
        ->condition('uid', $uid)
        ->sort('created', 'DESC')
        ->range(0, 10)
        ->accessCheck(FALSE);
      $ids = $query->execute();
      $nodes = $ids ? \Drupal\node\Entity\Node::loadMultiple($ids) : [];
      foreach ($nodes as $node) {
        $results[] = [
          'id' => $node->id(),
          'text' => $node->getTitle() . ' (' . $node->id() . ')',
        ];
      }

      return new JsonResponse($results);
    }
}
