<?php

namespace Drupal\noahs_page_builder\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\noahs_page_builder\Fonts;
use Drupal\node\Entity\NodeType;
/**
 * Defines a form that configures noahs_page_builder settings.
 */
class NoahsSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'noahs_page_builder_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['noahs_page_builder.settings'];
  }

    /**
        * {@inheritdoc}
    */
    private $fonts = false;

    
    public function buildForm(array $form, FormStateInterface $form_state) {
        require_once NOAHS_PAGE_BUILDER_PATH . '/includes/fonts.php';

        $settings = $this->config('noahs_page_builder.settings');
      
        $form['#attached']['library'][] = 'noahs_page_builder/noahs_page_builder.assets.settings';
        $pallete_color = [];
        $pallete_color[] = $settings->get('principal_color') ?? '#2389ab';
        $pallete_color[] = $settings->get('secondary_color') ?? '#4a4a4a';

        $form['#attached']['drupalSettings']['noahs_page_builder']['pallete_color'] = $pallete_color;

        $node_types = \Drupal\node\Entity\NodeType::loadMultiple(); 
        $node_types_options = [];

        foreach ($node_types as $node_type) {
            $node_types_options[$node_type->id()] = $node_type->label();
        }


        $commerce_types = \Drupal\commerce_product\Entity\ProductType::loadMultiple();
        $commerce_options = [];

        foreach ($commerce_types as $product_type) {
            $commerce_options[$product_type->id()] = $product_type->label();
        }
        // dump( $settings->get('use_in_ctype'));
        $form['tabs'] = [
            '#type' => 'horizontal_tabs',
        ];

        /* =========================   General  ========================= */

        $form['general'] = [
            '#type' => 'details',
            '#title' => t('General'),
            '#group' => 'tabs',
        ];
        $form['general']['use_in_ctype'] = [
            '#type' => 'checkboxes',
            '#title' => t('Use in content type'),
            '#group' => 'general',
            '#options' => $node_types_options,
            '#default_value' =>$settings->get('use_in_ctype') ?? [],
        ];
        $form['general']['use_in_products'] = [
            '#type' => 'checkboxes',
            '#title' => t('Use in Products type'),
            '#group' => 'general',
            '#options' => $commerce_options,
            '#default_value' =>$settings->get('use_in_products') ?? [],
        ];
        /* =========================   Styles  ========================= */

        $form['style'] = [
            '#type' => 'details',
            '#title' => t('Style'),
            '#group' => 'tabs',
        ];
         
        
        $form['style']['container_width'] = array(
            '#type' => 'number',
            '#title' => 'Content Width',
            '#default_value' => $settings->get('container_width') ?? '',
            '#placeholder' => 1140,
            '#field_suffix' => 'px',
            '#description' => t("Sets the default width of the content area (Default: 1140)"),
            '#group' => 'style',
        );

        $form['style']['viewport_lg'] = array(
            '#type' => 'number',
            '#title' => 'Tablet Breakpoint',
            '#default_value' => $settings->get('viewport_lg') ?? '',
            '#field_suffix' => 'px',
            '#description' => t("Sets the breakpoint between desktop and tablet devices. Below this breakpoint tablet layout will appear (Default: 1025)."),
            '#group' => 'style',
        );

        $form['style']['viewport_md'] = array(
            '#type' => 'number',
            '#title' => 'Mobile Breakpoint',
            '#default_value' => $settings->get('viewport_md'),
            '#placeholder' => 768,
            '#field_suffix' => 'px',
            '#description' => t("Sets the breakpoint between tablet and mobile devices. Below this breakpoint mobile layout will appear (Default: 768)."),
            '#group' => 'style',
        );
        
        /* =========================   Media  ========================= */
/*
        $form['media'] = [
            '#type' => 'details',
            '#title' => t('Media'),
            '#group' => 'tabs',
        ];
        $form['media']['use_media_type'] = [
            '#type' => 'checkbox',
            '#title' => t('Use media type to manage images?'),
            '#default_value' => $settings->get('use_media_type') ? $settings->get('use_media_type') : '',
          ];
          $media_types = \Drupal::entityTypeManager()->getStorage('media_type')->loadMultiple();

          $options = [];
          foreach ($media_types as $media_type) {
            // Filtrar tipos de medios por Media source = Image
            if ($media_type->getSource()->getConfiguration()['source_field'] == 'field_media_image') {
              $options[$media_type->id()] = $media_type->label();
            }
          }
        $form['media']['media_type'] = [
            '#type' => 'select',
            '#title' => 'Media Type image',
            '#default_value' => $settings->get('media_type') ? $settings->get('media_type') : '',
            '#description' => t("Select media type"),
            '#options' => $options,
            '#empty_option' => '- Seleccione -',
            '#group' => 'media',
            '#states' => [
                // Definición de estado para mostrar/ocultar este campo
                'visible' => [
                  ':input[name="use_media_type"]' => ['checked' => TRUE], // Mostrar si el checkbox está marcado
                ],
                'required' => [
                  ':input[name="use_media_type"]' => ['checked' => TRUE], // Mostrar si el checkbox está marcado
                ],
              ],
            ];       

            */
        /* =========================   Fonts  ========================= */
        
        
        $form['fonts'] = [
            '#type' => 'details',
            '#title' => t('Fonts'),
            '#group' => 'tabs',
        ];
        $noahs_page_builder_fonts = Fonts::getFonts();
        $form['fonts']['google_font_api'] = array(
            '#type' => 'textfield',
            '#title' => 'Google Font API',
            '#default_value' => $settings->get('google_font_api') ? $settings->get('google_font_api') : '',
            '#description' => t("Paste here your google font api. <a href='https://developers.google.com/fonts/docs/developer_api' target='_blank'>Get your API here</a>"),
            '#group' => 'fonts',
        );
        $google_font_api = $settings->get('google_font_api') ? $settings->get('google_font_api') : '';
        $google_fonts = $this->get_google_fonts($google_font_api);
        $fonts = array_merge($noahs_page_builder_fonts, $google_fonts);
        $form['fonts']['heading_font'] = array(
            '#type' => 'select',
            '#title' => 'Headings front',
            '#default_value' => $settings->get('heading_font') ? $settings->get('heading_font') : 'Playfair Display',
            '#description' => t("Set font to h1 - h2 - h3 - h4 - h5 - h6"),
            '#options' => $fonts,
            '#group' => 'fonts',
            '#attributes' => array('class' => array('chosen-select')),
        );
        $form['fonts']['heading_font_weight'] = array(
            '#type' => 'select',
            '#title' => 'Font Weight',
            '#default_value' => $settings->get('heading_font_weight') ? $settings->get('heading_font_weight') : 'bold',
            '#description' => t("Set font weight"),
            '#options' =>  Fonts::getFontsWeights(),
            '#group' => 'fonts',
        );
        $form['fonts']['general_font'] = array(
            '#type' => 'select',
            '#title' => 'General front',
            '#default_value' => $settings->get('general_font') ? $settings->get('general_font') : 'Playfair Display',
            '#description' => t("Set font to general body/html"),
            '#options' => $fonts,
            '#group' => 'fonts',
            '#attributes' => array('class' => array('chosen-select')),
        );
        $form['fonts']['general_font_weight'] = array(
            '#type' => 'select',
            '#title' => 'Font Weight',
            '#default_value' => $settings->get('general_font_weight') ? $settings->get('general_font_weight') : '300',
            '#description' => t("Set font weight"),
            '#options' =>  Fonts::getFontsWeights(),
            '#group' => 'fonts',
        );
        

        
        
    /* =========================   Colors  ========================= */
        
        $form['colors'] = [
            '#type' => 'details',
            '#title' => t('Default Colors'),
            '#group' => 'tabs',
        ];
        $form['colors']['palette'] = [
            '#type' => 'fieldset',
            '#title' => t('Colors'),
            '#group' => 'colors',
        ];
        $form['colors']['palette']['principal_color'] = array(
            '#type' => 'textfield',
            '#title' => 'Principal Color',
            '#default_value' => $settings->get('principal_color') ? $settings->get('principal_color') : '',
            '#description' => t("Set Principal color"),
            '#attributes' => array('class' => array('form-control-color')),
            '#group' => 'palette',
        );
        $form['colors']['palette']['secondary_color'] = array(
            '#type' => 'textfield',
            '#title' => 'Secontadry Color',
            '#default_value' => $settings->get('secondary_color') ? $settings->get('secondary_color') : '',
            '#description' => t("Set Secontadry color"),
            '#attributes' => array('class' => array('form-control-color')),
            '#group' => 'palette',
        );
        
        
        $form['colors']['setting_colors'] = [
            '#type' => 'fieldset',
            '#title' => t('Settings Text Colors'),
            '#group' => 'colors',
        ];
        $form['colors']['setting_colors']['heading_color'] = array(
            '#type' => 'textfield',
            '#title' => 'Heading Color',
            '#default_value' => $settings->get('heading_color') ? $settings->get('heading_color') : '',
            '#description' => t("Set heading color"),
            '#attributes' => array('class' => array('form-control-color')),
            '#group' => 'setting_colors',
        );
        $form['colors']['setting_colors']['text_color'] = array(
            '#type' => 'textfield',
            '#title' => 'Text Color',
            '#default_value' => $settings->get('text_color') ? $settings->get('text_color') : '',
            '#description' => t("Set text color"),
            '#attributes' => array('class' => array('form-control-color')),
            '#group' => 'setting_colors',
        );
                
        
        /* =========================   Buttons  ========================= */
        
        $form['buttons'] = [
            '#type' => 'details',
            '#title' => t('Buttons'),
            '#group' => 'tabs',
        ];
        
        $fields_button = [
            'font' => [
                'button_font-size' => 'Font Size',
                'button_line_height' => 'Line Height',
                'button_letter_space' => 'Letter Space',
                'button_word_space' => 'Word Space',
                'button_font_wight' => [
                    'title' => 'Font Weight',
                    'options' =>  Fonts::getFontsWeights(),
                    ],
                'text_transform' => [
                    'title' => 'Text Transform',
                    'options' => [
                        '' => 'Default',
                        'uppercase' => 'Uppercase',
                        'lowercase' => 'Lowecase',
                        'capitalize' => 'Capitalize',
                        'none' => 'Normal',
                    ],
                ],
            ],
            'border' => [
              'border_top' => 'Border Top',
              'border_right' => 'Border Right',
              'border_bottom' => 'Border Bottom',
              'border_left' => 'Border Left',
              'border_type' => [
                'title' => 'Border Type',
                'options' => [
                  'none' => 'None',
                  'solid' => 'Solid',
                  'dotted' => 'Dotted',
                  'dashed' => 'Dashed',
                ],
              ],
            ],
            'border-radius' => [
              'border_radius_top' => 'Border Radius Top',
              'border_radius_right' => 'Border Radius Right',
              'border_radius_bottom' => 'Border Radius Bottom',
              'border_radius_left' => 'Border Radius Left',
            ],
            'padding' => [
              'padding_top' => 'Padding Top',
              'padding_right' => 'Padding Right',
              'padding_bottom' => 'Padding Bottom',
              'padding_left' => 'Padding Left',
            ],
          ];
    
          foreach ($fields_button as $group_key => $group_fields) {

            $form['buttons'][$group_key] = [
                '#type' => 'fieldset',
                '#title' => $group_key,
                '#attributes' => [
                  'class' => ['noahs-group-settings-fileds'],  // Añade aquí tus clases
                ],
              ];
            foreach ($group_fields as $field_key => $field_config) {
                if(empty($field_config['options'])){
                    $form['buttons'][$group_key][$field_key] = [
                    '#type' => is_array($field_config) ? 'select' : 'textfield',
                    '#title' => is_array($field_config) ? $field_config['title'] : $field_config,
                    '#default_value' => is_array($field_config) ? $settings->get($field_key) ?? '' : $settings->get($field_key) ?? '',
                    ];
                }else{
                    $form['buttons'][$group_key][$field_key] = [
                    '#title' => is_array($field_config) ? $field_config['title'] : $field_config,
                    '#default_value' => is_array($field_config) ? $settings->get($field_key) ?? '' : $settings->get($field_key) ?? '',
                    '#type' => 'select',
                    '#options' =>$field_config['options'],
                    ];
                }
            

              
            }
          }
          
        $fields_button_color = [
            'border_color' => 'Border Color',
            'border_color_hover' => 'Border Color Hover',
            'button_color' => 'Button Color',
            'button_color_hover' => 'Button Color Hover',
            'button_bgcolor' => 'Button Background Color',
            'button_bgcolor_hover' => 'Button Background Color Hover',
            'border_bgcolor' => 'Border Background Color',
        ];

        $form['buttons']['buttons_styles'] = [
            '#type' => 'fieldset',
            '#title' => t('Buttons Styles'),

        ];
        
          foreach ($fields_button_color as $field_key => $field_title) {
            $form['buttons']['buttons_styles'][$field_key] = [
              '#type' => 'textfield',
              '#title' => $field_title,
              '#default_value' => $settings->get($field_key) ?? '',
              '#attributes' => array('class' => array('form-control-color')),

            ];
          }
    

        /* =========================   Forms  ========================= */

        $form['forms'] = [
            '#type' => 'details',
            '#title' => t('Forms'),
            '#group' => 'tabs',
        ];
        $fields_forms = [
            'font' => [
                'forms_font-size' => 'Font Size',
                'forms_line_height' => 'Line Height',
                'forms_letter_space' => 'Letter Space',
                'forms_word_space' => 'Word Space',
                'forms_font_wight' => [
                    'title' => 'Font Weight',
                    'options' =>  Fonts::getFontsWeights(),
                    ],
                'form_text_transform' => [
                    'title' => 'Text Transform',
                    'options' => [
                        '' => 'Default',
                        'uppercase' => 'Uppercase',
                        'lowercase' => 'Lowecase',
                        'capitalize' => 'Capitalize',
                        'none' => 'Normal',
                    ],
                ],
            ],
            'Border Inputs' => [
              'form_border_top' => 'Border Top',
              'form_border_right' => 'Border Right',
              'form_border_bottom' => 'Border Bottom',
              'form_border_left' => 'Border Left',
              'form_border_type' => [
                'title' => 'Border Type',
                'options' => [
                  'none' => 'None',
                  'solid' => 'Solid',
                  'dotted' => 'Dotted',
                  'dashed' => 'Dashed',
                ],
              ],
            ],
            'Border Radius' => [
              'form_border_radius_top' => 'Border Radius Top',
              'form_border_radius_right' => 'Border Radius Right',
              'form_border_radius_bottom' => 'Border Radius Bottom',
              'form_border_radius_left' => 'Border Radius Left',
            ],
            'padding' => [
              'form_padding_top' => 'Padding Top',
              'form_padding_right' => 'Padding Right',
              'form_padding_bottom' => 'Padding Bottom',
              'form_padding_left' => 'Padding Left',
            ],
          ];
          foreach ($fields_forms as $group_key => $group_fields) {

            $form['forms'][$group_key] = [
                '#type' => 'fieldset',
                '#title' => $group_key,
                '#attributes' => [
                  'class' => ['noahs-group-settings-fileds'],  // Añade aquí tus clases
                ],
              ];
            foreach ($group_fields as $field_key => $field_config) {
                if(empty($field_config['options'])){
                    $form['forms'][$group_key][$field_key] = [
                    '#type' => is_array($field_config) ? 'select' : 'textfield',
                    '#title' => is_array($field_config) ? $field_config['title'] : $field_config,
                    '#default_value' => is_array($field_config) ? $settings->get($field_key) ?? '' : $settings->get($field_key) ?? '',
                    ];
                }else{
                    $form['forms'][$group_key][$field_key] = [
                    '#title' => is_array($field_config) ? $field_config['title'] : $field_config,
                    '#default_value' => is_array($field_config) ? $settings->get($field_key) ?? '' : $settings->get($field_key) ?? '',
                    '#type' => 'select',
                    '#options' =>$field_config['options'],
                    ];
                }
                $form['forms']['input_color'] = array(
                    '#type' => 'textfield',
                    '#title' => 'Text Color',
                    '#default_value' => $settings->get('input_color') ? $settings->get('input_color') : '',
                    '#description' => t("Set text color"),
                    '#attributes' => array('class' => array('form-control-color')),
                );
                $form['forms']['input_bgcolor'] = array(
                    '#type' => 'textfield',
                    '#title' => 'Inputs Background Color',
                    '#default_value' => $settings->get('input_bgcolor') ? $settings->get('input_bgcolor') : '',
                    '#description' => t("Set background color"),
                    '#attributes' => array('class' => array('form-control-color')),
                );
                $form['forms']['input_border_color'] = array(
                    '#type' => 'textfield',
                    '#title' => 'Inputs Border Color',
                    '#default_value' => $settings->get('input_bgcolor') ? $settings->get('input_border_color') : '',
                    '#description' => t("Set background color"),
                    '#attributes' => array('class' => array('form-control-color')),
                );
                $form['forms']['checkbox_style'] = array(
                    '#type' => 'checkbox',
                    '#title' => 'Show Checkbox as Switch style',
                    '#default_value' => $settings->get('checkbox_style') ? $settings->get('checkbox_style') : '',
                    '#description' => t("Style Switch on/off"),
                );

              
            }
          }

                  /* =========================   Custom Css  ========================= */
        
        $form['custom_css'] = [
            '#type' => 'fieldset',
            '#title' => t('Custom Css'),
            '#attributes' => array('style' => array('margin-top:25px')),
        ];
        
        $form['custom_css']['noahs_page_builder_custom_css'] = [
            '#type' => 'textarea',
            '#rows' => 15,
            '#title' => $this->t('CSS Code'),
            '#default_value' => $settings->get('noahs_page_builder_custom_css'),
            '#description' => $this->t('Please enter custom style without <b> @style </b> tag.', ["@style" => '<style>']) ,
            '#attributes' => array('class' => array('codemirror-texarea')),
//            '#group' => 'custom_css',
        ];
        return parent::buildForm($form, $form_state);
    }

    public function get_google_fonts($api) {
        $options = [];
        $url = "https://www.googleapis.com/webfonts/v1/webfonts?key=".$api;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        
            $result = json_decode( $result, true );

        if(!$result['error']){        
            foreach ( $result['items'] as $k => $v ) {

                $options[$v['family']] = $v['family'];
            }
        }

        return $options;
    }
  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $fontName1 = str_replace(" ", "+", $form_state->getValue('heading_font') ?? '');
        $fontName2 = str_replace(" ", "+", $form_state->getValue('general_font') ?? '');
        $fontWeight1 = $form_state->getValue('heading_font_weight') ?? 600;
        $fontWeight2 = $form_state->getValue('general_font_weight') ?? 400;
        $container = $form_state->getValue('container_width').'px' ?? 'none';
        if($fontName1 === $fontName2){
            $styles = "@import url('https://fonts.googleapis.com/css2?family=".$fontName1."&display=swap');";
        }else{
            $styles = "@import url('https://fonts.googleapis.com/css2?family=".$fontName1."&family=".$fontName2."&display=swap');";
        }
        $styles .= ':root {--noahs_page_builder-principal-color: '.$form_state->getValue('principal_color').';--noahs_page_builder-secondary-color: '.$form_state->getValue('secondary_color').'}';
        $styles .= 'body{color:'.$form_state->getValue('text_color').';font-family:"'.$form_state->getValue('general_font').'";font-weight:'.$fontWeight2.';}';
        $styles .= 'container{max-width:'.$container.';}';
        $styles .= 'h1, h2, h4, h4, h5, h6{';
        if(!empty($form_state->getValue('heading_color'))){$styles .= 'color:'.$form_state->getValue('heading_color').';';}
        if(!empty($form_state->getValue('heading_font') || $form_state->getValue('general_font'))){$styles .= 'font-family:"'.$form_state->getValue('heading_font').'";' ?? $form_state->getValue('general_font').'";';}
        if(!empty($form_state->getValue('heading_color'))){$styles .= 'font-weight:'.$fontWeight1.';';}
        $styles .= '}';
       


        $bbtop = $form_state->getValue('border_top') ?? '0';
        $bbright = $form_state->getValue('border_right') ?? '0';
        $bbbottom = $form_state->getValue('border_bottom') ?? '0';
        $bbleft = $form_state->getValue('border_left') ?? '0';

        $brtop = $form_state->getValue('border_radius_top') ?? '0';
        $brright = $form_state->getValue('border_radius_right') ?? '0';
        $brbottom = $form_state->getValue('border_radius_bottom') ?? '0';
        $brleft = $form_state->getValue('border_radius_left') ?? '0';

        $ptop = $form_state->getValue('padding_top') ?? '0';
        $pright = $form_state->getValue('padding_right') ?? '0';
        $pbottom = $form_state->getValue('padding_bottom') ?? '0';
        $pleft = $form_state->getValue('padding_left') ?? '0';

        $styles .= '.btn:not(.btn-admin), .btn-theme:not(.btn-admin), .button:not(.btn-admin){';
            if(!empty($form_state->getValue('button_color'))){ $styles .= 'color:'.$form_state->getValue('button_color').';';}
            if(!empty($form_state->getValue('button_bgcolor'))){ $styles .= 'background-color:'.$form_state->getValue('button_bgcolor').';';}
            if(!empty($form_state->getValue('border_type'))){ $styles .= 'border-style:'.$form_state->getValue('border_type').';' ?? "none" .';';}
            if(!empty($form_state->getValue('border_color'))){ $styles .= 'border-color:'.$form_state->getValue('border_color').';' ?? 'transparent'.';';}

            if(!empty($form_state->getValue('padding_top'))){  $styles .= 'padding-top:'.$ptop.';';}
            if(!empty($form_state->getValue('padding_right'))){  $styles .= 'padding-right:'.$pright.';';}
            if(!empty($form_state->getValue('padding_bottom'))){  $styles .= 'padding-bottom:'.$pbottom.';';}
            if(!empty($form_state->getValue('padding_left'))){  $styles .= 'padding-left:'.$pleft.';';}
            
            if(!empty($form_state->getValue('border_top'))){  $styles .= 'border-top-width:'.$bbtop.';';}
            if(!empty($form_state->getValue('border_right'))){  $styles .= 'border-right-width:'.$bbright.';';}
            if(!empty($form_state->getValue('border_bottom'))){  $styles .= 'border-bottom-width:'.$bbbottom.';';}
            if(!empty($form_state->getValue('border_left'))){  $styles .= 'border-left-width:'.$bbleft.';';}

            if(!empty($form_state->getValue('border_radius_top'))){  $styles .= 'border-top-left-radius:'.$brtop.';';}
            if(!empty($form_state->getValue('border_radius_right'))){  $styles .= 'border-top-right-radius:'.$brright.';';}
            if(!empty($form_state->getValue('border_radius_bottom'))){  $styles .= 'border-bottom-right-radius:'.$brbottom.';';}
            if(!empty($form_state->getValue('border_radius_bottom'))){  $styles .= 'border-bottom-left-radius:'.$brleft.';';}

            if(!empty($form_state->getValue('button_font-size'))){ $styles .= 'font-size:'.$form_state->getValue('size').';';}
            if(!empty($form_state->getValue('button_line_height'))){ $styles .= 'line-height:'.$form_state->getValue('button_line_height').';';}
            if(!empty($form_state->getValue('button_letter_space'))){ $styles .= 'letter-spacing:'.$form_state->getValue('button_letter_space').';';}
            if(!empty($form_state->getValue('button_word_space'))){ $styles .= 'word-spacing:'.$form_state->getValue('button_word_space').';';}
            if(!empty($form_state->getValue('button_font_wight'))){ $styles .= 'font-weight:'.$form_state->getValue('button_font_wight').';';}
            if(!empty($form_state->getValue('text_transform' ))){ $styles .= 'text-transform:'.$form_state->getValue('text_transform').';';}

        $styles .= '}';

        $styles .= '.btn:hover:not(.btn-admin), .btn-theme:hover:not(.btn-admin), .button:hover:not(.btn-admin){';
            if(!empty($form_state->getValue('button_color_hover'))){$styles .= 'color:'.$form_state->getValue('button_color_hover').';';}
            if(!empty($form_state->getValue('button_bgcolor_hover'))){$styles .= 'background-color:'.$form_state->getValue('button_bgcolor_hover').';';}
            if(!empty($form_state->getValue('border_color_hover'))){$styles .= 'border-color:'.$form_state->getValue('border_color_hover').';';}
        $styles .= '}';
        
        $styles .= 'input:not(.element-admin), select:not(.element-admin), textarea:not(.element-admin), .form-control:not(.element-admin){';
            if(!empty($form_state->getValue('input_color'))){ $styles .= 'color:'.$form_state->getValue('input_color').';';}
            if(!empty($form_state->getValue('input_bgcolor'))){ $styles .= 'background-color:'.$form_state->getValue('input_bgcolor').';';}
            if(!empty($form_state->getValue('form_border_type'))){ $styles .= 'border-style:'.$form_state->getValue('form_border_type').';' ?? "none" .';';}
            if(!empty($form_state->getValue('input_border_color'))){ $styles .= 'border-color:'.$form_state->getValue('input_border_color').';' ?? 'transparent'.';';}

            if(!empty($form_state->getValue('form_padding_top'))){  $styles .= 'fpadding-top:'.$ptop.';';}
            if(!empty($form_state->getValue('form_padding_right'))){  $styles .= 'padding-right:'.$pright.';';}
            if(!empty($form_state->getValue('form_padding_bottom'))){  $styles .= 'padding-bottom:'.$pbottom.';';}
            if(!empty($form_state->getValue('form_padding_left'))){  $styles .= 'padding-left:'.$pleft.';';}
            
            if(!empty($form_state->getValue('form_border_top'))){  $styles .= 'border-top-width:'.$bbtop.';';}
            if(!empty($form_state->getValue('form_border_right'))){  $styles .= 'border-right-width:'.$bbright.';';}
            if(!empty($form_state->getValue('form_border_bottom'))){  $styles .= 'border-bottom-width:'.$bbbottom.';';}
            if(!empty($form_state->getValue('form_border_left'))){  $styles .= 'border-left-width:'.$bbleft.';';}

            if(!empty($form_state->getValue('form_border_radius_top'))){  $styles .= 'border-top-left-radius:'.$brtop.';';}
            if(!empty($form_state->getValue('form_border_radius_right'))){  $styles .= 'border-top-right-radius:'.$brright.';';}
            if(!empty($form_state->getValue('form_border_radius_bottom'))){  $styles .= 'border-bottom-right-radius:'.$brbottom.';';}
            if(!empty($form_state->getValue('form_border_radius_bottom'))){  $styles .= 'border-bottom-left-radius:'.$brleft.';';}
        $styles .= '}';
        $styles .= 'label{';
            if(!empty($form_state->getValue('form_font_size'))){ $styles .= 'font-size:'.$form_state->getValue('form_font_size').';';}
            if(!empty($form_state->getValue('form_line_height'))){ $styles .= 'line-height:'.$form_state->getValue('form_line_height').';';}
            if(!empty($form_state->getValue('form_letter_space'))){ $styles .= 'letter-spacing:'.$form_state->getValue('form_letter_space').';';}
            if(!empty($form_state->getValue('form_word_space'))){ $styles .= 'word-spacing:'.$form_state->getValue('form_word_space').';';}
            if(!empty($form_state->getValue('form_font_wight'))){ $styles .= 'font-weight:'.$form_state->getValue('form_font_wight').';';}
            if(!empty($form_state->getValue('form_text_transform' ))){ $styles .= 'text-transform:'.$form_state->getValue('form_text_transform').';';}
        $styles .= '}';

        $styles .= $form_state->getValue('noahs_page_builder_custom_css');
        
        
        $theme = \Drupal::theme()->getActiveTheme()->getName();
        noahs_page_builder_generate_css($theme, $styles, 'noahs_page_builder_general');


        $form_state->cleanValues();
        $values = $form_state->getValues();



        $form_state->cleanValues();
        $values = $form_state->getValues();
        
        $config = $this->config('noahs_page_builder.settings');
        
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                // Si es un array, se asume que son valores anidados
                foreach ($value as $sub_key => $sub_value) {
                    $config->set("$key.$sub_key", $sub_value);
                }
            } else {
                // Si no es un array, se asume un campo simple
                $config->set($key, $value);
            }
        }
        
        $config->save();

        drupal_flush_all_caches();

        // drupal_flush_all_caches();
        return parent::submitForm($form, $form_state);
    }

}
