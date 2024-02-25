<?php

namespace Drupal\noahs_page_builder\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'noahs_page_builder_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "noahs_page_builder_field_formatter",
 *   module = "noahs_page_builder",
 *   label = @Translation("noahs_page_builder Field Formatter"),
 *   field_types = {
 *     "noahs_page_builder_field"
 *   }
 * )
 */
class NoahsFieldFormatter extends FormatterBase {


  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = array();

   
      
      return  array(
        '#type' => 'markup',
        '#markup' => '<h1>caca</h1>',
        '#cache' => array(
            'max-age' => 0,
        ),
    );;
  }

}
