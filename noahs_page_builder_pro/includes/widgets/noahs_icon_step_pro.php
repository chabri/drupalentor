<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_icon_step_pro extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" id="fi_8632735" data-name="Layer 1" viewBox="0 0 64 64" width="512" height="512"><path d="M52,40.05V16.78A5.78,5.78,0,0,0,46.22,11H7.78A5.78,5.78,0,0,0,2,16.78V49.22A5.78,5.78,0,0,0,7.78,55h33A11,11,0,1,0,52,40.05ZM7.78,53A3.79,3.79,0,0,1,4,49.22V16.78A3.79,3.79,0,0,1,7.78,13H46.22A3.79,3.79,0,0,1,50,16.78V40.05a11,11,0,0,0-9.81,13ZM51,60a9,9,0,1,1,9-9A9,9,0,0,1,51,60Z"></path><path d="M47.9,53.57l-2.12-2.63L44.22,52.2,47,55.63a1,1,0,0,0,.69.37h.09a1,1,0,0,0,.65-.24l9.24-8-1.32-1.52Z"></path><path d="M12,27a4,4,0,0,0,3.86-3H47V22H15.86A4,4,0,1,0,12,27Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,21Z"></path><path d="M12,37a4,4,0,0,0,3.86-3H43V32H15.86A4,4,0,1,0,12,37Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,31Z"></path><path d="M12,39a4,4,0,1,0,3.86,5H39V42H15.86A4,4,0,0,0,12,39Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,45Z"></path></svg>',
            'title' => 'Icon Steps',
            'description' => 'Description',
            'group' => 'Noahs Pro'
         ];
      }
      
      public function render_form(){
         $form = [];

         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];

         $form['icon_list'] = [
            'type'    => 'noahs_multiple_elements',
            'title'   => t('Icon List'),
            'tab' => 'section_content',
            'fields' => [
               'icon_content' => [
                  'type' => 'tab',
                  'title' =>  t('Title ')
               ],
               'icon_title' => [
                  'title' => 'Title',
                  'type' => 'text',
                  'placeholder' => 'This is a h2',
                  'tab' => 'icon_content'
               ],
               'icon_text' => [
                  'title' => 'Text',
                  'type' => 'text',
                  'placeholder' => 'This is a p',
                  'tab' => 'icon_content'
               ],
               'icon' => [
                  'type'    => 'noahs_icon',
                  'title'   => t('Icon'),
                  'tab' => 'icon_content',
               ],

            ],
         ];

         $form['section_styles'] = [
            'type' => 'tab',
            'title' => t('Styles')
         ];

         $form['icon_size'] = [
            'type'    => 'text',
            'title'   => t('Icon Size'),
            'placeholder'   => t('20px, 2rem, etc...'),
            'tab' => 'section_styles',
            'responsive' => true,
            'style_type' => 'style',
            'style_css' => 'font-size',
            'style_selector' => '.noahs-list-group i', 
         ];
         $form['icon_color'] = [
            'type'     => 'noahs_color',
            'title'    => ('Icon Color'),
            'tab'     => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.noahs-list-group i', 
            'style_css' => 'color',
            'style_hover' => true,
         ];
         
         $form['font_title'] = [
            'type' => 'noahs_font',
            'title' => t('Title'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.noahs-list-group h5', 
            'responsive' => true,
         ];

         $form['font_text'] = [
            'type' => 'noahs_font',
            'title' => t('Text'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.noahs-list-group p', 
            'responsive' => true,
         ];

         return $form;
      }

      public function template( $settings ){

         $settings = $settings->element;
         $elements = !empty($settings->icon_list) ? $settings->icon_list : [];

         ?>
         <?php ob_start() ?>
            <div class="widget-content">
               <?php if (!empty($elements)) { ?>
                  <ul class="icon-steps gap-3">
                     <?php foreach($elements as $index => $element){ ?>
                        <li class="icon-steps--item">
                           <?php if(!empty($element->icon->class)){ ?>
                              <i class="<?php echo $element->icon->class; ?>"></i>
                              <?php }else{ ?>
                              <div class="icon-steps--icon">
                                 <span><span><?php echo $index; ?></span></span>
                              </div>
                           <?php } ?>
                           <div class="icon-steps--content">
                              <?php if(isset($element->icon_title)){ ?><h5><?php echo $element->icon_title; ?></h5><?php } ?>
                              <?php if(isset($element->icon_text)){ ?><p><?php echo $element->icon_text; ?></p><?php } ?>
                           </div>
                     </li>
                     <?php } ?>
                     </ul>
               <?php }else{ ?>
            
                  <ul class="icon-steps gap-3">
                     <li class="icon-steps--item">
                           <div class="icon-steps--wrapper">
                              <div class="icon-steps--icon">
                                 <span><span>1</span></span>
                              </div>
                              <div class="icon-steps--content">
                                 <h5>Developing an effective strategy</h5>
                                 <p>Dui sapien eget mi proin sed libero enim sed faucibus. Eu tincidunt tortor
                                       aliquam nulla.</p>
                              </div>
                           </div>
                     </li>
                     <li class="icon-steps--item">
                           <div class="icon-steps--wrapper">
                              <div class="icon-steps--icon">
                                 <span><span>2</span></span>
                              </div>
                              <div class="icon-steps--content">
                                 <h5>Developing an effective strategy</h5>
                                 <p>Dui sapien eget mi proin sed libero enim sed faucibus. Eu tincidunt tortor
                                       aliquam nulla.</p>
                              </div>
                           </div>
                     </li>
                     <li class="icon-steps--item">
                           <div class="icon-steps--wrapper">
                              <div class="icon-steps--icon">
                                  <span><span>3</span></span>
                              </div>
                              <div class="icon-steps--content">
                                 <h5>Developing an effective strategy</h5>
                                 <p>Dui sapien eget mi proin sed libero enim sed faucibus. Eu tincidunt tortor
                                       aliquam nulla.</p>
                              </div>
                           </div>
                     </li>

                  </ul>

            <?php } ?>
            </div>
         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



