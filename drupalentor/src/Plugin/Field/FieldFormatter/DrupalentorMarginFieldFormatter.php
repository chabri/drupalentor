<?php

namespace Drupal\drupalentor\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'drupalentor' formatter.
 *
 * @FieldFormatter(
 *   id = "drupalentor_fields_margin_default",
 *   module = "drupalentor",
 *   label = @Translation("Margin Drupalentor"),
 *   field_types = {
 *     "drupalentor_fields_margin"
 *   }
 * )
 */
class DrupalentorMarginFieldFormatter extends FormatterBase {


  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
      $elements = array();
        foreach ($items as $delta => $item) {
            $top = !empty($item->marginTop)    ? $item->marginTop: '0';
            $right = !empty($item->marginRight)  ? $item->marginRight: '0';
            $bottom = !empty($item->marginBottom)   ? $item->marginBottom: '0';
            $left = !empty($item->marginLeft) ? $item->marginLeft: '0';
            $elements[$delta] = array(
                '#type' => 'markup',
                '#markup' => $markup = $top.'px ' . $right.'px ' . $bottom.'px ' . $left.'px',
            );
        }
      return $elements;
  }
  


}
