<?php

namespace Drupal\drupalentor\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'drupalentor' widget.
 *
 * @FieldWidget(
 *   id = "drupalentor_fields_margin_default",
 *   module = "drupalentor",
 *   label = @Translation("Drupalentor Margin Formated"),
 *   field_types = {
 *     "drupalentor_fields_margin"
 *   }
 * )
 */
class DrupalentorMarginFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
public function formElement(
    FieldItemListInterface $items,
    $delta,
    array $element,
    array &$form,
    FormStateInterface $form_state
  ) {
    $element['marginTop'] = array(
      '#type' => 'number',
      '#title' => t('Margin Top'),
      '#default_value' => isset($items[$delta]->marginTop) ? $items[$delta]->marginTop : '',
      '#size' => 8,
    );
    $element['marginRight'] = array(
      '#type' => 'number',
      '#title' => t('Margin Right'),
      '#default_value' => isset($items[$delta]->marginRight) ? $items[$delta]->marginRight : '',
      '#size' => 8,
    );
    $element['marginBottom'] = array(
      '#type' => 'number',
      '#title' => t('Margin Bottom'),
      '#default_value' => isset($items[$delta]->marginBottom) ? $items[$delta]->marginBottom : '',
      '#size' => 8,
    );
    $element['marginLeft'] = array(
      '#type' => 'number',
      '#title' => t('Margin Left'),
      '#default_value' => isset($items[$delta]->marginLeft) ? $items[$delta]->marginLeft : '',
      '#size' =>8,
    );

    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    
      $element += array(
        '#type' => 'fieldset',
        '#attributes' => array('class' => array('container-inline')),
      );
    

    return $element;
  }


  /**
   * Validate the color text field.
   */
  public function validate($element, FormStateInterface $form_state) {

  }

}
