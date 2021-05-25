<?php

namespace Drupal\drupalentor\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElement;



/*

$form['style']['button_style'] = [
  '#type' => 'drupalentor_border',
  '#default_value' => [
    'border_top' => $settings->get('button_style')['container']['border_top'] ?? '',
    'border_right' => $settings->get('button_style')['container']['border_right'] ?? '',
    'border_bottom' => $settings->get('button_style')['container']['border_bottom'] ?? '',
    'border_left' => $settings->get('button_style')['container']['border_left'] ?? '',
    'border_type' => $settings->get('button_style')['container']['border_type'] ?? 'solid',
    'border_color' => $settings->get('button_style')['container']['border_color'] ?? '',
    'border_color_hover' => $settings->get('button_style')['container']['border_color'] ?? '',
    'button_color' => $settings->get('button_style')['container']['button_color'] ?? '',
    'button_color_hover' => $settings->get('button_style')['container']['button_color_hover'] ?? '',
    'button_bgcolor' => $settings->get('button_style')['container']['button_bgcolor'] ?? '',
    'button_bgcolor_hover' => $settings->get('button_style')['container']['button_bgcolor_hover'] ?? '',
    'border_bgcolor' => $settings->get('button_style')['container']['border_bgcolor'] ?? '',
    'border_radius_top' => $settings->get('button_style')['container']['border_radius_top'] ?? '',
    'border_radius_right' => $settings->get('button_style')['container']['border_radius_right'] ?? '',
    'border_radius_bottom' => $settings->get('button_style')['general']['border_radius_bottom'] ?? '',
    'border_radius_left' => $settings->get('button_style')['general']['border_radius_left'] ?? '',
    'border_radius_type' => $settings->get('button_style')['general']['border_radius_type'] ?? 'px',
    'padding_top' => $settings->get('button_style')['general']['padding_top'] ?? '',
    'padding_right' => $settings->get('button_style')['general']['padding_right'] ?? '',
    'padding_bottom' => $settings->get('button_style')['general']['padding_bottom'] ?? '',
    'padding_left' => $settings->get('button_style')['general']['padding_left'] ?? '',
    'padding_type' => $settings->get('button_style')['general']['padding_type'] ?? 'px',
  ],
  '#group' => 'style',
];

*/

/**
 * Provides an example element.
 *
 * @FormElement("drupalentor_button_style")
 */

