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
            '#default_value' => $settings->get('container_width') ?? '1280',
            '#placeholder' => 1140,
            '#field_suffix' => 'px',
            '#description' => t("Sets the default width of the content area (Default: 1140)"),
            '#group' => 'style',
        );

        $form['style']['viewport_lg'] = array(
            '#type' => 'number',
            '#title' => 'Tablet Breakpoint',
            '#default_value' => $settings->get('viewport_lg') ?? '1025',
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
        $form['buttons']['button_style'] = [
          '#type' => 'drupalentor_button_style',
          '#default_value' => [
            'border_top' => $settings->get('button_style')['normal']['border_style']['border_top'] ?? '',
            'border_right' => $settings->get('button_style')['normal']['border_style']['border_right'] ?? '',
            'border_bottom' => $settings->get('button_style')['normal']['border_style']['border_bottom'] ?? '',
            'border_left' => $settings->get('button_style')['normal']['border_style']['border_left'] ?? '',
            'border_type' => $settings->get('button_style')['normal']['border_style']['border_type'] ?? 'solid',
            'border_color' => $settings->get('button_style')['normal']['border_style']['border_color'] ?? '',
            'border_color_hover' => $settings->get('button_style')['hover']['border_color_hover'] ?? '',
            'button_color' => $settings->get('button_style')['normal']['button_color'] ?? '',
            'button_color_hover' => $settings->get('button_style')['hover']['button_color_hover'] ?? '',
            'button_bgcolor' => $settings->get('button_style')['normal']['button_bgcolor'] ?? '',
            'button_bgcolor_hover' => $settings->get('button_style')['hover']['button_bgcolor_hover'] ?? '',
            'border_bgcolor' => $settings->get('button_style')['normal']['border_bgcolor'] ?? '',
            'border_radius_top' => $settings->get('button_style')['general']['border_radius']['border_radius_top'] ?? '',
            'border_radius_right' => $settings->get('button_style')['general']['border_radius']['border_radius_right'] ?? '',
            'border_radius_bottom' => $settings->get('button_style')['general']['border_radius']['border_radius_bottom'] ?? '',
            'border_radius_left' => $settings->get('button_style')['general']['border_radius']['border_radius_left'] ?? '',
            'border_radius_type' => $settings->get('button_style')['general']['border_radius']['border_radius_type'] ?? 'px',
            'padding_top' => $settings->get('button_style')['general']['button_padding']['padding_top'] ?? '8',
            'padding_right' => $settings->get('button_style')['general']['button_padding']['padding_right'] ?? '15',
            'padding_bottom' => $settings->get('button_style')['general']['button_padding']['padding_bottom'] ?? '8',
            'padding_left' => $settings->get('button_style')['general']['button_padding']['padding_left'] ?? '15',
            'padding_type' => $settings->get('button_style')['general']['button_padding']['padding_type'] ?? 'px',
          ],
          '#group' => 'buttons',
        ];                
        
        /* =========================   Custom Css  ========================= */
        
        $form['custom_css'] = [
            '#type' => 'fieldset',
            '#title' => t('Custom Css'),
            '#attributes' => array('style' => array('margin-top:25px')),
        ];
        
        $form['custom_css']['drupalentor_custom_css'] = [
            '#type' => 'textarea',
            '#rows' => 15,
            '#title' => $this->t('CSS Code'),
            '#default_value' => $settings->get('drupalentor_custom_css'),
            '#description' => $this->t('Please enter custom style without <b> @style </b> tag.', ["@style" => '<style>']) ,
            '#attributes' => array('class' => array('codemirror-texarea')),
//            '#group' => 'custom_css',
        ];


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
        
        $fontName1 = str_replace(" ", "+", $form_state->getValue('heading_font') ?? 'Playfair Display');
        $fontName2 = str_replace(" ", "+", $form_state->getValue('general_font') ?? 'Playfair Display');
        $fontWeight1 = $form_state->getValue('heading_font_weight') ?? 600;
        $fontWeight2 = $form_state->getValue('general_font_weight') ?? 400;
        $container = $form_state->getValue('container_width').'px' ?? 'none';
        if($fontName1 === $fontName2){
            $styles = "@import url('https://fonts.googleapis.com/css2?family=".$fontName1."&display=swap');";
        }else{
            $styles = "@import url('https://fonts.googleapis.com/css2?family=".$fontName1."&family=".$fontName2."&display=swap');";
        }
        $styles .= ':root {--drupalentor-principal-color: '.$form_state->getValue('principal_color').';--drupalentor-secondary-color: '.$form_state->getValue('secondary_color').'}';
        $styles .= 'body{color:'.$form_state->getValue('text_color').';font-family:"'.$form_state->getValue('general_font').'";font-weight:'.$fontWeight2.';}';
        $styles .= 'container{max-width:'.$container.';}';
        $styles .= 'h1, h2, h4, h4, h5, h6{';
        if(!empty($form_state->getValue('heading_color'))){$styles .= 'color:'.$form_state->getValue('heading_color').';';}
        if(!empty($form_state->getValue('heading_font') || $form_state->getValue('general_font'))){$styles .= 'font-family:"'.$form_state->getValue('heading_font').'";' ?? $form_state->getValue('general_font').'";';}
        if(!empty($form_state->getValue('heading_color'))){$styles .= 'font-weight:'.$fontWeight1.';';}
        $styles .= '}';
       
        
        $buttonNormal = $form_state->getValue('button_style')['normal'];
        $buttonHover = $form_state->getValue('button_style')['hover'];
        $buttonGeneral = $form_state->getValue('button_style')['general'];

        $bbtop = $buttonNormal['border_style']['border_top'] ?? '0';
        $bbright = $buttonNormal['border_style']['border_right'] ?? '0';
        $bbbottom = $buttonNormal['border_style']['border_bottom'] ?? '0';
        $bbleft = $buttonNormal['border_style']['border_left'] ?? '0';
        $bbtype = $buttonNormal['border_style']['border_radius_type'] ?? 'px';

        $brtop = $buttonGeneral['border_radius']['border_radius_top'] ?? '0';
        $brright = $buttonGeneral['border_radius']['border_radius_right'] ?? '0';
        $brbottom = $buttonGeneral['border_radius']['border_radius_bottom'] ?? '0';
        $brleft = $buttonGeneral['border_radius']['border_radius_left'] ?? '0';

        $ptop = $buttonGeneral['button_padding']['padding_top'] ?? '0';
        $pright = $buttonGeneral['button_padding']['padding_right'] ?? '0';
        $pbottom = $buttonGeneral['button_padding']['padding_bottom'] ?? '0';
        $pleft = $buttonGeneral['button_padding']['padding_left'] ?? '0';
        $ptype = $buttonGeneral['button_padding']['padding_type'] ?? 'px';

        $styles .= '.btn, .btn-theme, .button{';
        $styles .= 'color:'.$buttonNormal['button_color'].';';
        $styles .= 'background-color:'.$buttonNormal['button_bgcolor'].';';
        $styles .= 'border-style:'.$buttonNormal['border_style']['border_type'].';' ?? "none" .';';
        $styles .= 'border-color:'.$buttonNormal['border_style']['border_color'].';' ?? 'transparent'.';';
        $styles .= 'border-width:'.$bbtop.$bbtype.' ' . $bbright.$bbtype.' ' . $bbbottom.$bbtype.' ' . $bbleft.$bbtype.';';
        $styles .= 'border-radius:'.$brtop.$ptype.' ' . $brright.$ptype.' ' . $brbottom.$ptype.' ' . $brleft.$ptype.';';
        $styles .= '}';

        $styles .= '.btn:hover, .btn-theme:hover, .button:hover{';
        $styles .= 'color:'.$buttonHover['button_color_hover'].';';
        $styles .= 'background-color:'.$buttonHover['button_bgcolor_hover'].';';
        $styles .= 'border-color:'.$buttonHover['border_color_hover'].';';
        $styles .= '}';
        
        $styles .= $form_state->getValue('drupalentor_custom_css');
        
        
        $theme = \Drupal::theme()->getActiveTheme()->getName();
        drupalentor_generate_css($theme, $styles, $name='drupalentor_general');
        
        $config = $this->config('drupalentor.settings');
        $config->set('container_width', $form_state->getValue('container_width'));
        $config->set('viewport_lg', $form_state->getValue('viewport_lg'));
        $config->set('viewport_md', $form_state->getValue('viewport_md'));
        $config->set('google_font_api', $form_state->getValue('google_font_api'));
        $config->set('heading_font', $form_state->getValue('heading_font'));
        $config->set('general_font', $form_state->getValue('general_font'));
        $config->set('heading_font_weight', $form_state->getValue('heading_font_weight'));
        $config->set('general_font_weight', $form_state->getValue('general_font_weight'));
        $config->set('principal_color', $form_state->getValue('principal_color'));
        $config->set('secondary_color', $form_state->getValue('secondary_color'));
        $config->set('heading_color', $form_state->getValue('heading_color'));
        $config->set('text_color', $form_state->getValue('text_color'));
        $config->set('button_style', $form_state->getValue('button_style'));
        $config->set('drupalentor_custom_css', $form_state->getValue('drupalentor_custom_css'));

        $config->save();
        drupal_flush_all_caches();
        return parent::submitForm($form, $form_state);
    }

}
