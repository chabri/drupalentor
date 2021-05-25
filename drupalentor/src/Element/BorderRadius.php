<?php

namespace Drupal\drupalentor\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElement;



/*

$form['style']['border_radius'] = [
    '#type' => 'drupalentor_border_radius',
    '#default_value' => [
        'border_radius_top' => '0',
        'border_radius_right' => '0',
        'border_radius_bottom' => '0',
        'border_radius_left' => '0',
        'border_radius_type' => 'px',
    ],
];

*/

/**
 * Provides an example element.
 *
 * @FormElement("drupalentor_border_radius")
 */

class BorderRadius extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#tree' => TRUE,
      '#process' => [
        [$class, 'processBorderRadiusElement'],
      ],
    ];
  }

  public static function processBorderRadiusElement(&$element, FormStateInterface $form_state, &$form) {

    $element['container'] = [
        '#type' => 'details',
        '#title' => t('Border Radius'),
        '#attributes' => array('class' => array('container-inline')),
        '#open' => FALSE,
    ];
    $element['container']['border_radius_top'] = array(
        '#type' => 'number',
        '#title' => t('Top'),
        '#default_value' => isset($element['#default_value']['border_radius_top']) ? $element['#default_value']['border_radius_top'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );

    $element['container']['border_radius_right'] = array(
        '#type' => 'number',
        '#title' => t('Right'),
        '#default_value' => isset($element['#default_value']['border_radius_right']) ? $element['#default_value']['border_radius_right'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['container']['border_radius_bottom'] = array(
        '#type' => 'number',
        '#title' => t('Bottom'),
        '#default_value' => isset($element['#default_value']['border_radius_bottom']) ? $element['#default_value']['border_radius_bottom'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['container']['border_radius_left'] = array(
        '#type' => 'number',
        '#title' => t('Left'),
        '#default_value' => isset($element['#default_value']['border_radius_left']) ? $element['#default_value']['border_radius_left'] : '',
        '#size' =>8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['container']['border_radius_type'] = array(
        '#type' => 'select',
        '#title' => t('Select Type'),
        '#options' => [
            '%' => '%',
            'px' => t('px'),
        ],
        '#default_value' => isset($element['#default_value']['border_radius_type']) ? $element['#default_value']['border_radius_type'] : '',
    );
    return $element;
  }

    
    }