class ButtonStyle extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#tree' => TRUE,
      '#process' => [
        [$class, 'processButtonStyleElement'],
      ],
    ];
  }

  public static function processButtonStyleElement(&$element, FormStateInterface $form_state, &$form) {
      
    $default = $element['#default_value'];
      
      
      
    /* ==========  NORMAL ==========*/
      
    $element['normal'] = [
        '#type' => 'details',
        '#title' => t('Normal'),
        '#open' => FALSE,
    ];
      
    /* ==========  COLOR STYLE ==========*/
      
    $element['normal']['button_color'] = array(
        '#type' => 'textfield',
        '#title' => 'Button Color',
        '#default_value' => isset($default['button_color']) ? $default['button_color'] : '',
        '#description' => t("Set button color"),
        '#attributes' => array('class' => array('form-control-color')),
        '#group' => 'normal',
    );      
    $element['normal']['button_bgcolor'] = array(
        '#type' => 'textfield',
        '#title' => 'Button Color',
        '#default_value' => isset($default['button_bgcolor']) ? $default['button_bgcolor'] : '',
        '#description' => t("Background color"),
        '#attributes' => array('class' => array('form-control-color')),
        '#group' => 'normal',
    );    
      
    /* ==========  BORDER STYLE ==========*/
      
    $element['normal']['border_style'] = [
        '#type' => 'fieldset',
        '#title' => t('Border Style'),
    ];
    $element['normal']['border_style']['border_top'] = array(
        '#type' => 'number',
        '#title' => t('Top'),
        '#default_value' => isset($default['border_top']) ? $default['border_top'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
        '#group' => 'normal',
    );

    $element['normal']['border_style']['border_right'] = array(
        '#type' => 'number',
        '#title' => t('Right'),
        '#default_value' => isset($default['border_right']) ? $default['border_right'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
        '#group' => 'normal',
    );
    $element['normal']['border_style']['border_bottom'] = array(
        '#type' => 'number',
        '#title' => t('Bottom'),
        '#default_value' => isset($default['border_bottom']) ? $default['border_bottom'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
        '#group' => 'normal',
    );
    $element['normal']['border_style']['border_left'] = array(
        '#type' => 'number',
        '#title' => t('Left'),
        '#default_value' => isset($default['border_left']) ? $default['border_left'] : '',
        '#size' =>8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
        '#group' => 'normal',
    );
    $element['normal']['border_style']['border_color'] = array(
        '#type' => 'textfield',
        '#title' => 'Border Color',
        '#default_value' => isset($default['border_color']) ? $default['border_color'] : '',
        '#description' => t("Background color"),
        '#attributes' => array('class' => array('form-control-color')),
        '#group' => 'normal',
        
    );
    $element['normal']['border_style']['border_type'] = array(
        '#type' => 'select',
        '#title' => t('Select Type'),
        '#options' => [
            'dotted' => 'dotted',
            'dashed' => 'dashed',
            'solid' => 'solid',
            'double' => 'double',
            'groove' => 'groove',
            'ridge' => 'ridge',
            'inset' => 'inset',
            'outset' => 'outset',
            'none' => 'none',
            'hidden' => 'hidden',
        ],
        '#default_value' => isset($default['border_type']) ? $default['border_type'] : 'none',
        '#group' => 'normal',
    );
      
    /* ==========  HOVER ==========*/
      
    $element['hover'] = [
        '#type' => 'details',
        '#title' => t('Hover'),
        '#open' => FALSE,
    ];
      
    $element['hover']['button_color_hover'] = array(
        '#type' => 'textfield',
        '#title' => 'Button Color',
        '#default_value' => isset($default['button_color_hover']) ? $default['button_color_hover'] : '',
        '#description' => t("Set button color"),
        '#attributes' => array('class' => array('form-control-color')),
        '#group' => 'hover',
    );      
    $element['hover']['button_bgcolor_hover'] = array(
        '#type' => 'textfield',
        '#title' => 'Button Color',
        '#default_value' => isset($default['button_bgcolor_hover']) ? $default['button_bgcolor_hover'] : '',
        '#description' => t("Background color"),
        '#attributes' => array('class' => array('form-control-color')),
        '#group' => 'hover',
    );    
    
    $element['hover']['border_color_hover'] = array(
        '#type' => 'textfield',
        '#title' => 'Border Color',
        '#default_value' => isset($default['border_color_hover']) ? $default['border_color_hover'] : '',
        '#description' => t("Background color"),
        '#attributes' => array('class' => array('form-control-color')),
        '#group' => 'hover',
    );    
    /* ==========  GENERAL ==========*/
      
    $element['general'] = [
        '#type' => 'details',
        '#title' => t('General'),
        '#open' => FALSE,
    ];
      
    /* ==========  BORDER RADIUS ==========*/
    
    $element['general']['border_radius'] = [
        '#type' => 'fieldset',
        '#title' => t('Border Radius'),
        '#attributes' => array('class' => array('container-inline')),
    ];
      
      
    $element['general']['border_radius']['border_radius_top'] = array(
        '#type' => 'number',
        '#title' => t('Top'),
        '#default_value' => isset($default['border_radius_top']) ? $default['border_radius_top'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );

    $element['general']['border_radius']['border_radius_right'] = array(
        '#type' => 'number',
        '#title' => t('Right'),
        '#default_value' => isset($default['border_radius_right']) ? $default['border_radius_right'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['general']['border_radius']['border_radius_bottom'] = array(
        '#type' => 'number',
        '#title' => t('Bottom'),
        '#default_value' => isset($default['border_radius_bottom']) ? $default['border_radius_bottom'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['general']['border_radius']['border_radius_left'] = array(
        '#type' => 'number',
        '#title' => t('Left'),
        '#default_value' => isset($default['border_radius_left']) ? $default['border_radius_left'] : '',
        '#size' =>8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['general']['border_radius']['border_radius_type'] = array(
        '#type' => 'select',
        '#title' => t('Select Type'),
        '#options' => [
            '%' => '%',
            'px' => t('px'),
        ],
        '#default_value' => isset($default['border_radius_type']) ? $default['border_radius_type'] : '',
    );      
      
    /* ==========  BORDER PADDING ==========*/
    
    $element['general']['button_padding'] = [
        '#type' => 'fieldset',
        '#title' => t('Padding'),
        '#attributes' => array('class' => array('container-inline')),
    ];
      
      
    $element['general']['button_padding']['padding_top'] = array(
        '#type' => 'number',
        '#title' => t('Top'),
        '#default_value' => isset($default['padding_top']) ? $default['padding_top'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );

    $element['general']['button_padding']['padding_right'] = array(
        '#type' => 'number',
        '#title' => t('Right'),
        '#default_value' => isset($default['padding_right']) ? $default['padding_right'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['general']['button_padding']['padding_bottom'] = array(
        '#type' => 'number',
        '#title' => t('Bottom'),
        '#default_value' => isset($default['padding_bottom']) ? $default['padding_bottom'] : '',
        '#size' => 8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['general']['button_padding']['padding_left'] = array(
        '#type' => 'number',
        '#title' => t('Left'),
        '#default_value' => isset($default['padding_left']) ? $default['padding_left'] : '',
        '#size' =>8,
        '#attributes' => array('style' => array('margin-right:5px; width:55px;')),
    );
    $element['general']['button_padding']['padding_type'] = array(
        '#type' => 'select',
        '#title' => t('Select Type'),
        '#options' => [
            '%' => '%',
            'px' => t('px'),
        ],
        '#default_value' => isset($default['padding_type']) ? $default['padding_type'] : '',
    );
    return $element;
  }

    
    }