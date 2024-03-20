<?php 

use Drupal\commerce_product\Entity\ProductType;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\commerce_product\Entity\ProductInterface;

use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_product extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_9710013" enable-background="new 0 0 512.001 512.001" height="512" viewBox="0 0 512.001 512.001" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m506.258 116.716-246-115.765c-2.696-1.269-5.819-1.269-8.516 0l-246 115.765c-3.505 1.649-5.742 5.175-5.742 9.048v85.234c0 5.523 4.477 10 10 10s10-4.477 10-10v-69.478l226 106.336v238.386l-226-106.353v-78.892c0-5.523-4.477-10-10-10s-10 4.477-10 10v85.238c0 3.874 2.237 7.399 5.742 9.048l246 115.765c1.348.634 2.803.952 4.258.952s2.91-.317 4.258-.952l246-115.765c3.505-1.649 5.742-5.175 5.742-9.048v-260.471c0-3.873-2.236-7.399-5.742-9.048zm-250.178 113.78-99.583-46.855 62.495-29.409 99.575 46.859zm-222.592-104.732 62.505-29.414 99.514 46.83-62.497 29.41zm136.521-64.245 222.574 104.741-50.53 23.779-222.574-104.741zm181.984 145.946 54.016-25.419v50.258l-54.016 25.419zm64.076-52.257-99.575-46.859 62.506-29.415 99.575 46.859zm-160.068-134.156 99.514 46.83-62.506 29.415-99.514-46.83zm10 465.191v-238.311l65.992-31.055v56.604c0 3.423 1.751 6.609 4.642 8.443 1.628 1.033 3.49 1.557 5.359 1.557 1.45 0 2.904-.315 4.257-.952l74.016-34.831c3.505-1.649 5.742-5.175 5.742-9.048v-66.016l65.991-31.055v238.311z"></path><path d="m64.258 345.458c-5-2.352-10.955-.207-13.306 4.791-2.351 4.997-.207 10.955 4.791 13.306l22.434 10.557c1.376.647 2.825.954 4.251.954 3.753 0 7.351-2.124 9.055-5.745 2.352-4.997.207-10.955-4.791-13.306z"></path><path d="m108.386 337.281c3.753 0 7.351-2.124 9.055-5.745 2.352-4.997.207-10.954-4.79-13.306l-48.393-22.773c-4.999-2.354-10.955-.208-13.306 4.79-2.352 4.997-.207 10.955 4.79 13.306l48.393 22.772c1.376.65 2.825.956 4.251.956z"></path><path d="m457.468 271.388c-2.828-1.847-6.397-2.14-9.489-.782l-146 64.145c-3.632 1.596-5.978 5.188-5.978 9.155v79.306c0 3.423 1.751 6.609 4.642 8.443 1.627 1.033 3.489 1.557 5.358 1.557 1.45 0 2.904-.315 4.257-.952l146-68.707c3.505-1.649 5.742-5.174 5.742-9.048v-74.745c.001-3.376-1.704-6.525-4.532-8.372zm-141.468 79.047 69.054-30.339v54.862l-69.054 32.497zm126.001-2.275-36.946 17.386v-54.236l36.946-16.232z"></path><path d="m10.002 265.998c2.56 0 5.121-.977 7.073-2.93 3.905-3.905 3.905-10.236 0-14.142s-10.236-3.905-14.142 0l-.003.003c-3.905 3.905-3.904 10.235.001 14.14 1.954 1.953 4.512 2.929 7.071 2.929z"></path></g></g></svg>',
            'title' => 'Product',
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
     

            // Section Content
            $form['section_content'] = [
               'type' => 'tab',
               'title' =>  t('Content')
            ];
            $form['group_menu'] = [
               'type' => 'group',
               'title' =>  t('Content'),
               'tab' => 'section_content',
            ];

            $form['noahs_commerce_product'] = [
               'type'    => 'select',
               'title'   => t('Product'),
               'tab' => 'section_content',
               'options' =>  $products,
               'group' => 'group_menu',
               'attributes' => [
                  'data-entity-id' => 'commerce_product',
               ],
            ];
            
            $form['product_view_options'] = [
               'type'    => 'select',
               'title'   => t('Product'),
               'tab' => 'section_content',
               'options' =>  [],
               'group' => 'group_menu'
            ];
   
            $form['product_view_value'] = [
               'type'    => 'hidden',
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];
   
            $form['section_styles'] = [
               'type' => 'tab',
               'title' => t('Styles')
            ];
   
            $form['image_group'] = [
               'type' => 'group',
               'title' => t('Image'),
               'tab' => 'section_styles',
            ];
      
            $form['image_width'] = [
               'type' => 'text',
               'title' => t('Image Width'),
               'tab' => 'section_styles',
               'group' => 'image_group',
               'style_type' => 'style',
               'style_selector' => 'img', 
               'style_css' => 'max-width', 
               'responsive' => true,
            ];
            $form['image_background_color'] = [
               'type' => 'noahs_color',
               'title' => t('Background Color'),
               'tab' => 'section_styles',
               'group' => 'image_group',
               'style_type' => 'style',
               'style_selector' => 'img', 
               'style_css' => 'background-color', 
               'style_hover' => true,
               'responsive' => true,
            ];
   
            $form['image_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'group' => 'image_group',
               'style_type' => 'style',
               'style_selector' => 'img', 
               'style_css' => 'border', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['image_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'image_group',
               'style_type' => 'style',
               'style_selector' => 'img', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['image_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'group' => 'image_group',
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'img', 
               'style_css' => 'padding', 
               'responsive' => true,
               'style_hover' => true,
            ];
            $form['image_shadows'] = [
               'type'    => 'noahs_shadows',
               'title'   => t('Image Shadow'),
               'group' => 'image_group',
               'style_type' => 'style',
               'style_selector' => '.widget-image-src', 
               'responsive' => true, 
               'style_hover' => true,
            ];
            $form['image_border_radius'] = [
               'type'    => 'noahs_radius',
               'title'   => t('Border Radius'),
               'tab' => 'section_styles',
               'group' => 'image_group',
               'style_type' => 'style',
               'style_selector' => '.widget-image-src', 
               'responsive' => true, 
               'style_hover' => true,
            ];

            $form['title_group'] = [
               'type' => 'group',
               'title' => t('Title'),
               'tab' => 'section_styles',
            ];
            
            $form['title_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'group' => 'title_group',
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.field-title', 
               'responsive' => true,
            ];
            $form['title_align'] = [
               'type'    => 'select',
               'title'   => t('Text Align'),
               'tab' => 'section_styles',
               'group' => 'title_group',
               'style_type' => 'style',
               'style_selector' => '.field-title', 
               'style_css' => 'text-align',
               'responsive' => true,
               'options' => [
                  '' => 'Left',
                  'center' => 'Center',
                  'right' => 'Right',
               ]
            ];

            $form['title_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'title_group',
               'style_type' => 'style',
               'style_selector' => '.field-title', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];

            $form['price_group'] = [
               'type' => 'group',
               'title' => t('Price'),
               'tab' => 'section_styles',
            ];

            $form['price_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'group' => 'price_group',
               'style_type' => 'style',
               'style_selector' => '.field-price', 
               'responsive' => true,
            ];
            $form['price_align'] = [
               'type'    => 'select',
               'title'   => t('Text Align'),
               'tab' => 'section_styles',
               'group' => 'price_group',
               'style_type' => 'style',
               'style_selector' => 'field-price', 
               'style_css' => 'text-align',
               'responsive' => true,
               'options' => [
                  '' => 'Left',
                  'center' => 'Center',
                  'right' => 'Right',
               ]
            ];
            $form['price_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'price_group',
               'style_type' => 'style',
               'style_selector' => '.field-price', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];

            $form['list_group'] = [
               'type' => 'group',
               'title' => t('List Price'),
               'tab' => 'section_styles',
            ];

            $form['list_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'group' => 'list_group',
               'style_type' => 'style',
               'style_selector' => '.field-list-price', 
               'responsive' => true,
            ];
            $form['list_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'list_group',
               'style_type' => 'style',
               'style_selector' => '.field-list-price', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];

            $form['sku_group'] = [
               'type' => 'group',
               'title' => t('SKU'),
               'tab' => 'section_styles',
            ];

            $form['sku_font'] = [
               'type' => 'noahs_font',
               'tab' => 'section_styles',
               'title' => t('Font'),
               'group' => 'sku_group',
               'style_type' => 'style',
               'style_selector' => '.field-sku', 
               'responsive' => true,
            ];
            $form['sku_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'sku_group',
               'style_type' => 'style',
               'style_selector' => '.field-sku', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];

            $form['button_group'] = [
               'type' => 'group',
               'title' => t('Button'),
               'tab' => 'section_styles',
            ];
   
            $form['btn_background_color'] = [
               'type' => 'noahs_color',
               'title' => t('Background Color'),
               'tab' => 'section_styles',
               'group' => 'button_group',
               'style_type' => 'style',
               'style_selector' => '.button', 
               'style_css' => 'background-color', 
               'style_hover' => true,
               'responsive' => true,
            ];
   
            $form['btn_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'group' => 'button_group',
               'style_type' => 'style',
               'style_selector' => '.button', 
               'responsive' => true,
            ];
   
            $form['btn_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'group' => 'button_group',
               'style_type' => 'style',
               'style_selector' => '.button', 
               'style_css' => 'border', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['btn_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'button_group',
               'style_type' => 'style',
               'style_selector' => '.button', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['btn_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'tab' => 'section_styles',
               'group' => 'button_group',
               'style_type' => 'style',
               'style_selector' => '.button', 
               'style_css' => 'padding', 
               'responsive' => true,
               'style_hover' => true,
            ];

            $form['btn_align'] = [
               'type'    => 'select',
               'title'   => t('Horizontal Align'),
               'tab' => 'section_styles',
               'group' => 'button_group',
               'style_type' => 'style',
               'style_selector' => '.form-actions', 
               'style_css' => 'text-align',
               'responsive' => true,
               'options' => [
                  '' => 'Por defecto',
                  'left' => 'Start',
                  'center' => 'Center',
                  'right' => 'End',
               ]
            ];
            $form['box_group'] = [
               'type' => 'group',
               'title' => t('Box'),
               'tab' => 'section_styles',
            ];
   
            $form['box_background_color'] = [
               'type' => 'noahs_color',
               'title' => t('Background Color'),
               'tab' => 'section_styles',
               'group' => 'box_group',
               'style_type' => 'style',
               'style_selector' => '.noahs_product_teaser', 
               'style_css' => 'background-color', 
               'style_hover' => true,
               'responsive' => true,
            ];
   
            $form['box_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'group' => 'box_group',
               'style_type' => 'style',
               'style_selector' => '.noahs_product_teaser', 
               'responsive' => true,
            ];
   
            $form['box_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'group' => 'box_group',
               'style_type' => 'style',
               'style_selector' => '.noahs_product_teaser', 
               'style_css' => 'border', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['box_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'box_group',
               'style_type' => 'style',
               'style_selector' => '.noahs_product_teaser', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['box_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'tab' => 'section_styles',
               'group' => 'box_group',
               'style_type' => 'style',
               'style_selector' => '.noahs_product_teaser', 
               'style_css' => 'padding', 
               'responsive' => true,
               'style_hover' => true,
            ];
            $form['box_shadows'] = [
               'type'    => 'noahs_shadows',
               'title'   => t('Shadow'),
               'tab' => 'section_styles',
               'group' => 'box_group',
               'style_type' => 'style',
               'style_selector' => '.noahs_product_teaser', 
               'responsive' => true, 
               'style_hover' => true,
            ];
            $form['box_border_radius'] = [
               'type'    => 'noahs_radius',
               'title'   => t('Border Radius'),
               'tab' => 'section_styles',
               'group' => 'box_group',
               'style_type' => 'style',
               'style_selector' => '.noahs_product_teaser', 
               'responsive' => true, 
               'style_hover' => true,
            ];
            return $form;

      }

      public function template( $settings ){

         $settings = $settings->element;
         $output = '<h4>Add your product</h4>';
         if(!empty($settings->noahs_commerce_product)){
            $product_id = explode(',', $settings->noahs_commerce_product)[0];
            $entity = \Drupal::entityTypeManager()->getStorage('commerce_product')->load($product_id);

            $view = !empty($settings->product_view_value) ? $settings->product_view_value : 'default';
            $build = \Drupal::entityTypeManager()->getViewBuilder('commerce_product')->view($entity, $view);
            $render = \Drupal::service('renderer')->render($build);
            $output = $render;
         }

         return $output;   
      }


      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



