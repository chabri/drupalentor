<?php

namespace Drupal\noahs_page_builder\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'noahs_page_builder' field type.
 *
 * @FieldType(
 *   id = "noahs_page_builder_field",
 *   label = @Translation("Noahs Widget"),
 *   module = "noahs_page_builder",
 *   description = @Translation("noahs_page_builder Widget Field."),
 *   default_widget = "noahs_page_builder_field_widget",
 *   default_formatter = "noahs_page_builder_field_formatter"
 * )
 */




class NoahsFieldType extends FieldItemBase {
  
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'text',
          'size' => 'tiny',
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
    $properties['value'] = DataDefinition::create('string')->setLabel(t('noahs_page_builder value'));
    return $properties;
  }
}