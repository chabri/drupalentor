<?php

namespace Drupal\drupalentor\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\FormElement;

/**
 * Provides an drupalentor form element.
 *
 * Use #field_overrides to override the country-specific drupalentor format,
 * forcing specific properties to be hidden, optional, or required.
 *
 * Usage example:
 * @code
 * $form['margin'] = [
 *   '#type' => 'margin',
 *   '#default_value' => [
 *     'selectMarginType' => '',
 *     'marginTop' => '',
 *     'marginRight' => '',
 *     'marginBottom' => '',
 *     'marginLeft' => '',
 *   ],
 * ];
 * @endcode
 *
 * @FormElement("margin")
 */
class Margin extends FormElement {

  public function getInfo() {
    $class = get_class($this);
    return [];
  }
  /**
   * Ensures all keys are set on the provided value.
   *
   * @param array $value
   *   The value.
   *
   * @return array
   *   The modified value.
   */
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

  /**
   * Processes the address form element.
   *
   * @param array $element
   *   The form element to process.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param array $complete_form
   *   The complete form structure.
   *
   * @return array
   *   The processed element.
   *
   * @throws \InvalidArgumentException
   *   Thrown when #used_fields is malformed.
   */
  public static function processAddress(array &$element, FormStateInterface $form_state, array &$complete_form) {


    return $element;
  }



}
