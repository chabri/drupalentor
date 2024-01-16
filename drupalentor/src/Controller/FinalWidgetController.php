<?php

namespace Drupal\drupalentor\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

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
class FinalWidgetController extends ControllerBase {




  public function load($nid, $widget, $widget_id) {


    $section = [
      'type' => $widget,
    ];
 
    $settings = drupalentor_load_widget($widget_id)->settings ? json_decode(drupalentor_load_widget($widget_id)->settings, true) : null;

    $widget = drupalentor_render_element($section, $settings);

    $html_sin_tabs = preg_replace('/\t/', '', $widget);
    $output = $html_sin_tabs;
   

    $page['#attached']['library'][] = 'drupalentor/drupalentor.assets.admin';

    $page['drupalentor-admin-final-widget'] = array(
      '#theme' => 'drupalentor-admin-final-widget',
      '#content' => $output,
      // '#field' => $el_fields
    );

    return $page;
  

  }

}
