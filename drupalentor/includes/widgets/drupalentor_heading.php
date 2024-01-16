<?php 

use Drupal\drupalentor\WidgetBase;

   class element_drupalentor_heading extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-heading"></i>',
            'title' => 'Heading',
            'description' => 'Description',
            'group' => 'Drupalentor'
         ];
      }
      public function render_form(){
         $form = [];

         // Section Content
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
   
         $form['heading_text'] = [
            'type'      => 'text',
            'tab'     => 'section_content',
            'title'     => ('Hadline'),
            'update_selector' => '.widget-content span' 
         ];

         $form['heading_type'] = [
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
            'type'        => 'drupalentor_font',
            'title'       => t('Font'),
            'tab'     => 'section_style',
            'style_type' => 'style',
            'style_selector' => 'widget', 
            'responsive' => true,
           ];
         return $form;
      }

      public static function template( $settings ){

         $ouput = '';
         $ouput .= '<div class="widget-content d-flex w-100">';
         $ouput .=  '<' . ($settings['element']['heading_type'] ?? 'h1') . '>';
         $ouput .=  '<span>' . (!empty($settings['element']['text']) ? $settings['element']['text'] : 'Your Title Here') . '</span>';
         $ouput .=  '</' . ($settings['element']['heading_type'] ?? 'h1') . '>';
         $ouput .= '</div>';

         return $ouput;
      }

      public function render_content($section, $settings = null, $content = null) {
       
         return $this->wrapper($section, $settings, $this->template($settings));
      }
   }




