<?php

namespace Drupal\drupalentor\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'drupalentor_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "drupalentor_field_formatter",
 *   module = "drupalentor",
 *   label = @Translation("Drupalentor Field Formatter"),
 *   field_types = {
 *     "drupalentor_field"
 *   }
 * )
 */
class DrupalentorFieldFormatter extends FormatterBase {


  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = array();

   
      
      return  array(
        '#type' => 'markup',
        '#markup' => '<h1><caca</h1>',
        '#cache' => array(
            'max-age' => 0,
        ),
    );;
  }

}
