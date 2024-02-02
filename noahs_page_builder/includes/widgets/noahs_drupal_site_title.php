<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_site_title extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-font"></i>',
            'title' => 'Drupal Site Title',
            'description' => 'Description',
            'group' => 'Drupal'
         ];
      }
      
      public function render_form(){
         $form = [];


   
            // Section Content
            $form['section_content'] = [
               'type' => 'tab',
               'title' =>  t('Content')
            ];
      
   
            $form['site_title_type'] = [
               'type'      => 'select',
               'tab'     => 'section_content',
               'title'     => ('Type'),
               'options' => [
                  'h1' => 'H1',
                  'h2' => 'H2',
                  'h3' => 'H3',
                  'h4' => 'H4',
                  'h5' => 'H5',
                  'h6' => 'H6',
               ],
               'update_selector_html' => '.widget-content > *' 
   
            ];
   
            $form['horizontal_align'] = [
               'type'    => 'select',
               'title'   => t('Horizontal Align'),
               'tab' => 'section_content',
               'style_type' => 'style',
               'style_selector' => '.widget-content', 
               'style_css' => 'justify-content',
               'responsive' => true,
               'options' => [
                  '' => 'Por defecto',
                  'flex-start' => 'Start',
                  'center' => 'Center',
                  'flex-end' => 'End',
                  'space-between' => 'Space Betwenn',
                  'space-around' => 'Space Around',
                  'space-evenly' => 'Space Evenly'
               ]
            ];
   
            $form['section_style'] = [
               'type' => 'tab',
               'title' =>  t('Style')
            ];
   
          $form['font'] = [
               'type'        => 'noahs_font',
               'title'       => t('Font'),
               'tab'     => 'section_style',
               'style_type' => 'style',
               'style_selector' => 'widget', 
               'responsive' => true,
              ];
            return $form;

      }

      public function template( $settings ){
         $config = \Drupal::config('system.site');

         $ouput = '';
         $ouput .= '<div class="widget-content d-flex w-100">';
         $ouput .=  '<' . ($settings['element']['site_title_type'] ?? 'h1') . '>';
         $ouput .=  '<span>' . $config->get('name') . '</span>';
         $ouput .=  '</' . ($settings['element']['site_title_type'] ?? 'h1') . '>';
         $ouput .= '</div>';

         return $ouput;   
      }
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



