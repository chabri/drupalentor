<?php

namespace Drupal\noahs_page_builder\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
/**
 * Plugin implementation of the 'noahs_page_builder_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "noahs_page_builder_field_widget",
 *   module = "noahs_page_builder",
 *   label = @Translation("noahs_page_builder Formated"),
 *   field_types = {
 *     "noahs_page_builder_field"
 *   }
 * )
 */
class NoahsFieldWidget extends WidgetBase {

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
        $builder = \Drupal::database()->select('{noahs_page_builder_page}', 'd')
        ->fields('d', array('nid', 'settings', 'langcode'))
        ->condition('nid', $nid)
        ->execute()
        ->fetchAssoc();
        $element['value'] = array(
        '#title' => 'noahs_page_builder ID',
        '#type' => 'textfield',
        '#default_value' => $nid,
        '#attributes' => array('class' => array('noahs_page_builder-field'), 'readonly'=>'readonly')
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
