<?php

namespace Drupal\drupalentor\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
/**
 * Plugin implementation of the 'drupalentor_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "drupalentor_field_widget",
 *   module = "drupalentor",
 *   label = @Translation("Drupalentor Formated"),
 *   field_types = {
 *     "drupalentor_field"
 *   }
 * )
 */
class DrupalentorFieldWidget extends WidgetBase {

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
    $item = $items[$delta];
    $node = \Drupal::routeMatch()->getParameter('node') ?? NULL;
    if(!empty($node)){
        $nid = $node->id();
        $builder = \Drupal::database()->select('{drupalentor}', 'd')
        ->fields('d', array('nid', 'html', 'lang'))
        ->condition('nid', $nid)
        ->execute()
        ->fetchAssoc();
        $element['value'] = array(
        '#title' => 'Drupalentor ID',
        '#type' => 'textfield',
        '#default_value' => $nid,
        '#attributes' => array('class' => array('drupalentor-field'), 'readonly'=>'readonly')
        );
    }


    return $element;
  }


  /**
   * Validate the color text field.
   */
  public function validate($element, FormStateInterface $form_state) {

  }

}
