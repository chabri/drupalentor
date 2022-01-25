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
        $content = '';
        foreach ($items as $delta => $item) {
            $id = !empty($item->value) ? $item->value : 0;
            if($id){
                $results = drupalentor_load($id);
               
                if(!$results){
                    $content = t('Nothing to show');
                }else{
                    $content = drupalentor_frontend($results->html);
                }
            }
    
            $elements[$delta] = array(
                '#type' => 'markup',
                '#theme' => 'drupalentor-front',
                '#content' => $content,
                '#cache' => array(
                    'max-age' => 0,
                ),
            );
        }
      return $elements;
  }

}
