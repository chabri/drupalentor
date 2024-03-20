<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_cart extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_3144456" enable-background="new 0 0 511.728 511.728" height="512" viewBox="0 0 511.728 511.728" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438l-17.775-65.953c-4.267-15.761-18.65-26.768-34.978-26.768h-56.942c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942c2.811 0 5.286 1.895 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872c-3.251 6.824-5.076 14.453-5.076 22.501 0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502c0-8.049-1.826-15.677-5.077-22.501h94.716c-3.248 6.822-5.073 14.447-5.073 22.493 0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502 0-8.359-1.974-16.263-5.464-23.285 5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425h-51.942l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905h-36.426l8.84-66.984h48.973l-14.137 61.217c-.784 3.396-3.765 5.767-7.25 5.767z"></path></svg>',
            'title' => 'Cart',
            'description' => 'Description',
            'group' => 'Ecommerce'
         ];
      }
      
      public function render_form(){
         $form = [];


         $media_types = \Drupal::entityTypeManager()->getStorage('menu')->loadMultiple();
         $menus = [];
         $menus[] = 'Select your menu';
         foreach ($media_types as $menu_entity) {
           $menus[$menu_entity->id()] = $menu_entity->label();
         }
     
            // Section Content
            $form['section_content'] = [
               'type' => 'tab',
               'title' =>  t('Content')
            ];
 
            $form['show_total'] = [
               'type'    => 'checkbox',
               'title'   => t('Show Total'),
               'value' => 'true',
               'default_value' => 'false',
               'tab' => 'section_content',
            ];

            $form['section_styles'] = [
               'type' => 'tab',
               'title' => t('Styles')
            ];
   
            $form['icon_group'] = [
               'type' => 'group',
               'title' => t('Icon'),
               'tab' => 'section_styles',
            ];
            
            $form['icon'] = [
               'type'    => 'noahs_icon',
               'title'   => t('Icon'),
               'tab' => 'section_styles',
               'group' => 'icon_group',
               'default_value' => 'fa-solid fa-cart-shopping',
               'style_type' => 'class',
               'style_selector' => '.cart-block--link__expand i',
            ];
            $form['icon_size'] = [
               'type'    => 'text',
               'title'   => t('Icon Size'),
               'placeholder'   => t('20px, 2rem, etc...'),
               'group' => 'icon_group',
               'tab' => 'section_styles',
               'responsive' => true,
               'style_type' => 'style',
               'style_css' => 'font-size',
               'style_selector' => '.cart-block--link__expand i', 
            ];
            
            $form['icon_color'] = [
               'type' => 'noahs_color',
               'title' => t('Color'),
               'tab' => 'section_styles',
               'group' => 'icon_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'color', 
               'style_hover' => true,
            ];
            $form['icon_background_color'] = [
               'type' => 'noahs_color',
               'title' => t('Background Color'),
               'tab' => 'section_styles',
               'group' => 'icon_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'background-color', 
               'style_hover' => true,
            ];
   
            $form['icon_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'group' => 'icon_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'border', 
               'style_hover' => true,
            ];
   
            $form['icon_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'icon_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['icon_width'] = [
               'type' => 'text',
               'title' => t('Width'),
               'group' => 'icon_group',
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'width'
            ];
            $form['icon_height'] = [
               'type' => 'text',
               'title' => t('height'),
               'group' => 'icon_group',
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'heieght'
            ];
            $form['icon_vartical_align'] = [
               'type' => 'text',
               'title' => t('Position Y'),
               'group' => 'icon_group',
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'top',
               'description' => 'Example: -10px or 8px, this start from TOP position'
            ];
            $form['icon_horizontal_align'] = [
               'type' => 'text',
               'title' => t('Position X'),
               'group' => 'icon_group',
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'style_css' => 'right',
               'description' => 'Example: -10px or 8px, this start from Right position'
            ];
            $form['icon_shadows'] = [
               'type'    => 'noahs_shadows',
               'title'   => t('icon Shadow'),
               'group' => 'icon_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'responsive' => true, 
               'style_hover' => true,
            ];
            $form['icon_border_radius'] = [
               'type'    => 'noahs_radius',
               'title'   => t('Border Radius'),
               'tab' => 'section_styles',
               'group' => 'icon_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--link__expand', 
               'responsive' => true, 
               'style_hover' => true,
            ];

            $form['icon_count_group'] = [
               'type' => 'group',
               'title' => t('Count'),
               'tab' => 'section_styles',
            ];

            $form['count_size'] = [
               'type'    => 'text',
               'title'   => t('Icon Size'),
               'placeholder'   => t('20px, 2rem, etc...'),
               'group' => 'icon_count_group',
               'tab' => 'section_styles',
               'responsive' => true,
               'style_type' => 'style',
               'style_css' => 'font-size',
               'style_selector' => '.cart-block--summary__count', 
            ];
            
            $form['count_color'] = [
               'type' => 'noahs_color',
               'title' => t('Color'),
               'tab' => 'section_styles',
               'group' => 'icon_count_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--summary__count', 
               'style_css' => 'color', 
               'style_hover' => true,
            ];
            $form['count_background_color'] = [
               'type' => 'noahs_color',
               'title' => t('Background Color'),
               'tab' => 'section_styles',
               'group' => 'icon_count_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--summary__count', 
               'style_css' => 'background-color', 
               'style_hover' => true,
            ];
   
            $form['count_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'group' => 'icon_count_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--summary__count', 
               'style_css' => 'border', 
               'style_hover' => true,
            ];
   
            $form['count_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'group' => 'icon_count_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--summary__count', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
            ];
   
            $form['count_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'group' => 'icon_group',
               'tab' => 'icon_count_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--summary__count', 
               'style_css' => 'padding', 
               'responsive' => true,
               'style_hover' => true,
            ];
            $form['count_shadows'] = [
               'type'    => 'noahs_shadows',
               'title'   => t('icon Shadow'),
               'group' => 'icon_count_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--summary__count', 
               'responsive' => true, 
               'style_hover' => true,
            ];
            $form['count_border_radius'] = [
               'type'    => 'noahs_radius',
               'title'   => t('Border Radius'),
               'tab' => 'section_styles',
               'group' => 'icon_count_group',
               'style_type' => 'style',
               'style_selector' => '.cart-block--summary__count', 
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
         $render_block = '';
         $settings = $settings->element;


         $block_manager = \Drupal::service('plugin.manager.block');
         $config = [];
         $plugin_block = $block_manager->createInstance('commerce_cart', $config);
      
         $render_block = '<div>Missing view, block "commerce_cart"</div>';
         if($plugin_block){
            $build = $plugin_block->build();
            $render_block = \Drupal::service('renderer')->render(
               $build
            );
         }

         ?>
         <?php ob_start() ?>
               <div class="widget-content">
                  <?php  echo  $render_block; ?>
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



