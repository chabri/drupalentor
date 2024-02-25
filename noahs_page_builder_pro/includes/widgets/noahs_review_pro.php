<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_review_pro extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_8798665" height="512" viewBox="0 0 66 66" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m62.2 28.8h-4.8v-18.2c0-2.1-1.7-3.8-3.8-3.8h-48.8c-2.1 0-3.8 1.7-3.8 3.8v31.5c0 2.1 1.7 3.9 3.8 3.9h6.1l-2.3 5.3c-.4.9.6 1.7 1.4 1.2l11.6-6.5h6.2v6c0 1.6 1.3 2.8 2.8 2.8h20.6l7.4 4.2c.8.5 1.8-.4 1.4-1.3l-1.3-3h3.4c1.6 0 2.8-1.3 2.8-2.8v-20.3c.1-1.6-1.2-2.8-2.7-2.8zm-40.9 15.2c-.2 0-.3 0-.5.1l-9.2 5.2 1.7-4c.3-.7-.2-1.4-.9-1.4h-7.6c-1 0-1.8-.8-1.8-1.8v-31.5c0-1 .8-1.8 1.8-1.8h48.7c1 0 1.8.8 1.8 1.8v31.5c0 1-.8 1.8-1.8 1.8h-32.2zm41.7 8c0 .5-.4.8-.8.8h-4.9c-.7 0-1.2.7-.9 1.4l.7 1.6-5-2.9c-.2-.1-.3-.1-.5-.1h-21c-.5 0-.8-.4-.8-.8v-6h23.7c2.1 0 3.8-1.7 3.8-3.8v-11.4h4.8c.5 0 .8.4.8.8v20.4z"></path><path d="m11.5 25.8c-.4 1.3 1.1 2.2 2.1 1.5l3.7-2.7 3.7 2.7c1.1.8 2.5-.3 2.1-1.5l-1.4-4.4 3.7-2.7c1.1-.8.5-2.4-.8-2.4h-4.6l-1.4-4.4c-.4-1.2-2.2-1.2-2.6 0l-1.4 4.4h-4.6c-1.3 0-1.8 1.7-.8 2.4l3.7 2.7zm.5-7.6h3.1c.6 0 1.1-.4 1.3-.9l1-2.9 1 2.9c.2.6.7.9 1.3.9h3.1l-2.7 1.8c-.5.3-.7.9-.5 1.5l1 2.9-2.5-1.8c-.5-.3-1.1-.3-1.6 0l-2.5 1.9 1-2.9c.2-.6 0-1.2-.5-1.5z"></path><path d="m32.9 18.7 3.7 2.7-1.4 4.4c-.4 1.3 1.1 2.2 2.1 1.5l3.7-2.7 3.7 2.7c1 .8 2.5-.3 2.1-1.5l-1.4-4.4 3.7-2.7c1.1-.8.5-2.4-.8-2.4h-4.6l-1.4-4.4c-.4-1.2-2.2-1.2-2.6 0l-1.4 4.4h-4.6c-1.3-.1-1.8 1.6-.8 2.4zm5.9-.5c.6 0 1.1-.4 1.3-.9l1-2.9 1 2.9c.2.6.7.9 1.3.9h3.1l-2.7 1.8c-.5.3-.7.9-.5 1.5l1 2.9-2.5-1.8c-.5-.3-1.1-.3-1.6 0l-2.5 1.8 1-2.9c.2-.6 0-1.2-.5-1.5l-2.5-1.8z"></path><path d="m47.7 32.9h-37.1c-.6 0-1 .4-1 1s.4 1 1 1h37.1c.6 0 1-.4 1-1 0-.5-.4-1-1-1z"></path><path d="m34.4 39.7c0-.6-.4-1-1-1h-22.8c-.6 0-1 .4-1 1s.4 1 1 1h22.7c.6 0 1.1-.4 1.1-1z"></path></g></svg>',
            'title' => 'Testimonial Slider',
            'description' => 'Description',
            'group' => 'Noahs Pro',
         ];
      }
      
      public function render_form(){
         $form = [];

		// Section Content
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ]; 
         $form['testimonial_type'] = [
            'type'    => 'select',
            'title'   => t('Style'),
            'tab' => 'section_content',
            'options' => [
               'slider' => t('Slider'),
               'column' => t('Column Slider'),
               'grid' => t('Grid'),
               'carousel' => t('Carousel'),
            ]
         ];

         $form['carousel_type_columns'] = [
            'type'    => 'select',
            'title'   => t('Show Elements'),
            'tab' => 'section_content',
            'options' => [
               '' => t('All'),
               '1' => '1',
               '2' => '2',
               '3' => '3',
               '4' => '4',
               '5' => '5',
               '6' => '6',
               '7' => '7',
               '8' => '8',
               '9' => '9',
               '10' => '10',
            ],
            'state' => [
               'visible' => [
                  'testimonial_type' => ['value' => 'slider'],
                  'testimonial_type' => ['value' => 'carousel'],
               ],
            ],
         ];

         $form['max_elements'] = [
            'type'    => 'select',
            'title'   => t('Max Elements'),
            'tab' => 'section_content',
            'options' => [
               '' => t('All'),
               '1' => '1',
               '2' => '2',
               '3' => '3',
               '4' => '4',
               '5' => '5',
               '6' => '6',
               '7' => '7',
               '8' => '8',
               '9' => '9',
               '10' => '10',
            ]
         ];
         $form['testimonial_items'] = [
            'type'    => 'noahs_multiple_elements',
            'title'   => t('testimonial Items'),
            'tab' => 'section_content',
            'default_items' => '4',
            'fields' => [
               'testimonial_content' => [
                  'type' => 'tab',
                  'title' =>  t('Slide Content')
               ],
               'testimonial_name' => [
                  'title' => 'Name',
                  'type' => 'text',
                  'placeholder' => 'Name',
                  'default_value' => 'John Smith',
                  'tab' => 'testimonial_content',
               ],
               'testimonial_job' => [
                  'title' => 'Job',
                  'type' => 'text',
                  'placeholder' => 'Job',
                  'default_value' => 'Marketing Manager',
                  'tab' => 'testimonial_content',
               ],
               'testimonial_text' => [
                  'title' => 'Text',
                  'type' => 'textarea',
                  'default_value' => 'Absolutely thrilled with the results! The team\'s expertise and dedication made all the difference. Highly recommend their services!',
                  'tab' => 'testimonial_content',
                  'update_selector' => '.swiper-slide_[index] .noahs_page_builder-testimonial--text'
               ],
               'testimonial_image' => [
                  'title' => 'Image',
                  'type' => 'noahs_image',
                  'default_value' => '/'.NOAHS_PAGE_BUILDER_PATH.'/assets/img/testimonial.jpg',
                  'tab' => 'testimonial_content',
               ],
               'stars' => [
                  'type'    => 'number',
                  'title'   => t('Valoration 0 to 5'),
                  'tab' => 'testimonial_content',
                  'default_value' => '5',
                  'attributes' => [
                     'min' => '0',
                     'max' => '5',
                     'step' => '0.1'
                  ],
               ],
            ],
         ];
         $form['section_styles'] = [
            'type' => 'tab',
            'title' =>  t('Styles')
         ];
         $form['name_font'] = [
            'type'        => 'noahs_font',
            'title'       => t('Name Font'),
            'tab'     => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.noahs_page_builder-testimonial--title', 
            'responsive' => true,
         ];
        $form['job_font'] = [
            'type'        => 'noahs_font',
            'title'       => t('Job Font'),
            'tab'     => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.noahs_page_builder-testimonial--text', 
            'responsive' => true,
        ];
        $form['text_font'] = [
            'type'        => 'noahs_font',
            'title'       => t('Text Font'),
            'tab'     => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.noahs_page_builder-testimonial--text', 
            'responsive' => true,
        ];
        $form['group_box'] = [
         'type' => 'group',
         'title' =>  t('Box')
         ];
         $form['bg_color'] = [
            'type'     => 'noahs_color',
            'title'    => ('Background Color'),
            'tab'     => 'section_styles',
            'group'     => 'group_box',
            'style_type' => 'style',
            'style_css' => 'background-color', 
            'style_selector' => '.testimonial-widget--wrapper', 
         ];
         $form['border'] = [
            'type' => 'noahs_border',
            'title' => t('Border'),
            'tab' => 'section_styles',
            'group'     => 'group_box',
            'style_type' => 'style',
            'style_selector' => '.testimonial-widget--wrapper', 
            'style_css' => 'border', 
            'responsive' => true,
            'style_hover' => true,
         ];
         $form['box_shadows'] = [
            'type'    => 'noahs_shadows',
            'title'   => t('Image Shadow'),
            'tab' => 'section_styles',
            'group'     => 'group_box',
            'style_type' => 'style',
            'style_selector' => '.testimonial-widget--wrapper', 
            'responsive' => true, 
            'style_hover' => true,
         ];
         $form['border-radius'] = [
            'type'    => 'noahs_radius',
            'title'   => t('Border Radius'),
            'tab' => 'section_styles',
            'group'     => 'group_box',
            'style_type' => 'style',
            'style_selector' => '.testimonial-widget--wrapper', 
            'responsive' => true, 
            'style_hover' => true,
         ];
         $form['btn_margin'] = [
            'type' => 'noahs_margin',
            'title' => t('Margin'),
            'tab' => 'section_styles',
            'group'     => 'group_box',
            'style_type' => 'style',
            'style_selector' => '.testimonial-widget--wrapper', 
            'style_css' => 'margin', 
            'responsive' => true,
            'style_hover' => true,
         ];

         $form['btn_padding'] = [
            'type' => 'noahs_padding',
            'title' => t('Padding'),
            'tab' => 'section_styles',
            'group'     => 'group_box',
            'style_type' => 'style',
            'style_selector' => '.testimonial-widget--wrapper', 
            'style_css' => 'padding', 
            'responsive' => true,
            'style_hover' => true,
         ];
         return $form;
      }
      public function template( $settings ){
         $settings = $settings->element;

         $elements = !empty($settings->testimonial_items) ? $settings->testimonial_items : array_fill(0, 4, null);
         $elements = !empty($settings->max_elements) ? array_slice(0, $settings->max_elements, $elements) : $elements;
         $image = '/'.NOAHS_PAGE_BUILDER_PATH.'/assets/img/testimonial.jpg';
         $carousel_columns = $settings->carousel_type_columns ?? '4';
         $testimonial_type = isset($settings->testimonial_type) ? $settings->testimonial_type : 'slider';
         $testimonial_class = isset($settings->testimonial_type) ? $settings->testimonial_type : 'slider';
         if($testimonial_type === 'slider'){
            $carousel_columns = '1';
          }

         ?>
         <?php ob_start() ?>

         
   <div class="testimonial-wrapper">
      <div class="testimonial-wrapper--content">
         <?php if($testimonial_type === 'slider' || $testimonial_type === 'carousel'){ ?>
            <div class="swiper testimonial-widget testimonial-slider testimonial-<?php echo  $testimonial_class; ?>" data-count-slide="<?php echo  $carousel_columns; ?>">
               <div class="swiper-wrapper">
               <?php if($testimonial_type === 'slider'){ ?>
                  <?php foreach($elements as $index => $element){ ?>
                     <div class="swiper-slide">
                        <div class="testimonial-widget--wrapper">
                           <div class="testimonial-widget--image"><span><img src="<?php echo $image; ?>"></span></div>
                           <div class="stars-outer" data-percentage="5">
                           <div class="stars-inner" style="width: 100%"></div>
                           </div>
                           <div class="testimonial-widget--content">
                                 <h4>Absolutely thrilled with the results! The team's expertise and dedication made all the difference. Highly recommend their services!</h4>
                                 <div class="testimonial-widget--name"><b>John Smith</b></div>
                                 <div class="testimonial-widget--job">Marketing Manager</div>
                           </div>
                        </div>
                     </div>
                  <?php } ?>
               <?php } ?>

               <?php if($testimonial_type === 'carousel'){ ?>
                  <?php foreach($elements as $index => $element){ ?>
                     <div class="swiper-slide">
                        <div class="testimonial-widget--wrapper">
                           <div class="testimonial-widget--header">
                              <div class="testimonial-widget--image"><span><img src="<?php echo $image; ?>"></span></div>
                              <div class="testimonial-widget--header--content">
                                 <div class="testimonial-widget--name"><b>John Smith</b></div>
                                 <div class="testimonial-widget--job">Marketing Manager</div>
                              </div>
                           </div>
                           <div class="testimonial-widget--content">
                              <h4>Absolutely thrilled with the results! The team's expertise and dedication made all the difference. Highly recommend their services!</h4>
                              <div class="stars-outer" data-percentage="5">
                              <div class="stars-inner" style="width: 100%"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php } ?>
               <?php } ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
         </div>
      <?php } ?>

         <?php if($testimonial_type === 'grid'){ ?>
            <div class="testimonial-widget testimonial-grid">

            <div class="row g-4">
            <?php foreach($elements as $index => $element){ ?>
                  <div class="col-4">
                     <div class="testimonial-widget--wrapper">
                        <div class="testimonial-widget--header">
                           <div class="testimonial-widget--image"><span><img src="<?php echo $image; ?>"></span></div>
                           <div class="testimonial-widget--header--content">
                              <div class="testimonial-widget--name"><b>John Smith</b></div>
                              <div class="testimonial-widget--job">Marketing Manager</div>
                           </div>
                        </div>
                        <div class="testimonial-widget--content">
                           <h4>Absolutely thrilled with the results! The team's expertise and dedication made all the difference. Highly recommend their services!</h4>
                           <div class="stars-outer" data-percentage="5">
                           <div class="stars-inner" style="width: 100%"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php } ?>
            </div>
            </div>
         <?php } ?>


      </div>




      </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }

      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



