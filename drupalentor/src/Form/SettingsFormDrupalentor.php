<?php

namespace Drupal\drupalentor\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures drupalentor settings.
 */
class SettingsFormDrupalentor extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalentor-settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['drupalentor.settings'];
  }

    /**
        * {@inheritdoc}
    */
    private $fonts = false;

    
    public function buildForm(array $form, FormStateInterface $form_state) {
      
        $settings = $this->config('drupalentor.settings');
        $form['#attached']['library'][] = 'drupalentor/drupalentor.assets.settings';
        $pallete_color = [];
        $pallete_color[] = $settings->get('principal_color') ?? '#2389ab';
        $pallete_color[] = $settings->get('secondary_color') ?? '#4a4a4a';
//        $pallete_color = implode(', ', $pallete_color);
        $form['#attached']['drupalSettings']['drupalentor']['pallete_color'] = $pallete_color;

//        $fonts = $this->get_google_fonts();
        $node_types = \Drupal\node\Entity\NodeType::loadMultiple();
        $node_types_options = [];

        foreach ($node_types as $node_type) {
            $node_types_options[$node_type->id()] = $node_type->label();
        }

        $form['tabs'] = [
            '#type' => 'horizontal_tabs',
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
            '#default_value' => $settings->get('container_width'),
            '#placeholder' => 1140,
            '#field_suffix' => 'px',
            '#description' => t("Sets the default width of the content area (Default: 1140)"),
            '#group' => 'style',
        );

        $form['style']['viewport_lg'] = array(
            '#type' => 'number',
            '#title' => 'Tablet Breakpoint',
            '#default_value' => $settings->get('viewport_lg'),
            '#placeholder' => 1025,
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
        
        
        /* =========================   Fonts  ========================= */
        
        
        $form['fonts'] = [
            '#type' => 'details',
            '#title' => t('Fonts'),
            '#group' => 'tabs',
        ];
        $form['fonts']['google_font_api'] = array(
            '#type' => 'textfield',
            '#title' => 'Google Font API',
            '#default_value' => $settings->get('google_font_api') ? $settings->get('google_font_api') : '',
            '#description' => t("Paste here your google font api. <a href='https://developers.google.com/fonts/docs/developer_api' target='_blank'>Get your API here</a>"),
            '#group' => 'fonts',
        );
        $google_font_api = $settings->get('google_font_api') ? $settings->get('google_font_api') : '';
        $fonts = $this->get_google_fonts($google_font_api);

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
            '#default_value' => $settings->get('heading_font_weight') ? $settings->get('heading_font_weight') : '',
            '#description' => t("Set font weight"),
            '#options' => [
                "100" => "100",
                "200" => "200",
                "300" => "300",
                "400" => "400",
                "500" => "500",
                "600" => "600",
                "700" => "700",
                "800" => "800",
                "900" => "900",
                "" => "Por defecto",
                "normal" => "Normal",
                "bold" => "Bold",
                ],
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
            '#default_value' => $settings->get('general_font_weight') ? $settings->get('general_font_weight') : '',
            '#description' => t("Set font weight"),
            '#options' => [
                "100" => "100",
                "200" => "200",
                "300" => "300",
                "400" => "400",
                "500" => "500",
                "600" => "600",
                "700" => "700",
                "800" => "800",
                "900" => "900",
                "" => "Por defecto",
                "normal" => "Normal",
                "bold" => "Bold",
                ],
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
            '#title' => t('Settings Colors'),
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
        $form['buttons']['button_styles'] = [
            '#type' => 'fieldset',
            '#title' => t('Button Styles'),
            '#group' => 'buttons',
        ];
        $form['buttons']['button_styles']['border_radius'] = array(
            '#type' => 'margin',
            '#title' => 'Border Radius',
            '#default_value' => [
                'selectMarginType' => '',
                'marginTop' => '',
                'marginRight' => '',
                'marginBottom' => '',
                'marginLeft' => '',
            ],
            '#description' => t("border radius"),
            '#group' => 'button_styles',
        );
        return parent::buildForm($form, $form_state);
    }
    public function get_google_fonts($api) {
        $options = [];
        $url = "https://www.googleapis.com/webfonts/v1/webfonts?key=".$api;
        //        dump($url);
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

                foreach ( $result['items'] as $k => $v ) {

                    $options[$v['family']] = $v['family'];
                }
        return $options;
    }
  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('drupalentor.settings');
        $config->set('google_font_api', $form_state->getValue('google_font_api'));
        $config->set('heading_font', $form_state->getValue('heading_font'));
        $config->set('general_font', $form_state->getValue('general_font'));
        $config->set('container_width', $form_state->getValue('container_width'));
        $config->set('viewport_lg', $form_state->getValue('viewport_lg'));
        $config->set('viewport_md', $form_state->getValue('viewport_md'));
        $config->set('heading_color', $form_state->getValue('heading_color'));
        $config->save();
        return parent::submitForm($form, $form_state);
    }

}
