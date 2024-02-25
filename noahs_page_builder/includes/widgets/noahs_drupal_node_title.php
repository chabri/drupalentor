<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_node_title extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-font"></i>',
            'title' => 'Drupal Node Title',
            'description' => 'Description',
            'group' => 'Drupal'
         ];
      }
      
      public function render_form(){
           
            // Section Content
            $form['section_content'] = [
               'type' => 'tab',
               'title' =>  t('Content')
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
               'update_selector_html' => '.widget-content > *',
               'open' => 'show'
   
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
        
         $settings = $settings->element;
        
         $node = \Drupal::routeMatch()->getParameter('node');
         if(!empty($node)){
            $title =  $node->getTitle();
         }else{
            $title = 'Page Title';
         }

         $ouput = '';
         $ouput .= '<div class="widget-content d-flex w-100">';
         $ouput .=  '<' . ($settings->heading_type ?? 'h1') . '>';
         $ouput .=  '<span>' . $title . '</span>';
         $ouput .=  '</' . ($settings->heading_type ?? 'h1') . '>';
         $ouput .= '</div>';

         return $ouput;  
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



