<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_node_field extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_7603951" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m494.5 173.5h-29.21c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h29.21c1.379 0 2.5 1.122 2.5 2.5v130c0 1.378-1.121 2.5-2.5 2.5h-372.119v-135h307.909c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-307.909v-15.582h17.628c5.79 0 10.5-4.71 10.5-10.5v-23c0-5.79-4.71-10.5-10.5-10.5h-79.255c-5.79 0-10.5 4.71-10.5 10.5v23c0 5.79 4.71 10.5 10.5 10.5h17.627v15.582h-60.881c-9.649 0-17.5 7.851-17.5 17.5v70.01c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-70.01c0-1.378 1.122-2.5 2.5-2.5h60.881v135h-60.881c-1.378 0-2.5-1.122-2.5-2.5v-24.99c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v24.99c0 9.649 7.851 17.5 17.5 17.5h60.881v15.582h-17.627c-5.79 0-10.5 4.71-10.5 10.5v23c0 5.79 4.71 10.5 10.5 10.5h79.255c5.79 0 10.5-4.71 10.5-10.5v-23c0-5.79-4.71-10.5-10.5-10.5h-17.628v-15.582h372.119c9.649 0 17.5-7.851 17.5-17.5v-130c0-9.649-7.851-17.5-17.5-17.5zm-358.991 195.582v14h-70.255v-14h17.627c5.79 0 10.5-4.71 10.5-10.5v-205.164c0-5.79-4.71-10.5-10.5-10.5h-17.627v-14h70.255v14h-17.628c-5.79 0-10.5 4.71-10.5 10.5v205.164c0 5.79 4.71 10.5 10.5 10.5z"></path><path d="m157.808 286.451c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h47.753c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5z"></path><path d="m254.124 286.451c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h47.753c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path><path d="m350.439 286.451c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h47.753c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path></g></svg>',
            'title' => 'Drupal Node Field',
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
      
            $definitions = \Drupal::service('entity_field.manager')->getFieldDefinitions('node', 'page');

            // Load a node for which you want to get the field values


            // Iterate through the definitions
            $options = [];
            $options[] = 'Select tour fied';
            foreach ($definitions as $field_name => $field_definition) {
               $options[$field_name] = (string)$field_definition->getLabel();
            }

            $form['drupal_field'] = [
               'type'    => 'select',
               'title'   => t('Field'),
               'tab' => 'section_content',
               'options' =>  $options,
            ];
            $form['wrapp_element'] = [
               'type'    => 'select',
               'title'   => t('Fied Wrapper'),
               'tab' => 'section_content',
               'options' =>  [
                  '' => 'Div',
                  'section' => 'Section',
                  'header' => 'Header',
                  'footer' => 'Footer',
                  'nav' => 'Nav',
                  'article' => 'Article',
                  'aside' => 'Aside',
                  'h1' => 'Heading 1',
                  'h2' => 'Heading 2',
                  'h3' => 'Heading 3',
                  'h4' => 'Heading 4',
                  'h5' => 'Heading 5',
                  'h6' => 'Heading 6',
                  'p' => 'Paragraph',
                  'span' => 'Span',
               ],
            ];
            return $form;

      }

      public function template( $settings ){

         $settings = $settings->element;


   

         $element = '[node_fied]';

         
         if(!empty($settings->drupal_field)){
         $node = \Drupal::routeMatch()->getParameter('node');
            if(!empty($node)){
            $entity_type = 'node';
               $view_mode = 'teaser';
                   

               $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');
               $build = $node->get($settings->drupal_field)->view('teaser');



               $element =  \Drupal::service('renderer')->render($build);
            }
         }
       
         $output = '<div class="widget-content">';
         $output .=  '<' . ($settings->wrapp_element ?? 'div') . '>';
         $output .=  $element;
         $output .=  '</' . ($settings->wrapp_element ?? 'div') . '>';
         $output .= '</div>';

         return $output;   
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



