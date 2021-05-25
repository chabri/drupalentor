<?php

namespace Drupal\drupalentor\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'drupalentor' field type.
 *
 * @FieldType(
 *   id = "drupalentor_fields_margin",
 *   module = "drupalentor",
 *   label = @Translation("Margin Drupalentor"),
 *   description = @Translation("Margin Drupalentor"),
 *   default_widget = "drupalentor_fields_margin_default",
 *   default_formatter = "drupalentor_fields_margin_default"
 * )
 */
class DrupalentorMarginFieldItem extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'selectMarginType' => array(
          'type' => 'select',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
        'marginTop' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
        'marginRight' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
        'marginBottom' => array(
          'type' => 'text',
          'not null' => FALSE,
          'size' => 'tiny',
        ),
        'marginLeft' => array(
          'type' => 'text',
          'not null' => FALSE,
          'size' => 'tiny',
        ),
      ),
    );
  }

  public function isEmpty() {
    $selectMarginType = $this->get('selectMarginType')->getValue();
    $value1 = $this->get('marginTop')->getValue();
    $value2 = $this->get('marginRight')->getValue();
    $value3 = $this->get('marginBottom')->getValue();
    $value4 = $this->get('marginLeft')->getValue();
    return empty($selectMarginType) && empty($value1) && empty($value2) && empty($value3) && empty($value4);
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Add our properties.
    $properties['selectMarginType'] = DataDefinition::create('string')->setLabel(t('Select Margin Type'));
    $properties['marginTop'] = DataDefinition::create('string')->setLabel(t('Margin Top'));
    $properties['marginRight'] = DataDefinition::create('string')->setLabel(t('Margin Bottom'));
    $properties['marginBottom'] = DataDefinition::create('string')->setLabel(t('Margin Left'));
    $properties['marginLeft'] = DataDefinition::create('string')->setLabel(t('Margin Bottom'));

    return $properties;
  }

}
