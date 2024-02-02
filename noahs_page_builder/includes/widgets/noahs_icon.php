<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_icon extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_7579050" height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg" data-name="Line Expand"><path d="m32 1a31 31 0 0 0 0 62 1 1 0 0 0 .707-.293l30-30a1 1 0 0 0 .293-.707 31.035 31.035 0 0 0 -31-31zm-.4 54.99a24 24 0 1 1 24.39-24.39 30.864 30.864 0 0 0 -13.477 6.351l-.438-2.551 8.625-8.41a1 1 0 0 0 -.554-1.706l-11.919-1.731-5.33-10.8a1 1 0 0 0 -1.794 0l-5.33 10.8-11.917 1.731a1 1 0 0 0 -.556 1.706l8.625 8.41-2.035 11.865a1 1 0 0 0 1.451 1.054l10.659-5.604 4.182 2.2a30.827 30.827 0 0 0 -4.582 11.075zm8.412-20.774.735 4.282a31.179 31.179 0 0 0 -3.4 3.769l-4.882-2.567a1 1 0 0 0 -.93 0l-9.331 4.9 1.782-10.389a1 1 0 0 0 -.288-.885l-7.549-7.359 10.432-1.516a1 1 0 0 0 .753-.547l4.666-9.449 4.666 9.454a1 1 0 0 0 .753.547l10.432 1.516-7.551 7.359a1 1 0 0 0 -.286.885zm-6.9 24.253a29.04 29.04 0 0 1 26.357-26.352zm24.864-28.2a26 26 0 1 0 -26.707 26.712q-.192 1.477-.243 2.994a29 29 0 1 1 29.949-29.949q-1.516.05-2.994.243z"></path></svg>',
            'title' => 'Icon',
            'description' => 'Description',
            'group' => 'noahs_page_builder'
         ];
      }
      
      public function render_form(){

         $form = [];
         $options = noahs_page_builder_load_blocks();

         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
         
         $form['icon'] = [
            'type'    => 'noahs_icon',
            'title'   => t('Icon'),
            'tab' => 'section_content',
         ];
         $form['icon_size'] = [
            'type'    => 'text',
            'title'   => t('Icon Size'),
            'placeholder'   => t('20px, 2rem, etc...'),
            'tab' => 'section_content',
            'responsive' => true,
            'style_type' => 'style',
            'style_css' => 'font-size',
            'style_selector' => '.widget-content i', 
         ];
         $form['icon_url'] = [
            'type'    => 'text',
            'title'   => t('Url'),
            'placeholder'  => t('Url'),
            'tab' => 'section_content',
         ];

         $form['horizontal_align'] = [
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
            ]
         ];
         	// Section Styles
         $form['section_styles'] = [
            'type' => 'tab',
            'title' => t('Styles')
         ];

         $form['bg_color'] = [
            'type'     => 'noahs_color',
            'title'    => ('Color'),
            'tab'     => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.widget-content i', 
            'style_css' => 'color',
            'style_hover' => true,
         ];
         return $form;

      }

      public function template( $settings ){

         $render_block = '';
         $settings = $settings['element'];

         $icon =  (isset($settings['icon']['class']) ? $settings['icon']['class'] : 'fa-solid fa-cube');

         ?>
         <?php ob_start() ?>
               <div class="widget-content">
                  <?php if(isset($settings['icon_url'])){ ?>
                    <a href="<?php echo $settings['icon_url']; ?>"><i class="<?php  echo $icon; ?>"></i></a>
                  <?php }else{ ?>
                  <i class="<?php  echo $icon; ?>"></i>
                  <?php } ?>
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



