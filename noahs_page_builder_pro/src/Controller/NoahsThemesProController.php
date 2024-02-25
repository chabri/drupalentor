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
use Drupal\node\Entity\NodeType;
use \Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Url;




class NoahsThemesProController extends ControllerBase{

   

    static function list($name = null) {

      $all_content_types = NodeType::loadMultiple();
      $all_commerce_types = \Drupal\commerce_product\Entity\ProductType::loadMultiple();

      $noahs_page_builder_config = \Drupal::config('noahs_page_builder.settings');
      $use_in_ctype = $noahs_page_builder_config->get('use_in_ctype');
      $use_in_ptype = $noahs_page_builder_config->get('use_in_products');


      $header_url = Url::fromRoute('noahs_page_builder_pro.build', ['type' => 'header'], ['absolute' => TRUE])->toString();
      $footer_url = Url::fromRoute('noahs_page_builder_pro.build', ['type' => 'footer'], ['absolute' => TRUE])->toString();

      $node_types_options = [];
      $node_types_options['header'][] = 'Header';
      $node_types_options['header'][] = new FormattableMarkup('<a href=":link">Edit</a>', [':link' => $header_url]);
      $node_types_options['header'][] = new FormattableMarkup('<a href=":link">Remove</a>', [':link' => '$url->toString()']);

      $node_types_options['footer'][] = 'Footer';
      $node_types_options['footer'][] = new FormattableMarkup('<a href=":link">Edit</a>', [':link' => $footer_url]);
      $node_types_options['footer'][] = new FormattableMarkup('<a href=":link">Remove</a>', [':link' => '$url->toString()']);

      foreach($use_in_ctype as $k => $type){
        if(!is_numeric($type)){
          

          $node_types_options[$k][$type] = $all_content_types[$k]->label();
          $url = Url::fromRoute('noahs_page_builder_pro.build', ['type' => $k], ['absolute' => TRUE])->toString();
          $node_types_options[$k]['edit'] = new FormattableMarkup('<a href=":link">Edit</a>', [':link' => $url]);
          $node_types_options[$k]['remove'] = new FormattableMarkup('<a href=":link">Remove</a>', [':link' => '$url->toString()']);
        }
      }

      foreach($use_in_ptype as $k => $type){
        if(!is_numeric($type)){
          $type = 'commerce_' . $k;
          $node_types_options[$k][$type] = $all_commerce_types[$k]->label();
    

          $url = Url::fromRoute('noahs_page_builder_pro.build', ['type' => $type], ['absolute' => TRUE])->toString();
          $node_types_options[$k]['edit'] = new FormattableMarkup('<a href=":link">Edit</a>', [':link' => $url]);
          $node_types_options[$k]['remove'] = new FormattableMarkup('<a href=":link">Remove</a>', [':link' => '$url->toString()']);
        }
      }

        $header = [
          'type' => t('Type'),
          'edit' => t('Edit'),
          'remove' => t('Remove'),
        ];

        $table = [
          '#theme' => 'table',
          '#header' => $header,
          '#rows' => $node_types_options,
          '#empty' => t('No content has been found.'),
          '#attributes' => [
            'class' => 'table',
          ],
        ];
        return [
          '#type' => '#markup',
          '#markup' => \Drupal::service('renderer')->render($table)
        ];


    }


}

