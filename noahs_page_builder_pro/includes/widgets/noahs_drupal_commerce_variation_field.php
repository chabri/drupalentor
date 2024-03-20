<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_commerce_variation_field extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_7603951" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m494.5 173.5h-29.21c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h29.21c1.379 0 2.5 1.122 2.5 2.5v130c0 1.378-1.121 2.5-2.5 2.5h-372.119v-135h307.909c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-307.909v-15.582h17.628c5.79 0 10.5-4.71 10.5-10.5v-23c0-5.79-4.71-10.5-10.5-10.5h-79.255c-5.79 0-10.5 4.71-10.5 10.5v23c0 5.79 4.71 10.5 10.5 10.5h17.627v15.582h-60.881c-9.649 0-17.5 7.851-17.5 17.5v70.01c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-70.01c0-1.378 1.122-2.5 2.5-2.5h60.881v135h-60.881c-1.378 0-2.5-1.122-2.5-2.5v-24.99c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v24.99c0 9.649 7.851 17.5 17.5 17.5h60.881v15.582h-17.627c-5.79 0-10.5 4.71-10.5 10.5v23c0 5.79 4.71 10.5 10.5 10.5h79.255c5.79 0 10.5-4.71 10.5-10.5v-23c0-5.79-4.71-10.5-10.5-10.5h-17.628v-15.582h372.119c9.649 0 17.5-7.851 17.5-17.5v-130c0-9.649-7.851-17.5-17.5-17.5zm-358.991 195.582v14h-70.255v-14h17.627c5.79 0 10.5-4.71 10.5-10.5v-205.164c0-5.79-4.71-10.5-10.5-10.5h-17.627v-14h70.255v14h-17.628c-5.79 0-10.5 4.71-10.5 10.5v205.164c0 5.79 4.71 10.5 10.5 10.5z"></path><path d="m157.808 286.451c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h47.753c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5z"></path><path d="m254.124 286.451c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h47.753c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path><path d="m350.439 286.451c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h47.753c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path></g></svg>',
            'title' => 'Drupal Commerce Variation Field',
            'description' => 'Description',
            'group' => 'Ecommerce'
         ];
      }
      
      public function render_form(){
         $form = [];
        

         $media_types = \Drupal::entityTypeManager()->getStorage('commerce_product')->loadMultiple();
         $products = [];
         $products[''] = 'Select your product';
         foreach ($media_types as $menu_entity) {
           $products[$menu_entity->id() .','.  $menu_entity->bundle()] = $menu_entity->label();
         }
   
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];

         $options = $this->productFields('commerce_product_variation_type', 'commerce_product_variation');
  
         $form['drupal_field'] = [
            'type'    => 'select',
            'title'   => t('Field'),
            'tab' => 'section_content',
            'select_group'    => true,
            'options' =>  $options,
            'attributes' => [
               'data-select-2' => true,
            ],
         ];

         if (strpos(getEntityid('nid'), "commerce_") === false) {
            $form['noahs_commerce_product'] = [
               'type'    => 'select',
               'title'   => t('Field of Product'),
               'tab' => 'section_content',
               'options' =>  $products,
               'attributes' => [
                  'data-entity-id' => 'commerce_product',
               ],
            ];
            $form['product_view_options'] = [
               'type'    => 'select',
               'title'   => t('View Product'),
               'tab' => 'section_content',
               'options' =>  [],
            ];
         }

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
         $form['wrapp_element_class'] = [
            'type'    => 'text',
            'title'   => t('Wrapper Class'),
            'tab' => 'section_content',
         ];

         $form['horizontal_align_structures'] = [
            'type'    => 'select',
            'title'   => t('Horizontal Align'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => 'widget', 
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

         $form['horizontal_align'] = [
            'type'    => 'select',
            'title'   => t('Text Align'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => 'widget', 
            'style_css' => 'text-align',
            'responsive' => true,
            'options' => [
               '' => 'Por defecto',
               'left' => 'Left',
               'center' => 'Center',
               'right' => 'Right',
            ]
         ];
         return $form;

      }

      public function template( $settings ){

         $settings = $settings->element;

         $element = '[commerce_variation_field]';
         $variantion_class = '';
 
         if(!empty($settings->drupal_field)){
         
            $element = '[commerce_variation_'.$settings->drupal_field.']';
      
            if(!empty($settings->noahs_commerce_product)){
               $product = \Drupal::entityTypeManager()->getStorage('commerce_product')->load(explode(",", $settings->noahs_commerce_product)[0]);
   
               $variation = $product->getVariations()[0];
               $view_mode = !empty($settings->product_view_options) ?  $settings->product_view_options : 'default';
               $build = $variation->get($settings->drupal_field)->view($view_mode);
               $renderer = \Drupal::service('renderer');
               $element = $renderer->render($build);
            }else{
               $node = \Drupal::routeMatch()->getParameter('commerce_product');
               if(!empty($node)){
                  $view_mode = 'noahs_product_variation';
                  // $view_builder = \Drupal::entityTypeManager()->getViewBuilder('commerce_product_variation');
                  $variation = $node->getVariations()[0];
                  $build = $variation->get($settings->drupal_field)->view($view_mode);
                  $renderer = \Drupal::service('renderer');
                  $element = $renderer->render($build);
               }
               
            }
            $variantion_class = str_replace('-', '_', $settings->drupal_field);
         }

         $output = '<div class="widget-content">';
         $output .= '<div class="product--variation-field--variation_'.$variantion_class.'__1">' .  $element . '</div>';
         $output .= '</div>';

         return $output;   
      }

      private function productFields($storageType, $definitionType){
         $entityTypeManager = \Drupal::service('entity_type.manager');

         $fieldManager = \Drupal::service('entity_field.manager');
         $bundles = $entityTypeManager->getStorage($storageType)->loadMultiple();

         $options = [];
         $options['empty']['text'] = 'Empty';
         $options['empty']['options'][] = 'Select Your field';

         foreach ($bundles as $bundle) {
         $bundle_id = $bundle->id();
         $bundle_label = $bundle->label();
         $fieldDefinitions = $fieldManager->getFieldDefinitions($definitionType, $bundle_id);
         
         $bundle_options = [];
         $options[$bundle_id]['text'] = $bundle_label;

         foreach ($fieldDefinitions as $fieldName => $fieldDefinition) {
            $fieldType = $fieldDefinition->getType();
            $fieldLabel =  (string)$fieldDefinition->getLabel();
            
      
            $bundle_options[$fieldName] = $fieldLabel;
         }

         $options[$bundle_id]['options'] = $bundle_options;
         }
         
         return $options;
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



