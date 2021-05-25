<?php

namespace Drupal\drupalentor\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElement;


/**
 * Provides an example element.
 *
 * @FormElement("drupalentor_margin")
 */
class Margin extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#tree' => TRUE,
      '#process' => [
        [$class, 'processMarginElement'],
      ],
    ];
  }

  public static function processMarginElement(&$element, FormStateInterface $form_state, &$form) {

    $element['container'] = [
        '#type' => 'details',
        '#title' => t('Margin'),
        '#attributes' => array('class' => array('container-inline')),
        '#open' => FALSE,
    ];
    $element['container']['marginTop'] = array(
        '#type' => 'number',
        '#title' => t('Top'),
        '#default_value' => isset($element['#default_value']['margin_top']) ? $element['#default_value']['margin_top'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );

    $element['container']['marginRight'] = array(
        '#type' => 'number',
        '#title' => t('Right'),
        '#default_value' => isset($element['#default_value']['marginRight']) ? $element['#default_value']['marginRight'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['container']['marginBottom'] = array(
        '#type' => 'number',
        '#title' => t('Bottom'),
        '#default_value' => isset($element['#default_value']['marginBottom']) ? $element['#default_value']['marginBottom'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['container']['marginLeft'] = array(
        '#type' => 'number',
        '#title' => t('Left'),
        '#default_value' => isset($element['#default_value']['marginLeft']) ? $element['#default_value']['marginLeft'] : '',
        '#size' =>8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['container']['selectMarginType'] = array(
        '#type' => 'select',
        '#title' => t('Select Type'),
        '#options' => [
            '%' => '%',
            'px' => t('px'),
            'em' => t('Em'),
        ],
        '#default_value' => isset($element['#default_value']['selectMarginType']) ? $element['#default_value']['selectMarginType'] : '',
    );
    return $element;
  }



  public static function applyDefaults(array $value) {
    $properties = [
      'selectMarginType', 'marginTop', 'marginRight', 'marginBottom',
      'marginLeft',
    ];
    foreach ($properties as $property) {
      if (!isset($value[$property])) {
        $value[$property] = NULL;
      }
    }

    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public static function valueCallback(&$element, $input, FormStateInterface $form_state) {
    // Ensure both the default value and the input have all keys set.
    // Preselect the default country to ensure it's present in the value.
    $element['#default_value'] = (array) $element['#default_value'];
    $element['#default_value'] = self::applyDefaults($element['#default_value']);

    return is_array($input) ? $input : $element['#default_value'];
  }
    
    }