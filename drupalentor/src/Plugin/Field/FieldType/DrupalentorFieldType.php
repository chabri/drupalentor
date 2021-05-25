<?php

namespace Drupal\drupalentor\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'drupalentor' field type.
 *
 * @FieldType(
 *   id = "drupalentor_field",
 *   label = @Translation("Drupalentor Widget"),
 *   module = "drupalentor",
 *   description = @Translation("Drupalentor Widget Field."),
 *   default_widget = "drupalentor_field_widget",
 *   default_formatter = "drupalentor_field_formatter"
 * )
 */




class DrupalentorFieldType extends FieldItemBase {
  
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'text',
          'size' => 'int',
          'not null' => FALSE
        ),
      ),
    );
  }

  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return empty($value);
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Add our properties.
    $properties['value'] = DataDefinition::create('string')->setLabel(t('Drupalentor value'));
    return $properties;
  }
}